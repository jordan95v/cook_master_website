<!-- Stripe Elements Placeholder -->
<input id="card-holder-name" type="hidden">
<input type="hidden" name="payment-method-id" id="payment-method">
<div id="card-element" class="border-2 mt-4 rounded-lg p-4 hover:border-primary"></div>

<div class="text-center">
    <button id="card-button" class="btn btn-primary max-w-xs w-full mt-4">
        {{ __('Process Payment') }}
    </button>

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
                document.querySelector("#payment-form").submit();
            }
        });
    </script>
</div>
