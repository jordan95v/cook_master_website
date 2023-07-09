<x-email-layout>
    <h1 class="text-2xl">{{ __('Event is starting soon') }}</h1>
    <p>
        {{ __('Dear') }} member.<br>
        {{ __('You registered for the event') }} {{ $event->title }}.<br>
        {{ __('The event is starting at') }} {{ $event->start_time }}.
    </p>
    <br>
    <p>
        {{ __("Please don't hesitate if you have any questions.") }}<br>
        {{ __('Kind regards') }},
    </p>
    <img src="{{ asset('images/logo2.png') }}" style="width: 100%">
</x-email-layout>
