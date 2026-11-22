<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use App\Http\Controllers\Controller;

class CheckoutController extends Controller
{
    /**
     * GET /checkout — show delivery + payment form with a live order summary.
     */
    public function index(): View|RedirectResponse
    {
        $cart = $this->buildCartItems();

        if ($cart['items']->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty. Add some gear before checking out.');
        }

        return view('frontend.checkout.index', [
            'items'    => $cart['items'],
            'subtotal' => $cart['subtotal'],
            'shipping' => $cart['shipping'],
            'tax'      => $cart['tax'],
            'taxRate'  => $cart['taxRate'],
            'total'    => $cart['total'],
        ]);
    }

    /**
     * POST /checkout — validate delivery info, snapshot cart into an Order,
     * clear the cart, redirect to the success page.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'full_name'      => 'required|string|max:150',
            'phone'          => 'required|string|max:30',
            'email'          => 'required|email|max:150',
            'address'        => 'required|string|max:255',
            'city'           => 'nullable|string|max:100',
            'province'       => 'nullable|string|max:100',
            'postal_code'    => 'nullable|string|max:20',
            'notes'          => 'nullable|string|max:500',
            'payment_method' => 'required|in:esewa,khalti,connect_ips,cod',
        ]);

        $cart = $this->buildCartItems();

        if ($cart['items']->isEmpty()) {
            return redirect()->route('cart.index')
                ->with('error', 'Your cart is empty. Add some gear before checking out.');
        }

        foreach ($cart['items'] as $item) {
            if (!$item['in_stock'] || $item['qty'] > $item['max_qty']) {
                return redirect()->route('cart.index')
                    ->with('error', "\"{$item['name']}\" is no longer available in the requested quantity.");
            }
        }

        // Your orders table stores a single shipping_address text column
        // rather than separate street/city/province/postal columns, so we
        // format one combined string here while still saving the structured
        // fields (full_name, email, phone, city, province, postal_code)
        // individually for anything that needs them separately.
        $shippingAddress = collect([
            $validated['address'],
            $validated['city'] ?? null,
            $validated['province'] ?? null,
            $validated['postal_code'] ?? null,
        ])->filter()->implode(', ');

        $order = DB::transaction(function () use ($validated, $cart, $shippingAddress) {
            $order = Order::create([
                'user_id'               => Auth::id(),
                'status'                => 'pending',  // enum: pending|processing|shipped|delivered|cancelled
                'payment_status'        => 'unpaid',   // enum: unpaid|paid|refunded
                'subtotal'              => $cart['subtotal'],
                'tax'                   => $cart['tax'],
                'shipping_cost'         => $cart['shipping'],
                'total'                 => $cart['total'],
                'shipping_address'      => $shippingAddress,
                'billing_address'       => $shippingAddress,
                'notes'                 => $validated['notes'] ?? null,
                'full_name'             => $validated['full_name'],
                'email'                 => $validated['email'],
                'phone'                 => $validated['phone'],
                'city'                  => $validated['city'] ?? null,
                'province'              => $validated['province'] ?? null,
                'postal_code'           => $validated['postal_code'] ?? null,
                'payment_method'        => $validated['payment_method'],
                'estimated_delivery_at' => now()->addDays(4),
            ]);

            foreach ($cart['items'] as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['id'],
                    'product_name' => $item['name'],
                    'image'        => $item['raw_image'] ?? null,
                    'price'        => $item['unit_price'],
                    'quantity'     => $item['qty'],
                    'total'        => $item['subtotal'],
                ]);

                Product::where('id', $item['id'])->decrement('stock', $item['qty']);
            }

            return $order;
        });

        session()->forget('cart');

        return redirect()
            ->route('order.success', $order->order_number)
            ->with('success', 'Your order has been placed successfully.');
    }

    /**
     * Build the $items/$subtotal/$shipping/$tax/$total shape used across
     * the cart + checkout pages, from the session cart.
     *
     * Assumes session('cart') is structured as [product_id => quantity].
     * Adjust this method if your actual CartController stores it differently.
     */
    private function buildCartItems(): array
    {
        $sessionCart = session('cart', []);

        $productIds = array_keys($sessionCart);

        $products = Product::whereIn('id', $productIds)
            ->with('category')
            ->get()
            ->keyBy('id');

        $items = collect();
        $subtotal = 0;

        foreach ($sessionCart as $productId => $cartItem) {

            $product = $products->get($productId);

            if (!$product) {
                continue;
            }

            /*
         * Support both:
         *
         * [product_id => 2]
         *
         * and:
         *
         * [product_id => ['quantity' => 2]]
         */

            if (is_array($cartItem)) {
                $qty = $cartItem['quantity']
                    ?? $cartItem['qty']
                    ?? 1;
            } else {
                $qty = $cartItem;
            }

            $qty = (int) $qty;

            if ($qty < 1) {
                $qty = 1;
            }

            $unitPrice = (float) (
                $product->sale_price ?? $product->price
            );

            $lineSubtotal = $unitPrice * $qty;

            $subtotal += $lineSubtotal;

            $items->push([
                'id'         => $product->id,
                'name'       => $product->name,
                'image'      => $product->image
                    ? Storage::url($product->image)
                    : null,
                'raw_image'  => $product->image,
                'price'      => (float) $product->price,
                'sale_price' => $product->sale_price !== null
                    ? (float) $product->sale_price
                    : null,
                'unit_price' => $unitPrice,
                'qty'        => $qty,
                'max_qty'    => (int) $product->stock,
                'in_stock'   => $product->stock > 0,
                'subtotal'   => $lineSubtotal,
                'category'   => $product->category->name ?? null,
            ]);
        }

        $taxRate = (float) setting('tax_rate', 13);

        $tax = round(
            $subtotal * ($taxRate / 100),
            2
        );

        $freeShippingThreshold = (float) setting(
            'free_shipping_threshold',
            5000
        );

        $shippingFlatRate = (float) setting(
            'shipping_flat_rate',
            150
        );

        $shipping = $subtotal >= $freeShippingThreshold
            ? 0
            : $shippingFlatRate;

        $total = $subtotal + $shipping + $tax;

        return [
            'items'    => $items,
            'subtotal' => $subtotal,
            'shipping' => $shipping,
            'tax'      => $tax,
            'taxRate'  => $taxRate,
            'total'    => $total,
        ];
    }
}
