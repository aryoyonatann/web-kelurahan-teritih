<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Keterangan Kematian – Kelurahan Teritih</title>
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
    .form-control,.form-select{font-family:'Plus Jakarta Sans',sans-serif;font-size:13.5px;border:1.5px solid var(--border);border-radius:9px;padding:10px 14px;color:var(--navy);transition:all .15s;width:100%}
    .form-control:focus,.form-select:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(28,100,242,.1);outline:none}
    .form-control.is-invalid,.form-select.is-invalid{border-color:var(--red)}
    .invalid-feedback{font-size:12px;color:var(--red);margin-top:4px;display:block}
    .btn-isi-sendiri{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:8px;font-size:12px;font-weight:700;background:var(--blue-lt);color:var(--blue);border:1.5px solid #bfdbfe;cursor:pointer;transition:all .15s;font-family:inherit}
    .btn-isi-sendiri:hover{background:#dbeafe}
    .btn-submit{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:14px;border-radius:12px;font-size:15px;font-weight:700;background:linear-gradient(135deg,var(--navy),var(--blue));color:white;border:none;cursor:pointer;transition:all .18s;font-family:inherit;margin-top:8px}
    .btn-submit:hover{opacity:.9;transform:translateY(-1px)}
    .alert-info-box{background:var(--blue-lt);border:1.5px solid #bfdbfe;border-radius:10px;padding:12px 16px;font-size:13px;color:#1e40af;display:flex;align-items:flex-start;gap:10px;margin-bottom:16px}
    .alert-error-box{background:#fef2f2;border:1.5px solid #fecaca;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:13px;color:#991b1b}
    </style>
</head>
<body>

@include('partials.navbar-user')

<div class="form-page">

    <a href="{{ route('layanan') }}" class="back-btn">
        <i class="bi bi-arrow-left"></i> Kembali ke Layanan
    </a>

    <!-- {-- HERO --} -->
    <div class="form-hero">
        <div style="position:relative;z-index:1">
            <div class="form-hero-badge">
                <i class="bi bi-file-earmark-medical-fill"></i> FORMULIR PERMOHONAN
            </div>
            <div class="form-hero-title">Surat Keterangan Kematian</div>
            <div class="form-hero-sub">Isi data dengan lengkap dan benar sesuai KTP. Surat akan diproses setelah admin menyetujui permohonan.</div>
        </div>
    </div>

    <!-- {-- ERROR BOX --} -->
    @if($errors->any())
    <div class="alert-error-box">
        <strong><i class="bi bi-exclamation-triangle-fill"></i> Terdapat kesalahan:</strong>
        <ul style="margin:6px 0 0;padding-left:18px">
            @foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('user.permohonan.store.surat', 'kematian') }}" enctype="multipart/form-data">
        @csrf

        <!-- {-- PENGAJUAN UNTUK SIAPA --} -->
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

        <!-- {-- DATA PEMOHON --} -->
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

                {{-- DATA ALMARHUM --}}
        <div class="card-section">
            <div class="card-section-head">
                <div class="card-section-head-icon" style="background:#ecfdf5;color:var(--green)">
                    <i class="bi bi-file-earmark-medical-fill"></i>
                </div>
                <div class="card-section-title">Data Kematian</div>
            </div>
            <div class="card-section-body">
                <div class="row g-3">
                    <div class="col-md-4">
                        <label class="form-label-custom">Umur Saat Meninggal <span class="req">*</span></label>
                        <input type="number" name="umur" class="form-control @error('umur') is-invalid @enderror"
                            value="{{ old('umur') }}" placeholder="Umur (tahun)" min="0" required>
                        @error('umur')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Hari Meninggal <span class="req">*</span></label>
                        <select name="hari_meninggal" class="form-select @error('hari_meninggal') is-invalid @enderror" required>
                            <option value="">Pilih...</option>
                            @foreach(['Senin','Selasa','Rabu','Kamis','Jumat','Sabtu','Minggu'] as $hari)
                            <option value="{{ $hari }}" {{ old('hari_meninggal')==$hari?'selected':'' }}>{{ $hari }}</option>
                            @endforeach
                        </select>
                        @error('hari_meninggal')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Tanggal Meninggal <span class="req">*</span></label>
                        <input type="date" name="tanggal_meninggal"
                            class="form-control @error('tanggal_meninggal') is-invalid @enderror"
                            value="{{ old('tanggal_meninggal') }}" required>
                        @error('tanggal_meninggal')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Tempat Meninggal <span class="req">*</span></label>
                        <select name="tempat_meninggal" class="form-select @error('tempat_meninggal') is-invalid @enderror" required>
                            <option value="">Pilih...</option>
                            @foreach(['Rumah','Rumah Sakit','Puskesmas','Lainnya'] as $tmp)
                            <option value="{{ $tmp }}" {{ old('tempat_meninggal')==$tmp?'selected':'' }}>{{ $tmp }}</option>
                            @endforeach
                        </select>
                        @error('tempat_meninggal')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Sebab Meninggal <span class="req">*</span></label>
                        <input type="text" name="sebab_meninggal"
                            class="form-control @error('sebab_meninggal') is-invalid @enderror"
                            value="{{ old('sebab_meninggal') }}" placeholder="Contoh: Sakit, Kecelakaan, dll." required>
                        @error('sebab_meninggal')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-12">
                        <label class="form-label-custom">Keperluan Surat <span style="font-size:10px;color:#94a3b8;font-weight:400">(Opsional)</span></label>
                        <input type="text" name="keperluan" class="form-control"
                            value="{{ old('keperluan') }}"
                            placeholder="Contoh: Pengurusan administrasi kependudukan (KK)">
                    </div>
                </div>
            </div>
        </div>

        <!-- {-- DOKUMEN --} -->
        <div class="card-section">
            <div class="card-section-head">
                <div class="card-section-head-icon" style="background:var(--blue-lt);color:var(--blue)">
                    <i class="bi bi-paperclip"></i>
                </div>
                <div class="card-section-title">Lampiran Dokumen</div>
            </div>
            <div class="card-section-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Foto/Scan KTP <span class="req">*</span></label>
                        <input type="file" name="dokumen_ktp"
                            class="form-control @error('dokumen_ktp') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.pdf" required>
                        <div style="font-size:11px;color:var(--muted);margin-top:4px">JPG, PNG, atau PDF. Maks 10MB.</div>
                        @error('dokumen_ktp')<span class="invalid-feedback">{{ $message }}</span>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Foto/Scan Kartu Keluarga <span class="req">*</span></label>
                        <input type="file" name="dokumen_kk"
                            class="form-control @error('dokumen_kk') is-invalid @enderror"
                            accept=".jpg,.jpeg,.png,.pdf" required>
                        <div style="font-size:11px;color:var(--muted);margin-top:4px">JPG, PNG, atau PDF. Maks 10MB.</div>
                        @error('dokumen_kk')<span class="invalid-feedback">{{ $message }}</span>@enderror
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
</script>

</body>
</html>