<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\FrontendBookController;
use App\Http\Controllers\CartController;


// // Redirect root ke login
// Route::get('/', function () {
//     return redirect()->route('login');
// });

Route::get('/', [FrontendBookController::class, 'index'])->name('home');

// AUTH
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

// =======================
// ADMIN AREA
// =======================
Route::prefix('admin')->middleware('auth.admin')->group(function () {

    Route::get('/', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Kategori
    Route::resource('categories', CategoryController::class);

    // Post / Artikel
    Route::resource('posts', PostController::class);

    // Buku
    Route::resource('books', BookController::class);
});

// =======================
// FRONTEND BLOG
// =======================
Route::get('/blog', [FrontendController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [FrontendController::class, 'show'])->name('blog.show');
Route::get('/blog/category/{category:slug}', [FrontendController::class, 'category'])
    ->name('blog.category');

// =======================
// FRONTEND BUKU
// =======================
Route::get('/buku', [FrontendBookController::class, 'index'])
    ->name('books.front.index');

Route::get('/buku/{slug}', [FrontendBookController::class, 'show'])
    ->name('books.front.show');

// Keranjang (frontend)
Route::get('/keranjang', [CartController::class, 'index'])->name('cart.index');
Route::post('/keranjang/tambah/{book}', [CartController::class, 'add'])->name('cart.add');
Route::post('/keranjang/hapus/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::post('/keranjang/kosongkan', [CartController::class, 'clear'])->name('cart.clear');

//tentang kami
Route::get('/tentang-kami', function () {
    return view('pages.about');
})->name('about');

