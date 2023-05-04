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

                    {{-- Room & id organizator --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                        <select class="select select-bordered w-full max-w-xs" name="room_id">
                            <option disabled selected>Choisissez la salle</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}">{{ $room->name }}</option>
                            @endforeach
                        </select>

                        <div class="form-control">
                            <label class="input-group">
                                <x-utils.input type="text" name="user_id" hint="Saisissez l'id' de l'organisateur"
                                    error=0 />
                            </label>
                        </div>
                        <x-utils.form-error name="user_id" />
                    </div>

                    {{-- Description --}}
                    <textarea class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                        name="description" placeholder="Description"></textarea>
                    <x-utils.form-error name="description" />

                    {{-- Date --}}
                    <x-utils.input type="date" name="date" hint="date" class="input input-bordered my-3"
                        error="1" />
                    {{-- Start time --}}
                    <x-utils.input type="time" name="start_time" hint="heure de début" class="input input-bordered my-3"
                        error="1" />
                    {{-- End time --}}
                    <x-utils.input type="time" name="end_time" hint="heure de fin" class="input input-bordered my-3"
                        error="1" />

                    {{-- Submit --}}
                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">Ajouter l'événement</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
@endsection
