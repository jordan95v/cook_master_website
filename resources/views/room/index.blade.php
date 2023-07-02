<x-layout title="Rooms list" datatables=1>
    <x-admin.listing>
        <!-- head -->
        <thead>
            <tr>
                <th>id</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Address') }}</th>
                <th>{{ __('Created by') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($rooms as $room)
                <tr class="hover">
                    <th>{{ $room->id }}</th>
                    <td class="font-bold">
                        <a href="{{ route('room.show', ['room' => $room->id]) }}" class="link hover:link-primary">
                            {{ $room->name }}
                        </a>
                    </td>
                    <td>
                        @if ($room->image)
                            <a href="{{ 'storage/' . $room->image }}" class="">
                                <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                            </a>
                        @endif
                    </td>
                    <td>{{ Str::limit($room->address, 30) }}</td>
                    <x-admin.user-avatar :target="$room->user" />
                    <td>
                        <div class="dropdown dropdown-bottom dropdown-end">
                            <label tabindex="0" class="btn btn-circle btn-ghost">
                                <i class="fa-solid fa-gear"></i>
                            </label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                <!--Modify -->
                                <a href="{{ route('room.edit', ['room' => $room->id]) }}" class="btn btn-primary">
                                    <i class="fa-solid fa-pen me-2"></i>{{ __('Modify') }}
                                </a>

                                <!-- Open delete modal -->
                                <label for="delete-modal-{{ $room->id }}" class="btn btn-error mt-2">
                                    <i class="fa-solid fa-trash me-2"></i>{{ __('Delete') }}
                                </label>
                            </ul>
                        </div>
                    </td>

                    <!-- Delete modal -->
                    <input type="checkbox" id="delete-modal-{{ $room->id }}" class="modal-toggle" />
                    <div class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <form action="{{ route('room.destroy', ['room' => $room]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <label for="delete-modal-{{ $room->id }}"
                                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                <h3 class="font-bold text-lg mb-4">
                                    {{ __('Are you sure you wanna delete this room ?') }}
                                </h3>

                                <div class="flex justify-center">
                                    <button class="btn btn-error w-3/5">
                                        <i class="fa-solid fa-trash me-2"></i>{{ __('Delete the room') }}
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
