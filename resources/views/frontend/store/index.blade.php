@extends('layouts.store')
@section('title', (request('category') ? optional(($categories ?? collect())->firstWhere('slug',
    request('category')))->name . ' – ' : '') . setting('site_name', 'TrailCo') . ' Store')

    @push('styles')
        <style>
            /* ---------- HERO (only on unfiltered/first page) ---------- */
            .hero {
                position: relative;
                min-height: 520px;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                overflow: hidden;
                background: #0a121c;
                /* fallback color while image loads */
            }

            .hero-bg-img {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center 30%;
                z-index: 0;
            }

            .hero-overlay {
                position: absolute;
                inset: 0;
                background: linear-gradient(100deg, rgba(10, 18, 28, .92) 0%, rgba(10, 18, 28, .72) 32%, rgba(10, 18, 28, .15) 62%, rgba(10, 18, 28, .05) 100%);
                z-index: 1;
            }

            .hero-content {
                position: relative;
                z-index: 2;
                padding: 80px 60px 50px;
                max-width: 620px;
            }

            .hero .eyebrow {
                color: #b7e56b;
                margin-bottom: 18px;
            }

            .hero h1 {
                color: #fff;
                font-size: 2.8rem;
                line-height: 1.12;
                font-weight: 700;
                margin-bottom: 20px;
            }

            .hero h1 .accent {
                color: var(--green);
            }

            .hero p {
                color: rgba(255, 255, 255, .85);
                font-size: 1rem;
                line-height: 1.6;
                max-width: 460px;
                margin-bottom: 30px;
            }

            .feature-bar {
                position: relative;
                z-index: 2;
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                background: rgba(15, 22, 16, .55);
                backdrop-filter: blur(6px);
                border-top: 1px solid rgba(255, 255, 255, .12);
            }

            .feature-item {
                display: flex;
                align-items: center;
                gap: 14px;
                padding: 24px 30px;
                color: #fff;
                border-right: 1px solid rgba(255, 255, 255, .12);
            }

            .feature-item:last-child {
                border-right: none;
            }

            .feature-item svg {
                flex-shrink: 0;
                width: 24px;
                height: 24px;
                stroke: var(--green);
            }

            .feature-item .f-title {
                font-size: .84rem;
                font-weight: 600;
                margin-bottom: 3px;
            }

            .feature-item .f-sub {
                font-size: .75rem;
                color: rgba(255, 255, 255, .65);
            }

            @media (max-width:1100px) {
                .feature-bar {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width:640px) {
                .feature-bar {
                    grid-template-columns: 1fr;
                }

                .feature-item {
                    border-right: none;
                    border-bottom: 1px solid rgba(255, 255, 255, .12);
                }

                .hero-content {
                    padding: 50px 22px 34px;
                }

                .hero h1 {
                    font-size: 2rem;
                }
            }

            /* ---------- CATEGORIES ---------- */
            .category-grid {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                gap: 20px;
            }

            .cat-card {
                background: var(--panel);
                border-radius: 4px;
                overflow: hidden;
                text-align: center;
                transition: box-shadow .25s ease, transform .25s ease;
                cursor: pointer;
                position: relative;
            }

            .cat-card:hover {
                box-shadow: 0 14px 30px rgba(0, 0, 0, .1);
                transform: translateY(-4px);
            }

            .cat-card.active {
                box-shadow: 0 0 0 2px var(--green) inset;
            }

            .cat-img {
                height: 170px;
                width: 100%;
                object-fit: cover;
            }

            .cat-body {
                padding: 20px 14px 26px;
                position: relative;
            }

            .cat-icon {
                width: 48px;
                height: 48px;
                border-radius: 50%;
                background: #fff;
                box-shadow: 0 4px 14px rgba(0, 0, 0, .12);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: -44px auto 14px;
                position: relative;
                z-index: 2;
            }

            .cat-icon svg {
                width: 22px;
                height: 22px;
                stroke: var(--ink);
            }

            .cat-card h3 {
                font-size: 1.05rem;
                font-weight: 600;
                margin-bottom: 6px;
            }

            .cat-count {
                font-size: .72rem;
                color: var(--muted);
                margin-bottom: 8px;
            }

            .cat-link {
                font-size: .8rem;
                font-weight: 600;
                color: var(--green-dark);
                display: inline-flex;
                align-items: center;
                gap: 4px;
            }

            @media (max-width:1100px) {
                .category-grid {
                    grid-template-columns: repeat(3, 1fr);
                }
            }

            @media (max-width:640px) {
                .category-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            /* ---------- TOOLBAR ---------- */
            .picks-head {
                display: flex;
                align-items: flex-end;
                justify-content: space-between;
                margin-bottom: 26px;
                flex-wrap: wrap;
                gap: 16px;
            }

            .picks-head .titles h2 {
                font-size: 2.1rem;
                font-weight: 700;
                position: relative;
                padding-bottom: 14px;
            }

            .picks-head .titles h2::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                width: 46px;
                height: 3px;
                background: var(--ink);
                border-radius: 2px;
            }

            .toolbar-right {
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: wrap;
            }

            .store-search-form {
                position: relative;
            }

            .store-search-form input {
                border: 1px solid var(--line);
                border-radius: 30px;
                padding: 10px 18px 10px 38px;
                font-family: 'Inter', sans-serif;
                font-size: .85rem;
                width: 220px;
                transition: border-color .2s;
            }

            .store-search-form input:focus {
                outline: none;
                border-color: var(--green);
            }

            .store-search-form i {
                position: absolute;
                left: 14px;
                top: 50%;
                transform: translateY(-50%);
                color: var(--muted);
                font-size: .8rem;
            }

            .store-sort select {
                border: 1px solid var(--line);
                border-radius: 30px;
                padding: 10px 16px;
                font-family: 'Inter', sans-serif;
                font-size: .85rem;
                background: #fff;
                cursor: pointer;
                color: var(--ink);
            }

            .store-sort select:focus {
                outline: none;
                border-color: var(--green);
            }

            .carousel-arrows {
                display: flex;
                gap: 10px;
            }

            .arrow-btn {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                border: 1px solid var(--line);
                background: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--ink);
                transition: background .2s;
            }

            .arrow-btn.disabled {
                opacity: .35;
                pointer-events: none;
            }

            .arrow-btn:not(.disabled):hover {
                background: var(--panel);
            }

            .active-filter-chip {
                display: inline-flex;
                align-items: center;
                gap: 8px;
                background: var(--panel);
                border-radius: 30px;
                padding: 8px 14px;
                font-size: .82rem;
                font-weight: 500;
                margin-bottom: 20px;
            }

            .active-filter-chip a {
                color: var(--muted);
                font-size: .9rem;
            }

            /* ---------- PRODUCTS ---------- */
            .product-grid {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                gap: 18px;
            }

            .product-card {
                border: 1px solid var(--line);
                border-radius: 6px;
                padding: 14px;
                position: relative;
                transition: box-shadow .2s ease, transform .2s ease;
                display: flex;
                flex-direction: column;
            }

            .product-card:hover {
                box-shadow: 0 12px 26px rgba(0, 0, 0, .08);
                transform: translateY(-3px);
            }

            .wish-btn {
                position: absolute;
                top: 16px;
                right: 16px;
                width: 32px;
                height: 32px;
                border-radius: 50%;
                background: #fff;
                border: 1px solid var(--line);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 2;
            }

            .wish-btn svg {
                width: 15px;
                height: 15px;
                stroke: var(--ink);
                fill: none;
            }

            .wish-btn.active svg {
                fill: #e0483e;
                stroke: #e0483e;
            }

            .sale-badge {
                position: absolute;
                top: 16px;
                left: 16px;
                background: #c1362b;
                color: #fff;
                font-size: .65rem;
                font-weight: 700;
                padding: 4px 9px;
                border-radius: 20px;
                z-index: 2;
            }

            .product-img-wrap {
                height: 190px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 16px;
                overflow: hidden;
            }

            .product-img {
                width: 100%;
                height: 100%;
                object-fit: contain;
            }

            .product-img-fallback {
                font-size: 2rem;
                color: var(--line);
            }

            .p-brand {
                font-size: .68rem;
                letter-spacing: .06em;
                text-transform: uppercase;
                color: var(--muted);
                margin-bottom: 4px;
            }

            .p-name {
                font-size: .92rem;
                font-weight: 500;
                margin-bottom: 8px;
                line-height: 1.35;
                min-height: 2.5em;
            }

            .p-rating {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: .78rem;
                color: var(--muted);
                margin-bottom: 10px;
            }

            .stars {
                display: flex;
                gap: 1px;
            }

            .stars svg {
                width: 13px;
                height: 13px;
            }

            .star-fill {
                fill: #f5a623;
                stroke: #f5a623;
            }

            .star-empty {
                fill: none;
                stroke: #d8d8d8;
            }

            .p-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: auto;
            }

            .p-price {
                font-weight: 700;
                font-size: .95rem;
            }

            .p-price .old-price {
                font-size: .76rem;
                color: var(--muted);
                text-decoration: line-through;
                font-weight: 400;
                margin-right: 5px;
            }

            .add-cart-btn {
                width: 34px;
                height: 34px;
                border-radius: 50%;
                background: var(--green);
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: #16210a;
                font-size: .85rem;
                transition: background .2s, transform .2s;
                flex-shrink: 0;
            }

            .add-cart-btn:hover {
                background: var(--green-dark);
                color: #fff;
                transform: scale(1.08);
            }

            .out-of-stock {
                font-size: .68rem;
                font-weight: 700;
                color: #c1362b;
                background: rgba(193, 54, 43, .08);
                padding: 6px 10px;
                border-radius: 20px;
            }

            @media (max-width:1100px) {
                .product-grid {
                    grid-template-columns: repeat(3, 1fr);
                }
            }

            @media (max-width:640px) {
                .product-grid {
                    grid-template-columns: repeat(2, 1fr);
                }

                .picks-head {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .store-search-form input {
                    width: 100%;
                }
            }

            /* ---------- EMPTY STATE ---------- */
            .empty-state {
                grid-column: 1/-1;
                text-align: center;
                padding: 80px 20px;
                color: var(--muted);
                background: var(--panel);
                border-radius: 8px;
                border: 1px dashed var(--line);
            }

            .empty-state i {
                font-size: 2.4rem;
                margin-bottom: 16px;
                color: #c8cfc2;
            }

            .empty-state h3 {
                font-family: 'Poppins', sans-serif;
                color: var(--ink);
                font-size: 1.1rem;
                margin-bottom: 6px;
            }

            .flash-success {
                grid-column: 1/-1;
                display: flex;
                align-items: center;
                gap: 10px;
                background: #eaf6de;
                color: var(--green-dark);
                padding: 14px 18px;
                border-radius: 8px;
                font-size: .88rem;
                font-weight: 600;
                margin-bottom: 6px;
            }

            /* ---------- PAGINATION ---------- */
            .pagination-wrap {
                margin-top: 44px;
                display: flex;
                justify-content: center;
            }

            .pagination-wrap nav ul {
                list-style: none;
                display: flex;
                gap: 6px;
            }

            .pagination-wrap .page-link {
                display: flex;
                align-items: center;
                justify-content: center;
                min-width: 38px;
                height: 38px;
                border-radius: 50%;
                border: 1px solid var(--line);
                color: var(--ink);
                font-size: .85rem;
                background: #fff;
            }

            .pagination-wrap .active .page-link {
                background: var(--green);
                border-color: var(--green);
                color: #16210a;
                font-weight: 700;
            }

            .pagination-wrap .disabled .page-link {
                opacity: .35;
            }

            /* ---------- PROMO BANNERS ---------- */
            .promo-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 4px;
                padding: 0 60px 70px;
                max-width: 1400px;
                margin: 0 auto;
            }

            .promo-card {
                position: relative;
                height: 230px;
                border-radius: 4px;
                overflow: hidden;
                display: flex;
                align-items: flex-end;
                color: #fff;
            }

            .promo-card::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(90deg, rgba(10, 14, 10, .82) 0%, rgba(10, 14, 10, .45) 55%, rgba(10, 14, 10, .1) 100%);
                z-index: 1;
            }

            .promo-card img {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: 0;
            }

            .promo-inner {
                position: relative;
                z-index: 2;
                padding: 28px 32px;
            }

            .promo-inner h3 {
                font-size: 1.4rem;
                font-weight: 700;
                margin-bottom: 8px;
            }

            .promo-inner p {
                font-size: .86rem;
                color: rgba(255, 255, 255, .85);
                margin-bottom: 16px;
                max-width: 230px;
                line-height: 1.45;
            }

            @media (max-width:1100px) {
                .promo-row {
                    grid-template-columns: 1fr;
                }
            }

            @media (max-width:640px) {
                .promo-row {
                    padding: 0 20px 50px;
                }
            }
        </style>
    @endpush

