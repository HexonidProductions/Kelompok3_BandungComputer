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
            <option>Category: All</option>
            <option>Laptop</option>
            <option>Smartphone</option>
          </select>
        </div>

        <button type="button" class="btn-add" id="openAddProductModalBtn">
          <i class="fa-solid fa-plus"></i>
          <span>Add Product</span>
        </button>
      </div>

      <section class="stats-grid">
        <div class="stat-card">
          <div>
            <p class="stat-label">Total Registered Products</p>
            <h2 class="stat-value">48 Unit</h2>
          </div>
          <i class="fa-solid fa-box-open stat-icon"></i>
        </div>

        <div class="stat-card">
          <div>
            <p class="stat-label">Products Low On Stock</p>
            <h2 class="stat-value">3 Item</h2>
          </div>
          <i class="fa-solid fa-triangle-exclamation stat-icon"></i>
        </div>

        <div class="stat-card">
          <div>
            <p class="stat-label">Active Category</p>
            <h2 class="stat-value">3 Category</h2>
          </div>
          <i class="fa-solid fa-tags stat-icon"></i>
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
                <td class="product-code">LPT-ROG10</td>
                <td><img src="{{ asset('images/zeyprus_black_edition.png') }}" alt="Product" class="product-img"></td>
                <td class="product-name">ASUS ROG Zephyrus G14 Black Edition</td>
                <td>Laptop</td>
                <td class="desc-text">AMD Ryzen 9 | RTX 4060 8GB | RAM 16GB DDR5 | SSD 1TB NVMe | 14" QHD+ 165Hz | Win 11 + OHS</td>
                <td>Rp 21.500.000</td>
                <td>Rp 24.500.000</td>
                <td>12</td>
                <td><span class="badge-available">Available</span></td>
                <td>2026-09-18 01:15:47</td>
                <td><button type="button" class="btn-action open-edit-modal-btn"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="product-code">LPT-ROG10</td>
                <td><img src="{{ asset('images/iphone_17_pro_silver.png') }}" alt="Product" class="product-img"></td>
                <td class="product-name">Iphone 17 Pro Silver</td>
                <td>Laptop</td>
                <td class="desc-text">Apple A18 Pro (3nm) | RAM 8GB | Storage 256GB | 6.3" OLED 120Hz ProMotion | Triple 48MP Pro Cam | Titanium Silver | USB-C 3.2</td>
                <td>Rp 21.500.000</td>
                <td>Rp 24.500.000</td>
                <td>12</td>
                <td><span class="badge-out-stock">Out of stock</span></td>
                <td>2026-09-18 01:15:47</td>
                <td><button type="button" class="btn-action open-edit-modal-btn"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="product-code">LPT-ROG10</td>
                <td><img src="{{ asset('images/asus_rog_gaming_a15.png') }}" alt="Product" class="product-img"></td>
                <td class="product-name">ASUS ROG GAMING A15</td>
                <td>Laptop</td>
                <td class="desc-text">AMD Ryzen 9 | RTX 4060 8GB | RAM 16GB DDR5 | SSD 1TB NVMe | 14" QHD+ 165Hz | Win 11 + OHS</td>
                <td>Rp 21.500.000</td>
                <td>Rp 24.500.000</td>
                <td>12</td>
                <td><span class="badge-out-stock">Out of stock</span></td>
                <td>2026-09-18 01:15:47</td>
                <td><button type="button" class="btn-action open-edit-modal-btn"><i class="fa-solid fa-ellipsis"></i></button></td>
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

  <div class="modal-overlay" id="productModal">
    <div class="modal-card">
      <h2 class="modal-title">Add New Product</h2>
      <form>
        <div class="form-grid-2">
          <div class="form-group">
            <label>Product Name</label>
            <input type="text" placeholder="Enter receipt number" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Product Code</label>
            <input type="text" placeholder="Enter product code" class="form-control" required>
          </div>
        </div>

        <div class="form-grid-2">
          <div class="form-group">
            <label>Category</label>
            <select class="form-control">
              <option>Select Transaction Type</option>
              <option>Laptop</option>
              <option>Smartphone</option>
            </select>
          </div>
          <div class="form-group">
            <label>Stock Amount</label>
            <input type="number" value="0" class="form-control" required>
          </div>
        </div>

        <div class="form-grid-2">
          <div class="form-group">
            <label>Buy Price</label>
            <input type="text" placeholder="Rp 0" class="form-control" required>
          </div>
          <div class="form-group">
            <label>Sell Price</label>
            <input type="text" placeholder="Rp 0" class="form-control" required>
          </div>
        </div>

        <div class="form-group">
          <label>Buy Price</label>
          <input type="text" placeholder="Rp 0" class="form-control">
        </div>

        <div class="form-group">
          <label>Shipping Address</label>
          <textarea placeholder="Enter shipping address" class="form-control"></textarea>
        </div>

        <div class="items-box">
          <div class="items-header">
            <label>Items</label>
            <button type="button" class="btn-add-item">+ Add Item</button>
          </div>
          <div class="item-row">
            <span>1x Input item name or code</span>
            <div class="item-actions">
              <span>Rp 0</span>
              <button type="button" class="btn-icon-item"><i class="fa-regular fa-pen-to-square"></i></button>
              <button type="button" class="btn-icon-item delete"><i class="fa-regular fa-trash-can"></i></button>
            </div>
          </div>
        </div>

        <div class="modal-actions">
          <button type="button" class="btn-modal btn-cancel" id="closeProductModalBtn">Cancel</button>
          <button type="button" class="btn-modal btn-delete-modal">Delete</button>
          <button type="submit" class="btn-modal btn-save-modal">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const modal = document.getElementById('productModal');
      const openBtn = document.getElementById('openAddProductModalBtn');
      const closeBtn = document.getElementById('closeProductModalBtn');
      const editBtns = document.querySelectorAll('.open-edit-modal-btn');

      if (openBtn && modal) {
        openBtn.addEventListener('click', function () {
          modal.classList.add('active');
        });
      }

      if (closeBtn && modal) {
        closeBtn.addEventListener('click', function () {
          modal.classList.remove('active');
        });
      }

      editBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
          if (modal) modal.classList.add('active');
        });
      });

      window.addEventListener('click', function (e) {
        if (e.target === modal) modal.classList.remove('active');
      });
    });
  </script>

</body>
</html>