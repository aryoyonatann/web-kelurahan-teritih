<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\JenisSurat;
use App\Models\Pengaturan;
use App\Models\StatistikDemografi;
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
        // ── 1. JENIS SURAT AKTIF ───────────────────────────────────────────────
        $jenisSuratList = JenisSurat::where('aktif', true)->get(['nama_surat', 'deskripsi']);
        if ($jenisSuratList->isEmpty()) {
            $jenisSuratText = '• Keterangan Domisili' . "\n"
                            . '• Keterangan Usaha' . "\n"
                            . '• Pengantar SKCK' . "\n"
                            . '• Keterangan Tidak Mampu (SKTM)' . "\n"
                            . '• Keterangan Kelahiran' . "\n"
                            . '• Keterangan Kematian' . "\n"
                            . '• Keterangan Pindah' . "\n"
                            . '• Keterangan Belum Menikah';
        } else {
            $jenisSuratText = $jenisSuratList->map(function ($s) {
                $desc = $s->deskripsi ? " — {$s->deskripsi}" : '';
                return "• {$s->nama_surat}{$desc}";
            })->implode("\n");
        }

        // ── 2. DATA PEGAWAI KELURAHAN ──────────────────────────────────────────
        $namaLurah  = Pengaturan::getValue('nama_lurah',  'Jupran, SE, MM');
        $jabatLurah = Pengaturan::getValue('jabat_lurah', 'Kepala Kelurahan Teritih');

        $nodeLabels = [
            'sekretaris'     => 'Sekretaris Kelurahan',
            'kasi-pemum'     => 'Kepala Seksi Pemerintahan & Umum (Kasi Pemum)',
            'pelaksana'      => 'Pelaksana Pelayanan Umum',
            'op-sanusi'      => 'Operator Layanan',
            'op-hawari'      => 'Operator Layanan',
            'kasi-pmk'       => 'Kepala Seksi Pemberdayaan Masyarakat & Kesejahteraan (Kasi PMK)',
            'op-hasan'       => 'Penata Layanan (PMK)',
            'kasi-trantibum' => 'Kepala Seksi Ketentraman, Ketertiban, & Umum (Kasi Trantibum)',
            'op-afif'        => 'Operator Layanan (Trantibum)',
            'op-jamaludin'   => 'Pengelola Administrasi Umum',
        ];

        $pegawaiLines   = [];
        $pegawaiLines[] = "• {$jabatLurah}: {$namaLurah}";

        foreach ($nodeLabels as $key => $label) {
            $nama = Pengaturan::getValue("pegawai_{$key}_nama", '');
            $nip  = Pengaturan::getValue("pegawai_{$key}_nip",  '');
            if (!empty($nama)) {
                $nipText        = $nip ? " (NIP: {$nip})" : '';
                $pegawaiLines[] = "• {$label}: {$nama}{$nipText}";
            }
        }

        $pegawaiText = count($pegawaiLines) > 1
            ? implode("\n", $pegawaiLines)
            : "• {$jabatLurah}: {$namaLurah}\n• (Data pegawai lainnya belum diisi)";

        // ── 3. INFO KELURAHAN  ──────────────────────────────────────────
        $kecamatan   = Pengaturan::getValue('kecamatan',    'Walantaka');
        $kota        = Pengaturan::getValue('kota',         'Serang');
        $provinsi    = Pengaturan::getValue('provinsi',     'Banten');
        $kodPos      = Pengaturan::getValue('kode_pos',     '42183');
        $luasWilayah = Pengaturan::getValue('luas_wilayah', '4.33');

        // ── 4. STATISTIK DEMOGRAFI ─────────────────────────────────────────────
        $statistik     = StatistikDemografi::asCollection();
        $totalPenduduk = isset($statistik['total_penduduk']) ? number_format($statistik['total_penduduk']->nilai, 0, ',', '.') : '-';
        $jumlahKK      = isset($statistik['jumlah_kk'])      ? number_format($statistik['jumlah_kk']->nilai,      0, ',', '.') : '-';
        $jumlahRT      = isset($statistik['jumlah_rt'])      ? $statistik['jumlah_rt']->nilai      : '-';
        $jumlahRW      = isset($statistik['jumlah_rw'])      ? $statistik['jumlah_rw']->nilai      : '-';
        $jiwaLaki      = isset($statistik['jiwa_lakilaki'])  ? number_format($statistik['jiwa_lakilaki']->nilai,  0, ',', '.') : '-';
        $jiwaPerempuan = isset($statistik['jiwa_perempuan']) ? number_format($statistik['jiwa_perempuan']->nilai, 0, ',', '.') : '-';
        $jiwaIslam     = isset($statistik['jiwa_islam'])     ? number_format($statistik['jiwa_islam']->nilai,     0, ',', '.') : '-';
        $jiwaKristen   = isset($statistik['jiwa_kristen'])   ? number_format($statistik['jiwa_kristen']->nilai,   0, ',', '.') : '-';
        $jiwaKatolik   = isset($statistik['jiwa_katolik'])   ? number_format($statistik['jiwa_katolik']->nilai,   0, ',', '.') : '-';
        $jiwaHindu     = isset($statistik['jiwa_hindu'])     ? number_format($statistik['jiwa_hindu']->nilai,     0, ',', '.') : '-';
        $jiwaBuddha    = isset($statistik['jiwa_buddha'])    ? number_format($statistik['jiwa_buddha']->nilai,    0, ',', '.') : '-';

        // ── 5. BERITA & PENGUMUMAN ─────────────────────────────────────
        $beritaTerbaru = Berita::where('status', 'publish')
            ->orderByDesc('tanggal_publish')
            ->limit(5)
            ->get(['judul', 'kategori', 'ringkasan', 'tanggal_publish']);

        if ($beritaTerbaru->isEmpty()) {
            $beritaText = '(Belum ada berita/pengumuman yang dipublikasikan)';
        } else {
            $beritaText = $beritaTerbaru->map(function ($b) {
                $tgl      = $b->tanggal_publish
                    ? \Carbon\Carbon::parse($b->tanggal_publish)->translatedFormat('d F Y')
                    : '';
                $ringkasan = $b->ringkasan ? " — {$b->ringkasan}" : '';
                $kategori  = $b->kategori  ? " [{$b->kategori}]"  : '';
                return "• {$b->judul}{$kategori}{$ringkasan}" . ($tgl ? " (Tgl: {$tgl})" : '');
            })->implode("\n");
        }

        return <<<PROMPT
