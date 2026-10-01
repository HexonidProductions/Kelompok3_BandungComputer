<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Transactions - Bandung Computer Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="{{ asset('css/transactions.css') }}">
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
        <a href="{{ url('/transactions') }}" class="menu-item active">
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
        <h1>Transactions</h1>
      </header>

      <div class="filter-bar">
        <div class="filter-left">
          <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search Invoice code or customer" class="search-input">
          </div>
          <select class="category-select">
            <option value="all">Category: All</option>
            <option value="laptop">Laptop</option>
            <option value="smartphone">Smartphone</option>
          </select>
        </div>

        <button class="btn-add" id="openModalBtn">
          <i class="fa-solid fa-plus"></i>
          <span>Add Transaction</span>
        </button>
      </div>

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
            <p class="stat-label">Average Transaction</p>
            <h3 class="stat-value">Rp 24.500.000</h3>
          </div>
          <div class="stat-icon">
            <i class="fa-solid fa-chart-simple"></i>
          </div>
        </div>
      </section>

      <section class="table-card">
        <h2 class="table-title">Transaction List</h2>

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
                <td class="receipt-no">INV-2602-004</td>
                <td>Offline</td>
                <td>Alif Hassan Abdillah</td>
                <td>Muhammad Aditya Nugroho</td>
                <td class="address-text">
                  Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70714
                </td>
                <td>2026-09-18 01:15:47</td>
                <td>Rp 24.500.000</td>
                <td>Bank Transfer</td>
                <td>Rp 15.000</td>
                <td><span class="badge-paid">Paid</span></td>
                <td><button class="btn-action open-edit-modal"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>

              <tr>
                <td class="receipt-no">INV-2602-004</td>
                <td>Offline</td>
                <td>Muhammad Cnada Indra Sulu</td>
                <td>Muhammad Arfa Hafizy</td>
                <td class="address-text">
                  Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70714
                </td>
                <td>2026-09-18 01:15:47</td>
                <td>Rp 24.500.000</td>
                <td>Bank Transfer</td>
                <td>Rp 15.000</td>
                <td><span class="badge-paid">Paid</span></td>
                <td><button class="btn-action open-edit-modal"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>

              <tr>
                <td class="receipt-no">INV-2602-004</td>
                <td>Offline</td>
                <td>Ahmad Raditya Putra</td>
                <td>Muhammad Nabil Abhitah Abyasya</td>
                <td class="address-text">
                  Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70714
                </td>
                <td>2026-09-18 01:15:47</td>
                <td>Rp 24.500.000</td>
                <td>Bank Transfer</td>
                <td>Rp 15.000</td>
                <td><span class="badge-paid">Paid</span></td>
                <td><button class="btn-action open-edit-modal"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="table-footer">
          <p>Showing 1-2 out of 10 Transactions</p>
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

  <!-- Modal Popup Add / Edit Transaction -->
  <div class="modal-overlay" id="transactionModal">
    <div class="modal-card">
      <h2 class="modal-title">Transaction #INV-0001-0001</h2>
      
      <form>
        <div class="form-grid">
          <div class="form-group">
            <label>Receipt Number</label>
            <input type="text" value="INV-0001-0001" class="form-control">
          </div>

          <div class="form-group">
            <label>Type</label>
            <input type="text" value="Offline" class="form-control">
          </div>

          <div class="form-group">
            <label>Cashier</label>
            <input type="text" value="Fransisco Sitorus" class="form-control">
          </div>

          <div class="form-group">
            <label>Customer</label>
            <input type="text" value="Muhammad Aditya Nugroho" class="form-control">
          </div>

          <div class="form-group">
            <label>Payment Method</label>
            <select class="form-control">
              <option value="bank">Bank Transfer</option>
              <option value="cash">Cash</option>
            </select>
          </div>

          <div class="form-group">
            <label>Payment Status</label>
            <select class="form-control">
              <option value="paid">Paid</option>
              <option value="pending">Pending</option>
            </select>
          </div>

          <div class="form-group">
            <label>Shipping Fee</label>
            <input type="text" value="Rp 0" class="form-control">
          </div>

          <div class="form-group">
            <label>Total Amount</label>
            <input type="text" value="Rp 123.500.000" class="form-control">
          </div>

          <div class="form-group full-width">
            <label>Shipping Address</label>
            <textarea class="form-control">Kompleks Antero Pondok Raya 2, Jalan Pondok Bambu No.35, RT.19/RW.8, Loktabat Utara BANJARBARU UTARA, KOTA BANJARBARU, Kalimantan Selatan, ID 70714</textarea>
          </div>
        </div>

        <div class="items-section">
          <div class="items-header">
            <span class="items-title">Items</span>
            <button type="button" class="btn-add-item"><i class="fa-solid fa-plus"></i> Add Item</button>
          </div>

          <div class="items-list">
            <div class="item-row">
              <div class="item-info">
                <span>1x</span>
                <span>ASUS ROG Zephyrus G14 Black Edition</span>
              </div>
              <div class="item-price-actions">
                <span class="item-price">Rp 24.500.000</span>
                <button type="button" class="btn-icon edit"><i class="fa-regular fa-pen-to-square"></i></button>
                <button type="button" class="btn-icon delete"><i class="fa-regular fa-trash-can"></i></button>
              </div>
            </div>

            <div class="item-row">
              <div class="item-info">
                <span>1x</span>
                <span>ASUS ROG Zephyrus G14 Black Edition</span>
              </div>
              <div class="item-price-actions">
                <span class="item-price">Rp 24.500.000</span>
                <button type="button" class="btn-icon edit"><i class="fa-regular fa-pen-to-square"></i></button>
                <button type="button" class="btn-icon delete"><i class="fa-regular fa-trash-can"></i></button>
              </div>
            </div>

            <div class="item-row">
              <div class="item-info">
                <span>1x</span>
                <span>ASUS ROG Zephyrus G14 Black Edition</span>
              </div>
              <div class="item-price-actions">
                <span class="item-price">Rp 24.500.000</span>
                <button type="button" class="btn-icon edit"><i class="fa-regular fa-pen-to-square"></i></button>
                <button type="button" class="btn-icon delete"><i class="fa-regular fa-trash-can"></i></button>
              </div>
            </div>
          </div>
        </div>

        <div class="modal-actions">
          <button type="button" class="btn-modal btn-cancel" id="closeModalBtn">Cancel</button>
          <button type="button" class="btn-modal btn-delete-modal">Delete</button>
          <button type="submit" class="btn-modal btn-save-modal">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    const modal = document.getElementById('transactionModal');
    const openBtn = document.getElementById('openModalBtn');
    const closeBtn = document.getElementById('closeModalBtn');
    const editBtns = document.querySelectorAll('.open-edit-modal');

    openBtn.addEventListener('click', () => {
      modal.classList.add('active');
    });

    closeBtn.addEventListener('click', () => {
      modal.classList.remove('active');
    });

    editBtns.forEach(btn => {
      btn.addEventListener('click', () => {
        modal.classList.add('active');
      });
    });

    modal.addEventListener('click', (e) => {
      if (e.target === modal) {
        modal.classList.remove('active');
      }
    });
  </script>

</body>
</html>