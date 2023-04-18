@extends('main_layout')

@section('title')
    Créer un Evenement
@endsection

@section('content')
<div class="flex justify-center my-10">
    <div class="card shadow-lg">
        <div class="card-body">
            <p class="font-bold text-2xl text-center pb-4">Créer un Evenement</p>
            <form action="/events"method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-control">
                    <x-input type="text" name="title" hint="Saisissez le titre de votre événement"  class="input input-bordered my-3" error="1"/>
                    <x-input type="text" name="organizer" hint="Saisissez le nom de l'organisateur" class="input input-bordered my-3" error="1"/> 
                    <div class="uploader mt-2 my-3">
                        <input type="file" name="image" class="uploader-input">
                        <span class="uploader-placeholder">Déposez votre image ou cliquez ici pour sélectionner un fichier</span>
                    </div>
                    
                    @error('image')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror

                    <textarea name="description" placeholder="Saisissez une description pour votre événement" class="textarea textarea-bordered h-32 my-3"></textarea>
                    
                    @error('description')
                        <p class="text-red-600 text-sm">{{$message}}</p>
                    @enderror
                    
                    <x-input type="text" name="location" hint="Saisissez le lieu de votre événement" class="input input-bordered my-3" error="1"/>
                    <x-input type="date" name="date" hint="date" class="input input-bordered my-3" error="1"/>
                    <x-input type="time" name="start_time" hint="heure de début" class="input input-bordered my-3" error="1"/>
                    <x-input type="time" name="end_time" hint="heure de fin" class="input input-bordered my-3" error="1"/>
                
                </div>
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full">Créer l'événement</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>
@endsection
