<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Pengaturan;
use App\Models\StatistikDemografi;
use Illuminate\Http\Request;

class StatistikController extends Controller
{
    // Key data singkat yang dikelola
    private array $singkatKeys = [
        'kode_pos', 'luas_wilayah', 'jumlah_penduduk',
        'kecamatan', 'kota', 'provinsi',
    ];

    /**
     * Label default untuk key-key yang HASIL HITUNG dari tabel `penduduk`
     * (lihat Penduduk::labelStatistikKey()). Key-key ini dikunci di form —
     * admin tidak bisa mengetik manual, hanya bisa diubah lewat CRUD
     * Data Warga. Ini mencegah field ini ketiban nilai manual yang
     * membuat halaman publik (ProfilController/ChatbotController, yang
     * baca via StatistikDemografi::asCollection() langsung dari DB)
     * menampilkan angka yang tidak sinkron dengan data warga sebenarnya.
     */
    private function computedKeys(): array
    {
        return array_keys(\App\Models\Penduduk::labelStatistikKey());
    }

    public function edit()
    {
        // Ambil statistik demografi — angka yang punya padanan data warga
        // individual akan otomatis ditimpa hasil hitung dari tabel `penduduk`
        $statistik = \App\Models\StatistikDemografi::withPendudukOverride();
        $adaDataPenduduk = \App\Models\Penduduk::count() > 0;

        // Pertumbuhan penduduk per tahun — otomatis dari kolom tahun_data
        $currentYear     = (int) now()->format('Y');
        $totalPendudukDB = \App\Models\Penduduk::count();
        $perTahun        = \App\Models\Penduduk::hitungPerTahun(); // [tahun => jumlah]

        // Sync ke statistik_demografi: upsert semua tahun yang ada di tabel penduduk
        foreach ($perTahun as $tahun => $jumlah) {
            \App\Models\StatistikDemografi::updateOrCreate(
                ['kunci' => 'penduduk_' . $tahun],
                ['label' => 'Tahun ' . $tahun, 'nilai' => $jumlah]
            );
        }

        // Pastikan semua tahun dari DB juga muncul di koleksi statistik (untuk view)
        foreach ($perTahun as $tahun => $jumlah) {
            $k = 'penduduk_' . $tahun;
            if (!$statistik->has($k)) {
                $statistik->put($k, new \App\Models\StatistikDemografi([
                    'kunci' => $k, 'label' => 'Tahun ' . $tahun, 'nilai' => $jumlah,
                ]));
            } else {
                $statistik[$k]->nilai = $jumlah;
            }
        }

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

        // "Jumlah Penduduk" harus selalu match jumlah data warga riil kalau
        // sudah ada data warga — bukan angka manual/dummy dari tabel pengaturan.
        if ($adaDataPenduduk) {
            $dataSingkat['jumlah_penduduk'] = (string) $totalPendudukDB;
        }

        return view('Admin.statistik.edit', compact(
            'statistik', 'dataSingkat', 'adaDataPenduduk',
            'currentYear', 'totalPendudukDB', 'perTahun'
        ));
    }

    public function update(Request $request)
    {
        // ── Simpan data singkat kelurahan ──────────────────
        if ($request->has('singkat')) {
            foreach ($request->singkat as $key => $data) {
                if (in_array($key, $this->singkatKeys)) {
                    Pengaturan::setValue($key, $data['nilai'] ?? '');
                }
            }
        }

        // ── Hapus statistik yang ditandai ──────────────────
        $hapusKeys = $request->input('hapus_statistik', []);
        if (!empty($hapusKeys)) {
            // Jangan hapus tahun berjalan — nilainya dari DB
            $currentYear = (int) now()->format('Y');
            $hapusKeys   = array_filter($hapusKeys, fn($k) => $k !== 'penduduk_' . $currentYear);
            if (!empty($hapusKeys)) {
                \App\Models\StatistikDemografi::whereIn('kunci', $hapusKeys)->delete();
            }
        }

        $adaDataPenduduk = \App\Models\Penduduk::count() > 0;
        $computedKeys    = $this->computedKeys();

        // ── Simpan statistik demografi ──────────────────────
        if ($request->has('statistik')) {
            foreach ($request->statistik as $kunci => $data) {
                if (in_array($kunci, $hapusKeys)) continue;

                // Tahun berjalan nilai-nya SELALU dari DB, bukan dari form
                // (user tidak bisa ubah ini karena field-nya readonly di view)
                if ($kunci === 'penduduk_' . (int) now()->format('Y')) continue;

                // Key hasil hitung (jenis kelamin, agama, umur, pekerjaan,
                // pendidikan, status kawin, periode update, dst) diabaikan
                // dari form kalau sudah ada data warga — nilainya HARUS dari
                // tabel `penduduk`, bukan dari yang diketik admin. Diisi
                // ulang di bawah lewat Penduduk::syncSemuaStatistik().
                if ($adaDataPenduduk && in_array($kunci, $computedKeys)) continue;

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

        // ── Sinkronkan seluruh angka turunan data warga ke DB ──────────
        // (jenis kelamin, agama, umur, dst + Jumlah Penduduk di Data
        // Singkat Kelurahan + Periode Update Data). Ini yang membuat
        // halaman publik (Profil, Chatbot) selalu akurat, bukan cuma
        // halaman edit ini.
        if ($adaDataPenduduk) {
            \App\Models\Penduduk::syncSemuaStatistik();
        }

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

}