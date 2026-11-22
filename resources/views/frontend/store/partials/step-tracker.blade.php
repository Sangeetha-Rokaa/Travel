{{--
    resources/views/store/partials/step-tracker.blade.php

    Usage: @include('store.partials.step-tracker', ['active' => 2])
    active: 1 = Cart, 2 = Checkout, 3 = Order, 4 = Success
--}}
@php
    $steps = [
        1 => 'Cart',
        2 => 'Checkout',
        3 => 'Order',
        4 => 'Success',
    ];
    $active = $active ?? 1;
@endphp

<div class="step-tracker">
    @foreach ($steps as $num => $label)
        <div class="step {{ $num < $active ? 'done' : ($num === $active ? 'active' : '') }}">
            <div class="step-circle">
                @if ($num < $active)
                    <i class="fas fa-check"></i>
                @else
                    {{ $num }}
                @endif
            </div>
            <span class="step-label">{{ $label }}</span>
        </div>

        @if ($num < count($steps))
            <div class="step-connector {{ $num < $active ? 'done' : '' }}"></div>
        @endif
    @endforeach
</div>
