<x-layout title="{!! $brand->name !!}">
    <div class="grid grid-cols-1 lg:grid-cols-2 justify-center align-center gap-10 p-5 lg:px-24 lg:p-12">
        {{-- Brand image hidden on large --}}
        <div class="flex justify-center w-full lg:hidden">
            <img src="{{ asset('storage/' . $brand->image) }}" class="object-cover rounded-xl" />
        </div>

        <div class="lg:py-10">
            {{-- Brand info --}}
            <p class="font-bold font-mono text-5xl">{{ $brand->name }}</p>
            <div class="rating pt-7 pb-2">
                <p class="font-mono text-2xl">
                    {{ __('Number of products: :count', ['count' => count($brand->products)]) }}
                </p>
            </div>
            <x-utils.description-trunked :target="$brand" />
            <a href="#full-description" class="link hover:link-primary">{{ __('Show more') }}</a>

            {{-- Buttons --}}
            <div class="mt-10 lg:flex justify-center gap-6 space-y-2 lg:space-y-0">
                <a href="{{ $brand->website }}" class="btn btn-primary w-full lg:w-72">
                    <i class="fa-solid fa-globe text-xl me-2"></i>{{ $brand->website }}
                </a>
                <a href="mailto:{{ $brand->name }}" class="btn btn-neutral w-full lg:w-72">
                    <i class="fa-solid fa-envelopes-bulk text-xl me-2"></i>Contact {{ $brand->contact_email }}
                </a>
            </div>
        </div>

        {{-- Brand image show on large --}}
        <div class="mx-auto hidden lg:flex">
            <img src="{{ asset('storage/' . $brand->image) }}" class="object-cover h-full" />
        </div>
    </div>

    {{-- Brand's products --}}
    @if (count($brand->products))
        <div class="mt-10 lg:mt-0">
            <x-shop.grid :products="$brand->products" name="Brand's products" />
        </div>
    @endif

    {{-- Brand's full description --}}
    <x-shop.description :content="$brand->description" title="Brand description" />
</x-layout>
