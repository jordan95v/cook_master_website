<div class="navbar bg-base-100 p-5">
    <div class="navbar-start">
        {{-- Navbar items streched --}}
        <div class="dropdown">
            <label tabindex="0" class="btn btn-ghost lg:hidden">
                <i class="fa-solid fa-bars-staggered text-2xl"></i>
            </label>
            <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
                <x-admin.menu direction="right" />
            </ul>
        </div>
        <a class="btn btn-ghost normal-case text-xl" href="{{ route('admin.dashboard') }}">Admin dashboard</a>
    </div>

    {{-- Navbar items full screen --}}
    <div class="navbar-center hidden lg:flex">
        <ul class="menu menu-horizontal px-1">
            <x-admin.menu direction="down" />
        </ul>
    </div>

    {{-- Navbar end --}}
    <div class="navbar-end">
        <x-user-menu />
    </div>
</div>
