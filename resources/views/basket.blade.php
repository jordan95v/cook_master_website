<x-layout title="Paiement">
    <x-utils.card>
        <div class="card-body">
            <h2 class="card-title justify-center flex text-2xl pb-4">Récapitulatif de mon panier</h2>

            {{-- Shop product card --}}
            @forelse (Auth::user()->orders as $item)
                <div class="flex mb-4 rounded-xl border-2 hover:border-primary p-2">
                    <img src="{{ asset('storage/' . $item->product->image) }}" alt=""
                        class="lg:w-1/4 w-2/4 rounded">
                    <div class="flex-col lg:ms-10 ms-5 w-2/4">
                        <a class="hover:link font-bold"
                            href="{{ route('product.show', ['product' => $item->product->id]) }}">
                            {{ $item->product->name }}
                        </a>
                        <p class="text-start italic">€{{ $item->product->price }}</p>
                        <p class="mt-5">Quantité: {{ $item->quantity }}</p>
                    </div>
                    <div class="w-1/4 text-end">
                        {{-- Add more quantity --}}
                        <form action="{{ route('order.create', ['product' => $item->product->id]) }}" method="post">
                            @csrf
                            <button class="btn btn-circle btn-primary btn-sm"><i class="fa-solid fa-plus"></i></button>
                        </form>

                        {{-- Delete the order --}}
                        <form action="{{ route('order.destroy', ['order' => $item->id]) }}" method="post"
                            class="mt-4">
                            @csrf
                            <button class="btn btn-circle btn-error btn-sm"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    </div>
                </div>
            @empty
                <p class="text-center p-5">Vous n'avez pas d'articles dans votre panier</p>
            @endforelse

            @if (count(Auth::user()->orders))
                <form action="{{ route('order.pay') }}" method="post" id="payment-form">
                    @csrf
                    <input id="card-holder-name" type="hidden">
                    <input type="hidden" name="payment-method-id" id="payment-method">

                    <!-- Stripe Elements Placeholder -->
                    <div id="card-element" class="border-2 rounded p-2 hover:border-primary"></div>

                    <div class="text-center">
                        <button id="card-button" class="btn btn-primary mt-4">
                            Process Payment
                        </button>
                    </div>
                </form>
            @endif
        </div>
    </x-utils.card>


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
