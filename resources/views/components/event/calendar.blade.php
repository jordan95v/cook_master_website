@props(['events'])

@foreach ($events as $event)
    <x-event.modal :event="$event" />
@endforeach

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let allEvents = [];
        @foreach ($events as $event)
            allEvents.push({
                id: '{{ $event->id }}',
                title: '{{ $event->title }}',
                start: '{{ $event->start() }}',
                end: '{{ $event->end() }}',
            });
        @endforeach

        var calendarEl = document.getElementById('calendar');
        var calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'timeGridDay',
            events: allEvents,
            eventClick: function(info) {
                document.querySelector(`#modal-${info.event.id}`).checked = true;
            },
            headerToolbar: {
                left: 'prev,next',
                center: 'title',
                right: window.innerWidth < 640 ? 'timeGridDay' : 'timeGridDay,timeGridWeek,dayGridMonth'
            }
        });
        calendar.setOption('locale', '{{ App::getLocale() }}');
        calendar.render();
    });
</script>

<div id='calendar' {{ $attributes->merge(['class' => 'pt-10']) }}></div>
