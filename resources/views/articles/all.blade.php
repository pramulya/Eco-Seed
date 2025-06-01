@extends('layouts.app')

@section('content')
<div style="padding: 40px; background: linear-gradient(to bottom, #f4ffe4, white);">

    {{-- My Articles --}}
    <h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 20px;">My Articles</h2>

    @forelse ($myArticles as $article)
        <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 25px; border-bottom: 1px solid #ccc; padding-bottom: 15px;">
            <div style="display: flex; text-decoration: none; color: inherit; flex: 1;">
                {{-- Image --}}
                <div style="width: 200px; height: 120px; overflow: hidden; flex-shrink: 0; border-radius: 8px;">
                    <img src="{{ asset('storage/' . ($article->image_path ?? 'image1.jpg')) }}"
                         alt="Thumbnail"
                         style="width: 100%; height: 100%; object-fit: cover;">
                </div>

                {{-- Info --}}
                <div style="margin-left: 20px;">
                    <h3 style="font-size: 1.2rem; font-weight: 700;">{{ $article->title }}</h3>
                    <small style="color: orange;">{{ \Carbon\Carbon::parse($article->published_at)->diffForHumans() }}</small>
                    <p style="margin-top: 10px;">{{ \Illuminate\Support\Str::limit($article->description, 120) }}</p>
                </div>
            </div>

            {{-- Tombol Delete --}}
            <form action="{{ route('articles.destroy', $article->id) }}" method="POST" style="margin-left: 15px;">
                @csrf
                @method('DELETE')
                <button type="submit" style="color: red; border: 1px solid red; background: none; padding: 6px 10px; border-radius: 5px; cursor: pointer;">
                    Delete
                </button>
            </form>
        </div>
    @empty
        <p style="color: #666;">You haven't published any articles yet.</p>
    @endforelse

    <hr style="margin: 40px 0;">

    {{-- All Articles --}}
    <h2 style="font-size: 2rem; font-weight: bold; margin-bottom: 20px;">All Articles</h2>

    @foreach($allArticles as $article)
        <a href="{{ route('articles.show', $article->id) }}" style="display: flex; text-decoration: none; color: inherit; margin-bottom: 30px; border-bottom: 1px solid #ccc; padding-bottom: 20px;">
            {{-- Image --}}
            <div style="width: 200px; height: 120px; overflow: hidden; flex-shrink: 0; border-radius: 8px;">
                <img src="{{ asset('storage/' . ($article->image_path ?? 'image1.jpg')) }}"
                     alt="Thumbnail"
                     style="width: 100%; height: 100%; object-fit: cover;">
            </div>

            {{-- Info --}}
            <div style="margin-left: 20px;">
                <h3 style="font-size: 1.2rem; font-weight: 700;">{{ $article->title }}</h3>
                <small style="color: orange;">{{ \Carbon\Carbon::parse($article->published_at)->diffForHumans() }}</small>
                <p style="margin-top: 10px;">{{ \Illuminate\Support\Str::limit($article->description, 120) }}</p>
            </div>
        </a>
    @endforeach

    {{-- Pagination --}}
    <div style="text-align: center; margin-top: 30px;">
        {{ $allArticles->links() }}
    </div>
</div>
@endsection
