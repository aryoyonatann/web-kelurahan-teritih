<?php
$sku = App\Models\JenisSurat::find(2);

$fieldsConfig = [
    // BIODATA
    ['key'=>'nama',            'label'=>'Nama Lengkap',           'type'=>'text',     'print_label'=>'N a m a',           'group'=>'biodata','required'=>true],
    ['key'=>'nik',             'label'=>'NIK',                    'type'=>'text',     'print_label'=>'N I K',             'group'=>'biodata','required'=>true],
    ['key'=>'tempat_tgl_lahir','label'=>'Tempat / Tanggal Lahir', 'type'=>'ttl',      'print_label'=>'Tempat / Tgl Lahir','group'=>'biodata','required'=>true],
    ['key'=>'jenis_kelamin',   'label'=>'Jenis Kelamin',          'type'=>'select',   'print_label'=>'Jenis Kelamin',     'group'=>'biodata','required'=>true],
    ['key'=>'agama',           'label'=>'Bangsa / Agama',         'type'=>'agama',    'print_label'=>'Bangsa / Agama',    'group'=>'biodata','required'=>true],
    ['key'=>'pekerjaan',       'label'=>'Pekerjaan',              'type'=>'text',     'print_label'=>'Pekerjaan',         'group'=>'biodata','required'=>true],
    ['key'=>'alamat',          'label'=>'Alamat',                 'type'=>'textarea', 'print_label'=>'Alamat',            'group'=>'biodata','required'=>true],
    // EXTRA — domisili tidak dicetak di tabel (dipakai sbg {domisili} di template_isi)
    ['key'=>'domisili',        'label'=>'Domisili Saat Ini',      'type'=>'textarea', 'print_label'=>'Domisili Saat Ini', 'group'=>'extra',  'required'=>true, 'on_print'=>false],
    // Jenis Usaha + Alamat Usaha tampil di tabel cetak setelah template_isi
    ['key'=>'jenis_usaha',     'label'=>'Jenis Usaha',            'type'=>'text',     'print_label'=>'Jenis Usaha',       'group'=>'extra',  'required'=>true, 'on_print'=>true],
    ['key'=>'alamat_usaha',    'label'=>'Alamat Usaha',           'type'=>'textarea', 'print_label'=>'Alamat Usaha',      'group'=>'extra',  'required'=>true, 'on_print'=>true],
];

// Gunakan DB::table untuk update langsung ke kolom JSON string
// supaya tidak ada double-encode oleh Eloquent cast
\Illuminate\Support\Facades\DB::table('jenis_surat')
    ->where('id_jenis_surat', 2)
    ->update([
        'fields_config'    => json_encode($fieldsConfig, JSON_UNESCAPED_UNICODE),
        'template_pembuka' => 'Yang bertanda tangan di bawah ini Kepala Kelurahan Teritih Kecamatan Walantaka Kota Serang, menerangkan bahwa :',
        'template_isi'     => 'Benar nama tersebut di atas pada saat ini berdomisili di {domisili} Kelurahan Teritih  Kecamatan  Walantaka  Kota Serang - Banten.Dan nama tersebut pada saat ini mempunyai usaha :',
        'template_penutup' => 'Demikian surat keterangan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.',
    ]);

// Verify
$fresh = \Illuminate\Support\Facades\DB::table('jenis_surat')->where('id_jenis_surat', 2)->first();
$fc = json_decode($fresh->fields_config, true);
echo "template_isi: " . $fresh->template_isi . "\n";
echo "fields_config count: " . count($fc) . "\n";
foreach ($fc as $f) {
    $op = isset($f['on_print']) ? ($f['on_print'] ? 'print' : 'no-print') : 'bio';
    echo "  [{$f['group']}] {$f['key']} | {$f['label']} | type={$f['type']} | $op\n";
}
echo "\nDone!\n";
