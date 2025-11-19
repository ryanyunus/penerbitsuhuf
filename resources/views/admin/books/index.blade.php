@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Buku</h3>
        <a href="{{ route('books.create') }}" class="btn btn-primary btn-sm">
            + Tambah Buku
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped align-middle">
        <thead>
            <tr>
                <th width="50">#</th>
                <th>Judul</th>
                <th>Penulis</th>
                <th width="120">Cover</th>
                <th width="180">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($books as $book)
                <tr>
                    <td>{{ $loop->iteration + ($books->currentPage() - 1)*$books->perPage() }}</td>
                    <td>{{ $book->title }}</td>
                    <td>{{ $book->author }}</td>
                    <td>
                        @if($book->cover)
                            <img src="{{ asset('public/storage/'.$book->cover) }}"
                                 alt="{{ $book->title }}"
                                 class="img-thumbnail"
                                 style="max-height: 80px">
                        @endif
                    </td>
                    <td>
                        {{-- Link ke DETAIL FRONTEND (opsional) --}}
                        <a href="{{ route('books.front.show', $book->slug) }}"
                           class="btn btn-sm btn-outline-secondary" target="_blank">
                            Lihat di Web
                        </a>

                        {{-- EDIT ADMIN --}}
                        <a href="{{ route('books.edit', $book) }}"
                           class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        {{-- DELETE ADMIN --}}
                        <form action="{{ route('books.destroy', $book) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin hapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">
                                Hapus
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">
                        Belum ada data buku.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div>
        {{ $books->links() }}
    </div>
</div>
@endsection
