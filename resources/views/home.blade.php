@extends('layouts.app')
@section('title', 'ApeakNepal – Dream · Explore · Discover')
@section('extra-styles')
<style>
/* ── HERO ─────────────────────────────────── */
#hero {
    position: relative;
    min-height: 100vh;
    display: flex;
    align-items: center;
    overflow: hidden;
    background: #030810;
}
.hero-bg {
    position: absolute;
    inset: 0;
    background:
        linear-gradient(180deg, rgba(3,8,16,0.25) 0%, rgba(3,8,16,0.65) 70%, rgba(3,8,16,1) 100%),
        url('https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=1920&q=80') center/cover no-repeat;
    will-change: transform;
}
.hero-particles { position:absolute; inset:0; pointer-events:none; overflow:hidden; }
.particle {
    position: absolute;
    border-radius: 50%;
    animation: floatParticle linear infinite;
    opacity: 0;
}
@keyframes floatParticle {
    0%   { transform:translateY(100vh) scale(0); opacity:0; }
    10%  { opacity:1; }
    90%  { opacity:0.6; }
    100% { transform:translateY(-20vh) scale(1); opacity:0; }
}
.hero-content {
    position: relative;
    z-index: 10;
    max-width: 1280px;
    margin: 0 auto;
    padding: 8rem 2rem 6rem;
    width: 100%;
}
.hero-eyebrow {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    background: rgba(232,160,32,0.1);
    border: 1px solid rgba(232,160,32,0.35);
    color: var(--nepal-gold);
    padding: 8px 20px;
    border-radius: 50px;
    font-size: 0.78rem;
    font-weight: 600;
    letter-spacing: 0.15em;
    text-transform: uppercase;
    opacity: 0;
    transform: translateY(20px);
}
.hero-eyebrow .dot {
    width: 6px; height: 6px;
    background: var(--nepal-gold);
    border-radius: 50%;
    animation: pulse 1.5s ease-in-out infinite;
}
@keyframes pulse {
    0%,100% { transform:scale(1); opacity:1; }
    50%      { transform:scale(1.6); opacity:0.5; }
}
.hero-welcome {
    font-family: 'Playfair Display', serif;
    font-style: italic;
    color: var(--nepal-gold-light);
    font-size: clamp(1.4rem, 3vw, 2.2rem);
    margin-top: 1.2rem;
    opacity: 0;
    display: block;
}
.hero-title {
    font-family: 'Cinzel', serif;
    font-size: clamp(4rem, 13vw, 10rem);
    font-weight: 900;
    color: #fff;
    letter-spacing: -0.02em;
    line-height: 0.9;
    text-shadow: 0 0 80px rgba(232,160,32,0.3), 0 4px 30px rgba(0,0,0,0.7);
    opacity: 0;
    margin: 0.2rem 0 1rem;
}
.hero-title .letter { display: inline-block; }
.hero-sub {
    font-size: clamp(0.95rem, 2vw, 1.15rem);
    color: rgba(255,255,255,0.75);
    letter-spacing: 0.22em;
    text-transform: uppercase;
    font-weight: 400;
    opacity: 0;
    max-width: 520px;
    line-height: 1.8;
}
.hero-actions { display:flex; gap:1rem; margin-top:2.5rem; flex-wrap:wrap; opacity:0; }
.hero-stats   { display:flex; gap:3rem; margin-top:4rem; flex-wrap:wrap; opacity:0; }
.hero-stat-num {
    font-family: 'Cinzel', serif;
    font-size: 2.2rem;
    font-weight: 700;
    color: var(--nepal-gold);
    line-height: 1;
    display: block;
}
.hero-stat-label {
    font-size: 0.75rem;
    color: rgba(255,255,255,0.5);
    letter-spacing: 0.1em;
    text-transform: uppercase;
    margin-top: 4px;
    display: block;
}
.hero-badges { display:flex; gap:2rem; margin-top:3rem; flex-wrap:wrap; opacity:0; }
.hero-badge {
    display: flex;
    align-items: center;
    gap: 10px;
    background: rgba(255,255,255,0.06);
    border: 1px solid rgba(255,255,255,0.12);
    border-radius: 12px;
    padding: 12px 20px;
    backdrop-filter: blur(10px);
    transition: var(--transition-base);
}
.hero-badge:hover {
    background: rgba(255,255,255,0.1);
    border-color: rgba(232,160,32,0.4);
    transform: translateY(-4px);
}
.hero-badge i { color:var(--nepal-gold); font-size:1.2rem; }
.hero-badge-text strong { display:block; color:#fff; font-size:0.85rem; font-weight:600; }
.hero-badge-text span   { color:rgba(255,255,255,0.5); font-size:0.75rem; }

.scroll-indicator {
    position: absolute;
    bottom: 2.5rem; left: 50%;
    transform: translateX(-50%);
    display: flex; flex-direction:column; align-items:center; gap:8px;
    color: rgba(255,255,255,0.4);
    font-size: 0.72rem; letter-spacing:0.12em; text-transform:uppercase;
    z-index: 10;
    animation: scrollBounce 2s ease-in-out infinite;
}
@keyframes scrollBounce {
    0%,100% { transform:translateX(-50%) translateY(0); opacity:0.4; }
    50%      { transform:translateX(-50%) translateY(8px); opacity:0.8; }
}
.scroll-indicator .mouse {
    width:22px; height:36px;
    border:2px solid rgba(255,255,255,0.3);
    border-radius:11px; position:relative;
}
.scroll-indicator .mouse::after {
    content:''; position:absolute;
    top:5px; left:50%; transform:translateX(-50%);
    width:3px; height:8px;
    background:var(--nepal-gold); border-radius:3px;
    animation:scrollWheel 1.8s ease-in-out infinite;
}
@keyframes scrollWheel {
    0%,100% { top:5px; opacity:1; }
    80%      { top:18px; opacity:0; }
}

/* ── WHY CHOOSE US ────────────────────────── */
#why-us { padding:7rem 2rem; position:relative; overflow:hidden; }
#why-us::before {
    content:''; position:absolute;
    top:-200px; right:-200px; width:600px; height:600px;
    background:radial-gradient(circle,rgba(26,79,160,0.12) 0%,transparent 70%);
    pointer-events:none;
}
.why-inner {
    max-width:1280px; margin:0 auto;
    display:grid; grid-template-columns:1fr 1fr; gap:5rem; align-items:center;
}
@media(max-width:900px){ .why-inner{ grid-template-columns:1fr; } }
.why-features-grid { display:grid; grid-template-columns:1fr 1fr; gap:1.2rem; }
.feature-card {
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:var(--radius-lg);
    padding:1.8rem; transition:var(--transition-base);
    position:relative; overflow:hidden;
}
.feature-card::before {
    content:''; position:absolute; inset:0;
    background:linear-gradient(135deg,rgba(26,79,160,0.08),transparent);
    opacity:0; transition:opacity 0.4s;
}
.feature-card:hover { border-color:rgba(232,160,32,0.3); transform:translateY(-6px); box-shadow:0 20px 50px rgba(0,0,0,0.3); }
.feature-card:hover::before { opacity:1; }
.feature-icon {
    width:52px; height:52px; border-radius:14px;
    background:linear-gradient(135deg,rgba(26,79,160,0.3),rgba(37,99,235,0.2));
    border:1px solid rgba(26,79,160,0.4);
    display:flex; align-items:center; justify-content:center;
    font-size:1.4rem; margin-bottom:1rem;
}
.feature-card h3 { font-family:'Cinzel',serif; font-size:0.95rem; color:#fff; margin-bottom:0.5rem; }
.feature-card p  { color:rgba(255,255,255,0.5); font-size:0.82rem; line-height:1.6; }
.video-wrapper {
    position:relative; border-radius:var(--radius-xl);
    overflow:hidden; aspect-ratio:16/10; box-shadow:var(--shadow-xl);
}
.video-wrapper img { width:100%; height:100%; object-fit:cover; transition:transform 0.8s ease; }
.video-wrapper:hover img { transform:scale(1.06); }
.play-btn {
    position:absolute; top:50%; left:50%;
    transform:translate(-50%,-50%);
    width:72px; height:72px;
    background:rgba(255,255,255,0.15); backdrop-filter:blur(12px);
    border:2px solid rgba(255,255,255,0.5); border-radius:50%;
    display:flex; align-items:center; justify-content:center;
    color:#fff; font-size:1.4rem; cursor:pointer;
    transition:var(--transition-base);
    animation:ringPulse 2.5s ease-in-out infinite;
}
.play-btn:hover { background:var(--nepal-blue); border-color:var(--nepal-blue); transform:translate(-50%,-50%) scale(1.1); }
@keyframes ringPulse {
    0%,100% { box-shadow:0 0 0 0 rgba(255,255,255,0.3); }
    50%      { box-shadow:0 0 0 20px rgba(255,255,255,0); }
}
.video-label {
    position:absolute; bottom:1.5rem; left:50%; transform:translateX(-50%);
    background:rgba(8,15,30,0.8); backdrop-filter:blur(10px);
    padding:10px 24px; border-radius:50px; color:#fff;
    font-size:0.85rem; font-weight:600; white-space:nowrap;
    border:1px solid rgba(255,255,255,0.15);
}

/* ── DESTINATIONS ─────────────────────────── */
#destinations {
    padding:7rem 2rem;
    background:linear-gradient(180deg,transparent,rgba(26,79,160,0.05),transparent);
}
.section-header { text-align:center; margin-bottom:3.5rem; }
.destinations-grid {
    max-width:1280px; margin:0 auto;
    display:grid; grid-template-columns:repeat(4,1fr); gap:1.4rem;
}
@media(max-width:1024px){ .destinations-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:640px) { .destinations-grid{ grid-template-columns:1fr; } }

