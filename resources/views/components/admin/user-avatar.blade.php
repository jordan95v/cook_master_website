@props(['target'])

<td class="flex items-center">
    <div class="avatar">
        <div class="rounded-full w-12 h-12 me-2">
            <img src="{{ asset('storage/users-avatar/' . $target->avatar) }}" />
        </div>
    </div>
    {{ $target->name }}
</td>
