<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Bandung Computer</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Products -->
    <link rel="stylesheet" href="<?php echo e(asset('css/products.css')); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- Sidebar Navigation Freeze -->
        <aside class="sidebar">
            <div>
                <div class="logo-box">
                    <img src="<?php echo e(asset('images/logo_bc.png')); ?>" alt="Bandung Computer Logo" onerror="this.src='<?php echo e(asset('images/logo_bc_hitam.png')); ?>'">
                </div>

                <ul class="sidebar-menu">
                    <li><a href="<?php echo e(route('overview')); ?>"><i class="fa-solid fa-border-all"></i> Overview</a></li>
                    <li><a href="<?php echo e(route('products')); ?>" class="active"><i class="fa-solid fa-box"></i> Products</a></li>
                    <li><a href="<?php echo e(route('transactions')); ?>"><i class="fa-solid fa-cart-shopping"></i> Transactions</a></li>
                    <li><a href="<?php echo e(route('categories')); ?>"><i class="fa-solid fa-tag"></i> Categories</a></li>
                    <li><a href="<?php echo e(route('users')); ?>"><i class="fa-solid fa-users"></i> Users</a></li>
                    <li><a href="<?php echo e(route('suppliers')); ?>"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
                    <li><a href="<?php echo e(route('inventory-logs')); ?>"><i class="fa-solid fa-clipboard-list"></i> Inventory Logs</a></li>
                    <li><a href="<?php echo e(route('daily-closing')); ?>"><i class="fa-solid fa-wrench"></i> Daily Closing</a></li>
                </ul>
            </div>

            <div class="sidebar-bottom">
                <div class="admin-info">
                    <div class="admin-role">Admin</div>
                    <div class="admin-name">Alif Hassan Abdillah</div>
                </div>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <h1 class="page-title">Products</h1>

            <!-- Search & Filter Actions -->
            <div class="top-actions">
                <div class="left-filters">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Search product name or code" onkeyup="filterTable()">
                    </div>

                    <select id="statusFilter" class="filter-select" onchange="filterTable()">
                        <option value="All">Status: All</option>
                        <option value="Available">Available</option>
                        <option value="Out of stock">Out of stock</option>
                    </select>
                </div>

                <button class="btn-add" onclick="openAddModal()">
                    <i class="fa-solid fa-plus"></i> Add Product
                </button>
            </div>

            <!-- Stats Cards Grid -->
            <div class="stats-grid">
                <div class="card">
                    <div>
                        <div class="card-title">Total Registered Products</div>
                        <div class="card-value" id="cardTotalProducts">48 Unit</div>
                    </div>
                    <i class="fa-solid fa-box card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Products Low On Stock</div>
                        <div class="card-value">3 Item</div>
                    </div>
                    <i class="fa-solid fa-triangle-exclamation card-icon" style="color: #eab308;"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Active Category</div>
                        <div class="card-value">3 Category</div>
                    </div>
                    <i class="fa-solid fa-layer-group card-icon"></i>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card-table">
                <h2 class="card-table-title">Product List</h2>

                <table id="productTable">
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
                    <tbody id="productBody">
                        <tr>
                            <td><strong>LPT-ROG14</strong></td>
                            <td><img src="<?php echo e(asset('images/zeyprus_black_edition.png')); ?>" class="product-img-thumb" alt="Product" onerror="this.src='<?php echo e(asset('images/asus_gaming_a15.png')); ?>'"></td>
                            <td><strong>ASUS ROG Zephyrus G14 Black Edition</strong></td>
                            <td>Laptop</td>
                            <td class="desc-cell">AMD Ryzen 9 | RTX 4060 8GB | RAM 16GB DDR5 | SSD 1TB NVMe | 14" QHD+ 165Hz | Win 11 + OHS</td>
                            <td>Rp 21.000.000</td>
                            <td>Rp 24.500.000</td>
                            <td>12</td>
                            <td><span class="badge-status badge-available">Available</span></td>
                            <td>2026-09-18 01:15:47</td>
                            <td><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td><strong>LPT-ROG13</strong></td>
                            <td><img src="<?php echo e(asset('images/iphone_17_pro_silver.png')); ?>" class="product-img-thumb" alt="Product"></td>
                            <td><strong>Iphone 17 Pro Silver</strong></td>
                            <td>Smartphone</td>
                            <td class="desc-cell">Apple A19 Pro (3nm) | RAM 8GB | Storage 256GB | 6.3" OLED 120Hz ProMotion | Triple 48MP Pro Cam | Titanium Silver | USB-C 3.2</td>
                            <td>Rp 21.000.000</td>
                            <td>Rp 24.500.000</td>
                            <td>12</td>
                            <td><span class="badge-status badge-available">Available</span></td>
                            <td>2026-09-18 01:15:47</td>
                            <td><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td><strong>LPT-TUFA15</strong></td>
                            <td><img src="<?php echo e(asset('images/asus_gaming_a15.png')); ?>" class="product-img-thumb" alt="Product"></td>
                            <td><strong>ASUS ROG GAMING A15</strong></td>
                            <td>Laptop</td>
                            <td class="desc-cell">AMD Ryzen 9 | RTX 4060 8GB | RAM 16GB DDR5 | SSD 1TB NVMe | 14" QHD+ 165Hz | Win 11 + OHS</td>
                            <td>Rp 21.000.000</td>
                            <td>Rp 24.500.000</td>
                            <td>12</td>
                            <td><span class="badge-status badge-available">Available</span></td>
                            <td>2026-09-18 01:15:47</td>
                            <td><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    <div id="productCountText">Showing 1-3 out of 3 Products</div>
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

    <!-- Modal Form Product (Add & Edit Dynamic) -->
    <div class="modal-overlay" id="productModal">
        <div class="modal-box-lg">
            <h3 class="modal-title" id="modalTitle">Add New Product</h3>
            
            <form id="productForm">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Product Name</label>
                        <input type="text" id="nameInput" class="form-control" placeholder="Enter product name" required>
                    </div>
                    <div class="form-group">
                        <label>Product Code</label>
                        <input type="text" id="codeInput" class="form-control" placeholder="Enter product code" required>
                    </div>
                    <div class="form-group">
                        <label>Category</label>
                        <select id="categoryInput" class="form-control">
                            <option value="Laptop">Laptop</option>
                            <option value="Smartphone">Smartphone</option>
                            <option value="Accessories">Accessories</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Stock Amount</label>
                        <input type="number" id="stockInput" class="form-control" value="0" required>
                    </div>
                    <div class="form-group">
                        <label>Buy Price</label>
                        <input type="text" id="buyPriceInput" class="form-control" placeholder="Rp 0" required>
                    </div>
                    <div class="form-group">
                        <label>Sell Price</label>
                        <input type="text" id="sellPriceInput" class="form-control" placeholder="Rp 0" required>
                    </div>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Product Description</label>
                        <textarea id="descInput" class="form-control" placeholder="Enter product description" required></textarea>
                    </div>
                    <div class="form-group">
                        <label>Product Image</label>
                        <div class="image-upload-box" onclick="document.getElementById('imgFileInput').click()">
                            <i class="fa-solid fa-upload"></i>
                            <span>Upload picture</span>
                            <img id="imgPreview" class="preview-img" style="display: none;">
                        </div>
                        <input type="file" id="imgFileInput" accept="image/*" style="display: none;" onchange="previewImage(this)">
                    </div>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal()">Cancel</button>
                    <button type="button" class="btn-modal-delete" id="btnDelete" onclick="deleteProduct()" style="display: none;">Delete</button>
                    <button type="submit" class="btn-modal-save">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Interaktif CRUD -->
    <script>
        let selectedRow = null;
        let currentImgSrc = "";

        function openAddModal() {
            selectedRow = null;
            currentImgSrc = "";
            document.getElementById('modalTitle').innerText = "Add New Product";
            document.getElementById('productForm').reset();
            document.getElementById('imgPreview').style.display = 'none';
            document.getElementById('btnDelete').style.display = 'none';
            document.getElementById('productModal').classList.add('active');
        }

        function openEditModal(btn) {
            selectedRow = btn.closest('tr');
            document.getElementById('modalTitle').innerText = "Edit Product Details";
            
            const cells = selectedRow.cells;
            document.getElementById('codeInput').value = cells[0].innerText.trim();
            document.getElementById('nameInput').value = cells[2].innerText.trim();
            document.getElementById('categoryInput').value = cells[3].innerText.trim();
            document.getElementById('descInput').value = cells[4].innerText.trim();
            document.getElementById('buyPriceInput').value = cells[5].innerText.trim();
            document.getElementById('sellPriceInput').value = cells[6].innerText.trim();
            document.getElementById('stockInput').value = cells[7].innerText.trim();

            const imgElement = cells[1].querySelector('img');
            if (imgElement) {
                currentImgSrc = imgElement.src;
                document.getElementById('imgPreview').src = currentImgSrc;
                document.getElementById('imgPreview').style.display = 'block';
            } else {
                document.getElementById('imgPreview').style.display = 'none';
            }

            document.getElementById('btnDelete').style.display = 'inline-block';
            document.getElementById('productModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('productModal').classList.remove('active');
        }

        function previewImage(input) {
            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    currentImgSrc = e.target.result;
                    document.getElementById('imgPreview').src = currentImgSrc;
                    document.getElementById('imgPreview').style.display = 'block';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        document.getElementById('productForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const code = document.getElementById('codeInput').value;
            const name = document.getElementById('nameInput').value;
            const category = document.getElementById('categoryInput').value;
            const desc = document.getElementById('descInput').value;
            const buyPrice = document.getElementById('buyPriceInput').value;
            const sellPrice = document.getElementById('sellPriceInput').value;
            const stock = parseInt(document.getElementById('stockInput').value);

            const isAvailable = stock > 0;
            const badgeHTML = isAvailable 
                ? '<span class="badge-status badge-available">Available</span>' 
                : '<span class="badge-status badge-out-of-stock">Out of stock</span>';

            const now = new Date();
            const dateStr = now.toISOString().slice(0, 10) + ' ' + now.toTimeString().slice(0, 8);
            const imgSrc = currentImgSrc || "<?php echo e(asset('images/asus_gaming_a15.png')); ?>";

            if (selectedRow) {
                // UPDATE BARIS
                selectedRow.cells[0].innerHTML = `<strong>${code}</strong>`;
                selectedRow.cells[1].querySelector('img').src = imgSrc;
                selectedRow.cells[2].innerHTML = `<strong>${name}</strong>`;
                selectedRow.cells[3].innerText = category;
                selectedRow.cells[4].innerText = desc;
                selectedRow.cells[5].innerText = buyPrice;
                selectedRow.cells[6].innerText = sellPrice;
                selectedRow.cells[7].innerText = stock;
                selectedRow.cells[8].innerHTML = badgeHTML;
                selectedRow.cells[9].innerText = dateStr;
            } else {
                // TAMBAH BARIS BARU (CREATE)
                const tbody = document.getElementById('productBody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td><strong>${code}</strong></td>
                    <td><img src="${imgSrc}" class="product-img-thumb" alt="Product"></td>
                    <td><strong>${name}</strong></td>
                    <td>${category}</td>
                    <td class="desc-cell">${desc}</td>
                    <td>${buyPrice}</td>
                    <td>${sellPrice}</td>
                    <td>${stock}</td>
                    <td>${badgeHTML}</td>
                    <td>${dateStr}</td>
                    <td><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                `;
                tbody.prepend(newRow);
            }

            updateCounter();
            closeModal();
        });

        function deleteProduct() {
            if (selectedRow && confirm('Apakah Anda yakin ingin menghapus produk ini?')) {
                selectedRow.remove();
                updateCounter();
                closeModal();
            }
        }

        function updateCounter() {
            const rows = document.querySelectorAll('#productBody tr');
            document.getElementById('productCountText').innerText = `Showing 1-${rows.length} out of ${rows.length} Products`;
        }

        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const status = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('#productBody tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const badgeText = row.querySelector('.badge-status').innerText;

                const matchSearch = text.includes(search);
                const matchStatus = (status === 'All' || badgeText === status);

                row.style.display = (matchSearch && matchStatus) ? '' : 'none';
            });
        }
    </script>

</body>
</html><?php /**PATH C:\Users\ADVAN\Kelompok3_BandungComputer\resources\views/products.blade.php ENDPATH**/ ?>