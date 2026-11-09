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
    <link rel="stylesheet" href="{{ asset('css/transactions.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- Sidebar Navigation Freeze -->
        <aside class="sidebar">
            <div>
                <div class="logo-box">
                    <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo" onerror="this.src='{{ asset('images/logo_bc_hitam.png') }}'">
                </div>

                <ul class="sidebar-menu">
                    <li><a href="{{ route('overview') }}"><i class="fa-solid fa-border-all"></i> Overview</a></li>
                    <li><a href="{{ route('products') }}"><i class="fa-solid fa-box"></i> Products</a></li>
                    <li><a href="{{ route('transactions') }}" class="active"><i class="fa-solid fa-cart-shopping"></i> Transactions</a></li>
                    <li><a href="{{ route('categories') }}"><i class="fa-solid fa-tag"></i> Categories</a></li>
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
            <h1 class="page-title">Transactions</h1>

            <!-- Top Search & Filters -->
            <div class="top-actions">
                <div class="left-filters">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Search receipt number..." onkeyup="filterTable()">
                    </div>

                    <select id="typeFilter" class="filter-select" onchange="filterTable()">
                        <option value="All">Type: All</option>
                        <option value="Offline">Offline</option>
                        <option value="Online">Online</option>
                    </select>

                    <select id="statusFilter" class="filter-select" onchange="filterTable()">
                        <option value="All">Status: All</option>
                        <option value="Paid">Paid</option>
                        <option value="Unpaid">Unpaid</option>
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
                        <div class="card-value">Rp 84.500.000</div>
                    </div>
                    <i class="fa-regular fa-credit-card card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Transaction Amount</div>
                        <div class="card-value">48 Transaction</div>
                    </div>
                    <i class="fa-solid fa-arrow-right-arrow-left card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Average Transaction</div>
                        <div class="card-value">Rp 1.747.200</div>
                    </div>
                    <i class="fa-solid fa-chart-line card-icon"></i>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card-table">
                <h2 class="card-table-title">Transaction History List</h2>

                <table id="txTable">
                    <thead>
                        <tr>
                            <th>Receipt Number</th>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Type</th>
                            <th>Total Amount</th>
                            <th>Payment Method</th>
                            <th>Shipping Fee</th>
                            <th>Payment Status</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="txBody">
                        <tr>
                            <td><strong>INV-0001-0001</strong></td>
                            <td>24 Sep 2026</td>
                            <td>Muhammad Aditya Nugroho</td>
                            <td>Offline</td>
                            <td><strong>Rp 98.000.000</strong></td>
                            <td>Bank Transfer</td>
                            <td>Rp 15.000</td>
                            <td><span class="badge-status badge-paid">Paid</span></td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td><strong>INV-2026-002</strong></td>
                            <td>25 Sep 2026</td>
                            <td>Alif Hassan Abdillah</td>
                            <td>Online</td>
                            <td><strong>Rp 24.515.000</strong></td>
                            <td>Bank Transfer</td>
                            <td>Rp 15.000</td>
                            <td><span class="badge-status badge-paid">Paid</span></td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    <div id="txCountText">Showing 1-2 out of 10 Transactions</div>
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

    <!-- Modal Dynamic Form Transaction (Add & Edit) -->
    <div class="modal-overlay" id="txModal">
        <div class="modal-box-lg">
            <h3 class="modal-title" id="modalTitle">Edit Transaction Details</h3>
            
            <form id="txForm">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Receipt Number</label>
                        <input type="text" id="receiptInput" class="form-control" placeholder="INV-0001-0001" required>
                    </div>
                    <div class="form-group">
                        <label>Type</label>
                        <select id="typeInput" class="form-control" required>
                            <option value="Offline">Offline</option>
                            <option value="Online">Online</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Cashier</label>
                        <select id="cashierInput" class="form-control">
                            <option value="Fransisca Siregar">Fransisca Siregar</option>
                            <option value="Alif Hassan Abdillah">Alif Hassan Abdillah</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Customer</label>
                        <select id="customerInput" class="form-control">
                            <option value="Muhammad Aditya Nugroho">Muhammad Aditya Nugroho</option>
                            <option value="Muhammad Zidan">Muhammad Zidan</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Method</label>
                        <select id="paymentMethodInput" class="form-control">
                            <option value="Bank Transfer">Bank Transfer</option>
                            <option value="Cash">Cash</option>
                            <option value="QRIS">QRIS</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Payment Status</label>
                        <select id="paymentStatusInput" class="form-control">
                            <option value="Paid">Paid</option>
                            <option value="Unpaid">Unpaid</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Shipping Fee</label>
                        <input type="number" id="shippingInput" class="form-control" placeholder="0" value="0" oninput="calculateTotal()">
                    </div>
                    <!-- Total Amount READONLY (Otomatis Tambahan Harga produk + shipping fee) -->
                    <div class="form-group">
                        <label>Total Amount (Otomatis)</label>
                        <input type="text" id="totalAmountInput" class="form-control readonly-input" placeholder="Rp 0" readonly>
                    </div>
                </div>

                <div class="form-group">
                    <label>Shipping Address</label>
                    <textarea id="addressInput" class="form-control" placeholder="Enter shipping address"></textarea>
                </div>

                <!-- DYNAMIC ITEMS SECTION -->
                <div class="items-section">
                    <div class="items-header">
                        <label class="items-title">Items</label>
                        <button type="button" class="btn-add-item" onclick="addItemRow()">
                            <i class="fa-solid fa-plus"></i> Add Item
                        </button>
                    </div>

                    <div id="itemsContainer" class="items-list-container">
                        <!-- Items row will be injected here dynamically -->
                    </div>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal()">Cancel</button>
                    <button type="button" class="btn-modal-delete" id="btnDelete" onclick="deleteTx()" style="display: none;">Delete</button>
                    <button type="submit" class="btn-modal-save">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Interaktif Item Builder & Auto Calculation -->
    <script>
        let selectedRow = null;

        // Data katalog produk bawaan untuk pencarian & harga otomatis
        const productCatalog = [
            { name: 'ASUS ROG Zephyrus G14 Black Edition', price: 24500000 },
            { name: 'iPhone 17 Pro Silver 256GB', price: 21999000 },
            { name: 'ASUS TUF Gaming F15 RTX4050', price: 14200000 },
            { name: 'Logitech G Pro X Superlight Mouse', price: 1850000 }
        ];

        function openAddModal() {
            selectedRow = null;
            document.getElementById('modalTitle').innerText = "Add New Transaction";
            document.getElementById('txForm').reset();
            document.getElementById('btnDelete').style.display = 'none';

            // Reset items ke 1 item bawaan
            const container = document.getElementById('itemsContainer');
            container.innerHTML = '';
            addItemRow('ASUS ROG Zephyrus G14 Black Edition', 1, 24500000);

            document.getElementById('txModal').classList.add('active');
            calculateTotal();
        }

        function openEditModal(btn) {
            selectedRow = btn.closest('tr');
            document.getElementById('modalTitle').innerText = "Edit Transaction Details";
            
            const cells = selectedRow.cells;
            document.getElementById('receiptInput').value = cells[0].innerText.trim();
            document.getElementById('customerInput').value = cells[2].innerText.trim();
            document.getElementById('typeInput').value = cells[3].innerText.trim();
            document.getElementById('paymentMethodInput').value = cells[5].innerText.trim();
            
            const shipStr = cells[6].innerText.replace(/[^0-9]/g, '');
            document.getElementById('shippingInput').value = shipStr || 0;
            document.getElementById('paymentStatusInput').value = cells[7].innerText.trim();

            // Render contoh baris item saat edit
            const container = document.getElementById('itemsContainer');
            container.innerHTML = '';
            addItemRow('ASUS ROG Zephyrus G14 Black Edition', 1, 24500000);
            addItemRow('ASUS ROG Zephyrus G14 Black Edition', 1, 24500000);
            addItemRow('ASUS ROG Zephyrus G14 Black Edition', 1, 24500000);
            addItemRow('ASUS ROG Zephyrus G14 Black Edition', 1, 24500000);

            document.getElementById('btnDelete').style.display = 'inline-block';
            document.getElementById('txModal').classList.add('active');
            calculateTotal();
        }

        function closeModal() {
            document.getElementById('txModal').classList.remove('active');
        }

        // Tambah Baris Item Baru
        function addItemRow(defaultProdName = '', defaultQty = 1, defaultPrice = 0) {
            const container = document.getElementById('itemsContainer');
            const itemDiv = document.createElement('div');
            itemDiv.className = 'item-row';

            itemDiv.innerHTML = `
                <div class="item-info">
                    <span class="item-qty-prefix"><input type="number" class="item-qty-input" value="${defaultQty}" min="1" oninput="calculateTotal()">x</span>
                    <select class="form-control item-select" onchange="updateItemPrice(this)">
                        <option value="" disabled ${!defaultProdName ? 'selected' : ''}>Input item name or code</option>
                        ${productCatalog.map(p => `<option value="${p.name}" data-price="${p.price}" ${p.name === defaultProdName ? 'selected' : ''}>${p.name}</option>`).join('')}
                    </select>
                </div>
                <div class="item-right-actions">
                    <span class="item-price-text">Rp ${formatRupiah(defaultPrice * defaultQty)}</span>
                    <button type="button" class="btn-item-icon btn-edit" title="Edit Item"><i class="fa-solid fa-pen"></i></button>
                    <button type="button" class="btn-item-icon btn-delete" title="Delete Item" onclick="removeItemRow(this)"><i class="fa-solid fa-trash"></i></button>
                </div>
            `;

            container.appendChild(itemDiv);
            calculateTotal();
        }

        function removeItemRow(btn) {
            const rows = document.querySelectorAll('.item-row');
            if (rows.length > 1) {
                btn.closest('.item-row').remove();
                calculateTotal();
            } else {
                alert('Transaksi minimal harus memiliki 1 item!');
            }
        }

        function updateItemPrice(selectEl) {
            const row = selectEl.closest('.item-row');
            const selectedOpt = selectEl.options[selectEl.selectedIndex];
            const price = parseInt(selectedOpt.getAttribute('data-price')) || 0;
            const qty = parseInt(row.querySelector('.item-qty-input').value) || 1;
            
            row.querySelector('.item-price-text').innerText = 'Rp ' + formatRupiah(price * qty);
            calculateTotal();
        }

        // Kalkulasi Otomatis Total Amount = Sum(Item Prices * Qty) + Shipping Fee
        function calculateTotal() {
            let totalItemSum = 0;
            const itemRows = document.querySelectorAll('.item-row');

            itemRows.forEach(row => {
                const selectEl = row.querySelector('.item-select');
                const qtyInput = row.querySelector('.item-qty-input');
                const priceText = row.querySelector('.item-price-text');

                if (selectEl && selectEl.selectedIndex > 0) {
                    const price = parseInt(selectEl.options[selectEl.selectedIndex].getAttribute('data-price')) || 0;
                    const qty = parseInt(qtyInput.value) || 1;
                    const subtotal = price * qty;
                    
                    priceText.innerText = 'Rp ' + formatRupiah(subtotal);
                    totalItemSum += subtotal;
                }
            });

            const shippingFee = parseInt(document.getElementById('shippingInput').value) || 0;
            const grandTotal = totalItemSum + shippingFee;

            document.getElementById('totalAmountInput').value = 'Rp ' + formatRupiah(grandTotal);
        }

        function formatRupiah(number) {
            return new Intl.NumberFormat('id-ID').format(number);
        }

        document.getElementById('txForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const receipt = document.getElementById('receiptInput').value;
            const customer = document.getElementById('customerInput').value;
            const type = document.getElementById('typeInput').value;
            const paymentMethod = document.getElementById('paymentMethodInput').value;
            const status = document.getElementById('paymentStatusInput').value;
            const totalStr = document.getElementById('totalAmountInput').value;
            const shippingVal = parseInt(document.getElementById('shippingInput').value) || 0;

            const badgeHTML = status === 'Paid' 
                ? '<span class="badge-status badge-paid">Paid</span>' 
                : '<span class="badge-status badge-unpaid">Unpaid</span>';

            const today = new Date();
            const dateStr = today.getDate() + ' ' + today.toLocaleString('en-US', { month: 'short' }) + ' ' + today.getFullYear();

            if (selectedRow) {
                // UPDATE BARIS
                selectedRow.cells[0].innerHTML = `<strong>${receipt}</strong>`;
                selectedRow.cells[2].innerText = customer;
                selectedRow.cells[3].innerText = type;
                selectedRow.cells[4].innerHTML = `<strong>${totalStr}</strong>`;
                selectedRow.cells[5].innerText = paymentMethod;
                selectedRow.cells[6].innerText = 'Rp ' + formatRupiah(shippingVal);
                selectedRow.cells[7].innerHTML = badgeHTML;
            } else {
                // TAMBAH BARIS BARU
                const tbody = document.getElementById('txBody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td><strong>${receipt}</strong></td>
                    <td>${dateStr}</td>
                    <td>${customer}</td>
                    <td>${type}</td>
                    <td><strong>${totalStr}</strong></td>
                    <td>${paymentMethod}</td>
                    <td>Rp ${formatRupiah(shippingVal)}</td>
                    <td>${badgeHTML}</td>
                    <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                `;
                tbody.prepend(newRow);
            }

            updateCounter();
            closeModal();
        });

        function deleteTx() {
            if (selectedRow && confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
                selectedRow.remove();
                updateCounter();
                closeModal();
            }
        }

        function updateCounter() {
            const rows = document.querySelectorAll('#txBody tr');
            document.getElementById('txCountText').innerText = `Showing 1-${rows.length} out of ${rows.length} Transactions`;
        }

        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const type = document.getElementById('typeFilter').value;
            const status = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('#txBody tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const rowType = row.cells[3].innerText.trim();
                const rowStatus = row.cells[7].innerText.trim();

                const matchSearch = text.includes(search);
                const matchType = (type === 'All' || rowType === type);
                const matchStatus = (status === 'All' || rowStatus === status);

                row.style.display = (matchSearch && matchType && matchStatus) ? '' : 'none';
            });
        }
    </script>

</body>
</html>