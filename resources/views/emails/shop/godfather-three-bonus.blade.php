<x-email-layout>
    <h1 class="text-2xl">{{ __('Godfather Bonus') }}</h1>
    <p>
        {{ __('Dear') }} <b>{{ $user->name }}</b>.<br>
        {{ __('Thanks to your godchildrens, you earned a bonus of:') }} 5€ !
    </p>
    <br>
    <p>
        {{ __("Please don't hesitate if you have any questions.") }}<br>
        {{ __('Kind regards') }},
    </p>
    <img src="{{ asset('images/logo2.png') }}" style="width: 100%">
</x-email-layout>
