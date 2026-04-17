@extends('admin.layouts.app')

@section('title', 'Detail Permohonan')

@push('styles')
<link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&family=DM+Mono:wght@400;500&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<style>
    :root {
        --primary:        #2563eb;
        --primary-light:  #dbeafe;
        --primary-dark:   #1d4ed8;
        --success:        #059669;
        --success-light:  #d1fae5;
        --warning:        #d97706;
        --warning-light:  #fef3c7;
        --danger:         #dc2626;
        --danger-light:   #fee2e2;
        --purple:         #7c3aed;
        --purple-light:   #ede9fe;
        --gray-50:  #f8fafc; --gray-100: #f1f5f9; --gray-200: #e2e8f0;
        --gray-300: #cbd5e1; --gray-400: #94a3b8; --gray-500: #64748b;
        --gray-600: #475569; --gray-700: #334155; --gray-800: #1e293b; --gray-900: #0f172a;
        --white: #ffffff;
        --radius-sm: 8px; --radius-md: 12px; --radius-lg: 16px;
        --shadow-sm: 0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.04);
        --shadow-md: 0 4px 16px rgba(0,0,0,.08), 0 2px 6px rgba(0,0,0,.04);
    }
    * { box-sizing: border-box; }
    body { background: var(--gray-50); font-family: 'Plus Jakarta Sans', sans-serif; }

    .detail-page { max-width: 1180px; margin: 0 auto; padding: 28px 24px 64px; }

    .back-bar { display: flex; align-items: center; gap: 8px; margin-bottom: 22px; }
    .back-btn {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 13px; font-weight: 600; color: var(--gray-500);
        text-decoration: none; padding: 6px 12px; border-radius: var(--radius-sm);
        border: 1px solid var(--gray-200); background: var(--white);
        box-shadow: var(--shadow-sm); transition: all .15s;
    }
    .back-btn:hover { color: var(--primary); border-color: var(--primary-light); background: var(--primary-light); }
    .back-btn svg { width: 14px; height: 14px; }
    .breadcrumb-sep { color: var(--gray-300); font-size: 12px; }
    .breadcrumb-cur { font-size: 13px; font-weight: 600; color: var(--gray-700); }

    /* HERO */
    .detail-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 60%, #3b82f6 100%);
        border-radius: var(--radius-lg); padding: 28px 32px; margin-bottom: 24px;
        position: relative; overflow: hidden;
        box-shadow: 0 8px 32px rgba(37,99,235,.25);
        display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;
    }
    .detail-hero::before {
        content:''; position:absolute; inset:0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .detail-hero-left { position: relative; z-index: 1; }
    .detail-hero-left .id-badge {
        display: inline-block; background: rgba(255,255,255,.15);
        border: 1px solid rgba(255,255,255,.25);
        padding: 3px 10px; border-radius: 20px;
        font-size: 11px; font-weight: 700; color: rgba(255,255,255,.85);
        font-family: 'DM Mono', monospace; margin-bottom: 8px; letter-spacing: .05em;
    }
    .detail-hero-left h2 { font-size: 22px; font-weight: 800; color: #fff; margin: 0 0 5px; }
    .detail-hero-left p  { font-size: 13px; color: rgba(255,255,255,.7); margin: 0; }
    .detail-hero-right { position: relative; z-index: 1; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }

    .pill { display:inline-flex;align-items:center;gap:6px;padding:6px 16px;border-radius:20px;font-size:12px;font-weight:700;letter-spacing:.04em; }
    .pill-dot { width:7px;height:7px;border-radius:50%; }
    .pill-pending  { background:var(--warning-light);color:#92400e; } .pill-pending .pill-dot  { background:var(--warning);animation:pulse-warn 1.5s infinite; }
    .pill-approved { background:var(--success-light);color:#064e3b; } .pill-approved .pill-dot { background:var(--success); }
    .pill-rejected { background:var(--danger-light); color:#7f1d1d; } .pill-rejected .pill-dot { background:var(--danger); }
    @keyframes pulse-warn { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.6;transform:scale(1.3)} }

    .btn-print-main {
        display:inline-flex;align-items:center;gap:8px;padding:9px 20px;border-radius:var(--radius-sm);
        font-size:13px;font-weight:700;background:rgba(255,255,255,.15);backdrop-filter:blur(8px);
        border:1.5px solid rgba(255,255,255,.3);color:#fff;cursor:pointer;transition:all .15s;text-decoration:none;
    }
    .btn-print-main:hover { background:rgba(255,255,255,.25);color:white; }
    .btn-print-main svg { width:15px;height:15px; }

    /* GRID */
    .detail-grid { display:grid;grid-template-columns:1fr 300px;gap:20px;align-items:start; }

    /* SECTION CARD */
    .section-card { background:var(--white);border:1px solid var(--gray-200);border-radius:var(--radius-lg);overflow:hidden;box-shadow:var(--shadow-sm);margin-bottom:20px; }
    .section-card:last-child { margin-bottom:0; }
    .section-head { padding:14px 20px;border-bottom:1px solid var(--gray-100);background:var(--gray-50);display:flex;align-items:center;gap:10px; }
    .section-head-icon { width:32px;height:32px;border-radius:var(--radius-sm);display:grid;place-items:center;flex-shrink:0; }
    .section-head-icon svg { width:15px;height:15px; }
    .section-head-icon.blue   { background:var(--primary-light);color:var(--primary); }
    .section-head-icon.green  { background:var(--success-light);color:var(--success); }
    .section-head-icon.purple { background:var(--purple-light);color:var(--purple); }
    .section-head-icon.orange { background:var(--warning-light);color:var(--warning); }
    .section-head-icon.rose   { background:#fff1f2;color:#f43f5e; }
    .section-head-icon.amber  { background:#fffbeb;color:#d97706; }
    .section-head h3 { font-size:13px;font-weight:700;color:var(--gray-700);margin:0; }
    .section-body { padding:20px; }

    /* FIELDS */
    .fg { display:grid;grid-template-columns:repeat(4,1fr); }
    .fi { padding:12px 20px;border-bottom:1px solid #f3f4f6;border-right:1px solid #f3f4f6; }
    .fi:nth-child(4n) { border-right:none; }
    .fi.c2 { grid-column:span 2; }
    .fi.c3 { grid-column:span 3; }
    .fi.c4 { grid-column:span 4; }
    .fg .fi:nth-last-child(-n+4) { border-bottom:none; }
    .fl { font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--gray-400);margin-bottom:5px; }
    .fv { font-size:13.5px;color:var(--gray-800);font-weight:500;line-height:1.5; }
    .fv.mono { font-family:'DM Mono',monospace;font-size:13px; }

    /* DIFF TABLE (beda nama) */
    .diff-compare { display:grid;grid-template-columns:1fr 50px 1fr; }
    .dc-head { background:#f8fafc;padding:10px 20px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--gray-400);border-bottom:1px solid var(--gray-200); }
    .dc-val  { padding:14px 20px;font-size:14px;font-weight:700;color:var(--gray-900); }
    .dc-mid  { display:flex;align-items:center;justify-content:center;background:#f1f5f9;border-left:1px solid var(--gray-200);border-right:1px solid var(--gray-200); }
    .dc-mid.head { border-bottom:1px solid var(--gray-200); }
    .diff-note { padding:10px 20px;background:#fffbeb;border-top:1px solid #fde68a;font-size:12px;color:#92400e;display:flex;align-items:center;gap:8px; }

    /* DOC */
    .dok-item { display:flex;align-items:center;gap:14px;padding:14px 20px;border-bottom:1px solid var(--gray-100);text-decoration:none;color:var(--gray-700);transition:background .15s; }
    .dok-item:last-child { border-bottom:none; }
    .dok-item:hover { background:var(--gray-50); }
    .dok-icon { width:42px;height:42px;border-radius:var(--radius-sm);display:grid;place-items:center;flex-shrink:0; }
    .dok-icon svg { width:20px;height:20px; }
    .dok-info { flex:1;min-width:0; }
    .dok-info strong { display:block;font-size:13px;font-weight:700;color:var(--gray-900);overflow:hidden;text-overflow:ellipsis;white-space:nowrap; }
    .dok-info small  { font-size:11px;color:var(--gray-400); }
    .btn-view { display:inline-flex;align-items:center;gap:5px;padding:6px 13px;border-radius:var(--radius-sm);font-size:12px;font-weight:700;background:var(--primary-light);color:var(--primary);text-decoration:none;transition:all .15s;white-space:nowrap; }
    .btn-view:hover { background:#bfdbfe; }
    .btn-view svg { width:12px;height:12px; }

    /* SIDEBAR */
    .action-card { background:var(--white);border:1px solid var(--gray-200);border-radius:var(--radius-lg);padding:20px;box-shadow:var(--shadow-sm);margin-bottom:20px; }
    .action-card h4 { font-size:13px;font-weight:700;color:var(--gray-700);margin:0 0 16px; }
    .btn-full { display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:12px;border-radius:var(--radius-sm);font-size:13px;font-weight:700;cursor:pointer;border:none;transition:all .15s;margin-bottom:10px;font-family:inherit; }
    .btn-full:last-child { margin-bottom:0; }
    .btn-full svg { width:15px;height:15px; }
    .btn-approve-full { background:var(--success-light);color:#047857; } .btn-approve-full:hover { background:#a7f3d0; }
    .btn-reject-full  { background:var(--danger-light); color:#b91c1c; } .btn-reject-full:hover  { background:#fecaca; }
    .btn-print-full   { background:var(--purple-light); color:var(--purple);text-decoration:none;display:flex; } .btn-print-full:hover { background:#ddd6fe; }
    .action-done { text-align:center;padding:16px;background:var(--gray-50);border-radius:var(--radius-sm);border:1px dashed var(--gray-200); }
    .action-done p { font-size:12px;color:var(--gray-400);margin:0 0 6px; }

    /* TIMELINE */
    .timeline { list-style:none;padding:0;margin:0; }
    .tl-item { display:flex;gap:12px;padding-bottom:20px;position:relative; }
    .tl-item:last-child { padding-bottom:0; }
    .tl-item:not(:last-child)::before { content:'';position:absolute;left:14px;top:30px;bottom:0;width:2px;background:linear-gradient(to bottom,var(--gray-200),transparent); }
    .tl-dot { width:30px;height:30px;border-radius:50%;display:grid;place-items:center;flex-shrink:0;margin-top:2px;position:relative;z-index:1; }
    .tl-dot svg { width:13px;height:13px; }
    .tl-dot.blue     { background:var(--primary-light);color:var(--primary); }
    .tl-dot.pending  { background:var(--warning-light);color:var(--warning); }
    .tl-dot.approved { background:var(--success-light);color:var(--success); }
    .tl-dot.rejected { background:var(--danger-light); color:var(--danger); }
    .tl-body p     { font-size:13px;font-weight:700;color:var(--gray-800);margin:0 0 3px; }
    .tl-body small { font-size:11px;color:var(--gray-400);font-family:'DM Mono',monospace; }

    @media(max-width:900px){.detail-grid{grid-template-columns:1fr}.fg{grid-template-columns:1fr 1fr}.fi.c2,.fi.c3,.fi.c4{grid-column:span 2}}
</style>
@endpush

@section('content')
@include('admin.partials.header')

@php
    $status = optional($data->approval)->status ?? 'pending';
    $dtRaw  = $data->data_tambahan;
    if (is_array($dtRaw)) {
        $dt = $dtRaw;
    } elseif (is_string($dtRaw)) {
        $decoded = json_decode($dtRaw, true);
        $dt = is_string($decoded) ? json_decode($decoded, true) ?? [] : ($decoded ?? []);
    } else {
        $dt = [];
    }
    $jenis  = $dt['jenis'] ?? null;
    $tgl    = fn($t) => $t ? \Carbon\Carbon::parse($t)->isoFormat('D MMMM Y') : '-';
    $nama   = $data->nama_pemohon ?? $data->user->nama ?? '-';
    $nik    = $data->nik_pemohon  ?? $data->user->nik  ?? '-';
    $alamat = $data->alamat_pemohon ?? $data->user->alamat ?? '-';
@endphp

<div class="detail-page">

    <div class="back-bar">
        <a href="{{ route('permohonan.index') }}" class="back-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
            Kembali
        </a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-cur">Data Permohonan</span>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-cur">Detail #{{ $data->id_permohonan }}</span>
    </div>

    {{-- HERO --}}
    <div class="detail-hero">
        <div class="detail-hero-left">
            <div class="id-badge">ID #{{ $data->id_permohonan }}</div>
            <h2>{{ $data->jenisSurat->nama_surat ?? 'Permohonan Surat' }}</h2>
            <p>Diajukan oleh <strong style="color:#fff">{{ $nama }}</strong>
               &middot; {{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->format('d M Y') }}</p>
        </div>
        <div class="detail-hero-right">
            @if($status === 'disetujui')
                <span class="pill pill-approved"><span class="pill-dot"></span> Disetujui</span>
            @elseif($status === 'ditolak')
                <span class="pill pill-rejected"><span class="pill-dot"></span> Ditolak</span>
            @else
                <span class="pill pill-pending"><span class="pill-dot"></span> Menunggu Proses</span>
            @endif

            @if($status === 'disetujui')
            <a href="{{ route('permohonan.print', $data->id_permohonan) }}" target="_blank" class="btn-print-main">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 6 2 18 2 18 9"/>
                    <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                    <rect x="6" y="14" width="12" height="8"/>
                </svg>
                Cetak Surat
            </a>
            @endif
        </div>
    </div>

    <div class="detail-grid">

        {{-- ═══ KIRI ═══ --}}
        <div>

            {{-- DATA PEMOHON --}}
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3>Data Pemohon</h3>
                    @php $isPerwakilan = !empty($data->nama_pemohon) && $data->nama_pemohon !== $data->user->nama; @endphp
                    @if($isPerwakilan)
                    <span style="margin-left:auto;font-size:11px;font-weight:700;background:#fffbeb;color:#92400e;border:1px solid #fde68a;border-radius:20px;padding:2px 10px">PERWAKILAN</span>
                    @endif
                </div>
                <div class="fg">
                    <div class="fi c2">
                        <div class="fl">Nama Lengkap Pemohon</div>
                        <div class="fv" style="font-size:15px;font-weight:700">{{ $nama }}</div>
                    </div>
                    <div class="fi c2">
                        <div class="fl">NIK Pemohon</div>
                        <div class="fv mono" style="font-size:14px">{{ $nik }}</div>
                    </div>
                    @if(!empty($dt['tempat_lahir']))
                    <div class="fi">
                        <div class="fl">Tempat Lahir</div>
                        <div class="fv">{{ $dt['tempat_lahir'] }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Tanggal Lahir</div>
                        <div class="fv">{{ $tgl($dt['tanggal_lahir'] ?? null) }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Jenis Kelamin</div>
                        <div class="fv">{{ $dt['jenis_kelamin'] ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Agama</div>
                        <div class="fv">{{ $dt['agama'] ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Status Perkawinan</div>
                        <div class="fv">{{ $dt['status_kawin'] ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Pekerjaan</div>
                        <div class="fv">{{ $dt['pekerjaan'] ?? '-' }}</div>
                    </div>
                    @if(!empty($dt['rt']))
                    <div class="fi">
                        <div class="fl">RT / RW</div>
                        <div class="fv">RT {{ $dt['rt'] }} / RW {{ $dt['rw'] ?? '-' }}</div>
                    </div>
                    <div class="fi c3">
                        <div class="fl">Alamat Lengkap</div>
                        <div class="fv">{{ $alamat }}</div>
                    </div>
                    @else
                    <div class="fi c4">
                        <div class="fl">Alamat Lengkap</div>
                        <div class="fv">{{ $alamat }}</div>
                    </div>
                    @endif
                    @else
                    <div class="fi c4">
                        <div class="fl">Alamat Lengkap</div>
                        <div class="fv">{{ $alamat }}</div>
                    </div>
                    @endif
                    @if($isPerwakilan)
                    <div class="fi c2">
                        <div class="fl">Pengaju (Akun)</div>
                        <div class="fv">{{ $data->user->nama ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">No. HP Pengaju</div>
                        <div class="fv mono">{{ $data->user->no_hp ?? $data->user->no_telp ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Email Pengaju</div>
                        <div class="fv" style="font-size:13px;word-break:break-all">{{ $data->user->email ?? '-' }}</div>
                    </div>
                    @else
                    <div class="fi">
                        <div class="fl">No. HP</div>
                        <div class="fv mono">{{ $data->user->no_hp ?? $data->user->no_telp ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Email</div>
                        <div class="fv" style="font-size:13px;word-break:break-all">{{ $data->user->email ?? '-' }}</div>
                    </div>
                    @endif
                </div>
            </div>

            {{-- DATA KHUSUS PER JENIS SURAT --}}
            @if($jenis === 'sktm')
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon green"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                    <h3>Keperluan SKTM</h3>
                </div>
                <div class="fg">
                    <div class="fi c2">
                        <div class="fl">Tujuan / Keperluan</div>
                        <div class="fv">{{ $dt['keperluan_sktm'] ?? $data->keperluan ?? '-' }}</div>
                    </div>
                    <div class="fi c2">
                        <div class="fl">Keterangan Tambahan</div>
                        <div class="fv">{{ $dt['keterangan_tambahan'] ?? '-' }}</div>
                    </div>
                </div>
            </div>

            @elseif($jenis === 'kematian')
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon green"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                    <h3>Data Kematian</h3>
                </div>
                <div class="fg">
                    <div class="fi">
                        <div class="fl">Umur Saat Meninggal</div>
                        <div class="fv">{{ !empty($dt['umur']) ? $dt['umur'].' Tahun' : '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Hari Meninggal</div>
                        <div class="fv">{{ $dt['hari_meninggal'] ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Tanggal Meninggal</div>
                        <div class="fv">{{ $tgl($dt['tanggal_meninggal'] ?? null) }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Tempat Meninggal</div>
                        <div class="fv">{{ $dt['tempat_meninggal'] ?? '-' }}</div>
                    </div>
                    <div class="fi c2">
                        <div class="fl">Sebab Meninggal</div>
                        <div class="fv">{{ $dt['sebab_meninggal'] ?? '-' }}</div>
                    </div>
                    <div class="fi c2">
                        <div class="fl">Keperluan Surat</div>
                        <div class="fv">{{ $data->keperluan ?? '-' }}</div>
                    </div>
                </div>
            </div>

            @elseif($jenis === 'suami-istri')
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon rose"><i class="bi bi-people-fill" style="font-size:14px"></i></div>
                    <h3>Data Istri & Pernikahan</h3>
                </div>
                <div class="fg">
                    <div class="fi c2">
                        <div class="fl">Nama Lengkap Istri</div>
                        <div class="fv" style="font-weight:700">{{ $dt['nama_istri'] ?? '-' }}</div>
                    </div>
                    <div class="fi c2">
                        <div class="fl">NIK Istri</div>
                        <div class="fv mono">{{ $dt['nik_istri'] ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Tempat / Tgl Lahir Istri</div>
                        <div class="fv">{{ $dt['ttl_istri'] ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Agama Istri</div>
                        <div class="fv">{{ $dt['agama_istri'] ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Pekerjaan Istri</div>
                        <div class="fv">{{ $dt['pekerjaan_istri'] ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Tahun Menikah</div>
                        <div class="fv" style="font-weight:700">{{ $dt['tahun_menikah'] ?? '-' }}</div>
                    </div>
                    <div class="fi c4">
                        <div class="fl">Alamat Istri</div>
                        <div class="fv">{{ !empty($dt['alamat_istri']) ? $dt['alamat_istri'] : 'Sama dengan alamat suami' }}</div>
                    </div>
                </div>
            </div>

            @elseif($jenis === 'beda-nama')
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon amber"><i class="bi bi-arrow-left-right" style="font-size:14px"></i></div>
                    <h3>Detail Perbedaan Nama</h3>
                </div>
                <div class="diff-compare">
                    <div class="dc-head">Nama di KTP</div>
                    <div class="dc-mid head" style="font-size:11px;font-weight:700;color:var(--gray-400)">VS</div>
                    <div class="dc-head">Nama di {{ $dt['jenis_dokumen_2'] ?? 'Dokumen Lain' }}</div>
                    <div class="dc-val">{{ $dt['nama_dokumen_1'] ?? $nama }}</div>
                    <div class="dc-mid"><i class="bi bi-arrow-left-right" style="font-size:16px;color:var(--gray-300)"></i></div>
                    <div class="dc-val">{{ $dt['nama_dokumen_2'] ?? '-' }}</div>
                </div>
                <div class="diff-note">
                    <i class="bi bi-info-circle-fill" style="flex-shrink:0"></i>
                    Kedua nama di atas adalah satu orang yang sama.
                </div>
                <div class="fg" style="border-top:1px solid var(--gray-200)">
                    <div class="fi c2">
                        <div class="fl">Jenis Dokumen Pembanding</div>
                        <div class="fv">{{ $dt['jenis_dokumen_2'] ?? '-' }}</div>
                    </div>
                    <div class="fi c2">
                        <div class="fl">Keperluan Surat</div>
                        <div class="fv">{{ $data->keperluan ?? '-' }}</div>
                    </div>
                </div>
            </div>

            @elseif($jenis === 'izin-cuti')
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon blue"><i class="bi bi-calendar-check-fill" style="font-size:14px"></i></div>
                    <h3>Detail Izin Cuti</h3>
                </div>
                <div class="fg">
                    <div class="fi c2">
                        <div class="fl">Nama Perusahaan / Instansi</div>
                        <div class="fv" style="font-weight:700;font-size:15px">{{ $dt['nama_perusahaan'] ?? '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Lama Cuti</div>
                        <div class="fv">{{ !empty($dt['lama_cuti']) ? $dt['lama_cuti'].' Hari' : '-' }}</div>
                    </div>
                    <div class="fi">
                        <div class="fl">Keperluan / Alasan</div>
                        <div class="fv">{{ $data->keperluan ?? '-' }}</div>
                    </div>
                    <div class="fi c2">
                        <div class="fl">Tanggal Mulai Cuti</div>
                        <div class="fv" style="font-weight:700">{{ $tgl($dt['tanggal_mulai_cuti'] ?? null) }}</div>
                    </div>
                    <div class="fi c2">
                        <div class="fl">Tanggal Selesai Cuti</div>
                        <div class="fv" style="font-weight:700">{{ $tgl($dt['tanggal_selesai_cuti'] ?? null) }}</div>
                    </div>
                </div>
            </div>
            @endif

            {{-- KEPERLUAN UMUM (jika tidak ada jenis / permohonan lama) --}}
            @if(!in_array($jenis, ['sktm','kematian','suami-istri','beda-nama','izin-cuti']))
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon green"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
                    <h3>Detail Permohonan</h3>
                </div>
                <div class="fg">
                    <div class="fi c2">
                        <div class="fl">Jenis Surat</div>
                        <div class="fv">{{ $data->jenisSurat->nama_surat ?? '-' }}</div>
                    </div>
                    <div class="fi c2">
                        <div class="fl">Tanggal Pengajuan</div>
                        <div class="fv mono">{{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->isoFormat('D MMMM Y') }}</div>
                    </div>
                    <div class="fi c4">
                        <div class="fl">Keperluan / Tujuan Surat</div>
                        <div class="fv">{{ $data->keperluan ?? '-' }}</div>
                    </div>
                </div>
            </div>
            @endif

            {{-- DOKUMEN PERSYARATAN --}}
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/></svg>
                    </div>
                    <h3>Dokumen Persyaratan</h3>
                    @if($data->persyaratan && $data->persyaratan->count())
                    <span style="margin-left:auto;font-size:11px;font-weight:600;background:var(--primary-light);color:var(--primary);border-radius:20px;padding:2px 10px">{{ $data->persyaratan->count() }} file</span>
                    @endif
                </div>
                @forelse($data->persyaratan ?? [] as $dok)
                @php
                    $ext   = strtolower(pathinfo($dok->nama_file ?? '', PATHINFO_EXTENSION));
                    $isPdf = $ext === 'pdf';
                    $isImg = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                @endphp
                <a href="{{ asset('storage/'.$dok->path_file) }}" target="_blank" class="dok-item">
                    <div class="dok-icon" style="{{ $isPdf ? 'background:#fee2e2' : 'background:var(--primary-light)' }}">
                        @if($isPdf)
                        <svg viewBox="0 0 24 24" fill="currentColor" style="color:var(--danger)"><path d="M7 18H17V16H7v2zm0-4h10v-2H7v2zm-2 8a2 2 0 01-2-2V4a2 2 0 012-2h8l6 6v14a2 2 0 01-2 2H5z"/></svg>
                        @elseif($isImg)
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--primary)"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>
                        @else
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--primary)"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>
                        @endif
                    </div>
                    <div class="dok-info">
                        <strong>{{ $dok->nama_file }}</strong>
                        <small>{{ strtoupper($ext) }} · Diunggah {{ $dok->uploaded_at ? \Carbon\Carbon::parse($dok->uploaded_at)->format('d M Y, H:i') : '-' }}</small>
                    </div>
                    <span class="btn-view">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                        Lihat
                    </span>
                </a>
                @empty
                <div style="padding:28px;text-align:center;color:var(--gray-400);font-size:13px">
                    <i class="bi bi-paperclip" style="font-size:28px;display:block;margin-bottom:8px;color:var(--gray-200)"></i>
                    Tidak ada dokumen yang dilampirkan
                </div>
                @endforelse
            </div>

        </div>{{-- /kiri --}}

        {{-- ═══ SIDEBAR ═══ --}}
        <div>

            {{-- AKSI --}}
            <div class="action-card">
                <h4>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;display:inline;vertical-align:-2px;margin-right:4px;color:var(--primary)">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Tindakan
                </h4>

                @if($status === 'pending')
                <form action="{{ route('permohonan.approve', $data->id_permohonan) }}" method="POST" style="margin-bottom:10px">
                    @csrf @method('PUT')
                    <button type="submit" class="btn-full btn-approve-full" onclick="return confirm('Setujui permohonan ini?')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Setujui Permohonan
                    </button>
                </form>
                <form action="{{ route('permohonan.reject', $data->id_permohonan) }}" method="POST">
                    @csrf @method('PUT')
                    <button type="submit" class="btn-full btn-reject-full" onclick="return confirm('Tolak permohonan ini?')">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        Tolak Permohonan
                    </button>
                </form>

                @else
                <div class="action-done">
                    <p>Permohonan ini sudah diproses</p>
                    @if($status === 'disetujui')
                        <span class="pill pill-approved" style="display:inline-flex"><span class="pill-dot"></span> Disetujui</span>
                    @else
                        <span class="pill pill-rejected" style="display:inline-flex"><span class="pill-dot"></span> Ditolak</span>
                    @endif
                </div>

                @if($status === 'disetujui')
                <div style="margin-top:12px">
                    <a href="{{ route('permohonan.print', $data->id_permohonan) }}" target="_blank" class="btn-full btn-print-full" style="margin-bottom:0">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 6 2 18 2 18 9"/>
                            <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                            <rect x="6" y="14" width="12" height="8"/>
                        </svg>
                        Cetak / Print Surat Resmi
                    </a>
                </div>
                @endif
                @endif
            </div>

            {{-- INFO RINGKAS --}}
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                    </div>
                    <h3>Ringkasan</h3>
                </div>
                <div class="section-body" style="padding:16px 20px">
                    @php
                        $infoRows = [
                            'No. Permohonan' => '#'.$data->id_permohonan,
                            'Jenis Surat'    => $data->jenisSurat->nama_surat ?? '-',
                            'Tanggal'        => \Carbon\Carbon::parse($data->tanggal_pengajuan)->format('d M Y'),
                            'Dokumen'        => ($data->persyaratan ? $data->persyaratan->count() : 0).' file',
                            'No. HP'         => $data->user->no_hp ?? $data->user->no_telp ?? '-',
                            'Email'          => $data->user->email ?? '-',
                        ];
                    @endphp
                    @foreach($infoRows as $label => $val)
                    <div style="display:flex;justify-content:space-between;align-items:flex-start;padding:7px 0;border-bottom:1px solid #f3f4f6;gap:8px">
                        <span style="font-size:12px;color:var(--gray-400);flex-shrink:0">{{ $label }}</span>
                        <span style="font-size:12px;font-weight:700;color:var(--gray-800);text-align:right;word-break:break-all">{{ $val }}</span>
                    </div>
                    @endforeach
                </div>
            </div>

            {{-- TIMELINE --}}
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon orange">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                    </div>
                    <h3>Riwayat Status</h3>
                </div>
                <div class="section-body">
                    <ul class="timeline">
                        <li class="tl-item">
                            <div class="tl-dot blue">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
                            </div>
                            <div class="tl-body">
                                <p>Permohonan Diajukan</p>
                                <small>{{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->format('d M Y, H:i') }} WIB</small>
                            </div>
                        </li>
                        @if($data->approval)
                        <li class="tl-item">
                            <div class="tl-dot {{ $data->approval->status === 'disetujui' ? 'approved' : 'rejected' }}">
                                @if($data->approval->status === 'disetujui')
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                @else
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                @endif
                            </div>
                            <div class="tl-body">
                                <p>{{ $data->approval->status === 'disetujui' ? 'Permohonan Disetujui ✅' : 'Permohonan Ditolak ❌' }}</p>
                                <small>{{ \Carbon\Carbon::parse($data->approval->tanggal_approval)->format('d M Y, H:i') }} WIB</small>
                            </div>
                        </li>
                        @else
                        <li class="tl-item">
                            <div class="tl-dot pending">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
                            </div>
                            <div class="tl-body">
                                <p>Menunggu Proses Admin</p>
                                <small>Belum diproses</small>
                            </div>
                        </li>
                        @endif
                    </ul>
                </div>
            </div>

        </div>{{-- /sidebar --}}

    </div>

</div>

@include('admin.partials.footer')
@endsection