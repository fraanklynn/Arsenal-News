@extends('layouts.admin')

@section('title', 'Manage Journalist')

@section('content')
<div class="container-header">
    <h1 class="container-title" style="font-size: 1.5rem;">Journalist Management</h1>
    <button type="button" class="btn-add" id="openAddModal">
        <i class="bi bi-person-plus-fill"></i>
        Add Journalist
    </button>
</div>

<div class="data-container">
    <div class="table-responsive">
        <table class="custom-table">
            <thead>
                <tr>
                    <th>Journalist Name</th>
                    <th style="text-align: center;">Total News</th>
                    <th style="text-align: center;">Action</th>
                </tr>
            </thead>
            <tbody>
                @forelse($authors as $author)
                <tr>
                    <td>
                        <div style="display: flex; align-items: center; gap: 15px;">
                            <div class="avatar-small" style="width: 40px; height: 40px; background: #fff1f1; border-radius: 12px; display: flex; align-items: center; justify-content: center; color: var(--arsenal-red); font-weight: 700; font-size: 1rem; border: 1px solid rgba(239, 1, 7, 0.1);">
                                {{ substr($author->name, 0, 1) }}
                            </div>
                            <span style="font-weight: 600; color: var(--arsenal-navy); font-size: 0.95rem;">{{ $author->name }}</span>
                        </div>
                    </td>
                    <td style="text-align: center;">
                        <span class="badge-count" style="background: #f0f2f5; padding: 6px 14px; border-radius: 8px; font-weight: 600; font-size: 0.8rem; color: var(--arsenal-navy); border: 1px solid #e0e4e8;">
                            {{ $author->posts_count }} Articles
                        </span>
                    </td>
                    <td style="text-align: center;">
                        <div style="display: flex; gap: 10px; justify-content: center;">
                            <button type="button" class="btn-edit-small" onclick="openEditModal({{ $author->id }}, '{{ addslashes($author->name) }}')" title="Edit">
                                <i class="bi bi-pencil-square"></i>
                            </button>
                            <button type="button" class="btn-delete-small" onclick="confirmDelete({{ $author->id }}, '{{ addslashes($author->name) }}', {{ $author->posts_count }})" title="Delete">
                                <i class="bi bi-trash3-fill"></i>
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="3" class="text-center py-4 text-muted">No journalists found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

<div class="mt-4">
    {{ $authors->links('vendor.pagination.custom-admin') }}
</div>

<div class="modal-overlay" id="addModal">
    <div class="modal-content" style="max-width: 450px;">
        <div class="modal-header">
            <h2 class="modal-title">Add New Journalist</h2>
            <button class="close-modal" id="closeAddModal">&times;</button>
        </div>
        <form action="{{ route('admin.authors.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name" class="form-label">Full Name</label>
                <input type="text" name="name" id="name" class="form-control" placeholder="e.g. Fabrizio Romano" required>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn-submit" style="width: 100%; justify-content: center;">
                    <i class="bi bi-person-check-fill"></i> Register Journalist
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="editModal">
    <div class="modal-content" style="max-width: 450px;">
        <div class="modal-header">
            <h2 class="modal-title">Edit Journalist</h2>
            <button class="close-modal" id="closeEditModal">&times;</button>
        </div>
        <form id="editForm" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="edit_name" class="form-label">Journalist Name</label>
                <input type="text" name="name" id="edit_name" class="form-control" required>
            </div>

            <div class="mt-4">
                <button type="submit" class="btn-submit" style="width: 100%; justify-content: center;">
                    <i class="bi bi-check-circle-fill"></i> Update Information
                </button>
            </div>
        </form>
    </div>
</div>

<div class="modal-overlay" id="deleteModal">
    <div class="modal-content delete-modal-content">
        <div class="delete-icon-box" id="deleteIconBox">
            <i class="bi bi-exclamation-triangle-fill"></i>
        </div>
        <h2 class="delete-title" id="deleteModalTitle">Are you sure?</h2>
        <p class="delete-text" id="deleteModalText"></p>
        
        <form id="deleteForm" method="POST">
            @csrf
            @method('DELETE')
            <div class="delete-actions" id="deleteActions">
                <button type="submit" class="btn-confirm-delete">Yes, Delete</button>
                <button type="button" class="btn-cancel-delete" onclick="closeModal('deleteModal')">Cancel</button>
            </div>
            <div id="deleteBlockedActions" style="display: none;">
                <button type="button" class="btn-cancel" onclick="closeModal('deleteModal')" style="width: 100%; margin: 0;">Close</button>
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

    function openEditModal(id, name) {
        const form = document.getElementById('editForm');
        form.action = `/admin/authors/${id}`;
        document.getElementById('edit_name').value = name;
        openModal('editModal');
    }

    function confirmDelete(id, name, postCount) {
        const form = document.getElementById('deleteForm');
        const title = document.getElementById('deleteModalTitle');
        const text = document.getElementById('deleteModalText');
        const actions = document.getElementById('deleteActions');
        const blockedActions = document.getElementById('deleteBlockedActions');
        const iconBox = document.getElementById('deleteIconBox');

        form.action = `/admin/authors/${id}`;
        
        if (postCount > 0) {
            title.innerText = "Action Blocked";
            title.style.color = "#e03131";
            text.innerHTML = `Cannot delete <strong>${name}</strong>.<br>This journalist has <strong>${postCount}</strong> active articles.<br>Please reassign or delete the articles first.`;
            actions.style.display = "none";
            blockedActions.style.display = "block";
            iconBox.style.backgroundColor = "#fff5f5";
            iconBox.style.color = "#e03131";
        } else {
            title.innerText = "Delete Journalist?";
            title.style.color = "var(--arsenal-navy)";
            text.innerHTML = `Are you sure you want to delete <strong>${name}</strong>?<br>This action cannot be undone.`;
            actions.style.display = "flex";
            blockedActions.style.display = "none";
            iconBox.style.backgroundColor = "#fff5f5";
            iconBox.style.color = "#e03131";
        }
        
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
