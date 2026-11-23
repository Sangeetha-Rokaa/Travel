
@extends('layouts.frontend')

@section('title', 'Himalayan Treks - ApeakNepal')

@push('styles')
<style>
/* ==========================================
   TREKS INDEX PAGE - APEAKNEPAL
========================================== */

html, body {
    margin: 0;
    padding: 0;
    overflow-x: hidden;
}

/* ==========================================
   FULL WIDTH PAGE WRAPPER
========================================== */

.treks-page-wrapper {
    width: 100%;
    max-width: none;
    margin: 0;
    padding: 0 0 60px;
    background: #f1ede6;
    min-height: 100vh;
    box-sizing: border-box;
}

/* ==========================================
   FULL SCREEN HERO BANNER
========================================== */

.trek-hero {
    position: relative;

    width: 100vw !important;
    max-width: none !important;

    margin-left: calc(50% - 50vw);
    margin-top: 0;
    margin-bottom: 48px;

    height: clamp(460px, 68vh, 650px);

    border-radius: 0 0 16px 16px;
    overflow: hidden;

    background: #0b1b30;
}

/* Background image fills entire screen */

.trek-hero img {
    position: absolute;
    inset: 0;

    width: 100% !important;
    height: 100% !important;
    max-width: none !important;

    object-fit: cover !important;
    object-position: center 45% !important;

    display: block;
    z-index: 0;
}

/* Dark overlay */

.trek-hero::before {
    content: '';
    position: absolute;
    inset: 0;

    background: linear-gradient(
        90deg,
        rgba(5, 17, 43, 0.78) 0%,
        rgba(5, 17, 43, 0.45) 45%,
        rgba(5, 17, 43, 0.10) 100%
    );

    z-index: 1;
    pointer-events: none;
}

/* Hero content */

.trek-hero-content {
    position: absolute;
    top: 50%;
    left: clamp(25px, 8vw, 140px);

    transform: translateY(-50%);

    z-index: 2;
    max-width: 600px;
}

.trek-hero-content h1 {
    font-size: clamp(38px, 4.5vw, 64px);
    font-weight: 800;
    color: #ffffff;
    line-height: 1.15;
    margin: 0 0 14px;
    letter-spacing: -0.5px;
    font-family: 'Segoe UI', sans-serif;
}

.trek-hero-content p {
    font-size: 16px;
    color: rgba(255,255,255,0.9);
    line-height: 1.7;
    margin: 0 0 28px;
}

/* Hero button */

.btn-book-now {
    display: inline-flex;
    align-items: center;
    justify-content: center;

    background: linear-gradient(135deg, #2563eb, #1d4ed8);
    color: #fff;

    font-size: 15px;
    font-weight: 600;

    padding: 14px 34px;
    border-radius: 50px;

    text-decoration: none;
    border: none;
    cursor: pointer;

    transition: all 0.3s ease;
    box-shadow: 0 10px 25px rgba(37,99,235,0.25);
}

.btn-book-now:hover {
    background: linear-gradient(135deg, #1d4ed8, #1e40af);
    transform: translateY(-3px);
    color: #fff;
    text-decoration: none;
}

/* ==========================================
   MAIN CONTENT LAYOUT
========================================== */

.treks-main {
    display: flex;
    gap: 40px;
    align-items: flex-start;

    padding-left: clamp(20px, 3.7vw, 65px);
    padding-right: clamp(20px, 3.7vw, 65px);

    box-sizing: border-box;
    width: 100%;
}

.treks-cards-section {
    flex: 1;
    min-width: 0;
}


/* Section header */

.section-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 24px;
    gap: 15px;
}

.section-header h2 {
    font-size: 26px;
    font-weight: 800;
    color: #111827;
    margin: 0;
    font-family: 'Segoe UI', sans-serif;
}

/* Filter dropdown */

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

/* ==========================================
   TREK CARDS GRID
========================================== */

.trek-cards-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 22px;
}

.trek-card {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;

    box-shadow: 0 2px 12px rgba(0,0,0,0.07);
    border: 1px solid #f0f0f0;

    transition: transform 0.3s ease, box-shadow 0.3s ease;
    min-width: 0;
}

.trek-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 28px rgba(0,0,0,0.12);
}

