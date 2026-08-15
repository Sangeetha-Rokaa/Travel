@extends('layouts.store')
@section('title', 'Checkout – ' . setting('site_name', 'TrailCo'))

@push('styles')
    <style>
        .checkout-page {
            padding: 50px 60px 90px;
            max-width: 1300px;
            margin: 0 auto;
        }

        .checkout-header {
            margin-bottom: 34px;
        }

        .checkout-header h1 {
            font-size: 2rem;
            font-weight: 700;
        }

        .checkout-layout {
            display: grid;
            grid-template-columns: 1fr 380px;
            gap: 36px;
            align-items: start;
        }

        .checkout-form-card {
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 28px;
        }

        .checkout-form-card h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .form-group.full {
            grid-column: 1 / -1;
        }

        .form-group label {
            font-size: .82rem;
            font-weight: 600;
            color: var(--ink);
        }

        .form-group input,
        .form-group textarea,
        .form-group select {
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 11px 14px;
            font-family: 'Inter', sans-serif;
            font-size: .88rem;
            transition: border-color .2s;
        }

        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--green);
        }

        .form-group textarea {
            resize: vertical;
            min-height: 80px;
        }

        .error-text {
            color: #c1362b;
            font-size: .78rem;
        }

        .payment-options {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 20px;
        }

        .payment-option {
            display: flex;
            align-items: center;
            gap: 12px;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 14px 16px;
            cursor: pointer;
            transition: border-color .2s, background .2s;
        }

        .payment-option:has(input:checked) {
            border-color: var(--green);
            background: #f5faee;
        }

        .payment-option input {
            accent-color: var(--green);
        }

        .payment-option .po-label {
            font-size: .88rem;
            font-weight: 600;
        }

        .payment-option .po-sub {
            font-size: .76rem;
            color: var(--muted);
        }

        /* ---------- Summary ---------- */
        .checkout-summary {
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 26px;
            position: sticky;
            top: 96px;
        }

        .checkout-summary h3 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 18px;
        }

        .co-item {
            display: flex;
            gap: 12px;
            align-items: center;
            margin-bottom: 14px;
        }

        .co-item-img {
            width: 52px;
            height: 52px;
            border-radius: 6px;
            background: var(--panel);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .co-item-img img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .co-item-img i {
            color: var(--line);
        }

        .co-item-info {
            flex: 1;
        }

        .co-item-info h4 {
            font-size: .84rem;
            font-weight: 600;
            margin-bottom: 2px;
        }

        .co-item-info span {
            font-size: .76rem;
            color: var(--muted);
        }

        .co-item-price {
            font-size: .85rem;
            font-weight: 700;
            white-space: nowrap;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: .88rem;
            color: var(--muted);
            margin: 12px 0;
            padding-top: 16px;
            border-top: 1px solid var(--line);
        }

        .summary-row span:last-child {
            color: var(--ink);
            font-weight: 500;
        }

        .summary-total {
            display: flex;
            justify-content: space-between;
            font-size: 1.1rem;
            font-weight: 700;
            padding-top: 14px;
            border-top: 1px solid var(--line);
        }

        .place-order-btn {
            width: 100%;
            justify-content: center;
            margin-top: 20px;
            border: none;
            cursor: pointer;
            font-family: 'Inter', sans-serif;
        }

        @media (max-width: 1000px) {
            .checkout-layout {
                grid-template-columns: 1fr;
            }

            .checkout-summary {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .checkout-page {
                padding: 30px 20px 60px;
            }

            .form-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
@endpush

@section('content')
    <div class="checkout-page">

        <div class="checkout-header">
            <div class="eyebrow">Almost There</div>
            <h1>Checkout</h1>
        </div>

        @if ($errors->any())
            <div class="flash-banner error"
                style="display:flex;align-items:center;gap:10px;padding:14px 18px;border-radius:8px;font-size:.88rem;font-weight:600;margin-bottom:20px;background:#fdecea;color:#c1362b;">
                <i class="fas fa-exclamation-circle"></i> Please fix the errors below and try again.
            </div>
        @endif

        <form action="{{ route('checkout.store') }}" method="POST" class="checkout-layout">
            @csrf

            <!-- ================= FORM ================= -->
            <div class="checkout-form-card">
                <h3>Shipping Details</h3>

                <div class="form-grid">
                    <div class="form-group full">
                        <label for="full_name">Full Name</label>
                        <input type="text" id="full_name" name="full_name" value="{{ old('full_name') }}" required>
                        @error('full_name')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="text" id="phone" name="phone" value="{{ old('phone') }}" required>
                        @error('phone')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="address">Street Address</label>
                        <input type="text" id="address" name="address" value="{{ old('address') }}" required>
                        @error('address')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="city">City</label>
                        <input type="text" id="city" name="city" value="{{ old('city') }}" required>
                        @error('city')
                            <span class="error-text">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group full">
                        <label for="notes">Order Notes (optional)</label>
                        <textarea id="notes" name="notes" placeholder="Delivery instructions, gate code, etc.">{{ old('notes') }}</textarea>
                    </div>
                </div>

                <h3 style="margin-top:28px;">Payment Method</h3>
                <div class="payment-options">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="cod"
                            {{ old('payment_method', 'cod') === 'cod' ? 'checked' : '' }}>
                        <div>
                            <div class="po-label">Cash on Delivery</div>
                            <div class="po-sub">Pay when your order arrives</div>
                        </div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="esewa"
                            {{ old('payment_method') === 'esewa' ? 'checked' : '' }}>
                        <div>
                            <div class="po-label">eSewa</div>
                            <div class="po-sub">Pay online via eSewa wallet</div>
                        </div>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="bank_transfer"
                            {{ old('payment_method') === 'bank_transfer' ? 'checked' : '' }}>
                        <div>
                            <div class="po-label">Bank Transfer</div>
                            <div class="po-sub">Transfer directly to our account</div>
                        </div>
                    </label>
                    @error('payment_method')
                        <span class="error-text">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <!-- ================= SUMMARY ================= -->
            <div class="checkout-summary">
                <h3>Order Summary</h3>

                @foreach ($items as $item)
                    <div class="co-item">
                        <div class="co-item-img">
                            @if ($item['image'])
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                            @else
                                <i class="fas fa-image"></i>
                            @endif
                        </div>
                        <div class="co-item-info">
                            <h4>{{ $item['name'] }}</h4>
                            <span>Qty: {{ $item['qty'] }}</span>
                        </div>
                        <div class="co-item-price">{{ setting('currency', 'Rs.') }} {{ number_format($item['subtotal']) }}
                        </div>
                    </div>
                @endforeach

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>{{ setting('currency', 'Rs.') }} {{ number_format($subtotal) }}</span>
                </div>
                <div class="summary-row">
                    <span>Shipping</span>
                    <span>{{ $shipping > 0 ? setting('currency', 'Rs.') . ' ' . number_format($shipping) : 'Free' }}</span>
                </div>
                <div class="summary-total">
                    <span>Total</span>
                    <span>{{ setting('currency', 'Rs.') }} {{ number_format($total) }}</span>
                </div>

                <button type="submit" class="btn-primary place-order-btn">
                    PLACE ORDER
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.4" stroke-linecap="round">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </button>
            </div>
        </form>
    </div>
@endsection
