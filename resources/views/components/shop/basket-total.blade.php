@php
    $totalPrice = 0;
    foreach (Auth::user()->orders as $item) {
        $totalPrice += $item->product->price * $item->quantity;
    }
    $price_with_shippment = $totalPrice + 3;
    $discount = Auth::user()->isSubscribed() ? 0.05 : 0;
    $final_price = $price_with_shippment - Auth::user()->total_discount - $discount;
@endphp

<p class="text-end font-mono mb-2">
    {{ __('Total') }}: {{ $price_with_shippment }}€ ({{ $totalPrice }}€ + {{ 3 }}€
    {{ __('Shippment') }})
</p>

@if (Auth::user()->isSubscribed() || Auth::user()->total_discount)
    <p class="text-end font-mono mb-2">
        {{ __('Total discount') }}:
        @if (Auth::user()->total_discount)
            {{ Auth::user()->total_discount }}€ ({{ __('wallet') }}) +
        @endif
        @if (Auth::user()->isSubscribed())
            {{ $discount }}€ ({{ __('subscription') }})
        @endif
    </p>

    <p class="text-end font-mono mb-2">
        {{ __('Price with discount') }}: {{ max($final_price, 0) }}€
    </p>
@endif
