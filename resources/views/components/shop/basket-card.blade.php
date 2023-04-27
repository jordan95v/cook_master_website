@props(['item'])

<div class="flex mb-4 rounded-xl border-2 hover:border-primary p-2">
    <img src="{{ asset('storage/' . $item->product->image) }}" alt="" class="lg:w-1/4 w-2/4 rounded">
    <div class="flex-col lg:ms-10 ms-5 w-2/4">
        <a class="hover:link font-bold" href="{{ route('product.show', ['product' => $item->product->id]) }}">
            {{ $item->product->name }}
        </a>
        <p class="text-start italic">€{{ $item->product->price }}</p>
        <p class="mt-5">Quantité: {{ $item->quantity }}</p>
    </div>
    <div class="w-1/4 text-end">
        {{-- Add more quantity --}}
        <form action="{{ route('order.create', ['product' => $item->product->id]) }}" method="post">
            @csrf
            <button class="btn btn-circle btn-primary btn-sm"><i class="fa-solid fa-plus"></i></button>
        </form>

        {{-- Delete the order --}}
        <form action="{{ route('order.destroy', ['order' => $item->id]) }}" method="post" class="mt-4">
            @csrf
            <button class="btn btn-circle btn-error btn-sm"><i class="fa-solid fa-trash"></i></button>
        </form>
    </div>
</div>
