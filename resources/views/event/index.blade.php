<x-layout title="{{ __('Events') }}">

    {{-- Filter --}}
    <div class="form-control lg:px-24 mt-10 px-10" id="search">
        <label class="cursor-pointer">
            <form action="{{ route('events.index') }}" id="search_form" class="flex items-center">
                <input type="checkbox" name="only_course" @if ($only_course) checked @endif
                    class="checkbox checkbox-primary" />
                <span class="label-text ms-2">{{ __('Only show courses or workshops') }}</span>
            </form>
        </label>
    </div>

    <div class="grid grid-cols-1 pt-10 p-5 lg:px-24 lg:grid-cols-3 md:grid-cols-2 gap-10">
        @foreach ($events as $event)
            <x-utils.card class="w-full">
                <div class="card-body p-0">
                    <a href="{{ route('events.show', ['event' => $event->id]) }}">
                        {{-- Image --}}
                        <img src="{{ asset('storage/' . $event->image) }}" alt="Photo de l'événement"
                            class="w-full h-full object-cover rounded-t">

                        <div class="p-4">
                            {{-- Title --}}
                            <h2 class="card-title text-2xl font-bold hover:link mb-6">{{ $event->title }}</h2>

                            <div class="flex flex-col">
                                {{-- Date --}}
                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <i class="w-4 h-4 mr-2 fa-solid fa-calendar-days"></i>
                                    {{ $event->date }}
                                </div>

                                {{-- Time --}}
                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <i class="w-4 h-4 mr-2 fa-regular fa-clock"></i>
                                    {{ $event->start_time }} - {{ $event->end_time }}
                                </div>

                                {{-- Location --}}
                                <div class="flex items-center text-gray-500 text-sm mb-2">
                                    <i class="w-4 h-4 mr-2 fa-sharp fa-solid fa-location-dot"></i>
                                    {{ __('Place') }} : {{ Str::limit($event->room->address, 30) }}
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            </x-utils.card>
        @endforeach
    </div>

    <div class="px-24 pt-5">
        {{ $events->links() }}
    </div>

    <script>
        let search = document.querySelector('#search');
        let search_form = document.querySelector('#search_form');

        search.addEventListener('click', () => {
            search_form.submit();
        });
    </script>
</x-layout>
