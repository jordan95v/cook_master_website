<x-layout title="Se connecter">
    <div class="grid grid-cols-1 md:grid-cols-2">
        {{-- Login card --}}
        <x-utils.card-grid>
            <form method="post" action="{{ route('login') }}" class="card-body">
                @csrf
                <p class="font-bold text-2xl text-center pb-4">Connexion</p>

                <x-utils.input name="email" type="email" hint="Email" error="1" />
                <x-utils.input name="password" type="password" hint="Mot de passe" error="1" />
                <a href="#" class="text-sm link hover:text-primary">Mot de passe oublié ?</a>

                <button class="btn btn-primary mt-4">Connexion</button>
                <div class="divider"></div>
                <p class="text-center">
                    Pas encore inscrit ?
                    <a href="{{ route('register') }}" class="link hover:text-primary">Inscription</a>
                </p>
            </form>
        </x-utils.card-grid>
        <img src="{{ asset('images/login.png') }}" alt="">
    </div>
</x-layout>
