<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Layanan Administrasi – Kelurahan Teritih</title>
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
        --white:   #ffffff;
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
    .layanan-hero {
        background: linear-gradient(135deg, var(--navy) 0%, var(--navy2) 60%, #1e4d8c 100%);
        margin: 24px 32px; border-radius: 20px; padding: 52px 56px;
        position: relative; overflow: hidden; min-height: 280px;
        display: flex; align-items: center;
    }
    .layanan-hero::before {
        content: ''; position: absolute; right: -80px; top: -80px;
        width: 380px; height: 380px; border-radius: 50%;
        border: 50px solid rgba(255,255,255,.04);
    }
    .layanan-hero::after {
        content: ''; position: absolute; right: 40px; bottom: -40px;
        width: 220px; height: 220px; border-radius: 50%;
        border: 28px solid rgba(255,255,255,.06);
    }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,.12); border: 1px solid rgba(255,255,255,.2);
        border-radius: 20px; padding: 4px 14px;
        font-size: 10px; font-weight: 700; letter-spacing: .1em; text-transform: uppercase;
        color: #fbbf24; margin-bottom: 16px;
    }
    .hero-title { font-size: 40px; font-weight: 800; color: white; line-height: 1.15; margin-bottom: 14px; }
    .hero-title span { color: #60a5fa; }
    .hero-desc { font-size: 14px; color: rgba(255,255,255,.72); max-width: 500px; line-height: 1.75; margin-bottom: 28px; }
    .btn-hero-ajukan {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 11px 26px; border-radius: 10px; font-size: 14px; font-weight: 700;
        background: rgba(255,255,255,.15); border: 1.5px solid rgba(255,255,255,.35);
        color: white; text-decoration: none; transition: all .2s;
    }
    .btn-hero-ajukan:hover { background: rgba(255,255,255,.25); color: white; }
    .hero-emblem {
        position: absolute; right: 80px; top: 50%; transform: translateY(-50%);
        width: 160px; height: 160px; background: rgba(255,255,255,.08);
        border: 2px solid rgba(255,255,255,.15); border-radius: 50%;
        display: flex; align-items: center; justify-content: center;
        color: rgba(255,255,255,.55); font-size: 64px;
    }
    .content-area { flex: 1; padding: 28px 32px 48px; }
    .layanan-main-card { background: white; border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
    .layanan-card-header { padding: 18px 24px; border-bottom: 1px solid var(--border); display: flex; align-items: center; justify-content: space-between; }
    .layanan-card-title { font-size: 15px; font-weight: 800; color: var(--navy); display: flex; align-items: center; gap: 9px; }
    .layanan-card-title i { color: var(--blue); font-size: 18px; }
    .layanan-count-badge { display: inline-flex; align-items: center; padding: 4px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; background: var(--blue-lt); color: var(--blue); border: 1px solid #bfdbfe; }
    .layanan-grid { padding: 8px 16px 16px; }
    .layanan-item { display: flex; align-items: flex-start; gap: 14px; padding: 16px; border-radius: 12px; border: 1px solid transparent; cursor: default; transition: all .2s; text-decoration: none; color: inherit; }
    .layanan-item:hover { background: var(--blue-lt); border-color: #bfdbfe; }
    .layanan-item-icon { width: 44px; height: 44px; border-radius: 12px; display: flex; align-items: center; justify-content: center; font-size: 20px; flex-shrink: 0; }
    .layanan-item-name { font-size: 13.5px; font-weight: 700; color: var(--navy); line-height: 1.3; margin-bottom: 4px; }
    .layanan-item-desc { font-size: 12px; color: var(--muted); line-height: 1.5; }
    .layanan-cta { border-top: 1px solid var(--border); padding: 20px 24px; display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap; }
    .layanan-cta-text { display: flex; align-items: center; gap: 14px; }
    .layanan-cta-icon { width: 44px; height: 44px; border-radius: 12px; background: var(--blue-lt); display: flex; align-items: center; justify-content: center; color: var(--blue); font-size: 20px; flex-shrink: 0; }
    .layanan-cta-label { font-size: 14px; font-weight: 700; color: var(--navy); }
    .layanan-cta-sub   { font-size: 12px; color: var(--muted); }
    .btn-ajukan { display: inline-flex; align-items: center; gap: 8px; padding: 11px 24px; border-radius: 10px; font-size: 13.5px; font-weight: 700; background: var(--blue); color: white; border: none; text-decoration: none; transition: background .18s; flex-shrink: 0; }
    .btn-ajukan:hover { background: var(--blue-dk); color: white; }
    .sidebar-card { background: white; border: 1px solid var(--border); border-radius: 14px; overflow: hidden; margin-bottom: 16px; }
    .sidebar-card:last-child { margin-bottom: 0; }
    .jam-header { background: var(--blue); padding: 14px 18px; display: flex; align-items: center; gap: 10px; }
    .jam-header-icon { width: 32px; height: 32px; background: rgba(255,255,255,.2); border-radius: 8px; display: flex; align-items: center; justify-content: center; color: white; font-size: 16px; }
    .jam-header-text .jam-title    { font-size: 13px; font-weight: 700; color: white; line-height: 1.2; }
    .jam-header-text .jam-subtitle { font-size: 11px; color: rgba(255,255,255,.8); }
    .jam-body { padding: 12px 18px; }
    .jam-row { display: flex; justify-content: space-between; align-items: center; padding: 8px 0; border-bottom: 1px solid var(--border); font-size: 13px; }
    .jam-row:last-child { border-bottom: none; }
    .jam-day  { font-weight: 600; color: var(--navy); }
    .jam-time { color: var(--slate); font-size: 12.5px; }
    .jam-tutup { display: inline-flex; padding: 2px 9px; border-radius: 20px; font-size: 10px; font-weight: 700; background: #fef2f2; color: var(--red); }

    /* ── STATUS BADGE REAL-TIME ── */
    .status-buka  { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; background: #dcfce7; color: #16a34a; }
    .status-tutup { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 700; background: #fef2f2; color: #dc2626; }
    .status-dot   { width: 7px; height: 7px; border-radius: 50%; display: inline-block; flex-shrink: 0; }
    .status-dot-buka  { background: #16a34a; animation: pulse-green 1.5s ease-in-out infinite; }
    .status-dot-tutup { background: #dc2626; }
    @keyframes pulse-green { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(0.85)} }

    .info-body { padding: 16px 18px; }
    .info-title { display: flex; align-items: center; gap: 8px; font-size: 13px; font-weight: 700; color: var(--orange); margin-bottom: 10px; }
    .info-title i { font-size: 16px; }
    .info-text { font-size: 12.5px; color: var(--slate); line-height: 1.65; }
    .bantuan-body  { padding: 14px 18px; }
    .bantuan-title { font-size: 13px; font-weight: 700; color: var(--navy); margin-bottom: 12px; }
    .bantuan-item  { display: flex; align-items: center; gap: 10px; padding: 9px 0; border-bottom: 1px solid var(--border); }
    .bantuan-item:last-child { border-bottom: none; }
    .bantuan-icon  { width: 34px; height: 34px; border-radius: 8px; display: flex; align-items: center; justify-content: center; font-size: 16px; flex-shrink: 0; }
    .bantuan-icon.green { background: #ecfdf5; color: var(--green); }
    .bantuan-icon.blue  { background: #eff6ff; color: var(--blue); }
    .bantuan-label { font-size: 11px; color: var(--muted); line-height: 1.2; }
    .bantuan-value { font-size: 13px; font-weight: 700; color: var(--navy); line-height: 1.2; }
    @media (max-width: 991px) {
        .layanan-hero  { margin: 16px; padding: 36px 28px; }
        .hero-title    { font-size: 28px; }
        .hero-emblem   { display: none; }
        .content-area  { padding: 20px 16px 36px; }
    }
    </style>
</head>
<body>

@include('partials.navbar')

{{-- HERO --}}
<div class="layanan-hero">
    <div style="position:relative;z-index:2;max-width:560px;">
        <div class="hero-badge">
            <i class="bi bi-shield-check-fill" style="font-size:10px"></i>
            Layanan Publik
        </div>
        <h1 class="hero-title">
            Layanan <span>Administrasi</span>
        </h1>
        <p class="hero-desc">
            Kelurahan Teritih menyediakan berbagai layanan administrasi kependudukan untuk memudahkan masyarakat. Ajukan surat keterangan dan dokumen penting lainnya secara online dengan mudah dan cepat.
        </p>
        @auth
            <a href="{{ route('user.permohonan.create') }}" class="btn-hero-ajukan">
                <i class="bi bi-file-earmark-arrow-up-fill"></i> Ajukan Permohonan Surat
            </a>
        @else
            <a href="{{ route('login') }}" class="btn-hero-ajukan">
                <i class="bi bi-file-earmark-arrow-up-fill"></i> Ajukan Permohonan Surat
            </a>
        @endauth
    </div>
    <div class="hero-emblem">
        <i class="bi bi-person-vcard-fill"></i>
    </div>
</div>

{{-- MAIN CONTENT --}}
<div class="content-area">
    <div class="row g-4">

        {{-- LEFT: Jenis Layanan --}}
        <div class="col-lg-8">
            <div class="layanan-main-card">

                <div class="layanan-card-header">
                    <div class="layanan-card-title">
                        <i class="bi bi-list-ul"></i> Jenis Layanan Surat
                    </div>
                    <span class="layanan-count-badge">8 Layanan Tersedia</span>
                </div>

                <div class="layanan-grid">
                    <div class="row g-1">

                        <div class="col-md-6">
                            <div class="layanan-item">
                                <div class="layanan-item-icon" style="background:#eff6ff;color:#1c64f2">
                                    <i class="bi bi-house-door-fill"></i>
                                </div>
                                <div>
                                    <div class="layanan-item-name">Keterangan Domisili</div>
                                    <div class="layanan-item-desc">Surat keterangan tempat tinggal resmi untuk berbagai keperluan.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="layanan-item">
                                <div class="layanan-item-icon" style="background:#fef3c7;color:#d97706">
                                    <i class="bi bi-shop-window"></i>
                                </div>
                                <div>
                                    <div class="layanan-item-name">Keterangan Usaha</div>
                                    <div class="layanan-item-desc">Untuk persyaratan izin usaha, pinjaman bank, atau bantuan UMKM.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="layanan-item">
                                <div class="layanan-item-icon" style="background:#f0fdf4;color:#10b981">
                                    <i class="bi bi-shield-check-fill"></i>
                                </div>
                                <div>
                                    <div class="layanan-item-name">Pengantar SKCK</div>
                                    <div class="layanan-item-desc">Surat pengantar ke Polsek/Polres untuk pembuatan catatan kepolisian.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="layanan-item">
                                <div class="layanan-item-icon" style="background:#fdf4ff;color:#a855f7">
                                    <i class="bi bi-currency-dollar"></i>
                                </div>
                                <div>
                                    <div class="layanan-item-name">Keterangan Tidak Mampu</div>
                                    <div class="layanan-item-desc">Surat keterangan (SKTM) untuk pengajuan beasiswa atau bantuan sosial.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="layanan-item">
                                <div class="layanan-item-icon" style="background:#fff1f2;color:#f43f5e">
                                    <i class="bi bi-people-fill"></i>
                                </div>
                                <div>
                                    <div class="layanan-item-name">Keterangan Kelahiran</div>
                                    <div class="layanan-item-desc">Dokumen pengantar untuk pembuatan akta kelahiran anak.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="layanan-item">
                                <div class="layanan-item-icon" style="background:#f0fdf4;color:#059669">
                                    <i class="bi bi-file-earmark-medical-fill"></i>
                                </div>
                                <div>
                                    <div class="layanan-item-name">Keterangan Kematian</div>
                                    <div class="layanan-item-desc">Dokumen pelaporan kematian warga untuk administrasi KK.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="layanan-item">
                                <div class="layanan-item-icon" style="background:#eff6ff;color:#3b82f6">
                                    <i class="bi bi-arrow-right-circle-fill"></i>
                                </div>
                                <div>
                                    <div class="layanan-item-name">Keterangan Pindah</div>
                                    <div class="layanan-item-desc">Surat pengantar untuk warga yang akan pindah domisili keluar daerah.</div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="layanan-item">
                                <div class="layanan-item-icon" style="background:#fff7ed;color:#ea580c">
                                    <i class="bi bi-heart-fill"></i>
                                </div>
                                <div>
                                    <div class="layanan-item-name">Belum Menikah</div>
                                    <div class="layanan-item-desc">Keterangan status perkawinan untuk persyaratan KUA atau kerja.</div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <div class="layanan-cta">
                    <div class="layanan-cta-text">
                        <div class="layanan-cta-icon"><i class="bi bi-rocket-takeoff-fill"></i></div>
                        <div>
                            <div class="layanan-cta-label">Sudah siap mengajukan?</div>
                            <div class="layanan-cta-sub">Pastikan data diri Anda lengkap sebelum mengajukan permohonan surat.</div>
                        </div>
                    </div>
                    @auth
                        <a href="{{ route('user.permohonan.create') }}" class="btn-ajukan">
                            <i class="bi bi-file-earmark-arrow-up-fill"></i> Ajukan Surat
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-ajukan">
                            <i class="bi bi-file-earmark-arrow-up-fill"></i> Ajukan Surat
                        </a>
                    @endauth
                </div>

            </div>
        </div>

        {{-- RIGHT: Sidebar --}}
        <div class="col-lg-4">

            {{-- Jam Operasional --}}
            <div class="sidebar-card">
                <div class="jam-header">
                    <div class="jam-header-icon"><i class="bi bi-clock-fill"></i></div>
                    <div class="jam-header-text">
                        <div class="jam-title">Jam Operasional</div>
                        <div class="jam-subtitle">Pelayanan Kantor Kelurahan</div>
                    </div>
                </div>
                <div class="jam-body">
                    <div class="jam-row">
                        <span class="jam-day">Senin–Kamis</span>
                        <span class="jam-time">08:00 – 16:00</span>
                    </div>
                    <div class="jam-row">
                        <span class="jam-day">Jumat</span>
                        <span class="jam-time">08:00 – 15:30</span>
                    </div>
                    <div class="jam-row">
                        <span class="jam-day">Sabtu–Minggu</span>
                        <span class="jam-tutup">Tutup</span>
                    </div>
                    {{-- STATUS REAL-TIME --}}
                    <div class="jam-row" style="border-bottom:none;padding-top:10px;margin-top:2px;border-top:1px dashed var(--border)">
                        <span class="jam-day" style="font-size:12px;font-weight:600">Status Sekarang</span>
                        <span id="jam-status-layanan"></span>
                    </div>
                </div>
            </div>

            {{-- Informasi Penting --}}
            <div class="sidebar-card" style="border-left: 3px solid var(--orange);">
                <div class="info-body">
                    <div class="info-title">
                        <i class="bi bi-info-circle-fill"></i> Informasi Penting
                    </div>
                    <div class="info-text">
                        Pengajuan surat online diproses pada hari kerja. Notifikasi status surat akan dikirim melalui WhatsApp atau Dashboard pengguna.
                    </div>
                </div>
            </div>

            {{-- Butuh Bantuan --}}
            <div class="sidebar-card">
                <div class="bantuan-body">
                    <div class="bantuan-title">Butuh Bantuan?</div>
                    <div class="bantuan-item">
                        <div class="bantuan-icon green"><i class="bi bi-chat-dots-fill"></i></div>
                        <div>
                            <div class="bantuan-label">Chat WhatsApp</div>
                            <div class="bantuan-value">0812-3456-7890</div>
                        </div>
                    </div>
                    <div class="bantuan-item">
                        <div class="bantuan-icon blue"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <div class="bantuan-label">Call Center</div>
                            <div class="bantuan-value">(0254) 123456</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
</div>

@include('partials.footer')

{{-- ═══ SCRIPT: STATUS JAM OPERASIONAL REAL-TIME (WIB) ═══ --}}
<script>
(function () {
    var now  = new Date();
    var wib  = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
    var day  = wib.getDay();
    var tot  = wib.getHours() * 60 + wib.getMinutes();

    var isOpen = false;

    if (day >= 1 && day <= 4) {
        isOpen = tot >= 480 && tot < 960;
    } else if (day === 5) {
        isOpen = tot >= 480 && tot < 930;
    }

    var htmlBuka  = '<span class="status-buka"><span class="status-dot status-dot-buka"></span>Sedang Buka</span>';
    var htmlTutup = '<span class="status-tutup"><span class="status-dot status-dot-tutup"></span>Sedang Tutup</span>';

    var el = document.getElementById('jam-status-layanan');
    if (el) el.innerHTML = isOpen ? htmlBuka : htmlTutup;
})();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>