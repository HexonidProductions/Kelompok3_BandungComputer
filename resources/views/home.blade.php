<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bandung Computer - Solusi Perangkat IT & Komputer Terpercaya</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Landing Page -->
    @vite('resources/css/home.css')
</head>
<body>

   <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-logo">
            <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo" onerror="this.src='{{ asset('images/logo_bc_hitam.png') }}'">
        </div>
        <ul class="nav-links">
            <li><a href="{{ route('homepage') }}#beranda" class="active">Beranda</a></li>
            <li><a href="{{ route('produk') }}">Produk</a></li>
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
    <!-- Hero Section (Ganti gambar di bagian url asset 'images/tentang_kami.png' jika ingin ganti banner) -->
    <section class="hero" id="beranda" style="background: linear-gradient(rgba(15, 23, 42, 0.75), rgba(15, 23, 42, 0.85)), url('{{ asset('images/banner_users (1).png') }}') center/cover no-repeat;">
        <div class="hero-content">
            <h1 class="hero-title">Solusi Lengkap untuk Kebutuhan Komputer Anda</h1>
            <p class="hero-subtitle">Komputer dan aksesori berkualitas tinggi untuk memenuhi semua kebutuhanmu.</p>
            <a href="#produk" class="btn-hero">Lihat Produk</a>
        </div>
    </section>

    <!-- Section Belanja dari Koleksi -->
    <section class="section-container">
        <h2 class="section-title">Belanja dari koleksi</h2>
        <div class="category-grid">
            @php
                $collections = [
                    ['name' => 'Gaming', 'image' => 'images/koleksihomepage/gaming.jpg'],
                    ['name' => 'Sparepart PC', 'image' => 'images/koleksihomepage/sparepartpc.jpg'],
                    ['name' => 'Aksesoris', 'image' => 'images/koleksihomepage/Aksesoris.jpg'],
                    ['name' => 'Printer', 'image' => 'images/koleksihomepage/Printer.jpg'],
                    ['name' => 'Kabel', 'image' => 'images/koleksihomepage/Kabel.png'],
                ];
            @endphp
            @foreach ($collections as $item)
                <a href="{{ route('produk', ['search' => $item['name']]) }}" class="category-card">
                    <div class="category-img-wrapper">
                        <img src="{{ asset($item['image']) }}" 
                             alt="{{ $item['name'] }}"
                             class="category-img">
                    </div>
                    <span class="category-label">{{ $item['name'] }}</span>
                </a>
            @endforeach
        </div>
    </section>

    <!-- Section Produk Terbaru -->
    <section class="section-container" id="produk">
        <div class="section-header-flex">
            <h2 class="section-title" style="margin-bottom: 0;">Produk Terbaru di Toko Kami</h2>
            <a href="{{ route('produk') }}" class="view-all-link">View All <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="products-grid">
            @forelse ($latestProducts as $product)
                <div class="product-card">
                    @if(str_contains(strtolower($product->product_name), 'special edition') || str_contains(strtolower($product->description ?? ''), 'special edition') || str_contains($product->product_name, 'Galaxy Black'))
                        <span class="product-badge-special">Special Edition</span>
                    @endif
                    <div class="product-img-box">
                        <img src="{{ $product->image_url }}" 
                             alt="{{ $product->product_name }}">
                    </div>
                    <div class="product-name">{{ $product->product_name }}</div>
                    <div class="product-price">Rp. {{ number_format($product->sell_price, 0, ',', '.') }}</div>
                    <a href="{{ route('produk', ['search' => $product->product_name]) }}" class="btn-detail">Lihat Detail</a>
                </div>
            @empty
                <div class="col-span-full text-center py-8 text-gray-500">
                    Belum ada produk tersedia saat ini.
                </div>
            @endforelse
        </div>
    </section>

    <!-- Section Hubungi Kami -->
    <section class="contact-section" id="kontak">
        <div>
            <h2 class="contact-info-title">Hubungi Kami</h2>
            
            <div class="contact-group">
                <div class="contact-label">Email</div>
                <div class="contact-detail"><img src="{{ asset('icons/ic_round-email.png') }}" alt="Email Icon">bandungcomputer@gmail.com</div>
            </div>

            <div class="contact-group">
                <div class="contact-label">Nomor Telepon</div>
                <div class="contact-detail"><img src="{{ asset('icons/bxs_phone-call (1).png') }}" alt="Phone Icon"> 0858-4962-6858</div>
            </div>

            <div class="contact-group">
                <div class="contact-label">Jam Operasional</div>
                <div class="contact-detail"><img src="{{ asset('icons/carbon_time-filled.png') }}" alt="Time Icon"> Senin – Minggu (08.00 – 20.00 WITA)</div>
            </div>
        </div>

        <!-- Google Maps Embed Card (Titik Bandung Computer Banjarbaru) -->
        <!-- Google Maps Embed Card (Presisi Bandung Computer Banjarbaru) -->
        <div class="map-card">
            <iframe 
                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3982.5152778732745!2d114.83296187497368!3d-3.4433729965311225!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2de681816f198ff5%3A0x6b44766860b7fb5b!2sBandung%20Computer!5e0!3m2!1sid!2sid!4v1700000000000!5m2!1sid!2sid" 
                allowfullscreen="" 
                loading="lazy" 
                referrerpolicy="no-referrer-when-downgrade">
            </iframe>
            
            <div class="map-overlay-box">
                <div class="map-overlay-title">Kunjungi Toko Kami</div>
                <div class="map-overlay-desc">Jl. Panglima Batur No. 1, Loktabat Utara, Kec. Banjarbaru Utara, Kota Banjarbaru, Kalimantan Selatan 70711</div>
                <a href="https://www.google.com/maps/search/?api=1&query=Bandung+Computer+Banjarbaru" target="_blank" class="btn-gmaps">
    Lihat di Gmaps <i class="fa-solid fa-arrow-right"></i>
