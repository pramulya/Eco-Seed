@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card">
        <div class="card-header">
            <h2>Volunteer for: {{ $campaign->campaign_name }}</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('volunteer.store') }}" method="POST">
                @csrf
                <input type="hidden" name="campaign_id" value="{{ $campaign->id }}">
                
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="phone">Phone</label>
                    <input type="text" class="form-control" id="phone" name="phone" required>
                </div>

                <div class="form-group">
                    <label for="motivation">Motivation</label>
                    <textarea class="form-control" id="motivation" name="motivation" rows="3" required></textarea>
                </div>

                <div class="form-group">
                    <label for="availability">Availability</label>
                    <select class="form-control" id="availability" name="availability" required>
                        <option value="Weekdays">Weekdays</option>
                        <option value="Weekends">Weekends</option>
                        <option value="Both">Both</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="skills">Relevant Skills</label>
                    <textarea class="form-control" id="skills" name="skills" rows="3" required></textarea>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection