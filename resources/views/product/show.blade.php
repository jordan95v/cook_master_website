<x-layout title="{{ $product->name }}">
    <div class="grid grid-cols-1 lg:grid-cols-2 justify-center align-center gap-10 p-5 lg:px-24 lg:p-12">
        <div class="mx-auto">
            <img src="{{ asset('storage/' . $product->image) }}" class="object-cover h-full" />
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
            <div class="py-5 text-gray-600">{!! Str::limit($product->description, $limit = 800) !!}</div>
            <a href="#full-description" class="link hover:link-primary">{{ __('Show more') }}</a>

            <form action="{{ route('order.store', ['product' => $product->id]) }}" method="post" class="mt-10">
                @csrf
                <button class="btn btn-primary w-full lg:w-96">
                    <i class="fa-solid fa-bag-shopping me-2"></i>{{ __('Buy') }}
                </button>
            </form>
        </div>
    </div>

    @if (count($seeblings) > 0)
        <x-shop.grid :products="$seeblings" name="Same brand products" />
    @endif

    {{-- Product's full description --}}
    <x-shop.description :content="$product->description" title="Product description" />
</x-layout>
