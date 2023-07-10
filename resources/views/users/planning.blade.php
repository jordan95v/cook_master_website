<x-layout title="My planning" calendar=1>
    <div class="text-center">
        <x-user-stats />
    </div>
    @php
        $events = [];
        foreach (Auth::user()->participations as $participation) {
            $events[] = $participation->event;
        }
    @endphp
    <x-event.calendar :events="$events" class="lg:px-52 h-screen" />
</x-layout>
