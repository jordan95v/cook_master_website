<x-layout title="Abonnement {{ ucfirst($plan) }}">
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
                        Abonnez vous à la formule {{ ucfirst($plan) }} !
                    </h2>
                    <select class="select select-bordered w-full mt-5" name="recurring">
                        <option disabled selected>Choissisez la récurrence</option>
                        <option value="month">Mensuel - {{ $subscriptions['month'] }}€ par mois</option>
                        <option value="year">Annuel - {{ $subscriptions['year'] }}€ par an</option>
                    </select>
                    <small class="text-center text-gray-400 mb-10">
                        Vous pourrez toujours changer une fois l'abonnement fini
                    </small>

                    <x-shop.advantages text="Aucune pubs" />
                    <x-shop.advantages text="Commenter / laisser un avis" />
                    <x-shop.advantages text="Tchat avec un chef" />
                    <x-shop.advantages text="5% de réduction sur la boutique" />
                    <x-shop.advantages text="Invitation à des évenements" />

                    @if ($plan == 'starter')
                        <x-shop.advantages text="Accès à 5 leçons par jour 🏃‍♂️" />
                        <x-shop.advantages text="Livraison gratuite en point relais" />
                        <x-shop.advantages text="5€ tout les 3 inscrits" />
                    @elseif ($plan == 'pro')
                        <x-shop.advantages text="Accès illimité aux leçons 🏍" />
                        <x-shop.advantages text="Livraison gratuite partout" />
                        <x-shop.advantages text="5€ pour chaque nouvel inscrit" />
                        <x-shop.advantages text="3% sur la première commande du nouvel inscrit" />
                        <x-shop.advantages text="Réduction de 10€ sur le tarif annuel" />
                    @endif

                    {{-- Payment form --}}
                    <h2 class="font-bold justify-center flex text-2xl py-4">Paiement</h2>
                    <div class="grid grild-cols-1 lg:grid-cols-2 my-2 gap-2">
                        <x-utils.input type="text" name="address" hint="Adresse" error=0 />
                        <x-utils.input type="text" name="zipcode" hint="Code postal" error=0 />
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
