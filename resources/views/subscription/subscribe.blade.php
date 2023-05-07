<x-layout title="Abonnement">
    @if (Auth::user()->isSubscribed())
        <x-utils.card class="w-full lg:w-1/3 mb-5">
            <div class="card-body">
                @php
                    [$subscription, $plan] = Auth::user()->getSubscription();
                @endphp
                <h2 class="card-title text-2xl font-bold mx-auto">Mon abonnement</h2>
                <div class="grid grid-cols-1 lg:grid-cols-5 mt-4">
                    {{-- Subscription image --}}
                    <div class="flex flex-col my-auto col">
                        <img src="{{ asset('images/' . $subscription->name . '.png') }}"alt="">
                        <p class="font-bold text-xl text-center">{{ strtoupper($subscription->name) }}</p>
                    </div>

                    {{-- Subscription infos --}}
                    <div class="w-full ps-4 col-span-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center">
                            <p>Date d'abonnement:</p>
                            <span class="font-bold bg-gray-300 w-full rounded-xl p-2">
                                {{ $subscription->created_at->format('d M Y') }}
                            </span>


                            <p class="font-mono">Récurrence:</p>
                            <span class="font-bold bg-gray-300 w-full rounded-xl p-2">
                                {{ ucfirst($plan->plan->interval) }}
                            </span>

                            <p>Prix de l'abonnement:</p>
                            <span class="font-bold bg-gray-300 w-full rounded-xl p-2">
                                {{ $plan->plan->amount_decimal / 100 }}€
                            </span>

                            @if ($subscription->ends_at)
                                <p>Date de fin d'abonnement:</p>
                                <span class="font-bold bg-gray-300 w-full rounded-xl p-2">
                                    {{ $subscription->ends_at->format('d M Y') }}
                                </span>
                            @else
                                <p class="font-mono">Prochain paiement:</p>
                                <span class="font-bold bg-gray-300 w-full rounded-xl p-2">
                                    {{ Auth::user()->getNextBillingDate() }}
                                </span>
                            @endif
                        </div>

                        @if ($subscription->ends_at)
                            <form action="{{ route('subscription.resume') }}" class="mt-4" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-full">
                                    Reprendre l'abonnement
                                </button>
                            </form>
                        @else
                            <!-- The button to open modal -->
                            <label for="cancel" class="btn btn-error mt-4 w-full">Annuler mon abonnement</label>

                            <!-- Put this part before </body> tag -->
                            <input type="checkbox" id="cancel" class="modal-toggle" />
                            <div class="modal">
                                <div class="modal-box relative bg-red-200">
                                    <label for="cancel" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                    <form action="{{ route('subscription.cancel') }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <div class="text-center">
                                            <p class="text-red-500 font-bold">Attention !</p>
                                            <p>En cliquant sur le bouton ci-dessous, vous allez annuler votre
                                                abonnement.
                                            </p>
                                        </div>
                                        <button type="submit" class="btn btn-error max-w-lg w-full mt-4">
                                            Annuler mon abonnement
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </x-utils.card>
    @endif

    <x-utils.card class="w-full lg:w-2/3">
        <div class="card-body">
            <h2 class="font-bold text-2xl text-center">Abonnez vous !</h2>
            <small class="text-center text-gray-400">Et profitez ainsi de nombreux avantages ...</small>

            {{-- Subscription table --}}
            <div class="overflow-x-auto mt-10">
                <table class="table w-full text-center">
                    <!-- head -->
                    <thead>
                        <tr>
                            <td>Avantages</td>
                            <th>
                                <img src="{{ asset('images/free.png') }}" alt="" class="mx-auto">
                                <span class="text-xl">Free</span>
                            </th>
                            <th>
                                <img src="{{ asset('images/starter.png') }}" alt="" class="mx-auto">
                                <span class="text-xl">Starter</span>
                            </th>
                            <th>
                                <img src="{{ asset('images/pro.png') }}" alt="" class="mx-auto">
                                <span class="text-xl">Pro</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Pubs --}}
                        <tr>
                            <td class="font-semibold">Pubs</td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                        </tr>

                        {{-- Comment --}}
                        <tr>
                            <td class="font-semibold">Commenter / avis</td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Access to course --}}
                        <tr>
                            <td class="font-semibold">Accès aux leçons</td>
                            <td>1 / jour 🐢</td>
                            <td>5 / jour 🏃‍♂️</td>
                            <td>Pas de limites 🏍</td>
                        </tr>

                        {{-- Tchat with chef --}}
                        <tr>
                            <td class="font-semibold">Accès à un tchat avec un chef</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Coupon --}}
                        <tr>
                            <td class="font-semibold">5% de réduction sur la boutique</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Shipping --}}
                        <tr>
                            <td class="font-semibold">Livraison gratuite</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td>
                                <i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i>
                                Points relais uniquement
                            </td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Kitchen location --}}
                        <tr>
                            <td class="font-semibold">Location d'espace de cuisine</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Event --}}
                        <tr>
                            <td class="font-semibold">Invitation à des événements exclusif</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Cooptation --}}
                        <tr>
                            <td class="font-semibold">Cooptation nouvel inscrit</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td>
                                <i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i><br>
                                5€ tout les 3 nouveaux inscrits <br>(hors formule Free)
                            </td>
                            <td>
                                <i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i><br>
                                5€ pour chaque inscrit <br>(hors formule Free) +<br>3% de sa première commande
                            </td>
                        </tr>

                        {{-- Renew --}}
                        <tr>
                            <td class="font-semibold">Bonus renouvellement</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td>
                                <i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i>
                                10% sur le tarif annuel
                            </td>
                        </tr>

                        {{-- Price --}}
                        <tr>
                            <td class="font-semibold">Prix</td>
                            <td>Gratuit</td>
                            <td>9,90€ / mois <br> 113€ / an</td>
                            <td>19€ / mois <br> 220€ / an</td>
                        </tr>

                        {{-- Action --}}
                        {{-- TODO: Now really do the subscription (add form) --}}
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="{{ route('subscription.show', ['plan' => 'starter']) }}"
                                    class="btn btn-primary"
                                    @if (Auth::user()->subscribed('starter') || Auth::user()->subscribed('starter_annual')) disabled="disabled" @endif>
                                    S'abonner à Starter
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('subscription.show', ['plan' => 'pro']) }}" class="btn btn-primary"
                                    @if (Auth::user()->subscribed('pro') || Auth::user()->subscribed('pro_annual')) disabled="disabled" @endif>
                                    S'abonner à Pro
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </x-utils.card>
</x-layout>
