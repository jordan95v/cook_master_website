<x-layout title="{{ __('Subscription') }}">
    @if (Auth::user()->isSubscribed())
        <x-utils.card class="w-full lg:w-1/3 mb-5">
            <div class="card-body">
                @php
                    [$subscription, $plan] = Auth::user()->getSubscription();
                @endphp
                <h2 class="card-title text-2xl font-bold mx-auto">{{ __('My subscription') }}</h2>
                <div class="grid grid-cols-1 lg:grid-cols-5 mt-4">
                    {{-- Subscription image --}}
                    <div class="my-auto mx-auto">
                        <img src="{{ asset('images/' . str_replace('_annual', '', $subscription->name) . '.png') }}">
                    </div>

                    {{-- Subscription infos --}}
                    <div class="w-full ps-4 col-span-4">
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-2 items-center font-mono">
                            <p>{{ __('Subscription date') }}:</p>
                            <span class="font-bold bg-gray-300 w-full rounded-xl p-2">
                                {{ $subscription->created_at->format('d M Y') }}
                            </span>


                            <p>{{ __('Recurring period') }}:</p>
                            <span class="font-bold bg-gray-300 w-full rounded-xl p-2">
                                {{ __(ucfirst($plan->plan->interval)) }}
                            </span>

                            <p>{{ __('Subscription price') }}:</p>
                            <span class="font-bold bg-gray-300 w-full rounded-xl p-2">
                                {{ $plan->plan->amount_decimal / 100 }}€
                            </span>

                            @if ($subscription->ends_at)
                                <p>{{ __('End of subscription') }}:</p>
                                <span class="font-bold bg-gray-300 w-full rounded-xl p-2">
                                    {{ $subscription->ends_at->format('d M Y') }}
                                </span>
                            @else
                                <p>{{ __('Next paiement') }}:</p>
                                <span class="font-bold bg-gray-300 w-full rounded-xl p-2">
                                    {{ Auth::user()->getNextBillingDate() }}
                                </span>
                            @endif
                        </div>

                        @if ($subscription->ends_at)
                            <form action="{{ route('subscription.resume') }}" class="mt-4" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-primary w-full">
                                    {{ __('Resume my subscription') }}
                                </button>
                            </form>
                        @else
                            <!-- The button to open modal -->
                            <label for="cancel" class="btn btn-error mt-4 w-full">
                                {{ __('Cancel my subscription') }}
                            </label>

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
                                            <p>
                                                {{ __('By clicking below, you are gonna cancel your subscription.') }}
                                            </p>
                                        </div>
                                        <button type="submit" class="btn btn-error max-w-lg w-full mt-4">
                                            {{ __('Cancel my subscription') }}
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @endif

                        @if (strstr($subscription->name, 'starter'))
                            <form action="{{ route('subscription.upgrade') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-primary max-w-lg w-full mt-2">
                                    {{ __('Upgrade to pro for ') }}
                                    @if (strstr($subscription->name, 'annual'))
                                        {{ $plans->data[0]->unit_amount / 100 - $plans->data[2]->unit_amount / 100 }}€
                                    @else
                                        {{ $plans->data[1]->unit_amount / 100 - $plans->data[3]->unit_amount / 100 }}€
                                    @endif
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </x-utils.card>
    @endif

    <x-utils.card class="w-full lg:w-2/3">
        <div class="card-body">
            <h2 class="font-bold text-2xl text-center">{{ __('Subscribe now !') }}</h2>
            <small class="text-center text-gray-400">{{ __('And get a lot of advantages :') }}</small>

            {{-- Subscription table --}}
            <div class="overflow-x-auto mt-10">
                <table class="table w-full text-center">
                    <!-- head -->
                    <thead>
                        <tr>
                            <td>{{ __('Advantages') }}</td>
                            <th>
                                <img src="{{ asset('images/free.png') }}" alt="" class="mx-auto">
                                <span class="text-xl">{{ __('Free') }}</span>
                            </th>
                            <th>
                                <img src="{{ asset('images/starter.png') }}" alt="" class="mx-auto">
                                <span class="text-xl">{{ __('Starter') }}</span>
                            </th>
                            <th>
                                <img src="{{ asset('images/pro.png') }}" alt="" class="mx-auto">
                                <span class="text-xl">{{ __('Pro') }}</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        {{-- Pubs --}}
                        <tr>
                            <td class="font-semibold">{{ __('Pubs') }}</td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                        </tr>

                        {{-- Comment --}}
                        <tr>
                            <td class="font-semibold">{{ __('Comment / Leave a review') }}</td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Access to course --}}
                        <tr>
                            <td class="font-semibold">{{ __('Access to courses') }}</td>
                            <td>1 / {{ __('day') }} 🐢</td>
                            <td>5 / {{ __('day') }} 🏃‍♂️</td>
                            <td>{{ __('No limits') }} 🏍</td>
                        </tr>

                        {{-- Tchat with chef --}}
                        <tr>
                            <td class="font-semibold">{{ __('Tchat with a Chef') }}</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Coupon --}}
                        <tr>
                            <td class="font-semibold">{{ __('5% off on all products') }}</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Shipping --}}
                        <tr>
                            <td class="font-semibold">{{ __('Free shipping') }}</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td>
                                <i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i>
                                {{ __('Drop-off point only') }}
                            </td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Kitchen location --}}
                        <tr>
                            <td class="font-semibold">{{ __('Rent a kitchen space') }}</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Event --}}
                        <tr>
                            <td class="font-semibold">{{ __('Invitation to exclusive events') }}</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                            <td><i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i></td>
                        </tr>

                        {{-- Cooptation --}}
                        <tr>
                            <td class="font-semibold">{{ __('Cooptation new subscriber') }}</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td>
                                <i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i><br>
                                {{ __('5€ for every 3 people subscribed with your link') }}
                                <br>{{ __('(outside of Free tier)') }}
                            </td>
                            <td>
                                <i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i><br>
                                {{ __('5€ for every people subscribed with your link') }}<br>
                                {{ __('(outside of Free tier)') }} +<br>{{ __('3% on his first order') }}
                            </td>
                        </tr>

                        {{-- Renew --}}
                        <tr>
                            <td class="font-semibold">{{ __('Renew bonus') }}</td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td><i class="fa-solid fa-circle-xmark text-2xl me-2" style="color: #ff0d0d;"></i></td>
                            <td>
                                <i class="fa-solid fa-circle-check text-2xl me-2" style="color: #0cbf02;"></i>
                                {{ __('10% on yearly plan') }}
                            </td>
                        </tr>

                        {{-- Price --}}
                        <tr>
                            <td class="font-semibold">{{ __('Price') }}</td>
                            <td>{{ __('Free') }}</td>
                            <td>9,90€ / {{ strtolower(__('Monthly')) }} <br> 113€ / {{ strtolower(__('Yearly')) }}
                            </td>
                            <td>19€ / {{ strtolower(__('Monthly')) }} <br> 220€ / {{ strtolower(__('Yearly')) }}</td>
                        </tr>

                        {{-- Action --}}
                        <tr>
                            <td></td>
                            <td></td>
                            <td>
                                <a href="{{ route('subscription.show', ['plan' => 'starter']) }}"
                                    class="btn btn-primary"
                                    @if (Auth::user()->isSubscribed()) disabled="disabled" @endif>
                                    {{ __('Subscribe to') }} {{ __('Starter') }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('subscription.show', ['plan' => 'pro']) }}" class="btn btn-primary"
                                    @if (Auth::user()->isSubscribed()) disabled="disabled" @endif>
                                    {{ __('Subscribe to') }} {{ __('Pro') }}
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </x-utils.card>
</x-layout>
