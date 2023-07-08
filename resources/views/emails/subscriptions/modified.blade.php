<x-email-layout>
    <h1 class="text-2xl">{{ __('Subscription modified') }}</h1>
    <p>
        {{ __('Dear') }} <b>{{ $user->name }}</b>.<br>
        {{ __('Your subscription has been') }} {{ __($status) }}<br>.
    </p>
    <br>
    <p>
        {{ __("Please don't hesitate if you have any questions.") }}<br>
        {{ __('Kind regards') }},
    </p>
    <img src="{{ asset('images/logo2.png') }}" style="width: 100%">
</x-email-layout>