</a>
        </div>
    </section>

    <!-- Section FAQ -->
<section class="faq-section">
    <div class="faq-title">FAQ</div>
    <div class="faq-accordion">
        
        <div class="faq-item active">
            <div class="faq-question">
                <span>Apakah saya bisa datang langsung ke toko untuk melihat dan mencoba produk?</span>
                <i class="fa-solid fa-minus faq-icon"></i>
            </div>
            <div class="faq-answer">
                Sangat bisa! Anda dapat mengunjungi toko fisik kami untuk melihat unit, melakukan konsultasi spesifikasi, serta mencoba langsung produk yang ingin dibeli.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Apakah produk bisa dites terlebih dahulu sebelum dibawa pulang?</span>
                <i class="fa-solid fa-plus faq-icon"></i>
            </div>
            <div class="faq-answer">
                Tentu saja. Semua perangkat yang dibeli di toko kami akan diuji fungsi dan performanya bersama tim teknisi kami sebelum Anda membawanya pulang.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Metode pembayaran apa saja yang bisa digunakan?</span>
                <i class="fa-solid fa-plus faq-icon"></i>
            </div>
            <div class="faq-answer">
                Kami menerima pembayaran secara tunai, transfer bank, debit/kredit, serta pembayaran digital via QRIS dan e-wallet.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Apakah Bandung Computer melayani pesan antar (delivery)? Berapa ongkirnya?</span>
                <i class="fa-solid fa-plus faq-icon"></i>
            </div>
            <div class="faq-answer">
                Ya, kami melayani pengiriman area lokal maupun luar kota. Biaya ongkir akan disesuaikan dengan jarak lokasi pengiriman dan ekspedisi yang dipilih.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-question">
                <span>Bagaimana prosedur klaim garansi jika barang yang dibeli mengalami kerusakan pabrik?</span>
                <i class="fa-solid fa-plus faq-icon"></i>
            </div>
            <div class="faq-answer">
                Anda cukup membawa unit beserta nota pembelian dan kartu garansi ke toko kami. Tim kami akan membantu proses klaim garansi resmi hingga selesai.
            </div>
        </div>

    </div>
</section>

<!-- Script Interaktif FAQ Accordion -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const faqItems = document.querySelectorAll('.faq-item');

        faqItems.forEach(item => {
            const question = item.querySelector('.faq-question');
            question.addEventListener('click', () => {
                const isOpen = item.classList.contains('active');

                // Tutup item lain yang sedang terbuka
                faqItems.forEach(otherItem => {
                    otherItem.classList.remove('active');
                    const icon = otherItem.querySelector('.faq-icon');
                    if (icon) {
                        icon.classList.remove('fa-minus');
                        icon.classList.add('fa-plus');
                    }
                });

                // Toggle item yang diklik
                if (!isOpen) {
                    item.classList.add('active');
                    const icon = item.querySelector('.faq-icon');
                    if (icon) {
                        icon.classList.remove('fa-plus');
                        icon.classList.add('fa-minus');
                    }
                }
            });
        });
    });
</script>

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