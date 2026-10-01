<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Supplier - Bandung Computer Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/suppliers.css') }}">
</head>
<body>

  <div class="dashboard-container">
    
    <aside class="sidebar">
      <div class="sidebar-header">
        <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo" class="brand-logo">
      </div>

      <nav class="sidebar-menu">
        <a href="{{ url('/overview') }}" class="menu-item">
          <i class="fa-solid fa-border-all"></i>
          <span>Overview</span>
        </a>
        <a href="{{ url('/categories') }}" class="menu-item">
          <i class="fa-solid fa-tag"></i>
          <span>Categories</span>
        </a>
        <a href="{{ url('/transactions') }}" class="menu-item">
          <i class="fa-solid fa-cart-shopping"></i>
          <span>Transactions</span>
        </a>
        <a href="{{ url('/products') }}" class="menu-item">
          <i class="fa-solid fa-box"></i>
          <span>Products</span>
        </a>
        <a href="{{ url('/users') }}" class="menu-item">
          <i class="fa-solid fa-users"></i>
          <span>Users</span>
        </a>
        <a href="{{ url('/suppliers') }}" class="menu-item active">
          <i class="fa-solid fa-truck"></i>
          <span>Suppliers</span>
        </a>
       <a href="{{ url('/daily-closing') }}" class="menu-item">
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
        <h1>Supplier</h1>
      </header>

      <div class="filter-bar">
        <div class="filter-left">
          <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search supplier" class="search-input">
          </div>
          <select class="category-select">
            <option value="all">Category: All</option>
          </select>
        </div>

        <a href="#" class="btn-add">
          <i class="fa-solid fa-plus"></i>
          <span>Add Supplier</span>
        </a>
      </div>

      <section class="stats-grid">
        <div class="stat-card">
          <div class="stat-info">
            <p class="stat-label">Total Supplier Registered</p>
            <h3 class="stat-value">21 Suppliers</h3>
          </div>
          <div class="stat-icon">
            <i class="fa-solid fa-truck"></i>
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
            <p class="stat-label">Supplier Inactive</p>
            <h3 class="stat-value">0 Supplier</h3>
          </div>
          <div class="stat-icon">
            <i class="fa-regular fa-circle-xmark"></i>
          </div>
        </div>
      </section>

      <section class="table-card">
        <h2 class="table-title">Database Supplier Resmi</h2>

        <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>Entry Code</th>
                <th>Supplier Name</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Address</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="entry-code">SPL-ASUS</td>
                <td class="supplier-name">PT. Asus Indonesia</td>
                <td>082122431234</td>
                <td>contact@asus.co.id</td>
                <td>Kuningan, Jakarta Sel...</td>
                <td><span class="badge-active">Active</span></td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="entry-code">SPL-LENOVO</td>
                <td class="supplier-name">PT. Lenovo Indonesia</td>
                <td>082122431235</td>
                <td>contact@lenovo.co.id</td>
                <td>Kelapa Gading, Jakart...</td>
                <td><span class="badge-active">Active</span></td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="entry-code">SPL-LENOVO</td>
                <td class="supplier-name">PT. Lenovo Indonesia</td>
                <td>082122431235</td>
                <td>contact@lenovo.co.id</td>
                <td>Kelapa Gading, Jakart...</td>
                <td><span class="badge-active">Active</span></td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="entry-code">SPL-LENOVO</td>
                <td class="supplier-name">PT. Lenovo Indonesia</td>
                <td>082122431235</td>
                <td>contact@lenovo.co.id</td>
                <td>Kelapa Gading, Jakart...</td>
                <td><span class="badge-active">Active</span></td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="entry-code">SPL-LENOVO</td>
                <td class="supplier-name">PT. Lenovo Indonesia</td>
                <td>082122431235</td>
                <td>contact@lenovo.co.id</td>
                <td>Kelapa Gading, Jakart...</td>
                <td><span class="badge-active">Active</span></td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="entry-code">SPL-LENOVO</td>
                <td class="supplier-name">PT. Lenovo Indonesia</td>
                <td>082122431235</td>
                <td>contact@lenovo.co.id</td>
                <td>Kelapa Gading, Jakart...</td>
                <td><span class="badge-active">Active</span></td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="entry-code">SPL-LENOVO</td>
                <td class="supplier-name">PT. Lenovo Indonesia</td>
                <td>082122431235</td>
                <td>contact@lenovo.co.id</td>
                <td>Kelapa Gading, Jakart...</td>
                <td><span class="badge-active">Active</span></td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="entry-code">SPL-LENOVO</td>
                <td class="supplier-name">PT. Lenovo Indonesia</td>
                <td>082122431235</td>
                <td>contact@lenovo.co.id</td>
                <td>Kelapa Gading, Jakart...</td>
                <td><span class="badge-active">Active</span></td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="entry-code">SPL-LENOVO</td>
                <td class="supplier-name">PT. Lenovo Indonesia</td>
                <td>082122431235</td>
                <td>contact@lenovo.co.id</td>
                <td>Kelapa Gading, Jakart...</td>
                <td><span class="badge-active">Active</span></td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="entry-code">SPL-LENOVO</td>
                <td class="supplier-name">PT. Lenovo Indonesia</td>
                <td>082122431235</td>
                <td>contact@lenovo.co.id</td>
                <td>Kelapa Gading, Jakart...</td>
                <td><span class="badge-active">Active</span></td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="table-footer">
          <p>Menampilkan 1-1 dari 2 Supplier</p>
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
</html>