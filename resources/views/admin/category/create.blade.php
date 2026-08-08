@extends('layouts.admin')

@section('title', 'New Category')

@section('content')
    <h1 class="h3 mb-4">New Category</h1>

    <div class="card">
        <div class="card-body">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @include('admin.categories._form', ['parents' => $parents])
            </form>
        </div>
    </div>
@endsection