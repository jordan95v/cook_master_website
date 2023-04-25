@extends('main_layout')

@section('title')
Equipements
@endsection

@section('content')

<h1 class="text-center">Tous les équipements</h1> 
<div class="flex justify-center">
    <div class="grid grid-cols-3 gap-3">
        @foreach ($equipments as $equipment)
        <div class="card  w-96 bg-base-100 shadow-xl mx-5">
            <figure><img src="{{$equipment->image ? asset('storage/'.$equipment->image) : 'https://picsum.photos/500/300'}}" alt="Photo de l'équipement" class="w-full h-full object-cover object-center rounded-md"></figure>
            <div class="card-body">
                <h2 class="card-title">{{$equipment['title']}}</h2>
                <p>{{$equipment['description']}}</p>
            </div>
        </div>
        @endforeach
    </div>
</div>
<button class="btn  fixed bottom-0 right-0 m-3 w-28 h-28">
    <a href={{ route('equipment.create') }}><i class="fa-solid fa-plus text-4xl"></i></a>
</button>

{{-- Slide Bar Netflix
<section class="bg-gray-100 ">

    <div class="container px-4 flex-grow w-full py-4 sm:py-16 mx-auto px-0">
        <div class="mx-auto w-full md:w-4/5 px-4">
            <div class="container my-8">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-3xl font-medium">
                        Equipements
                    </h2>
                </div>
                <div id="scrollContainer" class="flex flex-no-wrap overflow-x-scroll scrolling-touch items-start mb-8">
                    @foreach ($equiped as $item)
                        @if($item->room_id === 1)
                            <div class="flex-none w-2/3 md:w-1/3 mr-8 md:pb-4 " >
                                <div class="card w-96 bg-base-100 shadow-xl image-full">
                                    <figure><img src="{{$item->equipment->image ? asset('storage/'.$item->equipment->image) : 'https://picsum.photos/500/300'}}" alt="Photo de l'événement" class="w-full h-full object-cover object-center rounded-md"></figure>
                                    <div class="card-body">
                                        <h2 class="card-title">{{$item->equipment->title}}</h2>
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
</section> --}}
@endsection