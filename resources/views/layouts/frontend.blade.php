<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Blog' }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="/blog">DivaPress Blog edit</a>

        <form action="/blog/search" class="d-flex ms-auto">
            <input type="text" name="q" class="form-control me-2" placeholder="Cari artikel...">
            <button class="btn btn-outline-light">Search</button>
        </form>
    </div>
</nav>

<div class="container py-4">
    @yield('content')
</div>

<footer class="bg-dark text-white text-center py-3 mt-5">
    &copy; {{ date('Y') }} DivaPress Blog
</footer>

</body>
</html>
