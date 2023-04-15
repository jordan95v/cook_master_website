<x-layout title="{{ $brand->name }}">
    <x-utils.card>
        <figure><img src="{{ asset('storage/' . $brand->image) }}"></figure>
        <div class="card-body">
            <div class="text-center">
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

    <div class="text-center">
        <h2 class="text-2xl font-bold">Les articles de la marque</h2>
    </div>
</x-layout>
