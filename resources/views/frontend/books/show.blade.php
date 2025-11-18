@extends('layout')

@section('title', $book->title)

@section('content')
<div class="container my-4">
    <div class="row">
        <div class="col-md-4 mb-3">
            @if($book->cover)
                <img src="{{ asset('storage/'.$book->cover) }}"
                     alt="{{ $book->title }}"
                     class="img-fluid shadow-sm">
            @endif
        </div>
        <div class="col-md-8">
            <h2>{{ $book->title }}</h2>
            @if($book->author)
                <p class="mb-1"><strong>Penulis:</strong> {{ $book->author }}</p>
            @endif
            @if($book->category)
                <p class="mb-1"><strong>Kategori:</strong> {{ $book->category->name }}</p>
            @endif
            @if($book->price)
                <p class="fs-4 text-danger">
                    Rp {{ number_format($book->price,0,',','.') }}
                </p>
            @endif

            <hr>

            <div class="mt-3">
                {!! nl2br(e($book->description)) !!}
            </div>
        </div>
    </div>
</div>
@endsection
