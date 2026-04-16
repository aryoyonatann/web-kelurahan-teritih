<?php

namespace App\Http\Controllers;

use App\Models\InformasiKelurahan;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        // ✅ Tampilkan 4 berita terbaru di homepage
        // whereNotNull('slug') tetap dipakai agar tidak error saat generate URL
        $beritaTerbaru = InformasiKelurahan::where('status', 'publish')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('tanggal_publish', 'desc')
            ->take(4)
            ->get();

        return view('home', compact('beritaTerbaru'));
    }

    public function informasi()
    {
        $beritaTerbaru = InformasiKelurahan::where('status', 'publish')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('tanggal_publish', 'desc')
            ->take(3)
            ->get();

        $statistik = \App\Models\StatistikDemografi::asCollection();

        return view('informasi', compact('beritaTerbaru', 'statistik'));
    }

    public function berita(Request $request)
    {
        // ✅ Query dasar: hanya berita yang slugnya tidak null dan tidak kosong
        //    agar route('informasi.berita.detail', $b->slug) tidak error
        //    Berita tanpa slug (misal judul "tes" yang slugnya null) tidak tampil
        //    di frontend tapi tetap ada di admin — fix slugnya dari admin
        $query = InformasiKelurahan::where('status', 'publish')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('tanggal_publish', 'desc');

        // Filter kategori jika ada
        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        // ✅ Total semua berita publish yang punya slug (untuk counter)
        $totalBerita = (clone $query)->count();

        // ✅ Featured: 1 berita paling atas
        $beritaFeatured = (clone $query)->first();

        // ✅ Samping: 3 berita setelah featured
        $beritaSamping  = (clone $query)->skip(1)->take(3)->get();

        // ✅ Grid: semua sisa berita (skip 4 = 1 featured + 3 samping)
        //    Dengan 6 berita valid → grid dapat 2 berita
        //    paginate(9) agar bisa tampung banyak & ada navigasi halaman
        $beritaGrid = (clone $query)->skip(4)->paginate(9);

        return view('informasi-berita', compact(
            'beritaFeatured',
            'beritaSamping',
            'beritaGrid',
            'totalBerita'
        ));
    }

    public function detailBerita($slug)
    {
        $berita = InformasiKelurahan::where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        $berita->increment('views');

        $beritaLainnya = InformasiKelurahan::where('status', 'publish')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->where('id_informasi', '!=', $berita->id_informasi)
            ->orderBy('tanggal_publish', 'desc')
            ->take(4)
            ->get();

        return view('berita-detail', compact('berita', 'beritaLainnya'));
    }
}