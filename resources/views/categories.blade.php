<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category - Bandung Computer Admin</title>
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

    .filter-bar {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 24px;
      width: 100%;
    }

    .search-box {
      position: relative;
      width: 320px;
    }

    .search-box i {
      position: absolute;
      left: 14px;
      top: 50%;
      transform: translateY(-50%);
      color: #64748b;
      font-size: 14px;
    }

    .search-input {
      width: 100%;
      padding: 10px 14px 10px 38px;
      border: 1px solid #e2e8f0;
      border-radius: 8px;
      font-size: 13px;
      background-color: #ffffff;
      outline: none;
    }

    .btn-add {
      display: inline-flex;
      align-items: center;
      gap: 8px;
      background-color: #2563eb;
      color: #ffffff;
      padding: 10px 18px;
      border: none;
      border-radius: 8px;
      font-size: 13px;
      font-weight: 600;
      cursor: pointer;
      transition: background-color 0.2s;
    }

    .btn-add:hover {
      background-color: #1d4ed8;
    }

    .table-card {
      background-color: #ffffff;
      border-radius: 12px;
      padding: 24px;
      box-shadow: 0 2px 6px rgba(0, 0, 0, 0.02);
      border: 1px solid #e2e8f0;
    }

    .table-title {
      font-size: 15px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 20px;
    }

    .table-responsive {
      width: 100%;
      overflow-x: auto;
    }

    table {
      width: 100%;
      border-collapse: collapse;
      text-align: left;
      font-size: 12px;
    }

    th {
      background-color: #e2e8f0;
      padding: 12px 14px;
      color: #334155;
      font-weight: 700;
      font-size: 12px;
    }

    th:first-child {
      border-top-left-radius: 6px;
      border-bottom-left-radius: 6px;
      width: 80px;
    }

    th:last-child {
      border-top-right-radius: 6px;
      border-bottom-right-radius: 6px;
      width: 100px;
      text-align: right;
      padding-right: 20px;
    }

    td {
      padding: 14px;
      color: #1e293b;
      border-bottom: 1px solid #f1f5f9;
      vertical-align: middle;
    }

    .category-name {
      font-weight: 600;
    }

    .action-col {
      text-align: right;
      padding-right: 20px;
    }

    .action-buttons {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    .btn-icon-edit {
      background: none;
      border: none;
      color: #475569;
      cursor: pointer;
      font-size: 14px;
    }

    .btn-icon-delete {
      background: none;
      border: none;
      color: #ef4444;
      cursor: pointer;
      font-size: 14px;
    }

    .table-footer {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-top: 24px;
      font-size: 12px;
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
      background-color: #2563eb;
      color: #ffffff;
      border-color: #2563eb;
    }

    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100vw;
      height: 100vh;
      background-color: rgba(0, 0, 0, 0.4);
      display: flex;
      justify-content: center;
      align-items: center;
      z-index: 99999;
      opacity: 0;
      visibility: hidden;
      transition: all 0.2s ease-in-out;
    }

    .modal-overlay.active {
      opacity: 1;
      visibility: visible;
    }

    .modal-card {
      background-color: #ffffff;
      width: 440px;
      max-width: 90%;
      border-radius: 12px;
      padding: 24px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.15);
    }

    .modal-title {
      font-size: 15px;
      font-weight: 700;
      color: #0f172a;
      margin-bottom: 16px;
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-control {
      width: 100%;
      padding: 10px 14px;
      border: 1px solid #e2e8f0;
      border-radius: 6px;
      font-size: 12px;
      color: #0f172a;
      background-color: #ffffff;
      outline: none;
    }

    .form-control:focus {
      border-color: #2563eb;
    }

    .modal-actions {
      display: flex;
      justify-content: flex-end;
      gap: 10px;
    }

    .btn-modal {
      padding: 8px 18px;
      border-radius: 6px;
      font-size: 12px;
      font-weight: 600;
      cursor: pointer;
      border: none;
    }

    .btn-cancel {
      background-color: #ffffff;
      border: 1px solid #e2e8f0;
      color: #475569;
    }

    .btn-save-modal {
      background-color: #2563eb;
      color: #ffffff;
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
        <a href="{{ url('/overview') }}" class="menu-item">
          <i class="fa-solid fa-border-all"></i>
          <span>Overview</span>
        </a>
        <a href="{{ url('/categories') }}" class="menu-item active">
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
        <h1>Category</h1>
      </header>

      <div class="filter-bar">
        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Search category" class="search-input">
        </div>

        <button type="button" class="btn-add" id="openAddCategoryModalBtn">
          <i class="fa-solid fa-plus"></i>
          <span>Add Category</span>
        </button>
      </div>

      <section class="table-card">
        <h2 class="table-title">Category List</h2>

        <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>No.</th>
                <th>Category</th>
                <th class="action-col">Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>1</td>
                <td class="category-name">Laptop</td>
                <td class="action-col">
                  <div class="action-buttons">
                    <button type="button" class="btn-icon-edit open-edit-category-modal" data-category="Laptop"><i class="fa-regular fa-pen-to-square"></i></button>
                    <button type="button" class="btn-icon-delete"><i class="fa-regular fa-trash-can"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>2</td>
                <td class="category-name">Smartphone</td>
                <td class="action-col">
                  <div class="action-buttons">
                    <button type="button" class="btn-icon-edit open-edit-category-modal" data-category="Smartphone"><i class="fa-regular fa-pen-to-square"></i></button>
                    <button type="button" class="btn-icon-delete"><i class="fa-regular fa-trash-can"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>3</td>
                <td class="category-name">TWS</td>
                <td class="action-col">
                  <div class="action-buttons">
                    <button type="button" class="btn-icon-edit open-edit-category-modal" data-category="TWS"><i class="fa-regular fa-pen-to-square"></i></button>
                    <button type="button" class="btn-icon-delete"><i class="fa-regular fa-trash-can"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>4</td>
                <td class="category-name">Headset</td>
                <td class="action-col">
                  <div class="action-buttons">
                    <button type="button" class="btn-icon-edit open-edit-category-modal" data-category="Headset"><i class="fa-regular fa-pen-to-square"></i></button>
                    <button type="button" class="btn-icon-delete"><i class="fa-regular fa-trash-can"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>5</td>
                <td class="category-name">Printer</td>
                <td class="action-col">
                  <div class="action-buttons">
                    <button type="button" class="btn-icon-edit open-edit-category-modal" data-category="Printer"><i class="fa-regular fa-pen-to-square"></i></button>
                    <button type="button" class="btn-icon-delete"><i class="fa-regular fa-trash-can"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>6</td>
                <td class="category-name">Mouse</td>
                <td class="action-col">
                  <div class="action-buttons">
                    <button type="button" class="btn-icon-edit open-edit-category-modal" data-category="Mouse"><i class="fa-regular fa-pen-to-square"></i></button>
                    <button type="button" class="btn-icon-delete"><i class="fa-regular fa-trash-can"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>7</td>
                <td class="category-name">Keyboard</td>
                <td class="action-col">
                  <div class="action-buttons">
                    <button type="button" class="btn-icon-edit open-edit-category-modal" data-category="Keyboard"><i class="fa-regular fa-pen-to-square"></i></button>
                    <button type="button" class="btn-icon-delete"><i class="fa-regular fa-trash-can"></i></button>
                  </div>
                </td>
              </tr>
              <tr>
                <td>8</td>
                <td class="category-name">Cable</td>
                <td class="action-col">
                  <div class="action-buttons">
                    <button type="button" class="btn-icon-edit open-edit-category-modal" data-category="Cable"><i class="fa-regular fa-pen-to-square"></i></button>
                    <button type="button" class="btn-icon-delete"><i class="fa-regular fa-trash-can"></i></button>
                  </div>
                </td>
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

  <div class="modal-overlay" id="addCategoryModal">
    <div class="modal-card">
      <h2 class="modal-title">Add New Category</h2>
      <form>
        <div class="form-group">
          <input type="text" placeholder="Input Category Name" class="form-control" required>
        </div>
        <div class="modal-actions">
          <button type="button" class="btn-modal btn-cancel" id="closeAddCategoryModalBtn">Cancel</button>
          <button type="submit" class="btn-modal btn-save-modal">Save</button>
        </div>
      </form>
    </div>
  </div>

  <div class="modal-overlay" id="editCategoryModal">
    <div class="modal-card">
      <h2 class="modal-title">Edit Category</h2>
      <form>
        <div class="form-group">
          <input type="text" value="Laptop" id="editCategoryInput" class="form-control" required>
        </div>
        <div class="modal-actions">
          <button type="button" class="btn-modal btn-cancel" id="closeEditCategoryModalBtn">Cancel</button>
          <button type="submit" class="btn-modal btn-save-modal">Save</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const addModal = document.getElementById('addCategoryModal');
      const openAddBtn = document.getElementById('openAddCategoryModalBtn');
      const closeAddBtn = document.getElementById('closeAddCategoryModalBtn');

      const editModal = document.getElementById('editCategoryModal');
      const editInput = document.getElementById('editCategoryInput');
      const closeEditBtn = document.getElementById('closeEditCategoryModalBtn');
      const editBtns = document.querySelectorAll('.open-edit-category-modal');

      if (openAddBtn && addModal) {
        openAddBtn.addEventListener('click', function () {
          addModal.classList.add('active');
        });
      }

      if (closeAddBtn && addModal) {
        closeAddBtn.addEventListener('click', function () {
          addModal.classList.remove('active');
        });
      }

      editBtns.forEach(function (btn) {
        btn.addEventListener('click', function () {
          const catName = btn.getAttribute('data-category');
          if (editInput) editInput.value = catName;
          if (editModal) editModal.classList.add('active');
        });
      });

      if (closeEditBtn && editModal) {
        closeEditBtn.addEventListener('click', function () {
          editModal.classList.remove('active');
        });
      }

      window.addEventListener('click', function (e) {
        if (e.target === addModal) addModal.classList.remove('active');
        if (e.target === editModal) editModal.classList.remove('active');
      });
    });
  </script>

</body>
</html>