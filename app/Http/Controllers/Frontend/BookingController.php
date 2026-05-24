<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Trek;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\View\View;

class BookingController extends Controller
{
    /**
     * Show the booking wizard for a package or trek.
     */
    public function create(Request $request): View
    {
        $package = null;
        $trek    = null;

        if ($request->filled('package')) {
            $package = Package::active()
                ->where('slug', $request->package)
                ->firstOrFail();
        }

        if ($request->filled('trek')) {
            $trek = Trek::active()
                ->where('slug', $request->trek)
                ->firstOrFail();
        }

        // Whichever is set, expose a unified $item for the view
        $item = $package ?? $trek;

        return view('frontend.bookings.create', compact('package', 'trek', 'item'));
    }

    /**
     * Store the booking — called via AJAX from the wizard.
     */
    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            // What is being booked
            'booking_type'   => 'required|in:trek,package,custom',
            'package_id'     => 'nullable|exists:packages,id',
            'trek_id'        => 'nullable|exists:treks,id',
            'pickup_location' => 'nullable|string|max:255',
            'accommodation_type' => 'nullable|string|max:255',


            // Traveler details
            'first_name'     => 'required|string|max:100',
            'last_name'      => 'required|string|max:100',
            'email'          => 'required|email|max:100',
            'phone'          => 'nullable|string|max:50',
            'passport_number' => 'nullable|string|max:50',
            'date_of_birth'  => 'nullable|date|before:today',
            'nationality'    => 'nullable|string|max:100',

            'num_adults'     => 'required|integer|min:1',
            'num_children'   => 'nullable|integer|min:0',
            'special_requirements' => 'nullable|string|max:1000',

            // Payment
            'payment_method' => 'required|in:stripe,khalti,esewa,bank',
            'card_number'    => 'required_if:payment_method,stripe|nullable|string',
            'card_expiry'    => 'required_if:payment_method,stripe|nullable|string',
            'card_cvc'       => 'required_if:payment_method,stripe|nullable|string',
            'card_name'      => 'required_if:payment_method,stripe|nullable|string',
        ]);

        // Resolve price from the booked item
        $basePrice = 0;
        $tripEndDate = null;

        if ($validated['booking_type'] === 'package' && !empty($validated['package_id'])) {
            $pkg = Package::findOrFail($validated['package_id']);
            $basePrice   = $pkg->price_usd_discounted ?? $pkg->price_usd;
            $tripEndDate = now()->addDays($pkg->duration_days)->toDateString();
        }

        if ($validated['booking_type'] === 'trek' && !empty($validated['trek_id'])) {
            $trek        = Trek::findOrFail($validated['trek_id']);
            $basePrice   = $trek->price_usd ?? 0;
            $tripEndDate = now()->addDays($trek->duration_days)->toDateString();
        }

        $numAdults    = (int) $validated['num_adults'];
        $numChildren  = (int) ($validated['num_children'] ?? 0);
        $totalPrice   = $basePrice * $numAdults;

        // Simulate payment processing for stripe demo
        // In production, call Stripe SDK / Khalti / eSewa APIs here
        $transactionId = 'TXN-' . strtoupper(uniqid());
        $paymentStatus = 'paid'; // assume success for demo

        $booking = Booking::create([
            'booking_ref'     => Booking::generateRef(),
            'booking_type'    => $validated['booking_type'],
            'package_id'      => $validated['package_id'] ?? null,
            'trek_id'         => $validated['trek_id'] ?? null,
            'pickup_location' => $validated['pickup_location'] ?? null,
            'accommodation_type' => $validated['accommodation_type'] ?? null,
            'first_name'      => $validated['first_name'],
            'last_name'       => 'N/A', // wizard collects full name in one field
            'email'           => $validated['email'],
            'phone'           => $validated['phone'] ?? null,
            'date_of_birth'   => $validated['date_of_birth'] ?? null,
            'nationality'     => $validated['nationality'] ?? null,
            'passport_number' => $validated['passport_number'] ?? null,
            'num_adults'      => $numAdults,
            'num_children'    => $numChildren,
            'special_requirements' => $validated['special_requirements'] ?? null,
            'trip_start_date' => now()->toDateString(),
            'trip_end_date'   => $tripEndDate,
            'base_price'      => $basePrice,
            'discount_amount' => 0,
            'total_price'     => $totalPrice,
            'currency'        => 'USD',
            'payment_status'  => $paymentStatus,
            'amount_paid'     => $totalPrice,
            'payment_method'  => $validated['payment_method'],
            'transaction_id'  => $transactionId,
            'paid_at'         => now(),
            'status'          => 'pending', // admin will confirm after verifying payment
        ]);

        return response()->json([
            'success'     => true,
            'booking_ref' => $booking->booking_ref,
            'total'       => $totalPrice,
        ]);
    }
}
