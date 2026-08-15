@extends('layouts.admin')

@section('title', 'Booking ' . $booking->booking_ref)
@section('page_title', 'Booking Details')
@section('page_icon', 'fas fa-eye')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Sora:wght@300;400;500;600;700;800&family=JetBrains+Mono:wght@400;500&display=swap');

        :root {
            --ink: #0f1923;
            --ink-2: #1e2d3d;
            --ink-3: #2e4057;
            --slate: #64748b;
            --slate-lt: #94a3b8;
            --line: #e2e8f0;
            --line-2: #f1f5f9;
            --surface: #ffffff;
            --surface-2: #f8fafc;
            --blue: #1a6fc4;
            --blue-lt: #e8f2fd;
            --gold: #d4940a;
            --gold-lt: #fef3c7;
            --green: #16a34a;
            --green-lt: #dcfce7;
            --red: #dc2626;
            --red-lt: #fee2e2;
            --amber: #d97706;
            --amber-lt: #fef3c7;
            --r: 14px;
            --r-sm: 8px;
            --sh: 0 1px 3px rgba(15, 25, 35, .06), 0 1px 2px rgba(15, 25, 35, .04);
            --sh-md: 0 4px 16px rgba(15, 25, 35, .08), 0 1px 4px rgba(15, 25, 35, .04);
            --sh-lg: 0 20px 48px rgba(15, 25, 35, .10), 0 4px 12px rgba(15, 25, 35, .06);
            --ease: .2s cubic-bezier(.4, 0, .2, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        .bk-page {
            font-family: 'Sora', sans-serif;
            color: var(--ink);
            padding-bottom: 60px;
        }

        /* ── Page header ── */
        .bk-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 28px;
        }

        .bk-topbar-left h1 {
            font-size: clamp(18px, 2.5vw, 22px);
            font-weight: 700;
            color: var(--ink);
            margin: 0 0 2px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bk-topbar-left h1 i {
            color: var(--gold);
            font-size: 18px;
        }

        .bk-ref {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: var(--blue);
            background: var(--blue-lt);
            border-radius: 50px;
            padding: 2px 10px;
            font-weight: 500;
            display: inline-block;
        }

        .bk-topbar-right {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

        .btn-back {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            border: 1.5px solid var(--line);
            border-radius: 50px;
            background: var(--surface);
            color: var(--ink-2);
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all var(--ease);
        }

        .btn-back:hover {
            border-color: var(--blue);
            color: var(--blue);
        }

        .btn-edit {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 9px 20px;
            border-radius: 50px;
            background: linear-gradient(135deg, var(--blue), #1255a0);
            border: none;
            color: #fff;
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(26, 111, 196, .28);
            transition: all var(--ease);
        }

        .btn-edit:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26, 111, 196, .38);
            color: #fff;
        }

        /* ── Status banner ── */
        .bk-status-banner {
            border-radius: var(--r);
            padding: 16px 24px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 24px;
        }

        .bk-status-banner.paid {
            background: var(--green-lt);
            border-left: 4px solid var(--green);
        }

        .bk-status-banner.pending {
            background: var(--amber-lt);
            border-left: 4px solid var(--amber);
        }

        .bk-status-banner.partial {
            background: var(--blue-lt);
            border-left: 4px solid var(--blue);
        }

        .bk-status-banner.refunded {
            background: var(--red-lt);
            border-left: 4px solid var(--red);
        }

        .bk-status-banner .banner-msg {
            font-size: 13px;
            font-weight: 600;
            color: var(--ink-2);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .bk-status-banner .banner-msg i {
            font-size: 15px;
        }

        .bk-status-banner.paid .banner-msg i {
            color: var(--green);
        }

        .bk-status-banner.pending .banner-msg i {
            color: var(--amber);
        }

        .bk-status-banner.partial .banner-msg i {
            color: var(--blue);
        }

        .bk-status-banner.refunded .banner-msg i {
            color: var(--red);
        }

        .bk-status-banner .banner-date {
            font-size: 12px;
            color: var(--slate);
        }

        /* ── Layout grid ── */
        .bk-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 20px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .bk-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── Card base ── */
        .bk-card {
            background: var(--surface);
            border-radius: var(--r);
            box-shadow: var(--sh-md);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .bk-card:last-child {
            margin-bottom: 0;
        }

        .bk-card-head {
            padding: 16px 24px;
            border-bottom: 1px solid var(--line-2);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .bk-card-head .head-icon {
            width: 32px;
            height: 32px;
            border-radius: var(--r-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .icon-blue {
            background: var(--blue-lt);
            color: var(--blue);
        }

        .icon-green {
            background: var(--green-lt);
            color: var(--green);
        }

        .icon-gold {
            background: var(--gold-lt);
            color: var(--gold);
        }

        .icon-slate {
            background: var(--line-2);
            color: var(--slate);
        }

        .bk-card-head h2 {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
            margin: 0;
            text-transform: uppercase;
            letter-spacing: .7px;
        }

        .bk-card-body {
            padding: 20px 24px;
        }

        /* ── Info rows ── */
        .info-row {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
            padding: 11px 0;
            border-bottom: 1px solid var(--line-2);
        }

        .info-row:last-child {
            border-bottom: none;
        }

        .info-label {
            font-size: 11px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: var(--slate-lt);
            white-space: nowrap;
            flex-shrink: 0;
            width: 38%;
        }

        .info-value {
            font-size: 13px;
            font-weight: 500;
            color: var(--ink);
            text-align: right;
            word-break: break-word;
        }

        .info-value.mono {
            font-family: 'JetBrains Mono', monospace;
            font-size: 12px;
            color: var(--blue);
        }

        /* ── Pill badges ── */
        .pill {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            padding: 3px 11px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
        }

        .pill i {
            font-size: 9px;
        }

        .pill-green {
            background: var(--green-lt);
            color: var(--green);
        }

        .pill-blue {
            background: var(--blue-lt);
            color: var(--blue);
        }

        .pill-amber {
            background: var(--amber-lt);
            color: var(--amber);
        }

        .pill-red {
            background: var(--red-lt);
            color: var(--red);
        }

        .pill-slate {
            background: var(--line-2);
            color: var(--slate);
        }

        .pill-ink {
            background: #e2e8f0;
            color: var(--ink-2);
        }

        /* ── Amount display ── */
        .amount-big {
            font-size: 26px;
            font-weight: 800;
            color: var(--ink);
            line-height: 1;
        }

        .amount-big span {
            font-size: 13px;
            font-weight: 500;
            color: var(--slate-lt);
            margin-right: 3px;
        }

        /* ── Side cards ── */
        .side-amount-card {
            background: linear-gradient(135deg, var(--ink) 0%, var(--ink-2) 100%);
            border-radius: var(--r);
            padding: 24px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .side-amount-card::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, .04);
            border-radius: 50%;
        }

        .side-amount-card::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: -20px;
            width: 80px;
            height: 80px;
            background: rgba(212, 148, 10, .08);
            border-radius: 50%;
        }

        .sam-label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: rgba(255, 255, 255, .4);
            margin-bottom: 6px;
        }

        .sam-amount {
            font-size: 32px;
            font-weight: 800;
            color: #fff;
            line-height: 1;
            margin-bottom: 4px;
        }

        .sam-amount small {
            font-size: 14px;
            color: rgba(255, 255, 255, .4);
            font-weight: 400;
            margin-right: 4px;
        }

        .sam-sub {
            font-size: 12px;
            color: rgba(255, 255, 255, .35);
        }

        .sam-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, .08);
            margin: 16px 0;
        }

        .sam-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            margin-bottom: 8px;
        }

        .sam-row:last-child {
            margin-bottom: 0;
        }

        .sam-row .sr-label {
            color: rgba(255, 255, 255, .35);
        }

        .sam-row .sr-value {
            color: rgba(255, 255, 255, .75);
            font-weight: 600;
        }

        .sam-row .sr-value.gold {
            color: #fbbf24;
        }

        /* ── Quick actions ── */
        .quick-actions {
            background: var(--surface);
            border-radius: var(--r);
            box-shadow: var(--sh-md);
            overflow: hidden;
        }

        .qa-head {
            padding: 14px 20px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: var(--slate);
            border-bottom: 1px solid var(--line-2);
        }

        .qa-body {
            padding: 12px;
        }

        .qa-btn {
            display: flex;
            align-items: center;
            gap: 10px;
            width: 100%;
            padding: 11px 14px;
            border-radius: var(--r-sm);
            border: none;
            background: transparent;
            font-family: 'Sora', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: var(--ink-2);
            cursor: pointer;
            text-decoration: none;
            transition: all var(--ease);
            margin-bottom: 4px;
        }

        .qa-btn:last-child {
            margin-bottom: 0;
        }

        .qa-btn .qa-icon {
            width: 30px;
            height: 30px;
            border-radius: var(--r-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            flex-shrink: 0;
            transition: all var(--ease);
        }

        .qa-btn:hover {
            background: var(--surface-2);
            color: var(--ink);
        }

        .qa-btn.qa-edit .qa-icon {
            background: var(--blue-lt);
            color: var(--blue);
        }

        .qa-btn.qa-conf .qa-icon {
            background: var(--green-lt);
            color: var(--green);
        }

        .qa-btn.qa-cancel .qa-icon {
            background: var(--red-lt);
            color: var(--red);
        }

        .qa-btn.qa-dl .qa-icon {
            background: var(--gold-lt);
            color: var(--gold);
        }

        /* ── Notes box ── */
        .notes-box {
            background: var(--gold-lt);
            border-left: 4px solid var(--gold);
            border-radius: 0 var(--r-sm) var(--r-sm) 0;
            padding: 14px 16px;
            font-size: 13px;
            color: #78350f;
            line-height: 1.65;
        }

        .notes-empty {
            font-size: 13px;
            color: var(--slate-lt);
            font-style: italic;
        }

        /* ── Booking type chip ── */
        .type-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .5px;
            background: var(--line-2);
            color: var(--ink-2);
        }

        /* ── Responsive tweaks ── */
        @media (max-width: 576px) {
            .bk-card-body {
                padding: 16px;
            }

            .bk-card-head {
                padding: 14px 16px;
            }

            .info-label {
                width: 42%;
                font-size: 10px;
            }

            .side-amount-card {
                padding: 18px;
            }

            .sam-amount {
                font-size: 26px;
            }

            .bk-topbar {
                gap: 10px;
            }
        }
    </style>
@endpush

@section('content')

    @php
        $payStatus = $booking->payment_status ?? 'pending';
        $bookStatus = $booking->status ?? 'pending';

        $payPill = match ($payStatus) {
            'paid' => ['pill-green', 'fa-check-circle', 'Paid'],
            'partial' => ['pill-blue', 'fa-adjust', 'Partial'],
            'refunded' => ['pill-red', 'fa-undo', 'Refunded'],
            default => ['pill-amber', 'fa-clock', 'Pending'],
        };

        $bookPill = match ($bookStatus) {
            'confirmed' => ['pill-green', 'fa-check', 'Confirmed'],
            'in_progress' => ['pill-blue', 'fa-spinner', 'In Progress'],
            'completed' => ['pill-ink', 'fa-flag-checkered', 'Completed'],
            'cancelled' => ['pill-red', 'fa-times-circle', 'Cancelled'],
            'refunded' => ['pill-red', 'fa-undo', 'Refunded'],
            default => ['pill-amber', 'fa-hourglass-half', 'Pending'],
        };

        $bannerClass = match ($payStatus) {
            'paid' => 'paid',
            'partial' => 'partial',
            'refunded' => 'refunded',
            default => 'pending',
        };

        $itemName = '—';
        if ($booking->booking_type === 'package' && $booking->package) {
            $itemName = $booking->package->name;
        } elseif ($booking->booking_type === 'trek' && $booking->trek) {
            $itemName = $booking->trek->name;
        } elseif ($booking->booking_type === 'custom') {
            $itemName = 'Custom Request';
        }
    @endphp

    <div class="bk-page">

        {{-- Top bar --}}
        <div class="bk-topbar">
            <div class="bk-topbar-left">
                <h1>
                    <i class="fas fa-receipt"></i>
                    Booking Details
                </h1>
                <span class="bk-ref">{{ $booking->booking_ref }}</span>
            </div>
            <div class="bk-topbar-right">
                <a href="{{ route('admin.bookings.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> All Bookings
                </a>
                <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="btn-edit">
                    <i class="fas fa-pen"></i> Edit
                </a>
            </div>
        </div>

        {{-- Status banner --}}
        <div class="bk-status-banner {{ $bannerClass }}">
            <div class="banner-msg">
                @if ($payStatus === 'paid')
                    <i class="fas fa-check-circle"></i> Payment confirmed — this booking has been paid in full.
                @elseif($payStatus === 'partial')
                    <i class="fas fa-adjust"></i> Partial payment received — balance outstanding.
                @elseif($payStatus === 'refunded')
                    <i class="fas fa-undo"></i> This booking has been refunded.
                @else
                    <i class="fas fa-hourglass-half"></i> Payment pending — awaiting confirmation.
                @endif
            </div>
            <div class="banner-date">
                Booked {{ $booking->created_at->diffForHumans() }} &nbsp;·&nbsp; {{ $booking->created_at->format('d M Y') }}
            </div>
        </div>

        {{-- Main grid --}}
        <div class="bk-grid">

            {{-- LEFT column --}}
            <div>

                {{-- Traveler details --}}
                <div class="bk-card">
                    <div class="bk-card-head">
                        <div class="head-icon icon-blue"><i class="fas fa-user"></i></div>
                        <h2>Traveler Details</h2>
                    </div>
                    <div class="bk-card-body">
                        <div class="info-row">
                            <span class="info-label">Full Name</span>
                            <span class="info-value" style="font-weight:700;">{{ $booking->first_name }}
                                {{ $booking->last_name }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Email</span>
                            <span class="info-value">
                                <a href="mailto:{{ $booking->email }}"
                                    style="color:var(--blue);text-decoration:none;">{{ $booking->email }}</a>
                            </span>
                        </div>
                        @if ($booking->phone)
                            <div class="info-row">
                                <span class="info-label">Phone</span>
                                <span class="info-value">{{ $booking->phone }}</span>
                            </div>
                        @endif
                        @if ($booking->nationality)
                            <div class="info-row">
                                <span class="info-label">Nationality</span>
                                <span class="info-value">{{ $booking->nationality }}</span>
                            </div>
                        @endif
                        @if ($booking->passport_number)
                            <div class="info-row">
                                <span class="info-label">Passport No.</span>
                                <span class="info-value mono">{{ $booking->passport_number }}</span>
                            </div>
                        @endif
                        @if ($booking->date_of_birth)
                            <div class="info-row">
                                <span class="info-label">Date of Birth</span>
                                <span class="info-value">{{ $booking->date_of_birth->format('d M Y') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Trip details --}}
                <div class="bk-card">
                    <div class="bk-card-head">
                        <div class="head-icon icon-gold"><i class="fas fa-mountain"></i></div>
                        <h2>Trip Details</h2>
                    </div>
                    <div class="bk-card-body">
                        <div class="info-row">
                            <span class="info-label">Booking Type</span>
                            <span class="info-value">
                                <span class="type-chip">
                                    <i class="fas fa-tag" style="font-size:9px;"></i>
                                    {{ \App\Models\Booking::BOOKING_TYPES[$booking->booking_type] ?? ucfirst($booking->booking_type) }}
                                </span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Package / Trek</span>
                            <span class="info-value" style="font-weight:700;">{{ $itemName }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Trip Dates</span>
                            <span class="info-value">
                                @if ($booking->trip_start_date && $booking->trip_end_date)
                                    {{ $booking->trip_start_date->format('d M Y') }}
                                    <span style="color:var(--slate-lt);margin:0 4px;">→</span>
                                    {{ $booking->trip_end_date->format('d M Y') }}
                                @else
                                    <span style="color:var(--slate-lt);">Not set</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Travelers</span>
                            <span class="info-value">
                                {{ $booking->num_adults }} Adult{{ $booking->num_adults != 1 ? 's' : '' }}
                                @if ($booking->num_children > 0)
                                    &nbsp;·&nbsp; {{ $booking->num_children }}
                                    Child{{ $booking->num_children != 1 ? 'ren' : '' }}
                                @endif
                            </span>
                        </div>
                        @if ($booking->accommodation_preference)
                            <div class="info-row">
                                <span class="info-label">Accommodation</span>
                                <span class="info-value">{{ ucfirst($booking->accommodation_preference) }}</span>
                            </div>
                        @endif
                        @if ($booking->pickup_location)
                            <div class="info-row">
                                <span class="info-label">Pickup</span>
                                <span class="info-value">{{ $booking->pickup_location }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Payment details --}}
                <div class="bk-card">
                    <div class="bk-card-head">
                        <div class="head-icon icon-green"><i class="fas fa-credit-card"></i></div>
                        <h2>Payment Details</h2>
                    </div>
                    <div class="bk-card-body">
                        <div class="info-row">
                            <span class="info-label">Base Price</span>
                            <span class="info-value">{{ $booking->currency ?? 'USD' }}
                                {{ number_format($booking->base_price, 2) }} / person</span>
                        </div>
                        @if ($booking->discount_amount > 0)
                            <div class="info-row">
                                <span class="info-label">Discount</span>
                                <span class="info-value" style="color:var(--green);">− {{ $booking->currency ?? 'USD' }}
                                    {{ number_format($booking->discount_amount, 2) }}</span>
                            </div>
                        @endif
                        <div class="info-row">
                            <span class="info-label">Total Price</span>
                            <span class="info-value"
                                style="font-size:17px;font-weight:800;color:var(--blue);">{{ $booking->currency ?? 'USD' }}
                                {{ number_format($booking->total_price, 2) }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Amount Paid</span>
                            <span class="info-value"
                                style="color:var(--green);font-weight:700;">{{ $booking->currency ?? 'USD' }}
                                {{ number_format($booking->amount_paid, 2) }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Method</span>
                            <span class="info-value">{{ ucfirst($booking->payment_method ?? '—') }}</span>
                        </div>
                        @if ($booking->transaction_id)
                            <div class="info-row">
                                <span class="info-label">Transaction ID</span>
                                <span class="info-value mono">{{ $booking->transaction_id }}</span>
                            </div>
                        @endif
                        @if ($booking->paid_at)
                            <div class="info-row">
                                <span class="info-label">Paid At</span>
                                <span class="info-value">{{ $booking->paid_at->format('d M Y, h:i A') }}</span>
                            </div>
                        @endif
                        <div class="info-row">
                            <span class="info-label">Payment Status</span>
                            <span class="info-value">
                                <span class="pill {{ $payPill[0] }}">
                                    <i class="fas {{ $payPill[1] }}"></i> {{ $payPill[2] }}
                                </span>
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Booking Status</span>
                            <span class="info-value">
                                <span class="pill {{ $bookPill[0] }}">
                                    <i class="fas {{ $bookPill[1] }}"></i> {{ $bookPill[2] }}
                                </span>
                            </span>
                        </div>
                        @if ($booking->confirmed_at)
                            <div class="info-row">
                                <span class="info-label">Confirmed At</span>
                                <span class="info-value">{{ $booking->confirmed_at->format('d M Y, h:i A') }}</span>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Admin notes --}}
                <div class="bk-card">
                    <div class="bk-card-head">
                        <div class="head-icon icon-slate"><i class="fas fa-sticky-note"></i></div>
                        <h2>Admin Notes</h2>
                    </div>
                    <div class="bk-card-body">
                        @if ($booking->admin_notes)
                            <div class="notes-box">{{ $booking->admin_notes }}</div>
                        @else
                            <p class="notes-empty">No notes have been added yet.</p>
                        @endif

                        @if ($booking->special_requirements)
                            <div style="margin-top:14px;">
                                <div
                                    style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:var(--slate-lt);margin-bottom:8px;">
                                    Special Requirements</div>
                                <div class="notes-box"
                                    style="border-color:#d4940a;background:var(--gold-lt);color:#78350f;">
                                    {{ $booking->special_requirements }}</div>
                            </div>
                        @endif

                        @if ($booking->cancellation_reason)
                            <div style="margin-top:14px;">
                                <div
                                    style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.7px;color:var(--slate-lt);margin-bottom:8px;">
                                    Cancellation Reason</div>
                                <div class="notes-box"
                                    style="border-color:var(--red);background:var(--red-lt);color:#7f1d1d;">
                                    {{ $booking->cancellation_reason }}</div>
                            </div>
                        @endif
                    </div>
                </div>

            </div>

            {{-- RIGHT column --}}
            <div>

                {{-- Amount card --}}
                <div class="side-amount-card">
                    <div class="sam-label">Total Amount</div>
                    <div class="sam-amount">
                        <small>{{ $booking->currency ?? 'USD' }}</small>{{ number_format($booking->total_price, 2) }}
                    </div>
                    <div class="sam-sub">{{ $booking->num_adults }} adult(s) × {{ $booking->currency ?? 'USD' }}
                        {{ number_format($booking->base_price, 2) }}</div>

                    <hr class="sam-divider">

                    <div class="sam-row">
                        <span class="sr-label">Payment Status</span>
                        <span class="sr-value gold">{{ ucfirst($payStatus) }}</span>
                    </div>
                    <div class="sam-row">
                        <span class="sr-label">Booking Status</span>
                        <span class="sr-value">{{ ucfirst(str_replace('_', ' ', $bookStatus)) }}</span>
                    </div>
                    <div class="sam-row">
                        <span class="sr-label">Amount Paid</span>
                        <span class="sr-value">{{ $booking->currency ?? 'USD' }}
                            {{ number_format($booking->amount_paid, 2) }}</span>
                    </div>
                    @if ($booking->discount_amount > 0)
                        <div class="sam-row">
                            <span class="sr-label">Discount</span>
                            <span class="sr-value" style="color:#4ade80;">−
                                {{ number_format($booking->discount_amount, 2) }}</span>
                        </div>
                    @endif
                </div>

                {{-- Quick actions --}}
                <div class="quick-actions">
                    <div class="qa-head">Quick Actions</div>
                    <div class="qa-body">
                        <a href="{{ route('admin.bookings.edit', $booking->id) }}" class="qa-btn qa-edit">
                            <span class="qa-icon"><i class="fas fa-pen"></i></span>
                            Edit Booking
                        </a>

                        @if ($booking->status !== 'confirmed' && $booking->status !== 'cancelled')
                            <form method="POST" action="{{ route('admin.bookings.confirm', $booking->id) }}"
                                style="margin:0;">
                                @csrf
                                <button type="submit" class="qa-btn qa-conf">
                                    <span class="qa-icon"><i class="fas fa-check"></i></span>
                                    Confirm Booking
                                </button>
                            </form>
                        @endif

                        @if ($booking->status !== 'cancelled')
                            <button type="button" class="qa-btn qa-cancel"
                                onclick="document.getElementById('cancelModal').style.display='flex'">
                                <span class="qa-icon"><i class="fas fa-times"></i></span>
                                Cancel Booking
                            </button>
                        @endif

                        <a href="{{ route('booking.invoice', $booking->booking_ref) }}" class="qa-btn qa-dl"
                            target="_blank">
                            <span class="qa-icon"><i class="fas fa-download"></i></span>
                            Download Invoice
                        </a>
                    </div>
                </div>

            </div>

        </div>

    </div>

    {{-- Cancel modal --}}
    <div id="cancelModal"
        style="display:none;position:fixed;inset:0;background:rgba(15,25,35,.55);z-index:9999;align-items:center;justify-content:center;padding:20px;">
        <div
            style="background:#fff;border-radius:16px;padding:28px;max-width:440px;width:100%;box-shadow:0 24px 64px rgba(0,0,0,.18);">
            <h3 style="font-family:'Sora',sans-serif;font-size:17px;font-weight:700;color:#0f1923;margin-bottom:6px;">
                Cancel this booking?</h3>
            <p style="font-size:13px;color:#64748b;margin-bottom:18px;line-height:1.6;">Please provide a reason. This
                action cannot be undone.</p>
            <form method="POST" action="{{ route('admin.bookings.cancel', $booking->id) }}">
                @csrf
                <textarea name="reason" rows="3" required
                    style="width:100%;padding:11px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-family:'Sora',sans-serif;font-size:13px;color:#0f1923;outline:none;resize:none;margin-bottom:16px;"
                    placeholder="Reason for cancellation..."></textarea>
                <div style="display:flex;gap:10px;justify-content:flex-end;">
                    <button type="button" onclick="document.getElementById('cancelModal').style.display='none'"
                        style="padding:9px 20px;border:1.5px solid #e2e8f0;border-radius:50px;background:#fff;font-family:'Sora',sans-serif;font-size:13px;font-weight:600;color:#334155;cursor:pointer;">
                        Never mind
                    </button>
                    <button type="submit"
                        style="padding:9px 20px;border:none;border-radius:50px;background:#dc2626;font-family:'Sora',sans-serif;font-size:13px;font-weight:700;color:#fff;cursor:pointer;">
                        Confirm Cancel
                    </button>
                </div>
            </form>
        </div>
    </div>

@endsection
