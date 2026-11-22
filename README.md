<p align="center">
    <img src="public/images/logo_bc.png" alt="Bandung Computer Logo" width="360">
</p>

# Project Bandung Computer

Aplikasi e-commerce sederhana berbasis **Laravel 12** untuk toko komputer & aksesoris.  
Fitur: katalog produk, keranjang, checkout, autentikasi (email/password + Google OAuth), dashboard admin, manajemen inventori & transaksi.

---

## Tech Stack

| Layer | Teknologi |
|-------|-----------|
| Backend | Laravel 11, PHP 8.2+ |
| Frontend | Blade + Tailwind CSS + Vite |
| Database | MySQL / MariaDB |
| Auth | Laravel Breeze + Google OAuth (Socialite) |
| Queue / Cache | Database (dev) → Redis (production) |
| Storage | Local filesystem (symlink `public/storage`) |
| Deployment | Cloudflare Tunnel + HTTPS (SSL terminated by Cloudflare) |

---

## Local Development Setup

### 1. Clone & Install Dependencies
```bash
git clone https://github.com/HexonidProductions/Kelompok3_BandungComputer.git
cd Kelompok3_BandungComputer

composer install
npm install
```

### 2. Environment Configuration
```bash
cp .env.example .env
# atau Windows CMD: copy .env.example .env

php artisan key:generate
```

Edit `.env` — minimal yang wajib diisi:
```env
APP_NAME="Bandung Computer"
APP_ENV=local
APP_DEBUG=true
APP_URL=http://localhost:8000

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=bandungcomputer
DB_USERNAME=laravel
DB_PASSWORD=laravel

GOOGLE_CLIENT_ID=your-google-client-id
GOOGLE_CLIENT_SECRET=your-google-client-secret
GOOGLE_REDIRECT_URI=http://localhost:8000/auth/google/callback
```

### 3. Database & Seeder
```bash
php artisan migrate
php artisan db:seed --class=ProductSeeder   # optional: data produk homepage
php artisan storage:link                    # symlink public/storage
```

### 4. Run Development Servers (2 terminal)

**Terminal 1 — Backend:**
```bash
php artisan serve
```

**Terminal 2 — Frontend (Vite HMR):**
```bash
npm run dev
```

Akses: **http://localhost:8000**

---

## Production Deployment (Cloudflare Tunnel + HTTPS)

### Prasyarat
- Domain sudah ditambahkan ke Cloudflare (nameserver NS mengarah ke Cloudflare)
- Cloudflare Tunnel (`cloudflared`) terinstall di server
- SSL/TLS mode: **Full (Strict)** di dashboard Cloudflare → SSL/TLS → Overview

### 1. Environment Production (`.env`)
```env
APP_ENV=production
APP_DEBUG=false
APP_URL=https://yourdomain.com

# HTTPS & Secure Cookies (WAJIB untuk Cloudflare)
SESSION_SECURE_COOKIE=true
SESSION_DOMAIN=.yourdomain.com      # optional, untuk subdomain
SESSION_ENCRYPT=true                # recommended

# Google OAuth — update redirect URI ke domain production
GOOGLE_REDIRECT_URI=https://yourdomain.com/auth/google/callback

# Mail (contoh SMTP)
MAIL_MAILER=smtp
MAIL_HOST=smtp.mailgun.org
MAIL_PORT=587
MAIL_USERNAME=your-smtp-user
MAIL_PASSWORD=your-smtp-pass
MAIL_FROM_ADDRESS="noreply@yourdomain.com"
MAIL_FROM_NAME="${APP_NAME}"

# Queue & Cache — gunakan Redis di production
QUEUE_CONNECTION=redis
CACHE_STORE=redis
REDIS_HOST=127.0.0.1
REDIS_PASSWORD=null
REDIS_PORT=6379
```

### 2. Optimize Laravel
```bash
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache
php artisan storage:link
```

### 3. Database Migration
```bash
php artisan migrate --force
# php artisan db:seed --class=ProductSeeder --force  # hanya first deploy
```

### 4. Setup Cloudflare Tunnel

**config.yml** (`~/.cloudflared/config.yml`):
```yaml
tunnel: your-tunnel-id
credentials-file: /home/user/.cloudflared/your-tunnel-id.json

ingress:
  - hostname: yourdomain.com
    service: http://localhost:8000
    originRequest:
      noTLSVerify: true
  - hostname: www.yourdomain.com
    service: http://localhost:8000
    originRequest:
      noTLSVerify: true
  - service: http_status:404
```

**Jalankan tunnel:**
```bash
# Test dulu
cloudflared tunnel --url http://localhost:8000

# Production (systemd/service)
sudo cloudflared service install
sudo systemctl enable cloudflared
sudo systemctl start cloudflared
```

### 5. Verifikasi Checklist Post-Deploy
- HTTPS aktif di browser
- Login email/password & Google OAuth berfungsi
- Gambar produk tampil (cek `asset()` → `https://`)
- Session cookie memiliki flag `Secure` & `SameSite=Lax`
- Queue worker jalan: `php artisan queue:work --daemon`
- Scheduler cron: `* * * * * cd /path && php artisan schedule:run >> /dev/null 2>&1`

---

## Useful Commands

```bash
# Clear semua cache
php artisan optimize:clear

# Rebuild cache production
php artisan optimize

# Queue worker (production)
php artisan queue:work redis --sleep=3 --tries=3 --daemon

# Schedule worker
php artisan schedule:work

# Test email
php artisan tinker --execute="Mail::raw('test', fn(\$m)=>\$m->to('test@example.com')->subject('Test'));"

# Backup DB
mysqldump -u laravel -p bandungcomputer > backup_$(date +%F).sql
```

---

## Project Structure Highlights

```
app/
├── Http/Controllers/       # Auth, Google, Product, Dashboard, Transaction
├── Models/                 # Product, Category, Transaction, User
├── Middleware/             # PreventBackHistory, EnsureUserIsAdmin
└── Providers/              # AppServiceProvider (view composers)

routes/
├── web.php                 # Semua route web (homepage, auth, produk, admin)
└── console.php             # Scheduled commands

database/seeders/
└── ProductSeeder.php       # 6 produk: 4 homepage + 2 ROG lama

resources/views/
├── home.blade.php          # Homepage dengan "Produk Terbaru"
├── auth/                   # Login, Register, Complete Profile
└── components/             # login-success-overlay, dll
```

---

## Environment Variables Reference

| Variable | Development | Production | Required |
|----------|-------------|------------|----------|
| `APP_ENV` | `local` | `production` | ✅ |
| `APP_DEBUG` | `true` | `false` | ✅ |
| `APP_URL` | `http://localhost:8000` | `https://domain.com` | ✅ |
| `SESSION_SECURE_COOKIE` | `false` / unset | `true` | ✅ (prod) |
| `SESSION_DOMAIN` | `null` | `.domain.com` | Optional |
| `GOOGLE_REDIRECT_URI` | `http://localhost:8000/auth/google/callback` | `https://domain.com/auth/google/callback` | ✅ |
| `MAIL_MAILER` | `log` | `smtp`/`ses`/`mailgun` | ✅ (prod) |
| `QUEUE_CONNECTION` | `database` | `redis` | Recommended |
| `CACHE_STORE` | `database` | `redis` | Recommended |