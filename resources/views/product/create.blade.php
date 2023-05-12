<x-layout title="{{ __('Add a product') }} ">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/add_product.png') }}" alt="">
        </div>
        <div class="my-auto">
            <x-utils.card-grid>
                <form action="{{ route('product.store') }}" method="post" class="card-body" enctype="multipart/form-data">
                    @csrf
                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ __('Add a product') }}</h2>
                    {{-- Name --}}
                    <x-utils.input name="name" type="text" hint="Product name" error=1 />

                    {{-- Image --}}
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text-alt">{{ __('Product image') }} (1280x720)</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                    </div>

                    {{-- Brand and Price --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                        <select class="select select-bordered w-full max-w-xs" name="brand_id">
                            <option disabled selected>{{ __('Choose the product brand') }}</option>
                            @foreach ($brands as $brand)
                                <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                            @endforeach
                        </select>

                        <div class="form-control">
                            <label class="input-group">
                                <x-utils.input name="price" type="text" hint="9.99 - Product price" error=0 />
                                <span>€</span>
                            </label>
                        </div>
                        <x-utils.form-error name="price" />
                    </div>

                    {{-- Description --}}
                    <textarea id="editor" class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                        name="description" placeholder="{{ __('Product description') }}">{{ old('description') }}</textarea>
                    <x-utils.form-error name="description" />

                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">{{ __('Add the product') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
    <x-utils.editor />
</x-layout>
