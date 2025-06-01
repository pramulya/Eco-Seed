<div class="shipping-address-form border-box">
    <div class="header">
        <h3 class="icon">📍</h3> Customer Details
    </div>

    @if(!$saved)
        <form wire:submit.prevent="save">
            <label for="name">Name</label>
            <input type="text" id="name" wire:model.defer="name" placeholder="Enter your full name" required>

            <label for="street">Street Address</label>
            <textarea id="street" wire:model.defer="street" placeholder="Enter street address" rows="2" required></textarea>

            <label for="city">City</label>
            <textarea id="city" wire:model.defer="city" placeholder="Enter city" rows="1" required></textarea>

            <label for="postal_code">Postal Code</label>
            <textarea id="postal_code" wire:model.defer="postal_code" placeholder="Enter postal code" rows="1"
                required></textarea>

            <label for="phone">Phone Number</label>
            <input type="tel" id="phone" wire:model.defer="phone" placeholder="Enter phone number" required>

            <button type="submit" class="btn-save">Save Details</button>
        </form>
    @else
        <div class="address-summary">
            <p><strong>Name:</strong> {{ $name }}</p>
            <p><strong>Street:</strong> {{ $street }}</p>
            <p><strong>City:</strong> {{ $city }}</p>
            <p><strong>Postal Code:</strong> {{ $postal_code }}</p>
            <p><strong>Phone:</strong> {{ $phone }}</p>
            <button wire:click="edit" class="btn-edit">Edit Details</button>
        </div>
    @endif
</div>