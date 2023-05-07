<x-layout title="{{ __('Create an account') }}">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/register.png') }}" alt="">
        </div>
        {{-- Register card --}}
        <div class="my-auto">
            <x-utils.card-grid>
                <form method="post" action="{{ route('user.store') }}" class="card-body">
                    @csrf
                    <p class="font-bold text-2xl text-center pb-4">{{ __('Create an account') }}</p>

                    <x-utils.input name="email" type="email" hint="Email" error="1" />
                    <x-utils.input name="name" type="text" hint="{{ __('Username') }}" error="1" />
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <x-utils.input name="password" type="password" hint="{{ __('Password') }}" error="0" />
                        <x-utils.input name="password_confirmation" type="password"
                            hint="{{ __('Password confirmation') }}" error="0" />
                    </div>
                    <x-utils.form-error name="password" />

                    {{-- CGU --}}
                    <p class="text-xs mb-2">{{ __("By continuing, i aknowledge that i've read and agree to the") }}
                        <a class="link hover:text-primary" href="#">{{ __('Privacy Policy') }}</a>
                        {{ __('of the') }}
                        <a class="link hover:text-primary" href="#">{{ __('Privacy Notice') }}</a>
                        {{ __("of Gourmet's Workshop when creating an account") }}
                    </p>

                    <button class="btn btn-primary mt-4">{{ __('Create an account') }}</button>
                    <div class="divider"></div>
                    <p class="text-center">
                        {{ __('Already have an account ?') }} <a href="{{ route('login') }}"
                            class="link hover:text-primary">{{ __('Log in') }}</a>
                    </p>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
</x-layout>
