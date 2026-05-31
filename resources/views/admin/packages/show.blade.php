@extends('layouts.admin')

@section('title', $package->name . ' — Package Details')
@section('page_title', 'Package Details')
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

        .pkg-page {
            font-family: 'Sora', sans-serif;
            color: var(--ink);
            padding-bottom: 60px;
        }

        /* ── Top bar ── */
        .pkg-topbar {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 28px;
        }

        .pkg-topbar-left h1 {
            font-size: clamp(18px, 2.5vw, 22px);
            font-weight: 700;
            color: var(--ink);
            margin: 0 0 4px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .pkg-topbar-left h1 i {
            color: var(--gold);
            font-size: 18px;
        }

        .pkg-meta-chips {
            display: flex;
            align-items: center;
            gap: 8px;
            flex-wrap: wrap;
        }

        .chip {
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

        .chip i {
            font-size: 9px;
        }

        .chip-blue {
            background: var(--blue-lt);
            color: var(--blue);
        }

        .chip-green {
            background: var(--green-lt);
            color: var(--green);
        }

        .chip-amber {
            background: var(--amber-lt);
            color: var(--amber);
        }

        .chip-red {
            background: var(--red-lt);
            color: var(--red);
        }

        .chip-slate {
            background: var(--line-2);
            color: var(--slate);
        }

        .chip-gold {
            background: var(--gold-lt);
            color: var(--gold);
        }

        .pkg-topbar-right {
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

        /* ── Hero image ── */
        .pkg-hero {
            border-radius: var(--r);
            overflow: hidden;
            height: clamp(220px, 32vw, 380px);
            position: relative;
            margin-bottom: 20px;
            box-shadow: var(--sh-lg);
        }

        .pkg-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
            display: block;
            transition: transform .5s ease;
        }

        .pkg-hero:hover img {
            transform: scale(1.03);
        }

        .pkg-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(15, 25, 35, .7) 0%, transparent 55%);
            pointer-events: none;
        }

        .pkg-hero-bottom {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px 24px;
            display: flex;
            align-items: flex-end;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .pkg-hero-title {
            font-size: clamp(18px, 3vw, 26px);
            font-weight: 800;
            color: #fff;
            text-shadow: 0 2px 8px rgba(0, 0, 0, .3);
            line-height: 1.2;
        }

        .pkg-hero-price {
            text-align: right;
            flex-shrink: 0;
        }

        .pkg-hero-price .from {
            font-size: 10px;
            color: rgba(255, 255, 255, .5);
            text-transform: uppercase;
            letter-spacing: .8px;
            display: block;
            margin-bottom: 2px;
        }

        .pkg-hero-price .amount {
            font-size: 26px;
            font-weight: 800;
            color: #fbbf24;
            line-height: 1;
        }

        .pkg-hero-price .amount small {
            font-size: 12px;
            color: rgba(255, 255, 255, .45);
            font-weight: 400;
            margin-left: 3px;
        }

        .pkg-hero-price .original {
            font-size: 12px;
            color: rgba(255, 255, 255, .35);
            text-decoration: line-through;
            display: block;
            text-align: right;
            margin-top: 2px;
        }

        /* ── Gallery strip ── */
        .gallery-strip {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(100px, 1fr));
            gap: 8px;
            margin-bottom: 20px;
        }

        .gallery-thumb {
            aspect-ratio: 1;
            border-radius: var(--r-sm);
            overflow: hidden;
            cursor: pointer;
            transition: transform var(--ease);
        }

        .gallery-thumb:hover {
            transform: scale(1.04);
        }

        .gallery-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        /* ── Main grid ── */
        .pkg-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 20px;
            align-items: start;
        }

        @media (max-width: 900px) {
            .pkg-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── Card ── */
        .pkg-card {
            background: var(--surface);
            border-radius: var(--r);
            box-shadow: var(--sh-md);
            overflow: hidden;
            margin-bottom: 20px;
        }

        .pkg-card:last-child {
            margin-bottom: 0;
        }

        .pkg-card-head {
            padding: 16px 24px;
            border-bottom: 1px solid var(--line-2);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .head-icon {
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

        .icon-red {
            background: var(--red-lt);
            color: var(--red);
        }

        .icon-slate {
            background: var(--line-2);
            color: var(--slate);
        }

        .pkg-card-head h2 {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
            margin: 0;
            text-transform: uppercase;
            letter-spacing: .7px;
            flex: 1;
        }

        .pkg-card-head .head-count {
            font-size: 11px;
            font-weight: 600;
            color: var(--slate-lt);
            background: var(--line-2);
            border-radius: 50px;
            padding: 2px 9px;
        }

        .pkg-card-body {
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

        /* ── Description ── */
        .desc-text {
            font-size: 13px;
            color: var(--slate);
            line-height: 1.75;
        }

        /* ── Include / Exclude list ── */
        .inc-exc-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 600px) {
            .inc-exc-grid {
                grid-template-columns: 1fr;
            }
        }

        .inc-list,
        .exc-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .inc-list li,
        .exc-list li {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            font-size: 13px;
            color: var(--ink-2);
            padding: 7px 0;
            border-bottom: 1px solid var(--line-2);
            line-height: 1.5;
        }

        .inc-list li:last-child,
        .exc-list li:last-child {
            border-bottom: none;
        }

        .inc-list .ic {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--green-lt);
            color: var(--green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .exc-list .ic {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: var(--red-lt);
            color: var(--red);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 9px;
            flex-shrink: 0;
            margin-top: 1px;
        }

        .inc-exc-sub {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .8px;
            color: var(--slate-lt);
            margin-bottom: 10px;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .inc-exc-sub i {
            font-size: 10px;
        }

        .inc-exc-sub.green {
            color: var(--green);
        }

        .inc-exc-sub.red {
            color: var(--red);
        }

        /* ── Highlights ── */
        .highlights-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .highlight-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--blue-lt);
            color: var(--blue);
            border-radius: 50px;
            padding: 5px 14px;
            font-size: 12px;
            font-weight: 600;
        }

        .highlight-tag i {
            font-size: 10px;
        }

        /* ── Itinerary ── */
        .itinerary-list {
            list-style: none;
            padding: 0;
            margin: 0;
            position: relative;
        }

        .itinerary-list::before {
            content: '';
            position: absolute;
            left: 15px;
            top: 8px;
            bottom: 8px;
            width: 2px;
            background: var(--line);
        }

        .itin-item {
            display: flex;
            gap: 16px;
            align-items: flex-start;
            padding: 10px 0;
        }

        .itin-day {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--ink);
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
            position: relative;
            z-index: 1;
        }

        .itin-content {
            flex: 1;
            padding-top: 5px;
        }

        .itin-title {
            font-size: 13px;
            font-weight: 700;
            color: var(--ink);
            margin-bottom: 3px;
        }

        .itin-desc {
            font-size: 12px;
            color: var(--slate);
            line-height: 1.6;
        }

        /* ── Destinations ── */
        .dest-wrap {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .dest-tag {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--line-2);
            color: var(--ink-2);
            border-radius: 50px;
            padding: 5px 14px;
            font-size: 12px;
            font-weight: 600;
        }

        /* ── Side price card ── */
        .side-price-card {
            background: linear-gradient(135deg, var(--ink) 0%, var(--ink-2) 100%);
            border-radius: var(--r);
            padding: 24px;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
        }

        .side-price-card::before {
            content: '';
            position: absolute;
            top: -30px;
            right: -30px;
            width: 120px;
            height: 120px;
            background: rgba(255, 255, 255, .04);
            border-radius: 50%;
        }

        .side-price-card::after {
            content: '';
            position: absolute;
            bottom: -20px;
            left: -20px;
            width: 80px;
            height: 80px;
            background: rgba(212, 148, 10, .08);
            border-radius: 50%;
        }

        .spc-label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 1.2px;
            color: rgba(255, 255, 255, .4);
            margin-bottom: 5px;
        }

        .spc-price {
            font-size: 32px;
            font-weight: 800;
            color: #fbbf24;
            line-height: 1;
            margin-bottom: 4px;
        }

        .spc-price small {
            font-size: 14px;
            color: rgba(255, 255, 255, .35);
            font-weight: 400;
            margin-right: 3px;
        }

        .spc-original {
            font-size: 13px;
            color: rgba(255, 255, 255, .25);
            text-decoration: line-through;
            display: block;
            margin-bottom: 4px;
        }

        .spc-save {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            background: rgba(74, 222, 128, .15);
            color: #4ade80;
            border-radius: 50px;
            padding: 3px 10px;
            font-size: 11px;
            font-weight: 700;
        }

        .spc-divider {
            border: none;
            border-top: 1px solid rgba(255, 255, 255, .08);
            margin: 16px 0;
        }

        .spc-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 12px;
            margin-bottom: 9px;
        }

        .spc-row:last-child {
            margin-bottom: 0;
        }

        .spc-row .sr-label {
            color: rgba(255, 255, 255, .35);
        }

        .spc-row .sr-value {
            color: rgba(255, 255, 255, .75);
            font-weight: 600;
        }

        .spc-row .sr-value.green {
            color: #4ade80;
        }

        /* ── Quick actions ── */
        .quick-actions {
            background: var(--surface);
            border-radius: var(--r);
            box-shadow: var(--sh-md);
            overflow: hidden;
            margin-bottom: 20px;
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
        }

        .qa-btn:hover {
            background: var(--surface-2);
            color: var(--ink);
        }

        .qa-btn.qa-edit .qa-icon {
            background: var(--blue-lt);
            color: var(--blue);
        }

        .qa-btn.qa-view .qa-icon {
            background: var(--green-lt);
            color: var(--green);
        }

        .qa-btn.qa-toggle .qa-icon {
            background: var(--amber-lt);
            color: var(--amber);
        }

        .qa-btn.qa-del .qa-icon {
            background: var(--red-lt);
            color: var(--red);
        }

        /* ── Stats row ── */
        .stats-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
            margin-bottom: 20px;
        }

        .stat-card {
            background: var(--surface);
            border-radius: var(--r);
            padding: 16px;
            box-shadow: var(--sh);
            text-align: center;
        }

        .stat-number {
            font-size: 22px;
            font-weight: 800;
            color: var(--ink);
            line-height: 1;
            margin-bottom: 4px;
        }

        .stat-label {
            font-size: 10px;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .7px;
            color: var(--slate-lt);
        }

        @media (max-width: 576px) {
            .pkg-card-body {
                padding: 16px;
            }

            .pkg-card-head {
                padding: 14px 16px;
            }

            .info-label {
                width: 42%;
                font-size: 10px;
            }

            .side-price-card {
                padding: 18px;
            }

            .spc-price {
                font-size: 26px;
            }

            .stats-row {
                grid-template-columns: 1fr 1fr;
            }
        }
    </style>
