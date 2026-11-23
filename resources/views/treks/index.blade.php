
@extends('layouts.app')

@section('title', 'All Treks – Visit Nepal')

@section('content')

<section class="trek-page">

    <div class="trek-container">

        <div class="trek-heading">
            <div class="section-badge" data-aos="fade-up">
                <i class="fas fa-hiking"></i> All Treks
            </div>

            <h1 class="section-title" data-aos="fade-up" data-aos-delay="100">
                Top <span>Trekking Plans</span>
            </h1>

            <p class="trek-subtitle">
                Discover the breathtaking Himalayas and explore
                unforgettable trekking experiences in Nepal.
            </p>
        </div>

        <div class="trek-grid">

            @foreach($treks as $trek)

            <div class="trek-index-card"
                 data-aos="fade-up"
                 data-aos-delay="{{ $trek['delay'] }}">

                <div class="trek-image">

                    <img src="{{ $trek['img'] }}"
                         alt="{{ $trek['name'] }}">

                    <div class="image-overlay"></div>

                    <span class="difficulty-badge
                        {{ $trek['difficulty'] === 'Easy' ? 'easy' : 'challenging' }}">
                        {{ $trek['difficulty'] }}
                    </span>

                </div>

                <div class="trek-content">

                    <h3>{{ $trek['name'] }}</h3>

                    <div class="trek-meta">

                        <span>
                            <i class="fas fa-calendar-alt"></i>
                            {{ $trek['days'] }} Days
                        </span>

                        <span>
                            <i class="fas fa-mountain"></i>
                            {{ $trek['max_altitude'] }}
                        </span>

                        <span>
                            <i class="fas fa-map-marker-alt"></i>
                            {{ $trek['start'] }}
                        </span>

                    </div>

                    <p class="trek-description">
                        {{ $trek['description'] }}
                    </p>

                    <div class="trek-footer">

                        <div class="trek-price">
                            ${{ number_format($trek['price']) }}

                            <span>/ person</span>
                        </div>

                        <a href="{{ route('treks.show', $trek['slug']) }}"
                           class="btn-primary">
                            View Details
                            <i class="fas fa-arrow-right"></i>
                        </a>

                    </div>

                </div>

            </div>

            @endforeach

        </div>

    </div>

</section>

<style>

/* FULL PAGE */

.trek-page {
    width: 100%;
    min-height: 100vh;
    padding: 130px 0 90px;
    overflow: hidden;
}

/* FULL WIDTH CONTAINER */

.trek-container {
    width: 100%;
    max-width: 100%;
    margin: 0 auto;
    padding: 0 clamp(20px, 4vw, 75px);
}

/* HEADING */

.trek-heading {
    text-align: center;
    margin-bottom: 65px;
}

.trek-subtitle {
    max-width: 650px;
    margin: 18px auto 0;
    color: rgba(255,255,255,.6);
    font-size: 1rem;
    line-height: 1.8;
}

/* TREK GRID */

.trek-grid {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 30px;
    width: 100%;
}

/* CARDS */

.trek-index-card {
    background: rgba(255,255,255,.03);
    border: 1px solid rgba(255,255,255,.08);
    border-radius: 20px;
    overflow: hidden;
    transition: all .4s cubic-bezier(.23,1,.32,1);
    min-width: 0;
}

.trek-index-card:hover {
    border-color: rgba(232,160,32,.5);
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0,0,0,.35);
}

/* BIGGER IMAGES */

.trek-image {
    position: relative;
    width: 100%;
    height: clamp(280px, 25vw, 420px);
    overflow: hidden;
}

.trek-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
    transition: transform .7s ease;
}

.trek-index-card:hover .trek-image img {
    transform: scale(1.08);
}

.image-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(
        180deg,
        transparent 40%,
        rgba(3,8,16,.65) 100%
    );
}

/* DIFFICULTY */

.difficulty-badge {
    position: absolute;
    top: 20px;
    left: 20px;
    padding: 7px 17px;
    border-radius: 50px;
    font-size: .78rem;
    font-weight: 600;
    z-index: 2;
}

.difficulty-badge.easy {
    background: rgba(34,197,94,.2);
    border: 1px solid rgba(34,197,94,.5);
    color: #4ade80;
}

.difficulty-badge.challenging {
    background: rgba(245,200,66,.2);
    border: 1px solid rgba(245,200,66,.5);
    color: #f5c842;
}

/* CONTENT */

.trek-content {
    padding: 28px;
}

.trek-content h3 {
    font-family: 'Cinzel', serif;
    color: #fff;
    font-size: 1.25rem;
    margin-bottom: 20px;
}

.trek-meta {
    display: flex;
    flex-wrap: wrap;
    gap: 15px;
    margin-bottom: 20px;
}

.trek-meta span {
    display: flex;
    align-items: center;
    gap: 7px;
    color: rgba(255,255,255,.6);
    font-size: .85rem;
}

.trek-meta i {
    color: var(--nepal-gold);
}

.trek-description {
    color: rgba(255,255,255,.55);
    font-size: .9rem;
    line-height: 1.8;
    margin-bottom: 25px;
}

.trek-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    gap: 15px;
    flex-wrap: wrap;
    border-top: 1px solid rgba(255,255,255,.08);
    padding-top: 22px;
}

.trek-price {
    font-family: 'Cinzel', serif;
    font-size: 1.6rem;
    font-weight: 700;
    color: var(--nepal-gold);
}

.trek-price span {
    font-family: 'Raleway', sans-serif;
    font-size: .8rem;
    color: rgba(255,255,255,.4);
    font-weight: 400;
}

.trek-footer .btn-primary {
    padding: 12px 22px;
    font-size: .85rem;
    white-space: nowrap;
}

/* TABLET */

@media (max-width: 1100px) {
    .trek-grid {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .trek-image {
        height: 320px;
    }
}

/* MOBILE */

@media (max-width: 650px) {

    .trek-page {
        padding: 110px 0 50px;
    }

    .trek-container {
        padding: 0 16px;
    }

    .trek-heading {
        margin-bottom: 35px;
    }

    .trek-grid {
        grid-template-columns: 1fr;
        gap: 25px;
    }

    .trek-image {
        height: 280px;
    }

    .trek-content {
        padding: 22px;
    }

    .trek-footer {
        align-items: flex-start;
    }
}

</style>

@endsection
