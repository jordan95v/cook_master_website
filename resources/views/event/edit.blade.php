<x-layout title="{{ __('Edit') }} {{ $event->title }}">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/edit.png') }}" alt="">
        </div>
        <div class="my-auto">
            <x-utils.card-grid>
                <form action="{{ route('events.update', ['event' => $event->id]) }}" method="POST"
                    enctype="multipart/form-data" class="card-body">
                    @method('put')
                    @csrf
                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ _('Add an event') }}</h2>

                    {{-- Title --}}
                    <x-utils.input type="text" name="title" hint="{{ __('Enter the name of the event') }}" error=1
                        :target="$event" />

                    {{-- Image --}}
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text-alt">{{ __('Event image') }}</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                        <label class="label">
                            <span class="label-text-alt">{{ __('Current Image') }} (1280x720)</span>
                        </label>
                        <img src="{{ asset('storage/' . $event->image) }}" alt="" class="w-50 h-50">
                    </div>

                    {{-- Room --}}
                    <div class="grid grid-cols-1 @if (Auth::user()->isAdmin()) lg:grid-cols-2 @endif gap-2">
                        {{-- Capacity --}}
                        <x-utils.input type="number" name="capacity" hint="{{ __('Capacity') }}" error="1"
                            :target="$event" />

                        {{-- Organizer --}}
                        @if (Auth::user()->isAdmin())
                            <select class="select select-bordered w-full" name="user_id">
                                <option disabled>{{ __('Choose the Organizer') }}</option>
                                @foreach ($users as $user)
                                    <option value="{{ $user->id }}"
                                        @if ($user->id == $event->user->id) selected @endif>
                                        {{ $user->name }}</option>
                                @endforeach
                            </select>
                            <x-utils.form-error name="user_id" />
                        @endif
                    </div>

                    {{-- Room  --}}
                    <label class="label">
                        <span class="label-text-alt">{{ __('See all rooms') }}</span>
                        <i>
                            <a href="{{ route('room.index') }}" target="_blank"
                                class="fa-solid fa-up-right-from-square">
                            </a>
                        </i>
                    </label>
                    <select class="select select-bordered w-full" name="room_id">
                        <option disabled>{{ __('Choose the room') }}</option>
                        @foreach ($rooms as $room)
                            <option value="{{ $room->id }}" @if ($room->id == $event->room->id) selected @endif>
                                {{ $room->name }}</option>
                        @endforeach
                    </select>

                    {{-- Description --}}
                    <textarea id="editor" class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                        name="description" placeholder="{{ __('Product description') }}">{{ $event->description }}</textarea>
                    <x-utils.form-error name="description" />

                    <div class="divider"></div>

                    {{-- Date --}}
                    <x-utils.input type="date" name="date" hint="{{ __('Date') }}" error="1"
                        :target="$event" />

                    {{-- Range time --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                        {{-- Start time --}}
                        <select class="select select-bordered w-full max-w-xs" name="start_time" id="start-time">
                            <option disabled>{{ __('Choose the start time') }}</option>
                            @php
                                $old = explode(':', $event->start_time)[0];
                            @endphp
                            @foreach (range(0, 23) as $item)
                                <option value="{{ $item }}:00"
                                    @if ($item == $old) selected @endif>
                                    {{ $item }}:00
                            @endforeach
                        </select>
                        <x-utils.form-error name="start_time" />


                        {{-- End time --}}
                        <select class="select select-bordered w-full max-w-xs" name="end_time" id="end-time">
                            <option disabled selected>{{ __('Choose the end time') }}</option>
                            @php
                                $old = explode(':', $event->end_time)[0];
                            @endphp
                            @foreach (range(0, 23) as $item)
                                <option value="{{ $item }}:00"
                                    @if ($item == $old) selected @endif>
                                    {{ $item }}:00
                            @endforeach
                        </select>
                        <x-utils.form-error name="end_time" />
                    </div>

                    {{-- Submit --}}
                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full"> {{ __('Edit the event') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>

    {{-- <x-event.time /> --}}
    <x-utils.editor />
</x-layout>
