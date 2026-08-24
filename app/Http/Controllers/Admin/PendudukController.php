<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Penduduk;
use Illuminate\Http\Request;

class PendudukController extends Controller
{
    private array $pilihanAgama = [
        'Islam', 'Kristen Protestan', 'Katolik', 'Hindu',
        'Buddha', 'Konghucu', 'Kepercayaan Lainnya',
    ];

    private array $pilihanKawin = ['Belum Kawin', 'Kawin', 'Janda/Duda'];

    private array $pilihanPendidikan = [
        'Belum Sekolah (PAUD/TK)', 'Sedang Sekolah (7-18 Thn)', 'Tidak Tamat/Lainnya',
        'SD/Sederajat', 'SMP/Sederajat', 'SMA/Sederajat',
        'Diploma (D1-D3)', 'Sarjana (S1)', 'Pascasarjana (S2/S3)',
    ];

    private array $pilihanPekerjaan = [
        'Belum Bekerja', 'Pelajar', 'Ibu Rumah Tangga', 'Wiraswasta',
        'Buruh Harian Lepas', 'Karyawan Swasta', 'Petani',
        'Karyawan Pemerintah', 'Pedagang Keliling', 'Pedagang Kelontong',
    ];

    private array $pilihanHubungan = ['Kepala Keluarga', 'Istri', 'Anak Kandung', 'Ibu'];

    /** Ditampilkan sebagai bagian "Data Warga" di halaman Statistik Demografi */
    public function index(Request $request)
    {
        $q = trim((string) $request->get('q', ''));
        $rw = $request->get('rw', '');

        $query = Penduduk::query()->orderBy('nama');

        if ($q !== '') {
            $query->where(function ($w) use ($q) {
                $w->where('nama', 'like', "%{$q}%")
                  ->orWhere('nik', 'like', "%{$q}%");
            });
        }

        if ($rw !== '') {
            $query->where('rw', $rw);
        }

        $warga    = $query->paginate(15)->withQueryString();
        $daftarRw = Penduduk::select('rw')->distinct()->orderBy('rw')->pluck('rw');

        return view('Admin.penduduk.index', [
            'warga'    => $warga,
            'daftarRw' => $daftarRw,
            'q'        => $q,
            'rwFilter' => $rw,
        ]);
    }

    public function create()
    {
        return view('Admin.penduduk.form', [
            'warga'            => new Penduduk(),
            'pilihanAgama'     => $this->pilihanAgama,
            'pilihanKawin'     => $this->pilihanKawin,
            'pilihanPendidikan'=> $this->pilihanPendidikan,
            'pilihanPekerjaan' => $this->pilihanPekerjaan,
            'pilihanHubungan'  => $this->pilihanHubungan,
            'daftarTahun'      => $this->daftarTahunInput(),
            'currentYear'      => (int) now()->format('Y'),
        ]);
    }

    public function store(Request $request)
    {
        $data = $this->validasi($request);
        Penduduk::create($data);
        Penduduk::syncSemuaStatistik();

        return redirect()->route('admin.warga.index')->with('success', 'Data warga "' . $data['nama'] . '" berhasil ditambahkan. Statistik demografi telah diperbarui otomatis.');
    }

    public function edit(Penduduk $warga)
    {
        return view('Admin.penduduk.form', [
            'warga'            => $warga,
            'pilihanAgama'     => $this->pilihanAgama,
            'pilihanKawin'     => $this->pilihanKawin,
            'pilihanPendidikan'=> $this->pilihanPendidikan,
            'pilihanPekerjaan' => $this->pilihanPekerjaan,
            'pilihanHubungan'  => $this->pilihanHubungan,
            'daftarTahun'      => $this->daftarTahunInput(),
            'currentYear'      => (int) now()->format('Y'),
        ]);
    }

    public function update(Request $request, Penduduk $warga)
    {
        $data = $this->validasi($request, $warga->id);
        $warga->update($data);
        Penduduk::syncSemuaStatistik();

        return redirect()->route('admin.warga.index')->with('success', 'Data warga "' . $data['nama'] . '" berhasil diperbarui. Statistik demografi telah diperbarui otomatis.');
    }

