@extends('Admin.layouts.app')

@section('title', 'Data Permohonan')

@push('styles')<style>
    :root {
        /* Brand — selaras dengan app.css */
        --primary:        #1c64f2;
        --primary-light:  #eff6ff;
        --primary-dark:   #1a56db;
        --success:        #10b981;
        --success-light:  #ecfdf5;
        --warning:        #f59e0b;
        --warning-light:  #fffbeb;
        --danger:         #ef4444;
        --danger-light:   #fef2f2;
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
        background: linear-gradient(135deg, #0d1b3e 0%, #1c64f2 60%, #60a5fa 100%);
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
        display: grid; grid-template-columns: repeat(5, 1fr);
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
    .stat-card[data-color="orange"]::after { background: #f97316; }
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
    .stat-icon.orange { background: #fff7ed; color: #ea580c; }
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
        overflow: visible;
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
    .status-pending       { background: #fffbeb; color: #92400e; }
    .status-pending .status-dot       { background: #f59e0b; animation: pulse-warn 1.5s infinite; }
    .status-approved      { background: #ecfdf5; color: #064e3b; }
    .status-approved .status-dot      { background: #10b981; }
    .status-rejected      { background: #fef2f2; color: #7f1d1d; }
    .status-rejected .status-dot      { background: #ef4444; }
    .status-siap-diambil  { background: #fff7ed; color: #9a3412; }
    .status-siap-diambil .status-dot  { background: #f97316; animation: pulse-orange 1.5s infinite; }
    .status-selesai       { background: #f0fdf4; color: #14532d; }
    .status-selesai .status-dot       { background: #16a34a; }
    .status-cancelled     { background: #f1f5f9; color: #64748b; }
    .status-cancelled .status-dot     { background: #94a3b8; }

    @keyframes pulse-warn {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: .6; transform: scale(1.3); }
    }
    @keyframes pulse-orange {
        0%, 100% { opacity: 1; transform: scale(1); }
        50%       { opacity: .5; transform: scale(1.4); }
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
    .btn-print   { background: #f3e8ff; color: #8b5cf6; }
    .btn-print:hover   { background: #f5f3ff; }
    .btn-siap    { background: #fff7ed; color: #c2410c; border: 1px solid #fed7aa; }
    .btn-siap:hover    { background: #ffedd5; }
    .btn-selesai { background: #f0fdf4; color: #166534; border: 1px solid #bbf7d0; }
    .btn-selesai:hover { background: #dcfce7; }
    .btn-wa      { background: #dcfce7; color: #15803d; border: 1px solid #86efac; }
    .btn-wa:hover { background: #bbf7d0; }
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

    @media (max-width: 1100px) {
        .stats-grid { grid-template-columns: repeat(3, 1fr); }
    }
    @media (max-width: 700px) {
        .stats-grid { grid-template-columns: repeat(2, 1fr); }
        .page-hero { padding: 24px 20px; }
        .page-hero h1 { font-size: 20px; }
        .search-wrap input { width: 200px; }
    }
</style>
@endpush

@section('content')

@include('Admin.partials.header')

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
                <strong id="stat-total">{{ $data->count() }}</strong>
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
                <strong id="stat-pending">{{ $data->filter(fn($d) => optional($d->approval)->status === null || optional($d->approval)->status === 'pending')->count() }}</strong>
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
                <strong id="stat-disetujui">{{ $data->filter(fn($d) => optional($d->approval)->status === 'disetujui')->count() }}</strong>
            </div>
        </div>
        <div class="stat-card" style="border-top-color:#f97316" data-color="orange">
            <div class="stat-icon orange">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                </svg>
            </div>
            <div class="stat-info">
                <small>Siap Diambil</small>
                <strong id="stat-siap">{{ $data->filter(fn($d) => optional($d->approval)->status === 'siap_diambil')->count() }}</strong>
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
                <strong id="stat-ditolak">{{ $data->filter(fn($d) => optional($d->approval)->status === 'ditolak')->count() }}</strong>
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
            <option value="siap_diambil">Siap Diambil</option>
            <option value="selesai">Selesai</option>
            <option value="ditolak">Ditolak</option>
            <option value="cancelled">Dibatalkan</option>
        </select>
        <div class="toolbar-right">
            <span class="results-label" id="resultsCount"></span>
        </div>
    </div>

    <!-- TABLE -->
    <div class="table-card">
        <div style="overflow-x:auto;-webkit-overflow-scrolling:touch;">
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
            <tbody id="permohonan-tbody">
                @forelse($data as $d)
                @php
                    $approvalStatus = optional($d->approval)->status;
                    $rowStatus = $approvalStatus ?? 'pending';
                    $persyaratan = $d->persyaratan ?? collect();
                    $namaPemohon = $d->nama_pemohon ?? $d->user->nama ?? '-';
                    $nikPemohon  = $d->nik_pemohon  ?? $d->user->nik  ?? '-';
                    $dtArr       = is_array($d->data_tambahan) ? $d->data_tambahan : (json_decode($d->data_tambahan??'{}', true) ?? []);
                    $isWakil     = $d->isPerwakilan();
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
                        @elseif($rowStatus === 'siap_diambil')
                            <span class="status-pill status-siap-diambil">
                                <span class="status-dot"></span> Siap Diambil
                            </span>
                        @elseif($rowStatus === 'selesai')
                            <span class="status-pill status-selesai">
                                <span class="status-dot"></span> Selesai
                            </span>
                        @elseif($rowStatus === 'cancelled')
                            <span class="status-pill status-cancelled">
                                <span class="status-dot"></span> Dibatalkan
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
                                <a href="{{ route('permohonan.print', $d->id_permohonan) }}"
                                   target="_blank" class="btn-act btn-print">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="6 9 6 2 18 2 18 9"/>
                                        <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                                        <rect x="6" y="14" width="12" height="8"/>
                                    </svg>
                                    Cetak
                                </a>
                                <form action="{{ route('permohonan.siapDiambil', $d->id_permohonan) }}" method="POST" style="display:inline;" id="form-siap-{{ $d->id_permohonan }}">
                                    @csrf @method('PUT')
                                    <button type="button" class="btn-act btn-siap"
                                            onclick="showConfirm('Tandai surat <strong>{{ addslashes($d->jenisSurat->nama_surat ?? '') }}</strong> milik <strong>{{ addslashes($namaPemohon) }}</strong> sebagai <strong>Siap Diambil</strong>?', () => document.getElementById('form-siap-{{ $d->id_permohonan }}').submit(), {confirmText:'Ya, Siap Diambil', type:'info'})">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                        </svg>
                                        Siap Diambil
                                    </button>
                                </form>
                            @endif

                            @if($rowStatus === 'siap_diambil')
                                @php
                                    $noHp = $d->user->no_hp ?? '';
                                    $noHpWa = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $noHp));
                                @endphp
                                @if($noHpWa)
                                <button type="button"
                                   class="btn-act btn-wa"
                                   onclick="openModalKirimWa({{ $d->id_permohonan }}, '{{ addslashes($namaPemohon) }}', '{{ $noHp }}')"
                                   title="Kirim surat PDF + TTD ke WhatsApp {{ $noHp }}">
                                    <svg viewBox="0 0 24 24" fill="currentColor" style="width:13px;height:13px">
                                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                                    </svg>
                                    Kirim WA
                                </button>
                                @endif
                                <form action="{{ route('permohonan.selesai', $d->id_permohonan) }}" method="POST" style="display:inline;" id="form-selesai-{{ $d->id_permohonan }}">
                                    @csrf @method('PUT')
                                    <button type="button" class="btn-act btn-selesai"
                                            onclick="showConfirm('Konfirmasi surat sudah diambil oleh <strong>{{ addslashes($namaPemohon) }}</strong>?', () => document.getElementById('form-selesai-{{ $d->id_permohonan }}').submit(), {confirmText:'Ya, Sudah Diambil', type:'success'})">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                        Selesai
                                    </button>
                                </form>
                            @endif

                            @if($rowStatus === 'pending')
                                <form action="{{ route('permohonan.approve', $d->id_permohonan) }}" method="POST" style="display:inline;" id="form-approve-{{ $d->id_permohonan }}">
                                    @csrf @method('PUT')
                                    <button type="button" class="btn-act btn-approve"
                                            onclick="showConfirm('Setujui permohonan dari <strong>{{ addslashes($namaPemohon) }}</strong>?', () => document.getElementById('form-approve-{{ $d->id_permohonan }}').submit(), {confirmText:'Ya, Setujui', type:'success'})">
                                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                            <polyline points="20 6 9 17 4 12"/>
                                        </svg>
                                        Setujui
                                    </button>
                                </form>
                                <form action="{{ route('permohonan.reject', $d->id_permohonan) }}" method="POST" style="display:inline;" id="form-reject-{{ $d->id_permohonan }}">
                                    @csrf @method('PUT')
                                    <input type="hidden" name="catatan" id="catatan-{{ $d->id_permohonan }}">
                                    <button type="button" class="btn-act btn-reject"
                                            onclick="showModalTolakIndex('{{ $d->id_permohonan }}', '{{ addslashes($namaPemohon) }}')">
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
            const iconColor = isPdf ? '#ef4444' : '#1c64f2';
            const iconBg    = isPdf ? '#fef2f2' : '#eff6ff';
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
                   style="display:inline-flex;align-items:center;gap:5px;padding:6px 13px;border-radius:7px;background:#eff6ff;color:#1a56db;font-size:12px;font-weight:700;text-decoration:none;white-space:nowrap;flex-shrink:0">
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

{{-- Modal Tolak Permohonan (dari index) --}}
<div id="modal-tolak-index" style="display:none;position:fixed;inset:0;z-index:1600;background:rgba(15,23,42,.45);backdrop-filter:blur(2px);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;padding:28px 28px 24px;width:100%;max-width:440px;box-shadow:0 20px 60px rgba(0,0,0,.18);margin:16px">
        <div style="display:flex;align-items:center;gap:12px;margin-bottom:18px">
            <div style="width:40px;height:40px;border-radius:10px;background:#fef2f2;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                <svg viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5" style="width:20px;height:20px"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            </div>
            <div>
                <div style="font-size:15px;font-weight:700;color:#1e293b">Tolak Permohonan</div>
                <div style="font-size:12px;color:#64748b;margin-top:1px" id="modal-tolak-index-nama">-</div>
            </div>
        </div>
        <div style="margin-bottom:16px">
            <label style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;display:block;margin-bottom:6px">
                Catatan Alasan Penolakan
                <span style="font-weight:400;color:#94a3b8;text-transform:none;letter-spacing:0"> (opsional)</span>
            </label>
            <textarea id="textarea-catatan-index" rows="4"
                placeholder="Contoh: Dokumen persyaratan tidak lengkap, NIK tidak sesuai, dll."
                style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13.5px;color:#1e293b;font-family:inherit;resize:vertical;transition:border-color .2s;box-sizing:border-box"
                onfocus="this.style.borderColor='#ef4444'" onblur="this.style.borderColor='#e2e8f0'"></textarea>
        </div>
        <div style="display:flex;gap:8px">
            <button type="button" onclick="tutupModalTolakIndex()" style="flex:1;padding:10px;border:1.5px solid #e2e8f0;border-radius:8px;background:#fff;font-size:13.5px;font-weight:600;color:#64748b;cursor:pointer">
                Batal
            </button>
            <button type="button" onclick="konfirmasiTolakIndex()" style="flex:1;padding:10px;border:none;border-radius:8px;background:#ef4444;font-size:13.5px;font-weight:700;color:#fff;cursor:pointer">
                Ya, Tolak Permohonan
            </button>
        </div>
    </div>
</div>

<script>
var _tolakTargetId = null;

function showModalTolakIndex(id, nama) {
    _tolakTargetId = id;
    document.getElementById('modal-tolak-index-nama').textContent = nama;
    document.getElementById('textarea-catatan-index').value = '';
    document.getElementById('modal-tolak-index').style.display = 'flex';
    document.body.style.overflow = 'hidden';
    setTimeout(function(){ document.getElementById('textarea-catatan-index').focus(); }, 100);
}

function tutupModalTolakIndex() {
    document.getElementById('modal-tolak-index').style.display = 'none';
    document.body.style.overflow = '';
    _tolakTargetId = null;
}

function konfirmasiTolakIndex() {
    if (!_tolakTargetId) return;
    var catatan = document.getElementById('textarea-catatan-index').value.trim();
    document.getElementById('catatan-' + _tolakTargetId).value = catatan;
    document.getElementById('form-reject-' + _tolakTargetId).submit();
}

document.getElementById('modal-tolak-index').addEventListener('click', function(e) {
    if (e.target === this) tutupModalTolakIndex();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') tutupModalTolakIndex();
});
</script>

@include('Admin.partials.footer')

{{-- ══ MODAL KIRIM WA + PILIH TTD ══ --}}
<div id="modal-kirim-wa" style="display:none;position:fixed;inset:0;z-index:2000;background:rgba(15,23,42,.5);backdrop-filter:blur(3px);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;width:100%;max-width:500px;margin:16px;box-shadow:0 24px 64px rgba(0,0,0,.2);overflow:hidden">
        {{-- Header --}}
        <div style="padding:18px 22px 14px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between">
            <div>
                <div style="font-size:15px;font-weight:800;color:#0f172a">📱 Kirim Surat via WhatsApp</div>
                <div style="font-size:12px;color:#64748b;margin-top:2px" id="wa-modal-sub">-</div>
            </div>
            <button onclick="closeModalKirimWa()" style="width:30px;height:30px;border-radius:7px;border:1px solid #e2e8f0;background:#fff;cursor:pointer;font-size:16px;color:#64748b;display:flex;align-items:center;justify-content:center">&times;</button>
        </div>
        {{-- Body --}}
        <div style="padding:20px 22px">
            <div style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#64748b;margin-bottom:12px">Pilih Tanda Tangan Digital:</div>
            <div id="wa-ttd-list" style="max-height:300px;overflow-y:auto;display:flex;flex-direction:column;gap:10px">
                <div style="text-align:center;padding:24px;color:#94a3b8;font-size:13px">Memuat daftar TTD...</div>
            </div>
            <div id="wa-no-ttd" style="display:none;background:#fffbeb;border:1.5px solid #fde68a;border-radius:10px;padding:14px;font-size:13px;color:#92400e">
                ⚠️ Belum ada TTD Digital yang aktif.
                <a href="{{ route('admin.ttd.create') }}" style="color:#1c64f2;font-weight:700;text-decoration:none">Tambah TTD Digital →</a>
            </div>
        </div>
        {{-- Footer --}}
        <div style="padding:14px 22px;border-top:1px solid #e2e8f0;display:flex;gap:10px;justify-content:flex-end">
            <button onclick="closeModalKirimWa()" style="padding:9px 20px;border-radius:8px;border:1.5px solid #e2e8f0;background:#fff;font-size:13px;font-weight:600;color:#64748b;cursor:pointer">Batal</button>
            <button id="btn-kirim-wa-submit" onclick="submitKirimWa()" style="padding:9px 22px;border-radius:8px;border:none;background:#15803d;color:#fff;font-size:13px;font-weight:700;cursor:pointer;display:flex;align-items:center;gap:7px" disabled>
                <svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                Generate PDF & Kirim WA
            </button>
        </div>
    </div>
</div>

<script>
var _waPermohonanId = null;
var _waTtdId       = null;
var _waCsrfToken   = '{{ csrf_token() }}';

function openModalKirimWa(id, nama, noHp) {
    _waPermohonanId = id;
    _waTtdId = null;
    document.getElementById('wa-modal-sub').textContent = nama + ' · ' + noHp;
    document.getElementById('btn-kirim-wa-submit').disabled = true;
    document.getElementById('wa-no-ttd').style.display = 'none';
    document.getElementById('wa-ttd-list').innerHTML = '<div style="text-align:center;padding:24px;color:#94a3b8;font-size:13px">Memuat daftar TTD...</div>';
    document.getElementById('modal-kirim-wa').style.display = 'flex';
    document.body.style.overflow = 'hidden';

    fetch('/admin/permohonan/' + id + '/ttd-list', {
        headers: { 'X-Requested-With': 'XMLHttpRequest' }
    })
    .then(r => r.json())
    .then(ttds => {
        const list = document.getElementById('wa-ttd-list');
        if (!ttds.length) {
            list.innerHTML = '';
            document.getElementById('wa-no-ttd').style.display = 'block';
            return;
        }
        list.innerHTML = ttds.map(t => `
            <label onclick="selectTtd(${t.id})" style="display:flex;align-items:center;gap:14px;padding:12px 14px;border:2px solid #e2e8f0;border-radius:10px;cursor:pointer;transition:all .15s" id="ttd-card-${t.id}">
                <input type="radio" name="wa_ttd" value="${t.id}" style="display:none">
                ${t.ttd_url ? `<img src="${escH(t.ttd_url)}" style="height:52px;width:120px;object-fit:contain;border:1px solid #e2e8f0;border-radius:6px;padding:3px;background:#fafafa;flex-shrink:0">` : '<div style="width:120px;height:52px;background:#f1f5f9;border-radius:6px;flex-shrink:0;display:flex;align-items:center;justify-content:center;font-size:11px;color:#94a3b8">Tidak ada gambar</div>'}
                <div style="flex:1;min-width:0">
                    <div style="font-size:13px;font-weight:700;color:#0f172a">${escH(t.nama)}</div>
                    <div style="font-size:11px;color:#64748b;margin-top:2px">${escH(t.jabatan)}</div>
                    ${t.nip && t.nip !== '-' ? `<div style="font-size:11px;color:#94a3b8;font-family:monospace">NIP. ${escH(t.nip)}</div>` : ''}
                </div>
                <div class="ttd-check-${t.id}" style="display:none;width:22px;height:22px;border-radius:50%;background:#15803d;flex-shrink:0;align-items:center;justify-content:center">
                    <svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="3" style="width:12px;height:12px"><polyline points="20 6 9 17 4 12"/></svg>
                </div>
            </label>
        `).join('');
        // Auto-pilih jika hanya ada 1 TTD
        if (ttds.length === 1) { selectTtd(ttds[0].id); }
    })
    .catch(() => {
        document.getElementById('wa-ttd-list').innerHTML = '<div style="color:#ef4444;font-size:13px;padding:16px">Gagal memuat daftar TTD</div>';
    });
}

function selectTtd(id) {
    _waTtdId = id;
    document.querySelectorAll('[id^="ttd-card-"]').forEach(el => {
        el.style.borderColor = '#e2e8f0';
        el.style.background  = '#fff';
    });
    const card = document.getElementById('ttd-card-' + id);
    if (card) { card.style.borderColor = '#15803d'; card.style.background = '#f0fdf4'; }
    document.getElementById('btn-kirim-wa-submit').disabled = false;
}

function closeModalKirimWa() {
    document.getElementById('modal-kirim-wa').style.display = 'none';
    document.body.style.overflow = '';
    // Reset button state agar bisa dipakai lagi saat modal dibuka kembali
    const btn = document.getElementById('btn-kirim-wa-submit');
    btn.disabled = true;
    btn.innerHTML = `<svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> Generate PDF & Kirim WA`;
    _waTtdId = null;
}

function submitKirimWa() {
    if (!_waPermohonanId) return;
    if (!_waTtdId) {
        showToast('⚠️ Pilih tanda tangan terlebih dahulu!', 'warning');
        return;
    }
    const btn = document.getElementById('btn-kirim-wa-submit');
    btn.disabled = true;
    btn.textContent = '⏳ Mengirim...';

    fetch('/admin/permohonan/' + _waPermohonanId + '/kirim-wa', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': _waCsrfToken,
            'X-Requested-With': 'XMLHttpRequest',
        },
        body: JSON.stringify({ ttd_id: _waTtdId }),
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            closeModalKirimWa();
            showToast('✅ ' + data.message, 'success');
        } else {
            showToast('❌ ' + data.message, 'danger');
            // Jangan tutup modal agar user bisa coba lagi
        }
    })
    .catch(() => {
        showToast('❌ Terjadi kesalahan. Coba lagi.', 'danger');
        // Jangan tutup modal
    })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = `<svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> Generate PDF & Kirim WA`;
    });
}

function showToast(msg, type) {
    const t = document.createElement('div');
    const bg = type==='success' ? '#15803d' : type==='warning' ? '#d97706' : '#dc2626';
    t.style.cssText = `position:fixed;bottom:24px;right:24px;z-index:9999;padding:12px 20px;border-radius:10px;font-size:13px;font-weight:600;color:#fff;background:${bg};box-shadow:0 4px 16px rgba(0,0,0,.2);animation:slideUp .3s ease`;
    t.textContent = msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 4000);
}

function escH(s) { return String(s).replace(/[&<>"]/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c])); }

document.getElementById('modal-kirim-wa').addEventListener('click', function(e) {
    if (e.target === this) closeModalKirimWa();
});
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModalKirimWa(); });

// ── Polling Stats & Tabel Permohonan (tiap 15 detik) ────────────────────────
(function () {
    var POLL_MS = 15000;
    var API     = '{{ route("permohonan.stats") }}';
    var CSRF    = document.querySelector('meta[name="csrf-token"]')?.content || '';

    var elTotal    = document.getElementById('stat-total');
    var elPending  = document.getElementById('stat-pending');
    var elDisetujui= document.getElementById('stat-disetujui');
    var elSiap     = document.getElementById('stat-siap');
    var elDitolak  = document.getElementById('stat-ditolak');
    var tbody      = document.getElementById('permohonan-tbody');
    var resCount   = document.getElementById('resultsCount');

    var currentSearch = '';
    var currentStatus = '';
    var lastTotal = -1;

    function flash(el) {
        if (!el) return;
        el.style.transition = 'color .3s';
        el.style.color = '#1c64f2';
        setTimeout(function () { el.style.color = ''; }, 600);
    }

    function statusPill(s) {
        var map = {
            disetujui:    '<span class="status-pill status-approved"><span class="status-dot"></span> Disetujui</span>',
            ditolak:      '<span class="status-pill status-rejected"><span class="status-dot"></span> Ditolak</span>',
            siap_diambil: '<span class="status-pill status-siap-diambil"><span class="status-dot"></span> Siap Diambil</span>',
            selesai:      '<span class="status-pill status-selesai"><span class="status-dot"></span> Selesai</span>',
            cancelled:    '<span class="status-pill status-cancelled"><span class="status-dot"></span> Dibatalkan</span>',
            pending:      '<span class="status-pill status-pending"><span class="status-dot"></span> Pending</span>',
        };
        return map[s] || map['pending'];
    }

    function renderRows(rows) {
        if (!tbody) return;
        var search = currentSearch.toLowerCase();
        var status = currentStatus.toLowerCase();
        var visible = 0;

        tbody.innerHTML = rows.map(function (d, i) {
            var rowStatus = d.status;
            var hide = (search && !d.nama.toLowerCase().includes(search) && !d.jenis_surat.toLowerCase().includes(search))
                    || (status && rowStatus !== status);

            visible += hide ? 0 : 1;

            var wakil = d.is_wakil ? '<span style="font-size:9px;background:#fffbeb;color:#92400e;border:1px solid #fde68a;border-radius:4px;padding:1px 5px;margin-left:4px;font-weight:600">WAKIL</span>' : '';
            var userAlt = d.is_wakil ? '<small style="color:#94a3b8">Pengaju: ' + escH(d.nama_user) + '</small>' : '';

            var aksi = '<div class="action-group"><a href="' + escH(d.url) + '" class="btn-act btn-detail"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>Detail</a>';

            if (rowStatus === 'siap_diambil' && d.no_hp) {
                aksi += '<a href="' + escH(d.url) + '" class="btn-act btn-kirim-wa" onclick="event.preventDefault();openModalKirimWa(' + d.id + ',\'' + escH(d.nama) + '\',\'' + escH(d.no_hp) + '\')"><svg viewBox="0 0 24 24" fill="currentColor" style="width:12px;height:12px"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>Kirim WA</a>';
            }
            aksi += '</div>';

            return '<tr data-status="' + rowStatus + '" data-name="' + escH(d.nama.toLowerCase()) + '" data-surat="' + escH(d.jenis_surat.toLowerCase()) + '" style="' + (hide ? 'display:none' : '') + '">'
                + '<td class="td-no">' + String(i+1).padStart(2,'0') + '</td>'
                + '<td><div class="td-name">' + escH(d.nama) + wakil + '<small>NIK: ' + escH(d.nik) + '</small>' + userAlt + '</div></td>'
                + '<td class="td-surat">' + escH(d.jenis_surat) + '</td>'
                + '<td class="td-date">' + escH(d.tanggal) + '</td>'
                + '<td>' + statusPill(rowStatus) + '</td>'
                + '<td>' + aksi + '</td>'
                + '</tr>';
        }).join('');

        if (resCount) resCount.textContent = visible + ' data ditemukan';
    }

    function fetchStats() {
        fetch(API, { headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' } })
            .then(function (r) { return r.json(); })
            .then(function (d) {
                if (elTotal    && elTotal.textContent    != d.total)        { flash(elTotal);     elTotal.textContent     = d.total; }
                if (elPending  && elPending.textContent  != d.pending)      { flash(elPending);   elPending.textContent   = d.pending; }
                if (elDisetujui&& elDisetujui.textContent!= d.disetujui)    { flash(elDisetujui); elDisetujui.textContent = d.disetujui; }
                if (elSiap     && elSiap.textContent     != d.siap_diambil) { flash(elSiap);      elSiap.textContent      = d.siap_diambil; }
                if (elDitolak  && elDitolak.textContent  != d.ditolak)      { flash(elDitolak);   elDitolak.textContent   = d.ditolak; }

                if (d.total !== lastTotal) {
                    lastTotal = d.total;
                    renderRows(d.rows);
                }
            })
            .catch(function () {});
    }

    // Sync filter input dengan polling
    var searchInput  = document.getElementById('searchInput');
    var statusFilter = document.getElementById('statusFilter');
    if (searchInput)  searchInput.addEventListener('input',  function () { currentSearch = this.value; filterTable(); });
    if (statusFilter) statusFilter.addEventListener('change', function () { currentStatus = this.value; filterTable(); });

    fetchStats();
    setInterval(fetchStats, POLL_MS);
})();
</script>

<style>
@keyframes slideUp { from{opacity:0;transform:translateY(10px)} to{opacity:1;transform:translateY(0)} }
</style>

@endsection