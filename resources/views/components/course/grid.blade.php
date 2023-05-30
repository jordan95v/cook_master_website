@props(['courses', 'name'])

<div class="text-center lg:px-16 lg:mx-1">
    <h2 class="text-5xl font-bold">{{ __($name) }}</h2>
    <div class="py-10 grid lg:grid-cols-5 md:grid-cols-2 grid-cols-1 gap-20 px-10 lg:px-6 lg:mt-10">
        @foreach ($courses as $course)
            <x-course.card :course="$course" />
        @endforeach
    </div>
</div>
