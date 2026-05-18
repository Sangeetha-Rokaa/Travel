@extends('layouts.frontend')

@section('title', $destination->name . ' - Visit Nepal')

@section('content')

    {{-- ================= HERO ================= --}}
    <section class="dest-hero">

        <img src="{{ asset('storage/' . $destination->featured_image) }}" alt="{{ $destination->name }}">

        <div class="dest-hero-overlay"></div>

        <div class="dest-hero-content">

            <span class="dest-badge">
                {{ $destination->region ?? 'Nepal Destination' }}
            </span>

            <h1 class="dest-title">
                {{ $destination->name }}
            </h1>

            <p class="dest-subtitle">
                {{ $destination->short_description }}
            </p>

            <div class="dest-meta">

                @if ($destination->location)
                    <span><i class="fas fa-location-dot"></i> {{ $destination->location }}</span>
                @endif

                @if ($destination->altitude)
                    <span><i class="fas fa-mountain"></i> {{ $destination->altitude }}</span>
                @endif

                @if ($destination->best_season)
                    <span><i class="fas fa-sun"></i> {{ $destination->best_season }}</span>
                @endif

            </div>

        </div>
    </section>

    {{-- ================= CONTENT ================= --}}
    <section class="dest-section">

        <div class="container">

            <div class="grid">

                {{-- LEFT --}}
                <div>

                    <div class="card">

                        <h2 class="section-title">About {{ $destination->name }}</h2>

                        <div class="content-text">
                            {!! nl2br(e($destination->description)) !!}
                        </div>

                    </div>

                    {{-- GALLERY --}}
                    @if (!empty($destination->gallery_images))
                        <div class="card mt-6">

                            <h2 class="section-title">Gallery</h2>

                            <div class="gallery">
                                @foreach (json_decode($destination->gallery_images, true) as $image)
                                    <div class="gallery-item">
                                        <img src="{{ asset('storage/' . $image) }}">
                                    </div>
                                @endforeach
                            </div>

                        </div>
                    @endif

                </div>

                {{-- RIGHT SIDEBAR --}}
                <div>

                    <div class="card sticky">

                        <h3 class="section-title-sm">Destination Info</h3>

                        <div class="info-list">

                            <div>
                                <i class="fas fa-location-dot"></i>
                                <div>
                                    <span>Location</span>
                                    <p>{{ $destination->location }}</p>
                                </div>
                            </div>

                            @if ($destination->region)
                                <div>
                                    <i class="fas fa-map"></i>
                                    <div>
                                        <span>Region</span>
                                        <p>{{ $destination->region }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($destination->altitude)
                                <div>
                                    <i class="fas fa-mountain"></i>
                                    <div>
                                        <span>Altitude</span>
                                        <p>{{ $destination->altitude }}</p>
                                    </div>
                                </div>
                            @endif

                            @if ($destination->best_season)
                                <div>
                                    <i class="fas fa-sun"></i>
                                    <div>
                                        <span>Best Season</span>
                                        <p>{{ $destination->best_season }}</p>
                                    </div>
                                </div>
                            @endif

                        </div>

                        <a href="{{ route('packages.index') }}" class="btn-primary">
                            Explore Packages
                        </a>

                    </div>

                </div>

            </div>

        </div>
    </section>

    {{-- ================= RELATED ================= --}}
    @if ($relatedDestinations->count())
        <section class="related">

            <div class="container">

                <h2 class="main-title">Related Destinations</h2>

                <div class="cards">

                    @foreach ($relatedDestinations as $related)
                        <a href="{{ route('destinations.show', $related->slug) }}" class="place-card">

                            <img src="{{ asset('storage/' . $related->featured_image) }}">

                            <div class="place-body">

                                <span class="tag">{{ $related->region }}</span>

                                <h3>{{ $related->name }}</h3>

                                <p>{{ $related->short_description }}</p>

                                <div class="footer">
                                    <span><i class="fas fa-location-dot"></i> {{ $related->location }}</span>
                                    <span>Explore →</span>
                                </div>

                            </div>

                        </a>
                    @endforeach

                </div>

            </div>

        </section>
    @endif

@endsection

{{-- ================= STYLES ================= --}}
@push('styles')
    <style>
        /* HERO */
        .dest-hero {
            position: relative;
            height: 75vh;
            overflow: hidden;
        }

        .dest-hero img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .dest-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, .85), rgba(0, 0, 0, .2));
        }

        .dest-hero-content {
            position: absolute;
            bottom: 0;
            padding: 60px;
            color: white;
            max-width: 700px;
        }

        .dest-badge {
            background: rgba(245, 158, 11, .2);
            padding: 6px 14px;
            border-radius: 999px;
            font-size: 13px;
        }

        .dest-title {
            font-size: 56px;
            font-weight: 800;
            margin-top: 15px;
        }

        .dest-subtitle {
            margin-top: 15px;
            color: #e2e8f0;
        }

        .dest-meta {
            display: flex;
            gap: 20px;
            margin-top: 20px;
            font-size: 14px;
        }

        /* SECTION */
        .dest-section {
            padding: 80px 0;
            background: #f8fafc;
        }

        .container {
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
        }

        .grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
        }

        /* CARD */
        .card {
            background: white;
            padding: 30px;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, .05);
        }

        .sticky {
            position: sticky;
            top: 100px;
        }

        .section-title {
            font-size: 28px;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .section-title-sm {
            font-size: 22px;
            margin-bottom: 20px;
        }

        /* INFO */
        .info-list>div {
            display: flex;
            gap: 15px;
            margin-bottom: 20px;
        }

        .info-list i {
            color: #f59e0b;
            margin-top: 5px;
        }

        /* GALLERY */
        .gallery {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 15px;
        }

        .gallery-item img {
            width: 100%;
            height: 250px;
            object-fit: cover;
            border-radius: 15px;
        }

        /* RELATED */
        .related {
            padding: 80px 0;
            background: white;
        }

        .main-title {
            font-size: 40px;
            font-weight: 800;
            text-align: center;
            margin-bottom: 40px;
        }

        .cards {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        .place-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .05);
            transition: .3s;
        }

        .place-card:hover {
            transform: translateY(-5px);
        }

        .place-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .place-body {
            padding: 20px;
        }

        .tag {
            background: #fef3c7;
            color: #b45309;
            padding: 4px 10px;
            border-radius: 999px;
            font-size: 12px;
        }

        .footer {
            display: flex;
            justify-content: space-between;
            margin-top: 15px;
            font-size: 13px;
            color: #64748b;
        }

        /* BUTTON */
        .btn-primary {
            display: block;
            margin-top: 20px;
            padding: 14px;
            text-align: center;
            background: linear-gradient(135deg, #f59e0b, #f97316);
            color: white;
            border-radius: 14px;
            font-weight: 600;
        }
    </style>
@endpush
