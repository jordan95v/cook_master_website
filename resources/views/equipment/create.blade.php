<x-layout title="{{ __('Add an equipment') }} ">
    <div class="grid grid-cols-1 lg:grid-cols-2">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/equipment_create.png') }}" alt="">
        </div>
        <div class="my-auto">
            <x-utils.card-grid>
                <form action="{{ route('equipment.store') }}" method="POST" enctype="multipart/form-data"
                    class="card-body">
                    @csrf
                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ __('Add an equipment') }}</h2>

                    {{-- Title --}}
                    <x-utils.input type="text" name="title" hint="{{ __('Enter the name of the equipment') }}"
                        error=1 />

                    {{-- Brand --}}
                    <select class="select select-bordered w-full" name="brand_id">
                        <option disabled selected>{{ __('Choose the product brand') }}</option>
                        @foreach ($brands as $brand)
                            <option value="{{ $brand->id }}">{{ $brand->name }}</option>
                        @endforeach
                    </select>

                    {{-- Image --}}
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text-alt">{{ __('Image') }} (1280x720)</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                    </div>

                    {{-- Submit --}}
                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">{{ __('Add equipment') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
</x-layout>
