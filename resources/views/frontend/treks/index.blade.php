@extends('layouts.frontend')
@section('title', 'All Treks – Visit Nepal')
@section('content')
    <section style="padding:9rem 2rem 7rem;">
        <div style="max-width:1280px;margin:0 auto;">

            <div style="text-align:center;margin-bottom:3.5rem;">
                <div class="section-badge" data-aos="fade-up">
                    <i class="fas fa-hiking"></i> All Treks
                </div>
                <h1 class="section-title" data-aos="fade-up" data-aos-delay="100">
                    Top <span>Trekking Plans</span>
                </h1>
            </div>

            <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(340px,1fr));gap:2rem;">
                @foreach ($treks as $trek)
                    <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);
                        border-radius:18px;overflow:hidden;transition:all .4s cubic-bezier(.23,1,.32,1);"
                        class="trek-index-card" data-aos="fade-up" data-aos-delay="{{ $trek['delay'] }}">

                        <div style="position:relative;height:240px;overflow:hidden;">
                            <img src="{{ $trek['img'] }}" alt="{{ $trek['name'] }}"
                                style="width:100%;height:100%;object-fit:cover;transition:transform .7s ease;">
                            <div
                                style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 40%,rgba(3,8,16,.8) 100%);">
                            </div>
                            <span
                                style="position:absolute;top:1rem;left:1rem;padding:5px 14px;border-radius:50px;
                                 font-size:.72rem;font-weight:600;
                                 {{ $trek['difficulty'] === 'Easy'
                                     ? 'background:rgba(34,197,94,.2);border:1px solid rgba(34,197,94,.5);color:#4ade80;'
                                     : 'background:rgba(245,200,66,.2);border:1px solid rgba(245,200,66,.5);color:#f5c842;' }}">
                                {{ $trek['difficulty'] }}
                            </span>
                        </div>

                        <div style="padding:1.8rem;">
                            <h3 style="font-family:'Cinzel',serif;color:#fff;font-size:1.1rem;margin-bottom:1rem;">
                                {{ $trek['name'] }}
                            </h3>

                            <div style="display:flex;gap:1.5rem;flex-wrap:wrap;margin-bottom:1rem;">
                                <span
                                    style="display:flex;align-items:center;gap:6px;color:rgba(255,255,255,.5);font-size:.82rem;">
                                    <i class="fas fa-calendar-alt" style="color:var(--nepal-gold);"></i> {{ $trek['days'] }}
                                    Days
                                </span>
                                <span
                                    style="display:flex;align-items:center;gap:6px;color:rgba(255,255,255,.5);font-size:.82rem;">
                                    <i class="fas fa-mountain" style="color:var(--nepal-gold);"></i>
                                    {{ $trek['max_altitude'] }}
                                </span>
                                <span
                                    style="display:flex;align-items:center;gap:6px;color:rgba(255,255,255,.5);font-size:.82rem;">
                                    <i class="fas fa-map-marker-alt" style="color:var(--nepal-gold);"></i>
                                    {{ $trek['start'] }}
                                </span>
                            </div>

                            <p style="color:rgba(255,255,255,.5);font-size:.85rem;line-height:1.7;margin-bottom:1.5rem;">
                                {{ $trek['description'] }}
                            </p>

                            <div
                                style="display:flex;justify-content:space-between;align-items:center;
                                border-top:1px solid rgba(255,255,255,.07);padding-top:1.2rem;">
                                <div
                                    style="font-family:'Cinzel',serif;font-size:1.4rem;font-weight:700;color:var(--nepal-gold);">
                                    ${{ number_format($trek['price']) }}
                                    <span
                                        style="font-size:.75rem;color:rgba(255,255,255,.4);font-family:'Raleway',sans-serif;font-weight:400;">/
                                        person</span>
                                </div>
                                <a href="{{ route('treks.show', $trek['slug']) }}" class="btn-primary"
                                    style="padding:10px 20px;font-size:.82rem;">
                                    View Details <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <style>
        .trek-index-card:hover {
            border-color: rgba(232, 160, 32, .35) !important;
            transform: translateY(-10px);
            box-shadow: 0 30px 60px rgba(0, 0, 0, .45);
        }

        .trek-index-card:hover img {
            transform: scale(1.1);
        }
    </style>
@endsection
