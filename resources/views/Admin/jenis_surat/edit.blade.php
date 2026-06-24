@extends('admin.layouts.app')
@section('title', 'Edit Jenis Surat')

@push('styles')
<style>

.page-layout {
    display: grid;
    grid-template-columns: 1fr 500px;
    gap: 20px;
    padding: 20px 24px;
    align-items: start;
    max-width: 1500px;
    margin: 0 auto;
}
.form-col { min-width: 0; }
.preview-col { position: sticky; top: 72px; }

@media (max-width: 1200px) {
    .page-layout { grid-template-columns: 1fr; }
    .preview-col { display: none; }
}

.page-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
}
.back-link {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #64748b;
    text-decoration: none;
}
.edit-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    padding: 4px 12px;
    border-radius: 20px;
    background: #fffbeb;
    border: 1px solid #fde68a;
    color: #92400e;
    font-size: 11px;
    font-weight: 600;
}
.page-title {
    font-size: 20px;
    font-weight: 800;
    color: #0f172a;
    margin: 0 0 4px;
}
.page-subtitle {
    font-size: 13px;
    color: #64748b;
    margin: 0;
}

.steps {
    display: flex;
    align-items: center;
    margin-bottom: 32px;
    gap: 0;
}
.step-item {
    display: flex;
    flex-direction: column;
    align-items: center;
    flex: 1;
    position: relative;
}
.step-item:not(:last-child)::after {
    content: '';
    position: absolute;
    top: 20px;
    left: 60%;
    width: 80%;
    height: 2px;
    background: #e2e8f0;
    z-index: 0;
}
.step-item.done::after { background: #1c64f2; }
.step-circle {
    width: 40px;
    height: 40px;
    border-radius: 50%;
    border: 2px solid #e2e8f0;
    background: white;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 15px;
    font-weight: 700;
    color: #94a3b8;
    position: relative;
    z-index: 1;
    transition: all .25s;
}
.step-item.active .step-circle {
    border-color: #1c64f2;
    background: #1c64f2;
    color: white;
    box-shadow: 0 0 0 4px rgba(28, 100, 242, .15);
}
.step-item.done .step-circle {
    border-color: #10b981;
    background: #10b981;
    color: white;
}
.step-label {
    font-size: 11px;
    font-weight: 600;
    color: #94a3b8;
    margin-top: 6px;
    text-align: center;
    white-space: nowrap;
}
.step-item.active .step-label { color: #1c64f2; }
.step-item.done .step-label { color: #10b981; }

.step-panel { display: none; }
.step-panel.active { display: block; }

.wcard {
    background: white;
    border: 1px solid #e2e8f0;
    border-radius: 16px;
    overflow: hidden;
    margin-bottom: 16px;
}
.wcard-head {
    padding: 16px 20px;
    border-bottom: 1px solid #e2e8f0;
    display: flex;
    align-items: center;
    gap: 10px;
}
.wcard-icon {
    width: 36px;
    height: 36px;
    border-radius: 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 17px;
    flex-shrink: 0;
}
.wcard-title { font-size: 15px; font-weight: 700; color: #0f172a; }
.wcard-sub { font-size: 12px; color: #64748b; margin-top: 1px; }
.wcard-body { padding: 20px; }

.fl {
    display: block;
    font-size: 12px;
    font-weight: 600;
    color: #374151;
    margin-bottom: 6px;
}
.fl .req { color: #dc2626; }
.fl .opt { color: #94a3b8; font-weight: 400; }
.fi {
    width: 100%;
    padding: 10px 14px;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    font-size: 14px;
    font-family: inherit;
    color: #0f172a;
    outline: none;
    transition: all .15s;
    background: white;
    box-sizing: border-box;
}
.fi:focus {
    border-color: #1c64f2;
    box-shadow: 0 0 0 3px rgba(28, 100, 242, .08);
}
textarea.fi { resize: vertical; min-height: 90px; }
.hint {
    font-size: 11px;
    color: #94a3b8;
    margin-top: 4px;
    line-height: 1.5;
}
.error-box {
    background: #fef2f2;
    border: 1px solid #fecaca;
    border-radius: 10px;
    padding: 12px 16px;
    margin-bottom: 16px;
    font-size: 13px;
    color: #991b1b;
}
.error-box ul { margin: 0; padding-left: 16px; }

.check-grid {
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    gap: 8px;
}
.check-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    border: 1.5px solid #e2e8f0;
    border-radius: 10px;
    cursor: pointer;
    transition: all .15s;
    user-select: none;
}
.check-item:hover { background: #f8fafc; border-color: #bfdbfe; }
.check-item input[type=checkbox] { width: 16px; height: 16px; accent-color: #1c64f2; flex-shrink: 0; }
.check-item span { font-size: 13px; font-weight: 500; color: #334155; }
.check-item:has(input:checked) { border-color: #bfdbfe; background: #eff6ff; }
.check-item:has(input:checked) span { color: #1c64f2; font-weight: 600; }
@media (max-width: 600px) { .check-grid { grid-template-columns: 1fr; } }

.preset-grid { display: flex; flex-wrap: wrap; gap: 8px; }
.preset-tag {
    display: inline-flex;
    align-items: center;
    gap: 5px;
    padding: 8px 14px;
    border-radius: 22px;
    border: 1.5px solid #e2e8f0;
    background: white;
    color: #334155;
    font-size: 13px;
    font-weight: 600;
    cursor: pointer;
    transition: all .18s;
    font-family: inherit;
}
.preset-tag:hover { border-color: #93c5fd; background: #eff6ff; color: #1c64f2; }
.preset-tag.used { border-color: #a7f3d0; background: #ecfdf5; color: #059669; pointer-events: none; }
.preset-tag i { font-size: 11px; }

.field-list { display: flex; flex-direction: column; gap: 8px; margin-bottom: 8px; }
.field-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 10px 14px;
    background: #f8fafc;
    border: 1px solid #e2e8f0;
    border-radius: 10px;
    font-size: 13px;
}
.field-item--section { background: #f0fdf4; border-color: #bbf7d0; }
.field-item--bold { background: #faf5ff; border-color: #e9d5ff; }
.field-item-icon {
    width: 28px; height: 28px; border-radius: 7px;
    background: #eff6ff; color: #1c64f2;
    display: flex; align-items: center; justify-content: center;
    font-size: 13px; flex-shrink: 0;
}
.field-item-icon--section { background: #dcfce7; color: #16a34a; }
.field-item-icon--bold { background: #f3e8ff; color: #7c3aed; }
.field-item-label { flex: 1; font-weight: 600; color: #0f172a; }
.field-item-label--section { color: #15803d; font-style: italic; }
.field-item-label--bold { color: #6d28d9; font-weight: 700; }
.field-item-type {
    font-size: 11px; color: #94a3b8; background: #f1f5f9;
    border-radius: 5px; padding: 2px 8px;
}
.field-item-type--section { background: #dcfce7; color: #16a34a; }
.field-item-type--bold { background: #f3e8ff; color: #7c3aed; }
.field-item-rm {
    width: 26px; height: 26px; border-radius: 6px;
    border: 1px solid #fecaca; background: #fef2f2; color: #dc2626;
    cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 13px;
}

.wizard-nav {
    display: flex; justify-content: space-between; align-items: center;
    margin-top: 24px; gap: 12px;
}
.btn-back {
    padding: 11px 24px; border-radius: 10px; border: 1.5px solid #e2e8f0;
    background: white; font-size: 14px; font-weight: 600; color: #334155;
    cursor: pointer; font-family: inherit; transition: all .15s;
}
.btn-back:hover { border-color: #cbd5e1; background: #f8fafc; }
.btn-next {
    padding: 11px 28px; border-radius: 10px; border: none;
    background: #1c64f2; font-size: 14px; font-weight: 700; color: white;
    cursor: pointer; font-family: inherit; transition: background .15s;
    display: flex; align-items: center; gap: 8px;
}
.btn-next:hover { background: #1a56db; }
.btn-submit-final {
    padding: 13px 32px; border-radius: 10px; border: none;
    background: linear-gradient(135deg, #0d1b3e, #1c64f2);
    font-size: 14px; font-weight: 700; color: white;
    cursor: pointer; font-family: inherit; display: flex; align-items: center; gap: 8px;
}
.btn-submit-final:hover { opacity: .92; }
.btn-add-field {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 14px; border-radius: 8px;
    font-size: 12px; font-weight: 600; cursor: pointer; font-family: inherit; margin-top: 4px;
}
.btn-add-field--custom { border: 1.5px dashed #93c5fd; background: #f0f9ff; color: #0284c7; }
.btn-add-field--section { border: 1.5px dashed #bbf7d0; background: #f0fdf4; color: #16a34a; margin-left: 6px; }
.btn-add-field--bold { border: 1.5px dashed #e9d5ff; background: #faf5ff; color: #7c3aed; padding: 9px 16px; font-size: 13px; }

.icon-grid { display: grid; grid-template-columns: repeat(6, 1fr); gap: 8px; }
.icon-opt {
    padding: 12px; border: 2px solid #e2e8f0; border-radius: 10px;
    font-size: 22px; transition: all .15s; text-align: center;
}

.info-placeholder {
    background: #eff6ff; border: 1px solid #bfdbfe; border-radius: 10px;
    padding: 12px 16px; margin-bottom: 16px; font-size: 12px; color: #1e40af; line-height: 1.7;
}
.info-placeholder code { background: #dbeafe; padding: 1px 5px; border-radius: 4px; }
.info-order {
    background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 10px;
    padding: 14px; margin-bottom: 16px; font-size: 12px; color: #334155; line-height: 1.8;
}
.info-order-title {
    font-size: 11px; font-weight: 700; color: #64748b;
    text-transform: uppercase; letter-spacing: .05em; margin-bottom: 8px;
}
.info-order-table {
    border: 1px dashed #cbd5e1; border-radius: 6px;
    padding: 6px 12px; margin: 4px 0; font-size: 12px; color: #94a3b8;
}
.special-section { margin-top: 16px; padding-top: 16px; border-top: 1px dashed #e2e8f0; }

.preview-panel {
    background: white; border: 1px solid #e2e8f0; border-radius: 14px; overflow: hidden;
}
.preview-panel-head {
    padding: 12px 16px; border-bottom: 1px solid #e2e8f0;
    display: flex; align-items: center; gap: 8px; background: #f8fafc;
}
.preview-panel-head span {
    font-size: 12px; font-weight: 700; color: #64748b;
    text-transform: uppercase; letter-spacing: .06em;
}
.preview-live-dot {
    width: 8px; height: 8px; border-radius: 50%;
    background: #22c55e; box-shadow: 0 0 0 3px rgba(34,197,94,.2);
    animation: blink 1.4s infinite;
}
@keyframes blink { 0%,100%{opacity:1} 50%{opacity:.4} }
.preview-scroll {
    max-height: calc(100vh - 160px); overflow-y: auto; overflow-x: hidden;
    padding: 16px; background: #f1f5f9;
}
.preview-scroll::-webkit-scrollbar { width: 4px; }
.preview-scroll::-webkit-scrollbar-thumb { background: #e2e8f0; border-radius: 4px; }

#suratPreviewWrap { width: calc(210mm * 0.625); min-height: 200px; }
.surat-preview {
    background: white; box-shadow: 0 2px 12px rgba(0,0,0,.15);
    transform-origin: top left;
    font-family: 'Times New Roman', Times, serif;
    color: black; font-size: 12pt; line-height: 1.5;
    padding: 14mm 16mm 12mm 18mm;
    width: 210mm; transform: scale(0.625);
    margin-bottom: calc(210mm * 0.625 - 210mm);
}
.sp-kop { display: flex; align-items: center; gap: 8px; padding-bottom: 5px; border-bottom: 3px double black; margin-bottom: 8px; }
.sp-kop img { width: 70px; height: auto; }
.sp-kop-teks { text-align: center; flex: 1; line-height: 1.2; }
.sp-kop-teks .k1, .sp-kop-teks .k2, .sp-kop-teks .k3 { font-size: 15pt; font-weight: bold; }
.sp-kop-teks .k4 { font-size: 9pt; font-style: italic; }
.sp-judul { text-align: center; font-size: 13pt; font-weight: bold; text-decoration: underline; text-transform: uppercase; letter-spacing: .06em; margin: 8px 0 3px; }
.sp-nomor { text-align: center; font-size: 10pt; margin-bottom: 6px; color: #444; }
.sp-pembuka { text-align: justify; margin-bottom: 6px; text-indent: 28px; font-size: 11pt; }
.sp-bio { width: 100%; border-collapse: collapse; margin-bottom: 6px; }
.sp-bio td { padding: 1.5px 0; vertical-align: top; font-size: 11pt; }
.sp-bio td:first-child { width: 130px; }
.sp-bio td:nth-child(2) { width: 12px; padding: 0 5px; }
.sp-placeholder { color: #94a3b8; font-style: italic; }
.sp-isi { text-align: justify; font-size: 11pt; margin: 6px 0; white-space: pre-wrap; text-indent: 28px; }
.sp-penutup { text-align: justify; font-size: 11pt; margin: 6px 0; }
.sp-ttd { display: flex; justify-content: flex-end; margin-top: 14px; font-size: 11pt; }
.sp-ttd-box { text-align: center; min-width: 160px; }
.sp-ttd-ruang { height: 55px; }
.sp-ttd-nama { font-weight: bold; text-decoration: underline; font-size: 11pt; }
.sp-ttd-nip { font-size: 10pt; }

.modal-overlay {
    display: none; position: fixed; inset: 0;
    background: rgba(0,0,0,.45); z-index: 9999;
    align-items: center; justify-content: center;
}
.modal-box {
    background: white; border-radius: 16px; padding: 28px 28px 24px;
    width: 420px; max-width: 95vw; box-shadow: 0 20px 60px rgba(0,0,0,.2);
}
.modal-title { font-size: 15px; font-weight: 700; color: #0d1b3e; margin-bottom: 16px; display: flex; align-items: center; gap: 8px; }
.modal-desc { font-size: 12px; color: #64748b; margin-bottom: 18px; }
.modal-field { margin-bottom: 20px; }
.modal-input {
    width: 100%; padding: 10px 12px; border: 1.5px solid #d1d5db; border-radius: 8px;
    font-size: 13px; font-family: inherit; box-sizing: border-box; outline: none; transition: border-color .15s;
}
.modal-input:focus { border-color: #1c64f2; }
.modal-hint { font-size: 11px; color: #64748b; margin-top: 8px; background: #f8fafc; border-radius: 6px; padding: 7px 10px; }
.modal-actions { display: flex; justify-content: flex-end; gap: 8px; }
.modal-btn { padding: 9px 18px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; font-family: inherit; }
.modal-btn--cancel { border: 1.5px solid #e2e8f0; background: white; color: #64748b; }
.modal-btn--ok { border: none; color: white; }
</style>
@endpush

@php
    $fieldsConfig = $data->fields_config ?? [];
    if (is_string($fieldsConfig)) $fieldsConfig = json_decode($fieldsConfig, true) ?? [];

    $bioKeys         = collect($fieldsConfig)->where('group', 'biodata')->where('type', '!=', 'section')->pluck('key')->toArray();
    $extraFields     = collect($fieldsConfig)->where('group', 'extra')->values()->toArray();
    $bioSectionLabel = collect($fieldsConfig)->where('key', 'section_ektp')->first()['print_label'] ?? '';
@endphp

@section('content')
<div class="page-layout">

    
    <div class="form-col">
        <div class="wizard-wrap">

            {{-- Header --}}
            <div class="page-header">
                <a href="{{ route('jenis-surat.index') }}" class="back-link">
                    <i class="bi bi-arrow-left"></i> Kembali ke Daftar Surat
                </a>
                <div class="edit-badge"><i class="bi bi-pencil-square"></i> Mode Edit</div>
            </div>

            <div style="margin-bottom:24px">
                <h2 class="page-title">{{ $data->nama_surat }}</h2>
                <p class="page-subtitle">Sesuaikan isi surat ini sesuka hati 👋</p>
            </div>

            {{-- Step Indicator --}}
            <div class="steps">
                <div class="step-item active" id="si1">
                    <div class="step-circle">1</div>
                    <div class="step-label">Info Surat</div>
                </div>
                <div class="step-item" id="si2">
                    <div class="step-circle">2</div>
                    <div class="step-label">Data Warga</div>
                </div>
                <div class="step-item" id="si3">
                    <div class="step-circle">3</div>
                    <div class="step-label">Kalimat Surat</div>
                </div>
            </div>

            {{-- Validation Errors --}}
            @if($errors->any())
                <div class="error-box">
                    <ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
                </div>
            @endif

            <form method="POST" action="{{ route('jenis-surat.update', $data->id_jenis_surat) }}" id="suratForm">
                @csrf
                @method('PUT')

                
                <div class="step-panel active" id="step1">
                    
                    <div class="wcard">
                        <div class="wcard-head">
                            <div class="wcard-icon" style="background:#eff6ff;color:#1c64f2"><i class="bi bi-file-earmark-text-fill"></i></div>
                            <div>
                                <div class="wcard-title">Tentang Surat Ini</div>
                            </div>
                        </div>
                        <div class="wcard-body">
                            <div class="row g-3">
                                <div class="col-12">
                                    <input type="text" name="nama_surat" id="namaSurat" class="fi"
                                           value="{{ old('nama_surat', $data->nama_surat) }}"
                                           placeholder="Tulis nama suratnya, misal: Surat Keterangan Tidak Mampu" required
                                           oninput="renderPreview()">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kode_klasifikasi" id="inp_kode_klas" class="fi"
                                           value="{{ old('kode_klasifikasi', $data->kode_klasifikasi) }}"
                                           placeholder="Kode klasifikasi, misal: 470" required oninput="renderPreview()">
                                    <div class="hint">Angka yang muncul di depan nomor surat</div>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="kode_surat" id="inp_kode_surat" class="fi"
                                           value="{{ old('kode_surat', $data->kode_surat) }}"
                                           placeholder="Kode surat, misal: SK" required oninput="renderPreview()">
                                </div>
                                <div class="col-md-4">
                                    <input type="text" name="deskripsi" class="fi"
                                           value="{{ old('deskripsi', $data->deskripsi) }}"
                                           placeholder="Deskripsi singkat (boleh dikosongkan)">
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <div class="wcard">
                        <div class="wcard-head">
                            <div class="wcard-icon" style="background:#fdf4ff;color:#a855f7"><i class="bi bi-palette-fill"></i></div>
                            <div>
                                <div class="wcard-title">Pilih Ikon</div>
                            </div>
                        </div>
                        <div class="wcard-body">
                            <input type="hidden" name="icon" id="icon_hidden" value="{{ old('icon', $data->icon) }}">
                            <input type="hidden" name="warna" id="warna_hidden" value="{{ old('warna', $data->warna) }}">
                            <div class="icon-grid">
                                @php
                                    $icons = [
                                        ['bi-file-earmark-text','#1c64f2'], ['bi-people-fill','#ec4899'],
                                        ['bi-heart-pulse-fill','#ef4444'], ['bi-building','#0891b2'],
                                        ['bi-briefcase-fill','#f59e0b'], ['bi-calendar-check','#0891b2'],
                                        ['bi-house-fill','#10b981'], ['bi-person-badge-fill','#6366f1'],
                                        ['bi-file-earmark-medical','#6b7280'], ['bi-stars','#f59e0b'],
                                        ['bi-shield-check','#10b981'], ['bi-bank2','#1c64f2'],
                                    ];
                                @endphp
                                @foreach($icons as [$ic,$cl])
                                    <label style="cursor:pointer;text-align:center">
                                        <input type="radio" name="_icon_pick" value="{{ $ic }}" style="display:none"
                                               onchange="setIcon('{{ $ic }}','{{ $cl }}')"
                                               {{ old('icon',$data->icon)===$ic ? 'checked' : '' }}>
                                        <div class="icon-opt" data-icon="{{ $ic }}" style="color:{{ $cl }}">
                                            <i class="bi {{ $ic }}"></i>
                                        </div>
                                    </label>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="wizard-nav">
                        <span></span>
                        <button type="button" class="btn-next" onclick="goStep(2)">Selanjutnya <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>

                
                <div class="step-panel" id="step2">
                    
                    <div class="wcard">
                        <div class="wcard-head">
                            <div class="wcard-icon" style="background:#ecfdf5;color:#10b981"><i class="bi bi-person-lines-fill"></i></div>
                            <div>
                                <div class="wcard-title">Data Warga yang Dibutuhkan</div>
                            </div>
                        </div>
                        <div class="wcard-body">
                            <input type="hidden" name="bio_section_label" value="{{ old('bio_section_label', $bioSectionLabel) }}">
                            <div class="check-grid">
                                @foreach($standardFields as $sf)
                                    <label class="check-item">
                                        <input type="checkbox" class="bio-cb" value="{{ $sf['key'] }}"
                                               data-label="{{ $sf['print_label'] }}"
                                               {{ in_array($sf['key'], old('bio_fields', $bioKeys)) ? 'checked' : '' }}
                                               onchange="toggleBioField(this)">
                                        <span>{{ $sf['print_label'] }}</span>
                                    </label>
                                @endforeach
                            </div>
                            <div id="bioFieldsHidden"></div>
                        </div>
                    </div>

                    
                    <div class="wcard">
                        <div class="wcard-head">
                            <div class="wcard-icon" style="background:#fffbeb;color:#f59e0b"><i class="bi bi-plus-circle-fill"></i></div>
                            <div>
                                <div class="wcard-title">Butuh Data Lain?</div>
                            </div>
                        </div>
                        <div class="wcard-body">
                            @php
                                $presets = [
                                    ['key'=>'keperluan','label'=>'Keperluan Surat','type'=>'text','req'=>true,'print'=>true],
                                    ['key'=>'tujuan','label'=>'Tujuan Penggunaan','type'=>'text','req'=>true,'print'=>true],
                                    ['key'=>'nama_instansi','label'=>'Nama Instansi / Perusahaan','type'=>'text','req'=>true,'print'=>true],
                                    ['key'=>'tahun_menikah','label'=>'Tahun Menikah','type'=>'text','req'=>true,'print'=>true],
                                    ['key'=>'hari_meninggal','label'=>'Hari Meninggal','type'=>'text','req'=>true,'print'=>true],
                                    ['key'=>'tanggal_meninggal','label'=>'Tanggal Meninggal','type'=>'date','req'=>true,'print'=>true],
                                    ['key'=>'tempat_meninggal','label'=>'Tempat Meninggal','type'=>'text','req'=>true,'print'=>true],
                                    ['key'=>'sebab_meninggal','label'=>'Sebab Meninggal','type'=>'text','req'=>true,'print'=>true],
                                    ['key'=>'nama_usaha','label'=>'Nama Usaha','type'=>'text','req'=>true,'print'=>true],
                                    ['key'=>'jenis_usaha','label'=>'Jenis Usaha','type'=>'text','req'=>true,'print'=>true],
                                    ['key'=>'tanggal_cuti','label'=>'Tanggal Cuti','type'=>'text','req'=>true,'print'=>true],
                                    ['key'=>'lama_cuti','label'=>'Lama Cuti (hari)','type'=>'text','req'=>true,'print'=>true],
                                    ['key'=>'alasan_cuti','label'=>'Alasan Cuti','type'=>'textarea','req'=>true,'print'=>true],
                                    ['key'=>'keterangan','label'=>'Keterangan Tambahan','type'=>'textarea','req'=>false,'print'=>true],
                                ];
                            @endphp
                            <div class="preset-grid mb-3">
                                @foreach($presets as $preset)
                                    <button type="button" class="preset-tag" data-key="{{ $preset['key'] }}"
                                            onclick="addPreset({{ json_encode($preset) }})">
                                        <i class="bi bi-plus-lg"></i> {{ $preset['label'] }}
                                    </button>
                                @endforeach
                            </div>
                            <div id="addedFields" class="field-list"></div>
                            <div id="extraFieldsHidden"></div>
                            <button type="button" class="btn-add-field btn-add-field--custom" onclick="addCustomField()">
                                <i class="bi bi-pencil-square"></i> Tambah Field Lainnya
                            </button>
                            <button type="button" class="btn-add-field btn-add-field--section" onclick="addSectionSeparator()">
                                <i class="bi bi-text-left"></i> Tambah Teks Pemisah
                            </button>
                        </div>
                    </div>

                    <div class="wizard-nav">
                        <button type="button" class="btn-back" onclick="goStep(1)"><i class="bi bi-arrow-left"></i> Kembali</button>
                        <button type="button" class="btn-next" onclick="goStep(3)">Selanjutnya <i class="bi bi-arrow-right"></i></button>
                    </div>
                </div>

                
                <div class="step-panel" id="step3">
                    <div class="wcard">
                        <div class="wcard-head">
                            <div class="wcard-icon" style="background:#eff6ff;color:#1c64f2"><i class="bi bi-chat-quote-fill"></i></div>
                            <div>
                                <div class="wcard-title">Isi Kalimat Surat</div>
                            </div>
                        </div>
                        <div class="wcard-body">

                            <div class="mb-3">
                                <textarea name="template_pembuka" id="inp_pembuka" class="fi" rows="3"
                                          placeholder="Tulis kalimat pembuka surat di sini..."
                                          required oninput="renderPreview()">{{ old('template_pembuka', $data->template_pembuka) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <textarea name="template_isi" id="inp_isi" class="fi" rows="4"
                                          placeholder="Tulis kalimat isi/keterangan di sini (boleh dikosongkan)..."
                                          oninput="renderPreview()">{{ old('template_isi', $data->template_isi) }}</textarea>
                            </div>

                            <div class="mb-3">
                                <textarea name="template_penutup" id="inp_penutup" class="fi" rows="2"
                                          placeholder="Tulis kalimat penutup surat di sini..."
                                          required oninput="renderPreview()">{{ old('template_penutup', $data->template_penutup) }}</textarea>
                            </div>

                            
                            <div class="special-section">
                                <button type="button" class="btn-add-field btn-add-field--bold" onclick="openCBModal()">
                                    <i class="bi bi-type-bold"></i> Tambah Baris Bold + Center
                                </button>
                                <div class="hint" style="margin-top:6px">
                                    Contoh hasil: <em style="font-weight:bold;text-decoration:underline">Surat Keterangan ini dipergunakan untuk Persyaratan Bansos Tahun 2027</em>
                                </div>
                                <div id="centerBoldList" class="field-list" style="margin-top:10px"></div>
                            </div>
                        </div>
                    </div>

                    <div class="wizard-nav">
                        <button type="button" class="btn-back" onclick="goStep(2)"><i class="bi bi-arrow-left"></i> Kembali</button>
                        <button type="submit" class="btn-submit-final"><i class="bi bi-check-circle-fill"></i> Simpan Perubahan</button>
                    </div>
                </div>

            </form>
        </div>
    </div>

    
    <div class="preview-col">
        <div class="preview-panel">
            <div class="preview-panel-head">
                <div class="preview-live-dot"></div>
                <span>Preview Surat Realtime</span>
            </div>
            <div class="preview-scroll">
                <div id="suratPreviewWrap">
                    <div class="surat-preview" id="suratPreview">
                        <div class="sp-kop">
                            <img src="{{ asset('images/lambang_kota_serang.jpg') }}" onerror="this.style.display='none'" alt="Logo">
                            <div class="sp-kop-teks">
                                <div class="k1">PEMERINTAH KOTA SERANG</div>
                                <div class="k2">KECAMATAN WALANTAKA</div>
                                <div class="k3">KELURAHAN TERITIH</div>
                                <div class="k4">Jl. Raya Teritih, Kecamatan Walantaka, Kota Serang, Banten 42183</div>
                            </div>
                        </div>
                        <div class="sp-judul" id="pv_judul">{{ strtoupper($data->nama_surat) }}</div>
                        <div class="sp-nomor">Nomor: <span id="pv_nomor">{{ $data->kode_klasifikasi }} / ___ / Kel.1010/{{ $data->kode_surat }}/ VI /2026</span></div>
                        <p class="sp-pembuka" id="pv_pembuka">{{ $data->template_pembuka }}</p>
                        <table class="sp-bio" id="pv_bio"></table>
                        <div id="pv_extra"></div>
                        <p class="sp-isi" id="pv_isi" style="{{ $data->template_isi ? '' : 'display:none' }}">{{ $data->template_isi }}</p>
                        <div id="pv_center_bold"></div>
                        <p class="sp-penutup" id="pv_penutup">{{ $data->template_penutup }}</p>
                        <div class="sp-ttd">
                            <div class="sp-ttd-box">
                                <p>Teritih, __ Juni 2026</p>
                                <p>An. Kepala Kelurahan Teritih</p>
                                <div class="sp-ttd-ruang"></div>
                                <p class="sp-ttd-nama">( Nama Pejabat )</p>
                                <p class="sp-ttd-nip">NIP. ________________</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<div id="cbModal" class="modal-overlay">
    <div class="modal-box">
        <div class="modal-title" style="margin-bottom:6px">
            <i class="bi bi-type-bold" style="color:#7c3aed"></i> Tambah Baris Khusus
        </div>
        <div class="modal-desc">Tulis awalan kalimatnya — nanti warga yang melengkapi</div>
        <div class="modal-field">
            <input id="cbModalTmpl" type="text" class="modal-input"
                   placeholder="Misal: Surat Keterangan ini dipergunakan untuk"
                   onkeydown="if(event.key==='Enter'){event.preventDefault();submitCBModal()}">
            <div class="modal-hint">
                Di form warga muncul field <strong>"Keperluan Surat"</strong>.<br>
                Di surat cetak: <em style="font-weight:600">[teks di atas]</em> <u>jawaban warga</u>
            </div>
        </div>
        <div class="modal-actions">
            <button type="button" class="modal-btn modal-btn--cancel" onclick="closeCBModal()">Batal</button>
            <button type="button" class="modal-btn modal-btn--ok" style="background:#7c3aed" onclick="submitCBModal()">Tambah</button>
        </div>
    </div>
</div>

<div id="inputModal" class="modal-overlay" onclick="if(event.target===this)closeInputModal()">
    <div class="modal-box">
        <div class="modal-title">
            <i class="im-icon bi bi-plus-circle" style="font-size:18px"></i>
            <span class="im-title">Tambah Field</span>
        </div>
        <div class="modal-field">
            <label class="im-label fl" style="display:none"></label>
            <input class="im-input modal-input" type="text"
                   onkeydown="if(event.key==='Enter'){event.preventDefault();submitInputModal()}">
        </div>
        <div class="modal-actions">
            <button type="button" class="modal-btn modal-btn--cancel" onclick="closeInputModal()">Batal</button>
            <button type="button" class="modal-btn modal-btn--ok im-btn-ok" style="background:#1c64f2" onclick="submitInputModal()">Tambah</button>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    'use strict';

    
    let extraCount  = 0;
    let currentStep = 1;
    const bioOrder  = [];
    const pvExtra   = [];

    const TYPE_LABELS = { text:'Teks', textarea:'Teks Panjang', date:'Tanggal', section:'Pemisah' };

    const BIO_LABELS = {
        nama:'N a m a', nik:'N I K', tempat_tgl_lahir:'Tempat / Tgl Lahir',
        umur:'Umur', jenis_kelamin:'Jenis Kelamin', agama:'Bangsa / Agama',
        status_kawin:'Status Perkawinan', kewarganegaraan:'Kewarganegaraan',
        pekerjaan:'Pekerjaan', pendidikan:'Pendidikan', alamat:'Alamat',
        rt_rw:'RT / RW', kelurahan:'Kelurahan', kecamatan:'Kecamatan', no_hp:'No. HP'
    };

    

    window.goStep = function(n) {
        if (n > currentStep && !validateStep(currentStep)) return;

        document.getElementById('step' + currentStep).classList.remove('active');
        document.getElementById('si' + currentStep).classList.remove('active');

        if (n < currentStep) {
            document.getElementById('si' + currentStep).classList.remove('done');
        } else {
            document.getElementById('si' + currentStep).classList.add('done');
        }

        currentStep = n;
        document.getElementById('step' + n).classList.add('active');
        document.getElementById('si' + n).classList.add('active');
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    function validateStep(n) {
        if (n === 1) {
            var nama = document.getElementById('namaSurat').value.trim();
            if (!nama) {
                showAlert('Nama surat wajib diisi.', 'warning');
                document.getElementById('namaSurat').focus();
                return false;
            }
        }
        return true;
    }

    

    window.setIcon = function(icon, color) {
        document.getElementById('icon_hidden').value  = icon;
        document.getElementById('warna_hidden').value = color;
        document.querySelectorAll('.icon-opt').forEach(function(el) {
            var isActive = el.dataset.icon === icon;
            el.style.borderColor = isActive ? color : '#e2e8f0';
            el.style.background  = isActive ? 'rgba(28,100,242,.06)' : 'white';
        });
    };

    

    window.toggleBioField = function(cb) {
        var key = cb.value;
        if (cb.checked) {
            bioOrder.push({ key: key, label: cb.dataset.label });
        } else {
            var idx = bioOrder.findIndex(function(b) { return b.key === key; });
            if (idx !== -1) bioOrder.splice(idx, 1);
        }
        syncBioHidden();
        renderPreview();
    };

    function syncBioHidden() {
        var wrap = document.getElementById('bioFieldsHidden');
        wrap.innerHTML = bioOrder.map(function(b) {
            return '<input type="hidden" name="bio_fields[]" value="' + b.key + '">';
        }).join('');
    }

    

    window.addPreset = function(preset) {
        var btn = document.querySelector('[data-key="' + preset.key + '"]');
        if (btn && btn.classList.contains('used')) return;
        if (btn) btn.classList.add('used');
        renderField(preset.key, preset.label, preset.type, preset.req, preset.print);
    };

    window.addCustomField = function() {
        openInputModal('bi-plus-circle', '#1c64f2', 'Tambah Field Data',
            'Nama data yang diminta dari warga', 'Contoh: Nama Tempat Bekerja',
            function(label) {
                if (!label) return;
                var key = label.toLowerCase().replace(/\s+/g, '_').replace(/[^a-z0-9_]/g, '') || ('field_' + Date.now());
                renderField(key, label, 'text', true, true);
            });
    };

    window.addSectionSeparator = function() {
        openInputModal('bi-dash-lg', '#64748b', 'Tambah Teks Pemisah',
            'Teks pemisah/judul kelompok data', 'Contoh: Telah meninggal dunia pada:',
            function(label) {
                if (!label) return;
                renderField('section_' + Date.now(), label, 'section', false, true, null);
            });
    };

    /**
     * Render a field item in the UI and create hidden form inputs.
     */
    function renderField(key, label, type, req, onPrint, printStyle, templateText) {
        var i            = extraCount++;
        var isCenterBold = printStyle === 'center_bold';
        var isSection    = type === 'section';
        var displayLabel = isCenterBold ? 'Bold Center' : (TYPE_LABELS[type] || 'Teks');
        var mod          = isSection ? '--section' : (isCenterBold ? '--bold' : '');

        // Build visible field item
        var item = document.createElement('div');
        item.className = 'field-item' + (mod ? ' field-item' + mod : '');
        item.id = 'fi_' + i;

        var iconClass = isSection ? 'text-left' : (isCenterBold ? 'type-bold' : 'input-cursor-text');
        item.innerHTML =
            '<div class="field-item-icon' + (mod ? ' field-item-icon' + mod : '') + '">' +
                '<i class="bi bi-' + iconClass + '"></i>' +
            '</div>' +
            '<div class="field-item-label' + (mod ? ' field-item-label' + mod : '') + '">' + label + '</div>' +
            '<span class="field-item-type' + (mod ? ' field-item-type' + mod : '') + '">' + displayLabel + '</span>' +
            '<button type="button" class="field-item-rm" onclick="window._removeField(' + i + ',\'' + key + '\')">' +
                '<i class="bi bi-x-lg"></i>' +
            '</button>';

        document.getElementById('addedFields').appendChild(item);

        // Center bold items hidden here, shown in centerBoldList
        if (isCenterBold) item.style.display = 'none';

        // Build hidden form inputs
        var safeLabel = (label || '').replace(/"/g, '"');
        var safeTmpl  = (templateText || '').replace(/"/g, '"');

        var hidden = document.createElement('div');
        hidden.id = 'fh_' + i;
        hidden.innerHTML =
            '<input type="hidden" name="extra_key[]" value="' + key + '">' +
            '<input type="hidden" name="extra_label[]" value="' + safeLabel + '">' +
            '<input type="hidden" name="extra_type[]" value="' + type + '">' +
            '<input type="hidden" name="extra_required[]" value="' + (req ? '1' : '0') + '">' +
            '<input type="hidden" name="extra_on_print[]" value="' + (onPrint ? '1' : '0') + '">' +
            '<input type="hidden" name="extra_print_style[]" value="' + (printStyle || '') + '">' +
            '<input type="hidden" name="extra_template_text[]" value="' + safeTmpl + '">';
        document.getElementById('extraFieldsHidden').appendChild(hidden);

        // Center bold: render in dedicated list
        if (isCenterBold) {
            renderCenterBoldUI(i, templateText || '');
        }

        // Track for preview
        if (!isSection && !isCenterBold && onPrint) {
            pvExtra.push({ i: i, key: key, label: label });
        }

        updatePresetButtons();
        renderPreview();
    }

    function renderCenterBoldUI(idx, tmpl) {
        var el = document.createElement('div');
        el.className = 'field-item field-item--bold';
        el.id = 'cb_' + idx;
        el.innerHTML =
            '<div class="field-item-icon field-item-icon--bold"><i class="bi bi-type-bold"></i></div>' +
            '<div class="field-item-label field-item-label--bold">' + (tmpl || 'Bold Center') + '</div>' +
            '<span class="field-item-type field-item-type--bold">Bold Center</span>' +
            '<button type="button" class="field-item-rm" onclick="window._removeCB(' + idx + ')">' +
                '<i class="bi bi-x-lg"></i>' +
            '</button>';
        document.getElementById('centerBoldList').appendChild(el);
    }

    

    window._removeField = function(i, key) {
        var fi = document.getElementById('fi_' + i);
        var fh = document.getElementById('fh_' + i);
        if (fi) fi.remove();
        if (fh) fh.remove();
        var btn = document.querySelector('[data-key="' + key + '"]');
        if (btn) btn.classList.remove('used');
        var idx = pvExtra.findIndex(function(x) { return x.i === i; });
        if (idx !== -1) pvExtra.splice(idx, 1);
        renderPreview();
    };

    window._removeCB = function(i) {
        var cb = document.getElementById('cb_' + i);
        var fi = document.getElementById('fi_' + i);
        var fh = document.getElementById('fh_' + i);
        if (cb) cb.remove();
        if (fi) fi.remove();
        if (fh) fh.remove();
        renderPreview();
    };

    function updatePresetButtons() {
        var usedKeys = [];
        document.querySelectorAll('#extraFieldsHidden input[name="extra_key[]"]').forEach(function(inp) {
            usedKeys.push(inp.value);
        });
        document.querySelectorAll('.preset-tag').forEach(function(btn) {
            if (usedKeys.indexOf(btn.dataset.key) !== -1) btn.classList.add('used');
        });
    }

    

    window.openCBModal = function() {
        document.getElementById('cbModalTmpl').value = '';
        document.getElementById('cbModal').style.display = 'flex';
        setTimeout(function() { document.getElementById('cbModalTmpl').focus(); }, 100);
    };

    window.closeCBModal = function() {
        document.getElementById('cbModal').style.display = 'none';
    };

    window.submitCBModal = function() {
        var tmpl = document.getElementById('cbModalTmpl').value.trim();
        if (!tmpl) { document.getElementById('cbModalTmpl').focus(); return; }
        closeCBModal();
        var key = 'center_bold_' + Date.now();
        renderField(key, 'Baris Bold: ' + tmpl, 'text', false, false, 'center_bold', tmpl);
    };

    

    var inputModalCallback = null;

    function openInputModal(icon, color, title, label, placeholder, callback) {
        var modal = document.getElementById('inputModal');
        modal.querySelector('.im-icon').className = 'im-icon bi ' + icon;
        modal.querySelector('.im-icon').style.color = color;
        modal.querySelector('.im-title').textContent = title;
        var inp = modal.querySelector('.im-input');
        inp.value = '';
        inp.placeholder = label || placeholder;
        modal.querySelector('.im-btn-ok').style.background = color;
        inputModalCallback = callback;
        modal.style.display = 'flex';
        setTimeout(function() { inp.focus(); }, 100);
    }

    window.closeInputModal = function() {
        document.getElementById('inputModal').style.display = 'none';
        inputModalCallback = null;
    };

    window.submitInputModal = function() {
        var val = document.querySelector('#inputModal .im-input').value.trim();
        if (!val) { document.querySelector('#inputModal .im-input').focus(); return; }
        closeInputModal();
        if (inputModalCallback) inputModalCallback(val);
    };

    function showAlert(msg, type) {
        var colors = { warning: '#f59e0b', error: '#ef4444', info: '#1c64f2' };
        var div = document.createElement('div');
        div.style.cssText = 'position:fixed;top:20px;right:20px;z-index:99999;padding:14px 22px;border-radius:12px;background:white;border:1.5px solid ' + (colors[type] || '#e2e8f0') + ';color:#0f172a;font-size:14px;font-weight:600;box-shadow:0 8px 24px rgba(0,0,0,.12);font-family:inherit;';
        div.textContent = msg;
        document.body.appendChild(div);
        setTimeout(function() { div.remove(); }, 3000);
    }

    window.renderPreview = function() {
        var nama   = document.getElementById('namaSurat').value || 'SURAT KETERANGAN';
        var kodeKl = document.getElementById('inp_kode_klas').value || '470';
        var kodeS  = document.getElementById('inp_kode_surat').value || 'SK';
        var pemb   = document.getElementById('inp_pembuka').value || '';
        var isi    = document.getElementById('inp_isi').value || '';
        var penu   = document.getElementById('inp_penutup').value || '';

        document.getElementById('pv_judul').textContent = nama.toUpperCase();
        document.getElementById('pv_nomor').textContent = kodeKl + ' / ___ / Kel.1010/' + kodeS + '/ VI /2026';
        document.getElementById('pv_pembuka').innerHTML = applyBold(pemb);

        var bioTbl = document.getElementById('pv_bio');
        bioTbl.innerHTML = '';
        bioOrder.forEach(function(b) {
            bioTbl.innerHTML += '<tr><td>' + (BIO_LABELS[b.key] || b.label) + '</td><td>:</td><td class="sp-placeholder">' + b.label + '</td></tr>';
        });

        var extraDiv = document.getElementById('pv_extra');
        if (pvExtra.length) {
            var html = '<table class="sp-bio">';
            pvExtra.forEach(function(e) {
                html += '<tr><td>' + e.label + '</td><td>:</td><td class="sp-placeholder">' + e.label + '</td></tr>';
            });
            html += '</table>';
            extraDiv.innerHTML = html;
        } else {
            extraDiv.innerHTML = '';
        }

        var isiEl = document.getElementById('pv_isi');
        if (isi) { isiEl.innerHTML = applyBold(isi); isiEl.style.display = ''; }
        else { isiEl.style.display = 'none'; }

        var cbDiv = document.getElementById('pv_center_bold');
        var cbHtml = '';
        document.querySelectorAll('[id^="cb_"]').forEach(function(el) {
            var idx = el.id.replace('cb_', '');
            var fh = document.getElementById('fh_' + idx);
            if (!fh) return;
            var tmpl = fh.querySelector('input[name="extra_template_text[]"]');
            cbHtml += '<p style="text-align:center;font-weight:bold;font-style:italic;font-size:11pt;margin:4px 0">' + (tmpl ? tmpl.value : '') + ' ___________</p>';
        });
        cbDiv.innerHTML = cbHtml;

        document.getElementById('pv_penutup').textContent = penu;
    };

    function applyBold(str) {
        return str.replace(/\*\*(.+?)\*\*/g, '<strong style="text-decoration:underline">$1</strong>').replace(/\n/g, '<br>');
    }

    // Initialize icon
    var curIcon  = document.getElementById('icon_hidden').value;
    var curColor = document.getElementById('warna_hidden').value;
    if (curIcon) window.setIcon(curIcon, curColor);

    // Initialize bio fields from checked checkboxes
    document.querySelectorAll('.bio-cb:checked').forEach(function(cb) {
        bioOrder.push({ key: cb.value, label: cb.dataset.label });
    });
    syncBioHidden();

    // Initialize existing extra fields from database
    @foreach($extraFields as $ef)
        @php
            $efKey       = $ef['key'] ?? '';
            $efLabel     = $ef['label'] ?? '';
            $efType      = $ef['type'] ?? 'text';
            $efReq       = $ef['required'] ?? false;
            $efOnPrint   = $ef['on_print'] ?? false;
            $efPrintStyle = $ef['print_style'] ?? '';
            $efTmplText  = $ef['template_text'] ?? '';
        @endphp
        @if($efPrintStyle === 'center_bold')
            renderField('{{ $efKey }}', @json($efLabel), '{{ $efType }}', {{ $efReq ? 'true' : 'false' }}, {{ $efOnPrint ? 'true' : 'false' }}, 'center_bold', @json($efTmplText));
        @else
            renderField('{{ $efKey }}', @json($efLabel), '{{ $efType }}', {{ $efReq ? 'true' : 'false' }}, {{ $efOnPrint ? 'true' : 'false' }});
        @endif
    @endforeach

    renderPreview();
});
</script>

@endsection