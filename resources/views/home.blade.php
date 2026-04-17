<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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

    /* ── ANIMATIONS ── */
    @keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
    .fade-up{animation:fadeUp .5s ease both}
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
<div class="hero-section fade-up">
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
            <div id="layanan" class="mb-4 fade-up fade-up-1">
                <div class="section-label">
                    <i class="bi bi-grid-fill"></i> Akses Cepat
                </div>
                <div class="row g-3">
                    <div class="col-md-4 col-6">
                        <a href="{{ route('informasi.berita') }}" class="akses-card">
                            <div class="akses-icon" style="background:#fef3c7;color:#d97706"><i class="bi bi-calendar-event-fill"></i></div>
                            <div class="akses-title">Berita &amp;<br>Pengumuman</div>
                            <div class="akses-desc">Informasi kegiatan dan pengumuman terbaru.</div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ route('layanan') }}" class="akses-card">
                            <div class="akses-icon" style="background:#eff6ff;color:var(--blue)"><i class="bi bi-people-fill"></i></div>
                            <div class="akses-title">Layanan<br>Administrasi</div>
                            <div class="akses-desc">Panduan lengkap pengurusan dokumen.</div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        @auth
                            <a href="{{ route('layanan') }}" class="akses-card">
                        @else
                            <a href="{{ route('login') }}" class="akses-card">
                        @endauth
                            <div class="akses-icon" style="background:#eff6ff;color:var(--blue)"><i class="bi bi-file-earmark-text-fill"></i></div>
                            <div class="akses-title">Permohonan Surat</div>
                            <div class="akses-desc">Buat surat keterangan secara online.</div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- ══ BERITA: 2 besar + 2 sedang = 4 total ══ --}}
            <div class="fade-up fade-up-2">
                <div class="berita-section-header">
                    <div class="section-label mb-0">
                        <i class="bi bi-newspaper"></i> Kabar Kelurahan Terkini
                    </div>
                    <a href="{{ route('informasi.berita') }}" class="link-semua">
                        Lihat Semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>

                @if($beritaTerbaru->isEmpty())
                    <div class="berita-empty">
                        <i class="bi bi-newspaper" style="font-size:36px;display:block;margin-bottom:12px;color:#e2e8f0"></i>
                        Belum ada berita yang dipublikasikan.
                    </div>
                @else
                    {{-- Baris 1: 2 kartu besar --}}
                    <div class="row g-3 mb-3">
                        @foreach($beritaTerbaru->take(2) as $b)
                        <div class="col-sm-6">
                            <a href="{{ route('informasi.berita.detail', $b->slug) }}" class="berita-grid-card">
                                <div class="berita-grid-img" style="height:200px">
                                    @if($b->gambar)
                                        <img src="{{ asset('storage/'.$b->gambar) }}" alt="{{ $b->judul }}">
                                    @else
                                        <i class="bi bi-image"></i>
                                    @endif
                                    <span class="date-pill">
                                        {{ $b->tanggal_publish ? \Carbon\Carbon::parse($b->tanggal_publish)->format('d M Y') : '-' }}
                                    </span>
                                </div>
                                <div class="berita-grid-body">
                                    @if($b->kategori)<span class="cat">{{ $b->kategori }}</span>@endif
                                    <div class="berita-grid-title">{{ Str::limit($b->judul, 70) }}</div>
                                    <div class="berita-grid-desc">{{ Str::limit(strip_tags($b->ringkasan ?? $b->isi), 100) }}</div>
                                    <span class="link-baca">Baca Selengkapnya <i class="bi bi-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>

                    {{-- Baris 2: 2 kartu sedang --}}
                    @php $beritaBawah = $beritaTerbaru->skip(2)->take(2); @endphp
                    @if($beritaBawah->count() > 0)
                    <div class="row g-3">
                        @foreach($beritaBawah as $b)
                        <div class="col-sm-6">
                            <a href="{{ route('informasi.berita.detail', $b->slug) }}" class="berita-grid-card">
                                <div class="berita-grid-img" style="height:150px">
                                    @if($b->gambar)
                                        <img src="{{ asset('storage/'.$b->gambar) }}" alt="{{ $b->judul }}">
                                    @else
                                        <i class="bi bi-image" style="font-size:28px"></i>
                                    @endif
                                    <span class="date-pill">
                                        {{ $b->tanggal_publish ? \Carbon\Carbon::parse($b->tanggal_publish)->format('d M Y') : '-' }}
                                    </span>
                                </div>
                                <div class="berita-grid-body">
                                    @if($b->kategori)<span class="cat">{{ $b->kategori }}</span>@endif
                                    <div class="berita-grid-title" style="-webkit-line-clamp:2">{{ Str::limit($b->judul, 65) }}</div>
                                    <div class="berita-grid-desc">{{ Str::limit(strip_tags($b->ringkasan ?? $b->isi), 80) }}</div>
                                    <span class="link-baca">Baca Selengkapnya <i class="bi bi-arrow-right"></i></span>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                    @endif

                @endif
            </div>

        </div>
        {{-- /LEFT --}}

        {{-- ══ RIGHT COLUMN ══ --}}
        <div class="col-lg-4 fade-up fade-up-3">

            {{-- SAMBUTAN LURAH --}}
            <div class="kepala-card">
                <div class="kepala-card-header">
                    <div class="kepala-card-header-icon"><i class="bi bi-person-badge-fill"></i></div>
                    <div class="kepala-card-header-title">Sambutan Lurah</div>
                </div>
                <div class="kepala-card-body">
                    <div class="d-flex align-items-center gap-3">
                        <div class="kepala-photo-outer">
                            {{--
                                Untuk memasang foto lurah, uncomment baris berikut:
                                <img src="{{ asset('storage/foto-lurah.jpg') }}" alt="Lurah">
                                Atau dari database:
                                <img src="{{ asset('storage/'.$lurah->foto) }}" alt="{{ $lurah->nama }}">
                            --}}
                            <i class="bi bi-person-fill"></i>
                        </div>
                        <div>
                            <div class="kepala-info-name">H. Ahmad Fauzi, S.Sos</div>
                            <div class="kepala-info-jabat">Lurah Teritih</div>
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
                </div>
            </div>

            {{-- Pengumuman Penting --}}
            <div class="sidebar-card">
                <div class="pengumuman-body">
                    <div class="pengumuman-title">
                        <i class="bi bi-megaphone-fill"></i> Pengumuman Penting
                    </div>
                    <div class="pengumuman-text">
                        Untuk pengurusan KTP Digital, dimohon membawa KTP fisik asli dan Smartphone Android/iOS. Pelayanan tersedia di Loket 2.
                    </div>
                </div>
            </div>

            {{-- Butuh Bantuan --}}
            <div class="sidebar-card">
                <div class="bantuan-body">
                    <div class="bantuan-title">Butuh Bantuan?</div>
                    <div class="bantuan-item">
                        <div class="bantuan-icon" style="background:#ecfdf5;color:var(--green)"><i class="bi bi-chat-dots-fill"></i></div>
                        <div>
                            <div class="bantuan-label">Chat WhatsApp</div>
                            <div class="bantuan-value">0812-3456-7890</div>
                        </div>
                    </div>
                    <div class="bantuan-item">
                        <div class="bantuan-icon" style="background:#eff6ff;color:var(--blue)"><i class="bi bi-telephone-fill"></i></div>
                        <div>
                            <div class="bantuan-label">Call Center</div>
                            <div class="bantuan-value">(0254) 123456</div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- /RIGHT --}}

    </div>
