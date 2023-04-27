@php
    $totalPrice = 0;
    foreach (Auth::user()->orders as $item) {
        $totalPrice += $item->product->price * $item->quantity;
    }
    $priceWithShippment = $totalPrice + 3;
@endphp
<p class="text-end font-mono mb-2">
    Total: {{ $priceWithShippment }}€ ({{ $totalPrice }}€ + {{ 3 }}€ livraison)
</p>
