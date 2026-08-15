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
     * Update the quantity of a cart item.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'qty' => 'required|integer|min:1|max:50',
        ]);

        $cart = session($this->sessionKey, []);

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] = (int) $request->input('qty');
            session([$this->sessionKey => $cart]);
        }

        return back()->with('success', 'Cart updated.');
    }

    /**
     * Remove a single product from the cart.
     */
    public function remove(Product $product)
    {
        $cart = session($this->sessionKey, []);
        unset($cart[$product->id]);
        session([$this->sessionKey => $cart]);

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * Empty the whole cart.
     */
    public function clear()
    {
        session()->forget($this->sessionKey);

        return back()->with('success', 'Your cart has been cleared.');
    }
}
