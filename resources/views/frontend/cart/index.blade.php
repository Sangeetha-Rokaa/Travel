@extends('layouts.store')
@section('title', 'Your Cart – ' . setting('site_name', 'TrailCo'))

{{-- @push('styles') --}}
<style>
    :root {
        --cart-header-bg: #101a14;
        --cart-green: #4a7c2b;
        --cart-green-dark: #3d6622;
        --cart-green-soft: #eef6e6;
    }

    .cart-topbar {
        background: var(--cart-header-bg);
        color: #fff;
        padding: 16px 24px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .cart-topbar-brand {
        display: flex;
        align-items: center;
        gap: 10px;
        text-decoration: none;
        color: #fff;
    }

    .cart-topbar-brand i {
        font-size: 1.15rem;
        color: #fff;
    }

    .cart-topbar-brand img {
        width: 26px;
        height: 26px;
        object-fit: contain;
    }

    .cart-topbar-brand span {
        font-weight: 700;
        font-size: 1rem;
        letter-spacing: 0.02em;
        text-transform: uppercase;
    }

    .cart-topbar-bag {
        color: #fff;
        font-size: 1.05rem;
        position: relative;
        text-decoration: none;
    }

    .cart-topbar-bag .bag-count {
        position: absolute;
        top: -8px;
        right: -10px;
        background: var(--cart-green);
        color: #fff;
        font-size: 0.62rem;
        font-weight: 700;
        width: 16px;
        height: 16px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .cart-page {
        padding: 40px 60px 90px;
        max-width: 900px;
        margin: 0 auto;
    }

    .cart-header {
        text-align: center;
        margin-bottom: 30px;
    }

    .cart-header h1 {
        font-size: 1.7rem;
        font-weight: 700;
        margin-bottom: 6px;
    }

    .cart-header p {
        color: var(--muted);
        font-size: 0.9rem;
    }

    /* ---------- Cart items (card style) ---------- */
    .cart-items {
        display: flex;
        flex-direction: column;
        gap: 14px;
        margin-bottom: 18px;
    }

    .cart-item-card {
        background: #fff;
        border: 1px solid var(--line);
        border-radius: 14px;
        padding: 18px;
        display: grid;
        grid-template-columns: 76px 1fr auto;
        gap: 16px;
        align-items: flex-start;
    }

    .ci-img-wrap {
        width: 76px;
        height: 76px;
        border-radius: 10px;
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
        object-fit: cover;
    }

    .ci-img-wrap i {
        font-size: 1.5rem;
        color: var(--line);
    }

    .ci-body {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }

    .ci-name {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--ink);
        line-height: 1.35;
    }

    .ci-meta {
        font-size: 0.8rem;
        color: var(--muted);
    }

    .ci-meta span+span::before {
        content: '·';
        margin: 0 6px;
    }

    .ci-price-row {
        font-size: 0.95rem;
        font-weight: 700;
        color: var(--ink);
        margin-top: 2px;
    }

    .ci-price-row .old {
        font-size: 0.78rem;
        font-weight: 400;
        color: #9aa39a;
        text-decoration: line-through;
        margin-right: 5px;
    }

    .out-of-stock-flag {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        font-size: .7rem;
        font-weight: 700;
        color: #c1362b;
        background: rgba(193, 54, 43, .08);
        padding: 3px 9px;
        border-radius: 20px;
        margin-top: 4px;
        width: fit-content;
    }

    .ci-qty-form {
        display: flex;
        align-items: center;
        border: 1px solid var(--line);
        border-radius: 30px;
        overflow: hidden;
        margin-top: 10px;
        width: fit-content;
    }

    .ci-qty-form button {
        width: 28px;
        height: 28px;
        border: none;
        background: #fff;
        color: var(--ink);
        cursor: pointer;
        font-size: .85rem;
        transition: background .2s;
    }

    .ci-qty-form button:hover {
        background: var(--panel);
    }

    .ci-qty-form input {
        width: 34px;
        text-align: center;
        border: none;
        font-family: inherit;
        font-size: .85rem;
        -moz-appearance: textfield;
    }

    .ci-qty-form input::-webkit-outer-spin-button,
    .ci-qty-form input::-webkit-inner-spin-button {
        -webkit-appearance: none;
        margin: 0;
    }

    .ci-actions {
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        justify-content: space-between;
        height: 100%;
        gap: 22px;
    }

    .ci-wishlist-btn {
        width: 30px;
        height: 30px;
        border-radius: 50%;
        border: 1px solid var(--line);
        background: #fff;
        color: var(--muted);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        font-size: 0.82rem;
        transition: color .2s, border-color .2s;
    }

    .ci-wishlist-btn:hover {
        color: #c1362b;
        border-color: #f5c6c2;
    }

    .ci-remove {
        width: 30px;
        height: 30px;
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
        margin: 4px 0 24px;
    }

    .clear-cart-btn {
        background: none;
        border: none;
        color: var(--muted);
        font-size: .82rem;
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
        font-size: .82rem;
        font-weight: 600;
        color: var(--cart-green-dark);
        display: inline-flex;
        align-items: center;
        gap: 6px;
        text-decoration: none;
    }

    /* ---------- Free delivery banner ---------- */
    .free-delivery-banner {
        display: flex;
        align-items: center;
        gap: 14px;
        background: var(--cart-green-soft);
        border-radius: 12px;
        padding: 14px 18px;
        margin-bottom: 18px;
    }

    .free-delivery-banner i {
        color: var(--cart-green-dark);
        font-size: 1.3rem;
        flex-shrink: 0;
    }

    .free-delivery-banner strong {
        display: block;
        font-size: 0.88rem;
        color: var(--cart-green-dark);
        margin-bottom: 2px;
    }

    .free-delivery-banner span {
        font-size: 0.78rem;
        color: #5b7a4a;
    }

    /* ---------- Summary card ---------- */
    .cart-summary {
        border: 1px solid var(--line);
        border-radius: 14px;
        padding: 22px 24px;
        background: #fff;
    }

    .summary-row {
        display: flex;
        justify-content: space-between;
        font-size: .88rem;
        color: var(--muted);
        margin-bottom: 12px;
    }

    .summary-row span:last-child {
        color: var(--ink);
        font-weight: 500;
    }

    .summary-row.free span:last-child {
        color: var(--cart-green-dark);
        font-weight: 700;
    }

    .summary-total {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding-top: 16px;
        margin-top: 6px;
        border-top: 1px solid var(--line);
    }

    .summary-total .label strong {
        display: block;
        font-size: 1.02rem;
        font-weight: 700;
        color: var(--ink);
    }

    .summary-total .label small {
        font-size: 0.74rem;
        color: var(--muted);
    }

    .summary-total .value {
        font-size: 1.25rem;
        font-weight: 800;
        color: var(--ink);
    }

    .checkout-btn {
        width: 100%;
        justify-content: center;
        margin-top: 20px;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: var(--cart-green);
        color: #fff;
        padding: 15px 20px;
        border-radius: 10px;
        font-weight: 700;
        font-size: 0.88rem;
        letter-spacing: 0.03em;
        text-transform: uppercase;
        text-decoration: none;
        border: none;
        cursor: pointer;
        transition: background .2s, transform .2s;
    }

    .checkout-btn:hover {
        background: var(--cart-green-dark);
        transform: translateY(-1px);
    }

    /* ---------- Trust footer row ---------- */
    .cart-trust-row {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 18px;
        margin-top: 34px;
        text-align: center;
    }

    .cart-trust-item i {
        font-size: 1.3rem;
        color: var(--cart-green-dark);
        margin-bottom: 8px;
        display: block;
    }

    .cart-trust-item strong {
        display: block;
        font-size: 0.82rem;
        font-weight: 700;
        color: var(--ink);
        margin-bottom: 2px;
    }

    .cart-trust-item span {
        font-size: 0.72rem;
        color: var(--muted);
    }

    /* ---------- Empty cart ---------- */
    .empty-cart {
        text-align: center;
        padding: 90px 20px;
        border: 1px dashed var(--line);
        border-radius: 14px;
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
        color: var(--cart-green-dark);
    }

    .flash-banner.error {
        background: #fdecea;
        color: #c1362b;
    }

    @media (max-width: 640px) {
        .cart-page {
            padding: 0 0 60px;
        }

        .cart-page>.cart-header,
        .cart-page>.flash-banner,
        .cart-page>.empty-cart,
        .cart-page .cart-items,
        .cart-page .free-delivery-banner,
        .cart-page .cart-summary,
        .cart-page .cart-trust-row,
        .cart-page .cart-actions-row {
            margin-left: 18px;
            margin-right: 18px;
        }

        .cart-header {
            padding-top: 24px;
        }

        .cart-trust-row {
            gap: 10px;
        }
    }
</style>
{{-- @endpush --}}

@section('content')

    {{-- Slim brand bar matching the mockup header --}}
    <div class="cart-topbar">
        <a href="{{ route('store.index') }}" class="cart-topbar-brand">
            @php
                $cartLogo = setting('site_logo');
                $cartLogoUrl = $cartLogo
                    ? (Str::startsWith($cartLogo, 'http')
                        ? $cartLogo
                        : asset('storage/' . $cartLogo))
                    : null;
            @endphp
            @if ($cartLogoUrl)
                <img src="{{ $cartLogoUrl }}" alt="{{ setting('site_name', 'Gear Up') }}">
            @else
                <i class="fas fa-mountain"></i>
            @endif
            <span>{{ setting('site_name', 'Gear Up') }}</span>
        </a>

        <a href="{{ route('cart.index') }}" class="cart-topbar-bag">
            <i class="fas fa-shopping-bag"></i>
            @if (!$items->isEmpty())
                <span class="bag-count">{{ $items->sum('qty') }}</span>
            @endif
        </a>
    </div>

    <div class="cart-page">

        <div class="cart-header">
            <h1>Your Cart</h1>
            <p>Review your items and proceed to checkout.</p>
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
            <!-- ================= ITEMS ================= -->
            <div class="cart-items">
                @foreach ($items as $item)
                    <div class="cart-item-card">
                        <div class="ci-img-wrap">
                            @if ($item['image'])
                                <img src="{{ $item['image'] }}" alt="{{ $item['name'] }}">
                            @else
                                <i class="fas fa-image"></i>
                            @endif
                        </div>

                        <div class="ci-body">
                            <div class="ci-name">{{ $item['name'] }}</div>

                            {{-- Variant meta line — only renders if your cart item data
                                 actually carries color/size (it currently doesn't in the
                                 products schema, so add these keys to $item if/when you
                                 introduce product variants). Falls back to category. --}}
                            @if (!empty($item['color']) || !empty($item['size']))
                                <div class="ci-meta">
                                    @if (!empty($item['color']))
                                        <span>Color: {{ $item['color'] }}</span>
                                    @endif
                                    @if (!empty($item['size']))
                                        <span>Size: {{ $item['size'] }}</span>
                                    @endif
                                </div>
                            @elseif (!empty($item['category']))
                                <div class="ci-meta"><span>{{ $item['category'] }}</span></div>
                            @endif

                            <div class="ci-price-row">
                                @if ($item['sale_price'])
                                    <span class="old">{{ setting('currency', 'Rs.') }}
                                        {{ number_format($item['price']) }}</span>{{ setting('currency', 'Rs.') }}
                                    {{ number_format($item['unit_price']) }}
                                @else
                                    {{ setting('currency', 'Rs.') }} {{ number_format($item['unit_price']) }}
                                @endif
                            </div>

                            @if (!$item['in_stock'])
                                <div class="out-of-stock-flag"><i class="fas fa-exclamation-triangle"></i> Out of
                                    stock</div>
                            @endif

                            <form action="{{ route('cart.update', $item['id']) }}" method="POST" class="ci-qty-form">
                                @csrf
                                @method('PATCH')
                                <button type="button" class="qty-decrease" aria-label="Decrease quantity">−</button>
                                <input type="number" name="qty" value="{{ $item['qty'] }}" min="1"
                                    max="{{ $item['max_qty'] }}" onchange="this.form.submit()">
                                <button type="button" class="qty-increase" aria-label="Increase quantity">+</button>
                            </form>
                        </div>

                        <div class="ci-actions">
                            <button type="button" class="ci-wishlist-btn" title="Save for later">
                                <i class="far fa-heart"></i>
                            </button>

                            <form action="{{ route('cart.remove', $item['id']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="ci-remove" title="Remove item">
                                    <i class="fas fa-trash-alt"></i>
                                </button>
                            </form>
                        </div>
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

            @if ($shipping == 0)
                <div class="free-delivery-banner">
                    <i class="fas fa-truck"></i>
                    <div>
                        <strong>Free Delivery</strong>
                        <span>You are eligible for free shipping!</span>
                    </div>
                </div>
            @endif

            <!-- ================= SUMMARY ================= -->
            <div class="cart-summary">

                <div class="summary-row">
                    <span>Subtotal</span>
                    <span>{{ setting('currency', 'Rs.') }} {{ number_format($subtotal) }}</span>
                </div>

                <div class="summary-row {{ $shipping == 0 ? 'free' : '' }}">
                    <span>Delivery Fee</span>
                    <span>{{ $shipping > 0 ? setting('currency', 'Rs.') . ' ' . number_format($shipping) : 'Free' }}</span>
                </div>

                {{-- Tax row — only shown if the controller passes $tax. Add
                     `$tax = $subtotal * 0.13;` (or your rate) in CartController
                     and pass it to the view to enable this, matching the mockup. --}}
                @isset($tax)
                    <div class="summary-row">
                        <span>Tax ({{ $taxRate ?? 13 }}%)</span>
                        <span>{{ setting('currency', 'Rs.') }} {{ number_format($tax) }}</span>
                    </div>
                @endisset

                <div class="summary-total">
                    <div class="label">
                        <strong>Total</strong>
                        <small>Inclusive of all taxes</small>
                    </div>
                    <div class="value">{{ setting('currency', 'Rs.') }} {{ number_format($total) }}</div>
                </div>

                <a href="{{ Route::has('checkout.index') ? route('checkout.index') : '#' }}" class="checkout-btn">
                    Proceed to Checkout
                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                        stroke-width="2.4" stroke-linecap="round">
                        <path d="M5 12h14M13 6l6 6-6 6" />
                    </svg>
                </a>
            </div>

            <!-- ================= TRUST ROW ================= -->
            <div class="cart-trust-row">
                <div class="cart-trust-item">
                    <i class="fas fa-lock"></i>
                    <strong>Secure Payment</strong>
                    <span>100% secure transaction</span>
                </div>
                <div class="cart-trust-item">
                    <i class="fas fa-sync-alt"></i>
                    <strong>Easy Returns</strong>
                    <span>7-day return policy</span>
                </div>
                <div class="cart-trust-item">
                    <i class="fas fa-headset"></i>
                    <strong>Customer Support</strong>
                    <span>24/7 assistance</span>
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
