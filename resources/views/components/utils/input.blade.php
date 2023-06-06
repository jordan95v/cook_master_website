@props(['name', 'type', 'hint', 'target', 'error'])

@php
    if (isset($target)) {
        $value = $target[$name];
    } else {
        $value = old($name);
        if ($type == 'date') {
            $value = old('date', date('Y-m-d'));
        }
    }
@endphp

<input type="{{ $type }}" name="{{ $name }}" placeholder="{{ __($hint) }}" value="{{ $value }}"
    class="input input-bordered border-2 @error($name) border-error @enderror hover:input-primary w-full">

@if ($error == '1')
    <x-utils.form-error :name="$name" />
@endif
