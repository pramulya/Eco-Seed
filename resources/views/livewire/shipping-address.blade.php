<div class="shipping-address-form border-box">
    <div class="header">
        <h3 class="icon">📍</h3> Shipping Address
    </div>

    @if(!$saved)
        <form wire:submit.prevent="save">
            <label for="street">Street Address</label>
            <input type="text" id="street" wire:model.defer="street" placeholder="Enter street address" required>

            <label for="city">City</label>
            <input type="text" id="city" wire:model.lazy="city" placeholder="Enter city" required>

            <label for="postal">Postal Code</label>
            <input type="text" id="postal" wire:model.defer="postal" placeholder="Enter postal code" required>

            <label for="notes">Additional Notes</label>
            <textarea id="notes" wire:model.defer="notes" rows="3"
                placeholder="Enter any additional address details"></textarea>

            <button type="submit" class="btn-save">Save Address</button>
        </form>
    @else
        <div class="address-summary">
            <p><strong>Street:</strong> {{ $street }}</p>
            <p><strong>City:</strong> {{ $city }}</p>
            <p><strong>Postal Code:</strong> {{ $postal }}</p>
            @if($notes)
                <p><strong>Notes:</strong> {{ $notes }}</p>
            @endif
            <button wire:click="edit" class="btn-edit">Edit Address</button>
        </div>
    @endif
</div>