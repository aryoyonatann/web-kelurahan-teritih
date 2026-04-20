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
        'tempat_lahir', 'tanggal_lahir', 'username', 'password',
        'rt', 'rw', 'kelurahan', 'kecamatan', 'foto', 'status',
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

        $user = $this;

        Mail::send('emails.reset-password', ['url' => $url, 'notifiable' => $user], function ($message) use ($user) {
            $message->to($user->email)
                    ->subject('Reset Kata Sandi – Kelurahan Teritih');
        });
    }
}