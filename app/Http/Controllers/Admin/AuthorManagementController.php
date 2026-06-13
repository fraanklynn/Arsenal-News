<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Author;
use Illuminate\Http\Request;

class AuthorManagementController extends Controller
{
    public function index()
    {
        $authors = Author::withCount('posts')->latest()->paginate(10);
        return view('admin.authors.index', compact('authors'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:authors,name|regex:/^[a-zA-Z\s\.]+$/',
        ], [
            'name.regex' => 'Nama jurnalis hanya boleh berisi huruf, spasi, atau titik.',
            'name.min' => 'Nama jurnalis terlalu pendek, minimal 3 karakter.',
            'name.unique' => 'Nama jurnalis sudah terdaftar.',
        ]);

        Author::create($validated);

        return back()->with('success', 'Journalist added successfully.');
    }

    public function update(Request $request, Author $author)
    {
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255|unique:authors,name,' . $author->id . '|regex:/^[a-zA-Z\s\.]+$/',
        ], [
            'name.regex' => 'Nama jurnalis hanya boleh berisi huruf, spasi, atau titik.',
            'name.min' => 'Nama jurnalis terlalu pendek, minimal 3 karakter.',
            'name.unique' => 'Nama jurnalis sudah terdaftar.',
        ]);

        $author->update($validated);

        return back()->with('success', 'Journalist updated successfully.');
    }

    public function destroy(Author $author)
    {
        if ($author->posts()->exists()) {
            return back()->with('error', 'Cannot delete journalist: This author still has active news articles assigned.');
        }

        $author->delete();

        return back()->with('success', 'Journalist deleted successfully.');
    }
}
