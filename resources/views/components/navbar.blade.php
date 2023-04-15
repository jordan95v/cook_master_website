<div class="navbar p-5">
    <div class="navbar-start">
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost btn-circle">
                <i class="fa-solid fa-bars-staggered text-xl"></i>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="/"><i class="fa-solid fa-house"></i>Accueil</a></li>
                <li><a href=""><i class="fa-solid fa-school"></i>Cours</a></li>
                <li><a href=""><i class="fa-solid fa-calendar-days"></i>Evenements</a></li>
                <li><a href=""><i class="fa-solid fa-store"></i>Boutique</a></li>
            </ul>
        </div>
    </div>

    <div class="navbar-center">
        <img src="{{ asset('/images/logo.png') }}" alt="logo" class="h-14 rounded">
        <a class="btn btn-ghost normal-case text-xl">Atelier des Gourmets</a>
    </div>

    <div class="navbar-end">
        <button class="btn btn-ghost btn-circle">
            <i class="fa-solid fa-cart-shopping text-xl"></i>
        </button>
        <div class="dropdown dropdown-end">
            <label tabindex="0" class="btn btn-ghost btn-circle avatar @auth online @endauth">
                @auth
                    <img src="{{ auth()->user()->image ?? false ? 'haha' : asset('images/user.png') }}" />
                @else
                    <i class="fa-solid fa-user text-xl"></i>
                @endauth
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                @auth
                    @if (!auth()->user()->email_verified_at)
                        <li>
                            <a href="{{ route('verification.send') }}"><i class="fa-solid fa-share">
                                </i>Renvoyer le mail de vérification</a>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('user.edit') }}"><i class="fa-solid fa-gear"></i>Modifier mon profil</a>
                        </li>
                        @if (auth()->user()->role != 0)
                            <li>
                                <a href="{{ route('admin.dashboard') }}">
                                    <i class="fa-solid fa-shield"></i>Admin dashboard
                                </a>
                            </li>
                        @endif
                    @endif
                    <li>
                        <a href="{{ route('logout') }}"><i class="fa-solid fa-arrow-right-to-bracket">
                            </i>Se déconnecter
                        </a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('show-login') }}"><i class="fa-solid fa-arrow-up-from-bracket">
                            </i>Se connecter
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('register') }}"><i class="fa-solid fa-database"></i>S'inscrire</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</div>
