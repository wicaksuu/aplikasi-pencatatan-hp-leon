# Leon — Aplikasi Pencatatan Pesanan Handphone

Aplikasi web pencatatan pesanan handphone berbasis Laravel yang dirancang untuk mencatat dan mengelola penjualan dari berbagai marketplace dalam satu sistem terintegrasi.

---

## ✨ Fitur

- **Input Pesanan Publik** — Halaman publik untuk input pesanan tanpa autentikasi (dapat dinonaktifkan)
- **Dashboard Analitik** — Statistik penjualan real-time dengan chart interaktif
- **Manajemen Pesanan** — CRUD pesanan dengan filter, pencarian, dan soft delete
- **Sistem Arsip** — Kelompokkan pesanan ke dalam arsip untuk organisasi lebih baik
- **Keranjang Sampah** — Restore pesanan dan arsip yang terhapus
- **Manajemen Platform** — Kelola marketplace/platform dengan warna kustom
- **Ekspor Data** — Download data ke Excel dan PDF
- **UI Premium Gelap** — Tema gelap dengan glassmorphism, gradient animasi, dan responsive mobile-first

---

## 🛠️ Stack Teknologi

| Lapisan | Teknologi |
|---------|-----------|
| Bahasa | PHP 8.3+ |
| Framework | Laravel 13.8 |
| Auth | Laravel Jetstream 5.5 (Livewire) + Fortify |
| API Auth | Laravel Sanctum |
| Komponen UI | Livewire 3.8 |
| CSS | Tailwind CSS 3.4 + DaisyUI 5.5.20 |
| Build | Vite 8.0 |
| Charts | Chart.js 4.5.1 |
| Excel Export | Maatwebsite Excel 3.1 |
| PDF Export | Barryvdh Laravel DomPDF 3.1 |
| Testing | Pest PHP 4.7 |

---

## 🚀 Instalasi

### Prasyarat
- PHP 8.3+
- Composer
- Node.js 20+
- MySQL / MariaDB / SQLite

### Setup Lengkap

```bash
# Clone repository
git clone <repo-url>
cd aplikasi-pencatatan-hp-leon

# Install dependencies & setup
composer run setup
```

Perintah `composer run setup` akan menjalankan:
- `composer install`
- Copy `.env.example` → `.env`
- Generate app key
- Jalankan migrasi database
- Install & build npm packages

### Setup Manual

```bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
npm install
npm run build
```

---

## 💻 Development

Jalankan development server (Vite + Laravel + Queue + Log watcher):

```bash
composer run dev
```

Perintah di atas akan menjalankan secara bersamaan:
- `php artisan serve`
- `php artisan queue:listen`
- `php artisan pail`
- `npm run dev`

---

## 🏭 Production Build

```bash
npm run build
```

Semua asset (CSS, JS, font) akan di-bundle ke `public/build/` dengan fingerprinting otomatis melalui Vite. Tidak ada dependency CDN — 100% self-hosted.

---

## 🧪 Testing

```bash
composer run test
# atau
php artisan test
```

---

## 🗺️ Routing

| Route | Akses | Keterangan |
|-------|-------|------------|
| `/` | Publik | Landing page |
| `/input` | Publik | Form input pesanan |
| `/dashboard` | Admin | Dashboard analitik |
| `/admin/orders` | Admin | Kelola pesanan |
| `/admin/archives` | Admin | Kelola arsip |
| `/admin/trash` | Admin | Sampah pesanan |
| `/admin/trash/archives` | Admin | Sampah arsip |
| `/admin/platforms` | Admin | Kelola platform |
| `/export/excel` | Admin | Download Excel |
| `/export/pdf` | Admin | Download PDF |

---

## 📝 Konvensi

- **Bahasa Indonesia** untuk semua teks UI, label, notifikasi, dan komentar kode
- **Bahasa Inggris** untuk nama class, method, variable, dan route name
- Login menggunakan **username** (bukan email)
- Semua model menggunakan **Soft Deletes**
- Event notifikasi menggunakan konvensi `swal:toast`, `swal:confirm`, `swal:prompt`

---

## 📄 Lisensi

Proyek ini menggunakan lisensi MIT.
