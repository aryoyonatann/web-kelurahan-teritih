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
    .back-bar {
        display: flex; align-items: center; gap: 8px;
        padding: 14px 32px; background: white;
        border-bottom: 1px solid #e2e8f0;
        font-size: 13px;
    }
    .back-btn {
        display: inline-flex; align-items: center; gap: 6px;
        color: #64748b; text-decoration: none; font-weight: 600;
        padding: 5px 10px; border-radius: 7px;
        transition: all .15s;
    }
    .back-btn:hover { background: #f1f5f9; color: #1c64f2; }
    .bc-sep { color: #cbd5e1; }
    .bc-cur { color: #0f172a; font-weight: 600; }

    /* ── HERO ── */
    .form-hero {
        background: linear-gradient(135deg, #1e40af 0%, #1c64f2 50%, #2563eb 100%);
        padding: 28px 32px;
        position: relative; overflow: hidden;
    }
    .form-hero::before {
        content: '';
        position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .form-hero-inner { position: relative; z-index: 1; display: flex; align-items: center; justify-content: space-between; flex-wrap: wrap; gap: 12px; }
    .form-hero h1 { font-size: 22px; font-weight: 800; color: white; margin: 0 0 4px; }
    .form-hero p  { font-size: 13px; color: rgba(255,255,255,.75); margin: 0; }
    .hero-id-badge {
        background: rgba(255,255,255,.15); border: 1px solid rgba(255,255,255,.25);
        color: white; border-radius: 8px; padding: 6px 14px;
        font-size: 12px; font-weight: 700; white-space: nowrap;
    }

    /* ── FORM WRAPPER ── */
    .form-wrapper { padding: 28px 32px; max-width: 720px; }

    /* ── FORM CARD ── */
    .form-card {
        background: white; border-radius: 14px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,.06);
    }
    .form-card-header {
        padding: 16px 24px; border-bottom: 1px solid #e2e8f0;
        background: #f8fafc;
        display: flex; align-items: center; gap: 10px;
    }
    .form-card-icon {
        width: 36px; height: 36px; border-radius: 9px;
        background: #fffbeb; color: #d97706;
        display: flex; align-items: center; justify-content: center;
        font-size: 17px;
    }
    .form-card-title { font-size: 14px; font-weight: 700; color: #0f172a; }
    .form-card-body  { padding: 24px; }

    /* ── CURRENT VALUE BADGE ── */
    .current-val {
        display: inline-flex; align-items: center; gap: 6px;
        background: #fffbeb; border: 1px solid #fde68a;
        border-radius: 7px; padding: 6px 12px;
        font-size: 12px; color: #92400e; font-weight: 600;
        margin-bottom: 20px;
    }

    /* ── FORM FIELDS ── */
    .field-group { margin-bottom: 20px; }
    .field-group:last-of-type { margin-bottom: 0; }

    .field-label {
        display: block; font-size: 12px; font-weight: 700;
        color: #374151; text-transform: uppercase; letter-spacing: .05em;
        margin-bottom: 8px;
    }
    .field-label span { color: #dc2626; margin-left: 2px; }

    .field-input {
        width: 100%; padding: 11px 14px;
        border: 1.5px solid #e2e8f0; border-radius: 9px;
        font-size: 13px; font-family: inherit; color: #0f172a;
        background: white; transition: all .2s;
        outline: none;
    }
    .field-input:focus { border-color: #f59e0b; box-shadow: 0 0 0 3px rgba(245,158,11,.1); }
    .field-input::placeholder { color: #94a3b8; }

    textarea.field-input { resize: vertical; min-height: 110px; }

    .field-hint  { font-size: 11px; color: #94a3b8; margin-top: 5px; }
    .field-error { font-size: 12px; color: #dc2626; margin-top: 5px; display: flex; align-items: center; gap: 4px; }
    .field-input.is-error { border-color: #dc2626; }

    /* ── FORM FOOTER ── */
    .form-footer {
        padding: 16px 24px; background: #f8fafc;
        border-top: 1px solid #e2e8f0;
        display: flex; align-items: center; justify-content: space-between; gap: 10px;
        flex-wrap: wrap;
    }
    .footer-left { display: flex; align-items: center; gap: 6px; font-size: 12px; color: #94a3b8; }
    .footer-right { display: flex; gap: 10px; }

    .btn-batal {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 9px 18px; border-radius: 9px;
        border: 1.5px solid #e2e8f0; background: white;
        font-size: 13px; font-weight: 600; color: #64748b;
        text-decoration: none; cursor: pointer; transition: all .15s;
    }
    .btn-batal:hover { background: #f8fafc; border-color: #cbd5e1; color: #334155; }
    .btn-update {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 9px 22px; border-radius: 9px;
        border: none; background: #f59e0b;
        font-size: 13px; font-weight: 700; color: white;
        cursor: pointer; transition: all .15s;
    }
    .btn-update:hover { background: #d97706; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(245,158,11,.3); }
</style>
@endpush

@section('content')

@include('admin.partials.header')

<div class="form-page">

    {{-- BACK BAR --}}
    <div class="back-bar">
        <a href="{{ route('jenis-surat.index') }}" class="back-btn">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
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
            <div class="hero-id-badge">
                <i class="bi bi-hash"></i> ID {{ $data->id_jenis_surat }}
            </div>
        </div>
    </div>

    {{-- FORM --}}
    <div class="form-wrapper">

        {{-- current value info --}}
        <div class="current-val mb-3">
            <i class="bi bi-info-circle"></i>
            Sedang mengedit: <strong>{{ $data->nama_surat }}</strong>
        </div>

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-icon"><i class="bi bi-pencil"></i></div>
                <div class="form-card-title">Ubah Informasi Jenis Surat</div>
            </div>

            <form action="{{ route('jenis-surat.update', $data->id_jenis_surat) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="form-card-body">

                    <div class="field-group">
                        <label class="field-label">Nama Surat <span>*</span></label>
                        <input type="text" name="nama_surat"
                            class="field-input {{ $errors->has('nama_surat') ? 'is-error' : '' }}"
                            placeholder="Contoh: Surat Keterangan Domisili"
                            value="{{ old('nama_surat', $data->nama_surat) }}"
                            required>
                        @error('nama_surat')
                            <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                    </div>

                    <div class="field-group">
                        <label class="field-label">Deskripsi</label>
                        <textarea name="deskripsi"
                            class="field-input {{ $errors->has('deskripsi') ? 'is-error' : '' }}"
                            placeholder="Keterangan singkat tentang kegunaan surat ini...">{{ old('deskripsi', $data->deskripsi) }}</textarea>
                        @error('deskripsi')
                            <div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                        @enderror
                        <div class="field-hint">Opsional. Berikan keterangan singkat agar mudah dipahami warga.</div>
                    </div>

                </div>

                <div class="form-footer">
                    <div class="footer-left">
                        <i class="bi bi-clock-history"></i>
                        Perubahan akan langsung tersimpan
                    </div>
                    <div class="footer-right">
                        <a href="{{ route('jenis-surat.index') }}" class="btn-batal">
                            <i class="bi bi-x-lg"></i> Batal
                        </a>
                        <button type="submit" class="btn-update">
                            <i class="bi bi-check-lg"></i> Update
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>

@include('admin.partials.footer')

@endsection