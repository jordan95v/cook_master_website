<x-layout title="{{ $course->name }}">
    <div class="grid grid-cols-1 lg:grid-cols-2 justify-center align-center gap-10 p-5 lg:px-24 lg:p-12">
        <div class="mx-auto">
            <img src="{{ asset('storage/' . $course->image) }}" class="object-cover h-full rounded-xl" />
        </div>
        <div class="lg:py-20 lg:text-center">
            <p class="font-bold font-mono text-2xl lg:text-5xl me-10">
                {{ $course->name }}
            </p>
            <small>
                {{ __('Recepy uploaded on :date', ['date' => $course->created_at->format('d/m/Y')]) }}
            </small>

            <p class="text-xl pt-6">
                <span class="font-bold italic">{{ __('Difficulty') }}</span>
                - {{ $course->difficulty }} {{ str_repeat('⭐', $course->difficulty) }}
            </p>
            <p class="text-xl pt-7">
                <span class="font-bold italic">{{ __('Duration') }}</span> - {{ $course->duration }} min
            </p>

            <div class="flex lg:justify-center items-center pt-5">
                <p class="text-xl font-bold me-5">
                    {{ __('Creator') }}:
                </p>
                <x-admin.user-avatar :target="$course->user" />
            </div>

            <div class="pt-10">
                <button class="btn btn-primary w-full lg:w-96">{{ __('I like this recepy !') }}</button>
            </div>
        </div>
    </div>
    @if (count($random_courses) > 0)
        <div class="mt-10 lg:mt-0">
            <x-course.grid :courses="$random_courses" name="Some courses that might interest you" />
        </div>
    @endif

    <x-shop.description :content="$course->content" title="Course's content" />
</x-layout>