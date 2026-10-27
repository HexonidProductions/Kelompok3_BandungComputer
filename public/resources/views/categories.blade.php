<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories - Bandung Computer Admin</title>
    
    <!-- PANGGIL FILE CSS TERPISAH -->
    <link rel="stylesheet" href="{{ asset('css/categories.css') }}?v=6">
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
                <a href="{{ route('categories') }}" class="menu-item active">
                    <i class="fa-solid fa-tag"></i>
                    <span>Categories</span>
                </a>
                <a href="#" class="menu-item"><i class="fa-solid fa-cart-shopping"></i><span>Transactions</span></a>
                <a href="#" class="menu-item"><i class="fa-solid fa-box"></i><span>Products</span></a>
                <a href="#" class="menu-item"><i class="fa-solid fa-users"></i><span>Users</span></a>
                <a href="#" class="menu-item"><i class="fa-solid fa-truck-field"></i><span>Suppliers</span></a>
                <a href="#" class="menu-item"><i class="fa-solid fa-receipt"></i><span>Inventory Logs</span></a>
                <a href="#" class="menu-item"><i class="fa-solid fa-key"></i><span>Daily Closing</span></a>
            </nav>

            <div class="sidebar-footer">
                <div class="admin-info">
                    <span class="role">Admin</span>
                    <strong class="name">Alif Hassan Abdillah</strong>
                </div>
                <a href="{{ url('/tes-login') }}" class="btn-logout">Logout</a>
            </div>
        </aside>

        <!-- KONTEN UTAMA -->
        <main class="main-content">
            <header class="content-header">
                <h1>Category</h1>
            </header>

            <div class="top-bar">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Search category">
                </div>
                
                <button type="button" class="btn-add" id="openAddModal">
                    <i class="fa-solid fa-plus"></i> Add Category
                </button>
            </div>

            <section class="table-card">
                <div class="table-header">
                    <h2>Category List</h2>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th style="width: 80px;">No.</th>
                                <th>Category</th>
                                <th class="text-right" style="width: 120px;">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>Laptop</td>
                                <td class="action-buttons">
                                    <button type="button" class="btn-action edit" onclick="openEditModal('Laptop')"><i class="fa-solid fa-pen"></i></button>
                                    <button type="button" class="btn-action delete"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>2</td>
                                <td>Smartphone</td>
                                <td class="action-buttons">
                                    <button type="button" class="btn-action edit" onclick="openEditModal('Smartphone')"><i class="fa-solid fa-pen"></i></button>
                                    <button type="button" class="btn-action delete"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>TWS</td>
                                <td class="action-buttons">
                                    <button type="button" class="btn-action edit" onclick="openEditModal('TWS')"><i class="fa-solid fa-pen"></i></button>
                                    <button type="button" class="btn-action delete"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>Headset</td>
                                <td class="action-buttons">
                                    <button type="button" class="btn-action edit" onclick="openEditModal('Headset')"><i class="fa-solid fa-pen"></i></button>
                                    <button type="button" class="btn-action delete"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>5</td>
                                <td>Printer</td>
                                <td class="action-buttons">
                                    <button type="button" class="btn-action edit" onclick="openEditModal('Printer')"><i class="fa-solid fa-pen"></i></button>
                                    <button type="button" class="btn-action delete"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>6</td>
                                <td>Mouse</td>
                                <td class="action-buttons">
                                    <button type="button" class="btn-action edit" onclick="openEditModal('Mouse')"><i class="fa-solid fa-pen"></i></button>
                                    <button type="button" class="btn-action delete"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>7</td>
                                <td>Keyboard</td>
                                <td class="action-buttons">
                                    <button type="button" class="btn-action edit" onclick="openEditModal('Keyboard')"><i class="fa-solid fa-pen"></i></button>
                                    <button type="button" class="btn-action delete"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                            <tr>
                                <td>8</td>
                                <td>Cable</td>
                                <td class="action-buttons">
                                    <button type="button" class="btn-action edit" onclick="openEditModal('Cable')"><i class="fa-solid fa-pen"></i></button>
                                    <button type="button" class="btn-action delete"><i class="fa-solid fa-trash"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <span>Showing 1-15 out of 20 Category</span>
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

    <!-- POPUP MODAL ADD CATEGORY -->
    <div class="modal-overlay" id="addModal">
        <div class="modal-card">
            <h3>Add New Category</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <input type="text" placeholder="Enter category name" id="addCategoryInput">
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" id="closeAddModal">Cancel</button>
                    <button type="button" class="btn-save" id="saveAddModal">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- POPUP MODAL EDIT CATEGORY -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-card">
            <h3>Edit Category</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <input type="text" id="editCategoryInput">
                <div class="modal-actions">
                    <button type="button" class="btn-cancel" id="closeEditModal">Cancel</button>
                    <button type="button" class="btn-save" id="saveEditModal">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT POPUP MODAL -->
    <script>
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');
        const openAddBtn = document.getElementById('openAddModal');
        const closeAddBtn = document.getElementById('closeAddModal');
        const closeEditBtn = document.getElementById('closeEditModal');
        const saveAddModal = document.getElementById('saveAddModal');
        const saveEditModal = document.getElementById('saveEditModal');
        const editCategoryInput = document.getElementById('editCategoryInput');

        openAddBtn.addEventListener('click', () => {
            addModal.classList.add('active');
        });

        closeAddBtn.addEventListener('click', () => {
            addModal.classList.remove('active');
        });
        saveAddModal.addEventListener('click', () => {
            addModal.classList.remove('active');
        });

        function openEditModal(categoryName) {
            editCategoryInput.value = categoryName;
            editModal.classList.add('active');
        }

        closeEditBtn.addEventListener('click', () => {
            editModal.classList.remove('active');
        });
        saveEditModal.addEventListener('click', () => {
            editModal.classList.remove('active');
        });
    </script>

</body>
</html>