{{-- resources/views/admin/destinations/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Destinations')
@section('page-title', 'Destinations')

@push('styles')
    <style>
        /* ── Animations ── */
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(16px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .anim {
            animation: fadeSlideUp .4s ease both;
        }

        .anim:nth-child(1) {
            animation-delay: .04s;
        }

        .anim:nth-child(2) {
            animation-delay: .09s;
        }

        .anim:nth-child(3) {
            animation-delay: .14s;
        }

        .anim:nth-child(4) {
            animation-delay: .19s;
        }

        .anim:nth-child(5) {
            animation-delay: .24s;
        }

        .anim:nth-child(6) {
            animation-delay: .29s;
        }

        /* ── Page header ── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 28px;
        }

        .page-title-text {
            font-size: 22px;
            font-weight: 800;
            color: #1e293b;
            margin: 0;
        }

        .btn-add-dest {
            background: #3b82f6;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 10px 22px;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: background .2s, transform .15s, box-shadow .2s;
            box-shadow: 0 4px 14px rgba(59, 130, 246, .3);
        }

        .btn-add-dest:hover {
            background: #2563eb;
            color: #fff;
            transform: translateY(-1px);
            box-shadow: 0 6px 18px rgba(59, 130, 246, .38);
        }

        /* ── Photo Cards Grid ── */
        .dest-cards-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .dest-card {
            background: #fff;
            border-radius: 16px;
            overflow: hidden;
            border: 1px solid #f0f4f8;
            box-shadow: 0 2px 8px rgba(0, 0, 0, .06);
            cursor: pointer;
            transition: transform .22s ease, box-shadow .22s ease;
            text-decoration: none;
            display: block;
        }

        .dest-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, .12);
        }

        .dest-card-img-wrap {
            width: 100%;
            aspect-ratio: 4/3;
            overflow: hidden;
            position: relative;
            background: #e2e8f0;
        }

        .dest-card-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .3s ease;
        }

        .dest-card:hover .dest-card-img-wrap img {
            transform: scale(1.05);
        }

        .dest-card-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 32px;
            color: #3b82f6;
        }

        .dest-card-body {
            padding: 14px 16px 16px;
        }

        .dest-card-name {
            font-size: 15px;
            font-weight: 800;
            color: #1e293b;
            margin: 0 0 4px;
            line-height: 1.2;
        }

        .dest-card-location {
            font-size: 12.5px;
            color: #94a3b8;
            font-weight: 500;
            margin: 0;
        }

        .dest-card-badges {
            display: flex;
            gap: 5px;
            flex-wrap: wrap;
            margin-top: 8px;
        }

        .card-badge-featured {
            background: #fef9c3;
            color: #92400e;
            font-size: 10.5px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }

        .card-badge-inactive {
            background: #f1f5f9;
            color: #64748b;
            font-size: 10.5px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            gap: 3px;
        }

        /* ── Filter bar ── */
        .filter-card {
            background: #fff;
            border-radius: 14px;
            padding: 18px 20px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .04);
            margin-bottom: 20px;
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1fr 1fr 1fr auto auto;
            gap: 12px;
            align-items: end;
        }

        .filter-lbl {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .5px;
            display: block;
            margin-bottom: 6px;
        }

        .search-wrap {
            position: relative;
        }

        .search-wrap .si {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 12px;
            pointer-events: none;
        }

        .search-wrap input {
            padding-left: 36px;
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13.5px;
            height: 40px;
            color: #1e293b;
            width: 100%;
            outline: none;
            transition: border-color .2s, box-shadow .2s;
            font-family: inherit;
        }

        .search-wrap input:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .1);
        }

        .filter-select {
            border: 1px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13.5px;
            height: 40px;
            color: #1e293b;
            padding: 0 32px 0 14px;
            width: 100%;
            outline: none;
            background: #fff url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E") no-repeat right 12px center;
            appearance: none;
            cursor: pointer;
            transition: border-color .2s;
            font-family: inherit;
        }

        .filter-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, .1);
        }

        .btn-filter {
            background: #0f1623;
            color: #fff;
            border: none;
            border-radius: 10px;
            height: 40px;
            padding: 0 20px;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: background .2s, transform .15s;
            white-space: nowrap;
            font-family: inherit;
        }

        .btn-filter:hover {
            background: #1e3a5f;
            transform: translateY(-1px);
        }

        .btn-reset {
            background: #f1f5f9;
            color: #64748b;
            border: none;
            border-radius: 10px;
            height: 40px;
            padding: 0 16px;
            font-size: 13.5px;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: background .2s;
            text-decoration: none;
            font-family: inherit;
        }

        .btn-reset:hover {
            background: #e2e8f0;
            color: #475569;
        }

        /* ── Alert ── */
        .alert-box {
            border-radius: 12px;
            padding: 13px 18px;
            font-size: 13.5px;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
            position: relative;
        }

        .alert-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            border-left: 4px solid #16a34a;
            color: #166534;
        }

        .alert-error {
            background: #fff1f2;
            border: 1px solid #fecdd3;
            border-left: 4px solid #dc2626;
            color: #991b1b;
        }

        .alert-close-btn {
            position: absolute;
            right: 14px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            font-size: 17px;
            opacity: .55;
            line-height: 1;
        }

        .alert-close-btn:hover {
            opacity: 1;
        }

        /* ── Table Card ── */
        .table-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 4px rgba(0, 0, 0, .05);
            overflow: hidden;
        }

        .table-card-header {
            padding: 16px 22px;
            border-bottom: 1px solid #f3f6fa;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 10px;
        }

        /* ── Table ── */
        .dest-table {
            width: 100%;
            border-collapse: collapse;
        }

        .dest-table thead tr {
            background: #f8fafc;
            border-bottom: 2px solid #e8edf3;
        }

        .dest-table thead th {
            padding: 13px 16px;
            font-size: 11.5px;
            font-weight: 700;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .6px;
            white-space: nowrap;
        }

        .dest-table thead th:first-child {
            padding-left: 22px;
        }

        .dest-table thead th:last-child {
            padding-right: 22px;
            text-align: center;
        }

        .dest-table tbody tr {
            border-bottom: 1px solid #f3f6fa;
            transition: background .18s;
        }

        .dest-table tbody tr:last-child {
            border-bottom: none;
        }

        .dest-table tbody tr:hover {
            background: #fafcff;
        }

        .dest-table tbody td {
            padding: 14px 16px;
            font-size: 13.5px;
            color: #374151;
            vertical-align: middle;
        }

        .dest-table tbody td:first-child {
            padding-left: 22px;
        }

        .dest-table tbody td:last-child {
            padding-right: 22px;
        }

        /* ── Table image thumb ── */
        .dest-thumb {
            width: 52px;
            height: 40px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #e2e8f0;
            display: block;
        }

        .dest-thumb-placeholder {
            width: 52px;
            height: 40px;
            border-radius: 10px;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #3b82f6;
            font-size: 16px;
            border: 2px solid #e2e8f0;
        }

        /* ── Dest name cell ── */
        .dest-name {
            font-weight: 700;
            color: #1e293b;
            font-size: 14px;
            display: block;
        }

        .dest-slug {
            color: #94a3b8;
            font-size: 11.5px;
            margin-top: 2px;
            display: block;
        }

        /* ── Location / Region badge ── */
        .loc-badge {
            background: #eff6ff;
            color: #2563eb;
            border-radius: 8px;
            padding: 4px 10px;
            font-size: 11.5px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            white-space: nowrap;
        }

        .region-badge {
            background: #f1f5f9;
            color: #475569;
            border-radius: 8px;
            padding: 4px 10px;
            font-size: 11.5px;
            font-weight: 600;
            white-space: nowrap;
            display: inline-block;
        }

        /* ── Status badges ── */
        .status-badge {
            border-radius: 20px;
            padding: 4px 13px;
            font-size: 11.5px;
            font-weight: 700;
            display: inline-block;
            white-space: nowrap;
        }

        .s-active {
            background: #dcfce7;
            color: #16a34a;
        }

        .s-inactive {
            background: #f1f5f9;
            color: #64748b;
        }

        .s-featured {
            background: #fef9c3;
            color: #92400e;
        }

        /* ── Trek count badge ── */
        .trek-count {
            background: #e0f2fe;
            color: #0284c7;
            border-radius: 8px;
            padding: 4px 12px;
            font-size: 12px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 5px;
        }

        /* ── Action buttons ── */
        .action-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            transition: transform .15s, box-shadow .15s;
            text-decoration: none;
        }

        .action-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, .12);
        }

        .ab-view {
            background: #e0f2fe;
            color: #0284c7;
        }

        .ab-edit {
            background: #fef9c3;
            color: #92400e;
        }

        .ab-delete {
            background: #fee2e2;
            color: #dc2626;
            border: none;
        }

        /* ── Dots menu ── */
        .dots-menu-wrap {
            position: relative;
            display: inline-block;
        }

        .dots-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 15px;
            color: #64748b;
            transition: background .15s;
        }

        .dots-btn:hover {
            background: #e2e8f0;
        }

        .dots-dropdown {
            position: absolute;
            right: 0;
            top: 38px;
            z-index: 100;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, .12);
            min-width: 150px;
            padding: 6px;
            display: none;
        }

        .dots-dropdown.open {
            display: block;
        }

        .dots-dropdown a,
        .dots-dropdown button {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 12px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            color: #374151;
            text-decoration: none;
            border: none;
            background: none;
            width: 100%;
            cursor: pointer;
            transition: background .15s;
            font-family: inherit;
        }

        .dots-dropdown a:hover,
        .dots-dropdown button:hover {
            background: #f8fafc;
        }

        .dots-dropdown .dd-delete {
            color: #dc2626;
        }

        .dots-dropdown .dd-delete:hover {
            background: #fff1f2;
        }

        .dots-divider {
            height: 1px;
            background: #f3f6fa;
            margin: 4px 0;
        }

        /* ── Empty state ── */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
        }

        .empty-icon {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            font-size: 28px;
            color: #94a3b8;
        }

        /* ── Pagination ── */
        .pagination-wrap {
            background: #fff;
            border-radius: 12px;
            border: 1px solid #f0f4f8;
            padding: 14px 20px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 12px;
            margin-top: 18px;
            box-shadow: 0 1px 3px rgba(0, 0, 0, .04);
        }

        /* ── Delete modal ── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 22, 35, .55);
            z-index: 1000;
            display: none;
            align-items: center;
            justify-content: center;
            backdrop-filter: blur(2px);
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal-box {
            background: #fff;
            border-radius: 20px;
            width: 92%;
            max-width: 440px;
            padding: 30px;
            box-shadow: 0 20px 60px rgba(0, 0, 0, .2);
            animation: fadeSlideUp .25s ease;
        }

        .modal-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #fee2e2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #dc2626;
            margin: 0 auto 18px;
        }

        .modal-title {
            font-size: 18px;
            font-weight: 800;
            color: #1e293b;
            text-align: center;
            margin-bottom: 10px;
        }

        .modal-text {
            font-size: 13.5px;
            color: #64748b;
            text-align: center;
            line-height: 1.6;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 24px;
        }

        .btn-cancel {
            flex: 1;
            background: #f1f5f9;
            color: #374151;
            border: none;
            border-radius: 10px;
            height: 42px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s;
            font-family: inherit;
        }

        .btn-cancel:hover {
            background: #e2e8f0;
        }

        .btn-delete-confirm {
            flex: 1;
            background: #dc2626;
            color: #fff;
            border: none;
            border-radius: 10px;
            height: 42px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: background .15s;
            font-family: inherit;
        }

        .btn-delete-confirm:hover {
            background: #b91c1c;
        }

        /* ── Mobile ── */
        @media (max-width: 1200px) {
            .dest-cards-grid {
                grid-template-columns: repeat(4, 1fr);
            }
        }

        @media (max-width: 900px) {
            .dest-cards-grid {
                grid-template-columns: repeat(3, 1fr);
            }

            .filter-grid {
                grid-template-columns: 1fr 1fr;
            }

            .filter-grid>*:nth-child(3) {
                grid-column: 1/3;
            }

            .filter-grid>*:nth-child(4),
            .filter-grid>*:nth-child(5) {
                grid-column: auto;
            }
        }

        @media (max-width: 640px) {
            .dest-cards-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .filter-grid>* {
                grid-column: 1 !important;
            }

            .page-title-text {
                font-size: 18px;
            }

            .dest-table thead th:nth-child(4),
            .dest-table tbody td:nth-child(4),
            .dest-table thead th:nth-child(5),
            .dest-table tbody td:nth-child(5),
            .dest-table thead th:nth-child(6),
            .dest-table tbody td:nth-child(6) {
                display: none;
            }
        }

        @media (max-width: 400px) {
            .dest-cards-grid {
                grid-template-columns: 1fr;
            }
        }

        /* Pagination pills */
        .pagination {
            margin: 0;
            display: flex;
            gap: 4px;
            flex-wrap: wrap;
        }

        .page-link {
            border-radius: 8px !important;
            border: 1px solid #e2e8f0 !important;
            color: #374151 !important;
            font-size: 13px !important;
            font-weight: 500 !important;
            padding: 6px 12px !important;
            transition: all .15s !important;
            line-height: 1.5 !important;
        }

        .page-link:hover {
            background: #f1f5f9 !important;
            border-color: #cbd5e1 !important;
        }

        .page-item.active .page-link {
            background: #3b82f6 !important;
            border-color: #3b82f6 !important;
            color: #fff !important;
        }

        .page-item.disabled .page-link {
            opacity: .45;
        }
    </style>
