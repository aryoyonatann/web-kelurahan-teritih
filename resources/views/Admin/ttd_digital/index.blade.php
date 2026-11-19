@extends('Admin.layouts.app')
@section('title', 'Kelola TTD Digital')

@push('styles')<style>
:root {
    --primary:#1c64f2;--primary-light:#eff6ff;--success:#10b981;--success-light:#ecfdf5;
    --danger:#ef4444;--danger-light:#fef2f2;
    --gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;--gray-400:#94a3b8;
    --gray-700:#334155;--gray-900:#0f172a;--white:#ffffff;
    --radius-md:12px;--radius-lg:16px;--shadow-sm:0 1px 3px rgba(0,0,0,.08);
}
body{background:var(--gray-50);font-family:'Plus Jakarta Sans',sans-serif}
.page{max-width:1100px;margin:0 auto;padding:32px 24px 48px}
.hero{background:linear-gradient(135deg,#0d1b3e 0%,#1c64f2 60%,#60a5fa 100%);border-radius:var(--radius-lg);padding:28px 32px;margin-bottom:24px;display:flex;align-items:center;justify-content:space-between;gap:16px;box-shadow:0 8px 32px rgba(37,99,235,.3)}
.hero h1{font-size:22px;font-weight:800;color:#fff;margin:0 0 4px}
.hero p{font-size:13px;color:rgba(255,255,255,.7);margin:0}
.btn-add{display:inline-flex;align-items:center;gap:7px;padding:10px 20px;border-radius:8px;background:#fff;color:var(--primary);font-size:13px;font-weight:700;text-decoration:none;transition:all .15s}
.btn-add:hover{background:#eff6ff}
.btn-add svg{width:14px;height:14px}
.alert{display:flex;align-items:center;gap:10px;padding:12px 16px;border-radius:10px;margin-bottom:20px;font-size:13px;font-weight:500}
.alert-success{background:#ecfdf5;border:1px solid #6ee7b7;color:#065f46}
.card{background:#fff;border:1px solid var(--gray-200);border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);overflow:hidden}
table{width:100%;border-collapse:collapse}
thead th{padding:12px 18px;text-align:left;font-size:10.5px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:var(--gray-400);background:var(--gray-50);border-bottom:1px solid var(--gray-200)}
tbody tr{border-bottom:1px solid var(--gray-100)}
tbody tr:last-child{border-bottom:none}
tbody tr:hover{background:#f8faff}
tbody td{padding:14px 18px;font-size:13px;color:var(--gray-700);vertical-align:middle}
.ttd-preview{width:120px;height:60px;object-fit:contain;border:1px solid var(--gray-200);border-radius:6px;background:#fafafa;padding:4px}
.badge{display:inline-flex;align-items:center;gap:5px;padding:3px 10px;border-radius:20px;font-size:11px;font-weight:700}
.badge-on{background:#ecfdf5;color:#065f46}
.badge-off{background:var(--gray-100);color:var(--gray-400)}
.action-group{display:flex;gap:6px}
.btn-sm{display:inline-flex;align-items:center;gap:4px;padding:5px 10px;border-radius:6px;font-size:12px;font-weight:700;cursor:pointer;border:none;text-decoration:none;transition:all .15s;font-family:inherit}
.btn-edit{background:#eff6ff;color:#1c64f2}.btn-edit:hover{background:#bfdbfe}
.btn-del{background:#fef2f2;color:#b91c1c}.btn-del:hover{background:#fecaca}
.empty{text-align:center;padding:48px 20px;color:var(--gray-400)}
</style>@endpush

@section('content')
@include('Admin.partials.header')

<div class="page">
    <div class="hero">
        <div>
            <h1>🖊️ Kelola TTD Digital</h1>
            <p>Daftar tanda tangan digital pejabat untuk pengiriman surat via WhatsApp</p>
        </div>
        <a href="{{ route('admin.ttd.create') }}" class="btn-add">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><line x1="12" y1="5" x2="12" y2="19"/><line x1="5" y1="12" x2="19" y2="12"/></svg>
            Tambah TTD
        </a>
    </div>

    @if(session('success'))
    <div class="alert alert-success">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" style="width:16px;height:16px;flex-shrink:0"><path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
        {{ session('success') }}
    </div>
    @endif

    <div class="card">
        @if($ttds->isEmpty())
        <div class="empty">
            <p style="font-size:14px;font-weight:600;margin:0 0 6px">Belum ada TTD Digital</p>
            <p style="font-size:13px;margin:0">Tambahkan tanda tangan digital pejabat untuk digunakan saat kirim surat via WA</p>
        </div>
        @else
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama & Jabatan</th>
                    <th>NIP</th>
                    <th>Preview TTD</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($ttds as $i => $t)
                <tr>
                    <td style="color:#94a3b8;font-size:12px">{{ str_pad($i+1,2,'0',STR_PAD_LEFT) }}</td>
                    <td>
                        <div style="font-weight:700;color:#0f172a">{{ $t->nama }}</div>
                        <div style="font-size:11px;color:#64748b;margin-top:2px">{{ $t->jabatan }}</div>
                    </td>
                    <td style="font-family:'DM Mono',monospace;font-size:12px">{{ $t->nip ?? '-' }}</td>
                    <td>
                        @if($t->ttd_url)
                            <img src="{{ $t->ttd_url }}" class="ttd-preview" alt="TTD">
                        @else
                            <span style="color:#94a3b8;font-size:12px">-</span>
                        @endif
                    </td>
                    <td>
                        <span class="badge {{ $t->is_aktif ? 'badge-on' : 'badge-off' }}">
                            {{ $t->is_aktif ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </td>
                    <td>
                        <div class="action-group">
                            <a href="{{ route('admin.ttd.edit', $t) }}" class="btn-sm btn-edit">
                                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px"><path d="M11 4H4a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2v-7"/><path d="M18.5 2.5a2.121 2.121 0 013 3L12 15l-4 1 1-4 9.5-9.5z"/></svg>
                                Edit
                            </a>
                            <form action="{{ route('admin.ttd.destroy', $t) }}" method="POST" onsubmit="return confirm('Hapus TTD {{ addslashes($t->nama) }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="btn-sm btn-del">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" style="width:12px;height:12px"><polyline points="3 6 5 6 21 6"/><path d="M19 6l-1 14H6L5 6"/><path d="M10 11v6M14 11v6"/></svg>
                                    Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @endif
    </div>
</div>

@include('Admin.partials.footer')
@endsection