/* Card images */

.trek-card-image {
    width: 100%;
    height: 210px;
    object-fit: cover;
    display: block;
    transition: transform 0.5s ease;
}

.trek-card:hover .trek-card-image {
    transform: scale(1.05);
}

.trek-card-body {
    padding: 18px;
}

.trek-card-title {
    font-size: 16px;
    font-weight: 700;
    color: #111827;
    margin: 0 0 8px;
    font-family: 'Segoe UI', sans-serif;
}

.trek-card-desc {
    font-size: 13px;
    color: #6b7280;
    line-height: 1.6;
    margin: 0 0 14px;
}

.trek-card-meta {
    display: flex;
    align-items: center;
    flex-wrap: wrap;
    gap: 18px;

    font-size: 13px;
    color: #374151;

    margin-bottom: 15px;
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

/* Card booking button */

.btn-book-card {
    display: block;
    width: 100%;

    text-align: center;

    background: transparent;
    border: 1.5px solid #2b7be0;
    color: #2b7be0;

    font-size: 13.5px;
    font-weight: 600;

    padding: 10px 0;
    border-radius: 8px;

    text-decoration: none;
    transition: background 0.2s, color 0.2s;
    cursor: pointer;
    box-sizing: border-box;
}

.btn-book-card:hover {
    background: #2b7be0;
    color: #fff;
    text-decoration: none;
}

/* ==========================================
   SIDEBAR FILTERS
========================================== */

.treks-sidebar {
    width: 230px;
    flex-shrink: 0;
}

.filter-group {
    margin-bottom: 28px;
}

.filter-group-title {
    font-size: 15px;
    font-weight: 700;
    color: #111827;

    margin: 0 0 14px;

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

/* Radio buttons */

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
    width: 17px;
    height: 17px;
    cursor: pointer;
}

/* Duration slider */

.duration-slider-wrapper {
    padding: 4px 0;
}

.trek-range-slider {
    width: 100%;

    -webkit-appearance: none;
    appearance: none;

    height: 4px;
    border-radius: 4px;

    background: linear-gradient(
        to right,
        #2b7be0 0%,
        #2b7be0 60%,
        #d1d5db 60%,
        #d1d5db 100%
    );

    outline: none;
    cursor: pointer;
    margin-bottom: 10px;
}

.trek-range-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;

    width: 19px;
    height: 19px;

    border-radius: 50%;
    background: #fff;
    border: 2.5px solid #2b7be0;

    cursor: pointer;
    box-shadow: 0 1px 4px rgba(0,0,0,0.15);
}

.trek-range-slider::-moz-range-thumb {
    width: 19px;
    height: 19px;

    border-radius: 50%;
    background: #fff;
    border: 2.5px solid #2b7be0;

    cursor: pointer;
    box-shadow: 0 1px 4px rgba(0,0,0,0.15);
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

/* Checkbox filters */

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
    width: 16px;
    height: 16px;
    cursor: pointer;
}

/* Filter dividers */

.filter-divider {
    border: none;
    border-top: 1px solid #e5e7eb;
    margin: 0 0 24px;
}

/* ==========================================
   RESPONSIVE DESIGN
========================================== */

/* Tablets */

@media (max-width: 1024px) {

    .trek-cards-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .treks-main {
        gap: 25px;
    }

    .treks-sidebar {
        width: 210px;
    }

    .trek-hero {
        height: 55vh;
    }
}

/* Mobile */

@media (max-width: 768px) {

    .trek-hero {
        height: 55vh;
        min-height: 380px;
        border-radius: 0 0 12px 12px;
    }

    .trek-hero-content {
        left: 25px;
        right: 25px;
        max-width: 100%;
    }

    .trek-hero-content h1 {
        font-size: 34px;
    }

    .trek-hero-content p {
        font-size: 14px;
    }

    .treks-main {
        flex-direction: column-reverse;
        gap: 30px;
    }

    .treks-sidebar {
        width: 100%;
    }

    .trek-cards-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
        gap: 18px;
    }

    .trek-card-image {
        height: 190px;
    }
}

/* Small mobile */

