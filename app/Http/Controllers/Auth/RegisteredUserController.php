<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'nama'          => ['required', 'string', 'max:255'],
            'nik'           => ['required', 'string', 'max:20', 'unique:users,nik'],
            'alamat'        => ['required', 'string', 'max:255'],
            'no_hp'         => ['required', 'string', 'max:15'],
            'email'         => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'tempat_lahir'  => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'password'      => ['required', 'confirmed', Rules\Password::defaults()],
            // ✅ username DIHAPUS dari validasi — di-generate otomatis dari email
        ]);

        // ✅ Auto-generate username unik dari bagian depan email
        // Contoh: "aryo@gmail.com" → username "aryo", kalau sudah ada → "aryo1", "aryo2", dst.
        $usernameBase = Str::before($request->email, '@');
        $usernameBase = preg_replace('/[^a-z0-9_]/', '', strtolower($usernameBase));
        if (empty($usernameBase)) {
            $usernameBase = 'user';
        }

        $username = $usernameBase;
        $counter  = 1;
        while (User::where('username', $username)->exists()) {
            $username = $usernameBase . $counter;
            $counter++;
        }

        $user = User::create([
            'nama'          => $request->nama,
            'nik'           => $request->nik,
            'alamat'        => $request->alamat,
            'no_hp'         => $request->no_hp,
            'email'         => $request->email,
            'tempat_lahir'  => $request->tempat_lahir,
            'tanggal_lahir' => $request->tanggal_lahir,
            'username'      => $username, // ✅ otomatis terisi
            'password'      => Hash::make($request->password),
        ]);

        event(new Registered($user));

        return redirect()->route('login')
            ->with('success', 'Akun berhasil dibuat, silakan login.');
    }
}
