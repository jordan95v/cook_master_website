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
                <li><a href="{{ route('store') }}"><i class="fa-solid fa-store"></i>Boutique</a></li>
            </ul>
        </div>
    </div>

    <div class="navbar-center">
        <img src="{{ asset('/images/logo.png') }}" alt="logo" class="h-14 rounded">
        <a class="btn btn-ghost normal-case text-xl hidden lg:flex" href="/">
            Atelier des Gourmets
        </a>
    </div>

    <div class="navbar-end">
        <x-user-menu />
    </div>
</div>
