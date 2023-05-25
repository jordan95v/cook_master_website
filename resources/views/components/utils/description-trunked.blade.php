@props(['target'])

@php
    $description = preg_replace('/<figure.*?<\/figure>(\s*<p>&nbsp;<\/p>)+/i', '', $target->description);
@endphp
<div class="py-5 text-gray-600">{!! Str::limit($description, $limit = 800) !!}</div>
