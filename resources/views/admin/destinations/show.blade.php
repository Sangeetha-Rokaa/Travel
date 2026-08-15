{{-- resources/views/admin/destinations/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'View Destination - Nepal Travel')
@section('page_title', 'Destination Details')
@section('page_icon', 'fas fa-eye')

@section('content')

    <div class="container-fluid px-0">

        {{-- HERO HEADER --}}
        <div class="destination-hero-card mb-4">

            <div class="destination-hero-overlay"></div>

            @if ($destination->featured_image)
                <img src="{{ asset('storage/' . $destination->featured_image) }}" alt="{{ $destination->name }}"
                    class="destination-hero-image">
            @endif

            <div class="destination-hero-content">

                <div class="d-flex justify-content-between align-items-start flex-wrap gap-3">

                    <div>

                        <div class="d-flex align-items-center gap-2 mb-3 flex-wrap">

                            @if ($destination->is_active)
                                <span class="custom-badge success">
                                    <i class="fas fa-circle-check me-1"></i>
                                    Active
                                </span>
                            @else
                                <span class="custom-badge secondary">
                                    <i class="fas fa-circle-xmark me-1"></i>
                                    Inactive
                                </span>
                            @endif

                            @if ($destination->is_featured)
                                <span class="custom-badge warning">
                                    <i class="fas fa-star me-1"></i>
                                    Featured
                                </span>
                            @endif

                            @if ($destination->region)
                                <span class="custom-badge dark">
                                    <i class="fas fa-earth-asia me-1"></i>
                                    {{ $destination->region }}
                                </span>
                            @endif

                        </div>

                        <h1 class="hero-title">
                            {{ $destination->name }}
                        </h1>

                        <div class="hero-meta">

                            <span>
                                <i class="fas fa-location-dot"></i>
                                {{ $destination->location }}
                            </span>

                            @if ($destination->altitude)
                                <span>
                                    <i class="fas fa-mountain"></i>
                                    {{ $destination->altitude }}
                                </span>
                            @endif

                            @if ($destination->best_season)
                                <span>
                                    <i class="fas fa-calendar"></i>
                                    {{ $destination->best_season }}
                                </span>
                            @endif

                        </div>

                        <p class="hero-description">
                            {{ $destination->short_description }}
                        </p>

                    </div>

                    <div class="d-flex gap-2 flex-wrap">

                        <a href="{{ route('admin.destinations.edit', $destination) }}" class="hero-btn hero-btn-warning">

                            <i class="fas fa-pen-to-square me-2"></i>
                            Edit Destination
                        </a>

                        <a href="{{ route('admin.destinations.index') }}" class="hero-btn hero-btn-secondary">

                            <i class="fas fa-arrow-left me-2"></i>
                            Back
                        </a>

                    </div>

                </div>

            </div>

        </div>

        {{-- CONTENT --}}
        <div class="row g-4">

            {{-- MAIN CONTENT --}}
            <div class="col-lg-8">

                {{-- ABOUT --}}
                <div class="modern-card mb-4">

                    <div class="section-header">
                        <div class="section-icon">
                            <i class="fas fa-circle-info"></i>
                        </div>

                        <div>
                            <h5 class="section-title mb-1">
                                About Destination
                            </h5>

                            <p class="section-subtitle mb-0">
                                Complete destination overview and information
                            </p>
                        </div>
                    </div>

                    <div class="destination-content">
                        {!! nl2br(e($destination->description)) !!}
                    </div>

                </div>

                {{-- GALLERY --}}
                @if (!empty($destination->gallery_images))
                    <div class="modern-card">

                        <div class="section-header mb-4">

                            <div class="section-icon">
                                <i class="fas fa-images"></i>
                            </div>

                            <div>
                                <h5 class="section-title mb-1">
                                    Destination Gallery
                                </h5>

                                <p class="section-subtitle mb-0">
                                    Travel moments and destination visuals
                                </p>
                            </div>

                        </div>

                        <div class="row g-3">

                            @foreach ($destination->gallery_images as $img)
                                <div class="col-xl-4 col-md-6">

                                    <div class="gallery-card">

                                        <img src="{{ asset('storage/' . $img) }}" class="gallery-image"
                                            alt="Gallery Image">

                                        <div class="gallery-overlay">
                                            <i class="fas fa-expand"></i>
                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    </div>
                @endif

            </div>

            {{-- SIDEBAR --}}
            <div class="col-lg-4">

                {{-- QUICK DETAILS --}}
                <div class="modern-card mb-4">

                    <div class="section-header">

                        <div class="section-icon">
                            <i class="fas fa-list-check"></i>
                        </div>

                        <div>
                            <h5 class="section-title mb-1">
                                Quick Details
                            </h5>

                            <p class="section-subtitle mb-0">
                                Important destination information
                            </p>
                        </div>

                    </div>

                    <div class="details-list">

                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="fas fa-location-dot"></i>
                            </div>

                            <div>
                                <span class="detail-label">Location</span>
                                <h6 class="detail-value">
                                    {{ $destination->location }}
                                </h6>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="fas fa-earth-asia"></i>
                            </div>

                            <div>
                                <span class="detail-label">Region</span>
                                <h6 class="detail-value">
                                    {{ $destination->region ?? 'Not specified' }}
                                </h6>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="fas fa-mountain"></i>
                            </div>

                            <div>
                                <span class="detail-label">Altitude</span>
                                <h6 class="detail-value">
                                    {{ $destination->altitude ?? 'Not specified' }}
                                </h6>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="fas fa-calendar-days"></i>
                            </div>

                            <div>
                                <span class="detail-label">Best Season</span>
                                <h6 class="detail-value">
                                    {{ $destination->best_season ?? 'Not specified' }}
                                </h6>
                            </div>
                        </div>

                        <div class="detail-item">
                            <div class="detail-icon">
                                <i class="fas fa-link"></i>
                            </div>

                            <div>
                                <span class="detail-label">Slug</span>
                                <h6 class="detail-value text-break">
                                    {{ $destination->slug }}
                                </h6>
                            </div>
                        </div>

                        <div class="detail-item border-0 pb-0">
                            <div class="detail-icon">
                                <i class="fas fa-sort"></i>
                            </div>

                            <div>
                                <span class="detail-label">Sort Order</span>
                                <h6 class="detail-value">
                                    {{ $destination->sort_order }}
                                </h6>
                            </div>
                        </div>

                    </div>

                </div>

                {{-- ACTION CARD --}}
                <div class="modern-card">

                    <div class="section-header">

                        <div class="section-icon">
                            <i class="fas fa-bolt"></i>
                        </div>

                        <div>
                            <h5 class="section-title mb-1">
                                Quick Actions
                            </h5>

                            <p class="section-subtitle mb-0">
                                Manage this destination quickly
                            </p>
                        </div>

                    </div>

                    <div class="d-grid gap-3">

                        <a href="{{ route('admin.destinations.edit', $destination) }}"
                            class="action-btn action-btn-primary">

                            <i class="fas fa-pen-to-square"></i>
                            Edit Destination
                        </a>

                        <form action="{{ route('admin.destinations.destroy', $destination) }}" method="POST"
                            onsubmit="return confirm('Are you sure you want to delete this destination?')">

                            @csrf
                            @method('DELETE')

                            <button type="submit" class="action-btn action-btn-danger w-100">

                                <i class="fas fa-trash"></i>
                                Delete Destination
                            </button>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection

@push('styles')
    <style>
        .destination-hero-card {
            position: relative;
            border-radius: 32px;
            overflow: hidden;
            min-height: 420px;
            background: #1e2a2e;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.12);
        }

        .destination-hero-image {
            width: 100%;
            height: 420px;
            object-fit: cover;
        }

        .destination-hero-overlay {
            position: absolute;
            inset: 0;
            background:
                linear-gradient(to top,
                    rgba(15, 23, 42, 0.92),
                    rgba(15, 23, 42, 0.45),
                    rgba(15, 23, 42, 0.2));
            z-index: 1;
        }

        .destination-hero-content {
            position: absolute;
            inset: 0;
            z-index: 2;
            padding: 40px;
            display: flex;
            align-items: flex-end;
            color: white;
        }

        .hero-title {
            font-size: 3rem;
            font-weight: 800;
            margin-bottom: 14px;
            line-height: 1.1;
        }

        .hero-meta {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            margin-bottom: 18px;
            color: rgba(255, 255, 255, 0.9);
        }

        .hero-meta span {
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 15px;
        }

        .hero-description {
            max-width: 720px;
            color: rgba(255, 255, 255, 0.88);
            line-height: 1.7;
            margin-bottom: 0;
        }

        .hero-btn {
            border: none;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 16px;
            font-weight: 600;
            transition: all 0.25s ease;
            display: inline-flex;
            align-items: center;
        }

        .hero-btn:hover {
            transform: translateY(-2px);
        }

        .hero-btn-warning {
            background: #e9b35f;
            color: #1e2a2e;
        }

        .hero-btn-secondary {
            background: rgba(255, 255, 255, 0.15);
            color: white;
            backdrop-filter: blur(12px);
        }

        .modern-card {
            background: white;
            border-radius: 28px;
            padding: 28px;
            border: none;
            box-shadow: 0 10px 35px rgba(15, 23, 42, 0.06);
        }

        .section-header {
            display: flex;
            align-items: center;
            gap: 16px;
            margin-bottom: 24px;
        }

        .section-icon {
            width: 52px;
            height: 52px;
            border-radius: 16px;
            background: linear-gradient(135deg, #e9b35f, #f4cd8c);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #1e2a2e;
            font-size: 20px;
        }

        .section-title {
            color: #1e2a2e;
            font-weight: 700;
        }

        .section-subtitle {
            color: #7b8794;
            font-size: 14px;
        }

        .destination-content {
            color: #52606d;
            line-height: 1.9;
            font-size: 15px;
        }

        .details-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
        }

        .detail-item {
            display: flex;
            gap: 14px;
            align-items: flex-start;
            padding-bottom: 18px;
            border-bottom: 1px solid #eef2f7;
        }

        .detail-icon {
            width: 44px;
            height: 44px;
            border-radius: 14px;
            background: #f8f6f1;
            color: #e9b35f;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .detail-label {
            display: block;
            font-size: 13px;
            color: #94a3b8;
            margin-bottom: 4px;
        }

        .detail-value {
            color: #1e293b;
            font-size: 15px;
            font-weight: 700;
            margin-bottom: 0;
        }

        .gallery-card {
            position: relative;
            overflow: hidden;
            border-radius: 20px;
            cursor: pointer;
        }

        .gallery-image {
            width: 100%;
            height: 240px;
            object-fit: cover;
            transition: transform 0.4s ease;
        }

        .gallery-overlay {
            position: absolute;
            inset: 0;
            background: rgba(15, 23, 42, 0.45);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            opacity: 0;
            transition: all 0.3s ease;
            font-size: 24px;
        }

        .gallery-card:hover .gallery-overlay {
            opacity: 1;
        }

        .gallery-card:hover .gallery-image {
            transform: scale(1.06);
        }

        .custom-badge {
            padding: 8px 14px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
        }

        .custom-badge.success {
            background: rgba(34, 197, 94, 0.18);
            color: #22c55e;
        }

        .custom-badge.warning {
            background: rgba(245, 158, 11, 0.18);
            color: #f59e0b;
        }

        .custom-badge.secondary {
            background: rgba(148, 163, 184, 0.2);
            color: #cbd5e1;
        }

        .custom-badge.dark {
            background: rgba(255, 255, 255, 0.14);
            color: white;
        }

        .action-btn {
            border: none;
            border-radius: 18px;
            padding: 14px 18px;
            font-weight: 700;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.25s ease;
        }

        .action-btn:hover {
            transform: translateY(-2px);
        }

        .action-btn-primary {
            background: linear-gradient(135deg, #1e2a2e, #2c4a3e);
            color: white;
        }

        .action-btn-danger {
            background: linear-gradient(135deg, #ef4444, #dc2626);
            color: white;
        }

        @media (max-width: 768px) {

            .destination-hero-card,
            .destination-hero-image {
                min-height: 520px;
                height: 520px;
            }

            .destination-hero-content {
                padding: 24px;
            }

            .hero-title {
                font-size: 2rem;
            }

            .modern-card {
                padding: 22px;
            }

            .hero-meta {
                gap: 12px;
            }
        }
    </style>
@endpush
