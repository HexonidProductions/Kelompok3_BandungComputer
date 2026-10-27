<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suppliers - Bandung Computer Admin</title>
    
    <link rel="stylesheet" href="{{ asset('css/suppliers.css') }}?v=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="dashboard-container">
        <!-- SIDEBAR KIRI -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo">
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('overview') }}" class="menu-item">
                    <i class="fa-solid fa-border-all"></i>
                    <span>Overview</span>
                </a>
                <a href="{{ route('categories') }}" class="menu-item">
                    <i class="fa-solid fa-tag"></i>
                    <span>Categories</span>
                </a>
                <a href="{{ route('transactions') }}" class="menu-item">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Transactions</span>
                </a>
                <a href="{{ route('products') }}" class="menu-item">
                    <i class="fa-solid fa-box"></i>
                    <span>Products</span>
                </a>
                <a href="{{ route('users') }}" class="menu-item">
                    <i class="fa-solid fa-users"></i>
                    <span>Users</span>
                </a>
                <a href="{{ route('suppliers') }}" class="menu-item active">
                    <i class="fa-solid fa-truck-field"></i>
                    <span>Suppliers</span>
                </a>
               <a href="{{ route('inventory.logs') }}" class="menu-item">
    <i class="fa-solid fa-receipt"></i>
    <span>Inventory Logs</span>
</a>
               <a href="{{ route('daily.closing') }}" class="menu-item">
    <i class="fa-solid fa-key"></i>
    <span>Daily Closing</span>
