<x-layout title="Liste des produits" datatables=1>
    <x-admin.listing>
        <!-- head -->
        <thead>
            <tr>
                <th>id</th>
                <th>{{ __('Title') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Brand') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($equipments as $equipment)
                <tr class="hover">
                    <th>{{ $equipment->id }}</th>
                    <td class="font-bold">
                        <a href="{{ route('equipment.show', ['equipment' => $equipment->id]) }}"
                            class="link hover:link-primary">
                            {{ $equipment->title }}
                        </a>
                    </td>
                    <td>
                        @if ($equipment->image)
                            <a href="{{ 'storage/' . $equipment->image }}" class="">
                                {{ $equipment->image }}<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                            </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('brand.show', ['brand' => $equipment->brand->id]) }}"
                            class="link hover:link-primary">
                            {{ $equipment->brand->name }}
                        </a>
                    </td>
                    <td class="w-1/6">
                        <div class="dropdown dropdown-bottom dropdown-end">
                            <label tabindex="0" class="btn btn-circle btn-ghost">
                                <i class="fa-solid fa-gear"></i>
                            </label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                <!--Modify -->
                                <a href="{{ route('equipment.edit', ['equipment' => $equipment->id]) }}"
                                    class="btn btn-primary">
                                    <i class="fa-solid fa-pen me-2"></i>{{ __('Modify') }}
                                </a>

                                <!-- Open delete modal -->
                                <label for="delete-modal-{{ $equipment->id }}" class="btn btn-error mt-2">
                                    <i class="fa-solid fa-trash me-2"></i>{{ __('Delete') }}
                                </label>
                            </ul>
                        </div>
                    </td>

                    <!-- Delete modal -->
                    <input type="checkbox" id="delete-modal-{{ $equipment->id }}" class="modal-toggle" />
                    <div class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <form action="{{ route('equipment.destroy', ['equipment' => $equipment]) }}"
                                method="post">
                                @csrf
                                @method('DELETE')
                                <label for="delete-modal-{{ $equipment->id }}"
                                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                <h3 class="font-bold text-lg mb-4">
                                    {{ __('Are you sure you wanna delete this equipment ?') }}
                                </h3>

                                <div class="flex justify-center">
                                    <button class="btn btn-error w-3/5">
                                        <i class="fa-solid fa-trash me-2"></i>{{ __('Delete the equipment') }}
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
