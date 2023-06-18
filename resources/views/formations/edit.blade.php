<x-layout title="{{ __('Create a formation') }}">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="my-auto">
            <x-utils.card-grid>
                <form action="{{ route('formation.update', $formation) }}" method="POST" enctype="multipart/form-data"
                    class="card-body">
                    @method('PUT')
                    @csrf
                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ __('Add formation') }}</h2>

                    {{-- Name --}}
                    <x-utils.input type="text" name="name" hint="{{ __('Enter the name of the formation') }}" error=1
                        :target="$formation" />

                    {{-- Image --}}
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text-alt">{{ __('Image') }} (1280x720)</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                        <label class="label">
                            <span class="label-text-alt">{{ __('Current Image') }} (1280x720)</span>
                        </label>
                        <img src="{{ asset('storage/' . $formation->image) }}" alt="" class="w-50 h-50">
                    </div>

                    {{-- Description --}}
                    <textarea id="editor" class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                        name="description" placeholder="{{ __('Product description') }}">{{ $formation->description }}</textarea>
                    <x-utils.form-error name="description" />


                    {{-- Submit --}}
                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">{{ __('Modify') }}</button>
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
