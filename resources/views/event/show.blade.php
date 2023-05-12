<x-layout title="{{ __('Event') }}">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 sm:px-10 py-10 lg:px-24">
        <img src="{{ asset('storage/' . $event->image) }}" class="w-full object-cover object-center rounded-md">
        <div class="mx-auto my-auto text-center">
            <h2 class="text-4xl font-bold my-4">{{ $event->title }}</h2>

            {{-- Button to subscribe to the event --}}
            @if (Auth::check())
                {{-- Check if the user is already subscribed to the event --}}
                @if (in_array(Auth::user()->id, $participants))
                    <form action="{{ route('event.unsubscribe', ['event' => $event->id]) }}" method="POST">
                        @csrf
                        <button type="submit"
                            class=" text-white py-2 px-4 rounded-md inline-block font-medium text-md btn">
                            {{ __('Unsubscribe') }}</button>
                    </form>
                @else
                    @if (count($participants) >= $event->capacity)
                        <p class="text-red-500">{{ __('This event is full') }}</p>
                    @else
                        <form action="{{ route('event.subscribe', ['event' => $event->id]) }}" method="POST">
                            @csrf
                            <button type="submit"
                                class="text-white py-2 px-4 rounded-md inline-block font-medium text-md btn">{{ __('Subscribe') }}</button>
                        </form>
                    @endif
                @endif
            @endif
            <div class="pt-10 space-y-2">
                <a href="{{ route('events.edit', ['event' => $event->id]) }}" class="btn btn-primary max-w-sm w-full">
                    <i class="fa-solid fa-edit me-2"></i>{{ __('Modify') }}
                </a>
                <form method="POST" action="{{ route('events.destroy', ['event' => $event->id]) }}">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-error max-w-sm w-full">
                        <i class="fa-solid fa-trash me-2"></i>{{ __('Delete') }}
                    </button>
                </form>
            </div>
        </div>
    </div>

    {{-- Information about the event --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 bg-gray-200 px-10 lg:px-24 py-10">
        <div>
            <h3 class="text-4xl font-bold pb-10">{{ __('Informations about the event') }}</h3>
            {!! $event->description !!}
            <div class="pt-10">
                <p class="text-gray-500">
                    <i class="text-purple-500 fa-solid fa-calendar-days me-2"></i>
                    {{ __('Date') }} : {{ $event->date }}
                </p>
                <p class="text-gray-500">
                    <i class="text-purple-500 fa-regular fa-clock me-1"></i>
                    {{ __('Schedule') }} : {{ $event->start_time }}-{{ $event->end_time }}
                </p>
                <p class="text-gray-500">
                    <i class="text-purple-500 fa-sharp fa-solid fa-location-dot me-2"></i>
                    {{ __('Place') }} : {{ $event->room->address }}
                </p>
                <p class="text-gray-500">
                    <i class="text-purple-500 fa-sharp fa-solid fa-person me-2"></i>
                    {{ __('Organizer') }} : {{ $event->user->name }}
                </p>
            </div>
        </div>

        {{-- Participants --}}
        <div>
            <h3 class="text-2xl font-bold my-3">{{ __('Participants') }} : {{ count($participants) }} /
                {{ $event->capacity }}</h3>
            <div class="overflow-auto ">
                <ul>
                    @foreach ($participant as $member)
                        <div class="flex items-center gap-4 p-4">
                            <img src="{{ Auth::user()->image ?? false ? asset('storage/' . Auth::user()->image) : asset('images/user.png') }}"
                                alt="Photo de profil de l'organisateur"
                                class="w-12 h-12 rounded-full object-cover object-center">
                            <p class="text-lg">{{ $member->name }}</p>
                        </div>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>

    {{-- Room information --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-10 p-5 lg:px-24 pb-10">
        <div>
            <h3 class="text-3xl lg:text-5xl font-bold my-3">{{ $event->room->name }}</h3>
            <p class="text-lg font-medium my-3">
                <i class="fa-solid fa-location-dot me-2"></i>{{ $event->room->address }}
            </p>
            <img src="{{ asset('storage/' . $event->room->image) }}" alt="Photo de la salle"
                class="w-full object-cover object-center rounded-md">
        </div>
        <div>
            <iframe
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2625.4753698334275!2d2.3870841771139757!3d48.849144971330794!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47e6727347e25d67%3A0xc73e22c1131584f7!2s242%20Rue%20du%20Faubourg%20Saint-Antoine%2C%2075012%20Paris!5e0!3m2!1sfr!2sfr!4v1683577263610!5m2!1sfr!2sfr"
                class="w-full h-full my-auto" style="border:0;" allowfullscreen="" loading="lazy"
                referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </div>
</x-layout>
