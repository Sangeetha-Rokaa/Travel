{{-- resources/views/admin/destinations/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Create Destination - Nepal Travel')
@section('page_title', 'Create New Destination')
@section('page_icon', 'fas fa-plus-circle')

@section('content')
    <div class="container-fluid px-0">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1" style="color: #1e2a2e;">
                    <i class="fas fa-map-marker-alt me-2" style="color: #e9b35f;"></i>
                    Add New Destination
                </h4>
                <p class="text-muted small mb-0">Create a new travel destination for your customers</p>
            </div>

            <a href="{{ route('admin.destinations.index') }}" class="btn"
                style="background: #6c757d; color: white; border-radius: 40px; padding: 8px 20px;">
                <i class="fas fa-arrow-left me-2"></i> Back to Destinations
            </a>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="border-radius: 16px; border-left: 4px solid #ef4444;">
                <i class="fas fa-exclamation-triangle me-2"></i>
                <strong>Please fix the following errors:</strong>
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 rounded-4 shadow-sm" style="background: white; border-radius: 28px !important;">
            <div class="card-body p-4">

                <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-12">
                            <h5 class="mb-3" style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-info-circle me-2"></i> Basic Information
                            </h5>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-semibold">Destination Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name') }}" required
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label fw-semibold">Slug (URL)</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug') }}" placeholder="auto-generated from name"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            <small class="text-muted">Leave empty to auto-generate from name</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="short_description" class="form-label fw-semibold">Short Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                name="short_description" rows="3" required style="border-radius: 12px; border: 1px solid #e0d5c0;">{{ old('short_description') }}</textarea>
                            <small class="text-muted">Brief summary (max 500 characters)</small>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label fw-semibold">Full Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="8" required style="border-radius: 12px; border: 1px solid #e0d5c0;">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Location Details -->
                        <div class="col-12 mt-3">
                            <h5 class="mb-3" style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-location-dot me-2"></i> Location Details
                            </h5>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="location" class="form-label fw-semibold">Location <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror"
                                id="location" name="location" value="{{ old('location') }}" required
                                placeholder="e.g., Solukhumbu, Nepal"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="region" class="form-label fw-semibold">Region</label>
                            <select class="form-select @error('region') is-invalid @enderror" id="region" name="region"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                                <option value="">Select Region</option>
                                <option value="Himalayas" {{ old('region') == 'Himalayas' ? 'selected' : '' }}>Himalayas
                                </option>
                                <option value="Hills" {{ old('region') == 'Hills' ? 'selected' : '' }}>Hills</option>
                                <option value="Terai" {{ old('region') == 'Terai' ? 'selected' : '' }}>Terai</option>
                                <option value="Kathmandu Valley"
                                    {{ old('region') == 'Kathmandu Valley' ? 'selected' : '' }}>Kathmandu Valley</option>
                                <option value="Annapurna Region"
                                    {{ old('region') == 'Annapurna Region' ? 'selected' : '' }}>Annapurna Region</option>
                                <option value="Everest Region" {{ old('region') == 'Everest Region' ? 'selected' : '' }}>
                                    Everest Region</option>
                                <option value="Langtang Region"
                                    {{ old('region') == 'Langtang Region' ? 'selected' : '' }}>Langtang Region</option>
                            </select>
                            @error('region')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="altitude" class="form-label fw-semibold">Altitude</label>
                            <input type="text" class="form-control @error('altitude') is-invalid @enderror"
                                id="altitude" name="altitude" value="{{ old('altitude') }}" placeholder="e.g., 3,440m"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('altitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="best_season" class="form-label fw-semibold">Best Season</label>
                            <input type="text" class="form-control @error('best_season') is-invalid @enderror"
                                id="best_season" name="best_season" value="{{ old('best_season') }}"
                                placeholder="e.g., Spring (Mar-May), Autumn (Sep-Nov)"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('best_season')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Images -->
                        <div class="col-12 mt-3">
                            <h5 class="mb-3"
                                style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-image me-2"></i> Images
                            </h5>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="featured_image" class="form-label fw-semibold">Featured Image <span
                                    class="text-danger">*</span></label>
                            <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                                id="featured_image" name="featured_image" accept="image/*" required
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            <small class="text-muted">Max 3MB. JPG, PNG, or GIF. Recommended size: 800x600px</small>
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gallery_images" class="form-label fw-semibold">Gallery Images</label>
                            <input type="file" class="form-control" id="gallery_images" name="gallery_images[]"
                                accept="image/*" multiple style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            <small class="text-muted">You can select multiple images for the gallery</small>
                        </div>

                        <!-- Status Settings -->
                        <div class="col-12 mt-3">
                            <h5 class="mb-3"
                                style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-toggle-on me-2"></i> Status Settings
                            </h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                    value="1" {{ old('is_featured') ? 'checked' : '' }}
                                    style="width: 40px; height: 20px;">
                                <label class="form-check-label fw-semibold ms-2" for="is_featured">
                                    Feature this destination
                                </label>
                                <br>
                                <small class="text-muted">Featured destinations appear on homepage</small>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', '1') ? 'checked' : '' }}
                                    style="width: 40px; height: 20px;">
                                <label class="form-check-label fw-semibold ms-2" for="is_active">
                                    Active
                                </label>
                                <br>
                                <small class="text-muted">Inactive destinations won't show on website</small>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="sort_order" class="form-label fw-semibold">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            <small class="text-muted">Lower numbers appear first in listings</small>
                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    <!-- Form Actions -->
                    <div class="row mt-4">
                        <div class="col-12">
                            <hr style="border-color: #f0e2ce;">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="{{ route('admin.destinations.index') }}" class="btn"
                                    style="background: #6c757d; color: white; border-radius: 30px; padding: 10px 30px;">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </a>
                                <button type="submit" class="btn"
                                    style="background: linear-gradient(135deg, #1e2a2e, #2c4a3e); color: white; border-radius: 30px; padding: 10px 30px;">
                                    <i class="fas fa-save me-2"></i> Create Destination
                                </button>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>
@endsection

@push('styles')
    <style>
        .form-label {
            color: #1e2a2e;
            margin-bottom: 8px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #e9b35f;
            box-shadow: 0 0 0 0.2rem rgba(233, 179, 95, 0.25);
        }

        textarea {
            resize: vertical;
        }

        .form-check-input:checked {
            background-color: #e9b35f;
            border-color: #e9b35f;
        }

        .form-check-input:focus {
            border-color: #e9b35f;
            box-shadow: 0 0 0 0.2rem rgba(233, 179, 95, 0.25);
        }

        .card {
            transition: transform 0.2s ease;
        }

        .alert ul {
            padding-left: 20px;
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Auto-generate slug from name
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        if (nameInput && slugInput) {
            nameInput.addEventListener('blur', function() {
                if (slugInput.value.trim() === '') {
                    let name = this.value.trim().toLowerCase();
                    let slug = name
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                    slugInput.value = slug;
                }
            });
        }

        // Character counter for short_description
        const shortDesc = document.getElementById('short_description');
        if (shortDesc) {
            const counter = document.createElement('small');
            counter.className = 'text-muted mt-1 d-block';
            counter.id = 'charCounter';
            shortDesc.parentNode.appendChild(counter);

            function updateCounter() {
                const remaining = 500 - shortDesc.value.length;
                counter.innerHTML = `${remaining} characters remaining (max 500)`;
                if (remaining < 0) {
                    counter.style.color = 'red';
                } else {
                    counter.style.color = '#6c757d';
                }
            }

            shortDesc.addEventListener('input', updateCounter);
            updateCounter();
        }
    </script>
@endpush
