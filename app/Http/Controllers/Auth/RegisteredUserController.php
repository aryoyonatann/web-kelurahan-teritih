<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    public function create(): View
    {
        return view('auth.register');
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama'          => ['required', 'string', 'max:255'],
            'nik'           => ['required', 'string', 'max:20', 'unique:users,nik'],
            'alamat'        => ['required', 'string', 'max:255'],
            'no_hp'         => ['required', 'string', 'max:15'],
            'email'         => ['nullable', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'tempat_lahir'  => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'nama'          => $request->nama,
            'nik'           => $request->nik,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            // Disimpan sebagai NULL (bukan string kosong) bila dikosongkan,
            // supaya beberapa akun tanpa email tidak bentrok dengan aturan unique.
            'email'         => $request->email ?: null,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'password'      => Hash::make($request->password),
        ]);
        // status diset langsung (bukan mass assignment) karena tidak ada di $fillable
        $user->status = 'aktif';
        $user->save();

        event(new Registered($user));

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat, silakan login.');
    }
}