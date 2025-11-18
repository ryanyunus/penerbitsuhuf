<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    // Halaman blog utama
    public function index(Request $request)
    {
        $query = Post::with('category')->latest();

        if ($request->filled('q')) {
            $query->where(function ($q) use ($request) {
                $q->where('title', 'like', '%' . $request->q . '%')
                  ->orWhere('excerpt', 'like', '%' . $request->q . '%');
            });
        }

        $posts = $query->paginate(6)->withQueryString();
        $categories = Category::all();

        return view('blog.index', compact('posts', 'categories'));
    }

    // Detail artikel
    public function show(Post $post)
    {
        return view('blog.show', compact('post'));
    }

    // Artikel berdasarkan kategori
    public function category(Category $category)
    {
        $posts = $category->posts()->latest()->paginate(6);
        $categories = Category::all();

        return view('blog.index', [
            'posts'      => $posts,
            'categories' => $categories,
            'activeCategory' => $category,
        ]);
    }
}
