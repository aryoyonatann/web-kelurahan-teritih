# 🏛️ Web Kelurahan Teritih

Sistem informasi dan layanan administrasi digital **Kelurahan Teritih**, Kecamatan Walantaka, Kota Serang, Banten.

Dibangun dengan **Laravel 12**, **MySQL**, dan **Bootstrap 5**.

---

## ✨ Fitur Utama

- **Permohonan Surat Online** — warga dapat mengajukan berbagai jenis surat (SKTM, Kematian, Suami/Istri, Beda Nama, Izin Cuti) secara online
- **Manajemen Jenis Surat** — admin dapat membuat jenis surat kustom dengan template A/B/C
- **Cetak Surat Resmi** — admin mencetak surat dengan kop kelurahan langsung dari browser
- **Data Kependudukan** — manajemen akun warga, blokir, export CSV, filter RT/RW
- **Statistik Demografi** — data populasi dan agama yang dikelola admin
- **Informasi Kelurahan** — berita dan pengumuman untuk masyarakat
- **Profil Kelurahan** — data singkat kelurahan yang dapat diperbarui admin
- **Reset Password via Email** — notifikasi email otomatis

---

## ⚙️ Persyaratan Sistem

| Kebutuhan | Versi Minimum |
|-----------|--------------|
| PHP | 8.2 |
| Composer | 2.x |
| Node.js | 18.x |
| MySQL | 8.0 |
| Laravel | 12.x |

---

## 🚀 Langkah Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/username/web-kelurahan.git
cd web-kelurahan
```

### 2. Install Dependensi PHP

```bash
composer install
```

### 3. Install Dependensi JavaScript

```bash
npm install
```

### 4. Salin File Environment

```bash
cp .env.example .env
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Konfigurasi Database

Buka file `.env` dan sesuaikan:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=db_kelurahan_teritih
DB_USERNAME=root
DB_PASSWORD=
```

Buat database di MySQL terlebih dahulu:

```sql
CREATE DATABASE db_kelurahan_teritih;
```

### 7. Konfigurasi Email (untuk fitur Reset Password)

```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=emailanda@gmail.com
MAIL_PASSWORD=app_password_16_karakter
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="emailanda@gmail.com"
MAIL_FROM_NAME="Kelurahan Teritih"
```

> **Catatan:** Gunakan **App Password** dari Google (bukan password biasa). Aktifkan 2-Step Verification di akun Google Anda terlebih dahulu.

### 8. Cara Membuat Migration Baru

Jika di masa depan perlu menambah tabel atau kolom baru, gunakan perintah:

```bash
# Membuat tabel baru
php artisan make:migration create_nama_tabel_table

# Menambah kolom ke tabel yang sudah ada
php artisan make:migration add_nama_kolom_to_nama_tabel_table
```

File migration akan otomatis dibuat di `database/migrations/`. Buka file tersebut dan isi method `up()` dengan struktur yang diinginkan, lalu jalankan:

```bash
php artisan migrate
```

### 10. Cara Membuat Controller Baru

```bash
# Controller biasa
php artisan make:controller NamaController

# Controller dengan method CRUD lengkap (index, create, store, show, edit, update, destroy)
php artisan make:controller NamaController --resource

# Controller di dalam subfolder
php artisan make:controller Admin/NamaController
php artisan make:controller User/NamaController
```

File controller akan otomatis dibuat di `app/Http/Controllers/`. Daftarkan route-nya di `routes/web.php`.

### 11. Jalankan Migration dan Seeder

```bash
php artisan migrate --seed
```

Seeder akan membuat:
- 2 akun admin (lihat [Akun Default](#-akun-default))
- 5 jenis surat bawaan
- Data statistik demografi (siap diisi)
- Data pengaturan kelurahan

### 12. Buat Storage Link

```bash
php artisan storage:link
```

> Diperlukan agar foto profil dan file upload dapat ditampilkan.

### 13. Build Asset

Untuk development:
```bash
npm run dev
```

Untuk production:
```bash
npm run build
```

### 14. Jalankan Server

```bash
php artisan serve
```

Akses aplikasi di: **http://127.0.0.1:8000**

---

## 🔑 Akun Default

Setelah menjalankan seeder:

### Admin
| Nama | Username | Password |
|------|----------|----------|
| Administrator Kelurahan Teritih | `adminteritih` | `Password12345` |
| Administrator Kelurahan | `Admin1` | `Password12345` |

> Akses admin di: `http://127.0.0.1:8000/admin/login`

### Warga / Masyarakat
Warga mendaftar sendiri melalui: `http://127.0.0.1:8000/register`

---

## 📁 Struktur Penting

```
web-kelurahan/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/              # Controller panel admin
│   │   ├── Auth/               # Controller autentikasi
│   │   ├── User/               # Controller portal warga
│   │   └── PublicController.php
│   └── Models/                 # Model Eloquent
├── database/
│   ├── migrations/             # Skema database
│   └── seeders/                # Data awal
├── resources/views/
│   ├── Admin/                  # Tampilan panel admin
│   ├── User/                   # Tampilan portal warga
│   ├── auth/                   # Login, register, dll
│   ├── emails/                 # Template email
│   └── partials/               # Navbar & footer
└── routes/
    ├── web.php                 # Route utama
    └── auth.php                # Route autentikasi
```

---

## 🔄 Perintah Berguna

```bash
# Clear semua cache
php artisan optimize:clear

# Reset dan isi ulang database dari awal
php artisan migrate:fresh --seed

# Lihat semua route terdaftar
php artisan route:list

# Lihat semua migration dan statusnya
php artisan migrate:status
```

---

## 🛠️ Teknologi yang Digunakan

- **Laravel 12** — PHP Framework
- **MySQL 8** — Database
- **Bootstrap 5.3** — CSS Framework
- **Bootstrap Icons 1.11** — Icon library
- **Plus Jakarta Sans** — Google Fonts
- **Carbon** — Date & time manipulation
- **Vite** — Asset bundler

---

## 👨‍💻 Developer

Project ini dibuat oleh **Aryo Yonatan**.

---

## 📝 Lisensi

Project ini dibuat untuk keperluan akademis dan layanan publik Kelurahan Teritih, Kota Serang.