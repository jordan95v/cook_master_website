<div class="dropdown">
    <label tabindex="0" class="btn btn-ghost btn-circle">
        <i class="fa-solid fa-bars-staggered text-xl"></i>
    </label>
    <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href="/"><i class="fa-solid fa-house"></i>{{ __('Home') }}</a></li>
        <li><a href=""><i class="fa-solid fa-school"></i>{{ __('Courses') }}</a></li>
        <li><a href=""><i class="fa-solid fa-calendar-days"></i>{{ __('Events') }}</a></li>
        <li><a href="{{ route('store') }}"><i class="fa-solid fa-store"></i>{{ __('Store') }}</a></li>
    </ul>
</div>
