<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Services\ShippingCostEstimator;

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
    public $shippingCosts = [];

    protected ?ShippingCostEstimator $shippingCostEstimator = null;

    protected $listeners = ['shippingAddressUpdated' => 'updateShippingCity'];

    public function mount()
    {
        $this->shippingCostEstimator = new ShippingCostEstimator();
        $this->loadCheckout();
    }
    protected function getDistanceBetweenCities(string $cityFrom, string $cityTo): ?float
    {
        $yourApiKey = env('OPENAI_API_KEY');
        $client = \OpenAI::client($yourApiKey);

        $prompt = "Please provide only the approximate driving distance in kilometers between {$cityFrom} and {$cityTo} as a number, without any units or extra text.";

        $response = $client->chat()->create([
            'model' => 'gpt-4.1-mini',
            'messages' => [
                ['role' => 'user', 'content' => $prompt],
            ],
        ]);

        $answer = trim($response->choices[0]->message->content ?? '');
        $answer = str_replace(',', '.', $answer);

        return is_numeric($answer) ? (float) $answer : null;
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
            $productsTotal = $items->sum(fn($item) => $item->total_price);
            $shippingCost = $this->shippingCosts[$shopId] ?? 0;

            $shopTotal = $productsTotal + $shippingCost;

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

        $cityTo = is_array($this->shippingAddressCity) ? ($this->shippingAddressCity['city'] ?? '') : $this->shippingAddressCity;

        $this->estimatedDeliveryDays[$shopId] = $this->calculateEstimatedDays($shopCity, $cityTo, $option);

        $distanceKm = $this->calculateDistance($shopCity, $cityTo);
        $cost = $this->estimateShippingCost($distanceKm, $option);

        $this->shippingCosts[$shopId] = $cost;

        $this->calculateTotals(); // recalc totals including shipping
    }

    public function updateShippingCity($city)
    {
        $this->shippingAddressCity = $city;

        $cityTo = is_array($city) ? ($city['city'] ?? '') : $city;

        // Recalculate estimates and shipping costs for all selected shipping options
        foreach ($this->selectedShipping as $shopId => $method) {
            $shopCity = $this->shopCities[$shopId] ?? null;
            $this->estimatedDeliveryDays[$shopId] = $this->calculateEstimatedDays($shopCity, $cityTo, $method);

            $distanceKm = $this->calculateDistance($shopCity, $cityTo);
            $cost = $this->estimateShippingCost($distanceKm, $method);
            $this->shippingCosts[$shopId] = $cost;
        }

        $this->calculateTotals();
    }


    // Calculate distance between two cities using ShippingCostEstimator or your logic
    public function calculateDistance(?string $cityFrom, ?string $cityTo): float
    {
        if (!$cityFrom || !$cityTo) {
            return 0;
        }

        $distance = $this->getDistanceBetweenCities($cityFrom, $cityTo);

        return $distance ?? 0;
    }

    // Estimate shipping cost based on distance and shipping option
    public function estimateShippingCost(float $distanceKm, string $shippingOption): float
    {
        try {
            return $this->shippingCostEstimator->estimateCost($distanceKm, $shippingOption);
        } catch (\InvalidArgumentException $e) {
            return 0;
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
