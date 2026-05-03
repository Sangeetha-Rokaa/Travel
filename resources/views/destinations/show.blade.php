@extends('layouts.app')
@section('title', $destination['name'] . ' – Visit Nepal')
@section('content')
<!-- Hero -->
<div style="position:relative;height:70vh;overflow:hidden;">
    <img src="{{ $destination['img'] }}" alt="{{ $destination['name'] }}"
         style="width:100%;height:100%;object-fit:cover;" id="destHeroBg">
    <div style="position:absolute;inset:0;background:linear-gradient(180deg,rgba(3,8,16,.2) 0%,rgba(3,8,16,.75) 100%);"></div>
    <div style="position:absolute;bottom:3rem;left:50%;transform:translateX(-50%);text-align:center;width:100%;padding:0 2rem;">
        <div class="section-badge" style="margin:0 auto 1rem;" id="destBadge">
            <i class="fas fa-map-marker-alt"></i> {{ $destination['tag'] }}
        </div>
        <h1 style="font-family:'Cinzel',serif;font-size:clamp(2.5rem,8vw,5.5rem);color:#fff;
                   font-weight:900;text-shadow:0 4px 30px rgba(0,0,0,.6);" id="destTitle">
            {{ $destination['name'] }}
        </h1>
        <p style="color:rgba(255,255,255,.7);font-size:1.1rem;letter-spacing:.1em;margin-top:.5rem;" id="destLabel">
            {{ $destination['label'] }}
        </p>
    </div>
</div>

