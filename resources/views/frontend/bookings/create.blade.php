@extends('layouts.frontend')
@section('title', 'Book Your Trip – ApeakNepal')

@push('styles')
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Playfair+Display:wght@600;700;800&family=DM+Sans:wght@300;400;500;600;700&display=swap');

        /* ═══════════════════════════════════════════════════
                                                                                                       TOKENS
                                                                                                    ═══════════════════════════════════════════════════ */
        :root {
            --navy: #061528;
            --navy-2: #0d2240;
            --blue: #1a6fc4;
            --blue-dark: #1255a0;
            --blue-lt: #e8f2fd;
            --gold: #d4940a;
            --gold-lt: #fef3c7;
            --green: #16a34a;
            --green-lt: #dcfce7;
            --red: #dc2626;
            --surface: #ffffff;
            --surface-2: #f8fafc;
            --border: #e2e8f0;
            --border-2: #cbd5e1;
            --text-1: #0f172a;
            --text-2: #334155;
            --text-3: #64748b;
            --text-4: #94a3b8;
            --radius-lg: 16px;
            --radius: 12px;
            --radius-sm: 8px;
            --radius-xs: 6px;
            --shadow-sm: 0 1px 3px rgba(6, 21, 40, .06), 0 1px 2px rgba(6, 21, 40, .04);
            --shadow: 0 4px 16px rgba(6, 21, 40, .08), 0 1px 4px rgba(6, 21, 40, .04);
            --shadow-lg: 0 20px 48px rgba(6, 21, 40, .12), 0 4px 12px rgba(6, 21, 40, .06);
            --transition: .2s cubic-bezier(.4, 0, .2, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'DM Sans', sans-serif;
        }

        /* ═══════════════════════════════════════════════════
                                                                                                       PAGE SHELL
                                                                                                    ═══════════════════════════════════════════════════ */
        .booking-page {
            min-height: 100vh;
            background: #f0f5fb;
            padding-bottom: 80px;
        }

        /* ── Header ── */
        .booking-header {
            background: linear-gradient(160deg, var(--navy) 0%, var(--navy-2) 60%, #1a3a6b 100%);
            padding: 0;
            position: relative;
            overflow: hidden;
        }

        /* Subtle geometric texture overlay */
        .booking-header::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image:
                radial-gradient(circle at 20% 50%, rgba(26, 111, 196, .15) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(212, 148, 10, .08) 0%, transparent 40%);
            pointer-events: none;
        }

        .booking-header-inner {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px clamp(20px, 5vw, 48px) 0;
            position: relative;
            z-index: 1;
        }

        .booking-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            color: #fff;
            text-decoration: none;
        }

        .logo-mark {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, rgba(255, 255, 255, .18), rgba(255, 255, 255, .06));
            border: 1px solid rgba(255, 255, 255, .2);
            border-radius: var(--radius-sm);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 20px;
            flex-shrink: 0;
            backdrop-filter: blur(8px);
        }

        .logo-text-name {
            font-family: 'Playfair Display', serif;
            font-size: 19px;
            font-weight: 700;
            letter-spacing: .3px;
            display: block;
        }

        .logo-text-tag {
            font-size: 10px;
            opacity: .55;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            display: block;
            margin-top: 1px;
        }

        /* ── Stepper ── */
        .stepper-wrap {
            padding: 60px clamp(30px, 10vw, 60px) 0;
            position: relative;
            z-index: 1;
        }

        .stepper {
            display: flex;
            align-items: flex-start;
            justify-content: center;
            gap: 0;
            overflow-x: auto;
            scrollbar-width: none;
            padding-bottom: 0;
        }

        .stepper::-webkit-scrollbar {
            display: none;
        }

        .step-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            position: relative;
            min-width: 80px;
            flex: 1;
            max-width: 130px;
        }

        .step-item:not(:last-child)::after {
            content: '';
            position: absolute;
            top: 15px;
            left: calc(50% + 18px);
            width: calc(100% - 36px);
            height: 2px;
            background: rgba(255, 255, 255, .15);
            transition: background .4s ease;
        }

        .step-item.completed:not(:last-child)::after {
            background: #4ade80;
        }

        .step-circle {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, .25);
            background: rgba(255, 255, 255, .06);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 600;
            color: rgba(255, 255, 255, .4);
            position: relative;
            z-index: 1;
            transition: all .3s ease;
        }

        .step-item.active .step-circle {
            background: #fff;
            border-color: #fff;
            color: var(--navy);
            font-weight: 700;
            box-shadow: 0 0 0 4px rgba(255, 255, 255, .15);
        }

        .step-item.completed .step-circle {
            background: #4ade80;
            border-color: #4ade80;
            color: #fff;
        }

        .step-label {
            font-size: 10px;
            color: rgba(255, 255, 255, .4);
            margin-top: 7px;
            white-space: nowrap;
            font-weight: 500;
            letter-spacing: .3px;
            padding-bottom: 16px;
        }

        .step-item.active .step-label {
            color: #fff;
            font-weight: 600;
        }

        .step-item.completed .step-label {
            color: #4ade80;
        }

        /* ── Booking wrap ── */
        .booking-wrap {
            max-width: 1020px;
            margin: 32px auto 0;
            padding: 0 clamp(12px, 4vw, 20px);
        }

        .booking-step {
            display: none;
        }

        .booking-step.active {
            display: block;
            animation: fadeSlide .3s ease;
        }

        @keyframes fadeSlide {
            from {
                opacity: 0;
                transform: translateY(10px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* ═══════════════════════════════════════════════════
                                                                                                       STEP 1 — Package Summary
                                                                                                    ═══════════════════════════════════════════════════ */
        .pkg-summary-card {
            display: grid;
            grid-template-columns: 380px 1fr;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            background: var(--surface);
            min-height: 520px;
        }

        /* ── Image side — definitive fix ── */
        .pkg-img-side {
            position: relative;
            overflow: hidden;
            background: linear-gradient(160deg, var(--navy) 0%, #1a4a8a 100%);
            /* stretch to fill grid height on all screen sizes */
            display: grid;
        }

        /* The img is absolutely positioned to fill its container perfectly */
        .pkg-img-side img.pkg-hero-img {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center top;
            display: block;
            transition: transform .5s ease, opacity .3s ease;
            will-change: transform;
        }

        .pkg-img-side:hover img.pkg-hero-img {
            transform: scale(1.04);
        }

        /* Multi-layer gradient — rich, cinematic look */
        .pkg-img-overlay {
            position: absolute;
            inset: 0;
            z-index: 1;
            background:
                linear-gradient(to right, rgba(6, 21, 40, .3) 0%, transparent 40%),
                linear-gradient(to top, rgba(6, 21, 40, .75) 0%, transparent 55%),
                linear-gradient(to bottom, rgba(6, 21, 40, .4) 0%, transparent 30%);
            pointer-events: none;
        }

        /* Fallback — visible only on img error, never visible otherwise */
        .pkg-img-fallback {
            position: absolute;
            inset: 0;
            z-index: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 12px;
            color: rgba(255, 255, 255, .25);
            font-size: 56px;
            background: linear-gradient(160deg, var(--navy), #1a4a8a);
        }

        .pkg-img-fallback span {
            font-size: 13px;
            font-weight: 600;
            color: rgba(255, 255, 255, .3);
            letter-spacing: .5px;
        }

        /* Badges & labels over image */
        .pkg-img-top {
            position: absolute;
            top: 16px;
            left: 16px;
            right: 16px;
            z-index: 2;
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
        }

        .img-badge {
            display: flex;
            align-items: center;
            gap: 6px;
            background: rgba(255, 255, 255, .14);
            backdrop-filter: blur(12px);
            border: 1px solid rgba(255, 255, 255, .2);
            color: #fff;
            border-radius: 50px;
            padding: 5px 12px;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: .3px;
        }

        .img-badge i {
            color: #fbbf24;
            font-size: 10px;
        }

        .img-type-pill {
            background: rgba(212, 148, 10, .85);
            backdrop-filter: blur(8px);
            color: #fff;
            border-radius: 50px;
            padding: 5px 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        /* Bottom info strip pinned to image bottom */
        .pkg-img-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 2;
            padding: 20px 20px 18px;
        }

        .pkg-img-title {
            font-family: 'Playfair Display', serif;
            font-size: clamp(18px, 3vw, 24px);
            font-weight: 700;
            color: #fff;
            line-height: 1.25;
            margin-bottom: 10px;
            text-shadow: 0 2px 8px rgba(0, 0, 0, .3);
        }

        .pkg-img-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .img-chip {
            display: flex;
            align-items: center;
            gap: 5px;
            background: rgba(255, 255, 255, .13);
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, .18);
            color: rgba(255, 255, 255, .9);
            border-radius: 50px;
            padding: 4px 10px;
            font-size: 11px;
            font-weight: 500;
        }

        .img-chip i {
            font-size: 9px;
            color: rgba(255, 255, 255, .65);
        }

        /* ── Info side ── */
        .pkg-info-side {
            padding: clamp(24px, 3vw, 40px);
            display: flex;
            flex-direction: column;
            overflow-y: auto;
        }

        .pkg-section-label {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: var(--blue);
            margin-bottom: 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .pkg-section-label::after {
            content: '';
            flex: 1;
            height: 1px;
            background: var(--blue-lt);
        }

        .pkg-includes-list {
            list-style: none;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 8px;
            margin-bottom: 24px;
        }

        .pkg-includes-list li {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 13px;
            color: var(--text-2);
        }

        .pkg-includes-list .chk {
            width: 18px;
            height: 18px;
            flex-shrink: 0;
            background: var(--green-lt);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--green);
            font-size: 9px;
        }

        .pkg-divider {
            border: none;
            border-top: 1px solid var(--border);
            margin: 20px 0;
        }

        .pkg-price-block {
            margin-bottom: 4px;
        }

        .pkg-price-from {
            font-size: 11px;
            color: var(--text-4);
            margin-bottom: 2px;
            text-transform: uppercase;
            letter-spacing: .8px;
        }

        .pkg-price-amount {
            font-family: 'Playfair Display', serif;
            font-size: clamp(28px, 4vw, 38px);
            font-weight: 700;
            color: var(--navy);
            line-height: 1;
        }

        .pkg-price-amount sub {
            font-family: 'DM Sans', sans-serif;
            font-size: 13px;
            font-weight: 500;
            color: var(--text-4);
            vertical-align: baseline;
        }

        .pkg-view-link {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: 12px;
            color: var(--blue);
            font-weight: 600;
            text-decoration: none;
            margin-top: 6px;
            transition: gap var(--transition);
        }

        .pkg-view-link:hover {
            gap: 8px;
        }

        .pkg-view-link i {
            font-size: 10px;
        }

        .btn-book-now {
            margin-top: auto;
            padding-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--blue) 0%, var(--blue-dark) 100%);
            color: #fff;
            border: none;
            padding: 15px 32px;
            border-radius: var(--radius);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            letter-spacing: .3px;
            box-shadow: 0 6px 20px rgba(26, 111, 196, .35);
            transition: all var(--transition);
            align-self: stretch;
            margin-top: auto;
        }

        .btn-book-now:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 28px rgba(26, 111, 196, .45);
        }

        .btn-book-now .btn-arrow {
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .2);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            transition: transform var(--transition);
        }

        .btn-book-now:hover .btn-arrow {
            transform: translateX(3px);
        }

        /* ═══════════════════════════════════════════════════
                                                                                                       STEP 2 — Traveler Details
                                                                                                    ═══════════════════════════════════════════════════ */
        .traveler-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            padding: clamp(24px, 4vw, 44px);
            box-shadow: var(--shadow);
        }

        .traveler-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: 24px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 4px;
        }

        .traveler-card>p {
            font-size: 13px;
            color: var(--text-4);
            margin-bottom: 30px;
        }

        .form-section {
            margin-bottom: 30px;
        }

        .form-section:last-of-type {
            margin-bottom: 0;
        }

        .form-section-title {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: var(--blue);
            padding-bottom: 10px;
            border-bottom: 2px solid var(--blue-lt);
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
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
            gap: 5px;
        }

        .form-field.full {
            grid-column: 1 / -1;
        }

        .form-field.span-2 {
            grid-column: span 2;
        }

        .form-field label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: var(--text-2);
        }

        .form-field label .req {
            color: var(--red);
        }

        .form-field label .opt {
            font-size: 10px;
            color: var(--text-4);
            font-weight: 400;
            text-transform: none;
        }

        .form-field input,
        .form-field select,
        .form-field textarea {
            width: 100%;
            padding: 11px 14px;
            border: 1.5px solid var(--border);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--text-1);
            background: var(--surface-2);
            outline: none;
            transition: border-color var(--transition), background var(--transition), box-shadow var(--transition);
        }

        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus {
            border-color: var(--blue);
            background: var(--surface);
            box-shadow: 0 0 0 3px rgba(26, 111, 196, .09);
        }

        .form-field input.err {
            border-color: var(--red);
            box-shadow: 0 0 0 3px rgba(220, 38, 38, .08);
        }

        .form-field textarea {
            resize: vertical;
            min-height: 88px;
        }

        .field-error {
            font-size: 11px;
            color: var(--red);
            display: none;
            margin-top: 1px;
        }

        .field-hint {
            font-size: 11px;
            color: var(--text-4);
            margin-top: 1px;
        }

        .phone-row {
            display: flex;
            gap: 8px;
        }

        .phone-code {
            width: 112px;
            flex-shrink: 0;
        }

        .step-btns {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 28px;
            padding-top: 20px;
            border-top: 1px solid var(--border);
            flex-wrap: wrap;
            gap: 12px;
        }

        .btn-back {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 11px 24px;
            border: 1.5px solid var(--border-2);
            border-radius: var(--radius-sm);
            background: var(--surface);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-2);
            cursor: pointer;
            transition: all var(--transition);
        }

        .btn-back:hover {
            border-color: var(--blue);
            color: var(--blue);
        }

        .btn-continue {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 11px 28px;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            cursor: pointer;
            box-shadow: 0 4px 14px rgba(26, 111, 196, .28);
            transition: all var(--transition);
        }

        .btn-continue:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26, 111, 196, .38);
        }

        /* ═══════════════════════════════════════════════════
                                                                                                       STEP 3 — Payment Options
                                                                                                    ═══════════════════════════════════════════════════ */
        .payment-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .payment-summary-card,
        .payment-method-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            padding: clamp(20px, 3vw, 32px);
            box-shadow: var(--shadow);
        }

        .payment-summary-card h3,
        .payment-method-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 17px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 18px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
            gap: 12px;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-row .s-label {
            color: var(--text-3);
        }

        .summary-row .s-value {
            font-weight: 600;
            color: var(--text-1);
            text-align: right;
        }

        .summary-row.total {
            margin-top: 4px;
            padding-top: 14px;
            border-top: 2px solid var(--border);
        }

        .summary-row.total .s-label {
            font-weight: 700;
            color: var(--navy);
            font-size: 14px;
        }

        .summary-row.total .s-value {
            font-weight: 800;
            color: var(--blue);
            font-size: 22px;
        }

        .method-option {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border: 2px solid var(--border);
            border-radius: var(--radius);
            margin-bottom: 10px;
            cursor: pointer;
            transition: all var(--transition);
        }

        .method-option:hover {
            border-color: #93c5fd;
            background: #f8fbff;
        }

        .method-option.selected {
            border-color: var(--blue);
            background: var(--blue-lt);
        }

        .method-option input[type="radio"] {
            accent-color: var(--blue);
            width: 16px;
            height: 16px;
            flex-shrink: 0;
        }

        .method-label {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-1);
            flex: 1;
        }

        .method-badges {
            display: flex;
            gap: 5px;
            margin-left: auto;
        }

        .badge-visa {
            background: #1a1f71;
            color: #fff;
            font-size: 9px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 4px;
        }

        .badge-mc {
            background: linear-gradient(90deg, #eb001b, #f79e1b);
            color: #fff;
            font-size: 9px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 4px;
        }

        .badge-amex {
            background: #2e77bc;
            color: #fff;
            font-size: 9px;
            font-weight: 800;
            padding: 2px 7px;
            border-radius: 4px;
        }

        /* ═══════════════════════════════════════════════════
                                                                                                       STEP 4 — Stripe Card
                                                                                                    ═══════════════════════════════════════════════════ */
        .stripe-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        .order-summary-card,
        .card-form-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            padding: clamp(20px, 3vw, 32px);
            box-shadow: var(--shadow);
        }

        .order-summary-card h3,
        .card-form-card h3 {
            font-family: 'Playfair Display', serif;
            font-size: 17px;
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 18px;
        }

        .card-number-wrap {
            position: relative;
        }

        .card-number-wrap input {
            padding-right: 96px;
            width: 100%;
        }

        .card-brand-badges {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            gap: 4px;
            pointer-events: none;
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
            margin-top: 12px;
            font-size: 13px;
            color: var(--text-3);
            cursor: pointer;
        }

        .save-card-row input {
            accent-color: var(--blue);
            cursor: pointer;
        }

        .secure-note {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 12px;
            color: var(--text-4);
            margin-top: 12px;
        }

        .secure-note i {
            color: var(--green);
        }

        .stripe-note {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 11px;
            color: var(--text-4);
            margin-top: 5px;
        }

        .stripe-note strong {
            color: #635bff;
        }

        .btn-pay {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 15px;
            font-weight: 700;
            color: #fff;
            cursor: pointer;
            margin-top: 18px;
            box-shadow: 0 4px 16px rgba(26, 111, 196, .3);
            transition: all var(--transition);
        }

        .btn-pay:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 24px rgba(26, 111, 196, .4);
        }

        .btn-pay:disabled {
            opacity: .65;
            cursor: not-allowed;
            transform: none;
        }

        .btn-back-link {
            display: block;
            text-align: center;
            margin-top: 12px;
            font-size: 13px;
            color: var(--text-4);
            cursor: pointer;
            text-decoration: none;
            transition: color var(--transition);
        }

        .btn-back-link:hover {
            color: var(--blue);
        }

        /* ═══════════════════════════════════════════════════
                                                                                                       STEP 5 — Confirmation
                                                                                                    ═══════════════════════════════════════════════════ */
        .confirmation-card {
            background: var(--surface);
            border-radius: var(--radius-lg);
            padding: clamp(32px, 5vw, 56px) clamp(24px, 5vw, 52px);
            box-shadow: var(--shadow);
            text-align: center;
        }

        .confirm-check {
            width: 80px;
            height: 80px;
            background: var(--green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 22px;
            font-size: 32px;
            color: #fff;
            box-shadow: 0 8px 28px rgba(22, 163, 74, .25);
            animation: popIn .5s cubic-bezier(.34, 1.56, .64, 1);
        }

        @keyframes popIn {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .confirmation-card h2 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(22px, 4vw, 28px);
            font-weight: 700;
            color: var(--navy);
            margin-bottom: 8px;
        }

        .confirm-sub {
            font-size: 14px;
            color: var(--text-3);
            margin-bottom: 30px;
            line-height: 1.6;
        }

        .confirm-details {
            background: var(--surface-2);
            border-radius: var(--radius);
            padding: 18px 22px;
            text-align: left;
            max-width: 520px;
            margin: 0 auto 28px;
            border: 1px solid var(--border);
        }

        .confirm-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 9px 0;
            border-bottom: 1px solid var(--border);
            font-size: 13px;
            gap: 12px;
        }

        .confirm-row:last-child {
            border-bottom: none;
        }

        .confirm-row .cr-label {
            color: var(--text-3);
        }

        .confirm-row .cr-value {
            font-weight: 700;
            color: var(--text-1);
            text-align: right;
        }

        .confirm-row .cr-value.paid {
            color: var(--green);
        }

        .confirm-row .cr-value.ref {
            color: var(--blue);
            font-family: 'DM Mono', monospace;
            font-size: 12px;
        }

        .confirm-btn-row {
            display: flex;
            gap: 12px;
            justify-content: center;
            flex-wrap: wrap;
        }

        .btn-download {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 22px;
            border: 1.5px solid var(--border-2);
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: var(--text-2);
            background: var(--surface);
            text-decoration: none;
            transition: all var(--transition);
        }

        .btn-download:hover {
            border-color: var(--blue);
            color: var(--blue);
        }

        .btn-home {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 11px 26px;
            background: linear-gradient(135deg, var(--blue), var(--blue-dark));
            border: none;
            border-radius: var(--radius-sm);
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            color: #fff;
            text-decoration: none;
            box-shadow: 0 4px 14px rgba(26, 111, 196, .28);
            transition: all var(--transition);
        }
        .phone-row {
    display: flex;
    gap: 8px;
    align-items: center;
}

