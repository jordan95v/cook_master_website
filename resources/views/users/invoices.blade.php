<x-layout title="Factures">
    <x-utils.card>
        <div class="card-body">
            <h2 class="card-title justify-center flex text-2xl pb-4">Mes factures</h2>

            @empty(count(Auth::user()->invoices))
                <p class="text-center p-5">Vous n'avez pas de factures</p>
            @else
                <div class="overflow-x-auto">
                    <table class="table w-full">
                        <!-- head -->
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Date</th>
                                <th>Prix</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach (Auth::user()->invoices as $item)
                                <tr>
                                    <td>
                                        <a href="{{ $item->url() }}" class="link hover:link-primary">
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
            @endempty
        </div>
    </x-utils.card>
</x-layout>
