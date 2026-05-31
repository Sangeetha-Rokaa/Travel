<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Booking — {{ $booking->booking_ref }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            font-size: 14px;
            color: #1e293b;
            background: #f0f5fb;
            -webkit-font-smoothing: antialiased;
        }

        .wrapper {
            max-width: 620px;
            margin: 32px auto;
            background: #ffffff;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(6, 21, 40, 0.10);
        }

        /* ── Header ── */
        .header {
            background: linear-gradient(135deg, #061528 0%, #0d2240 60%, #1a3a6b 100%);
            padding: 32px 36px 28px;
        }

        .header-top {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }

        .header-logo {
            display: table-cell;
            vertical-align: middle;
        }

        .header-badge {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
        }

        .site-name {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            letter-spacing: 0.3px;
        }

        .site-tag {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.4);
            letter-spacing: 1.5px;
            text-transform: uppercase;
            margin-top: 2px;
        }

        .new-badge {
            display: inline-block;
            background: #16a34a;
            color: #fff;
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1px;
            padding: 5px 14px;
            border-radius: 50px;
        }

        .header-title {
            font-size: 22px;
            font-weight: 700;
            color: #ffffff;
            margin-bottom: 4px;
        }

        .header-sub {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.5);
        }

        .header-ref {
            color: #60a5fa;
            font-weight: 600;
        }

        /* ── Gold stripe ── */
        .gold-stripe {
            height: 3px;
            background: linear-gradient(90deg, #d4940a, #fbbf24, #d4940a);
        }

        /* ── Alert bar ── */
        .alert-bar {
            background: #f0fdf4;
            border-left: 4px solid #16a34a;
            padding: 14px 24px;
            font-size: 13px;
            color: #15803d;
            font-weight: 500;
        }

        .alert-bar strong {
            color: #14532d;
        }

        /* ── Body ── */
        .body {
            padding: 28px 36px;
        }

        /* ── Section ── */
        .section {
            margin-bottom: 24px;
        }

        .section-title {
            font-size: 10px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            color: #1a6fc4;
            padding-bottom: 8px;
            border-bottom: 2px solid #e8f2fd;
            margin-bottom: 14px;
        }

        /* ── Info grid (2-col table) ── */
        .info-table {
            width: 100%;
            border-collapse: collapse;
        }

        .info-table tr td {
            padding: 9px 0;
            border-bottom: 1px solid #f1f5f9;
            vertical-align: top;
        }

        .info-table tr:last-child td {
            border-bottom: none;
        }

        .info-table .td-label {
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #94a3b8;
            width: 38%;
            padding-right: 12px;
        }

        .info-table .td-value {
            font-size: 13px;
            font-weight: 500;
            color: #1e293b;
        }

        .td-value strong {
            font-weight: 700;
            color: #061528;
        }

        /* ── Highlight values ── */
        .val-blue {
            color: #1a6fc4;
            font-weight: 700;
        }

        .val-green {
            color: #16a34a;
            font-weight: 700;
        }

        .val-gold {
            color: #d97706;
            font-weight: 700;
        }

        /* ── Payment card ── */
        .payment-card {
            background: linear-gradient(135deg, #061528, #1a3a6b);
            border-radius: 12px;
            padding: 20px 24px;
            margin-bottom: 24px;
            display: table;
            width: 100%;
        }

        .payment-card-left {
            display: table-cell;
            vertical-align: middle;
            width: 55%;
        }

        .payment-card-right {
            display: table-cell;
            vertical-align: middle;
            text-align: right;
            width: 45%;
        }

        .pc-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.45);
            margin-bottom: 3px;
        }

        .pc-value {
            font-size: 13px;
            font-weight: 600;
            color: #fff;
        }

        .pc-total-label {
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: rgba(255, 255, 255, 0.45);
            margin-bottom: 4px;
        }

        .pc-total-amount {
            font-size: 26px;
            font-weight: 700;
            color: #fbbf24;
        }

        .pc-total-currency {
            font-size: 13px;
            color: rgba(255, 255, 255, 0.6);
            margin-right: 4px;
        }

        .txn-id {
            font-size: 11px;
            color: rgba(255, 255, 255, 0.35);
            margin-top: 6px;
            font-family: 'Courier New', monospace;
        }

        /* ── Status pill ── */
        .status-pill {
            display: inline-block;
            padding: 3px 12px;
            border-radius: 50px;
            font-size: 11px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .pill-paid {
            background: #dcfce7;
            color: #16a34a;
        }

        .pill-pending {
            background: #fef3c7;
            color: #d97706;
        }

        .pill-partial {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .pill-refunded {
            background: #fee2e2;
            color: #dc2626;
        }

        /* ── CTA button ── */
        .cta-wrap {
            text-align: center;
            margin: 28px 0 8px;
        }

        .cta-btn {
            display: inline-block;
            background: linear-gradient(135deg, #1a6fc4, #1255a0);
            color: #ffffff !important;
            text-decoration: none;
            padding: 13px 32px;
            border-radius: 8px;
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 0.3px;
            box-shadow: 0 4px 14px rgba(26, 111, 196, 0.35);
        }

        /* ── Special requirements box ── */
        .special-box {
            background: #fffbeb;
            border-left: 4px solid #d4940a;
            border-radius: 0 8px 8px 0;
            padding: 12px 16px;
            font-size: 13px;
            color: #78350f;
            line-height: 1.6;
            margin-top: 8px;
        }

        /* ── Divider ── */
        .divider {
            border: none;
            border-top: 1px solid #e2e8f0;
            margin: 8px 0 24px;
        }

        /* ── Footer ── */
        .footer {
            background: #f8fafc;
            border-top: 1px solid #e2e8f0;
            padding: 20px 36px;
            text-align: center;
        }

        .footer-site {
            font-size: 13px;
            font-weight: 700;
            color: #061528;
            margin-bottom: 4px;
        }

        .footer-note {
            font-size: 11px;
            color: #94a3b8;
            line-height: 1.6;
        }

        .footer-note a {
            color: #1a6fc4;
            text-decoration: none;
        }
    </style>
</head>

<body>

    @php
        $siteName = setting('site_name', 'ApexNepal');
        $siteTagline = setting('tagline', 'Dream · Explore · Discover');
        $adminUrl = config('app.url') . '/admin/bookings/' . $booking->id;

        $itemName = '—';
        if ($booking->booking_type === 'package' && $booking->package) {
            $itemName = $booking->package->name;
        } elseif ($booking->booking_type === 'trek' && $booking->trek) {
            $itemName = $booking->trek->name;
        } elseif ($booking->booking_type === 'custom') {
            $itemName = 'Custom Request';
        }

        $paymentPillClass = match ($booking->payment_status) {
            'paid' => 'pill-paid',
            'partial' => 'pill-partial',
            'refunded' => 'pill-refunded',
            default => 'pill-pending',
        };
    @endphp

    <div class="wrapper">

        {{-- ── Header ── --}}
        <div class="header">
            <div class="header-top">
                <div class="header-logo">
                    <div class="site-name">{{ $siteName }}</div>
                    <div class="site-tag">{{ $siteTagline }}</div>
                </div>
                <div class="header-badge">
                    <span class="new-badge">&#10003; New Booking</span>
                </div>
            </div>
            <div class="header-title">Booking Received</div>
            <div class="header-sub">
                Reference: <span class="header-ref">{{ $booking->booking_ref }}</span>
                &nbsp;·&nbsp;
                {{ $booking->created_at->format('d M Y, h:i A') }}
            </div>
        </div>

        <div class="gold-stripe"></div>

        {{-- ── Alert bar ── --}}
        <div class="alert-bar">
            <strong>Action Required:</strong> A new booking has been submitted and is awaiting your review.
            Please log in to the admin panel to confirm or process it.
        </div>

        <div class="body">

            {{-- ── Payment summary card ── --}}
            <div class="payment-card">
                <div class="payment-card-left">
                    <div class="pc-label">Payment Method</div>
                    <div class="pc-value">{{ ucfirst($booking->payment_method ?? '—') }}</div>
                    @if ($booking->transaction_id)
                        <div class="txn-id">TXN: {{ $booking->transaction_id }}</div>
                    @endif
                    <div style="margin-top:12px;">
                        <div class="pc-label">Payment Status</div>
                        <span class="status-pill {{ $paymentPillClass }}" style="margin-top:4px;display:inline-block;">
                            {{ ucfirst($booking->payment_status) }}
                        </span>
                    </div>
                </div>
                <div class="payment-card-right">
                    <div class="pc-total-label">Total Amount</div>
                    <div class="pc-total-amount">
                        <span
                            class="pc-total-currency">{{ $booking->currency ?? 'USD' }}</span>{{ number_format($booking->total_price, 2) }}
                    </div>
                    <div class="txn-id" style="margin-top:8px;">
                        {{ $booking->num_adults }} Adult(s)
                        @if ($booking->num_children > 0)
                            / {{ $booking->num_children }} Child(ren)
                        @endif
                    </div>
                </div>
            </div>

            {{-- ── Traveler details ── --}}
            <div class="section">
                <div class="section-title">Traveler Details</div>
                <table class="info-table">
                    <tr>
                        <td class="td-label">Full Name</td>
                        <td class="td-value"><strong>{{ $booking->first_name }} {{ $booking->last_name }}</strong>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">Email</td>
                        <td class="td-value"><a href="mailto:{{ $booking->email }}"
                                style="color:#1a6fc4;">{{ $booking->email }}</a></td>
                    </tr>
                    @if ($booking->phone)
                        <tr>
                            <td class="td-label">Phone</td>
                            <td class="td-value">{{ $booking->phone }}</td>
                        </tr>
                    @endif
                    @if ($booking->nationality)
                        <tr>
                            <td class="td-label">Nationality</td>
                            <td class="td-value">{{ $booking->nationality }}</td>
                        </tr>
                    @endif
                    @if ($booking->passport_number)
                        <tr>
                            <td class="td-label">Passport No.</td>
                            <td class="td-value">{{ $booking->passport_number }}</td>
                        </tr>
                    @endif
                    @if ($booking->date_of_birth)
                        <tr>
                            <td class="td-label">Date of Birth</td>
                            <td class="td-value">{{ \Carbon\Carbon::parse($booking->date_of_birth)->format('d M Y') }}
                            </td>
                        </tr>
                    @endif
                </table>
            </div>

            {{-- ── Trip details ── --}}
            <div class="section">
                <div class="section-title">Trip Details</div>
                <table class="info-table">
                    <tr>
                        <td class="td-label">Booking Type</td>
                        <td class="td-value">
                            <span
                                class="val-blue">{{ \App\Models\Booking::BOOKING_TYPES[$booking->booking_type] ?? ucfirst($booking->booking_type) }}</span>
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">Package / Trek</td>
                        <td class="td-value"><strong>{{ $itemName }}</strong></td>
                    </tr>
                    @if ($booking->trip_start_date)
                        <tr>
                            <td class="td-label">Start Date</td>
                            <td class="td-value">
                                {{ \Carbon\Carbon::parse($booking->trip_start_date)->format('d M Y') }}</td>
                        </tr>
                    @endif
                    @if ($booking->trip_end_date)
                        <tr>
                            <td class="td-label">End Date</td>
                            <td class="td-value">{{ \Carbon\Carbon::parse($booking->trip_end_date)->format('d M Y') }}
                            </td>
                        </tr>
                    @endif
                    @if ($booking->accommodation_preference)
                        <tr>
                            <td class="td-label">Accommodation</td>
                            <td class="td-value">{{ ucfirst($booking->accommodation_preference) }}</td>
                        </tr>
                    @endif
                    @if ($booking->pickup_location)
                        <tr>
                            <td class="td-label">Pickup Location</td>
                            <td class="td-value">{{ $booking->pickup_location }}</td>
                        </tr>
                    @endif
                </table>
            </div>

            {{-- ── Special requirements ── --}}
            @if ($booking->special_requirements)
                <div class="section">
                    <div class="section-title">Special Requirements</div>
                    <div class="special-box">{{ $booking->special_requirements }}</div>
                </div>
            @endif

            {{-- ── Pricing summary ── --}}
            <div class="section">
                <div class="section-title">Pricing Summary</div>
                <table class="info-table">
                    <tr>
                        <td class="td-label">Base Price</td>
                        <td class="td-value">{{ $booking->currency ?? 'USD' }}
                            {{ number_format($booking->base_price, 2) }} / person</td>
                    </tr>
                    @if ($booking->discount_amount > 0)
                        <tr>
                            <td class="td-label">Discount</td>
                            <td class="td-value" style="color:#16a34a;">- {{ $booking->currency ?? 'USD' }}
                                {{ number_format($booking->discount_amount, 2) }}</td>
                        </tr>
                    @endif
                    <tr>
                        <td class="td-label">Total</td>
                        <td class="td-value val-blue" style="font-size:16px;">
                            {{ $booking->currency ?? 'USD' }} {{ number_format($booking->total_price, 2) }}
                        </td>
                    </tr>
                    <tr>
                        <td class="td-label">Amount Paid</td>
                        <td class="td-value val-green">
                            {{ $booking->currency ?? 'USD' }} {{ number_format($booking->amount_paid, 2) }}
                        </td>
                    </tr>
                </table>
            </div>

            {{-- ── CTA ── --}}
            <hr class="divider">
            <div class="cta-wrap">
                <a href="{{ $adminUrl }}" class="cta-btn">
                    View Booking in Admin Panel &rarr;
                </a>
            </div>

        </div>

        {{-- ── Footer ── --}}
        <div class="footer">
            <div class="footer-site">{{ $siteName }}</div>
            <div class="footer-note">
                This is an automated notification sent by {{ $siteName }}.<br>
                Please do not reply to this email.
                @if (setting('contact_email'))
                    For help, contact <a
                        href="mailto:{{ setting('contact_email') }}">{{ setting('contact_email') }}</a>.
                @endif
            </div>
        </div>

    </div>

</body>

</html>
