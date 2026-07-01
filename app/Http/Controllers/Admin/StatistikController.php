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

        return view('Admin.statistik.edit', compact('statistik', 'dataSingkat'));
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

        // ── Hapus statistik yang ditandai ──────────────────
        $hapusKeys = $request->input('hapus_statistik', []);
        if (!empty($hapusKeys)) {
            \App\Models\StatistikDemografi::whereIn('kunci', $hapusKeys)->delete();
        }

        // ── Simpan statistik demografi (logic yang sudah ada) ──
        if ($request->has('statistik')) {
            foreach ($request->statistik as $kunci => $data) {
                if (in_array($kunci, $hapusKeys)) continue;
                \App\Models\StatistikDemografi::updateOrCreate(
                    ['kunci' => $kunci],
                    [
                        'label'      => $data['label']      ?? $kunci,
                        'nilai'      => $data['nilai']      ?? 0,
                        'nilai_teks' => $data['nilai_teks'] ?? null,
                    ]
                );
            }

            // Auto-calculate total sample DDK dari 4 kelompok umur
            $umur4Keys = ['umur4_anak','umur4_remaja','umur4_dewasa','umur4_lansia'];
            $totalDDK = \App\Models\StatistikDemografi::whereIn('kunci', $umur4Keys)->sum('nilai');
            if ($totalDDK > 0) {
                $teksL = \App\Models\StatistikDemografi::whereIn('kunci', $umur4Keys)->get()
                    ->sum(fn($r) => (int)explode('|', $r->nilai_teks ?? '0|0')[0]);
                $teksP = $totalDDK - $teksL;
                \App\Models\StatistikDemografi::updateOrCreate(
                    ['kunci' => 'total_sample_ddk'],
                    ['label' => 'Total Sample DDK', 'nilai' => $totalDDK, 'nilai_teks' => $teksL.'|'.$teksP, 'urutan' => 39]
                );
            }
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }
}