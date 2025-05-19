@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Volunteers for: {{ $campaign->campaign_name }}</h2>
        </div>
        <div class="card-body">
            @if($volunteers->count() > 0)
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Phone</th>
                                <th>Availability</th>
                                <th>Joined Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($volunteers as $volunteer)
                                <tr>
                                    <td>{{ $volunteer->name }}</td>
                                    <td>{{ $volunteer->email }}</td>
                                    <td>{{ $volunteer->phone }}</td>
                                    <td>{{ $volunteer->availability }}</td>
                                    <td>{{ $volunteer->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @else
                <p class="text-center">No volunteers yet.</p>
            @endif
        </div>
    </div>
</div>
@endsection