<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buat Permohonan Surat – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<style>
:root {
    --blue:   #1c64f2;
    --blue-dk:#1a56db;
    --blue-lt:#eff6ff;
    --navy:   #0f172a;
    --slate:  #334155;
    --muted:  #64748b;
    --border: #e2e8f0;
    --bg:     #f1f5f9;
    --green:  #059669;
    --red:    #dc2626;
}

.perm-wrap {
    max-width: 960px; margin: 0 auto;
    padding: 28px 16px 60px;
    display: grid; grid-template-columns: 1fr 300px; gap: 24px;
    align-items: start;
}
@media (max-width: 768px) {
    .perm-wrap { grid-template-columns: 1fr; }
}

/* Breadcrumb */
.breadcrumb { font-size: 12px; color: var(--muted); margin-bottom: 6px; }
.breadcrumb a { color: var(--muted); text-decoration: none; }
.breadcrumb a:hover { color: var(--blue); }
.breadcrumb span { color: var(--blue); font-weight: 600; }

.page-title { font-size: 22px; font-weight: 800; color: var(--navy); margin: 0 0 4px; }
.page-desc  { font-size: 13px; color: var(--muted); margin: 0 0 20px; }

/* Form Card */
.form-card {
    background: white; border-radius: 14px;
    border: 1px solid var(--border);
    overflow: hidden;
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
    margin-bottom: 16px;
}
.form-card-header {
    padding: 14px 20px; border-bottom: 1px solid var(--border);
    background: #f8fafc;
    display: flex; align-items: center; justify-content: space-between;
    gap: 12px;
}
.form-card-title {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; font-weight: 700; color: var(--navy);
}
.form-card-title svg { color: var(--blue); flex-shrink: 0; }
.form-card-body { padding: 20px; }

