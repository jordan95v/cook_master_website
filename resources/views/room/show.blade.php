@extends('main_layout')

@section('title')
    {{ __('Room') }} : {{ $room->name }}
@endsection

@section('content')
    {{-- Room --}}

    <section class="container mx-auto py-8">
        <div class="flex flex-col md:flex-row">
            <div class="md:w-1/2 mr-5">
                <img src="{{ asset('storage/' . $room->image) }}" alt="Photo de la salle"
                    class="w-full h-full object-cover object-center rounded-md">
            </div>
            <div class="md:w-1/2 md:ml-8 mt-8 md:mt-0 mx-5">
                <h3 class="text-4xl font-bold my-3">{{ $room->name }}</h3>
                <p class="text-lg font-medium my-3">{{ $room->address }}</p>
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.4753698334275!2d2.3870841771139757!3d48.849144971330794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6727347e25d67%3A0xc73e22c1131584f7!2s242%20Rue%20du%20Faubourg%20Saint-Antoine%2C%2075012%20Paris!5e0!3m2!1sfr!2sfr!4v1683577263610!5m2!1sfr!2sfr"
                    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
            <div class="flex">
                <form method="POST" action="/room/{{ $room->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="text-red-500"><i class="fa-solid fa-trash"></i>{{ __('Delete') }}</button>
                </form>
                <a href="/room/{{ $room->id }}/edit" class="text-gray-500 px-3"><i
                        class="fa-solid fa-edit"></i>{{ __('Edit') }}</a>
            </div>

        </div>
    </section>

    {{-- Slide Bar Netflix --}}
    <section class="bg-gray-100 ">
        <div class="container px-4 flex-grow w-full py-4 sm:py-16 mx-auto px-0">
            <div class="mx-auto w-full md:w-4/5 px-4">
                <div class="container my-8">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-3xl font-medium">
                            {{ __('Equipments') }}
                        </h2>
                        <a href="/equiped/edit" class="text-gray-500 px-3"><i
                                class="fa-solid fa-edit"></i>{{ __('Edit equipments') }}</a>
                    </div>
                    <div id="scrollContainer" class="flex flex-no-wrap overflow-x-scroll scrolling-touch items-start mb-8">
                        @foreach ($equiped as $item)
                            @if ($room->id === $item->room_id)
                                <div class="flex-none w-2/3 md:w-1/3 mr-8 md:pb-4 ">
                                    <div class="card w-96 h-96 bg-base-100 shadow-xl image-full">
                                        <figure><img
                                                src="{{ $item->equipment->image ? asset('storage/' . $item->equipment->image) : 'https://picsum.photos/500/300' }}"
                                                alt="Photo de l'événement"
                                                class="w-full h-full object-cover object-center rounded-md"></figure>
                                        <div class="card-body">
                                            <h2 class="card-title">{{ $item->equipment->title }}</h2>
                                            <p>{{ $item->equipment->description }}</p>
                                            <p>{{ __('Brand') }} : {{ $item->equipment->brand }}</p>
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
