@extends('admin.layouts.app')

@section('title', 'Detail Permohonan')

@push('styles')
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
        --gray-50:        #f8fafc;
        --gray-100:       #f1f5f9;
        --gray-200:       #e2e8f0;
        --gray-300:       #cbd5e1;
        --gray-400:       #94a3b8;
        --gray-500:       #64748b;
        --gray-600:       #475569;
        --gray-700:       #334155;
        --gray-800:       #1e293b;
        --gray-900:       #0f172a;
        --white:          #ffffff;
        --radius-sm:      8px;
        --radius-md:      12px;
        --radius-lg:      16px;
        --shadow-sm:      0 1px 3px rgba(0,0,0,.08), 0 1px 2px rgba(0,0,0,.04);
        --shadow-md:      0 4px 16px rgba(0,0,0,.08), 0 2px 6px rgba(0,0,0,.04);
    }

    * { box-sizing: border-box; }
    body { background: var(--gray-50); font-family: 'Plus Jakarta Sans', sans-serif; }

    /* ── WRAPPER ── */
    .detail-page { max-width: 1180px; margin: 0 auto; padding: 28px 24px 64px; }

    /* ── BREADCRUMB / BACK ── */
    .back-bar {
        display: flex; align-items: center; gap: 8px;
        margin-bottom: 22px;
    }
    .back-btn {
        display: inline-flex; align-items: center; gap: 6px;
        font-size: 13px; font-weight: 600; color: var(--gray-500);
        text-decoration: none; transition: color .15s;
        padding: 6px 12px; border-radius: var(--radius-sm);
        border: 1px solid var(--gray-200); background: var(--white);
        box-shadow: var(--shadow-sm);
    }
    .back-btn:hover { color: var(--primary); border-color: var(--primary-light); background: var(--primary-light); }
    .back-btn svg { width: 14px; height: 14px; }
    .breadcrumb-sep { color: var(--gray-300); font-size: 12px; }
    .breadcrumb-cur { font-size: 13px; font-weight: 600; color: var(--gray-700); }

    /* ── HERO HEADER ── */
    .detail-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 60%, #3b82f6 100%);
        border-radius: var(--radius-lg);
        padding: 28px 32px;
        margin-bottom: 24px;
        position: relative; overflow: hidden;
        box-shadow: 0 8px 32px rgba(37,99,235,.25);
        display: flex; align-items: center; justify-content: space-between; gap: 16px; flex-wrap: wrap;
    }
    .detail-hero::before {
        content: '';
        position: absolute; inset: 0;
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
    .detail-hero-left h2 { font-size: 22px; font-weight: 800; color: #fff; margin: 0 0 5px; letter-spacing: -.3px; }
    .detail-hero-left p  { font-size: 13px; color: rgba(255,255,255,.7); margin: 0; }
    .detail-hero-right { position: relative; z-index: 1; display: flex; align-items: center; gap: 10px; flex-wrap: wrap; }

    /* ── STATUS PILL ── */
    .pill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 6px 16px; border-radius: 20px;
        font-size: 12px; font-weight: 700; letter-spacing: .04em;
    }
    .pill-dot { width: 7px; height: 7px; border-radius: 50%; }
    .pill-pending  { background: var(--warning-light);  color: #92400e; }
    .pill-pending .pill-dot  { background: var(--warning); animation: pulse-warn 1.5s infinite; }
    .pill-approved { background: var(--success-light);  color: #064e3b; }
    .pill-approved .pill-dot { background: var(--success); }
    .pill-rejected { background: var(--danger-light);   color: #7f1d1d; }
    .pill-rejected .pill-dot { background: var(--danger); }
    @keyframes pulse-warn {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: .6; transform: scale(1.3); }
    }

    /* ── PRINT BUTTON ── */
    .btn-print-main {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 9px 20px; border-radius: var(--radius-sm);
        font-size: 13px; font-weight: 700;
        background: rgba(255,255,255,.15); backdrop-filter: blur(8px);
        border: 1.5px solid rgba(255,255,255,.3);
        color: #fff; cursor: pointer; transition: all .15s;
        text-decoration: none; font-family: inherit;
    }
    .btn-print-main:hover { background: rgba(255,255,255,.25); border-color: rgba(255,255,255,.5); }
    .btn-print-main svg { width: 15px; height: 15px; }

    /* ── GRID LAYOUT ── */
    .detail-grid {
        display: grid; grid-template-columns: 1fr 300px;
        gap: 20px; align-items: start;
    }

    /* ── SECTION CARD ── */
    .section-card {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
        margin-bottom: 20px;
    }
    .section-card:last-child { margin-bottom: 0; }
    .section-head {
        padding: 14px 20px;
        border-bottom: 1px solid var(--gray-100);
        background: var(--gray-50);
        display: flex; align-items: center; gap: 10px;
    }
    .section-head-icon {
        width: 32px; height: 32px; border-radius: var(--radius-sm);
        display: grid; place-items: center; flex-shrink: 0;
    }
    .section-head-icon svg { width: 15px; height: 15px; }
    .section-head-icon.blue   { background: var(--primary-light);  color: var(--primary); }
    .section-head-icon.green  { background: var(--success-light);  color: var(--success); }
    .section-head-icon.purple { background: var(--purple-light);   color: var(--purple); }
    .section-head-icon.orange { background: var(--warning-light);  color: var(--warning); }
    .section-head h3 { font-size: 13px; font-weight: 700; color: var(--gray-700); margin: 0; }
    .section-body { padding: 20px; }

    /* ── FIELDS ── */
    .field-grid  { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; margin-bottom: 20px; }
    .field-grid.one { grid-template-columns: 1fr; }
    .field-grid:last-child { margin-bottom: 0; }
    .field label { display: block; font-size: 10.5px; font-weight: 700; text-transform: uppercase; letter-spacing: .09em; color: var(--gray-400); margin-bottom: 5px; }
    .field span  { font-size: 14px; color: var(--gray-800); font-weight: 500; line-height: 1.5; }
    .field span.mono { font-family: 'DM Mono', monospace; font-size: 13px; }

    /* ── DOC PREVIEW ── */
    .doc-row {
        display: flex; align-items: center; gap: 14px;
        background: var(--gray-50); border: 1px solid var(--gray-200);
        border-radius: var(--radius-md); padding: 14px 16px;
    }
    .doc-icon {
        width: 42px; height: 42px; background: #fee2e2;
        border-radius: var(--radius-sm); display: grid; place-items: center; flex-shrink: 0;
    }
    .doc-icon svg { width: 22px; height: 22px; color: var(--danger); }
    .doc-info { flex: 1; }
    .doc-info strong { display: block; font-size: 13px; font-weight: 700; color: var(--gray-800); }
    .doc-info small  { font-size: 11px; color: var(--gray-400); }
    .btn-view {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 7px 14px; border-radius: var(--radius-sm);
        font-size: 12px; font-weight: 700;
        background: var(--primary-light); color: var(--primary);
        text-decoration: none; transition: background .15s; white-space: nowrap;
    }
    .btn-view:hover { background: #bfdbfe; }
    .btn-view svg { width: 13px; height: 13px; }

    /* ── SIDEBAR ACTION CARD ── */
    .action-card {
        background: var(--white); border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg); padding: 20px;
        box-shadow: var(--shadow-sm); margin-bottom: 20px;
    }
    .action-card h4 { font-size: 13px; font-weight: 700; color: var(--gray-700); margin: 0 0 16px; }
    .btn-full {
        display: flex; align-items: center; justify-content: center; gap: 8px;
        width: 100%; padding: 12px; border-radius: var(--radius-sm);
        font-size: 13px; font-weight: 700; cursor: pointer;
        border: none; transition: all .15s; margin-bottom: 10px;
        font-family: inherit;
    }
    .btn-full:last-child { margin-bottom: 0; }
    .btn-full svg { width: 15px; height: 15px; }
    .btn-approve-full { background: var(--success-light); color: #047857; }
    .btn-approve-full:hover { background: #a7f3d0; }
    .btn-reject-full  { background: var(--danger-light); color: #b91c1c; }
    .btn-reject-full:hover  { background: #fecaca; }
    .btn-print-full   { background: var(--purple-light); color: var(--purple); text-decoration: none; display: flex; }
    .btn-print-full:hover   { background: #ddd6fe; }
    .action-done {
        text-align: center; padding: 16px;
        background: var(--gray-50); border-radius: var(--radius-sm);
        border: 1px dashed var(--gray-200);
    }
    .action-done p { font-size: 12px; color: var(--gray-400); margin: 0 0 6px; }
    .action-done strong { font-size: 13px; font-weight: 700; }

    /* ── TIMELINE ── */
    .timeline { list-style: none; padding: 0; margin: 0; }
    .tl-item { display: flex; gap: 12px; padding-bottom: 20px; position: relative; }
    .tl-item:last-child { padding-bottom: 0; }
    .tl-item:not(:last-child)::before {
        content: ''; position: absolute;
        left: 14px; top: 30px; bottom: 0; width: 2px;
        background: linear-gradient(to bottom, var(--gray-200), transparent);
    }
    .tl-dot {
        width: 30px; height: 30px; border-radius: 50%;
        display: grid; place-items: center; flex-shrink: 0; margin-top: 2px;
        position: relative; z-index: 1;
    }
    .tl-dot svg { width: 13px; height: 13px; }
    .tl-dot.blue     { background: var(--primary-light);  color: var(--primary); }
    .tl-dot.pending  { background: var(--warning-light);  color: var(--warning); }
    .tl-dot.approved { background: var(--success-light);  color: var(--success); }
    .tl-dot.rejected { background: var(--danger-light);   color: var(--danger); }
    .tl-body p     { font-size: 13px; font-weight: 700; color: var(--gray-800); margin: 0 0 3px; }
    .tl-body small { font-size: 11px; color: var(--gray-400); font-family: 'DM Mono', monospace; }

    /* ── PRINT STYLES ── */
    @media print {
        .no-print, header, footer, .back-bar, .detail-hero-right, .action-card, .btn-print-main { display: none !important; }
        body { background: #fff !important; }
        .detail-page { padding: 0; max-width: 100%; }
        .detail-grid { grid-template-columns: 1fr !important; }
        .detail-hero { background: #1e3a8a !important; -webkit-print-color-adjust: exact; color-adjust: exact; }
        .section-card { box-shadow: none !important; border: 1px solid #e2e8f0 !important; }
        .print-only { display: block !important; }
        @page { margin: 15mm; }
    }

    .print-only { display: none; }

    @media (max-width: 900px) {
        .detail-grid { grid-template-columns: 1fr; }
        .field-grid   { grid-template-columns: 1fr; }
    }
</style>
@endpush

@section('content')

{{-- NAVBAR --}}
@include('admin.partials.header')

<div class="detail-page">

    <!-- BACK BAR -->
    <div class="back-bar no-print">
        <a href="{{ route('permohonan.index') }}" class="back-btn">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                <polyline points="15 18 9 12 15 6"/>
            </svg>
            Kembali
        </a>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-cur">Data Permohonan</span>
        <span class="breadcrumb-sep">/</span>
        <span class="breadcrumb-cur">Detail #{{ $data->id_permohonan }}</span>
    </div>

    @php $status = optional($data->approval)->status ?? 'pending'; @endphp

    <!-- HERO HEADER -->
    <div class="detail-hero">
        <div class="detail-hero-left">
            <div class="id-badge">ID #{{ $data->id_permohonan }}</div>
            <h2>{{ $data->jenisSurat->nama_surat ?? 'Permohonan Surat' }}</h2>
            <p>
                Diajukan oleh <strong style="color:#fff">{{ $data->nama_pemohon ?? $data->user->nama ?? '-' }}</strong>
                &middot; {{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->format('d M Y') }}
            </p>
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
            <button onclick="printSurat()" class="btn-print-main no-print">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="6 9 6 2 18 2 18 9"/>
                    <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                    <rect x="6" y="14" width="12" height="8"/>
                </svg>
                Cetak Surat
            </button>
            @endif
        </div>
    </div>

    <!-- PRINT HEADER (only visible on print) -->
    <div class="print-only" style="text-align:center; margin-bottom:24px; border-bottom:3px double #1e3a8a; padding-bottom:16px;">
        <h2 style="margin:0; font-size:18px; font-weight:800; color:#1e3a8a; font-family:'Plus Jakarta Sans',sans-serif;">PEMERINTAH KELURAHAN TERITIH</h2>
        <p style="margin:4px 0 0; font-size:12px; color:#475569;">Jl. Raya Teritih No. 123, Kota Serang, Banten 42119</p>
        <p style="margin:2px 0 0; font-size:11px; color:#64748b;">Telp. (0254) 123-456 | support@kelurahan-teritih.go.id</p>
        <div style="margin-top:12px; background:#1e3a8a; color:#fff; display:inline-block; padding:6px 24px; border-radius:4px; font-size:14px; font-weight:700; letter-spacing:.05em;">BUKTI PERMOHONAN SURAT</div>
    </div>

    <div class="detail-grid">

        <!-- KIRI -->
        <div>

            <!-- DATA PEMOHON -->
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3>Data Pemohon</h3>
                </div>
                <div class="section-body">
                    @php
                        $isPerwakilan = !empty($data->nama_pemohon) && $data->nama_pemohon !== $data->user->nama;
                    @endphp
                    @if($isPerwakilan)
                    <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:10px 14px;margin-bottom:14px;font-size:12px;color:#92400e;display:flex;align-items:center;gap:8px">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
                        Permohonan ini diajukan oleh <strong>{{ $data->user->nama }}</strong> mewakili orang lain.
                    </div>
                    @endif
                    <div class="field-grid">
                        <div class="field">
                            <label>Nama Lengkap Pemohon</label>
                            <span>{{ $data->nama_pemohon ?? $data->user->nama ?? '-' }}</span>
                        </div>
                        <div class="field">
                            <label>NIK Pemohon</label>
                            <span class="mono">{{ $data->nik_pemohon ?? $data->user->nik ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="field-grid one">
                        <div class="field">
                            <label>Alamat Pemohon</label>
                            <span>{{ $data->alamat_pemohon ?? $data->user->alamat ?? '-' }}</span>
                        </div>
                    </div>
                    <div class="field-grid" style="margin-bottom:0">
                        <div class="field">
                            <label>No. HP (Pengaju)</label>
                            <span class="mono">{{ $data->user->no_hp ?? $data->user->no_telp ?? '-' }}</span>
                        </div>
                        <div class="field">
                            <label>Email (Pengaju)</label>
                            <span>{{ $data->user->email ?? '-' }}</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- DETAIL PERMOHONAN -->
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                        </svg>
                    </div>
                    <h3>Detail Permohonan</h3>
                </div>
                <div class="section-body">
                    <div class="field-grid">
                        <div class="field">
                            <label>Jenis Surat</label>
                            <span>{{ $data->jenisSurat->nama_surat ?? '-' }}</span>
                        </div>
                        <div class="field">
                            <label>Tanggal Pengajuan</label>
                            <span class="mono">{{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->format('d M Y') }}</span>
                        </div>
                    </div>
                    <div class="field-grid one" style="{{ $data->keterangan ? '' : 'margin-bottom:0' }}">
                        <div class="field">
                            <label>Keperluan / Tujuan Surat</label>
                            <span>{{ $data->keperluan ?? '-' }}</span>
                        </div>
                    </div>
                    @if($data->keterangan)
                    <div class="field-grid one" style="margin-bottom:0">
                        <div class="field">
                            <label>Keterangan Tambahan</label>
                            <span>{{ $data->keterangan }}</span>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <!-- DOKUMEN PERSYARATAN -->
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon purple">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                        </svg>
                    </div>
                    <h3>Dokumen Persyaratan</h3>
                    @if($data->persyaratan && $data->persyaratan->count())
                        <span style="margin-left:auto;font-size:11px;font-weight:600;background:var(--primary-light);color:var(--primary);border-radius:20px;padding:2px 10px;">
                            {{ $data->persyaratan->count() }} file
                        </span>
                    @endif
                </div>
                <div class="section-body" style="padding:0">
                    @forelse($data->persyaratan ?? [] as $dok)
                    @php
                        $ext  = strtolower(pathinfo($dok->nama_file ?? '', PATHINFO_EXTENSION));
                        $isPdf = $ext === 'pdf';
                        $isImg = in_array($ext, ['jpg','jpeg','png','gif','webp']);
                    @endphp
                    <div class="doc-row" style="border-radius:0;border:none;border-bottom:1px solid var(--gray-100);margin:0;gap:12px;padding:14px 20px;">
                        <div class="doc-icon" style="{{ $isPdf ? 'background:#fee2e2' : 'background:var(--primary-light)' }}">
                            @if($isPdf)
                            <svg viewBox="0 0 24 24" fill="currentColor" style="color:#dc2626">
                                <path d="M7 18H17V16H7v2zm0-4h10v-2H7v2zm-2 8a2 2 0 01-2-2V4a2 2 0 012-2h8l6 6v14a2 2 0 01-2 2H5z"/>
                            </svg>
                            @elseif($isImg)
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--primary)">
                                <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
                                <polyline points="21 15 16 10 5 21"/>
                            </svg>
                            @else
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="color:var(--primary)">
                                <path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/><polyline points="13 2 13 9 20 9"/>
                            </svg>
                            @endif
                        </div>
                        <div class="doc-info" style="flex:1;min-width:0">
                            <strong style="display:block;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">{{ $dok->nama_file }}</strong>
                            <small>{{ strtoupper($ext) }} · Diunggah {{ $dok->uploaded_at ? \Carbon\Carbon::parse($dok->uploaded_at)->format('d M Y, H:i') : '-' }}</small>
                        </div>
                        <a href="{{ asset('storage/' . $dok->path_file) }}" target="_blank" class="btn-view no-print">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                            </svg>
                            Lihat
                        </a>
                    </div>
                    @empty
                    <div style="padding:24px;text-align:center;color:var(--gray-400);font-size:13px;">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:32px;height:32px;margin:0 auto 8px;display:block;color:var(--gray-200)">
                            <path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/><polyline points="13 2 13 9 20 9"/>
                        </svg>
                        Tidak ada dokumen yang dilampirkan
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- TANDA TANGAN (tampil di layar dan saat print) -->
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon green">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"/>
                        </svg>
                    </div>
                    <h3>Tanda Tangan Pejabat</h3>
                </div>
                <div class="section-body">
                    <div style="display:flex; justify-content:flex-end;">
                        <div style="text-align:center; width:220px;">
                            <p style="margin:0 0 4px; font-size:13px; color:var(--gray-600);">Mengetahui,</p>
                            <p style="margin:0 0 12px; font-size:13px; font-weight:700; color:var(--gray-800);">Lurah Teritih</p>

                            {{-- Tampilkan TTD jika file ada --}}
                            @if(file_exists(public_path('storage/ttd/ttd_lurah.png')))
                                <img src="{{ asset('storage/ttd/ttd_lurah.png') }}"
                                     alt="TTD Lurah"
                                     style="height:80px; object-fit:contain; margin-bottom:4px;">
                            @else
                                <div style="height:80px; display:flex; align-items:center; justify-content:center;">
                                    <span style="font-size:11px; color:var(--gray-300); font-style:italic;">[ Tanda Tangan ]</span>
                                </div>
                            @endif

                            <div style="border-top:1.5px solid var(--gray-800); padding-top:8px; margin-top:4px;">
                                <p style="margin:0; font-size:13px; font-weight:700; color:var(--gray-900);">Hidayatullah, S.E.</p>
                                <p style="margin:4px 0 0; font-size:11px; color:var(--gray-400);">NIP. ____________________</p>
                            </div>
                        </div>
                    </div>

                    {{-- Upload TTD (hanya tampil untuk admin, tidak di-print) --}}
                    <div class="no-print" style="margin-top:16px; padding-top:16px; border-top:1px dashed var(--gray-200);">
                        <p style="font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.07em; color:var(--gray-400); margin:0 0 10px;">
                            Kelola Tanda Tangan
                        </p>
                        <form action="{{ route('admin.upload-ttd') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            {{-- File picker --}}
                            <label id="ttd-label" onclick="document.getElementById('ttd-input').click()"
                                   style="display:inline-flex; align-items:center; gap:8px; padding:8px 16px;
                                          background:var(--gray-50); border:1.5px solid var(--gray-200);
                                          border-radius:8px; font-size:12px; font-weight:600; color:var(--gray-600);
                                          cursor:pointer; transition:all .15s; margin-bottom:8px; width:100%;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;flex-shrink:0">
                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                                </svg>
                                <span id="ttd-label-text">Pilih File TTD (PNG/JPG)</span>
                            </label>
                            <input type="file" id="ttd-input" name="ttd" accept="image/png,image/jpeg" style="display:none"
                                   onchange="onTtdSelected(this)">

                            {{-- Preview file terpilih --}}
                            <div id="ttd-selected-info" style="display:none; align-items:center; gap:10px;
                                 background:#f0fdf4; border:1.5px solid #86efac; border-radius:8px;
                                 padding:8px 14px; margin-bottom:10px;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="#16a34a" stroke-width="2.5" style="width:16px;height:16px;flex-shrink:0">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                <div style="flex:1; min-width:0;">
                                    <p style="margin:0; font-size:12px; font-weight:700; color:#15803d;">File terpilih:</p>
                                    <p id="ttd-filename" style="margin:2px 0 0; font-size:12px; color:#166534; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;"></p>
                                </div>
                                <img id="ttd-preview" src="" alt="preview"
                                     style="width:40px; height:40px; object-fit:contain; border:1px solid #bbf7d0; border-radius:6px; background:#fff;">
                            </div>

                            <button type="submit" id="ttd-submit-btn"
                                    style="width:100%; padding:9px; background:var(--primary-light); color:var(--primary);
                                           border:none; border-radius:8px; font-size:12px; font-weight:700;
                                           cursor:pointer; font-family:inherit; display:flex; align-items:center;
                                           justify-content:center; gap:6px; transition:background .15s;">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px">
                                    <path d="M21 15v4a2 2 0 01-2 2H5a2 2 0 01-2-2v-4"/><polyline points="17 8 12 3 7 8"/><line x1="12" y1="3" x2="12" y2="15"/>
                                </svg>
                                Upload TTD
                            </button>
                        </form>
                        <p style="font-size:11px; color:var(--gray-400); margin:8px 0 0;">
                            Gunakan PNG transparan agar tanda tangan terlihat bersih saat dicetak.
                        </p>
                    </div>
                </div>
            </div>

        </div><!-- /kiri -->

        <!-- KANAN (SIDEBAR) -->
        <div class="no-print">

            <!-- AKSI -->
            <div class="action-card">
                <h4>
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px;display:inline;vertical-align:-2px;margin-right:4px;color:var(--primary)">
                        <path d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    Tindakan
                </h4>

                @if($status === 'pending')
                    <form action="{{ route('permohonan.approve', $data->id_permohonan) }}" method="POST" style="margin-bottom:10px;">
                        @csrf @method('PUT')
                        <button type="submit" class="btn-full btn-approve-full"
                                onclick="return confirm('Setujui permohonan ini?')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                            Setujui Permohonan
                        </button>
                    </form>
                    <form action="{{ route('permohonan.reject', $data->id_permohonan) }}" method="POST">
                        @csrf @method('PUT')
                        <button type="submit" class="btn-full btn-reject-full"
                                onclick="return confirm('Tolak permohonan ini?')">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                            </svg>
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
                    <div style="margin-top:12px;">
                        <button onclick="printSurat()" class="btn-full btn-print-full" style="margin-bottom:0; border:none; cursor:pointer; font-family:inherit;">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <polyline points="6 9 6 2 18 2 18 9"/>
                                <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                                <rect x="6" y="14" width="12" height="8"/>
                            </svg>
                            Cetak / Print Surat
                        </button>
                    </div>
                    @endif
                @endif
            </div>

            <!-- TIMELINE -->
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon orange">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                        </svg>
                    </div>
                    <h3>Riwayat Status</h3>
                </div>
                <div class="section-body">
                    <ul class="timeline">
                        <li class="tl-item">
                            <div class="tl-dot blue">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
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
                                <p>{{ $data->approval->status === 'disetujui' ? 'Permohonan Disetujui' : 'Permohonan Ditolak' }}</p>
                                <small>{{ \Carbon\Carbon::parse($data->approval->tanggal_approval)->format('d M Y, H:i') }} WIB</small>
                            </div>
                        </li>
                        @else
                        <li class="tl-item">
                            <div class="tl-dot pending">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                                </svg>
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

            <!-- INFO RINGKAS -->
            <div class="section-card" style="margin-top:0">
                <div class="section-head">
                    <div class="section-head-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                    </div>
                    <h3>Ringkasan</h3>
                </div>
                <div class="section-body">
                    <div class="field" style="margin-bottom:14px">
                        <label>Nama Pemohon</label>
                        <span>{{ $data->nama_pemohon ?? $data->user->nama ?? '-' }}</span>
                    </div>
                    <div class="field" style="margin-bottom:14px">
                        <label>No. HP</label>
                        @php $noHp = $data->user->no_hp ?? $data->user->no_telp ?? null; @endphp
                        @if($noHp && $noHp !== '-')
                            <span class="mono">{{ $noHp }}</span>
                        @else
                            <span style="font-size:13px; color:var(--gray-300); font-style:italic;">Belum diisi</span>
                        @endif
                    </div>
                    <div class="field">
                        <label>Email</label>
                        <span style="font-size:13px; word-break:break-all;">{{ $data->user->email ?? '-' }}</span>
                    </div>
                </div>
            </div>

        </div><!-- /kanan -->

    </div><!-- /detail-grid -->

</div><!-- /detail-page -->

<script>
function printSurat() {
    window.print();
}

// Auto-trigger print if ?print=1 in URL
const urlParams = new URLSearchParams(window.location.search);
if (urlParams.get('print') === '1') {
    window.addEventListener('load', function() {
        setTimeout(function() { window.print(); }, 500);
    });
}

// TTD file picker feedback
function onTtdSelected(input) {
    const file = input.files[0];
    if (!file) return;

    const info     = document.getElementById('ttd-selected-info');
    const filename = document.getElementById('ttd-filename');
    const preview  = document.getElementById('ttd-preview');
    const label    = document.getElementById('ttd-label');

    // Tampilkan nama file
    filename.textContent = file.name;
    info.style.display = 'flex';

    // Preview thumbnail
    const reader = new FileReader();
    reader.onload = e => { preview.src = e.target.result; };
    reader.readAsDataURL(file);

    // Ubah label jadi hijau tanda sudah dipilih
    label.style.background    = '#f0fdf4';
    label.style.borderColor   = '#86efac';
    label.style.color         = '#15803d';
    document.getElementById('ttd-label-text').textContent = 'Ganti File TTD';
}
</script>

{{-- FOOTER --}}
@include('admin.partials.footer')

@endsection