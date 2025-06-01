<?php

namespace App\Livewire;

use Livewire\Component;
use OpenAI\Client;
use App\Services\ShippingCostEstimator;
use OpenAI;

class ShippingCalculator extends Component
{
    public $shippingCity;
    public $cartItems;
    public $shippingCosts = [];
    public $selectedShipping = [];
    public $openDropdowns = [];

    protected ?ShippingCostEstimator $shippingCostEstimator = null;

    protected $listeners = [
        'shippingCityUpdated' => 'setShippingCity',
    ];

    public function mount($cartItems)
    {
        $this->cartItems = $cartItems;
        $this->shippingCostEstimator = new ShippingCostEstimator();
    }

    public function setShippingCity(array $payload)
    {
        $city = $payload['city'] ?? '';
        $this->shippingCity = $city;
        $this->calculateShippingCosts();
    }

    protected function getDistanceBetweenCities(string $cityFrom, string $cityTo): ?float
    {
        $yourApiKey = env('OPENAI_API_KEY');
        $client = OpenAI::client($yourApiKey);

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

    public function calculateShippingCosts()
    {
        if (!$this->shippingCity) {
            $this->addError('shippingCity', 'Please enter a shipping city.');
            return;
        }

        if ($this->shippingCostEstimator === null) {
            $this->shippingCostEstimator = new ShippingCostEstimator();
        }

        foreach ($this->cartItems as $shopId => $items) {
            $shopCity = $items->first()->product->shop->shop_city;

            $distanceKm = $this->getDistanceBetweenCities($shopCity, $this->shippingCity);

            if ($distanceKm === null) {
                $this->shippingCosts[$shopId] = null;
                continue;
            }

            $shippingOption = $this->selectedShipping[$shopId] ?? 'standard';

            try {
                $cost = $this->shippingCostEstimator->estimateCost($distanceKm, $shippingOption);
                $this->shippingCosts[$shopId] = $cost;
            } catch (\InvalidArgumentException $e) {
                $this->shippingCosts[$shopId] = null;
            }
        }
    }

    public function toggleDropdown($shopId)
    {
        if (in_array($shopId, $this->openDropdowns)) {
            $this->openDropdowns = array_filter($this->openDropdowns, fn($id) => $id !== $shopId);
        } else {
            $this->openDropdowns[] = $shopId;
        }
    }

    public function selectShipping($shopId, $option)
    {
        $this->selectedShipping[$shopId] = strtolower($option);
        $this->calculateShippingCosts();
        $this->toggleDropdown($shopId);
    }

    public function render()
    {
        return view('livewire.shipping-calculator');
    }
}
