@extends('main_layout')

@section('title')
    {{ __('Edit') }} {{ $event->title }}
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/edit.png') }}" alt="">
        </div>
        <div class="col-span-2">
            <x-utils.card-grid>
                <form action="/events/{{ $event->id }}" method="POST" enctype="multipart/form-data" class="card-body">
                    @csrf
                    @method('put')
                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ __('Edit an event') }}</h2>
                    {{-- Name --}}
                    <x-utils.input type="text" name="title" hint="{{ __('Enter the name of the event') }}" error=1
                        :target="$event" />

                    {{-- Image --}}
                    <div class="form-control w-full pb-2">
                        <label class="label">
                            <span class="label-text-alt">{{ __('Event image') }}</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                        <label class="label">
                            <span class="label-text-alt">{{ __('Current image') }}</span>
                        </label>
                        <img src="{{ asset('storage/' . $event->image) }}" alt="" class="w-50 h-50">
                    </div>

                    {{-- Room & id organizator --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                        <select class="select select-bordered w-full max-w-xs" name="room_id">
                            <option disabled selected>{{ __('Choose the room') }}</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" @if ($room->id == $event->room_id) selected @endif>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="form-control">
                            <label class="input-group">
                                <x-utils.input type="text" name="user_id" hint="" error=0 :target="$event" />
                            </label>
                        </div>
                        <x-utils.form-error name="user_id" />
                    </div>

                    {{-- Description --}}
                    <textarea class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                        name="description" placeholder="{{ __('Description') }}">{{ $event->description }}</textarea>
                    <x-utils.form-error name="description" />

                    {{-- Capacity --}}
                    <x-utils.input type="number" name="capacity" hint="{{ __('Capacity') }}" error=1 :target="$event" />


                    {{-- Date --}}
                    <x-utils.input type="date" name="date" hint="" error=1 :target="$event" />
                    {{-- Range time --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                        {{-- Start time --}}
                        <select class="select select-bordered w-full max-w-xs" name="start_time" id="start-time">
                            <option disabled selected>{{ __('Choose the start time') }}</option>
                            <?php
                            for ($i = 0; $i <= 23; $i++) {
                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                echo "<option value=\"$hour:00\">$hour:00</option>";
                            }
                            ?>
                        </select>

                        {{-- End time --}}
                        <select class="select select-bordered w-full max-w-xs" name="end_time" id="end-time">
                            <option disabled selected>{{ __('Choose the end time') }}</option>
                        </select>
                    </div>


                    {{-- Submit --}}

                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">{{ __('Edit the event') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>

    <script>
        const startTimeInput = document.querySelector('select[name="start_time"]');
        const endTimeInput = document.querySelector('select[name="end_time"]');

        startTimeInput.addEventListener('change', () => {
            const startTime = startTimeInput.value;
            endTimeInput.innerHTML = '';
            for (let i = parseInt(startTime) + 1; i <= 23; i++) {
                const hour = String(i).padStart(2, '0');
                endTimeInput.innerHTML += `<option value="${hour}:00">${hour}:00</option>`;
            }
        });

        const form = document.querySelector('form');

        form.addEventListener('submit', (event) => {
            const startTime = startTimeInput.value;
            const endTime = endTimeInput.value;

            if (startTime >= endTime) {
                event.preventDefault();
                alert("L'heure de début doit être inférieure à l'heure de fin");
            }
        });
    </script>
@endsection
