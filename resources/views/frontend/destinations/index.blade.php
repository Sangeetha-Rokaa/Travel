@extends('layouts.frontend')

@section('title', 'Destinations - Visit Nepal')

@push('styles')
    <style>
        /* =============================================
                                       DESTINATIONS PAGE STYLES
                                    ============================================= */

        .dest-page-wrapper {
            background: #e8e4dc;
            min-height: 100vh;
            padding: 32px 32px 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ---- HERO ---- */
        .dest-hero {
            position: relative;
            width: 100%;
            height: 400px;
            border-radius: 18px;
            overflow: hidden;
            margin-bottom: 40px;
            background: url('https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=1400&q=85') center center / cover no-repeat;
        }

        .dest-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right,
                    rgba(8, 18, 48, 0.92) 0%,
                    rgba(8, 18, 48, 0.65) 42%,
                    rgba(8, 18, 48, 0.05) 100%);
            z-index: 1;
        }

        .dest-hero-content {
            position: absolute;
            top: 50%;
            left: 52px;
            transform: translateY(-50%);
            z-index: 2;
            max-width: 460px;
        }

        .dest-hero-content h1 {
            font-size: 46px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.15;
            margin: 0 0 16px 0;
            letter-spacing: -0.3px;
            font-family: 'Segoe UI', sans-serif;
        }

        .dest-hero-content p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.80);
            line-height: 1.65;
            margin: 0 0 28px 0;
        }

        .btn-explore-now {
            display: inline-block;
            background: #2b7be0;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            padding: 12px 26px;
            border-radius: 50px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.15s ease;
        }

        .btn-explore-now:hover {
            background: #1a65c9;
            transform: translateY(-1px);
            color: #fff;
            text-decoration: none;
        }

        /* ---- DESTINATION CARDS GRID ---- */
        .dest-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
            margin-bottom: 20px;
        }

        .dest-card {
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.07);
            border: 1px solid #ebebeb;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            cursor: pointer;
        }

        .dest-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.13);
        }

        .dest-card {
            display: block;
            text-decoration: none;
            color: inherit;
        }

        .dest-card-img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            display: block;
        }

        .dest-card-body {
            padding: 14px 16px 16px;
        }

        .dest-card-title {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 3px 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .dest-card-tag {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
        }

        /* ---- BOTTOM ROW: 2 cards + map ---- */
        .dest-bottom-row {
            display: grid;
            grid-template-columns: 1fr 1fr 2fr;
            gap: 20px;
        }

        /* Map container */
        .dest-map-container {
            border-radius: 14px;
            overflow: hidden;
            min-height: 220px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.08);
            border: 1px solid #ebebeb;
            position: relative;
        }

        .dest-map-container iframe {
            width: 100%;
            height: 100%;
            min-height: 220px;
            border: none;
            display: block;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .dest-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .dest-bottom-row {
                grid-template-columns: 1fr 1fr;
            }

            .dest-map-container {
                grid-column: 1 / -1;
            }
        }

        @media (max-width: 640px) {
            .dest-grid {
                grid-template-columns: 1fr 1fr;
            }

            .dest-bottom-row {
                grid-template-columns: 1fr;
            }

            .dest-hero-content h1 {
                font-size: 30px;
            }

            .dest-hero {
                height: 280px;
            }

            .dest-hero-content {
                left: 24px;
            }

            .dest-page-wrapper {
                padding: 20px 16px 40px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="dest-page-wrapper">

        {{-- ===================== HERO ===================== --}}
        <div class="dest-hero"
            @if ($hero && $hero->featured_image) style="background-image: url('{{ asset('storage/' . $hero->featured_image) }}');" @endif>
            <div class="dest-hero-content">
                <h1>Discover Nepal's<br>Destinations</h1>
                <p>
                    {{ $hero?->short_description ?? 'Explore the breathtaking landscapes, rich culture, and hidden wonders of Nepal.' }}
                </p>
                <a href="#" class="btn-explore-now">Explore now</a>
            </div>
        </div>

        {{-- ===================== TOP 4 DESTINATION CARDS ===================== --}}
        <div class="dest-grid">
            @forelse($featured as $destination)
                <a href="{{ route('destinations.show', $destination->slug) }}" class="dest-card">
                    <img src="{{ Str::startsWith($destination->featured_image, 'http')
                        ? $destination->featured_image
                        : asset('storage/' . $destination->featured_image) }}"
                        alt="{{ $destination->name }}" class="dest-card-img" />

                    <div class="dest-card-body">
                        <h3 class="dest-card-title">{{ $destination->name }}</h3>
                        <p class="dest-card-tag">({{ $destination->region ?? $destination->location }})</p>
                    </div>
                </a>
            @empty
                <p class="text-muted">No featured destinations found.</p>
            @endforelse
        </div>
        {{-- ===================== BOTTOM ROW: 2 cards + map ===================== --}}
        <div class="dest-bottom-row">
            @foreach ($bottom as $destination)
                <a href="{{ route('destinations.show', $destination->slug) }}" class="dest-card">
                    <img src="{{ Str::startsWith($destination->featured_image, 'http')
                        ? $destination->featured_image
                        : asset('storage/' . $destination->featured_image) }}"
                        alt="{{ $destination->name }}" class="dest-card-img" />

                    <div class="dest-card-body">
                        <h3 class="dest-card-title">{{ $destination->name }}</h3>
                        <p class="dest-card-tag">({{ $destination->region ?? $destination->location }})</p>
                    </div>
                </a>
            @endforeach
        </div>
        {{-- Nepal Map --}}
        <div class="dest-map-container">
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3642089.7864566!2d82.34808!3d28.394857!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3995e8c77d506e17%3A0x5a4b9a1ed82e21e!2sNepal!5e0!3m2!1sen!2snp!4v1699999999999!5m2!1sen!2snp"
                allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade" title="Nepal Map"></iframe>
        </div>

    </div>{{-- end .dest-bottom-row --}}

    </div>{{-- end .dest-page-wrapper --}}
@endsection

@push('scripts')
    <script>
        // Destination card click — navigate to detail page
        document.querySelectorAll('.dest-card').forEach(function(card) {
            card.addEventListener('click', function() {
                // You can wire up routing here, e.g.:
                // window.location.href = card.dataset.url;
            });
        });
        document.querySelectorAll('.dest-card').forEach(card => {
            card.addEventListener('click', () => {
                window.location.href = card.dataset.url;
            });
        });
    </script>
@endpush
