@extends('layouts.app')

@section('content')
<div style="background: linear-gradient(to bottom, #e7f9d4, white); padding: 40px;">
    <h1 style="font-size: 2.5rem; font-weight: 700; margin-bottom: 30px;">All Published Articles</h1>
    <div style="display: flex; flex-wrap: wrap;">
        @foreach($articles as $article)
            <div style="margin-bottom: 20px;">
                <a href="{{ route('articles.show', $article->id) }}" style="text-decoration: none; color: inherit;">
                    <img src="{{ asset('images/' . ($article->image_path ?? 'image1.jpg')) }}" 
                        alt="Thumbnail" style="width: 100%; height: auto; object-fit: cover; border-radius: 10px; margin-bottom: 15px;">
                    <h3 style="font-size: 1.1rem; font-weight: 600; margin: 0;">{{ $article->title }}</h3>
                    <small style="color: orange; font-size: 0.8rem;">{{ \Carbon\Carbon::parse($article->published_at)->diffForHumans() }}</small>
                </a>
            </div>
        @endforeach
    </div>

    {{-- Pagination --}}
    <div style="margin-top: 20px; text-align: center;">
        {{ $articles->links() }}
    </div>
</div>
@endsection
