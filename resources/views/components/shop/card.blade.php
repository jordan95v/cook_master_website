@props(['product'])

<div class="flex flex-col">
    <a href="{{ route('product.show', ['product' => $product->id]) }}">
        {{-- Product image --}}
        <img src="{{ asset('storage/' . $product->image) }}"
            class="lg:h-64 h-52 w-full object-cover transform transition hover:scale-110" alt="" />

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
        <div class="flex justify-start">
            <div class="rating rating-half rating-md">
                @for ($i = 0; $i < 5; $i++)
                    <input type="radio" disabled
                        class="bg-orange-500 mask mask-star-2 mask-half-@if ($i % 2 == 0) 1 @else 2 @endif"
                        @if ($i > $product->rating()) checked @endif />
                @endfor
            </div>
            <p class="text-start italic ms-3">€{{ $product->price }}</p>
        </div>
    </a>
</div>
