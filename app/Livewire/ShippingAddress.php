<?php

namespace App\Livewire;

use Livewire\Component;

class ShippingAddress extends Component
{
  public $name = '';
  public $street = '';
  public $city = '';
  public $postal_code = '';
  public $phone = '';
  public $saved = false;

  protected $rules = [
    'name' => 'required|string|max:255',
    'street' => 'required|string',
    'city' => 'required|string',
    'postal_code' => 'required|string|max:20',
    'phone' => 'required|string|max:20',
  ];
  public function save()
  {
    $this->validate();

    $this->saved = true;

    $this->dispatch('shippingAddressUpdated', [
      'name' => $this->name,
      'phone' => $this->phone,
      'city' => $this->city,
      'street' => $this->street,
      'postal_code' => $this->postal_code,
    ]);
  }



  public function edit()
  {
    $this->saved = false;
  }

  public function render()
  {
    return view('livewire.shipping-address');
  }
}
