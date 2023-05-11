<x-layout title="{{ __('Log in') }}">
    <div class="grid grid-cols-1 md:grid-cols-2">
        {{-- Login card --}}
        <div class="my-auto">
            <x-utils.card-grid>
                <form method="post" action="{{ route('login') }}" class="card-body">
                    @csrf
                    <p class="font-bold text-2xl text-center pb-4">{{ __('Log in') }}</p>

                    <x-utils.input name="email" type="email" hint="Email" error="1" />
                    <x-utils.input name="password" type="password" hint="Password" error="1" />
                    <a href="#" class="text-sm link hover:text-primary">{{ __('Forgot your password ?') }}</a>

                    <button class="btn btn-primary mt-4">{{ __('Log in') }}</button>
                    <div class="divider"></div>
                    <p class="text-center">
                        {{ __('Not sign up yet ?') }}
                        <a href="{{ route('register') }}" class="link hover:text-primary">{{ __('Create an account') }}
                        </a>
                    </p>
                </form>
            </x-utils.card-grid>
        </div>
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/login.png') }}" alt="">
        </div>
    </div>
</x-layout>
