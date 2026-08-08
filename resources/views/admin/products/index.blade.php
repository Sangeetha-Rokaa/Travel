@extends('layouts.admin')

@section('title', 'Products')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Products</h1>
        <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ New Product</a>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-auto">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Search products...">
                </div>
                <div class="col-auto">
                    <select name="category_id" class="form-select">
                        <option value="">All Categories</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}" @selected(request('category_id') == $category->id)>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-secondary" type="submit">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($products as $product)
                    <tr>
                        <td>
                            <div class="fw-semibold">{{ $product->name }}</div>
                            <div class="text-muted small">{{ $product->sku }}</div>
                        </td>
                        <td>{{ $product->category->name }}</td>
                        <td>
                            @if ($product->sale_price)
                                <span class="text-decoration-line-through text-muted">${{ number_format($product->price, 2) }}</span>
                                <span class="fw-semibold">${{ number_format($product->sale_price, 2) }}</span>
                            @else
                                ${{ number_format($product->price, 2) }}
                            @endif
                        </td>
                        <td>
                            <span class="{{ $product->stock <= 0 ? 'text-danger fw-semibold' : '' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $product->is_active ? 'bg-success' : 'bg-secondary' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ route('admin.products.show', $product) }}" class="btn btn-sm btn-outline-secondary">View</a>
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">No products found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if ($products->hasPages())
            <div class="card-footer">
                {{ $products->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection