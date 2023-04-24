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
@endsection