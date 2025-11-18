<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>@yield('title', 'Admin DivaPress')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Bootstrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">

    <style>
        body.dark-mode {
            background-color: #121212;
            color: #e4e4e4;
        }

        body.dark-mode .navbar,
        body.dark-mode .sidebar {
            background-color: #1f1f1f !important;
        }

        body.dark-mode .card,
        body.dark-mode .table {
            background-color: #1f1f1f;
            color: #e4e4e4;
        }

        .sidebar {
            min-height: calc(100vh - 56px);
        }

        .sidebar .nav-link {
            color: #ddd;
        }

        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, .1);
            color: #fff;
        }
    </style>
</head>
<body class="{{ session('theme', 'light') === 'dark' ? 'dark-mode' : '' }}">

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
        {{-- Brand --}}
        <a class="navbar-brand" href="{{ route('admin.dashboard') }}">
            <i class="bi bi-speedometer2 me-1"></i> Admin DivaPress
        </a>

        {{-- Dark mode toggle --}}
        <button class="btn btn-outline-light btn-sm me-2" id="toggleDarkMode">
            <i class="bi bi-moon-stars"></i>
        </button>

        {{-- Toggler mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarAdminTop">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarAdminTop">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/blog') }}" target="_blank">
                        <i class="bi bi-box-arrow-up-right me-1"></i> Lihat Blog
                    </a>
                </li>
                <li class="nav-item">
                    <a class="btn btn-outline-light btn-sm ms-2" href="{{ route('logout') }}">
                        <i class="bi bi-box-arrow-right me-1"></i> Logout
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('books.index') }}"
                    class="nav-link {{ request()->routeIs('books.*') ? 'active' : '' }}">
                        <i class="bi bi-book"></i>
                        <span class="ms-2">Buku</span>
                    </a>
                </li>
            </ul>
          

        </div>
    </div>
</nav>

<div class="container-fluid">
    <div class="row">

        {{-- SIDEBAR --}}
        <nav class="col-md-3 col-lg-2 d-md-block bg-dark sidebar py-3">
            <div class="nav flex-column">

                <a href="{{ route('admin.dashboard') }}"
                   class="nav-link d-flex align-items-center mb-1 {{ request()->is('admin') ? 'active' : '' }}">
                    <i class="bi bi-house-door me-2"></i> Dashboard
                </a>

                <a href="{{ route('categories.index') }}"
                   class="nav-link d-flex align-items-center mb-1 {{ request()->is('admin/categories*') ? 'active' : '' }}">
                    <i class="bi bi-tags me-2"></i> Kategori
                </a>

                <a href="{{ route('posts.index') }}"
                   class="nav-link d-flex align-items-center mb-1 {{ request()->is('admin/posts*') ? 'active' : '' }}">
                    <i class="bi bi-journal-text me-2"></i> Postingan
                </a>

                <a href="{{ route('books.index') }}"
                   class="nav-link d-flex align-items-center mb-1 {{ request()->is('admin/books*') ? 'active' : '' }}">
                    <i class="bi bi-book-half me-2"></i> Buku / Produk
                </a>

            </div>
        </nav>

        {{-- KONTEN UTAMA --}}
        <main class="col-md-9 col-lg-10 ms-sm-auto px-4 py-4">
            @yield('content')
        </main>
    </div>
</div>

<footer class="text-center py-3 border-top mt-4">
    © {{ date('Y') }} DivaPress Blog
</footer>

{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // Toggle dark mode + simpan ke localStorage
    const btnToggle = document.getElementById('toggleDarkMode');
    const body = document.body;

    // load dari localStorage
    if (localStorage.getItem('divapress-theme') === 'dark') {
        body.classList.add('dark-mode');
    }

    btnToggle.addEventListener('click', function () {
        body.classList.toggle('dark-mode');
        const mode = body.classList.contains('dark-mode') ? 'dark' : 'light';
        localStorage.setItem('divapress-theme', mode);
    });
</script>

</body>
</html>
