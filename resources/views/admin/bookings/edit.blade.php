@extends('layouts.admin')

@section('title', 'Edit Booking')
@section('page-title', 'Edit Booking')

@push('styles')
    <style>
        /* ── Page layout ─────────────────────────────────────────── */
        .edit-grid {
            display: grid;
            grid-template-columns: 1fr 320px;
            gap: 22px;
            align-items: start;
        }

        @media (max-width: 1100px) {
            .edit-grid {
                grid-template-columns: 1fr;
            }
        }

        /* ── Cards ───────────────────────────────────────────────── */
        .form-card {
            background: #fff;
            border-radius: 16px;
            border: 1px solid #f0f4f8;
            box-shadow: 0 1px 4px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .form-card-header {
            padding: 16px 22px;
            border-bottom: 1px solid #f0f4f8;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-card-header .card-icon {
            width: 34px;
            height: 34px;
            border-radius: 9px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 14px;
            flex-shrink: 0;
        }

        .form-card-header h3 {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .form-card-body {
            padding: 22px;
        }

        /* ── Field groups ────────────────────────────────────────── */
        .field-row {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
            margin-bottom: 16px;
        }

        .field-row.three {
            grid-template-columns: 1fr 1fr 1fr;
        }

        .field-row.one {
            grid-template-columns: 1fr;
        }

        @media (max-width: 700px) {

            .field-row,
            .field-row.three {
                grid-template-columns: 1fr;
            }
        }

        .field-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        /* ── Labels & inputs ─────────────────────────────────────── */
        .field-label {
            font-size: 12px;
            font-weight: 600;
            color: #64748b;
            letter-spacing: 0.03em;
            text-transform: uppercase;
        }

        .field-input,
        .field-select,
        .field-textarea {
            border: 1.5px solid #e8edf3;
            border-radius: 10px;
            padding: 9px 13px;
            font-size: 13.5px;
            color: #1e293b;
            background: #f8fafc;
            outline: none;
            transition: border 0.15s, background 0.15s, box-shadow 0.15s;
            width: 100%;
            font-family: inherit;
        }

        .field-input:focus,
        .field-select:focus,
        .field-textarea:focus {
            border-color: #3b82f6;
            background: #fff;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.10);
        }

        .field-input.is-invalid,
        .field-select.is-invalid,
        .field-textarea.is-invalid {
            border-color: #f87171;
            background: #fff;
        }

        .field-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .field-select {
            cursor: pointer;
            appearance: none;
            background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2394a3b8' d='M6 8L1 3h10z'/%3E%3C/svg%3E");
            background-repeat: no-repeat;
            background-position: right 13px center;
            padding-right: 34px;
        }

        .field-error {
            font-size: 11.5px;
            color: #ef4444;
            margin-top: 2px;
        }

        .field-prefix {
            position: relative;
        }

        .field-prefix .prefix-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            font-size: 12px;
            pointer-events: none;
        }

        .field-prefix .field-input {
            padding-left: 30px;
        }

        /* ── Ref badge ───────────────────────────────────────────── */
        .ref-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: #eff6ff;
            color: #1d4ed8;
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            border: 1px solid #bfdbfe;
        }

        /* ── Back button ─────────────────────────────────────────── */
        .back-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 8px 16px;
            border-radius: 9px;
            border: 1.5px solid #e8edf3;
            background: #fff;
            font-size: 13px;
            font-weight: 600;
            color: #475569;
            text-decoration: none;
            transition: all 0.15s;
        }

        .back-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
            color: #334155;
        }

        /* ── Submit button ───────────────────────────────────────── */
        .save-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 10px;
            border: none;
            background: #3b82f6;
            color: #fff;
            font-size: 13.5px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.15s, transform 0.13s;
        }

        .save-btn:hover {
            background: #2563eb;
            transform: translateY(-1px);
        }

        .cancel-btn {
            display: inline-flex;
            align-items: center;
            gap: 7px;
            padding: 10px 18px;
            border-radius: 10px;
            border: 1.5px solid #e8edf3;
            background: #f8fafc;
            color: #64748b;
            font-size: 13.5px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.15s;
        }

        .cancel-btn:hover {
            background: #f1f5f9;
            color: #334155;
        }

        /* ── Side summary card ───────────────────────────────────── */
        .summary-row {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #f3f6fa;
            font-size: 13px;
        }

        .summary-row:last-child {
            border-bottom: none;
        }

        .summary-label {
            color: #94a3b8;
            font-weight: 500;
        }

        .summary-value {
            color: #1e293b;
            font-weight: 600;
        }

        /* Status badges */
        .status-badge {
            display: inline-flex;
            align-items: center;
            font-size: 11px;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
        }

        .status-confirmed {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-pending {
            background: #fef9c3;
            color: #ca8a04;
        }

        .status-cancelled {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-completed {
            background: #e0f2fe;
            color: #0284c7;
        }

        .status-paid {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-partial {
            background: #fef3c7;
            color: #d97706;
        }

        .status-unpaid {
            background: #fee2e2;
            color: #dc2626;
        }

        .status-refunded {
            background: #f1f5f9;
            color: #475569;
        }

        /* ── Alert ───────────────────────────────────────────────── */
        .alert-success-custom {
            background: #dcfce7;
            color: #15803d;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13.5px;
            font-weight: 500;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        /* ── Section divider inside card ─────────────────────────── */
        .section-sep {
            font-size: 11px;
            font-weight: 700;
            color: #94a3b8;
            letter-spacing: 0.06em;
            text-transform: uppercase;
            margin: 20px 0 14px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .section-sep::after {
            content: '';
            flex: 1;
            height: 1px;
            background: #f0f4f8;
        }
    </style>
@endpush

@section('content')

    {{-- ── Top bar ─────────────────────────────────────────────────── --}}
    <div class="flex items-center justify-between mb-6">
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.bookings.index') }}" class="back-btn">
                <i class="fas fa-arrow-left"></i> Back
            </a>
            <div>
                <div style="font-size:13px; color:#94a3b8; margin-bottom:3px;">Editing booking</div>
                <span class="ref-badge">
                    <i class="fas fa-hashtag" style="font-size:10px;"></i>
                    {{ $booking->booking_ref }}
                </span>
            </div>
        </div>

        {{-- Quick status pills --}}
        <div class="flex items-center gap-2">
            @php $s = strtolower($booking->status); @endphp
            <span class="status-badge status-{{ $s }}">{{ ucfirst($booking->status) }}</span>
            @php $ps = strtolower($booking->payment_status); @endphp
            <span class="status-badge status-{{ $ps }}">{{ ucfirst($booking->payment_status) }}</span>
        </div>
    </div>

    {{-- ── Flash message ───────────────────────────────────────────── --}}
    @if (session('success'))
        <div class="alert-success-custom">
            <i class="fas fa-check-circle"></i>
            {{ session('success') }}
        </div>
    @endif

    {{-- ── Two-column grid ─────────────────────────────────────────── --}}
    <form method="POST" action="{{ route('admin.bookings.update', $booking->id) }}" id="bookingForm">
        @csrf
        @method('PUT')

        <div class="edit-grid">

            {{-- ══ LEFT COLUMN ═══════════════════════════════════════════ --}}
            <div style="display:flex; flex-direction:column; gap:20px;">

                {{-- Customer Information --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon" style="background:#eff6ff;">
                            <i class="fas fa-user text-blue-500"></i>
                        </div>
                        <h3>Customer Information</h3>
                    </div>
                    <div class="form-card-body">

                        <div class="field-row">
                            <div class="field-group">
                                <label class="field-label">First Name</label>
                                <input type="text" name="first_name"
                                    class="field-input @error('first_name') is-invalid @enderror"
                                    value="{{ old('first_name', $booking->first_name) }}" placeholder="First name">
                                @error('first_name')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label">Last Name</label>
                                <input type="text" name="last_name"
                                    class="field-input @error('last_name') is-invalid @enderror"
                                    value="{{ old('last_name', $booking->last_name) }}" placeholder="Last name">
                                @error('last_name')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="field-row">
                            <div class="field-group">
                                <label class="field-label">Email Address</label>
                                <div class="field-prefix">
                                    <i class="fas fa-envelope prefix-icon"></i>
                                    <input type="email" name="email"
                                        class="field-input @error('email') is-invalid @enderror"
                                        value="{{ old('email', $booking->email) }}" placeholder="email@example.com">
                                </div>
                                @error('email')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label">Phone Number</label>
                                <div class="field-prefix">
                                    <i class="fas fa-phone prefix-icon"></i>
                                    <input type="text" name="phone"
                                        class="field-input @error('phone') is-invalid @enderror"
                                        value="{{ old('phone', $booking->phone) }}" placeholder="+1 234 567 890">
                                </div>
                                @error('phone')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="field-row">
                            <div class="field-group">
                                <label class="field-label">Nationality</label>
                                <input type="text" name="nationality"
                                    class="field-input @error('nationality') is-invalid @enderror"
                                    value="{{ old('nationality', $booking->nationality) }}" placeholder="e.g. American">
                                @error('nationality')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label">Passport Number</label>
                                <input type="text" name="passport_number"
                                    class="field-input @error('passport_number') is-invalid @enderror"
                                    value="{{ old('passport_number', $booking->passport_number) }}"
                                    placeholder="A12345678">
                                @error('passport_number')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
                {{-- Booking Type Information --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon" style="background:#f0fdf4;">
                            <i class="fas fa-tag text-green-500"></i>
                        </div>
                        <h3>Booking Type</h3>
                    </div>
                    <div class="form-card-body">
                        <div class="field-row">
                            <div class="field-group">
                                <label class="field-label">Booking Type</label>
                                <select name="booking_type"
                                    class="field-select @error('booking_type') is-invalid @enderror">
                                    <option value="trek" {{ $booking->booking_type == 'trek' ? 'selected' : '' }}>Trek
                                    </option>
                                    <option value="package" {{ $booking->booking_type == 'package' ? 'selected' : '' }}>
                                        Package</option>
                                    <option value="custom" {{ $booking->booking_type == 'custom' ? 'selected' : '' }}>
                                        Custom Request</option>
                                </select>
                                @error('booking_type')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label">Currency</label>
                                <select name="currency" class="field-select @error('currency') is-invalid @enderror">
                                    <option value="USD" {{ $booking->currency == 'USD' ? 'selected' : '' }}>USD ($)
                                    </option>
                                    <option value="EUR" {{ $booking->currency == 'EUR' ? 'selected' : '' }}>EUR (€)
                                    </option>
                                    <option value="GBP" {{ $booking->currency == 'GBP' ? 'selected' : '' }}>GBP (£)
                                    </option>
                                    <option value="NPR" {{ $booking->currency == 'NPR' ? 'selected' : '' }}>NPR (रू)
                                    </option>
                                </select>
                                @error('currency')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        @if ($booking->booking_type == 'custom')
                            <div class="field-row one">
                                <div class="field-group">
                                    <label class="field-label">Custom Request Details</label>
                                    <textarea name="custom_request" rows="3" class="field-textarea">{{ old('custom_request', $booking->custom_request) }}</textarea>
                                    @error('custom_request')
                                        <span class="field-error">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Special Requirements --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon" style="background:#fef9c3;">
                            <i class="fas fa-clipboard-list text-amber-500"></i>
                        </div>
                        <h3>Special Requirements</h3>
                    </div>
                    <div class="form-card-body">
                        <div class="field-group">
                            <label class="field-label">Special Requirements</label>
                            <textarea name="special_requirements" rows="3"
                                class="field-textarea @error('special_requirements') is-invalid @enderror"
                                placeholder="Any special requirements or requests...">{{ old('special_requirements', $booking->special_requirements) }}</textarea>
                            @error('special_requirements')
                                <span class="field-error">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="field-row" style="margin-top: 16px;">
                            <div class="field-group">
                                <label class="field-label">Accommodation Preference</label>
                                <input type="text" name="accommodation_preference"
                                    class="field-input @error('accommodation_preference') is-invalid @enderror"
                                    value="{{ old('accommodation_preference', $booking->accommodation_preference) }}"
                                    placeholder="e.g. 3-star, 4-star, Luxury">
                                @error('accommodation_preference')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label">Pickup Location</label>
                                <input type="text" name="pickup_location"
                                    class="field-input @error('pickup_location') is-invalid @enderror"
                                    value="{{ old('pickup_location', $booking->pickup_location) }}"
                                    placeholder="e.g. Kathmandu Airport">
                                @error('pickup_location')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Trip Information --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon" style="background:#f0fdf4;">
                            <i class="fas fa-route text-green-500"></i>
                        </div>
                        <h3>Trip Information</h3>
                    </div>
                    <div class="form-card-body">

                        <div class="field-row">
                            <div class="field-group">
                                <label class="field-label">Start Date</label>
                                <div class="field-prefix">
                                    <i class="fas fa-calendar prefix-icon"></i>
                                    <input type="date" name="trip_start_date"
                                        class="field-input @error('trip_start_date') is-invalid @enderror"
                                        value="{{ optional($booking->trip_start_date)->format('Y-m-d') }}">
                                </div>
                                @error('trip_start_date')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label">End Date</label>
                                <div class="field-prefix">
                                    <i class="fas fa-calendar-check prefix-icon"></i>
                                    <input type="date" name="trip_end_date"
                                        class="field-input @error('trip_end_date') is-invalid @enderror"
                                        value="{{ optional($booking->trip_end_date)->format('Y-m-d') }}">
                                </div>
                                @error('trip_end_date')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="field-row">
                            <div class="field-group">
                                <label class="field-label">Number of Adults</label>
                                <div class="field-prefix">
                                    <i class="fas fa-users prefix-icon"></i>
                                    <input type="number" name="num_adults" min="1"
                                        class="field-input @error('num_adults') is-invalid @enderror"
                                        value="{{ old('num_adults', $booking->num_adults) }}" placeholder="1">
                                </div>
                                @error('num_adults')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label">Number of Children</label>
                                <div class="field-prefix">
                                    <i class="fas fa-child prefix-icon"></i>
                                    <input type="number" name="num_children" min="0"
                                        class="field-input @error('num_children') is-invalid @enderror"
                                        value="{{ old('num_children', $booking->num_children) }}" placeholder="0">
                                </div>
                                @error('num_children')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Payment & Status --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon" style="background:#fef9c3;">
                            <i class="fas fa-credit-card text-amber-500"></i>
                        </div>
                        <h3>Payment & Status</h3>
                    </div>
                    <div class="form-card-body">

                        <div class="field-row three">
                            <div class="field-group">
                                <label class="field-label">Total Price ($)</label>
                                <div class="field-prefix">
                                    <i class="fas fa-dollar-sign prefix-icon"></i>
                                    <input type="number" step="0.01" name="total_price"
                                        class="field-input @error('total_price') is-invalid @enderror"
                                        value="{{ old('total_price', $booking->total_price) }}" placeholder="0.00">
                                </div>
                                @error('total_price')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label">Amount Paid ($)</label>
                                <div class="field-prefix">
                                    <i class="fas fa-check-circle prefix-icon"></i>
                                    <input type="number" step="0.01" name="amount_paid"
                                        class="field-input @error('amount_paid') is-invalid @enderror"
                                        value="{{ old('amount_paid', $booking->amount_paid) }}" placeholder="0.00">
                                </div>
                                @error('amount_paid')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label">Payment Method</label>
                                <div class="field-prefix">
                                    <i class="fas fa-wallet prefix-icon"></i>
                                    <input type="text" name="payment_method"
                                        class="field-input @error('payment_method') is-invalid @enderror"
                                        value="{{ old('payment_method', $booking->payment_method) }}"
                                        placeholder="e.g. Stripe">
                                </div>
                                @error('payment_method')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="field-row">
                            <div class="field-group">
                                <label class="field-label">Booking Status</label>
                                <select name="status" class="field-select @error('status') is-invalid @enderror">
                                    @foreach (\App\Models\Booking::BOOKING_STATUSES as $key => $label)
                                        <option value="{{ $key }}"
                                            {{ $booking->status == $key ? 'selected' : '' }}>
                                            {{ $label }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('status')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="field-group">
                                <label class="field-label">Payment Status</label>
                                <select name="payment_status"
                                    class="field-select @error('payment_status') is-invalid @enderror">
                                    @foreach (\App\Models\Booking::PAYMENT_STATUSES as $payment)
                                        <option value="{{ $payment }}"
                                            {{ $booking->payment_status == $payment ? 'selected' : '' }}>
                                            {{ ucfirst($payment) }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('payment_status')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="field-row one">
                            <div class="field-group">
                                <label class="field-label">Admin Notes</label>
                                <textarea name="admin_notes" rows="4" class="field-textarea @error('admin_notes') is-invalid @enderror"
                                    placeholder="Internal notes about this booking...">{{ old('admin_notes', $booking->admin_notes) }}</textarea>
                                @error('admin_notes')
                                    <span class="field-error">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                {{-- Action buttons --}}
                <div class="flex items-center justify-end gap-3">
                    <a href="{{ route('admin.bookings.index') }}" class="cancel-btn">
                        Cancel
                    </a>
                    <button type="submit" class="save-btn">
                        <i class="fas fa-save"></i>
                        Update Booking
                    </button>
                </div>

            </div>

            {{-- ══ RIGHT COLUMN — Summary sidebar ════════════════════════ --}}
            <div style="display:flex; flex-direction:column; gap:20px; position:sticky; top:86px;">

                {{-- Booking summary --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon" style="background:#f0f9ff;">
                            <i class="fas fa-receipt text-sky-500"></i>
                        </div>
                        <h3>Booking Summary</h3>
                    </div>
                    <div class="form-card-body" style="padding-top:14px; padding-bottom:14px;">

                        <div class="summary-row">
                            <span class="summary-label">Reference</span>
                            <span class="summary-value"
                                style="font-size:12px; color:#3b82f6;">{{ $booking->booking_ref }}</span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Package / Trek</span>
                            <span class="summary-value" style="font-size:12px; max-width:160px; text-align:right;">
                                {{ $booking->package?->name ?? ($booking->trek?->name ?? '—') }}
                            </span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Booked On</span>
                            <span class="summary-value" style="font-size:12px;">
                                {{ $booking->created_at->format('M j, Y') }}
                            </span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Duration</span>
                            <span class="summary-value" style="font-size:12px;">
                                @if ($booking->trip_start_date && $booking->trip_end_date)
                                    {{ $booking->trip_start_date->diffInDays($booking->trip_end_date) }} days
                                @else
                                    —
                                @endif
                            </span>
                        </div>
                        <div class="summary-row">
                            <span class="summary-label">Travellers</span>
                            <span class="summary-value" style="font-size:12px;">
                                {{ $booking->num_adults ?? 0 }} adult{{ ($booking->num_adults ?? 0) != 1 ? 's' : '' }}
                                @if ($booking->num_children)
                                    , {{ $booking->num_children }} child{{ $booking->num_children != 1 ? 'ren' : '' }}
                                @endif
                            </span>
                        </div>

                        <div style="margin-top:14px; padding-top:14px; border-top:2px solid #f0f4f8;">
                            <div class="flex items-center justify-between mb-2">
                                <span style="font-size:12px; color:#64748b;">Total Price</span>
                                <span style="font-size:18px; font-weight:800; color:#1e293b;">
                                    ${{ number_format($booking->total_price, 2) }}
                                </span>
                            </div>
                            @php
                                $remaining = ($booking->total_price ?? 0) - ($booking->amount_paid ?? 0);
                            @endphp
                            <div class="flex items-center justify-between">
                                <span style="font-size:12px; color:#64748b;">Amount Paid</span>
                                <span style="font-size:13px; font-weight:600; color:#16a34a;">
                                    ${{ number_format($booking->amount_paid ?? 0, 2) }}
                                </span>
                            </div>
                            @if ($remaining > 0)
                                <div class="flex items-center justify-between mt-1">
                                    <span style="font-size:12px; color:#64748b;">Remaining</span>
                                    <span style="font-size:13px; font-weight:600; color:#dc2626;">
                                        ${{ number_format($remaining, 2) }}
                                    </span>
                                </div>
                            @endif
                        </div>

                    </div>
                </div>

                {{-- Quick actions --}}
                <div class="form-card">
                    <div class="form-card-header">
                        <div class="card-icon" style="background:#f0fdf4;">
                            <i class="fas fa-bolt text-green-500"></i>
                        </div>
                        <h3>Quick Actions</h3>
                    </div>
                    <div class="form-card-body" style="display:flex; flex-direction:column; gap:10px; padding-top:16px;">
                        <a href="{{ route('admin.bookings.show', $booking->id) }}"
                            style="display:flex;align-items:center;gap:9px;padding:10px 14px;border-radius:10px;border:1.5px solid #e8edf3;background:#f8fafc;font-size:13px;font-weight:600;color:#334155;text-decoration:none;transition:all 0.13s;">
                            <i class="fas fa-eye" style="color:#3b82f6;width:16px;"></i>
                            View Full Details
                        </a>
                        <a href="{{ route('admin.bookings.index') }}"
                            style="display:flex;align-items:center;gap:9px;padding:10px 14px;border-radius:10px;border:1.5px solid #e8edf3;background:#f8fafc;font-size:13px;font-weight:600;color:#334155;text-decoration:none;transition:all 0.13s;">
                            <i class="fas fa-list" style="color:#64748b;width:16px;"></i>
                            All Bookings
                        </a>
                    </div>
                </div>

                {{-- Last updated --}}
                <div style="text-align:center; font-size:12px; color:#94a3b8;">
                    <i class="fas fa-clock" style="margin-right:4px;"></i>
                    Last updated {{ $booking->updated_at->diffForHumans() }}
                </div>

            </div>

        </div>
    </form>

@endsection

@push('scripts')
    <script>
        // Live price → remaining calculator
        const totalInput = document.querySelector('[name="total_price"]');
        const paidInput = document.querySelector('[name="amount_paid"]');

        function recalc() {
            const total = parseFloat(totalInput?.value) || 0;
            const paid = parseFloat(paidInput?.value) || 0;
            // Sidebar values update would require a live re-render;
            // this is handled server-side on save.
        }

        totalInput?.addEventListener('input', recalc);
        paidInput?.addEventListener('input', recalc);
        const totalInput = document.querySelector('[name="total_price"]');
        const paidInput = document.querySelector('[name="amount_paid"]');
        const paymentStatusSelect = document.querySelector('[name="payment_status"]');

        function updatePaymentStatus() {
            const total = parseFloat(totalInput?.value) || 0;
            const paid = parseFloat(paidInput?.value) || 0;

            if (paymentStatusSelect) {
                if (paid >= total && total > 0) {
                    paymentStatusSelect.value = 'paid';
                    paymentStatusSelect.style.backgroundColor = '#dcfce7';
                } else if (paid > 0 && paid < total) {
                    paymentStatusSelect.value = 'partial';
                    paymentStatusSelect.style.backgroundColor = '#fef3c7';
                } else {
                    paymentStatusSelect.value = 'pending';
                    paymentStatusSelect.style.backgroundColor = '#fee2e2';
                }
            }

            // Update remaining amount in sidebar if needed
            const remainingSpan = document.querySelector('.summary-value.text-red-600');
            if (remainingSpan) {
                const remaining = total - paid;
                remainingSpan.textContent = `$${remaining.toFixed(2)}`;
            }
        }

        totalInput?.addEventListener('input', updatePaymentStatus);
        paidInput?.addEventListener('input', updatePaymentStatus);

        // Initial call to set correct status on page load
        updatePaymentStatus();
    </script>
@endpush
