@extends('admin.layout')

@section('content')
<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h3>Daftar Postingan</h3>
        <a href="{{ route('posts.create') }}" class="btn btn-primary btn-sm">+ Post Baru</a>
    </div>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th width="50">#</th>
                <th>Judul</th>
                <th>Kategori</th>
                <th width="160">Tanggal</th>
                <th width="160">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($posts as $post)
                <tr>
                    <td>{{ $loop->iteration + ($posts->currentPage() - 1) * $posts->perPage() }}</td>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->category->name ?? '-' }}</td>
                    <td>{{ $post->created_at->format('d M Y H:i') }}</td>
                    <td>
                        <a href="{{ route('posts.edit', $post) }}" class="btn btn-sm btn-warning">
                            Edit
                        </a>

                        <form action="{{ route('posts.destroy', $post) }}"
                              method="POST"
                              class="d-inline"
                              onsubmit="return confirm('Yakin hapus post ini?')">
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
                    <td colspan="5" class="text-center">Belum ada postingan.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{-- pagination --}}
    <div class="mt-3">
        {{ $posts->links() }}
    </div>
</div>
@endsection
