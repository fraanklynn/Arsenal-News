@extends('layouts.main')

@section('title', 'Login | Gunners Wire')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/login.css') }}">
@endpush

@section('content')
<div class="login-container">
    <div class="login-box-glass">
        <div class="text-center mb-4">
            <img src="{{ asset('images/Arsenal_FC_Logo.png') }}" alt="Arsenal Logo" height="60" class="mb-2">
            <h2 class="fw-bold text-white mb-0" style="letter-spacing: 0.1em;">GUNNERS WIRE</h2>
            <p class="text-white-50 small">Portal Admin</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div style="margin-bottom: 15px !important;">
                <label for="username" class="form-label text-white-50 small mb-1">Username</label>
                <input type="text" name="username" id="username" class="form-control login-input" placeholder="Username" value="{{ old('username') }}" required autofocus>
                @error('username')
                    <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                @enderror
            </div>

            <div style="margin-bottom: 15px !important;">
                <label for="password" class="form-label text-white-50 small mb-1">Password</label>
                <input type="password" name="password" id="password" class="form-control login-input" placeholder="••••••••" required>
                @error('password')
                    <span class="text-danger small mt-1 d-block">{{ $message }}</span>
                @enderror
            </div>

            <div class="d-grid">
                <button type="submit" class="btn btn-login-arsenal fw-bold">
                    SIGN IN
                </button>
            </div>


            <div class="text-center mt-4">
                <a href="/" class="text-white-50 text-decoration-none small hover-white">
                    <i class="bi bi-arrow-left me-1"></i> Back to Home
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
