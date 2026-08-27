@extends('Admin.layouts.app')

@section('title', 'Edit Statistik Demografi')

@push('styles')<style>
body{font-family:'Plus Jakarta Sans',sans-serif;background:#f1f5f9}
.back-bar{display:flex;align-items:center;gap:8px;padding:14px 32px;background:white;border-bottom:1px solid #e2e8f0;font-size:13px}
.back-btn{display:inline-flex;align-items:center;gap:6px;color:#64748b;text-decoration:none;font-weight:600;padding:5px 10px;border-radius:7px;transition:all .15s}
.back-btn:hover{background:#f1f5f9;color:#1c64f2}
.bc-sep{color:#cbd5e1}.bc-cur{color:#0f172a;font-weight:600}

.stat-hero{
    background: linear-gradient(135deg, #0d1b3e 0%, #1c64f2 50%, #60a5fa 100%);
    padding:28px 32px;
    position:relative; overflow:hidden;
}
.stat-hero::before{
    content:''; position:absolute; inset:0;
    background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.04'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
}
.stat-hero-content{position:relative;z-index:1}
.stat-hero h1{font-size:22px;font-weight:800;color:white;margin:0 0 4px}
.stat-hero p{font-size:13px;color:rgba(255,255,255,.75);margin:0}

.stat-content{padding:28px 32px}
.alert-success{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:10px;margin-bottom:20px;background:#ecfdf5;border:1px solid #6ee7b7;font-size:13px;color:#065f46;font-weight:500}

.group-card{background:white;border-radius:14px;border:1px solid #e2e8f0;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.06);margin-bottom:20px}
.group-header{padding:14px 20px;border-bottom:1px solid #e2e8f0;background:#f8fafc;display:flex;align-items:center;gap:10px}
.group-icon{width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:16px}
.group-title{font-size:14px;font-weight:700;color:#0f172a}
.group-body{padding:20px;display:flex;flex-direction:column;gap:14px}

.stat-row{display:block;padding:14px 16px;border-radius:10px;background:#f8fafc;border:1px solid #e2e8f0}
.stat-row-label{font-size:11.5px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px}
.stat-input{width:100%;padding:11px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;font-family:inherit;color:#0f172a;background:white;outline:none;transition:all .18s;box-sizing:border-box}
.stat-input:focus{border-color:#1c64f2;box-shadow:0 0 0 3px rgba(37,99,235,.1)}
.stat-input:disabled{background:#f1f5f9;color:#64748b;cursor:not-allowed;border-style:dashed;border-color:#cbd5e1}
.pct-note{font-size:11px;color:#94a3b8;margin-top:4px}

.lock-badge{margin-left:auto;display:inline-flex;align-items:center;gap:5px;font-size:11px;font-weight:700;background:#f1f5f9;color:#64748b;border-radius:20px;padding:3px 10px;flex-shrink:0}

/* Grid 2 kolom untuk Laki-Laki & Perempuan */
.jk-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}

/* Grid untuk data singkat — 3 kolom */
.data-singkat-grid{display:grid;grid-template-columns:repeat(3,1fr);gap:14px}
.ds-item{padding:14px 16px;border-radius:10px;background:#f8fafc;border:1px solid #e2e8f0}
.ds-item-label{font-size:11px;font-weight:700;color:#64748b;text-transform:uppercase;letter-spacing:.06em;margin-bottom:6px;display:flex;align-items:center;gap:6px}
.ds-item-icon{width:22px;height:22px;border-radius:5px;display:flex;align-items:center;justify-content:center;font-size:11px;flex-shrink:0}

.form-footer{padding:16px 20px;background:#f8fafc;border-top:1px solid #e2e8f0;display:flex;align-items:center;justify-content:flex-end;gap:10px}
.btn-batal{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:9px;border:1.5px solid #e2e8f0;background:white;font-size:13px;font-weight:600;color:#64748b;text-decoration:none;cursor:pointer;transition:all .15s}
.btn-batal:hover{background:#f8fafc}
.btn-simpan{display:inline-flex;align-items:center;gap:6px;padding:9px 22px;border-radius:9px;border:none;background:#1c64f2;font-size:13px;font-weight:700;color:white;cursor:pointer;transition:all .15s;font-family:inherit}
.btn-simpan:hover{background:#1a56db}
.info-box{background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:12px 16px;font-size:12px;color:#1e40af;display:flex;align-items:flex-start;gap:8px}

/* Kelompok umur */
.umur-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.umur-row{padding:12px 16px;border-radius:10px;background:#f8fafc;border:1px solid #e2e8f0}
.umur-row-label{font-size:12px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.04em;margin-bottom:8px}
.umur-sub{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.umur-sub label{font-size:11px;color:#64748b;font-weight:600;margin-bottom:3px;display:block}

/* Agama */
.agama-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}

@media(max-width:900px){
    .data-singkat-grid{grid-template-columns:1fr 1fr}
    .agama-grid{grid-template-columns:1fr}
    .jk-grid{grid-template-columns:1fr}
}
@media(max-width:640px){
    .stat-content{padding:20px 16px}
    .data-singkat-grid{grid-template-columns:1fr}
    .umur-grid{grid-template-columns:1fr}
    .jk-grid{grid-template-columns:1fr}
}
</style>
@endpush

@section('content')
@include('Admin.partials.header')

<div>
    <div class="back-bar">
        <a href="{{ route('admin.dashboard') }}" class="back-btn"><i class="bi bi-arrow-left"></i> Kembali</a>
        <span class="bc-sep">/</span><span class="bc-cur">Statistik & Data Kelurahan</span>
    </div>

    <div class="stat-hero">
        <div class="stat-hero-content">
            <h1><i class="bi bi-bar-chart-fill me-2"></i>Edit Statistik & Data Kelurahan</h1>
            <p>Data singkat kelurahan, demografi, dan statistik penduduk — semua dikelola dari sini</p>
        </div>
    </div>

    <div class="stat-content">

        @if(session('success'))
        <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        @if(session('import_summary'))
            @php $sum = session('import_summary'); @endphp
            <div class="alert-success" style="align-items:flex-start;flex-direction:column;gap:6px;background:{{ $sum['berhasil'] > 0 ? '#ecfdf5' : '#fef2f2' }};border-color:{{ $sum['berhasil'] > 0 ? '#6ee7b7' : '#fca5a5' }};color:{{ $sum['berhasil'] > 0 ? '#065f46' : '#991b1b' }}">
                <div><i class="bi bi-file-earmark-check-fill"></i> <strong>Import selesai:</strong> {{ $sum['berhasil'] }} baris berhasil disimpan, {{ count($sum['gagal']) }} baris dilewati.</div>
                @if(count($sum['gagal']))
                    <ul style="margin:4px 0 0 18px;font-size:12px;padding:0">
                        @foreach($sum['gagal'] as $err)
                            <li>{{ $err }}</li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endif

        @if(session('import_errors'))
            <div class="alert-danger" style="background:#fef2f2;border-color:#fca5a5;color:#991b1b;flex-direction:column;align-items:flex-start;gap:4px;display:flex;padding:14px 18px;border-radius:8px;border:1px solid;margin-bottom:16px;font-size:13px">
                @foreach(session('import_errors') as $err)
                    <div><i class="bi bi-exclamation-triangle-fill"></i> {{ $err }}</div>
                @endforeach
            </div>
        @endif

        {{-- ══════════════════════════════════════════ --}}
        {{-- DATA WARGA (sumber perhitungan otomatis)   --}}
        {{-- ══════════════════════════════════════════ --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#eef2ff;color:#6366f1"><i class="bi bi-people-fill"></i></div>
                <div class="group-title">Data Warga (Kependudukan Individual)</div>
            </div>
            <div class="group-body">
                @if($adaDataPenduduk)
                    <div class="info-box" style="background:#ecfdf5;border-color:#6ee7b7;color:#065f46">
                        <i class="bi bi-check-circle-fill" style="flex-shrink:0;margin-top:1px"></i>
                        <div>
                            Terdapat <strong>{{ \App\Models\Penduduk::count() }} data warga</strong> tersimpan. Seluruh angka
                            jenis kelamin, agama, kelompok umur, pekerjaan, pendidikan, dan status kawin di bawah
                            <strong>dihitung otomatis</strong> dari data warga tersebut, sehingga field-nya
                            <strong>dikunci (tidak bisa diketik manual)</strong>. Untuk mengubah angka-angka itu,
                            tambah/edit/hapus datanya lewat tombol "Tambah Warga Baru" atau "Kelola Data Warga" di bawah.
                        </div>
                    </div>
                @else
                    <div class="info-box">
                        <i class="bi bi-info-circle-fill" style="flex-shrink:0;margin-top:1px"></i>
                        <div>
                            Belum ada data warga individual. Selama belum ada, statistik di bawah memakai
                            angka manual/import CSV di atas. Setelah data warga ditambahkan, angka terkait
                            akan otomatis dihitung ulang dari data warga.
                        </div>
                    </div>
                @endif
                <div style="display:flex;gap:12px;flex-wrap:wrap">
                    <a href="{{ route('admin.warga.index') }}" class="btn-simpan" style="text-decoration:none">
                        <i class="bi bi-search"></i> Cari, Lihat &amp; Kelola Data Warga
                    </a>
                    <a href="{{ route('admin.warga.create') }}" class="btn-batal" style="text-decoration:none">
                        <i class="bi bi-person-plus-fill"></i> Tambah Warga Baru
                    </a>
                </div>
            </div>
        </div>

        <form action="{{ route('admin.statistik.update') }}" method="POST">
        @csrf @method('PUT')

        {{-- ══════════════════════════════════════════ --}}
        {{-- ① DATA SINGKAT KELURAHAN                  --}}
        {{-- ══════════════════════════════════════════ --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#eff6ff;color:#1c64f2"><i class="bi bi-info-circle-fill"></i></div>
                <div class="group-title">Data Singkat Kelurahan</div>
                <span style="margin-left:auto;font-size:11px;font-weight:700;background:#eff6ff;color:#1a56db;border-radius:20px;padding:3px 10px">
                    Tampil di halaman Profil
                </span>
            </div>
            <div class="group-body">
                <div class="info-box">
                    <i class="bi bi-eye-fill" style="flex-shrink:0;margin-top:1px"></i>
                    <div>Data ini ditampilkan di bagian <strong>"Data Singkat Kelurahan"</strong> pada halaman Profil yang dapat dilihat oleh masyarakat.</div>
                </div>
                <div class="data-singkat-grid">
                    <div class="ds-item">
                        <div class="ds-item-label">
                            <div class="ds-item-icon" style="background:#fffbeb;color:#f59e0b"><i class="bi bi-mailbox2"></i></div>
                            Kode Pos
                        </div>
                        <input type="hidden" name="singkat[kode_pos][label]" value="Kode Pos">
                        <input type="text" name="singkat[kode_pos][nilai]" class="stat-input" value="{{ $dataSingkat['kode_pos'] ?? '42183' }}" placeholder="Contoh: 42183" maxlength="10">
                    </div>
                    <div class="ds-item">
                        <div class="ds-item-label">
                            <div class="ds-item-icon" style="background:#ecfdf5;color:#10b981"><i class="bi bi-map-fill"></i></div>
                            Luas Wilayah (km²)
                        </div>
                        <input type="hidden" name="singkat[luas_wilayah][label]" value="Luas Wilayah">
                        <input type="text" name="singkat[luas_wilayah][nilai]" class="stat-input" value="{{ $dataSingkat['luas_wilayah'] ?? '2.54' }}" placeholder="Contoh: 2.54">
                    </div>
                    <div class="ds-item">
                        <div class="ds-item-label">
                            <div class="ds-item-icon" style="background:#eff6ff;color:#1c64f2"><i class="bi bi-people-fill"></i></div>
                            Jumlah Penduduk (Jiwa)
                            @if($adaDataPenduduk)
                            <span class="lock-badge" style="margin-left:6px"><i class="bi bi-lock-fill"></i> Otomatis</span>
                            @endif
                        </div>
                        <input type="hidden" name="singkat[jumlah_penduduk][label]" value="Jumlah Penduduk">
                        <input type="text" name="singkat[jumlah_penduduk][nilai]" class="stat-input" value="{{ $dataSingkat['jumlah_penduduk'] ?? '4.520' }}" placeholder="Contoh: 4.520" @disabled($adaDataPenduduk)>
                        <div class="pct-note">
                            @if($adaDataPenduduk)
                                Otomatis dari jumlah data warga ({{ $totalPendudukDB }} jiwa) — ubah lewat Data Warga.
                            @else
                                Tampil dengan satuan "Jiwa" di halaman profil
                            @endif
                        </div>
                    </div>
                    <div class="ds-item">
                        <div class="ds-item-label">
                            <div class="ds-item-icon" style="background:#fdf4ff;color:#a855f7"><i class="bi bi-diagram-3-fill"></i></div>
                            Kecamatan
                        </div>
                        <input type="hidden" name="singkat[kecamatan][label]" value="Kecamatan">
                        <input type="text" name="singkat[kecamatan][nilai]" class="stat-input" value="{{ $dataSingkat['kecamatan'] ?? 'Walantaka' }}" placeholder="Contoh: Walantaka">
                    </div>
                    <div class="ds-item">
                        <div class="ds-item-label">
                            <div class="ds-item-icon" style="background:#fff1f2;color:#f43f5e"><i class="bi bi-geo-alt-fill"></i></div>
                            Kota / Kabupaten
                        </div>
                        <input type="hidden" name="singkat[kota][label]" value="Kota">
                        <input type="text" name="singkat[kota][nilai]" class="stat-input" value="{{ $dataSingkat['kota'] ?? 'Serang' }}" placeholder="Contoh: Serang">
                    </div>
                    <div class="ds-item">
                        <div class="ds-item-label">
                            <div class="ds-item-icon" style="background:#f0fdf4;color:#16a34a"><i class="bi bi-globe2"></i></div>
                            Provinsi
                        </div>
                        <input type="hidden" name="singkat[provinsi][label]" value="Provinsi">
                        <input type="text" name="singkat[provinsi][nilai]" class="stat-input" value="{{ $dataSingkat['provinsi'] ?? 'Banten' }}" placeholder="Contoh: Banten">
                    </div>
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════ --}}
        {{-- ② KEPENDUDUKAN UTAMA                       --}}
        {{-- ══════════════════════════════════════════ --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#eff6ff;color:#1c64f2"><i class="bi bi-people-fill"></i></div>
                <div class="group-title">Data Kependudukan Utama</div>
                @if($adaDataPenduduk)
                <span class="lock-badge"><i class="bi bi-lock-fill"></i> Otomatis dari Data Warga</span>
                @endif
            </div>
            <div class="group-body">

                {{-- Total, KK, RT, RW --}}
                @foreach(['total_penduduk','jumlah_kk','jumlah_rt','jumlah_rw'] as $kunci)
                @php $s = $statistik[$kunci] ?? null; @endphp
                @if($s)
                <div class="stat-row">
                    <div class="stat-row-label">{{ $s->label }}</div>
                    <input type="hidden" name="statistik[{{ $kunci }}][label]" value="{{ $s->label }}">
                    <input type="number" name="statistik[{{ $kunci }}][nilai]" class="stat-input" value="{{ $s->nilai }}" min="0" required @disabled($adaDataPenduduk)>
                </div>
                @endif
                @endforeach

                {{-- ── Laki-Laki & Perempuan (2 kolom) ── --}}
                <div style="margin-top:4px">
                    <div style="font-size:12px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.05em;margin-bottom:10px;display:flex;align-items:center;gap:8px">
                        <i class="bi bi-gender-ambiguous" style="color:#1c64f2"></i>
                        Jumlah Berdasarkan Jenis Kelamin
                    </div>
                    <div class="jk-grid">
                        {{-- Laki-Laki --}}
                        @php
                            $sLaki = $statistik['jiwa_lakilaki'] ?? null;
                            $nilaiLaki = $sLaki ? $sLaki->nilai : 0;
                        @endphp
                        <div class="stat-row" style="border-color:#bfdbfe;background:#eff6ff">
                            <div class="stat-row-label" style="color:#1a56db">
                                👨 Laki-Laki (Jiwa)
                            </div>
                            <input type="hidden" name="statistik[jiwa_lakilaki][label]" value="Laki-Laki">
                            <input type="number" name="statistik[jiwa_lakilaki][nilai]"
                                   id="input_jiwa_lakilaki"
                                   class="stat-input jk-input"
                                   value="{{ $nilaiLaki }}" min="0"
                                   style="border-color:#bfdbfe"
                                   oninput="hitungJK()" @disabled($adaDataPenduduk)>
                            <div class="pct-note" id="pct_laki">
                                {{ ($nilaiLaki + ($statistik['jiwa_perempuan']->nilai ?? 0)) > 0
                                    ? round($nilaiLaki / ($nilaiLaki + ($statistik['jiwa_perempuan']->nilai ?? 0)) * 100, 1)
                                    : 0 }}% dari total
                            </div>
                        </div>

                        {{-- Perempuan --}}
                        @php
                            $sPrmp = $statistik['jiwa_perempuan'] ?? null;
                            $nilaiPrmp = $sPrmp ? $sPrmp->nilai : 0;
                        @endphp
                        <div class="stat-row" style="border-color:#fecdd3;background:#fff1f2">
                            <div class="stat-row-label" style="color:#be123c">
                                👩 Perempuan (Jiwa)
                            </div>
                            <input type="hidden" name="statistik[jiwa_perempuan][label]" value="Perempuan">
                            <input type="number" name="statistik[jiwa_perempuan][nilai]"
                                   id="input_jiwa_perempuan"
                                   class="stat-input jk-input"
                                   value="{{ $nilaiPrmp }}" min="0"
                                   style="border-color:#fecdd3"
                                   oninput="hitungJK()" @disabled($adaDataPenduduk)>
                            <div class="pct-note" id="pct_perempuan">
                                {{ ($nilaiLaki + $nilaiPrmp) > 0
                                    ? round($nilaiPrmp / ($nilaiLaki + $nilaiPrmp) * 100, 1)
                                    : 0 }}% dari total
                            </div>
                        </div>
                    </div>
                    {{-- Ringkasan live total L+P & rasio DIHILANGKAN --}}
                </div>

            </div>
        </div>

        {{-- ══════════════════════════════════════════ --}}
        {{-- ③ AGAMA                                    --}}
        {{-- ══════════════════════════════════════════ --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#ecfdf5;color:#10b981"><i class="bi bi-stars"></i></div>
                <div class="group-title">Sebaran Agama (7 Jenis)</div>
                @if($adaDataPenduduk)
                <span class="lock-badge"><i class="bi bi-lock-fill"></i> Otomatis dari Data Warga</span>
                @endif
            </div>
            <div class="group-body">
                @php
                    $agamaKeys = ['jiwa_islam','jiwa_kristen','jiwa_katolik','jiwa_hindu','jiwa_buddha','jiwa_konghucu','jiwa_lainnya'];
                    $totalA    = collect($agamaKeys)->sum(fn($k) => $statistik[$k]->nilai ?? 0);
                    $agamaColors = [
                        'jiwa_islam'    =>'#10b981','jiwa_kristen'  =>'#1c64f2','jiwa_katolik'  =>'#f59e0b',
                        'jiwa_hindu'    =>'#a855f7','jiwa_buddha'   =>'#06b6d4','jiwa_konghucu' =>'#ef4444',
                        'jiwa_lainnya'  =>'#94a3b8'
                    ];
                @endphp
                <div class="info-box">
                    <i class="bi bi-info-circle-fill" style="flex-shrink:0;margin-top:1px"></i>
                    <div>
                        @if($adaDataPenduduk)
                            Jumlah jiwa per agama dihitung otomatis dari data warga — ubah lewat Data Warga. Persentase dihitung otomatis dari total semua agama.
                        @else
                            Isi jumlah jiwa per agama — persentase dihitung otomatis dari total semua agama.
                        @endif
                    </div>
                </div>
                <div class="agama-grid">
                @foreach($agamaKeys as $kunci)
                @php
                    $defaultLabels = [
                        'jiwa_islam'=>'Islam','jiwa_kristen'=>'Kristen','jiwa_katolik'=>'Katolik',
                        'jiwa_hindu'=>'Hindu','jiwa_buddha'=>'Buddha','jiwa_konghucu'=>'Konghucu',
                        'jiwa_lainnya'=>'Kepercayaan Lainnya'
                    ];
                    $s      = $statistik[$kunci] ?? null;
                    $sLabel = $s ? $s->label : ($defaultLabels[$kunci] ?? $kunci);
                    $sNilai = $s ? $s->nilai : 0;
                @endphp
                <div class="stat-row">
                    <div class="stat-row-label" style="color:{{ $agamaColors[$kunci] ?? '#334155' }}">
                        <span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:{{ $agamaColors[$kunci] ?? '#94a3b8' }};margin-right:6px;vertical-align:middle"></span>
                        {{ $sLabel }} (Jiwa)
                    </div>
                    <input type="hidden" name="statistik[{{ $kunci }}][label]" value="{{ $sLabel }}">
                    <input type="number" name="statistik[{{ $kunci }}][nilai]"
                           id="input_{{ $kunci }}" class="stat-input agama-input"
                           value="{{ $sNilai }}" min="0" required oninput="hitungAgama()" @disabled($adaDataPenduduk)>
                    <div class="pct-note">Preview: <span id="pct_{{ $kunci }}">{{ $totalA > 0 ? round($sNilai / $totalA * 100, 1) : 0 }}%</span></div>
                </div>
                @endforeach
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════ --}}
        {{-- ④ KELOMPOK UMUR 4 KATEGORI (DDK)           --}}
        {{-- ══════════════════════════════════════════ --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#f5f3ff;color:#8b5cf6"><i class="bi bi-calendar2-range-fill"></i></div>
                <div class="group-title">Kelompok Umur – 4 Kategori (Data DDK)</div>
                @if($adaDataPenduduk)
                <span class="lock-badge"><i class="bi bi-lock-fill"></i> Otomatis dari Data Warga</span>
                @endif
            </div>
            <div class="group-body">
                <div class="info-box">
                    <i class="bi bi-info-circle-fill" style="flex-shrink:0;margin-top:1px"></i>
                    <div>
                        @if($adaDataPenduduk)
                            Dihitung otomatis dari tanggal lahir data warga — ubah lewat Data Warga.
                        @else
                            Data dari pemdes.kemendagri.go.id. Isi Laki-laki dan Perempuan per kategori.
                        @endif
                    </div>
                </div>
                @php
                    $umur4Keys = [
                        'umur4_anak' => 'Anak (< 7 Tahun)',
                        'umur4_remaja' => 'Remaja (7–18 Tahun)',
                        'umur4_dewasa' => 'Dewasa (19–55 Tahun)',
                        'umur4_lansia' => 'Lansia (≥ 56 Tahun)',
                    ];
                @endphp
                <div class="umur-grid">
                    @foreach($umur4Keys as $kunci => $labelU4)
                    @php
                        $su4 = $statistik[$kunci] ?? null;
                        $su4teks = $su4->nilai_teks ?? '0|0';
                        $su4parts = explode('|', $su4teks);
                    @endphp
                    <div class="umur-row">
                        <div class="umur-row-label">{{ $labelU4 }}</div>
                        <input type="hidden" name="statistik[{{ $kunci }}][label]" value="{{ $labelU4 }}">
                        <div class="umur-sub">
                            <div>
                                <label>👨 Laki-laki</label>
                                <input type="number" class="stat-input umur4-input" data-key="{{ $kunci }}" data-gender="l" value="{{ $su4parts[0] ?? 0 }}" min="0" oninput="hitungUmur4('{{ $kunci }}')" @disabled($adaDataPenduduk)>
                            </div>
                            <div>
                                <label>👩 Perempuan</label>
                                <input type="number" class="stat-input umur4-input" data-key="{{ $kunci }}" data-gender="p" value="{{ $su4parts[1] ?? 0 }}" min="0" oninput="hitungUmur4('{{ $kunci }}')" @disabled($adaDataPenduduk)>
                            </div>
                        </div>
                        <input type="hidden" name="statistik[{{ $kunci }}][nilai]" id="umur4_nilai_{{ $kunci }}" value="{{ $su4->nilai ?? 0 }}">
                        <input type="hidden" name="statistik[{{ $kunci }}][nilai_teks]" id="umur4_teks_{{ $kunci }}" value="{{ $su4teks }}">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════ --}}
        {{-- ⑤ MATA PENCAHARIAN                         --}}
        {{-- ══════════════════════════════════════════ --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#fff7ed;color:#f59e0b"><i class="bi bi-briefcase-fill"></i></div>
                <div class="group-title">Mata Pencaharian (Data DDK)</div>
                @if($adaDataPenduduk)
                <span class="lock-badge"><i class="bi bi-lock-fill"></i> Otomatis dari Data Warga</span>
                @endif
            </div>
            <div class="group-body">
                @php
                    $kerjaKeys = [
                        'kerja_pelajar' => 'Pelajar',
                        'kerja_irt' => 'Ibu Rumah Tangga',
                        'kerja_wiraswasta' => 'Wiraswasta',
                        'kerja_belum' => 'Belum Bekerja',
                        'kerja_buruh' => 'Buruh Harian Lepas',
                        'kerja_swasta' => 'Karyawan Swasta',
                        'kerja_petani' => 'Petani',
                        'kerja_pemerintah' => 'Karyawan Pemerintah',
                        'kerja_pedagang_keliling' => 'Pedagang Keliling',
                        'kerja_pedagang_kelontong' => 'Pedagang Kelontong',
                        'kerja_lainnya' => 'Lainnya',
                    ];
                @endphp
                <div class="agama-grid">
                    @foreach($kerjaKeys as $kunci => $labelK)
                    @php $sk = $statistik[$kunci] ?? null; @endphp
                    <div class="stat-row">
                        <div class="stat-row-label">{{ $labelK }}</div>
                        <input type="hidden" name="statistik[{{ $kunci }}][label]" value="{{ $labelK }}">
                        <input type="number" name="statistik[{{ $kunci }}][nilai]" class="stat-input" value="{{ $sk->nilai ?? 0 }}" min="0" @disabled($adaDataPenduduk)>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════ --}}
        {{-- ⑥ STATUS PERKAWINAN                        --}}
        {{-- ══════════════════════════════════════════ --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#fff1f2;color:#f43f5e"><i class="bi bi-heart-fill"></i></div>
                <div class="group-title">Status Perkawinan (Data DDK)</div>
                @if($adaDataPenduduk)
                <span class="lock-badge"><i class="bi bi-lock-fill"></i> Otomatis dari Data Warga</span>
                @endif
            </div>
            <div class="group-body">
                @php
                    $kawinKeys = [
                        'kawin_belum' => 'Belum Kawin',
                        'kawin_kawin' => 'Kawin',
                        'kawin_janda_duda' => 'Janda/Duda',
                    ];
                @endphp
                @foreach($kawinKeys as $kunci => $labelKw)
                @php
                    $skw = $statistik[$kunci] ?? null;
                    $skwteks = $skw->nilai_teks ?? '0|0';
                    $skwparts = explode('|', $skwteks);
                @endphp
                <div class="stat-row">
                    <div class="stat-row-label">{{ $labelKw }}</div>
                    <input type="hidden" name="statistik[{{ $kunci }}][label]" value="{{ $labelKw }}">
                    <div class="umur-sub" style="margin-top:8px">
                        <div>
                            <label style="font-size:11px;color:#64748b;font-weight:600;margin-bottom:3px;display:block">👨 Laki-laki</label>
                            <input type="number" class="stat-input kawin-input" data-key="{{ $kunci }}" data-gender="l" value="{{ $skwparts[0] ?? 0 }}" min="0" oninput="hitungKawin('{{ $kunci }}')" @disabled($adaDataPenduduk)>
                        </div>
                        <div>
                            <label style="font-size:11px;color:#64748b;font-weight:600;margin-bottom:3px;display:block">👩 Perempuan</label>
                            <input type="number" class="stat-input kawin-input" data-key="{{ $kunci }}" data-gender="p" value="{{ $skwparts[1] ?? 0 }}" min="0" oninput="hitungKawin('{{ $kunci }}')" @disabled($adaDataPenduduk)>
                        </div>
                    </div>
                    <input type="hidden" name="statistik[{{ $kunci }}][nilai]" id="kawin_nilai_{{ $kunci }}" value="{{ $skw->nilai ?? 0 }}">
                    <input type="hidden" name="statistik[{{ $kunci }}][nilai_teks]" id="kawin_teks_{{ $kunci }}" value="{{ $skwteks }}">
                </div>
                @endforeach
            </div>
        </div>

        {{-- ⑦ FASILITAS KELURAHAN                      --}}
        {{-- ══════════════════════════════════════════ --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#ecfdf5;color:#10b981"><i class="bi bi-building"></i></div>
                <div class="group-title">Fasilitas Kelurahan</div>
            </div>
            <div class="group-body">
                @php
                    $fasKeys = [
                        'fas_masjid' => 'Masjid',
                        'fas_musholla' => 'Musholla',
                        'fas_tpq' => 'TPQ/Madrasah',
                        'fas_paud' => 'PAUD/TK',
                        'fas_sd' => 'SD/MI',
                        'fas_smp' => 'SMP/MTs',
                        'fas_sma' => 'SMA/SMK/MA',
                        'fas_posyandu' => 'Posyandu',
                        'fas_puskesmas' => 'Puskesmas/Klinik',
                        'fas_lapangan' => 'Lapangan Olahraga',
                    ];
                @endphp
                <div class="agama-grid">
                    @foreach($fasKeys as $kunci => $labelF)
                    @php $sf = $statistik[$kunci] ?? null; @endphp
                    <div class="stat-row">
                        <div class="stat-row-label">{{ $labelF }}</div>
                        <input type="hidden" name="statistik[{{ $kunci }}][label]" value="{{ $labelF }}">
                        <input type="number" name="statistik[{{ $kunci }}][nilai]" class="stat-input" value="{{ $sf->nilai ?? 0 }}" min="0">
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════ --}}
        {{-- ⑧ PENDIDIKAN                               --}}
        {{-- ══════════════════════════════════════════ --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#f5f3ff;color:#8b5cf6"><i class="bi bi-mortarboard-fill"></i></div>
                <div class="group-title">Tingkat Pendidikan</div>
                @if($adaDataPenduduk)
                <span class="lock-badge"><i class="bi bi-lock-fill"></i> Otomatis dari Data Warga</span>
                @endif
            </div>
            <div class="group-body">
                @php
                    $pendKeys = [
                        'pend_belum_sekolah' => 'Belum Sekolah (PAUD/TK)',
                        'pend_sma' => 'SMA/Sederajat',
                        'pend_sd' => 'SD/Sederajat',
                        'pend_smp' => 'SMP/Sederajat',
                        'pend_s1' => 'Sarjana (S1)',
                        'pend_sedang_sekolah' => 'Sedang Sekolah (7-18 Thn)',
                        'pend_diploma' => 'Diploma (D1-D3)',
                        'pend_s2' => 'Pascasarjana (S2/S3)',
                        'pend_tidak_tamat' => 'Tidak Tamat/Lainnya',
                    ];
                @endphp
                <div class="agama-grid">
                    @foreach($pendKeys as $kunci => $labelPd)
                    @php $sp = $statistik[$kunci] ?? null; @endphp
                    <div class="stat-row">
                        <div class="stat-row-label">{{ $labelPd }}</div>
                        <input type="hidden" name="statistik[{{ $kunci }}][label]" value="{{ $labelPd }}">
                        <input type="number" name="statistik[{{ $kunci }}][nilai]" class="stat-input" value="{{ $sp->nilai ?? 0 }}" min="0" @disabled($adaDataPenduduk)>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ══════════════════════════════════════════ --}}
        {{-- ⑩ UPDATE TERAKHIR                          --}}
        {{-- ══════════════════════════════════════════ --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#fff7ed;color:#f59e0b"><i class="bi bi-calendar3"></i></div>
                <div class="group-title">Keterangan Update</div>
                @if($adaDataPenduduk)
                <span class="lock-badge"><i class="bi bi-lock-fill"></i> Otomatis dari Data Warga</span>
                @endif
            </div>
            <div class="group-body">
                @php
                    $s = $statistik['update_terakhir'] ?? null;
                    $bulanMap = [
                        'Januari'=>'01','Februari'=>'02','Maret'=>'03','April'=>'04',
                        'Mei'=>'05','Juni'=>'06','Juli'=>'07','Agustus'=>'08',
                        'September'=>'09','Oktober'=>'10','November'=>'11','Desember'=>'12'
                    ];
                    $nilaiTeks = $s->nilai_teks ?? '';
                    $monthVal  = '';
                    if ($nilaiTeks) {
                        $parts = explode(' ', $nilaiTeks);
                        if (count($parts) === 2 && isset($bulanMap[$parts[0]])) {
                            $monthVal = $parts[1] . '-' . $bulanMap[$parts[0]];
                        }
                    }
                @endphp
                @if($adaDataPenduduk)
                <div class="stat-row">
                    <div class="stat-row-label">Periode Update Data</div>
                    <div class="stat-input" style="background:#f1f5f9;color:#374151;font-weight:700;border-style:dashed;border-color:#cbd5e1">
                        {{ $nilaiTeks ?: '—' }}
                    </div>
                    <div style="font-size:11px;color:#94a3b8;margin-top:5px">
                        <i class="bi bi-info-circle me-1"></i>Otomatis ter-set ke bulan &amp; tahun saat ini setiap kali data warga ditambah/diubah/dihapus — tidak perlu dipilih manual lagi.
                    </div>
                </div>
                @elseif($s)
                <div class="stat-row">
                    <div class="stat-row-label">Periode Update Data</div>
                    <input type="hidden" name="statistik[update_terakhir][label]" value="{{ $s->label }}">
                    <input type="hidden" name="statistik[update_terakhir][nilai]" value="0">
                    <input type="month" name="statistik[update_terakhir][nilai_teks]" class="stat-input" value="{{ $monthVal }}" required>
                    <div style="font-size:11px;color:#94a3b8;margin-top:5px">
                        <i class="bi bi-info-circle me-1"></i>Pilih bulan & tahun — tampil otomatis di halaman publik (misal: Maret 2026)
                    </div>
                </div>
                @endif
            </div>
            <div class="form-footer">
                <a href="{{ route('admin.dashboard') }}" class="btn-batal"><i class="bi bi-x-lg"></i> Batal</a>
                <button type="submit" class="btn-simpan"><i class="bi bi-check-lg"></i> Simpan Semua</button>
            </div>
        </div>

        </form>
    </div>
</div>

@include('Admin.partials.footer')
@endsection

@push('scripts')
<script>
// Hitung persentase agama live
function hitungAgama() {
    const keys = ['jiwa_islam','jiwa_kristen','jiwa_katolik','jiwa_hindu','jiwa_buddha','jiwa_konghucu','jiwa_lainnya'];
    const tot  = keys.reduce((s,k) => s + (parseFloat(document.getElementById('input_'+k)?.value)||0), 0);
    if (tot <= 0) return;
    keys.forEach(k => {
        const val = parseFloat(document.getElementById('input_'+k)?.value) || 0;
        const pct = Math.round(val / tot * 1000) / 10;
        const pEl = document.getElementById('pct_'+k);
        if (pEl) pEl.textContent = pct + '%';
    });
}

// Hitung persentase jenis kelamin live (ringkasan total & rasio sudah dihapus)
function hitungJK() {
    const l = parseFloat(document.getElementById('input_jiwa_lakilaki')?.value) || 0;
    const p = parseFloat(document.getElementById('input_jiwa_perempuan')?.value) || 0;
    const tot = l + p;

    const pctLEl = document.getElementById('pct_laki');
    const pctPEl = document.getElementById('pct_perempuan');
    if (pctLEl) pctLEl.textContent = (tot > 0 ? (Math.round(l/tot*1000)/10) : 0) + '% dari total';
    if (pctPEl) pctPEl.textContent = (tot > 0 ? (Math.round(p/tot*1000)/10) : 0) + '% dari total';
}

// Hitung kelompok umur 4 kategori
function hitungUmur4(key) {
    const lEl = document.querySelector(`.umur4-input[data-key="${key}"][data-gender="l"]`);
    const pEl = document.querySelector(`.umur4-input[data-key="${key}"][data-gender="p"]`);
    const l = parseInt(lEl?.value) || 0;
    const p = parseInt(pEl?.value) || 0;
    document.getElementById('umur4_nilai_' + key).value = l + p;
    document.getElementById('umur4_teks_' + key).value = l + '|' + p;
}

// Hitung status perkawinan
function hitungKawin(key) {
    const lEl = document.querySelector(`.kawin-input[data-key="${key}"][data-gender="l"]`);
    const pEl = document.querySelector(`.kawin-input[data-key="${key}"][data-gender="p"]`);
    const l = parseInt(lEl?.value) || 0;
    const p = parseInt(pEl?.value) || 0;
    document.getElementById('kawin_nilai_' + key).value = l + p;
    document.getElementById('kawin_teks_' + key).value = l + '|' + p;
}

</script>
@endpush