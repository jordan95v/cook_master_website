@props(['item'])

<div class="flex mb-4 rounded-xl border-2 hover:border-primary p-2">
    <img src="{{ asset('storage/' . $item->product->image) }}" alt="" class="w-1/4 h-1/4 my-auto rounded">
    <div class="flex-col lg:ms-10 ms-2 w-2/4">
        <a class="hover:link font-bold" href="{{ route('product.show', ['product' => $item->product->id]) }}">
            {{ $item->product->name }}
        </a>
        <p class="text-start italic">€{{ $item->product->price }}</p>
        <p class="mt-5">Quantité: {{ $item->quantity }}</p>
    </div>
    <div class="w-1/4 text-end flex flex-col">
        {{-- Add more quantity --}}
        <form action="{{ route('order.store', ['product' => $item->product->id]) }}" method="post" class="mb-1">
            @csrf
            <input type="hidden" name="add" value=1>
            <button class="btn btn-primary btn-sm"><i class="fa-solid fa-plus"></i></button>
        </form>

        {{-- Remove quantity --}}
        <form action="{{ route('order.store', ['product' => $item->product->id]) }}" method="post" class="mb-1">
            @csrf
            <input type="hidden" name="remove" value=1>
            <button class="btn btn-warning btn-sm"><i class="fa-solid fa-minus"></i></button>
        </form>

        {{-- Delete the order --}}
        <form action="{{ route('order.destroy', ['order' => $item->id]) }}" method="post">
            @csrf
            <button class="btn btn-error btn-sm"><i class="fa-solid fa-trash"></i></button>
        </form>
    </div>
</div>
