@extends('layouts.frontend')

@section('title', 'Explore Destinations')

@section('content')

    <style>
        .destination-page {
            background: #f8fafc;
            min-height: 100vh;
            padding: 80px 0;
        }

        .destination-header {
            text-align: center;
            margin-bottom: 60px;
        }

        .destination-header h1 {
            font-size: 42px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 14px;
        }

        .destination-header p {
            color: #64748b;
            max-width: 700px;
            margin: auto;
            font-size: 16px;
            line-height: 1.7;
        }

        .destination-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        .destination-card {
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            position: relative;
            transition: all .35s ease;
            box-shadow: 0 10px 30px rgba(15, 23, 42, 0.06);
            border: 1px solid #e2e8f0;
        }

        .destination-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 45px rgba(15, 23, 42, 0.12);
        }

        .destination-image-wrap {
            position: relative;
            overflow: hidden;
            height: 260px;
        }

        .destination-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .destination-card:hover .destination-image {
            transform: scale(1.08);
        }

        .destination-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top,
                    rgba(0, 0, 0, 0.75),
                    rgba(0, 0, 0, 0.1),
                    transparent);
        }

        .destination-region {
            position: absolute;
            top: 18px;
            left: 18px;
            background: rgba(255, 255, 255, 0.95);
            color: #0f172a;
            padding: 7px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            backdrop-filter: blur(10px);
        }

        .destination-content {
            padding: 24px;
        }

        .destination-name {
            font-size: 24px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .destination-location {
            display: flex;
            align-items: center;
            gap: 8px;
            color: #475569;
            font-size: 14px;
            margin-bottom: 16px;
        }

        .destination-description {
            color: #64748b;
            font-size: 15px;
            line-height: 1.7;
            margin-bottom: 24px;
        }

        .destination-meta {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 24px;
        }

        .meta-item {
            background: #f1f5f9;
            padding: 10px 14px;
            border-radius: 12px;
            font-size: 13px;
            color: #334155;
            font-weight: 600;
        }

        .destination-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 14px;
            border-radius: 14px;
            background: linear-gradient(135deg, #0f172a, #1e293b);
            color: #fff;
            text-decoration: none;
            font-weight: 700;
            transition: .3s ease;
        }

        .destination-btn:hover {
            background: linear-gradient(135deg, #1e293b, #334155);
            color: #fff;
        }

        .empty-box {
            background: #fff;
            padding: 80px 30px;
            border-radius: 24px;
            text-align: center;
            border: 1px dashed #cbd5e1;
        }

        .empty-box i {
            font-size: 55px;
            color: #94a3b8;
            margin-bottom: 18px;
        }

        .empty-box h3 {
            font-size: 24px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .empty-box p {
            color: #64748b;
        }

        .pagination-wrapper {
            margin-top: 60px;
            display: flex;
            justify-content: center;
        }

        @media(max-width:768px) {

            .destination-header h1 {
                font-size: 32px;
            }

            .destination-page {
                padding: 60px 0;
            }
        }
    </style>

    <section class="destination-page">

        <div class="container mx-auto px-4">

            {{-- HEADER --}}
            <div class="destination-header">
                <h1>Explore Beautiful Destinations</h1>

                <p>
                    Discover Nepal’s most iconic mountains, lakes, heritage sites,
                    trekking regions, and hidden natural wonders with unforgettable experiences.
                </p>
            </div>

            {{-- GRID --}}
            @if ($destinations->count())

                <div class="destination-grid">

                    @foreach ($destinations as $destination)
                        <div class="destination-card">

                            {{-- IMAGE --}}
                            <div class="destination-image-wrap">

                                <img src="{{ asset('storage/' . $destination->featured_image) }}"
                                    alt="{{ $destination->name }}" class="destination-image">

                                <div class="destination-overlay"></div>

                                {{-- REGION --}}
                                @if ($destination->region)
                                    <span class="destination-region">
                                        {{ $destination->region }}
                                    </span>
                                @endif

                            </div>

                            {{-- CONTENT --}}
                            <div class="destination-content">

                                <h2 class="destination-name">
                                    {{ $destination->name }}
                                </h2>

                                <div class="destination-location">
                                    <i class="fas fa-location-dot"></i>
                                    <span>{{ $destination->location }}</span>
                                </div>

                                <p class="destination-description">
                                    {{ \Illuminate\Support\Str::limit($destination->short_description, 120) }}
                                </p>

                                {{-- META --}}
                                <div class="destination-meta">

                                    @if ($destination->altitude)
                                        <div class="meta-item">
                                            ⛰ {{ $destination->altitude }}
                                        </div>
                                    @endif

                                    @if ($destination->best_season)
                                        <div class="meta-item">
                                            🌤 {{ $destination->best_season }}
                                        </div>
                                    @endif

                                </div>

                                {{-- BUTTON --}}
                                <a href="{{ route('destinations.show', $destination->slug) }}" class="destination-btn">
                                    Explore Destination
                                </a>

                            </div>

                        </div>
                    @endforeach

                </div>

                {{-- PAGINATION --}}
                <div class="pagination-wrapper">
                    {{ $destinations->links() }}
                </div>
            @else
                {{-- EMPTY --}}
                <div class="empty-box">

                    <i class="fas fa-mountain"></i>

                    <h3>No Destinations Found</h3>

                    <p>
                        Destinations will appear here once added by the admin.
                    </p>

                </div>

            @endif

        </div>

    </section>

@endsection
