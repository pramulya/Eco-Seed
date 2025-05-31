@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto">
    <h2 class="text-xl font-bold mb-4">Confirm Publish Article</h2>

    <p><strong>{{ $article->title }}</strong></p>
    <p>{{ $article->content }}</p>
    
    <form action="{{ route('article.publish', $article->id) }}" method="POST">
        @csrf
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-full">
            Publish
        </button>
    </form>
</div>
@endsection
