@extends('layouts.app')
@section('title', 'Packages – Visit Nepal')

@section('content')
<div style="position:relative;height:60vh;overflow:hidden;">
    <img src="{{ $package['img'] }}" alt="{{ $package['name'] }}"
         style="width:100%;height:100%;object-fit:cover;" id="pkgHeroBg">
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(3,8,16,.2),rgba(3,8,16,.82));"></div>
    <div style="position:absolute;bottom:3rem;left:50%;transform:translateX(-50%);text-align:center;width:100%;padding:0 2rem;">
        <span style="display:inline-flex;align-items:center;gap:8px;background:rgba(232,160,32,.9);
                     color:#fff;padding:6px 16px;border-radius:50px;font-size:.78rem;font-weight:700;
                     letter-spacing:.06em;text-transform:uppercase;margin-bottom:1rem;">
            {{ $package['badge'] }}
        </span>
        <h1 style="font-family:'Cinzel',serif;font-size:clamp(2rem,6vw,4rem);color:#fff;font-weight:900;">
            {{ $package['name'] }}
        </h1>
        <div style="display:flex;gap:2rem;justify-content:center;flex-wrap:wrap;margin-top:1rem;">
            <span style="color:rgba(255,255,255,.7);"><i class="fas fa-clock" style="color:var(--nepal-gold);margin-right:6px;"></i>{{ $package['days'] }} Days</span>
            <span style="color:rgba(255,255,255,.7);"><i class="fas fa-dollar-sign" style="color:var(--nepal-gold);margin-right:6px;"></i>From ${{ number_format($package['price']) }}</span>
        </div>
    </div>
</div>

<div style="max-width:1100px;margin:0 auto;padding:5rem 2rem;">
    <div style="display:grid;grid-template-columns:1.6fr 1fr;gap:3rem;align-items:start;">

        <div>
            <h2 style="font-family:'Cinzel',serif;font-size:1.6rem;color:#fff;margin-bottom:1rem;" data-aos="fade-right">
                Package <span style="color:var(--nepal-gold);">Overview</span>
            </h2>
            <p style="color:rgba(255,255,255,.6);font-size:.98rem;line-height:1.85;margin-bottom:2rem;" data-aos="fade-right" data-aos-delay="100">
                {{ $package['description'] }}
            </p>

            <h3 style="font-family:'Cinzel',serif;color:#fff;font-size:1.2rem;margin-bottom:1.2rem;" data-aos="fade-right" data-aos-delay="150">
                <i class="fas fa-route" style="color:var(--nepal-gold);margin-right:8px;"></i> Itinerary
            </h3>
            <div style="border-left:2px solid rgba(232,160,32,.3);padding-left:1.5rem;">
                @foreach($package['itinerary'] as $day => $activity)
                <div style="margin-bottom:1.2rem;position:relative;" class="pkg-itinerary-item" data-aos="fade-right">
                    <div style="position:absolute;left:-1.94rem;top:.3rem;width:10px;height:10px;
                                background:var(--nepal-gold);border-radius:50%;border:2px solid var(--deep-navy);"></div>
                    <div style="font-family:'Cinzel',serif;color:var(--nepal-gold);font-size:.78rem;letter-spacing:.1em;text-transform:uppercase;margin-bottom:3px;">
                        {{ $day }}
                    </div>
                    <div style="color:rgba(255,255,255,.7);font-size:.88rem;line-height:1.6;">{{ $activity }}</div>
                </div>
                @endforeach
                </div>
        </div>

        <!-- Booking sidebar -->
        <div style="position:sticky;top:90px;">
            <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.1);border-radius:20px;padding:2rem;" data-aos="fade-left">
                <div style="text-align:center;margin-bottom:1.5rem;">
                    <div style="font-family:'Cinzel',serif;font-size:2.5rem;font-weight:700;color:var(--nepal-gold);">
                        ${{ number_format($package['price']) }}
                    </div>
                    <div style="color:rgba(255,255,255,.4);font-size:.82rem;">per person</div>
                </div>
                <a href="{{ route('booking.create', $package['slug']) }}" class="btn-gold"
                   style="width:100%;justify-content:center;margin-bottom:1rem;">
                    <i class="fas fa-calendar-check"></i> Book This Package
                </a>
                <a href="{{ route('contact') }}" class="btn-outline"
                   style="width:100%;justify-content:center;">
                    <i class="fas fa-comments"></i> Enquire Now
                </a>
                <div style="margin-top:1.8rem;padding-top:1.5rem;border-top:1px solid rgba(255,255,255,.07);">
                    <h4 style="font-family:'Cinzel',serif;color:#fff;font-size:.9rem;margin-bottom:1rem;">
                        <i class="fas fa-check-circle" style="color:var(--nepal-gold);margin-right:6px;"></i> Includes
                    </h4>
                    <ul style="list-style:none;">
                        @foreach($package['services'] as $svc)
                        <li style="display:flex;align-items:center;gap:8px;color:rgba(255,255,255,.6);font-size:.84rem;margin-bottom:.6rem;">
                            <i class="fas fa-check" style="color:#4ade80;font-size:.75rem;"></i> {{ $svc }}
                        </li>
                        @endforeach
                        </ul>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
@section('scripts')
<script>
gsap.registerPlugin(ScrollTrigger);
gsap.to('#pkgHeroBg', {
    yPercent:25, ease:'none',
    scrollTrigger:{ trigger:'div', start:'top top', end:'70% top', scrub:true }
});
gsap.from('.pkg-itinerary-item', {
    scrollTrigger:{ trigger:'.pkg-itinerary-item', start:'top 85%', once:true },
    x:-40, opacity:0, stagger:.07, duration:.6, ease:'power3.out'
});
</script>
@endsection