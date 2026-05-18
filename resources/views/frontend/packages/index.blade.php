@extends('layouts.frontend')

@section('title', 'Packages - Visit Nepal')

@push('styles')
    <style>
        /* =============================================
           PACKAGES PAGE STYLES
        ============================================= */

        .pkg-page-wrapper {
            background: #eae6de;
            min-height: 100vh;
            padding: 32px 32px 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ---- HERO ---- */
        .pkg-hero {
            position: relative;
            width: 100%;
            height: 400px;
            border-radius: 18px;
            overflow: hidden;
            margin-bottom: 44px;
            background: url('https://images.unsplash.com/photo-1571896349842-33c89424de2d?w=1400&q=85') center top / cover no-repeat;
        }

        .pkg-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right,
                    rgba(8, 18, 50, 0.93) 0%,
                    rgba(8, 18, 50, 0.62) 42%,
                    rgba(8, 18, 50, 0.08) 100%);
            z-index: 1;
        }

        .pkg-hero-content {
            position: absolute;
            top: 50%;
            left: 52px;
            transform: translateY(-50%);
            z-index: 2;
            max-width: 440px;
        }

        .pkg-hero-content h1 {
            font-size: 46px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.15;
            margin: 0 0 16px 0;
            letter-spacing: -0.3px;
            font-family: 'Segoe UI', sans-serif;
        }

        .pkg-hero-content p {
            font-size: 14px;
            color: rgba(255, 255, 255, 0.80);
            line-height: 1.65;
            margin: 0 0 28px 0;
        }

        .btn-discover-more {
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

        .btn-discover-more:hover {
            background: #1a65c9;
            transform: translateY(-1px);
            color: #fff;
            text-decoration: none;
        }

        /* ---- SECTION HEADER ---- */
        .pkg-section-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-bottom: 26px;
        }

        .pkg-section-header h2 {
            font-size: 24px;
            font-weight: 800;
            color: #111827;
            margin: 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .pkg-filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            background: #fff;
            border: 1.5px solid #d1d5db;
            border-radius: 8px;
            padding: 8px 16px;
            font-size: 13.5px;
            font-weight: 500;
            color: #374151;
            cursor: pointer;
            transition: border-color 0.2s;
            white-space: nowrap;
        }

        .pkg-filter-btn:hover {
            border-color: #2b7be0;
            color: #2b7be0;
        }

        .pkg-filter-btn svg {
            width: 14px;
            height: 14px;
        }

        /* ---- PACKAGES GRID ---- */
        .pkg-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 22px;
        }

        /* ---- PACKAGE CARD ---- */
        .pkg-card {
            background: #ffffff;
            border-radius: 14px;
            overflow: hidden;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.07);
            border: 1px solid #f0f0f0;
            transition: transform 0.2s ease, box-shadow 0.2s ease;
            display: flex;
            flex-direction: column;
        }

        .pkg-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 10px 28px rgba(0, 0, 0, 0.12);
        }

        .pkg-card-img {
            width: 100%;
            height: 190px;
            object-fit: cover;
            display: block;
            flex-shrink: 0;
        }

        .pkg-card-body {
            padding: 18px 18px 20px;
            display: flex;
            flex-direction: column;
            flex: 1;
        }

        .pkg-card-title {
            font-size: 15.5px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 2px 0;
            font-family: 'Segoe UI', sans-serif;
            line-height: 1.3;
        }

        .pkg-card-subtitle {
            font-size: 12.5px;
            color: #6b7280;
            margin: 0 0 10px 0;
        }

        .pkg-card-days {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            color: #374151;
            font-weight: 500;
            margin-bottom: 14px;
        }

        .pkg-card-days svg {
            width: 15px;
            height: 15px;
            color: #6b7280;
            flex-shrink: 0;
        }

        /* Inclusions / Exclusions */
        .pkg-ie-section {
            margin-bottom: 6px;
        }

        .pkg-ie-label {
            font-size: 12.5px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 5px 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .pkg-ie-list {
            list-style: none;
            margin: 0 0 10px 0;
            padding: 0;
        }

        .pkg-ie-list li {
            font-size: 12.5px;
            color: #6b7280;
            padding-left: 14px;
            position: relative;
            margin-bottom: 3px;
            line-height: 1.4;
        }

        .pkg-ie-list li::before {
            content: '•';
            position: absolute;
            left: 0;
            color: #9ca3af;
        }

        /* Price + Book Row */
        .pkg-card-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid #f3f4f6;
        }

        .pkg-card-footer-left {
            display: flex;
            flex-direction: column;
        }

        .pkg-price-label {
            font-size: 11px;
            color: #9ca3af;
            text-transform: uppercase;
            letter-spacing: 0.4px;
            margin-bottom: 1px;
        }

        .pkg-price {
            font-size: 20px;
            font-weight: 800;
            color: #111827;
            font-family: 'Segoe UI', sans-serif;
        }

        .btn-book-pkg {
            display: inline-block;
            background: #2b7be0;
            color: #fff;
            font-size: 13.5px;
            font-weight: 600;
            padding: 10px 22px;
            border-radius: 50px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.15s ease;
            white-space: nowrap;
        }

        .btn-book-pkg:hover {
            background: #1a65c9;
            transform: translateY(-1px);
            color: #fff;
            text-decoration: none;
        }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 1024px) {
            .pkg-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 768px) {
            .pkg-page-wrapper {
                padding: 20px 16px 40px;
            }

            .pkg-hero {
                height: 300px;
            }

            .pkg-hero-content {
                left: 24px;
                max-width: 320px;
            }

            .pkg-hero-content h1 {
                font-size: 30px;
            }

            .pkg-section-header h2 {
                font-size: 20px;
            }
        }

        @media (max-width: 580px) {
            .pkg-grid {
                grid-template-columns: 1fr;
            }

            .pkg-hero {
                height: 260px;
            }

            .pkg-hero-content h1 {
                font-size: 26px;
            }

            .pkg-hero-content p {
                display: none;
            }
        }
    </style>
