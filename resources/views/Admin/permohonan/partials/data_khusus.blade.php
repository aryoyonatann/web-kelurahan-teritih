{{--
    Partial: data_khusus.blade.php
    Menampilkan section data khusus per jenis surat di halaman detail admin.
    Variables: $jenis (string), $dt (array), $tgl (Closure), $data (PermohonanSurat), $nama (string)
--}}

@if($jenis === 'sktm')
<div class="section-card">
    <div class="section-head">
        <div class="section-head-icon green"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
        <h3>Keperluan SKTM</h3>
    </div>
    <div class="fg">
        <div class="fi c2">
            <div class="fl">Tujuan / Keperluan</div>
            <div class="fv">{{ $dt['keperluan_sktm'] ?? $data->keperluan ?? '-' }}</div>
        </div>
        <div class="fi c2">
            <div class="fl">Keterangan Tambahan</div>
            <div class="fv">{{ $dt['keterangan_tambahan'] ?? '-' }}</div>
        </div>
    </div>
</div>

@elseif($jenis === 'kematian')
<div class="section-card">
    <div class="section-head">
        <div class="section-head-icon green"><svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg></div>
        <h3>Data Kematian</h3>
    </div>
    <div class="fg">
        <div class="fi"><div class="fl">Umur Saat Meninggal</div><div class="fv">{{ !empty($dt['umur']) ? $dt['umur'].' Tahun' : '-' }}</div></div>
        <div class="fi"><div class="fl">Hari Meninggal</div><div class="fv">{{ $dt['hari'] ?? $dt['hari_meninggal'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Tanggal Meninggal</div><div class="fv">{{ $dt['tanggal'] ?? $dt['tanggal_meninggal'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Tempat Meninggal</div><div class="fv">{{ $dt['tempat_meninggal'] ?? '-' }}</div></div>
        <div class="fi c2"><div class="fl">Sebab Meninggal</div><div class="fv">{{ $dt['sebab_meninggal'] ?? '-' }}</div></div>
        <div class="fi c2"><div class="fl">Keperluan Surat</div><div class="fv">{{ $data->keperluan ?? '-' }}</div></div>
    </div>
</div>

@elseif($jenis === 'suami-istri')
<div class="section-card">
    <div class="section-head">
        <div class="section-head-icon rose"><i class="bi bi-people-fill" style="font-size:14px"></i></div>
        <h3>Data Istri & Pernikahan</h3>
    </div>
    <div class="fg">
        <div class="fi c2"><div class="fl">Nama Lengkap Istri</div><div class="fv" style="font-weight:700">{{ $dt['nama_istri'] ?? '-' }}</div></div>
        <div class="fi c2"><div class="fl">NIK Istri</div><div class="fv mono">{{ $dt['nik_istri'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Tempat / Tgl Lahir Istri</div><div class="fv">{{ $dt['ttl_istri'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Agama Istri</div><div class="fv">{{ $dt['agama_istri'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Pekerjaan Istri</div><div class="fv">{{ $dt['pekerjaan_istri'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Tahun Menikah</div><div class="fv" style="font-weight:700">{{ $dt['tahun_menikah'] ?? '-' }}</div></div>
        <div class="fi c4"><div class="fl">Alamat Istri</div><div class="fv">{{ !empty($dt['alamat_istri']) ? $dt['alamat_istri'] : 'Sama dengan alamat suami' }}</div></div>
    </div>
</div>

@elseif($jenis === 'beda-nama')
<div class="section-card">
    <div class="section-head">
        <div class="section-head-icon amber"><i class="bi bi-arrow-left-right" style="font-size:14px"></i></div>
        <h3>Detail Perbedaan Nama</h3>
    </div>
    <div class="diff-compare">
        <div class="dc-head">Nama di KTP</div>
        <div class="dc-mid head" style="font-size:11px;font-weight:700;color:var(--gray-400)">VS</div>
        <div class="dc-head">Nama di {{ $dt['jenis_dokumen_2'] ?? 'Dokumen Lain' }}</div>
        <div class="dc-val">{{ $dt['nama_dokumen_1'] ?? $nama }}</div>
        <div class="dc-mid"><i class="bi bi-arrow-left-right" style="font-size:16px;color:var(--gray-300)"></i></div>
        <div class="dc-val">{{ $dt['nama_dokumen_2'] ?? '-' }}</div>
    </div>
    <div class="diff-note"><i class="bi bi-info-circle-fill" style="flex-shrink:0"></i> Kedua nama di atas adalah satu orang yang sama.</div>
    <div class="fg" style="border-top:1px solid var(--gray-200)">
        <div class="fi c2"><div class="fl">Jenis Dokumen Pembanding</div><div class="fv">{{ $dt['jenis_dokumen_2'] ?? '-' }}</div></div>
        <div class="fi c2"><div class="fl">Keperluan Surat</div><div class="fv">{{ $data->keperluan ?? '-' }}</div></div>
    </div>
</div>

@elseif($jenis === 'izin-cuti')
<div class="section-card">
    <div class="section-head">
        <div class="section-head-icon blue"><i class="bi bi-calendar-check-fill" style="font-size:14px"></i></div>
        <h3>Detail Izin Cuti</h3>
    </div>
    <div class="fg">
        <div class="fi c2"><div class="fl">Nama Perusahaan / Instansi</div><div class="fv" style="font-weight:700;font-size:15px">{{ $dt['nama_perusahaan'] ?? '-' }}</div></div>
        <div class="fi"><div class="fl">Lama Cuti</div><div class="fv">{{ !empty($dt['lama_cuti']) ? $dt['lama_cuti'].' Hari' : '-' }}</div></div>
        <div class="fi"><div class="fl">Keperluan / Alasan</div><div class="fv">{{ $data->keperluan ?? '-' }}</div></div>
        <div class="fi c2"><div class="fl">Tanggal Mulai Cuti</div><div class="fv" style="font-weight:700">{{ $tgl($dt['tanggal_mulai_cuti'] ?? null) }}</div></div>
        <div class="fi c2"><div class="fl">Tanggal Selesai Cuti</div><div class="fv" style="font-weight:700">{{ $tgl($dt['tanggal_selesai_cuti'] ?? null) }}</div></div>
    </div>
</div>
@endif