.phone-code {
    flex: 0 0 100px;   /* fixed width, won't grow or shrink */
    width: 100px;
    max-width: 100px;
    padding: 10px 6px;
    border: 1px solid var(--line);
    border-radius: 6px;
    font-size: .85rem;
    background: #fff;
    color: var(--ink);   /* <- this is likely why typed text wasn't visible */
}

.phone-code:focus {
    outline: none;
    border-color: var(--green);
}

#b_phone {
    flex: 1 1 auto;    /* takes up all remaining space */
    min-width: 0;      /* prevents flex overflow bugs in some browsers */
    padding: 10px 14px;
    border: 1px solid var(--line);
    border-radius: 6px;
    font-size: .87rem;
    color: var(--ink);   /* <- and this */
}

#b_phone:focus {
    outline: none;
    border-color: var(--green);
}

        .btn-home:hover {
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(26, 111, 196, .38);
        }

        /* ═══════════════════════════════════════════════════
                                                                                                       RESPONSIVE
                                                                                                    ═══════════════════════════════════════════════════ */
        @media (max-width: 920px) {
            .pkg-summary-card {
                grid-template-columns: 1fr;
            }

            .pkg-img-side {
                height: 300px;
                /* img absolute still works — container now has fixed height */
            }

            .pkg-includes-list {
                grid-template-columns: 1fr;
            }

            .payment-grid,
            .stripe-grid {
                grid-template-columns: 1fr;
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

            .pkg-img-side {
                height: 240px;
            }

            .traveler-card {
                padding: 20px 16px;
            }

            .step-btns {
                flex-direction: column-reverse;
            }

            .step-btns .btn-back,
            .step-btns .btn-continue {
                width: 100%;
                justify-content: center;
            }

            .confirm-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 2px;
            }

            .confirm-row .cr-value {
                text-align: left;
            }
        }
    </style>
@endpush


@section('content')

    {{-- PHP → JS bridge --}}
    <script>
        const BOOKING_DATA = {
            type: "{{ $package ? 'package' : ($trek ? 'trek' : 'custom') }}",
            packageId: {{ $package?->id ?? 'null' }},
            trekId: {{ $trek?->id ?? 'null' }},
            pkgName: "{{ addslashes($item?->name ?? 'Nepal Highlights Tour') }}",
            days: {{ $item?->duration_days ?? 7 }},
            nights: {{ ($item?->duration_days ?? 7) - 1 }},
            priceEach: {{ $item ? (float) ($item->price_usd_discounted ?? ($item->price_usd ?? 750)) : 750 }},
            bookingUrl: "{{ route('bookings.store') }}",
            csrfToken: "{{ csrf_token() }}",
        };
    </script>

    <div class="booking-page">

        {{-- ── Header + Stepper ── --}}
        <div class="booking-header">
            <div class="booking-header-inner">
                {{-- <a href="{{ route('home') }}" class="booking-logo">
                    <div class="logo-mark">
                        @php
                            $logo = setting('site_logo');
                            $logoUrl = $logo
                                ? (Str::startsWith($logo, 'http')
                                    ? $logo
                                    : asset('storage/' . $logo))
                                : null;
                        @endphp
                        @if ($logoUrl)
                            <img src="{{ $logoUrl }}" alt="{{ setting('site_name', 'Visit Nepal') }}"
                                style="width:100%;height:100%;object-fit:contain;border-radius:6px;"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='block';">
                            <i class="fas fa-mountain" style="display:none;"></i>
                        @else
                            <i class="fas fa-mountain"></i>
                        @endif
                    </div>
                    <div>
                        <span class="logo-text-name">{{ setting('site_name', 'Visit Nepal') }}</span>
                        <span class="logo-text-tag">{{ setting('tagline', 'Dream · Explore · Discover') }}</span>
                    </div>
                </a> --}}
            </div>


            <div class="stepper-wrap">
                <div class="stepper">
                    <div class="step-item active">
                        <div class="step-circle">1</div>
                        <span class="step-label">Overview</span>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">2</div>
                        <span class="step-label">Traveler</span>
                    </div>
                    <div class="step-item">
                        <div class="step-circle">3</div>
                        <span class="step-label">Payment</span>
                    </div>
                    <div class="step-item">
                        <div class="step-circle"><i class="fas fa-check" style="font-size:11px;"></i></div>
                        <span class="step-label">Confirmed</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="booking-wrap">

            {{-- ══════════════════════════════════════
             STEP 1 — Package Overview
        ══════════════════════════════════════ --}}
            <div class="booking-step active" id="step-1">
                <div class="pkg-summary-card">

                    {{-- ── IMAGE SIDE ── --}}
                    <div class="pkg-img-side">
                        @php
                            $img = $item?->featured_image;
                            $imgUrl = $img
                                ? (Str::startsWith($img, 'http')
                                    ? $img
                                    : asset('storage/' . $img))
                                : asset('images/landingimg.png');
                            $itemType = $package ? 'Package' : ($trek ? 'Trek' : 'Tour');
                        @endphp
                        {{-- Fallback content if image fails to load --}}
                        <div class="pkg-img-fallback">
                            <i class="fas fa-mountain"></i>
                            <span>{{ setting('site_name', 'Visit Nepal') }}</span>
                        </div>

                        {{-- Hero image --}}
                        <img class="pkg-hero-img" src="{{ $imgUrl }}" alt="{{ $item?->name ?? 'Nepal Tour' }}"
                            onerror="this.style.opacity='0';" />

                        {{-- Cinematic overlay --}}
                        <div class="pkg-img-overlay"></div>

                        {{-- Top badges --}}
                        <div class="pkg-img-top">
                            <div class="img-badge">
                                <i class="fas fa-star"></i> Top Rated
                            </div>
                            <div class="img-type-pill">{{ $itemType }}</div>
                        </div>

                        {{-- Bottom: title + chips --}}
                        <div class="pkg-img-bottom">
                            <div class="pkg-img-title">
                                {{ $item?->name ?? 'Nepal Highlights Tour' }}
                            </div>
                            <div class="pkg-img-chips">
                                <div class="img-chip">
                                    <i class="far fa-clock"></i>
                                    {{ $item?->duration_days ?? 7 }} Days
                                </div>
                                <div class="img-chip">
                                    <i class="fas fa-moon"></i>
                                    {{ ($item?->duration_days ?? 7) - 1 }} Nights
                                </div>
                                @if ($trek?->difficulty)
                                    <div class="img-chip">
                                        <i class="fas fa-signal"></i>
                                        {{ $trek->difficulty }}
                                    </div>
                                @endif
                                @if ($trek?->max_altitude)
                                    <div class="img-chip">
                                        <i class="fas fa-mountain"></i>
                                        {{ $trek->max_altitude }}
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                    {{-- ── INFO SIDE ── --}}
                    <div class="pkg-info-side">

                        <p class="pkg-section-label">What's Included</p>
                        <ul class="pkg-includes-list">
                            @if ($item && !empty($item->included))
                                @foreach (array_slice($item->included, 0, 6) as $inc)
                                    <li>
                                        <span class="chk"><i class="fas fa-check"></i></span>
                                        {{ $inc }}
                                    </li>
                                @endforeach
                            @else
                                @foreach (['Hotel Accommodation', 'Daily Breakfast', 'Sightseeing Tours', 'Private Transport', 'Expert Tour Guide', 'Airport Transfers'] as $inc)
                                    <li>
                                        <span class="chk"><i class="fas fa-check"></i></span>
                                        {{ $inc }}
                                    </li>
                                @endforeach
                            @endif
                        </ul>

                        <hr class="pkg-divider">

                        <div class="pkg-price-block">
                            <div class="pkg-price-from">Starts from</div>
                            <div class="pkg-price-amount">
                                ${{ $item ? number_format((float) ($item->price_usd_discounted ?? ($item->price_usd ?? 750)), 0) : '750' }}
                                <sub>/ person</sub>
                            </div>
                        </div>

                        @if ($package)
                            <a href="{{ route('packages.show', $package->slug) }}" class="pkg-view-link">
                                View full package details
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @elseif($trek)
                            <a href="{{ route('treks.show', $trek->slug) }}" class="pkg-view-link">
                                View full trek details
                                <i class="fas fa-arrow-right"></i>
                            </a>
                        @endif

                        <button class="btn-book-now" onclick="goToStep(2)" style="margin-top:20px;">
                            Book This {{ $itemType }}
                            <span class="btn-arrow"><i class="fas fa-arrow-right"></i></span>
                        </button>

                    </div>
                </div>
            </div>{{-- /step-1 --}}


            {{-- ══════════════════════════════════════
             STEP 2 — Traveler Details
        ══════════════════════════════════════ --}}
            <div class="booking-step" id="step-2">
                <div class="traveler-card">
                    <h2>Traveler Information</h2>
                    <p>Please fill in the details below. Fields marked <span style="color:var(--red)">*</span> are required.
                    </p>

                    {{-- Personal Details --}}
                    <div class="form-section">
                        <div class="form-section-title"><i class="fas fa-user"></i> Personal Details</div>
                        <div class="form-grid-2">

                            <div class="form-field">
                                <label>First Name <span class="req">*</span></label>
                                <input type="text" id="b_first_name" placeholder="First name" />
                                <span class="field-error" id="err_b_first_name">Required.</span>
                            </div>

                            <div class="form-field">
                                <label>Last Name <span class="req">*</span></label>
                                <input type="text" id="b_last_name" placeholder="Last name" />
                                <span class="field-error" id="err_b_last_name">Required.</span>
                            </div>

                            <div class="form-field">
                                <label>Email Address <span class="req">*</span></label>
                                <input type="email" id="b_email" placeholder="you@example.com" />
                                <span class="field-error" id="err_b_email">Enter a valid email.</span>
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
                                <span class="field-error" id="err_b_phone">Enter a valid phone number.</span>
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
                                <span class="field-hint">Required for international treks &amp; permits.</span>
                            </div>

                        </div>
                    </div>

                    {{-- Trip Details --}}
                    <div class="form-section">
                        <div class="form-section-title"><i class="fas fa-calendar-alt"></i> Trip Details</div>
                        <div class="form-grid-2">

                            <div class="form-field">
                                <label>Trip Start Date <span class="req">*</span></label>
                                <input type="date" id="b_start_date"
                                    min="{{ date('Y-m-d', strtotime('+1 day')) }}" />
                                <span class="field-error" id="err_b_start_date">Select a start date.</span>
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

                    {{-- Preferences --}}
                    <div class="form-section">
                        <div class="form-section-title"><i class="fas fa-sliders-h"></i> Preferences</div>
                        <div class="form-grid-2">

                            <div class="form-field">
                                <label>Accommodation <span class="opt">(optional)</span></label>
                                <select id="b_accommodation">
                                    <option value="">-- Select preference --</option>
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
                            <i class="fas fa-arrow-left"></i> Back
                        </button>
                        <button class="btn-continue" onclick="validateStep2()">
                            Continue to Payment <i class="fas fa-arrow-right"></i>
                        </button>
                    </div>
                </div>
            </div>{{-- /step-2 --}}


            {{-- ══════════════════════════════════════
             STEP 3 — Payment Options
        ══════════════════════════════════════ --}}
            <div class="booking-step" id="step-3">
                <div class="payment-grid">

                    <div class="payment-summary-card">
                        <h3>Payment Summary</h3>
                        <div class="summary-row"><span class="s-label">Package</span><span class="s-value"
                                id="sum_pkg_name">—</span></div>
                        <div class="summary-row"><span class="s-label">Duration</span><span class="s-value"
                                id="sum_duration">—</span></div>
                        <div class="summary-row"><span class="s-label">Adults</span><span class="s-value"
                                id="sum_travelers">1</span></div>
                        <div class="summary-row"><span class="s-label">Children</span><span class="s-value"
                                id="sum_children">0</span></div>
                        <div class="summary-row"><span class="s-label">Price / Person</span><span class="s-value"
                                id="sum_price_pp">—</span></div>
                        <div class="summary-row"><span class="s-label">Start Date</span><span class="s-value"
                                id="sum_start_date">—</span></div>
                        <div class="summary-row total"><span class="s-label">Total Amount</span><span class="s-value"
                                id="sum_total">—</span></div>
                        <div class="step-btns" style="border-top:none;padding-top:16px;">
                            <button class="btn-back" onclick="goToStep(2)"><i class="fas fa-arrow-left"></i>
                                Back</button>
                            <button class="btn-continue" onclick="goToStep(4)">Pay Now <i
                                    class="fas fa-arrow-right"></i></button>
                        </div>
                    </div>

                    <div class="payment-method-card">
                        <h3>Payment Method</h3>

                        <label class="method-option selected" id="method-stripe">
                            <input type="radio" name="pay_method" value="stripe" checked
                                onchange="selectMethod(this)" />
                            <div class="method-label"><i class="fas fa-bolt" style="color:#635bff;font-size:16px;"></i>
                                Stripe</div>
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
                                    style="background:#5C2D91;color:#fff;border-radius:50%;width:26px;height:26px;display:inline-flex;align-items:center;justify-content:center;font-weight:800;font-size:11px;flex-shrink:0;">K</span>
                                Khalti <span style="font-size:11px;color:var(--text-4);font-weight:400;">(Nepal)</span>
                            </div>
                        </label>

                        <label class="method-option" id="method-esewa">
                            <input type="radio" name="pay_method" value="esewa" onchange="selectMethod(this)" />
                            <div class="method-label">
                                <span
                                    style="background:#60BB46;color:#fff;border-radius:50%;width:26px;height:26px;display:inline-flex;align-items:center;justify-content:center;font-weight:800;font-size:11px;flex-shrink:0;">e</span>
                                eSewa <span style="font-size:11px;color:var(--text-4);font-weight:400;">(Nepal)</span>
                            </div>
                        </label>

                        <label class="method-option" id="method-bank">
                            <input type="radio" name="pay_method" value="bank" onchange="selectMethod(this)" />
                            <div class="method-label">
                                <i class="fas fa-university" style="color:var(--text-3);font-size:18px;"></i>
                                Bank Transfer
                            </div>
                        </label>
                    </div>

                </div>
            </div>{{-- /step-3 --}}


            {{-- ══════════════════════════════════════
             STEP 4 — Card Payment
        ══════════════════════════════════════ --}}
            <div class="booking-step" id="step-4">
                <div class="stripe-grid">

                    <div class="order-summary-card">
                        <h3>Order Summary</h3>
                        <div class="summary-row"><span class="s-label">Package</span><span class="s-value"
                                id="stripe_pkg_name">—</span></div>
                        <div class="summary-row"><span class="s-label">Traveler</span><span class="s-value"
                                id="stripe_traveler_name">—</span></div>
                        <div class="summary-row"><span class="s-label">Duration</span><span class="s-value"
                                id="stripe_duration">—</span></div>
                        <div class="summary-row"><span class="s-label">Adults / Children</span><span class="s-value"
                                id="stripe_travelers">—</span></div>
                        <div class="summary-row"><span class="s-label">Start Date</span><span class="s-value"
                                id="stripe_start_date">—</span></div>
                        <div class="summary-row total"><span class="s-label">Total Amount</span><span class="s-value"
                                id="stripe_total">—</span></div>
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
                                <input type="text" id="card_cvc" placeholder="•••" maxlength="4" />
                            </div>
                        </div>

                        <div class="form-field">
                            <label>Cardholder Name</label>
                            <input type="text" id="card_name" placeholder="Name on card" />
                        </div>

                        <label class="save-card-row">
                            <input type="checkbox" id="save_card" /> Save card for future payments
                        </label>

                        <div class="secure-note">
                            <i class="fas fa-lock"></i>
                            <span><strong>Secure Payment</strong> — Your information is safe with us.</span>
                        </div>
                        <div class="stripe-note">
                            Powered by <strong>Stripe</strong>
                            <i class="fas fa-shield-alt" style="color:var(--green);"></i> SSL Secured
                        </div>

                        <button class="btn-pay" id="payBtn" onclick="processPayment()">
                            Pay <span id="pay_amount">—</span>
                        </button>

                        <a class="btn-back-link" onclick="goToStep(3)">← Back to Payment Options</a>
                    </div>

                </div>
            </div>{{-- /step-4 --}}


            {{-- ══════════════════════════════════════
             STEP 5 — Confirmation
        ══════════════════════════════════════ --}}
            <div class="booking-step" id="step-5">
                <div class="confirmation-card">
                    <div class="confirm-check"><i class="fas fa-check"></i></div>
                    <h2>Booking Confirmed!</h2>
                    <p class="confirm-sub">
                        Thank you for booking with {{ setting('site_name', 'Visit Nepal') }}.<br>
                        We have sent the booking details to your email.
                    </p>
                    <div class="confirm-details">
                        <div class="confirm-row"><span class="cr-label">Booking ID</span><span class="cr-value ref"
                                id="conf_booking_id">—</span></div>
                        <div class="confirm-row"><span class="cr-label">Traveler</span><span class="cr-value"
                                id="conf_traveler">—</span></div>
                        <div class="confirm-row"><span class="cr-label">Package</span><span class="cr-value"
                                id="conf_package">—</span></div>
                        <div class="confirm-row"><span class="cr-label">Duration</span><span class="cr-value"
                                id="conf_duration">—</span></div>
                        <div class="confirm-row"><span class="cr-label">Start Date</span><span class="cr-value"
                                id="conf_start_date">—</span></div>
                        <div class="confirm-row"><span class="cr-label">Adults / Children</span><span class="cr-value"
                                id="conf_travelers">—</span></div>
                        <div class="confirm-row"><span class="cr-label">Total Amount</span><span class="cr-value"
                                id="conf_total">—</span></div>
                        <div class="confirm-row"><span class="cr-label">Payment Status</span><span
                                class="cr-value paid">Paid</span></div>
                    </div>
                    <div class="confirm-btn-row">
                        <a href="#" id="invoiceDownloadBtn" class="btn-download">
                            <i class="fas fa-download"></i>
                            Download Invoice
                        </a>
                        <a href="{{ route('home') }}" class="btn-home">Back to Home</a>
                    </div>
                </div>
            </div>{{-- /step-5 --}}

        </div>{{-- /booking-wrap --}}
    </div>{{-- /booking-page --}}

