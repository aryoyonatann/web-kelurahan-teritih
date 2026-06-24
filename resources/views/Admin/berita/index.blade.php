@extends('admin.layouts.app')

@section('title', 'Manajemen Berita')

@push('styles')
<link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f1f5f9; }
    .inf-page { padding: 0; min-height: 100vh; }

    /* ── HERO ── */
    .inf-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%);
        padding: 32px 32px 28px; position: relative; overflow: hidden;
    }
    .inf-hero::before {
        content: ''; position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .inf-hero-content { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 16px; }
    .inf-hero h1 { font-size: 24px; font-weight: 800; color: white; margin: 0 0 4px; }
    .inf-hero p  { font-size: 13px; color: rgba(255,255,255,.75); margin: 0; }
    .btn-tulis {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 10px 20px; border-radius: 10px;
        background: white; color: #2563eb;
        font-size: 13px; font-weight: 700;
        text-decoration: none; transition: all .2s;
        box-shadow: 0 4px 12px rgba(0,0,0,.15); white-space: nowrap;
    }
    .btn-tulis:hover { transform: translateY(-1px); box-shadow: 0 6px 18px rgba(0,0,0,.2); color: #1d4ed8; }

    /* ── STATS BAR ── */
    .stats-bar { display: grid; grid-template-columns: repeat(3,1fr); background: white; border-bottom: 1px solid #e2e8f0; }
    .stat-item { padding: 16px 24px; text-align: center; border-right: 1px solid #e2e8f0; }
    .stat-item:last-child { border-right: none; }
    .stat-num  { font-size: 26px; font-weight: 800; color: #0f172a; line-height: 1; }
    .stat-lbl  { font-size: 11px; font-weight: 600; color: #64748b; text-transform: uppercase; letter-spacing: .05em; margin-top: 4px; }

    /* ── CONTENT ── */
    .inf-content { padding: 24px 32px; }

    /* ── ALERT ── */
    .alert-success {
        display: flex; align-items: center; gap: 10px;
        padding: 12px 16px; border-radius: 10px;
        background: #ecfdf5; border: 1px solid #6ee7b7;
        font-size: 13px; color: #065f46; font-weight: 500;
        margin-bottom: 20px; animation: slideDown .3s ease;
    }
    @keyframes slideDown { from{opacity:0;transform:translateY(-8px)} to{opacity:1;transform:translateY(0)} }

    /* ── TABLE CARD ── */
    .table-card { background: white; border-radius: 14px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.06); }
    .table-card-header {
        display: flex; align-items: center; justify-content: space-between;
        padding: 16px 20px; border-bottom: 1px solid #e2e8f0; background: #f8fafc;
    }
    .table-card-title { font-size: 14px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 8px; }
    .table-card-title i { color: #2563eb; }

    /* ── TABLE ── */
    .inf-tbl { width: 100%; border-collapse: collapse; font-size: 13px; }
    .inf-tbl thead th {
        padding: 11px 16px; text-align: left; font-size: 11px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .06em;
        color: #64748b; background: #f8fafc; border-bottom: 1px solid #e2e8f0;
    }
    .inf-tbl tbody td { padding: 14px 16px; border-bottom: 1px solid #f1f5f9; color: #334155; vertical-align: middle; }
    .inf-tbl tbody tr:last-child td { border-bottom: none; }
    .inf-tbl tbody tr { transition: background .15s; }
    .inf-tbl tbody tr:hover td { background: #f8fafc; }

    .row-num { width: 28px; height: 28px; border-radius: 7px; background: #eff6ff; color: #2563eb; font-size: 11px; font-weight: 700; display: inline-flex; align-items: center; justify-content: center; }

    /* thumb */
    .berita-thumb {
        width: 52px; height: 40px; border-radius: 8px;
        background: #f1f5f9; overflow: hidden; flex-shrink: 0;
        display: flex; align-items: center; justify-content: center;
        color: #94a3b8; font-size: 20px;
    }
    .berita-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .berita-title { font-weight: 700; color: #0f172a; font-size: 13px; max-width: 320px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; }
    .berita-cat   { font-size: 11px; color: #64748b; margin-top: 2px; }

    /* status badges */
    .bdg { display: inline-flex; align-items: center; gap: 5px; padding: 3px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
    .bdg-publish { background: #ecfdf5; color: #059669; }
    .bdg-draft   { background: #fffbeb; color: #d97706; }
    .bdg-dot { width: 6px; height: 6px; border-radius: 50%; }
    .bdg-publish .bdg-dot { background: #059669; }
    .bdg-draft   .bdg-dot { background: #d97706; }

    /* action buttons */
    .act-btn { display: inline-flex; align-items: center; gap: 5px; padding: 5px 12px; border-radius: 7px; font-size: 12px; font-weight: 600; border: none; cursor: pointer; text-decoration: none; transition: all .15s; }
    .act-edit  { background: #eff6ff; color: #2563eb; }
    .act-edit:hover  { background: #dbeafe; color: #1d4ed8; }
    .act-del   { background: #fef2f2; color: #dc2626; }
    .act-del:hover   { background: #fee2e2; color: #b91c1c; }

    /* ── EMPTY STATE ── */
    .empty-state { text-align: center; padding: 60px 20px; }
    .empty-icon { width: 64px; height: 64px; border-radius: 50%; background: #f1f5f9; margin: 0 auto 16px; display: flex; align-items: center; justify-content: center; font-size: 28px; color: #cbd5e1; }
    .empty-state h3 { font-size: 15px; font-weight: 700; color: #475569; margin: 0 0 6px; }
    .empty-state p  { font-size: 13px; color: #94a3b8; margin: 0 0 20px; }

    /* ── MODAL HAPUS ── */
    .modal-overlay { display: none; position: fixed; inset: 0; background: rgba(15,23,42,.5); z-index: 9999; align-items: center; justify-content: center; backdrop-filter: blur(2px); }
    .modal-overlay.show { display: flex; }
    .modal-box { background: white; border-radius: 16px; padding: 28px; width: 100%; max-width: 400px; box-shadow: 0 20px 60px rgba(0,0,0,.2); animation: popIn .2s ease; }
    @keyframes popIn { from{opacity:0;transform:scale(.95)} to{opacity:1;transform:scale(1)} }
    .modal-icon { width: 52px; height: 52px; border-radius: 50%; background: #fef2f2; color: #dc2626; display: flex; align-items: center; justify-content: center; font-size: 24px; margin: 0 auto 16px; }
    .modal-title { font-size: 17px; font-weight: 800; color: #0f172a; text-align: center; margin: 0 0 8px; }
    .modal-desc  { font-size: 13px; color: #64748b; text-align: center; margin: 0 0 24px; }
    .modal-name  { font-weight: 700; color: #0f172a; }
    .modal-btns  { display: flex; gap: 10px; }
    .btn-cancel  { flex: 1; padding: 10px; border-radius: 9px; border: 1px solid #e2e8f0; background: white; font-size: 13px; font-weight: 600; color: #64748b; cursor: pointer; transition: all .15s; }
    .btn-cancel:hover { background: #f8fafc; }
    .btn-hapus   { flex: 1; padding: 10px; border-radius: 9px; border: none; background: #dc2626; font-size: 13px; font-weight: 700; color: white; cursor: pointer; transition: all .15s; }
    .btn-hapus:hover { background: #b91c1c; }
</style>
@endpush

@section('content')

@include('admin.partials.header')

<div class="inf-page">

    {{-- HERO --}}
    <div class="inf-hero">
        <div class="inf-hero-content">
            <div>
                <h1><i class="bi bi-newspaper me-2"></i>Manajemen Berita</h1>
                <p>Kelola semua berita dan informasi Kelurahan Teritih</p>
            </div>
            <a href="{{ route('berita-admin.create') }}" class="btn-tulis">
                <i class="bi bi-plus-lg"></i> Tulis Berita Baru
            </a>
        </div>
    </div>

    {{-- STATS BAR --}}
    <div class="stats-bar">
        <div class="stat-item">
            <div class="stat-num">{{ $data->count() }}</div>
            <div class="stat-lbl">Total Berita</div>
        </div>
        <div class="stat-item">
            <div class="stat-num" style="color:#059669">{{ $data->where('status','publish')->count() }}</div>
            <div class="stat-lbl">Publish</div>
        </div>
        <div class="stat-item">
            <div class="stat-num" style="color:#d97706">{{ $data->where('status','draft')->count() }}</div>
            <div class="stat-lbl">Draft</div>
        </div>
    </div>

    {{-- CONTENT --}}
    <div class="inf-content">

        @if(session('success'))
        <div class="alert-success">
            <i class="bi bi-check-circle-fill"></i> {{ session('success') }}
        </div>
        @endif

        <div class="table-card">
            <div class="table-card-header">
                <div class="table-card-title">
                    <i class="bi bi-list-ul"></i> Daftar Berita
                </div>
                <span style="font-size:12px;color:#64748b">{{ $data->count() }} berita terdaftar</span>
            </div>

            @if($data->isEmpty())
            <div class="empty-state">
                <div class="empty-icon"><i class="bi bi-newspaper"></i></div>
                <h3>Belum ada berita</h3>
                <p>Tulis berita pertama untuk menginformasikan warga.</p>
                <a href="{{ route('berita-admin.create') }}" class="btn-tulis" style="display:inline-flex;">
                    <i class="bi bi-plus-lg"></i> Tulis Sekarang
                </a>
            </div>
            @else
            <table class="inf-tbl">
                <thead>
                    <tr>
                        <th style="width:52px">No</th>
                        <th>Berita</th>
                        <th>Kategori</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th style="width:140px;text-align:center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $item)
                    <tr>
                        <td><span class="row-num">{{ $loop->iteration }}</span></td>
                        <td>
                            <div class="d-flex align-items-center gap-3">
                                <div class="berita-thumb">
                                    @if($item->gambar)
                                        <img src="{{ asset('storage/'.$item->gambar) }}" alt="">
                                    @else
                                        <i class="bi bi-image"></i>
                                    @endif
                                </div>
                                <div>
                                    <div class="berita-title" title="{{ $item->judul }}">{{ $item->judul }}</div>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span style="background:#f1f5f9;color:#475569;padding:3px 10px;border-radius:6px;font-size:11px;font-weight:600;">
                                {{ $item->kategori ?? '-' }}
                            </span>
                        </td>
                        <td>
                            @if($item->status == 'publish')
                                <span class="bdg bdg-publish"><span class="bdg-dot"></span> Publish</span>
                            @else
                                <span class="bdg bdg-draft"><span class="bdg-dot"></span> Draft</span>
                            @endif
                        </td>
                        <td style="font-size:12px;color:#64748b">
                            {{ $item->tanggal_publish ? \Carbon\Carbon::parse($item->tanggal_publish)->format('d M Y') : '-' }}
                        </td>
                        <td>
                            <div class="d-flex gap-2 justify-content-center">
                                <a href="{{ route('berita-admin.edit', $item->id_berita) }}" class="act-btn act-edit">
                                    <i class="bi bi-pencil"></i> Edit
                                </a>
                                <button type="button" class="act-btn act-del"
                                    onclick="showDeleteModal('{{ $item->id_berita }}', '{{ addslashes($item->judul) }}')">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @endif
        </div>

    </div>
</div>

{{-- MODAL HAPUS --}}
<div class="modal-overlay" id="deleteModal">
    <div class="modal-box">
        <div class="modal-icon"><i class="bi bi-trash3"></i></div>
        <div class="modal-title">Hapus Berita?</div>
        <div class="modal-desc">
            Anda akan menghapus "<span class="modal-name" id="modalBeritaName"></span>". Tindakan ini tidak dapat dibatalkan.
        </div>
        <div class="modal-btns">
            <button class="btn-cancel" onclick="hideDeleteModal()">Batal</button>
            <form id="deleteForm" method="POST" style="flex:1">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn-hapus" style="width:100%">Ya, Hapus</button>
            </form>
        </div>
    </div>
</div>

@include('admin.partials.footer')

@endsection

@push('scripts')
<script>
function showDeleteModal(id, name) {
    document.getElementById('modalBeritaName').textContent = name;
    document.getElementById('deleteForm').action = `/admin/berita-admin/${id}`;
    document.getElementById('deleteModal').classList.add('show');
}
function hideDeleteModal() {
    document.getElementById('deleteModal').classList.remove('show');
}
document.getElementById('deleteModal').addEventListener('click', function(e) {
    if (e.target === this) hideDeleteModal();
});
</script>
@endpush
