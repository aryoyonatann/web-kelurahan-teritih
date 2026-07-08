<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil – Kelurahan Teritih</title>
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
        --orange:  #f59e0b;
        --red:     #ef4444;
    }
    *, *::before, *::after { box-sizing: border-box; }
    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: var(--bg); color: var(--slate);
        font-size: 14px; line-height: 1.6;
        min-height: 100vh; display: flex; flex-direction: column;
    }
    .page-header {
        background: white; border-bottom: 1px solid var(--border);
        padding: 22px 32px;
    }
    .page-header-inner { display: flex; align-items: flex-start; justify-content: space-between; flex-wrap: wrap; gap: 10px; }
    .page-header-title { font-size: 22px; font-weight: 800; color: var(--navy); margin: 0 0 3px; }
    .page-header-sub   { font-size: 13px; color: var(--muted); margin: 0; }
    .breadcrumb-custom { display: flex; align-items: center; gap: 5px; font-size: 12.5px; color: var(--muted); margin-top: 4px; }
    .breadcrumb-custom a { color: var(--muted); text-decoration: none; }
    .breadcrumb-custom a:hover { color: var(--blue); }
    .breadcrumb-custom .current { color: var(--navy); font-weight: 600; }
    .content-area { flex: 1; padding: 28px 32px 48px; }
    .profile-sidebar-card {
        background: white; border: 1px solid var(--border); border-radius: 16px; overflow: hidden;
    }
    .profile-cover {
        height: 90px;
        background: linear-gradient(135deg, #1c64f2, #1e3a5f);
        position: relative;
    }
    .profile-avatar-wrap {
        position: relative; display: inline-block;
        margin: -44px 0 0 24px;
    }
    .profile-avatar {
        width: 88px; height: 88px; border-radius: 50%;
        background: linear-gradient(135deg, #1c64f2, #1e3a5f);
        border: 4px solid white;
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 30px; font-weight: 800;
        overflow: hidden; cursor: pointer; position: relative;
    }
    .profile-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .profile-avatar-overlay {
        position: absolute; inset: 0; border-radius: 50%;
        background: rgba(0,0,0,.45);
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 18px; opacity: 0; transition: opacity .2s;
    }
    .profile-avatar:hover .profile-avatar-overlay { opacity: 1; }
    .profile-info { padding: 12px 24px 20px; }
    .profile-name  { font-size: 17px; font-weight: 800; color: var(--navy); margin-bottom: 2px; }
    .profile-email { font-size: 12.5px; color: var(--muted); margin-bottom: 14px; }
    .profile-meta { display: flex; gap: 20px; padding: 12px 0; border-top: 1px solid var(--border); margin-top: 4px; }
    .meta-item { text-align: center; }
    .meta-label { font-size: 10px; font-weight: 700; color: var(--muted); text-transform: uppercase; letter-spacing: .06em; }
    .meta-value { font-size: 13px; font-weight: 700; color: var(--navy); }
    .status-badge {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700;
        background: #ecfdf5; color: #059669;
    }
    .sidebar-menu { border-top: 1px solid var(--border); }
    .sidebar-menu-item {
        display: flex; align-items: center; gap: 10px;
        padding: 12px 24px; font-size: 13.5px; font-weight: 500; color: var(--slate);
        text-decoration: none; transition: all .18s; cursor: pointer;
        border-left: 3px solid transparent;
    }
    .sidebar-menu-item:hover { background: var(--bg); color: var(--navy); }
    .sidebar-menu-item.active { color: var(--blue); font-weight: 700; border-left-color: var(--blue); background: var(--blue-lt); }
    .sidebar-menu-item i { font-size: 16px; }
    .form-card {
        background: white; border: 1px solid var(--border); border-radius: 16px;
        overflow: hidden; margin-bottom: 20px;
    }
    .form-card:last-of-type { margin-bottom: 0; }
    .form-card-header {
        padding: 18px 24px; border-bottom: 1px solid var(--border);
        display: flex; align-items: flex-start; gap: 12px;
    }
    .form-card-icon {
        width: 38px; height: 38px; border-radius: 10px; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center; font-size: 18px;
    }
    .form-card-title { font-size: 15px; font-weight: 800; color: var(--navy); margin-bottom: 2px; }
    .form-card-sub   { font-size: 12px; color: var(--muted); }
    .form-card-body  { padding: 22px 24px; }
    .form-label-custom {
        font-size: 12.5px; font-weight: 700; color: var(--navy); display: block; margin-bottom: 6px;
    }
    .form-label-custom .optional { font-weight: 500; color: var(--muted); font-size: 11px; }
    .form-label-custom .readonly-tag {
        font-size: 10px; font-weight: 600; color: var(--orange);
        background: #fff7ed; border: 1px solid #fed7aa;
        border-radius: 4px; padding: 1px 6px; margin-left: 6px;
    }
    .form-control-custom {
        width: 100%; padding: 10px 14px; border-radius: 9px;
        border: 1.5px solid var(--border); background: white;
        font-family: 'Plus Jakarta Sans', sans-serif;
        font-size: 13.5px; color: var(--slate);
        transition: border-color .18s, box-shadow .18s; outline: none;
    }
    .form-control-custom::placeholder { color: #cbd5e1; }
    .form-control-custom:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(28,100,242,.1); }
    .form-control-custom:disabled { background: #f8fafc; color: var(--muted); cursor: not-allowed; }
    .form-control-custom[readonly] { background: #f8fafc; color: var(--muted); cursor: not-allowed; }
    /* Field password tetap putih meski readonly sementara */
    #pwCurrent, #pwNew, #pwConfirm {
        background: white !important;
        color: var(--slate) !important;
        cursor: text !important;
        opacity: 1 !important;
    }
    .input-icon-wrap { position: relative; }
    .input-icon-wrap > i {
        position: absolute; left: 13px; top: 50%; transform: translateY(-50%);
        color: var(--muted); font-size: 14px; pointer-events: none;
    }
    .input-icon-wrap .form-control-custom { padding-left: 36px; }
    textarea.form-control-custom { resize: vertical; min-height: 80px; }
    .pw-toggle {
        position: absolute; right: 13px; top: 50%; transform: translateY(-50%);
        color: var(--muted); cursor: pointer; font-size: 15px;
    }
    .pw-toggle:hover { color: var(--navy); }
    .foto-upload-area {
        border: 2px dashed var(--border); border-radius: 12px;
        padding: 16px; display: flex; align-items: center; gap: 16px;
        background: var(--bg); cursor: pointer; transition: border-color .18s;
    }
    .foto-upload-area:hover { border-color: var(--blue); }
    .foto-preview-sm {
        width: 60px; height: 60px; border-radius: 50%;
        background: linear-gradient(135deg, var(--blue), var(--navy2));
        display: flex; align-items: center; justify-content: center;
        color: white; font-size: 20px; font-weight: 800; flex-shrink: 0;
        overflow: hidden; border: 3px solid white; box-shadow: 0 2px 8px rgba(0,0,0,.1);
    }
    .foto-preview-sm img { width: 100%; height: 100%; object-fit: cover; }
    .foto-info { flex: 1; }
    .foto-info-title { font-size: 13px; font-weight: 700; color: var(--navy); margin-bottom: 3px; }
    .foto-info-desc  { font-size: 11.5px; color: var(--muted); }
    .btn-ganti-foto {
        padding: 7px 16px; border-radius: 8px; font-size: 12.5px; font-weight: 700;
        border: 1.5px solid var(--border); background: white; color: var(--navy);
        cursor: pointer; transition: all .18s; white-space: nowrap;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-ganti-foto:hover { border-color: var(--blue); color: var(--blue); }
    .action-bar {
        background: white; border: 1px solid var(--border); border-radius: 12px;
        padding: 16px 24px; margin-top: 0;
        display: flex; align-items: center; justify-content: flex-end; gap: 10px;
    }
    .btn-batal {
        padding: 9px 22px; border-radius: 9px;
        font-size: 13.5px; font-weight: 700;
        border: 1.5px solid var(--border); background: white; color: var(--slate);
        cursor: pointer; transition: all .18s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-batal:hover { border-color: var(--slate); color: var(--navy); }
    .btn-simpan {
        padding: 9px 24px; border-radius: 9px;
        font-size: 13.5px; font-weight: 700;
        background: var(--blue); color: white; border: none;
        cursor: pointer; transition: background .18s;
        font-family: 'Plus Jakarta Sans', sans-serif;
        display: inline-flex; align-items: center; gap: 7px;
    }
    .btn-simpan:hover { background: var(--blue-dk); }
    .alert-sukses {
        background: #ecfdf5; border: 1px solid #a7f3d0; border-radius: 10px;
        padding: 12px 16px; display: flex; align-items: center; gap: 10px;
        font-size: 13px; font-weight: 600; color: #065f46; margin-bottom: 20px;
    }
    .alert-sukses i { font-size: 18px; color: var(--green); }
    .alert-error {
        background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px;
        padding: 12px 16px; display: flex; align-items: flex-start; gap: 10px;
        font-size: 13px; color: #b91c1c; margin-bottom: 20px;
    }
    .alert-error i { font-size: 16px; flex-shrink: 0; margin-top: 1px; }
    @media (max-width: 991px) {
        .page-header   { padding: 16px; }
        .content-area  { padding: 16px 16px 36px; }
        .form-card-body { padding: 16px; }
        .action-bar    { padding: 14px 16px; }
    }
    </style>
</head>
<body>

@include('partials.navbar')

<div class="page-header">
    <div class="page-header-inner">
        <div>
            <h1 class="page-header-title">Pengaturan Profil</h1>
            <p class="page-header-sub">Kelola informasi pribadi, alamat domisili, dan keamanan akun Anda.</p>
        </div>
        <div class="breadcrumb-custom">
            <a href="{{ route('home') }}">Beranda</a>
            <i class="bi bi-chevron-right" style="font-size:10px"></i>
            <span class="current">Pengaturan Profil</span>
        </div>
    </div>
</div>

<div class="content-area">

    @if(session('success'))
        <div class="alert-sukses">
            <i class="bi bi-check-circle-fill"></i>
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="alert-error">
            <i class="bi bi-exclamation-triangle-fill"></i>
            <div>
                @foreach($errors->all() as $err)
                    <div>{{ $err }}</div>
                @endforeach
            </div>
        </div>
    @endif

    <div class="row g-4">

        {{-- SIDEBAR KIRI --}}
        <div class="col-lg-3">
            <div class="profile-sidebar-card">
                <div class="profile-cover"></div>
                <div class="profile-avatar-wrap">
                    <div class="profile-avatar" id="avatarPreviewLarge">
                        @if(Auth::user()->foto ?? null)
                            <img id="avatarImg" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="">
                        @else
                            @php
                                $nm = Auth::user()->nama ?? Auth::user()->name ?? 'U';
                                $p  = explode(' ', $nm);
                                echo '<span id="avatarInitials">' . strtoupper(substr($p[0],0,1)) . strtoupper(substr($p[1]??'',0,1)) . '</span>';
                            @endphp
                        @endif
                        <div class="profile-avatar-overlay"><i class="bi bi-camera-fill"></i></div>
                    </div>
                </div>
                <div class="profile-info">
                    <div class="profile-name">{{ Auth::user()->nama ?? Auth::user()->name }}</div>
                    <div class="profile-email">{{ Auth::user()->email }}</div>
                    <div class="d-flex align-items-center gap-2 flex-wrap mb-2">
                        <span class="status-badge"><i class="bi bi-check-circle-fill"></i> Terverifikasi</span>
                    </div>
                    <div class="profile-meta">
                        <div class="meta-item">
                            <div class="meta-label">Status</div>
                            <div class="meta-value" style="color:#059669">Aktif</div>
                        </div>
                        <div class="meta-item">
                            <div class="meta-label">Terdaftar</div>
                            <div class="meta-value">{{ Auth::user()->created_at?->format('M Y') ?? 'Jan 2023' }}</div>
                        </div>
                    </div>
                </div>
                <div class="sidebar-menu">
                    <a href="#seksi-pribadi" class="sidebar-menu-item active" onclick="setActive(this)">
                        <i class="bi bi-person-fill"></i> Informasi Pribadi
                    </a>
                    <a href="#seksi-domisili" class="sidebar-menu-item" onclick="setActive(this)">
                        <i class="bi bi-house-fill"></i> Alamat Domisili
                    </a>
                    <a href="#seksi-sandi" class="sidebar-menu-item" onclick="setActive(this)">
                        <i class="bi bi-shield-lock-fill"></i> Keamanan Akun
                    </a>
                </div>
            </div>
        </div>

        {{-- FORM KANAN --}}
        <div class="col-lg-9">
            <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data" id="profileForm">
                @csrf
                @method('PUT')

                {{-- ══ INFORMASI PRIBADI ══ --}}
                <div class="form-card" id="seksi-pribadi">
                    <div class="form-card-header">
                        <div class="form-card-icon" style="background:#eff6ff;color:#1c64f2">
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <div class="form-card-title">Informasi Pribadi</div>
                            <div class="form-card-sub">Data identitas diri Anda yang terdaftar.</div>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label-custom">Foto Profil <span class="optional">(opsional)</span></label>
                                <div class="foto-upload-area" onclick="document.getElementById('fotoInput').click()">
                                    <div class="foto-preview-sm" id="fotoPreviewSm">
                                        @if(Auth::user()->foto ?? null)
                                            <img id="fotoPreviewImg" src="{{ asset('storage/' . Auth::user()->foto) }}" alt="">
                                        @else
                                            @php
                                                $nm2 = Auth::user()->nama ?? Auth::user()->name ?? 'U';
                                                $p2  = explode(' ', $nm2);
                                                echo strtoupper(substr($p2[0],0,1)) . strtoupper(substr($p2[1]??'',0,1));
                                            @endphp
                                        @endif
                                    </div>
                                    <div class="foto-info">
                                        <div class="foto-info-title">Upload foto profil</div>
                                        <div class="foto-info-desc">JPG, PNG, GIF maks. 2MB</div>
                                    </div>
                                    <button type="button" class="btn-ganti-foto">
                                        <i class="bi bi-upload me-1"></i> Pilih Foto
                                    </button>
                                </div>
                                <input type="file" name="foto" id="fotoInput" accept="image/*"
                                       onchange="previewFoto(this)" style="display:none">
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control-custom"
                                    value="{{ old('nama', Auth::user()->nama ?? Auth::user()->name) }}"
                                    placeholder="Masukkan nama lengkap" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Tempat Lahir</label>
                                <input type="text" name="tempat_lahir" class="form-control-custom"
                                    value="{{ old('tempat_lahir', Auth::user()->tempat_lahir ?? '') }}"
                                    placeholder="Kota kelahiran">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Tanggal Lahir</label>
                                <input type="date" name="tanggal_lahir" class="form-control-custom"
                                    value="{{ old('tanggal_lahir', Auth::user()->tanggal_lahir ? \Carbon\Carbon::parse(Auth::user()->tanggal_lahir)->format('Y-m-d') : '') }}">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">
                                    NIK <span class="readonly-tag">Tidak dapat diubah</span>
                                </label>
                                <input type="text" class="form-control-custom"
                                    value="{{ Auth::user()->nik ?? '-' }}" disabled>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Nomor Telepon / WA</label>
                                <input type="text" name="no_hp" class="form-control-custom"
                                    value="{{ old('no_hp', Auth::user()->no_hp ?? '') }}"
                                    placeholder="08xxxxxxxxxx">
                            </div>

                            <div class="col-12">
                                <label class="form-label-custom">Email <span style="font-weight:400;color:#94a3b8;font-size:12px">(Opsional)</span></label>
                                <div class="input-icon-wrap">
                                    <i class="bi bi-envelope-fill"></i>
                                    <input type="email" name="email" class="form-control-custom"
                                        value="{{ old('email', Auth::user()->email) }}"
                                        placeholder="nama@email.com (boleh dikosongkan)">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ══ ALAMAT DOMISILI ══ --}}
                <div class="form-card" id="seksi-domisili">
                    <div class="form-card-header">
                        <div class="form-card-icon" style="background:#ecfdf5;color:#10b981">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div>
                            <div class="form-card-title">Alamat Domisili</div>
                            <div class="form-card-sub">Alamat tempat tinggal Anda saat ini.</div>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label-custom">Alamat Lengkap</label>
                                <textarea name="alamat" class="form-control-custom"
                                    placeholder="Nama jalan, nomor rumah, lingkungan...">{{ old('alamat', Auth::user()->alamat ?? '') }}</textarea>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">RT</label>
                                <input type="text" name="rt" class="form-control-custom"
                                    value="{{ old('rt', Auth::user()->rt ?? '') }}"
                                    placeholder="001">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">RW</label>
                                <input type="text" name="rw" class="form-control-custom"
                                    value="{{ old('rw', Auth::user()->rw ?? '') }}"
                                    placeholder="002">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Kelurahan</label>
                                <input type="text" name="kelurahan" class="form-control-custom"
                                    value="{{ old('kelurahan', Auth::user()->kelurahan ?? 'Teritih') }}"
                                    placeholder="Teritih">
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Kecamatan</label>
                                <input type="text" name="kecamatan" class="form-control-custom"
                                    value="{{ old('kecamatan', Auth::user()->kecamatan ?? 'Walantaka') }}"
                                    placeholder="Walantaka">
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ══ KEAMANAN AKUN ══ --}}
                <div class="form-card" id="seksi-sandi">
                    <div class="form-card-header">
                        <div class="form-card-icon" style="background:#fff7ed;color:#d97706">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <div>
                            <div class="form-card-title">Ganti Kata Sandi</div>
                            <div class="form-card-sub">Jaga keamanan akun dengan mengganti kata sandi secara berkala.</div>
                        </div>
                    </div>
                    <div class="form-card-body">
                        <div class="row g-3">

                            <div class="col-12">
                                <label class="form-label-custom">
                                    Kata Sandi Saat Ini
                                    <span class="optional">(isi jika ingin mengganti kata sandi)</span>
                                </label>
                                <div style="position:relative;">
                                    <input type="password" name="current_password" id="pwCurrent"
                                        class="form-control-custom" placeholder="••••••••"
                                        style="padding-right:40px;"
                                        autocomplete="new-password"
                                        readonly
                                        onfocus="this.removeAttribute('readonly')">
                                    <span class="pw-toggle" onclick="togglePw('pwCurrent', this)">
                                        <i class="bi bi-eye-slash"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Kata Sandi Baru</label>
                                <div style="position:relative;">
                                    <input type="password" name="password" id="pwNew"
                                        class="form-control-custom" placeholder="Min. 8 karakter"
                                        style="padding-right:40px;"
                                        autocomplete="new-password"
                                        readonly
                                        onfocus="this.removeAttribute('readonly')">
                                    <span class="pw-toggle" onclick="togglePw('pwNew', this)">
                                        <i class="bi bi-eye-slash"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label-custom">Konfirmasi Kata Sandi</label>
                                <div style="position:relative;">
                                    <input type="password" name="password_confirmation" id="pwConfirm"
                                        class="form-control-custom" placeholder="Ulangi kata sandi"
                                        style="padding-right:40px;"
                                        autocomplete="new-password"
                                        readonly
                                        onfocus="this.removeAttribute('readonly')">
                                    <span class="pw-toggle" onclick="togglePw('pwConfirm', this)">
                                        <i class="bi bi-eye-slash"></i>
                                    </span>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                {{-- ACTION BAR --}}
                <div class="action-bar">
                    <button type="button" class="btn-batal" onclick="window.history.back()">Batal</button>
                    <button type="submit" class="btn-simpan">
                        <i class="bi bi-check-lg"></i> Simpan Perubahan
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function previewFoto(input) {
    if (!input.files || !input.files[0]) return;
    const reader = new FileReader();
    reader.onload = function(e) {
        const src = e.target.result;
        const sm = document.getElementById('fotoPreviewSm');
        sm.innerHTML = '<img src="' + src + '" alt="" style="width:100%;height:100%;object-fit:cover;">';
        const lg = document.getElementById('avatarPreviewLarge');
        lg.innerHTML = '<img src="' + src + '" alt="" style="width:100%;height:100%;object-fit:cover;">'
                     + '<div class="profile-avatar-overlay"><i class="bi bi-camera-fill"></i></div>';
    };
    reader.readAsDataURL(input.files[0]);
}

function togglePw(id, el) {
    const input = document.getElementById(id);
    // Pastikan readonly dihapus dulu agar bisa dilihat
    input.removeAttribute('readonly');
    const isText = input.type === 'text';
    input.type = isText ? 'password' : 'text';
    el.innerHTML = isText ? '<i class="bi bi-eye-slash"></i>' : '<i class="bi bi-eye"></i>';
}

function setActive(el) {
    document.querySelectorAll('.sidebar-menu-item').forEach(i => i.classList.remove('active'));
    el.classList.add('active');
}

document.querySelectorAll('.sidebar-menu-item[href^="#"]').forEach(link => {
    link.addEventListener('click', function(e) {
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            e.preventDefault();
            target.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    });
});
</script>
</body>
</html>