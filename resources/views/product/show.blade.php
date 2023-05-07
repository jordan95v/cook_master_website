<x-layout title="{{ $product->name }}">
    <div class="flex justify-center mt-8">
        <div class="flex-col shadow-lg p-5 border-2 hover:border-primary rounded-xl lg:w-1/3 w-full">
            <a href="{{ asset('storage/' . $product->image) }}" class="flex justify-center">
                <img src="{{ asset('storage/' . $product->image) }}"
                    class="transform transition hover:scale-105 rounded-lg w-96 h-96" alt="" />
            </a>
            <div class="pt-3 flex items-center justify-between text-xl pb-1">
                <p class="font-bold">{{ $product->name }} -
                    <a href="{{ route('brand.show', ['brand' => $product->brand->id]) }}"
                        class="link">{{ $product->brand->name }}</a>
                </p>
                <form action="{{ route('order.store', ['product' => $product->id]) }}" method="post">
                    @csrf
                    <button class="btn btn-ghost btn-xs">
                        <i class="fa-solid fa-bag-shopping me-2"></i>{{ __('Buy') }}
                    </button>
                </form>
            </div>

            {{-- Add rating to product + tag for retrieving other product --}}
            <div class="rating">
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" checked />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
            </div>
            <p class="text-start italic text-lg">€{{ $product->price }}</p>
            <p class="pt-5 text-lg" style="white-space: pre-wrap;">{{ $product->description }}</p>
        </div>
    </div>

    <div class="text-center p-5">
        @if (count($seeblings) > 0)
            <h2 class="text-2xl font-bold">{{ __('Same brand products') }}</h2>
            <div class="pt-10 grid lg:grid-cols-5 md:grid-cols-4 grid-cols-1 gap-20 lg:px-10 lg:mt-10">
                @foreach ($seeblings as $seebling)
                    <x-shop.card :product="$seebling" />
                @endforeach
            </div>

        @endif
    </div>
</x-layout>
