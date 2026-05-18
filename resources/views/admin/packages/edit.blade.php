{{-- resources/views/admin/packages/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Package - ' . $package->name)
@section('page_title', 'Edit Travel Package')
@section('page_icon', 'fas fa-edit')

@section('content')
    <div class="container-fluid px-0">

        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <h4 class="mb-1" style="color: #1e2a2e;">
                    <i class="fas fa-suitcase-rolling me-2" style="color: #e9b35f;"></i>
                    Edit Package: {{ $package->name }}
                </h4>
                <p class="text-muted small mb-0">Update package details and information</p>
            </div>

            <div class="d-flex gap-2">
                <a href="{{ route('admin.packages.show', $package->id) }}" class="btn btn-info"
                    style="border-radius: 40px; padding: 8px 20px; color: white;">
                    <i class="fas fa-eye me-2"></i> View
                </a>
                <a href="{{ route('admin.packages.index') }}" class="btn"
                    style="background: #6c757d; color: white; border-radius: 40px; padding: 8px 20px;">
                    <i class="fas fa-arrow-left me-2"></i> Back to Packages
                </a>
            </div>
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

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="border-radius: 16px; border-left: 4px solid #10b981;">
                <i class="fas fa-check-circle me-2"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 rounded-4 shadow-sm" style="background: white; border-radius: 28px !important;">
            <div class="card-body p-4">

                <form action="{{ route('admin.packages.update', $package->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row">
                        <!-- Basic Information -->
                        <div class="col-12">
                            <h5 class="mb-3" style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-info-circle me-2"></i> Basic Information
                            </h5>
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label fw-semibold">Package Name <span
                                    class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                                name="name" value="{{ old('name', $package->name) }}" required
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="slug" class="form-label fw-semibold">Slug (URL)</label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug', $package->slug) }}"
                                placeholder="auto-generated from name"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            <small class="text-muted">Leave empty to auto-generate from name</small>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="type" class="form-label fw-semibold">Package Type <span
                                    class="text-danger">*</span></label>
                            <select class="form-select @error('type') is-invalid @enderror" id="type" name="type"
                                required style="border-radius: 12px; border: 1px solid #e0d5c0;">
                                <option value="">Select Package Type</option>
                                <option value="cultural" {{ old('type', $package->type) == 'cultural' ? 'selected' : '' }}>
                                    🏛️ Cultural</option>
                                <option value="adventure"
                                    {{ old('type', $package->type) == 'adventure' ? 'selected' : '' }}>🏔️ Adventure
                                </option>
                                <option value="wildlife" {{ old('type', $package->type) == 'wildlife' ? 'selected' : '' }}>
                                    🦁 Wildlife</option>
                                <option value="pilgrimage"
                                    {{ old('type', $package->type) == 'pilgrimage' ? 'selected' : '' }}>🕉️ Pilgrimage
                                </option>
                                <option value="honeymoon"
                                    {{ old('type', $package->type) == 'honeymoon' ? 'selected' : '' }}>💕 Honeymoon
                                </option>
                                <option value="family" {{ old('type', $package->type) == 'family' ? 'selected' : '' }}>
                                    👨‍👩‍👧‍👦 Family</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="duration_days" class="form-label fw-semibold">Duration (Days) <span
                                    class="text-danger">*</span></label>
                            <input type="number" class="form-control @error('duration_days') is-invalid @enderror"
                                id="duration_days" name="duration_days"
                                value="{{ old('duration_days', $package->duration_days) }}" required min="1"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('duration_days')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="short_description" class="form-label fw-semibold">Short Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('short_description') is-invalid @enderror" id="short_description"
                                name="short_description" rows="3" required style="border-radius: 12px; border: 1px solid #e0d5c0;">{{ old('short_description', $package->short_description) }}</textarea>
                            <small class="text-muted">Brief summary (max 500 characters)</small>
                            @error('short_description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="description" class="form-label fw-semibold">Full Description <span
                                    class="text-danger">*</span></label>
                            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                rows="8" required style="border-radius: 12px; border: 1px solid #e0d5c0;">{{ old('description', $package->description) }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Pricing Details -->
                        <div class="col-12 mt-3">
                            <h5 class="mb-3"
                                style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-tag me-2"></i> Pricing Details
                            </h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="price_usd" class="form-label fw-semibold">Price (USD) <span
                                    class="text-danger">*</span></label>
                            <input type="number" step="0.01"
                                class="form-control @error('price_usd') is-invalid @enderror" id="price_usd"
                                name="price_usd" value="{{ old('price_usd', $package->price_usd) }}" required
                                min="0" style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('price_usd')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="price_usd_discounted" class="form-label fw-semibold">Discounted Price
                                (USD)</label>
                            <input type="number" step="0.01"
                                class="form-control @error('price_usd_discounted') is-invalid @enderror"
                                id="price_usd_discounted" name="price_usd_discounted"
                                value="{{ old('price_usd_discounted', $package->price_usd_discounted) }}" min="0"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            <small class="text-muted">Leave empty if no discount</small>
                            @error('price_usd_discounted')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="group_size_max" class="form-label fw-semibold">Max Group Size</label>
                            <input type="number" class="form-control @error('group_size_max') is-invalid @enderror"
                                id="group_size_max" name="group_size_max"
                                value="{{ old('group_size_max', $package->group_size_max) }}" min="1"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('group_size_max')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="best_season" class="form-label fw-semibold">Best Season</label>
                            <input type="text" class="form-control @error('best_season') is-invalid @enderror"
                                id="best_season" name="best_season"
                                value="{{ old('best_season', $package->best_season) }}"
                                placeholder="e.g., Spring (Mar-May), Autumn (Sep-Nov)"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            @error('best_season')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="destinations_covered" class="form-label fw-semibold">Destinations Covered</label>
                            <textarea class="form-control @error('destinations_covered') is-invalid @enderror" id="destinations_covered"
                                name="destinations_covered" rows="3" style="border-radius: 12px; border: 1px solid #e0d5c0;"
                                placeholder="Kathmandu&#10;Pokhara&#10;Chitwan&#10;Lumbini">{{ old('destinations_covered', is_array($package->destinations_covered) ? implode("\n", $package->destinations_covered) : '') }}</textarea>
                            <small class="text-muted">One destination per line</small>
                            @error('destinations_covered')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Lists (Highlights, Included, Excluded) -->
                        <div class="col-12 mt-3">
                            <h5 class="mb-3"
                                style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-list-ul me-2"></i> Package Details (One item per line)
                            </h5>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="highlights" class="form-label fw-semibold">Highlights</label>
                            <textarea class="form-control @error('highlights') is-invalid @enderror" id="highlights" name="highlights"
                                rows="6" style="border-radius: 12px; border: 1px solid #e0d5c0;"
                                placeholder="Visit UNESCO World Heritage Sites&#10;Scenic mountain flights&#10;Traditional cultural shows">{{ old('highlights', is_array($package->highlights) ? implode("\n", $package->highlights) : '') }}</textarea>
                            <small class="text-muted">One highlight per line</small>
                            @error('highlights')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="included" class="form-label fw-semibold">What's Included</label>
                            <textarea class="form-control @error('included') is-invalid @enderror" id="included" name="included"
                                rows="6" style="border-radius: 12px; border: 1px solid #e0d5c0;"
                                placeholder="Airport transfers&#10;Accommodation in 3-4 star hotels&#10;Daily breakfast&#10;Private transportation">{{ old('included', is_array($package->included) ? implode("\n", $package->included) : '') }}</textarea>
                            <small class="text-muted">One item per line</small>
                            @error('included')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="excluded" class="form-label fw-semibold">What's Excluded</label>
                            <textarea class="form-control @error('excluded') is-invalid @enderror" id="excluded" name="excluded"
                                rows="6" style="border-radius: 12px; border: 1px solid #e0d5c0;"
                                placeholder="International flights&#10;Travel insurance&#10;Personal expenses&#10;Visa fees">{{ old('excluded', is_array($package->excluded) ? implode("\n", $package->excluded) : '') }}</textarea>
                            <small class="text-muted">One item per line</small>
                            @error('excluded')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Itinerary -->
                        <div class="col-12 mt-3">
                            <h5 class="mb-3"
                                style="color: #1e2a2e; border-left: 3px solid #e9b35f; padding-left: 12px;">
                                <i class="fas fa-calendar-week me-2"></i> Day-by-Day Itinerary
                            </h5>
                        </div>

                        <div class="col-md-12 mb-3">
                            <label for="itinerary" class="form-label fw-semibold">Itinerary</label>
                            <textarea class="form-control @error('itinerary') is-invalid @enderror" id="itinerary" name="itinerary"
                                rows="12" style="border-radius: 12px; border: 1px solid #e0d5c0;"
                                placeholder="Day 1: Arrive in Kathmandu (1,300m)&#10;Welcome to Nepal! Our representative will meet you at the airport and transfer to your hotel. Evening welcome dinner with cultural show.&#10;&#10;Day 2: Kathmandu Valley Sightseeing&#10;Visit UNESCO World Heritage Sites including Swayambhunath Stupa (Monkey Temple), Boudhanath Stupa, and Pashupatinath Temple.">{{ old('itinerary', is_array($package->itinerary) ? implode("\n\n", $package->itinerary) : '') }}</textarea>
                            <small class="text-muted">Format each day clearly. Use blank lines between days for better
                                readability.</small>
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

                            @if ($package->featured_image)
                                <div class="mb-2">
                                    <div class="position-relative d-inline-block">
                                        <img src="{{ asset('storage/' . $package->featured_image) }}"
                                            alt="Current featured image"
                                            style="width: 150px; height: 100px; object-fit: cover; border-radius: 8px;">
                                        <div class="position-absolute top-0 end-0">
                                            <button type="button" class="btn btn-sm btn-danger rounded-circle"
                                                onclick="removeImage('featured_image', {{ $package->id }})"
                                                style="width: 24px; height: 24px; padding: 0; font-size: 12px;">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <small class="text-muted d-block mt-1">Current featured image</small>
                                </div>
                            @endif

                            <input type="file" class="form-control @error('featured_image') is-invalid @enderror"
                                id="featured_image" name="featured_image" accept="image/*"
                                style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            <small class="text-muted">Max 3MB. JPG, PNG, or GIF. Leave empty to keep current image</small>
                            @error('featured_image')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="gallery_images" class="form-label fw-semibold">Gallery Images</label>

                            @if (is_array($package->gallery_images) && count($package->gallery_images))
                                <div class="mb-2">
                                    <div class="d-flex flex-wrap gap-2">
                                        @foreach ($package->gallery_images as $index => $image)
                                            <div class="position-relative">
                                                <img src="{{ asset('storage/' . $image) }}" alt="Gallery image"
                                                    style="width: 80px; height: 80px; object-fit: cover; border-radius: 6px;">
                                                <button type="button"
                                                    class="btn btn-sm btn-danger position-absolute top-0 end-0 rounded-circle"
                                                    onclick="removeGalleryImage({{ $package->id }}, {{ $index }})"
                                                    style="width: 20px; height: 20px; padding: 0; font-size: 10px;">
                                                    <i class="fas fa-times"></i>
                                                </button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <small class="text-muted d-block mt-1">{{ count($package->gallery_images) }} images in
                                        gallery</small>
                                </div>
                            @endif

                            <input type="file" class="form-control" id="gallery_images" name="gallery_images[]"
                                accept="image/*" multiple style="border-radius: 12px; border: 1px solid #e0d5c0;">
                            <small class="text-muted">Add more images to gallery (existing images will be kept)</small>
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
                                    value="1" {{ old('is_featured', $package->is_featured) ? 'checked' : '' }}
                                    style="width: 40px; height: 20px;">
                                <label class="form-check-label fw-semibold ms-2" for="is_featured">
                                    Feature this package
                                </label>
                                <br>
                                <small class="text-muted">Featured packages appear on homepage</small>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $package->is_active) ? 'checked' : '' }}
                                    style="width: 40px; height: 20px;">
                                <label class="form-check-label fw-semibold ms-2" for="is_active">
                                    Active
                                </label>
                                <br>
                                <small class="text-muted">Inactive packages won't show on website</small>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <label for="sort_order" class="form-label fw-semibold">Sort Order</label>
                            <input type="number" class="form-control @error('sort_order') is-invalid @enderror"
                                id="sort_order" name="sort_order" value="{{ old('sort_order', $package->sort_order) }}"
                                min="0" style="border-radius: 12px; border: 1px solid #e0d5c0;">
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
                            <div class="d-flex justify-content-between gap-2">
                                <button type="button" class="btn btn-danger"
                                    onclick="confirmDelete({{ $package->id }})"
                                    style="border-radius: 30px; padding: 10px 30px;">
                                    <i class="fas fa-trash me-2"></i> Delete Package
                                </button>
                                <div class="d-flex gap-2">
                                    <a href="{{ route('admin.packages.index') }}" class="btn"
                                        style="background: #6c757d; color: white; border-radius: 30px; padding: 10px 30px;">
                                        <i class="fas fa-times me-2"></i> Cancel
                                    </a>
                                    <button type="submit" class="btn"
                                        style="background: linear-gradient(135deg, #1e2a2e, #2c4a3e); color: white; border-radius: 30px; padding: 10px 30px;">
                                        <i class="fas fa-save me-2"></i> Update Package
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </form>

            </div>
        </div>

    </div>

    <!-- Delete Confirmation Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content" style="border-radius: 16px;">
                <div class="modal-header" style="border-bottom: 1px solid #e5e5e5;">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete the package <strong id="deletePackageName"></strong>?</p>
                    <p class="text-danger mb-0"><small>This action cannot be undone. All data associated with this package
                            will be permanently removed.</small></p>
                </div>
                <div class="modal-footer" style="border-top: 1px solid #e5e5e5;">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"
                        style="border-radius: 30px;">Cancel</button>
                    <form id="deleteForm" action="" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger" style="border-radius: 30px;">Delete
                            Package</button>
                    </form>
                </div>
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

        .btn-info {
            background: #0ea5e9;
            border: none;
        }

        .btn-info:hover {
            background: #0284c7;
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
                if (slugInput.value.trim() === '' || slugInput.value === '{{ $package->slug }}') {
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

        // Validate discounted price is less than regular price
        const priceInput = document.getElementById('price_usd');
        const discountedPriceInput = document.getElementById('price_usd_discounted');

        if (priceInput && discountedPriceInput) {
            discountedPriceInput.addEventListener('change', function() {
                const price = parseFloat(priceInput.value);
                const discounted = parseFloat(this.value);

                if (discounted && discounted >= price) {
                    alert('Discounted price should be less than the regular price');
                    this.value = '';
                }
            });
        }

        // Delete confirmation
        function confirmDelete(packageId) {
            const packageName = '{{ $package->name }}';
            document.getElementById('deletePackageName').textContent = packageName;
            document.getElementById('deleteForm').action = `/admin/packages/${packageId}`;
            new bootstrap.Modal(document.getElementById('deleteModal')).show();
        }

        // Remove featured image (AJAX)
        function removeImage(type, packageId) {
            if (confirm('Are you sure you want to remove this image?')) {
                fetch(`/admin/packages/${packageId}/remove-image`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            image_type: type
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Failed to remove image');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to remove image');
                    });
            }
        }

        // Remove gallery image (AJAX)
        function removeGalleryImage(packageId, index) {
            if (confirm('Are you sure you want to remove this gallery image?')) {
                fetch(`/admin/packages/${packageId}/remove-gallery-image`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            image_index: index
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Failed to remove image');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Failed to remove image');
                    });
            }
        }
    </script>
@endpush
