<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CartController extends Controller
{
    protected string $sessionKey = 'cart';

    /**
     * Display the cart page.
     */
    public function index()
    {
        $cart = session($this->sessionKey, []);

        // Re-validate against live product data (price/stock may have changed)
        $items = collect($cart)->map(function ($item, $id) {
            $product = Product::find($id);

            if (!$product) {
                return null;
            }

            $unitPrice = $product->sale_price ?? $product->price;

            return [
                'id'          => $product->id,
                'slug'        => $product->slug ?? null,
                'name'        => $product->name,
                'image'       => $product->image ? Storage::url($product->image) : null,
                'price'       => $product->price,
                'sale_price'  => $product->sale_price,
                'unit_price'  => $unitPrice,
                'qty'         => $item['qty'],
                'subtotal'    => $unitPrice * $item['qty'],
                'in_stock'    => method_exists($product, 'isInStock') ? $product->isInStock() : true,
                'max_qty'     => $product->stock ?? 99,
            ];
        })->filter()->values();

        $subtotal = $items->sum('subtotal');
        $shipping = $items->isNotEmpty() ? (float) setting('shipping_flat_rate', 0) : 0;
        $total    = $subtotal + $shipping;

        return view('frontend.cart.index', [
            'items'    => $items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'total'    => $total,
        ]);
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request, Product $product)
    {
        $request->validate([
            'qty' => 'nullable|integer|min:1|max:50',
        ]);

        if (method_exists($product, 'isInStock') && !$product->isInStock()) {
            return back()->with('error', 'Sorry, "' . $product->name . '" is currently out of stock.');
        }

        $cart = session($this->sessionKey, []);
        $qty  = (int) ($request->input('qty', 1));

        if (isset($cart[$product->id])) {
            $cart[$product->id]['qty'] += $qty;
        } else {
            $cart[$product->id] = ['qty' => $qty];
        }

        session([$this->sessionKey => $cart]);

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
