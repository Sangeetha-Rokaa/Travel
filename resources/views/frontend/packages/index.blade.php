@extends('layouts.frontend')

@section('title', 'Packages – Visit Nepal')

@section('content')
    <div class="packages-wrapper">

        {{-- HERO HEADER --}}
        <div class="packages-header">
            <h1>Travel Packages</h1>
            <p>Discover carefully curated Nepal travel experiences</p>
        </div>

        {{-- PACKAGES GRID --}}
        <div class="packages-grid">
            @forelse ($packages as $package)
                <div class="package-card">
                    <div class="package-image">
                        <img src="{{ $package['img'] }}" alt="{{ $package['name'] }}">
                        <div class="overlay"></div>
                        <div class="badge">
                            Best Deal
                        </div>
                    </div>

                    <div class="package-content">
                        <h3>{{ $package['name'] }}</h3>

                        <div class="meta">
                            <span>
                                <i class="fas fa-clock"></i>
                                {{ $package['days'] }} Days
                            </span>
                            <span>
                                <i class="fas fa-map-marker-alt"></i>
                                Nepal
                            </span>
                        </div>

                        <div class="footer">
                            <a href="{{ route('packages.show', $package['slug']) }}" class="view-btn">
                                View Details →
                            </a>
                        </div>
                    </div>
                </div>
            @empty
                <div class="empty">
                    No packages available at the moment.
                </div>
            @endforelse
        </div>
    </div>
@endsection

@push('styles')
    <style>
        .packages-wrapper {
            max-width: 1400px;
            margin: auto;
            padding: 80px 20px;
            position: relative;
            min-height: 100vh;

            /* Premium Background Image */
            background-image: linear-gradient(rgba(0, 0, 0, 0.75), rgba(0, 0, 0, 0.55)),
                url('https://images.unsplash.com/photo-1536240474400-b6c5a6a7b9c7?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=2070&q=80');
            background-size: cover;
            background-position: center 40%;
            background-attachment: fixed;
            background-repeat: no-repeat;
        }

        /* Overlay effect */
        .packages-wrapper::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: linear-gradient(135deg, rgba(0, 0, 0, 0.2) 0%, rgba(0, 0, 0, 0.1) 100%);
            z-index: 0;
            pointer-events: none;
        }

        .packages-header,
        .packages-grid {
            position: relative;
            z-index: 2;
        }

        /* Hero Header */
        .packages-header {
            text-align: center;
            margin-bottom: 60px;
            animation: fadeInUp 0.8s ease-out;
        }

        .packages-header h1 {
            font-size: 3.5rem;
            font-weight: 800;
            background: linear-gradient(135deg, #FFFFFF 0%, #FFD700 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 15px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .packages-header p {
            color: #f0f0f0;
            margin-top: 10px;
            font-size: 1.2rem;
            font-weight: 400;
            text-shadow: 1px 1px 2px rgba(0, 0, 0, 0.5);
        }

        /* Packages Grid */
        .packages-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
            gap: 30px;
        }

        /* Package Card */
        .package-card {
            background: rgba(255, 255, 255, 0.98);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            transition: all 0.4s cubic-bezier(0.175, 0.885, 0.32, 1.275);
            backdrop-filter: blur(0px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            animation: fadeIn 0.6s ease-out;
            animation-fill-mode: both;
        }

        .package-card:hover {
            transform: translateY(-12px);
            box-shadow: 0 25px 40px rgba(0, 0, 0, 0.3);
            background: white;
        }

        /* Staggered animations */
        .package-card:nth-child(1) {
            animation-delay: 0.1s;
        }

        .package-card:nth-child(2) {
            animation-delay: 0.2s;
        }

        .package-card:nth-child(3) {
            animation-delay: 0.3s;
        }

        .package-card:nth-child(4) {
            animation-delay: 0.4s;
        }

        .package-card:nth-child(5) {
            animation-delay: 0.5s;
        }

        .package-card:nth-child(6) {
            animation-delay: 0.6s;
        }

        /* Package Image */
        .package-image {
            position: relative;
            height: 240px;
            overflow: hidden;
        }

        .package-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.25, 0.46, 0.45, 0.94);
        }

        .package-card:hover .package-image img {
            transform: scale(1.15);
        }

        .overlay {
            position: absolute;
            inset: 0;
            background: linear-gradient(to top, rgba(0, 0, 0, 0.6), transparent 60%);
        }

        /* Badge */
        .badge {
            position: absolute;
            top: 15px;
            left: 15px;
            background: linear-gradient(135deg, #FFD700, #FFA500);
            color: #000;
            padding: 6px 14px;
            font-size: 12px;
            border-radius: 25px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
            z-index: 2;
        }

        /* Package Content */
        .package-content {
            padding: 20px;
        }

        .package-content h3 {
            font-size: 1.35rem;
            font-weight: 800;
            color: #1e293b;
            margin-bottom: 12px;
            transition: color 0.3s;
        }

        .package-card:hover .package-content h3 {
            color: #2563eb;
        }

        /* Meta Info */
        .meta {
            display: flex;
            gap: 15px;
            font-size: 13px;
            color: #475569;
            margin-top: 10px;
            padding-bottom: 15px;
            border-bottom: 1px solid #e2e8f0;
        }

        .meta span {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .meta i {
            color: #f59e0b;
            font-size: 14px;
        }

        /* Footer */
        .footer {
            margin-top: 18px;
        }

        .view-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-size: 14px;
            font-weight: 700;
            color: #2563eb;
            text-decoration: none;
            transition: all 0.3s;
            padding: 8px 0;
        }

        .view-btn:hover {
            transform: translateX(5px);
            color: #1d4ed8;
        }

        .view-btn::after {
            content: '→';
            transition: transform 0.3s;
        }

        .view-btn:hover::after {
            transform: translateX(3px);
        }

        /* Empty State */
        .empty {
            text-align: center;
            color: white;
            grid-column: 1 / -1;
            padding: 60px;
            background: rgba(0, 0, 0, 0.6);
            border-radius: 20px;
            font-size: 1.2rem;
        }

        /* Animations */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .packages-wrapper {
                padding: 50px 15px;
                background-attachment: scroll;
            }

            .packages-header h1 {
                font-size: 2.2rem;
            }

            .packages-header p {
                font-size: 1rem;
            }

            .packages-grid {
                gap: 20px;
                grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            }

            .package-image {
                height: 200px;
            }
        }

        @media (max-width: 480px) {
            .packages-header h1 {
                font-size: 1.8rem;
            }

            .package-content h3 {
                font-size: 1.2rem;
            }
        }

        /* Scrollbar Styling */
        ::-webkit-scrollbar {
            width: 10px;
        }

        ::-webkit-scrollbar-track {
            background: #f1f1f1;
        }

        ::-webkit-scrollbar-thumb {
            background: linear-gradient(135deg, #FFD700, #FFA500);
            border-radius: 5px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: linear-gradient(135deg, #FFA500, #FF8C00);
        }
    </style>
@endpush
