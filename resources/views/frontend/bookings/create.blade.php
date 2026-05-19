@extends('layouts.frontend')
@section('title', 'Book Your Trip – Visit Nepal')

@push('styles')
    <style>
        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        .booking-page {
            min-height: 100vh;
            background: #f0f4f8;
            font-family: 'Poppins', sans-serif;
            padding-bottom: 60px;
        }

        /* ── Page header bar ─────────────────────────── */
        .booking-header {
            background: linear-gradient(135deg, #0d1f3c 0%, #1a3a6b 100%);
            padding: 28px 0 0;
        }

        .booking-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 0 32px 24px;
            color: #fff;
            text-decoration: none;
        }

        .booking-logo .logo-mountain {
            width: 44px;
            height: 44px;
            background: rgba(255, 255, 255, .15);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
        }

        .booking-logo .logo-text-name {
            font-size: 20px;
            font-weight: 700;
            letter-spacing: .5px;
        }

        .booking-logo .logo-text-tag {
            font-size: 11px;
            opacity: .65;
            letter-spacing: 1px;
        }

        /* ── Stepper ─────────────────────────────────── */
        .stepper {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0;
            padding: 0 32px 0;
            overflow-x: auto;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            min-width: 90px;
        }

        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 16px;
            left: calc(50% + 20px);
            width: calc(100% - 40px);
            height: 2px;
            background: rgba(255, 255, 255, .25);
            z-index: 0;
        }

        .step-item.completed:not(:last-child)::after {
            background: #4ade80;
        }

        .step-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, .35);
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            color: rgba(255, 255, 255, .5);
            position: relative;
            z-index: 1;
            transition: all .3s;
        }

        .step-item.completed .step-circle {
            background: #4ade80;
            border-color: #4ade80;
            color: #fff;
        }

        .step-item.active .step-circle {
            background: #fff;
            border-color: #fff;
            color: #1a3a6b;
            font-weight: 700;
        }

        .step-label {
            font-size: 11px;
            color: rgba(255, 255, 255, .5);
            margin-top: 6px;
            white-space: nowrap;
            font-weight: 500;
        }

        .step-item.active .step-label {
            color: #fff;
            font-weight: 600;
        }

        .step-item.completed .step-label {
            color: #4ade80;
        }

        /* ── Booking wrapper ─────────────────────────── */
        .booking-wrap {
            max-width: 980px;
            margin: 32px auto 0;
            padding: 0 16px;
        }

        /* ════════════════════════════════════════════════
           STEP 1 — Package Summary  (FIXED IMAGE UI)
        ════════════════════════════════════════════════ */
        .pkg-summary-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 32px rgba(0, 0, 0, .10);
            display: flex;
        }

        /* Image side — fixed aspect, no broken-image gap */
        .pkg-img-side {
            flex: 0 0 300px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(135deg, #0d1f3c, #1a6fc4);
            min-height: 400px;
        }

        .pkg-img-side img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            transition: transform .4s ease;
        }

        .pkg-img-side img:hover {
            transform: scale(1.04);
        }

        /* Gradient overlay so text on image is always readable */
        .pkg-img-side::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(13, 31, 60, .55) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Fallback placeholder — shown only when img errors */
        .pkg-img-placeholder-bk {
            position: absolute;
            inset: 0;
            display: none;
            /* hidden by default; JS shows on error */
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, .35);
            font-size: 64px;
            background: linear-gradient(135deg, #0d1f3c, #1a6fc4);
        }

        .pkg-img-placeholder-bk span {
            margin-top: 12px;
            font-size: 14px;
            font-weight: 600;
            color: rgba(255, 255, 255, .45);
            letter-spacing: .5px;
        }

        /* Badge pinned bottom-left over image */
        .pkg-img-badge {
            position: absolute;
            bottom: 16px;
            left: 16px;
            z-index: 2;
            background: rgba(255, 255, 255, .15);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, .25);
            color: #fff;
            border-radius: 8px;
            padding: 6px 14px;
            font-size: 12px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .pkg-info-side {
            flex: 1;
            padding: 32px 36px;
            display: flex;
            flex-direction: column;
        }

        .pkg-includes-title {
            font-size: 16px;
            font-weight: 700;
            color: #0d1f3c;
            margin-bottom: 16px;
        }

        .pkg-includes-list {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-bottom: 24px;
        }

        .pkg-includes-list li {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            color: #374151;
        }

        .pkg-includes-list li i {
            color: #4ade80;
            background: #f0fdf4;
            width: 22px;
            height: 22px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 11px;
            flex-shrink: 0;
        }

        .pkg-name-row {
            font-size: 22px;
            font-weight: 700;
            color: #0d1f3c;
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .pkg-meta-row {
            display: flex;
            gap: 16px;
            margin-top: 8px;
            flex-wrap: wrap;
        }

        .pkg-meta-row span {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: #6b7280;
            background: #f9fafb;
            border-radius: 6px;
            padding: 4px 10px;
        }

        .pkg-price-row {
            margin-top: 14px;
        }

        .pkg-price-label {
            font-size: 12px;
            color: #6b7280;
        }

        .pkg-price-value {
            font-size: 34px;
            font-weight: 800;
            color: #0d1f3c;
            line-height: 1.1;
        }

        .pkg-view-link {
            font-size: 13px;
            color: #1a6fc4;
            text-decoration: none;
            font-weight: 500;
            display: inline-block;
            margin-top: 8px;
        }

        .pkg-view-link:hover {
            text-decoration: underline;
        }

        .btn-book-now {
            align-self: flex-end;
            margin-top: 20px;
            background: linear-gradient(135deg, #1a6fc4, #1557a0);
            color: #fff;
            border: none;
            padding: 14px 40px;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: all .2s;
            box-shadow: 0 4px 14px rgba(26, 111, 196, .3);
        }

        .btn-book-now:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26, 111, 196, .4);
        }

        /* ════════════════════════════════════════════════
           STEP 2 — Traveler Information  (ALL FIELDS)
        ════════════════════════════════════════════════ */
        .traveler-card {
            background: #fff;
            border-radius: 16px;
            padding: 36px 40px;
            box-shadow: 0 4px 32px rgba(0, 0, 0, .08);
        }

        .traveler-card h2 {
            font-size: 20px;
            font-weight: 700;
            color: #0d1f3c;
            margin-bottom: 8px;
        }

        .traveler-card .section-subtitle {
            font-size: 13px;
            color: #9ca3af;
            margin-bottom: 28px;
        }

        /* Section dividers inside the form */
        .form-section {
            margin-bottom: 28px;
        }

        .form-section-title {
            font-size: 12px;
            font-weight: 700;
            color: #1a6fc4;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding-bottom: 10px;
            border-bottom: 2px solid #eff6ff;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .form-section-title i {
            font-size: 13px;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-grid-3 {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 16px;
        }

        .form-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-field.full {
            grid-column: 1 / -1;
        }

        .form-field.span-2 {
            grid-column: span 2;
        }

        .form-field label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }

        .form-field label .req {
            color: #ef4444;
        }

        .form-field label .opt {
            font-size: 11px;
            color: #9ca3af;
            font-weight: 400;
            margin-left: 4px;
        }

        .form-field input,
        .form-field select,
        .form-field textarea {
            padding: 11px 14px;
            border: 1.5px solid #e5e7eb;
            border-radius: 8px;
            font-size: 14px;
            font-family: 'Poppins', sans-serif;
            color: #111827;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            background: #fff;
        }

        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus {
            border-color: #1a6fc4;
            box-shadow: 0 0 0 3px rgba(26, 111, 196, .08);
        }

        .form-field textarea {
            resize: vertical;
            min-height: 90px;
        }

        .phone-row {
            display: flex;
            gap: 8px;
        }

        .phone-code {
            width: 110px;
            flex-shrink: 0;
        }

        /* Inline hint text */
        .field-hint {
            font-size: 11px;
            color: #9ca3af;
            margin-top: 2px;
        }

        .step-btns {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .btn-back {
            padding: 11px 28px;
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            background: #fff;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            cursor: pointer;
            transition: border-color .2s;
        }

        .btn-back:hover {
            border-color: #9ca3af;
        }

        .btn-continue {
            padding: 11px 32px;
            background: #1a6fc4;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-continue:hover {
            background: #155fa0;
        }

        /* ── STEP 3: Payment Options ──────────────────── */
        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .payment-summary-card,
        .payment-method-card {
            background: #fff;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .08);
        }

        .payment-summary-card h3,
        .payment-method-card h3 {
            font-size: 16px;
            font-weight: 700;
            color: #0d1f3c;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #f3f4f6;
            font-size: 14px;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-row .s-label {
            color: #6b7280;
        }

        .summary-row .s-value {
            font-weight: 600;
            color: #111827;
        }

        .summary-row.total .s-label {
            font-weight: 700;
            color: #0d1f3c;
            font-size: 15px;
        }

        .summary-row.total .s-value {
            font-weight: 800;
            color: #1a6fc4;
            font-size: 22px;
        }

        .method-option {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 14px 16px;
            border: 2px solid #e5e7eb;
            border-radius: 10px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: border-color .2s, background .2s;
            position: relative;
        }

        .method-option:hover {
            border-color: #93c5fd;
        }

        .method-option.selected {
            border-color: #1a6fc4;
            background: #eff6ff;
        }

        .method-option input[type="radio"] {
            accent-color: #1a6fc4;
            width: 18px;
            height: 18px;
            flex-shrink: 0;
        }

        .method-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            color: #111827;
            flex: 1;
        }

        .method-badges {
            display: flex;
            gap: 6px;
            margin-left: auto;
        }

        .badge-visa {
            background: #1a1f71;
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 4px;
        }

        .badge-mc {
            background: linear-gradient(90deg, #eb001b, #f79e1b);
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 4px;
        }

        .badge-amex {
            background: #2e77bc;
            color: #fff;
            font-size: 10px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 4px;
        }

        /* ── STEP 4: Stripe Card Form ─────────────────── */
        .stripe-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
        }

        .order-summary-card,
        .card-form-card {
            background: #fff;
            border-radius: 14px;
            padding: 28px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .08);
        }

        .order-summary-card h3,
        .card-form-card h3 {
            font-size: 16px;
            font-weight: 700;
            color: #0d1f3c;
            margin-bottom: 20px;
        }

        .card-number-wrap {
            position: relative;
        }

        .card-number-wrap input {
            padding-right: 100px;
            width: 100%;
        }

        .card-brand-badges {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            gap: 4px;
        }

        .card-row-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 14px;
        }

        .save-card-row {
            display: flex;
            align-items: center;
            gap: 8px;
            margin-top: 14px;
            font-size: 13px;
            color: #6b7280;
        }

        .save-card-row input {
            accent-color: #1a6fc4;
        }

        .secure-note {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: #6b7280;
            margin-top: 14px;
        }

        .secure-note i {
            color: #22c55e;
            font-size: 14px;
        }

        .stripe-note {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 11px;
            color: #9ca3af;
            margin-top: 6px;
        }

        .btn-pay {
            width: 100%;
            padding: 14px;
            background: #1a6fc4;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            margin-top: 20px;
            transition: background .2s;
        }

        .btn-pay:hover {
            background: #155fa0;
        }

        .btn-back-link {
            display: block;
            text-align: center;
            margin-top: 12px;
            font-size: 13px;
            color: #6b7280;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-back-link:hover {
            color: #1a6fc4;
        }

        /* ── STEP 5: Confirmation ─────────────────────── */
        .confirmation-card {
            background: #fff;
            border-radius: 14px;
            padding: 48px 40px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .08);
            text-align: center;
        }

        .confirm-check {
            width: 80px;
            height: 80px;
            background: #22c55e;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 24px;
            font-size: 36px;
            color: #fff;
        }

        .confirmation-card h2 {
            font-size: 26px;
            font-weight: 800;
            color: #0d1f3c;
            margin-bottom: 8px;
        }

        .confirm-sub {
            font-size: 14px;
            color: #6b7280;
            margin-bottom: 32px;
        }

        .confirm-details {
            background: #f9fafb;
            border-radius: 10px;
            padding: 20px 24px;
            text-align: left;
            margin-bottom: 28px;
            max-width: 520px;
            margin-left: auto;
            margin-right: auto;
        }

        .confirm-row {
            display: flex;
            justify-content: space-between;
            padding: 9px 0;
            border-bottom: 1px solid #e5e7eb;
            font-size: 14px;
        }

        .confirm-row:last-child {
            border-bottom: none;
        }

        .confirm-row .cr-label {
            color: #6b7280;
        }

        .confirm-row .cr-value {
            font-weight: 700;
            color: #111827;
        }

        .confirm-row .cr-value.paid {
            color: #22c55e;
        }

        .confirm-row .cr-value.ref {
            color: #1a6fc4;
        }

        .confirm-btn-row {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-download {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 24px;
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            background: #fff;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-download:hover {
            border-color: #9ca3af;
        }

        .btn-home {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 12px 28px;
            background: #1a6fc4;
            border: none;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            text-decoration: none;
        }

        .btn-home:hover {
            background: #155fa0;
        }

        /* ── Step display logic ───────────────────────── */
        .booking-step {
            display: none;
        }

        .booking-step.active {
            display: block;
        }

        /* ── Responsive ───────────────────────────────── */
        @media (max-width: 900px) {
            .pkg-summary-card {
                flex-direction: column;
            }

            .pkg-img-side {
                flex: none;
                height: 260px;
                min-height: unset;
            }

            .pkg-img-side img {
                position: absolute;
            }

            .form-grid-3 {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media (max-width: 640px) {

            .form-grid-2,
            .form-grid-3 {
                grid-template-columns: 1fr;
            }

            .form-field.span-2 {
                grid-column: span 1;
            }

            .payment-grid,
            .stripe-grid {
                grid-template-columns: 1fr;
            }

            .traveler-card,
            .payment-summary-card,
            .payment-method-card,
            .order-summary-card,
            .card-form-card {
                padding: 20px;
            }

            .pkg-info-side {
                padding: 24px 20px;
            }
        }
    </style>
@endpush


@section('content')

    {{-- Pass PHP data to JS safely --}}
    <script>
        const BOOKING_DATA = {
            type: "{{ $package ? 'package' : ($trek ? 'trek' : 'custom') }}",
            packageId: {{ $package?->id ?? 'null' }},
            trekId: {{ $trek?->id ?? 'null' }},
            pkgName: "{{ addslashes($item?->name ?? 'Nepal Highlights Tour') }}",
            days: {{ $item?->duration_days ?? 7 }},
            nights: {{ ($item?->duration_days ?? 7) - 1 }},
            priceEach: {{ $item ? $item->price_usd_discounted ?? ($item->price_usd ?? 750) : 750 }},
            bookingUrl: "{{ route('bookings.store') }}",
            csrfToken: "{{ csrf_token() }}",
        };
    </script>

    <div class="booking-wrap">

        {{-- ════════════════════════════════════════
             STEP 1 — Package Summary
        ════════════════════════════════════════ --}}
        <div class="booking-step active" id="step-1">
            <div class="pkg-summary-card">

                {{-- Left: image (fixed UI) --}}
                <div class="pkg-img-side">
                    @php
                        $img = $item?->featured_image;
                        $imgUrl = $img
                            ? (Str::startsWith($img, 'http')
                                ? $img
                                : asset('storage/' . $img))
                            : asset('images/landingimg.png');
                    @endphp
                    <img src="{{ $imgUrl }}" alt="{{ $item?->name ?? 'Nepal Highlights Tour' }}"
                        onerror="this.style.display='none';
                              this.nextElementSibling.style.display='flex';" />

                    {{-- Fallback shown only on img error --}}
                    <div class="pkg-img-placeholder-bk">
                        <i class="fas fa-mountain"></i>
                        <span>Visit Nepal</span>
                    </div>

                    {{-- Badge pinned bottom-left over image --}}
                    <div class="pkg-img-badge">
                        <i class="fas fa-star" style="color:#fbbf24;"></i>
                        Top Rated
                    </div>
                </div>

                {{-- Right: info --}}
                <div class="pkg-info-side">
                    <div class="pkg-includes-title">Package Includes</div>
                    <ul class="pkg-includes-list">
                        @if ($item && !empty($item->included))
                            @foreach (array_slice($item->included, 0, 6) as $inc)
                                <li><i class="fas fa-check"></i> {{ $inc }}</li>
                            @endforeach
                        @else
                            @foreach (['Hotel Accommodation', 'Breakfast', 'Sightseeing', 'Private Transport', 'Tour Guide', 'Airport Pickup/Drop'] as $inc)
                                <li><i class="fas fa-check"></i> {{ $inc }}</li>
                            @endforeach
                        @endif
                    </ul>

                    <div class="pkg-name-row">{{ $item?->name ?? 'Nepal Highlights Tour' }}</div>

                    <div class="pkg-meta-row">
                        <span><i class="far fa-clock"></i> {{ $item?->duration_days ?? 7 }} Days</span>
                        <span><i class="fas fa-moon"></i> {{ ($item?->duration_days ?? 7) - 1 }} Nights</span>
                        <span><i class="fas fa-signal"></i> {{ $trek?->difficulty ?? 'Easy' }}</span>
                        @if ($trek?->max_altitude)
                            <span><i class="fas fa-mountain"></i> {{ $trek->max_altitude }}</span>
                        @endif
                    </div>

                    <div class="pkg-price-row">
                        <div class="pkg-price-label">Package Price</div>
                        <div class="pkg-price-value">
                            ${{ $item ? number_format($item->price_usd_discounted ?? ($item->price_usd ?? 750), 0) : '750' }}
                            <small style="font-size:14px;font-weight:500;color:#6b7280;">/ person</small>
                        </div>
                    </div>

                    @if ($package)
                        <a href="{{ route('packages.show', $package->slug) }}" class="pkg-view-link">
                            <i class="fas fa-external-link-alt" style="font-size:11px;"></i> View Package Details
                        </a>
                    @elseif($trek)
                        <a href="{{ route('treks.show', $trek->slug) }}" class="pkg-view-link">
                            <i class="fas fa-external-link-alt" style="font-size:11px;"></i> View Trek Details
                        </a>
                    @endif

                    <button class="btn-book-now" onclick="goToStep(2)">
                        <i class="fas fa-arrow-right" style="margin-right:6px;"></i> Book Now
                    </button>
                </div>

            </div>
        </div>{{-- /step-1 --}}


        {{-- ════════════════════════════════════════
             STEP 2 — Traveler Details (ALL FIELDS)
        ════════════════════════════════════════ --}}
        <div class="booking-step" id="step-2">
            <div class="traveler-card">
                <h2>Traveler Information</h2>
                <p class="section-subtitle">Please fill in the details below. Fields marked <span
                        style="color:#ef4444;">*</span> are required.</p>

                {{-- ── Section 1: Personal Details ── --}}
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-user"></i> Personal Details
                    </div>
                    <div class="form-grid-2">

                        <div class="form-field">
                            <label>First Name <span class="req">*</span></label>
                            <input type="text" id="b_first_name" placeholder="First name" />
                            <span class="field-error" id="err_b_first_name"
                                style="color:#ef4444;font-size:12px;display:none;">Required.</span>
                        </div>

                        <div class="form-field">
                            <label>Last Name <span class="req">*</span></label>
                            <input type="text" id="b_last_name" placeholder="Last name" />
                            <span class="field-error" id="err_b_last_name"
                                style="color:#ef4444;font-size:12px;display:none;">Required.</span>
                        </div>

                        <div class="form-field">
                            <label>Email Address <span class="req">*</span></label>
                            <input type="email" id="b_email" placeholder="you@example.com" />
                            <span class="field-error" id="err_b_email"
                                style="color:#ef4444;font-size:12px;display:none;">Enter a valid email.</span>
                        </div>

                        <div class="form-field">
                            <label>Phone Number <span class="req">*</span></label>
                            <div class="phone-row">
                                <select class="phone-code" id="b_phone_code">
                                    <option value="+977">🇳🇵 +977</option>
                                    <option value="+1">🇺🇸 +1</option>
                                    <option value="+44">🇬🇧 +44</option>
                                    <option value="+91">🇮🇳 +91</option>
                                    <option value="+61">🇦🇺 +61</option>
                                    <option value="+49">🇩🇪 +49</option>
                                    <option value="+33">🇫🇷 +33</option>
                                    <option value="+81">🇯🇵 +81</option>
                                    <option value="+86">🇨🇳 +86</option>
                                    <option value="+82">🇰🇷 +82</option>
                                </select>
                                <input type="tel" id="b_phone" placeholder="Phone number" style="flex:1;" />
                            </div>
                            <span class="field-error" id="err_b_phone"
                                style="color:#ef4444;font-size:12px;display:none;">Enter a valid phone number.</span>
                        </div>

                        <div class="form-field">
                            <label>Date of Birth <span class="opt">(optional)</span></label>
                            <input type="date" id="b_dob" />
                        </div>

                        <div class="form-field">
                            <label>Nationality <span class="opt">(optional)</span></label>
                            <input type="text" id="b_nationality" placeholder="e.g. Nepali, American" />
                        </div>

                        <div class="form-field full">
                            <label>Passport Number <span class="opt">(optional)</span></label>
                            <input type="text" id="b_passport" placeholder="e.g. A1234567" />
                            <span class="field-hint">Required for international treks & permits.</span>
                        </div>

                    </div>
                </div>

                {{-- ── Section 2: Trip Details ── --}}
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-calendar-alt"></i> Trip Details
                    </div>
                    <div class="form-grid-2">

                        <div class="form-field">
                            <label>Trip Start Date <span class="req">*</span></label>
                            <input type="date" id="b_start_date" min="{{ date('Y-m-d', strtotime('+1 day')) }}" />
                            <span class="field-error" id="err_b_start_date"
                                style="color:#ef4444;font-size:12px;display:none;">Select a start date.</span>
                        </div>

                        <div class="form-field">
                            <label>Trip End Date <span class="opt">(optional)</span></label>
                            <input type="date" id="b_end_date" />
                            <span class="field-hint">Auto-filled based on duration if left blank.</span>
                        </div>

                        <div class="form-field">
                            <label>Number of Adults <span class="req">*</span></label>
                            <select id="b_travelers">
                                <option value="1">1 Adult</option>
                                <option value="2">2 Adults</option>
                                <option value="3">3 Adults</option>
                                <option value="4">4 Adults</option>
                                <option value="5">5 Adults</option>
                                <option value="6">6+ Adults</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label>Number of Children <span class="opt">(optional)</span></label>
                            <select id="b_children">
                                <option value="0">0 Children</option>
                                <option value="1">1 Child</option>
                                <option value="2">2 Children</option>
                                <option value="3">3 Children</option>
                                <option value="4">4 Children</option>
                            </select>
                        </div>

                    </div>
                </div>

                {{-- ── Section 3: Preferences ── --}}
                <div class="form-section">
                    <div class="form-section-title">
                        <i class="fas fa-sliders-h"></i> Preferences
                    </div>
                    <div class="form-grid-2">

                        <div class="form-field">
                            <label>Accommodation Preference <span class="opt">(optional)</span></label>
                            <select id="b_accommodation">
                                <option value="">-- Select --</option>
                                <option value="budget">Budget (Tea Houses / Guesthouses)</option>
                                <option value="standard">Standard (3-Star Hotels)</option>
                                <option value="luxury">Luxury (4-5 Star Hotels)</option>
                            </select>
                        </div>

                        <div class="form-field">
                            <label>Pickup Location <span class="opt">(optional)</span></label>
                            <input type="text" id="b_pickup" placeholder="e.g. Kathmandu, Thamel" />
                            <span class="field-hint">Where should we pick you up?</span>
                        </div>

                        <div class="form-field full">
                            <label>Special Requirements <span class="opt">(optional)</span></label>
                            <textarea id="b_special" placeholder="Dietary needs, medical conditions, special requests..."></textarea>
                        </div>

                    </div>
                </div>

                <div class="step-btns">
                    <button class="btn-back" onclick="goToStep(1)">
                        <i class="fas fa-arrow-left" style="margin-right:6px;"></i> Back
                    </button>
                    <button class="btn-continue" onclick="validateStep2()">
                        Continue to Payment <i class="fas fa-arrow-right" style="margin-left:6px;"></i>
                    </button>
                </div>
            </div>
        </div>{{-- /step-2 --}}


        {{-- ════════════════════════════════════════
             STEP 3 — Payment Options
        ════════════════════════════════════════ --}}
        <div class="booking-step" id="step-3">
            <div class="payment-grid">

                <div class="payment-summary-card">
                    <h3>Payment Summary</h3>
                    <div class="summary-row">
                        <span class="s-label">Package Name</span>
                        <span class="s-value" id="sum_pkg_name">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="s-label">Duration</span>
                        <span class="s-value" id="sum_duration">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="s-label">Adults</span>
                        <span class="s-value" id="sum_travelers">1</span>
                    </div>
                    <div class="summary-row">
                        <span class="s-label">Children</span>
                        <span class="s-value" id="sum_children">0</span>
                    </div>
                    <div class="summary-row">
                        <span class="s-label">Price per Person</span>
                        <span class="s-value" id="sum_price_pp">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="s-label">Start Date</span>
                        <span class="s-value" id="sum_start_date">—</span>
                    </div>
                    <div class="summary-row total">
                        <span class="s-label">Total Amount</span>
                        <span class="s-value" id="sum_total">—</span>
                    </div>
                    <div class="step-btns" style="border-top:none;padding-top:16px;">
                        <button class="btn-back" onclick="goToStep(2)">Back</button>
                        <button class="btn-continue" onclick="goToStep(4)">Pay Now</button>
                    </div>
                </div>

                <div class="payment-method-card">
                    <h3>Choose Payment Method</h3>

                    <label class="method-option selected" id="method-stripe">
                        <input type="radio" name="pay_method" value="stripe" checked onchange="selectMethod(this)" />
                        <div class="method-label">
                            <i class="fas fa-bolt" style="color:#635bff;"></i> Stripe
                        </div>
                        <div class="method-badges">
                            <span class="badge-visa">VISA</span>
                            <span class="badge-mc">MC</span>
                            <span class="badge-amex">AMEX</span>
                        </div>
                    </label>

                    <label class="method-option" id="method-khalti">
                        <input type="radio" name="pay_method" value="khalti" onchange="selectMethod(this)" />
                        <div class="method-label">
                            <span
                                style="background:#5C2D91;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:12px;">K</span>
                            Khalti <span style="font-size:11px;color:#9ca3af;font-weight:400;">(Nepal)</span>
                        </div>
                    </label>

                    <label class="method-option" id="method-esewa">
                        <input type="radio" name="pay_method" value="esewa" onchange="selectMethod(this)" />
                        <div class="method-label">
                            <span
                                style="background:#60BB46;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:11px;">e</span>
                            eSewa <span style="font-size:11px;color:#9ca3af;font-weight:400;">(Nepal)</span>
                        </div>
                    </label>

                    <label class="method-option" id="method-bank">
                        <input type="radio" name="pay_method" value="bank" onchange="selectMethod(this)" />
                        <div class="method-label">
                            <i class="fas fa-university" style="color:#6b7280;font-size:20px;"></i>
                            Bank Transfer
                        </div>
                    </label>
                </div>

            </div>
        </div>{{-- /step-3 --}}


        {{-- ════════════════════════════════════════
             STEP 4 — Stripe Card Payment
        ════════════════════════════════════════ --}}
        <div class="booking-step" id="step-4">
            <div class="stripe-grid">

                <div class="order-summary-card">
                    <h3>Order Summary</h3>
                    <div class="summary-row">
                        <span class="s-label">Package</span>
                        <span class="s-value" id="stripe_pkg_name">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="s-label">Traveler</span>
                        <span class="s-value" id="stripe_traveler_name">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="s-label">Duration</span>
                        <span class="s-value" id="stripe_duration">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="s-label">Adults / Children</span>
                        <span class="s-value" id="stripe_travelers">—</span>
                    </div>
                    <div class="summary-row">
                        <span class="s-label">Start Date</span>
                        <span class="s-value" id="stripe_start_date">—</span>
                    </div>
                    <div class="summary-row total" style="margin-top:12px;padding-top:12px;border-top:2px solid #e5e7eb;">
                        <span class="s-label">Total Amount</span>
                        <span class="s-value" id="stripe_total">—</span>
                    </div>
                </div>

                <div class="card-form-card">
                    <h3>Pay with Card</h3>

                    <div class="form-field" style="margin-bottom:14px;">
                        <label>Card Number</label>
                        <div class="card-number-wrap">
                            <input type="text" id="card_number" placeholder="1234 1234 1234 1234" maxlength="19"
                                oninput="formatCardNumber(this)" />
                            <div class="card-brand-badges">
                                <span class="badge-visa" style="font-size:9px;">VISA</span>
                                <span class="badge-mc" style="font-size:9px;">MC</span>
                                <span class="badge-amex" style="font-size:9px;">AMEX</span>
                            </div>
                        </div>
                    </div>

                    <div class="card-row-2" style="margin-bottom:14px;">
                        <div class="form-field">
                            <label>Expiry Date</label>
                            <input type="text" id="card_expiry" placeholder="MM / YY" maxlength="7"
                                oninput="formatExpiry(this)" />
                        </div>
                        <div class="form-field">
                            <label>CVC</label>
                            <input type="text" id="card_cvc" placeholder="CVC" maxlength="4" />
                        </div>
                    </div>

                    <div class="form-field" style="margin-bottom:0;">
                        <label>Cardholder Name</label>
                        <input type="text" id="card_name" placeholder="Name on card" />
                    </div>

                    <div class="save-card-row">
                        <input type="checkbox" id="save_card" />
                        <label for="save_card">Save card for future payments</label>
                    </div>

                    <div class="secure-note">
                        <i class="fas fa-lock"></i>
                        <span><strong>Secure Payment</strong> — Your information is safe with us.</span>
                    </div>
                    <div class="stripe-note">
                        <span>Powered by</span>
                        <strong style="color:#635bff;">Stripe</strong>
                        <i class="fas fa-shield-alt" style="color:#22c55e;"></i>
                        <span>SSL Secured</span>
                    </div>

                    <button class="btn-pay" id="payBtn" onclick="processPayment()">
                        Pay <span id="pay_amount">—</span>
                    </button>

                    <a class="btn-back-link" onclick="goToStep(3)">← Back to Payment Options</a>
                </div>

            </div>
        </div>{{-- /step-4 --}}


        {{-- ════════════════════════════════════════
             STEP 5 — Booking Confirmed
        ════════════════════════════════════════ --}}
        <div class="booking-step" id="step-5">
            <div class="confirmation-card">

                <div class="confirm-check">
                    <i class="fas fa-check"></i>
                </div>

                <h2>Booking Confirmed!</h2>
                <p class="confirm-sub">
                    Thank you for booking with Visit Nepal.<br>
                    We have sent the booking details to your email.
                </p>

                <div class="confirm-details">
                    <div class="confirm-row">
                        <span class="cr-label">Booking ID</span>
                        <span class="cr-value ref" id="conf_booking_id">—</span>
                    </div>
                    <div class="confirm-row">
                        <span class="cr-label">Traveler</span>
                        <span class="cr-value" id="conf_traveler">—</span>
                    </div>
                    <div class="confirm-row">
                        <span class="cr-label">Package</span>
                        <span class="cr-value" id="conf_package">—</span>
                    </div>
                    <div class="confirm-row">
                        <span class="cr-label">Duration</span>
                        <span class="cr-value" id="conf_duration">—</span>
                    </div>
                    <div class="confirm-row">
                        <span class="cr-label">Start Date</span>
                        <span class="cr-value" id="conf_start_date">—</span>
                    </div>
                    <div class="confirm-row">
                        <span class="cr-label">Adults / Children</span>
                        <span class="cr-value" id="conf_travelers">—</span>
                    </div>
                    <div class="confirm-row">
                        <span class="cr-label">Total Amount</span>
                        <span class="cr-value" id="conf_total">—</span>
                    </div>
                    <div class="confirm-row">
                        <span class="cr-label">Payment Status</span>
                        <span class="cr-value paid">Paid</span>
                    </div>
                </div>

                <div class="confirm-btn-row">
                    <a href="#" class="btn-download">
                        <i class="fas fa-download"></i> Download Invoice
                    </a>
                    <a href="{{ route('home') }}" class="btn-home">Back to Home</a>
                </div>

            </div>
        </div>{{-- /step-5 --}}

    </div>{{-- /booking-wrap --}}

@endsection


@push('scripts')
    <script>
        /* ═══════════════════════════════════════════
             BOOKING WIZARD — DYNAMIC
        ═══════════════════════════════════════════ */
        let currentStep = 1;

        const booking = {
            type: BOOKING_DATA.type,
            packageId: BOOKING_DATA.packageId,
            trekId: BOOKING_DATA.trekId,
            pkgName: BOOKING_DATA.pkgName,
            days: BOOKING_DATA.days,
            nights: BOOKING_DATA.nights,
            priceEach: BOOKING_DATA.priceEach,
            travelers: 1,
            children: 0,
            total: BOOKING_DATA.priceEach,
            startDate: '',
            firstName: '',
            lastName: '',
        };

        /* ── Navigate steps ── */
        function goToStep(n) {
            document.getElementById(`step-${currentStep}`).classList.remove('active');
            currentStep = n;
            document.getElementById(`step-${currentStep}`).classList.add('active');
            updateStepper(n);
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
            if (n === 3) fillSummary();
            if (n === 4) fillStripe();
        }

        /* ── Stepper UI ── */
        function updateStepper(active) {
            const map = {
                1: 1,
                2: 2,
                3: 3,
                4: 3,
                5: 4
            };
            const sa = map[active] || active;
            document.querySelectorAll('.step-item').forEach((el, i) => {
                const s = i + 1;
                el.classList.remove('active', 'completed');
                if (s < sa) el.classList.add('completed');
                else if (s === sa) el.classList.add('active');
            });
            if (active === 5) {
                document.querySelectorAll('.step-item').forEach(el => {
                    el.classList.remove('active');
                    el.classList.add('completed');
                });
            }
        }

        /* ── Validate step 2 ── */
        function validateStep2() {
            let valid = true;

            const checks = [{
                    id: 'b_first_name',
                    errId: 'err_b_first_name',
                    fn: v => v.trim().length >= 1
                },
                {
                    id: 'b_last_name',
                    errId: 'err_b_last_name',
                    fn: v => v.trim().length >= 1
                },
                {
                    id: 'b_email',
                    errId: 'err_b_email',
                    fn: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim())
                },
                {
                    id: 'b_phone',
                    errId: 'err_b_phone',
                    fn: v => v.trim().length >= 6
                },
                {
                    id: 'b_start_date',
                    errId: 'err_b_start_date',
                    fn: v => v.trim().length > 0
                },
            ];

            checks.forEach(({
                id,
                errId,
                fn
            }) => {
                const el = document.getElementById(id);
                const err = document.getElementById(errId);
                if (!fn(el.value)) {
                    el.style.borderColor = '#ef4444';
                    err.style.display = 'block';
                    valid = false;
                } else {
                    el.style.borderColor = '#e5e7eb';
                    err.style.display = 'none';
                }
                el.addEventListener('input', () => {
                    el.style.borderColor = '#e5e7eb';
                    err.style.display = 'none';
                }, {
                    once: true
                });
            });

            if (!valid) return;

            // Capture all fields into booking state
            booking.firstName = document.getElementById('b_first_name').value.trim();
            booking.lastName = document.getElementById('b_last_name').value.trim();
            booking.travelers = parseInt(document.getElementById('b_travelers').value) || 1;
            booking.children = parseInt(document.getElementById('b_children').value) || 0;
            booking.total = booking.priceEach * booking.travelers;
            booking.startDate = document.getElementById('b_start_date').value;

            // Auto-fill end date if blank
            if (!document.getElementById('b_end_date').value && booking.startDate) {
                const end = new Date(booking.startDate);
                end.setDate(end.getDate() + booking.days);
                document.getElementById('b_end_date').value = end.toISOString().split('T')[0];
            }

            goToStep(3);
        }

        /* ── Fill step 3 summary ── */
        function fillSummary() {
            document.getElementById('sum_pkg_name').textContent = booking.pkgName;
            document.getElementById('sum_duration').textContent = `${booking.days} Days / ${booking.nights} Nights`;
            document.getElementById('sum_travelers').textContent = booking.travelers;
            document.getElementById('sum_children').textContent = booking.children;
            document.getElementById('sum_price_pp').textContent = `$${booking.priceEach.toLocaleString()}`;
            document.getElementById('sum_start_date').textContent = booking.startDate || '—';
            document.getElementById('sum_total').textContent = `$${booking.total.toLocaleString()}`;
        }

        /* ── Fill step 4 stripe summary ── */
        function fillStripe() {
            document.getElementById('stripe_pkg_name').textContent = booking.pkgName;
            document.getElementById('stripe_traveler_name').textContent = `${booking.firstName} ${booking.lastName}`;
            document.getElementById('stripe_duration').textContent = `${booking.days} Days / ${booking.nights} Nights`;
            document.getElementById('stripe_travelers').textContent =
                `${booking.travelers} Adult(s) / ${booking.children} Child(ren)`;
            document.getElementById('stripe_start_date').textContent = booking.startDate || '—';
            document.getElementById('stripe_total').textContent = `$${booking.total.toLocaleString()}`;
            document.getElementById('pay_amount').textContent = `$${booking.total.toLocaleString()}`;
            // Pre-fill cardholder name from traveler name
            document.getElementById('card_name').value = `${booking.firstName} ${booking.lastName}`;
        }

        /* ── Payment method highlight ── */
        function selectMethod(radio) {
            document.querySelectorAll('.method-option').forEach(el => el.classList.remove('selected'));
            radio.closest('.method-option').classList.add('selected');
        }

        /* ── Card number formatting ── */
        function formatCardNumber(input) {
            let v = input.value.replace(/\D/g, '').substring(0, 16);
            input.value = v.replace(/(.{4})/g, '$1 ').trim();
        }

        /* ── Expiry formatting ── */
        function formatExpiry(input) {
            let v = input.value.replace(/\D/g, '').substring(0, 4);
            if (v.length > 2) v = v.substring(0, 2) + ' / ' + v.substring(2);
            input.value = v;
        }

        /* ── Process payment → POST to Laravel ── */
        async function processPayment() {
            const btn = document.getElementById('payBtn');
            const cardNum = document.getElementById('card_number').value.replace(/\s/g, '');
            const expiry = document.getElementById('card_expiry').value;
            const cvc = document.getElementById('card_cvc').value;
            const cardName = document.getElementById('card_name').value;

            if (cardNum.length < 16 || !expiry || cvc.length < 3 || cardName.trim().length < 2) {
                alert('Please fill in all card details correctly.');
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Processing...';

            const selectedMethod = document.querySelector('input[name="pay_method"]:checked')?.value ?? 'stripe';

            const payload = {
                booking_type: booking.type,
                package_id: booking.packageId,
                trek_id: booking.trekId,
                first_name: booking.firstName,
                last_name: booking.lastName,
                email: document.getElementById('b_email').value.trim(),
                phone: document.getElementById('b_phone_code').value +
                    document.getElementById('b_phone').value.trim(),
                date_of_birth: document.getElementById('b_dob').value || null,
                nationality: document.getElementById('b_nationality').value || null,
                passport_number: document.getElementById('b_passport').value || null,
                trip_start_date: document.getElementById('b_start_date').value,
                trip_end_date: document.getElementById('b_end_date').value || null,
                num_adults: booking.travelers,
                num_children: booking.children,
                accommodation_preference: document.getElementById('b_accommodation').value || null,
                pickup_location: document.getElementById('b_pickup').value || null,
                special_requirements: document.getElementById('b_special').value || null,
                payment_method: selectedMethod,
                card_number: cardNum,
                card_expiry: expiry,
                card_cvc: cvc,
                card_name: cardName,
            };

            try {
                const res = await fetch(BOOKING_DATA.bookingUrl, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': BOOKING_DATA.csrfToken,
                        'Accept': 'application/json',
                    },
                    body: JSON.stringify(payload),
                });

                const data = await res.json();

                if (!res.ok) {
                    const errors = data.errors ?
                        Object.values(data.errors).flat().join('\n') :
                        (data.message ?? 'Something went wrong.');
                    alert(errors);
                    btn.disabled = false;
                    btn.innerHTML = `Pay $${booking.total.toLocaleString()}`;
                    return;
                }

                // Success — populate confirmation screen
                document.getElementById('conf_booking_id').textContent = data.booking_ref;
                document.getElementById('conf_traveler').textContent = `${booking.firstName} ${booking.lastName}`;
                document.getElementById('conf_package').textContent = booking.pkgName;
                document.getElementById('conf_duration').textContent =
                `${booking.days} Days / ${booking.nights} Nights`;
                document.getElementById('conf_start_date').textContent = booking.startDate;
                document.getElementById('conf_travelers').textContent =
                    `${booking.travelers} Adult(s) / ${booking.children} Child(ren)`;
                document.getElementById('conf_total').textContent = `$${data.total.toLocaleString()}`;
                goToStep(5);

            } catch (err) {
                alert('Network error. Please try again.');
                btn.disabled = false;
                btn.innerHTML = `Pay $${booking.total.toLocaleString()}`;
            }
        }
    </script>
@endpush
