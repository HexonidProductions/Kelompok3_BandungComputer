<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transactions - Bandung Computer Admin</title>
    
    <link rel="stylesheet" href="{{ asset('css/transactions.css') }}?v=1">
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
                <a href="{{ route('transactions') }}" class="menu-item active">
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

        <!-- KONTEN UTAMA TRANSACTIONS -->
        <main class="main-content">
            <header class="content-header">
                <h1>Transactions</h1>
            </header>

            <!-- SEARCH, FILTER & ADD BUTTON -->
            <div class="top-bar">
                <div class="filter-group">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search Invoice code">
                    </div>
                    <select class="select-filter">
                        <option>Payment status: All</option>
                        <option>Paid</option>
                        <option>Not Paid</option>
                    </select>
                </div>
                
                <button type="button" class="btn-add" id="openAddTransaction">
                    <i class="fa-solid fa-plus"></i> Add Transaction
                </button>
            </div>

            <!-- 3 CARD STATS -->
            <section class="stats-grid-3">
                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Total Sales This Month</span>
                        <h3 class="stat-value">Rp 196.000.000</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-regular fa-credit-card"></i></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Transaction Amount</span>
                        <h3 class="stat-value">482 Transaction</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-solid fa-arrow-right-arrow-left"></i></div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Average Transaction</span>
                        <h3 class="stat-value">Rp 24.500.000</h3>
                    </div>
                    <div class="stat-icon"><i class="fa-solid fa-chart-column"></i></div>
                </div>
            </section>

            <!-- TABEL TRANSACTION LIST -->
            <section class="table-card">
                <div class="table-header">
                    <h2>Transaction List</h2>
                </div>

                <div class="table-responsive">
                    <table>
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
                        <tbody>
                            <tr>
                                <td>INV-2602-004</td>
                                <td>Offline</td>
                                <td>Alif Hassan Abdillah</td>
                                <td>Muhammad Aditya Nugroho</td>
                                <td class="address-cell">Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70714</td>
                                <td>24 Sep 2026</td>
                                <td>Rp 24.500.000</td>
                                <td>Bank Transfer</td>
                                <td>Rp 15.000</td>
                                <td><span class="badge-status not-paid">Not Paid</span></td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('INV-2602-004', 'Offline', 'Alif Hassan Abdillah', 'Muhammad Aditya Nugroho', 'Bank Transfer', 'Not Paid', '15.000', '24.500.000')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>INV-2602-004</td>
                                <td>Offline</td>
                                <td>Muhammad Cnada Indra Sulu</td>
                                <td>Muhammad Arfa Hafizy</td>
                                <td class="address-cell">Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70714</td>
                                <td>25 Sep 2026</td>
                                <td>Rp 24.500.000</td>
                                <td>Bank Transfer</td>
                                <td>Rp 15.000</td>
                                <td><span class="badge-status paid">Paid</span></td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('INV-2602-004', 'Offline', 'Muhammad Cnada Indra Sulu', 'Muhammad Arfa Hafizy', 'Bank Transfer', 'Paid', '15.000', '24.500.000')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>INV-2602-004</td>
                                <td>Offline</td>
                                <td>Ahmad Raditya Putra</td>
                                <td>Muhammad Nabil Abhitah Abyasya</td>
                                <td class="address-cell">Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70714</td>
                                <td>10 Oct 2026</td>
                                <td>Rp 24.500.000</td>
                                <td>Bank Transfer</td>
                                <td>Rp 15.000</td>
                                <td><span class="badge-status paid">Paid</span></td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('INV-2602-004', 'Offline', 'Ahmad Raditya Putra', 'Muhammad Nabil Abhitah Abyasya', 'Bank Transfer', 'Paid', '15.000', '24.500.000')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <span>Showing 1-3 out of 10 Transactions</span>
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

    <!-- POPUP MODAL ADD TRANSACTION -->
    <div class="modal-overlay" id="addModal">
        <div class="modal-card-lg">
            <h3>Add New Transaction</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Receipt Number</label>
                        <input type="text" placeholder="Enter receipt number">
                    </div>
                    <div class="form-group-modal">
                        <label>Type</label>
                        <select><option>Select transaction type</option><option>Offline</option><option>Online</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Cashier</label>
                        <select><option>Select cashier</option><option>Alif Hassan Abdillah</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Customer</label>
                        <select><option>Select customer</option><option>Muhammad Aditya Nugroho</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Payment Method</label>
                        <select><option>Select payment method</option><option>Bank Transfer</option><option>Cash</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Payment Status</label>
                        <select><option>Select payment status</option><option>Paid</option><option>Not Paid</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Shipping Fee</label>
                        <input type="text" value="Rp 0">
                    </div>
                    <div class="form-group-modal">
                        <label>Total Amount</label>
                        <input type="text" value="Rp 0">
                    </div>
                </div>

                <div class="form-group-modal">
                    <label>Shipping Address</label>
                    <textarea placeholder="Enter shipping address"></textarea>
                </div>

                <div class="items-section-header">
                    <span>Items</span>
                    <button type="button" class="btn-add-item">+ Add Item</button>
                </div>

                <div class="item-row">
                    <span class="item-name">1x Input item name or code</span>
                    <div class="item-right">
                        <span class="item-price">Rp 0</span>
                        <button type="button" class="btn-icon-action edit"><i class="fa-solid fa-pen"></i></button>
                        <button type="button" class="btn-icon-action delete"><i class="fa-solid fa-trash"></i></button>
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

    <!-- POPUP MODAL EDIT TRANSACTION DETAILS -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-card-lg">
            <h3>Edit Transaction Details</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Receipt Number</label>
                        <input type="text" id="editReceipt" value="INV-0001-0001">
                    </div>
                    <div class="form-group-modal">
                        <label>Type</label>
                        <select id="editType"><option>Offline</option><option>Online</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Cashier</label>
                        <select id="editCashier"><option>Fransisca Siregar</option><option>Alif Hassan Abdillah</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Customer</label>
                        <select id="editCustomer"><option>Muhammad Aditya Nugroho</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Payment Method</label>
                        <select id="editMethod"><option>Bank Transfer</option><option>Cash</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Payment Status</label>
                        <select id="editStatus"><option>Paid</option><option>Not Paid</option></select>
                    </div>
                    <div class="form-group-modal">
                        <label>Shipping Fee</label>
                        <input type="text" id="editShipping" value="Rp 0">
                    </div>
                    <div class="form-group-modal">
                        <label>Total Amount</label>
                        <input type="text" id="editTotal" value="Rp 122.500.000">
                    </div>
                </div>

                <div class="form-group-modal">
                    <label>Shipping Address</label>
                    <textarea id="editAddress">Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70714</textarea>
                </div>

                <div class="items-section-header">
                    <span>Items</span>
                    <button type="button" class="btn-add-item">+ Add Item</button>
                </div>

                <div class="item-row">
                    <span class="item-name">1x Input item name or code</span>
                    <div class="item-right">
                        <span class="item-price">Rp 0</span>
                        <button type="button" class="btn-icon-action edit"><i class="fa-solid fa-pen"></i></button>
                        <button type="button" class="btn-icon-action delete"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <div class="item-row">
                    <span class="item-name">1x ASUS ROG Zephyrus G14 Black Edition</span>
                    <div class="item-right">
                        <span class="item-price">Rp 24.500.000</span>
                        <button type="button" class="btn-icon-action edit"><i class="fa-solid fa-pen"></i></button>
                        <button type="button" class="btn-icon-action delete"><i class="fa-solid fa-trash"></i></button>
                    </div>
                </div>
                <div class="item-row">
                    <span class="item-name">1x ASUS ROG Zephyrus G14 Black Edition</span>
                    <div class="item-right">
                        <span class="item-price">Rp 24.500.000</span>
                        <button type="button" class="btn-icon-action edit"><i class="fa-solid fa-pen"></i></button>
                        <button type="button" class="btn-icon-action delete"><i class="fa-solid fa-trash"></i></button>
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
        const openAddBtn = document.getElementById('openAddTransaction');
        const closeAddBtn = document.getElementById('closeAddModal');
        const closeEditBtn = document.getElementById('closeEditModal');
        const saveAddBtn = document.getElementById('saveAddModal');
        const saveEditBtn = document.getElementById('saveEditModal');

        openAddBtn.addEventListener('click', () => addModal.classList.add('active'));
        closeAddBtn.addEventListener('click', () => addModal.classList.remove('active'));
        saveAddBtn.addEventListener('click', () => addModal.classList.remove('active'));

        function openEditModal(receipt, type, cashier, customer, method, status, shipping, total) {
            document.getElementById('editReceipt').value = receipt;
            document.getElementById('editType').value = type;
            document.getElementById('editCashier').value = cashier;
            document.getElementById('editCustomer').value = customer;
            document.getElementById('editMethod').value = method;
            document.getElementById('editStatus').value = status;
            document.getElementById('editShipping').value = 'Rp ' + shipping;
            document.getElementById('editTotal').value = 'Rp ' + total;
            editModal.classList.add('active');
        }

        closeEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
        saveEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
    </script>

</body>
</html>