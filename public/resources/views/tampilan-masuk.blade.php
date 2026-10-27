<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page - Bandung Computer</title>
    
    <!-- CSS Terpisah -->
    <link rel="stylesheet" href="{{ asset('css/login.css') }}?v=3">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>

    <div class="login-container">
        <!-- GAMBAR REVISI LOKAL -->
        <div class="login-image">
            <img src="{{ asset('images/banner_login_page_revision.png') }}" alt="Banner Login">
        </div>

        <div class="login-form-container">
            <a href="#" class="back-link">Back to homepage &lt;</a>

            <div class="brand-header">
                <!-- LOGO HITAM LOKAL -->
                <div class="logo-box-img">
                    <img src="{{ asset('images/logo_bc.png') }}" alt="Bandung Computer Logo">
                </div>

                <h2>Welcome Back</h2>
                <p class="subtitle">Elevate your digital lifestyle with the latest tech and gadgets.</p>
            </div>

            <!-- Mengarah ke proses login untuk masuk ke overview -->
            <form action="{{ route('login.process') }}" method="POST" class="login-form">
                @csrf
                
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-wrapper">
                        <input type="email" id="email" name="email" placeholder="Enter Your Email" required autofocus>
                        <i class="fa-solid fa-user input-icon"></i>
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">Password</label>
                    <div class="input-wrapper">
                        <input type="password" id="password" name="password" placeholder="Enter Your Password" required>
                        <i class="fa-solid fa-eye-slash input-icon toggle-password" id="togglePassword"></i>
                    </div>
                </div>

                <button type="submit" class="btn-login">Login</button>

                <div class="divider">
                    <span>OR</span>
                </div>

                <button type="button" class="btn-google">
                    <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google Logo">
                    Continue with google
                </button>

                <p class="signup-text">
                    Don't have an account? <a href="#">Sign up</a>
                </p>
            </form>
        </div>
    </div>

    <!-- SCRIPT TOGGLE MATA PASSWORD -->
    <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function () {
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>

</body>
</html>