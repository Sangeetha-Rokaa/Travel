@extends('layouts.frontend')
@section('title', 'Visit Nepal – Dream · Explore · Discover')

@section('content')

    <!-- ══════════════════════════════════════════════
                                                     HERO
                                                ══════════════════════════════════════════════ -->
    <section class="hero" id="home">
        <img id="heroBg" class="hero-bg-img" src="{{ asset('images/landingimg.png') }}" alt="Nepal Himalayan Banner" />
        <div class="hero-overlay"></div>
        <div class="social-sidebar">
            <a href="#" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="#" aria-label="Instagram"><i class="fab fa-instagram"></i></a>
            <a href="#" aria-label="Twitter"><i class="fab fa-twitter"></i></a>
        </div>
        <div class="hero-content">
            <p class="welcome-to">Welcome To</p>
            <h1 class="hero-nepal">NEPAL</h1>
            <p class="hero-sub">
                A Land of Majestic Himalayas,<br>
                Rich Culture &amp; Endless Adventure
            </p>
            <div class="hero-buttons">
                <a href="#destinations" class="btn-explore-hero">
                    <i class="fas fa-mountain"></i>
                    Explore Destinations
                </a>
                <a href="#" class="btn-watch-hero" id="openVideoBtn">
                    <div class="play-circle"><i class="fas fa-play"></i></div>
                    Watch Video
                </a>
            </div>
        </div>
        <div class="hero-wave">
            <svg viewBox="0 0 1440 68" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,34 C200,68 400,0 600,30 C800,60 1000,10 1200,36 C1320,52 1400,24 1440,30 L1440,68 L0,68 Z"
                    fill="#ffffff" />
            </svg>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════
                                                     TRUST BAR
                                                ══════════════════════════════════════════════ -->
    <div class="trust-bar">
        <div class="trust-item">
            <div class="trust-icon"><i class="fas fa-tag"></i></div>
            <div class="trust-copy">
                <span class="t-title">Best Price</span>
                <span class="t-sub">Guaranteed Best Price</span>
            </div>
        </div>
        <div class="trust-sep"></div>
        <div class="trust-item">
            <div class="trust-icon"><i class="fas fa-headset"></i></div>
            <div class="trust-copy">
                <span class="t-title">24/7 Support</span>
                <span class="t-sub">We are always here</span>
            </div>
        </div>
        <div class="trust-sep"></div>
        <div class="trust-item">
            <div class="trust-icon"><i class="fas fa-user-tie"></i></div>
            <div class="trust-copy">
                <span class="t-title">Local Expert</span>
                <span class="t-sub">Guided by Local Expert</span>
            </div>
        </div>
        <div class="trust-sep"></div>
        <div class="trust-item">
            <div class="trust-icon"><i class="fas fa-shield-alt"></i></div>
            <div class="trust-copy">
                <span class="t-title">Secure Booking</span>
                <span class="t-sub">Safe &amp; Secure Booking</span>
            </div>
        </div>
    </div>


    <!-- ══════════════════════════════════════════════
                                                     WHY CHOOSE US
                                                ══════════════════════════════════════════════ -->
    <section id="why-us">
        <div class="why-inner">
            <div>
                <div class="section-header" style="text-align:left;">
                    <h2>Why Choose Us</h2>
                    <div class="divider-line" style="justify-content:flex-start;">
                        <span></span><i class="fas fa-mountain"></i><span></span>
                    </div>
                </div>
                <div class="why-features reveal">
                    <div class="feature-card">
                        <div class="fc-icon"><i class="fas fa-tag"></i></div>
                        <h4>Best Price Guarantee</h4>
                        <p>Get the best price for your dream adventure in Nepal.</p>
                    </div>
                    <div class="feature-card">
                        <div class="fc-icon"><i class="fas fa-map-marked-alt"></i></div>
                        <h4>Expert Local Guides</h4>
                        <p>Our experienced local guides ensure your safety and satisfaction.</p>
                    </div>
                    <div class="feature-card">
                        <div class="fc-icon"><i class="fas fa-headset"></i></div>
                        <h4>24/7 Customer Support</h4>
                        <p>We are always here to assist you anytime, anywhere.</p>
                    </div>
                    <div class="feature-card">
                        <div class="fc-icon"><i class="fas fa-shield-alt"></i></div>
                        <h4>Safe &amp; Secure Booking</h4>
                        <p>Your booking is safe with us. No hidden charges.</p>
                    </div>
                </div>
            </div>
            <div class="why-video reveal">
                <img src="{{ asset('images/landingimg.png') }}" alt="Experience Nepal"
                    style="width:100%;height:340px;object-fit:cover;display:block;"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                <div class="vid-placeholder"
                    style="display:none;background:linear-gradient(135deg,#1a3a5c,#1a6fc4);width:100%;height:340px;align-items:center;justify-content:center;flex-direction:column;color:white;">
                    <i class="fas fa-mountain" style="font-size:48px;opacity:0.4;"></i>
                    <span style="margin-top:12px;font-size:13px;opacity:0.6;">Experience Nepal</span>
                </div>
                <div class="vid-play-btn" id="openVideoBtn2">
                    <i class="fas fa-play"></i>
                </div>
                <div class="vid-caption">Experience Nepal Like Never Before</div>
            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════
                                                     POPULAR DESTINATIONS
                                                ══════════════════════════════════════════════ -->
    <section id="destinations">
        <div class="section-header reveal">
            <h2>Popular Destinations</h2>

            <div class="divider-line">
                <span></span>
                <i class="fas fa-mountain"></i>
                <span></span>
            </div>

            <p>Explore the most breathtaking places Nepal has to offer</p>
        </div>

        <div class="dest-grid reveal">

            @forelse($featuredDestinations as $destination)
                <div class="dest-card">

                    {{-- IMAGE --}}
                    <img src="{{ asset('storage/' . $destination->featured_image) }}" alt="{{ $destination->name }}"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />

                    {{-- PLACEHOLDER --}}
                    <div class="dest-img-placeholder"
                        style="display:none;
                    background:linear-gradient(135deg,#1a4a7c,#27ae60);">

                        <i class="fas fa-mountain" style="font-size:36px;opacity:0.5;"></i>

                        <span>{{ $destination->name }}</span>
                    </div>

                    {{-- INFO --}}
                    <div class="dest-info">

                        <span class="dest-name">
                            {{ $destination->name }}
                        </span>

                        <span class="dest-sub">
                            {{ $destination->short_description }}
                        </span>

                    </div>

                    {{-- LINK --}}
                    <a href="{{ route('destinations.show', $destination->slug) }}" class="dest-overlay-link">
                    </a>

                </div>

            @empty

                <div class="no-destination">
                    <p>No destinations available right now.</p>
                </div>
            @endforelse

        </div>

        <div class="dest-btn-wrap reveal">
            <a href="{{ route('destinations.index') }}" class="btn-primary">
                View All Destinations
            </a>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════
                                                     TOP TREKKING PLANS
                                                ══════════════════════════════════════════════ -->
    <section id="treks">

        <div class="section-header reveal">
            <h2>Top Trekking Plans</h2>

            <div class="divider-line">
                <span></span>
                <i class="fas fa-hiking"></i>
                <span></span>
            </div>

            <p>
                Choose from our expertly crafted trekking adventures
            </p>
        </div>

        <div class="trek-grid reveal">

            @forelse($featuredTreks as $trek)
                <div class="trek-card">

                    {{-- IMAGE --}}
                    <img src="{{ asset('storage/' . $trek->featured_image) }}" alt="{{ $trek->name }}" loading="lazy"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />

                    {{-- PLACEHOLDER --}}
                    <div class="tk-img-placeholder"
                        style="display:none;
                    background:linear-gradient(135deg,#0d2b55,#1a6fc4);">

                        <i class="fas fa-mountain" style="font-size:36px;opacity:0.4;"></i>

                        <span>{{ $trek->name }}</span>
                    </div>

                    {{-- BODY --}}
                    <div class="trek-body">

                        <h3>
                            {{ $trek->name }}
                        </h3>

                        {{-- META --}}
                        <div class="trek-meta">

                            <span>
                                <i class="far fa-calendar-alt"></i>

                                {{ $trek->duration_days }} Days
                            </span>

                            <span>
                                <i class="fas fa-signal"></i>

                                {{ $trek->difficulty }}
                            </span>

                        </div>

                        {{-- FOOTER --}}
                        <div class="trek-footer">

                            <span class="trek-price">

                                @if ($trek->price_usd)
                                    ${{ number_format($trek->price_usd, 0) }}
                                @else
                                    Contact Us
                                @endif

                            </span>

                            <a href="{{ route('treks.show', $trek->slug) }}">
                                View Details
                            </a>

                        </div>

                    </div>

                </div>

            @empty

                <div style="grid-column:1/-1;text-align:center;padding:50px 20px;">
                    <p style="color:#64748b;font-size:16px;">
                        No trekking plans available right now.
                    </p>
                </div>
            @endforelse

        </div>

        <div class="trek-btn-wrap reveal">

            <a href="{{ route('treks.index') }}" class="btn-primary">
                View All Treks
            </a>

        </div>

    </section>



    <!-- =========================
                         PACKAGES SECTION
                    ========================= -->

    <section class="packages-section">

        <div class="section-header reveal">

            <span class="section-tag">
                Travel Packages
            </span>

            <h2 class="section-title">
                Explore Our Featured Packages
            </h2>

            <p class="section-subtitle">
                Discover unforgettable journeys across Nepal with carefully curated travel experiences.
            </p>

        </div>

        <div class="pkg-grid reveal">

            @forelse($featuredPackages as $package)

                @php
                    $price = $package->price_usd_discounted ?? $package->price_usd;

                    $services = is_array($package->included) ? array_slice($package->included, 0, 4) : [];
                @endphp

                <div class="pkg-card">

                    {{-- IMAGE --}}
                    <div class="pkg-image-wrap">

                        @if ($package->featured_image)
                            <img src="{{ asset('storage/' . $package->featured_image) }}" alt="{{ $package->name }}"
                                class="pkg-image"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        @endif

                        {{-- FALLBACK --}}
                        <div class="pk-img-placeholder"
                            style="{{ $package->featured_image ? 'display:none;' : 'display:flex;' }}">

                            <i class="fas fa-mountain"></i>
                            <span>{{ $package->name }}</span>

                        </div>

                        @if ($package->is_featured)
                            <div class="featured-badge">
                                Featured
                            </div>
                        @endif

                    </div>

                    {{-- BODY --}}
                    <div class="pkg-body">

                        <div class="pkg-top">

                            <div>
                                <h3 class="pkg-title">
                                    {{ $package->name }}
                                </h3>

                                <div class="pkg-meta">

                                    <span>
                                        <i class="far fa-clock"></i>
                                        {{ $package->duration_days }} Days
                                    </span>

                                    @if ($package->best_season)
                                        <span>
                                            <i class="fas fa-cloud-sun"></i>
                                            {{ $package->best_season }}
                                        </span>
                                    @endif

                                </div>
                            </div>

                            <div class="price-wrap">

                                @if ($package->price_usd_discounted)
                                    <span class="old-price">
                                        ${{ number_format($package->price_usd, 0) }}
                                    </span>
                                @endif

                                <span class="pkg-price">
                                    ${{ number_format($price, 0) }}
                                </span>

                            </div>

                        </div>

                        <p class="pkg-desc">
                            {{ \Illuminate\Support\Str::limit($package->short_description, 110) }}
                        </p>

                        @if (count($services))
                            <div class="pkg-services">

                                @foreach ($services as $service)
                                    <span class="service-pill">
                                        {{ $service }}
                                    </span>
                                @endforeach

                            </div>
                        @endif

                        <a href="{{ route('packages.show', $package->slug) }}" class="pkg-book-btn">

                            View Package

                        </a>

                    </div>

                </div>

            @empty

                <div class="no-packages">
                    <p>No packages available.</p>
                </div>

            @endforelse

        </div>

    </section>

    <!-- ══════════════════════════════════════════════
                                                     TESTIMONIALS
                                                ══════════════════════════════════════════════ -->
    <section id="testimonials">
        <div class="section-header reveal">
            <h2>Happy Customers</h2>
            <div class="divider-line"><span></span><i class="fas fa-mountain"></i><span></span></div>
            <p>What our travelers say about their Nepal experience</p>
        </div>
        <div class="testimonials-inner reveal">
            <div class="testi-slider">
                <div class="testi-track" id="testiTrack">

                    <div class="testi-slide">
                        <div class="testi-card">
                            <div class="quote-icon">"</div>
                            <div class="testi-avatar-placeholder">E</div>
                            <div class="testi-name">Emily Johnson</div>
                            <div class="testi-loc">United States</div>
                            <div class="testi-stars">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="testi-text">"Our trip to Nepal was beyond amazing! The mountains, culture, and
                                people are incredible. Highly recommended!"</p>
                        </div>
                    </div>

                    <div class="testi-slide">
                        <div class="testi-card">
                            <div class="quote-icon">"</div>
                            <div class="testi-avatar-placeholder" style="background:#27ae60;">R</div>
                            <div class="testi-name">Raj Sharma</div>
                            <div class="testi-loc">India</div>
                            <div class="testi-stars">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star"></i>
                            </div>
                            <p class="testi-text">"The Everest Base Camp trek was the adventure of a lifetime. The team
                                was extremely professional and supportive throughout."</p>
                        </div>
                    </div>

                    <div class="testi-slide">
                        <div class="testi-card">
                            <div class="quote-icon">"</div>
                            <div class="testi-avatar-placeholder" style="background:#8e44ad;">S</div>
                            <div class="testi-name">Sophie Laurent</div>
                            <div class="testi-loc">France</div>
                            <div class="testi-stars">
                                <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                                    class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
                            </div>
                            <p class="testi-text">"Pokhara took my breath away. The cultural heritage tours were
                                beautifully organized. Will definitely come back!"</p>
                        </div>
                    </div>

                </div>
            </div>
            <div class="testi-dots">
                <button class="testi-dot active" onclick="goToSlide(0)"></button>
                <button class="testi-dot" onclick="goToSlide(1)"></button>
                <button class="testi-dot" onclick="goToSlide(2)"></button>
            </div>
            <div class="testi-arrows">
                <button class="testi-arrow" id="prevBtn"><i class="fas fa-chevron-left"></i></button>
                <button class="testi-arrow" id="nextBtn"><i class="fas fa-chevron-right"></i></button>
            </div>
            <div class="view-reviews-wrap">
                <a href="#" class="btn-outline">View All Reviews</a>
            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════
                                                     CONTACT CTA SECTION
                                                ══════════════════════════════════════════════ -->
    <section id="contact-cta">
        <img class="cta-bg" src="{{ asset('images/landingimg.png') }}" alt="Nepal"
            onerror="this.style.display='none';" />
        <div class="cta-bg-placeholder"></div>
        <div class="cta-overlay"></div>

        <div class="contact-inner">

            <!-- ── Left: heading + contact info ── -->
            <div class="contact-left reveal">
                <h2>Get In Touch<br>With Us</h2>
                <p>Have any questions? We're here to help!<br>
                    Send us a message and we'll get back to you within 24 hours.</p>

                <ul class="contact-info-list">
                    <li>
                        <div class="ci-icon"><i class="fas fa-map-marker-alt"></i></div>
                        <div class="ci-text">
                            <span class="ci-label">Our Office</span>
                            <span class="ci-value">Thamel, Kathmandu, Nepal</span>
                        </div>
                    </li>
                    <li>
                        <div class="ci-icon"><i class="fas fa-phone-alt"></i></div>
                        <div class="ci-text">
                            <span class="ci-label">Phone</span>
                            <span class="ci-value">+977 9800000000</span>
                        </div>
                    </li>
                    <li>
                        <div class="ci-icon"><i class="fas fa-envelope"></i></div>
                        <div class="ci-text">
                            <span class="ci-label">Email</span>
                            <span class="ci-value">info@visitnepal.com</span>
                        </div>
                    </li>
                    <li>
                        <div class="ci-icon"><i class="fas fa-clock"></i></div>
                        <div class="ci-text">
                            <span class="ci-label">Working Hours</span>
                            <span class="ci-value">Sun – Fri: 9:00 AM – 6:00 PM</span>
                        </div>
                    </li>
                </ul>
            </div>

            <!-- ── Right: contact form ── -->
            <div class="contact-form-card reveal">
                <h3>Send Us a Message</h3>
                <p class="form-sub">Fill out the form below and our team will reach out shortly.</p>

                <form id="contactForm" novalidate>
                    @csrf

                    <!-- Row 1: Full Name + Email -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="full_name">Full Name</label>
                            <div class="input-icon-wrap">
                                <input type="text" id="full_name" name="full_name" placeholder="Your full name" />
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="error-msg" id="err_full_name">Please enter your name.</span>
                        </div>
                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <div class="input-icon-wrap">
                                <input type="email" id="email" name="email" placeholder="your@email.com" />
                                <i class="fas fa-envelope"></i>
                            </div>
                            <span class="error-msg" id="err_email">Please enter a valid email.</span>
                        </div>
                    </div>

                    <!-- Row 2: Phone + Subject -->
                    <div class="form-row">
                        <div class="form-group">
                            <label for="phone">Phone Number</label>
                            <div class="input-icon-wrap">
                                <input type="tel" id="phone" name="phone" placeholder="+977 98XXXXXXXX" />
                                <i class="fas fa-phone-alt"></i>
                            </div>
                            <span class="error-msg" id="err_phone">Please enter your phone number.</span>
                        </div>
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <div class="input-icon-wrap">
                                <input type="text" id="subject" name="subject" placeholder="How can we help?" />
                                <i class="fas fa-tag"></i>
                            </div>
                            <span class="error-msg" id="err_subject">Please enter a subject.</span>
                        </div>
                    </div>

                    <!-- Interested In -->
                    <div class="form-group">
                        <label for="interest">Interested In</label>
                        <select id="interest" name="interest">
                            <option value="">-- Select a package or service --</option>
                            <option value="trekking">Trekking / Hiking</option>
                            <option value="tour_package">Tour Package</option>
                            <option value="cultural">Cultural &amp; Heritage Tour</option>
                            <option value="adventure">Adventure Tour</option>
                            <option value="custom">Custom / Private Tour</option>
                            <option value="other">Other</option>
                        </select>
                    </div>

                    <!-- Message -->
                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message"
                            placeholder="Tell us about your travel plans, preferred dates, group size, or any questions..."></textarea>
                        <span class="error-msg" id="err_message">Please enter your message.</span>
                    </div>

                    <!-- Submit -->
                    <button type="submit" class="btn-form-submit" id="submitBtn">
                        <i class="fas fa-paper-plane"></i>
                        Send Message
                    </button>
                </form>

                <!-- Success state -->
                <div class="form-success" id="formSuccess">
                    <div class="success-icon"><i class="fas fa-check"></i></div>
                    <h4>Message Sent!</h4>
                    <p>Thank you for reaching out. Our team will contact you within 24 hours.</p>
                </div>
            </div>

        </div>
    </section>

@endsection


<script>
    /* ── Testimonial slider ── */
    let currentSlide = 0;
    const totalSlides = 3;
    const track = document.getElementById('testiTrack');
    const dots = document.querySelectorAll('.testi-dot');

    function goToSlide(n) {
        currentSlide = n;
        track.style.transform = `translateX(-${n * 100}%)`;
        dots.forEach((d, i) => d.classList.toggle('active', i === n));
    }

    document.getElementById('nextBtn').addEventListener('click', () => {
        goToSlide((currentSlide + 1) % totalSlides);
    });
    document.getElementById('prevBtn').addEventListener('click', () => {
        goToSlide((currentSlide - 1 + totalSlides) % totalSlides);
    });

    // Auto-slide every 5s
    setInterval(() => goToSlide((currentSlide + 1) % totalSlides), 5000);

    /* ── Contact form AJAX ── */
    (function() {
        const form = document.getElementById('contactForm');
        const successBox = document.getElementById('formSuccess');
        const submitBtn = document.getElementById('submitBtn');

        const fields = [{
                id: 'full_name',
                errId: 'err_full_name',
                validate: v => v.trim().length >= 2
            },
            {
                id: 'email',
                errId: 'err_email',
                validate: v => /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(v.trim())
            },
            {
                id: 'phone',
                errId: 'err_phone',
                validate: v => v.trim().length >= 7
            },
            {
                id: 'subject',
                errId: 'err_subject',
                validate: v => v.trim().length >= 2
            },
            {
                id: 'message',
                errId: 'err_message',
                validate: v => v.trim().length >= 10
            },
        ];

        fields.forEach(({
            id,
            errId
        }) => {
            const el = document.getElementById(id);
            if (!el) return;
            el.addEventListener('input', () => {
                el.classList.remove('error');
                document.getElementById(errId).classList.remove('show');
            });
        });

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let valid = true;

            fields.forEach(({
                id,
                errId,
                validate
            }) => {
                const el = document.getElementById(id);
                const err = document.getElementById(errId);
                if (!el) return;
                if (!validate(el.value)) {
                    el.classList.add('error');
                    err.classList.add('show');
                    valid = false;
                } else {
                    el.classList.remove('error');
                    err.classList.remove('show');
                }
            });

            if (!valid) return;

            submitBtn.disabled = true;
            submitBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Sending...';

            const formData = new FormData(form);

            fetch('{{ route('contact.store') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ||
                            '{{ csrf_token() }}',
                        'Accept': 'application/json',
                    },
                    body: formData
                })
                .then(res => res.json())
                .then(data => {
                    if (data.success || data.status === 'success') {
                        showSuccess();
                    } else {
                        resetBtn();
                        alert(data.message || 'Something went wrong. Please try again.');
                    }
                })
                .catch(() => {
                    showSuccess(); // demo fallback
                });
        });

        function showSuccess() {
            form.style.display = 'none';
            successBox.style.display = 'block';
        }

        function resetBtn() {
            submitBtn.disabled = false;
            submitBtn.innerHTML = '<i class="fas fa-paper-plane"></i> Send Message';
        }
    })();
</script>
