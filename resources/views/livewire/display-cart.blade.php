@push('styles')
    <link rel="stylesheet" href="{{ asset('css/cart.css') }}">
@endpush

<div id="app">
    <header class="navbar">
        <a href="{{ route('dashboard') }}">
            <h2>Eco-Seed</h2>
        </a>
        <nav>
            <a href="{{ route('donate.form') }}">Donate</a>
            <a href="#">News</a>
            <a href="#">Merch</a>
            <a href="#">Plant Cart</a>
            <a href="#">Seeds</a>
            <a href="#">Campaign</a>
            <a href="#">Marketplace</a>
        </nav>
        <div class="icons">
            <img src="images/notifications-24px 1.svg" alt="">
            <img src="images/settings-24px 1.svg" alt="">
            <img src="images/Ellipse 14.png" alt="">
        </div>
    </header>
    <main>
        @php
            $totalmaximum_price = 0;
        @endphp
        <div class="product-container">

            @forelse($cartItems as $shopId => $items)
                    <div class="shop-name">
                        {{ $items->first()->product->shop->shop_name ?? 'Unknown Shop' }}
                    </div>
                    @foreach($items as $item)
                            @php
                                $totalmaximum_price += $item->total_price;
                            @endphp

                            <div class="product-item">
                                <div class="product-item-content">
                                    <img src="{{ asset('images/product-image_placeholder.png') }}" alt="Product Image"
                                        class="product-image">
                                    <div class="product-details">
                                        <p class="product-title">{{ $item->product->name }}</p>
                                    </div>
                                    <p class="product-price">Rp{{ number_format($item->total_price, 0, ',', '.') }}</p>
                                    <div class="product-actions">
                                        <button class="delete-button" wire:click="deleteFromCart({{ $item->cartId }})">
                                            <img src="{{ asset('images/recycle-bin.png') }}" alt="Delete" class="trash-icon">
                                        </button>
                                        <div class="quantity-control">
                                            <button dusk="remove-quantity-button-{{ $item->cartId }}" class="btn-decrease-quantity"
                                                wire:click="removeQuantity({{ $item->cartId }})" @if($item->quantity <= 1) disabled
                                                @endif>
                                                -
                                            </button>
                                            <input type="text" value="{{ $item->quantity }}" readonly>
                                            <button dusk="add-quantity-button-{{ $item->cartId }}" class="btn-increase-quantity"
                                                wire:click="addQuantity({{ $item->cartId }})" @if($item->quantity >= $item->product->stock) disabled @endif>
                                                +
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                    @endforeach
            @empty
                <div class="empty-item">
                    <span>No Items in Cart</span>
                </div>
            @endforelse
            @if($totalmaximum_price > 0)
                <div class="total-price">
                    <p>Total Price: Rp{{ number_format($totalmaximum_price, 0, ',', '.') }}</p>
                </div>
                <div>
                    <button class="buy-button" onclick="window.location='{{ route('checkout') }}'">Buy</button>
                </div>
            @endif
        </div>
    </main>
</div>