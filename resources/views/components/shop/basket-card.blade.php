@props(['item'])

<div class="grid grid-cols-3 mb-4 rounded-xl border-2">

    <div class="hidden lg:flex">
        <img src="{{ asset('storage/' . $item->product->image) }}" alt="" class="object-cover rounded-xl">
    </div>

    <div class="flex flex-col ms-4 col-span-3 lg:col-span-2">
        <div class="mb-auto">
            {{-- Image and name --}}
            <img src="{{ asset('storage/' . $item->product->image) }}" alt=""
                class="object-cover lg:hidden w-full rounded-xl">
            <a class="hover:link font-bold text-xl"
                href="{{ route('product.show', ['product' => $item->product->id]) }}">
                {{ $item->product->name }}
            </a>

            {{-- Price and quantity --}}
            <div class="my-4">
                <p class="text-start italic">
                    <span class="font-bold">{{ __('Quantity') }}:</span> {{ $item->quantity }}
                </p>

                <p class="text-start italic">
                    <span class="font-bold">Prix à l'unité:</span> €{{ $item->product->price }}
                </p>
            </div>

        </div>

        <div class="flex pb-3 pe-4">
            {{-- Add more quantity --}}
            <form action="{{ route('order.store', ['product' => $item->product->id]) }}" method="post" class="w-full">
                @csrf
                <input type="hidden" name="add" value=1>
                <button class="btn-square rounded-s btn-primary w-full"><i class="fa-solid fa-plus"></i></button>
            </form>

            {{-- Remove quantity --}}
            <form action="{{ route('order.store', ['product' => $item->product->id]) }}" method="post" class="w-full">
                @csrf
                <input type="hidden" name="remove" value=1>
                <button class="btn-square btn-warning w-full"><i class="fa-solid fa-minus"></i></button>
            </form>

            {{-- Delete the order --}}
            <form action="{{ route('order.destroy', ['order' => $item->id]) }}" method="post" class="w-full">
                @csrf
                <button class="btn-square rounded-e btn-error w-full"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>
</div>
