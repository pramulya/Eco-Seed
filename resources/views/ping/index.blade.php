@extends('layouts.app')



@section('content')
<div style="padding: 40px; background: linear-gradient(to bottom, #f4ffe4, white);">

    <h2 style="font-size: 2rem; font-weight: bold;">All Ping</h2>

    <div style="text-align: right; margin-bottom: 20px;">
        <a href="{{ route('pings.create') }}"
        style="background-color: #4CAF50; color: white; padding: 10px 20px; border-radius: 8px; font-weight: bold; text-decoration: none;">
            + Create Ping
        </a>
    </div>


    @foreach ($allPings as $ping)

        @php
            $canEdit = \Carbon\Carbon::now()->diffInMinutes($ping->created_at) <= 5;
            $canDelete = \Carbon\Carbon::now()->diffInMinutes($ping->created_at) <= 3;
        @endphp


        <div style="padding: 15px; margin: 10px 0; border: 1px solid #ccc; border-radius: 8px;">
            <p><strong>{{ $ping->user->name }}</strong> &middot; {{ $ping->created_at->diffForHumans() }}</p>
            <p>{{ $ping->message }}</p>
            @if($ping->image)
                <img src="{{ asset('storage/' . $ping->image) }}" alt="ping image" style="max-width: 300px;">
            @endif
        </div>
    @endforeach

    <div>{{ $allPings->links() }}</div>

    <hr style="margin: 40px 0;">

    <h2 style="font-size: 2rem; font-weight: bold;">My Ping</h2>
    @foreach ($myPings as $ping)
        <div style="padding: 15px; margin: 10px 0; border: 1px solid #aaa; border-radius: 8px; background: #f9fff1;">
            <p><strong>Me</strong> &middot; {{ $ping->created_at->diffForHumans() }}</p>
            <p>{{ $ping->message }}</p>
            @if($ping->image)
                <img src="{{ asset('storage/' . $ping->image) }}" alt="my ping image" style="max-width: 300px;">
            @endif


            <div style="margin-top: 10px;">
                @if($canEdit)
                    <a href="{{ route('pings.edit', $ping->id) }}" style="margin-right: 10px; color: blue;">Edit</a>
                @endif

                @if($canDelete)
                    <form method="POST" action="{{ route('pings.destroy', $ping->id) }}" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" style="color: red; background: none; border: none;">Delete</button>
                    </form>
                @endif
            </div>
        </div>
    @endforeach
</div>
@endsection
