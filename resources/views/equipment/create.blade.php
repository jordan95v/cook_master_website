@extends('main_layout')

@section('title')
    Créer un Equipement
@endsection

@section('content')
<div class="flex justify-center my-10">
    <div class="card shadow-lg">
        <div class="card-body">
            <p class="font-bold text-2xl text-center pb-4">Créer un Equipement</p>
            <form action="/equipment"method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-control">
                    <x-input type="text" name="title" hint="Saisissez le nom de l'équipement"  class="input input-bordered my-3" error="1"/>
                    <x-input type="text" name="brand" hint="Saisissez la marque de l'équipement"  class="input input-bordered my-3" error="1"/>
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
                
                </div>
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full">Créer l'équipement</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
