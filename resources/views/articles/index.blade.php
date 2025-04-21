@extends('layouts.app')

@section('content')
<div class="news-page" style="padding: 20px">
    <h1 style="font-size: 2.2rem; font-weight: 600;">What Happened Today.</h1>
    
    {{-- Artikel Utama (besar) --}}
    @if ($articles->count())
        <a href="{{ route('articles.show', $articles[0]->id) }}" style="text-decoration: none; color: inherit;">
            <div class="main-article" style="margin-bottom: 40px;">
                <img src="{{ asset('images/image1.jpg') }}" style="width: 100%; border-radius: 10px; max-height: 400px; object-fit: cover;" alt="Main Article Image">

                <div style="margin-top: 20px;">
                    <h2 style="font-size: 1.6rem; font-weight: 600;">{{ $articles[0]->title }}</h2>
                    <p style="margin: 10px 0;">{{ \Illuminate\Support\Str::limit($articles[0]->content, 150) }}</p>
                    <small style="color: orange;">
                        {{ \Carbon\Carbon::parse($articles[0]->published_at)->diffForHumans() ?? $articles[0]->created_at->diffForHumans() }}
                    </small>
                </div>
            </div>
        </a>
    @endif

    {{-- Artikel Kecil (samping) --}}
    <div class="side-articles" style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
        @foreach ($articles->skip(1) as $article)
            <a href="{{ route('articles.show', $article->id) }}" style="text-decoration: none; color: inherit;">
                <div style="display: flex; gap: 15px; align-items: flex-start;">
                    <img src="{{ asset('images/' . ($article->image_path ?? 'image1.jpg')) }}"
                         style="width: 100px; border-radius: 8px;" alt="Thumbnail">
                    <div>
                        <p style="font-weight: 600;">{{ $article->title }}</p>
                        <small style="color: orange;">
                            {{ $article->published_at?->diffForHumans() ?? $article->created_at->diffForHumans() }}
                        </small>
                    </div>
                </div>
            </a>
        @endforeach
    </div>
</div>
@endsection
