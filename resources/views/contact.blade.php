<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontak - Bandung Computer</title>

    <!-- Font Awesome & Google Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- CSS Kontak -->
    @vite('resources/css/contact.css')
</head>
<body>

    <nav class="navbar">
    <div class="nav-logo">
        <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo" onerror="this.src='{{ asset('images/logo_bc_hitam.png') }}'">
    </div>
    <ul class="nav-links">
        <li><a href="{{ route('homepage') }}">Beranda</a></li>
        <li><a href="{{ route('produk') }}">Produk</a></li>
        <li><a href="{{ route('about') }}">Tentang Kami</a></li>
        <li><a href="{{ route('contact') }}" class="active">Kontak</a></li>
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

    <!-- Section Ada Pertanyaan -->
    <section class="contact-hero-section">
        <div>
            <h1 class="contact-hero-title">Ada Pertanyaan? Kami Siap Membantu.</h1>
            <p class="contact-hero-desc">Silakan isi formulir di bawah ini. Tim kami akan menghubungi Anda sesegera mungkin.</p>
            
            <div class="info-list">
                <div class="info-item">
                    <div class="info-icon"><img src="{{ asset('icons/bxs_phone-call.png') }}" alt="Phone Icon"></div>
                    <span>(+62)-0858-4962-6858</span>
                </div>
                <div class="info-item">
                    <div class="info-icon"><img src="{{ asset('icons/griddy-icons_email-alt-filled.png') }}" alt="Email Icon"></div>
                    <span>bandungcomputer@gmail.com</span>
                </div>
                <div class="info-item">
                    <div class="info-icon"><img src="{{ asset('icons/carbon_location-filled.png') }}" alt="Location Icon"></div>
                    <span>Jl. Panglima Batur, Loktabat Utara, Kec. Banjarbaru Utara</span>
                </div>
            </div>
        </div>

        <!-- Form Kirim Pesan -->
        <div class="contact-form-card">
            <form action="#" method="POST">
                @csrf
                <div class="form-group">
                    <label>Nama <span>*</span></label>
                    <input type="text" class="form-input" placeholder="Silakan masukkan nama" required>
                </div>

                <div class="form-group">
                    <label>Email <span>*</span></label>
                    <input type="email" class="form-input" placeholder="Silakan masukkan email" required>
                </div>

                <div class="form-group">
                    <label>Pesan <span>*</span></label>
                    <textarea class="form-textarea" placeholder="Silakan masukkan pertanyaan, ulasan, atau saran" required></textarea>
                </div>

                <button type="submit" class="btn-kirim">Kirim</button>
            </form>
        </div>
    </section>

    <!-- Section FAQ -->
    <section class="faq-section">
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

    <!-- Footer -->
    <footer class="footer-main">
        <div class="footer-top">
            <div class="footer-brand">
                <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer" onerror="this.src='{{ asset('images/logo_bc_hitam.png') }}'">
                <p>Bandung Computer — Solusi Perangkat IT & Komputer Terpercaya.</p>
            </div>

            <ul class="footer-links-list">
    <li><a href="{{ route('homepage') }}">Beranda</a></li>
    <li><a href="{{ route('produk') }}">Produk</a></li>
    <li><a href="{{ route('about') }}">Tentang Kami</a></li>
    <li><a href="{{ route('contact') }}">Kontak</a></li>
</ul>

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