<x-layout title="Add course to formation" datatables=1>
    <form action="{{ route('formation.store_courses', $formation) }}" method="post">
        @csrf
        <x-admin.listing>
            <!-- head -->
            <thead>
                <tr>
                    <th>{{ __('Action') }}</th>
                    <th>{{ __('Name') }}</th>
                    <th>{{ __('Duration') }}</th>
                    <th>{{ __('Difficulty') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($courses as $course)
                    <tr class="hover">
                        <th>
                            @php
                                $course_in_array = false;
                                foreach ($formation_courses_ids as $key => $value) {
                                    if ($value == $course->id) {
                                        $course_in_array = true;
                                    }
                                }
                            @endphp
                            <input type="checkbox" name="courses[]" value="{{ $course->id }}"
                                @if ($course_in_array) checked @endif class="checkbox" />
                        </th>
                        <td class="font-bold">
                            <a href="{{ route('courses.show', $course) }}" class="link hover:link-primary">
                                {{ $course->name }}
                            </a>
                        </td>
                        <td>{{ $course->duration }}</td>
                        <td>{{ $course->difficulty }} {{ str_repeat('⭐', $course->difficulty) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </x-admin.listing>
        <div class="text-end lg:px-56">
            <button type="submit" class="w-full lg:w-96 mt-4 lg:mt-0 btn btn-primary">
                <i class="fa-solid fa-plus me-2"></i>{{ __('Add') }}
            </button>
        </div>
    </form>
</x-layout>
