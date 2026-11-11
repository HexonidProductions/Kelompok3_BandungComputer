<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Produk - Bandung Computer</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Produk -->
    @vite('resources/css/produk.css')
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
        <form method="GET" action="{{ route('produk') }}">
            <aside class="sidebar-filter">
                <div class="filter-header">
                    <span class="filter-title">Filter</span>
                    <a href="{{ route('produk') }}" class="clear-all">Clear All</a>
                </div>

            <!-- Kategori Section -->
            <div class="filter-section">
                <div class="filter-section-title">
                    <span>Kategori</span>
                    <i class="fa-solid fa-chevron-up"></i>
                </div>
                <div class="category-list">
                    @foreach ($categories as $cat)
                        <div class="category-item">
                            <label>
                                <input type="checkbox" name="category" value="{{ $cat->id }}" {{ $category == $cat->id ? 'checked' : '' }}>
                                {{ $cat->name }}
                            </label>
                            <span class="category-count">{{ $cat->products_count }}</span>
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
                            <input type="number" name="price_min" value="{{ $priceMin }}" placeholder="0">
                        </div>
                    </div>
                    <div class="price-field">
                        <label>Max</label>
                        <div class="input-with-symbol">
                            <span>Rp</span>
                            <input type="number" name="price_max" value="{{ $priceMax }}" placeholder="100000000">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stok Toggle Section -->
            <div class="stock-toggle-box">
                <span class="stock-toggle-label">Stok</span>
                <label class="switch">
                    <input type="checkbox" name="in_stock" {{ $inStock ? 'checked' : '' }}>
                    <span class="slider"></span>
                </label>
            </div>
            <div style="font-size: 11px; color: #64748b; margin-top: 4px;">Tampilkan yang tersedia</div>
            
            <button type="submit" class="btn-apply-filter" style="width: 100%; margin-top: 16px; padding: 10px; background: #2563eb; color: white; border: none; border-radius: 8px; font-weight: 600;">Terapkan Filter</button>
        </aside>
    </form>

        <!-- Content Area Right -->
        <main class="content-area">
            
            <!-- Top Bar Search & Sort -->
            <div class="top-bar">
                <form method="GET" class="search-box" style="display: flex; gap: 8px;">
                    @foreach(['category' => $category, 'price_min' => $priceMin, 'price_max' => $priceMax, 'in_stock' => $inStock, 'sort' => $sort] as $key => $val)
                        @if($val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endif
                    @endforeach
                    <i class="fa-solid fa-magnifying-glass" style="align-self: center; margin-left: 12px; color: #94a3b8;"></i>
                    <input type="text" name="search" value="{{ $search }}" placeholder="Cari nama produk" style="flex: 1; padding: 10px 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px;">
                </form>
                <form method="GET" class="sort-box" style="display: flex; gap: 8px; align-items: center;">
                    @foreach(['search' => $search, 'category' => $category, 'price_min' => $priceMin, 'price_max' => $priceMax, 'in_stock' => $inStock] as $key => $val)
                        @if($val)
                            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
                        @endif
                    @endforeach
                    <select name="sort" onchange="this.form.submit()" style="padding: 10px 12px; border: 1px solid #e2e8f0; border-radius: 8px; font-size: 14px; background: white;">
                        <option value="terbaru" {{ $sort === 'terbaru' ? 'selected' : '' }}>Terbaru</option>
                        <option value="harga_terendah" {{ $sort === 'harga_terendah' ? 'selected' : '' }}>Harga: Terendah</option>
                        <option value="harga_tertinggi" {{ $sort === 'harga_tertinggi' ? 'selected' : '' }}>Harga: Tertinggi</option>
                    </select>
                </form>
            </div>

            <!-- Product Grid (Gambar Besar) -->
            <div class="product-grid">
                @forelse ($products as $product)
                    <div class="catalog-card">
                        <div class="card-img-wrapper">
                            <img src="{{ $product->image ? asset('storage/' . $product->image) : asset('images/placeholder.png') }}" alt="{{ $product->product_name }}">
                        </div>
                        <div class="card-title">{{ $product->product_name }}</div>
                        <div class="card-price">Rp {{ number_format($product->sell_price, 0, ',', '.') }}</div>
                        <div class="status-badge {{ $product->status === 'Available' ? 'available' : 'out' }}">
                            <i class="fa-regular fa-circle-{{ $product->status === 'Available' ? 'check' : 'xmark' }}"></i>
                            {{ $product->status === 'Available' ? 'Tersedia • ' . $product->stock . ' unit' : 'Stok habis' }}
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12 text-gray-500">
                        <i class="fa-solid fa-box-open fa-2x mb-2"></i>
                        <p>Tidak ada produk yang sesuai dengan filter.</p>
                    </div>
                @endforelse
            </div>

            <!-- Pagination -->
            <div class="pagination-wrapper" style="margin-top: 24px; display: flex; justify-content: center;">
                {{ $products->links() }}
            </div>
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