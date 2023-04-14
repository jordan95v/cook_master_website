@extends('main_layout')

@section('title')
    Evenement
@endsection

@section('content')
    {{-- <h1>{{$heading}}</h1> --}}

    <div class="flex flex-row">
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
    </div>
@endsection
