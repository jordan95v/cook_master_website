@extends('main_layout')

@section('title')
    {{ $equipment->title }}
@endsection

@section('content')
    <div class="flex justify-center mt-8">
        <div class="flex-col shadow-lg p-5 border-2 hover:border-primary rounded-xl lg:w-1/3 w-full">
            <a href="{{ asset('storage/' . $equipment->image) }}" class="flex justify-center">
                <img src="{{ $equipment->image ? asset('storage/' . $equipment->image) : 'https://picsum.photos/500/300' }}"
                    class="transform transition hover:scale-105 rounded-lg w-96 h-96" alt="" />
            </a>
            <div class="pt-3 flex items-center justify-between text-xl pb-1">
                <p class="font-bold">{{ $equipment->title }} -
                    <a href="" class="link">{{ $equipment->brand }}</a>
                </p>
            </div>
            <p class="pt-5">Commentaire : {{ $equipment->description }}</p>
        </div>
    </div>
@endsection
