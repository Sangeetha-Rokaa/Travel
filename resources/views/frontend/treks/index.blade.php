@extends('layouts.frontend')

@section('title', 'Himalayan Treks - ApeakNepal')

@push('styles')
    <style>
        /* =============================================
                                                                   TREKS INDEX PAGE STYLES
                                                                ============================================= */

        /* ---- Hero Section ---- */
        .trek-hero {
            position: relative;
            width: 100%;
            height: 420px;
            border-radius: 16px;
            overflow: hidden;
            margin-bottom: 48px;
            background: url('https://images.unsplash.com/photo-1626016632784-7b9f22a0a92c?w=1400&q=85') center center / cover no-repeat;
        }

        .trek-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right,
                    rgba(10, 20, 50, 0.88) 0%,
                    rgba(10, 20, 50, 0.60) 45%,
                    rgba(10, 20, 50, 0.10) 100%);
            z-index: 1;
        }

        .trek-hero-content {
            position: absolute;
            top: 50%;
            left: 52px;
            transform: translateY(-50%);
            z-index: 2;
            max-width: 500px;
        }

        .trek-hero-content h1 {
            font-size: 48px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.15;
            margin: 0 0 14px 0;
            letter-spacing: -0.5px;
            font-family: 'Segoe UI', sans-serif;
        }

        .trek-hero-content p {
            font-size: 15px;
            color: rgba(255, 255, 255, 0.82);
            line-height: 1.6;
            margin: 0 0 28px 0;
        }

        .btn-book-now {
            display: inline-block;
            background: #2b7be0;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            padding: 12px 28px;
            border-radius: 50px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.15s ease;
        }

        .btn-book-now:hover {
            background: #1a65c9;
            transform: translateY(-1px);
            color: #fff;
            text-decoration: none;
        }

        /* ---- Main Content Layout ---- */
        .treks-main {
            display: flex;
            gap: 40px;
            align-items: flex-start;
        }

        /* ---- Cards Section ---- */
        .treks-cards-section {
            flex: 1;
            min-width: 0;
        }

        .section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 24px;
        }

        .section-header h2 {
            font-size: 26px;
            font-weight: 800;
            color: #111827;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .filter-dropdown {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: #fff;
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 14px;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
            transition: border-color 0.2s;
            white-space: nowrap;
        }

        .filter-dropdown:hover {
            border-color: #2b7be0;
            color: #2b7be0;
        }

        .filter-dropdown svg {
            width: 14px;
            height: 14px;
        }

        /* ---- Trek Cards Grid ---- */
        .trek-cards-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        .trek-card {
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            border: 1px solid #f0f0f0;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .trek-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 28px rgba(0, 0, 0, 0.12);
        }

        .trek-card-image {
            width: 100%;
            height: 170px;
            object-fit: cover;
            display: block;
        }

        .trek-card-body {
            padding: 16px 18px 18px;
        }

        .trek-card-title {
            font-size: 15.5px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 6px 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .trek-card-desc {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.5;
            margin: 0 0 14px 0;
        }

        .trek-card-meta {
            display: flex;
            align-items: center;
            gap: 18px;
            font-size: 13px;
            color: #374151;
            margin-bottom: 14px;
        }

        .trek-card-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
            font-weight: 500;
        }

        .meta-icon {
            width: 15px;
            height: 15px;
            opacity: 0.6;
        }

        .difficulty-dot {
            width: 8px;
            height: 8px;
            border-radius: 50%;
            background: #ef4444;
            display: inline-block;
            flex-shrink: 0;
        }

        .btn-book-card {
            display: block;
            width: 100%;
            text-align: center;
            background: transparent;
            border: 1.5px solid #2b7be0;
            color: #2b7be0;
            font-size: 13.5px;
            font-weight: 600;
            padding: 9px 0;
            border-radius: 8px;
            text-decoration: none;
            transition: background 0.2s, color 0.2s;
            cursor: pointer;
        }

        .btn-book-card:hover {
            background: #2b7be0;
            color: #fff;
            text-decoration: none;
        }

        /* ---- Sidebar Filters ---- */
        .treks-sidebar {
            width: 200px;
            flex-shrink: 0;
        }

        .filter-group {
            margin-bottom: 28px;
        }

        .filter-group-title {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 14px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            cursor: pointer;
            font-family: 'Segoe UI', sans-serif;
        }

        .filter-group-title svg {
            width: 16px;
            height: 16px;
            color: #6b7280;
            transition: transform 0.2s;
        }

        .filter-group-title.collapsed svg {
            transform: rotate(-90deg);
        }

        /* Radio Buttons */
        .filter-radio-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .filter-radio-item {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 14px;
            color: #374151;
            cursor: pointer;
        }

        .filter-radio-item input[type="radio"] {
            accent-color: #2b7be0;
            width: 16px;
            height: 16px;
            cursor: pointer;
        }

        /* Range Slider */
        .duration-slider-wrapper {
            padding: 4px 0;
        }

        .trek-range-slider {
            width: 100%;
            -webkit-appearance: none;
            appearance: none;
            height: 4px;
            border-radius: 4px;
            background: linear-gradient(to right, #2b7be0 0%, #2b7be0 60%, #d1d5db 60%, #d1d5db 100%);
            outline: none;
            cursor: pointer;
            margin-bottom: 10px;
        }

        .trek-range-slider::-webkit-slider-thumb {
            -webkit-appearance: none;
            appearance: none;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #fff;
            border: 2.5px solid #2b7be0;
            cursor: pointer;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
        }

        .trek-range-slider::-moz-range-thumb {
            width: 18px;
            height: 18px;
            border-radius: 50%;
            background: #fff;
            border: 2.5px solid #2b7be0;
            cursor: pointer;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.15);
        }

        .duration-label {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #374151;
            font-weight: 500;
        }

        .duration-label svg {
            width: 14px;
            height: 14px;
            color: #6b7280;
        }

        /* Checkbox List */
        .filter-check-list {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        .filter-check-item {
            display: flex;
            align-items: center;
            gap: 9px;
            font-size: 14px;
            color: #374151;
            cursor: pointer;
        }

        .hero-book-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 14px 34px;
            margin-top: 24px;

            background: linear-gradient(135deg, #2563eb, #1d4ed8);
            color: #fff;
            font-size: 16px;
            font-weight: 600;
            letter-spacing: 0.3px;
            text-decoration: none;

            border-radius: 999px;
            box-shadow: 0 10px 25px rgba(37, 99, 235, 0.25);

            transition: all 0.3s ease;
            position: relative;
            overflow: hidden;
        }

        .hero-book-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 14px 30px rgba(37, 99, 235, 0.35);
            background: linear-gradient(135deg, #1d4ed8, #1e40af);
            color: #fff;
        }

        .hero-book-btn:active {
            transform: scale(0.98);
        }

        .hero-book-btn::before {
            content: '';
            position: absolute;
            top: 0;
            left: -120%;
            width: 100%;
            height: 100%;
            background: rgba(255, 255, 255, 0.2);
            transform: skewX(-25deg);
            transition: 0.6s;
        }

        .hero-book-btn:hover::before {
            left: 120%;
        }

        .filter-check-item input[type="checkbox"] {
            accent-color: #2b7be0;
            width: 15px;
            height: 15px;
            border-radius: 3px;
            cursor: pointer;
        }

        /* Divider between filter groups */
        .filter-divider {
            border: none;
            border-top: 1px solid #e5e7eb;
            margin: 0 0 24px 0;
        }

        /* ---- Page Wrapper ---- */
        .treks-page-wrapper {
            max-width: 1200px;
            margin: 0 auto;
            padding: 20px 24px 60px;
            background: #f1ede6;
            min-height: 100vh;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .trek-cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .treks-main {
                flex-direction: column-reverse;
            }

            .treks-sidebar {
                width: 100%;
            }

            .trek-cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .trek-hero-content h1 {
                font-size: 32px;
            }

            .trek-hero {
                height: 300px;
            }
        }

        @media (max-width: 540px) {
            .trek-cards-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="treks-page-wrapper">

        {{-- ===================== HERO SECTION ===================== --}}
        <div class="trek-hero">
            <img src="{{ asset('images/himal.png') }}" alt="Himalayan Treks">
            <div class="trek-hero-overlay"></div>
            <div class="trek-hero-content">
                <h1>Himalayan Treks</h1>
                <p>
                    Nepal located trekking experiences across the Himalayas<br>
                    for your adventure and unforgettable journey in Nepal.
                </p>
                <a href="{{ route('bookings.create', ['trek' => $treks->first()?->slug]) }}" class="btn-book-now">
                    Book Now
                </a>
            </div>
        </div>

        {{-- ===================== MAIN CONTENT ===================== --}}
        <div class="treks-main">

            {{-- Cards Section --}}
            <div class="treks-cards-section">

                {{-- Section Header --}}
                <div class="section-header">
                    <h2>Feature Cards</h2>
                    <button class="filter-dropdown" type="button">
                        All Filters
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                        </svg>
                    </button>
                </div>

                {{-- Trek Cards Grid --}}
                <div class="trek-cards-grid">

                    @forelse($treks as $trek)
                        <div class="trek-card">
                            <img src="{{ Str::startsWith($trek->featured_image, 'http')
                                ? $trek->featured_image
                                : asset('storage/' . $trek->featured_image) }}"
                                alt="{{ $trek->name }}" class="trek-card-image" />
                            <div class="trek-card-body">
                                <h3 class="trek-card-title">{{ $trek->name }}</h3>
                                <p class="trek-card-desc">{{ $trek->short_description }}</p>
                                <div class="trek-card-meta">
                                    <span>
                                        <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                        </svg>
                                        {{ $trek->duration_days }} Days
                                    </span>
                                    <span>
                                        <span class="difficulty-dot"
                                            style="background: {{ $trek->difficultyColor() }};"></span>
                                        {{ $trek->difficulty }}
                                    </span>
                                </div>
                                <a href="{{ route('treks.show', $trek->slug) }}" class="btn-book-card">Book Now</a>
                            </div>
                        </div>
                    @empty
                        <p class="text-muted">No treks found matching your filters.</p>
                    @endforelse

                </div>{{-- end .trek-cards-grid --}}
            </div>{{-- end .treks-cards-section --}}

            {{-- ===================== SIDEBAR FILTERS ===================== --}}
            <aside class="treks-sidebar">

                <form method="GET" action="{{ route('treks.index') }}" id="trek-filter-form">

                    {{-- Difficulty --}}
                    <div class="filter-group">
                        <h4 class="filter-group-title">Difficulty</h4>
                        <div class="filter-radio-list">
                            <label class="filter-radio-item">
                                <input type="radio" name="difficulty" value="difficulty"
                                    {{ !request('difficulty') || request('difficulty') === 'difficulty' ? 'checked' : '' }} />
                                All
                            </label>
                            @foreach ($difficulties as $level)
                                <label class="filter-radio-item">
                                    <input type="radio" name="difficulty" value="{{ strtolower($level) }}"
                                        {{ request('difficulty') === strtolower($level) ? 'checked' : '' }} />
                                    {{ $level }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <hr class="filter-divider" />

                    {{-- Duration --}}
                    <div class="filter-group">
                        <h4 class="filter-group-title">
                            Duration
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                            </svg>
                        </h4>
                        <div class="duration-slider-wrapper">
                            <input type="range" min="1" max="{{ $maxDuration }}"
                                value="{{ request('duration', $maxDuration) }}" class="trek-range-slider"
                                id="durationSlider" name="duration" oninput="updateDuration(this.value)" />
                            <div class="duration-label">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                    stroke="currentColor" stroke-width="2">
                                    <path stroke-linecap="round" stroke-linejoin="round"
                                        d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                <span id="durationLabel">{{ request('duration', $maxDuration) }} Days</span>
                            </div>
                        </div>
                    </div>

                    <hr class="filter-divider" />

                    {{-- Region --}}
                    <div class="filter-group">
                        <h4 class="filter-group-title">
                            Region
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                            </svg>
                        </h4>
                        <div class="filter-check-list">
                            @foreach ($regions as $slug => $name)
                                <label class="filter-check-item">
                                    <input type="checkbox" name="region[]" value="{{ $name }}"
                                        {{ in_array($name, (array) request('region', [])) ? 'checked' : '' }} />
                                    {{ $name }}
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <hr class="filter-divider" />

                    {{-- Price Range --}}
                    <div class="filter-group">
                        <h4 class="filter-group-title">
                            Price Range
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                            </svg>
                        </h4>
                        <div class="filter-check-list">
                            <label class="filter-check-item">
                                <input type="checkbox" name="price[]" value="budget"
                                    {{ in_array('budget', (array) request('price', [])) ? 'checked' : '' }} />
                                Budget
                            </label>
                            <label class="filter-check-item">
                                <input type="checkbox" name="price[]" value="mid"
                                    {{ in_array('mid', (array) request('price', [])) ? 'checked' : '' }} />
                                Mid Range
                            </label>
                            <label class="filter-check-item">
                                <input type="checkbox" name="price[]" value="luxury"
                                    {{ in_array('luxury', (array) request('price', [])) ? 'checked' : '' }} />
                                Luxury
                            </label>
                        </div>
                    </div>

                </form>

            </aside>{{-- end .treks-sidebar --}}

        </div>{{-- end .treks-main --}}

    </div>{{-- end .treks-page-wrapper --}}
@endsection

@push('scripts')
    <script>
        // Duration Slider
        function updateDuration(val) {
            document.getElementById('durationLabel').textContent = val + ' Days';
            const slider = document.getElementById('durationSlider');
            const percent = ((val - slider.min) / (slider.max - slider.min)) * 100;
            slider.style.background =
                `linear-gradient(to right, #2b7be0 0%, #2b7be0 ${percent}%, #d1d5db ${percent}%, #d1d5db 100%)`;
        }

        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('durationSlider');
            if (slider) updateDuration(slider.value);

            // Auto-submit form when any filter changes
            document.querySelectorAll(
                '#trek-filter-form input[type="radio"], #trek-filter-form input[type="checkbox"]'
            ).forEach(function(input) {
                input.addEventListener('change', function() {
                    document.getElementById('trek-filter-form').submit();
                });
            });

            // Submit on slider release
            slider?.addEventListener('change', function() {
                document.getElementById('trek-filter-form').submit();
            });
        });
    </script>
@endpush
