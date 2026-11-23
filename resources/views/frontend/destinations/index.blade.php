
@extends('layouts.frontend')

@section('title', 'Destinations - ApeakNepal')

@push('styles')
<style>
/* =============================================
   DESTINATIONS PAGE - APEAKNEPAL
============================================= */

html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
}

/* =============================================
   MAIN PAGE WRAPPER
============================================= */

.dest-page-wrapper {
    width: 100%;
    max-width: none;
    margin: 0;
    padding: 0 0 60px;
    background: #e8e4dc;
    min-height: 100vh;
    box-sizing: border-box;
}

/* =============================================
   FULL WIDTH HERO BACKGROUND
============================================= */

.dest-hero {
    position: relative;

    width: 100vw;
    max-width: none;

    margin-left: calc(50% - 50vw);
    margin-top: 0;
    margin-bottom: 40px;

    height: clamp(460px, 75vh, 700px);

    border-radius: 0 0 18px 18px;
    overflow: hidden;

    background-image: url('https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=2000&q=90');
    background-size: cover !important;
    background-position: center center !important;
    background-repeat: no-repeat;
    background-color: #0b1b30;
}

/* Dark image overlay */

.dest-hero::before {
    content: '';
    position: absolute;
    inset: 0;

    background: linear-gradient(
        90deg,
        rgba(8, 18, 48, 0.78) 0%,
        rgba(8, 18, 48, 0.45) 45%,
        rgba(8, 18, 48, 0.10) 100%
    );

    z-index: 1;
    pointer-events: none;
}

/* Hero content */

.dest-hero-content {
    position: absolute;
    top: 50%;
    left: clamp(25px, 8vw, 140px);

    transform: translateY(-50%);

    z-index: 2;
    max-width: 550px;
}

.dest-hero-content h1 {
    font-size: clamp(38px, 4.5vw, 64px);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.15;
    margin: 0 0 16px;
    letter-spacing: -0.5px;
    font-family: 'Segoe UI', sans-serif;
}

.dest-hero-content p {
    font-size: 16px;
    color: rgba(255, 255, 255, 0.9);
    line-height: 1.7;
    margin: 0 0 28px;
}

/* Explore button */

.btn-explore-now {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;

    font-size: 15px;
    font-weight: 600;

    padding: 14px 30px;
    border-radius: 50px;

    text-decoration: none;
    border: none;
    cursor: pointer;

    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(37, 99, 235, 0.25);
}

.btn-explore-now:hover {
    background: #1a65c9;
    transform: translateY(-3px);
    color: #fff;
    text-decoration: none;
}

/* =============================================
   DESTINATION CONTENT AREA
============================================= */

.dest-content {
    width: 100%;
    padding: 0 clamp(20px, 3.7vw, 65px);
    box-sizing: border-box;
}

/* =============================================
   DESTINATION CARDS GRID
============================================= */

.dest-grid {
    display: grid;
    grid-template-columns: repeat(4, minmax(0, 1fr));
    gap: 20px;
    margin-bottom: 25px;
}

.dest-card {
    display: block;
    background: #ffffff;

    border-radius: 14px;
    overflow: hidden;

    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
    border: 1px solid #ebebeb;

    transition: transform 0.3s ease, box-shadow 0.3s ease;

    cursor: pointer;
    text-decoration: none;
    color: inherit;
    min-width: 0;
}

.dest-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 30px rgba(0, 0, 0, 0.13);
    text-decoration: none;
    color: inherit;
}

.dest-card-img {
    width: 100%;
    height: 190px;

    object-fit: cover;
    object-position: center;

    display: block;
    transition: transform 0.5s ease;
}

.dest-card:hover .dest-card-img {
    transform: scale(1.04);
}

.dest-card-body {
    padding: 16px;
}

.dest-card-title {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 5px;
    font-family: 'Segoe UI', sans-serif;
}

.dest-card-tag {
    font-size: 13px;
    color: #6b7280;
    margin: 0;
}

/* =============================================
   BOTTOM ROW: DESTINATION CARDS + MAP
============================================= */

.dest-bottom-row {
    display: grid;
    grid-template-columns: 1fr 1fr 2fr;
    gap: 20px;
    align-items: stretch;
}

/* Map container */

.dest-map-container {
    border-radius: 14px;
    overflow: hidden;

    min-height: 240px;

    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
    border: 1px solid #ebebeb;

    position: relative;
}

.dest-map-container iframe {
    width: 100%;
    height: 100%;
    min-height: 240px;

    border: none;
    display: block;
}

/* =============================================
   TABLET RESPONSIVENESS
============================================= */

