@extends('main_layout')

@section('title')
    Créer une salle
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
                    <h2 class="card-title text-2xl flex justify-center pb-2">Ajouter une salle</h2>

                    {{-- Name --}}
                    <x-utils.input type="text" name="name" hint="Saisissez le nom de la salle" error=1 />

                    {{-- Address --}}
                    <x-utils.input type="text" name="address" hint="Saisissez l'addresse de la salle" error="1" />

                    {{-- Image --}}
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text-alt">Image de la salle</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                    </div>

                    {{-- Submit --}}
                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">suivant</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
@endsection
