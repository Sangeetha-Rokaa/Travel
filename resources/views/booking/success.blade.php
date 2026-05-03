@extends('layouts.app')
@section('title', 'Booking Confirmed – Visit Nepal')
@section('content')
<section style="min-height:80vh;display:flex;align-items:center;justify-content:center;padding:4rem 2rem;">
    <div style="text-align:center;max-width:580px;" data-aos="zoom-in">

        <div style="width:90px;height:90px;background:linear-gradient(135deg,rgba(74,222,128,.2),rgba(34,197,94,.1));
                    border:2px solid rgba(74,222,128,.4);border-radius:50%;display:flex;align-items:center;
                    justify-content:center;margin:0 auto 1.8rem;font-size:2.2rem;" id="successIcon">
            ✅
        </div>

        <div class="section-badge" style="margin:0 auto 1rem;">
            <i class="fas fa-check-circle"></i> Booking Received
        </div>

        <h1 style="font-family:'Cinzel',serif;font-size:clamp(1.8rem,5vw,3rem);color:#fff;
                   margin-bottom:1rem;line-height:1.2;">
            Thank You! Your Adventure <span style="color:var(--nepal-gold);">Awaits</span>
        </h1>

        <p style="color:rgba(255,255,255,.6);font-size:1rem;line-height:1.75;margin-bottom:2.5rem;">
            We have received your booking request. Our team will contact you
            within 24 hours to confirm your trip and discuss the details.
        </p>

        <div style="background:rgba(255,255,255,.04);border:1px solid rgba(255,255,255,.09);
                    border-radius:16px;padding:1.5rem;margin-bottom:2.5rem;text-align:left;">
            <h3 style="font-family:'Cinzel',serif;color:#fff;font-size:.95rem;margin-bottom:1rem;">
                What happens next?
            </h3>
            <div style="display:flex;flex-direction:column;gap:.8rem;">
                <div style="display:flex;align-items:center;gap:10px;color:rgba(255,255,255,.6);font-size:.88rem;">
                    <span style="width:28px;height:28px;background:rgba(232,160,32,.15);border:1px solid rgba(232,160,32,.3);
                                 border-radius:50%;display:flex;align-items:center;justify-content:center;
                                 color:var(--nepal-gold);font-size:.78rem;font-weight:700;flex-shrink:0;">1</span>
                    Our team reviews your booking within 24 hours
                </div>
                <div style="display:flex;align-items:center;gap:10px;color:rgba(255,255,255,.6);font-size:.88rem;">
                    <span style="width:28px;height:28px;background:rgba(232,160,32,.15);border:1px solid rgba(232,160,32,.3);
                                 border-radius:50%;display:flex;align-items:center;justify-content:center;
                                 color:var(--nepal-gold);font-size:.78rem;font-weight:700;flex-shrink:0;">2</span>
                    You receive a confirmation email with full details
                </div>
                <div style="display:flex;align-items:center;gap:10px;color:rgba(255,255,255,.6);font-size:.88rem;">
                    <span style="width:28px;height:28px;background:rgba(232,160,32,.15);border:1px solid rgba(232,160,32,.3);
                                 border-radius:50%;display:flex;align-items:center;justify-content:center;
                                 color:var(--nepal-gold);font-size:.78rem;font-weight:700;flex-shrink:0;">3</span>
                    We finalize your itinerary and arrange payment
                </div>
            </div>
        </div>

        <div style="display:flex;gap:1rem;justify-content:center;flex-wrap:wrap;">
            <a href="{{ route('home') }}" class="btn-primary">
                <i class="fas fa-home"></i> Back to Home
            </a>
            <a href="{{ route('packages.index') }}" class="btn-outline">
                <i class="fas fa-suitcase"></i> Browse More
            </a>
        </div>

    </div>
</section>
@endsection
@section('scripts')
<script>
gsap.registerPlugin(ScrollTrigger);
const tl = gsap.timeline({ delay: 0.3 });
tl.from('#successIcon', { scale:0, rotation:-180, duration:1, ease:'back.out(1.7)' })
  .from('h1',           { opacity:0, y:40, duration:.7, ease:'power3.out' }, '-=.4')
  .from('p',            { opacity:0, y:20, duration:.6, ease:'power3.out' }, '-=.3');

// Confetti-style particles on success
(function confetti() {
    const colors = ['#e8a020','#f5c842','#1a4fa0','#fff','#4ade80'];
    for (let i = 0; i < 40; i++) {
        const el = document.createElement('div');
        el.style.cssText = `
            position:fixed;width:8px;height:8px;border-radius:2px;
            background:${colors[Math.floor(Math.random()*colors.length)]};
            left:${Math.random()*100}vw;top:-10px;z-index:9999;pointer-events:none;
        `;
        document.body.appendChild(el);
        gsap.to(el, {
            y: window.innerHeight + 20,
            x: (Math.random()-0.5) * 200,
            rotation: Math.random() * 720,
            duration: Math.random() * 2 + 2,
            delay: Math.random() * 1.5,
            ease: 'power1.in',
            onComplete: () => el.remove()
        });
    }
})();
</script>
@endsection
