<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Trek;
use App\Models\Package;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class BookingController extends Controller
{
    public function index(Request $request): View
    {
        $query = Booking::with(['trek', 'package'])->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        // Filter by booking type
        if ($request->filled('booking_type')) {
            $query->where('booking_type', $request->booking_type);
        }

        // Search by booking ref or customer name/email
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('booking_ref', 'like', "%{$search}%")
                    ->orWhere('first_name', 'like', "%{$search}%")
                    ->orWhere('last_name', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Date range filter
        if ($request->filled('date_from')) {
            $query->whereDate('trip_start_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('trip_start_date', '<=', $request->date_to);
        }

        $bookings = $query->paginate(20);

        // Stats for dashboard
        $stats = [
            'total' => Booking::count(),
            'pending' => Booking::where('status', 'pending')->count(),
            'confirmed' => Booking::where('status', 'confirmed')->count(),
            'completed' => Booking::where('status', 'completed')->count(),
            'cancelled' => Booking::where('status', 'cancelled')->count(),
            'paid' => Booking::where('payment_status', 'paid')->count(),
            'revenue' => Booking::where('payment_status', 'paid')->sum('total_price'),
            'upcoming' => Booking::where('trip_start_date', '>=', now())
                ->whereNotIn('status', ['cancelled', 'completed', 'refunded'])
                ->count(),
        ];

        return view('admin.bookings.index', compact('bookings', 'stats'));
    }

    public function show(Booking $booking): View
    {
        $booking->load(['trek', 'package']);
        return view('admin.bookings.show', compact('booking'));
    }

    public function edit(Booking $booking): View
    {
        $treks = Trek::active()->ordered()->pluck('name', 'id');
        $packages = Package::active()->ordered()->pluck('name', 'id');

        return view('admin.bookings.edit', compact('booking', 'treks', 'packages'));
    }

    public function update(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'first_name' => 'required|string|max:100',
            'last_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:50',
            'nationality' => 'nullable|string|max:100',
            'passport_number' => 'nullable|string|max:50',
            'date_of_birth' => 'nullable|date',
            'trip_start_date' => 'required|date',
            'trip_end_date' => 'nullable|date|after_or_equal:trip_start_date',
            'num_adults' => 'required|integer|min:1',
            'num_children' => 'required|integer|min:0',
            'special_requirements' => 'nullable|string',
            'accommodation_preference' => 'nullable|string|max:50',
            'pickup_location' => 'nullable|string|max:200',
            'base_price' => 'required|numeric|min:0',
            'discount_amount' => 'nullable|numeric|min:0',
            'total_price' => 'required|numeric|min:0',
            'currency' => 'required|string|size:3',
            'payment_status' => 'required|in:' . implode(',', Booking::PAYMENT_STATUSES),
            'amount_paid' => 'required|numeric|min:0',
            'payment_method' => 'nullable|string|max:50',
            'transaction_id' => 'nullable|string|max:100',
            'status' => 'required|in:' . implode(',', array_keys(Booking::BOOKING_STATUSES)),
            'admin_notes' => 'nullable|string',
            'cancellation_reason' => 'nullable|string',
        ]);

        // Recalculate if needed
        if ($request->has('recalculate_totals')) {
            $validated['total_price'] = $validated['base_price'] - ($validated['discount_amount'] ?? 0);

            if ($validated['amount_paid'] >= $validated['total_price']) {
                $validated['payment_status'] = 'paid';
                $validated['paid_at'] = now();
            } elseif ($validated['amount_paid'] > 0) {
                $validated['payment_status'] = 'partial';
            } else {
                $validated['payment_status'] = 'pending';
            }
        }

        // Handle status change actions
        if ($validated['status'] === 'confirmed' && $booking->status !== 'confirmed') {
            $validated['confirmed_at'] = now();
        }

        if ($validated['status'] === 'cancelled' && $booking->status !== 'cancelled') {
            $validated['cancelled_at'] = now();
        }

        $booking->update($validated);

        return redirect()->route('admin.bookings.show', $booking)
            ->with('success', 'Booking updated successfully.');
    }

    public function destroy(Booking $booking): RedirectResponse
    {
        $booking->delete();

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Booking deleted successfully.');
    }

    // Custom actions
    public function confirm(Booking $booking): RedirectResponse
    {
        $booking->confirm();

        // Send confirmation email
        // Mail::to($booking->email)->send(new BookingConfirmedMail($booking));

        return redirect()->route('admin.bookings.show', $booking)
            ->with('success', 'Booking confirmed successfully.');
    }

    public function cancel(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'cancellation_reason' => 'required|string|max:500',
        ]);

        $booking->cancel($validated['cancellation_reason']);

        // Send cancellation email
        // Mail::to($booking->email)->send(new BookingCancelledMail($booking));

        return redirect()->route('admin.bookings.show', $booking)
            ->with('success', 'Booking cancelled successfully.');
    }

    public function markPayment(Request $request, Booking $booking): RedirectResponse
    {
        $validated = $request->validate([
            'amount' => 'required|numeric|min:0.01',
            'payment_method' => 'required|string|max:50',
            'transaction_id' => 'nullable|string|max:100',
        ]);

        $booking->markAsPaid($validated['amount'], $validated['payment_method'], $validated['transaction_id'] ?? null);

        return redirect()->route('admin.bookings.show', $booking)
            ->with('success', 'Payment recorded successfully.');
    }

    public function complete(Booking $booking): RedirectResponse
    {
        $booking->markAsCompleted();

        return redirect()->route('admin.bookings.show', $booking)
            ->with('success', 'Booking marked as completed.');
    }

    public function export(Request $request)
    {
        $query = Booking::with(['trek', 'package']);

        // Apply same filters as index
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('date_from')) {
            $query->whereDate('trip_start_date', '>=', $request->date_from);
        }

        if ($request->filled('date_to')) {
            $query->whereDate('trip_start_date', '<=', $request->date_to);
        }

        $bookings = $query->get();

        // Generate CSV export
        $filename = 'bookings_export_' . date('Y-m-d_His') . '.csv';
        $handle = fopen('php://temp', 'w+');

        // Headers
        fputcsv($handle, [
            'Booking Ref',
            'Date',
            'Customer Name',
            'Email',
            'Phone',
            'Booking Type',
            'Trip Name',
            'Start Date',
            'End Date',
            'Adults',
            'Children',
            'Total Price',
            'Currency',
            'Payment Status',
            'Amount Paid',
            'Booking Status',
            'Created At'
        ]);

        foreach ($bookings as $booking) {
            fputcsv($handle, [
                $booking->booking_ref,
                $booking->created_at->format('Y-m-d'),
                $booking->full_name,
                $booking->email,
                $booking->phone,
                $booking->booking_type,
                $booking->trek?->name ?? $booking->package?->name ?? $booking->custom_request,
                $booking->trip_start_date->format('Y-m-d'),
                $booking->trip_end_date?->format('Y-m-d'),
                $booking->num_adults,
                $booking->num_children,
                $booking->total_price,
                $booking->currency,
                $booking->payment_status,
                $booking->amount_paid,
                $booking->status,
                $booking->created_at->format('Y-m-d H:i'),
            ]);
        }

        rewind($handle);
        $csv = stream_get_contents($handle);
        fclose($handle);

        return response($csv, 200)
            ->header('Content-Type', 'text/csv')
            ->header('Content-Disposition', "attachment; filename={$filename}");
    }

    public function stats(): View
    {
        // Monthly revenue stats
        $monthlyRevenue = Booking::where('payment_status', 'paid')
            ->select(
                DB::raw('YEAR(created_at) as year'),
                DB::raw('MONTH(created_at) as month'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->groupBy('year', 'month')
            ->orderBy('year', 'desc')
            ->orderBy('month', 'desc')
            ->limit(12)
            ->get();

        // Booking by type
        $bookingsByType = Booking::select('booking_type', DB::raw('COUNT(*) as count'))
            ->groupBy('booking_type')
            ->get();

        // Booking by status
        $bookingsByStatus = Booking::select('status', DB::raw('COUNT(*) as count'))
            ->groupBy('status')
            ->get();

        // Popular treks/packages
        $popularTreks = Booking::where('booking_type', 'trek')
            ->select('trek_id', DB::raw('COUNT(*) as bookings_count'))
            ->with('trek')
            ->groupBy('trek_id')
            ->orderBy('bookings_count', 'desc')
            ->limit(5)
            ->get();

        return view('admin.bookings.stats', compact('monthlyRevenue', 'bookingsByType', 'bookingsByStatus', 'popularTreks'));
    }
}
