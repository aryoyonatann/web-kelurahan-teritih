<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Pengaturan;
use Illuminate\Http\Request;

class PublicController extends Controller
{
    public function home()
    {
        $beritaTerbaru = Berita::where('status', 'publish')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('tanggal_publish', 'desc')
            ->take(4)
            ->get();

        $fotoLurah  = Pengaturan::getValue('foto_lurah');
        $namaLurah  = Pengaturan::getValue('nama_lurah', 'Jupran, SE, MM');
        $jabatLurah = Pengaturan::getValue('jabat_lurah', 'Kepala Kelurahan Teritih');

        return view('home', compact('beritaTerbaru', 'fotoLurah', 'namaLurah', 'jabatLurah'));
    }

    public function demografi()
    {
        $statistik = \App\Models\StatistikDemografi::withPendudukOverride();
        return view('informasi', compact('statistik'));
    }

    public function berita(Request $request)
    {
        $query = Berita::where('status', 'publish')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->orderBy('tanggal_publish', 'desc');

        if ($request->filled('kategori')) {
            $query->where('kategori', $request->kategori);
        }

        if ($request->filled('q')) {
            $q = $request->q;
            $query->where(function ($qb) use ($q) {
                $qb->where('judul', 'like', "%{$q}%")
                    ->orWhere('isi', 'like', "%{$q}%");
            });
        }

        $totalBerita    = (clone $query)->count();
        $beritaList     = $query->paginate(12);
        $beritaFeatured = $beritaList->first();
        $beritaGrid     = $beritaList;

        return view('informasi-berita', compact(
            'beritaFeatured',
            'beritaGrid',
            'beritaList',
            'totalBerita'
        ));
    }

    public function detailBerita($slug)
    {
        $berita = Berita::where('slug', $slug)
            ->where('status', 'publish')
            ->firstOrFail();

        $berita->increment('views');

        $beritaLainnya = Berita::where('status', 'publish')
            ->whereNotNull('slug')
            ->where('slug', '!=', '')
            ->where('id_berita', '!=', $berita->id_berita)
            ->orderBy('tanggal_publish', 'desc')
            ->take(4)
            ->get();

        return view('berita-detail', compact('berita', 'beritaLainnya'));
    }
}
