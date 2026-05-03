@extends('layouts.app')
@section('title', 'All Destinations – Visit Nepal')
@section('content')
<section style="padding:9rem 2rem 7rem;max-width:1280px;margin:0 auto;">

    <div style="text-align:center;margin-bottom:3.5rem;">
        <div class="section-badge" data-aos="fade-up">
            <i class="fas fa-map-marked-alt"></i> Explore Nepal
        </div>
        <h1 class="section-title" data-aos="fade-up" data-aos-delay="100">
            Popular <span>Destinations</span>
        </h1>
        <p class="section-subtitle" style="margin:.8rem auto 0;" data-aos="fade-up" data-aos-delay="200">
            From the roof of the world to serene valleys — every corner of Nepal tells a story.
        </p>
    </div>

    <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(300px,1fr));gap:2rem;">
        @foreach($destinations as $dest)
        <a href="{{ route('destinations.show', $dest['slug']) }}"
           style="text-decoration:none;"
           data-aos="fade-up"
           data-aos-delay="{{ $dest['delay'] }}">
            <div style="background:rgba(255,255,255,0.03);border:1px solid rgba(255,255,255,0.08);
                        border-radius:18px;overflow:hidden;transition:all 0.4s cubic-bezier(.23,1,.32,1);"
                 class="dest-index-card">
                <div style="height:260px;overflow:hidden;position:relative;">
                    <img src="{{ $dest['img'] }}" alt="{{ $dest['name'] }}"
                         style="width:100%;height:100%;object-fit:cover;transition:transform .7s ease;">
                    <div style="position:absolute;inset:0;background:linear-gradient(180deg,transparent 40%,rgba(3,8,16,.85) 100%);"></div>
                    <span style="position:absolute;top:1rem;right:1rem;background:rgba(232,160,32,.9);
                                 color:#fff;padding:4px 14px;border-radius:50px;font-size:.72rem;font-weight:700;">
                        {{ $dest['tag'] }}
                    </span>
                    <div style="position:absolute;bottom:1.2rem;left:1.5rem;">
                        <h2 style="font-family:'Cinzel',serif;font-size:1.3rem;color:#fff;margin-bottom:4px;">
                            {{ $dest['name'] }}
                        </h2>
                        <p style="color:rgba(255,255,255,.6);font-size:.8rem;">{{ $dest['label'] }}</p>
                    </div>
                </div>
                <div style="padding:1.6rem;">
                    <p style="color:rgba(255,255,255,.55);font-size:.88rem;line-height:1.7;margin-bottom:1.2rem;">
                        {{ $dest['description'] }}
                    </p>
                    <div style="display:flex;gap:1.5rem;margin-bottom:1.2rem;flex-wrap:wrap;">
                        <span style="display:flex;align-items:center;gap:6px;color:rgba(255,255,255,.5);font-size:.8rem;">
                            <i class="fas fa-mountain" style="color:var(--nepal-gold);"></i> {{ $dest['altitude'] }}
                        </span>
                        <span style="display:flex;align-items:center;gap:6px;color:rgba(255,255,255,.5);font-size:.8rem;">
                            <i class="fas fa-sun" style="color:var(--nepal-gold);"></i> {{ $dest['best_time'] }}
                        </span>
                    </div>
                    <span style="display:inline-flex;align-items:center;gap:6px;color:var(--nepal-blue);
                                 font-size:.85rem;font-weight:600;">
                        Explore More <i class="fas fa-arrow-right"></i>
                    </span>
                </div>
            </div>
        </a>
        @endforeach
        </div>
</section>

<style>
.dest-index-card:hover {
    border-color: rgba(232,160,32,.35) !important;
    transform: translateY(-10px);
    box-shadow: 0 30px 60px rgba(0,0,0,.4);
}
.dest-index-card:hover img { transform: scale(1.1); }
</style>
@endsection
@section('scripts')
<script>
gsap.registerPlugin(ScrollTrigger);
gsap.from('.dest-index-card', {
    scrollTrigger: { trigger: 'section', start: 'top 80%', once: true },
    opacity: 0, y: 50, scale: 0.93,
    stagger: 0.12, duration: 0.8, ease: 'back.out(1.4)',
});
</script>
@endsection