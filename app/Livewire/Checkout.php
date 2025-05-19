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

    public $shopCities = [];
    public $shippingAddressCity = null;
    public $estimatedDeliveryDays = [];

    protected $listeners = ['shippingAddressUpdated' => 'updateShippingCity'];

    public function mount()
    {
        $this->loadCheckout();
    }

    public function loadCheckout()
    {
        $userId = auth()->id();

        $this->cartItems = Cart::with('product.shop')
            ->where('user_id', $userId) // Filter by logged-in user
            ->get()
            ->groupBy('product.shop_id')
            ->map(function ($items) {
                return $items->map(function ($item) {
                    $item->total_price = $item->product->price * $item->quantity;
                    return $item;
                });
            });

        // Load shop cities
        foreach ($this->cartItems as $shopId => $items) {
            $this->shopCities[$shopId] = $items->first()->product->shop->shop_city ?? null;
        }

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

        $shopCity = $this->shopCities[$shopId] ?? null;
        $shippingCity = $this->shippingAddressCity;

        $this->estimatedDeliveryDays[$shopId] = $this->calculateEstimatedDays($shopCity, $shippingCity, $option);
    }

    public function updateShippingCity($city)
    {
        $this->shippingAddressCity = $city;

        // Recalculate estimates for all selected shipping options
        foreach ($this->selectedShipping as $shopId => $method) {
            $shopCity = $this->shopCities[$shopId] ?? null;
            $this->estimatedDeliveryDays[$shopId] = $this->calculateEstimatedDays($shopCity, $city, $method);
        }
    }

    public function calculateEstimatedDays($shopCity, $shippingCity, $shippingMethod)
    {
        if (!$shopCity || !$shippingCity) {
            return null;
        }

        if ($shopCity === $shippingCity) {
            switch ($shippingMethod) {
                case 'Same Day':
                    return 0;
                case 'Express':
                    return 1;
                case 'Standard':
                default:
                    return 2;
            }
        } else {
            switch ($shippingMethod) {
                case 'Same Day':
                    return 1;
                case 'Express':
                    return 2;
                case 'Standard':
                default:
                    return 4;
            }
        }
    }

    public function render()
    {
        return view('livewire.checkout')
            ->layout('components.layouts.app', ['title' => 'Checkout Page']);
    }
}
