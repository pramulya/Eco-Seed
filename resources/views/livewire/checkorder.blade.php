@extends('layouts.app')

@section('title', 'Check Your Orders')

@section('content')
  <div class="container" style="max-width: 900px; margin: auto; padding: 20px;">
    <h1>My Orders</h1>

    @if($orders->isEmpty())
    <p>You have no orders yet.</p>
    @else
    <table border="1" cellpadding="10" cellspacing="0" style="width: 100%; border-collapse: collapse;">
    <thead>
      <tr>
      <th>Name</th>
      <th>Order ID</th>
      <th>Total Price (Rp)</th>
      <th>Status</th>
      </tr>
    </thead>
    <tbody>
      @foreach ($orders as $order)
      <tr>
      <td>{{ $order->name }}</td>
      <td>{{ $order->id }}</td>
      <td>{{ number_format($order->total_price, 0, ',', '.') }}</td>
      <td>{{ ucfirst($order->status) }}</td>
      </tr>
    @endforeach
    </tbody>
    </table>
    @endif
  </div>
@endsection