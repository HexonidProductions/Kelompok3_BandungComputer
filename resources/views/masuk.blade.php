<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Masuk - Bandung Computer</title>
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
    <main class="login-container">
        <div class="login-image">
            <img src="https://images.unsplash.com/photo-1588872657578-7efd1f1555ed?auto=format&fit=crop&q=80&w=1000" alt="Perangkat komputer di ruang kerja">
        </div>

        <section class="login-form-container" aria-labelledby="login-title">
            <a href="{{ url('/') }}" class="back-link">Kembali ke beranda &lt;</a>

            <header class="brand-header">
                <div class="logo-icon">
                    <i class="fa-solid fa-network-wired" aria-hidden="true"></i>
                    <span>Bandung Computer</span>
                </div>
                <h2 id="login-title">Selamat datang</h2>
                <p class="subtitle">Masuk untuk melanjutkan ke akun Anda.</p>
            </header>

            <form action="{{ route('login') }}" method="POST" class="login-form">
                @csrf

                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="nama@email.com" autocomplete="username" required autofocus>
                        <i class="fa-regular fa-user input-icon" aria-hidden="true"></i>
                    </div>
                    @error('email')
                        <p role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="Masukkan password" autocomplete="current-password" required>
                        <i class="fa-solid fa-lock input-icon" aria-hidden="true"></i>
                    </div>
                    @error('password')
                        <p role="alert">{{ $message }}</p>
                    @enderror
                </div>

                <button type="submit" class="btn-login">Masuk</button>
            </form>
        </section>
    </main>
</body>
</html>