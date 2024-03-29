<x-layout title="My courses at home" datatables=1>
    <x-admin.listing>
        <!-- head -->
        <thead>
            <tr>
                <th>id</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Status') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Auth::user()->home_courses as $reservation)
                <tr class="hover">
                    <th>{{ $reservation->id }}</th>
                    <td class="font-bold">{{ $reservation->title }}</td>
                    <td>{{ $reservation->date }}</td>
                    <td>
                        @switch($reservation->status)
                            @case('pending')
                                <i class="fa-solid fa-clock"></i>
                            @break

                            @case('accepted')
                                <i class="fa-solid fa-check text-success"></i>
                            @break

                            @case('rejected')
                                <i class="fa-solid fa-times text-error"></i>
                            @break
                        @endswitch
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-admin.listing>

    @if (Auth::user()->is_service_provider)
        <h1 class="text-center">{{ __('Assigned home courses') }}</h1>

        <x-admin.listing>
            <!-- head -->
            <thead>
                <tr>
                    <th>id</th>
                    <th>{{ __('Title') }}</th>
                    <th>{{ __('Date') }}</th>
                    <th>{{ __('Status') }}</th>
                    <th>{{ __('Actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach (Auth::user()->assigned_home_courses as $reservation)
                    <tr class="hover">
                        <th>{{ $reservation->id }}</th>
                        <td class="font-bold">{{ $reservation->title }}</td>
                        <td>{{ $reservation->date }}</td>
                        <td>
                            @switch($reservation->status)
                                @case('pending')
                                    <i class="fa-solid fa-clock"></i>
                                @break

                                @case('accepted')
                                    <i class="fa-solid fa-check text-success"></i>
                                @break

                                @case('rejected')
                                    <i class="fa-solid fa-times text-error"></i>
                                @break
                            @endswitch
                        </td>
                        <td>
                            <label for="my-modal-{{ $reservation->id }}" class="btn btn-primary"><i
                                    class="fa-solid fa-eye"></i></label>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </x-admin.listing>

        @foreach (Auth::user()->assigned_home_courses as $reservation)
            <x-reservation.modal :reservation=$reservation />
        @endforeach
    @endif
</x-layout>