@media (max-width: 540px) {

    .trek-hero {
        height: 55vh;
        min-height: 350px;
    }

    .trek-hero-content h1 {
        font-size: 30px;
    }

    .trek-cards-grid {
        grid-template-columns: 1fr;
    }

    .trek-card-image {
        height: 230px;
    }

    .section-header h2 {
        font-size: 21px;
    }

    .treks-main {
        padding-left: 16px;
        padding-right: 16px;
    }
}

</style>
@endpush


@section('content')

<div class="treks-page-wrapper">

    {{-- ===================== HERO SECTION ===================== --}}

    <div class="trek-hero">

        <img
            src="{{ asset('images/himal.png') }}"
            alt="Himalayan Treks"
        >

        <div class="trek-hero-overlay"></div>

        <div class="trek-hero-content">

            <h1>Himalayan Treks</h1>

            <p>
                Nepal located trekking experiences across the Himalayas<br>
                for your adventure and unforgettable journey in Nepal.
            </p>

            <a
                href="{{ route('bookings.create', ['trek' => $treks->first()?->slug]) }}"
                class="btn-book-now"
            >
                Book Now
            </a>

        </div>

    </div>


    {{-- ===================== MAIN CONTENT ===================== --}}

    <div class="treks-main">

        {{-- CARDS SECTION --}}

        <div class="treks-cards-section">

            <div class="section-header">

                <h2>Feature Cards</h2>

                <button class="filter-dropdown" type="button">

                    All Filters

                    <svg
                        xmlns="http://www.w3.org/2000/svg"
                        fill="none"
                        viewBox="0 0 24 24"
                        stroke="currentColor"
                        stroke-width="2"
                    >
                        <path
                            stroke-linecap="round"
                            stroke-linejoin="round"
                            d="M19 9l-7 7-7-7"
                        />
                    </svg>

                </button>

            </div>


            {{-- TREK CARDS GRID --}}

            <div class="trek-cards-grid">

                @forelse($treks as $trek)

                    <div class="trek-card">

                        <img
                            src="{{ Str::startsWith($trek->featured_image, 'http')
                                ? $trek->featured_image
                                : asset('storage/' . $trek->featured_image) }}"
                            alt="{{ $trek->name }}"
                            class="trek-card-image"
                        >

                        <div class="trek-card-body">

                            <h3 class="trek-card-title">
                                {{ $trek->name }}
                            </h3>

                            <p class="trek-card-desc">
                                {{ $trek->short_description }}
                            </p>

                            <div class="trek-card-meta">

                                <span>

                                    <svg
                                        class="meta-icon"
                                        xmlns="http://www.w3.org/2000/svg"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>

                                    {{ $trek->duration_days }} Days

                                </span>

                                <span>

                                    <span
                                        class="difficulty-dot"
                                        style="background: {{ $trek->difficultyColor() }};"
                                    ></span>

                                    {{ $trek->difficulty }}

                                </span>

                            </div>

                            <a
                                href="{{ route('treks.show', $trek->slug) }}"
                                class="btn-book-card"
                            >
                                Book Now
                            </a>

                        </div>

                    </div>

                @empty

                    <p class="text-muted">
                        No treks found matching your filters.
                    </p>

                @endforelse

            </div>

        </div>


        {{-- ===================== SIDEBAR FILTERS ===================== --}}

        <aside class="treks-sidebar">

            <form
                method="GET"
                action="{{ route('treks.index') }}"
                id="trek-filter-form"
            >

                {{-- DIFFICULTY --}}

                <div class="filter-group">

                    <h4 class="filter-group-title">
                        Difficulty
                    </h4>

                    <div class="filter-radio-list">

                        <label class="filter-radio-item">

                            <input
                                type="radio"
                                name="difficulty"
                                value="difficulty"
                                {{ !request('difficulty') || request('difficulty') === 'difficulty' ? 'checked' : '' }}
                            >

                            All

                        </label>

                        @foreach ($difficulties as $level)

                            <label class="filter-radio-item">

                                <input
                                    type="radio"
                                    name="difficulty"
                                    value="{{ strtolower($level) }}"
                                    {{ request('difficulty') === strtolower($level) ? 'checked' : '' }}
                                >

                                {{ $level }}

                            </label>

                        @endforeach

                    </div>

                </div>


                <hr class="filter-divider">


                {{-- DURATION --}}

                <div class="filter-group">

                    <h4 class="filter-group-title">

                        Duration

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 15l7-7 7 7"
                            />
                        </svg>

                    </h4>

                    <div class="duration-slider-wrapper">

                        <input
                            type="range"
                            min="1"
                            max="{{ $maxDuration }}"
                            value="{{ request('duration', $maxDuration) }}"
                            class="trek-range-slider"
                            id="durationSlider"
                            name="duration"
                            oninput="updateDuration(this.value)"
                        >

                        <div class="duration-label">

                            <svg
                                xmlns="http://www.w3.org/2000/svg"
                                fill="none"
                                viewBox="0 0 24 24"
                                stroke="currentColor"
                                stroke-width="2"
                            >
                                <path
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"
                                />
                            </svg>

                            <span id="durationLabel">
                                {{ request('duration', $maxDuration) }} Days
                            </span>

                        </div>

                    </div>

                </div>


                <hr class="filter-divider">


                {{-- REGION --}}

                <div class="filter-group">

                    <h4 class="filter-group-title">

                        Region

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 15l7-7 7 7"
                            />
                        </svg>

                    </h4>

                    <div class="filter-check-list">

                        @foreach ($regions as $slug => $name)

                            <label class="filter-check-item">

                                <input
                                    type="checkbox"
                                    name="region[]"
                                    value="{{ $name }}"
                                    {{ in_array($name, (array) request('region', [])) ? 'checked' : '' }}
                                >

                                {{ $name }}

                            </label>

                        @endforeach

                    </div>

                </div>


                <hr class="filter-divider">


                {{-- PRICE RANGE --}}

                <div class="filter-group">

                    <h4 class="filter-group-title">

                        Price Range

                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            fill="none"
                            viewBox="0 0 24 24"
                            stroke="currentColor"
                            stroke-width="2"
                        >
                            <path
                                stroke-linecap="round"
                                stroke-linejoin="round"
                                d="M5 15l7-7 7 7"
                            />
                        </svg>

                    </h4>

                    <div class="filter-check-list">

                        <label class="filter-check-item">

                            <input
                                type="checkbox"
                                name="price[]"
                                value="budget"
                                {{ in_array('budget', (array) request('price', [])) ? 'checked' : '' }}
                            >

                            Budget

                        </label>

                        <label class="filter-check-item">

                            <input
                                type="checkbox"
                                name="price[]"
                                value="mid"
                                {{ in_array('mid', (array) request('price', [])) ? 'checked' : '' }}
                            >

                            Mid Range

                        </label>

                        <label class="filter-check-item">

                            <input
                                type="checkbox"
                                name="price[]"
                                value="luxury"
                                {{ in_array('luxury', (array) request('price', [])) ? 'checked' : '' }}
                            >

                            Luxury

                        </label>

                    </div>

                </div>

            </form>

        </aside>

    </div>

