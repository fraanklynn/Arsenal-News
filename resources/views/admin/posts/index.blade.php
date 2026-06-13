@extends('layouts.admin')

@section('title', 'Manage News')

@section('content')
<div class="container-header">
    <h1 class="container-title" style="font-size: 1.5rem;">Manage News</h1>
    <button type="button" class="btn-add" id="openAddModal">
        <i class="bi bi-plus-lg"></i>
        Add News
    </button>
</div>

@if(session('success'))
    <div class="alert-auto-dismiss" style="background-color: #d4edda; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
        {{ session('success') }}
    </div>
@endif

<div class="news-list">
    @forelse($posts as $post)
        @php
            $imageUrl = str_starts_with($post->image_path, 'images/') 
                ? asset($post->image_path) 
                : asset('storage/' . $post->image_path);
        @endphp
        <div class="post-card">
            <div class="post-image-container">
                <img src="{{ $imageUrl }}" alt="{{ $post->title }}" class="post-image">
            </div>
            <div class="post-content">
                <span class="post-category-tag">{{ $post->category->name }}</span>
                <h2 class="post-title">{{ $post->title }}</h2>
                <p class="post-excerpt">{{ $post->excerpt }}</p>
                
                <div class="post-meta">
                    <span><i class="bi bi-person-circle me-1"></i> {{ $post->author->name }}</span>
                    <span><i class="bi bi-clock-history me-1"></i> {{ $post->created_at->format('d M Y') }}</span>
                </div>

                <div class="post-actions">
                    <button type="button" class="btn-edit" 
                        onclick="openEditModal({{ json_encode([
                            'id' => $post->id,
                            'title' => $post->title,
                            'category_id' => $post->category_id,
                            'author_id' => $post->author_id,
                            'body' => $post->body,
                            'image_url' => $imageUrl
                        ]) }})">
                        <i class="bi bi-pencil-square"></i> Edit
                    </button>
                    <button type="button" class="btn-delete" onclick="confirmDelete({{ $post->id }}, '{{ addslashes($post->title) }}')">
                        <i class="bi bi-trash3-fill"></i> Delete
                    </button>
                </div>
            </div>
        </div>
    @empty
        <div class="admin-card text-center py-5">
            <p class="text-muted">No news articles found. Start by adding one!</p>
        </div>
    @endforelse
</div>

<div class="mt-4">
    {{ $posts->links('vendor.pagination.custom-admin') }}
</div>

<div class="modal-overlay" id="addModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Add New Article</h2>
            <button class="close-modal" id="closeAddModal">&times;</button>
        </div>
        <form action="{{ route('admin.posts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group">
                <label for="image" class="form-label">Thumbnail Image</label>
                <input type="file" name="image" id="image" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="title" class="form-label">News Title</label>
                <input type="text" name="title" id="title" class="form-control" placeholder="Enter news title" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="category_id" class="form-label">Category</label>
                    <select name="category_id" id="category_id" class="form-control" required>
                        <option value="">Select Category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="author_id" class="form-label">Author</label>
                    <select name="author_id" id="author_id" class="form-control" required>
                        <option value="">Select Author</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="body" class="form-label">Description / Content</label>
                <textarea name="body" id="body" rows="6" class="form-control" placeholder="Write news content here..." required></textarea>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn-submit"><i class="bi bi-send-fill"></i> Publish News</button>
                <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="editModal">
    <div class="modal-content">
        <div class="modal-header">
            <h2 class="modal-title">Edit Article</h2>
            <button class="close-modal" id="closeEditModal">&times;</button>
        </div>
        <form id="editForm" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <div class="form-group">
                <label class="form-label">Current Thumbnail</label>
                <div id="editImagePreview" class="mb-3">
                    <img src="" style="width: 100%; aspect-ratio: 16/9; object-fit: cover; border-radius: 12px;">
                </div>
                <input type="file" name="image" class="form-control">
                <small class="text-muted">Leave empty to keep current image</small>
            </div>

            <div class="form-group">
                <label for="edit_title" class="form-label">News Title</label>
                <input type="text" name="title" id="edit_title" class="form-control" required>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
                <div class="form-group">
                    <label for="edit_category_id" class="form-label">Category</label>
                    <select name="category_id" id="edit_category_id" class="form-control" required>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="edit_author_id" class="form-label">Author</label>
                    <select name="author_id" id="edit_author_id" class="form-control" required>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}">{{ $author->name }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group">
                <label for="edit_body" class="form-label">Description / Content</label>
                <textarea name="body" id="edit_body" rows="6" class="form-control" required></textarea>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn-submit"><i class="bi bi-check-circle-fill"></i> Save Changes</button>
                <button type="button" class="btn-cancel" onclick="closeModal('editModal')">Cancel</button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="deleteModal">
    <div class="modal-content delete-modal-content">
        <div class="delete-icon-box">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <h2 class="delete-title">Are you sure?</h2>
        <p class="delete-text">You are about to delete <br><strong id="deleteTargetTitle"></strong>.<br>This action cannot be undone!</p>
        
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="delete-actions">
                <button type="submit" class="btn-confirm-delete">Yes, Delete it</button>
                <button type="button" class="btn-cancel-delete" onclick="closeModal('deleteModal')">No, Keep it</button>
            </div>
        </form>
    </div>
</div>

@push('scripts')
<script>
    function openModal(id) { document.getElementById(id).classList.add('active'); }
    function closeModal(id) { document.getElementById(id).classList.remove('active'); }

    document.getElementById('openAddModal').onclick = () => openModal('addModal');
    document.getElementById('closeAddModal').onclick = () => closeModal('addModal');
    document.getElementById('closeEditModal').onclick = () => closeModal('editModal');

    function openEditModal(data) {
        const form = document.getElementById('editForm');
        form.action = `/admin/posts/${data.id}`;
        document.getElementById('edit_title').value = data.title;
        document.getElementById('edit_category_id').value = data.category_id;
        document.getElementById('edit_author_id').value = data.author_id;
        document.getElementById('edit_body').value = data.body;
        document.querySelector('#editImagePreview img').src = data.image_url;
        openModal('editModal');
    }

    function confirmDelete(id, title) {
        const form = document.getElementById('deleteForm');
        form.action = `/admin/posts/${id}`;
        document.getElementById('deleteTargetTitle').innerText = title;
        openModal('deleteModal');
    }

    window.onclick = (e) => {
        if (e.target.classList.contains('modal-overlay')) {
            e.target.classList.remove('active');
        }
    };
</script>
@endpush
@endsection
