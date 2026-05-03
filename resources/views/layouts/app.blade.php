<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Visit Nepal - Dream • Explore • Discover</title>
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Dancing+Script:wght@700&family=Open+Sans:wght@300;400;600&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
:root {
    --blue-primary: #1a73e8;
    --blue-dark: #0d5bc2;
    --blue-light: #4A90D9;
    --white: #ffffff;
    --text-dark: #1a1a2e;
    --text-light: #777;
    --bg-light: #f4f7fc;
    --gold: #e8a020;
    --font-display: 'Cinzel', serif;
    --font-script: 'Dancing Script', cursive;
    --font-body: 'Open Sans', sans-serif;
    --header-height: 80px;
    --transition: all 0.3s ease;
    --radius: 16px;
    --shadow: 0 10px 40px rgba(0,0,0,0.12);
}

*,*::before,*::after{box-sizing:border-box;margin:0;padding:0}
html{scroll-behavior:smooth}
body{font-family:var(--font-body);color:var(--text-dark);background:var(--white);overflow-x:hidden}
a{text-decoration:none;color:inherit}
ul{list-style:none}
img{max-width:100%;display:block}
.container{max-width:1280px;margin:0 auto;padding:0 24px}

/* HEADER */
.site-header{position:fixed;top:0;left:0;right:0;z-index:1000;transition:var(--transition)}
.site-header.scrolled{background:rgba(10,30,70,0.95);backdrop-filter:blur(12px);box-shadow:0 4px 30px rgba(0,0,0,0.3)}
.navbar{display:flex;align-items:center;justify-content:space-between;height:var(--header-height);padding:0 32px;gap:20px}
.brand-link{display:flex;align-items:center;gap:10px}
.brand-text{display:flex;flex-direction:column}
.brand-name{font-family:var(--font-display);font-size:1.25rem;font-weight:700;color:var(--white);line-height:1}
.brand-tagline{font-size:0.65rem;color:rgba(255,255,255,0.7);letter-spacing:0.05em;line-height:1.4}
.navbar-nav{display:flex;align-items:center;gap:6px;flex:1;justify-content:center}
.nav-item{position:relative}
.nav-link{display:flex;align-items:center;gap:4px;padding:8px 14px;font-size:0.95rem;font-weight:600;color:rgba(255,255,255,0.9);border-radius:6px;transition:var(--transition);white-space:nowrap;cursor:pointer}
.nav-link:hover,.nav-item.active .nav-link{color:var(--blue-light)}
.dropdown-icon{font-size:0.65rem;transition:transform 0.3s}
.has-dropdown:hover .dropdown-icon{transform:rotate(180deg)}
.dropdown-menu{position:absolute;top:calc(100% + 8px);left:0;background:rgba(10,28,65,0.97);border-radius:10px;min-width:180px;padding:8px 0;box-shadow:0 20px 50px rgba(0,0,0,0.4);opacity:0;visibility:hidden;transform:translateY(-8px);transition:var(--transition);border:1px solid rgba(255,255,255,0.08)}
.has-dropdown:hover .dropdown-menu{opacity:1;visibility:visible;transform:translateY(0)}
.dropdown-menu a{display:block;padding:10px 20px;font-size:0.9rem;color:rgba(255,255,255,0.85);transition:var(--transition)}
.dropdown-menu a:hover{color:var(--blue-light);background:rgba(255,255,255,0.05);padding-left:26px}
.btn{display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border-radius:50px;font-weight:700;font-size:0.95rem;cursor:pointer;border:none;transition:var(--transition);text-decoration:none}
.btn-primary{background:var(--blue-primary);color:var(--white)}
.btn-primary:hover{background:var(--blue-dark);transform:translateY(-2px);box-shadow:0 8px 24px rgba(26,115,232,0.5)}
.btn-outline{background:transparent;color:var(--white);border:2px solid rgba(255,255,255,0.7)}
.btn-outline:hover{background:rgba(255,255,255,0.15);border-color:var(--white);transform:translateY(-2px)}
.btn-hero{padding:14px 32px;font-size:1rem;font-family:var(--font-display);letter-spacing:0.02em}
.btn-explore{font-size:0.9rem;padding:10px 22px;border-radius:50px;font-weight:700;white-space:nowrap}

