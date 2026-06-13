<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', config('app.name', 'Arsenal News'))</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="{{ asset('css/home.css') }}" rel="stylesheet">
    //@vite(['resources/js/app.js'])
    @stack('styles')
</head>
<body>

    <nav class="navbar navbar-expand-lg" id="mainNav">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center gap-2 py-0" href="/">
                <img src="{{ asset('images/Arsenal_FC_Logo.png') }}" alt="Arsenal" height="38" width="auto">
                <span class="fw-bold fs-5" style="letter-spacing: 0.06em; color: #2D2D2D;"> GUNNERS WIRE</span>
            </a>

            <button class="navbar-toggler border-0" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu" aria-controls="navMenu" aria-expanded="false" aria-label="Toggle menu">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navMenu">
                <ul class="navbar-nav gap-lg-5">
                    <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/"><i class="bi bi-house-door me-1"></i>HOME</a></li>
                    <li class="nav-item"><a class="nav-link {{ Request::is('news*') ? 'active' : '' }}" href="/news"><i class="bi bi-newspaper me-1"></i>NEWS</a></li>
                </ul>
            </div>

            <div class="d-flex align-items-center gap-3">
                <form action="/news" method="GET" class="d-none d-lg-flex align-items-center bg-white rounded-pill px-3 border" style="border-color: #E0E0E0 !important;">
                    <i class="bi bi-search text-secondary me-2"></i>
                    <input class="form-control border-0 bg-transparent px-0 py-2" type="search" name="search" value="{{ request('search') }}" placeholder="Search" aria-label="Search" style="font-size: 0.875rem; outline: none; box-shadow: none; width: 200px; color: #555555;">
                </form>
                @auth
                    <div class="dropdown">
                        <a href="#" class="btn btn-link p-1 text-decoration-none" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Profile" style="color: #2D2D2D;">
                            <i class="bi bi-person-circle fs-5"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                            <li><a class="dropdown-item" href="/admin/dashboard"><i class="bi bi-speedometer2 me-2"></i>Dashboard</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <a class="dropdown-item" href="#"
                                onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    <i class="bi bi-box-arrow-right me-2"></i>Logout
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </div>
                @else
                    <a href="/login" class="btn btn-link p-1 text-decoration-none" aria-label="Login" style="color: #2D2D2D;">
                        <i class="bi bi-person-circle fs-5"></i>
                    </a>
                @endauth
            </div>
        </div>
    </nav>

    @yield('content')

    <footer class="site-footer py-5 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <img src="{{ asset('images/Arsenal_FC_Logo.png') }}" alt="Arsenal" height="40" width="auto">
                        <h5 class="mb-0 text-white" style="letter-spacing: 0.06em;">GUNNERS WIRE</h5>
                    </div>
                    <p class="text-white-50 small mb-0" style="max-width: 400px;">
                        Pusat berita, rumor transfer, dan kabar terbaru seputar Arsenal FC, dipersembahkan oleh fans untuk fans.
                    </p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5 class="text-white mb-3">KATEGORI BERITA</h5>
                    <ul class="list-unstyled mb-0">
                        @isset($categories)
                            @foreach($categories as $footerCat)
                                <li><a href="{{ route('news', ['category' => $footerCat->slug]) }}" class="small text-decoration-none text-white-50 hover-white">{{ $footerCat->name }}</a></li>
                            @endforeach
                        @else
                            <li><a href="#" class="small">Match Review</a></li>
                            <li><a href="#" class="small">Transfer Rumours</a></li>
                            <li><a href="#" class="small">First Team</a></li>
                        @endisset
                    </ul>
                </div>
            </div>

            <div class="footer-bottom d-flex flex-column flex-md-row justify-content-between align-items-center gap-3">
                <span class="small">Developed by <span class="text-white">Franklyn Galvin</span></span>
                <span class="small">&copy; 2026 Gunners Wire. All rights reserved.</span>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        window.addEventListener('scroll', function() {
            var nav = document.getElementById('mainNav');
            if (window.scrollY > 50) {
                nav.classList.add('navbar-shrink');
            } else {
                nav.classList.remove('navbar-shrink');
            }
        });
    </script>
    @stack('scripts')
</body>
</html>
