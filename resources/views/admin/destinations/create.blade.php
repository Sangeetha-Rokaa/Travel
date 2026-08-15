{{-- resources/views/admin/destinations/create.blade.php --}}
@extends('layouts.admin')

@section('title', 'Create Destination')
@section('page_title', 'Create Destination')
@section('page_icon', 'fas fa-map-marker-alt')

@section('content')

    <div class="destination-wrapper">

        {{-- Header --}}
        <div class="page-header">

            <div>
                <h2>Create New Destination</h2>
                <p>Add a new travel destination</p>
            </div>

            <a href="{{ route('admin.destinations.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i>
                Back
            </a>

        </div>

        {{-- Errors --}}
        @if ($errors->any())
            <div class="alert-box">

                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            </div>
        @endif

        {{-- Form Card --}}
        <div class="form-card">

            <form action="{{ route('admin.destinations.store') }}" method="POST" enctype="multipart/form-data">

                @csrf

                {{-- Basic Information --}}
                <div class="section-title">
                    <h3>Basic Information</h3>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Destination Name *</label>

                        <input type="text" name="name" id="name" value="{{ old('name') }}" required>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>

                        <input type="text" name="slug" id="slug" value="{{ old('slug') }}"
                            placeholder="auto-generated">
                    </div>

                    <div class="form-group full-width">
                        <label>Short Description *</label>

                        <textarea name="short_description" id="short_description" rows="4" required>{{ old('short_description') }}</textarea>

                        <small id="charCounter">500 characters remaining</small>
                    </div>

                    <div class="form-group full-width">
                        <label>Full Description *</label>

                        <textarea name="description" rows="8" required>{{ old('description') }}</textarea>
                    </div>

                </div>

                {{-- Location Details --}}
                <div class="section-title">
                    <h3>Location Details</h3>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Location *</label>

                        <input type="text" name="location" value="{{ old('location') }}"
                            placeholder="e.g. Pokhara, Nepal" required>
                    </div>

                    <div class="form-group">
                        <label>Region</label>

                        <select name="region">

                            <option value="">Select Region</option>

                            <option value="Himalayas">Himalayas</option>
                            <option value="Hills">Hills</option>
                            <option value="Terai">Terai</option>
                            <option value="Kathmandu Valley">Kathmandu Valley</option>
                            <option value="Annapurna Region">Annapurna Region</option>
                            <option value="Everest Region">Everest Region</option>
                            <option value="Langtang Region">Langtang Region</option>

                        </select>
                    </div>

                    <div class="form-group">
                        <label>Altitude</label>

                        <input type="text" name="altitude" value="{{ old('altitude') }}" placeholder="e.g. 3440m">
                    </div>

                    <div class="form-group">
                        <label>Best Season</label>

                        <input type="text" name="best_season" value="{{ old('best_season') }}"
                            placeholder="Spring, Autumn">
                    </div>

                </div>

                {{-- Images --}}
                <div class="section-title">
                    <h3>Images</h3>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Featured Image *</label>

                        <input type="file" name="featured_image" accept="image/*" required>
                    </div>

                    <div class="form-group">
                        <label>Gallery Images</label>

                        <input type="file" name="gallery_images[]" multiple accept="image/*">
                    </div>

                </div>

                {{-- Status --}}
                <div class="section-title">
                    <h3>Status Settings</h3>
                </div>

                <div class="checkbox-grid">

                    <label class="check-box">
                        <input type="checkbox" name="is_featured" value="1">

                        Featured Destination
                    </label>

                    <label class="check-box">
                        <input type="checkbox" name="is_active" value="1" checked>

                        Active
                    </label>

                </div>

                <div class="form-grid mt-20">

                    <div class="form-group">
                        <label>Sort Order</label>

                        <input type="number" name="sort_order" value="{{ old('sort_order', 0) }}">
                    </div>

                </div>

                {{-- Buttons --}}
                <div class="button-group">

                    <a href="{{ route('admin.destinations.index') }}" class="cancel-btn">
                        Cancel
                    </a>

                    <button type="submit" class="submit-btn">

                        <i class="fas fa-save"></i>
                        Create Destination

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection

@push('styles')
    <style>
        .destination-wrapper {
            max-width: 1200px;
            margin: auto;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            gap: 20px;
        }

        .page-header h2 {
            font-size: 28px;
            color: #1e293b;
            margin: 0;
        }

        .page-header p {
            margin-top: 5px;
            color: #64748b;
        }

        .back-btn {
            background: #475569;
            color: white;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
        }

        .back-btn:hover {
            background: #334155;
            color: white;
        }

        .form-card {
            background: #fff;
            border-radius: 12px;
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

        .full-width {
            grid-column: 1 / -1;
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
        .form-group select,
        .form-group textarea {
            width: 100%;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            padding: 12px;
            font-size: 14px;
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

        #charCounter {
            margin-top: 6px;
            font-size: 13px;
            color: #64748b;
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
            color: #1e293b;
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
            padding: 12px 22px;
            border-radius: 8px;
            cursor: pointer;
        }

        .submit-btn:hover {
            background: #0f172a;
        }

        .cancel-btn {
            background: #e2e8f0;
            color: #1e293b;
            padding: 12px 22px;
            border-radius: 8px;
            text-decoration: none;
        }

        .cancel-btn:hover {
            background: #cbd5e1;
            color: #1e293b;
        }

        .alert-box {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #991b1b;
            padding: 16px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-box ul {
            margin: 0;
            padding-left: 20px;
        }

        .mt-20 {
            margin-top: 20px;
        }

        @media(max-width: 768px) {

            .form-grid {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .checkbox-grid {
                flex-direction: column;
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

        // Character counter
        const shortDesc = document.getElementById('short_description');
        const counter = document.getElementById('charCounter');

        if (shortDesc && counter) {

            function updateCounter() {

                let remaining = 500 - shortDesc.value.length;

                counter.innerHTML = remaining + ' characters remaining';

                if (remaining < 0) {
                    counter.style.color = 'red';
                } else {
                    counter.style.color = '#64748b';
                }
            }

            shortDesc.addEventListener('input', updateCounter);

            updateCounter();
        }
    </script>
@endpush
