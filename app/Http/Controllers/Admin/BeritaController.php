<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Berita;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class BeritaController extends Controller
{
    public function index()
    {
        $data = Berita::orderBy('tanggal_publish', 'desc')->get();
        return view('Admin.berita.index', compact('data'));
    }

    public function create()
    {
        return view('Admin.berita.create');
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

        $slug = $this->generateUniqueSlug($request->judul);

        Berita::create([
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

        return redirect()->route('berita-admin.index')
            ->with('success', 'Berita berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = Berita::findOrFail($id);
        return view('Admin.berita.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = Berita::findOrFail($id);

        $request->validate([
            'judul'    => 'required|string|max:255',
            'kategori' => 'required|string|max:100',
            'isi'      => 'required|string',
            'status'   => 'required|in:draft,publish',
            'gambar'   => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($data->gambar) Storage::disk('public')->delete($data->gambar);
            $data->gambar = $request->file('gambar')->store('berita', 'public');
        }

        $tanggalPublish = $data->tanggal_publish;
        if ($request->status === 'publish' && $data->status === 'draft') {
            $tanggalPublish = now();
        } elseif ($request->status === 'draft') {
            $tanggalPublish = null;
        }

        $newSlug = empty($data->slug)
            ? $this->generateUniqueSlug($request->judul, $data->id_berita)
            : $data->slug;

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

        return redirect()->route('berita-admin.index')
            ->with('success', 'Berita berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = Berita::findOrFail($id);
        if ($data->gambar) Storage::disk('public')->delete($data->gambar);
        $data->delete();
        return back()->with('success', 'Berita berhasil dihapus.');
    }

    private function generateUniqueSlug(string $judul, $excludeId = null): string
    {
        $slugBase = Str::slug($judul) ?: 'berita';
        $slug = $slugBase . '-' . time();
        $counter = 1;
        while (true) {
            $query = Berita::where('slug', $slug);
            if ($excludeId) $query->where('id_berita', '!=', $excludeId);
            if (!$query->exists()) break;
            $slug = $slugBase . '-' . time() . '-' . $counter++;
        }
        return $slug;
    }
}
