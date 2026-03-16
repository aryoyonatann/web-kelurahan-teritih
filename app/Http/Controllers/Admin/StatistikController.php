<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\StatistikDemografi;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    public function edit()
    {
        $statistik = StatistikDemografi::orderBy('urutan')->get()->keyBy('kunci');
        return view('admin.statistik.edit', compact('statistik'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'statistik'         => 'required|array',
            'statistik.*.nilai' => 'nullable|integer|min:0',
            'statistik.*.label' => 'required|string|max:200',
        ]);

        foreach ($request->statistik as $kunci => $data) {
            $row = StatistikDemografi::where('kunci', $kunci)->first();
            if (!$row) continue;

            $row->label = $data['label'];

            if ($kunci === 'update_terakhir') {
                $row->nilai_teks = $data['nilai_teks'] ?? $row->nilai_teks;
            } else {
                $row->nilai = (int)($data['nilai'] ?? 0);
            }

            $row->save();
        }

        return redirect()->route('admin.statistik.edit')
            ->with('success', 'Data statistik berhasil diperbarui.');
    }
}