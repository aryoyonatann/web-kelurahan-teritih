# 🏛️ Web Kelurahan Teritih

Sistem informasi dan layanan administrasi digital **Kelurahan Teritih**, Kecamatan Walantaka, Kota Serang, Banten.

Dibangun dengan **Laravel 12**, **MySQL**, **Bootstrap 5**, dan dilengkapi **Chatbot AI** berbasis **Google Gemini** untuk membantu warga mendapatkan informasi layanan kelurahan secara interaktif.

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
- **🤖 Chatbot AI Hybrid** — asisten virtual berbasis Google Gemini AI yang menggabungkan FAQ statis (untuk pertanyaan umum) dengan AI generative (untuk pertanyaan terbuka warga)

---

## ⚙️ Persyaratan Sistem

| Kebutuhan | Versi Minimum |
|-----------|--------------|
| PHP | 8.2 |
| Composer | 2.x |
| Node.js | 18.x |
| MySQL | 8.0 |
| Laravel | 12.x |
| Google Gemini API Key | Free tier (Gemini 2.5 Flash-Lite) |

---

## 🚀 Langkah Instalasi

### 1. Clone Repository

```bash
git clone https://github.com/aryoyonatann/website-kelurahan-teritih.git
cd website-kelurahan-teritih
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

### 8. Konfigurasi Chatbot AI (Google Gemini)

Aplikasi ini menggunakan **Google Gemini API** untuk fitur chatbot. Tambahkan konfigurasi berikut di file `.env`:

```env
# Gemini AI Chatbot
GEMINI_API_KEY=AIza...isi_api_key_anda_di_sini
GEMINI_MODEL=gemini-2.5-flash-lite
```

#### Cara Mendapatkan API Key Gemini (Gratis)

1. Kunjungi [Google AI Studio](https://aistudio.google.com/apikey)
2. Login menggunakan akun Google
3. Klik tombol **"Create API Key"**
4. Pilih project (atau buat baru)
5. Copy API key yang muncul (format: `AIzaSy...`)
6. Paste ke variabel `GEMINI_API_KEY` di file `.env`

> **Penting:** Jangan pernah commit file `.env` ke Git atau bagikan API key kepada siapapun. File `.env` sudah termasuk dalam `.gitignore` secara default.

#### Pilihan Model Gemini

| Model | Karakteristik | Limit Free Tier |
|-------|--------------|-----------------|
| `gemini-2.5-flash-lite` | Cepat, hemat, **direkomendasikan** | 1.000 request/hari |
| `gemini-2.5-flash` | Lebih pintar, sedikit lambat | 250 request/hari |
| `gemini-2.5-pro` | Paling pintar, paling lambat | 100 request/hari |

### 9. Cara Membuat Migration Baru

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

## 🤖 Tentang Fitur Chatbot AI

Chatbot pada portal ini menggunakan **pendekatan hybrid** yang menggabungkan dua jenis chatbot:

### 1. Rule-based (FAQ Statis)

Pertanyaan umum seperti "Cara mengajukan permohonan surat?" atau "Jam operasional kantor?" dijawab langsung dari daftar FAQ yang sudah disiapkan. Cepat, akurat, dan tidak memerlukan koneksi ke API eksternal.

### 2. AI Generative (Gemini API)

Untuk pertanyaan bebas yang diketik warga, chatbot akan mengirim permintaan ke Google Gemini API dengan **system prompt** yang berisi konteks Kelurahan Teritih (alamat, jam operasional, jenis surat aktif, prosedur, dll). AI akan menjawab secara natural dan kontekstual.

### Fitur Keamanan Chatbot

- **Validasi input** — pesan minimal 2 karakter, maksimal 500 karakter
- **Rate limiting** — maksimal 10 request per menit per IP (mencegah spam)
- **CSRF token** — proteksi dari serangan Cross-Site Request Forgery
- **HTML escape** — semua input/output di-sanitize untuk mencegah XSS
- **Safety filter Gemini** — blokir konten berbahaya (kekerasan, ujaran kebencian, dll)
- **System prompt restriction** — AI hanya menjawab seputar layanan kelurahan dan tidak akan membahas topik di luar konteks

### Arsitektur Chatbot

```
Browser (User)
   ↓ POST /api/chatbot/ask
