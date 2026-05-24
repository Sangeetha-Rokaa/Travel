@extends('layouts.admin')

@section('title', 'Testimonials')
@section('page-title', 'Testimonials')

@section('topbar-extras')
    {{-- Search & Filter in topbar --}}
    <div class="flex items-center gap-2">
        <div style="position:relative;">
            <i class="fas fa-search"
                style="position:absolute;left:11px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:12px;"></i>
            <input type="text" id="testimonialSearch" placeholder="Search testimonials..." value="{{ request('search') }}"
                style="border:1.5px solid #e8edf3;border-radius:9px;padding:7px 12px 7px 32px;font-size:13px;color:#334155;outline:none;background:#f8fafc;width:200px;transition:border 0.15s;"
                onfocus="this.style.borderColor='#3b82f6';this.style.background='#fff';"
                onblur="this.style.borderColor='#e8edf3';this.style.background='#f8fafc';">
        </div>
        <select id="statusFilter"
            style="border:1.5px solid #e8edf3;border-radius:9px;padding:7px 12px;font-size:13px;color:#334155;background:#f8fafc;outline:none;cursor:pointer;">
            <option value="">All Status</option>
            <option value="1" {{ request('is_active') === '1' ? 'selected' : '' }}>Active</option>
            <option value="0" {{ request('is_active') === '0' ? 'selected' : '' }}>Inactive</option>
        </select>
    </div>
@endsection

