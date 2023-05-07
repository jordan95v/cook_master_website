<div class="flex justify-center my-10">
    <div {{ $attributes->merge(['class' => 'card shadow-xl border-2']) }}>
        {{ $slot }}
    </div>
</div>
