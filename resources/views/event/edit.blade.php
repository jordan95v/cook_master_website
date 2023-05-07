@extends('main_layout')

@section('title')
    Modifier {{ $event->title }}
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
                    <h2 class="card-title text-2xl flex justify-center pb-2">Modifier un événement</h2>
                    {{-- Name --}}
                    <x-utils.input type="text" name="title" hint="Saisissez le titre de votre événement" error=1
                        :target="$event" />

                    {{-- Image --}}
                    <div class="form-control w-full pb-2">
                        <label class="label">
                            <span class="label-text-alt">Image de l'événement</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                        <label class="label">
                            <span class="label-text-alt">Image actuelle</span>
                        </label>
                        <img src="{{ asset('storage/' . $event->image) }}" alt="" class="w-50 h-50">
                    </div>

                    {{-- Room & id organizator --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                        <select class="select select-bordered w-full max-w-xs" name="room_id">
                            <option disabled selected>Choisissez la salle</option>
                            @foreach ($rooms as $room)
                                <option value="{{ $room->id }}" @if ($room->id == $event->room_id) selected @endif>
                                    {{ $room->name }}
                                </option>
                            @endforeach
                        </select>

                        <div class="form-control">
                            <label class="input-group">
                                <x-utils.input type="text" name="user_id" hint="Saisissez l'id' de l'organisateur"
                                    error=0 :target="$event" />
                            </label>
                        </div>
                        <x-utils.form-error name="user_id" />
                    </div>

                    {{-- Description --}}
                    <textarea class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                        name="description" placeholder="Description">{{ $event->description }}</textarea>
                    <x-utils.form-error name="description" />

                    {{-- Capacity --}}
                    <x-utils.input type="number" name="capacity" hint="Saisissez la capacité de la salle" error=1
                        :target="$event" />


                    {{-- Date --}}
                    <x-utils.input type="date" name="date" hint="Saisissez la date de l'événement" error=1
                        :target="$event" />
                    {{-- Start Time --}}
                    <x-utils.input type="time" name="start_time" hint="Saisissez l'heure de début de l'événement" error=1
                        :target="$event" />
                    {{-- End Time --}}
                    <x-utils.input type="time" name="end_time" hint="Saisissez l'heure de fin de l'événement" error=1
                        :target="$event" />


                    {{-- Submit --}}

                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">Modifier l'événement</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
@endsection
