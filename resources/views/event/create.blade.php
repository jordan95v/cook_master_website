@extends('main_layout')

@section('title')
    Créer un Evenement
@endsection

@section('content')
<div class="flex justify-center my-10">
    <div class="card shadow-lg">
        <div class="card-body">
            <p class="font-bold text-2xl text-center pb-4">Créer un Evenement</p>
            <form action="/events"method="POST">
                @csrf
                <div class="form-control">
                    <input type="text" name="title" placeholder="Saisissez le titre de votre événement" class="input input-bordered my-3" required>
                    
                    @error('title')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <input type="text" name="organizer" placeholder="Saisissez le nom de l'organisateur" class="input input-bordered my-3" required>
                    
                    @error('organizer')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    
                    <div class="uploader mt-2 my-3">
                        <input type="file" name="image" class="uploader-input" required>
                        <span class="uploader-placeholder">Déposez votre image ou cliquez ici pour sélectionner un fichier</span>
                    </div>
                    
                    @error('image')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <textarea name="description" placeholder="Saisissez une description pour votre événement" class="textarea textarea-bordered h-32 my-3" required></textarea>
                    
                    @error('description')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    
                    <input type="text" name="location" placeholder="Saisissez le lieu de votre événement" class="input input-bordered my-3" required>
                
                    @error('location')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    
                    <input type="date" name="date" class="input input-bordered my-3" required>
                    
                    @error('date')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror

                    <input type="time" name="start_time" class="input input-bordered my-3" required>
                    
                    @error('start_time')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                    
                    <input type="time" name="end_time" class="input input-bordered my-3" required>
                    
                    @error('end_time')
                        <p class="text-red-500 text-xs mt-1">{{$message}}</p>
                    @enderror
                
                </div>
                <div class="form-control mt-6">
                    <button type="submit" class="btn btn-primary w-full">Créer l'événement</button>
                </div>
            {{-- </form> --}}
        </div>
    </div>
</div>
@endsection
