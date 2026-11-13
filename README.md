# FELINE — Minimalist Cat Collection Web Application

FELINE adalah aplikasi web galeri koleksi kucing dengan sentuhan visual bertema **Retro 8-Bit CRT Console**. Aplikasi ini mendemonstrasikan implementasi **Laravel Web Middleware, Authentication, Role-Based Authorization, dan Operasi CRUD** melalui desain antarmuka yang bersih, responsif, dan interaktif.

---

## Fitur Utama

- **Authentication & Session Management**: Login aman dengan mekanisme sesi bawaan Laravel, CSRF protection, dan throttling.
- **Role-Based Authorization**:
  - **Kurator (Admin)**: Akses ke dashboard admin, menambah kucing baru, mengubah informasi & foto kucing, serta menghapus kucing dari galeri.
  - **Pengunjung (User)**: Melihat koleksi kucing yang dipublikasikan dan membuka halaman detail setiap kucing.
  - **Custom Middleware (`EnsureUserRole`)**: Melindungi rute administratif dari akses langsung oleh pengguna biasa maupun tamu dengan respons HTTP 403.
- **Koleksi & Manajemen Kucing (CRUD)**:
  - Form penambahan dan pengeditan kucing dengan validasi input yang ketat.
  - Upload foto kucing (JPEG, PNG, WebP hingga 2 MB) menggunakan Laravel Public Storage.
  - Pembersihan file foto lama secara aman saat gambar diperbarui atau data dihapus.
- **Retro 8-Bit CRT UI & Motion Design**:
  - Palet warna Midnight 8-Bit CRT (`#151824`, `#3CD070`, `#5CE1E6`, `#FFD166`, `#FF5D73`).
  - Efek CRT scanlines halus dan ikon pixel-art custom berbasis SVG.
  - Animasi transisi bertahap (*stepped timing*) bertenaga GSAP.
  - Latar belakang interaktif Vanta.js Dots di halaman login.

---

## Teknologi yang Digunakan

- **Backend**: Laravel 12, PHP 8.3+, SQLite, Eloquent ORM
- **Frontend**: Blade Templates, Tailwind CSS v4, Vanilla JavaScript
- **Animasi & Efek**: GSAP 3, Three.js, Vanta.js
- **Asset Bundler**: Vite 8

---

## Prasyarat Sistem

- PHP >= 8.3 dengan ekstensi `pdo_sqlite`, `fileinfo`, dan `gd`
- Composer
- Node.js >= 20 dan npm
- SQLite 3

---

## Panduan Instalasi

1. **Clone repositori**:
   ```bash
   git clone https://github.com/FrdMnhdl/FELINE.git
   cd FELINE
   ```

2. **Install dependensi PHP & Node.js**:
   ```bash
   composer install
   npm install
   ```

3. **Salin file konfigurasi lingkungan**:
   ```bash
   cp .env.example .env
   ```

4. **Generate application key**:
   ```bash
   php artisan key:generate
   ```

5. **Jalankan migrasi database dan seeder**:
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Buat symbolic link public storage**:
   ```bash
   php artisan storage:link
   ```

7. **Build aset frontend**:
   ```bash
   npm run build
   ```

8. **Jalankan server pengembangan**:
   ```bash
   php artisan serve
   ```
   Aplikasi dapat diakses melalui browser di: `http://localhost:8000`

---

## Akun Pengujian (Development Seeders)

| Role | Email | Password | Hak Akses |
| :--- | :--- | :--- | :--- |
| **Admin (Kurator)** | `admin@feline.test` | `feline-admin` | Beranda Admin, Tambah, Edit, Hapus, Galeri, Detail |
| **User (Pengunjung)** | `user@feline.test` | `feline-user` | Galeri Koleksi, Detail Kucing |

---

## Pengujian Otomatis

Proyek ini dilengkapi dengan rangkaian automated feature tests:

```bash
# Menjalankan PHPUnit suite
php artisan test

# Menjalankan linter kode Laravel Pint
./vendor/bin/pint --test
```

---

## Lisensi

Aplikasi ini dilisensikan di bawah [MIT License](LICENSE).