/* Self-fill button */
.btn-autofill {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 13px; border-radius: 7px;
    background: var(--blue-lt); color: var(--blue);
    font-size: 12px; font-weight: 700;
    border: none; cursor: pointer; transition: all .15s;
    white-space: nowrap;
}
.btn-autofill:hover { background: #dbeafe; }

/* Wakil badge */
.wakil-notice {
    display: none; align-items: center; gap: 8px;
    padding: 10px 14px; border-radius: 9px;
    background: #fffbeb; border: 1px solid #fde68a;
    font-size: 12px; color: #92400e;
    margin-bottom: 16px;
}
.wakil-notice.show { display: flex; }
.wakil-notice svg { flex-shrink: 0; color: #d97706; }

/* Field */
.field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
@media (max-width: 560px) { .field-row { grid-template-columns: 1fr; } }
.field-group { margin-bottom: 16px; }
.field-group:last-child { margin-bottom: 0; }

.field-label {
    display: block; font-size: 11.5px; font-weight: 700;
    color: #374151; text-transform: uppercase; letter-spacing: .05em;
    margin-bottom: 7px;
}
.field-label .req { color: var(--red); margin-left: 2px; }

.field-input {
    width: 100%; padding: 10px 13px;
    border: 1.5px solid var(--border); border-radius: 9px;
    font-size: 13px; font-family: inherit; color: var(--navy);
    background: white; outline: none; transition: all .18s;
    box-sizing: border-box;
}
.field-input:focus { border-color: var(--blue); box-shadow: 0 0 0 3px rgba(28,100,242,.1); }
.field-input::placeholder { color: #94a3b8; }
.field-input.is-error { border-color: var(--red); }
textarea.field-input { resize: vertical; min-height: 90px; }
select.field-input { cursor: pointer; }

.field-error {
    font-size: 12px; color: var(--red);
    margin-top: 5px; display: flex; align-items: center; gap: 4px;
}
.field-hint { font-size: 11px; color: #94a3b8; margin-top: 4px; }

/* File upload */
.file-zone {
    border: 2px dashed var(--border); border-radius: 10px;
    padding: 20px; text-align: center;
    cursor: pointer; transition: all .2s; background: #fafafa;
}
.file-zone:hover { border-color: var(--blue); background: var(--blue-lt); }
.file-zone input { display: none; }
.file-zone p { font-size: 13px; color: var(--muted); margin: 6px 0 0; }
.file-zone small { font-size: 11px; color: #94a3b8; }
.file-icon { color: #94a3b8; }

.file-list { margin-top: 12px; display: flex; flex-direction: column; gap: 6px; }
.file-item {
    display: flex; align-items: center; gap: 8px;
    padding: 7px 12px; border-radius: 8px;
    background: var(--blue-lt); font-size: 12px; color: var(--navy);
}
.file-item button {
    margin-left: auto; background: none; border: none;
    color: var(--red); cursor: pointer; font-size: 15px; line-height: 1;
}

/* Form footer */
.form-footer {
    padding: 14px 20px; background: #f8fafc;
    border-top: 1px solid var(--border);
    display: flex; align-items: center; justify-content: flex-end; gap: 10px;
}
.btn-batal {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 9px 18px; border-radius: 9px;
    border: 1.5px solid var(--border); background: white;
    font-size: 13px; font-weight: 600; color: var(--muted);
    text-decoration: none; cursor: pointer; transition: all .15s;
}
.btn-batal:hover { background: var(--bg); color: var(--slate); }
.btn-submit {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 9px 22px; border-radius: 9px;
    border: none; background: var(--blue);
    font-size: 13px; font-weight: 700; color: white;
    cursor: pointer; transition: all .15s;
}
.btn-submit:hover { background: var(--blue-dk); }

/* Sidebar cards */
.side-card {
    background: white; border-radius: 14px;
    border: 1px solid var(--border);
    padding: 18px 20px; margin-bottom: 16px;
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
}
.side-card-title {
    font-size: 13px; font-weight: 700; color: var(--navy);
    display: flex; align-items: center; gap: 7px; margin-bottom: 12px;
}
.side-card-title svg { color: var(--blue); }
.info-list { list-style: none; padding: 0; margin: 0; }
.info-list li {
    display: flex; align-items: center; gap: 8px;
    font-size: 13px; color: var(--slate); padding: 5px 0;
    border-bottom: 1px dashed var(--border);
}
.info-list li:last-child { border-bottom: none; }
.info-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--blue); flex-shrink: 0; }

.syarat-list { list-style: none; padding: 0; margin: 0; }
.syarat-list li {
    display: flex; align-items: flex-start; gap: 8px;
    font-size: 12.5px; color: var(--slate); padding: 5px 0;
    border-bottom: 1px dashed var(--border);
}
.syarat-list li:last-child { border-bottom: none; }
.syarat-list .chk { color: var(--green); flex-shrink: 0; margin-top: 1px; }

/* Alert */
.alert-err {
    background: #fef2f2; border: 1px solid #fecaca;
    border-radius: 10px; padding: 12px 16px; margin-bottom: 16px;
    font-size: 13px; color: var(--red);
}
.alert-err ul { margin: 6px 0 0 16px; padding: 0; }
.alert-err li { margin-bottom: 3px; }

/* WA card */
.wa-card {
    display: flex; align-items: center; gap: 12px;
    padding: 12px 16px; border-radius: 10px;
    background: #f0fdf4; border: 1px solid #bbf7d0;
    text-decoration: none; transition: all .15s;
}
.wa-card:hover { background: #dcfce7; }
.wa-icon {
    width: 40px; height: 40px; border-radius: 10px;
    background: #22c55e; color: white;
    display: flex; align-items: center; justify-content: center;
    flex-shrink: 0; font-size: 20px;
}
.wa-text { font-size: 12px; color: #166534; }
.wa-num  { font-size: 14px; font-weight: 700; color: #14532d; }
</style>
</head>
<body>

@include('partials.navbar')

<div style="background:white;border-bottom:1px solid #e2e8f0;padding:12px 16px;font-size:12px;color:#64748b">
    <a href="{{ url('/') }}" style="color:#64748b;text-decoration:none">Beranda</a>
    <span style="margin:0 6px">/</span>
    <a href="{{ route('user.permohonan.index') }}" style="color:#64748b;text-decoration:none">Layanan</a>
    <span style="margin:0 6px">/</span>
    <a href="{{ route('user.permohonan.index') }}" style="color:#64748b;text-decoration:none">Permohonan Surat</a>
    <span style="margin:0 6px">/</span>
    <span style="color:#1c64f2;font-weight:600">Buat Permohonan</span>
</div>

<div style="max-width:960px;margin:0 auto;padding:24px 16px 8px">
    <h1 style="font-size:22px;font-weight:800;color:#0f172a;margin:0 0 4px">Form Permohonan Surat</h1>
    <p style="font-size:13px;color:#64748b;margin:0">Silakan lengkapi formulir di bawah ini dengan data yang benar dan valid.</p>
</div>

<form action="{{ route('user.permohonan.store') }}" method="POST" enctype="multipart/form-data" id="formPermohonan">
@csrf

{{-- Hidden: data akun sendiri untuk autofill --}}
<input type="hidden" id="my_nik"    value="{{ auth()->user()->nik ?? '' }}">
<input type="hidden" id="my_nama"   value="{{ auth()->user()->nama ?? '' }}">
<input type="hidden" id="my_alamat" value="{{ auth()->user()->alamat ?? '' }}">

<div class="perm-wrap">

    {{-- ========== KOLOM KIRI ========== --}}
    <div>

        @if($errors->any())
        <div class="alert-err">
            <strong>Terdapat kesalahan pada formulir:</strong>
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        {{-- DATA PEMOHON --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                    Data Pemohon
                </div>
                <button type="button" class="btn-autofill" onclick="autofillData()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:13px;height:13px">
                        <path d="M20 21v-2a4 4 0 00-4-4H8a4 4 0 00-4 4v2"/><circle cx="12" cy="7" r="4"/>
                    </svg>
                    Isi Data Saya
                </button>
            </div>
            <div class="form-card-body">

                <div id="wakil-notice" class="wakil-notice">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px">
                        <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                    </svg>
                    <span>Anda mengajukan permohonan <strong>mewakili orang lain</strong>. Pastikan data di bawah adalah data orang yang diwakili.</span>
                </div>

                <p style="font-size:12px;color:#64748b;margin:0 0 16px;background:#f8fafc;padding:10px 13px;border-radius:8px;border:1px solid #e2e8f0">
                    Isi data pemohon secara manual. Klik <strong>"Isi Data Saya"</strong> jika mengajukan untuk diri sendiri.
                </p>

                <div class="field-row">
                    <div class="field-group" style="margin-bottom:0">
                        <label class="field-label">NIK <span class="req">*</span></label>
                        <input type="text" name="nik_pemohon" id="nik_pemohon"
                            class="field-input {{ $errors->has('nik_pemohon') ? 'is-error' : '' }}"
                            placeholder="Masukkan 16 digit NIK"
                            value="{{ old('nik_pemohon') }}"
                            maxlength="20"
                            oninput="checkWakil()"
                            required>
                        @error('nik_pemohon')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="field-group" style="margin-bottom:0">
                        <label class="field-label">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" name="nama_pemohon" id="nama_pemohon"
                            class="field-input {{ $errors->has('nama_pemohon') ? 'is-error' : '' }}"
                            placeholder="Nama sesuai KTP"
                            value="{{ old('nama_pemohon') }}"
                            required>
                        @error('nama_pemohon')
                            <div class="field-error">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="field-group" style="margin-top:16px">
                    <label class="field-label">Alamat Lengkap <span class="req">*</span></label>
                    <textarea name="alamat_pemohon" id="alamat_pemohon"
                        class="field-input {{ $errors->has('alamat_pemohon') ? 'is-error' : '' }}"
                        placeholder="Alamat lengkap sesuai KTP / domisili..."
                        required>{{ old('alamat_pemohon') }}</textarea>
                    @error('alamat_pemohon')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        {{-- DETAIL PERMOHONAN --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px">
                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>
                    </svg>
                    Detail Permohonan
                </div>
            </div>
            <div class="form-card-body">

                <div class="field-group">
                    <label class="field-label">Jenis Surat <span class="req">*</span></label>
                    <select name="id_jenis_surat"
                        class="field-input {{ $errors->has('id_jenis_surat') ? 'is-error' : '' }}"
                        required>
                        <option value="">-- Pilih Jenis Surat --</option>
                        @foreach($daftarJenisSurat as $js)
                            <option value="{{ $js->id_jenis_surat }}"
                                {{ (old('id_jenis_surat', $selectedJenis) == $js->id_jenis_surat) ? 'selected' : '' }}>
                                {{ $js->nama_surat }}
                            </option>
                        @endforeach
                    </select>
                    @error('id_jenis_surat')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

                <div class="field-group">
                    <label class="field-label">Tujuan / Keperluan Surat <span class="req">*</span></label>
                    <textarea name="keperluan"
                        class="field-input {{ $errors->has('keperluan') ? 'is-error' : '' }}"
                        placeholder="Contoh: Persyaratan administrasi pindah domisili / Keperluan melamar pekerjaan..."
                        required>{{ old('keperluan') }}</textarea>
                    @error('keperluan')
                        <div class="field-error">{{ $message }}</div>
                    @enderror
                </div>

            </div>
        </div>

        {{-- DOKUMEN PERSYARATAN --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-title">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px">
                        <path d="M21.44 11.05l-9.19 9.19a6 6 0 01-8.49-8.49l9.19-9.19a4 4 0 015.66 5.66l-9.2 9.19a2 2 0 01-2.83-2.83l8.49-8.48"/>
                    </svg>
                    Dokumen Persyaratan
                </div>
            </div>
            <div class="form-card-body">

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:14px">

                    {{-- SLOT KTP --}}
                    <div>
                        <div style="font-size:11.5px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#374151;margin-bottom:8px">
                            Foto / Scan KTP <span style="color:#dc2626">*</span>
                        </div>
                        <div class="file-slot" id="slot-ktp" onclick="document.getElementById('input-ktp').click()"
                             style="border:2px dashed #e2e8f0;border-radius:10px;padding:18px 12px;text-align:center;cursor:pointer;background:#fafafa;transition:all .2s;min-height:120px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px">
                            <div id="ktp-preview-wrap" style="display:none;width:100%">
                                <img id="ktp-img-preview" style="max-height:80px;object-fit:cover;border-radius:6px;width:100%;display:none">
                                <div id="ktp-file-info" style="display:none;background:#eff6ff;border-radius:8px;padding:8px 10px;display:flex;align-items:center;gap:8px">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="#1c64f2" stroke-width="2" style="width:16px;height:16px;flex-shrink:0">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>
                                    </svg>
                                    <span id="ktp-file-name" style="font-size:12px;font-weight:600;color:#1c64f2;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;flex:1"></span>
                                    <button type="button" onclick="clearSlot('ktp');event.stopPropagation()"
                                        style="background:none;border:none;color:#dc2626;cursor:pointer;font-size:16px;line-height:1;padding:0;flex-shrink:0">&times;</button>
                                </div>
                            </div>
                            <div id="ktp-placeholder">
                                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" style="width:28px;height:28px;margin:0 auto">
                                    <rect x="2" y="5" width="20" height="14" rx="2"/>
                                    <circle cx="8" cy="12" r="2.5"/>
                                    <path d="M13 10h5M13 14h3"/>
                                </svg>
                                <div style="font-size:12px;font-weight:600;color:#64748b;margin-top:4px">Upload KTP</div>
                                <div style="font-size:10px;color:#94a3b8">JPG, PNG, PDF</div>
                            </div>
                        </div>
                        <input type="file" id="input-ktp" name="dokumen_ktp"
                               accept=".pdf,.jpg,.jpeg,.png" style="display:none"
                               onchange="handleSlot('ktp', this)">
                        @error('dokumen_ktp')
                            <div style="font-size:12px;color:#dc2626;margin-top:5px">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- SLOT KK --}}
                    <div>
                        <div style="font-size:11.5px;font-weight:700;text-transform:uppercase;letter-spacing:.05em;color:#374151;margin-bottom:8px">
                            Foto / Scan Kartu Keluarga <span style="color:#dc2626">*</span>
                        </div>
                        <div class="file-slot" id="slot-kk" onclick="document.getElementById('input-kk').click()"
                             style="border:2px dashed #e2e8f0;border-radius:10px;padding:18px 12px;text-align:center;cursor:pointer;background:#fafafa;transition:all .2s;min-height:120px;display:flex;flex-direction:column;align-items:center;justify-content:center;gap:6px">
                            <div id="kk-preview-wrap" style="display:none;width:100%">
                                <img id="kk-img-preview" style="max-height:80px;object-fit:cover;border-radius:6px;width:100%;display:none">
                                <div id="kk-file-info" style="display:none;background:#f0fdf4;border-radius:8px;padding:8px 10px;display:flex;align-items:center;gap:8px">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="#059669" stroke-width="2" style="width:16px;height:16px;flex-shrink:0">
                                        <path d="M14 2H6a2 2 0 00-2 2v16a2 2 0 002 2h12a2 2 0 002-2V8z"/><polyline points="14 2 14 8 20 8"/>
                                    </svg>
                                    <span id="kk-file-name" style="font-size:12px;font-weight:600;color:#059669;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;flex:1"></span>
                                    <button type="button" onclick="clearSlot('kk');event.stopPropagation()"
                                        style="background:none;border:none;color:#dc2626;cursor:pointer;font-size:16px;line-height:1;padding:0;flex-shrink:0">&times;</button>
                                </div>
                            </div>
                            <div id="kk-placeholder">
                                <svg viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1.5" style="width:28px;height:28px;margin:0 auto">
                                    <path d="M17 21v-2a4 4 0 00-4-4H5a4 4 0 00-4 4v2"/>
                                    <circle cx="9" cy="7" r="4"/>
                                    <path d="M23 21v-2a4 4 0 00-3-3.87M16 3.13a4 4 0 010 7.75"/>
                                </svg>
                                <div style="font-size:12px;font-weight:600;color:#64748b;margin-top:4px">Upload KK</div>
                                <div style="font-size:10px;color:#94a3b8">JPG, PNG, PDF</div>
                            </div>
                        </div>
                        <input type="file" id="input-kk" name="dokumen_kk"
                               accept=".pdf,.jpg,.jpeg,.png" style="display:none"
                               onchange="handleSlot('kk', this)">
                        @error('dokumen_kk')
                            <div style="font-size:12px;color:#dc2626;margin-top:5px">{{ $message }}</div>
                        @enderror
                    </div>

                </div>

                <div style="font-size:11px;color:#94a3b8;margin-top:10px">
                    Format: JPG, PNG, atau PDF — Maks. 10MB per file
                </div>

            </div>

            <div class="form-footer">
                <a href="{{ route('user.permohonan.index') }}" class="btn-batal">Batal</a>
                <button type="submit" class="btn-submit">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Kirim Permohonan
                </button>
            </div>
        </div>

    </div>{{-- /kiri --}}

    {{-- ========== SIDEBAR ========== --}}
    <div>

        <div class="side-card" style="background:#eff6ff;border-color:#bfdbfe">
            <div class="side-card-title" style="color:#1e40af">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;color:#1c64f2">
                    <circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/>
                </svg>
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
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:16px;height:16px;color:#d97706">
                    <rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-2-2h-4a2 2 0 00-2 2v2"/>
                </svg>
                Persyaratan Dokumen
            </div>
            <p style="font-size:12px;color:#92400e;margin:0 0 10px">
                Pastikan Anda melampirkan dokumen berikut agar permohonan dapat diproses:
            </p>
            <ul class="syarat-list">
                <li>
                    <svg class="chk" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Scan/Foto KTP Asli
                </li>
                <li>
                    <svg class="chk" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Scan/Foto KK Asli
                </li>
                <li>
                    <svg class="chk" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:14px;height:14px">
                        <polyline points="20 6 9 17 4 12"/>
                    </svg>
                    Surat Pengantar RT/RW
                </li>
            </ul>
        </div>

        <div class="side-card">
            <div class="side-card-title">Butuh Bantuan?</div>
            <a href="https://wa.me/6281234567890" target="_blank" class="wa-card">
                <div class="wa-icon">
                    <svg viewBox="0 0 24 24" fill="currentColor" style="width:22px;height:22px">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/>
                    </svg>
                </div>
                <div>
                    <div class="wa-text">Chat WhatsApp</div>
                    <div class="wa-num">0812-3456-7890</div>
                </div>
            </a>
        </div>

    </div>{{-- /sidebar --}}

</div>{{-- /perm-wrap --}}
</form>

<script>
// Autofill data akun sendiri
function autofillData() {
    document.getElementById('nik_pemohon').value    = document.getElementById('my_nik').value;
    document.getElementById('nama_pemohon').value   = document.getElementById('my_nama').value;
    document.getElementById('alamat_pemohon').value = document.getElementById('my_alamat').value;
    checkWakil();
}

function checkWakil() {
    const myNik    = document.getElementById('my_nik').value;
    const inputNik = document.getElementById('nik_pemohon').value;
    const notice   = document.getElementById('wakil-notice');
    if (myNik && inputNik && inputNik !== myNik) {
        notice.classList.add('show');
    } else {
        notice.classList.remove('show');
    }
}

// ── Upload slot handler ────────────────────────────────────
function handleSlot(jenis, input) {
    const file = input.files[0];
    if (!file) return;

    const slot        = document.getElementById('slot-' + jenis);
    const placeholder = document.getElementById(jenis + '-placeholder');
    const previewWrap = document.getElementById(jenis + '-preview-wrap');
    const imgPreview  = document.getElementById(jenis + '-img-preview');
    const fileInfo    = document.getElementById(jenis + '-file-info');
    const fileName    = document.getElementById(jenis + '-file-name');

    // Tampilkan nama file
    fileName.textContent = file.name;
    placeholder.style.display  = 'none';
    previewWrap.style.display  = 'block';
    fileInfo.style.display     = 'flex';
    imgPreview.style.display   = 'none';

    // Kalau gambar, tampilkan preview
    if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => {
            imgPreview.src           = e.target.result;
            imgPreview.style.display = 'block';
            fileInfo.style.display   = 'none';
        };
        reader.readAsDataURL(file);
    }

    // Border jadi hijau/biru saat terisi
    slot.style.borderColor = jenis === 'ktp' ? '#1c64f2' : '#059669';
    slot.style.background  = jenis === 'ktp' ? '#eff6ff' : '#f0fdf4';
}

function clearSlot(jenis) {
    document.getElementById('input-' + jenis).value = '';
    document.getElementById(jenis + '-placeholder').style.display  = '';
    document.getElementById(jenis + '-preview-wrap').style.display = 'none';
    const slot = document.getElementById('slot-' + jenis);
    slot.style.borderColor = '';
    slot.style.background  = '';
}

// Hover effect pada slot
document.querySelectorAll('.file-slot').forEach(slot => {
    slot.addEventListener('mouseenter', () => {
        if (!slot.style.borderColor) slot.style.borderColor = '#94a3b8';
    });
    slot.addEventListener('mouseleave', () => {
        if (slot.style.borderColor === 'rgb(148, 163, 184)') slot.style.borderColor = '';
    });
});
</script>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>