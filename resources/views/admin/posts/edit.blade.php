@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <h3>Edit Post</h3>

    <form action="{{ route('posts.update', $post) }}" method="POST" enctype="multipart/form-data" class="mt-3">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Judul</label>
            <input type="text" name="title" class="form-control"
                   value="{{ old('title', $post->title) }}">
            @error('title')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <select name="category_id" class="form-select">
                <option value="">-- Pilih Kategori --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ old('category_id', $post->category_id) == $cat->id ? 'selected' : '' }}>
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>
            @error('category_id')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Excerpt (ringkasan)</label>
            <textarea name="excerpt" class="form-control" rows="2">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Isi Artikel</label>
            <textarea name="body" class="form-control" rows="7">{{ old('body', $post->body) }}</textarea>
            @error('body')
                <div class="text-danger small">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label d-block">Thumbnail</label>

            @if($post->thumbnail)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $post->thumbnail) }}"
                         alt=""
                         style="max-width: 200px;">
                </div>
            @endif

            <input type="file" name="thumbnail" class="form-control">
            <div class="form-text">Kosongkan kalau tidak ingin mengganti gambar.</div>
        </div>

        <button class="btn btn-primary">Simpan Perubahan</button>
        <a href="{{ route('posts.index') }}" class="btn btn-secondary">Batal</a>
    </form>
</div>
@endsection
