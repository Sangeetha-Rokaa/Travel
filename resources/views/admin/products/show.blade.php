{{-- resources/views/admin/products/show.blade.php --}}
@extends('layouts.admin')

@section('title', 'Product Details')
@section('page_title', 'Product Details')
@section('page_icon', 'fas fa-box')

@section('content')

    <div class="product-wrapper">

        {{-- Header --}}
        <div class="page-header">

            <div>
                <h2>{{ $product->name }}</h2>
                <p>Product details and information</p>
            </div>

            <div class="header-actions">
                <a href="{{ route('admin.products.edit', $product) }}" class="edit-btn">
                    <i class="fas fa-edit"></i>
                    Edit
                </a>

                <a href="{{ route('admin.products.index') }}" class="back-btn">
                    <i class="fas fa-arrow-left"></i>
                    Back
                </a>
            </div>

        </div>

        <div class="show-card">

            {{-- Image + Status --}}
            <div class="show-top">

                <div class="show-image">
                    @if ($product->image)
                        <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}">
                    @else
                        <div class="no-image">
                            <i class="fas fa-image"></i>
                        </div>
                    @endif
                </div>

                <div class="show-meta">

                    <div class="badge-row">
                        <span class="status-badge {{ $product->is_active ? 'active' : 'inactive' }}">
                            {{ $product->is_active ? 'Active' : 'Inactive' }}
                        </span>

                        <span class="status-badge {{ $product->stock > 0 ? 'active' : 'inactive' }}">
                            {{ $product->stock > 0 ? 'In Stock' : 'Out of Stock' }}
                        </span>
                    </div>

                    <div class="meta-row">
                        <span class="meta-label">Slug</span>
                        <span class="meta-value">{{ $product->slug }}</span>
                    </div>

                    <div class="meta-row">
                        <span class="meta-label">Category</span>
                        <span class="meta-value">{{ $product->category->name ?? '—' }}</span>
                    </div>

                    <div class="meta-row">
                        <span class="meta-label">SKU</span>
                        <span class="meta-value">{{ $product->sku ?: '—' }}</span>
                    </div>

                    <div class="meta-row">
                        <span class="meta-label">Price</span>
                        <span class="meta-value">
                            @if ($product->sale_price)
                                <span class="old-price">${{ number_format($product->price, 2) }}</span>
                                ${{ number_format($product->sale_price, 2) }}
                            @else
                                ${{ number_format($product->price, 2) }}
                            @endif
                        </span>
                    </div>

                    <div class="meta-row">
                        <span class="meta-label">Stock Quantity</span>
                        <span class="meta-value">{{ $product->stock }}</span>
                    </div>

                    <div class="meta-row">
                        <span class="meta-label">Created</span>
                        <span class="meta-value">{{ $product->created_at->format('M d, Y') }}</span>
                    </div>

                    <div class="meta-row">
                        <span class="meta-label">Last Updated</span>
                        <span class="meta-value">{{ $product->updated_at->format('M d, Y') }}</span>
                    </div>

                </div>

            </div>

            {{-- Description --}}
            <div class="section-title">
                <h3>Description</h3>
            </div>

            <div class="description-box">
                {{ $product->description ?: 'No description provided.' }}
            </div>

        </div>

    </div>

@endsection

@push('styles')
    <style>
        .product-wrapper {
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

        .badge-row {
            display: flex;
            gap: 10px;
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

        .old-price {
            font-size: 12px;
            color: #94a3b8;
            text-decoration: line-through;
            margin-right: 6px;
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
