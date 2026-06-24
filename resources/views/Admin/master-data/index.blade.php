@extends('Admin.layouts.app')
@section('title', 'Master Data')

@push('styles')
<style>
.md-wrap{padding:32px 28px;max-width:1100px;margin:0 auto}
.md-hero{background:linear-gradient(135deg,#0d1b3e 0%,#1c64f2 100%);border-radius:20px;padding:36px 40px;margin-bottom:32px;position:relative;overflow:hidden}
.md-hero::after{content:'';position:absolute;right:-40px;top:-40px;width:220px;height:220px;border-radius:50%;background:rgba(255,255,255,.05)}
.md-hero::before{content:'';position:absolute;right:60px;bottom:-60px;width:160px;height:160px;border-radius:50%;background:rgba(255,255,255,.04)}
.md-hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.2);border-radius:20px;padding:4px 12px;font-size:11px;font-weight:700;color:rgba(255,255,255,.9);text-transform:uppercase;letter-spacing:.06em;margin-bottom:14px}
.md-hero h1{font-size:26px;font-weight:800;color:white;margin:0 0 8px}
.md-hero p{font-size:14px;color:rgba(255,255,255,.7);margin:0}

.md-section-label{font-size:11px;font-weight:700;color:#94a3b8;text-transform:uppercase;letter-spacing:.08em;margin-bottom:16px}

.md-card{display:flex;align-items:center;gap:20px;background:white;border:1.5px solid #e2e8f0;border-radius:16px;padding:22px 24px;text-decoration:none;transition:all .2s;position:relative;overflow:hidden}
.md-card::before{content:'';position:absolute;left:0;top:0;bottom:0;width:4px;border-radius:16px 0 0 16px;background:var(--accent);opacity:0;transition:opacity .2s}
.md-card:hover{box-shadow:0 8px 28px rgba(0,0,0,.09);transform:translateY(-2px);border-color:var(--accent-light)}
.md-card:hover::before{opacity:1}
.md-card-icon{width:56px;height:56px;border-radius:16px;background:var(--icon-bg);display:flex;align-items:center;justify-content:center;font-size:26px;color:var(--accent);flex-shrink:0}
.md-card-body{flex:1;min-width:0}
.md-card-title{font-size:15px;font-weight:700;color:#0d1b3e;margin-bottom:4px}
.md-card-desc{font-size:13px;color:#64748b;line-height:1.5}
.md-card-arrow{width:36px;height:36px;border-radius:10px;background:var(--icon-bg);display:flex;align-items:center;justify-content:center;color:var(--accent);font-size:15px;flex-shrink:0;transition:all .2s}
.md-card:hover .md-card-arrow{background:var(--accent);color:white}
</style>
@endpush

@section('content')
@include('Admin.partials.header')

<div class="md-wrap">

    {{-- Hero --}}
    <div class="md-hero">
        <div class="md-hero-badge"><i class="bi bi-database-fill-gear"></i> Sistem</div>
        <h1>Master Data</h1>
        <p>Kelola data dasar dan konfigurasi sistem layanan kelurahan</p>
    </div>

    {{-- Cards --}}
    <div class="md-section-label">Pilih yang ingin dikelola</div>
    <div style="display:flex;flex-direction:column;gap:14px">

        <a href="{{ route('jenis-surat.index') }}" class="md-card" style="--accent:#1c64f2;--accent-light:#bfdbfe;--icon-bg:#eff6ff">
            <div class="md-card-icon"><i class="bi bi-file-earmark-text-fill"></i></div>
            <div class="md-card-body">
                <div class="md-card-title">Jenis Surat</div>
                <div class="md-card-desc">Buat, edit, dan kelola template jenis surat beserta field dan kalimat isi yang akan diminta ke warga saat pengajuan.</div>
            </div>
            <div class="md-card-arrow"><i class="bi bi-arrow-right"></i></div>
        </a>

        <a href="{{ route('kelola-akun.index') }}" class="md-card" style="--accent:#a855f7;--accent-light:#e9d5ff;--icon-bg:#fdf4ff">
            <div class="md-card-icon"><i class="bi bi-people-fill"></i></div>
            <div class="md-card-body">
                <div class="md-card-title">Kelola Akun Masyarakat</div>
                <div class="md-card-desc">Lihat daftar akun warga terdaftar, blokir akun, reset password, dan export data kependudukan ke CSV.</div>
            </div>
            <div class="md-card-arrow"><i class="bi bi-arrow-right"></i></div>
        </a>

        <a href="{{ route('admin.pengaturan.edit') }}" class="md-card" style="--accent:#10b981;--accent-light:#a7f3d0;--icon-bg:#ecfdf5">
            <div class="md-card-icon"><i class="bi bi-building-gear"></i></div>
            <div class="md-card-body">
                <div class="md-card-title">Profil Kelurahan</div>
                <div class="md-card-desc">Update foto, nama pejabat, dan informasi kelurahan yang ditampilkan di halaman publik portal warga.</div>
            </div>
            <div class="md-card-arrow"><i class="bi bi-arrow-right"></i></div>
        </a>

    </div>
</div>
@endsection
