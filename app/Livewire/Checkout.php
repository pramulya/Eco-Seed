<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Cart;
use App\Models\Order;
use App\Services\ShippingCostEstimator;
use Illuminate\Http\Request;

class Checkout extends Component
{
    public $openDropdowns = [];
    public $selectedShipping = [];
    public $cartItems;
    public $shopTotals = [];
    public $totalMaximumPrice = 0;
    public $shopDistances = [];

    public $shopCities = [];
    public $shippingAddressCity = null;
    public $estimatedDeliveryDays = [];
    public $shippingCosts = [];
    public $shippingAddressSaved = false;

    // NEW: Store full shipping data emitted from ShippingAddress component
    public $shippingData = [];

    protected $listeners = ['shippingAddressUpdated' => 'setShippingData', 'paymentSuccess' => 'updateOrderStatusToPaid'];

    public function mount()
    {
        $this->selectedShipping = [];
        $this->shippingCosts = [];
        $this->estimatedDeliveryDays = [];
        $this->shopDistances = [];
        $this->shippingAddressSaved = false;

        $this->loadCheckout();

        foreach ($this->cartItems as $shopId => $items) {
            if (!isset($this->selectedShipping[$shopId])) {
                $this->selectedShipping[$shopId] = 'Standard';
            }
        }
    }

    public function loadCheckout()
    {
        $userId = auth()->id();

        $this->cartItems = Cart::with('product.shop')
            ->where('user_id', $userId)
            ->get()
            ->groupBy('product.shop_id')
            ->map(function ($items) {
                return $items->map(function ($item) {
                    $item->total_price = $item->product->price * $item->quantity;
                    return $item;
                });
            });

        foreach ($this->cartItems as $shopId => $items) {
            $this->shopCities[$shopId] = $items->first()->product->shop->shop_city ?? null;
        }

        $this->calculateTotals();
    }

    public function setShippingData(array $data)
    {
        $this->shippingData = $data;
        $this->shippingAddressCity = $data['city'] ?? null;
        $this->shippingAddressSaved = true;

        $this->updateShippingCity($this->shippingAddressCity);
    }

    public function updateShippingCity(string $city)
    {
        $this->shippingAddressCity = $city;
        $this->shippingAddressSaved = true;

        $cityTo = $city;

        foreach ($this->selectedShipping as $shopId => $method) {
            if (empty($method)) {
                unset($this->shippingCosts[$shopId]);
                $this->estimatedDeliveryDays[$shopId] = null;
                unset($this->shopDistances[$shopId]);
                continue;
            }

            $shopCity = $this->shopCities[$shopId] ?? null;

            if (!$shopCity || !$cityTo) {
                unset($this->shippingCosts[$shopId]);
                $this->estimatedDeliveryDays[$shopId] = null;
                unset($this->shopDistances[$shopId]);
                continue;
            }

            $distanceKm = $this->calculateDistance($shopCity, $cityTo);
            $this->shopDistances[$shopId] = $distanceKm;

            if ($distanceKm <= 0) {
                unset($this->shippingCosts[$shopId]);
                unset($this->shopDistances[$shopId]);
                continue;
            }

            $this->estimatedDeliveryDays[$shopId] = $this->calculateEstimatedDays($shopCity, $cityTo, $method);

            $cost = $this->estimateShippingCost($distanceKm, $method);
            $this->shippingCosts[$shopId] = $cost;
        }

        $this->calculateTotals();
    }

    public function selectShipping($shopId, $option)
    {
        if (empty($option)) {
            unset($this->selectedShipping[$shopId]);
            unset($this->shippingCosts[$shopId]);
            $this->estimatedDeliveryDays[$shopId] = null;
            unset($this->shopDistances[$shopId]);
        } else {
            $this->selectedShipping[$shopId] = $option;

            $shopCity = $this->shopCities[$shopId] ?? null;
            $cityTo = $this->shippingAddressCity;

            $this->estimatedDeliveryDays[$shopId] = $this->calculateEstimatedDays($shopCity, $cityTo, $option);

            if (isset($this->shopDistances[$shopId])) {
                $distanceKm = $this->shopDistances[$shopId];
            } else {
                $distanceKm = $this->calculateDistance($shopCity, $cityTo);
                $this->shopDistances[$shopId] = $distanceKm;
            }

            $cost = $this->estimateShippingCost($distanceKm, $option);
            $this->shippingCosts[$shopId] = $cost;
        }

        $this->calculateTotals();
    }

