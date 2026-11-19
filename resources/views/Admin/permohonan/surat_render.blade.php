<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Surat</title>
<style>
{{-- CSS SAMA PERSIS dengan #suratCetak section di print.blade.php --}}
*{box-sizing:border-box;margin:0;padding:0}
body{background:white}
.surat{width:210mm;min-height:297mm;padding:10mm 18mm 10mm 22mm;font-family:'Times New Roman',Times,serif;font-size:12pt;line-height:1.4;color:black}
.kop{display:flex;align-items:center;gap:10px;padding-bottom:8px;border-bottom:3px double black;margin-bottom:0}
.kop img{width:100px;height:auto}
.kop-teks{text-align:center;flex:1;line-height:1.2}
.kop-teks .k1{font-size:24pt;font-weight:bold;letter-spacing:.04em}
.kop-teks .k2{font-size:24pt;font-weight:bold;letter-spacing:.04em}
.kop-teks .k3{font-size:24pt;font-weight:bold;letter-spacing:.04em}
.kop-teks .k4{font-size:12pt;margin-top:2px;font-style:italic}
.judul{text-align:center;font-size:14pt;font-weight:bold;text-decoration:underline;text-transform:uppercase;letter-spacing:.08em;margin:14px 0 2px}
.nomor{text-align:center;font-size:12pt;margin-bottom:14px}
.pembuka{text-align:justify;margin-bottom:18px;text-indent:36px;font-size:12pt}
.bio{width:100%;border-collapse:collapse;margin-bottom:18px}
.bio tr td{padding:0 0;vertical-align:top;font-size:12pt}
.bio tr td:first-child{width:145px}
.bio tr td:nth-child(2){width:12px;padding:0 6px}
.isi-surat{text-align:justify;margin-top:0;margin-bottom:18px;white-space:pre-wrap;word-break:break-word;font-size:12pt;text-indent:36px}
.penutup{text-align:justify;margin-top:0;margin-bottom:8px;font-size:12pt;text-indent:36px}
.keterangan{text-align:justify;margin:6pt 0;font-size:12pt}
.keterangan.indented{text-indent:36px}
.ttd-box{text-align:center;min-width:200px;font-size:12pt;margin-top:24pt}
.ttd-kota{margin-bottom:2px}
.ttd-ruang{height:70px;display:flex;align-items:center;justify-content:center}
.ttd-ruang img{height:70px;width:auto;max-width:200px}
.ttd-nama{font-weight:bold;text-decoration:underline;margin-bottom:0;line-height:1.3}
.ttd-nip{font-weight:bold;font-size:12pt;margin-top:1px;line-height:1.3}
.keperluan-center{text-align:center;font-weight:bold;text-decoration:underline;margin:8px 0;font-size:12pt}

</style>
</head>
<body>
<div class="surat">

@php
    // ── Parse data tambahan ───────────────────────────────────────────────
    $dtRaw = $permohonan->data_tambahan;
    if (is_array($dtRaw))      { $dt = $dtRaw; }
    elseif (is_string($dtRaw)) { $decoded = json_decode($dtRaw, true); $dt = is_string($decoded) ? json_decode($decoded, true) ?? [] : ($decoded ?? []); }
    else                       { $dt = []; }

    // ── Config jenis surat ────────────────────────────────────────────────
    $js              = $permohonan->jenisSurat;
    $prefix          = optional($js)->kode_klasifikasi ?? '470';
    $kode            = optional($js)->kode_surat ?? 'SK';
    $judulSurat      = strtoupper(optional($js)->nama_surat ?? 'SURAT KETERANGAN');
    $fieldsConfig    = optional($js)->fields_config ?? [];
    $templatePembuka = optional($js)->template_pembuka ?? 'Yang bertanda tangan di bawah ini Kepala Kelurahan Teritih Kecamatan Walantaka Kota Serang menerangkan bahwa:';
    $templateIsi     = optional($js)->template_isi ?? '';
    $templatePenutup = optional($js)->template_penutup ?? 'Demikian surat keterangan ini kami buat dengan sebenar-benarnya dan untuk dipergunakan sebagaimana mestinya.';

    // ── Data pemohon ──────────────────────────────────────────────────────
    $nama      = $permohonan->nama_pemohon  ?? '-';
    $nik       = $permohonan->nik_pemohon   ?? '-';
    $alamat    = $permohonan->alamat_pemohon ?? '-';
    $ttlStr    = trim(($dt['tempat_lahir'] ?? '') . (isset($dt['tanggal_lahir']) && $dt['tanggal_lahir'] ? ', ' . \Carbon\Carbon::parse($dt['tanggal_lahir'])->locale('id')->isoFormat('D MMMM Y') : ''));
    $jk        = $dt['jenis_kelamin'] ?? '-';
    $agama     = $dt['agama'] ?? '-';
    $pekerjaan = $dt['pekerjaan'] ?? '-';

    // ── Replacements ──────────────────────────────────────────────────────
    $replacements = [
        '{nama}'=>$nama, '{nik}'=>$nik, '{alamat}'=>$alamat, '{domisili}'=>$alamat,
        '{tempat_lahir}'=>$dt['tempat_lahir']??'',
        '{tanggal_lahir}'=>isset($dt['tanggal_lahir'])&&$dt['tanggal_lahir'] ? \Carbon\Carbon::parse($dt['tanggal_lahir'])->locale('id')->isoFormat('D MMMM Y') : '',
        '{jenis_kelamin}'=>$jk, '{agama}'=>$agama, '{pekerjaan}'=>$pekerjaan,
    ];
    foreach (collect($fieldsConfig)->where('group','extra')->values() as $ef) {
        $replacements['{'.$ef['key'].'}'] = $dt[$ef['key']] ?? '';
    }
    $isiReplaced = str_replace(array_keys($replacements), array_values($replacements), $templateIsi);

    // ── Nomor surat ───────────────────────────────────────────────────────
    $nomorFormatted = $prefix . ' / ' . str_pad($nomorUrut, 3, '0', STR_PAD_LEFT)
        . ' / Kel.1010/' . $kode . '/ ' . $bulanRomawi . ' /' . now()->year;

    // ── Logo (base64 agar tidak butuh HTTP request dari Puppeteer) ───────
    $logoPath = public_path('images/lambang_kota_serang.jpg');
    $logoSrc  = '';
    if (file_exists($logoPath)) {
        $logoSrc = 'data:image/jpeg;base64,' . base64_encode(file_get_contents($logoPath));
    }

    // ── TTD image (base64) ────────────────────────────────────────────────
    $ttdImgSrc = '';
    if (!empty($ttd->ttd_data)) {
        $ttdImgSrc = $ttd->ttd_data; // sudah base64 data URI
    } elseif (!empty($ttd->ttd_path)) {
        $ttdFile = storage_path('app/public/' . $ttd->ttd_path);
        if (file_exists($ttdFile)) {
            $ext = strtolower(pathinfo($ttdFile, PATHINFO_EXTENSION));
            $mime = $ext === 'png' ? 'image/png' : 'image/jpeg';
            $ttdImgSrc = 'data:' . $mime . ';base64,' . base64_encode(file_get_contents($ttdFile));
        }
    }

    // ── Tanggal ───────────────────────────────────────────────────────────
    $tglCetak = 'Serang, ' . \Carbon\Carbon::now()->locale('id')->isoFormat('D MMMM Y');

    // ── Pembuka parse bold ────────────────────────────────────────────────
    $pembukaHtml = e($templatePembuka);
    $pembukaHtml = preg_replace('/\*\*(.+?)\*\*/', '<strong style="text-decoration:underline">$1</strong>', $pembukaHtml);
    $pembukaHtml = nl2br($pembukaHtml);

    // ── Isi parse bold ────────────────────────────────────────────────────
    $isiHtml = '';
    if ($isiReplaced) {
        $isiHtml = e($isiReplaced);
        $isiHtml = preg_replace('/\*\*(.+?)\*\*/', '<strong>$1</strong>', $isiHtml);
    }
@endphp

{{-- ═══ KOP SURAT ═══ --}}
<div class="kop">
    @if($logoSrc)<img src="{{ $logoSrc }}" alt="Logo">@endif
    <div class="kop-teks">
        <div class="k1">PEMERINTAH KOTA SERANG</div>
        <div class="k2">KECAMATAN WALANTAKA</div>
        <div class="k3">KELURAHAN TERITIH</div>
        <div class="k4">Jln. Kalodran-Sidapurna Nomor 001 Kel. Teritih Kec. Walantaka</div>
    </div>
</div>

{{-- ═══ JUDUL & NOMOR ═══ --}}
<div class="judul">{{ $judulSurat }}</div>
<div class="nomor">Nomor: {{ $nomorFormatted }}</div>

{{-- ═══ PEMBUKA ═══ --}}
<p class="pembuka">{!! $pembukaHtml !!}</p>

{{-- ═══ BIODATA (sama persis dengan #suratCetak di print.blade.php) ═══ --}}
@php $bioConfig = collect($fieldsConfig)->where('group','biodata')->values(); $tableOpened = false; @endphp
@foreach($bioConfig as $bf)
    @if(($bf['type'] ?? '') === 'section')
        @if($tableOpened)</table>@php $tableOpened = false; @endphp @endif
        @php
            $bioSecCss = '';
            $bioSecStyle = $bf['print_style'] ?? 'bold_underline';
            if (in_array($bioSecStyle,['bold','bold_underline'])) $bioSecCss .= 'font-weight:bold;';
            if (in_array($bioSecStyle,['underline','bold_underline'])) $bioSecCss .= 'text-decoration:underline;';
        @endphp
        <p style="margin:16pt 0 8pt;font-size:12pt;{{ $bioSecCss }}">{{ $bf['label'] }}</p>
    @else
        @if(!$tableOpened)<table class="bio">@php $tableOpened = true; @endphp @endif
        @php
            $bLabel = $bf['print_label'] ?? $bf['label'] ?? $bf['key'];
            $bVal = match($bf['key']) {
                'nama'            => $nama,
                'nik'             => $nik,
                'tempat_tgl_lahir'=> $ttlStr,
                'umur'            => ($dt['umur'] ?? '-') . ' tahun',
                'jenis_kelamin'   => $jk,
                'agama'           => $agama,
                'status_kawin'    => $dt['status_kawin'] ?? '-',
                'kewarganegaraan' => $dt['kewarganegaraan'] ?? 'WNI',
                'pekerjaan'       => $pekerjaan,
                'pendidikan'      => $dt['pendidikan'] ?? '-',
                'alamat'          => $alamat,
                'rt_rw'           => ($dt['rt'] ?? '-') . ' / ' . ($dt['rw'] ?? '-'),
                'kelurahan'       => $dt['kelurahan'] ?? 'Teritih',
                'kecamatan'       => $dt['kecamatan'] ?? 'Walantaka',
                'no_hp'           => $dt['no_hp'] ?? '-',
                default           => $dt[$bf['key']] ?? '-',
            };
        @endphp
        <tr>
            <td>{{ $bLabel }}</td><td>:</td>
            <td>@if($bf['key']==='nama')<strong>{{ $bVal }}</strong>@else{{ $bVal }}@endif</td>
        </tr>
    @endif
@endforeach
@if($tableOpened)</table>@endif

{{-- ═══ EXTRA FIELDS ═══ --}}
@php $extras = collect($fieldsConfig)->where('group','extra')->values(); $extraTableOpened = false; @endphp
@foreach($extras as $ef)
    @if(($ef['type'] ?? '') === 'section')
        @if($extraTableOpened)</table>@php $extraTableOpened = false; @endphp @endif
        @php
            $secLbl = str_replace(array_keys($replacements), array_values($replacements), $ef['label']);
            $secSt  = $ef['print_style'] ?? '';
            $secCss = '';
            if (in_array($secSt,['bold','bold_underline'])) $secCss .= 'font-weight:bold;';
            if (in_array($secSt,['underline','bold_underline'])) $secCss .= 'text-decoration:underline;';
        @endphp
        <p class="keterangan" style="{{ $secCss }}">{{ $secLbl }}</p>
    @elseif(($ef['print_style'] ?? '') === 'center_bold')
        @php
            $cbVal = $dt[$ef['key']] ?? '';
            $cbPfx = str_replace(array_keys($replacements), array_values($replacements), $ef['template_text'] ?? '');
            $cbPfx = $cbPfx ? $cbPfx . ' ' : '';
        @endphp
        @if($cbVal)<p class="keperluan-center">{{ $cbPfx }}{{ $cbVal }}</p>@endif
    @elseif($ef['on_print'] ?? false)
        @if(!$extraTableOpened)<table class="bio">@php $extraTableOpened = true; @endphp @endif
        @php
            $exVal = $dt[$ef['key']] ?? '-';
            if (($ef['type']??'') === 'date' && $exVal && $exVal !== '-')
                $exVal = \Carbon\Carbon::parse($exVal)->locale('id')->isoFormat('D MMMM Y');
        @endphp
        <tr><td>{{ $ef['print_label'] ?? $ef['label'] }}</td><td>:</td><td>{{ $exVal }}</td></tr>
    @endif
@endforeach
@if($extraTableOpened)</table>@endif

{{-- ═══ ISI SURAT ═══ --}}
@if($isiHtml)
<p class="isi-surat">{!! $isiHtml !!}</p>
@endif

{{-- ═══ PENUTUP ═══ --}}
<p class="penutup">{{ $templatePenutup }}</p>

{{-- ═══ TTD (kanan, sama seperti print.blade.php) + TTD Digital ═══ --}}
<div style="display:flex;justify-content:flex-end;margin-top:14px">
    <div class="ttd-box">
        <p class="ttd-kota">{{ $tglCetak }}</p>
        <p>{{ $ttd->jabatan }}</p>
        <div class="ttd-ruang">
            @if($ttdImgSrc)
                <img src="{{ $ttdImgSrc }}" alt="TTD Digital">
            @endif
        </div>
        <p class="ttd-nama">{{ $ttd->nama }}</p>
        @if($ttd->nip)
        <p class="ttd-nip">NIP. {{ $ttd->nip }}</p>
        @endif
    </div>
</div>

</div>
</body>
</html>
