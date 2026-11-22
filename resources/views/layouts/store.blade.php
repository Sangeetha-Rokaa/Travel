<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png"
        href="{{ setting('site_favicon') ? asset(setting('site_favicon')) : asset('favicon.png') }}">
    <title>@yield('title', setting('site_name', 'TrailCo') . ' — For Every Trail. For Every Explorer.')</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&family=Inter:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <style>
        :root {
            --green: #8bc53f;
            --green-dark: #6ea52e;
            --green-soft: #eaf6de;
            --ink: #1a1d16;
            --muted: #6b7166;
            --line: #ececec;
            --bg: #ffffff;
            --panel: #f6f6f4;
            --nav-h: 76px;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--ink);
            background: var(--bg);
            -webkit-font-smoothing: antialiased;
            padding-top: var(--nav-h);
        }

        h1,
        h2,
        h3,
        .brand {
            font-family: 'Poppins', sans-serif;
        }

        img {
            display: block;
            max-width: 100%;
        }

        a {
            text-decoration: none;
            color: inherit;
        }

        button {
            font-family: inherit;
        }

        :focus-visible {
            outline: 3px solid var(--green);
            outline-offset: 2px;
        }

        .eyebrow {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .14em;
            text-transform: uppercase;
            color: var(--green-dark);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: var(--green);
            color: #16210a;
            font-weight: 600;
            font-size: .92rem;
            letter-spacing: .03em;
            padding: 15px 28px;
            border-radius: 40px;
            border: none;
            cursor: pointer;
            transition: background .2s ease, transform .2s ease;
        }

        .btn-primary:hover {
            background: #9fd453;
            transform: translateY(-1px);
        }

        .btn-outline {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            color: var(--ink);
            font-weight: 600;
            font-size: .78rem;
            letter-spacing: .03em;
            padding: 11px 20px;
            border-radius: 30px;
            border: none;
            cursor: pointer;
            transition: background .2s, color .2s, transform .2s;
        }

        .btn-outline:hover {
            background: var(--green);
            transform: translateY(-1px);
        }

        /* ═══════════ CHECKOUT FLOW — STEP TRACKER ═══════════ */
        .flow-page {
            max-width: 1200px;
            margin: 0 auto;
            padding: 40px 60px 90px;
        }

        .step-tracker {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            margin-bottom: 34px;
            flex-wrap: wrap;
        }

        .step-tracker .step {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .step-tracker .step-circle {
            width: 26px;
            height: 26px;
            border-radius: 50%;
            border: 1.5px solid var(--line);
            background: #fff;
            color: var(--muted);
            font-size: 0.76rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            transition: all .25s ease;
        }

        .step-tracker .step-label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--muted);
        }

        .step-tracker .step.done .step-circle {
            background: var(--green);
            border-color: var(--green);
            color: #16210a;
        }

        .step-tracker .step.done .step-label {
            color: var(--ink);
        }

        .step-tracker .step.active .step-circle {
            background: var(--green);
            border-color: var(--green);
            color: #16210a;
            box-shadow: 0 0 0 4px rgba(139, 197, 63, 0.22);
        }

        .step-tracker .step.active .step-label {
            color: var(--ink);
            font-weight: 700;
        }

        .step-tracker .step-connector {
            width: 40px;
            height: 2px;
            background: var(--line);
            border-radius: 2px;
        }

        .step-tracker .step-connector.done {
            background: var(--green);
        }

        @media (max-width: 640px) {
            .step-tracker .step-label {
                display: none;
            }

            .step-tracker .step-connector {
                width: 22px;
            }
        }

        /* ═══════════ FLOW PAGE HEADER ═══════════ */
        .flow-header {
            text-align: center;
            margin-bottom: 34px;
        }

        .flow-header h1 {
            font-size: 1.7rem;
            font-weight: 700;
            margin-bottom: 6px;
        }

        .flow-header p {
            color: var(--muted);
            font-size: 0.9rem;
        }

        .secure-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 0.78rem;
            font-weight: 600;
            color: var(--muted);
        }

        .secure-badge i {
            color: var(--green-dark);
        }

        /* ═══════════ CHECKOUT LAYOUT ═══════════ */
        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 28px;
            align-items: start;
        }

        .flow-card {
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 24px;
            margin-bottom: 20px;
        }

        .flow-card h3 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .form-grid-2 {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-field {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 16px;
        }

        .form-field label {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--ink);
        }

        .form-field input,
        .form-field select,
        .form-field textarea {
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 11px 14px;
            font-family: 'Inter', sans-serif;
            font-size: 0.88rem;
            color: var(--ink);
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
        }

        .form-field input:focus,
        .form-field select:focus,
        .form-field textarea:focus {
            outline: none;
            border-color: var(--green);
            box-shadow: 0 0 0 3px rgba(139, 197, 63, 0.18);
        }

        .form-address-row {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr;
            gap: 12px;
        }

        .form-checkbox-row {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 0.82rem;
            color: var(--muted);
            margin-top: 4px;
        }

        /* ═══════════ PAYMENT METHOD CARDS ═══════════ */
        .payment-option {
            display: flex;
            align-items: center;
            gap: 14px;
            border: 1.5px solid var(--line);
            border-radius: 12px;
            padding: 14px 16px;
            margin-bottom: 12px;
            cursor: pointer;
            transition: all .2s ease;
            position: relative;
        }

        .payment-option:last-child {
            margin-bottom: 0;
        }

        .payment-option:hover {
            border-color: #cfe6ac;
        }

        .payment-option.selected {
            border-color: var(--green);
            background: #f6fbef;
        }

        .payment-option input[type="radio"] {
            width: 18px;
            height: 18px;
            accent-color: var(--green-dark);
            flex-shrink: 0;
        }

        .payment-option-icon {
            width: 40px;
            height: 40px;
            border-radius: 8px;
            background: var(--panel);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            color: var(--ink);
            flex-shrink: 0;
        }

        .payment-option-body {
            flex: 1;
        }

        .payment-option-body strong {
            display: block;
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 2px;
        }

        .payment-option-body span {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .payment-badge {
            position: absolute;
            top: 12px;
            right: 14px;
            background: var(--green-soft);
            color: var(--green-dark);
            font-size: 0.66rem;
            font-weight: 700;
            padding: 3px 10px;
            border-radius: 20px;
            text-transform: uppercase;
            letter-spacing: 0.03em;
        }

        /* ═══════════ ORDER SUMMARY SIDEBAR ═══════════ */
        .order-summary-card {
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 22px 24px;
            background: #fff;
            position: sticky;
            top: calc(var(--nav-h) + 20px);
        }

        .order-summary-card h3 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: .88rem;
            color: var(--muted);
            margin-bottom: 12px;
        }

        .summary-row span:last-child {
            color: var(--ink);
            font-weight: 500;
        }

        .summary-row.free span:last-child {
            color: var(--green-dark);
            font-weight: 700;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-top: 16px;
            margin-top: 6px;
            border-top: 1px solid var(--line);
        }

        .summary-total strong {
            font-size: 1.02rem;
            font-weight: 700;
        }

        .summary-total .value {
            font-size: 1.25rem;
            font-weight: 800;
        }

        .flow-submit-btn {
            width: 100%;
            justify-content: center;
            margin-top: 20px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--green);
            color: #16210a;
            padding: 15px 20px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.9rem;
            letter-spacing: 0.02em;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .flow-submit-btn:hover {
            background: #9fd453;
            transform: translateY(-1px);
        }

        .secure-note {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-size: 0.78rem;
            color: var(--muted);
            text-align: center;
            margin-top: 16px;
        }

        /* ═══════════ ORDER SUMMARY PAGE ═══════════ */
        .order-success-banner {
            display: flex;
            align-items: center;
            gap: 14px;
            background: #eaf6de;
            border: 1px solid #d4ecb8;
            border-radius: 12px;
            padding: 16px 18px;
            margin-bottom: 20px;
        }

        .order-success-banner i {
            font-size: 1.6rem;
            color: var(--green-dark);
            flex-shrink: 0;
        }

        .order-success-banner strong {
            display: block;
            font-size: 0.92rem;
            color: var(--green-dark);
            margin-bottom: 2px;
        }

        .order-success-banner span {
            font-size: 0.8rem;
            color: #5b7a4a;
        }

        .order-detail-list {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .order-detail-row {
            display: flex;
            justify-content: space-between;
            font-size: 0.86rem;
        }

        .order-detail-row span:first-child {
            color: var(--muted);
        }

        .order-detail-row span:last-child {
            font-weight: 600;
            color: var(--ink);
        }

        .status-pill {
            font-weight: 700 !important;
            color: var(--green-dark) !important;
        }

        .order-item-row {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 12px 0;
            border-bottom: 1px solid var(--line);
        }

        .order-item-row:last-child {
            border-bottom: none;
        }

        .order-item-row .oi-img {
            width: 54px;
            height: 54px;
            border-radius: 8px;
            background: var(--panel);
            overflow: hidden;
            flex-shrink: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .order-item-row .oi-img img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .order-item-row .oi-body {
            flex: 1;
        }

        .order-item-row .oi-body strong {
            display: block;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 2px;
        }

        .order-item-row .oi-body span {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .order-item-row .oi-price {
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--ink);
            white-space: nowrap;
        }

        .info-box-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin: 20px 0;
        }

        .info-box {
            border: 1px solid var(--line);
            border-radius: 12px;
            padding: 16px 18px;
            display: flex;
            align-items: flex-start;
            gap: 12px;
        }

        .info-box i {
            color: var(--green-dark);
            font-size: 1.05rem;
            margin-top: 2px;
        }

        .info-box strong {
            display: block;
            font-size: 0.82rem;
            color: var(--muted);
            font-weight: 600;
            margin-bottom: 4px;
        }

        .info-box .info-box-value {
            font-size: 0.9rem;
            font-weight: 700;
            color: var(--ink);
        }

        .info-box .info-box-sub {
            font-size: 0.76rem;
            color: var(--muted);
            margin-top: 2px;
        }

        .continue-shopping-btn,
        .track-order-btn {
            width: 100%;
            justify-content: center;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1.5px solid var(--line);
            color: var(--ink);
            padding: 14px 20px;
            border-radius: 10px;
            font-weight: 700;
            font-size: 0.88rem;
            text-decoration: none;
            transition: border-color .2s, color .2s;
        }

        .continue-shopping-btn:hover,
        .track-order-btn:hover {
            border-color: var(--green);
            color: var(--green-dark);
        }

        /* ═══════════ SUCCESS PAGE ═══════════ */
        .success-page {
            max-width: 600px;
        }

        .success-hero {
            text-align: center;
            margin-bottom: 30px;
            position: relative;
        }

        .success-check-wrap {
            width: 96px;
            height: 96px;
            margin: 0 auto 22px;
            border-radius: 50%;
            background: var(--green);
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 14px 40px rgba(139, 197, 63, 0.35);
            animation: successPop .5s cubic-bezier(.34, 1.56, .64, 1);
            position: relative;
        }

        .success-check-wrap i {
            font-size: 2.6rem;
            color: #16210a;
        }

        @keyframes successPop {
            0% {
                transform: scale(0.4);
                opacity: 0;
            }

            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .success-hero h1 {
            font-size: 1.7rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .success-hero p {
            font-size: 0.9rem;
            color: var(--muted);
        }

        .success-info-card,
        .whats-next {
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 22px 24px;
            background: #fff;
            margin-bottom: 22px;
        }

        .whats-next h3 {
            font-size: 0.95rem;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .next-step-row {
            display: flex;
            gap: 14px;
            position: relative;
            padding-bottom: 22px;
        }

        .next-step-row:last-child {
            padding-bottom: 0;
        }

        .next-step-row::before {
            content: '';
            position: absolute;
            left: 11px;
            top: 26px;
            bottom: 0;
            width: 2px;
            background: var(--line);
        }

        .next-step-row:last-child::before {
            display: none;
        }

        .next-step-row.done::before {
            background: var(--green);
        }

        .next-step-icon {
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--line);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.68rem;
            flex-shrink: 0;
            z-index: 1;
        }

        .next-step-row.done .next-step-icon {
            background: var(--green);
            color: #16210a;
        }

        .next-step-body strong {
            display: block;
            font-size: 0.88rem;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 2px;
        }

        .next-step-body span {
            font-size: 0.78rem;
            color: var(--muted);
        }

        .success-promo-card {
            position: relative;
            border-radius: 14px;
            overflow: hidden;
            padding: 26px 24px;
            margin-bottom: 20px;
            min-height: 150px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            color: #fff;
            background: linear-gradient(180deg, rgba(20, 26, 13, 0.35), rgba(20, 26, 13, 0.85)),
                url('https://images.unsplash.com/photo-1519681393784-d120267933ba?w=900&q=80') center/cover;
        }

        .success-promo-card h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: 14px;
            line-height: 1.3;
        }

        .success-promo-card .btn-primary {
            width: fit-content;
            padding: 11px 20px;
            font-size: 0.82rem;
        }

        @media (max-width: 900px) {
            .checkout-layout {
                grid-template-columns: 1fr;
            }

            .order-summary-card {
                position: static;
            }

            .form-grid-2,
            .form-address-row,
            .info-box-row {
                grid-template-columns: 1fr;
            }

            .flow-page {
                padding: 30px 20px 60px;
            }
        }

        /* ═══════════ STORE NAVBAR ═══════════ */
        .store-nav {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--nav-h);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 clamp(16px, 5vw, 60px);
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(12px);
            -webkit-backdrop-filter: blur(12px);
            border-bottom: 1px solid var(--line);
            z-index: 1000;
            transition: box-shadow .25s ease;
        }

        .store-nav.scrolled {
            box-shadow: 0 4px 24px rgba(0, 0, 0, .07);
        }

        .store-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            flex-shrink: 0;
        }

        .store-logo-box {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #16210a;
            font-size: 18px;
            overflow: hidden;
        }

        .store-logo-box img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .store-logo-texts {
            line-height: 1.15;
        }

        .store-logo-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            font-size: 1.15rem;
        }

        .store-logo-tag {
            font-size: .62rem;
            letter-spacing: .1em;
            text-transform: uppercase;
            color: var(--muted);
        }

        .store-nav-links {
            display: flex;
            align-items: center;
            gap: 4px;
            list-style: none;
        }

        .store-nav-links>li {
            position: relative;
        }

        .store-nav-links a {
            font-size: .88rem;
            font-weight: 500;
            padding: 9px 14px;
            border-radius: 8px;
            color: var(--ink);
            display: flex;
            align-items: center;
            gap: 6px;
            transition: background .2s, color .2s;
        }

        .store-nav-links a:hover {
            background: var(--panel);
            color: var(--green-dark);
        }

        .store-nav-links a.active {
            color: var(--green-dark);
            font-weight: 600;
        }

        .store-nav-links .chevron {
            font-size: .55rem;
            transition: transform .25s;
        }

        /* ── Category dropdown (fixed: anchored to its own <li>, hover bridge, delayed close) ── */
        .store-dropdown {
            position: relative;
        }

        .store-dropdown-menu {
            position: absolute;
            top: 100%;
            left: 50%;
            min-width: 240px;
            margin-top: 10px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 8px;
            list-style: none;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .12);
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
            transform: translateX(-50%) translateY(-8px);
            /* delay closing so the cursor can travel from trigger to menu */
            transition: opacity .2s ease .15s, transform .2s ease .15s, visibility 0s linear .35s;
            z-index: 1001;
        }

        /* invisible bridge that fills the gap between trigger and menu */
        .store-dropdown-menu::before {
            content: '';
            position: absolute;
            left: 0;
            right: 0;
            top: -14px;
            height: 14px;
        }

        .store-dropdown:hover .store-dropdown-menu,
        .store-dropdown:focus-within .store-dropdown-menu,
        .store-dropdown.open .store-dropdown-menu {
            opacity: 1;
            visibility: visible;
            pointer-events: auto;
            transform: translateX(-50%) translateY(0);
            transition-delay: 0s;
        }

        .store-dropdown:hover .chevron,
        .store-dropdown.open .chevron {
            transform: rotate(180deg);
        }

        .store-dropdown-menu li a {
            border-radius: 9px;
            padding: 10px 14px;
            font-size: .86rem;
            justify-content: space-between;
        }

        .store-dropdown-menu li a .cat-n {
            font-size: .7rem;
            color: var(--muted);
            background: var(--panel);
            padding: 2px 8px;
            border-radius: 20px;
        }

        .store-dropdown-menu li a:hover {
            background: var(--green-soft);
            color: var(--green-dark);
        }

        .store-nav-right {
            display: flex;
            align-items: center;
            gap: 10px;
            flex-shrink: 0;
        }

        .icon-btn {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: 1px solid var(--line);
            background: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            position: relative;
            color: var(--ink);
            font-size: .9rem;
            transition: background .2s, border-color .2s, transform .2s;
        }

        .icon-btn:hover {
            background: var(--panel);
            transform: translateY(-1px);
        }

        .icon-btn.on {
            background: var(--green);
            border-color: var(--green);
            color: #16210a;
        }

        .cart-count {
            position: absolute;
            top: -5px;
            right: -5px;
            background: var(--green);
            color: #16210a;
            font-size: .62rem;
            font-weight: 700;
            min-width: 17px;
            height: 17px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 3px;
            border: 2px solid #fff;
        }

        .store-nav-toggle {
            display: none;
            flex-direction: column;
            gap: 5px;
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 10px;
            cursor: pointer;
            padding: 10px 12px;
            z-index: 1100;
        }

        .store-nav-toggle span {
            width: 20px;
            height: 2px;
            background: var(--ink);
            border-radius: 2px;
            transition: .3s;
        }

        .store-nav-toggle.open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }

        .store-nav-toggle.open span:nth-child(2) {
            opacity: 0;
        }

        .store-nav-toggle.open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }

        @media (max-width:900px) {
            .store-nav-toggle {
                display: flex;
            }

            .store-nav-links {
                position: fixed;
                inset: 0;
                top: var(--nav-h);
                background: #fff;
                flex-direction: column;
                align-items: stretch;
                justify-content: flex-start;
                padding: 20px;
                gap: 4px;
                transform: translateX(100%);
                transition: transform .35s;
                overflow-y: auto;
            }

            .store-nav-links.open {
                transform: translateX(0);
            }

            .store-nav-links a {
                padding: 14px 16px;
                font-size: 1rem;
                justify-content: space-between;
            }

            .store-dropdown-menu {
                position: static;
                transform: none !important;
                opacity: 1;
                visibility: visible;
                pointer-events: auto;
                display: none;
                box-shadow: none;
                border: none;
                background: var(--panel);
                margin-top: 4px;
                min-width: 0;
            }

            .store-dropdown-menu::before {
                display: none;
            }

            /* hover must not open it on touch screens, only tap */
            .store-dropdown:hover .store-dropdown-menu,
            .store-dropdown:focus-within .store-dropdown-menu {
                display: none;
            }

            .store-dropdown.open .store-dropdown-menu {
                display: block;
            }
        }

        /* ═══════════ NAVBAR SEARCH PANEL ═══════════ */
        .store-search-backdrop {
            position: fixed;
            inset: 0;
            background: rgba(10, 16, 8, .45);
            backdrop-filter: blur(2px);
            opacity: 0;
            visibility: hidden;
            transition: opacity .25s ease, visibility 0s linear .25s;
            z-index: 980;
        }

        .store-search-panel {
            position: fixed;
            top: var(--nav-h);
            left: 0;
            right: 0;
            background: #fff;
            border-bottom: 1px solid var(--line);
            box-shadow: 0 24px 50px rgba(0, 0, 0, .12);
            padding: 26px clamp(16px, 5vw, 60px) 30px;
            transform: translateY(-14px);
            opacity: 0;
            visibility: hidden;
            transition: transform .28s ease, opacity .28s ease, visibility 0s linear .28s;
            z-index: 990;
        }

        body.search-open .store-search-backdrop {
            opacity: 1;
            visibility: visible;
            transition-delay: 0s;
        }

        body.search-open .store-search-panel {
            transform: translateY(0);
            opacity: 1;
            visibility: visible;
            transition-delay: 0s;
        }

        .ssp-inner {
            max-width: 760px;
            margin: 0 auto;
        }

        .ssp-form {
            display: flex;
            align-items: center;
            gap: 10px;
            border: 2px solid var(--line);
            border-radius: 50px;
            padding: 6px 6px 6px 22px;
            background: #fff;
            transition: border-color .2s, box-shadow .2s;
        }

        .ssp-form:focus-within {
            border-color: var(--green);
            box-shadow: 0 0 0 5px rgba(139, 197, 63, .18);
        }

        .ssp-form>i {
            color: var(--muted);
        }

        .ssp-form input {
            flex: 1;
            min-width: 0;
            border: none;
            outline: none;
            background: transparent;
            font-family: 'Inter', sans-serif;
            font-size: 1rem;
            color: var(--ink);
            padding: 12px 4px;
            -webkit-appearance: none;
            appearance: none;
        }

        .ssp-form input::-webkit-search-cancel-button {
            display: none;
        }

        .ssp-form button[type="submit"] {
            border: none;
            cursor: pointer;
            background: var(--green);
            color: #16210a;
            font-weight: 700;
            font-size: .88rem;
            padding: 13px 26px;
            border-radius: 40px;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: background .2s, transform .2s;
        }

        .ssp-form button[type="submit"]:hover {
            background: var(--green-dark);
            color: #fff;
            transform: translateY(-1px);
        }

        .ssp-close {
            border: none;
            background: var(--panel);
            color: var(--muted);
            cursor: pointer;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            flex-shrink: 0;
            transition: background .2s, color .2s;
        }

        .ssp-close:hover {
            background: #c1362b;
            color: #fff;
        }

        .ssp-label {
            font-size: .72rem;
            font-weight: 700;
            letter-spacing: .12em;
            text-transform: uppercase;
            color: var(--muted);
            margin: 22px 0 10px;
        }

        .ssp-chips {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .ssp-chips a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            border: 1px solid var(--line);
            border-radius: 30px;
            font-size: .82rem;
            font-weight: 500;
            background: #fff;
            transition: background .2s, border-color .2s, transform .2s;
        }

        .ssp-chips a:hover {
            background: var(--green-soft);
            border-color: var(--green);
            transform: translateY(-2px);
        }

        .ssp-hint {
            margin-top: 18px;
            font-size: .76rem;
            color: var(--muted);
        }

        .ssp-hint kbd {
            background: var(--panel);
            border: 1px solid var(--line);
            border-radius: 5px;
            padding: 1px 6px;
            font-family: inherit;
            font-size: .72rem;
        }

        @media (max-width: 560px) {
            .ssp-form button[type="submit"] span {
                display: none;
            }

            .ssp-form button[type="submit"] {
                padding: 13px 16px;
            }
        }

        /* ═══════════ SHARED SECTION TOKENS ═══════════ */
        .section {
            padding: 70px 60px;
            max-width: 1400px;
            margin: 0 auto;
        }

        .section-head {
            text-align: center;
            margin-bottom: 44px;
        }

        .section-head h2 {
            font-size: 2.1rem;
            font-weight: 700;
            margin-top: 8px;
            letter-spacing: -.01em;
        }

        .divider-icon {
            margin: 14px auto 0;
            width: 46px;
            opacity: .8;
        }

        @media (max-width:640px) {
            .section {
                padding: 50px 20px;
            }
        }

        /* ═══════════ STORE FOOTER ═══════════ */
        .store-footer {
            background: var(--ink);
            color: rgba(255, 255, 255, .75);
            padding: 70px clamp(16px, 5vw, 80px) 0;
            margin-top: 40px;
        }

        .store-footer-grid {
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 1.3fr;
            gap: 40px;
        }

        .sf-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 18px;
        }

        .sf-logo-box {
            width: 42px;
            height: 42px;
            border-radius: 10px;
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #16210a;
        }

        .sf-name {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            color: #fff;
            font-size: 1.1rem;
        }

        .sf-tag {
            font-size: .62rem;
            color: rgba(255, 255, 255, .4);
            letter-spacing: .1em;
            text-transform: uppercase;
        }

        .store-footer p {
            font-size: .86rem;
            line-height: 1.7;
            color: rgba(255, 255, 255, .55);
            max-width: 300px;
        }

        .sf-socials {
            display: flex;
            gap: 10px;
            margin-top: 18px;
        }

        .sf-socials a {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, .07);
            border: 1px solid rgba(255, 255, 255, .1);
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, .6);
            font-size: .82rem;
            transition: .25s;
        }

        .sf-socials a:hover {
            background: var(--green);
            color: #16210a;
            border-color: var(--green);
            transform: translateY(-3px);
        }

        .sf-col h4 {
            font-family: 'Poppins', sans-serif;
            font-size: 1rem;
            font-weight: 600;
            color: #fff;
            margin-bottom: 16px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, .08);
        }

        .sf-col ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .sf-col ul li a {
            color: rgba(255, 255, 255, .55);
            font-size: .85rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: .25s;
        }

        .sf-col ul li a::before {
            content: '›';
            color: var(--green);
            opacity: 0;
            transition: .25s;
        }

        .sf-col ul li a:hover {
            color: var(--green);
            padding-left: 6px;
        }

        .sf-col ul li a:hover::before {
            opacity: 1;
        }

        .store-footer-bottom {
            margin-top: 50px;
            padding: 20px 0;
            border-top: 1px solid rgba(255, 255, 255, .07);
            text-align: center;
            font-size: .8rem;
            color: rgba(255, 255, 255, .35);
        }

        @media (max-width:900px) {
            .store-footer-grid {
                grid-template-columns: 1fr 1fr;
            }

            .sf-brand {
                grid-column: 1/-1;
            }
        }

        @media (max-width:480px) {
            .store-footer-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ═══════════ BACK-TO-TOP ═══════════ */
        .to-top {
            position: fixed;
            right: 22px;
            bottom: 22px;
            width: 46px;
            height: 46px;
            border-radius: 50%;
            border: none;
            background: var(--green);
            color: #16210a;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 26px rgba(110, 165, 46, .45);
            opacity: 0;
            visibility: hidden;
            transform: translateY(10px);
            transition: opacity .25s, transform .25s, visibility .25s, background .2s;
            z-index: 900;
        }

        .to-top.show {
            opacity: 1;
            visibility: visible;
            transform: translateY(0);
        }

        .to-top:hover {
            background: var(--green-dark);
            color: #fff;
        }

        /* ═══════════ STORE PAGE TRANSITION OVERLAY ═══════════ */
        #storeLoader {
            position: fixed;
            inset: 0;
            z-index: 99999;
            background: radial-gradient(circle at 50% 40%, #223016 0%, #141a0d 70%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity .4s ease;
        }

        #storeLoader.active {
            opacity: 1;
            pointer-events: all;
        }

        .sl-inner {
            text-align: center;
            transform: translateY(14px);
            opacity: 0;
            transition: transform .5s cubic-bezier(.34, 1.56, .64, 1), opacity .5s ease;
        }

        #storeLoader.active .sl-inner {
            transform: translateY(0);
            opacity: 1;
        }

        .sl-icon-wrap {
            width: 80px;
            height: 80px;
            margin: 0 auto 24px;
            border-radius: 20px;
            background: linear-gradient(135deg, var(--green), var(--green-dark));
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 40px rgba(139, 197, 63, .3);
            animation: slPulse 1.6s ease-in-out infinite;
        }

        .sl-icon-wrap i {
            font-size: 32px;
            color: #16210a;
            animation: slSpin 1.8s linear infinite;
        }

        @keyframes slPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.06);
            }
        }

        @keyframes slSpin {
            to {
                transform: rotate(360deg);
            }
        }

        .sl-title {
            font-family: 'Poppins', sans-serif;
            font-size: 1.5rem;
            font-weight: 700;
            color: #fff;
            margin-bottom: 8px;
        }

        .sl-sub {
            font-size: .82rem;
            color: rgba(255, 255, 255, .5);
            letter-spacing: .06em;
            text-transform: uppercase;
            margin-bottom: 26px;
        }

        .sl-bar-track {
            width: 220px;
            height: 3px;
            background: rgba(255, 255, 255, .12);
            border-radius: 10px;
            overflow: hidden;
            margin: 0 auto;
        }

        .sl-bar-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--green-dark), var(--green));
            border-radius: 10px;
            transition: width 1s cubic-bezier(.4, 0, .2, 1);
        }

        @media (prefers-reduced-motion: reduce) {

            *,
            *::before,
            *::after {
                animation: none !important;
                transition: none !important;
                scroll-behavior: auto !important;
            }
        }
    </style>

    {{-- Page-level styles. Pages push full <style>…</style> tags, so this MUST sit outside the main <style> block. --}}
    @stack('styles')
