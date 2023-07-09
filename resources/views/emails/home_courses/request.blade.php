<x-email-layout>
    <h1 class="text-2xl">{{ __('Home course request') }}</h1>
    <p>
        {{ __('Dear') }} <b>{{ $user->name }}</b>.<br>
        {{ __('Your home course request') }} {{ $reservation->title }}
        {{ __('for the') }} {{ $reservation->date }}
        {{ __('has been') }} {{ __($status) }}.
    </p>
    <br>
    <p>
        {{ __("Please don't hesitate if you have any questions.") }}<br>
        {{ __('Kind regards') }},
    </p>
    <img src="{{ asset('images/logo2.png') }}" style="width: 100%">
</x-email-layout>
