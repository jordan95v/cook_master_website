@extends('main_layout')

@section('title')
    Salles
@endsection

@section('content')
    <div class="flex justify-center">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            @foreach ($rooms as $room)
                <div class="card w-full bg-base-100 shadow-xl">
                    <a href="/room/{{ $room['id'] }}">
                        <figure class="h-64 w-full"><img
                                src="{{ $room->image ? asset('storage/' . $room->image) : 'https://picsum.photos/500/300' }}"
                                alt="Photo de l'événement" class="w-full h-full object-cover object-center rounded-md">
                        </figure>
                        <div class="card-body h-50">
                            <h2 class="card-title">{{ $room['name'] }}</h2>
                            <p>{{ $room['address'] }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <button class="btn  fixed bottom-0 right-0 m-3 w-28 h-28">
        <a href={{ route('room.create') }}><i class="fa-solid fa-plus text-4xl"></i></a>
    </button>
@endsection
