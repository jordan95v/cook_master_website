{{-- Shopping cart --}}
<div class="dropdown dropdown-bottom dropdown-end">
    <label tabindex="0" class="btn btn-ghost btn-circle me-2">
        <i class="fa-solid fa-cart-shopping text-xl"></i>
    </label>
    <ul tabindex="0" class="menu menu-compact dropdown-content mt-3 p-2 shadow bg-base-100 rounded-box w-96">
        <h2 class="text-center font-bold text-xl mb-4">Mes articles</h2>
        {{-- Insert content here --}}
        @foreach (Auth::user()->orders as $item)
            <div class="flex mb-4 rounded-xl border-2 hover:border-primary p-2">
                <img src="{{ asset('storage/' . $item->product->image) }}" alt="" class="w-1/4 rounded">
                <div class="flex-col ms-2 w-2/4">
                    <p class="hover:link font-bold">{{ $item->product->name }}</p>
                    <p class="text-start italic">€{{ $item->product->price }}</p>
                    <p class="mt-5">Quantité: {{ $item->quantity }}</p>
                </div>
                <div class="w-1/4 text-end">
                    {{-- Add more quantity --}}
                    <form action="{{ route('order.create', ['product' => $item->product->id]) }}" method="post">
                        @csrf
                        <button class="btn btn-circle btn-primary btn-sm"><i class="fa-solid fa-plus"></i></button>
                    </form>

                    {{-- Delete the order --}}
                    <form action="{{ route('order.destroy', ['order' => $item->id]) }}" method="post" class="mt-4">
                        @csrf
                        <button class="btn btn-circle btn-error btn-sm"><i class="fa-solid fa-trash"></i></button>
                    </form>
                </div>
            </div>
        @endforeach
    </ul>
</div>

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
