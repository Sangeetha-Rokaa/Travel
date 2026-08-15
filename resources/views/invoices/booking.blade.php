<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>Invoice {{ $booking->booking_ref }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 13px;
            color: #1e293b;
            background: #ffffff;
            padding: 0;
        }

        /* ── Header Band ── */
        .header {
            background: #061528;
            padding: 32px 40px 28px;
            position: relative;
        }

        .header-inner {
            display: table;
            width: 100%;
        }

        .header-left {
            display: table-cell;
            vertical-align: middle;
            width: 60%;
        }

        .header-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 40%;
        }

        .logo-wrap {
            display: table;
        }

        .logo-icon {
            display: table-cell;
            vertical-align: middle;
            width: 48px;
            height: 48px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            border-radius: 8px;
            text-align: center;
            padding-top: 12px;
        }

        .logo-img {
            width: 44px;
            height: 44px;
            object-fit: contain;
            border-radius: 6px;
            display: block;
        }

        .logo-text {
            display: table-cell;
            vertical-align: middle;
            padding-left: 12px;
        }

        .site-name {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.3px;
            display: block;
        }

        .site-tag {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.45);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 2px;
            display: block;
        }

        .invoice-label {
            font-size: 28px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: block;
        }

        .invoice-ref {
            font-size: 13px;
            color: #60a5fa;
            margin-top: 4px;
            display: block;
            letter-spacing: 0.5px;
        }

        /* ── Gold accent stripe ── */
        .accent-stripe {
            height: 4px;
            background: linear-gradient(90deg, #d4940a 0%, #fbbf24 50%, #d4940a 100%);
        }

        /* ── Body padding ── */
        .body {
            padding: 32px 40px;
        }

        /* ── Status + Date row ── */
        .meta-row {
            display: table;
            width: 100%;
            margin-bottom: 28px;
        }

        .meta-left {
            display: table-cell;
            vertical-align: top;
            width: 50%;
        }

        .meta-right {
            display: table-cell;
            vertical-align: top;
            text-align: right;
            width: 50%;
        }

        .meta-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #94a3b8;
            margin-bottom: 3px;
        }

        .meta-value {
            font-size: 13px;
            font-weight: 600;
            color: #1e293b;
        }

        .status-badge {
            display: inline-block;
            padding: 4px 14px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-paid {
            background: #dcfce7;
            color: #16a34a;
        }

        .status-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .status-partial {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status-refunded {
            background: #fee2e2;
            color: #dc2626;
        }

        /* ── Section heading ── */
        .section-title {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #1a6fc4;
            padding-bottom: 7px;
            border-bottom: 2px solid #e8f2fd;
            margin-bottom: 14px;
        }

        /* ── Two-column info blocks ── */
        .info-row {
            display: table;
            width: 100%;
            margin-bottom: 24px;
        }

        .info-col {
            display: table-cell;
            vertical-align: top;
            width: 50%;
            padding-right: 24px;
        }

        .info-col:last-child {
            padding-right: 0;
        }

        .info-item {
            margin-bottom: 10px;
        }

        .info-item-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.8px;
            color: #94a3b8;
            margin-bottom: 2px;
        }

        .info-item-value {
            font-size: 13px;
            color: #1e293b;
            font-weight: 500;
        }

        /* ── Trip details table ── */
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 24px;
        }

        .details-table thead tr {
            background: #061528;
        }

        .details-table thead th {
            padding: 11px 14px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.75);
            text-align: left;
        }

        .details-table tbody tr {
            border-bottom: 1px solid #e2e8f0;
        }

        .details-table tbody tr:last-child {
            border-bottom: none;
        }

        .details-table tbody tr:nth-child(even) {
            background: #f8fafc;
        }

        .details-table tbody td {
            padding: 11px 14px;
            font-size: 13px;
            color: #334155;
            vertical-align: top;
        }

        .details-table tbody td.label {
            color: #64748b;
            font-size: 12px;
            width: 38%;
        }

        .details-table tbody td.value {
            font-weight: 600;
            color: #1e293b;
        }

        /* ── Pricing table ── */
        .pricing-wrap {
            margin-bottom: 28px;
        }

        .pricing-table {
            width: 100%;
            border-collapse: collapse;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            overflow: hidden;
        }

        .pricing-table thead tr {
            background: #1a6fc4;
        }

        .pricing-table thead th {
            padding: 11px 16px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #fff;
            text-align: left;
        }

        .pricing-table thead th:last-child {
            text-align: right;
        }

        .pricing-table tbody td {
            padding: 12px 16px;
            font-size: 13px;
            color: #334155;
            border-bottom: 1px solid #e2e8f0;
        }

        .pricing-table tbody tr:last-child td {
            border-bottom: none;
        }

        .pricing-table tbody td:last-child {
            text-align: right;
            font-weight: 600;
        }

        .pricing-table tfoot td {
            padding: 14px 16px;
            font-weight: 700;
            border-top: 2px solid #1a6fc4;
        }

        .pricing-table tfoot .total-label {
            font-size: 14px;
            color: #061528;
        }

        .pricing-table tfoot .total-value {
            text-align: right;
            font-size: 20px;
            color: #1a6fc4;
        }

        /* ── Payment info box ── */
        .payment-box {
            background: #f0f9f4;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            padding: 16px 20px;
            margin-bottom: 28px;
            display: table;
            width: 100%;
        }

        .payment-box-left {
            display: table-cell;
            vertical-align: middle;
            width: 50%;
        }

        .payment-box-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 50%;
        }

        .payment-box .pb-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #16a34a;
            margin-bottom: 3px;
        }

        .payment-box .pb-value {
            font-size: 13px;
            font-weight: 600;
            color: #15803d;
        }

        .txn-id {
            font-size: 11px;
            color: #64748b;
            margin-top: 4px;
            font-family: DejaVu Sans Mono, monospace;
        }

        /* ── Notes box ── */
        .notes-box {
            background: #fffbeb;
            border-left: 4px solid #d4940a;
            border-radius: 0 8px 8px 0;
            padding: 14px 18px;
            margin-bottom: 28px;
            font-size: 12px;
            color: #78350f;
            line-height: 1.6;
        }

        /* ── Footer ── */
        .footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 20px 40px;
            display: table;
            width: 100%;
        }

        .footer-left {
            display: table-cell;
            vertical-align: middle;
            width: 60%;
        }

        .footer-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 40%;
        }

        .footer-site-name {
            font-size: 13px;
            font-weight: 700;
            color: #061528;
        }

        .footer-tagline {
            font-size: 10px;
            color: #94a3b8;
            margin-top: 2px;
        }

        .footer-note {
            font-size: 10px;
            color: #94a3b8;
            line-height: 1.6;
        }

        /* ── Divider ── */
        .divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 20px 0;
        }

        /* ── Booking type pill ── */
        .type-pill {
            display: inline-block;
            background: #e8f2fd;
            color: #1a6fc4;
            border-radius: 50px;
            padding: 3px 12px;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }
    </style>
