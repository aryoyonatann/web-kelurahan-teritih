<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informasi Kelurahan – Kelurahan Teritih</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root{--blue:#1c64f2;--blue-dk:#1a56db;--blue-lt:#eff6ff;--navy:#0d1b3e;--navy2:#1e3a5f;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;--green:#10b981;--orange:#f59e0b;--red:#ef4444}
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:14px;line-height:1.6;min-height:100vh;display:flex;flex-direction:column}
    .info-hero{background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 55%,#1e4d8c 100%);margin:24px 32px;border-radius:20px;padding:52px 56px;position:relative;overflow:hidden;display:flex;align-items:center;min-height:230px}
    .info-hero::before{content:'';position:absolute;right:-60px;top:-60px;width:360px;height:360px;border-radius:50%;border:50px solid rgba(255,255,255,.04)}
    .hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);border-radius:20px;padding:4px 14px;font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#fbbf24;margin-bottom:14px}
    .hero-title{font-size:40px;font-weight:800;color:white;line-height:1.15;margin-bottom:12px}
    .hero-title span{color:#60a5fa}
    .hero-desc{font-size:14px;color:rgba(255,255,255,.72);max-width:500px;line-height:1.75}
    .hero-emblem{position:absolute;right:80px;top:50%;transform:translateY(-50%);width:150px;height:150px;background:rgba(255,255,255,.08);border:2px solid rgba(255,255,255,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.6);font-size:62px}
    .content-area{flex:1;padding:32px 32px 52px}
    .sec-title{font-size:18px;font-weight:800;color:var(--navy);display:flex;align-items:center;gap:9px;margin-bottom:3px}
    .sec-sub{font-size:12.5px;color:var(--muted);margin-bottom:20px}
    .stat-card{background:white;border:1px solid var(--border);border-radius:14px;padding:20px 18px;display:flex;align-items:center;gap:14px}
    .stat-icon{width:48px;height:48px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
    .stat-number{font-size:26px;font-weight:800;color:var(--navy);line-height:1.1}
    .stat-label{font-size:12px;color:var(--muted);font-weight:500}
    .demo-card{background:white;border:1px solid var(--border);border-radius:14px;padding:22px;height:100%}
    .demo-card-title{font-size:13px;font-weight:700;color:var(--navy);display:flex;align-items:center;gap:7px;margin-bottom:16px}
    .gender-pct{font-size:22px;font-weight:800}
    .gender-label{font-size:10px;font-weight:700;letter-spacing:.08em;text-transform:uppercase}
    .gender-bar{height:8px;border-radius:4px;overflow:hidden;background:var(--bg);margin:10px 0;display:flex}
    .gender-bar-m{background:var(--blue);border-radius:4px 0 0 4px}
    .gender-bar-f{background:#f43f5e;border-radius:0 4px 4px 0;flex:1}
    .gender-detail{background:var(--bg);border-radius:10px;padding:10px 14px;display:flex;align-items:center;gap:8px}
    .agama-row{display:flex;align-items:center;gap:10px;margin-bottom:10px}
    .agama-row:last-child{margin-bottom:0}
    .agama-name{min-width:165px;font-size:13px;color:var(--slate)}
    .agama-bar-wrap{flex:1;height:6px;border-radius:3px;background:var(--bg);overflow:hidden}
    .agama-fill{height:100%;border-radius:3px}
    .agama-pct{min-width:38px;text-align:right;font-weight:700;color:var(--navy);font-size:12px}
    .peta-card{background:white;border:1px solid var(--border);border-radius:16px;overflow:hidden}
    .berita-header{display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-bottom:20px}
    .link-semua{font-size:13px;font-weight:600;color:var(--blue);text-decoration:none;display:inline-flex;align-items:center;gap:5px;transition:gap .18s}
    .link-semua:hover{gap:8px;color:var(--blue-dk)}
    .berita-card{background:white;border:1px solid var(--border);border-radius:14px;overflow:hidden;text-decoration:none;color:inherit;display:flex;flex-direction:column;transition:all .2s;height:100%}
    .berita-card:hover{box-shadow:0 8px 24px rgba(0,0,0,.1);transform:translateY(-2px)}
    .berita-img{height:160px;overflow:hidden;position:relative;background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:32px}
    .berita-img img{width:100%;height:100%;object-fit:cover}
    .date-pill{position:absolute;top:10px;left:10px;background:rgba(255,255,255,.92);backdrop-filter:blur(4px);border-radius:7px;padding:3px 9px;font-size:11px;font-weight:700;color:var(--navy)}
    .berita-body{padding:16px;flex:1;display:flex;flex-direction:column}
    .berita-title{font-size:13.5px;font-weight:700;color:var(--navy);line-height:1.4;margin-bottom:6px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .berita-desc{font-size:12px;color:var(--muted);line-height:1.6;flex:1;margin-bottom:12px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .link-baca{font-size:12.5px;font-weight:600;color:var(--blue);text-decoration:none;display:inline-flex;align-items:center;gap:4px}
    .cat{display:inline-flex;padding:3px 10px;border-radius:20px;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;margin-bottom:8px;background:#eff6ff;color:#1c64f2}
    .update-badge{display:inline-flex;align-items:center;gap:6px;font-size:11.5px;color:var(--green);font-weight:600}
    .update-dot{width:7px;height:7px;border-radius:50%;background:var(--green);display:inline-block}
    .berita-empty-card{background:white;border:1px solid var(--border);border-radius:14px;padding:40px 20px;text-align:center;color:var(--muted)}
    @media(max-width:991px){.info-hero{margin:16px;padding:36px 24px}.hero-title{font-size:26px}.hero-emblem{display:none}.content-area{padding:20px 16px 36px}}
    </style>
</head>
<body>

@include('partials.navbar')

<div class="info-hero">
    <div style="position:relative;z-index:2;max-width:560px;">
        <div class="hero-badge"><i class="bi bi-bar-chart-fill" style="font-size:10px"></i> Data &amp; Publikasi</div>
        <h1 class="hero-title">Informasi <span>Kelurahan</span></h1>
        <p class="hero-desc">Akses data statistik kependudukan terbaru, berita kegiatan, dan peta wilayah Kelurahan Teritih secara transparan dan mudah dipahami.</p>
    </div>
    <div class="hero-emblem"><i class="bi bi-file-earmark-text-fill"></i></div>
</div>

<div class="content-area">

    {{-- STATISTIK DEMOGRAFI --}}
    @php
        $s  = $statistik ?? collect();
        $v  = fn($k) => (int)(optional($s[$k] ?? null)->nilai ?? 0);
        $l  = fn($k) => optional($s[$k] ?? null)->label ?? '-';
        $updateTerakhir = optional($s['update_terakhir'] ?? null)->nilai_teks ?? '-';

        // Hitung persentase gender otomatis
        $jiwaLaki      = $v('jiwa_lakilaki');
        $jiwaPerempuan = $v('jiwa_perempuan');
        $totalGender   = $jiwaLaki + $jiwaPerempuan;
        $pLaki         = $totalGender > 0 ? round($jiwaLaki      / $totalGender * 100, 1) : 0;
        $pPerempuan    = $totalGender > 0 ? round($jiwaPerempuan / $totalGender * 100, 1) : 0;

        // Hitung persentase agama otomatis
        $jiwaIslam    = $v('jiwa_islam');
        $jiwaKristen  = $v('jiwa_kristen');
        $jiwaKatolik  = $v('jiwa_katolik');
        $jiwaLainnya  = $v('jiwa_lainnya');
        $totalAgama   = $jiwaIslam + $jiwaKristen + $jiwaKatolik + $jiwaLainnya;
        $pIslam       = $totalAgama > 0 ? round($jiwaIslam   / $totalAgama * 100, 1) : 0;
        $pKristen     = $totalAgama > 0 ? round($jiwaKristen / $totalAgama * 100, 1) : 0;
        $pKatolik     = $totalAgama > 0 ? round($jiwaKatolik / $totalAgama * 100, 1) : 0;
        $pLainnya     = $totalAgama > 0 ? round($jiwaLainnya / $totalAgama * 100, 1) : 0;

        $agamaData = [
            ['label' => $l('jiwa_islam'),   'jiwa' => $jiwaIslam,   'pct' => $pIslam,   'color' => '#10b981'],
            ['label' => $l('jiwa_kristen'), 'jiwa' => $jiwaKristen, 'pct' => $pKristen, 'color' => '#1c64f2'],
            ['label' => $l('jiwa_katolik'), 'jiwa' => $jiwaKatolik, 'pct' => $pKatolik, 'color' => '#f59e0b'],
            ['label' => $l('jiwa_lainnya'), 'jiwa' => $jiwaLainnya, 'pct' => $pLainnya, 'color' => '#94a3b8'],
        ];
    @endphp

    <div class="d-flex align-items-start justify-content-between flex-wrap gap-2 mb-1">
        <div>
            <div class="sec-title"><i class="bi bi-bar-chart-fill" style="color:var(--blue)"></i> Statistik Demografi</div>
            <div class="sec-sub">Data kependudukan terbaru</div>
        </div>
        <span class="update-badge"><span class="update-dot"></span> Update Terakhir: {{ $updateTerakhir }}</span>
    </div>

    <div class="row g-3 mb-4">
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#eff6ff;color:#1c64f2"><i class="bi bi-people-fill"></i></div>
                <div><div class="stat-number">{{ number_format($v('total_penduduk')) }}</div><div class="stat-label">{{ $l('total_penduduk') }}</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#ecfdf5;color:#10b981"><i class="bi bi-house-fill"></i></div>
                <div><div class="stat-number">{{ number_format($v('jumlah_kk')) }}</div><div class="stat-label">{{ $l('jumlah_kk') }}</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fdf4ff;color:#a855f7"><i class="bi bi-building-fill"></i></div>
                <div><div class="stat-number">{{ $v('jumlah_rt') }}</div><div class="stat-label">{{ $l('jumlah_rt') }}</div></div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="stat-card">
                <div class="stat-icon" style="background:#fff7ed;color:#f59e0b"><i class="bi bi-diagram-3-fill"></i></div>
                <div><div class="stat-number">{{ $v('jumlah_rw') }}</div><div class="stat-label">{{ $l('jumlah_rw') }}</div></div>
            </div>
        </div>
    </div>

    <div class="row g-3 mb-5">
        {{-- GENDER --}}
        <div class="col-md-5">
            <div class="demo-card">
                <div class="demo-card-title"><i class="bi bi-gender-ambiguous" style="color:var(--blue)"></i> Komposisi Gender</div>
                <div class="d-flex justify-content-between align-items-end mb-2">
                    <div>
                        <div class="gender-pct" style="color:var(--blue)">{{ $pLaki }}%</div>
                        <div class="gender-label" style="color:var(--blue)">LAKI-LAKI</div>
                    </div>
                    <div class="text-end">
                        <div class="gender-pct" style="color:#f43f5e">{{ $pPerempuan }}%</div>
                        <div class="gender-label" style="color:#f43f5e">PEREMPUAN</div>
                    </div>
                </div>
                <div class="gender-bar">
                    <div class="gender-bar-m" style="width:{{ $pLaki }}%"></div>
                    <div class="gender-bar-f"></div>
                </div>
                <div class="row g-2 mt-1">
                    <div class="col-6">
                        <div class="gender-detail">
                            <i class="bi bi-gender-male" style="color:var(--blue);font-size:16px"></i>
                            <div>
                                <div style="font-size:11px;color:var(--muted)">{{ $l('jiwa_lakilaki') }}</div>
                                <div style="font-size:13px;font-weight:700;color:var(--navy)">{{ number_format($jiwaLaki) }} Jiwa</div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="gender-detail">
                            <i class="bi bi-gender-female" style="color:#f43f5e;font-size:16px"></i>
                            <div>
                                <div style="font-size:11px;color:var(--muted)">{{ $l('jiwa_perempuan') }}</div>
                                <div style="font-size:13px;font-weight:700;color:var(--navy)">{{ number_format($jiwaPerempuan) }} Jiwa</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- AGAMA --}}
        <div class="col-md-7">
            <div class="demo-card">
                <div class="demo-card-title"><i class="bi bi-people-fill" style="color:var(--blue)"></i> Sebaran Agama</div>
                @foreach($agamaData as $ag)
                <div class="agama-row">
                    <span class="agama-name">{{ $ag['label'] }}</span>
                    <div class="agama-bar-wrap">
                        <div class="agama-fill" style="width:{{ $ag['pct'] }}%;background:{{ $ag['color'] }}"></div>
                    </div>
                    <span class="agama-pct">{{ $ag['pct'] }}%</span>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- PETA --}}
    <div class="sec-title mb-1"><i class="bi bi-geo-alt-fill" style="color:var(--red)"></i> Peta Wilayah</div>
    <div class="sec-sub">Lokasi Kantor Kelurahan Teritih dan batas wilayah.</div>
    <div class="peta-card mb-5">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d15866.25!2d106.1543!3d-6.1227!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e418a2a78a50e07%3A0x74c78c4f5c5eed87!2sWalantaka%2C%20Kota%20Serang%2C%20Banten!5e0!3m2!1sid!2sid!4v1700000000000"
            width="100%" height="380" style="border:0;display:block;" allowfullscreen="" loading="lazy"></iframe>
    </div>

    {{-- BERITA DARI DATABASE --}}
    <div class="berita-header">
        <div>
            <div class="sec-title"><i class="bi bi-newspaper" style="color:var(--blue)"></i> Berita &amp; Pengumuman</div>
            <div class="sec-sub" style="margin-bottom:0">Update terkini kegiatan dan informasi penting.</div>
        </div>
        <a href="{{ route('informasi.berita') }}" class="link-semua">
            Lihat Semua <i class="bi bi-arrow-right"></i>
        </a>
    </div>

    @if($beritaTerbaru->isEmpty())
    <div class="berita-empty-card">
        <i class="bi bi-newspaper" style="font-size:32px;display:block;margin-bottom:10px;color:#e2e8f0"></i>
        Belum ada berita yang dipublikasikan.
    </div>
    @else
    <div class="row g-3">
        @foreach($beritaTerbaru as $berita)
        <div class="col-md-4">
            <a href="{{ route('informasi.berita.detail', $berita->slug) }}" class="berita-card">
                <div class="berita-img">
                    @if($berita->gambar)
                        <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}">
                    @else
                        <i class="bi bi-image"></i>
                    @endif
                    <span class="date-pill">
                        {{ $berita->tanggal_publish ? \Carbon\Carbon::parse($berita->tanggal_publish)->format('d M Y') : '-' }}
                    </span>
                </div>
                <div class="berita-body">
                    @if($berita->kategori)
                        <span class="cat">{{ $berita->kategori }}</span>
                    @endif
                    <div class="berita-title">{{ Str::limit($berita->judul, 70) }}</div>
                    <div class="berita-desc">{{ Str::limit(strip_tags($berita->ringkasan ?? $berita->isi), 100) }}</div>
                    <span class="link-baca">Baca Selengkapnya <i class="bi bi-arrow-right"></i></span>
                </div>
            </a>
        </div>
        @endforeach
    </div>
    @endif

</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>