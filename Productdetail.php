@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="my-4">My Purchased Seeds</h1>
    
    @if($userSeeds->isEmpty())
        <div class="alert alert-info">
            You haven't purchased any seeds yet.
        </div>
    @else
        <div class="row">
            @foreach($userSeeds as $userSeed)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($userSeed->seed->image_url)
                            <img src="{{ asset($userSeed->seed->image_url) }}" class="card-img-top" alt="{{ $userSeed->seed->name }}">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $userSeed->seed->name }}</h5>
                            <p class="card-text">{{ Str::limit($userSeed->seed->description, 100) }}</p>
                            <p class="text-muted">Purchased: {{ $userSeed->purchase_date->format('M d, Y') }}</p>
                            <p class="text-muted">Quantity: {{ $userSeed->quantity }}</p>
                        </div>
                        <div class="card-footer bg-white">
                            <a href="{{ route('seeds.show', $userSeed->id) }}" class="btn btn-primary">View Details</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        
        {{ $userSeeds->links() }}
    @endif
</div>
@endsection