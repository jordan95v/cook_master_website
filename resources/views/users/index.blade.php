<x-layout title="Users list" datatables=1 calendar=1>
    <x-admin.listing>
        <!-- head -->
        <thead>
            <tr>
                <th>id</th>
                <th>{{ __('Username') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Role') }}</th>
                <th>{{ __('Banned') }}</th>
                <th>{{ __('Provider') }}</th>
                <th>{{ __('Planning') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($users as $user)
                @php
                    switch ($user->role) {
                        case 0:
                            $value = __('Normal user');
                            break;
                        case 1:
                            $value = __('Admin');
                            break;
                        case 2:
                            $value = __('Super admin');
                            break;
                    }
                @endphp
                <tr class="hover">
                    <th>{{ $user->id }}</th>
                    <x-admin.user-avatar :target="$user" />
                    <td>{{ $user->email }}</td>
                    <td>{{ $value }}</td>
                    <td>
                        @if ($user->is_banned)
                            <i class="fa-solid fa-check text-success"></i>
                        @else
                            <i class="fa-solid fa-times text-error"></i>
                        @endif
                    </td>
                    <td>
                        @if ($user->is_service_provider)
                            <i class="fa-solid fa-check text-success"></i>
                        @else
                            <i class="fa-solid fa-times text-error"></i>
                        @endif
                    </td>
                    <td>
                        {{-- Calendar open button --}}
                        <label for="calendar-modal" class="hover:cursor-pointer calendar_btn">
                            <i class="fa-solid fa-calendar-days" data-target="{{ $user->id }}"></i>
                        </label>
                    </td>
                    <td>
                        @if (Auth::user()->isAdmin() && $user->role != 2)
                            <div class="dropdown dropdown-bottom dropdown-end">
                                <label tabindex="0" class="btn btn-circle btn-ghost"><i
                                        class="fa-solid fa-gear"></i></label>
                                <ul tabindex="0"
                                    class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-56">
                                    @if (!$user->is_banned)
                                        <!-- Open ban modal -->
                                        <label for="ban-modal-{{ $user->id }}" class="btn btn-warning">
                                            <i class="fa-solid fa-ban me-2"></i>{{ __('Ban') }}
                                        </label>
                                    @else
                                        <!-- Open unban modal -->
                                        <label for="ban-modal-{{ $user->id }}" class="btn btn-primary">
                                            <i class="fa-solid fa-ban me-2"></i>{{ __('Unban') }}
                                        </label>
                                    @endif


                                    <label for="manage-modal-{{ $user->id }}" class="btn btn-accent mt-2">
                                        @if ($user->role == 1)
                                            <i class="fa-solid fa-arrow-up-right-dots me-2 rotate-90"></i>
                                            {{ __('Demote') }}
                                        @elseif ($user->role == 0)
                                            <i class="fa-solid fa-arrow-up-right-dots me-2"></i>{{ __('Promote') }}
                                        @endif
                                    </label>

                                    <!-- Open service provider modal -->
                                    <label for="service-modal-{{ $user->id }}" class="btn btn-success mt-2">
                                        @if ($user->is_service_provider)
                                            <i class="fa-solid fa-money-bill me-2"></i>{{ __('Remove provider') }}
                                        @else
                                            <i class="fa-solid fa-money-bill me-2"></i>{{ __('Make provider') }}
                                        @endif
                                    </label>

                                    <!-- Open delete modal -->
                                    <label for="delete-modal-{{ $user->id }}" class="btn btn-error mt-2">
                                        <i class="fa-solid fa-trash me-2"></i>{{ __('Delete') }}
                                    </label>
                                </ul>
                            </div>
                        @endif
                    </td>
                </tr>


                @if ($user->role != 2)
                    <!-- Ban modal -->
                    <input type="checkbox" id="ban-modal-{{ $user->id }}" class="modal-toggle" />
                    <div class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <form action="{{ route('user.manage-ban', ['user' => $user]) }}" method="post">
                                @csrf
                                <label for="ban-modal-{{ $user->id }}"
                                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                <h3 class="font-bold text-lg mb-4">
                                    @if (!$user->is_banned)
                                        {{ __('Are you sure you wanna ban this account ?') }}
                                    @else
                                        {{ __('Are you sure you wanna unban this account ?') }}
                                    @endif
                                </h3>

                                <div class="flex justify-center">
                                    <button
                                        class="btn @if (!$user->is_banned) btn-warning @else btn-primary @endif w-3/5">
                                        @if (!$user->is_banned)
                                            <i class="fa-solid fa-ban me-2"></i>{{ __('Ban') }}
                                        @else
                                            <i class="fa-solid fa-ban me-2"></i>{{ __('Unban') }}
                                        @endif
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Promote modal -->
                    <input type="checkbox" id="manage-modal-{{ $user->id }}" class="modal-toggle" />
                    <div class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <form action="{{ route('user.manage-admin', ['user' => $user]) }}" method="post">
                                @csrf
                                @method('PUT')
                                <label for="manage-modal-{{ $user->id }}"
                                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                <h3 class="font-bold text-lg mb-4">
                                    @if ($user->role == 1)
                                        {{ __('Are you sure you wanna demote this account ?') }}
                                    @elseif ($user->role == 0)
                                        {{ __('Are you sure you wanna promote this account ?') }}
                                    @endif
                                </h3>

                                <div class="flex justify-center">
                                    <button class="btn btn-accent w-3/5">
                                        <i class="fa-solid fa-arrow-up-right-dots me-2"></i>{{ __('Promote') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Service provider modal -->
                    <input type="checkbox" id="service-modal-{{ $user->id }}" class="modal-toggle" />
                    <div class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <form action="{{ route('user.manage-service-provider', ['user' => $user]) }}"
                                method="post">
                                @csrf
                                @method('PUT')
                                <label for="service-modal-{{ $user->id }}"
                                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                <h3 class="font-bold text-lg mb-4">
                                    @if ($user->is_service_provider)
                                        {{ __('Are you sure you wanna remove this account from service providers ?') }}
                                    @else
                                        {{ __('Are you sure you wanna make this account a service provider ?') }}
                                    @endif
                                </h3>

                                <div class="flex justify-center">
                                    <button class="btn btn-success w-3/5">
                                        @if ($user->is_service_provider)
                                            <i class="fa-solid fa-money-bill me-2"></i>{{ __('Remove provider') }}
                                        @else
                                            <i class="fa-solid fa-money-bill me-2"></i>{{ __('Make provider') }}
                                        @endif
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Delete modal -->
                    <input type="checkbox" id="delete-modal-{{ $user->id }}" class="modal-toggle" />
                    <div class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <form action="{{ route('user.destroy', ['user' => $user]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <label for="delete-modal-{{ $user->id }}"
                                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                <h3 class="font-bold text-lg mb-4">
                                    {{ __('Are you sure you wanna delete this account ?') }}</h3>

                                <div class="flex justify-center">
                                    <button class="btn btn-error w-3/5">
                                        <i class="fa-solid fa-trash me-2"></i>{{ __('Delete') }}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                @endif
            @endforeach
        </tbody>
    </x-admin.listing>

    {{-- Calendar modal --}}
    <input type="checkbox" id="calendar-modal" class="modal-toggle" />
    <div class="modal lg:px-24 px-2">
        <div class="modal-box max-w-5xl h-full lg:h-auto w-full">
            <h3 class="font-bold text-lg pb-2">{{ __('Events planning') }}</h3>
            <div id='calendar' class="h-screen"></div>
            <div class="modal-action">
                <label for="calendar-modal" class="btn btn-sm btn-circle btn-ghost absolute right-2 top-2">✕</label>
            </div>
        </div>
    </div>

    @foreach ($events as $event)
        <x-event.modal :event="$event" />
    @endforeach

    <script>
        let calendar_buttons = document.querySelectorAll('.calendar_btn');
        for (let i = 0; i < calendar_buttons.length; i++) {
            calendar_buttons[i].addEventListener('click', function(e) {
                let id = e.target.dataset.target;

                let events = [];
                @foreach ($users as $user)
                    if ("{{ $user->id }}" == id) {
                        @foreach ($user->events as $event)
                            events.push({
                                id: '{{ $event->id }}',
                                title: '{{ $event->title }}',
                                start: '{{ $event->start() }}',
                                end: '{{ $event->end() }}',
                            });
                        @endforeach
                    }
                @endforeach

                var calendarElement = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarElement, {
                    initialView: 'timeGridDay',
                    events: events,
                    eventClick: function(info) {
                        document.querySelector(`#modal-${info.event.id}`).checked = true;
                    },
                    headerToolbar: {
                        left: 'prev,next',
                        center: 'title',
                        right: window.innerWidth < 640 ? 'timeGridDay' :
                            'timeGridDay,timeGridWeek,dayGridMonth'
                    }
                });
                calendar.setOption('locale', '{{ App::getLocale() }}');
                calendar.render();
            });
        }
    </script>
</x-layout>
