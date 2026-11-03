<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Users - Bandung Computer Admin</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link rel="stylesheet" href="<?php echo e(asset('css/users.css')); ?>">
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
        <a href="<?php echo e(url('/users')); ?>" class="menu-item active">
          <i class="fa-solid fa-users"></i>
          <span>Users</span>
        </a>
       <a href="<?php echo e(url('/suppliers')); ?>" class="menu-item">
  <i class="fa-solid fa-truck"></i>
  <span>Suppliers</span>
</a>
        <a href="<?php echo e(url('/daily-closing')); ?>" class="menu-item">
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
        <h1>Users</h1>
      </header>

      <div class="filter-bar">
        <div class="filter-left">
          <div class="search-box">
            <i class="fa-solid fa-magnifying-glass"></i>
            <input type="text" placeholder="Search username" class="search-input">
          </div>
          <select class="category-select">
            <option value="all">Category: All</option>
            <option value="admin">Admin</option>
            <option value="cashier">Cashier</option>
            <option value="customer">Customer</option>
          </select>
        </div>

        <a href="#" class="btn-add">
          <i class="fa-solid fa-plus"></i>
          <span>Add User</span>
        </a>
      </div>

      <section class="table-card">
        <h2 class="table-title">User List</h2>

        <div class="table-responsive">
          <table>
            <thead>
              <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Phone Number</th>
                <th>Address</th>
                <th>Role</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td class="user-name">Muhammad Aditya Nugroho</td>
                <td class="email-col">muhammadadityanugroho@gmail.com</td>
                <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYIJ1T4NOsBg8TULcE0NI.</td>
                <td>082344231039</td>
                <td>Jl. Merdeka 1</td>
                <td>Customer</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="user-name">Muhammad Zidan</td>
                <td class="email-col">muhammadzidan@gmail.com</td>
                <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYIJ1T4NOsBg8TULcE0NI.</td>
                <td>082654231039</td>
                <td>Jl. Merdeka 1</td>
                <td>Cashier</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="user-name">Alif Hassan Abdillah</td>
                <td class="email-col">alifhassanabdillah@gmail.com</td>
                <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYIJ1T4NOsBg8TULcE0NI.</td>
                <td>082122722134</td>
                <td>Jl. Karang Anyar 2</td>
                <td>Admin</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="user-name">Muhammad Zaidan Rafif Khalid</td>
                <td class="email-col">alifhassanabdillah@gmail.com</td>
                <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYIJ1T4NOsBg8TULcE0NI.</td>
                <td>082122722134</td>
                <td>Jl. Karang Anyar 2</td>
                <td>Admin</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="user-name">Muhammad Zaidan Rafif Khalid</td>
                <td class="email-col">alifhassanabdillah@gmail.com</td>
                <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYIJ1T4NOsBg8TULcE0NI.</td>
                <td>082122722134</td>
                <td>Jl. Karang Anyar 2</td>
                <td>Admin</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="user-name">Muhammad Zaidan Rafif Khalid</td>
                <td class="email-col">alifhassanabdillah@gmail.com</td>
                <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYIJ1T4NOsBg8TULcE0NI.</td>
                <td>082122722134</td>
                <td>Jl. Karang Anyar 2</td>
                <td>Admin</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="user-name">Muhammad Zaidan Rafif Khalid</td>
                <td class="email-col">alifhassanabdillah@gmail.com</td>
                <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYIJ1T4NOsBg8TULcE0NI.</td>
                <td>082122722134</td>
                <td>Jl. Karang Anyar 2</td>
                <td>Admin</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="user-name">Muhammad Zaidan Rafif Khalid</td>
                <td class="email-col">alifhassanabdillah@gmail.com</td>
                <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYIJ1T4NOsBg8TULcE0NI.</td>
                <td>082122722134</td>
                <td>Jl. Karang Anyar 2</td>
                <td>Admin</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="user-name">Muhammad Zaidan Rafif Khalid</td>
                <td class="email-col">alifhassanabdillah@gmail.com</td>
                <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYIJ1T4NOsBg8TULcE0NI.</td>
                <td>082122722134</td>
                <td>Jl. Karang Anyar 2</td>
                <td>Admin</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="user-name">Muhammad Zaidan Rafif Khalid</td>
                <td class="email-col">alifhassanabdillah@gmail.com</td>
                <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYIJ1T4NOsBg8TULcE0NI.</td>
                <td>082122722134</td>
                <td>Jl. Karang Anyar 2</td>
                <td>Admin</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
              <tr>
                <td class="user-name">Muhammad Zaidan Rafif Khalid</td>
                <td class="email-col">alifhassanabdillah@gmail.com</td>
                <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYIJ1T4NOsBg8TULcE0NI.</td>
                <td>082122722134</td>
                <td>Jl. Karang Anyar 2</td>
                <td>Admin</td>
                <td><button class="btn-action"><i class="fa-solid fa-ellipsis"></i></button></td>
              </tr>
            </tbody>
          </table>
        </div>

        <div class="table-footer">
          <p>Showing 1-1 out of 4 Users</p>
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
</html><?php /**PATH C:\Users\ADVAN\Kelompok3_BandungComputer\resources\views/users.blade.php ENDPATH**/ ?>