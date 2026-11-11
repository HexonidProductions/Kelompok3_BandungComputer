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

    <!-- CSS Kustom untuk Warna Toggle & Teks Keterangan -->
    <style>
        .switch .slider {
            background-color: #000000 !important; /* Warna gelap saat belum diklik */
        }
        .switch .slider:before {
            background-color: #D9D9D9 !important; /* Warna bulatan toggle */
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
        
        <!-- Sidebar Filter Left -->
        <form method="GET" action="{{ route('produk') }}" class="sidebar-form" id="filterForm">
            <aside class="sidebar-filter">
                <div class="filter-header">
                    <span class="filter-title">Filter</span>
                    <a href="{{ route('produk') }}" class="clear-all">Clear All</a>
                </div>

                <!-- Kategori Section (Tetap Checkbox Kotak, tapi Eksklusif/Bergantian) -->
                <div class="filter-section">
                    <div class="filter-section-title">
                        <span>Kategori</span>
                        <i class="fa-solid fa-chevron-up"></i>
                    </div>
                    <div class="category-list">
                        @foreach ($categories as $cat)
                            <div class="category-item">
                                <label style="cursor: pointer; display: flex; align-items: center; gap: 8px;">
                                    <input type="checkbox" name="category" value="{{ $cat->id }}" 
                                        {{ request('category') == $cat->id ? 'checked' : '' }} 
                                        onchange="
                                            localStorage.setItem('scrollPosition', window.scrollY);
                                            document.querySelectorAll('input[name=\'category\']').forEach(el => {
                                                if(el !== this) el.checked = false;
                                            });
                                            this.form.submit();
                                        ">
                                    {{ $cat->category_name ?? $cat->name }}
                                </label>
                                <span class="category-count">{{ $cat->products_count ?? 0 }}</span>
                            </div>
                        @endforeach
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
                                <input type="number" name="price_min" value="{{ request('price_min') }}" placeholder="0">
                            </div>
                        </div>
                        <div class="price-field">
                            <label>Max</label>
                            <div class="input-with-symbol">
                                <span>Rp</span>
                                <input type="number" name="price_max" value="{{ request('price_max') }}" placeholder="100000000">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Stok Toggle Section (Menyimpan posisi scroll sebelum submit) -->
                <div class="filter-section" style="border-bottom: none; padding-bottom: 0;">
                    <div class="filter-section-title" style="margin-bottom: 8px;">
                        <span>Stok</span>
                    </div>
                    <div style="display: flex; align-items: center; gap: 10px;">
                        <label class="switch" style="display: inline-block; margin-bottom: 0; flex-shrink: 0;">
                            <input type="checkbox" name="in_stock" value="1" {{ request('in_stock') ? 'checked' : '' }} 
                                onchange="
                                    localStorage.setItem('scrollPosition', window.scrollY);
                                    this.form.submit();
                                ">
                            <span class="slider"></span>
                        </label>
                        <span style="font-size: 11px; color: #000000; line-height: 1.2;">Tampilkan yang tersedia</span>
                    </div>
                </div>
            </aside>
        </form>

        <!-- Content Area Right -->
        <main class="content-area">
            
            <!-- Top Bar Search & Sort (Tinggi diperkecil dengan padding vertikal yang lebih ramping) -->
            <div class="top-bar" style="display: flex; gap: 16px; margin-bottom: 24px;">
                
                <!-- Search Box -->
                <form method="GET" class="search-box" style="display: flex; gap: 8px; align-items: center; flex: 1; border: 1px solid #cbd5e1; border-radius: 8px; padding: 6px 12px; background-color: #ffffff; height: 38px;">
                    @foreach(['category' => request('category'), 'price_min' => request('price_min'), 'price_max' => request('price_max'), 'in_stock' => request('in_stock'), 'sort' => request('sort')] as $key => $val)
                        @if($val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endif
                    @endforeach
                    <i class="fa-solid fa-magnifying-glass" style="color: #94a3b8; font-size: 13px;"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari nama atau kode produk" style="flex: 1; border: none; outline: none; font-size: 13px; background: transparent;">
                </form>

                <!-- Sort Box -->
                <form method="GET" class="sort-box" style="display: flex; align-items: center; gap: 8px; border: 1px solid #cbd5e1; border-radius: 8px; padding: 0 12px; background: white; height: 38px; cursor: pointer;" onclick="document.getElementById('sortSelect').focus();">
                    @foreach(['search' => request('search'), 'category' => request('category'), 'price_min' => request('price_min'), 'price_max' => request('price_max'), 'in_stock' => request('in_stock')] as $key => $val)
                        @if($val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endif
                    @endforeach
                    <img src="{{ asset('icons/fluent_arrow-sort-16-filled.png') }}" alt="Sort Icon" style="width: 14px; height: 14px; object-fit: contain; cursor: pointer;" onclick="event.stopPropagation(); document.getElementById('sortSelect').focus();">

                    <select id="sortSelect" name="sort" onchange="localStorage.setItem('scrollPosition', window.scrollY); this.form.submit();" style="border: none; padding: 0; font-size: 12px; background: transparent; outline: none; cursor: pointer; appearance: none; height: 100%; width: 100%;">
                        <option value="terbaru" {{ request('sort') === 'terbaru' ? 'selected' : '' }}>Sortir: Paling Relevan</option>
                        <option value="harga_terendah" {{ request('sort') === 'harga_terendah' ? 'selected' : '' }}>Harga: Terendah</option>
                        <option value="harga_tertinggi" {{ request('sort') === 'harga_tertinggi' ? 'selected' : '' }}>Harga: Tertinggi</option>
                    </select>
                </form>
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
                    <a href="#" target="_blank"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#" target="_blank"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#" target="_blank"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; 2026 Copyright Bandung Computer. All rights reserved
        </div>
    </footer>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const scrollPos = localStorage.getItem('scrollPosition');
            if (scrollPos) {
                window.scrollTo(0, parseInt(scrollPos));
                localStorage.removeItem('scrollPosition');
            }
        });
    </script>
</body>
</html>