@props(['name', 'type', 'hint', 'target', 'error'])

@php
    if (isset($target)) {
        $value = $target[$name];
    } else {
        $value = old($name);
    }
@endphp

<input type="{{ $type }}" name="{{ $name }}" placeholder="{{ $hint }}" value="{{ $value }}"
    class="input input-bordered border-2 @error($name) border-error @enderror hover:input-primary w-full">

@if ($error == '1')
    @error($name)
        <p class="text-red-600 text-sm">{{ $message }}</p>
    @enderror
@endif
