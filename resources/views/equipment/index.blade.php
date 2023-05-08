@extends('main_layout')

@section('title')
    {{ __('Equipments') }}
@endsection

@section('content')
    <h1 class="text-center">{{ __('All equipments') }}</h1>
    <div class="flex justify-center">
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-3">
            @foreach ($equipments as $equipment)
                <div class="card w-full bg-base-100 shadow-xl">
                    <a href="/equipment/{{ $equipment['id'] }}">
                        <figure class="h-70 w-full"><img
                                src="{{ $equipment->image ? asset('storage/' . $equipment->image) : 'https://picsum.photos/500/300' }}"
                                alt="{{ __('Image') }}" class="w-full h-full object-cover object-center rounded-md">
                        </figure>
                        <div class="card-body h-50">
                            <h2 class="card-title">{{ $equipment['title'] }}</h2>
                            <p>{{ $equipment['description'] }}</p>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </div>
    <button class="btn  fixed bottom-0 right-0 m-3 w-28 h-28">
        <a href={{ route('equipment.create') }}><i class="fa-solid fa-plus text-4xl"></i></a>
    </button>
@endsection
