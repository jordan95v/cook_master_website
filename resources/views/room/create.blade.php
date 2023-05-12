<x-layout title="{{ __('Create a room') }}">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/room_create.png') }}" alt="">
        </div>
        <div class="my-auto">
            <x-utils.card-grid>
                <form action="{{ route('room.store') }}" method="POST" enctype="multipart/form-data" class="card-body">
                    @csrf
                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ __('Add room') }}</h2>

                    {{-- Name --}}
                    <x-utils.input type="text" name="name" hint="{{ __('Enter the name of the room') }}"
                        error=1 />

                    {{-- Address --}}
                    <x-utils.input type="text" name="address" hint="{{ __('Enter the address of the room') }}"
                        error="1" />

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
                        <button class="btn btn-primary w-full">{{ __('Next') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
</x-layout>
