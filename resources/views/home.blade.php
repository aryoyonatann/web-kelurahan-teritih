<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelurahan Teritih – Portal Pelayanan Publik</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400&display=swap" rel="stylesheet">
    <style>
    :root {
        --blue:#1c64f2;--blue-dk:#1a56db;--blue-lt:#eff6ff;
        --navy:#0d1b3e;--navy2:#1e3a5f;--slate:#334155;
        --muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;
        --green:#10b981;--orange:#f59e0b;--red:#ef4444;
    }
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:#fff;color:var(--slate);font-size:14px;line-height:1.6}
    .hero-section{background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 55%,#1e4d8c 100%);border-radius:16px;margin:24px 32px;padding:56px;position:relative;overflow:hidden;min-height:320px;display:flex;align-items:center}
    .hero-section::before{content:'';position:absolute;right:-60px;top:-60px;width:340px;height:340px;border-radius:50%;border:40px solid rgba(255,255,255,.05)}
    .hero-section::after{content:'';position:absolute;right:60px;top:40px;width:200px;height:200px;border-radius:50%;border:24px solid rgba(255,255,255,.07)}
    .hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);border-radius:20px;padding:4px 12px;font-size:11px;font-weight:700;letter-spacing:.08em;text-transform:uppercase;color:#fbbf24;margin-bottom:18px}
    .hero-title{font-size:42px;font-weight:800;color:white;line-height:1.15;margin-bottom:6px}
    .hero-title span{color:#60a5fa}
    .hero-desc{font-size:14.5px;color:rgba(255,255,255,.75);max-width:480px;line-height:1.7;margin-bottom:28px}
    .hero-actions{display:flex;gap:12px;flex-wrap:wrap}
    .btn-hero-primary{display:inline-flex;align-items:center;gap:8px;padding:11px 24px;border-radius:10px;font-size:14px;font-weight:700;background:var(--blue);color:white;border:none;text-decoration:none;transition:background .18s}
    .btn-hero-primary:hover{background:var(--blue-dk);color:white}
    .btn-hero-outline{display:inline-flex;align-items:center;gap:8px;padding:11px 24px;border-radius:10px;font-size:14px;font-weight:700;background:rgba(255,255,255,.12);border:1.5px solid rgba(255,255,255,.3);color:white;text-decoration:none;transition:all .18s}
    .btn-hero-outline:hover{background:rgba(255,255,255,.2);color:white}
    .hero-emblem{position:absolute;right:80px;top:50%;transform:translateY(-50%);width:170px;height:170px;background:rgba(255,255,255,.08);border:2px solid rgba(255,255,255,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.6);font-size:70px}
    .content-area{padding:0 32px 40px}
    .section-label{font-size:13px;font-weight:700;color:var(--navy);display:flex;align-items:center;gap:8px;margin-bottom:18px}
    .section-label i{color:var(--blue);font-size:18px}
    .akses-card{background:white;border:1px solid var(--border);border-radius:14px;padding:24px 18px;text-align:center;text-decoration:none;color:var(--navy);display:block;transition:all .2s;height:100%}
    .akses-card:hover{box-shadow:0 8px 24px rgba(28,100,242,.12);transform:translateY(-3px);border-color:#bfdbfe;color:var(--blue)}
    .akses-icon{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;margin:0 auto 14px}
    .akses-title{font-size:14px;font-weight:700;margin-bottom:6px}
    .akses-desc{font-size:12px;color:var(--muted);line-height:1.5}
    .berita-wrap{background:white;border:1px solid var(--border);border-radius:14px;overflow:hidden}
    .berita-header{padding:16px 20px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between}
    .berita-header-title{font-size:14px;font-weight:700;color:var(--navy);display:flex;align-items:center;gap:7px}
    .berita-header-title i{color:var(--blue)}
    .link-semua{font-size:12.5px;font-weight:600;color:var(--blue);text-decoration:none;display:flex;align-items:center;gap:4px;transition:gap .18s}
    .link-semua:hover{gap:7px;color:var(--blue-dk)}
    .berita-item-row{display:flex;gap:14px;align-items:flex-start;padding:16px 20px;border-bottom:1px solid var(--border);text-decoration:none;color:var(--slate);transition:background .18s}
    .berita-item-row:last-child{border-bottom:none}
    .berita-item-row:hover{background:#f8fafc}
    .berita-img{width:88px;height:68px;border-radius:8px;background:var(--bg);flex-shrink:0;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:28px;overflow:hidden}
    .berita-img img{width:100%;height:100%;object-fit:cover}
    .berita-cat{display:inline-flex;padding:2px 9px;border-radius:20px;font-size:10px;font-weight:700;letter-spacing:.03em;text-transform:uppercase;background:#eff6ff;color:var(--blue)}
    .berita-item-title{font-size:13.5px;font-weight:700;color:var(--navy);line-height:1.4;margin-bottom:5px}
    .berita-item-desc{font-size:12px;color:var(--muted);line-height:1.55;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .berita-date{font-size:11px;color:var(--muted)}
    .sidebar-card{background:white;border:1px solid var(--border);border-radius:14px;overflow:hidden;margin-bottom:16px}
    .sidebar-card:last-child{margin-bottom:0}
    .jam-header{background:var(--blue);padding:14px 18px;display:flex;align-items:center;gap:10px}
    .jam-header-icon{width:32px;height:32px;background:rgba(255,255,255,.2);border-radius:8px;display:flex;align-items:center;justify-content:center;color:white;font-size:16px}
    .jam-header-text .jam-title{font-size:13px;font-weight:700;color:white;line-height:1.2}
    .jam-header-text .jam-subtitle{font-size:11px;color:rgba(255,255,255,.8)}
    .jam-body{padding:12px 18px}
    .jam-row{display:flex;justify-content:space-between;align-items:center;padding:8px 0;border-bottom:1px solid var(--border);font-size:13px}
    .jam-row:last-child{border-bottom:none}
    .jam-day{font-weight:600;color:var(--navy)}
    .jam-time{color:var(--slate);font-size:12.5px}
    .jam-tutup{display:inline-flex;padding:2px 9px;border-radius:20px;font-size:10px;font-weight:700;background:#fef2f2;color:var(--red)}
    .pengumuman-body{padding:14px 18px}
    .pengumuman-title{font-size:13px;font-weight:700;color:var(--orange);display:flex;align-items:center;gap:6px;margin-bottom:8px}
    .pengumuman-text{font-size:12.5px;color:var(--slate);line-height:1.6}
    .bantuan-body{padding:14px 18px}
    .bantuan-title{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:12px}
    .bantuan-item{display:flex;align-items:center;gap:10px;padding:9px 0;border-bottom:1px solid var(--border)}
    .bantuan-item:last-child{border-bottom:none}
    .bantuan-icon{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
    .bantuan-label{font-size:11px;color:var(--muted);line-height:1.2}
    .bantuan-value{font-size:13px;font-weight:700;color:var(--navy);line-height:1.2}
    .berita-empty{padding:32px 20px;text-align:center;color:var(--muted);font-size:13px}
    @keyframes fadeUp{from{opacity:0;transform:translateY(20px)}to{opacity:1;transform:translateY(0)}}
    .fade-up{animation:fadeUp .5s ease both}
    .fade-up-1{animation-delay:.1s}
    .fade-up-2{animation-delay:.2s}
    .fade-up-3{animation-delay:.3s}
    @media(max-width:991px){.hero-section{margin:16px;padding:36px 28px}.hero-title{font-size:30px}.hero-emblem{display:none}.content-area{padding:0 16px 32px}}
    @media(max-width:576px){.hero-title{font-size:26px}.btn-hero-primary,.btn-hero-outline{padding:9px 18px;font-size:13px}}
    </style>
</head>
<body>

@include('partials.navbar')

<div class="hero-section fade-up">
    <div style="position:relative;z-index:2;max-width:580px;">
        <div class="hero-badge">
            <i class="bi bi-star-fill" style="font-size:10px"></i>
            Layanan Digital Terpadu
        </div>
        <h1 class="hero-title">
            Kelurahan Teritih<br>
            <span>Kota Serang</span>
        </h1>
        <p class="hero-desc">
            Selamat datang di portal resmi pelayanan publik. Dapatkan akses mudah ke informasi terkini, layanan administrasi kependudukan, dan pengajuan surat secara online.
        </p>
        <div class="hero-actions">
            @auth
                <a href="{{ route('user.permohonan.create') }}" class="btn-hero-primary">
                    <i class="bi bi-file-earmark-text"></i> Ajukan Surat
                </a>
            @else
                <a href="{{ route('login') }}" class="btn-hero-primary">
                    <i class="bi bi-file-earmark-text"></i> Ajukan Surat
                </a>
            @endauth
            <a href="#layanan" class="btn-hero-outline">
                <i class="bi bi-info-circle"></i> Panduan Layanan
            </a>
        </div>
    </div>
    <div class="hero-emblem">
        <i class="bi bi-bank2"></i>
    </div>
</div>

<div class="content-area">
    <div class="row g-4 mt-1">

        <div class="col-lg-8">

            <div id="layanan" class="mb-4 fade-up fade-up-1">
                <div class="section-label">
                    <i class="bi bi-grid-fill"></i> Akses Cepat
                </div>
                <div class="row g-3">
                    <div class="col-md-4 col-6">
                        <a href="{{ route('informasi.berita') }}" class="akses-card">
                            <div class="akses-icon" style="background:#fef3c7;color:#d97706">
                                <i class="bi bi-calendar-event-fill"></i>
                            </div>
                            <div class="akses-title">Berita &amp;<br>Pengumuman</div>
                            <div class="akses-desc">Informasi kegiatan dan pengumuman terbaru...</div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        <a href="{{ route('layanan') }}" class="akses-card">
                            <div class="akses-icon" style="background:#eff6ff;color:var(--blue)">
                                <i class="bi bi-people-fill"></i>
                            </div>
                            <div class="akses-title">Layanan<br>Administrasi</div>
                            <div class="akses-desc">Panduan lengkap pengurusan dokumen...</div>
                        </a>
                    </div>
                    <div class="col-md-4 col-6">
                        @auth
                            <a href="{{ route('user.permohonan.create') }}" class="akses-card">
                        @else
                            <a href="{{ route('login') }}" class="akses-card">
                        @endauth
                            <div class="akses-icon" style="background:#eff6ff;color:var(--blue)">
                                <i class="bi bi-file-earmark-text-fill"></i>
                            </div>
                            <div class="akses-title">Permohonan Surat</div>
                            <div class="akses-desc">Buat surat pengantar dan keterangan secara online.</div>
                        </a>
                    </div>
                </div>
            </div>

            {{-- BERITA DARI DATABASE --}}
            <div class="fade-up fade-up-2">
                <div class="berita-wrap">
                    <div class="berita-header">
                        <div class="berita-header-title">
                            <i class="bi bi-newspaper"></i> Kabar Kelurahan Terkini
                        </div>
                        <a href="{{ route('informasi.berita') }}" class="link-semua">
                            Lihat Semua <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>

                    @forelse($beritaTerbaru as $berita)
                    <a href="{{ route('informasi.berita.detail', $berita->slug) }}" class="berita-item-row">
                        <div class="berita-img">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}">
                            @else
                                <i class="bi bi-image"></i>
                            @endif
                        </div>
                        <div class="flex-grow-1">
                            <div class="d-flex align-items-center gap-2 mb-1">
                                @if($berita->kategori)
                                    <span class="berita-cat">{{ $berita->kategori }}</span>
                                @endif
                                <span class="berita-date">
                                    {{ $berita->tanggal_publish ? \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') : '-' }}
                                </span>
                            </div>
                            <div class="berita-item-title">{{ Str::limit($berita->judul, 70) }}</div>
                            <div class="berita-item-desc">{{ Str::limit(strip_tags($berita->ringkasan ?? $berita->isi), 120) }}</div>
                        </div>
                    </a>
                    @empty
                    <div class="berita-empty">
                        <i class="bi bi-newspaper" style="font-size:28px;display:block;margin-bottom:8px;color:#e2e8f0"></i>
                        Belum ada berita yang dipublikasikan.
                    </div>
                    @endforelse
                </div>
            </div>

        </div>

        <div class="col-lg-4 fade-up fade-up-3">

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
                        <span class="jam-day">Senin–Kamis</span>
                        <span class="jam-time">08:00 – 16:00</span>
                    </div>
                    <div class="jam-row">
                        <span class="jam-day">Jumat</span>
                        <span class="jam-time">08:00 – 16:30</span>
                    </div>
                    <div class="jam-row">
                        <span class="jam-day">Sabtu–Minggu</span>
                        <span class="jam-tutup">Tutup</span>
                    </div>
                </div>
            </div>

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
    </div>
</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>