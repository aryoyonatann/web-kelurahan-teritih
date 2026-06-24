<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Kelurahan Teritih – Portal Pelayanan Publik</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
    :root {
        --blue:#1c64f2; --blue-dk:#1a56db; --blue-lt:#eff6ff;
        --navy:#0d1b3e; --navy2:#1e3a5f; --slate:#334155;
        --muted:#64748b; --border:#e2e8f0; --bg:#f1f5f9;
        --green:#10b981; --orange:#f59e0b; --red:#ef4444;
        --fs-base:16px; --fs-sm:14px; --fs-xs:13px;
        --fs-lg:18px; --fs-hero:46px;
    }
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:#fff;color:var(--slate);font-size:var(--fs-base);line-height:1.7}

    /* ── HERO ── */
    .hero-section{background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 55%,#1e4d8c 100%);border-radius:16px;margin:24px 32px;padding:60px 56px;position:relative;overflow:hidden;min-height:320px;display:flex;align-items:center}
    .hero-section::before{content:'';position:absolute;right:-60px;top:-60px;width:340px;height:340px;border-radius:50%;border:40px solid rgba(255,255,255,.05)}
    .hero-section::after{content:'';position:absolute;right:60px;top:40px;width:200px;height:200px;border-radius:50%;border:24px solid rgba(255,255,255,.07)}
    .hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);border-radius:20px;padding:5px 14px;font-size:var(--fs-xs);font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#fbbf24;margin-bottom:20px}
    .hero-title{font-size:var(--fs-hero);font-weight:800;color:white;line-height:1.15;margin-bottom:10px}
    .hero-title span{color:#60a5fa}
    .hero-desc{font-size:var(--fs-base);color:rgba(255,255,255,.78);max-width:500px;line-height:1.75;margin-bottom:32px}
    .btn-hero-detail{display:inline-flex;align-items:center;gap:10px;padding:14px 28px;border-radius:12px;font-size:var(--fs-base);font-weight:700;background:rgba(255,255,255,.15);border:1.5px solid rgba(255,255,255,.35);color:white;text-decoration:none;transition:all .2s}
    .btn-hero-detail:hover{background:rgba(255,255,255,.25);color:white}
    .hero-emblem{position:absolute;right:80px;top:50%;transform:translateY(-50%);width:170px;height:170px;background:rgba(255,255,255,.08);border:2px solid rgba(255,255,255,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.6);font-size:70px}

    /* ── LAYOUT ── */
    .content-area{padding:0 32px 48px}
    .section-label{font-size:var(--fs-lg);font-weight:700;color:var(--navy);display:flex;align-items:center;gap:8px;margin-bottom:18px}
    .section-label i{color:var(--blue);font-size:20px}

    /* ── AKSES CEPAT ── */
    .akses-card{background:white;border:1px solid var(--border);border-radius:14px;padding:26px 18px;text-align:center;text-decoration:none;color:var(--navy);display:block;transition:all .2s;height:100%}
    .akses-card:hover{box-shadow:0 8px 24px rgba(28,100,242,.12);transform:translateY(-3px);border-color:#bfdbfe;color:var(--blue)}
    .akses-icon{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:26px;margin:0 auto 16px}
    .akses-title{font-size:var(--fs-base);font-weight:700;margin-bottom:6px}
    .akses-desc{font-size:var(--fs-sm);color:var(--muted);line-height:1.6}

    /* ── BERITA HEADER ── */
    .berita-section-header{display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-bottom:20px}
    .link-semua{font-size:var(--fs-sm);font-weight:700;color:var(--blue);text-decoration:none;display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:9px;border:1.5px solid #bfdbfe;background:var(--blue-lt);transition:all .18s}
    .link-semua:hover{background:var(--blue);color:white;border-color:var(--blue)}

    /* ── BERITA GRID CARD ── */
    .berita-grid-card{background:white;border:1px solid var(--border);border-radius:16px;overflow:hidden;text-decoration:none;color:inherit;display:flex;flex-direction:column;transition:all .22s;height:100%}
    .berita-grid-card:hover{box-shadow:0 8px 28px rgba(28,100,242,.13);transform:translateY(-3px);border-color:#bfdbfe}
    .berita-grid-img{overflow:hidden;position:relative;background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:40px;flex-shrink:0}
    .berita-grid-img img{width:100%;height:100%;object-fit:cover;transition:transform .35s ease}
    .berita-grid-card:hover .berita-grid-img img{transform:scale(1.04)}
    .date-pill{position:absolute;top:12px;left:12px;background:rgba(255,255,255,.93);backdrop-filter:blur(6px);border-radius:8px;padding:4px 11px;font-size:var(--fs-xs);font-weight:700;color:var(--navy)}
    .berita-grid-body{padding:16px;flex:1;display:flex;flex-direction:column;gap:7px}
    .cat{display:inline-flex;padding:3px 11px;border-radius:20px;font-size:var(--fs-xs);font-weight:700;text-transform:uppercase;letter-spacing:.04em;background:#eff6ff;color:#1c64f2;width:fit-content}
    .berita-grid-title{font-size:var(--fs-base);font-weight:700;color:var(--navy);line-height:1.45;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .berita-grid-desc{font-size:var(--fs-sm);color:var(--muted);line-height:1.6;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .link-baca{font-size:var(--fs-sm);font-weight:700;color:var(--blue);text-decoration:none;display:inline-flex;align-items:center;gap:5px;margin-top:auto;padding-top:4px}
    .link-baca i{transition:transform .18s}
    .berita-grid-card:hover .link-baca i{transform:translateX(4px)}

    /* ── OVERLAY BERITA CARD ── */
    .berita-ov-card{position:relative;border-radius:16px;overflow:hidden;text-decoration:none;display:block;height:240px;background:linear-gradient(135deg,var(--navy) 0%,#1e3a5f 100%);transition:transform .22s,box-shadow .22s}
    .berita-ov-card:hover{transform:translateY(-4px);box-shadow:0 12px 32px rgba(0,0,0,.18)}
    .berita-ov-card img{position:absolute;inset:0;width:100%;height:100%;object-fit:cover;transition:transform .4s ease}
    .berita-ov-card:hover img{transform:scale(1.05)}
    .berita-ov-grad{position:absolute;inset:0;background:linear-gradient(to top,rgba(10,20,50,.88) 0%,rgba(10,20,50,.3) 55%,transparent 100%)}
    .berita-ov-body{position:absolute;bottom:0;left:0;right:0;padding:16px}
    .berita-ov-cat{display:inline-block;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;background:var(--blue);color:white;text-transform:uppercase;letter-spacing:.04em;margin-bottom:7px}
    .berita-ov-title{font-size:14px;font-weight:700;color:white;line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;margin-bottom:6px}
    .berita-ov-date{font-size:11px;color:rgba(255,255,255,.65);display:flex;align-items:center;gap:5px}

    /* ── SIDEBAR CARDS ── */
    .sidebar-card{background:white;border:1px solid var(--border);border-radius:14px;overflow:hidden;margin-bottom:16px}
    .sidebar-card:last-child{margin-bottom:0}

    /* ── SAMBUTAN LURAH ── */
    .kepala-card{background:white;border:1px solid var(--border);border-radius:14px;overflow:hidden;margin-bottom:16px}
    .kepala-card-header{background:linear-gradient(135deg,var(--navy),var(--navy2));padding:13px 18px;display:flex;align-items:center;gap:10px}
    .kepala-card-header-icon{width:34px;height:34px;background:rgba(255,255,255,.18);border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-size:17px}
    .kepala-card-header-title{font-size:var(--fs-base);font-weight:700;color:white}
    .kepala-card-body{padding:18px}
    .kepala-photo-outer{width:80px;height:80px;border-radius:50%;overflow:hidden;flex-shrink:0;border:3px solid #bfdbfe;background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:32px}
    .kepala-photo-outer img{width:100%;height:100%;object-fit:cover;object-position:top}
    .kepala-info-name{font-size:var(--fs-base);font-weight:800;color:var(--navy);line-height:1.3;margin-bottom:2px}
    .kepala-info-jabat{font-size:var(--fs-xs);font-weight:700;color:var(--blue);text-transform:uppercase;letter-spacing:.07em}
    .kepala-divider{border:none;border-top:1px dashed var(--border);margin:14px 0}
    .kepala-sambutan-text{font-size:var(--fs-sm);color:var(--slate);line-height:1.75;font-style:italic;padding-left:14px;border-left:3px solid var(--blue)}

    /* ── JAM OPERASIONAL ── */
    .jam-header{background:var(--blue);padding:14px 18px;display:flex;align-items:center;gap:12px}
    .jam-header-icon{width:34px;height:34px;background:rgba(255,255,255,.2);border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-size:17px}
    .jam-header-text .jam-title{font-size:var(--fs-base);font-weight:700;color:white;line-height:1.2}
    .jam-header-text .jam-subtitle{font-size:var(--fs-xs);color:rgba(255,255,255,.82)}
    .jam-body{padding:12px 18px}
    .jam-row{display:flex;justify-content:space-between;align-items:center;padding:10px 0;border-bottom:1px solid var(--border);font-size:var(--fs-base)}
    .jam-row:last-child{border-bottom:none}
    .jam-day{font-weight:600;color:var(--navy)}
    .jam-time{color:var(--slate)}
    .jam-tutup{display:inline-flex;padding:3px 10px;border-radius:20px;font-size:var(--fs-xs);font-weight:700;background:#fef2f2;color:var(--red)}

    /* ── STATUS BADGE REAL-TIME ── */
    .status-buka{display:inline-flex;align-items:center;gap:5px;padding:3px 12px;border-radius:20px;font-size:12px;font-weight:700;background:#dcfce7;color:#16a34a}
    .status-tutup{display:inline-flex;align-items:center;gap:5px;padding:3px 12px;border-radius:20px;font-size:12px;font-weight:700;background:#fef2f2;color:#dc2626}
    .status-dot{width:7px;height:7px;border-radius:50%;display:inline-block;flex-shrink:0}
    .status-dot-buka{background:#16a34a;animation:pulse-green 1.5s ease-in-out infinite}
    .status-dot-tutup{background:#dc2626}
    @keyframes pulse-green{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(0.85)}}
    .jam-date{font-size:11px;color:#1e293b;font-weight:600;padding:8px 0 2px;display:flex;align-items:center;gap:5px}
    .jam-holiday{display:flex;align-items:flex-start;gap:8px;padding:8px 10px;background:#fff7ed;border-radius:8px;margin:6px 0 2px;border:1px solid #fed7aa}
    .jam-holiday-icon{color:#ea580c;font-size:13px;flex-shrink:0;margin-top:1px}
    .jam-holiday-text{font-size:11px;color:#9a3412;font-weight:600;line-height:1.4}

    /* ── PENGUMUMAN ── */
    .pengumuman-body{padding:16px 18px}
    .pengumuman-title{font-size:var(--fs-base);font-weight:700;color:var(--orange);display:flex;align-items:center;gap:7px;margin-bottom:8px}
    .pengumuman-text{font-size:var(--fs-sm);color:var(--slate);line-height:1.7}

    /* ── BANTUAN ── */
    .bantuan-body{padding:14px 18px}
    .bantuan-title{font-size:var(--fs-base);font-weight:700;color:var(--navy);margin-bottom:12px}
    .bantuan-item{display:flex;align-items:center;gap:12px;padding:10px 0;border-bottom:1px solid var(--border)}
    .bantuan-item:last-child{border-bottom:none}
    .bantuan-icon{width:38px;height:38px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
    .bantuan-label{font-size:var(--fs-xs);color:var(--muted);line-height:1.3}
    .bantuan-value{font-size:var(--fs-base);font-weight:700;color:var(--navy);line-height:1.3}

    /* ── EMPTY STATE ── */
    .berita-empty{padding:40px 20px;text-align:center;color:var(--muted);font-size:var(--fs-base);border:1px solid var(--border);border-radius:14px;background:white}

    /* ── HERO ENTRANCE (CSS — tidak bergantung GSAP) ── */
    @keyframes heroFadeUp{from{opacity:0;transform:translateY(22px)}to{opacity:1;transform:translateY(0)}}
    .hero-badge{animation:heroFadeUp .55s ease both;animation-delay:.05s}
    .hero-title{animation:heroFadeUp .7s ease both;animation-delay:.2s}
    .hero-desc{animation:heroFadeUp .65s ease both;animation-delay:.38s}
    .btn-hero-detail{animation:heroFadeUp .55s ease both;animation-delay:.55s}

    /* ── ANIMATIONS (GSAP handles scroll animations) ── */
    .fade-up-1{animation-delay:.08s}
    .fade-up-2{animation-delay:.18s}
    .fade-up-3{animation-delay:.28s}

    /* ── RESPONSIVE ── */
    @media(max-width:991px){
        .hero-section{margin:16px;padding:40px 24px}
        .hero-title{font-size:32px}
        .hero-emblem{display:none}
        .content-area{padding:0 16px 36px}
    }
    @media(max-width:576px){
        .hero-title{font-size:26px}
        .btn-hero-detail{padding:11px 20px;font-size:var(--fs-sm)}
    }
    </style>
</head>
<body>

@include('partials.navbar')

{{-- ═══ HERO ═══ --}}
<div class="hero-section">
    <div style="position:relative;z-index:2;max-width:580px">
        <div class="hero-badge">
            <i class="bi bi-star-fill" style="font-size:10px"></i>
            Layanan Digital Terpadu
        </div>
        <h1 class="hero-title">
            Kelurahan Teritih<br><span>Kota Serang</span>
        </h1>
        <p class="hero-desc">
            Selamat datang di portal resmi pelayanan publik. Dapatkan akses mudah ke informasi terkini, layanan administrasi kependudukan, dan pengajuan surat secara online.
        </p>
        <a href="{{ route('profil') }}" class="btn-hero-detail">
            <i class="bi bi-building"></i> Detail Kelurahan
        </a>
    </div>
    <div class="hero-emblem"><i class="bi bi-bank2"></i></div>
</div>

{{-- ═══ MAIN CONTENT ═══ --}}
<div class="content-area">
    <div class="row g-4 mt-1">

        {{-- ══ LEFT COLUMN ══ --}}
        <div class="col-lg-8">

            {{-- Akses Cepat --}}
            <div id="layanan" class="mb-4">
                <div class="section-label">
                    <i class="bi bi-grid-fill"></i> Akses Cepat
                </div>
                <div class="row g-3">
                    <div class="col-md-4 col-6">
                        <a href="{{ route('layanan') }}#pilih-jenis-surat" class="akses-card">
                            <div class="akses-icon" style="background:#eff6ff;color:var(--blue)"><i class="bi bi-file-earmark-plus-fill"></i></div>
                            <div class="akses-title">Ajukan Surat</div>
                            <div class="akses-desc">Buat permohonan surat keterangan secara online.</div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        @auth
                            <a href="{{ route('user.permohonan.index') }}" class="akses-card">
                        @else
                            <a href="{{ route('login') }}" class="akses-card">
                        @endauth
                            <div class="akses-icon" style="background:#f0fdf4;color:#16a34a"><i class="bi bi-clipboard2-check-fill"></i></div>
                            <div class="akses-title">Cek Status Surat</div>
                            <div class="akses-desc">Pantau status permohonan surat kamu.</div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ route('demografi') }}#statistik" class="akses-card">
                            <div class="akses-icon" style="background:#fdf4ff;color:#9333ea"><i class="bi bi-bar-chart-fill"></i></div>
                            <div class="akses-title">Statistik Kelurahan</div>
                            <div class="akses-desc">Data demografi dan kependudukan warga.</div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- ══ BERITA ══ --}}
            <div class="">
                <div class="berita-section-header">
                    <div class="section-label mb-0">
                        <i class="bi bi-newspaper"></i> Kabar Kelurahan Terkini
                    </div>
                    <a href="{{ route('berita') }}" class="link-semua">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                @if($beritaTerbaru->isEmpty())
                    <div class="berita-empty">
                        <i class="bi bi-newspaper" style="font-size:36px;display:block;margin-bottom:12px;color:#e2e8f0"></i>
                        Belum ada berita yang dipublikasikan.
                    </div>
                @else
                @php $beritaAll = $beritaTerbaru->take(3); $featured = $beritaAll->first(); $rest = $beritaAll->skip(1); @endphp
                <div class="row g-3 align-items-stretch">
                    <div class="col-md-7" style="min-height:420px">
                        <a href="{{ route('berita.detail', $featured->slug) }}" class="berita-ov-card" style="height:420px">
                            @if($featured->gambar)<img src="{{ asset('storage/'.$featured->gambar) }}" alt="{{ $featured->judul }}">@endif
                            <div class="berita-ov-grad"></div>
                            <div class="berita-ov-body">
                                @if($featured->kategori)<span class="berita-ov-cat">{{ $featured->kategori }}</span>@endif
                                <div class="berita-ov-title" style="font-size:15px;-webkit-line-clamp:3">{{ Str::limit($featured->judul, 80) }}</div>
                                <div class="berita-ov-date"><i class="bi bi-calendar3" style="font-size:10px"></i> {{ $featured->tanggal_publish ? \Carbon\Carbon::parse($featured->tanggal_publish)->translatedFormat('d M Y') : '-' }}</div>
                            </div>
                        </a>
                    </div>
                    <div class="col-md-5 d-flex flex-column gap-3" style="height:420px">
                        @foreach($rest as $b)
                        <a href="{{ route('berita.detail', $b->slug) }}" class="berita-ov-card" style="flex:1;min-height:180px">
                            @if($b->gambar)<img src="{{ asset('storage/'.$b->gambar) }}" alt="{{ $b->judul }}">@endif
                            <div class="berita-ov-grad"></div>
                            <div class="berita-ov-body">
                                @if($b->kategori)<span class="berita-ov-cat">{{ $b->kategori }}</span>@endif
                                <div class="berita-ov-title" style="-webkit-line-clamp:2">{{ Str::limit($b->judul, 60) }}</div>
                                <div class="berita-ov-date"><i class="bi bi-calendar3" style="font-size:10px"></i> {{ $b->tanggal_publish ? \Carbon\Carbon::parse($b->tanggal_publish)->translatedFormat('d M Y') : '-' }}</div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endif
            </div>

        </div>
        {{-- /LEFT --}}

        {{-- ══ RIGHT COLUMN ══ --}}
        <div class="col-lg-4">

            {{-- SAMBUTAN LURAH --}}
            <div class="kepala-card">
                <div class="kepala-card-header">
                    <div class="kepala-card-header-icon"><i class="bi bi-person-badge-fill"></i></div>
                    <div class="kepala-card-header-title">Sambutan Lurah</div>
                </div>
                <div class="kepala-card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="kepala-photo-outer">
                            @if($fotoLurah)
                                <img src="{{ asset('storage/'.$fotoLurah) }}" alt="{{ $namaLurah }}">
                            @else
                                <img src="{{ asset('images/PP_LURAH.png') }}" alt="{{ $namaLurah }}">
                            @endif
                        </div>
                        <div>
                            <div class="kepala-info-name">{{ $namaLurah }}</div>
                            <div class="kepala-info-jabat">{{ $jabatLurah }}</div>
                        </div>
                    </div>
                    <hr class="kepala-divider">
                    <div class="kepala-sambutan-text">
                        Selamat datang di portal resmi Kelurahan Teritih. Kami berkomitmen melayani masyarakat dengan cepat, mudah, dan transparan demi mewujudkan kelurahan yang maju dan sejahtera bagi seluruh warga.
                    </div>
                </div>
            </div>

            {{-- Jam Operasional --}}
            <div class="sidebar-card">
                <div class="jam-header">
                    <div class="jam-header-icon"><i class="bi bi-clock-fill"></i></div>
                    <div class="jam-header-text">
                        <div class="jam-title">Jam Operasional</div>
                        <div class="jam-subtitle">Kantor Kelurahan Teritih</div>
                    </div>
                </div>
                <div class="jam-body">
                    <div class="jam-row">
                        <span class="jam-day">Senin – Kamis</span>
                        <span class="jam-time">08:00 – 16:00</span>
                    </div>
                    <div class="jam-row">
                        <span class="jam-day">Jumat</span>
                        <span class="jam-time">08:00 – 15:30</span>
                    </div>
                    <div class="jam-row">
                        <span class="jam-day">Sabtu – Minggu</span>
                        <span class="jam-tutup">Tutup</span>
                    </div>
                    {{-- STATUS REAL-TIME --}}
                    <div class="jam-row" style="border-bottom:none;padding-top:12px;margin-top:2px;border-top:1px dashed var(--border)">
                        <span class="jam-day" style="font-size:13px;font-weight:600">Status Sekarang</span>
                        <span id="jam-status-home"></span>
                    </div>
                    {{-- TANGGAL & HARI LIBUR --}}
                    <div id="jam-date-home" class="jam-date"></div>
                    <div id="jam-holiday-home"></div>
                </div>
            </div>

            {{-- Pengumuman Penting --}}
            <div class="sidebar-card">
                <div class="pengumuman-body">
                    <div class="pengumuman-title">
                        <i class="bi bi-megaphone-fill"></i> Pengumuman Penting
                    </div>
                    <div class="pengumuman-text">
                        Layanan administrasi kependudukan tersedia pada hari kerja Senin–Kamis pukul 08.00–16.00 dan Jumat pukul 08.00–15.30. Harap membawa dokumen persyaratan yang lengkap saat mengajukan permohonan.
                    </div>
                </div>
            </div>



        </div>
        {{-- /RIGHT --}}

    </div>
</div>

@include('partials.footer')

{{-- ═══ SCRIPT: STATUS JAM OPERASIONAL + HARI LIBUR NASIONAL ═══ --}}
<script>
(function () {
    var HARI = ['Minggu','Senin','Selasa','Rabu','Kamis','Jumat','Sabtu'];
    var BULAN = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    var now  = new Date();
    var wib  = new Date(now.toLocaleString('en-US', {timeZone:'Asia/Jakarta'}));
    var day  = wib.getDay();
    var tot  = wib.getHours() * 60 + wib.getMinutes();
    var year = wib.getFullYear();
    var mm   = String(wib.getMonth()+1).padStart(2,'0');
    var dd   = String(wib.getDate()).padStart(2,'0');
    var todayStr = year + '-' + mm + '-' + dd;

    // Tampilkan tanggal hari ini
    var dateLabel = HARI[day] + ', ' + wib.getDate() + ' ' + BULAN[wib.getMonth()] + ' ' + year;
    var elDate = document.getElementById('jam-date-home');
    if (elDate) elDate.innerHTML = '<i class="bi bi-calendar3"></i> ' + dateLabel;

    function setStatus(isOpen, isHoliday) {
        var elStatus = document.getElementById('jam-status-home');
        if (!elStatus) return;
        if (isOpen && !isHoliday) {
            elStatus.innerHTML = '<span class="status-buka"><span class="status-dot status-dot-buka"></span>Sedang Buka</span>';
        } else {
            elStatus.innerHTML = '<span class="status-tutup"><span class="status-dot status-dot-tutup"></span>Sedang Tutup</span>';
        }
    }

    function showHoliday(name) {
        var el = document.getElementById('jam-holiday-home');
        if (!el) return;
        el.innerHTML = '<div class="jam-holiday"><span class="jam-holiday-icon"><i class="bi bi-calendar-x-fill"></i></span><span class="jam-holiday-text">Hari Libur Nasional: ' + name + '</span></div>';
    }

    // Cek jam operasional (tanpa hari libur dulu)
    var isOpenByTime = (day >= 1 && day <= 4 && tot >= 480 && tot < 960)
                    || (day === 5 && tot >= 480 && tot < 930);

    // Fetch API hari libur
    fetch('https://api-harilibur.vercel.app/api?year=' + year)
        .then(function(r){ return r.json(); })
        .then(function(data) {
            var holiday = null;
            if (Array.isArray(data)) {
                for (var i = 0; i < data.length; i++) {
                    var h = data[i];
                    // Format API: holiday_date = "YYYY-MM-DD"
                    if (h.holiday_date === todayStr) {
                        holiday = h.holiday_name;
                        break;
                    }
                }
            }
            if (holiday) {
                showHoliday(holiday);
                setStatus(false, true); // Hari libur = tutup
            } else {
                setStatus(isOpenByTime, false);
            }
        })
        .catch(function() {
            // Fallback jika API gagal: gunakan logika waktu saja
            setStatus(isOpenByTime, false);
        });
})();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script>
gsap.registerPlugin(ScrollTrigger);

function onScroll(trigger, fn) {
    ScrollTrigger.create({trigger:trigger, start:'top 88%', once:true, onEnter:fn});
}

// ── Hero: emblem only via GSAP, rest via CSS ──
gsap.from('.hero-emblem',{opacity:0,scale:.4,rotation:-20,duration:1.2,delay:.3,ease:'elastic.out(1,.5)'});

// ── Akses Cepat cards ──
(function(){
    const cards = document.querySelectorAll('.akses-card');
    if (!cards.length) return;
    gsap.set(cards, {opacity:0, y:30, scale:.95});
    onScroll(cards[0], ()=> gsap.to(cards, {opacity:1, y:0, scale:1, duration:.5, stagger:.07, ease:'back.out(1.4)'}));
})();

// ── Berita cards ──
(function(){
    const cards = document.querySelectorAll('.berita-ov-card');
    if (!cards.length) return;
    gsap.set(cards, {opacity:0, y:35});
    onScroll(cards[0], ()=> gsap.to(cards, {opacity:1, y:0, duration:.55, stagger:.1, ease:'power2.out'}));
})();

// ── Sidebar cards ──
(function(){
    const cards = document.querySelectorAll('.sidebar-card, .kepala-card');
    if (!cards.length) return;
    gsap.set(cards, {opacity:0, x:30});
    onScroll(cards[0], ()=> gsap.to(cards, {opacity:1, x:0, duration:.6, stagger:.12, ease:'power3.out'}));
})();

// ── Section labels ──
document.querySelectorAll('.section-label').forEach(t => {
    gsap.set(t, {opacity:0, x:-18});
    onScroll(t, ()=> gsap.to(t, {opacity:1, x:0, duration:.45, ease:'power2.out'}));
});
</script>
</body>
</html>
