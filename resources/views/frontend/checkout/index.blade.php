@extends('layouts.store')
@section('title', 'Checkout – ' . setting('site_name', 'TrailCo'))

@section('content')
    <div class="flow-page">

        @include('frontend.store.partials.step-tracker', ['active' => 2])

        <div class="flow-header">
            <h1>Checkout</h1>
            <p>Please fill in your details to complete your order.</p>
        </div>

        {{--
        STATIC MOCK DATA — replace with real values once wired up:
        - form fields should post to route('checkout.store') (or similar)
        - $items, $subtotal, $shipping, $tax, $total should come from the cart,
          same shape as the cart page you already have.
    --}}
        @php
            $currency = setting('currency', 'Rs.');
            $mockSubtotal = 51740;
            $mockShipping = 0;
            $mockTax = 6716;
            $mockTotal = $mockSubtotal + $mockShipping + $mockTax;
        @endphp

        <form action="{{ Route::has('checkout.store') ? route('checkout.store') : '#' }}" method="POST">
            @csrf

            <div class="checkout-layout">

                <!-- LEFT: FORM -->
                <div>

                    <div class="flow-card">
                        <h3>Delivery Information</h3>

                        <div class="form-field">
                            <label>Full Name</label>
                            <input type="text" name="full_name" placeholder="Sujal Lamichhane" required>
                        </div>

                        <div class="form-field">
                            <label>Phone Number</label>
                            <input type="tel" name="phone" placeholder="+977 9801234567" required>
                        </div>

                        <div class="form-field">
                            <label>Email Address</label>
                            <input type="email" name="email" placeholder="sujal@example.com" required>
                        </div>

                        <div class="form-field">
                            <label>Delivery Address</label>
                            <input type="text" name="address" placeholder="House No. 123, Street 5, Lazimpat" required>
                        </div>

                        <div class="form-address-row">
                            <div class="form-field" style="margin-bottom:0;">
                                <label>City</label>
                                <select name="city">
                                    <option>Kathmandu</option>
                                    <option>Pokhara</option>
                                    <option>Lalitpur</option>
                                    <option>Bhaktapur</option>
                                </select>
                            </div>
                            <div class="form-field" style="margin-bottom:0;">
                                <label>Province</label>
                                <select name="province">
                                    <option>Bagmati</option>
                                    <option>Gandaki</option>
                                    <option>Lumbini</option>
                                </select>
                            </div>
                            <div class="form-field" style="margin-bottom:0;">
                                <label>Postal Code</label>
                                <select name="postal_code">
                                    <option>44600</option>
                                    <option>33700</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-checkbox-row">
                            <input type="checkbox" name="save_address" id="save_address">
                            <label for="save_address">Save this address for next time</label>
                        </div>
                    </div>

                    <div class="flow-card">
                        <h3>Payment Method</h3>

                        <label class="payment-option selected">
                            <input type="radio" name="payment_method" value="esewa" checked>
                            <div class="payment-option-icon"><i class="fas fa-wallet" style="color:#5cb82e;"></i></div>
                            <div class="payment-option-body">
                                <strong>eSewa</strong>
                                <span>Pay easily using eSewa wallet.</span>
                            </div>
                            <span class="payment-badge">Recommended</span>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="khalti">
                            <div class="payment-option-icon"><i class="fas fa-wallet" style="color:#5c2d91;"></i></div>
                            <div class="payment-option-body">
                                <strong>Khalti</strong>
                                <span>Pay using Khalti wallet.</span>
                            </div>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="connect_ips">
                            <div class="payment-option-icon"><i class="fas fa-university" style="color:#1a73e8;"></i></div>
                            <div class="payment-option-body">
                                <strong>Connect IPS</strong>
                                <span>Pay directly from your bank.</span>
                            </div>
                        </label>

                        <label class="payment-option">
                            <input type="radio" name="payment_method" value="cod">
                            <div class="payment-option-icon"><i class="fas fa-money-bill-wave" style="color:#6b7166;"></i>
                            </div>
                            <div class="payment-option-body">
                                <strong>Cash on Delivery</strong>
                                <span>Pay when you receive your order.</span>
                            </div>
                        </label>
                    </div>

                </div>

                <!-- RIGHT: SUMMARY -->
                <div class="order-summary-card">
                    <h3>Order Summary</h3>

                    <div class="summary-row">
                        <span>Subtotal</span>
                        <span>{{ $currency }} {{ number_format($mockSubtotal) }}</span>
                    </div>
                    <div class="summary-row {{ $mockShipping == 0 ? 'free' : '' }}">
                        <span>Delivery Fee</span>
                        <span>{{ $mockShipping > 0 ? $currency . ' ' . number_format($mockShipping) : 'Free' }}</span>
                    </div>
                    <div class="summary-row">
                        <span>Tax (13%)</span>
                        <span>{{ $currency }} {{ number_format($mockTax) }}</span>
                    </div>

                    <div class="summary-total">
                        <strong>Total Amount</strong>
                        <span class="value">{{ $currency }} {{ number_format($mockTotal) }}</span>
                    </div>

                    <button type="submit" class="flow-submit-btn">
                        Place Order
                        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2.4" stroke-linecap="round">
                            <path d="M5 12h14M13 6l6 6-6 6" />
                        </svg>
                    </button>

                    <div class="secure-note">
                        <i class="fas fa-lock"></i> Your payment information is secure with us.
                    </div>
                </div>

            </div>
        </form>

    </div>
@endsection

@push('scripts')
    <script>
        document.querySelectorAll('.payment-option').forEach(function(opt) {
            opt.addEventListener('click', function() {
                document.querySelectorAll('.payment-option').forEach(o => o.classList.remove('selected'));
                opt.classList.add('selected');
                opt.querySelector('input[type="radio"]').checked = true;
            });
        });
    </script>
@endpush
