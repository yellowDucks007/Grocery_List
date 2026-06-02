@extends('layouts.app')
@include('components.toast')

@section('title', 'Users – GroCart')
@section('page-title', 'Users Management')

@section('styles')
<style>
    /* ==================== PAGE HEADER ==================== */
    .page-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 1.75rem;
    }

    .page-header h1 {
        font-family: 'Open Sans', serif;
        font-size: 1.4rem;
        font-weight: 800;
        color: var(--forest);
        margin: 0;
    }

    .page-header p {
        font-size: 0.82rem;
        color: #6b7a6c;
        margin: 0;
    }

    .btn-add {
        background-color: var(--forest);
        color: var(--cream);
        border: none;
        padding: 10px 20px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-family: 'Poppins', sans-serif;
        font-weight: 500;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 7px;
        transition: background-color 0.2s;
        text-decoration: none;
    }

    .btn-add:hover {
        background-color: var(--fern);
        color: var(--cream);
    }

    /* ==================== TABLE CARD ==================== */
    .table-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid rgba(16,55,64,0.07);
        overflow: hidden;
    }

    .table-toolbar {
        padding: 1rem 1.5rem;
        border-bottom: 1px solid rgba(16,55,64,0.07);
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .search-wrap {
        position: relative;
        flex: 1;
        max-width: 300px;
    }

    .search-wrap i {
        position: absolute;
        left: 11px;
        top: 50%;
        transform: translateY(-50%);
        color: #9aaa9b;
        font-size: 0.9rem;
    }

    .search-input {
        width: 100%;
        padding: 8px 14px 8px 34px;
        border: 1.5px solid #d0d8d1;
        border-radius: 8px;
        font-size: 0.875rem;
        font-family: 'Poppins', sans-serif;
        color: var(--forest);
        background-color: #fafafa;
        outline: none;
        transition: border-color 0.2s;
    }

    .search-input:focus {
        border-color: var(--fern);
    }

    .total-badge {
        font-size: 0.78rem;
        color: #6b7a6c;
        background-color: rgba(16,55,64,0.06);
        padding: 5px 12px;
        border-radius: 20px;
        white-space: nowrap;
    }

    /* ==================== TABLE ==================== */
    .users-table {
        width: 100%;
        border-collapse: collapse;
    }

    .users-table thead tr {
        background-color: rgba(16,55,64,0.04);
    }

    .users-table thead th {
        padding: 11px 1.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7a6c;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid rgba(16,55,64,0.07);
        white-space: nowrap;
        text-align: left;
    }

    .users-table tbody tr {
        border-bottom: 1px solid rgba(16,55,64,0.05);
        transition: background-color 0.15s;
    }

    .users-table tbody tr:last-child {
        border-bottom: none;
    }

    .users-table tbody tr:hover {
        background-color: rgba(16,55,64,0.02);
    }

    .users-table tbody td {
        padding: 13px 1.5rem;
        font-size: 0.875rem;
        color: var(--forest);
        vertical-align: middle;
    }

    /* User cell with avatar */
    .user-cell {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .avatar-table {
        width: 34px;
        height: 34px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 0.8rem;
        color: var(--cream);
        font-weight: 500;
        flex-shrink: 0;
        text-transform: uppercase;
    }

    .user-name-text {
        font-weight: 500;
        font-size: 0.875rem;
        color: var(--forest);
        line-height: 1.2;
    }

    .user-email-text {
        font-size: 0.75rem;
        color: #9aaa9b;
    }

    /* Action buttons */
    .btn-edit {
        background-color: rgba(217,164,67,0.15);
        color: #a07820;
        border: none;
        padding: 6px 12px;
        border-radius: 7px;
        font-size: 0.78rem;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.18s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
    }

    .btn-edit:hover {
        background-color: rgba(217,164,67,0.3);
    }

    .btn-delete {
        background-color: rgba(217,107,82,0.12);
        color: var(--terracotta);
        border: none;
        padding: 6px 12px;
        border-radius: 7px;
        font-size: 0.78rem;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.18s;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        margin-left: 4px;
    }

    .btn-delete:hover {
        background-color: rgba(217,107,82,0.25);
    }

    .empty-row td {
        text-align: center;
        padding: 3rem;
        color: #9aaa9b;
        font-size: 0.875rem;
    }

    /* Role Badge */
    .badge-role {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .role-admin {
        background: rgba(255, 193, 77, 0.15);
        color: #a07820;
    }

    .role-user {
        background: rgba(47, 157, 182, 0.25);
        color: var(--forest);
    }

    /* Status Badge */
    .badge-status {
        display: inline-block;
        padding: 4px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
    }

    .status-active {
        background: rgba(121, 185, 126, 0.47);
        color: #3C593E;
    }   

    .status-inactive {
        background: rgba(217, 107, 82, 0.2);
        color: var(--terracotta);
    }

    /* ==================== MODAL ==================== */
    .modal-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(16,55,64,0.45);
        z-index: 200;
        display: none;
        align-items: center;
        justify-content: center;
    }

    .modal-overlay.show {
        display: flex;
    }

    .modal-box {
        background: #ffffff;
        border-radius: 14px;
        padding: 2rem;
        width: 100%;
        max-width: 440px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.15);
        position: relative;
    }

    .modal-title {
        font-family: 'Open Sans', sans-serif;
        font-size: 1.25rem;
        font-weight: 600;
        color: var(--forest);
        margin-bottom: 0.25rem;
    }

    .modal-subtitle {
        font-size: 0.82rem;
        color: #6b7a6c;
        margin-bottom: 1.5rem;
    }

    .form-label-c {
        font-size: 0.78rem;
        font-weight: 500;
        color: var(--forest);
        text-transform: uppercase;
        letter-spacing: 0.02em;
        margin-bottom: 0.3rem;
        display: block;
    }

    .form-input-c {
        width: 100%;
        padding: 10px 13px;
        border: 1.5px solid #d0d8d1;
        border-radius: 8px;
        font-size: 0.9rem;
        font-family: 'Poppins', sans-serif;
        color: var(--forest);
        background-color: #fafafa;
        outline: none;
        transition: border-color 0.2s;
        margin-bottom: 1rem;
    }

    .form-input-c:focus {
        border-color: var(--fern);
        background-color: #fff;
    }

    .form-input-c.is-invalid {
        border-color: var(--terracotta);
    }

    .invalid-msg {
        font-size: 0.78rem;
        color: var(--terracotta);
        margin-top: -0.75rem;
        margin-bottom: 0.75rem;
        display: block;
    }

    .modal-footer-btns {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: 0.5rem;
    }

    .btn-cancel {
        background: transparent;
        border: 1.5px solid #d0d8d1;
        color: #6b7a6c;
        padding: 9px 20px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: all 0.18s;
    }

    .btn-cancel:hover {
        border-color: #b0b8b1;
        color: var(--forest);
    }

    .btn-save {
        background-color: var(--forest);
        color: var(--cream);
        border: none;
        padding: 9px 20px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .btn-save:hover {
        background-color: var(--fern);
    }

    /* Delete confirm modal */
    .delete-modal-box {
        background: #ffffff;
        border-radius: 14px;
        padding: 2rem;
        width: 100%;
        max-width: 380px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.15);
        text-align: center;
    }

    .delete-icon {
        width: 54px;
        height: 54px;
        background-color: rgba(217,107,82,0.12);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        margin: 0 auto 1rem;
    }

    .btn-confirm-delete {
        background-color: var(--terracotta);
        color: #fff;
        border: none;
        padding: 9px 20px;
        border-radius: 8px;
        font-size: 0.875rem;
        font-weight: 500;
        font-family: 'Poppins', sans-serif;
        cursor: pointer;
        transition: opacity 0.2s;
    }

    .btn-confirm-delete:hover {
        opacity: 0.88;
    }
</style>
@endsection

@section('content')

<!-- ==================== PAGE HEADER ==================== -->
<div class="page-header">
    <div>
        <h1>Users Management</h1>
        <p>Manage all registered accounts</p>
    </div>
    <button class="btn-add" onclick="openAddModal()">
        <i class="bi bi-plus-lg"></i> Add User
    </button>
</div>

<!-- ==================== TABLE CARD ==================== -->
<div class="table-card">

    <div class="table-toolbar">
        <div class="search-wrap">
            <i class="bi bi-search"></i>
            <input
                type="text"
                class="search-input"
                id="searchInput"
                placeholder="Search users..."
                onkeyup="searchTable()"
            >
        </div>
        <span class="total-badge">{{ $users->count() }} {{ Str::plural('user', $users->count()) }}</span>
    </div>

    <table class="users-table" id="usersTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Role</th>
                <th>Status</th>
                <th>Created Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>
                        <div class="user-cell">
                            <div class="avatar-table" style="background-color: {{ $loop->iteration % 3 === 0 ? '#D9A443' : ($loop->iteration % 2 === 0 ? '#103740' : '#3C593E') }}; {{ $loop->iteration % 3 === 0 ? 'color: #103740;' : '' }}">
                                {{ strtoupper(substr($user->name, 0, 2)) }}
                            </div>
                            <div>
                                <div class="user-name-text">{{ $user->name }}</div>
                                <div class="user-email-text">{{ $user->email }}</div>
                            </div>
                        </div>
                    </td>
                    <td>
                        <span class="badge-role {{ $user->role === 'admin' ? 'role-admin' : 'role-user' }}">
                            {{ ucfirst($user->role) }}
                        </span>
                    </td>

                    <td>
                        <span class="badge-status {{ $user->status === 'active' ? 'status-active' : 'status-inactive' }}">
                            {{ ucfirst($user->status) }}
                        </span>
                    </td>

                    <td>{{ $user->created_at->format('M j, Y') }}</td>
                    <td>
                        <button class="btn-edit" onclick="openEditModal(
                            {{ $user->id }},
                            '{{ $user->name }}',
                            '{{ $user->email }}',
                            '{{ $user->role }}',
                            '{{ $user->status }}'
                        )">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <button class="btn-delete" onclick="openDeleteModal({{ $user->id }}, '{{ $user->name }}')">
                            <i class="bi bi-trash"></i> Delete
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="empty-row">
                    <td colspan="6">🌿 No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

