<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    public function showLoginForm()
    {
        return view('Admin.auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'password');
        $remember = $request->boolean('remember');

        if (Auth::guard('admin')->attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'username' => 'Username atau password salah',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/admin/login');
    }

    public function showChangePassword()
    {
        return view('Admin.auth.change-password');
    }

    public function changePassword(Request $request)
    {
        $request->validate([
            'password_lama'  => 'required',
            'password_baru'  => 'required|min:8|confirmed',
        ], [
            'password_baru.min'       => 'Password baru minimal 8 karakter.',
            'password_baru.confirmed' => 'Konfirmasi password tidak cocok.',
        ]);

        $admin = Auth::guard('admin')->user();

        if (!\Illuminate\Support\Facades\Hash::check($request->password_lama, $admin->password)) {
            return back()->with('error', 'Password lama tidak sesuai.');
        }

        $admin->update(['password' => \Illuminate\Support\Facades\Hash::make($request->password_baru)]);

        return back()->with('success', 'Password berhasil diubah.');
    }
}