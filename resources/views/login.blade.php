@extends('main_layout')

@section('content')
    <div class="rounded d-flex my-5 py-5 justify-content-center">
        <form method="POST" class="p-5 rounded shadow-lg">
            <h2>Connexion</h2>
            <div class="form-group">
                <label class="pb-2">E-mail</label>
                <input type="email" class="form-control">
            </div>
            <div class="form-group py-2">
                <label class="pb-2">Mot de passe</label>
                <input type="password" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary w-100 my-4">Suivant</button>
            <a href="#" class="link-secondary d-flex justify-content-center">Vous avez des difficultés de connexion
                ?</a>
            <hr>
            <a href="/register" class="btn btn-secondary w-100 mt-3">Créer un compte</a>
        </form>
    </div>
@endsection
