@extends('layouts.frontend')

@section('title', 'About Us - ApeakNepal')

@push('styles')
    <style>
        /* =============================================
                       ABOUT PAGE STYLES
                    ============================================= */

        .about-page-wrapper {
            background: #eae6de;
            min-height: 100vh;
            padding: 20px 32px 60px;
            max-width: 1200px;
            margin: 0 auto;
        }

        /* ---- HERO ---- */
        .about-hero {
            position: relative;
            width: 100%;
            height: 380px;
            border-radius: 18px;
            overflow: hidden;
            margin-bottom: 52px;
            background: url('https://images.unsplash.com/photo-1605640840605-14ac1855827b?w=1400&q=85') center 30% / cover no-repeat;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(to right,
                    rgba(8, 18, 50, 0.92) 0%,
                    rgba(8, 18, 50, 0.60) 42%,
                    rgba(8, 18, 50, 0.06) 100%);
            z-index: 1;
        }

        .about-hero-content {
            position: absolute;
            top: 50%;
            left: 52px;
            transform: translateY(-50%);
            z-index: 2;
            max-width: 430px;
        }

        .about-hero-content h1 {
            font-size: 44px;
            font-weight: 800;
            color: #ffffff;
            line-height: 1.15;
            margin: 0 0 14px 0;
            letter-spacing: -0.3px;
            font-family: 'Segoe UI', sans-serif;
        }

        .about-hero-content p {
            font-size: 13.5px;
            color: rgba(255, 255, 255, 0.78);
            line-height: 1.65;
            margin: 0 0 26px 0;
        }

        .btn-explore-nepal {
            display: inline-block;
            background: #2b7be0;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            padding: 11px 26px;
            border-radius: 50px;
            text-decoration: none;
            border: none;
            cursor: pointer;
            transition: background 0.2s ease, transform 0.15s ease;
        }

        .btn-explore-nepal:hover {
            background: #1a65c9;
            transform: translateY(-1px);
            color: #fff;
            text-decoration: none;
        }

        /* ---- SECTION: Our Local Heritage ---- */
        .about-heritage-section {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 52px;
            align-items: flex-start;
            margin-bottom: 60px;
            background: #fff;
            border-radius: 18px;
            padding: 40px 40px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .about-heritage-left h2 {
            font-size: 26px;
            font-weight: 800;
            color: #111827;
            margin: 0 0 16px 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .about-heritage-left p {
            font-size: 13.5px;
            color: #6b7280;
            line-height: 1.75;
            margin: 0;
        }

        /* Feature icon cards - right column */
        .about-heritage-right {
            display: flex;
            flex-direction: column;
            gap: 0;
            justify-content: center;
        }

        .about-feature-icons {
            display: flex;
            gap: 18px;
            flex-wrap: wrap;
        }

        .about-feature-icon-card {
            background: #f8f9ff;
            border: 1px solid #e8ecf8;
            border-radius: 12px;
            padding: 18px 16px 16px;
            flex: 1;
            min-width: 100px;
            text-align: center;
        }

        .about-feature-icon-card .icon-wrap {
            width: 44px;
            height: 44px;
            background: #ddeeff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 12px;
        }

        .about-feature-icon-card .icon-wrap svg {
            width: 22px;
            height: 22px;
            color: #2b7be0;
        }

        .about-feature-icon-card h4 {
            font-size: 13px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 6px 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .about-feature-icon-card p {
            font-size: 11.5px;
            color: #9ca3af;
            margin: 0;
            line-height: 1.5;
        }

        /* ---- SECTION: Meet Our Expert Guides ---- */
        .about-guides-section {
            display: grid;
            grid-template-columns: 1fr 1.15fr;
            gap: 44px;
            align-items: flex-start;
            margin-bottom: 60px;
            background: #fff;
            border-radius: 18px;
            padding: 40px 40px;
            box-shadow: 0 2px 12px rgba(0, 0, 0, 0.06);
        }

        .about-guides-img {
            width: 100%;
            height: 320px;
            object-fit: cover;
            border-radius: 14px;
            display: block;
        }

        .about-guides-right h2 {
            font-size: 26px;
            font-weight: 800;
            color: #111827;
            margin: 0 0 14px 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .about-guides-right>p {
            font-size: 13.5px;
            color: #6b7280;
            line-height: 1.75;
            margin: 0 0 26px 0;
        }

        .about-guides-cards {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
        }

        .about-guide-card {
            background: #ffffff;
            border: 1.5px solid #e5e7eb;
            border-radius: 12px;
            padding: 18px 16px 16px;
            flex: 1;
            min-width: 110px;
            text-align: center;
            box-shadow: 0 1px 6px rgba(0, 0, 0, 0.05);
        }

        .about-guide-card .icon-wrap {
            width: 42px;
            height: 42px;
            background: #ddeeff;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 10px;
        }

        .about-guide-card .icon-wrap svg {
            width: 20px;
            height: 20px;
            color: #2b7be0;
        }

        .about-guide-card h4 {
            font-size: 12.5px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 5px 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .about-guide-card p {
            font-size: 11px;
            color: #9ca3af;
            margin: 0;
            line-height: 1.5;
        }

        /* ---- SECTION: Meet Our Features (heading visible in image bottom) ---- */
        .about-features-heading {
            text-align: center;
            font-size: 26px;
            font-weight: 800;
            color: #111827;
            margin: 0 0 28px 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .about-features-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
        }

        .about-feat-card {
            background: #fff;
            border-radius: 14px;
            padding: 28px 22px 24px;
            text-align: center;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.06);
            border: 1px solid #f0f0f0;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .about-feat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
        }

        .about-feat-card .feat-icon {
            width: 52px;
            height: 52px;
            background: #ddeeff;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
        }

        .about-feat-card .feat-icon svg {
            width: 26px;
            height: 26px;
            color: #2b7be0;
        }

        .about-feat-card h4 {
            font-size: 15px;
            font-weight: 700;
            color: #111827;
            margin: 0 0 8px 0;
            font-family: 'Segoe UI', sans-serif;
        }

        .about-feat-card p {
            font-size: 13px;
            color: #6b7280;
            margin: 0;
            line-height: 1.6;
        }

        /* ---- RESPONSIVE ---- */
        @media (max-width: 900px) {

            .about-heritage-section,
            .about-guides-section {
                grid-template-columns: 1fr;
                gap: 28px;
                padding: 28px 24px;
            }

            .about-features-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 640px) {
            .about-page-wrapper {
                padding: 16px 14px 40px;
            }

            .about-hero {
                height: 260px;
            }

            .about-hero-content {
                left: 22px;
                max-width: 280px;
            }

            .about-hero-content h1 {
                font-size: 28px;
            }

            .about-hero-content p {
                display: none;
            }

            .about-feature-icons,
            .about-guides-cards {
                flex-direction: column;
            }

            .about-features-grid {
                grid-template-columns: 1fr;
            }

            .about-guides-img {
                height: 220px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="about-page-wrapper">

        {{-- ===================== HERO ===================== --}}
        <div class="about-hero">
            <div class="about-hero-content">
                <h1>About Visit Nepal</h1>
                <p>
                    Nepal trennasdens daptittudindchar ennords and<br>
                    eroc nos butrelerlerlerenleratmos.
                </p>
                <a href="#" class="btn-explore-nepal">Explore Nepal</a>
            </div>
        </div>

        {{-- ===================== OUR LOCAL HERITAGE ===================== --}}
        <div class="about-heritage-section">

            {{-- Left: text --}}
            <div class="about-heritage-left">
                <h2>Our Local Heritage</h2>
                <p>
                    Our omplete story of ores conesoation edigning ore ve
                    nunbery icornu troupons and assoclates, wol natnopine
                    ernosta osbo ona noe oeinent ounumen fona oce oratners
                    oobon onan osing onoful nuobo ol ounima out nuoos olemar
                    oobfatanneum olber loa ottmoioa oubeios nes onooationa boe
                    enu ou oaer oer iclong aenoicumer amonnaceve al ocal
                    ouios mrntusa.
                </p>
            </div>

            {{-- Right: icon feature cards --}}
            <div class="about-heritage-right">
                <div class="about-feature-icons">

                    <div class="about-feature-icon-card">
                        <div class="icon-wrap">
                            {{-- Location/Map pin icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h4>Local Knowledge</h4>
                        <p>Lcorn onorotasmel local knowledge.</p>
                    </div>

                    <div class="about-feature-icon-card">
                        <div class="icon-wrap">
                            {{-- People/Group icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h4>Conservation</h4>
                        <p>Oanamanon front onuonos.</p>
                    </div>

                    <div class="about-feature-icon-card">
                        <div class="icon-wrap">
                            {{-- Shield/Safety icon --}}
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h4>Safety</h4>
                        <p>Tour toeocurity and satisfaction.</p>
                    </div>

                </div>
            </div>

        </div>{{-- end .about-heritage-section --}}

        {{-- ===================== MEET OUR EXPERT GUIDES ===================== --}}
        <div class="about-guides-section">

            {{-- Left: photo --}}
            <div>
                <img src="https://images.unsplash.com/photo-1587502537745-84b86da1204f?w=800&q=80" alt="Our Expert Guides"
                    class="about-guides-img" />
            </div>

            {{-- Right: text + cards --}}
            <div class="about-guides-right">
                <h2>Meet Our Expert Guides</h2>
                <p>
                    Nbo dunnunnuruntu dnuunintunonabunohtot chee guide
                    bepape oapn oobe and porclebbloos oa ontobles and
                    oaonon oona oanuaenppades pn oudonboa partecng
                    backoction nue ob no nbocotos ob oun ots oan aaot at
                    natice oaoct ob natnoocione ouoatna thos, ondipcotiome
                    patrno mates ang-bataiuns.
                </p>

                <div class="about-guides-cards">

                    <div class="about-guide-card">
                        <div class="icon-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h4>Local<br>Knowledge</h4>
                        <p>L one oabrots odor post thorosunge.</p>
                    </div>

                    <div class="about-guide-card">
                        <div class="icon-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                        </div>
                        <h4>Conservation</h4>
                        <p>Dartnn conest fubrobiton.</p>
                    </div>

                    <div class="about-guide-card">
                        <div class="icon-wrap">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                                stroke-width="2">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                            </svg>
                        </div>
                        <h4>Safety</h4>
                        <p>Tour toeocurity and futurbotion.</p>
                    </div>

                </div>
            </div>

        </div>{{-- end .about-guides-section --}}

        {{-- ===================== MEET OUR FEATURES ===================== --}}
        <h2 class="about-features-heading">Meet Our Features</h2>

        <div class="about-features-grid">

            <div class="about-feat-card">
                <div class="feat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M3.055 11H5a2 2 0 012 2v1a2 2 0 002 2 2 2 0 012 2v2.945M8 3.935V5.5A2.5 2.5 0 0010.5 8h.5a2 2 0 012 2 2 2 0 104 0 2 2 0 012-2h1.064M15 20.488V18a2 2 0 012-2h3.064" />
                    </svg>
                </div>
                <h4>Expert Local Guides</h4>
                <p>Certified Nepali guides with deep mountain knowledge and cultural insight.</p>
            </div>

            <div class="about-feat-card">
                <div class="feat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z" />
                    </svg>
                </div>
                <h4>Safety First</h4>
                <p>Your security and satisfaction is our priority on every trek and tour.</p>
            </div>

            <div class="about-feat-card">
                <div class="feat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                    </svg>
                </div>
                <h4>Conservation</h4>
                <p>We preserve Nepal's natural beauty and support local communities.</p>
            </div>

            <div class="about-feat-card">
                <div class="feat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <h4>Best Value</h4>
                <p>Competitive pricing with transparent costs and no hidden fees.</p>
            </div>

            <div class="about-feat-card">
                <div class="feat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                    </svg>
                </div>
                <h4>24/7 Support</h4>
                <p>Round the clock assistance throughout your journey in Nepal.</p>
            </div>

            <div class="about-feat-card">
                <div class="feat-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor"
                        stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z" />
                    </svg>
                </div>
                <h4>Unique Experiences</h4>
                <p>Curated adventures that go beyond the ordinary tourist trail.</p>
            </div>

        </div>{{-- end .about-features-grid --}}

    </div>{{-- end .about-page-wrapper --}}
@endsection
