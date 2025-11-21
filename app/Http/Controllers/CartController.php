<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        $cart = session('cart', []);

        return view('cart.index', compact('cart'));
    }

    public function add(Book $book)
    {
        $cart = session('cart', []);

        // pakai id buku sebagai key
        if (isset($cart[$book->id])) {
            $cart[$book->id]['qty']++;
        } else {
            $cart[$book->id] = [
                'id'     => $book->id,
                'title'  => $book->title,
                'author' => $book->author,
                'cover'  => $book->cover,
                'slug'   => $book->slug,
                'qty'    => 1,
            ];
        }

        session(['cart' => $cart]);

        return back()->with('success', 'Buku ditambahkan ke keranjang.');
    }

    public function remove($id)
    {
        $cart = session('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session(['cart' => $cart]);
        }

        return back()->with('success', 'Buku dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');

        return back()->with('success', 'Keranjang dikosongkan.');
    }
}
