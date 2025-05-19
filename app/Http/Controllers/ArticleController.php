<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index()
    {
        $articles = Article::orderBy('published_at', 'desc')->get();

        if ($articles->count() > 4) {
            $trending = $articles->skip(4)->take(4);
        } else {
            $trending = collect(); // trending kosong
        }
    
        return view('articles.index', compact('articles', 'trending'));
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('articles.show', compact('article'));
    }
}
