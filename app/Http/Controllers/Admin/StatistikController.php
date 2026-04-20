<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    // Key data singkat yang dikelola
    private array $singkatKeys = [
        'kode_pos', 'luas_wilayah', 'jumlah_penduduk',
        'kecamatan', 'kota', 'provinsi',
    ];

    public function edit()
    {
        // Ambil statistik demografi (model Statistik sudah ada sebelumnya)
        $statistik = \App\Models\StatistikDemografi::all()->keyBy('kunci');

        // Ambil data singkat kelurahan dari tabel pengaturan
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

        return view('admin.statistik.edit', compact('statistik', 'dataSingkat'));
    }

    public function update(Request $request)
    {
        // ── Simpan data singkat kelurahan ──────────────────
        if ($request->has('singkat')) {
            foreach ($request->singkat as $key => $data) {
                // Hanya simpan key yang diizinkan
                if (in_array($key, $this->singkatKeys)) {
                    Pengaturan::setValue($key, $data['nilai'] ?? '');
                }
            }
        }

        // ── Simpan statistik demografi (logic yang sudah ada) ──
        if ($request->has('statistik')) {
            foreach ($request->statistik as $kunci => $data) {
                \App\Models\StatistikDemografi::updateOrCreate(
                    ['kunci' => $kunci],
                    [
                        'label'      => $data['label']      ?? $kunci,
                        'nilai'      => $data['nilai']      ?? 0,
                        'nilai_teks' => $data['nilai_teks'] ?? null,
                    ]
                );
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
}