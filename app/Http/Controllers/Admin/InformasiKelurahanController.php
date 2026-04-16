<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\InformasiKelurahan;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class InformasiKelurahanController extends Controller
{
    public function index()
    {
        $data = InformasiKelurahan::orderBy('tanggal_publish', 'desc')->get();
        return view('admin.informasi.index', compact('data'));
    }

    public function create()
    {
        return view('admin.informasi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'isi'      => 'required|string',
            'status'   => 'required|in:draft,publish',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $gambar = null;
        if ($request->hasFile('gambar')) {
            $gambar = $request->file('gambar')->store('berita', 'public');
        }

        // ✅ FIX: slug dijamin tidak pernah null atau kosong
        $slug = $this->generateUniqueSlug($request->judul);

        InformasiKelurahan::create([
            'judul'           => $request->judul,
            'slug'            => $slug,
            'kategori'        => $request->kategori,
            'isi'             => $request->isi,
            'ringkasan'       => $request->ringkasan ?? Str::limit(strip_tags($request->isi), 150),
            'status'          => $request->status,
            'tanggal_publish' => $request->status === 'publish' ? now() : null,
            'id_admin'        => auth('admin')->user()->id_admin,
            'gambar'          => $gambar,
            'views'           => 0,
        ]);

        return redirect()->route('informasi-admin.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = InformasiKelurahan::findOrFail($id);
        return view('admin.informasi.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = InformasiKelurahan::findOrFail($id);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'isi'      => 'required|string',
            'status'   => 'required|in:draft,publish',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        // Ganti gambar lama jika ada upload baru
        if ($request->hasFile('gambar')) {
            if ($data->gambar) {
                Storage::disk('public')->delete($data->gambar);
            }
            $data->gambar = $request->file('gambar')->store('berita', 'public');
        }

        // Update tanggal_publish hanya jika status berubah dari draft ke publish
        $tanggalPublish = $data->tanggal_publish;
        if ($request->status === 'publish' && $data->status === 'draft') {
            $tanggalPublish = now();
        } elseif ($request->status === 'draft') {
            $tanggalPublish = null;
        }

        // ✅ FIX: Jika slug lama masih null/kosong → generate slug baru sekarang
        // Jika sudah ada slug → tetap pakai yang lama agar URL tidak berubah
        if (empty($data->slug)) {
            $newSlug = $this->generateUniqueSlug($request->judul, $data->id_informasi);
        } else {
            $newSlug = $data->slug;
        }

        $data->update([
            'judul'           => $request->judul,
            'slug'            => $newSlug,
            'kategori'        => $request->kategori,
            'isi'             => $request->isi,
            'ringkasan'       => $request->ringkasan ?? Str::limit(strip_tags($request->isi), 150),
            'status'          => $request->status,
            'tanggal_publish' => $tanggalPublish,
            'gambar'          => $data->gambar,
        ]);

        return redirect()->route('informasi-admin.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = InformasiKelurahan::findOrFail($id);

        if ($data->gambar) {
            Storage::disk('public')->delete($data->gambar);
        }

        $data->delete();

        return back()->with('success', 'Berita berhasil dihapus.');
    }

    /**
     * ✅ Helper: Generate slug unik yang dijamin tidak null dan tidak kosong.
     *
     * @param string   $judul     Judul berita
     * @param int|null $excludeId ID berita yang dikecualikan saat cek unik (untuk update)
     * @return string
     */
    private function generateUniqueSlug(string $judul, $excludeId = null): string
    {
        // Buat slug dari judul menggunakan helper Laravel
        $slugBase = Str::slug($judul);

        // Fallback: jika judul hanya berisi karakter khusus/arab/emoji
        // sehingga Str::slug() menghasilkan string kosong
        if (empty($slugBase)) {
            $slugBase = 'berita';
        }

        // Gabungkan dengan timestamp agar slug bersifat unik secara default
        $slug = $slugBase . '-' . time();

        // Jika ternyata masih ada duplikat di database, tambahkan counter
        $counter = 1;
        while (true) {
            $query = InformasiKelurahan::where('slug', $slug);
            if ($excludeId) {
                $query->where('id_informasi', '!=', $excludeId);
            }
            if (!$query->exists()) {
                break; // slug sudah unik, keluar dari loop
            }
            $slug = $slugBase . '-' . time() . '-' . $counter;
            $counter++;
        }

        return $slug;
    }
}