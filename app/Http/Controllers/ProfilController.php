<?php

namespace App\Http\Controllers;

use App\Models\Pengaturan;

class ProfilController extends Controller
{
    private array $singkatKeys = [
        'kode_pos', 'luas_wilayah', 'jumlah_penduduk',
        'kecamatan', 'kota', 'provinsi',
    ];

    public function index()
    {
        $dataSingkat = [];
        foreach ($this->singkatKeys as $key) {
            $default = match($key) {
                'kode_pos'        => '42183',
                'luas_wilayah'    => '2.54',
                'jumlah_penduduk' => '4.520',
                'kecamatan'       => 'Walantaka',
                'kota'            => 'Serang',
                'provinsi'        => 'Banten',
                default           => '',
            };
            $dataSingkat[$key] = Pengaturan::getValue($key, $default);
        }

        return view('profil', compact('dataSingkat'));
    }
}