@endpush

@section('content')

    @php
        $effectivePrice = $package->price_usd_discounted ?? $package->price_usd;
        $hasDiscount = $package->price_usd_discounted && $package->price_usd_discounted < $package->price_usd;
        $discountPct = $package->discount_percentage;
        $totalBookings = $package->bookings()->count();
        $paidBookings = $package->bookings()->where('payment_status', 'paid')->count();
        $totalRevenue = $package->bookings()->where('payment_status', 'paid')->sum('total_price');

        $featuredImgUrl = $package->featured_image
            ? (Str::startsWith($package->featured_image, 'http')
                ? $package->featured_image
                : asset('storage/' . $package->featured_image))
            : null;
    @endphp

    <div class="pkg-page">

        {{-- Top bar --}}
        <div class="pkg-topbar">
            <div class="pkg-topbar-left">
                <h1>
                    <i class="fas fa-box-open"></i>
                    {{ $package->name }}
                </h1>
                <div class="pkg-meta-chips">
                    <span class="chip chip-blue">
                        <i class="fas fa-tag"></i> {{ $package->type_label }}
                    </span>
                    @if ($package->is_active)
                        <span class="chip chip-green"><i class="fas fa-circle"></i> Active</span>
                    @else
                        <span class="chip chip-red"><i class="fas fa-circle"></i> Inactive</span>
                    @endif
                    @if ($package->is_featured)
                        <span class="chip chip-gold"><i class="fas fa-star"></i> Featured</span>
                    @endif
                </div>
            </div>
            <div class="pkg-topbar-right">
                <a href="{{ route('admin.packages.index') }}" class="btn-back">
                    <i class="fas fa-arrow-left"></i> All Packages
                </a>
                <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn-edit">
                    <i class="fas fa-pen"></i> Edit
                </a>
            </div>
        </div>

        {{-- Stats row --}}
        <div class="stats-row">
            <div class="stat-card">
                <div class="stat-number">{{ $totalBookings }}</div>
                <div class="stat-label">Total Bookings</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" style="color:var(--green);">{{ $paidBookings }}</div>
                <div class="stat-label">Paid Bookings</div>
            </div>
            <div class="stat-card">
                <div class="stat-number" style="color:var(--blue);font-size:18px;">${{ number_format($totalRevenue, 0) }}
                </div>
                <div class="stat-label">Revenue</div>
            </div>
        </div>

        {{-- Hero image --}}
        @if ($featuredImgUrl)
            <div class="pkg-hero">
                <img src="{{ $featuredImgUrl }}" alt="{{ $package->name }}">
                <div class="pkg-hero-overlay"></div>
                <div class="pkg-hero-bottom">
                    <div class="pkg-hero-title">{{ $package->name }}</div>
                    <div class="pkg-hero-price">
                        <span class="from">From</span>
                        <div class="amount">
                            ${{ number_format($effectivePrice, 0) }}<small>/ person</small>
                        </div>
                        @if ($hasDiscount)
                            <span class="original">${{ number_format($package->price_usd, 0) }}</span>
                        @endif
                    </div>
                </div>
            </div>
        @endif

        {{-- Gallery strip --}}
        @if ($package->gallery_images && count($package->gallery_images) > 0)
            <div class="gallery-strip">
                @foreach ($package->gallery_images as $img)
                    @php
                        $gUrl = Str::startsWith($img, 'http') ? $img : asset('storage/' . $img);
                    @endphp
                    <div class="gallery-thumb">
                        <img src="{{ $gUrl }}" alt="Gallery image">
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Main grid --}}
        <div class="pkg-grid">

            {{-- LEFT column --}}
            <div>

                {{-- Overview --}}
                <div class="pkg-card">
                    <div class="pkg-card-head">
                        <div class="head-icon icon-blue"><i class="fas fa-info-circle"></i></div>
                        <h2>Package Overview</h2>
                    </div>
                    <div class="pkg-card-body">
                        <div class="info-row">
                            <span class="info-label">Type</span>
                            <span class="info-value">{{ $package->type_label }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Duration</span>
                            <span class="info-value">{{ $package->duration_days }} Days /
                                {{ $package->duration_days - 1 }} Nights</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Group Size</span>
                            <span class="info-value">
                                @if ($package->group_size_max)
                                    Up to {{ $package->group_size_max }} people
                                @else
                                    <span style="color:var(--slate-lt);">Not set</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Best Season</span>
                            <span class="info-value">
                                @if ($package->best_season)
                                    {{ $package->best_season }}
                                @else
                                    <span style="color:var(--slate-lt);">Not set</span>
                                @endif
                            </span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Slug</span>
                            <span class="info-value mono">{{ $package->slug }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Sort Order</span>
                            <span class="info-value">{{ $package->sort_order ?? '—' }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Created</span>
                            <span class="info-value">{{ $package->created_at->format('d M Y') }}</span>
                        </div>
                        <div class="info-row">
                            <span class="info-label">Last Updated</span>
                            <span class="info-value">{{ $package->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>

                {{-- Short description --}}
                @if ($package->short_description)
                    <div class="pkg-card">
                        <div class="pkg-card-head">
                            <div class="head-icon icon-slate"><i class="fas fa-align-left"></i></div>
                            <h2>Short Description</h2>
                        </div>
                        <div class="pkg-card-body">
                            <p class="desc-text">{{ $package->short_description }}</p>
                        </div>
                    </div>
                @endif

                {{-- Full description --}}
                @if ($package->description)
                    <div class="pkg-card">
                        <div class="pkg-card-head">
                            <div class="head-icon icon-slate"><i class="fas fa-file-alt"></i></div>
                            <h2>Full Description</h2>
                        </div>
                        <div class="pkg-card-body">
                            <div class="desc-text" style="line-height:1.8;">{!! nl2br(e($package->description)) !!}</div>
                        </div>
                    </div>
                @endif

                {{-- Highlights --}}
                @if ($package->highlights && count($package->highlights) > 0)
                    <div class="pkg-card">
                        <div class="pkg-card-head">
                            <div class="head-icon icon-gold"><i class="fas fa-star"></i></div>
                            <h2>Highlights</h2>
                            <span class="head-count">{{ count($package->highlights) }}</span>
                        </div>
                        <div class="pkg-card-body">
                            <div class="highlights-wrap">
                                @foreach ($package->highlights as $h)
                                    <span class="highlight-tag">
                                        <i class="fas fa-check-circle"></i> {{ $h }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Destinations covered --}}
                @if ($package->destinations_covered && count($package->destinations_covered) > 0)
                    <div class="pkg-card">
                        <div class="pkg-card-head">
                            <div class="head-icon icon-blue"><i class="fas fa-map-marker-alt"></i></div>
                            <h2>Destinations Covered</h2>
                            <span class="head-count">{{ count($package->destinations_covered) }}</span>
                        </div>
                        <div class="pkg-card-body">
                            <div class="dest-wrap">
                                @foreach ($package->destinations_covered as $dest)
                                    <span class="dest-tag">
                                        <i class="fas fa-location-dot" style="font-size:10px;color:var(--red);"></i>
                                        {{ $dest }}
                                    </span>
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Included / Excluded --}}
                @if (($package->included && count($package->included) > 0) || ($package->excluded && count($package->excluded) > 0))
                    <div class="pkg-card">
                        <div class="pkg-card-head">
                            <div class="head-icon icon-green"><i class="fas fa-list-check"></i></div>
                            <h2>Included & Excluded</h2>
                        </div>
                        <div class="pkg-card-body">
                            <div class="inc-exc-grid">
                                @if ($package->included && count($package->included) > 0)
                                    <div>
                                        <div class="inc-exc-sub green"><i class="fas fa-check-circle"></i> Included</div>
                                        <ul class="inc-list">
                                            @foreach ($package->included as $inc)
                                                <li>
                                                    <span class="ic"><i class="fas fa-check"></i></span>
                                                    {{ $inc }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                @if ($package->excluded && count($package->excluded) > 0)
                                    <div>
                                        <div class="inc-exc-sub red"><i class="fas fa-times-circle"></i> Excluded</div>
                                        <ul class="exc-list">
                                            @foreach ($package->excluded as $exc)
                                                <li>
                                                    <span class="ic"><i class="fas fa-times"></i></span>
                                                    {{ $exc }}
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endif

                {{-- Itinerary --}}
                @if ($package->itinerary && count($package->itinerary) > 0)
                    <div class="pkg-card">
                        <div class="pkg-card-head">
                            <div class="head-icon icon-blue"><i class="fas fa-route"></i></div>
                            <h2>Itinerary</h2>
                            <span class="head-count">{{ count($package->itinerary) }} Days</span>
                        </div>
                        <div class="pkg-card-body">
                            <ul class="itinerary-list">
                                @foreach ($package->itinerary as $index => $day)
                                    <li class="itin-item">
                                        <div class="itin-day">{{ $index + 1 }}</div>
                                        <div class="itin-content">
                                            <div class="itin-title">
                                                @if (is_array($day))
                                                    {{ $day['title'] ?? ($day['day'] ?? 'Day ' . ($index + 1)) }}
                                                @else
                                                    {{ $day }}
                                                @endif
                                            </div>
                                            @if (is_array($day) && !empty($day['description']))
                                                <div class="itin-desc">{{ $day['description'] }}</div>
                                            @endif
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

            </div>

            {{-- RIGHT column --}}
            <div>

                {{-- Price card --}}
                <div class="side-price-card">
                    <div class="spc-label">Price Per Person</div>
                    <div class="spc-price">
                        <small>USD</small>{{ number_format($effectivePrice, 0) }}
                    </div>
                    @if ($hasDiscount)
                        <span class="spc-original">USD {{ number_format($package->price_usd, 0) }}</span>
                        <span class="spc-save"><i class="fas fa-tag" style="font-size:9px;"></i> Save
                            {{ $discountPct }}%</span>
                    @endif
                    <hr class="spc-divider">
                    <div class="spc-row">
                        <span class="sr-label">Duration</span>
                        <span class="sr-value">{{ $package->duration_days }} Days</span>
                    </div>
                    @if ($package->group_size_max)
                        <div class="spc-row">
                            <span class="sr-label">Max Group</span>
                            <span class="sr-value">{{ $package->group_size_max }} pax</span>
                        </div>
                    @endif
                    <div class="spc-row">
                        <span class="sr-label">Status</span>
                        <span class="sr-value {{ $package->is_active ? 'green' : '' }}">
                            {{ $package->is_active ? 'Active' : 'Inactive' }}
                        </span>
                    </div>
                    <div class="spc-row">
                        <span class="sr-label">Total Bookings</span>
                        <span class="sr-value">{{ $totalBookings }}</span>
                    </div>
                    <div class="spc-row">
                        <span class="sr-label">Revenue</span>
                        <span class="sr-value gold" style="color:#fbbf24;">${{ number_format($totalRevenue, 0) }}</span>
                    </div>
                </div>

                {{-- Quick actions --}}
                <div class="quick-actions">
                    <div class="qa-head">Quick Actions</div>
                    <div class="qa-body">
                        <a href="{{ route('admin.packages.edit', $package->id) }}" class="qa-btn qa-edit">
                            <span class="qa-icon"><i class="fas fa-pen"></i></span>
                            Edit Package
                        </a>

                        <a href="{{ route('packages.show', $package->slug) }}" target="_blank" class="qa-btn qa-view">
                            <span class="qa-icon"><i class="fas fa-external-link-alt"></i></span>
                            View on Frontend
                        </a>

                        <form method="POST" action="{{ route('admin.packages.destroy', $package->id) }}"
                            onsubmit="return confirm('Delete this package? This cannot be undone.')" style="margin:0;">
                            @csrf @method('DELETE')
                            <button type="submit" class="qa-btn qa-del">
                                <span class="qa-icon"><i class="fas fa-trash"></i></span>
                                Delete Package
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Bookings mini list --}}
                @if ($totalBookings > 0)
                    <div class="pkg-card">
                        <div class="pkg-card-head">
                            <div class="head-icon icon-green"><i class="fas fa-receipt"></i></div>
                            <h2>Recent Bookings</h2>
                            <span class="head-count">{{ $totalBookings }}</span>
                        </div>
                        <div class="pkg-card-body" style="padding:12px;">
                            @foreach ($package->bookings()->latest()->take(5)->get() as $bk)
                                <a href="{{ route('admin.bookings.show', $bk->id) }}"
                                    style="display:flex;align-items:center;justify-content:space-between;padding:10px 12px;border-radius:var(--r-sm);text-decoration:none;transition:background var(--ease);"
                                    onmouseover="this.style.background='var(--surface-2)'"
                                    onmouseout="this.style.background='transparent'">
                                    <div>
                                        <div style="font-size:12px;font-weight:700;color:var(--ink);">
                                            {{ $bk->first_name }} {{ $bk->last_name }}</div>
                                        <div
                                            style="font-family:'JetBrains Mono',monospace;font-size:10px;color:var(--blue);">
                                            {{ $bk->booking_ref }}</div>
                                    </div>
                                    <div style="text-align:right;">
                                        <div style="font-size:12px;font-weight:700;color:var(--ink);">
                                            ${{ number_format($bk->total_price, 0) }}</div>
                                        <span
                                            class="chip chip-{{ $bk->payment_status === 'paid' ? 'green' : ($bk->payment_status === 'partial' ? 'blue' : 'amber') }}"
                                            style="font-size:9px;padding:2px 8px;">
                                            {{ ucfirst($bk->payment_status) }}
                                        </span>
                                    </div>
                                </a>
                            @endforeach
                            @if ($totalBookings > 5)
                                <a href="{{ route('admin.bookings.index') }}?package={{ $package->id }}"
                                    style="display:block;text-align:center;padding:10px;font-size:12px;color:var(--blue);font-weight:600;text-decoration:none;border-top:1px solid var(--line-2);margin-top:4px;">
                                    View all {{ $totalBookings }} bookings →
                                </a>
                            @endif
                        </div>
                    </div>
                @endif

            </div>

        </div>

    </div>

@endsection
