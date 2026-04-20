<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Kata Sandi</title>
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: #f1f5f9;
            padding: 32px 16px;
            color: #334155;
        }
        .wrapper {
            max-width: 560px;
            margin: 0 auto;
        }
        /* Header atas */
        .top-bar {
            text-align: center;
            margin-bottom: 8px;
            font-size: 12px;
            color: #94a3b8;
        }
        /* Card utama */
        .card {
            background: white;
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(0,0,0,.08);
        }
        /* Header card */
        .card-header {
            background: linear-gradient(135deg, #0d1b3e 0%, #1c64f2 100%);
            padding: 32px 40px;
            text-align: center;
        }
        .header-icon {
            width: 64px; height: 64px;
            border-radius: 16px;
            background: rgba(255,255,255,.15);
            border: 2px solid rgba(255,255,255,.25);
            display: inline-block;
            margin-bottom: 14px;
            line-height: 64px;
            font-size: 28px;
            text-align: center;
        }
        .card-header h1 {
            font-size: 20px; font-weight: 700;
            color: white; margin-bottom: 4px;
        }
        .card-header p {
            font-size: 12px;
            color: rgba(255,255,255,.7);
        }
        /* Body card */
        .card-body {
            padding: 36px 40px;
        }
        .greeting {
            font-size: 16px; font-weight: 700;
            color: #0d1b3e; margin-bottom: 12px;
        }
        .text {
            font-size: 14px; color: #64748b;
            line-height: 1.7; margin-bottom: 14px;
        }
        /* Tombol */
        .btn-wrap { text-align: center; margin: 28px 0; }
        .btn {
            display: inline-block;
            padding: 14px 36px;
            background: linear-gradient(135deg, #0d1b3e, #1c64f2);
            color: white !important;
            text-decoration: none;
            border-radius: 10px;
            font-size: 15px; font-weight: 700;
        }
        /* Info kadaluarsa */
        .info-box {
            background: #fffbeb;
            border: 1px solid #fde68a;
            border-radius: 10px;
            padding: 12px 16px;
            font-size: 13px;
            color: #92400e;
            margin-bottom: 20px;
            display: flex; gap: 8px; align-items: flex-start;
        }
        /* Fallback URL */
        .url-box {
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            padding: 12px 14px;
            font-size: 11px;
            color: #64748b;
            word-break: break-all;
            margin-bottom: 20px;
        }
        .url-box span { color: #94a3b8; display: block; margin-bottom: 4px; font-weight: 600; text-transform: uppercase; letter-spacing: .05em; }
        .text-small {
            font-size: 12px; color: #94a3b8;
            line-height: 1.6; margin-bottom: 8px;
        }
        /* Divider */
        .divider {
            border: none; border-top: 1px solid #f1f5f9;
            margin: 24px 0;
        }
        /* Footer */
        .card-footer {
            background: #f8fafc;
            border-top: 1px solid #f1f5f9;
            padding: 20px 40px;
            text-align: center;
        }
        .footer-name {
            font-size: 13px; font-weight: 700; color: #0d1b3e;
            margin-bottom: 2px;
        }
        .footer-addr {
            font-size: 11px; color: #94a3b8;
        }
    </style>
</head>
<body>
<div class="wrapper">

    <div class="top-bar">Kelurahan Teritih · Portal Layanan Warga</div>

    <div class="card">

        <!-- Header -->
        <div class="card-header">
            <div class="header-icon">&#128274;</div>
            <h1>Reset Kata Sandi</h1>
            <p>Permintaan reset kata sandi akun Anda</p>
        </div>

        <!-- Body -->
        <div class="card-body">

            <p class="greeting">Halo, {{ $notifiable->nama ?? 'Pengguna' }}!</p>

            <p class="text">
                Kami menerima permintaan untuk mereset kata sandi akun Anda di <strong>Portal Layanan Warga Kelurahan Teritih</strong>. Klik tombol di bawah untuk melanjutkan:
            </p>

            <div class="btn-wrap">
                <a href="{{ $url }}" class="btn">🔑 &nbsp; Reset Kata Sandi</a>
            </div>

            <div class="info-box">
                <strong>⏰</strong>
                <div>Tautan ini akan <strong>kadaluarsa dalam 60 menit</strong>. Segera lakukan reset sebelum tautan tidak berlaku.</div>
            </div>

            <hr class="divider">

            <p class="text-small">
                Jika Anda tidak merasa melakukan permintaan ini, abaikan email ini — kata sandi Anda tidak akan berubah dan akun Anda tetap aman.
            </p>

            <p class="text-small" style="margin-top:12px">
                Jika tombol di atas tidak berfungsi, salin dan tempel tautan berikut ke browser Anda:
            </p>
            <div class="url-box">
                <span>Tautan Reset</span>
                {{ $url }}
            </div>

        </div>

        <!-- Footer -->
        <div class="card-footer">
            <div class="footer-name">Kelurahan Teritih</div>
            <div class="footer-addr">Jl. Raya Teritih No.123, Kec. Walantaka, Kota Serang, Banten 42183</div>
        </div>

    </div>

    <div style="text-align:center;margin-top:16px;font-size:11px;color:#94a3b8">
        Email ini dikirim otomatis, mohon jangan membalas email ini.
    </div>

</div>
</body>
</html>