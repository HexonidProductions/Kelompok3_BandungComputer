<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daily Closing - Bandung Computer Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('css/daily-closing.css')); ?>">
</head>
<body>

  <div class="dashboard-container">
    
    <aside class="sidebar">
      <div class="sidebar-header">
        <img src="<?php echo e(asset('images/logo_bc.png')); ?>" alt="Bandung Computer Logo" class="brand-logo">
      </div>

      <nav class="sidebar-menu">
        <a href="<?php echo e(url('/overview')); ?>" class="menu-item">
          <i class="fa-solid fa-border-all"></i>
          <span>Overview</span>
        </a>
        <a href="<?php echo e(url('/categories')); ?>" class="menu-item">
          <i class="fa-solid fa-tag"></i>
          <span>Categories</span>
        </a>
        <a href="<?php echo e(url('/transactions')); ?>" class="menu-item">
          <i class="fa-solid fa-cart-shopping"></i>
          <span>Transactions</span>
        </a>
        <a href="<?php echo e(url('/products')); ?>" class="menu-item">
          <i class="fa-solid fa-box"></i>
          <span>Products</span>
        </a>
        <a href="<?php echo e(url('/users')); ?>" class="menu-item">
          <i class="fa-solid fa-users"></i>
          <span>Users</span>
        </a>
        <a href="<?php echo e(url('/suppliers')); ?>" class="menu-item">
          <i class="fa-solid fa-truck"></i>
          <span>Suppliers</span>
        </a>
        <a href="<?php echo e(url('/daily-closing')); ?>" class="menu-item active">
          <i class="fa-solid fa-key"></i>
          <span>Daily Closing</span>
        </a>
      </nav>

      <div class="sidebar-footer">
        <p class="role-title">Admin</p>
        <p class="admin-name">Alif Hassan Abdillah</p>
        <a href="<?php echo e(url('/login')); ?>" class="btn-logout">Logout</a>
      </div>
    </aside>

    <main class="main-content">
      <header class="content-header">
        <h1>Daily Closing</h1>
      </header>

      <div class="shift-banner">
        <span class="shift-info">Today's Shift: Alif Hassan Abdillah</span>
        <a href="#" class="btn-add">
          <i class="fa-solid fa-plus"></i>
          <span>Add History</span>
        </a>
      </div>

      <section class="stats-grid">
        <div class="stat-card total-income">
          <div>
            <div class="card-header-flex">
              <span class="stat-label">Total Income</span>
              <i class="fa-regular fa-wallet stat-icon-blue"></i>
            </div>
            <h2 class="stat-value">Rp 64.150.000</h2>
          </div>
          <p class="stat-desc">Akumulasi penjualan cash & digital</p>
        </div>

        <div class="stat-card">
          <h3 class="details-title">Details per Payment Method</h3>
          <div class="payment-methods-list">
            <div class="payment-item">
              <div class="payment-left">
                <span class="badge-payment badge-cash">Cash</span>
                <span class="tx-count">34 Transaction</span>
              </div>
              <span class="payment-amount">Rp 12.850.000</span>
            </div>

            <div class="payment-item">
              <div class="payment-left">
                <span class="badge-payment badge-debit">Debit</span>
                <span class="tx-count">21 Transaction</span>
              </div>
              <span class="payment-amount">Rp 18.400.000</span>
            </div>

            <div class="payment-item">
              <div class="payment-left">
                <span class="badge-payment badge-qris">QRIS</span>
                <span class="tx-count">45 Transaction</span>
              </div>
              <span class="payment-amount">Rp 32.900.000</span>
            </div>
          </div>
        </div>
      </section>

      <section class="table-card">
        <h2 class="table-title">Last Closing Shift History</h2>

        <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>Date</th>
                <th>Shift</th>
                <th>Cashier</th>
                <th>Note</th>
                <th>Income</th>
                <th class="action-col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>24 Sep 2026</td>
                <td>Morning Shift</td>
                <td class="cashier-name">Muhammad Zidan</td>
                <td class="note-text">Penutupan kasir shift 1 berjalan lancar.</td>
                <td class="income-amount">Rp 34.200.000</td>
                <td class="action-col"><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td>25 Sep 2026</td>
                <td>Night Shift</td>
                <td class="cashier-name">Danish</td>
                <td class="note-text">Penutupan kasir shift 2 berjalan lancar.</td>
                <td class="income-amount">Rp 28.450.000</td>
                <td class="action-col"><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td>26 Sep 2026</td>
                <td>Morning Shift</td>
                <td class="cashier-name">Fatih</td>
                <td class="note-text">Penutupan kasir shift 3 berjalan lancar.</td>
                <td class="income-amount">Rp 31.100.000</td>
                <td class="action-col"><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td>27 Sep 2026</td>
                <td>Night Shift</td>
                <td class="cashier-name">Cnada</td>
                <td class="note-text">Penutupan kasir shift 4 berjalan lancar.</td>
                <td class="income-amount">Rp 40.250.000</td>
                <td class="action-col"><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td>27 Sep 2026</td>
                <td>Night Shift</td>
                <td class="cashier-name">Cnada</td>
                <td class="note-text">Penutupan kasir shift 4 berjalan lancar.</td>
                <td class="income-amount">Rp 40.250.000</td>
                <td class="action-col"><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="table-footer">
          <p>Menampilkan 1-1 dari 4 Last Closing Shift History</p>
          <div class="pagination">
            <button class="page-nav">Sebelumnya</button>
            <button class="page-num active">1</button>
            <button class="page-num">2</button>
            <button class="page-nav">Selanjutnya</button>
          </div>
        </div>
      </section>
    </main>

  </div>

</body>
</html><?php /**PATH C:\Users\ADVAN\Kelompok3_BandungComputer\resources\views/daily-closing.blade.php ENDPATH**/ ?>