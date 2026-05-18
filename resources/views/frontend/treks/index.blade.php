@extends('layouts.frontend')

@section('title', 'Himalayan Treks - Visit Nepal')

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
            padding: 36px 24px 60px;
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

            {{-- BACKGROUND IMAGE --}}
            <img src="{{ asset('images/himal.png') }}" alt="Himalayan Treks">

            {{-- OVERLAY --}}
            <div class="trek-hero-overlay"></div>

            {{-- CONTENT --}}
            <div class="trek-hero-content">
                <h1>Himalayan Treks</h1>
                <p>
                    Lorem located trekking experiences across the Himalayas<br>
                    for your adventure and unforgettable journey in Nepal.
                </p>
                <a href="{{ route('treks.index') }}" class="btn-book-now">Book now</a>
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

                    {{-- Card 1: Everest Base Camp --}}
                    <div class="trek-card">
                        <img src="https://images.unsplash.com/photo-1586348943529-beaae6c28db9?w=600&q=80"
                            alt="Everest Base Camp" class="trek-card-image" />
                        <div class="trek-card-body">
                            <h3 class="trek-card-title">Everest Base Camp (EBC)</h3>
                            <p class="trek-card-desc">The best price for your dream adventure in Nepal.</p>
                            <div class="trek-card-meta">
                                <span>
                                    <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    14 Days
                                </span>
                                <span>
                                    <span class="difficulty-dot"></span>
                                    Strenuous
                                </span>
                            </div>
                            <a href="#" class="btn-book-card">Book Now</a>
                        </div>
                    </div>

                    {{-- Card 2: Annapurna Circuit --}}
                    <div class="trek-card">
                        <img src="https://images.unsplash.com/photo-1623323838603-e6df2ef58f32?w=600&q=80"
                            alt="Annapurna Circuit" class="trek-card-image" />
                        <div class="trek-card-body">
                            <h3 class="trek-card-title">Annapurna Circuit</h3>
                            <p class="trek-card-desc">Our experienced local guides ensure adventure in Nepal.</p>
                            <div class="trek-card-meta">
                                <span>
                                    <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    14 Days
                                </span>
                                <span>
                                    <span class="difficulty-dot"></span>
                                    Strenuous
                                </span>
                            </div>
                            <a href="#" class="btn-book-card">Book Now</a>
                        </div>
                    </div>

                    {{-- Card 3: Langtang Valley --}}
                    <div class="trek-card">
                        <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=600&q=80"
                            alt="Langtang Valley" class="trek-card-image" />
                        <div class="trek-card-body">
                            <h3 class="trek-card-title">Langtang Valley</h3>
                            <p class="trek-card-desc">Our experienced local guide Langtang adventure in Nepal.</p>
                            <div class="trek-card-meta">
                                <span>
                                    <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    14 Days
                                </span>
                                <span>
                                    <span class="difficulty-dot"></span>
                                    Strenuous
                                </span>
                            </div>
                            <a href="#" class="btn-book-card">Book Now</a>
                        </div>
                    </div>

                    {{-- Card 4: Manaslu Circuit --}}
                    <div class="trek-card">
                        <img src="https://images.unsplash.com/photo-1516912481808-3406841bd33c?w=600&q=80"
                            alt="Manaslu Circuit" class="trek-card-image" />
                        <div class="trek-card-body">
                            <h3 class="trek-card-title">Manaslu Circuit</h3>
                            <p class="trek-card-desc">Experience the remote Manaslu region in all its glory.</p>
                            <div class="trek-card-meta">
                                <span>
                                    <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    16 Days
                                </span>
                                <span>
                                    <span class="difficulty-dot"></span>
                                    Strenuous
                                </span>
                            </div>
                            <a href="#" class="btn-book-card">Book Now</a>
                        </div>
                    </div>

                    {{-- Card 5: Upper Mustang --}}
                    <div class="trek-card">
                        <img src="https://images.unsplash.com/photo-1549880338-65ddcdfd017b?w=600&q=80"
                            alt="Upper Mustang" class="trek-card-image" />
                        <div class="trek-card-body">
                            <h3 class="trek-card-title">Upper Mustang</h3>
                            <p class="trek-card-desc">Explore the forbidden kingdom of Lo Manthang.</p>
                            <div class="trek-card-meta">
                                <span>
                                    <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    12 Days
                                </span>
                                <span>
                                    <span class="difficulty-dot" style="background:#f59e0b;"></span>
                                    Low
                                </span>
                            </div>
                            <a href="#" class="btn-book-card">Book Now</a>
                        </div>
                    </div>

                    {{-- Card 6: Gokyo Lakes --}}
                    <div class="trek-card">
                        <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=600&q=80"
                            alt="Gokyo Lakes" class="trek-card-image" />
                        <div class="trek-card-body">
                            <h3 class="trek-card-title">Gokyo Lakes</h3>
                            <p class="trek-card-desc">Stunning turquoise lakes with Everest panorama views.</p>
                            <div class="trek-card-meta">
                                <span>
                                    <svg class="meta-icon" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                        <path stroke-linecap="round" stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                    </svg>
                                    15 Days
                                </span>
                                <span>
                                    <span class="difficulty-dot" style="background:#f59e0b;"></span>
                                    Low
                                </span>
                            </div>
                            <a href="#" class="btn-book-card">Book Now</a>
                        </div>
                    </div>

                </div>{{-- end .trek-cards-grid --}}
            </div>{{-- end .treks-cards-section --}}

            {{-- ===================== SIDEBAR FILTERS ===================== --}}
            <aside class="treks-sidebar">

                {{-- Difficulty --}}
                <div class="filter-group">
                    <h4 class="filter-group-title">
                        Difficulty
                    </h4>
                    <div class="filter-radio-list">
                        <label class="filter-radio-item">
                            <input type="radio" name="difficulty" value="difficulty" checked />
                            Difficulty
                        </label>
                        <label class="filter-radio-item">
                            <input type="radio" name="difficulty" value="low" />
                            Low
                        </label>
                        <label class="filter-radio-item">
                            <input type="radio" name="difficulty" value="moderate" />
                            Moderate
                        </label>
                        <label class="filter-radio-item">
                            <input type="radio" name="difficulty" value="strenuous" />
                            Strenuous
                        </label>
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
                        <input type="range" min="1" max="30" value="15" class="trek-range-slider"
                            id="durationSlider" oninput="updateDuration(this.value)" />
                        <div class="duration-label">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                stroke="currentColor" stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span id="durationLabel">15 Days</span>
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
                        <label class="filter-check-item">
                            <input type="checkbox" name="region[]" value="kbd" />
                            Kbd
                        </label>
                        <label class="filter-check-item">
                            <input type="checkbox" name="region[]" value="annapurna" />
                            Annapurna
                        </label>
                        <label class="filter-check-item">
                            <input type="checkbox" name="region[]" value="circuit" />
                            Circuit
                        </label>
                        <label class="filter-check-item">
                            <input type="checkbox" name="region[]" value="manaslu" />
                            Manaslu
                        </label>
                        <label class="filter-check-item">
                            <input type="checkbox" name="region[]" value="mustang" />
                            Mustang
                        </label>
                    </div>
                </div>

                <hr class="filter-divider" />

                {{-- Price Range (optional extra) --}}
                <div class="filter-group">
                    <h4 class="filter-group-title">
                        Price Range
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 15l7-7 7 7" />
                        </svg>
                    </h4>
                    <div class="filter-check-list">
                        <label class="filter-check-item">
                            <input type="checkbox" name="price[]" value="budget" />
                            Budget
                        </label>
                        <label class="filter-check-item">
                            <input type="checkbox" name="price[]" value="mid" />
                            Mid Range
                        </label>
                        <label class="filter-check-item">
                            <input type="checkbox" name="price[]" value="luxury" />
                            Luxury
                        </label>
                    </div>
                </div>

            </aside>{{-- end .treks-sidebar --}}

        </div>{{-- end .treks-main --}}

    </div>{{-- end .treks-page-wrapper --}}
@endsection

@push('scripts')
    <script>
        // Duration Slider
        function updateDuration(val) {
            document.getElementById('durationLabel').textContent = val + ' Days';

            // Update slider gradient fill
            const slider = document.getElementById('durationSlider');
            const percent = ((val - slider.min) / (slider.max - slider.min)) * 100;
            slider.style.background =
                `linear-gradient(to right, #2b7be0 0%, #2b7be0 ${percent}%, #d1d5db ${percent}%, #d1d5db 100%)`;
        }

        // Initialize slider on page load
        document.addEventListener('DOMContentLoaded', function() {
            const slider = document.getElementById('durationSlider');
            if (slider) updateDuration(slider.value);
        });
    </script>
@endpush
