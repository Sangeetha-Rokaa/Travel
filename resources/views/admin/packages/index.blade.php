{{-- resources/views/admin/packages/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manage Packages - Nepal Travel')
@section('page_title', 'Manage Travel Packages')
@section('page_icon', 'fas fa-box')

@section('content')
    <div class="container-fluid px-0">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1" style="color: #1e2a2e;">
                    <i class="fas fa-suitcase-rolling me-2" style="color: #e9b35f;"></i>
                    Travel Packages
                </h4>
                <p class="text-muted small mb-0">
                    <i class="fas fa-database me-1"></i>
                    Total Packages: <strong>{{ $packages->total() }}</strong> |
                    <i class="fas fa-layer-group me-1 ms-2"></i>
                    Page: {{ $packages->currentPage() }} / {{ $packages->lastPage() }}
                </p>
            </div>

            <a href="{{ route('admin.packages.create') }}" class="btn"
                style="background: linear-gradient(135deg, #1e2a2e, #2c4a3e); color: white; border-radius: 40px; padding: 10px 24px;">
                <i class="fas fa-plus-circle me-2"></i> Add New Package
            </a>
        </div>

        {{-- Search and Filter Bar --}}
        <div class="card border-0 rounded-4 shadow-sm mb-4" style="background: white; border-radius: 28px !important;">
            <div class="card-body p-3">
                <form method="GET" action="{{ route('admin.packages.index') }}" class="row g-3 align-items-center">
                    <div class="col-md-4">
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
                        <select name="package_type" class="form-select" style="border-radius: 40px;">
                            <option value="">All Types</option>
                            <option value="adventure" {{ request('package_type') == 'adventure' ? 'selected' : '' }}>
                                Adventure</option>
                            <option value="cultural" {{ request('package_type') == 'cultural' ? 'selected' : '' }}>Cultural
                            </option>
                            <option value="wildlife" {{ request('package_type') == 'wildlife' ? 'selected' : '' }}>Wildlife
                            </option>
                            <option value="pilgrimage" {{ request('package_type') == 'pilgrimage' ? 'selected' : '' }}>
                                Pilgrimage</option>
                            <option value="honeymoon" {{ request('package_type') == 'honeymoon' ? 'selected' : '' }}>
                                Honeymoon</option>
                            <option value="family" {{ request('package_type') == 'family' ? 'selected' : '' }}>Family
                            </option>
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
                    <div class="col-md-3">
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
                                <th style="width: 100px;">Type</th>
                                <th style="width: 80px;">Duration</th>
                                <th style="width: 60px;">Max People</th>
                                <th style="width: 110px;">Price</th>
                                <th style="width: 90px;" class="text-center">Bookings</th>
                                <th style="width: 120px;" class="text-center pe-4">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($packages as $index => $package)
                                <tr style="border-bottom: 1px solid #f0e2ce;">
                                    <td class="ps-4 fw-bold">
                                        {{ $packages->firstItem() + $index }}
                                    </td>
                                    <td>
                                        @if ($package->featured_image)
                                            <img src="{{ asset('storage/' . $package->featured_image) }}"
                                                alt="{{ $package->name }}"
                                                style="width: 65px; height: 50px; object-fit: cover; border-radius: 12px; border: 2px solid #e9b35f; box-shadow: 0 2px 6px rgba(0,0,0,0.1);">
                                        @else
                                            <div
                                                style="width: 65px; height: 50px; background: linear-gradient(135deg, #e9d5b5, #d4a373); border-radius: 12px; display: flex; align-items: center; justify-content: center; color: #8b5e3c;">
                                                <i class="fas fa-box fa-2x"></i>
                                            </div>
                                        @endif
                                    </td>
                                    <td>
                                        <div>
                                            <span class="fw-semibold" style="color: #1e2a2e;">{{ $package->name }}</span>
                                            @if ($package->slug)
                                                <br>
                                                <small class="text-muted" style="font-size: 0.7rem;">
                                                    <i class="fas fa-link"></i> {{ $package->slug }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @php
                                            $typeColors = [
                                                'cultural' => ['bg' => '#8b5cf620', 'text' => '#6d28d9'],
                                                'adventure' => ['bg' => '#0ea5e920', 'text' => '#0ea5e9'],
                                                'wildlife' => ['bg' => '#10b98120', 'text' => '#10b981'],
                                                'pilgrimage' => ['bg' => '#f59e0b20', 'text' => '#f59e0b'],
                                                'honeymoon' => ['bg' => '#ec489920', 'text' => '#ec4899'],
                                                'family' => ['bg' => '#14b8a620', 'text' => '#14b8a6'],
                                            ];
                                            $typeColor = $typeColors[$package->type] ?? [
                                                'bg' => '#6c757d20',
                                                'text' => '#6c757d',
                                            ];
                                        @endphp
                                        <span class="badge"
                                            style="background: {{ $typeColor['bg'] }}; color: {{ $typeColor['text'] }}; border-radius: 20px; padding: 6px 12px;">
                                            <i class="fas fa-tag me-1"></i>
                                            {{ ucfirst($package->type ?? 'Standard') }}
                                        </span>
                                    </td>
                                    <td>
                                        <i class="far fa-calendar-alt me-1 text-muted"></i>
                                        <strong>{{ $package->duration_days }}</strong> days
                                    </td>
                                    <td>
                                        <i class="fas fa-users me-1 text-muted"></i>
                                        {{ $package->group_size_max ?? 'N/A' }}
                                    </td>
                                    <td>
                                        @if ($package->price_usd)
                                            <div class="fw-bold" style="color: #b85c1a;">
                                                ${{ number_format($package->price_usd, 2) }}
                                            </div>
                                            @if ($package->price_usd_discounted)
                                                <small class="text-muted"
                                                    style="font-size: 0.7rem; text-decoration: line-through;">
                                                    ${{ number_format($package->price_usd_discounted, 2) }}
                                                </small>
                                            @endif
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <span class="badge"
                                            style="background: #0ea5e9; color: white; border-radius: 20px; padding: 6px 12px;">
                                            <i class="fas fa-calendar-check me-1"></i> {{ $package->bookings_count ?? 0 }}
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" style="gap: 6px;">
                                            <a href="{{ route('admin.packages.edit', $package->id) }}" class="btn btn-sm"
                                                style="background: #e9b35f; color: #1e2a2e; border-radius: 30px; padding: 6px 14px;"
                                                title="Edit">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm delete-package"
                                                data-id="{{ $package->id }}" data-name="{{ $package->name }}"
                                                style="background: #ef4444; color: white; border-radius: 30px; padding: 6px 14px;"
                                                title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>

                                        <div class="mt-2">
                                            @if ($package->is_featured)
                                                <span class="badge"
                                                    style="background: #e9b35f; color: #1e2a2e; font-size: 0.7rem;">
                                                    <i class="fas fa-star"></i> Featured
                                                </span>
                                            @endif
                                            @if (!$package->is_active)
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
                                    <td colspan="9" class="text-center py-5">
                                        <i class="fas fa-box-open fa-4x text-muted mb-3 d-block"
                                            style="opacity: 0.5;"></i>
                                        <h5 class="text-muted">No Packages Found</h5>
                                        <p class="text-muted small">Start by adding your first travel package</p>
                                        <a href="{{ route('admin.packages.create') }}" class="btn btn-sm"
                                            style="background: #1e2a2e; color: white; border-radius: 30px; margin-top: 10px;">
                                            <i class="fas fa-plus"></i> Add First Package
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
        @if ($packages->hasPages())
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-3 bg-white rounded-4 shadow-sm"
                        style="background: rgba(255,255,255,0.9);">
                        <div>
                            <i class="fas fa-info-circle" style="color: #e9b35f;"></i>
                            <span class="small text-muted">
                                Showing <strong>{{ $packages->firstItem() }}</strong> to
                                <strong>{{ $packages->lastItem() }}</strong>
                                of <strong>{{ $packages->total() }}</strong> packages
                            </span>
                        </div>
                        <div>
                            {{ $packages->onEachSide(1)->links('pagination::bootstrap-5') }}
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
                        Delete Package
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="deletePackageName"></strong>?</p>
                    <p class="text-muted small mb-0">This action cannot be undone. All associated bookings will keep their
                        data but the package reference will be removed.</p>
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
            const deleteButtons = document.querySelectorAll('.delete-package');
            const deleteForm = document.getElementById('deleteForm');
            const deletePackageNameSpan = document.getElementById('deletePackageName');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const packageId = this.getAttribute('data-id');
                    const packageName = this.getAttribute('data-name');

                    deletePackageNameSpan.textContent = packageName;
                    deleteForm.action = `/admin/packages/${packageId}`;

                    const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
                    modal.show();
                });
            });
        });
    </script>
@endpush
