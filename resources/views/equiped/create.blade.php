<x-layout title="{{ __('Add an equipment') }} ">
    {{-- Add equipment card --}}
    <div class="mx-auto my-10">
        <h2 class="font-bold text-5xl text-center pb-16">{{ __('Connect an equipment') }}</h2>

        {{-- List of equipments --}}
        <form method="POST" action="{{ route('equiped.select') }}">
            @csrf
            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 lg:px-24">
                @foreach ($equipment as $item)
                    <x-utils.card class="w-full h-96">
                        {{-- Equipment image --}}
                        <img src="{{ asset('storage/' . $item->brand->image) }}"
                            class="w-full h-full object-cover object-center rounded-t">

                        {{-- Equipment info --}}
                        <div class="card-body">
                            <h2 class="card-title">{{ $item->title }}</h2>
                            <p>{{ $item->description }}</p>
                            <p>{{ __('Brand') }}: {{ $item->brand->name }}</p>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="equipment[]"
                                    value="{{ $item->id }}" id="item-{{ $item->id }}">
                                <label class="form-check-label" for="item-{{ $item->id }}">
                                    {{ __('Select') }}
                                </label>
                            </div>
                        </div>
                    </x-utils.card>
                @endforeach
            </div>

            <div class="flex justify-center mt-5">
                <button type="submit" class="my-5 btn btn-primary">
                    {{ __('Validate selection') }}
                </button>
            </div>
        </form>
    </div>
</x-layout>
