<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Autentikasi') – Kelurahan Teritih</title>
    <link rel="icon" type="image/png" href="{{ asset('images/logo kota serang.png') }}">

    {{-- Google Fonts --}}
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    {{-- Bootstrap Icons --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    {{-- Base auth styles --}}
    <style>
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

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

    /* Card container */
    .auth-card {
        background: white;
        border-radius: 20px;
        box-shadow: 0 20px 60px rgba(0,0,0,.1), 0 4px 16px rgba(0,0,0,.06);
        width: 100%;
        max-width: 440px;
        overflow: hidden;
        position: relative;
        z-index: 1;
    }

    /* Card header */
    .auth-card-header {
        background: linear-gradient(135deg, #0d1b3e, #1c64f2);
        padding: 32px 32px 28px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .auth-card-header::before {
        content: '';
        position: absolute;
        top: -40px; right: -40px;
        width: 130px; height: 130px;
        border-radius: 50%;
        background: rgba(255,255,255,.06);
    }
    .auth-card-header::after {
        content: '';
        position: absolute;
        bottom: -30px; left: -30px;
        width: 100px; height: 100px;
        border-radius: 50%;
        background: rgba(255,255,255,.04);
    }

    .auth-logo-wrap {
        width: 64px; height: 64px;
        border-radius: 16px;
        background: rgba(255,255,255,.15);
        border: 1.5px solid rgba(255,255,255,.25);
        display: flex; align-items: center; justify-content: center;
        margin: 0 auto 16px;
        position: relative; z-index: 1;
    }
    .auth-logo-wrap img { width: 40px; height: 40px; object-fit: contain; }
    .auth-logo-wrap .icon-fallback { font-size: 28px; color: white; }

    .auth-card-header h1 {
        font-size: 20px; font-weight: 800;
        color: white; margin-bottom: 4px;
        position: relative; z-index: 1;
    }
    .auth-card-header p {
        font-size: 12px;
        color: rgba(255,255,255,.7);
        position: relative; z-index: 1;
    }

    /* Card body */
    .auth-card-body { padding: 28px 32px 32px; }

    /* Form elements */
    .form-group { margin-bottom: 20px; }
    .form-label {
        display: block;
        font-size: 12px; font-weight: 700;
        text-transform: uppercase; letter-spacing: .06em;
        color: #374151; margin-bottom: 7px;
    }
    .form-label span { color: #ef4444; margin-left: 2px; }

    .input-wrap { position: relative; }
    .input-wrap > i {
        position: absolute; left: 13px; top: 50%;
        transform: translateY(-50%);
        color: #94a3b8; font-size: 15px;
        pointer-events: none;
        z-index: 1;
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

    /* Alert boxes */
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
    .info-box i { font-size: 16px; color: #2563eb; flex-shrink: 0; margin-top: 1px; }
    .info-box p { font-size: 13px; color: #1e40af; line-height: 1.55; }

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

    /* Primary button */
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

    /* Secondary button */
    .btn-secondary-auth {
        width: 100%; padding: 11px; border-radius: 10px;
        border: 1.5px solid #e2e8f0; background: white;
        font-size: 13px; font-weight: 600; color: #64748b;
        font-family: 'Plus Jakarta Sans', sans-serif;
        cursor: pointer; transition: all .18s;
        display: flex; align-items: center; justify-content: center; gap: 7px;
    }
    .btn-secondary-auth:hover { border-color: #ef4444; color: #ef4444; background: #fef2f2; }

    /* Back link */
    .back-link {
        display: flex; align-items: center; justify-content: center; gap: 6px;
        font-size: 13px; font-weight: 600; color: #64748b;
        text-decoration: none;
        transition: color .15s;
    }
    .back-link:hover { color: #1c64f2; }

    /* Card footer */
    .auth-card-footer {
        padding: 14px 32px;
        border-top: 1px solid #f1f5f9;
        text-align: center;
        font-size: 11.5px; color: #94a3b8;
    }
    .auth-card-footer strong { color: #64748b; }
    </style>

    @stack('styles')
</head>
<body>

    @yield('content')

</body>
</html>