<!-- Body -->
<div style="max-width:1100px;margin:0 auto;padding:5rem 2rem;">

    <!-- Quick facts row -->
    <div style="display:flex;gap:2rem;flex-wrap:wrap;margin-bottom:3rem;" data-aos="fade-up">
        <div style="flex:1;min-width:200px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);
                    border-radius:16px;padding:1.5rem;text-align:center;">
            <i class="fas fa-mountain" style="color:var(--nepal-gold);font-size:1.5rem;"></i>
            <div style="font-family:'Cinzel',serif;color:#fff;font-size:1.1rem;margin:.5rem 0 .3rem;">{{ $destination['altitude'] }}</div>
            <div style="color:rgba(255,255,255,.4);font-size:.78rem;text-transform:uppercase;letter-spacing:.1em;">Altitude</div>
        </div>
        <div style="flex:1;min-width:200px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);
                    border-radius:16px;padding:1.5rem;text-align:center;">
            <i class="fas fa-sun" style="color:var(--nepal-gold);font-size:1.5rem;"></i>
            <div style="font-family:'Cinzel',serif;color:#fff;font-size:1rem;margin:.5rem 0 .3rem;">{{ $destination['best_time'] }}</div>
            <div style="color:rgba(255,255,255,.4);font-size:.78rem;text-transform:uppercase;letter-spacing:.1em;">Best Season</div>
        </div>
        <div style="flex:1;min-width:200px;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);
                    border-radius:16px;padding:1.5rem;text-align:center;">
            <i class="fas fa-star" style="color:var(--nepal-gold);font-size:1.5rem;"></i>
            <div style="font-family:'Cinzel',serif;color:#fff;font-size:1rem;margin:.5rem 0 .3rem;">{{ count($destination['highlights']) }}+ Sites</div>
            <div style="color:rgba(255,255,255,.4);font-size:.78rem;text-transform:uppercase;letter-spacing:.1em;">Highlights</div>
        </div>
    </div>

    <!-- Description + highlights grid -->
    <div style="display:grid;grid-template-columns:1.5fr 1fr;gap:3rem;align-items:start;margin-bottom:4rem;">
        <div data-aos="fade-right">
            <h2 style="font-family:'Cinzel',serif;font-size:1.8rem;color:#fff;margin-bottom:1.2rem;">
                About <span style="color:var(--nepal-gold);">{{ $destination['name'] }}</span>
            </h2>
            <p style="color:rgba(255,255,255,.6);font-size:1rem;line-height:1.85;">
                {{ $destination['description'] }}
            </p>
            <div style="margin-top:2rem;display:flex;gap:1rem;flex-wrap:wrap;">
                <a href="{{ route('packages.index') }}" class="btn-primary">
                    <i class="fas fa-suitcase"></i> View Packages
                </a>
                <a href="{{ route('treks.index') }}" class="btn-outline">
                    <i class="fas fa-hiking"></i> Treks Here
                </a>
            </div>
        </div>

        <div data-aos="fade-left">
            <h3 style="font-family:'Cinzel',serif;color:#fff;margin-bottom:1.2rem;font-size:1.1rem;">
                <i class="fas fa-star" style="color:var(--nepal-gold);margin-right:8px;"></i> Top Highlights
            </h3>
            <ul style="list-style:none;">
                @foreach($destination['highlights'] as $highlight)
                <li style="display:flex;align-items:center;gap:10px;padding:.75rem 1rem;
                           background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);
                           border-radius:10px;margin-bottom:.6rem;color:rgba(255,255,255,.75);font-size:.9rem;
                           transition:all .3s;" class="highlight-item">
                    <i class="fas fa-check-circle" style="color:var(--nepal-gold);flex-shrink:0;"></i>
                    {{ $highlight }}
                </li>
                @endforeach
                </ul>
        </div>
    </div>

    <!-- Photo gallery -->
    <div data-aos="fade-up">
        <h2 style="font-family:'Cinzel',serif;font-size:1.5rem;color:#fff;margin-bottom:1.5rem;">
            Photo <span style="color:var(--nepal-gold);">Gallery</span>
        </h2>
        <div style="display:grid;grid-template-columns:repeat(3,1fr);gap:1rem;border-radius:18px;overflow:hidden;">
            @foreach($destination['gallery'] as $photo)
            <div style="overflow:hidden;aspect-ratio:4/3;border-radius:12px;">
                <img src="{{ $photo }}" alt="{{ $destination['name'] }}"
                     style="width:100%;height:100%;object-fit:cover;transition:transform .6s ease;cursor:pointer;"
                     class="gallery-img">
            </div>
            @endforeach
            </div>
    </div>

    <!-- Other destinations -->
    <div style="margin-top:5rem;" data-aos="fade-up">
        <h2 style="font-family:'Cinzel',serif;font-size:1.5rem;color:#fff;margin-bottom:1.5rem;">
            Other <span style="color:var(--nepal-gold);">Destinations</span>
        </h2>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:1rem;">
            @foreach($destinations as $other)
            @if($other['slug'] !== $destination['slug'])
            <a href="{{ route('destinations.show', $other['slug']) }}"
               style="text-decoration:none;display:block;background:rgba(255,255,255,.03);
                      border:1px solid rgba(255,255,255,.08);border-radius:14px;overflow:hidden;
                      transition:all .4s;" class="other-dest-card">
                <img src="{{ $other['img'] }}" alt="{{ $other['name'] }}"
                     style="width:100%;height:140px;object-fit:cover;transition:transform .6s;">
                <div style="padding:1rem;">
                    <h4 style="font-family:'Cinzel',serif;color:#fff;font-size:.95rem;margin-bottom:4px;">{{ $other['name'] }}</h4>
                    <p style="color:rgba(255,255,255,.45);font-size:.78rem;">{{ $other['label'] }}</p>
                </div>
            </a>
            @endif
            @endforeach
            </div>
    </div>

</div>

<style>
.highlight-item:hover { border-color:rgba(232,160,32,.3)!important; transform:translateX(6px); }
.gallery-img:hover    { transform:scale(1.08); }
.other-dest-card:hover{ border-color:rgba(232,160,32,.3)!important; transform:translateY(-6px); box-shadow:0 20px 40px rgba(0,0,0,.35); }
.other-dest-card:hover img { transform:scale(1.1); }
</style>
@endsection
@section('scripts')
<script>
gsap.registerPlugin(ScrollTrigger);
const tl = gsap.timeline({ delay: 0.3 });
tl.from('#destBadge',  { opacity:0, y:30, duration:.6, ease:'power3.out' })
  .from('#destTitle',  { opacity:0, y:60, duration:.8, ease:'power4.out' }, '-=.3')
  .from('#destLabel',  { opacity:0, y:20, duration:.6, ease:'power3.out' }, '-=.3');
gsap.to('#destHeroBg', {
    yPercent:25, ease:'none',
    scrollTrigger:{ trigger:'div', start:'top top', end:'bottom top', scrub:true }
});
gsap.from('.highlight-item', {
    scrollTrigger:{ trigger:'.highlight-item', start:'top 85%', once:true },
    x:-30, opacity:0, stagger:.08, duration:.6, ease:'power3.out'
});
</script>
@endsection