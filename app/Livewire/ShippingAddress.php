<?php

namespace App\Livewire;

use Livewire\Component;

class ShippingAddress extends Component
{
  public $street = '';
  public $city = '';
  public $postal = '';
  public $notes = '';
  public $saved = false;

  protected $rules = [
    'street' => 'required|string|max:255',
    'city' => 'required|string|max:255',
    'postal' => 'required|string|max:20',
    'notes' => 'nullable|string|max:500',
  ];

  public function save()
  {
    $this->validate();

    // Optionally save to database here

    $this->saved = true;
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
