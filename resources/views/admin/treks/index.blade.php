@extends('layouts.admin')

@section('title', 'Trekking')
@section('page-title', 'Trekking')

@push('styles')
    <style>
        .trek-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            transition: box-shadow 0.18s ease, transform 0.18s ease;
            overflow: hidden;
        }

        .trek-card:hover {
            box-shadow: 0 4px 16px rgba(59, 130, 246, 0.10);
            transform: translateY(-1px);
        }

        .trek-thumb {
            width: 110px;
            min-width: 110px;
            height: 88px;
            object-fit: cover;
            border-radius: 10px;
            background: #e2e8f0;
        }

        .trek-thumb-placeholder {
            width: 110px;
            min-width: 110px;
            height: 88px;
            border-radius: 10px;
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 22px;
        }

        .meta-label {
            font-size: 11px;
            color: #94a3b8;
            font-weight: 500;
            margin-bottom: 2px;
            letter-spacing: 0.01em;
        }

        .meta-value {
            font-size: 13.5px;
            font-weight: 600;
            color: #1e293b;
        }

        .meta-divider {
            width: 1px;
            background: #f0f4f8;
            align-self: stretch;
            margin: 0 4px;
        }

        .badge-active {
            background: #dcfce7;
            color: #16a34a;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-inactive {
            background: #fee2e2;
            color: #dc2626;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-featured {
            background: #fef3c7;
            color: #d97706;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-easy {
            background: #dcfce7;
            color: #16a34a;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-moderate {
            background: #fef9c3;
            color: #ca8a04;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-challenging {
            background: #fee2e2;
            color: #dc2626;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-strenuous {
            background: #fae8ff;
            color: #9333ea;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .action-menu {
            position: relative;
        }

        .action-menu-btn {
            width: 32px;
            height: 32px;
            border-radius: 8px;
            border: 1px solid #e8edf3;
            background: #f8fafc;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 14px;
            transition: all 0.15s ease;
        }

        .action-menu-btn:hover {
            background: #e8edf3;
            color: #334155;
        }

        .action-dropdown {
            position: absolute;
            right: 0;
            top: 38px;
            background: #fff;
            border: 1px solid #e8edf3;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
            z-index: 100;
            min-width: 160px;
            display: none;
            overflow: hidden;
        }

        .action-dropdown.open {
            display: block;
        }

        .action-dropdown a,
        .action-dropdown button {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 10px 14px;
            font-size: 13px;
            font-weight: 500;
            color: #334155;
            text-decoration: none;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: background 0.12s;
        }

        .action-dropdown a:hover,
        .action-dropdown button:hover {
            background: #f8fafc;
        }

        .action-dropdown .delete-btn {
            color: #dc2626;
        }

        .action-dropdown .delete-btn:hover {
            background: #fff1f2;
        }

        .search-input {
            border: 1.5px solid #e8edf3;
            border-radius: 10px;
            padding: 9px 14px 9px 38px;
            font-size: 13.5px;
            color: #334155;
            outline: none;
            background: #f8fafc;
            width: 260px;
            transition: border 0.15s;
        }

        .search-input:focus {
            border-color: #3b82f6;
            background: #fff;
        }

        .search-wrapper {
            position: relative;
        }

        .search-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 13px;
        }

        .add-btn {
            background: #3b82f6;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 18px;
            font-size: 13.5px;
            font-weight: 600;
            display: flex;
            align-items: center;
            gap: 7px;
            cursor: pointer;
            text-decoration: none;
            transition: background 0.15s;
        }

        .add-btn:hover {
            background: #2563eb;
            color: #fff;
        }

        .pagination-info {
            font-size: 13px;
            color: #64748b;
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 48px;
            margin-bottom: 14px;
            display: block;
            color: #cbd5e1;
        }

        .empty-state p {
            font-size: 15px;
            font-weight: 500;
            color: #64748b;
        }

        /* Delete Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 22, 35, 0.45);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal-box {
            background: #fff;
            border-radius: 16px;
            padding: 32px 28px 24px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
            transform: translateY(16px) scale(0.98);
            transition: transform 0.2s;
        }

        .modal-overlay.open .modal-box {
            transform: translateY(0) scale(1);
        }

        .modal-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: #fee2e2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #dc2626;
            margin-bottom: 16px;
        }

        /* Filter bar */
        .filter-select {
            border: 1.5px solid #e8edf3;
            border-radius: 9px;
            padding: 7px 12px;
            font-size: 13px;
            color: #334155;
            background: #f8fafc;
            outline: none;
            cursor: pointer;
        }

        .filter-select:focus {
            border-color: #3b82f6;
        }
    </style>
