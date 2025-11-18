<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'DivaPress Blog')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body { background-color: #f8f9fa; }
        .navbar-brand { font-weight: 600; }

        /* Footer hijau */
        .site-footer {
            padding: 1rem 0;
            background: #198754; /* bootstrap bg-success */
            color: #fff;
            margin-top: 3rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-success">
    <div class="container">
        <a class="navbar-brand fw-bold d-flex align-items-center" href="{{ url('/') }}">
            <img src="{{ asset('logo.png') }}" alt="DivaPress" height="100" class="me-2">
        </a>


        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarMain">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarMain">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('blog*') ? 'active' : '' }}"
                       href="{{ route('blog.index') }}">
                        Artikel
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('buku*') ? 'active' : '' }}"
                       href="{{ route('books.front.index') }}">
                        Buku
                    </a>
                </li>
            </ul>

            {{-- Search buku --}}
            <form class="d-flex me-3" action="{{ route('books.front.index') }}" method="GET">
                <input class="form-control form-control-sm me-2"
                       type="search"
                       name="q"
                       placeholder="Cari buku..."
                       value="{{ request('q') }}">
                <button class="btn btn-outline-light btn-sm" type="submit">Cari</button>
            </form>

            {{-- Keranjang --}}
            @php
                $cart = session('cart', []);
                $cartCount = collect($cart)->sum('qty');
            @endphp

            <a href="{{ route('cart.index') }}" class="btn btn-light btn-sm position-relative">
                🛒 Keranjang
                @if($cartCount > 0)
                    <span class="badge bg-danger position-absolute top-0 start-100 translate-middle">
                        {{ $cartCount }}
                    </span>
                @endif
            </a>
        </div>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>

<footer class="site-footer">
    <div class="container text-center">
        © {{ date('Y') }} Suhuf Book
    </div>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
