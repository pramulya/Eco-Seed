@extends('layouts.app')

@section('content')
<div class="container">
    <form action="{{ route('campaigns.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                   id="title" name="title" value="{{ old('title') }}">
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Add similar error handling for other fields -->

        <button type="submit" class="btn btn-primary">Create your own Campaign</button>
    </form>
</div>
@endsection