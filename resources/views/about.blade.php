@extends('layouts.app')
@section('title', 'About Us – Visit Nepal')
@section('content')
<!-- Hero -->
<section style="position:relative;height:55vh;overflow:hidden;display:flex;align-items:flex-end;">
    <div style="position:absolute;inset:0;background:linear-gradient(135deg,rgba(26,79,160,.7),rgba(3,8,16,.9)),
                url('https://images.unsplash.com/photo-1529928520614-7b080df4db7a?w=1920&q=80') center/cover;"></div>
    <div style="position:relative;z-index:2;max-width:1280px;margin:0 auto;padding:0 2rem 4rem;width:100%;">
        <div class="section-badge" data-aos="fade-up">
            <i class="fas fa-users"></i> Our Story
        </div>
        <h1 class="section-title" style="font-size:clamp(2.5rem,6vw,4.5rem);" data-aos="fade-up" data-aos-delay="100">
            About <span>Visit Nepal</span>
        </h1>
    </div>
</section>

<!-- Mission -->
<section style="padding:6rem 2rem;">
    <div style="max-width:1100px;margin:0 auto;display:grid;grid-template-columns:1fr 1fr;gap:4rem;align-items:center;">
        <div data-aos="fade-right">
            <div class="section-badge">
                <i class="fas fa-heart"></i> Our Mission
            </div>
            <h2 class="section-title" style="margin:.8rem 0 1.2rem;">
                Connecting You to <span>Nepal's Soul</span>
            </h2>
            <p style="color:rgba(255,255,255,.6);font-size:.98rem;line-height:1.85;margin-bottom:1.2rem;">
                Founded in 2010, Visit Nepal was born from a deep love for the Himalayas and a desire to
                share Nepal's extraordinary beauty with the world. We are a team of passionate local experts
                dedicated to crafting authentic, responsible travel experiences.
            </p>
            <p style="color:rgba(255,255,255,.6);font-size:.98rem;line-height:1.85;margin-bottom:2rem;">
                Every trek we design, every destination we recommend, and every interaction we have is
                guided by our commitment to genuine hospitality, safety, and the belief that travel
                can change lives.
            </p>
            <div style="display:flex;gap:1rem;">
                <a href="{{ route('packages.index') }}" class="btn-primary">
                    <i class="fas fa-suitcase"></i> Our Packages
                </a>
                <a href="{{ route('contact') }}" class="btn-outline">
                    <i class="fas fa-envelope"></i> Contact Us
                </a>
            </div>
        </div>
        <div data-aos="fade-left">
            <div style="border-radius:22px;overflow:hidden;aspect-ratio:4/3;box-shadow:0 30px 60px rgba(0,0,0,.4);">
                <img src="https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&q=80"
                     alt="Our Team" style="width:100%;height:100%;object-fit:cover;">
            </div>
        </div>
    </div>
</section>

<!-- Stats -->
<section style="padding:4rem 2rem;background:linear-gradient(135deg,rgba(26,79,160,.08),transparent);">
    <div style="max-width:1100px;margin:0 auto;display:grid;grid-template-columns:repeat(4,1fr);gap:2rem;text-align:center;">
        <div data-aos="zoom-in" data-aos-delay="0">
            <div style="font-family:'Cinzel',serif;font-size:2.8rem;font-weight:700;color:var(--nepal-gold);">15+</div>
            <div style="color:rgba(255,255,255,.5);font-size:.82rem;text-transform:uppercase;letter-spacing:.1em;margin-top:6px;">Years Experience</div>
        </div>
        <div data-aos="zoom-in" data-aos-delay="100">
            <div style="font-family:'Cinzel',serif;font-size:2.8rem;font-weight:700;color:var(--nepal-gold);">5,000+</div>
            <div style="color:rgba(255,255,255,.5);font-size:.82rem;text-transform:uppercase;letter-spacing:.1em;margin-top:6px;">Happy Travellers</div>
        </div>
        <div data-aos="zoom-in" data-aos-delay="200">
            <div style="font-family:'Cinzel',serif;font-size:2.8rem;font-weight:700;color:var(--nepal-gold);">200+</div>
            <div style="color:rgba(255,255,255,.5);font-size:.82rem;text-transform:uppercase;letter-spacing:.1em;margin-top:6px;">Expert Guides</div>
        </div>
        <div data-aos="zoom-in" data-aos-delay="300">
            <div style="font-family:'Cinzel',serif;font-size:2.8rem;font-weight:700;color:var(--nepal-gold);">50+</div>
            <div style="color:rgba(255,255,255,.5);font-size:.82rem;text-transform:uppercase;letter-spacing:.1em;margin-top:6px;">Destinations</div>
        </div>
    </div>
</section>

<!-- Team -->
<section style="padding:6rem 2rem;">
    <div style="max-width:1100px;margin:0 auto;">
        <div style="text-align:center;margin-bottom:3rem;">
            <div class="section-badge" data-aos="fade-up"><i class="fas fa-users"></i> The Team</div>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">Meet Our <span>Experts</span></h2>
        </div>
        <div style="display:grid;grid-template-columns:repeat(auto-fit,minmax(220px,1fr));gap:2rem;">
            @php
            $team = [
                ['name' => 'Ram Thapa',    'role' => 'Founder & CEO',     'img' => 'https://randomuser.me/api/portraits/men/40.jpg'],
                ['name' => 'Sita Gurung',  'role' => 'Head Guide',        'img' => 'https://randomuser.me/api/portraits/women/50.jpg'],
                ['name' => 'Pemba Sherpa', 'role' => 'Trek Coordinator',  'img' => 'https://randomuser.me/api/portraits/men/60.jpg'],
                ['name' => 'Anita Rai',    'role' => 'Customer Relations', 'img' => 'https://randomuser.me/api/portraits/women/35.jpg'],
            ];
            @endphp
            @foreach($team as $i => $member)
            <div style="text-align:center;background:rgba(255,255,255,.03);border:1px solid rgba(255,255,255,.08);
                        border-radius:18px;padding:2rem;transition:all .4s;" class="team-card"
                 data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                <div style="width:80px;height:80px;border-radius:50%;overflow:hidden;
                            border:3px solid rgba(232,160,32,.4);margin:0 auto 1rem;">
                    <img src="{{ $member['img'] }}" alt="{{ $member['name'] }}"
                         style="width:100%;height:100%;object-fit:cover;">
                </div>
                <h4 style="font-family:'Cinzel',serif;color:#fff;font-size:1rem;margin-bottom:4px;">{{ $member['name'] }}</h4>
                <p style="color:var(--nepal-gold);font-size:.8rem;letter-spacing:.06em;">{{ $member['role'] }}</p>
            </div>
            @endforeach
            </div>
    </div>
</section>

<style>
.team-card:hover { border-color:rgba(232,160,32,.3)!important; transform:translateY(-8px); box-shadow:0 25px 50px rgba(0,0,0,.4); }
</style>
@endsection