@extends('layout')

@section('title', $post->title . ' - DivaPress Blog')

@section('content')
<div class="container mt-4">
    <div class="row">
        <div class="col-md-8">

            <h1>{{ $post->title }}</h1>

            <p class="text-muted">
                {{ $post->created_at->format('d M Y') }}
                •
                <a href="{{ route('blog.category', $post->category->slug) }}">
                    {{ $post->category->name }}
                </a>
            </p>

            @if ($post->thumbnail)
                <img src="{{ asset('storage/' . $post->thumbnail) }}"
                     class="img-fluid mb-3"
                     alt="{{ $post->title }}">
            @endif

            <div class="mt-3" style="line-height:1.7;">
                {{-- sesuaikan body / content dengan nama field di DB --}}
                {!! nl2br(e($post->body)) !!}
            </div>

            <a href="{{ route('blog.index') }}" class="btn btn-link mt-4">
                ← Kembali ke Blog
            </a>
        </div>

        <div class="col-md-4">
            <h5>Kategori</h5>
            <ul class="list-unstyled">
                @foreach($categories as $cat)
                    <li>
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
