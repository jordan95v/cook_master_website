@props(['direction'])

{{-- Main --}}
<li tabindex="0">
    <a>
        <i class="fa-solid fa-house"></i>
        {{ __('Home') }}
        <i class="fa-solid fa-chevron-{{ $direction }}"></i>
    </a>
    <ul class="p-2 z-10 bg-base-100 border-2 hover:border-primary">
        <li><a href=""><i class="fa-solid fa-school"></i>{{ __('Courses') }}</a></li>
        <li><a href=""><i class="fa-solid fa-calendar-days"></i>{{ __('Events') }}</a></li>
        <li><a href="/store"><i class="fa-solid fa-store"></i>{{ __('Store') }}</a></li>
    </ul>
</li>


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
        <li><a>{{ __('Add an event') }}</a></li>
        <li><a>{{ __('Events list') }}</a></li>
    </ul>
</li>

<li tabindex="0">
    <a>
        <i class="fa-solid fa-kitchen-set"></i></i>
        {{ __('Workshops') }}
        <i class="fa-solid fa-chevron-{{ $direction }}"></i>
    </a>
    <ul class="p-2 z-10 bg-base-100 border-2 hover:border-primary">
        <li><a>{{ __('Add a workshop') }}</a></li>
        <li><a>{{ __('Workshops list') }}</a></li>
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