    public function calculateTotals()
    {
        $this->shopTotals = [];
        $this->totalMaximumPrice = 0;

        foreach ($this->cartItems as $shopId => $items) {
            $productsTotal = $items->sum(fn($item) => $item->total_price);

            $shippingCost = 0;

            if (
                $this->shippingAddressSaved
                && isset($this->selectedShipping[$shopId])
                && isset($this->shippingCosts[$shopId])
            ) {
                $shippingCost = $this->shippingCosts[$shopId];
            }

            $shopTotal = $productsTotal + $shippingCost;

            $this->shopTotals[$shopId] = $shopTotal;
            $this->totalMaximumPrice += $shopTotal;
        }
    }

    public function calculateDistance(?string $cityFrom, ?string $cityTo): float
    {
        if (!$cityFrom || !$cityTo) {
            \Log::info("Distance calculation skipped, missing city", ['cityFrom' => $cityFrom, 'cityTo' => $cityTo]);
            return 0;
        }

        $distance = $this->getDistanceBetweenCities($cityFrom, $cityTo);

        \Log::info("Distance calculated", ['cityFrom' => $cityFrom, 'cityTo' => $cityTo, 'distance' => $distance]);

        return $distance ?? 0;
    }

    protected function getDistanceBetweenCities(string $cityFrom, string $cityTo): ?float
    {
        $yourApiKey = env('OPENAI_API_KEY');
        $client = \OpenAI::client($yourApiKey);

        $prompt = "Please provide only the approximate driving distance in kilometers between {$cityFrom} and {$cityTo} as a number, without any units or extra text.";

        try {
            $response = $client->chat()->create([
                'model' => 'gpt-4.1-mini',
                'messages' => [
                    ['role' => 'user', 'content' => $prompt],
                ],
            ]);

            \Log::info('OpenAI API response', ['response' => $response]);

            $answer = trim($response->choices[0]->message->content ?? '');
            $answer = str_replace(',', '.', $answer);

            if (is_numeric($answer)) {
                return (float) $answer;
            } else {
                \Log::error("OpenAI returned non-numeric distance: {$answer}");
                return null;
            }
        } catch (\Exception $e) {
            \Log::error('OpenAI API call failed: ' . $e->getMessage());
            return null;
        }
    }

    public function estimateShippingCost(float $distanceKm, string $shippingOption): float
    {
        try {
            $estimator = new ShippingCostEstimator();
            return $estimator->estimateCost($distanceKm, $shippingOption);
        } catch (\InvalidArgumentException $e) {
            \Log::error('ShippingCostEstimator error: ' . $e->getMessage());
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

    public function makePayment()
    {
        if (empty($this->shippingData)) {
            $this->addError('shipping', 'Please save your shipping address before proceeding.');
            return;
        }

        // Create order
        $order = Order::create([
            'user_id' => auth()->id(),
            'name' => $this->shippingData['name'],
            'phone' => $this->shippingData['phone'],
            'city' => $this->shippingData['city'],
            'street' => $this->shippingData['street'],
            'postal_code' => $this->shippingData['postal_code'],
            'total_price' => $this->totalMaximumPrice,
            'status' => 'Unpaid',
        ]);

        // Prepare Midtrans params
        \Midtrans\Config::$serverKey = config('midtrans.server_key');
        \Midtrans\Config::$isProduction = config('midtrans.is_production');
        \Midtrans\Config::$isSanitized = true;
        \Midtrans\Config::$is3ds = true;

        $params = [
            'transaction_details' => [
                'order_id' => $order->id,
                'gross_amount' => $order->total_price,
            ],
            'customer_details' => [
                'first_name' => $order->name,
                'phone' => $order->phone,
            ],
            'callbacks' => [
                'notification_url' => url('/api/midtrans/notification'), // Note the /api prefix
            ],
        ];

        $snapTokenResponse = \Midtrans\Snap::getSnapToken($params);

        if (is_object($snapTokenResponse) && isset($snapTokenResponse->token)) {
            $snapToken = $snapTokenResponse->token;
        } elseif (is_array($snapTokenResponse) && isset($snapTokenResponse['token'])) {
            $snapToken = $snapTokenResponse['token'];
        } else {
            $snapToken = $snapTokenResponse;
        }

        $this->dispatch('midtransSnapToken', $snapToken);




        // Optionally flash message or reset state
        session()->flash('message', 'Order created! Proceed with payment.');
    }
    public function updateOrderStatusToPaid($orderId)
    {
        $order = Order::find($orderId);

        if ($order) {
            $order->status = 'paid';
            $order->save();
            session()->flash('message', "Order #{$orderId} status updated to paid.");
        } else {
            session()->flash('error', "Order #{$orderId} not found.");
        }
    }
    public function render()
    {
        return view('livewire.checkout')
            ->layout('components.layouts.app', ['title' => 'Checkout Page']);
    }
}
