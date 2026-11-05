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
    <link rel="stylesheet" href="<?php echo e(asset('css/produk.css')); ?>">
</head>
<body>

    <!-- Navbar Navigasi -->
    <nav class="navbar">
        <div class="nav-logo">
            <img src="<?php echo e(asset('images/logo_bc.png')); ?>" alt="Bandung Computer Logo" onerror="this.src='<?php echo e(asset('images/logo_bc_hitam.png')); ?>'">
        </div>
        <ul class="nav-links">
            <li><a href="<?php echo e(route('home')); ?>#beranda">Beranda</a></li>
            <li><a href="<?php echo e(route('produk')); ?>" class="active">Produk</a></li>
            <li><a href="<?php echo e(route('home')); ?>#tentang">Tentang Kami</a></li>
            <li><a href="<?php echo e(route('contact')); ?>">Kontak</a></li>
        </ul>
        <a href="<?php echo e(route('login')); ?>" class="btn-masuk">Masuk</a>
    </nav>

    <!-- Header Title -->
    <div class="catalog-header">
        <h1>Katalog Produk</h1>
    </div>

    <!-- Catalog Container -->
    <div class="catalog-container">
        
        <!-- Sidebar Filter Left -->
        <aside class="sidebar-filter">
            <div class="filter-header">
                <span class="filter-title">Filter</span>
                <a href="#" class="clear-all">Clear All</a>
            </div>

            <!-- Kategori Section -->
            <div class="filter-section">
                <div class="filter-section-title">
                    <span>Kategori</span>
                    <i class="fa-solid fa-chevron-up"></i>
                </div>
                <div class="category-list">
                    <div class="category-item">
                        <label><input type="checkbox"> Laptop</label>
                        <span class="category-count">12</span>
                    </div>
                    <div class="category-item">
                        <label><input type="checkbox"> Mouse</label>
                        <span class="category-count">32</span>
                    </div>
                    <div class="category-item">
                        <label><input type="checkbox"> TWS</label>
                        <span class="category-count">4</span>
                    </div>
                    <div class="category-item">
                        <label><input type="checkbox"> Keyboard</label>
                        <span class="category-count">8</span>
                    </div>
                    <div class="category-item">
                        <label><input type="checkbox"> Smartphone</label>
                        <span class="category-count">16</span>
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
                            <input type="number" placeholder="0">
                        </div>
                    </div>
                    <div class="price-field">
                        <label>Max</label>
                        <div class="input-with-symbol">
                            <span>Rp</span>
                            <input type="number" placeholder="100000000">
                        </div>
                    </div>
                </div>
            </div>

            <!-- Stok Toggle Section -->
            <div class="stock-toggle-box">
                <span class="stock-toggle-label">Stok</span>
                <label class="switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                </label>
            </div>
            <div style="font-size: 11px; color: #64748b; margin-top: 4px;">Tampilkan yang tersedia</div>
        </aside>

        <!-- Content Area Right -->
        <main class="content-area">
            
            <!-- Top Bar Search & Sort -->
            <div class="top-bar">
                <div class="search-box">
                    <i class="fa-solid fa-magnifying-glass"></i>
                    <input type="text" placeholder="Cari nama produk">
                </div>
                <div class="sort-box">
                    <select>
                        <option>Sortir: Paling Relevan</option>
                        <option>Harga: Terendah</option>
                        <option>Harga: Tertinggi</option>
                        <option>Terbaru</option>
                    </select>
                </div>
            </div>

            <!-- Product Grid (Gambar Besar) -->
            <div class="product-grid">
                
                <!-- Card 1 -->
                <div class="catalog-card">
                    <div class="card-img-wrapper">
                        <img src="<?php echo e(asset('images/asus_1.jpeg')); ?>" alt="ASUS TUF A15">
                    </div>
                    <div class="card-title">ASUS TUF A15</div>
                    <div class="card-price">Rp. 24.000.000</div>
                    <div class="status-badge available">
                        <i class="fa-regular fa-circle-check"></i> Tersedia • 10 unit
                    </div>
                </div>

                <!-- Card 2 -->
                <div class="catalog-card">
                    <div class="card-img-wrapper">
                        <img src="<?php echo e(asset('images/asus_1.jpeg')); ?>" alt="ASUS TUF A15">
                    </div>
                    <div class="card-title">ASUS TUF A15</div>
                    <div class="card-price">Rp. 24.000.000</div>
                    <div class="status-badge available">
                        <i class="fa-regular fa-circle-check"></i> Tersedia • 10 unit
                    </div>
                </div>

                <!-- Card 3 -->
                <div class="catalog-card">
                    <div class="card-img-wrapper">
                        <img src="<?php echo e(asset('images/asus_1.jpeg')); ?>" alt="ASUS TUF A15">
                    </div>
                    <div class="card-title">ASUS TUF A15</div>
                    <div class="card-price">Rp. 24.000.000</div>
                    <div class="status-badge out">
                        <i class="fa-regular fa-circle-xmark"></i> Stok habis
                    </div>
                </div>

                <!-- Card 4 -->
                <div class="catalog-card">
                    <div class="card-img-wrapper">
                       <img src="<?php echo e(asset('images/asus_1.jpeg')); ?>" alt="ASUS TUF A15">
                    </div>
                    <div class="card-title">ASUS TUF A15</div>
                    <div class="card-price">Rp. 24.000.000</div>
                    <div class="status-badge out">
                        <i class="fa-regular fa-circle-xmark"></i> Stok habis
                    </div>
                </div>

                <!-- Card 5 -->
                <div class="catalog-card">
                    <div class="card-img-wrapper">
                        <img src="<?php echo e(asset('images/asus_1.jpeg')); ?>" alt="ASUS TUF A15">
                    </div>
                    <div class="card-title">ASUS TUF A15</div>
                    <div class="card-price">Rp. 24.000.000</div>
                    <div class="status-badge available">
                        <i class="fa-regular fa-circle-check"></i> Tersedia • 10 unit
                    </div>
                </div>

                <!-- Card 6 -->
                <div class="catalog-card">
                    <div class="card-img-wrapper">
                         <img src="<?php echo e(asset('images/asus_1.jpeg')); ?>" alt="ASUS TUF A15">
                    </div>
                    <div class="card-title">ASUS TUF A15</div>
                    <div class="card-price">Rp. 24.000.000</div>
                    <div class="status-badge available">
                        <i class="fa-regular fa-circle-check"></i> Tersedia • 10 unit
                    </div>
                </div>

                <!-- Card 7 -->
                <div class="catalog-card">
                    <div class="card-img-wrapper">
                        <img src="<?php echo e(asset('images/asus_1.jpeg')); ?>" alt="ASUS TUF A15">
                    </div>
                    <div class="card-title">ASUS TUF A15</div>
                    <div class="card-price">Rp. 24.000.000</div>
                    <div class="status-badge available">
                        <i class="fa-regular fa-circle-check"></i> Tersedia • 10 unit
                    </div>
                </div>

                <!-- Card 8 -->
                <div class="catalog-card">
                    <div class="card-img-wrapper">
                        <img src="<?php echo e(asset('images/asus_1.jpeg')); ?>" alt="ASUS TUF A15">
                    </div>
                    <div class="card-title">ASUS TUF A15</div>
                    <div class="card-price">Rp. 24.000.000</div>
                    <div class="status-badge available">
                        <i class="fa-regular fa-circle-check"></i> Tersedia • 10 unit
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Footer Navigasi -->
    <footer class="footer-main">
        <div class="footer-top">
            <div class="footer-brand">
                <img src="<?php echo e(asset('images/logo_bc.png')); ?>" alt="Bandung Computer" onerror="this.src='<?php echo e(asset('images/logo_bc_hitam.png')); ?>'">
                <p>Bandung Computer — Solusi Perangkat IT & Komputer Terpercaya.</p>
            </div>

            <div>
                <div class="footer-links-title">Tautan</div>
                <ul class="footer-links-list">
                    <li><a href="<?php echo e(route('home')); ?>#beranda">Beranda</a></li>
                    <li><a href="<?php echo e(route('produk')); ?>">Produk</a></li>
                    <li><a href="<?php echo e(route('home')); ?>#tentang">Tentang Kami</a></li>
                    <li><a href="<?php echo e(route('contact')); ?>">Kontak</a></li>
                </ul>
            </div>

            <div>
                <div class="footer-links-title">Ikuti Kami</div>
                <div class="social-icons">
                    <a href="#"><i class="fa-brands fa-tiktok"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                    <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; 2026 Copyright Bandung Computer. All rights reserved
        </div>
    </footer>

</body>
</html><?php /**PATH C:\Users\ADVAN\Kelompok3_BandungComputer\resources\views/produk.blade.php ENDPATH**/ ?>