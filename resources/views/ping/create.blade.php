@extends('layouts.app')

@section('content')
<div style="padding: 40px;">
    <h2>Create a Ping</h2>

    <form method="POST" action="{{ route('pings.store') }}" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 15px;">
            <label>Message (max 50 words)</label>
            <textarea name="message" rows="3" style="width: 100%;" maxlength="280" required></textarea>
        </div>

        <div style="margin-bottom: 15px;">
            <label>Optional Image</label>
            <input type="file" name="image" accept="image/*">
        </div>

        <button type="submit" style="padding: 10px 20px; background-color: #4CAF50; color: white; border: none;">Send Ping</button>
    </form>
</div>
@endsection
