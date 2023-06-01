<x-layout title="All courses" datatables=1>
    <x-admin.listing>
        <thead class="hidden">
            <tr>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @foreach ($courses as $course)
                <tr>
                    <td>
                        <div class="lg:flex lg:justify-center">
                            <div class="card lg:card-side border-2">
                                <img src="{{ asset('storage/' . $course->image) }}" class="rounded-s w-96">
                                <div class="card-body">
                                    <h4 class="font-bold text-2xl card-title">{{ $course->name }}</h4>
                                    <p class="mt-4">
                                        ⏰ <span class="font-bold">{{ __('Duration') }}</span>:
                                        {{ $course->duration }}min<br>
                                        🦾 <span class="font-bold">{{ __('Difficulty') }}</span>:
                                        {{ $course->difficulty }} {{ str_repeat('⭐', $course->difficulty) }}
                                    </p>
                                    <a href="{{ route('courses.show', ['course' => $course->id]) }}"
                                        class="btn btn-primary mt-5 lg:w-96">
                                        Access this course
                                    </a>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </x-admin.listing>
</x-layout>
