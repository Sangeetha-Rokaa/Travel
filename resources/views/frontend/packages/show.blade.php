@extends('layouts.frontend')

@section('title', $package->name . ' - ' . config('app.name'))

@section('content')

    <section class="package-detail">
        {{-- HERO SECTION --}}
        <div class="detail-hero">
            <div class="detail-hero__image">
                <img src="{{ asset('storage/' . $package->featured_image) }}" alt="{{ $package->name }}">
                <div class="detail-hero__overlay"></div>
            </div>

            <div class="container">
                <div class="detail-hero__content">
                    <div class="detail-hero__meta">
                        <span class="badge badge--primary">{{ ucfirst($package->type) }}</span>
                        @if ($package->is_featured)
                            <span class="badge badge--featured">Featured</span>
                        @endif
                        <span class="detail-hero__duration">{{ $package->duration_days }} days</span>
                    </div>
                    <h1 class="detail-hero__title">{{ $package->name }}</h1>
                    <p class="detail-hero__desc">{{ $package->short_description }}</p>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="detail-grid">
                {{-- MAIN CONTENT --}}
                <div class="detail-main">
                    {{-- Description --}}
                    <div class="card">
                        <h2 class="card__title">Overview</h2>
                        <div class="card__content">
                            {!! nl2br(e($package->description)) !!}
                        </div>
                    </div>

                    {{-- Destinations --}}
                    @if (is_array($package->destinations_covered) && count($package->destinations_covered))
                        <div class="card">
                            <h2 class="card__title">Destinations</h2>
                            <div class="tags">
                                @foreach ($package->destinations_covered as $destination)
                                    <span class="tag">{{ $destination }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Highlights --}}
                    @if (is_array($package->highlights) && count($package->highlights))
                        <div class="card">
                            <h2 class="card__title">Highlights</h2>
                            <ul class="list list--check">
                                @foreach ($package->highlights as $highlight)
                                    <li>{{ $highlight }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    {{-- Itinerary --}}
                    @if (is_array($package->itinerary) && count($package->itinerary))
                        <div class="card">
                            <h2 class="card__title">Itinerary</h2>
                            <div class="itinerary">
                                @foreach ($package->itinerary as $day)
                                    <div class="itinerary__item">
                                        <div class="itinerary__day">Day {{ $loop->iteration }}</div>
                                        <div class="itinerary__desc">{{ $day }}</div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    {{-- Included & Excluded --}}
                    <div class="card-grid">
                        @if (is_array($package->included) && count($package->included))
                            <div class="card">
                                <h2 class="card__title">Included</h2>
                                <ul class="list list--included">
                                    @foreach ($package->included as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @if (is_array($package->excluded) && count($package->excluded))
                            <div class="card">
                                <h2 class="card__title">Excluded</h2>
                                <ul class="list list--excluded">
                                    @foreach ($package->excluded as $item)
                                        <li>{{ $item }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>

                    {{-- Gallery --}}
                    @if (is_array($package->gallery_images) && count($package->gallery_images))
                        <div class="card">
                            <h2 class="card__title">Gallery</h2>
                            <div class="gallery">
                                @foreach ($package->gallery_images as $image)
                                    <div class="gallery__item">
                                        <img src="{{ asset('storage/' . $image) }}" alt="{{ $package->name }}">
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>

                {{-- SIDEBAR --}}
                <div class="detail-sidebar">
                    <div class="booking-card">
                        <div class="booking-card__price">
                            @if ($package->price_usd_discounted)
                                <span class="price-old">${{ number_format($package->price_usd, 0) }}</span>
                                <span class="price-save">Save
                                    {{ round((($package->price_usd - $package->price_usd_discounted) / $package->price_usd) * 100) }}%</span>
                                <div class="price-current">${{ number_format($package->price_usd_discounted, 0) }}</div>
                            @else
                                <div class="price-current">${{ number_format($package->price_usd, 0) }}</div>
                            @endif
                            <div class="price-note">per person</div>
                        </div>

                        <div class="booking-card__info">
                            <div class="info-row">
                                <span>Duration</span>
                                <strong>{{ $package->duration_days }} days</strong>
                            </div>
                            <div class="info-row">
                                <span>Best Season</span>
                                <strong>{{ $package->best_season ?? 'All Year' }}</strong>
                            </div>
                            <div class="info-row">
                                <span>Group Size</span>
                                <strong>Max {{ $package->group_size_max }}</strong>
                            </div>
                        </div>

                        <button class="btn btn--primary btn--block">Book Now</button>

                        <div class="booking-card__actions">
                            <a href="#" class="text-link">Request Customization</a>
                            <a href="#" class="text-link">Share</a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RELATED PACKAGES --}}
            @if (isset($relatedPackages) && $relatedPackages->count())
                <div class="related">
                    <div class="related__header">
                        <h2 class="related__title">You may also like</h2>
                    </div>
                    <div class="related-grid">
                        @foreach ($relatedPackages as $item)
                            <div class="package-card">
                                <div class="package-card__image">
                                    <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->name }}">
                                    @if ($item->price_usd_discounted)
                                        <span
                                            class="package-card__badge">-{{ round((($item->price_usd - $item->price_usd_discounted) / $item->price_usd) * 100) }}%</span>
                                    @endif
                                </div>
                                <div class="package-card__body">
                                    <div class="package-card__meta">
                                        <span class="package-card__type">{{ ucfirst($item->type) }}</span>
                                        <span class="package-card__duration">{{ $item->duration_days }} days</span>
                                    </div>
                                    <h3 class="package-card__title">{{ $item->name }}</h3>
                                    <p class="package-card__desc">{{ Str::limit($item->short_description, 70) }}</p>
                                    <div class="package-card__footer">
                                        <div class="package-card__price">
                                            @if ($item->price_usd_discounted)
                                                <span class="price-old">${{ number_format($item->price_usd, 0) }}</span>
                                                <span
                                                    class="price-current">${{ number_format($item->price_usd_discounted, 0) }}</span>
                                            @else
                                                <span
                                                    class="price-current">${{ number_format($item->price_usd, 0) }}</span>
                                            @endif
                                        </div>
                                        <a href="{{ route('packages.show', $item->slug) }}" class="btn btn--sm">View</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </section>

    <style>
        /* RESET & BASE */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 24px;
        }

        /* TYPOGRAPHY */
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
            line-height: 1.5;
            color: #1a1a1a;
            background: #f5f5f5;
        }

        /* BADGES */
        .badge {
            display: inline-flex;
            align-items: center;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 500;
            border-radius: 20px;
            letter-spacing: 0.3px;
        }

        .badge--primary {
            background: #e8f0fe;
            color: #1a56db;
        }

        .badge--featured {
            background: #fef3e8;
            color: #e67e22;
        }

        /* HERO SECTION */
        .detail-hero {
            position: relative;
            height: 380px;
            margin-bottom: 48px;
        }

        @media (max-width: 768px) {
            .detail-hero {
                height: 320px;
                margin-bottom: 32px;
            }
        }

        .detail-hero__image {
            position: absolute;
            inset: 0;
        }

        .detail-hero__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .detail-hero__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.2));
        }

        .detail-hero__content {
            position: relative;
            height: 380px;
            display: flex;
            flex-direction: column;
            justify-content: flex-end;
            padding-bottom: 40px;
            color: white;
            z-index: 2;
        }

        @media (max-width: 768px) {
            .detail-hero__content {
                height: 320px;
                padding-bottom: 24px;
            }
        }

        .detail-hero__meta {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 12px;
            flex-wrap: wrap;
        }

        .detail-hero__duration {
            font-size: 14px;
            opacity: 0.9;
        }

        .detail-hero__title {
            font-size: 42px;
            font-weight: 700;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        @media (max-width: 768px) {
            .detail-hero__title {
                font-size: 28px;
            }
        }

        .detail-hero__desc {
            font-size: 16px;
            opacity: 0.9;
            max-width: 600px;
            line-height: 1.5;
        }

        /* GRID LAYOUT */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 32px;
            margin-bottom: 64px;
        }

        @media (max-width: 992px) {
            .detail-grid {
                grid-template-columns: 1fr;
                gap: 32px;
            }
        }

        /* CARDS */
        .card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            margin-bottom: 24px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
        }

        .card:last-child {
            margin-bottom: 0;
        }

        .card__title {
            font-size: 20px;
            font-weight: 600;
            margin-bottom: 16px;
            color: #1a1a1a;
        }

        .card__content {
            color: #4a4a4a;
            line-height: 1.6;
            font-size: 15px;
        }

        .card__content p {
            margin-bottom: 12px;
        }

        .card__content p:last-child {
            margin-bottom: 0;
        }

        /* TAGS */
        .tags {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .tag {
            background: #f0f0f0;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            color: #4a4a4a;
        }

        /* LISTS */
        .list {
            list-style: none;
            padding: 0;
        }

        .list li {
            padding-left: 24px;
            position: relative;
            margin-bottom: 10px;
            font-size: 14px;
            color: #4a4a4a;
            line-height: 1.5;
        }

        .list li:last-child {
            margin-bottom: 0;
        }

        .list--check li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #10b981;
            font-weight: 600;
        }

        .list--included li::before {
            content: "✓";
            position: absolute;
            left: 0;
            color: #10b981;
            font-weight: 600;
        }

        .list--excluded li::before {
            content: "✗";
            position: absolute;
            left: 0;
            color: #ef4444;
            font-weight: 600;
        }

        /* CARD GRID */
        .card-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 24px;
            margin-bottom: 24px;
        }

        @media (max-width: 640px) {
            .card-grid {
                grid-template-columns: 1fr;
                gap: 24px;
            }
        }

        /* ITINERARY */
        .itinerary__item {
            padding: 16px 0;
            border-bottom: 1px solid #e5e5e5;
        }

        .itinerary__item:last-child {
            border-bottom: none;
            padding-bottom: 0;
        }

        .itinerary__item:first-child {
            padding-top: 0;
        }

        .itinerary__day {
            font-weight: 600;
            color: #1a56db;
            margin-bottom: 8px;
            font-size: 15px;
        }

        .itinerary__desc {
            color: #4a4a4a;
            font-size: 14px;
            line-height: 1.6;
        }

        /* GALLERY */
        .gallery {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(120px, 1fr));
            gap: 12px;
        }

        .gallery__item {
            aspect-ratio: 1;
            border-radius: 8px;
            overflow: hidden;
            cursor: pointer;
        }

        .gallery__item img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.2s;
        }

        .gallery__item:hover img {
            transform: scale(1.05);
        }

        /* BOOKING CARD */
        .booking-card {
            background: white;
            border-radius: 12px;
            padding: 24px;
            position: sticky;
            top: 24px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
        }

        .booking-card__price {
            text-align: center;
            padding-bottom: 20px;
            border-bottom: 1px solid #e5e5e5;
            margin-bottom: 20px;
        }

        .price-old {
            font-size: 16px;
            color: #999;
            text-decoration: line-through;
            display: inline-block;
            margin-right: 8px;
        }

        .price-save {
            background: #10b981;
            color: white;
            padding: 2px 8px;
            border-radius: 12px;
            font-size: 11px;
            font-weight: 500;
        }

        .price-current {
            font-size: 32px;
            font-weight: 700;
            color: #1a56db;
            margin-top: 8px;
        }

        .price-note {
            font-size: 12px;
            color: #999;
            margin-top: 4px;
        }

        .info-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            font-size: 14px;
            border-bottom: 1px solid #f0f0f0;
        }

        .info-row span {
            color: #666;
        }

        .info-row strong {
            color: #1a1a1a;
            font-weight: 600;
        }

        .booking-card__actions {
            display: flex;
            justify-content: space-between;
            margin-top: 16px;
            padding-top: 16px;
            border-top: 1px solid #e5e5e5;
        }

        /* BUTTONS */
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 10px 20px;
            font-size: 14px;
            font-weight: 500;
            border-radius: 8px;
            text-decoration: none;
            transition: all 0.2s;
            cursor: pointer;
            border: none;
        }

        .btn--primary {
            background: #1a56db;
            color: white;
        }

        .btn--primary:hover {
            background: #164bc2;
        }

        .btn--block {
            width: 100%;
        }

        .btn--sm {
            padding: 6px 14px;
            font-size: 13px;
            background: #f0f0f0;
            color: #1a1a1a;
        }

        .btn--sm:hover {
            background: #e5e5e5;
        }

        .text-link {
            font-size: 13px;
            color: #666;
            text-decoration: none;
        }

        .text-link:hover {
            color: #1a56db;
        }

        /* RELATED PACKAGES */
        .related {
            padding: 48px 0 64px;
            border-top: 1px solid #e5e5e5;
        }

        .related__header {
            text-align: center;
            margin-bottom: 32px;
        }

        .related__title {
            font-size: 28px;
            font-weight: 600;
            color: #1a1a1a;
        }

        @media (max-width: 768px) {
            .related__title {
                font-size: 24px;
            }
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
        }

        .package-card {
            background: white;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.05);
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .package-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .package-card__image {
            position: relative;
            height: 200px;
            overflow: hidden;
        }

        .package-card__image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .package-card__badge {
            position: absolute;
            top: 12px;
            right: 12px;
            background: #10b981;
            color: white;
            padding: 4px 10px;
            border-radius: 20px;
            font-size: 11px;
            font-weight: 600;
        }

        .package-card__body {
            padding: 16px;
        }

        .package-card__meta {
            display: flex;
            gap: 12px;
            margin-bottom: 8px;
            font-size: 12px;
        }

        .package-card__type {
            color: #1a56db;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .package-card__duration {
            color: #999;
        }

        .package-card__title {
            font-size: 16px;
            font-weight: 600;
            margin-bottom: 8px;
            color: #1a1a1a;
            line-height: 1.4;
        }

        .package-card__desc {
            font-size: 13px;
            color: #666;
            line-height: 1.5;
            margin-bottom: 12px;
        }

        .package-card__footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 12px;
        }

        .package-card__price .price-old {
            font-size: 12px;
            margin-right: 6px;
        }

        .package-card__price .price-current {
            font-size: 16px;
            margin-top: 0;
        }
    </style>

@endsection
