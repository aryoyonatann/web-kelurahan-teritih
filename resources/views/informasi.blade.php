<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Demografi Kelurahan – Kelurahan Teritih</title>
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
    .big-stat-card{background:white;border:1px solid var(--border);border-radius:18px;padding:22px 20px;display:flex;align-items:center;gap:16px;transition:box-shadow .2s;height:100%}
    .big-stat-card:hover{box-shadow:0 6px 24px rgba(0,0,0,.09)}
    .big-stat-icon{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:26px;flex-shrink:0}
    .big-stat-number{font-size:32px;font-weight:800;line-height:1.1;margin-bottom:2px}
    .big-stat-label{font-size:12px;font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.06em}
    .demo-card{background:white;border:1px solid var(--border);border-radius:16px;padding:28px}
    .demo-card-title{font-size:18px;font-weight:700;color:var(--navy);display:flex;align-items:center;gap:8px;margin-bottom:22px}
    .gender-side-card{border-radius:16px;padding:24px 20px;text-align:center;position:relative;overflow:hidden;height:100%}
    .gender-side-card .gsb{position:absolute;top:-20px;right:-20px;width:100px;height:100px;border-radius:50%}
    .gender-side-card .gs-emoji{font-size:44px;margin-bottom:10px;display:block}
    .gender-side-card .gs-label{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;margin-bottom:8px}
    .gender-side-card .gs-num{font-size:38px;font-weight:800;line-height:1}
    .gender-side-card .gs-pct{font-size:13px;color:#64748b;margin-top:6px}
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

    /* ── MODERN INTERACTIVE CHARTS ── */
    .chart-card{background:white;border:1px solid var(--border);border-radius:20px;padding:28px;transition:all .3s cubic-bezier(.4,0,.2,1);position:relative;overflow:visible}
    .chart-card::before{content:'';position:absolute;top:0;left:0;right:0;height:3px;background:linear-gradient(90deg,#3b82f6,#8b5cf6,#f43f5e);opacity:0;transition:opacity .3s;border-radius:20px 20px 0 0}
    .chart-card:hover{box-shadow:0 12px 40px rgba(0,0,0,.1)}
    .chart-card:hover::before{opacity:1}
    .chart-card[style*="border-top"]::before{display:none}
    .chart-card-head{display:flex;align-items:center;gap:12px;margin-bottom:24px}
    .chart-card-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
    .chart-card-title{font-size:17px;font-weight:700;color:var(--navy)}
    .chart-card-sub{font-size:12px;color:var(--muted);margin-top:2px}
    .hbar-row{display:flex;align-items:center;gap:14px;padding:12px 12px;border-bottom:1px solid rgba(241,245,249,.8);transition:all .2s;border-radius:10px;cursor:default;position:relative}
    .hbar-row:hover{background:linear-gradient(135deg,rgba(59,130,246,.03),rgba(139,92,246,.03));box-shadow:0 2px 12px rgba(0,0,0,.04)}
    .hbar-row:last-child{border-bottom:none}
    .hbar-rank{width:24px;height:24px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:10px;font-weight:800;color:white;flex-shrink:0}
    .hbar-label{width:130px;font-size:13px;font-weight:600;color:var(--navy);flex-shrink:0;line-height:1.3}
    .hbar-track{flex:1;height:32px;background:linear-gradient(90deg,#f8fafc,#f1f5f9);border-radius:10px;overflow:hidden;position:relative}
    .hbar-fill{height:100%;border-radius:10px;transition:width 1.2s cubic-bezier(.25,.46,.45,.94);display:flex;align-items:center;justify-content:flex-end;padding-right:10px;font-size:11px;font-weight:700;color:white;min-width:0;position:relative;overflow:hidden}
    .hbar-fill::after{content:'';position:absolute;top:0;left:0;right:0;bottom:0;background:linear-gradient(180deg,rgba(255,255,255,.2) 0%,transparent 50%,rgba(0,0,0,.05) 100%);border-radius:10px}
    .hbar-fill.animated{animation:barShimmer 2s ease-in-out infinite}
    @keyframes barShimmer{0%,100%{opacity:1}50%{opacity:.92}}
    .hbar-val{font-size:14px;font-weight:800;color:var(--navy);min-width:50px;text-align:right;font-variant-numeric:tabular-nums}
    .hbar-tooltip{position:absolute;bottom:calc(100% + 6px);left:50%;transform:translateX(-50%) scale(.9);background:var(--navy);color:white;border-radius:8px;padding:6px 12px;font-size:11px;font-weight:600;white-space:nowrap;pointer-events:none;opacity:0;transition:all .15s;z-index:100;box-shadow:0 4px 12px rgba(0,0,0,.2)}
    .hbar-tooltip::after{content:'';position:absolute;top:100%;left:50%;transform:translateX(-50%);border:4px solid transparent;border-top-color:var(--navy)}
    .hbar-row:hover .hbar-tooltip{opacity:1;transform:translateX(-50%) scale(1)}
    .split-bar{display:flex;height:32px;border-radius:10px;overflow:hidden;background:linear-gradient(90deg,#f8fafc,#f1f5f9);box-shadow:inset 0 1px 3px rgba(0,0,0,.06)}
    .split-bar-l{height:100%;background:linear-gradient(135deg,#1d4ed8,#3b82f6,#60a5fa);transition:width 1s cubic-bezier(.25,.46,.45,.94);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:white;position:relative}
    .split-bar-l::after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(255,255,255,.15),transparent)}
    .split-bar-p{height:100%;background:linear-gradient(135deg,#e11d48,#f43f5e,#fb7185);transition:width 1s cubic-bezier(.25,.46,.45,.94);display:flex;align-items:center;justify-content:center;font-size:11px;font-weight:700;color:white;position:relative}
    .split-bar-p::after{content:'';position:absolute;inset:0;background:linear-gradient(180deg,rgba(255,255,255,.15),transparent)}
    .donut-mini{position:relative;display:inline-block}
    .donut-mini-center{position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center}
    /* GSAP handles all scroll animations */
    /* Glow effect on hover for stat cards */
    .big-stat-card{position:relative;overflow:hidden}
    .big-stat-card::after{content:'';position:absolute;top:-50%;left:-50%;width:200%;height:200%;background:radial-gradient(circle,rgba(28,100,242,.04) 0%,transparent 70%);opacity:0;transition:opacity .3s}
    .big-stat-card:hover::after{opacity:1}
    /* Piramida hover */
    .pyr-bar{transition:opacity .2s ease,filter .2s ease;transform-origin:center}
    .pyr-tooltip{position:fixed;background:white;border:1px solid #e2e8f0;border-radius:12px;padding:12px 16px;font-size:13px;font-family:'Plus Jakarta Sans',sans-serif;pointer-events:none;opacity:0;transition:all .2s cubic-bezier(.4,0,.2,1);z-index:9999;box-shadow:0 8px 32px rgba(0,0,0,.15);min-width:180px;backdrop-filter:blur(8px)}
    .pyr-tooltip .pt{font-size:14px;font-weight:700;color:#0d1b3e;margin-bottom:8px}
    .pyr-tooltip .prow{display:flex;align-items:center;gap:8px;margin-bottom:4px}
    .pyr-tooltip .pdot{width:12px;height:12px;border-radius:3px;display:inline-block}
    @media(max-width:767px){.hbar-label{width:90px;font-size:12px}.chart-card{padding:20px 16px}.hbar-rank{display:none}}

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

    /* ── BERITA OVERLAY CARDS ── */
    .berita-overlay-card{display:block;border-radius:18px;overflow:hidden;text-decoration:none;transition:all .3s cubic-bezier(.4,0,.2,1);height:100%;position:relative}
    .berita-overlay-card:hover{transform:translateY(-4px);box-shadow:0 16px 48px rgba(0,0,0,.2)}
    .berita-overlay-img{position:relative;height:280px;overflow:hidden;border-radius:18px}
    .berita-overlay-img img{width:100%;height:100%;object-fit:cover;transition:transform .5s ease}
    .berita-overlay-card:hover .berita-overlay-img img{transform:scale(1.05)}
    .berita-overlay-placeholder{height:100%;background:linear-gradient(135deg,#0d1b3e 0%,#1e3a5f 50%,#1c64f2 100%);display:flex;align-items:center;justify-content:center}
    .berita-overlay-placeholder i{font-size:48px;color:rgba(255,255,255,.15)}
    .berita-overlay-gradient{position:absolute;inset:0;background:linear-gradient(to top,rgba(0,0,0,.85) 0%,rgba(0,0,0,.4) 40%,rgba(0,0,0,.05) 70%,transparent 100%);transition:background .3s}
    .berita-overlay-card:hover .berita-overlay-gradient{background:linear-gradient(to top,rgba(0,0,0,.9) 0%,rgba(0,0,0,.5) 45%,rgba(0,0,0,.1) 75%,transparent 100%)}
    .berita-overlay-content{position:absolute;bottom:0;left:0;right:0;padding:24px;color:white;z-index:2}
    .berita-overlay-cat{display:inline-block;padding:4px 12px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;background:rgba(28,100,242,.9);color:white;margin-bottom:10px}
    .berita-overlay-title{font-size:16px;font-weight:700;line-height:1.4;color:white;margin-bottom:8px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden;text-shadow:0 1px 3px rgba(0,0,0,.3)}
    .berita-overlay-meta{font-size:12px;color:rgba(255,255,255,.7);display:flex;align-items:center;gap:5px}
    @media(max-width:767px){.berita-overlay-img{height:220px}}
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
        <div class="hero-badge"><i class="bi bi-bar-chart-fill" style="font-size:11px"></i> Data Kependudukan</div>
        <h1 class="hero-title">Demografi <span>Kelurahan</span></h1>
        <p class="hero-desc">Akses data statistik kependudukan terbaru dan peta wilayah Kelurahan Teritih secara transparan dan mudah dipahami.</p>
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

        // Kelompok umur (piramida)
        $umurKeys = ['umur_0_4','umur_5_9','umur_10_14','umur_15_19','umur_20_24',
                     'umur_25_29','umur_30_34','umur_35_39','umur_40_44','umur_45_49',
                     'umur_50_54','umur_55_59','umur_60_64','umur_65_69','umur_70_74','umur_75_plus'];
        $umurLabels = ['0–4','5–9','10–14','15–19','20–24','25–29','30–34','35–39',
                       '40–44','45–49','50–54','55–59','60–64','65–69','70–74','75+'];
        $umurData = [];
        foreach ($umurKeys as $i => $k) {
            $lk = $v($k . '_l');
            $pr = $v($k . '_p');
            $umurData[] = ['label' => $umurLabels[$i], 'laki' => $lk, 'perempuan' => $pr];
        }
        $anyUmur = collect($umurData)->sum(fn($r) => $r['laki'] + $r['perempuan']);
    @endphp
    <div id="statistik" class="sec-title mb-1"><i class="bi bi-bar-chart-fill" style="color:var(--blue)"></i> Statistik Demografi</div>
    <div class="sec-sub" style="margin-bottom:16px">Data kependudukan terbaru Kelurahan Teritih <span class="update-badge" style="margin-left:8px"><span class="update-dot"></span> {{ $updateTerakhir }}</span></div>

    <div class="row g-3 mb-5">
        {{-- LEFT: Line Chart + Total Penduduk --}}
        @php
            $trendYears = [];
            $s->keys()->filter(fn($k) => str_starts_with($k, 'penduduk_'))->sort()->each(function($k) use (&$trendYears, $v) {
                $yr = (int)str_replace('penduduk_', '', $k);
                $val = $v($k);
                if ($val > 0) $trendYears[] = ['year' => $yr, 'val' => $val];
            });
            $trendMax = count($trendYears) ? max(array_column($trendYears, 'val')) : 1;
            $trendMin = count($trendYears) ? min(array_column($trendYears, 'val')) : 0;
        @endphp
        <div class="col-lg-8">
            <div style="background:linear-gradient(135deg,#0f172a,#1e293b);border-radius:20px;padding:24px 20px 14px;position:relative;overflow:hidden;height:100%;display:flex;flex-direction:column">
                <div style="position:absolute;top:-40px;right:-40px;width:160px;height:160px;border-radius:50%;background:rgba(59,130,246,.08);pointer-events:none"></div>
                <svg id="lineChart" viewBox="0 0 700 170" width="100%" style="display:block;overflow:visible;flex:1" preserveAspectRatio="xMidYMid meet">
                    <defs>
                        <linearGradient id="lineGrad" x1="0" y1="0" x2="0" y2="1">
                            <stop offset="0%" stop-color="#06b6d4" stop-opacity="0.25"/>
                            <stop offset="100%" stop-color="#06b6d4" stop-opacity="0"/>
                        </linearGradient>
                    </defs>
                    @for($i = 0; $i <= 3; $i++)
                    <line x1="70" y1="{{ 20 + $i * 40 }}" x2="680" y2="{{ 20 + $i * 40 }}" stroke="rgba(255,255,255,.06)" stroke-width="1"/>
                    <text x="60" y="{{ 24 + $i * 40 }}" text-anchor="end" fill="rgba(255,255,255,.4)" font-size="11" font-family="'Plus Jakarta Sans',sans-serif">{{ number_format(round(($trendMax - ($trendMax - $trendMin) * $i / 3)/100)*100) }}</text>
                    @endfor
                    @php
                        $points = [];
                        $chartW = 600; $chartH = 120; $padL = 75; $padT = 20;
                        $range = max(1, $trendMax - $trendMin);
                        foreach ($trendYears as $i => $t) {
                            $x = $padL + ($i / (count($trendYears)-1)) * $chartW;
                            $y = $padT + (1 - ($t['val'] - $trendMin) / $range) * $chartH;
                            $points[] = ['x'=>round($x,1),'y'=>round($y,1),'val'=>$t['val'],'year'=>$t['year']];
                        }
                        // Build smooth cubic bezier curve
                        $linePath = 'M'.$points[0]['x'].','.$points[0]['y'];
                        for ($i=1; $i<count($points); $i++) {
                            $prev = $points[$i-1];
                            $curr = $points[$i];
                            $cpx = ($prev['x'] + $curr['x']) / 2;
                            $linePath .= ' C'.$cpx.','.$prev['y'].' '.$cpx.','.$curr['y'].' '.$curr['x'].','.$curr['y'];
                        }
                        $lastP = end($points); $firstP = $points[0];
                        $areaPath = $linePath.' L'.$lastP['x'].','.($padT+$chartH).' L'.$firstP['x'].','.($padT+$chartH).' Z';
                    @endphp
                    <clipPath id="areaClip"><rect id="areaClipRect" x="0" y="0" width="0" height="170"/></clipPath>
                    <path d="{{ $areaPath }}" fill="url(#lineGrad)" clip-path="url(#areaClip)"/>
                    <path d="{{ $linePath }}" fill="none" stroke="#22d3ee" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
                    @foreach($points as $i => $p)
                    <circle class="line-dot" cx="{{ $p['x'] }}" cy="{{ $p['y'] }}" r="4" fill="#0f172a" stroke="#22d3ee" stroke-width="2" style="cursor:pointer;opacity:0;transition:opacity .2s,r .15s,stroke-width .15s" data-year="{{ $p['year'] }}" data-val="{{ number_format($p['val']) }}"/>
                    <text x="{{ $p['x'] }}" y="{{ $padT + $chartH + 22 }}" text-anchor="middle" fill="rgba(255,255,255,.5)" font-size="11" font-weight="600" font-family="'Plus Jakarta Sans',sans-serif">{{ $p['year'] }}</text>
                    @endforeach
                </svg>
                <div id="lineTip" style="position:absolute;background:white;border-radius:8px;padding:6px 12px;font-size:11px;pointer-events:none;opacity:0;transition:all .12s;box-shadow:0 4px 12px rgba(0,0,0,.3);z-index:10">
                    <div style="font-weight:700;color:#0f172a" id="lineTipYear"></div>
                    <div style="font-size:13px;font-weight:800;color:#22d3ee" id="lineTipVal"></div>
                </div>
                {{-- Total penduduk di bawah chart, masih dalam 1 frame --}}
                <div style="display:flex;align-items:center;gap:12px;margin-top:8px;padding-top:10px;border-top:1px solid rgba(255,255,255,.1)">
                    <div style="width:40px;height:40px;border-radius:10px;background:rgba(59,130,246,.15);display:flex;align-items:center;justify-content:center"><i class="bi bi-people-fill" style="color:#60a5fa;font-size:18px"></i></div>
                    <div>
                        <div style="font-size:24px;font-weight:800;color:white">{{ number_format($v('total_penduduk')) }}</div>
                        <div style="font-size:11px;color:rgba(255,255,255,.5);font-weight:600;text-transform:uppercase;letter-spacing:.05em">Total Penduduk</div>
                    </div>
                </div>
            </div>
        </div>
        {{-- RIGHT: KK, RT, RW stacked --}}
        <div class="col-lg-4 d-flex flex-column gap-3">
            <div class="big-stat-card" style="flex:1">
                <div class="big-stat-icon" style="background:#ecfdf5"><i class="bi bi-house-fill" style="color:#10b981"></i></div>
                <div><div class="big-stat-number" style="color:#10b981">{{ number_format($v('jumlah_kk')) }}</div><div class="big-stat-label">{{ $l('jumlah_kk') }}</div></div>
            </div>
            <div class="big-stat-card" style="flex:1">
                <div class="big-stat-icon" style="background:#fdf4ff"><i class="bi bi-building-fill" style="color:#a855f7"></i></div>
                <div><div class="big-stat-number" style="color:#a855f7">{{ $v('jumlah_rt') }}</div><div class="big-stat-label">{{ $l('jumlah_rt') }}</div></div>
            </div>
            <div class="big-stat-card" style="flex:1">
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
    @if($anyUmur > 0)
    <div class="sec-title mb-1"><i class="bi bi-bar-chart-steps" style="color:var(--blue)"></i> Piramida Penduduk</div>
    <div class="sec-sub">Distribusi penduduk per kelompok usia 5-tahunan</div>

    <div class="chart-card mb-5" style="padding:24px 20px 16px;overflow:hidden">
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
        <div style="width:100%;overflow-x:auto">
        <svg id="pyrSvg" viewBox="0 0 {{ $svgW }} {{ $svgH }}" width="100%" style="display:block;font-family:'Plus Jakarta Sans',sans-serif;max-width:100%;height:auto;min-width:600px">
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
        <div style="display:flex;justify-content:center;gap:32px;margin-top:16px;padding-top:16px;border-top:1px solid var(--border)">
            <div style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600"><div style="width:18px;height:18px;border-radius:3px;background:#60a5fa"></div><span style="color:#1c64f2">Laki-Laki</span></div>
            <div style="display:flex;align-items:center;gap:8px;font-size:14px;font-weight:600"><div style="width:18px;height:18px;border-radius:3px;background:#f87171"></div><span style="color:#f43f5e">Perempuan</span></div>
        </div>
    </div>
    @endif

    {{-- BERDASARKAN AGAMA --}}
    <div class="sec-title mb-1"><i class="bi bi-stars" style="color:var(--orange)"></i> Berdasarkan Agama</div>
    <div class="sec-sub">Sebaran penduduk berdasarkan agama yang dianut</div>

    <div class="chart-card mb-5">
        <div class="row g-4 align-items-center">
            {{-- Kiri: Donut --}}
            <div class="col-lg-4" style="text-align:center">
                <div style="display:inline-block;position:relative">
                    <svg id="donutChart" width="220" height="220" viewBox="0 0 240 240" style="cursor:pointer"></svg>
                    <div id="donutCenter" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);text-align:center">
                        <div class="donut-total" style="font-size:22px;font-weight:800;color:var(--navy)">{{ number_format($totalAgama) }}</div>
                        <div style="font-size:10px;color:var(--muted);font-weight:600">TOTAL<br>JIWA</div>
                    </div>
                </div>
            </div>
            {{-- Kanan: Cards grid agama --}}
            <div class="col-lg-8">
                <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(180px,1fr));gap:10px">
                    @foreach($agamaList as $ag)
                    @php
                        $agIcons = [
                            'Islam'=>'🕌','Kristen'=>'⛪','Katolik'=>'✝️',
                            'Hindu'=>'🕉️','Buddha'=>'☸️','Konghucu'=>'☯️','Kepercayaan Lainnya'=>'🙏'
                        ];
                        $agIcon = $agIcons[$ag['label']] ?? '🙏';
                    @endphp
                    <div class="legend-row" data-agama="{{ $ag['label'] }}" data-jiwa="{{ number_format($ag['jiwa']) }}" data-pct="{{ $pa($ag['jiwa']) }}" data-color="{{ $ag['color'] }}" style="cursor:pointer;border-radius:12px;padding:14px 16px;background:#f8fafc;border:1px solid #e2e8f0;transition:all .2s;display:flex;align-items:center;gap:12px">
                        <div style="width:40px;height:40px;border-radius:50%;background:{{ $ag['bg'] }};display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px">{{ $agIcon }}</div>
                        <div>
                            <div style="font-size:12px;font-weight:600;color:var(--muted)">{{ $ag['label'] }}</div>
                            <div style="font-size:18px;font-weight:800;color:{{ $ag['color'] }};line-height:1.2">{{ number_format($ag['jiwa']) }}</div>
                            <div style="font-size:11px;color:var(--muted)">{{ $pa($ag['jiwa']) }}%</div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    {{-- ═══ KELOMPOK UMUR + STATUS PERKAWINAN (2 kolom) ═══ --}}
    @php
        $umur4Data = [
            ['key'=>'umur4_anak','label'=>'Anak (< 7 Thn)','emoji'=>'👶','color'=>'#f59e0b'],
            ['key'=>'umur4_remaja','label'=>'Remaja (7–18 Thn)','emoji'=>'🧑','color'=>'#8b5cf6'],
            ['key'=>'umur4_dewasa','label'=>'Dewasa (19–55 Thn)','emoji'=>'👨‍💼','color'=>'#1c64f2'],
            ['key'=>'umur4_lansia','label'=>'Lansia (≥ 56 Thn)','emoji'=>'👴','color'=>'#10b981'],
        ];
        $totalSample = $v('total_sample_ddk') ?: 15228;
        $kawinData = [
            ['key'=>'kawin_belum','label'=>'Belum Kawin','color'=>'#3b82f6'],
            ['key'=>'kawin_kawin','label'=>'Kawin','color'=>'#10b981'],
            ['key'=>'kawin_janda_duda','label'=>'Janda/Duda','color'=>'#f59e0b'],
        ];
        $totalKawin = array_sum(array_map(fn($k) => $v($k['key']), $kawinData));
    @endphp

    <div class="row g-4 mb-5">
        {{-- LEFT: Kelompok Umur --}}
        <div class="col-lg-7">
            <div class="sec-title mb-1"><i class="bi bi-calendar2-range-fill" style="color:#8b5cf6"></i> Kelompok Umur</div>
            <div class="sec-sub">Distribusi penduduk berdasarkan usia</div>
            <div class="chart-card">
                @foreach($umur4Data as $u4)
                @php
                    $u4val = $v($u4['key']);
                    $u4teks = optional($s[$u4['key']] ?? null)->nilai_teks ?? '0|0';
                    $u4parts = explode('|', $u4teks);
                    $u4l = (int)($u4parts[0] ?? 0);
                    $u4p = (int)($u4parts[1] ?? 0);
                    $u4pct = $totalSample > 0 ? round($u4val / $totalSample * 100, 1) : 0;
                    $u4barW = $totalSample > 0 ? round($u4val / $totalSample * 100) : 0;
                @endphp
                <div class="hbar-row">
                    <div style="font-size:24px;width:36px;text-align:center">{{ $u4['emoji'] }}</div>
                    <div class="hbar-label">{{ $u4['label'] }}</div>
                    <div class="hbar-track">
                        <div class="hbar-fill" style="width:{{ $u4barW }}%;background:linear-gradient(90deg,{{ $u4['color'] }},{{ $u4['color'] }}aa)">
                            @if($u4barW > 20){{ $u4pct }}%@endif
                        </div>
                    </div>
                    <div class="hbar-val" style="color:{{ $u4['color'] }}">{{ number_format($u4val) }}</div>
                    <div class="hbar-tooltip">{{ $u4['label'] }}: {{ number_format($u4val) }} (♂{{ number_format($u4l) }} ♀{{ number_format($u4p) }})</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- RIGHT: Status Perkawinan --}}
        <div class="col-lg-5">
            <div class="sec-title mb-1"><i class="bi bi-heart-fill" style="color:#f43f5e"></i> Status Perkawinan</div>
            <div class="sec-sub">Sebaran status perkawinan</div>
            <div class="chart-card">
                @php
                    $kwIcons = ['kawin_belum'=>'💍','kawin_kawin'=>'👫','kawin_janda_duda'=>'🧑'];
                @endphp
                @foreach($kawinData as $kw)
                @php
                    $kwval = $v($kw['key']);
                    $kwpct = $totalKawin > 0 ? round($kwval / $totalKawin * 100, 1) : 0;
                    $kwteks = optional($s[$kw['key']] ?? null)->nilai_teks ?? '0|0';
                    $kwparts = explode('|', $kwteks);
                    $kwl = (int)($kwparts[0] ?? 0);
                    $kwp = (int)($kwparts[1] ?? 0);
                    // SVG ring
                    $ringR = 22; $ringCirc = 2 * 3.14159 * $ringR;
                    $ringDash = $ringCirc * $kwpct / 100;
                    $ringGap = $ringCirc - $ringDash;
                @endphp
                <div style="display:flex;align-items:center;gap:14px;padding:14px 12px;border-radius:12px;transition:all .2s;cursor:default;{{ !$loop->last ? 'margin-bottom:8px;' : '' }}background:#f8fafc;border:1px solid #e2e8f0" onmouseenter="this.style.background='white';this.style.boxShadow='0 4px 16px rgba(0,0,0,.08)'" onmouseleave="this.style.background='#f8fafc';this.style.boxShadow='none'">
                    {{-- Mini progress ring --}}
                    <div style="position:relative;width:52px;height:52px;flex-shrink:0">
                        <svg width="52" height="52" viewBox="0 0 52 52">
                            <circle cx="26" cy="26" r="{{ $ringR }}" fill="none" stroke="#e2e8f0" stroke-width="5"/>
                            <circle cx="26" cy="26" r="{{ $ringR }}" fill="none" stroke="{{ $kw['color'] }}" stroke-width="5" stroke-dasharray="{{ $ringDash }} {{ $ringGap }}" stroke-linecap="round" transform="rotate(-90 26 26)" style="transition:stroke-dasharray 1s ease"/>
                        </svg>
                        <div style="position:absolute;inset:0;display:flex;align-items:center;justify-content:center;font-size:16px">{{ $kwIcons[$kw['key']] ?? '💍' }}</div>
                    </div>
                    {{-- Info --}}
                    <div style="flex:1;min-width:0">
                        <div style="font-size:13px;font-weight:700;color:var(--navy)">{{ $kw['label'] }}</div>
                        <div style="font-size:20px;font-weight:800;color:{{ $kw['color'] }};line-height:1.2">{{ number_format($kwval) }}</div>
                    </div>
                    {{-- Percentage + gender --}}
                    <div style="text-align:right">
                        <div style="font-size:16px;font-weight:800;color:{{ $kw['color'] }}">{{ $kwpct }}%</div>
                        <div style="font-size:11px;margin-top:2px"><span style="color:#3b82f6;font-weight:600">👨 {{ number_format($kwl) }}</span> · <span style="color:#f43f5e;font-weight:600">👩 {{ number_format($kwp) }}</span></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ═══ PEKERJAAN + PENDIDIKAN (2 kolom) ═══ --}}
    @php
        $kerjaData = [
            ['key'=>'kerja_pelajar','color'=>'#3b82f6'],
            ['key'=>'kerja_irt','color'=>'#f43f5e'],
            ['key'=>'kerja_wiraswasta','color'=>'#10b981'],
            ['key'=>'kerja_belum','color'=>'#f59e0b'],
            ['key'=>'kerja_buruh','color'=>'#8b5cf6'],
            ['key'=>'kerja_swasta','color'=>'#06b6d4'],
            ['key'=>'kerja_petani','color'=>'#84cc16'],
            ['key'=>'kerja_pemerintah','color'=>'#ec4899'],
            ['key'=>'kerja_pedagang_keliling','color'=>'#f97316'],
            ['key'=>'kerja_pedagang_kelontong','color'=>'#64748b'],
        ];
        $maxKerja = max(1, ...array_map(fn($k) => $v($k['key']), $kerjaData));
        $totalKerja = array_sum(array_map(fn($k) => $v($k['key']), $kerjaData));
        $pendData = [
            ['key'=>'pend_belum_sekolah','color'=>'#f59e0b','icon'=>'👶'],
            ['key'=>'pend_sma','color'=>'#3b82f6','icon'=>'🎓'],
            ['key'=>'pend_sd','color'=>'#f97316','icon'=>'📖'],
            ['key'=>'pend_smp','color'=>'#8b5cf6','icon'=>'📚'],
            ['key'=>'pend_s1','color'=>'#10b981','icon'=>'🎯'],
            ['key'=>'pend_sedang_sekolah','color'=>'#06b6d4','icon'=>'✏️'],
            ['key'=>'pend_diploma','color'=>'#ec4899','icon'=>'📋'],
            ['key'=>'pend_s2','color'=>'#0d1b3e','icon'=>'🏆'],
            ['key'=>'pend_tidak_tamat','color'=>'#94a3b8','icon'=>'📝'],
        ];
        $maxPend = max(1, ...array_map(fn($p) => $v($p['key']), $pendData));
        $totalPend = array_sum(array_map(fn($p) => $v($p['key']), $pendData));
    @endphp

    <div class="row g-4 mb-5" style="padding-top:12px">
        {{-- LEFT: Mata Pencaharian --}}
        <div class="col-lg-6 d-flex flex-column">
            <div class="sec-title mb-1" style="font-size:18px"><i class="bi bi-briefcase-fill" style="color:#f59e0b"></i> Mata Pencaharian</div>
            <div class="sec-sub">Top 10 pekerjaan penduduk</div>
            <div class="chart-card" style="flex:1">
                @foreach($kerjaData as $kd)
                @php
                    $kval = $v($kd['key']);
                    $klabel = optional($s[$kd['key']] ?? null)->label ?? $kd['key'];
                    $kpct = $totalKerja > 0 ? round($kval / $totalKerja * 100, 1) : 0;
                    $kwidth = $maxKerja > 0 ? round($kval / $maxKerja * 100) : 0;
                @endphp
                <div class="hbar-row">
                    <div class="hbar-rank" style="background:{{ $kd['color'] }}">{{ $loop->iteration }}</div>
                    <div class="hbar-label">{{ $klabel }}</div>
                    <div class="hbar-track">
                        <div class="hbar-fill" style="width:{{ $kwidth }}%;background:linear-gradient(90deg,{{ $kd['color'] }},{{ $kd['color'] }}aa)">
                            @if($kwidth > 20){{ $kpct }}%@endif
                        </div>
                    </div>
                    <div class="hbar-val" style="color:{{ $kd['color'] }}">{{ number_format($kval) }}</div>
                    <div class="hbar-tooltip">{{ $klabel }}: {{ number_format($kval) }} jiwa ({{ $kpct }}%)</div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- RIGHT: Pendidikan --}}
        <div class="col-lg-6 d-flex flex-column">
            <div class="sec-title mb-1" style="font-size:18px"><i class="bi bi-mortarboard-fill" style="color:#8b5cf6"></i> Tingkat Pendidikan</div>
            <div class="sec-sub">Pendidikan terakhir penduduk</div>
            <div class="chart-card" style="flex:1">
                @foreach($pendData as $pd)
                @php
                    $pval = $v($pd['key']);
                    $plabel = optional($s[$pd['key']] ?? null)->label ?? $pd['key'];
                    $ppct = $totalPend > 0 ? round($pval / $totalPend * 100, 1) : 0;
                    $pwidth = $maxPend > 0 ? round($pval / $maxPend * 100) : 0;
                @endphp
                <div class="hbar-row">
                    <div class="hbar-rank" style="background:{{ $pd['color'] }}">{{ $loop->iteration }}</div>
                    <div class="hbar-label">{{ $plabel }}</div>
                    <div class="hbar-track">
                        <div class="hbar-fill" style="width:{{ $pwidth }}%;background:linear-gradient(90deg,{{ $pd['color'] }},{{ $pd['color'] }}aa)">
                            @if($pwidth > 20){{ $ppct }}%@endif
                        </div>
                    </div>
                    <div class="hbar-val" style="color:{{ $pd['color'] }}">{{ number_format($pval) }}</div>
                    <div class="hbar-tooltip">{{ $plabel }}: {{ number_format($pval) }} jiwa ({{ $ppct }}%)</div>
                </div>
                @endforeach
            </div>
        </div>
    </div>

    {{-- ═══ STATUS PERKAWINAN ═══ --}}
    {{-- ═══ FASILITAS KELURAHAN ═══ --}}
    @php
        $fasGroups = [
            ['title'=>'Ibadah','icon'=>'bi-moon-stars-fill','color'=>'#10b981','bg'=>'#ecfdf5','items'=>[
                ['key'=>'fas_masjid','icon'=>'🕌'],
                ['key'=>'fas_musholla','icon'=>'🏠'],
                ['key'=>'fas_tpq','icon'=>'📖'],
            ]],
            ['title'=>'Pendidikan','icon'=>'bi-book-fill','color'=>'#3b82f6','bg'=>'#eff6ff','items'=>[
                ['key'=>'fas_paud','icon'=>'💒'],
                ['key'=>'fas_sd','icon'=>'🏫'],
                ['key'=>'fas_smp','icon'=>'📚'],
                ['key'=>'fas_sma','icon'=>'🎓'],
            ]],
            ['title'=>'Kesehatan','icon'=>'bi-heart-pulse-fill','color'=>'#ef4444','bg'=>'#fef2f2','items'=>[
                ['key'=>'fas_posyandu','icon'=>'🏥'],
                ['key'=>'fas_puskesmas','icon'=>'⚕️'],
            ]],
            ['title'=>'Olahraga','icon'=>'bi-trophy-fill','color'=>'#06b6d4','bg'=>'#ecfeff','items'=>[
                ['key'=>'fas_lapangan','icon'=>'⚽'],
            ]],
        ];
    @endphp
    <div class="sec-title mb-1"><i class="bi bi-building" style="color:#10b981"></i> Fasilitas Kelurahan</div>
    <div class="sec-sub">Sarana dan prasarana umum di Kelurahan Teritih</div>

    <div class="row g-3 mb-5">
        @foreach($fasGroups as $fg)
        <div class="col-md-6 col-lg-3">
            <div class="chart-card" style="padding:20px;height:100%;border-top:3px solid {{ $fg['color'] }}" onmouseenter="this.style.boxShadow='0 8px 24px {{ $fg['color'] }}15'" onmouseleave="this.style.boxShadow=''">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:16px">
                    <div style="width:32px;height:32px;border-radius:8px;background:{{ $fg['bg'] }};display:flex;align-items:center;justify-content:center;color:{{ $fg['color'] }}"><i class="bi {{ $fg['icon'] }}"></i></div>
                    <div style="font-size:13px;font-weight:700;color:{{ $fg['color'] }};text-transform:uppercase;letter-spacing:.04em">{{ $fg['title'] }}</div>
                </div>
                @foreach($fg['items'] as $fi)
                @php
                    $fval = $v($fi['key']);
                    $flabel = optional($s[$fi['key']] ?? null)->label ?? $fi['key'];
                @endphp
                <div style="display:flex;align-items:center;gap:10px;padding:8px 0;{{ !$loop->last ? 'border-bottom:1px solid #f1f5f9' : '' }}">
                    <span style="font-size:18px">{{ $fi['icon'] }}</span>
                    <span style="flex:1;font-size:13px;font-weight:600;color:var(--navy)">{{ $flabel }}</span>
                    <span style="font-size:18px;font-weight:800;color:{{ $fg['color'] }}">{{ $fval }}</span>
                </div>
                @endforeach
            </div>
        </div>
        @endforeach
    </div>

    {{-- ══ PETA WILAYAH ══ --}}
    <div class="sec-title mb-1"><i class="bi bi-geo-alt-fill" style="color:var(--red)"></i> Peta Wilayah</div>
    <div class="sec-sub">Pembagian lingkungan, batas wilayah, dan fasilitas umum Kelurahan Teritih.</div>

    @php $petaUrl = asset('images/PETA-TERITIH.png'); @endphp

    <div class="peta-card mb-5">
        <div class="peta-header">
            <div class="peta-icon"><i class="bi bi-map-fill"></i></div>
            <div class="peta-info">
                <div class="peta-name">Peta Wilayah Kelurahan Teritih</div>
                <div class="peta-desc">Pembagian lingkungan, batas wilayah, dan fasilitas umum</div>
            </div>
            <div class="peta-hint"><i class="bi bi-zoom-in"></i> Klik gambar untuk perbesar</div>
        </div>

        <div style="display:flex;gap:0;flex-wrap:wrap">
            {{-- Gambar peta --}}
            <div style="flex:0 0 auto;width:min(420px,100%);border-right:1px solid var(--border);cursor:zoom-in;overflow:hidden;position:relative;background:#f8fafc"
                 onclick="openLightbox('{{ $petaUrl }}', 'Peta Wilayah Kelurahan Teritih')"
                 title="Klik untuk perbesar">
                <img src="{{ $petaUrl }}"
                     alt="Peta Wilayah Kelurahan Teritih"
                     loading="lazy"
                     style="width:100%;height:100%;object-fit:contain;max-height:600px;display:block;transition:transform .35s ease"
                     onmouseover="this.style.transform='scale(1.02)'" onmouseout="this.style.transform='scale(1)'"
                     onerror="this.closest('div').innerHTML='<div style=\'padding:60px 20px;text-align:center;color:#94a3b8\'><i class=\'bi bi-map\' style=\'font-size:48px;display:block;margin-bottom:12px\'></i>File peta belum tersedia</div>'">
                <div style="position:absolute;bottom:12px;right:12px;background:rgba(15,23,42,.7);backdrop-filter:blur(8px);color:white;border:none;border-radius:8px;padding:6px 12px;font-size:12px;font-weight:600;display:flex;align-items:center;gap:6px;pointer-events:none">
                    <i class="bi bi-arrows-fullscreen"></i> Perbesar
                </div>
                <div style="position:absolute;bottom:12px;left:12px;background:rgba(15,23,42,.75);backdrop-filter:blur(8px);color:white;border-radius:8px;padding:6px 12px;font-size:12px;font-weight:600;display:flex;align-items:center;gap:6px;pointer-events:none">
                    <i class="bi bi-map-fill" style="color:#60a5fa"></i> 4,33 km² &nbsp;·&nbsp; 433 Ha
                </div>
            </div>

            {{-- Info panel --}}
            <div style="flex:1;min-width:220px;padding:24px 28px;display:flex;flex-direction:column;gap:20px">
                <div>
                    <div style="font-size:13px;font-weight:700;color:var(--navy);margin-bottom:12px;display:flex;align-items:center;gap:6px">
                        <i class="bi bi-info-circle-fill" style="color:var(--blue)"></i> Informasi Wilayah
                    </div>
                    <div style="display:flex;flex-direction:column;gap:10px">
                        @foreach([['bi-geo-alt','Kecamatan','Walantaka'],['bi-building','Kota/Kab','Kota Serang'],['bi-globe2','Provinsi','Banten'],['bi-mailbox2','Kode Pos','42183']] as [$icon,$label,$val])
                        <div style="display:flex;align-items:center;gap:10px;padding:10px 12px;background:var(--bg);border-radius:10px;border:1px solid var(--border)">
                            <i class="bi {{ $icon }}" style="color:var(--blue);font-size:15px;width:18px;text-align:center;flex-shrink:0"></i>
                            <div>
                                <div style="font-size:11px;color:var(--muted);font-weight:600;text-transform:uppercase;letter-spacing:.05em">{{ $label }}</div>
                                <div style="font-size:13px;font-weight:700;color:var(--navy)">{{ $val }}</div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div>
                    <div style="font-size:13px;font-weight:700;color:var(--navy);margin-bottom:12px;display:flex;align-items:center;gap:6px">
                        <i class="bi bi-layers-fill" style="color:#a855f7"></i> Batas Wilayah
                    </div>
                    <div style="display:flex;flex-direction:column;gap:8px">
                        @foreach([['Utara','Kec. Kasemen'],['Selatan','Kelurahan Kepuren & Kalodran'],['Barat','Kec. Cipocokjaya'],['Timur','Kabupaten Serang']] as [$arah,$batas])
                        <div style="display:flex;justify-content:space-between;align-items:center;padding:8px 12px;background:var(--bg);border-radius:8px;border:1px solid var(--border)">
                            <span style="font-size:12px;font-weight:600;color:var(--muted)">{{ $arah }}</span>
                            <span style="font-size:12px;font-weight:700;color:var(--navy)">{{ $batas }}</span>
                        </div>
                        @endforeach
                    </div>
                </div>

                <a href="{{ $petaUrl }}" download
                   style="display:inline-flex;align-items:center;justify-content:center;gap:8px;padding:10px 16px;background:#eff6ff;color:var(--blue);border-radius:10px;font-size:13px;font-weight:600;text-decoration:none;border:1px solid #bfdbfe;transition:all .18s;margin-top:auto"
                   onmouseover="this.style.background='#dbeafe'" onmouseout="this.style.background='#eff6ff'">
                    <i class="bi bi-download"></i> Unduh Peta
                </a>
            </div>
        </div>
    </div>

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
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<div id="pyrTip" style="position:fixed;background:white;border:1px solid #e2e8f0;border-radius:10px;padding:10px 14px;font-size:12px;pointer-events:none;opacity:0;transition:opacity .12s;z-index:99999;box-shadow:0 6px 20px rgba(0,0,0,.12);font-family:'Plus Jakarta Sans',sans-serif;max-width:200px"></div>
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

// ── Line Chart Hover ──────────────────────────────────────────────
(function(){
    const tip=document.getElementById('lineTip');
    if(!tip)return;
    const container=tip.parentElement;
    const svg=container.querySelector('svg');
    const dots=document.querySelectorAll('.line-dot');
    svg.addEventListener('mouseenter',()=>dots.forEach(d=>d.style.opacity='1'));
    svg.addEventListener('mouseleave',()=>{dots.forEach(d=>{d.style.opacity='0';d.setAttribute('r','4');d.setAttribute('stroke-width','2')});tip.style.opacity='0';});
    dots.forEach(dot=>{
        dot.addEventListener('mouseenter',function(){
            document.getElementById('lineTipYear').textContent=this.dataset.year;
            document.getElementById('lineTipVal').textContent=this.dataset.val;
            tip.style.opacity='1';
            this.setAttribute('r','7');this.setAttribute('stroke-width','3');
        });
        dot.addEventListener('mousemove',function(e){
            const rect=container.getBoundingClientRect();
            let x=e.clientX-rect.left+12;
            let y=e.clientY-rect.top-50;
            if(x+120>rect.width)x=x-140;
            if(y<0)y=y+70;
            tip.style.left=x+'px';tip.style.top=y+'px';
        });
        dot.addEventListener('mouseleave',function(){
            tip.style.opacity='0';
            this.setAttribute('r','4');this.setAttribute('stroke-width','2');
        });
    });
})();

// ── Piramida Tooltip (smooth) ─────────────────────────────────────
(function(){
    const tip=document.getElementById('pyrTip');
    if(!tip)return;
    const allBars=document.querySelectorAll('.pyr-bar');
    document.querySelectorAll('.pyr-bar').forEach(bar=>{
        bar.addEventListener('mouseenter',function(){
            const label=this.dataset.label;
            const laki=parseInt(this.dataset.laki||0);
            const prmp=parseInt(this.dataset.perempuan||0);
            const fill=this.getAttribute('fill')||'';
            const isLaki=fill.includes('60a5fa');
            const gender=isLaki?'Laki-Laki':'Perempuan';
            const val=isLaki?laki:prmp;
            tip.innerHTML=`<div style="font-weight:700;color:#0d1b3e;margin-bottom:4px">${label} Tahun</div><div style="font-size:13px">${gender}: <strong>${val.toLocaleString('id-ID')}</strong> jiwa</div>`;
            tip.style.opacity='1';
            allBars.forEach(b=>{b.style.opacity=b===this?'1':'0.3';});
        });
        bar.addEventListener('mousemove',function(e){
            tip.style.left=(e.clientX+12)+'px';
            tip.style.top=(e.clientY+12)+'px';
        });
        bar.addEventListener('mouseleave',function(){
            tip.style.opacity='0';
            allBars.forEach(b=>{b.style.opacity='0.85';});
        });
    });
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

// ── GSAP Animations ──────────────────────────────────────────────
gsap.registerPlugin(ScrollTrigger);

// Hero (immediate, top of page)
gsap.from('.info-hero', {opacity:0, y:40, duration:1, ease:'power3.out'});
gsap.from('.hero-badge', {opacity:0, y:20, duration:.6, delay:.3, ease:'back.out(1.7)'});
gsap.from('.hero-title', {opacity:0, y:30, duration:.8, delay:.4, ease:'power3.out'});
gsap.from('.hero-desc', {opacity:0, y:20, duration:.7, delay:.6, ease:'power2.out'});
gsap.from('.hero-emblem', {opacity:0, scale:.5, rotation:-15, duration:1, delay:.5, ease:'elastic.out(1,.5)'});

// Line chart draw
(function(){
    const el = document.querySelector('#lineChart path[stroke="#22d3ee"]');
    if (!el || !el.getTotalLength) return;
    const len = el.getTotalLength();
    el.style.strokeDasharray = len;
    el.style.strokeDashoffset = len;
    const clipRect = document.getElementById('areaClipRect');
    gsap.to(el, {strokeDashoffset:0, duration:3.5, ease:'power1.inOut', delay:.8});
    if (clipRect) gsap.to(clipRect, {attr:{width:700}, duration:3.5, ease:'power1.inOut', delay:.8});
})();

// ── Scroll-triggered animations using timeline approach ──
// Each section: set CSS hidden state, then gsap.to on scroll

// Helper: create scroll animation
function onScroll(trigger, fn) {
    ScrollTrigger.create({trigger:trigger, start:'top 82%', once:true, onEnter:fn});
}

// Stat cards (KK/RT/RW)
(function(){
    const cards = document.querySelectorAll('.big-stat-card');
    gsap.set(cards, {opacity:0, y:30});
    onScroll(cards[0], ()=> gsap.to(cards, {opacity:1, y:0, duration:1, stagger:.2, ease:'power3.out'}));
})();

// Gender cards
(function(){
    const cards = document.querySelectorAll('.gender-side-card');
    if (!cards.length) return;
    gsap.set(cards, {opacity:0, y:40, scale:.9});
    onScroll('.demo-card', ()=> gsap.to(cards, {opacity:1, y:0, scale:1, duration:1, stagger:.2, ease:'back.out(1.4)'}));
})();

// Piramida bars - grow width from 0
(function(){
    const bars = document.querySelectorAll('.pyr-bar');
    if (!bars.length) return;
    const origData = [];
    bars.forEach(bar => {
        origData.push({w: bar.getAttribute('width'), x: bar.getAttribute('x')});
        const fill = bar.getAttribute('fill') || '';
        if (fill.includes('60a5fa')) {
            // Laki-laki: grow from right edge (center)
            bar.setAttribute('x', parseFloat(bar.getAttribute('x')) + parseFloat(bar.getAttribute('width')));
        }
        bar.setAttribute('width', '0');
    });
    onScroll('#pyrSvg', ()=>{
        bars.forEach((bar, i) => {
            gsap.to(bar, {
                attr:{width: origData[i].w, x: origData[i].x},
                duration:1.5, delay:i*.05, ease:'power2.out'
            });
        });
    });
})();

// Donut chart
(function(){
    const el = document.getElementById('donutChart');
    if (!el) return;
    gsap.set(el, {scale:.6, rotation:-30, transformOrigin:'center center'});
    onScroll(el, ()=> gsap.to(el, {scale:1, rotation:0, duration:1.5, ease:'back.out(1.5)'}));
})();

// Agama legend cards
(function(){
    const rows = document.querySelectorAll('.legend-row');
    if (!rows.length) return;
    gsap.set(rows, {opacity:0, x:25});
    onScroll(rows[0], ()=> gsap.to(rows, {opacity:1, x:0, duration:.6, stagger:.08, ease:'power2.out'}));
})();

// ALL horizontal bars (kelompok umur, pekerjaan, pendidikan)
document.querySelectorAll('.chart-card').forEach(card => {
    const bars = card.querySelectorAll('.hbar-fill');
    if (!bars.length) return;
    const widths = [];
    bars.forEach(bar => {
        widths.push(bar.style.width);
        bar.style.width = '0';
        bar.style.transition = 'none';
    });
    onScroll(card, ()=>{
        bars.forEach((bar, i) => {
            gsap.to(bar, {width:widths[i], duration:1.8, delay:i*.1, ease:'power2.out'});
        });
    });
});

// Fasilitas cards
(function(){
    const cards = document.querySelectorAll('.col-md-6.col-lg-3 .chart-card');
    if (!cards.length) return;
    gsap.set(cards, {opacity:0, y:30});
    onScroll(cards[0], ()=> gsap.to(cards, {opacity:1, y:0, duration:.9, stagger:.15, ease:'back.out(1.3)'}));
})();

// Peta
(function(){
    const el = document.querySelector('.peta-card');
    if (!el) return;
    gsap.set(el, {opacity:0, y:30});
    onScroll(el, ()=> gsap.to(el, {opacity:1, y:0, duration:1, ease:'power3.out'}));
})();

// Berita cards
(function(){
    const grid = document.getElementById('beritaGrid');
    if (!grid) return;
    const cards = grid.querySelectorAll('.berita-overlay-card');
    if (!cards.length) return;
    gsap.set(cards, {opacity:0, y:50, scale:.95});
    onScroll(grid, ()=> gsap.to(cards, {opacity:1, y:0, scale:1, duration:1, stagger:.2, ease:'power3.out'}));
})();

// Counter count-up
document.querySelectorAll('.big-stat-number,.gs-num').forEach(el => {
    const target = parseInt(el.textContent.replace(/\D/g,'')) || 0;
    if (!target) return;
    el.textContent = '0';
    onScroll(el, ()=>{
        const obj = {val:0};
        gsap.to(obj, {val:target, duration:2.5, ease:'power2.out', onUpdate:()=>{
            el.textContent = Math.round(obj.val).toLocaleString('id-ID');
        }});
    });
});

// Section titles
document.querySelectorAll('.sec-title').forEach(t => {
    gsap.set(t, {opacity:0, x:-25});
    onScroll(t, ()=> gsap.to(t, {opacity:1, x:0, duration:.8, ease:'power2.out'}));
});
document.querySelectorAll('.sec-sub').forEach(t => {
    gsap.set(t, {opacity:0, x:-15});
    onScroll(t, ()=> gsap.to(t, {opacity:1, x:0, duration:.7, ease:'power2.out'}));
});

// Scroll to hash on load
window.addEventListener('load', ()=>{
    if(window.location.hash){
        const el = document.querySelector(window.location.hash);
        if(el) setTimeout(()=> el.scrollIntoView({behavior:'smooth', block:'start'}), 300);
    }
});
</script>
</body>
</html>