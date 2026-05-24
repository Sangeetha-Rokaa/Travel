@extends('layouts.admin')

@section('title', 'Edit Testimonial')

@section('content')
    <div class="container-fluid">

        <h2 class="mb-4">Edit Testimonial</h2>

        <form action="{{ route('admin.testimonials.update', $testimonial->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Client Name</label>
                    <input type="text" name="client_name" class="form-control" value="{{ $testimonial->client_name }}"
                        required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Client Country</label>
                    <input type="text" name="client_country" class="form-control"
                        value="{{ $testimonial->client_country }}">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Replace Photo</label>
                    <input type="file" name="client_photo" class="form-control">

                    <img src="{{ $testimonial->client_photo_url }}" width="60" class="mt-2"
                        style="border-radius:50%;">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Trek / Package</label>
                    <input type="text" name="trek_or_package" class="form-control"
                        value="{{ $testimonial->trek_or_package }}">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Rating</label>
                    <input type="number" name="rating" class="form-control" value="{{ $testimonial->rating }}"
                        min="1" max="5">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Travel Date</label>
                    <input type="date" name="travel_date" class="form-control"
                        value="{{ $testimonial->travel_date?->format('Y-m-d') }}">
                </div>

                <div class="col-md-4 mb-3 mt-4">
                    <label>
                        <input type="checkbox" name="is_active" value="1"
                            {{ $testimonial->is_active ? 'checked' : '' }}>
                        Active
                    </label>

                    <label class="ms-3">
                        <input type="checkbox" name="is_featured" value="1"
                            {{ $testimonial->is_featured ? 'checked' : '' }}>
                        Featured
                    </label>
                </div>

                <div class="col-md-12 mb-3">
                    <label>Review</label>
                    <textarea name="review" class="form-control" rows="5">{{ $testimonial->review }}</textarea>
                </div>

            </div>

            <button class="btn btn-primary">Update Testimonial</button>
        </form>

    </div>
@endsection
