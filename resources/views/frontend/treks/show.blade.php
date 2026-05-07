@extends('layouts.app')
@section('title', $trek['name'] . ' – Visit Nepal')
@section('content')
<!-- Hero -->
<div style="position:relative;height:65vh;overflow:hidden;">
    <img src="{{ $trek['img'] }}" alt="{{ $trek['name'] }}"
         style="width:100%;height:100%;object-fit:cover;" id="trekHeroBg">
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(3,8,16,.1),rgba(3,8,16,.8));"></div>
    <div style="position:absolute;bottom:3rem;left:50%;transform:translateX(-50%);text-align:center;width:100%;padding:0 2rem;">
        <span style="display:inline-flex;align-items:center;gap:8px;background:rgba(232,160,32,.12);
                     border:1px solid rgba(232,160,32,.3);color:var(--nepal-gold);padding:6px 16px;
                     border-radius:50px;font-size:.75rem;font-weight:600;letter-spacing:.12em;
                     text-transform:uppercase;margin-bottom:1rem;" data-aos="fade-up">
            <i class="fas fa-hiking"></i> Trek
        </span>
        <h1 style="font-family:'Cinzel',serif;font-size:clamp(2rem,6vw,4rem);color:#fff;font-weight:900;" data-aos="fade-up" data-aos-delay="100">
            {{ $trek['name'] }}
        </h1>
        <div style="display:flex;gap:2rem;justify-content:center;flex-wrap:wrap;margin-top:1rem;" data-aos="fade-up" data-aos-delay="200">
            <span style="color:rgba(255,255,255,.7);font-size:.9rem;">
                <i class="fas fa-calendar-alt" style="color:var(--nepal-gold);margin-right:6px;"></i> {{ $trek['days'] }} Days
            </span>
            <span style="color:rgba(255,255,255,.7);font-size:.9rem;">
                <i class="fas fa-mountain" style="color:var(--nepal-gold);margin-right:6px;"></i> {{ $trek['max_altitude'] }}
            </span>
            <span style="color:rgba(255,255,255,.7);font-size:.9rem;">
                <i class="fas fa-signal" style="color:var(--nepal-gold);margin-right:6px;"></i> {{ $trek['difficulty'] }}
            </span>
            <span style="color:rgba(255,255,255,.7);font-size:.9rem;">
                <i class="fas fa-sun" style="color:var(--nepal-gold);margin-right:6px;"></i> {{ $trek['best_season'] }}
            </span>
        </div>
    </div>
</div>

