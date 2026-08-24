@extends('Admin.layouts.app')

@section('title', 'Data Warga')

@push('styles')<style>
body{font-family:'Plus Jakarta Sans',sans-serif;background:#f1f5f9}
.back-bar{display:flex;align-items:center;gap:8px;padding:14px 32px;background:white;border-bottom:1px solid #e2e8f0;font-size:13px}
.back-btn{display:inline-flex;align-items:center;gap:6px;color:#64748b;text-decoration:none;font-weight:600;padding:5px 10px;border-radius:7px;transition:all .15s}
.back-btn:hover{background:#f1f5f9;color:#1c64f2}
.bc-sep{color:#cbd5e1}.bc-cur{color:#0f172a;font-weight:600}

.warga-hero{background:linear-gradient(135deg,#0d1b3e 0%,#1c64f2 50%,#60a5fa 100%);padding:28px 32px}
.warga-hero h1{font-size:22px;font-weight:800;color:white;margin:0 0 4px}
.warga-hero p{font-size:13px;color:rgba(255,255,255,.75);margin:0}

.warga-content{padding:28px 32px}
.alert-success{display:flex;align-items:flex-start;gap:10px;padding:12px 16px;border-radius:10px;margin-bottom:20px;background:#ecfdf5;border:1px solid #6ee7b7;font-size:13px;color:#065f46;font-weight:500}
.alert-danger{display:flex;flex-direction:column;gap:4px;padding:12px 16px;border-radius:10px;margin-bottom:20px;background:#fef2f2;border:1px solid #fca5a5;font-size:13px;color:#991b1b;font-weight:500}

.toolbar{display:flex;gap:12px;flex-wrap:wrap;align-items:center;justify-content:space-between;margin-bottom:18px}
.search-group{display:flex;gap:10px;flex-wrap:wrap;align-items:center;flex:1;min-width:0}

/* Search input wrapper */
.search-input-wrap{position:relative;flex:1;min-width:200px;max-width:380px}
.search-input-wrap .search-icon{position:absolute;left:12px;top:50%;transform:translateY(-50%);color:#94a3b8;font-size:15px;pointer-events:none;transition:color .2s}
.search-input-wrap input[type=text]{width:100%;padding:9px 36px 9px 36px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;font-family:inherit;background:#fff;transition:border-color .2s,box-shadow .2s;box-sizing:border-box}
.search-input-wrap input[type=text]:focus{outline:none;border-color:#1c64f2;box-shadow:0 0 0 3px rgba(28,100,242,.1)}
.search-input-wrap input[type=text]:focus ~ .search-icon,
.search-input-wrap:focus-within .search-icon{color:#1c64f2}
/* Clear button */
.search-clear-btn{position:absolute;right:10px;top:50%;transform:translateY(-50%);background:none;border:none;cursor:pointer;color:#94a3b8;font-size:14px;padding:2px 4px;border-radius:4px;display:none;line-height:1;transition:color .15s}
.search-clear-btn:hover{color:#dc2626}
.search-clear-btn.visible{display:flex;align-items:center}
/* Spinner inside input */
.search-spinner{position:absolute;right:10px;top:50%;transform:translateY(-50%);display:none;width:14px;height:14px;border:2px solid #e2e8f0;border-top-color:#1c64f2;border-radius:50%;animation:spin .6s linear infinite}
.search-spinner.visible{display:block}
@keyframes spin{to{transform:translateY(-50%) rotate(360deg)}}

/* RW select */
.search-rw-select{padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;font-family:inherit;background:white;cursor:pointer;transition:border-color .2s}
.search-rw-select:focus{outline:none;border-color:#1c64f2;box-shadow:0 0 0 3px rgba(28,100,242,.1)}

/* Reset badge */
.search-reset-btn{display:inline-flex;align-items:center;gap:5px;padding:8px 13px;border-radius:9px;border:1.5px solid #fca5a5;background:#fef2f2;font-size:12px;font-weight:600;color:#dc2626;text-decoration:none;white-space:nowrap;transition:all .15s}
.search-reset-btn:hover{background:#fee2e2;border-color:#f87171;color:#b91c1c}

/* Result info bar */
.search-result-info{display:flex;align-items:center;gap:8px;padding:9px 14px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:9px;font-size:12.5px;color:#475569;margin-bottom:14px;flex-wrap:wrap}
.search-result-info .sri-badge{background:#1c64f2;color:white;border-radius:20px;padding:2px 9px;font-size:11px;font-weight:700}
.search-result-info .sri-query{font-weight:700;color:#0f172a}
.search-result-info.is-empty{background:#fef2f2;border-color:#fca5a5;color:#991b1b}
.search-result-info.is-empty .sri-badge{background:#dc2626}

.btn-simpan{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:9px;border:none;background:#1c64f2;font-size:13px;font-weight:700;color:white;cursor:pointer;text-decoration:none;white-space:nowrap}
.btn-simpan:hover{background:#1a56db;color:white}
.btn-batal{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:9px;border:1.5px solid #e2e8f0;background:white;font-size:13px;font-weight:600;color:#64748b;text-decoration:none}
.btn-batal:hover{background:#f8fafc}

@media(max-width:640px){
    .toolbar{flex-direction:column;align-items:stretch}
    .search-group{flex-direction:column;align-items:stretch}
    .search-input-wrap{max-width:100%}
    .btn-simpan,.search-reset-btn{justify-content:center}
}

/* ── Import Banner ── */
.import-banner {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 14px;
    padding: 18px 22px;
    margin-bottom: 20px;
    display: flex;
    align-items: center;
    justify-content: space-between;
    gap: 16px;
    flex-wrap: wrap;
    box-shadow: 0 1px 3px rgba(0,0,0,.06);
}
.import-banner-left {
    display: flex;
    align-items: center;
    gap: 14px;
}
.import-banner-icon {
    width: 42px; height: 42px;
    border-radius: 10px;
    background: #ecfdf5;
    color: #10b981;
    display: flex; align-items: center; justify-content: center;
    font-size: 20px;
    flex-shrink: 0;
}
.import-banner-title {
    font-size: 14px;
    font-weight: 700;
    color: #0f172a;
    margin-bottom: 2px;
}
.import-banner-sub {
    font-size: 12px;
    color: #64748b;
    line-height: 1.5;
}
.import-banner-right {
    display: flex;
    align-items: center;
    gap: 10px;
    flex-wrap: wrap;
}
/* Tombol Download Template */
.btn-template {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 16px;
    border-radius: 9px;
    border: 1.5px solid #d1fae5;
    background: #ecfdf5;
    color: #059669;
    font-size: 13px; font-weight: 600;
    text-decoration: none;
    transition: all .15s;
    white-space: nowrap;
}
.btn-template:hover { background: #d1fae5; border-color: #6ee7b7; color: #047857; }

/* Form import wrapper */
.import-form {
    display: flex;
    align-items: center;
    gap: 8px;
    flex-wrap: wrap;
}
/* Label custom untuk input file */
.btn-choose-file {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 16px;
    border-radius: 9px;
    border: 1.5px solid #e2e8f0;
    background: white;
    color: #334155;
    font-size: 13px; font-weight: 600;
    cursor: pointer;
    transition: all .15s;
    white-space: nowrap;
    max-width: 180px;
    overflow: hidden;
    text-overflow: ellipsis;
}
.btn-choose-file:hover { border-color: #93c5fd; background: #eff6ff; color: #1c64f2; }
/* Sembunyikan input file asli */
#fileImportInput { display: none; }
/* Tombol Import — disabled sampai file dipilih */
.btn-import {
    display: inline-flex; align-items: center; gap: 7px;
    padding: 9px 18px;
    border-radius: 9px;
    border: none;
    background: #1c64f2;
    color: white;
    font-size: 13px; font-weight: 700;
    cursor: pointer;
    font-family: inherit;
    transition: all .15s;
    white-space: nowrap;
}
.btn-import:hover:not(:disabled) { background: #1a56db; }
.btn-import:disabled {
    background: #e2e8f0;
    color: #94a3b8;
    cursor: not-allowed;
}
@media(max-width:768px){
    .import-banner { flex-direction: column; align-items: flex-start; }
    .import-banner-right { width: 100%; }
    .btn-choose-file { max-width: 100%; }
}

.warga-card{background:white;border-radius:14px;border:1px solid #e2e8f0;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.06)}
table.warga-table{width:100%;border-collapse:collapse;font-size:13px}
table.warga-table th{background:#f8fafc;text-align:left;padding:12px 16px;font-weight:700;color:#64748b;text-transform:uppercase;font-size:11px;letter-spacing:.04em;border-bottom:1px solid #e2e8f0}
table.warga-table td{padding:12px 16px;border-bottom:1px solid #f1f5f9;color:#0f172a}
table.warga-table tr:last-child td{border-bottom:none}
.badge-jk{padding:3px 9px;border-radius:20px;font-size:11px;font-weight:700}
.badge-l{background:#eff6ff;color:#1c64f2}
.badge-p{background:#fdf2f8;color:#db2777}
.aksi-links{display:flex;gap:10px}
.aksi-links a{color:#1c64f2;text-decoration:none;font-size:12px;font-weight:600}
.aksi-links button{background:none;border:none;color:#dc2626;font-size:12px;font-weight:600;cursor:pointer;padding:0;font-family:inherit}
.empty-state{padding:48px 20px;text-align:center;color:#94a3b8;font-size:13px}
.pagination-wrap{padding:14px 20px;border-top:1px solid #e2e8f0;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:10px}

/* Modal konfirmasi hapus */
.modal-hapus-overlay{display:none;position:fixed;inset:0;background:rgba(15,23,42,.5);backdrop-filter:blur(2px);z-index:9999;align-items:center;justify-content:center;padding:16px}
.modal-hapus-overlay.show{display:flex}
.modal-hapus-box{background:white;border-radius:18px;width:100%;max-width:380px;overflow:hidden;box-shadow:0 24px 64px rgba(0,0,0,.25);animation:modalSlideIn .25s ease}
@keyframes modalSlideIn{from{opacity:0;transform:scale(.92) translateY(-12px)}to{opacity:1;transform:scale(1) translateY(0)}}
.modal-hapus-header{padding:20px 22px 0;display:flex;align-items:flex-start;gap:14px}
.modal-hapus-icon{width:44px;height:44px;border-radius:12px;background:#fef2f2;color:#dc2626;display:flex;align-items:center;justify-content:center;font-size:20px;flex-shrink:0}
.modal-hapus-body{padding:8px 22px 0 80px;font-size:13px;color:#475569;line-height:1.6}
.modal-hapus-name{font-weight:700;color:#0f172a}
.modal-hapus-footer{display:flex;gap:10px;padding:20px 22px 22px}

/* Override Laravel default pagination */
.pagination-wrap nav{width:100%}
.pagination-wrap nav > div:first-child{font-size:12px;color:#64748b}
.pagination-wrap nav > div:last-child{display:flex;flex-wrap:wrap;gap:4px;align-items:center}

/* Sembunyikan teks "Showing X to Y of Z results" default — diganti custom */
.pagination-wrap [role="navigation"] p,
.pagination-wrap nav p{font-size:12px;color:#64748b;margin:0}

/* Tombol pagination */
.pagination-wrap span[aria-current="page"] > span,
.pagination-wrap a,
.pagination-wrap span > span{
    display:inline-flex;align-items:center;justify-content:center;
    min-width:32px;height:32px;padding:0 10px;
    border-radius:7px;
    border:1.5px solid #e2e8f0;
    background:white;
    font-size:12px;font-weight:600;
    color:#475569;
    text-decoration:none;
    transition:all .15s;
    line-height:1;
}
.pagination-wrap a:hover{border-color:#1c64f2;color:#1c64f2;background:#eff6ff}
/* Halaman aktif */
.pagination-wrap span[aria-current="page"] > span{
    background:#1c64f2;border-color:#1c64f2;color:white;cursor:default;
}
/* Disabled (Previous/Next yang tidak bisa diklik) */
.pagination-wrap span > span:not([aria-current]){
    background:#f8fafc;color:#cbd5e1;cursor:default;border-color:#f1f5f9;
}
/* Ellipsis … */
.pagination-wrap span > span.cursor-default{
    border:none;background:transparent;color:#94a3b8;min-width:20px;padding:0;
}
/* Fix SVG icon Previous/Next agar kecil */
.pagination-wrap svg{width:12px;height:12px;display:inline-block;vertical-align:middle}

</style>
@endpush

@section('content')
@include('Admin.partials.header')

<div>
    <div class="back-bar">
        <a href="{{ route('admin.statistik.edit') }}" class="back-btn"><i class="bi bi-arrow-left"></i> Kembali</a>
        <span class="bc-sep">/</span><span class="bc-cur">Data Warga</span>
    </div>

    <div class="warga-hero">
        <h1><i class="bi bi-people-fill me-2"></i>Data Warga</h1>
        <p>Cari, lihat, tambah, ubah, dan hapus data warga — statistik demografi akan otomatis dihitung ulang</p>
    </div>

    <div class="warga-content">

        @if(session('success'))
        <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        @if(session('import_summary'))
            @php
                $sum = session('import_summary');
                $sumBg     = $sum['berhasil'] > 0 ? '#ecfdf5' : '#fef2f2';
                $sumBorder = $sum['berhasil'] > 0 ? '#6ee7b7' : '#fca5a5';
                $sumColor  = $sum['berhasil'] > 0 ? '#065f46' : '#991b1b';
            @endphp
            <div class="alert-success" style="flex-direction:column;align-items:flex-start;gap:6px;background:{{ $sumBg }};border-color:{{ $sumBorder }};color:{{ $sumColor }}">
                <div><i class="bi bi-file-earmark-check-fill"></i> <strong>Import selesai:</strong> {{ $sum['berhasil'] }} warga berhasil ditambahkan, {{ count($sum['gagal']) }} baris dilewati.</div>
                @if(count($sum['gagal']))
                    <ul style="margin:4px 0 0 18px;font-size:12px;padding:0">
                        @foreach($sum['gagal'] as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif

        @if(session('import_errors'))
            <div class="alert-danger">
                @foreach(session('import_errors') as $err)
                    <div><i class="bi bi-exclamation-triangle-fill"></i> {{ $err }}</div>
                @endforeach
            </div>
        @endif

        @if($errors->any())
            <div class="alert-danger">
                @foreach($errors->all() as $err)
                    <div><i class="bi bi-exclamation-triangle-fill"></i> {{ $err }}</div>
                @endforeach
            </div>
        @endif

        {{-- Import CSV data warga --}}
        <div class="import-banner">
            <div class="import-banner-left">
                <div class="import-banner-icon">
                    <i class="bi bi-file-earmark-excel-fill" style="color:#10b981"></i>
                </div>
                <div>
                    <div class="import-banner-title">Import Data Warga via Excel / CSV</div>
                    <div class="import-banner-sub">Tambah banyak data sekaligus dari file Excel (.xlsx) atau CSV. Download template terlebih dahulu agar format sesuai.</div>
                </div>
            </div>
            <div class="import-banner-right">
                <a href="{{ route('admin.warga.template') }}" class="btn-template">
                    <i class="bi bi-download"></i>
                    <span>Download Template</span>
                </a>
                <form action="{{ route('admin.warga.import') }}" method="POST"
                      enctype="multipart/form-data" id="importForm" class="import-form">
                    @csrf
                    <label class="btn-choose-file" for="fileImportInput" id="fileLabel">
                        <i class="bi bi-paperclip"></i>
                        <span id="fileLabelText">Pilih File Excel/CSV</span>
                    </label>
                    <input type="file" id="fileImportInput" name="file_import"
                           accept=".xlsx,.xls,.csv,application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel,text/csv"
                           required
                           onchange="updateFileLabel(this)">
                    <button type="submit" class="btn-import" id="btnImport" disabled>
                        <i class="bi bi-cloud-upload-fill"></i>
                        <span>Import</span>
                    </button>
                </form>
            </div>
        </div>

        {{-- Toolbar: live search + RW filter --}}
        <div class="toolbar">
            <div class="search-group">
                {{-- Search input --}}
                <div class="search-input-wrap">
                    <i class="bi bi-search search-icon" id="searchIconEl"></i>
                    <input type="text"
                           id="searchInput"
                           placeholder="Cari nama atau NIK..."
                           value="{{ $q }}"
                           autocomplete="off"
                           aria-label="Cari warga">
                    <div class="search-spinner" id="searchSpinner"></div>
                    <button type="button" class="search-clear-btn {{ $q ? 'visible' : '' }}"
                            id="searchClearBtn"
                            onclick="clearSearch()"
                            title="Hapus pencarian"
                            aria-label="Hapus pencarian">
                        <i class="bi bi-x-lg"></i>
                    </button>
                </div>

                {{-- RW filter --}}
                <select id="rwSelect" class="search-rw-select" aria-label="Filter RW">
                    <option value="">Semua RW</option>
                    @foreach($daftarRw as $rwOpt)
                        <option value="{{ $rwOpt }}" @selected($rwFilter == $rwOpt)>RW {{ $rwOpt }}</option>
                    @endforeach
                </select>

                {{-- Reset (tampil hanya saat ada filter aktif) --}}
                <a href="{{ route('admin.warga.index') }}"
                   id="resetBtn"
                   class="search-reset-btn"
                   @if($q || $rwFilter) style="" @else style="display:none" @endif
                   aria-label="Reset pencarian">
                    <i class="bi bi-x-circle-fill"></i> Reset
                </a>
            </div>

            <a href="{{ route('admin.warga.create') }}" class="btn-simpan">
                <i class="bi bi-person-plus-fill"></i> Tambah Warga
            </a>
        </div>

        {{-- Result info bar --}}
        @if($q || $rwFilter)
        <div class="search-result-info {{ $warga->total() === 0 ? 'is-empty' : '' }}" id="resultInfo">
            <span class="sri-badge">{{ $warga->total() }}</span>
            warga ditemukan
            @if($q)
                untuk <span class="sri-query">"{{ $q }}"</span>
            @endif
            @if($rwFilter)
                di <span class="sri-query">RW {{ $rwFilter }}</span>
            @endif
        </div>
        @else
        <div class="search-result-info" id="resultInfo" style="display:none"></div>
        @endif

        <div class="warga-card">
            @if($warga->count() === 0)
                <div class="empty-state">
                    <i class="bi bi-people" style="font-size:32px;display:block;margin-bottom:8px"></i>
                    Belum ada data warga{{ $q || $rwFilter ? ' yang cocok dengan pencarian' : '' }}.
                </div>
            @else
                <table class="warga-table">
                    <thead>
                        <tr>
                            <th>Nama</th>
                            <th>NIK</th>
                            <th>JK</th>
                            <th>Umur</th>
                            <th>Agama</th>
                            <th>RT/RW</th>
                            <th style="text-align:right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($warga as $w)
                        <tr>
                            <td><strong>{{ $w->nama }}</strong></td>
                            <td>{{ $w->nik ?? '—' }}</td>
                            <td><span class="badge-jk {{ $w->jenis_kelamin === 'L' ? 'badge-l' : 'badge-p' }}">{{ $w->jenis_kelamin }}</span></td>
                            <td>{{ $w->umur }} th</td>
                            <td>{{ $w->agama }}</td>
                            <td>{{ $w->rt }}/{{ $w->rw }}</td>
                            <td>
                                <div class="aksi-links" style="justify-content:flex-end">
                                    <a href="{{ route('admin.warga.edit', $w) }}"><i class="bi bi-pencil-fill"></i> Edit</a>
                                    <form action="{{ route('admin.warga.destroy', $w) }}" method="POST"
                                          id="formHapus_{{ $w->id }}" style="display:none">
                                        @csrf @method('DELETE')
                                    </form>
                                    <button type="button"
                                            onclick="bukaMModalHapus('{{ $w->id }}','{{ addslashes($w->nama) }}')"
                                            style="background:none;border:none;color:#dc2626;font-size:12px;font-weight:600;cursor:pointer;padding:0;font-family:inherit">
                                        <i class="bi bi-trash-fill"></i> Hapus
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-wrap">{{ $warga->links() }}</div>
            @endif
        </div>

    </div>
</div>

{{-- Modal konfirmasi hapus warga --}}
<div class="modal-hapus-overlay" id="modalHapusWarga">
    <div class="modal-hapus-box">
        <div class="modal-hapus-header">
            <div class="modal-hapus-icon"><i class="bi bi-trash3-fill"></i></div>
            <div>
                <div style="font-size:16px;font-weight:800;color:#0f172a;margin-bottom:2px">Hapus Data Warga?</div>
                <div style="font-size:12px;color:#94a3b8">Tindakan ini tidak dapat dibatalkan</div>
            </div>
        </div>
        <div class="modal-hapus-body">
            Anda akan menghapus data warga
            <span class="modal-hapus-name" id="modalHapusNama"></span>.
            Statistik demografi akan dihitung ulang secara otomatis.
        </div>
        <div class="modal-hapus-footer">
            <button type="button" onclick="tutupModalHapus()"
                style="flex:1;padding:10px;border-radius:9px;border:1.5px solid #e2e8f0;background:white;font-size:13px;font-weight:600;color:#64748b;cursor:pointer;font-family:inherit;transition:all .15s"
                onmouseover="this.style.background='#f8fafc'" onmouseout="this.style.background='white'">
                Batal
            </button>
            <button type="button" onclick="konfirmasiHapus()"
                style="flex:1;padding:10px;border-radius:9px;border:none;background:#dc2626;font-size:13px;font-weight:700;color:white;cursor:pointer;font-family:inherit;transition:all .15s"
                onmouseover="this.style.background='#b91c1c'" onmouseout="this.style.background='#dc2626'">
                <i class="bi bi-trash3-fill"></i> Ya, Hapus
            </button>
        </div>
    </div>
</div>

@push('scripts')
<script>
/* ── Modal Konfirmasi Hapus Warga ── */
var _hapusId = null;
function bukaMModalHapus(id, nama) {
    _hapusId = id;
    document.getElementById('modalHapusNama').textContent = nama;
    document.getElementById('modalHapusWarga').classList.add('show');
    document.body.style.overflow = 'hidden';
}
function tutupModalHapus() {
    _hapusId = null;
    document.getElementById('modalHapusWarga').classList.remove('show');
    document.body.style.overflow = '';
}
function konfirmasiHapus() {
    if (!_hapusId) return;
    var form = document.getElementById('formHapus_' + _hapusId);
    if (form) form.submit();
}
document.addEventListener('DOMContentLoaded', function () {
    var overlay = document.getElementById('modalHapusWarga');
    if (!overlay) return;
    overlay.addEventListener('click', function (e) {
        if (e.target === overlay) tutupModalHapus();
    });
    document.addEventListener('keydown', function (e) {
        if (e.key === 'Escape') tutupModalHapus();
    });
});

/* ── File import label ── */
function updateFileLabel(input) {
    const label     = document.getElementById('fileLabelText');
    const btnImport = document.getElementById('btnImport');
    if (input.files && input.files.length > 0) {
        const name = input.files[0].name;
        label.textContent = name.length > 22 ? name.substring(0, 20) + '…' : name;
        btnImport.disabled = false;
    } else {
        label.textContent = 'Pilih File Excel/CSV';
        btnImport.disabled = true;
    }
}

/* ── Live Search ── */
(function () {
    const BASE_URL   = '{{ route('admin.warga.index') }}';
    const input      = document.getElementById('searchInput');
    const rwSelect   = document.getElementById('rwSelect');
    const spinner    = document.getElementById('searchSpinner');
    const clearBtn   = document.getElementById('searchClearBtn');
    const resetBtn   = document.getElementById('resetBtn');
    const resultInfo = document.getElementById('resultInfo');

    let debounceTimer = null;

    /* Expose clearSearch untuk onclick di HTML */
    window.clearSearch = function () {
        input.value = '';
        clearBtn.classList.remove('visible');
        clearTimeout(debounceTimer);
        doSearch();
    };

    /* Sinkron URL bar + navigasi tanpa full-reload pakai pushState */
    function doSearch(pushHistory = true) {
        const q  = input.value.trim();
        const rw = rwSelect.value;

        /* Bangun URL query */
        const params = new URLSearchParams();
        if (q)  params.set('q',  q);
        if (rw) params.set('rw', rw);
        const url = BASE_URL + (params.toString() ? '?' + params.toString() : '');

        /* Update browser URL tanpa reload */
        if (pushHistory) history.pushState({q, rw}, '', url);

        /* Tampilkan/sembunyikan clear & reset */
        clearBtn.classList.toggle('visible', q.length > 0);
        resetBtn.style.display = (q || rw) ? '' : 'none';

        /* Loading state */
        spinner.classList.add('visible');
        clearBtn.style.display = 'none'; /* sembunyikan sementara */

        fetch(url, {headers: {'X-Requested-With': 'XMLHttpRequest'}})
            .then(r => r.text())
            .then(html => {
                /* Parse hasil fetch — ambil konten .warga-card dan result-info */
                const doc         = new DOMParser().parseFromString(html, 'text/html');
                const newCard     = doc.querySelector('.warga-card');
                const newInfoEl   = doc.getElementById('resultInfo');
                const newPagWrap  = doc.querySelector('.pagination-wrap');

                if (newCard) {
                    document.querySelector('.warga-card').innerHTML = newCard.innerHTML;
                }

                /* Update result info bar */
                if (newInfoEl) {
                    resultInfo.innerHTML   = newInfoEl.innerHTML;
                    resultInfo.className   = newInfoEl.className;
                    resultInfo.style.display = (q || rw) ? '' : 'none';
                }
            })
            .catch(() => {
                /* Fallback: full page reload jika fetch gagal */
                window.location.href = url;
            })
            .finally(() => {
                spinner.classList.remove('visible');
                clearBtn.classList.toggle('visible', input.value.trim().length > 0);
                if (input.value.trim().length === 0) clearBtn.style.display = '';
                else clearBtn.style.removeProperty('display');
            });
    }

    /* Debounce pada typing (500 ms) */
    input.addEventListener('input', function () {
        clearTimeout(debounceTimer);
        /* Langsung toggle clear button */
        clearBtn.classList.toggle('visible', this.value.length > 0);
        debounceTimer = setTimeout(() => doSearch(), 500);
    });

    /* Enter juga trigger langsung */
    input.addEventListener('keydown', function (e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(debounceTimer);
            doSearch();
        }
    });

    /* RW berubah → langsung cari */
    rwSelect.addEventListener('change', function () {
        clearTimeout(debounceTimer);
        doSearch();
    });

    /* Tombol Reset — bersihkan state lalu navigate */
    resetBtn.addEventListener('click', function (e) {
        e.preventDefault();
        input.value = '';
        rwSelect.value = '';
        clearBtn.classList.remove('visible');
        doSearch();
    });

    /* Back/Forward browser */
    window.addEventListener('popstate', function (e) {
        if (e.state) {
            input.value    = e.state.q  || '';
            rwSelect.value = e.state.rw || '';
            clearBtn.classList.toggle('visible', input.value.length > 0);
        }
        doSearch(false);
    });

    /* Fokus otomatis ke input saat halaman dimuat */
    /* (hanya jika tidak sedang di mobile) */
    if (window.innerWidth > 768) input.focus();
})();
</script>
@endpush
@endsection