<!-- ==================== ADD USER MODAL ==================== -->
<div class="modal-overlay" id="addModal">
    <div class="modal-box">
        <div class="modal-title">Add New User</div>
        <div class="modal-subtitle">Fill in the details below</div>

        <form method="POST" action="{{ route('users.store') }}">
            @csrf

            <label class="form-label-c">Full Name</label>
            <input type="text" name="name" class="form-input-c" placeholder="Juan Dela Cruz" required>

            <label class="form-label-c">Email Address</label>
            <input type="email" name="email" class="form-input-c" placeholder="you@example.com" required>

            <label class="form-label-c">Role</label>
            <select name="role" class="form-input-c">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <label class="form-label-c">Status</label>
            <select name="status" class="form-input-c">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <label class="form-label-c">Password</label>
            <input type="password" name="password" class="form-input-c" placeholder="Min. 8 characters" required>

            <div class="modal-footer-btns">
                <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Cancel</button>
                <button type="submit" class="btn-save">Save User</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== EDIT USER MODAL ==================== -->
<div class="modal-overlay" id="editModal">
    <div class="modal-box">
        <div class="modal-title">Edit User</div>
        <div class="modal-subtitle">Update the user's information</div>

        <form method="POST" id="editForm" action="">
            @csrf
            @method('PUT')

            <label class="form-label-c">Full Name</label>
            <input type="text" name="name" id="editName" class="form-input-c" required>

            <label class="form-label-c">Email Address</label>
            <input type="email" name="email" id="editEmail" class="form-input-c" required>
            
            <label class="form-label-c">Role</label>
            <select name="role" id="editRole" class="form-input-c">
                <option value="user">User</option>
                <option value="admin">Admin</option>
            </select>

            <label class="form-label-c">Status</label>
            <select name="status" id="editStatus" class="form-input-c">
                <option value="active">Active</option>
                <option value="inactive">Inactive</option>
            </select>

            <label class="form-label-c">New Password <span style="color:#9aaa9b;font-weight:300;text-transform:none;">(leave blank to keep current)</span></label>
            <input type="password" name="password" class="form-input-c" placeholder="Leave blank to keep current">

            <div class="modal-footer-btns">
                <button type="button" class="btn-cancel" onclick="closeModal('editModal')">Cancel</button>
                <button type="submit" class="btn-save">Update User</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== DELETE CONFIRM MODAL ==================== -->
