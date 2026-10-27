<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Closing - Bandung Computer Admin</title>
    
    <link rel="stylesheet" href="{{ asset('css/daily-closing.css') }}?v=1">
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
                <a href="{{ route('inventory.logs') }}" class="menu-item">
                    <i class="fa-solid fa-receipt"></i>
                    <span>Inventory Logs</span>
                </a>
                <a href="{{ route('daily.closing') }}" class="menu-item active">
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

        <!-- KONTEN UTAMA DAILY CLOSING -->
        <main class="main-content">
            <header class="content-header">
                <h1>Daily Closing</h1>
            </header>

            <div class="top-bar-daily">
                <span class="sub-header-title">Today's Shift: Alif Hassan Abdillah</span>
                <button type="button" class="btn-add" id="openAddClosing">
                    <i class="fa-solid fa-plus"></i> Add History
                </button>
            </div>

            <!-- CARDS SUMMARY -->
            <section class="daily-summary-grid">
                <!-- CARD TOTAL INCOME -->
                <div class="income-card">
                    <div>
                        <div class="card-top-info">
                            <span class="income-title">Total Income</span>
                            <i class="fa-regular fa-credit-card card-icon"></i>
                        </div>
                        <h2 class="income-value">Rp 64.150.000</h2>
                    </div>
                    <span class="income-subtext">Akumulasi penjualan cash & digital</span>
                </div>

                <!-- CARD DETAILS PER PAYMENT METHOD -->
                <div class="payment-details-card">
                    <h3 class="payment-card-title">Details per Payment Method</h3>
                    <div class="payment-method-list">
                        <div class="payment-method-row">
                            <div class="method-left">
                                <span class="badge-payment cash">Cash</span>
                                <span class="tx-count">34 Transaction</span>
                            </div>
                            <span class="method-amount">Rp 12.850.000</span>
                        </div>
                        <div class="payment-method-row">
                            <div class="method-left">
                                <span class="badge-payment debit">Debit</span>
                                <span class="tx-count">21 Transaction</span>
                            </div>
                            <span class="method-amount">Rp 18.400.000</span>
                        </div>
                        <div class="payment-method-row">
                            <div class="method-left">
                                <span class="badge-payment qris">QRIS</span>
                                <span class="tx-count">45 Transaction</span>
                            </div>
                            <span class="method-amount">Rp 32.900.000</span>
                        </div>
                    </div>
                </div>
            </section>

            <!-- TABEL LAST CLOSING SHIFT HISTORY -->
            <section class="table-card">
                <div class="table-header">
                    <h2>Last Closing Shift History</h2>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Shift</th>
                                <th>Admin</th>
                                <th>Note</th>
                                <th>Income</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>24 Sep 2026</td>
                                <td>Morning Shift</td>
                                <td>Muhammad Zidan</td>
                                <td class="note-cell">Penutupan kasir shift 1 berjalan lancar.</td>
                                <td class="income-cell">Rp 34.200.000</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('Muhammad Zidan', '34.200.000', 'Penutupan kasir shift 1 berjalan lancar.')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>25 Sep 2026</td>
                                <td>Night Shift</td>
                                <td>Danish</td>
                                <td class="note-cell">Penutupan kasir shift 2 berjalan lancar.</td>
                                <td class="income-cell">Rp 28.450.000</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('Danish', '28.450.000', 'Penutupan kasir shift 2 berjalan lancar.')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>26 Sep 2026</td>
                                <td>Morning Shift</td>
                                <td>Fatih</td>
                                <td class="note-cell">Penutupan kasir shift 3 berjalan lancar.</td>
                                <td class="income-cell">Rp 31.100.000</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('Fatih', '31.100.000', 'Penutupan kasir shift 3 berjalan lancar.')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>27 Sep 2026</td>
                                <td>Night Shift</td>
                                <td>Cnada</td>
                                <td class="note-cell">Penutupan kasir shift 4 berjalan lancar.</td>
                                <td class="income-cell">Rp 40.250.000</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('Cnada', '40.250.000', 'Penutupan kasir shift 4 berjalan lancar.')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td>27 Sep 2026</td>
                                <td>Night Shift</td>
                                <td>Cnada</td>
                                <td class="note-cell">Penutupan kasir shift 4 berjalan lancar.</td>
                                <td class="income-cell">Rp 40.250.000</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('Cnada', '40.250.000', 'Penutupan kasir shift 4 berjalan lancar.')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <span>Menampilkan 1-1 dari 4 Last Closing Shift History</span>
                    <div class="pagination">
                        <button class="btn-page">Sebelumnya</button>
                        <button class="btn-page active">1</button>
                        <button class="btn-page">2</button>
                        <button class="btn-page">Selanjutnya</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- POPUP MODAL ADD NEW CLOSING -->
    <div class="modal-overlay" id="addModal">
        <div class="modal-card-lg">
            <h3>Add New Closing</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Admin Name</label>
                        <input type="text" placeholder="Enter admin name">
                    </div>
                    <div class="form-group-modal">
                        <label>Total Income</label>
                        <input type="text" value="Rp 0">
                    </div>
                </div>

                <div class="form-group-modal">
                    <label>Note</label>
                    <textarea placeholder="Enter note"></textarea>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-cancel" id="closeAddModal">Cancel</button>
                    <button type="button" class="btn-delete">Delete</button>
                    <button type="button" class="btn-save" id="saveAddModal">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- POPUP MODAL EDIT CLOSING DETAILS -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-card-lg">
            <h3>Edit Closing Details</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Admin Name</label>
                        <input type="text" id="editAdmin" placeholder="Enter admin name">
                    </div>
                    <div class="form-group-modal">
                        <label>Total Income</label>
                        <input type="text" id="editIncome" value="Rp 0">
                    </div>
                </div>

                <div class="form-group-modal">
                    <label>Note</label>
                    <textarea id="editNote" placeholder="Enter note"></textarea>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-cancel" id="closeEditModal">Cancel</button>
                    <button type="button" class="btn-delete">Delete</button>
                    <button type="button" class="btn-save" id="saveEditModal">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT POPUP MODAL -->
    <script>
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');
        const openAddBtn = document.getElementById('openAddClosing');
        const closeAddBtn = document.getElementById('closeAddModal');
        const closeEditBtn = document.getElementById('closeEditModal');
        const saveAddBtn = document.getElementById('saveAddModal');
        const saveEditBtn = document.getElementById('saveEditModal');

        openAddBtn.addEventListener('click', () => addModal.classList.add('active'));
        closeAddBtn.addEventListener('click', () => addModal.classList.remove('active'));
        saveAddBtn.addEventListener('click', () => addModal.classList.remove('active'));

        function openEditModal(admin, income, note) {
            document.getElementById('editAdmin').value = admin;
            document.getElementById('editIncome').value = 'Rp ' + income;
            document.getElementById('editNote').value = note;
            editModal.classList.add('active');
        }

        closeEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
        saveEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
    </script>

</body>
</html>