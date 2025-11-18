@extends('layout')

@section('title', 'Blog Terbaru - DivaPress Blog')

@section('content')
<div class="container">
    <div class="row">
        {{-- daftar postingan --}}
        <div class="col-md-8">
            <h2 class="mb-4">Blog Terbaru</h2>

            @forelse ($posts as $post)
                <div class="card mb-4">
                    @if($post->thumbnail)
                        <img src="{{ asset('storage/' . $post->thumbnail) }}"
                             class="card-img-top"
                             alt="{{ $post->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">
                            <a href="{{ route('blog.show', $post->slug) }}">
                                {{ $post->title }}
                            </a>
                        </h5>
                        <p class="card-text text-muted small mb-1">
                            {{ $post->created_at->format('d M Y') }} •
                            {{ $post->category->name ?? '-' }}
                        </p>
                        <p class="card-text">{{ $post->excerpt }}</p>
                        <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary btn-sm">
                            Baca Selengkapnya →
                        </a>
                    </div>
                </div>
            @empty
                <p>Belum ada postingan.</p>
            @endforelse

            {{-- pagination --}}
            <div>
                {{ $posts->links() }}
            </div>
        </div>

        {{-- sidebar kategori --}}
        <div class="col-md-4">
            <h5>Kategori</h5>
            <ul class="list-group">
                @foreach($categories as $cat)
                    <li class="list-group-item">
                        <a href="{{ route('blog.category', $cat->slug) }}">
                            {{ $cat->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
@endsection
