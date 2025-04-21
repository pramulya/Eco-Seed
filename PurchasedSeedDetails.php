@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h2>{{ $purchasedSeed->seed->name }} Details</h2>
                    <a href="{{ route('purchased-seeds.index') }}" class="btn btn-sm btn-outline-secondary">Back to List</a>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <div class="row mb-4">
                        <div class="col-md-4">
                            @if($purchasedSeed->seed->image)
                                <img src="{{ asset('storage/' . $purchasedSeed->seed->image) }}" alt="{{ $purchasedSeed->seed->name }}" class="img-fluid">
                            @else
                                <div class="no-image-placeholder bg-light d-flex align-items-center justify-content-center" style="height: 200px;">
                                    <span>No Image Available</span>
                                </div>
                            @endif
                        </div>
                        <div class="col-md-8">
                            <h3>{{ $purchasedSeed->seed->name }}</h3>
                            <p class="text-muted">{{ $purchasedSeed->seed->scientific_name }}</p>
                            
                            <div class="mb-3">
                                <h5>Description</h5>
                                <p>{{ $purchasedSeed->seed->description }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="card mb-3">
                                <div class="card-header bg-light">
                                    <h5>Planting Instructions</h5>
                                </div>
                                <div class="card-body">
                                    <p>{{ $purchasedSeed->seed->planting_instructions }}</p>
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <strong>Planting Season:</strong> {{ $purchasedSeed->seed->planting_season }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Germination Time:</strong> {{ $purchasedSeed->seed->germination_time }} days
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Harvest Time:</strong> {{ $purchasedSeed->seed->harvest_time }} days
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="card">
                                <div class="card-header bg-light">
                                    <h5>Purchase Details</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group list-group-flush">
                                        <li class="list-group-item">
                                            <strong>Purchase Date:</strong> {{ $purchasedSeed->created_at->format('M d, Y') }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Quantity Purchased:</strong> {{ $purchasedSeed->quantity }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Price per Unit:</strong> ${{ number_format($purchasedSeed->price_per_unit, 2) }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Total Cost:</strong> ${{ number_format($purchasedSeed->quantity * $purchasedSeed->price_per_unit, 2) }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Order Number:</strong> {{ $purchasedSeed->order_number }}
                                        </li>
                                        <li class="list-group-item">
                                            <strong>Status:</strong> 
                                            <span class="badge bg-{{ $purchasedSeed->status === 'completed' ? 'success' : 'warning' }}">
                                                {{ ucfirst($purchasedSeed->status) }}
                                            </span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection