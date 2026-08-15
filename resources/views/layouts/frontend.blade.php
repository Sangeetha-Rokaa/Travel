<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- Favicon -->
    <link rel="icon" type="image/png"
        href="{{ setting('site_favicon') ? asset(setting('favicon')) : asset('favicon.png') }}">
    <title>@yield('title', 'ApeakNepal – Dream · Explore · Discover')</title>

    {{-- Fonts --}}
    <link
        href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,600;0,700;1,400;1,600&family=Outfit:wght@300;400;500;600;700;800&family=Great+Vibes&display=swap"
        rel="stylesheet" />

    {{-- Icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    {{-- AOS --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.css" />

    {{-- Your existing styles --}}
    {{-- @vite(['resources/css/frontend/styles.css']) --}}

    <style>
        /* ═══════════════════════════════════════════
           DESIGN TOKENS
        ═══════════════════════════════════════════ */
        :root {
            --clr-sky: #0b3d6e;
            --clr-mid: #1a6fc4;
            --clr-gold: #e8a020;
            --clr-ember: #c0392b;
            --clr-snow: #f8f6f2;
            --clr-dark: #0a1628;
            --clr-muted: #64748b;
            --ff-display: 'Cormorant Garamond', Georgia, serif;
            --ff-body: 'Outfit', sans-serif;
            --nav-h: 72px;
            --radius-lg: 18px;
            --shadow-card: 0 8px 40px rgba(11, 61, 110, 0.12);
            --transition: 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: var(--ff-body);
            background: var(--clr-snow);
            color: var(--clr-dark);
            margin: 0;
            overflow-x: hidden;
        }

        /* ═══════════════════════════════════════════
   STORE PAGE TRANSITION LOADER
═══════════════════════════════════════════ */
        #storeTransition {
            position: fixed;
            inset: 0;
            z-index: 999999;
            background: radial-gradient(circle at 50% 40%, #0f2847 0%, #0a1628 70%);
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.45s ease;
        }

        #storeTransition.active {
            opacity: 1;
            pointer-events: all;
        }

        .st-inner {
            text-align: center;
            transform: translateY(14px);
            opacity: 0;
            transition: transform 0.5s cubic-bezier(0.34, 1.56, 0.64, 1), opacity 0.5s ease;
        }

        #storeTransition.active .st-inner {
            transform: translateY(0);
            opacity: 1;
        }

        .st-icon-wrap {
            width: 84px;
            height: 84px;
            margin: 0 auto 26px;
            border-radius: 22px;
            background: linear-gradient(135deg, var(--clr-mid), var(--clr-gold));
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 10px 40px rgba(232, 160, 32, 0.35);
            animation: stPulse 1.6s ease-in-out infinite;
        }

        .st-icon-wrap i {
            font-size: 34px;
            color: #fff;
            animation: stSpin 1.8s linear infinite;
        }

        @keyframes stPulse {

            0%,
            100% {
                transform: scale(1);
            }

            50% {
                transform: scale(1.06);
            }
        }

        @keyframes stSpin {
            0% {
                transform: rotate(0deg);
            }

            100% {
                transform: rotate(360deg);
            }
        }

        .st-title {
            font-family: var(--ff-display);
            font-size: 1.6rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.02em;
            margin-bottom: 8px;
        }

        .st-sub {
            font-size: 0.85rem;
            color: rgba(255, 255, 255, 0.5);
            letter-spacing: 0.08em;
            text-transform: uppercase;
            margin-bottom: 28px;
        }

        .st-bar-track {
            width: 240px;
            height: 3px;
            background: rgba(255, 255, 255, 0.12);
            border-radius: 10px;
            overflow: hidden;
            margin: 0 auto;
        }

        .st-bar-fill {
            height: 100%;
            width: 0%;
            background: linear-gradient(90deg, var(--clr-mid), var(--clr-gold));
            border-radius: 10px;
            box-shadow: 0 0 12px rgba(232, 160, 32, 0.6);
            transition: width 1s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .st-dots span {
            display: inline-block;
            width: 5px;
            height: 5px;
            margin: 0 2px;
            border-radius: 50%;
            background: var(--clr-gold);
            opacity: 0.3;
            animation: stDot 1.2s ease-in-out infinite;
        }

        .st-dots span:nth-child(2) {
            animation-delay: 0.15s;
        }

        .st-dots span:nth-child(3) {
            animation-delay: 0.3s;
        }

        @keyframes stDot {

            0%,
            100% {
                opacity: 0.3;
                transform: translateY(0);
            }

            50% {
                opacity: 1;
                transform: translateY(-3px);
            }
        }

        /* ═══════════════════════════════════════════
           NAVBAR
        ═══════════════════════════════════════════ */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: var(--nav-h);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 clamp(16px, 5vw, 60px);
            z-index: 1000;
            transition: background var(--transition), box-shadow var(--transition), backdrop-filter var(--transition);
        }

        .navbar.scrolled {
            background: rgba(10, 22, 40, 0.96);
            backdrop-filter: blur(20px);
            box-shadow: 0 2px 30px rgba(0, 0, 0, 0.35);
        }

        /* Logo */
        .logo {
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            flex-shrink: 0;
        }

        .logo-icon-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--clr-mid), var(--clr-gold));
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            box-shadow: 0 4px 16px rgba(26, 111, 196, 0.4);
            transition: transform var(--transition), box-shadow var(--transition);
        }

        .logo:hover .logo-icon-box {
            transform: rotate(-5deg) scale(1.08);
            box-shadow: 0 8px 24px rgba(232, 160, 32, 0.5);
        }

        .logo-icon-box img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .fallback-icon {
            color: #fff;
            font-size: 20px;
        }

        .logo-texts {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .logo-name {
            font-family: var(--ff-display);
            font-size: 1.3rem;
            font-weight: 700;
            color: #fff;
            letter-spacing: 0.02em;
        }

        .logo-tagline {
            font-size: 0.65rem;
            color: rgba(255, 255, 255, 0.6);
            letter-spacing: 0.12em;
            text-transform: uppercase;
        }

        /* Nav links */
        .nav-links {
            display: flex;
            align-items: center;
            gap: 6px;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .nav-links li {
            position: relative;
        }

        .nav-links a {
            color: rgba(255, 255, 255, 0.88);
            text-decoration: none;
            font-size: 0.88rem;
            font-weight: 500;
            padding: 8px 14px;
            border-radius: 8px;
            display: flex;
            align-items: center;
            gap: 6px;
            transition: color var(--transition), background var(--transition);
            white-space: nowrap;
        }

        .nav-links a:hover {
            color: var(--clr-gold);
            background: rgba(255, 255, 255, 0.08);
        }

        .chevron {
            font-size: 0.6rem;
            transition: transform var(--transition);
        }

        .nav-dropdown:hover .chevron {
            transform: rotate(180deg);
        }

        /* Dropdown */
        .dropdown-menu {
            position: absolute;
            top: calc(100% + 12px);
            left: 50%;
            transform: translateX(-50%) translateY(-8px);
            min-width: 220px;
            background: rgba(10, 22, 40, 0.97);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            border-radius: var(--radius-lg);
            padding: 8px;
            list-style: none;
            margin: 0;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.25s, transform 0.25s;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.5);
        }

        .nav-dropdown:hover .dropdown-menu,
        .dropdown-menu.open {
            opacity: 1;
            pointer-events: auto;
            transform: translateX(-50%) translateY(0);
        }

        .dropdown-menu.hidden {
            opacity: 0;
            pointer-events: none;
        }

        .dropdown-menu li a {
            display: block;
            border-radius: 10px;
            padding: 9px 16px;
            font-size: 0.84rem;
        }

        .dropdown-menu li a:hover {
            background: rgba(232, 160, 32, 0.1);
            color: var(--clr-gold);
        }

        /* CTA button */
        .btn-cta-nav {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--clr-gold), #f0b030);
            color: var(--clr-dark) !important;
            font-weight: 700;
            font-size: 0.84rem;
            padding: 10px 22px;
            border-radius: 50px;
            text-decoration: none;
            transition: transform var(--transition), box-shadow var(--transition), filter var(--transition);
            box-shadow: 0 4px 20px rgba(232, 160, 32, 0.4);
            white-space: nowrap;
            flex-shrink: 0;
        }

        .btn-cta-nav:hover {
            transform: translateY(-2px) scale(1.04);
            box-shadow: 0 8px 30px rgba(232, 160, 32, 0.6);
            filter: brightness(1.08);
        }

        /* ── Hamburger ── */
        .nav-toggle {
            display: none;
            flex-direction: column;
            justify-content: center;
            gap: 5px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 10px;
            cursor: pointer;
            padding: 10px 12px;
            z-index: 1100;
            transition: background var(--transition);
        }

        .nav-toggle:hover {
            background: rgba(255, 255, 255, 0.18);
        }

        .nav-toggle span {
            display: block;
            width: 22px;
            height: 2px;
            background: #fff;
            border-radius: 2px;
            transition: transform 0.35s, opacity 0.35s;
        }

        .nav-toggle.open span:nth-child(1) {
            transform: translateY(7px) rotate(45deg);
        }

        .nav-toggle.open span:nth-child(2) {
            opacity: 0;
            transform: scaleX(0);
        }

        .nav-toggle.open span:nth-child(3) {
            transform: translateY(-7px) rotate(-45deg);
        }

        /* ═══════════════════════════════════════════
           FOOTER
        ═══════════════════════════════════════════ */
        footer {
            background: var(--clr-dark);
            color: rgba(255, 255, 255, 0.75);
            padding: 80px clamp(16px, 5vw, 80px) 0;
        }

        .footer-grid {
            display: grid;
            grid-template-columns: 1.8fr 1fr 1fr 1fr 1.4fr;
            gap: 40px;
        }

        .footer-brand .fb-logo {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 20px;
        }

        .fb-logo-box {
            width: 44px;
            height: 44px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--clr-mid), var(--clr-gold));
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 18px;
            overflow: hidden;
            flex-shrink: 0;
        }

        .fb-name {
            font-family: var(--ff-display);
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
        }

        .fb-tagline {
            font-size: 0.65rem;
            color: rgba(255, 255, 255, 0.4);
            letter-spacing: 0.1em;
            text-transform: uppercase;
        }

        footer p {
            font-size: 0.88rem;
            line-height: 1.75;
            color: rgba(255, 255, 255, 0.55);
            max-width: 300px;
        }

        .footer-socials {
            display: flex;
            gap: 10px;
            margin-top: 20px;
            flex-wrap: wrap;
        }

        .footer-socials a {
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.07);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
            text-decoration: none;
            transition: all var(--transition);
        }

        .footer-socials a:hover {
            background: var(--clr-gold);
            color: var(--clr-dark);
            border-color: var(--clr-gold);
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(232, 160, 32, 0.4);
        }

        .footer-col h4 {
            font-family: var(--ff-display);
            font-size: 1.05rem;
            font-weight: 600;
            color: #fff;
            margin: 0 0 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .footer-col ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .footer-col ul li a {
            color: rgba(255, 255, 255, 0.55);
            text-decoration: none;
            font-size: 0.87rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: color var(--transition), padding-left var(--transition);
        }

        .footer-col ul li a::before {
            content: '›';
            color: var(--clr-gold);
            font-size: 1rem;
            opacity: 0;
            transition: opacity var(--transition);
        }

        .footer-col ul li a:hover {
            color: var(--clr-gold);
            padding-left: 8px;
        }

        .footer-col ul li a:hover::before {
            opacity: 1;
        }

        .footer-contact-item {
            display: flex;
            gap: 12px;
            align-items: flex-start;
            margin-bottom: 14px;
            font-size: 0.86rem;
        }

        .footer-contact-item i {
            color: var(--clr-gold);
            margin-top: 3px;
            width: 14px;
            flex-shrink: 0;
        }

        .footer-bottom {
            margin-top: 60px;
            padding: 22px 0;
            border-top: 1px solid rgba(255, 255, 255, 0.07);
            text-align: center;
            font-size: 0.82rem;
            color: rgba(255, 255, 255, 0.35);
        }

        /* ═══════════════════════════════════════════
           VIDEO MODAL
        ═══════════════════════════════════════════ */
        #videoModal {
            display: none;
            position: fixed;
            inset: 0;
            background: rgba(0, 0, 0, 0.92);
            z-index: 99999;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(8px);
            animation: modalFadeIn 0.3s ease;
        }

        @keyframes modalFadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        #videoModal>div {
            position: relative;
            width: 90%;
            max-width: 840px;
            background: #000;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 40px 120px rgba(0, 0, 0, 0.8);
            animation: modalSlideUp 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes modalSlideUp {
            from {
                transform: translateY(40px) scale(0.95);
                opacity: 0;
            }

            to {
                transform: translateY(0) scale(1);
                opacity: 1;
            }
        }

        #videoModal .close-modal-btn {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(255, 255, 255, 0.15);
            border: none;
            color: #fff;
            width: 38px;
            height: 38px;
            border-radius: 50%;
            cursor: pointer;
            font-size: 16px;
            z-index: 10;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background var(--transition);
            backdrop-filter: blur(4px);
        }

        #videoModal .close-modal-btn:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        /* ═══════════════════════════════════════════
           MOBILE RESPONSIVE
        ═══════════════════════════════════════════ */
        @media (max-width: 1100px) {
            .footer-grid {
                grid-template-columns: 1fr 1fr 1fr;
            }

            .footer-brand {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 768px) {

            /* Nav toggle visible */
            .nav-toggle {
                display: flex;
            }

            #desktopCta {
                display: none;
            }

            /* Fullscreen mobile menu */
            .nav-links {
                position: fixed;
                top: 0;
                left: 0;
                right: 0;
                bottom: 0;
                background: linear-gradient(160deg, rgba(10, 22, 40, 0.99) 0%, rgba(11, 61, 110, 0.99) 100%);
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 4px;
                z-index: 1050;
                opacity: 0;
                pointer-events: none;
                transform: translateY(-16px);
                transition: opacity 0.35s, transform 0.35s;
                padding: 0 24px 80px;
                overflow-y: auto;
                backdrop-filter: blur(20px);
            }

            .nav-links.open {
                opacity: 1;
                pointer-events: auto;
                transform: translateY(0);
            }

            .nav-links li {
                width: 100%;
                text-align: center;
            }

            .nav-links>li>a {
                font-size: 1.15rem;
                font-weight: 600;
                padding: 14px 20px;
                justify-content: center;
                border-radius: 14px;
                border: 1px solid transparent;
                transition: all 0.25s;
            }

            .nav-links>li>a:hover {
                border-color: rgba(232, 160, 32, 0.3);
                background: rgba(232, 160, 32, 0.07);
                color: var(--clr-gold);
            }

            /* Mobile dropdown */
            .dropdown-menu {
                position: static !important;
                transform: none !important;
                opacity: 1 !important;
                pointer-events: auto !important;
                background: rgba(255, 255, 255, 0.05);
                border: 1px solid rgba(255, 255, 255, 0.08);
                border-radius: 12px;
                display: none;
                margin-top: 6px;
            }

            .dropdown-menu.open {
                display: block !important;
            }

            .dropdown-menu.hidden {
                display: none !important;
            }

            /* Mobile CTA inside menu */
            .mobile-cta-li {
                margin-top: 12px;
            }

            .mobile-cta-li .btn-cta-nav {
                display: inline-flex !important;
            }

            /* Footer */
            .footer-grid {
                grid-template-columns: 1fr 1fr;
                gap: 32px;
            }

            .footer-brand {
                grid-column: 1 / -1;
            }

            footer {
                padding: 60px 20px 0;
            }
        }

        @media (max-width: 480px) {
            .footer-grid {
                grid-template-columns: 1fr;
            }

            #videoModal>div {
                width: 96%;
            }
        }

        /* ═══════════════════════════════════════════
           SCROLL PROGRESS BAR
        ═══════════════════════════════════════════ */
        #scrollProgress {
            position: fixed;
            top: 0;
            left: 0;
            height: 3px;
            width: 0%;
            background: linear-gradient(90deg, var(--clr-mid), var(--clr-gold));
            z-index: 9999;
            transition: width 0.1s linear;
            box-shadow: 0 0 10px rgba(232, 160, 32, 0.6);
        }

        /* ═══════════════════════════════════════════
           BACK TO TOP BUTTON
        ═══════════════════════════════════════════ */
        #backToTop {
            position: fixed;
            bottom: 28px;
            right: 28px;
            width: 46px;
            height: 46px;
            background: linear-gradient(135deg, var(--clr-sky), var(--clr-mid));
            border: none;
            border-radius: 50%;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            z-index: 500;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            transform: translateY(20px);
            transition: all 0.4s;
            box-shadow: 0 6px 24px rgba(11, 61, 110, 0.5);
        }

        #backToTop.show {
            opacity: 1;
            transform: translateY(0);
        }

        #backToTop:hover {
            transform: translateY(-4px) scale(1.1);
            box-shadow: 0 12px 30px rgba(11, 61, 110, 0.6);
        }

        /* ═══════════════════════════════════════════
           PARTICLE CANVAS (hero decoration)
        ═══════════════════════════════════════════ */
        #particleCanvas {
            position: absolute;
            inset: 0;
            pointer-events: none;
            z-index: 2;
            opacity: 0.35;
        }

        /* ═══════════════════════════════════════════
           CURSOR GLOW (desktop only)
        ═══════════════════════════════════════════ */
        .cursor-glow {
            position: fixed;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(232, 160, 32, 0.08) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
            z-index: 0;
            transform: translate(-50%, -50%);
            transition: left 0.12s, top 0.12s;
        }

        @media (max-width: 768px) {
            .cursor-glow {
                display: none;
            }
        }
    </style>

    @stack('styles')
