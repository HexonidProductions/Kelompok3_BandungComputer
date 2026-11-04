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
    <link rel="stylesheet" href="{{ asset('css/landing.css') }}">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar">
        <div class="nav-logo">
            <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo" onerror="this.src='{{ asset('images/logo_bc_hitam.png') }}'">
        </div>
        <ul class="nav-links">
            <li><a href="#beranda" class="active">Beranda</a></li>
            <li><a href="#produk">Produk</a></li>
            <li><a href="#tentang">Tentang Kami</a></li>
            <li><a href="#kontak">Kontak</a></li>
        </ul>
        <a href="{{ route('login') }}" class="btn-masuk">Masuk</a>
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
            <div class="category-card-img">
                <img src="{{ asset('images/gaming.png') }}" alt="Gaming">
            </div>
            <div class="category-card-img">
                <img src="{{ asset('images/pc.png') }}" alt="Sparepart PC">
            </div>
            <div class="category-card-img">
                <img src="{{ asset('images/acsesories.png') }}" alt="Aksesoris">
            </div>
            <div class="category-card-img">
                <img src="{{ asset('images/printer.png') }}" alt="Printer">
            </div>
            <div class="category-card-img">
                <img src="{{ asset('images/kabel.png') }}" alt="Kabel">
            </div>
        </div>
    </section>

    <!-- Section Produk Terbaru -->
    <section class="section-container" id="produk">
        <div class="section-header-flex">
            <h2 class="section-title" style="margin-bottom: 0;">Produk Terbaru di Toko Kami</h2>
            <a href="#" class="view-all-link">View All <i class="fa-solid fa-arrow-right"></i></a>
        </div>

        <div class="products-grid">
            <!-- Product 1: Gambar full card -->
            <div class="product-card-full">
                <img src="{{ asset('images/xbox.png') }}" alt="Xbox Series X">
            </div>

            <!-- Product 2: Gambar full card -->
            <div class="product-card-full">
                <img src="{{ asset('images/macbook.png') }}" alt="Macbook Pro 16">
            </div>

             <!-- Product 2: Gambar full card -->
            <div class="product-card-full">
                <img src="{{ asset('images/asus.png') }}" alt="Macbook Pro 16">
            </div>

             <!-- Product 2: Gambar full card -->
            <div class="product-card-full">
                <img src="{{ asset('images/mouse.png') }}" alt="Macbook Pro 16">
            </div>


        </div>
    </section>

    <!-- Section Hubungi Kami -->
    <section class="contact-section" id="kontak">
        <div>
            <h2 class="contact-info-title">Hubungi Kami</h2>
            
            <div class="contact-group">
                <div class="contact-label">Email</div>
                <div class="contact-detail"><i class="fa-regular fa-envelope"></i> bandungcomputer@gmail.com</div>
            </div>

            <div class="contact-group">
                <div class="contact-label">Nomor Telepon</div>
                <div class="contact-detail"><i class="fa-solid fa-phone"></i> 0858-4962-6858</div>
            </div>

            <div class="contact-group">
                <div class="contact-label">Jam Operasional</div>
                <div class="contact-detail"><i class="fa-regular fa-clock"></i> Senin – Minggu (08.00 – 20.00 WITA)</div>
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

    <!-- Section FAQ Accordion -->
    <section class="faq-section" id="tentang">
        <h2 class="faq-title">FAQ</h2>
        
        <div class="faq-accordion">
            <div class="faq-item active">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Apakah saya bisa datang langsung ke toko untuk melihat dan mencoba produk?</span>
                    <i class="fa-solid fa-minus icon-faq"></i>
                </div>
                <div class="faq-answer">
                    Sangat bisa! Anda dapat mengunjungi toko fisik kami untuk melihat unit, melakukan konsultasi spesifikasi, serta mencoba langsung produk yang ingin dibeli.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Apakah produk bisa dites terlebih dahulu sebelum dibawa pulang?</span>
                    <i class="fa-solid fa-plus icon-faq"></i>
                </div>
                <div class="faq-answer">
                    Ya, setiap pembelian di toko fisik kami menyediakan layanan pengujian unit secara menyeluruh sebelum Anda membawa barang pulang.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Metode pembayaran apa saja yang bisa digunakan?</span>
                    <i class="fa-solid fa-plus icon-faq"></i>
                </div>
                <div class="faq-answer">
                    Kami menerima Tunai (Cash), Transfer Bank, Kartu Debit, dan QRIS (GoPay, OVO, Dana, LinkAja).
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Apakah Bandung Computer melayani pesan antar (delivery)? Berapa ongkirnya?</span>
                    <i class="fa-solid fa-plus icon-faq"></i>
                </div>
                <div class="faq-answer">
                    Kami melayani pengiriman area Banjarbaru & Banjarmasin dengan kurir toko serta pengiriman luar kota via ekspedisi terpercaya.
                </div>
            </div>

            <div class="faq-item">
                <div class="faq-question" onclick="toggleFaq(this)">
                    <span>Bagaimana prosedur klaim garansi jika barang yang dibeli mengalami kerusakan pabrik?</span>
                    <i class="fa-solid fa-plus icon-faq"></i>
                </div>
                <div class="faq-answer">
                    Cukup bawa produk beserta nota/resmi pembelian ke toko kami, tim teknisi kami akan membantu proses klaim garansi resmi ke pihak distributor.
                </div>
            </div>
        </div>
    </section>

    <!-- Footer Front-End -->
    <footer class="footer-main">
        <div class="footer-top">
            <div class="footer-brand">
                <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer" onerror="this.src='{{ asset('images/logo_bc_hitam.png') }}'">
                <p>Bandung Computer — Solusi Perangkat IT & Komputer Terpercaya.</p>
            </div>

            <div>
                <div class="footer-links-title">Tautan</div>
                <ul class="footer-links-list">
                    <li><a href="#beranda">Beranda</a></li>
                    <li><a href="#produk">Produk</a></li>
                    <li><a href="#tentang">Tentang Kami</a></li>
                    <li><a href="#kontak">Kontak</a></li>
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

    <!-- JavaScript Interaktif FAQ -->
    <script>
        function toggleFaq(element) {
            const item = element.parentElement;
            const icon = item.querySelector('.icon-faq');
            
            item.classList.toggle('active');
            
            if (item.classList.contains('active')) {
                icon.classList.remove('fa-plus');
                icon.classList.add('fa-minus');
            } else {
                icon.classList.remove('fa-minus');
                icon.classList.add('fa-plus');
            }
        }
    </script>

</body>
</html>