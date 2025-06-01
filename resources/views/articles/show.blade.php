@extends('layouts.app')

@section('content')
<div style="max-width: 800px; margin: 40px auto;">
    {{-- Tombol back --}}
    <a href="{{ route('articles.index') }}" style="font-size: 1.2rem; text-decoration: none; color: black;">← Back</a>

    {{-- Gambar utama --}}
    <img src="{{ $article->image_path ? asset('storage/' . $article->image_path) : asset('images/image1.jpg') }}" 
         alt="Main Article Image"
         style="width: 100%; border-radius: 12px; margin-top: 20px;">

    {{-- Judul --}}
    <h1 style="margin-top: 25px; font-size: 2rem; font-weight: 700;">
        {{ $article->title }}
    </h1>

    {{-- Deskripsi --}}
    <p style="margin-top: 10px; font-size: 1.1rem; color: #555; font-weight: 700;">
        {{ $article->description ?? 'No description provided' }}
    </p>

    {{-- Nama penulis --}}
    <p style="color: orangered; font-weight: 500;">A Story By {{ $article->author ?? 'Unknown Author' }}</p>

    {{-- Konten Artikel --}}
    <p style="line-height: 1.8; color: #333; margin-top: 20px;">
        {{ $article->content }}
    </p>
</div>
@endsection
