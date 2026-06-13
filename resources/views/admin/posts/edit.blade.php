@extends('layouts.admin')

@section('title', 'Edit News')

@section('content')
<div class="container-header">
    <h1 class="container-title" style="font-size: 1.5rem;">Edit Article</h1>
    <a href="{{ route('admin.posts.index') }}" class="btn-cancel" style="margin: 0;">
        <i class="bi bi-arrow-left"></i> Back
    </a>
</div>

<div class="admin-card">
    <form action="{{ route('admin.posts.update', $post) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="image" class="form-label">Update Thumbnail Image (Leave empty to keep current)</label>
            @if($post->image_path)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $post->image_path) }}" alt="Current Thumbnail" style="width: 150px; border-radius: 8px; margin-bottom: 10px;">
                </div>
            @endif
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="title" class="form-label">News Title</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" placeholder="Enter news title" required>
        </div>

        <div class="form-group">
            <label for="category_id" class="form-label">Category</label>
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="">Select Category</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="body" class="form-label">Description / Content</label>
            <textarea name="body" id="body" rows="8" class="form-control" placeholder="Write news content here..." required>{{ old('body', $post->body) }}</textarea>
        </div>

        <div class="form-group">
            <label for="author_id" class="form-label">Author / Journalist</label>
            <select name="author_id" id="author_id" class="form-control" required>
                <option value="">Select Author</option>
                @foreach($authors as $author)
                    <option value="{{ $author->id }}" {{ old('author_id', $post->author_id) == $author->id ? 'selected' : '' }}>
                        {{ $author->name }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="excerpt" class="form-label">Short Excerpt (Optional)</label>
            <textarea name="excerpt" id="excerpt" rows="3" class="form-control" placeholder="Brief summary of the article. If left blank, it will be automatically generated from the content.">{{ old('excerpt', $post->excerpt) }}</textarea>
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn-submit">Update News</button>
            <a href="{{ route('admin.posts.index') }}" class="btn-cancel">Cancel</a>
        </div>
    </form>
</div>
@endsection
