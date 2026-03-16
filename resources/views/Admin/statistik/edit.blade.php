@extends('admin.layouts.app')

@section('title', 'Edit Statistik Demografi')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
<style>
body{font-family:'Plus Jakarta Sans',sans-serif;background:#f1f5f9}
.back-bar{display:flex;align-items:center;gap:8px;padding:14px 32px;background:white;border-bottom:1px solid #e2e8f0;font-size:13px}
.back-btn{display:inline-flex;align-items:center;gap:6px;color:#64748b;text-decoration:none;font-weight:600;padding:5px 10px;border-radius:7px;transition:all .15s}
.back-btn:hover{background:#f1f5f9;color:#1c64f2}
.bc-sep{color:#cbd5e1}.bc-cur{color:#0f172a;font-weight:600}
.stat-hero{background:linear-gradient(135deg,#0f766e 0%,#0d9488 50%,#14b8a6 100%);padding:28px 32px;position:relative;overflow:hidden}
.stat-hero h1{font-size:22px;font-weight:800;color:white;margin:0 0 4px;position:relative;z-index:1}
.stat-hero p{font-size:13px;color:rgba(255,255,255,.75);margin:0;position:relative;z-index:1}
.stat-content{padding:28px 32px;max-width:900px}
.alert-success{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:10px;margin-bottom:20px;background:#ecfdf5;border:1px solid #6ee7b7;font-size:13px;color:#065f46;font-weight:500}
.group-card{background:white;border-radius:14px;border:1px solid #e2e8f0;overflow:hidden;box-shadow:0 1px 3px rgba(0,0,0,.06);margin-bottom:20px}
.group-header{padding:14px 20px;border-bottom:1px solid #e2e8f0;background:#f8fafc;display:flex;align-items:center;gap:10px}
.group-icon{width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:16px}
.group-title{font-size:14px;font-weight:700;color:#0f172a}
.group-body{padding:20px;display:flex;flex-direction:column;gap:14px}
.stat-row{display:grid;grid-template-columns:1fr 180px;gap:12px;align-items:start;padding:14px 16px;border-radius:10px;background:#f8fafc;border:1px solid #e2e8f0}
.stat-row-label{font-size:11.5px;font-weight:700;color:#374151;text-transform:uppercase;letter-spacing:.05em;margin-bottom:6px}
.stat-input{width:100%;padding:9px 12px;border:1.5px solid #e2e8f0;border-radius:8px;font-size:13px;font-family:inherit;color:#0f172a;background:white;outline:none;transition:all .18s;box-sizing:border-box}
.stat-input:focus{border-color:#0d9488;box-shadow:0 0 0 3px rgba(13,148,136,.1)}
.pct-badge{display:inline-flex;align-items:center;gap:5px;padding:4px 10px;border-radius:8px;font-size:13px;font-weight:700;background:#ecfdf5;color:#065f46;margin-top:6px}
.pct-note{font-size:11px;color:#94a3b8;margin-top:4px}
.form-footer{padding:16px 20px;background:#f8fafc;border-top:1px solid #e2e8f0;display:flex;align-items:center;justify-content:flex-end;gap:10px}
.btn-batal{display:inline-flex;align-items:center;gap:6px;padding:9px 18px;border-radius:9px;border:1.5px solid #e2e8f0;background:white;font-size:13px;font-weight:600;color:#64748b;text-decoration:none;cursor:pointer;transition:all .15s}
.btn-batal:hover{background:#f8fafc;color:#334155}
.btn-simpan{display:inline-flex;align-items:center;gap:6px;padding:9px 22px;border-radius:9px;border:none;background:#0d9488;font-size:13px;font-weight:700;color:white;cursor:pointer;transition:all .15s}
.btn-simpan:hover{background:#0f766e}
@media(max-width:640px){.stat-content{padding:20px 16px}.stat-row{grid-template-columns:1fr}}
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
        <h1><i class="bi bi-bar-chart-fill me-2"></i>Edit Statistik Demografi</h1>
        <p>Isi jumlah jiwa — persentase dihitung otomatis</p>
    </div>

    <div class="stat-content">

        @if(session('success'))
        <div class="alert-success"><i class="bi bi-check-circle-fill"></i> {{ session('success') }}</div>
        @endif

        <form action="{{ route('admin.statistik.update') }}" method="POST">
        @csrf @method('PUT')

        {{-- KEPENDUDUKAN UTAMA --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#eff6ff;color:#1c64f2"><i class="bi bi-people-fill"></i></div>
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
                        <input type="number" name="statistik[{{ $kunci }}][nilai]"
                               class="stat-input" value="{{ $s->nilai }}" min="0" required>
                    </div>
                    <div style="padding-top:22px">
                        <div class="pct-badge"><i class="bi bi-hash"></i> {{ number_format($s->nilai) }}</div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        {{-- GENDER --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#fdf4ff;color:#a855f7"><i class="bi bi-gender-ambiguous"></i></div>
                <div class="group-title">Komposisi Gender</div>
            </div>
            <div class="group-body">
                @php
                    $laki = $statistik['jiwa_lakilaki']->nilai ?? 0;
                    $perempuan = $statistik['jiwa_perempuan']->nilai ?? 0;
                    $totalGender = $laki + $perempuan;
                @endphp
                <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:12px 16px;font-size:12px;color:#1e40af;display:flex;align-items:center;gap:8px">
                    <i class="bi bi-info-circle-fill"></i>
                    Isi jumlah jiwa laki-laki dan perempuan — persentase dihitung otomatis dari totalnya.
                </div>
                @foreach(['jiwa_lakilaki','jiwa_perempuan'] as $kunci)
                @php $s = $statistik[$kunci] ?? null; @endphp
                @if($s)
                <div class="stat-row">
                    <div>
                        <div class="stat-row-label">{{ $s->label }} (Jiwa)</div>
                        <input type="hidden" name="statistik[{{ $kunci }}][label]" value="{{ $s->label }}">
                        <input type="number" name="statistik[{{ $kunci }}][nilai]"
                               id="input_{{ $kunci }}"
                               class="stat-input gender-input"
                               value="{{ $s->nilai }}" min="0" required
                               oninput="hitungGender()">
                        <div class="pct-note">Preview: <span id="pct_{{ $kunci }}">{{ $totalGender > 0 ? round($s->nilai / $totalGender * 100, 1) : 0 }}%</span></div>
                    </div>
                    <div style="padding-top:22px">
                        <div class="pct-badge" id="badge_{{ $kunci }}">
                            <i class="bi bi-percent"></i>
                            {{ $totalGender > 0 ? round($s->nilai / $totalGender * 100, 1) : 0 }}%
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        {{-- AGAMA --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#ecfdf5;color:#10b981"><i class="bi bi-people-fill"></i></div>
                <div class="group-title">Sebaran Agama</div>
            </div>
            <div class="group-body">
                @php
                    $agamaKeys = ['jiwa_islam','jiwa_kristen','jiwa_katolik','jiwa_lainnya'];
                    $totalAgama = collect($agamaKeys)->sum(fn($k) => $statistik[$k]->nilai ?? 0);
                @endphp
                <div style="background:#eff6ff;border:1px solid #bfdbfe;border-radius:10px;padding:12px 16px;font-size:12px;color:#1e40af;display:flex;align-items:center;gap:8px">
                    <i class="bi bi-info-circle-fill"></i>
                    Isi jumlah jiwa per agama — persentase dihitung otomatis dari total semua agama.
                </div>
                @foreach($agamaKeys as $kunci)
                @php $s = $statistik[$kunci] ?? null; @endphp
                @if($s)
                <div class="stat-row">
                    <div>
                        <div class="stat-row-label">{{ $s->label }} (Jiwa)</div>
                        <input type="hidden" name="statistik[{{ $kunci }}][label]" value="{{ $s->label }}">
                        <input type="number" name="statistik[{{ $kunci }}][nilai]"
                               id="input_{{ $kunci }}"
                               class="stat-input agama-input"
                               value="{{ $s->nilai }}" min="0" required
                               oninput="hitungAgama()">
                        <div class="pct-note">Preview: <span id="pct_{{ $kunci }}">{{ $totalAgama > 0 ? round($s->nilai / $totalAgama * 100, 1) : 0 }}%</span></div>
                    </div>
                    <div style="padding-top:22px">
                        <div class="pct-badge" id="badge_{{ $kunci }}">
                            <i class="bi bi-percent"></i>
                            <span id="badge_val_{{ $kunci }}">{{ $totalAgama > 0 ? round($s->nilai / $totalAgama * 100, 1) : 0 }}</span>%
                        </div>
                    </div>
                </div>
                @endif
                @endforeach
            </div>
        </div>

        {{-- UPDATE TERAKHIR --}}
        <div class="group-card">
            <div class="group-header">
                <div class="group-icon" style="background:#fff7ed;color:#f59e0b"><i class="bi bi-calendar3"></i></div>
                <div class="group-title">Keterangan Update</div>
            </div>
            <div class="group-body">
                @php $s = $statistik['update_terakhir'] ?? null; @endphp
                @if($s)
                <div class="stat-row" style="grid-template-columns:1fr">
                    <div>
                        <div class="stat-row-label">Periode Update (misal: Maret 2026)</div>
                        <input type="hidden" name="statistik[update_terakhir][label]" value="{{ $s->label }}">
                        <input type="hidden" name="statistik[update_terakhir][nilai]" value="0">
                        <input type="text" name="statistik[update_terakhir][nilai_teks]"
                               class="stat-input" value="{{ $s->nilai_teks }}"
                               placeholder="cth: Maret 2026" required>
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
function hitungGender() {
    const laki      = parseFloat(document.getElementById('input_jiwa_lakilaki').value)   || 0;
    const perempuan = parseFloat(document.getElementById('input_jiwa_perempuan').value)  || 0;
    const total     = laki + perempuan;
    if (total <= 0) return;

    const pLaki      = Math.round(laki      / total * 1000) / 10;
    const pPerempuan = Math.round(perempuan / total * 1000) / 10;

    document.getElementById('pct_jiwa_lakilaki').textContent   = pLaki + '%';
    document.getElementById('pct_jiwa_perempuan').textContent  = pPerempuan + '%';
    document.getElementById('badge_jiwa_lakilaki').innerHTML   = '<i class="bi bi-percent"></i> ' + pLaki + '%';
    document.getElementById('badge_jiwa_perempuan').innerHTML  = '<i class="bi bi-percent"></i> ' + pPerempuan + '%';
}

function hitungAgama() {
    const keys  = ['jiwa_islam','jiwa_kristen','jiwa_katolik','jiwa_lainnya'];
    const total = keys.reduce((s, k) => s + (parseFloat(document.getElementById('input_'+k)?.value) || 0), 0);
    if (total <= 0) return;

    keys.forEach(k => {
        const val  = parseFloat(document.getElementById('input_'+k)?.value) || 0;
        const pct  = Math.round(val / total * 1000) / 10;
        const pctEl = document.getElementById('pct_'+k);
        const valEl = document.getElementById('badge_val_'+k);
        if (pctEl) pctEl.textContent  = pct + '%';
        if (valEl) valEl.textContent  = pct;
    });
}
</script>
@endpush