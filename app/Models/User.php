<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $primaryKey = 'id_user';
    protected $table = 'users';

    protected $fillable = [
        'nama', 'nik', 'alamat', 'no_hp', 'email',
        'tempat_lahir', 'tanggal_lahir', 'password',
        'rt', 'rw', 'kelurahan', 'kecamatan', 'foto',
        // 'status' sengaja TIDAK ada di sini — diset langsung via assignment ($user->status = ...)
        // di controller yang trusted (KelolaAkunController, RegisteredUserController)
        // untuk mencegah user memanipulasi status sendiri lewat request.
        'last_login_at',
    ];

    protected $hidden = ['password', 'remember_token'];

    protected function casts(): array
    {
        return [
            'tanggal_lahir' => 'date',
            'password'      => 'hashed',
            'last_login_at' => 'datetime',
        ];
    }

    // ── Relasi ke permohonan surat ──────────────────────────────
    public function permohonan()
    {
        return $this->hasMany(PermohonanSurat::class, 'id_user', 'id_user');
    }

    // ── Override email reset password ───────────────────────────
    public function sendPasswordResetNotification($token): void
    {
        $url = url(route('password.reset', [
            'token' => $token,
            'email' => $this->email,
        ], false));

        try {
            Mail::send('emails.reset-password', ['url' => $url, 'notifiable' => $this], function ($message) {
                $message->to($this->email)
                        ->subject('Reset Kata Sandi – Kelurahan Teritih');
            });
        } catch (\Throwable $e) {
            // Gagal kirim email (SMTP tidak terkonfigurasi, dll.)
            // Log error tapi jangan crash — user mendapat pesan error yang bersih
            \Illuminate\Support\Facades\Log::error('Gagal mengirim email reset password: ' . $e->getMessage(), [
                'user_id' => $this->getKey(),
            ]);

            throw new \RuntimeException(
                'Gagal mengirim email reset kata sandi. Pastikan konfigurasi email sudah benar atau hubungi admin.'
            );
        }
    }
}