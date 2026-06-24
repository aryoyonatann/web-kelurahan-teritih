<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    public function edit()
    {
        $fotoLurah  = Pengaturan::getValue('foto_lurah');
        $namaLurah  = Pengaturan::getValue('nama_lurah', 'Jupran, SE, MM');
        $jabatLurah = Pengaturan::getValue('jabat_lurah', 'Kepala Kelurahan Teritih');

        $nodeKeys = ['lurah','sekretaris','kasi-pemum','pelaksana','op-sanusi','op-hawari','kasi-pmk','op-hasan','kasi-trantibum','op-afif','op-jamaludin'];
        $pegawai  = [];
        foreach ($nodeKeys as $key) {
            $pegawai[$key] = [
                'nama' => Pengaturan::getValue('pegawai_'.$key.'_nama', ''),
                'nip'  => Pengaturan::getValue('pegawai_'.$key.'_nip',  ''),
                'foto' => Pengaturan::getValue('pegawai_'.$key.'_foto', ''),
            ];
        }

        return view('Admin.pengaturan.edit', compact('fotoLurah', 'namaLurah', 'jabatLurah', 'pegawai', 'nodeKeys'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'foto_lurah'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'nama_lurah'  => 'required|string|max:100',
            'jabat_lurah' => 'required|string|max:100',
        ]);

        // Simpan data lurah di beranda
        Pengaturan::setValue('nama_lurah',  $request->nama_lurah);
        Pengaturan::setValue('jabat_lurah', $request->jabat_lurah);

        if ($request->hasFile('foto_lurah')) {
            $lama = Pengaturan::getValue('foto_lurah');
            if ($lama && Storage::disk('public')->exists($lama)) Storage::disk('public')->delete($lama);
            $path = $request->file('foto_lurah')->store('pengaturan', 'public');
            Pengaturan::setValue('foto_lurah', $path);
        }

        // Simpan data pegawai struktur org
        if ($request->has('pegawai')) {
            foreach ($request->pegawai as $key => $data) {
                if (isset($data['nama'])) Pengaturan::setValue('pegawai_'.$key.'_nama', $data['nama']);
                if (isset($data['nip']))  Pengaturan::setValue('pegawai_'.$key.'_nip',  $data['nip']);
            }
        }

        // Upload foto pegawai
        if ($request->hasFile('pegawai_foto')) {
            foreach ($request->file('pegawai_foto') as $key => $file) {
                $lama = Pengaturan::getValue('pegawai_'.$key.'_foto');
                if ($lama && Storage::disk('public')->exists($lama)) Storage::disk('public')->delete($lama);
                $path = $file->store('pengaturan', 'public');
                Pengaturan::setValue('pegawai_'.$key.'_foto', $path);
            }
        }

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }
}
