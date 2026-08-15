<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    protected string $sessionKey = 'cart';

    public function index()
    {
        $cart = session($this->sessionKey, []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $items = collect($cart)->map(function ($item, $id) {
            $product = Product::find($id);
            if (!$product) return null;

            $unitPrice = $product->sale_price ?? $product->price;

            return [
                'id'         => $product->id,
                'name'       => $product->name,
                'image'      => $product->image ? Storage::url($product->image) : null,
                'unit_price' => $unitPrice,
                'qty'        => $item['qty'],
                'subtotal'   => $unitPrice * $item['qty'],
                'in_stock'   => method_exists($product, 'isInStock') ? $product->isInStock() : true,
            ];
        })->filter()->values();

        if ($items->contains(fn($i) => !$i['in_stock'])) {
            return redirect()->route('cart.index')
                ->with('error', 'Some items in your cart are out of stock. Please remove them before checking out.');
        }

        $subtotal     = $items->sum('subtotal');
        $shippingCost = (float) setting('shipping_flat_rate', 0);
        $total        = $subtotal + $shippingCost;

        return view('frontend.checkout.index', [
            'items'        => $items,
            'subtotal'     => $subtotal,
            'shipping'     => $shippingCost,
            'total'        => $total,
        ]);
    }

    public function store(Request $request)
    {
        $cart = session($this->sessionKey, []);

        if (empty($cart)) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $validated = $request->validate([
            'full_name'      => 'required|string|max:150',
            'email'          => 'required|email|max:150',
            'phone'          => 'required|string|max:30',
            'address'        => 'required|string|max:255',
            'city'           => 'required|string|max:100',
            'notes'          => 'nullable|string|max:500',
            'payment_method' => 'required|in:cod,esewa,bank_transfer',
        ]);

        $items = collect($cart)->map(function ($item, $id) {
            $product = Product::find($id);
            if (!$product) return null;

            $unitPrice = $product->sale_price ?? $product->price;

            return [
                'product'  => $product,
                'price'    => $unitPrice,
                'quantity' => $item['qty'],
                'total'    => $unitPrice * $item['qty'],
            ];
        })->filter()->values();

        if ($items->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        foreach ($items as $item) {
            $product = $item['product'];
            if (method_exists($product, 'isInStock') && !$product->isInStock()) {
                return redirect()->route('cart.index')
                    ->with('error', $product->name . ' is out of stock. Please remove it and try again.');
            }
        }

        $subtotal     = $items->sum('total');
        $shippingCost = (float) setting('shipping_flat_rate', 0);
        $tax          = 0; // adjust if you charge tax
        $total        = $subtotal + $shippingCost + $tax;

        $fullAddress = $validated['address'] . ', ' . $validated['city'];

        $order = DB::transaction(function () use ($validated, $items, $subtotal, $shippingCost, $tax, $total, $fullAddress) {
            $order = Order::create([
                'order_number'     => 'ORD-' . strtoupper(Str::random(8)),
                'user_id'          => auth()->id(),
                'full_name'        => $validated['full_name'],
                'email'            => $validated['email'],
                'phone'            => $validated['phone'],
                'city'             => $validated['city'],
                'shipping_address' => $fullAddress,
                'billing_address'  => $fullAddress,
                'notes'            => $validated['notes'] ?? null,
                'payment_method'   => $validated['payment_method'],
                'status'           => 'pending',
                'payment_status'   => 'unpaid',
                'subtotal'         => $subtotal,
                'tax'              => $tax,
                'shipping_cost'    => $shippingCost,
                'total'            => $total,
            ]);

            foreach ($items as $item) {
                OrderItem::create([
                    'order_id'     => $order->id,
                    'product_id'   => $item['product']->id,
                    'product_name' => $item['product']->name,
                    'price'        => $item['price'],
                    'quantity'     => $item['quantity'],
                    'total'        => $item['total'],
                ]);

                if (isset($item['product']->stock)) {
                    $item['product']->decrement('stock', $item['quantity']);
                }
            }

            return $order;
        });

        session()->forget($this->sessionKey);

        return redirect()->route('checkout.success', $order->order_number)
            ->with('success', 'Your order has been placed successfully!');
    }

    public function success(string $orderNumber)
    {
        $order = Order::with('items')->where('order_number', $orderNumber)->firstOrFail();

        return view('frontend.checkout.success', compact('order'));
    }
}
