@extends('main_layout')

@section('title')
    Evenements
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            @foreach ($events as $event)
                <div class="card w-full bg-base-100 shadow-xl">
                    <a href="/events/{{ $event['id'] }}">
                        <figure class="h-64 w-full"><img
                                src="{{ $event->image ? asset('storage/' . $event->image) : 'https://picsum.photos/500/300' }}"
                                alt="Photo de l'événement" class="w-full h-full object-cover object-center rounded-md">
                        </figure>
                        <div class="card-body h-60">
                            <h2 class="card-title">{{ $event['title'] }}</h2>
                            <p>{{ $event['description'] }}</p>
                            <div class="card-actions justify-end">

                                {{-- DATE --}}
                                <i class="w-4 h-4 mr-1 ml-2 text-purple-500 fa-solid fa-calendar-days"></i>
                                {{ $event['date'] }}

                                {{-- TIME --}}
                                <i class="w-4 h-4 mr-1 ml-2 text-purple-500 fa-regular fa-clock"></i>
                                {{ $event['start_time'] }} - {{ $event['end_time'] }}

                                {{-- PLACE --}}
                                <div>
                                    <i class="w-4 h-4 mr-1 ml-2 text-purple-500 fa-sharp fa-solid fa-location-dot"></i>
                                    Lieu : {{ $event->room->address }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <button class="btn  fixed bottom-0 right-0 m-3 w-28 h-28">
        <a href={{ route('events.create') }}><i class="fa-solid fa-plus text-4xl"></i></a>
    </button>
@endsection