@media (max-width: 1024px) {

    .dest-hero {
        height: 60vh;
        min-height: 420px;
    }

    .dest-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .dest-bottom-row {
        grid-template-columns: 1fr 1fr;
    }

    .dest-map-container {
        grid-column: 1 / -1;
    }
}

/* =============================================
   MOBILE RESPONSIVENESS
============================================= */

@media (max-width: 768px) {

    .dest-hero {
        height: 55vh;
        min-height: 380px;

        background-position: center center !important;
        border-radius: 0 0 12px 12px;
    }

    .dest-hero-content {
        left: 25px;
        right: 25px;
        max-width: 100%;
    }

    .dest-hero-content h1 {
        font-size: 36px;
    }

    .dest-hero-content p {
        font-size: 14px;
    }

    .dest-content {
        padding-left: 20px;
        padding-right: 20px;
    }

    .dest-card-img {
        height: 180px;
    }
}

/* =============================================
   SMALL MOBILE
============================================= */

@media (max-width: 540px) {

    .dest-hero {
        height: 55vh;
        min-height: 350px;
    }

    .dest-hero-content {
        left: 20px;
        right: 20px;
    }

    .dest-hero-content h1 {
        font-size: 30px;
    }

    .dest-hero-content p {
        font-size: 13px;
    }

    .dest-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 12px;
    }

    .dest-bottom-row {
        grid-template-columns: 1fr;
    }

    .dest-map-container {
        grid-column: auto;
    }

    .dest-card-img {
        height: 145px;
    }

    .dest-card-body {
        padding: 12px;
    }

    .dest-card-title {
        font-size: 14px;
    }

    .dest-card-tag {
        font-size: 12px;
    }

    .dest-content {
        padding-left: 14px;
        padding-right: 14px;
    }
}

</style>
@endpush


@section('content')

<div class="dest-page-wrapper">

    {{-- =====================================
         FULL WIDTH HERO SECTION
    ====================================== --}}

    <div class="dest-hero"
        @if ($hero && $hero->featured_image)
            style="background-image: url('{{ asset('storage/' . $hero->featured_image) }}');"
        @endif
    >

        <div class="dest-hero-content">

            <h1>
                Discover Nepal's<br>
                Destinations
            </h1>

            <p>
                {{ $hero?->short_description ?? 'Explore the breathtaking landscapes, rich culture, and hidden wonders of Nepal.' }}
            </p>

            <a href="{{ route('destinations.index') }}" class="btn-explore-now">
                Explore Now
            </a>

        </div>

    </div>


    {{-- =====================================
         DESTINATION CONTENT
    ====================================== --}}

    <div class="dest-content">

        {{-- TOP 4 FEATURED DESTINATIONS --}}

        <div class="dest-grid">

            @forelse($featured as $destination)

                <a href="{{ route('destinations.show', $destination->slug) }}"
                    class="dest-card">

                    <img
                        src="{{ Str::startsWith($destination->featured_image, 'http')
                            ? $destination->featured_image
                            : asset('storage/' . $destination->featured_image) }}"
                        alt="{{ $destination->name }}"
                        class="dest-card-img"
                    >

                    <div class="dest-card-body">

                        <h3 class="dest-card-title">
                            {{ $destination->name }}
                        </h3>

                        <p class="dest-card-tag">
                            ({{ $destination->region ?? $destination->location }})
                        </p>

                    </div>

                </a>

            @empty

                <p class="text-muted">
                    No featured destinations found.
                </p>

            @endforelse

        </div>


        {{-- =====================================
             BOTTOM ROW: 2 DESTINATIONS + MAP
        ====================================== --}}

        <div class="dest-bottom-row">

            @foreach ($bottom as $destination)

                <a href="{{ route('destinations.show', $destination->slug) }}"
                    class="dest-card">

                    <img
                        src="{{ Str::startsWith($destination->featured_image, 'http')
                            ? $destination->featured_image
                            : asset('storage/' . $destination->featured_image) }}"
                        alt="{{ $destination->name }}"
                        class="dest-card-img"
                    >

                    <div class="dest-card-body">

                        <h3 class="dest-card-title">
                            {{ $destination->name }}
                        </h3>

                        <p class="dest-card-tag">
                            ({{ $destination->region ?? $destination->location }})
                        </p>

                    </div>

                </a>

            @endforeach


            {{-- NEPAL MAP --}}

            <div class="dest-map-container">

                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3642089.7864566!2d82.34808!3d28.394857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995e8c77d506e17%3A0x5a4b9a1ed82e21e!2sNepal!5e0!3m2!1sen!2snp!4v1699999999999!5m2!1sen!2snp"
                    allowfullscreen
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"
                    title="Nepal Map">
                </iframe>

            </div>

        </div>

    </div>

</div>

@endsection
