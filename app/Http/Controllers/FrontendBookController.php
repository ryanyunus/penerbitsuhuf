<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class FrontendBookController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');
        $sort = $request->query('sort', 'terbaru');
        $booksQuery = Book::query();

        if ($q) {
            $booksQuery->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('author', 'like', "%{$q}%");
            });
        }

            // Urutan Terbaru / Terlaris
        if ($sort === 'terlaris') {
            // SEMENTARA: pakai id ASC sebagai "terlaris"
            // Nanti bisa diganti jadi orderBy('sales_count', 'desc') kalau sudah punya kolom itu
            $booksQuery->orderBy('id', 'asc');
        } else {
            // Terbaru (default) -> created_at DESC
            $booksQuery->latest();
        }

        $books = $booksQuery->latest()->paginate(8)->withQueryString();

        return view('books.index', compact('books', 'q'));
    }

    public function show($slug)
    {
        $book = Book::where('slug', $slug)->firstOrFail();

        return view('books.show', compact('book'));
    }
}
