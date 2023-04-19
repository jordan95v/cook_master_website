<x-layout title="Liste des marques" datatables=1>
    <x-admin.listing>
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
                    <td class="font-bold">
                        <a href="{{ route('brand.show', ['brand' => $brand->id]) }}" class="link hover:link-primary">
                            {{ $brand->name }}
                        </a>
                    </td>
                    <td>
                        @if ($brand->image)
                            <a href="{{ 'storage/' . $brand->image }}" class="">
                                {{ $brand->image }}<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                            </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ $brand->website }}" class="link hover:link-primary">
                            <i class="fa-solid fa-globe me-2"></i>{{ $brand->website }}
                        </a>
                    </td>
                    <td>
                        <a href="mailto:{{ $brand->contact_email }}">
                            <i class="fa-solid fa-envelopes-bulk me-2"></i>{{ $brand->contact_email }}
                        </a>
                    </td>
                    <td class="w-1/6">
                        <div class="dropdown dropdown-bottom dropdown-end">
                            <label tabindex="0" class="btn btn-circle btn-ghost">
                                <i class="fa-solid fa-gear"></i>
                            </label>
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
    </x-admin.listing>
</x-layout>
