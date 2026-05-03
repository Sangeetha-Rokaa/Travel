@extends('layouts.app')
@section('title', 'Contact Us – Visit Nepal')
@section('content')
<section style="padding:9rem 2rem 7rem;">
    <div style="max-width:1100px;margin:0 auto;">

        <div style="text-align:center;margin-bottom:4rem;">
            <div class="section-badge" data-aos="fade-up">
                <i class="fas fa-envelope"></i> Contact Us
            </div>
            <h1 class="section-title" data-aos="fade-up" data-aos-delay="100">
                Let's Plan <span>Your Trip</span>
            </h1>
            <p class="section-subtitle" style="margin:.8rem auto 0;" data-aos="fade-up" data-aos-delay="200">
                Have questions? We'd love to hear from you. Send a message and we'll respond within 24 hours.
            </p>
        </div>

        @if(session('success'))
        <div style="background:rgba(74,222,128,.1);border:1px solid rgba(74,222,128,.3);border-radius:12px;
                    padding:1.2rem 1.8rem;margin-bottom:2rem;color:#4ade80;display:flex;align-items:center;gap:10px;"
             data-aos="fade-down">
            <i class="fas fa-check-circle" style="font-size:1.2rem;"></i>
            {{ session('success') }}
        </div>
        @endif

        <div style="display:grid;grid-template-columns:1fr 1.5fr;gap:4rem;align-items:start;">

            <!-- Info -->
            <div>
                <div style="display:flex;align-items:flex-start;gap:1rem;margin-bottom:1.5rem;
                            padding:1.4rem;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);
                            border-radius:16px;transition:all .4s;" class="contact-info-item" data-aos="fade-right">
                    <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,rgba(26,79,160,.3),rgba(37,99,235,.2));
                                display:flex;align-items:center;justify-content:center;color:var(--nepal-gold);font-size:1.2rem;flex-shrink:0;">
                        <i class="fas fa-map-marker-alt"></i>
                    </div>
                    <div>
                        <strong style="display:block;color:#fff;font-size:.9rem;margin-bottom:4px;">Our Office</strong>
                        <span style="color:rgba(255,255,255,.5);font-size:.85rem;">Thamel, Kathmandu, Nepal</span>
                    </div>
                </div>

                <div style="display:flex;align-items:flex-start;gap:1rem;margin-bottom:1.5rem;
                            padding:1.4rem;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);
                            border-radius:16px;transition:all .4s;" class="contact-info-item" data-aos="fade-right" data-aos-delay="100">
                    <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,rgba(26,79,160,.3),rgba(37,99,235,.2));
                                display:flex;align-items:center;justify-content:center;color:var(--nepal-gold);font-size:1.2rem;flex-shrink:0;">
                        <i class="fas fa-phone"></i>
                    </div>
                    <div>
                        <strong style="display:block;color:#fff;font-size:.9rem;margin-bottom:4px;">Phone</strong>
                        <span style="color:rgba(255,255,255,.5);font-size:.85rem;">+977 9800000000</span>
                    </div>
                </div>

                <div style="display:flex;align-items:flex-start;gap:1rem;margin-bottom:1.5rem;
                            padding:1.4rem;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);
                            border-radius:16px;transition:all .4s;" class="contact-info-item" data-aos="fade-right" data-aos-delay="200">
                    <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,rgba(26,79,160,.3),rgba(37,99,235,.2));
                                display:flex;align-items:center;justify-content:center;color:var(--nepal-gold);font-size:1.2rem;flex-shrink:0;">
                        <i class="fas fa-envelope"></i>
                    </div>
                    <div>
                        <strong style="display:block;color:#fff;font-size:.9rem;margin-bottom:4px;">Email</strong>
                        <span style="color:rgba(255,255,255,.5);font-size:.85rem;">info@visitnepal.com</span>
                    </div>
                </div>

                <div style="display:flex;align-items:flex-start;gap:1rem;padding:1.4rem;
                            background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.07);
                            border-radius:16px;transition:all .4s;" class="contact-info-item" data-aos="fade-right" data-aos-delay="300">
                    <div style="width:48px;height:48px;border-radius:12px;background:linear-gradient(135deg,rgba(26,79,160,.3),rgba(37,99,235,.2));
                                display:flex;align-items:center;justify-content:center;color:var(--nepal-gold);font-size:1.2rem;flex-shrink:0;">
                        <i class="fas fa-clock"></i>
                    </div>
                    <div>
                        <strong style="display:block;color:#fff;font-size:.9rem;margin-bottom:4px;">Working Hours</strong>
                        <span style="color:rgba(255,255,255,.5);font-size:.85rem;">Sunday – Friday: 9 AM – 6 PM (NST)</span>
                    </div>
                </div>
            </div>

            <!-- Form -->
            <div style="background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);
                        border-radius:22px;padding:2.5rem;"
                 data-aos="fade-left" data-aos-delay="100">
                <h3 style="font-family:'Cinzel',serif;color:#fff;font-size:1.3rem;margin-bottom:.5rem;">
                    Send a Message
                </h3>
                <p style="color:rgba(255,255,255,.4);font-size:.85rem;margin-bottom:2rem;">
                    Fill out the form and we'll get back to you within 24 hours.
                </p>

                <form action="{{ route('contact.send') }}" method="POST" id="mainContactForm">
                    @csrf
                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:1.2rem;margin-bottom:1.2rem;">
                        <div>
                            <label style="display:block;color:rgba(255,255,255,.6);font-size:.82rem;margin-bottom:.4rem;">Your Name *</label>
                            <input type="text" name="name" class="form-input" placeholder="John Doe" required>
                        </div>
                        <div>
                            <label style="display:block;color:rgba(255,255,255,.6);font-size:.82rem;margin-bottom:.4rem;">Email *</label>
                            <input type="email" name="email" class="form-input" placeholder="john@example.com" required>
                        </div>
                    </div>
                    <div style="margin-bottom:1.2rem;">
                        <label style="display:block;color:rgba(255,255,255,.6);font-size:.82rem;margin-bottom:.4rem;">Phone</label>
                        <input type="tel" name="phone" class="form-input" placeholder="+977 9800000000">
                    </div>
                    <div style="margin-bottom:1.8rem;">
                        <label style="display:block;color:rgba(255,255,255,.6);font-size:.82rem;margin-bottom:.4rem;">Your Message *</label>
                        <textarea name="message" class="form-input" placeholder="Tell us about your dream Nepal trip..." style="height:140px;" required></textarea>
                    </div>
                    <button type="submit" class="btn-primary" style="width:100%;justify-content:center;">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>
            </div>
        </div>

    </div>
</section>

<style>
.contact-info-item:hover { border-color:rgba(232,160,32,.3)!important; transform:translateX(6px); }
</style>
@endsection
@section('scripts')
<script>
gsap.registerPlugin(ScrollTrigger);
gsap.from('.contact-info-item', {
    scrollTrigger:{ trigger:'.contact-info-item', start:'top 85%', once:true },
    x:-40, opacity:0, stagger:.1, duration:.7, ease:'power3.out'
});
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', () => gsap.to(input, { scale:1.01, duration:.3, ease:'power2.out' }));
    input.addEventListener('blur',  () => gsap.to(input, { scale:1,    duration:.3, ease:'power2.out' }));
});
</script>
@endsection