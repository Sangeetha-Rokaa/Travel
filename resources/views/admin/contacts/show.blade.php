@extends('layouts.admin')

@section('title', 'Contact Details')
@section('content')

    <style>
        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 24px;
        }

        .title-box h3 {
            font-weight: 800;
            color: #0f172a;
            margin-bottom: 4px;
        }

        .title-box p {
            color: #64748b;
            font-size: 13px;
        }

        .contact-grid {
            display: grid;
            grid-template-columns: 1.8fr 1fr;
            gap: 22px;
        }

        @media (max-width: 992px) {
            .contact-grid {
                grid-template-columns: 1fr;
            }
        }

        .cardx {
            background: #fff;
            border: 1px solid #eef2f7;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(15, 23, 42, 0.04);
        }

        .cardx-header {
            padding: 18px 20px;
            border-bottom: 1px solid #f1f5f9;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .cardx-body {
            padding: 20px;
        }

        .badge-pill {
            padding: 6px 12px;
            border-radius: 999px;
            font-size: 12px;
            font-weight: 600;
        }

        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
        }

        .info-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            padding: 12px 14px;
            transition: 0.2s;
        }

        .info-box:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.06);
        }

        .info-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #94a3b8;
            font-weight: 700;
        }

        .info-value {
            font-size: 13px;
            font-weight: 600;
            color: #0f172a;
            margin-top: 3px;
        }

        .message-box {
            background: #ffffff;
            border-left: 4px solid #3b82f6;
            padding: 18px;
            border-radius: 12px;
            font-size: 14px;
            line-height: 1.6;
            color: #334155;
        }

        .side-card {
            position: sticky;
            top: 80px;
        }

        .btn-primaryx {
            background: #0f172a;
            color: #fff;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
            border: none;
            width: 100%;
        }

        .btn-primaryx:hover {
            background: #1e293b;
        }
    </style>

    <div class="container-fluid py-3">

        {{-- HEADER --}}
        <div class="page-header">

            <div class="title-box">
                <h3>Contact Details</h3>
                <p>Manage and review customer inquiries in detail</p>
            </div>

            <a href="{{ route('admin.contacts.index') }}" class="btn btn-outline-dark btn-sm">
                ← Back
            </a>

        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="contact-grid">

            {{-- LEFT --}}
            <div>

                <div class="cardx">

                    <div class="cardx-header">

                        <div>
                            <h4 style="margin:0;font-weight:800;">
                                {{ $contact->subject }}
                            </h4>
                            <small class="text-muted">
                                {{ $contact->created_at->format('d M Y h:i A') }}
                            </small>
                        </div>

                        @php
                            $statusClass = match ($contact->status) {
                                'new' => 'background:#3b82f6;color:#fff',
                                'read' => 'background:#facc15;color:#000',
                                'replied' => 'background:#22c55e;color:#fff',
                                'closed' => 'background:#64748b;color:#fff',
                                default => 'background:#0f172a;color:#fff',
                            };
                        @endphp

                        <span class="badge-pill" style="{{ $statusClass }}">
                            {{ ucfirst($contact->status) }}
                        </span>

                    </div>

                    <div class="cardx-body">

                        {{-- INFO --}}
                        <div class="info-grid mb-4">

                            <div class="info-box">
                                <div class="info-label">Name</div>
                                <div class="info-value">{{ $contact->name }}</div>
                            </div>

                            <div class="info-box">
                                <div class="info-label">Email</div>
                                <div class="info-value">{{ $contact->email }}</div>
                            </div>

                            <div class="info-box">
                                <div class="info-label">Phone</div>
                                <div class="info-value">{{ $contact->phone ?? 'N/A' }}</div>
                            </div>

                            <div class="info-box">
                                <div class="info-label">Country</div>
                                <div class="info-value">{{ $contact->country ?? 'N/A' }}</div>
                            </div>

                            <div class="info-box">
                                <div class="info-label">Inquiry Type</div>
                                <div class="info-value">{{ ucfirst($contact->inquiry_type) }}</div>
                            </div>

                            <div class="info-box">
                                <div class="info-label">Group Size</div>
                                <div class="info-value">{{ $contact->group_size ?? 'N/A' }}</div>
                            </div>

                        </div>

                        {{-- MESSAGE --}}
                        <h5 style="font-weight:800;margin-bottom:10px;">Message</h5>

                        <div class="message-box">
                            {{ $contact->message }}
                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="side-card">

                {{-- STATUS UPDATE --}}
                <div class="cardx mb-3">

                    <div class="cardx-header">
                        <strong>Update Status</strong>
                    </div>

                    <div class="cardx-body">

                        <form method="POST" action="{{ route('admin.contacts.updateStatus', $contact) }}">
                            @csrf
                            @method('PATCH')

                            <label>Status</label>
                            <select name="status" class="form-control mb-3">
                                @foreach ($statuses as $status)
                                    <option value="{{ $status }}"
                                        {{ $contact->status == $status ? 'selected' : '' }}>
                                        {{ ucfirst($status) }}
                                    </option>
                                @endforeach
                            </select>

                            <label>Admin Notes</label>
                            <textarea name="admin_notes" class="form-control mb-3" rows="4">{{ $contact->admin_notes }}</textarea>

                            <button class="btn-primaryx">
                                Update Contact
                            </button>

                        </form>

                    </div>

                </div>

                {{-- META --}}
                <div class="cardx">

                    <div class="cardx-header">
                        <strong>Meta Info</strong>
                    </div>

                    <div class="cardx-body">

                        <div class="mb-3">
                            <div class="info-label">Created</div>
                            <div class="info-value">{{ $contact->created_at->format('d M Y h:i A') }}</div>
                        </div>

                        <div class="mb-3">
                            <div class="info-label">Updated</div>
                            <div class="info-value">{{ $contact->updated_at->format('d M Y h:i A') }}</div>
                        </div>

                        <div>
                            <div class="info-label">Replied</div>
                            <div class="info-value">
                                {{ $contact->replied_at ? $contact->replied_at->format('d M Y h:i A') : 'Not yet' }}
                            </div>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>

@endsection
