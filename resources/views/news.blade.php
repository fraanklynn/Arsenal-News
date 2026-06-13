@extends('layouts.main')

@push('styles')
    <link href="{{ asset('css/news.css') }}" rel="stylesheet">
@endpush

@section('title', $search ? 'Search: ' . $search . ' | Gunners Wire' : 'Wire Feed | Gunners Wire')

@section('content')
<div class="container mt-5 pt-4">
    <div class="main-content-wrapper">
        <!-- 2 & 3. AREA JUDUL & FILTER DROPDOWN (COMPACT) -->
        <div class="page-header d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 pb-2 border-bottom">
            <div>
                <h1 class="fw-bold text-dark fs-2 mb-0" style="letter-spacing: -0.01em;">WIRE FEED</h1>
                @if($search)
                    <small class="text-secondary">
                        <i class="bi bi-search me-1"></i> Hasil: '<strong>{{ $search }}</strong>'
                    </small>
                @endif
            </div>

            <div class="dropdown mt-2 mt-md-0">
                <button class="btn btn-filter-custom dropdown-toggle px-4 text-uppercase fw-bold filter-category-toggle" type="button" id="categoryDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="bi bi-filter-left me-1"></i> 
                    {{ request('category') ? str_replace('-', ' ', request('category')) : 'Filter Kategori' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-custom dropdown-menu-end shadow-sm" aria-labelledby="categoryDropdown">
                    <li><a class="dropdown-item item-filter-custom {{ !request('category') ? 'active' : '' }}" href="{{ route('news') }}">ALL ARTICLES</a></li>
                    <li><hr class="dropdown-divider opacity-50"></li>
                    @foreach($categories as $category)
                        <li>
                            <a class="dropdown-item item-filter-custom {{ request('category') == $category->slug ? 'active' : '' }} text-uppercase" 
                               href="{{ route('news', ['category' => $category->slug] + request()->except('category', 'page')) }}">
                                {{ $category->name }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- 4 & 5. ARTICLE GRID & CARD DATA BINDING -->
        @if($posts->isEmpty())
            <!-- 6. LOGIKA DATA KOSONG -->
            <div class="text-center py-5 my-5">
                <i class="bi bi-newspaper text-secondary mb-3" style="font-size: 4rem;"></i>
                <h4 class="text-secondary fw-bold">Maaf, berita tidak ditemukan atau belum tersedia.</h4>
                <p class="text-muted">Coba gunakan kata kunci lain atau pilih kategori yang berbeda.</p>
                <a href="/news" class="btn btn-arsenal-red mt-3 px-4">Reset Filter</a>
            </div>
        @else
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4 mb-5">
                @foreach ($posts as $post)
                    <div class="col">
                        <article class="card card-news-custom h-100 border-0 shadow-sm">
                            <!-- Gambar utama artikel -->
                            <div class="card-img-wrapper position-relative overflow-hidden">
                                @php
                                    $postImg = $post->image_path ? (str_starts_with($post->image_path, 'images/') ? asset($post->image_path) : asset('storage/' . $post->image_path)) : null;
                                @endphp
                                @if ($postImg)
                                    <a href="{{ route('news.show', $post->slug) }}">
                                        <img src="{{ $postImg }}" class="card-img-top" alt="{{ $post->title }}" style="height: 220px; object-fit: cover; transition: transform 0.3s ease;">
                                    </a>
                                @else
                                    <a href="{{ route('news.show', $post->slug) }}" class="card-img-top img-placeholder-gradient-{{ ($loop->index % 5) + 1 }} d-flex align-items-center justify-content-center text-decoration-none" style="height: 220px;">
                                        <i class="bi bi-newspaper text-white-50" style="font-size: 3.5rem;"></i>
                                    </a>
                                @endif
                                <!-- Label (badge) kategori kustom melayang -->
                                <a href="{{ route('news', ['category' => $post->category->slug]) }}" class="badge position-absolute top-0 start-0 m-3 custom-badge-style text-decoration-none">
                                    {{ $post->category->name }}
                                </a>
                            </div>

                            <div class="card-body p-4">
                                <!-- Tanggal rilis artikel -->
                                <div class="d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-calendar3 text-secondary" style="font-size: 0.8rem;"></i>
                                    <small class="text-secondary fw-semibold">{{ $post->created_at->format('d M Y') }}</small>
                                </div>

                                <!-- Judul berita utama -->
                                <h5 class="card-title fw-bold mb-3">
                                    <a href="{{ route('news.show', $post->slug) }}" class="text-dark text-decoration-none hover-red">{{ $post->title }}</a>
                                </h5>

                                <!-- Ringkasan teks pendek -->
                                <p class="card-text text-muted small mb-0">
                                    {{ str($post->excerpt)->limit(110) }}
                                </p>

                                <!-- Nama Penulis secara dinamis -->
                                <p class="text-author-custom mt-3 mb-0">By {{ $post->author->name ?? 'Admin' }}</p>
                            </div>

                            <div class="card-footer bg-white border-0 p-4 pt-0 mt-auto">
                                <a href="{{ route('news.show', $post->slug) }}" class="btn btn-link p-0 text-arsenal-red fw-bold text-decoration-none small">
                                    READ NEWS <i class="bi bi-arrow-right ms-1"></i>
                                </a>
                            </div>
                        </article>
                    </div>
                @endforeach
            </div>

            <!-- 6. NAVIGATION (PAGINATION) -->
            <div class="d-flex justify-content-center mt-5">
                {{ $posts->links('pagination::bootstrap-5') }}
            </div>
        @endif
    </div>
</div>
@endsection
