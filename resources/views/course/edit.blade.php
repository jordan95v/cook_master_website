<x-layout title="{{ __('Edit a course') }}">
    <div class="grid grid-cols-1 lg:grid-cols-2">
        <div class="my-auto">
            <x-utils.card-grid>
                <form action="{{ route('courses.update', ['course' => $course->id]) }}" method="post"
                    enctype="multipart/form-data" class="card-body">
                    @csrf
                    @method('PUT')
                    <h2 class="card-title justify-center flex text-2xl pb-2">{{ __('Edit a course') }}</h2>

                    {{-- Name --}}
                    <x-utils.input name="name" type="text" hint="Course name" error="1" :target="$course" />

                    {{-- Image --}}
                    <div class="form-control w-full">
                        <label class="label">
                            <span class="label-text-alt">{{ __('Course image') }} (1280x720)</span>
                        </label>
                        <input type="file" name="image"
                            class="file-input file-input-bordered border-2 w-full mb-2 @error('image') border-error @enderror" />
                        <x-utils.form-error name="image" />
                        <label class="label">
                            <span class="label-text-alt">{{ __('Actual image') }}</span>
                        </label>
                        <img src="{{ asset('storage/' . $course->image) }}">
                    </div>

                    {{-- Duration and difficulty --}}
                    <div class="grid lg:grid-cols-2 grid-cols-1 gap-2 pb-2">
                        <x-utils.input name="duration" type="text" hint="Course duration" error="0"
                            :target="$course" />
                        <select class="select select-bordered w-full" name="difficulty">
                            <option disabled selected>{{ __('Choose the difficulty level') }}</option>
                            @foreach (range(1, 5) as $difficulty)
                                <option value="{{ $difficulty }}" @if ($course->difficulty == $difficulty) selected @endif>
                                    {{ $difficulty }} {{ str_repeat('⭐', $difficulty) }}
                                </option>
                            @endforeach
                        </select>
                        <x-utils.form-error name="duration" />
                        <x-utils.form-error name="difficulty" />
                    </div>

                    {{-- Description --}}
                    <textarea id="editor" class="textarea textarea-bordered border-2 @error('content') border-error @enderror" rows=4
                        name="content" placeholder="{{ __('Course content') }}">{{ $course->content }}</textarea>
                    <x-utils.form-error name="content" />

                    <div class="card-actions justify-center">
                        <button class="btn btn-primary w-full">{{ __('Edit a course') }}</button>
                    </div>
                </form>
            </x-utils.card-grid>
        </div>
        <div class="my-auto mx-auto">
            <img src="{{ asset('images/add_courses.png') }}" alt="">
        </div>
    </div>
    <x-utils.editor />
</x-layout>
