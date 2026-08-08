@extends('layouts.admin')

@section('title', $order->order_number)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Order {{ $order->order_number }}</h1>
        <div>
            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-outline-primary">Edit Status</a>
            <a href="{{ route('admin.orders.index') }}" class="btn btn-link">Back to list</a>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">Order Info</div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-5">Customer</dt><dd class="col-7">{{ $order->user?->name ?? 'Guest' }}</dd>
                        <dt class="col-5">Status</dt><dd class="col-7">{{ ucfirst($order->status) }}</dd>
                        <dt class="col-5">Payment</dt><dd class="col-7">{{ ucfirst($order->payment_status) }}</dd>
                        <dt class="col-5">Date</dt><dd class="col-7">{{ $order->created_at->format('M d, Y H:i') }}</dd>
                    </dl>
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">Shipping Address</div>
                <div class="card-body">
                    <p class="mb-0">{{ $order->shipping_address ?: '—' }}</p>
                </div>
            </div>

            <div class="card">
                <div class="card-header">Billing Address</div>
                <div class="card-body">
                    <p class="mb-0">{{ $order->billing_address ?: '—' }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Items</div>
                <div class="table-responsive">
                    <table class="table mb-0 align-middle">
                        <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Qty</th>
                            <th class="text-end">Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($order->items as $item)
                            <tr>
                                <td>{{ $item->product_name }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-end">${{ number_format($item->total, 2) }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" class="text-end text-muted">Subtotal</td>
                            <td class="text-end">${{ number_format($order->subtotal, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end text-muted">Tax</td>
                            <td class="text-end">${{ number_format($order->tax, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end text-muted">Shipping</td>
                            <td class="text-end">${{ number_format($order->shipping_cost, 2) }}</td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-end fw-semibold">Total</td>
                            <td class="text-end fw-semibold">${{ number_format($order->total, 2) }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

            @if ($order->notes)
                <div class="card mt-4">
                    <div class="card-header">Notes</div>
                    <div class="card-body">{{ $order->notes }}</div>
                </div>
            @endif
        </div>
    </div>
@endsection