<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;
use App\Models\StatistikDemografi;

class ProfilController extends Controller
{
    private array $singkatKeys = [
        'kode_pos', 'luas_wilayah', 'kecamatan', 'kota', 'provinsi',
    ];

    public function index()
    {
        $dataSingkat = [];
        foreach ($this->singkatKeys as $key) {
            $default = match($key) {
                'kode_pos'     => '42183',
                'luas_wilayah' => '2.54',
                'kecamatan'    => 'Walantaka',
                'kota'         => 'Serang',
                'provinsi'     => 'Banten',
                default        => '',
            };
            $dataSingkat[$key] = Pengaturan::getValue($key, $default);
        }

        // Ambil total penduduk langsung dari StatistikDemografi (auto-sync dengan halaman Informasi)
        $statistik = StatistikDemografi::asCollection();
        $dataSingkat['jumlah_penduduk'] = isset($statistik['total_penduduk'])
            ? number_format($statistik['total_penduduk']->nilai, 0, ',', '.')
            : Pengaturan::getValue('jumlah_penduduk', '4.520');

        $nodeKeys = ['lurah','sekretaris','kasi-pemum','pelaksana','op-sanusi','op-hawari','kasi-pmk','op-hasan','kasi-trantibum','op-afif','op-jamaludin'];
        $pegawai = [];
        foreach ($nodeKeys as $key) {
            $pegawai[$key] = [
                'nama' => Pengaturan::getValue('pegawai_'.$key.'_nama', ''),
                'nip'  => Pengaturan::getValue('pegawai_'.$key.'_nip',  ''),
                'foto' => Pengaturan::getValue('pegawai_'.$key.'_foto', ''),
            ];
        }

        return view('profil', compact('dataSingkat', 'pegawai'));
    }
}