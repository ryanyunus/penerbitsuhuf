@extends('layout')

@section('title', 'Buku Terbaru')

@section('content')
<div class="container my-4">
    <h2 class="mb-3">Buku Terbaru</h2>

    <div class="row mb-4">
        <div class="col-md-8">
            <form class="input-group" method="GET" action="{{ route('books.front.index') }}">
                <input type="text"
                       name="q"
                       class="form-control"
                       placeholder="Cari buku, pengarang..."
                       value="{{ request('q') }}">
                <button class="btn btn-danger">Cari</button>
            </form>
        </div>
        <div class="col-md-4 mt-2 mt-md-0">
            <select name="kategori" class="form-select"
                    onchange="this.form.submit()" form="kategoriForm">
                <option value="">Semua Kategori</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" {{ request('kategori') == $category->slug ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <form id="kategoriForm" method="GET" action="{{ route('books.front.index') }}">
                <input type="hidden" name="q" value="{{ request('q') }}">
            </form>
        </div>
    </div>

    <div class="row row-cols-2 row-cols-sm-3 row-cols-md-4 row-cols-lg-5 g-4">
        @forelse($books as $book)
            <div class="col">
                <div class="card h-100 border-0 shadow-sm">
                    @if($book->cover)
                        <a href="{{ route('books.front.show', $book->slug) }}">
                            <img src="{{ asset('storage/'.$book->cover) }}"
                                 class="card-img-top"
                                 alt="{{ $book->title }}">
                        </a>
                    @endif
                    <div class="card-body p-2">
                        <h6 class="card-title mb-1">
                            <a href="{{ route('books.front.show', $book->slug) }}"
                               class="text-decoration-none text-dark">
                                {{ Str::limit($book->title, 40) }}
                            </a>
                        </h6>
                        @if($book->author)
                            <small class="text-muted d-block">{{ $book->author }}</small>
                        @endif
                        @if($book->price)
                            <strong class="text-danger d-block mt-1">
                                Rp {{ number_format($book->price,0,',','.') }}
                            </strong>
                        @endif
                    </div>
                </div>
            </div>
        @empty
            <p>Tidak ada buku.</p>
        @endforelse
    </div>

    <div class="mt-4">
        {{ $books->links() }}
    </div>
</div>
@endsection
