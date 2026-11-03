<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daily Closing - Bandung Computer</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Daily Closing -->
    <link rel="stylesheet" href="{{ asset('css/daily-closing.css') }}">
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
                    <li><a href="{{ route('categories') }}"><i class="fa-solid fa-tag"></i> Categories</a></li>
                    <li><a href="{{ route('transactions') }}"><i class="fa-solid fa-cart-shopping"></i> Transactions</a></li>
                    <li><a href="{{ route('products') }}"><i class="fa-solid fa-box"></i> Products</a></li>
                    <li><a href="{{ route('users') }}"><i class="fa-solid fa-users"></i> Users</a></li>
                    <li><a href="{{ route('suppliers') }}"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
                    <li><a href="{{ route('inventory-logs') }}"><i class="fa-solid fa-clipboard-list"></i> Inventory Logs</a></li>
                    <li><a href="{{ route('daily-closing') }}" class="active"><i class="fa-solid fa-wrench"></i> Daily Closing</a></li>
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
            <h1 class="page-title">Daily Closing</h1>

            <div class="top-bar-shift">
                <div class="shift-info">Today's Shift: Alif Hassan Abdillah</div>
                <button class="btn-add" onclick="openAddModal()">
                    <i class="fa-solid fa-plus"></i> Add History
                </button>
            </div>

            <!-- Summary Section -->
            <div class="summary-grid">
                <!-- Total Income Card -->
                <div class="card-summary">
                    <div>
                        <div class="card-summary-header">
                            <span class="card-summary-title">Total Income</span>
                            <i class="fa-regular fa-credit-card" style="color: #2563eb;"></i>
                        </div>
                        <div class="total-income-amount">Rp 64.150.000</div>
                    </div>
                    <div class="income-subtext">Akumulasi penjualan cash & digital</div>
                </div>

                <!-- Details per Payment Method Card -->
                <div class="card-summary">
                    <div class="card-summary-title" style="margin-bottom: 12px;">Details per Payment Method</div>
                    <div class="payment-methods-list">
                        <div class="pm-item">
                            <div class="pm-left">
                                <span class="pm-badge badge-cash">Cash</span>
                                <span class="pm-tx-count">34 Transaction</span>
                            </div>
                            <span class="pm-amount">Rp 12.850.000</span>
                        </div>
                        <div class="pm-item">
                            <div class="pm-left">
                                <span class="pm-badge badge-debit">Debit</span>
                                <span class="pm-tx-count">21 Transaction</span>
                            </div>
                            <span class="pm-amount">Rp 18.400.000</span>
                        </div>
                        <div class="pm-item">
                            <div class="pm-left">
                                <span class="pm-badge badge-qris">QRIS</span>
                                <span class="pm-tx-count">45 Transaction</span>
                            </div>
                            <span class="pm-amount">Rp 32.900.000</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Table Card -->
            <div class="card-table">
                <h2 class="card-table-title">Last Closing Shift History</h2>

                <table id="closingTable">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Shift</th>
                            <th>Admin</th>
                            <th>Note</th>
                            <th>Income</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="closingBody">
                        <tr>
                            <td>24 Sep 2026</td>
                            <td>Morning Shift</td>
                            <td>Muhammad Zidan</td>
                            <td class="note-cell">Penutupan kasir shift 1 berjalan lancar.</td>
                            <td><strong>Rp 34.200.000</strong></td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td>25 Sep 2026</td>
                            <td>Night Shift</td>
                            <td>Danish</td>
                            <td class="note-cell">Penutupan kasir shift 2 berjalan lancar.</td>
                            <td><strong>Rp 28.450.000</strong></td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td>26 Sep 2026</td>
                            <td>Morning Shift</td>
                            <td>Fatih</td>
                            <td class="note-cell">Penutupan kasir shift 3 berjalan lancar.</td>
                            <td><strong>Rp 31.100.000</strong></td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td>27 Sep 2026</td>
                            <td>Night Shift</td>
                            <td>Cnada</td>
                            <td class="note-cell">Penutupan kasir shift 4 berjalan lancar.</td>
                            <td><strong>Rp 40.250.000</strong></td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td>27 Sep 2026</td>
                            <td>Night Shift</td>
                            <td>Cnada</td>
                            <td class="note-cell">Penutupan kasir shift 4 berjalan lancar.</td>
                            <td><strong>Rp 40.250.000</strong></td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    <div id="closingCountText">Menampilkan 1-5 dari 5 Last Closing Shift History</div>
                    <div class="pagination">
                        <button class="page-btn">Sebelumnya</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">Selanjutnya</button>
                    </div>
                </div>
            </div>
        </main>

    </div>

    <!-- Modal Form Dynamic Daily Closing (Add & Edit) -->
    <div class="modal-overlay" id="closingModal">
        <div class="modal-box-lg">
            <h3 class="modal-title" id="modalTitle">Add New Closing</h3>
            
            <form id="closingForm">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Admin Name</label>
                        <input type="text" id="adminInput" class="form-control" placeholder="Enter admin name" required>
                    </div>
                    <div class="form-group">
                        <label>Total Income</label>
                        <input type="text" id="incomeInput" class="form-control" placeholder="Rp 0" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Note</label>
                    <textarea id="noteInput" class="form-control" placeholder="Enter note"></textarea>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal()">Cancel</button>
                    <button type="button" class="btn-modal-delete" id="btnDelete" onclick="deleteClosing()" style="display: none;">Delete</button>
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
            document.getElementById('modalTitle').innerText = "Add New Closing";
            document.getElementById('closingForm').reset();
            document.getElementById('btnDelete').style.display = 'none';
            document.getElementById('closingModal').classList.add('active');
        }

        function openEditModal(btn) {
            selectedRow = btn.closest('tr');
            document.getElementById('modalTitle').innerText = "Edit Closing Details";
            
            const cells = selectedRow.cells;
            document.getElementById('adminInput').value = cells[2].innerText.trim();
            document.getElementById('noteInput').value = cells[3].innerText.trim();
            document.getElementById('incomeInput').value = cells[4].innerText.trim();

            document.getElementById('btnDelete').style.display = 'inline-block';
            document.getElementById('closingModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('closingModal').classList.remove('active');
        }

        document.getElementById('closingForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const admin = document.getElementById('adminInput').value;
            const income = document.getElementById('incomeInput').value;
            const note = document.getElementById('noteInput').value || 'Penutupan kasir berjalan lancar.';

            const today = new Date();
            const dateStr = today.getDate() + ' ' + today.toLocaleString('en-US', { month: 'short' }) + ' ' + today.getFullYear();
            const shiftStr = "Morning Shift";

            if (selectedRow) {
                // UPDATE BARIS
                selectedRow.cells[2].innerText = admin;
                selectedRow.cells[3].innerText = note;
                selectedRow.cells[4].innerHTML = `<strong>${income}</strong>`;
            } else {
                // TAMBAH BARIS BARU (CREATE)
                const tbody = document.getElementById('closingBody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td>${dateStr}</td>
                    <td>${shiftStr}</td>
                    <td>${admin}</td>
                    <td class="note-cell">${note}</td>
                    <td><strong>${income}</strong></td>
                    <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                `;
                tbody.prepend(newRow);
            }

            updateCounter();
            closeModal();
        });

        function deleteClosing() {
            if (selectedRow && confirm('Apakah Anda yakin ingin menghapus data closing ini?')) {
                selectedRow.remove();
                updateCounter();
                closeModal();
            }
        }

        function updateCounter() {
            const rows = document.querySelectorAll('#closingBody tr');
            document.getElementById('closingCountText').innerText = `Menampilkan 1-${rows.length} dari ${rows.length} Last Closing Shift History`;
        }
    </script>

</body>
</html>