    public function destroy(Penduduk $warga)
    {
        $nama = $warga->nama;
        $warga->delete();
        Penduduk::syncSemuaStatistik();

        return redirect()->route('admin.warga.index')->with('success', "Data warga \"{$nama}\" berhasil dihapus. Statistik demografi telah diperbarui otomatis.");
    }

    /**
     * Import massal data warga dari CSV. Kolom yang dibaca:
     * nama, nik, jenis_kelamin, tanggal_lahir, agama, status_kawin,
     * pendidikan, pekerjaan, hubungan_keluarga, rw, alamat
     */
    public function import(Request $request)
    {
        $request->validate([
            'file_import' => ['required', 'file', 'mimes:xlsx,xls,csv,txt', 'max:5120'],
        ], [
            'file_import.required' => 'Silakan pilih file terlebih dahulu.',
            'file_import.mimes'    => 'File harus berformat Excel (.xlsx/.xls) atau CSV (.csv).',
            'file_import.max'      => 'Ukuran file maksimal 5MB.',
        ]);

        $file      = $request->file('file_import');
        $extension = strtolower($file->getClientOriginalExtension());

        // Baca baris dari file — support xlsx/xls dan csv
        $rows = [];
        if (in_array($extension, ['xlsx', 'xls'])) {
            // Baca dengan PhpSpreadsheet
            $reader = \PhpOffice\PhpSpreadsheet\IOFactory::createReaderForFile($file->getRealPath());
            $reader->setReadDataOnly(true);
            $spreadsheet = $reader->load($file->getRealPath());
            $sheet       = $spreadsheet->getActiveSheet();
            foreach ($sheet->toArray(null, true, true, false) as $row) {
                // Konversi semua cell ke string, trim whitespace
                $rows[] = array_map(fn($v) => trim((string) ($v ?? '')), $row);
            }
            $spreadsheet->disconnectWorksheets();
            unset($spreadsheet);
        } else {
            // Baca CSV
            $handle = fopen($file->getRealPath(), 'r');
            if ($handle === false) {
                return back()->with('import_errors', ['File tidak dapat dibaca.']);
            }
            while (($row = fgetcsv($handle)) !== false) {
                $rows[] = array_map(fn($v) => trim((string) ($v ?? '')), $row);
            }
            fclose($handle);
        }

        if (empty($rows)) {
            return back()->with('import_errors', ['File kosong atau tidak dapat dibaca.']);
        }

        // Ambil baris header (baris pertama), bersihkan BOM
        $header    = $rows[0];
        $header[0] = preg_replace('/^\xEF\xBB\xBF/', '', $header[0]);
        $header    = array_map(fn($h) => strtolower(trim($h)), $header);

        $kolomWajib = ['nama', 'jenis_kelamin', 'tanggal_lahir', 'agama', 'rt', 'rw'];
        foreach ($kolomWajib as $k) {
            if (!in_array($k, $header)) {
                return back()->with('import_errors', ["Kolom '{$k}' wajib ada di file. Gunakan template yang disediakan."]);
            }
        }

        $idx      = array_flip($header);
        $berhasil = 0;
        $gagal    = [];

        foreach (array_slice($rows, 1) as $i => $row) {
            $baris = $i + 2; // +2 karena 1-indexed + skip header

            // Skip baris kosong sepenuhnya
            if (count(array_filter($row, fn($v) => $v !== '')) === 0) continue;

            $get = fn($key, $default = null) =>
                isset($idx[$key], $row[$idx[$key]]) && $row[$idx[$key]] !== ''
                    ? $row[$idx[$key]]
                    : $default;

            $nama  = $get('nama');
            $jk    = strtoupper((string) $get('jenis_kelamin', ''));
            $tgl   = $get('tanggal_lahir');
            $agama = $get('agama');
            $rt    = $get('rt');
            $rw    = $get('rw');

            // PhpSpreadsheet mungkin konversi tanggal Excel ke integer serial
            // Konversi ke string YYYY-MM-DD jika perlu
            if (is_numeric($tgl) && (int)$tgl > 1000) {
                try {
                    $tgl = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject((float)$tgl)
                        ->format('Y-m-d');
                } catch (\Throwable) {
                    $tgl = null;
                }
            }

            if (!$nama || !in_array($jk, ['L', 'P']) || !$tgl || !$agama || !$rt || !$rw) {
                $gagal[] = "Baris {$baris}: data wajib (nama/jenis_kelamin/tanggal_lahir/agama/rt/rw) tidak lengkap, dilewati.";
                continue;
            }

            if (!in_array($agama, $this->pilihanAgama)) {
                $gagal[] = "Baris {$baris}: agama '{$agama}' tidak dikenali, dilewati.";
                continue;
            }

            try {
                Penduduk::create([
                    'nik'               => $get('nik') ?: null,
                    'nama'              => $nama,
                    'jenis_kelamin'     => $jk,
                    'tanggal_lahir'     => $tgl,
                    'agama'             => $agama,
                    'status_kawin'      => in_array($get('status_kawin'), $this->pilihanKawin)
                                            ? $get('status_kawin') : 'Belum Kawin',
                    'pendidikan'        => in_array($get('pendidikan'), $this->pilihanPendidikan)
                                            ? $get('pendidikan') : 'SMA/Sederajat',
                    'pekerjaan'         => in_array($get('pekerjaan'), $this->pilihanPekerjaan)
                                            ? $get('pekerjaan') : 'Wiraswasta',
                    'hubungan_keluarga' => in_array($get('hubungan_keluarga'), $this->pilihanHubungan)
                                            ? $get('hubungan_keluarga') : 'Anak Kandung',
                    'rt'                => $rt,
                    'rw'                => $rw,
                    'alamat'            => $get('alamat'),
                ]);
                $berhasil++;
            } catch (\Throwable $e) {
                $gagal[] = "Baris {$baris}: gagal disimpan (kemungkinan NIK duplikat).";
            }
        }

        if ($berhasil > 0) {
            Penduduk::syncSemuaStatistik();
        }

        return redirect()->route('admin.warga.index')->with('import_summary', [
            'berhasil' => $berhasil,
            'gagal'    => $gagal,
        ]);
    }

