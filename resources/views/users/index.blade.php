<x-layout title="Liste des utilisateurs" datatables=1>
    <x-admin.listing>
        <!-- head -->
        <thead>
            <tr>
                <th>id</th>
                <th>{{ __('Username') }}</th>
                <th>{{ __('Email') }}</th>
                <th>{{ __('Role') }}</th>
                <th>{{ __('Banned') }}</th>
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
                            $value = 'Admin';
                            break;
                        case 2:
                            $value = 'Super admin';
                            break;
                    }
                @endphp
                <tr class="hover">
                    <th>{{ $user->id }}</th>
                    <x-admin.user-avatar :target="$user" />
                    <td>{{ $user->email }}</td>
                    <td>{{ $value }}</td>
                    <td>{{ $user->is_banned ? '✔️' : '❌' }}</td>
                    <td class="w-1/6">
                        <div class="dropdown dropdown-bottom dropdown-end">
                            <label tabindex="0" class="btn btn-circle btn-ghost"><i class="fa-solid fa-gear"></i></label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                @if (!$user->is_banned)
                                    <!-- Open ban modal -->
                                    <label for="ban-modal-{{ $user->id }}" class="btn btn-warning">
                                        <i class="fa-solid fa-ban me-2"></i>{{ __('Ban') }}
                                    </label>
                                @else
                                    <!-- Open unban modal -->
                                    <label for="unban-modal-{{ $user->id }}" class="btn btn-primary">
                                        <i class="fa-solid fa-ban me-2"></i>{{ __('Unban') }}
                                    </label>
                                @endif
                                <!-- Open delete modal -->
                                <label for="delete-modal-{{ $user->id }}" class="btn btn-error mt-2">
                                    <i class="fa-solid fa-trash me-2"></i>{{ __('Delete') }}
                                </label>
                            </ul>
                        </div>
                        @if (!$user->is_banned)
                            <!-- Ban modal -->
                            <input type="checkbox" id="ban-modal-{{ $user->id }}" class="modal-toggle" />
                            <div class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box">
                                    <form action="{{ route('user.ban', ['user' => $user]) }}" method="post">
                                        @csrf
                                        <label for="ban-modal-{{ $user->id }}"
                                            class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                        <h3 class="font-bold text-lg mb-4">
                                            {{ __('Are you sure you wanna ban this account ?') }}
                                        </h3>

                                        <div class="flex justify-center">
                                            <button class="btn btn-warning w-3/5">
                                                <i class="fa-solid fa-trash me-2"></i>{{ __('Ban') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @else
                            <!-- Unban modal -->
                            <input type="checkbox" id="unban-modal-{{ $user->id }}" class="modal-toggle" />
                            <div class="modal modal-bottom sm:modal-middle">
                                <div class="modal-box">
                                    <form action="{{ route('user.unban', ['user' => $user]) }}" method="post">
                                        @csrf
                                        <label for="unban-modal-{{ $user->id }}"
                                            class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                        <h3 class="font-bold text-lg mb-4">
                                            {{ __('Are you sure you wanna ban this account ?') }}
                                        </h3>

                                        <div class="flex justify-center">
                                            <button class="btn btn-primary">
                                                <i class="fa-solid fa-trash me-2"></i>{{ __('Unban') }}
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </td>

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
                </tr>
            @endforeach
        </tbody>
    </x-admin.listing>
</x-layout>
