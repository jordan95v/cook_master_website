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
                    <li><a href="/"><i class="fa-solid fa-house"></i>Accueil</a></li>
                    <li><a href=""><i class="fa-solid fa-school"></i>Cours</a></li>
                    <li><a href=""><i class="fa-solid fa-book"></i>Leçon</a></li>
                    <li><a href=""><i class="fa-solid fa-store"></i>Boutique</a></li>
                    <div class="divider"></div>
                    @auth
                        @if (!auth()->user()->email_verified_at)
                            <li>
                                <a href="/email/resend"><i class="fa-solid fa-share">
                                    </i>Renvoyer le mail de vérification</a>
                            </li>
                        @else
                            <li><a href="/users/edit"><i class="fa-solid fa-gear"></i>Modifier mon profil</a></li>
                        @endif
                        <li><a href="/logout"><i class="fa-solid fa-arrow-right-to-bracket"></i>Se déconnecter</a></li>
                    @else
                        <li><a href="/login"><i class="fa-solid fa-arrow-up-from-bracket"></i>Se connecter</a></li>
                        <li><a href="/register"><i class="fa-solid fa-database"></i>S'inscrire</a></li>
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
