{{-- resources/views/admin/bookings/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manage Bookings - Nepal Travel')
@section('page_title', 'Manage Bookings')
@section('page_icon', 'fas fa-calendar-check')

@section('content')

    <div class="container-fluid px-0">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>
                <h4 class="mb-1" style="color:#1e2a2e;">
                    <i class="fas fa-calendar-check me-2" style="color:#e9b35f;"></i>
                    Booking Management
                </h4>

                <p class="text-muted small mb-0">
                    <i class="fas fa-database me-1"></i>
                    Total Bookings:
                    <strong>{{ $bookings->total() }}</strong>

                    <span class="mx-2">|</span>

                    <i class="fas fa-layer-group me-1"></i>
                    Page:
                    {{ $bookings->currentPage() }}
                    /
                    {{ $bookings->lastPage() }}
                </p>
            </div>

        </div>

        {{-- FILTER BAR --}}
        <div class="card border-0 rounded-4 shadow-sm mb-4" style="background:white;border-radius:28px !important;">

            <div class="card-body p-3">

                <form method="GET" action="{{ route('admin.bookings.index') }}" class="row g-3 align-items-center">

                    {{-- SEARCH --}}
                    <div class="col-md-4">

                        <div class="input-group" style="border-radius:40px;overflow:hidden;">

                            <span class="input-group-text bg-white border-end-0">
                                <i class="fas fa-search text-muted"></i>
                            </span>

                            <input type="text" name="search" class="form-control border-start-0"
                                placeholder="Search booking/customer..." value="{{ request('search') }}">

                        </div>

                    </div>

                    {{-- STATUS --}}
                    <div class="col-md-3">

                        <select name="status" class="form-select" style="border-radius:40px;">

                            <option value="">All Booking Status</option>

                            @foreach (\App\Models\Booking::BOOKING_STATUSES as $key => $label)
                                <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>

                                    {{ $label }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- PAYMENT --}}
                    <div class="col-md-3">

                        <select name="payment" class="form-select" style="border-radius:40px;">

                            <option value="">All Payment Status</option>

                            @foreach (\App\Models\Booking::PAYMENT_STATUSES as $payment)
                                <option value="{{ $payment }}" {{ request('payment') == $payment ? 'selected' : '' }}>

                                    {{ ucfirst($payment) }}

                                </option>
                            @endforeach

                        </select>

                    </div>

                    {{-- BUTTON --}}
                    <div class="col-md-2">

                        <button type="submit" class="btn w-100" style="background:#1e2a2e;color:white;border-radius:40px;">

                            <i class="fas fa-filter me-1"></i>
                            Filter

                        </button>

                    </div>

                </form>

            </div>

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

        {{-- TABLE --}}
        <div class="card border-0 rounded-4 shadow-sm" style="background:white;border-radius:28px !important;">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead style="background:linear-gradient(135deg,#1e2a2e,#2d4a3a);color:#f5e6d3;">

                            <tr>

                                <th class="ps-4">Ref</th>
                                <th>Customer</th>
                                <th>Trip</th>
                                <th>Travelers</th>
                                <th>Total</th>
                                <th>Payment</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th class="text-center pe-4">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($bookings as $booking)
                                <tr style="border-bottom:1px solid #f0e2ce;">

                                    {{-- REF --}}
                                    <td class="ps-4">

                                        <span class="badge"
                                            style="background:#eff6ff;color:#2563eb;border-radius:20px;padding:8px 14px;">

                                            {{ $booking->booking_ref }}

                                        </span>

                                    </td>

                                    {{-- CUSTOMER --}}
                                    <td>

                                        <div>

                                            <span class="fw-semibold" style="color:#1e2a2e;">

                                                {{ $booking->full_name }}

                                            </span>

                                            <br>

                                            <small class="text-muted">
                                                <i class="fas fa-envelope me-1"></i>
                                                {{ $booking->email }}
                                            </small>

                                            <br>

                                            <small class="text-muted">
                                                <i class="fas fa-phone me-1"></i>
                                                {{ $booking->phone }}
                                            </small>

                                        </div>

                                    </td>

                                    {{-- TRIP --}}
                                    <td>

                                        @if ($booking->trek)
                                            <span class="badge"
                                                style="background:#dbeafe;color:#2563eb;border-radius:20px;padding:6px 12px;">

                                                <i class="fas fa-hiking me-1"></i>
                                                {{ $booking->trek->name }}

                                            </span>
                                        @elseif($booking->package)
                                            <span class="badge"
                                                style="background:#ede9fe;color:#7c3aed;border-radius:20px;padding:6px 12px;">

                                                <i class="fas fa-box-open me-1"></i>
                                                {{ $booking->package->name }}

                                            </span>
                                        @else
                                            <span class="text-muted">
                                                Custom Trip
                                            </span>
                                        @endif

                                    </td>

                                    {{-- TRAVELERS --}}
                                    <td>

                                        <span class="badge"
                                            style="background:#fef3c7;color:#92400e;border-radius:20px;padding:6px 12px;">

                                            <i class="fas fa-users me-1"></i>

                                            {{ $booking->num_adults }}

                                            Adult(s)

                                        </span>

                                        @if ($booking->num_children > 0)
                                            <br>

                                            <small class="text-muted">

                                                {{ $booking->num_children }}
                                                Child

                                            </small>
                                        @endif

                                    </td>

                                    {{-- TOTAL --}}
                                    <td>

                                        <strong style="color:#16a34a;">

                                            {{ $booking->currency }}
                                            {{ number_format($booking->total_price, 2) }}

                                        </strong>

                                    </td>

                                    {{-- PAYMENT --}}
                                    <td>

                                        <span class="badge payment-badge payment-{{ $booking->payment_status }}">

                                            {{ ucfirst($booking->payment_status) }}

                                        </span>

                                    </td>

                                    {{-- STATUS --}}
                                    <td>

                                        <span class="badge booking-badge status-{{ $booking->status }}">

                                            {{ \App\Models\Booking::BOOKING_STATUSES[$booking->status] ?? ucfirst($booking->status) }}

                                        </span>

                                    </td>

                                    {{-- DATE --}}
                                    <td>

                                        <small class="text-muted">

                                            <i class="fas fa-calendar-alt me-1"></i>

                                            {{ $booking->created_at->format('M d, Y') }}

                                        </small>

                                    </td>

                                    {{-- ACTIONS --}}
                                    <td class="text-center pe-4">

                                        <div class="btn-group" role="group" style="gap:6px;">

                                            <a href="{{ route('admin.bookings.show', $booking->id) }}" class="btn btn-sm"
                                                style="background:#0ea5e9;color:white;border-radius:30px;padding:6px 14px;">

                                                <i class="fas fa-eye"></i>

                                            </a>

                                            <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn btn-sm"
                                                style="background:#e9b35f;color:#1e2a2e;border-radius:30px;padding:6px 14px;">

                                                <i class="fas fa-edit"></i>

                                            </a>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>

                                    <td colspan="9" class="text-center py-5">

                                        <i class="fas fa-calendar-times fa-4x text-muted mb-3 d-block"
                                            style="opacity:.5;"></i>

                                        <h5 class="text-muted">
                                            No Bookings Found
                                        </h5>

                                    </td>

                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- PAGINATION --}}
        @if ($bookings->hasPages())
            <div class="row mt-4">

                <div class="col-12">

                    <div
                        class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-3 bg-white rounded-4 shadow-sm">

                        <div>

                            <i class="fas fa-info-circle" style="color:#e9b35f;"></i>

                            <span class="small text-muted">

                                Showing
                                <strong>{{ $bookings->firstItem() }}</strong>
                                to
                                <strong>{{ $bookings->lastItem() }}</strong>
                                of
                                <strong>{{ $bookings->total() }}</strong>
                                bookings

                            </span>

                        </div>

                        <div>

                            {{ $bookings->onEachSide(1)->links('pagination::bootstrap-5') }}

                        </div>

                    </div>

                </div>

            </div>
        @endif

    </div>

