<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Permohonan Saya – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--blue:#1c64f2;--blue-dk:#1a56db;--blue-lt:#eff6ff;--navy:#0d1b3e;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;--green:#10b981;--red:#ef4444}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:14px}
.page-wrap{max-width:1100px;margin:0 auto;padding:28px 24px 60px}
.page-top{display:flex;align-items:center;justify-content:space-between;margin-bottom:24px;flex-wrap:wrap;gap:12px}
.page-top h1{font-size:24px;font-weight:800;color:var(--navy);margin:0 0 3px}
.page-top p{font-size:13px;color:var(--muted);margin:0}
.btn-new{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;border-radius:9px;font-size:13px;font-weight:700;background:var(--blue);color:white;text-decoration:none;box-shadow:0 2px 8px rgba(28,100,242,.25);transition:all .15s}
.btn-new:hover{background:var(--blue-dk);transform:translateY(-1px);color:white}
.alert{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:9px;margin-bottom:20px;font-size:13px}
.alert-success{background:#f0fdf4;border:1px solid #bbf7d0;color:#166534}
.alert-error{background:#fef2f2;border:1px solid #fecaca;color:#991b1b}
.stats-row{display:grid;grid-template-columns:repeat(4,1fr);gap:14px;margin-bottom:24px}
.stat-card{background:white;border:1px solid var(--border);border-radius:12px;padding:16px 18px;display:flex;align-items:center;gap:12px}
.stat-icon{width:40px;height:40px;border-radius:10px;display:grid;place-items:center;flex-shrink:0}
.stat-icon svg{width:18px;height:18px}
.stat-icon.blue{background:var(--blue-lt);color:var(--blue)}
.stat-icon.yellow{background:#fffbeb;color:#d97706}
.stat-icon.green{background:#f0fdf4;color:#16a34a}
.stat-icon.red{background:#fef2f2;color:var(--red)}
.stat-info small{font-size:11px;color:#9ca3af;font-weight:600;text-transform:uppercase;letter-spacing:.06em}
.stat-info strong{font-size:20px;font-weight:800;color:var(--navy);display:block;line-height:1.2}
.table-card{background:white;border:1px solid var(--border);border-radius:14px;overflow:hidden;box-shadow:0 1px 6px rgba(0,0,0,.05)}
table{width:100%;border-collapse:collapse}
thead th{background:#f9fafb;padding:11px 16px;text-align:left;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:var(--muted);border-bottom:1px solid var(--border);white-space:nowrap}
tbody tr{border-bottom:1px solid #f3f4f6;transition:background .12s}
tbody tr:last-child{border-bottom:none}
tbody tr:hover{background:#f9fafb}
tbody td{padding:14px 16px;font-size:13px;color:var(--slate);vertical-align:middle}
.td-no{color:#9ca3af;font-size:12px;font-weight:600}
.td-surat{font-weight:600;color:var(--navy)}
.td-surat small{display:block;font-size:11px;font-weight:400;color:#9ca3af;margin-top:2px}
.td-date{color:var(--muted);font-size:12px}
.pill{display:inline-flex;align-items:center;gap:5px;padding:4px 11px;border-radius:20px;font-size:11px;font-weight:700;white-space:nowrap}
.pill::before{content:'';width:6px;height:6px;border-radius:50%;flex-shrink:0}
.pill-pending{background:#fef9c3;color:#854d0e}.pill-pending::before{background:#ca8a04}
.pill-disetujui{background:#dcfce7;color:#14532d}.pill-disetujui::before{background:#16a34a}
.pill-ditolak{background:#fee2e2;color:#7f1d1d}.pill-ditolak::before{background:var(--red)}
.action-group{display:flex;align-items:center;gap:6px}
.btn-sm{display:inline-flex;align-items:center;gap:5px;padding:5px 11px;border-radius:7px;font-size:12px;font-weight:600;cursor:pointer;border:none;transition:all .15s;text-decoration:none;white-space:nowrap;font-family:inherit}
.btn-sm svg{width:12px;height:12px}
.btn-detail{background:var(--blue-lt);color:var(--blue)}.btn-detail:hover{background:#dbeafe;color:var(--blue)}
.btn-delete{background:#fef2f2;color:var(--red)}.btn-delete:hover{background:#fee2e2}
.empty-state{text-align:center;padding:64px 20px}
.empty-icon{width:64px;height:64px;background:#f3f4f6;border-radius:50%;display:inline-grid;place-items:center;margin-bottom:16px}
.empty-icon svg{width:28px;height:28px;color:#9ca3af}
.empty-state h3{font-size:16px;font-weight:700;color:var(--slate);margin-bottom:6px}
.empty-state p{font-size:13px;color:#9ca3af;margin-bottom:20px}
@media(max-width:768px){.stats-row{grid-template-columns:repeat(2,1fr)}.page-top{flex-direction:column;align-items:flex-start}}
</style>
</head>
<body>

@include('partials.navbar-user')

<div class="page-wrap">

    <div class="page-top">
        <div>
            <h1>Permohonan Saya</h1>
            <p>Daftar semua permohonan surat yang telah Anda ajukan</p>
        </div>
        <a href="{{ route('layanan') }}" class="btn-new">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:15px;height:15px">
                <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
            </svg>
            Buat Permohonan Baru
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:16px;height:16px;flex-shrink:0"><polyline points="20 6 9 17 4 12"/></svg>
        {{ session('success') }}
    </div>
    @endif
    @if(session('error'))
    <div class="alert alert-error">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;flex-shrink:0"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
        {{ session('error') }}
    </div>
    @endif

    {{-- STATISTIK --}}
    <div class="stats-row">
        <div class="stat-card">
            <div class="stat-icon blue">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <div class="stat-info"><small>Total</small><strong>{{ $data->count() }}</strong></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon yellow">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><polyline points="12 6 12 12 16 14"/></svg>
            </div>
            <div class="stat-info"><small>Pending</small><strong>{{ $data->filter(fn($d) => !$d->approval || $d->approval->status === 'pending')->count() }}</strong></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon green">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="20 6 9 17 4 12"/></svg>
            </div>
            <div class="stat-info"><small>Disetujui</small><strong>{{ $data->filter(fn($d) => $d->approval && $d->approval->status === 'disetujui')->count() }}</strong></div>
        </div>
        <div class="stat-card">
            <div class="stat-icon red">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><circle cx="12" cy="12" r="10"/><line x1="15" y1="9" x2="9" y2="15"/><line x1="9" y1="9" x2="15" y2="15"/></svg>
            </div>
            <div class="stat-info"><small>Ditolak</small><strong>{{ $data->filter(fn($d) => $d->approval && $d->approval->status === 'ditolak')->count() }}</strong></div>
        </div>
    </div>

    <div class="table-card">
        @if($data->isEmpty())
        <div class="empty-state">
            <div class="empty-icon">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            </div>
            <h3>Belum ada permohonan</h3>
            <p>Anda belum pernah mengajukan permohonan surat. Mulai buat sekarang!</p>
            <a href="{{ route('layanan') }}" class="btn-new" style="display:inline-flex">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:15px;height:15px">
                    <line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/>
                </svg>
                Buat Permohonan Pertama
            </a>
        </div>
        @else
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Jenis Surat</th>
                    <th>Keperluan</th>
                    <th>Tanggal</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $d)
                @php $status = $d->approval->status ?? 'pending'; @endphp
                <tr>
                    <td class="td-no">{{ $loop->iteration }}</td>
                    <td>
                        <div class="td-surat">
                            {{ $d->jenisSurat->nama_surat ?? '-' }}
                            <small>Diajukan {{ \Carbon\Carbon::parse($d->tanggal_pengajuan)->diffForHumans() }}</small>
                        </div>
                    </td>
                    <td style="max-width:220px;color:var(--muted)">{{ Str::limit($d->keperluan, 55) }}</td>
                    <td class="td-date">{{ \Carbon\Carbon::parse($d->tanggal_pengajuan)->format('d M Y') }}</td>
                    <td>
                        <span class="pill pill-{{ $status }}">
                            {{ $status === 'disetujui' ? 'Disetujui' : ($status === 'ditolak' ? 'Ditolak' : 'Pending') }}
                        </span>
                    </td>
                    <td>
                        <div class="action-group">
                            {{-- Detail --}}
                            <a href="{{ route('user.permohonan.show', $d->id_permohonan) }}" class="btn-sm btn-detail">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                    <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>
                                </svg>
                                Detail
                            </a>
                            {{-- Hapus (hanya jika masih pending) --}}
                            @if(!$d->approval || $d->approval->status === 'pending')
                            <form action="{{ route('user.permohonan.destroy', $d->id_permohonan) }}" method="POST" style="display:inline"
                                  onsubmit="return confirm('Hapus permohonan ini? Tindakan tidak dapat dibatalkan.')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-delete">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <polyline points="3 6 5 6 21 6"/>
                                        <path d="M19 6l-1 14a2 2 0 01-2 2H8a2 2 0 01-2-2L5 6"/>
                                        <path d="M10 11v6M14 11v6"/>
                                    </svg>
                                    Hapus
                                </button>
                            </form>
                            @endif
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>

</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>