@extends('admin.layouts.app')

@section('title', 'Detail Warga')

@push('styles')
<link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
:root {
    --blue:    #1c64f2; --blue-dk: #1a56db; --blue-lt: #eff6ff;
    --navy:    #0f172a; --slate:   #334155;  --muted:   #64748b;
    --border:  #e2e8f0; --bg:      #f1f5f9;
    --green:   #10b981; --red:     #ef4444;
}
body { font-family:'Plus Jakarta Sans',sans-serif; background:var(--bg); color:var(--navy); font-size:14px; }
.page-wrapper { padding:28px; max-width:860px; }

.breadcrumb-bar { font-size:12px; color:var(--muted); margin-bottom:16px; display:flex; align-items:center; gap:6px; }
.breadcrumb-bar a { color:var(--muted); text-decoration:none; }
.breadcrumb-bar a:hover { color:var(--blue); }
.breadcrumb-bar .active { color:var(--blue); font-weight:600; }

.btn-back { display:inline-flex; align-items:center; gap:6px; padding:8px 16px; border-radius:8px; font-size:13px; font-weight:600; border:1px solid var(--border); background:white; color:var(--slate); text-decoration:none; transition:all .18s; }
.btn-back:hover { border-color:var(--blue); color:var(--blue); }

/* Profile card */
.profile-card { background:white; border-radius:14px; border:1px solid var(--border); padding:28px; margin-bottom:16px; display:flex; align-items:center; gap:24px; }
.profile-av { width:72px; height:72px; border-radius:16px; font-size:26px; font-weight:800; color:white; display:flex; align-items:center; justify-content:center; flex-shrink:0; background:linear-gradient(135deg,#1c64f2,#60a5fa); }
.profile-nama { font-size:20px; font-weight:800; color:var(--navy); }
.profile-sub  { font-size:13px; color:var(--muted); margin-top:3px; }

.bdg { display:inline-flex; align-items:center; gap:5px; padding:3px 10px; border-radius:20px; font-size:11px; font-weight:600; }
.bdg::before { content:''; width:6px; height:6px; border-radius:50%; }
.bdg-aktif    { background:#ecfdf5; color:#065f46; } .bdg-aktif::before { background:var(--green); }
.bdg-nonaktif { background:#f1f5f9; color:var(--muted); } .bdg-nonaktif::before { background:var(--muted); }
.bdg-blokir   { background:#fef2f2; color:#991b1b; } .bdg-blokir::before { background:var(--red); }

/* Detail card */
.detail-card { background:white; border-radius:14px; border:1px solid var(--border); overflow:hidden; margin-bottom:16px; }
.detail-card-header { padding:14px 20px; border-bottom:1px solid var(--border); font-size:13px; font-weight:700; color:var(--navy); display:flex; align-items:center; gap:8px; }
.detail-card-header i { color:var(--blue); }
.detail-grid { display:grid; grid-template-columns:1fr 1fr; padding:4px 0; }
.detail-row { padding:12px 20px; display:flex; flex-direction:column; gap:3px; border-bottom:1px solid var(--border); }
.detail-row:nth-last-child(-n+2) { border-bottom:none; }
.detail-row.full { grid-column:span 2; }
.detail-label { font-size:11px; font-weight:600; text-transform:uppercase; letter-spacing:.04em; color:var(--muted); }
.detail-value { font-size:13px; color:var(--navy); font-weight:500; }
.detail-value.mono { font-family:'Courier New',monospace; letter-spacing:.05em; }
.detail-empty { color:var(--border); font-style:italic; }

/* Action bar */
.action-bar { display:flex; gap:10px; flex-wrap:wrap; }
.btn-toggle-aktif   { display:inline-flex; align-items:center; gap:6px; padding:9px 18px; border-radius:8px; font-size:13px; font-weight:600; border:none; background:#ecfdf5; color:#065f46; cursor:pointer; transition:all .18s; }
.btn-toggle-aktif:hover { background:#d1fae5; }
.btn-toggle-nonaktif { display:inline-flex; align-items:center; gap:6px; padding:9px 18px; border-radius:8px; font-size:13px; font-weight:600; border:none; background:#fffbeb; color:#92400e; cursor:pointer; transition:all .18s; }
.btn-toggle-nonaktif:hover { background:#fef3c7; }
.btn-hapus { display:inline-flex; align-items:center; gap:6px; padding:9px 18px; border-radius:8px; font-size:13px; font-weight:600; border:none; background:#fef2f2; color:#991b1b; cursor:pointer; transition:all .18s; }
.btn-hapus:hover { background:#fee2e2; }

/* Modal */
.modal-overlay { position:fixed; inset:0; background:rgba(0,0,0,.45); z-index:999; display:flex; align-items:center; justify-content:center; opacity:0; pointer-events:none; transition:opacity .2s; }
.modal-overlay.show { opacity:1; pointer-events:all; }
.modal-box { background:white; border-radius:16px; padding:28px; width:100%; max-width:400px; box-shadow:0 20px 60px rgba(0,0,0,.2); transform:translateY(16px); transition:transform .2s; }
.modal-overlay.show .modal-box { transform:translateY(0); }
.modal-title { font-size:16px; font-weight:700; color:var(--navy); margin-bottom:8px; }
.modal-desc  { font-size:13px; color:var(--muted); line-height:1.6; }
.modal-actions { display:flex; gap:10px; margin-top:20px; justify-content:flex-end; }
.btn-cancel { padding:8px 18px; border-radius:8px; border:1px solid var(--border); background:white; font-size:13px; font-weight:600; color:var(--slate); cursor:pointer; }
.btn-danger { padding:8px 18px; border-radius:8px; border:none; background:var(--red); color:white; font-size:13px; font-weight:600; cursor:pointer; }
.btn-danger:hover { background:#dc2626; }

.alert-success { background:#ecfdf5; border:1px solid #a7f3d0; border-radius:10px; padding:12px 16px; font-size:13px; color:#065f46; display:flex; align-items:center; gap:8px; margin-bottom:16px; }
</style>
@endpush

@section('content')
@include('admin.partials.header')

<div class="page-wrapper">

    <div class="breadcrumb-bar">
        <a href="{{ route('admin.dashboard') }}">Portal Admin</a>
        <i class="bi bi-chevron-right" style="font-size:10px"></i>
        <a href="{{ route('kependudukan.index') }}">Kependudukan</a>
        <i class="bi bi-chevron-right" style="font-size:10px"></i>
        <span class="active">{{ $user->nama }}</span>
    </div>

    @if(session('success'))
    <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
    @endif

    {{-- Profile Card --}}
    @php
        $initials = collect(explode(' ', $user->nama ?? 'U'))->map(fn($w)=>strtoupper(substr($w,0,1)))->take(2)->join('');
        $status   = $user->status ?? 'aktif';
    @endphp
    <div class="profile-card">
        <div class="profile-av">{{ $initials }}</div>
        <div class="flex-grow-1">
            <div class="profile-nama">{{ $user->nama }}</div>
            <div class="profile-sub">{{ $user->email }}</div>
            <div class="mt-2">
                @if($status === 'aktif')
                    <span class="bdg bdg-aktif">Aktif</span>
                @elseif($status === 'blokir')
                    <span class="bdg bdg-blokir">Blokir</span>
                @else
                    <span class="bdg bdg-nonaktif">Non-Aktif</span>
                @endif
            </div>
        </div>
        <a href="{{ route('kependudukan.index') }}" class="btn-back">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>

    {{-- Data Pribadi --}}
    <div class="detail-card">
        <div class="detail-card-header">
            <i class="bi bi-person-fill"></i> Data Pribadi
        </div>
        <div class="detail-grid">
            <div class="detail-row">
                <span class="detail-label">NIK</span>
                <span class="detail-value mono">{{ $user->nik ?? '<span class="detail-empty">Belum diisi</span>' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">No. HP</span>
                <span class="detail-value">{{ $user->no_hp ?? '<span class="detail-empty">Belum diisi</span>' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tempat Lahir</span>
                <span class="detail-value">{{ $user->tempat_lahir ?? '<span class="detail-empty">Belum diisi</span>' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Tanggal Lahir</span>
                <span class="detail-value">
                    {{ $user->tanggal_lahir ? \Carbon\Carbon::parse($user->tanggal_lahir)->format('d M Y') : '<span class="detail-empty">Belum diisi</span>' }}
                </span>
            </div>
            <div class="detail-row full">
                <span class="detail-label">Alamat</span>
                <span class="detail-value">{{ $user->alamat ?? '<span class="detail-empty">Belum diisi</span>' }}</span>
            </div>
        </div>
    </div>

    {{-- Data Domisili --}}
    <div class="detail-card">
        <div class="detail-card-header">
            <i class="bi bi-geo-alt-fill"></i> Data Domisili
        </div>
        <div class="detail-grid">
            <div class="detail-row">
                <span class="detail-label">RT</span>
                <span class="detail-value">{{ $user->rt ?? '<span class="detail-empty">-</span>' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">RW</span>
                <span class="detail-value">{{ $user->rw ?? '<span class="detail-empty">-</span>' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Kelurahan</span>
                <span class="detail-value">{{ $user->kelurahan ?? '<span class="detail-empty">-</span>' }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Kecamatan</span>
                <span class="detail-value">{{ $user->kecamatan ?? '<span class="detail-empty">-</span>' }}</span>
            </div>
        </div>
    </div>

    {{-- Data Akun --}}
    <div class="detail-card">
        <div class="detail-card-header">
            <i class="bi bi-shield-lock-fill"></i> Data Akun
        </div>
        <div class="detail-grid">
            <div class="detail-row">
                <span class="detail-label">Username</span>
                <span class="detail-value mono">{{ $user->username }}</span>
            </div>
            <div class="detail-row">
                <span class="detail-label">Terdaftar Sejak</span>
                <span class="detail-value">
                    {{ $user->created_at ? \Carbon\Carbon::parse($user->created_at)->format('d M Y, H:i') : '-' }}
                </span>
            </div>
        </div>
    </div>

    {{-- Action Bar --}}
    <div class="action-bar">
        <form method="POST" action="{{ route('kependudukan.toggle', $user->id_user) }}">
            @csrf @method('PATCH')
            @if($status === 'aktif')
                <button type="submit" class="btn-toggle-nonaktif">
                    <i class="bi bi-slash-circle"></i> Non-Aktifkan Akun
                </button>
            @else
                <button type="submit" class="btn-toggle-aktif">
                    <i class="bi bi-check-circle"></i> Aktifkan Akun
                </button>
            @endif
        </form>
        <button type="button" class="btn-hapus" onclick="openModal()">
            <i class="bi bi-trash"></i> Hapus Warga
        </button>
    </div>

</div>

{{-- Modal Hapus --}}
<div class="modal-overlay" id="modalHapus">
    <div class="modal-box">
        <div class="modal-title" style="color:var(--red)">
            <i class="bi bi-exclamation-triangle-fill me-2"></i>Hapus Data Warga
        </div>
        <p class="modal-desc">Anda yakin ingin menghapus data <strong>{{ $user->nama }}</strong>? Tindakan ini tidak dapat dibatalkan.</p>
        <div class="modal-actions">
            <button class="btn-cancel" onclick="closeModal()">Batal</button>
            <form method="POST" action="{{ route('kependudukan.destroy', $user->id_user) }}">
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
function openModal() {
    document.getElementById('modalHapus').classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeModal() {
    document.getElementById('modalHapus').classList.remove('show');
    document.body.style.overflow = '';
}
document.getElementById('modalHapus').addEventListener('click', e => {
    if (e.target === document.getElementById('modalHapus')) closeModal();
});
</script>
@endpush