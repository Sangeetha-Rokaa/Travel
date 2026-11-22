@extends('layouts.store')
@section('title', 'Order Summary – ' . setting('site_name', 'TrailCo'))

@section('content')
    <div class="flow-page">

        @include('frontend.store.partials.step-tracker', ['active' => 3])

        <div class="flow-header">
            <h1>Order Summary</h1>
            <p>Thank you! Your order has been placed.</p>
        </div>

        @php
            $currency = setting('currency', 'Rs.');
        @endphp

        <div class="checkout-layout">

            <!-- LEFT: ORDER DETAILS + ITEMS -->
            <div>

                <div class="order-success-banner">
                    <i class="fas fa-check-circle"></i>
                    <div>
                        <strong>Order Placed Successfully!</strong>
                        <span>Your order has been confirmed and is being processed.</span>
                    </div>
                </div>

                <div class="flow-card">
                    <h3>Order Details</h3>
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
                            <span>Payment Method</span>
                            <span>{{ ucfirst(str_replace('_', ' ', $order->payment_method)) }}</span>
                        </div>
                        <div class="order-detail-row">
                            <span>Payment Status</span>
                            <span class="status-pill">{{ ucfirst($order->payment_status) }}</span>
                        </div>
                        <div class="order-detail-row">
                            <span>Order Status</span>
                            <span class="status-pill">{{ ucfirst($order->status) }}</span>
                        </div>
                    </div>
                </div>

                <div class="flow-card">
                    <h3>Order Items</h3>
                    @foreach ($order->items as $item)
                        <div class="order-item-row">
                            <div class="oi-img">
                                @if ($item->image)
                                    <img src="{{ Storage::url($item->image) }}" alt="{{ $item->product_name }}">
                                @else
                                    <i class="fas fa-image" style="color:#cbd5c8;"></i>
                                @endif
                            </div>
                            <div class="oi-body">
                                <strong>{{ $item->product_name }}</strong>
                                <span>Qty: {{ $item->quantity }}</span>
                            </div>
                            <div class="oi-price">{{ $currency }} {{ number_format($item->total) }}</div>
                        </div>
                    @endforeach
                </div>

                <div class="info-box-row">
                    <div class="info-box">
                        <i class="fas fa-calendar-alt"></i>
                        <div>
                            <strong>Estimated Delivery</strong>
                            <div class="info-box-value">
                                {{ optional($order->estimated_delivery_at)->format('M d, Y') ?? '—' }}</div>
                            <div class="info-box-sub">3-5 business days</div>
                        </div>
                    </div>
                    <div class="info-box">
                        <i class="fas fa-life-ring"></i>
                        <div>
                            <strong>Need Help?</strong>
                            <div class="info-box-sub"><i class="fas fa-envelope" style="width:14px;"></i>
                                {{ setting('contact_email', 'support@' . Str::slug(setting('site_name', 'store')) . '.com') }}
                            </div>
                            <div class="info-box-sub"><i class="fas fa-phone-alt" style="width:14px;"></i>
                                {{ setting('phone', '+977 9800000000') }}</div>
                        </div>
                    </div>
                </div>

                <a href="{{ route('store.index') }}" class="continue-shopping-btn">
                    Continue Shopping
                    <i class="fas fa-arrow-right"></i>
                </a>

            </div>

            <!-- RIGHT: TOTALS -->
            <div class="order-summary-card">
                <h3>Order Summary</h3>

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>{{ $currency }} {{ number_format($order->subtotal) }}</span>
                </div>
                <div class="summary-row {{ $order->shipping_cost == 0 ? 'free' : '' }}">
                    <span>Delivery Fee</span>
                    <span>{{ $order->shipping_cost > 0 ? $currency . ' ' . number_format($order->shipping_cost) : 'Free' }}</span>
                </div>
                <div class="summary-row">
                    <span>Tax</span>
                    <span>{{ $currency }} {{ number_format($order->tax) }}</span>
                </div>

                <div class="summary-total">
                    <strong>Total Amount</strong>
                    <span class="value" style="color:var(--green-dark);">{{ $currency }}
                        {{ number_format($order->total) }}</span>
                </div>
            </div>

        </div>

    </div>
@endsection
