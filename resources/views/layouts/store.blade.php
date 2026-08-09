<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" type="image/png"
        href="{{ setting('site_favicon') ? asset(setting('favicon')) : asset('favicon.png') }}">
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
            background: #fff;
            border-bottom: 1px solid var(--line);
            z-index: 1000;
            transition: box-shadow .25s ease;
        }

        .store-nav.scrolled {
            box-shadow: 0 4px 24px rgba(0, 0, 0, .06);
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

        .store-nav-links .chevron {
            font-size: .55rem;
            transition: transform .25s;
        }

        .store-dropdown:hover .chevron {
            transform: rotate(180deg);
        }

        .store-dropdown-menu {
            position: absolute;
            top: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%) translateY(-8px);
            min-width: 220px;
            background: #fff;
            border: 1px solid var(--line);
            border-radius: 14px;
            padding: 8px;
            list-style: none;
            box-shadow: 0 20px 50px rgba(0, 0, 0, .1);
            opacity: 0;
            pointer-events: none;
            transition: opacity .25s, transform .25s;
        }

        .store-dropdown:hover .store-dropdown-menu {
            opacity: 1;
            pointer-events: auto;
            transform: translateX(-50%) translateY(0);
        }

        .store-dropdown-menu li a {
            border-radius: 9px;
            padding: 9px 14px;
            font-size: .84rem;
        }

        .store-dropdown-menu li a:hover {
            background: var(--panel);
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
            transition: background .2s;
        }

        .icon-btn:hover {
            background: var(--panel);
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
                transform: none;
                opacity: 1;
                pointer-events: auto;
                display: none;
                box-shadow: none;
                border: none;
                background: var(--panel);
            }

            .store-dropdown-menu.open {
                display: block;
            }
        }

        /* ═══════════ SHARED SECTION TOKENS (from product page) ═══════════ */
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

        @stack('styles')
    </style>
</head>

<body>

    <!-- ═══════════ STORE NAVBAR ═══════════ -->
    <nav class="store-nav" id="storeNav">
        <a href="{{ url('/') }}" class="store-logo">
            <div class="store-logo-box">
                @php
                    $logo = setting('site_logo');
                    $logoUrl = $logo ? (Str::startsWith($logo, 'http') ? $logo : asset('storage/' . $logo)) : null;
                @endphp
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

        <button class="store-nav-toggle" id="storeNavToggle" aria-label="Toggle menu">
            <span></span><span></span><span></span>
        </button>

        <ul class="store-nav-links" id="storeNavLinks">
            <li><a href="{{ route('store.index') }}" class="js-store-nav">All Products</a></li>

            @if (isset($categories) && $categories->count())
                <li class="store-dropdown">
                    <a href="#" id="storeCatTrigger">Categories <i class="fa fa-chevron-down chevron"></i></a>
                    <ul class="store-dropdown-menu" id="storeCatDropdown">
                        @foreach ($categories as $cat)
                            <li><a href="{{ route('store.index', ['category' => $cat->slug]) }}"
                                    class="js-store-nav">{{ $cat->name }}</a></li>
                        @endforeach
                    </ul>
                </li>
            @endif

            <li><a href="{{ route('home') }}" id="storeHomeLink"><i class="fas fa-home"></i> Home</a></li>
        </ul>

        <div class="store-nav-right">
            <button class="icon-btn" id="storeSearchToggle" title="Search"><i class="fas fa-search"></i></button>
            <a href="{{ route('cart.index') ?? '#' }}" class="icon-btn" title="Cart">
                <i class="fas fa-shopping-bag"></i>
                @php $cartCount = $cartCount ?? (session('cart') ? count(session('cart')) : 0); @endphp
                @if ($cartCount > 0)
                    <span class="cart-count">{{ $cartCount }}</span>
                @endif
            </a>
        </div>
    </nav>

    <!-- ═══════════ PAGE CONTENT ═══════════ -->
    @yield('content')

    <!-- ═══════════ STORE FOOTER ═══════════ -->
    <footer class="store-footer">
        <div class="store-footer-grid">
            <div class="sf-brand">
                <div class="sf-logo">
                    <div class="sf-logo-box">
                        @if ($logoUrl)
                            <img src="{{ $logoUrl }}"
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
                        <a href="{{ setting('facebook_url') }}" target="_blank"><i class="fab fa-facebook-f"></i></a>
                    @endif
                    @if (setting('instagram_url'))
                        <a href="{{ setting('instagram_url') }}" target="_blank"><i class="fab fa-instagram"></i></a>
                    @endif
                    @if (setting('twitter_url'))
                        <a href="{{ setting('twitter_url') }}" target="_blank"><i class="fab fa-twitter"></i></a>
                    @endif
                </div>
            </div>

            <div class="sf-col">
                <h4>Shop</h4>
                <ul>
                    <li><a href="{{ route('store.index') }}">All Products</a></li>
                    @foreach (($categories ?? collect())->take(5) as $cat)
                        <li><a href="{{ route('store.index', ['category' => $cat->slug]) }}">{{ $cat->name }}</a>
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
                    <li><a href="#"><i class="fas fa-envelope"></i> store@{{ Str::slug(setting('site_name', 'trailco')) }}.com</a></li>
                </ul>
            </div>
        </div>

        <div class="store-footer-bottom">
            © {{ date('Y') }} {{ setting('site_name', 'TrailCo') }}. All Rights Reserved.
        </div>
    </footer>

    <!-- ═══════════ TRANSITION OVERLAY (internal nav + home) ═══════════ -->
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
            const nav = document.getElementById('storeNav');
            window.addEventListener('scroll', () => nav.classList.toggle('scrolled', window.scrollY > 20));

            const toggle = document.getElementById('storeNavToggle');
            const links = document.getElementById('storeNavLinks');
            toggle.addEventListener('click', () => {
                const open = toggle.classList.toggle('open');
                links.classList.toggle('open', open);
                document.body.style.overflow = open ? 'hidden' : '';
            });

            const catTrigger = document.getElementById('storeCatTrigger');
            const catDropdown = document.getElementById('storeCatDropdown');
            if (catTrigger) {
                catTrigger.addEventListener('click', (e) => {
                    if (window.innerWidth <= 900) {
                        e.preventDefault();
                        catDropdown.classList.toggle('open');
                    }
                });
            }

            /* ── Close mobile menu on any normal nav click (no loader here) ── */
            links.querySelectorAll('a:not(#storeHomeLink)').forEach(a => {
                a.addEventListener('click', () => {
                    toggle.classList.remove('open');
                    links.classList.remove('open');
                    document.body.style.overflow = '';
                    // no preventDefault, no transition — link navigates normally
                });
            });

            /* ── Page transition loader — ONLY for the Home link ── */
            const loader = document.getElementById('storeLoader');
            const slTitle = document.getElementById('slTitle');
            const slSub = document.getElementById('slSub');
            const slIcon = document.getElementById('slIcon');
            const slBarFill = document.getElementById('slBarFill');
            const NAV_DELAY = 950;

            const homeLink = document.getElementById('storeHomeLink');
            if (homeLink) {
                homeLink.addEventListener('click', (e) => {
                    if (e.metaKey || e.ctrlKey || e.shiftKey) return;
                    e.preventDefault();
                    toggle.classList.remove('open');
                    links.classList.remove('open');
                    document.body.style.overflow = '';

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
                    }, NAV_DELAY);
                });
            }

            window.addEventListener('pageshow', (e) => {
                if (e.persisted) {
                    loader.classList.remove('active');
                }
            });
        })();
    </script>

    @stack('scripts')
</body>

</html>
