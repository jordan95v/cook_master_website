<x-layout title="{{ __('Rooms') }}">
    <h1 class="text-5xl text-center my-10">{{ __('List of available rooms') }}</h1>

    {{-- Rooms list card --}}
    <div class="grid grid-cols-1 p-10 lg:px-24 lg:grid-cols-3 gap-6">
        @foreach ($rooms as $room)
            <x-utils.card class="w-full">
                <div class="card-body p-0">
                    <a href="{{ route('room.show', ['room' => $room->id]) }}">
                        {{-- Room image --}}
                        <img src="{{ asset('storage/' . $room->image) }}" alt="{{ __('Image') }}"
                            class="w-full h-96 object-cover rounded-t">

                        {{-- Room info --}}
                        <div class="p-4">
                            <h2 class="card-title text-2xl font-bold mb-6 hover:link">{{ $room->name }}</h2>
                            <p class="text-gray-400">
                                <i class="fa-solid fa-location-dot me-2"></i>{{ $room->address }}
                            </p>
                        </div>
                    </a>
                </div>
            </x-utils.card>
        @endforeach
    </div>
</x-layout>