<div class="modal-overlay" id="deleteModal">
    <div class="delete-modal-box">
        <div class="delete-icon">🗑️</div>
        <div class="modal-title" style="font-size:1.1rem;">Delete User</div>
        <p style="font-size:0.875rem;color:#6b7a6c;margin:0.5rem 0 1.5rem;">
            Are you sure you want to delete <strong id="deleteUserName"></strong>? This cannot be undone.
        </p>

        <form method="POST" id="deleteForm" action="">
            @csrf
            @method('DELETE')

            <div class="modal-footer-btns" style="justify-content:center;">
                <button type="button" class="btn-cancel" onclick="closeModal('deleteModal')">Cancel</button>
                <button type="submit" class="btn-confirm-delete">Yes, Delete</button>
            </div>
        </form>
    </div>
</div>

@endsection

@section('scripts')
<script>
    /* ==================== MODAL CONTROLS ==================== */
    function openAddModal() {
        document.getElementById('addModal').classList.add('show');
    }

    function openEditModal(id, name, email, role, status) {
        document.getElementById('editName').value  = name;
        document.getElementById('editEmail').value = email;
        document.getElementById('editRole').value = role;
        document.getElementById('editStatus').value = status;
        document.getElementById('editForm').action = '/users/' + id;
        document.getElementById('editModal').classList.add('show');
    }

    function openDeleteModal(id, name) {
        document.getElementById('deleteUserName').textContent = name;
        document.getElementById('deleteForm').action = '/users/' + id;
        document.getElementById('deleteModal').classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }

    /* Close modal */
    document.querySelectorAll('.modal-overlay').forEach(function(overlay) {
        overlay.addEventListener('click', function(e) {
            if (e.target === overlay) {
                overlay.classList.remove('show');
            }
        });
    });

    /* ==================== SEARCH TABLE ==================== */
    function searchTable() {
        var input  = document.getElementById('searchInput').value.toLowerCase();
        var rows   = document.querySelectorAll('#usersTable tbody tr:not(.empty-row)');

        rows.forEach(function(row) {
            var text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? '' : 'none';
        });
    }

    /* ==================== AUTO-OPEN MODAL ON VALIDATION ERROR ==================== */
    <?php if (isset($errors) && ($errors->has('name') || $errors->has('email') || $errors->has('password'))): ?>
        openAddModal();
    <?php endif; ?>
</script>
@endsection