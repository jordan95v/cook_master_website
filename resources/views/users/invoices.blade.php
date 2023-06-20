<x-layout title="Factures">
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
                                <th>id</th>
                                <th>Date</th>
                                <th>{{ __('Price') }}</th>
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
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </x-utils.card>
</x-layout>
