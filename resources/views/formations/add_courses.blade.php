<x-layout title="Add course to formation" datatables=1>
    <x-admin.listing>
        <!-- head -->
        <thead>
            <tr>
                <th>{{ __('Action') }}</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Description') }}</th>
                <th>{{ __('Difficulty') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach (Auth::user()->courses as $course)
                <tr class="hover">
                    <th>
                        <input type="checkbox" name="courses[]" class="checkbox" />
                    </th>
                    <td class="font-bold">
                        <a href="{{ route('courses.show', $course) }}" class="link hover:link-primary">
                            {{ $course->name }}
                        </a>
                    </td>
                    <td>{{ Str::limit($course->description, 30) }}</td>
                    <td>{{ $course->difficulty }} {{ str_repeat('⭐', $course->difficulty) }}</td>
                </tr>
            @endforeach
        </tbody>
    </x-admin.listing>
</x-layout>