</div>

@include('partials.footer')

{{-- ═══ SCRIPT: STATUS JAM OPERASIONAL REAL-TIME (WIB) ═══ --}}
<script>
(function () {
    /*
     * JAM OPERASIONAL:
     *   Senin – Kamis : 08:00 – 16:00  (menit: 480 s/d < 960)
     *   Jumat         : 08:00 – 15:30  (menit: 480 s/d < 930)
     *   Sabtu & Minggu: TUTUP
     */
    var now  = new Date();
    var wib  = new Date(now.toLocaleString('en-US', { timeZone: 'Asia/Jakarta' }));
    var day  = wib.getDay();        // 0=Minggu,1=Senin,2=Selasa,3=Rabu,4=Kamis,5=Jumat,6=Sabtu
    var tot  = wib.getHours() * 60 + wib.getMinutes(); // total menit dari 00:00

    var isOpen = false;

    if (day >= 1 && day <= 4) {
        // Senin – Kamis: 08:00 (480) s/d 16:00 (960, tidak termasuk)
        isOpen = tot >= 480 && tot < 960;
    } else if (day === 5) {
        // Jumat: 08:00 (480) s/d 15:30 (930, tidak termasuk)
        isOpen = tot >= 480 && tot < 930;
    }
    // Sabtu (6) & Minggu (0): isOpen tetap false

    var htmlBuka  = '<span class="status-buka"><span class="status-dot status-dot-buka"></span>Sedang Buka</span>';
    var htmlTutup = '<span class="status-tutup"><span class="status-dot status-dot-tutup"></span>Sedang Tutup</span>';

    var el = document.getElementById('jam-status-home');
    if (el) el.innerHTML = isOpen ? htmlBuka : htmlTutup;
})();
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>