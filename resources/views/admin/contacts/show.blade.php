@extends('layouts.admin')

@section('title', 'Contact Details')

@section('content')

    <div class="container-fluid py-4 contact-show-wrapper">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">

            <div>
                <h3 class="fw-bold mb-1">Contact Details</h3>
                <p class="text-muted mb-0">
                    View and manage customer inquiry information.
                </p>
            </div>

            <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-dark">
                Back
            </a>

        </div>

        {{-- SUCCESS --}}
        @if (session('success'))
            <div class="alert alert-success shadow-sm rounded-3">
                {{ session('success') }}
            </div>
        @endif

        <div class="row g-4">

            {{-- LEFT --}}
            <div class="col-lg-8">

                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        {{-- TOP --}}
                        <div class="d-flex justify-content-between align-items-start flex-wrap gap-3 mb-4">

                            <div>

                                <h4 class="fw-bold mb-1">
                                    {{ $contact->subject }}
                                </h4>

                                <div class="text-muted">
                                    Submitted on
                                    {{ $contact->created_at->format('d M Y h:i A') }}
                                </div>

                            </div>

                            @php
                                $statusClass = match ($contact->status) {
                                    'new' => 'bg-primary',
                                    'read' => 'bg-warning text-dark',
                                    'replied' => 'bg-success',
                                    'closed' => 'bg-secondary',
                                    default => 'bg-dark',
                                };
                            @endphp

                            <span class="badge {{ $statusClass }} px-3 py-2">
                                {{ ucfirst($contact->status) }}
                            </span>

                        </div>

                        {{-- CUSTOMER INFO --}}
                        <div class="row g-3 mb-4">

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Full Name
                                    </small>

                                    <div class="fw-semibold">
                                        {{ $contact->name }}
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Email Address
                                    </small>

                                    <div class="fw-semibold">
                                        {{ $contact->email }}
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Phone Number
                                    </small>

                                    <div class="fw-semibold">
                                        {{ $contact->phone ?? 'N/A' }}
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Country
                                    </small>

                                    <div class="fw-semibold">
                                        {{ $contact->country ?? 'N/A' }}
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Inquiry Type
                                    </small>

                                    <div class="fw-semibold">
                                        {{ ucfirst($contact->inquiry_type) }}
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Trek / Package
                                    </small>

                                    <div class="fw-semibold">
                                        {{ $contact->trek_or_package ?? 'N/A' }}
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Travel Date
                                    </small>

                                    <div class="fw-semibold">
                                        {{ $contact->travel_date ?? 'N/A' }}
                                    </div>

                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="border rounded-3 p-3 h-100">

                                    <small class="text-muted d-block mb-1">
                                        Group Size
                                    </small>

                                    <div class="fw-semibold">
                                        {{ $contact->group_size ?? 'N/A' }}
                                    </div>

                                </div>
                            </div>

                        </div>

                        {{-- MESSAGE --}}
                        <div class="border rounded-4 p-4 bg-light">

                            <h5 class="fw-bold mb-3">
                                Customer Message
                            </h5>

                            <div style="white-space: pre-line;">
                                {{ $contact->message }}
                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="col-lg-4">

                {{-- UPDATE STATUS --}}
                <div class="card border-0 shadow-sm rounded-4 mb-4">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Update Status
                        </h5>

                        <form action="{{ route('admin.contacts.updateStatus', $contact) }}" method="POST">

                            @csrf
                            @method('PATCH')

                            {{-- STATUS --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Status
                                </label>

                                <select name="status" class="form-select @error('status') is-invalid @enderror">

                                    @foreach ($statuses as $status)
                                        <option value="{{ $status }}"
                                            {{ $contact->status == $status ? 'selected' : '' }}>
                                            {{ ucfirst($status) }}
                                        </option>
                                    @endforeach

                                </select>

                                @error('status')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- NOTES --}}
                            <div class="mb-3">

                                <label class="form-label fw-semibold">
                                    Admin Notes
                                </label>

                                <textarea name="admin_notes" rows="5" class="form-control @error('admin_notes') is-invalid @enderror"
                                    placeholder="Add internal notes here...">{{ old('admin_notes', $contact->admin_notes) }}</textarea>

                                @error('admin_notes')
                                    <div class="invalid-feedback">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </div>

                            {{-- BUTTON --}}
                            <button type="submit" class="btn btn-dark w-100">
                                Update Contact
                            </button>

                        </form>

                    </div>

                </div>

                {{-- EXTRA INFO --}}
                <div class="card border-0 shadow-sm rounded-4">

                    <div class="card-body p-4">

                        <h5 class="fw-bold mb-4">
                            Additional Info
                        </h5>

                        <div class="mb-3">
                            <small class="text-muted d-block">
                                Created At
                            </small>

                            <div class="fw-semibold">
                                {{ $contact->created_at->format('d M Y h:i A') }}
                            </div>
                        </div>

                        <div class="mb-3">
                            <small class="text-muted d-block">
                                Last Updated
                            </small>

                            <div class="fw-semibold">
                                {{ $contact->updated_at->format('d M Y h:i A') }}
                            </div>
                        </div>

                        <div>
                            <small class="text-muted d-block">
                                Replied At
                            </small>

                            <div class="fw-semibold">
                                {{ $contact->replied_at ? $contact->replied_at->format('d M Y h:i A') : 'Not Replied Yet' }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
