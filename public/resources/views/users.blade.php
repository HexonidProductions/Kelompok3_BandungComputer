<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Bandung Computer Admin</title>
    
    <link rel="stylesheet" href="{{ asset('css/users.css') }}?v=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="dashboard-container">
        <!-- SIDEBAR KIRI -->
        <aside class="sidebar">
            <div class="sidebar-logo">
                <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo">
            </div>

            <nav class="sidebar-menu">
                <a href="{{ route('overview') }}" class="menu-item">
                    <i class="fa-solid fa-border-all"></i>
                    <span>Overview</span>
                </a>
                <a href="{{ route('categories') }}" class="menu-item">
                    <i class="fa-solid fa-tag"></i>
                    <span>Categories</span>
                </a>
                <a href="{{ route('transactions') }}" class="menu-item">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Transactions</span>
                </a>
                <a href="{{ route('products') }}" class="menu-item">
                    <i class="fa-solid fa-box"></i>
                    <span>Products</span>
                </a>
                <a href="{{ route('users') }}" class="menu-item active">
                    <i class="fa-solid fa-users"></i>
                    <span>Users</span>
                </a>
               <a href="{{ route('suppliers') }}" class="menu-item">
    <i class="fa-solid fa-truck-field"></i>
    <span>Suppliers</span>
</a>
               <a href="{{ route('inventory.logs') }}" class="menu-item">
    <i class="fa-solid fa-receipt"></i>
    <span>Inventory Logs</span>
</a>
               <a href="{{ route('daily.closing') }}" class="menu-item">
    <i class="fa-solid fa-key"></i>
    <span>Daily Closing</span>
