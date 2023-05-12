<div class="navbar p-5">
    <div class="navbar-start">
        <x-navbar.dropdown />
    </div>

    <div class="navbar-center">
        <img src="{{ asset('/images/logo.png') }}" alt="logo" class="h-14 rounded">
        <a class="btn btn-ghost normal-case text-xl hidden lg:flex" href="/">
            Atelier des Gourmets
        </a>
    </div>

    <div class="navbar-end items-center">
        <x-user-menu />
    </div>
</div>
