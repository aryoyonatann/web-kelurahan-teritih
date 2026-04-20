<?php

namespace App\Http\Requests\Auth;

use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            // Hapus validasi 'email' agar NIK (angka) juga bisa masuk
            'email'    => ['required', 'string'],
            'password' => ['required', 'string'],
        ];
    }

    /**
     * Coba login dengan email ATAU NIK
     */
    public function authenticate(): void
    {
        $this->ensureIsNotRateLimited();

        $input    = $this->input('email'); // field bernama 'email' tapi bisa berisi NIK
        $password = $this->input('password');
        $remember = $this->boolean('remember');

        // Deteksi: jika input hanya angka → anggap NIK, selainnya → email
        $isNik = ctype_digit($input);

        $credentials = $isNik
            ? ['nik' => $input, 'password' => $password]
            : ['email' => $input, 'password' => $password];

        if (! Auth::attempt($credentials, $remember)) {
            RateLimiter::hit($this->throttleKey());

            throw ValidationException::withMessages([
                'email' => trans('auth.failed'),
            ]);
        }

        RateLimiter::clear($this->throttleKey());
    }

    public function ensureIsNotRateLimited(): void
    {
        if (! RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    public function throttleKey(): string
    {
        return Str::transliterate(Str::lower($this->string('email')).'|'.$this->ip());
    }
}
