@extends('main_layout')

@section('title')
    Evenements
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="grid grid-cols-3 gap-3">
            @foreach ($events as $event)
                <div class="card  w-96 bg-base-100 shadow-xl mx-5">
                    <a href="/events/{{ $event['id'] }}">
                        <figure><img
                                src="{{ $event->image ? asset('storage/' . $event->image) : 'https://picsum.photos/500/300' }}"
                                alt="Photo de l'événement" class="w-full h-full object-cover object-center rounded-md">
                        </figure>
                        <div class="card-body">
                            <h2 class="card-title">{{ $event['title'] }}</h2>
                            <p>{{ $event['description'] }}</p>
                            <div class="card-actions justify-end">
                                <i class="w-4 h-4 mr-1 ml-2 text-purple-500 fa-solid fa-calendar-days"></i>
                                10 mai 2023
                                <i class="w-4 h-4 mr-1 ml-2 text-purple-500 fa-regular fa-clock"></i>
                                14h-18h
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
