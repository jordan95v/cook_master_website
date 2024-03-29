<div class="dropdown">
    <label tabindex="0" class="btn btn-ghost btn-circle">
        <i class="fa-solid fa-bars-staggered text-xl"></i>
    </label>
    <ul tabindex="0" class="menu menu-compact dropdown-content border-2 mt-3 p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href="/"><i class="fa-solid fa-house"></i>{{ __('Home') }}</a></li>
        <li><a href="{{ route('courses.all') }}"><i class="fa-solid fa-school"></i>{{ __('Courses') }}</a></li>
        <li>
            <a href="{{ route('reservation.create') }}">
                <i class="fa-solid fa-face-smile"></i>{{ __('Course at home') }}
            </a>
        </li>
        <li><a href="{{ route('events.index') }}"><i class="fa-solid fa-calendar-days"></i>{{ __('Events') }}</a></li>
        <li><a href="{{ route('store') }}"><i class="fa-solid fa-store"></i>{{ __('Store') }}</a></li>
        <li>
            <a href="{{ route('formation.index') }}">
                <i class="fa-solid fa-chalkboard-user"></i>{{ __('Formations') }}
            </a>
        </li>

        @if (Auth::user()->is_service_provider ?? false)
            <li tabindex="0">
                <a>
                    <i class="fa-brands fa-shopify"></i>
                    {{ __('Prestations') }}
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
                <ul class="p-2 z-10 bg-base-100 border-2 hover:border-primary">
                    <li><a href="{{ route('courses.create') }}">{{ __('Add a course') }}</a></li>
                    <li><a href="{{ route('formation.create') }}">{{ __('Add a formation') }}</a></li>
                    <li><a href="{{ route('courses.index') }}">{{ __('Courses list') }}</a></li>
                    <li><a href="{{ route('formation.list') }}">{{ __('Formations list') }}</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>
