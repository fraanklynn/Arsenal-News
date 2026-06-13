<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class PostManagementController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'author'])->latest()->paginate(10);
        $categories = Category::all();
        $authors = Author::all();
        return view('admin.posts.index', compact('posts', 'categories', 'authors'));
    }

    public function create()
    {
        return redirect()->route('admin.posts.index');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:10|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'body' => 'required|string|min:50',
            'excerpt' => 'nullable|string|max:255',
        ], [
            'title.min' => 'Judul berita terlalu pendek, minimal 10 karakter.',
            'body.min' => 'Isi berita terlalu pendek, minimal 50 karakter.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $imagePath = $request->file('image')->store('posts', 'public');

        Post::create([
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'image_path' => $imagePath,
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'body' => $validated['body'],
            'excerpt' => $validated['excerpt'] ?? Str::limit(strip_tags($validated['body']), 150),
        ]);

        return redirect()->route('admin.posts.index')->with('success', 'News created successfully.');
    }

    public function edit(Post $post)
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('admin.posts.edit', compact('post', 'categories', 'authors'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|min:10|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
            'category_id' => 'required|exists:categories,id',
            'author_id' => 'required|exists:authors,id',
            'body' => 'required|string|min:50',
            'excerpt' => 'nullable|string|max:255',
        ], [
            'title.min' => 'Judul berita terlalu pendek, minimal 10 karakter.',
            'body.min' => 'Isi berita terlalu pendek, minimal 50 karakter.',
            'image.image' => 'File harus berupa gambar.',
            'image.mimes' => 'Format gambar harus jpeg, png, jpg, atau webp.',
            'image.max' => 'Ukuran gambar maksimal adalah 2MB.',
        ]);

        $data = [
            'title' => $validated['title'],
            'slug' => Str::slug($validated['title']),
            'category_id' => $validated['category_id'],
            'author_id' => $validated['author_id'],
            'body' => $validated['body'],
            'excerpt' => $validated['excerpt'] ?? Str::limit(strip_tags($validated['body']), 150),
        ];

        if ($request->hasFile('image')) {
            if ($post->image_path) {
                Storage::disk('public')->delete($post->image_path);
            }
            $data['image_path'] = $request->file('image')->store('posts', 'public');
        }

        $post->update($data);

        return redirect()->route('admin.posts.index')->with('success', 'News updated successfully.');
    }

    public function destroy(Post $post)
    {
        if ($post->image_path) {
            Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();

        return redirect()->route('admin.posts.index')->with('success', 'News deleted successfully.');
    }
}
