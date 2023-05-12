<x-layout title="{{ __('Edit equipment') }} ">
    <div class="mx-auto my-10 px-10 lg:px-24">

        @if (count($room_equipement) > 0)
            <h2 class="font-bold text-4xl text-center py-10">{{ __('Room\'s equipment') }}</h2>
            <input type="hidden" name="room_id" value="{{ session('room_id') }}">

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 gap-y-0 px-10 lg:px-24">
                @foreach ($room_equipement as $item)
                    <x-utils.card class="w-full">
                        {{-- Equipment image --}}
                        <img src="{{ asset('storage/' . $item->brand->image) }}"
                            class="w-full h-full object-cover rounded-t">

                        {{-- Equipment info --}}
                        <div class="card-body">
                            <h2 class="card-title">{{ $item->title }}</h2>
                            <p>{{ $item['description'] }}</p>
                            <p>{{ __('Brand') }} {{ $item->brand->name }}</p>

                            <form action="{{ route('equiped.destroy', ['equiped' => $item->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-error mt-4">
                                    <i class="fa-solid fa-trash me-2"></i>{{ __('Remove') }}
                                </button>
                            </form>
                        </div>
                    </x-utils.card>
                @endforeach
            </div>
        @endif

        @if (count($available) > 0)
            <h2 class="font-bold text-4xl text-center py-10">{{ __('Add equipment') }}</h2>

            <form method="POST" action="{{ route('equiped.select') }}">
                @csrf
                <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 lg:px-24">
                    @foreach ($available as $item)
                        <x-utils.card class="w-full h-max">
                            {{-- Equipment image --}}
                            <img src="{{ asset('storage/' . $item->brand->image) }}"
                                class="w-full h-full object-cover rounded-t">

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
        @endif
    </div>
</x-layout>
