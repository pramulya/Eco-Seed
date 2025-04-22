<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;

class Checkout extends Component
{
    public $openDropdowns = [];
    public $selectedShipping = [];
    public $cartItems = [];
    public function mount()
    {
        $this->loadcheckout();
    }
    public function loadcheckout()
    {
        $this->cartItems = Cart::with('product.shop')->get()->groupBy('product.shop_id')->map(function ($items) {
            return $items->map(function ($item) {
                $item->total_price = $item->product->price * $item->quantity;
                return $item;
            });
        });
    }
    public function render()
    {
        return view('livewire.checkout')
            ->layout('components.layouts.app', ['title' => 'Checkout Page']);
    }

    public function toggleDropdown($key)
    {
        if (in_array($key, $this->openDropdowns)) {
            $this->openDropdowns = array_diff($this->openDropdowns, [$key]);
        } else {
            $this->openDropdowns[] = $key;
        }
    }
    public function selectShipping($shopId, $option)
    {
        $this->selectedShipping[$shopId] = $option;
        $this->openDropdowns = array_diff($this->openDropdowns, [$shopId]);
    }
}
