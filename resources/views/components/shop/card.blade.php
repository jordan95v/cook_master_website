@props(['product'])

<div class="w-full flex flex-col">
    <a href="{{ route('product.show', ['product' => $product->id]) }}">
        {{-- Product image --}}
        <img src="{{ asset('storage/' . $product->image) }}" class="transform transition hover:scale-110 rounded-lg"
            alt="" />

        {{-- Product content --}}
        <div class="pt-3 flex items-center justify-between">
            <p class="hover:link font-bold">{{ $product->name }}</p>
            <form action="{{ route('order.create', ['product' => $product->id]) }}" method="post">
                @csrf
                <button class="btn btn-ghost btn-xs"><i class="fa-solid fa-bag-shopping me-2"></i>Acheter</button>
            </form>
        </div>
        <p class="text-start italic">€{{ $product->price }}</p>
    </a>
</div>
