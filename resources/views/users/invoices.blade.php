<x-layout title="Invoices">
    <x-utils.card class="w-2/4">
        <div class="card-body">
            <h2 class="card-title justify-center flex text-2xl pb-4">{{ __('My invoices') }}</h2>

            @if (count(Auth::user()->orderInvoices) == 0)
                <p class="text-center p-5">{{ __('You have no invoices.') }}</p>
            @else
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>{{ __('ID') }}</th>
                                <th>{{ __('Date') }}</th>
                                <th>{{ __('Price') }}</th>
                                <th>{{ __('Status') }}</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->orderInvoices as $item)
                                <tr>
                                    <td>
                                        <a href="{{ $item->url() }}" target="_blank" class="link hover:link-primary">
                                            {{ $item->serial }}
                                        </a>
                                    </td>
                                    <td>{{ $item->created_at }}</td>
                                    <td>{{ $item->price }}€</td>
                                    <td>
                                        @if ($item->status == 'pending')
                                            <i class="fa-solid fa-clock"></i>
                                        @elseif ($item->status == 'sent')
                                            <i class="fa-solid fa-truck-fast text-primary"></i>
                                        @else
                                            <i class="fa-solid fa-check text-success"></i>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </x-utils.card>
</x-layout>
