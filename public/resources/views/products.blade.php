<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Bandung Computer Admin</title>
    
    <link rel="stylesheet" href="{{ asset('css/products.css') }}?v=1">
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
                <a href="{{ route('products') }}" class="menu-item active">
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

        <!-- KONTEN UTAMA PRODUCTS -->
        <main class="main-content">
            <header class="content-header">
                <h1>Products</h1>
            </header>

            <!-- SEARCH, FILTER & ADD BUTTON -->
            <div class="top-bar">
                <div class="filter-group">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search product name or code">
                    </div>
                    <select class="select-filter">
                        <option>Status: All</option>
                        <option>Available</option>
                        <option>Out of stock</option>
                    </select>
                </div>
                
                <button type="button" class="btn-add" id="openAddProduct">
                    <i class="fa-solid fa-plus"></i> Add Product
                </button>
            </div>

            <!-- 3 CARD STATS -->
            <section class="stats-grid-3">
                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Total Registered Products</span>
                        <h3 class="stat-value">48 Unit</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-solid fa-cube"></i></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Products Low On Stock</span>
                        <h3 class="stat-value">3 Item</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-solid fa-triangle-exclamation"></i></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Active Category</span>
                        <h3 class="stat-value">3 Category</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-solid fa-sliders"></i></div>
                </div>
            </section>

            <!-- TABEL PRODUCT LIST -->
            <section class="table-card">
                <div class="table-header">
                    <h2>Product List</h2>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Product Code</th>
                                <th>Image</th>
                                <th>Product Name</th>
                                <th>Category</th>
                                <th>Description</th>
                                <th>Buy Price</th>
                                <th>Sell Price</th>
                                <th>Stock</th>
                                <th>Status</th>
                                <th>Updated at</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>LPT-ROG14</td>
                                <td><img src="{{ asset('images/Rectangle 34 (3).png') }}" class="product-img-thumb" alt="Product"></td>
                                <td class="product-name-cell">ASUS ROG Zephyrus G14 Black Edition</td>
                                <td>Laptop</td>
                                <td class="desc-cell">AMD Ryzen 9 | RTX 4060 8GB | RAM 16GB DDR5 | SSD 1TB NVMe | 14" QHD+ 165Hz | Win 11 + OHS</td>
                                <td>Rp 21.000.000</td>
                                <td>Rp 24.500.000</td>
                                <td>12</td>
                                <td><span class="badge-status available">Available</span></td>
                                <td>2026-09-18 01:15:47</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('ASUS ROG Zephyrus G14 Black Edition', 'LPT-ROG14', 'Laptop', '12', 'Rp 21.000.000', 'Rp 24.500.000', 'AMD Ryzen 9 | RTX 4060 8GB | RAM 16GB DDR5 | SSD 1TB NVMe | 14 QHD+ 165Hz | Win 11 + OHS')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>LPT-ROG13</td>
                                <td><img src="{{ asset('images/Rectangle 34 (4).png') }}" class="product-img-thumb" alt="Product"></td>
                                <td class="product-name-cell">Iphone 17 Pro Silver</td>
                                <td>Laptop</td>
                                <td class="desc-cell">Apple A19 Pro (3nm) | RAM 8GB | Storage 256GB | 6.3" OLED 120Hz ProMotion | Triple 48MP Pro Cam | Titanium Silver | USB-C 3.2</td>
                                <td>Rp 21.000.000</td>
                                <td>Rp 24.500.000</td>
                                <td>12</td>
                                <td><span class="badge-status available">Available</span></td>
                                <td>2026-09-18 01:15:47</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('Iphone 17 Pro Silver', 'LPT-ROG13', 'Laptop', '12', 'Rp 21.000.000', 'Rp 24.500.000', 'Apple A19 Pro (3nm) | RAM 8GB | Storage 256GB | 6.3 OLED 120Hz ProMotion | Triple 48MP Pro Cam | Titanium Silver | USB-C 3.2')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>LPT-TUFA15</td>
                                <td><img src="{{ asset('images/Rectangle 34 (5).png') }}" class="product-img-thumb" alt="Product"></td>
                                <td class="product-name-cell">ASUS ROG GAMING A15</td>
                                <td>Laptop</td>
                                <td class="desc-cell">AMD Ryzen 9 | RTX 4060 8GB | RAM 16GB DDR5 | SSD 1TB NVMe | 14" QHD+ 165Hz | Win 11 + OHS</td>
                                <td>Rp 21.000.000</td>
                                <td>Rp 24.500.000</td>
                                <td>12</td>
                                <td><span class="badge-status available">Available</span></td>
                                <td>2026-09-18 01:15:47</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('ASUS TUF A15', 'LPT-TUFA15', 'Laptop', '12', 'Rp 0', 'Rp 0', '')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <span>Showing 1-4 out of 10 Products</span>
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

    <!-- POPUP MODAL ADD NEW PRODUCT -->
    <div class="modal-overlay" id="addModal">
        <div class="modal-card-lg">
            <h3>Add New Product</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Product Name</label>
                        <input type="text" placeholder="Enter product name">
                    </div>
                    <div class="form-group-modal">
                        <label>Product Code</label>
                        <input type="text" placeholder="Enter product code">
                    </div>
                    <div class="form-group-modal">
                        <label>Category</label>
                        <select><option>Select product category</option><option>Laptop</option><option>Smartphone</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Stock Amount</label>
                        <input type="text" value="0">
                    </div>
                    <div class="form-group-modal">
                        <label>Buy Price</label>
                        <input type="text" value="Rp 0">
                    </div>
                    <div class="form-group-modal">
                        <label>Sell Price</label>
                        <input type="text" value="Rp 0">
                    </div>
                </div>

                <div class="upload-box-container">
                    <div class="form-group-modal" style="flex: 1;">
                        <label>Product Description</label>
                        <textarea placeholder="Enter product description" style="height: 140px;"></textarea>
                    </div>
                    <div class="form-group-modal" style="flex: 1;">
                        <label>Product Image</label>
                        <div class="upload-box">
                            <i class="fa-solid fa-upload"></i>
                            <span>Upload picture</span>
                        </div>
                    </div>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-cancel-modal" id="closeAddModal">Cancel</button>
                    <button type="button" class="btn-delete-modal">Delete</button>
                    <button type="button" class="btn-save-modal" id="saveAddModal">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- POPUP MODAL EDIT PRODUCT DETAILS -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-card-lg">
            <h3>Edit Product Details</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Product Name</label>
                        <input type="text" id="editName" value="ASUS TUF A15">
                    </div>
                    <div class="form-group-modal">
                        <label>Product Code</label>
                        <input type="text" id="editCode" value="LPT-TUFA15">
                    </div>
                    <div class="form-group-modal">
                        <label>Category</label>
                        <select id="editCategory"><option>Laptop</option><option>Smartphone</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Stock Amount</label>
                        <input type="text" id="editStock" value="12">
                    </div>
                    <div class="form-group-modal">
                        <label>Buy Price</label>
                        <input type="text" id="editBuy" value="Rp 0">
                    </div>
                    <div class="form-group-modal">
                        <label>Sell Price</label>
                        <input type="text" id="editSell" value="Rp 0">
                    </div>
                </div>

                <div class="upload-box-container">
                    <div class="form-group-modal" style="flex: 1;">
                        <label>Product Description</label>
                        <textarea id="editDesc" placeholder="Enter product description" style="height: 140px;"></textarea>
                    </div>
                    <div class="form-group-modal" style="flex: 1;">
                        <label>Product Image</label>
                        <div class="upload-box">
                            <i class="fa-solid fa-upload"></i>
                            <span>Upload picture</span>
                        </div>
                    </div>
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
        const openAddBtn = document.getElementById('openAddProduct');
        const closeAddBtn = document.getElementById('closeAddModal');
        const closeEditBtn = document.getElementById('closeEditModal');
        const saveAddBtn = document.getElementById('saveAddModal');
        const saveEditBtn = document.getElementById('saveEditModal');

        openAddBtn.addEventListener('click', () => addModal.classList.add('active'));
        closeAddBtn.addEventListener('click', () => addModal.classList.remove('active'));
        saveAddBtn.addEventListener('click', () => addModal.classList.remove('active'));

        function openEditModal(name, code, category, stock, buy, sell, desc) {
            document.getElementById('editName').value = name;
            document.getElementById('editCode').value = code;
            document.getElementById('editCategory').value = category;
            document.getElementById('editStock').value = stock;
            document.getElementById('editBuy').value = buy;
            document.getElementById('editSell').value = sell;
            document.getElementById('editDesc').value = desc;
            editModal.classList.add('active');
        }

        closeEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
        saveEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
    </script>

</body>
</html>