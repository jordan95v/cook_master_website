<x-layout title="Créer un compte">
    {{-- Register card --}}
    <x-utils.card>
        <form method="post" action="{{ route('user.store') }}" class="card-body">
            @csrf
            <p class="font-bold text-2xl text-center pb-4">Créer un compte</p>

            <x-utils.input name="email" type="email" hint="Email" error="1" />
            <x-utils.input name="name" type="text" hint="Nom d'utilisateur" error="1" />
            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                <x-utils.input name="password" type="password" hint="Mot de passe" error="0" />
                <x-utils.input name="password_confirmation" type="password" hint="Confirmer le mot de passe"
                    error="0" />
            </div>
            <x-utils.form-error name="password" />


            {{-- CGU --}}
            <p class="text-xs mb-2">En continuant, je comprends et j'accepte l'
                <a class="link hover:text-primary" href="#">Avis de confidentialité</a> et les
                <a class="link hover:text-primary" href="#">Conditions d'utilisation</a> de l'Atelier des Gourmets
                pour la création d'un compte.
            </p>

            <button class="btn btn-primary mt-4">S'inscrire</button>
            <div class="divider"></div>
            <p class="text-center">
                Déjà un compte ? <a href="{{ route('login') }}" class="link hover:text-primary">Connexion</a>
            </p>
        </form>
    </x-utils.card>
</x-layout>
