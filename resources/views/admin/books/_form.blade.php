@csrf

<div class="mb-3">
    <label class="form-label">Judul</label>
    <input type="text" name="title" class="form-control"
           value="{{ old('title', $book->title ?? '') }}" required>
</div>

<div class="mb-3">
    <label class="form-label">Penulis</label>
    <input type="text" name="author" class="form-control"
           value="{{ old('author', $book->author ?? '') }}">
</div>

<div class="mb-3">
    <label class="form-label">Deskripsi</label>
    <textarea name="description" rows="4" class="form-control">{{ old('description', $book->description ?? '') }}</textarea>
</div>

<div class="mb-3">
    <label class="form-label">Cover (gambar)</label>
    <input type="file" name="cover" class="form-control">
    @isset($book->cover)
        <small class="d-block mt-1">Cover sekarang:
            <img src="{{ asset('storage/'.$book->cover) }}" alt="" height="60">
        </small>
    @endisset
</div>

<div class="mb-3">
    <label class="form-label">File Buku / Produk (PDF/ZIP)</label>
    <input type="file" name="file" class="form-control">
    @isset($book->file)
        <small class="d-block mt-1">
            File sekarang: <a href="{{ asset('storage/'.$book->file) }}" target="_blank">Download</a>
        </small>
    @endisset
</div>

<button class="btn btn-primary">
    <i class="bi bi-save me-1"></i> Simpan
</button>
