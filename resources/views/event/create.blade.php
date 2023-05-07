@extends('main_layout')

@section('title')
    Créer un Evenement
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/event_create.png') }}" alt="">
        </div>
        <div class="col-span-2">
            <x-utils.card-grid>
                <form action="/events"method="POST" enctype="multipart/form-data" class="card-body">
                    @csrf
                    <h2 class="card-title text-2xl flex justify-center pb-2">Ajouter un événement</h2>
                    {{-- Title --}}
                    <x-utils.input type="text" name="title" hint="Saisissez le titre de votre événement" error=1 />

                    {{-- Image --}}
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text-alt">Image de l'événement</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                    </div>

                    {{-- Room  --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                        <select class="select select-bordered w-full max-w-xs" name="room_id">
                            <option disabled selected>Choisissez la salle</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>

                        {{-- Organizer --}}
                        <div class="form-control">
                            <label class="input-group">
                                <input class="input input-bordered border-2" type="text" name="user_id"
                                    placeholder="{{ auth()->user()->name }}" value="{{ auth()->user()->id }}" readonly />
                            </label>
                        </div>
                        <x-utils.form-error name="user_id" />
                    </div>

                    {{-- Description --}}
                    <textarea class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                        name="description" placeholder="Description"></textarea>
                    <x-utils.form-error name="description" />

                    {{-- Date --}}
                    <x-utils.input type="date" name="date" hint="date" error="1" />

                    {{-- Range time --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                        {{-- Start time --}}
                        <select class="select select-bordered w-full max-w-xs" name="start_time" id="start-time">
                            <option disabled selected>Choisissez l'heure de début</option>
                            <?php
                            for ($i = 0; $i <= 23; $i++) {
                                $hour = str_pad($i, 2, '0', STR_PAD_LEFT);
                                echo "<option value=\"$hour:00\">$hour:00</option>";
                            }
                            ?>
                        </select>

                        {{-- End time --}}
                        <select class="select select-bordered w-full max-w-xs" name="end_time" id="end-time">
                            <option disabled selected>Choisissez l'heure de fin</option>
                        </select>
                    </div>


                    {{-- Submit --}}
                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full"> Ajouter l 'événement</button>
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
