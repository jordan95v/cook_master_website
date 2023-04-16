<x-layout admin=1 title="Liste des produits" datatables=1>
    <x-admin.listing>
        <!-- head -->
        <thead>
            <tr>
                <th>id</th>
                <th>Name</th>
                <th>Image</th>
                <th>Brand</th>
                <th>Price</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $product)
                <tr class="hover">
                    <th>{{ $product->id }}</th>
                    <td class="font-bold">
                        <a href="{{ route('product.show', ['product' => $product->id]) }}"
                            class="link hover:link-primary">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td>
                        @if ($product->image)
                            <a href="{{ 'storage/' . $product->image }}" class="">
                                {{ $product->image }}<i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                            </a>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('brand.show', ['brand' => $product->brand->id]) }}"
                            class="link hover:link-primary">
                            {{ $product->brand->name }}
                        </a>
                    </td>
                    <td>
                        {{ $product->price }}€
                    </td>
                    <td class="w-1/6">
                        <div class="dropdown dropdown-bottom dropdown-end">
                            <label tabindex="0" class="btn btn-circle btn-ghost">
                                <i class="fa-solid fa-gear"></i>
                            </label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                <!--Modify -->
                                <a href="{{ route('product.edit', ['product' => $product->id]) }}"
                                    class="btn btn-primary">
                                    <i class="fa-solid fa-pen me-2"></i>Modify
                                </a>

                                <!-- Open delete modal -->
                                <label for="delete-modal-{{ $product->id }}" class="btn btn-error mt-2">
                                    <i class="fa-solid fa-trash me-2"></i>Delete
                                </label>
                            </ul>
                        </div>
                    </td>

                    <!-- Delete modal -->
                    <input type="checkbox" id="delete-modal-{{ $product->id }}" class="modal-toggle" />
                    <div class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <form action="{{ route('product.destroy', ['product' => $product]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <label for="delete-modal-{{ $product->id }}"
                                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                <h3 class="font-bold text-lg mb-4">Are you sure you wanna delete this product ?</h3>

                                <div class="flex justify-center">
                                    <button class="btn btn-error w-3/5"><i class="fa-solid fa-trash me-2"></i>Delete
                                        product</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </tr>
            @endforeach
        </tbody>
    </x-admin.listing>
</x-layout>
