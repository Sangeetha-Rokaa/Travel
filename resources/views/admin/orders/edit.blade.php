@extends('layouts.admin')

@section('title', 'Edit Order')

@section('content')
    <h1 class="h3 mb-4">Update Order {{ $order->order_number }}</h1>

    <div class="card" style="max-width: 600px;">
        <div class="card-body">
            <form action="{{ route('admin.orders.update', $order) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label class="form-label">Status</label>
                    <select name="status" class="form-select" required>
                        @foreach (['pending','processing','shipped','delivered','cancelled'] as $status)
                            <option value="{{ $status }}" @selected(old('status', $order->status) === $status)>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label class="form-label">Payment Status</label>
                    <select name="payment_status" class="form-select" required>
                        @foreach (['unpaid','paid','refunded'] as $status)
                            <option value="{{ $status }}" @selected(old('payment_status', $order->payment_status) === $status)>
                                {{ ucfirst($status) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-4">
                    <label class="form-label">Notes</label>
                    <textarea name="notes" rows="3" class="form-control">{{ old('notes', $order->notes) }}</textarea>
                </div>

                <button type="submit" class="btn btn-primary">Update Order</button>
                <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-link">Cancel</a>
            </form>
        </div>
    </div>
@endsection