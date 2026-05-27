@extends('layouts.frontend')
@section('title', 'Visit Nepal – Dream · Explore · Discover')

@push('styles')
    <style>
        /* ═══════════════════════════════════════════════════
                                       HOME PAGE STYLES
                                    ═══════════════════════════════════════════════════ */

        /* ── Shared section rhythm ── */
        section {
            padding: clamp(60px, 8vw, 120px) clamp(16px, 5vw, 80px);
            position: relative;
        }

        .section-header {
            text-align: center;
            margin-bottom: clamp(32px, 5vw, 60px);
        }

        .section-header h2 {
            font-family: var(--ff-display);
            font-size: clamp(2rem, 5vw, 3.4rem);
            font-weight: 700;
            color: var(--clr-dark);
            margin: 0 0 14px;
            line-height: 1.15;
        }

        .section-tag {
            display: inline-block;
            background: linear-gradient(135deg, rgba(26, 111, 196, 0.12), rgba(232, 160, 32, 0.12));
            color: var(--clr-mid);
            border: 1px solid rgba(26, 111, 196, 0.2);
            border-radius: 50px;
            font-size: 0.78rem;
            font-weight: 600;
            letter-spacing: 0.1em;
            text-transform: uppercase;
            padding: 6px 18px;
            margin-bottom: 12px;
        }

        .section-title {
            font-family: var(--ff-display);
            font-size: clamp(1.8rem, 4.5vw, 3rem);
            font-weight: 700;
            color: var(--clr-dark);
            margin: 8px 0 12px;
            line-height: 1.2;
        }

        .section-subtitle,
        .section-header p {
            color: var(--clr-muted);
            font-size: clamp(0.9rem, 2vw, 1.05rem);
            max-width: 560px;
            margin: 0 auto;
            line-height: 1.7;
        }

        .divider-line {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            margin: 0 0 14px;
            color: var(--clr-gold);
        }

        .divider-line span {
            display: block;
            height: 1px;
            width: 60px;
            background: linear-gradient(90deg, transparent, var(--clr-gold));
        }

        .divider-line span:last-child {
            background: linear-gradient(90deg, var(--clr-gold), transparent);
        }

        .divider-line i {
            font-size: 0.85rem;
        }

        /* ── Buttons ── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--clr-sky), var(--clr-mid));
            color: #fff;
            font-weight: 600;
            font-size: 0.92rem;
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 6px 24px rgba(11, 61, 110, 0.35);
        }

        .btn-primary:hover {
            transform: translateY(-3px) scale(1.04);
            box-shadow: 0 12px 36px rgba(11, 61, 110, 0.5);
        }

        /* ══════════════════════════════════════════════
                                       HERO
                                    ══════════════════════════════════════════════ */
        .hero {
            position: relative;
            height: 100svh;
            min-height: 580px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            padding: 0;
        }

        .hero-bg-img {
            position: absolute;
            inset: -10%;
            width: 120%;
            height: 120%;
            object-fit: cover;
            will-change: transform;
            transition: transform 0.05s linear;
        }

        .hero-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(170deg,
                    rgba(10, 22, 40, 0.55) 0%,
                    rgba(11, 61, 110, 0.4) 40%,
                    rgba(10, 22, 40, 0.75) 100%);
            z-index: 1;
        }

        /* Animated gradient shimmer over hero */
        .hero-overlay::after {
            content: '';
            position: absolute;
            inset: 0;
            background: radial-gradient(ellipse 80% 60% at 50% 120%, rgba(232, 160, 32, 0.12) 0%, transparent 70%);
            animation: heroGlow 6s ease-in-out infinite alternate;
        }

        @keyframes heroGlow {
            from {
                opacity: 0.6;
                transform: scale(1);
            }

            to {
                opacity: 1;
                transform: scale(1.08);
            }
        }

        .social-sidebar {
            position: absolute;
            left: 28px;
            top: 50%;
            transform: translateY(-50%);
            display: flex;
            flex-direction: column;
            gap: 12px;
            z-index: 10;
        }

        .social-sidebar a {
            width: 38px;
            height: 38px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(6px);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255, 255, 255, 0.75);
            font-size: 0.85rem;
            text-decoration: none;
            transition: all 0.3s;
        }

        .social-sidebar a:hover {
            background: var(--clr-gold);
            color: var(--clr-dark);
            border-color: var(--clr-gold);
            transform: scale(1.15) translateX(4px);
            box-shadow: 0 6px 20px rgba(232, 160, 32, 0.5);
        }

        .hero-content {
            position: relative;
            z-index: 10;
            text-align: center;
            color: #fff;
            padding: 0 clamp(20px, 5vw, 60px);
            max-width: 860px;
        }

        .welcome-to {
            font-family: 'Great Vibes', cursive;
            font-size: clamp(1.4rem, 3.5vw, 2.2rem);
            color: var(--clr-gold);
            margin: 0 0 4px;
            opacity: 0;
            transform: translateY(20px);
            animation: heroFadeUp 0.9s 0.2s forwards ease-out;
        }

        .hero-nepal {
            font-family: var(--ff-display);
            font-size: clamp(4rem, 14vw, 10rem);
            font-weight: 700;
            letter-spacing: 0.06em;
            margin: 0;
            line-height: 0.9;
            background: linear-gradient(135deg, #fff 30%, var(--clr-gold) 70%, #fff 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            background-size: 200% 200%;
            animation: heroFadeUp 0.9s 0.4s forwards ease-out, shimmerText 5s 1.5s linear infinite;
            opacity: 0;
            transform: translateY(30px);
        }

        @keyframes shimmerText {
            0% {
                background-position: 200% center;
            }

            100% {
                background-position: -200% center;
            }
        }

        .hero-sub {
            font-size: clamp(0.95rem, 2.5vw, 1.2rem);
            color: rgba(255, 255, 255, 0.82);
            margin: 16px 0 36px;
            line-height: 1.7;
            letter-spacing: 0.03em;
            opacity: 0;
            transform: translateY(20px);
            animation: heroFadeUp 0.9s 0.6s forwards ease-out;
        }

        @keyframes heroFadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .hero-buttons {
            display: flex;
            gap: 16px;
            justify-content: center;
            flex-wrap: wrap;
            opacity: 0;
            transform: translateY(20px);
            animation: heroFadeUp 0.9s 0.8s forwards ease-out;
        }

        .btn-explore-hero {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--clr-gold), #f0b030);
            color: var(--clr-dark);
            font-weight: 700;
            font-size: clamp(0.88rem, 2vw, 1rem);
            padding: 14px 32px;
            border-radius: 50px;
            text-decoration: none;
            box-shadow: 0 8px 30px rgba(232, 160, 32, 0.45);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .btn-explore-hero:hover {
            transform: translateY(-4px) scale(1.05);
            box-shadow: 0 16px 44px rgba(232, 160, 32, 0.6);
        }

        .btn-watch-hero {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            background: rgba(255, 255, 255, 0.12);
            color: #fff;
            font-weight: 600;
            font-size: clamp(0.88rem, 2vw, 1rem);
            padding: 14px 30px;
            border-radius: 50px;
            text-decoration: none;
            border: 1px solid rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(8px);
            transition: all 0.3s;
        }

        .btn-watch-hero:hover {
            background: rgba(255, 255, 255, 0.22);
            transform: translateY(-3px);
            border-color: rgba(255, 255, 255, 0.4);
        }

        .play-circle {
            width: 36px;
            height: 36px;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 0.75rem;
            animation: pulsePing 2.5s ease-in-out infinite;
        }

        @keyframes pulsePing {

            0%,
            100% {
                box-shadow: 0 0 0 0 rgba(255, 255, 255, 0.4);
            }

            50% {
                box-shadow: 0 0 0 10px rgba(255, 255, 255, 0);
            }
        }

        .hero-wave {
            position: absolute;
            bottom: -2px;
            left: 0;
            right: 0;
            z-index: 5;
            line-height: 0;
        }

        .hero-wave svg {
            width: 100%;
            height: 70px;
            display: block;
        }

        /* Scroll indicator */
        .hero-scroll-hint {
            position: absolute;
            bottom: 90px;
            left: 50%;
            transform: translateX(-50%);
            z-index: 10;
            display: flex;
            flex-direction: column;
            align-items: center;
            gap: 6px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.7rem;
            letter-spacing: 0.15em;
            text-transform: uppercase;
            opacity: 0;
            animation: heroFadeUp 1s 1.4s forwards ease-out;
        }

        .scroll-mouse {
            width: 22px;
            height: 34px;
            border: 2px solid rgba(255, 255, 255, 0.35);
            border-radius: 11px;
            display: flex;
            justify-content: center;
            padding-top: 5px;
        }

        .scroll-wheel {
            width: 3px;
            height: 6px;
            background: rgba(255, 255, 255, 0.6);
            border-radius: 2px;
            animation: scrollWheel 2s ease-in-out infinite;
        }

        @keyframes scrollWheel {

            0%,
            100% {
                transform: translateY(0);
                opacity: 1;
            }

            80% {
                transform: translateY(10px);
                opacity: 0;
            }
        }

        /* ══════════════════════════════════════════════
                                       TRUST BAR
                                    ══════════════════════════════════════════════ */
        .trust-bar {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-wrap: wrap;
            gap: 0;
            background: #fff;
            box-shadow: 0 4px 40px rgba(11, 61, 110, 0.08);
            border-radius: 0;
            padding: 0 clamp(16px, 5vw, 60px);
            position: relative;
            z-index: 10;
        }

        .trust-item {
            display: flex;
            align-items: center;
            gap: 14px;
            padding: 24px 32px;
            flex: 1;
            min-width: 180px;
            transition: background 0.3s;
        }

        .trust-item:hover {
            background: rgba(26, 111, 196, 0.04);
        }

        .trust-icon {
            width: 48px;
            height: 48px;
            flex-shrink: 0;
            background: linear-gradient(135deg, var(--clr-sky), var(--clr-mid));
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.1rem;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 16px rgba(26, 111, 196, 0.3);
        }

        .trust-item:hover .trust-icon {
            transform: rotate(-8deg) scale(1.1);
            box-shadow: 0 8px 24px rgba(26, 111, 196, 0.45);
        }

        .trust-copy {
            display: flex;
            flex-direction: column;
        }

        .t-title {
            font-weight: 700;
            font-size: 0.95rem;
            color: var(--clr-dark);
        }

        .t-sub {
            font-size: 0.8rem;
            color: var(--clr-muted);
            margin-top: 2px;
        }

        .trust-sep {
            width: 1px;
            height: 48px;
            background: rgba(11, 61, 110, 0.1);
            flex-shrink: 0;
        }

        /* ══════════════════════════════════════════════
                                       WHY CHOOSE US
                                    ══════════════════════════════════════════════ */
        #why-us {
            background: linear-gradient(160deg, #f0f5ff 0%, var(--clr-snow) 100%);
            overflow: hidden;
        }

        .why-inner {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: clamp(32px, 5vw, 80px);
            align-items: center;
            max-width: 1200px;
            margin: 0 auto;
        }

        .section-header.left-align {
            text-align: left;
        }

        .section-header.left-align .divider-line {
            justify-content: flex-start;
        }

        .why-features {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-top: 32px;
        }

        .feature-card {
            background: #fff;
            border: 1px solid rgba(11, 61, 110, 0.07);
            border-radius: var(--radius-lg);
            padding: 24px 20px;
            transition: transform 0.35s, box-shadow 0.35s, border-color 0.35s;
            position: relative;
            overflow: hidden;
        }

        .feature-card::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--clr-mid), var(--clr-gold));
            opacity: 0;
            transition: opacity 0.35s;
        }

        .feature-card:hover {
            transform: translateY(-6px);
            box-shadow: var(--shadow-card);
            border-color: transparent;
        }

        .feature-card:hover::before {
            opacity: 1;
        }

        .feature-card>* {
            position: relative;
            z-index: 1;
        }

        .fc-icon {
            width: 44px;
            height: 44px;
            background: linear-gradient(135deg, rgba(11, 61, 110, 0.1), rgba(26, 111, 196, 0.12));
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--clr-mid);
            font-size: 1rem;
            margin-bottom: 14px;
            transition: background 0.35s, color 0.35s;
        }

        .feature-card:hover .fc-icon {
            background: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .feature-card h4 {
            font-family: var(--ff-display);
            font-size: 1.05rem;
            font-weight: 700;
            color: var(--clr-dark);
            margin: 0 0 8px;
            transition: color 0.35s;
        }

        .feature-card:hover h4 {
            color: #fff;
        }

        .feature-card p {
            font-size: 0.84rem;
            color: var(--clr-muted);
            margin: 0;
            line-height: 1.6;
            transition: color 0.35s;
        }

        .feature-card:hover p {
            color: rgba(255, 255, 255, 0.85);
        }

        /* Why video */
        .why-video {
            position: relative;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 20px 80px rgba(11, 61, 110, 0.2);
        }

        .why-video img,
        .why-video .vid-placeholder {
            width: 100%;
            height: 380px;
            object-fit: cover;
            display: block;
        }

        .vid-play-btn {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            width: 72px;
            height: 72px;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--clr-sky);
            font-size: 1.3rem;
            cursor: pointer;
            box-shadow: 0 10px 40px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .vid-play-btn:hover {
            transform: translate(-50%, -50%) scale(1.12);
            box-shadow: 0 16px 56px rgba(0, 0, 0, 0.4);
        }

        .vid-play-btn::before {
            content: '';
            position: absolute;
            inset: -8px;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.4);
            animation: pulsePing 2.5s ease-in-out infinite;
        }

        .vid-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: linear-gradient(transparent, rgba(10, 22, 40, 0.9));
            color: #fff;
            font-family: var(--ff-display);
            font-size: 1.05rem;
            font-weight: 600;
            padding: 40px 24px 20px;
            text-align: center;
        }

        /* ══════════════════════════════════════════════
                                       DESTINATIONS
                                    ══════════════════════════════════════════════ */
        #destinations {
            background: var(--clr-snow);
        }

        .dest-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(280px, 1fr));
            gap: 24px;
            max-width: 1300px;
            margin: 0 auto;
        }

        .dest-card {
            position: relative;
            border-radius: var(--radius-lg);
            overflow: hidden;
            height: 320px;
            box-shadow: var(--shadow-card);
            cursor: pointer;
            transition: transform 0.4s cubic-bezier(0.34, 1.56, 0.64, 1), box-shadow 0.4s;
        }

        .dest-card:hover {
            transform: translateY(-10px) scale(1.02);
            box-shadow: 0 24px 64px rgba(11, 61, 110, 0.22);
        }

        .dest-card img,
        .dest-img-placeholder {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s ease;
        }

        .dest-img-placeholder {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.6);
            font-size: 0.85rem;
        }

        .dest-card:hover img {
            transform: scale(1.08);
        }

        .dest-card::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(0deg, rgba(10, 22, 40, 0.85) 0%, transparent 60%);
            z-index: 1;
        }

        .dest-info {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            z-index: 2;
            padding: 20px;
            transform: translateY(8px);
            transition: transform 0.3s;
        }

        .dest-card:hover .dest-info {
            transform: translateY(0);
        }

        .dest-name {
            display: block;
            font-family: var(--ff-display);
            font-size: 1.25rem;
            font-weight: 700;
            color: #fff;
        }

        .dest-sub {
            display: block;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.72);
            margin-top: 4px;
            line-height: 1.5;
        }

        .dest-overlay-link {
            position: absolute;
            inset: 0;
            z-index: 3;
        }

        .dest-btn-wrap {
            text-align: center;
            margin-top: 48px;
        }

        .no-destination {
            grid-column: 1/-1;
            text-align: center;
            padding: 60px 20px;
            color: var(--clr-muted);
        }

        /* ══════════════════════════════════════════════
                                       TREKS
                                    ══════════════════════════════════════════════ */
        #treks {
            background: #374151;
            color: #fff;
        }

        #treks .section-header h2 {
            color: #fff;
        }

        #treks .section-header p {
            color: rgba(255, 255, 255, 0.65);
        }

        #treks .divider-line {
            color: var(--clr-gold);
        }

        .trek-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
            gap: 24px;
            max-width: 1300px;
            margin: 0 auto;
        }

        .trek-card {
            background: rgba(255, 255, 255, 0.05);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: var(--radius-lg);
            overflow: hidden;
            transition: transform 0.35s, box-shadow 0.35s, background 0.35s;
            backdrop-filter: blur(8px);
        }

        .trek-card:hover {
            transform: translateY(-8px);
            background: rgba(255, 255, 255, 0.1);
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.4);
            border-color: rgba(232, 160, 32, 0.3);
        }

        .trek-card>img,
        .tk-img-placeholder {
            width: 100%;
            height: 200px;
            object-fit: cover;
            display: block;
            transition: transform 0.5s;
        }

        .trek-card:hover>img {
            transform: scale(1.05);
        }

        .tk-img-placeholder {
            display: none;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.5);
            font-size: 0.85rem;
            height: 200px;
        }

        .trek-body {
            padding: 20px;
        }

        .trek-body h3 {
            font-family: var(--ff-display);
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
            margin: 0 0 10px;
        }

        .trek-meta {
            display: flex;
            gap: 14px;
            margin-bottom: 16px;
            flex-wrap: wrap;
        }

        .trek-meta span {
            display: flex;
            align-items: center;
            gap: 6px;
            font-size: 0.8rem;
            color: rgba(255, 255, 255, 0.6);
            background: rgba(255, 255, 255, 0.08);
            padding: 4px 12px;
            border-radius: 50px;
        }

        .trek-meta i {
            color: var(--clr-gold);
            font-size: 0.7rem;
        }

        .trek-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            margin-top: 14px;
            padding-top: 14px;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
        }

        .trek-price {
            font-family: var(--ff-display);
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--clr-gold);
        }

        .trek-footer a {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: linear-gradient(135deg, var(--clr-gold), #f0b030);
            color: var(--clr-dark);
            font-weight: 700;
            font-size: 0.82rem;
            padding: 9px 20px;
            border-radius: 50px;
            text-decoration: none;
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .trek-footer a:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 20px rgba(232, 160, 32, 0.5);
        }

        .trek-btn-wrap {
            text-align: center;
            margin-top: 48px;
        }

        .trek-btn-wrap .btn-primary {
            background: linear-gradient(135deg, var(--clr-gold), #f0b030);
            color: var(--clr-dark);
            box-shadow: 0 6px 24px rgba(232, 160, 32, 0.4);
        }

        .trek-btn-wrap .btn-primary:hover {
            box-shadow: 0 12px 36px rgba(232, 160, 32, 0.6);
        }

        /* ══════════════════════════════════════════════
                                       PACKAGES
                                    ══════════════════════════════════════════════ */
        .packages-section {
            background: #fff;
            padding: clamp(60px, 8vw, 120px) clamp(16px, 5vw, 80px);
            position: relative;
            overflow: hidden;
        }

        .packages-section::before {
            content: '';
            position: absolute;
            top: -100px;
            right: -100px;
            width: 500px;
            height: 500px;
            background: radial-gradient(circle, rgba(26, 111, 196, 0.06) 0%, transparent 70%);
            border-radius: 50%;
            pointer-events: none;
        }

        .pkg-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 28px;
            max-width: 1300px;
            margin: 0 auto;
        }

        .pkg-card {
            background: #fff;
            border-radius: var(--radius-lg);
            overflow: hidden;
            box-shadow: var(--shadow-card);
            border: 1px solid rgba(11, 61, 110, 0.07);
            transition: transform 0.35s, box-shadow 0.35s;
            display: flex;
            flex-direction: column;
        }

        .pkg-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 24px 70px rgba(11, 61, 110, 0.17);
        }

        .pkg-image-wrap {
            position: relative;
            height: 220px;
            overflow: hidden;
        }

        .pkg-image {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.5s ease;
            display: block;
        }

        .pkg-card:hover .pkg-image {
            transform: scale(1.07);
        }

        .pk-img-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, var(--clr-sky), var(--clr-mid));
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            gap: 10px;
            color: rgba(255, 255, 255, 0.55);
            font-size: 0.85rem;
        }

        .pk-img-placeholder i {
            font-size: 2rem;
            opacity: 0.4;
        }

        .featured-badge {
            position: absolute;
            top: 14px;
            left: 14px;
            background: linear-gradient(135deg, var(--clr-gold), #f0b030);
            color: var(--clr-dark);
            font-weight: 700;
            font-size: 0.7rem;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 5px 14px;
            border-radius: 50px;
            box-shadow: 0 4px 14px rgba(232, 160, 32, 0.45);
        }

        .pkg-body {
            padding: 22px;
            display: flex;
            flex-direction: column;
            gap: 12px;
            flex: 1;
        }

        .pkg-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            gap: 12px;
        }

        .pkg-title {
            font-family: var(--ff-display);
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--clr-dark);
            margin: 0 0 6px;
            line-height: 1.3;
        }

        .pkg-meta {
            display: flex;
            gap: 12px;
            flex-wrap: wrap;
        }

        .pkg-meta span {
            display: flex;
            align-items: center;
            gap: 5px;
            font-size: 0.78rem;
            color: var(--clr-muted);
        }

        .pkg-meta i {
            color: var(--clr-mid);
        }

        .price-wrap {
            display: flex;
            flex-direction: column;
            align-items: flex-end;
            flex-shrink: 0;
        }

        .old-price {
            font-size: 0.82rem;
            color: var(--clr-muted);
            text-decoration: line-through;
        }

        .pkg-price {
            font-family: var(--ff-display);
            font-size: 1.35rem;
            font-weight: 700;
            color: var(--clr-ember);
        }

        .pkg-desc {
            font-size: 0.86rem;
            color: var(--clr-muted);
            line-height: 1.65;
            margin: 0;
        }

        .pkg-services {
            display: flex;
            flex-wrap: wrap;
            gap: 6px;
        }

        .service-pill {
            background: rgba(26, 111, 196, 0.08);
            color: var(--clr-mid);
            border: 1px solid rgba(26, 111, 196, 0.18);
            border-radius: 50px;
            font-size: 0.75rem;
            font-weight: 500;
            padding: 4px 12px;
            transition: background 0.25s;
        }

        .pkg-card:hover .service-pill {
            background: rgba(26, 111, 196, 0.14);
        }

        .pkg-book-btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--clr-sky), var(--clr-mid));
            color: #fff;
            font-weight: 700;
            font-size: 0.88rem;
            padding: 13px 24px;
            border-radius: 12px;
            text-decoration: none;
            margin-top: auto;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 4px 18px rgba(11, 61, 110, 0.25);
        }

        .pkg-book-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 30px rgba(11, 61, 110, 0.4);
        }

        .no-packages {
            grid-column: 1/-1;
            text-align: center;
            padding: 60px 20px;
            color: var(--clr-muted);
        }

        /* ══════════════════════════════════════════════
                                       TESTIMONIALS
                                    ══════════════════════════════════════════════ */
        #testimonials {
            background: linear-gradient(160deg, #f0f5ff 0%, var(--clr-snow) 100%);
            overflow: hidden;
        }

        .testimonials-inner {
            position: relative;
            max-width: 900px;
            margin: 0 auto;
        }

        .testi-slider {
            overflow: hidden;
            border-radius: var(--radius-lg);
        }

        .testi-track {
            display: flex;
            transition: transform 0.55s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .testi-slide {
            flex: 0 0 100%;
            padding: 4px;
        }

        .testi-card {
            background: #fff;
            border-radius: var(--radius-lg);
            padding: clamp(24px, 4vw, 44px);
            text-align: center;
            box-shadow: var(--shadow-card);
            border: 1px solid rgba(11, 61, 110, 0.06);
            position: relative;
        }

        .quote-icon {
            font-family: var(--ff-display);
            font-size: 6rem;
            color: rgba(26, 111, 196, 0.1);
            line-height: 0.5;
            position: absolute;
            top: 28px;
            left: 28px;
            font-weight: 900;
            pointer-events: none;
        }

        .testi-avatar {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            overflow: hidden;
            margin: 0 auto 14px;
            border: 3px solid transparent;
            background: linear-gradient(#fff, #fff) padding-box,
                linear-gradient(135deg, var(--clr-mid), var(--clr-gold)) border-box;
            box-shadow: 0 6px 24px rgba(26, 111, 196, 0.25);
        }

        .testi-avatar-img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .testi-name {
            font-family: var(--ff-display);
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--clr-dark);
            margin-bottom: 2px;
        }

        .testi-loc {
            font-size: 0.8rem;
            color: var(--clr-muted);
            margin-bottom: 10px;
        }

        .testi-stars {
            display: flex;
            gap: 4px;
            justify-content: center;
            margin-bottom: 16px;
        }

        .testi-stars i {
            color: var(--clr-gold);
            font-size: 0.85rem;
        }

        .testi-stars i.empty {
            color: #e0e0e0;
        }

        .testi-text {
            font-style: italic;
            font-size: clamp(0.9rem, 2vw, 1.05rem);
            color: #475569;
            line-height: 1.75;
            max-width: 600px;
            margin: 0 auto;
        }

        .testi-arrows {
            display: flex;
            gap: 12px;
            justify-content: center;
            margin-top: 28px;
        }

        .testi-arrow {
            width: 46px;
            height: 46px;
            background: #fff;
            border: 1px solid rgba(11, 61, 110, 0.1);
            border-radius: 50%;
            color: var(--clr-sky);
            font-size: 0.85rem;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
            box-shadow: 0 4px 16px rgba(11, 61, 110, 0.1);
        }

        .testi-arrow:hover {
            background: var(--clr-sky);
            color: #fff;
            transform: scale(1.1);
            box-shadow: 0 8px 24px rgba(11, 61, 110, 0.35);
        }

        /* ══════════════════════════════════════════════
                                       CONTACT CTA
                                    ══════════════════════════════════════════════ */
        #contact-cta {
            position: relative;
            overflow: hidden;
            padding: clamp(60px, 8vw, 120px) clamp(16px, 5vw, 80px);
        }

        .cta-bg {
            position: absolute;
            inset: 0;
            width: 100%;
            height: 100%;
            object-fit: cover;
            z-index: 0;
        }

        .cta-bg-placeholder {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, var(--clr-dark), var(--clr-sky));
            z-index: 0;
        }

        .cta-overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, rgba(10, 22, 40, 0.92) 0%, rgba(11, 61, 110, 0.82) 100%);
            z-index: 1;
        }

        .contact-inner {
            position: relative;
            z-index: 2;
            display: grid;
            grid-template-columns: 1fr 1.3fr;
            gap: clamp(32px, 5vw, 80px);
            max-width: 1200px;
            margin: 0 auto;
            align-items: start;
        }

        .contact-left h2 {
            font-family: var(--ff-display);
            font-size: clamp(2rem, 4.5vw, 3.2rem);
            font-weight: 700;
            color: #fff;
            margin: 0 0 16px;
            line-height: 1.2;
        }

        .contact-left>p {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            line-height: 1.7;
            margin-bottom: 28px;
        }

        .contact-info-list {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            flex-direction: column;
            gap: 16px;
        }

        .contact-info-list li {
            display: flex;
            gap: 14px;
            align-items: center;
        }

        .ci-icon {
            width: 42px;
            height: 42px;
            flex-shrink: 0;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.15);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--clr-gold);
            transition: all 0.3s;
        }

        .contact-info-list li:hover .ci-icon {
            background: var(--clr-gold);
            color: var(--clr-dark);
            transform: scale(1.1);
        }

        .ci-text {
            display: flex;
            flex-direction: column;
        }

        .ci-label {
            font-size: 0.72rem;
            color: rgba(255, 255, 255, 0.5);
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        .ci-value {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.9);
            margin-top: 2px;
        }

        /* Contact form card */
        .contact-form-card {
            background: rgba(255, 255, 255, 0.97);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            padding: clamp(24px, 4vw, 44px);
            box-shadow: 0 30px 80px rgba(0, 0, 0, 0.4);
        }

        .contact-form-card h3 {
            font-family: var(--ff-display);
            font-size: 1.6rem;
            font-weight: 700;
            color: var(--clr-dark);
            margin: 0 0 6px;
        }

        .form-sub {
            font-size: 0.86rem;
            color: var(--clr-muted);
            margin: 0 0 24px;
        }

        .form-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
            margin-bottom: 16px;
        }

        .form-row .form-group {
            margin-bottom: 0;
        }

        .form-group label {
            font-size: 0.82rem;
            font-weight: 600;
            color: var(--clr-dark);
        }

        .input-icon-wrap {
            position: relative;
        }

        .input-icon-wrap i {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--clr-muted);
            font-size: 0.85rem;
            pointer-events: none;
            transition: color 0.25s;
        }

        .input-icon-wrap:focus-within i {
            color: var(--clr-mid);
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            padding: 11px 40px 11px 14px;
            border: 1.5px solid rgba(11, 61, 110, 0.12);
            border-radius: 12px;
            font-family: var(--ff-body);
            font-size: 0.88rem;
            color: var(--clr-dark);
            background: #f8f9fc;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s, background 0.25s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: var(--clr-mid);
            background: #fff;
            box-shadow: 0 0 0 4px rgba(26, 111, 196, 0.1);
        }

        .form-group input.error {
            border-color: var(--clr-ember);
            box-shadow: 0 0 0 4px rgba(192, 57, 43, 0.08);
        }

        .form-group textarea {
            padding: 12px 14px;
            height: 110px;
            resize: vertical;
        }

        .form-group select {
            padding: 11px 14px;
            appearance: none;
            cursor: pointer;
        }

        .error-msg {
            font-size: 0.76rem;
            color: var(--clr-ember);
            display: none;
        }

        .error-msg.show {
            display: block;
        }

        .btn-form-submit {
            width: 100%;
            background: linear-gradient(135deg, var(--clr-sky), var(--clr-mid));
            color: #fff;
            border: none;
            font-family: var(--ff-body);
            font-weight: 700;
            font-size: 0.95rem;
            padding: 14px 24px;
            border-radius: 12px;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            box-shadow: 0 6px 24px rgba(11, 61, 110, 0.3);
            margin-top: 8px;
        }

        .btn-form-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 36px rgba(11, 61, 110, 0.45);
        }

        .btn-form-submit:disabled {
            opacity: 0.7;
            transform: none;
            cursor: not-allowed;
        }

        .form-success {
            display: none;
            text-align: center;
            padding: 40px 20px;
        }

        .success-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(135deg, #27ae60, #2ecc71);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1.5rem;
            margin: 0 auto 16px;
            box-shadow: 0 8px 30px rgba(39, 174, 96, 0.4);
            animation: bounceIn 0.6s cubic-bezier(0.34, 1.56, 0.64, 1);
        }

        @keyframes bounceIn {
            from {
                transform: scale(0);
                opacity: 0;
            }

            to {
                transform: scale(1);
                opacity: 1;
            }
        }

        .form-success h4 {
            font-family: var(--ff-display);
            font-size: 1.4rem;
            font-weight: 700;
            color: var(--clr-dark);
        }

        .form-success p {
            color: var(--clr-muted);
            font-size: 0.9rem;
        }

        /* ══════════════════════════════════════════════
                                       RESPONSIVE
                                    ══════════════════════════════════════════════ */
        @media (max-width: 1024px) {
            .why-inner {
                grid-template-columns: 1fr;
            }

            .why-video {
                max-width: 560px;
            }

            .contact-inner {
                grid-template-columns: 1fr;
            }

            .contact-left h2 {
                font-size: 2.2rem;
            }
        }

        @media (max-width: 768px) {
            .trust-bar {
                padding: 0 16px;
            }

            .trust-item {
                padding: 18px 20px;
                min-width: 140px;
            }

            .trust-sep {
                display: none;
            }

            .why-features {
                grid-template-columns: 1fr 1fr;
            }

            .form-row {
                grid-template-columns: 1fr;
                gap: 0;
            }

            .social-sidebar {
                display: none;
            }

            .dest-grid {
                grid-template-columns: 1fr 1fr;
            }

            .trek-grid {
                grid-template-columns: 1fr 1fr;
            }

            .pkg-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 520px) {
            .dest-grid {
                grid-template-columns: 1fr;
            }

            .trek-grid {
                grid-template-columns: 1fr;
            }

            .why-features {
                grid-template-columns: 1fr;
            }

            .trust-item {
                min-width: 100px;
                padding: 14px 12px;
                gap: 10px;
            }

            .trust-icon {
                width: 38px;
                height: 38px;
                font-size: 0.9rem;
            }

            .t-title {
                font-size: 0.85rem;
            }

            .t-sub {
                font-size: 0.72rem;
            }

            .contact-form-card {
                padding: 20px 16px;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: center;
            }

            .btn-explore-hero,
            .btn-watch-hero {
                width: 100%;
                justify-content: center;
            }
        }
    </style>
@endpush

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
                    <i class="fas fa-mountain"></i> Explore Destinations
                </a>
                <a href="#" class="btn-watch-hero" id="openVideoBtn">
                    <div class="play-circle"><i class="fas fa-play"></i></div>
                    Watch Video
                </a>
            </div>
        </div>

        <div class="hero-scroll-hint">
            <div class="scroll-mouse">
                <div class="scroll-wheel"></div>
            </div>
            <span>Scroll</span>
        </div>

        <div class="hero-wave">
            <svg viewBox="0 0 1440 68" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
                <path d="M0,34 C200,68 400,0 600,30 C800,60 1000,10 1200,36 C1320,52 1400,24 1440,30 L1440,68 L0,68 Z"
                    fill="#f8f6f2" />
            </svg>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════
                                         TRUST BAR
                                    ══════════════════════════════════════════════ -->
    <div class="trust-bar">
        <div class="trust-item" data-aos="fade-up" data-aos-delay="0">
            <div class="trust-icon"><i class="fas fa-tag"></i></div>
            <div class="trust-copy">
                <span class="t-title">Best Price</span>
                <span class="t-sub">Guaranteed Best Price</span>
            </div>
        </div>
        <div class="trust-sep"></div>
        <div class="trust-item" data-aos="fade-up" data-aos-delay="80">
            <div class="trust-icon"><i class="fas fa-headset"></i></div>
            <div class="trust-copy">
                <span class="t-title">24/7 Support</span>
                <span class="t-sub">We are always here</span>
            </div>
        </div>
        <div class="trust-sep"></div>
        <div class="trust-item" data-aos="fade-up" data-aos-delay="160">
            <div class="trust-icon"><i class="fas fa-user-tie"></i></div>
            <div class="trust-copy">
                <span class="t-title">Local Expert</span>
                <span class="t-sub">Guided by Local Expert</span>
            </div>
        </div>
        <div class="trust-sep"></div>
        <div class="trust-item" data-aos="fade-up" data-aos-delay="240">
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
                <div class="section-header left-align" data-aos="fade-right">
                    <div class="section-tag">Why Us</div>
                    <h2>Why Choose Us</h2>
                    <div class="divider-line" style="justify-content:flex-start;">
                        <span></span><i class="fas fa-mountain"></i><span></span>
                    </div>
                    <p class="section-subtitle" style="margin:0;text-align:left;">
                        We bring you Nepal's finest experiences — responsibly, safely, memorably.
                    </p>
                </div>
                <div class="why-features">
                    <div class="feature-card" data-aos="zoom-in" data-aos-delay="0">
                        <div class="fc-icon"><i class="fas fa-tag"></i></div>
                        <h4>Best Price Guarantee</h4>
                        <p>Get the best price for your dream adventure in Nepal.</p>
                    </div>
                    <div class="feature-card" data-aos="zoom-in" data-aos-delay="100">
                        <div class="fc-icon"><i class="fas fa-map-marked-alt"></i></div>
                        <h4>Expert Local Guides</h4>
                        <p>Our experienced local guides ensure your safety and satisfaction.</p>
                    </div>
                    <div class="feature-card" data-aos="zoom-in" data-aos-delay="200">
                        <div class="fc-icon"><i class="fas fa-headset"></i></div>
                        <h4>24/7 Customer Support</h4>
                        <p>We are always here to assist you anytime, anywhere.</p>
                    </div>
                    <div class="feature-card" data-aos="zoom-in" data-aos-delay="300">
                        <div class="fc-icon"><i class="fas fa-shield-alt"></i></div>
                        <h4>Safe &amp; Secure Booking</h4>
                        <p>Your booking is safe with us. No hidden charges.</p>
                    </div>
                </div>
            </div>

            <div class="why-video" data-aos="fade-left" data-aos-delay="100">
                <img src="{{ asset('images/landingimg.png') }}" alt="Experience Nepal"
                    onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                <div class="vid-placeholder"
                    style="display:none;background:linear-gradient(135deg,#1a3a5c,#1a6fc4);flex-direction:column;align-items:center;justify-content:center;color:white;gap:12px;">
                    <i class="fas fa-mountain" style="font-size:48px;opacity:0.4;"></i>
                    <span style="font-size:13px;opacity:0.6;">Experience Nepal</span>
                </div>
                <div class="vid-play-btn" id="openVideoBtn2"><i class="fas fa-play"></i></div>
                <div class="vid-caption">Experience Nepal Like Never Before</div>
            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════
                                         POPULAR DESTINATIONS
                                    ══════════════════════════════════════════════ -->
    <section id="destinations">
        <div class="section-header" data-aos="fade-up">
            <div class="section-tag">Explore</div>
            <h2>Popular Destinations</h2>
            <div class="divider-line">
                <span></span><i class="fas fa-mountain"></i><span></span>
            </div>
            <p>Explore the most breathtaking places Nepal has to offer</p>
        </div>

        <div class="dest-grid">
            @forelse($featuredDestinations as $i => $destination)
                <div class="dest-card" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <img src="{{ asset('storage/' . $destination->featured_image) }}" alt="{{ $destination->name }}"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                    <div class="dest-img-placeholder">
                        <i class="fas fa-mountain" style="font-size:36px;opacity:0.5;"></i>
                        <span>{{ $destination->name }}</span>
                    </div>
                    <div class="dest-info">
                        <span class="dest-name">{{ $destination->name }}</span>
                        <span class="dest-sub">{{ $destination->short_description }}</span>
                    </div>
                    <a href="{{ route('destinations.show', $destination->slug) }}" class="dest-overlay-link"></a>
                </div>
            @empty
                <div class="no-destination">
                    <p>No destinations available right now.</p>
                </div>
            @endforelse
        </div>

        <div class="dest-btn-wrap" data-aos="fade-up">
            <a href="{{ route('destinations.index') }}" class="btn-primary">
                <i class="fas fa-compass"></i> View All Destinations
            </a>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════
                                         TOP TREKKING PLANS
                                    ══════════════════════════════════════════════ -->
    <section id="treks">
        <div class="section-header" data-aos="fade-up">
            <div class="section-tag"
                style="background:rgba(232,160,32,0.12);color:var(--clr-gold);border-color:rgba(232,160,32,0.25);">
                Adventure</div>
            <h2>Top Trekking Plans</h2>
            <div class="divider-line">
                <span></span><i class="fas fa-hiking"></i><span></span>
            </div>
            <p>Choose from our expertly crafted trekking adventures</p>
        </div>

        <div class="trek-grid">
            @forelse($featuredTreks as $i => $trek)
                <div class="trek-card" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <img src="{{ asset('storage/' . $trek->featured_image) }}" alt="{{ $trek->name }}" loading="lazy"
                        onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';" />
                    <div class="tk-img-placeholder">
                        <i class="fas fa-mountain" style="font-size:36px;opacity:0.4;"></i>
                        <span>{{ $trek->name }}</span>
                    </div>
                    <div class="trek-body">
                        <h3>{{ $trek->name }}</h3>
                        <div class="trek-meta">
                            <span><i class="far fa-calendar-alt"></i> {{ $trek->duration_days }} Days</span>
                            <span><i class="fas fa-signal"></i> {{ $trek->difficulty }}</span>
                        </div>
                        <div class="trek-footer">
                            <span class="trek-price">
                                @if ($trek->price_usd)
                                    ${{ number_format($trek->price_usd, 0) }}
                                @else
                                    Contact Us
                                @endif
                            </span>
                            <a href="{{ route('treks.show', $trek->slug) }}">
                                View Details <i class="fas fa-arrow-right" style="font-size:0.7rem;"></i>
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div style="grid-column:1/-1;text-align:center;padding:50px 20px;color:rgba(255,255,255,0.5);">
                    <p>No trekking plans available right now.</p>
                </div>
            @endforelse
        </div>

        <div class="trek-btn-wrap" data-aos="fade-up">
            <a href="{{ route('treks.index') }}" class="btn-primary">
                <i class="fas fa-hiking"></i> View All Treks
            </a>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════
                                         PACKAGES
                                    ══════════════════════════════════════════════ -->
    <section class="packages-section">
        <div class="section-header" data-aos="fade-up">
            <span class="section-tag">Travel Packages</span>
            <h2 class="section-title">Explore Our Featured Packages</h2>
            <p class="section-subtitle">Discover unforgettable journeys across Nepal with carefully curated travel
                experiences.</p>
        </div>

        <div class="pkg-grid">
            @forelse($featuredPackages as $i => $package)
                @php
                    $price = $package->price_usd_discounted ?? $package->price_usd;
                    $services = is_array($package->included) ? array_slice($package->included, 0, 4) : [];
                @endphp
                <div class="pkg-card" data-aos="fade-up" data-aos-delay="{{ $i * 80 }}">
                    <div class="pkg-image-wrap">
                        @if ($package->featured_image)
                            <img src="{{ asset('storage/' . $package->featured_image) }}" alt="{{ $package->name }}"
                                class="pkg-image"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                        @endif
                        <div class="pk-img-placeholder"
                            style="{{ $package->featured_image ? 'display:none;' : 'display:flex;' }}">
                            <i class="fas fa-mountain"></i>
                            <span>{{ $package->name }}</span>
                        </div>
                        @if ($package->is_featured)
                            <div class="featured-badge">⭐ Featured</div>
                        @endif
                    </div>
                    <div class="pkg-body">
                        <div class="pkg-top">
                            <div>
                                <h3 class="pkg-title">{{ $package->name }}</h3>
                                <div class="pkg-meta">
                                    <span><i class="far fa-clock"></i> {{ $package->duration_days }} Days</span>
                                    @if ($package->best_season)
                                        <span><i class="fas fa-cloud-sun"></i> {{ $package->best_season }}</span>
                                    @endif
                                </div>
                            </div>
                            <div class="price-wrap">
                                @if ($package->price_usd_discounted)
                                    <span class="old-price">${{ number_format($package->price_usd, 0) }}</span>
                                @endif
                                <span class="pkg-price">${{ number_format($price, 0) }}</span>
                            </div>
                        </div>
                        <p class="pkg-desc">{{ \Illuminate\Support\Str::limit($package->short_description, 110) }}</p>
                        @if (count($services))
                            <div class="pkg-services">
                                @foreach ($services as $service)
                                    <span class="service-pill">{{ $service }}</span>
                                @endforeach
                            </div>
                        @endif
                        <a href="{{ route('packages.show', $package->slug) }}" class="pkg-book-btn">
                            <i class="fas fa-suitcase-rolling"></i> View Package
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
        <div class="section-header" data-aos="fade-up">
            <div class="section-tag">Reviews</div>
            <h2>Happy Customers</h2>
            <div class="divider-line">
                <span></span><i class="fas fa-heart"></i><span></span>
            </div>
            <p>What our travelers say about their Nepal experience</p>
        </div>

        <div class="testimonials-inner" data-aos="fade-up" data-aos-delay="100">
            <div class="testi-slider">
                <div class="testi-track" id="testiTrack">
                    @foreach ($testimonials as $testimonial)
                        <div class="testi-slide">
                            <div class="testi-card">
                                <div class="quote-icon">"</div>
                                <div class="testi-avatar">
                                    <img src="{{ $testimonial->client_photo_url }}"
                                        alt="{{ $testimonial->client_name }}" class="testi-avatar-img">
                                </div>
                                <div class="testi-name">{{ $testimonial->client_name }}</div>
                                <div class="testi-loc">{{ $testimonial->client_country }}</div>
                                <div class="testi-stars">
                                    @for ($i = 1; $i <= 5; $i++)
                                        <i class="fas fa-star {{ $i <= $testimonial->rating ? '' : 'empty' }}"></i>
                                    @endfor
                                </div>
                                <p class="testi-text">"{{ $testimonial->review }}"</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="testi-arrows">
                <button id="prevBtn" class="testi-arrow" aria-label="Previous"><i
                        class="fas fa-chevron-left"></i></button>
                <button id="nextBtn" class="testi-arrow" aria-label="Next"><i
                        class="fas fa-chevron-right"></i></button>
            </div>
        </div>
    </section>


    <!-- ══════════════════════════════════════════════
                                         CONTACT CTA
                                    ══════════════════════════════════════════════ -->
    <section id="contact-cta">
        <img class="cta-bg" src="{{ asset('images/landingimg.png') }}" alt="Nepal"
            onerror="this.style.display='none';" />
        <div class="cta-bg-placeholder"></div>
        <div class="cta-overlay"></div>

        <div class="contact-inner">
            <div class="contact-left" data-aos="fade-right">
                <h2>Get In Touch<br>With Us</h2>
                <p>Have any questions? We're here to help!<br>Send us a message and we'll get back to you within 24 hours.
                </p>
                <ul class="contact-info-list">
                    @if (setting('address'))
                        <li>
                            <div class="ci-icon"><i class="fas fa-map-marker-alt"></i></div>
                            <div class="ci-text">
                                <span class="ci-label">Our Office</span>
                                <span class="ci-value">{{ setting('address') }}</span>
                            </div>
                        </li>
                    @endif
                    @if (setting('phone'))
                        <li>
                            <div class="ci-icon"><i class="fas fa-phone-alt"></i></div>
                            <div class="ci-text">
                                <span class="ci-label">Phone</span>
                                <span class="ci-value">{{ setting('phone') }}</span>
                            </div>
                        </li>
                    @endif
                    @if (setting('whatsapp'))
                        <li>
                            <div class="ci-icon"><i class="fab fa-whatsapp"></i></div>
                            <div class="ci-text">
                                <span class="ci-label">WhatsApp</span>
                                <span class="ci-value">{{ setting('whatsapp') }}</span>
                            </div>
                        </li>
                    @endif
                    @if (setting('contact_email'))
                        <li>
                            <div class="ci-icon"><i class="fas fa-envelope"></i></div>
                            <div class="ci-text">
                                <span class="ci-label">Email</span>
                                <span class="ci-value">{{ setting('contact_email') }}</span>
                            </div>
                        </li>
                    @endif
                    @if (setting('support_email'))
                        <li>
                            <div class="ci-icon"><i class="fas fa-headset"></i></div>
                            <div class="ci-text">
                                <span class="ci-label">Support</span>
                                <span class="ci-value">{{ setting('support_email') }}</span>
                            </div>
                        </li>
                    @endif
                    @if (setting('working_hours'))
                        <li>
                            <div class="ci-icon"><i class="fas fa-clock"></i></div>
                            <div class="ci-text">
                                <span class="ci-label">Working Hours</span>
                                <span class="ci-value">{{ setting('working_hours') }}</span>
                            </div>
                        </li>
                    @endif
                </ul>
            </div>

            <div class="contact-form-card" data-aos="fade-left" data-aos-delay="100">
                <h3>Send Us a Message</h3>
                <p class="form-sub">Fill out the form below and our team will reach out shortly.</p>

                <form id="contactForm" novalidate>
                    @csrf
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

                    <div class="form-group">
                        <label for="message">Your Message</label>
                        <textarea id="message" name="message"
                            placeholder="Tell us about your travel plans, preferred dates, group size, or any questions..."></textarea>
                        <span class="error-msg" id="err_message">Please enter your message.</span>
                    </div>

                    <button type="submit" class="btn-form-submit" id="submitBtn">
                        <i class="fas fa-paper-plane"></i> Send Message
                    </button>
                </form>

                <div class="form-success" id="formSuccess">
                    <div class="success-icon"><i class="fas fa-check"></i></div>
                    <h4>Message Sent!</h4>
                    <p>Thank you for reaching out. Our team will contact you within 24 hours.</p>
                </div>
            </div>
        </div>
    </section>

