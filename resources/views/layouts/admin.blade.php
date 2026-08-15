<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard') — Nepal Tourism & Guide</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <script>
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        sans: ['Plus Jakarta Sans', 'sans-serif'],
                    },
                    colors: {
                        sidebar: '#0f1623',
                        'sidebar-hover': '#1a2336',
                        primary: '#3b82f6',
                        'primary-dark': '#2563eb',
                    }
                }
            }
        }
    </script>

    <style>
        * {
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background: #f1f5f9;
        }

        /* Sidebar */
        .sidebar {
            background: #0f1623;
            width: 210px;
            min-height: 100vh;
            position: fixed;
            left: 0;
            top: 0;
            bottom: 0;
            z-index: 50;
            display: flex;
            flex-direction: column;
            transition: width 0.22s ease, transform 0.22s ease;
        }

        .sidebar-logo {
            padding: 20px 20px 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.07);
        }

        .sidebar-logo .logo-icon {
            background: #3b82f6;
            border-radius: 10px;
            width: 38px;
            height: 38px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .nav-item {
            display: flex;
            align-items: center;
            gap: 11px;
            padding: 10px 18px;
            color: rgba(255, 255, 255, 0.55);
            font-size: 13.5px;
            font-weight: 500;
            border-radius: 8px;
            margin: 2px 10px;
            text-decoration: none;
            transition: all 0.18s ease;
            cursor: pointer;
        }

        .nav-item:hover {
            background: rgba(255, 255, 255, 0.07);
            color: rgba(255, 255, 255, 0.9);
        }

        .nav-item.active {
            background: #3b82f6;
            color: #fff;
        }

        .nav-item i {
            width: 18px;
            text-align: center;
            font-size: 14px;
        }

        .nav-section {
            padding: 18px 10px 6px;
        }

        /* --- Collapsible group headers (CMS / Store) --- */
        .nav-group {
            margin: 4px 0;
        }

        .nav-group-toggle {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            padding: 10px 20px;
            margin: 2px 10px;
            border-radius: 8px;
            color: rgba(255, 255, 255, 0.4);
            font-size: 11px;
            font-weight: 700;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            cursor: pointer;
            user-select: none;
            transition: all 0.18s ease;
        }

        .nav-group-toggle:hover {
            color: rgba(255, 255, 255, 0.75);
        }

        .nav-group-toggle .group-label {
            display: flex;
            align-items: center;
            gap: 9px;
        }

        .nav-group-toggle .group-label i.group-icon {
            font-size: 12px;
            width: 14px;
            text-align: center;
            color: #3b82f6;
        }

        .nav-group-toggle .chevron {
            font-size: 10px;
            transition: transform 0.22s ease;
            color: rgba(255, 255, 255, 0.35);
        }

        .nav-group.open .nav-group-toggle .chevron {
            transform: rotate(90deg);
        }

        .nav-group-items {
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.28s ease;
        }

        .nav-group.open .nav-group-items {
            max-height: 600px;
        }

        .nav-group-items .nav-item {
            padding-left: 26px;
            font-size: 13px;
        }

        .nav-group-items .nav-item i {
            font-size: 12px;
        }

        /* Collapsed (icon-only) sidebar state */
        .sidebar.collapsed {
            width: 68px;
        }

        .sidebar.collapsed .sidebar-logo .brand-text,
        .sidebar.collapsed .nav-item span,
        .sidebar.collapsed .nav-group-toggle .group-label span,
        .sidebar.collapsed .nav-group-toggle .chevron {
            display: none;
        }

        .sidebar.collapsed .nav-group-items {
            max-height: none;
            position: static;
        }

        .sidebar.collapsed .nav-group:not(.pinned-open) .nav-group-items {
            max-height: 0;
        }

        .sidebar.collapsed .nav-item,
        .sidebar.collapsed .nav-group-toggle {
            justify-content: center;
            padding-left: 0;
            padding-right: 0;
        }

        .sidebar.collapsed .nav-group-items .nav-item {
            padding-left: 0;
        }

        .sidebar.collapsed .sidebar-logo {
            padding: 20px 14px 16px;
            display: flex;
            justify-content: center;
        }

        .sidebar.collapsed~.main-content,
        body.sidebar-collapsed .main-content {
            margin-left: 68px;
        }

        /* Main Content */
        .main-content {
            margin-left: 210px;
            min-height: 100vh;
            transition: margin-left 0.22s ease;
        }

        /* Topbar */
        .topbar {
            background: #fff;
            border-bottom: 1px solid #e8edf3;
            padding: 14px 28px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 40;
        }

        /* Stat Card */
        .stat-card {
            background: #fff;
            border-radius: 14px;
            padding: 22px 22px 18px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        .stat-icon {
            width: 44px;
            height: 44px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 18px;
        }

        /* Chart Cards */
        .chart-card {
            background: #fff;
            border-radius: 14px;
            padding: 22px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        }

        /* Table / Bookings */
        .booking-row {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 11px 0;
            border-bottom: 1px solid #f3f6fa;
        }

        .booking-row:last-child {
            border-bottom: none;
        }

        .avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
            background: #e2e8f0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            font-weight: 600;
            color: #64748b;
            flex-shrink: 0;
        }

        .badge {
            font-size: 11px;
            font-weight: 600;
            padding: 3px 9px;
            border-radius: 20px;
        }

        .badge-confirmed {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-pending {
            background: #fef9c3;
            color: #ca8a04;
        }

        .badge-cancelled {
            background: #fee2e2;
            color: #dc2626;
        }

        .badge-completed {
            background: #e0f2fe;
            color: #0284c7;
        }

        /* Progress bar */
        .progress-bar-bg {
            background: #e8edf3;
            border-radius: 99px;
            height: 8px;
            flex: 1;
        }

        .progress-bar-fill {
            background: #3b82f6;
            height: 8px;
            border-radius: 99px;
            transition: width 0.6s ease;
        }

        /* Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: transparent;
        }

        ::-webkit-scrollbar-thumb {
            background: #cbd5e1;
            border-radius: 3px;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .sidebar {
                transform: translateX(-100%);
            }

            .sidebar.mobile-open {
                transform: translateX(0);
            }

            .main-content {
                margin-left: 0 !important;
            }

            .sidebar-overlay {
                display: none;
                position: fixed;
                inset: 0;
                background: rgba(15, 22, 35, 0.5);
                z-index: 45;
            }

            .sidebar-overlay.show {
                display: block;
            }
        }

        @media (min-width: 1025px) {
            .sidebar-overlay {
                display: none !important;
            }
        }
    </style>

    @stack('styles')
</head>

<body class="bg-slate-100">

    <!-- Mobile overlay -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <!-- Logo -->
        <div class="sidebar-logo">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">

                <div class="logo-icon">
                    @php
                        $logo = setting('site_logo');
                        $logoUrl = $logo ? (Str::startsWith($logo, 'http') ? $logo : asset('storage/' . $logo)) : null;
                    @endphp

                    @if ($logoUrl)
                        <img src="{{ $logoUrl }}" alt="{{ setting('site_name', 'Admin') }}" class="h-10 w-auto"
                            onerror="this.style.display='none';this.nextElementSibling.style.display='flex';">
                        <i class="fas fa-mountain" style="display:none;color:#fff;font-size:22px;"></i>
                    @else
                        <i class="fas fa-mountain" style="color:#fff;font-size:22px;"></i>
                    @endif
                </div>

                <div class="brand-text">
                    <div class="text-white font-bold text-sm leading-tight">
                        {{ setting('site_name', 'Apex Nepal') }}
                    </div>
                    <div class="text-blue-400 text-xs font-medium">
                        {{ setting('tagline', 'Tourism & Guide') }}
                    </div>
                </div>

            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 py-4 overflow-y-auto">

            {{-- Dashboard (always visible, top-level) --}}
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" title="Dashboard">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>

            <a href="{{ route('admin.bookings.index') }}"
                class="nav-item {{ request()->routeIs('admin.bookings.index*') ? 'active' : '' }}" title="Bookings">
                <i class="far fa-calendar-check"></i>
                <span>Bookings</span>
            </a>

            {{-- CMS GROUP --}}
            @php
                $cmsActive =
                    request()->routeIs('admin.packages*') ||
                    request()->routeIs('admin.destinations*') ||
                    request()->routeIs('admin.treks*') ||
                    request()->routeIs('admin.testimonials*') ||
                    request()->routeIs('admin.contacts*');
            @endphp

            <div class="nav-group {{ $cmsActive ? 'open pinned-open' : '' }}" data-group="cms">
                <div class="nav-group-toggle" data-toggle="cms" title="Content (CMS)">
                    <span class="group-label">
                        <i class="fas fa-layer-group group-icon"></i>
                        <span>Content (CMS)</span>
                    </span>
                    <i class="fas fa-chevron-right chevron"></i>
                </div>

                <div class="nav-group-items">
                    <a href="{{ route('admin.destinations.index') }}"
                        class="nav-item {{ request()->routeIs('admin.destinations*') ? 'active' : '' }}"
                        title="Destinations">
                        <i class="fas fa-map-marker-alt"></i>
                        <span>Destinations</span>
                    </a>
                    <a href="{{ route('admin.treks.index') }}"
                        class="nav-item {{ request()->routeIs('admin.trekking*') ? 'active' : '' }}" title="Trekking">
                        <i class="fas fa-hiking"></i>
                        <span>Trekking</span>
                    </a>
                    <a href="{{ route('admin.packages.index') }}"
                        class="nav-item {{ request()->routeIs('admin.packages*') ? 'active' : '' }}" title="Packages">
                        <i class="fas fa-box-open"></i>
                        <span>Packages</span>
                    </a>
                    <a href="{{ route('admin.testimonials.index') }}"
                        class="nav-item {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}"
                        title="Testimonials">
                        <i class="far fa-comment-dots"></i>
                        <span>Testimonials</span>
                    </a>
                    <a href="{{ route('admin.contacts.index') }}"
                        class="nav-item {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}" title="Enquiries">
                        <i class="far fa-envelope"></i>
                        <span>Enquiries</span>
                    </a>
                </div>
            </div>

            {{-- STORE / E-COMMERCE GROUP --}}
            @php
                $storeActive =
                    request()->routeIs('admin.categories*') ||
                    request()->routeIs('admin.products*') ||
                    request()->routeIs('admin.orders*') ||
                    request()->routeIs('admin.cart*');
            @endphp

            <div class="nav-group {{ $storeActive ? 'open pinned-open' : '' }}" data-group="store">
                <div class="nav-group-toggle" data-toggle="store" title="Store">
                    <span class="group-label">
                        <i class="fas fa-store group-icon"></i>
                        <span>Store</span>
                    </span>
                    <i class="fas fa-chevron-right chevron"></i>
                </div>

                <div class="nav-group-items">
                    <a href="{{ route('admin.categories.index') }}"
                        class="nav-item {{ request()->routeIs('admin.categories*') ? 'active' : '' }}"
                        title="Category">
                        <i class="fas fa-tags"></i>
                        <span>Category</span>
                    </a>
                    <a href="{{ route('admin.products.index') }}"
                        class="nav-item {{ request()->routeIs('admin.products*') ? 'active' : '' }}" title="Products">
                        <i class="fas fa-box"></i>
                        <span>Products</span>
                    </a>
                    <a href="{{ route('admin.orders.index') }}"
                        class="nav-item {{ request()->routeIs('admin.orders*') ? 'active' : '' }}" title="Orders">
                        <i class="fas fa-receipt"></i>
                        <span>Orders</span>
                    </a>
                    <a href="{{ route('admin.cart.index') }}"
                        class="nav-item {{ request()->routeIs('admin.cart*') ? 'active' : '' }}" title="Carts">
                        <i class="fas fa-shopping-cart"></i>
                        <span>Carts</span>
                    </a>
                </div>
            </div>

            <div class="nav-section"></div>

            <a href="#" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}" title="Users">
                <i class="far fa-user"></i>
                <span>Users</span>
            </a>
            <a href="{{ route('admin.settings.index') }}"
                class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}" title="Settings">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
            <a href="{{ route('admin.email.index') }}"
                class="nav-item {{ request()->routeIs('admin.email*') ? 'active' : '' }}" title="Email Config">
                <i class="fas fa-envelope-open-text"></i>
                <span>Email Config</span>
            </a>
        </nav>

        <!-- Logout -->
        {{-- <div class="p-4 border-t border-white/10">
            <form method="POST" action="{{ route('admin.logout') }}">
                @csrf
                <button type="submit" class="nav-item w-full text-left" style="margin:0;">
                    <i class="fas fa-sign-out-alt"></i>
                    <span>Log Out</span>
                </button>
            </form>
        </div> --}}
    </aside>

    <!-- Main Content -->
    <div class="main-content" id="mainContent">
        <!-- Topbar -->
        <header class="topbar">
            <div class="flex items-center gap-3">
                <button class="text-slate-500 hover:text-slate-800 transition" id="sidebarToggle">
                    <i class="fas fa-bars text-lg"></i>
                </button>
                <h1 class="text-slate-800 font-bold text-xl">@yield('page-title', 'Dashboard')</h1>
            </div>
            <div class="flex items-center gap-4">
                <!-- Date Range -->
                @yield('topbar-extras')

                <!-- Notifications -->
                <button class="relative text-slate-400 hover:text-slate-700 transition">
                    <i class="far fa-bell text-lg"></i>
                    <span
                        class="absolute -top-1 -right-1 w-4 h-4 bg-red-500 rounded-full text-white text-xs flex items-center justify-center">3</span>
                </button>

                <!-- Admin Profile -->
                <div class="flex items-center gap-2 cursor-pointer">
                    <img src="https://ui-avatars.com/api/?name=Admin&background=3b82f6&color=fff&size=36"
                        class="w-9 h-9 rounded-full" alt="Admin">
                    <div class="text-right">
                        <div class="text-sm font-semibold text-slate-800 leading-tight">Admin</div>
                        <div class="text-xs text-slate-400">Super Admin</div>
                    </div>
                    <i class="fas fa-chevron-down text-slate-400 text-xs ml-1"></i>
                </div>
            </div>
        </header>

        <!-- Page Content -->
        <main class="p-7">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script>
        const sidebar = document.getElementById('sidebar');
        const mainContent = document.getElementById('mainContent');
        const overlay = document.getElementById('sidebarOverlay');
        const isDesktop = () => window.matchMedia('(min-width: 1025px)').matches;

        // Sidebar toggle: collapse (desktop) vs slide-in/out (mobile)
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            if (isDesktop()) {
                sidebar.classList.toggle('collapsed');
                document.body.classList.toggle('sidebar-collapsed');
                localStorage.setItem('admin_sidebar_collapsed', sidebar.classList.contains('collapsed') ? '1' :
                '0');
            } else {
                sidebar.classList.toggle('mobile-open');
                overlay.classList.toggle('show');
            }
        });

        overlay?.addEventListener('click', function() {
            sidebar.classList.remove('mobile-open');
            overlay.classList.remove('show');
        });

        // Restore collapsed state on desktop
        if (isDesktop() && localStorage.getItem('admin_sidebar_collapsed') === '1') {
            sidebar.classList.add('collapsed');
            document.body.classList.add('sidebar-collapsed');
        }

        // Collapsible nav groups (CMS / Store)
        document.querySelectorAll('.nav-group-toggle').forEach(function(toggle) {
            toggle.addEventListener('click', function() {
                const group = toggle.closest('.nav-group');

                // If sidebar is icon-collapsed on desktop, expand sidebar first
                if (sidebar.classList.contains('collapsed')) {
                    sidebar.classList.remove('collapsed');
                    document.body.classList.remove('sidebar-collapsed');
                    localStorage.setItem('admin_sidebar_collapsed', '0');
                    group.classList.add('open');
                    return;
                }

                group.classList.toggle('open');
            });
        });
    </script>

    @stack('scripts')
</body>

</html>
