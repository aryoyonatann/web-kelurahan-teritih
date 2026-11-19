<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TtdDigital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TtdDigitalController extends Controller
{
    public function index()
    {
        $ttds = TtdDigital::latest()->get();
        return view('Admin.ttd_digital.index', compact('ttds'));
    }

    public function create()
    {
        return view('Admin.ttd_digital.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'nip'     => 'nullable|string|max:30',
            'jabatan' => 'required|string|max:100',
        ]);

        $data = [
            'nama'     => $request->nama,
            'nip'      => $request->nip,
            'jabatan'  => $request->jabatan,
            'is_aktif' => 1,
        ];

        // Prioritas: canvas (base64) > file upload
        if ($request->filled('ttd_canvas_data')) {
            $data['ttd_data'] = $request->ttd_canvas_data;
            $data['ttd_path'] = null;
        } elseif ($request->hasFile('ttd_file')) {
            $path = $request->file('ttd_file')->store('ttd', 'public');
            $data['ttd_path'] = $path;
            $data['ttd_data'] = null;
        } else {
            return back()->withErrors(['ttd' => 'Tanda tangan wajib diisi (canvas atau upload file).'])->withInput();
        }

        TtdDigital::create($data);

        return redirect()->route('admin.ttd.index')->with('success', 'Tanda tangan digital berhasil disimpan.');
    }

    public function edit(TtdDigital $ttd)
    {
        return view('Admin.ttd_digital.form', compact('ttd'));
    }

    public function update(Request $request, TtdDigital $ttd)
    {
        $request->validate([
            'nama'    => 'required|string|max:100',
            'nip'     => 'nullable|string|max:30',
            'jabatan' => 'required|string|max:100',
        ]);

        $data = [
            'nama'     => $request->nama,
            'nip'      => $request->nip,
            'jabatan'  => $request->jabatan,
            'is_aktif' => $request->boolean('is_aktif', true) ? 1 : 0,
        ];

        if ($request->filled('ttd_canvas_data')) {
            $data['ttd_data'] = $request->ttd_canvas_data;
            $data['ttd_path'] = null;
            if ($ttd->ttd_path) Storage::disk('public')->delete($ttd->ttd_path);
        } elseif ($request->hasFile('ttd_file')) {
            if ($ttd->ttd_path) Storage::disk('public')->delete($ttd->ttd_path);
            $path = $request->file('ttd_file')->store('ttd', 'public');
            $data['ttd_path'] = $path;
            $data['ttd_data'] = null;
        }

        $ttd->update($data);

        return redirect()->route('admin.ttd.index')->with('success', 'Tanda tangan digital berhasil diperbarui.');
    }

    public function destroy(TtdDigital $ttd)
    {
        if ($ttd->ttd_path) Storage::disk('public')->delete($ttd->ttd_path);
        $ttd->delete();
        return back()->with('success', 'Tanda tangan digital berhasil dihapus.');
    }

    /** API — daftar TTD aktif untuk modal pilih TTD */
    public function list()
    {
        $ttds = TtdDigital::where('is_aktif', 1)->get()->map(fn($t) => [
            'id'      => $t->id,
            'nama'    => $t->nama,
            'nip'     => $t->nip,
            'jabatan' => $t->jabatan,
            'ttd_url' => $t->ttd_url,
        ]);
        return response()->json($ttds);
    }
}
