@auth
    {{-- Language dropdown --}}
    <div class="dropdown dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle me-2">
            <i class="fa-solid fa-earth-americas text-2xl"></i>
        </label>
        <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52 hover:border-primary">
            @php
                $languages = [
                    'en' => '🇺🇸 English',
                    'fr' => '🇫🇷 Français',
                    'es' => '🇪🇸 Español',
                    'kr' => '🇰🇷 한국어',
                ];
                $local = App::getLocale();
            @endphp
            @foreach ($languages as $key => $value)
                <li class="@if ($local == $key) disabled @endif">
                    <a href="{{ route('lang.update', ['lang' => $key]) }}">{{ $value }}</a>
                </li>
            @endforeach
        </ul>
    </div>


    {{-- Shopping cart --}}
    <div class="dropdown dropdown-bottom dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle me-4">
            <div class="indicator">
                <i class="fa-solid fa-cart-shopping text-2xl"></i>
                <span class="badge badge-sm indicator-item">
                    {{ Auth::user()->orders->sum('quantity') ?? 0 }}
                </span>
            </div>
        </label>
        <ul tabindex="0"
            class="menu menu-compact dropdown-content mt-3 p-2 border-2 shadow bg-base-100 rounded-box lg:w-96 w-72 hover:border-primary">
            <h2 class="text-center font-bold text-xl mb-4">{{ __('My basket.') }}</h2>
            @if (Auth::user()->orders ?? false)
                @forelse (Auth::user()->orders as $item)
                    <x-shop.basket-card :item="$item" />
                @empty
                    <p class="text-center p-5">{{ __('You have no product in your basket.') }}</p>
                @endforelse
                @if (count(Auth::user()->orders) != 0)
                    <x-shop.basket-total />
                    <a class="btn btn-primary w-full" href="{{ route('order.show') }}">{{ __('Payment') }}</a>
                @endif
            @endif
        </ul>
    </div>
@endauth

{{-- User menu --}}
<div class="dropdown dropdown-end">
    <label tabindex="0" class="btn btn-ghost btn-circle avatar @auth online @endauth">
        @auth
            <div class="w-24 rounded-full ring ring-primary">
                <img
                    src="{{ Auth::user()->image ?? false ? asset('storage/' . Auth::user()->image) : asset('images/user.png') }}" />
            </div>
        @else
            <i class="fa-solid fa-user text-xl"></i>
        @endauth
    </label>
    <ul tabindex="0"
        class="menu menu-compact dropdown-content mt-3 p-2 border-2 shadow bg-base-100 rounded-box w-56 hover:border-primary">
        @auth
            @if (!Auth::user()->email_verified_at)
                <li>
                    <a href="{{ route('verification.send') }}"><i class="fa-solid fa-share">
                        </i>{{ __('Resend the verification mail') }}</a>
                </li>
            @else
                <li>
                    <a href="{{ route('user.edit') }}"><i class="fa-solid fa-gear"></i>{{ __('Modify my profile') }}</a>
                </li>
                <li>
                    <a href="{{ route('user.invoices') }}">
                        <i class="fa-sharp fa-solid fa-file-invoice-dollar"></i>{{ __('My invoices') }}
                    </a>
                </li>
                <li>
                    <a href="{{ route('subscription.show') }}">
                        <i class="fa-sharp fa-solid fa-bolt-lightning"></i>
                        @if (Auth::user()->isSubscribed())
                            {{ __('Manage my subscription') }}
                        @else
                            {{ __('Subscribe') }}
                        @endif

                    </a>
                </li>
            @endif
            <li>
                <a href="{{ route('logout') }}">
                    <i class="fa-solid fa-arrow-right-to-bracket"></i>{{ __('Log out') }}
                </a>
            </li>
        @else
            <li>
                <a href="{{ route('show-login') }}">
                    <i class="fa-solid fa-arrow-up-from-bracket"></i>{{ __('Log in') }}
                </a>
            </li>
            <li>
                <a href="{{ route('register') }}">
                    <i class="fa-solid fa-database"></i>{{ __('Create an account') }}
                </a>
            </li>
        @endauth
    </ul>
</div>
