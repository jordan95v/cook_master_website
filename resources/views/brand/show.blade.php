<x-layout title="{{ $brand->name }}">
    <x-utils.card>
        <div class="card-body">
            <div class="text-center">
                <h2 class="card-title font-bold flex justify-center text-3xl mb-4">{{ $brand->name }}</h2>
                <figure><img src="{{ asset('storage/' . $brand->image) }}" class="mb-4"></figure>
                <a href="{{ $brand->website }}" class="btn btn-ghost">
                    <i class="fa-solid fa-globe text-xl me-2"></i>{{ $brand->website }}
                </a>
                <a href="mailto:{{ $brand->name }}" class="btn btn-ghost">
                    <i class="fa-solid fa-envelopes-bulk text-xl me-2"></i>Contact {{ $brand->name }}
                </a>
            </div>
            <p class="mt-4">{{ $brand->description }}</p>
        </div>
    </x-utils.card>

    <div class="text-center p-5">
        <h2 class="text-2xl font-bold">Les articles de la marque</h2>
        <div class="pt-10 grid lg:grid-cols-5 md:grid-cols-4 grid-cols-1 gap-20 lg:px-10 lg:mt-10">
            @foreach ($brand->products as $product)
                <x-shop.card :product="$product" />
            @endforeach
        </div>
    </div>
</x-layout>
