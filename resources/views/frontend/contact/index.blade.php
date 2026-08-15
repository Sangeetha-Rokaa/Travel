@extends('layouts.frontend')

@section('title', 'Contact — ApeakNepal')

@section('content')

    {{-- ══════════════════════════════════════════
     HERO SECTION
══════════════════════════════════════════ --}}
    <div class="ct-hero">
        <div class="ct-hero__bg">
            <img src="{{ asset('images/mustang.png') }}" alt="Nepal Mountain Village" class="ct-hero__img">
            <div class="ct-hero__overlay"></div>
        </div>
        <div class="ct-hero__content">
            <h1 class="ct-hero__title">Get in Touch</h1>
            <p class="ct-hero__sub">Share the knowledge of experienced Guides and experts<br>who will help you choose between
                the routes.</p>
            <a href="#contact-form" class="ct-hero__btn">Enquire Now</a>
        </div>
    </div>

    {{-- ══════════════════════════════════════════
     MAIN CONTENT — FORM + MAP
══════════════════════════════════════════ --}}
    <div class="ct-main">
        <div class="ct-main__inner">

            {{-- LEFT: Contact Form --}}
            <div class="ct-form-col">
                <h2 class="ct-section-title">Get in Touch</h2>

                <div class="ct-form-card" id="contact-form">

                    @if (session('success'))
                        <div class="ct-alert ct-alert--success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="ct-alert ct-alert--error">
                            Please fix the errors below and try again.
                        </div>
                    @endif

                    <form action="{{ route('contact.store') }}" method="POST" class="ct-form">
                        @csrf

                        {{-- Row: Name + Email --}}
                        <div class="ct-form__row">
                            <div class="ct-form__group">
                                <label class="ct-form__label">Name <span class="ct-form__required">*</span></label>
                                <input type="text" name="name" placeholder="Your full name"
                                    value="{{ old('name') }}"
                                    class="ct-form__input {{ $errors->has('name') ? 'ct-form__input--error' : '' }}"
                                    required>
                                @error('name')
                                    <span class="ct-form__error-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="ct-form__group">
                                <label class="ct-form__label">Email <span class="ct-form__required">*</span></label>
                                <input type="email" name="email" placeholder="your@email.com"
                                    value="{{ old('email') }}"
                                    class="ct-form__input {{ $errors->has('email') ? 'ct-form__input--error' : '' }}"
                                    required>
                                @error('email')
                                    <span class="ct-form__error-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Row: Phone + Country --}}
                        <div class="ct-form__row">
                            <div class="ct-form__group">
                                <label class="ct-form__label">Phone</label>
                                <input type="tel" name="phone" placeholder="+1 234 567 890"
                                    value="{{ old('phone') }}"
                                    class="ct-form__input {{ $errors->has('phone') ? 'ct-form__input--error' : '' }}">
                                @error('phone')
                                    <span class="ct-form__error-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="ct-form__group">
                                <label class="ct-form__label">Country</label>
                                <input type="text" name="country" placeholder="Your country"
                                    value="{{ old('country') }}"
                                    class="ct-form__input {{ $errors->has('country') ? 'ct-form__input--error' : '' }}">
                                @error('country')
                                    <span class="ct-form__error-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Row: Subject --}}
                        <div class="ct-form__group">
                            <label class="ct-form__label">Subject <span class="ct-form__required">*</span></label>
                            <input type="text" name="subject" placeholder="What is this about?"
                                value="{{ old('subject') }}"
                                class="ct-form__input {{ $errors->has('subject') ? 'ct-form__input--error' : '' }}"
                                required>
                            @error('subject')
                                <span class="ct-form__error-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Row: Inquiry Type --}}
                        <div class="ct-form__group">
                            <label class="ct-form__label">Inquiry Type <span class="ct-form__required">*</span></label>
                            <div class="ct-select-wrap">
                                <select name="inquiry_type"
                                    class="ct-form__select {{ $errors->has('inquiry_type') ? 'ct-form__input--error' : '' }}"
                                    required>
                                    <option value="" disabled {{ old('inquiry_type') ? '' : 'selected' }}>Select
                                        inquiry type</option>
                                    <option value="general" {{ old('inquiry_type') === 'general' ? 'selected' : '' }}>
                                        General Inquiry</option>
                                    <option value="trek" {{ old('inquiry_type') === 'trek' ? 'selected' : '' }}>Trek
                                        Inquiry</option>
                                    <option value="package" {{ old('inquiry_type') === 'package' ? 'selected' : '' }}>
                                        Package Inquiry</option>
                                    <option value="custom" {{ old('inquiry_type') === 'custom' ? 'selected' : '' }}>
                                        Custom Trip</option>
                                </select>
                                <span class="ct-select-arrow">
                                    <svg width="14" height="14" fill="none" stroke="currentColor"
                                        viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                            d="M19 9l-7 7-7-7" />
                                    </svg>
                                </span>
                            </div>
                            @error('inquiry_type')
                                <span class="ct-form__error-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Row: Trek or Package name --}}
                        <div class="ct-form__group">
                            <label class="ct-form__label">Trek / Package Name</label>
                            <input type="text" name="trek_or_package"
                                placeholder="Which trek or package are you interested in?"
                                value="{{ old('trek_or_package') }}"
                                class="ct-form__input {{ $errors->has('trek_or_package') ? 'ct-form__input--error' : '' }}">
                            @error('trek_or_package')
                                <span class="ct-form__error-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        {{-- Row: Travel Date + Group Size --}}
                        <div class="ct-form__row">
                            <div class="ct-form__group">
                                <label class="ct-form__label">Travel Date</label>
                                <input type="date" name="travel_date" value="{{ old('travel_date') }}"
                                    class="ct-form__input {{ $errors->has('travel_date') ? 'ct-form__input--error' : '' }}">
                                @error('travel_date')
                                    <span class="ct-form__error-msg">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="ct-form__group">
                                <label class="ct-form__label">Group Size</label>
                                <input type="number" name="group_size" placeholder="No. of people"
                                    value="{{ old('group_size') }}" min="1" max="100"
                                    class="ct-form__input {{ $errors->has('group_size') ? 'ct-form__input--error' : '' }}">
                                @error('group_size')
                                    <span class="ct-form__error-msg">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        {{-- Message --}}
                        <div class="ct-form__group">
                            <label class="ct-form__label">Message <span class="ct-form__required">*</span></label>
                            <textarea name="message" placeholder="Tell us more about your trip plans, questions, or any special requirements..."
                                rows="5" class="ct-form__textarea {{ $errors->has('message') ? 'ct-form__input--error' : '' }}" required>{{ old('message') }}</textarea>
                            @error('message')
                                <span class="ct-form__error-msg">{{ $message }}</span>
                            @enderror
                        </div>

                        <button type="submit" class="ct-form__submit">Submit</button>

                    </form>
                </div>
            </div>

            {{-- RIGHT: Map + Contact Details --}}
            <div class="ct-map-col">
                <h2 class="ct-section-title">Physical Office</h2>

                {{-- Google Map --}}
                <div class="ct-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3532.465986856337!2d85.31445647547845!3d27.70669352519489!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39eb190a74cfa7bd%3A0x14acaed2f2d2bab0!2sKathmandu%2C%20Nepal!5e0!3m2!1sen!2s!4v1700000000000!5m2!1sen!2s"
                        width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade" title="Office Location">
                    </iframe>
                </div>

                {{-- Contact Details --}}
                <div class="ct-details">
                    <h3 class="ct-details__title">Contact Details</h3>

                    <div class="ct-details__item">
                        <svg class="ct-details__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                        <span> Kathmandu</span>
                    </div>

                    <div class="ct-details__item">
                        <svg class="ct-details__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                        </svg>
                        <span>+977 1234567890</span>
                    </div>

                    <div class="ct-details__item">
                        <svg class="ct-details__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                        </svg>
                        <span>ApexNepal@gmail.com</span>
                    </div>

                    <div class="ct-details__item">
                        <svg class="ct-details__icon" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M21 12a9 9 0 01-9 9m9-9a9 9 0 00-9-9m9 9H3m9 9a9 9 0 01-9-9m9 9c1.657 0 3-4.03 3-9s-1.343-9-3-9m0 18c-1.657 0-3-4.03-3-9s1.343-9 3-9m-9 9a9 9 0 019-9" />
                        </svg>
                        <span>ApexNepal.com</span>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <style>
        /* ═══════════════════════════════════════
           FONT
        ═══════════════════════════════════════ */
        @import url('https://fonts.googleapis.com/css2?family=Source+Sans+3:wght@300;400;500;600;700;800&display=swap');

        /* ═══════════════════════════════════════
           TOKENS
        ═══════════════════════════════════════ */
        :root {
            --ct-bg: #f0ece4;
            --ct-surface: #ffffff;
            --ct-ink: #1a1a1a;
            --ct-ink-2: #333333;
            --ct-muted: #666666;
            --ct-border: #d8d3cb;
            --ct-accent: #1a6fc4;
            --ct-accent-dark: #155ba0;
            --ct-error: #e53e3e;
            --ct-radius: 6px;
            --ct-font: 'Source Sans 3', 'Helvetica Neue', Arial, sans-serif;
        }

        /* ═══════════════════════════════════════
           HERO
        ═══════════════════════════════════════ */
        .ct-hero {
            position: relative;
            width: 100%;
            height: 340px;
            overflow: hidden;
            font-family: var(--ct-font);
        }

        .ct-hero__bg {
            position: absolute;
            inset: 0;
        }

        .ct-hero__img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 55%;
            display: block;
        }

        .ct-hero__overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to right,
                    rgba(12, 22, 48, 0.82) 0%,
                    rgba(12, 22, 48, 0.58) 38%,
                    rgba(12, 22, 48, 0.18) 65%,
                    rgba(12, 22, 48, 0.04) 100%);
        }

        .ct-hero__content {
            position: relative;
            z-index: 2;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            padding: 0 52px;
            max-width: 500px;
        }

        .ct-hero__title {
            font-family: var(--ct-font);
            font-size: 44px;
            font-weight: 800;
            color: #fff;
            line-height: 1.1;
            margin: 0 0 12px;
            letter-spacing: -.5px;
        }

        .ct-hero__sub {
            font-size: 13.5px;
            color: rgba(255, 255, 255, .82);
            line-height: 1.65;
            margin: 0 0 24px;
            font-weight: 400;
        }

        .ct-hero__btn {
            display: inline-flex;
            align-items: center;
            background: var(--ct-accent);
            color: #fff;
            font-size: 13px;
            font-weight: 600;
            padding: 9px 22px;
            border-radius: var(--ct-radius);
            text-decoration: none;
            width: fit-content;
            font-family: var(--ct-font);
            transition: background .18s;
        }

        .ct-hero__btn:hover {
            background: var(--ct-accent-dark);
            color: #fff;
        }

        /* ═══════════════════════════════════════
           MAIN LAYOUT
        ═══════════════════════════════════════ */
        .ct-main {
            background: var(--ct-bg);
            padding: 52px 0 76px;
            font-family: var(--ct-font);
        }

        .ct-main__inner {
            max-width: 1100px;
            margin: 0 auto;
            padding: 0 40px;
            display: grid;
            grid-template-columns: 1.1fr 0.9fr;
            gap: 56px;
            align-items: start;
        }

        /* ═══════════════════════════════════════
           SECTION TITLES
        ═══════════════════════════════════════ */
        .ct-section-title {
            font-size: 22px;
            font-weight: 800;
            color: var(--ct-ink);
            margin: 0 0 18px;
            letter-spacing: -.3px;
            font-family: var(--ct-font);
        }

        /* ═══════════════════════════════════════
           FORM CARD
        ═══════════════════════════════════════ */
        .ct-form-card {
            background: var(--ct-surface);
            border-radius: 8px;
            padding: 28px 26px 26px;
            box-shadow: 0 2px 14px rgba(0, 0, 0, .08);
        }

        /* Alerts */
        .ct-alert {
            border-radius: 5px;
            padding: 10px 14px;
            font-size: 13.5px;
            margin-bottom: 16px;
            font-family: var(--ct-font);
        }

        .ct-alert--success {
            background: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
        }

        .ct-alert--error {
            background: #fde8e8;
            color: #9b1c1c;
            border: 1px solid #f8c6c6;
        }

        /* Form layout */
        .ct-form {
            display: flex;
            flex-direction: column;
            gap: 0;
        }

        .ct-form__row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .ct-form__group {
            margin-bottom: 13px;
        }

        /* Label */
        .ct-form__label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: var(--ct-ink-2);
            margin-bottom: 5px;
            font-family: var(--ct-font);
        }

        .ct-form__required {
            color: var(--ct-error);
            margin-left: 2px;
        }

        /* Input / Textarea */
        .ct-form__input,
        .ct-form__select,
        .ct-form__textarea {
            width: 100%;
            border: 1px solid var(--ct-border);
            border-radius: var(--ct-radius);
            padding: 9px 12px;
            font-size: 13.5px;
            color: var(--ct-ink);
            background: #fff;
            font-family: var(--ct-font);
            outline: none;
            transition: border-color .15s, box-shadow .15s;
            box-sizing: border-box;
            -webkit-appearance: none;
            appearance: none;
        }

        .ct-form__input::placeholder,
        .ct-form__textarea::placeholder {
            color: #b0aba3;
            font-size: 13px;
        }

        .ct-form__input:focus,
        .ct-form__select:focus,
        .ct-form__textarea:focus {
            border-color: var(--ct-accent);
            box-shadow: 0 0 0 3px rgba(26, 111, 196, .12);
        }

        .ct-form__input--error {
            border-color: var(--ct-error) !important;
        }

        .ct-form__textarea {
            resize: vertical;
            min-height: 110px;
            line-height: 1.55;
        }

        /* Error message */
        .ct-form__error-msg {
            display: block;
            font-size: 11.5px;
            color: var(--ct-error);
            margin-top: 4px;
            font-family: var(--ct-font);
        }

        /* Select wrapper */
        .ct-select-wrap {
            position: relative;
        }

        .ct-select-wrap .ct-form__select {
            padding-right: 36px;
            cursor: pointer;
        }

        .ct-select-arrow {
            position: absolute;
            right: 11px;
            top: 50%;
            transform: translateY(-50%);
            pointer-events: none;
            color: var(--ct-muted);
            display: flex;
            align-items: center;
        }

        /* Date input color fix */
        .ct-form__input[type="date"] {
            color: var(--ct-ink);
        }

        .ct-form__input[type="date"]:not([value=""]):not(:invalid) {
            color: var(--ct-ink);
        }

        /* Submit */
        .ct-form__submit {
            width: 100%;
            background: var(--ct-accent);
            color: #fff;
            font-size: 14.5px;
            font-weight: 700;
            padding: 12px 0;
            border-radius: var(--ct-radius);
            border: none;
            cursor: pointer;
            font-family: var(--ct-font);
            letter-spacing: .02em;
            transition: background .18s;
            margin-top: 4px;
        }

        .ct-form__submit:hover {
            background: var(--ct-accent-dark);
        }

        /* ═══════════════════════════════════════
           MAP
        ═══════════════════════════════════════ */
        .ct-map-col {
            display: flex;
            flex-direction: column;
        }

        .ct-map {
            width: 100%;
            height: 280px;
            border-radius: 8px;
            overflow: hidden;
            border: 1px solid var(--ct-border);
            background: #e8e4dc;
            margin-bottom: 26px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, .07);
        }

        .ct-map iframe {
            display: block;
        }

        /* ═══════════════════════════════════════
           CONTACT DETAILS
        ═══════════════════════════════════════ */
        .ct-details__title {
            font-size: 18px;
            font-weight: 800;
            color: var(--ct-ink);
            margin: 0 0 13px;
            font-family: var(--ct-font);
            letter-spacing: -.2px;
        }

        .ct-details__item {
            display: flex;
            align-items: flex-start;
            gap: 9px;
            font-size: 13.5px;
            color: var(--ct-muted);
            margin-bottom: 10px;
            line-height: 1.5;
            font-family: var(--ct-font);
        }

        .ct-details__item:last-child {
            margin-bottom: 0;
        }

        .ct-details__icon {
            width: 16px;
            height: 16px;
            flex-shrink: 0;
            margin-top: 2px;
            color: var(--ct-muted);
        }

        /* ═══════════════════════════════════════
           RESPONSIVE
        ═══════════════════════════════════════ */
        @media (max-width: 960px) {
            .ct-main__inner {
                grid-template-columns: 1fr;
                gap: 36px;
                padding: 0 24px;
            }

            .ct-hero__title {
                font-size: 34px;
            }

            .ct-hero__content {
                padding: 0 30px;
            }

            .ct-hero {
                height: 300px;
            }
        }

        @media (max-width: 600px) {
            .ct-hero {
                height: 260px;
            }

            .ct-hero__title {
                font-size: 26px;
            }

            .ct-hero__sub {
                font-size: 12.5px;
            }

            .ct-hero__content {
                padding: 0 20px;
            }

            .ct-main {
                padding: 32px 0 52px;
            }

            .ct-main__inner {
                padding: 0 16px;
            }

            .ct-form-card {
                padding: 20px 16px 18px;
            }

            .ct-form__row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .ct-section-title {
                font-size: 19px;
            }
        }
    </style>

@endsection
