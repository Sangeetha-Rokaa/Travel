@extends('layouts.frontend')

@section('title', $package->name)

@section('content')

    <section class="package-details-section">

        {{-- HERO --}}
        <div class="package-hero">

            <img src="{{ asset('storage/' . $package->featured_image) }}" alt="{{ $package->name }}">

            <div class="hero-overlay"></div>

            <div class="hero-content container">

                <span class="package-type">
                    {{ ucfirst($package->type) }}
                </span>

                <h1>{{ $package->name }}</h1>

                <p>
                    {{ $package->short_description }}
                </p>

            </div>

        </div>

        {{-- CONTENT --}}
        <div class="container">

            <div class="package-layout">

                {{-- LEFT --}}
                <div class="package-main">

                    {{-- DESCRIPTION --}}
                    <div class="detail-card">

                        <h2>Overview</h2>

                        <p>
                            {!! nl2br(e($package->description)) !!}
                        </p>

                    </div>

                    {{-- HIGHLIGHTS --}}
                    @if (is_array($package->highlights) && count($package->highlights))

                        <div class="detail-card">

                            <h2>Highlights</h2>

                            <ul class="detail-list">

                                @foreach ($package->highlights as $highlight)
                                    <li>{{ $highlight }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif

                    {{-- ITINERARY --}}
                    @if (is_array($package->itinerary) && count($package->itinerary))

                        <div class="detail-card">

                            <h2>Itinerary</h2>

                            @foreach ($package->itinerary as $day)
                                <div class="itinerary-item">

                                    <h4>
                                        Day {{ $loop->iteration }}
                                    </h4>

                                    <p>{{ $day }}</p>

                                </div>
                            @endforeach

                        </div>

                    @endif

                    {{-- INCLUDED --}}
                    @if (is_array($package->included) && count($package->included))

                        <div class="detail-card">

                            <h2>Included</h2>

                            <ul class="detail-list included-list">

                                @foreach ($package->included as $item)
                                    <li>{{ $item }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif

                    {{-- EXCLUDED --}}
                    @if (is_array($package->excluded) && count($package->excluded))

                        <div class="detail-card">

                            <h2>Excluded</h2>

                            <ul class="detail-list excluded-list">

                                @foreach ($package->excluded as $item)
                                    <li>{{ $item }}</li>
                                @endforeach

                            </ul>

                        </div>

                    @endif

                </div>

                {{-- RIGHT SIDEBAR --}}
                <div class="package-sidebar">

                    <div class="booking-card">

                        <div class="price-area">

                            @if ($package->price_usd_discounted)
                                <span class="old-price">
                                    ${{ number_format($package->price_usd, 0) }}
                                </span>

                                <h2>
                                    ${{ number_format($package->price_usd_discounted, 0) }}
                                </h2>
                            @else
                                <h2>
                                    ${{ number_format($package->price_usd, 0) }}
                                </h2>
                            @endif

                        </div>

                        <div class="package-info">

                            <div>
                                <span>Duration</span>
                                <strong>{{ $package->duration_days }} Days</strong>
                            </div>

                            <div>
                                <span>Best Season</span>
                                <strong>{{ $package->best_season ?? 'All Season' }}</strong>
                            </div>

                            <div>
                                <span>Group Size</span>
                                <strong>Max {{ $package->group_size_max }}</strong>
                            </div>

                        </div>

                        <a href="#" class="book-btn">
                            Book Now
                        </a>

                    </div>

                </div>

            </div>

            {{-- RELATED PACKAGES --}}
            @if ($packages->count())

                <div class="related-section">

                    <h2>Related Packages</h2>

                    <div class="related-grid">

                        @foreach ($packages as $item)
                            <div class="related-card">

                                <img src="{{ asset('storage/' . $item->featured_image) }}" alt="{{ $item->name }}">

                                <div class="related-body">

                                    <h4>{{ $item->name }}</h4>

                                    <p>
                                        {{ Str::limit($item->short_description, 80) }}
                                    </p>

                                    <a href="{{ route('packages.show', $item->slug) }}">
                                        View Package
                                    </a>

                                </div>

                            </div>
                        @endforeach

                    </div>

                </div>

            @endif

        </div>

    </section>

    <style>
        .package-details-section {
            background: #f8fafc;
            min-height: 100vh;
            padding-bottom: 80px;
        }

        .package-hero {
            position: relative;
            height: 500px;
            overflow: hidden;
        }

        .package-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, .7), rgba(0, 0, 0, .2));
        }

        .hero-content {
            position: absolute;
            bottom: 60px;
            left: 50%;
            transform: translateX(-50%);
            color: white;
            z-index: 2;
        }

        .package-type {
            background: #2563eb;
            padding: 8px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
        }

        .hero-content h1 {
            font-size: 52px;
            margin: 18px 0;
            font-weight: 800;
        }

        .hero-content p {
            max-width: 700px;
            line-height: 1.8;
            opacity: .9;
        }

        .package-layout {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
            margin-top: 60px;
        }

        .detail-card {
            background: white;
            border-radius: 22px;
            padding: 35px;
            margin-bottom: 25px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        }

        .detail-card h2 {
            margin-bottom: 20px;
            color: #0f172a;
        }

        .detail-card p {
            color: #475569;
            line-height: 1.9;
        }

        .detail-list {
            padding-left: 20px;
        }

        .detail-list li {
            margin-bottom: 12px;
            color: #475569;
        }

        .itinerary-item {
            padding: 18px 0;
            border-bottom: 1px solid #e2e8f0;
        }

        .booking-card {
            background: white;
            border-radius: 22px;
            padding: 30px;
            position: sticky;
            top: 100px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, .05);
        }

        .price-area {
            text-align: center;
            margin-bottom: 30px;
        }

        .old-price {
            display: block;
            text-decoration: line-through;
            color: #94a3b8;
            margin-bottom: 8px;
        }

        .price-area h2 {
            font-size: 42px;
            color: #2563eb;
        }

        .package-info {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .package-info div {
            display: flex;
            justify-content: space-between;
            padding-bottom: 14px;
            border-bottom: 1px solid #e2e8f0;
        }

        .package-info span {
            color: #64748b;
        }

        .book-btn {
            display: block;
            margin-top: 30px;
            background: #2563eb;
            color: white;
            text-align: center;
            padding: 16px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 700;
        }

        .related-section {
            margin-top: 80px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 25px;
            margin-top: 30px;
        }

        .related-card {
            background: white;
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .05);
        }

        .related-card img {
            width: 100%;
            height: 220px;
            object-fit: cover;
        }

        .related-body {
            padding: 20px;
        }

        .related-body h4 {
            margin-bottom: 10px;
        }

        .related-body p {
            color: #64748b;
            line-height: 1.7;
            margin-bottom: 18px;
        }

        .related-body a {
            color: #2563eb;
            font-weight: 700;
            text-decoration: none;
        }

        @media(max-width:992px) {

            .package-layout {
                grid-template-columns: 1fr;
            }

            .hero-content h1 {
                font-size: 36px;
            }

        }
    </style>

@endsection
