<x-email-layout>
    <h1 class="text-2xl">{{ __('Account restriction') }}</h1>
    <p>
        {{ __('Dear') }} <b>{{ $user->name }}</b>.<br>
        {{ __('Your account have been') }} {{ __($status) }}.<br>
        @if ($status == 'banned')
            {{ __('If you think this is a mistake, please contact us.') }}<br>
        @endif
    </p>
    <br>
    <p>
        {{ __("Please don't hesitate if you have any questions.") }}<br>
        {{ __('Kind regards') }},
    </p>
    <img src="{{ asset('images/logo2.png') }}" style="width: 100%">
</x-email-layout>
