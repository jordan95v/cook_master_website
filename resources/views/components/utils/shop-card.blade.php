@props(['product'])

<div class="w-full flex flex-col">
    <a href="">
        <img src="{{ asset('storage/' . $product->image) }}" class="tansform transition hover:scale-110 rounded-lg"
            alt="" />
        <div class="pt-3 flex items-center justify-between">
            <p class="hover:link font-bold">{{ $product->name }}</p>
            <a class="btn btn-ghost btn-xs" href=""><i class="fa-solid fa-bag-shopping me-2"></i>Acheter</a>
        </div>
        <p class="text-start italic">€{{ $product->price }}</p>
    </a>
</div>
