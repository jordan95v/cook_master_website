@props(['event'])

<input type="checkbox" id="modal-{{ $event->id }}" class="modal-toggle" />
<div class="modal">
    <div class="modal-box">
        <h3 class="text-lg font-bold">{{ $event->title }}</h3>
        <img src="{{ asset('storage/' . $event->image) }}" alt="" class="mt-2">

        <div class="flex flex-col mt-5">
            {{-- Date --}}
            <div class="flex items-center text-gray-500 text-sm mb-2">
                <i class="w-4 h-4 mr-2 fa-solid fa-calendar-days"></i>
                {{ $event->date }}
            </div>

            {{-- Time --}}
            <div class="flex items-center text-gray-500 text-sm mb-2">
                <i class="w-4 h-4 mr-2 fa-regular fa-clock"></i>
                {{ $event->start_time }} - {{ $event->end_time }}
            </div>

            {{-- Location --}}
            <div class="flex items-center text-gray-500 text-sm mb-2">
                <i class="w-4 h-4 mr-2 fa-sharp fa-solid fa-location-dot"></i>
                <a href="{{ route('room.show', ['room' => $event->room->id]) }}" class="link hover:text-primary">
                    {{ Str::limit($event->room->address, 30) }}
                </a>
            </div>
        </div>

        <x-utils.description-trunked :target="$event" limit=300 />

        <div class="modal-action">
            <a href="{{ route('events.show', ['event' => $event->id]) }}"
                class="btn btn-primary">{{ __('Go to event') }}
            </a>
            <label for="modal-{{ $event->id }}" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">
                ✕
            </label>
        </div>
    </div>
</div>
