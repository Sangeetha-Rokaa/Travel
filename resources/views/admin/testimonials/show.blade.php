@extends('layouts.admin')

@section('title', 'View Testimonial')

@section('content')
    <div class="container-fluid">

        <h2 class="mb-4">Testimonial Details</h2>

        <div class="card p-4 shadow-sm">

            <div class="d-flex align-items-center gap-3 mb-3">
                <img src="{{ $testimonial->client_photo_url }}" width="80" height="80"
                    style="border-radius:50%; object-fit:cover;">

                <div>
                    <h4 class="mb-0">{{ $testimonial->client_name }}</h4>
                    <small>{{ $testimonial->client_country }}</small>
                </div>
            </div>

            <p><strong>Trek/Package:</strong> {{ $testimonial->trek_or_package }}</p>
            <p><strong>Rating:</strong> {{ $testimonial->rating }} / 5</p>
            <p><strong>Travel Date:</strong> {{ $testimonial->travel_date?->format('d M Y') }}</p>

            <p>
                <strong>Status:</strong>
                @if ($testimonial->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif

                @if ($testimonial->is_featured)
                    <span class="badge bg-warning text-dark">Featured</span>
                @endif
            </p>

            <hr>

            <p><strong>Review:</strong></p>
            <p>{{ $testimonial->review }}</p>

            <a href="{{ route('admin.testimonials.index') }}" class="btn btn-secondary mt-3">
                Back
            </a>

        </div>

    </div>
@endsection
