@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>Donate to: {{ $campaign->campaign_name }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('campaign.process-donation') }}" method="POST">
                @csrf
                <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                
                <div class="mb-3">
                    <label class="form-label">Amount ($)</label>
                    <input type="number" class="form-control" name="amount" min="1" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Your Name</label>
                    <input type="text" class="form-control" name="donor_name" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Message (Optional)</label>
                    <textarea class="form-control" name="message" rows="3"></textarea>
                </div>

                <button type="submit" class="btn btn-success">Submit Donation</button>
            </form>
        </div>
    </div>
</div>
@endsection