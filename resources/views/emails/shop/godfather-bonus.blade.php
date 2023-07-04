<x-email-layout>
    <h1 class="text-2xl">{{ __('Godfather Bonus') }}</h1>
    <p>
        {{ __('Dear') }} <b>{{ $godfather->name }}</b>.<br>
        {{ __('Thanks to your godchildren') }}: <b>{{ $user->name }}</b>,
        {{ __('for his first command on the site, we have added a bonus of') }} {{ $amount }}
        {{ __('to your wallet.') }} !
    </p>
    <br>
    <p>
        {{ __("Please don't hesitate if you have any questions.") }}<br>
        {{ __('Kind regards') }},
    </p>
    <img src="{{ asset('images/logo2.png') }}" style="width: 100%">
</x-email-layout>
