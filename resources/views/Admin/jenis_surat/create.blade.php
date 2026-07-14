@extends('Admin.layouts.app')
@section('title', 'Tambah Jenis Surat')

@push('styles')
<style>
/* ── MAIN LAYOUT ── */
.page-layout{display:grid;grid-template-columns:1fr 500px;gap:20px;padding:20px 24px;align-items:start;max-width:1500px;margin:0 auto}
@media(max-width:1200px){.page-layout{grid-template-columns:1fr}.preview-col{display:none}}
.form-col{min-width:0}
.preview-col{position:sticky;top:72px}

/* ── FORM ── */
.wizard-wrap{width:100%}

/* ── PREVIEW PANEL ── */
.preview-panel{background:white;border:1px solid #e2e8f0;border-radius:14px;overflow:hidden}
.preview-panel-head{padding:12px 16px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;gap:8px;background:#f8fafc}
.preview-panel-head span{font-size:12px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em}
.preview-live-dot{width:8px;height:8px;border-radius:50%;background:#22c55e;box-shadow:0 0 0 3px rgba(34,197,94,.2);animation:blink 1.4s infinite}
@keyframes blink{0%,100%{opacity:1}50%{opacity:.4}}
.preview-scroll{max-height:calc(100vh - 160px);overflow-y:auto;overflow-x:hidden;padding:16px;background:#f1f5f9}
.preview-scroll::-webkit-scrollbar{width:4px}
.preview-scroll::-webkit-scrollbar-thumb{background:#e2e8f0;border-radius:4px}

/* Preview surat */
.surat-preview{background:white;box-shadow:0 2px 12px rgba(0,0,0,.15);transform-origin:top left;font-family:'Times New Roman',Times,serif;color:black;font-size:12pt;line-height:1.5;padding:14mm 16mm 12mm 18mm;width:210mm;transform:scale(0.625);margin-bottom:calc(210mm * 0.625 - 210mm * 1)}
#suratPreviewWrap{width:calc(210mm * 0.625);min-height:200px}.sp-kop{display:flex;align-items:center;gap:8px;padding-bottom:5px;border-bottom:3px double black;margin-bottom:8px}
.sp-kop img{width:70px;height:auto}
.sp-kop-teks{text-align:center;flex:1;line-height:1.2}
.sp-kop-teks .k1{font-size:15pt;font-weight:bold}
.sp-kop-teks .k2{font-size:15pt;font-weight:bold}
.sp-kop-teks .k3{font-size:15pt;font-weight:bold}
.sp-kop-teks .k4{font-size:9pt;font-style:italic}
.sp-judul{text-align:center;font-size:13pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:.06em;margin:8px 0 3px}
.sp-nomor{text-align:center;font-size:10pt;margin-bottom:6px;color:#444}
.sp-pembuka{text-align:justify;margin-bottom:6px;text-indent:28px;font-size:11pt}
.sp-bio{width:100%;border-collapse:collapse;margin-bottom:6px}
.sp-bio td{padding:1.5px 0;vertical-align:top;font-size:11pt}
.sp-bio td:first-child{width:130px}
.sp-bio td:nth-child(2){width:12px;padding:0 5px}
.sp-placeholder{color:#94a3b8;font-style:italic}
.sp-section{font-size:11pt;margin:10px 0 4px}
.sp-isi{text-align:justify;font-size:11pt;margin:6px 0;white-space:pre-wrap;text-indent:28px}
.sp-penutup{text-align:justify;font-size:11pt;margin:6px 0}
.sp-ttd{display:flex;justify-content:flex-end;margin-top:14px;font-size:11pt}
.sp-ttd-box{text-align:center;min-width:160px}
.sp-ttd-ruang{height:55px}
.sp-ttd-nama{font-weight:bold;text-decoration:underline;font-size:11pt}
.sp-ttd-nip{font-size:10pt}

/* Step indicator */
.steps{display:flex;align-items:center;margin-bottom:32px;gap:0}
.step-item{display:flex;flex-direction:column;align-items:center;flex:1;position:relative}
.step-item:not(:last-child)::after{content:'';position:absolute;top:20px;left:60%;width:80%;height:2px;background:#e2e8f0;z-index:0}
.step-item.done::after{background:#1c64f2}
.step-circle{width:40px;height:40px;border-radius:50%;border:2px solid #e2e8f0;background:white;display:flex;align-items:center;justify-content:center;font-size:15px;font-weight:700;color:#94a3b8;position:relative;z-index:1;transition:all .25s}
.step-item.active .step-circle{border-color:#1c64f2;background:#1c64f2;color:white;box-shadow:0 0 0 4px rgba(28,100,242,.15)}
.step-item.done .step-circle{border-color:#10b981;background:#10b981;color:white}
.step-label{font-size:11px;font-weight:600;color:#94a3b8;margin-top:6px;text-align:center;white-space:nowrap}
.step-item.active .step-label{color:#1c64f2}
.step-item.done .step-label{color:#10b981}

/* Step panels */
.step-panel{display:none}
.step-panel.active{display:block}

/* Card */
.wcard{background:white;border:1px solid #e2e8f0;border-radius:16px;overflow:hidden;margin-bottom:16px}
.wcard-head{padding:16px 20px;border-bottom:1px solid #e2e8f0;display:flex;align-items:center;gap:10px}
.wcard-icon{width:36px;height:36px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:17px;flex-shrink:0}
.wcard-title{font-size:15px;font-weight:700;color:#0f172a}
.wcard-sub{font-size:12px;color:#64748b;margin-top:1px}
.wcard-body{padding:20px}

/* Form elements */
.fl{display:block;font-size:12px;font-weight:600;color:#374151;margin-bottom:6px}
.fl .req{color:#dc2626}
.fi{width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;font-family:inherit;color:#0f172a;outline:none;transition:all .15s;background:white}
.fi:focus{border-color:#1c64f2;box-shadow:0 0 0 3px rgba(28,100,242,.08)}
textarea.fi{resize:vertical;min-height:90px}
.hint{font-size:11px;color:#94a3b8;margin-top:4px;line-height:1.5}

/* Checkbox grid */
.check-grid{display:grid;grid-template-columns:repeat(2,1fr);gap:8px}
.check-item{display:flex;align-items:center;gap:10px;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;cursor:pointer;transition:all .15s;user-select:none}
.check-item:hover{background:#f8fafc;border-color:#bfdbfe}
.check-item input[type=checkbox]{width:16px;height:16px;accent-color:#1c64f2;flex-shrink:0}
.check-item span{font-size:13px;font-weight:500;color:#334155}
.check-item:has(input:checked){border-color:#bfdbfe;background:#eff6ff}
.check-item:has(input:checked) span{color:#1c64f2;font-weight:600}

/* Preset tags */
.preset-grid{display:flex;flex-wrap:wrap;gap:8px}
.preset-tag{display:inline-flex;align-items:center;gap:5px;padding:8px 14px;border-radius:22px;border:1.5px solid #e2e8f0;background:white;color:#334155;font-size:13px;font-weight:600;cursor:pointer;transition:all .18s;font-family:inherit}
.preset-tag:hover{border-color:#93c5fd;background:#eff6ff;color:#1c64f2}
.preset-tag.used{border-color:#a7f3d0;background:#ecfdf5;color:#059669;pointer-events:none}
.preset-tag i{font-size:11px}

/* Added fields list */
.field-item{display:flex;align-items:center;gap:10px;padding:10px 14px;background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;font-size:13px}
.field-item-icon{width:28px;height:28px;border-radius:7px;background:#eff6ff;color:#1c64f2;display:flex;align-items:center;justify-content:center;font-size:13px;flex-shrink:0}
.field-item-label{flex:1;font-weight:600;color:#0f172a}
.field-item-type{font-size:11px;color:#94a3b8;background:#f1f5f9;border-radius:5px;padding:2px 8px}
.field-item-rm{width:26px;height:26px;border-radius:6px;border:1px solid #fecaca;background:#fef2f2;color:#dc2626;cursor:pointer;display:flex;align-items:center;justify-content:center;font-size:13px}

/* Navigation buttons */
.wizard-nav{display:flex;justify-content:space-between;align-items:center;margin-top:24px;gap:12px}
.btn-back{padding:11px 24px;border-radius:10px;border:1.5px solid #e2e8f0;background:white;font-size:14px;font-weight:600;color:#334155;cursor:pointer;font-family:inherit;transition:all .15s}
.btn-back:hover{border-color:#cbd5e1;background:#f8fafc}
.btn-next{padding:11px 28px;border-radius:10px;border:none;background:#1c64f2;font-size:14px;font-weight:700;color:white;cursor:pointer;font-family:inherit;transition:background .15s;display:flex;align-items:center;gap:8px}
.btn-next:hover{background:#1a56db}
.btn-submit-final{padding:13px 32px;border-radius:10px;border:none;background:linear-gradient(135deg,#0d1b3e,#1c64f2);font-size:14px;font-weight:700;color:white;cursor:pointer;font-family:inherit;display:flex;align-items:center;gap:8px}
.btn-submit-final:hover{opacity:.92}

/* Summary preview (step 3) */
.summary-row{display:flex;gap:12px;padding:10px 0;border-bottom:1px solid #f1f5f9}
.summary-row:last-child{border-bottom:none}
.summary-key{width:140px;font-size:12px;font-weight:600;color:#64748b;flex-shrink:0}
.summary-val{font-size:13px;color:#0f172a;flex:1}

/* Hidden fields (tetap dikirim ke backend) */
input[name=kode_surat],input[name=icon],input[name=warna],
textarea[name=template_pembuka],textarea[name=template_isi],textarea[name=template_penutup]{display:none}

@media(max-width:600px){.check-grid{grid-template-columns:1fr}.wizard-wrap{padding:16px}}
</style>
@endpush

@section('content')
<div class="page-layout">
{{-- ── KIRI: FORM ── --}}
<div class="form-col">
<div class="wizard-wrap">
    <a href="{{ route('jenis-surat.index') }}" style="display:inline-flex;align-items:center;gap:6px;font-size:13px;color:#64748b;text-decoration:none;margin-bottom:20px">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    {{-- STEP INDICATOR --}}
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

    @if($errors->any())
    <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:10px;padding:12px 16px;margin-bottom:16px;font-size:13px;color:#991b1b">
        <ul style="margin:0;padding-left:16px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul>
    </div>
    @endif

    <form method="POST" action="{{ route('jenis-surat.store') }}" id="suratForm">
        @csrf

        {{-- Hidden technical fields (auto-filled by JS) --}}
        <input type="hidden" name="kode_surat" id="kode_surat_hidden" value="SK">
        <input type="hidden" name="icon" id="icon_hidden" value="bi-file-earmark-text">
        <input type="hidden" name="warna" id="warna_hidden" value="#1c64f2">
        <input type="hidden" name="template_pembuka" id="template_pembuka_hidden"
               value="Yang bertanda tangan di bawah ini Kepala Kelurahan Teritih Kecamatan Walantaka Kota Serang Provinsi Banten, menerangkan dengan sebenarnya bahwa:">
        <input type="hidden" name="template_isi" id="template_isi_hidden">
        <input type="hidden" name="template_penutup" id="template_penutup_hidden"
               value="Demikian surat keterangan ini kami buat dengan sebenar-benarnya dan untuk dipergunakan sebagaimana mestinya.">

        {{-- ══ STEP 1: Info Surat ══ --}}
        <div class="step-panel active" id="step1">
            <div class="wcard">
                <div class="wcard-head">
                    <div class="wcard-icon" style="background:#eff6ff;color:#1c64f2"><i class="bi bi-file-earmark-text-fill"></i></div>
                    <div>
                        <div class="wcard-title">Informasi Surat</div>
                        <div class="wcard-sub">Nama dan deskripsi jenis surat baru</div>
                    </div>
                </div>
                <div class="wcard-body">
                    <div class="row g-3">
                        <div class="col-12">
                            <label class="fl">Nama Jenis Surat <span class="req">*</span></label>
                            <input type="text" name="nama_surat" id="namaSurat" class="fi" value="{{ old('nama_surat') }}"
                                   placeholder="Contoh: Surat Keterangan Tidak Mampu" required
                                   oninput="autoFillKode(this.value)">
                        </div>
                        <div class="col-md-4">
                            <label class="fl">Nomor Kode Surat <span class="req">*</span></label>
                            <input type="text" name="kode_klasifikasi" id="inp_kode_klas" class="fi" value="{{ old('kode_klasifikasi','470') }}" placeholder="470" required oninput="renderPreview()">
                            <div class="hint">Angka di depan nomor surat — misal <strong>470</strong> untuk surat keterangan umum, <strong>474</strong> untuk kelahiran</div>
                        </div>
                        <div class="col-md-8">
                            <label class="fl">Deskripsi <span style="color:#94a3b8;font-weight:400">(opsional)</span></label>
                            <input type="text" name="deskripsi" class="fi" placeholder="Jelaskan singkat kegunaan surat ini..." value="{{ old('deskripsi') }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Icon picker (simplified) --}}
            <div class="wcard">
                <div class="wcard-head">
                    <div class="wcard-icon" style="background:#fdf4ff;color:#a855f7"><i class="bi bi-palette-fill"></i></div>
                    <div>
                        <div class="wcard-title">Tampilan Ikon</div>
                        <div class="wcard-sub">Pilih ikon yang sesuai untuk surat ini</div>
                    </div>
                </div>
                <div class="wcard-body">
                    <div style="display:grid;grid-template-columns:repeat(6,1fr);gap:8px">
                        @foreach([
                            ['bi-file-earmark-text','#1c64f2'],
                            ['bi-people-fill','#ec4899'],
                            ['bi-heart-pulse-fill','#ef4444'],
                            ['bi-building','#0891b2'],
                            ['bi-briefcase-fill','#f59e0b'],
                            ['bi-calendar-check','#0891b2'],
                            ['bi-house-fill','#10b981'],
                            ['bi-person-badge-fill','#6366f1'],
                            ['bi-file-earmark-medical','#6b7280'],
                            ['bi-stars','#f59e0b'],
                            ['bi-shield-check','#10b981'],
                            ['bi-bank2','#1c64f2'],
                        ] as [$ic, $cl])
                        <label style="cursor:pointer;text-align:center">
                            <input type="radio" name="_icon_pick" value="{{ $ic }}" style="display:none" onchange="setIcon('{{ $ic }}','{{ $cl }}')">
                            <div class="icon-opt" data-icon="{{ $ic }}" style="padding:12px;border:2px solid #e2e8f0;border-radius:10px;font-size:22px;color:{{ $cl }};transition:all .15s">
                                <i class="bi {{ $ic }}"></i>
                            </div>
                        </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="wizard-nav">
                <span></span>
                <button type="button" class="btn-next" onclick="goStep(2)">
                    Selanjutnya <i class="bi bi-arrow-right"></i>
                </button>
            </div>
        </div>

        {{-- ══ STEP 2: Data yang Diminta dari Warga ══ --}}
        <div class="step-panel" id="step2">
            <div class="wcard">
                <div class="wcard-head">
                    <div class="wcard-icon" style="background:#ecfdf5;color:#10b981"><i class="bi bi-person-lines-fill"></i></div>
                    <div>
                        <div class="wcard-title">Data Biodata Warga</div>
                        <div class="wcard-sub">Pilih data yang akan diminta dari warga saat pengajuan</div>
                    </div>
                </div>
                <div class="wcard-body">
                    <div class="check-grid">
                        @foreach($standardFields as $sf)
                        <label class="check-item">
                            <input type="checkbox" class="bio-cb" value="{{ $sf['key'] }}"
                                data-label="{{ $sf['print_label'] }}"
                                {{ in_array($sf['key'], old('bio_fields', ['nama','nik','tempat_tgl_lahir','jenis_kelamin','agama','pekerjaan','alamat'])) ? 'checked' : '' }}
                                onchange="toggleBioField(this)">
                            <span>{{ $sf['print_label'] }}</span>
                        </label>
                        @endforeach
                    </div>
                    <div id="bioFieldsHidden"></div>
                    <input type="hidden" name="bio_section_label" value="">
                </div>
            </div>

            <div class="wcard">
                <div class="wcard-head">
                    <div class="wcard-icon" style="background:#fffbeb;color:#f59e0b"><i class="bi bi-plus-circle-fill"></i></div>
                    <div>
                        <div class="wcard-title">Data Tambahan</div>
                        <div class="wcard-sub">Informasi spesifik yang dibutuhkan surat ini selain biodata</div>
                    </div>
                </div>
                <div class="wcard-body">
                    <div class="preset-grid mb-3">
                        @foreach([
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
                            ['key'=>'alamat_usaha','label'=>'Alamat Usaha','type'=>'text','req'=>true,'print'=>true],
                            ['key'=>'tanggal_cuti','label'=>'Tanggal Cuti','type'=>'text','req'=>true,'print'=>true],
                            ['key'=>'lama_cuti','label'=>'Lama Cuti (hari)','type'=>'text','req'=>true,'print'=>true],
                            ['key'=>'alasan_cuti','label'=>'Alasan Cuti','type'=>'textarea','req'=>true,'print'=>true],
                            ['key'=>'keterangan','label'=>'Keterangan Tambahan','type'=>'textarea','req'=>false,'print'=>true],
                        ] as $preset)
                        <button type="button" class="preset-tag" data-key="{{ $preset['key'] }}" onclick="addPreset({{ json_encode($preset) }})">
                            <i class="bi bi-plus-lg"></i> {{ $preset['label'] }}
                        </button>
                        @endforeach
                    </div>

                    <div id="addedFields" style="display:flex;flex-direction:column;gap:8px;margin-bottom:8px"></div>
                    <div id="extraFieldsHidden"></div>

                    <button type="button" onclick="addCustomField()"
                        style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:8px;border:1.5px dashed #93c5fd;background:#f0f9ff;color:#0284c7;font-size:12px;font-weight:600;cursor:pointer;font-family:inherit;margin-top:4px">
                        <i class="bi bi-pencil-square"></i> Tambah Field Lainnya
                    </button>
                    <button type="button" onclick="addSectionSeparator()"
                        style="display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:8px;border:1.5px dashed #bbf7d0;background:#f0fdf4;color:#16a34a;font-size:12px;font-weight:600;cursor:pointer;font-family:inherit;margin-top:4px;margin-left:6px">
                        <i class="bi bi-text-left"></i> Tambah Teks Pemisah
                    </button>
                </div>
            </div>

            <div class="wizard-nav">
                <button type="button" class="btn-back" onclick="goStep(1)"><i class="bi bi-arrow-left"></i> Kembali</button>
                <button type="button" class="btn-next" onclick="goStep(3)">Selanjutnya <i class="bi bi-arrow-right"></i></button>
            </div>
        </div>

        {{-- ══ STEP 3: Kalimat Isi Surat ══ --}}
        <div class="step-panel" id="step3">
            <div class="wcard">
                <div class="wcard-head">
                    <div class="wcard-icon" style="background:#eff6ff;color:#1c64f2"><i class="bi bi-chat-quote-fill"></i></div>
                    <div>
                        <div class="wcard-title">Kalimat Keterangan Surat</div>
                        <div class="wcard-sub">Kalimat yang muncul di bawah tabel data warga, sebelum kalimat penutup</div>
                    </div>
                </div>
                <div class="wcard-body">
                    <div style="background:#fffbeb;border:1px solid #fde68a;border-radius:10px;padding:14px 16px;margin-bottom:16px;font-size:13px;color:#92400e;line-height:1.7">
                        <div style="font-weight:700;margin-bottom:6px">💡 Kapan perlu diisi?</div>
                        <div>Isi kolom ini jika surat membutuhkan <strong>kalimat penjelasan khusus</strong> setelah tabel data warga.</div>
                        <div style="margin-top:4px">Contoh: SKTM perlu kalimat <em>"...termasuk keluarga tidak mampu"</em>, sedangkan surat kematian biasanya tidak perlu kalimat tambahan.</div>
                        <div style="margin-top:4px;color:#78350f"><strong>Kosongkan</strong> jika tidak ada kalimat khusus — admin bisa mengetik manual saat cetak.</div>
                    </div>

                    <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:14px;margin-bottom:16px;font-size:12px;color:#334155;line-height:1.8">
                        <div style="font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.05em;margin-bottom:8px">Urutan isi surat</div>
                        <div style="color:#64748b;font-style:italic">1. Yang bertanda tangan di bawah ini...</div>
                        <div style="border:1px dashed #cbd5e1;border-radius:6px;padding:6px 12px;margin:4px 0;font-size:12px;color:#94a3b8">📋 Tabel data warga (Nama, NIK, Alamat, dll)</div>
                        <div style="color:#1c64f2;font-weight:600">2. 👉 Kalimat keterangan yang Anda tulis di sini</div>
                        <div style="color:#64748b;font-style:italic">3. Demikian surat keterangan ini kami buat...</div>
                    </div>

                    <label class="fl">Kalimat Keterangan <span style="color:#94a3b8;font-weight:400">(opsional — kosongkan jika tidak diperlukan)</span></label>
                    <textarea id="kalimatIsi" class="fi" rows="5"
                              placeholder="Contoh: Benar nama tersebut di atas adalah warga Kelurahan Teritih yang keadaan ekonominya termasuk tidak mampu. Surat ini dipergunakan untuk {keperluan}."
                              oninput="document.getElementById('template_isi_hidden').value=this.value">{{ old('_kalimat_isi') }}</textarea>
                    <div class="hint" style="margin-top:6px">Gunakan <code style="background:#f1f5f9;padding:1px 5px;border-radius:4px">{nama_field}</code> untuk menyisipkan data warga secara otomatis. Contoh: <code style="background:#f1f5f9;padding:1px 5px;border-radius:4px">{keperluan}</code>, <code style="background:#f1f5f9;padding:1px 5px;border-radius:4px">{nama}</code></div>

                    <div style="margin-top:16px;padding-top:16px;border-top:1px dashed #e2e8f0">
                        <div class="fl" style="margin-bottom:8px">Baris Khusus <span style="color:#94a3b8;font-weight:400">(opsional)</span></div>
                        <div style="font-size:12px;color:#64748b;margin-bottom:10px">Tambahkan baris yang tampil dengan format khusus setelah kalimat di atas — misalnya tujuan penggunaan surat yang ditulis warga saat mengajukan.</div>
                        <button type="button" onclick="addCenterBoldField()"
                            style="display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:8px;border:1.5px dashed #e9d5ff;background:#faf5ff;color:#7c3aed;font-size:13px;font-weight:600;cursor:pointer;font-family:inherit">
                            <i class="bi bi-type-bold"></i> Tambah Baris Bold + Center
                        </button>
                        <div class="hint" style="margin-top:6px">Admin bisa isi template teks awal, sisanya diisi warga. Contoh hasil: <em style="font-weight:bold;text-decoration:underline">Surat Keterangan ini dipergunakan untuk Persyaratan Bansos Tahun 2027</em></div>
                        <div id="centerBoldList" style="display:flex;flex-direction:column;gap:8px;margin-top:10px"></div>
                    </div>
                </div>
            </div>

            <div class="wizard-nav">
                <button type="button" class="btn-back" onclick="goStep(2)"><i class="bi bi-arrow-left"></i> Kembali</button>
                <button type="submit" class="btn-submit-final">
                    <i class="bi bi-check-circle-fill"></i> Simpan Jenis Surat
                </button>
            </div>
        </div>

    </form>
</div>{{-- wizard-wrap --}}
</div>{{-- form-col --}}

{{-- ── KANAN: PREVIEW ── --}}
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
                    <div class="sp-judul" id="pv_judul">SURAT KETERANGAN</div>
                    <div class="sp-nomor">Nomor: <span id="pv_nomor">470 / ___ / Kel.1010/SK/ VI /2026</span></div>
                    <p class="sp-pembuka">Yang bertanda tangan di bawah ini Kepala Kelurahan Teritih Kecamatan Walantaka Kota Serang Provinsi Banten, menerangkan dengan sebenarnya bahwa:</p>
                    <table class="sp-bio" id="pv_bio"></table>
                    <p class="sp-isi" id="pv_isi"></p>
                    <div id="pv_extra"></div>
                    <div id="pv_center_bold"></div>
                    <p class="sp-penutup">Demikian surat keterangan ini kami buat dengan sebenar-benarnya dan untuk dipergunakan sebagaimana mestinya.</p>
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

</div>{{-- page-layout --}}

<script>
let extraCount = 0;
let currentStep = 1;

// ── Step navigation ──
function goStep(n) {
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
    window.scrollTo({top: 0, behavior: 'smooth'});
}

function validateStep(n) {
    if (n === 1) {
        const nama = document.getElementById('namaSurat').value.trim();
        if (!nama) { showAlert('Nama surat wajib diisi.', 'warning'); document.getElementById('namaSurat').focus(); return false; }
    }
    return true;
}

// ── Auto-fill kode from nama ──
function autoFillKode(val) {
    const words = val.trim().toUpperCase().split(/\s+/);
    const kode  = words.map(w => w[0] || '').join('').substring(0, 6);
    document.getElementById('kode_surat_hidden').value = kode || 'SK';
}

// ── Icon picker ──
function setIcon(icon, color) {
    document.getElementById('icon_hidden').value = icon;
    document.getElementById('warna_hidden').value = color;
    document.querySelectorAll('.icon-opt').forEach(el => {
        el.style.borderColor = el.dataset.icon === icon ? color : '#e2e8f0';
        el.style.background  = el.dataset.icon === icon ? 'rgba(28,100,242,.06)' : 'white';
    });
}
// Default select first icon
setIcon('bi-file-earmark-text', '#1c64f2');

// ── Preset fields ──
function addPreset(preset) {
    const btn = document.querySelector(`[data-key="${preset.key}"]`);
    if (btn && btn.classList.contains('used')) return;
    if (btn) btn.classList.add('used');
    renderField(preset.key, preset.label, preset.type, preset.req, preset.print);
}

function addCustomField() {
    openInputModal(
        'bi-plus-circle', '#1c64f2',
        'Tambah Field Data',
        'Nama data yang diminta dari warga',
        'Contoh: Nama Tempat Bekerja',
        function(label) {
            if (!label) return;
            const key = label.toLowerCase().replace(/\s+/g, '_').replace(/[^a-z0-9_]/g, '') || ('field_' + Date.now());
            renderField(key, label, 'text', true, true);
        }
    );
}

function addSectionSeparator() {
    openInputModal(
        'bi-dash-lg', '#64748b',
        'Tambah Teks Pemisah',
        'Teks pemisah/judul kelompok data',
        'Contoh: Telah meninggal dunia pada:',
        function(label) {
            if (!label) return;
            const key = 'section_' + Date.now();
            renderField(key, label, 'section', false, true, null);
        }
    );
}

function addCenterBoldField() { openCenterBoldModal(); }

function editCenterBold(i, key) {
    const labelEl = document.getElementById('cb_label_'+i);
    const current = labelEl?.textContent || '';
    openInputModal(
        'bi-type-bold', '#7c3aed',
        'Edit Teks Bold Center',
        'Teks pembuka',
        'Contoh: Surat ini dipergunakan untuk',
        function(newLabel) {
            if (!newLabel || newLabel === current) return;
            if (labelEl) labelEl.textContent = newLabel;
            const fh = document.getElementById('fh_'+i);
            if (fh) {
                const inp = fh.querySelector('input[name="extra_label[]"]');
                if (inp) inp.value = newLabel;
            }
            renderPreview();
        },
        current
    );
}

function removeCenterBold(i, key) {
    document.getElementById('cb_item_'+i)?.remove();
    removeField(i, key);
}

function renderField(key, label, type, req, onPrint, printStyle, templateText) {
    const i = extraCount++;
    const isCenterBold = printStyle === 'center_bold';
    const isSection = type === 'section';
    const typeLabel = {text:'Teks',textarea:'Teks Panjang',date:'Tanggal',section:'Pemisah'}[type] || 'Teks';
    const displayLabel = isCenterBold ? 'Bold Center' : typeLabel;

    const item = document.createElement('div');
    item.className = 'field-item';
    item.id = 'fi_'+i;
    item.style.cssText = isSection ? 'background:#f0fdf4;border-color:#bbf7d0' : (isCenterBold ? 'background:#faf5ff;border-color:#e9d5ff' : '');
    item.innerHTML = `
        <div class="field-item-icon" style="${isSection?'background:#dcfce7;color:#16a34a':(isCenterBold?'background:#f3e8ff;color:#7c3aed':'')}">
            <i class="bi bi-${isSection?'text-left':(isCenterBold?'type-bold':'input-cursor-text')}"></i>
        </div>
        <div class="field-item-label" style="${isSection?'color:#15803d;font-style:italic':(isCenterBold?'color:#6d28d9;font-weight:700':'')}">${label}</div>
        <span class="field-item-type" style="${isSection?'background:#dcfce7;color:#16a34a':(isCenterBold?'background:#f3e8ff;color:#7c3aed':'')}">${displayLabel}</span>
        <button type="button" class="field-item-rm" onclick="removeField(${i},'${key}')"><i class="bi bi-x-lg"></i></button>`;
    document.getElementById('addedFields').appendChild(item);
    if (isCenterBold) item.style.display = 'none'; // ditampilkan di centerBoldList step 3

    const hidden = document.createElement('div');
    hidden.id = 'fh_'+i;
    hidden.innerHTML = `
        <input type="hidden" name="extra_key[]"          value="${key}">
        <input type="hidden" name="extra_label[]"         value="${label}">
        <input type="hidden" name="extra_type[]"          value="${type}">
        <input type="hidden" name="extra_print_style[]"   value="${printStyle || ''}">
        <input type="hidden" name="extra_template_text[]" value="${(templateText||'').replace(/"/g,'&quot;')}">
        <input type="hidden" name="extra_required[]"      value="${req ? '1' : '0'}">
        <input type="hidden" name="extra_on_print[]"      value="${onPrint ? '1' : '0'}">`;
    document.getElementById('extraFieldsHidden').appendChild(hidden);
    pvAddField(i, key, label, isSection, isCenterBold, templateText || '');
}

function removeField(i, key) {
    document.getElementById('fi_'+i)?.remove();
    document.getElementById('fh_'+i)?.remove();
    const btn = document.querySelector(`[data-key="${key}"]`);
    if (btn) btn.classList.remove('used');
    pvRemoveField(key);
}

// Restore on validation error (page reload)
@if(old('extra_label'))
@foreach(old('extra_label', []) as $idx => $lbl)
@php
    $ek = old('extra_key')[$idx] ?? '';
    $et = old('extra_type')[$idx] ?? 'text';
@endphp
renderField('{{ $ek }}', @json($lbl), '{{ $et }}', true, true);
@endforeach
// Jump to error step
goStep({{ $errors->has('nama_surat') ? 1 : ($errors->has('bio_fields') ? 2 : 3) }});
@endif

// ── Bio field print_label map ──
const BIO_LABELS = {
    nama:'N a m a', nik:'N I K', tempat_tgl_lahir:'Tempat / Tgl Lahir', umur:'Umur',
    jenis_kelamin:'Jenis Kelamin', agama:'Bangsa / Agama', status_kawin:'Status Perkawinan',
    kewarganegaraan:'Kewarganegaraan', pekerjaan:'Pekerjaan', pendidikan:'Pendidikan',
    alamat:'Alamat', rt_rw:'RT / RW', kelurahan:'Kelurahan', kecamatan:'Kecamatan', no_hp:'No. HP'
};

// ── Live preview data store ──
const pvExtra = []; // { key, label, type }

function renderPreview() {
    // Judul
    const nama = document.getElementById('namaSurat')?.value.trim() || 'SURAT KETERANGAN';
    document.getElementById('pv_judul').textContent = nama.toUpperCase();

    // Kode klasifikasi untuk nomor preview
    const kodeKlas = document.getElementById('inp_kode_klas')?.value.trim() || '470';
    const kodeSurat = document.getElementById('kode_surat_hidden')?.value || 'SK';
    document.getElementById('pv_nomor').textContent = `${kodeKlas} / ___ / Kel.1010/${kodeSurat}/ VI /2026`;

    // Biodata tabel — urutan sesuai klik admin
    let bioHtml = '';
    bioOrder.forEach(b => {
        bioHtml += `<tr><td>${b.label}</td><td>:</td><td class="sp-placeholder">[${b.label}]</td></tr>`;
    });
    document.getElementById('pv_bio').innerHTML = bioHtml;

    // Extra fields — tabel + section separator (tanpa center_bold)
    let extraHtml = '';
    let centerBoldHtml = '';
    if (pvExtra.length) {
        let tableOpen = false;
        pvExtra.forEach(ef => {
            if (ef.isCenterBold) {
                const display = ef.templateText || '';
                centerBoldHtml += `<p style="text-align:center;font-weight:bold;font-style:italic;font-size:10pt;margin:6px 0">${display}</p>`;
            } else if (ef.isSection) {
                if (tableOpen) { extraHtml += '</table>'; tableOpen = false; }
                extraHtml += `<p class="sp-section">${ef.label}</p>`;
            } else {
                if (!tableOpen) { extraHtml += '<table class="sp-bio">'; tableOpen = true; }
                extraHtml += `<tr><td>${ef.label}</td><td>:</td><td class="sp-placeholder">[${ef.label}]</td></tr>`;
            }
        });
        if (tableOpen) extraHtml += '</table>';
    }
    document.getElementById('pv_extra').innerHTML = extraHtml;
    document.getElementById('pv_center_bold').innerHTML = centerBoldHtml;

    // Isi
    const isi = document.getElementById('kalimatIsi')?.value.trim() || '';
    const pvIsi = document.getElementById('pv_isi');
    pvIsi.textContent = isi;
    pvIsi.style.display = isi ? 'block' : 'none';
}

// ── Preview sync — called after renderField/removeField ──
function pvAddField(i, key, label, isSection, isCenterBold, templateText) {
    pvExtra.push({ i, key, label, isSection: !!isSection, isCenterBold: !!isCenterBold, templateText: templateText||'' });
    renderPreview();
}
function pvRemoveField(key) {
    const idx = pvExtra.findIndex(e => e.key === key);
    if (idx !== -1) pvExtra.splice(idx, 1);
    renderPreview();
}

// ── Bio field order tracking ──
const bioOrder = []; // array of {key, label} in click order

function toggleBioField(cb) {
    const key = cb.value;
    if (cb.checked) {
        bioOrder.push({ key, label: cb.dataset.label });
    } else {
        const idx = bioOrder.findIndex(b => b.key === key);
        if (idx !== -1) bioOrder.splice(idx, 1);
    }
    // Rebuild hidden inputs
    const wrap = document.getElementById('bioFieldsHidden');
    wrap.innerHTML = bioOrder.map(b => `<input type="hidden" name="bio_fields[]" value="${b.key}">`).join('');
    renderPreview();
}

// Init bioOrder from pre-checked defaults on page load
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.bio-cb:checked').forEach(cb => {
        bioOrder.push({ key: cb.value, label: cb.dataset.label });
        document.getElementById('bioFieldsHidden').insertAdjacentHTML('beforeend',
            `<input type="hidden" name="bio_fields[]" value="${cb.value}">`);
    });
    document.getElementById('namaSurat')?.addEventListener('input', renderPreview);
    document.getElementById('inp_kode_klas')?.addEventListener('input', renderPreview);
    document.getElementById('kalimatIsi')?.addEventListener('input', renderPreview);
    renderPreview();
});

// ── Generic single-input modal ──
let _inputModalCb = null;
function openInputModal(icon, color, title, label, placeholder, callback, defaultValue = '') {
    _inputModalCb = callback;
    const m = document.getElementById('inputModal');
    m.querySelector('.im-icon').className = 'bi ' + icon + ' im-icon';
    m.querySelector('.im-icon').style.color = color;
    m.querySelector('.im-title').textContent = title;
    m.querySelector('.im-label').textContent = label;
    const inp = m.querySelector('.im-input');
    inp.placeholder = placeholder;
    inp.value = defaultValue;
    m.querySelector('.im-btn-ok').style.background = color;
    m.style.display = 'flex';
    setTimeout(() => inp.focus(), 50);
}
function closeInputModal() {
    document.getElementById('inputModal').style.display = 'none';
    _inputModalCb = null;
}
function submitInputModal() {
    const val = document.getElementById('inputModal').querySelector('.im-input').value.trim();
    if (!val) { document.getElementById('inputModal').querySelector('.im-input').focus(); return; }
    const cb = _inputModalCb;
    closeInputModal();
    if (cb) cb(val);
}

function openCenterBoldModal() {
    document.getElementById('cbModalTmpl').value = '';
    document.getElementById('cbModal').style.display = 'flex';
    document.getElementById('cbModalTmpl').focus();
}
function closeCenterBoldModal() {
    document.getElementById('cbModal').style.display = 'none';
}
let _cbSubmitting = false;
function submitCenterBoldModal() {
    if (_cbSubmitting) return;
    _cbSubmitting = true;
    setTimeout(() => _cbSubmitting = false, 500);
    const tmpl = document.getElementById('cbModalTmpl').value.trim();
    if (!tmpl) { document.getElementById('cbModalTmpl').focus(); return; }
    closeCenterBoldModal();
    const label = 'Keperluan Surat';
    const key = 'keperluan_surat_' + Date.now();
    const i = extraCount;
    renderField(key, label, 'text', true, false, 'center_bold', tmpl);
    const list = document.getElementById('centerBoldList');
    if (list) {
        const div = document.createElement('div');
        div.className = 'field-item';
        div.id = 'cb_item_'+i;
        div.style.cssText = 'background:#faf5ff;border-color:#e9d5ff';
        div.innerHTML = `<div class="field-item-icon" style="background:#f3e8ff;color:#7c3aed"><i class="bi bi-type-bold"></i></div>
            <div class="field-item-label" style="color:#6d28d9"><span style="color:#94a3b8;font-weight:400">${tmpl} </span>...</div>
            <span class="field-item-type" style="background:#f3e8ff;color:#7c3aed">Bold Center</span>
            <button type="button" class="field-item-rm" onclick="removeCenterBold(${i},'${key}')"><i class="bi bi-x-lg"></i></button>`;
        list.appendChild(div);
    }
}
</script>

{{-- Modal Bold Center --}}
<div id="cbModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;align-items:center;justify-content:center">
    <div style="background:white;border-radius:16px;padding:28px 28px 24px;width:420px;max-width:95vw;box-shadow:0 20px 60px rgba(0,0,0,.2)">
        <div style="font-size:15px;font-weight:700;color:#0d1b3e;margin-bottom:6px;display:flex;align-items:center;gap:8px">
            <i class="bi bi-type-bold" style="color:#7c3aed"></i> Tambah Baris Bold + Center
        </div>
        <div style="font-size:12px;color:#64748b;margin-bottom:18px">Isi teks pembuka — sisanya dilengkapi oleh warga saat mengajukan</div>
        <div style="margin-bottom:20px">
            <label style="font-size:12px;font-weight:600;color:#374151;display:block;margin-bottom:6px">Teks pembuka <span style="color:#ef4444">*</span></label>
            <input id="cbModalTmpl" type="text" placeholder="Contoh: Surat Keterangan ini dipergunakan untuk"
                style="width:100%;padding:9px 12px;border:1.5px solid #d1d5db;border-radius:8px;font-size:13px;font-family:inherit;box-sizing:border-box"
                onkeydown="if(event.key==='Enter'){event.preventDefault();submitCenterBoldModal()}">
            <div style="font-size:11px;color:#64748b;margin-top:8px;background:#f8fafc;border-radius:6px;padding:7px 10px">
                Di form warga muncul field <strong>"Keperluan Surat"</strong>.<br>
                Di surat cetak: <em style="font-weight:600">[teks di atas]</em> <u>jawaban warga</u>
            </div>
        </div>
        <div style="display:flex;justify-content:flex-end;gap:8px">
            <button type="button" onclick="closeCenterBoldModal()" style="padding:9px 18px;border-radius:8px;border:1.5px solid #e2e8f0;background:white;font-size:13px;font-weight:600;color:#64748b;cursor:pointer;font-family:inherit">Batal</button>
            <button type="button" onclick="submitCenterBoldModal()" style="padding:9px 18px;border-radius:8px;border:none;background:#7c3aed;color:white;font-size:13px;font-weight:600;cursor:pointer;font-family:inherit">Tambah</button>
        </div>
    </div>
</div>

{{-- Modal Generic Input (ganti native prompt) --}}
<div id="inputModal" style="display:none;position:fixed;inset:0;background:rgba(0,0,0,.45);z-index:9999;align-items:center;justify-content:center"
     onclick="if(event.target===this)closeInputModal()">
    <div style="background:white;border-radius:16px;padding:28px 28px 24px;width:420px;max-width:95vw;box-shadow:0 20px 60px rgba(0,0,0,.2)">
        <div style="font-size:15px;font-weight:700;color:#0d1b3e;margin-bottom:16px;display:flex;align-items:center;gap:8px">
            <i class="im-icon bi bi-plus-circle" style="font-size:18px"></i>
            <span class="im-title">Tambah Field</span>
        </div>
        <div style="margin-bottom:20px">
            <label class="im-label" style="font-size:12px;font-weight:600;color:#374151;display:block;margin-bottom:6px"></label>
            <input class="im-input" type="text"
                style="width:100%;padding:10px 12px;border:1.5px solid #d1d5db;border-radius:8px;font-size:13px;font-family:inherit;box-sizing:border-box;outline:none;transition:border-color .15s"
                onfocus="this.style.borderColor='#1c64f2'"
                onblur="this.style.borderColor='#d1d5db'"
                onkeydown="if(event.key==='Enter'){event.preventDefault();submitInputModal()}">
        </div>
        <div style="display:flex;justify-content:flex-end;gap:8px">
            <button type="button" onclick="closeInputModal()" style="padding:9px 18px;border-radius:8px;border:1.5px solid #e2e8f0;background:white;font-size:13px;font-weight:600;color:#64748b;cursor:pointer;font-family:inherit">Batal</button>
            <button type="button" class="im-btn-ok" onclick="submitInputModal()" style="padding:9px 18px;border-radius:8px;border:none;background:#1c64f2;color:white;font-size:13px;font-weight:600;cursor:pointer;font-family:inherit">Tambah</button>
        </div>
    </div>
</div>
@endsection