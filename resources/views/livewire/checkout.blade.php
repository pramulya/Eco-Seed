@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush


<div class="checkout-container" style="max-width: 900px; margin: auto; padding: 20px;">

    {{-- Shipping Address Livewire Component --}}
    <div class="shipping-address-section" style="margin-bottom: 30px;">
        <livewire:shipping-address />
    </div>

    {{-- Shipping Calculator Section --}}
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
                            $selected = $selectedShipping[$shopId] ?? null;
                        @endphp

                        <label style="margin-right: 15px;">
                            <input type="radio" wire:click="selectShipping({{ $shopId }}, 'Same Day')"
                                name="shipping_{{ $shopId }}" @if($selected === 'Same Day') checked @endif>
                            Same Day
                        </label>

                        <label style="margin-right: 15px;">
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
            onclick="window.location='{{ route('dashboard') }}'">
            Make Payment
        </button>
    </div>

</div>