<x-layout title="Events list" datatables=1>
    <x-admin.listing>
        <!-- head -->
        <thead>
            <tr>
                <th>id</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Capacity') }}</th>
                <th>{{ __('Date') }}</th>
                <th>{{ __('Room') }}</th>
                <th>{{ __('Is course') }}</th>
                <th>{{ __('Created by') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($events as $event)
                <tr class="hover">
                    <th>{{ $event->id }}</th>
                    <td class="font-bold">
                        <a href="{{ route('events.show', ['event' => $event->id]) }}" class="link hover:link-primary">
                            {{ $event->title }}
                        </a>
                    </td>
                    <td>
                        @if ($event->image)
                            <a href="{{ 'storage/' . $event->image }}" class="">
                                <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                            </a>
                        @endif
                    </td>
                    <td>{{ $event->capacity }}</td>
                    <td>{{ $event->date }}</td>
                    <td>
                        <a href="{{ route('room.show', ['room' => $event->room->id]) }}" class="link font-bold">
                            {{ Str::limit($event->room->name, 15) }}
                        </a>
                    </td>
                    <td>
                        @if ($event->is_course)
                            <i class="fa-solid fa-check text-success"></i>
                        @else
                            <i class="fa-solid fa-times text-error"></i>
                        @endif
                    </td>
                    <x-admin.user-avatar :target="$event->created_by_user" />
                    <td class="w-1/6">
                        <div class="dropdown dropdown-bottom dropdown-end">
                            <label tabindex="0" class="btn btn-circle btn-ghost">
                                <i class="fa-solid fa-gear"></i>
                            </label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                <!--Modify -->
                                <a href="{{ route('events.edit', ['event' => $event->id]) }}" class="btn btn-primary">
                                    <i class="fa-solid fa-pen me-2"></i>{{ __('Modify') }}
                                </a>

                                <!-- Open delete modal -->
                                <label for="delete-modal-{{ $event->id }}" class="btn btn-error mt-2">
                                    <i class="fa-solid fa-trash me-2"></i>{{ __('Delete') }}
                                </label>
                            </ul>
                        </div>
                    </td>

                    <!-- Delete modal -->
                    <input type="checkbox" id="delete-modal-{{ $event->id }}" class="modal-toggle" />
                    <div class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <form action="{{ route('events.destroy', ['event' => $event]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <label for="delete-modal-{{ $event->id }}"
                                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                <h3 class="font-bold text-lg mb-4">
                                    {{ __('Are you sure you wanna delete this event ?') }}</h3>

                                <div class="flex justify-center">
                                    <button class="btn btn-error w-3/5">
                                        <i class="fa-solid fa-trash me-2"></i>
                                        {{ __('Delete the event') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </x-admin.listing>
</x-layout>
