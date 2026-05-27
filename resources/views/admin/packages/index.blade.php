@extends('layouts.admin')

@section('title', 'Packages')
@section('page-title', 'Packages')

@push('styles')
    <style>
        /* ─────────────────────────────────────────
                                                       ANIMATION
                                                    ───────────────────────────────────────── */
        @keyframes fadeSlideUp {
            from {
                opacity: 0;
                transform: translateY(18px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .anim {
            animation: fadeSlideUp .45s ease both;
        }

        /* ─────────────────────────────────────────
                                                       HEADER
                                                    ───────────────────────────────────────── */
        .page-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
            gap: 14px;
            margin-bottom: 26px;
        }

        .page-title-text {
            font-size: 26px;
            font-weight: 800;
            color: #0f172a;
            margin: 0;
            letter-spacing: -.4px;
        }

        .btn-add-package {
            background: #2563eb;
            color: #fff;
            border: none;
            border-radius: 12px;
            padding: 11px 22px;
            font-size: 14px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            text-decoration: none;
            transition: .2s ease;
            box-shadow: 0 10px 24px rgba(37, 99, 235, .22);
        }

        .btn-add-package:hover {
            background: #1d4ed8;
            color: #fff;
            transform: translateY(-2px);
        }

        /* ─────────────────────────────────────────
                                                       TOP PACKAGE CARDS
                                                    ───────────────────────────────────────── */
        .package-cards-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 18px;
            margin-bottom: 28px;
        }

        .package-card {
            background: #fff;
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #edf2f7;
            text-decoration: none;
            display: block;
            transition: .22s ease;
            box-shadow: 0 4px 14px rgba(15, 23, 42, .05);
        }

        .package-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 14px 30px rgba(15, 23, 42, .12);
        }

        .package-card-image {
            width: 100%;
            height: 190px;
            overflow: hidden;
            position: relative;
            background: #e2e8f0;
        }

        .package-card-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .35s ease;
        }

        .package-card:hover .package-card-image img {
            transform: scale(1.06);
        }

        .package-card-placeholder {
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            font-size: 34px;
        }

        .package-card-body {
            padding: 16px;
        }

        .package-card-name {
            font-size: 17px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 6px;
            line-height: 1.3;
        }

        .package-card-price {
            font-size: 21px;
            font-weight: 800;
            color: #111827;
            margin-bottom: 12px;
        }

        .package-meta {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 10px;
            flex-wrap: wrap;
            font-size: 12.5px;
            color: #64748b;
        }

        .package-status {
            padding: 4px 12px;
            border-radius: 999px;
            font-size: 11px;
            font-weight: 700;
        }

        .status-active {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-inactive {
            background: #f1f5f9;
            color: #64748b;
        }

        /* ─────────────────────────────────────────
                                                       FILTER BAR
                                                    ───────────────────────────────────────── */
        .filter-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #edf2f7;
            padding: 18px;
            margin-bottom: 22px;
            box-shadow: 0 2px 10px rgba(15, 23, 42, .04);
        }

        .filter-grid {
            display: grid;
            grid-template-columns: 1.5fr 1fr 1fr auto auto;
            gap: 12px;
            align-items: end;
        }

        .filter-lbl {
            font-size: 11px;
            font-weight: 700;
            color: #64748b;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: .5px;
            display: block;
        }

        .search-wrap {
            position: relative;
        }

        .search-wrap i {
            position: absolute;
            left: 13px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 12px;
        }

        .search-wrap input,
        .filter-select {
            width: 100%;
            height: 42px;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            outline: none;
            font-size: 13.5px;
            color: #1e293b;
            background: #fff;
            transition: .2s ease;
            font-family: inherit;
        }

        .search-wrap input {
            padding: 0 14px 0 38px;
        }

        .filter-select {
            padding: 0 14px;
        }

        .search-wrap input:focus,
        .filter-select:focus {
            border-color: #3b82f6;
            box-shadow: 0 0 0 4px rgba(59, 130, 246, .1);
        }

        .btn-filter {
            height: 42px;
            padding: 0 18px;
            border-radius: 12px;
            border: none;
            background: #0f172a;
            color: #fff;
            font-size: 13px;
            font-weight: 700;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 7px;
            transition: .2s ease;
        }

        .btn-filter:hover {
            background: #1e293b;
        }

        .btn-reset {
            height: 42px;
            padding: 0 16px;
            border-radius: 12px;
            background: #f1f5f9;
            color: #475569;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 13px;
            font-weight: 600;
        }

        /* ─────────────────────────────────────────
                                                       ALERTS
                                                    ───────────────────────────────────────── */
        .alert-box {
            border-radius: 14px;
            padding: 14px 18px;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }

        .alert-error {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }

        /* ─────────────────────────────────────────
                                                       TABLE CARD
                                                    ───────────────────────────────────────── */
        .table-card {
            background: #fff;
            border-radius: 18px;
            border: 1px solid #edf2f7;
            overflow: hidden;
            box-shadow: 0 2px 10px rgba(15, 23, 42, .04);
        }

        .table-card-header {
            padding: 18px 22px;
            border-bottom: 1px solid #eef2f7;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            flex-wrap: wrap;
        }

        .package-table {
            width: 100%;
            border-collapse: collapse;
        }

        .package-table thead tr {
            background: #f8fafc;
        }

        .package-table thead th {
            padding: 14px 18px;
            font-size: 11px;
            color: #64748b;
            text-transform: uppercase;
            letter-spacing: .6px;
            font-weight: 700;
            white-space: nowrap;
        }

        .package-table tbody td {
            padding: 16px 18px;
            border-top: 1px solid #f1f5f9;
            font-size: 13.5px;
            color: #374151;
            vertical-align: middle;
        }

        .package-table tbody tr:hover {
            background: #fafcff;
        }

        .package-thumb {
            width: 60px;
            height: 46px;
            border-radius: 10px;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }

        .package-thumb-placeholder {
            width: 60px;
            height: 46px;
            border-radius: 10px;
            background: linear-gradient(135deg, #dbeafe, #bfdbfe);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #2563eb;
            border: 2px solid #e2e8f0;
        }

        .package-name {
            font-weight: 700;
            color: #0f172a;
            font-size: 14px;
        }

        .package-slug {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 2px;
            display: block;
        }

        .type-badge {
            background: #eff6ff;
            color: #2563eb;
            border-radius: 999px;
            padding: 5px 10px;
            font-size: 11px;
            font-weight: 700;
            display: inline-flex;
            align-items: center;
            gap: 4px;
        }

        .booking-badge {
            background: #e0f2fe;
            color: #0284c7;
            border-radius: 999px;
            padding: 5px 12px;
            font-size: 11px;
            font-weight: 700;
        }

        /* ─────────────────────────────────────────
                                                       DOTS MENU
                                                    ───────────────────────────────────────── */
        .dots-menu-wrap {
            position: relative;
            display: inline-block;
        }

        .dots-btn {
            width: 34px;
            height: 34px;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
            background: #f8fafc;
            color: #64748b;
            cursor: pointer;
        }

        .dots-dropdown {
            position: absolute;
            top: 42px;
            right: 0;
            background: #fff;
            border-radius: 14px;
            border: 1px solid #e2e8f0;
            min-width: 170px;
            padding: 6px;
            box-shadow: 0 14px 30px rgba(15, 23, 42, .12);
            display: none;
            z-index: 200;
        }

        .dots-dropdown.open {
            display: block;
        }

        .dots-dropdown a,
        .dots-dropdown button {
            width: 100%;
            border: none;
            background: transparent;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 12px;
            border-radius: 10px;
            text-decoration: none;
            color: #374151;
            font-size: 13px;
            font-weight: 500;
            cursor: pointer;
        }

        .dots-dropdown a:hover,
        .dots-dropdown button:hover {
            background: #f8fafc;
        }

        .dots-divider {
            height: 1px;
            background: #f1f5f9;
            margin: 4px 0;
        }

        .dd-delete {
            color: #dc2626 !important;
        }

        /* ─────────────────────────────────────────
                                                       EMPTY
                                                    ───────────────────────────────────────── */
        .empty-state {
            text-align: center;
            padding: 70px 20px;
        }

        .empty-icon {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            background: #f1f5f9;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 16px;
            color: #94a3b8;
            font-size: 30px;
        }

        /* ─────────────────────────────────────────
                                                       MODAL
                                                    ───────────────────────────────────────── */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 23, 42, .55);
            display: none;
            align-items: center;
            justify-content: center;
            z-index: 999;
        }

        .modal-overlay.open {
            display: flex;
        }

        .modal-box {
            background: #fff;
            width: 92%;
            max-width: 450px;
            border-radius: 24px;
            padding: 30px;
            animation: fadeSlideUp .25s ease;
        }

        .modal-icon {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #fee2e2;
            color: #dc2626;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            margin: 0 auto 16px;
        }

        .modal-title {
            text-align: center;
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 10px;
        }

        .modal-text {
            text-align: center;
            font-size: 13.5px;
            color: #64748b;
            line-height: 1.6;
        }

        .modal-actions {
            display: flex;
            gap: 10px;
            margin-top: 24px;
        }

        .btn-cancel,
        .btn-delete-confirm {
            flex: 1;
            height: 44px;
            border-radius: 12px;
            border: none;
            font-size: 14px;
            font-weight: 700;
            cursor: pointer;
        }

        .btn-cancel {
            background: #f1f5f9;
            color: #334155;
        }

        .btn-delete-confirm {
            background: #dc2626;
            color: #fff;
        }

        /* ─────────────────────────────────────────
                                                       RESPONSIVE
                                                    ───────────────────────────────────────── */
        @media(max-width:1200px) {
            .package-cards-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media(max-width:900px) {
            .package-cards-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .filter-grid {
                grid-template-columns: 1fr 1fr;
            }
        }

        @media(max-width:640px) {
            .package-cards-grid {
                grid-template-columns: 1fr;
            }

            .filter-grid {
                grid-template-columns: 1fr;
            }

            .package-table thead th:nth-child(4),
            .package-table tbody td:nth-child(4),
            .package-table thead th:nth-child(6),
            .package-table tbody td:nth-child(6) {
                display: none;
            }
        }
    </style>
@endpush

@section('content')

    {{-- HEADER --}}
    <div class="page-header anim">
        <h1 class="page-title-text">Packages</h1>

        <a href="{{ route('admin.packages.create') }}" class="btn-add-package">
            <i class="fas fa-plus"></i>
            Add Package
        </a>
    </div>

    {{-- ALERTS --}}
    @if (session('success'))
        <div class="alert-box alert-success anim">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="alert-box alert-error anim">
            <i class="fas fa-exclamation-triangle"></i>
            {{ session('error') }}
        </div>
    @endif

    {{-- TOP CARDS --}}
    <div class="package-cards-grid">
        @forelse($packages->take(4) as $package)
            <a href="{{ route('admin.packages.edit', $package) }}" class="package-card anim">

                <div class="package-card-image">

                    @if ($package->featured_image)
                        <img src="{{ asset('storage/' . $package->featured_image) }}" alt="{{ $package->name }}">
                    @else
                        <div class="package-card-placeholder">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif

                </div>

                <div class="package-card-body">

                    <div class="package-card-name">
                        {{ $package->name }}
                    </div>

                    <div class="package-card-price">
                        ${{ number_format($package->price_usd ?? 0) }}
                    </div>

                    <div class="package-meta">
                        <span>{{ $package->duration_days }} Days</span>

                        <span>{{ ucfirst($package->difficulty ?? 'Easy') }}</span>

                        @if ($package->is_active)
                            <span class="package-status status-active">Active</span>
                        @else
                            <span class="package-status status-inactive">Inactive</span>
                        @endif
                    </div>

                </div>

            </a>
        @empty
        @endforelse
    </div>

    {{-- FILTER --}}
    <div class="filter-card anim">

        <form method="GET" action="{{ route('admin.packages.index') }}">

            <div class="filter-grid">

                <div>
                    <label class="filter-lbl">Search</label>

                    <div class="search-wrap">
                        <i class="fas fa-search"></i>

                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Search packages...">
                    </div>
                </div>

                <div>
                    <label class="filter-lbl">Package Type</label>

                    <select name="package_type" class="filter-select">
                        <option value="">All Types</option>

                        @foreach (['adventure', 'cultural', 'wildlife', 'pilgrimage', 'honeymoon', 'family'] as $type)
                            <option value="{{ $type }}" {{ request('package_type') == $type ? 'selected' : '' }}>
                                {{ ucfirst($type) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="filter-lbl">Status</label>

                    <select name="status" class="filter-select">
                        <option value="">All Status</option>
                        <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>
                            Active
                        </option>
                        <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>
                            Inactive
                        </option>
                        <option value="featured" {{ request('status') == 'featured' ? 'selected' : '' }}>
                            Featured
                        </option>
                    </select>
                </div>

                <div>
                    <button type="submit" class="btn-filter">
                        <i class="fas fa-filter"></i>
                        Filter
                    </button>
                </div>

                <div>
                    <a href="{{ route('admin.packages.index') }}" class="btn-reset">
                        <i class="fas fa-times"></i>
                        Reset
                    </a>
                </div>

            </div>

        </form>

    </div>

    {{-- TABLE --}}
    <div class="table-card anim">

        <div class="table-card-header">

            <div style="font-weight:700;font-size:14px;color:#0f172a;">
                All Packages
            </div>

        </div>

        <div style="overflow-x:auto;">

            <table class="package-table">

                <thead>
                    <tr>
                        <th>Package</th>
                        <th>Type</th>
                        <th>Duration</th>
                        <th>Price</th>
                        <th>Bookings</th>
                        <th>Status</th>
                        <th style="text-align:center;">Action</th>
                    </tr>
                </thead>

                <tbody>

                    @forelse($packages as $package)
                        <tr>

                            {{-- PACKAGE --}}
                            <td>

                                <div style="display:flex;align-items:center;gap:12px;">

                                    @if ($package->featured_image)
                                        <img src="{{ asset('storage/' . $package->featured_image) }}"
                                            class="package-thumb">
                                    @else
                                        <div class="package-thumb-placeholder">
                                            <i class="fas fa-image"></i>
                                        </div>
                                    @endif

                                    <div>

                                        <span class="package-name">
                                            {{ $package->name }}
                                        </span>

                                        @if ($package->slug)
                                            <span class="package-slug">
                                                {{ $package->slug }}
                                            </span>
                                        @endif

                                    </div>

                                </div>

                            </td>

                            {{-- TYPE --}}
                            <td>
                                <span class="type-badge">
                                    <i class="fas fa-tag"></i>
                                    {{ ucfirst($package->type ?? 'Standard') }}
                                </span>
                            </td>

                            {{-- DURATION --}}
                            <td>
                                {{ $package->duration_days }} Days
                            </td>

                            {{-- PRICE --}}
                            <td>
                                <strong>
                                    ${{ number_format($package->price_usd ?? 0) }}
                                </strong>
                            </td>

                            {{-- BOOKINGS --}}
                            <td>
                                <span class="booking-badge">
                                    <i class="fas fa-calendar-check"></i>
                                    {{ $package->bookings_count ?? 0 }}
                                </span>
                            </td>

                            {{-- STATUS --}}
                            <td>

                                @if ($package->is_featured)
                                    <span class="package-status" style="background:#fef3c7;color:#92400e;">
                                        Featured
                                    </span>
                                @elseif($package->is_active)
                                    <span class="package-status status-active">
                                        Active
                                    </span>
                                @else
                                    <span class="package-status status-inactive">
                                        Inactive
                                    </span>
                                @endif

                            </td>

                            {{-- ACTION --}}
                            <td style="text-align:center;">

                                <div class="dots-menu-wrap">

                                    <button type="button" class="dots-btn dots-toggle">
                                        •••
                                    </button>

                                    <div class="dots-dropdown">

                                        <a href="{{ route('admin.packages.edit', $package) }}">
                                            <i class="fas fa-pen"></i>
                                            Edit
                                        </a>

                                        <div class="dots-divider"></div>

                                        <button type="button" class="dd-delete delete-trigger"
                                            data-url="{{ route('admin.packages.destroy', $package) }}"
                                            data-name="{{ $package->name }}">
                                            <i class="fas fa-trash-alt" style="color:#dc2626;width:16px;"></i> Delete
                                        </button>

                                    </div>

                                </div>

                            </td>

                        </tr>

                    @empty

                        <tr>
                            <td colspan="7">

                                <div class="empty-state">

                                    <div class="empty-icon">
                                        <i class="fas fa-box-open"></i>
                                    </div>

                                    <h5 style="font-weight:700;color:#334155;">
                                        No Packages Found
                                    </h5>

                                    <p style="font-size:13px;color:#94a3b8;">
                                        Start by creating your first package.
                                    </p>

                                    <a href="{{ route('admin.packages.create') }}" class="btn-add-package"
                                        style="display:inline-flex;margin-top:14px;">

                                        <i class="fas fa-plus"></i>
                                        Add Package

                                    </a>

                                </div>

                            </td>
                        </tr>
                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

    {{-- PAGINATION --}}
    @if ($packages->hasPages())
        <div style="margin-top:20px;">
            {{ $packages->onEachSide(1)->links('pagination::bootstrap-5') }}
        </div>
    @endif

    {{-- DELETE MODAL --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon"><i class="fas fa-trash-alt"></i></div>
            <h3 class="modal-title">Delete Package</h3>
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

            // dots menu
            document.querySelectorAll('.dots-toggle').forEach(btn => {

                btn.addEventListener('click', function(e) {

                    e.stopPropagation();

                    const menu = this.nextElementSibling;

                    document.querySelectorAll('.dots-dropdown.open')
                        .forEach(dd => dd.classList.remove('open'));

                    menu.classList.toggle('open');

                });

            });

            document.addEventListener('click', () => {
                document.querySelectorAll('.dots-dropdown.open')
                    .forEach(dd => dd.classList.remove('open'));
            });

            // delete modal
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
        document.querySelectorAll('.delete-trigger').forEach(button => {
            button.addEventListener('click', function() {

                let url = this.dataset.url;

                let form = document.getElementById('deleteForm');

                form.action = url;
            });
        });
    </script>
@endpush
