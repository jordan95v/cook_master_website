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
                        @elseif ($order->status == 'sent')
                            <i class="fa-solid fa-truck-fast text-primary"></i>
                        @else
                            <i class="fa-solid fa-check text-success"></i>
                        @endif
                    </td>
                    <td>
                        @if ($order->status == 'pending')
                            <form action="{{ route('orders.send', $order) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success w-full">
                                    {{ __('Mark send') }}
                                </button>
                            </form>
                        @else
                            {{ __('No actions available') }}
                        @endif

                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-admin.listing>
</x-layout>
