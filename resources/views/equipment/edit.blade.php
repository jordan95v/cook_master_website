<x-layout title="{{ __('Edit') }} {{ $equipment->title }}">
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/edit.png') }}" alt="">
        </div>
        <div class="col-span-2">
            <x-utils.card-grid>
                <form action="/equipment/{{ $equipment->id }}" method="POST" enctype="multipart/form-data"
                    class="card-body">
                    @csrf
                    @method('put')
                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ __('Edit an equipement') }}</h2>

                    {{-- Name --}}
                    <x-utils.input type="text" name="title" hint="{{ __('Enter the name of the equipment') }}"
                        error=1 :target="$equipment" />

                    {{-- Image --}}
                    <div class="form-control w-full pb-2">
                        <label class="label">
                            <span class="label-text-alt">{{ __('Image') }} (1280x720)</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                        <label class="label">
                            <span class="label-text-alt">{{ __('Current image') }}</span>
                        </label>
                    </div>
                    <img src="{{ asset('storage/' . $equipment->image) }}" alt="" class="w-56">

                    {{-- Brand --}}
                    <select class="select select-bordered w-full" name="brand_id">
                        <option disabled>{{ __('Choose the product brand') }}</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}" @if ($brand->id == $equipment->brand->id) selected @endif>
                                {{ $brand->name }}
                            </option>
                        @endforeach
                    </select>


                    {{-- Description --}}
                    <textarea class="textarea textarea-bordered border-2 @error('description') border-error @enderror" rows=4
                        name="description" placeholder="{{ __('Description') }}">{{ $equipment->description }}</textarea>
                    <x-utils.form-error name="description" />

                    {{-- Submit --}}
                    <div class="justify-center card-actions">
                        <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
</x-layout>
