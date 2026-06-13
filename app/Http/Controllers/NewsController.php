<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        $carouselPosts = Post::with('category')
            ->where('is_featured', true)
            ->latest()
            ->take(5)
            ->get();

        $latestPosts = Post::with('category')
            ->latest()
            ->take(8)
            ->get();

        $trendingPosts = Post::with('category')
            ->where('is_trending', true)
            ->latest()
            ->take(8)
            ->get();

        return view('home', compact('carouselPosts', 'latestPosts', 'trendingPosts', 'categories'));
    }

    public function show($slug)
    {
        $post = Post::with(['category', 'author'])->where('slug', $slug)->firstOrFail();
        $categories = Category::all();
        $trendingPosts = Post::where('is_trending', true)->latest()->take(5)->get();

        return view('news-detail', compact('post', 'categories', 'trendingPosts'));
    }

    public function news(Request $request)
    {
        $categories = Category::all();
        $query = Post::with(['category', 'author'])->latest();

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('body', 'like', "%{$search}%");
            });
        }

        if ($request->filled('category')) {
            $query->whereHas('category', function($q) use ($request) {
                $q->where('slug', $request->category);
            });
        }

        $posts = $query->paginate(10)->withQueryString();
        $search = $request->search;

        return view('news', compact('posts', 'categories', 'search'));
    }
}