</head>

<body>

    @php
        $siteName = setting('site_name', 'ApexNepal');
        $siteTagline = setting('tagline', 'Dream · Explore · Discover');
        $siteEmail = setting('contact_email', '');
        $sitePhone = setting('contact_phone', '');
        $siteAddress = setting('address', 'Kathmandu, Nepal');
        $siteLogo = setting('site_logo');
        $logoUrl = $siteLogo
            ? (Str::startsWith($siteLogo, 'http')
                ? $siteLogo
                : public_path('storage/' . $siteLogo))
            : null;

        $itemName = '—';
        if ($booking->booking_type === 'package' && $booking->package) {
            $itemName = $booking->package->name;
        } elseif ($booking->booking_type === 'trek' && $booking->trek) {
            $itemName = $booking->trek->name;
        } elseif ($booking->booking_type === 'custom') {
            $itemName = 'Custom Request';
        }

        $duration = null;
        if ($booking->trip_start_date && $booking->trip_end_date) {
            $duration = $booking->trip_start_date->diffInDays($booking->trip_end_date) . ' Days';
        } elseif ($booking->booking_type === 'package' && $booking->package?->duration_days) {
            $duration = $booking->package->duration_days . ' Days';
        } elseif ($booking->booking_type === 'trek' && $booking->trek?->duration_days) {
            $duration = $booking->trek->duration_days . ' Days';
        }

        $statusClass = match ($booking->payment_status) {
            'paid' => 'status-paid',
            'partial' => 'status-partial',
            'refunded' => 'status-refunded',
            default => 'status-pending',
        };
    @endphp

    {{-- ══════════════ HEADER ══════════════ --}}
    <div class="header">
        <div class="header-inner">
            <div class="header-left">
                <div class="logo-wrap">
                    @if ($logoUrl)
                        <div class="logo-icon" style="padding-top:2px;">
                            <img src="{{ $logoUrl }}" alt="{{ $siteName }}" class="logo-img" />
                        </div>
                    @else
                        <div class="logo-icon">
                            <span style="color:rgba(255,255,255,0.6);font-size:20px;">&#9650;</span>
                        </div>
                    @endif
                    <div class="logo-text">
                        <span class="site-name">{{ $siteName }}</span>
                        <span class="site-tag">{{ $siteTagline }}</span>
                    </div>
                </div>
            </div>
            <div class="header-right">
                <span class="invoice-label">Invoice</span>
                <span class="invoice-ref">{{ $booking->booking_ref }}</span>
            </div>
        </div>
    </div>

    <div class="accent-stripe"></div>

    {{-- ══════════════ BODY ══════════════ --}}
    <div class="body">

        {{-- Meta row: issue date + status --}}
        <div class="meta-row">
            <div class="meta-left">
                <div class="meta-label">Issue Date</div>
                <div class="meta-value">{{ $booking->created_at->format('d M Y') }}</div>
                @if ($booking->paid_at)
                    <div class="meta-label" style="margin-top:8px;">Paid On</div>
                    <div class="meta-value">{{ $booking->paid_at->format('d M Y, h:i A') }}</div>
                @endif
            </div>
            <div class="meta-right">
                <div class="meta-label" style="margin-bottom:5px;">Payment Status</div>
                <span class="status-badge {{ $statusClass }}">
                    {{ ucfirst($booking->payment_status) }}
                </span>
                <div style="margin-top:10px;">
                    <span
                        class="type-pill">{{ \App\Models\Booking::BOOKING_TYPES[$booking->booking_type] ?? $booking->booking_type }}</span>
                </div>
            </div>
        </div>

        {{-- Traveler & Company info --}}
        <div class="info-row">
            <div class="info-col">
                <div class="section-title">Billed To</div>
                <div class="info-item">
                    <div class="info-item-label">Full Name</div>
                    <div class="info-item-value" style="font-size:15px;font-weight:700;">{{ $booking->full_name }}
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-item-label">Email</div>
                    <div class="info-item-value">{{ $booking->email }}</div>
                </div>
                @if ($booking->phone)
                    <div class="info-item">
                        <div class="info-item-label">Phone</div>
                        <div class="info-item-value">{{ $booking->phone }}</div>
                    </div>
                @endif
                @if ($booking->nationality)
                    <div class="info-item">
                        <div class="info-item-label">Nationality</div>
                        <div class="info-item-value">{{ $booking->nationality }}</div>
                    </div>
                @endif
                @if ($booking->passport_number)
                    <div class="info-item">
                        <div class="info-item-label">Passport No.</div>
                        <div class="info-item-value">{{ $booking->passport_number }}</div>
                    </div>
                @endif
            </div>
            <div class="info-col">
                <div class="section-title">From</div>
                <div class="info-item">
                    <div class="info-item-value" style="font-size:15px;font-weight:700;">{{ $siteName }}</div>
                </div>
                @if ($siteAddress)
                    <div class="info-item">
                        <div class="info-item-label">Address</div>
                        <div class="info-item-value">{{ $siteAddress }}</div>
                    </div>
                @endif
                @if ($siteEmail)
                    <div class="info-item">
                        <div class="info-item-label">Email</div>
                        <div class="info-item-value">{{ $siteEmail }}</div>
                    </div>
                @endif
                @if ($sitePhone)
                    <div class="info-item">
                        <div class="info-item-label">Phone</div>
                        <div class="info-item-value">{{ $sitePhone }}</div>
                    </div>
                @endif
            </div>
        </div>

        {{-- Trip details --}}
        <div class="section-title">Trip Details</div>
        <table class="details-table" style="margin-bottom:24px;">
            <thead>
                <tr>
                    <th>Field</th>
                    <th>Details</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="label">Package / Trek</td>
                    <td class="value">{{ $itemName }}</td>
                </tr>
                @if ($duration)
                    <tr>
                        <td class="label">Duration</td>
                        <td class="value">{{ $duration }}</td>
                    </tr>
                @endif
                @if ($booking->trip_start_date)
                    <tr>
                        <td class="label">Start Date</td>
                        <td class="value">{{ $booking->trip_start_date->format('d M Y') }}</td>
                    </tr>
                @endif
                @if ($booking->trip_end_date)
                    <tr>
                        <td class="label">End Date</td>
                        <td class="value">{{ $booking->trip_end_date->format('d M Y') }}</td>
                    </tr>
                @endif
                <tr>
                    <td class="label">Travelers</td>
                    <td class="value">
                        {{ $booking->num_adults }} Adult(s)
                        @if ($booking->num_children > 0)
                            &nbsp;/&nbsp; {{ $booking->num_children }} Child(ren)
                        @endif
                    </td>
                </tr>
                @if ($booking->accommodation_preference)
                    <tr>
                        <td class="label">Accommodation</td>
                        <td class="value">{{ ucfirst($booking->accommodation_preference) }}</td>
                    </tr>
                @endif
                @if ($booking->pickup_location)
                    <tr>
                        <td class="label">Pickup Location</td>
                        <td class="value">{{ $booking->pickup_location }}</td>
                    </tr>
                @endif
            </tbody>
        </table>

        {{-- Pricing breakdown --}}
        <div class="pricing-wrap">
            <div class="section-title">Pricing Breakdown</div>
            <table class="pricing-table">
                <thead>
                    <tr>
                        <th>Description</th>
                        <th>Qty</th>
                        <th>Unit Price</th>
                        <th>Amount</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>{{ $itemName }}</td>
                        <td>{{ $booking->num_adults }} Adult(s)</td>
                        <td>{{ $booking->currency ?? 'USD' }} {{ number_format($booking->base_price, 2) }}</td>
                        <td>{{ $booking->currency ?? 'USD' }}
                            {{ number_format($booking->base_price * $booking->num_adults, 2) }}</td>
                    </tr>
                    @if ($booking->num_children > 0)
                        <tr>
                            <td>{{ $itemName }} (Children)</td>
                            <td>{{ $booking->num_children }} Child(ren)</td>
                            <td>—</td>
                            <td>Included</td>
                        </tr>
                    @endif
                    @if ($booking->discount_amount > 0)
                        <tr>
                            <td colspan="3" style="color:#16a34a;">Discount Applied</td>
                            <td style="color:#16a34a;">- {{ $booking->currency ?? 'USD' }}
                                {{ number_format($booking->discount_amount, 2) }}</td>
                        </tr>
                    @endif
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3" class="total-label">Total Amount</td>
                        <td class="total-value">{{ $booking->currency ?? 'USD' }}
                            {{ number_format($booking->total_price, 2) }}</td>
                    </tr>
                </tfoot>
            </table>
        </div>

        {{-- Payment info --}}
        <div class="payment-box">
            <div class="payment-box-left">
                <div class="pb-label">Payment Method</div>
                <div class="pb-value">{{ ucfirst($booking->payment_method ?? '—') }}</div>
                @if ($booking->transaction_id)
                    <div class="txn-id">TXN: {{ $booking->transaction_id }}</div>
                @endif
            </div>
            <div class="payment-box-right">
                <div class="pb-label">Amount Paid</div>
                <div class="pb-value" style="font-size:18px;">
                    {{ $booking->currency ?? 'USD' }} {{ number_format($booking->amount_paid, 2) }}
                </div>
            </div>
        </div>

        {{-- Special requirements --}}
        @if ($booking->special_requirements)
            <div class="notes-box">
                <strong>Special Requirements:</strong><br>
                {{ $booking->special_requirements }}
            </div>
        @endif

        {{-- Booking status note --}}
        <div
            style="background:#f0f5fb;border-radius:8px;padding:14px 18px;margin-bottom:4px;font-size:12px;color:#334155;">
            <strong>Booking Status:</strong>
            <span
                style="color:
            @if ($booking->status === 'confirmed') #16a34a
            @elseif($booking->status === 'cancelled') #dc2626
            @elseif($booking->status === 'completed') #1a6fc4
            @else #d97706 @endif;font-weight:700;">
                {{ \App\Models\Booking::BOOKING_STATUSES[$booking->status] ?? ucfirst($booking->status) }}
            </span>
            &nbsp;&nbsp;|&nbsp;&nbsp;
            <strong>Booking Date:</strong> {{ $booking->created_at->format('d M Y') }}
            @if ($booking->confirmed_at)
                &nbsp;&nbsp;|&nbsp;&nbsp;<strong>Confirmed:</strong> {{ $booking->confirmed_at->format('d M Y') }}
            @endif
        </div>

    </div>

    {{-- ══════════════ FOOTER ══════════════ --}}
    <div class="footer">
        <div class="footer-left">
            <div class="footer-site-name">{{ $siteName }}</div>
            <div class="footer-tagline">{{ $siteTagline }}</div>
            @if ($siteAddress)
                <div class="footer-note" style="margin-top:4px;">{{ $siteAddress }}</div>
            @endif
        </div>
        <div class="footer-right">
            <div class="footer-note">
                Thank you for choosing {{ $siteName }}.<br>
                This is a system-generated invoice.<br>
                For queries: {{ $siteEmail ?: 'contact us' }}
            </div>
        </div>
    </div>

</body>

</html>
