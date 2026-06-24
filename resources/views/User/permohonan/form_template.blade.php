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
    @include('User.permohonan.partials.form_style')
</head>
<body>

@include('partials.navbar-user')
@php
    $maxPendukung = 3;
    $fieldsConfig = $jenisSurat->fields_config ?? [];
    $bioFields    = collect($fieldsConfig)->where('group', 'biodata')->values();
    $suamiFields  = collect($fieldsConfig)->where('group', 'suami')->values();
    $istriFields  = collect($fieldsConfig)->where('group', 'istri')->values();
    $extraFields  = collect($fieldsConfig)->where('group', 'extra')->values();
    $isPasangan   = $suamiFields->count() > 0;
@endphp

<div class="form-page">
    <a href="{{ route('layanan') }}" class="back-btn"><i class="bi bi-arrow-left"></i> Kembali ke Layanan</a>

    <div class="form-hero">
        <div style="position:relative;z-index:1">
            <div class="form-hero-badge"><i class="{{ $jenisSurat->icon ?? 'bi-file-earmark-text' }}"></i> FORMULIR PERMOHONAN</div>
            <div class="form-hero-title">{{ $jenisSurat->nama_surat }}</div>
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

    <form method="POST" action="{{ route('user.permohonan.store.surat', $jenisSurat->slug) }}" enctype="multipart/form-data">
        @csrf

        @include('User.permohonan.partials.section_pengajuan')

        {{-- DATA BIODATA DINAMIS --}}
        @if(!$isPasangan)
        <div class="card-section">
            <div class="card-section-head">
                <div class="card-section-head-icon" style="background:var(--blue-lt);color:var(--blue)"><i class="bi bi-person-fill"></i></div>
                <div class="card-section-title">Data Pemohon</div>
            </div>
            <div class="card-section-body">
                <div class="row g-3">
                    @foreach($bioFields as $field)
                        @if(($field['type'] ?? '') === 'section') @continue @endif
                        @include('User.permohonan.partials.field_input', ['field' => $field, 'prefix' => ''])
                    @endforeach
                </div>
            </div>
        </div>
        @else
        {{-- SURAT PASANGAN: Suami + Istri dalam 2 card berdampingan --}}
        <div class="row g-3 mb-2">
            {{-- SUAMI --}}
            <div class="col-md-6">
                <div class="card-section mb-0">
                    <div class="card-section-head">
                        <div class="card-section-head-icon" style="background:#eff6ff;color:#1c64f2"><i class="bi bi-person-fill"></i></div>
                        <div class="card-section-title">Data Suami</div>
                    </div>
                    <div class="card-section-body">
                        <div class="row g-3">
                            @foreach($suamiFields as $field)
                                @if(($field['type'] ?? '') === 'section') @continue @endif
                                @include('User.permohonan.partials.field_input', ['field' => $field, 'prefix' => ''])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            {{-- ISTRI --}}
            <div class="col-md-6">
                <div class="card-section mb-0">
                    <div class="card-section-head">
                        <div class="card-section-head-icon" style="background:#fdf4ff;color:#a855f7"><i class="bi bi-person-fill"></i></div>
                        <div class="card-section-title">Data Istri</div>
                    </div>
                    <div class="card-section-body">
                        <div class="row g-3">
                            @foreach($istriFields as $field)
                                @if(($field['type'] ?? '') === 'section') @continue @endif
                                @include('User.permohonan.partials.field_input', ['field' => $field, 'prefix' => ''])
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        {{-- FIELD TAMBAHAN --}}
        @if($extraFields->count() > 0)
        <div class="card-section">
            <div class="card-section-head">
                <div class="card-section-head-icon" style="background:#ecfdf5;color:var(--green)"><i class="bi bi-file-text-fill"></i></div>
                <div class="card-section-title">Data Tambahan</div>
            </div>
            <div class="card-section-body">
                <div class="row g-3">
                    @foreach($extraFields as $ef)
                    @if(($ef['type'] ?? '') === 'section') @continue @endif
                    <div class="col-md-{{ $ef['type'] === 'textarea' ? '12' : '6' }}">
                        <label class="form-label-custom">{{ $ef['label'] }} @if($ef['required'] ?? false)<span class="req">*</span>@endif</label>
                        @if($ef['type'] === 'textarea')
                        <textarea name="extra_{{ $ef['key'] }}" class="form-control" rows="2" {{ ($ef['required'] ?? false) ? 'required' : '' }}>{{ old('extra_'.$ef['key']) }}</textarea>
                        @elseif($ef['type'] === 'date')
                        <input type="date" name="extra_{{ $ef['key'] }}" class="form-control" value="{{ old('extra_'.$ef['key']) }}" {{ ($ef['required'] ?? false) ? 'required' : '' }}>
                        @else
                        <input type="text" name="extra_{{ $ef['key'] }}" class="form-control" value="{{ old('extra_'.$ef['key']) }}" {{ ($ef['required'] ?? false) ? 'required' : '' }}>
                        @endif
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

        @include('User.permohonan.partials.section_dokumen')

        <button type="submit" class="btn-submit"><i class="bi bi-send-fill"></i> Kirim Permohonan</button>
    </form>
</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
@include('User.permohonan.partials.form_script')
</body>
</html>