</head>

<body>

    <div id="scrollProgress"></div>
    <div class="cursor-glow" id="cursorGlow"></div>

    <!-- ══════════════════════════════════════════════
     NAVBAR
══════════════════════════════════════════════ -->
    <nav class="navbar" id="navbar">
        <a href="{{ url('/') }}" class="logo">
            <div class="logo-icon-box">
                @php
                    $logo = setting('site_logo');
                    $logoUrl = $logo ? (Str::startsWith($logo, 'http') ? $logo : asset('storage/' . $logo)) : null;
                @endphp
                @if ($logoUrl)
                    <img src="{{ $logoUrl }}" alt="{{ setting('site_name', config('app.name')) }}"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                @endif
                <i class="fas fa-mountain fallback-icon" style="{{ $logoUrl ? 'display:none;' : '' }}"></i>
            </div>
            <div class="logo-texts">
                <span class="logo-name">{{ setting('site_name', 'Visit Nepal') }}</span>
                <span class="logo-tagline">{{ setting('tagline', 'Dream · Explore · Discover') }}</span>
            </div>
        </a>

        <!-- Hamburger (mobile) -->
        <button class="nav-toggle" id="navToggle" aria-label="Toggle navigation">
            <span></span><span></span><span></span>
        </button>

        <ul class="nav-links" id="navLinks">
            <li><a href="{{ route('home') }}">Home</a></li>

            <li class="nav-dropdown">
                <a href="{{ route('destinations.index') }}" id="destTrigger">
                    Destinations <i class="fa fa-chevron-down chevron"></i>
                </a>
                <ul class="dropdown-menu hidden" id="destinationDropdown">
                    @foreach ($destinations as $destination)
                        <li>
                            <a href="{{ route('destinations.show', $destination->slug) }}">
                                {{ $destination->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </li>

            <li><a href="{{ route('treks.index') }}">Treks</a></li>
            <li><a href="{{ route('packages.index') }}">Packages</a></li>
            <li><a href="{{ route('about.index') }}">About Us</a></li>
            <li><a href="{{ url('/contact') }}">Contact</a></li>
            <li><a href="{{ url('/store') }}" id="storeNavLink">Store</a></li>



            <li class="mobile-cta-li">
                <a href="{{ route('packages.index') }}" class="btn-cta-nav" style="display:none;">
                    Explore Packages
                </a>
            </li>
        </ul>

        <a href="{{ route('packages.index') }}" class="btn-cta-nav" id="desktopCta">
            <i class="fas fa-compass"></i> Explore Packages
        </a>
    </nav>


    <!-- ══════════════════════════════════════════════
     PAGE CONTENT
══════════════════════════════════════════════ -->
    @yield('content')


    <!-- ══════════════════════════════════════════════
     FOOTER
══════════════════════════════════════════════ -->
    <footer>
        <div class="footer-grid">

            <!-- Brand -->
            <div class="footer-brand" data-aos="fade-up">
                <div class="fb-logo">
                    <div class="fb-logo-box">
                        @php
                            $logo = setting('site_logo');
                            $logoUrl = $logo
                                ? (Str::startsWith($logo, 'http')
                                    ? $logo
                                    : asset('storage/' . $logo))
                                : null;
                        @endphp
                        @if ($logoUrl)
                            <img src="{{ $logoUrl }}" alt="{{ setting('site_name', config('app.name')) }}"
                                style="width:100%;height:100%;object-fit:contain;"
                                onerror="this.style.display='none';this.nextElementSibling.style.display='block';" />
                            <i class="fas fa-mountain" style="display:none;"></i>
                        @else
                            <i class="fas fa-mountain"></i>
                        @endif
                    </div>
                    <div>
                        <div class="fb-name">{{ setting('site_name', config('app.name')) }}</div>
                        <span class="fb-tagline">{{ setting('tagline', 'Dream · Explore · Discover') }}</span>
                    </div>
                </div>
                <p>{{ setting('footer_text', 'Discover the beauty of Nepal with our expertly crafted tours and treks. Your adventure starts here!') }}
                </p>
                <div class="footer-socials">
                    @if (setting('facebook_url'))
                        <a href="{{ setting('facebook_url') }}" target="_blank" rel="noopener"><i
                                class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (setting('instagram_url'))
                        <a href="{{ setting('instagram_url') }}" target="_blank" rel="noopener"><i
                                class="fab fa-instagram"></i></a>
                    @endif
                    @if (setting('twitter_url'))
                        <a href="{{ setting('twitter_url') }}" target="_blank" rel="noopener"><i
                                class="fab fa-twitter"></i></a>
                    @endif
                    @if (setting('youtube_url'))
                        <a href="{{ setting('youtube_url') }}" target="_blank" rel="noopener"><i
                                class="fab fa-youtube"></i></a>
                    @endif
                    @if (setting('tiktok_url'))
                        <a href="{{ setting('tiktok_url') }}" target="_blank" rel="noopener"><i
                                class="fab fa-tiktok"></i></a>
                    @endif
                    @if (setting('linkedin_url'))
                        <a href="{{ setting('linkedin_url') }}" target="_blank" rel="noopener"><i
                                class="fab fa-linkedin-in"></i></a>
                    @endif
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-col" data-aos="fade-up" data-aos-delay="100">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="{{ route('destinations.index') }}">Destinations</a></li>
                    <li><a href="{{ route('treks.index') }}">Treks</a></li>
                    <li><a href="{{ route('packages.index') }}">Packages</a></li>
                    <li><a href="{{ route('about.index') }}">About Us</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-col" data-aos="fade-up" data-aos-delay="400">
                <h4>Contact Info</h4>

                @if (setting('address'))
                    <div class="footer-contact-item"><i
                            class="fas fa-map-marker-alt"></i><span>{{ setting('address') }}</span></div>
                @endif
                @if (setting('phone'))
                    <div class="footer-contact-item"><i
                            class="fas fa-phone-alt"></i><span>{{ setting('phone') }}</span></div>
                @endif
                @if (setting('contact_email'))
                    <div class="footer-contact-item"><i
                            class="fas fa-envelope"></i><span>{{ setting('contact_email') }}</span></div>
                @endif
                @if (setting('whatsapp'))
                    <div class="footer-contact-item"><i
                            class="fab fa-whatsapp"></i><span>{{ setting('whatsapp') }}</span></div>
                @endif

            </div>

                        <!-- popular Destination -->
                         <div class="footer-col" data-aos="fade-up" data-aos-delay="400">
                <h4>Popular Destinations</h4>
            <ul>
              <li>Kathmandu</li>
              <li>Pokhara</li>
                <li>Chitwan</li>
            <li>Mustang</li>
</ul>
</div>

        </div>
        <div class="footer-bottom">

            {{ setting('copyright', '© ' . date('Y') . ' ' . setting('site_name', config('app.name')) . '. All Rights Reserved.Made with love') }}

        </div>
    </footer>


    <!-- ══════════════════════════════════════════════
     VIDEO MODAL
══════════════════════════════════════════════ -->
    <div id="videoModal" style="display:none;">
        <div>
            <button class="close-modal-btn" onclick="closeVideo()"><i class="fas fa-times"></i></button>
            <div style="padding:50px;text-align:center;color:rgba(255,255,255,0.45);font-size:14px;">
                <i class="fas fa-film" style="font-size:52px;margin-bottom:16px;display:block;opacity:0.5;"></i>
                Replace this with your YouTube embed.<br>
                e.g. <code>&lt;iframe src="https://www.youtube.com/embed/..."&gt;&lt;/iframe&gt;</code>
            </div>
        </div>
    </div>
    <!-- ══════════════════════════════════════════════
     STORE TRANSITION OVERLAY
══════════════════════════════════════════════ -->
    <div id="storeTransition">
        <div class="st-inner">
            <div class="st-icon-wrap"><i class="fas fa-compass"></i></div>
            <div class="st-title">Taking you to the Store</div>
            <div class="st-sub">Please wait a moment <span
                    class="st-dots"><span></span><span></span><span></span></span></div>
            <div class="st-bar-track">
                <div class="st-bar-fill" id="stBarFill"></div>
            </div>
        </div>
    </div>
    <!-- Back to top -->
    <button id="backToTop" title="Back to top"><i class="fas fa-arrow-up"></i></button>


    <!-- ══════════════════════════════════════════════
     SCRIPTS
══════════════════════════════════════════════ -->
    <!-- AOS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/aos/2.3.4/aos.js"></script>
    <!-- GSAP -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js"></script>

    <script>
        /* ── Init AOS ── */
        AOS.init({
            duration: 800,
            easing: 'ease-out-cubic',
            once: true,
            offset: 60,
        });

        /* ── Cursor glow ── */
        const cursorGlow = document.getElementById('cursorGlow');
        document.addEventListener('mousemove', (e) => {
            cursorGlow.style.left = e.clientX + 'px';
            cursorGlow.style.top = e.clientY + 'px';
        });

        /* ── Scroll progress bar ── */
        const scrollBar = document.getElementById('scrollProgress');
        window.addEventListener('scroll', () => {
            const scrolled = window.scrollY / (document.documentElement.scrollHeight - window.innerHeight);
            scrollBar.style.width = (scrolled * 100) + '%';
        });

        /* ── Navbar scroll ── */
        const navbar = document.getElementById('navbar');
        const heroBg = document.getElementById('heroBg');
        window.addEventListener('scroll', () => {
            navbar.classList.toggle('scrolled', window.scrollY > 60);
            if (heroBg) heroBg.style.transform = `translateY(${window.scrollY * 0.22}px)`;
        });

        /* ── Back to top ── */
        const btt = document.getElementById('backToTop');
        window.addEventListener('scroll', () => btt.classList.toggle('show', window.scrollY > 400));
        btt.addEventListener('click', () => window.scrollTo({
            top: 0,
            behavior: 'smooth'
        }));

        /* ── Hamburger menu ── */
        const navToggle = document.getElementById('navToggle');
        const navLinks = document.getElementById('navLinks');

        navToggle.addEventListener('click', () => {
            const open = navToggle.classList.toggle('open');
            navLinks.classList.toggle('open', open);
            document.body.style.overflow = open ? 'hidden' : '';
            // show/hide mobile CTA
            const mobileCta = navLinks.querySelector('.mobile-cta-li .btn-cta-nav');
            if (mobileCta) mobileCta.style.display = open ? 'inline-flex' : 'none';
        });

        /* ── Mobile dropdown ── */
        const destTrigger = document.getElementById('destTrigger');
        const destDropdown = document.getElementById('destinationDropdown');

        if (destTrigger) {
            destTrigger.addEventListener('click', (e) => {
                if (window.innerWidth <= 768) {
                    e.preventDefault();
                    destDropdown.classList.toggle('open');
                    destDropdown.classList.toggle('hidden');
                }
            });
        }

        /* ── Desktop dropdown: close on outside click ── */
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.nav-dropdown') && window.innerWidth > 768) {
                if (destDropdown) {
                    destDropdown.classList.add('hidden');
                    destDropdown.classList.remove('open');
                }
            }
        });

        /* ── Close mobile menu on nav link click (non-dropdown) ── */
        navLinks.querySelectorAll('li:not(.nav-dropdown):not(.mobile-cta-li) a').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    navToggle.classList.remove('open');
                    navLinks.classList.remove('open');
                    document.body.style.overflow = '';
                }
            });
        });

        /* ── Scroll reveal (legacy fallback) ── */
        const revealEls = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.1
        });
        revealEls.forEach(el => revealObserver.observe(el));

        /* ── Video modal ── */
        const modal = document.getElementById('videoModal');

        function openVideo() {
            modal.style.display = 'flex';
            document.body.style.overflow = 'hidden';
        }

        function closeVideo() {
            modal.style.display = 'none';
            document.body.style.overflow = '';
        }

        document.getElementById('openVideoBtn')?.addEventListener('click', (e) => {
            e.preventDefault();
            openVideo();
        });
        document.getElementById('openVideoBtn2')?.addEventListener('click', openVideo);
        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeVideo();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeVideo();
        });
        /* ── Store page transition ── */
        const storeLink = document.getElementById('storeNavLink');
        const storeTransition = document.getElementById('storeTransition');
        const stBarFill = document.getElementById('stBarFill');

        if (storeLink) {
            storeLink.addEventListener('click', (e) => {
                e.preventDefault();
                const destination = storeLink.getAttribute('href');

                // close mobile menu if open
                navToggle.classList.remove('open');
                navLinks.classList.remove('open');
                document.body.style.overflow = 'hidden';

                storeTransition.classList.add('active');

                // animate progress bar
                requestAnimationFrame(() => {
                    stBarFill.style.width = '100%';
                });

                // navigate after the transition plays
                setTimeout(() => {
                    window.location.href = destination;
                }, 1100);
            });
        }

        /* ── Reset overlay if user returns via back/forward cache ── */
        window.addEventListener('pageshow', (e) => {
            if (e.persisted) {
                storeTransition.classList.remove('active');
                stBarFill.style.width = '0%';
            }
        });
    </script>

    @stack('scripts')
</body>

</html>
