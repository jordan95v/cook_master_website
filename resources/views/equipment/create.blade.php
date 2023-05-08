@extends('main_layout')

@section('title')
    {{ __('Add an equipment') }}
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/equipment_create.png') }}" alt="">
        </div>
        <div class="col-span-2">
            <x-utils.card-grid>
                <form action="/equipment"method="POST" enctype="multipart/form-data" class="card-body">
                    @csrf
                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ __('Add an equipment') }}</h2>
                    {{-- Title --}}
                    <x-utils.input type="text" name="title" hint="Saisissez le nom de l'équipement" error=1 />
                    {{-- Brand --}}
                    <x-utils.input type="text" name="brand" hint="Saisissez la marque de l'équipement"
                        error="1" />

                    {{-- Image --}}
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text-alt">{{ __('Image') }}</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                    </div>

                    {{-- Description --}}
                    <textarea class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                        name="description" placeholder="{{ __('Description') }}"></textarea>
                    <x-utils.form-error name="description" />

                    {{-- Submit --}}
                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">{{ __('Add equipment') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
@endsection
