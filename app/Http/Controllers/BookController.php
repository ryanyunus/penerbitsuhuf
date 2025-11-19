<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookController extends Controller
{
    public function index()
    {
        $books = Book::latest()->paginate(10);

        // ⬅️ PENTING: pakai admin.books.index
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

   public function store(Request $request)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'description' => 'required|string',
            'cover'       => 'nullable|image|max:2048',
        ]);

        // Simpan cover langsung ke public/covers
        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            // Ini menyimpan ke folder public/covers
            $file->move(public_path('covers'), $filename);

            // Simpan path relatif yang nanti dipakai di asset()
            $data['cover'] = 'covers/' . $filename;
        }

        $data['slug'] = Str::slug($data['title']);

        Book::create($data);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil ditambahkan.');
    }


    public function edit(Book $book)
    {
        // ⬅️ PENTING: view admin.books.edit
        return view('admin.books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        $data = $request->validate([
            'title'       => 'required|string|max:255',
            'author'      => 'required|string|max:255',
            'description' => 'required|string',
            'cover'       => 'nullable|image|max:2048',
        ]);

        if ($request->hasFile('cover')) {
            // Hapus cover lama kalau ada
            if ($book->cover && file_exists(public_path($book->cover))) {
                @unlink(public_path($book->cover));
            }

            $file = $request->file('cover');
            $filename = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();

            $file->move(public_path('covers'), $filename);

            $data['cover'] = 'covers/' . $filename;
        }

        $data['slug'] = Str::slug($data['title']);

        $book->update($data);

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil diupdate.');
    }

    public function destroy(Book $book)
    {
        $book->delete();

        return redirect()->route('books.index')
            ->with('success', 'Buku berhasil dihapus.');
    }
}
