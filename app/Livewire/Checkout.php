<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;

class Checkout extends Component
{
    public $openDropdowns = [];
    public $selectedShipping = [];
    public $cartItems;
    public $shopTotals = [];
    public $totalMaximumPrice = 0;

    public function mount()
    {
        $this->loadCheckout();
    }

    public function loadCheckout()
    {
        $this->cartItems = Cart::with('product.shop')->get()
            ->groupBy('product.shop_id')
            ->map(function ($items) {
                return $items->map(function ($item) {
                    $item->total_price = $item->product->price * $item->quantity;
                    return $item;
                });
            });

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->shopTotals = [];
        $this->totalMaximumPrice = 0;

        foreach ($this->cartItems as $shopId => $items) {
            $shopTotal = $items->sum(fn($item) => $item->total_price);
            $this->shopTotals[$shopId] = $shopTotal;
            $this->totalMaximumPrice += $shopTotal;
        }
    }

    public function toggleDropdown($shopId)
    {
        if (in_array($shopId, $this->openDropdowns)) {
            $this->openDropdowns = array_values(array_diff($this->openDropdowns, [$shopId]));
        } else {
            $this->openDropdowns[] = $shopId;
        }
    }

    public function selectShipping($shopId, $option)
    {
        $this->selectedShipping[$shopId] = $option;
        $this->openDropdowns = array_filter($this->openDropdowns, fn($id) => $id !== $shopId);

    }


    public function render()
    {
        return view('livewire.checkout')
            ->layout('components.layouts.app', ['title' => 'Checkout Page']);
    }
}
