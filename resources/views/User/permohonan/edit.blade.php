<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Permohonan – Kelurahan Teritih</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root{--blue:#1c64f2;--blue-dk:#1a56db;--blue-lt:#eff6ff;--navy:#0f172a;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;--green:#059669;--red:#dc2626}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--navy);font-size:14px}

.page-wrap{max-width:960px;margin:0 auto;padding:28px 16px 60px;display:grid;grid-template-columns:1fr 300px;gap:24px;align-items:start}
@media(max-width:768px){.page-wrap{grid-template-columns:1fr}}

.breadcrumb-bar{background:white;border-bottom:1px solid var(--border);padding:12px 16px;font-size:12px;color:var(--muted);display:flex;gap:6px;align-items:center}
.breadcrumb-bar a{color:var(--muted);text-decoration:none}.breadcrumb-bar a:hover{color:var(--blue)}
.breadcrumb-bar .current{color:var(--blue);font-weight:600}

.page-header-wrap{padding:20px 16px 0;max-width:960px;margin:0 auto}
.page-header-wrap h1{font-size:22px;font-weight:800;color:var(--navy);margin:0 0 4px}
.page-header-wrap p{font-size:13px;color:var(--muted);margin:0 0 20px}

.form-card{background:white;border-radius:14px;border:1px solid var(--border);overflow:hidden;box-shadow:0 1px 4px rgba(0,0,0,.06);margin-bottom:16px}
.form-card-header{padding:14px 20px;border-bottom:1px solid var(--border);background:#f8fafc;display:flex;align-items:center;justify-content:space-between;gap:12px}
.form-card-title{display:flex;align-items:center;gap:8px;font-size:13px;font-weight:700;color:var(--navy)}
.form-card-body{padding:20px}

.field-label{display:block;font-size:11.5px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.05em;margin-bottom:7px}
.field-label .req{color:var(--red);margin-left:2px}
.field-input{width:100%;padding:10px 13px;border:1.5px solid var(--border);border-radius:9px;font-size:13px;font-family:inherit;color:var(--navy);background:white;outline:none;transition:all .18s;box-sizing:border-box}
.field-input:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(28,100,242,.1)}
.field-input::placeholder{color:#94a3b8}
.field-input.readonly-field{background:#f9fafb;color:#6b7280;cursor:not-allowed}
textarea.field-input{resize:vertical;min-height:90px}

.field-row{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px}
@media(max-width:560px){.field-row{grid-template-columns:1fr}}
.field-group{margin-bottom:16px}.field-group:last-child{margin-bottom:0}
.field-error{font-size:12px;color:var(--red);margin-top:5px;display:flex;align-items:center;gap:4px}

.form-footer{padding:14px 20px;background:#f8fafc;border-top:1px solid var(--border);display:flex;align-items:center;justify-content:flex-end;gap:10px}
.btn-batal{display:inline-flex;align-items:center;gap:5px;padding:9px 18px;border-radius:9px;border:1.5px solid var(--border);background:white;font-size:13px;font-weight:600;color:var(--muted);text-decoration:none;cursor:pointer;transition:all .15s}
.btn-batal:hover{background:var(--bg);color:var(--slate)}
.btn-submit{display:inline-flex;align-items:center;gap:6px;padding:9px 22px;border-radius:9px;border:none;background:var(--blue);font-size:13px;font-weight:700;color:white;cursor:pointer;transition:all .15s}
.btn-submit:hover{background:var(--blue-dk)}

.uploaded-file{display:flex;align-items:center;gap:10px;background:#f8fafc;border:1px solid var(--border);border-radius:9px;padding:10px 14px;margin-bottom:8px}
.uploaded-file-icon{width:32px;height:32px;border-radius:7px;background:#eff6ff;display:flex;align-items:center;justify-content:center;color:var(--blue);flex-shrink:0;font-size:16px}
.uploaded-file-info{flex:1}.uploaded-file-info span{display:block;font-size:12px;font-weight:600;color:var(--navy)}
.uploaded-file-info small{font-size:11px;color:var(--muted)}

.upload-zone{border:2px dashed var(--border);border-radius:10px;padding:20px;text-align:center;cursor:pointer;transition:all .2s;background:#fafafa}
.upload-zone:hover{border-color:var(--blue);background:var(--blue-lt)}

.side-card{background:white;border-radius:14px;border:1px solid var(--border);padding:18px 20px;margin-bottom:16px;box-shadow:0 1px 4px rgba(0,0,0,.06)}
.side-card-title{font-size:13px;font-weight:700;color:var(--navy);display:flex;align-items:center;gap:7px;margin-bottom:12px}
.info-list{list-style:none;padding:0;margin:0}
.info-list li{display:flex;align-items:center;gap:8px;font-size:13px;color:var(--slate);padding:5px 0;border-bottom:1px dashed var(--border)}
.info-list li:last-child{border-bottom:none}
.info-dot{width:6px;height:6px;border-radius:50%;background:var(--blue);flex-shrink:0}
.syarat-list{list-style:none;padding:0;margin:0}
.syarat-list li{display:flex;align-items:flex-start;gap:8px;font-size:12.5px;color:var(--slate);padding:5px 0;border-bottom:1px dashed var(--border)}
.syarat-list li:last-child{border-bottom:none}
.syarat-list .chk{color:var(--green);flex-shrink:0;margin-top:1px}
.wa-card{display:flex;align-items:center;gap:12px;padding:12px 16px;border-radius:10px;background:#f0fdf4;border:1px solid #bbf7d0;text-decoration:none;transition:all .15s}
.wa-card:hover{background:#dcfce7}
.wa-icon{width:40px;height:40px;border-radius:10px;background:#22c55e;color:white;display:flex;align-items:center;justify-content:center;flex-shrink:0;font-size:20px}
.wa-text{font-size:12px;color:#166534}.wa-num{font-size:14px;font-weight:700;color:#14532d}

.alert-err{background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:var(--red)}
.alert-err ul{margin:6px 0 0 16px;padding:0}.alert-err li{margin-bottom:3px}

.badge{display:inline-flex;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700}
.badge-pending{background:#fef9c3;color:#854d0e}
.badge-disetujui{background:#dcfce7;color:#14532d}
.badge-ditolak{background:#fee2e2;color:#7f1d1d}

.file-item{display:flex;align-items:center;gap:10px;background:#f9fafb;border:1px solid #e5e7eb;border-radius:9px;padding:10px 14px;margin-top:8px}
.file-item-icon{width:32px;height:32px;border-radius:7px;display:grid;place-items:center;flex-shrink:0}
.file-item-icon.pdf{background:#fee2e2;color:#dc2626}.file-item-icon.img{background:#e0f2fe;color:#0284c7}
.file-item-icon svg{width:16px;height:16px}
.file-item-info{flex:1}
.file-item-info span{display:block;font-size:13px;font-weight:600;color:#111827;white-space:nowrap;overflow:hidden;text-overflow:ellipsis;max-width:260px}
.file-item-info small{font-size:11px;color:#9ca3af}
.btn-remove-file{width:24px;height:24px;background:#e5e7eb;border:none;border-radius:50%;cursor:pointer;display:grid;place-items:center;transition:background .15s;flex-shrink:0}
.btn-remove-file:hover{background:#fee2e2}
.btn-remove-file svg{width:11px;height:11px;color:#6b7280}
.btn-remove-file:hover svg{color:#dc2626}
</style>
</head>
<body>

@include('partials.navbar')

<div style="background:white;border-bottom:1px solid #e2e8f0;padding:12px 16px;font-size:12px;color:#64748b;display:flex;gap:6px;align-items:center">
    <a href="{{ url('/') }}" style="color:#64748b;text-decoration:none">Beranda</a>
    <span>/</span>
    <a href="{{ route('user.permohonan.index') }}" style="color:#64748b;text-decoration:none">Permohonan Saya</a>
    <span>/</span>
    <span style="color:#1c64f2;font-weight:600">Edit Permohonan</span>
</div>

<div style="max-width:960px;margin:0 auto;padding:20px 16px 0">
    <h1 style="font-size:22px;font-weight:800;color:#0f172a;margin:0 0 4px">Edit Permohonan Surat</h1>
    <p style="font-size:13px;color:#64748b;margin:0 0 20px">Perbarui data permohonan Anda. Hanya bisa diubah selama status masih <strong>Pending</strong>.</p>
</div>

<form action="{{ route('user.permohonan.update', $permohonan->id_permohonan) }}" method="POST" enctype="multipart/form-data">
@csrf @method('PUT')

<div class="page-wrap">

    <div>
        @if($errors->any())
        <div class="alert-err">
            <strong>Terdapat kesalahan:</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        {{-- DATA PEMOHON (readonly) --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">
                    <i class="bi bi-person-fill" style="color:var(--blue)"></i>
                    Data Pemohon
                </div>
            </div>
            <div class="form-card-body">
                @php
                    $isPerwakilan = !empty($permohonan->nama_pemohon) && $permohonan->nama_pemohon !== auth()->user()->nama;
                    $namaTampil   = $permohonan->nama_pemohon   ?? auth()->user()->nama    ?? '-';
                    $nikTampil    = $permohonan->nik_pemohon    ?? auth()->user()->nik     ?? '-';
                    $alamatTampil = $permohonan->alamat_pemohon ?? auth()->user()->alamat  ?? '-';
                @endphp

                @if($isPerwakilan)
                <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:8px;padding:10px 14px;margin-bottom:14px;font-size:12px;color:#92400e;display:flex;align-items:center;gap:8px">
                    <i class="bi bi-info-circle-fill" style="flex-shrink:0"></i>
                    Permohonan ini diajukan <strong>mewakili orang lain</strong>. Data di bawah adalah data orang yang diwakili.
                </div>
                @endif

                <div class="field-row">
                    <div class="field-group" style="margin-bottom:0">
                        <label class="field-label">NIK Pemohon <span class="req">*</span></label>
                        <input type="text" name="nik_pemohon" class="field-input" value="{{ $nikTampil }}" placeholder="16 digit NIK" required>
                    </div>
                    <div class="field-group" style="margin-bottom:0">
                        <label class="field-label">Nama Pemohon <span class="req">*</span></label>
                        <input type="text" name="nama_pemohon" class="field-input" value="{{ $namaTampil }}" placeholder="Nama sesuai KTP" required>
                    </div>
                </div>
                <div class="field-group" style="margin-top:16px">
                    <label class="field-label">Alamat Pemohon <span class="req">*</span></label>
                    <textarea name="alamat_pemohon" class="field-input" rows="2" placeholder="Alamat lengkap..." required>{{ $alamatTampil }}</textarea>
                </div>
            </div>
        </div>

        {{-- DETAIL PERMOHONAN --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">
                    <i class="bi bi-file-earmark-text" style="color:var(--blue)"></i>
                    Detail Permohonan
                </div>
                @php $status = $permohonan->approval->status ?? 'pending'; @endphp
                <span class="badge badge-{{ $status }}">{{ strtoupper($status) }}</span>
            </div>
            <div class="form-card-body">
                <div class="field-group">
                    <label class="field-label">Jenis Surat</label>
                    <input type="text" class="field-input readonly-field" value="{{ $permohonan->jenisSurat->nama_surat ?? '-' }}" readonly>
                </div>
                <div class="field-group">
                    <label class="field-label">Tujuan / Keperluan Surat <span class="req">*</span></label>
                    <input type="text" name="keperluan"
                           class="field-input @error('keperluan') is-error @enderror"
                           value="{{ old('keperluan', $permohonan->keperluan) }}"
                           placeholder="Contoh: Persyaratan administrasi bank..."
                           required>
                    @error('keperluan')<div class="field-error">{{ $message }}</div>@enderror
                </div>
            </div>
        </div>

        {{-- DOKUMEN --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">
                    <i class="bi bi-paperclip" style="color:var(--blue)"></i>
                    Dokumen Persyaratan
                </div>
            </div>
            <div class="form-card-body">

                @if($permohonan->persyaratan->isNotEmpty())
                <p style="font-size:12px;color:#6b7280;margin-bottom:10px">Dokumen saat ini:</p>
                @foreach($permohonan->persyaratan as $dok)
                <div class="uploaded-file">
                    <div class="uploaded-file-icon"><i class="bi bi-file-earmark-fill"></i></div>
                    <div class="uploaded-file-info">
                        <span>{{ $dok->nama_file }}</span>
                        <small>{{ $dok->jenis_dokumen ? strtoupper($dok->jenis_dokumen).' · ' : '' }}{{ $dok->uploaded_at ? \Carbon\Carbon::parse($dok->uploaded_at)->format('d M Y') : '-' }}</small>
                    </div>
                    <a href="{{ asset('storage/'.$dok->path_file) }}" target="_blank"
                       style="font-size:12px;color:var(--blue);font-weight:600;text-decoration:none;white-space:nowrap">Lihat</a>
                </div>
                @endforeach
                @endif

                @php $sisaSlot = 5 - $permohonan->persyaratan->count(); @endphp
                @if($sisaSlot > 0)
                <div class="upload-zone mt-3" onclick="document.getElementById('dokumen-edit').click()">
                    <i class="bi bi-cloud-upload" style="font-size:28px;color:#94a3b8;display:block;margin-bottom:6px"></i>
                    <p style="font-size:13px;color:#64748b;margin:0"><strong>Klik untuk tambah dokumen</strong></p>
                    <small style="font-size:11px;color:#94a3b8">Masih bisa upload {{ $sisaSlot }} file lagi — PDF, JPG, PNG (Maks. 10MB/file)</small>
                </div>
                <input type="file" id="dokumen-edit" name="dokumen[]" style="display:none"
                       accept=".pdf,.jpg,.jpeg,.png" multiple onchange="handleFilesEdit(this)">
                <div id="file-list-edit"></div>
                @else
                <div style="background:#fef9c3;border:1px solid #fde68a;border-radius:9px;padding:12px 16px;font-size:13px;color:#854d0e;margin-top:12px">
                    ⚠️ Batas maksimal 5 file telah tercapai.
                </div>
                @endif
            </div>

            <div class="form-footer">
                <a href="{{ route('user.permohonan.index') }}" class="btn-batal">Batal</a>
                <button type="submit" class="btn-submit">
                    <i class="bi bi-check-lg"></i> Simpan Perubahan
                </button>
            </div>
        </div>
    </div>

    {{-- SIDEBAR --}}
    <div>
        <div class="side-card" style="background:#eff6ff;border-color:#bfdbfe">
            <div class="side-card-title" style="color:#1e40af">
                <i class="bi bi-info-circle-fill" style="color:var(--blue)"></i>
                Informasi Layanan
            </div>
            <ul class="info-list">
                <li><span class="info-dot"></span> Waktu Proses: 1–2 Hari Kerja</li>
                <li><span class="info-dot"></span> Biaya: Gratis (Rp 0,-)</li>
                <li><span class="info-dot"></span> Masa Berlaku: 30 Hari</li>
            </ul>
        </div>

        <div class="side-card" style="background:#fffbeb;border-color:#fde68a">
            <div class="side-card-title" style="color:#92400e">
                <i class="bi bi-briefcase-fill" style="color:#d97706"></i>
                Persyaratan Dokumen
            </div>
            <ul class="syarat-list">
                <li><i class="bi bi-check-lg chk"></i>Scan/Foto KTP Asli</li>
                <li><i class="bi bi-check-lg chk"></i>Scan/Foto KK Asli</li>
                <li><i class="bi bi-check-lg chk"></i>Surat Pengantar RT/RW</li>
            </ul>
        </div>

        <div class="side-card">
            <div class="side-card-title">Butuh Bantuan?</div>
            <a href="https://wa.me/6281234567890" target="_blank" class="wa-card">
                <div class="wa-icon"><i class="bi bi-whatsapp" style="font-size:20px"></i></div>
                <div><div class="wa-text">Chat WhatsApp</div><div class="wa-num">0812-3456-7890</div></div>
            </a>
        </div>
    </div>

</div>
</form>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const MAX_EDIT = {{ 5 - $permohonan->persyaratan->count() }};
let editFiles = [];

function handleFilesEdit(input) {
    const newFiles  = Array.from(input.files);
    const remaining = MAX_EDIT - editFiles.length;
    const toAdd     = newFiles.slice(0, remaining);
    if (newFiles.length > remaining) alert('Hanya ' + remaining + ' file lagi yang bisa ditambahkan.');
    toAdd.forEach(file => {
        if (!editFiles.find(f => f.name === file.name && f.size === file.size)) editFiles.push(file);
    });
    input.value = '';
    syncEdit();
    renderEditList();
}

function removeEditFile(index) {
    editFiles.splice(index, 1);
    syncEdit();
    renderEditList();
}

function syncEdit() {
    const dt = new DataTransfer();
    editFiles.forEach(f => dt.items.add(f));
    document.getElementById('dokumen-edit').files = dt.files;
}

function renderEditList() {
    const list = document.getElementById('file-list-edit');
    list.innerHTML = editFiles.map((file, i) => {
        const isPdf = file.name.toLowerCase().endsWith('.pdf');
        const sizeKb = (file.size / 1024).toFixed(0);
        return `<div class="file-item">
            <div class="file-item-icon ${isPdf?'pdf':'img'}">
                ${isPdf
                    ? '<svg viewBox="0 0 24 24" fill="currentColor"><path d="M7 18H17V16H7v2zm0-4h10v-2H7v2zm-2 8a2 2 0 01-2-2V4a2 2 0 012-2h8l6 6v14a2 2 0 01-2 2H5z"/></svg>'
                    : '<svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/><polyline points="21 15 16 10 5 21"/></svg>'
                }
            </div>
            <div class="file-item-info">
                <span title="${file.name}">${file.name}</span>
                <small>${sizeKb} KB</small>
            </div>
            <button type="button" class="btn-remove-file" onclick="removeEditFile(${i})">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/></svg>
            </button>
        </div>`;
    }).join('');
}
</script>
</body>
</html>