.dest-card {
    position:relative; border-radius:var(--radius-lg);
    overflow:hidden; aspect-ratio:4/5; cursor:pointer;
    transition:var(--transition-base);
    display:block; text-decoration:none;     /* <-- anchor-safe */
}
.dest-card:hover { transform:translateY(-10px) scale(1.02); box-shadow:0 30px 70px rgba(0,0,0,0.5); }
.dest-card img { width:100%; height:100%; object-fit:cover; transition:transform 0.8s ease; display:block; }
.dest-card:hover img { transform:scale(1.12); }
.dest-overlay {
    position:absolute; inset:0;
    background:linear-gradient(180deg,transparent 30%,rgba(3,8,16,0.85) 100%);
    transition:background 0.4s;
}
.dest-card:hover .dest-overlay { background:linear-gradient(180deg,transparent 0%,rgba(3,8,16,0.9) 100%); }
.dest-info { position:absolute; bottom:1.5rem; left:1.5rem; right:1.5rem; }
.dest-info h3 { font-family:'Cinzel',serif; font-size:1.2rem; color:#fff; margin-bottom:4px; }
.dest-info p  { color:rgba(255,255,255,0.6); font-size:0.8rem; letter-spacing:0.06em; }
.dest-card-tag {
    position:absolute; top:1rem; right:1rem;
    background:rgba(232,160,32,0.9); color:#fff;
    padding:4px 12px; border-radius:50px;
    font-size:0.72rem; font-weight:600; letter-spacing:0.06em;
}

/* ── TREKS ────────────────────────────────── */
#treks { padding:7rem 2rem; }
.treks-inner { max-width:1280px; margin:0 auto; }
.treks-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.6rem; margin-top:3rem; }
@media(max-width:900px){ .treks-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:640px){ .treks-grid{ grid-template-columns:1fr; } }
.trek-card {
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:var(--radius-lg); overflow:hidden;
    transition:var(--transition-base);
}
.trek-card:hover { border-color:rgba(232,160,32,0.3); transform:translateY(-8px); box-shadow:0 25px 55px rgba(0,0,0,0.4); }
.trek-img { position:relative; height:220px; overflow:hidden; }
.trek-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.7s ease; }
.trek-card:hover .trek-img img { transform:scale(1.1); }
.trek-img-overlay { position:absolute; inset:0; background:linear-gradient(180deg,transparent 50%,rgba(3,8,16,0.7) 100%); }
.trek-difficulty {
    position:absolute; top:1rem; left:1rem;
    padding:5px 14px; border-radius:50px;
    font-size:0.72rem; font-weight:600; letter-spacing:0.06em;
}
.difficulty-moderate { background:rgba(245,200,66,0.2); border:1px solid rgba(245,200,66,0.5); color:var(--nepal-gold-light); }
.difficulty-easy     { background:rgba(34,197,94,0.2);  border:1px solid rgba(34,197,94,0.5);  color:#4ade80; }
.trek-body { padding:1.6rem; }
.trek-body h3 { font-family:'Cinzel',serif; font-size:1.05rem; color:#fff; margin-bottom:0.8rem; }
.trek-meta { display:flex; gap:1.2rem; margin-bottom:1.2rem; flex-wrap:wrap; }
.trek-meta span { display:flex; align-items:center; gap:6px; color:rgba(255,255,255,0.5); font-size:0.8rem; }
.trek-meta i { color:var(--nepal-gold); font-size:0.85rem; }
.trek-footer {
    display:flex; align-items:center; justify-content:space-between;
    padding-top:1rem; border-top:1px solid rgba(255,255,255,0.07);
}
.trek-price { font-family:'Cinzel',serif; font-size:1.4rem; font-weight:700; color:var(--nepal-gold); }
.trek-price span { font-size:0.75rem; color:rgba(255,255,255,0.4); font-weight:400; font-family:'Raleway',sans-serif; }
.link-arrow {
    display:inline-flex; align-items:center; gap:6px;
    color:var(--nepal-blue); font-size:0.82rem; font-weight:600;
    text-decoration:none; transition:gap 0.3s,color 0.3s;
}
.link-arrow:hover { gap:10px; color:var(--nepal-gold); }

/* ── PACKAGES ─────────────────────────────── */
#packages {
    padding:7rem 2rem;
    background:linear-gradient(135deg,rgba(26,79,160,0.04) 0%,transparent 50%,rgba(232,160,32,0.03) 100%);
}
.packages-inner { max-width:1280px; margin:0 auto; }
.packages-grid { display:grid; grid-template-columns:repeat(3,1fr); gap:1.6rem; margin-top:3rem; }
@media(max-width:900px){ .packages-grid{ grid-template-columns:1fr 1fr; } }
@media(max-width:640px){ .packages-grid{ grid-template-columns:1fr; } }
.pkg-card {
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:var(--radius-lg); overflow:hidden;
    transition:var(--transition-base);
}
.pkg-card.featured { border-color:rgba(232,160,32,0.35); background:rgba(232,160,32,0.04); }
.pkg-card:hover { transform:translateY(-10px); box-shadow:0 30px 60px rgba(0,0,0,0.4); border-color:rgba(232,160,32,0.4); }
.pkg-img { height:200px; overflow:hidden; position:relative; }
.pkg-img img { width:100%; height:100%; object-fit:cover; transition:transform 0.7s ease; }
.pkg-card:hover .pkg-img img { transform:scale(1.1); }
.pkg-badge {
    position:absolute; top:1rem; right:1rem;
    background:linear-gradient(135deg,var(--nepal-gold),#d4860e);
    color:#fff; padding:5px 14px; border-radius:50px;
    font-size:0.72rem; font-weight:700; letter-spacing:0.05em;
}
.pkg-body { padding:1.6rem; }
.pkg-meta { display:flex; justify-content:space-between; align-items:center; margin-bottom:0.8rem; }
.pkg-days { display:flex; align-items:center; gap:6px; color:rgba(255,255,255,0.5); font-size:0.8rem; }
.pkg-days i { color:var(--nepal-gold); }
.pkg-price { font-family:'Cinzel',serif; font-size:1.5rem; font-weight:700; color:var(--nepal-gold); }
.pkg-body h3 { font-family:'Cinzel',serif; font-size:1rem; color:#fff; margin-bottom:1rem; }
.pkg-services { list-style:none; margin-bottom:1.5rem; }
.pkg-services li { display:flex; align-items:center; gap:8px; color:rgba(255,255,255,0.55); font-size:0.82rem; margin-bottom:0.4rem; }
.pkg-services li i { color:#4ade80; font-size:0.75rem; }

/* ── TESTIMONIALS ─────────────────────────── */
#testimonials { padding:7rem 2rem; overflow:hidden; }
.testimonials-inner { max-width:1280px; margin:0 auto; }
.testimonials-slider { position:relative; margin-top:3rem; overflow:hidden; }
.testimonials-track { display:flex; gap:1.6rem; }
.testimonial-card {
    min-width:calc(50% - 0.8rem); flex-shrink:0;
    background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.08);
    border-radius:var(--radius-lg); padding:2.2rem;
    transition:var(--transition-base);
}
@media(max-width:768px){ .testimonial-card{ min-width:100%; } }
.testimonial-card:hover { border-color:rgba(232,160,32,0.3); background:rgba(255,255,255,0.05); transform:translateY(-5px); }
.testi-header { display:flex; align-items:center; gap:1rem; margin-bottom:1.2rem; }
.testi-avatar { width:52px; height:52px; border-radius:50%; overflow:hidden; border:2px solid rgba(232,160,32,0.4); flex-shrink:0; }
.testi-avatar img { width:100%; height:100%; object-fit:cover; }
.testi-name     { font-weight:600; color:#fff; font-size:0.95rem; }
.testi-location { color:rgba(255,255,255,0.45); font-size:0.78rem; margin-top:2px; }
.testi-stars    { color:var(--nepal-gold); font-size:0.9rem; margin-bottom:1rem; }
.testi-text     { color:rgba(255,255,255,0.65); font-size:0.9rem; line-height:1.75; font-style:italic; }
.testi-quote    { font-family:'Playfair Display',serif; font-size:4rem; color:rgba(232,160,32,0.15); line-height:1; margin-bottom:-1rem; display:block; }
.slider-controls { display:flex; justify-content:center; gap:1rem; margin-top:2.5rem; }
.slider-btn {
    width:44px; height:44px; border-radius:50%;
    background:rgba(255,255,255,0.06); border:1px solid rgba(255,255,255,0.12);
    color:#fff; display:flex; align-items:center; justify-content:center;
    cursor:pointer; transition:var(--transition-base); font-size:1rem;
}
.slider-btn:hover { background:var(--nepal-blue); border-color:var(--nepal-blue); transform:scale(1.1); }
.slider-dots { display:flex; justify-content:center; gap:8px; margin-top:1.2rem; }
.slider-dot { width:8px; height:8px; border-radius:50%; background:rgba(255,255,255,0.2); cursor:pointer; transition:var(--transition-base); }
.slider-dot.active { background:var(--nepal-gold); width:24px; border-radius:4px; }

/* ── CTA ──────────────────────────────────── */
#cta { padding:7rem 2rem; position:relative; overflow:hidden; }
.cta-bg {
    position:absolute; inset:0;
    background:
        linear-gradient(135deg,rgba(26,79,160,0.6) 0%,rgba(8,15,30,0.85) 100%),
        url('https://images.unsplash.com/photo-1529928520614-7b080df4db7a?w=1920&q=80') center/cover no-repeat;
}
.cta-inner { position:relative; z-index:2; max-width:700px; margin:0 auto; text-align:center; }
.cta-inner h2 { font-family:'Cinzel',serif; font-size:clamp(2rem,5vw,3.5rem); color:#fff; line-height:1.2; margin-bottom:1.2rem; }
.cta-inner p  { color:rgba(255,255,255,0.7); font-size:1.05rem; line-height:1.7; margin-bottom:2.5rem; }
.cta-actions  { display:flex; gap:1rem; justify-content:center; flex-wrap:wrap; }

/* ── CONTACT ──────────────────────────────── */
#contact { padding:7rem 2rem; background:linear-gradient(180deg,transparent,rgba(26,79,160,0.04),transparent); }
.contact-inner {
    max-width:1280px; margin:0 auto;
    display:grid; grid-template-columns:1fr 1.4fr; gap:4rem; align-items:start;
}
@media(max-width:900px){ .contact-inner{ grid-template-columns:1fr; } }
.contact-info-item {
    display:flex; align-items:flex-start; gap:1rem; margin-bottom:1.8rem;
    padding:1.4rem; background:rgba(255,255,255,0.03);
    border:1px solid rgba(255,255,255,0.07); border-radius:var(--radius-lg);
    transition:var(--transition-base);
}
.contact-info-item:hover { border-color:rgba(232,160,32,0.3); transform:translateX(6px); }
.contact-info-icon {
    width:48px; height:48px; border-radius:12px;
    background:linear-gradient(135deg,rgba(26,79,160,0.3),rgba(37,99,235,0.2));
    display:flex; align-items:center; justify-content:center;
    font-size:1.2rem; color:var(--nepal-gold); flex-shrink:0;
}
.contact-info-text strong { display:block; color:#fff; font-size:0.9rem; margin-bottom:4px; }
.contact-info-text span   { color:rgba(255,255,255,0.5); font-size:0.85rem; }
.contact-form {
    background:rgba(255,255,255,0.03); border:1px solid rgba(255,255,255,0.08);
    border-radius:var(--radius-xl); padding:2.5rem;
}
.contact-form h3 { font-family:'Cinzel',serif; font-size:1.3rem; color:#fff; margin-bottom:0.4rem; }
.contact-form p  { color:rgba(255,255,255,0.4); font-size:0.85rem; margin-bottom:2rem; }
.form-group { margin-bottom:1.2rem; }
.form-input {
    width:100%; background:rgba(255,255,255,0.05);
    border:1px solid rgba(255,255,255,0.1); border-radius:12px;
    padding:14px 18px; color:#fff;
    font-family:'Raleway',sans-serif; font-size:0.9rem;
    transition:border-color 0.3s,box-shadow 0.3s; outline:none;
}
.form-input::placeholder { color:rgba(255,255,255,0.3); }
.form-input:focus { border-color:rgba(26,79,160,0.6); box-shadow:0 0 0 3px rgba(26,79,160,0.15); }
textarea.form-input { height:140px; resize:vertical; }

/* ── BOOKING MODAL ────────────────────────── */
#booking-modal {
    display:none; position:fixed; inset:0; z-index:2000;
    background:rgba(3,8,16,0.85); backdrop-filter:blur(8px);
    align-items:center; justify-content:center; padding:1rem;
}
#booking-modal.open { display:flex; }
.modal-box {
    background:#0f1a2d; border:1px solid rgba(255,255,255,0.1);
    border-radius:var(--radius-xl); padding:2.5rem;
    max-width:520px; width:100%; position:relative;
    animation:modalIn 0.45s cubic-bezier(0.23,1,0.32,1);
}
@keyframes modalIn {
    from { opacity:0; transform:scale(0.9) translateY(20px); }
    to   { opacity:1; transform:scale(1) translateY(0); }
}
.modal-close {
    position:absolute; top:1.2rem; right:1.2rem;
    width:32px; height:32px; border-radius:8px;
    background:rgba(255,255,255,0.07); border:1px solid rgba(255,255,255,0.1);
    color:rgba(255,255,255,0.6); cursor:pointer;
    display:flex; align-items:center; justify-content:center;
    transition:var(--transition-base); font-size:1rem;
}
.modal-close:hover { background:rgba(255,255,255,0.15); color:#fff; }
.modal-pkg-preview {
    display:flex; gap:1rem;
    background:rgba(255,255,255,0.04); border:1px solid rgba(255,255,255,0.08);
    border-radius:var(--radius-lg); padding:1rem; margin-bottom:1.8rem;
}
.modal-pkg-preview img { width:80px; height:70px; object-fit:cover; border-radius:10px; flex-shrink:0; }
.modal-pkg-info strong { display:block; color:#fff; font-size:0.9rem; margin-bottom:4px; }
.modal-pkg-info span   { color:rgba(255,255,255,0.4); font-size:0.8rem; }
.modal-pkg-price  color:var(--nepal-gold); font-family:'Cinzel',serif; font-size:1.2rem; font-weight
@endsection

@section('content')
{{-- ── HERO ──────────────────────────────────────── --}}
<section id="hero">
    <div class="hero-bg" id="heroBg"></div>
    <div class="hero-particles" id="heroParticles"></div>

    <div class="hero-content">
        <div class="hero-eyebrow" id="heroEyebrow">
            <span class="dot"></span>
            Discover the Himalayas
        </div>

        <span class="hero-welcome" id="heroWelcome">Welcome To</span>

        <h1 class="hero-title" id="heroTitle">
            <span class="letter">N</span>
            <span class="letter">E</span>
            <span class="letter">P</span>
            <span class="letter">A</span>
            <span class="letter">L</span>
        </h1>

        <p class="hero-sub" id="heroSub">
            A Land of Majestic Himalayas, Rich Culture &amp; Endless Adventure
        </p>

        <div class="hero-actions" id="heroActions">
            <a href="{{ route('destinations.index') }}" class="btn-primary">
                <i class="fas fa-compass"></i> Explore Destinations
            </a>
            <button class="btn-outline"
                    onclick="document.getElementById('heroVideoModal').style.display='flex'">
                <i class="fas fa-play"></i> Watch Video
            </button>
        </div>

        <div class="hero-stats" id="heroStats">
            <div class="hero-stat-item">
                <span class="hero-stat-num count-up" data-target="5000">0</span>
                <span class="hero-stat-num">+</span>
                <span class="hero-stat-label">Treks Completed</span>
            </div>
            <div class="hero-stat-item">
                <span class="hero-stat-num count-up" data-target="200">0</span>
                <span class="hero-stat-num">+</span>
                <span class="hero-stat-label">Expert Guides</span>
            </div>
            <div class="hero-stat-item">
                <span class="hero-stat-num count-up" data-target="50">0</span>
                <span class="hero-stat-num">+</span>
                <span class="hero-stat-label">Destinations</span>
            </div>
            <div class="hero-stat-item">
                <span class="hero-stat-num count-up" data-target="98">0</span>
                <span class="hero-stat-num">%</span>
                <span class="hero-stat-label">Happy Customers</span>
            </div>
        </div>

        <div class="hero-badges" id="heroBadges">
            <div class="hero-badge">
                <i class="fas fa-tag"></i>
                <div class="hero-badge-text">
                    <strong>Best Price Guarantee</strong>
                    <span>Guaranteed Best Price</span>
                </div>
            </div>
            <div class="hero-badge">
                <i class="fas fa-headset"></i>
                <div class="hero-badge-text">
                    <strong>24/7 Support</strong>
                    <span>We are always here</span>
                </div>
            </div>
            <div class="hero-badge">
                <i class="fas fa-user-tie"></i>
                <div class="hero-badge-text">
                    <strong>Local Expert</strong>
                    <span>Guided by Local Expert</span>
                </div>
            </div>
            <div class="hero-badge">
                <i class="fas fa-shield-alt"></i>
                <div class="hero-badge-text">
                    <strong>Secure Booking</strong>
                    <span>Safe &amp; Secure Booking</span>
                </div>
            </div>
        </div>
    </div>

    <div class="scroll-indicator">
        <div class="mouse"></div>
        <span>Scroll</span>
    </div>
</section>

{{-- Hero video modal --}}
<div id="heroVideoModal"
     style="display:none;position:fixed;inset:0;z-index:3000;
            background:rgba(0,0,0,0.92);align-items:center;justify-content:center;"
     onclick="this.style.display='none'">
    <div style="max-width:800px;width:90%;position:relative;">
        <button onclick="document.getElementById('heroVideoModal').style.display='none'"
                style="position:absolute;top:-40px;right:0;background:none;border:none;
                       color:#fff;font-size:1.4rem;cursor:pointer;">✕ Close</button>
        <div style="aspect-ratio:16/9;background:#111;border-radius:16px;
                    display:flex;align-items:center;justify-content:center;
                    color:rgba(255,255,255,0.4);font-size:1rem;">
            🎬 Nepal Adventure Video Player
        </div>
    </div>
</div>


{{-- ── WHY CHOOSE US ─────────────────────────────── --}}
<section id="why-us">
    <div class="float-shape"
         style="width:400px;height:400px;background:radial-gradient(circle,rgba(26,79,160,0.1) 0%,transparent 70%);top:-100px;left:-100px;">
    </div>

    <div class="why-inner">
        <div>
            <div class="section-badge" data-aos="fade-right">
                <i class="fas fa-star"></i> Why Choose Us
            </div>
            <h2 class="section-title" data-aos="fade-right" data-aos-delay="100">
                Your Perfect <span>Nepal</span> Adventure Partner
            </h2>
            <p class="section-subtitle"
               data-aos="fade-right" data-aos-delay="200"
               style="margin-top:1rem;margin-bottom:2rem;">
                We combine local expertise with world-class service to ensure every journey
                through Nepal is extraordinary, safe, and unforgettable.
            </p>

            <div class="why-features-grid">
            @php
                $features = [
                    ['icon'=>'🏷️','title'=>'Best Price Guarantee',  'desc'=>'Get the best price for your dream adventure in Nepal.',              'delay'=>100],
                    ['icon'=>'🧭','title'=>'Expert Local Guides',    'desc'=>'Our experienced local guides ensure your safety and satisfaction.',  'delay'=>200],
                    ['icon'=>'🎧','title'=>'24/7 Customer Support',  'desc'=>'We are always here to assist you anytime, anywhere.',                'delay'=>300],
                    ['icon'=>'🔐','title'=>'Safe & Secure Booking',  'desc'=>'Your booking is safe with us. No hidden charges.',                   'delay'=>400],
                ];
                @endphp

                @foreach($features as $feature)
                <div class="feature-card"
                     data-aos="zoom-in"
                     data-aos-delay="{{ $feature['delay'] }}">
                    <div class="feature-icon">{{ $feature['icon'] }}</div>
                    <h3>{{ $feature['title'] }}</h3>
                    <p>{{ $feature['desc'] }}</p>
                </div>
                @endforeach
                </div>
        </div>

        <div data-aos="fade-left" data-aos-delay="200">
            <div class="video-wrapper">
                <img src="https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=900&q=80"
                     alt="Experience Nepal">
                <div class="play-btn"><i class="fas fa-play"></i></div>
                <div class="video-label">✨ Experience Nepal Like Never Before</div>
            </div>
        </div>
    </div>
</section>


{{-- ── DESTINATIONS ──────────────────────────────── --}}
<section id="destinations">
    <div class="section-header">
        <div class="section-badge" data-aos="fade-up">
            <i class="fas fa-map-marked-alt"></i> Explore More
        </div>
        <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">
            Popular <span>Destinations</span>
        </h2>
        <p class="section-subtitle"
           data-aos="fade-up" data-aos-delay="200"
           style="margin:0.8rem auto 0;">
            From the roof of the world to serene valleys — discover Nepal's most iconic destinations.
        </p>
    </div>

    <div class="destinations-grid">
    @php
        $destinations = [
            [
                'slug'  => 'pokhara',
                'name'  => 'Pokhara',
                'label' => 'The City of Lakes',
                'tag'   => 'Popular',
                'img'   => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=600&q=80',
                'delay' => 0,
            ],
            [
                'slug'  => 'everest-region',
                'name'  => 'Everest Region',
                'label' => 'Roof of the World',
                'tag'   => 'Iconic',
                'img'   => 'https://images.unsplash.com/photo-1522050212171-61b01dd24579?w=600&q=80',
                'delay' => 150,
            ],
            [
                'slug'  => 'annapurna-region',
                'name'  => 'Annapurna Region',
                'label' => 'Diverse Natural Beauty',
                'tag'   => 'Top Trek',
                'img'   => 'https://images.unsplash.com/photo-1598091383021-15ddea10925d?w=600&q=80',
                'delay' => 300,
            ],
            [
                'slug'  => 'kathmandu',
                'name'  => 'Kathmandu',
                'label' => 'Cultural Heart of Nepal',
                'tag'   => 'Heritage',
                'img'   => 'https://images.unsplash.com/photo-1562602834-6a4e28a4e014?w=600&q=80',
                'delay' => 450,
            ],
        ];
        @endphp

        @foreach($destinations as $dest)
        <a href="{{ route('destinations.show', $dest['slug']) }}"
           class="dest-card"
           data-aos="fade-up"
           data-aos-delay="{{ $dest['delay'] }}">
            <img src="{{ $dest['img'] }}" alt="{{ $dest['name'] }}" loading="lazy">
            <div class="dest-overlay"></div>
            <div class="dest-card-tag">{{ $dest['tag'] }}</div>
            <div class="dest-info">
                <h3>{{ $dest['name'] }}</h3>
                <p>{{ $dest['label'] }}</p>
            </div>
        </a>
        @endforeach
        </div>

    <div class="view-all-wrap" data-aos="fade-up" data-aos-delay="200">
        <a href="{{ route('destinations.index') }}" class="btn-primary">
            <i class="fas fa-globe-asia"></i> View All Destinations
        </a>
    </div>
</section>


{{-- ── TREKKING PLANS ────────────────────────────── --}}
<section id="treks">
    <div class="treks-inner">
        <div class="section-header">
            <div class="section-badge" data-aos="fade-up">
                <i class="fas fa-hiking"></i> Adventure Awaits
            </div>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">
                Top <span>Trekking</span> Plans
            </h2>
        </div>

        <div class="treks-grid">

        @php
            $treks = [
                [
                    'slug'       => 'everest-base-camp',
                    'name'       => 'Everest Base Camp Trek',
                    'days'       => 14,
                    'difficulty' => 'Moderate',
                    'diff_class' => 'difficulty-moderate',
                    'price'      => 1400,
                    'img'        => 'https://images.unsplash.com/photo-1522050212171-61b01dd24579?w=600&q=80',
                    'delay'      => 0,
                ],
                [
                    'slug'       => 'annapurna-circuit',
                    'name'       => 'Annapurna Circuit Trek',
                    'days'       => 16,
                    'difficulty' => 'Moderate',
                    'diff_class' => 'difficulty-moderate',
                    'price'      => 1250,
                    'img'        => 'https://images.unsplash.com/photo-1598091383021-15ddea10925d?w=600&q=80',
                    'delay'      => 150,
                ],
                [
                    'slug'       => 'langtang-valley',
                    'name'       => 'Langtang Valley Trek',
                    'days'       => 10,
                    'difficulty' => 'Easy',
                    'diff_class' => 'difficulty-easy',
                    'price'      => 950,
                    'img'        => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=600&q=80',
                    'delay'      => 300,
                ],
            ];
            @endphp

            @foreach($treks as $trek)
            <div class="trek-card"
                 data-aos="fade-up"
                 data-aos-delay="{{ $trek['delay'] }}">
                <div class="trek-img">
                    <img src="{{ $trek['img'] }}" alt="{{ $trek['name'] }}" loading="lazy">
                    <div class="trek-img-overlay"></div>
                    <span class="trek-difficulty {{ $trek['diff_class'] }}">
                        {{ $trek['difficulty'] }}
                    </span>
                </div>
                <div class="trek-body">
                    <h3>{{ $trek['name'] }}</h3>
                    <div class="trek-meta">
                        <span><i class="fas fa-calendar-alt"></i> {{ $trek['days'] }} Days</span>
                        <span><i class="fas fa-signal"></i> {{ $trek['difficulty'] }}</span>
                    </div>
                    <div class="trek-footer">
                        <div class="trek-price">
                            ${{ number_format($trek['price']) }}
                            <span>/ person</span>
                        </div>
                        <a href="{{ route('treks.show', $trek['slug']) }}" class="link-arrow">
                            View Details <i class="fas fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach

            </div>

        <div class="view-all-wrap" data-aos="fade-up">
            <a href="{{ route('treks.index') }}" class="btn-outline">
                <i class="fas fa-mountain"></i> View All Treks
            </a>
        </div>
    </div>
</section>


{{-- ── TOUR PACKAGES ─────────────────────────────── --}}
<section id="packages">
    <div class="packages-inner">
        <div class="section-header">
            <div class="section-badge" data-aos="fade-up">
                <i class="fas fa-suitcase"></i> Curated Journeys
            </div>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">
                Popular <span>Tour Packages</span>
            </h2>
        </div>

        <div class="packages-grid">
        @php
            $packages = [
                [
                    'slug'     => 'nepal-highlights',
                    'name'     => 'Nepal Highlights Tour',
                    'days'     => 7,
                    'price'    => 750,
                    'featured' => false,
                    'badge'    => 'Bestseller',
                    'img'      => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=600&q=80',
                    'services' => ['Hotel Accommodation','Breakfast','Sightseeing','Private Transport'],
                    'delay'    => 0,
                ],
                [
                    'slug'     => 'cultural-heritage',
                    'name'     => 'Cultural & Heritage Tour',
                    'days'     => 10,
                    'price'    => 1050,
                    'featured' => true,
                    'badge'    => 'Most Popular',
                    'img'      => 'https://images.unsplash.com/photo-1562602834-6a4e28a4e014?w=600&q=80',
                    'services' => ['Hotel Accommodation','Breakfast','Sightseeing','Private Transport'],
                    'delay'    => 150,
                ],
                [
                    'slug'     => 'himalayan-adventure',
                    'name'     => 'Himalayan Adventure Tour',
                    'days'     => 14,
                    'price'    => 1850,
                    'featured' => false,
                    'badge'    => 'Adventure',
                    'img'      => 'https://images.unsplash.com/photo-1529928520614-7b080df4db7a?w=600&q=80',
                    'services' => ['Hotel Accommodation','Breakfast','Sightseeing','Private Transport'],
                    'delay'    => 300,
                ],
            ];
            @endphp

            @foreach($packages as $pkg)
            <div class="pkg-card {{ $pkg['featured'] ? 'featured' : '' }}"
                 data-aos="fade-up"
                 data-aos-delay="{{ $pkg['delay'] }}">
                <div class="pkg-img">
                    <img src="{{ $pkg['img'] }}" alt="{{ $pkg['name'] }}" loading="lazy">
                    <span class="pkg-badge">{{ $pkg['badge'] }}</span>
                </div>
                <div class="pkg-body">
                    <div class="pkg-meta">
                        <span class="pkg-days">
                            <i class="fas fa-clock"></i> {{ $pkg['days'] }} Days
                        </span>
                        <span class="pkg-price">${{ number_format($pkg['price']) }}</span>
                    </div>
                    <h3>{{ $pkg['name'] }}</h3>
                    <ul class="pkg-services">
                        @foreach($pkg['services'] as $service)
                        <li><i class="fas fa-check-circle"></i> {{ $service }}</li>
                        @endforeach
                    </ul>
                    <a href="{{ route('booking.create', $pkg['slug']) }}"
                       class="btn-primary"
                       style="width:100%;justify-content:center;display:inline-flex;">
                        <i class="fas fa-calendar-check"></i> Book Now
                    </a>
                </div>
            </div>
            @endforeach
            </div>

        <div class="view-all-wrap" data-aos="fade-up">
            <a href="{{ route('packages.index') }}" class="btn-outline">
                <i class="fas fa-suitcase-rolling"></i> View All Packages
            </a>
        </div>
    </div>
</section>


{{-- ── TESTIMONIALS ──────────────────────────────── --}}
<section id="testimonials">
    <div class="testimonials-inner">
        <div class="section-header">
            <div class="section-badge" data-aos="fade-up">
                <i class="fas fa-heart"></i> Happy Customers
            </div>
            <h2 class="section-title" data-aos="fade-up" data-aos-delay="100">
                What <span>Travellers</span> Say
            </h2>
        </div>

        <div class="testimonials-slider" data-aos="fade-up" data-aos-delay="200">
            <div class="testimonials-track" id="testiTrack">
            @php
                $testimonials = [
                    ['name'=>'Emily Johnson', 'location'=>'United States', 'stars'=>5,
                     'text'=>'Our trip to Nepal was beyond amazing! The mountains, culture, and people are incredible. Highly recommended!',
                     'img'=>'https://randomuser.me/api/portraits/women/44.jpg'],
                    ['name'=>'James Wilson',  'location'=>'United Kingdom', 'stars'=>5,
                     'text'=>'The Everest Base Camp trek was the experience of a lifetime. Our guide was fantastic and made every step worthwhile!',
                     'img'=>'https://randomuser.me/api/portraits/men/32.jpg'],
                    ['name'=>'Sophie Müller','location'=>'Germany',         'stars'=>5,
                     'text'=>'Pokhara is absolutely stunning. The lakeside views, the warm hospitality — Nepal has stolen my heart completely.',
                     'img'=>'https://randomuser.me/api/portraits/women/65.jpg'],
                    ['name'=>'Raj Sharma',   'location'=>'India',           'stars'=>5,
                     'text'=>'Perfectly organised tour. Everything from airport pickup to the final farewell was handled with utmost professionalism.',
                     'img'=>'https://randomuser.me/api/portraits/men/75.jpg'],
                ];
                @endphp

                @foreach($testimonials as $testi)
                <div class="testimonial-card">
                    <span class="testi-quote">"</span>
                    <div class="testi-stars">
                        @for($i = 0; $i < $testi['stars']; $i++)
                        <i class="fas fa-star"></i>
                        @endfor
                    </div>
                    <p class="testi-text">{{ $testi['text'] }}</p>
                    <div class="testi-header" style="margin-top:1.5rem;margin-bottom:0;">
                        <div class="testi-avatar">
                            <img src="{{ $testi['img'] }}" alt="{{ $testi['name'] }}">
                        </div>
                        <div>
                            <div class="testi-name">{{ $testi['name'] }}</div>
                            <div class="testi-location">
                                <i class="fas fa-map-marker-alt"
                                   style="color:var(--nepal-gold);margin-right:4px;font-size:.75rem;"></i>
                                {{ $testi['location'] }}
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                </div>

            <div class="slider-controls">
                <button class="slider-btn" onclick="moveSlider(-1)" aria-label="Previous">
                    <i class="fas fa-chevron-left"></i>
                </button>
                <button class="slider-btn" onclick="moveSlider(1)" aria-label="Next">
                    <i class="fas fa-chevron-right"></i>
                </button>
            </div>

            <div class="slider-dots" id="sliderDots"></div>
        </div>

        <div class="view-all-wrap" data-aos="fade-up">
            <a href="{{ route('contact') }}" class="btn-outline">
                <i class="fas fa-comments"></i> View All Reviews
            </a>
        </div>
    </div>
</section>


{{-- ── CTA ───────────────────────────────────────── --}}
<section id="cta">
    <div class="cta-bg"></div>
    <div class="cta-inner">
        <div class="section-badge" data-aos="fade-up" style="margin:0 auto 1.5rem;">
            <i class="fas fa-rocket"></i> Start Your Journey
        </div>
        <h2 data-aos="fade-up" data-aos-delay="100">
            Ready to <span style="color:var(--nepal-gold);">Explore Nepal?</span>
        </h2>
        <p data-aos="fade-up" data-aos-delay="200">
            Let us help you plan the perfect trip of your lifetime.
            Adventure, culture, and breathtaking landscapes await!
        </p>
        <div class="cta-actions" data-aos="fade-up" data-aos-delay="300">
            <a href="{{ route('contact') }}" class="btn-gold">
                <i class="fas fa-paper-plane"></i> Contact Us Now
            </a>
            <a href="{{ route('packages.index') }}" class="btn-outline">
                <i class="fas fa-suitcase"></i> View Packages
            </a>
        </div>
    </div>
</section>


{{-- ── CONTACT ────────────────────────────────────── --}}
<section id="contact">
    <div class="contact-inner">
        <div>
            <div class="section-badge" data-aos="fade-right">
                <i class="fas fa-envelope"></i> Get In Touch
            </div>
            <h2 class="section-title" data-aos="fade-right" data-aos-delay="100">
                Have Any <span>Questions?</span>
            </h2>
            <p class="section-subtitle"
               data-aos="fade-right" data-aos-delay="200"
               style="margin-top:0.8rem;margin-bottom:2.5rem;">
                We're here to help! Send us a message and we'll get back to you.
            </p>

@php
            $contactItems = [
                ['icon'=>'fa-map-marker-alt', 'title'=>'Our Office',     'value'=>'Thamel, Kathmandu, Nepal'],
                ['icon'=>'fa-phone',          'title'=>'Phone Number',    'value'=>'+977 9713478474'],
                ['icon'=>'fa-envelope',       'title'=>'Email Address',   'value'=>'info@Apeaknepal.com'],
                ['icon'=>'fa-globe',          'title'=>'Website',         'value'=>'www.Apeaknepal.com'],
            ];
            @endphp

            @foreach($contactItems as $idx => $item)
            <div class="contact-info-item"
                 data-aos="fade-right"
                 data-aos-delay="{{ $idx * 100 }}">
                <div class="contact-info-icon">
                    <i class="fas {{ $item['icon'] }}"></i>
                </div>
                <div class="contact-info-text">
                    <strong>{{ $item['title'] }}</strong>
                    <span>{{ $item['value'] }}</span>
                </div>
            </div>
            @endforeach

</div>

        <div class="contact-form" data-aos="fade-left" data-aos-delay="200">
            <h3>Send a Message</h3>
            <p>Fill out the form and our team will get in touch within 24 hours.</p>

            <form action="{{ route('contact.send') }}" method="POST" id="contactForm">
                @csrf
                <div class="form-group">
                    <input type="text"  name="name"    class="form-input" placeholder="Your Name"     required>
                </div>
                <div class="form-group">
                    <input type="email" name="email"   class="form-input" placeholder="Email Address"  required>
                </div>
                <div class="form-group">
                    <input type="tel"   name="phone"   class="form-input" placeholder="Phone Number">
                </div>
                <div class="form-group">
                    <textarea           name="message" class="form-input" placeholder="Your Message"   required></textarea>
                </div>
                <button type="submit" class="btn-primary" style="width:100%;justify-content:center;">
                    <i class="fas fa-paper-plane"></i> Send Message
                </button>
            </form>
        </div>
    </div>
</section>


{{-- ── BOOKING MODAL ──────────────────────────────── --}}
<div id="booking-modal">
    <div class="modal-box">
        <button class="modal-close" onclick="closeBookingModal()">
            <i class="fas fa-times"></i>
        </button>
        <h3 style="font-family:'Cinzel',serif;color:#fff;margin-bottom:1.5rem;font-size:1.2rem;">
            Book This Package
        </h3>
        <div class="modal-pkg-preview">
            <img id="modal-img" src="" alt="Package">
            <div class="modal-pkg-info">
                <strong id="modal-name">–</strong>
                <span id="modal-days">–</span><br>
                <span class="modal-pkg-price" id="modal-price">–</span>
            </div>
        </div>
        <form action="{{ route('booking.store') }}" method="POST">
            @csrf
            <input type="hidden" name="package" id="modal-package-name">
            <div class="form-group">
                <input type="text"  name="full_name" class="form-input" placeholder="Full Name"      required>
            </div>
            <div class="form-group">
                <input type="email" name="email"     class="form-input" placeholder="Email Address"  required>
            </div>
            <div class="form-group">
                <input type="tel"   name="phone"     class="form-input" placeholder="Phone Number"   required>
            </div>
            <button type="submit" class="btn-gold"
                    style="width:100%;justify-content:center;margin-top:0.5rem;">
                <i class="fas fa-arrow-right"></i> Continue to Payment
            </button>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
gsap.registerPlugin(ScrollTrigger, TextPlugin);

/* ── Hero entrance ───────────────────────── */
(function initHero() {
    const tl = gsap.timeline({ delay: 0.4 });
    tl.to('#heroEyebrow', { opacity:1, y:0, duration:0.7, ease:'power3.out' })
      .to('#heroWelcome', { opacity:1, y:0, duration:0.7, ease:'power3.out' }, '-=0.3')
      .from('.hero-title .letter', {
          opacity:0, y:120, rotationX:-90,
          stagger:0.08, duration:0.9, ease:'back.out(1.7)'
      }, '-=0.3')
      .to('#heroTitle',  { opacity:1, duration:0 }, '<')
      .to('#heroSub',    { opacity:1, y:0, duration:0.7, ease:'power3.out' }, '-=0.3')
      .to('#heroActions',{ opacity:1, y:0, duration:0.6, ease:'power3.out' }, '-=0.3')
      .to('#heroStats',  { opacity:1,       duration:0.6, ease:'power3.out' }, '-=0.2')
      .to('#heroBadges', { opacity:1, y:0, duration:0.6, ease:'power3.out' }, '-=0.3');
})();

/* ── Hero parallax ───────────────────────── */
gsap.to('#heroBg', {
    yPercent: 30, ease:'none',
    scrollTrigger:{ trigger:'#hero', start:'top top', end:'bottom top', scrub:true }
});

/* ── Particles ───────────────────────────── */
(function spawnParticles() {
    const container = document.getElementById('heroParticles');
    const colors = ['rgba(232,160,32,0.6)','rgba(26,79,160,0.6)','rgba(255,255,255,0.4)'];
    for (let i = 0; i < 22; i++) {
        const p   = document.createElement('div');
        p.className = 'particle';
        const size  = Math.random() * 6 + 2;
        p.style.cssText = `
            width:${size}px; height:${size}px;
            background:${colors[Math.floor(Math.random()*colors.length)]};
            left:${Math.random()*100}%;
            animation-duration:${Math.random()*12+8}s;
            animation-delay:${Math.random()*10}s;
        `;
        container.appendChild(p);
    }
})();

/* ── Count-up numbers ────────────────────── */
document.querySelectorAll('.count-up').forEach(el => {
    const target = +el.dataset.target;
    ScrollTrigger.create({
        trigger: el, start:'top 85%', once:true,
        onEnter: () => {
            gsap.to({ val:0 }, {
                val: target, duration:2, ease:'power2.out',
                onUpdate: function(){ el.textContent = Math.round(this.targets()[0].val).toLocaleString(); }
            });
        }
    });
});

/* ── Section title reveal ────────────────── */
document.querySelectorAll('.section-title').forEach(el => {
    gsap.from(el, {
        scrollTrigger:{ trigger:el, start:'top 85%', once:true },
        opacity:0, y:60, duration:1, ease:'power4.out'
    });
});

/* ── Destination cards — stagger + 3-D tilt  */
gsap.from('.dest-card', {
    scrollTrigger:{ trigger:'.destinations-grid', start:'top 80%', once:true },
    opacity:0, scale:0.85, y:50, stagger:0.12, duration:0.8, ease:'back.out(1.4)'
});

document.querySelectorAll('.dest-card').forEach(card => {
    card.addEventListener('mousemove', e => {
        const r = card.getBoundingClientRect();
        const x = (e.clientX - r.left)/r.width  - 0.5;
        const y = (e.clientY - r.top) /r.height - 0.5;
        gsap.to(card, { rotationY:x*14, rotationX:-y*14, transformPerspective:800, duration:0.5, ease:'power2.out' });
    });
    card.addEventListener('mouseleave', () => {
        gsap.to(card, { rotationY:0, rotationX:0, duration:0.6, ease:'elastic.out(1,0.5)' });
    });
});

/* ── Trek cards — alternating slide ─────── */
document.querySelectorAll('.trek-card').forEach((card, i) => {
    gsap.from(card, {
        scrollTrigger:{ trigger:card, start:'top 85%', once:true },
        x: i % 2 === 0 ? -60 : 60, opacity:0, duration:0.8, ease:'power3.out'
    });
});

/* ── Package cards — flip-in ─────────────── */
gsap.from('.pkg-card', {
    scrollTrigger:{ trigger:'.packages-grid', start:'top 80%', once:true },
    opacity:0, rotationY:25, y:40, transformOrigin:'left center',
    stagger:0.15, duration:0.9, ease:'power3.out'
});

/* ── Feature cards — float hover ─────────── */
document.querySelectorAll('.feature-card').forEach(card => {
    card.addEventListener('mouseenter', () => gsap.to(card, { y:-8, duration:0.4, ease:'power2.out' }));
    card.addEventListener('mouseleave', () => gsap.to(card, { y:0,  duration:0.4, ease:'power2.out' }));
});

/* ── CTA headline morph ──────────────────── */
gsap.from('#cta .cta-inner h2', {
    scrollTrigger:{ trigger:'#cta', start:'top 75%', once:true },
    opacity:0, scale:1.15, duration:1.1, ease:'power4.out'
});

/* ── Contact items slide ─────────────────── */
gsap.from('.contact-info-item', {
    scrollTrigger:{ trigger:'.contact-inner', start:'top 80%', once:true },
    x:-50, opacity:0, stagger:0.12, duration:0.7, ease:'power3.out'
});

/* ── Testimonials slider ─────────────────── */
let currentSlide = 0;
const track      = document.getElementById('testiTrack');
const cards      = track ? track.querySelectorAll('.testimonial-card') : [];
const dotsEl     = document.getElementById('sliderDots');
let totalSlides  = 0;

if (cards.length) {
    totalSlides = Math.ceil(cards.length / 2);
    for (let i = 0; i < totalSlides; i++) {
        const d = document.createElement('div');
        d.className = 'slider-dot' + (i === 0 ? ' active' : '');
        d.onclick   = () => goToSlide(i);
        dotsEl.appendChild(d);
    }
    setInterval(() => moveSlider(1), 5000);
}

function moveSlider(dir) {
    currentSlide = (currentSlide + dir + totalSlides) % totalSlides;
    goToSlide(currentSlide);
}
function goToSlide(idx) {
    currentSlide = idx;
    const cardWidth = cards[0].offsetWidth + 22;
    gsap.to(track, { x:-idx * cardWidth * 2, duration:0.7, ease:'power3.inOut' });
    document.querySelectorAll('.slider-dot').forEach((d,i) => d.classList.toggle('active', i===idx));
}

/* ── Booking modal ───────────────────────── */
function openBookingModal(name, days, price, img) {
    document.getElementById('modal-name').textContent   = name;
    document.getElementById('modal-days').textContent   = days;
    document.getElementById('modal-price').textContent  = '$' + price;
    document.getElementById('modal-img').src            = img;
    document.getElementById('modal-package-name').value = name;
    document.getElementById('booking-modal').classList.add('open');
    gsap.from('.modal-box', { scale:0.85, opacity:0, duration:0.45, ease:'back.out(1.7)' });
}
function closeBookingModal() {
    gsap.to('.modal-box', {
        scale:0.85, opacity:0, duration:0.3, ease:'power2.in',
        onComplete() {
            document.getElementById('booking-modal').classList.remove('open');
            gsap.set('.modal-box', { clearProps:'all' });
        }
    });
}
document.getElementById('booking-modal').addEventListener('click', function(e) {
    if (e.target === this) closeBookingModal();
});

/* ── Form input micro-animations ─────────── */
document.querySelectorAll('.form-input').forEach(input => {
    input.addEventListener('focus', () => gsap.to(input, { scale:1.01, duration:0.3, ease:'power2.out' }));
    input.addEventListener('blur',  () => gsap.to(input, { scale:1,    duration:0.3, ease:'power2.out' }));
});

/* ── Magnetic buttons ────────────────────── */
document.querySelectorAll('.btn-primary,.btn-gold,.btn-outline').forEach(btn => {
    btn.addEventListener('mousemove', e => {
        const r = btn.getBoundingClientRect();
        gsap.to(btn, {
            x:(e.clientX - r.left - r.width/2)  * 0.15,
            y:(e.clientY - r.top  - r.height/2) * 0.15,
            duration:0.4, ease:'power2.out'
        });
    });
    btn.addEventListener('mouseleave', () => {
        gsap.to(btn, { x:0, y:0, duration:0.5, ease:'elastic.out(1,0.5)' });
    });
});

/* ── Smooth anchor scroll ────────────────── */
document.querySelectorAll('a[href^="#"]').forEach(a => {
    a.addEventListener('click', e => {
        const target = document.querySelector(a.getAttribute('href'));
        if (target) {
            e.preventDefault();
            gsap.to(window, { duration:1.2, scrollTo:{ y:target, offsetY:72 }, ease:'power4.inOut' });
        }
    });
});
</script>
@endsection
