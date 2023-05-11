<x-layout title="{{ __('Edit') }} {{ $room->name }}">
    <div class="grid grid-cols-1 md:grid-cols-3">
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/edit.png') }}" alt="">
        </div>
        <div class="col-span-2">
            <x-utils.card-grid>
                <form action="/room/{{ $room->id }}" method="POST" enctype="multipart/form-data" class="card-body">
                    @csrf
                    @method('put')
                    <h2 class="card-title text-2xl flex justify-center pb-2">{{ __('Edit the room') }}</h2>
                    {{-- Name --}}
                    <x-utils.input type="text" name="name" hint="{{ __('Enter the name of the room') }}" error=1
                        :target="$room" />
                    {{-- Address --}}
                    <x-utils.input type="text" name="address" hint="{{ __('Enter the address of the room') }}"
                        error=1 :target="$room" />
                    {{-- Image --}}
                    <div class="form-control w-full pb-2">
                        <label class="label">
                            <span class="label-text-alt">{{ __('Image') }}</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                        <label class="label">
                            <span class="label-text-alt">{{ __('Current Image') }}</span>
                        </label>
                        <img src="{{ asset('storage/' . $room->image) }}" alt="" class="w-50 h-50">
                    </div>
                    {{-- Submit --}}
                    <div class="justify-center card-actions">
                        <button type="submit" class="btn btn-primary">{{ __('Edit') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
    </div>
</x-layout>
