@extends('admin.layout')

@section('title', 'Edit Buku')

@section('content')
<h3 class="mb-3">Edit Buku / Produk</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('books.update', $book) }}" method="POST" enctype="multipart/form-data">
    @method('PUT')
    @include('admin.books._form', ['book' => $book])
</form>
@endsection
