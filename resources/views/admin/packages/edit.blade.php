{{-- resources/views/admin/packages/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Package')

@section('content')
    <div class="package-wrapper">

        {{-- Page Header --}}
        <div class="page-header">
            <div>
                <h2>Edit Package</h2>
                <p>Update travel package information</p>
            </div>

            <a href="{{ route('admin.packages.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="alert alert-danger">
                <strong>Please fix the following:</strong>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        {{-- Success --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        {{-- Form --}}
        <div class="form-card">
            <form action="{{ route('admin.packages.update', $package) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Basic Info --}}
                <div class="section">
                    <h3>Basic Information</h3>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Package Name</label>
                            <input type="text" name="name" value="{{ old('name', $package->name) }}">
                        </div>

                        <div class="form-group">
                            <label>Slug</label>
                            <input type="text" name="slug" id="slug" value="{{ old('slug', $package->slug) }}">
                        </div>

                        <div class="form-group">
                            <label>Package Type</label>

                            <select name="type">
                                <option value="cultural" {{ old('type', $package->type) == 'cultural' ? 'selected' : '' }}>
                                    Cultural
                                </option>

                                <option value="adventure"
                                    {{ old('type', $package->type) == 'adventure' ? 'selected' : '' }}>
                                    Adventure
                                </option>

                                <option value="wildlife" {{ old('type', $package->type) == 'wildlife' ? 'selected' : '' }}>
                                    Wildlife
                                </option>

                                <option value="honeymoon"
                                    {{ old('type', $package->type) == 'honeymoon' ? 'selected' : '' }}>
                                    Honeymoon
                                </option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label>Duration (Days)</label>

                            <input type="number" name="duration_days"
                                value="{{ old('duration_days', $package->duration_days) }}">
                        </div>

                    </div>

                    <div class="form-group">
                        <label>Short Description</label>

                        <textarea name="short_description" rows="4">{{ old('short_description', $package->short_description) }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Full Description</label>

                        <textarea name="description" rows="6">{{ old('description', $package->description) }}</textarea>
                    </div>
                </div>

                {{-- Pricing --}}
                <div class="section">
                    <h3>Pricing Details</h3>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Price USD</label>

                            <input type="number" step="0.01" name="price_usd"
                                value="{{ old('price_usd', $package->price_usd) }}">
                        </div>

                        <div class="form-group">
                            <label>Discount Price</label>

                            <input type="number" step="0.01" name="price_usd_discounted"
                                value="{{ old('price_usd_discounted', $package->price_usd_discounted) }}">
                        </div>

                        <div class="form-group">
                            <label>Group Size</label>

                            <input type="number" name="group_size_max"
                                value="{{ old('group_size_max', $package->group_size_max) }}">
                        </div>

                    </div>
                </div>

                {{-- Highlights --}}
                <div class="section">
                    <h3>Package Details</h3>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Highlights</label>

                            <textarea name="highlights" rows="6">{{ old('highlights', is_array($package->highlights) ? implode("\n", $package->highlights) : '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Included</label>

                            <textarea name="included" rows="6">{{ old('included', is_array($package->included) ? implode("\n", $package->included) : '') }}</textarea>
                        </div>

                        <div class="form-group">
                            <label>Excluded</label>

                            <textarea name="excluded" rows="6">{{ old('excluded', is_array($package->excluded) ? implode("\n", $package->excluded) : '') }}</textarea>
                        </div>

                    </div>
                </div>

                {{-- Itinerary --}}
                <div class="section">
                    <h3>Itinerary</h3>

                    <div class="form-group">
                        <textarea name="itinerary" rows="10">{{ old('itinerary', is_array($package->itinerary) ? implode("\n\n", $package->itinerary) : '') }}</textarea>
                    </div>
                </div>

                {{-- Images --}}
                <div class="section">
                    <h3>Images</h3>

                    <div class="form-grid">

                        <div class="form-group">
                            <label>Featured Image</label>

                            @if ($package->featured_image)
                                <img src="{{ asset('storage/' . $package->featured_image) }}" class="preview-image">
                            @endif

                            <input type="file" name="featured_image">
                        </div>

                        <div class="form-group">
                            <label>Gallery Images</label>

                            <input type="file" name="gallery_images[]" multiple>
                        </div>

                    </div>
                </div>

                {{-- Status --}}
                <div class="section">
                    <h3>Status</h3>

                    <div class="checkbox-group">
                        <label>
                            <input type="checkbox" name="is_featured" value="1"
                                {{ old('is_featured', $package->is_featured) ? 'checked' : '' }}>
                            Featured Package
                        </label>

                        <label>
                            <input type="checkbox" name="is_active" value="1"
                                {{ old('is_active', $package->is_active) ? 'checked' : '' }}>
                            Active
                        </label>
                    </div>
                </div>

                {{-- Buttons --}}
                <div class="form-actions">

                    <a href="{{ route('admin.packages.index') }}" class="cancel-btn">
                        Cancel
                    </a>

                    <button type="submit" class="save-btn">
                        <i class="fas fa-save"></i> Update Package
                    </button>

                </div>

            </form>
        </div>
    </div>
@endsection

@push('styles')
    <style>
        body {
            background: #f4f6f9;
        }

        .package-wrapper {
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
            margin: 5px 0 0;
            color: #64748b;
        }

        .back-btn {
            background: #fff;
            border: 1px solid #ddd;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            color: #333;
        }

        .form-card {
            background: #fff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .section {
            margin-bottom: 35px;
        }

        .section h3 {
            margin-bottom: 20px;
            color: #1e293b;
            font-size: 20px;
            border-bottom: 1px solid #eee;
            padding-bottom: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 600;
            color: #374151;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            width: 100%;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            padding: 12px;
            font-size: 14px;
            outline: none;
            transition: 0.3s;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            border-color: #0f172a;
        }

        textarea {
            resize: vertical;
        }

        .preview-image {
            width: 160px;
            border-radius: 8px;
            margin-bottom: 10px;
            display: block;
        }

        .checkbox-group {
            display: flex;
            gap: 25px;
            flex-wrap: wrap;
        }

        .checkbox-group label {
            font-weight: 500;
            color: #374151;
        }

        .form-actions {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 30px;
        }

        .save-btn {
            background: #1e293b;
            color: white;
            border: none;
            padding: 12px 22px;
            border-radius: 8px;
            cursor: pointer;
        }

        .save-btn:hover {
            background: #0f172a;
        }

        .cancel-btn {
            background: #e5e7eb;
            color: #111827;
            text-decoration: none;
            padding: 12px 22px;
            border-radius: 8px;
        }

        .alert {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-danger {
            background: #fee2e2;
            color: #991b1b;
        }

        .alert-success {
            background: #dcfce7;
            color: #166534;
        }

        @media (max-width: 768px) {
            .form-card {
                padding: 20px;
            }

            .form-actions {
                flex-direction: column;
            }

            .save-btn,
            .cancel-btn {
                width: 100%;
                text-align: center;
            }
        }
    </style>
@endpush

@push('scripts')
    <script>
        const nameInput = document.querySelector('input[name="name"]');
        const slugInput = document.getElementById('slug');

        if (nameInput && slugInput) {
            nameInput.addEventListener('keyup', function() {

                if (slugInput.value === '') {

                    slugInput.value = this.value
                        .toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-');

                }

            });
        }
    </script>
@endpush
