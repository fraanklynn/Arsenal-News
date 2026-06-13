@extends('layouts.main')

@section('title', $post->title)

@push('styles')
<link rel="stylesheet" href="{{ asset('css/news-detail.css') }}">
@endpush

@section('content')
<div class="news-detail-wrapper py-5">
    <div class="container">
        <div class="row g-lg-5">
            <!-- Main Content -->
            <div class="col-lg-8">
                <nav aria-label="breadcrumb" class="mb-4">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/" class="text-decoration-none text-muted small">Home</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('news', ['category' => $post->category->slug]) }}" class="text-decoration-none text-muted small">{{ $post->category->name }}</a></li>
                        <li class="breadcrumb-item active small" aria-current="page">News Detail</li>
                    </ol>
                </nav>

                <article class="article-container bg-white p-4 p-md-5 rounded-4 shadow-sm border border-light">
                    <header class="mb-4">
                        <a href="{{ route('news', ['category' => $post->category->slug]) }}" class="badge bg-arsenal-red text-white text-decoration-none px-3 py-2 rounded-2 mb-3 shadow-sm" style="font-size: 0.75rem; letter-spacing: 0.05em;">
                            {{ strtoupper($post->category->name) }}
                        </a>
                        <h1 class="display-5 fw-bold text-navy mb-4" style="line-height: 1.2;">{{ $post->title }}</h1>
                        
                        <div class="author-meta-card d-flex align-items-center p-3 rounded-3 bg-light border-start border-4 border-arsenal-red mb-4">
                            <div class="author-avatar me-3">
                                <div class="bg-navy text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 48px; height: 48px;">
                                    <i class="bi bi-person-fill fs-4"></i>
                                </div>
                            </div>
                            <div class="author-info">
                                <p class="mb-0 text-muted small">Written by</p>
                                <h6 class="mb-0 fw-bold">{{ $post->author->name }}</h6>
                            </div>
                            <div class="ms-auto text-end d-none d-sm-block">
                                <p class="mb-0 text-muted small">Published on</p>
                                <h6 class="mb-0 fw-bold">{{ $post->created_at->format('d M Y, H:i') }} WIB</h6>
                            </div>
                        </div>
                    </header>

                    @php
                        $imageUrl = $post->image_path ? (str_starts_with($post->image_path, 'images/') ? asset($post->image_path) : asset('storage/' . $post->image_path)) : null;
                    @endphp
                    
                    @if($imageUrl)
                    <div class="article-image-wrapper mb-5 position-relative">
                        <img src="{{ $imageUrl }}" class="img-fluid rounded-4 w-100 shadow" alt="{{ $post->title }}" style="max-height: 500px; object-fit: cover;">
                        <div class="image-accent"></div>
                    </div>
                    @endif

                    <div class="article-body">
                        <p class="lead fw-semibold text-muted mb-4" style="line-height: 1.6;">{{ $post->excerpt }}</p>
                        <div class="article-content text-dark" style="font-size: 1.125rem; line-height: 1.8; text-align: justify;">
                            {!! nl2br(e($post->body)) !!}
                        </div>
                    </div>

                    <div class="article-footer mt-5 pt-4 border-top">
                        <a href="{{ route('news') }}" class="btn btn-navy px-4 py-2 rounded-3 fw-semibold">
                            <i class="bi bi-arrow-left me-2"></i> Back to News Archive
                        </a>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <div class="col-lg-4 mt-5 mt-lg-0">
                <div class="sticky-sidebar-outer">
                    <div class="sticky-sidebar-inner" style="top: 100px;">
                        <!-- Trending Sidebar -->
                        <div class="sidebar-card mb-4 bg-white rounded-4 shadow-sm border border-light overflow-hidden">
                            <div class="sidebar-header p-4 bg-navy text-white d-flex align-items-center gap-2">
                                <i class="bi bi-fire text-warning fs-4"></i>
                                <h5 class="mb-0 fw-bold">Trending Now</h5>
                            </div>
                            <div class="sidebar-body p-4">
                                @foreach($trendingPosts as $trend)
                                    <div class="trending-mini-item {{ !$loop->last ? 'mb-4 pb-3 border-bottom border-light' : '' }}">
                                        <div class="d-flex gap-3">
                                            @php
                                                $trendImg = $trend->image_path ? (str_starts_with($trend->image_path, 'images/') ? asset($trend->image_path) : asset('storage/' . $trend->image_path)) : null;
                                            @endphp
                                            @if($trendImg)
                                                <img src="{{ $trendImg }}" class="rounded-3 shadow-sm" width="90" height="60" style="object-fit: cover;">
                                            @endif
                                            <div class="flex-grow-1">
                                                <h6 class="mb-1" style="font-size: 0.95rem; line-height: 1.4;">
                                                    <a href="{{ route('news.show', $trend->slug) }}" class="text-decoration-none text-navy hover-red fw-bold d-block">{{ Str::limit($trend->title, 60) }}</a>
                                                </h6>
                                                <small class="text-muted"><i class="bi bi-clock me-1"></i> {{ $trend->created_at->format('d M Y') }}</small>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="sidebar-card bg-white rounded-4 shadow-sm border border-light p-4">
                            <h5 class="sidebar-widget-title mb-4 pb-2 border-bottom fw-bold text-navy">Categories</h5>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach($categories as $cat)
                                    <a href="{{ route('news', ['category' => $cat->slug]) }}" class="category-pill-v2">{{ $cat->name }}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
