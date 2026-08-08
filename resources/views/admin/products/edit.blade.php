@extends('layouts.admin')

@section('title', 'Edit Product')

@section('content')
    <h1 class="h3 mb-4">Edit Product</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @method('PUT')
                @include('admin.products._form', ['product' => $product, 'categories' => $categories])
            </form>
        </div>
    </div>
@endsection