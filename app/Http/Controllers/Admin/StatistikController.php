<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikDemografi;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function edit()
    {
        $statistik = StatistikDemografi::asCollection();
        return view('admin.statistik.edit', compact('statistik'));
    }

    public function update(Request $request)
    {
        $data = $request->input('statistik', []);

        foreach ($data as $kunci => $fields) {
            $label     = $fields['label']      ?? $kunci;
            $nilai     = (int)($fields['nilai'] ?? 0);
            $nilaiTeks = $fields['nilai_teks']  ?? null;

            // Konversi bulan input (2026-03) → "Maret 2026"
            if ($kunci === 'update_terakhir' && $nilaiTeks) {
                $bulanId = [
                    '01'=>'Januari','02'=>'Februari','03'=>'Maret','04'=>'April',
                    '05'=>'Mei','06'=>'Juni','07'=>'Juli','08'=>'Agustus',
                    '09'=>'September','10'=>'Oktober','11'=>'November','12'=>'Desember',
                ];
                [$tahun, $bulan] = explode('-', $nilaiTeks) + [null, null];
                if ($tahun && $bulan && isset($bulanId[$bulan])) {
                    $nilaiTeks = $bulanId[$bulan] . ' ' . $tahun;
                }
            }

            // Upsert: update jika ada, insert jika belum ada
            StatistikDemografi::updateOrCreate(
                ['kunci' => $kunci],
                [
                    'label'      => $label,
                    'nilai'      => $nilai,
                    'nilai_teks' => $nilaiTeks,
                ]
            );
        }

        return redirect()->route('admin.statistik.edit')
            ->with('success', 'Data statistik berhasil diperbarui!');
    }
}