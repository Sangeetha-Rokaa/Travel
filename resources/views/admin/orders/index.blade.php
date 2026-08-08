@extends('layouts.admin')

@section('title', 'Orders')

@section('content')
    <h1 class="h3 mb-4">Orders</h1>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-auto">
                    <input type="text" name="search" value="{{ request('search') }}" class="form-control" placeholder="Order number...">
                </div>
                <div class="col-auto">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        @foreach (['pending','processing','shipped','delivered','cancelled'] as $status)
                            <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <select name="payment_status" class="form-select">
                        <option value="">All Payment Statuses</option>
                        @foreach (['unpaid','paid','refunded'] as $status)
                            <option value="{{ $status }}" @selected(request('payment_status') === $status)>{{ ucfirst($status) }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-auto">
                    <button class="btn btn-outline-secondary" type="submit">Filter</button>
                </div>
            </form>
        </div>
    </div>

    <div class="card">
        <div class="table-responsive">
            <table class="table align-middle mb-0">
                <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment</th>
                    <th>Date</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($orders as $order)
                    <tr>
                        <td><code>{{ $order->order_number }}</code></td>
                        <td>{{ $order->user?->name ?? 'Guest' }}</td>
                        <td>${{ number_format($order->total, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ match($order->status) {
                                'pending' => 'warning',
                                'processing' => 'info',
                                'shipped' => 'primary',
                                'delivered' => 'success',
                                'cancelled' => 'danger',
                                default => 'secondary',
                            } }}">
                                {{ ucfirst($order->status) }}
                            </span>
                        </td>
                        <td>
                            <span class="badge bg-{{ $order->payment_status === 'paid' ? 'success' : ($order->payment_status === 'refunded' ? 'secondary' : 'warning') }}">
                                {{ ucfirst($order->payment_status) }}
                            </span>
                        </td>
                        <td>{{ $order->created_at->format('M d, Y') }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-secondary">View</a>
                            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-sm btn-outline-primary">Edit</a>
                            <form action="{{ route('admin.orders.destroy', $order) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this order?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No orders found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if ($orders->hasPages())
            <div class="card-footer">
                {{ $orders->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection