<x-layout title="Se connecter">
    {{-- Login card --}}
    <x-card>
        <form method="post" action="{{ route('login') }}" class="card-body">
            @csrf
            <p class="font-bold text-2xl text-center pb-4">Connexion</p>

            <x-input name="email" type="email" hint="Email" error="1" />
            <x-input name="password" type="password" hint="Mot de passe" error="1" />
            <a href="#" class="text-sm link hover:text-primary">Mot de passe oublié ?</a>

            <button class="btn btn-primary mt-4">Connexion</button>
            <div class="divider"></div>
            <p class="text-center">
                Pas encore inscrit ?
                <a href="{{ route('register') }}" class="link hover:text-primary">Inscription</a>
            </p>
        </form>
    </x-card>
</x-layout>
