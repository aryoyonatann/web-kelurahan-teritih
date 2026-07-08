<?php

namespace App\Http\Controllers;

use App\Models\JenisSurat;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;


class ChatbotController extends Controller
{
    public function ask(Request $request): JsonResponse
    {
        // Validasi input
        $validated = $request->validate([
            'message' => 'required|string|min:2|max:500',
        ], [
            'message.required' => 'Pertanyaan tidak boleh kosong.',
            'message.min'      => 'Pertanyaan terlalu pendek.',
            'message.max'      => 'Pertanyaan terlalu panjang (maksimal 500 karakter).',
        ]);

        // Rate limiting — cegah spam (10 request per menit per IP)
        $key = 'chatbot:' . $request->ip();
        if (RateLimiter::tooManyAttempts($key, 10)) {
            $seconds = RateLimiter::availableIn($key);
            return response()->json([
                'success' => false,
                'reply'   => "⏳ Anda terlalu banyak bertanya. Silakan coba lagi dalam {$seconds} detik.",
            ], 429);
        }
        RateLimiter::hit($key, 60);

        // Cek konfigurasi API key
        $apiKey = config('services.gemini.api_key');
        $model  = config('services.gemini.model');

        $groqApiKey = config('services.groq.api_key');
        $groqModel  = config('services.groq.model');

        $systemPrompt = $this->buildSystemPrompt();

        // Kalau Gemini tidak dikonfigurasi sama sekali, langsung pakai Groq
        if (empty($apiKey)) {
            if (empty($groqApiKey)) {
                Log::error('Baik Gemini maupun Groq API key belum dikonfigurasi di .env');
                return response()->json([
                    'success' => false,
                    'reply'   => 'Maaf, layanan chatbot sedang tidak tersedia. Silakan hubungi kantor kelurahan di (0254) 123456.',
                ], 500);
            }

            try {
                $reply = $this->callGroq($groqApiKey, $groqModel, $systemPrompt, $validated['message']);
                return response()->json(['success' => true, 'reply' => $reply]);
            } catch (\Throwable $e) {
                Log::error('Groq API error (primary): ' . $e->getMessage());
                return response()->json([
                    'success' => false,
                    'reply'   => 'Maaf, asisten sedang sibuk. Silakan coba beberapa saat lagi atau pilih FAQ di atas.',
                ], 500);
            }
        }

        // Coba Gemini dulu, kalau gagal fallback ke Groq
        try {
            $reply = $this->callGemini(
                apiKey: $apiKey,
                model: $model,
                systemPrompt: $systemPrompt,
                userMessage: $validated['message'],
            );

            return response()->json([
                'success' => true,
                'reply'   => $reply,
            ]);
        } catch (\Throwable $e) {
            Log::warning('Gemini gagal, mencoba fallback ke Groq. Error: ' . $e->getMessage(), [
                'message' => $validated['message'],
            ]);

            // Fallback ke Groq jika tersedia
            if (!empty($groqApiKey)) {
                try {
                    $reply = $this->callGroq($groqApiKey, $groqModel, $systemPrompt, $validated['message']);
                    return response()->json([
                        'success' => true,
                        'reply'   => $reply,
                    ]);
                } catch (\Throwable $groqError) {
                    Log::error('Groq fallback juga gagal: ' . $groqError->getMessage(), [
                        'message' => $validated['message'],
                    ]);
                }
            }

            // Kedua provider gagal
            return response()->json([
                'success' => false,
                'reply'   => 'Maaf, asisten sedang sibuk. Silakan coba beberapa saat lagi atau pilih FAQ di atas.',
            ], 500);
        }
    }

