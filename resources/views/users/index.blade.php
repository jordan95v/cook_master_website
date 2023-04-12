@extends('main_layout')

@section('title')
    Liste des utilisateurs
@endsection

@section('extra_tags')
    <script src="https://code.jquery.com/jquery-3.6.4.js" integrity="sha256-a9jBBRygX1Bh5lt8GZjXDzyOB+bWve9EiO7tROUtj/E="
        crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.css" />
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.js"></script>
@endsection

@section('content')
    <div class="p-5 overflow-x-auto">
        <table class="table table-zebra py-4" id="user-table">
            <!-- head -->
            <thead>
                <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @php
                        switch ($user->role) {
                            case 0:
                                $value = 'Guest';
                                break;
                            case 1:
                                $value = 'Admin';
                                break;
                            case 2:
                                $value = 'Super admin';
                                break;
                        }
                    @endphp
                    <tr>
                        <th>{{ $user->id }}</th>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $value }}</td>
                        <td class="md:w-1/5">
                            <!-- Open ban modal -->
                            <label for="ban-modal-{{ $user->id }}" class="btn btn-warning">
                                <i class="fa-solid fa-ban me-2"></i>Ban
                            </label>
                            <!-- Open delete modal -->
                            <label for="delete-modal-{{ $user->id }}" class="btn btn-error">
                                <i class="fa-solid fa-trash me-2"></i>Delete
                            </label>
                        </td>

                        <!-- Ban modal -->
                        <input type="checkbox" id="ban-modal-{{ $user->id }}" class="modal-toggle" />
                        <div class="modal modal-bottom sm:modal-middle">
                            <div class="modal-box">
                                <form action="{{ route('user.ban', ['user' => $user]) }}" method="post">
                                    @csrf
                                    <label for="ban-modal-{{ $user->id }}"
                                        class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                    <h3 class="font-bold text-lg mb-4">Are you sure you wanna ban this account ?</h3>

                                    <div class="flex justify-center">
                                        <button class="btn btn-warning w-3/5">
                                            <i class="fa-solid fa-trash me-2"></i>Ban
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <!-- Delete modal -->
                        <input type="checkbox" id="delete-modal-{{ $user->id }}" class="modal-toggle" />
                        <div class="modal modal-bottom sm:modal-middle">
                            <div class="modal-box">
                                <form action="/users/{{ $user->id }}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <label for="delete-modal-{{ $user->id }}"
                                        class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                    <h3 class="font-bold text-lg mb-4">Are you sure you wanna delete this account ?</h3>

                                    <div class="flex justify-center">
                                        <button class="btn btn-error w-3/5"><i class="fa-solid fa-trash me-2"></i>Delete
                                            account</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script>
        $(document).ready(
            function() {
                $('#user-table').DataTable();
            }
        );
    </script>
@endsection
