<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class CartController extends Controller
{
    protected const SESSION_KEY = 'cart';

    /**
     * GET /cart
     * Shows the cart page: line items pulled fresh from the DB using
     * the product ids + quantities stored in the session.
     */
    public function index(): View
    {
        $cart = session(self::SESSION_KEY, []); // [product_id => qty]

        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');

        $items = collect($cart)->map(function ($qty, $productId) use ($products) {
            $product = $products->get($productId);
            if (!$product) {
                return null;
            }
            $unitPrice = $product->sale_price ?? $product->price;

            return [
                'product' => $product,
                'qty' => $qty,
                'unit_price' => $unitPrice,
                'subtotal' => $unitPrice * $qty,
            ];
        })->filter()->values();

        $subtotal = (int) $items->sum('subtotal');

        // adjust / remove this if you have real shipping logic
        $shipping = $subtotal > 0 ? (int) setting('store_flat_shipping', 150) : 0;
        $total = $subtotal + $shipping;

        return view('frontend.store.cart', compact('items', 'subtotal', 'shipping', 'total'));
    }

    /**
     * POST /cart/add/{product}
     * Matches route('cart.add', $product) already referenced on the store index page.
     */
    public function add(Request $request, Product $product): RedirectResponse
    {
        if (!$product->isInStock()) {
            return back()->with('error', 'That item is currently out of stock.');
        }

        $cart = session(self::SESSION_KEY, []);
        $qty = (int) $request->input('quantity', 1);
        $cart[$product->id] = ($cart[$product->id] ?? 0) + max(1, $qty);

        session([self::SESSION_KEY => $cart]);

        return back()->with('success', $product->name . ' was added to your cart.');
    }

    /**
     * PATCH /cart/update/{product}
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $request->validate([
            'quantity' => ['required', 'integer', 'min:1', 'max:99'],
        ]);

        $cart = session(self::SESSION_KEY, []);

        if (array_key_exists($product->id, $cart)) {
            $cart[$product->id] = (int) $request->input('quantity');
            session([self::SESSION_KEY => $cart]);
        }

        return back()->with('success', 'Cart updated.');
    }

    /**
     * DELETE /cart/remove/{product}
     */
    public function remove(Product $product): RedirectResponse
    {
        $cart = session(self::SESSION_KEY, []);
        unset($cart[$product->id]);
        session([self::SESSION_KEY => $cart]);

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * POST /cart/place-order
     * Validates the checkout form, creates the Order + OrderItems from
     * whatever is currently in the session cart, clears the cart, then
     * routes the customer to the right place depending on payment method.
     */
    public function placeOrder(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:120'],
            'phone' => ['required', 'string', 'max:20'],
            'email' => ['required', 'email', 'max:150'],
            'address' => ['required', 'string', 'max:500'],
            'payment_method' => ['required', 'in:cod,debit_card,esewa,stripe'],
        ]);

        $cart = session(self::SESSION_KEY, []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $products = Product::whereIn('id', array_keys($cart))->get()->keyBy('id');

        $order = DB::transaction(function () use ($validated, $cart, $products) {
            $subtotal = 0;

            $order = Order::create([
                'name' => $validated['name'],
                'phone' => $validated['phone'],
                'email' => $validated['email'],
                'address' => $validated['address'],
                'payment_method' => $validated['payment_method'],
                'payment_status' => $validated['payment_method'] === 'cod' ? 'pending' : 'pending',
                'subtotal' => 0,
                'total' => 0,
            ]);

            foreach ($cart as $productId => $qty) {
                $product = $products->get($productId);
                if (!$product) {
                    continue;
                }

                $unitPrice = $product->sale_price ?? $product->price;
                $lineSubtotal = $unitPrice * $qty;
                $subtotal += $lineSubtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'product_name' => $product->name,
                    'price' => $unitPrice,
                    'quantity' => $qty,
                    'subtotal' => $lineSubtotal,
                ]);
            }

            $shipping = $subtotal > 0 ? (int) setting('store_flat_shipping', 150) : 0;

            $order->update([
                'subtotal' => $subtotal,
                'total' => $subtotal + $shipping,
            ]);

            return $order;
        });

        // Cart is now committed to the order — clear it.
        session()->forget(self::SESSION_KEY);

        return match ($validated['payment_method']) {
            // Cash on delivery: nothing more to do, order is placed.
            'cod' => redirect()->route('store.index')
                ->with('success', "Order #{$order->order_number} placed! You'll pay on delivery."),

            // Card / eSewa / Stripe: hand off to a gateway-specific route.
            // Wire these up with your real merchant credentials — these are
            // intentionally left as stubs since keys/SDKs vary per account.
            'debit_card' => redirect()->route('checkout.card', $order)
                ->with('info', 'Redirecting to card payment...'),

            'esewa' => redirect()->route('checkout.esewa', $order)
                ->with('info', 'Redirecting to eSewa...'),

            'stripe' => redirect()->route('checkout.stripe', $order)
                ->with('info', 'Redirecting to Stripe...'),
        };
    }
}