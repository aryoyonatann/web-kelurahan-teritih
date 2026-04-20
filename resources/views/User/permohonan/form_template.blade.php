<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $jenisSurat->nama_surat }} – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root{--blue:#1c64f2;--navy:#0d1b3e;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;--green:#10b981;--red:#ef4444}
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:14px;min-height:100vh;display:flex;flex-direction:column}
    .form-page{max-width:860px;margin:0 auto;padding:28px 20px 60px;flex:1}
    .form-hero{background:linear-gradient(135deg,var(--navy),#1e3a5f,#1e4d8c);border-radius:16px;padding:28px 32px;margin-bottom:24px;position:relative;overflow:hidden}
    .form-hero::before{content:'';position:absolute;right:-40px;top:-40px;width:200px;height:200px;border-radius:50%;border:40px solid rgba(255,255,255,.06)}
    .form-hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:20px;padding:4px 12px;font-size:11px;font-weight:700;color:rgba(255,255,255,.9);margin-bottom:10px}
    .form-hero-title{font-size:22px;font-weight:800;color:white;margin:0 0 6px}
    .form-hero-sub{font-size:13px;color:rgba(255,255,255,.75);margin:0}

    .sec{background:white;border:1px solid var(--border);border-radius:14px;overflow:hidden;margin-bottom:16px}
    .sec-head{display:flex;align-items:center;gap:10px;padding:14px 20px;border-bottom:1px solid var(--border);background:#f8fafc}
    .sec-icon{width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
    .sec-title{font-size:14px;font-weight:700;color:var(--navy)}
    .sec-body{padding:20px}

    .form-label-custom{display:block;font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#374151;margin-bottom:6px}
    .form-label-custom .req{color:var(--red);margin-left:2px}
    .form-control{border:1.5px solid var(--border);border-radius:9px;font-size:13px;font-family:inherit;padding:10px 14px;transition:all .15s;outline:none;width:100%}
    .form-control:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(28,100,242,.1)}
    .form-control::placeholder{color:#94a3b8}
    textarea.form-control{resize:vertical;min-height:90px}
    .is-invalid{border-color:var(--red)!important}
    .invalid-feedback{font-size:12px;color:var(--red);margin-top:4px;display:flex;align-items:center;gap:4px}

    .file-wrap{border:2px dashed var(--border);border-radius:10px;padding:16px;text-align:center;cursor:pointer;transition:all .2s;position:relative}
    .file-wrap:hover{border-color:var(--blue);background:#eff6ff}
    .file-wrap input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
    .file-icon{font-size:26px;color:#94a3b8;margin-bottom:6px}
    .file-label{font-size:12px;font-weight:600;color:var(--muted)}
    .file-hint{font-size:11px;color:#94a3b8;margin-top:3px}
    .file-name{font-size:12px;font-weight:600;color:var(--blue);margin-top:6px;display:none}

    .btn-submit{width:100%;padding:14px;border-radius:12px;border:none;background:linear-gradient(135deg,var(--navy),var(--blue));color:white;font-size:15px;font-weight:700;cursor:pointer;transition:all .2s;display:flex;align-items:center;justify-content:center;gap:8px;font-family:inherit}
    .btn-submit:hover{transform:translateY(-1px);box-shadow:0 8px 24px rgba(28,100,242,.35)}
    .btn-back-top{display:inline-flex;align-items:center;gap:6px;color:rgba(255,255,255,.8);font-size:13px;font-weight:600;text-decoration:none;margin-bottom:14px;transition:color .15s}
    .btn-back-top:hover{color:white}
    .al-err{background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#991b1b;display:flex;align-items:center;gap:8px}
    .autofill-btn{display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:8px;border:1.5px solid #bfdbfe;background:#eff6ff;color:#1c64f2;font-size:12px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .15s}
    .autofill-btn:hover{border-color:#1c64f2}
    </style>
</head>
<body>
@include('partials.navbar')

@php
    $template    = $jenisSurat->template ?? 'A';
    $fieldConfig = is_array($jenisSurat->field_config) ? $jenisSurat->field_config : (json_decode($jenisSurat->field_config, true) ?? []);
@endphp

<div class="form-page">

    <div class="form-hero">
        <a href="{{ route('layanan') }}" class="btn-back-top">
            <i class="bi bi-arrow-left"></i> Kembali ke Layanan
        </a>
        <div class="form-hero-badge">
            <i class="bi bi-file-earmark-text" style="font-size:10px"></i> Formulir Permohonan
        </div>
        <h1 class="form-hero-title">{{ $jenisSurat->nama_surat }}</h1>
        <p class="form-hero-sub">{{ $jenisSurat->deskripsi ?? 'Isi data dengan lengkap dan benar sesuai KTP.' }}</p>
    </div>

    @if($errors->any())
    <div class="al-err">
        <i class="bi bi-exclamation-circle-fill"></i>
        Terdapat {{ $errors->count() }} kesalahan. Periksa kembali data yang diisi.
    </div>
    @endif

    <form action="{{ route('user.permohonan.store.surat', $jenisSurat->slug) }}"
          method="POST" enctype="multipart/form-data" novalidate>
        @csrf

        {{-- ══ DATA PEMOHON (semua template) ══ --}}
        <div class="sec">
            <div class="sec-head">
                <div class="sec-icon" style="background:#eff6ff;color:#1c64f2"><i class="bi bi-person-fill"></i></div>
                <div class="sec-title">Data Pemohon</div>
            </div>
            <div class="sec-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Nama Lengkap <span class="req">*</span></label>
                        <input type="text" name="nama_pemohon"
                            class="form-control {{ $errors->has('nama_pemohon') ? 'is-invalid' : '' }}"
                            value="{{ old('nama_pemohon') }}" placeholder="Sesuai KTP">
                        @error('nama_pemohon')<div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">NIK <span class="req">*</span></label>
                        <input type="text" name="nik_pemohon"
                            class="form-control {{ $errors->has('nik_pemohon') ? 'is-invalid' : '' }}"
                            value="{{ old('nik_pemohon') }}" placeholder="16 digit NIK" maxlength="16">
                        @error('nik_pemohon')<div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Tempat Lahir <span class="req">*</span></label>
                        <input type="text" name="tempat_lahir"
                            class="form-control {{ $errors->has('tempat_lahir') ? 'is-invalid' : '' }}"
                            value="{{ old('tempat_lahir') }}" placeholder="Kota tempat lahir">
                        @error('tempat_lahir')<div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Tanggal Lahir <span class="req">*</span></label>
                        <input type="date" name="tanggal_lahir"
                            class="form-control {{ $errors->has('tanggal_lahir') ? 'is-invalid' : '' }}"
                            value="{{ old('tanggal_lahir') }}">
                        @error('tanggal_lahir')<div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Jenis Kelamin <span class="req">*</span></label>
                        <select name="jenis_kelamin" class="form-control {{ $errors->has('jenis_kelamin') ? 'is-invalid' : '' }}">
                            <option value="">Pilih...</option>
                            <option value="Laki-Laki" {{ old('jenis_kelamin') === 'Laki-Laki' ? 'selected' : '' }}>Laki-Laki</option>
                            <option value="Perempuan" {{ old('jenis_kelamin') === 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                        </select>
                        @error('jenis_kelamin')<div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Agama</label>
                        <select name="agama" class="form-control">
                            <option value="">Pilih...</option>
                            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag)
                            <option value="{{ $ag }}" {{ old('agama') === $ag ? 'selected' : '' }}>{{ $ag }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label class="form-label-custom">Status Perkawinan</label>
                        <select name="status_kawin" class="form-control">
                            <option value="">Pilih...</option>
                            @foreach(['Belum Menikah','Kawin','Cerai Hidup','Cerai Mati'] as $sk)
                            <option value="{{ $sk }}" {{ old('status_kawin') === $sk ? 'selected' : '' }}>{{ $sk }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Pekerjaan</label>
                        <input type="text" name="pekerjaan" class="form-control"
                            value="{{ old('pekerjaan') }}" placeholder="Pekerjaan">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">RT</label>
                        <input type="text" name="rt" class="form-control" value="{{ old('rt') }}" placeholder="001">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom">RW</label>
                        <input type="text" name="rw" class="form-control" value="{{ old('rw') }}" placeholder="002">
                    </div>
                    <div class="col-12">
                        <label class="form-label-custom">Alamat Lengkap <span class="req">*</span></label>
                        <textarea name="alamat_pemohon" rows="2"
                            class="form-control {{ $errors->has('alamat_pemohon') ? 'is-invalid' : '' }}"
                            placeholder="Nama kampung/jalan, Kelurahan, Kecamatan, Kota">{{ old('alamat_pemohon') }}</textarea>
                        @error('alamat_pemohon')<div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                </div>
                @auth
                <div style="margin-top:14px;padding-top:14px;border-top:1px dashed var(--border)">
                    <button type="button" class="autofill-btn" onclick="isiOtomatis()">
                        <i class="bi bi-person-check-fill"></i> Isi Otomatis dari Akun Saya
                    </button>
                </div>
                @endauth
            </div>
        </div>

        {{-- ══ TEMPLATE B: Data Khusus Tambahan ══ --}}
        @if($template === 'B' && !empty($fieldConfig))
        <div class="sec">
            <div class="sec-head">
                <div class="sec-icon" style="background:#fffbeb;color:#d97706"><i class="bi bi-clipboard-data-fill"></i></div>
                <div class="sec-title">Data Tambahan</div>
            </div>
            <div class="sec-body">
                <div class="row g-3">
                    @foreach($fieldConfig as $field)
                    @php
                        $fieldKey  = $field['key'];
                        $fieldLabel = $field['label'];
                        $fieldType  = $field['type'] ?? 'text';
                        $isRequired = $field['required'] ?? false;
                    @endphp
                    <div class="{{ $fieldType === 'textarea' ? 'col-12' : 'col-md-6' }}">
                        <label class="form-label-custom">
                            {{ $fieldLabel }}
                            @if($isRequired)<span class="req">*</span>@endif
                        </label>
                        @if($fieldType === 'textarea')
                            <textarea name="field_{{ $fieldKey }}"
                                class="form-control {{ $errors->has('field_'.$fieldKey) ? 'is-invalid' : '' }}"
                                rows="3" placeholder="{{ $fieldLabel }}">{{ old('field_'.$fieldKey) }}</textarea>
                        @elseif($fieldType === 'date')
                            <input type="date" name="field_{{ $fieldKey }}"
                                class="form-control {{ $errors->has('field_'.$fieldKey) ? 'is-invalid' : '' }}"
                                value="{{ old('field_'.$fieldKey) }}">
                        @elseif($fieldType === 'number')
                            <input type="number" name="field_{{ $fieldKey }}"
                                class="form-control {{ $errors->has('field_'.$fieldKey) ? 'is-invalid' : '' }}"
                                value="{{ old('field_'.$fieldKey) }}" placeholder="{{ $fieldLabel }}">
                        @else
                            <input type="text" name="field_{{ $fieldKey }}"
                                class="form-control {{ $errors->has('field_'.$fieldKey) ? 'is-invalid' : '' }}"
                                value="{{ old('field_'.$fieldKey) }}" placeholder="{{ $fieldLabel }}">
                        @endif
                        @error('field_'.$fieldKey)<div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- ══ TEMPLATE C: Data Pihak Kedua ══ --}}
        @if($template === 'C')
        <div class="sec">
            <div class="sec-head">
                <div class="sec-icon" style="background:#fff1f2;color:#f43f5e"><i class="bi bi-people-fill"></i></div>
                <div class="sec-title">Data Pihak Kedua</div>
            </div>
            <div class="sec-body">
                <div class="row g-3">
                    @foreach($fieldConfig as $field)
                    @php
                        $fieldKey   = $field['key'];
                        $fieldLabel = $field['label'];
                        $fieldType  = $field['type'] ?? 'text';
                        $isRequired = $field['required'] ?? false;
                    @endphp
                    <div class="{{ $fieldType === 'textarea' ? 'col-12' : 'col-md-6' }}">
                        <label class="form-label-custom">
                            {{ $fieldLabel }}
                            @if($isRequired)<span class="req">*</span>@endif
                        </label>
                        @if($fieldType === 'textarea')
                            <textarea name="field_{{ $fieldKey }}"
                                class="form-control {{ $errors->has('field_'.$fieldKey) ? 'is-invalid' : '' }}"
                                rows="3" placeholder="{{ $fieldLabel }}">{{ old('field_'.$fieldKey) }}</textarea>
                        @elseif($fieldType === 'date')
                            <input type="date" name="field_{{ $fieldKey }}"
                                class="form-control {{ $errors->has('field_'.$fieldKey) ? 'is-invalid' : '' }}"
                                value="{{ old('field_'.$fieldKey) }}">
                        @elseif($fieldType === 'number')
                            <input type="number" name="field_{{ $fieldKey }}"
                                class="form-control {{ $errors->has('field_'.$fieldKey) ? 'is-invalid' : '' }}"
                                value="{{ old('field_'.$fieldKey) }}" placeholder="{{ $fieldLabel }}">
                        @else
                            <input type="text" name="field_{{ $fieldKey }}"
                                class="form-control {{ $errors->has('field_'.$fieldKey) ? 'is-invalid' : '' }}"
                                value="{{ old('field_'.$fieldKey) }}" placeholder="{{ $fieldLabel }}">
                        @endif
                        @error('field_'.$fieldKey)<div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        {{-- ══ KEPERLUAN (semua template) ══ --}}
        <div class="sec">
            <div class="sec-head">
                <div class="sec-icon" style="background:#f0fdf4;color:#10b981"><i class="bi bi-chat-square-text-fill"></i></div>
                <div class="sec-title">Keperluan / Tujuan Surat</div>
            </div>
            <div class="sec-body">
                <label class="form-label-custom">Keperluan Surat <span class="req">*</span></label>
                <textarea name="keperluan" rows="3"
                    class="form-control {{ $errors->has('keperluan') ? 'is-invalid' : '' }}"
                    placeholder="Jelaskan keperluan/tujuan pembuatan surat ini...">{{ old('keperluan') }}</textarea>
                @error('keperluan')<div class="invalid-feedback"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
        </div>

        {{-- ══ LAMPIRAN ══ --}}
        <div class="sec">
            <div class="sec-head">
                <div class="sec-icon" style="background:#fffbeb;color:#f59e0b"><i class="bi bi-paperclip"></i></div>
                <div class="sec-title">Lampiran Dokumen</div>
            </div>
            <div class="sec-body">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label-custom">Foto/Scan KTP <span class="req">*</span></label>
                        <div class="file-wrap">
                            <input type="file" name="dokumen_ktp" accept=".jpg,.jpeg,.png,.pdf"
                                onchange="showFileName(this,'fname_ktp')">
                            <div class="file-icon"><i class="bi bi-cloud-upload"></i></div>
                            <div class="file-label">Klik atau drag file ke sini</div>
                            <div class="file-hint">JPG, PNG, atau PDF. Maks 10MB.</div>
                            <div class="file-name" id="fname_ktp"></div>
                        </div>
                        @error('dokumen_ktp')<div class="invalid-feedback" style="display:flex"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>
                    <div class="col-md-6">
                        <label class="form-label-custom">Foto/Scan Kartu Keluarga <span class="req">*</span></label>
                        <div class="file-wrap">
                            <input type="file" name="dokumen_kk" accept=".jpg,.jpeg,.png,.pdf"
                                onchange="showFileName(this,'fname_kk')">
                            <div class="file-icon"><i class="bi bi-cloud-upload"></i></div>
                            <div class="file-label">Klik atau drag file ke sini</div>
                            <div class="file-hint">JPG, PNG, atau PDF. Maks 10MB.</div>
                            <div class="file-name" id="fname_kk"></div>
                        </div>
                        @error('dokumen_kk')<div class="invalid-feedback" style="display:flex"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
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
<script>
function showFileName(input, id) {
    const el = document.getElementById(id);
    if (input.files && input.files[0]) {
        el.textContent = '✓ ' + input.files[0].name;
        el.style.display = 'block';
    }
}
function isiOtomatis() {
    @auth
    const f = document.querySelector('[name="nama_pemohon"]');
    const n = document.querySelector('[name="nik_pemohon"]');
    const a = document.querySelector('[name="alamat_pemohon"]');
    if(f) f.value = '{{ auth()->user()->nama ?? "" }}';
    if(n) n.value = '{{ auth()->user()->nik ?? "" }}';
    if(a) a.value = '{{ auth()->user()->alamat ?? "" }}';
    @endauth
}
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>