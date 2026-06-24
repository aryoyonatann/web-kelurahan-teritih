@extends('Admin.layouts.app')

@section('title', 'Pengaturan Kelurahan')

@push('styles')
<link rel="icon" type="image/png" href="{{ asset('images/logo kota serang.png') }}">
<style>
.back-bar{display:flex;align-items:center;gap:8px;padding:14px 32px;background:white;border-bottom:1px solid #e2e8f0;font-size:13px}
.back-btn{display:inline-flex;align-items:center;gap:6px;color:#64748b;text-decoration:none;font-weight:600;padding:5px 10px;border-radius:7px;transition:all .15s}
.back-btn:hover{background:#f1f5f9;color:#2563eb}
.bc-sep{color:#cbd5e1}.bc-cur{color:#0f172a;font-weight:600}
.pg-hero{background:linear-gradient(135deg,#1e3a8a 0%,#2563eb 60%,#3b82f6 100%);padding:28px 32px;display:flex;align-items:center;justify-content:space-between;gap:20px;flex-wrap:wrap}
.pg-hero-text h1{font-size:22px;font-weight:800;color:white;margin:0 0 4px}
.pg-hero-text p{font-size:13px;color:rgba(255,255,255,.75);margin:0}
.pg-hero-icon{width:56px;height:56px;border-radius:16px;background:rgba(255,255,255,.18);border:1.5px solid rgba(255,255,255,.25);display:flex;align-items:center;justify-content:center;font-size:26px;color:white;flex-shrink:0}

.pg-layout{display:grid;grid-template-columns:280px 1fr;gap:24px;padding:28px 32px;max-width:1100px;align-items:start}
@media(max-width:860px){.pg-layout{grid-template-columns:1fr;padding:20px 16px}}

/* Sidebar */
.sidebar-card{background:white;border-radius:16px;border:1px solid #e2e8f0;overflow:hidden;position:sticky;top:80px}
.sidebar-card-top{background:linear-gradient(135deg,#1e3a8a,#2563eb);padding:24px;text-align:center}
.sidebar-avatar{width:80px;height:80px;border-radius:50%;object-fit:cover;border:3px solid rgba(255,255,255,.4);margin:0 auto 12px;display:block}
.sidebar-avatar-placeholder{width:80px;height:80px;border-radius:50%;background:rgba(255,255,255,.2);border:3px solid rgba(255,255,255,.4);margin:0 auto 12px;display:flex;align-items:center;justify-content:center;color:white;font-size:32px}
.sidebar-nama{font-size:15px;font-weight:700;color:white;margin:0 0 4px}
.sidebar-jabatan{font-size:12px;color:rgba(255,255,255,.75);margin:0}
.sidebar-badge{display:inline-flex;align-items:center;gap:4px;margin-top:10px;padding:3px 10px;background:rgba(255,255,255,.2);border-radius:999px;font-size:10px;font-weight:700;color:white;text-transform:uppercase;letter-spacing:.05em}
.sidebar-info{padding:16px}
.sidebar-info-item{display:flex;align-items:center;gap:10px;padding:8px 0;border-bottom:1px solid #f1f5f9;font-size:12.5px;color:#64748b}
.sidebar-info-item:last-child{border-bottom:none}
.sidebar-info-item i{font-size:14px;color:#2563eb;flex-shrink:0;width:16px;text-align:center}
.sidebar-info-item span{color:#0f172a;font-weight:600}

/* Main form */
.form-card{background:white;border-radius:16px;border:1px solid #e2e8f0;margin-bottom:20px;overflow:hidden}
.form-card-header{padding:16px 22px;border-bottom:1px solid #f1f5f9;display:flex;align-items:center;gap:10px}
.form-card-header-icon{width:34px;height:34px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:16px;flex-shrink:0}
.form-card-header h3{font-size:14px;font-weight:700;color:#0f172a;margin:0 0 2px}
.form-card-header p{font-size:11.5px;color:#94a3b8;margin:0}
.form-card-body{padding:22px}
.form-label{font-size:12px;font-weight:600;color:#374151;margin-bottom:5px;display:block}
.form-control{border:1.5px solid #e2e8f0;border-radius:10px;padding:10px 14px;font-size:13px;font-family:inherit;transition:border-color .15s;width:100%;background:white;color:#0f172a}
.form-control:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.1);outline:none}
.form-hint{font-size:11px;color:#94a3b8;margin-top:4px}
.form-error{font-size:11.5px;color:#dc2626;margin-top:4px}

/* Foto upload area */
.foto-upload-area{display:flex;align-items:center;gap:16px;padding:14px;background:#f8fafc;border-radius:12px;border:1.5px dashed #cbd5e1;transition:border-color .15s}
.foto-upload-area:hover{border-color:#93c5fd}
.foto-thumb{width:64px;height:64px;border-radius:50%;object-fit:cover;border:2.5px solid #e2e8f0;flex-shrink:0}
.foto-thumb-placeholder{width:64px;height:64px;border-radius:50%;background:#e2e8f0;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:24px;flex-shrink:0}
.btn-pilih-foto{display:inline-flex;align-items:center;gap:6px;padding:8px 14px;border-radius:8px;border:1.5px solid #bfdbfe;background:#eff6ff;color:#2563eb;font-size:12.5px;font-weight:600;cursor:pointer;font-family:inherit;transition:all .15s}
.btn-pilih-foto:hover{background:#dbeafe}

/* Pegawai item */
.pegawai-item{background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px;margin-bottom:12px;display:grid;grid-template-columns:auto 1fr auto;gap:14px;align-items:start}
.pegawai-item:last-child{margin-bottom:0}
.pegawai-avatar{width:52px;height:52px;border-radius:50%;object-fit:cover;border:2px solid #e2e8f0;flex-shrink:0}
.pegawai-avatar-placeholder{width:52px;height:52px;border-radius:50%;background:#e2e8f0;display:flex;align-items:center;justify-content:center;color:#94a3b8;font-size:20px}
.pegawai-role{font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#2563eb;margin-bottom:8px}
.pegawai-inputs{display:grid;grid-template-columns:1fr 1fr;gap:8px}
@media(max-width:580px){.pegawai-inputs{grid-template-columns:1fr}}
.pegawai-foto-label{display:inline-flex;align-items:center;gap:5px;padding:6px 12px;border-radius:7px;border:1.5px solid #e2e8f0;background:white;color:#64748b;font-size:11.5px;font-weight:600;cursor:pointer;transition:all .15s;white-space:nowrap}
.pegawai-foto-label:hover{border-color:#93c5fd;color:#2563eb}
input[type=file].hidden-file{display:none}

/* Save btn */
.btn-save{display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border-radius:11px;border:none;background:linear-gradient(135deg,#1e3a8a,#2563eb);color:white;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;transition:all .15s;box-shadow:0 4px 12px rgba(37,99,235,.25)}
.btn-save:hover{transform:translateY(-1px);box-shadow:0 6px 18px rgba(37,99,235,.35)}

.alert-success{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:10px;margin-bottom:20px;background:#ecfdf5;border:1px solid #6ee7b7;font-size:13px;color:#065f46;font-weight:500}
.alert-error{background:#fef2f2;border:1px solid #fca5a5;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:13px;color:#dc2626}
</style>
@endpush

@section('content')
@include('Admin.partials.header')

<div class="back-bar">
    <a href="{{ route('admin.dashboard') }}" class="back-btn"><i class="bi bi-arrow-left"></i> Dashboard</a>
    <span class="bc-sep">/</span>
    <span class="bc-cur">Pengaturan</span>
</div>

<div class="pg-hero">
    <div class="pg-hero-text">
        <h1>Pengaturan Kelurahan</h1>
        <p>Kelola foto, profil kepala kelurahan, dan data pegawai struktur organisasi.</p>
    </div>
    <div class="pg-hero-icon"><i class="bi bi-gear-fill"></i></div>
</div>

<form action="{{ route('admin.pengaturan.update') }}" method="POST" enctype="multipart/form-data" id="mainForm">
@csrf
@method('PUT')

<div class="pg-layout">

    {{-- ── Sidebar ── --}}
    <div>
        <div class="sidebar-card">
            <div class="sidebar-card-top">
                @if($fotoLurah)
                    <img src="{{ asset('storage/'.$fotoLurah) }}" class="sidebar-avatar" id="sidebarFoto" alt="Foto Lurah">
                @else
                    <div class="sidebar-avatar-placeholder" id="sidebarPlaceholder"><i class="bi bi-person-fill"></i></div>
                    <img src="" class="sidebar-avatar" id="sidebarFoto" style="display:none" alt="">
                @endif
                <div class="sidebar-nama" id="sidebarNama">{{ $namaLurah ?: 'Nama Lurah' }}</div>
                <div class="sidebar-jabatan" id="sidebarJabatan">{{ $jabatLurah ?: 'Jabatan' }}</div>
                <div class="sidebar-badge"><i class="bi bi-patch-check-fill"></i> Kelurahan Teritih</div>
            </div>
            <div class="sidebar-info">
                <div class="sidebar-info-item"><i class="bi bi-geo-alt-fill"></i><div>Kel. Teritih, Kec. Walantaka <span>Kota Serang</span></div></div>
                <div class="sidebar-info-item"><i class="bi bi-clock-fill"></i><div>Jam Operasional <span>Senin–Jumat 08.00–16.00</span></div></div>
                <div class="sidebar-info-item"><i class="bi bi-instagram"></i><div>@kelurahanteritih</div></div>
            </div>
        </div>
    </div>

    {{-- ── Main ── --}}
    <div>
        @if(session('success'))
            <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif
        @if($errors->any())
            <div class="alert-error"><strong>Terjadi kesalahan:</strong><ul style="margin:6px 0 0;padding-left:18px">@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>
        @endif

        {{-- Profil Lurah --}}
        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon" style="background:#eff6ff;color:#2563eb"><i class="bi bi-person-badge-fill"></i></div>
                <div>
                    <h3>Profil Kepala Kelurahan</h3>
                    <p>Informasi yang tampil di halaman Beranda</p>
                </div>
            </div>
            <div class="form-card-body">
                {{-- Foto --}}
                <div class="mb-4">
                    <label class="form-label">Foto Kepala Kelurahan</label>
                    <div class="foto-upload-area" onclick="document.getElementById('fotoInput').click()" style="cursor:pointer">
                        @if($fotoLurah)
                            <img src="{{ asset('storage/'.$fotoLurah) }}" class="foto-thumb" id="fotoPreview" alt="">
                        @else
                            <div class="foto-thumb-placeholder" id="fotoPlaceholder"><i class="bi bi-person-fill"></i></div>
                            <img src="" class="foto-thumb" id="fotoPreview" style="display:none" alt="">
                        @endif
                        <div>
                            <div class="btn-pilih-foto"><i class="bi bi-cloud-upload"></i> Pilih Foto Baru</div>
                            <div class="form-hint" style="margin-top:6px">JPG / PNG / WEBP · Maks 2MB · Kosongkan jika tidak ingin mengganti</div>
                            @error('foto_lurah')<div class="form-error">{{ $message }}</div>@enderror
                        </div>
                        <input type="file" id="fotoInput" name="foto_lurah" accept="image/*" class="hidden-file">
                    </div>
                </div>

                <div style="display:grid;grid-template-columns:1fr 1fr;gap:16px">
                    <div>
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="nama_lurah" value="{{ old('nama_lurah', $namaLurah) }}" class="form-control" placeholder="Nama lengkap beserta gelar" oninput="document.getElementById('sidebarNama').textContent=this.value||'Nama Lurah'">
                        @error('nama_lurah')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <label class="form-label">Jabatan</label>
                        <input type="text" name="jabat_lurah" value="{{ old('jabat_lurah', $jabatLurah) }}" class="form-control" placeholder="Contoh: Kepala Kelurahan Teritih" oninput="document.getElementById('sidebarJabatan').textContent=this.value||'Jabatan'">
                        @error('jabat_lurah')<div class="form-error">{{ $message }}</div>@enderror
                    </div>
                </div>
            </div>
        </div>

        {{-- Pegawai --}}
        @php
        $nodeLabels = [
            'lurah'          => 'Kepala Kelurahan',
            'sekretaris'     => 'Sekretaris Kelurahan',
            'kasi-pemum'     => 'Kasi Pemum',
            'pelaksana'      => 'Pelaksana Pelayanan Umum',
            'op-sanusi'      => 'Operator Layanan (Sanusi)',
            'op-hawari'      => 'Operator Layanan (Hawari)',
            'kasi-pmk'       => 'Kasi PMK',
            'op-hasan'       => 'Penata Layanan (Hasan Gaus)',
            'kasi-trantibum' => 'Kasi Trantibum',
            'op-afif'        => 'Operator Layanan (Afif)',
            'op-jamaludin'   => 'Pengelola Umum (Jamaludin)',
        ];
        @endphp

        <div class="form-card">
            <div class="form-card-header">
                <div class="form-card-header-icon" style="background:#f0fdf4;color:#16a34a"><i class="bi bi-diagram-3-fill"></i></div>
                <div>
                    <h3>Data Pegawai Struktur Organisasi</h3>
                    <p>Nama, NIP, dan foto masing-masing pegawai</p>
                </div>
            </div>
            <div class="form-card-body">
                @foreach($nodeKeys as $key)
                @php $p = $pegawai[$key]; $label = $nodeLabels[$key] ?? $key; @endphp
                <div class="pegawai-item">
                    <div id="prev-wrap-{{ $key }}">
                        @if($p['foto'])
                            <img src="{{ asset('storage/'.$p['foto']) }}" id="prev-{{ $key }}" class="pegawai-avatar" alt="">
                        @else
                            <div id="prev-{{ $key }}" class="pegawai-avatar-placeholder"><i class="bi bi-person-fill"></i></div>
                        @endif
                    </div>
                    <div>
                        <div class="pegawai-role">{{ $label }}</div>
                        <div class="pegawai-inputs">
                            <div>
                                <input type="text" name="pegawai[{{ $key }}][nama]"
                                    value="{{ old('pegawai.'.$key.'.nama', $p['nama']) }}"
                                    class="form-control" placeholder="Nama lengkap" style="font-size:12.5px">
                            </div>
                            <div>
                                <input type="text" name="pegawai[{{ $key }}][nip]"
                                    value="{{ old('pegawai.'.$key.'.nip', $p['nip']) }}"
                                    class="form-control" placeholder="NIP" style="font-size:12.5px">
                            </div>
                        </div>
                    </div>
                    <div style="padding-top:22px">
                        <label class="pegawai-foto-label" for="foto-{{ $key }}"><i class="bi bi-image"></i> Foto</label>
                        <input type="file" name="pegawai_foto[{{ $key }}]" id="foto-{{ $key }}" accept="image/*"
                            data-key="{{ $key }}" class="hidden-file pegawai-foto-input">
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        <button type="submit" class="btn-save"><i class="bi bi-floppy-fill"></i> Simpan Semua Perubahan</button>
    </div>
</div>
</form>
@endsection

@push('scripts')
<script>
document.getElementById('fotoInput').addEventListener('change', function(){
    const file = this.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const preview = document.getElementById('fotoPreview');
        const placeholder = document.getElementById('fotoPlaceholder');
        const sidebar = document.getElementById('sidebarFoto');
        const sidebarPh = document.getElementById('sidebarPlaceholder');
        preview.src = e.target.result;
        preview.style.display = 'block';
        sidebar.src = e.target.result;
        sidebar.style.display = 'block';
        if (placeholder) placeholder.style.display = 'none';
        if (sidebarPh) sidebarPh.style.display = 'none';
    };
    reader.readAsDataURL(file);
});

document.querySelectorAll('.pegawai-foto-input').forEach(input => {
    input.addEventListener('change', function(){
        const key = this.dataset.key;
        const file = this.files[0];
        if (!file) return;
        const reader = new FileReader();
        reader.onload = e => {
            const wrap = document.getElementById('prev-wrap-' + key);
            wrap.innerHTML = `<img id="prev-${key}" class="pegawai-avatar" src="${e.target.result}" alt="">`;
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush
