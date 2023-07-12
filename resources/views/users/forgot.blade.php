<x-layout title="Forgot password">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/forgot.png') }}" alt="">
        </div>
        {{-- Login card --}}
        <div class="my-auto">
            <x-utils.card-grid>
                <form method="post" action="{{ route('password.email') }}" class="card-body">
                    @csrf
                    <p class="font-bold text-2xl text-center pb-4">{{ __('Forgot your password ?') }}</p>

                    <x-utils.input name="email" type="email" hint="Email" error="1" />

                    <button class="btn btn-primary mt-4">{{ __('Send password reset link') }}</button>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
</x-layout>
