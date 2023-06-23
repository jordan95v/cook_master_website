<x-layout title="Taken formation" datatables=1>
    <x-admin.listing>
        <!-- head -->
        <thead>
            <tr>
                <th>{{ __('Formation') }}</th>
                <th>{{ __('Number of courses') }}</th>
                <th>{{ __('Is finished') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Auth::user()->taken_formations as $item)
                <tr>
                    <td>
                        <a class="font-bold"
                            href="{{ route('formation.show', $item->formation->id) }}">{{ $item->formation->name }}</a>
                    </td>
                    <td>📚 {{ count($item->formation->courses) }}</td>
                    <td>
                        @if ($item->is_finished)
                            <i class="fa-solid fa-check text-success"></i>
                        @else
                            <i class="fa-solid fa-times text-error"></i>
                        @endif
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-admin.listing>
</x-layout>