/* SOCIAL SIDEBAR */
.social-sidebar{position:fixed;right:0;top:50%;transform:translateY(-50%);z-index:999;display:flex;flex-direction:column;align-items:center;gap:10px;padding:16px 10px;background:rgba(10,28,65,0.7);backdrop-filter:blur(8px);border-radius:12px 0 0 12px}
.follow-text{font-size:0.6rem;color:rgba(255,255,255,0.7);letter-spacing:0.1em;writing-mode:vertical-rl;text-transform:uppercase;margin-bottom:4px}
.social-icon{width:32px;height:32px;display:flex;align-items:center;justify-content:center;color:var(--white);border:1px solid rgba(255,255,255,0.25);border-radius:50%;font-size:0.8rem;transition:var(--transition)}
.social-icon:hover{background:var(--blue-primary);border-color:var(--blue-primary)}

/* HERO */
.hero-section{position:relative;width:100%;height:100vh;min-height:650px;display:flex;align-items:center;justify-content:flex-start;overflow:hidden}
.hero-bg{position:absolute;inset:0;z-index:0}
.hero-bg-img{width:100%;height:100%;object-fit:cover;object-position:center top}
.hero-overlay{position:absolute;inset:0;background:linear-gradient(to right,rgba(5,15,40,0.65) 0%,rgba(5,15,40,0.25) 60%,transparent 100%)}
.hero-wave{position:absolute;bottom:-2px;left:0;right:0;z-index:2;line-height:0}
.hero-wave svg{width:100%;height:80px;display:block}
.hero-content{position:relative;z-index:3;padding:0 80px;padding-top:var(--header-height);max-width:680px}
.hero-subtitle{font-family:var(--font-script);font-size:2.2rem;color:var(--gold);margin-bottom:4px;line-height:1.2}
.hero-title{font-family:var(--font-display);font-size:clamp(4rem,10vw,7.5rem);font-weight:700;color:var(--white);line-height:0.9;letter-spacing:0.04em;text-shadow:0 4px 30px rgba(0,0,0,0.5);margin-bottom:20px}
.hero-description{font-size:1rem;color:rgba(255,255,255,0.9);letter-spacing:0.12em;font-weight:600;line-height:1.7;margin-bottom:36px}
.hero-buttons{display:flex;gap:16px;flex-wrap:wrap}
.scroll-down{position:absolute;bottom:100px;right:50px;z-index:3;display:flex;flex-direction:column;align-items:center;gap:8px;color:rgba(255,255,255,0.7);font-size:0.75rem;letter-spacing:0.08em}
.scroll-icon{width:28px;height:44px;border:2px solid rgba(255,255,255,0.5);border-radius:20px;display:flex;justify-content:center;padding-top:8px}
.scroll-icon span{width:4px;height:8px;background:rgba(255,255,255,0.8);border-radius:4px;animation:scrollAnim 1.6s ease-in-out infinite}
@keyframes scrollAnim{0%{transform:translateY(0);opacity:1}100%{transform:translateY(14px);opacity:0}}

/* FEATURES BAR */
.features-bar{background:var(--white);padding:40px 0 50px;position:relative;z-index:1}
.features-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px;text-align:center}
.feature-item{display:flex;align-items:center;justify-content:center;gap:14px;padding:20px}
.feature-icon{width:52px;height:52px;border-radius:50%;background:rgba(26,115,232,0.08);display:flex;align-items:center;justify-content:center;flex-shrink:0;color:var(--blue-primary);font-size:1.3rem}
.feature-text{text-align:left}
.feature-text h4{font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--text-dark);margin-bottom:2px}
.feature-text p{font-size:0.82rem;color:var(--text-light)}

/* DESTINATIONS */
.destinations-section{padding:60px 0 80px;background:var(--bg-light)}
.section-header{text-align:center;margin-bottom:48px}
.section-label{font-size:0.78rem;font-weight:700;letter-spacing:0.18em;color:var(--blue-primary);text-transform:uppercase;display:block;margin-bottom:10px}
.section-title{font-family:var(--font-display);font-size:clamp(1.8rem,4vw,2.8rem);font-weight:700;color:var(--text-dark);margin-bottom:16px}
.section-divider{display:flex;justify-content:center}
.destinations-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:20px}
.destination-card{border-radius:var(--radius);overflow:hidden;background:var(--white);box-shadow:var(--shadow);transition:var(--transition);cursor:pointer}
.destination-card:hover{transform:translateY(-8px);box-shadow:0 20px 60px rgba(0,0,0,0.2)}
.card-image{position:relative;height:260px;overflow:hidden}
.card-image img{width:100%;height:100%;object-fit:cover;transition:transform 0.5s ease}
.destination-card:hover .card-image img{transform:scale(1.08)}
.card-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(5,15,40,0.7) 0%,transparent 60%)}
.card-tag{position:absolute;top:14px;right:14px;background:var(--blue-primary);color:var(--white);font-size:0.72rem;font-weight:700;padding:4px 12px;border-radius:20px;letter-spacing:0.06em}
.card-body{padding:18px 20px}
.card-title{font-family:var(--font-display);font-size:1.15rem;font-weight:700;color:var(--text-dark);margin-bottom:4px}
.card-subtitle{font-size:0.83rem;color:var(--text-light)}

