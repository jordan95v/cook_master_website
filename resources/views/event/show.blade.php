@extends('main_layout')

@section('title')
    Evenement
@endsection

@section('content')
<section class="container mx-auto py-8">
    <div class="flex flex-col md:flex-row">
        <div class="md:w-1/2">
        <img src="{{$event->image ? asset('storage/'.$event->image) : 'https://picsum.photos/500/300'}}" alt="Photo de l'événement" class="w-full h-full object-cover object-center rounded-md">
        </div>
        <div class="md:w-1/2 md:ml-8 mt-8 md:mt-0">
            <h2 class="text-3xl font-bold mb-2">{{$event->title}}</h2>
            <p class="text-lg font-medium mb-4">{{$event->description}}</p>
            <ul class="mb-4">
                <li class="flex items-center text-lg font-medium text-gray-700 mb-2">
                    <i class="w-4 h-4 mr-2 text-purple-500 fa-solid fa-calendar-days"></i>
                    Date : {{$event->date}}
                </li>
                <li class="flex items-center text-lg font-medium text-gray-700 mb-2">
                    <i class="w-4 h-4 mr-2 text-purple-500 fa-regular fa-clock"></i>
                    Heure : {{$event->start_time}}-{{$event->end_time}}
                </li>
                <li class="flex items-center text-lg font-medium text-gray-700">
                    <i class="w-4 h-4 mr-2 text-purple-500 fa-sharp fa-solid fa-location-dot"></i>
                    Lieu : {{$event->room->address}}
                </li>
            </ul>
            <a href="#" class="bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-md inline-block font-medium text-lg transition-colors duration-300">Inscrivez-vous maintenant</a>
            <a href="/events/{{$event->id}}/edit" class="bg-purple-500 hover:bg-purple-600 text-white py-2 px-4 rounded-md inline-block font-medium text-lg ">Modifier l'événement</a>
            <form method="POST" action="/events/{{$event->id}}">
                @csrf
                @method('DELETE')
                <button class="text-red-500"><i class="fa-solid fa-trash"></i>Delete</button>
            </form>
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
                    Autres Evenements
                    <a href="/events/" class=""><span class="text-salmon font-medium text-lg ml-2 hover:underline">Tout voir</span></a>
                </h2>
                </div>
                <div id="scrollContainer" class="flex flex-no-wrap overflow-x-scroll scrolling-touch items-start mb-8">
                    @foreach ($events as $event)
                        <div class="flex-none w-2/3 md:w-1/3 mr-8 md:pb-4 " >
                            <div class="card w-96 bg-base-100 shadow-xl image-full">
                                <figure><img src="{{$event->image ? asset('storage/'.$event->image) : 'https://picsum.photos/500/300'}}" alt="Photo de l'événement" class="w-full h-full object-cover object-center rounded-md"></figure>
                                <div class="card-body">
                                    <h2 class="card-title">{{$event['title']}}</h2>
                                    <div class="card-actions absolute bottom-0 right-0 mr-2 mb-2">
                                        <a href="/events/{{$event['id']}}" class="btn btn-primary">Découvrir</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
