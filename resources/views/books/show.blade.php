@extends('layout') {{-- atau frontend.layout, samakan dengan blog --}}

@section('title', $book->title)

@section('content')
<div class="container py-4">
    <a href="{{ route('books.front.index') }}" class="btn btn-outline-secondary btn-sm mb-3">
        ← Kembali ke daftar buku
    </a>

    <div class="row">
        <div class="col-md-4 mb-3">
            @if($book->cover)
                <img src="{{ asset('public/storage/'.$book->cover) }}"
                     class="img-fluid rounded shadow-sm"
                     alt="{{ $book->title }}">
            @endif
        </div>

        <div class="col-md-8">
            <h1 class="h3">{{ $book->title }}</h1>
            <p class="text-muted mb-1">
                Penulis: <strong>{{ $book->author }}</strong>
            </p>
            <form action="{{ route('cart.add', $book) }}" method="POST" class="d-inline">
                @csrf
                <button class="btn btn-success">
                    🛒 Tambah ke Keranjang
                </button>
            </form>


            @if($book->price ?? false)
                <p class="mb-2">
                    Harga:
                    <strong>Rp {{ number_format($book->price, 0, ',', '.') }}</strong>
                </p>
            @endif

            @if($book->isbn ?? false)
                <p class="mb-2">
                    ISBN: <strong>{{ $book->isbn }}</strong>
                </p>
            @endif

            <hr>

            <h2 class="h5">Deskripsi</h2>
            <p style="white-space: pre-line;">
                {{ $book->description }}
            </p>
        </div>
    </div>
</div>
@endsection
