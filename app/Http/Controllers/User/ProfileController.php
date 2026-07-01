<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    /**
     * Tampilkan halaman edit profil.
     */
    public function edit()
    {
        return view('User.profile.edit');
    }

    /**
     * Simpan perubahan profil.
     */
    public function update(Request $request)
    {
        $user       = Auth::user();
        $primaryKey = $user->getKeyName(); // 'id_user'
        $userId     = $user->getKey();

        $rules = [
            'nama'  => ['required', 'string', 'max:100'],
            'email' => ['required', 'email', 'max:100',
                        "unique:users,email,{$userId},{$primaryKey}"],
            'no_hp'         => ['nullable', 'string', 'max:15'],
            'tempat_lahir'  => ['nullable', 'string', 'max:255'],
            'tanggal_lahir' => ['nullable', 'date'],
            'alamat'        => ['nullable', 'string'],
            'rt'            => ['nullable', 'string', 'max:10'],
            'rw'            => ['nullable', 'string', 'max:10'],
            'kelurahan'     => ['nullable', 'string', 'max:100'],
            'kecamatan'     => ['nullable', 'string', 'max:100'],
            'foto'          => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
        ];

        if ($request->filled('current_password') || $request->filled('password')) {
            $rules['current_password'] = [
                'required',
                function ($attr, $value, $fail) use ($user) {
                    if (! Hash::check($value, $user->password)) {
                        $fail('Kata sandi saat ini tidak sesuai.');
                    }
                },
            ];
            $rules['password'] = ['required', 'confirmed', Password::min(8)];
        }

        $request->validate($rules);

        $user->nama          = $request->nama;
        $user->email         = $request->email;
        $user->no_hp         = $request->input('no_hp',        $user->no_hp);
        $user->alamat        = $request->input('alamat',       $user->alamat);
        $user->tempat_lahir  = $request->input('tempat_lahir', $user->tempat_lahir);
        $user->tanggal_lahir = $request->input('tanggal_lahir', $user->tanggal_lahir);

        foreach (['rt', 'rw', 'kelurahan', 'kecamatan'] as $col) {
            if (\Schema::hasColumn('users', $col)) {
                $user->$col = $request->input($col, $user->$col ?? null);
            }
        }

        if ($request->hasFile('foto') && \Schema::hasColumn('users', 'foto')) {
            if ($user->foto) Storage::disk('public')->delete($user->foto);
            $user->foto = $request->file('foto')->store('foto-profil', 'public');
        }

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('profile.edit')->with('success', 'Profil berhasil diperbarui.');
    }
}