@endsection

@push('styles')
    <style>
        .payment-badge,
        .booking-badge {
            border-radius: 20px;
            padding: 6px 12px;
            font-size: 12px;
        }

        /* PAYMENT */

        .payment-pending {
            background: #fff7ed;
            color: #ea580c;
        }

        .payment-partial {
            background: #fef9c3;
            color: #ca8a04;
        }

        .payment-paid {
            background: #dcfce7;
            color: #16a34a;
        }

        .payment-refunded {
            background: #fee2e2;
            color: #dc2626;
        }

        /* STATUS */

        .status-pending {
            background: #f1f5f9;
            color: #475569;
        }

        .status-confirmed {
            background: #dbeafe;
            color: #2563eb;
        }

        .status-in_progress {
            background: #ede9fe;
            color: #7c3aed;
        }

        .status-completed {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-cancelled,
        .status-refunded {
            background: #fee2e2;
            color: #dc2626;
        }

        .table-hover tbody tr:hover {
            background-color: #fff9ef !important;
            transition: all .2s ease;
        }

        .btn-group .btn {
            transition: all .2s ease;
        }

        .btn-group .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, .15);
        }

        .pagination .page-link {
            border-radius: 30px !important;
            margin: 0 2px;
            color: #1e2a2e;
        }

        .pagination .page-item.active .page-link {
            background: #e9b35f;
            border-color: #e9b35f;
            color: #1e2a2e;
        }
    </style>
@endpush
