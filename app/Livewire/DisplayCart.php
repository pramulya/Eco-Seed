<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;

class DisplayCart extends Component
{
    public $product_name, $price, $quantity;
    public $cartItems = [];

    public function mount()
    {
        $this->loadCart();
    }


    public function loadCart()
    {
        $this->cartItems = Cart::all()->map(function ($item) {
            $item->total_price = $item->price * $item->quantity;
            return $item;
        });
    }

    public function addToCart()
    {
        $this->validate([
            'product_name' => 'required',
            'quantity' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0'
        ]);

        Cart::create([
            'product_name' => $this->product_name,
            'quantity' => $this->quantity,
            'price' => $this->price,
        ]);

        $this->reset(['product_name', 'quantity', 'price']);
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
