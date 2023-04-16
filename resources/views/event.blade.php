@extends('main_layout')

@section('title')
    Evenement
@endsection

@section('content')
    {{-- <div class="flex flex-row">
        <div class="basis-1/4"></div>
            <div class="basis-1/2">
                <div class="card lg:card-side bg-base-100 shadow-xl mb-5">
                    <figure><img src="{{ asset('/images/pancake.jpg') }}" alt="Album"/></figure>
                    <div class="card-body">
                        <h2 class="card-title">{{$event['title']}}</h2>
                        <p>{{$event['description']}}</p>
                        <p>Auteur : {{$event['Author']}}</p>
                        <p>Lieu : {{$event['location']}}</p>
                    </div>
                </div>
            </div>
        <div class="basis-1/4"></div>
    </div> --}}
<section class="container mx-auto py-8">
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2">
        <img src="https://picsum.photos/500/300" alt="Photo de l'événement" class="w-full h-full object-cover object-center rounded-md">
        </div>
        <div class="md:w-1/2 md:ml-8 mt-8 md:mt-0">
            <h2 class="text-3xl font-bold mb-2">Événement à ne pas manquer</h2>
            <p class="text-lg font-medium mb-4">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis laoreet ullamcorper orci non faucibus. Sed non est id justo venenatis vestibulum.</p>
            <ul class="mb-4">
                <li class="flex items-center text-lg font-medium text-gray-700 mb-2">
                    <i class="w-4 h-4 mr-2 text-purple-500 fa-solid fa-calendar-days"></i>
                    Date : 10 mai 2023
                </li>
                <li class="flex items-center text-lg font-medium text-gray-700 mb-2">
                    <i class="w-4 h-4 mr-2 text-purple-500 fa-regular fa-clock"></i>
                    Heure : 14h-18h
                </li>
                <li class="flex items-center text-lg font-medium text-gray-700">
                    <i class="w-4 h-4 mr-2 text-purple-500 fa-sharp fa-solid fa-location-dot"></i>
                    Lieu : Palais des Congrès, Paris
                </li>
            </ul>
            <a href="#" class="bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-md inline-block font-medium text-lg transition-colors duration-300">Inscrivez-vous maintenant</a>
        </div>
    </div>
</section>

<section class="bg-gray-100 py-8">
    <h3 class="text-4xl font-bold mb-6 text-center">Autre Evenements</h3>
        <div class="grid grid-cols-3 gap-3 ml-5 justify-center">
            @foreach ($events as $event)
            <div class="card w-96 bg-base-100 shadow-xl image-full">
                <figure><img src="https://picsum.photos/500/300"/></figure>
                <div class="card-body">
                    <h2 class="card-title">{{$event['title']}}</h2>
                    <div class="card-actions absolute bottom-0 right-0 mr-2 mb-2">
                        <a href="/events/{{$event['id']}}" class="btn btn-primary">Découvrir</a>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
</section>
@endsection
