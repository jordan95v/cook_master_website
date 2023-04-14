@extends('admin-layout')

@section('title')
    Modifier {{ $brand->name }}
@endsection

@section('content')
    <x-card>
        <form action="{{ route('brand.update', ['brand' => $brand->id]) }}" method="post" enctype="multipart/form-data"
            class="card-body">
            @csrf
            @method('put')
            <h2 class="card-title justify-center flex text-2xl pb-2">Modifier une marque</h2>
            {{-- Name --}}
            <x-input name="name" type="text" hint="Nom de la marque" :target="$brand" error="1" />

            {{-- Image --}}
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text-alt">Logo de la marque</span>
                </label>
                <input type="file" name="image" class="file-input file-input-bordered w-full mb-2" />
                <x-form-error name="image" />
                <label class="label">
                    <span class="label-text-alt">Logo actuelle</span>
                </label>
                <img src="{{ asset('storage/' . $brand->image) }}" alt="" class="w-28">
            </div>

            {{-- Website and contact email --}}
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-2">
                <x-input name="website" type="text" hint="Website" :target="$brand" error="0" />
                <x-input name="contact_email" type="email" hint="Contact email" :target="$brand" error="0" />
            </div>
            <x-form-error name="website" />
            <x-form-error name="contact_email" />

            {{-- Description --}}
            <textarea class="textarea textarea-bordered" rows=4 name="description" placeholder="Description">{{ $brand->description }}</textarea>
            <x-form-error name="description" />

            <div class="card-actions justify-center">
                <button class="btn btn-primary w-full">Modifier la marque</button>
            </div>
        </form>
    </x-card>
@endsection
