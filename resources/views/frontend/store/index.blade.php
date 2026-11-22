@extends('layouts.store')
@section('title', (request('category') ? optional(($categories ?? collect())->firstWhere('slug',
    request('category')))->name . ' – ' : '') . setting('site_name', 'TrailCo') . ' Store')

    @push('styles')
        <style>
            html {
                scroll-behavior: smooth;
            }

            #shop,
            #categories {
                scroll-margin-top: 90px;
            }

            /* ---------- HERO ---------- */
            .hero {
                position: relative;
                min-height: 600px;
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                overflow: hidden;
                background: #0a121c;
                isolation: isolate;
            }

            .hero-bg-img {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                object-position: center 30%;
                z-index: 0;
                transform: scale(1.04);
                animation: heroZoom 18s ease-out forwards;
            }

            @keyframes heroZoom {
                to {
                    transform: scale(1);
                }
            }

            .hero-overlay {
                position: absolute;
                inset: 0;
                background:
                    linear-gradient(180deg, rgba(10, 18, 28, .35) 0%, rgba(10, 18, 28, 0) 30%, rgba(10, 18, 28, .75) 100%),
                    linear-gradient(100deg, rgba(10, 18, 28, .92) 0%, rgba(10, 18, 28, .7) 34%, rgba(10, 18, 28, .12) 64%, rgba(10, 18, 28, .04) 100%);
                z-index: 1;
            }

            .hero-content {
                position: relative;
                z-index: 2;
                padding: 90px 60px 56px;
                max-width: 680px;
                animation: fadeUp .8s ease both;
            }

            .hero .eyebrow {
                display: inline-flex;
                align-items: center;
                gap: 10px;
                color: #b7e56b;
                margin-bottom: 20px;
                letter-spacing: .18em;
                text-transform: uppercase;
                font-size: .76rem;
                font-weight: 600;
            }

            .hero .eyebrow::before {
                content: '';
                width: 34px;
                height: 2px;
                background: #b7e56b;
                border-radius: 2px;
            }

            .hero h1 {
                color: #fff;
                font-size: clamp(2.2rem, 4.6vw, 3.6rem);
                line-height: 1.08;
                font-weight: 800;
                letter-spacing: -.02em;
                margin-bottom: 22px;
                text-shadow: 0 2px 24px rgba(0, 0, 0, .35);
            }

            .hero h1 .accent {
                color: var(--green);
            }

            .hero p {
                color: rgba(255, 255, 255, .86);
                font-size: 1.05rem;
                line-height: 1.65;
                max-width: 480px;
                margin-bottom: 32px;
            }

            .hero .btn-primary {
                box-shadow: 0 10px 28px rgba(140, 200, 60, .35);
                transition: transform .2s ease, box-shadow .2s ease;
            }

            .hero .btn-primary:hover {
                transform: translateY(-2px);
                box-shadow: 0 14px 34px rgba(140, 200, 60, .5);
            }

            @keyframes fadeUp {
                from {
                    opacity: 0;
                    transform: translateY(22px);
                }

                to {
                    opacity: 1;
                    transform: translateY(0);
                }
            }

            /* ---------- BUILT FOR ADVENTURE (feature bar) ---------- */
            .feature-bar {
                position: relative;
                z-index: 2;
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                margin: 0 60px 40px;
                background: rgba(14, 22, 16, .55);
                backdrop-filter: blur(14px) saturate(140%);
                -webkit-backdrop-filter: blur(14px) saturate(140%);
                border: 1px solid rgba(255, 255, 255, .14);
                border-radius: 16px;
                box-shadow: 0 20px 50px rgba(0, 0, 0, .35);
                overflow: hidden;
                animation: fadeUp .9s .15s ease both;
            }

            .feature-item {
                position: relative;
                display: flex;
                align-items: center;
                gap: 16px;
                padding: 26px 28px;
                color: #fff;
                transition: background .25s ease;
            }

            .feature-item+.feature-item::before {
                content: '';
                position: absolute;
                left: 0;
                top: 22%;
                bottom: 22%;
                width: 1px;
                background: linear-gradient(180deg, transparent, rgba(255, 255, 255, .22), transparent);
            }

            .feature-item::after {
                content: '';
                position: absolute;
                left: 0;
                right: 0;
                bottom: 0;
                height: 3px;
                background: var(--green);
                transform: scaleX(0);
                transform-origin: left;
                transition: transform .35s ease;
            }

            .feature-item:hover {
                background: rgba(255, 255, 255, .07);
            }

            .feature-item:hover::after {
                transform: scaleX(1);
            }

            .f-icon {
                flex-shrink: 0;
                width: 52px;
                height: 52px;
                border-radius: 14px;
                display: flex;
                align-items: center;
                justify-content: center;
                background: linear-gradient(145deg, rgba(183, 229, 107, .22), rgba(183, 229, 107, .06));
                border: 1px solid rgba(183, 229, 107, .35);
                transition: transform .3s ease, background .3s ease;
            }

            .feature-item:hover .f-icon {
                transform: translateY(-3px) rotate(-4deg);
                background: linear-gradient(145deg, rgba(183, 229, 107, .4), rgba(183, 229, 107, .12));
            }

            .f-icon svg {
                width: 26px;
                height: 26px;
                stroke: #b7e56b;
            }

            .feature-item .f-title {
                font-size: .95rem;
                font-weight: 700;
                letter-spacing: .01em;
                margin-bottom: 4px;
            }

            .feature-item .f-sub {
                font-size: .8rem;
                color: rgba(255, 255, 255, .7);
                line-height: 1.4;
            }

            @media (max-width:1100px) {
                .feature-bar {
                    grid-template-columns: repeat(2, 1fr);
                    margin: 0 30px 30px;
                }

                .feature-item:nth-child(3)::before {
                    display: none;
                }

                .feature-item:nth-child(n+3) {
                    border-top: 1px solid rgba(255, 255, 255, .1);
                }
            }

            @media (max-width:640px) {
                .hero {
                    min-height: 560px;
                }

                .feature-bar {
                    grid-template-columns: 1fr;
                    margin: 0 16px 20px;
                    border-radius: 14px;
                }

                .feature-item {
                    padding: 18px 20px;
                }

                .feature-item+.feature-item::before {
                    display: none;
                }

                .feature-item+.feature-item {
                    border-top: 1px solid rgba(255, 255, 255, .1);
                }

                .hero-content {
                    padding: 60px 22px 30px;
                }
            }

            /* ---------- SECTION HEAD POLISH ---------- */
            .section-head .eyebrow,
            .picks-head .eyebrow {
                letter-spacing: .16em;
                text-transform: uppercase;
                font-size: .74rem;
                font-weight: 600;
                color: var(--green-dark);
                margin-bottom: 8px;
            }

            /* ---------- CATEGORIES ---------- */
            .category-grid {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                gap: 22px;
            }

            .category-grid>a {
                display: contents;
            }

            .cat-card {
                background: #fff;
                border: 1px solid var(--line);
                border-radius: 14px;
                overflow: hidden;
                text-align: center;
                transition: box-shadow .3s ease, transform .3s ease, border-color .3s ease;
                cursor: pointer;
                position: relative;
            }

            .cat-card:hover {
                box-shadow: 0 18px 38px rgba(0, 0, 0, .12);
                transform: translateY(-6px);
                border-color: transparent;
            }

            .cat-card.active {
                box-shadow: 0 0 0 2px var(--green) inset, 0 12px 28px rgba(0, 0, 0, .08);
                border-color: var(--green);
            }

            .cat-media {
                overflow: hidden;
                height: 170px;
            }

            .cat-img {
                height: 100%;
                width: 100%;
                object-fit: cover;
                transition: transform .6s ease;
                display: block;
            }

            .cat-card:hover .cat-img {
                transform: scale(1.08);
            }

            .cat-body {
                padding: 20px 14px 26px;
                position: relative;
            }

            .cat-icon {
                width: 52px;
                height: 52px;
                border-radius: 50%;
                background: #fff;
                box-shadow: 0 6px 18px rgba(0, 0, 0, .14);
                display: flex;
                align-items: center;
                justify-content: center;
                margin: -46px auto 14px;
                position: relative;
                z-index: 2;
                transition: background .3s ease;
            }

            .cat-card:hover .cat-icon {
                background: var(--green);
            }

            .cat-icon svg {
                width: 22px;
                height: 22px;
                stroke: var(--ink);
            }

            .cat-card h3 {
                font-size: 1.05rem;
                font-weight: 600;
                margin-bottom: 6px;
            }

            .cat-count {
                font-size: .74rem;
                color: var(--muted);
                margin-bottom: 10px;
            }

            .cat-link {
                font-size: .8rem;
                font-weight: 600;
                color: var(--green-dark);
                display: inline-flex;
                align-items: center;
                gap: 4px;
            }

            .cat-link svg {
                transition: transform .25s ease;
            }

            .cat-card:hover .cat-link svg {
                transform: translateX(4px);
            }

            @media (max-width:1100px) {
                .category-grid {
                    grid-template-columns: repeat(3, 1fr);
                }
            }

            @media (max-width:640px) {
                .category-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 14px;
                }
            }

            /* ---------- TOOLBAR ---------- */
            .picks-head {
                display: flex;
                align-items: flex-end;
                justify-content: space-between;
                margin-bottom: 26px;
                flex-wrap: wrap;
                gap: 16px;
            }

            .picks-head .titles h2 {
                font-size: 2.1rem;
                font-weight: 700;
                position: relative;
                padding-bottom: 14px;
            }

            .picks-head .titles h2::after {
                content: '';
                position: absolute;
                left: 0;
                bottom: 0;
                width: 46px;
                height: 3px;
                background: var(--green);
                border-radius: 2px;
            }

            .toolbar-right {
                display: flex;
                align-items: center;
                gap: 10px;
                flex-wrap: wrap;
            }

            /* Search: fully clickable (icon button submits the form) */
            .store-search-form {
                position: relative;
                display: flex;
                align-items: center;
                background: #fff;
                border: 1px solid var(--line);
                border-radius: 30px;
                transition: border-color .2s, box-shadow .2s, width .3s ease;
                width: 260px;
            }

            .store-search-form:focus-within {
                border-color: var(--green);
                box-shadow: 0 0 0 4px rgba(140, 200, 60, .18);
                width: 310px;
            }

            .store-search-form input[type="search"] {
                flex: 1;
                min-width: 0;
                border: none;
                background: transparent;
                border-radius: 30px;
                padding: 11px 6px 11px 20px;
                font-family: 'Inter', sans-serif;
                font-size: .86rem;
                color: var(--ink);
                -webkit-appearance: none;
                appearance: none;
            }

            .store-search-form input[type="search"]:focus {
                outline: none;
            }

            .store-search-form input[type="search"]::-webkit-search-cancel-button {
                display: none;
            }

            .search-clear {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 26px;
                height: 26px;
                border-radius: 50%;
                color: var(--muted);
                font-size: .8rem;
                transition: background .2s;
            }

            .search-clear:hover {
                background: var(--panel);
                color: var(--ink);
            }

            .search-btn {
                flex-shrink: 0;
                width: 38px;
                height: 38px;
                margin: 3px;
                border: none;
                border-radius: 50%;
                background: var(--green);
                color: #16210a;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                transition: background .2s, transform .2s, color .2s;
            }

            .search-btn:hover {
                background: var(--green-dark);
                color: #fff;
                transform: scale(1.06);
            }

            .search-btn:active {
                transform: scale(.95);
            }

            .search-btn svg {
                width: 17px;
                height: 17px;
            }

            .store-sort select {
                border: 1px solid var(--line);
                border-radius: 30px;
                padding: 11px 38px 11px 18px;
                font-family: 'Inter', sans-serif;
                font-size: .85rem;
                background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%23666' stroke-width='2.4' stroke-linecap='round'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E") no-repeat right 15px center;
                -webkit-appearance: none;
                appearance: none;
                cursor: pointer;
                color: var(--ink);
                transition: border-color .2s, box-shadow .2s;
            }

            .store-sort select:hover {
                border-color: #b9c2b0;
            }

            .store-sort select:focus {
                outline: none;
                border-color: var(--green);
                box-shadow: 0 0 0 4px rgba(140, 200, 60, .18);
            }

            .carousel-arrows {
                display: flex;
                gap: 10px;
            }

            .arrow-btn {
                width: 40px;
                height: 40px;
                border-radius: 50%;
                border: 1px solid var(--line);
                background: #fff;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: var(--ink);
                transition: background .2s, border-color .2s, transform .2s;
            }

            .arrow-btn.disabled {
                opacity: .35;
                pointer-events: none;
            }

            .arrow-btn:not(.disabled):hover {
                background: var(--green);
                border-color: var(--green);
                transform: translateY(-2px);
            }

            .active-filter-chip {
                display: inline-flex;
                align-items: center;
                flex-wrap: wrap;
                gap: 10px;
                background: var(--panel);
                border: 1px solid var(--line);
                border-radius: 30px;
                padding: 8px 8px 8px 16px;
                font-size: .82rem;
                font-weight: 500;
                margin-bottom: 22px;
            }

            .active-filter-chip a {
                display: flex;
                align-items: center;
                justify-content: center;
                width: 24px;
                height: 24px;
                border-radius: 50%;
                background: #fff;
                color: var(--muted);
                font-size: .75rem;
                transition: background .2s, color .2s;
            }

            .active-filter-chip a:hover {
                background: #c1362b;
                color: #fff;
            }

            /* ---------- PRODUCTS ---------- */
            .product-grid {
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                gap: 20px;
            }

            .product-card {
                background: #fff;
                border: 1px solid var(--line);
                border-radius: 14px;
                padding: 14px;
                position: relative;
                transition: box-shadow .3s ease, transform .3s ease, border-color .3s ease;
                display: flex;
                flex-direction: column;
                animation: fadeUp .5s ease both;
            }

            .product-card:nth-child(2) {
                animation-delay: .04s;
            }

            .product-card:nth-child(3) {
                animation-delay: .08s;
            }

            .product-card:nth-child(4) {
                animation-delay: .12s;
            }

            .product-card:nth-child(5) {
                animation-delay: .16s;
            }

            .product-card:nth-child(n+6) {
                animation-delay: .2s;
            }

            .product-card:hover {
                box-shadow: 0 18px 36px rgba(0, 0, 0, .1);
                transform: translateY(-5px);
                border-color: transparent;
            }

            .wish-btn {
                position: absolute;
                top: 16px;
                right: 16px;
                width: 34px;
                height: 34px;
                border-radius: 50%;
                background: #fff;
                border: 1px solid var(--line);
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                z-index: 2;
                transition: transform .2s ease, box-shadow .2s ease;
            }

            .wish-btn:hover {
                transform: scale(1.12);
                box-shadow: 0 4px 12px rgba(0, 0, 0, .12);
            }

            .wish-btn svg {
                width: 15px;
                height: 15px;
                stroke: var(--ink);
                fill: none;
                transition: fill .2s, stroke .2s;
            }

            .wish-btn.active svg {
                fill: #e0483e;
                stroke: #e0483e;
            }

            .sale-badge {
                position: absolute;
                top: 16px;
                left: 16px;
                background: linear-gradient(135deg, #d8412f, #b52a20);
                color: #fff;
                font-size: .68rem;
                font-weight: 700;
                padding: 5px 10px;
                border-radius: 20px;
                z-index: 2;
                box-shadow: 0 4px 10px rgba(193, 54, 43, .35);
            }

            .product-img-wrap {
                height: 200px;
                display: flex;
                align-items: center;
                justify-content: center;
                margin-bottom: 16px;
                overflow: hidden;
                background: var(--panel);
                border-radius: 10px;
            }

            .product-img {
                width: 100%;
                height: 100%;
                object-fit: contain;
                transition: transform .5s ease;
            }

            .product-card:hover .product-img {
                transform: scale(1.07);
            }

            .product-img-fallback {
                font-size: 2rem;
                color: var(--line);
            }

            .p-brand {
                font-size: .68rem;
                letter-spacing: .08em;
                text-transform: uppercase;
                color: var(--green-dark);
                font-weight: 600;
                margin-bottom: 4px;
            }

            .p-name {
                font-size: .94rem;
                font-weight: 500;
                margin-bottom: 8px;
                line-height: 1.35;
                min-height: 2.7em;
                display: -webkit-box;
                -webkit-line-clamp: 2;
                -webkit-box-orient: vertical;
                overflow: hidden;
            }

            .p-rating {
                display: flex;
                align-items: center;
                gap: 5px;
                font-size: .78rem;
                color: var(--muted);
                margin-bottom: 12px;
            }

            .stars {
                display: flex;
                gap: 1px;
            }

            .stars svg {
                width: 13px;
                height: 13px;
            }

            .star-fill {
                fill: #f5a623;
                stroke: #f5a623;
            }

            .star-empty {
                fill: none;
                stroke: #d8d8d8;
            }

            .p-footer {
                display: flex;
                align-items: center;
                justify-content: space-between;
                margin-top: auto;
                padding-top: 12px;
                border-top: 1px dashed var(--line);
            }

            .p-price {
                font-weight: 700;
                font-size: .98rem;
            }

            .p-price .old-price {
                display: block;
                font-size: .75rem;
                color: var(--muted);
                text-decoration: line-through;
                font-weight: 400;
            }

            .add-cart-btn {
                width: 38px;
                height: 38px;
                border-radius: 50%;
                background: var(--green);
                border: none;
                display: flex;
                align-items: center;
                justify-content: center;
                cursor: pointer;
                color: #16210a;
                font-size: .9rem;
                transition: background .2s, transform .2s, color .2s, box-shadow .2s;
                flex-shrink: 0;
            }

            .add-cart-btn:hover {
                background: var(--green-dark);
                color: #fff;
                transform: scale(1.1);
                box-shadow: 0 6px 16px rgba(100, 150, 40, .4);
            }

            .out-of-stock {
                font-size: .68rem;
                font-weight: 700;
                color: #c1362b;
                background: rgba(193, 54, 43, .08);
                padding: 6px 10px;
                border-radius: 20px;
            }

            @media (max-width:1280px) {
                .product-grid {
                    grid-template-columns: repeat(4, 1fr);
                }
            }

            @media (max-width:1100px) {
                .product-grid {
                    grid-template-columns: repeat(3, 1fr);
                }
            }

            @media (max-width:640px) {
                .product-grid {
                    grid-template-columns: repeat(2, 1fr);
                    gap: 12px;
                }

                .product-card {
                    padding: 10px;
                }

                .product-img-wrap {
                    height: 150px;
                }

                .picks-head {
                    flex-direction: column;
                    align-items: flex-start;
                }

                .toolbar-right {
                    width: 100%;
                }

                .store-search-form,
                .store-search-form:focus-within {
                    width: 100%;
                }

                .picks-head .titles h2 {
                    font-size: 1.7rem;
                }
            }

            /* ---------- EMPTY STATE ---------- */
            .empty-state {
                grid-column: 1/-1;
                text-align: center;
                padding: 80px 20px;
                color: var(--muted);
                background: var(--panel);
                border-radius: 14px;
                border: 1px dashed var(--line);
            }

            .empty-state i {
                font-size: 2.6rem;
                margin-bottom: 16px;
                color: #c8cfc2;
            }

            .empty-state h3 {
                font-family: 'Poppins', sans-serif;
                color: var(--ink);
                font-size: 1.15rem;
                margin-bottom: 6px;
            }

            .empty-state .btn-reset {
                display: inline-block;
                margin-top: 18px;
                padding: 10px 22px;
                border-radius: 30px;
                background: var(--green);
                color: #16210a;
                font-weight: 600;
                font-size: .85rem;
                transition: background .2s, color .2s;
            }

            .empty-state .btn-reset:hover {
                background: var(--green-dark);
                color: #fff;
            }

            .flash-success {
                grid-column: 1/-1;
                display: flex;
                align-items: center;
                gap: 10px;
                background: #eaf6de;
                border: 1px solid #cfe8b3;
                color: var(--green-dark);
                padding: 14px 18px;
                border-radius: 10px;
                font-size: .88rem;
                font-weight: 600;
                margin-bottom: 6px;
            }

            /* ---------- PAGINATION ---------- */
            .pagination-wrap {
                margin-top: 48px;
                display: flex;
                justify-content: center;
            }

            .pagination-wrap nav ul {
                list-style: none;
                display: flex;
                gap: 6px;
            }

            .pagination-wrap .page-link {
                display: flex;
                align-items: center;
                justify-content: center;
                min-width: 40px;
                height: 40px;
                border-radius: 50%;
                border: 1px solid var(--line);
                color: var(--ink);
                font-size: .85rem;
                background: #fff;
                transition: background .2s, transform .2s;
            }

            .pagination-wrap .page-link:hover {
                background: var(--panel);
                transform: translateY(-2px);
            }

            .pagination-wrap .active .page-link {
                background: var(--green);
                border-color: var(--green);
                color: #16210a;
                font-weight: 700;
            }

            .pagination-wrap .disabled .page-link {
                opacity: .35;
            }

            /* ---------- PROMO BANNERS ---------- */
            .promo-row {
                display: grid;
                grid-template-columns: 1fr 1fr;
                gap: 20px;
                padding: 0 60px 80px;
                max-width: 1400px;
                margin: 0 auto;
            }

            .promo-card {
                position: relative;
                height: 260px;
                border-radius: 16px;
                overflow: hidden;
                display: flex;
                align-items: flex-end;
                color: #fff;
                box-shadow: 0 10px 28px rgba(0, 0, 0, .12);
                transition: transform .3s ease, box-shadow .3s ease;
            }

            .promo-card:hover {
                transform: translateY(-4px);
                box-shadow: 0 18px 40px rgba(0, 0, 0, .2);
            }

            .promo-card::before {
                content: '';
                position: absolute;
                inset: 0;
                background: linear-gradient(90deg, rgba(10, 14, 10, .85) 0%, rgba(10, 14, 10, .45) 55%, rgba(10, 14, 10, .08) 100%);
                z-index: 1;
            }

            .promo-card img {
                position: absolute;
                inset: 0;
                width: 100%;
                height: 100%;
                object-fit: cover;
                z-index: 0;
                transition: transform .7s ease;
            }

            .promo-card:hover img {
                transform: scale(1.06);
            }

            .promo-inner {
                position: relative;
                z-index: 2;
                padding: 30px 34px;
            }

            .promo-inner h3 {
                font-size: 1.5rem;
                font-weight: 700;
                margin-bottom: 8px;
            }

            .promo-inner p {
                font-size: .88rem;
                color: rgba(255, 255, 255, .88);
                margin-bottom: 18px;
                max-width: 240px;
                line-height: 1.5;
            }

            @media (max-width:1100px) {
                .promo-row {
                    grid-template-columns: 1fr;
                    padding: 0 30px 60px;
                }
            }

            @media (max-width:640px) {
                .promo-row {
                    padding: 0 16px 50px;
                }

                .promo-card {
                    height: 220px;
                }
            }

            /* ---------- ACCESSIBILITY ---------- */
            .search-btn:focus-visible,
            .add-cart-btn:focus-visible,
            .wish-btn:focus-visible,
            .arrow-btn:focus-visible,
            .cat-card:focus-visible {
                outline: 3px solid var(--green);
                outline-offset: 2px;
            }

            @media (prefers-reduced-motion: reduce) {

                *,
                *::before,
                *::after {
                    animation: none !important;
                    transition: none !important;
                    scroll-behavior: auto !important;
                }
            }
        </style>
    @endpush

@section('content')

    @php
        $activeSlug = request('category');
        $activeCategory = $activeSlug ? ($categories ?? collect())->firstWhere('slug', $activeSlug) : null;

        // icon map — falls back to a generic bag icon
        $iconMap = [
            'backpacks' =>
                '<path d="M6 8a6 6 0 0112 0v3h1a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1v-7a1 1 0 011-1h1V8z"/><path d="M9 8V6a3 3 0 016 0v2"/>',
            'clothing' => '<path d="M8 4L4 8l3 3 2-2v9h6v-9l2 2 3-3-4-4-3 2-3-2z"/>',
            'footwear' => '<path d="M3 18c0-2 2-3 4-5l3-4 3 2 4-1 4 3v3a2 2 0 01-2 2H5a2 2 0 01-2-2z"/>',
            'trekking-gear' => '<path d="M6 21L10 3M18 21L14 3"/><path d="M8 12h2M14 12h2"/>',
            'camping-gear' => '<path d="M2 20h20L12 4z"/><path d="M12 4v16"/>',
        ];
        $fallbackIcon =
            '<path d="M6 8a6 6 0 0112 0v3h1a1 1 0 011 1v7a1 1 0 01-1 1H5a1 1 0 01-1-1v-7a1 1 0 011-1h1V8z"/>';

        // hero image resolution — DB setting if present & valid, otherwise local static file
        $heroImageSetting = setting('store_hero_image');
        $heroImageUrl = $heroImageSetting
            ? (Str::startsWith($heroImageSetting, 'http')
                ? $heroImageSetting
                : asset('storage/' . $heroImageSetting))
            : asset('images/annapurnahimal.jpeg');
        $heroFallbackUrl = asset('images/everest.jpg');
    @endphp

    @if (!request()->hasAny(['category', 'search', 'page', 'sort']))
        <!-- ================= HERO ================= -->
        <section class="hero">
            <img src="{{ $heroImageUrl }}" alt="Trekking gear hero" class="hero-bg-img"
                onerror="this.onerror=null; this.src='{{ $heroFallbackUrl }}';">
            <div class="hero-overlay"></div>

            <div class="hero-content">
                <div class="eyebrow">{{ setting('store_eyebrow', 'Gear Up. Step Out. Explore.') }}</div>
                <h1>{{ setting('store_headline_1', 'For Every Trail.') }}<br>{{ setting('store_headline_2', 'For Every') }}
                    <span class="accent">{{ setting('store_headline_accent', 'Explorer.') }}</span>
                </h1>
                <p>{{ setting('store_subtext', 'Premium trekking & hiking gears, clothes and shoes for your next adventure.') }}
                </p>
                <a href="#shop" class="btn-primary">SHOP NOW
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.4" stroke-linecap="round">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </a>
            </div>

            <!-- Built for Adventure feature bar -->
            <div class="feature-bar">
                <div class="feature-item">
                    <span class="f-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M3 20l6-11 4 7 3-5 5 9H3z" />
                        </svg>
                    </span>
                    <div>
                        <div class="f-title">Built for Adventure</div>
                        <div class="f-sub">Durable & reliable gear</div>
                    </div>
                </div>
                <div class="feature-item">
                    <span class="f-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M5 21c9 0 14-6 14-16C10 5 5 10 5 21z" />
                            <path d="M5 21c0-6 3-10 8-12" />
                        </svg>
                    </span>
                    <div>
                        <div class="f-title">Lightweight</div>
                        <div class="f-sub">Move freely, go further</div>
                    </div>
                </div>
                <div class="feature-item">
                    <span class="f-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M12 2l8 4v6c0 5-3.5 8.5-8 10-4.5-1.5-8-5-8-10V6l8-4z" />
                            <path d="M9 12l2 2 4-4" />
                        </svg>
                    </span>
                    <div>
                        <div class="f-title">Premium Quality</div>
                        <div class="f-sub">Tested for every terrain</div>
                    </div>
                </div>
                <div class="feature-item">
                    <span class="f-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke-width="1.6" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="M3 16V7a1 1 0 011-1h10v10H4a1 1 0 01-1-1z" />
                            <path d="M14 10h4l3 3v3h-7z" />
                            <circle cx="7.5" cy="18.5" r="1.5" />
                            <circle cx="17.5" cy="18.5" r="1.5" />
                        </svg>
                    </span>
                    <div>
                        <div class="f-title">Fast Delivery</div>
                        <div class="f-sub">Across the country</div>
                    </div>
                </div>
            </div>
        </section>
    @endif

    <!-- ================= CATEGORIES ================= -->
    @if (($categories ?? collect())->count())
        <section class="section" id="categories">
            <div class="section-head">
                <div class="eyebrow">Shop By Category</div>
                <h2>Find What You Need</h2>
                <svg class="divider-icon" viewBox="0 0 46 20" fill="none" stroke="var(--ink)" stroke-width="1.4"
                    stroke-linecap="round" stroke-linejoin="round">
                    <path d="M1 18l9-13 6 8 4-5 5 6" />
                    <path d="M20 18l9-13 6 8 4-5" />
                </svg>
            </div>

            <div class="category-grid">
                @foreach ($categories as $cat)
                    <a href="{{ route('store.index', ['category' => $cat->slug]) }}#shop"
                        aria-label="Browse {{ $cat->name }}">
                        <div class="cat-card {{ $activeSlug === $cat->slug ? 'active' : '' }}">
                            <div class="cat-media">
                                <img class="cat-img"
                                    src="{{ $cat->image ? Storage::url($cat->image) : 'https://images.unsplash.com/photo-1551632811-561732d1e306?auto=format&fit=crop&w=500&q=80' }}"
                                    alt="{{ $cat->name }}" loading="lazy"
                                    onerror="this.onerror=null; this.src='{{ asset('images/category-fallback.jpg') }}';">
                            </div>
                            <div class="cat-body">
                                <div class="cat-icon">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6"
                                        stroke-linecap="round" stroke-linejoin="round">
                                        {!! $iconMap[$cat->slug] ?? $fallbackIcon !!}
                                    </svg>
                                </div>
                                <h3>{{ $cat->name }}</h3>
                                @if (isset($cat->products_count))
                                    <div class="cat-count">{{ $cat->products_count }} products</div>
                                @endif
                                <span class="cat-link">Explore Now
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="2.4" stroke-linecap="round">
                                        <path d="M5 12h14M13 6l6 6-6 6" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </a>
                @endforeach
            </div>
        </section>
    @endif

    <!-- ================= PRODUCTS ================= -->
    <section class="section" id="shop">
        <div class="picks-head">
            <div class="titles">
                <div class="eyebrow">
                    {{ $activeCategory ? 'Category' : (request('search') ? 'Search Results' : 'Best Sellers') }}</div>
                <h2>{{ $activeCategory->name ?? (request('search') ? '“' . request('search') . '”' : 'Top Picks for You') }}
                </h2>
            </div>

            <div class="toolbar-right">
                <!-- Search: press Enter or click the green button -->
                <form action="{{ route('store.index') }}#shop" method="GET" class="store-search-form" role="search">
                    @if ($activeSlug)
                        <input type="hidden" name="category" value="{{ $activeSlug }}">
                    @endif
                    @if (request('sort'))
                        <input type="hidden" name="sort" value="{{ request('sort') }}">
                    @endif
                    <input type="search" name="search" value="{{ request('search') }}"
                        placeholder="Search products..." aria-label="Search products" autocomplete="off">
                    @if (request('search'))
                        <a href="{{ route('store.index', array_filter(['category' => $activeSlug, 'sort' => request('sort')])) }}#shop"
                            class="search-clear" title="Clear search" aria-label="Clear search"><i
                                class="fas fa-times"></i></a>
                    @endif
                    <button type="submit" class="search-btn" aria-label="Search" title="Search">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4"
                            stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="11" cy="11" r="7" />
                            <path d="M21 21l-4.3-4.3" />
                        </svg>
                    </button>
                </form>

                <form action="{{ route('store.index') }}#shop" method="GET" class="store-sort"
                    onchange="this.submit()">
                    @if ($activeSlug)
                        <input type="hidden" name="category" value="{{ $activeSlug }}">
                    @endif
                    @if (request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif
                    <select name="sort" aria-label="Sort products">
                        <option value="">Sort: Featured</option>
                        <option value="price_asc" @selected(request('sort') === 'price_asc')>Price: Low to High</option>
                        <option value="price_desc" @selected(request('sort') === 'price_desc')>Price: High to Low</option>
                        <option value="newest" @selected(request('sort') === 'newest')>Newest</option>
                    </select>
                </form>

                <div class="carousel-arrows">
                    <a href="{{ $products->previousPageUrl() ? $products->previousPageUrl() . '#shop' : '#' }}"
                        class="arrow-btn {{ $products->onFirstPage() ? 'disabled' : '' }}" aria-label="Previous page">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.2" stroke-linecap="round">
                            <path d="M15 6l-6 6 6 6" />
                        </svg>
                    </a>
                    <a href="{{ $products->nextPageUrl() ? $products->nextPageUrl() . '#shop' : '#' }}"
                        class="arrow-btn {{ !$products->hasMorePages() ? 'disabled' : '' }}" aria-label="Next page">
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.2" stroke-linecap="round">
                            <path d="M9 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>

        @if ($activeCategory || request('search'))
            <div class="active-filter-chip">
                @if ($activeCategory)
                    <span>Category: <strong>{{ $activeCategory->name }}</strong></span>
                @endif
                @if (request('search'))
                    <span>Search: <strong>"{{ request('search') }}"</strong></span>
                @endif
                <a href="{{ route('store.index') }}#shop" title="Clear filters" aria-label="Clear filters"><i
                        class="fas fa-times"></i></a>
            </div>
        @endif

        <div class="product-grid">
            @if (session('success'))
                <div class="flash-success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
            @endif

            @forelse($products as $product)
                <div class="product-card">
                    <button class="wish-btn" type="button" aria-label="Add to wishlist">
                        <svg viewBox="0 0 24 24" stroke-width="2">
                            <path
                                d="M12 21s-7-4.35-10-9C-0.5 7 2 3 6 3c2 0 4 1.5 6 4 2-2.5 4-4 6-4 4 0 6.5 4 4 9-3 4.65-10 9-10 9z" />
                        </svg>
                    </button>

                    @if ($product->sale_price)
                        @php $discount = round((($product->price - $product->sale_price) / $product->price) * 100); @endphp
                        <div class="sale-badge">-{{ $discount }}%</div>
                    @endif

                    <div class="product-img-wrap">
                        @if ($product->image)
                            <img class="product-img" src="{{ Storage::url($product->image) }}"
                                alt="{{ $product->name }}" loading="lazy"
                                onerror="this.style.display='none'; this.nextElementSibling.style.display='flex';">
                            <i class="fas fa-image product-img-fallback" style="display:none;"></i>
                        @else
                            <i class="fas fa-image product-img-fallback"></i>
                        @endif
                    </div>

                    <div class="p-brand">{{ $product->category->name ?? 'GEAR' }}</div>
                    <div class="p-name">{{ $product->name }}</div>

                    @if (isset($product->average_rating))
                        <div class="p-rating">
                            <div class="stars">
                                @for ($i = 1; $i <= 5; $i++)
                                    @if ($product->average_rating >= $i)
                                        <svg class="star-fill" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z" />
                                        </svg>
                                    @elseif($product->average_rating >= $i - 0.5)
                                        <svg class="star-fill" viewBox="0 0 24 24" style="clip-path:inset(0 50% 0 0)">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z" />
                                        </svg>
                                    @else
                                        <svg class="star-empty" viewBox="0 0 24 24">
                                            <path
                                                d="M12 2l3.09 6.26L22 9.27l-5 4.87L18.18 21 12 17.27 5.82 21 7 14.14l-5-4.87 6.91-1.01L12 2z" />
                                        </svg>
                                    @endif
                                @endfor
                            </div>
                            <span>({{ $product->reviews_count ?? 0 }})</span>
                        </div>
                    @endif

                    <div class="p-footer">
                        <div class="p-price">
                            @if ($product->sale_price)
                                <span class="old-price">{{ setting('currency', 'Rs.') }}
                                    {{ number_format($product->price) }}</span>
                                {{ setting('currency', 'Rs.') }} {{ number_format($product->sale_price) }}
                            @else
                                {{ setting('currency', 'Rs.') }} {{ number_format($product->price) }}
                            @endif
                        </div>

                        @if ($product->isInStock())
                            <form action="{{ route('cart.add', $product) }}" method="POST">
                                @csrf
                                <button type="submit" class="add-cart-btn" title="Add to cart"
                                    aria-label="Add {{ $product->name }} to cart"><i
                                        class="fas fa-cart-plus"></i></button>
                            </form>
                        @else
                            <span class="out-of-stock">Out of stock</span>
                        @endif
                    </div>
                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-box-open"></i>
                    <h3>No products found</h3>
                    <p>Try adjusting your search or browsing a different category.</p>
                    <a href="{{ route('store.index') }}#shop" class="btn-reset">View all products</a>
                </div>
            @endforelse
        </div>

        @if ($products->hasPages())
            <div class="pagination-wrap">{{ $products->links() }}</div>
        @endif
    </section>

    <!-- ================= PROMO BANNERS ================= -->
    @if (!request()->hasAny(['category', 'search', 'page']))
        @php
            $promo1Setting = setting('store_promo1_image');
            $promo1Url = $promo1Setting
                ? (Str::startsWith($promo1Setting, 'http')
                    ? $promo1Setting
                    : asset('storage/' . $promo1Setting))
                : asset('images/store-promo-new-arrivals.jpg');

            $promo2Setting = setting('store_promo2_image');
            $promo2Url = $promo2Setting
                ? (Str::startsWith($promo2Setting, 'http')
                    ? $promo2Setting
                    : asset('storage/' . $promo2Setting))
                : asset('images/store-promo-rain-gear.jpg');
        @endphp
        <div class="promo-row">
            <div class="promo-card">
                <img src="{{ $promo1Url }}" alt="New Arrivals" loading="lazy"
                    onerror="this.onerror=null; this.src='{{ asset('images/store-promo-new-arrivals.jpg') }}';">
                <div class="promo-inner">
                    <h3>New Arrivals</h3>
                    <p>Latest gear for your next adventure.</p>
                    <a href="{{ route('store.index', ['sort' => 'newest']) }}#shop" class="btn-outline">EXPLORE NOW
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.4" stroke-linecap="round">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
            </div>
            <div class="promo-card">
                <img src="{{ $promo2Url }}" alt="Ready for Rain" loading="lazy"
                    onerror="this.onerror=null; this.src='{{ asset('images/store-promo-rain-gear.jpg') }}';">
                <div class="promo-inner">
                    <h3>Ready for Rain?</h3>
                    <p>Waterproof gear to keep you going.</p>
                    <a href="{{ route('store.index', ['search' => 'rain']) }}#shop" class="btn-outline">SHOP RAIN GEAR
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.4" stroke-linecap="round">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    @endif

@endsection

@push('scripts')
    <script>
        // Wishlist heart toggle
        document.querySelectorAll('.wish-btn').forEach(btn => {
            btn.addEventListener('click', e => e.currentTarget.classList.toggle('active'));
        });

        // Don't submit an empty search; focus the box instead
        document.querySelectorAll('.store-search-form').forEach(form => {
            form.addEventListener('submit', e => {
                const input = form.querySelector('input[name="search"]');
                if (input && !input.value.trim()) {
                    e.preventDefault();
                    input.focus();
                }
            });
        });
    </script>
@endpush
