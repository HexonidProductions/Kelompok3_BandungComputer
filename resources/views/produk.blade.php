<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Bandung Computer</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Eksternal & Tailwind (via Vite) -->
    @vite(['resources/css/produk.css'])

    <!-- CSS Tambahan Khusus Ikon Centang Toggle agar Path asset() Terbaca Laravel -->
    <style>
        .switch input:checked + .slider:before {
            transform: translateX(16px);
            background-image: url('{{ asset("icons/akar-icons_check.png") }}') !important;
            background-size: 8px 8px !important;
            background-repeat: no-repeat !important;
            background-position: center !important;
        }
    </style>
</head>
<body>

    <!-- Navbar Navigasi -->
    <nav class="navbar">
        <div class="nav-logo">
            <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo" onerror="this.src='{{ asset('images/logo_bc_hitam.png') }}'">
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('homepage') }}">Beranda</a></li>
            <li><a href="{{ route('produk') }}" class="active">Produk</a></li>
            <li><a href="{{ route('about') }}">Tentang Kami</a></li>
            <li><a href="{{ route('contact') }}">Kontak</a></li>
        </ul>
        @guest
            <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>
        @else
            @if (Auth::user()->role === 'customer')
                <form action="{{ route('logout') }}" method="POST" class="d-inline">
                    @csrf
                    <button type="submit" class="btn-masuk">Logout</button>
                </form>
            @else
                <a href="{{ route('dashboard') }}" class="btn-masuk">Dashboard</a>
            @endif
        @endguest
    </nav>

    <!-- Header Title -->
    <div class="catalog-header">
        <h1>Katalog Produk</h1>
    </div>

    <!-- Catalog Container -->
    <div class="catalog-container">
        
        <!-- Sidebar Filter Left (Dengan Tombol Terapkan Filter) -->
        <form method="GET" action="{{ route('produk') }}" class="sidebar-form" id="filterForm" onsubmit="localStorage.setItem('scrollPosition', window.scrollY);">
            <aside class="sidebar-filter">
                <div class="filter-header">
                    <span class="filter-title">Filter</span>
                    <a href="{{ route('produk') }}" class="clear-all">Clear All</a>
                </div>

                <!-- Kategori Section -->
                <div class="filter-section">
                    <div class="filter-section-title" onclick="toggleCategoryDropdown()" style="cursor: pointer;">
                        <span>Kategori</span>
                        <i class="fa-solid fa-chevron-down" id="categoryArrow" style="transition: transform 0.3s ease;"></i>
                    </div>
                    <div class="category-dropdown-container" id="categoryDropdownList" style="display: none;">
                        <div class="category-list">
                            @foreach ($categories as $cat)
                                <div class="category-item">
                                    <label style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                        <input type="checkbox" name="category" value="{{ $cat->id }}" 
                                            {{ request('category') == $cat->id ? 'checked' : '' }} 
                                            onchange="
                                                document.querySelectorAll('input[name=\'category\']').forEach(el => {
                                                    if(el !== this) el.checked = false;
                                                });
                                            ">
                                        {{ $cat->category_name ?? $cat->name }}
                                    </label>
                                    <span class="category-count">{{ $cat->products_count ?? 0 }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Harga Section -->
                <div class="filter-section">
                    <div class="filter-section-title">
                        <span>Harga</span>
                    </div>
                    <div class="price-inputs">
                        <div class="price-field">
                            <label>Min</label>
                            <div class="input-with-symbol">
                                <span>Rp</span>
                                <input type="number" name="price_min" min="0" step="1" value="{{ request('price_min') }}" placeholder="0">
                            </div>
                        </div>
                        <div class="price-field">
                            <label>Max</label>
                            <div class="input-with-symbol">
                                <span>Rp</span>
                                <input type="number" name="price_max" min="0" step="1" value="{{ request('price_max') }}" placeholder="100000000">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stok Toggle Section (Tanpa auto-submit) -->
                <div class="filter-section">
                    <div class="filter-section-title" style="margin-bottom: 8px;">
                        <span>Stok</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <label class="switch" style="display: inline-block; margin-bottom: 0; flex-shrink: 0;">
                            <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }}>
                            <span class="slider"></span>
                        </label>
                        <span style="font-size: 11px; color: #000000; line-height: 1.2;">Tampilkan yang tersedia</span>
                    </div>
                </div>

                <!-- Tombol Terapkan Filter -->
                <div style="margin-top: 20px;">
                    <button type="submit" class="btn-terapkan">
                        Terapkan Filter
                    </button>
                </div>
            </aside>
        </form>

        <!-- Content Area Right -->
        <main class="content-area">
            
            <!-- Top Bar Search & Sort -->
            <div class="top-bar" style="display: flex; gap: 16px; margin-bottom: 24px;">
                
                <!-- Search Box -->
                <form method="GET" class="search-box" onsubmit="localStorage.setItem('scrollPosition', window.scrollY);">
                    @foreach(['category' => request('category'), 'price_min' => request('price_min'), 'price_max' => request('price_max'), 'in_stock' => request('in_stock'), 'sort' => request('sort')] as $key => $val)
                        @if($val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endif
                    @endforeach
                    <i class="fa-solid fa-magnifying-glass" style="color: #94a3b8; font-size: 13px; margin-right: 8px;"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kode produk" style="flex: 1; border: none; outline: none; font-size: 13px; background: transparent;">
                </form>

                <!-- Sort Box Custom ala Figma (Rata Kiri, Teks Aktif Bold) -->
                <div class="sort-dropdown-container" id="sortDropdownContainer">
                    <form method="GET" action="{{ route('produk') }}" id="sortForm" class="sort-box" onclick="toggleSortMenu(event)" onsubmit="localStorage.setItem('scrollPosition', window.scrollY);">
                        @foreach(['search' => request('search'), 'category' => request('category'), 'price_min' => request('price_min'), 'price_max' => request('price_max'), 'in_stock' => request('in_stock')] as $key => $val)
                            @if($val)
                                <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                            @endif
                        @endforeach
                        <input type="hidden" name="sort" id="sortInput" value="{{ request('sort', 'terbaru') }}">
                        
                        <img src="{{ asset('icons/fluent_arrow-sort-16-filled.png') }}" alt="Sort Icon" class="sort-icon">
                        <span id="sortSelectedLabel" style="font-size: 12px; color: #1e293b; white-space: nowrap; flex: 1;">
                            @php
                                $sortVal = request('sort', 'terbaru');
                                $labels = [
                                    'terbaru' => 'Sortir: Paling Relevan',
                                    'terbaru_waktu' => 'Sortir: Terbaru',
                                    'harga_terendah' => 'Sortir: Harga Terendah',
                                    'harga_tertinggi' => 'Sortir: Harga Termahal'
                                ];
                                echo $labels[$sortVal] ?? 'Sortir: Paling Relevan';
                            @endphp
                        </span>
                    </form>

                    <!-- Menu Pop-up List Sesuai Figma -->
                    <div class="sort-menu-list" id="sortMenuList">
                        <div class="sort-menu-item" data-value="terbaru" onclick="selectSort('terbaru', 'Sortir: Paling Relevan')">
                            <img src="{{ asset('icons/fluent_arrow-sort-16-filled.png') }}" alt="" style="width: 14px; height: 14px; opacity: 0.7;">
                            <span>Sortir: Paling Relevan</span>
                        </div>
                        <div class="sort-menu-item" data-value="terbaru_waktu" onclick="selectSort('terbaru_waktu', 'Sortir: Terbaru')">
                            <img src="{{ asset('icons/fluent_arrow-sort-16-filled.png') }}" alt="" style="width: 14px; height: 14px; opacity: 0.7;">
                            <span>Sortir: Terbaru</span>
                        </div>
                        <div class="sort-menu-item" data-value="harga_terendah" onclick="selectSort('harga_terendah', 'Sortir: Harga Terendah')">
                            <img src="{{ asset('icons/fluent_arrow-sort-16-filled.png') }}" alt="" style="width: 14px; height: 14px; opacity: 0.7;">
                            <span>Sortir: Harga Terendah</span>
                        </div>
                        <div class="sort-menu-item" data-value="harga_tertinggi" onclick="selectSort('harga_tertinggi', 'Sortir: Harga Termahal')">
                            <img src="{{ asset('icons/fluent_arrow-sort-16-filled.png') }}" alt="" style="width: 14px; height: 14px; opacity: 0.7;">
                            <span>Sortir: Harga Termahal</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Grid -->
            <div class="product-grid">
                @forelse ($products as $product)
                    <div class="catalog-card">
                        <div class="card-img-wrapper">
                            <!-- Memanfaatkan Accessor getImageUlrAttribute dari Model Product -->
                            <img src="{{ $product->image_url }}" alt="{{ $product->product_name }}">
                        </div>
                        <div class="card-title">{{ $product->product_name }}</div>
                        <div class="card-price">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</div>
                        
                        <!-- Menyesuaikan status badge dengan kolom ENUM database -->
                        <div class="status-badge {{ $product->stock > 0 && $product->status === 'Available' ? 'available' : 'out' }}">
                            <i class="fa-regular fa-circle-{{ $product->stock > 0 && $product->status === 'Available' ? 'check' : 'xmark' }}"></i>
                            {{ $product->stock > 0 && $product->status === 'Available' ? 'Tersedia • ' . $product->stock . ' Unit' : ($product->status ?? 'Stok habis') }}
                        </div>
                    </div>
                @empty
                    <div style="grid-column: span 4; text-align: center; padding: 48px; color: #64748b;">
                        <i class="fa-solid fa-box-open fa-2x mb-2"></i>
                        <p>Tidak ada produk yang ditemukan.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination (Menggunakan Tailwind & Component Pagination kustom) -->
            @if($products->count() > 0)
                <div class="flex items-center justify-between mt-6 text-xs text-slate-500">
                    <div>
                        Showing {{ $products->firstItem() }}-{{ $products->lastItem() }} out of {{ $products->total() }} Products
                    </div>
                    <div>
                        {{ $products->links('components.pagination') }}
                    </div>
                </div>
            @endif
        </main>
    </div>

    <!-- Footer Navigasi -->
    <footer class="footer-main">
        <div class="footer-top">
            <div class="footer-brand">
                <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer" onerror="this.src='{{ asset('images/logo_bc_hitam.png') }}'">
                <p>Bandung Computer — Solusi Perangkat IT & Komputer Terpercaya.</p>
            </div>

            <div>
                <div class="footer-links-title">Tautan</div>
                <ul class="footer-links-list">
                    <li><a href="{{ route('homepage') }}">Beranda</a></li>
                    <li><a href="{{ route('produk') }}">Produk</a></li>
                    <li><a href="{{ route('about') }}">Tentang Kami</a></li>
                    <li><a href="{{ route('contact') }}">Kontak</a></li>
                </ul>
            </div>

            <div>
                <div class="footer-links-title">Ikuti Kami</div>
                <div class="social-icons">
                    <a href="https://www.tiktok.com/@bandungcomputerbjm?_r=1&_t=ZS-9BKonxKlv61" target="_blank"><img src="{{ asset('icons/mage_tiktok-circle.png') }}" alt="TikTok" class="social-icon"></a>
                    <a href="https://www.instagram.com/bandungcomputer?dlrf=MWFsdnFtaG1qaXlv" target="_blank"><img src="{{ asset('icons/basil_instagram-solid.png') }}" alt="Instagram" class="social-icon"></a>
                    <a href="https://www.facebook.com/share/1ECt6qqnQt/" target="_blank"><img src="{{ asset('icons/stash_social-facebook-solid.png') }}" alt="Facebook" class="social-icon"></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; 2026 Copyright Bandung Computer. All rights reserved
        </div>
    </footer>

    <script>
        // Fungsi untuk dropdown Kategori dengan menyimpan state ke localStorage
        function toggleCategoryDropdown() {
            const dropdown = document.getElementById('categoryDropdownList');
            const arrow = document.getElementById('categoryArrow');
            
            if (dropdown.style.display === 'none' || dropdown.style.display === '') {
                dropdown.style.display = 'block';
                arrow.classList.remove('fa-chevron-down');
                arrow.classList.add('fa-chevron-up');
                localStorage.setItem('categoryDropdownOpen', 'true');
            } else {
                dropdown.style.display = 'none';
                arrow.classList.remove('fa-chevron-up');
                arrow.classList.add('fa-chevron-down');
                localStorage.setItem('categoryDropdownOpen', 'false');
            }
        }

        // Script Dropdown Sortir
        function toggleSortMenu(event) {
            event.stopPropagation();
            const menu = document.getElementById('sortMenuList');
            menu.style.display = menu.style.display === 'flex' ? 'none' : 'flex';
        }

        function selectSort(value, label) {
            localStorage.setItem('scrollPosition', window.scrollY);
            document.getElementById('sortInput').value = value;
            document.getElementById('sortSelectedLabel').innerText = label;
            document.getElementById('sortForm').submit();
        }

        // Mengembalikan posisi scroll dan status dropdown setelah halaman dimuat ulang
        document.addEventListener("DOMContentLoaded", function () {
            const scrollPos = localStorage.getItem('scrollPosition');
            if (scrollPos !== null) {
                window.scrollTo(0, parseInt(scrollPos));
                localStorage.removeItem('scrollPosition');
            }

            // Memeriksa apakah kategori sedang aktif atau sebelumnya dibuka
            const urlParams = new URLSearchParams(window.location.search);
            const hasActiveCategory = urlParams.has('category');
            const dropdownState = localStorage.getItem('categoryDropdownOpen');

            const dropdown = document.getElementById('categoryDropdownList');
            const arrow = document.getElementById('categoryArrow');

            // Buka dropdown otomatis jika ada kategori yang dipilih atau state sebelumnya 'true'
            if (hasActiveCategory || dropdownState === 'true') {
                dropdown.style.display = 'block';
                arrow.classList.remove('fa-chevron-down');
                arrow.classList.add('fa-chevron-up');
            } else {
                dropdown.style.display = 'none';
                arrow.classList.remove('fa-chevron-up');
                arrow.classList.add('fa-chevron-down');
            }

            // Tandai item sortir aktif
            const currentSort = document.getElementById('sortInput') ? document.getElementById('sortInput').value : '';
            const menuItems = document.querySelectorAll('.sort-menu-item');
            menuItems.forEach(item => {
                if (item.getAttribute('data-value') === currentSort) {
                    item.classList.add('active');
                } else {
                    item.classList.remove('active');
                }
            });
        });

        // Menutup menu sortir jika diklik di luar area
        window.addEventListener('click', function() {
            const menu = document.getElementById('sortMenuList');
            if (menu) menu.style.display = 'none';
        });
    </script>
</body>
</html>