</a>
            </nav>

            <div class="sidebar-footer">
                <div class="admin-info">
                    <span class="role">Admin</span>
                    <strong class="name">Alif Hassan Abdillah</strong>
                </div>
                <a href="{{ url('/tes-login') }}" class="btn-logout">Logout</a>
            </div>
        </aside>

        <!-- KONTEN UTAMA SUPPLIERS -->
        <main class="main-content">
            <header class="content-header">
                <h1>Supplier</h1>
            </header>

            <!-- SEARCH, FILTER & ADD BUTTON -->
            <div class="top-bar">
                <div class="filter-group">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search supplier">
                    </div>
                    <select class="select-filter">
                        <option>Status: All</option>
                        <option>Active</option>
                        <option>Inactive</option>
                    </select>
                </div>
                
                <button type="button" class="btn-add" id="openAddSupplier">
                    <i class="fa-solid fa-plus"></i> Add Supplier
                </button>
            </div>

            <!-- 3 CARD STATS -->
            <section class="stats-grid-3">
                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Total Supplier Registered</span>
                        <h3 class="stat-value">21 Suppliers</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-solid fa-truck"></i></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Supplier Active</span>
                        <h3 class="stat-value">15 Supplier</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-regular fa-circle-check"></i></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Supplier Inactive</span>
                        <h3 class="stat-value">0 Supplier</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-regular fa-circle-xmark"></i></div>
                </div>
            </section>

            <!-- TABEL DATABASE SUPPLIER RESMI -->
            <section class="table-card">
                <div class="table-header">
                    <h2>Database Supplier Resmi</h2>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Entry Code</th>
                                <th>Supplier Name</th>
                                <th>Contact</th>
                                <th>Address</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>SPL-ASUS</td>
                                <td class="supplier-name-cell">PT. Asus Indonesia</td>
                                <td>082122431234</td>
                                <td>Kuningan, Jakarta Selatan</td>
                                <td><span class="badge-status active-status">Active</span></td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('SPL-ASUS', 'PT. Asus Indonesia', '082122431234', 'Active', 'Kuningan, Jakarta Selatan')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>SPL-LENOVO</td>
                                <td class="supplier-name-cell">PT. Lenovo Indonesia</td>
                                <td>082122431235</td>
                                <td>Kelapa Gading, Jakarta Utara</td>
                                <td><span class="badge-status active-status">Active</span></td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('SPL-LENOVO', 'PT. Lenovo Indonesia', '082122431235', 'Active', 'Kelapa Gading, Jakarta Utara')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>SPL-LENOVO</td>
                                <td class="supplier-name-cell">PT. Lenovo Indonesia</td>
                                <td>082122431235</td>
                                <td>Kelapa Gading, Jakarta Utara</td>
                                <td><span class="badge-status active-status">Active</span></td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('SPL-LENOVO', 'PT. Lenovo Indonesia', '082122431235', 'Active', 'Kelapa Gading, Jakarta Utara')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>SPL-LENOVO</td>
                                <td class="supplier-name-cell">PT. Lenovo Indonesia</td>
                                <td>082122431235</td>
                                <td>Kelapa Gading, Jakarta Utara</td>
                                <td><span class="badge-status active-status">Active</span></td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('SPL-LENOVO', 'PT. Lenovo Indonesia', '082122431235', 'Active', 'Kelapa Gading, Jakarta Utara')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>SPL-LENOVO</td>
                                <td class="supplier-name-cell">PT. Lenovo Indonesia</td>
                                <td>082122431235</td>
                                <td>Kelapa Gading, Jakarta Utara</td>
                                <td><span class="badge-status active-status">Active</span></td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('SPL-LENOVO', 'PT. Lenovo Indonesia', '082122431235', 'Active', 'Kelapa Gading, Jakarta Utara')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <span>Showing 1-9 out of 11 Suppliers</span>
                    <div class="pagination">
                        <button class="btn-page">Previous</button>
                        <button class="btn-page active">1</button>
                        <button class="btn-page">2</button>
                        <button class="btn-page">Next</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- POPUP MODAL ADD NEW SUPPLIER -->
    <div class="modal-overlay" id="addModal">
        <div class="modal-card-lg">
            <h3>Add New Supplier</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Entry Code</label>
                        <input type="text" placeholder="Enter entry code">
                    </div>
                    <div class="form-group-modal">
                        <label>Supplier Name</label>
                        <input type="text" placeholder="Enter supplier name">
                    </div>
                    <div class="form-group-modal">
                        <label>Contact</label>
                        <input type="text" placeholder="Enter contact">
                    </div>
                    <div class="form-group-modal">
                        <label>Status</label>
                        <select><option>Select status</option><option>Active</option><option>Inactive</option></select>
                    </div>
                </div>

                <div class="form-group-modal">
                    <label>Address</label>
                    <textarea placeholder="Enter address"></textarea>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-cancel-modal" id="closeAddModal">Cancel</button>
                    <button type="button" class="btn-delete-modal">Delete</button>
                    <button type="button" class="btn-save-modal" id="saveAddModal">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- POPUP MODAL EDIT SUPPLIER DETAILS -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-card-lg">
            <h3>Edit Supplier Details</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Entry Code</label>
                        <input type="text" id="editCode" placeholder="Enter entry code">
                    </div>
                    <div class="form-group-modal">
                        <label>Supplier Name</label>
                        <input type="text" id="editName" placeholder="Enter supplier name">
                    </div>
                    <div class="form-group-modal">
                        <label>Contact</label>
                        <input type="text" id="editContact" placeholder="Enter contact">
                    </div>
                    <div class="form-group-modal">
                        <label>Status</label>
                        <select id="editStatus"><option>Active</option><option>Inactive</option></select>
                    </div>
                </div>

                <div class="form-group-modal">
                    <label>Address</label>
                    <textarea id="editAddress" placeholder="Enter address"></textarea>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-cancel-modal" id="closeEditModal">Cancel</button>
                    <button type="button" class="btn-delete-modal">Delete</button>
                    <button type="button" class="btn-save-modal" id="saveEditModal">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT POPUP MODAL -->
    <script>
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');
        const openAddBtn = document.getElementById('openAddSupplier');
        const closeAddBtn = document.getElementById('closeAddModal');
        const closeEditBtn = document.getElementById('closeEditModal');
        const saveAddBtn = document.getElementById('saveAddModal');
        const saveEditBtn = document.getElementById('saveEditModal');

        openAddBtn.addEventListener('click', () => addModal.classList.add('active'));
        closeAddBtn.addEventListener('click', () => addModal.classList.remove('active'));
        saveAddBtn.addEventListener('click', () => addModal.classList.remove('active'));

        function openEditModal(code, name, contact, status, address) {
            document.getElementById('editCode').value = code;
            document.getElementById('editName').value = name;
            document.getElementById('editContact').value = contact;
            document.getElementById('editStatus').value = status;
            document.getElementById('editAddress').value = address;
            editModal.classList.add('active');
        }

        closeEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
        saveEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
    </script>

</body>
</html>