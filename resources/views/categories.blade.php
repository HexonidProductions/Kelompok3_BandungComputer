<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Bandung Computer</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Categories -->
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- Sidebar Navigation (Freeze / Fixed) -->
        <aside class="sidebar">
            <div>
                <div class="logo-box">
                    <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo" onerror="this.src='{{ asset('images/logo_bc_hitam.png') }}'">
                </div>

                <ul class="sidebar-menu">
                    <li><a href="{{ route('overview') }}"><i class="fa-solid fa-border-all"></i> Overview</a></li>
                    <li><a href="{{ route('categories') }}" class="active"><i class="fa-solid fa-tag"></i> Categories</a></li>
                    <li><a href="{{ route('transactions') }}"><i class="fa-solid fa-cart-shopping"></i> Transactions</a></li>
                    <li><a href="{{ route('products') }}"><i class="fa-solid fa-box"></i> Products</a></li>
                    <li><a href="{{ route('users') }}"><i class="fa-solid fa-users"></i> Users</a></li>
                    <li><a href="{{ route('suppliers') }}"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
                   <li><a href="{{ route('inventory-logs') }}"><i class="fa-solid fa-clipboard-list"></i> Inventory Logs</a></li>
                    <li><a href="{{ route('daily-closing') }}"><i class="fa-solid fa-wrench"></i> Daily Closing</a></li>
                </ul>
            </div>

            <div class="sidebar-bottom">
                <div class="admin-info">
                    <div class="admin-role">Admin</div>
                    <div class="admin-name">Alif Hassan Abdillah</div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <h1 class="page-title">Category</h1>

            <!-- Search & Add Row -->
            <div class="top-actions">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass search-icon"></i>
                    <input type="text" id="searchInput" placeholder="Search category" onkeyup="searchCategory()">
                </div>
                <button class="btn-add" onclick="openAddModal()">
                    <i class="fa-solid fa-plus"></i> Add Category
                </button>
            </div>

            <!-- Table Card -->
            <div class="card-table">
                <h2 class="card-title">Category List</h2>

                <table id="categoryTable">
                    <thead>
                        <tr>
                            <th style="width: 80px;">No.</th>
                            <th>Category</th>
                            <th style="width: 100px;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="categoryTableBody">
                        <!-- Data Dummy Sesuai Gambar -->
                        <tr><td>1</td><td>Laptop</td><td class="action-cell"><button class="action-btn btn-edit" onclick="openEditModal(this)"><i class="fa-solid fa-pen"></i></button><button class="action-btn btn-delete" onclick="deleteCategory(this)"><i class="fa-solid fa-trash"></i></button></td></tr>
                        <tr><td>2</td><td>Smartphone</td><td class="action-cell"><button class="action-btn btn-edit" onclick="openEditModal(this)"><i class="fa-solid fa-pen"></i></button><button class="action-btn btn-delete" onclick="deleteCategory(this)"><i class="fa-solid fa-trash"></i></button></td></tr>
                        <tr><td>3</td><td>TWS</td><td class="action-cell"><button class="action-btn btn-edit" onclick="openEditModal(this)"><i class="fa-solid fa-pen"></i></button><button class="action-btn btn-delete" onclick="deleteCategory(this)"><i class="fa-solid fa-trash"></i></button></td></tr>
                        <tr><td>4</td><td>Headset</td><td class="action-cell"><button class="action-btn btn-edit" onclick="openEditModal(this)"><i class="fa-solid fa-pen"></i></button><button class="action-btn btn-delete" onclick="deleteCategory(this)"><i class="fa-solid fa-trash"></i></button></td></tr>
                        <tr><td>5</td><td>Printer</td><td class="action-cell"><button class="action-btn btn-edit" onclick="openEditModal(this)"><i class="fa-solid fa-pen"></i></button><button class="action-btn btn-delete" onclick="deleteCategory(this)"><i class="fa-solid fa-trash"></i></button></td></tr>
                        <tr><td>6</td><td>Mouse</td><td class="action-cell"><button class="action-btn btn-edit" onclick="openEditModal(this)"><i class="fa-solid fa-pen"></i></button><button class="action-btn btn-delete" onclick="deleteCategory(this)"><i class="fa-solid fa-trash"></i></button></td></tr>
                        <tr><td>7</td><td>Keyboard</td><td class="action-cell"><button class="action-btn btn-edit" onclick="openEditModal(this)"><i class="fa-solid fa-pen"></i></button><button class="action-btn btn-delete" onclick="deleteCategory(this)"><i class="fa-solid fa-trash"></i></button></td></tr>
                        <tr><td>8</td><td>Cable</td><td class="action-cell"><button class="action-btn btn-edit" onclick="openEditModal(this)"><i class="fa-solid fa-pen"></i></button><button class="action-btn btn-delete" onclick="deleteCategory(this)"><i class="fa-solid fa-trash"></i></button></td></tr>
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    <div id="categoryCount">Showing 1-8 out of 8 Category</div>
                    <div class="pagination">
                        <button class="page-btn">Previous</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">Next</button>
                    </div>
                </div>
            </div>
        </main>

    </div>

    <!-- Modal Add Category -->
    <div class="modal-overlay" id="addModal">
        <div class="modal-box">
            <h3 class="modal-title">Add New Category</h3>
            <input type="text" id="addInput" class="modal-input" placeholder="Enter category name">
            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeModal('addModal')">Cancel</button>
                <button class="btn-save" onclick="saveAddCategory()">Save</button>
            </div>
        </div>
    </div>

    <!-- Modal Edit Category -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-box">
            <h3 class="modal-title">Edit Category</h3>
            <input type="text" id="editInput" class="modal-input" placeholder="Enter category name">
            <div class="modal-actions">
                <button class="btn-cancel" onclick="closeModal('editModal')">Cancel</button>
                <button class="btn-save" onclick="saveEditCategory()">Save</button>
            </div>
        </div>
    </div>

    <!-- JavaScript Interaktif CRUD -->
    <script>
        let currentRow = null;

        function openAddModal() {
            document.getElementById('addInput').value = '';
            document.getElementById('addModal').classList.add('active');
        }

        function openEditModal(btn) {
            currentRow = btn.closest('tr');
            const categoryName = currentRow.cells[1].innerText;
            document.getElementById('editInput').value = categoryName;
            document.getElementById('editModal').classList.add('active');
        }

        function closeModal(modalId) {
            document.getElementById(modalId).classList.remove('active');
        }

        function saveAddCategory() {
            const name = document.getElementById('addInput').value.trim();
            if(!name) return alert('Nama kategori wajib diisi!');

            const tbody = document.getElementById('categoryTableBody');
            const rowCount = tbody.rows.length + 1;

            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${rowCount}</td>
                <td>${name}</td>
                <td class="action-cell">
                    <button class="action-btn btn-edit" onclick="openEditModal(this)"><i class="fa-solid fa-pen"></i></button>
                    <button class="action-btn btn-delete" onclick="deleteCategory(this)"><i class="fa-solid fa-trash"></i></button>
                </td>
            `;
            tbody.appendChild(tr);
            closeModal('addModal');
            updateCount();
        }

        function saveEditCategory() {
            const name = document.getElementById('editInput').value.trim();
            if(!name) return alert('Nama kategori wajib diisi!');

            if(currentRow) {
                currentRow.cells[1].innerText = name;
            }
            closeModal('editModal');
        }

        function deleteCategory(btn) {
            if(confirm('Apakah kamu yakin ingin menghapus kategori ini?')) {
                btn.closest('tr').remove();
                reindexRows();
                updateCount();
            }
        }

        function reindexRows() {
            const rows = document.querySelectorAll('#categoryTableBody tr');
            rows.forEach((row, index) => {
                row.cells[0].innerText = index + 1;
            });
        }

        function updateCount() {
            const total = document.querySelectorAll('#categoryTableBody tr').length;
            document.getElementById('categoryCount').innerText = `Showing 1-${total} out of ${total} Category`;
        }

        function searchCategory() {
            const filter = document.getElementById('searchInput').value.toLowerCase();
            const rows = document.querySelectorAll('#categoryTableBody tr');
            rows.forEach(row => {
                const text = row.cells[1].innerText.toLowerCase();
                row.style.display = text.includes(filter) ? '' : 'none';
            });
        }
    </script>

</body>
</html>