<x-layout title="{{ __('Events') }}">
    <div class="grid grid-cols-1 p-10 lg:px-24 lg:grid-cols-3 gap-6">
        @foreach ($events as $event)
            <x-utils.card>
                <div class="card-body p-0">
                    <a href="{{ route('events.show', ['event' => $event->id]) }}">
                        {{-- Image --}}
                        <img src="{{ asset('storage/' . $event->image) }}" alt="Photo de l'événement"
                            class="w-full h-full object-cover rounded-t">

                        <div class="p-4">
                            {{-- Title --}}
                            <h2 class="card-title text-2xl font-bold hover:link mb-6">{{ $event->title }}</h2>

                            <div class="flex flex-col">
                                {{-- Date --}}
                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <i class="w-4 h-4 mr-2 fa-solid fa-calendar-days"></i>
                                    {{ $event->date }}
                                </div>

                                {{-- Time --}}
                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <i class="w-4 h-4 mr-2 fa-regular fa-clock"></i>
                                    {{ $event['start_time'] }} - {{ $event->end_time }}
                                </div>

                                {{-- Location --}}
                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <i class="w-4 h-4 mr-2 fa-sharp fa-solid fa-location-dot"></i>
                                    {{ __('Place') }} : {{ $event->room->address }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </x-utils.card>
        @endforeach
    </div>
</x-layout>
