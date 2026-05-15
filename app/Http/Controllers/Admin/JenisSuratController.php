<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JenisSuratController extends Controller
{
    /**
     * ════════════════════════════════════════════════════════════════
     *  PRESET FIELDS — DIPISAH PER TEMPLATE
     * ════════════════════════════════════════════════════════════════
     *  - Template A: tidak ada preset (form biodata standar saja)
     *  - Template B: field konteks/peristiwa
     *  - Template C: field konteks tambahan (Pihak Kedua sudah built-in)
     *
     *  Field Pihak Kedua TIDAK ADA di preset list karena sudah otomatis
     *  muncul sebagai struktur tetap di template C (lihat form_template.blade.php).
     * ════════════════════════════════════════════════════════════════
     */

    // Preset untuk Template B - field konteks/peristiwa
    public static array $presetFieldsB = [
        ['key' => 'tanggal_kejadian',    'label' => 'Tanggal Kejadian',         'type' => 'date'],
        ['key' => 'tempat_kejadian',     'label' => 'Tempat Kejadian',          'type' => 'text'],
        ['key' => 'nama_instansi',       'label' => 'Nama Instansi/Perusahaan', 'type' => 'text'],
        ['key' => 'lama_waktu',          'label' => 'Lama Waktu (hari)',        'type' => 'number'],
        ['key' => 'alasan',              'label' => 'Alasan/Sebab',             'type' => 'text'],
        ['key' => 'nama_pihak_terkait',  'label' => 'Nama Pihak Terkait',       'type' => 'text'],
        ['key' => 'nomor_dokumen',       'label' => 'Nomor Dokumen',            'type' => 'text'],
        ['key' => 'tanggal_mulai',       'label' => 'Tanggal Mulai',            'type' => 'date'],
        ['key' => 'tanggal_selesai',     'label' => 'Tanggal Selesai',          'type' => 'date'],
        ['key' => 'keterangan_tambahan', 'label' => 'Keterangan Tambahan',      'type' => 'textarea'],
    ];

    // Preset untuk Template C - field konteks opsional (Pihak Kedua sudah built-in)
    public static array $presetFieldsC = [
        ['key' => 'tanggal_kejadian',    'label' => 'Tanggal Kejadian',         'type' => 'date'],
        ['key' => 'tempat_kejadian',     'label' => 'Tempat Kejadian',          'type' => 'text'],
        ['key' => 'nama_instansi',       'label' => 'Nama Instansi/Perusahaan', 'type' => 'text'],
        ['key' => 'lama_waktu',          'label' => 'Lama Waktu (hari)',        'type' => 'number'],
        ['key' => 'alasan',              'label' => 'Alasan/Sebab',             'type' => 'text'],
        ['key' => 'nomor_dokumen',       'label' => 'Nomor Dokumen',            'type' => 'text'],
        ['key' => 'tanggal_mulai',       'label' => 'Tanggal Mulai',            'type' => 'date'],
        ['key' => 'tanggal_selesai',     'label' => 'Tanggal Selesai',          'type' => 'date'],
        ['key' => 'keterangan_tambahan', 'label' => 'Keterangan Tambahan',      'type' => 'textarea'],
    ];

    /**
     * Field "Pihak Kedua" yang OTOMATIS muncul di Template C.
     * Tidak ditampilkan di preset list — ini adalah struktur built-in.
     * Disimpan di sini sebagai referensi (juga dipakai di form_template.blade.php).
     */
    public static array $pihakKeduaFields = [
        ['key' => 'nama_pihak2',      'label' => 'Nama Lengkap Pihak Kedua',     'type' => 'text',     'required' => true],
        ['key' => 'nik_pihak2',       'label' => 'NIK Pihak Kedua',              'type' => 'text',     'required' => true],
        ['key' => 'ttl_pihak2',       'label' => 'Tempat/Tanggal Lahir Pihak Kedua', 'type' => 'text', 'required' => false],
        ['key' => 'pekerjaan_pihak2', 'label' => 'Pekerjaan Pihak Kedua',        'type' => 'text',     'required' => false],
        ['key' => 'alamat_pihak2',    'label' => 'Alamat Pihak Kedua',           'type' => 'textarea', 'required' => true],
        ['key' => 'hubungan',         'label' => 'Hubungan dengan Pemohon',      'type' => 'text',     'required' => true],
    ];

    /**
     * Helper untuk ambil preset berdasarkan template.
     */
    public static function getPresetsByTemplate(string $template): array
    {
        return match ($template) {
            'B'     => self::$presetFieldsB,
            'C'     => self::$presetFieldsC,
            default => [],
        };
    }

    /**
     * Helper untuk ambil semua preset (B + C merged unik) — dipakai di create/edit
     * agar admin bisa lihat semua opsi saat memilih template.
     */
    public static function getAllPresets(): array
    {
        $merged = [];
        foreach ([self::$presetFieldsB, self::$presetFieldsC] as $list) {
            foreach ($list as $f) {
                $merged[$f['key']] = $f;
            }
        }
        return array_values($merged);
    }

    // ════════════════════════════════════════════════════════════════
    //  CRUD METHODS
    // ════════════════════════════════════════════════════════════════

    public function index()
    {
        $data = JenisSurat::orderBy('is_custom')->orderBy('id_jenis_surat')->get();
        return view('admin.jenis_surat.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jenis_surat.create', [
            'presetsB'        => self::$presetFieldsB,
            'presetsC'        => self::$presetFieldsC,
            'pihakKeduaFields'=> self::$pihakKeduaFields,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_surat' => 'required|string|max:255',
            'deskripsi'  => 'nullable|string|max:500',
            'template'   => 'required|in:A,B,C',
        ], [
            'nama_surat.required' => 'Nama surat wajib diisi.',
            'template.required'   => 'Template wajib dipilih.',
        ]);

        // Generate slug unik
        $slug = Str::slug($request->nama_surat);
        $originalSlug = $slug;
        $counter = 1;
        while (JenisSurat::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        $fieldConfig = $this->buildFieldConfig($request);

        JenisSurat::create([
            'nama_surat'   => $request->nama_surat,
            'deskripsi'    => $request->deskripsi,
            'slug'         => $slug,
            'is_custom'    => true,
            'template'     => $request->template,
            'field_config' => $fieldConfig,
            'icon'         => 'bi-file-earmark-text',
            'warna'        => '#64748b',
            'aktif'        => 1,
        ]);

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = JenisSurat::findOrFail($id);
        return view('admin.jenis_surat.edit', [
            'data'             => $data,
            'presetsB'         => self::$presetFieldsB,
            'presetsC'         => self::$presetFieldsC,
            'pihakKeduaFields' => self::$pihakKeduaFields,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = JenisSurat::findOrFail($id);

        $request->validate([
            'nama_surat' => 'required|string|max:255',
            'deskripsi'  => 'nullable|string|max:500',
            'template'   => $data->is_custom ? 'required|in:A,B,C' : 'nullable',
        ]);

        $updateData = [
            'nama_surat' => $request->nama_surat,
            'deskripsi'  => $request->deskripsi,
        ];

        if ($data->is_custom) {
            $slug = Str::slug($request->nama_surat);
            $originalSlug = $slug;
            $counter = 1;
            while (JenisSurat::where('slug', $slug)->where('id_jenis_surat', '!=', $id)->exists()) {
                $slug = $originalSlug . '-' . $counter++;
            }
            $updateData['slug']         = $slug;
            $updateData['template']     = $request->template;
            $updateData['field_config'] = $this->buildFieldConfig($request);
        }

        $data->update($updateData);

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = JenisSurat::findOrFail($id);

        if (!$data->is_custom) {
            return redirect()->route('jenis-surat.index')
                ->with('error', 'Surat bawaan sistem tidak dapat dihapus.');
        }

        $data->delete();

        return redirect()->route('jenis-surat.index')
            ->with('success', 'Jenis surat berhasil dihapus.');
    }

    /**
     * ════════════════════════════════════════════════════════════════
     *  BUILD FIELD CONFIG
     * ════════════════════════════════════════════════════════════════
     *  Hanya menyimpan field yang VALID untuk template terpilih.
     *  - Template A: tidak ada field (kembalikan array kosong)
     *  - Template B: hanya field dari preset B + custom
     *  - Template C: hanya field dari preset C + custom
     *    (Pihak Kedua TIDAK disimpan di sini — sudah hardcoded di form view)
     * ════════════════════════════════════════════════════════════════
     */
    private function buildFieldConfig(Request $request): array
    {
        $template = $request->input('template');

        // Template A: tidak ada field tambahan
        if ($template === 'A') {
            return [];
        }

        // Ambil preset yang valid untuk template ini
        $validPresets = self::getPresetsByTemplate($template);
        $validKeys    = array_column($validPresets, 'key');
        $labels       = array_column($validPresets, 'label', 'key');
        $types        = array_column($validPresets, 'type',  'key');

        $fields = [];

        // 1. Field preset yang dicentang DAN valid untuk template ini
        foreach ($request->input('preset_fields', []) as $key) {
            if (in_array($key, $validKeys)) {
                $fields[] = [
                    'key'       => $key,
                    'label'     => $labels[$key],
                    'type'      => $types[$key],
                    'required'  => in_array($key, $request->input('required_fields', [])),
                    'is_preset' => true,
                ];
            }
        }

        // 2. Field custom yang diketik admin
        $customLabels = $request->input('custom_label', []);
        $customTypes  = $request->input('custom_type', []);
        $customReq    = $request->input('custom_required', []);

        foreach ($customLabels as $i => $label) {
            $label = trim($label);
            if (!$label) continue;

            $key = Str::slug($label, '_') ?: 'field_' . $i;

            $fields[] = [
                'key'       => $key,
                'label'     => $label,
                'type'      => $customTypes[$i] ?? 'text',
                'required'  => isset($customReq[$i]),
                'is_preset' => false,
            ];
        }

        return $fields;
    }
}