/* FOOTER */
.site-footer{background:#08142e;color:var(--white)}
.footer-top{padding:70px 0 50px}
.footer-grid{display:grid;grid-template-columns:2fr 1fr 1fr 1.5fr;gap:48px}
.footer-logo{display:flex;align-items:center;gap:10px;font-family:var(--font-display);font-size:1.2rem;font-weight:700;margin-bottom:18px}
.footer-desc{font-size:0.88rem;color:rgba(255,255,255,0.6);line-height:1.75;margin-bottom:24px}
.footer-social{display:flex;gap:12px}
.footer-social-link{width:38px;height:38px;border:1px solid rgba(255,255,255,0.2);border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:0.85rem;color:rgba(255,255,255,0.7);transition:var(--transition)}
.footer-social-link:hover{background:var(--blue-primary);border-color:var(--blue-primary);color:var(--white)}
.footer-heading{font-family:var(--font-display);font-size:0.95rem;font-weight:700;color:var(--white);margin-bottom:20px;letter-spacing:0.05em}
.footer-links li{margin-bottom:10px}
.footer-links a{font-size:0.88rem;color:rgba(255,255,255,0.6);transition:var(--transition)}
.footer-links a:hover{color:var(--blue-light);padding-left:4px}
.footer-contact{display:flex;flex-direction:column;gap:14px}
.footer-contact li{display:flex;align-items:flex-start;gap:12px;font-size:0.88rem;color:rgba(255,255,255,0.6)}
.footer-contact li i{color:var(--blue-light);margin-top:2px;flex-shrink:0}
.footer-bottom{border-top:1px solid rgba(255,255,255,0.08);padding:20px 0}
.footer-bottom .container{display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap}
.footer-bottom p{font-size:0.83rem;color:rgba(255,255,255,0.5)}
.footer-bottom-links{display:flex;gap:24px}
.footer-bottom-links a{font-size:0.83rem;color:rgba(255,255,255,0.5);transition:var(--transition)}
.footer-bottom-links a:hover{color:var(--blue-light)}

@media(max-width:1100px){.destinations-grid{grid-template-columns:repeat(2,1fr)}.footer-grid{grid-template-columns:1fr 1fr}}
@media(max-width:900px){.features-grid{grid-template-columns:repeat(2,1fr)}.navbar-nav,.navbar-cta{display:none}.hero-content{padding:0 32px;padding-top:var(--header-height)}.social-sidebar{display:none}}
@media(max-width:600px){.destinations-grid{grid-template-columns:1fr}.features-grid{grid-template-columns:1fr}.footer-grid{grid-template-columns:1fr}.hero-title{font-size:4rem}.hero-subtitle{font-size:1.6rem}}
</style>
</head>
<body>

<!-- HEADER -->
<header class="site-header" id="site-header">
    <nav class="navbar">

        <div class="navbar-brand">
            <a href="{{ route('home') }}" class="brand-link">
                <div class="brand-logo">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <polygon points="20,2 38,32 2,32" fill="none" stroke="white" stroke-width="2.5"/>
                        <polygon points="20,10 30,28 10,28" fill="white" opacity="0.6"/>
                        <polygon points="20,16 26,26 14,26" fill="white"/>
                    </svg>
                </div>
                <div class="brand-text">
                    <span class="brand-name">Visit Nepal</span>
                    <span class="brand-tagline">Dream • Explore • Discover</span>
                </div>
            </a>
        </div>

        <ul class="navbar-nav" id="navbar-nav">

            <li class="nav-item">
                <a href="{{ route('home') }}" class="nav-link">Home</a>
            </li>

            <li class="nav-item has-dropdown">
                <a href="{{ route('destinations.index') }}" class="nav-link">
                    Destinations <i class="fas fa-chevron-down dropdown-icon"></i>
                </a>

                <ul class="dropdown-menu">
                    <li><a href="{{ route('destinations.show', 'pokhara') }}">Pokhara</a></li>
                    <li><a href="{{ route('destinations.show', 'everest-region') }}">Everest Region</a></li>
                    <li><a href="{{ route('destinations.show', 'annapurna-region') }}">Annapurna Region</a></li>
                    <li><a href="{{ route('destinations.show', 'kathmandu') }}">Kathmandu</a></li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="{{ route('treks.index') }}" class="nav-link">Treks</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('packages.index') }}" class="nav-link">Packages</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('about') }}" class="nav-link">About Us</a>
            </li>

            <li class="nav-item">
                <a href="{{ route('contact') }}" class="nav-link">Contact</a>
            </li>

        </ul>

        <div class="navbar-cta">
            <a href="{{ route('packages.index') }}" class="btn btn-primary btn-explore">
                Explore Packages
            </a>
        </div>

    </nav>

    <div class="social-sidebar">
        <span class="follow-text">Follow Us</span>
        <a href="#" class="social-icon"><i class="fab fa-facebook-f"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-instagram"></i></a>
        <a href="#" class="social-icon"><i class="fab fa-twitter"></i></a>
    </div>
