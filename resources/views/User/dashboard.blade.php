<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard – Kelurahan Teritih</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <style>
    :root {
        --blue:    #1c64f2; --blue-dk: #1a56db; --blue-lt: #eff6ff;
        --navy:    #0d1b3e; --navy2:   #1e3a5f; --slate:   #334155;
        --muted:   #64748b; --border:  #e2e8f0; --bg:      #f1f5f9;
        --green:   #10b981; --orange:  #f59e0b; --red:     #ef4444;
    }
    *, *::before, *::after { box-sizing: border-box; }
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: var(--bg); color: var(--slate); font-size: 14px; line-height: 1.6; min-height: 100vh; display: flex; flex-direction: column; }

    /* NAVBAR */
    .main-nav { background: white; border-bottom: 1px solid var(--border); padding: 0 32px; height: 64px; display: flex; align-items: center; justify-content: space-between; position: sticky; top: 0; z-index: 1000; box-shadow: 0 1px 8px rgba(0,0,0,.06); flex-shrink: 0; }
    .nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
    .nav-brand-icon { width: 40px; height: 40px; background: linear-gradient(135deg, var(--blue), var(--navy2)); border-radius: 10px; display: flex; align-items: center; justify-content: center; color: white; font-size: 20px; }
    .nav-brand-text { display: flex; flex-direction: column; line-height: 1.15; }
    .nav-brand-sub  { font-size: 9px; font-weight: 700; letter-spacing: .12em; color: var(--muted); text-transform: uppercase; }
    .nav-brand-name { font-size: 16px; font-weight: 800; color: var(--navy); }
    .nav-links { display: flex; align-items: center; gap: 4px; list-style: none; margin: 0; padding: 0; }
    .nav-links a { display: block; padding: 6px 14px; border-radius: 8px; font-size: 13.5px; font-weight: 500; color: var(--slate); text-decoration: none; transition: all .18s; }
    .nav-links a:hover  { background: var(--bg); color: var(--blue); }
    .nav-links a.active { color: var(--blue); font-weight: 700; border-bottom: 2px solid var(--blue); border-radius: 0; }

    /* User Chip */
    .user-chip { display: flex; align-items: center; gap: 10px; padding: 5px 12px 5px 5px; border: 1.5px solid var(--border); border-radius: 40px; cursor: pointer; transition: all .18s; background: white; position: relative; }
    .user-chip:hover { border-color: #bfdbfe; background: var(--blue-lt); }
    .user-avatar { width: 32px; height: 32px; border-radius: 50%; background: linear-gradient(135deg, var(--blue), var(--navy2)); display: flex; align-items: center; justify-content: center; color: white; font-size: 12px; font-weight: 800; flex-shrink: 0; overflow: hidden; }
    .user-avatar img { width: 100%; height: 100%; object-fit: cover; }
    .user-info { line-height: 1.2; }
    .user-name { font-size: 13px; font-weight: 700; color: var(--navy); }
    .user-role { font-size: 10px; font-weight: 600; color: var(--muted); text-transform: uppercase; letter-spacing: .05em; }
    .user-dropdown { position: absolute; top: calc(100% + 8px); right: 0; background: white; border: 1px solid var(--border); border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,.1); min-width: 190px; overflow: hidden; display: none; z-index: 200; }
    .user-chip.open .user-dropdown { display: block; }
    .dd-item { display: flex; align-items: center; gap: 9px; padding: 10px 16px; font-size: 13px; font-weight: 500; color: var(--slate); text-decoration: none; transition: background .15s; background: none; border: none; width: 100%; cursor: pointer; text-align: left; }
    .dd-item:hover { background: var(--bg); color: var(--navy); }
    .dd-item.danger { color: var(--red); }
    .dd-item.danger:hover { background: #fef2f2; }
    .dd-divider { border-top: 1px solid var(--border); margin: 4px 0; }

    /* HERO */
    .hero-section { background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 55%, #1e4d8c 100%); border-radius: 16px; margin: 24px 32px; padding: 48px 56px; position: relative; overflow: hidden; min-height: 280px; display: flex; align-items: center; }
    .hero-section::before { content: ''; position: absolute; right: -60px; top: -60px; width: 340px; height: 340px; border-radius: 50%; border: 40px solid rgba(255,255,255,.05); }
    .hero-section::after  { content: ''; position: absolute; right: 60px; top: 40px; width: 200px; height: 200px; border-radius: 50%; border: 24px solid rgba(255,255,255,.07); }
    .hero-badge { display: inline-flex; align-items: center; gap: 6px; background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2); border-radius: 20px; padding: 4px 12px; font-size: 10px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase; color: #fbbf24; margin-bottom: 16px; }
    .hero-title { font-size: 38px; font-weight: 800; color: white; line-height: 1.15; margin-bottom: 4px; }
    .hero-title span { color: #60a5fa; }
    .hero-desc { font-size: 14px; color: rgba(255,255,255,.72); max-width: 500px; line-height: 1.7; margin-bottom: 28px; }
    .hero-actions { display: flex; gap: 12px; flex-wrap: wrap; }
    .btn-hero-primary { display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px; border-radius: 10px; font-size: 13.5px; font-weight: 700; background: var(--blue); color: white; border: none; text-decoration: none; transition: background .18s; }
    .btn-hero-primary:hover { background: var(--blue-dk); color: white; }
    .btn-hero-outline { display: inline-flex; align-items: center; gap: 8px; padding: 10px 22px; border-radius: 10px; font-size: 13.5px; font-weight: 700; background: rgba(255,255,255,.12); border: 1.5px solid rgba(255,255,255,.3); color: white; text-decoration: none; transition: all .18s; }
    .btn-hero-outline:hover { background: rgba(255,255,255,.2); color: white; }
    .hero-emblem { position: absolute; right: 80px; top: 50%; transform: translateY(-50%); width: 160px; height: 160px; background: rgba(255,255,255,.08); border: 2px solid rgba(255,255,255,.15); border-radius: 50%; display: flex; align-items: center; justify-content: center; color: rgba(255,255,255,.55); font-size: 65px; }

    /* CONTENT */
    .content-area { padding: 0 32px 40px; }
    .section-label { font-size: 13px; font-weight: 700; color: var(--navy); display: flex; align-items: center; gap: 8px; margin-bottom: 16px; }
    .section-label i { color: var(--blue); font-size: 18px; }

    /* AKSES CEPAT */
    .akses-card { background: white; border: 1px solid var(--border); border-radius: 14px; padding: 22px 16px; text-align: center; text-decoration: none; color: var(--navy); display: block; transition: all .2s; height: 100%; }
    .akses-card:hover { box-shadow: 0 8px 24px rgba(28,100,242,.12); transform: translateY(-3px); border-color: #bfdbfe; color: var(--blue); }
    .akses-icon { width: 50px; height: 50px; border-radius: 13px; display: flex; align-items: center; justify-content: center; font-size: 22px; margin: 0 auto 12px; }
    .akses-title { font-size: 13.5px; font-weight: 700; margin-bottom: 5px; }
    .akses-desc  { font-size: 11.5px; color: var(--muted); line-height: 1.5; }

    /* BERITA */
    .berita-wrap { background: white; border: 1px solid var(--border); border-radius: 14px; overflow: hidden; }
    .berita-header { padding: 14px 18px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
    .berita-header-title { font-size: 13.5px; font-weight: 700; color: var(--navy); display: flex; align-items: center; gap: 7px; }
    .berita-header-title i { color: var(--blue); }
    .link-semua { font-size: 12px; font-weight: 600; color: var(--blue); text-decoration: none; display: flex; align-items: center; gap: 4px; transition: gap .18s; }
    .link-semua:hover { gap: 7px; }
    .berita-item-row { display: flex; gap: 14px; align-items: flex-start; padding: 14px 18px; border-bottom: 1px solid var(--border); text-decoration: none; color: var(--slate); transition: background .18s; }
    .berita-item-row:last-child { border-bottom: none; }
    .berita-item-row:hover { background: #f8fafc; }
    .berita-img { width: 90px; height: 70px; border-radius: 8px; overflow: hidden; flex-shrink: 0; background: var(--bg); display: flex; align-items: center; justify-content: center; }
    .berita-img img { width: 100%; height: 100%; object-fit: cover; }
    .berita-cat { display: inline-flex; padding: 2px 8px; border-radius: 20px; font-size: 9.5px; font-weight: 700; letter-spacing: .04em; text-transform: uppercase; }
    .cat-kesehatan    { background: #ecfdf5; color: var(--green); }
    .cat-pemerintahan { background: #eff6ff; color: var(--blue); }
    .berita-item-title { font-size: 13px; font-weight: 700; color: var(--navy); line-height: 1.4; margin-bottom: 4px; }
    .berita-item-desc  { font-size: 11.5px; color: var(--muted); line-height: 1.55; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
    .berita-date { font-size: 11px; color: var(--muted); }

    /* SIDEBAR */
    .sidebar-card { background: white; border: 1px solid var(--border); border-radius: 14px; overflow: hidden; margin-bottom: 14px; }
    .sidebar-card:last-child { margin-bottom: 0; }
    .jam-header { background: var(--blue); padding: 13px 16px; display: flex; align-items: center; gap: 10px; }
    .jam-header-icon { width: 30px; height: 30px; background: rgba(255,255,255,.2); border-radius: 7px; display: flex; align-items: center; justify-content: center; color: white; font-size: 15px; }
    .jam-header-text .jam-title    { font-size: 12.5px; font-weight: 700; color: white; line-height: 1.2; }
    .jam-header-text .jam-subtitle { font-size: 10.5px; color: rgba(255,255,255,.75); }
    .jam-body { padding: 10px 16px; }
    .jam-row { display: flex; justify-content: space-between; align-items: center; padding: 7px 0; border-bottom: 1px solid var(--border); font-size: 12.5px; }
    .jam-row:last-child { border-bottom: none; }
    .jam-day  { font-weight: 600; color: var(--navy); }
    .jam-time { color: var(--slate); }
    .jam-tutup { display: inline-flex; padding: 2px 8px; border-radius: 20px; font-size: 10px; font-weight: 700; background: #fef2f2; color: var(--red); }
    .pengumuman-body { padding: 13px 16px; }
    .pengumuman-title { font-size: 12.5px; font-weight: 700; color: var(--orange); display: flex; align-items: center; gap: 6px; margin-bottom: 7px; }
    .pengumuman-text  { font-size: 12px; color: var(--slate); line-height: 1.6; }
    .bantuan-body  { padding: 13px 16px; }
    .bantuan-title { font-size: 12.5px; font-weight: 700; color: var(--navy); margin-bottom: 10px; }
    .bantuan-item  { display: flex; align-items: center; gap: 10px; padding: 8px 0; border-bottom: 1px solid var(--border); }
    .bantuan-item:last-child { border-bottom: none; }
    .bantuan-icon  { width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 15px; flex-shrink: 0; }
    .bantuan-icon.green { background: #ecfdf5; color: var(--green); }
    .bantuan-icon.blue  { background: #eff6ff; color: var(--blue); }
    .bantuan-label { font-size: 10.5px; color: var(--muted); line-height: 1.2; }
    .bantuan-value { font-size: 12.5px; font-weight: 700; color: var(--navy); line-height: 1.2; }

    /* FOOTER */
    .main-footer { background: #0f172a; padding: 48px 32px 0; flex-shrink: 0; }
    .footer-logo { width: 36px; height: 36px; background: var(--blue); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 18px; flex-shrink: 0; }
    .footer-brand-name { font-size: 15px; font-weight: 800; color: white; line-height: 1.2; }
    .footer-brand-sub  { font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: .05em; }
    .footer-desc       { font-size: 12.5px; color: #94a3b8; line-height: 1.75; margin-bottom: 16px; }
    .footer-social { width: 32px; height: 32px; background: #1e293b; border-radius: 7px; display: inline-flex; align-items: center; justify-content: center; color: #94a3b8; text-decoration: none; font-size: 15px; transition: all .18s; }
    .footer-social:hover { background: var(--blue); color: white; }
    .footer-heading { font-size: 12px; font-weight: 700; color: #cbd5e1; text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px; }
    .footer-links { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 10px; }
    .footer-links a { color: #94a3b8; text-decoration: none; font-size: 13px; transition: color .18s; }
    .footer-links a:hover { color: #60a5fa; }
    .footer-contact { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
    .footer-contact li { display: flex; gap: 10px; font-size: 12.5px; color: #94a3b8; align-items: flex-start; }
    .footer-contact li i { color: #60a5fa; flex-shrink: 0; margin-top: 2px; }
    .footer-map { border-radius: 10px; overflow: hidden; border: 1px solid #1e293b; }
    .footer-bottom { border-top: 1px solid #1e293b; padding: 16px 0; margin-top: 16px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 10px; font-size: 12px; color: #475569; }
    .footer-bottom a { color: #64748b; text-decoration: none; transition: color .18s; }
    .footer-bottom a:hover { color: #94a3b8; }

    @media (max-width: 991px) {
        .nav-links    { display: none; }
        .hero-section { margin: 16px; padding: 32px 24px; }
        .hero-title   { font-size: 28px; }
        .hero-emblem  { display: none; }
        .content-area { padding: 0 16px 32px; }
        .main-nav     { padding: 0 16px; }
        .main-footer  { padding: 36px 16px 0; }
    }
    </style>
</head>
<body>

{{-- NAVBAR --}}
<nav class="main-nav">
    <a href="{{ route('home') }}" class="nav-brand">
        <div class="nav-brand-icon"><i class="bi bi-bank2"></i></div>
        <div class="nav-brand-text">
            <span class="nav-brand-sub">Kota Serang</span>
            <span class="nav-brand-name">Kelurahan Teritih</span>
        </div>
    </a>

    {{-- ✅ SEMUA LINK SUDAH PAKAI ROUTE YANG BENAR --}}
    <ul class="nav-links">
        <li><a href="{{ route('home') }}"      class="{{ request()->routeIs('home','user.dashboard') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="{{ route('profil') }}"    class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profil</a></li>
        <li><a href="{{ route('layanan') }}"   class="{{ request()->routeIs('layanan') ? 'active' : '' }}">Layanan</a></li>
        <li><a href="{{ route('informasi') }}" class="{{ request()->routeIs('informasi','informasi.berita') ? 'active' : '' }}">Informasi</a></li>
        <li><a href="{{ route('kontak') }}"    class="{{ request()->routeIs('kontak') ? 'active' : '' }}">Kontak</a></li>
    </ul>

    <div class="user-chip" id="userChip">
        @php
            $user     = Auth::user();
            $fullName = $user->nama ?? $user->name ?? 'U';
            $parts    = explode(' ', $fullName);
            $initials = strtoupper(substr($parts[0], 0, 1)) . strtoupper(substr($parts[1] ?? '', 0, 1));
        @endphp
        <div class="user-avatar">
            @if($user->foto ?? null)
                <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $fullName }}">
            @else
                {{ $initials }}
            @endif
        </div>
        <div class="user-info">
            <div class="user-name">{{ $fullName }}</div>
            <div class="user-role">Masyarakat</div>
        </div>
        <i class="bi bi-chevron-down ms-1" style="font-size:11px;color:var(--muted)"></i>

        <div class="user-dropdown">
            <a href="{{ route('user.dashboard') }}" class="dd-item">
                <i class="bi bi-speedometer2"></i> Dashboard
            </a>
            <a href="{{ route('profile.edit') }}" class="dd-item">
                <i class="bi bi-person-circle"></i> Profil Saya
            </a>
            <a href="{{ route('user.permohonan.index') }}" class="dd-item">
                <i class="bi bi-file-earmark-text"></i> Permohonan Saya
            </a>
            <div class="dd-divider"></div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="dd-item danger">
                    <i class="bi bi-box-arrow-right"></i> Keluar
                </button>
            </form>
        </div>
    </div>
</nav>

{{-- HERO --}}
<div class="hero-section">
    <div style="position:relative;z-index:2;max-width:580px;">
        <div class="hero-badge">
            <i class="bi bi-star-fill" style="font-size:9px"></i>
            Layanan Digital Terpadu
        </div>
        <h1 class="hero-title">
            Kelurahan Teritih<br><span>Kota Serang</span>
        </h1>
        <p class="hero-desc">
            Selamat datang di portal resmi pelayanan publik. Dapatkan akses mudah ke informasi terkini, layanan administrasi kependudukan, dan pengajuan surat secara online.
        </p>
        <div class="hero-actions">
            <a href="{{ route('layanan') }}" class="btn-hero-primary">
                <i class="bi bi-file-earmark-text"></i> Ajukan Surat
            </a>
            <a href="#layanan" class="btn-hero-outline">
                <i class="bi bi-info-circle"></i> Panduan Layanan
            </a>
        </div>
    </div>
    <div class="hero-emblem"><i class="bi bi-bank2"></i></div>
</div>

{{-- CONTENT --}}
<div class="content-area">
    <div class="row g-4">
        <div class="col-lg-8">

            {{-- Akses Cepat --}}
            <div id="layanan" class="mb-4">
                <div class="section-label"><i class="bi bi-grid-fill"></i> Akses Cepat</div>
                <div class="row g-3">
                    <div class="col-md-4 col-6">
                        {{-- ✅ Berita → route informasi.berita --}}
                        <a href="{{ route('informasi.berita') }}" class="akses-card">
                            <div class="akses-icon" style="background:#fef3c7;color:#d97706">
                                <i class="bi bi-calendar-event-fill"></i>
                            </div>
                            <div class="akses-title">Berita &amp;<br>Pengumuman</div>
                            <div class="akses-desc">Informasi kegiatan dan pengumuman terbaru.</div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        {{-- ✅ Layanan → route layanan --}}
                        <a href="{{ route('layanan') }}" class="akses-card">
                            <div class="akses-icon" style="background:#eff6ff;color:var(--blue)">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="akses-title">Layanan<br>Administrasi</div>
                            <div class="akses-desc">Panduan lengkap pengurusan dokumen.</div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ route('layanan') }}" class="akses-card">
                            <div class="akses-icon" style="background:#eff6ff;color:var(--blue)">
                                <i class="bi bi-file-earmark-text-fill"></i>
                            </div>
                            <div class="akses-title">Permohonan Surat</div>
                            <div class="akses-desc">Buat surat pengantar dan keterangan secara online.</div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Kabar Kelurahan --}}
            <div class="berita-wrap">
                <div class="berita-header">
                    <div class="berita-header-title"><i class="bi bi-newspaper"></i> Kabar Kelurahan Terkini</div>
                    {{-- ✅ Lihat Semua → route informasi.berita --}}
                    <a href="{{ route('informasi.berita') }}" class="link-semua">Lihat Semua <i class="bi bi-arrow-right"></i></a>
                </div>

                <a href="{{ route('informasi.berita') }}" class="berita-item-row">
                    <div class="berita-img">
                        <img src="https://images.unsplash.com/photo-1576091160550-2173dba999ef?w=180&q=70" alt="">
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="berita-cat cat-kesehatan">Kesehatan</span>
                            <span class="berita-date">• 12 Oktober 2023</span>
                        </div>
                        <div class="berita-item-title">Jadwal Pelaksanaan Posyandu Balita RW 05 Bulan...</div>
                        <div class="berita-item-desc">Kegiatan posyandu balita untuk wilayah RW 05 akan dilaksanakan pada hari Senin mendatang. Diharapkan ibu-ibu membawa buku...</div>
                    </div>
                </a>

                <a href="{{ route('informasi.berita') }}" class="berita-item-row">
                    <div class="berita-img">
                        <img src="https://images.unsplash.com/photo-1529156069898-49953e39b3ac?w=180&q=70" alt="">
                    </div>
                    <div class="flex-grow-1">
                        <div class="d-flex align-items-center gap-2 mb-1">
                            <span class="berita-cat cat-pemerintahan">Pemerintahan</span>
                            <span class="berita-date">• 10 Oktober 2023</span>
                        </div>
                        <div class="berita-item-title">Rapat Koordinasi Persiapan HUT Kota Serang</div>
                        <div class="berita-item-desc">Kelurahan Teritih mengadakan rapat koordinasi dengan seluruh ketua RW dan RT untuk mempersiapkan rangkaian acara HUT Kot...</div>
                    </div>
                </a>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="sidebar-card">
                <div class="jam-header">
                    <div class="jam-header-icon"><i class="bi bi-clock-fill"></i></div>
                    <div class="jam-header-text">
                        <div class="jam-title">Jam Operasional</div>
                        <div class="jam-subtitle">Kantor Kelurahan Teritih</div>
                    </div>
                </div>
                <div class="jam-body">
                    <div class="jam-row"><span class="jam-day">Senin–Kamis</span><span class="jam-time">08:00 – 16:00</span></div>
                    <div class="jam-row"><span class="jam-day">Jumat</span><span class="jam-time">08:00 – 16:30</span></div>
                    <div class="jam-row"><span class="jam-day">Sabtu–Minggu</span><span class="jam-tutup">Tutup</span></div>
                </div>
            </div>

            <div class="sidebar-card">
                <div class="pengumuman-body">
                    <div class="pengumuman-title"><i class="bi bi-megaphone-fill"></i> Pengumuman Penting</div>
                    <div class="pengumuman-text">Untuk pengurusan KTP Digital, dimohon membawa KTP fisik asli dan Smartphone Android/iOS. Pelayanan tersedia di Loket 2.</div>
                </div>
            </div>

            <div class="sidebar-card">
                <div class="bantuan-body">
                    <div class="bantuan-title">Butuh Bantuan?</div>
                    <div class="bantuan-item">
                        <div class="bantuan-icon green"><i class="bi bi-chat-dots-fill"></i></div>
                        <div><div class="bantuan-label">Chat WhatsApp</div><div class="bantuan-value">0812-3456-7890</div></div>
                    </div>
                    <div class="bantuan-item">
                        <div class="bantuan-icon blue"><i class="bi bi-telephone-fill"></i></div>
                        <div><div class="bantuan-label">Call Center</div><div class="bantuan-value">(0254) 123456</div></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

{{-- FOOTER --}}
<footer class="main-footer">
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
                <a href="#" class="footer-social"><i class="bi bi-globe2"></i></a>
                <a href="#" class="footer-social"><i class="bi bi-envelope-fill"></i></a>
                <a href="#" class="footer-social"><i class="bi bi-telephone-fill"></i></a>
            </div>
        </div>
        <div class="col-lg-2 col-md-6">
            <div class="footer-heading">Tautan Cepat</div>
            <ul class="footer-links">
                <li><a href="{{ route('profil') }}">Profil Kelurahan</a></li>
                <li><a href="{{ route('layanan') }}">Layanan Online</a></li>
                <li><a href="{{ route('informasi') }}">Informasi Publik</a></li>
                <li><a href="{{ route('kontak') }}">Kontak Kami</a></li>
            </ul>
        </div>
        <div class="col-lg-4 col-md-6">
            <div class="footer-heading">Kontak Kami</div>
            <ul class="footer-contact">
                <li><i class="bi bi-geo-alt-fill"></i><span>Jl. Raya Teritih No. 123, Kecamatan Walantaka, Kota Serang, Banten 42183</span></li>
                <li><i class="bi bi-telephone-fill"></i><span>(0254) 123456</span></li>
                <li><i class="bi bi-envelope-fill"></i><span>admin@teritih.go.id</span></li>
                <li><i class="bi bi-clock-fill"></i><span>Senin–Jumat: 08.00–16.00</span></li>
            </ul>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="footer-heading">Lokasi Kantor</div>
            <div class="footer-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15866.25!2d106.1543!3d-6.1227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e418a2a78a50e07%3A0x74c78c4f5c5eed87!2sSerang%2C%20Kota%20Serang%2C%20Banten!5e0!3m2!1sen!2sid!4v1700000000000" width="100%" height="130" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
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
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const chip = document.getElementById('userChip');
if (chip) {
    chip.addEventListener('click', function(e) { e.stopPropagation(); this.classList.toggle('open'); });
    document.addEventListener('click', function() { chip.classList.remove('open'); });
}
</script>
</body>
</html>