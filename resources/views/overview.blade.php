<<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Overview - Bandung Computer Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }

    body {
      background-color: #f3f5f8;
      color: #111827;
    }

    .dashboard-container {
      display: flex;
      min-height: 100vh;
    }

    .sidebar {
      width: 240px;
      background-color: #0b1329;
      color: #ffffff;
      display: flex;
      flex-direction: column;
      padding: 24px 16px;
      flex-shrink: 0;
    }

    .sidebar-header {
      padding: 0 8px 24px 8px;
      text-align: center;
    }

    .brand-logo {
      max-width: 150px;
      height: auto;
      border-radius: 6px;
    }

    .sidebar-menu {
      display: flex;
      flex-direction: column;
      gap: 6px;
      flex: 1;
    }

    .menu-item {
      display: flex;
      align-items: center;
      gap: 14px;
      padding: 12px 16px;
      color: #94a3b8;
      text-decoration: none;
      font-size: 14px;
      font-weight: 500;
      border-radius: 8px;
      transition: all 0.2s;
    }

    .menu-item i {
      font-size: 16px;
      width: 20px;
      text-align: center;
    }

    .menu-item:hover {
      color: #ffffff;
      background-color: rgba(255, 255, 255, 0.05);
    }

    .menu-item.active {
      background-color: #2563eb;
      color: #ffffff;
    }

    .sidebar-footer {
      margin-top: auto;
      padding-top: 20px;
    }

    .role-title {
      font-size: 12px;
      color: #64748b;
      margin-bottom: 2px;
    }

    .admin-name {
      font-size: 14px;
      font-weight: 700;
      color: #ffffff;
      margin-bottom: 12px;
    }

    .btn-logout {
      display: block;
      width: 100%;
      padding: 10px;
      background-color: #1d4ed8;
      color: #ffffff;
      text-align: center;
      text-decoration: none;
      font-size: 13px;
      font-weight: 600;
      border-radius: 8px;
      transition: background-color 0.2s;
    }

    .btn-logout:hover {
      background-color: #1e40af;
    }

    .main-content {
      flex: 1;
      padding: 32px 40px;
      overflow-y: auto;
    }

    .content-header h1 {
      font-size: 24px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 24px;
    }

    .stats-grid {
      display: grid;
      grid-template-columns: repeat(2, 1fr);
      gap: 16px;
      margin-bottom: 24px;
    }

    .stat-card {
      background-color: #ffffff;
      padding: 20px 24px;
      border-radius: 12px;
      display: flex;
      justify-content: space-between;
      align-items: flex-start;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
      border: 1px solid #e2e8f0;
    }

    .stat-label {
      font-size: 12px;
      color: #64748b;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .stat-value {
      font-size: 20px;
      font-weight: 800;
      color: #0f172a;
    }

    .stat-icon {
      font-size: 18px;
      color: #2563eb;
    }

    .table-card {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 24px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
      border: 1px solid #e2e8f0;
    }

    .table-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
    }

    .table-header h2 {
      font-size: 15px;
      font-weight: 700;
      color: #0f172a;
    }

    .see-all {
      font-size: 12px;
      font-weight: 600;
      color: #0f172a;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 6px;
    }

    .table-responsive {
      width: 100%;
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
      font-size: 11px;
    }

    th {
      background-color: #f8fafc;
      padding: 12px 10px;
      color: #475569;
      font-weight: 600;
      border-bottom: 1px solid #e2e8f0;
    }

    td {
      padding: 14px 10px;
      color: #1e293b;
      border-bottom: 1px solid #f1f5f9;
    }

    .highlight-text {
      font-weight: 700;
    }

    .btn-action {
      background: none;
      border: none;
      color: #64748b;
      cursor: pointer;
      font-size: 14px;
    }

    .table-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 20px;
      font-size: 11px;
      color: #64748b;
    }

    .pagination {
      display: flex;
      gap: 6px;
    }

    .page-nav, .page-num {
      border: 1px solid #e2e8f0;
      background-color: #ffffff;
      padding: 6px 12px;
      border-radius: 6px;
      font-size: 11px;
      cursor: pointer;
      color: #334155;
    }

    .page-num.active {
      background-color: #000000;
      color: #ffffff;
      border-color: #000000;
    }
  </style>
</head>
<body>

  <div class="dashboard-container">
    
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

    <main class="main-content">
      <header class="content-header">
        <h1>Welcome back, Bandung Computer Admin</h1>
      </header>

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