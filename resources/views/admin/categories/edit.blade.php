{{-- resources/views/admin/categories/edit.blade.php --}}
@extends('layouts.admin')

@section('title', 'Edit Category')
@section('page_title', 'Edit Category')
@section('page_icon', 'fas fa-layer-group')

@section('content')

    <div class="category-wrapper">

        {{-- Header --}}
        <div class="page-header">

            <div>
                <h2>Edit Category</h2>
                <p>Update trekking gear category details</p>
            </div>

            <a href="{{ route('admin.categories.index') }}" class="back-btn">
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

            <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">

                @csrf
                @method('PUT')

                {{-- Basic Information --}}
                <div class="section-title">
                    <h3>Basic Information</h3>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Category Name *</label>

                        <input type="text" name="name" id="name" value="{{ old('name', $category->name) }}"
                            required>
                    </div>

                    <div class="form-group">
                        <label>Slug</label>

                        <input type="text" name="slug" id="slug" value="{{ old('slug', $category->slug) }}">
                    </div>

                    <div class="form-group full-width">
                        <label>Description</label>

                        <textarea name="description" rows="6">{{ old('description', $category->description) }}</textarea>
                    </div>

                </div>

                {{-- Hierarchy --}}
                <div class="section-title">
                    <h3>Hierarchy</h3>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Parent Category</label>

                        <select name="parent_id">

                            <option value="">None (Top Level)</option>

                            @foreach ($categories as $cat)
                                @if ($cat->id !== $category->id)
                                    <option value="{{ $cat->id }}"
                                        {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->name }}
                                    </option>
                                @endif
                            @endforeach

                        </select>
                    </div>

                </div>

                {{-- Image --}}
                <div class="section-title">
                    <h3>Image</h3>
                </div>

                <div class="form-grid">

                    <div class="form-group">
                        <label>Category Image</label>

                        <input type="file" name="image" accept="image/*">

                        @if ($category->image)
                            <div class="current-image">
                                <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                                <span>Current image</span>
                            </div>
                        @endif
                    </div>

                </div>

                {{-- Status --}}
                <div class="section-title">
                    <h3>Status Settings</h3>
                </div>

                <div class="checkbox-grid">

                    <label class="check-box">
                        <input type="checkbox" name="is_active" value="1"
                            {{ old('is_active', $category->is_active) ? 'checked' : '' }}>

                        Active
                    </label>

                </div>

                {{-- Buttons --}}
                <div class="button-group">

                    <a href="{{ route('admin.categories.index') }}" class="cancel-btn">
                        Cancel
                    </a>

                    <button type="submit" class="submit-btn">

                        <i class="fas fa-save"></i>
                        Update Category

                    </button>

                </div>

            </form>

        </div>

    </div>

@endsection

@push('styles')
    <style>
        .category-wrapper {
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

        .current-image {
            margin-top: 12px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .current-image img {
            width: 70px;
            height: 70px;
            object-fit: cover;
            border-radius: 8px;
            border: 1px solid #e2e8f0;
        }

        .current-image span {
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
        // Auto slug generate only if user clears it
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
    </script>
@endpush
