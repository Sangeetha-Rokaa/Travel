{{-- resources/views/admin/treks/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Create New Trek - Nepal Travel')
@section('page_title', 'Create New Trek')
@section('page_icon', 'fas fa-plus-circle')

@section('content')
    <div class="container-fluid px-0">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1" style="color: #1e2a2e;">
                    <i class="fas fa-hiking me-2" style="color: #e9b35f;"></i>
                    Add New Trek
                </h4>
                <p class="text-muted small mb-0">Create a new trekking package for your customers</p>
            </div>

            <a href="{{ route('admin.treks.index') }}" class="btn"
                style="background: #6c757d; color: white; border-radius: 40px; padding: 8px 20px;">
                <i class="fas fa-arrow-left me-2"></i> Back to Treks
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

                <form action="{{ route('admin.treks.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-12">
                            <h5 class="mb-3" style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-info-circle me-2"></i> Basic Information
                            </h5>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-semibold">Trek Name <span
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

                        <div class="col-md-6 mb-3">
                            <label for="destination_id" class="form-label fw-semibold">Destination</label>
                            <select class="form-select @error('destination_id') is-invalid @enderror" id="destination_id"
                                name="destination_id" style="border-radius: 12px; border: 1px solid #e0d5c0;">
                                <option value="">Select Destination</option>
                                @foreach ($destinations as $id => $name)
                                    <option value="{{ $id }}"
                                        {{ old('destination_id') == $id ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('destination_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="difficulty" class="form-label fw-semibold">Difficulty <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('difficulty') is-invalid @enderror" id="difficulty"
                                name="difficulty" required style="border-radius: 12px; border: 1px solid #e0d5c0;">
                                <option value="">Select Difficulty</option>
                                @foreach ($difficulties as $difficulty)
                                    <option value="{{ $difficulty }}"
                                        {{ old('difficulty') == $difficulty ? 'selected' : '' }}>
                                        {{ $difficulty }}
                                    </option>
                                @endforeach
                            </select>
                            @error('difficulty')
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

                        <!-- Trek Details -->
                        <div class="col-12 mt-3">
                            <h5 class="mb-3" style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-route me-2"></i> Trek Details
                            </h5>
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="duration_days" class="form-label fw-semibold">Duration (Days) <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('duration_days') is-invalid @enderror"
                                id="duration_days" name="duration_days" value="{{ old('duration_days') }}" required
                                min="1" style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('duration_days')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="max_altitude" class="form-label fw-semibold">Max Altitude</label>
                            <input type="text" class="form-control @error('max_altitude') is-invalid @enderror"
                                id="max_altitude" name="max_altitude" value="{{ old('max_altitude') }}"
                                placeholder="e.g., 5,364m" style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('max_altitude')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="start_point" class="form-label fw-semibold">Start Point <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('start_point') is-invalid @enderror"
                                id="start_point" name="start_point" value="{{ old('start_point') }}" required
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('start_point')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-3 mb-3">
                            <label for="end_point" class="form-label fw-semibold">End Point <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('end_point') is-invalid @enderror"
                                id="end_point" name="end_point" value="{{ old('end_point') }}" required
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('end_point')
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

                        <div class="col-md-6 mb-3">
                            <label for="price_usd" class="form-label fw-semibold">Price (USD)</label>
                            <input type="number" step="0.01"
                                class="form-control @error('price_usd') is-invalid @enderror" id="price_usd"
                                name="price_usd" value="{{ old('price_usd') }}" placeholder="e.g., 1499.00"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('price_usd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Group Size -->
                        <div class="col-12 mt-3">
                            <h5 class="mb-3"
                                style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-users me-2"></i> Group Size
                            </h5>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="group_size_min" class="form-label fw-semibold">Min Group Size</label>
                            <input type="number" class="form-control @error('group_size_min') is-invalid @enderror"
                                id="group_size_min" name="group_size_min" value="{{ old('group_size_min', 1) }}"
                                min="1" style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('group_size_min')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="group_size_max" class="form-label fw-semibold">Max Group Size</label>
                            <input type="number" class="form-control @error('group_size_max') is-invalid @enderror"
                                id="group_size_max" name="group_size_max" value="{{ old('group_size_max', 16) }}"
                                min="1" style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('group_size_max')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lists (Highlights, Included, Excluded, Required Gear) -->
                        <div class="col-12 mt-3">
                            <h5 class="mb-3"
                                style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-list-ul me-2"></i> Lists (One item per line)
                            </h5>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="highlights" class="form-label fw-semibold">Highlights</label>
                            <textarea class="form-control @error('highlights') is-invalid @enderror" id="highlights" name="highlights"
                                rows="5" style="border-radius: 12px; border: 1px solid #e0d5c0;"
                                placeholder="Amazing views of Mount Everest&#10;Visit ancient monasteries&#10;Experience Sherpa culture">{{ old('highlights') }}</textarea>
                            <small class="text-muted">One highlight per line</small>
                            @error('highlights')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="included" class="form-label fw-semibold">What's Included</label>
                            <textarea class="form-control @error('included') is-invalid @enderror" id="included" name="included"
                                rows="5" style="border-radius: 12px; border: 1px solid #e0d5c0;"
                                placeholder="Airport transfers&#10;Accommodation in teahouses&#10;All meals during trek">{{ old('included') }}</textarea>
                            <small class="text-muted">One item per line</small>
                            @error('included')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="excluded" class="form-label fw-semibold">What's Excluded</label>
                            <textarea class="form-control @error('excluded') is-invalid @enderror" id="excluded" name="excluded"
                                rows="5" style="border-radius: 12px; border: 1px solid #e0d5c0;"
                                placeholder="International flights&#10;Travel insurance&#10;Personal expenses">{{ old('excluded') }}</textarea>
                            <small class="text-muted">One item per line</small>
                            @error('excluded')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="required_gear" class="form-label fw-semibold">Required Gear</label>
                            <textarea class="form-control @error('required_gear') is-invalid @enderror" id="required_gear" name="required_gear"
                                rows="5" style="border-radius: 12px; border: 1px solid #e0d5c0;"
                                placeholder="Trekking boots&#10;Warm clothing layers&#10;Sleeping bag">{{ old('required_gear') }}</textarea>
                            <small class="text-muted">One item per line</small>
                            @error('required_gear')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Itinerary -->
                        <div class="col-12 mt-3">
                            <h5 class="mb-3"
                                style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-calendar-week me-2"></i> Itinerary
                            </h5>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="itinerary" class="form-label fw-semibold">Day-by-Day Itinerary</label>
                            <textarea class="form-control @error('itinerary') is-invalid @enderror" id="itinerary" name="itinerary"
                                rows="10" style="border-radius: 12px; border: 1px solid #e0d5c0;"
                                placeholder="Day 1: Arrive in Kathmandu (1,300m)&#10;Day 2: Fly to Lukla and trek to Phakding (2,652m) - 3-4 hours&#10;Day 3: Trek from Phakding to Namche Bazaar (3,440m) - 5-6 hours">{{ old('itinerary') }}</textarea>
                            <small class="text-muted">One day per line. Format: Day X: Description</small>
                            @error('itinerary')
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
                            <label for="featured_image" class="form-label fw-semibold">Featured Image</label>
                            <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                                id="featured_image" name="featured_image" accept="image/*"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            <small class="text-muted">Max 3MB. JPG, PNG, or GIF</small>
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gallery_images" class="form-label fw-semibold">Gallery Images</label>
                            <input type="file" class="form-control" id="gallery_images" name="gallery_images[]"
                                accept="image/*" multiple style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            <small class="text-muted">You can select multiple images</small>
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
                                    Feature this trek
                                </label>
                                <br>
                                <small class="text-muted">Featured treks appear on homepage</small>
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
                                <small class="text-muted">Inactive treks won't show on website</small>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="sort_order" class="form-label fw-semibold">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                id="sort_order" name="sort_order" value="{{ old('sort_order', 0) }}" min="0"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            <small class="text-muted">Lower numbers appear first</small>
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
                                <a href="{{ route('admin.treks.index') }}" class="btn"
                                    style="background: #6c757d; color: white; border-radius: 30px; padding: 10px 30px;">
                                    <i class="fas fa-times me-2"></i> Cancel
                                </a>
                                <button type="submit" class="btn"
                                    style="background: linear-gradient(135deg, #1e2a2e, #2c4a3e); color: white; border-radius: 30px; padding: 10px 30px;">
                                    <i class="fas fa-save me-2"></i> Create Trek
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
        document.getElementById('name').addEventListener('blur', function() {
            let slugField = document.getElementById('slug');
            if (slugField.value.trim() === '') {
                let name = this.value.trim().toLowerCase();
                let slug = name
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-');
                slugField.value = slug;
            }
        });

        // Character counter for short_description (optional)
        const shortDesc = document.getElementById('short_description');
        if (shortDesc) {
            shortDesc.addEventListener('input', function() {
                let remaining = 500 - this.value.length;
                let counter = document.querySelector('#short_description + small');
                if (counter && remaining < 0) {
                    counter.style.color = 'red';
                } else if (counter) {
                    counter.style.color = '#6c757d';
                }
            });
        }
    </script>
@endpush
