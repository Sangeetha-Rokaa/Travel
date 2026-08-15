@extends('layouts.store')
@section('title', 'Order Confirmed – ' . setting('site_name', 'TrailCo'))

@push('styles')
    <style>
        .success-page {
            max-width: 720px;
            margin: 0 auto;
            padding: 80px 24px 100px;
            text-align: center;
        }

        .success-icon {
            width: 84px;
            height: 84px;
            border-radius: 50%;
            background: var(--green);
            color: #16210a;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 26px;
            font-size: 2rem;
        }

        .success-page h1 {
            font-size: 1.9rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .success-page p.sub {
            color: var(--muted);
            margin-bottom: 30px;
            font-size: .95rem;
        }

        .order-number-chip {
            display: inline-block;
            background: var(--panel);
            padding: 10px 20px;
            border-radius: 30px;
            font-weight: 700;
            font-size: .95rem;
            margin-bottom: 40px;
        }

        .order-summary-box {
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 26px;
            text-align: left;
            margin-bottom: 32px;
        }

        .order-summary-box h3 {
            font-size: 1rem;
            font-weight: 700;
            margin-bottom: 16px;
        }

        .osi-row {
            display: flex;
            justify-content: space-between;
            font-size: .88rem;
            padding: 10px 0;
            border-bottom: 1px solid var(--line);
        }

        .osi-row:last-child {
            border-bottom: none;
        }

        .osi-row .name {
            color: var(--ink);
            font-weight: 500;
        }

        .osi-row .meta {
            color: var(--muted);
        }

        .success-actions {
            display: flex;
            justify-content: center;
            gap: 14px;
            flex-wrap: wrap;
        }
    </style>
@endpush

@section('content')
    <div class="success-page">
        <div class="success-icon"><i class="fas fa-check"></i></div>

        <h1>Order Placed Successfully!</h1>
        <p class="sub">Thanks, {{ $order->full_name }} — we've received your order and we're getting it ready for the
            trail.</p>

        <div class="order-number-chip">Order #{{ $order->order_number }}</div>

        <div class="order-summary-box">
            <h3>Order Details</h3>
            @foreach ($order->items as $item)
                <div class="osi-row">
                    <span class="name">{{ $item->product_name }} <span class="meta">× {{ $item->quantity }}</span></span>
                    <span>{{ setting('currency', 'Rs.') }} {{ number_format($item->total) }}</span>
                </div>
            @endforeach
            <div class="osi-row">
                <span class="name">Shipping</span>
                <span>{{ $order->shipping_cost > 0 ? setting('currency', 'Rs.') . ' ' . number_format($order->shipping_cost) : 'Free' }}</span>
            </div>
            <div class="osi-row">
                <span class="name" style="font-weight:700;">Total</span>
                <span style="font-weight:700;">{{ setting('currency', 'Rs.') }} {{ number_format($order->total) }}</span>
            </div>
        </div>

        <div class="success-actions">
            <a href="{{ route('store.index') }}" class="btn-primary">
                CONTINUE SHOPPING
                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                    stroke-width="2.4" stroke-linecap="round">
                    <path d="M5 12h14M13 6l6 6-6 6" />
                </svg>
            </a>
            <a href="{{ route('home') }}" class="btn-outline">BACK TO HOME</a>
        </div>
    </div>
@endsection
