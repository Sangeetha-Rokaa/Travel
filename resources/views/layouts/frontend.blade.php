<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>@yield('title', 'Visit Nepal – Dream · Explore · Discover')</title>
    <link
        href="https://fonts.googleapis.com/css2?family=Great+Vibes&family=Montserrat:wght@400;500;600;700;800;900&family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    @vite(['resources/css/frontend/styles.css'])
    @stack('styles')
</head>

<body>

    <!-- ══════════════════════════════════════════════
         NAVBAR
    ══════════════════════════════════════════════ -->
    <nav class="navbar" id="navbar">
        <a href="#" class="logo">
            <div class="logo-icon-box">
                <img src="{{ asset('images/apeak.jpeg') }}" alt="Visit Nepal"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                <i class="fas fa-mountain fallback-icon"></i>
            </div>
            <div class="logo-texts">
                <span class="logo-name">Visit Nepal</span>
                <span class="logo-tagline">Dream · Explore · Discover</span>
            </div>
        </a>
        <ul class="nav-links">
            <li><a href="{{ route('home') }}">Home</a></li>

            <li>
                <a href="{{ route('destinations.index') }}">
                    Destinations <i class="fa fa-chevron-down chevron"></i>
                </a>
            </li>

            <li>
                <a href="{{ route('treks.index') }}">
                    Treks
                </a>
            </li>

            <li>
                <a href="{{ route('packages.index') }}">
                    Packages
                </a>
            </li>

            <li>
                <a href="{{ route('about') }}">
                    About Us
                </a>
            </li>

            {{-- <li>
                <a href="{{ route('contact') }}">
                    Contact
                </a>
            </li> --}}
        </ul>

        <a href="{{ route('packages.index') }}" class="btn-cta-nav">
            Explore Packages
        </a>
    </nav>


    <!-- ══════════════════════════════════════════════
         PAGE CONTENT (each view fills this)
    ══════════════════════════════════════════════ -->
    @yield('content')


    <!-- ══════════════════════════════════════════════
         FOOTER
    ══════════════════════════════════════════════ -->
    <footer>
        <div class="footer-grid">

            <!-- Brand -->
            <div class="footer-brand">
                <div class="fb-logo">
                    <div class="fb-logo-box"><i class="fas fa-mountain"></i></div>
                    <div>
                        <div class="fb-name">Visit Nepal</div>
                        <span class="fb-tagline">Dream · Explore · Discover</span>
                    </div>
                </div>
                <p>Discover the beauty of Nepal with our expertly crafted tours and treks. Your adventure starts here!
                </p>
                <div class="footer-socials">
                    <a href="#"><i class="fab fa-facebook-f"></i></a>
                    <a href="#"><i class="fab fa-instagram"></i></a>
                    <a href="#"><i class="fab fa-twitter"></i></a>
                    <a href="#"><i class="fab fa-youtube"></i></a>
                </div>
            </div>

            <!-- Quick Links -->
            <div class="footer-col">
                <h4>Quick Links</h4>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#destinations">Destinations</a></li>
                    <li><a href="#treks">Treks</a></li>
                    <li><a href="#packages">Packages</a></li>
                    <li><a href="#why-us">About Us</a></li>
                    <li><a href="#">Contact</a></li>
                </ul>
            </div>

            <!-- Top Destinations -->
            <div class="footer-col">
                <h4>Top Destinations</h4>
                <ul>
                    <li><a href="#">Pokhara</a></li>
                    <li><a href="#">Everest Region</a></li>
                    <li><a href="#">Annapurna Region</a></li>
                    <li><a href="#">Kathmandu</a></li>
                    <li><a href="#">Lumbini</a></li>
                </ul>
            </div>

            <!-- Company -->
            <div class="footer-col">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Our Team</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Terms &amp; Conditions</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                </ul>
            </div>

            <!-- Contact Info -->
            <div class="footer-col">
                <h4>Contact Info</h4>
                <div class="footer-contact-item">
                    <i class="fas fa-map-marker-alt"></i>
                    <span>Thamel, Kathmandu, Nepal</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-phone-alt"></i>
                    <span>+977 9800000000</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-envelope"></i>
                    <span>info@visitnepal.com</span>
                </div>
                <div class="footer-contact-item">
                    <i class="fas fa-globe"></i>
                    <span>www.visitnepal.com</span>
                </div>
            </div>

        </div>
        <div class="footer-bottom">
            &copy; 2024 Visit Nepal. All Rights Reserved.
        </div>
    </footer>


    <!-- ══════════════════════════════════════════════
         VIDEO MODAL
    ══════════════════════════════════════════════ -->
    <div id="videoModal"
        style="display:none;position:fixed;inset:0;background:rgba(0,0,0,0.88);z-index:99999;align-items:center;justify-content:center;">
        <div style="position:relative;width:90%;max-width:800px;background:#000;border-radius:12px;overflow:hidden;">
            <button onclick="closeVideo()"
                style="position:absolute;top:12px;right:14px;background:rgba(255,255,255,0.15);border:none;color:#fff;width:36px;height:36px;border-radius:50%;cursor:pointer;font-size:18px;z-index:10;display:flex;align-items:center;justify-content:center;">
                <i class="fas fa-times"></i>
            </button>
            <div style="padding:40px;text-align:center;color:rgba(255,255,255,0.5);font-size:14px;">
                <!-- REPLACE: Add your YouTube embed or video tag here -->
                <i class="fas fa-film" style="font-size:48px;margin-bottom:16px;display:block;"></i>
                Replace this with your video embed.<br>e.g. &lt;iframe
                src="https://www.youtube.com/embed/..."&gt;&lt;/iframe&gt;
            </div>
        </div>
    </div>


    <!-- ══════════════════════════════════════════════
         GLOBAL SCRIPTS (navbar scroll, reveal, video modal)
    ══════════════════════════════════════════════ -->
    <script>
        /* ── Navbar scroll ── */
        const navbar = document.getElementById('navbar');
        const heroBg = document.getElementById('heroBg');

        window.addEventListener('scroll', () => {
            if (window.scrollY > 60) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
            // Parallax (only fires when heroBg exists, i.e. on the home page)
            if (heroBg) heroBg.style.transform = `translateY(${window.scrollY * 0.22}px)`;
        });

        /* ── Scroll reveal ── */
        const revealEls = document.querySelectorAll('.reveal');
        const revealObserver = new IntersectionObserver((entries) => {
            entries.forEach((entry, i) => {
                if (entry.isIntersecting) {
                    setTimeout(() => entry.target.classList.add('visible'), i * 80);
                    revealObserver.unobserve(entry.target);
                }
            });
        }, {
            threshold: 0.12
        });
        revealEls.forEach(el => revealObserver.observe(el));

        /* ── Video modal ── */
        const modal = document.getElementById('videoModal');

        function openVideo() {
            modal.style.display = 'flex';
        }

        function closeVideo() {
            modal.style.display = 'none';
        }

        // openVideoBtn and openVideoBtn2 only exist on the home page
        document.getElementById('openVideoBtn')?.addEventListener('click', (e) => {
            e.preventDefault();
            openVideo();
        });
        document.getElementById('openVideoBtn2')?.addEventListener('click', openVideo);

        modal.addEventListener('click', (e) => {
            if (e.target === modal) closeVideo();
        });
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') closeVideo();
        });
    </script>

    {{-- Per-page scripts go here --}}
    @stack('scripts')

</body>

</html>
