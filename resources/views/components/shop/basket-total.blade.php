@php
    $totalPrice = 0;
    foreach (Auth::user()->orders as $item) {
        $totalPrice += $item->product->price * $item->quantity;
    }
    $priceWithShippment = $totalPrice + 3;
    $discount = $priceWithShippment * 0.05;
@endphp
<p class="text-end font-mono mb-2">
    {{ __('Total') }}: {{ $priceWithShippment }}€ ({{ $totalPrice }}€ + {{ 3 }}€ {{ __('Shippment') }})
</p>

@if (Auth::user()->isSubscribed() || Auth::user()->total_discount)
    <p class="text-end font-mono mb-2">
        {{ __('Total discount') }}:
        @if (Auth::user()->total_discount)
            {{ Auth::user()->total_discount }}€ {{ __('(your wallet)') }}
        @endif
        @if (Auth::user()->isSubscribed())
            {{ $discount }}€ {{ __('(subscription)') }}
        @endif
    </p>

    <p class="text-end font-mono mb-2">
        {{ __('Price with discount') }}: {{ $priceWithShippment - Auth::user()->total_discount - $discount }}€
    </p>
@endif
