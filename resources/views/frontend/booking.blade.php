@extends('layouts.frontend')
@section('title', 'Book Your Trip – Visit Nepal')

@push('styles')
    <style>
        /* ═══════════════════════════════════════════════
             BOOKING PAGE — VISIT NEPAL
             Matches the 6-step design exactly
          ═══════════════════════════════════════════════ */

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
            background: rgba(255, 255, 255, 0.15);
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
            background: rgba(255, 255, 255, 0.25);
            z-index: 0;
        }

        .step-item.completed:not(:last-child)::after {
            background: #4ade80;
        }

        .step-item.active:not(:last-child)::after {
            background: rgba(255, 255, 255, 0.25);
        }

        .step-circle {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.35);
            background: transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            color: rgba(255, 255, 255, 0.5);
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
            color: rgba(255, 255, 255, 0.5);
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

        /* ── STEP 1: Package Summary ─────────────────── */
        .pkg-summary-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .08);
            display: flex;
            gap: 0;
        }

        .pkg-img-side {
            flex: 0 0 260px;
            position: relative;
            overflow: hidden;
        }

        .pkg-img-side img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .pkg-img-placeholder-bk {
            width: 100%;
            height: 100%;
            min-height: 260px;
            background: linear-gradient(135deg, #1a3a6b, #1a6fc4);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.4);
            font-size: 48px;
        }

        .pkg-info-side {
            flex: 1;
            padding: 28px 32px;
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
            font-size: 20px;
            font-weight: 700;
            color: #0d1f3c;
            margin-top: auto;
            padding-top: 20px;
            border-top: 1px solid #f0f0f0;
        }

        .pkg-meta-row {
            display: flex;
            gap: 16px;
            margin-top: 6px;
        }

        .pkg-meta-row span {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: #6b7280;
        }

        .pkg-price-row {
            margin-top: 10px;
        }

        .pkg-price-label {
            font-size: 12px;
            color: #6b7280;
        }

        .pkg-price-value {
            font-size: 30px;
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
            margin-top: 6px;
        }

        .pkg-view-link:hover {
            text-decoration: underline;
        }

        .btn-book-now {
            align-self: flex-end;
            margin-top: 20px;
            background: #1a6fc4;
            color: #fff;
            border: none;
            padding: 13px 36px;
            border-radius: 8px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
        }

        .btn-book-now:hover {
            background: #155fa0;
        }

        /* ── STEP 2: Traveler Info ────────────────────── */
        .traveler-card {
            background: #fff;
            border-radius: 14px;
            padding: 36px 40px;
            box-shadow: 0 4px 24px rgba(0, 0, 0, .08);
        }

        .traveler-card h2 {
            font-size: 20px;
            font-weight: 700;
            color: #0d1f3c;
            margin-bottom: 24px;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .form-grid-1 {
            display: grid;
            gap: 18px;
        }

        .form-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-field.full {
            grid-column: 1 / -1;
        }

        .form-field label {
            font-size: 13px;
            font-weight: 600;
            color: #374151;
        }

        .form-field label .req {
            color: #ef4444;
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
            transition: border-color .2s;
            background: #fff;
        }

        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus {
            border-color: #1a6fc4;
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
            width: 100px;
            flex-shrink: 0;
        }

        /* Traveler step button row */
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
            padding: 28px 28px;
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

        /* Payment method options */
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

        .method-icon {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            flex-shrink: 0;
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
            padding: 28px 28px;
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

        .confirmation-card .confirm-sub {
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
            max-width: 480px;
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
            transition: border-color .2s;
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
            transition: background .2s;
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
        @media (max-width: 768px) {
            .pkg-summary-card {
                flex-direction: column;
            }

            .pkg-img-side {
                flex: none;
                height: 200px;
            }

            .form-grid-2 {
                grid-template-columns: 1fr;
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
        }
    </style>
@endpush

@section('content')

    <div class="booking-page">

        <!-- ── Header with logo + stepper ── -->
        <div class="booking-header">
            <a href="{{ route('home') }}" class="booking-logo">
                <div class="logo-mountain"><i class="fas fa-mountain"></i></div>
                <div>
                    <div class="logo-text-name">Visit Nepal</div>
                    <div class="logo-text-tag">Dream · Explore · Discover</div>
                </div>
            </a>

            <div class="stepper" id="stepper">
                <div class="step-item active" data-step="1">
                    <div class="step-circle"><i class="fas fa-box"></i></div>
                    <span class="step-label">Package</span>
                </div>
                <div class="step-item" data-step="2">
                    <div class="step-circle"><i class="fas fa-user"></i></div>
                    <span class="step-label">Details</span>
                </div>
                <div class="step-item" data-step="3">
                    <div class="step-circle"><i class="fas fa-credit-card"></i></div>
                    <span class="step-label">Payment</span>
                </div>
                <div class="step-item" data-step="4">
                    <div class="step-circle"><i class="fas fa-check"></i></div>
                    <span class="step-label">Confirmation</span>
                </div>
            </div>
        </div><!-- /booking-header -->

        <div class="booking-wrap">

            <!-- ════════════════════════════════════════
                 STEP 1 — Package Summary
            ════════════════════════════════════════ -->
            <div class="booking-step active" id="step-1">
                <div class="pkg-summary-card">

                    <!-- Left: image -->
                    <div class="pkg-img-side">
                        <img src="{{ isset($package) ? $package->featured_image_url : asset('images/landingimg.png') }}"
                            alt="{{ isset($package) ? $package->name : 'Nepal Highlights Tour' }}"
                            onerror="this.style.display='none';this.nextElementSibling.style.display='flex';" />
                        <div class="pkg-img-placeholder-bk">
                            <i class="fas fa-mountain"></i>
                        </div>
                    </div>

                    <!-- Right: info -->
                    <div class="pkg-info-side">
                        <div class="pkg-includes-title">Package Includes</div>
                        <ul class="pkg-includes-list">
                            @if (isset($package) && $package->included)
                                @foreach (array_slice($package->included, 0, 6) as $item)
                                    <li>
                                        <i class="fas fa-check"></i>
                                        {{ $item }}
                                    </li>
                                @endforeach
                            @else
                                @foreach (['Hotel Accommodation', 'Breakfast', 'Sightseeing', 'Private Transport', 'Tour Guide', 'Airport Pickup/Drop'] as $item)
                                    <li><i class="fas fa-check"></i> {{ $item }}</li>
                                @endforeach
                            @endif
                        </ul>

                        <div class="pkg-name-row">
                            {{ isset($package) ? $package->name : 'Nepal Highlights Tour' }}
                        </div>
                        <div class="pkg-meta-row">
                            <span><i class="far fa-clock"></i> {{ isset($package) ? $package->duration_days : 7 }}
                                Days</span>
                            <span><i class="fas fa-moon"></i> {{ isset($package) ? $package->duration_days - 1 : 6 }}
                                Nights</span>
                            <span><i class="fas fa-signal"></i> Easy</span>
                        </div>
                        <div class="pkg-price-row">
                            <div class="pkg-price-label">Package Price</div>
                            <div class="pkg-price-value">
                                ${{ isset($package) ? number_format($package->effective_price, 0) : '750' }}</div>
                        </div>
                        <a href="#" class="pkg-view-link">View Package Details</a>

                        <button class="btn-book-now" onclick="goToStep(2)">Book Now</button>
                    </div>

                </div>
            </div><!-- /step-1 -->


            <!-- ════════════════════════════════════════
                 STEP 2 — Traveler Details
            ════════════════════════════════════════ -->
            <div class="booking-step" id="step-2">
                <div class="traveler-card">
                    <h2>Traveler Information</h2>

                    <div class="form-grid-2">

                        <!-- Full Name -->
                        <div class="form-field full">
                            <label>Full Name <span class="req">*</span></label>
                            <input type="text" id="b_full_name" placeholder="Enter your full name" />
                            <span class="field-error" id="err_b_full_name"
                                style="color:#ef4444;font-size:12px;display:none;">Please enter your full name.</span>
                        </div>

                        <!-- Email -->
                        <div class="form-field full">
                            <label>Email Address <span class="req">*</span></label>
                            <input type="email" id="b_email" placeholder="Enter your email address" />
                            <span class="field-error" id="err_b_email"
                                style="color:#ef4444;font-size:12px;display:none;">Please enter a valid email.</span>
                        </div>

                        <!-- Phone -->
                        <div class="form-field full">
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
                                </select>
                                <input type="tel" id="b_phone" placeholder="Enter your phone number"
                                    style="flex:1;" />
                            </div>
                            <span class="field-error" id="err_b_phone"
                                style="color:#ef4444;font-size:12px;display:none;">Please enter your phone number.</span>
                        </div>

                        <!-- Number of Travelers -->
                        <div class="form-field full">
                            <label>Number of Travelers <span class="req">*</span></label>
                            <select id="b_travelers">
                                <option value="1">1 Traveler</option>
                                <option value="2">2 Travelers</option>
                                <option value="3">3 Travelers</option>
                                <option value="4">4 Travelers</option>
                                <option value="5">5 Travelers</option>
                                <option value="6+">6+ Travelers</option>
                            </select>
                        </div>

                        <!-- Special Request -->
                        <div class="form-field full">
                            <label>Special Request (Optional)</label>
                            <textarea id="b_special" placeholder="Any special request..."></textarea>
                        </div>

                    </div>

                    <div class="step-btns">
                        <button class="btn-back" onclick="goToStep(1)">Back</button>
                        <button class="btn-continue" onclick="validateStep2()">Continue to Payment</button>
                    </div>
                </div>
            </div><!-- /step-2 -->


            <!-- ════════════════════════════════════════
                 STEP 3 — Payment Options
            ════════════════════════════════════════ -->
            <div class="booking-step" id="step-3">
                <div class="payment-grid">

                    <!-- Left: summary -->
                    <div class="payment-summary-card">
                        <h3>Payment Summary</h3>

                        <div class="summary-row">
                            <span class="s-label">Package Name</span>
                            <span class="s-value" id="sum_pkg_name">Nepal Highlights Tour</span>
                        </div>
                        <div class="summary-row">
                            <span class="s-label">Duration</span>
                            <span class="s-value" id="sum_duration">7 Days / 6 Nights</span>
                        </div>
                        <div class="summary-row">
                            <span class="s-label">Travelers</span>
                            <span class="s-value" id="sum_travelers">1</span>
                        </div>
                        <div class="summary-row">
                            <span class="s-label">Price per Person</span>
                            <span class="s-value" id="sum_price_pp">$750</span>
                        </div>
                        <div class="summary-row total">
                            <span class="s-label">Total Amount</span>
                            <span class="s-value" id="sum_total">$750</span>
                        </div>

                        <div class="step-btns" style="border-top:none;padding-top:16px;">
                            <button class="btn-back" onclick="goToStep(2)">Back</button>
                            <button class="btn-continue" onclick="goToStep(4)">Pay Now</button>
                        </div>
                    </div>

                    <!-- Right: payment method -->
                    <div class="payment-method-card">
                        <h3>Choose Payment Method</h3>

                        <!-- Stripe -->
                        <label class="method-option selected" id="method-stripe">
                            <input type="radio" name="pay_method" value="stripe" checked
                                onchange="selectMethod(this)" />
                            <div class="method-label">
                                <i class="fas fa-bolt" style="color:#635bff;"></i> Stripe
                            </div>
                            <div class="method-badges">
                                <span class="badge-visa">VISA</span>
                                <span class="badge-mc">MC</span>
                                <span class="badge-amex">AMEX</span>
                            </div>
                        </label>

                        <!-- Khalti -->
                        <label class="method-option" id="method-khalti">
                            <input type="radio" name="pay_method" value="khalti" onchange="selectMethod(this)" />
                            <div class="method-label">
                                <span
                                    style="background:#5C2D91;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:12px;">K</span>
                                Khalti <span style="font-size:11px;color:#9ca3af;font-weight:400;">(Nepal)</span>
                            </div>
                        </label>

                        <!-- eSewa -->
                        <label class="method-option" id="method-esewa">
                            <input type="radio" name="pay_method" value="esewa" onchange="selectMethod(this)" />
                            <div class="method-label">
                                <span
                                    style="background:#60BB46;color:#fff;border-radius:50%;width:28px;height:28px;display:flex;align-items:center;justify-content:center;font-weight:800;font-size:11px;">e</span>
                                eSewa <span style="font-size:11px;color:#9ca3af;font-weight:400;">(Nepal)</span>
                            </div>
                        </label>

                        <!-- Bank Transfer -->
                        <label class="method-option" id="method-bank">
                            <input type="radio" name="pay_method" value="bank" onchange="selectMethod(this)" />
                            <div class="method-label">
                                <i class="fas fa-university" style="color:#6b7280;font-size:20px;"></i>
                                Bank Transfer
                            </div>
                        </label>

                    </div>

                </div>
            </div><!-- /step-3 -->


            <!-- ════════════════════════════════════════
                 STEP 4 — Stripe Card Payment
            ════════════════════════════════════════ -->
            <div class="booking-step" id="step-4">
                <div class="stripe-grid">

                    <!-- Left: Order Summary -->
                    <div class="order-summary-card">
                        <h3>Order Summary</h3>

                        <div class="summary-row">
                            <span class="s-label">Package Name</span>
                            <span class="s-value" id="stripe_pkg_name">Nepal Highlights Tour</span>
                        </div>
                        <div class="summary-row">
                            <span class="s-label">Duration</span>
                            <span class="s-value" id="stripe_duration">7 Days / 6 Nights</span>
                        </div>
                        <div class="summary-row">
                            <span class="s-label">Travelers</span>
                            <span class="s-value" id="stripe_travelers">1</span>
                        </div>
                        <div class="summary-row total"
                            style="margin-top:12px;padding-top:12px;border-top:2px solid #e5e7eb;">
                            <span class="s-label">Total Amount</span>
                            <span class="s-value" id="stripe_total">$750</span>
                        </div>
                    </div>

                    <!-- Right: Card Form -->
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
                            <span><strong>Secure Payment</strong> — Your payment information is safe with us.</span>
                        </div>
                        <div class="stripe-note">
                            <span>Powered by</span>
                            <strong style="color:#635bff;">Stripe</strong>
                            <i class="fas fa-shield-alt" style="color:#22c55e;"></i>
                            <span>SSL Secured</span>
                        </div>

                        <button class="btn-pay" id="payBtn" onclick="processPayment()">
                            Pay <span id="pay_amount">$750</span>
                        </button>

                        <a class="btn-back-link" onclick="goToStep(3)">
                            ← Back to Payment Options
                        </a>
                    </div>

                </div>
            </div><!-- /step-4 -->


            <!-- ════════════════════════════════════════
                 STEP 5 — Booking Confirmed
            ════════════════════════════════════════ -->
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
                            <span class="cr-value ref" id="conf_booking_id">#VN2505201234</span>
                        </div>
                        <div class="confirm-row">
                            <span class="cr-label">Package</span>
                            <span class="cr-value" id="conf_package">Nepal Highlights Tour</span>
                        </div>
                        <div class="confirm-row">
                            <span class="cr-label">Duration</span>
                            <span class="cr-value" id="conf_duration">7 Days / 6 Nights</span>
                        </div>
                        <div class="confirm-row">
                            <span class="cr-label">Travelers</span>
                            <span class="cr-value" id="conf_travelers">1</span>
                        </div>
                        <div class="confirm-row">
                            <span class="cr-label">Total Amount</span>
                            <span class="cr-value" id="conf_total">$750</span>
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
                        <a href="{{ route('home') }}" class="btn-home">
                            Back to Home
                        </a>
                    </div>

                </div>
            </div><!-- /step-5 -->

        </div><!-- /booking-wrap -->
    </div><!-- /booking-page -->

@endsection


@push('scripts')
    <script>
        /* ═══════════════════════════════════════════
             BOOKING WIZARD STATE
          ═══════════════════════════════════════════ */
        let currentStep = 1;

        // Booking data collected across steps
        const booking = {
            pkgName: '{{ isset($package) ? $package->name : 'Nepal Highlights Tour' }}',
            days: {{ isset($package) ? $package->duration_days : 7 }},
            nights: {{ isset($package) ? $package->duration_days - 1 : 6 }},
            priceEach: {{ isset($package) ? $package->effective_price : 750 }},
            travelers: 1,
            total: {{ isset($package) ? $package->effective_price : 750 }},
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

        /* ── Update stepper UI ── */
        function updateStepper(active) {
            // Map wizard steps (1-5) → stepper steps (1-4)
            // step 5 (confirmation) = stepper step 4 completed
            const stepperMap = {
                1: 1,
                2: 2,
                3: 3,
                4: 3,
                5: 4
            };
            const stepperActive = stepperMap[active] || active;

            document.querySelectorAll('.step-item').forEach((el, i) => {
                const s = i + 1;
                el.classList.remove('active', 'completed');
                if (s < stepperActive) el.classList.add('completed');
                else if (s === stepperActive) el.classList.add('active');
            });

            // On confirmation, mark all completed
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
                    id: 'b_full_name',
                    errId: 'err_b_full_name',
                    fn: v => v.trim().length >= 2
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

            // Update traveler count
            booking.travelers = parseInt(document.getElementById('b_travelers').value) || 1;
            booking.total = booking.priceEach * booking.travelers;

            if (valid) goToStep(3);
        }

        /* ── Fill step 3 summary ── */
        function fillSummary() {
            document.getElementById('sum_pkg_name').textContent = booking.pkgName;
            document.getElementById('sum_duration').textContent = `${booking.days} Days / ${booking.nights} Nights`;
            document.getElementById('sum_travelers').textContent = booking.travelers;
            document.getElementById('sum_price_pp').textContent = `$${booking.priceEach.toLocaleString()}`;
            document.getElementById('sum_total').textContent = `$${booking.total.toLocaleString()}`;
        }

        /* ── Fill step 4 stripe summary ── */
        function fillStripe() {
            document.getElementById('stripe_pkg_name').textContent = booking.pkgName;
            document.getElementById('stripe_duration').textContent = `${booking.days} Days / ${booking.nights} Nights`;
            document.getElementById('stripe_travelers').textContent = booking.travelers;
            document.getElementById('stripe_total').textContent = `$${booking.total.toLocaleString()}`;
            document.getElementById('pay_amount').textContent = `$${booking.total.toLocaleString()}`;
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

        /* ── Process payment (demo) ── */
        function processPayment() {
            const btn = document.getElementById('payBtn');
            const cardNum = document.getElementById('card_number').value.replace(/\s/g, '');
            const expiry = document.getElementById('card_expiry').value;
            const cvc = document.getElementById('card_cvc').value;
            const name = document.getElementById('card_name').value;

            if (cardNum.length < 16 || !expiry || cvc.length < 3 || name.trim().length < 2) {
                alert('Please fill in all card details correctly.');
                return;
            }

            btn.disabled = true;
            btn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Processing...';

            // Simulate payment processing
            setTimeout(() => {
                const ref = '#VN' + Date.now().toString().slice(-10);
                document.getElementById('conf_booking_id').textContent = ref;
                document.getElementById('conf_package').textContent = booking.pkgName;
                document.getElementById('conf_duration').textContent =
                    `${booking.days} Days / ${booking.nights} Nights`;
                document.getElementById('conf_travelers').textContent = booking.travelers;
                document.getElementById('conf_total').textContent = `$${booking.total.toLocaleString()}`;
                goToStep(5);
            }, 1800);
        }
    </script>
@endpush
