<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cetak Surat – #{{ $permohonan->id_permohonan }}</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    *{box-sizing:border-box;margin:0;padding:0}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:#f1f5f9;font-size:14px;color:#334155}
    .panel-wrap{max-width:900px;margin:28px auto;padding:0 20px 60px}
    .panel-header{background:linear-gradient(135deg,#0d1b3e,#1c64f2);border-radius:16px 16px 0 0;padding:22px 28px;display:flex;align-items:center;gap:14px}
    .panel-header-icon{width:44px;height:44px;border-radius:12px;background:rgba(255,255,255,.18);display:flex;align-items:center;justify-content:center;font-size:20px;color:white}
    .panel-header h1{font-size:17px;font-weight:700;color:white;margin-bottom:2px}
    .panel-header p{font-size:12px;color:rgba(255,255,255,.7)}
    .panel-body{background:white;border:1px solid #e2e8f0;border-top:none;border-radius:0 0 16px 16px;padding:28px}
    .section-sep{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.08em;color:#94a3b8;margin:22px 0 14px;display:flex;align-items:center;gap:10px}
    .section-sep::after{content:'';flex:1;height:1px;background:#f1f5f9}
    .form-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px;margin-bottom:16px}
    .form-group{display:flex;flex-direction:column;gap:6px;margin-bottom:16px}
    .form-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#64748b}
    .form-label .req{color:#ef4444;margin-left:2px}
    .form-input,.form-select,.form-textarea{padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:9px;font-size:13.5px;font-family:'Plus Jakarta Sans',sans-serif;color:#0d1b3e;outline:none;transition:all .15s}
    .form-input:focus,.form-select:focus,.form-textarea:focus{border-color:#1c64f2;box-shadow:0 0 0 3px rgba(28,100,242,.1)}
    .form-textarea{resize:vertical;min-height:100px;width:100%}
    .info-box{background:#eff6ff;border:1.5px solid #bfdbfe;border-radius:10px;padding:13px 16px;font-size:13px;color:#1e40af;display:flex;gap:10px;align-items:flex-start;margin-bottom:22px}
    .divider{border:none;border-top:1px dashed #e2e8f0;margin:22px 0}
    .btn-row{display:flex;gap:12px;flex-wrap:wrap;margin-top:24px}
    .btn-cetak{display:inline-flex;align-items:center;gap:8px;padding:12px 28px;border-radius:10px;background:linear-gradient(135deg,#0d1b3e,#1c64f2);color:white;font-size:14px;font-weight:700;border:none;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif}
    .btn-cetak:hover{opacity:.9;transform:translateY(-1px)}
    .btn-back{display:inline-flex;align-items:center;gap:6px;padding:12px 20px;border-radius:10px;border:1.5px solid #e2e8f0;background:white;color:#64748b;font-size:13px;font-weight:600;text-decoration:none;font-family:'Plus Jakarta Sans',sans-serif}
    .data-preview{background:#f8fafc;border:1px solid #e2e8f0;border-radius:12px;padding:16px 20px;margin-bottom:24px;display:grid;grid-template-columns:repeat(4,1fr);gap:14px}
    .dp-label{font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#94a3b8;margin-bottom:4px}
    .dp-val{font-size:13px;font-weight:600;color:#0d1b3e}
    .dp.c2{grid-column:span 2}.dp.c4{grid-column:span 4}
    .ttd-entry{border:1px solid #e2e8f0;border-radius:10px;padding:16px;margin-bottom:12px;background:#f8fafc}
    .ttd-entry-label{font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#94a3b8;margin-bottom:12px;display:flex;justify-content:space-between}
    .btn-hapus-ttd{background:#fef2f2;border:1px solid #fecaca;color:#dc2626;border-radius:7px;width:28px;height:28px;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:13px}
    .btn-tambah-ttd{display:inline-flex;align-items:center;gap:6px;padding:9px 16px;border-radius:8px;border:1.5px dashed #93c5fd;background:#f0f9ff;color:#0284c7;font-size:13px;font-weight:600;cursor:pointer;font-family:'Plus Jakarta Sans',sans-serif;margin-bottom:20px}
    #suratCetak{display:none}
    @media print{
        body{background:white;font-size:12pt}
        #formPanel{display:none!important}
        #suratCetak{display:block!important}
        .surat{width:210mm;min-height:297mm;padding:10mm 18mm 10mm 22mm;font-family:'Times New Roman',Times,serif;font-size:12pt;line-height:1.4;color:black}
        @page{size:A4;margin:0}
    }
    .surat{font-family:'Times New Roman',Times,serif;font-size:12pt;line-height:1.4;color:black}
    .kop{display:flex;align-items:center;gap:10px;padding-bottom:8px;border-bottom:3px double black;margin-bottom:0}
    .kop img{width:100px;height:auto}
    .kop-teks{text-align:center;flex:1;line-height:1.2}
    .kop-teks .k1{font-size:24pt;font-weight:bold;letter-spacing:.04em}
    .kop-teks .k2{font-size:24pt;font-weight:bold;letter-spacing:.04em}
    .kop-teks .k3{font-size:24pt;font-weight:bold;letter-spacing:.04em}
    .kop-teks .k4{font-size:12pt;margin-top:2px;font-style:italic}
    .judul{text-align:center;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:.08em;margin:16px 0 2px}
    .nomor{text-align:center;font-size:12pt;margin-bottom:6px}
    .pembuka{text-align:justify;margin-bottom:6px;text-indent:36px;font-size:12pt}
    .bio{width:100%;border-collapse:collapse;margin-bottom:6px}
    .bio tr td{padding:0 0;vertical-align:top;font-size:12pt}
    .bio tr td:first-child{width:145px}
    .bio tr td:nth-child(2){width:12px;padding:0 6px}
    .isi-surat{text-align:justify;margin-bottom:6px;white-space:pre-wrap;word-break:break-word;font-size:12pt;text-indent:36px}
    .penutup{text-align:justify;margin-bottom:8px;font-size:12pt}
    .ttd-box{text-align:center;min-width:200px;font-size:12pt;margin-top:24pt}
    .ttd-kota{margin-bottom:2px}
    .ttd-ruang{height:70px}
    .ttd-nama{font-weight:bold;text-decoration:underline;margin-bottom:0;line-height:1.3}
    .ttd-nip{font-weight:bold;font-size:12pt;margin-top:1px;line-height:1.3}
    .keperluan-center{text-align:center;font-weight:bold;text-decoration:underline;margin:8px 0;font-size:12pt}
    </style>
</head>
<body>

@php
    $dtRaw = $permohonan->data_tambahan;
    if (is_array($dtRaw)) { $dt = $dtRaw; }
    elseif (is_string($dtRaw)) { $decoded = json_decode($dtRaw, true); $dt = is_string($decoded) ? json_decode($decoded, true) ?? [] : ($decoded ?? []); }
    else { $dt = []; }

    $jenis = $dt['jenis'] ?? $permohonan->jenisSurat->slug ?? null;
    $jenisMap = ['surat-keterangan-kematian'=>'kematian','surat-keterangan-suami-istri'=>'suami-istri','surat-keterangan-izin-cuti'=>'izin-cuti','surat-keterangan-tidak-mampu'=>'sktm'];
    $jenis = $jenisMap[$jenis] ?? $jenis;
    $js = $permohonan->jenisSurat;

    // Ambil dari database jika ada
    $prefix = $js->kode_klasifikasi ?? '470';
    $kode = $js->kode_surat ?? 'SK';
    $judulSurat = strtoupper($js->nama_surat ?? 'SURAT KETERANGAN');
    $fieldsConfig = $js->fields_config ?? [];
    $templatePembuka = $js->template_pembuka ?? 'Yang bertanda tangan di bawah ini Kepala Kelurahan Teritih Kecamatan Walantaka Kota Serang menerangkan bahwa:';
    $templateIsi = $js->template_isi ?? '';
    $templatePenutup = $js->template_penutup ?? 'Demikian surat keterangan ini kami buat dengan sebenar-benarnya dan untuk dipergunakan sebagaimana mestinya.';

    // Data pemohon
    $nama = $permohonan->nama_pemohon ?? '-';
    $nik = $permohonan->nik_pemohon ?? '-';
    $alamat = $permohonan->alamat_pemohon ?? '-';
    $ttlStr = trim(($dt['tempat_lahir'] ?? '').(isset($dt['tanggal_lahir']) && $dt['tanggal_lahir'] ? ', '.\Carbon\Carbon::parse($dt['tanggal_lahir'])->locale('id')->isoFormat('D MMMM Y') : ''));
    $jk = $dt['jenis_kelamin'] ?? '-';
    $agama = $dt['agama'] ?? '-';
    $pekerjaan = $dt['pekerjaan'] ?? '-';

    // Replace placeholders di template
    $replacements = [
        '{nama}' => $nama, '{nik}' => $nik, '{alamat}' => $alamat,
        '{tempat_lahir}' => $dt['tempat_lahir'] ?? '', '{tanggal_lahir}' => $dt['tanggal_lahir'] ?? '',
        '{jenis_kelamin}' => $jk, '{agama}' => $agama, '{pekerjaan}' => $pekerjaan,
    ];
    // Tambah extra fields ke replacements
    $extraFields = collect($fieldsConfig)->where('group', 'extra')->values();
    foreach ($extraFields as $ef) {
        $replacements['{'.$ef['key'].'}'] = $dt[$ef['key']] ?? '';
    }
    $isiDefault = str_replace(array_keys($replacements), array_values($replacements), $templateIsi);
@endphp


{{-- ═══ FORM INPUT ADMIN ═══ --}}
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
            <span style="font-size:16px">ℹ️</span>
            <div>Isi kolom di bawah sebelum mencetak. <strong>Data ini tidak disimpan</strong> — hanya untuk tampilan cetak.</div>
        </div>

        {{-- PREVIEW DATA --}}
        <div class="section-sep">Data Permohonan</div>
        <div class="data-preview">
            <div class="dp c2"><div class="dp-label">Nama</div><div class="dp-val">{{ $nama }}</div></div>
            <div class="dp c2"><div class="dp-label">NIK</div><div class="dp-val" style="font-family:monospace">{{ $nik }}</div></div>
            @foreach(collect($fieldsConfig)->where('group','biodata')->whereNotIn('key',['nama','nik','alamat']) as $bf)
                @if(($bf['type']??'') === 'section') @continue @endif
                @php
                    $bval = match($bf['key']) {
                        'tempat_tgl_lahir' => $ttlStr,
                        'jenis_kelamin'    => $jk,
                        'agama'            => $agama,
                        'pekerjaan'        => $pekerjaan,
                        'umur'             => !empty($dt['umur']) ? $dt['umur'].' Tahun' : '-',
                        'rt_rw'            => 'RT '.($dt['rt']??'-').' / RW '.($dt['rw']??'-'),
                        default            => $dt[$bf['key']] ?? '-',
                    };
                @endphp
                <div class="dp"><div class="dp-label">{{ $bf['print_label'] ?? $bf['label'] }}</div><div class="dp-val">{{ $bval }}</div></div>
            @endforeach
            <div class="dp c4"><div class="dp-label">Alamat</div><div class="dp-val">{{ $alamat }}</div></div>
            @foreach(collect($fieldsConfig)->where('group','extra') as $ef)
                @if(($ef['type']??'') === 'section')
                <div class="dp c4" style="padding:4px 0;border-top:1px solid #e2e8f0"><span style="font-size:10px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#94a3b8">{{ $ef['label'] }}</span></div>
                @elseif(($ef['print_style']??'') !== 'center_bold')
                <div class="dp c2"><div class="dp-label">{{ $ef['label'] }}</div><div class="dp-val">{{ $dt[$ef['key']] ?? '-' }}</div></div>
                @endif
            @endforeach
        </div>

        <hr class="divider">

        {{-- NOMOR & TANGGAL --}}
        <div class="section-sep">Nomor & Tanggal Surat</div>
        <div class="form-grid">
            <div class="form-group">
                <label class="form-label">Nomor Urut Surat <span class="req">*</span></label>
                <input type="number" class="form-input" id="inp_nomor_urut" min="1"
                    value="" style="max-width:120px" placeholder="Isi nomor urut" oninput="updateNomorPreview()">
                <div style="font-size:11px;color:#94a3b8;margin-top:4px">
                    Saran: <strong>{{ str_pad($nomorUrut, 3, '0', STR_PAD_LEFT) }}</strong> — Preview: <strong id="preview_nomor">-</strong>
                </div>
            </div>
            <div class="form-group">
                <label class="form-label">Kota, Tanggal Surat</label>
                <input type="text" class="form-input" id="inp_tgl" value="Teritih, {{ \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y') }}">
            </div>
            <div class="form-group">
                <label class="form-label">Kode Klasifikasi</label>
                <input type="hidden" id="inp_prefix" value="{{ $prefix }}">
                <div class="form-input" style="max-width:120px;background:#f8fafc;color:#374151;cursor:default">{{ $prefix }}</div>
            </div>
            <div class="form-group">
                <label class="form-label">Kode Surat (singkatan)</label>
                <input type="hidden" id="inp_kode" value="{{ $kode }}">
                <div class="form-input" style="max-width:120px;background:#f8fafc;color:#374151;cursor:default">{{ $kode }}</div>
            </div>
        </div>

        <script>
        function updateNomorPreview() {
            const num    = String(document.getElementById('inp_nomor_urut').value||'').padStart(3,'0');
            const prefix = document.getElementById('inp_prefix').value.trim() || '{{ $prefix }}';
            const kode   = document.getElementById('inp_kode').value.trim()   || '{{ $kode }}';
            document.getElementById('preview_nomor').textContent = prefix + ' / ' + num + ' / Kel.1010/' + kode + '/ {{ $bulanRomawi }} /{{ now()->format("Y") }}';
        }
        </script>

        <hr class="divider">

        {{-- ISI SURAT --}}
        <div class="section-sep">Isi / Keterangan Surat</div>
        <div class="form-group">
            <label class="form-label">Kalimat Keterangan</label>
            <textarea class="form-textarea" id="inp_isi" rows="5">{{ $isiDefault }}</textarea>
            <div style="font-size:11px;color:#94a3b8;margin-top:4px">Gunakan **teks** untuk bold. Admin bisa edit sebelum cetak.</div>
        </div>

        <hr class="divider">

        {{-- TTD --}}
        <div class="section-sep">Pejabat Penandatangan</div>
        <div id="ttd_list">
            <div class="ttd-entry" id="ttd_0">
                <div class="ttd-entry-label"><span>Penandatangan 1</span></div>
                <div class="form-grid">
                    <div class="form-group">
                        <label class="form-label">Jabatan</label>
                        <select class="form-select" id="inp_jabatan_0" onchange="onJabatanChange(0)">
                            <option value="An.Kepala Kelurahan Teritih|">An. Kepala Kelurahan Teritih</option>
                            <option value="Kepala Kelurahan Teritih|">Kepala Kelurahan Teritih</option>
                            <option value="custom|">Jabatan lain...</option>
                        </select>
                    </div>
                    <div class="form-group" id="grp_jabatan_custom_0" style="display:none;flex-direction:column;gap:6px">
                        <label class="form-label">Jabatan (ketik)</label>
                        <input type="text" class="form-input" id="inp_jab1_0" placeholder="Jabatan">
                    </div>
                </div>
                <div class="form-grid" style="margin-bottom:0">
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label">Nama Pejabat</label>
                        <input type="text" class="form-input" id="inp_nama_pejabat_0" placeholder="Nama + gelar">
                    </div>
                    <div class="form-group" style="margin-bottom:0">
                        <label class="form-label">NIP</label>
                        <input type="text" class="form-input" id="inp_nip_0" placeholder="NIP (opsional)">
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn-tambah-ttd" onclick="tambahTTD()">➕ Tambah Penandatangan</button>

        <hr class="divider">

        {{-- SAKSI --}}
        <div class="section-sep">Saksi-Saksi (Opsional)</div>
        <div style="margin-bottom:16px">
            <label style="display:flex;align-items:center;gap:10px;cursor:pointer;font-size:13px;font-weight:600;color:#374151;user-select:none">
                <input type="checkbox" id="chk_saksi" onchange="toggleSaksi()" style="width:16px;height:16px;accent-color:#1c64f2;cursor:pointer">
                Tampilkan kolom saksi-saksi di surat
            </label>
        </div>
        <div id="saksi_wrap" style="display:none">
            <div style="background:#f8fafc;border:1px solid #e2e8f0;border-radius:10px;padding:16px;margin-bottom:12px">
                <div style="font-size:11px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#94a3b8;margin-bottom:12px">Daftar Saksi</div>
                <div id="saksi_list">
                    <div class="saksi-entry" style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:8px">
                        <input type="text" class="form-input saksi-nama" placeholder="Nama Saksi 1">
                        <input type="text" class="form-input saksi-jabatan" placeholder="Jabatan/Keterangan (opsional)">
                    </div>
                    <div class="saksi-entry" style="display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:8px">
                        <input type="text" class="form-input saksi-nama" placeholder="Nama Saksi 2">
                        <input type="text" class="form-input saksi-jabatan" placeholder="Jabatan/Keterangan (opsional)">
                    </div>
                </div>
                <button type="button" onclick="tambahSaksi()" style="display:inline-flex;align-items:center;gap:6px;padding:7px 14px;border-radius:8px;border:1.5px dashed #93c5fd;background:#f0f9ff;color:#0284c7;font-size:12px;font-weight:600;cursor:pointer;font-family:inherit;margin-top:4px">➕ Tambah Saksi</button>
            </div>
        </div>

        <div class="btn-row">
            <button class="btn-cetak" onclick="cetakSurat()">🖨️ Cetak Surat</button>
            <a href="{{ route('permohonan.show', $permohonan->id_permohonan) }}" class="btn-back">← Kembali</a>
        </div>
    </div>
</div>


{{-- ═══ SURAT CETAK ═══ --}}
<div id="suratCetak">
<div class="surat">

    {{-- KOP --}}
    <div class="kop">
        <img src="{{ asset('images/lambang_kota_serang.jpg') }}" onerror="this.style.display='none'" alt="Logo">
        <div class="kop-teks">
            <div class="k1">PEMERINTAH KOTA SERANG</div>
            <div class="k2">KECAMATAN WALANTAKA</div>
            <div class="k3">KELURAHAN TERITIH</div>
            <div class="k4">Jl. Raya Teritih, Kecamatan Walantaka, Kota Serang, Banten 42183</div>
        </div>
    </div>

    {{-- JUDUL --}}
    <div class="judul">{{ $judulSurat }}</div>
    <div class="nomor">Nomor: <span id="pr_nomor"></span></div>

    {{-- PEMBUKA --}}
    @php
        $pembukaHtml = e($templatePembuka);
        $pembukaHtml = preg_replace('/\*\*(.+?)\*\*/', '<strong style="text-decoration:underline">$1</strong>', $pembukaHtml);
        $pembukaHtml = nl2br($pembukaHtml);
    @endphp
    <p class="pembuka">{!! $pembukaHtml !!}</p>

    {{-- BIODATA DINAMIS --}}
    @php $bioConfig = collect($fieldsConfig)->where('group', 'biodata')->values(); @endphp
    @php $tableOpened = false; @endphp
    @foreach($bioConfig as $bf)
        @if(($bf['type'] ?? '') === 'section')
            @if($tableOpened)</table>@php $tableOpened = false; @endphp @endif
            <p style="margin:16pt 0 8pt;font-weight:bold;text-decoration:underline;font-size:12pt">{{ $bf['label'] }}</p>
        @else
            @if(!$tableOpened)<table class="bio">@php $tableOpened = true; @endphp @endif
            @if($bf['key'] === 'nama')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $nama }}</td></tr>
            @elseif($bf['key'] === 'nik')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $nik }}</td></tr>
            @elseif($bf['key'] === 'tempat_tgl_lahir')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $ttlStr }}</td></tr>
            @elseif($bf['key'] === 'umur')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $dt['umur'] ?? '-' }} tahun</td></tr>
            @elseif($bf['key'] === 'jenis_kelamin')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $jk }}</td></tr>
            @elseif($bf['key'] === 'agama')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $agama }}</td></tr>
            @elseif($bf['key'] === 'status_kawin')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $dt['status_kawin'] ?? '-' }}</td></tr>
            @elseif($bf['key'] === 'kewarganegaraan')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $dt['kewarganegaraan'] ?? 'WNI' }}</td></tr>
            @elseif($bf['key'] === 'pekerjaan')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $pekerjaan }}</td></tr>
            @elseif($bf['key'] === 'pendidikan')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $dt['pendidikan'] ?? '-' }}</td></tr>
            @elseif($bf['key'] === 'alamat')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $alamat }}</td></tr>
            @elseif($bf['key'] === 'rt_rw')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ ($dt['rt'] ?? '-') }} / {{ ($dt['rw'] ?? '-') }}</td></tr>
            @elseif($bf['key'] === 'kelurahan')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $dt['kelurahan'] ?? 'Teritih' }}</td></tr>
            @elseif($bf['key'] === 'kecamatan')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $dt['kecamatan'] ?? 'Walantaka' }}</td></tr>
            @elseif($bf['key'] === 'no_hp')
            <tr><td>{{ $bf['print_label'] }}</td><td>:</td><td>{{ $dt['no_hp'] ?? '-' }}</td></tr>
            @else
            <tr><td>{{ $bf['print_label'] ?? $bf['label'] }}</td><td>:</td><td>{{ $dt[$bf['key']] ?? '-' }}</td></tr>
            @endif
        @endif
    @endforeach
    @if($tableOpened)</table>@endif

    {{-- Extra fields: render per group (support section separator) --}}
    @php $extras = collect($fieldsConfig)->where('group', 'extra')->values(); $extraTableOpened = false; @endphp
    @foreach($extras as $ef)
        @if(($ef['type'] ?? '') === 'section')
            @if($extraTableOpened)</table>@php $extraTableOpened = false; @endphp @endif
            <p style="margin:10pt 0 6pt;font-size:12pt">{{ $ef['label'] }}</p>
        @elseif(($ef['print_style'] ?? '') === 'center_bold')
            {{-- dirender terpisah setelah pr_isi --}}
        @elseif($ef['on_print'] ?? false)
            @if(!$extraTableOpened)<table class="bio">@php $extraTableOpened = true; @endphp @endif
            @php
                $val = $dt[$ef['key']] ?? '-';
                if (($ef['type'] ?? '') === 'date' && $val && $val !== '-') {
                    $val = \Carbon\Carbon::parse($val)->locale('id')->isoFormat('D MMMM Y');
                }
            @endphp
            <tr><td>{{ $ef['print_label'] ?? $ef['label'] }}</td><td>:</td><td>{{ $val }}</td></tr>
        @endif
    @endforeach
    @if($extraTableOpened)</table>@endif

    {{-- ISI SURAT --}}
    <p class="isi-surat" id="pr_isi"></p>

    {{-- Extra fields dengan print_style center_bold --}}
    @foreach(collect($fieldsConfig)->where('group','extra') as $ef)
        @if(($ef['print_style'] ?? '') === 'center_bold')
            @php $cbVal = $dt[$ef['key']] ?? ''; @endphp
            @if($cbVal)
            @php $cbPrefix = !empty($ef['template_text']) ? $ef['template_text'].' ' : ''; @endphp
            <p style="text-align:center;font-weight:bold;font-style:italic;margin:8px 0;font-size:12pt">{{ $cbPrefix }}{{ $cbVal }}</p>
            @endif
        @endif
    @endforeach

    {{-- PENUTUP --}}
    <p class="penutup">{{ $templatePenutup }}</p>

    {{-- TTD --}}
    <div id="pr_ttd_wrap" style="margin-top:14px"></div>