@endsection


@push('scripts')
    <script>
        /* ═══════════════════════════════════════════
                                                                                                       BOOKING WIZARD — unchanged backend logic
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
                const ok = fn(el.value);
                el.classList.toggle('err', !ok);
                err.style.display = ok ? 'none' : 'block';
                if (!ok) valid = false;
                el.addEventListener('input', () => {
                    el.classList.remove('err');
                    err.style.display = 'none';
                }, {
                    once: true
                });
            });
            if (!valid) return;
            booking.firstName = document.getElementById('b_first_name').value.trim();
            booking.lastName = document.getElementById('b_last_name').value.trim();
            booking.travelers = parseInt(document.getElementById('b_travelers').value) || 1;
            booking.children = parseInt(document.getElementById('b_children').value) || 0;
            booking.total = booking.priceEach * booking.travelers;
            booking.startDate = document.getElementById('b_start_date').value;
            if (!document.getElementById('b_end_date').value && booking.startDate) {
                const end = new Date(booking.startDate);
                end.setDate(end.getDate() + booking.days);
                document.getElementById('b_end_date').value = end.toISOString().split('T')[0];
            }
            goToStep(3);
        }

        function fillSummary() {
            document.getElementById('sum_pkg_name').textContent = booking.pkgName;
            document.getElementById('sum_duration').textContent = `${booking.days} Days / ${booking.nights} Nights`;
            document.getElementById('sum_travelers').textContent = booking.travelers;
            document.getElementById('sum_children').textContent = booking.children;
            document.getElementById('sum_price_pp').textContent = `$${booking.priceEach.toLocaleString()}`;
            document.getElementById('sum_start_date').textContent = booking.startDate || '—';
            document.getElementById('sum_total').textContent = `$${booking.total.toLocaleString()}`;
        }

        function fillStripe() {
            document.getElementById('stripe_pkg_name').textContent = booking.pkgName;
            document.getElementById('stripe_traveler_name').textContent = `${booking.firstName} ${booking.lastName}`;
            document.getElementById('stripe_duration').textContent = `${booking.days} Days / ${booking.nights} Nights`;
            document.getElementById('stripe_travelers').textContent =
                `${booking.travelers} Adult(s) / ${booking.children} Child(ren)`;
            document.getElementById('stripe_start_date').textContent = booking.startDate || '—';
            document.getElementById('stripe_total').textContent = `$${booking.total.toLocaleString()}`;
            document.getElementById('pay_amount').textContent = `$${booking.total.toLocaleString()}`;
            document.getElementById('card_name').value = `${booking.firstName} ${booking.lastName}`;
        }

        function selectMethod(radio) {
            document.querySelectorAll('.method-option').forEach(el => el.classList.remove('selected'));
            radio.closest('.method-option').classList.add('selected');
        }

        function formatCardNumber(input) {
            let v = input.value.replace(/\D/g, '').substring(0, 16);
            input.value = v.replace(/(.{4})/g, '$1 ').trim();
        }

        function formatExpiry(input) {
            let v = input.value.replace(/\D/g, '').substring(0, 4);
            if (v.length > 2) v = v.substring(0, 2) + ' / ' + v.substring(2);
            input.value = v;
        }

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

            const method = document.querySelector('input[name="pay_method"]:checked')?.value ?? 'stripe';

            const payload = {
                booking_type: booking.type,
                package_id: booking.packageId,
                trek_id: booking.trekId,
                first_name: booking.firstName,
                last_name: booking.lastName,
                email: document.getElementById('b_email').value.trim(),
                phone: document.getElementById('b_phone_code').value + document.getElementById('b_phone').value
                    .trim(),
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
                payment_method: method,
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
                    const msg = data.errors ?
                        Object.values(data.errors).flat().join('\n') :
                        (data.message ?? 'Something went wrong.');
                    alert(msg);
                    btn.disabled = false;
                    btn.innerHTML = `Pay $${booking.total.toLocaleString()}`;
                    return;
                }

                // ── Confirmation details ──
                document.getElementById('conf_booking_id').textContent = data.booking_ref;
                document.getElementById('conf_traveler').textContent = `${booking.firstName} ${booking.lastName}`;
                document.getElementById('conf_package').textContent = booking.pkgName;
                document.getElementById('conf_duration').textContent =
                `${booking.days} Days / ${booking.nights} Nights`;
                document.getElementById('conf_start_date').textContent = booking.startDate;
                document.getElementById('conf_travelers').textContent =
                    `${booking.travelers} Adult(s) / ${booking.children} Child(ren)`;
                document.getElementById('conf_total').textContent = `$${data.total.toLocaleString()}`;

                // ── Set invoice download link dynamically ──
                document.getElementById('invoiceDownloadBtn').href = `/bookings/${data.booking_ref}/invoice`;

                goToStep(5);

            } catch {
                alert('Network error. Please try again.');
                btn.disabled = false;
                btn.innerHTML = `Pay $${booking.total.toLocaleString()}`;
            }
        }

        // after receiving `data` from the store response
        document.getElementById('conf_booking_id').textContent = data.booking_ref;

        // set the invoice download link dynamically
        document.getElementById('invoiceDownloadBtn').href = `/bookings/${data.booking_ref}/invoice`;
    </script>
@endpush
