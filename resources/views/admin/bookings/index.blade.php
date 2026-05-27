{{-- resources/views/admin/bookings/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manage Bookings')
@section('page-title', 'Bookings')

@push('styles')
    <style>
        /* ── Animations ── */
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(14px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .anim-card {
            animation: fadeSlideUp .35s ease both;
        }

        .anim-card:nth-child(1) {
            animation-delay: .04s;
        }

        .anim-card:nth-child(2) {
            animation-delay: .08s;
        }

        .anim-card:nth-child(3) {
            animation-delay: .12s;
        }

        .anim-card:nth-child(4) {
            animation-delay: .16s;
        }

        /* ── Filter Card ── */
        .filter-card {
            background: #fff;
            border-radius: 16px;
            padding: 20px 22px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .05);
            margin-bottom: 22px;
        }

        /* ── Form Controls ── */
        .search-wrap {
            position: relative;
        }

        .search-wrap .search-icon {
            position: absolute;
            left: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 13px;
            pointer-events: none;
        }

        .search-wrap input {
            padding-left: 38px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13.5px;
            height: 40px;
            color: #1e293b;
            width: 100%;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
        }

        .search-wrap input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .1);
        }

        .filter-select {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13.5px;
            height: 40px;
            color: #1e293b;
            padding: 0 14px;
            width: 100%;
            outline: none;
            background: #fff;
            cursor: pointer;
            transition: border-color .2s, box-shadow .2s;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 12px center;
            padding-right: 32px;
        }

        .filter-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .1);
        }

        .btn-filter {
            background: #0f1623;
            color: #fff;
            border: none;
            border-radius: 10px;
            height: 40px;
            padding: 0 20px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: background .2s, transform .15s;
            white-space: nowrap;
        }

        .btn-filter:hover {
            background: #1e3a5f;
            transform: translateY(-1px);
        }

        .btn-reset {
            background: #f1f5f9;
            color: #64748b;
            border: none;
            border-radius: 10px;
            height: 40px;
            padding: 0 16px;
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background .2s;
            white-space: nowrap;
            text-decoration: none;
        }

        .btn-reset:hover {
            background: #e2e8f0;
            color: #475569;
        }

        /* ── Table Card ── */
        .table-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .05);
            overflow: hidden;
        }

        .table-card-header {
            padding: 18px 22px;
            border-bottom: 1px solid #f3f6fa;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* ── Table ── */
        .bookings-table {
            width: 100%;
            border-collapse: collapse;
        }

        .bookings-table thead tr {
            background: #f8fafc;
            border-bottom: 2px solid #e8edf3;
        }

        .bookings-table thead th {
            padding: 13px 16px;
            font-size: 11.5px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .6px;
            white-space: nowrap;
        }

        .bookings-table thead th:first-child {
            padding-left: 22px;
        }

        .bookings-table thead th:last-child {
            padding-right: 22px;
            text-align: center;
        }

        .bookings-table tbody tr {
            border-bottom: 1px solid #f3f6fa;
            transition: background .18s;
        }

        .bookings-table tbody tr:last-child {
            border-bottom: none;
        }

        .bookings-table tbody tr:hover {
            background: #fafcff;
        }

        .bookings-table tbody td {
            padding: 14px 16px;
            font-size: 13.5px;
            color: #374151;
            vertical-align: middle;
        }

        .bookings-table tbody td:first-child {
            padding-left: 22px;
        }

        .bookings-table tbody td:last-child {
            padding-right: 22px;
        }

        /* ── Ref Badge ── */
        .ref-badge {
            background: #eff6ff;
            color: #2563eb;
            border-radius: 8px;
            padding: 5px 11px;
            font-size: 12px;
            font-weight: 700;
            font-family: monospace;
            letter-spacing: .3px;
            white-space: nowrap;
        }

        /* ── Customer Cell ── */
        .customer-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 13.5px;
            display: block;
        }

        .customer-meta {
            color: #94a3b8;
            font-size: 11.5px;
            margin-top: 1px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ── Trip Badge ── */
        .trip-badge {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            border-radius: 8px;
            padding: 5px 11px;
            font-size: 12px;
            font-weight: 600;
        }

        .trip-trek {
            background: #dbeafe;
            color: #2563eb;
        }

        .trip-package {
            background: #ede9fe;
            color: #7c3aed;
        }

        .trip-custom {
            background: #f1f5f9;
            color: #64748b;
        }

        /* ── Traveler Badge ── */
        .traveler-badge {
            background: #fef3c7;
            color: #92400e;
            border-radius: 8px;
            padding: 5px 11px;
            font-size: 12px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* ── Price ── */
        .price-amount {
            font-weight: 700;
            color: #16a34a;
            font-size: 14px;
        }

        .price-currency {
            font-size: 11px;
            color: #94a3b8;
        }

        /* ── Payment badges ── */
        .pay-badge {
            border-radius: 8px;
            padding: 5px 11px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
        }

        .pay-pending {
            background: #fff7ed;
            color: #ea580c;
        }

        .pay-partial {
            background: #fef9c3;
            color: #ca8a04;
        }

        .pay-paid {
            background: #dcfce7;
            color: #16a34a;
        }

        .pay-refunded {
            background: #fee2e2;
            color: #dc2626;
        }

        /* ── Status badges ── */
        .status-badge {
            border-radius: 8px;
            padding: 5px 11px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            white-space: nowrap;
        }

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

        /* ── Action Buttons ── */
        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            transition: transform .15s, box-shadow .15s;
            text-decoration: none;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, .12);
        }

        .action-btn-view {
            background: #e0f2fe;
            color: #0284c7;
        }

        .action-btn-edit {
            background: #fef9c3;
            color: #92400e;
        }

        /* ── Empty State ── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-state-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 28px;
            color: #94a3b8;
        }

        /* ── Alert ── */
        .alert-success-custom {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 4px solid #16a34a;
            border-radius: 12px;
            padding: 14px 18px;
            color: #166534;
            font-size: 13.5px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            position: relative;
        }

        .alert-close {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #166534;
            cursor: pointer;
            font-size: 16px;
            opacity: .6;
        }

        .alert-close:hover {
            opacity: 1;
        }

        /* ── Pagination ── */
        .pagination-wrap {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #f0f4f8;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 18px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .04);
        }

        .pagination-info {
            font-size: 13px;
            color: #64748b;
        }

        .pagination-info strong {
            color: #1e293b;
        }

        /* ── Mobile Cards ── */
        .mobile-booking-card {
            background: #fff;
            border: 1px solid #f0f4f8;
            border-radius: 14px;
            padding: 16px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .04);
            display: none;
            flex-direction: column;
            gap: 12px;
            margin-bottom: 10px;
        }

        .mobile-card-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
        }

        .mobile-card-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 8px;
            font-size: 13px;
        }

        .mobile-card-label {
            color: #94a3b8;
            font-size: 11.5px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .4px;
        }

        .mobile-card-actions {
            display: flex;
            gap: 8px;
            justify-content: flex-end;
        }

        /* ── Responsive ── */
        @media(max-width:1024px) {

            .bookings-table thead th:nth-child(8),
            .bookings-table tbody td:nth-child(8) {
                display: none;
            }

            /* hide date on tablet */
        }

        @media(max-width:768px) {
            .table-responsive-hide {
                display: none !important;
            }

            .mobile-booking-card {
                display: flex !important;
            }

            .filter-card {
                padding: 16px;
            }

            .filter-grid {
                grid-template-columns: 1fr !important;
            }

            .table-card-header {
                padding: 14px 16px;
            }
        }

        @media(max-width:480px) {
            .pagination-wrap {
                flex-direction: column;
                align-items: flex-start;
            }
        }
    </style>