@endpush

@section('content')

    {{-- ── PAGE HEADER ── --}}
    <div class="page-header anim">
        <h1 class="page-title-text">
            Destinations
        </h1>
        <a href="{{ route('admin.destinations.create') }}" class="btn-add-dest">
            <i class="fas fa-plus"></i> Add Destination
        </a>
    </div>

    {{-- ── ALERTS ── --}}
    @if (session('success'))
        <div class="alert-box alert-success anim">
            <i class="fas fa-check-circle" style="font-size:15px;flex-shrink:0;"></i>
            <span>{{ session('success') }}</span>
            <button class="alert-close-btn" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif
    @if (session('error'))
        <div class="alert-box alert-error anim">
            <i class="fas fa-exclamation-triangle" style="font-size:15px;flex-shrink:0;"></i>
            <span>{{ session('error') }}</span>
            <button class="alert-close-btn" onclick="this.parentElement.remove()">×</button>
        </div>
    @endif

    {{-- ── FEATURED PHOTO CARDS ── --}}
    <div class="dest-cards-grid">
        @forelse($destinations->take(5) as $dest)
            <a href="{{ route('admin.destinations.show', $dest) }}" class="dest-card anim"
                style="animation-delay:{{ $loop->index * 0.07 + 0.05 }}s;">
                <div class="dest-card-img-wrap">
                    @if ($dest->featured_image)
                        <img src="{{ asset('storage/' . $dest->featured_image) }}" alt="{{ $dest->name }}" loading="lazy">
                    @else
                        <div class="dest-card-placeholder">
                            <i class="fas fa-mountain"></i>
                        </div>
                    @endif
                </div>
                <div class="dest-card-body">
                    <p class="dest-card-name">{{ $dest->name }}</p>
                    <p class="dest-card-location">{{ $dest->location ?? ($dest->region ?? 'Nepal') }}</p>
                    <div class="dest-card-badges">
                        @if ($dest->is_featured)
                            <span class="card-badge-featured"><i class="fas fa-star"></i> Featured</span>
                        @endif
                        @if (!$dest->is_active)
                            <span class="card-badge-inactive"><i class="fas fa-eye-slash"></i> Inactive</span>
                        @endif
                    </div>
                </div>
            </a>
        @empty
            <div style="grid-column:1/-1;text-align:center;padding:30px;color:#94a3b8;font-size:14px;">
                No destinations yet.
            </div>
        @endforelse
    </div>

    {{-- ── FILTER BAR ── --}}
    <div class="filter-card anim">
        <form method="GET" action="{{ route('admin.destinations.index') }}">
            <div class="filter-grid">
                <div>
                    <label class="filter-lbl">Search</label>
                    <div class="search-wrap">
                        <i class="fas fa-search si"></i>
                        <input type="text" name="search" placeholder="Search by name or location..."
                            value="{{ request('search') }}">
                    </div>
                </div>
                <div>
                    <label class="filter-lbl">Region</label>
                    <select name="region" class="filter-select">
                        <option value="">All Regions</option>
                        @foreach (['Himalayas', 'Hills', 'Terai', 'Kathmandu Valley', 'Annapurna Region', 'Everest Region', 'Langtang Region'] as $r)
                            <option value="{{ $r }}" {{ request('region') == $r ? 'selected' : '' }}>
                                {{ $r }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="filter-lbl">Status</label>
                    <select name="status" class="filter-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive</option>
                        <option value="featured" {{ request('status') == 'featured' ? 'selected' : '' }}>Featured</option>
                    </select>
                </div>
                <div>
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-filter"></i> Filter
                    </button>
                </div>
                <div>
                    <a href="{{ route('admin.destinations.index') }}" class="btn-reset">
                        <i class="fas fa-times"></i> Reset
                    </a>
                </div>
            </div>
        </form>
    </div>

    {{-- ── TABLE ── --}}
    <div class="table-card anim">
        <div class="table-card-header">
            <div style="font-weight:700;font-size:14px;color:#1e293b;display:flex;align-items:center;gap:8px;">
                <span style="width:8px;height:8px;border-radius:50%;background:#3b82f6;display:inline-block;"></span>
                All Destinations
            </div>
            @if (request()->hasAny(['search', 'region', 'status']))
                <span
                    style="background:#fef3c7;color:#92400e;border-radius:20px;padding:4px 12px;font-size:12px;font-weight:600;">
                    <i class="fas fa-filter" style="margin-right:4px;"></i>Filters Active
                </span>
            @endif
        </div>

        <div style="overflow-x:auto;">
            <table class="dest-table">
                <thead>
                    <tr>
                        <th>Destination</th>
                        <th>Description</th>
                        <th>Popular Activities</th>
                        <th>Status</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($destinations as $destination)
                        <tr>

                            {{-- Destination (thumb + name + location) --}}
                            <td>
                                <div style="display:flex;align-items:center;gap:12px;">
                                    @if ($destination->featured_image)
                                        <img src="{{ asset('storage/' . $destination->featured_image) }}"
                                            alt="{{ $destination->name }}" class="dest-thumb">
                                    @else
                                        <div class="dest-thumb-placeholder">
                                            <i class="fas fa-mountain"></i>
                                        </div>
                                    @endif
                                    <div>
                                        <span class="dest-name">{{ $destination->name }}</span>
                                        @if ($destination->location)
                                            <span class="dest-slug">
                                                <i class="fas fa-map-pin"
                                                    style="font-size:10px;margin-right:3px;color:#cbd5e1;"></i>
                                                {{ $destination->location }}
                                            </span>
                                        @endif
                                        @if ($destination->region)
                                            <span
                                                style="display:inline-block;background:#f1f5f9;color:#64748b;border-radius:6px;padding:2px 7px;font-size:10.5px;font-weight:600;margin-top:3px;">
                                                {{ $destination->region }}
                                            </span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            {{-- Description --}}
                            <td style="max-width:240px;">
                                <span style="color:#64748b;font-size:13px;line-height:1.5;">
                                    {{ Str::limit(strip_tags($destination->description ?? ''), 60) ?: '—' }}
                                </span>
                            </td>

                            {{-- Popular Activities --}}
                            <td style="max-width:220px;">
                                @if ($destination->activities || $destination->popular_activities)
                                    @php
                                        $acts = $destination->activities ?? ($destination->popular_activities ?? '');
                                        $actList = is_array($acts) ? implode(', ', $acts) : $acts;
                                    @endphp
                                    <span style="color:#64748b;font-size:13px;">
                                        {{ Str::limit($actList, 55) }}
                                    </span>
                                @elseif($destination->treks_count > 0)
                                    <span style="color:#64748b;font-size:13px;">
                                        <i class="fas fa-hiking" style="color:#3b82f6;margin-right:4px;"></i>
                                        Trekking & Adventures
                                    </span>
                                @else
                                    <span style="color:#cbd5e1;font-size:13px;">—</span>
                                @endif
                            </td>

                            {{-- Status --}}
                            <td>
                                @if ($destination->is_featured)
                                    <span class="status-badge s-featured"><i class="fas fa-star"
                                            style="font-size:10px;"></i> Featured</span>
                                @elseif($destination->is_active ?? true)
                                    <span class="status-badge s-active">Active</span>
                                @else
                                    <span class="status-badge s-inactive">Inactive</span>
                                @endif
                            </td>

                            {{-- Actions — dots menu ── --}}
                            <td style="text-align:center;">
                                <div class="dots-menu-wrap">
                                    <button class="dots-btn dots-toggle" type="button" aria-label="Actions">
                                        <span style="letter-spacing:1px;">•••</span>
                                    </button>
                                    <div class="dots-dropdown">
                                        <a href="{{ route('admin.destinations.show', $destination) }}">
                                            <i class="fas fa-eye" style="color:#0284c7;width:16px;"></i> View
                                        </a>
                                        <a href="{{ route('admin.destinations.edit', $destination) }}">
                                            <i class="fas fa-pen" style="color:#92400e;width:16px;"></i> Edit
                                        </a>
                                        <div class="dots-divider"></div>
                                        <button type="button" class="dd-delete delete-trigger"
                                            data-url="{{ route('admin.destinations.destroy', $destination) }}"
                                            data-name="{{ $destination->name }}">
                                            <i class="fas fa-trash-alt" style="color:#dc2626;width:16px;"></i> Delete
                                        </button>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @empty
                        <tr>
                            <td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon"><i class="fas fa-map-marked-alt"></i></div>
                                    <h5 style="color:#374151;font-weight:700;margin-bottom:6px;">No Destinations Found</h5>
                                    <p style="color:#94a3b8;font-size:13.5px;margin:0 0 16px;">
                                        {{ request()->hasAny(['search', 'region', 'status']) ? 'Try adjusting your filters.' : 'Start by adding your first destination.' }}
                                    </p>
                                    <a href="{{ route('admin.destinations.create') }}" class="btn-add-dest"
                                        style="display:inline-flex;">
                                        <i class="fas fa-plus"></i> Add First Destination
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    {{-- ── PAGINATION ── --}}
    {{-- @if ($destinations->hasPages())
        <div class="pagination-wrap anim">
            <div style="font-size:13px;color:#64748b;">
                <i class="fas fa-info-circle" style="color:#3b82f6;margin-right:5px;"></i>
                Showing <strong style="color:#1e293b;">{{ $destinations->firstItem() }}</strong>–<strong
                    style="color:#1e293b;">{{ $destinations->lastItem() }}</strong>
                of <strong style="color:#1e293b;">{{ $destinations->total() }}</strong> destinations
            </div>
            <div>
                {{ $destinations->onEachSide(1)->links('pagination::bootstrap-5') }}
            </div>
        </div>
    @endif --}}

    {{-- ── DELETE MODAL ── --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon"><i class="fas fa-trash-alt"></i></div>
            <h3 class="modal-title">Delete Destination</h3>
            <p class="modal-text">
                Are you sure you want to delete <strong id="deleteDestName" style="color:#1e293b;"></strong>?<br>
                <span style="font-size:12.5px;color:#94a3b8;margin-top:6px;display:block;">This action cannot be undone.
                    Associated treks will keep their data.</span>
            </p>
            <div class="modal-actions">
                <button class="btn-cancel" id="cancelDelete">Cancel</button>
                <form id="deleteForm" method="POST" style="flex:1;display:flex;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn-delete-confirm" style="width:100%;">
                        <i class="fas fa-trash-alt" style="margin-right:6px;"></i>Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {

            // ── Dots menu toggle ──────────────────────────────────────────────
            document.querySelectorAll('.dots-toggle').forEach(btn => {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    const dd = this.nextElementSibling;
                    const isOpen = dd.classList.contains('open');
                    // close all
                    document.querySelectorAll('.dots-dropdown.open').forEach(d => d.classList
                        .remove('open'));
                    if (!isOpen) dd.classList.add('open');
                });
            });
            document.addEventListener('click', () => {
                document.querySelectorAll('.dots-dropdown.open').forEach(d => d.classList.remove('open'));
            });

            // ── Delete modal ─────────────────────────────────────────────────
            const modal = document.getElementById('deleteModal');
            const deleteForm = document.getElementById('deleteForm');
            const deleteName = document.getElementById('deleteDestName');
            const cancelBtn = document.getElementById('cancelDelete');

            document.querySelectorAll('.delete-trigger').forEach(btn => {
                btn.addEventListener('click', function() {
                    const url = this.getAttribute('data-url');
                    const name = this.getAttribute('data-name');
                    deleteName.textContent = name;
                    deleteForm.action = url;
                    modal.classList.add('open');
                    // close dots menu
                    document.querySelectorAll('.dots-dropdown.open').forEach(d => d.classList
                        .remove('open'));
                });
            });

            cancelBtn.addEventListener('click', () => modal.classList.remove('open'));
            modal.addEventListener('click', function(e) {
                if (e.target === this) this.classList.remove('open');
            });

        });
    </script>
@endpush
