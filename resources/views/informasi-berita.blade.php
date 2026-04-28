<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Arsip Berita &amp; Pengumuman – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root{--blue:#1c64f2;--blue-dk:#1a56db;--blue-lt:#eff6ff;--navy:#0d1b3e;--navy2:#1e3a5f;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;--green:#10b981;--orange:#f59e0b;--red:#ef4444}
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:14px;line-height:1.6;min-height:100vh;display:flex;flex-direction:column}
    .page-header{background:white;border-bottom:1px solid var(--border);padding:14px 32px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px}
    .breadcrumb-custom{display:flex;align-items:center;gap:6px;font-size:13px;color:var(--muted);margin:0}
    .breadcrumb-custom a{color:var(--muted);text-decoration:none;transition:color .18s}
    .breadcrumb-custom a:hover{color:var(--blue)}
    .breadcrumb-custom .current{color:var(--navy);font-weight:600}
    .page-title{font-size:22px;font-weight:800;color:var(--navy);margin:0}
    .content-area{flex:1;padding:28px 32px 52px}
    .filter-bar{background:white;border:1px solid var(--border);border-radius:12px;padding:12px 16px;display:flex;align-items:center;gap:8px;flex-wrap:wrap;margin-bottom:24px}
    .filter-label{font-size:12px;font-weight:600;color:var(--muted);margin-right:4px}
    .filter-btn{padding:5px 14px;border-radius:20px;font-size:12px;font-weight:600;border:1.5px solid var(--border);background:white;color:var(--slate);cursor:pointer;transition:all .18s;text-decoration:none;display:inline-block}
    .filter-btn:hover,.filter-btn.active{background:var(--blue);border-color:var(--blue);color:white}
    .featured-wrap{background:white;border:1px solid var(--border);border-radius:16px;overflow:hidden;text-decoration:none;color:inherit;display:flex;flex-direction:column;transition:box-shadow .2s;height:100%}
    .featured-wrap:hover{box-shadow:0 8px 28px rgba(0,0,0,.1)}
    .featured-img{overflow:hidden;position:relative;background:var(--navy);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:64px;min-height:280px;flex:1}
    .featured-img img{width:100%;height:100%;object-fit:cover;position:absolute;inset:0}
    .featured-overlay{position:absolute;inset:0;background:linear-gradient(to top,rgba(10,20,50,.88) 0%,rgba(10,20,50,.2) 60%,transparent 100%);padding:28px;display:flex;flex-direction:column;justify-content:flex-end}
    .featured-meta{display:flex;align-items:center;gap:10px;margin-bottom:10px}
    .featured-title{font-size:22px;font-weight:800;color:white;line-height:1.3;margin-bottom:10px}
    .featured-desc{font-size:13px;color:rgba(255,255,255,.75);line-height:1.65;margin-bottom:14px}
    .btn-baca-full{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.3);border-radius:8px;padding:7px 16px;font-size:12.5px;font-weight:700;color:white;text-decoration:none;transition:all .18s;width:fit-content}
    .btn-baca-full:hover{background:rgba(255,255,255,.28);color:white}
    .berita-side{background:white;border:1px solid var(--border);border-radius:12px;overflow:hidden;text-decoration:none;color:inherit;display:flex;transition:box-shadow .18s;margin-bottom:12px}
    .berita-side:last-child{margin-bottom:0}
    .berita-side:hover{box-shadow:0 4px 16px rgba(0,0,0,.08)}
    .berita-side-img{width:90px;height:90px;flex-shrink:0;overflow:hidden;background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:24px}
    .berita-side-img img{width:100%;height:100%;object-fit:cover}
    .berita-side-body{padding:11px 14px;flex:1;display:flex;flex-direction:column;justify-content:center}
    .berita-side-title{font-size:12.5px;font-weight:700;color:var(--navy);line-height:1.4;margin-bottom:6px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .berita-side-date{font-size:11px;color:var(--muted)}
    .berita-grid-card{background:white;border:1px solid var(--border);border-radius:14px;overflow:hidden;text-decoration:none;color:inherit;display:flex;flex-direction:column;transition:all .2s;height:100%}
    .berita-grid-card:hover{box-shadow:0 6px 20px rgba(0,0,0,.09);transform:translateY(-2px)}
    .berita-grid-img{height:150px;overflow:hidden;position:relative;background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:32px}
    .berita-grid-img img{width:100%;height:100%;object-fit:cover}
    .date-pill{position:absolute;top:10px;left:10px;background:rgba(255,255,255,.92);backdrop-filter:blur(4px);border-radius:7px;padding:3px 9px;font-size:11px;font-weight:700;color:var(--navy)}
    .berita-grid-body{padding:14px;flex:1;display:flex;flex-direction:column}
    .berita-grid-title{font-size:13px;font-weight:700;color:var(--navy);line-height:1.4;margin-bottom:8px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .link-baca{font-size:12.5px;font-weight:600;color:var(--blue);text-decoration:none;display:inline-flex;align-items:center;gap:4px;margin-top:auto}
    .cat{display:inline-flex;padding:3px 10px;border-radius:20px;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.04em;background:#eff6ff;color:#1c64f2}
    .sec-title{font-size:18px;font-weight:800;color:var(--navy);display:flex;align-items:center;gap:9px;margin-bottom:3px}
    .sec-sub{font-size:12.5px;color:var(--muted);margin-bottom:20px}
    .empty-state{background:white;border:1px solid var(--border);border-radius:14px;padding:60px 20px;text-align:center;color:var(--muted)}

    /* ── PAGINATION ── */
    .pagination-wrap{display:flex;justify-content:center;margin-top:36px}
    .pagination-wrap .pagination{gap:4px}
    .pagination-wrap .page-link{border-radius:8px !important;border:1.5px solid var(--border);color:var(--navy);font-size:13px;font-weight:600;padding:6px 12px;transition:all .18s}
    .pagination-wrap .page-link:hover{background:var(--blue-lt);border-color:#bfdbfe;color:var(--blue)}
    .pagination-wrap .page-item.active .page-link{background:var(--blue);border-color:var(--blue);color:white}
    .pagination-wrap .page-item.disabled .page-link{opacity:.4}

    @media(max-width:991px){.page-header{padding:12px 16px}.content-area{padding:20px 16px 36px}.featured-img{min-height:220px}.featured-title{font-size:17px}}
    </style>
</head>
<body>

@include('partials.navbar')

<div class="page-header">
    <div>
        <div class="breadcrumb-custom mb-1">
            <a href="{{ route('home') }}">Beranda</a>
            <span style="font-size:10px"><i class="bi bi-chevron-right"></i></span>
            <a href="{{ route('informasi') }}">Informasi</a>
            <span style="font-size:10px"><i class="bi bi-chevron-right"></i></span>
            <span class="current">Berita &amp; Pengumuman</span>
        </div>
        <h1 class="page-title">Berita &amp; Pengumuman</h1>
    </div>
    <div style="font-size:12px;color:var(--muted)">
        Total <strong style="color:var(--navy)">{{ $totalBerita }}</strong> artikel tersedia
    </div>
</div>

<div class="content-area">

    {{-- FILTER BAR --}}
    @php
        $kategoriList = \App\Models\InformasiKelurahan::where('status','publish')
            ->whereNotNull('kategori')
            ->distinct()
            ->pluck('kategori');
        $aktifKategori = request('kategori');
    @endphp
    <div class="filter-bar">
        <span class="filter-label">Filter:</span>
        <a href="{{ route('informasi.berita') }}" class="filter-btn {{ !$aktifKategori ? 'active' : '' }}">Semua</a>
        @foreach($kategoriList as $kat)
            <a href="{{ route('informasi.berita', ['kategori' => $kat]) }}"
               class="filter-btn {{ $aktifKategori === $kat ? 'active' : '' }}">{{ $kat }}</a>
        @endforeach
    </div>

    <div class="sec-title mb-1">
        <i class="bi bi-newspaper" style="color:var(--blue)"></i> Semua Berita &amp; Pengumuman
    </div>
    <div class="sec-sub">Update terkini kegiatan dan informasi penting dari Kelurahan Teritih.</div>

    @if(!$beritaFeatured)
    <div class="empty-state">
        <i class="bi bi-newspaper" style="font-size:40px;display:block;margin-bottom:12px;color:#e2e8f0"></i>
        <strong>Belum ada berita yang dipublikasikan.</strong>
        <p style="margin:6px 0 0;font-size:13px">Admin belum memposting berita apapun.</p>
    </div>
    @else

    {{-- ══ FEATURED + SIDEBAR ══ --}}
    <div class="row g-3 mb-3">

        {{-- Featured --}}
        <div class="col-lg-6">
            <a href="{{ route('informasi.berita.detail', $beritaFeatured->slug) }}" class="featured-wrap">
                <div class="featured-img">
                    @if($beritaFeatured->gambar)
                        <img src="{{ asset('storage/'.$beritaFeatured->gambar) }}" alt="{{ $beritaFeatured->judul }}">
                    @else
                        <i class="bi bi-newspaper"></i>
                    @endif
                    <div class="featured-overlay">
                        <div class="featured-meta">
                            @if($beritaFeatured->kategori)
                                <span class="cat">{{ $beritaFeatured->kategori }}</span>
                            @endif
                            <span style="font-size:11px;color:rgba(255,255,255,.7)">
                                <i class="bi bi-calendar3 me-1"></i>
                                {{ $beritaFeatured->tanggal_publish ? \Carbon\Carbon::parse($beritaFeatured->tanggal_publish)->format('d M Y') : '-' }}
                            </span>
                        </div>
                        <div class="featured-title">{{ Str::limit($beritaFeatured->judul, 90) }}</div>
                        <div class="featured-desc">{{ Str::limit(strip_tags($beritaFeatured->ringkasan ?? $beritaFeatured->isi), 150) }}</div>
                        <span class="btn-baca-full"><i class="bi bi-arrow-up-right"></i> Baca Berita Lengkap</span>
                    </div>
                </div>
            </a>
        </div>

        {{-- Samping --}}
        <div class="col-lg-6">
            @forelse($beritaSamping as $b)
            <a href="{{ route('informasi.berita.detail', $b->slug) }}" class="berita-side">
                <div class="berita-side-img">
                    @if($b->gambar)
                        <img src="{{ asset('storage/'.$b->gambar) }}" alt="{{ $b->judul }}">
                    @else
                        <i class="bi bi-image"></i>
                    @endif
                </div>
                <div class="berita-side-body">
                    @if($b->kategori)
                        <span class="cat d-inline-block mb-1" style="font-size:9px">{{ $b->kategori }}</span>
                    @endif
                    <div class="berita-side-title">{{ Str::limit($b->judul, 70) }}</div>
                    <div class="berita-side-date">
                        <i class="bi bi-calendar3 me-1"></i>
                        {{ $b->tanggal_publish ? \Carbon\Carbon::parse($b->tanggal_publish)->format('d M Y') : '-' }}
                    </div>
                </div>
            </a>
            @empty
            <div style="padding:20px;text-align:center;color:var(--muted);font-size:13px">Tidak ada berita lainnya.</div>
            @endforelse
        </div>

    </div>

    {{-- ══ GRID ══ --}}
    @if($beritaGrid->count() > 0)
    <div class="row g-3">
        @foreach($beritaGrid as $b)
        <div class="col-md-4">
            <a href="{{ route('informasi.berita.detail', $b->slug) }}" class="berita-grid-card">
                <div class="berita-grid-img">
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
                    @if($b->kategori)
                        <span class="cat mb-2 d-inline-block">{{ $b->kategori }}</span>
                    @endif
                    <div class="berita-grid-title">{{ Str::limit($b->judul, 80) }}</div>
                    <span class="link-baca">Baca Selengkapnya <i class="bi bi-arrow-right"></i></span>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    {{-- ✅ FIX PAGINATION: pakai bootstrap-5 bawaan Laravel, bukan simple-bootstrap yang tidak ada --}}
    @if($beritaGrid->hasPages())
    <div class="pagination-wrap">
        {{ $beritaGrid->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
    @endif
    @endif

    @endif

</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>