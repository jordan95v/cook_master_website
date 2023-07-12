@php
    $user = Auth::user();
@endphp

<div class="stats stats-vertical lg:stats-horizontal shadow">
    <div class="stat">
        <div class="stat-figure text-secondary text-2xl">
            📚
        </div>
        <div class="stat-title">{{ __('Courses finished') }}</div>
        <div class="stat-value">{{ $user->finished_courses->where('is_finished', true)->count() }}</div>
        <div class="stat-desc">{{ $user->created_at->format('d M y') }} - {{ now()->format('d M y') }}</div>
    </div>

    <div class="stat">
        <div class="stat-figure text-secondary text-2xl">
            💰
        </div>
        <div class="stat-title">{{ __('Total orders') }}</div>
        <div class="stat-value">{{ $user->orderInvoices->count() }}</div>
        <div class="stat-desc">
            ~
            @if ($user->orderInvoices->count() == 0)
                0
            @else
                {{ $user->orderInvoices->sum('price') / $user->orderInvoices->count() }}
            @endif
            € / {{ __('order') }}
        </div>
    </div>

    <div class="stat">
        <div class="stat-figure text-secondary text-2xl">
            🎩
        </div>
        <div class="stat-title">{{ __('Formations taken') }}</div>
        <div class="stat-value">{{ $user->taken_formations->count() }}</div>
        <div class="stat-desc">
            {{ $user->taken_formations->where('is_finished', true)->count() }} {{ __('finished') }}
        </div>
    </div>
</div>
