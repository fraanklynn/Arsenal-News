@extends('layouts.main')

@section('content')
    @if($trendingPosts->count() > 0)
    <div class="breaking-news-ticker">
        <div class="container d-flex align-items-center ps-0">
            <span class="breaking-label">BREAKING</span>
            <div class="breaking-text-wrapper">
                <div class="breaking-text">
                    @foreach ($trendingPosts as $item)
                        {{ $item->excerpt }}
                        <span class="ticker-sep">|</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    @endif

    @if($carouselPosts->count() > 0)
    <div id="heroCarousel" class="carousel slide hero-carousel" data-bs-ride="carousel" data-bs-interval="4000">
        <div class="carousel-indicators">
            @foreach ($carouselPosts as $key => $slide)
                <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="{{ $key }}" class="{{ $key === 0 ? 'active' : '' }}" aria-current="{{ $key === 0 ? 'true' : 'false' }}"></button>
            @endforeach
        </div>

        <div class="carousel-inner">
            @foreach ($carouselPosts as $key => $post)
                <div class="carousel-item {{ $key === 0 ? 'active' : '' }}">
                    @php
                        $imageUrl = $post->image_path ? (str_starts_with($post->image_path, 'images/') ? asset($post->image_path) : asset('storage/' . $post->image_path)) : null;
                    @endphp
                    <div class="hero-slide {{ $imageUrl ? '' : 'img-placeholder-gradient-' . (($key % 5) + 1) }}" @if ($imageUrl) style="background-image: url('{{ $imageUrl }}'); background-size: cover; background-position: center top;" @endif>
                        <div class="hero-overlay"></div>
                        <div class="hero-content">
                            <div class="container">
                                <span class="hero-category-badge">{{ $post->category->name }}</span>
                                <h1 class="text-white fw-bold mb-2" style="max-width: 700px;">{{ $post->title }}</h1>
                                <p class="text-white-50 mb-3" style="max-width: 550px;">{{ $post->excerpt }}</p>
                                <a href="{{ route('news.show', $post->slug) }}" class="btn btn-arsenal-red btn-sm px-4 py-2 rounded-1 fw-semibold">Read News <i class="bi bi-arrow-right ms-1"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    @endif

    <div class="container">
        <div class="main-content-wrapper">
            <div class="row g-4">
                <div class="col-lg-8">
                    <div class="section-header">
                        <div class="section-header-bar"></div>
                        <h2>Latest News</h2>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 g-3">
                        @foreach ($latestPosts as $post)
                            <div class="col">
                                <article class="card news-card">
                                    <div class="card-img-wrapper">
                                        <span class="card-category-badge">{{ $post->category->name }}</span>
                                        @php
                                            $postImg = $post->image_path ? (str_starts_with($post->image_path, 'images/') ? asset($post->image_path) : asset('storage/' . $post->image_path)) : null;
                                        @endphp
                                        @if ($postImg)
                                            <a href="{{ route('news.show', $post->slug) }}">
                                                <img src="{{ $postImg }}" class="card-img-top" alt="{{ $post->title }}" style="height: 180px; object-fit: cover;">
                                            </a>
                                        @else
                                            <a href="{{ route('news.show', $post->slug) }}" class="card-img-top img-placeholder-gradient-{{ ($loop->index % 5) + 1 }} d-flex align-items-center justify-content-center text-decoration-none">
                                                <i class="bi bi-newspaper text-white-50" style="font-size: 2.5rem;"></i>
                                            </a>
                                        @endif
                                    </div>
                                    <div class="card-body">
                                        <small class="text-secondary">{{ $post->created_at->format('d M Y') }}</small>
                                        <h5 class="card-title"><a href="{{ route('news.show', $post->slug) }}" class="text-decoration-none text-dark">{{ $post->title }}</a></h5>
                                        <p class="card-text">{{ $post->excerpt }}</p>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="section-header">
                        <div class="section-header-bar"></div>
                        <h2><i class="bi bi-graph-up-arrow me-1 text-arsenal-red"></i> Trending Now</h2>
                    </div>

                    @foreach ($trendingPosts as $post)
                        <div class="trending-item">
                            @php
                                $trendImg = $post->image_path ? (str_starts_with($post->image_path, 'images/') ? asset($post->image_path) : asset('storage/' . $post->image_path)) : null;
                            @endphp
                            @if ($trendImg)
                                <a href="{{ route('news.show', $post->slug) }}" class="trending-thumb" style="background-image: url('{{ $trendImg }}'); background-size: cover; background-position: center;"></a>
                            @else
                                <a href="{{ route('news.show', $post->slug) }}" class="trending-thumb img-placeholder-gradient-{{ ($loop->index % 5) + 1 }} d-flex align-items-center justify-content-center text-decoration-none">
                                    <i class="bi bi-newspaper text-white-50" style="font-size: 1.25rem;"></i>
                                </a>
                            @endif
                            <div class="trending-info">
                                <h6><a href="{{ route('news.show', $post->slug) }}" class="text-decoration-none text-dark">{{ $post->title }}</a></h6>
                                <span class="trending-date">{{ $post->created_at->format('d M Y') }}</span>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
