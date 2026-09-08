<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PengaturanController extends Controller
{
    private array $fasKategori = [
        'ibadah'      => ['label' => 'Ibadah',      'icon' => '🕌', 'color' => '#10b981'],
        'pendidikan'  => ['label' => 'Pendidikan',  'icon' => '📚', 'color' => '#3b82f6'],
        'kesehatan'   => ['label' => 'Kesehatan',   'icon' => '🏥', 'color' => '#ef4444'],
        'olahraga'    => ['label' => 'Olahraga',    'icon' => '⚽', 'color' => '#f59e0b'],
        'pemerintahan'=> ['label' => 'Pemerintahan','icon' => '🏛️', 'color' => '#8b5cf6'],
    ];

    public function edit()
    {
        $fotoLurah  = Pengaturan::getValue('foto_lurah');
        $namaLurah  = Pengaturan::getValue('nama_lurah', 'Jupran, SE, MM');
        $jabatLurah = Pengaturan::getValue('jabat_lurah', 'Kepala Kelurahan Teritih');

        $nodeKeys = ['lurah','sekretaris','kasi-pemum','pelaksana','op-sanusi','op-hawari',
                     'kasi-pmk','op-hasan','kasi-trantibum','op-afif','op-jamaludin'];
        $pegawai  = [];
        foreach ($nodeKeys as $key) {
            $pegawai[$key] = [
                'nama' => Pengaturan::getValue('pegawai_'.$key.'_nama', ''),
                'nip'  => Pengaturan::getValue('pegawai_'.$key.'_nip',  ''),
                'foto' => Pengaturan::getValue('pegawai_'.$key.'_foto', ''),
            ];
        }

        $fasilitasLokasi = json_decode(Pengaturan::getValue('fasilitas_lokasi', '[]'), true) ?: [];

        $batasWilayah = self::getBatasWilayah();

        return view('Admin.pengaturan.edit', compact(
            'fotoLurah', 'namaLurah', 'jabatLurah', 'pegawai', 'nodeKeys',
            'batasWilayah'
        ) + ['fasKategori' => $this->fasKategori]);
    }

    public function update(Request $request)
    {
        $request->validate([
            'foto_lurah'  => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            'nama_lurah'  => 'required|string|max:100',
            'jabat_lurah' => 'required|string|max:100',
        ]);

        // Profil lurah
        Pengaturan::setValue('nama_lurah',  $request->nama_lurah);
        Pengaturan::setValue('jabat_lurah', $request->jabat_lurah);
        if ($request->hasFile('foto_lurah')) {
            $lama = Pengaturan::getValue('foto_lurah');
            if ($lama && Storage::disk('public')->exists($lama)) Storage::disk('public')->delete($lama);
            Pengaturan::setValue('foto_lurah', $request->file('foto_lurah')->store('pengaturan', 'public'));
        }

        // Pegawai
        if ($request->has('pegawai')) {
            foreach ($request->pegawai as $key => $data) {
                if (isset($data['nama'])) Pengaturan::setValue('pegawai_'.$key.'_nama', $data['nama']);
                if (isset($data['nip']))  Pengaturan::setValue('pegawai_'.$key.'_nip',  $data['nip']);
            }
        }
        if ($request->hasFile('pegawai_foto')) {
            foreach ($request->file('pegawai_foto') as $key => $file) {
                $lama = Pengaturan::getValue('pegawai_'.$key.'_foto');
                if ($lama && Storage::disk('public')->exists($lama)) Storage::disk('public')->delete($lama);
                Pengaturan::setValue('pegawai_'.$key.'_foto', $file->store('pengaturan', 'public'));
            }
        }

        // Batas wilayah teks
        Pengaturan::setValue('batas_utara',   $request->input('batas_utara',   ''));
        Pengaturan::setValue('batas_selatan', $request->input('batas_selatan', ''));
        Pengaturan::setValue('batas_barat',   $request->input('batas_barat',   ''));
        Pengaturan::setValue('batas_timur',   $request->input('batas_timur',   ''));

        return back()->with('success', 'Pengaturan berhasil disimpan.');
    }

    /**
     * AJAX — validasi link Google Maps.
     * Route: POST /admin/resolve-gmaps
     */
    public function resolveGmaps(Request $request)
    {
        $url = trim($request->input('url', ''));
        if (!$url) return response()->json(['ok' => false, 'msg' => 'URL kosong.']);

        $isGmaps = str_contains($url, 'google.com/maps')
                || str_contains($url, 'maps.app.goo.gl')
                || str_contains($url, 'goo.gl/maps');

        if (!$isGmaps) return response()->json(['ok' => false, 'msg' => 'Bukan link Google Maps.']);

        return response()->json(['ok' => true]);
    }

    // ── Static helpers ──────────────────────────────────────────

    public static function getFasilitasLokasi(): array
    {
        return json_decode(Pengaturan::getValue('fasilitas_lokasi', '[]'), true) ?: [];
    }

    public static function getFasKategori(): array
    {
        return [
            'ibadah'      => ['label' => 'Ibadah',      'icon' => '🕌', 'color' => '#10b981'],
            'pendidikan'  => ['label' => 'Pendidikan',  'icon' => '📚', 'color' => '#3b82f6'],
            'kesehatan'   => ['label' => 'Kesehatan',   'icon' => '🏥', 'color' => '#ef4444'],
            'olahraga'    => ['label' => 'Olahraga',    'icon' => '⚽', 'color' => '#f59e0b'],
            'pemerintahan'=> ['label' => 'Pemerintahan','icon' => '🏛️', 'color' => '#8b5cf6'],
        ];
    }

    public static function getBatasWilayah(): array
    {
        return [
            'utara'   => Pengaturan::getValue('batas_utara',   'Kec. Kasemen'),
            'selatan' => Pengaturan::getValue('batas_selatan', 'Kel. Kepuren & Kalodran'),
            'barat'   => Pengaturan::getValue('batas_barat',   'Kec. Cipocokjaya'),
            'timur'   => Pengaturan::getValue('batas_timur',   'Kabupaten Serang'),
        ];
    }
}
