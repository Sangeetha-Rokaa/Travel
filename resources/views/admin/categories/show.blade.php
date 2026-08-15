{{-- resources/views/admin/categories/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Category Details')
@section('page_title', 'Category Details')
@section('page_icon', 'fas fa-layer-group')

@section('content')

    <div class="category-wrapper">

        {{-- Header --}}
        <div class="page-header">

            <div>
                <h2>{{ $category->name }}</h2>
                <p>Category details and information</p>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.categories.edit', $category) }}" class="edit-btn">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>

                <a href="{{ route('admin.categories.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>

        </div>

        <div class="show-card">

            {{-- Image + Status --}}
            <div class="show-top">

                <div class="show-image">
                    @if ($category->image)
                        <img src="{{ Storage::url($category->image) }}" alt="{{ $category->name }}">
                    @else
                        <div class="no-image">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                </div>

                <div class="show-meta">

                    <span class="status-badge {{ $category->is_active ? 'active' : 'inactive' }}">
                        {{ $category->is_active ? 'Active' : 'Inactive' }}
                    </span>

                    <div class="meta-row">
                        <span class="meta-label">Slug</span>
                        <span class="meta-value">{{ $category->slug }}</span>
                    </div>

                    <div class="meta-row">
                        <span class="meta-label">Parent Category</span>
                        <span class="meta-value">
                            {{ $category->parent ? $category->parent->name : 'None (Top Level)' }}
                        </span>
                    </div>

                    <div class="meta-row">
                        <span class="meta-label">Created</span>
                        <span class="meta-value">{{ $category->created_at->format('M d, Y') }}</span>
                    </div>

                    <div class="meta-row">
                        <span class="meta-label">Last Updated</span>
                        <span class="meta-value">{{ $category->updated_at->format('M d, Y') }}</span>
                    </div>

                </div>

            </div>

            {{-- Description --}}
            <div class="section-title">
                <h3>Description</h3>
            </div>

            <div class="description-box">
                {{ $category->description ?: 'No description provided.' }}
            </div>

            {{-- Subcategories --}}
            @if ($category->children && $category->children->count())
                <div class="section-title">
                    <h3>Subcategories</h3>
                </div>

                <div class="subcategory-list">
                    @foreach ($category->children as $child)
                        <a href="{{ route('admin.categories.show', $child) }}" class="subcategory-chip">
                            {{ $child->name }}
                        </a>
                    @endforeach
                </div>
            @endif

            {{-- Products count if relation exists --}}
            @if (isset($category->products_count))
                <div class="section-title">
                    <h3>Products</h3>
                </div>

                <div class="description-box">
                    {{ $category->products_count }} product(s) in this category.
                </div>
            @endif

        </div>

    </div>

@endsection

@push('styles')
    <style>
        .category-wrapper {
            max-width: 1000px;
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

        .header-actions {
            display: flex;
            gap: 12px;
        }

        .edit-btn {
            background: #e9b35f;
            color: #1e293b;
            padding: 10px 18px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 600;
        }

        .edit-btn:hover {
            background: #dba236;
            color: #1e293b;
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

        .show-card {
            background: #fff;
            border-radius: 12px;
            padding: 30px;
            border: 1px solid #e2e8f0;
        }

        .show-top {
            display: grid;
            grid-template-columns: 220px 1fr;
            gap: 30px;
            align-items: start;
        }

        .show-image img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            border-radius: 10px;
            border: 1px solid #e2e8f0;
        }

        .no-image {
            width: 100%;
            height: 180px;
            border-radius: 10px;
            border: 1px dashed #cbd5e1;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #cbd5e1;
            font-size: 2rem;
        }

        .show-meta {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .status-badge {
            width: fit-content;
            padding: 6px 14px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 700;
        }

        .status-badge.active {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-badge.inactive {
            background: #fee2e2;
            color: #dc2626;
        }

        .meta-row {
            display: flex;
            justify-content: space-between;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 10px;
        }

        .meta-label {
            font-weight: 600;
            color: #64748b;
            font-size: 14px;
        }

        .meta-value {
            color: #1e293b;
            font-size: 14px;
        }

        .section-title {
            margin-top: 25px;
            margin-bottom: 15px;
        }

        .section-title h3 {
            font-size: 18px;
            color: #1e293b;
            border-bottom: 1px solid #e2e8f0;
            padding-bottom: 10px;
        }

        .description-box {
            color: #334155;
            line-height: 1.7;
            font-size: 14px;
        }

        .subcategory-list {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .subcategory-chip {
            background: #f1f5f9;
            color: #1e293b;
            padding: 8px 16px;
            border-radius: 20px;
            font-size: 13px;
            text-decoration: none;
            font-weight: 500;
        }

        .subcategory-chip:hover {
            background: #e2e8f0;
        }

        @media(max-width: 768px) {

            .show-top {
                grid-template-columns: 1fr;
            }

            .page-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .header-actions {
                width: 100%;
            }

            .edit-btn,
            .back-btn {
                flex: 1;
                text-align: center;
            }
        }
    </style>
@endpush
