<x-email-layout>
    <h1 class="text-2xl">{{ __('Account changed') }}</h1>
    <p>
        {{ __('Dear') }} <b>{{ $user->name }}</b>.<br>
        {{ __('Your account has been changed.') }}<br>
        {{ __('If you did not change your account, please contact us.') }}<br>
        {{ __('Otherwise, you can ignore this message.') }}
    </p>
    <br>
    <p>
        {{ __("Please don't hesitate if you have any questions.") }}<br>
        {{ __('Kind regards') }},
    </p>
    <img src="{{ asset('images/logo2.png') }}" style="width: 100%">
</x-email-layout>