    public function downloadTemplate()
    {
        $filename = 'template_data_warga_' . now()->format('Ymd_His') . '.xlsx';

        $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Data Warga');

        // Header kolom
        $headers = [
            'A1' => 'nama',
            'B1' => 'nik',
            'C1' => 'jenis_kelamin',
            'D1' => 'tanggal_lahir',
            'E1' => 'agama',
            'F1' => 'status_kawin',
            'G1' => 'pendidikan',
            'H1' => 'pekerjaan',
            'I1' => 'hubungan_keluarga',
            'J1' => 'rt',
            'K1' => 'rw',
            'L1' => 'alamat',
        ];
        foreach ($headers as $cell => $value) {
            $sheet->setCellValue($cell, $value);
        }

        // Style header — background biru, teks putih, bold
        $headerStyle = [
            'font'      => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
            'fill'      => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => ['argb' => 'FF1C64F2']],
            'alignment' => ['horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER],
            'borders'   => ['allBorders' => ['borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                                             'color' => ['argb' => 'FFBFDBFE']]],
        ];
        $sheet->getStyle('A1:L1')->applyFromArray($headerStyle);

        // Baris contoh
        $sheet->fromArray([
            'Contoh Nama Warga', '3672xxxxxxxxxxxx', 'L', '2000-05-17',
            'Islam', 'Belum Kawin', 'SMA/Sederajat', 'Wiraswasta',
            'Anak Kandung', '2', '3', 'Jl. Contoh No. 1',
        ], null, 'A2');

        // Style baris contoh — background kuning muda
        $sheet->getStyle('A2:L2')->applyFromArray([
            'fill'  => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                        'startColor' => ['argb' => 'FFFEF9C3']],
            'font'  => ['italic' => true, 'color' => ['argb' => 'FF92400E']],
        ]);

        // Auto-width kolom
        foreach (range('A', 'L') as $col) {
            $sheet->getColumnDimension($col)->setAutoSize(true);
        }

        // Freeze baris header
        $sheet->freezePane('A2');

        // Catatan nilai valid di sheet kedua
        $sheetInfo = $spreadsheet->createSheet();
        $sheetInfo->setTitle('Nilai Valid');
        $sheetInfo->setCellValue('A1', 'Kolom');
        $sheetInfo->setCellValue('B1', 'Nilai yang Diterima');
        $sheetInfo->getStyle('A1:B1')->applyFromArray([
            'font' => ['bold' => true],
            'fill' => ['fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                       'startColor' => ['argb' => 'FFF1F5F9']],
        ]);
        $info = [
            ['jenis_kelamin',    'L atau P'],
            ['tanggal_lahir',    'Format: YYYY-MM-DD (contoh: 2000-05-17)'],
            ['agama',            implode(', ', $this->pilihanAgama)],
            ['status_kawin',     implode(', ', $this->pilihanKawin)],
            ['pendidikan',       implode(', ', $this->pilihanPendidikan)],
            ['pekerjaan',        implode(', ', $this->pilihanPekerjaan)],
            ['hubungan_keluarga',implode(', ', $this->pilihanHubungan)],
            ['nik',              'Opsional, 16 digit angka, unik'],
            ['alamat',           'Opsional'],
        ];
        $row = 2;
        foreach ($info as [$col, $val]) {
            $sheetInfo->setCellValue("A{$row}", $col);
            $sheetInfo->setCellValue("B{$row}", $val);
            $row++;
        }
        $sheetInfo->getColumnDimension('A')->setAutoSize(true);
        $sheetInfo->getColumnDimension('B')->setWidth(80);
        $sheetInfo->getStyle('B2:B' . ($row - 1))->getAlignment()->setWrapText(true);

        // Set sheet aktif kembali ke sheet pertama
        $spreadsheet->setActiveSheetIndex(0);

        // Output sebagai stream
        $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
        $headers = [
            'Content-Type'        => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => "attachment; filename=\"{$filename}\"",
            'Cache-Control'       => 'max-age=0',
        ];

        return response()->stream(function () use ($writer) {
            $writer->save('php://output');
        }, 200, $headers);
    }

    private function validasi(Request $request, ?int $ignoreId = null): array
    {
        return $request->validate([
            'nama'              => ['required', 'string', 'max:150'],
            'nik'               => ['nullable', 'digits:16', 'unique:penduduk,nik' . ($ignoreId ? ",{$ignoreId}" : '')],
            'jenis_kelamin'     => ['required', 'in:L,P'],
            'tanggal_lahir'     => ['required', 'date', 'before_or_equal:today'],
            'agama'             => ['required', 'in:' . implode(',', $this->pilihanAgama)],
            'status_kawin'      => ['required', 'in:' . implode(',', $this->pilihanKawin)],
            'pendidikan'        => ['required', 'in:' . implode(',', $this->pilihanPendidikan)],
            'pekerjaan'         => ['required', 'in:' . implode(',', $this->pilihanPekerjaan)],
            'hubungan_keluarga' => ['required', 'in:' . implode(',', $this->pilihanHubungan)],
            'rt'                => ['required', 'string', 'max:10'],
            'rw'                => ['required', 'string', 'max:10'],
            'alamat'            => ['nullable', 'string', 'max:255'],
            'tahun_data'        => ['required', 'integer', 'min:2000', 'max:' . ((int) date('Y') + 1)],
        ], [
            'nik.digits'      => 'NIK harus terdiri dari 16 digit angka.',
            'nik.unique'      => 'NIK ini sudah terdaftar untuk warga lain.',
            'tahun_data.required' => 'Tahun data wajib dipilih.',
            'tahun_data.min'      => 'Tahun data tidak valid.',
            'tahun_data.max'      => 'Tahun data tidak boleh melebihi tahun depan.',
        ]);
    }

    /**
     * Daftar tahun untuk dropdown input data warga.
     * Range: 2010 s/d tahun berjalan (tidak boleh masa depan — data warga harus sudah ada).
     */
    private function daftarTahunInput(): array
    {
        $currentYear = (int) date('Y');
        $tahun = [];
        for ($y = $currentYear; $y >= 2010; $y--) {
            $tahun[$y] = $y === $currentYear ? "{$y} (Tahun ini)" : (string) $y;
        }
        return $tahun;
    }
}