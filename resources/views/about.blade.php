<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tentang Kami - Bandung Computer</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- CSS Tentang Kami -->
    @vite('resources/css/about.css')
</head>
<body>

    <!-- Navbar Navigasi -->
    <nav class="navbar">
        <div class="nav-logo">
            <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo" onerror="this.src='{{ asset('images/logo_bc_hitam.png') }}'">
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('homepage') }}">Beranda</a></li>
            <li><a href="{{ route('produk') }}">Produk</a></li>
            <li><a href="{{ route('about') }}" class="active">Tentang Kami</a></li>
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

    <!-- Badge Header -->
    <div class="badge-container">
        <span class="badge-label">Tentang Kami</span>
    </div>

    <!-- Hero Section -->
    <section class="about-hero">
        <h1 class="about-title">Teknologi untuk Mendukung Setiap Kebutuhan Anda.</h1>
        <p class="about-desc">Temukan solusi komputer dan aksesori teknologi dengan informasi produk yang jelas serta pelayanan terpercaya.</p>
    </section>

    <!-- Banner Image HD -->
    <div class="banner-container">
        <div class="about-banner">
            <img src="{{ asset('images/tentang_kami_hd.png') }}" alt="Tim Bandung Computer" onerror="this.src='{{ asset('images/tentang_kami.png') }}'">
        </div>
    </div>

    <!-- Badge Section Mengapa Memilih Kami -->
    <div class="badge-container">
        <span class="badge-label">Alasan Memilih Kami</span>
    </div>

    <section class="why-section">
        <div class="why-header">
            <h2 class="why-title">Mengapa Memilih Kami?</h2>
        </div>

        <div class="why-grid">
            <!-- Card 1 -->
            <div class="why-card">
                <div class="card-top">
                    <div class="icon-wrapper">
                        <img src="{{ asset('icons/fluent-mdl2_product.png') }}" alt="Pilihan Produk" onerror="this.src='{{ asset('icons/fluent-mdl2_product.png') }}'">
                    </div>
                    <h3 class="card-title">Pilihan Produk</h3>
                </div>
                <p class="card-desc">Beragam perangkat komputer dan aksesori teknologi terlengkap untuk segala kebutuhan.</p>
            </div>

            <!-- Card 2 -->
            <div class="why-card">
                <div class="card-top">
                    <div class="icon-wrapper">
                        <img src="{{ asset('icons/fluent-mdl2_product (1).png') }}" alt="Informasi Jelas" onerror="this.src='{{ asset('icons/fluent-mdl2_product.png') }}'">
                    </div>
                    <h3 class="card-title">Informasi Jelas</h3>
                </div>
                <p class="card-desc">Spesifikasi produk yang transparan, akurat, dan dapat diandalkan sebelum Anda membeli.</p>
            </div>

            <!-- Card 3 -->
            <div class="why-card">
                <div class="card-top">
                    <div class="icon-wrapper">
                        <img src="{{ asset('icons/fluent-mdl2_product (2).png') }}" alt="Pelayanan Ramah" onerror="this.src='{{ asset('icons/fluent-mdl2_product.png') }}'">
                    </div>
                    <h3 class="card-title">Pelayanan Ramah</h3>
                </div>
                <p class="card-desc">Tim kami yang berpengalaman selalu siap membantu memberikan rekomendasi teknologi terbaik.</p>
            </div>

            <!-- Card 4 -->
            <div class="why-card">
                <div class="card-top">
                    <div class="icon-wrapper">
                        <img src="{{ asset('icons/fluent-mdl2_product (3).png') }}" alt="Kepercayaan" onerror="this.src='{{ asset('icons/fluent-mdl2_product.png') }}'">
                    </div>
                    <h3 class="card-title">Kepercayaan</h3>
                </div>
                <p class="card-desc">Bandung Computer selalu mengutamakan kepuasan pelanggan dan garansi yang terjamin aman.</p>
            </div>
        </div>
    </section>

    <!-- Badge CTA & Card CTA -->
    <div class="badge-container">
        <span class="badge-label">Kunjungi halaman produk kami</span>
    </div>

    <div class="cta-container">
        <div class="cta-card">
            <h2 class="cta-text">Temukan Produk<br>yang Anda Butuhkan</h2>
            <a href="{{ route('produk') }}" class="btn-cta">Lihat Produk</a>
        </div>
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
                    <a href="#" target="_blank"><img src="{{ asset('icons/mage_tiktok-circle.png') }}" alt="TikTok" class="social-icon"></a>
                    <a href="#" target="_blank"><img src="{{ asset('icons/basil_instagram-solid.png') }}" alt="Instagram" class="social-icon"></a>
                    <a href="#" target="_blank"><img src="{{ asset('icons/stash_social-facebook-solid.png') }}" alt="Facebook" class="social-icon"></a>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            &copy; 2026 Copyright Bandung Computer. All rights reserved
        </div>
    </footer>

</body>
</html>