<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class KelolaAkunController extends Controller
{
    public function index(Request $request)
    {
        $query = User::withCount('permohonan');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($q2) use ($q) {
                $q2->where('nama', 'like', "%$q%")
                   ->orWhere('nik', 'like', "%$q%")
                   ->orWhere('email', 'like', "%$q%");
            });
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('rt')) {
            $query->where('rt', $request->rt);
        }

        if ($request->filled('rw')) {
            $query->where('rw', $request->rw);
        }

        $sort = $request->get('sort', 'terbaru');
        match($sort) {
            'terlama'      => $query->oldest('created_at'),
            'nama'         => $query->orderBy('nama'),
            'permohonan'   => $query->orderByDesc('permohonan_count'),
            'last_login'   => $query->orderByDesc('last_login_at'),
            default        => $query->latest('created_at'),
        };

        $users     = $query->paginate(10)->withQueryString();
        $totalUser = User::count();
        $nonAktif  = User::whereIn('status', ['blokir'])->count();

        $rtList = User::whereNotNull('rt')->distinct()->orderBy('rt')->pluck('rt');
        $rwList = User::whereNotNull('rw')->distinct()->orderBy('rw')->pluck('rw');

        return view('Admin.kelola_akun.index', compact(
            'users', 'totalUser', 'nonAktif', 'rtList', 'rwList'
        ));
    }

    public function show($id)
    {
        $user = User::withCount('permohonan')->findOrFail($id);
        return view('Admin.kelola_akun.show', compact('user'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama'          => 'required|string|max:100',
            'nik'           => 'required|string|max:20|unique:users,nik',
            'email'         => 'nullable|email|unique:users,email',
            'no_hp'         => 'required|string|max:15',
            'password'      => 'required|string|min:6',
            'alamat'        => 'nullable|string',
            'rt'            => 'nullable|string|max:10',
            'rw'            => 'nullable|string|max:10',
            'tempat_lahir'  => 'nullable|string|max:255',
            'tanggal_lahir' => 'nullable|date',
        ], [
            'nik.unique'      => 'NIK sudah terdaftar.',
            'email.unique'    => 'Email sudah digunakan.',
            'password.min'    => 'Password minimal 6 karakter.',
        ]);

        User::create([
            'nama'          => $request->nama,
            'nik'           => $request->nik,
            // Disimpan sebagai NULL (bukan string kosong) bila dikosongkan,
            // supaya beberapa akun tanpa email tidak bentrok dengan aturan unique.
            'email'         => $request->email ?: null,
            'no_hp'         => $request->no_hp,
            'password'      => Hash::make($request->password),
            'alamat'        => $request->alamat,
            'rt'            => $request->rt,
            'rw'            => $request->rw,
            'kelurahan'     => 'Teritih',
            'kecamatan'     => 'Walantaka',
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'status'        => 'aktif',
        ]);

        return redirect()->route('kelola-akun.index')
            ->with('success', 'Akun masyarakat berhasil ditambahkan.');
    }

    public function resetPassword(Request $request, $id)
    {
        $request->validate([
            'password' => 'required|string|min:6|confirmed',
        ], [
            'password.required'  => 'Password baru wajib diisi.',
            'password.min'       => 'Password minimal 6 karakter.',
            'password.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $user = User::findOrFail($id);
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return back()->with('success', "Password akun {$user->nama} berhasil diubah.");
    }

    public function toggleStatus($id)
    {
        $user         = User::findOrFail($id);
        $user->status = $user->status === 'aktif' ? 'blokir' : 'aktif';
        $user->save();

        $label = $user->status === 'aktif' ? 'diaktifkan' : 'diblokir';
        return back()->with('success', "Akun masyarakat berhasil {$label}.");
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return back()->with('success', 'Akun masyarakat berhasil dihapus.');
    }

    public function export(Request $request)
    {
        $query = User::withCount('permohonan');

        if ($request->filled('search')) {
            $q = $request->search;
            $query->where(function ($q2) use ($q) {
                $q2->where('nama', 'like', "%$q%")
                   ->orWhere('nik', 'like', "%$q%")
                   ->orWhere('email', 'like', "%$q%");
            });
        }
        if ($request->filled('status')) $query->where('status', $request->status);
        if ($request->filled('rt'))     $query->where('rt', $request->rt);
        if ($request->filled('rw'))     $query->where('rw', $request->rw);

        $users = $query->orderBy('nama')->get();

        $filename = 'data-akun-masyarakat-' . now()->format('Ymd-His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($users) {
            $file = fopen('php://output', 'w');
            fprintf($file, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($file, [
                'No', 'Nama', 'NIK', 'Email', 'No HP',
                'RT', 'RW', 'Alamat', 'Status',
                'Jumlah Permohonan', 'Tgl Daftar', 'Terakhir Login'
            ]);

            foreach ($users as $i => $u) {
                fputcsv($file, [
                    $i + 1,
                    $u->nama,
                    $u->nik ?? '-',
                    $u->email,
                    $u->no_hp ?? '-',
                    $u->rt  ? 'RT '.$u->rt  : '-',
                    $u->rw  ? 'RW '.$u->rw  : '-',
                    $u->alamat ?? '-',
                    ucfirst($u->status ?? 'aktif'),
                    $u->permohonan_count,
                    $u->created_at    ? \Carbon\Carbon::parse($u->created_at)->format('d/m/Y')        : '-',
                    $u->last_login_at ? \Carbon\Carbon::parse($u->last_login_at)->format('d/m/Y H:i') : 'Belum pernah',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}