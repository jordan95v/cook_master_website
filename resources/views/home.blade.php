<x-layout title="Home">
    {{ Auth::user()->invoices ?? false }}
</x-layout>
