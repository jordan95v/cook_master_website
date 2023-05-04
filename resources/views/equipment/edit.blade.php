@extends('main_layout')

@section('title')
    Modifier {{ $equipment->title }}
@endsection

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/edit.png') }}" alt="">
        </div>
        <div class="col-span-2">
            <x-utils.card-grid>
                <form action="/equipment/{{ $equipment->id }}" method="POST" enctype="multipart/form-data" class="card-body">
                    @csrf
                    @method('put')
                    <h2 class="card-title text-2xl flex justify-center pb-2">Modifier un événement</h2>
                    {{-- Name --}}
                    <x-utils.input type="text" name="title" hint="Saisissez le titre de votre événement" error=1
                        :target="$equipment" />

                    {{-- Image --}}
                    <div class="form-control w-full pb-2">
                        <label class="label">
                            <span class="label-text-alt">Image de l'équipement</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                        <label class="label">
                            <span class="label-text-alt">Image actuelle</span>
                        </label>
                        <img src="{{ asset('storage/' . $equipment->image) }}" alt="" class="w-50 h-50">
                    </div>
                    {{-- Brand --}}
                    <x-utils.input type="text" name="brand" hint="Saisissez la marque de l'équipement" error=1
                        :target="$equipment" />
                    {{-- Description --}}
                    <textarea class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                        name="description" placeholder="Description">{{ $equipment->description }}</textarea>
                    <x-utils.form-error name="description" />
                    {{-- Submit --}}
                    <div class="justify-center card-actions">
                        <button type="submit" class="btn btn-primary">Modifier</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
@endsection
