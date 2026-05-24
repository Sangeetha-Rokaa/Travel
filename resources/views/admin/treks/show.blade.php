@extends('layouts.admin')

@section('title', 'Trek — ' . $trek->name)
@section('page-title', 'Trek Details')

@push('styles')
    <style>
        .show-grid {
            display: grid;
            grid-template-columns: 1fr 300px;
            gap: 22px;
            align-items: start;
        }

        @media (max-width: 1100px) {
            .show-grid {
                grid-template-columns: 1fr;
            }
        }

        .show-main {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .show-sidebar {
            display: flex;
            flex-direction: column;
            gap: 16px;
            position: sticky;
            top: 86px;
        }

        @media (max-width: 1100px) {
            .show-sidebar {
                position: static;
            }
        }

        /* Cards */
        .s-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        .s-card-header {
            padding: 14px 22px;
            border-bottom: 1px solid #f0f4f8;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .s-card-icon {
            width: 32px;
            height: 32px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            flex-shrink: 0;
        }

        .s-card-header h3 {
            font-size: 13.5px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .s-card-body {
            padding: 22px;
        }

        /* Detail grid */
        .detail-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 18px;
        }

        .detail-grid.three {
            grid-template-columns: repeat(3, 1fr);
        }

        @media (max-width: 640px) {

            .detail-grid,
            .detail-grid.three {
                grid-template-columns: 1fr;
            }
        }

        .detail-item {}

        .detail-label {
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.05em;
            text-transform: uppercase;
            margin-bottom: 5px;
        }

        .detail-value {
            font-size: 13.5px;
            font-weight: 600;
            color: #1e293b;
        }

        .detail-value.muted {
            color: #64748b;
            font-weight: 400;
        }

        /* Badges */
        .badge {
            display: inline-flex;
            align-items: center;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-active {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-inactive {
            background: #f1f5f9;
            color: #64748b;
        }

        .badge-featured {
            background: #fef3c7;
            color: #d97706;
        }

        .badge-easy {
            background: #dcfce7;
            color: #16a34a;
        }

        .badge-moderate {
            background: #fef9c3;
            color: #ca8a04;
        }

        .badge-challenging {
            background: #fee2e2;
            color: #dc2626;
        }

        .badge-strenuous {
            background: #fae8ff;
            color: #9333ea;
        }

        /* Description text */
        .desc-text {
            font-size: 13.5px;
            color: #475569;
            line-height: 1.7;
        }

        /* Itinerary Quill content */
        .itinerary-content {
            font-size: 13.5px;
            color: #334155;
            line-height: 1.75;
        }

        .itinerary-content h2 {
            font-size: 15px;
            font-weight: 700;
            color: #1e293b;
            margin: 16px 0 6px;
        }

        .itinerary-content h3 {
            font-size: 14px;
            font-weight: 700;
            color: #334155;
            margin: 12px 0 4px;
        }

        .itinerary-content p {
            margin: 0 0 10px;
        }

        .itinerary-content ul,
        .itinerary-content ol {
            padding-left: 20px;
            margin: 0 0 10px;
        }

        .itinerary-content li {
            margin-bottom: 4px;
        }

        .itinerary-content blockquote {
            border-left: 3px solid #3b82f6;
            padding-left: 14px;
            color: #64748b;
            margin: 12px 0;
            font-style: italic;
        }

        /* Featured image */
        .feat-img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            display: block;
        }

        .feat-img-placeholder {
            width: 100%;
            height: 220px;
            background: linear-gradient(135deg, #e2e8f0 0%, #cbd5e1 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            color: #94a3b8;
            font-size: 40px;
        }

        /* Sidebar rows */
        .s-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f3f6fa;
            font-size: 13px;
        }

        .s-row:last-child {
            border-bottom: none;
        }

        .s-row-label {
            color: #94a3b8;
            font-weight: 500;
        }

        .s-row-value {
            color: #1e293b;
            font-weight: 600;
            font-size: 13px;
        }

        /* Action buttons */
        .edit-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            width: 100%;
            height: 42px;
            background: #3b82f6;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            transition: background 0.15s;
        }

        .edit-btn:hover {
            background: #2563eb;
            color: #fff;
        }

        .delete-btn-link {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            width: 100%;
            height: 38px;
            background: #fff1f2;
            color: #dc2626;
            border: 1.5px solid #fecaca;
            border-radius: 10px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            font-family: inherit;
            transition: background 0.15s;
            margin-top: 8px;
        }

        .delete-btn-link:hover {
            background: #fee2e2;
        }

        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 9px;
            border: 1.5px solid #e8edf3;
            background: #fff;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            text-decoration: none;
            transition: all 0.15s;
        }

        .back-btn:hover {
            background: #f8fafc;
            color: #334155;
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

        /* Price highlight */
        .price-big {
            font-size: 26px;
            font-weight: 800;
            color: #3b82f6;
            line-height: 1;
        }
    </style>
@endpush

@section('content')

    {{-- Top bar --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.treks.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <div>
                <div style="font-size:12px; color:#94a3b8; margin-bottom:2px;">Treks / Details</div>
                <div style="font-size:15px; font-weight:700; color:#1e293b;">{{ $trek->name }}</div>
            </div>
        </div>
        <a href="{{ route('admin.treks.edit', $trek->slug) }}" class="edit-btn" style="width:auto; padding:0 18px;">
            <i class="fas fa-pencil-alt"></i> Edit Trek
        </a>
    </div>

    <div class="show-grid">

        {{-- ══ LEFT COLUMN ══════════════════════════════════════════ --}}
        <div class="show-main">

            {{-- Basic Info --}}
            <div class="s-card">
                <div class="s-card-header">
                    <div class="s-card-icon" style="background:#eff6ff;">
                        <i class="fas fa-circle-info text-blue-500"></i>
                    </div>
                    <h3>Basic Information</h3>
                </div>
                <div class="s-card-body">
                    <div class="detail-grid" style="margin-bottom:20px;">
                        <div class="detail-item">
                            <div class="detail-label">Trek Name</div>
                            <div class="detail-value">{{ $trek->name }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Slug</div>
                            <div class="detail-value" style="font-family:monospace; font-size:12.5px; color:#3b82f6;">
                                {{ $trek->slug }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Destination</div>
                            <div class="detail-value">
                                @if ($trek->destination)
                                    <i class="fas fa-map-marker-alt"
                                        style="color:#3b82f6; font-size:11px; margin-right:4px;"></i>
                                    {{ $trek->destination->name }}
                                @else
                                    <span class="detail-value muted">—</span>
                                @endif
                            </div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Difficulty</div>
                            <div class="detail-value">
                                @php $diff = strtolower($trek->difficulty); @endphp
                                <span
                                    class="badge badge-{{ in_array($diff, ['easy', 'moderate', 'challenging', 'strenuous']) ? $diff : 'inactive' }}">
                                    {{ ucfirst($trek->difficulty) }}
                                </span>
                            </div>
                        </div>
                    </div>

                    @if ($trek->short_description)
                        <div style="margin-bottom:16px;">
                            <div class="detail-label" style="margin-bottom:6px;">Short Description</div>
                            <p class="desc-text">{{ $trek->short_description }}</p>
                        </div>
                    @endif

                    @if ($trek->description)
                        <div>
                            <div class="detail-label" style="margin-bottom:6px;">Full Description</div>
                            <p class="desc-text">{{ $trek->description }}</p>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Trek Details --}}
            <div class="s-card">
                <div class="s-card-header">
                    <div class="s-card-icon" style="background:#f0fdf4;">
                        <i class="fas fa-route text-green-500"></i>
                    </div>
                    <h3>Trek Details</h3>
                </div>
                <div class="s-card-body">
                    <div class="detail-grid three">
                        <div class="detail-item">
                            <div class="detail-label">Duration</div>
                            <div class="detail-value">{{ $trek->duration_days ?? '—' }} <span
                                    style="font-size:12px; color:#94a3b8; font-weight:400;">days</span></div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Max Altitude</div>
                            <div class="detail-value">{{ $trek->max_altitude ?? '—' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Best Season</div>
                            <div class="detail-value">{{ $trek->best_season ?? '—' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Start Point</div>
                            <div class="detail-value">{{ $trek->start_point ?? '—' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">End Point</div>
                            <div class="detail-value">{{ $trek->end_point ?? '—' }}</div>
                        </div>
                        <div class="detail-item">
                            <div class="detail-label">Group Size</div>
                            <div class="detail-value">
                                {{ $trek->group_size_min ?? '—' }}–{{ $trek->group_size_max ?? '—' }}
                                <span style="font-size:12px; color:#94a3b8; font-weight:400;">pax</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Itinerary --}}
            @if ($trek->itinerary)
                <div class="s-card">
                    <div class="s-card-header">
                        <div class="s-card-icon" style="background:#fef9c3;">
                            <i class="fas fa-list-ol" style="color:#d97706;"></i>
                        </div>
                        <h3>Itinerary</h3>
                    </div>
                    <div class="s-card-body">
                        <div class="itinerary-content">
                            {!! $trek->itinerary !!}
                        </div>
                    </div>
                </div>
            @endif

        </div>

        {{-- ══ RIGHT SIDEBAR ════════════════════════════════════════ --}}
        <div class="show-sidebar">

            {{-- Featured Image --}}
            <div class="s-card">
                @if ($trek->featured_image)
                    <img src="{{ Storage::url($trek->featured_image) }}" alt="{{ $trek->name }}" class="feat-img">
                @else
                    <div class="feat-img-placeholder">
                        <i class="fas fa-hiking"></i>
                    </div>
                @endif
                <div style="padding:14px 16px 12px;">
                    <div style="font-size:13px; font-weight:700; color:#1e293b; margin-bottom:2px;">{{ $trek->name }}
                    </div>
                    @if ($trek->destination)
                        <div style="font-size:12px; color:#64748b;">
                            <i class="fas fa-map-marker-alt" style="color:#3b82f6; font-size:10px;"></i>
                            {{ $trek->destination->name }}
                        </div>
                    @endif
                </div>
            </div>

            {{-- Price & Status --}}
            <div class="s-card">
                <div class="s-card-header">
                    <div class="s-card-icon" style="background:#eff6ff;">
                        <i class="fas fa-tag text-blue-500"></i>
                    </div>
                    <h3>Price & Status</h3>
                </div>
                <div class="s-card-body" style="padding-top:16px; padding-bottom:16px;">
                    <div style="margin-bottom:16px;">
                        <div class="detail-label" style="margin-bottom:4px;">Price per person</div>
                        <div class="price-big">${{ number_format($trek->price_usd ?? 0) }}</div>
                    </div>
                    <div class="s-row">
                        <span class="s-row-label">Status</span>
                        <span>
                            @if ($trek->is_active)
                                <span class="badge badge-active">Active</span>
                            @else
                                <span class="badge badge-inactive">Inactive</span>
                            @endif
                        </span>
                    </div>
                    <div class="s-row">
                        <span class="s-row-label">Featured</span>
                        <span>
                            @if ($trek->is_featured)
                                <span class="badge badge-featured"><i class="fas fa-star"
                                        style="font-size:9px;margin-right:3px;"></i> Yes</span>
                            @else
                                <span class="badge badge-inactive">No</span>
                            @endif
                        </span>
                    </div>
                    <div class="s-row">
                        <span class="s-row-label">Sort Order</span>
                        <span class="s-row-value">{{ $trek->sort_order ?? 0 }}</span>
                    </div>
                </div>
            </div>

            {{-- Meta --}}
            <div class="s-card">
                <div class="s-card-header">
                    <div class="s-card-icon" style="background:#f0f9ff;">
                        <i class="fas fa-clock text-sky-500"></i>
                    </div>
                    <h3>Meta</h3>
                </div>
                <div class="s-card-body" style="padding-top:12px; padding-bottom:12px;">
                    <div class="s-row">
                        <span class="s-row-label">Created</span>
                        <span class="s-row-value">{{ $trek->created_at->format('M j, Y') }}</span>
                    </div>
                    <div class="s-row">
                        <span class="s-row-label">Last Updated</span>
                        <span class="s-row-value">{{ $trek->updated_at->diffForHumans() }}</span>
                    </div>
                    <div class="s-row">
                        <span class="s-row-label">ID</span>
                        <span class="s-row-value"
                            style="font-family:monospace; color:#94a3b8;">#{{ $trek->id }}</span>
                    </div>
                </div>
            </div>

            {{-- Actions --}}
            <div class="s-card">
                <div class="s-card-body" style="display:flex; flex-direction:column; gap:0;">
                    <a href="{{ route('admin.treks.edit', $trek->slug) }}" class="edit-btn">
                        <i class="fas fa-pencil-alt"></i> Edit Trek
                    </a>
                    <button type="button" class="delete-btn-link" onclick="openDeleteModal()">
                        <i class="fas fa-trash-alt"></i> Delete Trek
                    </button>
                    <div style="margin-top:12px; padding-top:12px; border-top:1px solid #f0f4f8;">
                        <a href="{{ route('admin.treks.index') }}"
                            style="display:flex;align-items:center;gap:7px;font-size:13px;font-weight:600;color:#64748b;text-decoration:none;justify-content:center;">
                            <i class="fas fa-list" style="font-size:12px;"></i> All Treks
                        </a>
                    </div>
                </div>
            </div>

        </div>

    </div>

    {{-- Delete Modal --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon"><i class="fas fa-trash-alt"></i></div>
            <div style="font-size:18px;font-weight:700;color:#1e293b;margin-bottom:8px;">Delete Trek</div>
            <div style="font-size:14px;color:#64748b;margin-bottom:24px;line-height:1.6;">
                Are you sure you want to delete
                <strong style="color:#1e293b;">{{ $trek->name }}</strong>?
                This action cannot be undone.
            </div>
            <div class="flex items-center gap-3 justify-end">
                <button onclick="document.getElementById('deleteModal').classList.remove('open')"
                    style="padding:9px 18px;border-radius:9px;border:1.5px solid #e8edf3;background:#f8fafc;font-size:13.5px;font-weight:600;color:#64748b;cursor:pointer;">
                    Cancel
                </button>
                <form action="{{ route('admin.treks.destroy', $trek->id) }}" method="POST">
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
        function openDeleteModal() {
            document.getElementById('deleteModal').classList.add('open');
        }
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) this.classList.remove('open');
        });
    </script>
@endpush
