<x-layout title="{{ $product->name }}">
    <div class="grid grid-cols-1 lg:grid-cols-2 justify-center align-center gap-10 p-5 lg:p-12">
        <div class="flex justify-center w-full">
            <img src="{{ asset('storage/' . $product->image) }}" class="object-cover" />
        </div>
        <div class="lg:py-20">
            <p class="font-bold font-mono text-2xl lg:text-5xl">
                {{ $product->name }} -
                <a href="{{ route('brand.show', ['brand' => $product->brand->id]) }}" class="link hover:link-primary">
                    {{ $product->brand->name }}
                </a>
            </p>
            {{-- Add rating to product + tag for retrieving other product --}}
            <div class="rating pt-2">
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
            </div>
            <p class="italic text-2xl pt-5 text-primary">{{ $product->price }} €</p>
            <p class="text-lg pt-5" style="white-space: pre-wrap;">{{ $product->description }}</p>

            <form action="{{ route('order.store', ['product' => $product->id]) }}" method="post" class="mt-10">
                @csrf
                <button class="btn btn-primary w-full lg:w-96">
                    <i class="fa-solid fa-bag-shopping me-2"></i>{{ __('Buy') }}
                </button>
            </form>
        </div>
    </div>

    <div class="text-center p-5">
        @if (count($seeblings) > 0)
            <h2 class="text-4xl font-bold">{{ __('Same brand products') }}</h2>
            <div class="pt-7 grid lg:grid-cols-5 md:grid-cols-4 grid-cols-1 gap-20 lg:px-7 lg:mt-10">
                @foreach ($seeblings as $seebling)
                    <x-shop.card :product="$seebling" />
                @endforeach
            </div>

        @endif
    </div>
</x-layout>
