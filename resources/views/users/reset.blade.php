<x-layout title="Reset password">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/forgot.png') }}" alt="">
        </div>
        {{-- Login card --}}
        <div class="my-auto">
            <x-utils.card-grid>
                <form method="post" action="{{ route('password.update') }}" class="card-body">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <p class="font-bold text-2xl text-center pb-4">{{ __('Forgot your password ?') }}</p>

                    <x-utils.input name="email" type="email" hint="Email" error="1" />
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                        <x-utils.input name="password" type="password" hint="Password" error="0" />
                        <x-utils.input name="password_confirmation" type="password" hint="Password confirmation"
                            error="0" />
                    </div>
                    <x-utils.form-error name="password" />

                    <button class="btn btn-primary mt-4">{{ __('Reset password') }}</button>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
</x-layout>
