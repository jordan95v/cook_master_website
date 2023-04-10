<div class="p-5">
    <div class="grid grid-cols-1 md:grid-cols-3 items-center">
        {{-- Dropdown --}}
        <div class="md:text-start">
            <div class="dropdown">
                <label tabindex="0" class="btn btn-ghost btn-circle">
                    <i class="fa-solid fa-bars-staggered text-xl"></i>
                </label>
                <ul tabindex="0"
                    class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                    <li><a href="/">🏡 Accueil</a></li>
                    <li><a href="">🏫 Cours</a></li>
                    <li><a href="">📚 Leçon</a></li>
                    <li><a href="">💸 Boutique</a></li>
                    <div class="divider"></div>
                    @auth
                        <li><a href="/logout">Se déconnecter</a></li>
                    @else
                        <li><a href="/login">📤 Se connecter</a></li>
                        <li><a href="/register">📥 S'inscrire</a></li>
                    @endauth
                </ul>
            </div>
        </div>

        {{-- Logo --}}
        <div class="flex justify-center">
            <a href="/">
                <img src="{{ asset('/images/logo.png') }}" alt="atelier" class="h-32 rounded">
            </a>
        </div>

        {{-- Search form --}}
        <div class="md:text-end text-center">
            <form action="/" method="post">
                <input type="text" name="search" class="input border-2 input-bordered hover:input-primary max-w-sm"
                    placeholder="Rechercher ...">
                <button class="btn btn-ghost btn-circle">
                    <i class="fa-solid fa-magnifying-glass text-xl"></i>
                </button>
            </form>
        </div>
    </div>
</div>
