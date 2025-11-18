@extends('layouts.frontend')

@section('content')
<h2 class="mb-4">Semua Artikel</h2>

<div class="row">
    <div class="col-md-8">

        <div class="row">
            @foreach($posts as $post)
                <div class="col-md-6 mb-4">
                    <div class="card h-100">
                        <img src="/storage/{{ $post->thumbnail }}" class="card-img-top">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                            <p>{{ $post->excerpt }}</p>
                            <a href="{{ route('blog.show', $post->slug) }}" class="btn btn-primary btn-sm">
                                Baca Selengkapnya
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        {{ $posts->links() }}

    </div>

    <div class="col-md-4">
        <h5>Kategori</h5>
        <ul class="list-group mb-4">
            @foreach($categories as $c)
                <li class="list-group-item">
                    <a href="{{ route('blog.category', $c->slug) }}">{{ $c->name }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
@endsection
