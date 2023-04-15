<x-layout title="Ajouter une marque" admin=1>
    <x-card>
        <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data" class="card-body">
            @csrf
            <h2 class="card-title justify-center flex text-2xl pb-2">Ajouter une marque</h2>
            {{-- Name --}}
            <x-input name="name" type="text" hint="Nom de la marque" error="1" />

            {{-- Image --}}
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text-alt">Logo de la marque</span>
                </label>
                <input type="file" name="image"
                    class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                <x-form-error name="image" />
            </div>

            {{-- Website and contact email --}}
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-2">
                <x-input name="website" type="text" hint="Website" error="0" />
                <x-input name="contact_email" type="email" hint="Contact email" error="0" />
                <x-form-error name="website" />
                <x-form-error name="contact_email" />
            </div>

            {{-- Description --}}
            <textarea class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                name="description" placeholder="Description"></textarea>
            <x-form-error name="description" />

            <div class="card-actions justify-center">
                <button class="btn btn-primary w-full">Créer la marque</button>
            </div>
        </form>
    </x-card>
</x-layout>
