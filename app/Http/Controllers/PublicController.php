<?php

namespace App\Http\Controllers;

use App\Models\InformasiKelurahan;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $beritaTerbaru = InformasiKelurahan::where('status', 'publish')
            ->whereNotNull('slug')
            ->orderBy('tanggal_publish', 'desc')
            ->take(2)
            ->get();

        return view('home', compact('beritaTerbaru'));
    }

    public function informasi()
    {
        $beritaTerbaru = InformasiKelurahan::where('status', 'publish')
            ->whereNotNull('slug')
            ->orderBy('tanggal_publish', 'desc')
            ->take(3)
            ->get();

        $statistik = \App\Models\StatistikDemografi::asCollection();

        return view('informasi', compact('beritaTerbaru', 'statistik'));
    }

    public function berita(Request $request)
    {
        $query = InformasiKelurahan::where('status', 'publish')
            ->whereNotNull('slug')
            ->orderBy('tanggal_publish', 'desc');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        $beritaFeatured = (clone $query)->first();
        $beritaSamping  = (clone $query)->skip(1)->take(4)->get();
        $beritaGrid     = (clone $query)->skip(5)->paginate(6);

        $totalBerita = InformasiKelurahan::where('status', 'publish')
            ->whereNotNull('slug')->count();

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
            ->where('id_informasi', '!=', $berita->id_informasi)
            ->orderBy('tanggal_publish', 'desc')
            ->take(4)
            ->get();

        return view('berita-detail', compact('berita', 'beritaLainnya'));
    }
}