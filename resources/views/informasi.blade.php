<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Informasi Kelurahan – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root{--blue:#1c64f2;--blue-dk:#1a56db;--blue-lt:#eff6ff;--navy:#0d1b3e;--navy2:#1e3a5f;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;--green:#10b981;--orange:#f59e0b;--red:#ef4444}
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:16px;line-height:1.6;min-height:100vh;display:flex;flex-direction:column;overflow-x:hidden}
    .info-hero{background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 55%,#1e4d8c 100%);margin:24px 32px;border-radius:20px;padding:52px 56px;position:relative;overflow:hidden;display:flex;align-items:center;min-height:230px}
    .info-hero::before{content:'';position:absolute;right:-60px;top:-60px;width:360px;height:360px;border-radius:50%;border:50px solid rgba(255,255,255,.04)}
    .hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);border-radius:20px;padding:4px 14px;font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#fbbf24;margin-bottom:14px}
    .hero-title{font-size:42px;font-weight:800;color:white;line-height:1.15;margin-bottom:12px}
    .hero-title span{color:#60a5fa}
    .hero-desc{font-size:15px;color:rgba(255,255,255,.72);max-width:500px;line-height:1.75}
    .hero-emblem{position:absolute;right:80px;top:50%;transform:translateY(-50%);width:150px;height:150px;background:rgba(255,255,255,.08);border:2px solid rgba(255,255,255,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.6);font-size:62px}
    .content-area{flex:1;padding:32px 32px 52px;overflow-x:hidden}
    .sec-title{font-size:22px;font-weight:800;color:var(--navy);display:flex;align-items:center;gap:9px;margin-bottom:4px}
    .sec-sub{font-size:14px;color:var(--muted);margin-bottom:24px}
    .update-badge{display:inline-flex;align-items:center;gap:6px;font-size:13px;color:var(--green);font-weight:600}
    .update-dot{width:8px;height:8px;border-radius:50%;background:var(--green);display:inline-block}
    .big-stat-card{background:white;border:1px solid var(--border);border-radius:18px;padding:28px 24px;display:flex;align-items:center;gap:20px;transition:box-shadow .2s}
    .big-stat-card:hover{box-shadow:0 6px 24px rgba(0,0,0,.09)}
    .big-stat-icon{width:72px;height:72px;border-radius:18px;display:flex;align-items:center;justify-content:center;font-size:32px;flex-shrink:0}
    .big-stat-number{font-size:38px;font-weight:800;line-height:1.1;margin-bottom:4px}
    .big-stat-label{font-size:14px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em}
    .demo-card{background:white;border:1px solid var(--border);border-radius:16px;padding:28px}
    .demo-card-title{font-size:18px;font-weight:700;color:var(--navy);display:flex;align-items:center;gap:8px;margin-bottom:22px}
    .gender-side-card{border-radius:16px;padding:24px 20px;text-align:center;position:relative;overflow:hidden;height:100%}
    .gender-side-card .gsb{position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:50%}
    .gender-side-card .gs-emoji{font-size:44px;margin-bottom:10px;display:block}
    .gender-side-card .gs-label{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px}
    .gender-side-card .gs-num{font-size:38px;font-weight:800;line-height:1}
    .gender-side-card .gs-pct{font-size:13px;color:#64748b;margin-top:6px}
    .pyramid-container{background:white;border:1px solid var(--border);border-radius:16px;padding:24px 20px 16px;overflow:hidden}
    .pyramid-svg-wrap{width:100%;overflow:hidden}
    .pyramid-legend{display:flex;justify-content:center;gap:32px;margin-top:16px;padding-top:16px;border-top:1px solid var(--border)}
    .legend-item{display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600}
    .legend-box{width:18px;height:18px;border-radius:3px}
    #pyrTip{position:fixed;background:white;border:1px solid #e2e8f0;border-radius:10px;padding:10px 14px;font-size:13px;font-family:'Plus Jakarta Sans',sans-serif;pointer-events:none;opacity:0;transition:opacity .15s;z-index:9999;box-shadow:0 4px 16px rgba(0,0,0,.12);min-width:160px}
    #pyrTip .pt{font-size:13px;font-weight:700;color:#0d1b3e;margin-bottom:6px}
    .pdot{width:10px;height:10px;border-radius:2px;display:inline-block;margin-right:4px}
    .agama-card{background:white;border:1px solid var(--border);border-radius:16px;padding:26px 22px;display:flex;align-items:center;gap:18px;transition:box-shadow .2s,transform .2s;height:100%}
    .agama-card:hover{box-shadow:0 6px 20px rgba(0,0,0,.09);transform:translateY(-2px)}
    .agama-icon-wrap{width:78px;height:78px;border-radius:50%;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .agama-card-label{font-size:16px;font-weight:700;color:var(--navy);margin-bottom:4px}
    .agama-card-num{font-size:30px;font-weight:800;line-height:1.1}
    .agama-card-jiwa{font-size:13px;color:var(--muted);margin-top:3px}
    .chart-area{display:flex;align-items:center;gap:32px;flex-wrap:wrap}
    .donut-wrap{position:relative;flex-shrink:0}
    .donut-center{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center}
    .donut-total{font-size:22px;font-weight:800;color:var(--navy);line-height:1}
    .donut-label{font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase}
    .chart-legend{flex:1;min-width:200px}
    .legend-row{display:flex;align-items:center;gap:12px;padding:9px 0;border-bottom:1px solid var(--bg)}
    .legend-row:last-child{border-bottom:none}
    .legend-dot{width:12px;height:12px;border-radius:3px;flex-shrink:0}
    .legend-name{font-size:14px;font-weight:600;color:var(--navy);flex:1}
    .legend-jiwa{font-size:13px;color:var(--muted)}
    .legend-pct{font-size:14px;font-weight:800;color:var(--navy);min-width:44px;text-align:right}

    /* ── PETA WILAYAH (gambar dengan lightbox) ── */
    .peta-card{background:white;border:1px solid var(--border);border-radius:16px;overflow:hidden;transition:box-shadow .25s}
    .peta-card:hover{box-shadow:0 8px 32px rgba(15,23,42,.08);border-color:#bfdbfe}
    .peta-header{padding:18px 24px;display:flex;align-items:center;gap:12px;background:white;border-bottom:1px solid var(--border)}
    .peta-icon{width:38px;height:38px;border-radius:10px;background:#ecfdf5;color:#10b981;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
    .peta-info{flex:1;min-width:0}
    .peta-name{font-size:16px;font-weight:700;color:var(--navy);line-height:1.3}
    .peta-desc{font-size:12px;color:var(--muted);margin-top:2px}
    .peta-hint{font-size:12px;color:var(--muted);display:flex;align-items:center;gap:4px;flex-shrink:0}
    .peta-img-wrap{position:relative;cursor:zoom-in;overflow:hidden;background:#f8fafc;display:flex;align-items:center;justify-content:center;min-height:240px}
    .peta-img-wrap img{width:100%;height:auto;display:block;transition:transform .35s ease;max-width:100%}
    .peta-img-wrap:hover img{transform:scale(1.015)}
    .peta-img-overlay{position:absolute;inset:0;background:rgba(28,100,242,0);transition:background .25s;pointer-events:none}
    .peta-img-wrap:hover .peta-img-overlay{background:rgba(28,100,242,.08)}
    .peta-zoom-btn{position:absolute;top:14px;right:14px;background:rgba(15,23,42,.7);backdrop-filter:blur(8px);color:white;border:none;border-radius:8px;padding:8px 12px;font-size:12px;font-weight:600;display:flex;align-items:center;gap:6px;opacity:0;transition:opacity .25s;pointer-events:none;font-family:inherit}
    .peta-img-wrap:hover .peta-zoom-btn{opacity:1}
    .peta-empty{padding:60px 20px;text-align:center;color:var(--muted)}
    .peta-empty i{font-size:48px;color:#cbd5e1;display:block;margin-bottom:12px}

    /* ── LIGHTBOX ── */
    .lightbox{position:fixed;inset:0;background:rgba(8,15,30,.92);backdrop-filter:blur(8px);z-index:9999;display:none;align-items:center;justify-content:center;padding:20px;opacity:0;transition:opacity .25s}
    .lightbox.show{display:flex;opacity:1}
    .lightbox-content{position:relative;max-width:min(1400px,95vw);max-height:90vh;display:flex;flex-direction:column;align-items:center}
    .lightbox-img{max-width:100%;max-height:82vh;width:auto;height:auto;border-radius:8px;box-shadow:0 20px 60px rgba(0,0,0,.5);background:white}
    .lightbox-caption{margin-top:16px;color:white;text-align:center;font-size:14px;font-weight:600;background:rgba(0,0,0,.4);padding:8px 20px;border-radius:20px;backdrop-filter:blur(4px)}
    .lightbox-close{position:absolute;top:-50px;right:0;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:white;width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:22px;transition:all .18s;backdrop-filter:blur(8px)}
    .lightbox-close:hover{background:rgba(255,255,255,.25);transform:scale(1.05)}

    .berita-header{display:flex;align-items:flex-end;justify-content:space-between;flex-wrap:wrap;gap:8px;margin-bottom:20px}
    .link-semua{font-size:14px;font-weight:600;color:var(--blue);text-decoration:none;display:inline-flex;align-items:center;gap:5px;transition:gap .18s}
    .link-semua:hover{gap:8px}
    .berita-card{background:white;border:1px solid var(--border);border-radius:14px;overflow:hidden;text-decoration:none;color:inherit;display:flex;flex-direction:column;transition:all .2s;height:100%}
    .berita-card:hover{box-shadow:0 8px 24px rgba(0,0,0,.1);transform:translateY(-2px)}
    .berita-img{height:170px;overflow:hidden;position:relative;background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:32px}
    .berita-img img{width:100%;height:100%;object-fit:cover}
    .date-pill{position:absolute;top:10px;left:10px;background:rgba(255,255,255,.92);backdrop-filter:blur(4px);border-radius:7px;padding:4px 10px;font-size:12px;font-weight:700;color:var(--navy)}
    .berita-body{padding:18px;flex:1;display:flex;flex-direction:column}
    .berita-title{font-size:15px;font-weight:700;color:var(--navy);line-height:1.4;margin-bottom:8px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .berita-desc{font-size:13px;color:var(--muted);line-height:1.6;flex:1;margin-bottom:14px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .link-baca{font-size:13px;font-weight:600;color:var(--blue);text-decoration:none;display:inline-flex;align-items:center;gap:4px}
    .cat{display:inline-flex;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;margin-bottom:10px;background:#eff6ff;color:#1c64f2}
    .berita-empty-card{background:white;border:1px solid var(--border);border-radius:14px;padding:48px 20px;text-align:center;color:var(--muted)}
    @media(max-width:991px){
        .info-hero{margin:16px;padding:36px 24px}.hero-title{font-size:28px}.hero-emblem{display:none}
        .content-area{padding:20px 16px 36px}
        .big-stat-number{font-size:30px}.big-stat-icon{width:56px;height:56px;font-size:26px}
        .chart-area{flex-direction:column}
        .peta-header{padding:14px 16px}
        .peta-hint{display:none}
        .peta-zoom-btn{opacity:1;top:10px;right:10px;padding:6px 10px;font-size:11px}
        .lightbox-close{top:-46px;width:38px;height:38px;font-size:20px}
    }
    </style>
</head>
<body>

@include('partials.navbar')

<div class="info-hero">
    <div style="position:relative;z-index:2;max-width:560px;">
        <div class="hero-badge"><i class="bi bi-bar-chart-fill" style="font-size:11px"></i> Data &amp; Publikasi</div>
        <h1 class="hero-title">Informasi <span>Kelurahan</span></h1>
        <p class="hero-desc">Akses data statistik kependudukan terbaru, berita kegiatan, dan peta wilayah Kelurahan Teritih secara transparan dan mudah dipahami.</p>
    </div>
    <div class="hero-emblem"><i class="bi bi-file-earmark-text-fill"></i></div>
</div>

<div class="content-area">

    @php
        $s  = $statistik ?? collect();
        $v  = fn($k) => (int)(optional($s[$k] ?? null)->nilai ?? 0);
        $l  = fn($k) => optional($s[$k] ?? null)->label ?? $k;
        $updateTerakhir = optional($s['update_terakhir'] ?? null)->nilai_teks ?? '-';

        // Jenis Kelamin
        $jiwaLaki      = $v('jiwa_lakilaki');
        $jiwaPerempuan = $v('jiwa_perempuan');
        $totalJK       = $jiwaLaki + $jiwaPerempuan;
        $pctLaki       = $totalJK > 0 ? round($jiwaLaki / $totalJK * 100, 1) : 0;
        $pctPerempuan  = $totalJK > 0 ? round($jiwaPerempuan / $totalJK * 100, 1) : 0;

        // Agama
        $jiwaIslam    = $v('jiwa_islam');
        $jiwaKristen  = $v('jiwa_kristen');
        $jiwaKatolik  = $v('jiwa_katolik');
        $jiwaHindu    = $v('jiwa_hindu');
        $jiwaBuddha   = $v('jiwa_buddha');
        $jiwaKonghucu = $v('jiwa_konghucu');
        $jiwaLainnya  = $v('jiwa_lainnya');
        $totalAgama   = $jiwaIslam + $jiwaKristen + $jiwaKatolik + $jiwaHindu + $jiwaBuddha + $jiwaKonghucu + $jiwaLainnya;
        $pa = fn($j) => $totalAgama > 0 ? round($j / $totalAgama * 100, 1) : 0;

        $agamaList = [
            ['key'=>'jiwa_islam',    'jiwa'=>$jiwaIslam,    'label'=>'Islam',              'color'=>'#10b981','bg'=>'#ecfdf5','icon'=>'masjid'],
            ['key'=>'jiwa_kristen',  'jiwa'=>$jiwaKristen,  'label'=>'Kristen',            'color'=>'#1c64f2','bg'=>'#eff6ff','icon'=>'salib'],
            ['key'=>'jiwa_katolik',  'jiwa'=>$jiwaKatolik,  'label'=>'Katolik',            'color'=>'#f59e0b','bg'=>'#fffbeb','icon'=>'salib2'],
            ['key'=>'jiwa_hindu',    'jiwa'=>$jiwaHindu,    'label'=>'Hindu',              'color'=>'#a855f7','bg'=>'#fdf4ff','icon'=>'om'],
            ['key'=>'jiwa_buddha',   'jiwa'=>$jiwaBuddha,   'label'=>'Buddha',             'color'=>'#06b6d4','bg'=>'#ecfeff','icon'=>'lotus'],
            ['key'=>'jiwa_konghucu', 'jiwa'=>$jiwaKonghucu, 'label'=>'Konghucu',           'color'=>'#ef4444','bg'=>'#fef2f2','icon'=>'torii'],
            ['key'=>'jiwa_lainnya',  'jiwa'=>$jiwaLainnya,  'label'=>'Kepercayaan Lainnya','color'=>'#94a3b8','bg'=>'#f8fafc','icon'=>'lainnya'],
        ];

        // Kelompok umur
        $umurKeys = ['umur_0_4','umur_5_9','umur_10_14','umur_15_19','umur_20_24',
                     'umur_25_29','umur_30_34','umur_35_39','umur_40_44','umur_45_49',
                     'umur_50_54','umur_55_59','umur_60_64','umur_65_69','umur_70_74','umur_75_plus'];
        $umurLabels = ['0–4','5–9','10–14','15–19','20–24','25–29','30–34','35–39',
                       '40–44','45–49','50–54','55–59','60–64','65–69','70–74','75+'];
        $umurData = [];
        $maxUmur  = 1;
        foreach ($umurKeys as $i => $k) {
            $lk = $v($k . '_l');
            $pr = $v($k . '_p');
            $umurData[] = ['label' => $umurLabels[$i], 'laki' => $lk, 'perempuan' => $pr];
            $maxUmur    = max($maxUmur, $lk, $pr);
        }
        $anyUmur = collect($umurData)->sum(fn($r) => $r['laki'] + $r['perempuan']);
    @endphp

    {{-- STATISTIK UTAMA --}}
    <div class="d-flex align-items-start justify-content-between flex-wrap gap-2 mb-4">
        <div>
            <div class="sec-title"><i class="bi bi-bar-chart-fill" style="color:var(--blue)"></i> Statistik Demografi</div>
            <div class="sec-sub" style="margin-bottom:0">Data kependudukan terbaru Kelurahan Teritih</div>
        </div>
        <span class="update-badge"><span class="update-dot"></span> Update Terakhir: {{ $updateTerakhir }}</span>
    </div>

    <div class="row g-3 mb-5">
        <div class="col-sm-6 col-lg-3">
            <div class="big-stat-card">
                <div class="big-stat-icon" style="background:#eff6ff"><i class="bi bi-people-fill" style="color:#1c64f2"></i></div>
                <div><div class="big-stat-number" style="color:#1c64f2">{{ number_format($v('total_penduduk')) }}</div><div class="big-stat-label">{{ $l('total_penduduk') }}</div></div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="big-stat-card">
                <div class="big-stat-icon" style="background:#ecfdf5"><i class="bi bi-house-fill" style="color:#10b981"></i></div>
                <div><div class="big-stat-number" style="color:#10b981">{{ number_format($v('jumlah_kk')) }}</div><div class="big-stat-label">{{ $l('jumlah_kk') }}</div></div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="big-stat-card">
                <div class="big-stat-icon" style="background:#fdf4ff"><i class="bi bi-building-fill" style="color:#a855f7"></i></div>
                <div><div class="big-stat-number" style="color:#a855f7">{{ $v('jumlah_rt') }}</div><div class="big-stat-label">{{ $l('jumlah_rt') }}</div></div>
            </div>
        </div>
        <div class="col-sm-6 col-lg-3">
            <div class="big-stat-card">
                <div class="big-stat-icon" style="background:#fff7ed"><i class="bi bi-diagram-3-fill" style="color:#f59e0b"></i></div>
                <div><div class="big-stat-number" style="color:#f59e0b">{{ $v('jumlah_rw') }}</div><div class="big-stat-label">{{ $l('jumlah_rw') }}</div></div>
            </div>
        </div>
    </div>

    {{-- ===== JENIS KELAMIN ===== --}}
    <div class="sec-title mb-1"><i class="bi bi-gender-ambiguous" style="color:var(--blue)"></i> Berdasarkan Jenis Kelamin</div>
    <div class="sec-sub">Perbandingan jumlah penduduk laki-laki dan perempuan</div>

    <div class="demo-card mb-5" style="padding:32px">
        @if($totalJK === 0)
        <div style="text-align:center;padding:32px 0;">
            <svg width="56" height="56" viewBox="0 0 64 64" fill="none" style="display:block;margin:0 auto 14px">
                <circle cx="32" cy="32" r="30" fill="#f1f5f9" stroke="#e2e8f0" stroke-width="2"/>
                <circle cx="22" cy="27" r="7" fill="#cbd5e1"/>
                <circle cx="42" cy="27" r="7" fill="#e2e8f0"/>
                <path d="M12 48c0-5.5 4.5-10 10-10h20c5.5 0 10 4.5 10 10" stroke="#e2e8f0" stroke-width="2.5" stroke-linecap="round" fill="none"/>
            </svg>
            <strong style="font-size:14px;color:#475569">Data jenis kelamin belum tersedia</strong><br>
            <span style="font-size:13px;color:#94a3b8;margin-top:4px;display:block">Informasi ini akan ditampilkan setelah data tersedia.</span>
        </div>
        @else
        <div class="row g-4 align-items-center">

            {{-- Kartu Laki-Laki --}}
            <div class="col-md-4">
                <div class="gender-side-card" style="background:#eff6ff">
                    <div class="gsb" style="background:rgba(28,100,242,.06)"></div>
                    <span class="gs-emoji">👨</span>
                    <div class="gs-label" style="color:#1c64f2">Laki-Laki</div>
                    <div class="gs-num" style="color:#1c64f2">{{ number_format($jiwaLaki) }}</div>
                    <div class="gs-pct">{{ $pctLaki }}% dari total</div>
                    <div style="margin-top:14px;height:6px;border-radius:99px;background:#dbeafe;overflow:hidden">
                        <div style="width:{{ $pctLaki }}%;height:100%;background:linear-gradient(90deg,#1c64f2,#60a5fa);border-radius:99px"></div>
                    </div>
                </div>
            </div>

            {{-- Tengah: Total + Split Bar (kotak "Dari setiap 100 perempuan" sudah dihapus) --}}
            <div class="col-md-4">
                <div style="text-align:center">
                    <div style="font-size:12px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px">Total Penduduk</div>
                    <div style="font-size:38px;font-weight:800;color:#0d1b3e;line-height:1">{{ number_format($totalJK) }}</div>
                    <div style="font-size:13px;color:#94a3b8;font-weight:600;margin-bottom:24px">Jiwa</div>

                    <div style="height:18px;border-radius:99px;overflow:hidden;display:flex;box-shadow:inset 0 1px 3px rgba(0,0,0,.08);margin-bottom:10px">
                        <div style="width:{{ $pctLaki }}%;background:linear-gradient(90deg,#1c64f2,#60a5fa);border-radius:99px 0 0 99px"></div>
                        <div style="width:{{ $pctPerempuan }}%;background:linear-gradient(90deg,#fb7185,#f43f5e);border-radius:0 99px 99px 0"></div>
                    </div>
                    <div style="display:flex;justify-content:space-between;font-size:13px;font-weight:700">
                        <span style="color:#1c64f2"><i class="bi bi-square-fill" style="font-size:9px;margin-right:4px"></i>{{ $pctLaki }}% L</span>
                        <span style="color:#f43f5e">P {{ $pctPerempuan }}% <i class="bi bi-square-fill" style="font-size:9px;margin-left:4px"></i></span>
                    </div>
                </div>
            </div>

            {{-- Kartu Perempuan --}}
            <div class="col-md-4">
                <div class="gender-side-card" style="background:#fff1f2">
                    <div class="gsb" style="background:rgba(244,63,94,.06)"></div>
                    <span class="gs-emoji">👩</span>
                    <div class="gs-label" style="color:#f43f5e">Perempuan</div>
                    <div class="gs-num" style="color:#f43f5e">{{ number_format($jiwaPerempuan) }}</div>
                    <div class="gs-pct">{{ $pctPerempuan }}% dari total</div>
                    <div style="margin-top:14px;height:6px;border-radius:99px;background:#ffe4e6;overflow:hidden">
                        <div style="width:{{ $pctPerempuan }}%;height:100%;background:linear-gradient(90deg,#f43f5e,#fb7185);border-radius:99px"></div>
                    </div>
                </div>
            </div>

        </div>
        @endif
    </div>

    {{-- ===== PIRAMIDA PENDUDUK ===== --}}
    <div class="sec-title mb-1"><i class="bi bi-people" style="color:var(--blue)"></i> Berdasarkan Kelompok Umur</div>
    <div class="sec-sub">Distribusi penduduk per kelompok usia</div>

    <div class="pyramid-container mb-5">
        <div id="pyrTip">
            <div class="pt" id="pyrTipTitle"></div>
            <div style="display:flex;align-items:center;gap:6px;margin-bottom:3px">
                <span class="pdot" style="background:#60a5fa"></span>
                <span style="font-size:13px;color:#334155">Laki-Laki: <strong id="pyrTipL">0</strong></span>
            </div>
            <div style="display:flex;align-items:center;gap:6px">
                <span class="pdot" style="background:#f87171"></span>
                <span style="font-size:13px;color:#334155">Perempuan: <strong id="pyrTipP">0</strong></span>
            </div>
        </div>

        @if($anyUmur === 0)
        <div style="text-align:center;padding:56px 0;">
            <svg width="64" height="64" viewBox="0 0 64 64" fill="none" style="display:block;margin:0 auto 16px">
                <circle cx="32" cy="32" r="30" fill="#f1f5f9" stroke="#e2e8f0" stroke-width="2"/>
                <rect x="18" y="38" width="8" height="10" rx="2" fill="#cbd5e1"/>
                <rect x="28" y="30" width="8" height="18" rx="2" fill="#94a3b8"/>
                <rect x="38" y="34" width="8" height="14" rx="2" fill="#cbd5e1"/>
                <path d="M16 44 Q32 20 48 28" stroke="#e2e8f0" stroke-width="1.5" stroke-dasharray="3 3" fill="none"/>
            </svg>
            <strong style="font-size:15px;color:#475569">Data distribusi usia belum tersedia</strong><br>
            <span style="font-size:13px;color:#94a3b8;margin-top:6px;display:block">Informasi ini akan ditampilkan setelah data tersedia.</span>
        </div>
        @else
        @php
            $pyrRows    = array_reverse($umurData);
            $pyrMax     = max(array_merge([1], array_column($pyrRows,'laki'), array_column($pyrRows,'perempuan')));
            $pyrStep    = 50;
            $steps      = [10,25,50,100,150,200,250,500,1000];
            foreach ($steps as $st) { if ($pyrMax <= $st * 5) { $pyrStep = $st; break; } }
            $pyrAxisMax = $pyrStep * ceil($pyrMax / $pyrStep) + $pyrStep;
            $nRows = count($pyrRows);
            $svgW=1000; $lblColW=75; $numW=45; $gapMid=12;
            $chartW=$svgW-$lblColW; $halfW=($chartW-$gapMid)/2; $barAreaW=$halfW-$numW;
            $rowH=38; $barH=26; $headerH=36; $footerH=36;
            $svgH=$headerH+$nRows*$rowH+$footerH;
            $midX=$lblColW+$halfW; $lakiEnd=$midX-$gapMid/2; $prStart=$midX+$gapMid/2;
            $gridTicks=[];
            for ($ti=0;$ti<=5;$ti++) {
                $frac=$ti/5;
                $gridTicks[]=['xL'=>$midX-$gapMid/2-$frac*$barAreaW,'xR'=>$midX+$gapMid/2+$frac*$barAreaW,'val'=>round($pyrAxisMax*$frac)];
            }
        @endphp
        <div class="pyramid-svg-wrap">
        <svg id="pyrSvg" viewBox="0 0 {{ $svgW }} {{ $svgH }}" width="100%" style="display:block;font-family:'Plus Jakarta Sans',sans-serif;max-width:100%;height:auto">
            @foreach($gridTicks as $g)
            <line x1="{{ $g['xL'] }}" y1="{{ $headerH }}" x2="{{ $g['xL'] }}" y2="{{ $headerH+$nRows*$rowH }}" stroke="{{ $g['val']==0?'#cbd5e1':'#f1f5f9' }}" stroke-width="{{ $g['val']==0?1.5:1 }}"/>
            <line x1="{{ $g['xR'] }}" y1="{{ $headerH }}" x2="{{ $g['xR'] }}" y2="{{ $headerH+$nRows*$rowH }}" stroke="{{ $g['val']==0?'#cbd5e1':'#f1f5f9' }}" stroke-width="{{ $g['val']==0?1.5:1 }}"/>
            @endforeach
            <text x="{{ $midX-$gapMid/2-$barAreaW/2 }}" y="26" text-anchor="middle" fill="#1c64f2" font-size="15" font-weight="800">Laki-Laki</text>
            <text x="{{ $midX+$gapMid/2+$barAreaW/2 }}" y="26" text-anchor="middle" fill="#f43f5e" font-size="15" font-weight="800">Perempuan</text>
            @foreach($pyrRows as $i => $row)
            @php
                $y=$headerH+$i*$rowH; $barY=$y+($rowH-$barH)/2; $barMidY=$barY+$barH/2+4.5;
                $wL=$pyrAxisMax>0?($row['laki']/$pyrAxisMax)*$barAreaW:0;
                $wP=$pyrAxisMax>0?($row['perempuan']/$pyrAxisMax)*$barAreaW:0;
                $rectLx=$lakiEnd-$wL; $rectPx=$prStart;
                $numLx=$rectLx-5; $numPx=$rectPx+$wP+5;
            @endphp
            <text x="{{ $lblColW-8 }}" y="{{ $barMidY }}" text-anchor="end" fill="#475569" font-size="12" font-weight="600">{{ $row['label'] }}</text>
            <rect class="pyr-bar" x="{{ $rectLx }}" y="{{ $barY }}" width="{{ max($wL,0) }}" height="{{ $barH }}" rx="3" fill="#60a5fa" opacity="0.85" data-label="{{ $row['label'] }}" data-laki="{{ $row['laki'] }}" data-perempuan="{{ $row['perempuan'] }}" style="cursor:pointer;transition:opacity .15s"/>
            <rect class="pyr-bar" x="{{ $rectPx }}" y="{{ $barY }}" width="{{ max($wP,0) }}" height="{{ $barH }}" rx="3" fill="#f87171" opacity="0.85" data-label="{{ $row['label'] }}" data-laki="{{ $row['laki'] }}" data-perempuan="{{ $row['perempuan'] }}" style="cursor:pointer;transition:opacity .15s"/>
            @if($row['laki']>0)<text x="{{ $numLx }}" y="{{ $barMidY }}" text-anchor="end" fill="#334155" font-size="11" font-weight="600">{{ number_format($row['laki']) }}</text>@endif
            @if($row['perempuan']>0)<text x="{{ $numPx }}" y="{{ $barMidY }}" text-anchor="start" fill="#334155" font-size="11" font-weight="600">{{ number_format($row['perempuan']) }}</text>@endif
            @endforeach
            @php $scaleY=$headerH+$nRows*$rowH+20; @endphp
            @foreach($gridTicks as $g)
            <text x="{{ $g['xL'] }}" y="{{ $scaleY }}" text-anchor="middle" fill="#94a3b8" font-size="11">{{ $g['val'] }}</text>
            <text x="{{ $g['xR'] }}" y="{{ $scaleY }}" text-anchor="middle" fill="#94a3b8" font-size="11">{{ $g['val'] }}</text>
            @endforeach
        </svg>
        </div>
        @endif

        <div class="pyramid-legend">
            <div class="legend-item"><div class="legend-box" style="background:#60a5fa"></div><span style="color:#1c64f2;font-weight:700">Laki-Laki</span></div>
            <div class="legend-item"><div class="legend-box" style="background:#f87171"></div><span style="color:#f43f5e;font-weight:700">Perempuan</span></div>
        </div>
    </div>

    {{-- BERDASARKAN AGAMA --}}
    <div class="sec-title mb-1"><i class="bi bi-stars" style="color:var(--orange)"></i> Berdasarkan Agama</div>
    <div class="sec-sub">Sebaran penduduk berdasarkan agama yang dianut</div>

    <div class="row g-3 mb-3">
        @foreach(array_slice($agamaList, 0, 4) as $ag)
        <div class="col-6 col-md-3">
            <div class="agama-card">
                <div class="agama-icon-wrap" style="background:{{ $ag['bg'] }}">
                    @if($ag['icon']==='masjid')
                    <svg viewBox="0 0 64 64" width="44" height="44"><path d="M32 6C30 6 28 8 28 10L28 14L36 14L36 10C36 8 34 6 32 6Z" fill="#10b981"/><path d="M32 2L32 8M29 4L35 4" stroke="#10b981" stroke-width="2.5" stroke-linecap="round"/><path d="M8 24L32 14L56 24" stroke="#10b981" stroke-width="2" fill="none"/><rect x="8" y="24" width="48" height="32" rx="3" fill="#10b981" opacity=".15"/><rect x="12" y="28" width="10" height="16" rx="2" fill="#10b981" opacity=".65"/><rect x="42" y="28" width="10" height="16" rx="2" fill="#10b981" opacity=".65"/><rect x="26" y="36" width="12" height="20" rx="6" fill="#10b981"/><ellipse cx="32" cy="26" rx="4" ry="4" fill="none" stroke="#10b981" stroke-width="1.5"/></svg>
                    @elseif($ag['icon']==='salib')
                    <svg viewBox="0 0 64 64" width="44" height="44"><rect x="28" y="8" width="8" height="48" rx="4" fill="#1c64f2"/><rect x="12" y="22" width="40" height="8" rx="4" fill="#1c64f2"/></svg>
                    @elseif($ag['icon']==='salib2')
                    <svg viewBox="0 0 64 64" width="44" height="44"><rect x="28" y="6" width="8" height="52" rx="4" fill="#f59e0b"/><rect x="14" y="18" width="36" height="8" rx="4" fill="#f59e0b"/><rect x="20" y="44" width="24" height="5" rx="2.5" fill="#f59e0b" opacity=".55"/></svg>
                    @elseif($ag['icon']==='om')
                    <svg viewBox="0 0 64 64" width="44" height="44"><text x="32" y="44" font-size="40" text-anchor="middle" fill="#a855f7" font-family="serif" font-weight="bold">ॐ</text></svg>
                    @endif
                </div>
                <div>
                    <div class="agama-card-label">{{ $ag['label'] }}</div>
                    <div class="agama-card-num" style="color:{{ $ag['color'] }}">{{ number_format($ag['jiwa']) }}</div>
                    <div class="agama-card-jiwa">{{ $pa($ag['jiwa']) }}% jiwa</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <div class="row g-3 mb-4 justify-content-center">
        @foreach(array_slice($agamaList, 4, 3) as $ag)
        <div class="col-6 col-md-3">
            <div class="agama-card">
                <div class="agama-icon-wrap" style="background:{{ $ag['bg'] }}">
                    @if($ag['icon']==='lotus')
                    <svg viewBox="0 0 64 64" width="44" height="44"><ellipse cx="32" cy="44" rx="22" ry="8" fill="#06b6d4" opacity=".15"/><path d="M32 12C32 12 20 24 20 36C20 42 25 46 32 46C39 46 44 42 44 36C44 24 32 12 32 12Z" fill="#06b6d4" opacity=".3"/><path d="M32 18C32 18 24 28 24 37C24 42 27.5 45 32 45C36.5 45 40 42 40 37C40 28 32 18 32 18Z" fill="#06b6d4" opacity=".6"/><path d="M32 24C32 24 27 32 27 38C27 42 29 44 32 44C35 44 37 42 37 38C37 32 32 24 32 24Z" fill="#06b6d4"/><circle cx="32" cy="10" r="4" fill="#f59e0b"/></svg>
                    @elseif($ag['icon']==='torii')
                    <svg viewBox="0 0 64 64" width="44" height="44"><rect x="8" y="14" width="48" height="6" rx="3" fill="#ef4444"/><rect x="12" y="22" width="40" height="5" rx="2.5" fill="#ef4444" opacity=".6"/><rect x="14" y="27" width="6" height="30" rx="3" fill="#ef4444"/><rect x="44" y="27" width="6" height="30" rx="3" fill="#ef4444"/></svg>
                    @else
                    <svg viewBox="0 0 64 64" width="44" height="44"><circle cx="32" cy="32" r="18" fill="none" stroke="#94a3b8" stroke-width="4"/><circle cx="32" cy="32" r="6" fill="#94a3b8"/></svg>
                    @endif
                </div>
                <div>
                    <div class="agama-card-label">{{ $ag['label'] }}</div>
                    <div class="agama-card-num" style="color:{{ $ag['color'] }}">{{ number_format($ag['jiwa']) }}</div>
                    <div class="agama-card-jiwa">{{ $pa($ag['jiwa']) }}% jiwa</div>
                </div>
            </div>
        </div>
        @endforeach
    </div>

    <div class="demo-card mb-5">
        <div class="demo-card-title"><i class="bi bi-pie-chart-fill" style="color:var(--blue)"></i> Grafik Sebaran Agama</div>
        <div class="chart-area">
            <div class="donut-wrap">
                <svg id="donutChart" width="260" height="260" viewBox="0 0 240 240" style="cursor:pointer"></svg>
                <div class="donut-center" id="donutCenter">
                    <div class="donut-total">{{ number_format($totalAgama) }}</div>
                    <div class="donut-label">Total<br>Jiwa</div>
                </div>
                <div id="donutTooltip" style="position:absolute;bottom:calc(100% + 8px);left:50%;transform:translateX(-50%);background:#0d1b3e;color:white;border-radius:10px;padding:8px 14px;font-size:13px;font-weight:600;white-space:nowrap;pointer-events:none;opacity:0;transition:opacity .18s;z-index:10;box-shadow:0 4px 16px rgba(0,0,0,.2);"></div>
            </div>
            <div class="chart-legend">
                @foreach($agamaList as $ag)
                <div class="legend-row" data-agama="{{ $ag['label'] }}" data-jiwa="{{ number_format($ag['jiwa']) }}" data-pct="{{ $pa($ag['jiwa']) }}" data-color="{{ $ag['color'] }}" style="cursor:pointer;border-radius:8px;transition:background .15s">
                    <div class="legend-dot" style="background:{{ $ag['color'] }}"></div>
                    <div class="legend-name">{{ $ag['label'] }}</div>
                    <div class="legend-jiwa">{{ number_format($ag['jiwa']) }} jiwa</div>
                    <div class="legend-pct">{{ $pa($ag['jiwa']) }}%</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ══ PETA WILAYAH ══ --}}
    <div class="sec-title mb-1"><i class="bi bi-geo-alt-fill" style="color:var(--red)"></i> Peta Wilayah</div>
    <div class="sec-sub">Pembagian lingkungan, batas wilayah, dan fasilitas umum Kelurahan Teritih.</div>

    @php
        $petaPath = 'images/PETA-WILAYAH-TERITIH.jpg';
        $petaUrl  = asset($petaPath);
    @endphp

    <div class="peta-card mb-5">
        <div class="peta-header">
            <div class="peta-icon"><i class="bi bi-map-fill"></i></div>
            <div class="peta-info">
                <div class="peta-name">Peta Wilayah Kelurahan Teritih</div>
                <div class="peta-desc">Pembagian lingkungan, batas wilayah, dan fasilitas umum</div>
            </div>
            <div class="peta-hint"><i class="bi bi-zoom-in"></i> Klik untuk perbesar</div>
        </div>
        <div class="peta-img-wrap"
             onclick="openLightbox('{{ $petaUrl }}', 'Peta Wilayah Kelurahan Teritih')"
             role="button" tabindex="0"
             onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();openLightbox('{{ $petaUrl }}', 'Peta Wilayah Kelurahan Teritih')}">
            <img src="{{ $petaUrl }}"
                 alt="Peta Wilayah Kelurahan Teritih"
                 loading="lazy"
                 onerror="this.style.display='none';this.parentElement.querySelector('.peta-empty').style.display='block'">
            <div class="peta-empty" style="display:none">
                <i class="bi bi-map"></i>
                <strong style="font-size:14px;color:#475569;display:block;margin-bottom:6px">Peta belum tersedia</strong>
                <span style="font-size:13px;color:#94a3b8">File PETA-WILAYAH-TERITIH.jpg belum di-upload ke folder public/images/</span>
            </div>
            <div class="peta-img-overlay"></div>
            <button type="button" class="peta-zoom-btn" tabindex="-1">
                <i class="bi bi-arrows-fullscreen"></i> Perbesar
            </button>
        </div>
    </div>

    <div class="berita-header">
        <div>
            <div class="sec-title"><i class="bi bi-newspaper" style="color:var(--blue)"></i> Berita &amp; Pengumuman</div>
            <div class="sec-sub" style="margin-bottom:0">Update terkini kegiatan dan informasi penting.</div>
        </div>
        <a href="{{ route('informasi.berita') }}" class="link-semua">Lihat Semua <i class="bi bi-arrow-right"></i></a>
    </div>

    @if($beritaTerbaru->isEmpty())
    <div class="berita-empty-card">
        <i class="bi bi-newspaper" style="font-size:36px;display:block;margin-bottom:12px;color:#e2e8f0"></i>
        Belum ada berita yang dipublikasikan.
    </div>
    @else
    <div class="row g-3">
        @foreach($beritaTerbaru as $berita)
        <div class="col-md-4">
            <a href="{{ route('informasi.berita.detail', $berita->slug) }}" class="berita-card">
                <div class="berita-img">
                    @if($berita->gambar)<img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}">@else<i class="bi bi-image"></i>@endif
                    <span class="date-pill">{{ $berita->tanggal_publish ? \Carbon\Carbon::parse($berita->tanggal_publish)->format('d M Y') : '-' }}</span>
                </div>
                <div class="berita-body">
                    @if($berita->kategori)<span class="cat">{{ $berita->kategori }}</span>@endif
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

{{-- ══ LIGHTBOX MODAL ══ --}}
<div class="lightbox" id="lightbox" onclick="closeLightbox(event)" role="dialog" aria-modal="true" aria-label="Pratinjau peta">
    <div class="lightbox-content" onclick="event.stopPropagation()">
        <button type="button" class="lightbox-close" onclick="closeLightbox()" aria-label="Tutup">
            <i class="bi bi-x-lg"></i>
        </button>
        <img src="" alt="" class="lightbox-img" id="lightboxImg">
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>
</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ── Lightbox untuk peta ──────────────────────────────────────────
function openLightbox(src, caption) {
    const box = document.getElementById('lightbox');
    const img = document.getElementById('lightboxImg');
    const cap = document.getElementById('lightboxCaption');
    img.src = src; img.alt = caption; cap.textContent = caption;
    box.classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    const box = document.getElementById('lightbox');
    box.classList.remove('show');
    document.body.style.overflow = '';
    setTimeout(() => { document.getElementById('lightboxImg').src = ''; }, 250);
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.getElementById('lightbox').classList.contains('show')) closeLightbox();
});

// ── Piramida ──────────────────────────────────────────────────────
(function(){
    const tip=document.getElementById('pyrTip'),titEl=document.getElementById('pyrTipTitle'),lEl=document.getElementById('pyrTipL'),pEl=document.getElementById('pyrTipP');
    if(!tip)return;
    let pinned=false;
    const showTip=(bar,x,y)=>{
        titEl.textContent=bar.dataset.label;
        lEl.textContent=parseInt(bar.dataset.laki||0).toLocaleString('id-ID');
        pEl.textContent=parseInt(bar.dataset.perempuan||0).toLocaleString('id-ID');
        const tipW=tip.offsetWidth||200,tipH=tip.offsetHeight||90;
        let tx=x+16,ty=y-tipH-10;
        if(tx+tipW>window.innerWidth-12)tx=x-tipW-16;
        if(ty<8)ty=y+16;
        tip.style.left=tx+'px';tip.style.top=ty+'px';tip.style.opacity='1';
    };
    const resetBars=()=>document.querySelectorAll('.pyr-bar').forEach(b=>{b.style.opacity='0.85';b.style.filter='';});
    const highlightRow=(bar)=>{
        resetBars();
        document.querySelectorAll('.pyr-bar').forEach(b=>{
            if(b.dataset.label===bar.dataset.label){b.style.opacity='1';b.style.filter='brightness(1.1) drop-shadow(0 0 4px rgba(0,0,0,.2))';}
            else b.style.opacity='0.4';
        });
    };
    document.querySelectorAll('.pyr-bar').forEach(bar=>{
        bar.addEventListener('mouseenter',function(e){if(!pinned){highlightRow(this);showTip(this,e.clientX,e.clientY);}});
        bar.addEventListener('mousemove',function(e){if(!pinned){const tipW=tip.offsetWidth||200,tipH=tip.offsetHeight||90;let tx=e.clientX+16,ty=e.clientY-tipH-10;if(tx+tipW>window.innerWidth-12)tx=e.clientX-tipW-16;if(ty<8)ty=e.clientY+16;tip.style.left=tx+'px';tip.style.top=ty+'px';}});
        bar.addEventListener('mouseleave',function(){if(!pinned){resetBars();tip.style.opacity='0';}});
        bar.addEventListener('click',function(e){if(pinned&&this.dataset.label===titEl.textContent){pinned=false;resetBars();tip.style.opacity='0';}else{pinned=true;highlightRow(this);showTip(this,e.clientX,e.clientY);}});
        bar.addEventListener('touchstart',function(e){e.preventDefault();const t=e.touches[0];pinned=true;highlightRow(this);showTip(this,t.clientX,t.clientY);setTimeout(()=>{pinned=false;resetBars();tip.style.opacity='0';},3000);},{passive:false});
    });
    document.addEventListener('click',function(e){if(!e.target.closest('#pyrSvg')&&!e.target.closest('#pyrTip')){pinned=false;resetBars();tip.style.opacity='0';}});
})();

// ── Donut Chart Agama ────────────────────────────────────────────
(function(){
    const data=[
        @foreach($agamaList as $ag)
        {value:{{$ag['jiwa']}},color:'{{$ag['color']}}',label:'{{addslashes($ag['label'])}}',jiwa:'{{number_format($ag['jiwa'])}}',pct:'{{$pa($ag['jiwa'])}}'},
        @endforeach
    ];
    const cx=120,cy=120,r=88,strokeW=34,circ=2*Math.PI*r;
    const total=data.reduce((s,d)=>s+d.value,0);
    const svg=document.getElementById('donutChart'),tip=document.getElementById('donutTooltip'),ctr=document.getElementById('donutCenter');
    const totalFmt='{{number_format($totalAgama)}}';
    if(total===0){svg.innerHTML=`<circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="#e2e8f0" stroke-width="${strokeW}"/>`;return;}
    let html=`<circle cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="#f1f5f9" stroke-width="${strokeW}"/>`,off=0;
    data.forEach((d,i)=>{
        const dash=(d.value/total)*circ,gap=circ-dash,rot=(off/total)*360-90;
        html+=`<circle id="arc${i}" cx="${cx}" cy="${cy}" r="${r}" fill="none" stroke="${d.color}" stroke-width="${strokeW}" stroke-dasharray="${dash.toFixed(3)} ${gap.toFixed(3)}" stroke-linecap="butt" transform="rotate(${rot.toFixed(3)},${cx},${cy})" style="cursor:pointer;transition:stroke-width .15s,opacity .15s"/>`;
        off+=d.value;
    });
    html+=`<circle cx="${cx}" cy="${cy}" r="${r-strokeW/2-3}" fill="white"/>`;
    svg.innerHTML=html;
    const resetAll=()=>{data.forEach((_,i)=>{const el=svg.querySelector('#arc'+i);if(el){el.style.opacity='1';el.style.strokeWidth=strokeW+'px';}});ctr.innerHTML=`<div class="donut-total">${totalFmt}</div><div class="donut-label">Total<br>Jiwa</div>`;if(tip)tip.style.opacity='0';};
    const activateIdx=(i)=>{const d=data[i];data.forEach((_,j)=>{const el=svg.querySelector('#arc'+j);if(el){el.style.opacity=j===i?'1':'0.3';el.style.strokeWidth=(j===i?strokeW+7:strokeW)+'px';}});ctr.innerHTML=`<div style="font-size:20px;font-weight:800;color:${d.color};line-height:1">${d.jiwa}</div><div style="font-size:13px;font-weight:700;color:${d.color}">${d.pct}%</div><div style="font-size:10px;color:#64748b;font-weight:600;max-width:80px;text-align:center;line-height:1.3;margin-top:2px">${d.label}</div>`;if(tip){tip.innerHTML=`<span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:${d.color};margin-right:6px;vertical-align:middle"></span>${d.label}: ${d.jiwa} jiwa (${d.pct}%)`;tip.style.opacity='1';}};
    data.forEach((d,i)=>{const el=svg.querySelector('#arc'+i);if(!el)return;el.addEventListener('mouseenter',()=>activateIdx(i));el.addEventListener('mouseleave',resetAll);el.addEventListener('click',()=>activateIdx(i));el.addEventListener('touchstart',(e)=>{e.preventDefault();activateIdx(i);},{passive:false});});
    document.querySelectorAll('.legend-row').forEach((row,i)=>{row.addEventListener('mouseenter',()=>{row.style.background='#f1f5f9';activateIdx(i);});row.addEventListener('mouseleave',()=>{row.style.background='';resetAll();});row.addEventListener('click',()=>activateIdx(i));});
})();
</script>
</body>
</html>