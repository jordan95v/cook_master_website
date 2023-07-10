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
        {{-- Become a provider --}}
        <section class="bg-white" style="background-image: url('{{ asset('images/home_form.jpg') }}'); background-size: cover; background-position: center;"">
            <div class="py-8 lg:py-16 px-4 mx-auto max-w-screen-md">
                <h2 class="mb-4 text-4xl font-extrabold text-center text-white">{{__('Become a Provider')}}</h2>
                <p class="mb-8 lg:mb-16 font-light text-center text-white sm:text-xl">{{ __('Are you a cook, a teacher, or a professional in the food industry?') }}</p>
                <div class="card-body bg-white rounded-lg ">
                    <form>
                        <div class="form-control">
                            {{-- Email --}}
                            <label class="label">
                                <span class="label-text">Email</span>
                            </label>
                            <input type="text" placeholder="email" class="input input-bordered mb-5" />
                            {{-- Phone number --}}
                            <label class="label">
                                <span class="label-text">Phone number</span>
                            </label>
                            <input type="text" placeholder="06...." class="input input-bordered mb-5" />
                            {{-- Description --}}
                            <label class="label">
                                <span class="label-text">Talk about you</span>
                            </label>
                            <textarea type="textarea" placeholder="blablabla" class="input input-bordered mb-5" >
                            </textarea>
                            <button class="btn btn-primary">Send</button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    @endauth
</x-layout>
