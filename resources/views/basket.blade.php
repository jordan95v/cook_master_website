<x-layout title="Paiement">
    <div class="grid grid-cols-1 md:grid-cols-2">
        <img src="{{ asset('images/stripe.png') }}" alt="">
        {{-- I don't use the card component here --}}
        <x-utils.card-grid>
            <div class="card-body">
                <h2 class="card-title justify-center flex text-2xl pb-4">Récapitulatif de mon panier</h2>

                {{-- Shop product card --}}
                @forelse (Auth::user()->orders as $item)
                    <x-shop.basket-card :item="$item" />
                @empty
                    <p class="text-center p-5">Vous n'avez pas d'articles dans votre panier</p>
                @endforelse


                {{-- Payment form --}}
                @if (count(Auth::user()->orders))
                    <x-shop.basket-total />
                    <form action="{{ route('order.pay') }}" method="post" id="payment-form">
                        @csrf
                        <input id="card-holder-name" type="hidden">
                        <input type="hidden" name="payment-method-id" id="payment-method">

                        <!-- Stripe Elements Placeholder -->
                        <div id="card-element" class="border-2 rounded-lg p-4 hover:border-primary"></div>

                        <div class="text-center">
                            <button id="card-button" class="btn btn-primary mt-4">
                                Process Payment
                            </button>
                        </div>
                    </form>
                @endif
            </div>
        </x-utils.card-grid>
    </div>



    <script src="https://js.stripe.com/v3/"></script>
    <script>
        const stripe = Stripe('{{ env('STRIPE_KEY') }}');

        const elements = stripe.elements();
        const cardElement = elements.create('card');

        cardElement.mount('#card-element');

        const cardHolderName = document.getElementById('card-holder-name');
        const cardButton = document.getElementById('card-button');

        cardButton.addEventListener('click', async (e) => {
            e.preventDefault();
            const {
                paymentMethod,
                error
            } = await stripe.createPaymentMethod(
                'card', cardElement, {
                    billing_details: {
                        name: cardHolderName.value
                    }
                }
            );

            if (error) {
                alert("Erreur de paiement")
            } else {
                document.querySelector("#payment-method").value = paymentMethod.id
            }

            document.querySelector("#payment-form").submit();
        });
    </script>
</x-layout>
