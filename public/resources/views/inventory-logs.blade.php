<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Log - Bandung Computer Admin</title>
    
    <link rel="stylesheet" href="{{ asset('css/inventory-logs.css') }}?v=2">
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
                <a href="{{ route('suppliers') }}" class="menu-item">
                    <i class="fa-solid fa-truck-field"></i>
                    <span>Suppliers</span>
                </a>
                <a href="{{ route('inventory.logs') }}" class="menu-item active">
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

        <!-- KONTEN UTAMA INVENTORY LOG -->
        <main class="main-content">
            <header class="content-header">
                <h1>Inventory Log</h1>
            </header>

            <!-- SEARCH, FILTER & ADD BUTTON -->
            <div class="top-bar">
                <div class="filter-group">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search inventory log">
                    </div>
                    <select class="select-filter">
                        <option>All Types</option>
                        <option>In</option>
                        <option>Out</option>
                    </select>
                </div>
                
                <button type="button" class="btn-add" id="openAddLog">
                    <i class="fa-solid fa-plus"></i> Add Inventory Log
                </button>
            </div>

            <!-- 3 CARD STATS -->
            <section class="stats-grid-3">
                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Total Stock In</span>
                        <h3 class="stat-value">120 Units</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-solid fa-rotate-right"></i></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Supplier Active</span>
                        <h3 class="stat-value">85 Units</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-solid fa-rotate-right"></i></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Total Log Activity</span>
                        <h3 class="stat-value">16 Total Logs</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-regular fa-clock"></i></div>
                </div>
            </section>

            <!-- TABEL INVENTORY MOVEMENT HISTORY LIST -->
            <section class="table-card">
                <div class="table-header">
                    <h2>Inventory Movement History List</h2>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Product Name</th>
                                <th>Type</th>
                                <th>Supplier</th>
                                <th>Quantity</th>
                                <th>Note</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>11 Sep 2026</td>
                                <td class="product-name-cell">ASUS ROG Zephyrus G14 Black Edition</td>
                                <td><span class="badge-type-in">In</span></td>
                                <td>PT. Asus Indonesia</td>
                                <td>10</td>
                                <td class="note-cell">fksfisjfiasjfijsdfjsiaodfjasoifjasiodfjasoifjasodifjasidf</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('ASUS ROG Zephyrus G14 Black Edition', 'In', '10', 'PT. Asus Indonesia', 'fksfisjfiasjfijsdfjsiaodfjasoifjasiodfjasoifjasodifjasidf')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>12 Oct 2026</td>
                                <td class="product-name-cell">ASUS ROG Zephyrus G14 Black Edition</td>
                                <td><span class="badge-type-in">In</span></td>
                                <td>PT. Asus Indonesia</td>
                                <td>10</td>
                                <td class="note-cell">fksfisjfiasjfijsdfjsiaodfjasoifjasiodfjasoifjasodifjasidf</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('ASUS ROG Zephyrus G14 Black Edition', 'In', '10', 'PT. Asus Indonesia', 'fksfisjfiasjfijsdfjsiaodfjasoifjasiodfjasoifjasodifjasidf')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>12 Oct 2026</td>
                                <td class="product-name-cell">ASUS ROG Zephyrus G14 Black Edition</td>
                                <td><span class="badge-type-in">In</span></td>
                                <td>PT. Asus Indonesia</td>
                                <td>10</td>
                                <td class="note-cell">fksfisjfiasjfijsdfjsiaodfjasoifjasiodfjasoifjasodifjasidf</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('ASUS ROG Zephyrus G14 Black Edition', 'In', '10', 'PT. Asus Indonesia', 'fksfisjfiasjfijsdfjsiaodfjasoifjasiodfjasoifjasodifjasidf')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <span>Showing 1-8 out of 16 Inventory Log</span>
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

    <!-- POPUP MODAL ADD NEW LOG -->
    <div class="modal-overlay" id="addModal">
        <div class="modal-card-lg">
            <h3>Add New Log</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-group-modal">
                    <label>Product</label>
                    <select><option>Select product</option><option>ASUS ROG Zephyrus G14 Black Edition</option></select>
                </div>

                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Movement Type</label>
                        <select><option>Select movement type</option><option>In</option><option>Out</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Quantity</label>
                        <input type="text" placeholder="Enter quantity">
                    </div>
                </div>

                <div class="form-group-modal">
                    <label>Customer Name</label>
                    <select><option>Enter customer name</option></select>
                </div>

                <div class="form-group-modal">
                    <label>Supplier</label>
                    <select><option>Choose supplier</option><option>PT. Asus Indonesia</option></select>
                </div>

                <div class="form-group-modal">
                    <label>Note</label>
                    <textarea placeholder="Enter any note or remarks"></textarea>
                </div>

                <div class="modal-actions-2">
                    <button type="button" class="btn-cancel" id="closeAddModal">Cancel</button>
                    <button type="button" class="btn-save" id="saveAddModal">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- POPUP MODAL EDIT LOG DETAILS -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-card-lg">
            <h3>Edit Log Details</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-group-modal">
                    <label>Product</label>
                    <select id="editProduct"><option>Select product</option><option>ASUS ROG Zephyrus G14 Black Edition</option></select>
                </div>

                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Movement Type</label>
                        <select id="editType"><option>Select movement type</option><option>In</option><option>Out</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Quantity</label>
                        <input type="text" id="editQty" placeholder="Enter quantity">
                    </div>
                </div>

                <div class="form-group-modal">
                    <label>Customer Name</label>
                    <select id="editCustomer"><option>Enter customer name</option></select>
                </div>

                <div class="form-group-modal">
                    <label>Supplier</label>
                    <select id="editSupplier"><option>Choose supplier</option><option>PT. Asus Indonesia</option></select>
                </div>

                <div class="form-group-modal">
                    <label>Note</label>
                    <textarea id="editNote" placeholder="Enter any note or remarks"></textarea>
                </div>

                <div class="modal-actions-2">
                    <button type="button" class="btn-cancel" id="closeEditModal">Cancel</button>
                    <button type="button" class="btn-save" id="saveEditModal">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT POPUP MODAL -->
    <script>
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');
        const openAddBtn = document.getElementById('openAddLog');
        const closeAddBtn = document.getElementById('closeAddModal');
        const closeEditBtn = document.getElementById('closeEditModal');
        const saveAddBtn = document.getElementById('saveAddModal');
        const saveEditBtn = document.getElementById('saveEditModal');

        openAddBtn.addEventListener('click', () => addModal.classList.add('active'));
        closeAddBtn.addEventListener('click', () => addModal.classList.remove('active'));
        saveAddBtn.addEventListener('click', () => addModal.classList.remove('active'));

        function openEditModal(product, type, qty, supplier, note) {
            document.getElementById('editProduct').value = product;
            document.getElementById('editType').value = type;
            document.getElementById('editQty').value = qty;
            document.getElementById('editSupplier').value = supplier;
            document.getElementById('editNote').value = note;
            editModal.classList.add('active');
        }

        closeEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
        saveEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
    </script>

</body>
</html>