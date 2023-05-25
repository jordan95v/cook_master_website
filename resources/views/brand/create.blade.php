<x-layout title="{{ __('Add a brand') }}">
    <div class="grid grid-cols-1 lg:grid-cols-2">
        <div class="my-auto">
            <x-utils.card-grid>
                <form action="{{ route('brand.store') }}" method="post" enctype="multipart/form-data" class="card-body">
                    @csrf
                    <h2 class="card-title justify-center flex text-2xl pb-2">{{ __('Add a brand') }}</h2>
                    {{-- Name --}}
                    <x-utils.input name="name" type="text" hint="Brand name" error="1" />

                    {{-- Image --}}
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text-alt">{{ __('Brand image') }} (1280x720)</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                    </div>

                    {{-- Website and contact email --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                        <x-utils.input name="website" type="text" hint="Brand website" error="0" />
                        <x-utils.input name="contact_email" type="email" hint="Brand email" error="0" />
                        <x-utils.form-error name="website" />
                        <x-utils.form-error name="contact_email" />
                    </div>

                    {{-- Description --}}
                    <textarea id="editor" class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                        name="description" placeholder="{{ __('Brand description') }}"></textarea>
                    <x-utils.form-error name="description" />

                    <textarea id="editor" class="textarea textarea-bordered" rows=4 name="description" placeholder="Brand description">{{ old('description') }}</textarea>
                    <x-utils.form-error name="description" />

                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">{{ __('Add a brand') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/add_brand.png') }}" alt="">
        </div>
    </div>
    <x-utils.editor />
</x-layout>
