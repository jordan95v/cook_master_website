<x-layout title="Home">
    @auth
    @else
        <div class="hero min-h-screen" style="background-image: url({{ asset('images/main_banner.png') }});">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-center text-neutral-content">
                <div class="max-w-md">
                    <h1 class="mb-5 text-5xl font-bold">{{ __('Together, we will give life your ideas.') }}</h1>
                    <p class="mb-5">{{ __('Discover what we have to offer') }}...</p>
                    <button class="btn btn-primary">{{ __('Create an account') }}</button>
                </div>
            </div>
        </div>
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 text-center lg:px-24 my-32">
            {{-- Store --}}
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/store.png') }}" class="w-36">
                <p class="text-2xl mt-10">
                    {{ __('Get yourself some high quality and professional branded kitchen tools') }}
                </p>
            </div>

            {{-- Formations --}}
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/formations.png') }}" class="w-36">
                <p class="text-2xl mt-10">
                    {{ __('Get teached by the best cooks in the world, and obtain certifications.') }}
                </p>
            </div>

            {{-- Events --}}
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/events.png') }}" class="w-36">
                <p class="text-2xl mt-10">
                    {{ __('Register to events, workshop, and more ..., also available on live streaming !') }}
                </p>
            </div>

            {{-- Courses --}}
            <div class="flex flex-col items-center">
                <img src="{{ asset('images/courses.png') }}" class="w-36">
                <p class="text-2xl mt-10">
                    {{ __('Learn how to cook, obtain access to lots of online courses !') }}
                </p>
            </div>
        </div>

        <div class="hero min-h-screen" style="background-image: url({{ asset('images/home_form.jpg') }});">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-center text-neutral-content">
                <div class="max-w-md">
                    <h2 class="mb-5 text-5xl font-bold">{{ __('Become a Provider') }}</h2>
                    <p class="mb-5">
                        {{ __('Are you a cook, a teacher, or a professional in the food industry?') }}</p>
                    <x-utils.card class="w-full text-black bg-white">
                        <form action="{{ route('email-provider') }}" method="POST" class="card-body rounded-xl">
                            @csrf
                            {{-- Email --}}
                            <x-utils.input type="text" name="email" hint="Email" error=1 />

                            {{-- Phone number --}}
                            <x-utils.input type="text" name="phone_number" hint="06.00.00.00.00" error=1 />

                            {{-- Description --}}
                            <textarea name="description" type="textarea" rows="5" placeholder="{{ __('Description') }}"
                                class="textarea textarea-bordered border-2 @error('description') border-error @enderror">
                                {{ old('description') }}
                            </textarea>
                            @error('description')
                                <span class="text-red-500">{{ $message }}</span>
                            @enderror

                            <button class="btn btn-primary">{{ __('Send') }}</button>
                        </form>
                    </x-utils.card>
                </div>
            </div>
        </div>
    @endauth
</x-layout>
