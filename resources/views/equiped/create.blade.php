@extends('main_layout')

@section('title')
    Relier un équipement
@endsection

@section('content')
    <div class="flex justify-center my-10">
        <div class="card shadow-lg">
            <div class="card-body">
                <p class="font-bold text-2xl text-center pb-4">{{ __('connect an equipment') }}</p>
                <form method="POST" action="{{ route('equiped.select') }}">
                    @csrf
                    <div class="flex justify-center">
                        <div class="grid grid-cols-3 gap-3">
                            @foreach ($equipment as $item)
                                <div class="card  w-96 bg-base-100 shadow-xl mx-5">
                                    <figure><img
                                            src="{{ $item->image ? asset('storage/' . $item->image) : 'https://picsum.photos/500/300' }}"
                                            alt="Photo de l'équipement"
                                            class="w-full h-full object-cover object-center rounded-md"></figure>
                                    <div class="card-body">
                                        <h2 class="card-title">{{ $item['title'] }}</h2>
                                        <p>{{ $item['description'] }}</p>
                                        <p>{{ __('Brand') }}: {{ $item->brand }}</p>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" name="equipment[]"
                                                value="{{ $item->id }}" id="{{ $item->id }}">
                                            <label class="form-check-label" for="{{ $item->id }}">
                                                {{ __('Select') }}
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <button type="submit" class="my-5 btn btn-primary">{{ __('Validate selection') }}</button>
                </form>
            </div>
        </div>
    </div>
@endsection
