<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Log - Bandung Computer</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Inventory Logs -->
    <link rel="stylesheet" href="<?php echo e(asset('css/inventory-logs.css')); ?>">
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
    <li><a href="<?php echo e(route('suppliers')); ?>"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
    
    <li><a href="<?php echo e(route('inventory-logs')); ?>" class="active"><i class="fa-solid fa-clipboard-list"></i> Inventory Logs</a></li>
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
            <h1 class="page-title">Inventory Log</h1>

            <!-- Search & Filter Actions -->
            <div class="top-actions">
                <div class="left-filters">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Search inventory log" onkeyup="filterTable()">
                    </div>

                    <select id="typeFilter" class="filter-select" onchange="filterTable()">
                        <option value="All">All Types</option>
                        <option value="In">In</option>
                        <option value="Out">Out</option>
                    </select>
                </div>

                <button class="btn-add" onclick="openAddModal()">
                    <i class="fa-solid fa-plus"></i> Add Inventory Log
                </button>
            </div>

            <!-- Stats Cards Grid -->
            <div class="stats-grid">
                <div class="card">
                    <div>
                        <div class="card-title">Total Stock In</div>
                        <div class="card-value">120 Units</div>
                    </div>
                    <i class="fa-solid fa-rotate-left card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Supplier Active</div>
                        <div class="card-value">85 Units</div>
                    </div>
                    <i class="fa-solid fa-rotate-right card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Total Log Activity</div>
                        <div class="card-value" id="cardTotalLogs">16 Total Logs</div>
                    </div>
                    <i class="fa-regular fa-clock card-icon"></i>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card-table">
                <h2 class="card-table-title">Inventory Movement History List</h2>

                <table id="logTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Product Name</th>
                            <th>Type</th>
                            <th>Supplier / Customer</th>
                            <th>Quantity</th>
                            <th>Note</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="logBody">
                        <tr>
                            <td>11 Sep 2026</td>
                            <td><strong>ASUS ROG Zephyrus G14 Black Edition</strong></td>
                            <td><span class="badge-type badge-in">In</span></td>
                            <td>PT. Asus Indonesia</td>
                            <td>10</td>
                            <td class="note-cell">Restok produk ASUS ROG baru dari supplier resmi</td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td>12 Oct 2026</td>
                            <td><strong>ASUS ROG Zephyrus G14 Black Edition</strong></td>
                            <td><span class="badge-type badge-in">In</span></td>
                            <td>PT. Asus Indonesia</td>
                            <td>10</td>
                            <td class="note-cell">Penambahan stok unit baru kuartal 4</td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    <div id="logCountText">Showing 1-2 out of 16 Inventory Log</div>
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

    <!-- Modal Form Dynamic Inventory Log (Add & Edit) -->
    <div class="modal-overlay" id="logModal">
        <div class="modal-box-lg">
            <h3 class="modal-title" id="modalTitle">Add New Log</h3>
            
            <form id="logForm">
                <div class="form-group">
                    <label>Product</label>
                    <select id="productInput" class="form-control" required>
                        <option value="" disabled selected>Select product</option>
                        <option value="ASUS ROG Zephyrus G14 Black Edition">ASUS ROG Zephyrus G14 Black Edition</option>
                        <option value="Iphone 17 Pro Silver">Iphone 17 Pro Silver</option>
                        <option value="ASUS ROG GAMING A15">ASUS ROG GAMING A15</option>
                    </select>
                </div>

                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Movement Type</label>
                        <select id="typeInput" class="form-control" required>
                            <option value="" disabled selected>Select movement type</option>
                            <option value="In">In</option>
                            <option value="Out">Out</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" id="qtyInput" class="form-control" placeholder="Enter quantity" required min="1">
                    </div>
                </div>

                <div class="form-group">
                    <label>Customer Name</label>
                    <select id="customerInput" class="form-control">
                        <option value="" disabled selected>Enter customer name</option>
                        <option value="Muhammad Aditya Nugroho">Muhammad Aditya Nugroho</option>
                        <option value="Muhammad Arfa Hafizy">Muhammad Arfa Hafizy</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Supplier</label>
                    <select id="supplierInput" class="form-control">
                        <option value="" disabled selected>Choose supplier</option>
                        <option value="PT. Asus Indonesia">PT. Asus Indonesia</option>
                        <option value="PT. Lenovo Indonesia">PT. Lenovo Indonesia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Note</label>
                    <textarea id="noteInput" class="form-control" placeholder="Enter any note or remarks"></textarea>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal()">Cancel</button>
                    <button type="button" class="btn-modal-delete" id="btnDelete" onclick="deleteLog()" style="display: none;">Delete</button>
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
            document.getElementById('modalTitle').innerText = "Add New Log";
            document.getElementById('logForm').reset();
            document.getElementById('btnDelete').style.display = 'none';
            document.getElementById('logModal').classList.add('active');
        }

        function openEditModal(btn) {
            selectedRow = btn.closest('tr');
            document.getElementById('modalTitle').innerText = "Edit Log Details";
            
            const cells = selectedRow.cells;
            document.getElementById('productInput').value = cells[1].innerText.trim();
            document.getElementById('typeInput').value = cells[2].innerText.trim();
            
            const suppOrCust = cells[3].innerText.trim();
            if(suppOrCust.startsWith("PT.")) {
                document.getElementById('supplierInput').value = suppOrCust;
            } else {
                document.getElementById('customerInput').value = suppOrCust;
            }

            document.getElementById('qtyInput').value = cells[4].innerText.trim();
            document.getElementById('noteInput').value = cells[5].innerText.trim();

            document.getElementById('btnDelete').style.display = 'inline-block';
            document.getElementById('logModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('logModal').classList.remove('active');
        }

        document.getElementById('logForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const product = document.getElementById('productInput').value;
            const type = document.getElementById('typeInput').value || 'In';
            const qty = document.getElementById('qtyInput').value;
            const customer = document.getElementById('customerInput').value;
            const supplier = document.getElementById('supplierInput').value;
            const note = document.getElementById('noteInput').value || '-';

            const party = (type === 'In') ? (supplier || 'PT. Asus Indonesia') : (customer || 'Customer General');
            const badgeHTML = (type === 'In')
                ? '<span class="badge-type badge-in">In</span>' 
                : '<span class="badge-type badge-out">Out</span>';

            const today = new Date();
            const dateStr = today.getDate() + ' ' + today.toLocaleString('en-US', { month: 'short' }) + ' ' + today.getFullYear();

            if (selectedRow) {
                selectedRow.cells[1].innerHTML = `<strong>${product}</strong>`;
                selectedRow.cells[2].innerHTML = badgeHTML;
                selectedRow.cells[3].innerText = party;
                selectedRow.cells[4].innerText = qty;
                selectedRow.cells[5].innerText = note;
            } else {
                const tbody = document.getElementById('logBody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${dateStr}</td>
                    <td><strong>${product}</strong></td>
                    <td>${badgeHTML}</td>
                    <td>${party}</td>
                    <td>${qty}</td>
                    <td class="note-cell">${note}</td>
                    <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                `;
                tbody.prepend(newRow);
            }

            updateCounter();
            closeModal();
        });

        function deleteLog() {
            if (selectedRow && confirm('Apakah Anda yakin ingin menghapus log ini?')) {
                selectedRow.remove();
                updateCounter();
                closeModal();
            }
        }

        function updateCounter() {
            const rows = document.querySelectorAll('#logBody tr');
            document.getElementById('logCountText').innerText = `Showing 1-${rows.length} out of ${rows.length} Inventory Log`;
        }

        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const type = document.getElementById('typeFilter').value;
            const rows = document.querySelectorAll('#logBody tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const movementType = row.cells[2].innerText.trim();

                const matchSearch = text.includes(search);
                const matchType = (type === 'All' || movementType === type);

                row.style.display = (matchSearch && matchType) ? '' : 'none';
            });
        }
    </script>

</body>
</html><?php /**PATH C:\Users\ADVAN\Kelompok3_BandungComputer\resources\views/inventory-logs.blade.php ENDPATH**/ ?>