</head>

<body>

    @php
        $logo = setting('site_logo');
        $logoUrl = $logo ? (Str::startsWith($logo, 'http') ? $logo : asset('storage/' . $logo)) : null;
        $currentCategory = request('category');
        $onStore = request()->routeIs('store.*');
    @endphp

    <!-- ═══════════ STORE NAVBAR ═══════════ -->
    <nav class="store-nav" id="storeNav">
        <a href="{{ url('/') }}" class="store-logo">
            <div class="store-logo-box">
                @if ($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ setting('site_name', 'TrailCo') }}">
                @else
                    <i class="fas fa-mountain"></i>
                @endif
            </div>
            <div class="store-logo-texts">
                <div class="store-logo-name">{{ setting('site_name', 'TrailCo') }}</div>
                <div class="store-logo-tag">Store</div>
            </div>
        </a>

        <button class="store-nav-toggle" id="storeNavToggle" aria-label="Toggle menu" aria-expanded="false">
            <span></span><span></span><span></span>
        </button>

        <ul class="store-nav-links" id="storeNavLinks">
            <li><a href="{{ route('store.index') }}"
                    class="js-store-nav {{ $onStore && !$currentCategory ? 'active' : '' }}">All Products</a></li>

            @if (isset($categories) && $categories->count())
                <li class="store-dropdown" id="storeDropdown">
                    <a href="#" id="storeCatTrigger" aria-haspopup="true" aria-expanded="false"
                        class="{{ $currentCategory ? 'active' : '' }}">Categories <i
                            class="fa fa-chevron-down chevron"></i></a>
                    <ul class="store-dropdown-menu" id="storeCatDropdown">
                        @foreach ($categories as $cat)
                            <li><a href="{{ route('store.index', ['category' => $cat->slug]) }}#shop"
                                    class="js-store-nav {{ $currentCategory === $cat->slug ? 'active' : '' }}">
                                    <span>{{ $cat->name }}</span>
                                    @if (isset($cat->products_count))
                                        <span class="cat-n">{{ $cat->products_count }}</span>
                                    @endif
                                </a></li>
                        @endforeach
                    </ul>
                </li>
            @endif

            <li><a href="{{ route('home') }}" id="storeHomeLink"><i class="fas fa-home"></i> Home</a></li>
        </ul>

        <div class="store-nav-right">
            <button class="icon-btn" id="storeSearchToggle" type="button" title="Search (press /)"
                aria-label="Open search" aria-expanded="false" aria-controls="storeSearchPanel">
                <i class="fas fa-search"></i>
            </button>
            <a href="{{ route('cart.index') ?? '#' }}" class="icon-btn" title="Cart" aria-label="Cart">
                <i class="fas fa-shopping-bag"></i>
                @php $cartCount = collect(session('cart', []))->sum('qty'); @endphp
                @if ($cartCount > 0)
                    <span class="cart-count">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </nav>

    <!-- ═══════════ SEARCH PANEL ═══════════ -->
    <div class="store-search-backdrop" id="storeSearchBackdrop"></div>
    <div class="store-search-panel" id="storeSearchPanel" role="dialog" aria-label="Search products">
        <div class="ssp-inner">
            <form action="{{ route('store.index') }}#shop" method="GET" class="ssp-form" role="search"
                id="storeSearchForm">
                <i class="fas fa-search"></i>
                <input type="search" name="search" id="storeSearchInput" value="{{ request('search') }}"
                    placeholder="Search backpacks, boots, jackets…" autocomplete="off" aria-label="Search products">
                <button type="submit"><span>Search</span> <i class="fas fa-arrow-right"></i></button>
                <button type="button" class="ssp-close" id="storeSearchClose" aria-label="Close search"><i
                        class="fas fa-times"></i></button>
            </form>

            @if (isset($categories) && $categories->count())
                <div class="ssp-label">Browse categories</div>
                <div class="ssp-chips">
                    @foreach ($categories as $cat)
                        <a href="{{ route('store.index', ['category' => $cat->slug]) }}#shop"><i
                                class="fas fa-mountain" style="color:var(--green-dark);font-size:.7rem"></i>
                            {{ $cat->name }}</a>
                    @endforeach
                </div>
            @endif

            <div class="ssp-label">Popular searches</div>
            <div class="ssp-chips">
                @foreach (['Backpack', 'Jacket', 'Boots', 'Tent', 'Sleeping bag', 'Rain'] as $term)
                    <a href="{{ route('store.index', ['search' => $term]) }}#shop">{{ $term }}</a>
                @endforeach
            </div>

            <div class="ssp-hint">Tip: press <kbd>/</kbd> to search from anywhere, <kbd>Esc</kbd> to close.</div>
        </div>
    </div>

    <!-- ═══════════ PAGE CONTENT ═══════════ -->
    @yield('content')

    <!-- ═══════════ STORE FOOTER ═══════════ -->
    <footer class="store-footer">
        <div class="store-footer-grid">
            <div class="sf-brand">
                <div class="sf-logo">
                    <div class="sf-logo-box">
                        @if ($logoUrl)
                            <img src="{{ $logoUrl }}" alt=""
                                style="width:100%;height:100%;object-fit:cover;border-radius:10px;">
                        @else
                            <i class="fas fa-mountain"></i>
                        @endif
                    </div>
                    <div>
                        <div class="sf-name">{{ setting('site_name', 'TrailCo') }}</div>
                        <div class="sf-tag">Gear Up. Step Out. Explore.</div>
                    </div>
                </div>
                <p>{{ setting('store_footer_text', 'Premium trekking & hiking gear, clothing, and footwear for your next adventure — built for every trail, tested for every terrain.') }}
                </p>
                <div class="sf-socials">
                    @if (setting('facebook_url'))
                        <a href="{{ setting('facebook_url') }}" target="_blank" rel="noopener"
                            aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (setting('instagram_url'))
                        <a href="{{ setting('instagram_url') }}" target="_blank" rel="noopener"
                            aria-label="Instagram"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if (setting('twitter_url'))
                        <a href="{{ setting('twitter_url') }}" target="_blank" rel="noopener"
                            aria-label="Twitter"><i class="fab fa-twitter"></i></a>
                    @endif
                </div>
            </div>

            <div class="sf-col">
                <h4>Shop</h4>
                <ul>
                    <li><a href="{{ route('store.index') }}">All Products</a></li>
                    @foreach (($categories ?? collect())->take(5) as $cat)
                        <li><a
                                href="{{ route('store.index', ['category' => $cat->slug]) }}#shop">{{ $cat->name }}</a>
                        </li>
                    @endforeach
                </ul>
            </div>

            <div class="sf-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="{{ route('home') }}">Home</a></li>
                    <li><a href="{{ route('about.index') }}">About Us</a></li>
                    <li><a href="{{ url('/contact') }}">Contact</a></li>
                </ul>
            </div>

            <div class="sf-col">
                <h4>Contact</h4>
                <ul>
                    <li><a href="#"><i class="fas fa-map-marker-alt"></i> Thamel, Kathmandu, Nepal</a></li>
                    <li><a href="#"><i class="fas fa-phone-alt"></i> +977 9800000000</a></li>
                    <li><a href="#"><i class="fas fa-envelope"></i>
                            store@{{ Str::slug(setting('site_name', 'trailco')) }}.com</a></li>
                </ul>
            </div>
        </div>

        <div class="store-footer-bottom">
            © {{ date('Y') }} {{ setting('site_name', 'TrailCo') }}. All Rights Reserved.
        </div>
    </footer>

    <button class="to-top" id="toTop" type="button" aria-label="Back to top"><i
            class="fas fa-arrow-up"></i></button>

    <!-- ═══════════ TRANSITION OVERLAY (Home link) ═══════════ -->
    <div id="storeLoader">
        <div class="sl-inner">
            <div class="sl-icon-wrap"><i class="fas fa-compass" id="slIcon"></i></div>
            <div class="sl-title" id="slTitle">Loading gear…</div>
            <div class="sl-sub" id="slSub">Please wait a moment</div>
            <div class="sl-bar-track">
                <div class="sl-bar-fill" id="slBarFill"></div>
            </div>
        </div>
    </div>

    <script>
        (function() {
            const $ = (id) => document.getElementById(id);
            const nav = $('storeNav');
            const toTop = $('toTop');
            const toggle = $('storeNavToggle');
            const links = $('storeNavLinks');

            /* ── scroll effects ── */
            window.addEventListener('scroll', () => {
                nav.classList.toggle('scrolled', window.scrollY > 20);
                toTop.classList.toggle('show', window.scrollY > 600);
            }, {
                passive: true
            });
            toTop.addEventListener('click', () => window.scrollTo({
                top: 0,
                behavior: 'smooth'
            }));

            /* ── mobile menu ── */
            function closeMobileMenu() {
                toggle.classList.remove('open');
                toggle.setAttribute('aria-expanded', 'false');
                links.classList.remove('open');
                document.body.style.overflow = '';
            }

            toggle.addEventListener('click', () => {
                const open = toggle.classList.toggle('open');
                toggle.setAttribute('aria-expanded', open);
                links.classList.toggle('open', open);
                document.body.style.overflow = open ? 'hidden' : '';
                if (open) closeSearch();
            });

            /* ── categories dropdown: hover (CSS) + click/tap + keyboard + outside click ── */
            const dropdown = $('storeDropdown');
            const catTrigger = $('storeCatTrigger');
            if (dropdown && catTrigger) {
                catTrigger.addEventListener('click', (e) => {
                    e.preventDefault();
                    const open = dropdown.classList.toggle('open');
                    catTrigger.setAttribute('aria-expanded', open);
                });

                document.addEventListener('click', (e) => {
                    if (!dropdown.contains(e.target)) {
                        dropdown.classList.remove('open');
                        catTrigger.setAttribute('aria-expanded', 'false');
                    }
                });

                dropdown.addEventListener('keydown', (e) => {
                    if (e.key === 'Escape') {
                        dropdown.classList.remove('open');
                        catTrigger.setAttribute('aria-expanded', 'false');
                        catTrigger.blur();
                    }
                });
            }

            /* ── close mobile menu when a real link is clicked ── */
            links.querySelectorAll('a:not(#storeHomeLink):not(#storeCatTrigger)').forEach(a => {
                a.addEventListener('click', closeMobileMenu);
            });

            /* ── search panel ── */
            const searchToggle = $('storeSearchToggle');
            const searchInput = $('storeSearchInput');
            const searchForm = $('storeSearchForm');

            function openSearch() {
                closeMobileMenu();
                if (dropdown) dropdown.classList.remove('open');
                document.body.classList.add('search-open');
                searchToggle.classList.add('on');
                searchToggle.setAttribute('aria-expanded', 'true');
                setTimeout(() => {
                    searchInput.focus();
                    searchInput.select();
                }, 60);
            }

            function closeSearch() {
                document.body.classList.remove('search-open');
                searchToggle.classList.remove('on');
                searchToggle.setAttribute('aria-expanded', 'false');
            }

            searchToggle.addEventListener('click', () => {
                document.body.classList.contains('search-open') ? closeSearch() : openSearch();
            });
            $('storeSearchClose').addEventListener('click', closeSearch);
            $('storeSearchBackdrop').addEventListener('click', closeSearch);

            searchForm.addEventListener('submit', (e) => {
                if (!searchInput.value.trim()) {
                    e.preventDefault();
                    searchInput.focus();
                }
            });

            document.addEventListener('keydown', (e) => {
                if (e.key === 'Escape') closeSearch();
                const typing = /^(INPUT|TEXTAREA|SELECT)$/.test(document.activeElement.tagName) ||
                    document.activeElement.isContentEditable;
                if (e.key === '/' && !typing && !e.metaKey && !e.ctrlKey) {
                    e.preventDefault();
                    openSearch();
                }
            });

            /* ── Home link transition loader ── */
            const loader = $('storeLoader');
            const slTitle = $('slTitle');
            const slSub = $('slSub');
            const slIcon = $('slIcon');
            const slBarFill = $('slBarFill');
            const homeLink = $('storeHomeLink');

            if (homeLink) {
                homeLink.addEventListener('click', (e) => {
                    if (e.metaKey || e.ctrlKey || e.shiftKey) return;
                    e.preventDefault();
                    closeMobileMenu();

                    slTitle.textContent = 'Heading Home';
                    slSub.textContent = 'Taking you back to the main site';
                    slIcon.className = 'fas fa-mountain';
                    slBarFill.style.width = '0%';
                    loader.classList.add('active');

                    requestAnimationFrame(() => requestAnimationFrame(() => {
                        slBarFill.style.width = '100%';
                    }));

                    setTimeout(() => {
                        window.location.href = homeLink.href;
                    }, 950);
                });
            }

            window.addEventListener('pageshow', (e) => {
                if (e.persisted) loader.classList.remove('active');
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>
