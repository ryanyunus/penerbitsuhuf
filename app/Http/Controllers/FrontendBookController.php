<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class FrontendBookController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->query('q');

        $booksQuery = Book::query();

        if ($q) {
            $booksQuery->where(function ($query) use ($q) {
                $query->where('title', 'like', "%{$q}%")
                    ->orWhere('author', 'like', "%{$q}%");
            });
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
