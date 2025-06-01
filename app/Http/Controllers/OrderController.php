<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
  public function index()
  {
    $userId = Auth::id();

    $orders = Order::where('user_id', $userId)
      ->orderBy('created_at', 'desc')
      ->get();

    return view('livewire.checkorder', compact('orders'));

  }
}
