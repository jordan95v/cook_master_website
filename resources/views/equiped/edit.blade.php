<x-layout title="{{ __('Edit equipment') }} ">
    <div class="mx-auto my-10  lg:px-24">

        @if (count($room_equipement) > 0)
            <h2 class="font-bold text-4xl text-center py-10">{{ __('Room\'s equipment') }}</h2>

            <div class="grid grid-cols-1 lg:grid-cols-4 gap-10 gap-y-0 lg:px-24">
                @foreach ($room_equipement as $item)
                    <x-utils.card class="w-full">
                        {{-- Equipment image --}}
                        <img src="{{ asset('storage/' . $item->brand->image) }}"
                            class="w-full h-full object-cover rounded-t">

                        {{-- Equipment info --}}
                        <div class="card-body">
                            <h2 class="card-title">{{ $item->title }}</h2>
                            <p>{{ $item->description }}</p>
                            <p>{{ __('Brand') }} {{ $item->brand->name }}</p>

                            {{ $item->id }}
                            <form action="{{ route('equiped.destroy', ['equiped' => $item->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <div class="flex mt-4">
                                    <input type="checkbox" class="checkbox checkbox-lg me-2" disabled checked />
                                    <button type="submit" class="btn btn-sm btn-error">
                                        <i class="fa-solid fa-trash me-2"></i>{{ __('Remove') }}
                                    </button>
                                </div>
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
                <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-10 lg:px-24">
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
                                <div class="flex mt-4">
                                    <input class="checkbox me-2 checkbox-primary" type="checkbox" name="equipment[]"
                                        value="{{ $item->id }}">
                                    {{ __('Select') }}
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
