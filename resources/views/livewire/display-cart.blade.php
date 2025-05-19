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
</div>
