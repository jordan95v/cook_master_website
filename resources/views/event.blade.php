@extends('main_layout')

@section('title')
    Evenement
@endsection

@section('content')
    {{-- <h1>{{$heading}}</h1> --}}
    <div class="grid grid-cols-3 gap-3">
        <div class="card lg:card-side bg-base-100 shadow-xl mb-5">
            <figure><img src="{{ asset('/images/pancake.jpg') }}" alt="Album"/></figure>
            <div class="card-body">
                <h2 class="card-title">{{$event['title']}}</h2>
                <p>{{$event['description']}}</p>
                <p>{{$event['Author']}}</p>
                <p>{{$event['location']}}</p>
            </div>
        </div>
    </div>
@endsection
