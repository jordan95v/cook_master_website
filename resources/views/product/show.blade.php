<x-layout title="{!! $product->name !!}">
    <div class="grid grid-cols-1 lg:grid-cols-2 justify-center align-center gap-10 p-5 lg:px-24 lg:p-12">
        <div class="mx-auto">
            <img src="{{ asset('storage/' . $product->image) }}" class="object-cover h-full rounded-xl" />
        </div>
        <div class="lg:py-20">
            <p class="font-bold font-mono text-2xl lg:text-5xl">
                {{ $product->name }} -
                <a href="{{ route('brand.show', ['brand' => $product->brand->id]) }}" class="link hover:link-primary">
                    {{ $product->brand->name }}
                </a>
            </p>
            {{-- Add rating to product + tag for retrieving other product --}}
            <div class="rating pt-2">
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
                <input type="radio" disabled name="rating-2" class="mask mask-star-2 bg-orange-400" />
            </div>
            <p class="italic text-2xl pt-5 text-primary">{{ $product->price }} €</p>
            <x-utils.description-trunked :target="$product" limit="800" />
            <a href="#full-description" class="link hover:link-primary">{{ __('Show more') }}</a>

            <form action="{{ route('order.store', ['product' => $product->id]) }}" method="post" class="mt-10">
                @csrf
                <button class="btn btn-primary w-full lg:w-96">
                    <i class="fa-solid fa-bag-shopping me-2"></i>{{ __('Buy') }}
                </button>
            </form>
        </div>
    </div>

    @if (count($seeblings) > 0)
        <div class="mt-10 lg:mt-0">
            <x-shop.grid :products="$seeblings" name="Same brand products" />
        </div>
    @endif

    {{-- Product's full description --}}
    <div class="grid grid-cols-1 lg:grid-cols-2">
        <x-shop.description :content="$product->description" title="Product description" />

        <div class="lg:pe-20">
            <x-utils.card class="w-full">
                <form action="{{ route('comment.store') }}" method="post" class="card-body">
                    @csrf
                    <h2 class="card-title">{{ __('Ajouter un commentaire') }}</h2>

                    {{-- Product id --}}
                    <input type="hidden" name="product_id" value="{{ $product->id }}">

                    {{-- Rating select --}}
                    <select class="select select-bordered w-full" name="rating">
                        <option disabled selected>{{ __('⭐ Rating') }}</option>
                        @foreach (array_reverse(range(1, 5)) as $rating)
                            <option value="{{ $rating }}" @if (old('rating') == $rating) selected @endif>
                                {{ $rating }} {{ str_repeat('⭐', $rating) }}
                            </option>
                        @endforeach
                    </select>
                    <x-utils.form-error name="rating" />

                    {{-- Comment text area --}}
                    <textarea name="comment" cols="30" rows="10" class="p-5 border-2 mt-2 rounded-xl"
                        placeholder="{{ __("Enter the comment's content") }}">
                        {{ old('comment') }}
                    </textarea>
                    <x-utils.form-error name="comment" />

                    <button class="btn btn-primary w-full">{{ __('Envoyer') }}</button>
                </form>
            </x-utils.card>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-4 gap-5 lg:px-24">
        @foreach ($product->comments as $comment)
            <x-utils.card class="w-full">
                <div class="card-body">
                    <div class="flex items-center">
                        <x-admin.user-avatar :target="$comment->user" />
                        <p class="text-end">{{ str_repeat('⭐', $comment->rating) }}</p>
                    </div>
                    <p class="my-4 font-mono">{{ Str::limit($comment->comment, 255) }}</p>
                    @auth
                        @if (Auth::user()->is($comment->user))
                            <form action="{{ route('comment.destroy', ['comment' => $comment->id]) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-error w-full">{{ __('Delete') }}</button>
                            </form>
                        @endif
                    @endauth
                </div>
            </x-utils.card>
        @endforeach
    </div>
</x-layout>
