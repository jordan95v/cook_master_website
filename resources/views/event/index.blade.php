@php
    // Do a dictionnary containing filter and their value in the url
    $sorts = [
        'new' => __('Newest'),
        'coming' => __('Coming soon'),
    ];
@endphp

<x-layout title="{{ __('Events') }}">
    <div class="lg:p-5 mb-5">
        <img src="{{ asset('images/event_banner.jpg') }}" alt=""
            class="rounded-xl max-h-56 object-cover object-bottom w-full">
    </div>
    <form action="{{ route('events.index') }}" method="get" class="flex justify-center">
        <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
            <input type="text" name="search" placeholder="{{ __('Search ...') }}"
                class="input input-bordered w-full max-w-xs" value="{{ old('search') }}">
            <select class="select select-bordered w-full max-w-xs" name="filter">
                <option disabled selected>{{ __('Sort by') }} </option>
                @foreach ($sorts as $key => $sort)
                    <option value="{{ $key }}" @if ($filter == $key) selected @endif>
                        {{ $sort }}
                    </option>
                @endforeach
            </select>
            <div class="flex items-center">
                <input type="checkbox" name="only_course" @if ($only_course) checked @endif
                    class="checkbox checkbox-primary" />
                <span class="label-text ms-2">{{ __('Only show courses or workshops') }}</span>
            </div>
            <button type="submit" class="btn btn-neutral hover:btn-primary">{{ __('Filter') }}</button>
        </div>
    </form>


    {{-- Filter --}}
    <div class="form-control lg:px-24 mt-10 px-10" id="search">
        <label class="cursor-pointer">
            <form action="{{ route('events.index') }}" id="search_form" class="flex items-center">
            </form>
        </label>
    </div>

    <div class="grid grid-cols-1 pt-10 p-5 lg:px-24 lg:grid-cols-3 md:grid-cols-2 gap-10">
        @foreach ($events as $event)
            <a href="{{ route('events.show', $event) }}">
                <x-utils.card class="w-full">
                    {{-- Image --}}
                    <img src="{{ asset('storage/' . $event->image) }}" class="w-full h-full object-cover rounded-t">
                    <div class="card-body p-0">
                        <div class="p-4">
                            {{-- Title --}}
                            <h2 class="card-title hover:link mb-6">{{ $event->title }}</h2>

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
                    </div>
                </x-utils.card>
            </a>
        @endforeach
    </div>

    <div class="px-24 pt-5">
        {{ $events->links() }}
    </div>
</x-layout>
