<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;

class DisplayCart extends Component
{
    public $product_id, $user_id, $quantity, $total_price;
    public $cartItems = [];

    public function mount()
    {
        $this->loadCart();
    }


    public function loadCart()
    {
        $this->cartItems = Cart::with('product.shop')->get()->groupBy('product.shop_id')->map(function ($items) {
            return $items->map(function ($item) {
                $item->total_price = $item->product->price * $item->quantity;
                return $item;
            });
        });
    }

    public function addToCart()
    {
        $this->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $product = Product::find($this->product_id);

        Cart::create([
            'product_id' => $this->product_id,
            'quantity' => $this->quantity,
            'total_price' => $product->price * $this->quantity,
        ]);

        $this->reset(['product_id', 'quantity']);
        $this->loadCart();
    }

    public function deleteFromCart($itemId)
    {
        $this->cartItems = $this->cartItems->filter(function ($item) use ($itemId) {
            return $item->id !== $itemId;
        });
    }
    public function addQuantity($itemId)
    {
        $item = Cart::find($itemId);
        $item->quantity++;
        $item->save();
        $this->loadCart();
    }

    public function removeQuantity($itemId)
    {
        $item = Cart::find($itemId);
        if ($item->quantity > 1) {
            $item->quantity--;
            $item->save();
        }
        $this->loadCart();
    }
    public function render()
    {
        return view('livewire.display-cart')
            ->layout('components.layouts.app', ['title' => 'Cart Page']);
    }

}
