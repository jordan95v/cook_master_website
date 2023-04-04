@extends('main_layout')

@section('content')
    <div class="rounded d-flex my-5 py-5 justify-content-center">
        <form method="POST" class="p-5 rounded shadow-lg">
            <h2 class="my-4">Créer un compte</h2>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="pb-2">Prenom</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label class="pb-2">Nom</label>
                        <input type="text" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group py-2">
                <label class="pb-2">E-mail</label>
                <input type="email" class="form-control">
            </div>
            <div class="row">
                <div class="col-lg-6">
                    <div class="form-group py-2">
                        <label class="pb-2">Mot de passe</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group py-2">
                        <label class="pb-2">Confirmation du mot de passe</label>
                        <input type="password" class="form-control">
                    </div>
                </div>
            </div>

            {{-- CGU --}}
            <div class="pt-2">
                <p>En continuant, je comprends et j'accepte l'<a class="link-secondary" href="www.google.com">Avis de
                        confidentialité</a> et les <a class="link-secondary" href="#">Conditions d'utilisation</a> de
                    l'Atelier des Gourmets pour la création d'un compte</p>
            </div>
            <div class="d-grid gap-2 pt-3 ">
                <button type="submit" class="btn btn-success">Créer un compte</button>
            </div>
        </form>
    </div>
@endsection
