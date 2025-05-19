@extends('layouts.app')

@section('content')
<div class="container">
    <div class="header-section">
        <h2>Volunteer Opportunities</h2>
    </div>

    <div class="volunteer-grid">
        @if($volunteers->count() > 0)
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Campaign</th>
                            <th>Volunteer Name</th>
                            <th>Availability</th>
                            <th>Skills</th>
                            <th>Join Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($volunteers as $volunteer)
                            <tr>
                                <td>{{ $volunteer->campaign->campaign_name }}</td>
                                <td>{{ $volunteer->name }}</td>
                                <td>{{ $volunteer->availability }}</td>
                                <td>{{ $volunteer->skills }}</td>
                                <td>{{ $volunteer->created_at->format('d M Y') }}</td>
                                <td>
                                    <a href="{{ route('volunteer.create', $volunteer->campaign_id) }}" 
                                       class="btn btn-primary">Join as Volunteer</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @else
            <p class="text-center">No volunteer opportunities available at the moment.</p>
        @endif
    </div>
</div>

<style>
    .header-section {
        margin: 30px 0;
        text-align: center;
    }
    
    .volunteer-grid {
        background: white;
        padding: 20px;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .table {
        margin-top: 20px;
    }

    .btn-primary {
        background-color: #95eb50;
        border: none;
        padding: 8px 15px;
        border-radius: 8px;
    }

    .btn-primary:hover {
        background-color: #7bc942;
    }
</style>
@endsection