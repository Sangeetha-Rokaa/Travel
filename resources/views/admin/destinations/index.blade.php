{{-- resources/views/admin/destinations/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manage Destinations - Nepal Travel')
@section('page_title', 'Manage Destinations')
@section('page_icon', 'fas fa-map-marked-alt')

@section('content')
    <div class="container-fluid px-0">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1" style="color: #1e2a2e;">
                    <i class="fas fa-map-marker-alt me-2" style="color: #e9b35f;"></i>
                    Destinations
                </h4>
                <p class="text-muted small mb-0">
                    <i class="fas fa-database me-1"></i>
                    Total Destinations: <strong>{{ $destinations->total() }}</strong> |
                    <i class="fas fa-layer-group me-1 ms-2"></i>
                    Page: {{ $destinations->currentPage() }} / {{ $destinations->lastPage() }}
                </p>
            </div>

            <a href="{{ route('admin.destinations.create') }}" class="btn"
                style="background: linear-gradient(135deg, #1e2a2e, #2c4a3e); color: white; border-radius: 40px; padding: 10px 24px;">
                <i class="fas fa-plus-circle me-2"></i> Add New Destination
            </a>
        </div>

        {{-- Search and Filter Bar --}}
        <div class="card border-0 rounded-4 shadow-sm mb-4" style="background: white; border-radius: 28px !important;">
            <div class="card-body p-3">
                <form method="GET" action="{{ route('admin.destinations.index') }}" class="row g-3 align-items-center">
                    <div class="col-md-5">
                        <div class="input-group" style="border-radius: 40px; overflow: hidden;">
                            <span class="input-group-text bg-white border-end-0" style="border-radius: 40px 0 0 40px;">
                                <i class="fas fa-search text-muted"></i>
                            </span>
                            <input type="text" name="search" class="form-control border-start-0"
                                style="border-radius: 0 40px 40px 0;" placeholder="Search by name or location..."
                                value="{{ request('search') }}">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <select name="region" class="form-select" style="border-radius: 40px;">
                            <option value="">All Regions</option>
                            <option value="Himalayas" {{ request('region') == 'Himalayas' ? 'selected' : '' }}>Himalayas
                            </option>
                            <option value="Hills" {{ request('region') == 'Hills' ? 'selected' : '' }}>Hills</option>
                            <option value="Terai" {{ request('region') == 'Terai' ? 'selected' : '' }}>Terai</option>
                            <option value="Kathmandu Valley"
                                {{ request('region') == 'Kathmandu Valley' ? 'selected' : '' }}>Kathmandu Valley</option>
                            <option value="Annapurna Region"
                                {{ request('region') == 'Annapurna Region' ? 'selected' : '' }}>Annapurna Region</option>
                            <option value="Everest Region" {{ request('region') == 'Everest Region' ? 'selected' : '' }}>
                                Everest Region</option>
                            <option value="Langtang Region" {{ request('region') == 'Langtang Region' ? 'selected' : '' }}>
                                Langtang Region</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <select name="status" class="form-select" style="border-radius: 40px;">
                            <option value="">All Status</option>
                            <option value="active" {{ request('status') == 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : '' }}>Inactive
                            </option>
                            <option value="featured" {{ request('status') == 'featured' ? 'selected' : '' }}>Featured
                            </option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn w-100"
                            style="background: #1e2a2e; color: white; border-radius: 40px;">
                            <i class="fas fa-filter me-1"></i> Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="border-radius: 16px; border-left: 4px solid #10b981;">
                <i class="fas fa-check-circle me-2"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="border-radius: 16px; border-left: 4px solid #ef4444;">
                <i class="fas fa-exclamation-triangle me-2"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 rounded-4 shadow-sm" style="background: white; border-radius: 28px !important;">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0" style="border-radius: 28px; overflow: hidden;">
                        <thead style="background: linear-gradient(135deg, #1e2a2e, #2d4a3a); color: #f5e6d3;">
                            <tr>
                                <th class="ps-4" style="width: 60px;">#</th>
                                <th style="width: 100px;">Image</th>
                                <th>Name</th>
                                <th style="width: 120px;">Location</th>
                                <th style="width: 100px;">Region</th>
                                <th style="width: 80px;">Altitude</th>
                                <th style="width: 90px;" class="text-center">Treks</th>
                                <th style="width: 120px;" class="text-center pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($destinations as $index => $destination)
                                <tr style="border-bottom: 1px solid #f0e2ce;">
                                    <td class="ps-4 fw-bold">
                                        {{ $destinations->firstItem() + $index }}
                                    </td>
                                    <td>
                                        @if ($destination->featured_image)
                                            <img src="{{ asset('storage/' . $destination->featured_image) }}"
                                                alt="{{ $destination->name }}"
                                                style="width: 65px; height: 50px; object-fit: cover; border-radius: 12px; border: 2px solid #e9b35f; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                        @else
                                            <div
                                                style="width: 65px; height: 50px; background: linear-gradient(135deg, #e9d5b5, #d4a373); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #8b5e3c;">
                                                <i class="fas fa-mountain fa-2x"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <span class="fw-semibold"
                                                style="color: #1e2a2e;">{{ $destination->name }}</span>
                                            @if ($destination->slug)
                                                <br>
                                                <small class="text-muted" style="font-size: 0.7rem;">
                                                    <i class="fas fa-link"></i> {{ $destination->slug }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge"
                                            style="background: #e9b35f20; color: #b85c1a; border-radius: 20px; padding: 6px 12px;">
                                            <i class="fas fa-map-pin me-1"></i> {{ $destination->location }}
                                        </span>
                                    </td>
                                    <td>
                                        @if ($destination->region)
                                            <span class="badge"
                                                style="background: #1e2a2e20; color: #1e2a2e; border-radius: 20px; padding: 6px 12px;">
                                                {{ $destination->region }}
                                            </span>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if ($destination->altitude)
                                            <i class="fas fa-arrow-up me-1 text-muted"></i> {{ $destination->altitude }}
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge"
                                            style="background: #0ea5e9; color: white; border-radius: 20px; padding: 6px 12px;">
                                            <i class="fas fa-hiking me-1"></i> {{ $destination->treks_count }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" style="gap: 6px;">
                                            <a href="{{ route('admin.destinations.show', $destination->id) }}"
                                                class="btn btn-sm"
                                                style="background: #0ea5e9; color: white; border-radius: 30px; padding: 6px 14px;"
                                                title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.destinations.edit', $destination->id) }}"
                                                class="btn btn-sm"
                                                style="background: #e9b35f; color: #1e2a2e; border-radius: 30px; padding: 6px 14px;"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm delete-destination"
                                                data-id="{{ $destination->id }}" data-name="{{ $destination->name }}"
                                                style="background: #ef4444; color: white; border-radius: 30px; padding: 6px 14px;"
                                                title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>

                                        <div class="mt-2">
                                            @if ($destination->is_featured)
                                                <span class="badge"
                                                    style="background: #e9b35f; color: #1e2a2e; font-size: 0.7rem;">
                                                    <i class="fas fa-star"></i> Featured
                                                </span>
                                            @endif
                                            @if (!$destination->is_active)
                                                <span class="badge"
                                                    style="background: #95a5a6; color: white; font-size: 0.7rem;">
                                                    <i class="fas fa-eye-slash"></i> Inactive
                                                </span>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="fas fa-map-marked-alt fa-4x text-muted mb-3 d-block"
                                            style="opacity: 0.5;"></i>
                                        <h5 class="text-muted">No Destinations Found</h5>
                                        <p class="text-muted small">Start by adding your first destination</p>
                                        <a href="{{ route('admin.destinations.create') }}" class="btn btn-sm"
                                            style="background: #1e2a2e; color: white; border-radius: 30px; margin-top: 10px;">
                                            <i class="fas fa-plus"></i> Add First Destination
                                        </a>
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        {{-- Pagination --}}
        @if ($destinations->hasPages())
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-3 bg-white rounded-4 shadow-sm"
                        style="background: rgba(255,255,255,0.9);">
                        <div>
                            <i class="fas fa-info-circle" style="color: #e9b35f;"></i>
                            <span class="small text-muted">
                                Showing <strong>{{ $destinations->firstItem() }}</strong> to
                                <strong>{{ $destinations->lastItem() }}</strong>
                                of <strong>{{ $destinations->total() }}</strong> destinations
                            </span>
                        </div>
                        <div>
                            {{ $destinations->onEachSide(1)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>

    {{-- Delete Confirmation Modal --}}
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 24px;">
                <div class="modal-header" style="border-bottom: 2px solid #f0e2ce; background: #fef9e6;">
                    <h5 class="modal-title" id="deleteModalLabel" style="color: #1e2a2e;">
                        <i class="fas fa-trash-alt me-2" style="color: #ef4444;"></i>
                        Delete Destination
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="deleteDestinationName"></strong>?</p>
                    <p class="text-muted small mb-0">This action cannot be undone. All associated treks will keep their
                        data but the destination reference will be removed.</p>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #f0e2ce;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="border-radius: 30px;">
                        <i class="fas fa-times"></i> Cancel
                    </button>
                    <form id="deleteForm" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn"
                            style="background: #ef4444; color: white; border-radius: 30px;">
                            <i class="fas fa-trash-alt"></i> Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('styles')
    <style>
        .table-hover tbody tr:hover {
            background-color: #fff9ef !important;
            transition: all 0.2s ease;
        }

        .btn-group .btn {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .btn-group .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15);
        }

        .table thead th {
            font-weight: 600;
            letter-spacing: 0.3px;
            padding: 16px 12px;
            border-bottom: none;
        }

        .table tbody td {
            padding: 18px 12px;
            vertical-align: middle;
        }

        .pagination {
            margin-bottom: 0;
        }

        .pagination .page-link {
            border-radius: 30px !important;
            margin: 0 2px;
            color: #1e2a2e;
            border-color: #f0e2ce;
        }

        .pagination .page-item.active .page-link {
            background: #e9b35f;
            border-color: #e9b35f;
            color: #1e2a2e;
            font-weight: 600;
        }

        .pagination .page-link:hover {
            background: #e9b35f20;
            border-color: #e9b35f;
            color: #b85c1a;
        }

        /* Search input group styling */
        .input-group-text {
            border-color: #e0d5c0;
        }

        .input-group .form-control:focus,
        .form-select:focus {
            border-color: #e9b35f;
            box-shadow: none;
        }

        .input-group .form-control:focus+.input-group-text,
        .input-group .form-control:focus {
            border-color: #e9b35f;
        }

        @media (max-width: 992px) {

            .table thead th,
            .table tbody td {
                padding: 12px 8px;
                font-size: 13px;
            }

            .btn-group .btn {
                padding: 4px 10px;
                font-size: 12px;
            }
        }

        @media (max-width: 768px) {
            .btn-group {
                display: flex;
                flex-direction: column;
                gap: 5px;
            }

            .btn-group .btn {
                margin: 0 !important;
                width: 100%;
            }
        }

        .alert {
            border: none;
            background: linear-gradient(135deg, #fef9e6, #ffffff);
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Delete confirmation modal handler
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.delete-destination');
            const deleteForm = document.getElementById('deleteForm');
            const deleteDestinationNameSpan = document.getElementById('deleteDestinationName');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const destinationId = this.getAttribute('data-id');
                    const destinationName = this.getAttribute('data-name');

                    deleteDestinationNameSpan.textContent = destinationName;
                    deleteForm.action = `/admin/destinations/${destinationId}`;

                    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                    modal.show();
                });
            });
        });
    </script>
@endpush
