<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Masyarakat – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
    :root {
        --blue:    #1c64f2;
        --blue-dk: #1a56db;
        --blue-lt: #eff6ff;
        --navy:    #0d1b3e;
        --navy2:   #1e3a5f;
        --slate:   #334155;
        --muted:   #64748b;
        --border:  #e2e8f0;
        --bg:      #f1f5f9;
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

    .login-nav {
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

    .login-nav-brand {
        display: flex; align-items: center; gap: 10px;
        text-decoration: none;
    }

    .nav-brand-icon {
        width: 40px; height: 40px;
        border-radius: 8px;
        display: flex; align-items: center; justify-content: center;
        flex-shrink: 0; overflow: hidden;
        background: transparent;
    }
    .nav-brand-icon img {
        width: 100%; height: 100%;
        object-fit: contain;
    }

    .login-nav-text { display: flex; flex-direction: column; line-height: 1.15; }
    .login-nav-sub  { font-size: 11px; font-weight: 700; letter-spacing: .12em; color: rgba(255,255,255,.6); text-transform: uppercase; }
    .login-nav-name { font-size: 18px; font-weight: 800; color: #ffffff; }

    .login-nav-links {
        display: flex; align-items: center; gap: 4px;
        list-style: none; margin: 0; padding: 0;
    }
    .login-nav-links a {
        display: block; padding: 7px 16px; border-radius: 8px;
        font-size: 15px; font-weight: 500;
        color: rgba(255,255,255,.85); text-decoration: none; transition: all .18s;
    }
    .login-nav-links a:hover { background: rgba(255,255,255,.12); color: #ffffff; }

    .login-nav-cta { display: flex; align-items: center; gap: 10px; }

    .btn-bantuan {
        font-size: 14px; font-weight: 600;
        color: rgba(255,255,255,.8); text-decoration: none;
        background: none; border: none; cursor: pointer;
        padding: 6px 4px; transition: color .18s;
    }
    .btn-bantuan:hover { color: #ffffff; }

    .btn-daftar {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 20px; border-radius: 8px;
        font-size: 15px; font-weight: 700;
        background: #1c64f2; color: white;
        border: none; text-decoration: none;
        transition: background .18s;
    }
    .btn-daftar:hover { background: #1a56db; color: white; }

    .page-body {
        flex: 1;
        display: flex;
        align-items: center;
        justify-content: center;
        padding: 36px 20px;
    }

    .login-card {
        width: 100%;
        max-width: 980px;
        background: white;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 16px 48px rgba(0,0,0,.10);
        display: flex;
        min-height: 560px;
    }

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
            linear-gradient(to top, rgba(10,20,50,.96) 0%, rgba(10,20,50,.6) 45%, rgba(10,20,50,.35) 100%),
            url('https://images.unsplash.com/photo-1486325212027-8081e485255e?w=900&q=80') center/cover no-repeat;
        z-index: 0;
    }

    .lp-top, .lp-bot { position: relative; z-index: 1; }

    .lp-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.25);
        border-radius: 20px; padding: 5px 13px;
        font-size: 11px; font-weight: 700;
        color: rgba(255,255,255,.9); margin-bottom: 20px;
    }

    .lp-title {
        font-size: 32px; font-weight: 800;
        color: white; line-height: 1.2; margin-bottom: 14px;
    }

    .lp-desc {
        font-size: 13.5px; color: rgba(255,255,255,.72); line-height: 1.7;
    }

    .lp-features { display: flex; flex-wrap: wrap; gap: 10px; margin-bottom: 14px; }
    .lp-feat {
        display: flex; align-items: center; gap: 6px;
        font-size: 12px; font-weight: 600; color: rgba(255,255,255,.85);
    }
    .lp-feat i { color: #34d399; font-size: 15px; }

    .lp-copy {
        font-size: 11px; color: rgba(255,255,255,.38);
        border-top: 1px solid rgba(255,255,255,.12); padding-top: 12px;
    }

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
        color: #94a3b8; font-size: 15px; z-index: 2; pointer-events: none;
    }
    .input-wrap .ico-r {
        position: absolute; right: 14px; top: 50%;
        transform: translateY(-50%);
        color: #94a3b8; font-size: 15px; z-index: 2;
        cursor: pointer; transition: color .18s;
    }
    .input-wrap .ico-r:hover { color: var(--blue); }

    .input-wrap input {
        display: block; width: 100%; height: 46px;
        padding: 0 42px; border-radius: 9px;
        border: 1.5px solid var(--border);
        font-size: 13.5px; font-family: inherit;
        color: var(--navy); background: white;
        outline: none; transition: border-color .18s, box-shadow .18s;
    }
    .input-wrap input:focus {
        border-color: var(--blue);
        box-shadow: 0 0 0 3px rgba(28,100,242,.12);
    }
    .input-wrap input.is-invalid { border-color: var(--red); }

    .invalid-feedback { font-size: 12px; color: var(--red); margin-top: 5px; display: block; }

    .btn-login {
        width: 100%; height: 48px;
        background: var(--blue); color: white;
        border: none; border-radius: 10px;
        font-size: 14px; font-weight: 700;
        cursor: pointer; transition: background .18s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-login:hover { background: var(--blue-dk); }

    .divider-row {
        text-align: center; font-size: 13px;
        color: var(--muted); margin: 14px 0;
    }
    .divider-row a { font-weight: 700; color: var(--blue); text-decoration: none; }
    .divider-row a:hover { text-decoration: underline; }

    .admin-box {
        border: 1.5px solid var(--border); border-radius: 12px;
        padding: 12px 16px; text-decoration: none;
        display: flex; align-items: center; gap: 12px;
        transition: all .18s; color: var(--navy);
    }
    .admin-box:hover { border-color: var(--blue); background: var(--blue-lt); color: var(--blue); }

    .admin-box-icon {
        width: 36px; height: 36px; border-radius: 9px;
        background: var(--bg); flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        font-size: 17px; color: var(--muted); transition: all .18s;
    }
    .admin-box:hover .admin-box-icon { background: var(--blue-lt); color: var(--blue); }
    .admin-box-title { font-size: 13.5px; font-weight: 700; line-height: 1.2; }
    .admin-box-sub   { font-size: 11px; color: var(--muted); }
    .admin-box-arr   { margin-left: auto; color: #cbd5e1; font-size: 16px; }

    .secure-note {
        text-align: center; margin-top: 12px;
        font-size: 11.5px; color: #94a3b8;
        display: flex; align-items: center; justify-content: center; gap: 5px;
    }

    /* FOOTER */
    .main-footer { background: #0f172a; flex-shrink: 0; padding: 48px 32px 0; }

    .footer-logo {
        width: 36px; height: 36px; background: var(--blue);
        border-radius: 8px; display: flex;
        align-items: center; justify-content: center;
        color: white; font-size: 18px; flex-shrink: 0;
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
    .footer-social:hover { background: var(--blue); color: white; }
    .footer-social.ig:hover {
        background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
        color: white;
    }

    .footer-heading {
        font-size: 12px; font-weight: 700; color: #cbd5e1;
        text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px;
    }
    .footer-links        { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
    .footer-links a      { color: #94a3b8; text-decoration: none; font-size: 13px; transition: color .18s; display: flex; align-items: center; gap: 6px; }
    .footer-links a i    { font-size: 10px; color: #475569; }
    .footer-links a:hover{ color: #60a5fa; }
    .footer-links a:hover i { color: #60a5fa; }

    .footer-contact      { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
    .footer-contact li   { display: flex; gap: 10px; font-size: 12.5px; color: #94a3b8; align-items: flex-start; }
    .footer-contact li i { color: #60a5fa; flex-shrink: 0; margin-top: 2px; }
    .footer-contact a    { color: #94a3b8; text-decoration: none; transition: color .18s; }
    .footer-contact a:hover { color: #60a5fa; }

    .footer-map { border-radius: 10px; overflow: hidden; border: 1px solid #1e293b; }

    .footer-bottom {
        border-top: 1px solid #1e293b; padding: 16px 0; margin-top: 16px;
        display: flex; justify-content: space-between; align-items: center;
        flex-wrap: wrap; gap: 10px; font-size: 12px; color: #475569;
    }
    .footer-bottom a { color: #64748b; text-decoration: none; transition: color .18s; }
    .footer-bottom a:hover { color: #94a3b8; }

    @media (max-width: 767px) {
        .left-panel      { display: none; }
        .right-panel     { padding: 32px 24px; }
        .login-nav-links { display: none; }
        .login-nav       { padding: 0 16px; }
        .page-body       { padding: 20px 12px; }
        .main-footer     { padding: 36px 16px 0; }
    }
    </style>
</head>
<body>

<nav class="login-nav">
    <a href="{{ route('home') }}" class="login-nav-brand">
        <div class="nav-brand-icon">
            <img src="{{ asset('images/logo kota serang.png') }}" alt="Logo Kota Serang">
        </div>
        <div class="login-nav-text">
            <span class="login-nav-sub">Kota Serang</span>
            <span class="login-nav-name">Kelurahan Teritih</span>
        </div>
    </a>

    <ul class="login-nav-links">
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li><a href="{{ route('profil') }}">Profil</a></li>
        <li><a href="{{ route('layanan') }}">Layanan</a></li>
        <li><a href="{{ route('demografi') }}">Informasi</a></li>
    </ul>

    <div class="login-nav-cta">
        <a href="{{ route('register') }}" class="btn-daftar">
            <i class="bi bi-person-plus-fill"></i> Daftar
        </a>
    </div>
</nav>

<div class="page-body">
    <div class="login-card">

        {{-- LEFT --}}
        <div class="left-panel">
            <div class="lp-top">
                <div class="lp-badge">
                    <i class="bi bi-shield-check-fill" style="font-size:11px"></i>
                    Pelayanan Publik Terpadu
                </div>
                <h2 class="lp-title">Selamat Datang di<br>Layanan Digital</h2>
                <p class="lp-desc">
                    Akses layanan administrasi kependudukan Kelurahan Teritih dengan mudah, cepat, dan transparan dari mana saja.
                </p>
            </div>
            <div class="lp-bot">
                <div class="lp-features">
                    <div class="lp-feat"><i class="bi bi-check-circle-fill"></i> Surat Online</div>
                    <div class="lp-feat"><i class="bi bi-check-circle-fill"></i> Pengaduan</div>
                    <div class="lp-feat"><i class="bi bi-check-circle-fill"></i> Info Warga</div>
                </div>
                <div class="lp-copy">
                    © {{ date('Y') }} Pemerintah Kota Serang. All rights reserved.
                </div>
            </div>
        </div>

        {{-- RIGHT --}}
        <div class="right-panel">
            <div class="rp-title">Login Masyarakat</div>
            <div class="rp-subtitle">Silakan masuk dengan akun yang terdaftar untuk mengakses layanan.</div>

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="mb-3">
                    <label class="field-label">Email atau NIK</label>
                    <div class="input-wrap">
                        <i class="bi bi-person ico-l"></i>
                        <input type="text"
                               name="email"
                               class="{{ $errors->has('email') ? 'is-invalid' : '' }}"
                               placeholder="Masukkan Email atau NIK anda"
                               value="{{ old('email') }}"
                               required>
                    </div>
                    @error('email')
                        <span class="invalid-feedback">{{ $message }}</span>
                    @enderror
                </div>

                <div class="mb-3">
                    <div class="label-row">
                        <label>Kata Sandi</label>
                        <a href="{{ route('password.request') }}">Lupa kata sandi?</a>
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

                <div class="form-check mb-4">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember" style="font-size:13px">
                        Ingat saya di perangkat ini
                    </label>
                </div>

                <button type="submit" class="btn-login">
                    Masuk Sekarang <i class="bi bi-arrow-right"></i>
                </button>
            </form>

            <div class="divider-row mt-3">
                Belum memiliki akun? <a href="{{ route('register') }}">Daftar Akun Baru</a>
            </div>

            <a href="{{ route('admin.login') }}" class="admin-box mt-1">
                <div class="admin-box-icon"><i class="bi bi-shield-lock"></i></div>
                <div>
                    <div class="admin-box-title">Login Admin</div>
                    <div class="admin-box-sub">Halaman khusus petugas</div>
                </div>
                <i class="bi bi-arrow-right admin-box-arr"></i>
            </a>

            <div class="secure-note">
                <i class="bi bi-lock-fill" style="color:#10b981;font-size:12px"></i>
                Koneksi Anda terenkripsi dan aman
            </div>
        </div>

    </div>
</div>

<footer class="main-footer">
    <div class="container-fluid px-0">
        <div class="row g-4 pb-2">

            <div class="col-lg-3 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="footer-logo"><i class="bi bi-bank2"></i></div>
                    <div>
                        <div class="footer-brand-name">Kelurahan Teritih</div>
                        <div class="footer-brand-sub">Kota Serang</div>
                    </div>
                </div>
                <p class="footer-desc">
                    Mewujudkan tata kelola pemerintahan yang baik, bersih, dan melayani masyarakat dengan sepenuh hati.
                </p>
                <div class="d-flex gap-2">
                    <a href="https://www.instagram.com/kelurahanteritih/" target="_blank" rel="noopener" class="footer-social ig" title="@kelurahanteritih">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="mailto:kel.teritih@serangkota.go.id" class="footer-social" title="Email">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-2 col-md-6">
                <div class="footer-heading">Tautan Cepat</div>
                <ul class="footer-links">
                    <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i> Beranda</a></li>
                    <li><a href="{{ route('profil') }}"><i class="bi bi-chevron-right"></i> Profil Kelurahan</a></li>
                    <li><a href="{{ route('layanan') }}"><i class="bi bi-chevron-right"></i> Layanan Online</a></li>
                    <li><a href="{{ route('demografi') }}"><i class="bi bi-chevron-right"></i> Informasi</a></li>
                    <li><a href="{{ route('berita') }}"><i class="bi bi-chevron-right"></i> Berita Kelurahan</a></li>
                    <li><a href="{{ route('register') }}"><i class="bi bi-chevron-right"></i> Daftar Akun</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="footer-heading">Kontak Kami</div>
                <ul class="footer-contact">
                    <li>
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Jl. Raya Kalodran - Sidapurna No. 1 Teritih, Kecamatan Walantaka, Kota Serang, Banten 42183</span>
                    </li>
                    <li><i class="bi bi-envelope-fill"></i><a href="mailto:kel.teritih@serangkota.go.id">kel.teritih@serangkota.go.id</a></li>
                    <li><i class="bi bi-instagram"></i><a href="https://www.instagram.com/kelurahanteritih/" target="_blank" rel="noopener">@kelurahanteritih</a></li>
                    <li><i class="bi bi-clock-fill"></i><span>Senin–Jumat: 08.00–16.00</span></li>
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
                <a href="#">Kebijakan Privasi</a>
                <a href="#">Syarat &amp; Ketentuan</a>
                <a href="#">Peta Situs</a>
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
