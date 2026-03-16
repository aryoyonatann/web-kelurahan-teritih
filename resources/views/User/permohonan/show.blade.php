<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Permohonan – Kelurahan Teritih</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--blue:#1c64f2;--blue-lt:#eff6ff;--navy:#0f172a;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;--green:#10b981;--orange:#f59e0b;--red:#ef4444}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--navy);font-size:14px}
.page-wrapper{max-width:760px;margin:0 auto;padding:32px 20px 60px}
.breadcrumb-bar{font-size:12px;color:var(--muted);margin-bottom:20px;display:flex;align-items:center;gap:6px;flex-wrap:wrap}
.breadcrumb-bar a{color:var(--muted);text-decoration:none}.breadcrumb-bar a:hover{color:var(--blue)}
.breadcrumb-bar .active{color:var(--blue);font-weight:600}
.hero-card{background:white;border-radius:16px;border:1px solid var(--border);padding:24px;margin-bottom:16px;display:flex;align-items:center;gap:20px}
.hero-icon{width:56px;height:56px;border-radius:14px;display:flex;align-items:center;justify-content:center;font-size:24px;flex-shrink:0}
.hero-title{font-size:18px;font-weight:800;color:var(--navy)}.hero-sub{font-size:12px;color:var(--muted);margin-top:3px}
.bdg{display:inline-flex;align-items:center;gap:5px;padding:4px 12px;border-radius:20px;font-size:12px;font-weight:600}
.bdg::before{content:'';width:6px;height:6px;border-radius:50%}
.bdg-pending{background:#eff6ff;color:var(--blue)}.bdg-pending::before{background:var(--blue)}
.bdg-disetujui{background:#ecfdf5;color:#065f46}.bdg-disetujui::before{background:var(--green)}
.bdg-ditolak{background:#fef2f2;color:#991b1b}.bdg-ditolak::before{background:var(--red)}
.detail-card{background:white;border-radius:14px;border:1px solid var(--border);overflow:hidden;margin-bottom:16px}
.detail-card-header{padding:14px 20px;border-bottom:1px solid var(--border);font-size:13px;font-weight:700;color:var(--navy);display:flex;align-items:center;gap:8px}
.detail-card-header i{color:var(--blue)}
.detail-grid{display:grid;grid-template-columns:1fr 1fr}
.detail-row{padding:13px 20px;border-bottom:1px solid var(--border)}
.detail-row:nth-last-child(-n+2){border-bottom:none}
.detail-row.full{grid-column:span 2}
.detail-label{font-size:11px;font-weight:600;text-transform:uppercase;letter-spacing:.04em;color:var(--muted);margin-bottom:4px}
.detail-value{font-size:13px;color:var(--navy);font-weight:500}
.dok-item{display:flex;align-items:center;gap:12px;padding:12px 20px;border-bottom:1px solid var(--border);text-decoration:none;color:var(--navy);transition:background .15s}
.dok-item:last-child{border-bottom:none}.dok-item:hover{background:var(--bg)}
.dok-icon{width:36px;height:36px;border-radius:9px;background:var(--blue-lt);color:var(--blue);display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
.dok-name{font-size:13px;font-weight:600;color:var(--navy)}.dok-meta{font-size:11px;color:var(--muted);margin-top:2px}
.timeline{padding:16px 20px}
.tl-item{display:flex;gap:14px;position:relative;padding-bottom:20px}
.tl-item:last-child{padding-bottom:0}
.tl-item:not(:last-child)::before{content:'';position:absolute;left:14px;top:28px;bottom:0;width:2px;background:var(--border)}
.tl-dot{width:28px;height:28px;border-radius:50%;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0;z-index:1}
.tl-dot-blue{background:var(--blue-lt);color:var(--blue)}.tl-dot-green{background:#ecfdf5;color:var(--green)}
.tl-dot-orange{background:#fffbeb;color:var(--orange)}.tl-dot-red{background:#fef2f2;color:var(--red)}
.tl-body{flex:1;padding-top:2px}
.tl-title{font-size:13px;font-weight:600;color:var(--navy)}.tl-time{font-size:11px;color:var(--muted);margin-top:3px}
.btn-back{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:8px;border:1px solid var(--border);background:white;font-size:13px;font-weight:600;color:var(--slate);text-decoration:none;transition:all .18s}
.btn-back:hover{border-color:var(--blue);color:var(--blue)}
.btn-danger{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:8px;border:none;background:#fef2f2;font-size:13px;font-weight:600;color:#991b1b;cursor:pointer;transition:all .18s}
.btn-danger:hover{background:#fee2e2}
.modal-overlay{position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:999;display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .2s}
.modal-overlay.show{opacity:1;pointer-events:all}
.modal-box{background:white;border-radius:16px;padding:28px;width:100%;max-width:400px;box-shadow:0 20px 60px rgba(0,0,0,.2);transform:translateY(16px);transition:transform .2s}
.modal-overlay.show .modal-box{transform:translateY(0)}
.modal-title{font-size:16px;font-weight:700;color:var(--red);margin-bottom:8px}
.modal-desc{font-size:13px;color:var(--muted);line-height:1.6}
.modal-actions{display:flex;gap:10px;margin-top:20px;justify-content:flex-end}
.btn-cancel{padding:8px 18px;border-radius:8px;border:1px solid var(--border);background:white;font-size:13px;font-weight:600;color:var(--slate);cursor:pointer}
.btn-confirm-del{padding:8px 18px;border-radius:8px;border:none;background:var(--red);color:white;font-size:13px;font-weight:600;cursor:pointer}
.alert-success{background:#ecfdf5;border:1px solid #a7f3d0;border-radius:10px;padding:12px 16px;font-size:13px;color:#065f46;display:flex;align-items:center;gap:8px;margin-bottom:16px}
.alert-error{background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 16px;font-size:13px;color:#991b1b;display:flex;align-items:center;gap:8px;margin-bottom:16px}
.catatan-box{background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:14px 16px;font-size:13px;color:#92400e;display:flex;gap:10px;align-items:flex-start;margin-bottom:16px}
</style>
</head>
<body>

@include('partials.navbar')

<div class="page-wrapper">

    <div class="breadcrumb-bar">
        <a href="{{ url('/') }}">Beranda</a>
        <i class="bi bi-chevron-right" style="font-size:10px"></i>
        <a href="{{ route('user.permohonan.index') }}">Permohonan Saya</a>
        <i class="bi bi-chevron-right" style="font-size:10px"></i>
        <span class="active">Detail #{{ $permohonan->id_permohonan }}</span>
    </div>

    @if(session('success'))
    <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="alert-error"><i class="bi bi-exclamation-circle-fill"></i> {{ session('error') }}</div>
    @endif

    @php $status = $permohonan->approval->status ?? 'pending'; @endphp

    <div class="hero-card">
        @if($status === 'disetujui')
            <div class="hero-icon" style="background:#ecfdf5;color:var(--green)"><i class="bi bi-check-circle-fill"></i></div>
        @elseif($status === 'ditolak')
            <div class="hero-icon" style="background:#fef2f2;color:var(--red)"><i class="bi bi-x-circle-fill"></i></div>
        @else
            <div class="hero-icon" style="background:#eff6ff;color:var(--blue)"><i class="bi bi-hourglass-split"></i></div>
        @endif
        <div class="flex-grow-1">
            <div class="hero-title">{{ $permohonan->jenisSurat->nama_surat ?? 'Permohonan Surat' }}</div>
            <div class="hero-sub">
                No. #{{ $permohonan->id_permohonan }}
                @if($permohonan->nama_pemohon && $permohonan->nama_pemohon !== auth()->user()->nama)
                    · Atas nama <strong>{{ $permohonan->nama_pemohon }}</strong>
                @endif
                · Diajukan {{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->diffForHumans() }}
            </div>
            <div class="mt-2">
                <span class="bdg bdg-{{ $status }}">
                    {{ $status === 'disetujui' ? 'Disetujui' : ($status === 'ditolak' ? 'Ditolak' : 'Menunggu Proses') }}
                </span>
            </div>
        </div>
        <a href="{{ route('user.permohonan.index') }}" class="btn-back d-none d-md-inline-flex">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    @if($status === 'ditolak' && ($permohonan->approval->catatan ?? false))
    <div class="catatan-box">
        <i class="bi bi-exclamation-triangle-fill" style="margin-top:1px;flex-shrink:0"></i>
        <div><strong>Alasan Penolakan:</strong><br>{{ $permohonan->approval->catatan }}</div>
    </div>
    @endif

    <div class="detail-card">
        <div class="detail-card-header"><i class="bi bi-file-earmark-text-fill"></i> Detail Permohonan</div>
        <div class="detail-grid">
            <div class="detail-row">
                <div class="detail-label">Nama Pemohon</div>
                <div class="detail-value">{{ $permohonan->nama_pemohon ?? $permohonan->user->nama ?? '-' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">NIK Pemohon</div>
                <div class="detail-value" style="font-family:monospace">{{ $permohonan->nik_pemohon ?? $permohonan->user->nik ?? '-' }}</div>
            </div>
            <div class="detail-row full">
                <div class="detail-label">Alamat Pemohon</div>
                <div class="detail-value">{{ $permohonan->alamat_pemohon ?? $permohonan->user->alamat ?? '-' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Jenis Surat</div>
                <div class="detail-value">{{ $permohonan->jenisSurat->nama_surat ?? '-' }}</div>
            </div>
            <div class="detail-row">
                <div class="detail-label">Tanggal Pengajuan</div>
                <div class="detail-value">{{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->format('d M Y, H:i') }} WIB</div>
            </div>
            <div class="detail-row full">
                <div class="detail-label">Keperluan / Tujuan</div>
                <div class="detail-value">{{ $permohonan->keperluan ?? '-' }}</div>
            </div>
        </div>
    </div>

    <div class="detail-card">
        <div class="detail-card-header"><i class="bi bi-paperclip"></i> Dokumen Persyaratan</div>
        @forelse($permohonan->persyaratan as $dok)
            @php $ext = strtolower(pathinfo($dok->nama_file ?? '', PATHINFO_EXTENSION)); $icon = in_array($ext,['pdf']) ? 'file-earmark-pdf' : (in_array($ext,['jpg','jpeg','png']) ? 'file-earmark-image' : 'file-earmark'); @endphp
            <a href="{{ asset('storage/'.$dok->path_file) }}" target="_blank" class="dok-item">
                <div class="dok-icon"><i class="bi bi-{{ $icon }}"></i></div>
                <div class="flex-grow-1">
                    <div class="dok-name">{{ $dok->nama_file }}</div>
                    <div class="dok-meta">{{ strtoupper($ext) }} · Klik untuk lihat</div>
                </div>
                <i class="bi bi-box-arrow-up-right" style="color:var(--muted);font-size:13px"></i>
            </a>
        @empty
            <div style="padding:20px;text-align:center;color:var(--muted);font-size:13px">
                <i class="bi bi-paperclip" style="font-size:22px;display:block;margin-bottom:6px;color:var(--border)"></i>
                Tidak ada dokumen yang dilampirkan
            </div>
        @endforelse
    </div>

    <div class="detail-card">
        <div class="detail-card-header"><i class="bi bi-clock-history"></i> Riwayat Status</div>
        <div class="timeline">
            <div class="tl-item">
                <div class="tl-dot tl-dot-blue"><i class="bi bi-send-fill"></i></div>
                <div class="tl-body">
                    <div class="tl-title">Permohonan Dikirim</div>
                    <div class="tl-time">{{ \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->format('d M Y, H:i') }} WIB</div>
                </div>
            </div>
            @if($status === 'pending')
            <div class="tl-item">
                <div class="tl-dot tl-dot-orange"><i class="bi bi-hourglass-split"></i></div>
                <div class="tl-body">
                    <div class="tl-title">Menunggu Verifikasi Admin</div>
                    <div class="tl-time">Sedang dalam antrian</div>
                </div>
            </div>
            @elseif($status === 'disetujui')
            <div class="tl-item">
                <div class="tl-dot tl-dot-green"><i class="bi bi-check-lg"></i></div>
                <div class="tl-body">
                    <div class="tl-title">Disetujui oleh Admin</div>
                    <div class="tl-time">{{ $permohonan->approval->updated_at ? \Carbon\Carbon::parse($permohonan->approval->updated_at)->format('d M Y, H:i').' WIB' : 'Sudah diproses' }}</div>
                </div>
            </div>
            @elseif($status === 'ditolak')
            <div class="tl-item">
                <div class="tl-dot tl-dot-red"><i class="bi bi-x-lg"></i></div>
                <div class="tl-body">
                    <div class="tl-title">Ditolak oleh Admin</div>
                    <div class="tl-time">{{ $permohonan->approval->updated_at ? \Carbon\Carbon::parse($permohonan->approval->updated_at)->format('d M Y, H:i').' WIB' : 'Sudah diproses' }}</div>
                </div>
            </div>
            @endif
        </div>
    </div>

    <div class="d-flex gap-2 flex-wrap">
        <a href="{{ route('user.permohonan.index') }}" class="btn-back"><i class="bi bi-arrow-left"></i> Kembali</a>
        @if(!$permohonan->approval || strtolower($permohonan->approval->status) === 'pending')
        <button type="button" class="btn-danger" onclick="openModal()"><i class="bi bi-trash"></i> Batalkan Permohonan</button>
        @endif
    </div>

</div>

<div class="modal-overlay" id="modalBatal">
    <div class="modal-box">
        <div class="modal-title"><i class="bi bi-exclamation-triangle-fill me-2"></i>Batalkan Permohonan?</div>
        <p class="modal-desc">Permohonan <strong>{{ $permohonan->jenisSurat->nama_surat ?? '' }}</strong> akan dibatalkan dan tidak dapat dikembalikan.</p>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeModal()">Tidak</button>
            <form method="POST" action="{{ route('user.permohonan.destroy', $permohonan->id_permohonan) }}">
                @csrf @method('DELETE')
                <button type="submit" class="btn-confirm-del">Ya, Batalkan</button>
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
</script>
</body>
</html>