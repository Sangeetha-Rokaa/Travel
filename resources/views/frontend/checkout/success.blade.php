@extends('layouts.store')
@section('title', 'Order Confirmed – ' . setting('site_name', 'TrailCo'))

@section('content')
    <div class="flow-page">

        @include('frontend.store.partials.step-tracker', ['active' => 4])

        @php
            $currency = setting('currency', 'Rs.');
        @endphp

        <div class="success-page" style="margin: 0 auto;">

            <div class="success-hero">
                <div class="success-check-wrap">
                    <i class="fas fa-check"></i>
                </div>
                <h1>Order Placed Successfully!</h1>
                <p>Thank you for shopping with us. Your order has been placed and is confirmed.</p>
            </div>

            <div class="success-info-card">
                <div class="order-detail-list">
                    <div class="order-detail-row">
                        <span>Order ID</span>
                        <span>#{{ $order->order_number }}</span>
                    </div>
                    <div class="order-detail-row">
                        <span>Order Date</span>
                        <span>{{ $order->created_at->format('M d, Y, h:i A') }}</span>
                    </div>
                    <div class="order-detail-row">
                        <span>Total Amount</span>
                        <span>{{ $currency }} {{ number_format($order->total) }}</span>
                    </div>
                    <div class="order-detail-row">
                        <span>Payment Method</span>
                        <span>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                    </div>
                    <div class="order-detail-row">
                        <span>Payment Status</span>
                        <span class="status-pill">{{ ucfirst($order->payment_status) }}</span>
                    </div>
                </div>
            </div>

            <div class="whats-next">
                <h3>What's Next?</h3>

                <div class="next-step-row done">
                    <div class="next-step-icon"><i class="fas fa-check"></i></div>
                    <div class="next-step-body">
                        <strong>Order Confirmed</strong>
                        <span>We've received your order.</span>
                    </div>
                </div>

                <div class="next-step-row done">
                    <div class="next-step-icon"><i class="fas fa-check"></i></div>
                    <div class="next-step-body">
                        <strong>Processing</strong>
                        <span>We're preparing your items.</span>
                    </div>
                </div>

                <div class="next-step-row done">
                    <div class="next-step-icon"><i class="fas fa-check"></i></div>
                    <div class="next-step-body">
                        <strong>On the Way</strong>
                        <span>Your order is on its way.</span>
                    </div>
                </div>
            </div>

            <div class="success-promo-card">
                <h3>Gear up for your next adventure!</h3>
                <a href="{{ route('store.index') }}" class="btn-primary">
                    Shop More Gear
                    <i class="fas fa-arrow-right"></i>
                </a>
            </div>

            <a href="{{ route('order.summary', $order->order_number) }}" class="track-order-btn">
                Track Your Order
                <i class="fas fa-arrow-right"></i>
            </a>

        </div>

    </div>
@endsection
