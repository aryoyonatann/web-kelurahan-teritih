@extends('admin.layouts.app')

@section('title', 'Tulis Berita Baru')

@push('styles')
<link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
    body { font-family: 'Plus Jakarta Sans', sans-serif; background: #f1f5f9; }
    .form-page { padding: 0; min-height: 100vh; }

    /* ── BACK BAR ── */
    .back-bar { display: flex; align-items: center; gap: 8px; padding: 14px 32px; background: white; border-bottom: 1px solid #e2e8f0; font-size: 13px; }
    .back-btn { display: inline-flex; align-items: center; gap: 6px; color: #64748b; text-decoration: none; font-weight: 600; padding: 5px 10px; border-radius: 7px; transition: all .15s; }
    .back-btn:hover { background: #f1f5f9; color: #2563eb; }
    .bc-sep { color: #cbd5e1; }
    .bc-cur { color: #0f172a; font-weight: 600; }

    /* ── HERO — unified blue ── */
    .form-hero {
        background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%);
        padding: 28px 32px; position: relative; overflow: hidden;
    }
    .form-hero::before {
        content: ''; position: absolute; inset: 0;
        background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
    }
    .form-hero-inner { position: relative; z-index: 1; }
    .form-hero h1 { font-size: 22px; font-weight: 800; color: white; margin: 0 0 4px; }
    .form-hero p  { font-size: 13px; color: rgba(255,255,255,.75); margin: 0; }

    /* ── FULL WIDTH WRAPPER (mengikuti statistik) ── */
    .form-wrapper { padding: 28px 32px; }

    /* ── FORM CARD ── */
    .form-card { background: white; border-radius: 14px; border: 1px solid #e2e8f0; overflow: hidden; box-shadow: 0 1px 3px rgba(0,0,0,.06); margin-bottom: 16px; }
    .form-card-header { padding: 16px 24px; border-bottom: 1px solid #e2e8f0; background: #f8fafc; display: flex; align-items: center; gap: 10px; }
    .form-card-icon { width: 36px; height: 36px; border-radius: 9px; background: #eff6ff; color: #2563eb; display: flex; align-items: center; justify-content: center; font-size: 17px; }
    .form-card-title { font-size: 14px; font-weight: 700; color: #0f172a; }
    .form-card-body  { padding: 24px; }

    /* ── FIELDS ── */
    .field-group { margin-bottom: 20px; }
    .field-group:last-child { margin-bottom: 0; }
    .field-label { display: block; font-size: 12px; font-weight: 700; color: #374151; text-transform: uppercase; letter-spacing: .05em; margin-bottom: 8px; }
    .field-label span { color: #dc2626; margin-left: 2px; }
    .field-input { width: 100%; padding: 11px 14px; border: 1.5px solid #e2e8f0; border-radius: 9px; font-size: 13px; font-family: inherit; color: #0f172a; background: white; transition: all .2s; outline: none; }
    .field-input:focus { border-color: #2563eb; box-shadow: 0 0 0 3px rgba(37,99,235,.1); }
    .field-input::placeholder { color: #94a3b8; }
    textarea.field-input { resize: vertical; min-height: 200px; }
    .field-hint  { font-size: 11px; color: #94a3b8; margin-top: 5px; }
    .field-error { font-size: 12px; color: #dc2626; margin-top: 5px; display: flex; align-items: center; gap: 4px; }
    .field-input.is-error { border-color: #dc2626; }

    /* 2-col grid */
    .field-row { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; }
    @media (max-width: 600px) { .field-row { grid-template-columns: 1fr; } }

    /* select */
    select.field-input { cursor: pointer; appearance: none; -webkit-appearance: none; background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='12' height='12' viewBox='0 0 12 12'%3E%3Cpath fill='%2364748b' d='M6 8L1 3h10z'/%3E%3C/svg%3E"); background-repeat: no-repeat; background-position: right 14px center; padding-right: 36px; }

    /* kategori custom */
    #kategori-custom-wrap { margin-top: 8px; display: none; }
    #kategori-custom-wrap.show { display: block; }

    /* file upload */
    .file-upload-area { border: 2px dashed #e2e8f0; border-radius: 10px; padding: 24px; text-align: center; cursor: pointer; transition: all .2s; background: #fafafa; }
    .file-upload-area:hover { border-color: #2563eb; background: #eff6ff; }
    .file-upload-area i { font-size: 32px; color: #94a3b8; display: block; margin-bottom: 8px; }
    .file-upload-area p { font-size: 13px; color: #64748b; margin: 0; }
    .file-upload-area small { font-size: 11px; color: #94a3b8; }
    #gambarPreview { display: none; margin-top: 12px; border-radius: 8px; max-height: 220px; object-fit: cover; border: 1px solid #e2e8f0; width: 100%; }

    /* form footer */
    .form-footer { padding: 16px 24px; background: #f8fafc; border-top: 1px solid #e2e8f0; display: flex; align-items: center; justify-content: flex-end; gap: 10px; }
    .btn-batal { display: inline-flex; align-items: center; gap: 6px; padding: 9px 18px; border-radius: 9px; border: 1.5px solid #e2e8f0; background: white; font-size: 13px; font-weight: 600; color: #64748b; text-decoration: none; cursor: pointer; transition: all .15s; }
    .btn-batal:hover { background: #f8fafc; color: #334155; }
    .btn-simpan { display: inline-flex; align-items: center; gap: 6px; padding: 9px 22px; border-radius: 9px; border: none; background: #2563eb; font-size: 13px; font-weight: 700; color: white; cursor: pointer; transition: all .15s; }
    .btn-simpan:hover { background: #1d4ed8; transform: translateY(-1px); box-shadow: 0 4px 12px rgba(37,99,235,.3); }

    /* error list */
    .error-list { background: #fef2f2; border: 1px solid #fecaca; border-radius: 10px; padding: 12px 16px; margin-bottom: 20px; }
    .error-list ul { margin: 0; padding-left: 18px; }
    .error-list li { font-size: 13px; color: #dc2626; }
</style>
@endpush

@section('content')

@include('admin.partials.header')

<div class="form-page">

    <div class="back-bar">
        <a href="{{ route('informasi-admin.index') }}" class="back-btn"><i class="bi bi-arrow-left"></i> Kembali</a>
        <span class="bc-sep">/</span>
        <a href="{{ route('informasi-admin.index') }}" style="color:#64748b;text-decoration:none;font-size:13px">Berita</a>
        <span class="bc-sep">/</span>
        <span class="bc-cur">Tulis Baru</span>
    </div>

    {{-- ✅ HERO BIRU --}}
    <div class="form-hero">
        <div class="form-hero-inner">
            <h1><i class="bi bi-pencil-square me-2"></i>Tulis Berita Baru</h1>
            <p>Buat dan publikasikan berita atau informasi untuk warga</p>
        </div>
    </div>

    {{-- ✅ FULL WIDTH — tidak ada max-width --}}
    <div class="form-wrapper">

        @if($errors->any())
        <div class="error-list">
            <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
        </div>
        @endif

        <form action="{{ route('informasi-admin.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            {{-- Info Utama --}}
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-icon"><i class="bi bi-card-text"></i></div>
                    <div class="form-card-title">Informasi Berita</div>
                </div>
                <div class="form-card-body">

                    <div class="field-group">
                        <label class="field-label">Judul Berita <span>*</span></label>
                        <input type="text" name="judul"
                            class="field-input {{ $errors->has('judul') ? 'is-error' : '' }}"
                            placeholder="Masukkan judul berita yang menarik..."
                            value="{{ old('judul') }}" required>
                        @error('judul')<div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                    </div>

                    <div class="field-row">
                        <div class="field-group" style="margin-bottom:0">
                            <label class="field-label">Kategori <span>*</span></label>
                            <select id="kategori-select"
                                class="field-input {{ $errors->has('kategori') ? 'is-error' : '' }}"
                                onchange="handleKategori(this.value)">
                                <option value="" disabled {{ !old('kategori') ? 'selected' : '' }}>-- Pilih Kategori --</option>
                                <option value="Pengumuman"  {{ old('kategori') == 'Pengumuman'  ? 'selected' : '' }}>📢 Pengumuman</option>
                                <option value="Kegiatan"   {{ old('kategori') == 'Kegiatan'    ? 'selected' : '' }}>🎯 Kegiatan</option>
                                <option value="Kesehatan"  {{ old('kategori') == 'Kesehatan'   ? 'selected' : '' }}>🏥 Kesehatan</option>
                                <option value="Lingkungan" {{ old('kategori') == 'Lingkungan'  ? 'selected' : '' }}>🌿 Lingkungan</option>
                                <option value="Pelayanan"  {{ old('kategori') == 'Pelayanan'   ? 'selected' : '' }}>🏛️ Pelayanan</option>
                                <option value="Sosial"     {{ old('kategori') == 'Sosial'      ? 'selected' : '' }}>🤝 Sosial</option>
                                <option value="Pendidikan" {{ old('kategori') == 'Pendidikan'  ? 'selected' : '' }}>📚 Pendidikan</option>
                                <option value="Lainnya"    {{ (!in_array(old('kategori'), ['', 'Pengumuman','Kegiatan','Kesehatan','Lingkungan','Pelayanan','Sosial','Pendidikan']) && old('kategori')) ? 'selected' : '' }}>✏️ Lainnya...</option>
                            </select>
                            <div id="kategori-custom-wrap" class="{{ (!in_array(old('kategori'), ['', 'Pengumuman','Kegiatan','Kesehatan','Lingkungan','Pelayanan','Sosial','Pendidikan']) && old('kategori')) ? 'show' : '' }}">
                                <input type="text" id="kategori-custom"
                                    placeholder="Tulis kategori sendiri..."
                                    class="field-input"
                                    value="{{ (!in_array(old('kategori'), ['', 'Pengumuman','Kegiatan','Kesehatan','Lingkungan','Pelayanan','Sosial','Pendidikan'])) ? old('kategori') : '' }}">
                            </div>
                            <input type="hidden" name="kategori" id="kategori-value" value="{{ old('kategori') }}">
                            @error('kategori')<div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                        </div>

                        <div class="field-group" style="margin-bottom:0">
                            <label class="field-label">Status Publikasi <span>*</span></label>
                            <select name="status" class="field-input">
                                <option value="draft"   {{ old('status') == 'draft'   ? 'selected' : '' }}>📝 Draft</option>
                                <option value="publish" {{ old('status') == 'publish' ? 'selected' : '' }}>🟢 Publish</option>
                            </select>
                        </div>
                    </div>

                </div>
            </div>

            {{-- Isi Berita --}}
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-icon"><i class="bi bi-body-text"></i></div>
                    <div class="form-card-title">Isi Berita</div>
                </div>
                <div class="form-card-body">
                    <div class="field-group" style="margin-bottom:0">
                        <label class="field-label">Konten <span>*</span></label>
                        <textarea name="isi"
                            class="field-input {{ $errors->has('isi') ? 'is-error' : '' }}"
                            placeholder="Tulis isi berita di sini..." required>{{ old('isi') }}</textarea>
                        @error('isi')<div class="field-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
                        <div class="field-hint">Tulis konten berita secara lengkap dan informatif.</div>
                    </div>
                </div>
            </div>

            {{-- Gambar --}}
            <div class="form-card">
                <div class="form-card-header">
                    <div class="form-card-icon"><i class="bi bi-image"></i></div>
                    <div class="form-card-title">Gambar Berita</div>
                </div>
                <div class="form-card-body">
                    <div class="file-upload-area" onclick="document.getElementById('gambarInput').click()">
                        <i class="bi bi-cloud-upload"></i>
                        <p><strong>Klik untuk upload</strong> atau seret gambar ke sini</p>
                        <small>PNG, JPG, JPEG — Maks. 2MB</small>
                        <img id="gambarPreview" src="" alt="Preview">
                    </div>
                    <input type="file" name="gambar" id="gambarInput" accept="image/*" style="display:none" onchange="previewGambar(this)">
                    <div class="field-hint mt-2">Opsional. Gambar akan ditampilkan sebagai thumbnail berita.</div>
                </div>

                <div class="form-footer">
                    <a href="{{ route('informasi-admin.index') }}" class="btn-batal"><i class="bi bi-x-lg"></i> Batal</a>
                    <button type="submit" class="btn-simpan"><i class="bi bi-check-lg"></i> Simpan & Publikasi</button>
                </div>
            </div>

        </form>
    </div>
</div>

@include('admin.partials.footer')

@endsection

@push('scripts')
<script>
function handleKategori(val) {
    var customWrap  = document.getElementById('kategori-custom-wrap');
    var customInput = document.getElementById('kategori-custom');
    var hiddenInput = document.getElementById('kategori-value');
    if (val === 'Lainnya') {
        customWrap.classList.add('show');
        customInput.focus();
        hiddenInput.value = '';
    } else {
        customWrap.classList.remove('show');
        customInput.value  = '';
        hiddenInput.value  = val;
    }
}
document.getElementById('kategori-custom').addEventListener('input', function () {
    document.getElementById('kategori-value').value = this.value;
});
(function () {
    var select = document.getElementById('kategori-select');
    if (select.value && select.value !== 'Lainnya') {
        document.getElementById('kategori-value').value = select.value;
    }
})();
function previewGambar(input) {
    if (input.files && input.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            const preview = document.getElementById('gambarPreview');
            preview.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(input.files[0]);
    }
}
</script>
@endpush