@extends('admin-layout')

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
    <x-admin-listing>
        <!-- head -->
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Website</th>
                <th>Contact email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($brands as $brand)
                <tr class="hover">
                    <th>{{ $brand->id }}</th>
                    <td>{{ $brand->name }}</td>
                    <td>
                        <img src="{{ $brand->image ? asset('storage/' . $brand->image) : '' }}" alt="No image"
                            class="rounded w-28">
                    </td>
                    <td>{{ $brand->website }}</td>
                    <td>{{ $brand->contact_email }}</td>
                    <td class="w-1/6">
                        <div class="dropdown dropdown-left dropdown-end">
                            <label tabindex="0" class="btn m-1"><i class="fa-solid fa-gear me-2"></i> Manage</label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                <!--Modify -->
                                <a href="{{ route('brand.edit', ['brand' => $brand->id]) }}" class="btn btn-primary">
                                    <i class="fa-solid fa-pen me-2"></i>Modify
                                </a>

                                <!-- Open delete modal -->
                                <label for="delete-modal-{{ $brand->id }}" class="btn btn-error mt-2">
                                    <i class="fa-solid fa-trash me-2"></i>Delete
                                </label>
                            </ul>
                        </div>
                    </td>

                    <!-- Delete modal -->
                    <input type="checkbox" id="delete-modal-{{ $brand->id }}" class="modal-toggle" />
                    <div class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <form action="{{ route('brand.destroy', ['brand' => $brand]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <label for="delete-modal-{{ $brand->id }}"
                                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                <h3 class="font-bold text-lg mb-4">Are you sure you wanna delete this brand ?</h3>

                                <div class="flex justify-center">
                                    <button class="btn btn-error w-3/5"><i class="fa-solid fa-trash me-2"></i>Delete
                                        brand</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </x-admin-listing>

    <script>
        $(document).ready(
            function() {
                $('#listing-table').DataTable();
            }
        );
    </script>
@endsection
