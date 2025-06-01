<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class ArticleController extends Controller
{
    public function index()
    {
        // Mengambil 4 artikel terbaru yang dipublikasikan
        $articles = Article::where('status', 'published')
                            ->orderBy('published_at', 'desc')
                            ->take(4) // Ambil 4 artikel terbaru
                            ->get();

        // Pisahkan artikel terbaru untuk ditampilkan di bagian utama
        $main_article = $articles->shift(); // Ambil artikel pertama (terbaru)

        // Menyisakan artikel lainnya untuk ditampilkan di kanan
        $other_articles = $articles;

        // Mengambil artikel lama untuk halaman All Articles
        $old_articles = Article::where('status', 'published')
                                ->orderBy('published_at', 'desc')
                                ->skip(4) // Lewati 4 artikel pertama
                                ->take(100) // Tentukan jumlah artikel yang ingin diambil
                                ->get();

        // Menentukan artikel trending jika ada lebih dari 4 artikel
        $trending = $other_articles->take(4);  // Ambil 4 artikel dari sisa artikel yang ada

        // Kirim data ke view
        return view('articles.index', compact('main_article', 'other_articles', 'trending', 'old_articles'));
    }

    public function all()
    {
        $allArticles = Article::where('status', 'published')
                        ->orderBy('published_at', 'desc')
                        ->paginate(10);

        $myArticles = Article::where('status', 'published')
                        ->where('author', Auth::user()->name)
                        ->orderBy('published_at', 'desc')
                        ->get();

        return view('articles.all', compact('allArticles', 'myArticles'));
    }

    public function show($id)
    {
        // Menampilkan artikel berdasarkan ID
        $article = Article::findOrFail($id);

        // Update views setiap kali artikel dilihat
        $article->views += 1;
        $article->save();

        return view('articles.show', compact('article'));
    }

    public function create()
    {
        // Menampilkan form untuk membuat artikel baru
        return view('articles.create');
    }

    public function store(Request $request)
    {
        // Validasi data
        $request->validate([
            'title' => 'required|max:255',
            'content' => 'required',
            'description' => 'required|max:500', // Validasi untuk description
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Validasi gambar
        ]);

        // Membuat artikel baru
        $article = new Article();
        $article->title = $request->title;
        $article->content = $request->content;
        $article->description = $request->description;
        $article->status = 'published';  // Set status artikel menjadi published
        $article->published_at = now();  // Set publish time saat artikel disimpan
        $article->author = Auth::user()->name;

        // Menyimpan gambar jika ada
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('articles', 'public');
            $article->image_path = $path;
        }

        // Simpan artikel
        $article->save();

        // Redirect ke halaman index artikel setelah artikel disimpan
        return redirect()->route('articles.index')->with('success', 'Article published successfully!');
    }

    public function confirm($id)
    {
        // Menampilkan halaman konfirmasi publish artikel
        $article = Article::findOrFail($id);
        return view('articles.confirm', compact('article'));
    }

    public function publish($id)
    {
        // Memperbarui status artikel menjadi 'published'
        $article = Article::findOrFail($id);
        $article->status = 'published';
        $article->save(); // Simpan perubahan status

        return redirect()->route('articles.index'); // Kembali ke halaman index artikel
    }

    public function destroy($id)
    {
        $article = Article::findOrFail($id);

        if ($article->author !== Auth::user()->name) {
            return redirect()->route('articles.all')->with('error', 'You are not authorized to delete this article.');
        }

        if ($article->image_path && \Storage::disk('public')->exists($article->image_path)) {
            \Storage::disk('public')->delete($article->image_path);
        }

        $article->delete();

        return redirect()->route('articles.all')->with('success', 'Article deleted successfully.');
    }
}
