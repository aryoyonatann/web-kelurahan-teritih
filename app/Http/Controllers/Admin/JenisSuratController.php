<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JenisSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class JenisSuratController extends Controller
{
    // Field biodata standar yang bisa dipilih admin
    public static array $standardFields = [
        ['key' => 'nama', 'label' => 'Nama Lengkap', 'type' => 'text', 'print_label' => 'N a m a'],
        ['key' => 'nik', 'label' => 'NIK', 'type' => 'text', 'print_label' => 'NIK'],
        ['key' => 'tempat_tgl_lahir', 'label' => 'Tempat / Tanggal Lahir', 'type' => 'ttl', 'print_label' => 'Tempat Tgl Lahir'],
        ['key' => 'umur', 'label' => 'Umur', 'type' => 'number', 'print_label' => 'Umur'],
        ['key' => 'jenis_kelamin', 'label' => 'Jenis Kelamin', 'type' => 'select', 'print_label' => 'Jenis Kelamin'],
        ['key' => 'agama', 'label' => 'Bangsa / Agama', 'type' => 'agama', 'print_label' => 'Bangsa/ Agama'],
        ['key' => 'status_kawin', 'label' => 'Status Perkawinan', 'type' => 'status_kawin', 'print_label' => 'Status Perkawinan'],
        ['key' => 'kewarganegaraan', 'label' => 'Kewarganegaraan', 'type' => 'kewarganegaraan', 'print_label' => 'Kewarganegaraan'],
        ['key' => 'pekerjaan', 'label' => 'Pekerjaan', 'type' => 'text', 'print_label' => 'Pekerjaan'],
        ['key' => 'pendidikan', 'label' => 'Pendidikan Terakhir', 'type' => 'pendidikan', 'print_label' => 'Pendidikan'],
        ['key' => 'alamat', 'label' => 'Alamat', 'type' => 'textarea', 'print_label' => 'Alamat'],
        ['key' => 'rt_rw', 'label' => 'RT / RW', 'type' => 'rt_rw', 'print_label' => 'RT/RW'],
        ['key' => 'kelurahan', 'label' => 'Kelurahan', 'type' => 'text', 'print_label' => 'Kelurahan'],
        ['key' => 'kecamatan', 'label' => 'Kecamatan', 'type' => 'text', 'print_label' => 'Kecamatan'],
        ['key' => 'no_hp', 'label' => 'No. HP / Telepon', 'type' => 'text', 'print_label' => 'No. HP'],
    ];

    public function index()
    {
        $data = JenisSurat::orderBy('id_jenis_surat')->get();
        return view('admin.jenis_surat.index', compact('data'));
    }

    public function create()
    {
        return view('admin.jenis_surat.create', [
            'standardFields' => self::$standardFields,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_surat'       => 'required|string|max:255',
            'deskripsi'        => 'nullable|string|max:500',
            'kode_klasifikasi' => 'required|string|max:20',
            'kode_surat'       => 'required|string|max:20',
            'template_pembuka' => 'required|string',
            'template_isi'     => 'nullable|string',
            'template_penutup' => 'required|string',
        ]);

        $slug = $this->generateSlug($request->nama_surat);

        JenisSurat::create([
            'nama_surat'       => $request->nama_surat,
            'deskripsi'        => $request->deskripsi,
            'slug'             => $slug,
            'is_custom'        => true,
            'icon'             => $request->icon ?? 'bi-file-earmark-text',
            'warna'            => $request->warna ?? '#64748b',
            'aktif'            => 1,
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'kode_surat'       => $request->kode_surat,
            'template_pembuka' => $request->template_pembuka,
            'template_isi'     => $request->template_isi,
            'template_penutup' => $request->template_penutup,
            'fields_config'    => $this->buildFieldsConfig($request),
        ]);

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = JenisSurat::findOrFail($id);
        return view('admin.jenis_surat.edit', [
            'data' => $data,
            'standardFields' => self::$standardFields,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = JenisSurat::findOrFail($id);

        $request->validate([
            'nama_surat'       => 'required|string|max:255',
            'deskripsi'        => 'nullable|string|max:500',
            'kode_klasifikasi' => 'required|string|max:20',
            'kode_surat'       => 'required|string|max:20',
            'template_pembuka' => 'required|string',
            'template_isi'     => 'nullable|string',
            'template_penutup' => 'required|string',
        ]);

        $slug = $this->generateSlug($request->nama_surat, $id);

        // Preserve print_style & template_text dari existing fields_config
        $existingFc = $data->fields_config ?? [];
        if (is_string($existingFc)) $existingFc = json_decode($existingFc, true) ?? [];
        $existingExtra = collect($existingFc)->where('group','extra')->keyBy('key');

        $newFieldsConfig = $this->buildFieldsConfig($request);
        foreach ($newFieldsConfig as &$f) {
            if (($f['group'] ?? '') === 'extra') {
                $existing = $existingExtra->get($f['key']);
                if ($existing) {
                    if (!isset($f['print_style'])    && isset($existing['print_style']))    $f['print_style']    = $existing['print_style'];
                    if (!isset($f['template_text'])  && isset($existing['template_text']))  $f['template_text']  = $existing['template_text'];
                }
            }
        }

        $data->update([
            'nama_surat'       => $request->nama_surat,
            'deskripsi'        => $request->deskripsi,
            'slug'             => $slug,
            'icon'             => $request->icon ?? $data->icon,
            'warna'            => $request->warna ?? $data->warna,
            'kode_klasifikasi' => $request->kode_klasifikasi,
            'kode_surat'       => $request->kode_surat,
            'template_pembuka' => $request->template_pembuka,
            'template_isi'     => $request->template_isi,
            'template_penutup' => $request->template_penutup,
            'fields_config'    => $newFieldsConfig,
        ]);

        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $data = JenisSurat::findOrFail($id);
        $data->delete();
        return redirect()->route('jenis-surat.index')->with('success', 'Jenis surat berhasil dihapus.');
    }

    private function generateSlug(string $name, ?int $excludeId = null): string
    {
        $base = Str::slug($name);
        $slug = $base;
        $counter = 1;
        $query = JenisSurat::where('slug', $slug);
        if ($excludeId) $query->where('id_jenis_surat', '!=', $excludeId);
        while ($query->clone()->exists()) {
            $slug = $base . '-' . $counter++;
        }
        return $slug;
    }

    private function buildFieldsConfig(Request $request): array
    {
        $fields = [];

        // Section label di atas biodata (opsional)
        $sectionLabel = trim($request->input('bio_section_label', ''));
        if ($sectionLabel) {
            $fields[] = [
                'key'         => 'section_ektp',
                'label'       => $sectionLabel,
                'type'        => 'section',
                'print_label' => $sectionLabel,
                'group'       => 'biodata',
                'required'    => false,
            ];
        }

        // Field biodata standar yang dicentang
        $bioFields = $request->input('bio_fields', []);
        foreach (self::$standardFields as $sf) {
            if (in_array($sf['key'], $bioFields)) {
                $fields[] = [
                    'key'         => $sf['key'],
                    'label'       => $sf['label'],
                    'type'        => $sf['type'],
                    'print_label' => $sf['print_label'],
                    'group'       => 'biodata',
                    'required'    => true,
                ];
            }
        }

        // Field tambahan custom (untuk form warga, tidak masuk tabel biodata cetak)
        $extraKeys       = $request->input('extra_key', []);
        $extraLabels     = $request->input('extra_label', []);
        $extraTypes      = $request->input('extra_type', []);
        $extraReq        = $request->input('extra_required', []);
        $extraPrint      = $request->input('extra_on_print', []);
        $extraPrintStyle = $request->input('extra_print_style', []);
        $extraTmplText   = $request->input('extra_template_text', []);

        foreach ($extraLabels as $i => $label) {
            $label = trim($label);
            if (!$label) continue;
            $key        = $extraKeys[$i] ?? Str::slug($label, '_');
            $printStyle = $extraPrintStyle[$i] ?? '';
            $tmplText   = $extraTmplText[$i] ?? '';
            $isCenterBold = $printStyle === 'center_bold';

            $f = [
                'key'         => $key,
                'label'       => $label,
                'type'        => $extraTypes[$i] ?? 'text',
                'print_label' => $label,
                'group'       => 'extra',
                'required'    => ($extraReq[$i] ?? '0') === '1',
                'on_print'    => $isCenterBold ? false : (($extraPrint[$i] ?? '0') === '1'),
            ];
            if ($printStyle !== '') $f['print_style']   = $printStyle;
            if ($tmplText   !== '') $f['template_text'] = $tmplText;
            $fields[] = $f;
        }

        return $fields;
    }
}
