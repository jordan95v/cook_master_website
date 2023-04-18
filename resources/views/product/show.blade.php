<x-layout title="{{ $product->name }}">
    <div class="flex justify-center">
        <div class="flex-col shadow-lg p-5 rounded-xl lg:w-1/3 w-full">
            <a href="{{ asset('storage/' . $product->image) }}">
                <img src="{{ asset('storage/' . $product->image) }}"
                    class="transform transition hover:scale-105 rounded-lg lg:max-w-lg" alt="" />
            </a>
            <div class="pt-3 flex items-center justify-between">
                <p class="font-bold">{{ $product->name }} -
                    <a href="{{ route('brand.show', ['brand' => $product->brand->id]) }}"
                        class="link">{{ $product->brand->name }}</a>
                </p>
                <a class="btn btn-ghost btn-xs" href=""><i class="fa-solid fa-bag-shopping me-2"></i>Acheter</a>
            </div>
            {{-- Add rating to product + tag for retrieving other product --}}
            <div class="rating">
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" checked />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
            </div>
            <p class="text-start italic">€{{ $product->price }}</p>
            <p class="max-w-sm pt-5">{{ $product->description }}</p>
        </div>
    </div>

</x-layout>
