@extends('admin.layout')   {{-- BUKAN @extends('layout') --}}

@section('content')
<div class="container mt-4">
    <div class="card">
        <div class="card-body">
            <h3>Selamat datang, Admin 👋</h3>
            <p>Ini dashboard sederhana. Nanti kita isi menu: kategori, buku, dll.</p>

            <hr>

            <a href="{{ route('categories.index') }}" class="btn btn-outline-primary btn-sm">
                Kelola Kategori
            </a>
            <a href="{{ route('posts.index') }}" class="btn btn-primary btn-sm ms-2">
                Kelola Postingan
            </a>
        </div>
    </div>
</div>
@endsection
