<x-layout title="Abonnement">
    <x-utils.card>
        <div class="card-body">
            <p class="font-bold text-2xl text-center">Abonnez vous !</p>
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
                                5€ pour chaque inscrit <br>(hors formule Free)<br> + 3% de sa première commande
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
                                <!-- The button to starter modal -->
                                <label for="starter"
                                    class="btn btn-primary @if (Auth::user()->subscribed('starter')) btn-disabled @endif">S'abonner</label>

                                @if (!Auth::user()->subscribed('starter'))
                                    <!-- Put this part before </body> tag -->
                                    <input type="checkbox" id="starter" class="modal-toggle" />
                                    <div class="modal">
                                        <div class="modal-box relative">
                                            <label for="starter"
                                                class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
                                            <h3 class="text-lg font-bold">Abonnez vous à la formule Starter</h3>
                                            <form id="payment-form" action="{{ route('subscription.subscribe') }}"
                                                method="post">
                                                @csrf
                                                <input type="hidden" name="plan" value="starter">
                                                <x-shop.stripe />
                                            </form>
                                        </div>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <!-- The button to pro modal -->
                                <label for="pro"
                                    class="btn btn-primary @if (Auth::user()->subscribed('pro')) btn-disabled @endif">S'abonner</label>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </x-utils.card>



    <!-- Put this part before </body> tag -->
    <input type="checkbox" id="pro" class="modal-toggle" />
    <div class="modal">
        <div class="modal-box relative">
            <label for="pro" class="btn btn-sm btn-circle absolute right-2 top-2">✕</label>
            <h3 class="text-lg font-bold">Congratulations random Internet user!</h3>
            <p class="py-4">You've been selected for a chance to get one year of subscription to use Wikipedia for
                free!</p>qdqdqd
        </div>
    </div>
</x-layout>
