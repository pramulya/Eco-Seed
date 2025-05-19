@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
@endpush

@section('content')
<div style="background: linear-gradient(to bottom, #e7f9d4, white); padding: 40px;">
    {{-- Judul --}}
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h1 style="font-size: 2.5rem; font-weight: 700;">What Happened Today.</h1>
    </div>

    {{-- Artikel Utama + Samping --}}
    <div style="display: flex; gap: 30px; margin-top: 30px;">
        {{-- Artikel Utama --}}
        @if($articles->count())
        <div style="flex: 2; display: flex; flex-direction: column;">
            <a href="{{ route('articles.show', $articles[0]->id) }}" style="text-decoration: none; color: inherit;">
                <img src="{{ asset('images/' . ($articles[0]->image_path ?? 'image1.jpg')) }}"
                     alt="Main" style="width: 95%; border-radius: 10px; margin-bottom: 20px;">
                <h2 style="font-size: 1.5rem; margin: 10px 0;">{{ $articles[0]->title }}</h2>
                <p style="color: #555;">{{ $articles[0]->description }}</p>
                <small style="color: orange;">{{ \Carbon\Carbon::parse($articles[0]->published_at)->diffForHumans() }}</small>
            </a>
        </div>
        @endif

        {{-- Artikel Samping (3 berita kecil) --}}
        <div style="flex: 1; display: flex; flex-direction: column; gap: 60px;">
            @foreach ($articles->skip(1)->take(3) as $article)
            <a href="{{ route('articles.show', $article->id) }}" 
               style="text-decoration: none; color: inherit; display: flex; gap: 15px; align-items: flex-start;">
                <div style="width: 200px; height: 130px; overflow: hidden; border-radius: 10px;">
                    <img src="{{ asset('images/' . ($article->image_path ?? 'image1.jpg')) }}" 
                         alt="Thumbnail" 
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>
                <div style="flex: 1; display: flex; flex-direction: column; justify-content: space-between; height: 130px;">
                    <p style="font-weight: 600; font-size: 0.95rem; margin: 0;">{{ \Illuminate\Support\Str::limit($article->title, 50) }}</p>
                    <small style="color: orange; font-size: 0.8rem;">{{ \Carbon\Carbon::parse($article->published_at)->diffForHumans() }}</small>
                </div>
            </a>
            @endforeach
        </div>
    </div>

    {{-- Trending Section --}}
<div style="margin-top: 60px;">
    <div style="display: flex; justify-content: space-between; align-items: center;">
        <h3 style="font-size: 1.5rem;">Trending now</h3>
        <a href="#" style="color: orangered; font-weight: 600; text-decoration: none;">See more →</a>
    </div>

    <div style="display: flex; gap: 20px; margin-top: 20px; overflow-x: auto;">
        @foreach ($trending as $trend)
        <a href="{{ route('articles.show', $trend->id) }}" 
           style="width: 150px; flex-shrink: 0; text-decoration: none; color: inherit;">
            <div style="width: 150px; height: 100px; overflow: hidden; border-radius: 10px;">
                <img src="{{ asset('images/' . ($trend->image_path ?? 'image1.jpg')) }}" 
                     alt="Trending Image" 
                     style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.3s ease;">
            </div>
            <p style="font-size: 0.9rem; font-weight: 600; margin-top: 8px;">{{ \Illuminate\Support\Str::limit($trend->title, 40) }}</p>
        </a>
        @endforeach
    </div>
</div>

</div>
@endsection