</div>

@endsection


{{-- ===================== JAVASCRIPT ===================== --}}

@push('scripts')

<script>

// Duration Slider

function updateDuration(val) {

    const label = document.getElementById('durationLabel');
    const slider = document.getElementById('durationSlider');

    if (!slider || !label) return;

    label.textContent = val + ' Days';

    const percent = ((val - slider.min) /
        (slider.max - slider.min || 1)) * 100;

    slider.style.background =
        `linear-gradient(to right,
        #2b7be0 0%,
        #2b7be0 ${percent}%,
        #d1d5db ${percent}%,
        #d1d5db 100%)`;
}


document.addEventListener('DOMContentLoaded', function() {

    const slider = document.getElementById('durationSlider');

    const filterForm = document.getElementById('trek-filter-form');


    // Initialize duration slider

    if (slider) {

        updateDuration(slider.value);

        // Submit when slider is released

        slider.addEventListener('change', function() {

            if (filterForm) {
                filterForm.submit();
            }

        });

    }


    // Automatically submit when filters change

    if (filterForm) {

        filterForm.querySelectorAll(
            'input[type="radio"], input[type="checkbox"]'
        ).forEach(function(input) {

            input.addEventListener('change', function() {

                filterForm.submit();

            });

        });

    }

});

</script>

@endpush
