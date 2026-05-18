{{-- resources/views/admin/destinations/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Destination - Nepal Travel')
@section('page_title', 'Edit Destination')
@section('page_icon', 'fas fa-edit')

@section('content')
    <div class="container-fluid px-0">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1" style="color: #1e2a2e;">
                    <i class="fas fa-pen-to-square me-2" style="color: #e9b35f;"></i>
                    Edit Destination
                </h4>
                <p class="text-muted small mb-0">
                    Update destination information and settings
                </p>
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

                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        <div class="card border-0 rounded-4 shadow-sm" style="background: white; border-radius: 28px !important;">

            <div class="card-body p-4">

                <form action="{{ route('admin.destinations.update', $destination->id) }}" method="POST"
                    enctype="multipart/form-data">

                    @csrf
                    @method('PUT')

                    <div class="row">

                        {{-- BASIC INFORMATION --}}
                        <div class="col-12">
                            <h5 class="mb-3" style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-info-circle me-2"></i>
                                Basic Information
                            </h5>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Destination Name <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="name" id="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $destination->name) }}" required
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Slug (URL)
                            </label>

                            <input type="text" name="slug" id="slug"
                                class="form-control @error('slug') is-invalid @enderror"
                                value="{{ old('slug', $destination->slug) }}"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">

                            <small class="text-muted">
                                Leave empty to auto-generate from name
                            </small>

                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">
                                Short Description <span class="text-danger">*</span>
                            </label>

                            <textarea name="short_description" id="short_description" rows="3" required
                                class="form-control @error('short_description') is-invalid @enderror"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">{{ old('short_description', $destination->short_description) }}</textarea>

                            <small class="text-muted">
                                Brief summary (max 500 characters)
                            </small>

                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label class="form-label fw-semibold">
                                Full Description <span class="text-danger">*</span>
                            </label>

                            <textarea name="description" id="description" rows="8" required
                                class="form-control @error('description') is-invalid @enderror"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">{{ old('description', $destination->description) }}</textarea>

                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- LOCATION DETAILS --}}
                        <div class="col-12 mt-3">
                            <h5 class="mb-3" style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-location-dot me-2"></i>
                                Location Details
                            </h5>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Location <span class="text-danger">*</span>
                            </label>

                            <input type="text" name="location"
                                class="form-control @error('location') is-invalid @enderror"
                                value="{{ old('location', $destination->location) }}" required
                                placeholder="e.g., Solukhumbu, Nepal"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">

                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Region
                            </label>

                            <select name="region" class="form-select @error('region') is-invalid @enderror"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">

                                <option value="">Select Region</option>

                                @php
                                    $regions = [
                                        'Himalayas',
                                        'Hills',
                                        'Terai',
                                        'Kathmandu Valley',
                                        'Annapurna Region',
                                        'Everest Region',
                                        'Langtang Region',
                                    ];
                                @endphp

                                @foreach ($regions as $region)
                                    <option value="{{ $region }}"
                                        {{ old('region', $destination->region) == $region ? 'selected' : '' }}>
                                        {{ $region }}
                                    </option>
                                @endforeach

                            </select>

                            @error('region')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Altitude
                            </label>

                            <input type="text" name="altitude"
                                class="form-control @error('altitude') is-invalid @enderror"
                                value="{{ old('altitude', $destination->altitude) }}" placeholder="e.g., 3,440m"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">

                            @error('altitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Best Season
                            </label>

                            <input type="text" name="best_season"
                                class="form-control @error('best_season') is-invalid @enderror"
                                value="{{ old('best_season', $destination->best_season) }}"
                                placeholder="e.g., Spring (Mar-May), Autumn (Sep-Nov)"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">

                            @error('best_season')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        {{-- IMAGES --}}
                        <div class="col-12 mt-3">
                            <h5 class="mb-3"
                                style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-image me-2"></i>
                                Images
                            </h5>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Featured Image
                            </label>

                            <input type="file" name="featured_image" accept="image/*"
                                class="form-control @error('featured_image') is-invalid @enderror"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">

                            <small class="text-muted">
                                Leave empty to keep current image
                            </small>

                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                            @if ($destination->featured_image)
                                <div class="mt-3">
                                    <img src="{{ asset('storage/' . $destination->featured_image) }}"
                                        alt="{{ $destination->name }}" class="img-fluid rounded-3 shadow-sm"
                                        style="height: 150px; object-fit: cover;">
                                </div>
                            @endif
                        </div>

                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-semibold">
                                Gallery Images
                            </label>

                            <input type="file" name="gallery_images[]" multiple accept="image/*" class="form-control"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">

                            <small class="text-muted">
                                You can upload multiple new gallery images
                            </small>
                        </div>

                        {{-- STATUS SETTINGS --}}
                        <div class="col-12 mt-3">
                            <h5 class="mb-3"
                                style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-toggle-on me-2"></i>
                                Status Settings
                            </h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                    value="1" {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }}
                                    style="width: 40px; height: 20px;">

                                <label class="form-check-label fw-semibold ms-2">
                                    Feature this destination
                                </label>

                                <br>

                                <small class="text-muted">
                                    Featured destinations appear on homepage
                                </small>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $destination->is_active) ? 'checked' : '' }}
                                    style="width: 40px; height: 20px;">

                                <label class="form-check-label fw-semibold ms-2">
                                    Active
                                </label>

                                <br>

                                <small class="text-muted">
                                    Inactive destinations won't show on website
                                </small>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label class="form-label fw-semibold">
                                Sort Order
                            </label>

                            <input type="number" name="sort_order" min="0"
                                class="form-control @error('sort_order') is-invalid @enderror"
                                value="{{ old('sort_order', $destination->sort_order) }}"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">

                            <small class="text-muted">
                                Lower numbers appear first
                            </small>

                            @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                    </div>

                    {{-- FORM ACTIONS --}}
                    <div class="row mt-4">
                        <div class="col-12">

                            <hr style="border-color: #f0e2ce;">

                            <div class="d-flex justify-content-end gap-2">

                                <a href="{{ route('admin.destinations.index') }}" class="btn"
                                    style="background: #6c757d; color: white; border-radius: 30px; padding: 10px 30px;">

                                    <i class="fas fa-times me-2"></i>
                                    Cancel
                                </a>

                                <button type="submit" class="btn"
                                    style="background: linear-gradient(135deg, #1e2a2e, #2c4a3e); color: white; border-radius: 30px; padding: 10px 30px;">

                                    <i class="fas fa-save me-2"></i>
                                    Update Destination
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
        // Auto generate slug
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        if (nameInput && slugInput) {
            nameInput.addEventListener('blur', function() {

                if (slugInput.value.trim() === '') {

                    let slug = this.value
                        .trim()
                        .toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');

                    slugInput.value = slug;
                }
            });
        }

        // Character counter
        const shortDesc = document.getElementById('short_description');

        if (shortDesc) {

            const counter = document.createElement('small');

            counter.className = 'text-muted mt-1 d-block';
            counter.id = 'charCounter';

            shortDesc.parentNode.appendChild(counter);

            function updateCounter() {

                const remaining = 500 - shortDesc.value.length;

                counter.innerHTML =
                    `${remaining} characters remaining (max 500)`;

                counter.style.color = remaining < 0 ? 'red' : '#6c757d';
            }

            shortDesc.addEventListener('input', updateCounter);

            updateCounter();
        }
    </script>
@endpush
