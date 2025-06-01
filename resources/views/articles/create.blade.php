@extends('layouts.app')

@section('content')
<div style="background: linear-gradient(to bottom, #e7f9d4, white); padding: 40px; max-width: 700px; margin: auto; border-radius: 12px;">
    <h2 style="font-size: 2.2rem; font-weight: 700; color: #2d572c; margin-bottom: 30px;"> Write a New Article</h2>

    @if($errors->any())
        <div style="background-color: #ffe5e5; padding: 15px; border: 1px solid #ff9999; margin-bottom: 20px; border-radius: 8px;">
            <ul style="color: #b30000; margin: 0; padding-left: 20px;">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('articles.store') }}" enctype="multipart/form-data">
        @csrf

        <div style="margin-bottom: 20px;">
            <label for="title" style="display: block; font-weight: 600; margin-bottom: 6px;">Title</label>
            <input type="text" name="title" id="title" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="content" style="display: block; font-weight: 600; margin-bottom: 6px;">Content</label>
            <textarea name="content" id="content" rows="6" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required></textarea>
        </div>

        <div style="margin-bottom: 20px;">
            <label for="description" style="display: block; font-weight: 600; margin-bottom: 6px;">Description (short preview)</label>
            <textarea name="description" id="description" rows="3" style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 6px;" required></textarea>
        </div>

        <div style="margin-bottom: 30px;">
            <label for="image" style="display: block; font-weight: 600; margin-bottom: 6px;">Featured Image</label>
            <input type="file" name="image" id="image" accept="image/*" style="border: 1px solid #ccc; padding: 8px; border-radius: 6px; background-color: #fff;">
        </div>

        <button type="submit" style="background-color: #4CAF50; color: white; font-weight: bold; padding: 12px 24px; border: none; border-radius: 8px; cursor: pointer;">
            Publish
        </button>
    </form>
</div>
@endsection
