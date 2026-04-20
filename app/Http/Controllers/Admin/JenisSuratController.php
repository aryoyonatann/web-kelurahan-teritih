<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JenisSuratController extends Controller
{
    // Field preset yang tersedia untuk Template B dan C
    public static array $presetFields = [
        // Template B & C
        ['key' => 'tanggal_kejadian',   'label' => 'Tanggal Kejadian',        'type' => 'date'],
        ['key' => 'tempat_kejadian',    'label' => 'Tempat Kejadian',         'type' => 'text'],
        ['key' => 'nama_instansi',      'label' => 'Nama Instansi/Perusahaan','type' => 'text'],
        ['key' => 'lama_waktu',         'label' => 'Lama Waktu (hari)',       'type' => 'number'],
        ['key' => 'alasan',             'label' => 'Alasan/Sebab',            'type' => 'text'],
        ['key' => 'nama_pihak_terkait', 'label' => 'Nama Pihak Terkait',     'type' => 'text'],
        ['key' => 'nomor_dokumen',      'label' => 'Nomor Dokumen',          'type' => 'text'],
        ['key' => 'tanggal_mulai',      'label' => 'Tanggal Mulai',          'type' => 'date'],
        ['key' => 'tanggal_selesai',    'label' => 'Tanggal Selesai',        'type' => 'date'],
        ['key' => 'keterangan_tambahan','label' => 'Keterangan Tambahan',    'type' => 'textarea'],
        // Template C (pihak kedua)
        ['key' => 'nama_pihak2',        'label' => 'Nama Pihak Kedua',       'type' => 'text'],
        ['key' => 'nik_pihak2',         'label' => 'NIK Pihak Kedua',        'type' => 'text'],
        ['key' => 'ttl_pihak2',         'label' => 'Tempat/Tgl Lahir Pihak Kedua','type' => 'text'],
        ['key' => 'pekerjaan_pihak2',   'label' => 'Pekerjaan Pihak Kedua', 'type' => 'text'],
        ['key' => 'alamat_pihak2',      'label' => 'Alamat Pihak Kedua',    'type' => 'textarea'],
        ['key' => 'hubungan',           'label' => 'Hubungan dengan Pemohon','type' => 'text'],
    ];

    public function index()
    {
        $data = JenisSurat::orderBy('is_custom')->orderBy('id_jenis_surat')->get();
        return view('admin.jenis_surat.index', compact('data'));
    }

    public function create()
    {
        $presets = self::$presetFields;
        return view('admin.jenis_surat.create', compact('presets'));
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

        // Susun field_config dari preset + custom fields
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
        $data    = JenisSurat::findOrFail($id);
        $presets = self::$presetFields;
        return view('admin.jenis_surat.edit', compact('data', 'presets'));
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

        // Surat custom: update slug, template, field_config
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

    // ── Bangun field_config dari request ────────────────────
    private function buildFieldConfig(Request $request): array
    {
        $fields = [];

        // 1. Field preset yang dicentang
        $presetKeys   = array_column(self::$presetFields, 'key');
        $presetLabels = array_column(self::$presetFields, 'label', 'key');
        $presetTypes  = array_column(self::$presetFields, 'type', 'key');

        foreach ($request->input('preset_fields', []) as $key) {
            if (in_array($key, $presetKeys)) {
                $fields[] = [
                    'key'      => $key,
                    'label'    => $presetLabels[$key],
                    'type'     => $presetTypes[$key],
                    'required' => in_array($key, $request->input('required_fields', [])),
                    'is_preset'=> true,
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
                'key'      => $key,
                'label'    => $label,
                'type'     => $customTypes[$i] ?? 'text',
                'required' => isset($customReq[$i]),
                'is_preset'=> false,
            ];
        }

        return $fields;
    }
}