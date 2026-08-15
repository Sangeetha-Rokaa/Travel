@extends('layouts.store')
@section('title', 'Your Cart – ' . setting('site_name', 'TrailCo'))

@push('styles')
    <style>
        .cart-page {
            padding: 50px 60px 90px;
            max-width: 1300px;
            margin: 0 auto;
        }

        .cart-header {
            margin-bottom: 34px;
        }

        .cart-header .eyebrow {
            margin-bottom: 8px;
        }

        .cart-header h1 {
            font-size: 2rem;
            font-weight: 700;
        }

        .cart-layout {
            display: grid;
            grid-template-columns: 1fr 360px;
            gap: 36px;
            align-items: start;
        }

        /* ---------- Cart items ---------- */
        .cart-items {
            display: flex;
            flex-direction: column;
            gap: 14px;
        }

        .cart-item {
            display: grid;
            grid-template-columns: 96px 1fr auto auto auto;
            align-items: center;
            gap: 18px;
            border: 1px solid var(--line);
            border-radius: 8px;
            padding: 16px;
        }

        .ci-img-wrap {
            width: 96px;
            height: 96px;
            border-radius: 6px;
            background: var(--panel);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            flex-shrink: 0;
        }

        .ci-img-wrap img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        .ci-img-wrap i {
            font-size: 1.6rem;
            color: var(--line);
        }

        .ci-info h3 {
            font-size: .98rem;
            font-weight: 600;
            margin-bottom: 6px;
            line-height: 1.35;
        }

        .ci-unit-price {
            font-size: .82rem;
            color: var(--muted);
        }

        .ci-unit-price .old {
            text-decoration: line-through;
            margin-right: 6px;
            color: #b7bdb0;
        }

        .out-of-stock-flag {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            font-size: .72rem;
            font-weight: 700;
            color: #c1362b;
            background: rgba(193, 54, 43, .08);
            padding: 4px 10px;
            border-radius: 20px;
            margin-top: 6px;
        }

        .ci-qty-form {
            display: flex;
            align-items: center;
            border: 1px solid var(--line);
            border-radius: 30px;
            overflow: hidden;
        }

        .ci-qty-form button {
            width: 32px;
            height: 32px;
            border: none;
            background: #fff;
            color: var(--ink);
            cursor: pointer;
            font-size: .9rem;
            transition: background .2s;
        }

        .ci-qty-form button:hover {
            background: var(--panel);
        }

        .ci-qty-form input {
            width: 40px;
            text-align: center;
            border: none;
            font-family: 'Inter', sans-serif;
            font-size: .88rem;
            -moz-appearance: textfield;
        }

        .ci-qty-form input::-webkit-outer-spin-button,
        .ci-qty-form input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .ci-subtotal {
            font-weight: 700;
            font-size: .95rem;
            white-space: nowrap;
        }

        .ci-remove {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            border: 1px solid var(--line);
            background: #fff;
            color: var(--muted);
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: background .2s, color .2s;
            flex-shrink: 0;
        }

        .ci-remove:hover {
            background: #fdecea;
            color: #c1362b;
            border-color: #f5c6c2;
        }

        .cart-actions-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 10px;
        }

        .clear-cart-btn {
            background: none;
            border: none;
            color: var(--muted);
            font-size: .85rem;
            font-weight: 500;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color .2s;
        }

        .clear-cart-btn:hover {
            color: #c1362b;
        }

        .continue-shopping {
            font-size: .85rem;
            font-weight: 600;
            color: var(--green-dark);
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        /* ---------- Summary card ---------- */
        .cart-summary {
            border: 1px solid var(--line);
            border-radius: 10px;
            padding: 26px;
            position: sticky;
            top: 96px;
        }

        .cart-summary h3 {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 20px;
        }

        .summary-row {
            display: flex;
            justify-content: space-between;
            font-size: .9rem;
            color: var(--muted);
            margin-bottom: 12px;
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
            padding-top: 16px;
            margin-top: 6px;
            border-top: 1px solid var(--line);
        }

        .checkout-btn {
            width: 100%;
            margin-top: 22px;
            justify-content: center;
        }

        .summary-note {
            font-size: .76rem;
            color: var(--muted);
            text-align: center;
            margin-top: 14px;
            line-height: 1.5;
        }

        /* ---------- Empty cart ---------- */
        .empty-cart {
            text-align: center;
            padding: 90px 20px;
            border: 1px dashed var(--line);
            border-radius: 10px;
            background: var(--panel);
        }

        .empty-cart i {
            font-size: 3rem;
            color: #c8cfc2;
            margin-bottom: 18px;
        }

        .empty-cart h3 {
            font-family: 'Poppins', sans-serif;
            font-size: 1.3rem;
            margin-bottom: 8px;
        }

        .empty-cart p {
            color: var(--muted);
            font-size: .92rem;
            margin-bottom: 24px;
        }

        .flash-banner {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px 18px;
            border-radius: 8px;
            font-size: .88rem;
            font-weight: 600;
            margin-bottom: 20px;
        }

        .flash-banner.success {
            background: #eaf6de;
            color: var(--green-dark);
        }

        .flash-banner.error {
            background: #fdecea;
            color: #c1362b;
        }

        @media (max-width: 1000px) {
            .cart-layout {
                grid-template-columns: 1fr;
            }

            .cart-summary {
                position: static;
            }
        }

        @media (max-width: 640px) {
            .cart-page {
                padding: 30px 20px 60px;
            }

            .cart-item {
                grid-template-columns: 72px 1fr;
                grid-template-areas:
                    "img info"
                    "img qty"
                    "img footer";
                row-gap: 10px;
            }

            .ci-img-wrap {
                grid-area: img;
                width: 72px;
                height: 72px;
            }

            .ci-info {
                grid-area: info;
            }

            .ci-qty-form {
                grid-area: qty;
            }

            .ci-subtotal,
            .ci-remove {
                grid-area: footer;
            }

            .ci-subtotal {
                justify-self: start;
            }

            .ci-remove {
                justify-self: end;
                margin-top: -34px;
            }
        }
    </style>
@endpush

@section('content')
    <div class="cart-page">

        <div class="cart-header">
            <div class="eyebrow">Review & Checkout</div>
            <h1>Your Cart</h1>
        </div>

        @if (session('success'))
            <div class="flash-banner success"><i class="fas fa-check-circle"></i> {{ session('success') }}</div>
        @endif
        @if (session('error'))
            <div class="flash-banner error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
        @endif

        @if ($items->isEmpty())
            <div class="empty-cart">
                <i class="fas fa-shopping-bag"></i>
                <h3>Your cart is empty</h3>
                <p>Looks like you haven't added any gear yet. Let's fix that.</p>
                <a href="{{ route('store.index') }}" class="btn-primary">
                    START SHOPPING
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.4" stroke-linecap="round">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </a>
            </div>
        @else
            <div class="cart-layout">

                <!-- ================= ITEMS ================= -->
                <div>
                    <div class="cart-items">
                        @foreach ($items as $item)
                            <div class="cart-item">
                                <div class="ci-img-wrap">
                                    @if ($item['image'])
                                        <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                                    @else
                                        <i class="fas fa-image"></i>
                                    @endif
                                </div>

                                <div class="ci-info">
                                    <h3>{{ $item['name'] }}</h3>
                                    <div class="ci-unit-price">
                                        @if ($item['sale_price'])
                                            <span class="old">{{ setting('currency', 'Rs.') }}
                                                {{ number_format($item['price']) }}</span>{{ setting('currency', 'Rs.') }}
                                            {{ number_format($item['unit_price']) }}
                                        @else
                                            {{ setting('currency', 'Rs.') }} {{ number_format($item['unit_price']) }}
                                        @endif
                                        each
                                    </div>
                                    @if (!$item['in_stock'])
                                        <div class="out-of-stock-flag"><i class="fas fa-exclamation-triangle"></i> Out of
                                            stock</div>
                                    @endif
                                </div>

                                <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="ci-qty-form">
                                    @csrf
                                    @method('PATCH')
                                    <button type="button" class="qty-decrease" aria-label="Decrease quantity">−</button>
                                    <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                                        max="{{ $item['max_qty'] }}" onchange="this.form.submit()">
                                    <button type="button" class="qty-increase" aria-label="Increase quantity">+</button>
                                </form>

                                <div class="ci-subtotal">{{ setting('currency', 'Rs.') }}
                                    {{ number_format($item['subtotal']) }}</div>

                                <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="ci-remove" title="Remove item">
                                        <i class="fas fa-trash-alt"></i>
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>

                    <div class="cart-actions-row">
                        <a href="{{ route('store.index') }}" class="continue-shopping">
                            <i class="fas fa-arrow-left"></i> Continue Shopping
                        </a>

                        <form action="{{ route('cart.clear') }}" method="POST"
                            onsubmit="return confirm('Clear your entire cart?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="clear-cart-btn">
                                <i class="fas fa-trash-alt"></i> Clear Cart
                            </button>
                        </form>
                    </div>
                </div>

                <!-- ================= SUMMARY ================= -->
                <div class="cart-summary">
                    <h3>Order Summary</h3>

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

                    <a href="{{ Route::has('checkout.index') ? route('checkout.index') : '#' }}"
                        class="btn-primary checkout-btn">
                        PROCEED TO CHECKOUT
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.4" stroke-linecap="round">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </a>

                    <div class="summary-note">
                        <i class="fas fa-shield-alt"></i> Secure checkout · Easy returns within 14 days
                    </div>
                </div>
            </div>
        @endif
    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.ci-qty-form').forEach(form => {
            const input = form.querySelector('input[name="qty"]');
            const decreaseBtn = form.querySelector('.qty-decrease');
            const increaseBtn = form.querySelector('.qty-increase');

            decreaseBtn.addEventListener('click', () => {
                const current = parseInt(input.value, 10) || 1;
                if (current > 1) {
                    input.value = current - 1;
                    form.submit();
                }
            });

            increaseBtn.addEventListener('click', () => {
                const current = parseInt(input.value, 10) || 1;
                const max = parseInt(input.max, 10) || 50;
                if (current < max) {
                    input.value = current + 1;
                    form.submit();
                }
            });
        });
    </script>
@endpush
