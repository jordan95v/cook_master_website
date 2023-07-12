@php
    // Do a dictionnary containing filter and their value in the url
    $sorts = [
        'new' => __('Newest'),
        'old' => __('Oldest'),
        'up' => __('Ascending price'),
        'down' => __('Descending price'),
    ];
@endphp


<x-layout title="Store">
    <div class="lg:p-5 mb-5">
        <img src="{{ asset('images/food-banner.jpg') }}" alt="" class="rounded-xl max-h-56 object-cover w-full">
    </div>
    <form action="{{ route('store') }}" method="get" class="flex justify-center">
        <div class="grid md:grid-cols-4 grid-cols-1 gap-4">
            <input type="text" name="search" placeholder="{{ __('Search ...') }}"
                class="input input-bordered w-full max-w-xs" value="{{ old('search') }}">
            <select class="select select-bordered w-full max-w-xs" name="brand">
                <option disabled selected>{{ __('Select a brand') }}</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @if ($requestBrand == $brand->id) selected @endif>
                        {{ $brand->name }}
                    </option>
                @endforeach
            </select>
            <select class="select select-bordered w-full max-w-xs" name="filter">
                <option disabled selected>{{ __('Sort by') }} </option>
                @foreach ($sorts as $key => $sort)
                    <option value="{{ $key }}" @if ($filter == $key) selected @endif>
                        {{ $sort }}
                    </option>
                @endforeach
            </select>
            <button type="submit" class="btn btn-neutral hover:btn-primary">{{ __('Filter') }}</button>
        </div>
    </form>
    <div class="text-center p-5">
        <div class="pt-5 grid 2xl:grid-cols-5 md:grid-cols-3 grid-cols-1 gap-10 lg:px-16 lg:mt-10">
            @foreach ($products as $product)
                <x-shop.card :product="$product" />
            @endforeach
        </div>
    </div>

    <div class="px-20 pt-10">
        {{ $products->links() }}
    </div>
</x-layout>
