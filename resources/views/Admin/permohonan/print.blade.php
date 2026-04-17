<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat – #{{ $permohonan->id_permohonan }}</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    /* ══ SCREEN STYLES ══ */
    * { box-sizing: border-box; margin: 0; padding: 0; }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: #f1f5f9;
        font-size: 14px;
        color: #334155;
    }

    /* Form panel */
    .panel-wrap {
        max-width: 900px;
        margin: 28px auto;
        padding: 0 20px 60px;
    }

    .panel-header {
        background: linear-gradient(135deg, #0d1b3e, #1c64f2);
        border-radius: 16px 16px 0 0;
        padding: 22px 28px;
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .panel-header-icon {
        width: 44px; height: 44px;
        border-radius: 12px;
        background: rgba(255,255,255,.18);
        display: flex; align-items: center; justify-content: center;
        font-size: 20px; color: white; flex-shrink: 0;
    }
    .panel-header h1 { font-size: 17px; font-weight: 700; color: white; margin-bottom: 2px; }
    .panel-header p  { font-size: 12px; color: rgba(255,255,255,.7); }

    .panel-body {
        background: white;
        border: 1px solid #e2e8f0;
        border-top: none;
        border-radius: 0 0 16px 16px;
        padding: 28px;
    }

    /* Preview data permohonan */
    .data-preview {
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        padding: 16px 20px;
        margin-bottom: 24px;
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        gap: 14px;
    }
    .dp { }
    .dp-label { font-size: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: .07em; color: #94a3b8; margin-bottom: 4px; }
    .dp-val   { font-size: 13px; font-weight: 600; color: #0d1b3e; }
    .dp.c2 { grid-column: span 2; }
    .dp.c4 { grid-column: span 4; }

    .section-sep {
        font-size: 11px; font-weight: 700; text-transform: uppercase;
        letter-spacing: .08em; color: #94a3b8;
        margin: 22px 0 14px;
        display: flex; align-items: center; gap: 10px;
    }
    .section-sep::after { content: ''; flex: 1; height: 1px; background: #f1f5f9; }

    .form-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 16px; margin-bottom: 16px; }
    .form-grid.one { grid-template-columns: 1fr; }
    .form-group { display: flex; flex-direction: column; gap: 6px; margin-bottom: 16px; }
    .form-group:last-child { margin-bottom: 0; }
    .form-label {
        font-size: 11px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .07em;
        color: #64748b;
    }
    .form-label .req { color: #ef4444; margin-left: 2px; }
    .form-input, .form-select, .form-textarea {
        padding: 10px 14px;
        border: 1.5px solid #e2e8f0;
        border-radius: 9px;
        font-size: 13.5px;
        font-family: 'Plus Jakarta Sans', sans-serif;
        color: #0d1b3e;
        transition: all .15s;
        outline: none;
    }
    .form-input:focus, .form-select:focus, .form-textarea:focus {
        border-color: #1c64f2;
        box-shadow: 0 0 0 3px rgba(28,100,242,.1);
    }
    .form-textarea { resize: vertical; min-height: 100px; }
    .form-hint { font-size: 11px; color: #94a3b8; margin-top: 4px; }

    .info-box {
        background: #eff6ff;
        border: 1.5px solid #bfdbfe;
        border-radius: 10px;
        padding: 13px 16px;
        font-size: 13px;
        color: #1e40af;
        display: flex;
        gap: 10px;
        align-items: flex-start;
        margin-bottom: 22px;
    }
    .info-box .icon { flex-shrink: 0; font-size: 16px; margin-top: 1px; }

    .divider { border: none; border-top: 1px dashed #e2e8f0; margin: 22px 0; }

    .btn-row { display: flex; gap: 12px; flex-wrap: wrap; margin-top: 24px; }
    .btn-cetak {
        display: inline-flex; align-items: center; gap: 8px;
        padding: 12px 28px; border-radius: 10px;
        background: linear-gradient(135deg, #0d1b3e, #1c64f2);
        color: white; font-size: 14px; font-weight: 700;
        border: none; cursor: pointer;
        font-family: 'Plus Jakarta Sans', sans-serif;
        transition: all .15s;
    }
    .btn-cetak:hover { opacity: .9; transform: translateY(-1px); }
    .btn-back {
        display: inline-flex; align-items: center; gap: 6px;
        padding: 12px 20px; border-radius: 10px;
        border: 1.5px solid #e2e8f0; background: white;
        color: #64748b; font-size: 13px; font-weight: 600;
        text-decoration: none; transition: all .15s;
        font-family: 'Plus Jakarta Sans', sans-serif;
    }
    .btn-back:hover { border-color: #1c64f2; color: #1c64f2; }

    /* ══ SURAT (hanya saat print) ══ */
    #suratCetak { display: none; }

    @media print {
        body { background: white; font-size: 12pt; }
        #formPanel { display: none !important; }
        #suratCetak { display: block !important; }

        .surat {
            width: 210mm;
            min-height: 297mm;
            padding: 15mm 20mm 15mm 25mm;
            font-family: 'Times New Roman', Times, serif;
            font-size: 11.5pt;
            line-height: 1.45;
            color: black;
        }

        @page { size: A4; margin: 0; }
    }

    /* ══ SURAT STYLES ══ */
    .surat {
        font-family: 'Times New Roman', Times, serif;
        font-size: 11.5pt;
        line-height: 1.45;
        color: black;
    }

    .kop {
        display: flex;
        align-items: center;
        gap: 12px;
        padding-bottom: 6px;
        border-bottom: 4px double black;
        margin-bottom: 12px;
    }
    .kop img { width: 68px; height: auto; flex-shrink: 0; }
    .kop-teks { text-align: center; flex: 1; }
    .kop-teks .k1 { font-size: 12.5pt; font-weight: bold; letter-spacing: .05em; }
    .kop-teks .k2 { font-size: 11.5pt; font-weight: bold; letter-spacing: .05em; }
    .kop-teks .k3 { font-size: 13pt; font-weight: bold; letter-spacing: .05em; }
    .kop-teks .k4 { font-size: 8.5pt; margin-top: 2px; }

    .judul {
        text-align: center;
        font-size: 12.5pt;
        font-weight: bold;
        text-decoration: underline;
        text-transform: uppercase;
        letter-spacing: .08em;
        margin: 12px 0 3px;
    }
    .nomor {
        text-align: center;
        font-size: 11pt;
        margin-bottom: 10px;
    }

    .pembuka {
        text-align: justify;
        margin-bottom: 8px;
        text-indent: 36px;
    }

    /* Tabel biodata */
    .bio {
        width: 100%;
        border-collapse: collapse;
        margin-bottom: 10px;
    }
    .bio tr td { padding: 1px 0; vertical-align: top; }
    .bio tr td:first-child { width: 155px; }
    .bio tr td:nth-child(2) { width: 14px; padding: 1px 8px; }
    .bio tr td:last-child { }

    /* Isi surat diketik admin */
    .isi-surat {
        text-align: justify;
        margin-bottom: 8px;
        white-space: pre-wrap;
        word-break: break-word;
    }
    .isi-surat-italic { font-style: italic; text-align: justify; margin-bottom: 8px; }

    .penutup { text-align: justify; margin-bottom: 10px; text-indent: 36px; }

    .tujuan-line {
        text-align: justify;
        margin-bottom: 10px;
    }

    /* TTD */
    .ttd-wrap {
        display: flex;
        justify-content: flex-end;
        margin-top: 14px;
    }
    .ttd-box { text-align: center; min-width: 220px; }
    .ttd-kota { margin-bottom: 2px; }
    .ttd-jabatan-1 { font-size: 11.5pt; margin-bottom: 1px; }
    .ttd-jabatan-2 { font-size: 11.5pt; margin-bottom: 0; }
    .ttd-ruang     { height: 52px; }
    .ttd-nama { font-weight: bold; text-decoration: underline; }
    .ttd-nip  { font-size: 10.5pt; }

    @media print {
        .penutup, .ttd-wrap, .ttd-box { page-break-inside: avoid; }
        .ttd-wrap { page-break-before: avoid; }
    }
    </style>
</head>
<body>

@php
    $status  = $permohonan->approval->status ?? 'pending';
    $dtRaw   = $permohonan->data_tambahan;
    if (is_array($dtRaw)) {
        $dt = $dtRaw;
    } elseif (is_string($dtRaw)) {
        $decoded = json_decode($dtRaw, true);
        $dt = is_string($decoded) ? json_decode($decoded, true) ?? [] : ($decoded ?? []);
    } else {
        $dt = [];
    }
    $jenis   = $dt['jenis'] ?? null;
    $tgl     = fn($t) => $t ? \Carbon\Carbon::parse($t)->isoFormat('D MMMM Y') : '-';

    // Data pemohon
    $nama      = $permohonan->nama_pemohon ?? '-';
    $nik       = $permohonan->nik_pemohon  ?? '-';
    $alamat    = $permohonan->alamat_pemohon ?? '-';
    $ttlStr    = trim(($dt['tempat_lahir'] ?? '').(isset($dt['tanggal_lahir']) && $dt['tanggal_lahir'] ? ', '.\Carbon\Carbon::parse($dt['tanggal_lahir'])->format('d-m-Y') : ''));
    $jk        = $dt['jenis_kelamin'] ?? '-';
    $agama     = $dt['agama']         ?? '-';
    $sKawin    = $dt['status_kawin']  ?? '-';
    $pekerjaan = $dt['pekerjaan']     ?? '-';
    $rt        = $dt['rt'] ?? '';
    $rw        = $dt['rw'] ?? '';
    $alamatLengkap = $alamat.($rt ? ', RT '.$rt.'/RW '.$rw : '').', Kelurahan Teritih, Kecamatan Walantaka, Kota Serang';

    // Judul surat per jenis
    $judulMap = [
        'sktm'        => 'SURAT KETERANGAN TIDAK MAMPU',
        'kematian'    => 'SURAT KETERANGAN KEMATIAN',
        'suami-istri' => 'SURAT KETERANGAN SUAMI / ISTRI',
        'beda-nama'   => 'SURAT KETERANGAN BEDA NAMA',
        'izin-cuti'   => 'SURAT KETERANGAN IZIN CUTI',
    ];
    $judulSurat = $judulMap[$jenis] ?? 'SURAT KETERANGAN';
@endphp

{{-- ═══════════════════════════════════ --}}
{{-- FORM INPUT ADMIN (layar saja)      --}}
{{-- ═══════════════════════════════════ --}}
<div id="formPanel" class="panel-wrap">

    <div class="panel-header">
        <div class="panel-header-icon">🖨️</div>
        <div>
            <h1>Cetak Surat – #{{ $permohonan->id_permohonan }}</h1>
            <p>{{ $judulSurat }} · Pemohon: {{ $nama }}</p>
        </div>
    </div>

    <div class="panel-body">

        <div class="info-box">
            <span class="icon">ℹ️</span>
            <div>
                Isi kolom di bawah sebelum mencetak. <strong>Data ini tidak disimpan</strong> — hanya untuk tampilan surat yang dicetak saat ini.
                Bagian isi/keterangan surat diketik langsung oleh admin agar dapat disesuaikan dengan kebutuhan.
            </div>
        </div>

        {{-- PREVIEW DATA PEMOHON --}}
        <div class="section-sep">Data dari Permohonan</div>
        <div class="data-preview">
            <div class="dp c2">
                <div class="dp-label">Nama Pemohon</div>
                <div class="dp-val">{{ $nama }}</div>
            </div>
            <div class="dp c2">
                <div class="dp-label">NIK</div>
                <div class="dp-val" style="font-family:monospace">{{ $nik }}</div>
            </div>
            @if($ttlStr)
            <div class="dp c2">
                <div class="dp-label">Tempat / Tanggal Lahir</div>
                <div class="dp-val">{{ $ttlStr }}</div>
            </div>
            @endif
            @if($jk && $jk !== '-')
            <div class="dp">
                <div class="dp-label">Jenis Kelamin</div>
                <div class="dp-val">{{ $jk }}</div>
            </div>
            <div class="dp">
                <div class="dp-label">Agama</div>
                <div class="dp-val">{{ $agama }}</div>
            </div>
            @endif
            @if($pekerjaan && $pekerjaan !== '-')
            <div class="dp">
                <div class="dp-label">Pekerjaan</div>
                <div class="dp-val">{{ $pekerjaan }}</div>
            </div>
            @endif
            <div class="dp c4">
                <div class="dp-label">Alamat</div>
                <div class="dp-val">{{ $alamat }}</div>
            </div>
        </div>

        <hr class="divider">

        {{-- NOMOR SURAT --}}
        <div class="section-sep">Nomor & Tanggal Surat</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Nomor Surat <span class="req">*</span></label>
                <input type="text" class="form-input" id="inp_nomor"
                    value="{{ $permohonan->nomor_surat ?? '' }}"
                    placeholder="Contoh: 470/125/Kel-Ter/IV/2026">
                <span class="form-hint">470 / [no urut] / Kel-Ter / [bulan romawi] / [tahun]</span>
            </div>
            <div class="form-group">
                <label class="form-label">Kota, Tanggal Surat <span class="req">*</span></label>
                <input type="text" class="form-input" id="inp_tgl"
                    value="Serang, {{ now()->isoFormat('D MMMM Y') }}">
            </div>
        </div>

        <hr class="divider">

        {{-- ISI SURAT --}}
        <div class="section-sep">Isi / Keterangan Surat (diketik admin)</div>

        {{-- BOLD HINT --}}
        <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:8px;padding:10px 14px;margin-bottom:12px;font-size:12px;color:#64748b;display:flex;align-items:center;gap:10px">
            <span style="font-size:14px">💡</span>
            <span>Untuk <strong>menebalkan teks</strong>, pilih teks lalu klik tombol <strong>B</strong> di bawah, atau ketik <code style="background:#e2e8f0;border-radius:4px;padding:1px 5px">**teks**</code> secara manual.</span>
        </div>
        {{-- BOLD TOOLBAR --}}
        <div style="margin-bottom:6px;display:flex;gap:6px;align-items:center">
            <button type="button" onclick="insertBold()"
                style="width:32px;height:32px;border-radius:6px;border:1.5px solid #e2e8f0;background:white;font-weight:800;font-size:14px;cursor:pointer;font-family:serif;transition:all .15s;display:flex;align-items:center;justify-content:center"
                title="Tebalkan teks terpilih (Ctrl+B)">B</button>
            <span style="font-size:11px;color:#94a3b8">Pilih teks di textarea lalu klik B, atau gunakan Ctrl+B</span>
        </div>

        @if($jenis === 'sktm')
        <div class="form-group">
            <label class="form-label">Kalimat Keterangan SKTM <span class="req">*</span></label>
            <textarea class="form-textarea" id="inp_isi" rows="5"
                placeholder="Ketik kalimat keterangan di sini...">Benar nama tersebut di atas, warga/penduduk Kelurahan Teritih Kecamatan Walantaka Kota Serang, berdasarkan catatan Ketua RT setempat dan sepanjang pengetahuan kami nama tersebut termasuk keluarga yang keadaan Ekonomi lemah **( Tidak Mampu )**.</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Tujuan Penggunaan Surat <span style="font-size:10px;color:#94a3b8;font-weight:400">(Opsional — kosongkan jika tidak perlu)</span></label>
            <input type="text" class="form-input" id="inp_tujuan"
                value="{{ $dt['keperluan_sktm'] ?? $permohonan->keperluan ?? '' }}"
                placeholder="Contoh: Persyaratan Berobat di RSUD Kota Serang">
        </div>

        @elseif($jenis === 'kematian')
        <div class="form-group">
            <label class="form-label">Kalimat Pembuka (Opsional) <span style="font-size:10px;color:#94a3b8;font-weight:400">— Data hari/tanggal/tempat/sebab sudah otomatis tampil dari form</span></label>
            <textarea class="form-textarea" id="inp_isi" rows="3"
                placeholder="Kosongkan jika tidak ada kalimat tambahan..."></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Tujuan Penggunaan Surat <span style="font-size:10px;color:#94a3b8;font-weight:400">(Opsional — kosongkan jika tidak perlu)</span></label>
            <input type="text" class="form-input" id="inp_tujuan"
                value="{{ $permohonan->keperluan ?? '' }}"
                placeholder="Contoh: Pengurusan administrasi kependudukan (KK)">
        </div>

        @elseif($jenis === 'suami-istri')
        <div class="form-group">
            <label class="form-label">Kalimat Keterangan Suami/Istri <span class="req">*</span></label>
            <textarea class="form-textarea" id="inp_isi" rows="5"
                placeholder="Ketik kalimat keterangan di sini...">Benar nama tersebut di atas adalah warga/penduduk Kelurahan Teritih dan berdomisili di alamat tersebut di atas, ia adalah pasangan SUAMI / ISTRI yang telah menikah pada Tahun {{ $dt['tahun_menikah'] ?? '___' }}.</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Tujuan Penggunaan Surat <span style="font-size:10px;color:#94a3b8;font-weight:400">(Opsional — kosongkan jika tidak perlu)</span></label>
            <input type="text" class="form-input" id="inp_tujuan"
                value="{{ $permohonan->keperluan ?? '' }}"
                placeholder="Tujuan surat">
        </div>

        @elseif($jenis === 'beda-nama')
        <div class="form-group">
            <label class="form-label">Kalimat Keterangan Beda Nama <span class="req">*</span></label>
            <textarea class="form-textarea" id="inp_isi" rows="5"
                placeholder="Ketik kalimat keterangan di sini...">Benar nama tersebut di atas, warga/penduduk Kelurahan Teritih dan berdomisili di alamat tersebut di atas, ada perbedaan identitas yang tercatat pada Kartu Tanda Penduduk (KTP) {{ $dt['nama_dokumen_1'] ?? $nama }} sedangkan yang tercatat pada {{ $dt['jenis_dokumen_2'] ?? 'dokumen lain' }} adalah {{ $dt['nama_dokumen_2'] ?? '___' }}, kedua beda nama tersebut adalah satu orang yang sama.</textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Tujuan Penggunaan Surat <span style="font-size:10px;color:#94a3b8;font-weight:400">(Opsional — kosongkan jika tidak perlu)</span></label>
            <input type="text" class="form-input" id="inp_tujuan"
                value="{{ $permohonan->keperluan ?? '' }}"
                placeholder="Tujuan surat">
        </div>
        <hr class="divider" style="margin:14px 0">
        <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:#94a3b8;margin-bottom:12px">Saksi-Saksi (Opsional)</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Nama Saksi 1</label>
                <input type="text" class="form-input" id="inp_saksi1" placeholder="Contoh: Ahmad Fauzi">
            </div>
            <div class="form-group">
                <label class="form-label">Nama Saksi 2</label>
                <input type="text" class="form-input" id="inp_saksi2" placeholder="Contoh: Siti Aminah">
            </div>
        </div>

        @elseif($jenis === 'izin-cuti')
        <div class="form-group">
            <label class="form-label">Kalimat Keterangan Izin Cuti <span class="req">*</span></label>
            <textarea class="form-textarea" id="inp_isi" rows="5"
                placeholder="Ketik kalimat keterangan di sini...">Benar nama tersebut di atas, warga/penduduk Kelurahan Teritih dan berdomisili di alamat tersebut di atas, akan mengajukan izin kerja selama {{ $dt['lama_cuti'] ?? '___' }} hari pada tempat kerja **{{ $dt['nama_perusahaan'] ?? '___' }}** Pada tanggal **{{ $tgl($dt['tanggal_mulai_cuti'] ?? null) }}** s/d **{{ $tgl($dt['tanggal_selesai_cuti'] ?? null) }}** untuk keperluan: {{ $permohonan->keperluan ?? '___' }}</textarea>
        </div>
        <div style="display:none"><input type="text" id="inp_tujuan" value=""></div>

        @else
        {{-- Generic / data_tambahan NULL --}}
        <div class="info-box" style="background:#fffbeb;border-color:#fde68a;color:#92400e">
            <span class="icon">⚠️</span>
            <div>Permohonan lama — isi keterangan surat sepenuhnya diketik manual.</div>
        </div>
        <div class="form-group">
            <label class="form-label">Isi / Keterangan Surat <span class="req">*</span></label>
            <textarea class="form-textarea" id="inp_isi" rows="6"
                placeholder="Ketik isi/keterangan surat di sini..."></textarea>
        </div>
        <div class="form-group">
            <label class="form-label">Tujuan Penggunaan Surat <span style="font-size:10px;color:#94a3b8;font-weight:400">(Opsional — kosongkan jika tidak perlu)</span></label>
            <input type="text" class="form-input" id="inp_tujuan"
                value="{{ $permohonan->keperluan ?? '' }}"
                placeholder="Tujuan surat">
        </div>
        @endif

        <hr class="divider">

        {{-- PEJABAT TTD --}}
        <div class="section-sep">Pejabat Penandatangan</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Jabatan <span class="req">*</span></label>
                <select class="form-select" id="inp_jabatan" onchange="onJabatanChange()">
                    <option value="Kepala Kelurahan Teritih|">Kepala Kelurahan Teritih</option>
                    <option value="An. Kepala Kelurahan Teritih|Sekretaris Kelurahan">An. Kepala Kelurahan – Sekretaris Kelurahan</option>
                    <option value="An. Kepala Kelurahan Teritih|Kasi Pemerintahan &amp; Pelayanan Publik">An. Kepala Kelurahan – Kasi Pemerintahan</option>
                    <option value="An. Kepala Kelurahan Teritih|Kasi Pemberdayaan Masyarakat">An. Kepala Kelurahan – Kasi Pemberdayaan</option>
                    <option value="custom|">Jabatan lain (ketik manual)...</option>
                </select>
            </div>
            <div class="form-group" id="grp_jabatan_custom" style="display:none">
                <label class="form-label">Baris Jabatan 1</label>
                <input type="text" class="form-input" id="inp_jab1" placeholder="Contoh: An. Kepala Kelurahan Teritih">
                <input type="text" class="form-input" id="inp_jab2" placeholder="Baris 2 (opsional)" style="margin-top:6px">
            </div>
        </div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Nama Pejabat <span class="req">*</span></label>
                <input type="text" class="form-input" id="inp_nama_pejabat" placeholder="Contoh: Hidayatullah, S.E.">
            </div>
            <div class="form-group">
                <label class="form-label">NIP Pejabat</label>
                <input type="text" class="form-input" id="inp_nip" placeholder="Contoh: 19800101 200501 1 001">
            </div>
        </div>

        <div class="btn-row">
            <button class="btn-cetak" onclick="cetakSurat()">
                🖨️ &nbsp;Cetak Surat Sekarang
            </button>
            <a href="{{ route('permohonan.show', $permohonan->id_permohonan) }}" class="btn-back">
                ← Kembali ke Detail
            </a>
            <button type="button" id="btn_kompak" onclick="toggleKompak()"
                style="display:inline-flex;align-items:center;gap:6px;padding:12px 18px;border-radius:10px;border:1.5px solid #e2e8f0;background:white;color:#64748b;font-size:13px;font-weight:600;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;transition:all .15s"
                title="Klik jika surat melebihi 1 halaman">
                📄 Surat terlalu panjang? Mode Kompak
            </button>
        </div>
        <div id="kompak_hint" style="display:none;margin-top:10px;font-size:12px;color:#16a34a;font-weight:600">
            ✅ Mode kompak aktif — margin dan spasi diperkecil. Klik tombol lagi untuk kembali normal.
        </div>

    </div>{{-- /panel-body --}}
</div>{{-- /panel-wrap --}}

{{-- ═══════════════════════════════════ --}}
{{-- SURAT RESMI (hanya saat print)     --}}
{{-- ═══════════════════════════════════ --}}
<div id="suratCetak">
<div class="surat">

    {{-- KOP --}}
    <div class="kop">
        <img src="{{ asset('images/lambang_kota_serang.jpg') }}"
             onerror="this.style.display='none'"
             alt="Logo">
        <div class="kop-teks">
            <div class="k1">PEMERINTAH KOTA SERANG</div>
            <div class="k2">KECAMATAN WALANTAKA</div>
            <div class="k3">KELURAHAN TERITIH</div>
            <div class="k4">Jl. Raya Teritih No.123, Kecamatan Walantaka, Kota Serang, Banten 42183<br>
            Telp. (0254) 123-456 &nbsp;|&nbsp; Email: admin@teritih.go.id</div>
        </div>
    </div>

    {{-- JUDUL --}}
    <div class="judul" id="pr_judul">{{ $judulSurat }}</div>
    <div class="nomor">Nomor: <span id="pr_nomor">470/&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;/Kel-Ter/{{ now()->isoFormat('MMMM') }}/{{ now()->format('Y') }}</span></div>

    {{-- PEMBUKA --}}
    <p class="pembuka">
        Yang bertanda tangan di bawah ini atas nama Kepala Kelurahan Teritih Kecamatan Walantaka
        Kota Serang Provinsi Banten, menerangkan dengan sebenarnya bahwa:
    </p>

    {{-- BIODATA PEMOHON --}}
    <table class="bio">
        <tr><td>Nama</td><td>:</td><td>{{ $nama }}</td></tr>
        @if($nik && $nik !== '-')
        <tr><td>NIK</td><td>:</td><td>{{ $nik }}</td></tr>
        @endif
        @if($ttlStr)
        <tr><td>Tempat Tgl Lahir</td><td>:</td><td>{{ $ttlStr }}</td></tr>
        @endif
        @if($jk && $jk !== '-')
        <tr><td>Jenis Kelamin</td><td>:</td><td>{{ $jk }}</td></tr>
        @endif
        @if($agama && $agama !== '-')
        <tr><td>Bangsa / Agama</td><td>:</td><td>{{ $agama }}</td></tr>
        @endif
        @if($sKawin && $sKawin !== '-')
        <tr><td>Status Perkawinan</td><td>:</td><td>{{ $sKawin }}</td></tr>
        @endif
        @if($pekerjaan && $pekerjaan !== '-')
        <tr><td>Pekerjaan</td><td>:</td><td>{{ $pekerjaan }}</td></tr>
        @endif
        <tr>
            <td>Alamat</td><td>:</td>
            <td>{{ $alamat }}@if($rt) RT {{ $rt }}/RW {{ $rw }}@endif, Kelurahan Teritih, Kecamatan Walantaka, Kota Serang</td>
        </tr>

        {{-- Data khusus per jenis --}}
        @if($jenis === 'suami-istri')
        <tr><td colspan="3" style="padding-top:10px;padding-bottom:4px"><strong>Data Istri:</strong></td></tr>
        <tr><td>Nama Istri</td><td>:</td><td>{{ $dt['nama_istri'] ?? '-' }}</td></tr>
        <tr><td>Tempat Tgl Lahir</td><td>:</td><td>{{ $dt['ttl_istri'] ?? '-' }}</td></tr>
        <tr><td>Jenis Kelamin</td><td>:</td><td>Perempuan</td></tr>
        <tr><td>Bangsa / Agama</td><td>:</td><td>{{ $dt['agama_istri'] ?? '-' }}</td></tr>
        <tr><td>Status Perkawinan</td><td>:</td><td>Kawin</td></tr>
        <tr><td>Pekerjaan</td><td>:</td><td>{{ $dt['pekerjaan_istri'] ?? '-' }}</td></tr>
        <tr><td>Alamat</td><td>:</td><td>{{ !empty($dt['alamat_istri']) ? $dt['alamat_istri'] : $alamat.', Kelurahan Teritih, Kecamatan Walantaka, Kota Serang' }}</td></tr>

        @elseif($jenis === 'kematian')
        {{-- Data kematian masuk sebagai baris tambahan di tabel biodata --}}
        @endif
    </table>

    {{-- Khusus kematian: tabel data meninggal terpisah setelah biodata --}}
    @if($jenis === 'kematian')
    <p class="isi-surat" style="margin-bottom:6px">Telah meninggal dunia pada:</p>
    <table class="bio" style="margin-bottom:16px;margin-left:20px">
        <tr><td>Hari</td><td>:</td><td>{{ $dt['hari_meninggal'] ?? '___' }}</td></tr>
        <tr><td>Tanggal</td><td>:</td><td>{{ isset($dt['tanggal_meninggal']) && $dt['tanggal_meninggal'] ? \Carbon\Carbon::parse($dt['tanggal_meninggal'])->isoFormat('D MMMM Y') : '___' }}</td></tr>
        <tr><td>Di</td><td>:</td><td>{{ $dt['tempat_meninggal'] ?? '___' }}</td></tr>
        <tr><td>Disebabkan karena</td><td>:</td><td>{{ $dt['sebab_meninggal'] ?? '___' }}</td></tr>
    </table>
    @endif

    {{-- ISI SURAT (diketik admin, support bold via **teks** syntax) --}}
    <div class="isi-surat" id="pr_isi"></div>

    {{-- Tujuan — opsional, hanya tampil jika diisi admin --}}
    <p class="isi-surat-italic" id="pr_tujuan_wrap" style="display:none">
        <em><strong id="pr_tujuan"></strong></em>
    </p>

    {{-- PENUTUP --}}
    <p class="penutup">
        Demikian Surat Keterangan ini kami buat dengan sebenarnya untuk dapat dipergunakan sebagaimana mestinya.
    </p>

    {{-- TTD — beda format untuk beda-nama (ada saksi kiri) --}}
    @if($jenis === 'beda-nama')
    <div style="display:flex;justify-content:space-between;margin-top:28px;align-items:flex-start">
        {{-- SAKSI KIRI --}}
        <div style="min-width:200px">
            <p style="margin-bottom:14px;font-size:12pt">Saksi-Saksi</p>
            <p style="margin-bottom:36px;font-size:12pt">1. <span id="pr_saksi1">.....................................</span> (........................)</p>
            <p style="font-size:12pt">2. <span id="pr_saksi2">.....................................</span> (........................)</p>
        </div>
        {{-- TTD KANAN --}}
        <div style="text-align:center;min-width:220px">
            <p class="ttd-kota" id="pr_tgl">{{ now()->isoFormat('D MMMM Y') }}</p>
            <p class="ttd-jabatan-1" id="pr_jab1">Kepala Kelurahan Teritih</p>
            <p class="ttd-jabatan-2" id="pr_jab2" style="display:none"></p>
            <div class="ttd-ruang"></div>
            <p class="ttd-nama" id="pr_nama_pejabat">_________________________</p>
            <p class="ttd-nip"  id="pr_nip">NIP. _____________________</p>
        </div>
    </div>
    @else
    {{-- TTD NORMAL (kanan saja) --}}
    <div class="ttd-wrap">
        <div class="ttd-box">
            <p class="ttd-kota" id="pr_tgl">Serang, {{ now()->isoFormat('D MMMM Y') }}</p>
            <p class="ttd-jabatan-1" id="pr_jab1">Kepala Kelurahan Teritih</p>
            <p class="ttd-jabatan-2" id="pr_jab2" style="display:none"></p>
            <div class="ttd-ruang"></div>
            <p class="ttd-nama" id="pr_nama_pejabat">_________________________</p>
            <p class="ttd-nip"  id="pr_nip">NIP. _____________________</p>
        </div>
    </div>
    @endif

</div>{{-- /surat --}}
</div>{{-- /suratCetak --}}

<style id="print-spacing">
/* Diisi otomatis oleh JS saat mode kompak aktif */
</style>

<script>
// ── Mode Kompak ────────────────────────────────────
let kompakAktif = false;

function toggleKompak() {
    kompakAktif = !kompakAktif;
    const btn  = document.getElementById('btn_kompak');
    const hint = document.getElementById('kompak_hint');
    const styleEl = document.getElementById('print-spacing');

    if (kompakAktif) {
        // Terapkan mode kompak — sedikit lebih kecil dari normal, tetap rapi
        styleEl.textContent = `
            @media print {
                #suratCetak .surat {
                    padding: 13mm 18mm 13mm 22mm !important;
                    font-size: 11pt !important;
                    line-height: 1.35 !important;
                }
                #suratCetak .kop { margin-bottom: 10px !important; }
                #suratCetak .kop-teks .k1 { font-size: 12pt !important; }
                #suratCetak .kop-teks .k2 { font-size: 11pt !important; }
                #suratCetak .kop-teks .k3 { font-size: 12.5pt !important; }
                #suratCetak .kop-teks .k4 { font-size: 8.5pt !important; }
                #suratCetak .judul   { font-size: 12pt !important; margin: 10px 0 3px !important; }
                #suratCetak .nomor   { font-size: 10.5pt !important; margin-bottom: 8px !important; }
                #suratCetak .pembuka { margin-bottom: 8px !important; }
                #suratCetak .bio     { margin-bottom: 8px !important; }
                #suratCetak .bio tr td { padding: 1px 0 !important; }
                #suratCetak .isi-surat        { margin-bottom: 8px !important; }
                #suratCetak .isi-surat-italic  { margin-bottom: 8px !important; }
                #suratCetak .penutup  { margin-bottom: 8px !important; }
                #suratCetak .ttd-wrap { margin-top: 12px !important; }
                #suratCetak .ttd-ruang { height: 48px !important; }
            }
        `;
        btn.style.background    = '#f0fdf4';
        btn.style.borderColor   = '#86efac';
        btn.style.color         = '#16a34a';
        btn.textContent         = '✅ Mode Kompak Aktif — Klik untuk Normal';
        hint.style.display      = 'block';
    } else {
        // Kembali ke mode normal
        styleEl.textContent = '';
        btn.style.background  = 'white';
        btn.style.borderColor = '#e2e8f0';
        btn.style.color       = '#64748b';
        btn.textContent       = '📄 Surat terlalu panjang? Mode Kompak';
        hint.style.display    = 'none';
    }
}

function onJabatanChange() {
    const val = document.getElementById('inp_jabatan').value;
    const grp = document.getElementById('grp_jabatan_custom');
    grp.style.display = val.startsWith('custom') ? 'flex' : 'none';
    if (!val.startsWith('custom')) {
        grp.style.flexDirection = 'column';
        grp.style.gap = '6px';
    }
}

// Konversi **teks** menjadi <strong>teks</strong>
function parseBold(text) {
    return text
        .replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')  // escape html
        .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>')                  // bold
        .replace(/\n/g, '<br>');                                           // newline
}

// Tombol bold — wrap teks terpilih dengan **
function insertBold() {
    const ta    = document.getElementById('inp_isi');
    const start = ta.selectionStart;
    const end   = ta.selectionEnd;
    const sel   = ta.value.substring(start, end);
    if (!sel) { alert('Pilih teks terlebih dahulu, lalu klik B.'); return; }
    const before = ta.value.substring(0, start);
    const after  = ta.value.substring(end);
    ta.value = before + '**' + sel + '**' + after;
    ta.selectionStart = start;
    ta.selectionEnd   = end + 4;
    ta.focus();
}

// Ctrl+B shortcut di textarea
document.addEventListener('DOMContentLoaded', function() {
    const ta = document.getElementById('inp_isi');
    if (ta) {
        ta.addEventListener('keydown', function(e) {
            if ((e.ctrlKey || e.metaKey) && e.key === 'b') {
                e.preventDefault();
                insertBold();
            }
        });
    }
});

function cetakSurat() {
    const nomor       = document.getElementById('inp_nomor').value.trim() || '470/___/Kel-Ter/{{ now()->isoFormat("MM") }}/{{ now()->format("Y") }}';
    const tgl         = document.getElementById('inp_tgl').value.trim();
    const isiRaw      = document.getElementById('inp_isi').value.trim();
    const tujuanEl    = document.getElementById('inp_tujuan');
    const tujuan      = tujuanEl ? tujuanEl.value.trim() : '';
    const namaPejabat = document.getElementById('inp_nama_pejabat').value.trim() || '____________________';
    const nip         = document.getElementById('inp_nip').value.trim();

    const jabSel = document.getElementById('inp_jabatan').value;
    let jab1, jab2;
    if (jabSel.startsWith('custom')) {
        jab1 = document.getElementById('inp_jab1').value.trim();
        jab2 = document.getElementById('inp_jab2').value.trim();
    } else {
        const parts = jabSel.split('|');
        jab1 = parts[0] || '';
        jab2 = parts[1] || '';
    }

    // Helper inject ke semua elemen dengan ID atau class yang sama
    function setEl(id, val, isHTML) {
        const el = document.getElementById(id);
        if (!el) return;
        if (isHTML) el.innerHTML = val; else el.textContent = val;
    }
    function setAllEl(id, val, isHTML) {
        // Beberapa elemen mungkin punya ID sama (beda-nama punya 2 set TTD)
        const els = document.querySelectorAll('#' + id);
        els.forEach(el => { if (isHTML) el.innerHTML = val; else el.textContent = val; });
    }

    // Inject ke surat — isi dengan bold support
    setEl('pr_nomor', nomor);
    setEl('pr_judul', '{{ $judulSurat }}');
    setAllEl('pr_tgl', tgl);
    setEl('pr_isi', parseBold(isiRaw), true);
    setAllEl('pr_nama_pejabat', namaPejabat);
    setAllEl('pr_nip', nip ? 'NIP. ' + nip : '');
    setAllEl('pr_jab1', jab1);

    const jab2Els = document.querySelectorAll('#pr_jab2');
    jab2Els.forEach(el => {
        if (jab2) { el.textContent = jab2; el.style.display = 'block'; }
        else { el.style.display = 'none'; }
    });

    // Saksi (hanya untuk beda-nama)
    const saksi1El = document.getElementById('inp_saksi1');
    const saksi2El = document.getElementById('inp_saksi2');
    if (saksi1El) {
        const s1 = saksi1El.value.trim() || '...................................';
        const s2 = saksi2El ? saksi2El.value.trim() || '...................................' : '...................................';
        const pr1 = document.getElementById('pr_saksi1');
        const pr2 = document.getElementById('pr_saksi2');
        if (pr1) pr1.textContent = s1;
        if (pr2) pr2.textContent = s2;
    }

    // Tujuan — opsional, hanya tampil jika diisi
    const tujuanWrap = document.getElementById('pr_tujuan_wrap');
    const tujuanText = document.getElementById('pr_tujuan');
    if (tujuanWrap) {
        if (tujuan) {
            tujuanText.textContent   = tujuan;   // prefix "Surat Keterangan ini dipergunakan untuk" sudah ada di HTML
            tujuanWrap.style.display = 'block';
        } else {
            tujuanWrap.style.display = 'none';
        }
    }

    window.print();
}
</script>

</body>
</html>