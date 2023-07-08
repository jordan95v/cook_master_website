<x-email-layout>
    <h1 class="text-2xl">{{ __('Thank you for your subscription') }}</h1>
    <p>
        {{ __('Dear') }} <b>{{ $user->name }}</b>.<br>
        {{ __('Thanks you for your subscription.') }}<br>
        {{ __("We hope you'll enjoy our services.") }}<br>
    </p>
    <br>
    <p>
        {{ __("Please don't hesitate if you have any questions.") }}<br>
        {{ __('Kind regards') }},
    </p>
    <img src="{{ asset('images/logo2.png') }}" style="width: 100%">
</x-email-layout>
