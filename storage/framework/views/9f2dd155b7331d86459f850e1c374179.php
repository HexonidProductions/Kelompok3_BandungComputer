<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Supplier - Bandung Computer</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Suppliers -->
    <link rel="stylesheet" href="<?php echo e(asset('css/suppliers.css')); ?>">
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
                    <li><a href="<?php echo e(route('categories')); ?>"><i class="fa-solid fa-tag"></i> Categories</a></li>
                    <li><a href="<?php echo e(route('transactions')); ?>"><i class="fa-solid fa-cart-shopping"></i> Transactions</a></li>
                    <li><a href="<?php echo e(route('products')); ?>"><i class="fa-solid fa-box"></i> Products</a></li>
                    <li><a href="<?php echo e(route('users')); ?>"><i class="fa-solid fa-users"></i> Users</a></li>
                    <li><a href="<?php echo e(route('suppliers')); ?>" class="active"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
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
            <h1 class="page-title">Supplier</h1>

            <!-- Search & Filter Actions -->
            <div class="top-actions">
                <div class="left-filters">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Search supplier" onkeyup="filterTable()">
                    </div>

                    <select id="statusFilter" class="filter-select" onchange="filterTable()">
                        <option value="All">Status: All</option>
                        <option value="Active">Active</option>
                        <option value="Inactive">Inactive</option>
                    </select>
                </div>

                <button class="btn-add" onclick="openAddModal()">
                    <i class="fa-solid fa-plus"></i> Add Supplier
                </button>
            </div>

            <!-- Stats Cards Grid -->
            <div class="stats-grid">
                <div class="card">
                    <div>
                        <div class="card-title">Total Supplier Registered</div>
                        <div class="card-value">21 Suppliers</div>
                    </div>
                    <i class="fa-solid fa-truck-field card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Supplier Active</div>
                        <div class="card-value" id="cardActiveCount">15 Supplier</div>
                    </div>
                    <i class="fa-regular fa-circle-check card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Supplier Inactive</div>
                        <div class="card-value">0 Supplier</div>
                    </div>
                    <i class="fa-regular fa-circle-xmark card-icon" style="color: #ef4444;"></i>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card-table">
                <h2 class="card-table-title">Database Supplier Resmi</h2>

                <table id="supplierTable">
                    <thead>
                        <tr>
                            <th>Entry Code</th>
                            <th>Supplier Name</th>
                            <th>Contact</th>
                            <th>Address</th>
                            <th>Status</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="supplierBody">
                        <tr>
                            <td><strong>SPL-ASUS</strong></td>
                            <td><strong>PT. Asus Indonesia</strong></td>
                            <td>082122431234</td>
                            <td>Kuningan, Jakarta Selatan</td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td><strong>SPL-LENOVO</strong></td>
                            <td><strong>PT. Lenovo Indonesia</strong></td>
                            <td>082122431235</td>
                            <td>Kelapa Gading, Jakarta Utara</td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td><strong>SPL-ACER</strong></td>
                            <td><strong>PT. Acer Indonesia</strong></td>
                            <td>082122431236</td>
                            <td>Gajah Mada, Jakarta Pusat</td>
                            <td><span class="badge-status badge-active">Active</span></td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    <div id="supplierCountText">Showing 1-3 out of 11 Suppliers</div>
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

    <!-- Modal Form Dynamic Supplier (Add & Edit) -->
    <div class="modal-overlay" id="supplierModal">
        <div class="modal-box-lg">
            <h3 class="modal-title" id="modalTitle">Add New Supplier</h3>
            
            <form id="supplierForm">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Entry Code</label>
                        <input type="text" id="codeInput" class="form-control" placeholder="Enter entry code" required>
                    </div>
                    <div class="form-group">
                        <label>Supplier Name</label>
                        <input type="text" id="nameInput" class="form-control" placeholder="Enter supplier name" required>
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <input type="text" id="contactInput" class="form-control" placeholder="Enter contact" required>
                    </div>
                    <div class="form-group">
                        <label>Status</label>
                        <select id="statusInput" class="form-control">
                            <option value="" disabled selected>Select status</option>
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea id="addressInput" class="form-control" placeholder="Enter address" required></textarea>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal()">Cancel</button>
                    <button type="button" class="btn-modal-delete" id="btnDelete" onclick="deleteSupplier()" style="display: none;">Delete</button>
                    <button type="submit" class="btn-modal-save">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Interaktif CRUD -->
    <script>
        let selectedRow = null;

        function openAddModal() {
            selectedRow = null;
            document.getElementById('modalTitle').innerText = "Add New Supplier";
            document.getElementById('supplierForm').reset();
            document.getElementById('btnDelete').style.display = 'none';
            document.getElementById('supplierModal').classList.add('active');
        }

        function openEditModal(btn) {
            selectedRow = btn.closest('tr');
            document.getElementById('modalTitle').innerText = "Edit Supplier Details";
            
            const cells = selectedRow.cells;
            document.getElementById('codeInput').value = cells[0].innerText.trim();
            document.getElementById('nameInput').value = cells[1].innerText.trim();
            document.getElementById('contactInput').value = cells[2].innerText.trim();
            document.getElementById('addressInput').value = cells[3].innerText.trim();
            document.getElementById('statusInput').value = cells[4].innerText.trim();

            document.getElementById('btnDelete').style.display = 'inline-block';
            document.getElementById('supplierModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('supplierModal').classList.remove('active');
        }

        document.getElementById('supplierForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const code = document.getElementById('codeInput').value;
            const name = document.getElementById('nameInput').value;
            const contact = document.getElementById('contactInput').value;
            const address = document.getElementById('addressInput').value;
            const status = document.getElementById('statusInput').value || 'Active';

            const badgeHTML = status === 'Active' 
                ? '<span class="badge-status badge-active">Active</span>' 
                : '<span class="badge-status badge-inactive">Inactive</span>';

            if (selectedRow) {
                // UPDATE BARIS
                selectedRow.cells[0].innerHTML = `<strong>${code}</strong>`;
                selectedRow.cells[1].innerHTML = `<strong>${name}</strong>`;
                selectedRow.cells[2].innerText = contact;
                selectedRow.cells[3].innerText = address;
                selectedRow.cells[4].innerHTML = badgeHTML;
            } else {
                // TAMBAH BARIS BARU (CREATE)
                const tbody = document.getElementById('supplierBody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td><strong>${code}</strong></td>
                    <td><strong>${name}</strong></td>
                    <td>${contact}</td>
                    <td>${address}</td>
                    <td>${badgeHTML}</td>
                    <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                `;
                tbody.prepend(newRow);
            }

            updateCounter();
            closeModal();
        });

        function deleteSupplier() {
            if (selectedRow && confirm('Apakah Anda yakin ingin menghapus supplier ini?')) {
                selectedRow.remove();
                updateCounter();
                closeModal();
            }
        }

        function updateCounter() {
            const rows = document.querySelectorAll('#supplierBody tr');
            document.getElementById('supplierCountText').innerText = `Showing 1-${rows.length} out of ${rows.length} Suppliers`;
        }

        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const status = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('#supplierBody tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const supplierStatus = row.cells[4].innerText.trim();

                const matchSearch = text.includes(search);
                const matchStatus = (status === 'All' || supplierStatus === status);

                row.style.display = (matchSearch && matchStatus) ? '' : 'none';
            });
        }
    </script>

</body>
</html><?php /**PATH C:\Users\ADVAN\Kelompok3_BandungComputer\resources\views/suppliers.blade.php ENDPATH**/ ?>