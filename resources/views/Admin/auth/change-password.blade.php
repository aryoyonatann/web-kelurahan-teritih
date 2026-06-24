@extends('Admin.layouts.app')
@section('title', 'Ganti Password')
@section('content')
@include('Admin.partials.header')

<div style="padding:32px 28px;max-width:480px;margin:0 auto">
    <div style="margin-bottom:24px">
        <div style="font-size:12px;font-weight:600;color:#64748b;text-transform:uppercase;letter-spacing:.08em;margin-bottom:6px">Akun Admin</div>
        <h1 style="font-size:22px;font-weight:800;color:#0d1b3e;margin:0">Ganti Password</h1>
        <p style="font-size:14px;color:#64748b;margin-top:4px">Perbarui kata sandi akun administrator Anda</p>
    </div>

    <div style="background:white;border:1px solid #e2e8f0;border-radius:16px;padding:28px">
        <form action="{{ route('admin.password.update') }}" method="POST">
            @csrf
            <div style="margin-bottom:18px">
                <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px">Password Lama</label>
                <input type="password" name="password_lama" required
                    style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('password_lama') ? '#ef4444' : '#e2e8f0' }};border-radius:10px;font-size:14px;font-family:inherit;outline:none;transition:border .15s"
                    onfocus="this.style.borderColor='#1c64f2'" onblur="this.style.borderColor='#e2e8f0'">
                @error('password_lama')<div style="font-size:12px;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:18px">
                <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px">Password Baru</label>
                <input type="password" name="password_baru" required
                    style="width:100%;padding:10px 14px;border:1.5px solid {{ $errors->has('password_baru') ? '#ef4444' : '#e2e8f0' }};border-radius:10px;font-size:14px;font-family:inherit;outline:none;transition:border .15s"
                    onfocus="this.style.borderColor='#1c64f2'" onblur="this.style.borderColor='#e2e8f0'">
                @error('password_baru')<div style="font-size:12px;color:#ef4444;margin-top:4px">{{ $message }}</div>@enderror
            </div>

            <div style="margin-bottom:24px">
                <label style="display:block;font-size:13px;font-weight:600;color:#374151;margin-bottom:6px">Konfirmasi Password Baru</label>
                <input type="password" name="password_baru_confirmation" required
                    style="width:100%;padding:10px 14px;border:1.5px solid #e2e8f0;border-radius:10px;font-size:14px;font-family:inherit;outline:none;transition:border .15s"
                    onfocus="this.style.borderColor='#1c64f2'" onblur="this.style.borderColor='#e2e8f0'">
            </div>

            <button type="submit"
                style="width:100%;padding:12px;border-radius:10px;border:none;background:#1c64f2;color:white;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit;transition:background .18s"
                onmouseover="this.style.background='#1a56db'" onmouseout="this.style.background='#1c64f2'">
                <i class="bi bi-shield-check"></i> Simpan Password Baru
            </button>
        </form>
    </div>
</div>
@endsection
