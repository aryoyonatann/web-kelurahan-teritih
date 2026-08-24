@extends('Admin.layouts.app')

@section('title', $warga->exists ? 'Edit Warga' : 'Tambah Warga')

@push('styles')<style>
body{font-family:'Plus Jakarta Sans',sans-serif;background:#f1f5f9}
.back-bar{display:flex;align-items:center;gap:8px;padding:14px 32px;background:white;border-bottom:1px solid #e2e8f0;font-size:13px}
.back-btn{display:inline-flex;align-items:center;gap:6px;color:#64748b;text-decoration:none;font-weight:600;padding:5px 10px;border-radius:7px}
.back-btn:hover{background:#f1f5f9;color:#1c64f2}
.bc-sep{color:#cbd5e1}.bc-cur{color:#0f172a;font-weight:600}
.form-hero{background:linear-gradient(135deg,#0d1b3e 0%,#1c64f2 50%,#60a5fa 100%);padding:28px 32px}
.form-hero h1{font-size:22px;font-weight:800;color:white;margin:0 0 4px}
.form-hero p{font-size:13px;color:rgba(255,255,255,.75);margin:0}
.form-content{padding:28px 32px;max-width:760px}
.alert-danger{padding:12px 16px;border-radius:10px;margin-bottom:20px;background:#fef2f2;border:1px solid #fca5a5;font-size:13px;color:#991b1b;font-weight:500}
.card{background:white;border-radius:14px;border:1px solid #e2e8f0;padding:24px;box-shadow:0 1px 3px rgba(0,0,0,.06)}
.grid2{display:grid;grid-template-columns:1fr 1fr;gap:16px}
.field{margin-bottom:16px}
.field label{display:block;font-size:12px;font-weight:700;color:#374151;margin-bottom:6px;text-transform:uppercase;letter-spacing:.04em}
.field input,.field select{width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:14px;font-family:inherit;box-sizing:border-box}
.field input:focus,.field select:focus{outline:none;border-color:#1c64f2;box-shadow:0 0 0 3px rgba(37,99,235,.1)}
.field small{color:#94a3b8;font-size:11px}
.form-footer{margin-top:8px;display:flex;gap:10px;justify-content:flex-end}
.btn-batal{padding:9px 18px;border-radius:9px;border:1.5px solid #e2e8f0;background:white;font-size:13px;font-weight:600;color:#64748b;text-decoration:none}
.btn-simpan{padding:9px 22px;border-radius:9px;border:none;background:#1c64f2;font-size:13px;font-weight:700;color:white;cursor:pointer}
@media(max-width:640px){.grid2{grid-template-columns:1fr}.form-content{padding:20px 16px}}
</style>
@endpush

@section('content')
@include('Admin.partials.header')

<div>
    <div class="back-bar">
        <a href="{{ route('admin.warga.index') }}" class="back-btn"><i class="bi bi-arrow-left"></i> Kembali</a>
        <span class="bc-sep">/</span><span class="bc-cur">{{ $warga->exists ? 'Edit Warga' : 'Tambah Warga' }}</span>
    </div>

    <div class="form-hero">
        <h1><i class="bi bi-person-{{ $warga->exists ? 'lines-fill' : 'plus-fill' }} me-2"></i>{{ $warga->exists ? 'Edit Data Warga' : 'Tambah Warga Baru' }}</h1>
        <p>Perubahan akan langsung memperbarui statistik demografi secara otomatis</p>
    </div>

    <div class="form-content">

        @if($errors->any())
            <div class="alert-danger">
                @foreach($errors->all() as $err)
                    <div>{{ $err }}</div>
                @endforeach
            </div>
        @endif

        <div class="card">
            <form action="{{ $warga->exists ? route('admin.warga.update', $warga) : route('admin.warga.store') }}" method="POST">
                @csrf
                @if($warga->exists) @method('PUT') @endif

                <div class="grid2">
                    <div class="field">
                        <label>Nama Lengkap</label>
                        <input type="text" name="nama" value="{{ old('nama', $warga->nama) }}" required>
                    </div>
                    <div class="field">
                        <label>NIK (opsional)</label>
                        <input type="text" name="nik" value="{{ old('nik', $warga->nik) }}" maxlength="16" placeholder="16 digit">
                    </div>
                </div>

                <div class="grid2">
                    <div class="field">
                        <label>Jenis Kelamin</label>
                        <select name="jenis_kelamin" required>
                            <option value="L" @selected(old('jenis_kelamin', $warga->jenis_kelamin) === 'L')>Laki-laki</option>
                            <option value="P" @selected(old('jenis_kelamin', $warga->jenis_kelamin) === 'P')>Perempuan</option>
                        </select>
                    </div>
                    <div class="field">
                        <label>Tanggal Lahir</label>
                        <input type="date" name="tanggal_lahir" value="{{ old('tanggal_lahir', optional($warga->tanggal_lahir)->format('Y-m-d')) }}" required>
                        <small>Umur & kelompok umur dihitung otomatis dari tanggal ini.</small>
                    </div>
                </div>

                <div class="grid2">
                    <div class="field">
                        <label>Agama</label>
                        <select name="agama" required>
                            @foreach($pilihanAgama as $opt)
                                <option value="{{ $opt }}" @selected(old('agama', $warga->agama) === $opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Status Perkawinan</label>
                        <select name="status_kawin" required>
                            @foreach($pilihanKawin as $opt)
                                <option value="{{ $opt }}" @selected(old('status_kawin', $warga->status_kawin) === $opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid2">
                    <div class="field">
                        <label>Pendidikan Terakhir</label>
                        <select name="pendidikan" required>
                            @foreach($pilihanPendidikan as $opt)
                                <option value="{{ $opt }}" @selected(old('pendidikan', $warga->pendidikan) === $opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Pekerjaan</label>
                        <select name="pekerjaan" required>
                            @foreach($pilihanPekerjaan as $opt)
                                <option value="{{ $opt }}" @selected(old('pekerjaan', $warga->pekerjaan) === $opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="grid2">
                    <div class="field">
                        <label>RT</label>
                        <input type="text" name="rt" value="{{ old('rt', $warga->rt) }}" required placeholder="Misal: 2">
                    </div>
                    <div class="field">
                        <label>RW</label>
                        <input type="text" name="rw" value="{{ old('rw', $warga->rw) }}" required placeholder="Misal: 3">
                    </div>
                </div>

                <div class="grid2">
                    <div class="field">
                        <label>Hubungan dalam Keluarga</label>
                        <select name="hubungan_keluarga" required>
                            @foreach($pilihanHubungan as $opt)
                                <option value="{{ $opt }}" @selected(old('hubungan_keluarga', $warga->hubungan_keluarga) === $opt)>{{ $opt }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="field">
                        <label>Tahun Data <span style="color:#ef4444">*</span></label>
                        <select name="tahun_data" required
                                style="border-color:{{ old('tahun_data', $warga->tahun_data ?? $currentYear) == $currentYear ? '#86efac' : '#fdba74' }}">
                            @foreach($daftarTahun as $thn => $label)
                                <option value="{{ $thn }}"
                                        @selected((int) old('tahun_data', $warga->tahun_data ?? $currentYear) === $thn)
                                        style="{{ $thn == $currentYear ? 'font-weight:700' : '' }}">
                                    {{ $label }}
                                </option>
                            @endforeach
                        </select>
                        <small>
                            @if((int) old('tahun_data', $warga->tahun_data ?? $currentYear) === $currentYear)
                                <span style="color:#059669"><i class="bi bi-database-fill-check"></i> Data warga ini akan masuk ke grafik pertumbuhan tahun {{ $currentYear }}</span>
                            @else
                                <span style="color:#c2410c"><i class="bi bi-clock-history"></i> Data historis — akan masuk ke grafik pertumbuhan tahun yang dipilih</span>
                            @endif
                        </small>
                    </div>
                </div>

                <div class="field">
                    <label>Alamat (opsional)</label>
                    <input type="text" name="alamat" value="{{ old('alamat', $warga->alamat) }}">
                </div>

                <div class="form-footer">
                    <a href="{{ route('admin.warga.index') }}" class="btn-batal">Batal</a>
                    <button type="submit" class="btn-simpan"><i class="bi bi-check-lg"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
(function () {
    const CURRENT_YEAR = {{ $currentYear }};
    const sel  = document.querySelector('select[name="tahun_data"]');
    const hint = sel ? sel.closest('.field').querySelector('small') : null;
    if (!sel || !hint) return;

    function updateTahunHint() {
        const y = parseInt(sel.value);
        if (y === CURRENT_YEAR) {
            sel.style.borderColor = '#86efac';
            hint.innerHTML = '<span style="color:#059669"><i class="bi bi-database-fill-check"></i> Data warga ini akan masuk ke grafik pertumbuhan tahun ' + y + '</span>';
        } else {
            sel.style.borderColor = '#fdba74';
            hint.innerHTML = '<span style="color:#c2410c"><i class="bi bi-clock-history"></i> Data historis — akan masuk ke grafik pertumbuhan tahun ' + y + '</span>';
        }
    }

    sel.addEventListener('change', updateTahunHint);
    updateTahunHint();
})();
</script>
@endpush

@endsection
