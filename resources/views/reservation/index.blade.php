<x-layout title="Liste des réservations">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6   lg:px-24 py-10">
        <!--Request pending-->
        <div class="container">
            <h1 class="text-3xl font-bold mb-4">{{ __('Request pending') }}</h1>
            <div class="overflow-y-auto max-h-full">
                @foreach ($reservations as $reservation)
                    @if ($reservation->status == 'pending')
                        <div class="flex relative p-4 bg-gray-100 rounded-lg mb-4 h-36">
                            <div class="flex-grow">
                                <h3 class="text-2xl font-bold">{{ $reservation->title }}</h3>
                                <p class="absolute mt-4 left-0  ml-3"><span class="font-bold">{{ __('Date') }}:</span>
                                    {{ $reservation->date }}
                                </p>
                                <p class="absolute bottom-0 left-0 mb-4 ml-3"><span
                                        class="font-bold">{{ __('Address') }}:</span>
                                    {{ $reservation->address }}</p>
                            </div>
                            <!--Buttons-->
                            <div class="flex-shrink">
                                <label for="my-modal-{{ $reservation->id }}" class="btn btn-primary"><i
                                        class="fa-solid fa-eye"></i></label>
                                <label for="modal-{{ $reservation->id }}" class="btn bg-green-500"><i
                                        class="fa-solid fa-person"></i></label>
                                <form action="{{ route('reservation.reject', $reservation->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn bg-red-500"><i class="fa-solid fa-x"></i></button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
        <!--Request assigned-->
        <div class="container">
            <h1 class="text-3xl font-bold mb-4">{{ __('Request assigned') }}</h1>
            <div class="overflow-y-auto max-h-screen">
                @foreach ($reservations as $reservation)
                    @if ($reservation->status == 'accepted')
                        <div class="flex relative p-4  bg-gray-100 rounded-lg mb-4 h-36">
                            <div class="flex-grow">
                                <h3 class="text-2xl font-bold">{{ $reservation->title }}</h3>
                                <p class="absolute mt-4 left-0  ml-3"><span
                                        class="font-bold">{{ __('Date') }}:</span>
                                    {{ $reservation->date }}
                                </p>
                                <p class="absolute bottom-0 left-0 mb-4 ml-3"><span
                                        class="font-bold">{{ __('Address') }}:</span>
                                    {{ $reservation->address }}</p>
                            </div>
                            <!--Buttons-->
                            <div class="flex-shrink">
                                <label for="my-modal-{{ $reservation->id }}" class="btn btn-primary"><i
                                        class="fa-solid fa-eye"></i></label>
                                <label for="modal-{{ $reservation->id }}" class="btn bg-green-500"><i
                                        class="fa-solid fa-person"></i></label>
                                <form action="{{ route('reservation.reject', $reservation->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('POST')
                                    <button type="submit" class="btn bg-red-500"><i class="fa-solid fa-x"></i></button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>

        <!--Request rejected-->
        <div class="container">
            <h1 class="text-3xl font-bold mb-4">{{ __('Request rejected') }}</h1>
            <div class="overflow-y-auto max-h-screen">
                @foreach ($reservations as $reservation)
                    @if ($reservation->status == 'rejected')
                        <div class="flex relative p-4 bg-gray-100 rounded-lg mb-4 h-36">
                            <div class="flex-grow">
                                <h3 class="text-2xl font-bold">{{ $reservation->title }}</h3>
                                <p class="absolute mt-4 left-0  ml-3"><span
                                        class="font-bold">{{ __('Date') }}:</span>
                                    {{ $reservation->date }}
                                </p>
                                <p class="absolute bottom-0 left-0 mb-4 ml-3"><span
                                        class="font-bold">{{ __('Address') }}:</span>
                                    {{ $reservation->address }}</p>
                            </div>
                            <!--Buttons-->
                            <div class="flex-shrink">
                                <label for="my-modal-{{ $reservation->id }}" class="btn btn-primary"><i
                                        class="fa-solid fa-eye"></i></label>
                                <label for="modal-{{ $reservation->id }}" class="btn bg-green-500"><i
                                        class="fa-solid fa-person"></i></label>
                                <form action="{{ route('reservation.destroy', $reservation->id) }}" method="POST"
                                    style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn bg-red-500"><i
                                            class="fa-solid fa-trash"></i></button>
                                </form>
                            </div>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <!--Modals assign-->
    @foreach ($reservations as $reservation)
        <input type="checkbox" id="modal-{{ $reservation->id }}" class="modal-toggle hidden" />
        <div class="modal">
            <div class="modal-box">
                <h3 class="text-lg font-bold mb-4">{{ __('Assign the request') }}</h3>
                <form action="{{ route('reservation.assign', $reservation->id) }}" method="POST">
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
    @endforeach


    <!-- Modal see more -->
    @foreach ($reservations as $reservation)
        <input type="checkbox" id="my-modal-{{ $reservation->id }}" class="modal-toggle hidden" />
        <div class="modal">
            <div class="modal-box">
                <h3 class="text-2xl font-bold mb-4">{{ $reservation->title }}</h3>
                <div>
                    <p class="font-bold mt-4">{{ __('Description') }}:</p>
                    <p>{{ $reservation->comment }}</p>
                </div>
                <div class="mt-4">
                    <p class="font-bold">{{ __('Address') }}:</p>
                    <p>{{ $reservation->address }}</p>
                </div>
                <div class="grid grid-cols-2 gap-4 mt-4">
                    <div>
                        <p class="font-bold">{{ __('Date') }}:</p>
                        <p>{{ $reservation->date }}</p>
                    </div>
                    <div>
                        <p class="font-bold">{{ __('Created by') }}:</p>
                        <p>{{ $reservation->created_by_user->name }}</p>
                    </div>
                    <div>
                        <p class="font-bold">{{ __('Start Time') }}:</p>
                        <p>{{ $reservation->start_time }}</p>
                    </div>
                    <div>
                        <p class="font-bold">{{ __('End Time') }}:</p>
                        <p>{{ $reservation->end_time }}</p>
                    </div>
                </div>
                <div class="mt-4">
                    <p class="font-bold">{{ __('Assigned to') }}:</p>
                    @if ($reservation->user_id != null)
                        <p>{{ $reservation->assigned_to_user->name }}</p>
                    @else
                        <p>{{ __('Not assigned') }}</p>
                    @endif
                </div>
                <div class="modal-action mt-4 flex justify-end">
                    <label for="my-modal-{{ $reservation->id }}" class="btn btn-primary">{{ __('Close') }}</label>
                </div>
            </div>
        </div>
    @endforeach

</x-layout>
