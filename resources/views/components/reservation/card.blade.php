@props(['reservation', 'delete'])

<div class="flex p-4 bg-gray-100 rounded-lg mb-4">
    <div class="flex-grow">
        <h3 class="text-2xl font-bold">{{ $reservation->title }}</h3>
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
    <div class="flex-shrink">
        <label for="my-modal-{{ $reservation->id }}" class="btn btn-primary"><i class="fa-solid fa-eye"></i></label>
        <label for="modal-{{ $reservation->id }}" class="btn bg-success"><i class="fa-solid fa-person"></i></label>
        @isset($delete)
            <form action="{{ route('reservation.destroy', $reservation) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn bg-red-500"><i class="fa-solid fa-trash"></i></button>
            </form>
        @else
            <form action="{{ route('reservation.reject', $reservation) }}" method="POST" style="display: inline;">
                @csrf
                <button type="submit" class="btn bg-error"><i class="fa-solid fa-x"></i></button>
            </form>
        @endisset
    </div>
</div>