</div>
</div>


<script>
let ttdCount = 1;

function onJabatanChange(idx) {
    const grp = document.getElementById('grp_jabatan_custom_' + idx);
    const val = document.getElementById('inp_jabatan_' + idx)?.value || '';
    if (grp) grp.style.display = val.startsWith('custom') ? 'flex' : 'none';
    if (grp) grp.style.flexDirection = 'column';
    if (grp) grp.style.gap = '6px';
}

function tambahTTD() {
    const i = ttdCount++;
    document.getElementById('ttd_list').insertAdjacentHTML('beforeend', `
        <div class="ttd-entry" id="ttd_${i}">
            <div class="ttd-entry-label"><span>Penandatangan ${i+1}</span><button type="button" class="btn-hapus-ttd" onclick="this.closest('.ttd-entry').remove()">✕</button></div>
            <div class="form-grid">
                <div class="form-group"><label class="form-label">Jabatan</label>
                    <select class="form-select" id="inp_jabatan_${i}" onchange="onJabatanChange(${i})">
                        <option value="An.Kepala Kelurahan Teritih|">An. Kepala Kelurahan Teritih</option>
                        <option value="Kepala Kelurahan Teritih|">Kepala Kelurahan Teritih</option>
                        <option value="custom|">Jabatan lain...</option>
                    </select></div>
                <div class="form-group" id="grp_jabatan_custom_${i}" style="display:none;flex-direction:column;gap:6px">
                    <label class="form-label">Jabatan (ketik)</label>
                    <input type="text" class="form-input" id="inp_jab1_${i}" placeholder="Jabatan">
                </div>
            </div>
            <div class="form-grid" style="margin-bottom:0">
                <div class="form-group" style="margin-bottom:0"><label class="form-label">Nama</label><input type="text" class="form-input" id="inp_nama_pejabat_${i}"></div>
                <div class="form-group" style="margin-bottom:0"><label class="form-label">NIP</label><input type="text" class="form-input" id="inp_nip_${i}"></div>
            </div>
        </div>`);
}

