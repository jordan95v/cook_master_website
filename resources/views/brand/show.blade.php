<x-layout title="{{ $brand->name }}">
    <div class="grid grid-cols-1 lg:grid-cols-2 justify-center align-center gap-10 p-5 lg:p-12">
        {{-- Brand image hidden on large --}}
        <div class="flex justify-center w-full lg:hidden">
            <img src="{{ asset('storage/' . $brand->image) }}" class="object-cover" />
        </div>

        <div class="lg:py-20">
            {{-- Brand info --}}
            <p class="font-bold font-mono text-2xl lg:text-5xl">{{ $brand->name }}</p>
            <p class="text-lg pt-5" style="white-space: pre-wrap;">{{ $brand->description }}</p>

            {{-- Buttons --}}
            <div class="mt-10 space-y-2 lg:space-x-2">
                <a href="{{ $brand->website }}" class="btn btn-primary w-full lg:w-72">
                    <i class="fa-solid fa-globe text-xl me-2"></i>{{ $brand->website }}
                </a>
                <a href="mailto:{{ $brand->name }}" class="btn btn-neutral w-full lg:w-72">
                    <i class="fa-solid fa-envelopes-bulk text-xl me-2"></i>Contact {{ $brand->name }}
                </a>
            </div>
        </div>

        {{-- Brand image show on large --}}
        <div class="justify-center w-full hidden lg:flex">
            <img src="{{ asset('storage/' . $brand->image) }}" class="object-cover" />
        </div>
    </div>

    {{-- Brand's products --}}
    <div class="text-center p-5">
        <h2 class="text-2xl font-bold">{{ __('Brand\'s product') }}</h2>
        <div class="pt-10 grid lg:grid-cols-5 md:grid-cols-4 grid-cols-1 gap-20 lg:px-7 lg:mt-10">
            @foreach ($brand->products as $product)
                <x-shop.card :product="$product" />
            @endforeach
        </div>
    </div>
</x-layout>
