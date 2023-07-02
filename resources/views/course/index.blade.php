<x-layout title="Courses list" datatables=1>
    <x-admin.listing>
        <!-- head -->
        <thead>
            <tr>
                <th>id</th>
                <th>{{ __('Name') }}</th>
                <th>{{ __('Image') }}</th>
                <th>{{ __('Duration') }}</th>
                <th>{{ __('Difficulty') }}</th>
                @if (Auth::user()->isAdmin())
                    <th>{{ __('Created by') }}</th>
                @endif
                <th>{{ __('Actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr class="hover">
                    <th>{{ $course->id }}</th>
                    <td class="font-bold">
                        <a href="{{ route('courses.show', ['course' => $course->id]) }}" class="link hover:link-primary">
                            {{ $course->name }}
                        </a>
                    </td>
                    <td>
                        @if ($course->image)
                            <a href="{{ 'storage/' . $course->image }}" class="">
                                <i class="fa-solid fa-arrow-up-right-from-square ms-2"></i>
                            </a>
                        @endif
                    </td>
                    <td>{{ $course->duration }}</td>
                    <td>{{ $course->difficulty }} {{ str_repeat('⭐', $course->difficulty) }}</td>
                    @if (Auth::user()->isAdmin())
                        <x-admin.user-avatar :target="$course->user" />
                    @endif
                    <td>
                        <div class="dropdown dropdown-bottom dropdown-end">
                            <label tabindex="0" class="btn btn-circle btn-ghost">
                                <i class="fa-solid fa-gear"></i>
                            </label>
                            <ul tabindex="0" class="dropdown-content menu p-2 shadow bg-base-100 rounded-box w-52">
                                <!--Modify -->
                                <a href="{{ route('courses.edit', ['course' => $course->id]) }}"
                                    class="btn btn-primary">
                                    <i class="fa-solid fa-pen me-2"></i>{{ __('Modify') }}
                                </a>

                                <!-- Open delete modal -->
                                <label for="delete-modal-{{ $course->id }}" class="btn btn-error mt-2">
                                    <i class="fa-solid fa-trash me-2"></i>{{ __('Delete') }}
                                </label>
                            </ul>
                        </div>
                    </td>

                    <!-- Delete modal -->
                    <input type="checkbox" id="delete-modal-{{ $course->id }}" class="modal-toggle" />
                    <div class="modal modal-bottom sm:modal-middle">
                        <div class="modal-box">
                            <form action="{{ route('courses.destroy', ['course' => $course]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <label for="delete-modal-{{ $course->id }}"
                                    class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                <h3 class="font-bold text-lg mb-4">
                                    {{ __('Are you sure you wanna delete this course ?') }}</h3>

                                <div class="flex justify-center">
                                    <button class="btn btn-error w-3/5">
                                        <i class="fa-solid fa-trash me-2"></i>
                                        {{ __('Delete the course') }}
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