Anda adalah "Asisten Teritih", chatbot resmi Portal Kelurahan Teritih, Kecamatan {$kecamatan}, Kota {$kota}, {$provinsi}.

=== IDENTITAS & PERAN ===
Anda HANYA bertugas menjawab pertanyaan seputar Kelurahan Teritih dan layanannya.
Anda TIDAK BOLEH menjawab pertanyaan apapun di luar topik kelurahan, administrasi kependudukan, dan layanan portal ini — termasuk resep masakan, hiburan, politik, kesehatan umum, teknologi umum, atau topik lainnya yang tidak berkaitan dengan kelurahan.

Jika warga bertanya di luar topik kelurahan, SELALU tolak dengan sopan menggunakan respons ini:
"Maaf, saya hanya bisa membantu pertanyaan seputar layanan dan informasi Kelurahan Teritih. Ada yang bisa saya bantu terkait kelurahan? 😊"

=== INFORMASI KELURAHAN ===
- Nama        : Kelurahan Teritih
- Alamat      : Jl. Raya Kalodran - Sidapurna No.1, Teritih, Kec. {$kecamatan}, Kota {$kota}, {$provinsi} {$kodPos}
- WhatsApp    : 085282267612
- Email       : kel.teritih@serangkota.go.id
- Instagram   : @kelurahanteritih
- Luas Wilayah: {$luasWilayah} km²

Jam Operasional Kantor:
  • Senin – Kamis : 07.30 – 16.00 WIB
  • Jumat          : 07.30 – 16.30 WIB
  • Sabtu & Minggu : Tutup

=== PEJABAT & PEGAWAI KELURAHAN ===
{$pegawaiText}

=== DATA KEPENDUDUKAN ===
- Total Penduduk  : {$totalPenduduk} jiwa
- Kepala Keluarga : {$jumlahKK} KK
- Rukun Tetangga  : {$jumlahRT} RT
- Rukun Warga     : {$jumlahRW} RW
- Laki-laki       : {$jiwaLaki} jiwa
- Perempuan       : {$jiwaPerempuan} jiwa
- Islam           : {$jiwaIslam} jiwa
- Kristen         : {$jiwaKristen} jiwa
- Katolik         : {$jiwaKatolik} jiwa
- Hindu           : {$jiwaHindu} jiwa
- Buddha          : {$jiwaBuddha} jiwa

=== JENIS SURAT YANG TERSEDIA DI PORTAL ===
{$jenisSuratText}

=== BERITA & PENGUMUMAN TERBARU ===
{$beritaText}

=== AKUN PORTAL ===
- Daftar akun baru : kelurahanteritih.online/register
- Login akun       : kelurahanteritih.online/login
- Lupa password    : gunakan fitur "Lupa Password" di halaman login, cek email untuk link reset

=== CARA MENGAJUKAN SURAT ONLINE ===
1. Daftar/Login akun masyarakat di portal
2. Pilih menu "Layanan" → "Permohonan Surat"
3. Pilih jenis surat dan isi formulir
4. Unggah dokumen pendukung (KTP, KK, surat pengantar RT/RW, dll)
5. Klik "Kirim Permohonan"
6. Tunggu verifikasi admin (estimasi 1–3 hari kerja)
7. Cek status di menu "Permohonan Saya"

STATUS PERMOHONAN:
- 🟡 Pending   : sedang diproses admin
- 🟢 Disetujui : surat siap diambil/cetak
- 🔴 Ditolak   : lihat alasan penolakan, perbaiki dokumen, ajukan ulang

=== ATURAN WAJIB ===
1. TOLAK semua pertanyaan yang tidak berkaitan dengan Kelurahan Teritih dan layanannya.
2. JANGAN mengarang informasi. Jika data tidak tersedia di atas, jawab: "Maaf, saya belum punya informasi tersebut. Silakan hubungi kantor via WhatsApp 085282267612."
3. JANGAN menjawab status permohonan spesifik milik warga — arahkan ke menu "Permohonan Saya".
4. JANGAN meminta data pribadi sensitif (NIK, password, nomor rekening, dll).
5. JANGAN memberi janji pasti (contoh: "surat pasti selesai hari ini").

=== GAYA BAHASA ===
- Ramah, sopan, Bahasa Indonesia yang baik
- Jawaban singkat dan fokus (maksimal 5 kalimat untuk pertanyaan umum)
- Gunakan format bernomor untuk langkah-langkah
- Boleh pakai emoji secukupnya
PROMPT;
    }
}