</header>

<!-- HERO -->
<section class="hero-section" id="home">
    <div class="hero-bg">
      <img src="{{ asset('storage/image/Hero.png') }}" alt="Sangeetha">

    </div>
    <div class="hero-wave">
        <svg viewBox="0 0 1440 80" preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M0,40 C180,80 360,0 540,40 C720,80 900,0 1080,40 C1260,80 1380,20 1440,40 L1440,80 L0,80 Z" fill="#ffffff"/>
        </svg>
    </div>
    <div class="hero-content">
        <p class="hero-subtitle">Welcome To</p>
        <h1 class="hero-title">NEPAL</h1>
        <p class="hero-description">A LAND OF MAJESTIC HIMALAYAS<br>RICH CULTURE &amp; ENDLESS ADVENTURE. Country known for its 
        breathtaking mountains, rich cultural heritage, and warm hospitality.
         Home to Mount Everest, it offers world-class trekking, stunning landscapes, and diverse wildlife.</p>
        <div class="hero-buttons">
            <a href="#destinations" class="btn btn-primary btn-hero"><i class="fas fa-mountain"></i> Explore Destinations</a>
            <a href="#" class="btn btn-outline btn-hero"><i class="fas fa-play"></i> Watch Video</a>
        </div>
    </div>
    <div class="scroll-down">
        <div class="scroll-icon"><span></span></div>
        <p>Scroll Down</p>
    </div>
</section>

<!-- FEATURES BAR -->
<section class="features-bar">
    <div class="container">
        <div class="features-grid">
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-tag"></i></div>
                <div class="feature-text"><h4>Best Price</h4><p>Guaranteed Best Price</p></div>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-headset"></i></div>
                <div class="feature-text"><h4>24/7 Support</h4><p>We are always here</p></div>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-user-tie"></i></div>
                <div class="feature-text"><h4>Local Expert</h4><p>Guided by Local Expert</p></div>
            </div>
            <div class="feature-item">
                <div class="feature-icon"><i class="fas fa-shield-alt"></i></div>
                <div class="feature-text"><h4>Secure Booking</h4><p>Safe &amp; Secure Booking</p></div>
            </div>
        </div>
    </div>
</section>

<!-- DESTINATIONS -->
<section class="destinations-section" id="destinations">
    <div class="container">
        <div class="section-header">
            <span class="section-label">TOP DESTINATIONS</span>
            <h2 class="section-title">Popular Destinations</h2>
            <div class="section-divider">
                <svg width="80" height="20" viewBox="0 0 80 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <line x1="0" y1="10" x2="28" y2="10" stroke="#4A90D9" stroke-width="1.5"/>
                    <polygon points="34,4 40,10 34,16" fill="none" stroke="#4A90D9" stroke-width="1.5"/>
                    <polygon points="40,6 46,10 40,14" fill="#4A90D9"/>
                    <line x1="52" y1="10" x2="80" y2="10" stroke="#4A90D9" stroke-width="1.5"/>
                </svg>
            </div>
        </div>
        <div class="destinations-grid">
            <div class="destination-card">
                <div class="card-image">
                    <img src="https://images.unsplash.com/photo-1501854140801-50d01698950b?w=600&q=80" alt="Pokhara" loading="lazy">
                    <div class="card-overlay"></div>
                    <span class="card-tag">Nature</span>
                </div>
                <div class="card-body">
                    <h3 class="card-title">Pokhara</h3>
                    <p class="card-subtitle">The City of Lakes</p>
                </div>
            </div>
            <div class="destination-card">
                <div class="card-image">
                    <img src="https://images.unsplash.com/photo-1516091877740-fde016699f2c?w=600&q=80" alt="Everest Region" loading="lazy">
                    <div class="card-overlay"></div>
                    <span class="card-tag">Trekking</span>
                </div>
                <div class="card-body">
                    <h3 class="card-title">Everest Region</h3>
                    <p class="card-subtitle">Roof of the World</p>
                </div>
            </div>
            <div class="destination-card">
                <div class="card-image">
                    <img src="https://images.unsplash.com/photo-1464822759023-fed622ff2c3b?w=600&q=80" alt="Annapurna Region" loading="lazy">
                    <div class="card-overlay"></div>
                    <span class="card-tag">Adventure</span>
                </div>
                <div class="card-body">
                    <h3 class="card-title">Annapurna Region</h3>
                    <p class="card-subtitle">Diverse Natural Beauty</p>
                </div>
            </div>
            <div class="destination-card">
                <div class="card-image">
                    <img src="https://images.unsplash.com/photo-1582654291302-1f87f3c8ba61?w=600&q=80" alt="Kathmandu" loading="lazy">
                    <div class="card-overlay"></div>
                    <span class="card-tag">Culture</span>
                </div>
                <div class="card-body">
                    <h3 class="card-title">Kathmandu</h3>
                    <p class="card-subtitle">Cultural Heart of Nepal</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FOOTER -->
