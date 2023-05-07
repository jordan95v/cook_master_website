@extends('main_layout')

@section('title')
    Evenements
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            @foreach ($events as $event)
                <div class="bg-base-100 shadow-xl mx-5">
                    <a href="/events/{{ $event['id'] }}">
                        <figure class="h-64">
                            <img src="{{ $event->image ? asset('storage/' . $event->image) : 'https://picsum.photos/500/300' }}"
                                alt="Photo de l'événement" class="w-full h-full object-cover object-center rounded-md">
                        </figure>
                        <div class="p-4 card-body h-50 flex flex-col ">
                            <div class="mb-auto">
                                {{-- title --}}
                                <h2 class="text-lg font-bold mb-2">{{ $event['title'] }}</h2>
                                {{-- description --}}
                                <p class="text-gray-700 text-base mb-2">{{ $event['description'] }}</p>
                            </div>

                            <div class="card-actions">
                                {{-- date --}}
                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <i class="w-4 h-4 mr-2 fa-solid fa-calendar-days"></i>
                                    {{ $event['date'] }}
                                </div>
                                {{-- time --}}
                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <i class="w-4 h-4 mr-2 fa-regular fa-clock"></i>
                                    {{ $event['start_time'] }} - {{ $event['end_time'] }}
                                </div>
                                {{-- location --}}
                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <i class="w-4 h-4 mr-2 fa-sharp fa-solid fa-location-dot"></i>
                                    Lieu : {{ $event->room->address }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <button class="fixed bottom-0 right-0 m-3 w-20 h-20 bg-purple-500 rounded-full">
        <a href={{ route('events.create') }} class="text-white"><i class="fa-solid fa-plus text-xl"></i></a>
    </button>
@endsection