function toggleSaksi() {
    const show = document.getElementById('chk_saksi').checked;
    document.getElementById('saksi_wrap').style.display = show ? 'block' : 'none';
}

function tambahSaksi() {
    const list = document.getElementById('saksi_list');
    const num = list.querySelectorAll('.saksi-entry').length + 1;
    const div = document.createElement('div');
    div.className = 'saksi-entry';
    div.style.cssText = 'display:grid;grid-template-columns:1fr 1fr;gap:8px;margin-bottom:8px';
    div.innerHTML = `<input type="text" class="form-input saksi-nama" placeholder="Nama Saksi ${num}">
        <input type="text" class="form-input saksi-jabatan" placeholder="Jabatan/Keterangan (opsional)">`;
    list.appendChild(div);
}

function collectTTDs() {
    const ttds = [];
    document.querySelectorAll('.ttd-entry').forEach(entry => {
        const i = entry.id.replace('ttd_', '');
        const jabSel = document.getElementById('inp_jabatan_' + i)?.value || '';
        let jab1, jab2 = '';
        if (jabSel.startsWith('custom')) {
            jab1 = document.getElementById('inp_jab1_' + i)?.value.trim() || '';
            jab2 = document.getElementById('inp_jab2_' + i)?.value.trim() || '';
        } else { const p = jabSel.split('|'); jab1 = p[0]||''; jab2 = p[1]||''; }
        ttds.push({
            jab1, jab2,
            nama: document.getElementById('inp_nama_pejabat_' + i)?.value.trim() || '____________________',
            nip: document.getElementById('inp_nip_' + i)?.value.trim() || '',
        });
    });
    return ttds;
}

function collectSaksi() {
    const saksi = [];
    document.querySelectorAll('#saksi_list .saksi-entry').forEach(row => {
        const nama = row.querySelector('.saksi-nama')?.value.trim() || '';
        const jabatan = row.querySelector('.saksi-jabatan')?.value.trim() || '';
        if (nama) saksi.push({ nama, jabatan });
    });
    return saksi;
}

function cetakSurat() {
    const nomorUrut = document.getElementById('inp_nomor_urut').value.trim();
    const tgl = document.getElementById('inp_tgl').value.trim();
    const isi = document.getElementById('inp_isi').value.trim();

    if (!nomorUrut || nomorUrut < 1) {
        showAlert('Nomor urut surat wajib diisi sebelum mencetak!', 'warning');
        document.getElementById('inp_nomor_urut').focus();
        return;
    }
    if (!document.getElementById('inp_nama_pejabat_0')?.value.trim()) {
        showAlert('Nama pejabat penandatangan wajib diisi!', 'warning');
        document.getElementById('inp_nama_pejabat_0').focus();
        return;
    }

    // Nomor surat
    const num = String(nomorUrut).padStart(3, '0');
    const prefix = document.getElementById('inp_prefix').value.trim() || '{{ $prefix }}';
    const kode   = document.getElementById('inp_kode').value.trim()   || '{{ $kode }}';
    const nomor = prefix + ' / ' + num + ' / Kel.1010/' + kode + '/ {{ $bulanRomawi }} /{{ now()->format("Y") }}';
    document.getElementById('pr_nomor').textContent = nomor;

    // Isi surat
    const parsed = isi.replace(/&/g,'&amp;').replace(/</g,'&lt;').replace(/>/g,'&gt;')
        .replace(/\*\*(.+?)\*\*/g, '<strong>$1</strong>').replace(/\n/g,'<br>');
    document.getElementById('pr_isi').innerHTML = parsed;

    // TTD layout
    const ttds = collectTTDs();
    const wrap = document.getElementById('pr_ttd_wrap');

    const ttdBoxHtml = (t) => `<div class="ttd-box">
        <p class="ttd-kota">${tgl}</p>
        <p>${t.jab1}</p>${t.jab2 ? `<p>${t.jab2}</p>` : ''}
        <div class="ttd-ruang"></div>
        <p class="ttd-nama">${t.nama}</p>
        ${t.nip ? `<p class="ttd-nip">NIP. ${t.nip}</p>` : ''}
    </div>`;

    // Saksi layout
    const pakai_saksi = document.getElementById('chk_saksi').checked;
    const saksiList = pakai_saksi ? collectSaksi() : [];

    if (saksiList.length > 0) {
        // Layout: kiri saksi, kanan TTD (semua TTD tumpuk kanan)
        const saksiHtml = `<div style="min-width:180px">
            <p style="font-weight:bold;margin-bottom:10pt">Saksi-Saksi</p>
            ${saksiList.map((s, i) => `<p style="margin-bottom:16pt">${i+1}. ........................ ( ${s.nama} )</p>`).join('')}
        </div>`;
        const ttdRight = `<div style="display:flex;flex-direction:column;align-items:flex-end;gap:8pt">
            ${ttds.map(t => ttdBoxHtml(t)).join('')}
        </div>`;
        wrap.innerHTML = `<div style="display:flex;justify-content:space-between;align-items:flex-end;gap:24px;margin-top:14px">${saksiHtml}${ttdRight}</div>`;
    } else if (ttds.length === 1) {
        wrap.innerHTML = `<div style="display:flex;justify-content:flex-end;margin-top:14px">${ttdBoxHtml(ttds[0])}</div>`;
    } else if (ttds.length === 2) {
        wrap.innerHTML = `<div style="display:flex;justify-content:space-around;gap:24px;margin-top:14px">${ttds.map(ttdBoxHtml).join('')}</div>`;
    } else if (ttds.length === 3) {
        // 2 atas + 1 tengah bawah
        wrap.innerHTML = `<div style="margin-top:14px">
            <div style="display:flex;justify-content:space-around;gap:24px">${ttdBoxHtml(ttds[0])}${ttdBoxHtml(ttds[1])}</div>
            <div style="display:flex;justify-content:center;margin-top:8pt">${ttdBoxHtml(ttds[2])}</div>
        </div>`;
    } else {
        // 4+ : baris berpasangan
        let rows = '';
        for (let i = 0; i < ttds.length; i += 2) {
            const pair = ttds.slice(i, i+2).map(ttdBoxHtml).join('');
            rows += `<div style="display:flex;justify-content:space-around;gap:24px;margin-bottom:8pt">${pair}</div>`;
        }
        wrap.innerHTML = `<div style="margin-top:14px">${rows}</div>`;
    }

    // Simpan nomor ke DB
    fetch('{{ route("permohonan.keterangan", $permohonan->id_permohonan) }}', {
        method: 'PUT',
        headers: { 'Content-Type': 'application/json', 'Accept': 'application/json', 'X-CSRF-TOKEN': '{{ csrf_token() }}' },
        body: JSON.stringify({ nomor_surat: nomor })
    });

    window.print();
}
// ── Custom Alert Modal ──
function showAlert(message, type = 'warning') {
    const existing = document.getElementById('customAlertOverlay');
    if (existing) existing.remove();
    const icons = { warning: '⚠️', error: '❌', success: '✅', info: 'ℹ️' };
    const colors = { warning: '#f59e0b', error: '#ef4444', success: '#10b981', info: '#1c64f2' };
    const overlay = document.createElement('div');
    overlay.id = 'customAlertOverlay';
    overlay.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,.4);display:flex;align-items:center;justify-content:center;z-index:99999';
    overlay.innerHTML = `<div style="background:white;border-radius:16px;padding:28px 32px;max-width:400px;width:90%;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,.2)">
        <div style="font-size:40px;margin-bottom:12px">${icons[type]}</div>
        <p style="font-size:15px;font-weight:600;color:#0f172a;margin:0 0 20px;line-height:1.5">${message}</p>
        <button onclick="document.getElementById('customAlertOverlay').remove()" style="padding:10px 32px;border-radius:10px;border:none;background:${colors[type]};color:white;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit">Mengerti</button>
    </div>`;
    document.body.appendChild(overlay);
    overlay.addEventListener('click', function(e) { if (e.target === overlay) overlay.remove(); });
}
</script>
</body>
</html>
