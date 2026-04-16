@extends('admin.layouts.app')

@section('title', 'Edit Statistik Demografi')

@push('styles')
<link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
body{font-family:'Plus Jakarta Sans',sans-serif;background:#f1f5f9}
.back-bar{display:flex;align-items:center;gap:8px;padding:14px 32px;background:white;border-bottom:1px solid #e2e8f0;font-size:13px}
.back-btn{display:inline-flex;align-items:center;gap:6px;color:#64748b;text-decoration:none;font-weight:600;padding:5px 10px;border-radius:7px;transition:all .15s}
.back-btn:hover{background:#f1f5f9;color:#2563eb}
.bc-sep{color:#cbd5e1}.bc-cur{color:#0f172a;font-weight:600}

/* ── HERO — unified blue ── */
.stat-hero{
    background: linear-gradient(135deg, #1e3a8a 0%, #2563eb 50%, #3b82f6 100%);
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
.stat-input:focus{border-color:#2563eb;box-shadow:0 0 0 3px rgba(37,99,235,.1)}
.pct-badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:8px;font-size:13px;font-weight:700;background:#ecfdf5;color:#065f46;margin-top:6px}
.pct-note{font-size:11px;color:#94a3b8;margin-top:4px}
.form-footer{padding:16px 20px;background:#f8fafc;border-top:1px solid #e2e8f0;display:flex;align-items:center;justify-content:flex-end;gap:10px}
.btn-batal{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:9px;border:1.5px solid #e2e8f0;background:white;font-size:13px;font-weight:600;color:#64748b;text-decoration:none;cursor:pointer;transition:all .15s}
.btn-batal:hover{background:#f8fafc}
.btn-simpan{display:inline-flex;align-items:center;gap:6px;padding:9px 22px;border-radius:9px;border:none;background:#2563eb;font-size:13px;font-weight:700;color:white;cursor:pointer;transition:all .15s}
.btn-simpan:hover{background:#1d4ed8}
.info-box{background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:12px 16px;font-size:12px;color:#1e40af;display:flex;align-items:center;gap:8px}

/* Kelompok umur */
.umur-grid{display:grid;grid-template-columns:1fr 1fr;gap:12px}
.umur-row{padding:12px 16px;border-radius:10px;background:#f8fafc;border:1px solid #e2e8f0}
.umur-row-label{font-size:12px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.04em;margin-bottom:8px}
.umur-sub{display:grid;grid-template-columns:1fr 1fr;gap:8px}
.umur-sub label{font-size:11px;color:#64748b;font-weight:600;margin-bottom:3px;display:block}

@media(max-width:640px){
    .stat-content{padding:20px 16px}
    .stat-row{grid-template-columns:1fr}
    .umur-grid{grid-template-columns:1fr}
}
</style>
@endpush

@section('content')
@include('admin.partials.header')

<div>
    <div class="back-bar">
        <a href="{{ route('admin.dashboard') }}" class="back-btn"><i class="bi bi-arrow-left"></i> Kembali</a>
        <span class="bc-sep">/</span><span class="bc-cur">Statistik Demografi</span>
    </div>

    <div class="stat-hero">
        <div class="stat-hero-content">
            <h1><i class="bi bi-bar-chart-fill me-2"></i>Edit Statistik Demografi</h1>
            <p>Isi jumlah jiwa — persentase dihitung otomatis oleh sistem</p>
        </div>
    </div>

    <div class="stat-content">

        @if(session('success'))
        <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.statistik.update') }}" method="POST">
        @csrf @method('PUT')

        {{-- ① KEPENDUDUKAN UTAMA --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#eff6ff;color:#2563eb"><i class="bi bi-people-fill"></i></div>
                <div class="group-title">Data Kependudukan Utama</div>
            </div>
            <div class="group-body">
                @foreach(['total_penduduk','jumlah_kk','jumlah_rt','jumlah_rw'] as $kunci)
                @php $s = $statistik[$kunci] ?? null; @endphp
                @if($s)
                <div class="stat-row">
                    <div>
                        <div class="stat-row-label">{{ $s->label }}</div>
                        <input type="hidden" name="statistik[{{ $kunci }}][label]" value="{{ $s->label }}">
                        <input type="number" name="statistik[{{ $kunci }}][nilai]" class="stat-input" value="{{ $s->nilai }}" min="0" required>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        {{-- ② AGAMA — 7 jenis --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#ecfdf5;color:#10b981"><i class="bi bi-stars"></i></div>
                <div class="group-title">Sebaran Agama (7 Jenis)</div>
            </div>
            <div class="group-body">
                @php
                    $agamaKeys = ['jiwa_islam','jiwa_kristen','jiwa_katolik','jiwa_hindu','jiwa_buddha','jiwa_konghucu','jiwa_lainnya'];
                    $totalA    = collect($agamaKeys)->sum(fn($k) => $statistik[$k]->nilai ?? 0);
                    $agamaColors = ['jiwa_islam'=>'#10b981','jiwa_kristen'=>'#2563eb','jiwa_katolik'=>'#f59e0b',
                                    'jiwa_hindu'=>'#a855f7','jiwa_buddha'=>'#06b6d4','jiwa_konghucu'=>'#ef4444','jiwa_lainnya'=>'#94a3b8'];
                @endphp
                <div class="info-box"><i class="bi bi-info-circle-fill"></i> Isi jumlah jiwa per agama — persentase dihitung otomatis dari total semua agama.</div>
                @foreach($agamaKeys as $kunci)
                @php
                    $defaultLabels = ['jiwa_islam'=>'Islam','jiwa_kristen'=>'Kristen','jiwa_katolik'=>'Katolik',
                                      'jiwa_hindu'=>'Hindu','jiwa_buddha'=>'Buddha','jiwa_konghucu'=>'Konghucu','jiwa_lainnya'=>'Kepercayaan Lainnya'];
                    $s = $statistik[$kunci] ?? null;
                    $sLabel = $s ? $s->label : ($defaultLabels[$kunci] ?? $kunci);
                    $sNilai = $s ? $s->nilai : 0;
                @endphp
                <div class="stat-row">
                    <div>
                        <div class="stat-row-label" style="color:{{ $agamaColors[$kunci] ?? '#334155' }}">
                            <span style="display:inline-block;width:10px;height:10px;border-radius:2px;background:{{ $agamaColors[$kunci] ?? '#94a3b8' }};margin-right:6px;vertical-align:middle"></span>
                            {{ $sLabel }} (Jiwa)
                        </div>
                        <input type="hidden" name="statistik[{{ $kunci }}][label]" value="{{ $sLabel }}">
                        <input type="number" name="statistik[{{ $kunci }}][nilai]"
                               id="input_{{ $kunci }}" class="stat-input agama-input"
                               value="{{ $sNilai }}" min="0" required oninput="hitungAgama()">
                        <div class="pct-note">Preview: <span id="pct_{{ $kunci }}">{{ $totalA > 0 ? round($sNilai / $totalA * 100, 1) : 0 }}%</span></div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>

        {{-- ③ KELOMPOK UMUR --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#fff7ed;color:#f59e0b"><i class="bi bi-people"></i></div>
                <div class="group-title">Kelompok Umur (Piramida Penduduk)</div>
            </div>
            <div class="group-body">
                <div class="info-box"><i class="bi bi-info-circle-fill"></i> Isi jumlah Laki-laki dan Perempuan per kelompok umur untuk grafik piramida.</div>
                @php
                $umurGroups = [
                    'umur_0_4'   =>'0 – 4 Tahun',  'umur_5_9'   =>'5 – 9 Tahun',
                    'umur_10_14' =>'10 – 14 Tahun', 'umur_15_19' =>'15 – 19 Tahun',
                    'umur_20_24' =>'20 – 24 Tahun', 'umur_25_29' =>'25 – 29 Tahun',
                    'umur_30_34' =>'30 – 34 Tahun', 'umur_35_39' =>'35 – 39 Tahun',
                    'umur_40_44' =>'40 – 44 Tahun', 'umur_45_49' =>'45 – 49 Tahun',
                    'umur_50_54' =>'50 – 54 Tahun', 'umur_55_59' =>'55 – 59 Tahun',
                    'umur_60_64' =>'60 – 64 Tahun', 'umur_65_69' =>'65 – 69 Tahun',
                    'umur_70_74' =>'70 – 74 Tahun', 'umur_75_plus'=>'75+ Tahun',
                ];
                @endphp
                <div class="umur-grid">
                    @foreach($umurGroups as $kunci => $labelGrp)
                    <div class="umur-row">
                        <div class="umur-row-label">🕐 {{ $labelGrp }}</div>
                        <div class="umur-sub">
                            <div>
                                <label>👨 Laki-laki</label>
                                <input type="hidden" name="statistik[{{ $kunci }}_l][label]" value="{{ $labelGrp }} - Laki-laki">
                                <input type="number" name="statistik[{{ $kunci }}_l][nilai]" class="stat-input"
                                       value="{{ $statistik[$kunci.'_l']->nilai ?? 0 }}" min="0" placeholder="0">
                            </div>
                            <div>
                                <label>👩 Perempuan</label>
                                <input type="hidden" name="statistik[{{ $kunci }}_p][label]" value="{{ $labelGrp }} - Perempuan">
                                <input type="number" name="statistik[{{ $kunci }}_p][nilai]" class="stat-input"
                                       value="{{ $statistik[$kunci.'_p']->nilai ?? 0 }}" min="0" placeholder="0">
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>

        {{-- ④ UPDATE TERAKHIR --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#fff7ed;color:#f59e0b"><i class="bi bi-calendar3"></i></div>
                <div class="group-title">Keterangan Update</div>
            </div>
            <div class="group-body">
                @php
                    $s = $statistik['update_terakhir'] ?? null;
                    $bulanMap = ['Januari'=>'01','Februari'=>'02','Maret'=>'03','April'=>'04','Mei'=>'05','Juni'=>'06',
                                 'Juli'=>'07','Agustus'=>'08','September'=>'09','Oktober'=>'10','November'=>'11','Desember'=>'12'];
                    $nilaiTeks = $s->nilai_teks ?? '';
                    $monthVal  = '';
                    if ($nilaiTeks) {
                        $parts = explode(' ', $nilaiTeks);
                        if (count($parts) === 2 && isset($bulanMap[$parts[0]])) {
                            $monthVal = $parts[1] . '-' . $bulanMap[$parts[0]];
                        }
                    }
                @endphp
                @if($s)
                <div class="stat-row">
                    <div>
                        <div class="stat-row-label">Periode Update Data</div>
                        <input type="hidden" name="statistik[update_terakhir][label]" value="{{ $s->label }}">
                        <input type="hidden" name="statistik[update_terakhir][nilai]" value="0">
                        <input type="month" name="statistik[update_terakhir][nilai_teks]" class="stat-input" value="{{ $monthVal }}" required>
                        <div style="font-size:11px;color:#94a3b8;margin-top:5px"><i class="bi bi-info-circle me-1"></i>Pilih bulan & tahun — tampil otomatis di halaman publik (misal: Maret 2026)</div>
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

@include('admin.partials.footer')
@endsection

@push('scripts')
<script>
function hitungAgama() {
    const keys = ['jiwa_islam','jiwa_kristen','jiwa_katolik','jiwa_hindu','jiwa_buddha','jiwa_konghucu','jiwa_lainnya'];
    const tot  = keys.reduce((s,k) => s + (parseFloat(document.getElementById('input_'+k)?.value)||0), 0);
    if (tot <= 0) return;
    keys.forEach(k => {
        const val = parseFloat(document.getElementById('input_'+k)?.value) || 0;
        const pct = Math.round(val / tot * 1000) / 10;
        const pEl = document.getElementById('pct_'+k);
        const vEl = document.getElementById('badge_val_'+k);
        if (pEl) pEl.textContent = pct + '%';
        if (vEl) vEl.textContent = pct;
    });
}
</script>
@endpush