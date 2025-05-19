<<<<<<< HEAD
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
                                            <button wire:click="removeQuantity({{ $item->cartId }})">-</button>
                                            <input type="text" value="{{ $item->quantity }}" readonly>
                                            <button wire:click="addQuantity({{ $item->cartId }})">+</button>
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
=======
<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4 w-100" style="max-width: 600px;">
        <h3 class="mb-4 text-center">🛒 Your Shopping Cart</h3>

        <form wire:submit.prevent="addToCart" class="mb-4">
            <div class="mb-3">
                <label class="form-label">Product Name</label>
                <input type="text" wire:model="product_name" class="form-control">
                @error('product_name') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Quantity</label>
                <input type="number" wire:model="quantity" class="form-control">
                @error('quantity') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Price</label>
                <input type="number" wire:model="price" class="form-control">
                @error('price') <div class="text-danger small">{{ $message }}</div> @enderror
            </div>

            <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
        </form>

        <h5 class="mb-3">Cart Items</h5>
        <table class="table table-bordered">
            <thead class="table-light">
                <tr>
                    <th>Product</th>
                    <th>Qty</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                @forelse($cartItems as $item)
                    <tr>
                        <td>{{ $item->product_name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center text-muted">No items in cart.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
>>>>>>> Surya_Branch
</div>