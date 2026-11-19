@extends('Admin.layouts.app')

@section('title', 'Detail Permohonan')

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
        --purple:         #8b5cf6;
        --purple-light:   #f5f3ff;
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
        background: linear-gradient(135deg, #0d1b3e 0%, #1c64f2 60%, #60a5fa 100%);
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
    .pill-siap     { background:#fff7ed;color:#9a3412; } .pill-siap .pill-dot { background:#f97316;animation:pulse-orange 1.5s infinite; }
    .pill-selesai  { background:#f0fdf4;color:#14532d; } .pill-selesai .pill-dot { background:#16a34a; }
    .pill-cancelled { background:#f1f5f9;color:#64748b; } .pill-cancelled .pill-dot { background:#94a3b8; }
    @keyframes pulse-warn   { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.6;transform:scale(1.3)} }
    @keyframes pulse-orange { 0%,100%{opacity:1;transform:scale(1)} 50%{opacity:.5;transform:scale(1.4)} }

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
    .section-head-icon.amber  { background:#fffbeb;color:#f59e0b; }
    .section-head h3 { font-size:13px;font-weight:700;color:var(--gray-700);margin:0; }
    .section-body { padding:20px; }

    /* FIELDS */
    .fg { display:grid;grid-template-columns:repeat(4,1fr); }
    .fi { padding:12px 20px;border-bottom:1px solid #f3f4f6;border-right:1px solid #f3f4f6; }
    .fi:nth-child(4n) { border-right:none; }
    .fi.c2 { grid-column:span 2; }
    .fi.c3 { grid-column:span 3; }
    .fi.c4 { grid-column:span 4; }
    .fg .fi:last-child, .fg .fi:nth-last-child(2) { border-bottom:none; }
    .fl { font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--gray-400);margin-bottom:5px; }
    .fl-row { display:flex;align-items:center;justify-content:space-between;margin-bottom:5px; }
    .fl-row .fl { margin-bottom:0; }
    .btn-bold-toggle { width:20px;height:20px;border-radius:4px;border:1.5px solid #e2e8f0;background:white;color:var(--gray-400);font-size:11px;font-weight:800;line-height:1;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;font-family:Georgia,serif;transition:all .15s; }
    .btn-bold-toggle:hover { border-color:var(--primary);color:var(--primary);background:#eff6ff; }
    .btn-bold-toggle.is-active { border-color:var(--primary);color:white;background:var(--primary); }
    .fv-boldpreview { font-size:11px;color:var(--gray-400);margin-top:4px;min-height:14px; }
    .fv-boldpreview strong { color:var(--gray-600); }
    .fv { font-size:13.5px;color:var(--gray-800);font-weight:500;line-height:1.5; }
    .fv.mono { font-family:'DM Mono',monospace;font-size:13px; }
    .fv-input { width:100%;padding:8px 12px;border:1.5px solid #e2e8f0;border-radius:6px;font-size:13.5px;font-weight:500;color:var(--gray-800);font-family:inherit;transition:border-color .2s; }
    .fv-input:focus { outline:none;border-color:var(--primary); }
    .fv-input.mono { font-family:'DM Mono',monospace;font-size:13px; }
    textarea.fv-input { resize:vertical;min-height:60px; }
    .fdivider { grid-column:span 4;padding:8px 20px 6px;border-top:1px solid #f3f4f6;border-bottom:1px solid #f3f4f6;background:#f8fafc; }
    .fdivider span { font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#64748b; }
    .fdivider:first-child { border-top:none; }

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
    .btn-siap-full    { background:#fff7ed;color:#c2410c;border:1.5px solid #fed7aa; } .btn-siap-full:hover { background:#ffedd5; }
    .btn-selesai-full { background:#f0fdf4;color:#166534;border:1.5px solid #bbf7d0; } .btn-selesai-full:hover { background:#dcfce7; }
    .btn-wa-full { background:#dcfce7;color:#15803d;border:1.5px solid #86efac;text-decoration:none;display:flex; } .btn-wa-full:hover { background:#bbf7d0; }
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
    .tl-dot.orange   { background:#fff7ed;color:#ea580c; }
    .tl-dot.selesai  { background:#f0fdf4;color:#16a34a; }
    .tl-body p     { font-size:13px;font-weight:700;color:var(--gray-800);margin:0 0 3px; }
    .tl-body small { font-size:11px;color:var(--gray-400);font-family:'DM Mono',monospace; }

    @media(max-width:900px){.detail-grid{grid-template-columns:1fr}.fg{grid-template-columns:1fr 1fr}.fi.c2,.fi.c3,.fi.c4{grid-column:span 2}}
</style>
@endpush

@section('content')
@include('Admin.partials.header')

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
            @elseif($status === 'siap_diambil')
                <span class="pill pill-siap"><span class="pill-dot"></span> Siap Diambil</span>
            @elseif($status === 'selesai')
                <span class="pill pill-selesai"><span class="pill-dot"></span> Selesai</span>
            @elseif($status === 'cancelled')
                <span class="pill pill-cancelled"><span class="pill-dot"></span> Dibatalkan Otomatis</span>
            @else
                <span class="pill pill-pending"><span class="pill-dot"></span> Menunggu Proses</span>
            @endif

            @if(in_array($status, ['disetujui', 'siap_diambil', 'selesai']))
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

        <div>

            @php
                $isPerwakilan = $data->isPerwakilan();
                $allFields = collect(optional($data->jenisSurat)->fields_config ?? []);
                if ($data->jenisSurat && is_string($data->jenisSurat->fields_config)) $allFields = collect(json_decode($data->jenisSurat->fields_config, true) ?? []);
            @endphp
            <div class="section-card">
                <div class="section-head">
                    <div class="section-head-icon blue">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <h3>Data Permohonan</h3>
                    @if($isPerwakilan)
                    <span style="font-size:11px;font-weight:700;background:#fffbeb;color:#92400e;border:1px solid #fde68a;border-radius:20px;padding:2px 10px">PERWAKILAN</span>
                    @endif
                </div>
                <form action="{{ route('permohonan.updateData', $data->id_permohonan) }}" method="POST">
                    @csrf @method('PUT')
                <div class="fg">
                    <div class="fi c2">
                        <div class="fl">Nama Lengkap</div>
                        <input type="text" name="nama_pemohon" value="{{ $nama }}" required class="fv-input">
                    </div>
                    <div class="fi c2">
                        <div class="fl">NIK</div>
                        <input type="text" name="nik_pemohon" value="{{ $nik }}" maxlength="16" required class="fv-input mono">
                    </div>

                    @foreach($allFields->where('group','biodata')->whereNotIn('key',['nama','nik','alamat'])->where('type','!=','section') as $bf)
                    <div class="fi c2">
                        <div class="fl">{{ $bf['print_label'] ?? $bf['label'] }}</div>
                        @if($bf['key'] === 'tempat_tgl_lahir')
                        <div style="display:grid;grid-template-columns:1fr 1fr;gap:8px">
                            <input type="text" name="tempat_lahir" value="{{ $dt['tempat_lahir'] ?? '' }}" placeholder="Tempat" class="fv-input">
                            <input type="date" name="tanggal_lahir" value="{{ $dt['tanggal_lahir'] ?? '' }}" class="fv-input">
                        </div>
                        @elseif($bf['key'] === 'jenis_kelamin')
                        <select name="jenis_kelamin" class="fv-input">
                            <option value="Laki-Laki" {{ ($dt['jenis_kelamin']??'')==='Laki-Laki'?'selected':'' }}>Laki-Laki</option>
                            <option value="Perempuan" {{ ($dt['jenis_kelamin']??'')==='Perempuan'?'selected':'' }}>Perempuan</option>
                        </select>
                        @elseif($bf['key'] === 'agama')
                        <select name="agama" class="fv-input">
                            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag)
                            <option value="{{ $ag }}" {{ ($dt['agama']??'')===$ag?'selected':'' }}>{{ $ag }}</option>
                            @endforeach
                        </select>
                        @elseif($bf['key'] === 'status_kawin')
                        <select name="status_kawin" class="fv-input">
                            @foreach(['Belum Menikah','Kawin','Cerai Hidup','Cerai Mati'] as $sk)
                            <option value="{{ $sk }}" {{ ($dt['status_kawin']??'')===$sk?'selected':'' }}>{{ $sk }}</option>
                            @endforeach
                        </select>
                        @elseif($bf['key'] === 'umur')
                        <input type="number" name="umur" value="{{ $dt['umur'] ?? '' }}" min="0" max="150" class="fv-input">
                        @else
                        <input type="text" name="{{ $bf['key'] }}" value="{{ $dt[$bf['key']] ?? '' }}" class="fv-input">
                        @endif
                    </div>
                    @endforeach

                    <div class="fi c4">
                        <div class="fl">Alamat</div>
                        <textarea name="alamat_pemohon" rows="2" required class="fv-input">{{ $alamat }}</textarea>
                    </div>

                    <div class="fdivider"><span>Keperluan &amp; Data Surat</span></div>
                    <div class="fi c2">
                        <div class="fl">Keperluan / Tujuan Surat</div>
                        <input type="text" name="keperluan" value="{{ $data->keperluan ?? '' }}" class="fv-input">
                    </div>
                    <div class="fi c2">
                        <div class="fl">Tanggal Pengajuan</div>
                        <div class="fv mono">{{ \Carbon\Carbon::parse($data->tanggal_pengajuan)->locale('id')->isoFormat('D MMMM Y') }}</div>
                    </div>

                    @foreach($allFields->where('group','extra') as $ef)
                        @if(($ef['type'] ?? '') === 'section')
                        <div class="fdivider"><span>{{ $ef['label'] }}</span></div>
                        @elseif(($ef['print_style'] ?? '') !== 'center_bold')
                        <div class="fi c2">
                            @if(($ef['type'] ?? '') === 'date')
                            <div class="fl">{{ $ef['label'] }}</div>
                            <input type="date" name="extra_{{ $ef['key'] }}" value="{{ $dt[$ef['key']] ?? '' }}" class="fv-input">
                            @elseif(($ef['type'] ?? '') === 'textarea')
                            <div class="fl-row">
                                <div class="fl">{{ $ef['label'] }}</div>
                                <button type="button" class="btn-bold-toggle" id="bold_extra_{{ $ef['key'] }}" onclick="toggleBoldField('extra_{{ $ef['key'] }}')" title="Bold-kan teks ini di surat cetak">B</button>
                            </div>
                            <textarea name="extra_{{ $ef['key'] }}" id="extra_{{ $ef['key'] }}" rows="2" class="fv-input" oninput="syncBoldButton('extra_{{ $ef['key'] }}')">{{ $dt[$ef['key']] ?? '' }}</textarea>
                            <div class="fv-boldpreview" id="preview_extra_{{ $ef['key'] }}"></div>
                            @else
                            <div class="fl-row">
                                <div class="fl">{{ $ef['label'] }}</div>
                                <button type="button" class="btn-bold-toggle" id="bold_extra_{{ $ef['key'] }}" onclick="toggleBoldField('extra_{{ $ef['key'] }}')" title="Bold-kan teks ini di surat cetak (atau tekan Ctrl+B)">B</button>
                            </div>
                            <input type="text" name="extra_{{ $ef['key'] }}" id="extra_{{ $ef['key'] }}" value="{{ $dt[$ef['key']] ?? '' }}" class="fv-input" oninput="syncBoldButton('extra_{{ $ef['key'] }}')">
                            <div class="fv-boldpreview" id="preview_extra_{{ $ef['key'] }}"></div>
                            @endif
                        </div>
                        @endif
                    @endforeach

                    @if($isPerwakilan)
                    <div class="fdivider"><span>Info Pengaju</span></div>
                    <div class="fi c2">
                        <div class="fl">Diajukan oleh (Akun)</div>
                        <div class="fv">{{ $data->user->nama ?? '-' }}</div>
                    </div>
                    @endif
                </div>
                <div style="padding:16px 24px;border-top:1px solid #e2e8f0;display:flex;justify-content:flex-end;gap:10px">
                    <button type="submit" style="display:inline-flex;align-items:center;gap:6px;padding:9px 20px;border-radius:8px;border:none;background:var(--primary);font-size:13px;font-weight:600;color:white;cursor:pointer;font-family:inherit">
                        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                        Simpan Perubahan
                    </button>
                </div>
                </form>
            </div>

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
                    <div class="dok-icon" style="{{ $isPdf ? 'background:#fef2f2' : 'background:var(--primary-light)' }}">
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

        </div>

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
                <form action="{{ route('permohonan.approve', $data->id_permohonan) }}" method="POST" style="margin-bottom:10px" id="form-approve-show">
                    @csrf @method('PUT')
                    <button type="button" class="btn-full btn-approve-full" onclick="showConfirm('Setujui permohonan <strong>{{ addslashes($data->jenisSurat->nama_surat ?? '') }}</strong> dari <strong>{{ addslashes($nama) }}</strong>?', () => document.getElementById('form-approve-show').submit(), {confirmText:'Ya, Setujui', type:'success'})">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                        Setujui Permohonan
                    </button>
                </form>
                <form action="{{ route('permohonan.reject', $data->id_permohonan) }}" method="POST" id="form-reject-show">
                    @csrf @method('PUT')
                    <input type="hidden" name="catatan" id="input-catatan-reject">
                    <button type="button" class="btn-full btn-reject-full" onclick="showModalTolak()">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        Tolak Permohonan
                    </button>
                </form>

                @elseif($status === 'disetujui')
                <div class="action-done" style="margin-bottom:12px">
                    <p>Permohonan disetujui — tandai siap diambil setelah surat dicetak</p>
                    <span class="pill pill-approved" style="display:inline-flex"><span class="pill-dot"></span> Disetujui</span>
                </div>
                <a href="{{ route('permohonan.print', $data->id_permohonan) }}" target="_blank" class="btn-full btn-print-full" style="margin-bottom:10px">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 6 2 18 2 18 9"/>
                        <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                        <rect x="6" y="14" width="12" height="8"/>
                    </svg>
                    Cetak / Print Surat Resmi
                </a>
                <form action="{{ route('permohonan.siapDiambil', $data->id_permohonan) }}" method="POST" id="form-siap-show">
                    @csrf @method('PUT')
                    <button type="button" class="btn-full btn-siap-full"
                        onclick="showConfirm('Tandai surat ini <strong>Siap Diambil</strong>?<br><small style=\'color:#64748b\'>Warga akan mendapat notifikasi untuk datang ke kelurahan.</small>', () => document.getElementById('form-siap-show').submit(), {confirmText:'Ya, Siap Diambil', type:'info'})">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                        </svg>
                        Tandai Siap Diambil
                    </button>
                </form>

                @elseif($status === 'siap_diambil')
                <div class="action-done" style="margin-bottom:12px;background:#fff7ed;border-color:#fed7aa">
                    <p style="color:#9a3412">Surat sudah siap — tunggu warga mengambil</p>
                    <span class="pill pill-siap" style="display:inline-flex"><span class="pill-dot"></span> Siap Diambil</span>
                </div>
                <a href="{{ route('permohonan.print', $data->id_permohonan) }}" target="_blank" class="btn-full btn-print-full" style="margin-bottom:10px">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <polyline points="6 9 6 2 18 2 18 9"/>
                        <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                        <rect x="6" y="14" width="12" height="8"/>
                    </svg>
                    Cetak / Print Surat
                </a>
                <form action="{{ route('permohonan.selesai', $data->id_permohonan) }}" method="POST" id="form-selesai-show">
                    @csrf @method('PUT')
                    <button type="button" class="btn-full btn-selesai-full"
                        onclick="showConfirm('Konfirmasi surat sudah diambil oleh <strong>{{ addslashes($nama) }}</strong>?', () => document.getElementById('form-selesai-show').submit(), {confirmText:'Ya, Sudah Diambil', type:'success'})">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                            <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                        </svg>
                        Konfirmasi Sudah Diambil
                    </button>
                </form>

                @php
                    $noHpShow   = $data->user->no_hp ?? '';
                    $noHpWaShow = preg_replace('/^0/', '62', preg_replace('/[^0-9]/', '', $noHpShow));
                    $jenisSuratNama = $data->jenisSurat->nama_surat ?? 'Surat';
                    $tglPengajuan   = \Carbon\Carbon::parse($data->tanggal_pengajuan)->format('d M Y');
                    $pesanWaShow = urlencode(
                        "Assalamu'alaikum Wr. Wb.\n\n" .
                        "Yth. Bapak/Ibu *{$nama}*,\n\n" .
                        "Kami informasikan bahwa permohonan *{$jenisSuratNama}* Anda telah selesai diproses dan *siap untuk diambil* di Kantor Kelurahan Teritih.\n\n" .
                        "📋 *Detail Permohonan:*\n" .
                        "• Jenis Surat : {$jenisSuratNama}\n" .
                        "• Tanggal     : {$tglPengajuan}\n\n" .
                        "Mohon segera hadir ke kantor kelurahan pada jam kerja (Senin–Jumat, 08.00–15.00 WIB) untuk mengambil surat Anda.\n\n" .
                        "Terima kasih 🙏\n" .
                        "*Kelurahan Teritih, Kecamatan Walantaka, Kota Serang*"
                    );
                @endphp
                @if($noHpWaShow)
                <button type="button"
                    class="btn-full btn-wa-full"
                    style="margin-top:10px"
                    onclick="openModalKirimWa({{ $data->id_permohonan }}, '{{ addslashes($nama) }}', '{{ $noHpShow }}')">
                    <svg viewBox="0 0 24 24" fill="currentColor" style="width:15px;height:15px">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                    Kirim Surat via WhatsApp (PDF + TTD)
                </button>
                @else
                <div style="margin-top:10px;padding:10px 12px;background:#fffbeb;border:1.5px solid #fde68a;border-radius:8px;font-size:12px;color:#92400e">
                    ⚠️ User belum mengisi nomor WhatsApp
                </div>
                @endif

                @elseif($status === 'selesai')
                <div class="action-done" style="background:#f0fdf4;border-color:#bbf7d0">
                    <p style="color:#166534">Permohonan selesai — surat sudah diambil</p>
                    <span class="pill pill-selesai" style="display:inline-flex"><span class="pill-dot"></span> Selesai</span>
                </div>
                <div style="margin-top:12px">
                    <a href="{{ route('permohonan.print', $data->id_permohonan) }}" target="_blank" class="btn-full btn-print-full" style="margin-bottom:0">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <polyline points="6 9 6 2 18 2 18 9"/>
                            <path d="M6 18H4a2 2 0 01-2-2v-5a2 2 0 012-2h16a2 2 0 012 2v5a2 2 0 01-2 2h-2"/>
                            <rect x="6" y="14" width="12" height="8"/>
                        </svg>
                        Cetak / Print Surat
                    </a>
                </div>

                @elseif($status === 'cancelled')
                {{-- dibatalkan otomatis --}}
                <div class="action-done" style="background:#f8fafc;border-color:#e2e8f0">
                    <p style="color:#475569">Permohonan ini dibatalkan otomatis</p>
                    <span class="pill pill-cancelled" style="display:inline-flex"><span class="pill-dot"></span> Dibatalkan Otomatis</span>
                </div>
                <div style="margin-top:12px;background:#f1f5f9;border:1.5px solid #cbd5e1;border-radius:10px;padding:12px 14px">
                    <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;margin-bottom:5px">Keterangan</div>
                    <div style="font-size:13px;color:#475569;line-height:1.6">{{ $data->approval->catatan ?? 'Permohonan dibatalkan otomatis karena tidak ada tindak lanjut dari admin dalam 72 jam.' }}</div>
                </div>

                @else
                {{-- ditolak --}}
                <div class="action-done">
                    <p>Permohonan ini telah ditolak</p>
                    <span class="pill pill-rejected" style="display:inline-flex"><span class="pill-dot"></span> Ditolak</span>
                </div>
                <div style="margin-top:12px;background:#fef2f2;border:1.5px solid #fecaca;border-radius:10px;padding:12px 14px">
                    <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#b91c1c;margin-bottom:5px">Catatan Alasan Penolakan</div>
                    @if(!empty($data->approval->catatan))
                    <div style="font-size:13px;color:#7f1d1d;line-height:1.6">{{ $data->approval->catatan }}</div>
                    @else
                    <div style="font-size:13px;color:#9f1239;font-style:italic;line-height:1.6">Tidak ada catatan alasan penolakan.</div>
                    @endif
                </div>
                @endif
            </div>

            {{-- Modal Tolak Permohonan — di luar @if agar selalu ada di DOM --}}
            <div id="modal-tolak" style="display:none;position:fixed;inset:0;z-index:9999;background:rgba(15,23,42,.45);backdrop-filter:blur(2px);align-items:center;justify-content:center">
                <div style="background:#fff;border-radius:16px;padding:28px 28px 24px;width:100%;max-width:440px;box-shadow:0 20px 60px rgba(0,0,0,.18);margin:16px">
                    <div style="display:flex;align-items:center;gap:12px;margin-bottom:18px">
                        <div style="width:40px;height:40px;border-radius:10px;background:#fef2f2;display:flex;align-items:center;justify-content:center;flex-shrink:0">
                            <svg viewBox="0 0 24 24" fill="none" stroke="#ef4444" stroke-width="2.5" style="width:20px;height:20px"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
                        </div>
                        <div>
                            <div style="font-size:15px;font-weight:700;color:#1e293b">Tolak Permohonan</div>
                            <div style="font-size:12px;color:#64748b;margin-top:1px">{{ $nama }}</div>
                        </div>
                    </div>
                    <div style="margin-bottom:16px">
                        <label style="font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#64748b;display:block;margin-bottom:6px">
                            Catatan Alasan Penolakan
                            <span style="font-weight:400;color:#94a3b8;text-transform:none;letter-spacing:0"> (opsional)</span>
                        </label>
                        <textarea id="textarea-catatan-reject" rows="4"
                            placeholder="Contoh: Dokumen persyaratan tidak lengkap, NIK tidak sesuai, dll."
                            style="width:100%;padding:10px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13.5px;color:#1e293b;font-family:inherit;resize:vertical;transition:border-color .2s;box-sizing:border-box"
                            onfocus="this.style.borderColor='#ef4444'" onblur="this.style.borderColor='#e2e8f0'"></textarea>
                    </div>
                    <div style="display:flex;gap:8px">
                        <button type="button" onclick="tutupModalTolak()" style="flex:1;padding:10px;border:1.5px solid #e2e8f0;border-radius:8px;background:#fff;font-size:13.5px;font-weight:600;color:#64748b;cursor:pointer">
                            Batal
                        </button>
                        <button type="button" onclick="konfirmasiTolak()" style="flex:1;padding:10px;border:none;border-radius:8px;background:#ef4444;font-size:13.5px;font-weight:700;color:#fff;cursor:pointer">
                            Ya, Tolak Permohonan
                        </button>
                    </div>
                </div>
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
                            <div class="tl-dot {{ in_array($data->approval->status, ['disetujui','siap_diambil','selesai']) ? 'approved' : 'rejected' }}">
                                @if(in_array($data->approval->status, ['disetujui','siap_diambil','selesai']))
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="20 6 9 17 4 12"/></svg>
                                @else
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
                                @endif
                            </div>
                            <div class="tl-body">
                                <p>{{ in_array($data->approval->status, ['disetujui','siap_diambil','selesai']) ? 'Permohonan Disetujui ✅' : 'Permohonan Ditolak ❌' }}</p>
                                <small>{{ \Carbon\Carbon::parse($data->approval->tanggal_approval)->format('d M Y, H:i') }} WIB</small>
                            </div>
                        </li>
                        @if(in_array($data->approval->status, ['siap_diambil', 'selesai']))
                        <li class="tl-item">
                            <div class="tl-dot orange">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M5 8h14M5 8a2 2 0 110-4h14a2 2 0 110 4M5 8v10a2 2 0 002 2h10a2 2 0 002-2V8m-9 4h4"/>
                                </svg>
                            </div>
                            <div class="tl-body">
                                <p>Surat Siap Diambil 📦</p>
                                <small>{{ $data->approval->tanggal_siap_diambil ? \Carbon\Carbon::parse($data->approval->tanggal_siap_diambil)->format('d M Y, H:i').' WIB' : '-' }}</small>
                            </div>
                        </li>
                        @endif
                        @if($data->approval->status === 'selesai')
                        <li class="tl-item">
                            <div class="tl-dot selesai">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5">
                                    <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                            </div>
                            <div class="tl-body">
                                <p>Surat Sudah Diambil ✅</p>
                                <small>{{ $data->approval->tanggal_selesai ? \Carbon\Carbon::parse($data->approval->tanggal_selesai)->format('d M Y, H:i').' WIB' : '-' }}</small>
                            </div>
                        </li>
                        @endif
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

@include('Admin.partials.footer')

@push('scripts')
<script>
/* ── Modal Tolak Permohonan ── */
function showModalTolak() {
    var modal = document.getElementById('modal-tolak');
    modal.style.display = 'flex';
    document.getElementById('textarea-catatan-reject').value = '';
    document.getElementById('textarea-catatan-reject').focus();
}
function tutupModalTolak() {
    document.getElementById('modal-tolak').style.display = 'none';
}
function konfirmasiTolak() {
    var catatan = document.getElementById('textarea-catatan-reject').value.trim();
    document.getElementById('input-catatan-reject').value = catatan;
    document.getElementById('form-reject-show').submit();
}
// Tutup modal jika klik di luar kotak
document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('modal-tolak').addEventListener('click', function(e) {
        if (e.target === this) tutupModalTolak();
    });
});
</script>
<script>
function isWrappedBold(val) {
    var t = (val || '').trim();
    return t.length > 3 && t.startsWith('**') && t.endsWith('**');
}

function toggleBoldField(id) {
    var el = document.getElementById(id);
    if (!el) return;
    var start = el.selectionStart, end = el.selectionEnd, val = el.value;

    if (start !== null && end !== null && start !== end) {
        // Ada teks yang di-select -> bold/un-bold hanya bagian itu
        var selected = val.slice(start, end);
        var already = isWrappedBold(selected);
        var replacement = already ? selected.trim().slice(2, -2) : '**' + selected + '**';
        el.value = val.slice(0, start) + replacement + val.slice(end);
        el.focus();
        el.setSelectionRange(start, start + replacement.length);
    } else {
        // Tidak ada seleksi -> bold/un-bold seluruh isi field
        var already2 = isWrappedBold(val);
        el.value = already2 ? val.trim().slice(2, -2) : (val.trim() ? '**' + val.trim() + '**' : '');
        el.focus();
    }
    syncBoldButton(id);
}

function syncBoldButton(id) {
    var el = document.getElementById(id);
    var btn = document.getElementById('bold_' + id);
    var preview = document.getElementById('preview_' + id);
    if (el && btn) btn.classList.toggle('is-active', isWrappedBold(el.value));
    if (el && preview) {
        var val = (el.value || '').trim();
        if (!val) { preview.innerHTML = ''; }
        else if (isWrappedBold(val)) { preview.innerHTML = 'Tampil di surat: <strong>' + val.slice(2, -2) + '</strong>'; }
        else { preview.innerHTML = ''; }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('[id^="extra_"]').forEach(function(el) {
        syncBoldButton(el.id);
        // Shortcut Ctrl/Cmd+B: sama seperti tombol B, tapi tanpa perlu lepas keyboard
        el.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key.toLowerCase() === 'b') {
                e.preventDefault();
                toggleBoldField(el.id);
            }
        });
    });
});
</script>
@endpush

{{-- ══ MODAL KIRIM WA + PILIH TTD ══ --}}
<div id="modal-kirim-wa" style="display:none;position:fixed;inset:0;z-index:2000;background:rgba(15,23,42,.5);backdrop-filter:blur(3px);align-items:center;justify-content:center;">
    <div style="background:#fff;border-radius:16px;width:100%;max-width:500px;margin:16px;box-shadow:0 24px 64px rgba(0,0,0,.2);overflow:hidden">
        <div style="padding:18px 22px 14px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between">
            <div>
                <div style="font-size:15px;font-weight:800;color:#0f172a">📱 Kirim Surat via WhatsApp</div>
                <div style="font-size:12px;color:#64748b;margin-top:2px" id="wa-modal-sub">-</div>
            </div>
            <button onclick="closeModalKirimWa()" style="width:30px;height:30px;border-radius:7px;border:1px solid #e2e8f0;background:#fff;cursor:pointer;font-size:16px;color:#64748b;display:flex;align-items:center;justify-content:center">&times;</button>
        </div>
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
    const btn = document.getElementById('btn-kirim-wa-submit');
    btn.disabled = true;
    btn.innerHTML = `<svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> Generate PDF & Kirim WA`;
    _waTtdId = null;
}

function submitKirimWa() {
    if (!_waPermohonanId) return;
    if (!_waTtdId) { showToastWa('⚠️ Pilih tanda tangan terlebih dahulu!', 'warning'); return; }
    const btn = document.getElementById('btn-kirim-wa-submit');
    btn.disabled = true;
    btn.textContent = '⏳ Mengirim...';

    fetch('/admin/permohonan/' + _waPermohonanId + '/kirim-wa', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json', 'X-CSRF-TOKEN': _waCsrfToken, 'X-Requested-With': 'XMLHttpRequest' },
        body: JSON.stringify({ ttd_id: _waTtdId }),
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) { closeModalKirimWa(); showToastWa('✅ ' + data.message, 'success'); }
        else { showToastWa('❌ ' + data.message, 'danger'); }
    })
    .catch(() => { showToastWa('❌ Terjadi kesalahan. Coba lagi.', 'danger'); })
    .finally(() => {
        btn.disabled = false;
        btn.innerHTML = `<svg viewBox="0 0 24 24" fill="currentColor" style="width:14px;height:14px"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg> Generate PDF & Kirim WA`;
    });
}

function showToastWa(msg, type) {
    const t = document.createElement('div');
    const bg = type==='success'?'#15803d':type==='warning'?'#d97706':'#dc2626';
    t.style.cssText = `position:fixed;bottom:24px;right:24px;z-index:9999;padding:12px 20px;border-radius:10px;font-size:13px;font-weight:600;color:#fff;background:${bg};box-shadow:0 4px 16px rgba(0,0,0,.2)`;
    t.textContent = msg;
    document.body.appendChild(t);
    setTimeout(() => t.remove(), 4000);
}

function escH(s) { return String(s).replace(/[&<>"]/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c])); }

document.getElementById('modal-kirim-wa').addEventListener('click', function(e) { if (e.target === this) closeModalKirimWa(); });
document.addEventListener('keydown', e => { if (e.key === 'Escape') closeModalKirimWa(); });
</script>

@endsection