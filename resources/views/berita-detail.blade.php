<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $berita->judul }} – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root{--blue:#1c64f2;--blue-dk:#1a56db;--blue-lt:#eff6ff;--navy:#0d1b3e;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;--green:#10b981;--orange:#f59e0b;--red:#ef4444}
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:14px;line-height:1.6;min-height:100vh;display:flex;flex-direction:column}

    /* PAGE HEADER */
    .page-header{background:white;border-bottom:1px solid var(--border);padding:12px 32px}
    .breadcrumb-custom{display:flex;align-items:center;gap:6px;font-size:12px;color:var(--muted);flex-wrap:wrap}
    .breadcrumb-custom a{color:var(--muted);text-decoration:none}
    .breadcrumb-custom a:hover{color:var(--blue)}
    .breadcrumb-custom .current{color:var(--navy);font-weight:600}

    /* LAYOUT */
    .content-area{flex:1;padding:28px 32px 52px}
    .article-wrap{max-width:780px}

    /* HERO IMAGE */
    .article-hero{border-radius:16px;overflow:hidden;height:400px;background:var(--navy);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:64px;margin-bottom:28px;position:relative}
    .article-hero img{width:100%;height:100%;object-fit:cover}

    /* META */
    .article-cat{display:inline-flex;padding:4px 12px;border-radius:20px;font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;background:var(--blue-lt);color:var(--blue);margin-bottom:14px}
    .article-title{font-size:28px;font-weight:800;color:var(--navy);line-height:1.3;margin-bottom:14px}
    .article-meta{display:flex;align-items:center;gap:16px;font-size:12px;color:var(--muted);margin-bottom:24px;flex-wrap:wrap}
    .article-meta span{display:flex;align-items:center;gap:5px}
    .meta-divider{width:4px;height:4px;border-radius:50%;background:var(--border)}

    /* BODY */
    .article-body{font-size:15px;line-height:1.85;color:var(--slate)}
    .article-body p{margin-bottom:18px}
    .article-body img{max-width:100%;border-radius:10px;margin:12px 0}
    .article-body h2,.article-body h3{color:var(--navy);font-weight:700;margin:28px 0 12px}

    /* SHARE */
    .share-bar{background:white;border:1px solid var(--border);border-radius:12px;padding:16px 20px;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px;margin-top:32px;margin-bottom:32px}
    .share-label{font-size:13px;font-weight:700;color:var(--navy)}
    .share-btns{display:flex;gap:8px}
    .share-btn{display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:8px;font-size:12px;font-weight:600;text-decoration:none;transition:all .18s}
    .share-wa{background:#ecfdf5;color:#059669} .share-wa:hover{background:#d1fae5;color:#047857}
    .share-fb{background:#eff6ff;color:var(--blue)} .share-fb:hover{background:#dbeafe}
    .share-copy{background:var(--bg);color:var(--muted);border:none;cursor:pointer;font-family:inherit} .share-copy:hover{background:var(--border)}

    /* RELATED */
    .related-title{font-size:18px;font-weight:800;color:var(--navy);margin-bottom:16px;display:flex;align-items:center;gap:8px}
    .related-card{background:white;border:1px solid var(--border);border-radius:14px;overflow:hidden;text-decoration:none;color:inherit;display:flex;flex-direction:column;transition:all .2s;height:100%}
    .related-card:hover{box-shadow:0 6px 20px rgba(0,0,0,.09);transform:translateY(-2px)}
    .related-img{height:130px;overflow:hidden;background:var(--bg);display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:28px}
    .related-img img{width:100%;height:100%;object-fit:cover}
    .related-body{padding:13px}
    .related-cat{font-size:9px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--blue);margin-bottom:5px;display:block}
    .related-ttl{font-size:12.5px;font-weight:700;color:var(--navy);line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}

    /* BACK BTN */
    .btn-back{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:9px;border:1.5px solid var(--border);background:white;font-size:13px;font-weight:600;color:var(--slate);text-decoration:none;transition:all .18s;margin-bottom:20px}
    .btn-back:hover{border-color:var(--blue);color:var(--blue)}

    /* SIDEBAR */
    .sidebar-card{background:white;border:1px solid var(--border);border-radius:14px;padding:18px;margin-bottom:16px}
    .sidebar-card-title{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:14px;display:flex;align-items:center;gap:7px}
    .sidebar-card-title i{color:var(--blue)}
    .sidebar-item{display:flex;gap:10px;padding:9px 0;border-bottom:1px solid var(--border);text-decoration:none;color:inherit;transition:background .15s}
    .sidebar-item:last-child{border-bottom:none}
    .sidebar-item:hover .sidebar-item-title{color:var(--blue)}
    .sidebar-thumb{width:52px;height:42px;border-radius:7px;background:var(--bg);flex-shrink:0;overflow:hidden;display:flex;align-items:center;justify-content:center;color:var(--muted);font-size:18px}
    .sidebar-thumb img{width:100%;height:100%;object-fit:cover}
    .sidebar-item-title{font-size:12px;font-weight:600;color:var(--navy);line-height:1.4;display:-webkit-box;-webkit-line-clamp:2;-webkit-box-orient:vertical;overflow:hidden}
    .sidebar-item-date{font-size:10.5px;color:var(--muted);margin-top:3px}

    @media(max-width:991px){.content-area{padding:20px 16px 36px}.page-header{padding:12px 16px}.article-title{font-size:22px}.article-hero{height:240px}}
    </style>
</head>
<body>

@include('partials.navbar')

<div class="page-header">
    <div class="breadcrumb-custom">
        <a href="{{ route('home') }}">Beranda</a>
        <i class="bi bi-chevron-right" style="font-size:10px"></i>
        <a href="{{ route('berita') }}">Berita &amp; Pengumuman</a>
        <i class="bi bi-chevron-right" style="font-size:10px"></i>
        <span class="current">{{ Str::limit($berita->judul, 50) }}</span>
    </div>
</div>

<div class="content-area">
    <div class="row g-4">

        {{-- ARTIKEL UTAMA --}}
        <div class="col-lg-8">

            <a href="{{ route('berita') }}" class="btn-back">
                <i class="bi bi-arrow-left"></i> Kembali ke Berita
            </a>

            {{-- Hero Image --}}
            <div class="article-hero">
                @if($berita->gambar)
                    <img src="{{ asset('storage/'.$berita->gambar) }}" alt="{{ $berita->judul }}">
                @else
                    <i class="bi bi-newspaper"></i>
                @endif
            </div>

            {{-- Meta --}}
            @if($berita->kategori)
                <span class="article-cat">{{ $berita->kategori }}</span>
            @endif
            <h1 class="article-title">{{ $berita->judul }}</h1>
            <div class="article-meta">
                <span>
                    <i class="bi bi-calendar3"></i>
                    {{ $berita->tanggal_publish ? \Carbon\Carbon::parse($berita->tanggal_publish)->translatedFormat('d F Y') : '-' }}
                </span>
                @if($berita->views)
                    <span class="meta-divider"></span>
                    <span><i class="bi bi-eye"></i> {{ number_format($berita->views) }} dibaca</span>
                @endif
                <span class="meta-divider"></span>
                <span><i class="bi bi-building"></i> Admin Kelurahan Teritih</span>
            </div>

            {{-- Ringkasan (jika ada) --}}
            @if($berita->ringkasan)
            <div style="background:var(--blue-lt);border-left:4px solid var(--blue);border-radius:0 10px 10px 0;padding:14px 18px;margin-bottom:24px;font-size:14px;font-weight:500;color:var(--navy);line-height:1.7">
                {{ $berita->ringkasan }}
            </div>
            @endif

            {{-- Isi Artikel --}}
            <div class="article-body">
                {!! nl2br(e($berita->isi)) !!}
            </div>

            {{-- Share Bar --}}
            <div class="share-bar">
                <span class="share-label"><i class="bi bi-share me-2"></i>Bagikan Berita</span>
                <div class="share-btns">
                    <a href="https://wa.me/?text={{ urlencode($berita->judul.' - '.url()->current()) }}"
                       target="_blank" class="share-btn share-wa">
                        <i class="bi bi-whatsapp"></i> WhatsApp
                    </a>
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}"
                       target="_blank" class="share-btn share-fb">
                        <i class="bi bi-facebook"></i> Facebook
                    </a>
                    <button class="share-btn share-copy" onclick="copyLink()">
                        <i class="bi bi-link-45deg"></i> <span id="copy-label">Salin Link</span>
                    </button>
                </div>
            </div>

            {{-- Berita Terkait --}}
            @if($beritaLainnya->isNotEmpty())
            <div class="d-lg-none mt-2">
                <div class="related-title"><i class="bi bi-newspaper" style="color:var(--blue)"></i> Berita Lainnya</div>
                <div class="row g-3">
                    @foreach($beritaLainnya->take(3) as $b)
                    <div class="col-6">
                        <a href="{{ route('berita.detail', $b->slug) }}" class="related-card">
                            <div class="related-img">
                                @if($b->gambar)<img src="{{ asset('storage/'.$b->gambar) }}" alt="">@else<i class="bi bi-image"></i>@endif
                            </div>
                            <div class="related-body">
                                @if($b->kategori)<span class="related-cat">{{ $b->kategori }}</span>@endif
                                <div class="related-ttl">{{ $b->judul }}</div>
                            </div>
                        </a>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

        </div>{{-- /col-lg-8 --}}

        {{-- SIDEBAR --}}
        <div class="col-lg-4 d-none d-lg-block">

            {{-- Berita Terkait --}}
            @if($beritaLainnya->isNotEmpty())
            <div class="sidebar-card">
                <div class="sidebar-card-title">
                    <i class="bi bi-newspaper"></i> Berita Lainnya
                </div>
                @foreach($beritaLainnya as $b)
                <a href="{{ route('berita.detail', $b->slug) }}" class="sidebar-item">
                    <div class="sidebar-thumb">
                        @if($b->gambar)
                            <img src="{{ asset('storage/'.$b->gambar) }}" alt="">
                        @else
                            <i class="bi bi-image"></i>
                        @endif
                    </div>
                    <div>
                        @if($b->kategori)
                            <div style="font-size:9px;font-weight:700;text-transform:uppercase;color:var(--blue);margin-bottom:3px">{{ $b->kategori }}</div>
                        @endif
                        <div class="sidebar-item-title">{{ $b->judul }}</div>
                        <div class="sidebar-item-date">
                            <i class="bi bi-calendar3"></i>
                            {{ $b->tanggal_publish ? \Carbon\Carbon::parse($b->tanggal_publish)->format('d M Y') : '-' }}
                        </div>
                    </div>
                </a>
                @endforeach
            </div>
            @endif

            {{-- Kembali ke Semua Berita --}}
            <div class="sidebar-card" style="text-align:center">
                <a href="{{ route('berita') }}" style="display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:700;color:var(--blue);text-decoration:none">
                    <i class="bi bi-grid-3x3-gap"></i> Lihat Semua Berita
                </a>
            </div>

        </div>

    </div>
</div>

@include('partials.footer')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
<script>
gsap.registerPlugin(ScrollTrigger);
gsap.from('.page-header',{opacity:0,y:30,duration:.8,ease:'power3.out'});
gsap.from('.article-hero',{opacity:0,scale:.97,duration:1,delay:.2,ease:'power2.out'});
gsap.from('.article-title',{opacity:0,y:20,duration:.7,delay:.4,ease:'power2.out'});
gsap.from('.article-body',{opacity:0,y:20,duration:.7,delay:.6,ease:'power2.out'});
function copyLink() {
    navigator.clipboard.writeText(window.location.href).then(() => {
        const el = document.getElementById('copy-label');
        el.textContent = 'Tersalin!';
        setTimeout(() => el.textContent = 'Salin Link', 2000);
    });
}
</script>
</body>
</html>