    private function callGemini(string $apiKey, string $model, string $systemPrompt, string $userMessage): string
    {
        $url = "https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent";

        $payload = [
            // System instruction = "otak" chatbot, kasih konteks ke AI
            'system_instruction' => [
                'parts' => [
                    ['text' => $systemPrompt],
                ],
            ],
            // Pesan dari user
            'contents' => [
                [
                    'role'  => 'user',
                    'parts' => [
                        ['text' => $userMessage],
                    ],
                ],
            ],
            // Konfigurasi generasi — kontrol gaya jawaban
            'generationConfig' => [
                'temperature'     => 0.4,
                'maxOutputTokens' => 500,
                'topP'            => 0.9,
            ],
            // Safety settings — blokir konten berbahaya
            'safetySettings' => [
                ['category' => 'HARM_CATEGORY_HARASSMENT',        'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_HATE_SPEECH',       'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_SEXUALLY_EXPLICIT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
                ['category' => 'HARM_CATEGORY_DANGEROUS_CONTENT', 'threshold' => 'BLOCK_MEDIUM_AND_ABOVE'],
            ],
        ];

        // Retry otomatis: coba sampai 3 kali untuk error sementara (503, timeout, koneksi putus)
        $maxAttempts = 3;
        $lastException = null;

        for ($attempt = 1; $attempt <= $maxAttempts; $attempt++) {
            try {
                $response = Http::timeout(30)
                    ->withOptions([
                        // Pastikan SSL verify aktif di production, nonaktifkan hanya jika hosting bermasalah
                        'verify' => $this->getSslVerify(),
                    ])
                    ->withHeaders([
                        'Content-Type'   => 'application/json',
                        'x-goog-api-key' => $apiKey,
                    ])
                    ->post($url, $payload);

                // Jika 503 atau 429 (overload/rate limit), tunggu lalu retry
                if (in_array($response->status(), [429, 503]) && $attempt < $maxAttempts) {
                    $waitSeconds = $attempt * 2; // 2 detik, lalu 4 detik
                    Log::warning("Gemini API returned {$response->status()}, retrying in {$waitSeconds}s (attempt {$attempt}/{$maxAttempts})");
                    sleep($waitSeconds);
                    continue;
                }

                if (!$response->successful()) {
                    throw new \Exception('Gemini API HTTP ' . $response->status() . ': ' . $response->body());
                }

                $data = $response->json();

                // Ambil teks jawaban dari response
                $reply = data_get($data, 'candidates.0.content.parts.0.text');

                if (empty($reply)) {
                    // Bisa jadi diblokir safety filter
                    $blockReason = data_get($data, 'promptFeedback.blockReason');
                    if ($blockReason) {
                        return 'Maaf, pertanyaan tersebut tidak dapat saya jawab. Silakan ajukan pertanyaan lain seputar layanan kelurahan. 🙏';
                    }

                    // Periksa finish reason (bisa SAFETY, RECITATION, dll)
                    $finishReason = data_get($data, 'candidates.0.finishReason');
                    if ($finishReason && $finishReason !== 'STOP') {
                        Log::warning("Gemini non-STOP finish reason: {$finishReason}", ['data' => $data]);
                        return 'Maaf, pertanyaan tersebut tidak dapat saya jawab. Silakan ajukan pertanyaan lain seputar layanan kelurahan. 🙏';
                    }

                    throw new \Exception('Empty response from Gemini (finishReason: ' . ($finishReason ?? 'unknown') . ')');
                }

                return trim($reply);

            } catch (\Illuminate\Http\Client\ConnectionException $e) {
                // Error koneksi (timeout, SSL, DNS) — retry
                $lastException = $e;
                if ($attempt < $maxAttempts) {
                    $waitSeconds = $attempt * 2;
                    Log::warning("Gemini connection error (attempt {$attempt}/{$maxAttempts}): {$e->getMessage()}, retrying in {$waitSeconds}s");
                    sleep($waitSeconds);
                    continue;
                }
            }
        }

        // Semua retry gagal
        throw $lastException ?? new \Exception('Gemini API failed after all retries');
    }

    /**
     * Tentukan apakah SSL verify diaktifkan.
     * Di production (hosted), selalu true.
     * Di development dengan masalah SSL, bisa dimatikan via env.
     */
    private function getSslVerify(): bool|string
    {
        // Jika ada CA bundle yang ditentukan, gunakan itu
        $caBundle = config('services.gemini.ca_bundle');
        if (!empty($caBundle) && file_exists($caBundle)) {
            return $caBundle;
        }

        // Default: aktifkan SSL verify (aman untuk production)
        // Set GEMINI_SSL_VERIFY=false di .env HANYA jika hosting bermasalah dengan SSL
        return env('GEMINI_SSL_VERIFY', true);
    }

    /**
     * Fallback: panggil Groq API (Llama) jika Gemini gagal.
     * Groq gratis ~14.400 req/hari dan sangat stabil.
     */
    private function callGroq(string $apiKey, string $model, string $systemPrompt, string $userMessage): string
    {
        $response = Http::timeout(20)
            ->withHeaders([
                'Authorization' => 'Bearer ' . $apiKey,
                'Content-Type'  => 'application/json',
            ])
            ->post('https://api.groq.com/openai/v1/chat/completions', [
                'model'       => $model,
                'temperature' => 0.4,
                'max_tokens'  => 500,
                'messages'    => [
                    [
                        'role'    => 'system',
                        'content' => $systemPrompt,
                    ],
                    [
                        'role'    => 'user',
                        'content' => $userMessage,
                    ],
                ],
            ]);

        if (!$response->successful()) {
            throw new \Exception('Groq API HTTP ' . $response->status() . ': ' . $response->body());
        }

        $reply = data_get($response->json(), 'choices.0.message.content');

        if (empty($reply)) {
            throw new \Exception('Empty response from Groq');
        }

        return trim($reply);
    }

    
    private function buildSystemPrompt(): string
    {
        // Ambil daftar jenis surat aktif dari database (dinamis)
        $jenisSurat = JenisSurat::where('aktif', true)
            ->pluck('nama_surat')
            ->implode(', ');

        // Fallback kalau database kosong
        if (empty($jenisSurat)) {
            $jenisSurat = 'Keterangan Domisili, Keterangan Usaha, Pengantar SKCK, '
                       . 'Keterangan Tidak Mampu (SKTM), Keterangan Kelahiran, '
                       . 'Keterangan Kematian, Keterangan Pindah, Keterangan Belum Menikah';
        }

        return <<<PROMPT
Anda adalah "Asisten Teritih", chatbot resmi Portal Kelurahan Teritih, Kecamatan Walantaka, Kota Serang, Banten.

PERAN ANDA:
- Membantu warga dengan informasi seputar layanan administrasi kelurahan
- Menjawab dengan ramah, sopan, dan menggunakan Bahasa Indonesia yang baik
- Jawaban singkat dan jelas (maksimal 4-5 kalimat untuk pertanyaan umum)
- Boleh menggunakan emoji secukupnya untuk mempermudah pembacaan

INFORMASI KELURAHAN:
- Nama: Kelurahan Teritih
- Alamat: Jl. Raya Kalodran - Sidapurna No.1, Teritih, Kec. Walantaka, Kota Serang, Banten 42183
- WhatsApp: 085282267612
- Jam Operasional:
  • Senin–Kamis: 07.30–16.00 WIB
  • Jumat: 07.30–16.30 WIB
  • Sabtu & Minggu: TUTUP

JENIS SURAT YANG TERSEDIA:
{$jenisSurat}

CARA MENGAJUKAN SURAT (ONLINE):
1. Daftar/Login akun masyarakat di portal
2. Pilih menu "Layanan" → "Permohonan Surat"
3. Pilih jenis surat dan isi formulir
4. Unggah dokumen pendukung (KTP, KK, dll sesuai jenis surat)
5. Klik "Kirim Permohonan"
6. Tunggu verifikasi admin (1–3 hari kerja)
7. Status permohonan dapat dicek di menu "Permohonan Saya"

DOKUMEN UMUM YANG SERING DIBUTUHKAN:
- Fotokopi KTP (wajib untuk semua jenis surat)
- Fotokopi Kartu Keluarga (KK)
- Surat pengantar RT/RW
- Dokumen pendukung tambahan (sesuai jenis surat)

STATUS PERMOHONAN:
- 🟡 Pending: sedang diproses admin
- 🟢 Disetujui: surat siap diambil/cetak
- 🔴 Ditolak: lihat alasan penolakan, perbaiki dokumen, ajukan ulang

BATASAN PENTING — WAJIB DIPATUHI:
- JANGAN menjawab pertanyaan di luar topik kelurahan/administrasi (politik, agama, kesehatan, hukum di luar kelurahan, hiburan, dll). Tolak dengan sopan dan arahkan kembali ke topik kelurahan.
- JANGAN mengarang informasi yang tidak Anda ketahui. Jika tidak tahu jawabannya, sarankan menghubungi langsung kantor kelurahan melalui WhatsApp 085282267612.
- JANGAN meminta data pribadi sensitif (NIK, password akun, nomor rekening, dll).
- JANGAN memberikan janji yang tidak bisa ditepati (contoh: "surat pasti selesai hari ini", "permohonan Anda pasti disetujui").
- JANGAN menjawab pertanyaan tentang status permohonan spesifik milik user (Anda tidak punya akses ke data permohonan). Arahkan ke menu "Permohonan Saya" di portal.
- JANGAN memberikan opini pribadi atau penilaian terhadap kebijakan pemerintah.

GAYA BAHASA:
- Sapa dengan ramah ("Halo!", "Tentu, saya bantu jelaskan", "Baik, ")
- Gunakan format daftar bernomor untuk langkah-langkah
- Akhiri dengan tawaran bantuan lebih lanjut jika relevan ("Ada lagi yang bisa saya bantu?")
PROMPT;
    }
}