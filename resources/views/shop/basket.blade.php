<x-layout title="{{ __('Basket - Payment') }}">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <img src="{{ asset('images/stripe.png') }}" class="my-auto" alt="">
        {{-- I don't use the card component here --}}
        <x-utils.card-grid>
            <div class="card-body">
                <h2 class="card-title justify-center flex text-2xl pb-4">{{ __('Command overview') }}</h2>

                {{-- Shop product card --}}
                @forelse (Auth::user()->orders as $item)
                    <x-shop.basket-card :item="$item" />
                @empty
                    <p class="text-center p-5">{{ __('You have no product in your basket.') }}</p>
                @endforelse


                {{-- Payment form --}}
                @if (count(Auth::user()->orders))
                    <x-shop.basket-total />
                    <h2 class="card-title justify-center flex text-2xl pb-4">{{ __('Payment') }}</h2>
                    <form action="{{ route('order.pay') }}" method="post" id="payment-form">
                        @csrf
                        <div class="grid grild-cols-1 lg:grid-cols-2 my-2 gap-2">
                            <x-utils.input type="text" name="address" hint="{{ __('Address') }}" error=0 />
                            <x-utils.input type="text" name="zipcode" hint="{{ __('Postal code') }}" error=0 />
                        </div>
                        <x-utils.form-error name="address" />
                        <x-utils.form-error name="zipcode" />

                        <x-utils.input type="text" name="city" hint="{{ __('City') }}" error=1 />
                        <x-shop.stripe id=1 />
                    </form>
                @endif
            </div>
        </x-utils.card-grid>
    </div>
</x-layout>
