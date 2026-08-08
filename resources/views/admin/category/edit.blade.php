@extends('layouts.admin')

@section('title', 'Edit Category')

@section('content')
    <h1 class="h3 mb-4">Edit Category</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.update', $category) }}" method="POST">
                @method('PUT')
                @include('admin.categories._form', ['category' => $category, 'parents' => $parents])
            </form>
        </div>
    </div>
@endsection