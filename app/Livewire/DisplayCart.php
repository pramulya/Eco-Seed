<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;

class DisplayCart extends Component
{
    public $product_name, $quantity, $price;
    public $cartItems = [];

    public function mount()
    {
        $this->loadCart();
    }

    public function loadCart()
    {
        $this->cartItems = Cart::all();
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

    public function render()
    {
        return view('livewire.display-cart')
            ->layout('components.layouts.app', ['title' => 'Cart Page']);
    }

}
