@props(['target', 'limit'])

@php
    $description = preg_replace('/<figure.*<\/figure>(?:(<p>&nbsp;<\/p>)*)(.)/i', '$2', $target->description);
@endphp
<div class="py-5 text-gray-600">{!! Str::limit($description, $limit = $limit) !!}</div>