<footer class="site-footer">
    <div class="footer-top">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-col footer-brand">
                    <div class="footer-logo">
                        <svg width="36" height="36" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <polygon points="20,2 38,32 2,32" fill="none" stroke="#4A90D9" stroke-width="2.5"/>
                            <polygon points="20,10 30,28 10,28" fill="#4A90D9" opacity="0.6"/>
                            <polygon points="20,16 26,26 14,26" fill="#4A90D9"/>
                        </svg>
                        <span>Visit Nepal</span>
                    </div>
                    <p class="footer-desc">Experience the magic of Nepal — from the towering Himalayas to ancient temples and vibrant culture. Your dream adventure starts here.</p>
                    <div class="footer-social">
                        <a href="#" class="footer-social-link"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="footer-social-link"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="footer-col">
                    <h4 class="footer-heading">Quick Links</h4>
                    <ul class="footer-links">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('destinations.index') }}">Destinations</a></li>
                        <li><a href="{{ route('treks.index') }}">Treks</a></li>
                        <li><a href="{{ route('packages.index') }}">
                            Packages</a></li>       
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 class="footer-heading">Popular Destinations</h4>
                    <ul class="footer-links">
                        <li><a href="#">Pokhara</a></li>
                        <li><a href="#">Everest Base Camp</a></li>
                        <li><a href="#">Annapurna Circuit</a></li>
                        <li><a href="#">Kathmandu Valley</a></li>
                        <li><a href="#">Chitwan National Park</a></li>
                        <li><a href="#">Lumbini</a></li>
                    </ul>
                </div>
                <div class="footer-col">
                    <h4 class="footer-heading">Contact Us</h4>
                    <ul class="footer-contact">
                        <li><i class="fas fa-map-marker-alt"></i><span>Boudha, Kathmandu, Nepal</span></li>
                        <li><i class="fas fa-phone-alt"></i><span>+977 9713478474</span></li>
                        <li><i class="fas fa-envelope"></i><span>info@visitnepal.com</span></li>
                        <li><i class="fas fa-clock"></i><span>Mon–Sat: 9AM – 6PM</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <p>&copy; 2026 Visit Nepal. All Rights Reserved. | Made with <i class="fas fa-heart" style="color:#e05c5c;"></i> in Nepal by Ashupasu</p>
            <ul class="footer-bottom-links">
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Terms &amp; Conditions</a></li>
                <li><a href="#">Sitemap</a></li>
            </ul>
        </div>
    </div>
</footer>

<script>
const header = document.getElementById('site-header');
window.addEventListener('scroll', function() {
    header.classList.toggle('scrolled', window.scrollY > 60);
});
document.querySelectorAll('.destination-card').forEach(card => {
    card.addEventListener('mousemove', function(e) {
        const rect = card.getBoundingClientRect();
        const x = e.clientX - rect.left - rect.width/2;
        const y = e.clientY - rect.top - rect.height/2;
        card.style.transform = `translateY(-8px) rotateX(${(-y/40).toFixed(2)}deg) rotateY(${(x/40).toFixed(2)}deg)`;
    });
    card.addEventListener('mouseleave', function() { card.style.transform = ''; });
});
</script>
</body>
</html>