Laravel Controller (ChatbotController)
   ↓ Validasi + Rate Limit
   ↓ Build System Prompt (ambil jenis surat dari DB)
   ↓ HTTP Client → Gemini API
   ↑ Parse Response
Browser ← JSON response
```

### Endpoint API

```
POST /api/chatbot/ask
Content-Type: application/json
X-CSRF-TOKEN: {token}

Body:
{
  "message": "Berapa lama proses pembuatan surat domisili?"
}

Response:
{
  "success": true,
  "reply": "Proses pembuatan surat domisili biasanya..."
}
```

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
website-kelurahan-teritih/
├── app/
│   ├── Http/Controllers/
│   │   ├── Admin/              # Controller panel admin
│   │   ├── Auth/               # Controller autentikasi
│   │   ├── User/               # Controller portal warga
│   │   ├── ChatbotController.php  # Controller chatbot AI
│   │   ├── ProfilController.php
│   │   └── PublicController.php
│   └── Models/                 # Model Eloquent
├── config/
│   └── services.php            # Konfigurasi Gemini API
├── database/
│   ├── migrations/             # Skema database
│   └── seeders/                # Data awal
├── resources/views/
│   ├── Admin/                  # Tampilan panel admin
│   ├── User/                   # Tampilan portal warga
│   ├── auth/                   # Login, register, dll
│   ├── emails/                 # Template email
│   └── partials/
│       ├── navbar.blade.php    # Navbar publik
│       └── footer.blade.php    # Footer + UI Chatbot
└── routes/
    ├── web.php                 # Route utama (termasuk /api/chatbot/ask)
    └── auth.php                # Route autentikasi
```

---

## 🔄 Perintah Berguna

```bash
# Clear semua cache (termasuk config Gemini setelah edit .env)
php artisan optimize:clear

# Clear config saja (paling sering digunakan setelah edit .env)
php artisan config:clear

# Reset dan isi ulang database dari awal
php artisan migrate:fresh --seed

# Lihat semua route terdaftar
php artisan route:list

# Lihat semua migration dan statusnya
php artisan migrate:status

# Test koneksi ke Gemini API (via Tinker)
php artisan tinker
>>> config('services.gemini.api_key')
>>> exit
```

---

## 🛠️ Teknologi yang Digunakan

### Backend
- **Laravel 12** — PHP Framework
- **MySQL 8** — Database
- **PHP 8.2** — Server-side language

### Frontend
- **Bootstrap 5.3** — CSS Framework
- **Bootstrap Icons 1.11** — Icon library
- **Plus Jakarta Sans** — Google Fonts
- **Vite** — Asset bundler

### AI & Integrasi
- **Google Gemini API** — Large Language Model untuk chatbot
- **Laravel HTTP Client** — Komunikasi REST API ke Gemini

### Library Pendukung
- **Carbon** — Date & time manipulation
- **Laravel RateLimiter** — Proteksi spam pada chatbot

---

## 🐛 Troubleshooting

### Chatbot menampilkan "Maaf, terjadi kesalahan"

Beberapa kemungkinan penyebab:

1. **API key belum diisi** di `.env` — pastikan `GEMINI_API_KEY` sudah benar
2. **Cache config belum di-refresh** — jalankan `php artisan config:clear`
3. **Meta tag CSRF tidak ada** — pastikan setiap layout publik memiliki `<meta name="csrf-token" content="{{ csrf_token() }}">`
4. **Tidak ada koneksi internet** — Gemini API memerlukan akses internet

Untuk debugging, periksa file log: `storage/logs/laravel.log`

### Error: CSRF token mismatch (419)

Pastikan setiap layout publik (`home.blade.php`, `profil.blade.php`, dll) memiliki meta tag CSRF di dalam tag `<head>`:

```html
<meta name="csrf-token" content="{{ csrf_token() }}">
```

### Tabel `jenis_surat` not found

Jalankan migration:

```bash
php artisan migrate
```

---

## 👨‍💻 Developer

Project ini dibuat oleh **Aryo Yonatan** sebagai bagian dari penelitian Skripsi Strata-1.

**Kontak:**
- GitHub: [@aryoyonatann](https://github.com/aryoyonatann)

---

## 📝 Lisensi

Project ini dibuat untuk keperluan akademis dan layanan publik Kelurahan Teritih, Kota Serang. Penggunaan ulang untuk tujuan komersial harus mendapatkan izin dari developer.