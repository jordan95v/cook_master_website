@props(['direction'])

{{-- User list --}}
<li><a href="{{ route('user.index') }}"><i class="fa-solid fa-user"></i>{{ __('Users list') }}</a></li>


{{-- Shop --}}
<li tabindex="0">
    <a>
        <i class="fa-brands fa-shopify"></i>
        {{ __('Store') }}
        <i class="fa-solid fa-chevron-{{ $direction }}"></i>
    </a>
    <ul class="p-2 z-10 bg-base-100 border-2 hover:border-primary">
        <li><a href="{{ route('product.create') }}">{{ __('Add a product') }}</a></li>
        <li><a href="{{ route('brand.create') }}">{{ __('Add a brand') }}</a></li>
        <li><a href="{{ route('product.index') }}">{{ __('Products list') }}</a></li>
        <li><a href="{{ route('brand.index') }}">{{ __('Brands list') }}</a></li>
    </ul>
</li>

{{-- Events --}}
<li tabindex="0">
    <a><i class="fa-solid fa-calendar-days"></i>{{ __('Events') }}<i
            class="fa-solid fa-chevron-{{ $direction }}"></i></a>
    <ul class="p-2 z-10 bg-base-100 border-2 hover:border-primary">
        <li><a href="{{ route('events.create') }}">{{ __('Add an event') }}</a></li>
        <li><a href="{{ route('events.index') }}">{{ __('Events list') }}</a></li>
    </ul>
</li>

{{-- Room and equipments --}}
<li tabindex="0">
    <a><i class="fa-solid fa-city"></i>{{ __('Rooms') }}<i class="fa-solid fa-chevron-{{ $direction }}"></i></a>
    <ul class="p-2 z-10 bg-base-100 border-2 hover:border-primary">
        <li><a href="{{ route('room.create') }}">{{ __('Add room') }}</a></li>
        <li><a href="{{ route('equipment.create') }}">{{ __('Add an equipment') }}</a></li>
        <li><a href="{{ route('room.index') }}">{{ __('Room list') }}</a></li>
        <li><a href="{{ route('equipment.index') }}">{{ __('Equipment list') }}</a></li>
    </ul>
</li>

{{-- Courses --}}
<li tabindex="0">
    <a>
        <i class="fa-solid fa-chalkboard-user"></i>
        {{ __('Courses') }}
        <i class="fa-solid fa-chevron-{{ $direction }}"></i></a>
    <ul class="p-2 z-10 bg-base-100 border-2 hover:border-primary">
        <li><a>{{ __('Add a course') }}</a></li>
        <li><a>{{ __('Courses list') }}</a></li>
    </ul>
</li>
