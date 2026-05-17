@extends('layouts.frontend')

@section('title', $trek->name . ' – Visit Nepal')

@section('content')
    <style>
        .trek-page {
            background: #0b1220;
            color: #e5e7eb;
            min-height: 100vh;
        }

        .trek-hero {
            position: relative;
            height: 65vh;
            overflow: hidden;
        }

        .trek-hero-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .trek-hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0.2), rgba(0, 0, 0, 0.85));
        }

        .trek-hero-content {
            position: absolute;
            bottom: 40px;
            left: 50%;
            transform: translateX(-50%);
            text-align: center;
            width: 100%;
        }

        .trek-hero-content h1 {
            font-size: 3rem;
            font-weight: 800;
            color: white;
        }

        .badge {
            background: rgba(255, 193, 7, 0.15);
            border: 1px solid rgba(255, 193, 7, 0.4);
            color: #fbbf24;
            padding: 6px 14px;
            border-radius: 20px;
        }

        .meta span {
            margin: 0 10px;
            color: #cbd5e1;
            font-size: 14px;
        }

        .trek-container {
            max-width: 1200px;
            margin: auto;
            padding: 60px 20px;
        }

        .trek-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 40px;
        }

        .trek-left h2,
        .related h2 {
            color: white;
        }

        .trek-left h2 span {
            color: #fbbf24;
        }

        .trek-left p {
            color: #9ca3af;
            line-height: 1.8;
        }

        .timeline-item {
            position: relative;
            padding-left: 20px;
            margin-bottom: 20px;
            border-left: 2px solid rgba(255, 255, 255, 0.1);
        }

        .timeline-item .dot {
            position: absolute;
            left: -6px;
            top: 6px;
            width: 10px;
            height: 10px;
            background: #fbbf24;
            border-radius: 50%;
        }

        .price-box {
            background: #111827;
            padding: 25px;
            border-radius: 15px;
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .price {
            font-size: 2.5rem;
            color: #fbbf24;
        }

        .btn-primary {
            display: block;
            background: #fbbf24;
            color: #000;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
            border-radius: 10px;
        }

        .btn-outline {
            display: block;
            border: 1px solid #fbbf24;
            color: #fbbf24;
            padding: 10px;
            margin-top: 10px;
            text-align: center;
            border-radius: 10px;
        }

        .related-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(240px, 1fr));
            gap: 20px;
        }

        .related .card {
            background: #111827;
            border-radius: 12px;
            overflow: hidden;
            text-decoration: none;
            color: white;
        }

        .related .card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
        }
    </style>
    <div class="trek-page">{{-- HERO --}} <section class="trek-hero"><img
                src="{{ asset('storage/' . $trek->featured_image) }}" class="trek-hero-img" alt="{{ $trek->name }}">
            <div class="trek-hero-overlay"></div>
            <div class="trek-hero-content"><span class="badge">Trek</span>
                <h1>{{ $trek->name }}</h1>
                <div class="meta"><span><i class="fas fa-calendar"></i>{{ $trek->duration_days }} Days</span><span><i
                            class="fas fa-mountain"></i>{{ $trek->max_altitude ?? 'N/A' }}</span><span><i
                            class="fas fa-signal"></i>{{ $trek->difficulty }}</span><span><i
                            class="fas fa-sun"></i>{{ $trek->best_season ?? 'All Season' }}</span></div>
            </div>
        </section>{{-- BODY --}} <div class="trek-container">
            <div class="trek-grid">{{-- LEFT --}} <div class="trek-left">
                    <h2>About This <span>Trek</span></h2>
                    <p>{{ $trek->description }}</p>
                    <h3>Day-by-Day Itinerary</h3>
                    <div class="timeline">@php
                        $itinerary = is_array($trek->itinerary)
                            ? $trek->itinerary
                            : json_decode($trek->itinerary, true) ?? [];
                    @endphp @forelse($itinerary as $day => $activity)
                            <div class="timeline-item">
                                <div class="dot"></div>
                                <div class="day">{{ $day }}</div>
                                <div class="activity">{{ $activity }}</div>
                        </div>@empty <p class="empty">No itinerary available.</p>
                        @endforelse
                    </div>
                </div>{{-- RIGHT --}} <div class="trek-right">
                    <div class="price-box">
                        <div class="price">${{ number_format($trek->price_usd ?? 0) }} </div><small>per person</small><a
                            href="{{ route('booking.create', $trek->slug) }}" class="btn-primary">Book This Trek </a><a
                            href="{{ route('contact') }}" class="btn-outline">Ask a Question </a>
                        <div class="includes">
                            <h4>Includes</h4>@php
                                $included = is_array($trek->included)
                                    ? $trek->included
                                    : json_decode($trek->included, true) ?? [];
                            @endphp @forelse($included as $item)
                            <div class="include-item">✓ {{ $item }}</div>@empty <div class="include-item">No
                                    data</div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>{{-- RELATED --}} <section class="related">
                <h2>Other Treks</h2>
                <div class="related-grid">
                    @foreach ($related as $other)
                        @continue($other->slug === $trek->slug)
                        <a href="{{ route('treks.show', $other->slug) }}" class="card"><img
                                src="{{ asset('storage/' . $other->featured_image) }}" alt="{{ $other->name }}">
                            <div class="card-body">
                                <h4>{{ $other->name }}</h4><span>{{ $other->duration_days }} days</span>
                            </div>
                        </a>
                    @endforeach
                </div>
            </section>
        </div>
</div>@endsection
