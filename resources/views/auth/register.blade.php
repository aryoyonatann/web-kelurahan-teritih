<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun – Kelurahan Teritih</title>
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
        background: var(--bg); color: var(--slate);
        font-size: 14px; min-height: 100vh;
        display: flex; flex-direction: column;
    }

    .reg-nav {
        background: #0d1b3e; border-bottom: 1px solid #1e3a5f;
        padding: 0 32px; height: 72px;
        display: flex; align-items: center; justify-content: space-between;
        position: sticky; top: 0; z-index: 1000;
        box-shadow: 0 2px 12px rgba(0,0,0,.25); flex-shrink: 0;
    }
    /* Spacer kiri dan kanan agar links selalu di tengah */
    .reg-nav-spacer { flex: 1; }
    .reg-nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }

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

    .reg-nav-text { display: flex; flex-direction: column; line-height: 1.15; }
    .reg-nav-sub  { font-size: 11px; font-weight: 700; letter-spacing: .12em; color: rgba(255,255,255,.6); text-transform: uppercase; }
    .reg-nav-name { font-size: 18px; font-weight: 800; color: #ffffff; }
    .reg-nav-links { display: flex; align-items: center; gap: 4px; list-style: none; margin: 0; padding: 0; position: absolute; left: 50%; transform: translateX(-50%); }
    .reg-nav-links a { display: block; padding: 7px 16px; border-radius: 8px; font-size: 15px; font-weight: 500; color: rgba(255,255,255,.85); text-decoration: none; transition: all .18s; }
    .reg-nav-links a:hover { background: rgba(255,255,255,.12); color: #ffffff; }
    .reg-nav-cta { display: flex; align-items: center; gap: 10px; }
    .btn-masuk {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 8px 20px; border-radius: 8px; font-size: 15px; font-weight: 700;
        background: #1c64f2; color: white; border: none; text-decoration: none; transition: background .18s;
    }
    .btn-masuk:hover { background: #1a56db; color: white; }

    .page-body { flex: 1; display: flex; align-items: center; justify-content: center; padding: 36px 20px; }

    .reg-card {
        width: 100%; max-width: 980px; background: white;
        border-radius: 20px; overflow: hidden;
        box-shadow: 0 16px 48px rgba(0,0,0,.10);
        display: flex; align-items: stretch;
    }

    .left-panel {
        flex: 0 0 42%; position: relative; overflow: hidden;
        display: flex; flex-direction: column; justify-content: space-between;
        padding: 36px 32px 28px;
    }
    .left-panel::before {
        content: ''; position: absolute; inset: 0;
        background:
            linear-gradient(to top, rgba(10,20,50,.97) 0%, rgba(10,20,50,.65) 45%, rgba(10,20,50,.35) 100%),
            url('https://images.unsplash.com/photo-1486325212027-8081e485255e?w=900&q=80') center/cover no-repeat;
        z-index: 0;
    }
    .lp-top, .lp-mid, .lp-bot { position: relative; z-index: 1; }
    .lp-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.25);
        border-radius: 20px; padding: 5px 13px;
        font-size: 11px; font-weight: 700; color: rgba(255,255,255,.9); margin-bottom: 20px;
    }
    .lp-title { font-size: 30px; font-weight: 800; color: white; line-height: 1.2; margin-bottom: 14px; }
    .lp-desc  { font-size: 13px; color: rgba(255,255,255,.72); line-height: 1.7; }
    .lp-manfaat { background: rgba(255,255,255,.1); border: 1px solid rgba(255,255,255,.18); border-radius: 12px; padding: 16px 18px; backdrop-filter: blur(4px); }
    .lp-manfaat-title { font-size: 12px; font-weight: 700; color: white; margin-bottom: 10px; }
    .lp-manfaat-item { display: flex; align-items: center; gap: 8px; font-size: 12px; color: rgba(255,255,255,.85); margin-bottom: 7px; }
    .lp-manfaat-item:last-child { margin-bottom: 0; }
    .lp-manfaat-item i { color: #34d399; font-size: 14px; flex-shrink: 0; }
    .lp-copy { font-size: 11px; color: rgba(255,255,255,.38); border-top: 1px solid rgba(255,255,255,.12); padding-top: 12px; }

    .right-panel { flex: 1; padding: 36px 44px; overflow-y: auto; }
    .rp-title    { font-size: 24px; font-weight: 800; color: var(--navy); margin-bottom: 4px; }
    .rp-subtitle { font-size: 13px; color: var(--muted); margin-bottom: 24px; line-height: 1.6; }

    .field-label { font-size: 13px; font-weight: 600; color: var(--navy); margin-bottom: 6px; display: block; }

    .input-wrap { position: relative; }
    .input-wrap .ico-l { position: absolute; left: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 15px; z-index: 2; pointer-events: none; }
    .input-wrap .ico-r { position: absolute; right: 14px; top: 50%; transform: translateY(-50%); color: #94a3b8; font-size: 15px; z-index: 2; cursor: pointer; transition: color .18s; }
    .input-wrap .ico-r:hover { color: var(--blue); }
    .input-wrap input, .input-wrap textarea {
        display: block; width: 100%; padding: 0 42px;
        border-radius: 9px; border: 1.5px solid var(--border);
        font-size: 13px; font-family: inherit; color: var(--navy); background: white;
        outline: none; transition: border-color .18s, box-shadow .18s;
    }
    .input-wrap input       { height: 44px; }
    .input-wrap textarea    { height: 80px; padding-top: 11px; padding-bottom: 11px; resize: none; line-height: 1.5; }
    .input-wrap.textarea-wrap .ico-l { top: 14px; transform: none; }
    .input-wrap input:focus, .input-wrap textarea:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(28,100,242,.12); }
    .input-wrap input.is-invalid, .input-wrap textarea.is-invalid { border-color: var(--red); }
    .invalid-feedback { font-size: 12px; color: var(--red); margin-top: 5px; display: block; }

    .error-box { background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; padding: 12px 16px; margin-bottom: 20px; }
    .error-box-title { font-size: 13px; font-weight: 700; color: #dc2626; margin-bottom: 6px; display: flex; align-items: center; gap: 6px; }
    .error-box ul { margin: 0; padding-left: 18px; }
    .error-box li { font-size: 12.5px; color: #dc2626; }

    .btn-register {
        width: 100%; height: 48px; background: var(--blue); color: white;
        border: none; border-radius: 10px; font-size: 14px; font-weight: 700;
        cursor: pointer; transition: background .18s;
        display: flex; align-items: center; justify-content: center; gap: 8px;
    }
    .btn-register:hover { background: var(--blue-dk); }

    .divider-row { text-align: center; font-size: 13px; color: var(--muted); margin: 14px 0 4px; }
    .divider-row a { font-weight: 700; color: var(--blue); text-decoration: none; }
    .divider-row a:hover { text-decoration: underline; }

    .secure-note {
        border: 1.5px solid var(--border); border-radius: 10px;
        padding: 10px 16px; text-align: center; font-size: 12px; color: var(--muted);
        display: flex; align-items: center; justify-content: center; gap: 6px; margin-top: 10px;
    }
    .secure-note i { color: var(--green); font-size: 14px; }

    /* MODAL SYARAT & KETENTUAN */
    .tnc-overlay {
        position: fixed; inset: 0; z-index: 9999;
        background: rgba(13,27,62,.55); backdrop-filter: blur(4px);
        display: flex; align-items: center; justify-content: center; padding: 20px;
        opacity: 0; pointer-events: none; transition: opacity .2s;
    }
    .tnc-overlay.show { opacity: 1; pointer-events: all; }
    .tnc-modal {
        background: white; border-radius: 20px;
        width: 100%; max-width: 600px; max-height: 85vh;
        display: flex; flex-direction: column;
        box-shadow: 0 24px 64px rgba(0,0,0,.2);
        transform: translateY(20px) scale(.97); transition: transform .25s;
    }
    .tnc-overlay.show .tnc-modal { transform: translateY(0) scale(1); }
    .tnc-modal-header {
        padding: 20px 24px 16px;
        border-bottom: 1px solid var(--border);
        display: flex; align-items: center; justify-content: space-between; flex-shrink: 0;
    }
    .tnc-modal-title { font-size: 17px; font-weight: 800; color: var(--navy); display: flex; align-items: center; gap: 9px; }
    .tnc-modal-title i { color: var(--blue); font-size: 20px; }
    .tnc-modal-close {
        width: 32px; height: 32px; border-radius: 8px; border: 1.5px solid var(--border);
        background: white; display: flex; align-items: center; justify-content: center;
        cursor: pointer; font-size: 16px; color: var(--muted); transition: all .18s;
    }
    .tnc-modal-close:hover { background: #fef2f2; border-color: #fecaca; color: var(--red); }
    .tnc-modal-body { padding: 24px; overflow-y: auto; flex: 1; }
    .tnc-section { margin-bottom: 22px; }
    .tnc-section:last-child { margin-bottom: 0; }
    .tnc-section-title {
        font-size: 13.5px; font-weight: 700; color: var(--navy);
        display: flex; align-items: center; gap: 8px; margin-bottom: 10px;
        padding-bottom: 8px; border-bottom: 1px solid var(--border);
    }
    .tnc-section-title i { color: var(--blue); font-size: 15px; }
    .tnc-section p { font-size: 13px; color: var(--slate); line-height: 1.75; margin-bottom: 8px; }
    .tnc-section p:last-child { margin-bottom: 0; }
    .tnc-section ul { margin: 6px 0 0 18px; padding: 0; }
    .tnc-section ul li { font-size: 13px; color: var(--slate); line-height: 1.7; margin-bottom: 4px; }
    .tnc-modal-footer {
        padding: 16px 24px; border-top: 1px solid var(--border);
        display: flex; gap: 10px; flex-shrink: 0;
    }
    .btn-tnc-setuju {
        flex: 1; height: 44px; background: var(--blue); color: white;
        border: none; border-radius: 10px; font-size: 13.5px; font-weight: 700;
        cursor: pointer; transition: background .18s; font-family: inherit;
        display: flex; align-items: center; justify-content: center; gap: 6px;
    }
    .btn-tnc-setuju:hover { background: var(--blue-dk); }
    .btn-tnc-tutup {
        padding: 0 20px; height: 44px; border-radius: 10px;
        border: 1.5px solid var(--border); background: white;
        font-size: 13.5px; font-weight: 600; color: var(--slate);
        cursor: pointer; transition: all .18s; font-family: inherit;
    }
    .btn-tnc-tutup:hover { background: var(--bg); border-color: #cbd5e1; }

    /* FOOTER */
    .main-footer { background: #0f172a; flex-shrink: 0; padding: 48px 32px 0; }
    .footer-logo { width: 36px; height: 36px; background: var(--blue); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; flex-shrink: 0; }
    .footer-brand-name { font-size: 15px; font-weight: 800; color: white; line-height: 1.2; }
    .footer-brand-sub  { font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: .05em; }
    .footer-desc       { font-size: 12.5px; color: #94a3b8; line-height: 1.75; margin-bottom: 16px; }
    .footer-social { width: 32px; height: 32px; background: #1e293b; border-radius: 7px; display: inline-flex; align-items: center; justify-content: center; color: #94a3b8; text-decoration: none; font-size: 15px; transition: all .18s; }
    .footer-social:hover { background: var(--blue); color: white; }
    .footer-social.ig:hover { background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888); color: white; }
    .footer-heading { font-size: 12px; font-weight: 700; color: #cbd5e1; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px; }
    .footer-links { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
    .footer-links a { color: #94a3b8; text-decoration: none; font-size: 13px; transition: color .18s; display: flex; align-items: center; gap: 6px; }
    .footer-links a i { font-size: 10px; color: #475569; }
    .footer-links a:hover { color: #60a5fa; }
    .footer-links a:hover i { color: #60a5fa; }
    .footer-contact { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
    .footer-contact li { display: flex; gap: 10px; font-size: 12.5px; color: #94a3b8; align-items: flex-start; }
    .footer-contact li i { color: #60a5fa; flex-shrink: 0; margin-top: 2px; }
    .footer-contact a { color: #94a3b8; text-decoration: none; transition: color .18s; }
    .footer-contact a:hover { color: #60a5fa; }
    .footer-map { border-radius: 10px; overflow: hidden; border: 1px solid #1e293b; }
    .footer-bottom { border-top: 1px solid #1e293b; padding: 16px 0; margin-top: 16px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; font-size: 12px; color: #475569; }
    .footer-bottom a { color: #64748b; text-decoration: none; transition: color .18s; }
    .footer-bottom a:hover { color: #94a3b8; }

    @media (max-width: 767px) {
        .left-panel { display: none; }
        .right-panel { padding: 28px 20px; }
        .reg-nav-links { display: none; }
        .reg-nav { padding: 0 16px; }
        .page-body { padding: 20px 12px; }
        .main-footer { padding: 36px 16px 0; }
    }
    </style>
</head>
<body>

<nav class="reg-nav">
    <a href="{{ route('home') }}" class="reg-nav-brand">
        <div class="nav-brand-icon">
            <img src="{{ asset('images/logo kota serang.png') }}" alt="Logo Kota Serang">
        </div>
        <div class="reg-nav-text">
            <span class="reg-nav-sub">Kota Serang</span>
            <span class="reg-nav-name">Kelurahan Teritih</span>
        </div>
    </a>
    <div class="reg-nav-spacer"></div>

    <ul class="reg-nav-links">
        <li><a href="{{ route('home') }}">Beranda</a></li>
        <li><a href="{{ route('profil') }}">Profil</a></li>
        <li><a href="{{ route('layanan') }}">Layanan</a></li>
        <li><a href="{{ route('demografi') }}">Informasi</a></li>
    </ul>

    <div class="reg-nav-spacer"></div>

</nav>

<div class="page-body">
    <div class="reg-card">

        <div class="left-panel">
            <div class="lp-top">
                <div class="lp-badge"><i class="bi bi-person-plus-fill" style="font-size:11px"></i> Registrasi Warga Baru</div>
                <h2 class="lp-title">Mulai Akses<br>Layanan Digital</h2>
                <p class="lp-desc">Daftarkan diri Anda untuk menikmati kemudahan layanan administrasi kependudukan tanpa antri.</p>
            </div>
            <div class="lp-mid">
                <div class="lp-manfaat">
                    <div class="lp-manfaat-title">Manfaat Akun Terdaftar:</div>
                    <div class="lp-manfaat-item"><i class="bi bi-check-circle-fill"></i> Pantau status pengajuan surat realtime</div>
                    <div class="lp-manfaat-item"><i class="bi bi-check-circle-fill"></i> Riwayat pelayanan tersimpan rapi</div>
                    <div class="lp-manfaat-item"><i class="bi bi-check-circle-fill"></i> Notifikasi langsung ke perangkat Anda</div>
                </div>
            </div>
            <div class="lp-bot">
                <div class="lp-copy">© {{ date('Y') }} Pemerintah Kota Serang. All rights reserved.</div>
            </div>
        </div>

        <div class="right-panel">
            <div class="rp-title">Pendaftaran Akun</div>
            <div class="rp-subtitle">Lengkapi data diri Anda di bawah ini dengan benar.</div>

            @if($errors->any())
            <div class="error-box">
                <div class="error-box-title"><i class="bi bi-exclamation-circle-fill"></i> Pendaftaran gagal, periksa kembali:</div>
                <ul>@foreach($errors->all() as $error)<li>{{ $error }}</li>@endforeach</ul>
            </div>
            @endif

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="mb-3">
                    <label class="field-label">Nama Lengkap</label>
                    <div class="input-wrap">
                        <i class="bi bi-person ico-l"></i>
                        <input type="text" name="nama" class="{{ $errors->has('nama') ? 'is-invalid' : '' }}" placeholder="Nama sesuai KTP" value="{{ old('nama') }}" required>
                    </div>
                    @error('nama') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="field-label">NIK</label>
                    <div class="input-wrap">
                        <i class="bi bi-credit-card ico-l"></i>
                        <input type="text" name="nik" class="{{ $errors->has('nik') ? 'is-invalid' : '' }}" placeholder="Masukkan 16 digit NIK" value="{{ old('nik') }}" required maxlength="16">
                    </div>
                    @error('nik') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="field-label">Alamat</label>
                    <div class="input-wrap textarea-wrap">
                        <i class="bi bi-house ico-l"></i>
                        <textarea name="alamat" class="{{ $errors->has('alamat') ? 'is-invalid' : '' }}" placeholder="Alamat lengkap sesuai KTP" required>{{ old('alamat') }}</textarea>
                    </div>
                    @error('alamat') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="field-label">No. Telepon</label>
                    <div class="input-wrap">
                        <i class="bi bi-telephone ico-l"></i>
                        <input type="text" name="no_hp" class="{{ $errors->has('no_hp') ? 'is-invalid' : '' }}" placeholder="08xxxxxxxxxx" value="{{ old('no_hp') }}" required>
                    </div>
                    @error('no_hp') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="field-label">Alamat Email</label>
                    <div class="input-wrap">
                        <i class="bi bi-envelope ico-l"></i>
                        <input type="email" name="email" class="{{ $errors->has('email') ? 'is-invalid' : '' }}" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                    </div>
                    @error('email') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="row g-3 mb-3">
                    <div class="col-md-6">
                        <label class="field-label">Tempat Lahir</label>
                        <div class="input-wrap">
                            <i class="bi bi-geo-alt ico-l"></i>
                            <input type="text" name="tempat_lahir" placeholder="Kota kelahiran" value="{{ old('tempat_lahir') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="field-label">Tanggal Lahir</label>
                        <div class="input-wrap">
                            <i class="bi bi-calendar3 ico-l"></i>
                            <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir') }}">
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="field-label">Kata Sandi</label>
                    <div class="input-wrap">
                        <i class="bi bi-lock ico-l"></i>
                        <input type="password" name="password" id="password" class="{{ $errors->has('password') ? 'is-invalid' : '' }}" placeholder="Minimal 8 karakter" required>
                        <i class="bi bi-eye-slash ico-r" id="togglePassword"></i>
                    </div>
                    @error('password') <span class="invalid-feedback">{{ $message }}</span> @enderror
                </div>

                <div class="mb-3">
                    <label class="field-label">Ulangi Kata Sandi</label>
                    <div class="input-wrap">
                        <i class="bi bi-shield-lock ico-l"></i>
                        <input type="password" name="password_confirmation" id="password2" placeholder="Masukkan ulang kata sandi" required>
                        <i class="bi bi-eye-slash ico-r" id="togglePassword2"></i>
                    </div>
                </div>

                <div class="form-check mb-4" style="margin-left:2px">
                    <input class="form-check-input" type="checkbox" id="syarat" required>
                    <label class="form-check-label" for="syarat" style="font-size:13px;color:var(--slate)">
                        Saya menyatakan data yang diisi adalah benar dan menyetujui
                        <a href="#" id="btnBukaTnc" style="color:var(--blue);font-weight:600;text-decoration:none" onclick="bukaModal(event)">Syarat &amp; Ketentuan</a>
                        layanan Kelurahan Teritih.
                    </label>
                </div>

                <button type="submit" class="btn-register">
                    <i class="bi bi-person-plus-fill"></i> Daftar Sekarang
                </button>
            </form>

            <div class="divider-row">
                Sudah memiliki akun terdaftar? <a href="{{ route('login') }}">Masuk Disini</a>
            </div>

            <div class="secure-note">
                <i class="bi bi-shield-fill-check"></i>
                Data Anda dilindungi enkripsi SSL 256-bit
            </div>
        </div>

    </div>
</div>

{{-- MODAL SYARAT & KETENTUAN --}}
<div class="tnc-overlay" id="tncOverlay">
    <div class="tnc-modal">
        <div class="tnc-modal-header">
            <div class="tnc-modal-title">
                <i class="bi bi-file-earmark-text-fill"></i>
                Syarat &amp; Ketentuan Layanan
            </div>
            <button class="tnc-modal-close" onclick="tutupModal()"><i class="bi bi-x-lg"></i></button>
        </div>
        <div class="tnc-modal-body">
            <div class="tnc-section">
                <div class="tnc-section-title"><i class="bi bi-info-circle-fill"></i> 1. Ketentuan Umum</div>
                <p>Dengan mendaftarkan diri sebagai pengguna Portal Layanan Digital Kelurahan Teritih, Anda menyatakan telah membaca, memahami, dan menyetujui seluruh syarat dan ketentuan yang berlaku.</p>
                <p>Portal ini merupakan layanan resmi yang dikelola oleh Pemerintah Kelurahan Teritih, Kecamatan Walantaka, Kota Serang, Banten.</p>
            </div>
            <div class="tnc-section">
                <div class="tnc-section-title"><i class="bi bi-person-check-fill"></i> 2. Persyaratan Pendaftaran</div>
                <ul>
                    <li>Pendaftar adalah Warga Negara Indonesia (WNI) yang berdomisili di wilayah Kelurahan Teritih.</li>
                    <li>Data yang dimasukkan harus sesuai dengan dokumen kependudukan resmi (KTP/KK).</li>
                    <li>Setiap warga hanya diperbolehkan memiliki satu akun terdaftar.</li>
                    <li>NIK yang digunakan wajib valid dan belum pernah didaftarkan sebelumnya.</li>
                </ul>
            </div>
            <div class="tnc-section">
                <div class="tnc-section-title"><i class="bi bi-shield-lock-fill"></i> 3. Keamanan Akun</div>
                <ul>
                    <li>Pengguna bertanggung jawab penuh atas kerahasiaan kata sandi akun.</li>
                    <li>Jangan membagikan kata sandi kepada siapapun, termasuk petugas kelurahan.</li>
                    <li>Segera hubungi pihak kelurahan jika akun Anda diduga disalahgunakan.</li>
                    <li>Kelurahan Teritih tidak akan pernah meminta kata sandi Anda melalui telepon atau pesan.</li>
                </ul>
            </div>
            <div class="tnc-section">
                <div class="tnc-section-title"><i class="bi bi-database-fill-lock"></i> 4. Privasi &amp; Data Pribadi</div>
                <p>Data pribadi yang Anda berikan akan digunakan semata-mata untuk keperluan pelayanan administrasi kependudukan Kelurahan Teritih.</p>
                <ul>
                    <li>Data Anda disimpan dengan enkripsi dan tidak akan dijual atau dibagikan kepada pihak ketiga.</li>
                    <li>Data hanya dapat diakses oleh petugas kelurahan yang berwenang.</li>
                    <li>Anda berhak meminta koreksi atau penghapusan data dengan menghubungi kantor kelurahan.</li>
                </ul>
            </div>
            <div class="tnc-section">
                <div class="tnc-section-title"><i class="bi bi-file-earmark-check-fill"></i> 5. Penggunaan Layanan</div>
                <ul>
                    <li>Layanan pengajuan surat hanya dapat dilakukan pada hari dan jam kerja.</li>
                    <li>Permohonan yang diajukan akan diproses dalam 1–3 hari kerja.</li>
                    <li>Pengguna wajib melengkapi dokumen pendukung yang dipersyaratkan.</li>
                    <li>Permohonan dengan data tidak lengkap atau tidak valid dapat ditolak oleh petugas.</li>
                    <li>Penyalahgunaan layanan dapat mengakibatkan penonaktifan akun.</li>
                </ul>
            </div>
            <div class="tnc-section">
                <div class="tnc-section-title"><i class="bi bi-chat-dots-fill"></i> 6. Kontak &amp; Pengaduan</div>
                <p>Jika Anda memiliki pertanyaan, kendala, atau pengaduan terkait layanan ini, silakan hubungi:</p>
                <ul>
                    <li>Email: <strong>kel.teritih@serangkota.go.id</strong></li>
                    <li>Instagram: <strong>@kelurahanteritih</strong></li>
                    <li>Datang langsung ke Kantor Kelurahan Teritih pada jam kerja (Senin–Jumat, 08.00–16.00)</li>
                </ul>
            </div>
            <div class="tnc-section">
                <div class="tnc-section-title"><i class="bi bi-patch-check-fill"></i> 7. Persetujuan</div>
                <p>Dengan mengklik tombol <strong>"Saya Setuju"</strong> di bawah atau mencentang kotak persetujuan pada form pendaftaran, Anda menyatakan telah membaca dan menyetujui seluruh syarat dan ketentuan di atas.</p>
            </div>
        </div>
        <div class="tnc-modal-footer">
            <button class="btn-tnc-tutup" onclick="tutupModal()">Tutup</button>
            <button class="btn-tnc-setuju" onclick="setujuTnc()">
                <i class="bi bi-check-circle-fill"></i> Saya Setuju
            </button>
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
                <p class="footer-desc">Mewujudkan tata kelola pemerintahan yang baik, bersih, dan melayani masyarakat dengan sepenuh hati.</p>
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
                    <li><a href="{{ route('login') }}"><i class="bi bi-chevron-right"></i> Login Masyarakat</a></li>
                </ul>
            </div>

            <div class="col-lg-4 col-md-6">
                <div class="footer-heading">Kontak Kami</div>
                <ul class="footer-contact">
                    <li><i class="bi bi-geo-alt-fill"></i><span>Jl. Raya Kalodran - Sidapurna No. 1 Teritih, Kecamatan Walantaka, Kota Serang, Banten 42183</span></li>
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
                <a href="#" onclick="bukaModal(event)">Syarat &amp; Ketentuan</a>
                <a href="#">Peta Situs</a>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function makeToggle(inputId, toggleId) {
    const input  = document.getElementById(inputId);
    const toggle = document.getElementById(toggleId);
    if (!input || !toggle) return;
    toggle.addEventListener('click', function () {
        input.type = input.type === 'password' ? 'text' : 'password';
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
    });
}
makeToggle('password',  'togglePassword');
makeToggle('password2', 'togglePassword2');

function bukaModal(e) {
    if (e) e.preventDefault();
    document.getElementById('tncOverlay').classList.add('show');
    document.body.style.overflow = 'hidden';
}
function tutupModal() {
    document.getElementById('tncOverlay').classList.remove('show');
    document.body.style.overflow = '';
}
function setujuTnc() {
    const cb = document.getElementById('syarat');
    if (cb) cb.checked = true;
    tutupModal();
}
document.getElementById('tncOverlay').addEventListener('click', function(e) {
    if (e.target === this) tutupModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') tutupModal();
});
</script>
</body>
</html>