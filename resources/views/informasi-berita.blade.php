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
    :root{--blue:#1c64f2;--navy:#0d1b3e;--navy2:#1e3a5f;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9}
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:14px;line-height:1.6;min-height:100vh;display:flex;flex-direction:column}

    /* ── HERO HEADER (same as informasi) ── */
    .berita-hero{background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 55%,#1e4d8c 100%);border-radius:20px;padding:52px 56px;position:relative;overflow:hidden;display:flex;align-items:center;min-height:200px}
    .berita-hero::before{content:'';position:absolute;right:-60px;top:-60px;width:360px;height:360px;border-radius:50%;border:50px solid rgba(255,255,255,.04)}
    .berita-hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);border-radius:20px;padding:4px 14px;font-size:11px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#fbbf24;margin-bottom:14px}
    .berita-hero-title{font-size:36px;font-weight:800;color:white;line-height:1.15;margin-bottom:10px}
    .berita-hero-title span{color:#60a5fa}
    .berita-hero-desc{font-size:14px;color:rgba(255,255,255,.7);max-width:480px;line-height:1.7}
    .berita-hero-emblem{position:absolute;right:80px;top:50%;transform:translateY(-50%);width:130px;height:130px;background:rgba(255,255,255,.08);border:2px solid rgba(255,255,255,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.6);font-size:52px}

    /* ── LAYOUT WRAPPER ── */
    .page-wrapper{padding:24px 32px 52px;width:100%}

    /* ── CONTENT ── */
    .content-area{flex:1;margin-top:24px}

    /* ── FILTER + SEARCH ── */
    .search-filter-wrap{background:white;border:1px solid var(--border);border-radius:16px;padding:20px 24px;margin-bottom:28px;box-shadow:0 2px 8px rgba(0,0,0,.04)}
    .search-row{display:flex;gap:12px;margin-bottom:16px}
    .search-input-wrap{flex:1;position:relative}
    .search-input-wrap i{position:absolute;left:14px;top:50%;transform:translateY(-50%);color:var(--muted);font-size:15px;pointer-events:none}
    .search-input-wrap input{width:100%;border:1.5px solid var(--border);border-radius:12px;padding:11px 16px 11px 42px;font-size:14px;font-family:inherit;outline:none;transition:all .2s;background:#f8fafc}
    .search-input-wrap input:focus{border-color:var(--blue);background:white;box-shadow:0 0 0 3px rgba(28,100,242,.08)}
    .search-input-wrap input::placeholder{color:#94a3b8}
    .filter-divider{height:1px;background:var(--border);margin-bottom:14px}
    .filter-bar{display:flex;align-items:center;gap:8px;flex-wrap:wrap}
    .filter-label{font-size:11px;font-weight:700;color:var(--muted);text-transform:uppercase;letter-spacing:.08em;margin-right:2px;flex-shrink:0}
    .filter-btn{padding:7px 16px;border-radius:20px;font-size:12px;font-weight:600;border:1.5px solid var(--border);background:white;color:var(--slate);cursor:pointer;transition:all .18s;text-decoration:none;display:inline-block;white-space:nowrap}
    .filter-btn:hover{border-color:#93c5fd;color:var(--blue);background:#eff6ff}
    .filter-btn.active{background:var(--navy);border-color:var(--navy);color:white;box-shadow:0 3px 10px rgba(13,27,62,.2)}

    /* ── INFO BAR ── */
    .info-bar{display:flex;align-items:center;justify-content:space-between;margin-bottom:20px;flex-wrap:wrap;gap:8px}
    .info-bar-title{font-size:20px;font-weight:800;color:var(--navy);display:flex;align-items:center;gap:8px}
    .info-bar-count{font-size:13px;color:var(--muted)}

    /* ── BERITA CARD (reference style) ── */
    .berita-card{background:white;border-radius:16px;overflow:hidden;text-decoration:none;color:inherit;display:flex;flex-direction:column;transition:all .3s cubic-bezier(.4,0,.2,1);height:100%;border:1px solid var(--border)}
    .berita-card:hover{transform:translateY(-4px);box-shadow:0 12px 36px rgba(0,0,0,.12);border-color:transparent}
    .berita-card-img{height:240px;overflow:hidden;position:relative;background:linear-gradient(135deg,var(--navy),#1c64f2)}
    .berita-card-img img{width:100%;height:100%;object-fit:cover;transition:transform .4s ease}
    .berita-card:hover .berita-card-img img{transform:scale(1.05)}
    .berita-card-img .placeholder-icon{height:100%;display:flex;align-items:center;justify-content:center}
    .berita-card-img .placeholder-icon i{font-size:40px;color:rgba(255,255,255,.15)}
    .berita-card-cat{position:absolute;top:14px;left:14px;padding:5px 14px;border-radius:20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.03em;background:rgba(28,100,242,.9);color:white;backdrop-filter:blur(4px)}
    .berita-card-body{padding:18px 20px 20px;flex:1;display:flex;flex-direction:column}
    .berita-card-date{font-size:12px;color:var(--muted);display:flex;align-items:center;gap:5px;margin-bottom:10px}
    .berita-card-title{font-size:16px;font-weight:700;color:var(--navy);line-height:1.4;margin-bottom:10px;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .berita-card-desc{font-size:13px;color:var(--muted);line-height:1.65;flex:1;margin-bottom:14px;display:-webkit-box;-webkit-line-clamp:3;-webkit-box-orient:vertical;overflow:hidden}
    .berita-card-link{font-size:13px;font-weight:700;color:var(--blue);text-decoration:none;display:inline-flex;align-items:center;gap:5px;margin-top:auto;transition:gap .2s}
    .berita-card:hover .berita-card-link{gap:8px}

    /* ── PAGINATION (reference style) ── */
    .pagination-wrap{display:flex;justify-content:center;margin-top:40px}
    .pagination-wrap .pagination{gap:6px}
    .pagination-wrap .page-link{border-radius:10px !important;border:1.5px solid var(--border);color:var(--navy);font-size:14px;font-weight:600;padding:10px 16px;transition:all .18s;min-width:42px;text-align:center}
    .pagination-wrap .page-link:hover{background:#eff6ff;border-color:#93c5fd;color:var(--blue)}
    .pagination-wrap .page-item.active .page-link{background:var(--navy);border-color:var(--navy);color:white;box-shadow:0 4px 12px rgba(13,27,62,.2)}
    .pagination-wrap .page-item.disabled .page-link{opacity:.4}

    .empty-state{background:white;border:1px solid var(--border);border-radius:16px;padding:60px 20px;text-align:center;color:var(--muted)}

    @media(max-width:991px){.berita-hero{padding:36px 24px;min-height:auto}.berita-hero-title{font-size:26px}.berita-hero-emblem{display:none}.page-wrapper{padding:16px 16px 36px}}
    @media(max-width:767px){.berita-card-img{height:180px}.search-row{flex-direction:column}}
    </style>
</head>
<body>

@include('partials.navbar')

{{-- ══ HERO HEADER ══ --}}
<div class="page-wrapper">
    <div class="berita-hero">
        <div style="position:relative;z-index:2;max-width:500px">
            <div class="berita-hero-badge"><i class="bi bi-newspaper" style="font-size:11px"></i> Arsip &amp; Publikasi</div>
            <h1 class="berita-hero-title">Arsip <span>Berita</span></h1>
            <p class="berita-hero-desc">Pusat informasi resmi Kelurahan Teritih. Temukan berita terkini, pengumuman, dan laporan kegiatan dalam arsip digital kami.</p>
        </div>
        <div class="berita-hero-emblem"><i class="bi bi-newspaper"></i></div>
    </div>

    <div class="content-area">

        {{-- SEARCH + FILTER --}}
        @php
            $kategoriList = \App\Models\Berita::where('status','publish')
                ->whereNotNull('kategori')
                ->distinct()
                ->pluck('kategori');
            $aktifKategori = request('kategori');
            $searchQuery = request('q');
        @endphp
        <div class="search-filter-wrap">
            <div class="search-row">
                <div class="search-input-wrap">
                    <i class="bi bi-search"></i>
                    <input type="text" id="searchBerita" placeholder="Cari berita berdasarkan judul atau isi..." autocomplete="off">
                </div>
            </div>
            <div class="filter-divider"></div>
            <div class="filter-bar">
                <span class="filter-label">Kategori:</span>
                <a href="{{ route('berita') }}" class="filter-btn {{ !$aktifKategori ? 'active' : '' }}">Semua</a>
                @foreach($kategoriList as $kat)
                    <a href="{{ route('berita', ['kategori' => $kat]) }}"
                       class="filter-btn {{ $aktifKategori === $kat ? 'active' : '' }}">{{ $kat }}</a>
                @endforeach
            </div>
        </div>

    {{-- INFO BAR --}}
    <div class="info-bar">
        <div class="info-bar-title"><i class="bi bi-newspaper" style="color:var(--blue)"></i> Daftar Berita Terbaru</div>
        <div class="info-bar-count">Menampilkan <strong>{{ $totalBerita }}</strong> artikel</div>
    </div>

    @if(!$beritaFeatured)
    <div class="empty-state">
        <i class="bi bi-newspaper" style="font-size:40px;display:block;margin-bottom:12px;color:#e2e8f0"></i>
        <strong>Belum ada berita yang dipublikasikan.</strong>
    </div>
    @else

    {{-- ══ GRID 3 KOLOM ══ --}}
    <div class="row g-3" id="beritaGrid">
        @foreach($beritaList as $b)
        <div class="col-md-4">
            <a href="{{ route('berita.detail', $b->slug) }}" class="berita-card">
                <div class="berita-card-img">
                    @if($b->gambar)
                        <img src="{{ asset('storage/'.$b->gambar) }}" alt="{{ $b->judul }}">
                    @else
                        <div class="placeholder-icon"><i class="bi bi-newspaper"></i></div>
                    @endif
                    @if($b->kategori)<span class="berita-card-cat">{{ $b->kategori }}</span>@endif
                </div>
                <div class="berita-card-body">
                    <div class="berita-card-date"><i class="bi bi-calendar3"></i> {{ $b->tanggal_publish ? \Carbon\Carbon::parse($b->tanggal_publish)->format('d M Y') : '-' }}</div>
                    <div class="berita-card-title">{{ Str::limit($b->judul, 75) }}</div>
                    <div class="berita-card-desc">{{ Str::limit(strip_tags($b->ringkasan ?? $b->isi), 120) }}</div>
                    <span class="berita-card-link">Selengkapnya <i class="bi bi-arrow-right"></i></span>
                </div>
            </a>
        </div>
        @endforeach
    </div>

    @if($beritaList->hasPages())
    <div class="pagination-wrap">
        {{ $beritaList->appends(request()->query())->links('pagination::bootstrap-5') }}
    </div>
    @endif

    @endif

    </div>{{-- /content-area --}}
</div>{{-- /page-wrapper --}}

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script>
gsap.registerPlugin(ScrollTrigger);

function onScroll(trigger, fn) {
    ScrollTrigger.create({trigger:trigger, start:'top 90%', once:true, onEnter:fn});
}

// Hero (immediate - top of page)
gsap.from('.berita-hero', {opacity:0, y:40, duration:1, ease:'power3.out'});
gsap.from('.berita-hero-badge', {opacity:0, y:20, duration:.6, delay:.3, ease:'back.out(1.7)'});
gsap.from('.berita-hero-title', {opacity:0, y:30, duration:.8, delay:.4, ease:'power3.out'});
gsap.from('.berita-hero-desc', {opacity:0, y:20, duration:.7, delay:.6, ease:'power2.out'});
gsap.from('.berita-hero-emblem', {opacity:0, scale:.5, rotation:-15, duration:1, delay:.5, ease:'elastic.out(1,.5)'});

// Search + Filter
gsap.from('.search-filter-wrap', {opacity:0, y:20, duration:.7, delay:.7, ease:'power2.out'});

// Cards - animate per row on scroll (fast & snappy)
(function(){
    const grid = document.getElementById('beritaGrid');
    if (!grid) return;
    const cards = Array.from(grid.querySelectorAll('.berita-card'));
    if (!cards.length) return;
    for (let i = 0; i < cards.length; i += 3) {
        const row = cards.slice(i, i + 3);
        row.forEach(card => { card.style.transform = 'translateY(20px)'; card.style.opacity = '0'; });
        onScroll(row[0], ()=>{
            gsap.to(row, {y:0, opacity:1, duration:.4, stagger:.05, ease:'power2.out'});
        });
    }
})();
// Realtime search - client-side filter (no reload)
(function(){
    const input = document.getElementById('searchBerita');
    if (!input) return;
    const grid = document.getElementById('beritaGrid');
    if (!grid) return;
    const cards = grid.querySelectorAll('.col-md-4');

    input.addEventListener('input', function(){
        const q = this.value.toLowerCase().trim();
        cards.forEach(col => {
            const title = col.querySelector('.berita-card-title')?.textContent.toLowerCase() || '';
            const desc = col.querySelector('.berita-card-desc')?.textContent.toLowerCase() || '';
            const cat = col.querySelector('.berita-card-cat')?.textContent.toLowerCase() || '';
            col.style.display = (!q || title.includes(q) || desc.includes(q) || cat.includes(q)) ? '' : 'none';
        });
    });
})();
</script>
</body>
</html>
