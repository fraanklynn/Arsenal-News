@extends('layouts.admin')

@section('title', 'Carousel & Trending')

@section('content')
<div class="container-header">
    <h1 class="container-title" style="font-size: 1.5rem;">Carousel & Trending Management</h1>
</div>

@if(session('success'))
    <div class="alert-auto-dismiss" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

@if(session('error'))
    <div class="alert-auto-dismiss" style="background-color: #f8d7da; color: #721c24; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('error') }}
    </div>
@endif

<div class="data-container">
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>News Title</th>
                    <th>Category</th>
                    <th style="text-align: center;">Featured (Carousel)</th>
                    <th style="text-align: center;">Trending</th>
                </tr>
            </thead>
            <tbody>
                @foreach($posts as $post)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 12px;">
                            @php
                                $thumbUrl = str_starts_with($post->image_path, 'images/') 
                                    ? asset($post->image_path) 
                                    : asset('storage/' . $post->image_path);
                            @endphp
                            <img src="{{ $thumbUrl }}" style="width: 60px; aspect-ratio: 16/9; border-radius: 6px; object-fit: cover;">
                            <span style="font-weight: 600;">{{ $post->title }}</span>
                        </div>
                    </td>
                    <td><span class="badge-category">{{ $post->category->name }}</span></td>
                    <td style="text-align: center;">
                        <form action="{{ route('admin.features.toggle-featured', $post) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-status {{ $post->is_featured ? 'btn-active' : 'btn-inactive' }}">
                                <i class="bi {{ $post->is_featured ? 'bi-toggle-on' : 'bi-toggle-off' }}"></i>
                                {{ $post->is_featured ? 'Featured' : 'Regular' }}
                            </button>
                        </form>
                    </td>
                    <td style="text-align: center;">
                        <form action="{{ route('admin.features.toggle-trending', $post) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn-status {{ $post->is_trending ? 'btn-active' : 'btn-inactive' }}">
                                <i class="bi {{ $post->is_trending ? 'bi-fire' : 'bi-dash-circle' }}"></i>
                                {{ $post->is_trending ? 'Trending' : 'Regular' }}
                            </button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $posts->links('vendor.pagination.custom-admin') }}
</div>

@endsection
