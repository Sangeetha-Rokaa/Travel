@extends('layouts.admin')

@section('title', 'Contact Management')

@section('content')

    <div class="container-fluid py-4 contact-wrapper">

        {{-- HEADER --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
            <div>
                <h3 class="fw-bold mb-1">Contact Management</h3>
                <p class="text-muted mb-0">
                    Manage customer inquiries, messages, and responses.
                </p>
            </div>
        </div>

        {{-- FILTER CARD --}}
        <div class="card border-0 shadow-sm rounded-4 mb-4">
            <div class="card-body">

                <form method="GET" action="{{ route('admin.contacts.index') }}">
                    <div class="row g-3 align-items-end">

                        {{-- STATUS --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Filter by Status</label>

                            <select name="status" class="form-select">
                                <option value="">All Status</option>

                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}"
                                        {{ request('status') == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- INQUIRY TYPE --}}
                        <div class="col-md-4">
                            <label class="form-label fw-semibold">Inquiry Type</label>

                            <select name="inquiry_type" class="form-select">
                                <option value="">All Types</option>

                                @foreach ($inquiryTypes as $type)
                                    <option value="{{ $type }}"
                                        {{ request('inquiry_type') == $type ? 'selected' : '' }}>
                                        {{ ucfirst($type) }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- BUTTONS --}}
                        <div class="col-md-4">
                            <div class="d-flex gap-2">

                                <button type="submit" class="btn btn-dark px-4">
                                    Filter
                                </button>

                                <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-secondary">
                                    Reset
                                </a>

                            </div>
                        </div>

                    </div>
                </form>

            </div>
        </div>

        {{-- SUCCESS MESSAGE --}}
        @if (session('success'))
            <div class="alert alert-success rounded-3 shadow-sm">
                {{ session('success') }}
            </div>
        @endif

        {{-- TABLE CARD --}}
        <div class="card border-0 shadow-sm rounded-4">

            <div class="card-body p-0">

                <div class="table-responsive">

                    <table class="table table-hover align-middle mb-0">

                        <thead class="table-light">
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Subject</th>
                                <th>Inquiry</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th width="180">Actions</th>
                            </tr>
                        </thead>

                        <tbody>

                            @forelse ($contacts as $contact)
                                <tr>

                                    <td>{{ $contact->id }}</td>

                                    <td>
                                        <div class="fw-semibold">
                                            {{ $contact->name }}
                                        </div>

                                        @if ($contact->phone)
                                            <small class="text-muted">
                                                {{ $contact->phone }}
                                            </small>
                                        @endif
                                    </td>

                                    <td>
                                        {{ $contact->email }}
                                    </td>

                                    <td>
                                        <div class="fw-medium">
                                            {{ Str::limit($contact->subject, 35) }}
                                        </div>
                                    </td>

                                    <td>
                                        <span class="badge bg-info-subtle text-dark border">
                                            {{ ucfirst($contact->inquiry_type) }}
                                        </span>
                                    </td>

                                    <td>

                                        @php
                                            $statusClass = match ($contact->status) {
                                                'new' => 'bg-primary',
                                                'read' => 'bg-warning text-dark',
                                                'replied' => 'bg-success',
                                                'closed' => 'bg-secondary',
                                                default => 'bg-dark',
                                            };
                                        @endphp

                                        <span class="badge {{ $statusClass }}">
                                            {{ ucfirst($contact->status) }}
                                        </span>

                                    </td>

                                    <td>
                                        <small class="text-muted">
                                            {{ $contact->created_at->format('d M Y') }}
                                            <br>
                                            {{ $contact->created_at->format('h:i A') }}
                                        </small>
                                    </td>

                                    <td>

                                        <div class="d-flex gap-2">

                                            {{-- VIEW --}}
                                            <a href="{{ route('admin.contacts.show', $contact) }}"
                                                class="btn btn-sm btn-dark">
                                                View
                                            </a>

                                            {{-- DELETE --}}
                                            <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                                                onsubmit="return confirm('Delete this contact?')">

                                                @csrf
                                                @method('DELETE')

                                                <button type="submit" class="btn btn-sm btn-outline-danger">
                                                    Delete
                                                </button>

                                            </form>

                                        </div>

                                    </td>

                                </tr>

                            @empty

                                <tr>
                                    <td colspan="8" class="text-center py-5 text-muted">
                                        No contact inquiries found.
                                    </td>
                                </tr>
                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </div>

        {{-- PAGINATION --}}
        <div class="mt-4">
            {{ $contacts->withQueryString()->links() }}
        </div>

    </div>

@endsection
