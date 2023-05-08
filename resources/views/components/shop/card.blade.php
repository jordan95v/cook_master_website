@props(['product'])

<div class="flex flex-col">
    <a href="{{ route('product.show', ['product' => $product->id]) }}">
        {{-- Product image --}}
        <img src="{{ asset('storage/' . $product->image) }}"
            class="h-72 w-full object-cover transform transition hover:scale-110" alt="" />

        {{-- Product content --}}
        <div class="pt-3 flex items-center justify-between">
            <p class="hover:link font-bold">{{ $product->name }}</p>
            <form action="{{ route('order.store', ['product' => $product->id]) }}" method="post">
                @csrf
                <button class="btn btn-ghost btn-xs">
                    <i class="fa-solid fa-bag-shopping me-2"></i>{{ __('Buy') }}
                </button>
            </form>
        </div>
        <p class="text-start italic">€{{ $product->price }}</p>
    </a>
</div>
