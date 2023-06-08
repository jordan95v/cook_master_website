@php
    $totalPrice = 0;
    foreach (Auth::user()->orders as $item) {
        $totalPrice += $item->product->price * $item->quantity;
    }
    $priceWithShippment = $totalPrice + 3;
@endphp
<p class="text-end font-mono mb-2">
    {{ __('Total') }}: {{ $priceWithShippment }}€ ({{ $totalPrice }}€ + {{ 3 }}€ {{ __('Shippment') }})
</p>

@if (Auth::user()->total_discount)
    <p class="text-end font-mono mb-2">
        {{ __('Total discount') }}: {{ Auth::user()->total_discount }}€
    </p>

    <p class="text-end font-mono mb-2">
        {{ __('Price with discount') }}: {{ $priceWithShippment - Auth::user()->total_discount }}€
    </p>
@endif
