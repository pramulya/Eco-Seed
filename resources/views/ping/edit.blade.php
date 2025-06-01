@extends('layouts.app')

@section('content')
<div style="padding: 40px;">
    <h2>Edit Your Ping</h2>

    <form method="POST" action="{{ route('pings.update', $ping->id) }}" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div style="margin-bottom: 15px;">
            <label>Message (max 50 words)</label>
            <textarea name="message" rows="3" style="width: 100%;" maxlength="280" required>{{ $ping->message }}</textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Change Image (optional)</label>
            <input type="file" name="image" accept="image/*">
            @if ($ping->image)
                <div style="margin-top: 10px;">
                    <img src="{{ asset('storage/' . $ping->image) }}" style="max-width: 200px;">
                </div>
            @endif
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none;">Update Ping</button>
    </form>
</div>
@endsection
