<x-layout title="Modifier {{ $product->name }}" admin=1>
    <x-utils.card>
        <form action="{{ route('product.update', ['product' => $product->id]) }}" method="post" class="card-body"
            enctype="multipart/form-data">
            @csrf
            @method('put')
            <h2 class="card-title text-2xl flex justify-center pb-2">Modifier un produit</h2>
            {{-- Name --}}
            <x-utils.input name="name" type="text" hint="Nom du produit" error=1 :target="$product" />

            {{-- Image --}}
            <div class="form-control w-full">
                <label class="label">
                    <span class="label-text-alt">Image du produit</span>
                </label>
                <input type="file" name="image"
                    class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                <x-utils.form-error name="image" />
                <label class="label">
                    <span class="label-text-alt">Image actuelle</span>
                </label>
                <img src="{{ asset('storage/' . $product->image) }}" alt="" class="w-28">
            </div>

            {{-- Brand and Price --}}
            <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                <select class="select select-bordered w-full max-w-xs" name="brand_id">
                    <option disabled>Choisissez la marque du produit</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" @if ($brand->id == $product->brand->id) selected @endif>
                            {{ $brand->name }}
                        </option>
                    @endforeach
                </select>

                <div class="form-control">
                    <label class="input-group">
                        <x-utils.input name="price" type="text" hint="9.99 (le prix quoi bouffon)" error=1
                            :target="$product" />
                        <span>€</span>
                    </label>
                </div>
            </div>

            {{-- Description --}}
            <textarea class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                name="description" placeholder="Description">{{ $product->description }}</textarea>
            <x-utils.form-error name="description" />

            <div class="card-actions justify-center">
                <button class="btn btn-primary w-full">Ajouter le produit</button>
            </div>
        </form>
    </x-utils.card>
</x-layout>
