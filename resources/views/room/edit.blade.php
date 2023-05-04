@extends('main_layout')

@section('title')
    Modifier la salle
@endsection

@section('content')
    <div class="flex justify-center my-10">
        <div class="card shadow-lg">
            <div class="card-body">
                <p class="font-bold text-2xl text-center pb-4">Modifier la salle</p>
                <form action="/room/{{ $room->id }}"method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-control">
                        <x-input type="text" name="name" hint="Saisissez le nom de la salle"
                            class="input input-bordered my-3" error="1" value="{{ $room->name }}" />
                        <x-input type="text" name="address" hint="Saisissez l'addresse de la salle'"
                            class="input input-bordered my-3" error="1" value="{{ $room->address }}" />
                    </div>
                    <div class="uploader mt-2 my-3">
                        <input type="file" name="image" class="uploader-input">
                        <span class="uploader-placeholder">Déposez votre image ou cliquez ici pour sélectionner un
                            fichier</span>
                    </div>

                    @error('image')
                        <p class="text-red-600 text-sm">{{ $message }}</p>
                    @enderror
                    <div class="form-control mt-6">
                        <button type="submit" class="btn btn-primary w-full">suivant</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
