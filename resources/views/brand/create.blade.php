@extends('admin-layout')

@section('title')
    Ajouter une marque
@endsection

@section('content')
    <div class="flex justify-center my-10">
        <div class="card lg:w-1/3 w-96 shadow-xl">
            <form action="{{ route('brand.store') }}" method="post" class="card-body">
                <h2 class="card-title justify-center flex text-2xl pb-2">Ajouter une marque</h2>
                {{-- Name --}}
                <x-input name="name" type="text" hint="Nom de la marque" error="1" />

                {{-- Image --}}
                <div class="form-control w-full">
                    <label class="label">
                        <span class="label-text-alt">Logo de la marque</span>
                    </label>
                    <input type="file" name="image" class="file-input file-input-bordered w-full" />
                </div>

                {{-- Website and contact email --}}
                <div class="grid lg:grid-cols-2 grid-cols-1 gap-2">
                    <x-input name="website" type="text" hint="Website" error="0" />
                    <x-input name="contact_email" type="email" hint="Contact email" error="0" />
                </div>
                <x-form-error name="website" />
                <x-form-error name="contact_email" />



                {{-- Description --}}
                <textarea class="textarea textarea-bordered" rows=4 placeholder="Description"></textarea>
                <x-form-error name="description" />

                <div class="card-actions justify-center">
                    <button class="btn btn-primary w-full">Créer la marque</button>
                </div>
            </form>
        </div>
    </div>
@endsection
