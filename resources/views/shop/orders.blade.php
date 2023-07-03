<x-layout title="Commands list" datatables=1>
    <x-admin.listing>
        <!-- head -->
        <thead>
            <tr>
                <th>{{ __('ID') }}</th>
                <th>{{ __('Command receipt') }}</th>
                <th>{{ __('Command by') }}</th>
                <th>{{ __('Price') }}</th>
                <th>{{ __('Status') }}</th>
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orders as $order)
                <tr>
                    <th>{{ $order->id }}</th>
                    <td>
                        <a href="{{ $order->url() }}" class="link hover:link-primary">
                            {{ $order->serial }} <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                        </a>
                    </td>
                    <x-admin.user-avatar :target="$order->user" />

                    <td>{{ $order->price }}€</td>
                    <td>
                        @if ($order->status == 'pending')
                            <i class="fa-solid fa-clock"></i>
                        @elseif ($order->status == 'sending')
                            <i class="fa-solid fa-truck-fast text-success"></i>
                        @else
                            <i class="fa-solid fa-check text-error"></i>
                        @endif
                    </td>
                    <td>
                        <div class="dropdown dropdown-bottom dropdown-end">
                            <label tabindex="0" class="btn btn-circle btn-ghost">
                                <i class="fa-solid fa-gear"></i>
                            </label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                {{-- Add link to change status --}}
                            </ul>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-admin.listing>
</x-layout>
