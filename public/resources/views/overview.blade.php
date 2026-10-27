<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview - Bandung Computer Admin</title>
    
    <!-- PANGGIL FILE CSS OVERVIEW -->
    <link rel="stylesheet" href="{{ asset('css/overview.css') }}?v=1">
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
    <a href="{{ route('overview') }}" class="menu-item active">
        <i class="fa-solid fa-border-all"></i>
        <span>Overview</span>
    </a>
    
    <!-- UBAH DI BAGIAN INI (Ganti href="#" jadi {{ route('categories') }}) -->
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
   <a href="{{ route('daily.closing') }}" class="menu-item">
    <i class="fa-solid fa-key"></i>
    <span>Daily Closing</span>
</a>
</nav>

            <div class="sidebar-footer">
                <div class="admin-info">
                    <span class="role">Admin</span>
                    <strong class="name">Alif Hassan A...</strong>
                </div>
                <a href="{{ url('/tes-login') }}" class="btn-logout">Logout</a>
            </div>
        </aside>

        <!-- KONTEN UTAMA OVERVIEW -->
        <main class="main-content">
            <header class="content-header">
                <h1>Welcome back, Bandung Computer Admin</h1>
            </header>

            <!-- 4 CARD STATISTIK -->
            <section class="stats-grid">
                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Total Sales This Month</span>
                        <h3 class="stat-value">Rp 196.000.000</h3>
                    </div>
                    <div class="stat-icon blue-light">
                        <i class="fa-regular fa-credit-card"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Transaction Amount</span>
                        <h3 class="stat-value">482 Transaction</h3>
                    </div>
                    <div class="stat-icon blue-light">
                        <i class="fa-solid fa-arrow-right-arrow-left"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Supplier Active</span>
                        <h3 class="stat-value">15 Supplier</h3>
                    </div>
                    <div class="stat-icon blue-light">
                        <i class="fa-regular fa-circle-check"></i>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-info">
                        <span class="stat-title">Products Low On Stock</span>
                        <h3 class="stat-value">3 Item</h3>
                    </div>
                    <div class="stat-icon blue-light">
                        <i class="fa-solid fa-cube"></i>
                    </div>
                </div>
            </section>

            <!-- TABEL SHIFT HISTORY -->
            <section class="table-card">
                <div class="table-header">
                    <h2>Last Closing Shift History</h2>
                    <a href="#" class="see-all">See All</a>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Shift</th>
                                <th>Cashier</th>
                                <th>Note</th>
                                <th class="text-right">Total Income</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>24 Sep 2026</td>
                                <td>Morning Shift</td>
                                <td>Muhammad Zidan</td>
                                <td>Penutupan kasir shift 1 berjalan lancar.</td>
                                <td class="text-right font-bold">Rp 34.950.000</td>
                            </tr>
                            <tr>
                                <td>25 Sep 2026</td>
                                <td>Night Shift</td>
                                <td>Danish</td>
                                <td>Penutupan kasir shift 2 berjalan lancar.</td>
                                <td class="text-right font-bold">Rp 29.350.000</td>
                            </tr>
                            <tr>
                                <td>26 Sep 2026</td>
                                <td>Morning Shift</td>
                                <td>Fatih</td>
                                <td>Penutupan kasir shift 3 berjalan lancar.</td>
                                <td class="text-right font-bold">Rp 31.950.000</td>
                            </tr>
                            <tr>
                                <td>27 Sep 2026</td>
                                <td>Night Shift</td>
                                <td>Cnada</td>
                                <td>Penutupan kasir shift 4 berjalan lancar.</td>
                                <td class="text-right font-bold">Rp 40.950.000</td>
                            </tr>
                            <tr>
                                <td>27 Sep 2026</td>
                                <td>Night Shift</td>
                                <td>Cnada</td>
                                <td>Penutupan kasir shift 4 berjalan lancar.</td>
                                <td class="text-right font-bold">Rp 40.950.000</td>
                            </tr>
                            <tr>
                                <td>27 Sep 2026</td>
                                <td>Night Shift</td>
                                <td>Cnada</td>
                                <td>Penutupan kasir shift 4 berjalan lancar.</td>
                                <td class="text-right font-bold">Rp 40.950.000</td>
                            </tr>
                            <tr>
                                <td>27 Sep 2026</td>
                                <td>Night Shift</td>
                                <td>Cnada</td>
                                <td>Penutupan kasir shift 4 berjalan lancar.</td>
                                <td class="text-right font-bold">Rp 40.950.000</td>
                            </tr>
                            <tr>
                                <td>27 Sep 2026</td>
                                <td>Night Shift</td>
                                <td>Cnada</td>
                                <td>Penutupan kasir shift 4 berjalan lancar.</td>
                                <td class="text-right font-bold">Rp 40.950.000</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <span>Showing 1-8 out of 25 Last Closing Shift History</span>
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

</body>
</html>