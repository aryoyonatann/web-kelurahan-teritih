<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifikasi Email – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9; min-height: 100vh;
            display: flex; align-items: center; justify-content: center; padding: 20px;
        }
        body::before {
            content: ''; position: fixed; top: -120px; right: -120px;
            width: 400px; height: 400px; border-radius: 50%;
            background: linear-gradient(135deg, rgba(28,100,242,.15), rgba(13,27,62,.1));
            pointer-events: none;
        }
        body::after {
            content: ''; position: fixed; bottom: -100px; left: -100px;
            width: 320px; height: 320px; border-radius: 50%;
            background: linear-gradient(135deg, rgba(28,100,242,.1), rgba(96,165,250,.08));
            pointer-events: none;
        }
        .card {
            background: white; border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,.1), 0 4px 16px rgba(0,0,0,.06);
            width: 100%; max-width: 440px; overflow: hidden;
            position: relative; z-index: 1;
        }
        .card-header {
            background: linear-gradient(135deg, #0d1b3e, #1c64f2);
            padding: 32px 32px 28px; text-align: center;
            position: relative; overflow: hidden;
        }
        .card-header::before {
            content: ''; position: absolute; top: -40px; right: -40px;
            width: 130px; height: 130px; border-radius: 50%;
            background: rgba(255,255,255,.06);
        }
        .card-header::after {
            content: ''; position: absolute; bottom: -30px; left: -30px;
            width: 100px; height: 100px; border-radius: 50%;
            background: rgba(255,255,255,.04);
        }
        .logo-wrap {
            width: 64px; height: 64px; border-radius: 16px;
            background: rgba(255,255,255,.15); border: 1.5px solid rgba(255,255,255,.25);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px; position: relative; z-index: 1;
        }
        .logo-wrap img { width: 40px; height: 40px; object-fit: contain; }
        .card-header h1 {
            font-size: 20px; font-weight: 800; color: white; margin-bottom: 4px;
            position: relative; z-index: 1;
        }
        .card-header p { font-size: 12px; color: rgba(255,255,255,.7); position: relative; z-index: 1; }
        .card-body { padding: 28px 32px 32px; }

        /* Icon email besar di tengah */
        .email-icon-wrap {
            width: 72px; height: 72px; border-radius: 50%;
            background: #eff6ff; border: 2px solid #bfdbfe;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 18px; font-size: 32px; color: #1c64f2;
        }

        .desc {
            font-size: 13.5px; color: #64748b; line-height: 1.65;
            text-align: center; margin-bottom: 22px;
        }
        .desc strong { color: #0d1b3e; }

        /* Alert sukses */
        .alert-success {
            background: #ecfdf5; border: 1.5px solid #6ee7b7;
            border-radius: 10px; padding: 12px 14px;
            display: flex; gap: 9px; align-items: center;
            margin-bottom: 20px; font-size: 13px; color: #065f46; font-weight: 500;
        }

        .btn-resend {
            width: 100%; padding: 13px; border: none; border-radius: 10px;
            background: linear-gradient(135deg, #0d1b3e, #1c64f2);
            color: white; font-size: 14px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all .18s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            margin-bottom: 14px;
        }
        .btn-resend:hover {
            opacity: .9; transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(28,100,242,.3);
        }

        .btn-logout {
            width: 100%; padding: 11px; border-radius: 10px;
            border: 1.5px solid #e2e8f0; background: white;
            font-size: 13px; font-weight: 600; color: #64748b;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all .18s;
            display: flex; align-items: center; justify-content: center; gap: 7px;
        }
        .btn-logout:hover { border-color: #ef4444; color: #ef4444; background: #fef2f2; }

        .card-footer {
            padding: 14px 32px; border-top: 1px solid #f1f5f9;
            text-align: center; font-size: 11.5px; color: #94a3b8;
        }
        .card-footer strong { color: #64748b; }
    </style>
</head>
<body>

<div class="card">
    <div class="card-header">
        <div class="logo-wrap">
            <img src="{{ asset('images/logo kota serang.png') }}" alt="Logo">
        </div>
        <h1>Verifikasi Email</h1>
        <p>Kelurahan Teritih · Portal Layanan Warga</p>
    </div>

    <div class="card-body">

        <div class="email-icon-wrap">
            <i class="bi bi-envelope-check-fill"></i>
        </div>

        <p class="desc">
            Terima kasih telah mendaftar! Sebelum melanjutkan, silakan <strong>verifikasi alamat email</strong> Anda dengan mengklik tautan yang sudah kami kirimkan. Jika belum menerima email, klik tombol di bawah untuk mengirim ulang.
        </p>

        @if(session('status') == 'verification-link-sent')
        <div class="alert-success">
            <i class="bi bi-check-circle-fill" style="font-size:15px;flex-shrink:0"></i>
            Tautan verifikasi baru telah dikirim ke alamat email Anda.
        </div>
        @endif

        <form method="POST" action="{{ route('verification.send') }}">
            @csrf
            <button type="submit" class="btn-resend">
                <i class="bi bi-send-fill"></i> Kirim Ulang Email Verifikasi
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn-logout">
                <i class="bi bi-box-arrow-right"></i> Keluar dari Akun
            </button>
        </form>

    </div>

    <div class="card-footer">
        <strong>Kelurahan Teritih</strong> · Kec. Walantaka, Kota Serang
    </div>
</div>

</body>
</html>