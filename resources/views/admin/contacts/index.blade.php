@extends('layouts.admin')

@section('title', 'Contacts')
@section('page-title', 'Contacts')

@section('topbar-extras')
    <div class="flex items-center gap-2">
        <div style="position:relative;">
            <i class="fas fa-search"
                style="position:absolute;left:11px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:12px;"></i>
            <input type="text" id="contactSearch" placeholder="Search contacts..." value="{{ request('search') }}"
                style="border:1.5px solid #e8edf3;border-radius:9px;padding:7px 12px 7px 32px;font-size:13px;color:#334155;outline:none;background:#f8fafc;width:200px;transition:border 0.15s;"
                onfocus="this.style.borderColor='#3b82f6';this.style.background='#fff';"
                onblur="this.style.borderColor='#e8edf3';this.style.background='#f8fafc';">
        </div>
        <select id="statusFilter"
            style="border:1.5px solid #e8edf3;border-radius:9px;padding:7px 14px;font-size:13px;color:#334155;background:#f8fafc;outline:none;cursor:pointer;min-width:120px;">
            <option value="">All Status</option>
            @foreach ($statuses as $status)
                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                    {{ ucfirst($status) }}
                </option>
            @endforeach
        </select>
    </div>
@endsection

@push('styles')
    <style>
        /* Table card */
        .contacts-card {
            background: #fff;
            border-radius: 14px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
            overflow: hidden;
        }

        /* Table */
        .contacts-table {
            width: 100%;
            border-collapse: collapse;
        }

        .contacts-table thead tr {
            border-bottom: 1px solid #f0f4f8;
        }

        .contacts-table thead th {
            padding: 13px 18px;
            font-size: 12px;
            font-weight: 600;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.04em;
            white-space: nowrap;
            background: #fff;
            text-align: left;
        }

        .contacts-table tbody tr {
            border-bottom: 1px solid #f3f6fa;
            transition: background 0.12s;
        }

        .contacts-table tbody tr:last-child {
            border-bottom: none;
        }

        .contacts-table tbody tr:hover {
            background: #f8fafc;
        }

        .contacts-table tbody td {
            padding: 14px 18px;
            font-size: 13.5px;
            color: #334155;
            vertical-align: middle;
        }

        /* Name cell */
        .contact-name {
            font-weight: 600;
            color: #1e293b;
            font-size: 13.5px;
        }

        .contact-phone {
            font-size: 11.5px;
            color: #94a3b8;
            margin-top: 2px;
        }

        /* Email */
        .contact-email {
            color: #475569;
            font-size: 13px;
        }

        /* Subject */
        .contact-subject {
            font-weight: 500;
            color: #334155;
            font-size: 13px;
        }

        /* Message preview */
        .contact-message {
            color: #64748b;
            font-size: 13px;
            max-width: 220px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        /* Date */
        .contact-date {
            font-size: 12.5px;
            color: #64748b;
            white-space: nowrap;
        }

        /* Status badges */
        .badge-new {
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            white-space: nowrap;
        }

        .badge-read {
            background: #f1f5f9;
            color: #475569;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-replied {
            background: #dcfce7;
            color: #16a34a;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-in-progress {
            background: #e0f2fe;
            color: #0284c7;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .badge-closed {
            background: #f1f5f9;
            color: #64748b;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        /* Inquiry type badge */
        .badge-inquiry {
            background: #f0f9ff;
            color: #0369a1;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            border: 1px solid #bae6fd;
        }

        /* Action menu */
        .action-menu {
            position: relative;
        }

        .action-menu-btn {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            border: 1px solid #e8edf3;
            background: #f8fafc;
            color: #64748b;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            font-size: 13px;
            transition: all 0.13s;
        }

        .action-menu-btn:hover {
            background: #e8edf3;
            color: #334155;
        }

        .action-dropdown {
            position: absolute;
            right: 0;
            top: 36px;
            background: #fff;
            border: 1px solid #e8edf3;
            border-radius: 10px;
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.10);
            z-index: 100;
            min-width: 150px;
            display: none;
            overflow: hidden;
        }

        .action-dropdown.open {
            display: block;
        }

        .action-dropdown a,
        .action-dropdown button {
            display: flex;
            align-items: center;
            gap: 9px;
            padding: 9px 14px;
            font-size: 13px;
            font-weight: 500;
            color: #334155;
            text-decoration: none;
            background: none;
            border: none;
            width: 100%;
            text-align: left;
            cursor: pointer;
            transition: background 0.12s;
        }

        .action-dropdown a:hover,
        .action-dropdown button:hover {
            background: #f8fafc;
        }

        .action-dropdown .delete-btn {
            color: #dc2626;
        }

        .action-dropdown .delete-btn:hover {
            background: #fff1f2;
        }

        /* Pagination */
        .pagination-wrap {
            display: flex;
            align-items: center;
            justify-content: space-between;
            margin-top: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .pagination-info {
            font-size: 13px;
            color: #64748b;
        }

        /* Custom pagination styling override */
        .pagination-wrap nav span[aria-current="page"] span,
        .pagination-wrap nav a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 500;
            border: 1.5px solid #e8edf3;
            color: #475569;
            text-decoration: none;
            transition: all 0.13s;
            background: #fff;
            margin: 0 2px;
        }

        .pagination-wrap nav span[aria-current="page"] span {
            background: #3b82f6;
            color: #fff;
            border-color: #3b82f6;
        }

        .pagination-wrap nav a:hover {
            background: #f0f4f8;
            border-color: #cbd5e1;
        }

        /* Empty */
        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: #94a3b8;
        }

        .empty-state i {
            font-size: 48px;
            display: block;
            margin-bottom: 14px;
            color: #cbd5e1;
        }

        .empty-state p {
            font-size: 15px;
            font-weight: 500;
            color: #64748b;
        }

        /* Delete Modal */
        .modal-overlay {
            position: fixed;
            inset: 0;
            background: rgba(15, 22, 35, 0.45);
            z-index: 200;
            display: flex;
            align-items: center;
            justify-content: center;
            opacity: 0;
            pointer-events: none;
            transition: opacity 0.2s;
        }

        .modal-overlay.open {
            opacity: 1;
            pointer-events: all;
        }

        .modal-box {
            background: #fff;
            border-radius: 16px;
            padding: 32px 28px 24px;
            max-width: 400px;
            width: 90%;
            box-shadow: 0 20px 60px rgba(0, 0, 0, 0.18);
            transform: translateY(16px) scale(0.98);
            transition: transform 0.2s;
        }

        .modal-overlay.open .modal-box {
            transform: translateY(0) scale(1);
        }

        .modal-icon {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: #fee2e2;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            color: #dc2626;
            margin-bottom: 16px;
        }

        /* Success alert */
        .alert-success-custom {
            background: #dcfce7;
            color: #15803d;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 18px;
            display: flex;
            align-items: center;
            gap: 8px;
        }
    </style>
