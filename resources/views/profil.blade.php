<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Kelurahan – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root {
        --blue:#1c64f2; --blue-dk:#1a56db; --blue-lt:#eff6ff;
        --navy:#0d1b3e; --navy2:#1e3a5f; --slate:#334155;
        --muted:#64748b; --border:#e2e8f0; --bg:#f1f5f9;
        --green:#10b981; --orange:#f59e0b; --red:#ef4444;
        --fs-base: 17px;
        --fs-sm:   15px;
        --fs-xs:   13px;
        --fs-lg:   20px;
        --fs-xl:   24px;
        --fs-2xl:  32px;
        --fs-3xl:  42px;
    }
    *,*::before,*::after{box-sizing:border-box}
    body{
        font-family:'Plus Jakarta Sans',sans-serif;
        background:var(--bg); color:var(--slate);
        font-size:var(--fs-base); line-height:1.75;
        min-height:100vh; display:flex; flex-direction:column;
    }

    /* ── PAGE HEADER ── */
    .page-header{background:white;border-bottom:1px solid var(--border);padding:16px 32px;display:flex;align-items:center;justify-content:space-between}
    .breadcrumb-custom{display:flex;align-items:center;gap:6px;font-size:var(--fs-sm);color:var(--muted);margin:0}
    .breadcrumb-custom a{color:var(--muted);text-decoration:none;transition:color .18s}
    .breadcrumb-custom a:hover{color:var(--blue)}
    .breadcrumb-custom .current{color:var(--navy);font-weight:600}
    .page-title{font-size:var(--fs-xl);font-weight:800;color:var(--navy);margin:0}
    .kelurahan-badge{display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:20px;font-size:var(--fs-sm);font-weight:700;background:var(--blue-lt);color:var(--blue);border:1px solid #bfdbfe}

    /* ── LAYOUT ── */
    .content-area{flex:1;padding:32px 32px 56px}

    /* ── TENTANG ── */
    .about-section{background:white;border:1px solid var(--border);border-radius:20px;overflow:hidden;margin-bottom:28px}
    .about-hero-img{width:100%;aspect-ratio:16/7;overflow:hidden;position:relative;background:var(--navy);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:80px}
    .about-hero-img img{width:100%;height:100%;object-fit:cover;object-position:center}
    .about-hero-caption{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(10,20,50,.75) 0%,transparent 100%);padding:28px 32px 18px;display:flex;align-items:center;gap:10px;color:white;font-size:var(--fs-base);font-weight:700}
    .about-body{padding:36px 40px}
    .about-section-label{font-size:var(--fs-xs);font-weight:700;color:var(--blue);text-transform:uppercase;letter-spacing:.1em;margin-bottom:10px;display:flex;align-items:center;gap:8px}
    .about-section-label::before{content:'';display:block;width:28px;height:3px;background:var(--blue);border-radius:2px}
    .about-title{font-size:var(--fs-2xl);font-weight:800;color:var(--navy);margin-bottom:24px;line-height:1.2}
    .about-text{font-size:var(--fs-base);color:var(--slate);line-height:1.9;margin-bottom:0}
    .about-text p{margin-bottom:20px}
    .about-text p:last-child{margin-bottom:0}
    .about-text strong{color:var(--navy);font-weight:700}

    /* ── SEJARAH TIMELINE ── */
    .sejarah-section{margin-bottom:28px}
    .sejarah-header-card{background:linear-gradient(135deg,var(--blue) 0%,var(--blue-dk) 100%);border-radius:20px;padding:48px 40px;margin-bottom:28px;position:relative;overflow:hidden;color:white}
    .sejarah-header-card::before{content:'';position:absolute;top:-60px;right:-60px;width:200px;height:200px;background:rgba(255,255,255,0.08);border-radius:50%}
    .sejarah-header-card::after{content:'';position:absolute;bottom:-40px;left:-40px;width:150px;height:150px;background:rgba(255,255,255,0.05);border-radius:50%}
    .sejarah-header-content{position:relative;z-index:2}
    .sejarah-header-label{font-size:var(--fs-xs);font-weight:700;text-transform:uppercase;letter-spacing:.12em;margin-bottom:12px;display:flex;align-items:center;gap:8px;opacity:.95}
    .sejarah-header-title{font-size:var(--fs-3xl);font-weight:800;margin-bottom:14px;line-height:1.2}
    .sejarah-header-desc{font-size:var(--fs-base);line-height:1.75;max-width:720px;opacity:.95}
    .timeline-container{position:relative;padding:20px 0}
    .timeline-container::before{content:'';position:absolute;left:50%;top:0;bottom:0;width:3px;background:linear-gradient(180deg,var(--blue) 0%,var(--blue-lt) 100%);transform:translateX(-50%)}
    .timeline-item{margin-bottom:44px;position:relative}
    .timeline-item:last-child{margin-bottom:0}
    .timeline-item:nth-child(odd) .timeline-content{margin-left:0;margin-right:auto;padding-right:52%}
    .timeline-item:nth-child(even) .timeline-content{margin-left:auto;margin-right:0;padding-left:52%}
    .timeline-dot{position:absolute;left:50%;top:0;width:28px;height:28px;background:white;border:4px solid var(--blue);border-radius:50%;transform:translateX(-50%);z-index:10;display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--blue);font-weight:700;box-shadow:0 0 0 4px rgba(28,100,242,.1);transition:all .25s}
    .timeline-item:hover .timeline-dot{width:36px;height:36px;border-width:5px;box-shadow:0 0 0 6px rgba(28,100,242,.15)}
    .timeline-content{background:white;border:1px solid var(--border);border-radius:16px;padding:28px 32px;transition:all .25s}
    .timeline-item:hover .timeline-content{box-shadow:0 6px 24px rgba(28,100,242,.12);border-color:#bfdbfe}
    .timeline-year{font-size:var(--fs-lg);font-weight:800;color:var(--blue);margin-bottom:8px}
    .timeline-title{font-size:var(--fs-lg);font-weight:700;color:var(--navy);margin-bottom:10px;line-height:1.4}
    .timeline-text{font-size:var(--fs-base);color:var(--slate);line-height:1.8;margin:0}

    /* ── VISI MISI ── */
    .visimisi-section{margin-bottom:28px}
    .visi-full-card{background:white;border:1px solid var(--border);border-radius:20px;padding:48px 56px;text-align:center;margin-bottom:16px;position:relative;overflow:hidden}
    .visi-full-card::before{content:'';position:absolute;top:-40px;right:-40px;width:160px;height:160px;border-radius:50%;background:var(--blue-lt);opacity:.5}
    .visi-icon-wrap{width:64px;height:64px;border-radius:50%;background:var(--blue-lt);border:2px solid #bfdbfe;display:flex;align-items:center;justify-content:center;font-size:28px;color:var(--blue);margin:0 auto 18px}
    .visi-label{font-size:var(--fs-xs);font-weight:700;color:var(--blue);text-transform:uppercase;letter-spacing:.12em;margin-bottom:10px}
    .visi-main-title{font-size:var(--fs-3xl);font-weight:800;color:var(--navy);margin-bottom:20px}
    .visi-text{font-size:var(--fs-lg);color:var(--slate);line-height:1.75;font-style:italic;font-weight:500;max-width:760px;margin:0 auto}
    .misi-full-card{background:white;border:1px solid var(--border);border-radius:20px;padding:48px 56px;margin-bottom:16px}
    .misi-card-header{display:flex;align-items:center;gap:16px;margin-bottom:36px}
    .misi-icon-wrap{width:56px;height:56px;border-radius:14px;background:var(--blue-lt);display:flex;align-items:center;justify-content:center;font-size:26px;color:var(--blue);flex-shrink:0}
    .misi-main-title{font-size:var(--fs-3xl);font-weight:800;color:var(--navy);margin:0}
    .misi-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    .misi-item{display:flex;align-items:flex-start;gap:14px;padding:20px 22px;border-radius:14px;background:var(--bg);border:1px solid var(--border);font-size:var(--fs-base);color:var(--slate);line-height:1.7;transition:all .18s}
    .misi-item:hover{background:var(--blue-lt);border-color:#bfdbfe;color:var(--navy)}
    .misi-num{width:34px;height:34px;border-radius:50%;background:var(--blue);color:white;display:flex;align-items:center;justify-content:center;font-size:var(--fs-sm);font-weight:800;flex-shrink:0;margin-top:2px}

    /* ── STRUKTUR ── */
    .struktur-section{background:white;border:1px solid var(--border);border-radius:20px;padding:48px 40px;margin-bottom:28px}
    .struktur-label{font-size:var(--fs-xs);font-weight:700;color:var(--blue);letter-spacing:.12em;text-transform:uppercase;text-align:center;margin-bottom:10px}
    .struktur-title{font-size:var(--fs-3xl);font-weight:800;color:var(--navy);text-align:center;margin-bottom:10px}
    .struktur-subtitle{font-size:var(--fs-base);color:var(--muted);text-align:center;margin-bottom:44px}
    .org-chart{display:flex;flex-direction:column;align-items:center}
    .org-node-wrap{display:flex;flex-direction:column;align-items:center}
    .org-node{background:white;border:2px solid var(--border);border-radius:14px;padding:20px 28px;text-align:center;min-width:200px;transition:box-shadow .18s}
    .org-node.lurah{border-color:var(--blue);box-shadow:0 4px 20px rgba(28,100,242,.15)}
    .org-node:hover{box-shadow:0 6px 24px rgba(28,100,242,.12)}
    .org-avatar{width:56px;height:56px;border-radius:50%;background:var(--bg);border:2px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:26px;color:var(--muted);margin:0 auto 12px;overflow:hidden}
    .org-avatar.lurah-av{background:var(--blue-lt);border-color:#bfdbfe;color:var(--blue)}
    .org-avatar img{width:100%;height:100%;object-fit:cover}
    .org-name{font-size:var(--fs-base);font-weight:700;color:var(--navy);line-height:1.3}
    .org-role{font-size:var(--fs-xs);font-weight:700;color:var(--blue);text-transform:uppercase;letter-spacing:.08em;margin-top:4px}
    .org-role.sekre{color:var(--muted)}
    .org-role.kasi{color:var(--slate)}
    .org-line-v{width:2px;height:36px;background:var(--border)}
    .org-children{display:flex;gap:28px;justify-content:center;align-items:flex-start}
    .org-child-wrap{display:flex;flex-direction:column;align-items:center}
    .org-child-line{width:2px;height:36px;background:var(--border)}

    /* ── RESPONSIVE ── */
    @media(max-width:991px){
        .page-header{padding:14px 16px;flex-wrap:wrap;gap:8px}
        .content-area{padding:20px 16px 40px}
        .about-body{padding:24px 20px}
        .about-title{font-size:var(--fs-xl)}
        .visi-full-card,.misi-full-card,.struktur-section,.sejarah-header-card{padding:32px 20px}
        .visi-main-title,.misi-main-title,.struktur-title,.sejarah-header-title{font-size:var(--fs-2xl)}
        .visi-text{font-size:var(--fs-base)}
        .misi-grid{grid-template-columns:1fr}
        .org-children{flex-direction:column;align-items:center}
        .ds-grid{grid-template-columns:repeat(2,1fr) !important}
    }
    @media(max-width:768px){
        .timeline-container::before{left:0}
        .timeline-item:nth-child(odd) .timeline-content,
        .timeline-item:nth-child(even) .timeline-content{margin-left:0;margin-right:0;padding-left:56px;padding-right:0}
        .timeline-dot{left:0}
    }
    @media(max-width:576px){
        .about-hero-img{aspect-ratio:4/3}
        .ds-grid{grid-template-columns:1fr !important}
        .sejarah-header-card{padding:28px 16px}
        .sejarah-header-title{font-size:var(--fs-2xl)}
    }
    </style>
</head>
<body>

@include('partials.navbar')

<!-- PAGE HEADER -->
<div class="page-header">
    <div>
        <div class="breadcrumb-custom mb-1">
            <a href="{{ route('home') }}">Beranda</a>
            <i class="bi bi-chevron-right" style="font-size:10px"></i>
            <span class="current">Profil Kelurahan</span>
        </div>
        <h1 class="page-title">Profil Kelurahan</h1>
    </div>
    <div class="kelurahan-badge">
        <i class="bi bi-check-circle-fill" style="font-size:13px"></i>
        Kelurahan Teritih
    </div>
</div>

<div class="content-area">

    <!-- ══ TENTANG KELURAHAN ══ -->
    <div class="about-section">
        <div class="about-hero-img">
            <img src="https://images.unsplash.com/photo-1486325212027-8081e485255e?w=1400&q=85" alt="Kantor Kelurahan Teritih">
            <div class="about-hero-caption">
                <i class="bi bi-building"></i> Kantor Kelurahan Teritih
            </div>
        </div>
        <div class="about-body">
            <div class="about-section-label">Tentang Kami</div>
            <h2 class="about-title">Kelurahan Teritih, Kota Serang</h2>
            <div class="about-text">
                <p><strong>Kelurahan Teritih</strong> merupakan salah satu kelurahan yang berada di wilayah Kecamatan Walantaka, Kota Serang, Provinsi Banten. Kelurahan ini memiliki peran strategis dalam mendukung perkembangan wilayah Kota Serang bagian timur, baik dari segi pelayanan publik, pembangunan wilayah, maupun pemberdayaan masyarakat.</p>
                <p>Secara administratif dan geografis, Kelurahan Teritih memiliki lokasi yang cukup strategis karena berada tidak jauh dari pusat pemerintahan kecamatan, sehingga memudahkan koordinasi pemerintahan serta akses pelayanan bagi masyarakat. Wilayah Kelurahan Teritih didominasi oleh kawasan permukiman penduduk yang terus berkembang, seiring dengan pertumbuhan jumlah penduduk dan kebutuhan hunian yang semakin meningkat.</p>
                <p>Selain kawasan permukiman, Kelurahan Teritih juga masih memiliki area lahan terbuka dan pertanian yang menjadi bagian penting dalam menjaga keseimbangan lingkungan. Keberadaan ruang terbuka hijau ini memberikan manfaat ekologis sekaligus mendukung aktivitas ekonomi masyarakat, khususnya di sektor pertanian skala kecil dan usaha lokal.</p>
                <p>Dari sisi sosial, masyarakat Kelurahan Teritih dikenal memiliki semangat kebersamaan dan gotong royong yang tinggi. Hal ini tercermin dalam berbagai kegiatan kemasyarakatan seperti kerja bakti lingkungan, kegiatan keagamaan, serta partisipasi aktif dalam program pembangunan yang diselenggarakan oleh pemerintah kelurahan.</p>
                <p>Pemerintah Kelurahan Teritih terus berupaya meningkatkan kualitas pelayanan publik kepada masyarakat, khususnya dalam bidang administrasi kependudukan, pelayanan surat-menyurat, serta berbagai layanan sosial lainnya. Upaya ini dilakukan dengan mengedepankan prinsip pelayanan yang cepat, transparan, dan akuntabel.</p>
                <p>Seiring dengan perkembangan teknologi informasi, Kelurahan Teritih juga mulai mengimplementasikan sistem pelayanan berbasis digital untuk mempermudah masyarakat dalam mengakses layanan tanpa harus datang langsung ke kantor kelurahan. Langkah ini merupakan bagian dari komitmen dalam mendukung program Smart City/Smart Village di Kota Serang.</p>
                <p>Ke depan, Kelurahan Teritih berkomitmen untuk terus melakukan inovasi dalam tata kelola pemerintahan, meningkatkan kualitas sumber daya manusia, serta memperkuat sinergi antara pemerintah dan masyarakat guna mewujudkan lingkungan yang tertib, nyaman, dan sejahtera.</p>
            </div>
        </div>
    </div>

    <!-- ══ DATA SINGKAT (DINAMIS dari DB) ══ -->
    @php
        // Ambil nilai dari $dataSingkat yang dikirim controller
        // Fallback ke nilai default jika belum diset
        $ds = $dataSingkat ?? [];
        $dsItems = [
            [
                'icon'  => 'bi-mailbox2',
                'color' => '#d97706', 'bg' => '#fef3c7',
                'label' => 'Kode Pos',
                'value' => $ds['kode_pos'] ?? '42183',
                'unit'  => '',
            ],
            [
                'icon'  => 'bi-map-fill',
                'color' => '#10b981', 'bg' => '#ecfdf5',
                'label' => 'Luas Wilayah',
                'value' => $ds['luas_wilayah'] ?? '2.54',
                'unit'  => 'km²',
            ],
            [
                'icon'  => 'bi-people-fill',
                'color' => '#1c64f2', 'bg' => '#eff6ff',
                'label' => 'Jumlah Penduduk',
                'value' => $ds['jumlah_penduduk'] ?? '4.520',
                'unit'  => 'Jiwa',
            ],
            [
                'icon'  => 'bi-diagram-3-fill',
                'color' => '#a855f7', 'bg' => '#fdf4ff',
                'label' => 'Kecamatan',
                'value' => $ds['kecamatan'] ?? 'Walantaka',
                'unit'  => '',
            ],
            [
                'icon'  => 'bi-geo-alt-fill',
                'color' => '#f43f5e', 'bg' => '#fff1f2',
                'label' => 'Kota',
                'value' => $ds['kota'] ?? 'Serang',
                'unit'  => '',
            ],
            [
                'icon'  => 'bi-globe2',
                'color' => '#16a34a', 'bg' => '#f0fdf4',
                'label' => 'Provinsi',
                'value' => $ds['provinsi'] ?? 'Banten',
                'unit'  => '',
            ],
        ];
    @endphp

    <div style="background:white;border:1px solid var(--border);border-radius:20px;overflow:hidden;margin-bottom:28px">
        <div style="padding:20px 32px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px">
            <div style="width:40px;height:40px;border-radius:10px;background:var(--blue-lt);display:flex;align-items:center;justify-content:center;color:var(--blue);font-size:18px;flex-shrink:0">
                <i class="bi bi-info-circle-fill"></i>
            </div>
            <div>
                <div style="font-size:var(--fs-lg);font-weight:800;color:var(--navy);line-height:1.2">Data Singkat Kelurahan</div>
                <div style="font-size:var(--fs-xs);color:var(--muted);margin-top:2px">Informasi administratif Kelurahan Teritih</div>
            </div>
        </div>
        {{-- Grid otomatis sesuai jumlah item --}}
        <div class="ds-grid" style="display:grid;grid-template-columns:repeat({{ count($dsItems) }},1fr)">
            @foreach($dsItems as $i => $item)
            <div style="padding:24px 28px;{{ $i < count($dsItems)-1 ? 'border-right:1px solid var(--border)' : '' }}">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px">
                    <div style="width:32px;height:32px;border-radius:8px;background:{{ $item['bg'] }};display:flex;align-items:center;justify-content:center;color:{{ $item['color'] }};font-size:15px">
                        <i class="bi {{ $item['icon'] }}"></i>
                    </div>
                    <span style="font-size:var(--fs-xs);font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.07em">{{ $item['label'] }}</span>
                </div>
                <div style="font-size:var(--fs-2xl);font-weight:800;color:var(--navy)">
                    {{ $item['value'] }}
                    @if($item['unit'])
                    <span style="font-size:var(--fs-lg)">{{ $item['unit'] }}</span>
                    @endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- ══ SEJARAH KELURAHAN ══ -->
    <div class="sejarah-section">
        <div class="sejarah-header-card">
            <div class="sejarah-header-content">
                <div class="sejarah-header-label">
                    <i class="bi bi-hourglass-split"></i> Perjalanan Waktu
                </div>
                <h2 class="sejarah-header-title">Sejarah Terbentuknya Kelurahan Teritih</h2>
                <p class="sejarah-header-desc">
                    Mengenal lebih dekat perjalanan panjang Kelurahan Teritih dari masa awal pembentukan hingga menjadi kelurahan modern yang dinamis dan berprestasi di Kota Serang.
                </p>
            </div>
        </div>

        <div class="timeline-container">
            <div class="timeline-item">
                <div class="timeline-dot">1</div>
                <div class="timeline-content">
                    <div class="timeline-year">2012</div>
                    <div class="timeline-title">Perubahan Status Desa Menjadi Kelurahan</div>
                    <p class="timeline-text">
                        Dengan diundangkannya Peraturan Daerah (Perda) Kota Serang Nomor 8 tahun 2012 tentang Pembentukan dan Perubahan Status 15 (lima belas) Desa Menjadi Kelurahan pada tanggal 17 Oktober 2012, Desa Teritih secara legal formal berubah menjadi Kelurahan Teritih. Sehingga tanggal 17 Oktober dijadikan sebagai hari lahir Kelurahan Teritih.
                    </p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot">2</div>
                <div class="timeline-content">
                    <div class="timeline-year">Perubahan Tata Kelola</div>
                    <div class="timeline-title">Perubahan Sistem Pemerintahan</div>
                    <p class="timeline-text">
                        Perubahan status desa menjadi kelurahan ini berimplikasi kepada tata kelola dan nomenklatur pemerintahan Desa Teritih. Sebelum terbitnya Perda Nomor 8 Tahun 2012, Desa Teritih dipimpin oleh Kepala Desa yang berasal dari masyarakat setempat dan dipilih secara langsung oleh masyarakat Desa Teritih.
                    </p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot">3</div>
                <div class="timeline-content">
                    <div class="timeline-year">Setelah 2012</div>
                    <div class="timeline-title">Kepemimpinan oleh Lurah</div>
                    <p class="timeline-text">
                        Setelah berubah menjadi Kelurahan Teritih, sistem kepemimpinan juga mengalami perubahan. Kelurahan dipimpin oleh seorang Kepala Kelurahan atau disebut Lurah yang berasal dari Pegawai Negeri Sipil (PNS) di lingkungan Pemerintah Kota Serang yang memenuhi persyaratan dan diangkat langsung oleh Walikota Serang.
                    </p>
                </div>
            </div>
            <div class="timeline-item">
                <div class="timeline-dot">4</div>
                <div class="timeline-content">
                    <div class="timeline-year">Tujuan Perubahan</div>
                    <div class="timeline-title">Peningkatan Pelayanan Masyarakat</div>
                    <p class="timeline-text">
                        Semangat dari perubahan status desa menjadi kelurahan ini adalah untuk meningkatkan pelayanan masyarakat, melaksanakan fungsi pemerintahan, serta memperkuat pemberdayaan masyarakat dalam rangka mempercepat terwujudnya kesejahteraan masyarakat.
                    </p>
                </div>
            </div>
        </div>
    </div>

    <!-- ══ VISI MISI ══ -->
    <div class="visimisi-section">
        <div class="visi-full-card">
            <div class="visi-label">Visi</div>
            <div class="visi-icon-wrap"><i class="bi bi-eye-fill"></i></div>
            <h2 class="visi-main-title">Visi Kelurahan Teritih</h2>
            <div class="visi-text">
                "Terwujudnya Kelurahan Teritih yang Maju, Sejahtera, dan Berkeadaban Melalui Pelayanan Publik yang Prima dan Inovatif."
            </div>
        </div>

        <div class="misi-full-card">
            <div class="misi-card-header">
                <div class="misi-icon-wrap"><i class="bi bi-flag-fill"></i></div>
                <h2 class="misi-main-title">Misi Kelurahan Teritih</h2>
            </div>
            <div class="misi-grid">
                <div class="misi-item"><div class="misi-num">1</div><span>Meningkatkan kualitas sumber daya manusia yang berakhlak mulia dan berdaya saing tinggi dalam segala bidang kehidupan.</span></div>
                <div class="misi-item"><div class="misi-num">2</div><span>Mewujudkan tata kelola pemerintahan yang bersih, transparan, dan akuntabel demi kepercayaan masyarakat.</span></div>
                <div class="misi-item"><div class="misi-num">3</div><span>Meningkatkan infrastruktur dan sarana prasarana wilayah yang mendukung pertumbuhan perekonomian masyarakat.</span></div>
                <div class="misi-item"><div class="misi-num">4</div><span>Mengembangkan potensi ekonomi lokal berbasis pemberdayaan masyarakat dan kemitraan usaha kecil menengah.</span></div>
                <div class="misi-item"><div class="misi-num">5</div><span>Meningkatkan kualitas pelayanan administrasi kependudukan yang cepat, mudah, dan berbasis teknologi informasi.</span></div>
                <div class="misi-item"><div class="misi-num">6</div><span>Memperkuat kerukunan warga dan semangat gotong royong sebagai modal sosial pembangunan kelurahan.</span></div>
            </div>
        </div>
    </div>

    <!-- ══ STRUKTUR ORGANISASI ══ -->
    <div class="struktur-section">
        <div class="struktur-label">Pemerintahan</div>
        <h2 class="struktur-title">Struktur Organisasi</h2>
        <p class="struktur-subtitle">Bagan susunan organisasi dan tata kerja pemerintah Kelurahan Teritih.</p>

        <div class="org-chart">
            <div class="org-node-wrap">
                <div class="org-node lurah">
                    <div class="org-avatar lurah-av"><i class="bi bi-person-fill"></i></div>
                    <div class="org-name">H. Ahmad Fauzi, S.Sos</div>
                    <div class="org-role">Lurah</div>
                </div>
            </div>
            <div class="org-line-v"></div>
            <div class="org-node-wrap">
                <div class="org-node">
                    <div class="org-avatar"><i class="bi bi-person-fill"></i></div>
                    <div class="org-name">Rina Wulandari, S.IP</div>
                    <div class="org-role sekre">Sekretaris Kelurahan</div>
                </div>
            </div>
            <div class="org-line-v" style="position:relative">
                <div style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);width:520px;height:2px;background:var(--border);max-width:90vw"></div>
            </div>
            <div class="org-children">
                <div class="org-child-wrap">
                    <div class="org-child-line"></div>
                    <div class="org-node" style="min-width:160px">
                        <div class="org-avatar"><i class="bi bi-person-fill"></i></div>
                        <div class="org-name">Budi Hartono</div>
                        <div class="org-role kasi">Kasi Pemerintahan</div>
                    </div>
                </div>
                <div class="org-child-wrap">
                    <div class="org-child-line"></div>
                    <div class="org-node" style="min-width:160px">
                        <div class="org-avatar"><i class="bi bi-person-fill"></i></div>
                        <div class="org-name">Siti Aminah</div>
                        <div class="org-role kasi">Kasi Kesos</div>
                    </div>
                </div>
                <div class="org-child-wrap">
                    <div class="org-child-line"></div>
                    <div class="org-node" style="min-width:160px">
                        <div class="org-avatar"><i class="bi bi-person-fill"></i></div>
                        <div class="org-name">Dedi Supriyadi</div>
                        <div class="org-role kasi">Kasi Pembangunan</div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>{{-- /content-area --}}

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>