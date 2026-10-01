<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category - Bandung Computer Admin</title>
  
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  
  <!-- File CSS Terpisah -->
  <link rel="stylesheet" href="{{ asset('css/categories.css') }}">
</head>
<body>

  <div class="dashboard-container">
    
    <!-- Sidebar -->
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

    <!-- Main Content -->
    <main class="main-content">
      <header class="content-header">
        <h1>Category</h1>
      </header>

      <!-- Action Bar (Search & Add Button) -->
      <div class="action-bar">
        <div class="search-box">
          <i class="fa-solid fa-magnifying-glass"></i>
          <input type="text" placeholder="Search category" class="search-input">
        </div>

        <a href="#" class="btn-add">
          <i class="fa-solid fa-plus"></i>
          <span>Add Category</span>
        </a>
      </div>

      <!-- Table Category List -->
      <section class="table-card">
        <h2 class="table-title">Category List</h2>

        <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>No.</th>
                <th>Category</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="no-col">1</td>
                <td class="category-col">Laptop</td>
                <td class="action-col">
                  <button class="btn-icon edit" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                  <button class="btn-icon delete" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
                </td>
              </tr>
              <tr>
                <td class="no-col">2</td>
                <td class="category-col">Smartphone</td>
                <td class="action-col">
                  <button class="btn-icon edit" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                  <button class="btn-icon delete" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
                </td>
              </tr>
              <tr>
                <td class="no-col">3</td>
                <td class="category-col">TWS</td>
                <td class="action-col">
                  <button class="btn-icon edit" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                  <button class="btn-icon delete" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
                </td>
              </tr>
              <tr>
                <td class="no-col">4</td>
                <td class="category-col">Headset</td>
                <td class="action-col">
                  <button class="btn-icon edit" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                  <button class="btn-icon delete" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
                </td>
              </tr>
              <tr>
                <td class="no-col">5</td>
                <td class="category-col">Printer</td>
                <td class="action-col">
                  <button class="btn-icon edit" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                  <button class="btn-icon delete" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
                </td>
              </tr>
              <tr>
                <td class="no-col">6</td>
                <td class="category-col">Mouse</td>
                <td class="action-col">
                  <button class="btn-icon edit" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                  <button class="btn-icon delete" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
                </td>
              </tr>
              <tr>
                <td class="no-col">7</td>
                <td class="category-col">Keyboard</td>
                <td class="action-col">
                  <button class="btn-icon edit" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                  <button class="btn-icon delete" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
                </td>
              </tr>
              <tr>
                <td class="no-col">8</td>
                <td class="category-col">Cable</td>
                <td class="action-col">
                  <button class="btn-icon edit" title="Edit"><i class="fa-regular fa-pen-to-square"></i></button>
                  <button class="btn-icon delete" title="Delete"><i class="fa-regular fa-trash-can"></i></button>
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

</body>
</html>