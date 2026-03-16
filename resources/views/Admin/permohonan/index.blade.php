@extends('admin.layouts.app')

@section('title', 'Data Permohonan')

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

    /* ── PAGE WRAPPER ── */
    .perm-page { max-width: 1280px; margin: 0 auto; padding: 32px 24px 48px; }

    /* ── PAGE HEADER ── */
    .page-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 60%, #3b82f6 100%);
        border-radius: var(--radius-lg);
        padding: 32px 36px;
        margin-bottom: 28px;
        position: relative;
        overflow: hidden;
        box-shadow: 0 8px 32px rgba(37,99,235,.3);
    }
    .page-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .page-hero-content { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; gap: 20px; flex-wrap: wrap; }
    .page-hero h1 { font-size: 26px; font-weight: 800; color: #fff; margin: 0 0 6px; letter-spacing: -.3px; }
    .page-hero p  { font-size: 14px; color: rgba(255,255,255,.75); margin: 0; }
    .hero-badge {
        display: inline-flex; align-items: center; gap: 6px;
        background: rgba(255,255,255,.15); backdrop-filter: blur(8px);
        border: 1px solid rgba(255,255,255,.25);
        padding: 6px 14px; border-radius: 20px;
        font-size: 12px; font-weight: 700; color: #fff; white-space: nowrap;
    }
    .hero-badge svg { width: 13px; height: 13px; }

    /* ── STATS GRID ── */
    .stats-grid {
        display: grid; grid-template-columns: repeat(4, 1fr);
        gap: 16px; margin-bottom: 24px;
    }
    .stat-card {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 20px;
        display: flex; align-items: center; gap: 16px;
        box-shadow: var(--shadow-sm);
        transition: transform .2s, box-shadow .2s;
        position: relative; overflow: hidden;
    }
    .stat-card::after {
        content: '';
        position: absolute; top: 0; left: 0; right: 0; height: 3px;
        border-radius: var(--radius-md) var(--radius-md) 0 0;
    }
    .stat-card.blue::after   { background: var(--primary); }
    .stat-card.yellow::after { background: var(--warning); }
    .stat-card.green::after  { background: var(--success); }
    .stat-card.red::after    { background: var(--danger); }
    .stat-card:hover { transform: translateY(-2px); box-shadow: var(--shadow-md); }
    .stat-icon {
        width: 48px; height: 48px; border-radius: var(--radius-sm);
        display: grid; place-items: center; flex-shrink: 0;
    }
    .stat-icon svg { width: 22px; height: 22px; }
    .stat-icon.blue   { background: var(--primary-light); color: var(--primary); }
    .stat-icon.yellow { background: var(--warning-light);  color: var(--warning); }
    .stat-icon.green  { background: var(--success-light);  color: var(--success); }
    .stat-icon.red    { background: var(--danger-light);   color: var(--danger); }
    .stat-info small  { font-size: 11px; font-weight: 700; text-transform: uppercase; letter-spacing: .08em; color: var(--gray-400); }
    .stat-info strong { font-size: 28px; font-weight: 800; color: var(--gray-900); display: block; line-height: 1.1; margin-top: 2px; font-family: 'DM Mono', monospace; }

    /* ── TOOLBAR ── */
    .toolbar {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-md);
        padding: 16px 20px;
        display: flex; align-items: center; gap: 12px;
        margin-bottom: 20px;
        box-shadow: var(--shadow-sm);
        flex-wrap: wrap;
    }
    .search-wrap { position: relative; }
    .search-wrap input {
        width: 280px; padding: 9px 12px 9px 38px;
        border: 1.5px solid var(--gray-200); border-radius: var(--radius-sm);
        font-size: 13px; color: var(--gray-700); background: var(--gray-50);
        outline: none; transition: all .15s; font-family: inherit;
    }
    .search-wrap input:focus { border-color: var(--primary); background: var(--white); box-shadow: 0 0 0 3px rgba(37,99,235,.1); }
    .search-wrap svg {
        position: absolute; left: 11px; top: 50%; transform: translateY(-50%);
        width: 15px; height: 15px; color: var(--gray-400); pointer-events: none;
    }
    .toolbar select {
        padding: 9px 36px 9px 12px;
        border: 1.5px solid var(--gray-200); border-radius: var(--radius-sm);
        font-size: 13px; color: var(--gray-700); background: var(--gray-50);
        outline: none; cursor: pointer; font-family: inherit;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2394a3b8' stroke-width='2.5'%3E%3Cpolyline points='6 9 12 15 18 9'/%3E%3C/svg%3E");
        background-repeat: no-repeat; background-position: right 10px center;
        transition: all .15s;
    }
    .toolbar select:focus { border-color: var(--primary); background-color: var(--white); box-shadow: 0 0 0 3px rgba(37,99,235,.1); }
    .toolbar-right { margin-left: auto; display: flex; align-items: center; gap: 8px; }
    .results-label { font-size: 12px; color: var(--gray-400); font-weight: 500; }

    /* ── TABLE CARD ── */
    .table-card {
        background: var(--white);
        border: 1px solid var(--gray-200);
        border-radius: var(--radius-lg);
        overflow: hidden;
        box-shadow: var(--shadow-sm);
    }
    table { width: 100%; border-collapse: collapse; }
    thead tr { background: var(--gray-50); }
    thead th {
        padding: 13px 18px;
        text-align: left; font-size: 10.5px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .1em;
        color: var(--gray-400); border-bottom: 1px solid var(--gray-200);
        white-space: nowrap;
    }
    tbody tr { border-bottom: 1px solid var(--gray-100); transition: background .1s; }
    tbody tr:last-child { border-bottom: none; }
    tbody tr:hover { background: #f8faff; }
    tbody td { padding: 15px 18px; font-size: 13px; color: var(--gray-700); vertical-align: middle; }

    .td-no {
        font-family: 'DM Mono', monospace;
        color: var(--gray-300); font-size: 12px; font-weight: 500;
    }
    .td-name { font-weight: 700; color: var(--gray-900); font-size: 13.5px; }
    .td-name small { display: block; font-size: 11px; font-weight: 400; color: var(--gray-400); margin-top: 2px; font-family: 'DM Mono', monospace; }
    .td-surat { font-weight: 600; color: var(--gray-800); }
    .td-date  { color: var(--gray-400); font-size: 12px; font-family: 'DM Mono', monospace; }

    /* ── PILL STATUS ── */
    .status-pill {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 4px 12px; border-radius: 20px;
        font-size: 11px; font-weight: 700; letter-spacing: .04em;
    }
    .status-dot { width: 6px; height: 6px; border-radius: 50%; flex-shrink: 0; }
    .status-pending  { background: #fef3c7; color: #92400e; }
    .status-pending .status-dot  { background: #d97706; animation: pulse-warn 1.5s infinite; }
    .status-approved { background: #d1fae5; color: #064e3b; }
    .status-approved .status-dot { background: #059669; }
    .status-rejected { background: #fee2e2; color: #7f1d1d; }
    .status-rejected .status-dot { background: #dc2626; }

    @keyframes pulse-warn {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: .6; transform: scale(1.3); }
    }

    /* ── ACTION BUTTONS ── */
    .action-group { display: flex; align-items: center; gap: 5px; flex-wrap: nowrap; }
    .btn-act {
        display: inline-flex; align-items: center; gap: 5px;
        padding: 6px 11px; border-radius: var(--radius-sm);
        font-size: 12px; font-weight: 700; cursor: pointer;
        border: none; transition: all .15s; text-decoration: none; white-space: nowrap;
        font-family: inherit;
    }
    .btn-act svg { width: 13px; height: 13px; flex-shrink: 0; }
    .btn-detail  { background: var(--primary-light); color: var(--primary); }
    .btn-detail:hover  { background: #bfdbfe; }
    .btn-approve { background: var(--success-light); color: #047857; }
    .btn-approve:hover { background: #a7f3d0; }
    .btn-reject  { background: var(--danger-light); color: #b91c1c; }
    .btn-reject:hover  { background: #fecaca; }
    .btn-print   { background: #f3e8ff; color: #7c3aed; }
    .btn-print:hover   { background: #ede9fe; }
    .btn-dok     { background: #f0f9ff; color: #0369a1; border: 1px solid #bae6fd; width:32px; height:32px; padding:0; justify-content:center; border-radius: var(--radius-sm); position: relative; }
    .btn-dok:hover { background: #e0f2fe; }
    .btn-dok::after {
        content: 'Dokumen Persyaratan';
        position: absolute; bottom: calc(100% + 6px); left: 50%; transform: translateX(-50%);
        background: #0f172a; color: white; font-size: 10px; font-weight: 600;
        padding: 3px 8px; border-radius: 5px; white-space: nowrap;
        opacity: 0; pointer-events: none; transition: opacity .15s;
    }
    .btn-dok:hover::after { opacity: 1; }

    /* ── ALERT ── */
    .alert-success {
        display: flex; align-items: center; gap: 12px;
        padding: 14px 18px; border-radius: var(--radius-md);
        margin-bottom: 20px;
        background: #ecfdf5; border: 1px solid #6ee7b7;
        font-size: 13px; color: #065f46; font-weight: 500;
        animation: slideDown .3s ease;
    }
    .alert-success svg { flex-shrink: 0; width: 18px; height: 18px; }

    /* ── EMPTY STATE ── */
    .empty-state { text-align: center; padding: 64px 20px; }
    .empty-icon { width: 64px; height: 64px; background: var(--gray-100); border-radius: 50%; display: grid; place-items: center; margin: 0 auto 16px; }
    .empty-icon svg { width: 28px; height: 28px; color: var(--gray-300); }
    .empty-state h3 { font-size: 15px; font-weight: 700; color: var(--gray-600); margin: 0 0 6px; }
    .empty-state p  { font-size: 13px; color: var(--gray-400); margin: 0; }

    @keyframes slideDown {
        from { opacity: 0; transform: translateY(-10px); }
        to   { opacity: 1; transform: translateY(0); }
    }

    @media (max-width: 900px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
    }
    @media (max-width: 600px) {
        .stats-grid { grid-template-columns: 1fr 1fr; }
        .page-hero { padding: 24px 20px; }
        .page-hero h1 { font-size: 20px; }
        .search-wrap input { width: 200px; }
    }
    .btn-dok { background:#f0f9ff; color:#0369a1; border:1px solid #bae6fd; }
    .btn-dok:hover { background:#e0f2fe; }
</style>
@endpush

@section('content')

@include('admin.partials.header')

<div class="perm-page">

    <!-- PAGE HERO -->
    <div class="page-hero">
        <div class="page-hero-content">
            <div>
                <h1>Data Permohonan Surat</h1>
                <p>Kelola dan proses semua permohonan surat dari masyarakat Kelurahan Teritih</p>
            </div>
            <div class="hero-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
                {{ \Carbon\Carbon::now()->format('d M Y') }}
            </div>
        </div>
    </div>

    @if(session('success'))
    <div class="alert-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
        </svg>
        {{ session('success') }}
    </div>
    @endif

    <!-- STATS -->
    <div class="stats-grid">
        <div class="stat-card blue">
            <div class="stat-icon blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <div class="stat-info">
                <small>Total Permohonan</small>
                <strong>{{ $data->count() }}</strong>
            </div>
        </div>
        <div class="stat-card yellow">
            <div class="stat-icon yellow">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/>
                </svg>
            </div>
            <div class="stat-info">
                <small>Menunggu Proses</small>
                <strong>{{ $data->filter(fn($d) => optional($d->approval)->status === null || optional($d->approval)->status === 'pending')->count() }}</strong>
            </div>
        </div>
        <div class="stat-card green">
            <div class="stat-icon green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="stat-info">
                <small>Disetujui</small>
                <strong>{{ $data->filter(fn($d) => optional($d->approval)->status === 'disetujui')->count() }}</strong>
            </div>
        </div>
        <div class="stat-card red">
            <div class="stat-icon red">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/>
                </svg>
            </div>
            <div class="stat-info">
                <small>Ditolak</small>
                <strong>{{ $data->filter(fn($d) => optional($d->approval)->status === 'ditolak')->count() }}</strong>
            </div>
        </div>
    </div>

    <!-- TOOLBAR -->
    <div class="toolbar">
        <div class="search-wrap">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
            </svg>
            <input type="text" id="searchInput" placeholder="Cari pemohon atau jenis surat…" oninput="filterTable()"/>
        </div>
        <select id="statusFilter" onchange="filterTable()">
            <option value="">Semua Status</option>
            <option value="pending">Pending</option>
            <option value="disetujui">Disetujui</option>
            <option value="ditolak">Ditolak</option>
        </select>
        <div class="toolbar-right">
            <span class="results-label" id="resultsCount"></span>
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-card">
        <table id="permohonanTable">
            <thead>
                <tr>
                    <th style="width:48px">No</th>
                    <th>Pemohon</th>
                    <th>Jenis Surat</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($data as $d)
                @php
                    $approvalStatus = optional($d->approval)->status;
                    $rowStatus = $approvalStatus ?? 'pending';
                    $persyaratan = $d->persyaratan ?? collect();
                    $namaPemohon = $d->nama_pemohon ?? $d->user->nama ?? '-';
                    $nikPemohon  = $d->nik_pemohon  ?? $d->user->nik  ?? '-';
                    $isWakil     = !empty($d->nama_pemohon) && $d->nama_pemohon !== ($d->user->nama ?? '');
                @endphp
                <tr data-status="{{ $rowStatus }}"
                    data-name="{{ strtolower($namaPemohon) }}"
                    data-surat="{{ strtolower($d->jenisSurat->nama_surat ?? '') }}">
                    <td class="td-no">{{ str_pad($loop->iteration, 2, '0', STR_PAD_LEFT) }}</td>
                    <td>
                        <div class="td-name">
                            {{ $namaPemohon }}
                            @if($isWakil)
                                <span style="font-size:9px;background:#fffbeb;color:#92400e;border:1px solid #fde68a;border-radius:4px;padding:1px 5px;margin-left:4px;font-weight:600">WAKIL</span>
                            @endif
                            <small>NIK: {{ $nikPemohon }}</small>
                            @if($isWakil)
                                <small style="color:#94a3b8">Pengaju: {{ $d->user->nama ?? '-' }}</small>
                            @endif
                        </div>
                    </td>
                    <td class="td-surat">{{ $d->jenisSurat->nama_surat ?? '-' }}</td>
                    <td class="td-date">{{ \Carbon\Carbon::parse($d->tanggal_pengajuan)->format('d M Y') }}</td>
                    <td>
                        @if($rowStatus === 'disetujui')
                            <span class="status-pill status-approved">
                                <span class="status-dot"></span> Disetujui
                            </span>
                        @elseif($rowStatus === 'ditolak')
                            <span class="status-pill status-rejected">
                                <span class="status-dot"></span> Ditolak
                            </span>
                        @else
                            <span class="status-pill status-pending">
                                <span class="status-dot"></span> Pending
                            </span>
                        @endif
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('permohonan.show', $d->id_permohonan) }}" class="btn-act btn-detail">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                </svg>
                                Detail
                            </a>

                            {{-- Tombol Dokumen --}}
                            @php
                                $jumlahDok = $persyaratan->count();
                                $dokData = json_encode([
                                    'nama'  => $namaPemohon,
                                    'jenis' => $d->jenisSurat->nama_surat ?? '-',
                                    'files' => $persyaratan->map(function($p) {
                                        return [
                                            'nama' => $p->nama_file,
                                            'url'  => asset('storage/'.$p->path_file),
                                            'ext'  => strtolower(pathinfo($p->nama_file, PATHINFO_EXTENSION)),
                                            'tgl'  => $p->uploaded_at ? \Carbon\Carbon::parse($p->uploaded_at)->format('d M Y, H:i') : '-',
                                        ];
                                    })->values()
                                ], JSON_HEX_QUOT | JSON_HEX_APOS);
                            @endphp
                            <button type="button"
                                class="btn-act btn-dok"
                                onclick="openDokModal({{ $dokData }})"
                                title="Dokumen Persyaratan ({{ $jumlahDok }})">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:14px;height:14px">
                                    <path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/><polyline points="13 2 13 9 20 9"/>
                                </svg>
                            </button>

                            @if($rowStatus === 'disetujui')
                                <a href="{{ route('permohonan.show', $d->id_permohonan) }}?print=1"
                                   target="_blank" class="btn-act btn-print">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 6 2 18 2 18 9"/>
                                        <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                                        <rect x="6" y="14" width="12" height="8"/>
                                    </svg>
                                    Cetak
                                </a>
                            @endif

                            @if($rowStatus === 'pending')
                                <form action="{{ route('permohonan.approve', $d->id_permohonan) }}" method="POST" style="display:inline;">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn-act btn-approve"
                                            onclick="return confirm('Setujui permohonan dari {{ addslashes($namaPemohon) }}?')">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('permohonan.reject', $d->id_permohonan) }}" method="POST" style="display:inline;">
                                    @csrf @method('PUT')
                                    <button type="submit" class="btn-act btn-reject"
                                            onclick="return confirm('Tolak permohonan dari {{ addslashes($namaPemohon) }}?')">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                                        </svg>
                                        Tolak
                                    </button>
                                </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6">
                        <div class="empty-state">
                            <div class="empty-icon">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                </svg>
                            </div>
                            <h3>Belum Ada Permohonan</h3>
                            <p>Data permohonan surat dari masyarakat akan muncul di sini</p>
                        </div>
                    </td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div><!-- /perm-page -->

<script>
function filterTable() {
    const search = document.getElementById('searchInput').value.toLowerCase();
    const status = document.getElementById('statusFilter').value.toLowerCase();
    const rows   = document.querySelectorAll('#permohonanTable tbody tr[data-status]');
    let visible  = 0;
    rows.forEach(row => {
        const name      = row.dataset.name  || '';
        const surat     = row.dataset.surat || '';
        const rowStatus = row.dataset.status || '';
        const ok = (name.includes(search) || surat.includes(search)) && (!status || rowStatus === status);
        row.style.display = ok ? '' : 'none';
        if (ok) visible++;
    });
    const lbl = document.getElementById('resultsCount');
    if (lbl) lbl.textContent = `${visible} data ditemukan`;
}
filterTable();
</script>

{{-- Modal Dokumen Persyaratan --}}
<div id="modalDokumen" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:1500;align-items:center;justify-content:center;">
    <div style="background:white;border-radius:16px;width:100%;max-width:520px;margin:16px;box-shadow:0 20px 60px rgba(0,0,0,.2);overflow:hidden;">
        <div style="padding:18px 20px 14px;border-bottom:1px solid #e2e8f0;display:flex;align-items:flex-start;justify-content:space-between;gap:12px">
            <div>
                <div style="font-size:15px;font-weight:800;color:#0f172a" id="modal-dok-title">Dokumen Persyaratan</div>
                <div style="font-size:12px;color:#64748b;margin-top:2px" id="modal-dok-sub"></div>
            </div>
            <button onclick="closeDokModal()" style="width:30px;height:30px;border-radius:7px;border:1px solid #e2e8f0;background:white;cursor:pointer;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:16px;color:#64748b">&times;</button>
        </div>
        <div id="modal-dok-list" style="max-height:400px;overflow-y:auto"></div>
    </div>
</div>

<script>
function openDokModal(data) {
    document.getElementById('modal-dok-title').textContent = 'Dokumen Persyaratan';
    document.getElementById('modal-dok-sub').textContent   = data.nama + ' — ' + data.jenis;

    const list = document.getElementById('modal-dok-list');

    if (!data.files || data.files.length === 0) {
        list.innerHTML = `<div style="padding:32px;text-align:center;color:#94a3b8;font-size:13px">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" style="width:36px;height:36px;margin:0 auto 8px;display:block;color:#e2e8f0">
                <path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/><polyline points="13 2 13 9 20 9"/>
            </svg>
            Tidak ada dokumen yang dilampirkan
        </div>`;
    } else {
        list.innerHTML = data.files.map((f, i) => {
            const isPdf = f.ext === 'pdf';
            const isImg = ['jpg','jpeg','png','gif','webp'].includes(f.ext);
            const iconColor = isPdf ? '#dc2626' : '#2563eb';
            const iconBg    = isPdf ? '#fee2e2' : '#dbeafe';
            const icon = isPdf
                ? `<svg viewBox="0 0 24 24" fill="currentColor" style="width:18px;height:18px;color:${iconColor}"><path d="M7 18H17V16H7v2zm0-4h10v-2H7v2zm-2 8a2 2 0 01-2-2V4a2 2 0 012-2h8l6 6v14a2 2 0 01-2 2H5z"/></svg>`
                : isImg
                ? `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px;color:${iconColor}"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>`
                : `<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:18px;height:18px;color:${iconColor}"><path d="M13 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V9z"/><polyline points="13 2 13 9 20 9"/></svg>`;

            return `<div style="display:flex;align-items:center;gap:12px;padding:13px 20px;border-bottom:1px solid #f1f5f9">
                <div style="width:38px;height:38px;border-radius:9px;background:${iconBg};display:flex;align-items:center;justify-content:center;flex-shrink:0">
                    ${icon}
                </div>
                <div style="flex:1;min-width:0">
                    <div style="font-size:13px;font-weight:600;color:#0f172a;overflow:hidden;text-overflow:ellipsis;white-space:nowrap">${escHtml(f.nama)}</div>
                    <div style="font-size:11px;color:#94a3b8;margin-top:2px">${f.ext.toUpperCase()} · ${escHtml(f.tgl)}</div>
                </div>
                <a href="${escHtml(f.url)}" target="_blank"
                   style="display:inline-flex;align-items:center;gap:5px;padding:6px 13px;border-radius:7px;background:#dbeafe;color:#1d4ed8;font-size:12px;font-weight:700;text-decoration:none;white-space:nowrap;flex-shrink:0">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px">
                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                    </svg>
                    Lihat
                </a>
            </div>`;
        }).join('');
    }

    const modal = document.getElementById('modalDokumen');
    modal.style.display = 'flex';
    document.body.style.overflow = 'hidden';
}

function closeDokModal() {
    document.getElementById('modalDokumen').style.display = 'none';
    document.body.style.overflow = '';
}

function escHtml(s) {
    return String(s).replace(/[&<>"]/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
}

document.getElementById('modalDokumen').addEventListener('click', function(e) {
    if (e.target === this) closeDokModal();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeDokModal(); });
</script>

@include('admin.partials.footer')

@endsection