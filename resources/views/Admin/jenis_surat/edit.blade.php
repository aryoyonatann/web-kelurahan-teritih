@extends('admin.layouts.app')

@section('title', 'Edit Jenis Surat')

@push('styles')
<link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f1f5f9; }
    .form-page { padding: 0; min-height: 100vh; }

    /* ── BACK BAR ── */
    .back-bar { display:flex;align-items:center;gap:8px;padding:14px 32px;background:white;border-bottom:1px solid #e2e8f0;font-size:13px; }
    .back-btn { display:inline-flex;align-items:center;gap:6px;color:#64748b;text-decoration:none;font-weight:600;padding:5px 10px;border-radius:7px;transition:all .15s; }
    .back-btn:hover { background:#f1f5f9;color:#1c64f2; }
    .bc-sep { color:#cbd5e1; }
    .bc-cur { color:#0f172a;font-weight:600; }

    /* ── HERO ── */
    .form-hero { background:linear-gradient(135deg,#1e40af 0%,#1c64f2 50%,#2563eb 100%);padding:28px 32px;position:relative;overflow:hidden; }
    .form-hero::before {
        content:'';position:absolute;inset:0;
        background:url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .form-hero-inner { position:relative;z-index:1;display:flex;align-items:center;justify-content:space-between;flex-wrap:wrap;gap:12px; }
    .form-hero h1 { font-size:22px;font-weight:800;color:white;margin:0 0 4px; }
    .form-hero p  { font-size:13px;color:rgba(255,255,255,.75);margin:0; }
    .hero-id-badge { background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:white;border-radius:8px;padding:6px 14px;font-size:12px;font-weight:700;white-space:nowrap; }
    .hero-template-badge { background:rgba(245,158,11,.25);border:1px solid rgba(245,158,11,.5);color:#fef3c7;border-radius:8px;padding:6px 14px;font-size:12px;font-weight:700;white-space:nowrap; }
    .hero-badges { display:flex;gap:8px;flex-wrap:wrap; }

    /* ── WRAPPER ── */
    .form-wrapper { padding:28px 32px; }

    /* ── FORM CARD ── */
    .form-card { background:white;border-radius:14px;border:1px solid #e2e8f0;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.06);margin-bottom:20px; }
    .form-card-header { padding:16px 24px;border-bottom:1px solid #e2e8f0;background:#f8fafc;display:flex;align-items:center;gap:10px; }
    .form-card-icon { width:36px;height:36px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:17px; }
    .form-card-title { font-size:14px;font-weight:700;color:#0f172a; }
    .form-card-body { padding:24px; }

    /* ── CURRENT VALUE BADGE ── */
    .current-val { display:inline-flex;align-items:center;gap:6px;background:#fffbeb;border:1px solid #fde68a;border-radius:7px;padding:6px 12px;font-size:12px;color:#92400e;font-weight:600;margin-bottom:20px; }
    .readonly-info { background:#fef3c7;border:1.5px solid #fde68a;border-radius:10px;padding:12px 16px;font-size:12px;color:#92400e;display:flex;gap:8px;margin-bottom:20px;align-items:flex-start; }

    /* ── FIELDS ── */
    .field-group { margin-bottom:20px; }
    .field-group:last-of-type { margin-bottom:0; }
    .field-label { display:block;font-size:12px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px; }
    .field-label span { color:#dc2626;margin-left:2px; }
    .field-input { width:100%;padding:11px 14px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13px;font-family:inherit;color:#0f172a;background:white;transition:all .2s;outline:none; }
    .field-input:focus { border-color:#f59e0b;box-shadow:0 0 0 3px rgba(245,158,11,.1); }
    .field-input::placeholder { color:#94a3b8; }
    textarea.field-input { resize:vertical;min-height:90px; }
    .field-hint  { font-size:11px;color:#94a3b8;margin-top:5px; }
    .field-error { font-size:12px;color:#dc2626;margin-top:5px;display:flex;align-items:center;gap:4px; }
    .field-input.is-error { border-color:#dc2626; }

    .info-grid { display:grid;grid-template-columns:1fr 1fr;gap:20px; }

    /* ── TEMPLATE CARDS ── */
    .template-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:14px;margin-bottom:4px; }
    .template-card { border:2px solid #e2e8f0;border-radius:12px;padding:16px;cursor:pointer;transition:all .2s;position:relative; }
    .template-card:hover { border-color:#93c5fd; }
    .template-card input[type=radio] { position:absolute;opacity:0;width:0;height:0; }
    .template-card.selected { border-color:#1c64f2;background:#eff6ff; }
    .template-card.selected .tc-icon { background:#1c64f2;color:white; }
    .tc-icon { width:40px;height:40px;border-radius:10px;background:#f1f5f9;display:flex;align-items:center;justify-content:center;font-size:20px;margin-bottom:10px;transition:all .2s; }
    .tc-name { font-size:13px;font-weight:700;color:#0f172a;margin-bottom:4px; }
    .tc-desc { font-size:11px;color:#64748b;line-height:1.5; }
    .tc-check { position:absolute;top:10px;right:10px;width:20px;height:20px;border-radius:50%;background:#1c64f2;color:white;display:none;align-items:center;justify-content:center;font-size:11px; }
    .template-card.selected .tc-check { display:flex; }
    .tc-example { font-size:10px;color:#94a3b8;margin-top:6px;font-style:italic;line-height:1.4; }

    /* ── FIELD BUILDER ── */
    .field-builder { display:none; }
    .field-builder.show { display:block; }

    .preset-grid { display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-bottom:16px; }
    .preset-item { display:flex;align-items:center;gap:10px;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:9px;cursor:pointer;transition:all .15s; }
    .preset-item:hover { border-color:#93c5fd;background:#f8fafc; }
    .preset-item input[type=checkbox] { width:16px;height:16px;accent-color:#1c64f2;cursor:pointer;flex-shrink:0; }
    .preset-item-info { flex:1; }
    .preset-item-label { font-size:13px;font-weight:600;color:#0f172a;line-height:1.2; }
    .preset-item-type { font-size:10px;color:#94a3b8;text-transform:uppercase;letter-spacing:.05em;margin-top:2px; }
    .preset-item.checked { border-color:#1c64f2;background:#eff6ff; }
    .req-toggle { font-size:11px;color:#64748b;white-space:nowrap; }
    .req-toggle input { accent-color:#ef4444; }

    .preset-group { display:none; }
    .preset-group.active { display:block; }

    /* ── PIHAK KEDUA PREVIEW ── */
    .pihak2-preview { background:#fef2f2;border:1.5px solid #fecaca;border-radius:12px;padding:16px 20px;margin-bottom:20px;display:none; }
    .pihak2-preview.show { display:block; }
    .pihak2-preview-header { display:flex;align-items:center;gap:10px;margin-bottom:12px; }
    .pihak2-preview-icon { width:34px;height:34px;border-radius:9px;background:#f43f5e;color:white;display:flex;align-items:center;justify-content:center;font-size:16px; }
    .pihak2-preview-title { font-size:13px;font-weight:700;color:#991b1b; }
    .pihak2-preview-sub { font-size:12px;color:#b91c1c;margin-top:2px; }
    .pihak2-fields { display:grid;grid-template-columns:repeat(3,1fr);gap:8px;margin-top:12px; }
    .pihak2-field { background:white;border:1px solid #fecaca;border-radius:7px;padding:8px 12px;font-size:12px; }
    .pihak2-field-label { font-weight:600;color:#991b1b; }
    .pihak2-field-type { font-size:10px;color:#dc2626;text-transform:uppercase;letter-spacing:.05em;margin-top:2px; }
    .pihak2-field-req { display:inline-block;background:#dc2626;color:white;font-size:9px;font-weight:700;padding:1px 6px;border-radius:8px;margin-left:6px;text-transform:uppercase;letter-spacing:.05em; }

    /* ── CUSTOM FIELDS ── */
    .custom-field-row { display:flex;gap:8px;align-items:flex-start;margin-bottom:10px;padding:12px;background:#f8fafc;border-radius:10px;border:1px solid #e2e8f0; }
    .custom-field-row .cf-label { flex:1; }
    .custom-field-row .cf-type  { width:130px;flex-shrink:0; }
    .custom-field-row .cf-req   { flex-shrink:0;padding-top:8px;font-size:12px;color:#64748b;display:flex;align-items:center;gap:4px; }
    .custom-field-row .cf-del   { flex-shrink:0;padding-top:6px; }
    .btn-del { background:#fef2f2;border:1px solid #fecaca;color:#dc2626;border-radius:7px;width:32px;height:32px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:14px;transition:all .15s; }
    .btn-del:hover { background:#fee2e2; }

    .btn-add-field { display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:9px;border:1.5px dashed #93c5fd;background:#f0f9ff;color:#0284c7;font-size:13px;font-weight:600;cursor:pointer;transition:all .15s;font-family:inherit; }
    .btn-add-field:hover { border-color:#1c64f2;background:#eff6ff;color:#1c64f2; }

    .info-box { background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:10px;padding:12px 16px;font-size:12px;color:#1e40af;display:flex;gap:8px;margin-bottom:16px; }

    /* ── FOOTER ── */
    .form-footer { padding:16px 24px;background:white;border:1px solid #e2e8f0;border-radius:14px;display:flex;align-items:center;justify-content:space-between;gap:10px;flex-wrap:wrap;margin-top:4px; }
    .footer-left { display:flex;align-items:center;gap:6px;font-size:12px;color:#94a3b8; }
    .footer-right { display:flex;gap:10px; }
    .btn-batal { display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:9px;border:1.5px solid #e2e8f0;background:white;font-size:13px;font-weight:600;color:#64748b;text-decoration:none;cursor:pointer;transition:all .15s; }
    .btn-batal:hover { background:#f8fafc;border-color:#cbd5e1;color:#334155; }
    .btn-update { display:inline-flex;align-items:center;gap:6px;padding:9px 22px;border-radius:9px;border:none;background:#f59e0b;font-size:13px;font-weight:700;color:white;cursor:pointer;transition:all .15s;font-family:inherit; }
    .btn-update:hover { background:#d97706;transform:translateY(-1px);box-shadow:0 4px 12px rgba(245,158,11,.3); }

    @media (max-width: 991px) {
        .template-grid, .preset-grid, .pihak2-fields, .info-grid { grid-template-columns:1fr; }
    }
</style>
@endpush

@section('content')

@include('admin.partials.header')

@php
    // Pisahkan preset fields (B/C) dari custom fields yang sudah tersimpan
    $existingConfig = is_array($data->field_config) ? $data->field_config : (json_decode($data->field_config, true) ?? []);

    // Filter: keluarkan field "pihak kedua lama" yang mungkin masih tersimpan dari sistem lama
    $pihak2Keys = ['nama_pihak2','nik_pihak2','ttl_pihak2','pekerjaan_pihak2','alamat_pihak2','hubungan'];

    $existingPresetKeys     = [];
    $existingRequiredKeys   = [];
    $existingCustomFields   = [];

    foreach ($existingConfig as $f) {
        // Skip field pihak2 dari sistem lama (sekarang sudah built-in di template C)
        if (in_array($f['key'] ?? '', $pihak2Keys)) continue;

        if ($f['is_preset'] ?? false) {
            $existingPresetKeys[] = $f['key'];
            if ($f['required'] ?? false) {
                $existingRequiredKeys[] = $f['key'];
            }
        } else {
            $existingCustomFields[] = $f;
        }
    }

    // Gabungkan dengan old() input kalau ada (setelah validation error)
    $checkedPresets  = old('preset_fields', $existingPresetKeys);
    $checkedRequired = old('required_fields', $existingRequiredKeys);
    $currentTemplate = old('template', $data->template ?? 'A');

    $templateLabel = match($currentTemplate) {
        'A' => 'Surat Keterangan Biasa',
        'B' => 'Data Khusus',
        'C' => 'Dua Pihak',
        default => '-',
    };
@endphp

<div class="form-page">

    {{-- BACK BAR --}}
    <div class="back-bar">
        <a href="{{ route('jenis-surat.index') }}" class="back-btn"><i class="bi bi-arrow-left"></i> Kembali</a>
        <span class="bc-sep">/</span>
        <a href="{{ route('jenis-surat.index') }}" style="color:#64748b;text-decoration:none;font-size:13px">Jenis Surat</a>
        <span class="bc-sep">/</span>
        <span class="bc-cur">Edit</span>
    </div>

    {{-- HERO --}}
    <div class="form-hero">
        <div class="form-hero-inner">
            <div>
                <h1><i class="bi bi-pencil-square me-2"></i>Edit Jenis Surat</h1>
                <p>Perbarui informasi jenis surat yang sudah ada</p>
            </div>
            <div class="hero-badges">
                @if($data->is_custom)
                <div class="hero-template-badge">
                    <i class="bi bi-layout-text-window"></i> Template {{ $currentTemplate }} — {{ $templateLabel }}
                </div>
                @endif
                <div class="hero-id-badge">
                    <i class="bi bi-hash"></i> ID {{ $data->id_jenis_surat }}
                </div>
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="form-wrapper">

        <div class="current-val">
            <i class="bi bi-info-circle"></i>
            Sedang mengedit: <strong>{{ $data->nama_surat }}</strong>
        </div>

        @unless($data->is_custom)
        <div class="readonly-info">
            <i class="bi bi-shield-lock-fill" style="margin-top:1px"></i>
            <div>
                <strong>Surat bawaan sistem.</strong> Anda hanya dapat mengubah <strong>nama</strong> dan <strong>deskripsi</strong>. Template dan field tidak dapat diubah untuk menjaga konsistensi format cetak.
            </div>
        </div>
        @endunless

        <form action="{{ route('jenis-surat.update', $data->id_jenis_surat) }}" method="POST" id="formEdit">
            @csrf
            @method('PUT')

            {{-- INFO SURAT --}}
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-icon" style="background:#fffbeb;color:#d97706"><i class="bi bi-pencil"></i></div>
                    <div class="form-card-title">Informasi Jenis Surat</div>
                </div>
                <div class="form-card-body">
                    <div class="info-grid">
                        <div class="field-group" style="margin-bottom:0">
                            <label class="field-label">Nama Surat <span>*</span></label>
                            <input type="text" name="nama_surat"
                                class="field-input {{ $errors->has('nama_surat') ? 'is-error' : '' }}"
                                placeholder="Contoh: Surat Keterangan Domisili"
                                value="{{ old('nama_surat', $data->nama_surat) }}"
                                required>
                            @error('nama_surat')<div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                        </div>
                        <div class="field-group" style="margin-bottom:0">
                            <label class="field-label">Deskripsi <span style="color:#94a3b8;font-weight:400">(Opsional)</span></label>
                            <textarea name="deskripsi" class="field-input {{ $errors->has('deskripsi') ? 'is-error' : '' }}"
                                rows="1" style="min-height:46px;resize:none"
                                placeholder="Keterangan singkat tentang kegunaan surat ini...">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                            @error('deskripsi')<div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>
            </div>

            {{-- TEMPLATE & FIELD BUILDER (HANYA UNTUK SURAT CUSTOM) --}}
            @if($data->is_custom)

            {{-- PILIH TEMPLATE --}}
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-icon" style="background:#f0fdf4;color:#059669"><i class="bi bi-layout-text-window"></i></div>
                    <div class="form-card-title">Template Form</div>
                </div>
                <div class="form-card-body">
                    @error('template')<div class="field-error" style="margin-bottom:12px"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror

                    <div class="info-box">
                        <i class="bi bi-exclamation-triangle-fill" style="flex-shrink:0;margin-top:1px;color:#d97706"></i>
                        <div><strong>Perhatian:</strong> Mengubah template akan menyebabkan field tambahan harus dipilih ulang. Permohonan lama yang sudah masuk tetap aman.</div>
                    </div>

                    <div class="template-grid">
                        <label class="template-card {{ $currentTemplate === 'A' ? 'selected' : '' }}" onclick="selectTemplate('A')">
                            <input type="radio" name="template" value="A" {{ $currentTemplate === 'A' ? 'checked' : '' }}>
                            <div class="tc-check"><i class="bi bi-check"></i></div>
                            <div class="tc-icon">📄</div>
                            <div class="tc-name">Surat Keterangan Biasa</div>
                            <div class="tc-desc">Form biodata standar + keperluan surat saja. Tanpa field tambahan.</div>
                            <div class="tc-example">Contoh: Domisili, Tidak Mampu, Kelakuan Baik</div>
                        </label>

                        <label class="template-card {{ $currentTemplate === 'B' ? 'selected' : '' }}" onclick="selectTemplate('B')">
                            <input type="radio" name="template" value="B" {{ $currentTemplate === 'B' ? 'checked' : '' }}>
                            <div class="tc-check"><i class="bi bi-check"></i></div>
                            <div class="tc-icon">📋</div>
                            <div class="tc-name">Surat Keterangan dengan Data Khusus</div>
                            <div class="tc-desc">Biodata + field konteks peristiwa (tanggal, lokasi, dokumen, dll).</div>
                            <div class="tc-example">Contoh: Kehilangan, Usaha, Izin Keramaian</div>
                        </label>

                        <label class="template-card {{ $currentTemplate === 'C' ? 'selected' : '' }}" onclick="selectTemplate('C')">
                            <input type="radio" name="template" value="C" {{ $currentTemplate === 'C' ? 'checked' : '' }}>
                            <div class="tc-check"><i class="bi bi-check"></i></div>
                            <div class="tc-icon">👥</div>
                            <div class="tc-name">Surat Keterangan Dua Pihak</div>
                            <div class="tc-desc">Biodata pemohon <strong>+ biodata Pihak Kedua otomatis</strong> (Nama, NIK, TTL, Alamat, Hubungan).</div>
                            <div class="tc-example">Contoh: Ahli Waris, Wali, Hubungan Keluarga</div>
                        </label>
                    </div>
                </div>
            </div>

            {{-- FIELD BUILDER --}}
            <div class="form-card field-builder {{ in_array($currentTemplate, ['B','C']) ? 'show' : '' }}" id="fieldBuilder">
                <div class="form-card-header">
                    <div class="form-card-icon" style="background:#fffbeb;color:#d97706"><i class="bi bi-ui-checks"></i></div>
                    <div class="form-card-title">Konfigurasi Field Tambahan</div>
                </div>
                <div class="form-card-body">

                    {{-- Preview Pihak Kedua (template C) --}}
                    <div class="pihak2-preview {{ $currentTemplate === 'C' ? 'show' : '' }}" id="pihak2Preview">
                        <div class="pihak2-preview-header">
                            <div class="pihak2-preview-icon"><i class="bi bi-people-fill"></i></div>
                            <div>
                                <div class="pihak2-preview-title">Blok "Data Pihak Kedua" — Otomatis Tampil di Form Warga</div>
                                <div class="pihak2-preview-sub">Field ini sudah built-in untuk template Dua Pihak, tidak perlu dicentang.</div>
                            </div>
                        </div>
                        <div class="pihak2-fields">
                            @foreach($pihakKeduaFields as $f)
                            <div class="pihak2-field">
                                <div class="pihak2-field-label">
                                    {{ $f['label'] }}
                                    @if($f['required'])<span class="pihak2-field-req">Wajib</span>@endif
                                </div>
                                <div class="pihak2-field-type">{{ $f['type'] }}</div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="info-box">
                        <i class="bi bi-info-circle-fill" style="flex-shrink:0;margin-top:1px"></i>
                        <div>Centang field konteks tambahan yang ingin ditampilkan di form pengajuan warga. Tambahkan field kustom jika tidak ada di daftar. Centang <strong>Wajib</strong> jika field harus diisi.</div>
                    </div>

                    <div class="field-label" style="margin-bottom:10px">Field Tersedia — Centang yang Diperlukan</div>

                    {{-- Preset Template B --}}
                    <div class="preset-group {{ $currentTemplate === 'B' ? 'active' : '' }}" id="presetGroupB">
                        <div class="preset-grid">
                            @foreach($presetsB as $preset)
                            @php $isChecked = in_array($preset['key'], $checkedPresets); @endphp
                            <div class="preset-item {{ $isChecked ? 'checked' : '' }}" id="piB_{{ $preset['key'] }}"
                                onclick="togglePreset('B','{{ $preset['key'] }}')">
                                <input type="checkbox" name="preset_fields[]"
                                    value="{{ $preset['key'] }}"
                                    id="pfB_{{ $preset['key'] }}"
                                    {{ $isChecked ? 'checked' : '' }}
                                    onclick="event.stopPropagation()">
                                <div class="preset-item-info">
                                    <div class="preset-item-label">{{ $preset['label'] }}</div>
                                    <div class="preset-item-type">{{ $preset['type'] }}</div>
                                </div>
                                <div class="req-toggle" title="Wajib diisi?">
                                    <input type="checkbox" name="required_fields[]"
                                        value="{{ $preset['key'] }}"
                                        {{ in_array($preset['key'], $checkedRequired) ? 'checked' : '' }}
                                        onclick="event.stopPropagation()">
                                    Wajib
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Preset Template C --}}
                    <div class="preset-group {{ $currentTemplate === 'C' ? 'active' : '' }}" id="presetGroupC">
                        <div class="preset-grid">
                            @foreach($presetsC as $preset)
                            @php $isChecked = in_array($preset['key'], $checkedPresets); @endphp
                            <div class="preset-item {{ $isChecked ? 'checked' : '' }}" id="piC_{{ $preset['key'] }}"
                                onclick="togglePreset('C','{{ $preset['key'] }}')">
                                <input type="checkbox" name="preset_fields[]"
                                    value="{{ $preset['key'] }}"
                                    id="pfC_{{ $preset['key'] }}"
                                    {{ $isChecked ? 'checked' : '' }}
                                    onclick="event.stopPropagation()">
                                <div class="preset-item-info">
                                    <div class="preset-item-label">{{ $preset['label'] }}</div>
                                    <div class="preset-item-type">{{ $preset['type'] }}</div>
                                </div>
                                <div class="req-toggle" title="Wajib diisi?">
                                    <input type="checkbox" name="required_fields[]"
                                        value="{{ $preset['key'] }}"
                                        {{ in_array($preset['key'], $checkedRequired) ? 'checked' : '' }}
                                        onclick="event.stopPropagation()">
                                    Wajib
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- CUSTOM FIELDS --}}
                    <div class="field-label" style="margin-top:20px;margin-bottom:10px">Field Tambahan Kustom</div>
                    <div id="customFieldsWrap">
                        {{-- Render custom fields lama yang sudah tersimpan --}}
                        @foreach($existingCustomFields as $i => $cf)
                        <div class="custom-field-row" id="cf_existing_{{ $i }}">
                            <div class="cf-label">
                                <input type="text" name="custom_label[]" class="field-input"
                                    placeholder="Nama field" style="font-size:13px"
                                    value="{{ $cf['label'] }}">
                            </div>
                            <div class="cf-type">
                                <select name="custom_type[]" class="field-input" style="font-size:13px">
                                    @foreach(['text'=>'Teks','date'=>'Tanggal','number'=>'Angka','textarea'=>'Teks Panjang','select'=>'Pilihan'] as $v=>$lbl)
                                    <option value="{{ $v }}" {{ ($cf['type'] ?? 'text') === $v ? 'selected' : '' }}>{{ $lbl }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="cf-req">
                                <input type="checkbox" name="custom_required[{{ $i }}]"
                                    {{ ($cf['required'] ?? false) ? 'checked' : '' }}>
                                Wajib
                            </div>
                            <div class="cf-del">
                                <button type="button" class="btn-del" onclick="removeCustomField('cf_existing_{{ $i }}')">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <button type="button" class="btn-add-field" onclick="addCustomField()">
                        <i class="bi bi-plus-lg"></i> Tambah Field Lain
                    </button>
                </div>
            </div>

            @endif {{-- /is_custom --}}

            {{-- FOOTER --}}
            <div class="form-footer">
                <div class="footer-left">
                    <i class="bi bi-clock-history"></i>
                    Perubahan akan langsung tersimpan
                </div>
                <div class="footer-right">
                    <a href="{{ route('jenis-surat.index') }}" class="btn-batal"><i class="bi bi-x-lg"></i> Batal</a>
                    <button type="submit" class="btn-update"><i class="bi bi-check-lg"></i> Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@include('admin.partials.footer')
@endsection

@push('scripts')
<script>
// Mulai dari index berapa custom field baru akan ditambahkan
let customFieldCount = {{ count($existingCustomFields) }};

function selectTemplate(t) {
    document.querySelectorAll('.template-card').forEach(c => c.classList.remove('selected'));
    if (event && event.currentTarget) {
        event.currentTarget.classList.add('selected');
    }

    const builder       = document.getElementById('fieldBuilder');
    const presetGroupB  = document.getElementById('presetGroupB');
    const presetGroupC  = document.getElementById('presetGroupC');
    const pihak2Preview = document.getElementById('pihak2Preview');

    presetGroupB.classList.remove('active');
    presetGroupC.classList.remove('active');
    pihak2Preview.classList.remove('show');

    if (t === 'A') {
        builder.classList.remove('show');
    } else if (t === 'B') {
        builder.classList.add('show');
        presetGroupB.classList.add('active');
        uncheckGroup('C');
    } else if (t === 'C') {
        builder.classList.add('show');
        presetGroupC.classList.add('active');
        pihak2Preview.classList.add('show');
        uncheckGroup('B');
    }
}

function uncheckGroup(which) {
    const prefix = 'pf' + which + '_';
    document.querySelectorAll(`[id^="${prefix}"]`).forEach(cb => { cb.checked = false; });
    document.querySelectorAll(`#presetGroup${which} input[name="required_fields[]"]`).forEach(cb => { cb.checked = false; });
    document.querySelectorAll(`#presetGroup${which} .preset-item`).forEach(item => { item.classList.remove('checked'); });
}

function togglePreset(group, key) {
    const item = document.getElementById('pi' + group + '_' + key);
    const cb   = document.getElementById('pf' + group + '_' + key);
    cb.checked = !cb.checked;
    item.classList.toggle('checked', cb.checked);
}

function addCustomField() {
    const i = customFieldCount++;
    const wrap = document.getElementById('customFieldsWrap');
    const div = document.createElement('div');
    div.className = 'custom-field-row';
    div.id = 'cf_new_' + i;
    div.innerHTML = `
        <div class="cf-label">
            <input type="text" name="custom_label[]" class="field-input"
                placeholder="Nama field (contoh: Nomor Sertifikat)" style="font-size:13px">
        </div>
        <div class="cf-type">
            <select name="custom_type[]" class="field-input" style="font-size:13px">
                <option value="text">Teks</option>
                <option value="date">Tanggal</option>
                <option value="number">Angka</option>
                <option value="textarea">Teks Panjang</option>
                <option value="select">Pilihan</option>
            </select>
        </div>
        <div class="cf-req">
            <input type="checkbox" name="custom_required[${i}]" title="Wajib diisi">
            Wajib
        </div>
        <div class="cf-del">
            <button type="button" class="btn-del" onclick="removeCustomField('cf_new_${i}')">
                <i class="bi bi-trash"></i>
            </button>
        </div>
    `;
    wrap.appendChild(div);
}

function removeCustomField(id) {
    const el = document.getElementById(id);
    if (el) el.remove();
}
</script>
@endpush