@endpush

@section('content')

    {{-- ── PAGE HEADER ── --}}
    <div class="anim-card"
        style="display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-bottom:22px;">
        <div>
            <h4 style="color:#1e293b;font-weight:800;font-size:20px;margin:0 0 4px;">
                <i class="fas fa-calendar-check" style="color:#3b82f6;margin-right:8px;"></i>
                Booking Management
            </h4>
            <p style="color:#94a3b8;font-size:13px;margin:0;">
                <i class="fas fa-database" style="margin-right:4px;"></i>
                <strong style="color:#64748b;">{{ $bookings->total() }}</strong> total bookings &nbsp;·&nbsp;
                Page <strong style="color:#64748b;">{{ $bookings->currentPage() }}</strong> of
                <strong style="color:#64748b;">{{ $bookings->lastPage() }}</strong>
            </p>
        </div>
    </div>

    {{-- ── SUCCESS ALERT ── --}}
    @if (session('success'))
        <div class="alert-success-custom anim-card">
            <i class="fas fa-check-circle" style="font-size:16px;flex-shrink:0;"></i>
            <span>{{ session('success') }}</span>
            <button class="alert-close" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    {{-- ── FILTER BAR ── --}}
    <div class="filter-card anim-card">
        <form method="GET" action="{{ route('admin.bookings.index') }}">
            <div class="filter-grid"
                style="display:grid;grid-template-columns:1fr 1fr 1fr auto auto;gap:12px;align-items:end;">

                {{-- Search --}}
                <div>
                    <label
                        style="font-size:11.5px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:6px;">Search</label>
                    <div class="search-wrap">
                        <i class="fas fa-search search-icon"></i>
                        <input type="text" name="search" placeholder="Booking ref, customer..."
                            value="{{ request('search') }}">
                    </div>
                </div>

                {{-- Booking Status --}}
                <div>
                    <label
                        style="font-size:11.5px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:6px;">Booking
                        Status</label>
                    <select name="status" class="filter-select">
                        <option value="">All Statuses</option>
                        @foreach (\App\Models\Booking::BOOKING_STATUSES as $key => $label)
                            <option value="{{ $key }}" {{ request('status') == $key ? 'selected' : '' }}>
                                {{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Payment Status --}}
                <div>
                    <label
                        style="font-size:11.5px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.5px;display:block;margin-bottom:6px;">Payment
                        Status</label>
                    <select name="payment" class="filter-select">
                        <option value="">All Payments</option>
                        @foreach (\App\Models\Booking::PAYMENT_STATUSES as $payment)
                            <option value="{{ $payment }}" {{ request('payment') == $payment ? 'selected' : '' }}>
                                {{ ucfirst($payment) }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Filter Button --}}
                <div>
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>

                {{-- Reset Button --}}
                <div>
                    <a href="{{ route('admin.bookings.index') }}" class="btn-reset">
                        <i class="fas fa-times"></i> Reset
                    </a>
                </div>

            </div>
        </form>
    </div>

    {{-- ── BOOKINGS TABLE ── --}}
    <div class="table-card anim-card">

        <div class="table-card-header">
            <div style="font-weight:700;font-size:14px;color:#1e293b;display:flex;align-items:center;gap:8px;">
                <span style="width:8px;height:8px;border-radius:50%;background:#3b82f6;display:inline-block;"></span>
                All Bookings
            </div>
            @if (request()->hasAny(['search', 'status', 'payment']))
                <span
                    style="background:#fef3c7;color:#92400e;border-radius:20px;padding:4px 12px;font-size:12px;font-weight:600;">
                    <i class="fas fa-filter" style="margin-right:4px;"></i> Filters Active
                </span>
            @endif
        </div>

        {{-- DESKTOP TABLE --}}
        <div class="table-responsive-hide" style="overflow-x:auto;">
            <table class="bookings-table">
                <thead>
                    <tr>
                        <th>Ref #</th>
                        <th>Customer</th>
                        <th>Trip</th>
                        <th>Travelers</th>
                        <th>Total</th>
                        <th>Payment</th>
                        <th>Status</th>
                        <th>Date</th>
                        <th style="text-align:center;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($bookings as $booking)
                        <tr>
                            {{-- Ref --}}
                            <td>
                                <span class="ref-badge">{{ $booking->booking_ref }}</span>
                            </td>

                            {{-- Customer --}}
                            <td>
                                <span class="customer-name">{{ $booking->full_name }}</span>
                                <span class="customer-meta">
                                    <i class="fas fa-envelope" style="font-size:10px;"></i> {{ $booking->email }}
                                </span>
                                <span class="customer-meta">
                                    <i class="fas fa-phone" style="font-size:10px;"></i> {{ $booking->phone }}
                                </span>
                            </td>

                            {{-- Trip --}}
                            <td>
                                @if ($booking->trek)
                                    <span class="trip-badge trip-trek">
                                        <i class="fas fa-hiking"></i> {{ Str::limit($booking->trek->name, 22) }}
                                    </span>
                                @elseif($booking->package)
                                    <span class="trip-badge trip-package">
                                        <i class="fas fa-box-open"></i> {{ Str::limit($booking->package->name, 22) }}
                                    </span>
                                @else
                                    <span class="trip-badge trip-custom">
                                        <i class="fas fa-route"></i> Custom Trip
                                    </span>
                                @endif
                            </td>

                            {{-- Travelers --}}
                            <td>
                                <span class="traveler-badge">
                                    <i class="fas fa-users"></i> {{ $booking->num_adults }}
                                    Adult{{ $booking->num_adults > 1 ? 's' : '' }}
                                </span>
                                @if ($booking->num_children > 0)
                                    <div style="margin-top:4px;font-size:11.5px;color:#94a3b8;">
                                        + {{ $booking->num_children }} child{{ $booking->num_children > 1 ? 'ren' : '' }}
                                    </div>
                                @endif
                            </td>

                            {{-- Total --}}
                            <td>
                                <div class="price-amount">{{ number_format($booking->total_price, 2) }}</div>
                                <div class="price-currency">{{ $booking->currency }}</div>
                            </td>

                            {{-- Payment --}}
                            <td>
                                <span class="pay-badge pay-{{ $booking->payment_status }}">
                                    {{ ucfirst($booking->payment_status) }}
                                </span>
                            </td>

                            {{-- Status --}}
                            <td>
                                <span class="status-badge status-{{ $booking->status }}">
                                    {{ \App\Models\Booking::BOOKING_STATUSES[$booking->status] ?? ucfirst($booking->status) }}
                                </span>
                            </td>

                            {{-- Date --}}
                            <td style="color:#94a3b8;font-size:12.5px;white-space:nowrap;">
                                <i class="fas fa-calendar-alt" style="margin-right:5px;color:#cbd5e1;"></i>
                                {{ $booking->created_at->format('M d, Y') }}
                            </td>

                            {{-- Actions --}}
                            <td style="text-align:center;">
                                <div style="display:flex;gap:6px;justify-content:center;">

                                    <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                        class="action-btn action-btn-view" title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.bookings.edit', $booking->id) }}"
                                        class="action-btn action-btn-edit" title="Edit">
                                        <i class="fas fa-pen"></i>
                                    </a>

                                    <form action="{{ route('admin.bookings.destroy', $booking->id) }}" method="POST"
                                        onsubmit="return confirm('Are you sure?')">

                                        @csrf
                                        @method('DELETE')

                                        <button type="submit" class="action-btn action-btn-delete" title="Delete"
                                            style="border:none;background:none;cursor:pointer;">

                                            <i class="fas fa-trash"></i>

                                        </button>

                                    </form>

                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="9">
                                <div class="empty-state">
                                    <div class="empty-state-icon">
                                        <i class="fas fa-calendar-times"></i>
                                    </div>
                                    <h5 style="color:#374151;font-weight:700;margin-bottom:6px;">No Bookings Found</h5>
                                    <p style="color:#94a3b8;font-size:13.5px;margin:0;">
                                        {{ request()->hasAny(['search', 'status', 'payment']) ? 'Try adjusting your filters.' : 'No bookings have been made yet.' }}
                                    </p>
                                    @if (request()->hasAny(['search', 'status', 'payment']))
                                        <a href="{{ route('admin.bookings.index') }}" class="btn-reset"
                                            style="margin-top:16px;display:inline-flex;">
                                            <i class="fas fa-times"></i> Clear Filters
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- MOBILE CARDS --}}
        <div style="padding:12px;" id="mobileCards">
            @forelse($bookings as $booking)
                <div class="mobile-booking-card">
                    <div class="mobile-card-header">
                        <span class="ref-badge">{{ $booking->booking_ref }}</span>
                        <span style="color:#94a3b8;font-size:11.5px;">{{ $booking->created_at->format('M d, Y') }}</span>
                    </div>

                    <div>
                        <div class="customer-name">{{ $booking->full_name }}</div>
                        <div class="customer-meta"><i class="fas fa-envelope" style="font-size:10px;"></i>
                            {{ $booking->email }}</div>
                        <div class="customer-meta"><i class="fas fa-phone" style="font-size:10px;"></i>
                            {{ $booking->phone }}</div>
                    </div>

                    <div class="mobile-card-row">
                        <div>
                            <div class="mobile-card-label">Trip</div>
                            @if ($booking->trek)
                                <span class="trip-badge trip-trek" style="margin-top:4px;">
                                    <i class="fas fa-hiking"></i> {{ Str::limit($booking->trek->name, 20) }}
                                </span>
                            @elseif($booking->package)
                                <span class="trip-badge trip-package" style="margin-top:4px;">
                                    <i class="fas fa-box-open"></i> {{ Str::limit($booking->package->name, 20) }}
                                </span>
                            @else
                                <span class="trip-badge trip-custom" style="margin-top:4px;"><i class="fas fa-route"></i>
                                    Custom Trip</span>
                            @endif
                        </div>
                        <div style="text-align:right;">
                            <div class="mobile-card-label">Travelers</div>
                            <span class="traveler-badge" style="margin-top:4px;">
                                <i class="fas fa-users"></i> {{ $booking->num_adults }}
                                Adult{{ $booking->num_adults > 1 ? 's' : '' }}
                            </span>
                        </div>
                    </div>

                    <div class="mobile-card-row">
                        <div>
                            <div class="mobile-card-label">Total</div>
                            <div class="price-amount" style="margin-top:4px;">{{ $booking->currency }}
                                {{ number_format($booking->total_price, 2) }}</div>
                        </div>
                        <div style="text-align:right;">
                            <div class="mobile-card-label">Payment</div>
                            <span class="pay-badge pay-{{ $booking->payment_status }}"
                                style="margin-top:4px;display:inline-block;">{{ ucfirst($booking->payment_status) }}</span>
                        </div>
                    </div>

                    <div class="mobile-card-row">
                        <div>
                            <div class="mobile-card-label">Status</div>
                            <span class="status-badge status-{{ $booking->status }}"
                                style="margin-top:4px;display:inline-block;">
                                {{ \App\Models\Booking::BOOKING_STATUSES[$booking->status] ?? ucfirst($booking->status) }}
                            </span>
                        </div>
                        <div class="mobile-card-actions">
                            <a href="{{ route('admin.bookings.show', $booking->id) }}"
                                class="action-btn action-btn-view">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('admin.bookings.edit', $booking->id) }}"
                                class="action-btn action-btn-edit">
                                <i class="fas fa-pen"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <div class="empty-state-icon"><i class="fas fa-calendar-times"></i></div>
                    <h5 style="color:#374151;font-weight:700;margin-bottom:6px;">No Bookings Found</h5>
                    <p style="color:#94a3b8;font-size:13.5px;margin:0;">Try adjusting your filters.</p>
                </div>
            @endforelse
        </div>

    </div>

    {{-- ── PAGINATION ── --}}
    @if ($bookings->hasPages())
        <div class="pagination-wrap anim-card">
            <div class="pagination-info">
                <i class="fas fa-info-circle" style="color:#3b82f6;margin-right:5px;"></i>
                Showing <strong>{{ $bookings->firstItem() }}</strong>–<strong>{{ $bookings->lastItem() }}</strong>
                of <strong>{{ $bookings->total() }}</strong> bookings
            </div>
            <div>
                {{ $bookings->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif

@endsection

@push('styles')
    <style>
        /* Pagination overrides to match our style */
        .pagination {
            margin: 0;
            gap: 4px;
        }

        .page-link {
            border-radius: 8px !important;
            border: 1px solid #e2e8f0 !important;
            color: #374151 !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            padding: 6px 12px !important;
            transition: all .15s !important;
            line-height: 1.5 !important;
        }

        .page-link:hover {
            background: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
        }

        .page-item.active .page-link {
            background: #3b82f6 !important;
            border-color: #3b82f6 !important;
            color: #fff !important;
        }

        .page-item.disabled .page-link {
            opacity: .45;
        }
    </style>
@endpush
