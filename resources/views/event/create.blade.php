@extends('main_layout')

@section('title')
    Créer un Evenement
@endsection

@section('content')
<div class="flex justify-center my-10">
    <div class="card shadow-lg ">
        <div class="card-body">
            <p class="font-bold text-2xl text-center pb-4">Créer un Evenement</p>
            {{-- <form action="{{ route('store-event') }}"method="POST"> --}}
                <div class="form-control">
                    <input type="text" name="title" placeholder="Saisissez le titre de votre événement" class="input input-bordered my-3" required>
                    <div class="uploader mt-2 my-3">
                        <input type="file" name="image" class="uploader-input" required>
                        <span class="uploader-placeholder">Déposez votre image ou cliquez ici pour sélectionner un fichier</span>
                    </div>
                    <textarea name="description" placeholder="Saisissez une description pour votre événement" class="textarea textarea-bordered h-32 my-3" required></textarea>
                    <input type="text" name="location" placeholder="Saisissez le lieu de votre événement" class="input input-bordered my-3" required>
                    <input type="date" name="date" class="input input-bordered my-3" required>
                    <input type="time" name="start_time" class="input input-bordered my-3" required>
                    <input type="time" name="end_time" class="input input-bordered my-3" required>
                    <input type="number" id="capacity" name="capacity" min="1" max="1000" placeholder="Capacité maximum" class="input input-bordered my-3">
                </div>
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full">Créer l'événement</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>
@endsection
