{{-- resources/views/admin/destinations/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Destination')

@section('content')

    <div class="destination-page">

        {{-- Header --}}
        <div class="page-header">
            <div>
                <h2>Edit Destination</h2>
                <p>Update destination details and information</p>
            </div>

            <a href="{{ route('admin.destinations.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back
            </a>
        </div>

        {{-- Error Messages --}}
        @if ($errors->any())
            <div class="alert-box">
                <strong>Please fix the following errors:</strong>

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Form Card --}}
        <div class="form-card">

            <form action="{{ route('admin.destinations.update', $destination) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Basic Information --}}
                <div class="form-section">

                    <h4>Basic Information</h4>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Destination Name *</label>

                            <input type="text" name="name" id="name"
                                value="{{ old('name', $destination->name) }}" required>

                            @error('name')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Slug</label>

                            <input type="text" name="slug" id="slug"
                                value="{{ old('slug', $destination->slug) }}" placeholder="auto-generated">

                            @error('slug')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Short Description *</label>

                        <textarea name="short_description" id="short_description" rows="3" required>{{ old('short_description', $destination->short_description) }}</textarea>

                        <small id="charCounter">500 characters remaining</small>

                        @error('short_description')
                            <small class="error-text">{{ $message }}</small>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Description *</label>

                        <textarea name="description" rows="7" required>{{ old('description', $destination->description) }}</textarea>

                        @error('description')
                            <small class="error-text">{{ $message }}</small>
                        @enderror
                    </div>

                </div>

                {{-- Location Details --}}
                <div class="form-section">

                    <h4>Location Details</h4>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Location *</label>

                            <input type="text" name="location" value="{{ old('location', $destination->location) }}"
                                required>

                            @error('location')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Region</label>

                            <select name="region">

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
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Altitude</label>

                            <input type="text" name="altitude" value="{{ old('altitude', $destination->altitude) }}"
                                placeholder="e.g. 3,440m">

                            @error('altitude')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Best Season</label>

                            <input type="text" name="best_season"
                                value="{{ old('best_season', $destination->best_season) }}" placeholder="Spring, Autumn">

                            @error('best_season')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                </div>

                {{-- Images --}}
                <div class="form-section">

                    <h4>Images</h4>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Featured Image</label>

                            @if ($destination->featured_image)
                                <div class="preview-image">
                                    <img src="{{ asset('storage/' . $destination->featured_image) }}"
                                        alt="{{ $destination->name }}">
                                </div>
                            @endif

                            <input type="file" name="featured_image" accept="image/*">

                            @error('featured_image')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label>Gallery Images</label>

                            <input type="file" name="gallery_images[]" multiple accept="image/*">
                        </div>

                    </div>

                </div>

                {{-- Status --}}
                <div class="form-section">

                    <h4>Status Settings</h4>

                    <div class="form-grid">

                        <div class="checkbox-group">
                            <input type="checkbox" name="is_featured" value="1"
                                {{ old('is_featured', $destination->is_featured) ? 'checked' : '' }}>

                            <span>Featured Destination</span>
                        </div>

                        <div class="checkbox-group">
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $destination->is_active) ? 'checked' : '' }}>

                            <span>Active</span>
                        </div>

                        <div class="form-group">
                            <label>Sort Order</label>

                            <input type="number" name="sort_order" min="0"
                                value="{{ old('sort_order', $destination->sort_order) }}">

                            @error('sort_order')
                                <small class="error-text">{{ $message }}</small>
                            @enderror
                        </div>

                    </div>

                </div>

                {{-- Buttons --}}
                <div class="form-actions">

                    <a href="{{ route('admin.destinations.index') }}" class="cancel-btn">
                        Cancel
                    </a>

                    <button type="submit" class="submit-btn">
                        <i class="fas fa-save"></i>
                        Update Destination
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection

@push('styles')
    <style>
        .destination-page {
            padding: 20px;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-header h2 {
            margin: 0;
            font-size: 28px;
            color: #1e293b;
        }

        .page-header p {
            margin-top: 5px;
            color: #64748b;
        }

        .back-btn {
            background: #64748b;
            color: #fff;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
        }

        .back-btn:hover {
            opacity: .9;
            color: #fff;
        }

        .alert-box {
            background: #fee2e2;
            color: #991b1b;
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .form-card {
            background: #fff;
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .form-section {
            margin-bottom: 35px;
        }

        .form-section h4 {
            margin-bottom: 20px;
            color: #1e293b;
            border-bottom: 1px solid #e5e7eb;
            padding-bottom: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .form-group label {
            margin-bottom: 8px;
            font-weight: 600;
            color: #334155;
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            padding: 12px;
            border: 1px solid #d1d5db;
            border-radius: 10px;
            font-size: 14px;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: #eab308;
            box-shadow: 0 0 0 3px rgba(234, 179, 8, 0.15);
        }

        .preview-image {
            margin-bottom: 10px;
        }

        .preview-image img {
            width: 180px;
            height: 120px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #ddd;
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-top: 35px;
        }

        .error-text {
            color: #dc2626;
            margin-top: 5px;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .cancel-btn {
            background: #64748b;
            color: #fff;
            padding: 12px 20px;
            border-radius: 8px;
            text-decoration: none;
        }

        .submit-btn {
            background: #1e293b;
            color: #fff;
            border: none;
            padding: 12px 22px;
            border-radius: 8px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #0f172a;
        }

        @media(max-width:768px) {

            .form-card {
                padding: 20px;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .form-actions {
                flex-direction: column;
            }

            .submit-btn,
            .cancel-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        // Auto Generate Slug
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        if (nameInput && slugInput) {

            nameInput.addEventListener('keyup', function() {

                if (slugInput.value === '') {

                    slugInput.value = this.value
                        .toLowerCase()
                        .trim()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');
                }
            });
        }

        // Character Counter
        const shortDesc = document.getElementById('short_description');
        const charCounter = document.getElementById('charCounter');

        if (shortDesc && charCounter) {

            function updateCounter() {

                let remaining = 500 - shortDesc.value.length;

                charCounter.innerHTML = remaining + ' characters remaining';

                charCounter.style.color =
                    remaining < 0 ? 'red' : '#64748b';
            }

            shortDesc.addEventListener('input', updateCounter);

            updateCounter();
        }
    </script>
@endpush