@endpush

@section('content')
    <div class="pkg-page-wrapper">

        {{-- ===================== HERO ===================== --}}
        <div class="pkg-hero">
            <div class="pkg-hero-content">
                <h1>Explore Curated<br>Packages</h1>
                <p>
                    Capture curated landscapes urne mountorbids, explore bundallime I<br>
                    croline casce ornempanfisques.
                </p>
                <a href="#" class="btn-discover-more">Discover more</a>
            </div>
        </div>

        {{-- ===================== SECTION HEADER ===================== --}}
        <div class="pkg-section-header">
            <h2>Multi-Day Itineraries</h2>
            <button class="pkg-filter-btn" type="button">
                All Tours
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                    stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7" />
                </svg>
            </button>
        </div>

        {{-- ===================== PACKAGES GRID ===================== --}}
        <div class="pkg-grid">

            {{-- Card 1: Classic Nepal Adventure --}}
            <div class="pkg-card">
                <img src="https://images.unsplash.com/photo-1582653291997-079a1c04e5a1?w=700&q=80"
                    alt="Classic Nepal Adventure" class="pkg-card-img" />
                <div class="pkg-card-body">
                    <h3 class="pkg-card-title">Classic Nepal Adventure</h3>
                    <p class="pkg-card-subtitle">City Tours</p>

                    <div class="pkg-card-days">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        19 Days
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Inclusions</p>
                        <ul class="pkg-ie-list">
                            <li>Himalayan treks, World Heritage sites</li>
                        </ul>
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Exclusions</p>
                        <ul class="pkg-ie-list">
                            <li>Cultural museums</li>
                        </ul>
                    </div>

                    <div class="pkg-card-footer">
                        <div class="pkg-card-footer-left">
                            <span class="pkg-price-label">Starts from</span>
                            <span class="pkg-price">$30.00</span>
                        </div>
                        <a href="#" class="btn-book-pkg">Booking</a>
                    </div>
                </div>
            </div>

            {{-- Card 2: Himalayan Trek & Safari --}}
            <div class="pkg-card">
                <img src="https://images.unsplash.com/photo-1626016632784-7b9f22a0a92c?w=700&q=80"
                    alt="Himalayan Trek & Safari" class="pkg-card-img" />
                <div class="pkg-card-body">
                    <h3 class="pkg-card-title">Himalayan Trek & Safari</h3>
                    <p class="pkg-card-subtitle">10-Days</p>

                    <div class="pkg-card-days">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        14 Days
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Inclusions</p>
                        <ul class="pkg-ie-list">
                            <li>Gandakperi trek, Himalayan Trek, Chitwan</li>
                        </ul>
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Exclusions</p>
                        <ul class="pkg-ie-list">
                            <li>Madhunil mitrol exclusions</li>
                        </ul>
                    </div>

                    <div class="pkg-card-footer">
                        <div class="pkg-card-footer-left">
                            <span class="pkg-price-label">Starts from</span>
                            <span class="pkg-price">$115.00</span>
                        </div>
                        <a href="#" class="btn-book-pkg">Booking</a>
                    </div>
                </div>
            </div>

            {{-- Card 3: Spiritual Retreat --}}
            <div class="pkg-card">
                <img src="https://images.unsplash.com/photo-1508739773434-c26b3d09e071?w=700&q=80" alt="Spiritual Retreat"
                    class="pkg-card-img" />
                <div class="pkg-card-body">
                    <h3 class="pkg-card-title">Spiritual Retreat</h3>
                    <p class="pkg-card-subtitle">D-Tours</p>

                    <div class="pkg-card-days">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        17 Days
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Inclusions</p>
                        <ul class="pkg-ie-list">
                            <li>Kirtipupoors lets, Uncfafamdogas Sitruas</li>
                        </ul>
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Exclusions</p>
                        <ul class="pkg-ie-list">
                            <li>Cultural museums</li>
                        </ul>
                    </div>

                    <div class="pkg-card-footer">
                        <div class="pkg-card-footer-left">
                            <span class="pkg-price-label">Starts from</span>
                            <span class="pkg-price">$78.00</span>
                        </div>
                        <a href="#" class="btn-book-pkg">Booking</a>
                    </div>
                </div>
            </div>

            {{-- Card 4: Kathmandu Heritage Tour --}}
            <div class="pkg-card">
                <img src="https://images.unsplash.com/photo-1599974579688-8dbdd335c77f?w=700&q=80"
                    alt="Kathmandu Heritage Tour" class="pkg-card-img" />
                <div class="pkg-card-body">
                    <h3 class="pkg-card-title">Kathmandu Heritage Tour</h3>
                    <p class="pkg-card-subtitle">Cultural Tours</p>

                    <div class="pkg-card-days">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        7 Days
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Inclusions</p>
                        <ul class="pkg-ie-list">
                            <li>Pashupatinath, Boudhanath, Swayambhunath</li>
                        </ul>
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Exclusions</p>
                        <ul class="pkg-ie-list">
                            <li>International flights, visa fees</li>
                        </ul>
                    </div>

                    <div class="pkg-card-footer">
                        <div class="pkg-card-footer-left">
                            <span class="pkg-price-label">Starts from</span>
                            <span class="pkg-price">$55.00</span>
                        </div>
                        <a href="#" class="btn-book-pkg">Booking</a>
                    </div>
                </div>
            </div>

            {{-- Card 5: Green Valley Trek --}}
            <div class="pkg-card">
                <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=700&q=80" alt="Green Valley Trek"
                    class="pkg-card-img" />
                <div class="pkg-card-body">
                    <h3 class="pkg-card-title">Green Valley Trek</h3>
                    <p class="pkg-card-subtitle">Nature Tours</p>

                    <div class="pkg-card-days">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        11 Days
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Inclusions</p>
                        <ul class="pkg-ie-list">
                            <li>Langtang Valley, Gosainkunda Lake</li>
                        </ul>
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Exclusions</p>
                        <ul class="pkg-ie-list">
                            <li>Personal travel insurance</li>
                        </ul>
                    </div>

                    <div class="pkg-card-footer">
                        <div class="pkg-card-footer-left">
                            <span class="pkg-price-label">Starts from</span>
                            <span class="pkg-price">$90.00</span>
                        </div>
                        <a href="#" class="btn-book-pkg">Booking</a>
                    </div>
                </div>
            </div>

            {{-- Card 6: Mountain Scenic Tour --}}
            <div class="pkg-card">
                <img src="https://images.unsplash.com/photo-1516912481808-3406841bd33c?w=700&q=80"
                    alt="Mountain Scenic Tour" class="pkg-card-img" />
                <div class="pkg-card-body">
                    <h3 class="pkg-card-title">Mountain Scenic Tour</h3>
                    <p class="pkg-card-subtitle">Adventure Tours</p>

                    <div class="pkg-card-days">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                            stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        10 Days
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Inclusions</p>
                        <ul class="pkg-ie-list">
                            <li>Manaslu Circuit, mountain flights</li>
                        </ul>
                    </div>

                    <div class="pkg-ie-section">
                        <p class="pkg-ie-label">Exclusions</p>
                        <ul class="pkg-ie-list">
                            <li>Tips and gratuities</li>
                        </ul>
                    </div>

                    <div class="pkg-card-footer">
                        <div class="pkg-card-footer-left">
                            <span class="pkg-price-label">Starts from</span>
                            <span class="pkg-price">$140.00</span>
                        </div>
                        <a href="#" class="btn-book-pkg">Booking</a>
                    </div>
                </div>
            </div>

        </div>{{-- end .pkg-grid --}}

    </div>{{-- end .pkg-page-wrapper --}}
@endsection

@push('scripts')
    <script>
        // Filter button toggle (placeholder for future dropdown)
        document.querySelector('.pkg-filter-btn')?.addEventListener('click', function() {
            // Wire up your filter logic here
        });
    </script>
@endpush
