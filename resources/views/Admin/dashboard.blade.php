@extends('admin.layouts.app')

@section('title', 'Dashboard')

@push('styles')
<link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
:root {
    --blue:#1c64f2; --blue-dk:#1a56db; --blue-lt:#eff6ff;
    --navy:#0f172a; --slate:#334155; --muted:#64748b;
    --border:#e2e8f0; --bg:#f1f5f9;
    --green:#10b981; --orange:#f59e0b; --red:#ef4444; --purple:#8b5cf6; --yellow:#eab308;
}
body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--navy); font-size:14px; }

/* PAGE */
.page-wrapper { padding: 20px 16px 40px; }
@media(min-width:768px){ .page-wrapper{ padding:28px 28px 48px; } }

.page-title    { font-size:20px; font-weight:800; color:var(--navy); }
.page-subtitle { font-size:13px; color:var(--muted); margin-top:2px; }
@media(min-width:576px){ .page-title{ font-size:22px; } }

/* BUTTONS */
.btn-period {
    display:inline-flex; align-items:center; gap:6px;
    padding:7px 12px; border-radius:8px; font-size:12px; font-weight:500;
    border:1px solid var(--border); background:white; color:var(--slate);
    cursor:pointer; text-decoration:none; transition:all .18s;
    white-space:nowrap;
}
.btn-period:hover { border-color:var(--blue); color:var(--blue); }
.btn-report {
    display:inline-flex; align-items:center; gap:6px;
    padding:7px 14px; border-radius:8px; font-size:12px; font-weight:600;
    border:none; background:var(--blue); color:white;
    cursor:pointer; text-decoration:none; transition:background .18s;
    white-space:nowrap;
}
.btn-report:hover { background:var(--blue-dk); color:white; }

