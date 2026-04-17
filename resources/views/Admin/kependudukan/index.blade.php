@extends('admin.layouts.app')

@section('title', 'Data Kependudukan')

@push('styles')
<link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
:root {
    --blue:    #2563eb; --blue-dk: #1d4ed8; --blue-lt: #eff6ff;
    --navy:    #0f172a; --slate:   #334155;  --muted:   #64748b;
    --border:  #e2e8f0; --bg:      #f1f5f9;
    --green:   #10b981; --orange:  #f59e0b;
    --red:     #ef4444; --purple:  #8b5cf6;
}
body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--navy); font-size:14px; }

/* ── HERO ── */
.kp-hero {
    background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%);
    padding: 32px 32px 28px;
    position: relative; overflow: hidden;
}
.kp-hero::before {
    content: ''; position: absolute; inset: 0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.kp-hero-content {
    position: relative; z-index: 1;
    display: flex; align-items: center; justify-content: space-between;
    flex-wrap: wrap; gap: 16px;
}
.kp-hero h1 { font-size: 24px; font-weight: 800; color: white; margin: 0 0 4px; }
.kp-hero p  { font-size: 13px; color: rgba(255,255,255,.75); margin: 0; }

.page-wrapper  { padding: 28px; }

.breadcrumb-bar { font-size:12px; color:var(--muted); margin-bottom:10px; display:flex; align-items:center; gap:6px; }
.breadcrumb-bar a { color:var(--muted); text-decoration:none; }
.breadcrumb-bar a:hover { color:var(--blue); }
.breadcrumb-bar .active { color:var(--blue); font-weight:600; }

/* Stat */
.stat-card { background:white; border-radius:12px; border:1px solid var(--border); padding:20px 24px; display:flex; align-items:center; justify-content:space-between; transition:box-shadow .2s; }
.stat-card:hover { box-shadow:0 6px 20px rgba(0,0,0,.08); }
.stat-label { font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.05em; color:var(--muted); margin-bottom:6px; }
.stat-value { font-size:32px; font-weight:800; color:var(--navy); line-height:1; }
.stat-icon  { width:50px; height:50px; border-radius:12px; display:flex; align-items:center; justify-content:center; font-size:24px; flex-shrink:0; }
.icon-blue { background:#eff6ff; color:var(--blue); }
.icon-red  { background:#fef2f2; color:var(--red); }

/* Toolbar */
.toolbar { background:white; border-radius:12px; border:1px solid var(--border); padding:14px 18px; display:flex; align-items:center; gap:10px; flex-wrap:wrap; }
.search-wrap { position:relative; flex:1; min-width:220px; }
.search-wrap i { position:absolute; left:12px; top:50%; transform:translateY(-50%); color:var(--muted); font-size:14px; }
.search-input { width:100%; padding:8px 12px 8px 36px; border:1px solid var(--border); border-radius:8px; font-size:13px; font-family:inherit; outline:none; color:var(--navy); background:#f8fafc; transition:border-color .18s; }
.search-input:focus { border-color:var(--blue); background:white; }
.select-filter { padding:8px 32px 8px 12px; border:1px solid var(--border); border-radius:8px; font-size:13px; font-family:inherit; color:var(--slate); background:white; outline:none; cursor:pointer; appearance:none; background-image:url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 24 24' fill='none' stroke='%2364748b' stroke-width='2'%3E%3Cpath d='M6 9l6 6 6-6'/%3E%3C/svg%3E"); background-repeat:no-repeat; background-position:right 10px center; }
.select-filter:focus { border-color:var(--blue); }
.btn-filter { display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:8px; font-size:13px; font-weight:600; border:1px solid var(--blue); background:var(--blue-lt); color:var(--blue); cursor:pointer; transition:all .18s; }
.btn-filter:hover { background:var(--blue); color:white; }
.btn-tambah { display:inline-flex; align-items:center; gap:8px; padding:10px 20px; border-radius:10px; background:white; color:var(--blue); font-size:13px; font-weight:700; text-decoration:none; border:none; cursor:pointer; transition:all .2s; white-space:nowrap; box-shadow:0 4px 12px rgba(0,0,0,.15); }
.btn-tambah:hover { transform:translateY(-1px); box-shadow:0 6px 18px rgba(0,0,0,.2); color:var(--blue-dk); }
.btn-tambah-inner { display:inline-flex; align-items:center; gap:6px; padding:8px 18px; border-radius:8px; font-size:13px; font-weight:600; border:none; background:var(--blue); color:white; cursor:pointer; text-decoration:none; transition:background .18s; white-space:nowrap; }
.btn-tambah-inner:hover { background:var(--blue-dk); color:white; }

/* Table */
.table-card { background:white; border-radius:12px; border:1px solid var(--border); overflow:hidden; }
.warga-tbl { width:100%; border-collapse:collapse; font-size:13px; }
.warga-tbl th { padding:11px 16px; text-align:left; font-size:11px; font-weight:700; text-transform:uppercase; letter-spacing:.05em; color:var(--muted); border-bottom:1px solid var(--border); background:#f8fafc; }
.warga-tbl td { padding:13px 16px; border-bottom:1px solid var(--border); color:var(--slate); vertical-align:middle; }
.warga-tbl tbody tr:last-child td { border-bottom:none; }
.warga-tbl tbody tr:hover td { background:#f8fafc; }
.warga-tbl th:first-child, .warga-tbl td:first-child { width:40px; padding-right:0; }
input[type=checkbox] { accent-color:var(--blue); width:15px; height:15px; cursor:pointer; }

.av { width:36px; height:36px; border-radius:9px; font-size:12px; font-weight:700; color:white; display:flex; align-items:center; justify-content:center; flex-shrink:0; }
.av-blue   { background:linear-gradient(135deg,#2563eb,#60a5fa); }
.av-green  { background:linear-gradient(135deg,#10b981,#6ee7b7); }
.av-purple { background:linear-gradient(135deg,#8b5cf6,#c4b5fd); }
.av-orange { background:linear-gradient(135deg,#f59e0b,#fcd34d); }
.av-red    { background:linear-gradient(135deg,#ef4444,#fca5a5); }
.av-teal   { background:linear-gradient(135deg,#0d9488,#5eead4); }

.warga-nama { font-weight:600; color:var(--navy); font-size:13px; }
.warga-rt   { font-size:11px; color:var(--muted); margin-top:2px; }
.nik-text   { font-size:12px; font-family:'Courier New',monospace; color:var(--slate); letter-spacing:.03em; }
.kontak-email { font-size:12px; color:var(--slate); }
.kontak-telp  { font-size:11px; color:var(--muted); margin-top:2px; }
.tgl-text { font-size:12px; color:var(--slate); }

.bdg { display:inline-flex; align-items:center; gap:5px; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; }
.bdg::before { content:''; width:6px; height:6px; border-radius:50%; }
.bdg-aktif::before    { background:var(--green); }
.bdg-aktif    { background:#ecfdf5; color:#065f46; }
.bdg-nonaktif::before { background:var(--muted); }
.bdg-nonaktif { background:#f1f5f9; color:var(--muted); }
.bdg-blokir::before   { background:var(--red); }
.bdg-blokir   { background:#fef2f2; color:#991b1b; }

.aksi-wrap { position:relative; display:inline-block; }
.btn-aksi { width:30px; height:30px; border-radius:6px; border:1px solid var(--border); background:white; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:16px; color:var(--muted); transition:all .18s; }
.btn-aksi:hover { background:var(--bg); color:var(--navy); }
.dropdown-menu-custom { position:fixed; z-index:1000; background:white; border:1px solid var(--border); border-radius:10px; box-shadow:0 8px 24px rgba(0,0,0,.12); min-width:160px; padding:6px; display:none; }
.dropdown-menu-custom.show { display:block; }
.dd-item { display:flex; align-items:center; gap:8px; padding:8px 10px; border-radius:6px; font-size:12px; font-weight:500; color:var(--slate); cursor:pointer; text-decoration:none; transition:background .15s; border:none; background:none; width:100%; text-align:left; }
.dd-item:hover { background:var(--bg); color:var(--navy); }
.dd-item.danger { color:var(--red); }
.dd-item.danger:hover { background:#fef2f2; }
.dd-item i { font-size:13px; }
.dd-divider { border:none; border-top:1px solid var(--border); margin:4px 0; }

.tbl-footer { padding:12px 16px; border-top:1px solid var(--border); display:flex; align-items:center; justify-content:space-between; font-size:12px; color:var(--muted); }
.pagination-wrap { display:flex; align-items:center; gap:4px; }
.pg-btn { width:32px; height:32px; border-radius:7px; border:1px solid var(--border); background:white; display:flex; align-items:center; justify-content:center; font-size:12px; font-weight:600; color:var(--slate); cursor:pointer; text-decoration:none; transition:all .18s; }
.pg-btn:hover { border-color:var(--blue); color:var(--blue); }
.pg-btn.active { background:var(--blue); border-color:var(--blue); color:white; }
.pg-btn.disabled { opacity:.4; pointer-events:none; }

.alert-success { background:#ecfdf5; border:1px solid #a7f3d0; border-radius:10px; padding:12px 16px; font-size:13px; color:#065f46; display:flex; align-items:center; gap:8px; margin-bottom:16px; }
.alert-error   { background:#fef2f2; border:1px solid #fecaca; border-radius:10px; padding:12px 16px; font-size:13px; color:#991b1b; display:flex; align-items:flex-start; gap:8px; margin-bottom:16px; }

/* ── MODAL ── */
.modal-overlay { position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:999; display:flex; align-items:center; justify-content:center; opacity:0; pointer-events:none; transition:opacity .2s; }
.modal-overlay.show { opacity:1; pointer-events:all; }
.modal-box { background:white; border-radius:16px; padding:28px; width:100%; max-width:520px; box-shadow:0 20px 60px rgba(0,0,0,.2); transform:translateY(16px); transition:transform .2s; max-height:90vh; overflow-y:auto; }
.modal-overlay.show .modal-box { transform:translateY(0); }
.modal-box.sm { max-width:400px; }
.modal-header { display:flex; align-items:center; justify-content:space-between; margin-bottom:20px; }
.modal-title  { font-size:16px; font-weight:700; color:var(--navy); }
.modal-close  { width:30px; height:30px; border-radius:7px; border:1px solid var(--border); background:white; cursor:pointer; display:flex; align-items:center; justify-content:center; font-size:16px; color:var(--muted); }
.modal-close:hover { background:var(--bg); }
.modal-desc   { font-size:13px; color:var(--muted); line-height:1.6; margin-bottom:4px; }
.modal-actions { display:flex; gap:10px; margin-top:24px; justify-content:flex-end; }

/* Form */
.form-grid { display:grid; grid-template-columns:1fr 1fr; gap:14px; }
.form-grid.full { grid-template-columns:1fr; }
.form-group { display:flex; flex-direction:column; gap:5px; }
.form-group.span2 { grid-column:span 2; }
.form-label { font-size:12px; font-weight:600; color:var(--navy); }
.form-label span { color:var(--red); margin-left:2px; }
.form-control { padding:8px 12px; border:1px solid var(--border); border-radius:8px; font-size:13px; font-family:inherit; color:var(--navy); outline:none; transition:border-color .18s; }
.form-control:focus { border-color:var(--blue); }
.form-hint { font-size:11px; color:var(--muted); }
.form-error { font-size:11px; color:var(--red); }

.btn-cancel { padding:8px 18px; border-radius:8px; border:1px solid var(--border); background:white; font-size:13px; font-weight:600; color:var(--slate); cursor:pointer; }
.btn-cancel:hover { background:var(--bg); }
.btn-primary { padding:8px 20px; border-radius:8px; border:none; background:var(--blue); color:white; font-size:13px; font-weight:600; cursor:pointer; }
.btn-primary:hover { background:var(--blue-dk); }
.btn-danger  { padding:8px 18px; border-radius:8px; border:none; background:var(--red); color:white; font-size:13px; font-weight:600; cursor:pointer; }
.btn-danger:hover { background:#dc2626; }
</style>
@endpush

@section('content')
@include('admin.partials.header')

{{-- ── HERO BANNER ── --}}
<div class="kp-hero">
    <div class="kp-hero-content">
        <div>
            <h1><i class="bi bi-people-fill me-2"></i>Data Kependudukan</h1>
            <p>Kelola data akun warga dan status kependudukan Kelurahan Teritih</p>
        </div>
        <button class="btn-tambah" onclick="openModal('modalTambah')">
            <i class="bi bi-person-plus-fill"></i> Tambah Warga
        </button>
    </div>
</div>

<div class="page-wrapper">

    {{-- Breadcrumb --}}
    <div class="breadcrumb-bar">
        <a href="{{ route('admin.dashboard') }}">Portal Admin</a>
        <i class="bi bi-chevron-right" style="font-size:10px"></i>
        <span class="active">Kependudukan</span>
    </div>

    {{-- Alert --}}
    @if(session('success'))
    <div class="alert-success">
        <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
    </div>
    @endif

    @if($errors->any())
    <div class="alert-error">
        <i class="bi bi-exclamation-circle-fill" style="margin-top:1px;flex-shrink:0"></i>
        <div>
            @foreach($errors->all() as $e)
                <div>{{ $e }}</div>
            @endforeach
        </div>
    </div>
    @endif

    {{-- Stat Cards --}}
    <div class="row g-3 mb-4">
        <div class="col-md-6">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Total Warga Terdaftar</div>
                    <div class="stat-value">{{ number_format($totalUser) }}</div>
                </div>
                <div class="stat-icon icon-blue"><i class="bi bi-people-fill"></i></div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="stat-card">
                <div>
                    <div class="stat-label">Non-Aktif / Blokir</div>
                    <div class="stat-value">{{ number_format($nonAktif) }}</div>
                </div>
                <div class="stat-icon icon-red"><i class="bi bi-slash-circle-fill"></i></div>
            </div>
        </div>
    </div>

    {{-- Toolbar / Filter --}}
    <form method="GET" action="{{ route('kependudukan.index') }}" id="filterForm">
        <div class="toolbar mb-3">
            <div class="search-wrap">
                <i class="bi bi-search"></i>
                <input type="text" name="search" class="search-input"
                    placeholder="Cari Nama, NIK, atau Email..."
                    value="{{ request('search') }}">
            </div>
            <select name="status" class="select-filter">
                <option value="">Semua Status</option>
                <option value="aktif"     {{ request('status')=='aktif'     ? 'selected':'' }}>Aktif</option>
                <option value="non-aktif" {{ request('status')=='non-aktif' ? 'selected':'' }}>Non-Aktif</option>
                <option value="blokir"    {{ request('status')=='blokir'    ? 'selected':'' }}>Blokir</option>
            </select>
            <select name="sort" class="select-filter">
                <option value="terbaru" {{ request('sort','terbaru')=='terbaru' ? 'selected':'' }}>Terbaru</option>
                <option value="terlama" {{ request('sort')=='terlama' ? 'selected':'' }}>Terlama</option>
                <option value="nama"    {{ request('sort')=='nama'    ? 'selected':'' }}>Nama A–Z</option>
            </select>
            <button type="submit" class="btn-filter">
                <i class="bi bi-funnel"></i> Filter
            </button>
            @if(request('search') || request('status') || request('sort'))
            <a href="{{ route('kependudukan.index') }}" class="btn-filter" style="color:var(--red);border-color:var(--red)">
                <i class="bi bi-x-lg"></i> Reset
            </a>
            @endif
        </div>
    </form>

    {{-- Table --}}
    <div class="table-card">
        <div class="table-responsive">
            <table class="warga-tbl">
                <thead>
                    <tr>
                        <th><input type="checkbox" id="checkAll"></th>
                        <th>Profil Warga</th>
                        <th>NIK</th>
                        <th>Kontak</th>
                        <th>Tgl Terdaftar</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    @php
                        $initials = collect(explode(' ', $user->nama ?? 'U'))->map(fn($w)=>strtoupper(substr($w,0,1)))->take(2)->join('');
                        $avColors = ['av-blue','av-green','av-purple','av-orange','av-red','av-teal'];
                        $avColor  = $avColors[$loop->index % count($avColors)];
                        $status   = $user->status ?? 'aktif';
                    @endphp
                    <tr>
                        <td><input type="checkbox" name="ids[]" value="{{ $user->id_user }}"></td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="av {{ $avColor }}">{{ $initials }}</div>
                                <div>
                                    <div class="warga-nama">{{ $user->nama }}</div>
                                    <div class="warga-rt">
                                        @if($user->rt || $user->rw)
                                            RT {{ $user->rt ?? '-' }} / RW {{ $user->rw ?? '-' }}
                                        @else
                                            <span style="color:var(--border)">RT/RW belum diisi</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td>
                            @if($user->nik)
                                <span class="nik-text">{{ $user->nik }}</span>
                            @else
                                <span style="color:var(--border);font-size:12px">Belum diisi</span>
                            @endif
                        </td>
                        <td>
                            <div class="kontak-email">{{ $user->email }}</div>
                            <div class="kontak-telp">{{ $user->no_hp ?? '-' }}</div>
                        </td>
                        <td>
                            <span class="tgl-text">
                                {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y') : '-' }}
                            </span>
                        </td>
                        <td>
                            @if($status === 'aktif')
                                <span class="bdg bdg-aktif">Aktif</span>
                            @elseif($status === 'blokir')
                                <span class="bdg bdg-blokir">Blokir</span>
                            @else
                                <span class="bdg bdg-nonaktif">Non-Aktif</span>
                            @endif
                        </td>
                        <td>
                            <div class="aksi-wrap">
                                <button class="btn-aksi" type="button" onclick="toggleDropdown(this)">
                                    <i class="bi bi-three-dots-vertical"></i>
                                </button>
                                <div class="dropdown-menu-custom">
                                    <a href="{{ route('kependudukan.show', $user->id_user) }}" class="dd-item">
                                        <i class="bi bi-eye"></i> Lihat Detail
                                    </a>
                                    <form method="POST" action="{{ route('kependudukan.toggle', $user->id_user) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" class="dd-item">
                                            @if($status === 'aktif')
                                                <i class="bi bi-slash-circle"></i> Non-Aktifkan
                                            @else
                                                <i class="bi bi-check-circle"></i> Aktifkan
                                            @endif
                                        </button>
                                    </form>
                                    <hr class="dd-divider">
                                    <button type="button" class="dd-item danger"
                                        onclick="openModalHapus({{ $user->id_user }}, '{{ addslashes($user->nama) }}')">
                                        <i class="bi bi-trash"></i> Hapus
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="7" style="text-align:center;padding:36px;color:var(--muted);">
                            <i class="bi bi-people" style="font-size:32px;display:block;margin-bottom:10px;color:var(--border)"></i>
                            Tidak ada data warga ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- Pagination --}}
        @if($users->total() > 0)
        <div class="tbl-footer">
            <span>
                Menampilkan <strong>{{ $users->firstItem() }}–{{ $users->lastItem() }}</strong>
                dari <strong>{{ $users->total() }}</strong> data
            </span>
            <div class="pagination-wrap">
                <a href="{{ $users->previousPageUrl() }}" class="pg-btn {{ $users->onFirstPage() ? 'disabled':'' }}">
                    <i class="bi bi-chevron-left"></i>
                </a>
                @foreach($users->getUrlRange(1, $users->lastPage()) as $page => $url)
                    @if($page == 1 || $page == $users->lastPage() || abs($page - $users->currentPage()) <= 1)
                        <a href="{{ $url }}" class="pg-btn {{ $page == $users->currentPage() ? 'active':'' }}">{{ $page }}</a>
                    @elseif(abs($page - $users->currentPage()) == 2)
                        <span class="pg-btn" style="border:none;background:none;pointer-events:none">…</span>
                    @endif
                @endforeach
                <a href="{{ $users->nextPageUrl() }}" class="pg-btn {{ !$users->hasMorePages() ? 'disabled':'' }}">
                    <i class="bi bi-chevron-right"></i>
                </a>
            </div>
        </div>
        @endif
    </div>

</div>

{{-- ═══════════════════════════════════════
     MODAL: TAMBAH WARGA
═══════════════════════════════════════ --}}
<div class="modal-overlay" id="modalTambah">
    <div class="modal-box">
        <div class="modal-header">
            <div class="modal-title"><i class="bi bi-person-plus-fill me-2" style="color:var(--blue)"></i>Tambah Data Warga</div>
            <button class="modal-close" onclick="closeModal('modalTambah')"><i class="bi bi-x-lg"></i></button>
        </div>

        <form method="POST" action="{{ route('kependudukan.store') }}" id="formTambah">
            @csrf
            <div class="form-grid">
                <div class="form-group">
                    <label class="form-label">Nama Lengkap <span>*</span></label>
                    <input type="text" name="nama" class="form-control" value="{{ old('nama') }}" placeholder="Nama sesuai KTP" required>
                </div>
                <div class="form-group">
                    <label class="form-label">NIK <span>*</span></label>
                    <input type="text" name="nik" class="form-control" value="{{ old('nik') }}" placeholder="16 digit NIK" maxlength="20" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Email <span>*</span></label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" placeholder="email@domain.com" required>
                </div>
                <div class="form-group">
                    <label class="form-label">No. HP <span>*</span></label>
                    <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp') }}" placeholder="08xx-xxxx-xxxx" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Username <span>*</span></label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" placeholder="Username untuk login" autocomplete="off" required>
                </div>
                <div class="form-group">
                    <label class="form-label">Password <span>*</span></label>
                    <input type="password" name="password" class="form-control" placeholder="Min. 6 karakter" autocomplete="new-password" required>
                </div>
                <div class="form-group">
                    <label class="form-label">RT</label>
                    <input type="text" name="rt" class="form-control" value="{{ old('rt') }}" placeholder="Contoh: 001">
                </div>
                <div class="form-group">
                    <label class="form-label">RW</label>
                    <input type="text" name="rw" class="form-control" value="{{ old('rw') }}" placeholder="Contoh: 002">
                </div>
                <div class="form-group">
                    <label class="form-label">Tempat Lahir</label>
                    <input type="text" name="tempat_lahir" class="form-control" value="{{ old('tempat_lahir') }}" placeholder="Kota lahir">
                </div>
                <div class="form-group">
                    <label class="form-label">Tanggal Lahir</label>
                    <input type="date" name="tanggal_lahir" class="form-control" value="{{ old('tanggal_lahir') }}">
                </div>
                <div class="form-group span2">
                    <label class="form-label">Alamat</label>
                    <textarea name="alamat" class="form-control" rows="2" placeholder="Alamat lengkap">{{ old('alamat') }}</textarea>
                </div>
            </div>
            <div class="modal-actions">
                <button type="button" class="btn-cancel" onclick="closeModal('modalTambah')">Batal</button>
                <button type="submit" class="btn-primary"><i class="bi bi-check-lg me-1"></i>Simpan</button>
            </div>
        </form>
    </div>
</div>

{{-- ═══════════════════════════════════════
     MODAL: HAPUS
═══════════════════════════════════════ --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal-box sm">
        <div class="modal-header">
            <div class="modal-title" style="color:var(--red)"><i class="bi bi-exclamation-triangle-fill me-2"></i>Hapus Data Warga</div>
            <button class="modal-close" onclick="closeModal('modalHapus')"><i class="bi bi-x-lg"></i></button>
        </div>
        <p class="modal-desc">Anda yakin ingin menghapus data <strong id="modalNama"></strong>? Tindakan ini tidak dapat dibatalkan dan akan menghapus semua permohonan terkait.</p>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeModal('modalHapus')">Batal</button>
            <form id="formHapus" method="POST">
                @csrf @method('DELETE')
                <button type="submit" class="btn-danger">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

@include('admin.partials.footer')
@endsection

@push('scripts')
<script>
function openModal(id) {
    document.getElementById(id).classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeModal(id) {
    document.getElementById(id).classList.remove('show');
    document.body.style.overflow = '';
}
document.querySelectorAll('.modal-overlay').forEach(el => {
    el.addEventListener('click', e => { if (e.target === el) closeModal(el.id); });
});

function openModalHapus(id, nama) {
    document.getElementById('modalNama').textContent = nama;
    document.getElementById('formHapus').action = `/admin/kependudukan/${id}`;
    openModal('modalHapus');
}

let activeBtn = null;

function toggleDropdown(btn) {
    const menu = btn.nextElementSibling;
    const isOpen = menu.classList.contains('show');
    document.querySelectorAll('.dropdown-menu-custom.show').forEach(el => el.classList.remove('show'));
    activeBtn = null;
    if (!isOpen) {
        activeBtn = btn;
        positionDropdown(btn, menu);
        menu.classList.add('show');
    }
}

function positionDropdown(btn, menu) {
    const rect = btn.getBoundingClientRect();
    menu.style.top  = (rect.bottom + 6) + 'px';
    menu.style.left = (rect.right - 160) + 'px';
}

window.addEventListener('scroll', () => {
    if (activeBtn) {
        const menu = activeBtn.nextElementSibling;
        if (menu && menu.classList.contains('show')) positionDropdown(activeBtn, menu);
    }
}, true);

document.addEventListener('click', e => {
    if (!e.target.closest('.aksi-wrap')) {
        document.querySelectorAll('.dropdown-menu-custom.show').forEach(el => el.classList.remove('show'));
        activeBtn = null;
    }
});

document.getElementById('checkAll').addEventListener('change', function () {
    document.querySelectorAll('input[name="ids[]"]').forEach(cb => cb.checked = this.checked);
});

@if($errors->any())
    document.addEventListener('DOMContentLoaded', () => openModal('modalTambah'));
@endif
</script>
@endpush