</a>
            </nav>

            <div class="sidebar-footer">
                <div class="admin-info">
                    <span class="role">Admin</span>
                    <strong class="name">Alif Hassan Abdillah</strong>
                </div>
                <a href="{{ url('/tes-login') }}" class="btn-logout">Logout</a>
            </div>
        </aside>

        <!-- KONTEN UTAMA USERS -->
        <main class="main-content">
            <header class="content-header">
                <h1>Users</h1>
            </header>

            <!-- SEARCH, FILTER & ADD BUTTON -->
            <div class="top-bar">
                <div class="filter-group">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass"></i>
                        <input type="text" placeholder="Search username">
                    </div>
                    <select class="select-filter">
                        <option>Role: All</option>
                        <option>Admin</option>
                        <option>Cashier</option>
                        <option>Customer</option>
                    </select>
                </div>
                
                <button type="button" class="btn-add" id="openAddUser">
                    <i class="fa-solid fa-plus"></i> Add User
                </button>
            </div>

            <!-- TABEL USER LIST -->
            <section class="table-card">
                <div class="table-header">
                    <h2>User List</h2>
                </div>

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
                                <td class="user-name-cell">Muhammad Aditya Nugroho</td>
                                <td>muhammadadityanugroho@gmail.com</td>
                                <td class="password-hash-cell">$2y$12$89aJSmMrlbaXAKlvkndyyurYiJ1T4NOsBg8TULcE0Nl.</td>
                                <td>082344231039</td>
                                <td>Jl. Merdeka 1</td>
                                <td>Customer</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('Muhammad Aditya Nugroho', 'muhammadadityanugroho@gmail.com', '082344231039', 'Customer', 'Jl. Merdeka 1')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td class="user-name-cell">Muhammad Zidan</td>
                                <td>muhammadzidan@gmail.com</td>
                                <td class="password-hash-cell">$2y$12$89aJSmMrlbaXAKlvkndyyurYiJ1T4NOsBg8TULcE0Nl.</td>
                                <td>082654231039</td>
                                <td>Jl. Merdeka 1</td>
                                <td>Cashier</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('Muhammad Zidan', 'muhammadzidan@gmail.com', '082654231039', 'Cashier', 'Jl. Merdeka 1')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td class="user-name-cell">Alif Hassan Abdillah</td>
                                <td>alifhassanabdillah@gmail.com</td>
                                <td class="password-hash-cell">$2y$12$89aJSmMrlbaXAKlvkndyyurYiJ1T4NOsBg8TULcE0Nl.</td>
                                <td>082122722134</td>
                                <td>Jl. Karang Anyar 2</td>
                                <td>Admin</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('Alif Hassan Abdillah', 'alifhassanabdillah@gmail.com', '082122722134', 'Admin', 'Jl. Karang Anyar 2')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                            <tr>
                                <td class="user-name-cell">Muhammad Zaidan Rafif Khalid</td>
                                <td>alifhassanabdillah@gmail.com</td>
                                <td class="password-hash-cell">$2y$12$89aJSmMrlbaXAKlvkndyyurYiJ1T4NOsBg8TULcE0Nl.</td>
                                <td>082122722134</td>
                                <td>Jl. Karang Anyar 2</td>
                                <td>Admin</td>
                                <td><button type="button" class="btn-dots" onclick="openEditModal('Muhammad Zaidan Rafif Khalid', 'alifhassanabdillah@gmail.com', '082122722134', 'Admin', 'Jl. Karang Anyar 2')"><i class="fa-solid fa-ellipsis"></i></button></td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="table-footer">
                    <span>Showing 1-1 out of 4 Users</span>
                    <div class="pagination">
                        <button class="btn-page">Previous</button>
                        <button class="btn-page active">1</button>
                        <button class="btn-page">2</button>
                        <button class="btn-page">Next</button>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <!-- POPUP MODAL ADD NEW USER -->
    <div class="modal-overlay" id="addModal">
        <div class="modal-card-lg">
            <h3>Add New User</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Username</label>
                        <input type="text" placeholder="Enter username">
                    </div>
                    <div class="form-group-modal">
                        <label>Email</label>
                        <input type="email" placeholder="Enter email">
                    </div>
                    <div class="form-group-modal">
                        <label>Password</label>
                        <input type="password" placeholder="Enter password">
                    </div>
                    <div class="form-group-modal">
                        <label>Phone Number</label>
                        <input type="text" placeholder="Enter phone number">
                    </div>
                </div>

                <div class="form-group-modal" style="margin-bottom: 14px;">
                    <label>Role</label>
                    <select><option>Select user role</option><option>Admin</option><option>Cashier</option><option>Customer</option></select>
                </div>

                <div class="form-group-modal">
                    <label>Address</label>
                    <textarea placeholder="Enter address"></textarea>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-cancel-modal" id="closeAddModal">Cancel</button>
                    <button type="button" class="btn-delete-modal">Delete</button>
                    <button type="button" class="btn-save-modal" id="saveAddModal">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- POPUP MODAL EDIT USER DETAILS -->
    <div class="modal-overlay" id="editModal">
        <div class="modal-card-lg">
            <h3>Edit User Details</h3>
            <form action="#" method="POST" onsubmit="return false;">
                <div class="form-grid-2">
                    <div class="form-group-modal">
                        <label>Username</label>
                        <input type="text" id="editUsername" placeholder="Enter username">
                    </div>
                    <div class="form-group-modal">
                        <label>Email</label>
                        <input type="email" id="editEmail" placeholder="Enter email">
                    </div>
                    <div class="form-group-modal">
                        <label>Password</label>
                        <input type="password" id="editPassword" placeholder="Enter password">
                    </div>
                    <div class="form-group-modal">
                        <label>Phone Number</label>
                        <input type="text" id="editPhone" placeholder="Enter phone number">
                    </div>
                </div>

                <div class="form-group-modal" style="margin-bottom: 14px;">
                    <label>Role</label>
                    <select id="editRole">
                        <option>Offline</option>
                        <option>Admin</option>
                        <option>Cashier</option>
                        <option>Customer</option>
                    </select>
                </div>

                <div class="form-group-modal">
                    <label>Address</label>
                    <textarea id="editAddress" placeholder="Enter address"></textarea>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-cancel-modal" id="closeEditModal">Cancel</button>
                    <button type="button" class="btn-delete-modal">Delete</button>
                    <button type="button" class="btn-save-modal" id="saveEditModal">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- SCRIPT JAVASCRIPT POPUP MODAL -->
    <script>
        const addModal = document.getElementById('addModal');
        const editModal = document.getElementById('editModal');
        const openAddBtn = document.getElementById('openAddUser');
        const closeAddBtn = document.getElementById('closeAddModal');
        const closeEditBtn = document.getElementById('closeEditModal');
        const saveAddBtn = document.getElementById('saveAddModal');
        const saveEditBtn = document.getElementById('saveEditModal');

        openAddBtn.addEventListener('click', () => addModal.classList.add('active'));
        closeAddBtn.addEventListener('click', () => addModal.classList.remove('active'));
        saveAddBtn.addEventListener('click', () => addModal.classList.remove('active'));

        function openEditModal(username, email, phone, role, address) {
            document.getElementById('editUsername').value = username;
            document.getElementById('editEmail').value = email;
            document.getElementById('editPhone').value = phone;
            document.getElementById('editRole').value = role;
            document.getElementById('editAddress').value = address;
            editModal.classList.add('active');
        }

        closeEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
        saveEditBtn.addEventListener('click', () => editModal.classList.remove('active'));
    </script>

</body>
</html>