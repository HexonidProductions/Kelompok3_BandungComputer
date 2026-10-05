<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Overview - Bandung Computer Admin</title>
  
  <!-- Font Awesome untuk Icon -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- Memanggil File CSS Terpisah -->
  <link rel="stylesheet" href="{{ asset('css/overview.css') }}">
</head>
<body>

  <div class="dashboard-container">
    
    <!-- Sidebar / Navigasi Kiri -->
    <aside class="sidebar">
      <div class="sidebar-header">
        <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo" class="brand-logo">
      </div>

      <nav class="sidebar-menu">
        <a href="{{ url('/overview') }}" class="menu-item active">
          <i class="fa-solid fa-border-all"></i>
          <span>Overview</span>
        </a>
        <a href="#" class="menu-item">
          <i class="fa-solid fa-tag"></i>
          <span>Categories</span>
        </a>
        <a href="#" class="menu-item">
          <i class="fa-solid fa-cart-shopping"></i>
          <span>Transactions</span>
        </a>
        <a href="#" class="menu-item">
          <i class="fa-solid fa-box"></i>
          <span>Products</span>
        </a>
        <a href="#" class="menu-item">
          <i class="fa-solid fa-users"></i>
          <span>Users</span>
        </a>
        <a href="#" class="menu-item">
          <i class="fa-solid fa-truck"></i>
          <span>Suppliers</span>
        </a>
        <a href="#" class="menu-item">
          <i class="fa-solid fa-key"></i>
          <span>Daily Closing</span>
        </a>
      </nav>

      <div class="sidebar-footer">
        <p class="role-title">Admin</p>
        <p class="admin-name">Alif Hassan Abdillah</p>
        <a href="{{ url('/login') }}" class="btn-logout">Logout</a>
      </div>
    </aside>

    <!-- Konten Utama Dashboard -->
    <main class="main-content">
      <header class="content-header">
        <h1>Welcome back, Bandung Computer Admin</h1>
      </header>

      <!-- Grid Kartu Statistik -->
      <section class="stats-grid">
        <div class="stat-card">
          <div class="stat-info">
            <p class="stat-label">Total Sales This Month</p>
            <h3 class="stat-value">Rp 196.000.000</h3>
          </div>
          <div class="stat-icon">
            <i class="fa-regular fa-wallet"></i>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-info">
            <p class="stat-label">Transaction Amount</p>
            <h3 class="stat-value">482 Transaction</h3>
          </div>
          <div class="stat-icon">
            <i class="fa-solid fa-arrow-right-arrow-left"></i>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-info">
            <p class="stat-label">Supplier Active</p>
            <h3 class="stat-value">15 Supplier</h3>
          </div>
          <div class="stat-icon">
            <i class="fa-regular fa-circle-check"></i>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-info">
            <p class="stat-label">Products Low On Stock</p>
            <h3 class="stat-value">3 Item</h3>
          </div>
          <div class="stat-icon">
            <i class="fa-solid fa-box-open"></i>
          </div>
        </div>
      </section>

      <!-- Tabel Riwayat Closing Shift -->
      <section class="table-card">
        <div class="table-header">
          <h2>Last Closing Shift History</h2>
          <a href="#" class="see-all">See All <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>Date</th>
                <th>Shift</th>
                <th>Cashier</th>
                <th>Note</th>
                <th>Initial Balance</th>
                <th>Income</th>
                <th>Expenditure</th>
                <th>Final Balance</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>24 Sep 2026</td>
                <td>Morning Shift</td>
                <td>Muhammad Zidan</td>
                <td>Penutupan kasir shift 1 berjalan lancar.</td>
                <td>Rp 1.000.000</td>
                <td>Rp 34.200.000</td>
                <td>Rp 250.000</td>
                <td class="highlight-text">Rp 34.950.000</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td>25 Sep 2026</td>
                <td>Night Shift</td>
                <td>Danish</td>
                <td>Penutupan kasir shift 2 berjalan lancar.</td>
                <td>Rp 1.000.000</td>
                <td>Rp 28.450.000</td>
                <td>Rp 100.000</td>
                <td class="highlight-text">Rp 29.350.000</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td>26 Sep 2026</td>
                <td>Morning Shift</td>
                <td>Fatih</td>
                <td>Penutupan kasir shift 3 berjalan lancar.</td>
                <td>Rp 1.000.000</td>
                <td>Rp 31.100.000</td>
                <td>Rp 150.000</td>
                <td class="highlight-text">Rp 31.950.000</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td>27 Sep 2026</td>
                <td>Night Shift</td>
                <td>Cnada</td>
                <td>Penutupan kasir shift 4 berjalan lancar.</td>
                <td>Rp 1.000.000</td>
                <td>Rp 40.250.000</td>
                <td>Rp 300.000</td>
                <td class="highlight-text">Rp 40.950.000</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>

        <!-- Footer Tabel & Paginasi -->
        <div class="table-footer">
          <p>Showing 1-1 out of 8 Category</p>
          <div class="pagination">
            <button class="page-nav">Previous</button>
            <button class="page-num active">1</button>
            <button class="page-num">2</button>
            <button class="page-nav">Next</button>
          </div>
        </div>
      </section>
    </main>

  </div>

</body>
</html>