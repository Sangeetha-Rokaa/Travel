@extends('layouts.admin')

@section('title', 'View Booking - Nepal Travel')
@section('page_title', 'Booking Details')
@section('page_icon', 'fas fa-eye')

@section('content')

    <div class="container-fluid px-0">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

            <div>

                <h4 class="mb-1" style="color:#1e2a2e;">

                    <i class="fas fa-receipt me-2" style="color:#e9b35f;"></i>

                    Booking Details

                </h4>

                <p class="text-muted small mb-0">

                    Booking Reference:
                    <strong>{{ $booking->booking_ref }}</strong>

                </p>

            </div>

            <a href="{{ route('admin.bookings.index') }}" class="btn"
                style="background:#1e2a2e;color:white;border-radius:40px;padding:10px 22px;">

                <i class="fas fa-arrow-left me-2"></i>

                Back to Bookings

            </a>

        </div>

        {{-- MAIN CARD --}}
        <div class="card border-0 rounded-4 shadow-sm" style="border-radius:28px; overflow:hidden;">

            {{-- HEADER --}}
            <div class="card-header py-4" style="background:linear-gradient(135deg,#1e2a2e,#2d4a3a); color:white;">

                <h5 class="mb-0">
                    <i class="fas fa-user me-2"></i>
                    Customer & Trip Information
                </h5>

            </div>

            <div class="card-body p-4">

                {{-- CUSTOMER INFO --}}
                <div class="row g-4">

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Customer Name</h6>
                            <p class="mb-0">{{ $booking->first_name }} {{ $booking->last_name }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Email</h6>
                            <p class="mb-0">{{ $booking->email }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Phone</h6>
                            <p class="mb-0">{{ $booking->phone }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Nationality</h6>
                            <p class="mb-0">{{ $booking->nationality }}</p>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Passport Number</h6>
                            <p class="mb-0">{{ $booking->passport_number }}</p>
                        </div>
                    </div>

                </div>

                <hr class="my-4">

                {{-- TRIP INFO --}}
                <div class="row g-4">

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Trip Dates</h6>
                            <p class="mb-0">
                                {{ optional($booking->trip_start_date)->format('d M Y') }}
                                -
                                {{ optional($booking->trip_end_date)->format('d M Y') }}
                            </p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Adults</h6>
                            <p class="mb-0">{{ $booking->num_adults }}</p>
                        </div>
                    </div>

                    <div class="col-md-3">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Children</h6>
                            <p class="mb-0">{{ $booking->num_children }}</p>
                        </div>
                    </div>

                </div>

                <hr class="my-4">

                {{-- PAYMENT INFO --}}
                <div class="row g-4">

                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Total Price</h6>
                            <p class="mb-0">${{ $booking->total_price }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Amount Paid</h6>
                            <p class="mb-0">${{ $booking->amount_paid }}</p>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Payment Status</h6>

                            <span class="badge bg-success">
                                {{ ucfirst($booking->payment_status) }}
                            </span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Booking Status</h6>

                            <span class="badge bg-primary">
                                {{ ucfirst($booking->status) }}
                            </span>

                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="p-3 border rounded-3 bg-light">
                            <h6 class="fw-bold">Payment Method</h6>
                            <p class="mb-0">{{ $booking->payment_method ?? 'N/A' }}</p>
                        </div>
                    </div>

                </div>

                <hr class="my-4">

                {{-- ADMIN NOTES --}}
                <div class="p-3 border rounded-3 bg-light">

                    <h6 class="fw-bold">Admin Notes</h6>

                    <p class="mb-0" style="white-space: pre-line;">
                        {{ $booking->admin_notes ?? 'No notes added' }}
                    </p>

                </div>

                {{-- ACTIONS --}}
                <div class="d-flex justify-content-end gap-3 mt-4 flex-wrap">

                    <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-warning rounded-pill px-4">

                        <i class="fas fa-edit me-2"></i>

                        Edit Booking

                    </a>

                    <a href="{{ route('admin.bookings.index') }}" class="btn btn-secondary rounded-pill px-4">

                        Back

                    </a>

                </div>

            </div>

        </div>

    </div>

@endsection
