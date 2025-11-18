<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')
        ->orderBy('created_at', 'desc')
        ->paginate(10);  // ← pakai paginate

        return view('admin.posts.index', compact('posts'));
    }

    public function create()
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt'     => 'nullable|string',
            'content'        => 'required|string',
            'thumbnail'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'category_id', 'excerpt', 'content']);

        // slug unik
        $data['slug'] = Str::slug($request->title);
        if (Post::where('slug', $data['slug'])->exists()) {
            $data['slug'] .= '-' . time();
        }

        // upload thumbnail jika ada
        if ($request->hasFile('thumbnail')) {
            $data['thumbnail'] = $request->file('thumbnail')
                ->store('thumbnails', 'public');
        }

        Post::create($data);

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berhasil dibuat.');
    }

    public function edit(Post $post)
    {
        $categories = Category::orderBy('name')->get();

        return view('admin.posts.edit', compact('post', 'categories'));
    }

    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'excerpt'     => 'nullable|string',
            'content'        => 'required|string',
            'thumbnail'   => 'nullable|image|max:2048',
        ]);

        $data = $request->only(['title', 'category_id', 'excerpt', 'content']);

        // perbarui slug kalau judul berubah (opsional)
        if ($post->title !== $request->title) {
            $data['slug'] = Str::slug($request->title);
            if (Post::where('slug', $data['slug'])->where('id', '!=', $post->id)->exists()) {
                $data['slug'] .= '-' . time();
            }
        }

        // ganti thumbnail
        if ($request->hasFile('thumbnail')) {
            // hapus file lama
            if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
                Storage::disk('public')->delete($post->thumbnail);
            }

            $data['thumbnail'] = $request->file('thumbnail')
                ->store('thumbnails', 'public');
        }

        // $post->update($data);
        $post->update([
            'title'       => $data['title'],
            'slug'        => Str::slug($data['title']),
            'category_id' => $data['category_id'],
            'excerpt'     => $data['excerpt'],
            'content'     => $data['content'],    // ← ini
            // thumbnail kalau ada upload baru
        ]);
        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berhasil diupdate.');
    }

    public function destroy(Post $post)
    {
        // hapus thumbnail kalau ada
        if ($post->thumbnail && Storage::disk('public')->exists($post->thumbnail)) {
            Storage::disk('public')->delete($post->thumbnail);
        }

        $post->delete();

        return redirect()
            ->route('posts.index')
            ->with('success', 'Post berhasil dihapus.');
    }
}
