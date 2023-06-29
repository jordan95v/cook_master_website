<div class="dropdown">
    <label tabindex="0" class="btn btn-ghost btn-circle">
        <i class="fa-solid fa-bars-staggered text-xl"></i>
    </label>
    <ul tabindex="0" class="menu menu-compact dropdown-content border-2 mt-3 p-2 shadow bg-base-100 rounded-box w-52">
        <li><a href="/"><i class="fa-solid fa-house"></i>{{ __('Home') }}</a></li>
        <li><a href=""><i class="fa-solid fa-school"></i>{{ __('Courses') }}</a></li>
        <li>
            <a href="{{ route('reservation.create') }}">
                <i class="fa-solid fa-face-smile"></i>{{ __('Course at home') }}
            </a>
        </li>
        <li><a href="{{ route('events.index') }}"><i class="fa-solid fa-calendar-days"></i>{{ __('Events') }}</a></li>
        <li><a href="{{ route('store') }}"><i class="fa-solid fa-store"></i>{{ __('Store') }}</a></li>
        @if (Auth::user()->is_service_provider ?? false)
            <li tabindex="0">
                <a>
                    <i class="fa-brands fa-shopify"></i>
                    {{ __('Prestations') }}
                    <i class="fa-solid fa-chevron-right"></i>
                </a>
                <ul class="p-2 z-10 bg-base-100 border-2 hover:border-primary">
                    <li><a href="{{ route('product.create') }}">{{ __('Add a product') }}</a></li>
                    <li><a href="{{ route('brand.create') }}">{{ __('Add a brand') }}</a></li>
                    <li><a href="{{ route('events.create') }}">{{ __('Add an event') }}</a></li>
                    <li><a href="{{ route('product.index') }}">{{ __('Products list') }}</a></li>
                    <li><a href="{{ route('brand.index') }}">{{ __('Brands list') }}</a></li>
                    <li><a href="{{ route('events.listing') }}">{{ __('Events list') }}</a></li>
                </ul>
            </li>
        @endif
    </ul>
</div>
