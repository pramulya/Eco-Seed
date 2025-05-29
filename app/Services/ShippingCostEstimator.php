<?php

namespace App\Services;

class ShippingCostEstimator
{
  /**
   * Estimate shipping cost based on distance and shipping option.
   *
   * @param float $distanceKm Distance in kilometers
   * @param string $shippingOption Shipping option (make'standard', 'express', 'same_day')
   * @return int Shipping cost in Rupiah
   */
  public function estimateCost(float $distanceKm, string $shippingOption): int
  {
    // Define base prices for each shipping option depending on distance brackets
    $prices = [
      'standard' => [
        ['max_distance' => 20, 'cost' => 5000],
        ['max_distance' => 50, 'cost' => 10000],
        ['max_distance' => 100, 'cost' => 15000],
        ['max_distance' => PHP_INT_MAX, 'cost' => 20000],
      ],
      'express' => [
        ['max_distance' => 20, 'cost' => 10000],
        ['max_distance' => 50, 'cost' => 15000],
        ['max_distance' => 100, 'cost' => 20000],
        ['max_distance' => PHP_INT_MAX, 'cost' => 30000],
      ],
      'same_day' => [
        ['max_distance' => 20, 'cost' => 20000],
        ['max_distance' => 50, 'cost' => 30000],
        ['max_distance' => 100, 'cost' => 40000],
        ['max_distance' => PHP_INT_MAX, 'cost' => 50000],
      ],
    ];

    $shippingOption = strtolower(str_replace(' ', '_', $shippingOption));

    if (!array_key_exists($shippingOption, $prices)) {
      throw new \InvalidArgumentException("Invalid shipping option provided.");
    }

    foreach ($prices[$shippingOption] as $priceBracket) {
      if ($distanceKm <= $priceBracket['max_distance']) {
        return $priceBracket['cost'];
      }
    }

    // Default fallback cost (should never be reached due to PHP_INT_MAX)
    return 0;
  }
}
