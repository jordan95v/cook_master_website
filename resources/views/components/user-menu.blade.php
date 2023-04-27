@auth
    {{-- Shopping cart --}}
    <div class="dropdown dropdown-bottom dropdown-end">
        <label tabindex="0" class="btn btn-ghost btn-circle me-2">
            <i class="fa-solid fa-cart-shopping text-xl"></i>
        </label>
        <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-96">
            <h2 class="text-center font-bold text-xl mb-4">Mes articles</h2>
            @if (Auth::user()->orders ?? false)
                @forelse (Auth::user()->orders as $item)
                    <x-shop.basket-card :item="$item" />
                @empty
                    <p class="text-center p-5">Vous n'avez pas d'articles dans votre panier</p>
                @endforelse
                @if (count(Auth::user()->orders) != 0)
                    <x-shop.basket-total />
                    <a class="btn btn-primary w-full" href="{{ route('order.show') }}">Payer</a>
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
                    src="{{ auth()->user()->image ?? false ? asset('storage/' . auth()->user()->image) : asset('images/user.png') }}" />
            </div>
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
                <li>
                    <a href="{{ route('user.edit') }}">
                        <i class="fa-sharp fa-solid fa-file-invoice-dollar"></i>Mes factures
                    </a>
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
