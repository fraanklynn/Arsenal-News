<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $totalNews = Post::count();
        $totalCategories = Category::count();
        $totalJournalists = Author::count();
        $recentNews = Post::with('category')->latest()->take(5)->get();

        return view('admin.dashboard', compact('totalNews', 'totalCategories', 'totalJournalists', 'recentNews'));
    }
}
