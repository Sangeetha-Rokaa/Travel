@extends('layouts.admin')

@section('title', 'Cart #' . $cart->id)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0">Cart #{{ $cart->id }}</h1>
        <a href="{{ route('admin.carts.index') }}" class="btn btn-link">Back to list</a>
    </div>

    <div class="row g-4">
        <div class="col-md-4">
            <div class="card">
                <div class="card-header">Cart Info</div>
                <div class="card-body">
                    <dl class="row mb-0">
                        <dt class="col-5">Customer</dt><dd class="col-7">{{ $cart->user?->name ?? 'Guest' }}</dd>
                        <dt class="col-5">Status</dt><dd class="col-7">{{ ucfirst($cart->status) }}</dd>
                        <dt class="col-5">Created</dt><dd class="col-7">{{ $cart->created_at->format('M d, Y') }}</dd>
                        <dt class="col-5">Updated</dt><dd class="col-7">{{ $cart->updated_at->diffForHumans() }}</dd>
                    </dl>
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
                            <th class="text-end">Line Total</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($cart->items as $item)
                            <tr>
                                <td>{{ $item->product->name ?? 'Deleted product' }}</td>
                                <td>${{ number_format($item->price, 2) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-end">${{ number_format($item->line_total, 2) }}</td>
                            </tr>
                        @empty
                            <tr><td colspan="4" class="text-center text-muted py-4">This cart is empty.</td></tr>
                        @endforelse
                        </tbody>
                        <tfoot>
                        <tr>
                            <td colspan="3" class="text-end fw-semibold">Subtotal</td>
                            <td class="text-end fw-semibold">${{ number_format($cart->subtotal, 2) }}</td>
                        </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection