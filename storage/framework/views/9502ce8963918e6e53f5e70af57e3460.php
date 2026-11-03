<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Overview - Bandung Computer</title>

    <!-- Font Awesome Icons & Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Overview Terpisah -->
    <link rel="stylesheet" href="<?php echo e(asset('css/overview.css')); ?>">
</head>
<body>

    <div class="dashboard-container">

        <!-- Sidebar Navigation (Freeze / Fixed) -->
        <aside class="sidebar">
            <div>
                <!-- Logo -->
                <div class="logo-box">
                    <img src="<?php echo e(asset('images/logo_bc.png')); ?>" alt="Bandung Computer Logo" onerror="this.src='<?php echo e(asset('images/logo_bc_hitam.png')); ?>'">
                </div>

                <!-- Nav Menu -->
                <ul class="sidebar-menu">
                    <li><a href="<?php echo e(route('overview')); ?>" class="active"><i class="fa-solid fa-border-all"></i> Overview</a></li>
                    <li><a href="<?php echo e(route('categories')); ?>"><i class="fa-solid fa-tag"></i> Categories</a></li>
                    <li><a href="<?php echo e(route('transactions')); ?>"><i class="fa-solid fa-cart-shopping"></i> Transactions</a></li>
                    <li><a href="<?php echo e(route('products')); ?>"><i class="fa-solid fa-box"></i> Products</a></li>
                    <li><a href="<?php echo e(route('users')); ?>"><i class="fa-solid fa-users"></i> Users</a></li>
                    <li><a href="<?php echo e(route('suppliers')); ?>"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
                    <li><a href="#"><i class="fa-solid fa-clipboard-list"></i> Inventory Logs</a></li>
                    <li><a href="<?php echo e(route('daily-closing')); ?>"><i class="fa-solid fa-wrench"></i> Daily Closing</a></li>
                </ul>
            </div>

            <!-- Profile Admin & Logout -->
            <div class="sidebar-bottom">
                <div class="admin-info">
                    <div class="admin-role">Admin</div>
                    <div class="admin-name">Alif Hassan Abdillah</div>
                </div>
                <form action="<?php echo e(route('logout')); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content (Scrollable) -->
        <main class="main-content">
            <h1 class="welcome-title">Welcome back, Bandung Computer Admin</h1>

            <!-- Cards Grid -->
            <div class="stats-grid">
                <div class="card">
                    <div>
                        <div class="card-title">Total Sales This Month</div>
                        <div class="card-value">Rp 196.000.000</div>
                    </div>
                    <i class="fa-regular fa-credit-card card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Transaction Amount</div>
                        <div class="card-value">482 Transaction</div>
                    </div>
                    <i class="fa-solid fa-arrow-right-arrow-left card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Supplier Active</div>
                        <div class="card-value">15 Supplier</div>
                    </div>
                    <i class="fa-regular fa-circle-check card-icon"></i>
                </div>

                <div class="card">
                    <div>
                        <div class="card-title">Products Low On Stock</div>
                        <div class="card-value">3 Item</div>
                    </div>
                    <i class="fa-solid fa-box-open card-icon"></i>
                </div>
            </div>

            <!-- Table History -->
            <div class="table-container">
                <div class="table-header">
                    <h2 class="table-title">Last Closing Shift History</h2>
                    <a href="#" class="see-all">See All &rarr;</a>
                </div>

                <table>
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Shift</th>
                            <th>Cashier</th>
                            <th>Note</th>
                            <th>Total Income</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>24 Sep 2026</td>
                            <td>Morning Shift</td>
                            <td>Muhammad Zidan</td>
                            <td>Penutupan kasir shift 1 berjalan lancar.</td>
                            <td><strong>Rp 34.950.000</strong></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
                        <tr>
                            <td>25 Sep 2026</td>
                            <td>Night Shift</td>
                            <td>Danish</td>
                            <td>Penutupan kasir shift 2 berjalan lancar.</td>
                            <td><strong>Rp 29.350.000</strong></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
                        <tr>
                            <td>26 Sep 2026</td>
                            <td>Morning Shift</td>
                            <td>Fatih</td>
                            <td>Penutupan kasir shift 3 berjalan lancar.</td>
                            <td><strong>Rp 31.950.000</strong></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
                        <tr>
                            <td>27 Sep 2026</td>
                            <td>Night Shift</td>
                            <td>Cnada</td>
                            <td>Penutupan kasir shift 4 berjalan lancar.</td>
                            <td><strong>Rp 40.950.000</strong></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
                        <tr>
                            <td>27 Sep 2026</td>
                            <td>Night Shift</td>
                            <td>Cnada</td>
                            <td>Penutupan kasir shift 4 berjalan lancar.</td>
                            <td><strong>Rp 40.950.000</strong></td>
                            <td><i class="fa-solid fa-ellipsis"></i></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    <div>Showing 1-8 out of 25 Last Closing Shift History</div>
                    <div class="pagination">
                        <button class="page-btn">Previous</button>
                        <button class="page-btn active">1</button>
                        <button class="page-btn">2</button>
                        <button class="page-btn">Next</button>
                    </div>
                </div>
            </div>
        </main>

    </div>

</body>
</html><?php /**PATH C:\Users\ADVAN\Kelompok3_BandungComputer\resources\views/overview.blade.php ENDPATH**/ ?>