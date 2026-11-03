<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users - Bandung Computer</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Users -->
    <link rel="stylesheet" href="{{ asset('css/users.css') }}">
</head>
<body>

    <div class="dashboard-container">

        <!-- Sidebar Navigation Freeze -->
        <aside class="sidebar">
            <div>
                <div class="logo-box">
                    <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo" onerror="this.src='{{ asset('images/logo_bc_hitam.png') }}'">
                </div>

                <ul class="sidebar-menu">
                    <li><a href="{{ route('overview') }}"><i class="fa-solid fa-border-all"></i> Overview</a></li>
                    <li><a href="{{ route('categories') }}"><i class="fa-solid fa-tag"></i> Categories</a></li>
                    <li><a href="{{ route('transactions') }}"><i class="fa-solid fa-cart-shopping"></i> Transactions</a></li>
                    <li><a href="{{ route('products') }}"><i class="fa-solid fa-box"></i> Products</a></li>
                    <li><a href="{{ route('users') }}" class="active"><i class="fa-solid fa-users"></i> Users</a></li>
                    <li><a href="{{ route('suppliers') }}"><i class="fa-solid fa-truck"></i> Suppliers</a></li>
                    <li><a href="{{ route('inventory-logs') }}"><i class="fa-solid fa-clipboard-list"></i> Inventory Logs</a></li>
                    <li><a href="{{ route('daily-closing') }}"><i class="fa-solid fa-wrench"></i> Daily Closing</a></li>
                </ul>
            </div>

            <div class="sidebar-bottom">
                <div class="admin-info">
                    <div class="admin-role">Admin</div>
                    <div class="admin-name">Alif Hassan Abdillah</div>
                </div>
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-logout">Logout</button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <h1 class="page-title">Users</h1>

            <!-- Search & Filter Actions -->
            <div class="top-actions">
                <div class="left-filters">
                    <div class="search-box">
                        <i class="fa-solid fa-magnifying-glass search-icon"></i>
                        <input type="text" id="searchInput" placeholder="Search username" onkeyup="filterTable()">
                    </div>

                    <select id="roleFilter" class="filter-select" onchange="filterTable()">
                        <option value="All">Role: All</option>
                        <option value="Admin">Admin</option>
                        <option value="Cashier">Cashier</option>
                        <option value="Customer">Customer</option>
                    </select>
                </div>

                <button class="btn-add" onclick="openAddModal()">
                    <i class="fa-solid fa-plus"></i> Add User
                </button>
            </div>

            <!-- Table Card -->
            <div class="card-table">
                <h2 class="card-table-title">User List</h2>

                <table id="userTable">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Phone Number</th>
                            <th>Address</th>
                            <th>Role</th>
                            <th style="text-align: center;">Action</th>
                        </tr>
                    </thead>
                    <tbody id="userBody">
                        <tr>
                            <td><strong>Muhammad Aditya Nugroho</strong></td>
                            <td>muhammadadityanugroho@gmail.com</td>
                            <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYiJ1T4NOsBg8TULcE0NI.</td>
                            <td>082344231039</td>
                            <td>Jl. Merdeka 1</td>
                            <td>Customer</td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td><strong>Muhammad Zidan</strong></td>
                            <td>muhammadzidan@gmail.com</td>
                            <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYiJ1T4NOsBg8TULcE0NI.</td>
                            <td>082654231039</td>
                            <td>Jl. Merdeka 1</td>
                            <td>Cashier</td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td><strong>Alif Hassan Abdillah</strong></td>
                            <td>alifhassanabdillah@gmail.com</td>
                            <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYiJ1T4NOsBg8TULcE0NI.</td>
                            <td>082122722134</td>
                            <td>Jl. Karang Anyar 2</td>
                            <td>Admin</td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                        <tr>
                            <td><strong>Muhammad Zaidan Rafif Khalid</strong></td>
                            <td>alifhassanabdillah@gmail.com</td>
                            <td class="password-hash">$2y$12$89aJSmMrlbaXAKlvkndyyurYiJ1T4NOsBg8TULcE0NI.</td>
                            <td>082122722134</td>
                            <td>Jl. Karang Anyar 2</td>
                            <td>Admin</td>
                            <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                        </tr>
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    <div id="userCountText">Showing 1-4 out of 4 Users</div>
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

    <!-- Modal Dynamic Form User (Add & Edit) -->
    <div class="modal-overlay" id="userModal">
        <div class="modal-box-lg">
            <h3 class="modal-title" id="modalTitle">Add New User</h3>
            
            <form id="userForm">
                <div class="form-grid-2">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" id="usernameInput" class="form-control" placeholder="Enter username" required>
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" id="emailInput" class="form-control" placeholder="Enter email" required>
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" id="passwordInput" class="form-control" placeholder="Enter password" required>
                    </div>
                    <div class="form-group">
                        <label>Phone Number</label>
                        <input type="text" id="phoneInput" class="form-control" placeholder="Enter phone number" required>
                    </div>
                </div>

                <div class="form-group">
                    <label>Role</label>
                    <select id="roleInput" class="form-control">
                        <option value="" disabled selected>Select user role</option>
                        <option value="Admin">Admin</option>
                        <option value="Cashier">Cashier</option>
                        <option value="Customer">Customer</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Address</label>
                    <textarea id="addressInput" class="form-control" placeholder="Enter address" required></textarea>
                </div>

                <div class="modal-actions-3">
                    <button type="button" class="btn-modal-cancel" onclick="closeModal()">Cancel</button>
                    <button type="button" class="btn-modal-delete" id="btnDelete" onclick="deleteUser()" style="display: none;">Delete</button>
                    <button type="submit" class="btn-modal-save">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- JavaScript Interaktif CRUD -->
    <script>
        let selectedRow = null;

        function openAddModal() {
            selectedRow = null;
            document.getElementById('modalTitle').innerText = "Add New User";
            document.getElementById('userForm').reset();
            document.getElementById('passwordInput').required = true;
            document.getElementById('btnDelete').style.display = 'none';
            document.getElementById('userModal').classList.add('active');
        }

        function openEditModal(btn) {
            selectedRow = btn.closest('tr');
            document.getElementById('modalTitle').innerText = "Edit User Details";
            
            const cells = selectedRow.cells;
            document.getElementById('usernameInput').value = cells[0].innerText.trim();
            document.getElementById('emailInput').value = cells[1].innerText.trim();
            document.getElementById('passwordInput').value = ""; 
            document.getElementById('passwordInput').required = false; // tidak wajib isi kalau edit
            document.getElementById('phoneInput').value = cells[3].innerText.trim();
            document.getElementById('addressInput').value = cells[4].innerText.trim();
            document.getElementById('roleInput').value = cells[5].innerText.trim();

            document.getElementById('btnDelete').style.display = 'inline-block';
            document.getElementById('userModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('userModal').classList.remove('active');
        }

        document.getElementById('userForm').addEventListener('submit', function(e) {
            e.preventDefault();

            const username = document.getElementById('usernameInput').value;
            const email = document.getElementById('emailInput').value;
            const phone = document.getElementById('phoneInput').value;
            const address = document.getElementById('addressInput').value;
            const role = document.getElementById('roleInput').value || 'Customer';

            const defaultHash = "$2y$12$89aJSmMrlbaXAKlvkndyyurYiJ1T4NOsBg8TULcE0NI.";

            if (selectedRow) {
                // UPDATE BARIS
                selectedRow.cells[0].innerHTML = `<strong>${username}</strong>`;
                selectedRow.cells[1].innerText = email;
                selectedRow.cells[3].innerText = phone;
                selectedRow.cells[4].innerText = address;
                selectedRow.cells[5].innerText = role;
            } else {
                // TAMBAH BARIS BARU (CREATE)
                const tbody = document.getElementById('userBody');
                const newRow = document.createElement('tr');
                newRow.innerHTML = `
                    <td><strong>${username}</strong></td>
                    <td>${email}</td>
                    <td class="password-hash">${defaultHash}</td>
                    <td>${phone}</td>
                    <td>${address}</td>
                    <td>${role}</td>
                    <td style="text-align: center;"><button class="action-btn" onclick="openEditModal(this)"><i class="fa-solid fa-ellipsis"></i></button></td>
                `;
                tbody.prepend(newRow);
            }

            updateCounter();
            closeModal();
        });

        function deleteUser() {
            if (selectedRow && confirm('Apakah Anda yakin ingin menghapus user ini?')) {
                selectedRow.remove();
                updateCounter();
                closeModal();
            }
        }

        function updateCounter() {
            const rows = document.querySelectorAll('#userBody tr');
            document.getElementById('userCountText').innerText = `Showing 1-${rows.length} out of ${rows.length} Users`;
        }

        function filterTable() {
            const search = document.getElementById('searchInput').value.toLowerCase();
            const role = document.getElementById('roleFilter').value;
            const rows = document.querySelectorAll('#userBody tr');

            rows.forEach(row => {
                const text = row.innerText.toLowerCase();
                const userRole = row.cells[5].innerText.trim();

                const matchSearch = text.includes(search);
                const matchRole = (role === 'All' || userRole === role);

                row.style.display = (matchSearch && matchRole) ? '' : 'none';
            });
        }
    </script>

</body>
</html>