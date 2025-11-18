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
        footer {
            padding: 1rem 0;
            background: #212529;
            color: #fff;
            margin-top: 3rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="{{ route('blog.index') }}">DivaPress Blog</a>

        {{-- form search global --}}
        <form class="d-flex" method="GET" action="{{ route('blog.index') }}">
            <input type="search"
                   name="q"
                   class="form-control form-control-sm me-2"
                   placeholder="Cari artikel..."
                   value="{{ request('q') }}">
            <button class="btn btn-outline-light btn-sm">Search</button>
        </form>
    </div>
</nav>

<main class="py-4">
    @yield('content')
</main>

<footer>
    <div class="container text-center small">
        © {{ date('Y') }} DivaPress Blog edit
    </div>
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
