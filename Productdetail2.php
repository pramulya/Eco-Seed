@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8">
            <div class="card mb-4">
                @if($userSeed->seed->image_url)
                    <img src="{{ asset($userSeed->seed->image_url) }}" class="card-img-top" alt="{{ $userSeed->seed->name }}">
                @endif
                <div class="card-body">
                    <h1 class="card-title">{{ $userSeed->seed->name }}</h1>
                    <h4 class="text-muted">{{ $userSeed->seed->variety }}</h4>
                    
                    <div class="mt-4">
                        <h3>Seed Information</h3>
                        <p>{{ $userSeed->seed->description }}</p>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p><strong>Plant Type:</strong> {{ $userSeed->seed->plant_type }}</p>
                                <p><strong>Germination:</strong> {{ $userSeed->seed->days_to_germination }} days</p>
                                <p><strong>Harvest:</strong> {{ $userSeed->seed->days_to_harvest }} days</p>
                            </div>
                            <div class="col-md-6">
                                <p><strong>Planting Season:</strong> {{ $userSeed->seed->planting_season }}</p>
                                <p><strong>Packaging:</strong> {{ ucfirst($userSeed->seed->seed_packaging) }}</p>
                                <p>
                                    <strong>Attributes:</strong>
                                    @if($userSeed->seed->organic) <span class="badge bg-success">Organic</span> @endif
                                    @if($userSeed->seed->heirloom) <span class="badge bg-info">Heirloom</span> @endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h3 class="mb-0">Purchase Details</h3>
                </div>
                <div class="card-body">
                    <p><strong>Purchase Date:</strong> {{ $userSeed->purchase_date->format('M d, Y') }}</p>
                    <p><strong>Quantity:</strong> {{ $userSeed->quantity }}</p>
                    @if($userSeed->batch_number)
                        <p><strong>Batch Number:</strong> {{ $userSeed->batch_number }}</p>
                    @endif
                    @if($userSeed->expiration_date)
                        <p><strong>Expiration Date:</strong> {{ $userSeed->expiration_date->format('M d, Y') }}</p>
                    @endif
                </div>
            </div>
            
            @if($userSeed->planting_instructions)
                <div class="card">
                    <div class="card-header bg-success text-white">
                        <h3 class="mb-0">Planting Instructions</h3>
                    </div>
                    <div class="card-body">
                        {!! nl2br(e($userSeed->planting_instructions)) !!}
                    </div>
                </div>
            @endif
        </div>
    </div>
    
    <a href="{{ route('seeds.my-seeds') }}" class="btn btn-secondary mt-3">Back to My Seeds</a>
</div>
@endsection