# FELINE — Galeri Kucing Retro

Website galeri koleksi kucing sederhana bertema retro 8-bit.

---

## Panduan Instalasi

Ikuti langkah-langkah berikut untuk menjalankan website di komputer kamu:

1. **Clone repositori**
   ```bash
   git clone https://github.com/FrdMnhdl/FELINE.git
   cd FELINE
   ```

2. **Install kebutuhan sistem**
   ```bash
   composer install
   npm install
   ```

3. **Salin file konfigurasi**
   - Di Windows (PowerShell/CMD):
     ```bash
     copy .env.example .env
     ```
   - Di Linux/macOS:
     ```bash
     cp .env.example .env
     ```

4. **Buat kunci aplikasi**
   ```bash
   php artisan key:generate
   ```

5. **Siapkan database dan data awal (seeder)**
   ```bash
   php artisan migrate:fresh --seed
   ```

6. **Hubungkan folder penyimpanan foto**
   ```bash
   php artisan storage:link
   ```

7. **Kompilasi tampilan (asset)**
   ```bash
   npm run build
   ```

8. **Nyalakan website**
   ```bash
   php artisan serve
   ```
   Buka browser dan akses alamat: **`http://localhost:8000`**

---

## Akun Pengujian

Gunakan akun berikut untuk mencoba fitur di halaman login:

| Akun | Email | Password | Keterangan |
| :--- | :--- | :--- | :--- |
| **Admin (Kurator)** | `admin@feline.test` | `feline-admin` | Bisa menambah, mengedit, dan menghapus foto kucing |
| **User (Pengunjung)** | `user@feline.test` | `feline-user` | Hanya bisa melihat galeri dan membuka detail kucing |
