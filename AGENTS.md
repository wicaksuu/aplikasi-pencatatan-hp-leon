# AGENTS.md — Aplikasi Pencatatan HP Leon

Dokumen ini ditujukan untuk AI coding agents yang bekerja pada proyek ini. Proyek ini menggunakan bahasa Indonesia (Bahasa Indonesia) di seluruh antarmuka pengguna, komentar kode, dan dokumentasi.

---

## Ikhtisar Proyek

**Leon** adalah aplikasi web pencatatan pesanan handphone berbasis Laravel yang dirancang untuk mencatat dan mengelola penjualan dari berbagai marketplace (platform e-commerce) dalam satu sistem terintegrasi. Aplikasi ini memiliki:

- Halaman publik untuk input pesanan tanpa autentikasi
- Panel admin dengan dashboard analitik, manajemen pesanan, arsip, dan platform
- Sistem arsip untuk mengelompokkan pesanan
- Keranjang sampah (soft delete) untuk pesanan dan arsip
- Ekspor data ke Excel dan PDF
- UI premium bertema gelap dengan Tailwind CSS + DaisyUI

---

## Stack Teknologi

| Lapisan | Teknologi |
|---------|-----------|
| Bahasa | PHP 8.3+ |
| Framework | Laravel 13.8 |
| Auth Scaffolding | Laravel Jetstream 5.5 (Livewire stack) |
| Auth Backend | Laravel Fortify |
| API Auth | Laravel Sanctum |
| Komponen UI | Livewire 3.6.4 |
| CSS Framework | Tailwind CSS 3.4 + DaisyUI 5.5.20 |
| Build Tool | Vite 8.0 |
| Charts | Chart.js 4.5.1 |
| Excel Export | Maatwebsite Excel 3.1 |
| PDF Export | Barryvdh Laravel DomPDF 3.1 |
| Testing | Pest PHP 4.7 |
| Code Style | Laravel Pint |

---

## Struktur Kode

```
app/
├── Actions/Fortify/       # Custom Fortify actions (auth Jetstream)
├── Actions/Jetstream/     # Custom Jetstream actions
├── Exports/               # Class export Excel (Maatwebsite)
├── Http/Controllers/      # Controller standar (hanya ExportController)
├── Livewire/              # Semua komponen Livewire
│   ├── Home.php           # Landing page publik
│   ├── PublicOrderForm.php# Form input pesanan publik
│   └── Admin/             # Panel admin
│       ├── OrderDashboard.php      # Dashboard dengan statistik
│       ├── OrderList.php           # Manajemen pesanan aktif
│       ├── TrashOrderList.php      # Keranjang sampah pesanan
│       ├── ArchiveList.php         # Manajemen arsip
│       ├── TrashArchiveList.php    # Keranjang sampah arsip
│       ├── ArchiveDetail.php       # Detail arsip + daftar pesanan
│       ├── ArchiveSelectorModal.php# Modal pemilih arsip (global)
│       └── PlatformManager.php     # Kelola platform & toggle input
├── Models/
│   ├── User.php           # Autentikasi (username + email, Jetstream)
│   ├── Order.php          # Pesanan (soft deletes, belongsTo Archive)
│   ├── Platform.php       # Marketplace/platform (nama + warna)
│   ├── Archive.php        # Arsip (soft deletes, hasMany Orders)
│   └── Setting.php        # Key-value settings (toggle fitur, dll)
├── Providers/             # Service providers
└── View/Components/       # Layout components (AppLayout, GuestLayout)

resources/views/
├── layouts/
│   ├── app.blade.php      # Layout admin (sidebar + bottom nav mobile)
│   └── guest.blade.php    # Layout publik (navbar fixed)
├── livewire/              # View komponen Livewire
├── pdf/orders.blade.php   # Template PDF
├── components/            # Blade components Jetstream
└── auth/, profile/, api/  # Views bawaan Jetstream

database/migrations/       # 14 file migrasi
database/seeders/          # DatabaseSeeder (membuat user admin)
database/factories/        # UserFactory

tests/
├── Pest.php               # Konfigurasi Pest (extend TestCase + RefreshDatabase)
├── Feature/
│   ├── AuthenticationTest.php
│   ├── ExportTest.php
│   └── Livewire/
│       ├── PublicOrderFormTest.php
│       ├── OrderDashboardTest.php
│       └── PlatformManagerTest.php
```

---

## Perintah Build & Development

```bash
# Setup lengkap (install dependencies, env, key, migrate, build)
composer run setup

# Development (menjalankan server, queue, log watcher, dan Vite secara bersamaan)
composer run dev

# Build assets untuk production
npm run build

# Jalankan test suite
composer run test
# atau
php artisan test

# Format kode dengan Laravel Pint
./vendor/bin/pint
```

