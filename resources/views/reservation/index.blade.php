<x-layout title="Liste des réservations">
    @if (count($reservations) == 0)
        <h1 class="text-center mt-10">{{ __('No home courses request') }} 🥲</h1>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6 lg:px-24 py-10">
            <div>
                <h1 class="text-3xl font-bold mb-4 text-center">{{ __('Request pending') }}</h1>
                <div class="overflow-y-auto max-h-full">
                    @foreach ($reservations as $reservation)
                        @if ($reservation->status == 'pending')
                            <x-reservation.card :reservation="$reservation" />
                        @endif
                    @endforeach
                </div>
            </div>

            <div>
                <h1 class="text-3xl font-bold mb-4 text-center">{{ __('Request assigned') }}</h1>
                <div class="overflow-y-auto max-h-screen">
                    @foreach ($reservations as $reservation)
                        @if ($reservation->status == 'accepted')
                            <x-reservation.card :reservation="$reservation" />
                        @endif
                    @endforeach
                </div>
            </div>

            <div>
                <h1 class="text-3xl font-bold mb-4 text-center">{{ __('Request rejected') }}</h1>
                <div class="overflow-y-auto max-h-screen">
                    @foreach ($reservations as $reservation)
                        @if ($reservation->status == 'rejected')
                            <x-reservation.card :reservation="$reservation" delete="1" />
                        @endif
                    @endforeach
                </div>
            </div>
        </div>

        <x-reservation.modals :reservations="$reservations" :users="$users" />
    @endif
</x-layout>
