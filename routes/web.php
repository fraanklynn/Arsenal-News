<?php

use App\Http\Controllers\NewsController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Route;

Route::get('/', [NewsController::class, 'index']);
Route::get('/news', [NewsController::class, 'news'])->name('news');
Route::get('/news/{slug}', [NewsController::class, 'show'])->name('news.show');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::middleware(['auth'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [\App\Http\Controllers\AdminController::class, 'dashboard'])->name('dashboard');
    Route::resource('posts', \App\Http\Controllers\Admin\PostManagementController::class);
    Route::get('/features', [\App\Http\Controllers\Admin\FeatureController::class, 'index'])->name('features.index');
    Route::post('/features/{post}/toggle-featured', [\App\Http\Controllers\Admin\FeatureController::class, 'toggleFeatured'])->name('features.toggle-featured');
    Route::post('/features/{post}/toggle-trending', [\App\Http\Controllers\Admin\FeatureController::class, 'toggleTrending'])->name('features.toggle-trending');
    Route::resource('authors', \App\Http\Controllers\Admin\AuthorManagementController::class)->except(['create', 'show', 'edit']);
});