@endpush

@section('content')

    {{-- Success flash --}}
    @if (session('success'))
        <div class="alert-success-custom">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- Table Card --}}
    <div class="contacts-card">
        <table class="contacts-table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Subject</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th style="text-align:right; padding-right:22px;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($contacts as $contact)
                    <tr>
                        {{-- Name --}}
                        <td>
                            <div class="contact-name">{{ $contact->name }}</div>
                            @if ($contact->phone)
                                <div class="contact-phone">{{ $contact->phone }}</div>
                            @endif
                        </td>

                        {{-- Email --}}
                        <td>
                            <span class="contact-email">{{ $contact->email }}</span>
                        </td>

                        {{-- Subject --}}
                        <td>
                            <span class="contact-subject">{{ Str::limit($contact->subject, 25) }}</span>
                        </td>

                        {{-- Message --}}
                        <td>
                            <span class="contact-message">{{ Str::limit($contact->message, 40) }}</span>
                        </td>

                        {{-- Date --}}
                        <td>
                            <span class="contact-date">{{ $contact->created_at->format('M j, Y') }}</span>
                        </td>

                        {{-- Status --}}
                        <td>
                            @php $s = strtolower($contact->status); @endphp
                            @if ($s === 'new')
                                <span class="badge-new">New</span>
                            @elseif($s === 'read')
                                <span class="badge-read">Read</span>
                            @elseif($s === 'replied')
                                <span class="badge-replied">Replied</span>
                            @elseif(in_array($s, ['in_progress', 'in progress', 'inprogress']))
                                <span class="badge-in-progress">In Progress</span>
                            @elseif($s === 'closed')
                                <span class="badge-closed">Closed</span>
                            @else
                                <span class="badge-read">{{ ucfirst($contact->status) }}</span>
                            @endif
                        </td>

                        {{-- Actions --}}
                        <td style="text-align:right;">
                            <div class="action-menu" style="display:inline-block;">
                                <button class="action-menu-btn" onclick="toggleMenu(this)">
                                    <i class="fas fa-ellipsis-h"></i>
                                </button>
                                <div class="action-dropdown">
                                    <a href="{{ route('admin.contacts.show', $contact) }}">
                                        <i class="fas fa-eye" style="color:#3b82f6;width:16px;"></i> View
                                    </a>
                                    <button class="delete-btn"
                                        onclick="openDeleteModal('{{ $contact->name }}', '{{ route('admin.contacts.destroy', $contact) }}')">
                                        <i class="fas fa-trash-alt" style="width:16px;"></i> Delete
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7">
                            <div class="empty-state">
                                <i class="far fa-address-book"></i>
                                <p>No contact inquiries found.</p>
                            </div>
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="pagination-wrap">
        <div class="pagination-info">
            @if ($contacts->total() > 0)
                Showing {{ $contacts->firstItem() }} to {{ $contacts->lastItem() }} of {{ $contacts->total() }} entries
            @else
                No entries found
            @endif
        </div>
        <div>
            {{ $contacts->withQueryString()->links() }}
        </div>
    </div>

    {{-- Delete Modal --}}
    <div class="modal-overlay" id="deleteModal">
        <div class="modal-box">
            <div class="modal-icon"><i class="fas fa-trash-alt"></i></div>
            <div style="font-size:18px;font-weight:700;color:#1e293b;margin-bottom:8px;">Delete Contact</div>
            <div style="font-size:14px;color:#64748b;margin-bottom:24px;line-height:1.6;">
                Are you sure you want to delete the inquiry from
                <strong id="deleteContactName" style="color:#1e293b;"></strong>?
                This cannot be undone.
            </div>
            <div class="flex items-center gap-3 justify-end">
                <button onclick="closeDeleteModal()"
                    style="padding:9px 18px;border-radius:9px;border:1.5px solid #e8edf3;background:#f8fafc;font-size:13.5px;font-weight:600;color:#64748b;cursor:pointer;">Cancel</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        style="padding:9px 18px;border-radius:9px;border:none;background:#dc2626;color:#fff;font-size:13.5px;font-weight:600;cursor:pointer;">
                        <i class="fas fa-trash-alt" style="margin-right:4px;"></i> Delete
                    </button>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>
        // Dropdown toggle
        function toggleMenu(btn) {
            const dropdown = btn.nextElementSibling;
            document.querySelectorAll('.action-dropdown').forEach(d => {
                if (d !== dropdown) d.classList.remove('open');
            });
            dropdown.classList.toggle('open');
        }
        document.addEventListener('click', function(e) {
            if (!e.target.closest('.action-menu')) {
                document.querySelectorAll('.action-dropdown').forEach(d => d.classList.remove('open'));
            }
        });

        // Delete modal
        function openDeleteModal(name, url) {
            document.getElementById('deleteContactName').textContent = name;
            document.getElementById('deleteForm').action = url;
            document.getElementById('deleteModal').classList.add('open');
            document.querySelectorAll('.action-dropdown').forEach(d => d.classList.remove('open'));
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('open');
        }
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) closeDeleteModal();
        });

        // Live search + status filter
        let searchTimeout;
        document.getElementById('contactSearch')?.addEventListener('input', function() {
            clearTimeout(searchTimeout);
            searchTimeout = setTimeout(applyFilters, 400);
        });
        document.getElementById('statusFilter')?.addEventListener('change', applyFilters);

        function applyFilters() {
            const search = document.getElementById('contactSearch')?.value ?? '';
            const status = document.getElementById('statusFilter')?.value ?? '';
            const url = new URL(window.location.href);
            url.searchParams.set('search', search);
            url.searchParams.set('status', status);
            url.searchParams.set('page', 1);
            window.location.href = url.toString();
        }
    </script>
@endpush
