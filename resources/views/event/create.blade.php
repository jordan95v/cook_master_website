@extends('main_layout')

@section('title')
    Créer un Evenement
@endsection

@section('content')
    {{-- Register card --}}
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
    </div>
@endsection
