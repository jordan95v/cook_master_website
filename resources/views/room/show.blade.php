<x-layout title="{{ __('Room') }} : {{ $room->name }}">
    {{-- Room --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 py-10 lg:px-24">
        {{-- Room image --}}
        <div class="my-auto">
            <img src="{{ asset('storage/' . $room->image) }}" alt="Photo de la salle"
                class="w-full h-96 object-cover object-center rounded-md">
        </div>
        <div class="pt-5">
            {{-- Room info --}}
            <h3 class="text-3xl lg:text-4xl font-bold mb-3">{{ $room->name }}</h3>
            <p class="text-lg font-medium my-3"><i class="fa-solid fa-location-dot me-2"></i>{{ $room->address }}</p>

            {{-- Google Maps --}}
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.4753698334275!2d2.3870841771139757!3d48.849144971330794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6727347e25d67%3A0xc73e22c1131584f7!2s242%20Rue%20du%20Faubourg%20Saint-Antoine%2C%2075012%20Paris!5e0!3m2!1sfr!2sfr!4v1683577263610!5m2!1sfr!2sfr"
                class="w-full py-10" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>

            {{-- Actions --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-4">
                <a href="{{ route('room.edit', ['room' => $room->id]) }}" class="btn btn-primary w-full">
                    <i class="fa-solid fa-edit"></i>{{ __('Edit') }}
                </a>
                <form method="POST" action="/room/{{ $room->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-error w-full">
                        <i class="fa-solid fa-trash me-2"></i>{{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Slide Bar Netflix --}}
    <div class="bg-gray-100 py-10 pb-10 mb-10 lg:px-24">
        <div class="lg:flex justify-between items-center ms-10 lg:ms-0 lg:pb-6">
            <h2 class="text-3xl font-bold">
                {{ __('Equipments') }}
            </h2>
            <a href="{{ route('equiped.edit', ['room' => $room->id]) }}" class="text-gray-500">
                <i class="fa-solid fa-edit me-2"></i>{{ __('Edit equipments') }}
            </a>
        </div>

        <div class="grid grid-cols-1 lg:p-0 lg:grid-cols-5 gap-6">
            @foreach ($equipments as $item)
                <x-utils.card class="image-full h-96">
                    <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover rounded-md">
                    <div class="card-body">
                        <h2 class="card-title">{{ $item->title }}</h2>
                        <p>{{ __('Brand') }} : {{ $item->brand }}</p>
                    </div>
                </x-utils.card>
            @endforeach
        </div>
    </div>
</x-layout>
