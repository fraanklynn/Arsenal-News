<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class FeatureController extends Controller
{
    public function index()
    {
        $posts = Post::with('category')->latest()->paginate(10);
        return view('admin.features.index', compact('posts'));
    }

    public function toggleFeatured(Post $post)
    {
        if (!$post->is_featured) {
            $featuredCount = Post::where('is_featured', true)->count();
            if ($featuredCount >= 3) {
                return back()->with('error', 'Maximum 3 carousel posts allowed. Please uncheck another post first.');
            }
        }
        
        $post->update(['is_featured' => !$post->is_featured]);
        return back()->with('success', 'Carousel status updated.');
    }

    public function toggleTrending(Post $post)
    {
        if (!$post->is_trending) {
            $trendingCount = Post::where('is_trending', true)->count();
            if ($trendingCount >= 4) {
                return back()->with('error', 'Maximum 4 trending posts allowed. Please uncheck another post first.');
            }
        }
        
        $post->update(['is_trending' => !$post->is_trending]);
        return back()->with('success', 'Trending status updated.');
    }
}
