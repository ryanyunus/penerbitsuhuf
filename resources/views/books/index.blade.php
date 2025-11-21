@extends('layout')

@section('content')
<div class="container my-4">

    {{-- Header Judul + Filter --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-3 gap-2">
        <h3 class="mb-0">Katalog Buku</h3>

        {{-- FILTER: Terbaru – Terlaris – Kategori --}}
        @php
            $currentSort = request('sort', 'terbaru');
        @endphp

        <div class="d-flex gap-2">

            <a href="{{ route('books.front.index', ['sort' => 'terbaru']) }}"
               class="btn btn-sm {{ $currentSort === 'terbaru' ? 'btn-success' : 'btn-outline-success' }}">
               Terbaru
            </a>

            <a href="{{ route('books.front.index', ['sort' => 'terlaris']) }}"
               class="btn btn-sm {{ $currentSort === 'terlaris' ? 'btn-success' : 'btn-outline-success' }}">
               Terlaris
            </a>

            {{-- Sementara kategori ke /buku --}}
            <a href="{{ route('books.front.index') }}"
               class="btn btn-sm btn-outline-secondary">
               Kategori
            </a>
        </div>
    </div>

    {{-- Notifikasi --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- DAFTAR BUKU --}}
    @if($books->count())
        <div class="row g-3">
            @foreach($books as $book)
                <div class="col-6 col-md-3">
                    <div class="card h-100 shadow-sm">

                        @if($book->cover)
                            <img src="{{ asset($book->cover) }}"
                                 class="card-img-top"
                                 alt="{{ $book->title }}"
                                 style="height: 220px; object-fit: cover;">
                        @endif

                        <div class="card-body d-flex flex-column">
                            <h6 class="card-title mb-1">
                                <a href="{{ route('books.front.show', $book->slug) }}"
                                   class="text-decoration-none text-dark">
                                    {{ Str::limit($book->title, 60) }}
                                </a>
                            </h6>

                            <small class="text-muted mb-2">
                                {{ Str::limit($book->author, 40) }}
                            </small>

                            <div class="mt-auto">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('books.front.show', $book->slug) }}"
                                       class="btn btn-outline-success btn-sm">
                                        Detail
                                    </a>

                                    <form action="{{ route('cart.add', $book) }}" method="POST">
                                        @csrf
                                        <button class="btn btn-success btn-sm">
                                            + Keranjang
                                        </button>
                                    </form>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $books->links() }}
        </div>
    @else
        <p class="text-center text-muted mt-5">
            Tidak ada buku ditemukan.
        </p>
    @endif

</div>
@endsection
