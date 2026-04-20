<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: #f1f5f9;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
        }

        /* Background dekorasi */
        body::before {
            content: '';
            position: fixed;
            top: -120px; right: -120px;
            width: 400px; height: 400px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(28,100,242,.15), rgba(13,27,62,.1));
            pointer-events: none;
        }
        body::after {
            content: '';
            position: fixed;
            bottom: -100px; left: -100px;
            width: 320px; height: 320px;
            border-radius: 50%;
            background: linear-gradient(135deg, rgba(28,100,242,.1), rgba(96,165,250,.08));
            pointer-events: none;
        }

        .card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,.1), 0 4px 16px rgba(0,0,0,.06);
            width: 100%;
            max-width: 440px;
            overflow: hidden;
            position: relative;
            z-index: 1;
        }

        /* Header card */
        .card-header {
            background: linear-gradient(135deg, #0d1b3e, #1c64f2);
            padding: 32px 32px 28px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        .card-header::before {
            content: '';
            position: absolute;
            top: -40px; right: -40px;
            width: 130px; height: 130px;
            border-radius: 50%;
            background: rgba(255,255,255,.06);
        }
        .card-header::after {
            content: '';
            position: absolute;
            bottom: -30px; left: -30px;
            width: 100px; height: 100px;
            border-radius: 50%;
            background: rgba(255,255,255,.04);
        }

        .logo-wrap {
            width: 64px; height: 64px;
            border-radius: 16px;
            background: rgba(255,255,255,.15);
            border: 1.5px solid rgba(255,255,255,.25);
            display: flex; align-items: center; justify-content: center;
            margin: 0 auto 16px;
            position: relative; z-index: 1;
        }
        .logo-wrap img {
            width: 40px; height: 40px;
            object-fit: contain;
        }
        .logo-wrap .icon-fallback {
            font-size: 28px; color: white;
        }

        .card-header h1 {
            font-size: 20px; font-weight: 800;
            color: white; margin-bottom: 4px;
            position: relative; z-index: 1;
        }
        .card-header p {
            font-size: 12px;
            color: rgba(255,255,255,.7);
            position: relative; z-index: 1;
        }

        /* Body card */
        .card-body { padding: 28px 32px 32px; }

        .info-box {
            background: #eff6ff;
            border: 1.5px solid #bfdbfe;
            border-radius: 10px;
            padding: 12px 14px;
            display: flex;
            gap: 10px;
            align-items: flex-start;
            margin-bottom: 22px;
        }
        .info-box i {
            font-size: 16px; color: #2563eb;
            flex-shrink: 0; margin-top: 1px;
        }
        .info-box p {
            font-size: 13px; color: #1e40af;
            line-height: 1.55;
        }

        /* Alert status */
        .alert-status {
            background: #ecfdf5;
            border: 1.5px solid #6ee7b7;
            border-radius: 10px;
            padding: 11px 14px;
            display: flex;
            gap: 9px;
            align-items: center;
            margin-bottom: 20px;
            font-size: 13px;
            color: #065f46;
            font-weight: 500;
        }

        /* Form */
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 12px; font-weight: 700;
            text-transform: uppercase; letter-spacing: .06em;
            color: #374151; margin-bottom: 7px;
        }
        .form-label span { color: #ef4444; margin-left: 2px; }

        .input-wrap { position: relative; }
        .input-wrap i {
            position: absolute; left: 13px; top: 50%;
            transform: translateY(-50%);
            color: #94a3b8; font-size: 15px;
            pointer-events: none;
        }
        .form-input {
            width: 100%;
            padding: 11px 14px 11px 40px;
            border: 1.5px solid #e2e8f0;
            border-radius: 10px;
            font-size: 13.5px;
            font-family: 'Plus Jakarta Sans', sans-serif;
            color: #0d1b3e;
            background: #f8fafc;
            outline: none;
            transition: all .15s;
        }
        .form-input:focus {
            border-color: #1c64f2;
            background: white;
            box-shadow: 0 0 0 3px rgba(28,100,242,.1);
        }
        .form-input::placeholder { color: #94a3b8; }
        .form-error {
            font-size: 11.5px; color: #ef4444;
            margin-top: 5px;
            display: flex; align-items: center; gap: 4px;
        }

        /* Submit button */
        .btn-submit {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #0d1b3e, #1c64f2);
            color: white;
            font-size: 14px; font-weight: 700;
            font-family: 'Plus Jakarta Sans', sans-serif;
            cursor: pointer;
            transition: all .18s;
            display: flex; align-items: center; justify-content: center; gap: 8px;
            margin-bottom: 16px;
        }
        .btn-submit:hover {
            opacity: .9;
            transform: translateY(-1px);
            box-shadow: 0 6px 20px rgba(28,100,242,.3);
        }
        .btn-submit:active { transform: translateY(0); }

        /* Back link */
        .back-link {
            display: flex; align-items: center; justify-content: center; gap: 6px;
            font-size: 13px; font-weight: 600; color: #64748b;
            text-decoration: none;
            transition: color .15s;
        }
        .back-link:hover { color: #1c64f2; }

        /* Footer */
        .card-footer {
            padding: 14px 32px;
            border-top: 1px solid #f1f5f9;
            text-align: center;
            font-size: 11.5px; color: #94a3b8;
        }
        .card-footer strong { color: #64748b; }
    </style>
</head>
<body>

<div class="card">

    {{-- Header --}}
    <div class="card-header">
        <div class="logo-wrap">
            <img src="{{ asset('images/logo kota serang.png') }}"
                 onerror="this.style.display='none';this.nextElementSibling.style.display='flex'"
                 alt="Logo">
            <span class="icon-fallback" style="display:none"><i class="bi bi-building"></i></span>
        </div>
        <h1>Lupa Kata Sandi?</h1>
        <p>Kelurahan Teritih · Portal Layanan Warga</p>
    </div>

    {{-- Body --}}
    <div class="card-body">

        {{-- Info --}}
        <div class="info-box">
            <i class="bi bi-info-circle-fill"></i>
            <p>Masukkan alamat email yang terdaftar. Kami akan mengirimkan tautan untuk mereset kata sandi Anda.</p>
        </div>

        {{-- Status sukses --}}
        @if(session('status'))
        <div class="alert-status">
            <i class="bi bi-check-circle-fill" style="font-size:15px;flex-shrink:0"></i>
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="form-group">
                <label for="email" class="form-label">
                    Alamat Email <span>*</span>
                </label>
                <div class="input-wrap">
                    <i class="bi bi-envelope-fill"></i>
                    <input
                        type="email"
                        id="email"
                        name="email"
                        class="form-input"
                        value="{{ old('email') }}"
                        placeholder="Masukkan email Anda"
                        required
                        autofocus
                    >
                </div>
                @error('email')
                <div class="form-error">
                    <i class="bi bi-exclamation-circle"></i> {{ $message }}
                </div>
                @enderror
            </div>

            <button type="submit" class="btn-submit">
                <i class="bi bi-send-fill"></i>
                Kirim Tautan Reset Kata Sandi
            </button>
        </form>

        <a href="{{ route('login') }}" class="back-link">
            <i class="bi bi-arrow-left"></i> Kembali ke halaman login
        </a>

    </div>

    {{-- Footer --}}
    <div class="card-footer">
        <strong>Kelurahan Teritih</strong> · Kec. Walantaka, Kota Serang
    </div>

</div>

</body>
</html>