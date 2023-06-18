<x-layout title="{!! $formation->name !!}">
    <div class="grid grid-cols-1 lg:grid-cols-2 justify-center align-center gap-10 p-5 lg:px-24 lg:p-12">
        <div class="mx-auto">
            <img src="{{ asset('storage/' . $formation->image) }}" class="object-cover h-full rounded-xl" />
        </div>
        <div class="lg:py-20">
            <p class="font-bold font-mono text-2xl lg:text-5xl">{{ $formation->name }}</p>
            <x-utils.description-trunked :target="$formation" limit="800" />
            <a href="#full-description" class="link hover:link-primary">{{ __('Show more') }}</a>

            <form action="{{ route('formation.get_certification', $formation) }}" method="post" class="mt-10">
                @csrf
                <button class="btn btn-primary w-full lg:w-96">
                    <i class="fa-solid fa-bag-shopping me-2"></i>{{ __('Get the certification') }}
                </button>
            </form>
        </div>
    </div>


    {{-- Product's full description --}}
    <div class="grid grid-cols-1 lg:grid-cols-2">
        <div class="lg:ps-20">
            <x-utils.card class="w-full">
                <div class="card-body">
                    <h2 class="card-title">{{ __('Courses list') }}</h2>

                    {{-- Add courses list here --}}
                    @foreach ($formation->courses as $item)
                        <div class="collapse collapse-arrow bg-base-200 rounded-xl">
                            <input type="checkbox" />
                            <div class="collapse-title text-xl font-medium">
                                {{ str_repeat('⭐', $item->course->difficulty) }} {{ $item->course->name }}
                                @foreach (Auth::user()->finished_courses as $finished_course)
                                    @if ($finished_course->course->id == $item->course->id)
                                        <i class="ms-2 fa-solid fa-check text-success"></i>
                                    @endif
                                @endforeach
                            </div>
                            <div class="collapse-content">
                                <p>{!! Str::limit($item->course->content, 200) !!}</p>
                                <a class="btn btn-neutral mt-4" href="{{ route('courses.show', $item->course) }}">
                                    {{ __('Go to to course') }}
                                </a>
                            </div>
                        </div>
                    @endforeach

                    @if (Auth::user()->is($formation->user) || Auth::user()->isAdmin())
                        <a href="{{ route('formation.add_courses', $formation) }}"
                            class="items-center btn btn-primary mt-4">
                            {{ __('Add courses') }}<i class="ms-2 fa-solid fa-plus text-success"></i>
                        </a>
                    @endif
                </div>
            </x-utils.card>
        </div>

        <x-shop.description :content="$formation->description" title="Formation description" />
    </div>
</x-layout>