---

## Konvensi Pengembangan

### Bahasa
- **Gunakan Bahasa Indonesia** untuk semua teks UI, label, notifikasi, dan komentar kode.
- Bahasa Inggris hanya digunakan untuk nama class, method, variable, dan route name.

### Autentikasi
- Login menggunakan **username** (bukan email). Kolom `username` ditambahkan ke tabel `users`.
- Jetstream diaktifkan dengan fitur profile photo dan two-factor authentication.
- Semua route admin dilindungi middleware group: `auth:sanctum`, `verified`, dan Jetstream auth session.

### Livewire
- Semua halaman utama diimplementasikan sebagai komponen Livewire class-based.
- Komunikasi antar komponen menggunakan event browser via `dispatch()` dan `#[On(...)]`.
- Pagination menggunakan trait `WithPagination`.

### Event Notifikasi (SweetAlert2)
Aplikasi menggunakan konvensi event Livewire khusus untuk SweetAlert2:
- `swal:toast` — Toast notification (success/error)
- `swal:confirm` — Konfirmasi dialog (delete, restore, archive)
- `swal:prompt` — Input prompt (misal: nama arsip baru)

Event ini ditangani di `resources/views/layouts/app.blade.php`.

### Model & Database
- Gunakan **Soft Deletes** untuk `Order` dan `Archive`.
- Semua model menggunakan `$fillable` untuk mass assignment.
- `Setting` model menyediakan static method `get($key, $default)` dan `set($key, $value)`.
- Default platform colors diatur via script `update_colors.php`.

### UI/Styling
- Tema gelap permanen (`data-theme="dark"` di `<html>`).
- Menggunakan DaisyUI themes: `corporate` (light) dan `business` (dark), dengan darkTheme default `business`.
- Font utama: Outfit (Google Fonts).
- Style premium dengan gradient background animasi dan glassmorphism (backdrop-blur, border white/10).
- Mobile-first dengan bottom navigation bar untuk tampilan mobile.

---

## Instruksi Testing

- Framework testing: **Pest PHP** (bukan PHPUnit langsung).
- Semua test Feature menggunakan trait `RefreshDatabase`.
- Database testing: **SQLite in-memory** (`:memory:`).
- Test class extend `Tests\TestCase`.
- Livewire components diuji menggunakan `Livewire::test(Component::class)`.
- Jalankan test dengan: `composer run test`

### Test yang Ada
- `AuthenticationTest` — Login screen, autentikasi berhasil/gagal
- `PublicOrderFormTest` — Render, submit order, validasi field
- `OrderDashboardTest` — Render dengan data, search, soft delete, restore
- `PlatformManagerTest` — CRUD platform
- `ExportTest` — Akses export untuk guest vs admin, header response

---

## Routing

| Route | Komponen/Controller | Keterangan |
|-------|---------------------|------------|
| `/` | `Home` | Landing page publik |
| `/input` | `PublicOrderForm` | Form input pesanan publik |
| `/dashboard` | `OrderDashboard` | Dashboard admin (auth) |
| `/admin/orders` | `OrderList` | Daftar pesanan aktif |
| `/admin/archives` | `ArchiveList` | Manajemen arsip |
| `/admin/archives/{id}` | `ArchiveDetail` | Detail arsip |
| `/admin/trash` | `TrashOrderList` | Sampah pesanan |
| `/admin/trash/archives` | `TrashArchiveList` | Sampah arsip |
| `/admin/platforms` | `PlatformManager` | Kelola platform |
| `/export/excel` | `ExportController@excel` | Download Excel |
| `/export/pdf` | `ExportController@pdf` | Download PDF |

---

## Keamanan

- Autentikasi wajib untuk semua route admin dan export.
- Password di-hash menggunakan Laravel default (`bcrypt`).
- CSRF token disertakan di setiap form (Laravel default).
- Sanctum digunakan untuk autentikasi session/API.
- Two-factor authentication tersedia via Jetstream/Fortify.
- File `.env` tidak pernah di-commit (terdaftar di `.gitignore`).

---

## Catatan Penting

- Script `update_colors.php` adalah utilitas one-off untuk mengupdate warna platform default (Shopee, Tokopedia, TikTok Shop, Lazada, WhatsApp). Jalankan via `php update_colors.php`.
- Fitur input pesanan publik dapat dinonaktifkan dari halaman Platform Manager (`Setting::get('order_input_enabled')`).
- Aplikasi menggunakan timezone `Asia/Jakarta` secara default.
- Queue driver default: `database`.
- Session driver default: `database`.
- Cache driver default: `database`.
