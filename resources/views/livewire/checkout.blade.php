@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

<div class="checkout-container" style="max-width: 900px; margin: auto; padding: 20px;">

    <div class="shipping-address-section" style="margin-bottom: 30px;">
        <livewire:shipping-address />
    </div>

    <div class="shipping-calculator-section" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px;">
        <h3>Shipping Options</h3>

        @if($cartItems->isEmpty())
            <p>Your cart is empty.</p>
        @else
            @foreach ($cartItems as $shopId => $items)
                <div class="shop-shipping" style="margin-bottom: 25px; padding-bottom: 15px; border-bottom: 1px solid #ccc;">
                    <h4>{{ $items->first()->product->shop->shop_name ?? 'Shop' }}</h4>
                    <p><strong>Shop City:</strong> {{ $shopCities[$shopId] ?? 'Unknown' }}</p>
                    <p><strong>Shop Total:</strong> Rp {{ number_format($shopTotals[$shopId] ?? 0, 0, ',', '.') }}</p>

                    <div class="shipping-options" style="margin-top: 10px;">
                        @php
                            $selected = $selectedShipping[$shopId] ?? 'Standard';
                        @endphp

                        <label>
                            <input type="radio" wire:click="selectShipping({{ $shopId }}, 'Same Day')"
                                name="shipping_{{ $shopId }}" @if($selected === 'Same Day') checked @endif>
                            Same Day
                        </label>

                        <label>
                            <input type="radio" wire:click="selectShipping({{ $shopId }}, 'Express')"
                                name="shipping_{{ $shopId }}" @if($selected === 'Express') checked @endif>
                            Express
                        </label>

                        <label>
                            <input type="radio" wire:click="selectShipping({{ $shopId }}, 'Standard')"
                                name="shipping_{{ $shopId }}" @if($selected === 'Standard') checked @endif>
                            Standard
                        </label>
                    </div>

                    <p style="margin-top: 10px;"><strong>Estimated Delivery Days:</strong>
                        {{ $estimatedDeliveryDays[$shopId] ?? 'N/A' }}</p>
                </div>
            @endforeach

            <div class="total-price" style="margin-top: 30px; font-size: 1.25em; font-weight: bold;">
                Total Price: Rp {{ number_format($totalMaximumPrice, 0, ',', '.') }}
            </div>
        @endif
    </div>

    {{-- Payment Button --}}
    <div style="margin-top: 40px; text-align: center;">
        <button class="payment-button"
            style="background-color: #007bff; color: white; padding: 12px 30px; border: none; border-radius: 5px; font-size: 1.1em; cursor: pointer;"
            wire:click="makePayment" wire:loading.attr="disabled">
            Make Payment
        </button>
    </div>

</div>

@livewireScripts
<script src="https://app.sandbox.midtrans.com/snap/snap.js"
    data-client-key="{{ config('midtrans.client_key') }}"></script>

<script>
    window.addEventListener('midtransSnapToken', event => {
        let snapToken = event.detail;

        if (Array.isArray(snapToken) && snapToken.length > 0) {
            snapToken = snapToken[0];
        } else if (typeof snapToken === 'object' && snapToken.token) {
            snapToken = snapToken.token;
        }

        console.log('Using Snap token:', snapToken);

        snap.pay(snapToken, {
            onSuccess: function (result) {
                console.log('Payment success:', result);
                if (result.order_id) {
                    Livewire.dispatch('paymentSuccess', [result.order_id]);
                }
                window.location.href = '/checkorder';
            },
            onPending: function (result) {
                console.log('Payment pending:', result);
            },
            onError: function (result) {
                console.log('Payment error:', result);
            },
            onClose: function () {
                alert('You closed the payment popup without completing the payment.');
            }
        });
    });
</script>