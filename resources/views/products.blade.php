<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Products - Bandung Computer Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/products.css') }}">
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
        <a href="{{ url('/products') }}" class="menu-item active">
          <i class="fa-solid fa-box"></i>
          <span>Products</span>
        </a>
        <a href="{{ url('/users') }}" class="menu-item">
  <i class="fa-solid fa-users"></i>
  <span>Users</span>
</a>
<a href="{{ url('/suppliers') }}" class="menu-item">
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
        <h1>Products</h1>
      </header>

      <div class="filter-bar">
        <div class="filter-left">
          <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search product name or code" class="search-input">
          </div>
          <select class="category-select">
            <option value="all">Category: All</option>
            <option value="laptop">Laptop</option>
            <option value="smartphone">Smartphone</option>
          </select>
        </div>

        <a href="#" class="btn-add">
          <i class="fa-solid fa-plus"></i>
          <span>Add Product</span>
        </a>
      </div>

      <section class="stats-grid">
        <div class="stat-card">
          <div class="stat-info">
            <p class="stat-label">Total Registered Products</p>
            <h3 class="stat-value">48 Unit</h3>
          </div>
          <div class="stat-icon">
            <i class="fa-regular fa-box"></i>
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

        <div class="stat-card">
          <div class="stat-info">
            <p class="stat-label">Active Category</p>
            <h3 class="stat-value">3 Category</h3>
          </div>
          <div class="stat-icon">
            <i class="fa-solid fa-layer-group"></i>
          </div>
        </div>
      </section>

      <section class="table-card">
        <h2 class="table-title">Product List</h2>

        <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>Product Code</th>
                <th>Image</th>
                <th>Product Name</th>
                <th>Category</th>
                <th>Description</th>
                <th>Buy Price</th>
                <th>Sell Price</th>
                <th>Stock</th>
                <th>Status</th>
                <th>Updated at</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="product-code">LPT-ROG14</td>
                <td><img src="{{ asset('images/zeyprus_black_edition.png') }}" alt="Laptop" class="product-img"></td>
                <td class="product-name">ASUS ROG Zephyrus G14 Black Edition</td>
                <td>Laptop</td>
                <td class="description-text">AMD Ryzen 9 | RTX 4060 | 16GB RAM | 1TB SSD 14.0" QHD+ 165Hz | Win 11 + OHS</td>
                <td>Rp 21.000.000</td>
                <td>Rp 24.500.000</td>
                <td>12</td>
                <td><span class="badge-available">Available</span></td>
                <td>2026-09-18 01:15:47</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>

              <tr>
                <td class="product-code">LPT-ROG13</td>
                <td><img src="{{ asset('images/iphone_17_pro_silver.png') }}" alt="iPhone" class="product-img"></td>
                <td class="product-name">iPhone 15 Pro Silver</td>
                <td>Laptop</td>
                <td class="description-text">Apple A17 Pro (3nm) | 8GB RAM | Storage 256GB | 6.1" OLED 120Hz Super Retina | Triple 48MP Camera | Titanium Silver | USB-C 3.2</td>
                <td>Rp 21.000.000</td>
                <td>Rp 24.500.000</td>
                <td>12</td>
                <td><span class="badge-out-stock">Out of stock</span></td>
                <td>2026-09-18 01:15:47</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>

              <tr>
                <td class="product-code">LPT-ROG12</td>
                 <td><img src="{{ asset('images/asus_rog_gaming_a15.png') }}" alt="laptop" class="product-img"></td>
                <td class="product-name">ASUS ROG GAMING A15</td>
                <td>Laptop</td>
                <td class="description-text">AMD Ryzen 9 | RTX 4060 | 16GB RAM | 1TB SSD 14.0" QHD+ 165Hz | Win 11 + OHS</td>
                <td>Rp 21.000.000</td>
                <td>Rp 24.500.000</td>
                <td>12</td>
                <td><span class="badge-out-stock">Out of stock</span></td>
                <td>2026-09-18 01:15:47</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="table-footer">
          <p>Showing 1-4 out of 10 Products</p>
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