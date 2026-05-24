@extends('layouts.admin')

@section('title', 'Add Testimonial')

@section('content')
    <div class="container-fluid">

        <h2 class="mb-4">Add Testimonial</h2>

        <form action="{{ route('admin.testimonials.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="row">

                <div class="col-md-6 mb-3">
                    <label>Client Name</label>
                    <input type="text" name="client_name" class="form-control" required>
                </div>

                <div class="col-md-6 mb-3">
                    <label>Client Country</label>
                    <input type="text" name="client_country" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Photo</label>
                    <input type="file" name="client_photo" class="form-control">
                </div>

                <div class="col-md-6 mb-3">
                    <label>Trek / Package</label>
                    <input type="text" name="trek_or_package" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Rating (1-5)</label>
                    <input type="number" name="rating" class="form-control" min="1" max="5" required>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Travel Date</label>
                    <input type="date" name="travel_date" class="form-control">
                </div>

                <div class="col-md-4 mb-3">
                    <label>Status</label><br>
                    <input type="checkbox" name="is_active" value="1"> Active
                    <input type="checkbox" name="is_featured" value="1" class="ms-3"> Featured
                </div>

                <div class="col-md-12 mb-3">
                    <label>Review</label>
                    <textarea name="review" class="form-control" rows="5"></textarea>
                </div>

            </div>

            <button class="btn btn-primary">Save Testimonial</button>
        </form>

    </div>
@endsection
