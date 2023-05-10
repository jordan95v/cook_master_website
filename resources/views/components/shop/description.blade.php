@props(['content', 'title'])

<div class="px-4 pt-10 lg:px-24 pb-10" id="full-description">
    <h2 class="text-5xl pb-12 font-bold">{{ __($title) }}</h2>
    {!! $content !!}
</div>
