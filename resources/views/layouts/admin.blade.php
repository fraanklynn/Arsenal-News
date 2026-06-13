<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Dashboard') | Gunners Wire</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&family=Inter:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar" id="sidebar">
            <div class="sidebar-header">
                <div class="sidebar-brand">GUNNERS WIRE</div>
                <button class="toggle-btn" id="sidebarToggle">
                    <i class="bi bi-arrow-left-circle-fill"></i>
                </button>
            </div>

            <nav class="sidebar-nav">
                <div class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                        <i class="bi bi-speedometer2"></i>
                        <span>Dashboard</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.posts.index') }}" class="nav-link {{ request()->routeIs('admin.posts.*') ? 'active' : '' }}">
                        <i class="bi bi-newspaper"></i>
                        <span>Manage News</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.features.index') }}" class="nav-link {{ request()->routeIs('admin.features.*') ? 'active' : '' }}">
                        <i class="bi bi-star-fill"></i>
                        <span>Carousel & Trending</span>
                    </a>
                </div>
                <div class="nav-item">
                    <a href="{{ route('admin.authors.index') }}" class="nav-link {{ request()->routeIs('admin.authors.*') ? 'active' : '' }}">
                        <i class="bi bi-people-fill"></i>
                        <span>Manage Journalist</span>
                    </a>
                </div>
            </nav>

            <div class="sidebar-footer">
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="logout-btn">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <main class="main-content">
            @yield('content')
        </main>
    </div>

    <script>
        const sidebar = document.getElementById('sidebar');
        const sidebarToggle = document.getElementById('sidebarToggle');

        sidebarToggle.addEventListener('click', () => {
            sidebar.classList.toggle('collapsed');
        });

        document.addEventListener('DOMContentLoaded', function() {
            @if(session('success'))
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{{ session('success') }}",
                    timer: 3000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    toast: true,
                    position: 'top-end'
                });
            @endif

            @if(session('error'))
                Swal.fire({
                    icon: 'error',
                    title: 'Kesalahan!',
                    text: "{{ session('error') }}",
                    confirmButtonColor: '#EF0107'
                });
            @endif

            @if($errors->any())
                let errorMessages = '';
                @foreach($errors->all() as $error)
                    errorMessages += '{{ $error }}\n';
                @endforeach
                
                Swal.fire({
                    icon: 'error',
                    title: 'Validasi Gagal!',
                    text: errorMessages,
                    confirmButtonColor: '#EF0107'
                });
            @endif
        });
    </script>
    @stack('scripts')
</body>
</html>
