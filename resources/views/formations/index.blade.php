@php
    // Do a dictionnary containing filter and their value in the url
    $sorts = [
        'up_difficulty' => __('Ascending difficulty'),
        'down_difficulty' => __('Descending difficulty'),
        'up_duration' => __('Ascending duration'),
        'down_duration' => __('Descending duration'),
    ];
@endphp

<x-layout title="All formations">
    <div class="lg:p-5 mb-5">
        <img src="{{ asset('images/formation_banner.jpg') }}" alt=""
            class="rounded-xl max-h-56 object-cover w-full">
    </div>

    <div class="grid 2xl:grid-cols-2 grid-cols-1 gap-6 pt-10 lg:px-24">
        @foreach ($formations as $formation)
            <div class="card lg:card-side border-2">
                <img src="{{ asset('storage/' . $formation->image) }}" class="rounded-s w-96">
                <div class="card-body">
                    <h4 class="font-bold text-2xl card-title">{{ $formation->name }}</h4>
                    <p>🧮 {{ __('Number of courses') }} 👉 {{ count($formation->courses) }}</p>
                    <p>
                        🙋 {{ __('This formation have been taken') }} 👉 {{ count($formation->formation_users) }}
                        {{ __('times') }}
                    </p>
                    <a href="{{ route('formation.show', $formation) }}" class="btn btn-primary mt-5 lg:w-96">
                        {{ __('Access this formation') }}
                    </a>
                </div>
            </div>
        @endforeach
    </div>

    <div class="px-20 pt-10">
        {{ $formations->links() }}
    </div>
</x-layout>
