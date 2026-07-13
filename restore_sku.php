<?php
// Restore SKU ke kondisi SEMULA berdasarkan screenshot awal sesi
// Extra fields: Domisili Saat Ini, Jenis Usaha, Lokasi Usaha
// template_isi: teks dengan (domisili) bukan {domisili}

// Ambil fields_config biodata yang ada sekarang (tidak berubah)
$current = \Illuminate\Support\Facades\DB::table('jenis_surat')->where('id_jenis_surat', 2)->first();
$fc = json_decode($current->fields_config, true);
$bioFields = collect($fc)->where('group', 'biodata')->values()->toArray();

// Extra fields semula (dari screenshot awal)
$extraFields = [
    ['key'=>'domisili',    'label'=>'Domisili Saat Ini', 'type'=>'textarea', 'print_label'=>'Domisili Saat Ini', 'group'=>'extra', 'required'=>true, 'on_print'=>true],
    ['key'=>'jenis_usaha', 'label'=>'Jenis Usaha',       'type'=>'text',     'print_label'=>'Jenis Usaha',       'group'=>'extra', 'required'=>true, 'on_print'=>true],
    ['key'=>'lokasi_usaha','label'=>'Lokasi Usaha',       'type'=>'text',     'print_label'=>'Lokasi Usaha',      'group'=>'extra', 'required'=>true, 'on_print'=>true],
];

$fieldsConfig = array_merge($bioFields, $extraFields);

\Illuminate\Support\Facades\DB::table('jenis_surat')
    ->where('id_jenis_surat', 2)
    ->update([
        'fields_config'    => json_encode($fieldsConfig, JSON_UNESCAPED_UNICODE),
        'template_pembuka' => 'Yang bertanda tangan di bawah ini Kepala Kelurahan Teritih Kecamatan Walantaka Kota Serang, menerangkan bahwa :',
        'template_isi'     => 'Benar nama tersebut di atas pada saat ini berdomisili di (domisili) Kelurahan Teritih  Kecamatan  Walantaka  Kota Serang - Banten.Dan nama tersebut pada saat ini mempunyai usaha :',
        'template_penutup' => 'Demikian surat keterangan ini kami buat dengan sebenarnya, untuk dipergunakan sebagaimana mestinya.',
    ]);

// Verify
$fresh = \Illuminate\Support\Facades\DB::table('jenis_surat')->where('id_jenis_surat', 2)->first();
$fc2 = json_decode($fresh->fields_config, true);
echo "=== Restored ===\n";
echo "template_isi: " . $fresh->template_isi . "\n";
echo "Extra fields:\n";
foreach (collect($fc2)->where('group','extra') as $f) {
    echo "  " . $f['key'] . " | " . $f['label'] . " | type=" . $f['type'] . "\n";
}
echo "Done!\n";
