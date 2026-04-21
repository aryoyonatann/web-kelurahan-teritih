<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Kata Sandi – Kelurahan Teritih</title>
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

        .lock-icon-wrap {
            width: 72px; height: 72px; border-radius: 50%;
            background: #fffbeb; border: 2px solid #fde68a;
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 18px; font-size: 32px; color: #d97706;
        }

        .desc {
            font-size: 13.5px; color: #64748b; line-height: 1.65;
            text-align: center; margin-bottom: 24px;
        }

        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block; font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .06em;
            color: #374151; margin-bottom: 7px;
        }
        .form-label span { color: #ef4444; margin-left: 2px; }
        .input-wrap { position: relative; }
        .input-wrap .left-icon {
            position: absolute; left: 13px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8; font-size: 15px; pointer-events: none;
        }
        .form-input {
            width: 100%; padding: 11px 44px 11px 40px;
            border: 1.5px solid #e2e8f0; border-radius: 10px;
            font-size: 13.5px; font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0d1b3e; background: #f8fafc; outline: none; transition: all .15s;
        }
        .form-input:focus {
            border-color: #1c64f2; background: white;
            box-shadow: 0 0 0 3px rgba(28,100,242,.1);
        }
        .form-input::placeholder { color: #94a3b8; }
        .toggle-pw {
            position: absolute; right: 12px; top: 50%;
            transform: translateY(-50%);
            background: none; border: none; cursor: pointer;
            color: #94a3b8; font-size: 16px; padding: 4px;
            z-index: 10; line-height: 1; transition: color .15s;
        }
        .toggle-pw:hover { color: #1c64f2; }
        .toggle-pw:focus { outline: none; }
        .form-error {
            font-size: 11.5px; color: #ef4444; margin-top: 5px;
            display: flex; align-items: center; gap: 4px;
        }

        .btn-submit {
            width: 100%; padding: 13px; border: none; border-radius: 10px;
            background: linear-gradient(135deg, #0d1b3e, #1c64f2);
            color: white; font-size: 14px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer; transition: all .18s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
        }
        .btn-submit:hover {
            opacity: .9; transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(28,100,242,.3);
        }

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
        <h1>Konfirmasi Kata Sandi</h1>
        <p>Kelurahan Teritih · Portal Layanan Warga</p>
    </div>

    <div class="card-body">

        <div class="lock-icon-wrap">
            <i class="bi bi-shield-lock-fill"></i>
        </div>

        <p class="desc">
            Ini adalah area aman. Masukkan kata sandi Anda untuk memverifikasi identitas sebelum melanjutkan.
        </p>

        <form method="POST" action="{{ route('password.confirm') }}">
            @csrf

            <div class="form-group">
                <label for="password" class="form-label">
                    Kata Sandi <span>*</span>
                </label>
                <div class="input-wrap">
                    <i class="bi bi-lock-fill left-icon"></i>
                    <input type="password" id="password" name="password"
                        class="form-input"
                        placeholder="Masukkan kata sandi Anda"
                        required autocomplete="current-password">
                    <button type="button" class="toggle-pw" id="toggleBtn"
                        onclick="togglePassword('password', 'toggleBtn')">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password')
                <div class="form-error"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="bi bi-shield-check-fill"></i> Konfirmasi
            </button>
        </form>

    </div>

    <div class="card-footer">
        <strong>Kelurahan Teritih</strong> · Kec. Walantaka, Kota Serang
    </div>
</div>

<script>
function togglePassword(inputId, btnId) {
    const input = document.getElementById(inputId);
    const btn   = document.getElementById(btnId);
    const icon  = btn.querySelector('i');
    if (input.type === 'password') {
        input.type = 'text';
        icon.className = 'bi bi-eye-slash';
        btn.style.color = '#1c64f2';
    } else {
        input.type = 'password';
        icon.className = 'bi bi-eye';
        btn.style.color = '#94a3b8';
    }
}
</script>

</body>
</html>