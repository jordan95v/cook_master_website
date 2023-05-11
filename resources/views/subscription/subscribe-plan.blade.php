<x-layout title="{{ __('Subscription') }} {{ ucfirst($plan) }}">
    <div class="grid grid-cols-1 md:grid-cols-2">
        @if ($plan == 'starter')
            <div class="my-auto mx-auto">
                <img src="{{ asset('images/subscribe.png') }}" alt="">
            </div>
        @endif
        {{-- I don't use the card component here --}}
        <div class="my-auto">
            <x-utils.card-grid>
                <form class="card-body" action="{{ route('subscription.subscribe') }}" method="post" id="payment-form">
                    @csrf
                    <input type="hidden" name="plan" value="{{ $plan }}">

                    <h2 class="font-bold text-2xl text-center pb-0">
                        <i class="fa-solid fa-bolt-lightning me-2" style="color: #f8e45c;"></i>
                        {{ __('Subscribe to') }} {{ ucfirst($plan) }} !
                    </h2>
                    <select class="select select-bordered w-full mt-5" name="recurring">
                        <option disabled selected>{{ __('Choose the recurring period') }}</option>
                        <option value="month">{{ __('Monthly') }} - {{ $subscriptions['month'] }}€ par mois</option>
                        <option value="year">{{ __('Yearly') }} - {{ $subscriptions['year'] }}€ par an</option>
                    </select>
                    <small class="text-center text-gray-400 mb-10">
                        {{ __('You can always change when the subscription period ends.') }}
                    </small>

                    <x-shop.advantages text="No pubs" />
                    <x-shop.advantages text="Comment / Leave a review" />
                    <x-shop.advantages text="Tchat with a Chef" />
                    <x-shop.advantages text="5% off on all products" />
                    <x-shop.advantages text="Invitations to exclusive events" />

                    @if ($plan == 'starter')
                        <x-shop.advantages text="Access to 5 courses per day" />
                        <x-shop.advantages text="Free shipping in drop-off point" />
                        <x-shop.advantages text="5€ for every 3 people subscribed with your link" />
                    @elseif ($plan == 'pro')
                        <x-shop.advantages text="Illimited access to courses" />
                        <x-shop.advantages text="Free shipping everywhere" />
                        <x-shop.advantages text="5€ for every people subscribed with your link" />
                        <x-shop.advantages text="3% on new user's first command" />
                        <x-shop.advantages text="10% on yearly plan" />
                    @endif

                    <p class="mt-4 text-gray-400">
                        {{ __('By paying, you give up on your right of withdrawal. You can cancel your subscription at any time') }}
                    </p>

                    {{-- Payment form --}}
                    <h2 class="font-bold justify-center flex text-2xl py-4">Paiement</h2>
                    <div class="grid grild-cols-1 lg:grid-cols-2 my-2 gap-2">
                        <x-utils.input type="text" name="address" hint="Address" error=0 />
                        <x-utils.input type="text" name="zipcode" hint="Postal code" error=0 />
                    </div>
                    <x-utils.form-error name="address" />
                    <x-utils.form-error name="zipcode" />

                    <x-utils.input type="text" name="city" hint="City" error=1 />
                    <x-shop.stripe />
                </form>
            </x-utils.card-grid>
        </div>

        @if ($plan == 'pro')
            <div class="my-auto-mx-auto">
                <img src="{{ asset('images/pro-plan.png') }}" alt="">
            </div>
        @endif
    </div>
</x-layout>
