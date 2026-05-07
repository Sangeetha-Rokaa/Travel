{{-- resources/views/admin/treks/index.blade.php --}}
@extends('layouts.admin')

@section('title', 'Manage Treks - Nepal Travel')
@section('page_title', 'Trek Management')
@section('page_icon', 'fas fa-hiking')

@section('content')
    <div class="container-fluid px-0">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1" style="color: #1e2a2e;">
                    <i class="fas fa-mountain me-2" style="color: #e9b35f;"></i>
                    Treks
                </h4>
                <p class="text-muted small mb-0">
                    <i class="fas fa-database me-1"></i>
                    Total Treks: <strong>{{ $treks->total() }}</strong> |
                    <i class="fas fa-layer-group me-1 ms-2"></i>
                    Page: {{ $treks->currentPage() }} / {{ $treks->lastPage() }}
                </p>
            </div>

            <a href="{{ route('admin.treks.create') }}" class="btn"
                style="background: linear-gradient(135deg, #1e2a2e, #2c4a3e); color: white; border-radius: 40px; padding: 10px 24px;">
                <i class="fas fa-plus-circle me-2"></i> Add New Trek
            </a>
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
                                <th style="width: 120px;">Destination</th>
                                <th style="width: 130px;">Difficulty</th>
                                <th style="width: 80px;">Days</th>
                                <th style="width: 110px;">Price</th>
                                <th style="width: 120px;" class="text-center pe-4">Actions</th>
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($treks as $index => $trek)
                                <tr style="border-bottom: 1px solid #f0e2ce;">
                                    <td class="ps-4 fw-bold">
                                        {{ $treks->firstItem() + $index }}
                                    </td>
                                    <td>
                                        @if ($trek->featured_image)
                                            <img src="{{ asset('storage/' . $trek->featured_image) }}"
                                                alt="{{ $trek->name }}"
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
                                            <span class="fw-semibold" style="color: #1e2a2e;">{{ $trek->name }}</span>
                                            @if ($trek->slug)
                                                <br>
                                                <small class="text-muted" style="font-size: 0.7rem;">
                                                    <i class="fas fa-link"></i> {{ $trek->slug }}
                                                </small>
                                            @endif
                                        </div>
                                    </td>
                                    <td>
                                        @if ($trek->destination)
                                            <span class="badge"
                                                style="background: #e9b35f20; color: #b85c1a; border-radius: 20px; padding: 6px 12px;">
                                                <i class="fas fa-map-marker-alt me-1"></i> {{ $trek->destination->name }}
                                            </span>
                                        @else
                                            <span class="text-muted small">—</span>
                                        @endif
                                    </td>
                                    <td>
                                        @php
                                            $difficultyColors = [
                                                'Easy' => '#2ecc71',
                                                'Moderate' => '#f39c12',
                                                'Strenuous' => '#e67e22',
                                                'Extreme' => '#ef4444',
                                            ];
                                            $bgColor = $difficultyColors[$trek->difficulty] ?? '#95a5a6';
                                        @endphp
                                        <span class="badge px-3 py-2"
                                            style="background: {{ $bgColor }}; color: white; border-radius: 20px; min-width: 100px; display: inline-block;">
                                            <i class="fas fa-chart-line me-1"></i> {{ $trek->difficulty }}
                                        </span>
                                    </td>
                                    <td>
                                        <i class="far fa-calendar-alt me-1 text-muted"></i>
                                        <strong>{{ $trek->duration_days }}</strong> <span class="text-muted">Days</span>
                                    </td>
                                    <td>
                                        @if ($trek->price_usd)
                                            <div class="fw-bold" style="color: #b85c1a;">
                                                ${{ number_format($trek->price_usd, 2) }}
                                            </div>
                                            @if ($trek->group_size_min && $trek->group_size_max)
                                                <small class="text-muted" style="font-size: 0.7rem;">
                                                    <i class="fas fa-users"></i>
                                                    {{ $trek->group_size_min }}-{{ $trek->group_size_max }} pers.
                                                </small>
                                            @endif
                                        @else
                                            <span class="text-muted">—</span>
                                        @endif
                                    </td>
                                    <td class="text-center">
                                        <div class="btn-group" role="group" style="gap: 6px;">
                                            <a href="{{ route('admin.treks.show', $trek->id) }}" class="btn btn-sm"
                                                style="background: #0ea5e9; color: white; border-radius: 30px; padding: 6px 14px;"
                                                title="View Details">
                                                <i class="fas fa-eye"></i>
                                            </a>
                                            <a href="{{ route('admin.treks.edit', $trek->id) }}" class="btn btn-sm"
                                                style="background: #e9b35f; color: #1e2a2e; border-radius: 30px; padding: 6px 14px;"
                                                title="Edit">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                            <button type="button" class="btn btn-sm delete-trek"
                                                data-id="{{ $trek->id }}" data-name="{{ $trek->name }}"
                                                style="background: #ef4444; color: white; border-radius: 30px; padding: 6px 14px;"
                                                title="Delete">
                                                <i class="fas fa-trash-alt"></i>
                                            </button>
                                        </div>

                                        @if ($trek->is_featured || !$trek->is_active)
                                            <div class="mt-2">
                                                @if ($trek->is_featured)
                                                    <span class="badge"
                                                        style="background: #e9b35f; color: #1e2a2e; font-size: 0.7rem;">
                                                        <i class="fas fa-star"></i> Featured
                                                    </span>
                                                @endif
                                                @if (!$trek->is_active)
                                                    <span class="badge"
                                                        style="background: #95a5a6; color: white; font-size: 0.7rem;">
                                                        <i class="fas fa-eye-slash"></i> Inactive
                                                    </span>
                                                @endif
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center py-5">
                                        <i class="fas fa-mountain fa-4x text-muted mb-3 d-block"
                                            style="opacity: 0.5;"></i>
                                        <h5 class="text-muted">No treks found</h5>
                                        <p class="text-muted small">Add a new trek to get started</p>
                                        <a href="{{ route('admin.treks.create') }}" class="btn btn-sm"
                                            style="background: #1e2a2e; color: white; border-radius: 30px; margin-top: 10px;">
                                            <i class="fas fa-plus"></i> Add First Trek
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
        @if ($treks->hasPages())
            <div class="row mt-4">
                <div class="col-12">
                    <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 p-3 bg-white rounded-4 shadow-sm"
                        style="background: rgba(255,255,255,0.9);">
                        <div>
                            <i class="fas fa-info-circle" style="color: #e9b35f;"></i>
                            <span class="small text-muted">
                                Showing <strong>{{ $treks->firstItem() }}</strong> to
                                <strong>{{ $treks->lastItem() }}</strong>
                                of <strong>{{ $treks->total() }}</strong> total treks
                            </span>
                        </div>
                        <div>
                            {{ $treks->onEachSide(1)->links('pagination::bootstrap-5') }}
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
                        Remove Trek
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete <strong id="deleteTrekName"></strong>?</p>
                    <p class="text-muted small mb-0">This action cannot be undone.</p>
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
