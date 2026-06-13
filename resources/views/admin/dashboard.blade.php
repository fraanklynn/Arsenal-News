@extends('layouts.admin')

@section('title', 'Dashboard')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
@endpush

@section('content')
<div class="welcome-banner">
    <div class="welcome-text">
        <h1>Hello, Lewis</h1>
        <p>Welcome back to Gunners Wire control panel</p>
    </div>
    <div class="banner-avatar">⚽</div>
</div>

<div class="stats-grid">
    <div class="stat-card">
        <span class="stat-label">Total News</span>
        <span class="stat-value">{{ $totalNews }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Total Categories</span>
        <span class="stat-value">{{ $totalCategories }}</span>
    </div>
    <div class="stat-card">
        <span class="stat-label">Total Journalist</span>
        <span class="stat-value">{{ $totalJournalists }}</span>
    </div>
</div>

<div class="data-container">
    <div class="container-header">
        <h2 class="container-title">Recent News</h2>
    </div>
    
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th style="width: 60%;">Judul Berita</th>
                    <th>Kategori</th>
                    <th>Tanggal Rilis</th>
                </tr>
            </thead>
            <tbody>
                @forelse($recentNews as $news)
                <tr>
                    <td>
                        <div class="d-flex align-items-center gap-3">
                            @php
                                $thumbUrl = str_starts_with($news->image_path, 'images/') 
                                    ? asset($news->image_path) 
                                    : asset('storage/' . $news->image_path);
                            @endphp
                            <img src="{{ $thumbUrl }}" class="rounded shadow-sm" style="width: 60px; aspect-ratio: 16/9; object-fit: cover;">
                            <span class="fw-semibold text-navy">{{ $news->title }}</span>
                        </div>
                    </td>
                    <td>
                        <span class="badge-category">{{ $news->category->name }}</span>
                    </td>
                    <td>{{ $news->created_at->format('d M Y') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4">No news found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection
