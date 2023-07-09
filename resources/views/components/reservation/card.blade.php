@props(['reservation', 'delete'])

<div class="flex p-4 bg-gray-100 rounded-lg mb-4">
    <div class="flex-grow">
        <h3 class="text-2xl font-bold">{{ Str::limit($reservation->title, 25) }}</h3>
        <p class="mt-10">
            <span class="font-bold">{{ __('Date') }}:</span>
            {{ $reservation->date }}
        </p>
        <p class="mt-2">
            <span class="font-bold">{{ __('Address') }}:</span>
            {{ $reservation->address }}
        </p>
    </div>
    <!--Buttons-->
    <div class="flex flex-col gap-1">
        <label for="my-modal-{{ $reservation->id }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></label>
        <label for="modal-{{ $reservation->id }}" class="btn btn-success"><i class="fa-solid fa-person"></i></label>
        @isset($delete)
            <form action="{{ route('reservation.destroy', $reservation) }}" method="POST" class="btn btn-error">
                @csrf
                @method('DELETE')
                <button type="submit"><i class="fa-solid fa-trash"></i></button>
            </form>
        @else
            <form action="{{ route('reservation.reject', $reservation) }}" method="POST" class="btn btn-error">
                @csrf
                <button type="submit"><i class="fa-solid fa-times"></i></button>
            </form>
        @endisset
    </div>
</div>
