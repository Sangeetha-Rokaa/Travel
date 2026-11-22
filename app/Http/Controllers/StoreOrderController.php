<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\View\View;

class StoreOrderController extends Controller
{
    /**
     * GET /order-summary/{order:order_number} — detailed receipt view.
     */
    public function summary(Order $order): View
    {
        $order->load('items');

        return view('frontend.store.order-summary', compact('order'));
    }

    /**
     * GET /order-success/{order:order_number} — celebratory confirmation
     * shown immediately after checkout completes.
     */
    public function success(Order $order): View
    {
        $order->load('items');

        return view('frontend.checkout.success', compact('order'));
    }

    /**
     * GET /my-orders — the logged-in customer's own order history.
     */
    public function index(): View
    {
        $orders = Order::where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('store.orders.index', compact('orders'));
    }

    /**
     * GET /my-orders/{order} — a single order, restricted to its owner.
     */
    public function show(Order $order): View
    {
        abort_unless($order->user_id === auth()->id(), 403);

        $order->load('items');

        return view('store.orders.show', compact('order'));
    }
}
