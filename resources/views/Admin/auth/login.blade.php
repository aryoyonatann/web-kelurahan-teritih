<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Administrator – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
    :root {
        --navy:    #0d1b3e;
        --navy2:   #1e3a5f;
        --dark:    #0f172a;
        --dark2:   #1e293b;
        --slate:   #334155;
        --muted:   #64748b;
        --border:  #e2e8f0;
        --bg:      #f1f5f9;
        --blue:    #1c64f2;
        --blue-dk: #1a56db;
        --blue-lt: #eff6ff;
        --green:   #10b981;
        --red:     #ef4444;
    }

    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg);
        color: var(--slate);
        font-size: 14px;
        min-height: 100vh;
        display: flex;
        flex-direction: column;
    }

    /* =====================================================
       NAVBAR
    ===================================================== */
    .admin-nav {
        background: #0d1b3e;
        border-bottom: 1px solid #1e3a5f;
        padding: 0 32px;
        height: 72px;
        display: flex;
        align-items: center;
        justify-content: space-between;
        position: sticky;
        top: 0;
        z-index: 1000;
        box-shadow: 0 2px 12px rgba(0,0,0,.25);
        flex-shrink: 0;
    }

    .admin-nav-brand {
        display: flex; align-items: center; gap: 10px;
        text-decoration: none;
    }

    .admin-nav-icon {
        width: 40px; height: 40px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; overflow: hidden;
        background: transparent;
    }
    .admin-nav-icon img {
        width: 100%; height: 100%;
        object-fit: contain;
    }

    .admin-nav-text { display: flex; flex-direction: column; line-height: 1.15; }
    .admin-nav-sub  { font-size: 11px; font-weight: 700; letter-spacing: .12em; color: rgba(255,255,255,.6); text-transform: uppercase; }
    .admin-nav-name { font-size: 18px; font-weight: 800; color: #ffffff; }

    .btn-back-home {
        display: inline-flex; align-items: center; gap: 7px;
        padding: 8px 16px; border-radius: 8px;
        font-size: 14px; font-weight: 600;
        border: 1.5px solid rgba(255,255,255,.3);
        background: rgba(255,255,255,.1); color: rgba(255,255,255,.85);
        text-decoration: none; transition: all .18s;
    }
    .btn-back-home:hover {
        border-color: rgba(255,255,255,.6);
        color: #ffffff;
        background: rgba(255,255,255,.2);
    }

    /* =====================================================
       PAGE BODY
    ===================================================== */
    .page-body {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 36px 20px;
    }

    /* =====================================================
       LOGIN CARD
    ===================================================== */
    .login-card {
        width: 100%;
        max-width: 980px;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(0,0,0,.10);
        display: flex;
        min-height: 520px;
    }

    /* LEFT PANEL */
    .left-panel {
        flex: 0 0 44%;
        position: relative;
        overflow: hidden;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        padding: 36px 32px 28px;
    }

    .left-panel::before {
        content: '';
        position: absolute; inset: 0;
        background:
            linear-gradient(to top, rgba(5,10,25,.97) 0%, rgba(5,10,25,.7) 45%, rgba(5,10,25,.4) 100%),
            url('https://images.unsplash.com/photo-1486325212027-8081e485255e?w=900&q=80') center/cover no-repeat;
        z-index: 0;
    }

    .lp-top, .lp-bot { position: relative; z-index: 1; }

    .lp-badge {
        display: inline-flex; align-items: center; gap: 7px;
        background: rgba(28,100,242,.25);
        border: 1px solid rgba(28,100,242,.4);
        border-radius: 20px; padding: 5px 13px;
        font-size: 11px; font-weight: 700;
        color: #93c5fd; margin-bottom: 20px;
    }

    .lp-title {
        font-size: 30px; font-weight: 800;
        color: white; line-height: 1.2; margin-bottom: 14px;
    }

    .lp-desc {
        font-size: 13px; color: rgba(255,255,255,.65); line-height: 1.7;
    }

    .lp-features {
        display: flex; gap: 20px; flex-wrap: wrap;
        margin-bottom: 14px;
    }
    .lp-feat {
        display: flex; align-items: center; gap: 6px;
        font-size: 12px; font-weight: 600; color: rgba(255,255,255,.8);
    }
    .lp-feat i { color: #60a5fa; font-size: 14px; }

    .lp-copy {
        font-size: 11px; color: rgba(255,255,255,.3);
        border-top: 1px solid rgba(255,255,255,.1); padding-top: 12px;
    }

    /* RIGHT PANEL */
    .right-panel {
        flex: 1;
        padding: 44px 48px;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .rp-title    { font-size: 26px; font-weight: 800; color: var(--navy); margin-bottom: 4px; }
    .rp-subtitle { font-size: 13px; color: var(--muted); margin-bottom: 28px; line-height: 1.6; }

    .label-row {
        display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;
    }
    .label-row label { font-size: 13px; font-weight: 600; color: var(--navy); margin: 0; }
    .label-row a     { font-size: 12px; font-weight: 600; color: var(--blue); text-decoration: none; }
    .label-row a:hover { text-decoration: underline; }

    .field-label { font-size: 13px; font-weight: 600; color: var(--navy); margin-bottom: 6px; display: block; }

    .input-wrap { position: relative; }
    .input-wrap .ico-l {
        position: absolute; left: 14px; top: 50%;
        transform: translateY(-50%);
        color: #94a3b8; font-size: 15px; z-index: 2;
        pointer-events: none;
    }
    .input-wrap .ico-r {
        position: absolute; right: 14px; top: 50%;
        transform: translateY(-50%);
        color: #94a3b8; font-size: 15px; z-index: 2;
        cursor: pointer; transition: color .18s;
    }
    .input-wrap .ico-r:hover { color: var(--navy); }

    .input-wrap input {
        display: block; width: 100%; height: 46px;
        padding: 0 42px; border-radius: 9px;
        border: 1.5px solid var(--border);
        font-size: 13.5px; font-family: inherit;
        color: var(--navy); background: white;
        outline: none; transition: border-color .18s, box-shadow .18s;
    }
    .input-wrap input:focus {
        border-color: var(--navy);
        box-shadow: 0 0 0 3px rgba(13,27,62,.1);
    }
    .input-wrap input.is-invalid { border-color: var(--red); }

    .invalid-feedback { font-size: 12px; color: var(--red); margin-top: 5px; display: block; }

    .btn-login {
        width: 100%; height: 48px;
        background: var(--dark); color: white;
        border: none; border-radius: 10px;
        font-size: 14px; font-weight: 700;
        cursor: pointer; transition: background .18s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-login:hover { background: var(--dark2); }

    .divider-row {
        text-align: center; font-size: 13px;
        color: var(--muted); margin: 16px 0 10px;
    }
    .divider-row a { font-weight: 700; color: var(--blue); text-decoration: none; }
    .divider-row a:hover { text-decoration: underline; }

    .secure-note {
        text-align: center;
        font-size: 11.5px; color: #94a3b8;
        display: flex; align-items: center; justify-content: center; gap: 5px;
        margin-top: 4px;
    }

    /* =====================================================
       FOOTER
    ===================================================== */
    .main-footer { background: #0f172a; flex-shrink: 0; padding: 48px 32px 0; }

    .footer-logo {
        width: 36px; height: 36px;
        background: linear-gradient(135deg, #1e3a5f, #0f172a);
        border: 1px solid #334155;
        border-radius: 8px; display: flex;
        align-items: center; justify-content: center;
        color: #93c5fd; font-size: 18px; flex-shrink: 0;
    }
    .footer-brand-name { font-size: 15px; font-weight: 800; color: white; line-height: 1.2; }
    .footer-brand-sub  { font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: .05em; }
    .footer-desc       { font-size: 12.5px; color: #94a3b8; line-height: 1.75; margin-bottom: 16px; }

    .footer-social {
        width: 32px; height: 32px; background: #1e293b;
        border-radius: 7px; display: inline-flex;
        align-items: center; justify-content: center;
        color: #94a3b8; text-decoration: none;
        font-size: 15px; transition: all .18s;
    }
    .footer-social:hover { background: #334155; color: white; }

    .footer-heading {
        font-size: 12px; font-weight: 700; color: #cbd5e1;
        text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px;
    }
    .footer-links        { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
    .footer-links a      { color: #94a3b8; text-decoration: none; font-size: 13px; transition: color .18s; }
    .footer-links a:hover{ color: #93c5fd; }

    .footer-contact      { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
    .footer-contact li   { display: flex; gap: 10px; font-size: 12.5px; color: #94a3b8; align-items: flex-start; }
    .footer-contact li i { color: #60a5fa; flex-shrink: 0; margin-top: 2px; }

    .footer-map { border-radius: 10px; overflow: hidden; border: 1px solid #1e293b; }

    .footer-bottom {
        border-top: 1px solid #1e293b; padding: 16px 0; margin-top: 16px;
        display: flex; justify-content: space-between; align-items: center;
        flex-wrap: wrap; gap: 10px; font-size: 12px; color: #475569;
    }
    .footer-bottom a { color: #64748b; text-decoration: none; transition: color .18s; }
    .footer-bottom a:hover { color: #94a3b8; }

    /* =====================================================
       RESPONSIVE
    ===================================================== */
    @media (max-width: 767px) {
        .left-panel  { display: none; }
        .right-panel { padding: 32px 24px; }
        .admin-nav   { padding: 0 16px; }
        .page-body   { padding: 20px 12px; }
        .main-footer { padding: 36px 16px 0; }
    }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="admin-nav">
    <a href="{{ route('home') }}" class="admin-nav-brand">
        <div class="admin-nav-icon">
            <img src="{{ asset('images/logo kota serang.png') }}" alt="Logo Kota Serang">
        </div>
        <div class="admin-nav-text">
            <span class="admin-nav-sub">Admin Portal</span>
            <span class="admin-nav-name">Kelurahan Teritih</span>
        </div>
    </a>

    {{-- Hanya tombol kembali ke beranda --}}
    <a href="{{ route('home') }}" class="btn-back-home">
        <i class="bi bi-arrow-left"></i> Kembali ke Beranda
    </a>
</nav>

{{-- PAGE BODY --}}
<div class="page-body">
    <div class="login-card">

        {{-- LEFT PANEL --}}
        <div class="left-panel">
            <div class="lp-top">
                <div class="lp-badge">
                    <i class="bi bi-shield-fill" style="font-size:11px"></i>
                    Akses Administrator
                </div>
                <h2 class="lp-title">Sistem Informasi<br>Manajemen Kelurahan</h2>
                <p class="lp-desc">
                    Platform terintegrasi untuk pengelolaan data kependudukan, layanan administrasi, dan pelaporan statistik Kelurahan Teritih.
                </p>
            </div>

            <div class="lp-bot">
                <div class="lp-features">
                    <div class="lp-feat"><i class="bi bi-people-fill"></i> Data Warga</div>
                    <div class="lp-feat"><i class="bi bi-check-circle-fill"></i> Verifikasi</div>
                    <div class="lp-feat"><i class="bi bi-bar-chart-fill"></i> Laporan</div>
                </div>
                <div class="lp-copy">
                    © {{ date('Y') }} Pemerintah Kota Serang. Internal Use Only.
                </div>
            </div>
        </div>

        {{-- RIGHT PANEL --}}
        <div class="right-panel">
            <div class="rp-title">Login Administrator</div>
            <div class="rp-subtitle">Masukkan kredensial administrator Anda untuk mengakses dashboard.</div>

            <form method="POST" action="{{ route('admin.login') }}">
                @csrf

                {{-- Username --}}
                <div class="mb-3">
                    <label class="field-label">Username</label>
                    <div class="input-wrap">
                        <i class="bi bi-person-badge ico-l"></i>
                        <input type="text"
                               name="username"
                               class="{{ $errors->has('username') ? 'is-invalid' : '' }}"
                               placeholder="Masukkan Username Admin"
                               value="{{ old('username') }}"
                               required>
                    </div>
                    @error('username')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Password --}}
                <div class="mb-3">
                    <div class="label-row">
                        <label>Kata Sandi</label>
                        <a href="#">Lupa kata sandi?</a>
                    </div>
                    <div class="input-wrap">
                        <i class="bi bi-lock ico-l"></i>
                        <input type="password"
                               name="password"
                               id="password"
                               class="{{ $errors->has('password') ? 'is-invalid' : '' }}"
                               placeholder="········"
                               required>
                        <i class="bi bi-eye-slash ico-r" id="togglePassword"></i>
                    </div>
                    @error('password')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                {{-- Remember --}}
                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember" style="font-size:13px">
                        Ingat sesi saya
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    <i class="bi bi-box-arrow-in-right"></i> Masuk Dashboard
                </button>
            </form>

            <div class="divider-row">
                Bukan Administrator? <a href="{{ route('home') }}">Kembali ke Beranda</a>
            </div>

            <div class="secure-note">
                <i class="bi bi-lock-fill" style="color:#10b981;font-size:12px"></i>
                Koneksi aman dengan enkripsi SSL 256-bit
            </div>
        </div>

    </div>
</div>

{{-- FOOTER --}}
<footer class="main-footer">
    <div class="container-fluid px-0">
        <div class="row g-4 pb-2">

            <div class="col-lg-3 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="footer-logo"><i class="bi bi-shield-fill"></i></div>
                    <div>
                        <div class="footer-brand-name">Kelurahan Teritih</div>
                        <div class="footer-brand-sub">Kota Serang</div>
                    </div>
                </div>
                <p class="footer-desc">
                    Mewujudkan tata kelola pemerintahan yang baik, bersih, dan melayani masyarakat dengan sepenuh hati.
                </p>
                <div class="d-flex gap-2">
                    <a href="#" class="footer-social"><i class="bi bi-globe2"></i></a>
                    <a href="#" class="footer-social"><i class="bi bi-envelope-fill"></i></a>
                    <a href="#" class="footer-social"><i class="bi bi-telephone-fill"></i></a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="footer-heading">Tautan Internal</div>
                <ul class="footer-links">
                    <li><a href="#">Webmail Kelurahan</a></li>
                    <li><a href="#">Sistem Kepegawaian</a></li>
                    <li><a href="#">Arsip Digital</a></li>
                    <li><a href="#">Helpdesk IT</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="footer-heading">Kontak Dukungan</div>
                <ul class="footer-contact">
                    <li>
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Jl. Raya Teritih No. 123, Kecamatan Walantaka, Kota Serang, Banten 42183</span>
                    </li>
                    <li><i class="bi bi-telephone-fill"></i><span>(0254) 123456 (Ext. 101)</span></li>
                    <li><i class="bi bi-envelope-fill"></i><span>it.support@teritih.go.id</span></li>
                </ul>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="footer-heading">Lokasi Kantor</div>
                <div class="footer-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3264.628318155724!2d106.21330817398886!3d-6.111405093875137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e41f4528991d579%3A0x30e6a19597ad1d4a!2sBalai%20Desa%20Kelurahan%20Teritih!5e1!3m2!1sid!2sid!4v1776310241900!5m2!1sid!2sid"
                    width="100%" height="140" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
            </div>

        </div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} Kelurahan Teritih, Kota Serang. Hak Cipta Dilindungi.</span>
            <div class="d-flex gap-4">
                <a href="#">Kebijakan Privasi Data</a>
                <a href="#">SOP Keamanan</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const toggle   = document.getElementById('togglePassword');
const password = document.getElementById('password');
if (toggle) {
    toggle.addEventListener('click', function () {
        password.type = password.type === 'password' ? 'text' : 'password';
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
}
</script>
</body>
</html>