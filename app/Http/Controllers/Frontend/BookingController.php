<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Package;
use App\Models\Trek;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    /**
     * Show the multi-step booking page.
     * Can be called with ?package=slug or ?trek=slug
     */
    public function create(Request $request)
    {
        $package = null;
        $trek    = null;

        if ($request->filled('package')) {
            $package = Package::where('slug', $request->package)->active()->firstOrFail();
        }

        if ($request->filled('trek')) {
            $trek = Trek::where('slug', $request->trek)->active()->firstOrFail();
        }

        return view('frontend.bookings.booking', compact('package', 'trek'));
    }

    /**
     * Store a new booking (called via AJAX from the wizard).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'booking_type'    => 'required|in:trek,package,custom',
            'package_id'      => 'nullable|exists:packages,id',
            'trek_id'         => 'nullable|exists:treks,id',
            'first_name'      => 'required|string|max:100',
            'last_name'       => 'required|string|max:100',
            'email'           => 'required|email|max:150',
            'phone'           => 'nullable|string|max:30',
            'nationality'     => 'nullable|string|max:100',
            'trip_start_date' => 'required|date|after:today',
            'num_adults'      => 'required|integer|min:1|max:50',
            'num_children'    => 'nullable|integer|min:0|max:50',
            'special_requirements' => 'nullable|string|max:1000',
            'payment_method'  => 'required|in:stripe,khalti,esewa,bank_transfer',
            'base_price'      => 'required|numeric|min:0',
            'total_price'     => 'required|numeric|min:0',
        ]);

        $validated['booking_ref'] = 'VN-' . strtoupper(Str::random(8));
        $validated['status']      = 'pending';
        $validated['payment_status'] = 'pending';
        $validated['discount_amount'] = 0;
        $validated['currency']    = 'USD';
        $validated['amount_paid'] = 0;

        $booking = Booking::create($validated);

        return response()->json([
            'success'     => true,
            'booking_ref' => $booking->booking_ref,
            'booking_id'  => $booking->id,
            'message'     => 'Booking created successfully.',
        ]);
    }
}