<!-- Content -->
<div style="max-width:1100px;margin:0 auto;padding:5rem 2rem;">

    <div style="display:grid;grid-template-columns:1.6fr 1fr;gap:3rem;align-items:start;">

        <!-- Left: description + itinerary -->
        <div>
            <h2 style="font-family:'Cinzel',serif;font-size:1.6rem;color:#fff;margin-bottom:1rem;" data-aos="fade-right">
                About This <span style="color:var(--nepal-gold);">Trek</span>
            </h2>
            <p style="color:rgba(255,255,255,.6);font-size:.98rem;line-height:1.85;margin-bottom:2rem;" data-aos="fade-right" data-aos-delay="100">
                {{ $trek['description'] }}
            </p>

            <!-- Itinerary -->
            <h3 style="font-family:'Cinzel',serif;color:#fff;font-size:1.2rem;margin-bottom:1.2rem;" data-aos="fade-right" data-aos-delay="150">
                <i class="fas fa-route" style="color:var(--nepal-gold);margin-right:8px;"></i> Day-by-Day Itinerary
            </h3>
            <div style="border-left:2px solid rgba(232,160,32,.3);padding-left:1.5rem;">
                @foreach($trek['itinerary'] as $day => $activity)
                <div style="margin-bottom:1.2rem;position:relative;" class="itinerary-item" data-aos="fade-right">
                    <div style="position:absolute;left:-1.94rem;top:.3rem;width:10px;height:10px;
                                background:var(--nepal-gold);border-radius:50%;border:2px solid var(--deep-navy);"></div>
                    <div style="font-family:'Cinzel',serif;color:var(--nepal-gold);font-size:.78rem;
                                letter-spacing:.1em;text-transform:uppercase;margin-bottom:3px;">
                        {{ $day }}
                    </div>
                    <div style="color:rgba(255,255,255,.7);font-size:.88rem;line-height:1.6;">
                        {{ $activity }}
                    </div>
                </div>
                @endforeach
                </div>
        </div>

        <!-- Right: price box + includes -->
        <div style="position:sticky;top:90px;">
            <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);
                        border-radius:20px;padding:2rem;" data-aos="fade-left">
                <div style="text-align:center;margin-bottom:1.5rem;">
                    <div style="font-family:'Cinzel',serif;font-size:2.5rem;font-weight:700;color:var(--nepal-gold);">
                        ${{ number_format($trek['price']) }}
                    </div>
                    <div style="color:rgba(255,255,255,.4);font-size:.82rem;">per person</div>
                </div>

                <a href="{{ route('booking.create', $trek['slug']) }}" class="btn-gold"
                   style="width:100%;justify-content:center;margin-bottom:1rem;">
                    <i class="fas fa-calendar-check"></i> Book This Trek
                </a>
                <a href="{{ route('contact') }}" class="btn-outline"
                   style="width:100%;justify-content:center;">
                    <i class="fas fa-comments"></i> Ask a Question
                </a>

                <div style="margin-top:1.8rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,.07);">
                    <h4 style="font-family:'Cinzel',serif;color:#fff;font-size:.9rem;margin-bottom:1rem;">
                        <i class="fas fa-check-circle" style="color:var(--nepal-gold);margin-right:6px;"></i> Includes
                    </h4>
                    <ul style="list-style:none;">
                        @foreach($trek['includes'] as $item)
                        <li style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,.6);
                                   font-size:.84rem;margin-bottom:.6rem;">
                            <i class="fas fa-check" style="color:#4ade80;font-size:.75rem;"></i>
                            {{ $item }}
                        </li>
                        @endforeach
                        </ul>
                </div>
            </div>
        </div>

    </div>

    <!-- Other treks -->
    <div style="margin-top:5rem;" data-aos="fade-up">
        <h2 style="font-family:'Cinzel',serif;font-size:1.4rem;color:#fff;margin-bottom:1.5rem;">
            Other <span style="color:var(--nepal-gold);">Treks</span>
        </h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(260px,1fr));gap:1.2rem;">
            @foreach($treks as $other)
            @if($other['slug'] !== $trek['slug'])
            <a href="{{ route('treks.show', $other['slug']) }}"
               style="text-decoration:none;background:rgba(255,255,255,.03);
                      border:1px solid rgba(255,255,255,.08);border-radius:14px;
                      overflow:hidden;display:block;transition:all .4s;" class="other-trek-card">
                <img src="{{ $other['img'] }}" alt="{{ $other['name'] }}"
                     style="width:100%;height:140px;object-fit:cover;transition:transform .6s;">
                <div style="padding:1rem;">
                    <h4 style="font-family:'Cinzel',serif;color:#fff;font-size:.92rem;margin-bottom:4px;">{{ $other['name'] }}</h4>
                    <span style="color:rgba(255,255,255,.4);font-size:.78rem;">{{ $other['days'] }} days · ${{ number_format($other['price']) }}</span>
                </div>
            </a>
            @endif
            @endforeach
            </div>
    </div>
</div>

<style>
.other-trek-card:hover { border-color:rgba(232,160,32,.3)!important; transform:translateY(-6px); box-shadow:0 20px 40px rgba(0,0,0,.35); }
.other-trek-card:hover img { transform:scale(1.1); }
</style>
@endsection
@section('scripts')
<script>
gsap.registerPlugin(ScrollTrigger);
gsap.to('#trekHeroBg', {
    yPercent:25, ease:'none',
    scrollTrigger:{ trigger:'div', start:'top top', end:'70% top', scrub:true }
});
gsap.from('.itinerary-item', {
    scrollTrigger:{ trigger:'.itinerary-item', start:'top 85%', once:true },
    x:-40, opacity:0, stagger:.07, duration:.6, ease:'power3.out'
});
</script>
@endsection