@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 40px auto;">
    {{-- Tombol back --}}
    <a href="{{ route('articles.index') }}" style="font-size: 1.2rem; text-decoration: none; color: black;">← Back</a>

    {{-- Gambar utama --}}
    <img src="{{ asset('images/' . ($article->image_path ?? 'image1.jpg')) }}" 
         alt="Main Article Image"
         style="width: 100%; border-radius: 12px; margin-top: 20px;">

    {{-- Judul --}}
    <h1 style="margin-top: 25px; font-size: 2rem; font-weight: 700;">
        {{ $article->title }}
    </h1>

    {{-- Tambahkan ini untuk short description --}}
    <p style="margin-top: 10px; font-size: 1.1rem; color: #555; font-weight: 700;">
        {{ $article->description }}
    </p>

    {{-- Nama penulis (sementara dummy) --}}
    <p style="color: orangered; font-weight: 500;">A Story By {{ $article->author }}
        
    </p>

    {{-- Konten --}}
    <p style="line-height: 1.8; color: #333;">
        {{ $article->content }}
    </p>
</div>
@endsection