/* STAT CARDS */
.stat-card {
    background:white; border-radius:12px; border:1px solid var(--border);
    padding:16px 18px;
    display:flex; align-items:flex-start; justify-content:space-between;
    transition:box-shadow .2s; height:100%;
}
.stat-card:hover { box-shadow:0 6px 20px rgba(0,0,0,.08); }
.stat-label { font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.05em; color:var(--muted); margin-bottom:4px; }
.stat-value { font-size:26px; font-weight:800; color:var(--navy); line-height:1.1; }
@media(min-width:768px){ .stat-value{ font-size:28px; } }
.stat-sub { font-size:11px; margin-top:6px; display:flex; align-items:center; gap:4px; }
.stat-sub.up     { color:var(--green); }
.stat-sub.warn   { color:var(--orange); }
.stat-sub.info   { color:var(--blue); }
.stat-sub.danger { color:var(--red); }
.stat-icon {
    width:42px; height:42px; border-radius:10px;
    display:flex; align-items:center; justify-content:center;
    font-size:20px; flex-shrink:0;
}
@media(min-width:768px){ .stat-icon{ width:46px; height:46px; font-size:22px; } }
.icon-blue   { background:#eff6ff; color:var(--blue); }
.icon-orange { background:#fffbeb; color:var(--orange); }
.icon-green  { background:#ecfdf5; color:var(--green); }
.icon-red    { background:#fef2f2; color:var(--red); }
.icon-purple { background:#f5f3ff; color:var(--purple); }
.icon-teal   { background:#f0fdfa; color:#0d9488; }

/* QUICK MENU */
.quick-card {
    background:white; border-radius:12px; border:1px solid var(--border);
    padding:14px 10px; text-align:center; text-decoration:none;
    color:var(--navy); display:flex; flex-direction:column;
    align-items:center; justify-content:center;
    transition:all .2s; height:100%;
}
.quick-card:hover { box-shadow:0 6px 20px rgba(0,0,0,.09); transform:translateY(-2px); color:var(--blue); }
.quick-icon {
    width:44px; height:44px; border-radius:11px;
    display:flex; align-items:center; justify-content:center;
    font-size:20px; margin:0 auto 8px;
}
@media(min-width:576px){ .quick-icon{ width:48px; height:48px; font-size:22px; } }
.quick-title { font-size:12px; font-weight:700; margin-bottom:2px; }
.quick-desc  { font-size:11px; color:var(--muted); display:none; }
@media(min-width:576px){ .quick-desc{ display:block; } }

/* DASH CARD */
.dash-card { background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden; }
.dash-card-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:12px 16px; border-bottom:1px solid var(--border); gap:8px;
}
@media(min-width:576px){ .dash-card-header{ padding:14px 18px; } }
.dash-card-title { font-size:13px; font-weight:700; color:var(--navy); display:flex; align-items:center; gap:7px; }
.dash-card-title i { color:var(--blue); font-size:15px; }
.dash-card-body { padding:4px 16px 6px; }
@media(min-width:576px){ .dash-card-body{ padding:6px 18px; } }

.btn-card-add {
    display:inline-flex; align-items:center; gap:4px;
    padding:5px 10px; border-radius:6px; font-size:11px; font-weight:600;
    background:var(--blue); color:white; border:none; cursor:pointer;
    text-decoration:none; transition:background .18s; white-space:nowrap;
}
.btn-card-add:hover { background:var(--blue-dk); color:white; }
.btn-card-link {
    display:inline-flex; align-items:center; gap:4px;
    padding:5px 10px; border-radius:6px; font-size:11px; font-weight:600;
    background:var(--blue-lt); color:var(--blue); border:none; cursor:pointer;
    text-decoration:none; transition:background .18s; white-space:nowrap;
}
.btn-card-link:hover { background:#dbeafe; }

/* BERITA */
.berita-item { display:flex; align-items:center; gap:10px; padding:10px 0; border-bottom:1px solid var(--border); }
.berita-item:last-child { border-bottom:none; }
.berita-thumb {
    width:48px; height:38px; border-radius:7px;
    background:var(--bg); flex-shrink:0;
    display:flex; align-items:center; justify-content:center;
    color:var(--muted); font-size:20px; overflow:hidden;
}
@media(min-width:576px){ .berita-thumb{ width:56px; height:44px; } }
.berita-thumb img { width:100%; height:100%; object-fit:cover; }
.berita-title { font-size:12px; font-weight:600; color:var(--navy); overflow:hidden; text-overflow:ellipsis; white-space:nowrap; max-width:180px; }
@media(min-width:576px){ .berita-title{ font-size:13px; max-width:260px; } }
@media(min-width:992px){ .berita-title{ max-width:340px; } }
.berita-meta { font-size:11px; color:var(--muted); margin-top:3px; }

.action-icon-btn {
    width:28px; height:28px; border-radius:6px;
    border:1px solid var(--border); background:white;
    cursor:pointer; display:inline-flex; align-items:center; justify-content:center;
    font-size:13px; color:var(--muted); text-decoration:none; transition:all .18s;
}
.action-icon-btn.edit:hover { background:var(--blue-lt); color:var(--blue); border-color:#93c5fd; }

.card-more-link {
    display:block; text-align:center; padding:10px;
    font-size:12px; font-weight:600; color:var(--blue);
    border-top:1px solid var(--border); text-decoration:none; transition:background .18s;
}
.card-more-link:hover { background:var(--blue-lt); }

/* BADGES */
.bdg { display:inline-flex; align-items:center; padding:2px 8px; border-radius:20px; font-size:10px; font-weight:600; }
.bdg-published  { background:#ecfdf5; color:var(--green); }
.bdg-draft      { background:#fffbeb; color:var(--orange); }
.bdg-pending    { background:#eff6ff; color:var(--blue); }
.bdg-approved   { background:#ecfdf5; color:var(--green); }
.bdg-rejected   { background:#fef2f2; color:var(--red); }

/* AKTIVITAS TABLE */
.aktivitas-tbl { width:100%; border-collapse:collapse; font-size:13px; }
.aktivitas-tbl th {
    padding:9px 12px; text-align:left; font-size:10px; font-weight:700;
    text-transform:uppercase; letter-spacing:.05em;
    color:var(--muted); border-bottom:1px solid var(--border); background:#f8fafc;
    white-space:nowrap;
}
.aktivitas-tbl td { padding:10px 12px; border-bottom:1px solid var(--border); color:var(--slate); vertical-align:middle; }
.aktivitas-tbl tbody tr:last-child td { border-bottom:none; }
.aktivitas-tbl tbody tr:hover td { background:#f8fafc; }
.user-cell { display:flex; align-items:center; gap:8px; }
.user-av {
    width:28px; height:28px; border-radius:7px;
    color:white; font-size:10px; font-weight:700;
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
}
.user-av.blue   { background:linear-gradient(135deg,var(--blue),#60a5fa); }
.user-av.green  { background:linear-gradient(135deg,var(--green),#6ee7b7); }
.user-av.purple { background:linear-gradient(135deg,var(--purple),#c4b5fd); }
.user-av.orange { background:linear-gradient(135deg,var(--orange),#fcd34d); }
.user-nm  { font-weight:600; color:var(--navy); font-size:12px; line-height:1.2; }
.user-nik { font-size:10px; color:var(--muted); }

/* NOTIFIKASI */
.jam-row {
    display:flex; justify-content:space-between; align-items:center;
    padding:9px 0; border-bottom:1px dashed var(--border); font-size:13px;
}
.jam-row:last-child { border-bottom:none; }
.jam-day  { font-weight:600; color:var(--navy); }
.jam-time { color:var(--slate); font-size:12px; }
.bdg-closed { display:inline-flex; padding:2px 9px; border-radius:20px; font-size:10px; font-weight:600; background:#fef2f2; color:var(--red); }

/* HERO BANNER */
.dash-hero {
    background:linear-gradient(135deg,#1e3a8a 0%,var(--blue) 50%,#3b82f6 100%);
    border-radius:14px; padding:20px; margin-bottom:20px;
    position:relative; overflow:hidden;
    display:flex; align-items:center; justify-content:space-between; gap:12px;
}
.dash-hero::before {
    content:''; position:absolute; right:-30px; top:-30px;
    width:160px; height:160px; border-radius:50%;
    border:30px solid rgba(255,255,255,.06);
}
.dash-hero-title { font-size:17px; font-weight:800; color:white; margin-bottom:2px; }
@media(min-width:576px){ .dash-hero-title{ font-size:20px; } }
.dash-hero-sub   { font-size:12px; color:rgba(255,255,255,.75); }
.dash-hero-date  {
    background:rgba(255,255,255,.15); border:1px solid rgba(255,255,255,.25);
    border-radius:8px; padding:6px 12px; font-size:12px; font-weight:600;
    color:white; white-space:nowrap; display:flex; align-items:center; gap:6px;
    cursor:pointer; transition:background .18s; user-select:none;
}
.dash-hero-date:hover { background:rgba(255,255,255,.25); }

/* =====================================================
   MODAL PERMOHONAN PER BULAN
===================================================== */
.month-modal-overlay {
    position:fixed; inset:0; z-index:9999;
    background:rgba(15,23,42,.5); backdrop-filter:blur(4px);
    display:flex; align-items:center; justify-content:center;
    padding:16px; opacity:0; pointer-events:none; transition:opacity .2s;
}
.month-modal-overlay.show { opacity:1; pointer-events:all; }

.month-modal {
    background:white; border-radius:16px; width:100%; max-width:700px;
    max-height:90vh; display:flex; flex-direction:column;
    box-shadow:0 24px 64px rgba(0,0,0,.2);
    transform:translateY(16px) scale(.97); transition:transform .25s;
}
.month-modal-overlay.show .month-modal { transform:translateY(0) scale(1); }

.month-modal-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:18px 20px; border-bottom:1px solid var(--border); flex-shrink:0;
}
.month-modal-title { font-size:15px; font-weight:800; color:var(--navy); display:flex; align-items:center; gap:8px; }
.month-modal-title i { color:var(--blue); }
.month-modal-close {
    width:32px; height:32px; border-radius:8px; border:1px solid var(--border);
    background:white; cursor:pointer; display:flex; align-items:center; justify-content:center;
    color:var(--muted); font-size:16px; transition:all .18s;
}
.month-modal-close:hover { background:#fef2f2; color:var(--red); border-color:#fecaca; }

.month-modal-filter {
    display:flex; align-items:center; gap:10px; padding:14px 20px;
    border-bottom:1px solid var(--border); flex-shrink:0; flex-wrap:wrap;
}
.month-modal-filter label { font-size:12px; font-weight:600; color:var(--navy); }
.month-select {
    padding:7px 12px; border-radius:8px; border:1.5px solid var(--border);
    font-size:13px; font-family:inherit; color:var(--navy);
    background:white; outline:none; cursor:pointer; transition:border-color .18s;
}
.month-select:focus { border-color:var(--blue); }
.btn-filter-apply {
    padding:7px 16px; border-radius:8px; border:none;
    background:var(--blue); color:white; font-size:13px; font-weight:600;
    cursor:pointer; transition:background .18s; font-family:inherit;
    display:flex; align-items:center; gap:6px;
}
.btn-filter-apply:hover { background:var(--blue-dk); }

.month-modal-body { overflow-y:auto; flex:1; padding:0; }

.month-summary {
    display:flex; gap:10px; padding:14px 20px; flex-wrap:wrap;
    background:#f8fafc; border-bottom:1px solid var(--border);
}
.month-sum-item {
    flex:1; min-width:80px; background:white; border-radius:9px;
    border:1px solid var(--border); padding:10px 14px; text-align:center;
}
.month-sum-val  { font-size:20px; font-weight:800; color:var(--navy); }
.month-sum-lbl  { font-size:10px; font-weight:600; color:var(--muted); text-transform:uppercase; margin-top:2px; }

.month-tbl { width:100%; border-collapse:collapse; font-size:13px; }
.month-tbl th {
    padding:9px 16px; text-align:left; font-size:10px; font-weight:700;
    text-transform:uppercase; letter-spacing:.05em;
    color:var(--muted); border-bottom:1px solid var(--border); background:#f8fafc;
    white-space:nowrap; position:sticky; top:0;
}
.month-tbl td { padding:10px 16px; border-bottom:1px solid var(--border); color:var(--slate); vertical-align:middle; }
.month-tbl tbody tr:last-child td { border-bottom:none; }
.month-tbl tbody tr:hover td { background:#f8fafc; }

.month-empty {
    padding:48px 20px; text-align:center; color:var(--muted); font-size:13px;
}
.month-empty i { font-size:36px; display:block; margin-bottom:10px; color:#e2e8f0; }

#month-modal-loading {
    padding:48px 20px; text-align:center; color:var(--muted); font-size:13px;
}
</style>
@endpush

@section('content')

@include('admin.partials.header')

<div class="page-wrapper">

    {{-- HERO BANNER --}}
    <div class="dash-hero mb-4">
        <div style="position:relative;z-index:1">
            <div class="dash-hero-title">Dashboard Admin</div>
            <div class="dash-hero-sub">Kelurahan Teritih — Ringkasan aktivitas hari ini</div>
        </div>
        {{-- Tombol tanggal — bisa diklik --}}
        <div class="dash-hero-date" id="btn-open-month-modal" style="position:relative;z-index:1" title="Klik untuk lihat data permohonan per bulan">
            <i class="bi bi-calendar3"></i>
            {{ \Carbon\Carbon::now()->translatedFormat('d F Y') }}
            <i class="bi bi-chevron-down" style="font-size:10px;opacity:.7"></i>
        </div>
    </div>

    {{-- STAT CARDS --}}
    <div class="row g-3 mb-4">
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Total Warga</div>
                    <div class="stat-value">{{ number_format($totalWarga) }}</div>
                    <div class="stat-sub info"><i class="bi bi-people"></i> Terdaftar</div>
                </div>
                <div class="stat-icon icon-blue"><i class="bi bi-people-fill"></i></div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Perlu Verifikasi</div>
                    <div class="stat-value">{{ number_format($perluVerifikasi) }}</div>
                    <div class="stat-sub warn">
                        <i class="bi bi-exclamation-circle"></i>
                        <span class="d-none d-sm-inline">{{ $perluVerifikasi > 0 ? 'Segera proses' : 'Sudah beres' }}</span>
                    </div>
                </div>
                <div class="stat-icon icon-orange"><i class="bi bi-clipboard2-check-fill"></i></div>
            </div>
        </div>
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Surat Keluar</div>
                    <div class="stat-value">{{ number_format($suratKeluar) }}</div>
                    <div class="stat-sub info"><i class="bi bi-envelope-check"></i> Disetujui</div>
                </div>
                <div class="stat-icon icon-green"><i class="bi bi-envelope-paper-fill"></i></div>
            </div>
        </div>
        {{-- ✅ LAPORAN diganti SURAT HARI INI --}}
        <div class="col-6 col-lg-3">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Surat Hari Ini</div>
                    <div class="stat-value">{{ number_format($suratHariIni ?? 0) }}</div>
                    <div class="stat-sub {{ ($suratHariIni ?? 0) > 0 ? 'up' : 'info' }}">
                        <i class="bi bi-{{ ($suratHariIni ?? 0) > 0 ? 'arrow-up-circle' : 'dash-circle' }}"></i>
                        <span class="d-none d-sm-inline">{{ ($suratHariIni ?? 0) > 0 ? 'Masuk hari ini' : 'Belum ada' }}</span>
                    </div>
                </div>
                <div class="stat-icon icon-teal"><i class="bi bi-file-earmark-text-fill"></i></div>
            </div>
        </div>
    </div>

    {{-- QUICK MENU --}}
    <div class="row g-2 g-md-3 mb-4">
        <div class="col-3">
            <a href="{{ route('kependudukan.index') }}" class="quick-card">
                <div class="quick-icon icon-blue"><i class="bi bi-person-vcard-fill"></i></div>
                <div class="quick-title">Data Warga</div>
                <div class="quick-desc">Kependudukan</div>
            </a>
        </div>
        <div class="col-3">
            <a href="{{ route('permohonan.index') }}" class="quick-card">
                <div class="quick-icon" style="background:#fffbeb;color:var(--yellow)"><i class="bi bi-shield-check"></i></div>
                <div class="quick-title">Verifikasi</div>
                <div class="quick-desc">Dokumen masuk</div>
            </a>
        </div>
        <div class="col-3">
            <a href="{{ route('informasi-admin.index') }}" class="quick-card">
                <div class="quick-icon" style="background:#fff7ed;color:var(--orange)"><i class="bi bi-newspaper"></i></div>
                <div class="quick-title">Berita</div>
                <div class="quick-desc">Kelola konten</div>
            </a>
        </div>
        <div class="col-3">
            <a href="{{ route('admin.statistik.edit') }}" class="quick-card">
                <div class="quick-icon" style="background:#ecfdf5;color:var(--green)"><i class="bi bi-bar-chart-fill"></i></div>
                <div class="quick-title">Statistik</div>
                <div class="quick-desc">Demografi</div>
            </a>
        </div>
    </div>

    {{-- MAIN GRID --}}
    <div class="row g-3">

        {{-- KIRI --}}
        <div class="col-12 col-xl-8">

            {{-- Manajemen Berita --}}
            <div class="dash-card mb-3">
                <div class="dash-card-header">
                    <div class="dash-card-title"><i class="bi bi-newspaper"></i> Manajemen Berita</div>
                    <a href="{{ route('informasi-admin.create') }}" class="btn-card-add">
                        <i class="bi bi-plus-lg"></i> <span class="d-none d-sm-inline">Tulis Baru</span>
                    </a>
                </div>
                <div class="dash-card-body">
                    @forelse($beritaTerbaru as $berita)
                    <div class="berita-item">
                        <div class="berita-thumb">
                            @if($berita->gambar)
                                <img src="{{ asset('storage/'.$berita->gambar) }}" alt="">
                            @else
                                <i class="bi bi-image"></i>
                            @endif
                        </div>
                        <div class="flex-grow-1 overflow-hidden">
                            <div class="berita-title">{{ $berita->judul }}</div>
                            <div class="berita-meta d-flex align-items-center gap-2">
                                @if($berita->status == 'publish')
                                    <span class="bdg bdg-published">Terbit</span>
                                @else
                                    <span class="bdg bdg-draft">Draft</span>
                                @endif
                                <span class="d-none d-sm-inline">{{ $berita->tanggal_publish ? \Carbon\Carbon::parse($berita->tanggal_publish)->format('d M Y') : 'Belum terbit' }}</span>
                            </div>
                        </div>
                        <div class="d-flex gap-1 flex-shrink-0">
                            <a href="{{ route('informasi-admin.edit', $berita->id_informasi) }}" class="action-icon-btn edit">
                                <i class="bi bi-pencil"></i>
                            </a>
                        </div>
                    </div>
                    @empty
                    <div style="text-align:center;padding:24px;color:var(--muted);font-size:13px;">
                        <i class="bi bi-newspaper" style="font-size:28px;display:block;margin-bottom:8px;color:var(--border)"></i>
                        Belum ada berita. <a href="{{ route('informasi-admin.create') }}" style="color:var(--blue)">Tulis sekarang</a>
                    </div>
                    @endforelse
                </div>
                <a href="{{ route('informasi-admin.index') }}" class="card-more-link">Kelola Semua Berita →</a>
            </div>

            {{-- Aktivitas Terbaru --}}
            <div class="dash-card">
                <div class="dash-card-header">
                    <div class="dash-card-title"><i class="bi bi-activity"></i> Aktivitas Terbaru</div>
                    <a href="{{ route('permohonan.index') }}" class="btn-card-link">
                        <i class="bi bi-arrow-right-short"></i> <span class="d-none d-sm-inline">Lihat Semua</span>
                    </a>
                </div>
                <div class="table-responsive">
                    <table class="aktivitas-tbl">
                        <thead>
                            <tr>
                                <th>NAMA</th>
                                <th class="d-none d-md-table-cell">JENIS LAYANAN</th>
                                <th>STATUS</th>
                                <th class="d-none d-sm-table-cell">TANGGAL</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($permohonanTerbaru as $p)
                            @php
                                $namaPemohon = $p->nama_pemohon ?? $p->user->nama ?? 'U';
                                $initials = collect(explode(' ', $namaPemohon))->map(fn($w) => strtoupper(substr($w,0,1)))->take(2)->join('');
                                $colors   = ['blue','green','purple','orange'];
                                $color    = $colors[$loop->index % count($colors)];
                                $status   = $p->approval->status ?? 'pending';
                            @endphp
                            <tr>
                                <td>
                                    <div class="user-cell">
                                        <div class="user-av {{ $color }}">{{ $initials }}</div>
                                        <div>
                                            <div class="user-nm">{{ Str::limit($namaPemohon, 18) }}</div>
                                            <div class="user-nik d-none d-sm-block">NIK: {{ $p->nik_pemohon ?? $p->user->nik ?? '-' }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="d-none d-md-table-cell">{{ Str::limit($p->jenisSurat->nama_surat ?? '-', 22) }}</td>
                                <td>
                                    @if($status === 'disetujui')
                                        <span class="bdg bdg-approved">Disetujui</span>
                                    @elseif($status === 'ditolak')
                                        <span class="bdg bdg-rejected">Ditolak</span>
                                    @else
                                        <span class="bdg bdg-pending">Pending</span>
                                    @endif
                                </td>
                                <td class="d-none d-sm-table-cell" style="font-size:12px;color:var(--muted)">
                                    {{ \Carbon\Carbon::parse($p->tanggal_pengajuan)->format('d M Y') }}
                                </td>
                                <td>
                                    <a href="{{ route('permohonan.show', $p->id_permohonan) }}" class="action-icon-btn edit">
                                        <i class="bi bi-eye"></i>
                                    </a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" style="text-align:center;padding:24px;color:var(--muted);font-size:13px;">
                                    Belum ada permohonan masuk.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>{{-- /kiri --}}

        {{-- KANAN SIDEBAR --}}
        <div class="col-12 col-xl-4 d-flex flex-column gap-3">

            {{-- Pemberitahuan --}}
            <div class="dash-card">
                <div class="dash-card-header">
                    <div class="dash-card-title">
                        <i class="bi bi-bell-fill"></i> Pemberitahuan
                        <span id="dash-notif-count" style="font-size:11px;font-weight:600;background:#eff6ff;color:#1c64f2;border-radius:20px;padding:2px 8px;display:none"></span>
                    </div>
                </div>
                <div id="dash-notif-list" style="padding:4px 0">
                    <div style="padding:24px 18px;text-align:center;color:#94a3b8;font-size:13px">
                        <i class="bi bi-arrow-clockwise" style="font-size:20px;display:block;margin-bottom:6px"></i>
                        Memuat...
                    </div>
                </div>
                <a href="{{ route('permohonan.index') }}" class="card-more-link">Lihat semua permohonan →</a>
            </div>

            {{-- Jam Operasional --}}
            <div class="dash-card">
                <div class="dash-card-header">
                    <div class="dash-card-title"><i class="bi bi-clock-fill"></i> Jam Operasional</div>
                </div>
                <div style="padding:6px 16px 14px">
                    <div class="jam-row" id="row-senin-kamis">
                        <span class="jam-day">Senin – Kamis</span>
                        <span class="jam-time">08.00 – 15.00</span>
                    </div>
                    <div class="jam-row" id="row-jumat">
                        <span class="jam-day">Jumat</span>
                        <span class="jam-time">08.00 – 11.30</span>
                    </div>
                    <div class="jam-row" id="row-sabtu-minggu">
                        <span class="jam-day">Sabtu – Minggu</span>
                        <span class="bdg-closed">Tutup</span>
                    </div>
                    <div id="status-kantor" style="margin-top:12px;border-radius:8px;padding:9px 12px;font-size:12px;display:flex;align-items:center;gap:6px;"></div>
                </div>
            </div>

        </div>{{-- /sidebar --}}

    </div>{{-- /main grid --}}

</div>{{-- /page-wrapper --}}

{{-- =====================================================
     MODAL PERMOHONAN PER BULAN
===================================================== --}}
<div class="month-modal-overlay" id="monthModalOverlay">
    <div class="month-modal">

        {{-- Header --}}
        <div class="month-modal-header">
            <div class="month-modal-title">
                <i class="bi bi-calendar3"></i>
                Data Permohonan per Bulan
            </div>
            <button class="month-modal-close" id="btnCloseMonthModal">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        {{-- Filter --}}
        <div class="month-modal-filter">
            <label>Bulan:</label>
            <select class="month-select" id="selectBulan">
                @php
                    $bulanList = ['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];
                @endphp
                @foreach($bulanList as $i => $bln)
                    <option value="{{ $i+1 }}" {{ ($i+1) == now()->month ? 'selected' : '' }}>{{ $bln }}</option>
                @endforeach
            </select>

            <label>Tahun:</label>
            <select class="month-select" id="selectTahun">
                @for($y = now()->year; $y >= now()->year - 4; $y--)
                    <option value="{{ $y }}" {{ $y == now()->year ? 'selected' : '' }}>{{ $y }}</option>
                @endfor
            </select>

            <button class="btn-filter-apply" id="btnApplyFilter">
                <i class="bi bi-search"></i> Tampilkan
            </button>
        </div>

        {{-- Body --}}
        <div class="month-modal-body" id="monthModalBody">
            <div id="month-modal-loading" style="padding:48px 20px;text-align:center;color:#94a3b8;font-size:13px;">
                <i class="bi bi-calendar3" style="font-size:36px;display:block;margin-bottom:10px;color:#e2e8f0"></i>
                Pilih bulan dan tahun lalu klik Tampilkan
            </div>
        </div>

    </div>
</div>

@include('admin.partials.footer')

@endsection

@push('scripts')
<script>
// ── Status Kantor ────────────────────────────────────────
function updateStatusKantor() {
    const now  = new Date(new Date().toLocaleString('en-US',{timeZone:'Asia/Jakarta'}));
    const day  = now.getDay();
    const hour = now.getHours();
    const min  = now.getMinutes();
    const time = hour + min / 60;
    let buka   = false;

    document.querySelectorAll('.jam-row').forEach(r => r.style.background = '');
    if (day >= 1 && day <= 4) {
        document.getElementById('row-senin-kamis').style.background = '#f0f9ff';
        buka = time >= 8 && time < 15;
    } else if (day === 5) {
        document.getElementById('row-jumat').style.background = '#f0f9ff';
        buka = time >= 8 && time < 11.5;
    } else {
        document.getElementById('row-sabtu-minggu').style.background = '#fef2f2';
        buka = false;
    }

    const el = document.getElementById('status-kantor');
    if (buka) {
        el.style.cssText = 'background:#f0fdf4;border:1px solid #bbf7d0;color:#166534;margin-top:12px;border-radius:8px;padding:9px 12px;font-size:12px;display:flex;align-items:center;gap:6px';
        el.innerHTML = `<i class="bi bi-circle-fill" style="font-size:8px;color:#16a34a"></i> Kantor sedang <strong style="margin-left:3px">Buka</strong>`;
    } else {
        el.style.cssText = 'background:#fef2f2;border:1px solid #fecaca;color:#991b1b;margin-top:12px;border-radius:8px;padding:9px 12px;font-size:12px;display:flex;align-items:center;gap:6px';
        const msg = (day === 6 || day === 0) ? 'Libur akhir pekan' : 'Di luar jam operasional';
        el.innerHTML = `<i class="bi bi-circle-fill" style="font-size:8px;color:#ef4444"></i> Kantor sedang <strong style="margin-left:3px">Tutup</strong> — ${msg}`;
    }
}
updateStatusKantor();
setInterval(updateStatusKantor, 60000);

// ── Notifikasi ───────────────────────────────────────────
(function() {
    const API   = '{{ route("admin.notifikasi") }}';
    const panel = document.getElementById('dash-notif-list');
    const pill  = document.getElementById('dash-notif-count');

    function escHtml(s) {
        return String(s).replace(/[&<>"]/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
    }

    function loadNotif() {
        fetch(API,{headers:{'Accept':'application/json'}})
        .then(r=>r.json())
        .then(data=>{
            const items = data.items||[];
            const count = data.count||0;
            pill.style.display = count > 0 ? '' : 'none';
            if (count > 0) pill.textContent = count+' baru';

            if (!items.length) {
                panel.innerHTML = `<div style="padding:20px 18px;text-align:center;color:#94a3b8;font-size:13px">
                    <i class="bi bi-bell-slash" style="font-size:22px;display:block;margin-bottom:6px;color:#e2e8f0"></i>
                    Tidak ada notifikasi baru</div>`;
                return;
            }
            panel.innerHTML = items.slice(0,5).map(n=>`
                <a href="${escHtml(n.url)}" style="display:flex;gap:10px;align-items:flex-start;padding:10px 16px;border-bottom:1px dashed #e2e8f0;text-decoration:none;color:inherit;transition:background .15s"
                   onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background=''">
                    <div style="width:8px;height:8px;border-radius:50%;background:#1c64f2;margin-top:5px;flex-shrink:0"></div>
                    <div style="flex:1">
                        <div style="font-size:12px;color:#334155;line-height:1.5">${escHtml(n.message)}</div>
                        <div style="font-size:11px;color:#94a3b8;margin-top:2px"><i class="bi bi-clock" style="font-size:10px"></i> ${escHtml(n.time)}</div>
                    </div>
                </a>`).join('');
        })
        .catch(()=>{ panel.innerHTML='<div style="padding:16px;font-size:12px;color:#94a3b8">Gagal memuat.</div>'; });
    }

    loadNotif();
    setInterval(loadNotif,30000);
})();

// ── Modal Permohonan per Bulan ───────────────────────────
(function() {
    const overlay  = document.getElementById('monthModalOverlay');
    const btnOpen  = document.getElementById('btn-open-month-modal');
    const btnClose = document.getElementById('btnCloseMonthModal');
    const btnApply = document.getElementById('btnApplyFilter');
    const body     = document.getElementById('monthModalBody');
    const selBulan = document.getElementById('selectBulan');
    const selTahun = document.getElementById('selectTahun');

    const BULAN_NAMES = ['','Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'];

    function openModal() {
        overlay.classList.add('show');
        document.body.style.overflow = 'hidden';
    }

    function closeModal() {
        overlay.classList.remove('show');
        document.body.style.overflow = '';
    }

    btnOpen.addEventListener('click', openModal);
    btnClose.addEventListener('click', closeModal);
    overlay.addEventListener('click', function(e) {
        if (e.target === this) closeModal();
    });
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') closeModal();
    });

    function escHtml(s) {
        return String(s).replace(/[&<>"]/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
    }

    function statusBadge(status) {
        if (status === 'disetujui') return '<span class="bdg bdg-approved">Disetujui</span>';
        if (status === 'ditolak')  return '<span class="bdg bdg-rejected">Ditolak</span>';
        return '<span class="bdg bdg-pending">Pending</span>';
    }

    function loadData() {
        const bulan = selBulan.value;
        const tahun = selTahun.value;

        body.innerHTML = `<div style="padding:48px 20px;text-align:center;color:#94a3b8;font-size:13px">
            <i class="bi bi-arrow-clockwise" style="font-size:32px;display:block;margin-bottom:10px;color:#e2e8f0;animation:spin 1s linear infinite"></i>
            Memuat data...
        </div>
        <style>@keyframes spin{to{transform:rotate(360deg)}}</style>`;

        fetch(`{{ url('admin/dashboard/permohonan-bulan') }}?bulan=${bulan}&tahun=${tahun}`, {
            headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
        })
        .then(r => r.json())
        .then(data => {
            const items  = data.data || [];
            const total  = data.total || 0;
            const setuju = data.disetujui || 0;
            const tolak  = data.ditolak || 0;
            const pend   = data.pending || 0;

            let html = `
            <div class="month-summary">
                <div class="month-sum-item">
                    <div class="month-sum-val">${total}</div>
                    <div class="month-sum-lbl">Total</div>
                </div>
                <div class="month-sum-item" style="border-color:#bbf7d0">
                    <div class="month-sum-val" style="color:var(--green)">${setuju}</div>
                    <div class="month-sum-lbl">Disetujui</div>
                </div>
                <div class="month-sum-item" style="border-color:#fecaca">
                    <div class="month-sum-val" style="color:var(--red)">${tolak}</div>
                    <div class="month-sum-lbl">Ditolak</div>
                </div>
                <div class="month-sum-item" style="border-color:#bfdbfe">
                    <div class="month-sum-val" style="color:var(--blue)">${pend}</div>
                    <div class="month-sum-lbl">Pending</div>
                </div>
            </div>`;

            if (!items.length) {
                html += `<div class="month-empty">
                    <i class="bi bi-inbox"></i>
                    Tidak ada permohonan di ${BULAN_NAMES[bulan]} ${tahun}
                </div>`;
            } else {
                html += `<div class="table-responsive">
                <table class="month-tbl">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>NAMA PEMOHON</th>
                            <th>JENIS SURAT</th>
                            <th>TANGGAL</th>
                            <th>STATUS</th>
                        </tr>
                    </thead>
                    <tbody>
                        ${items.map((p, i) => `
                        <tr>
                            <td style="color:var(--muted);font-size:12px">${i+1}</td>
                            <td>
                                <div style="font-weight:600;color:var(--navy);font-size:13px">${escHtml(p.nama_pemohon || '-')}</div>
                                <div style="font-size:11px;color:var(--muted)">NIK: ${escHtml(p.nik_pemohon || '-')}</div>
                            </td>
                            <td style="font-size:12px">${escHtml(p.jenis_surat || '-')}</td>
                            <td style="font-size:12px;color:var(--muted)">${escHtml(p.tanggal)}</td>
                            <td>${statusBadge(p.status)}</td>
                        </tr>`).join('')}
                    </tbody>
                </table></div>`;
            }

            body.innerHTML = html;
        })
        .catch(() => {
            body.innerHTML = `<div class="month-empty">
                <i class="bi bi-wifi-off"></i>
                Gagal memuat data. Coba lagi.
            </div>`;
        });
    }

    btnApply.addEventListener('click', loadData);
})();
</script>
@endpush