@extends('layouts.app')
@include('components.toast')

@section('title', 'Grocery List – GroCart')
@section('page-title', 'My Grocery List')

@section('styles')
<style>
    /*  PAGE HEADER  */
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
    }

    .btn-add:hover {
        background-color: var(--fern);
    }

    /*  SUMMARY PILLS  */
    .summary-row {
        display: flex;
        gap: 0.75rem;
        margin-bottom: 1.75rem;
        flex-wrap: wrap;
    }

    .summary-pill {
        display: flex;
        align-items: center;
        gap: 10px;
        background: #ffffff;
        border: 1px solid rgba(16,55,64,0.07);
        border-radius: 10px;
        padding: 10px 18px;
    }

    .pill-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .ic-forest     { background-color: rgba(16,55,64,0.1); }
    .ic-gold       { background-color: rgba(217,164,67,0.15); }
    .ic-fern       { background-color: rgba(60,89,62,0.12); }

    .pill-value {
        font-family: 'Open Sans', serif;
        font-size: 1.35rem;
        font-weight: 600;
        color: var(--forest);
        line-height: 1;
    }

    .pill-label {
        font-size: 0.72rem;
        color: #6b7a6c;
        margin-top: 2px;
    }

    /*  FILTER TABS  */
    .filter-tabs {
        display: flex;
        gap: 6px;
        margin-bottom: 1.25rem;
        flex-wrap: wrap;
    }

    .filter-tab {
        padding: 7px 18px;
        border-radius: 20px;
        font-size: 0.82rem;
        border: 1.5px solid #d0d8d1;
        background: transparent;
        color: #6b7a6c;
        cursor: pointer;
        font-family: 'Poppins', sans-serif;
        transition: all 0.18s;
    }

    .filter-tab.active {
        background-color: var(--forest);
        color: var(--cream);
        border-color: var(--forest);
    }

    .filter-tab:hover:not(.active) {
        border-color: var(--fern);
        color: var(--fern);
    }

    /*  TABLE CARD  */
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
        gap: 1rem;
        flex-wrap: wrap;
    }

    .search-wrap {
        position: relative;
        flex: 1;
        max-width: 280px;
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

    /*  TABLE  */
    .grocery-table {
        width: 100%;
        border-collapse: collapse;
    }

    .grocery-table thead tr {
        background-color: rgba(16,55,64,0.04);
    }

    .grocery-table thead th {
        padding: 11px 1.5rem;
        font-size: 0.75rem;
        font-weight: 600;
        color: #6b7a6c;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        border-bottom: 1px solid rgba(16,55,64,0.07);
        text-align: left;
        white-space: nowrap;
    }

    .grocery-table tbody tr {
        border-bottom: 1px solid rgba(16,55,64,0.05);
        transition: background-color 0.15s;
    }

    .grocery-table tbody tr:last-child {
        border-bottom: none;
    }

    .grocery-table tbody tr:hover {
        background-color: rgba(16,55,64,0.02);
    }

    .grocery-table tbody td {
        padding: 13px 1.5rem;
        font-size: 0.875rem;
        color: var(--forest);
        vertical-align: middle;
    }

    .item-name {
        font-weight: 500;
        color: var(--forest);
    }

    .cat-badge {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 8px;
        font-size: 0.72rem;
        font-weight: 500;
        background-color: rgba(16,55,64,0.07);
        color: var(--forest);
    }

    .status-pending {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 10px;
        font-size: 0.72rem;
        font-weight: 500;
        background-color: rgba(217,164,67,0.15);
        color: #a07820;
    }

    .status-completed {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        padding: 3px 10px;
        border-radius: 10px;
        font-size: 0.72rem;
        font-weight: 500;
        background-color: rgba(60,89,62,0.12);
        color: #3C593E;
    }

    .notes-text {
        font-size: 0.8rem;
        color: #9aaa9b;
        font-weight: 300;
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

    /*  MODAL  */
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
        max-width: 480px;
        box-shadow: 0 8px 40px rgba(0,0,0,0.15);
    }

    .modal-title {
        font-family: 'Open Sans', serif;
        font-size: 1.2rem;
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

    .form-input-c,
    .form-select-c {
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

    .form-input-c:focus,
    .form-select-c:focus {
        border-color: var(--fern);
        background-color: #fff;
    }

    .modal-footer-btns {
        display: flex;
        justify-content: flex-end;
        gap: 0.75rem;
        margin-top: 0.25rem;
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

    /* Delete modal */
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
        <h1>My Grocery List</h1>
        <p>Track and manage your grocery items</p>
    </div>
    <button class="btn-add" onclick="openAddModal()">
        <i class="bi bi-plus-lg"></i> Add Item
    </button>
</div>

<!-- ==================== SUMMARY PILLS ==================== -->
<div class="summary-row">

    <div class="summary-pill">
        <div class="pill-icon ic-forest">🛒</div>
        <div>
            <div class="pill-value">{{ $items->count() }}</div>
            <div class="pill-label">Total Items</div>
        </div>
    </div>

    <div class="summary-pill">
        <div class="pill-icon ic-gold">⏳</div>
        <div>
            <div class="pill-value">{{ $items->where('status', 'pending')->count() }}</div>
            <div class="pill-label">Pending</div>
        </div>
    </div>

    <div class="summary-pill">
        <div class="pill-icon ic-fern">✅</div>
        <div>
            <div class="pill-value">{{ $items->where('status', 'completed')->count() }}</div>
            <div class="pill-label">Completed</div>
        </div>
    </div>

</div>

<!-- ==================== FILTER TABS ==================== -->
<div class="filter-tabs">
    <button class="filter-tab active" onclick="filterTable('all', this)">All</button>
    <button class="filter-tab" onclick="filterTable('pending', this)">Pending</button>
    <button class="filter-tab" onclick="filterTable('completed', this)">Completed</button>
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
                placeholder="Search items..."
                onkeyup="searchTable()"
            >
        </div>
    </div>

    <table class="grocery-table" id="groceryTable">
        <thead>
            <tr>
                <th>#</th>
                <th>Item Name</th>
                <th>Category</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Notes</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($items as $item)
                <tr data-status="{{ $item->status }}">
                    <td>{{ $loop->iteration }}</td>
                    <td><span class="item-name">{{ $item->name }}</span></td>
                    <td><span class="cat-badge">{{ $item->category }}</span></td>
                    <td>{{ $item->quantity }}{{ $item->unit ? ' ' . $item->unit : '' }}</td>
                    <td>
                        @if ($item->status === 'completed')
                            <span class="status-completed">✅ Completed</span>
                        @else
                            <span class="status-pending">⏳ Pending</span>
                        @endif
                    </td>
                    <td>
                        <span class="notes-text">
                            {{ $item->notes ? $item->notes : '—' }}
                        </span>
                    </td>
                    <td>
                        <button class="btn-edit" onclick="openEditModal(
                            {{ $item->id }},
                            '{{ addslashes($item->name) }}',
                            '{{ $item->category }}',
                            {{ $item->quantity }},
                            '{{ $item->unit }}',
                            '{{ $item->status }}',
                            '{{ addslashes($item->notes) }}'
                        )">
                            <i class="bi bi-pencil"></i> Edit
                        </button>
                        <button class="btn-delete" onclick="openDeleteModal({{ $item->id }}, '{{ addslashes($item->name) }}')">
                            <i class="bi bi-trash"></i>
                        </button>
                    </td>
                </tr>
            @empty
                <tr class="empty-row">
                    <td colspan="7">🌿 No grocery items yet. Add your first item!</td>
                </tr>
            @endforelse
        </tbody>
    </table>

</div>

<!-- ==================== ADD ITEM MODAL ==================== -->
<div class="modal-overlay" id="addModal">
    <div class="modal-box">
        <div class="modal-title">Add Grocery Item</div>
        <div class="modal-subtitle">Fill in the item details below</div>

        <form method="POST" action="{{ route('grocery.store') }}">
            @csrf

            <div class="row g-2">
                <div class="col-8">
                    <label class="form-label-c">Item Name</label>
                    <input type="text" name="name" class="form-input-c" placeholder="e.g. Whole Milk" required>
                </div>
                <div class="col-4">
                    <label class="form-label-c">Quantity</label>
                    <input type="number" name="quantity" class="form-input-c" placeholder="1" min="1" value="1" required>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-6">
                    <label class="form-label-c">Category</label>
                    <select name="category" class="form-select-c" required>
                        <option value="">Select category</option>
                        <option value="Dairy">Dairy</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Fruits">Fruits</option>
                        <option value="Meat">Meat</option>
                        <option value="Seafood">Seafood</option>
                        <option value="Grains">Grains</option>
                        <option value="Beverages">Beverages</option>
                        <option value="Snacks">Snacks</option>
                        <option value="Condiments">Condiments</option>
                        <option value="Frozen">Frozen</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-6">
                    <label class="form-label-c">Unit</label>
                    <input type="text" name="unit" class="form-input-c" placeholder="kg, pcs, g, L...">
                </div>
            </div>

            <label class="form-label-c">Notes <span style="color:#9aaa9b;font-weight:300;text-transform:none;">(optional)</span></label>
            <input type="text" name="notes" class="form-input-c" placeholder="Any extra notes...">

            <div class="modal-footer-btns">
                <button type="button" class="btn-cancel" onclick="closeModal('addModal')">Cancel</button>
                <button type="submit" class="btn-save">Add Item</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== EDIT ITEM MODAL ==================== -->
<div class="modal-overlay" id="editModal">
    <div class="modal-box">
        <div class="modal-title">Edit Grocery Item</div>
        <div class="modal-subtitle">Update the item details</div>

        <form method="POST" id="editForm" action="">
            @csrf
            @method('PUT')

            <div class="row g-2">
                <div class="col-8">
                    <label class="form-label-c">Item Name</label>
                    <input type="text" name="name" id="editName" class="form-input-c" required>
                </div>
                <div class="col-4">
                    <label class="form-label-c">Quantity</label>
                    <input type="number" name="quantity" id="editQuantity" class="form-input-c" min="1" required>
                </div>
            </div>

            <div class="row g-2">
                <div class="col-6">
                    <label class="form-label-c">Category</label>
                    <select name="category" id="editCategory" class="form-select-c" required>
                        <option value="Dairy">Dairy</option>
                        <option value="Vegetables">Vegetables</option>
                        <option value="Fruits">Fruits</option>
                        <option value="Meat">Meat</option>
                        <option value="Seafood">Seafood</option>
                        <option value="Grains">Grains</option>
                        <option value="Beverages">Beverages</option>
                        <option value="Snacks">Snacks</option>
                        <option value="Condiments">Condiments</option>
                        <option value="Frozen">Frozen</option>
                        <option value="Others">Others</option>
                    </select>
                </div>
                <div class="col-6">
                    <label class="form-label-c">Unit</label>
                    <input type="text" name="unit" id="editUnit" class="form-input-c" placeholder="kg, pcs, g, L...">
                </div>
            </div>

            <label class="form-label-c">Status</label>
            <select name="status" id="editStatus" class="form-select-c" required>
                <option value="pending">⏳ Pending</option>
                <option value="completed">✅ Completed</option>
            </select>

            <label class="form-label-c">Notes <span style="color:#9aaa9b;font-weight:300;text-transform:none;">(optional)</span></label>
            <input type="text" name="notes" id="editNotes" class="form-input-c" placeholder="Any extra notes...">

            <div class="modal-footer-btns">
                <button type="button" class="btn-cancel" onclick="closeModal('editModal')">Cancel</button>
                <button type="submit" class="btn-save">Update Item</button>
            </div>
        </form>
    </div>
</div>

<!-- ==================== DELETE CONFIRM MODAL ==================== -->
<div class="modal-overlay" id="deleteModal">
    <div class="delete-modal-box">
        <div class="delete-icon">🗑️</div>
        <div class="modal-title" style="font-size:1.1rem;">Remove Item</div>
        <p style="font-size:0.875rem;color:#6b7a6c;margin:0.5rem 0 1.5rem;">
            Are you sure you want to remove <strong id="deleteItemName"></strong> from your list?
        </p>

        <form method="POST" id="deleteForm" action="">
            @csrf
            @method('DELETE')

            <div class="modal-footer-btns" style="justify-content:center;">
                <button type="button" class="btn-cancel" onclick="closeModal('deleteModal')">Cancel</button>
                <button type="submit" class="btn-confirm-delete">Yes, Remove</button>
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

    function openEditModal(id, name, category, quantity, unit, status, notes) {
        document.getElementById('editName').value     = name;
        document.getElementById('editQuantity').value = quantity;
        document.getElementById('editUnit').value     = unit;
        document.getElementById('editNotes').value    = notes;
        document.getElementById('editForm').action    = '/grocery/' + id;

        /* Set category dropdown */
        var catSelect = document.getElementById('editCategory');
        for (var i = 0; i < catSelect.options.length; i++) {
            if (catSelect.options[i].value === category) {
                catSelect.selectedIndex = i;
                break;
            }
        }

        /* Set status dropdown */
        var statSelect = document.getElementById('editStatus');
        for (var j = 0; j < statSelect.options.length; j++) {
            if (statSelect.options[j].value === status) {
                statSelect.selectedIndex = j;
                break;
            }
        }

        document.getElementById('editModal').classList.add('show');
    }

    function openDeleteModal(id, name) {
        document.getElementById('deleteItemName').textContent = name;
        document.getElementById('deleteForm').action = '/grocery/' + id;
        document.getElementById('deleteModal').classList.add('show');
    }

    function closeModal(modalId) {
        document.getElementById(modalId).classList.remove('show');
    }

    /* Close modal when clicking outside the box */
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
        var rows   = document.querySelectorAll('#groceryTable tbody tr:not(.empty-row)');

        rows.forEach(function(row) {
            var text = row.textContent.toLowerCase();
            row.style.display = text.includes(input) ? '' : 'none';
        });
    }

    /* ==================== FILTER TABS ==================== */
    function filterTable(status, btn) {
        /* Update active tab */
        document.querySelectorAll('.filter-tab').forEach(function(tab) {
            tab.classList.remove('active');
        });
        btn.classList.add('active');

        /* Show/hide rows based on status */
        var rows = document.querySelectorAll('#groceryTable tbody tr:not(.empty-row)');
        rows.forEach(function(row) {
            if (status === 'all') {
                row.style.display = '';
            } else {
                row.style.display = row.dataset.status === status ? '' : 'none';
            }
        });
    }

    /* ==================== AUTO-OPEN MODAL ON VALIDATION ERROR ==================== */
    @if ($errors->any())
        openAddModal();
    @endif
</script>
@endsection