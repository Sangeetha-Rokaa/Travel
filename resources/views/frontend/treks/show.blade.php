@extends('layouts.frontend')

@section('title', $trek->name . ' – Visit Nepal')

@section('content')

    <div class="trek-detail">
        {{-- HERO SECTION --}}
        <section class="trek-hero">
            <div class="trek-hero__image">
                <img src="{{ asset('storage/' . $trek->featured_image) }}" alt="{{ $trek->name }}">
                <div class="trek-hero__overlay"></div>
            </div>

            <div class="container">
                <div class="trek-hero__content">
                    <div class="trek-hero__meta">
                        <span class="badge badge--difficulty">
                            <i class="fas fa-signal"></i> {{ ucfirst($trek->difficulty ?? 'Moderate') }}
                        </span>
                        @if ($trek->is_featured ?? false)
                            <span class="badge badge--featured">
                                <i class="fas fa-star"></i> Featured
                            </span>
                        @endif
                    </div>

                    <h1 class="trek-hero__title">{{ $trek->name }}</h1>

                    <div class="trek-hero__info">
                        <div class="info-item">
                            <i class="fas fa-calendar-alt"></i>
                            <span>{{ $trek->duration_days }} Days</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-mountain"></i>
                            <span>{{ $trek->max_altitude ?? 'N/A' }}m</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-leaf"></i>
                            <span>{{ $trek->best_season ?? 'All Season' }}</span>
                        </div>
                        <div class="info-item">
                            <i class="fas fa-users"></i>
                            <span>Max {{ $trek->group_size_max ?? 12 }} People</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- MAIN CONTENT --}}
        <section class="trek-content">
            <div class="container">
                <div class="trek-grid">
                    {{-- LEFT COLUMN --}}
                    <div class="trek-main">
                        {{-- Description --}}
                        <div class="card">
                            <h2 class="card__title">
                                <i class="fas fa-info-circle"></i> About This Trek
                            </h2>
                            <div class="card__content">
                                <p>{{ $trek->description }}</p>
                            </div>
                        </div>

                        {{-- Highlights --}}
                        @php
                            $highlights = is_array($trek->highlights)
                                ? $trek->highlights
                                : json_decode($trek->highlights, true) ?? [];
                        @endphp

                        @if (count($highlights))
                            <div class="card">
                                <h2 class="card__title">
                                    <i class="fas fa-star"></i> Highlights
                                </h2>
                                <ul class="list list--highlights">
                                    @foreach ($highlights as $highlight)
                                        <li>{{ $highlight }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Itinerary --}}
                        @php
                            $itineraryRaw = $trek->itinerary;

                            // Try JSON first
                            $itinerary = json_decode($itineraryRaw, true);

                            // If not JSON, treat as plain text lines
                            if (!is_array($itinerary)) {
                                $itinerary = array_filter(explode("\n", $itineraryRaw));
                            }
                        @endphp

                        @if (!empty($itinerary))
                            <div class="card">
                                <h2 class="card__title">
                                    <i class="fas fa-clock"></i> Itinerary
                                </h2>

                                <div class="itinerary">
                                    {!! $trek->itinerary !!}
                                </div>
                            </div>
                        @endif
                    </div>

                    {{-- RIGHT SIDEBAR --}}
                    <div class="trek-sidebar">
                        <div class="booking-card">
                            <div class="booking-card__price">
                                @if ($trek->price_usd_discounted ?? false)
                                    <span class="price-old">${{ number_format($trek->price_usd, 0) }}</span>
                                    <span class="price-save">
                                        Save
                                        {{ round((($trek->price_usd - $trek->price_usd_discounted) / $trek->price_usd) * 100) }}%
                                    </span>
                                    <div class="price-current">${{ number_format($trek->price_usd_discounted, 0) }}
                                    </div>
                                @else
                                    <div class="price-current">${{ number_format($trek->price_usd ?? 0, 0) }}</div>
                                @endif
                                <div class="price-note">per person</div>
                            </div>

                            <div class="booking-card__info">
                                <div class="info-row">
                                    <span><i class="fas fa-clock"></i> Duration</span>
                                    <strong>{{ $trek->duration_days }} Days</strong>
                                </div>
                                <div class="info-row">
                                    <span><i class="fas fa-mountain"></i> Max Altitude</span>
                                    <strong>{{ $trek->max_altitude ?? 'N/A' }}m</strong>
                                </div>
                                <div class="info-row">
                                    <span><i class="fas fa-users"></i> Group Size</span>
                                    <strong>2 - {{ $trek->group_size_max ?? 12 }}</strong>
                                </div>
                                <div class="info-row">
                                    <span><i class="fas fa-calendar"></i> Best Season</span>
                                    <strong>{{ $trek->best_season ?? 'All Year' }}</strong>
                                </div>
                            </div>

                            <a href="{{ route('bookings.create', ['trek' => $trek->slug]) }}"
                                class="btn btn--primary btn--block">
                                <i class="fas fa-check-circle"></i> Book This Trek
                            </a>
                            <a href="{{ route('contact.index') }}" class="btn btn--outline btn--block">
                                <i class="fas fa-envelope"></i> Ask a Question
                            </a>

                            <div class="booking-card__actions">
                                <button class="action-btn" onclick="shareTrek()">
                                    <i class="fas fa-share-alt"></i> Share
                                </button>
                                <button class="action-btn" onclick="saveTrek()">
                                    <i class="fas fa-bookmark"></i> Save
                                </button>
                            </div>
                        </div>

                        {{-- What's Included --}}
                        @php
                            $included = is_array($trek->included)
                                ? $trek->included
                                : json_decode($trek->included, true) ?? [];
                        @endphp

                        @if (count($included))
                            <div class="info-card">
                                <h3 class="info-card__title">
                                    <i class="fas fa-check-circle"></i> What's Included
                                </h3>
                                <ul class="list list--check">
                                    @foreach ($included as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- What's Excluded --}}
                        @php
                            $excluded = is_array($trek->excluded)
                                ? $trek->excluded
                                : json_decode($trek->excluded, true) ?? [];
                        @endphp

                        @if (count($excluded))
                            <div class="info-card">
                                <h3 class="info-card__title">
                                    <i class="fas fa-times-circle"></i> What's Excluded
                                </h3>
                                <ul class="list list--cross">
                                    @foreach ($excluded as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Need Help --}}
                        <div class="help-card">
                            <i class="fas fa-headset"></i>
                            <h4>Need Help?</h4>
                            <p>Our travel experts are here to assist you</p>
                            <a href="tel:+977XXXXXXXXX" class="help-link">
                                <i class="fas fa-phone"></i> +977 XXXXXXXXX
                            </a>
                            <a href="mailto:info@visitnepal.com" class="help-link">
                                <i class="fas fa-envelope"></i> info@visitnepal.com
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </div>

    <style>
        /* ========================================
                                   VARIABLES & RESET
                                ======================================== */
        .trek-detail {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            background: #f5f7fa;
            color: #1a2a3a;
        }

        /* ========================================
                                   HERO SECTION
                                ======================================== */
        .trek-hero {
            position: relative;
            height: 500px;
            overflow: hidden;
        }

        .trek-hero__image {
            position: absolute;
            inset: 0;
        }

        .trek-hero__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .trek-hero__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.7));
        }

        .trek-hero__content {
            position: relative;
            height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding-bottom: 60px;
            color: white;
            z-index: 2;
        }

        .trek-hero__meta {
            display: flex;
            gap: 12px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 13px;
            font-weight: 600;
            backdrop-filter: blur(10px);
        }

        .badge--difficulty {
            background: rgba(245, 158, 11, 0.2);
            color: #fbbf24;
            border: 1px solid rgba(245, 158, 11, 0.3);
        }

        .badge--featured {
            background: rgba(34, 197, 94, 0.2);
            color: #4ade80;
            border: 1px solid rgba(34, 197, 94, 0.3);
        }

        .trek-hero__title {
            font-size: 48px;
            font-weight: 800;
            margin-bottom: 20px;
            line-height: 1.2;
            max-width: 800px;
        }

        .trek-hero__info {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .info-item {
            display: flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            padding: 8px 16px;
            border-radius: 30px;
            backdrop-filter: blur(10px);
            font-size: 14px;
        }

        .info-item i {
            color: #f59e0b;
        }

        /* ========================================
                                   CONTAINER & GRID
                                ======================================== */
        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 20px;
        }

        .trek-content {
            margin-top: -40px;
            position: relative;
            z-index: 3;
            padding-bottom: 60px;
        }

        .trek-grid {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 32px;
        }

        /* ========================================
                                   CARDS
                                ======================================== */
        .card {
            background: white;
            border-radius: 20px;
            padding: 28px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            transition: box-shadow 0.2s;
        }

        .card:hover {
            box-shadow: 0 4px 16px rgba(0, 0, 0, 0.08);
        }

        .card__title {
            font-size: 22px;
            font-weight: 700;
            margin-bottom: 20px;
            color: #1a2a3a;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .card__title i {
            color: #f59e0b;
            font-size: 20px;
        }

        .card__content p {
            line-height: 1.7;
            color: #4a5568;
            font-size: 15px;
        }

        /* ========================================
                                   LISTS
                                ======================================== */
        .list {
            list-style: none;
            padding: 0;
        }

        .list li {
            padding-left: 28px;
            position: relative;
            margin-bottom: 12px;
            line-height: 1.6;
            color: #4a5568;
            font-size: 14px;
        }

        .list--highlights li::before {
            content: "✨";
            position: absolute;
            left: 0;
        }

        .list--check li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #10b981;
            font-weight: 700;
        }

        .list--cross li::before {
            content: "✗";
            position: absolute;
            left: 0;
            color: #ef4444;
            font-weight: 700;
        }

        /* ========================================
                                   ITINERARY
                                ======================================== */
        .itinerary__item {
            padding: 20px 0;
            border-bottom: 1px solid #e5e7eb;
            display: flex;
            gap: 16px;
        }

        .itinerary__item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .itinerary__item:first-child {
            padding-top: 0;
        }

        .itinerary__day {
            min-width: 80px;
            font-weight: 700;
            color: #f59e0b;
            font-size: 15px;
        }

        .itinerary__content {
            color: #4a5568;
            line-height: 1.6;
            font-size: 14px;
            flex: 1;
        }

        /* ========================================
                                   SIDEBAR
                                ======================================== */
        .trek-sidebar {
            position: sticky;
            top: 24px;
            align-self: start;
        }

        .booking-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
        }

        .booking-card__price {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e7eb;
            margin-bottom: 20px;
        }

        .price-old {
            font-size: 18px;
            color: #9ca3af;
            text-decoration: line-through;
            display: inline-block;
            margin-right: 10px;
        }

        .price-save {
            background: #10b981;
            color: white;
            padding: 2px 10px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: 600;
        }

        .price-current {
            font-size: 42px;
            font-weight: 800;
            color: #f59e0b;
            margin-top: 10px;
        }

        .price-note {
            font-size: 13px;
            color: #9ca3af;
            margin-top: 5px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row span {
            color: #6b7280;
            display: flex;
            align-items: center;
            gap: 6px;
        }

        .info-row span i {
            color: #f59e0b;
            font-size: 12px;
        }

        .info-row strong {
            color: #1a2a3a;
            font-weight: 600;
        }

        /* ========================================
                                   BUTTONS
                                ======================================== */
        .btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 12px 20px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
            margin-top: 12px;
        }

        .btn--primary {
            background: #f59e0b;
            color: white;
        }

        .btn--primary:hover {
            background: #d97706;
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(245, 158, 11, 0.3);
        }

        .btn--outline {
            background: transparent;
            color: #f59e0b;
            border: 2px solid #f59e0b;
        }

        .btn--outline:hover {
            background: #f59e0b;
            color: white;
        }

        .btn--block {
            width: 100%;
        }

        .booking-card__actions {
            display: flex;
            gap: 16px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .action-btn {
            flex: 1;
            background: #f3f4f6;
            border: none;
            padding: 8px;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 500;
            color: #4b5563;
            cursor: pointer;
            transition: all 0.2s;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
        }

        .action-btn:hover {
            background: #e5e7eb;
            color: #f59e0b;
        }

        /* ========================================
                                   INFO CARDS
                                ======================================== */
        .info-card {
            background: white;
            border-radius: 20px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
        }

        .info-card__title {
            font-size: 18px;
            font-weight: 700;
            margin-bottom: 16px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .info-card__title i {
            font-size: 18px;
        }

        .help-card {
            background: linear-gradient(135deg, #1e3a5f 0%, #2c4a7a 100%);
            color: white;
            border-radius: 20px;
            padding: 28px;
            text-align: center;
        }

        .help-card i {
            font-size: 48px;
            color: #f59e0b;
            margin-bottom: 16px;
        }

        .help-card h4 {
            font-size: 20px;
            margin-bottom: 8px;
        }

        .help-card p {
            font-size: 14px;
            opacity: 0.9;
            margin-bottom: 20px;
        }

        .help-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            color: white;
            text-decoration: none;
            padding: 10px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            margin-top: 10px;
            transition: all 0.2s;
            font-size: 14px;
        }

        .help-link:hover {
            background: rgba(255, 255, 255, 0.2);
            color: #f59e0b;
        }

        /* ========================================
                                   RESPONSIVE DESIGN
                                ======================================== */
        @media (max-width: 1024px) {
            .trek-grid {
                grid-template-columns: 1fr 320px;
                gap: 24px;
            }
        }

        @media (max-width: 900px) {
            .trek-grid {
                grid-template-columns: 1fr;
            }

            .trek-sidebar {
                position: static;
            }

            .trek-hero {
                height: 400px;
            }

            .trek-hero__content {
                height: 400px;
                padding-bottom: 40px;
            }

            .trek-hero__title {
                font-size: 32px;
            }
        }

        @media (max-width: 768px) {
            .trek-hero {
                height: 350px;
            }

            .trek-hero__content {
                height: 350px;
            }

            .trek-hero__title {
                font-size: 28px;
            }

            .trek-hero__info {
                gap: 12px;
            }

            .info-item {
                font-size: 12px;
                padding: 6px 12px;
            }

            .card {
                padding: 20px;
            }

            .card__title {
                font-size: 20px;
            }

            .itinerary__item {
                flex-direction: column;
                gap: 8px;
            }

            .itinerary__day {
                min-width: auto;
            }

            .price-current {
                font-size: 36px;
            }

            .booking-card__actions {
                flex-direction: column;
            }
        }

        @media (max-width: 480px) {
            .container {
                padding: 0 16px;
            }

            .trek-hero {
                height: 300px;
            }

            .trek-hero__title {
                font-size: 24px;
            }

            .info-item {
                font-size: 11px;
            }

            .card {
                padding: 16px;
                border-radius: 16px;
            }

            .booking-card {
                padding: 20px;
            }

            .price-current {
                font-size: 32px;
            }

            .btn {
                padding: 10px 16px;
                font-size: 14px;
            }
        }

        /* ========================================
                                   UTILITIES
                                ======================================== */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card,
        .booking-card,
        .info-card,
        .help-card {
            animation: fadeInUp 0.4s ease-out;
        }
    </style>

    <script>
        function shareTrek() {
            if (navigator.share) {
                navigator.share({
                    title: '{{ $trek->name }}',
                    text: 'Check out this amazing trek in Nepal!',
                    url: window.location.href
                }).catch(() => {});
            } else {
                alert('Copy the URL to share this trek');
            }
        }

        function saveTrek() {
            let saved = localStorage.getItem('savedTreks') || '[]';
            saved = JSON.parse(saved);

            if (!saved.includes('{{ $trek->id }}')) {
                saved.push('{{ $trek->id }}');
                localStorage.setItem('savedTreks', JSON.stringify(saved));
                alert('Trek saved to your wishlist!');
            } else {
                alert('This trek is already in your wishlist');
            }
        }
    </script>

@endsection
