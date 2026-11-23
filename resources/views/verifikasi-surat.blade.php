<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Surat — Kelurahan Teritih</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo kota serang.png') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        *{box-sizing:border-box;margin:0;padding:0}
        body{font-family:'Plus Jakarta Sans',sans-serif;background:#f1f5f9;min-height:100vh;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:24px}
        .card{background:white;border-radius:20px;box-shadow:0 8px 32px rgba(0,0,0,.1);max-width:520px;width:100%;overflow:hidden}
        .card-header{padding:28px 32px 24px;text-align:center}
        .card-header.valid{background:linear-gradient(135deg,#064e3b,#059669)}
        .card-header.invalid{background:linear-gradient(135deg,#7f1d1d,#dc2626)}
        .card-header i{font-size:48px;color:white;display:block;margin-bottom:12px}
        .card-header h1{font-size:20px;font-weight:800;color:white;margin-bottom:4px}
        .card-header p{font-size:13px;color:rgba(255,255,255,.8)}
        .card-body{padding:28px 32px}
        .info-row{display:flex;gap:12px;padding:12px 0;border-bottom:1px solid #f1f5f9}
        .info-row:last-child{border-bottom:none}
        .info-label{font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#94a3b8;min-width:140px;flex-shrink:0}
        .info-value{font-size:14px;font-weight:600;color:#0d1b3e}
        .status-badge{display:inline-flex;align-items:center;gap:6px;padding:4px 12px;border-radius:20px;font-size:13px;font-weight:700}
        .status-selesai{background:#d1fae5;color:#065f46}
        .status-siap{background:#fef3c7;color:#92400e}
        .status-lain{background:#e0e7ff;color:#3730a3}
        .footer-note{text-align:center;padding:16px 32px 24px;font-size:12px;color:#94a3b8;line-height:1.6}
        .btn-home{display:inline-flex;align-items:center;gap:8px;padding:10px 20px;border-radius:10px;background:#1c64f2;color:white;font-size:13px;font-weight:700;text-decoration:none;margin-top:12px}
        .btn-home:hover{background:#1a56db;color:white}
        @media(max-width:480px){
            .card-body{padding:20px}
            .card-header{padding:24px 20px 20px}
            .info-row{flex-direction:column;gap:4px}
            .info-label{min-width:unset}
        }
    </style>
</head>
<body>

@if($permohonan)
    @php
        $status     = $permohonan->approval->status ?? '-';
        $badgeClass = match($status) {
            'selesai'      => 'status-selesai',
            'siap_diambil' => 'status-siap',
            default        => 'status-lain',
        };
        $statusLabel = match($status) {
            'selesai'      => 'Selesai',
            'siap_diambil' => 'Siap Diambil',
            'disetujui'    => 'Disetujui',
            'ditolak'      => 'Ditolak',
            'cancelled'    => 'Dibatalkan',
            'pending'      => 'Menunggu',
            default        => ucfirst($status),
        };
        $tglPengajuan = \Carbon\Carbon::parse($permohonan->tanggal_pengajuan)->locale('id')->isoFormat('D MMMM Y');
        $tglApproval  = $permohonan->approval?->tanggal_approval
            ? \Carbon\Carbon::parse($permohonan->approval->tanggal_approval)->locale('id')->isoFormat('D MMMM Y')
            : '-';
    @endphp

    <div class="card">
        <div class="card-header valid">
            <i class="bi bi-patch-check-fill"></i>
            <h1>Surat Terverifikasi</h1>
            <p>Surat ini asli dan dikeluarkan oleh Kelurahan Teritih</p>
        </div>
        <div class="card-body">
            <div class="info-row">
                <span class="info-label">Nomor Surat</span>
                <span class="info-value" style="font-family:monospace;font-size:12px">{{ $nomor }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Jenis Surat</span>
                <span class="info-value">{{ $permohonan->jenisSurat->nama_surat ?? '-' }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Nama Pemohon</span>
                <span class="info-value">{{ $permohonan->nama_pemohon }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">NIK</span>
                <span class="info-value" style="font-family:monospace">{{ $permohonan->nik_pemohon }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Pengajuan</span>
                <span class="info-value">{{ $tglPengajuan }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Tanggal Diproses</span>
                <span class="info-value">{{ $tglApproval }}</span>
            </div>
            <div class="info-row">
                <span class="info-label">Status</span>
                <span class="info-value">
                    <span class="status-badge {{ $badgeClass }}">{{ $statusLabel }}</span>
                </span>
            </div>
        </div>
        <div class="footer-note">
            Verifikasi dilakukan secara otomatis melalui sistem digital<br>
            Kelurahan Teritih, Kecamatan Walantaka, Kota Serang
            <br><a href="{{ route('home') }}" class="btn-home"><i class="bi bi-house-fill"></i> Ke Beranda</a>
        </div>
    </div>

@else

    <div class="card">
        <div class="card-header invalid">
            <i class="bi bi-x-octagon-fill"></i>
            <h1>Surat Tidak Ditemukan</h1>
            <p>Nomor surat tidak terdaftar dalam sistem kami</p>
        </div>
        <div class="card-body">
            <div class="info-row">
                <span class="info-label">Nomor Dicari</span>
                <span class="info-value" style="font-family:monospace;font-size:12px;color:#dc2626">{{ $nomor }}</span>
            </div>
            <div style="margin-top:16px;padding:14px 16px;background:#fef2f2;border:1px solid #fecaca;border-radius:10px;font-size:13px;color:#991b1b;line-height:1.6">
                <strong>Kemungkinan penyebab:</strong><br>
                • Nomor surat tidak valid atau salah scan<br>
                • Surat belum diproses dan belum memiliki nomor<br>
                • Surat diterbitkan sebelum sistem QR diterapkan
            </div>
        </div>
        <div class="footer-note">
            Jika Anda merasa ini adalah kesalahan, silakan hubungi langsung<br>
            kantor Kelurahan Teritih untuk konfirmasi.
            <br><a href="{{ route('home') }}" class="btn-home"><i class="bi bi-house-fill"></i> Ke Beranda</a>
        </div>
    </div>

@endif

</body>
</html>
