@props(['name'])

<select class="select select-bordered w-full @error($name) border-2 border-error @enderror" name="{{ $name }}">
    {{ $slot }}
</select>
