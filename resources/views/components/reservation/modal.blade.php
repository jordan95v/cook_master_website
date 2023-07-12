@props(['reservation'])

<!-- Modal see more -->
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
                <p>{{ $reservation->user->name }}</p>
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
            @if ($reservation->assigned_to != null)
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
