<x-email-layout>
    <h1 class="text-2xl">{{ __('Become a provider request') }}</h1>
    <p>
        {{ __('Email: ') }} {{ $email }}<br>
        {{ __('Phone number: ') }} {{ $phoneNumber }}<br>
        {{ __('Description: ') }} {{ $description }}
    </p>
    <br>
    <img src="{{ asset('images/logo2.png') }}" style="width: 100%">
</x-email-layout>
