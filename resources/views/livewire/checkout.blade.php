@push('styles')
    <link rel="stylesheet" href="{{ asset('css/checkout.css') }}">
@endpush

<div id="app">
    <header class="navbar">
        <a href="{{ route('cart') }}">
            <h2>Back</h2>
        </a>
        <nav></nav>
        <div class="icons">
            <img src="images/settings-24px 1.svg" alt="">
            <img src="images/Ellipse 14.png" alt="">
        </div>
    </header>

    <div class="border-box">
        <livewire:shipping-address />
    </div>

    <div class="border-box">
        @forelse($cartItems as $shopId => $items)
            <div class="shop-name">
                {{ $items->first()->product->shop->shop_name ?? 'Unknown Shop' }}
                @if(isset($selectedShipping[$shopId]))
                    <span style="font-weight: normal; font-size: 0.9em; color: #555;">
                        — Shipping: {{ $selectedShipping[$shopId] }}
                    </span>
                @endif
            </div>

            @foreach($items as $item)
                <!-- product item display -->
            @endforeach

            <div class="shop-total-price">
                <strong>Rp{{ number_format($shopTotals[$shopId] ?? 0, 0, ',', '.') }}</strong>
            </div>

            <!-- Shipping Options Dropdown -->
            <div class="dropdown" style="position: relative; margin-top: 10px;">
                <a href="#" wire:click.prevent="toggleDropdown({{ $shopId }})" class="dropdown-toggle"
                    style="cursor: pointer;">
                    Shipping Options
                </a>

                @if(in_array($shopId, $openDropdowns))
                    <div class="dropdown-menu"
                        style="display: block; position: absolute; background-color: #f9f9f9; min-width: 200px; box-shadow: 0 8px 16px rgba(0,0,0,0.2); border-radius: 4px; z-index: 100;">
                        <a href="#" wire:click.prevent="selectShipping({{ $shopId }}, 'Standard')">Standard Shipping</a>
                        <a href="#" wire:click.prevent="selectShipping({{ $shopId }}, 'Express')">Express Shipping</a>
                        <a href="#" wire:click.prevent="selectShipping({{ $shopId }}, 'Same Day')">Same Day Delivery</a>
                    </div>
                @endif
            </div>

            <!-- Estimated Delivery Days Display -->
            @if(isset($estimatedDeliveryDays[$shopId]))
                <div class="estimated-delivery" style="margin-top: 5px; font-style: italic; color: #555;">
                    Estimated Delivery:
                    @if($estimatedDeliveryDays[$shopId] === 0)
                        Same day
                    @else
                        {{ $estimatedDeliveryDays[$shopId] }} day(s)
                    @endif
                </div>
            @endif

            <hr class="dropdown-separator" />
        @empty
            <div class="empty-item">
                <span>No Items in Cart</span>
            </div>
        @endforelse



        <div class="total-cart-price" style="margin-top: 20px; font-weight: bold; font-size: 1.2em;">
            <p>Total Price: Rp{{ number_format($totalMaximumPrice, 0, ',', '.') }}</p>
        </div>

    </div>

    <div style="margin-top: 20px;">
        <button class="payment-button" onclick="window.location='{{ route('dashboard') }}'">Make Payment</button>
    </div>
</div>