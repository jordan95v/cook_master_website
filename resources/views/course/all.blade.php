@php
    // Do a dictionnary containing filter and their value in the url
    $sorts = [
        'up_difficulty' => __('Ascending difficulty'),
        'down_difficulty' => __('Descending difficulty'),
        'up_duration' => __('Ascending duration'),
        'down_duration' => __('Descending duration'),
    ];
@endphp

<x-layout title="All courses">
    <div class="p-5 mb-5">
        <img src="{{ asset('images/courses_banner.jpeg') }}" alt=""
            class="rounded-xl max-h-56 object-cover w-full">
    </div>
    <form action="{{ route('courses.all') }}" method="get" class="flex justify-center">
        <div class="grid md:grid-cols-2 grid-cols-1 gap-4">
            <select class="select select-bordered w-full max-w-xs" name="filter">
                <option disabled selected>{{ __('Sort by') }} </option>
                @foreach ($sorts as $key => $sort)
                    <option value="{{ $key }}" @if ($filter == $key) selected @endif>
                        {{ $sort }}</option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-neutral hover:btn-primary">{{ __('Filter') }}</button>
        </div>
    </form>

    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6 pt-10 px-24">
        @foreach ($courses as $course)
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
                        {{ __('Access this course') }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="px-20 pt-10">
        {{ $courses->links() }}
    </div>
</x-layout>
