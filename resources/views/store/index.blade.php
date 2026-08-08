<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Store | ApeakNepal</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link
        href="https://fonts.googleapis.com/css2?family=Cinzel:wght@400;600;700&family=Dancing+Script:wght@700&family=Open+Sans:wght@300;400;600&display=swap"
        rel="stylesheet">
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
            --shadow: 0 10px 40px rgba(0, 0, 0, 0.12);
        }

        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0 }
        html { scroll-behavior: smooth }
        body { font-family: var(--font-body); color: var(--text-dark); background: var(--white); overflow-x: hidden }
        a { text-decoration: none; color: inherit }
        ul { list-style: none }
        img { max-width: 100%; display: block }
        .container { max-width: 1280px; margin: 0 auto; padding: 0 24px }

        /* HEADER (same as homepage) */
        .site-header { position: sticky; top: 0; left: 0; right: 0; z-index: 1000; background: rgba(10, 30, 70, 0.95); backdrop-filter: blur(12px); box-shadow: 0 4px 30px rgba(0, 0, 0, 0.3) }
        .navbar { display: flex; align-items: center; justify-content: space-between; height: var(--header-height); padding: 0 32px; gap: 20px }
        .brand-link { display: flex; align-items: center; gap: 10px }
        .brand-text { display: flex; flex-direction: column }
        .brand-name { font-family: var(--font-display); font-size: 1.25rem; font-weight: 700; color: var(--white); line-height: 1 }
        .brand-tagline { font-size: 0.65rem; color: rgba(255, 255, 255, 0.7); letter-spacing: 0.05em; line-height: 1.4 }
        .navbar-nav { display: flex; align-items: center; gap: 6px; flex: 1; justify-content: center }
        .nav-item { position: relative }
        .nav-link { display: flex; align-items: center; gap: 4px; padding: 8px 14px; font-size: 0.95rem; font-weight: 600; color: rgba(255, 255, 255, 0.9); border-radius: 6px; transition: var(--transition); white-space: nowrap; cursor: pointer }
        .nav-link:hover, .nav-item.active .nav-link { color: var(--blue-light) }
        .dropdown-icon { font-size: 0.65rem; transition: transform 0.3s }
        .has-dropdown:hover .dropdown-icon { transform: rotate(180deg) }
        .dropdown-menu { position: absolute; top: calc(100% + 8px); left: 0; background: rgba(10, 28, 65, 0.97); border-radius: 10px; min-width: 180px; padding: 8px 0; box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4); opacity: 0; visibility: hidden; transform: translateY(-8px); transition: var(--transition); border: 1px solid rgba(255, 255, 255, 0.08) }
        .has-dropdown:hover .dropdown-menu { opacity: 1; visibility: visible; transform: translateY(0) }
        .dropdown-menu a { display: block; padding: 10px 20px; font-size: 0.9rem; color: rgba(255, 255, 255, 0.85); transition: var(--transition) }
        .dropdown-menu a:hover { color: var(--blue-light); background: rgba(255, 255, 255, 0.05); padding-left: 26px }
        .btn { display: inline-flex; align-items: center; gap: 8px; padding: 12px 28px; border-radius: 50px; font-weight: 700; font-size: 0.95rem; cursor: pointer; border: none; transition: var(--transition); text-decoration: none }
        .btn-primary { background: var(--blue-primary); color: var(--white) }
        .btn-primary:hover { background: var(--blue-dark); transform: translateY(-2px); box-shadow: 0 8px 24px rgba(26, 115, 232, 0.5) }
        .btn-explore { font-size: 0.9rem; padding: 10px 22px; border-radius: 50px; font-weight: 700; white-space: nowrap }
        .social-sidebar { position: fixed; right: 0; top: 50%; transform: translateY(-50%); z-index: 999; display: flex; flex-direction: column; align-items: center; gap: 10px; padding: 16px 10px; background: rgba(10, 28, 65, 0.7); backdrop-filter: blur(8px); border-radius: 12px 0 0 12px }
        .follow-text { font-size: 0.6rem; color: rgba(255, 255, 255, 0.7); letter-spacing: 0.1em; writing-mode: vertical-rl; text-transform: uppercase; margin-bottom: 4px }
        .social-icon { width: 32px; height: 32px; display: flex; align-items: center; justify-content: center; color: var(--white); border: 1px solid rgba(255, 255, 255, 0.25); border-radius: 50%; font-size: 0.8rem; transition: var(--transition) }
        .social-icon:hover { background: var(--blue-primary); border-color: var(--blue-primary) }

        /* PAGE HEADER BANNER */
        .page-banner { background: linear-gradient(rgba(8,20,46,0.75), rgba(8,20,46,0.75)), url('https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=1600&q=80') center/cover; padding: 90px 0 50px; text-align: center }
        .page-banner .section-label { color: var(--gold) }
        .page-banner h1 { font-family: var(--font-display); font-size: clamp(2.2rem, 5vw, 3.2rem); color: var(--white); margin: 10px 0 }
        .page-banner p { color: rgba(255,255,255,0.75); font-size: 0.95rem }

        /* STORE LAYOUT */
        .store-section { padding: 60px 0 90px; background: var(--bg-light) }
        .store-layout { display: grid; grid-template-columns: 240px 1fr; gap: 32px; align-items: start }

        .store-search { width: 100%; padding: 12px 16px; border-radius: 10px; border: 1px solid #e2e8f0; font-family: var(--font-body); font-size: 0.9rem; margin-bottom: 20px }
        .store-search:focus { outline: none; border-color: var(--blue-primary) }

        .store-categories { background: var(--white); border-radius: var(--radius); padding: 20px; box-shadow: var(--shadow) }
        .store-categories h4 { font-family: var(--font-display); font-size: 0.95rem; margin-bottom: 14px; color: var(--text-dark) }
        .store-categories ul { display: flex; flex-direction: column; gap: 4px }
        .store-categories a { display: block; padding: 9px 12px; border-radius: 8px; font-size: 0.88rem; color: var(--text-light); transition: var(--transition) }
        .store-categories a:hover { background: var(--bg-light); color: var(--blue-primary) }
        .store-categories a.active { background: rgba(26,115,232,0.08); color: var(--blue-primary); font-weight: 600 }

        .products-grid { display: grid; grid-template-columns: repeat(3, 1fr); gap: 24px }
        .product-card { border-radius: var(--radius); overflow: hidden; background: var(--white); box-shadow: var(--shadow); transition: var(--transition) }
        .product-card:hover { transform: translateY(-6px); box-shadow: 0 20px 60px rgba(0,0,0,0.15) }
        .product-image { position: relative; height: 200px; background: #eef2f7; display: flex; align-items: center; justify-content: center; overflow: hidden }
        .product-image img { width: 100%; height: 100%; object-fit: cover }
        .product-image i { font-size: 2.2rem; color: #cbd5e1 }
        .product-category-tag { position: absolute; top: 12px; left: 12px; background: var(--blue-primary); color: var(--white); font-size: 0.68rem; font-weight: 700; padding: 4px 10px; border-radius: 20px; letter-spacing: 0.05em }
        .product-body { padding: 18px 18px 20px }
        .product-title { font-family: var(--font-display); font-size: 1rem; font-weight: 700; color: var(--text-dark); margin-bottom: 10px; min-height: 2.4em }
        .product-footer { display: flex; align-items: center; justify-content: space-between }
        .product-price { font-family: var(--font-display); font-weight: 700; font-size: 1.05rem; color: var(--text-dark) }
        .product-price .old-price { font-size: 0.8rem; color: var(--text-light); text-decoration: line-through; font-weight: 400; margin-right: 4px }
        .add-cart-btn { width: 38px; height: 38px; border-radius: 50%; background: var(--blue-primary); color: var(--white); border: none; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: var(--transition) }
        .add-cart-btn:hover { background: var(--blue-dark); transform: scale(1.08) }
        .out-of-stock { font-size: 0.75rem; color: #dc2626; font-weight: 600 }

        .empty-state { grid-column: 1 / -1; text-align: center; padding: 70px 20px; color: var(--text-light) }
        .empty-state i { font-size: 2.5rem; margin-bottom: 14px; color: #cbd5e1 }

        .flash-success { grid-column: 1 / -1; background: #dcfce7; color: #16a34a; padding: 14px 18px; border-radius: 10px; font-size: 0.9rem; margin-bottom: 6px; font-weight: 600 }

        .pagination-wrap { margin-top: 36px; display: flex; justify-content: center }
        .pagination-wrap nav { font-family: var(--font-body) }

        /* FOOTER (same as homepage) */
        .site-footer { background: #08142e; color: var(--white) }
        .footer-top { padding: 70px 0 50px }
        .footer-grid { display: grid; grid-template-columns: 2fr 1fr 1fr 1.5fr; gap: 48px }
        .footer-logo { display: flex; align-items: center; gap: 10px; font-family: var(--font-display); font-size: 1.2rem; font-weight: 700; margin-bottom: 18px }
        .footer-desc { font-size: 0.88rem; color: rgba(255, 255, 255, 0.6); line-height: 1.75; margin-bottom: 24px }
        .footer-social { display: flex; gap: 12px }
        .footer-social-link { width: 38px; height: 38px; border: 1px solid rgba(255, 255, 255, 0.2); border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.85rem; color: rgba(255, 255, 255, 0.7); transition: var(--transition) }
        .footer-social-link:hover { background: var(--blue-primary); border-color: var(--blue-primary); color: var(--white) }
        .footer-heading { font-family: var(--font-display); font-size: 0.95rem; font-weight: 700; color: var(--white); margin-bottom: 20px; letter-spacing: 0.05em }
        .footer-links li { margin-bottom: 10px }
        .footer-links a { font-size: 0.88rem; color: rgba(255, 255, 255, 0.6); transition: var(--transition) }
        .footer-links a:hover { color: var(--blue-light); padding-left: 4px }
        .footer-contact { display: flex; flex-direction: column; gap: 14px }
        .footer-contact li { display: flex; align-items: flex-start; gap: 12px; font-size: 0.88rem; color: rgba(255, 255, 255, 0.6) }
        .footer-contact li i { color: var(--blue-light); margin-top: 2px; flex-shrink: 0 }
        .footer-bottom { border-top: 1px solid rgba(255, 255, 255, 0.08); padding: 20px 0 }
        .footer-bottom .container { display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap }
        .footer-bottom p { font-size: 0.83rem; color: rgba(255, 255, 255, 0.5) }
        .footer-bottom-links { display: flex; gap: 24px }
        .footer-bottom-links a { font-size: 0.83rem; color: rgba(255, 255, 255, 0.5); transition: var(--transition) }
        .footer-bottom-links a:hover { color: var(--blue-light) }

        @media(max-width:1100px) {
            .store-layout { grid-template-columns: 1fr }
            .products-grid { grid-template-columns: repeat(2, 1fr) }
            .footer-grid { grid-template-columns: 1fr 1fr }
        }
        @media(max-width:900px) {
            .navbar-nav, .navbar-cta { display: none }
            .social-sidebar { display: none }
        }
        @media(max-width:600px) {
            .products-grid { grid-template-columns: 1fr }
            .footer-grid { grid-template-columns: 1fr }
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <header class="site-header">
        <nav class="navbar">
            <div class="navbar-brand">
                <a href="{{ route('home') }}" class="brand-link">
                    <div class="brand-logo">
                        <svg width="40" height="40" viewBox="0 0 40 40" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <polygon points="20,2 38,32 2,32" fill="none" stroke="white" stroke-width="2.5" />
                            <polygon points="20,10 30,28 10,28" fill="white" opacity="0.6" />
                            <polygon points="20,16 26,26 14,26" fill="white" />
                        </svg>
                    </div>
                    <div class="brand-text">
                        <span class="brand-name">ApeakNepal</span>
                        <span class="brand-tagline">Dream • Explore • Discover</span>
                    </div>
                </a>
            </div>

            <ul class="navbar-nav">
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
                    <a href="{{ route('about.index') }}" class="nav-link">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact.index') }}" class="nav-link">Contact</a>
                </li>
              <li class="nav-item active">
    <a href="{{ route('store.index') }}" class="nav-link">Products</a>
</li>
<li class="nav-item has-dropdown">
    <a href="{{ route('store.index') }}" class="nav-link">
        Categories <i class="fas fa-chevron-down dropdown-icon"></i>
    </a>
    <ul class="dropdown-menu">
        @forelse ($categories as $category)
            <li>
                <a href="{{ route('store.index', ['category' => $category->slug]) }}">
                    {{ $category->name }}
                </a>
            </li>
        @empty
            <li><span style="display:block;padding:10px 20px;font-size:0.85rem;color:rgba(255,255,255,0.4);">No categories yet</span></li>
        @endforelse
    </ul>
</li>
<li class="nav-item">
    <a href="{{ route('orders.index') }}" class="nav-link">My Orders</a>
</li>
                </li>
            </ul>

            <div class="navbar-cta">
<a href="{{ route('cart.index') }}" class="btn btn-primary btn-explore">                    <i class="fas fa-shopping-cart"></i> Cart
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

    <!-- PAGE BANNER -->
    <section class="page-banner">
        <span class="section-label" style="font-size:0.78rem;font-weight:700;letter-spacing:0.18em;text-transform:uppercase;">GEAR & ESSENTIALS</span>
        <h1>Store</h1>
        <p>Everything you need for your Nepal adventure</p>
    </section>

    <!-- STORE -->
    <section class="store-section">
        <div class="container">
            <div class="store-layout">

                <!-- Sidebar -->
                <aside>
                    <form method="GET">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search products..." class="store-search">
                    </form>

                    <div class="store-categories">
                        <h4>Categories</h4>
                        <ul>
                            <li><a href="{{ route('store.index') }}" class="{{ !request('category') ? 'active' : '' }}">All Products</a></li>
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ route('store.index', ['category' => $category->slug]) }}"
                                       class="{{ request('category') === $category->slug ? 'active' : '' }}">
                                        {{ $category->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </aside>

                <!-- Products -->
                <div class="products-grid">
                    @if (session('success'))
                        <div class="flash-success">{{ session('success') }}</div>
                    @endif

                    @forelse ($products as $product)
                        <div class="product-card">
                            <div class="product-image">
                                @if ($product->image)
                                    <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                                @else
                                    <i class="fas fa-image"></i>
                                @endif
                                <span class="product-category-tag">{{ $product->category->name }}</span>
                            </div>
                            <div class="product-body">
                                <h3 class="product-title">{{ $product->name }}</h3>
                                <div class="product-footer">
                                    <div class="product-price">
                                        @if ($product->sale_price)
                                            <span class="old-price">${{ number_format($product->price, 2) }}</span>${{ number_format($product->sale_price, 2) }}
                                        @else
                                            ${{ number_format($product->price, 2) }}
                                        @endif
                                    </div>

                                    @if ($product->isInStock())
                                        <form action="{{ route('cart.add', $product) }}" method="POST">
                                            @csrf
                                            <button type="submit" class="add-cart-btn">
                                                <i class="fas fa-cart-plus"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="out-of-stock">Out of stock</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    @empty
                        <div class="empty-state">
                            <i class="fas fa-box-open"></i>
                            <p>No products found.</p>
                        </div>
                    @endforelse
                </div>
            </div>

            @if ($products->hasPages())
                <div class="pagination-wrap">
                    {{ $products->links() }}
                </div>
            @endif
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
                                <polygon points="20,2 38,32 2,32" fill="none" stroke="#4A90D9" stroke-width="2.5" />
                                <polygon points="20,10 30,28 10,28" fill="#4A90D9" opacity="0.6" />
                                <polygon points="20,16 26,26 14,26" fill="#4A90D9" />
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
                            <li><a href="{{ route('packages.index') }}">Packages</a></li>
                            <li><a href="{{ route('about.index') }}">About Us</a></li>
                            <li><a href="{{ route('contact.index') }}">Contact</a></li>
                            <li><a href="{{ route('store.index') }}">Store</a></li>
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

</body>
</html>