@props(['products', 'name'])

<div class="text-center lg:px-20">
    <h2 class="text-5xl font-bold">{{ __($name) }}</h2>
    <div class="py-10 grid lg:grid-cols-5 md:grid-cols-4 grid-cols-1 gap-20 lg:px-7 lg:mt-10">
        @foreach ($products as $product)
            <x-shop.card :product="$product" />
        @endforeach
    </div>
</div>
