<x-layout title="{{ __('Modifier') }} {{ $brand->name }}">
    <div class="grid grid-cols-1 lg:grid-cols-2">
        <div class="my-auto">
            <x-utils.card-grid>
                <form action="{{ route('brand.update', ['brand' => $brand->id]) }}" method="post"
                    enctype="multipart/form-data" class="card-body">
                    @csrf
                    @method('put')
                    <h2 class="card-title justify-center flex text-2xl pb-2">{{ __('Modify a brand') }}</h2>
                    {{-- Name --}}
                    <x-utils.input name="name" type="text" hint="Brand name" :target="$brand" error="1" />

                    {{-- Image --}}
                    <div class="form-control w-full pb-2">
                        <label class="label">
                            <span class="label-text-alt">{{ __('Brand image') }}</span>
                        </label>
                        <input type="file" name="image" class="file-input file-input-bordered w-full mb-2" />
                        <x-utils.form-error name="image" />
                        <label class="label">
                            <span class="label-text-alt">{{ __('Actual image') }}</span>
                        </label>
                        <img src="{{ asset('storage/' . $brand->image) }}" alt="" class="w-56">
                    </div>

                    {{-- Website and contact email --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2">
                        <x-utils.input name="website" type="text" hint="Brand website" :target="$brand"
                            error="0" />
                        <x-utils.input name="contact_email" type="email" hint="Brand email" :target="$brand"
                            error="0" />
                    </div>
                    <x-utils.form-error name="website" />
                    <x-utils.form-error name="contact_email" />

                    {{-- Description --}}
                    <textarea id="editor" class="textarea textarea-bordered" rows=4 name="description" placeholder="Brand description">{{ $brand->description }}</textarea>
                    <x-utils.form-error name="description" />

                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">{{ __('Modify the brand') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/modify.png') }}" alt="">
        </div>
    </div>
    <x-utils.editor />
</x-layout>
