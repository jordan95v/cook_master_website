@extends('main_layout')

@section('title')
    Créer un Evenement
@endsection

@section('content')
    {{-- Register card
    <div class="flex justify-center my-10">
        <div class="card shadow-lg md:w-1/3 w-96">
            <form method="post"  class="card-body">
                @csrf
                <p class="font-bold text-2xl text-center pb-4">Créer un événement</p>

                <x-input name="email" type="email" hint="Email" error="1" />
                <x-input name="name" type="text" hint="Nom d'utilisateur" error="1" />
                <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                    <x-input name="password" type="password" hint="Mot de passe" error="0" />
                    <x-input name="password_confirmation" type="password" hint="Confirmer le mot de passe" error="0" />
                </div>
                @error('password')
                    <p class="text-red-600 text-sm">{{ $message }}</p>
                @enderror
                <button class="btn btn-primary mt-4">Créer</button>
            </form>
        </div>
    </div> --}}
    <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Créer un Événement</title>
    <!-- Include the Tailwind CSS framework -->
    <link href="https://unpkg.com/tailwindcss@2.1.2/dist/tailwind.min.css" rel="stylesheet">
    <!-- Include the DaisyUI plugin -->
    <link rel="stylesheet" href="https://unpkg.com/daisyui@1.11.2/dist/daisyui.min.css"/>
  </head>
  <body>
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
                            </form>
                        </div>
                    </div>
                </div>
        

@endsection
