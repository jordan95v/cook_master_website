@props(['item'])

<div class="grid grid-cols-3 mb-4 rounded-xl bg-gray-200 border-2">
    <div class="hidden lg:flex">
        <img src="{{ asset('storage/' . $item->product->image) }}" alt="" class="object-cover lg:rounded-s-xl">
    </div>

    <div class="flex flex-col lg:ms-4 lg:py-2 col-span-3 lg:col-span-2">
        <div class="mb-auto">
            {{-- Image and name --}}
            <img src="{{ asset('storage/' . $item->product->image) }}" alt=""
                class="object-cover lg:hidden w-full rounded-t-xl">

            <div class="p-2 lg:p-0">
                <a class="hover:link font-bold text-lg"
                    href="{{ route('product.show', ['product' => $item->product->id]) }}">
                    {{ $item->product->name }}
                </a>

                {{-- Price and quantity --}}
                <div class="my-4">
                    <p class="text-start italic">
                        <span class="font-bold">{{ __('Quantity') }}:</span> {{ $item->quantity }}
                    </p>

                    <p class="text-start italic">
                        <span class="font-bold">{{ __('Unit price') }}:</span> €{{ $item->product->price }}
                    </p>
                </div>
            </div>
        </div>

        <div class="flex lg:pb-2 lg:pe-4">
            {{-- Add more quantity --}}
            <form action="{{ route('order.store', ['product' => $item->product->id]) }}" method="post" class="w-full">
                @csrf
                <input type="hidden" name="add" value=1>
                <button class="btn-square rounded-s btn-sm btn-primary w-full"><i class="fa-solid fa-plus"></i></button>
            </form>

            {{-- Remove quantity --}}
            <form action="{{ route('order.store', ['product' => $item->product->id]) }}" method="post" class="w-full">
                @csrf
                <input type="hidden" name="remove" value=1>
                <button class="btn-square btn-warning btn-sm w-full"><i class="fa-solid fa-minus"></i></button>
            </form>

            {{-- Delete the order --}}
            <form action="{{ route('order.destroy', ['order' => $item->id]) }}" method="post" class="w-full">
                @csrf
                <button class="btn-square rounded-e btn-sm btn-error w-full"><i class="fa-solid fa-trash"></i></button>
            </form>
        </div>
    </div>
</div>
<div class="divider px-20"></div>
