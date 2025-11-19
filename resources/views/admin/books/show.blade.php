@extends('layout')

@section('title', $book->title)

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            @if($book->cover)
                <img src="{{ asset($book->cover) }}"
                     class="img-fluid rounded shadow-sm"
                     alt="{{ $book->title }}">
            @endif
        </div>
        <div class="col-md-8">
            <h1 class="h3">{{ $book->title }}</h1>
            <p class="text-muted mb-1">Oleh {{ $book->author }}</p>

            <hr>

            <p>{{ $book->description }}</p>

            <a href="{{ route('books.front.index') }}" class="btn btn-outline-secondary mt-3">
                ← Kembali ke daftar buku
            </a>
        </div>
    </div>
</div>
@endsection
