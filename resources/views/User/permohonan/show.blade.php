<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{
    --blue:#1c64f2;--blue-dk:#1a56db;--blue-lt:#eff6ff;
    --navy:#0d1b3e;--slate:#334155;--muted:#64748b;
    --border:#e2e8f0;--bg:#f1f5f9;
    --green:#059669;--orange:#f59e0b;--red:#ef4444;
}
*,*::before,*::after{box-sizing:border-box}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:14px;min-height:100vh;display:flex;flex-direction:column}

.page-outer{max-width:1100px;margin:0 auto;padding:24px 24px 60px;flex:1}

/* BREADCRUMB */
.bc{font-size:12px;color:var(--muted);margin-bottom:20px;display:flex;align-items:center;gap:5px;flex-wrap:wrap}
.bc a{color:var(--muted);text-decoration:none}.bc a:hover{color:var(--blue)}
.bc .cur{color:var(--blue);font-weight:700}

/* HERO */
.hero{border-radius:18px;overflow:hidden;margin-bottom:24px;box-shadow:0 8px 32px rgba(0,0,0,.14)}
.hero-top{padding:28px 32px 0;position:relative;overflow:hidden}
.hero-top.pending  {background:linear-gradient(135deg,#1e3a8a 0%,#1c64f2 55%,#3b82f6 100%)}
.hero-top.disetujui{background:linear-gradient(135deg,#064e3b 0%,#059669 55%,#34d399 100%)}
.hero-top.ditolak  {background:linear-gradient(135deg,#7f1d1d 0%,#dc2626 55%,#f87171 100%)}
.hero-top::before{content:'';position:absolute;right:-60px;top:-60px;width:240px;height:240px;border-radius:50%;border:48px solid rgba(255,255,255,.06);pointer-events:none}
.hero-top::after{content:'';position:absolute;right:80px;bottom:-40px;width:140px;height:140px;border-radius:50%;border:28px solid rgba(255,255,255,.04);pointer-events:none}
.hero-inner{position:relative;z-index:1;display:flex;align-items:flex-start;gap:20px;margin-bottom:20px}
.hero-ico{width:56px;height:56px;border-radius:14px;background:rgba(255,255,255,.18);display:flex;align-items:center;justify-content:center;font-size:24px;color:white;flex-shrink:0}
.hero-txt{flex:1}
.hero-title{font-size:22px;font-weight:800;color:white;margin:0 0 6px;line-height:1.25}
.hero-sub{font-size:12.5px;color:rgba(255,255,255,.72);margin:0 0 10px}
.hero-pill{display:inline-flex;align-items:center;gap:7px;background:rgba(255,255,255,.18);border:1px solid rgba(255,255,255,.3);border-radius:20px;padding:5px 14px;font-size:12px;font-weight:700;color:white}
.hero-pill .dot{width:8px;height:8px;border-radius:50%;background:white}
.hero-pill .dot.pulse{animation:p 1.5s infinite}
@keyframes p{0%,100%{opacity:1;transform:scale(1)}50%{opacity:.4;transform:scale(.75)}}
.btn-back-hero{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:10px;border:1.5px solid rgba(255,255,255,.35);background:rgba(255,255,255,.15);font-size:13px;font-weight:700;color:white;text-decoration:none;transition:all .15s;white-space:nowrap;flex-shrink:0;align-self:flex-start}
.btn-back-hero:hover{background:rgba(255,255,255,.28);color:white}

/* HERO STATS */
.hero-stats{display:grid;grid-template-columns:repeat(4,1fr);background:rgba(0,0,0,.2)}
.hs{padding:14px 20px;border-right:1px solid rgba(255,255,255,.1);text-align:center}
.hs:last-child{border-right:none}
.hs-label{font-size:10px;font-weight:700;color:rgba(255,255,255,.6);text-transform:uppercase;letter-spacing:.07em;margin-bottom:4px}
.hs-val{font-size:15px;font-weight:800;color:white}

/* SECTION */
.sec{background:white;border:1px solid var(--border);border-radius:16px;overflow:hidden;margin-bottom:18px;box-shadow:0 1px 4px rgba(0,0,0,.05)}
.sec-head{padding:14px 24px;border-bottom:1px solid var(--border);background:#f8fafc;display:flex;align-items:center;gap:10px}
.sec-icon{width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0}
.sec-title{font-size:14px;font-weight:700;color:var(--navy);flex:1}

/* FIELD GRID - full 4 kolom */
.fg{display:grid;grid-template-columns:repeat(4,1fr)}
.fi{padding:14px 24px;border-bottom:1px solid #f3f4f6;border-right:1px solid #f3f4f6}
.fi:nth-child(4n){border-right:none}
.fi.c2{grid-column:span 2}
.fi.c3{grid-column:span 3}
.fi.c4{grid-column:span 4}
/* last row - remove bottom border on last 4 items */
.fg .fi:nth-last-child(-n+4){border-bottom:none}
.fl{font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);margin-bottom:5px}
.fv{font-size:14px;color:var(--navy);font-weight:500;line-height:1.5}
.fv.mono{font-family:'Courier New',monospace;font-size:13px;letter-spacing:.03em}

/* BEDA NAMA */
.nama-compare{display:grid;grid-template-columns:1fr 60px 1fr;margin:0}
.nc-head{background:#f8fafc;padding:11px 24px;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:var(--muted);border-bottom:1px solid var(--border)}
.nc-val{padding:18px 24px;font-size:15px;font-weight:700;color:var(--navy)}
.nc-mid{display:flex;align-items:center;justify-content:center;background:#f1f5f9;border-left:1px solid var(--border);border-right:1px solid var(--border)}
.nc-mid.head{border-bottom:1px solid var(--border)}
.nc-note{padding:12px 24px;background:#fffbeb;border-top:1px solid #fde68a;font-size:12.5px;color:#92400e;display:flex;align-items:center;gap:8px}

/* DOKUMEN */
.dok-item{display:flex;align-items:center;gap:16px;padding:14px 24px;border-bottom:1px solid #f3f4f6;text-decoration:none;color:var(--navy);transition:background .15s}
.dok-item:last-child{border-bottom:none}
.dok-item:hover{background:#f8fafc}
.dok-ico{width:42px;height:42px;border-radius:11px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
.dok-ico.img{background:#e0f2fe;color:#0284c7}
.dok-ico.pdf{background:#fee2e2;color:var(--red)}
.dok-ico.other{background:var(--blue-lt);color:var(--blue)}
.dok-info{flex:1;min-width:0}
.dok-name{font-size:13.5px;font-weight:700;color:var(--navy);white-space:nowrap;overflow:hidden;text-overflow:ellipsis}
.dok-meta{font-size:11px;color:var(--muted);margin-top:3px}
.dok-btn{display:inline-flex;align-items:center;gap:6px;padding:7px 16px;border-radius:8px;background:var(--blue-lt);color:var(--blue);font-size:12px;font-weight:700;white-space:nowrap}
.empty-dok{padding:32px;text-align:center;color:var(--muted)}

/* TIMELINE */
.tl-wrap{padding:20px 24px;display:grid;grid-template-columns:repeat(3,1fr);gap:0}
.tl-item{display:flex;flex-direction:column;align-items:center;text-align:center;position:relative;padding:0 16px}
.tl-item:not(:last-child)::after{content:'';position:absolute;top:18px;left:calc(50% + 20px);right:calc(-50% + 20px);height:2px;background:var(--border)}
.tl-dot{width:36px;height:36px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:15px;z-index:1;position:relative;margin-bottom:10px;border:3px solid white;box-shadow:0 0 0 2px var(--border)}
.tl-blue  {background:var(--blue-lt);color:var(--blue);box-shadow:0 0 0 2px #bfdbfe}
.tl-green {background:#ecfdf5;color:var(--green);box-shadow:0 0 0 2px #a7f3d0}
.tl-orange{background:#fffbeb;color:var(--orange);box-shadow:0 0 0 2px #fde68a}
.tl-red   {background:#fef2f2;color:var(--red);box-shadow:0 0 0 2px #fecaca}
.tl-gray  {background:#f3f4f6;color:#9ca3af;box-shadow:0 0 0 2px #e5e7eb}
.tl-title{font-size:12.5px;font-weight:700;color:var(--navy);margin-bottom:3px}
.tl-time {font-size:11px;color:var(--muted)}

/* STATUS SUMMARY (bawah hero - bar info) */
.status-bar{background:white;border:1px solid var(--border);border-radius:14px;padding:16px 24px;margin-bottom:18px;display:flex;align-items:center;gap:20px;box-shadow:0 1px 4px rgba(0,0,0,.05)}
.sb-status{display:flex;align-items:center;gap:10px}
.sb-icon{width:44px;height:44px;border-radius:12px;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
.sb-icon.pending  {background:var(--blue-lt);color:var(--blue)}
.sb-icon.disetujui{background:#ecfdf5;color:var(--green)}
.sb-icon.ditolak  {background:#fef2f2;color:var(--red)}
.sb-label{font-size:11px;color:var(--muted);margin-bottom:2px}
.sb-val{font-size:16px;font-weight:800}
.sb-val.pending  {color:var(--blue)}
.sb-val.disetujui{color:var(--green)}
.sb-val.ditolak  {color:var(--red)}
.sb-divider{width:1px;height:44px;background:var(--border);flex-shrink:0}
.sb-info{display:flex;flex-direction:column;gap:2px}
.sb-info-label{font-size:11px;color:var(--muted)}
.sb-info-val{font-size:13px;font-weight:700;color:var(--navy)}

/* ACTIONS */
.act{display:flex;gap:12px;flex-wrap:wrap;margin-top:4px}
.btn-back-act{display:inline-flex;align-items:center;gap:7px;padding:11px 22px;border-radius:10px;border:1.5px solid var(--border);background:white;color:var(--slate);font-size:13px;font-weight:700;text-decoration:none;transition:all .15s}
.btn-back-act:hover{border-color:var(--blue);color:var(--blue)}
.btn-del{display:inline-flex;align-items:center;gap:7px;padding:11px 22px;border-radius:10px;background:#fef2f2;border:1.5px solid #fecaca;color:#991b1b;font-size:13px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .15s}
.btn-del:hover{background:#fee2e2}

/* MODAL */
.modal-ov{position:fixed;inset:0;background:rgba(0,0,0,.5);z-index:9999;display:flex;align-items:center;justify-content:center;padding:16px;opacity:0;pointer-events:none;transition:opacity .2s}
.modal-ov.show{opacity:1;pointer-events:all}
.modal-box{background:white;border-radius:20px;padding:32px;max-width:440px;width:100%;box-shadow:0 24px 64px rgba(0,0,0,.2);transform:translateY(14px);transition:transform .22s}
.modal-ov.show .modal-box{transform:translateY(0)}
.modal-ico{width:60px;height:60px;border-radius:50%;background:#fef2f2;border:2px solid #fecaca;display:flex;align-items:center;justify-content:center;font-size:26px;color:var(--red);margin:0 0 18px}
.modal-title{font-size:19px;font-weight:800;color:var(--navy);margin-bottom:10px}
.modal-desc{font-size:13.5px;color:var(--muted);line-height:1.7;margin-bottom:24px}
.modal-acts{display:flex;gap:12px}
.btn-cm{flex:1;padding:12px;border-radius:10px;font-size:13px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .15s;border:none}
.btn-cm.cancel{background:#f1f5f9;color:var(--slate)}.btn-cm.cancel:hover{background:var(--border)}
.btn-cm.confirm{background:var(--red);color:white}.btn-cm.confirm:hover{background:#dc2626}

/* ALERTS */
.al-ok {background:#ecfdf5;border:1px solid #a7f3d0;border-radius:10px;padding:12px 18px;font-size:13px;color:#065f46;display:flex;align-items:center;gap:8px;margin-bottom:16px}
.al-err{background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 18px;font-size:13px;color:#991b1b;display:flex;align-items:center;gap:8px;margin-bottom:16px}

/* CATATAN PENOLAKAN */
.tolak-box{background:#fef2f2;border:1.5px solid #fecaca;border-radius:12px;padding:16px 20px;margin-bottom:18px;display:flex;gap:12px;align-items:flex-start}
.tolak-box i{color:var(--red);font-size:18px;flex-shrink:0;margin-top:1px}
</style>
</head>
<body>

@include('partials.navbar-user')

<div class="page-outer">

    <div class="bc">
        <a href="{{ url('/') }}">Beranda</a>
        <i class="bi bi-chevron-right" style="font-size:10px"></i>
        <a href="{{ route('user.permohonan.index') }}">Permohonan Saya</a>
        <i class="bi bi-chevron-right" style="font-size:10px"></i>
        <span class="cur">Detail #{{ $permohonan->id_permohonan }}</span>
    </div>

    @if(session('success'))
    <div class="al-ok"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="al-err"><i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}</div>
    @endif

    @php
        $status = $permohonan->approval->status ?? 'pending';

        // Decode data_tambahan — handle array, string JSON, dan double-encoded
        $dtRaw = $permohonan->data_tambahan;
        if (is_array($dtRaw)) {
            $dt = $dtRaw;
        } elseif (is_string($dtRaw)) {
            $decoded = json_decode($dtRaw, true);
            // Handle double-encoded: jika hasil decode masih string, decode lagi
            if (is_string($decoded)) {
                $dt = json_decode($decoded, true) ?? [];
            } else {
                $dt = $decoded ?? [];
            }
        } else {
            $dt = [];
        }
        $jenis = $dt['jenis'] ?? null;

        $tgl = fn($t) => $t ? \Carbon\Carbon::parse($t)->isoFormat('D MMMM Y') : '-';
        $dokCount = $permohonan->persyaratan->count();
    @endphp

    {{-- HERO BANNER --}}
    <div class="hero">
        <div class="hero-top {{ $status }}">
            <div class="hero-inner">
                <div class="hero-ico">
                    @if($status==='disetujui') <i class="bi bi-check-circle-fill"></i>
                    @elseif($status==='ditolak') <i class="bi bi-x-circle-fill"></i>
                    @else <i class="bi bi-hourglass-split"></i>
                    @endif
                </div>
                <div class="hero-txt">
                    <div class="hero-title">{{ $permohonan->jenisSurat->nama_surat ?? 'Permohonan Surat' }}</div>
                    <div class="hero-sub">
                        No. Permohonan #{{ $permohonan->id_permohonan }}
                        &nbsp;·&nbsp;
                        Diajukan {{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->isoFormat('D MMMM Y, HH:mm') }} WIB
                    </div>
                    <div class="hero-pill">
                        <span class="dot {{ $status === 'pending' ? 'pulse' : '' }}"></span>
                        @if($status==='disetujui') Permohonan Disetujui
                        @elseif($status==='ditolak') Permohonan Ditolak
                        @else Menunggu Proses Admin
                        @endif
                    </div>
                </div>
                <a href="{{ route('user.permohonan.index') }}" class="btn-back-hero">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
        <div class="hero-stats">
            <div class="hs">
                <div class="hs-label">Pemohon</div>
                <div class="hs-val">{{ Str::limit($permohonan->nama_pemohon ?? auth()->user()->nama ?? '-', 18) }}</div>
            </div>
            <div class="hs">
                <div class="hs-label">Tanggal Pengajuan</div>
                <div class="hs-val">{{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->format('d M Y') }}</div>
            </div>
            <div class="hs">
                <div class="hs-label">Dokumen Dilampirkan</div>
                <div class="hs-val">{{ $dokCount }} File</div>
            </div>
            <div class="hs">
                <div class="hs-label">Status</div>
                <div class="hs-val">{{ $status === 'disetujui' ? 'Disetujui ✅' : ($status === 'ditolak' ? 'Ditolak ❌' : 'Pending ⏳') }}</div>
            </div>
        </div>
    </div>

    {{-- CATATAN PENOLAKAN --}}
    @if($status === 'ditolak' && ($permohonan->approval->catatan ?? false))
    <div class="tolak-box">
        <i class="bi bi-exclamation-triangle-fill"></i>
        <div>
            <div style="font-size:13px;font-weight:700;color:#991b1b;margin-bottom:4px">Alasan Penolakan:</div>
            <div style="font-size:13px;color:#7f1d1d">{{ $permohonan->approval->catatan }}</div>
        </div>
    </div>
    @endif

    {{-- ══ DATA PEMOHON ══ --}}
    <div class="sec">
        <div class="sec-head">
            <div class="sec-icon" style="background:var(--blue-lt);color:var(--blue)"><i class="bi bi-person-fill"></i></div>
            <div class="sec-title">Data Pemohon</div>
            @if($permohonan->nama_pemohon && $permohonan->nama_pemohon !== auth()->user()->nama)
            <span style="font-size:11px;font-weight:700;background:#fffbeb;color:#92400e;border:1px solid #fde68a;border-radius:20px;padding:3px 12px">PERWAKILAN</span>
            @endif
        </div>
        <div class="fg">
            <div class="fi c2">
                <div class="fl">Nama Lengkap</div>
                <div class="fv" style="font-size:15px;font-weight:700">{{ $permohonan->nama_pemohon ?? auth()->user()->nama ?? '-' }}</div>
            </div>
            <div class="fi c2">
                <div class="fl">NIK</div>
                <div class="fv mono" style="font-size:15px;font-weight:700">{{ $permohonan->nik_pemohon ?? auth()->user()->nik ?? '-' }}</div>
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
                <div class="fv">{{ $permohonan->alamat_pemohon ?? auth()->user()->alamat ?? '-' }}</div>
            </div>
            @else
            <div class="fi c4">
                <div class="fl">Alamat Lengkap</div>
                <div class="fv">{{ $permohonan->alamat_pemohon ?? auth()->user()->alamat ?? '-' }}</div>
            </div>
            @endif
            @else
            <div class="fi c4">
                <div class="fl">Alamat Lengkap</div>
                <div class="fv">{{ $permohonan->alamat_pemohon ?? auth()->user()->alamat ?? '-' }}</div>
            </div>
            @endif
        </div>
    </div>

    {{-- ══ DATA KHUSUS PER JENIS ══ --}}

    @if($jenis === 'sktm')
    <div class="sec">
        <div class="sec-head">
            <div class="sec-icon" style="background:#ecfdf5;color:var(--green)"><i class="bi bi-file-text-fill"></i></div>
            <div class="sec-title">Keperluan Surat Keterangan Tidak Mampu (SKTM)</div>
        </div>
        <div class="fg">
            <div class="fi c2">
                <div class="fl">Tujuan / Keperluan SKTM</div>
                <div class="fv">{{ $dt['keperluan_sktm'] ?? $permohonan->keperluan ?? '-' }}</div>
            </div>
            <div class="fi c2">
                <div class="fl">Keterangan Tambahan</div>
                <div class="fv">{{ $dt['keterangan_tambahan'] ?? '-' }}</div>
            </div>
        </div>
    </div>

    @elseif($jenis === 'kematian')
    <div class="sec">
        <div class="sec-head">
            <div class="sec-icon" style="background:#ecfdf5;color:var(--green)"><i class="bi bi-file-earmark-medical-fill"></i></div>
            <div class="sec-title">Data Kematian Almarhum / Almarhumah</div>
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
                <div class="fv">{{ $permohonan->keperluan ?? '-' }}</div>
            </div>
        </div>
    </div>

    @elseif($jenis === 'suami-istri')
    <div class="sec">
        <div class="sec-head">
            <div class="sec-icon" style="background:#fff1f2;color:#f43f5e"><i class="bi bi-people-fill"></i></div>
            <div class="sec-title">Data Istri & Pernikahan</div>
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
                <div class="fl">Tempat / Tanggal Lahir Istri</div>
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
                <div class="fv">{{ $dt['tahun_menikah'] ?? '-' }}</div>
            </div>
            <div class="fi c4">
                <div class="fl">Alamat Istri</div>
                <div class="fv">{{ !empty($dt['alamat_istri']) ? $dt['alamat_istri'] : 'Sama dengan alamat suami' }}</div>
            </div>
        </div>
    </div>

    @elseif($jenis === 'beda-nama')
    <div class="sec">
        <div class="sec-head">
            <div class="sec-icon" style="background:#fffbeb;color:#d97706"><i class="bi bi-arrow-left-right"></i></div>
            <div class="sec-title">Detail Perbedaan Nama pada Dokumen</div>
        </div>
        <div class="nama-compare">
            <div class="nc-head">Nama di KTP</div>
            <div class="nc-mid head" style="font-size:11px;font-weight:700;color:var(--muted);text-align:center">VS</div>
            <div class="nc-head">Nama di {{ $dt['jenis_dokumen_2'] ?? 'Dokumen Lain' }}</div>
            <div class="nc-val">{{ $dt['nama_dokumen_1'] ?? ($permohonan->nama_pemohon ?? '-') }}</div>
            <div class="nc-mid"><i class="bi bi-arrow-left-right" style="font-size:18px;color:var(--muted)"></i></div>
            <div class="nc-val">{{ $dt['nama_dokumen_2'] ?? '-' }}</div>
        </div>
        <div class="nc-note">
            <i class="bi bi-info-circle-fill" style="flex-shrink:0"></i>
            Kedua nama di atas adalah satu orang yang sama dan akan dinyatakan resmi dalam surat keterangan ini.
        </div>
        <div class="fg" style="border-top:1px solid var(--border)">
            <div class="fi c2">
                <div class="fl">Jenis Dokumen Pembanding</div>
                <div class="fv">{{ $dt['jenis_dokumen_2'] ?? '-' }}</div>
            </div>
            <div class="fi c2">
                <div class="fl">Keperluan Surat</div>
                <div class="fv">{{ $permohonan->keperluan ?? '-' }}</div>
            </div>
        </div>
    </div>

    @elseif($jenis === 'izin-cuti')
    <div class="sec">
        <div class="sec-head">
            <div class="sec-icon" style="background:var(--blue-lt);color:var(--blue)"><i class="bi bi-calendar-check-fill"></i></div>
            <div class="sec-title">Detail Izin Cuti</div>
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
                <div class="fl">Keperluan / Alasan Cuti</div>
                <div class="fv">{{ $permohonan->keperluan ?? '-' }}</div>
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

    {{-- KEPERLUAN UMUM jika bukan sktm/izin-cuti atau jenis NULL --}}
    @if(!in_array($jenis, ['sktm','kematian','suami-istri','beda-nama','izin-cuti']))
    <div class="sec">
        <div class="sec-head">
            <div class="sec-icon" style="background:var(--blue-lt);color:var(--blue)"><i class="bi bi-chat-left-text-fill"></i></div>
            <div class="sec-title">Keperluan / Tujuan Surat</div>
        </div>
        <div class="fg">
            <div class="fi c4">
                <div class="fl">Keperluan</div>
                <div class="fv" style="font-size:15px">{{ $permohonan->keperluan ?? '-' }}</div>
            </div>
        </div>
    </div>
    @endif

    {{-- DOKUMEN --}}
    <div class="sec">
        <div class="sec-head">
            <div class="sec-icon" style="background:var(--blue-lt);color:var(--blue)"><i class="bi bi-paperclip"></i></div>
            <div class="sec-title">Dokumen Persyaratan yang Dilampirkan</div>
            @if($dokCount)
            <span style="margin-left:auto;font-size:12px;font-weight:700;background:var(--blue-lt);color:var(--blue);border-radius:20px;padding:3px 12px">{{ $dokCount }} file</span>
            @endif
        </div>
        @forelse($permohonan->persyaratan as $dok)
        @php
            $ext   = strtolower(pathinfo($dok->nama_file ?? '', PATHINFO_EXTENSION));
            $isImg = in_array($ext, ['jpg','jpeg','png','webp']);
            $isPdf = $ext === 'pdf';
            $ic    = $isImg ? 'img' : ($isPdf ? 'pdf' : 'other');
            $icon  = $isImg ? 'bi-file-earmark-image-fill' : ($isPdf ? 'bi-file-earmark-pdf-fill' : 'bi-file-earmark-fill');
        @endphp
        <a href="{{ asset('storage/'.$dok->path_file) }}" target="_blank" class="dok-item">
            <div class="dok-ico {{ $ic }}"><i class="bi {{ $icon }}"></i></div>
            <div class="dok-info">
                <div class="dok-name">{{ $dok->nama_file }}</div>
                <div class="dok-meta">
                    {{ strtoupper($ext) }}
                    @if($dok->jenis_dokumen) &nbsp;·&nbsp; Jenis: {{ strtoupper($dok->jenis_dokumen) }}@endif
                    @if($dok->uploaded_at) &nbsp;·&nbsp; Diupload {{ \Carbon\Carbon::parse($dok->uploaded_at)->isoFormat('D MMMM Y') }}@endif
                </div>
            </div>
            <span class="dok-btn">Lihat File <i class="bi bi-box-arrow-up-right"></i></span>
        </a>
        @empty
        <div class="empty-dok">
            <i class="bi bi-paperclip" style="font-size:32px;display:block;margin-bottom:10px;color:var(--border)"></i>
            <div style="font-weight:600;margin-bottom:4px">Tidak ada dokumen</div>
            <div style="font-size:12px">Belum ada dokumen yang dilampirkan pada permohonan ini</div>
        </div>
        @endforelse
    </div>

    {{-- TIMELINE --}}
    <div class="sec">
        <div class="sec-head">
            <div class="sec-icon" style="background:#fffbeb;color:var(--orange)"><i class="bi bi-clock-history"></i></div>
            <div class="sec-title">Riwayat & Progres Permohonan</div>
        </div>
        <div class="tl-wrap">
            <div class="tl-item">
                <div class="tl-dot tl-blue"><i class="bi bi-send-fill"></i></div>
                <div class="tl-title">Permohonan Dikirim</div>
                <div class="tl-time">{{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->isoFormat('D MMM Y, HH:mm') }} WIB</div>
            </div>
            <div class="tl-item">
                @if($status === 'pending')
                <div class="tl-dot tl-orange"><i class="bi bi-hourglass-split"></i></div>
                <div class="tl-title">Sedang Diverifikasi</div>
                <div class="tl-time">Estimasi 1–2 hari kerja</div>
                @elseif($status === 'disetujui')
                <div class="tl-dot tl-green"><i class="bi bi-check-lg"></i></div>
                <div class="tl-title">Diverifikasi Admin</div>
                <div class="tl-time">{{ $permohonan->approval->tanggal_approval ? \Carbon\Carbon::parse($permohonan->approval->tanggal_approval)->isoFormat('D MMM Y') : 'Selesai' }}</div>
                @elseif($status === 'ditolak')
                <div class="tl-dot tl-red"><i class="bi bi-x-lg"></i></div>
                <div class="tl-title">Diverifikasi Admin</div>
                <div class="tl-time">{{ $permohonan->approval->tanggal_approval ? \Carbon\Carbon::parse($permohonan->approval->tanggal_approval)->isoFormat('D MMM Y') : 'Selesai' }}</div>
                @endif
            </div>
            <div class="tl-item">
                @if($status === 'disetujui')
                <div class="tl-dot tl-green"><i class="bi bi-check-circle-fill"></i></div>
                <div class="tl-title">Permohonan Disetujui ✅</div>
                <div class="tl-time">Surat siap diambil di kantor kelurahan</div>
                @elseif($status === 'ditolak')
                <div class="tl-dot tl-red"><i class="bi bi-x-circle-fill"></i></div>
                <div class="tl-title">Permohonan Ditolak</div>
                <div class="tl-time">Lihat alasan penolakan di atas</div>
                @else
                <div class="tl-dot tl-gray"><i class="bi bi-circle"></i></div>
                <div class="tl-title" style="color:var(--muted)">Menunggu Keputusan</div>
                <div class="tl-time">Belum diproses</div>
                @endif
            </div>
        </div>
    </div>

    {{-- ACTIONS --}}
    <div class="act">
        <a href="{{ route('user.permohonan.index') }}" class="btn-back-act">
            <i class="bi bi-arrow-left"></i> Kembali ke Daftar Permohonan
        </a>
        @if(!$permohonan->approval || strtolower($status) === 'pending')
        <button type="button" class="btn-del" onclick="openModal()">
            <i class="bi bi-trash3"></i> Batalkan Permohonan Ini
        </button>
        @endif
    </div>

</div>

{{-- MODAL --}}
<div class="modal-ov" id="modalBatal">
    <div class="modal-box">
        <div class="modal-ico"><i class="bi bi-exclamation-triangle-fill"></i></div>
        <div class="modal-title">Batalkan Permohonan?</div>
        <p class="modal-desc">
            Anda akan membatalkan permohonan <strong>{{ $permohonan->jenisSurat->nama_surat ?? '' }}</strong>
            atas nama <strong>{{ $permohonan->nama_pemohon ?? auth()->user()->nama }}</strong>.
            Tindakan ini <strong>tidak dapat dibatalkan</strong> dan semua data permohonan akan dihapus.
        </p>
        <div class="modal-acts">
            <button class="btn-cm cancel" onclick="closeModal()">Tidak, Kembali</button>
            <form method="POST" action="{{ route('user.permohonan.destroy', $permohonan->id_permohonan) }}" style="flex:1">
                @csrf @method('DELETE')
                <button type="submit" class="btn-cm confirm" style="width:100%">Ya, Batalkan Sekarang</button>
            </form>
        </div>
    </div>
</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
function openModal()  { document.getElementById('modalBatal').classList.add('show'); document.body.style.overflow='hidden'; }
function closeModal() { document.getElementById('modalBatal').classList.remove('show'); document.body.style.overflow=''; }
document.getElementById('modalBatal').addEventListener('click', e => { if(e.target===document.getElementById('modalBatal')) closeModal(); });
document.addEventListener('keydown', e => { if(e.key==='Escape') closeModal(); });
</script>
</body>
</html>