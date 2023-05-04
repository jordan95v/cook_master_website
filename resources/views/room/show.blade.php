@extends('main_layout')

@section('title')
    Votre salle
@endsection

@section('content')
    <section class="container mx-auto py-8">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/2">
                <img src="{{ $room->image ? asset('storage/' . $room->image) : 'https://picsum.photos/500/300' }}"
                    alt="Photo de l'événement" class="w-full h-full object-cover object-center rounded-md">
            </div>
            <div class="md:w-1/2 md:ml-8 mt-8 md:mt-0">
                <h2 class="text-3xl font-bold mb-2">{{ $room->name }}</h2>
                <p class="text-lg font-medium mb-4">{{ $room->address }}</p>
            </div>
            <form method="POST" action="/room/{{ $room->id }}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
            </form>
            <a href="/room/{{ $room->id }}/edit" class="text-gray-500 px-3"><i class="fa-solid fa-edit"></i>Edit</a>
        </div>
    </section>

    {{-- Slide Bar Netflix --}}
    <section class="bg-gray-100 ">
        <div class="container px-4 flex-grow w-full py-4 sm:py-16 mx-auto px-0">
            <div class="mx-auto w-full md:w-4/5 px-4">
                <div class="container my-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-3xl font-medium">
                            Equipements
                        </h2>
                        <a href="/equiped/edit" class="text-gray-500 px-3"><i class="fa-solid fa-edit"></i>Modifier les
                            Equipements</a>
                    </div>
                    <div id="scrollContainer" class="flex flex-no-wrap overflow-x-scroll scrolling-touch items-start mb-8">
                        @foreach ($equiped as $item)
                            @if ($room->id === $item->room_id)
                                <div class="flex-none w-2/3 md:w-1/3 mr-8 md:pb-4 ">
                                    <div class="card w-96 bg-base-100 shadow-xl image-full">
                                        <figure><img
                                                src="{{ $item->equipment->image ? asset('storage/' . $item->equipment->image) : 'https://picsum.photos/500/300' }}"
                                                alt="Photo de l'événement"
                                                class="w-full h-full object-cover object-center rounded-md"></figure>
                                        <div class="card-body">
                                            <h2 class="card-title">{{ $item->equipment->title }}</h2>
                                            <p>{{ $item->equipment->description }}</p>
                                            <p>Marque: {{ $item->equipment->brand }}</p>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
