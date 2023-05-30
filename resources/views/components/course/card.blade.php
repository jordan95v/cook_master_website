@props(['course'])

<div class="flex flex-col">
    <a href="{{ route('courses.show', ['course' => $course->id]) }}">
        {{-- course image --}}
        <img src="{{ asset('storage/' . $course->image) }}"
            class="h-72 w-full object-cover transform transition hover:scale-110" alt="" />

        {{-- course content --}}
        <div class="pt-3 flex items-center justify-between">
            <p class="hover:link font-bold">{{ $course->name }}</p>
            <button class="btn btn-ghost btn-xs">
                <i class="fa-solid fa-kitchen-set me-1"></i>{{ __('Learn') }}
            </button>
        </div>
    </a>
</div>
