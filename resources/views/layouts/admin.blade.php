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

        /* Main Content */
        .main-content {
            margin-left: 210px;
            min-height: 100vh;
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
    </style>

    @stack('styles')
</head>

<body class="bg-slate-100">

    <!-- Sidebar -->
    <aside class="sidebar">
        <!-- Logo -->
        <div class="sidebar-logo">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="logo-icon">
                    <i class="fas fa-mountain text-white text-base"></i>
                </div>
                <div>
                    <div class="text-white font-bold text-sm leading-tight">Nepal</div>
                    <div class="text-blue-400 text-xs font-medium">Tourism & Guide</div>
                </div>
            </a>
        </div>

        <!-- Navigation -->
        <nav class="flex-1 py-4 overflow-y-auto">
            <a href="{{ route('admin.dashboard') }}"
                class="nav-item {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                <i class="fas fa-th-large"></i>
                <span>Dashboard</span>
            </a>
            <a href="{{ route('admin.bookings.index') }}"
                class="nav-item {{ request()->routeIs('admin.bookings.index*') ? 'active' : '' }}">
                <i class="far fa-calendar-check"></i>
                <span>Bookings</span>
            </a>
            <a href="{{ route('admin.packages.index') }}"
                class="nav-item {{ request()->routeIs('admin.packages*') ? 'active' : '' }}">
                <i class="fas fa-box-open"></i>
                <span>Packages</span>
            </a>
            <a href="{{ route('admin.destinations.index') }}"
                class="nav-item {{ request()->routeIs('admin.destinations*') ? 'active' : '' }}">
                <i class="fas fa-map-marker-alt"></i>
                <span>Destinations</span>
            </a>
            <a href="{{ route('admin.treks.index') }}"
                class="nav-item {{ request()->routeIs('admin.trekking*') ? 'active' : '' }}">
                <i class="fas fa-hiking"></i>
                <span>Trekking</span>
            </a>
            <a href="{{ route('admin.testimonials.index') }}"
                class="nav-item {{ request()->routeIs('admin.testimonials*') ? 'active' : '' }}">
                <i class="far fa-comment-dots"></i>
                <span>Testimonials</span>
            </a>
            <a href="{{ route('admin.contacts.index') }}"
                class="nav-item {{ request()->routeIs('admin.contacts*') ? 'active' : '' }}">
                <i class="far fa-address-book"></i>
                <span>Contacts</span>
            </a>
            <a href="#" class="nav-item {{ request()->routeIs('admin.users*') ? 'active' : '' }}">
                <i class="far fa-user"></i>
                <span>Users</span>
            </a>
            <a href="#" class="nav-item {{ request()->routeIs('admin.enquiries*') ? 'active' : '' }}">
                <i class="far fa-envelope"></i>
                <span>Enquiries</span>
            </a>
            <a href="{{ route('admin.settings.index') }}"
                class="nav-item {{ request()->routeIs('admin.settings*') ? 'active' : '' }}">
                <i class="fas fa-cog"></i>
                <span>Settings</span>
            </a>
            <a href="{{ route('admin.email.index') }}"
                class="nav-item {{ request()->routeIs('admin.email*') ? 'active' : '' }}">
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
    <div class="main-content">
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
        // Sidebar toggle for mobile
        document.getElementById('sidebarToggle')?.addEventListener('click', function() {
            document.querySelector('.sidebar').classList.toggle('-translate-x-full');
        });
    </script>

    @stack('scripts')
</body>

</html>
