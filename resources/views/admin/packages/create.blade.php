{{-- resources/views/admin/packages/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Create Package')
@section('page_title', 'Create Package')
@section('page_icon', 'fas fa-plus')

@section('content')

    <div class="package-wrapper">

        <div class="page-header">
            <div>
                <h2>Create New Package</h2>
                <p>Add a new travel package</p>
            </div>

            <a href="{{ route('admin.packages.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
        </div>

        @if ($errors->any())
            <div class="alert-box error">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="form-card">

            <form action="{{ route('admin.packages.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                {{-- Basic Info --}}
                <div class="section-title">
                    <h3>Basic Information</h3>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Package Name *</label>
                        <input type="text" name="name" id="name" value="{{ old('name') }}">
                    </div>

                    <div class="form-group">
                        <label>Slug</label>
                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}">
                    </div>

                    <div class="form-group">
                        <label>Package Type *</label>

                        <select name="type">
                            <option value="">Select Type</option>

                            <option value="cultural">Cultural</option>
                            <option value="adventure">Adventure</option>
                            <option value="wildlife">Wildlife</option>
                            <option value="pilgrimage">Pilgrimage</option>
                            <option value="honeymoon">Honeymoon</option>
                            <option value="family">Family</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Duration Days *</label>
                        <input type="number" name="duration_days" value="{{ old('duration_days') }}">
                    </div>

                    <div class="form-group full-width">
                        <label>Short Description *</label>

                        <textarea name="short_description" rows="4">{{ old('short_description') }}</textarea>
                    </div>

                    <div class="form-group full-width">
                        <label>Description *</label>

                        <textarea name="description" rows="8">{{ old('description') }}</textarea>
                    </div>

                </div>

                {{-- Pricing --}}
                <div class="section-title">
                    <h3>Pricing Details</h3>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Price USD *</label>

                        <input type="number" step="0.01" name="price_usd" id="price_usd" value="{{ old('price_usd') }}">
                    </div>

                    <div class="form-group">
                        <label>Discounted Price</label>

                        <input type="number" step="0.01" name="price_usd_discounted" id="price_usd_discounted"
                            value="{{ old('price_usd_discounted') }}">
                    </div>

                    <div class="form-group">
                        <label>Max Group Size</label>

                        <input type="number" name="group_size_max" value="{{ old('group_size_max') }}">
                    </div>

                    <div class="form-group">
                        <label>Best Season</label>

                        <input type="text" name="best_season" value="{{ old('best_season') }}">
                    </div>

                    <div class="form-group">
                        <label>Sort Order</label>

                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}">
                    </div>

                </div>

                {{-- Package Details --}}
                <div class="section-title">
                    <h3>Package Details</h3>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Destinations Covered</label>

                        <textarea name="destinations_covered" rows="6">{{ old('destinations_covered') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Highlights</label>

                        <textarea name="highlights" rows="6">{{ old('highlights') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Included</label>

                        <textarea name="included" rows="6">{{ old('included') }}</textarea>
                    </div>

                    <div class="form-group">
                        <label>Excluded</label>

                        <textarea name="excluded" rows="6">{{ old('excluded') }}</textarea>
                    </div>

                </div>

                {{-- Itinerary --}}
                <div class="section-title">
                    <h3>Itinerary</h3>
                </div>

                <div class="form-group full-width">
                    <textarea name="itinerary" rows="10">{{ old('itinerary') }}</textarea>
                </div>

                {{-- Images --}}
                <div class="section-title">
                    <h3>Images</h3>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Featured Image *</label>

                        <input type="file" name="featured_image" accept="image/*">
                    </div>

                    <div class="form-group">
                        <label>Gallery Images</label>

                        <input type="file" name="gallery_images[]" multiple accept="image/*">
                    </div>

                </div>

                {{-- Status --}}
                <div class="section-title">
                    <h3>Status</h3>
                </div>

                <div class="checkbox-grid">

                    <label class="check-box">
                        <input type="checkbox" name="is_featured" value="1">

                        Featured Package
                    </label>

                    <label class="check-box">
                        <input type="checkbox" name="is_active" value="1" checked>

                        Active
                    </label>

                </div>

                {{-- Buttons --}}
                <div class="button-group">

                    <a href="{{ route('admin.packages.index') }}" class="cancel-btn">
                        Cancel
                    </a>

                    <button type="submit" class="submit-btn">
                        Create Package
                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection

@push('styles')
    <style>
        .package-wrapper {
            max-width: 1200px;
            margin: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
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
            background: #334155;
            color: #fff;
            padding: 10px 18px;
            border-radius: 6px;
            text-decoration: none;
        }

        .back-btn:hover {
            background: #0f172a;
            color: #fff;
        }

        .form-card {
            background: #fff;
            border-radius: 10px;
            padding: 30px;
            border: 1px solid #e2e8f0;
        }

        .section-title {
            margin-top: 25px;
            margin-bottom: 20px;
        }

        .section-title h3 {
            font-size: 18px;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
        }

        .full-width {
            grid-column: 1 / -1;
        }

        .form-group label {
            margin-bottom: 8px;
            font-weight: 600;
            color: #334155;
        }

        .form-group input,
        .form-group select,
        .form-group textarea {
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px;
            font-size: 14px;
            width: 100%;
        }

        .form-group input:focus,
        .form-group select:focus,
        .form-group textarea:focus {
            outline: none;
            border-color: #e9b35f;
            box-shadow: 0 0 0 3px rgba(233, 179, 95, 0.2);
        }

        textarea {
            resize: vertical;
        }

        .checkbox-grid {
            display: flex;
            gap: 30px;
            margin-top: 10px;
        }

        .check-box {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 500;
        }

        .button-group {
            display: flex;
            justify-content: flex-end;
            gap: 15px;
            margin-top: 35px;
        }

        .submit-btn {
            background: #1e293b;
            color: white;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #0f172a;
        }

        .cancel-btn {
            background: #e2e8f0;
            color: #1e293b;
            padding: 12px 24px;
            border-radius: 8px;
            text-decoration: none;
        }

        .cancel-btn:hover {
            background: #cbd5e1;
            color: #1e293b;
        }

        .alert-box {
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .alert-box.error {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
        }

        @media(max-width: 768px) {

            .form-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
                gap: 15px;
            }

            .button-group {
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
        // Auto slug generate
        const nameInput = document.getElementById('name');
        const slugInput = document.getElementById('slug');

        if (nameInput && slugInput) {

            nameInput.addEventListener('keyup', function() {

                if (slugInput.value === '') {

                    slugInput.value = this.value
                        .toLowerCase()
                        .replace(/[^a-z0-9 ]/g, '')
                        .replace(/\s+/g, '-');
                }
            });
        }

        // Discount validation
        const price = document.getElementById('price_usd');
        const discount = document.getElementById('price_usd_discounted');

        if (price && discount) {

            discount.addEventListener('change', function() {

                let mainPrice = parseFloat(price.value) || 0;
                let discountPrice = parseFloat(this.value) || 0;

                if (discountPrice >= mainPrice) {

                    alert('Discount price must be lower than original price');
                    this.value = '';
                }
            });
        }
    </script>
@endpush
