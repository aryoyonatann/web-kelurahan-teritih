<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Beda Nama – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root{--blue:#1c64f2;--blue-dk:#1a56db;--blue-lt:#eff6ff;--navy:#0d1b3e;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;--green:#10b981;--red:#ef4444}
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:14px;line-height:1.6;min-height:100vh;display:flex;flex-direction:column}
    .form-page{max-width:860px;margin:0 auto;padding:28px 20px 60px;flex:1}
    .form-hero{background:linear-gradient(135deg,var(--navy) 0%,#1e3a5f 55%,#1e4d8c 100%);border-radius:16px;padding:28px 32px;margin-bottom:28px;position:relative;overflow:hidden}
    .form-hero::before{content:'';position:absolute;right:-40px;top:-40px;width:200px;height:200px;border-radius:50%;border:40px solid rgba(255,255,255,.06)}
    .form-hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:20px;padding:4px 12px;font-size:11px;font-weight:700;color:rgba(255,255,255,.9);margin-bottom:10px}
    .form-hero-title{font-size:22px;font-weight:800;color:white;margin:0 0 6px;position:relative;z-index:1}
    .form-hero-sub{font-size:13px;color:rgba(255,255,255,.75);margin:0;position:relative;z-index:1}
    .back-btn{display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:var(--muted);text-decoration:none;padding:7px 14px;border-radius:9px;border:1px solid var(--border);background:white;margin-bottom:20px;transition:all .15s}
    .back-btn:hover{color:var(--blue);border-color:#bfdbfe;background:#eff6ff}
    .card-section{background:white;border:1px solid var(--border);border-radius:16px;margin-bottom:20px;overflow:hidden}
    .card-section-head{padding:14px 20px;border-bottom:1px solid var(--border);background:#f8fafc;display:flex;align-items:center;gap:10px}
    .card-section-head-icon{width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0}
    .card-section-title{font-size:13.5px;font-weight:700;color:var(--navy)}
    .card-section-body{padding:20px}
    .form-label-custom{font-size:11.5px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#374151;margin-bottom:6px;display:block}
    .form-label-custom .req{color:var(--red);margin-left:2px}
    .form-label-custom .opt{color:#94a3b8;font-weight:600;margin-left:4px;text-transform:none;letter-spacing:0}
    .form-control,.form-select{font-family:'Plus Jakarta Sans',sans-serif;font-size:13.5px;border:1.5px solid var(--border);border-radius:9px;padding:10px 14px;color:var(--navy);transition:all .15s;width:100%}
    .form-control:focus,.form-select:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(28,100,242,.1);outline:none}
    .form-control.is-invalid,.form-select.is-invalid{border-color:var(--red)}
    .invalid-feedback{font-size:12px;color:var(--red);margin-top:4px;display:flex;align-items:center;gap:4px}
    .btn-isi-sendiri{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:8px;font-size:12px;font-weight:700;background:var(--blue-lt);color:var(--blue);border:1.5px solid #bfdbfe;cursor:pointer;transition:all .15s;font-family:inherit}
    .btn-isi-sendiri:hover{background:#dbeafe}
    .btn-submit{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:14px;border-radius:12px;font-size:15px;font-weight:700;background:linear-gradient(135deg,var(--navy),var(--blue));color:white;border:none;cursor:pointer;transition:all .18s;font-family:inherit;margin-top:8px}
    .btn-submit:hover{opacity:.9;transform:translateY(-1px)}
    .alert-info-box{background:var(--blue-lt);border:1.5px solid #bfdbfe;border-radius:10px;padding:12px 16px;font-size:13px;color:#1e40af;display:flex;align-items:flex-start;gap:10px;margin-bottom:16px}
    .alert-error-box{background:#fef2f2;border:1.5px solid #fecaca;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:13px;color:#991b1b}
    /* File upload */
    .file-wrap{border:2px dashed var(--border);border-radius:10px;padding:16px;text-align:center;cursor:pointer;transition:all .2s;position:relative}
    .file-wrap:hover{border-color:var(--blue);background:#eff6ff}
    .file-wrap input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
    .file-icon{font-size:26px;color:#94a3b8;margin-bottom:6px}
    .file-label{font-size:12px;font-weight:600;color:var(--muted)}
    .file-hint{font-size:11px;color:#94a3b8;margin-top:3px}
    .file-name{font-size:12px;font-weight:600;color:var(--blue);margin-top:6px;display:none}
    .file-list{margin-top:10px;display:flex;flex-direction:column;gap:6px}
    .file-list-item{display:flex;align-items:center;gap:8px;padding:8px 12px;background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;font-size:12px;color:#1e40af}
    .file-list-item i{flex-shrink:0;color:#1c64f2}
    .file-list-item .fn{flex:1;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
    .file-list-item .fs{color:#64748b;font-weight:500;font-size:11px;flex-shrink:0}
    .file-warn{margin-top:8px;padding:8px 12px;background:#fef3c7;border:1px solid #fde68a;border-radius:8px;font-size:11px;color:#92400e;display:flex;align-items:center;gap:6px}
    </style>
</head>
<body>

@include('partials.navbar-user')

@php $maxPendukung = 3; @endphp

<div class="form-page">

    <a href="{{ route('layanan') }}" class="back-btn">
        <i class="bi bi-arrow-left"></i> Kembali ke Layanan
    </a>

    <div class="form-hero">
        <div style="position:relative;z-index:1">
            <div class="form-hero-badge">
                <i class="bi bi-person-badge-fill"></i> FORMULIR PERMOHONAN
            </div>
            <div class="form-hero-title">Surat Keterangan Beda Nama</div>
            <div class="form-hero-sub">Isi data dengan lengkap dan benar sesuai KTP. Surat akan diproses setelah admin menyetujui permohonan.</div>
        </div>
    </div>

    @if($errors->any())
    <div class="alert-error-box">
        <strong><i class="bi bi-exclamation-triangle-fill"></i> Terdapat kesalahan:</strong>
        <ul style="margin:6px 0 0;padding-left:18px">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('user.permohonan.store.surat', 'beda-nama') }}" enctype="multipart/form-data">
        @csrf

        <!-- PENGAJUAN UNTUK SIAPA -->
        <div class="card-section">
            <div class="card-section-head">
                <div class="card-section-head-icon" style="background:var(--blue-lt);color:var(--blue)">
                    <i class="bi bi-person-check-fill"></i>
                </div>
                <div class="card-section-title">Pengajuan Untuk Siapa?</div>
            </div>
            <div class="card-section-body">
                <div class="row g-3 mb-0">
                    <div class="col-md-6">
                        <label class="form-label-custom">Jenis Pengajuan</label>
                        <select name="jenis_pengajuan" class="form-select" onchange="togglePengajuan(this.value)">
                            <option value="sendiri">Untuk Diri Sendiri</option>
                            <option value="orang_lain">Mewakili Orang Lain</option>
                        </select>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <button type="button" class="btn-isi-sendiri" onclick="isiDataSendiri()" id="btnIsiSendiri">
                            <i class="bi bi-person-fill"></i> Isi Otomatis dari Akun Saya
                        </button>
                    </div>
                </div>
                <div id="infoOrangLain" style="display:none;margin-top:14px" class="alert-info-box">
                    <i class="bi bi-info-circle-fill" style="flex-shrink:0;margin-top:2px"></i>
                    <span>Anda mengajukan sebagai <strong>perwakilan</strong>. Isi data diri orang yang akan dibuatkan surat, bukan data Anda sendiri.</span>
                </div>
            </div>
        </div>

        <!-- DATA PEMOHON -->
        <div class="card-section">
            <div class="card-section-head">
                <div class="card-section-head-icon" style="background:var(--blue-lt);color:var(--blue)">
                    <i class="bi bi-person-fill"></i>
                </div>
                <div class="card-section-title">Data Pemohon (yang dibuatkan surat)</div>
            </div>
            <div class="card-section-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" name="nama_pemohon" id="namaPemohon"
                            class="form-control @error('nama_pemohon') is-invalid @enderror"
                            value="{{ old('nama_pemohon') }}" placeholder="Sesuai KTP" required>
                        @error('nama_pemohon')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">NIK <span class="req">*</span></label>
                        <input type="text" name="nik_pemohon" id="nikPemohon"
                            class="form-control @error('nik_pemohon') is-invalid @enderror"
                            value="{{ old('nik_pemohon') }}" placeholder="16 digit NIK" maxlength="16" required>
                        @error('nik_pemohon')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Tempat Lahir <span class="req">*</span></label>
                        <input type="text" name="tempat_lahir" id="tempatLahir"
                            class="form-control @error('tempat_lahir') is-invalid @enderror"
                            value="{{ old('tempat_lahir') }}" placeholder="Kota tempat lahir" required>
                        @error('tempat_lahir')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Tanggal Lahir <span class="req">*</span></label>
                        <input type="date" name="tanggal_lahir" id="tanggalLahir"
                            class="form-control @error('tanggal_lahir') is-invalid @enderror"
                            value="{{ old('tanggal_lahir') }}" required>
                        @error('tanggal_lahir')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Jenis Kelamin <span class="req">*</span></label>
                        <select name="jenis_kelamin" id="jenisKelamin"
                            class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                            <option value="">Pilih...</option>
                            <option value="Laki-Laki" {{ old('jenis_kelamin')=='Laki-Laki'?'selected':'' }}>Laki-Laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Agama</label>
                        <select name="agama" id="agamaField" class="form-select">
                            <option value="">Pilih...</option>
                            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag)
                            <option value="{{ $ag }}" {{ old('agama')==$ag?'selected':'' }}>{{ $ag }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Status Perkawinan</label>
                        <select name="status_kawin" id="statusKawin" class="form-select">
                            <option value="">Pilih...</option>
                            @foreach(['Belum Menikah','Kawin','Cerai Hidup','Cerai Mati'] as $st)
                            <option value="{{ $st }}" {{ old('status_kawin')==$st?'selected':'' }}>{{ $st }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Pekerjaan</label>
                        <input type="text" name="pekerjaan" id="pekerjaanField"
                            class="form-control" value="{{ old('pekerjaan') }}" placeholder="Pekerjaan">
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">No. RT / RW</label>
                        <div class="row g-2">
                            <div class="col-6">
                                <input type="text" name="rt" id="rtField" class="form-control"
                                    value="{{ old('rt') }}" placeholder="RT (cth: 001)">
                            </div>
                            <div class="col-6">
                                <input type="text" name="rw" id="rwField" class="form-control"
                                    value="{{ old('rw') }}" placeholder="RW (cth: 002)">
                            </div>
                        </div>
                    </div>
                    <div class="col-12">
                        <label class="form-label-custom">Alamat Lengkap <span class="req">*</span></label>
                        <textarea name="alamat_pemohon" id="alamatPemohon"
                            class="form-control @error('alamat_pemohon') is-invalid @enderror"
                            rows="2" placeholder="Nama kampung/jalan, RT/RW, Kelurahan, Kecamatan, Kota" required>{{ old('alamat_pemohon') }}</textarea>
                        @error('alamat_pemohon')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- PERBEDAAN NAMA -->
        <div class="card-section">
            <div class="card-section-head">
                <div class="card-section-head-icon" style="background:#fffbeb;color:#d97706">
                    <i class="bi bi-arrow-left-right"></i>
                </div>
                <div class="card-section-title">Detail Perbedaan Nama</div>
            </div>
            <div class="card-section-body">
                <div class="alert-info-box" style="margin-bottom:16px">
                    <i class="bi bi-info-circle-fill" style="flex-shrink:0;margin-top:2px"></i>
                    <span>Isi nama <strong>persis seperti yang tertulis</strong> di masing-masing dokumen. Kedua nama akan dinyatakan sebagai satu orang yang sama.</span>
                </div>
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Nama di KTP <span class="req">*</span></label>
                        <input type="text" name="nama_dokumen_1"
                            class="form-control @error('nama_dokumen_1') is-invalid @enderror"
                            value="{{ old('nama_dokumen_1') }}" placeholder="Nama sesuai KTP" required>
                        <div style="font-size:11px;color:var(--muted);margin-top:4px">Nama pada Kartu Tanda Penduduk</div>
                        @error('nama_dokumen_1')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Nama di Dokumen Lain <span class="req">*</span></label>
                        <input type="text" name="nama_dokumen_2"
                            class="form-control @error('nama_dokumen_2') is-invalid @enderror"
                            value="{{ old('nama_dokumen_2') }}" placeholder="Nama sesuai dokumen lain" required>
                        @error('nama_dokumen_2')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Jenis Dokumen Pembanding <span class="req">*</span></label>
                        <select name="jenis_dokumen_2" class="form-select @error('jenis_dokumen_2') is-invalid @enderror" required>
                            <option value="">Pilih jenis dokumen...</option>
                            @foreach(['Sertifikat Tanah','Ijazah','Akta Kelahiran','Buku Nikah','BPJS','Rekening Bank','Dokumen Lainnya'] as $jd)
                            <option value="{{ $jd }}" {{ old('jenis_dokumen_2')==$jd?'selected':'' }}>{{ $jd }}</option>
                            @endforeach
                        </select>
                        @error('jenis_dokumen_2')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Keperluan Surat <span class="req">*</span></label>
                        <input type="text" name="keperluan" class="form-control @error('keperluan') is-invalid @enderror"
                            value="{{ old('keperluan') }}" placeholder="Tujuan pembuatan surat beda nama" required>
                        @error('keperluan')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                </div>
            </div>
        </div>

        <!-- LAMPIRAN DOKUMEN -->
        <div class="card-section">
            <div class="card-section-head">
                <div class="card-section-head-icon" style="background:#fffbeb;color:#f59e0b">
                    <i class="bi bi-paperclip"></i>
                </div>
                <div class="card-section-title">Lampiran Dokumen</div>
            </div>
            <div class="card-section-body">
                <div class="row g-3">
                    <!-- KTP -->
                    <div class="col-md-6">
                        <label class="form-label-custom">Foto/Scan KTP <span class="req">*</span></label>
                        <div class="file-wrap">
                            <input type="file" name="dokumen_ktp" accept=".jpg,.jpeg,.png,.pdf"
                                onchange="showFileName(this,'fname_ktp')" required>
                            <div class="file-icon"><i class="bi bi-cloud-upload"></i></div>
                            <div class="file-label">Klik atau drag file ke sini</div>
                            <div class="file-hint">JPG, PNG, atau PDF. Maks 10MB.</div>
                            <div class="file-name" id="fname_ktp"></div>
                        </div>
                        @error('dokumen_ktp')<div class="invalid-feedback" style="display:flex"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    <!-- KK -->
                    <div class="col-md-6">
                        <label class="form-label-custom">Foto/Scan Kartu Keluarga <span class="req">*</span></label>
                        <div class="file-wrap">
                            <input type="file" name="dokumen_kk" accept=".jpg,.jpeg,.png,.pdf"
                                onchange="showFileName(this,'fname_kk')" required>
                            <div class="file-icon"><i class="bi bi-cloud-upload"></i></div>
                            <div class="file-label">Klik atau drag file ke sini</div>
                            <div class="file-hint">JPG, PNG, atau PDF. Maks 10MB.</div>
                            <div class="file-name" id="fname_kk"></div>
                        </div>
                        @error('dokumen_kk')<div class="invalid-feedback" style="display:flex"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    <!-- Dokumen Pendukung -->
                    <div class="col-12">
                        <label class="form-label-custom">
                            Dokumen Pendukung
                            <span class="opt">(Opsional — maks. {{ $maxPendukung }} file)</span>
                        </label>
                        <div class="file-wrap">
                            <input type="file" name="dokumen_pendukung[]" id="inputPendukung"
                                accept=".jpg,.jpeg,.png,.pdf" multiple
                                onchange="showMultipleFiles(this)">
                            <div class="file-icon"><i class="bi bi-files"></i></div>
                            <div class="file-label">Klik atau drag untuk pilih beberapa file sekaligus</div>
                            <div class="file-hint">JPG, PNG, atau PDF. Maks 10MB per file. Bisa pilih hingga {{ $maxPendukung }} file.</div>
                        </div>
                        <div class="file-list" id="listPendukung"></div>
                        <div class="file-warn" id="warnPendukung" style="display:none">
                            <i class="bi bi-exclamation-triangle-fill"></i>
                            <span id="warnPendukungText"></span>
                        </div>
                        @error('dokumen_pendukung')<div class="invalid-feedback" style="display:flex"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                        @foreach($errors->get('dokumen_pendukung.*') as $msgs)
                            @foreach($msgs as $m)
                                <div class="invalid-feedback" style="display:flex"><i class="bi bi-exclamation-circle"></i> {{ $m }}</div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn-submit">
            <i class="bi bi-send-fill"></i> Kirim Permohonan
        </button>

    </form>
</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
const MAX_PENDUKUNG = {{ $maxPendukung }};
const MAX_SIZE_MB   = 10;

const userData = {
    nama:         '{{ Auth::user()->nama ?? "" }}',
    nik:          '{{ Auth::user()->nik ?? "" }}',
    tempat_lahir: '{{ Auth::user()->tempat_lahir ?? "" }}',
    tanggal_lahir:'{{ Auth::user()->tanggal_lahir ?? "" }}',
    alamat:       '{{ addslashes(Auth::user()->alamat ?? "") }}',
    rt:           '{{ Auth::user()->rt ?? "" }}',
    rw:           '{{ Auth::user()->rw ?? "" }}',
};

function isiDataSendiri() {
    document.getElementById('namaPemohon').value   = userData.nama;
    document.getElementById('nikPemohon').value    = userData.nik;
    document.getElementById('tempatLahir').value   = userData.tempat_lahir;
    document.getElementById('tanggalLahir').value  = userData.tanggal_lahir;
    document.getElementById('alamatPemohon').value = userData.alamat;
    document.getElementById('rtField').value       = userData.rt;
    document.getElementById('rwField').value       = userData.rw;
}

function togglePengajuan(val) {
    const info = document.getElementById('infoOrangLain');
    const btn  = document.getElementById('btnIsiSendiri');
    info.style.display = val === 'orang_lain' ? 'flex' : 'none';
    btn.style.display  = val === 'orang_lain' ? 'none'  : 'inline-flex';
}

function showFileName(input, id) {
    const el = document.getElementById(id);
    if (input.files && input.files[0]) {
        el.textContent = '✓ ' + input.files[0].name;
        el.style.display = 'block';
    }
}

function formatSize(bytes) {
    if (bytes < 1024) return bytes + ' B';
    if (bytes < 1024 * 1024) return (bytes/1024).toFixed(1) + ' KB';
    return (bytes/(1024*1024)).toFixed(1) + ' MB';
}

function showMultipleFiles(input) {
    const list     = document.getElementById('listPendukung');
    const warn     = document.getElementById('warnPendukung');
    const warnText = document.getElementById('warnPendukungText');
    list.innerHTML = '';
    warn.style.display = 'none';

    if (!input.files || input.files.length === 0) return;

    const files    = Array.from(input.files);
    const problems = [];

    if (files.length > MAX_PENDUKUNG) {
        problems.push(`Anda memilih ${files.length} file, hanya ${MAX_PENDUKUNG} pertama yang akan diunggah.`);
    }

    files.slice(0, MAX_PENDUKUNG).forEach((file) => {
        const sizeMB   = file.size / (1024 * 1024);
        const oversized = sizeMB > MAX_SIZE_MB;
        if (oversized) problems.push(`File "${file.name}" melebihi ${MAX_SIZE_MB}MB.`);

        const item = document.createElement('div');
        item.className = 'file-list-item';
        item.innerHTML = `
            <i class="bi bi-file-earmark-check-fill"></i>
            <span class="fn">${file.name}</span>
            <span class="fs">${formatSize(file.size)}</span>`;
        if (oversized) {
            item.style.cssText = 'background:#fef2f2;border-color:#fecaca;color:#991b1b';
            item.querySelector('i').style.color = '#dc2626';
            item.querySelector('i').className = 'bi bi-file-earmark-x-fill';
        }
        list.appendChild(item);
    });

    if (problems.length > 0) {
        warnText.textContent = problems.join(' ');
        warn.style.display = 'flex';
    }
}
</script>
</body>
</html>