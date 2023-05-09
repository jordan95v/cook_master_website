@extends('main_layout')

@section('title')
    {{ __('Create a room') }}
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/room_create.png') }}" alt="">
        </div>
        <div class="col-span-2">
            <x-utils.card-grid>
                <form action="/room"method="POST" enctype="multipart/form-data" class="card-body">
                    @csrf
                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ __('Add a room') }}</h2>

                    {{-- Name --}}
                    <x-utils.input type="text" name="name" hint="{{ __('Enter the name of the room') }}" error=1 />

                    {{-- Address --}}
                    <x-utils.input type="text" name="address" hint="{{ __('Enter the address of the room') }}"
                        error="1" />

                    {{-- Image --}}
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text-alt">Image</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                    </div>

                    {{-- Submit --}}
                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">{{ __('Next') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
@endsection