@push('styles')
    <style>
        /* Testimonial Card */
        .testimonial-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            padding: 24px 22px 20px;
            display: flex;
            flex-direction: column;
            gap: 0;
            transition: box-shadow 0.18s ease, transform 0.18s ease;
            position: relative;
        }

        .testimonial-card:hover {
            box-shadow: 0 6px 24px rgba(59, 130, 246, 0.10);
            transform: translateY(-2px);
        }

        /* Client row */
        .client-row {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 14px;
        }

        .client-avatar {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            object-fit: cover;
            background: #e2e8f0;
            flex-shrink: 0;
            border: 2px solid #f0f4f8;
        }

        .client-avatar-placeholder {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: linear-gradient(135deg, #3b82f6 0%, #2563eb 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 16px;
            font-weight: 700;
            color: #fff;
            flex-shrink: 0;
        }

        .client-name {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            line-height: 1.2;
        }

        .client-country {
            font-size: 12px;
            color: #94a3b8;
            margin-top: 2px;
        }

        /* Stars */
        .star-row {
            display: flex;
            align-items: center;
            gap: 2px;
            margin-bottom: 12px;
        }

        .star {
            color: #f59e0b;
            font-size: 15px;
        }

        .star-empty {
            color: #e2e8f0;
            font-size: 15px;
        }

        /* Review text */
        .review-text {
            font-size: 13.5px;
            color: #475569;
            line-height: 1.65;
            flex: 1;
            margin-bottom: 16px;
            display: -webkit-box;
            -webkit-line-clamp: 4;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        /* Footer row */
        .card-footer-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: auto;
            padding-top: 14px;
            border-top: 1px solid #f3f6fa;
        }

        .travel-date {
            font-size: 12.5px;
            color: #94a3b8;
            font-weight: 500;
        }

        /* Badges */
        .badge-approved {
            background: #dcfce7;
            color: #16a34a;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-pending {
            background: #fef9c3;
            color: #ca8a04;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-inactive {
            background: #f1f5f9;
            color: #64748b;
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

        /* Action menu */
        .card-action-menu {
            position: absolute;
            top: 16px;
            right: 16px;
        }

        .card-action-btn {
            width: 28px;
            height: 28px;
            border-radius: 7px;
            border: 1px solid #e8edf3;
            background: #f8fafc;
            color: #94a3b8;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 12px;
            transition: all 0.13s;
        }

        .card-action-btn:hover {
            background: #e8edf3;
            color: #334155;
        }

        .card-dropdown {
            position: absolute;
            right: 0;
            top: 34px;
            background: #fff;
            border: 1px solid #e8edf3;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
            z-index: 100;
            min-width: 150px;
            display: none;
            overflow: hidden;
        }

        .card-dropdown.open {
            display: block;
        }

        .card-dropdown a,
        .card-dropdown button {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 14px;
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

        .card-dropdown a:hover,
        .card-dropdown button:hover {
            background: #f8fafc;
        }

        .card-dropdown .delete-btn {
            color: #dc2626;
        }

        .card-dropdown .delete-btn:hover {
            background: #fff1f2;
        }

        /* Add button */
        .add-btn {
            background: #3b82f6;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 9px 18px;
            font-size: 13.5px;
            font-weight: 600;
            display: inline-flex;
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

        /* Trek/Package tag */
        .trek-tag {
            font-size: 11.5px;
            color: #3b82f6;
            font-weight: 500;
            margin-top: 2px;
        }

        /* View All link */
        .view-all-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #3b82f6;
            font-size: 14px;
            font-weight: 600;
            text-decoration: none;
            transition: gap 0.15s;
        }

        .view-all-link:hover {
            gap: 10px;
            color: #2563eb;
        }

        /* Empty state */
        .empty-state {
            text-align: center;
            padding: 80px 20px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 52px;
            display: block;
            margin-bottom: 14px;
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

        /* Responsive grid */
        .testimonials-grid {
            display: grid;
            grid-template-columns: repeat(4, 1fr);
            gap: 20px;
        }

        @media (max-width: 1280px) {
            .testimonials-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }

        @media (max-width: 900px) {
            .testimonials-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 600px) {
            .testimonials-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')

    {{-- Top bar: Add button + filter --}}
    <div class="flex items-center justify-between mb-6">
        <div style="font-size: 13.5px; color: #64748b;">
            {{ $testimonials->total() }} testimonial{{ $testimonials->total() !== 1 ? 's' : '' }}
        </div>
        <a href="{{ route('admin.testimonials.create') }}" class="add-btn">
            <i class="fas fa-plus"></i>
            Add Testimonial
        </a>
    </div>

    {{-- Cards Grid --}}
    @forelse($testimonials as $testimonial)
        @if ($loop->first)
            <div class="testimonials-grid">
        @endif

        <div class="testimonial-card">

            {{-- Action menu --}}
            <div class="card-action-menu">
                <button class="card-action-btn" onclick="toggleCardMenu(this)">
                    <i class="fas fa-ellipsis-h"></i>
                </button>
                <div class="card-dropdown">
                    <a href="{{ route('admin.testimonials.show', $testimonial->id) }}">
                        <i class="fas fa-eye" style="color:#3b82f6;width:16px;"></i> View
                    </a>
                    <a href="{{ route('admin.testimonials.edit', $testimonial->id) }}">
                        <i class="fas fa-pencil-alt" style="color:#f59e0b;width:16px;"></i> Edit
                    </a>
                    <button class="delete-btn"
                        onclick="openDeleteModal('{{ $testimonial->client_name }}', '{{ route('admin.testimonials.destroy', $testimonial->id) }}')">
                        <i class="fas fa-trash-alt" style="width:16px;"></i> Delete
                    </button>
                </div>
            </div>

            {{-- Client info --}}
            <div class="client-row">
                @if ($testimonial->client_photo_url)
                    <img src="{{ $testimonial->client_photo_url }}" alt="{{ $testimonial->client_name }}"
                        class="client-avatar">
                @else
                    <div class="client-avatar-placeholder">
                        {{ strtoupper(substr($testimonial->client_name, 0, 1)) }}
                    </div>
                @endif
                <div>
                    <div class="client-name">{{ $testimonial->client_name }}</div>
                    <div class="client-country">{{ $testimonial->client_country }}</div>
                    @if ($testimonial->trek_or_package)
                        <div class="trek-tag">{{ $testimonial->trek_or_package }}</div>
                    @endif
                </div>
            </div>

            {{-- Star rating --}}
            <div class="star-row">
                @for ($i = 1; $i <= 5; $i++)
                    @if ($i <= $testimonial->rating)
                        <i class="fas fa-star star"></i>
                    @else
                        <i class="fas fa-star star-empty"></i>
                    @endif
                @endfor
            </div>

            {{-- Review text --}}
            <div class="review-text">
                {{ $testimonial->review ?? ($testimonial->message ?? '') }}
            </div>

            {{-- Footer: date + status --}}
            <div class="card-footer-row">
                <span class="travel-date">
                    {{ $testimonial->travel_date?->format('M j, Y') ?? '—' }}
                </span>
                <div style="display:flex;align-items:center;gap:6px;">
                    @if ($testimonial->is_featured)
                        <span class="badge-featured">
                            <i class="fas fa-star" style="font-size:9px;margin-right:2px;"></i> Featured
                        </span>
                    @endif
                    @if ($testimonial->is_active)
                        <span class="badge-approved">Approved</span>
                    @else
                        <span class="badge-pending">Pending</span>
                    @endif
                </div>
            </div>

        </div>

        @if ($loop->last)
            </div>
        @endif

    @empty
        <div class="empty-state">
            <i class="far fa-comment-dots"></i>
            <p>No testimonials found.</p>
            <a href="{{ route('admin.testimonials.create') }}" class="add-btn mt-4">
                <i class="fas fa-plus"></i> Add first testimonial
            </a>
        </div>
    @endforelse

    {{-- View All / Pagination --}}
    @if ($testimonials->hasPages())
        <div class="flex items-center justify-between mt-8">
            <div style="font-size:13px;color:#64748b;">
                Showing {{ $testimonials->firstItem() }}–{{ $testimonials->lastItem() }} of {{ $testimonials->total() }}
            </div>
            {{ $testimonials->appends(request()->query())->links() }}
        </div>
    @else
        <div class="text-center mt-8">
            <a href="{{ route('admin.testimonials.index') }}" class="view-all-link">
                View All Testimonials <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    @endif

    {{-- Delete Modal --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon"><i class="fas fa-trash-alt"></i></div>
            <div style="font-size:18px;font-weight:700;color:#1e293b;margin-bottom:8px;">Delete Testimonial</div>
            <div style="font-size:14px;color:#64748b;margin-bottom:24px;line-height:1.6;">
                Are you sure you want to delete the testimonial from
                <strong id="deleteClientName" style="color:#1e293b;"></strong>?
                This action cannot be undone.
            </div>
            <div class="flex items-center gap-3 justify-end">
                <button onclick="closeDeleteModal()"
                    style="padding:9px 18px;border-radius:9px;border:1.5px solid #e8edf3;background:#f8fafc;font-size:13.5px;font-weight:600;color:#64748b;cursor:pointer;">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        style="padding:9px 18px;border-radius:9px;border:none;background:#dc2626;color:#fff;font-size:13.5px;font-weight:600;cursor:pointer;">
                        <i class="fas fa-trash-alt" style="margin-right:4px;"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Card action dropdown
        function toggleCardMenu(btn) {
            const dropdown = btn.nextElementSibling;
            document.querySelectorAll('.card-dropdown').forEach(d => {
                if (d !== dropdown) d.classList.remove('open');
            });
            dropdown.classList.toggle('open');
        }
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.card-action-menu')) {
                document.querySelectorAll('.card-dropdown').forEach(d => d.classList.remove('open'));
            }
        });

        // Delete modal
        function openDeleteModal(name, url) {
            document.getElementById('deleteClientName').textContent = name;
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModal').classList.add('open');
            document.querySelectorAll('.card-dropdown').forEach(d => d.classList.remove('open'));
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('open');
        }
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // Search & filter
        let searchTimeout;
        document.getElementById('testimonialSearch')?.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(applyFilters, 400);
        });
        document.getElementById('statusFilter')?.addEventListener('change', applyFilters);

        function applyFilters() {
            const search = document.getElementById('testimonialSearch')?.value ?? '';
            const status = document.getElementById('statusFilter')?.value ?? '';
            const url = new URL(window.location.href);
            url.searchParams.set('search', search);
            url.searchParams.set('is_active', status);
            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        }
    </script>
@endpush