@endsection


@push('scripts')
    <script>
        /* ── Testimonial slider ── */
        document.addEventListener('DOMContentLoaded', function() {
            let current = 0;
            const track = document.getElementById('testiTrack');
            const slides = document.querySelectorAll('.testi-slide');
            const total = slides.length;

            if (!track || !total) return;

            function goTo(n) {
                current = (n + total) % total;
                track.style.transform = `translateX(-${current * 100}%)`;
            }

            document.getElementById('nextBtn')?.addEventListener('click', () => goTo(current + 1));
            document.getElementById('prevBtn')?.addEventListener('click', () => goTo(current - 1));
            setInterval(() => goTo(current + 1), 5500);
            goTo(0);

            /* ── GSAP counter for stats (if you add them) ── */
            if (typeof gsap !== 'undefined' && typeof ScrollTrigger !== 'undefined') {
                gsap.registerPlugin(ScrollTrigger);
                // counter animation hook — add elements with class .count-up and data-target
                document.querySelectorAll('.count-up').forEach(el => {
                    const target = parseInt(el.dataset.target || '0');
                    gsap.fromTo(el, {
                        innerText: 0
                    }, {
                        innerText: target,
                        duration: 2,
                        ease: 'power2.out',
                        snap: {
                            innerText: 1
                        },
                        scrollTrigger: {
                            trigger: el,
                            start: 'top 80%',
                            once: true
                        }
                    });
                });
            }
        });

        /* ── Contact form AJAX ── */
        (function() {
            const form = document.getElementById('contactForm');
            const successBox = document.getElementById('formSuccess');
            const submitBtn = document.getElementById('submitBtn');
            if (!form) return;

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
                    document.getElementById(errId)?.classList.remove('show');
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
                        err?.classList.add('show');
                        valid = false;
                    } else {
                        el.classList.remove('error');
                        err?.classList.remove('show');
                    }
                });
                if (!valid) return;

                submitBtn.disabled = true;
                submitBtn.innerHTML = '<i class="fas fa-circle-notch fa-spin"></i> Sending...';

                fetch('{{ route('contact.store') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content ||
                                '{{ csrf_token() }}',
                            'Accept': 'application/json',
                        },
                        body: new FormData(form)
                    })
                    .then(r => r.json())
                    .then(data => {
                        if (data.success || data.status === 'success') showSuccess();
                        else {
                            resetBtn();
                            alert(data.message || 'Something went wrong. Please try again.');
                        }
                    })
                    .catch(() => showSuccess());
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
@endpush
