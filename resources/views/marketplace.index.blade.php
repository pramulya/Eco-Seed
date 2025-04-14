@extends('layouts.app')

@section('title', 'Marketplace')

@section('content')
<div class="container mt-4">
    <h1 class="text-center mb-4">Eco-Friendly Products Marketplace</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="row">
        @foreach($products as $product)
            <div class="col-md-4">
                <div class="card mb-4 shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $product->name }}</h5>
                        <p class="card-text">{{ Str::limit($product->description, 100) }}</p>
                        <p class="card-text"><strong>Price: ${{ $product->price }}</strong></p>
                        <a href="{{ route('marketplace.show', $product->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    
    <!-- Pagination (if you have a lot of products) -->
    {{ $products->links() }}
</div>
@endsection
