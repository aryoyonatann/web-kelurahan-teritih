<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Layanan Administrasi – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root{--blue:#1c64f2;--blue-dk:#1a56db;--blue-lt:#eff6ff;--navy:#0d1b3e;--navy2:#1e3a5f;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;--green:#10b981;--orange:#f59e0b;--red:#ef4444}
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:14px;line-height:1.6;min-height:100vh;display:flex;flex-direction:column;overflow-x:hidden}
    .layanan-hero{background:linear-gradient(135deg,var(--navy) 0%,var(--navy2) 60%,#1e4d8c 100%);margin:24px 32px;border-radius:20px;padding:52px 56px;position:relative;overflow:hidden;min-height:260px;display:flex;align-items:center}
    .layanan-hero::before{content:'';position:absolute;right:-80px;top:-80px;width:380px;height:380px;border-radius:50%;border:50px solid rgba(255,255,255,.04)}
    .hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.12);border:1px solid rgba(255,255,255,.2);border-radius:20px;padding:4px 14px;font-size:10px;font-weight:700;letter-spacing:.1em;text-transform:uppercase;color:#fbbf24;margin-bottom:16px}
    .hero-title{font-size:40px;font-weight:800;color:white;line-height:1.15;margin-bottom:14px}
    .hero-title span{color:#60a5fa}
    .hero-desc{font-size:14px;color:rgba(255,255,255,.72);max-width:520px;line-height:1.75}
    .hero-emblem{position:absolute;right:80px;top:50%;transform:translateY(-50%);width:160px;height:160px;background:rgba(255,255,255,.08);border:2px solid rgba(255,255,255,.15);border-radius:50%;display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.55);font-size:64px}
    .content-area{flex:1;padding:28px 32px 48px}
    .layanan-main-card{background:white;border:1px solid var(--border);border-radius:16px;overflow:hidden;margin-bottom:20px}
    .layanan-card-header{padding:18px 24px;border-bottom:1px solid var(--border);display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:8px}
    .layanan-card-title{font-size:15px;font-weight:800;color:var(--navy);display:flex;align-items:center;gap:9px}
    .layanan-card-title i{color:var(--blue);font-size:18px}
    .count-badge{display:inline-flex;align-items:center;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600;background:var(--blue-lt);color:var(--blue);border:1px solid #bfdbfe}
    .surat-grid{padding:20px;display:grid;grid-template-columns:repeat(auto-fill,minmax(290px,1fr));gap:14px}
    .surat-card{display:flex;align-items:flex-start;gap:16px;padding:20px;border-radius:14px;border:1.5px solid var(--border);background:white;text-decoration:none;color:inherit;transition:all .2s;cursor:pointer;position:relative}
    .surat-card:hover{border-color:var(--blue);box-shadow:0 4px 20px rgba(28,100,242,.12);transform:translateY(-2px);color:inherit}
    .surat-card:hover .surat-cta i{transform:translateX(3px)}
    .surat-icon{width:52px;height:52px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:22px;flex-shrink:0}
    .surat-name{font-size:14px;font-weight:700;color:var(--navy);line-height:1.3;margin-bottom:5px}
    .surat-desc{font-size:12px;color:var(--muted);line-height:1.55}
    .surat-cta{display:inline-flex;align-items:center;gap:5px;margin-top:10px;font-size:12px;font-weight:700;color:var(--blue)}
    .surat-cta i{font-size:11px;transition:transform .2s}
    .login-notice{background:#fffbeb;border:1.5px solid #fde68a;border-radius:12px;padding:14px 18px;display:flex;align-items:center;gap:12px;font-size:13px;color:#92400e;margin-bottom:20px}
    .login-notice i{font-size:18px;color:#f59e0b;flex-shrink:0}
    .login-notice a{font-weight:700;color:#d97706;text-decoration:none}
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
    .status-buka{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;background:#dcfce7;color:#16a34a}
    .status-tutup{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700;background:#fef2f2;color:#dc2626}
    .status-dot{width:7px;height:7px;border-radius:50%;display:inline-block;flex-shrink:0}
    .status-dot-buka{background:#16a34a;animation:pulse-green 1.5s ease-in-out infinite}
    .status-dot-tutup{background:#dc2626}
    @keyframes pulse-green{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.5;transform:scale(.85)}}
    .jam-date{font-size:11px;color:#1e293b;font-weight:600;padding:8px 0 2px;display:flex;align-items:center;gap:5px}
    .jam-holiday{display:flex;align-items:flex-start;gap:8px;padding:8px 10px;background:#fff7ed;border-radius:8px;margin:6px 0 2px;border:1px solid #fed7aa}
    .jam-holiday-icon{color:#ea580c;font-size:13px;flex-shrink:0;margin-top:1px}
    .jam-holiday-text{font-size:11px;color:#9a3412;font-weight:600;line-height:1.4}
    .info-body{padding:16px 18px}
    .info-title{display:flex;align-items:center;gap:8px;font-size:13px;font-weight:700;color:var(--orange);margin-bottom:10px}
    .info-text{font-size:12.5px;color:var(--slate);line-height:1.65}
    .bantuan-body{padding:14px 18px}
    .bantuan-title{font-size:13px;font-weight:700;color:var(--navy);margin-bottom:12px}
    .bantuan-item{display:flex;align-items:center;gap:10px;padding:9px 0;border-bottom:1px solid var(--border)}
    .bantuan-item:last-child{border-bottom:none}
    .bantuan-icon{width:34px;height:34px;border-radius:8px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
    .bantuan-icon.green{background:#ecfdf5;color:var(--green)}
    .bantuan-icon.blue{background:#eff6ff;color:var(--blue)}
    .bantuan-label{font-size:11px;color:var(--muted);line-height:1.2}
    .bantuan-value{font-size:13px;font-weight:700;color:var(--navy);line-height:1.2}
    @media(max-width:991px){.layanan-hero{margin:16px;padding:36px 28px}.hero-title{font-size:28px}.hero-emblem{display:none}.content-area{padding:20px 16px 36px}.surat-grid{grid-template-columns:1fr}}
    </style>
</head>
<body>
@include('partials.navbar')

<!-- Hero -->
<div class="layanan-hero">
    <div style="position:relative;z-index:2;max-width:560px">
        <div class="hero-badge"><i class="bi bi-shield-check-fill" style="font-size:10px"></i> Layanan Publik</div>
        <h1 class="hero-title">Layanan <span>Administrasi</span></h1>
        <p class="hero-desc">Pilih jenis surat yang Anda butuhkan, isi formulir pengajuan secara online, dan surat akan diproses oleh pihak Kelurahan Teritih.</p>
    </div>
    <div class="hero-emblem"><i class="bi bi-person-vcard-fill"></i></div>
</div>

<div class="content-area">
    <div class="row g-4">
        <div class="col-lg-8">

            @guest
            <div class="login-notice">
                <i class="bi bi-info-circle-fill"></i>
                <div>Anda harus <a href="{{ route('login') }}">login sebagai masyarakat</a> untuk mengajukan permohonan surat. Belum punya akun? <a href="{{ route('register') }}">Daftar di sini</a>.</div>
            </div>
            @endguest

            @if(session('success'))
            <div style="background:#ecfdf5;border:1px solid #6ee7b7;border-radius:10px;padding:14px 18px;margin-bottom:16px;font-size:13px;color:#065f46;display:flex;align-items:center;gap:10px">
                <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
            </div>
            @endif

            <div id="pilih-jenis-surat" class="layanan-main-card">
                <div class="layanan-card-header">
                    <div class="layanan-card-title"><i class="bi bi-list-ul"></i> Pilih Jenis Surat</div>
                    <span class="count-badge">{{ \App\Models\JenisSurat::count() }} Layanan Tersedia</span>
                </div>

                <div class="surat-grid">

                    @php
                    $semuaSurat = \App\Models\JenisSurat::orderBy('is_custom')->orderBy('id_jenis_surat')->get();
                    @endphp

                    @foreach($semuaSurat as $surat)
                    @php
                        $warna = $surat->warna ?? '#1c64f2';
                        $bg    = $warna . '18'; // ~10% opacity hex approximation using inline rgba below
                        $route = auth()->check() ? route('user.permohonan.form', $surat->slug) : route('login');
                    @endphp
                    <a href="{{ $route }}" class="surat-card">
                        <div class="surat-icon" style="background:{{ $warna }}18;color:{{ $warna }}">
                            <i class="bi {{ $surat->icon ?? 'bi-file-earmark-text' }}"></i>
                        </div>
                        <div style="flex:1">
                            @if($surat->is_custom)
                            <div style="display:inline-flex;align-items:center;gap:4px;padding:2px 8px;border-radius:10px;font-size:10px;font-weight:700;background:#f0fdf4;color:#16a34a;border:1px solid #bbf7d0;margin-bottom:5px">
                                <i class="bi bi-plus-circle-fill" style="font-size:9px"></i> Baru
                            </div>
                            @endif
                            <div class="surat-name">{{ $surat->nama_surat }}</div>
                            <div class="surat-desc">{{ $surat->deskripsi ?? 'Surat keterangan resmi dari Kelurahan Teritih.' }}</div>
                            <div class="surat-cta">Ajukan Sekarang <i class="bi bi-arrow-right"></i></div>
                        </div>
                    </a>
                    @endforeach

                </div>

                <div style="background:#f8fafc;border-top:1px solid var(--border);padding:18px 24px">
                    <div style="font-size:13px;font-weight:700;color:var(--navy);margin-bottom:12px;display:flex;align-items:center;gap:8px">
                        <i class="bi bi-paperclip" style="color:var(--blue)"></i> Dokumen yang Perlu Disiapkan (Semua Jenis Surat)
                    </div>
                    <div class="row g-2">
                        @foreach(['Foto/scan KTP pemohon (JPG/PNG/PDF, maks 10MB)','Foto/scan Kartu Keluarga (JPG/PNG/PDF, maks 10MB)','Dokumen pendukung sesuai jenis surat yang dipilih','Data diri lengkap dan valid sesuai KTP'] as $syarat)
                        <div class="col-md-6">
                            <div style="display:flex;align-items:center;gap:8px;font-size:12.5px;color:var(--slate)">
                                <i class="bi bi-check-circle-fill" style="color:var(--green);flex-shrink:0"></i> {{ $syarat }}
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="sidebar-card">
                <div class="jam-header">
                    <div class="jam-header-icon"><i class="bi bi-clock-fill"></i></div>
                    <div class="jam-header-text"><div class="jam-title">Jam Operasional</div><div class="jam-subtitle">Pelayanan Kantor Kelurahan</div></div>
                </div>
                <div class="jam-body">
                    <div class="jam-row"><span class="jam-day">Senin–Kamis</span><span class="jam-time">08:00 – 16:00</span></div>
                    <div class="jam-row"><span class="jam-day">Jumat</span><span class="jam-time">08:00 – 15:30</span></div>
                    <div class="jam-row"><span class="jam-day">Sabtu–Minggu</span><span class="jam-tutup">Tutup</span></div>
                    <div class="jam-row" style="border-bottom:none;padding-top:10px;border-top:1px dashed var(--border)">
                        <span class="jam-day" style="font-size:12px;font-weight:600">Status Sekarang</span>
                        <span id="jam-status-layanan"></span>
                    </div>
                    {{-- TANGGAL & HARI LIBUR --}}
                    <div id="jam-date-layanan" class="jam-date"></div>
                    <div id="jam-holiday-layanan"></div>
                </div>
            </div>
            <div class="sidebar-card" style="border-left:3px solid var(--orange)">
                <div class="info-body">
                    <div class="info-title"><i class="bi bi-info-circle-fill"></i> Informasi Penting</div>
                    <div class="info-text">Pengajuan surat diproses pada hari kerja. Surat dapat dicetak langsung dari sistem setelah disetujui admin kelurahan.</div>
                </div>
            </div>

        </div>
    </div>
</div>

@include('partials.footer')
<script>
(function(){
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

    var dateLabel = HARI[day] + ', ' + wib.getDate() + ' ' + BULAN[wib.getMonth()] + ' ' + year;
    var elDate = document.getElementById('jam-date-layanan');
    if (elDate) elDate.innerHTML = '<i class="bi bi-calendar3"></i> ' + dateLabel;

    function setStatus(isOpen, isHoliday) {
        var el = document.getElementById('jam-status-layanan');
        if (!el) return;
        if (isOpen && !isHoliday) {
            el.innerHTML = '<span class="status-buka"><span class="status-dot status-dot-buka"></span>Sedang Buka</span>';
        } else {
            el.innerHTML = '<span class="status-tutup"><span class="status-dot status-dot-tutup"></span>Sedang Tutup</span>';
        }
    }

    function showHoliday(name) {
        var el = document.getElementById('jam-holiday-layanan');
        if (!el) return;
        el.innerHTML = '<div class="jam-holiday"><span class="jam-holiday-icon"><i class="bi bi-calendar-x-fill"></i></span><span class="jam-holiday-text">Hari Libur Nasional: ' + name + '</span></div>';
    }

    var isOpenByTime = (day >= 1 && day <= 4 && tot >= 480 && tot < 960)
                    || (day === 5 && tot >= 480 && tot < 930);

    fetch('https://api-harilibur.vercel.app/api?year=' + year)
        .then(function(r){ return r.json(); })
        .then(function(data) {
            var holiday = null;
            if (Array.isArray(data)) {
                for (var i = 0; i < data.length; i++) {
                    if (data[i].holiday_date === todayStr) {
                        holiday = data[i].holiday_name;
                        break;
                    }
                }
            }
            if (holiday) {
                showHoliday(holiday);
                setStatus(false, true);
            } else {
                setStatus(isOpenByTime, false);
            }
        })
        .catch(function() {
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

// Alert & header: visible on load
gsap.from('.content-area > *', {opacity:0, y:25, duration:.6, stagger:.1, ease:'power3.out'});

// Surat cards
(function(){
    const cards = document.querySelectorAll('.surat-card');
    if (!cards.length) return;
    gsap.set(cards, {opacity:0, y:25, scale:.97});
    onScroll(cards[0], ()=> gsap.to(cards, {opacity:1, y:0, scale:1, duration:.45, stagger:.07, ease:'back.out(1.3)'}));
})();

// Sidebar
(function(){
    const cards = document.querySelectorAll('.sidebar-card');
    if (!cards.length) return;
    gsap.set(cards, {opacity:0, x:25});
    onScroll(cards[0], ()=> gsap.to(cards, {opacity:1, x:0, duration:.5, stagger:.1, ease:'power3.out'}));
})();

// Scroll to hash on load
window.addEventListener('load', ()=>{
    if(window.location.hash){
        const el = document.querySelector(window.location.hash);
        if(el) setTimeout(()=> el.scrollIntoView({behavior:'smooth', block:'start'}), 300);
    }
});
</script>
</html>