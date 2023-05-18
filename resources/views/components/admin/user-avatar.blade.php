@props(['target'])

<td class="flex items-center">
    <div class="avatar">
        <div class="rounded-full w-12 h-12 me-2">
            <img src="{{ $target->image ?? false ? asset('storage/' . $target->image) : asset('images/user.png') }}" />
        </div>
    </div>
    {{ $target->name }}
</td>
