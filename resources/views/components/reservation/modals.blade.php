@props(['reservations', 'users'])

<!--Modals assign-->
@foreach ($reservations as $reservation)
    <input type="checkbox" id="modal-{{ $reservation->id }}" class="modal-toggle hidden" />
    <div class="modal">
        <div class="modal-box">
            <h3 class="text-lg font-bold mb-4">{{ __('Assign the request') }}</h3>
            <form action="{{ route('reservation.assign', $reservation) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="user_id" class="sr-only">{{ __('Provider') }}</label>
                    <select name="user_id" id="user_id"
                        class="bg-gray-100 border-2 w-full p-4 rounded-lg @error('user_id') border-red-500 @enderror">
                        <option value="">{{ __('Select a provider') }}</option>
                        @foreach ($users as $user)
                            <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->email }})
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="modal-action mt-4">
                    <label for="modal-{{ $reservation->id }}" class="btn btn-primary">{{ __('Close') }}</label>
                    <button type="submit" class="btn btn-primary">{{ __('Assign') }}</button>
                </div>
            </form>
        </div>
    </div>

    <x-reservation.modal :reservation=$reservation />
@endforeach