@endpush

@section('content')

    {{-- Header Row --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            {{-- Search --}}
            <div class="search-wrapper">
                <i class="fas fa-search search-icon"></i>
                <input type="text" id="trekSearch" class="search-input" placeholder="Search treks..."
                    value="{{ request('search') }}">
            </div>

            {{-- Difficulty Filter --}}
            <select class="filter-select" id="difficultyFilter">
                <option value="">All Difficulties</option>
                <option value="easy" {{ request('difficulty') === 'easy' ? 'selected' : '' }}>Easy</option>
                <option value="moderate" {{ request('difficulty') === 'moderate' ? 'selected' : '' }}>Moderate</option>
                <option value="challenging" {{ request('difficulty') === 'challenging' ? 'selected' : '' }}>Challenging
                </option>
                <option value="strenuous" {{ request('difficulty') === 'strenuous' ? 'selected' : '' }}>Strenuous</option>
            </select>

            {{-- Status Filter --}}
            <select class="filter-select" id="statusFilter">
                <option value="">All Status</option>
                <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Active</option>
                <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
            </select>
        </div>

        <a href="{{ route('admin.treks.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Add Trek
        </a>
    </div>

    {{-- Treks List --}}
    <div class="trek-card">
        <div style="padding: 4px 0;">
            @forelse($treks as $trek)
                <div class="flex items-center gap-5 px-6 py-4" style="border-bottom: 1px solid #f3f6fa;">

                    {{-- Thumbnail --}}
                    @if ($trek->featured_image)
                        <img src="{{ Storage::url($trek->featured_image) }}" alt="{{ $trek->name }}" class="trek-thumb">
                    @else
                        <div class="trek-thumb-placeholder">
                            <i class="fas fa-hiking"></i>
                        </div>
                    @endif

                    {{-- Name & Destination --}}
                    <div style="min-width: 180px; flex: 1;">
                        <div style="font-size: 15px; font-weight: 700; color: #1e293b; margin-bottom: 3px;">
                            {{ $trek->name }}
                        </div>
                        @if ($trek->destination)
                            <div style="font-size: 12px; color: #64748b; display: flex; align-items: center; gap: 4px;">
                                <i class="fas fa-map-marker-alt" style="color: #3b82f6; font-size: 11px;"></i>
                                {{ $trek->destination->name }}
                            </div>
                        @endif
                        <div class="flex items-center gap-2 mt-2">
                            @if ($trek->is_featured)
                                <span class="badge-featured">
                                    <i class="fas fa-star" style="font-size: 10px; margin-right: 2px;"></i> Featured
                                </span>
                            @endif
                            @if ($trek->is_active)
                                <span class="badge-active">Active</span>
                            @else
                                <span class="badge-inactive">Inactive</span>
                            @endif
                        </div>
                    </div>

                    <div class="meta-divider"></div>

                    {{-- Duration --}}
                    <div style="min-width: 80px;">
                        <div class="meta-label">Duration</div>
                        <div class="meta-value">{{ $trek->duration_days }} Days</div>
                    </div>

                    <div class="meta-divider"></div>

                    {{-- Group Size --}}
                    <div style="min-width: 90px;">
                        <div class="meta-label">Group Size</div>
                        <div class="meta-value">
                            {{ $trek->group_size_min }}–{{ $trek->group_size_max }}
                            <span style="font-size: 11px; color: #94a3b8; font-weight: 400;">pax</span>
                        </div>
                    </div>

                    <div class="meta-divider"></div>

                    {{-- Difficulty --}}
                    <div style="min-width: 100px;">
                        <div class="meta-label">Difficulty</div>
                        <div class="mt-1">
                            @php
                                $diff = strtolower($trek->difficulty);
                            @endphp
                            @if ($diff === 'easy')
                                <span class="badge-easy">Easy</span>
                            @elseif($diff === 'moderate')
                                <span class="badge-moderate">Moderate</span>
                            @elseif($diff === 'challenging')
                                <span class="badge-challenging">Challenging</span>
                            @elseif($diff === 'strenuous')
                                <span class="badge-strenuous">Strenuous</span>
                            @else
                                <span
                                    style="font-size: 13px; font-weight: 600; color: #334155;">{{ ucfirst($trek->difficulty) }}</span>
                            @endif
                        </div>
                    </div>

                    <div class="meta-divider"></div>

                    {{-- Price --}}
                    <div style="min-width: 90px;">
                        <div class="meta-label">Price</div>
                        <div class="meta-value" style="color: #3b82f6;">${{ number_format($trek->price_usd) }}</div>
                    </div>

                    <div class="meta-divider"></div>

                    {{-- Actions --}}
                    <div class="action-menu ml-2">
                        <button class="action-menu-btn" onclick="toggleMenu(this)">
                            <i class="fas fa-ellipsis-h"></i>
                        </button>
                        <div class="action-dropdown">
                            <a href="{{ route('admin.treks.show', $trek) }}">
                                <i class="fas fa-eye" style="color: #3b82f6; width: 16px;"></i>
                                View
                            </a>
                            <a href="{{ route('admin.treks.edit', $trek) }}">
                                <i class="fas fa-pencil-alt" style="color: #f59e0b; width: 16px;"></i>
                                Edit
                            </a>
                            <button class="delete-btn"
                                onclick="openDeleteModal('{{ $trek->name }}', '{{ route('admin.treks.destroy', $trek->id) }}')">
                                <i class="fas fa-trash-alt" style="width: 16px;"></i>
                                Delete
                            </button>
                        </div>
                    </div>

                </div>
            @empty
                <div class="empty-state">
                    <i class="fas fa-hiking"></i>
                    <p>No treks found.</p>
                    <a href="{{ route('admin.treks.create') }}" class="add-btn mt-4" style="display: inline-flex;">
                        <i class="fas fa-plus"></i> Add your first trek
                    </a>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Pagination --}}
    @if ($treks->hasPages())
        <div class="flex items-center justify-between mt-5">
            <div class="pagination-info">
                Showing {{ $treks->firstItem() }}–{{ $treks->lastItem() }} of {{ $treks->total() }} treks
            </div>
            <div class="pagination-links">
                {{ $treks->appends(request()->query())->links() }}
            </div>
        </div>
    @else
        <div class="mt-4 pagination-info">
            {{ $treks->total() }} trek{{ $treks->total() !== 1 ? 's' : '' }} total
        </div>
    @endif

    {{-- Delete Confirmation Modal --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon">
                <i class="fas fa-trash-alt"></i>
            </div>
            <div style="font-size: 18px; font-weight: 700; color: #1e293b; margin-bottom: 8px;">Delete Trek</div>
            <div style="font-size: 14px; color: #64748b; margin-bottom: 24px; line-height: 1.6;">
                Are you sure you want to delete <strong id="deleteTrekName" style="color: #1e293b;"></strong>?
                This action cannot be undone.
            </div>
            <div class="flex items-center gap-3 justify-end">
                <button onclick="closeDeleteModal()"
                    style="padding: 9px 18px; border-radius: 9px; border: 1.5px solid #e8edf3; background: #f8fafc; font-size: 13.5px; font-weight: 600; color: #64748b; cursor: pointer;">
                    Cancel
                </button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        style="padding: 9px 18px; border-radius: 9px; border: none; background: #dc2626; color: #fff; font-size: 13.5px; font-weight: 600; cursor: pointer;">
                        <i class="fas fa-trash-alt mr-1"></i> Delete Trek
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Action dropdown toggle
        function toggleMenu(btn) {
            const dropdown = btn.nextElementSibling;
            const allDropdowns = document.querySelectorAll('.action-dropdown');
            allDropdowns.forEach(d => {
                if (d !== dropdown) d.classList.remove('open');
            });
            dropdown.classList.toggle('open');
        }

        // Close dropdowns when clicking outside
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.action-menu')) {
                document.querySelectorAll('.action-dropdown').forEach(d => d.classList.remove('open'));
            }
        });

        // Delete modal
        function openDeleteModal(name, url) {
            document.getElementById('deleteTrekName').textContent = name;
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModal').classList.add('open');
            // close any open dropdown
            document.querySelectorAll('.action-dropdown').forEach(d => d.classList.remove('open'));
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('open');
        }

        // Close modal on overlay click
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // Live search (debounced)
        let searchTimeout;
        document.getElementById('trekSearch').addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(() => applyFilters(), 400);
        });

        document.getElementById('difficultyFilter').addEventListener('change', applyFilters);
        document.getElementById('statusFilter').addEventListener('change', applyFilters);

        function applyFilters() {
            const search = document.getElementById('trekSearch').value;
            const difficulty = document.getElementById('difficultyFilter').value;
            const status = document.getElementById('statusFilter').value;

            const url = new URL(window.location.href);
            url.searchParams.set('search', search);
            url.searchParams.set('difficulty', difficulty);
            url.searchParams.set('is_active', status);
            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        }
    </script>
@endpush
