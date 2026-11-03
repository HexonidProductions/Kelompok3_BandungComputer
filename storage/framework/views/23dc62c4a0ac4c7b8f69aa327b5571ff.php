<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - Bandung Computer</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Transactions -->
    <link rel="stylesheet" href="<?php echo e(asset('css/transactions.css')); ?>">
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
                    <li><a href="<?php echo e(route('transactions')); ?>" class="active"><i class="fa-solid fa-cart-shopping"></i> Transactions</a></li>
                    <li><a href="<?php echo e(route('products')); ?>"><i class="fa-solid fa-box"></i> Products</a></li>
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
            <h1 class="page-title">Transactions</h1>

            <!-- Search & Filter Actions -->
            <div class="top-actions">
                <div class="left-filters">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Search Invoice code" onkeyup="filterTable()">
                    </div>

                    <select id="statusFilter" class="filter-select" onchange="filterTable()">
                        <option value="All">Payment status: All</option>
                        <option value="Paid">Paid</option>
                        <option value="Not Paid">Not Paid</option>
                    </select>
                </div>

                <button class="btn-add" onclick="openAddModal()">
                    <i class="fa-solid fa-plus"></i> Add Transaction
                </button>
            </div>

            <!-- Stats Cards Grid -->
            <div class="stats-grid">
                <div class="card">
                    <div>
                        <div class="card-title">Total Sales This Month</div>
                        <div class="card-value">Rp 196.000.000</div>
                    </div>
                    <i class="fa-regular fa-credit-card card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Transaction Amount</div>
                        <div class="card-value" id="cardTxCount">482 Transaction</div>
                    </div>
                    <i class="fa-solid fa-arrow-right-arrow-left card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Average Transaction</div>
                        <div class="card-value">Rp 24.500.000</div>
                    </div>
                    <i class="fa-solid fa-chart-simple card-icon"></i>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card-table">
                <h2 class="card-table-title">Transaction List</h2>

                <table id="transactionTable">
                    <thead>
                        <tr>
                            <th>Receipt Number</th>
                            <th>Sale Type</th>
                            <th>Cashier</th>
                            <th>Customer</th>
                            <th>Shipping Address</th>
                            <th>Date</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Shipping Fee</th>
                            <th>Payment Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="transactionBody">
                        <tr>
                            <td><strong>INV-2602-004</strong></td>
                            <td>Offline</td>
                            <td>Alif Hassan Abdillah</td>
                            <td>Muhammad Aditya Nugroho</td>
                            <td class="address-cell">Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70714</td>
                            <td>24 Sep 2026</td>
                            <td>Rp 24.500.000</td>
                            <td>Bank Transfer</td>
                            <td>Rp 15.000</td>
                            <td><span class="badge-status badge-not-paid">Not Paid</span></td>
                            <td><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td><strong>INV-2602-005</strong></td>
                            <td>Offline</td>
                            <td>Muhammad Cnada Indra Sulu</td>
                            <td>Muhammad Arfa Hafizy</td>
                            <td class="address-cell">Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70714</td>
                            <td>25 Sep 2026</td>
                            <td>Rp 24.500.000</td>
                            <td>Bank Transfer</td>
                            <td>Rp 15.000</td>
                            <td><span class="badge-status badge-paid">Paid</span></td>
                            <td><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td><strong>INV-2602-006</strong></td>
                            <td>Offline</td>
                            <td>Ahmad Raditya Putra</td>
                            <td>Muhammad Nabil Abhitah Abyasya</td>
                            <td class="address-cell">Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70714</td>
                            <td>10 Oct 2026</td>
                            <td>Rp 24.500.000</td>
                            <td>Bank Transfer</td>
                            <td>Rp 15.000</td>
                            <td><span class="badge-status badge-paid">Paid</span></td>
                            <td><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    <div id="txCount">Showing 1-3 out of 3 Transactions</div>
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

    <!-- Modal Form Transaksi (Satu Modal Dinamis untuk Add & Edit) -->
    <div class="modal-overlay" id="txModal">
        <div class="modal-box-lg">
            <h3 class="modal-title" id="modalTitle">Add New Transaction</h3>
            
            <form id="txForm">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Receipt Number</label>
                        <input type="text" id="receiptInput" class="form-control" placeholder="Enter receipt number" required>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select id="typeInput" class="form-control">
                            <option value="Offline">Offline</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cashier</label>
                        <input type="text" id="cashierInput" class="form-control" placeholder="Enter cashier name" required>
                    </div>
                    <div class="form-group">
                        <label>Customer</label>
                        <input type="text" id="customerInput" class="form-control" placeholder="Enter customer name" required>
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select id="methodInput" class="form-control">
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Cash">Cash</option>
                            <option value="E-Wallet">E-Wallet</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Status</label>
                        <select id="statusInput" class="form-control">
                            <option value="Paid">Paid</option>
                            <option value="Not Paid">Not Paid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Shipping Fee</label>
                        <input type="text" id="shippingFeeInput" class="form-control" value="Rp 15.000">
                    </div>
                    <div class="form-group">
                        <label>Total Amount</label>
                        <input type="text" id="amountInput" class="form-control" placeholder="e.g. Rp 24.500.000" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Shipping Address</label>
                    <textarea id="addressInput" class="form-control" placeholder="Enter shipping address" required></textarea>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal()">Cancel</button>
                    <button type="button" class="btn-modal-delete" id="btnDelete" onclick="deleteTransaction()" style="display: none;">Delete</button>
                    <button type="submit" class="btn-modal-save">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript CRUD Interaktif Full -->
    <script>
        let selectedRow = null;

        function openAddModal() {
            selectedRow = null;
            document.getElementById('modalTitle').innerText = "Add New Transaction";
            document.getElementById('txForm').reset();
            document.getElementById('btnDelete').style.display = 'none';
            document.getElementById('txModal').classList.add('active');
        }

        function openEditModal(btn) {
            selectedRow = btn.closest('tr');
            document.getElementById('modalTitle').innerText = "Edit Transaction Details";
            
            // Mengambil data dari baris tabel yang diklik
            const cells = selectedRow.cells;
            document.getElementById('receiptInput').value = cells[0].innerText.trim();
            document.getElementById('typeInput').value = cells[1].innerText.trim();
            document.getElementById('cashierInput').value = cells[2].innerText.trim();
            document.getElementById('customerInput').value = cells[3].innerText.trim();
            document.getElementById('addressInput').value = cells[4].innerText.trim();
            document.getElementById('amountInput').value = cells[6].innerText.trim();
            document.getElementById('methodInput').value = cells[7].innerText.trim();
            document.getElementById('shippingFeeInput').value = cells[8].innerText.trim();
            
            const isPaid = cells[9].innerText.includes('Paid') && !cells[9].innerText.includes('Not Paid');
            document.getElementById('statusInput').value = isPaid ? 'Paid' : 'Not Paid';

            document.getElementById('btnDelete').style.display = 'inline-block';
            document.getElementById('txModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('txModal').classList.remove('active');
        }

        // Simpan Data (Create & Update)
        document.getElementById('txForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const receipt = document.getElementById('receiptInput').value;
            const type = document.getElementById('typeInput').value;
            const cashier = document.getElementById('cashierInput').value;
            const customer = document.getElementById('customerInput').value;
            const address = document.getElementById('addressInput').value;
            const amount = document.getElementById('amountInput').value;
            const method = document.getElementById('methodInput').value;
            const shippingFee = document.getElementById('shippingFeeInput').value;
            const status = document.getElementById('statusInput').value;

            const badgeHTML = status === 'Paid' 
                ? '<span class="badge-status badge-paid">Paid</span>' 
                : '<span class="badge-status badge-not-paid">Not Paid</span>';

            const today = new Date();
            const dateStr = today.getDate() + ' ' + today.toLocaleString('en-US', { month: 'short' }) + ' ' + today.getFullYear();

            if (selectedRow) {
                // UPDATE BARIS ADA
                selectedRow.cells[0].innerHTML = `<strong>${receipt}</strong>`;
                selectedRow.cells[1].innerText = type;
                selectedRow.cells[2].innerText = cashier;
                selectedRow.cells[3].innerText = customer;
                selectedRow.cells[4].innerText = address;
                selectedRow.cells[6].innerText = amount;
                selectedRow.cells[7].innerText = method;
                selectedRow.cells[8].innerText = shippingFee;
                selectedRow.cells[9].innerHTML = badgeHTML;
            } else {
                // TAMBAH BARIS BARU (CREATE)
                const tbody = document.getElementById('transactionBody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td><strong>${receipt}</strong></td>
                    <td>${type}</td>
                    <td>${cashier}</td>
                    <td>${customer}</td>
                    <td class="address-cell">${address}</td>
                    <td>${dateStr}</td>
                    <td>${amount}</td>
                    <td>${method}</td>
                    <td>${shippingFee}</td>
                    <td>${badgeHTML}</td>
                    <td><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                `;
                tbody.prepend(newRow);
            }

            updateCounter();
            closeModal();
        });

        // HAPUS BARIS (DELETE)
        function deleteTransaction() {
            if (selectedRow && confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
                selectedRow.remove();
                updateCounter();
                closeModal();
            }
        }

        // HITUNG ULANG BARIS TABEL
        function updateCounter() {
            const rows = document.querySelectorAll('#transactionBody tr');
            document.getElementById('txCount').innerText = `Showing 1-${rows.length} out of ${rows.length} Transactions`;
        }

        // FILTER PENCARIAN & STATUS
        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const status = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('#transactionBody tr');

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
</html><?php /**PATH C:\Users\ADVAN\Kelompok3_BandungComputer\resources\views/transactions.blade.php ENDPATH**/ ?>