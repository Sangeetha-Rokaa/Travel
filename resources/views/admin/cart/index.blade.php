@extends('layouts.admin')

@section('title', 'Carts')

@section('content')
    <h1 class="h3 mb-4">Customer Carts</h1>

    <div class="card mb-3">
        <div class="card-body">
            <form method="GET" class="row g-2">
                <div class="col-auto">
                    <select name="status" class="form-select">
                        <option value="">All Statuses</option>
                        @foreach (['active','converted','abandoned'] as $status)
                            <option value="{{ $status }}" @selected(request('status') === $status)>{{ ucfirst($status) }}</option>
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
                    <th>Cart #</th>
                    <th>Customer</th>
                    <th>Items</th>
                    <th>Subtotal</th>
                    <th>Status</th>
                    <th>Updated</th>
                    <th class="text-end">Actions</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($carts as $cart)
                    <tr>
                        <td>#{{ $cart->id }}</td>
                        <td>{{ $cart->user?->name ?? 'Guest (' . Str::limit($cart->session_id, 8, '') . ')' }}</td>
                        <td>{{ $cart->items->sum('quantity') }}</td>
                        <td>${{ number_format($cart->subtotal, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $cart->status === 'active' ? 'success' : ($cart->status === 'converted' ? 'primary' : 'secondary') }}">
                                {{ ucfirst($cart->status) }}
                            </span>
                        </td>
                        <td>{{ $cart->updated_at->diffForHumans() }}</td>
                        <td class="text-end">
                            <a href="{{ route('admin.carts.show', $cart) }}" class="btn btn-sm btn-outline-secondary">View</a>
                            <form action="{{ route('admin.carts.destroy', $cart) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this cart?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-muted py-4">No carts found.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
        @if ($carts->hasPages())
            <div class="card-footer">
                {{ $carts->withQueryString()->links() }}
            </div>
        @endif
    </div>
@endsection