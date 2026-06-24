{{--
    Partial: data_khusus.blade.php
    Menampilkan section data khusus per jenis surat di halaman detail user.
    Variables: $jenis (string), $dt (array), $tgl (Closure), $permohonan (PermohonanSurat)
--}}

@if($jenis === 'sktm')
<div class="sec">
    <div class="sec-head">
        <div class="sec-icon" style="background:#ecfdf5;color:var(--green)"><i class="bi bi-file-text-fill"></i></div>
        <div class="sec-title">Keperluan Surat Keterangan Tidak Mampu (SKTM)</div>
    </div>
    <div class="fg">
        <div class="fi c2"><div class="fl">Tujuan / Keperluan SKTM</div><div class="fv">{{ $dt['keperluan_sktm'] ?? $permohonan->keperluan ?? '-' }}</div></div>
        <div class="fi c2"><div class="fl">Keterangan Tambahan</div><div class="fv">{{ $dt['keterangan_tambahan'] ?? '-' }}</div></div>
    </div>
</div>

@elseif($jenis === 'kematian' || $jenis === 'surat-keterangan-kematian')
<div class="sec">
    <div class="sec-head">
        <div class="sec-icon" style="background:#ecfdf5;color:var(--green)"><i class="bi bi-file-earmark-medical-fill"></i></div>
        <div class="sec-title">Data Kematian Almarhum / Almarhumah</div>
    </div>
    <div class="fg">
        <div class="fi"><div class="fl">Umur Saat Meninggal</div><div class="fv">{{ !empty($dt['umur']) ? $dt['umur'].' Tahun' : '-' }}</div></div>
        <div class="fi"><div class="fl">Hari Meninggal</div><div class="fv">{{ $dt['hari'] ?? $dt['hari_meninggal'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Tanggal Meninggal</div><div class="fv">{{ $dt['tanggal'] ?? $dt['tanggal_meninggal'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Tempat Meninggal</div><div class="fv">{{ $dt['tempat_meninggal'] ?? '-' }}</div></div>
        <div class="fi c2"><div class="fl">Sebab Meninggal</div><div class="fv">{{ $dt['sebab_meninggal'] ?? '-' }}</div></div>
        <div class="fi c2"><div class="fl">Keperluan Surat</div><div class="fv">{{ $permohonan->keperluan ?? '-' }}</div></div>
    </div>
</div>

@elseif($jenis === 'suami-istri' || $jenis === 'surat-keterangan-suami-istri')
<div class="sec">
    <div class="sec-head">
        <div class="sec-icon" style="background:#fff1f2;color:#f43f5e"><i class="bi bi-people-fill"></i></div>
        <div class="sec-title">Data Istri & Pernikahan</div>
    </div>
    <div class="fg">
        <div class="fi c2"><div class="fl">Nama Lengkap Istri</div><div class="fv" style="font-weight:700">{{ $dt['nama_istri'] ?? '-' }}</div></div>
        <div class="fi c2"><div class="fl">NIK Istri</div><div class="fv mono">{{ $dt['nik_istri'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Tempat / Tanggal Lahir Istri</div><div class="fv">{{ $dt['ttl_istri'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Agama Istri</div><div class="fv">{{ $dt['agama_istri'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Pekerjaan Istri</div><div class="fv">{{ $dt['pekerjaan_istri'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Tahun Menikah</div><div class="fv">{{ $dt['tahun_menikah'] ?? '-' }}</div></div>
        <div class="fi c4"><div class="fl">Alamat Istri</div><div class="fv">{{ !empty($dt['alamat_istri']) ? $dt['alamat_istri'] : 'Sama dengan alamat suami' }}</div></div>
    </div>
</div>

@elseif($jenis === 'beda-nama')
<div class="sec">
    <div class="sec-head">
        <div class="sec-icon" style="background:#fffbeb;color:#d97706"><i class="bi bi-arrow-left-right"></i></div>
        <div class="sec-title">Detail Perbedaan Nama pada Dokumen</div>
    </div>
    <div class="nama-compare">
        <div class="nc-head">Nama di KTP</div>
        <div class="nc-mid head" style="font-size:11px;font-weight:700;color:var(--muted);text-align:center">VS</div>
        <div class="nc-head">Nama di {{ $dt['jenis_dokumen_2'] ?? 'Dokumen Lain' }}</div>
        <div class="nc-val">{{ $dt['nama_dokumen_1'] ?? ($permohonan->nama_pemohon ?? '-') }}</div>
        <div class="nc-mid"><i class="bi bi-arrow-left-right" style="font-size:18px;color:var(--muted)"></i></div>
        <div class="nc-val">{{ $dt['nama_dokumen_2'] ?? '-' }}</div>
    </div>
    <div class="nc-note"><i class="bi bi-info-circle-fill" style="flex-shrink:0"></i> Kedua nama di atas adalah satu orang yang sama dan akan dinyatakan resmi dalam surat keterangan ini.</div>
    <div class="fg" style="border-top:1px solid var(--border)">
        <div class="fi c2"><div class="fl">Jenis Dokumen Pembanding</div><div class="fv">{{ $dt['jenis_dokumen_2'] ?? '-' }}</div></div>
        <div class="fi c2"><div class="fl">Keperluan Surat</div><div class="fv">{{ $permohonan->keperluan ?? '-' }}</div></div>
    </div>
</div>

@elseif($jenis === 'izin-cuti' || $jenis === 'surat-keterangan-izin-cuti')
<div class="sec">
    <div class="sec-head">
        <div class="sec-icon" style="background:var(--blue-lt);color:var(--blue)"><i class="bi bi-calendar-check-fill"></i></div>
        <div class="sec-title">Detail Izin Cuti</div>
    </div>
    <div class="fg">
        <div class="fi c2"><div class="fl">Nama Perusahaan / Instansi</div><div class="fv" style="font-weight:700;font-size:15px">{{ $dt['nama_perusahaan'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Lama Cuti</div><div class="fv">{{ !empty($dt['lama_cuti']) ? $dt['lama_cuti'].' Hari' : '-' }}</div></div>
        <div class="fi"><div class="fl">Keperluan / Alasan Cuti</div><div class="fv">{{ $permohonan->keperluan ?? '-' }}</div></div>
        <div class="fi c2"><div class="fl">Tanggal Mulai Cuti</div><div class="fv" style="font-weight:700">{{ $tgl($dt['tanggal_mulai_cuti'] ?? null) }}</div></div>
        <div class="fi c2"><div class="fl">Tanggal Selesai Cuti</div><div class="fv" style="font-weight:700">{{ $tgl($dt['tanggal_selesai_cuti'] ?? null) }}</div></div>
    </div>
</div>
@endif