@section('content')

    @php
        $activeSlug = request('category');
        $activeCategory = $activeSlug ? ($categories ?? collect())->firstWhere('slug', $activeSlug) : null;

        // icon map — reused from the static design, falls back to a generic bag icon
        $iconMap = [
            'backpacks' =>
                '<path d="M6 8a6 6 0 0112 0v3h1a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1v-7a1 1 0 011-1h1V8z"/><path d="M9 8V6a3 3 0 016 0v2"/>',
            'clothing' => '<path d="M8 4L4 8l3 3 2-2v9h6v-9l2 2 3-3-4-4-3 2-3-2z"/>',
            'footwear' => '<path d="M3 18c0-2 2-3 4-5l3-4 3 2 4-1 4 3v3a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>',
            'trekking-gear' => '<path d="M6 21L10 3M18 21L14 3"/><path d="M8 12h2M14 12h2"/>',
            'camping-gear' => '<path d="M2 20h20L12 4z"/><path d="M12 4v16"/>',
        ];
        $fallbackIcon =
            '<path d="M6 8a6 6 0 0112 0v3h1a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1v-7a1 1 0 011-1h1V8z"/>';

        // hero image resolution — DB setting if present & valid, otherwise local static file
        $heroImageSetting = setting('store_hero_image');
        $heroImageUrl = $heroImageSetting
            ? (Str::startsWith($heroImageSetting, 'http')
                ? $heroImageSetting
                : asset('storage/' . $heroImageSetting))
            : asset('images/everest.jpg');
        $heroFallbackUrl = asset('images/everest.jpg');
    @endphp

    @if (!request()->hasAny(['category', 'search', 'page', 'sort']))
        <!-- ================= HERO (only shown on the clean landing view) ================= -->
        <section class="hero">
            <img src="{{ $heroImageUrl }}" alt="Trekking gear hero" class="hero-bg-img"
                onerror="this.onerror=null; this.src='{{ $heroFallbackUrl }}';">
            <div class="hero-overlay"></div>

            <div class="hero-content">
                <div class="eyebrow">{{ setting('store_eyebrow', 'Gear Up. Step Out. Explore.') }}</div>
                <h1>{{ setting('store_headline_1', 'For Every Trail.') }}<br>{{ setting('store_headline_2', 'For Every') }}
                    <span class="accent">{{ setting('store_headline_accent', 'Explorer.') }}</span>
                </h1>
                <p>{{ setting('store_subtext', 'Premium trekking & hiking gears, clothes and shoes for your next adventure.') }}
                </p>
                <a href="#shop" class="btn-primary">SHOP NOW
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.4" stroke-linecap="round">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </a>
            </div>

            <div class="feature-bar">
                <div class="feature-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M3 20l6-11 4 7 3-5 5 9H3z" />
                    </svg>
                    <div>
                        <div class="f-title">Built for Adventure</div>
                        <div class="f-sub">Durable & reliable gear</div>
                    </div>
                </div>
                <div class="feature-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M5 21c9 0 14-6 14-16C10 5 5 10 5 21z" />
                        <path d="M5 21c0-6 3-10 8-12" />
                    </svg>
                    <div>
                        <div class="f-title">Lightweight</div>
                        <div class="f-sub">Move freely, go further</div>
                    </div>
                </div>
                <div class="feature-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z" />
                    </svg>
                    <div>
                        <div class="f-title">Premium Quality</div>
                        <div class="f-sub">Tested for every terrain</div>
                    </div>
                </div>
                <div class="feature-item">
                    <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M3 16V7a1 1 0 011-1h10v10H4a1 1 0 01-1-1z" />
                        <path d="M14 10h4l3 3v3h-7z" />
                        <circle cx="7.5" cy="18.5" r="1.5" />
                        <circle cx="17.5" cy="18.5" r="1.5" />
                    </svg>
                    <div>
                        <div class="f-title">Fast Delivery</div>
                        <div class="f-sub">Across the country</div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ================= CATEGORIES ================= -->
    @if (($categories ?? collect())->count())
        <section class="section" id="categories">
            <div class="section-head">
                <div class="eyebrow">Shop By Category</div>
                <h2>Find What You Need</h2>
                <svg class="divider-icon" viewBox="0 0 46 20" fill="none" stroke="var(--ink)" stroke-width="1.4"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 18l9-13 6 8 4-5 5 6" />
                    <path d="M20 18l9-13 6 8 4-5" />
                </svg>
            </div>

            <div class="category-grid">
                @foreach ($categories as $cat)
                    <a href="{{ route('store.index', ['category' => $cat->slug]) }}" style="display:contents;">
                        <div class="cat-card {{ $activeSlug === $cat->slug ? 'active' : '' }}">
                            <img class="cat-img"
                                src="{{ $cat->image ? Storage::url($cat->image) : 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=500&q=80' }}"
                                alt="{{ $cat->name }}"
                                onerror="this.onerror=null; this.src='{{ asset('images/category-fallback.jpg') }}';">
                            <div class="cat-body">
                                <div class="cat-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        {!! $iconMap[$cat->slug] ?? $fallbackIcon !!}
                                    </svg>
                                </div>
                                <h3>{{ $cat->name }}</h3>
                                @if (isset($cat->products_count))
                                    <div class="cat-count">{{ $cat->products_count }} products</div>
                                @endif
                                <span class="cat-link">Explore Now
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.4" stroke-linecap="round">
                                        <path d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <!-- ================= PRODUCTS ================= -->
    <section class="section" id="shop">
        <div class="picks-head">
            <div class="titles">
                <div class="eyebrow">
                    {{ $activeCategory ? 'Category' : (request('search') ? 'Search Results' : 'Best Sellers') }}</div>
                <h2>{{ $activeCategory->name ?? (request('search') ? '“' . request('search') . '”' : 'Top Picks for You') }}
                </h2>
            </div>

            <div class="toolbar-right">
                <form action="{{ route('store.index') }}" method="GET" class="store-search-form">
                    @if ($activeSlug)
                        <input type="hidden" name="category" value="{{ $activeSlug }}">
                    @endif
                    <i class="fas fa-search"></i>
                    <input type="text" name="search" value="{{ request('search') }}"
                        placeholder="Search products...">
                </form>

                <form action="{{ route('store.index') }}" method="GET" class="store-sort" onchange="this.submit()">
                    @if ($activeSlug)
                        <input type="hidden" name="category" value="{{ $activeSlug }}">
                    @endif
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <select name="sort">
                        <option value="">Sort: Featured</option>
                        <option value="price_asc" @selected(request('sort') === 'price_asc')>Price: Low to High</option>
                        <option value="price_desc" @selected(request('sort') === 'price_desc')>Price: High to Low</option>
                        <option value="newest" @selected(request('sort') === 'newest')>Newest</option>
                    </select>
                </form>

                <div class="carousel-arrows">
                    <a href="{{ $products->previousPageUrl() ?? '#' }}"
                        class="arrow-btn {{ $products->onFirstPage() ? 'disabled' : '' }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.2" stroke-linecap="round">
                            <path d="M15 6l-6 6 6 6" />
                        </svg>
                    </a>
                    <a href="{{ $products->nextPageUrl() ?? '#' }}"
                        class="arrow-btn {{ !$products->hasMorePages() ? 'disabled' : '' }}">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.2" stroke-linecap="round">
                            <path d="M9 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        @if ($activeCategory || request('search'))
            <div class="active-filter-chip">
                @if ($activeCategory)
                    Category: <strong>{{ $activeCategory->name }}</strong>
                @endif
                @if (request('search'))
                    Search: <strong>"{{ request('search') }}"</strong>
                @endif
                <a href="{{ route('store.index') }}" title="Clear filters"><i class="fas fa-times"></i></a>
            </div>
        @endif

        <div class="product-grid">
            @if (session('success'))
                <div class="flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif

            @forelse($products as $product)
                <div class="product-card">
                    <button class="wish-btn" type="button">
                        <svg viewBox="0 0 24 24" stroke-width="2">
                            <path
                                d="M12 21s-7-4.35-10-9C-0.5 7 2 3 6 3c2 0 4 1.5 6 4 2-2.5 4-4 6-4 4 0 6.5 4 4 9-3 4.65-10 9-10 9z" />
                        </svg>
                    </button>

                    @if ($product->sale_price)
                        @php $discount = round((($product->price - $product->sale_price) / $product->price) * 100); @endphp
                        <div class="sale-badge">-{{ $discount }}%</div>
                    @endif

                    <div class="product-img-wrap">
                        @if ($product->image)
                            <img class="product-img" src="{{ Storage::url($product->image) }}"
                                alt="{{ $product->name }}"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <i class="fas fa-image product-img-fallback" style="display:none;"></i>
                        @else
                            <i class="fas fa-image product-img-fallback"></i>
                        @endif
                    </div>

                    <div class="p-brand">{{ $product->category->name ?? 'GEAR' }}</div>
                    <div class="p-name">{{ $product->name }}</div>

                    @if (isset($product->average_rating))
                        <div class="p-rating">
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($product->average_rating >= $i)
                                        <svg class="star-fill" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z" />
                                        </svg>
                                    @elseif($product->average_rating >= $i - 0.5)
                                        <svg class="star-fill" viewBox="0 0 24 24" style="clip-path:inset(0 50% 0 0)">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z" />
                                        </svg>
                                    @else
                                        <svg class="star-empty" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <span>({{ $product->reviews_count ?? 0 }})</span>
                        </div>
                    @endif

                    <div class="p-footer">
                        <div class="p-price">
                            @if ($product->sale_price)
                                <span class="old-price">{{ setting('currency', 'Rs.') }}
                                    {{ number_format($product->price) }}</span>{{ setting('currency', 'Rs.') }}
                                {{ number_format($product->sale_price) }}
                            @else
                                {{ setting('currency', 'Rs.') }} {{ number_format($product->price) }}
                            @endif
                        </div>

                        @if ($product->isInStock())
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="add-cart-btn" title="Add to cart"><i
                                        class="fas fa-cart-plus"></i></button>
                            </form>
                        @else
                            <span class="out-of-stock">Out of stock</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h3>No products found</h3>
                    <p>Try adjusting your search or browsing a different category.</p>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="pagination-wrap">{{ $products->links() }}</div>
        @endif
    </section>

    <!-- ================= PROMO BANNERS ================= -->
    @if (!request()->hasAny(['category', 'search', 'page']))
        @php
            $promo1Setting = setting('store_promo1_image');
            $promo1Url = $promo1Setting
                ? (Str::startsWith($promo1Setting, 'http')
                    ? $promo1Setting
                    : asset('storage/' . $promo1Setting))
                : asset('images/store-promo-new-arrivals.jpg');

            $promo2Setting = setting('store_promo2_image');
            $promo2Url = $promo2Setting
                ? (Str::startsWith($promo2Setting, 'http')
                    ? $promo2Setting
                    : asset('storage/' . $promo2Setting))
                : asset('images/store-promo-rain-gear.jpg');
        @endphp
        <div class="promo-row">
            <div class="promo-card">
                <img src="{{ $promo1Url }}" alt="New Arrivals"
                    onerror="this.onerror=null; this.src='{{ asset('images/store-promo-new-arrivals.jpg') }}';">
                <div class="promo-inner">
                    <h3>New Arrivals</h3>
                    <p>Latest gear for your next adventure.</p>
                    <a href="{{ route('store.index', ['sort' => 'newest']) }}" class="btn-outline">EXPLORE NOW
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.4" stroke-linecap="round">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="promo-card">
                <img src="{{ $promo2Url }}" alt="Ready for Rain"
                    onerror="this.onerror=null; this.src='{{ asset('images/store-promo-rain-gear.jpg') }}';">
                <div class="promo-inner">
                    <h3>Ready for Rain?</h3>
                    <p>Waterproof gear to keep you going.</p>
                    <a href="{{ route('store.index', ['search' => 'rain']) }}" class="btn-outline">SHOP RAIN GEAR
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.4" stroke-linecap="round">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.wish-btn').forEach(btn => {
            btn.addEventListener('click', e => e.currentTarget.classList.toggle('active'));
        });
    </script>
@endpush
