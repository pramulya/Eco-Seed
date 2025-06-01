@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{ asset('css/news.css') }}">
@endpush

@section('content')
<div style="background: linear-gradient(to bottom, #e7f9d4, white); padding: 40px;">
    {{-- Judul + Tombol Write --}}
    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px;">
        <h1 style="font-size: 2.5rem; font-weight: 700;">What Happened Today.</h1>
        <a href="{{ route('articles.create') }}" class="bg-green-500 text-white px-4 py-2 rounded-full">
            Write
        </a>
    </div>

    {{-- Artikel Utama --}}
    <div style="display: block; margin-top: 15px;">

        {{-- Main Article --}}
        @if($main_article)
        <div style="width: 60%; display: inline-block; margin-right: 30px; vertical-align: top;">
            <a href="{{ route('articles.show', $main_article->id) }}" style="text-decoration: none; color: inherit;">
                <img src="{{ asset('storage/' . ($main_article->image_path ?? 'image1.jpg')) }}"
                     alt="Main" style="width: 100%; border-radius: 10px; margin-bottom: 20px;">
                <h2 style="font-size: 1.8rem; font-weight: 700; margin: 10px 0;">{{ $main_article->title }}</h2>
                <p style="color: #555;">{{ \Illuminate\Support\Str::limit($main_article->description, 150) }}</p>
                <small style="color: orange;">{{ \Carbon\Carbon::parse($main_article->published_at)->diffForHumans() }}</small>
            </a>
        </div>
        @endif

        {{-- Artikel Kanan (Sisa artikel setelah yang terbaru) --}}
        <div style="width: 30%; display: inline-block; vertical-align: top;">
            @foreach ($other_articles as $article)
            <div style="margin-bottom: 20px;">
                <a href="{{ route('articles.show', $article->id) }}" style="text-decoration: none; color: inherit;">
                    <img src="{{ asset('storage/' . ($article->image_path ?? 'image1.jpg')) }}" 
                         alt="Thumbnail" style="width: 100%; height: auto; object-fit: cover; border-radius: 10px; margin-bottom: 15px;">
                    <h3 style="font-size: 1.1rem; font-weight: 600; margin: 0;">{{ $article->title }}</h3>
                    <small style="color: orange; font-size: 0.8rem;">{{ \Carbon\Carbon::parse($article->published_at)->diffForHumans() }}</small>
                </a>
            </div>
            @endforeach
        </div>
    </div>

    {{-- More Button --}}
    <div style="margin-top: 20px; text-align: center;">
        <a href="{{ route('articles.all') }}" 
        style="text-decoration: none; font-weight: bold; color: #2c3e50; border: 2px solid #2c3e50; padding: 10px 20px; border-radius: 5px;">See More Articles
        </a>
    </div>

    {{-- Trending Section --}}
    <div style="margin-top: 60px;">
        <div style="display: flex; justify-content: space-between; align-items: center;">
            <h3 style="font-size: 1.5rem;">Trending now</h3>
            <a href="{{ route('articles.all') }}" style="color: orangered; font-weight: 600; text-decoration: none;">See more →</a>
        </div>

        <div style="display: flex; gap: 20px; margin-top: 20px; overflow-x: auto;">
            @foreach ($trending as $trend)
            <a href="{{ route('articles.show', $trend->id) }}" 
            style="width: 150px; flex-shrink: 0; text-decoration: none; color: inherit;">
                <div style="width: 100%; height: 100px; overflow: hidden; border-radius: 10px;">
                    <img src="{{ asset('storage/' . ($trend->image_path ?? 'image1.jpg')) }}" 
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
