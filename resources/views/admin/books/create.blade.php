@extends('admin.layout')

@section('title', 'Tambah Buku')

@section('content')
<h3 class="mb-3">Tambah Buku / Produk</h3>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<form action="{{ route('books.store') }}" method="POST" enctype="multipart/form-data">
    @include('admin.books._form')
</form>
@endsection
