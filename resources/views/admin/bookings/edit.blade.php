{{-- resources/views/admin/bookings/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Booking - Nepal Travel')
@section('page_title', 'Edit Booking')
@section('page_icon', 'fas fa-edit')

@section('content')

    <div class="container-fluid px-0">

        {{-- PAGE HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">

            <div>

                <h4 class="mb-1" style="color:#1e2a2e;">

                    <i class="fas fa-edit me-2" style="color:#e9b35f;"></i>

                    Edit Booking

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

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show"
                style="border-radius:16px;border-left:4px solid #10b981;">

                <i class="fas fa-check-circle me-2"></i>

                {{ session('success') }}

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>

            </div>
        @endif

        {{-- FORM CARD --}}
        <div class="card border-0 rounded-4 shadow-sm" style="border-radius:28px !important;overflow:hidden;">

            {{-- CARD HEADER --}}
            <div class="card-header border-0 py-4" style="background:linear-gradient(135deg,#1e2a2e,#2d4a3a);">

                <h5 class="mb-0 text-white">

                    <i class="fas fa-user-check me-2"></i>

                    Booking Details

                </h5>

            </div>

            {{-- FORM --}}
            <div class="card-body p-4">

                <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}">

                    @csrf
                    @method('PUT')

                    <div class="row g-4">

                        {{-- CUSTOMER INFO --}}
                        <div class="col-12">

                            <div class="section-title">

                                <i class="fas fa-user"></i>

                                Customer Information

                            </div>

                        </div>

                        {{-- FIRST NAME --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                First Name
                            </label>

                            <input type="text" class="form-control custom-input" name="first_name"
                                value="{{ old('first_name', $booking->first_name) }}">

                        </div>

                        {{-- LAST NAME --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Last Name
                            </label>

                            <input type="text" class="form-control custom-input" name="last_name"
                                value="{{ old('last_name', $booking->last_name) }}">

                        </div>

                        {{-- EMAIL --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Email
                            </label>

                            <input type="email" class="form-control custom-input" name="email"
                                value="{{ old('email', $booking->email) }}">

                        </div>

                        {{-- PHONE --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Phone
                            </label>

                            <input type="text" class="form-control custom-input" name="phone"
                                value="{{ old('phone', $booking->phone) }}">

                        </div>

                        {{-- NATIONALITY --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Nationality
                            </label>

                            <input type="text" class="form-control custom-input" name="nationality"
                                value="{{ old('nationality', $booking->nationality) }}">

                        </div>

                        {{-- PASSPORT --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Passport Number
                            </label>

                            <input type="text" class="form-control custom-input" name="passport_number"
                                value="{{ old('passport_number', $booking->passport_number) }}">

                        </div>

                        {{-- TRIP SECTION --}}
                        <div class="col-12 mt-4">

                            <div class="section-title">

                                <i class="fas fa-route"></i>

                                Trip Information

                            </div>

                        </div>

                        {{-- START DATE --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Start Date
                            </label>

                            <input type="date" class="form-control custom-input" name="trip_start_date"
                                value="{{ optional($booking->trip_start_date)->format('Y-m-d') }}">

                        </div>

                        {{-- END DATE --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                End Date
                            </label>

                            <input type="date" class="form-control custom-input" name="trip_end_date"
                                value="{{ optional($booking->trip_end_date)->format('Y-m-d') }}">

                        </div>

                        {{-- ADULTS --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Adults
                            </label>

                            <input type="number" class="form-control custom-input" name="num_adults"
                                value="{{ old('num_adults', $booking->num_adults) }}">

                        </div>

                        {{-- CHILDREN --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Children
                            </label>

                            <input type="number" class="form-control custom-input" name="num_children"
                                value="{{ old('num_children', $booking->num_children) }}">

                        </div>

                        {{-- PAYMENT SECTION --}}
                        <div class="col-12 mt-4">

                            <div class="section-title">

                                <i class="fas fa-credit-card"></i>

                                Payment & Status

                            </div>

                        </div>

                        {{-- TOTAL --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Total Price
                            </label>

                            <input type="number" step="0.01" class="form-control custom-input" name="total_price"
                                value="{{ old('total_price', $booking->total_price) }}">

                        </div>

                        {{-- AMOUNT PAID --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Amount Paid
                            </label>

                            <input type="number" step="0.01" class="form-control custom-input" name="amount_paid"
                                value="{{ old('amount_paid', $booking->amount_paid) }}">

                        </div>

                        {{-- PAYMENT STATUS --}}
                        <div class="col-md-4">

                            <label class="form-label fw-semibold">
                                Payment Status
                            </label>

                            <select name="payment_status" class="form-select custom-input">

                                @foreach (\App\Models\Booking::PAYMENT_STATUSES as $payment)
                                    <option value="{{ $payment }}"
                                        {{ $booking->payment_status == $payment ? 'selected' : '' }}>

                                        {{ ucfirst($payment) }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        {{-- BOOKING STATUS --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Booking Status
                            </label>

                            <select name="status" class="form-select custom-input">

                                @foreach (\App\Models\Booking::BOOKING_STATUSES as $key => $label)
                                    <option value="{{ $key }}" {{ $booking->status == $key ? 'selected' : '' }}>

                                        {{ $label }}

                                    </option>
                                @endforeach

                            </select>

                        </div>

                        {{-- PAYMENT METHOD --}}
                        <div class="col-md-6">

                            <label class="form-label fw-semibold">
                                Payment Method
                            </label>

                            <input type="text" class="form-control custom-input" name="payment_method"
                                value="{{ old('payment_method', $booking->payment_method) }}">

                        </div>

                        {{-- ADMIN NOTES --}}
                        <div class="col-12">

                            <label class="form-label fw-semibold">
                                Admin Notes
                            </label>

                            <textarea name="admin_notes" rows="5" class="form-control custom-input">{{ old('admin_notes', $booking->admin_notes) }}</textarea>

                        </div>

                        {{-- BUTTONS --}}
                        <div class="col-12 mt-3">

                            <div class="d-flex justify-content-end gap-3 flex-wrap">

                                <a href="{{ route('admin.bookings.index') }}"
                                    class="btn btn-light px-4 py-2 rounded-pill">

                                    Cancel

                                </a>

                                <button type="submit" class="btn px-4 py-2 rounded-pill text-white"
                                    style="background:linear-gradient(135deg,#1e2a2e,#2d4a3a);">

                                    <i class="fas fa-save me-2"></i>

                                    Update Booking

                                </button>

                            </div>

                        </div>

                    </div>

                </form>

            </div>

        </div>

    </div>

@endsection

@push('styles')
    <style>
        .section-title {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 18px;
            font-weight: 700;
            color: #1e2a2e;
            margin-bottom: 10px;
            padding-bottom: 10px;
            border-bottom: 2px solid #f0e2ce;
        }

        .section-title i {
            color: #e9b35f;
        }

        .custom-input {
            border-radius: 16px;
            border: 1px solid #e5d8c4;
            padding: 12px 16px;
            transition: all .2s ease;
            box-shadow: none !important;
        }

        .custom-input:focus {
            border-color: #e9b35f;
            box-shadow: 0 0 0 4px rgba(233, 179, 95, .15) !important;
        }

        .card {
            background: white;
        }

        .form-label {
            color: #1e2a2e;
            margin-bottom: 8px;
        }

        textarea.custom-input {
            resize: none;
        }

        .btn {
            transition: all .2s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .alert {
            border: none;
            background: linear-gradient(135deg, #fef9e6, #ffffff);
        }

        @media(max-width:768px) {

            .card-body {
                padding: 20px !important;
            }

        }
    </style>
@endpush
