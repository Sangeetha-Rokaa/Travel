@extends('layouts.admin')

@section('title', $product->name)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">{{ $product->name }}</h1>
        <div>
            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-outline-primary">Edit</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-link">Back to list</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            @if ($product->image)
                <img src="{{ Storage::url($product->image) }}" alt="{{ $product->name }}" class="img-fluid rounded mb-3">
            @endif
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-4">Category</dt><dd class="col-8">{{ $product->category->name }}</dd>
                        <dt class="col-4">Slug</dt><dd class="col-8"><code>{{ $product->slug }}</code></dd>
                        <dt class="col-4">SKU</dt><dd class="col-8">{{ $product->sku ?: '—' }}</dd>
                        <dt class="col-4">Price</dt>
                        <dd class="col-8">
                            @if ($product->sale_price)
                                <span class="text-decoration-line-through text-muted">${{ number_format($product->price, 2) }}</span>
                                <span class="fw-semibold">${{ number_format($product->sale_price, 2) }}</span>
                            @else
                                ${{ number_format($product->price, 2) }}
                            @endif
                        </dd>
                        <dt class="col-4">Stock</dt><dd class="col-8">{{ $product->stock }}</dd>
                        <dt class="col-4">Status</dt>
                        <dd class="col-8">
                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </dd>
                        <dt class="col-4">Description</dt><dd class="col-8">{{ $product->description ?: '—' }}</dd>
                    </dl>
                </div>
            </div>
        </div>
    </div>
@endsection