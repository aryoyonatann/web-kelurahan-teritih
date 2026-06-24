{{--
    field_input partial
    Variables: $field (array), $prefix (string, e.g. '' or 'suami_' or 'istri_')
    Used by form_template.blade.php for biodata, suami, istri, extra groups
--}}
@php
    $key      = $field['key'] ?? '';
    $label    = $field['label'] ?? $key;
    $type     = $field['type'] ?? 'text';
    $required = $field['required'] ?? false;
    $group    = $field['group'] ?? 'biodata';
    $req      = $required ? 'required' : '';
    $star     = $required ? '<span class="req">*</span>' : '';

    // For suami/istri: field names already include suffix (e.g. nama_suami, nik_istri)
    // For biodata/extra: map standard keys to correct input names
    $isExtra   = $group === 'extra';
    $isSuami   = $group === 'suami';
    $isIstri   = $group === 'istri';
    $isPasangan = $isSuami || $isIstri;

    // Determine input name
    if ($isExtra) {
        $inputName = 'extra_' . $key;
    } elseif ($isPasangan) {
        // pasangan fields: key already has suffix like nama_suami, nik_istri
        $inputName = $key;
    } else {
        // biodata: map standard keys to controller-expected names
        $nameMap = [
            'nama'           => 'nama_pemohon',
            'nik'            => 'nik_pemohon',
            'alamat'         => 'alamat_pemohon',
            'tempat_tgl_lahir' => null, // split into two fields
        ];
        $inputName = $nameMap[$key] ?? $key;
    }
@endphp

@if($type === 'ttl')
    @php
        $suffix = $isPasangan ? '_'.last(explode('_', $key)) : '';
        $tempatName  = $isPasangan ? 'tempat_lahir'.$suffix  : 'tempat_lahir';
        $tanggalName = $isPasangan ? 'tanggal_lahir'.$suffix : 'tanggal_lahir';
    @endphp
    <div class="col-md-6">
        <label class="form-label-custom">Tempat Lahir {!! $star !!}</label>
        <input type="text" name="{{ $tempatName }}"
               @if(!$isPasangan) id="tempatLahir" @endif
               class="form-control" value="{{ old($tempatName) }}" {{ $req }}>
    </div>
    <div class="col-md-6">
        <label class="form-label-custom">Tanggal Lahir {!! $star !!}</label>
        <input type="date" name="{{ $tanggalName }}"
               @if(!$isPasangan) id="tanggalLahir" @endif
               class="form-control" value="{{ old($tanggalName) }}" {{ $req }}>
    </div>

@elseif($type === 'select' && $key === 'jenis_kelamin' || (str_starts_with($key,'jenis_kelamin')))
    <div class="col-md-4">
        <label class="form-label-custom">Jenis Kelamin {!! $star !!}</label>
        <select name="{{ $inputName }}" @if(!$isPasangan) id="jenisKelamin" @endif class="form-select" {{ $req }}>
            <option value="">Pilih...</option>
            <option value="Laki-Laki" {{ old($inputName)=='Laki-Laki'?'selected':'' }}>Laki-Laki</option>
            <option value="Perempuan" {{ old($inputName)=='Perempuan'?'selected':'' }}>Perempuan</option>
        </select>
    </div>

@elseif($type === 'agama')
    <div class="col-md-4">
        <label class="form-label-custom">{{ $label }} {!! $star !!}</label>
        <select name="{{ $inputName }}" class="form-select" {{ $req }}>
            <option value="">Pilih...</option>
            @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag)
            <option value="{{ $ag }}" {{ old($inputName)==$ag?'selected':'' }}>{{ $ag }}</option>
            @endforeach
        </select>
    </div>

@elseif($type === 'status_kawin')
    <div class="col-md-4">
        <label class="form-label-custom">{{ $label }} {!! $star !!}</label>
        <select name="{{ $inputName }}" class="form-select" {{ $req }}>
            <option value="">Pilih...</option>
            @foreach(['Belum Menikah','Kawin','Cerai Hidup','Cerai Mati'] as $sk)
            <option value="{{ $sk }}" {{ old($inputName)==$sk?'selected':'' }}>{{ $sk }}</option>
            @endforeach
        </select>
    </div>

@elseif($type === 'kewarganegaraan')
    <div class="col-md-4">
        <label class="form-label-custom">{{ $label }} {!! $star !!}</label>
        <select name="{{ $inputName }}" class="form-select" {{ $req }}>
            <option value="">Pilih...</option>
            <option value="WNI" {{ old($inputName)=='WNI'?'selected':'' }}>WNI</option>
            <option value="WNA" {{ old($inputName)=='WNA'?'selected':'' }}>WNA</option>
        </select>
    </div>

@elseif($type === 'pendidikan')
    <div class="col-md-4">
        <label class="form-label-custom">{{ $label }} {!! $star !!}</label>
        <select name="{{ $inputName }}" class="form-select" {{ $req }}>
            <option value="">Pilih...</option>
            @foreach(['Tidak Sekolah','SD','SMP','SMA/SMK','D1','D2','D3','S1','S2','S3'] as $p)
            <option value="{{ $p }}" {{ old($inputName)==$p?'selected':'' }}>{{ $p }}</option>
            @endforeach
        </select>
    </div>

@elseif($type === 'rt_rw')
    <div class="col-md-3">
        <label class="form-label-custom">RT</label>
        <input type="text" name="rt" class="form-control" value="{{ old('rt') }}" placeholder="001">
    </div>
    <div class="col-md-3">
        <label class="form-label-custom">RW</label>
        <input type="text" name="rw" class="form-control" value="{{ old('rw') }}" placeholder="002">
    </div>

@elseif($type === 'textarea')
    <div class="col-12">
        <label class="form-label-custom">{{ $label }} {!! $star !!}</label>
        <textarea name="{{ $inputName }}" class="form-control" rows="2" {{ $req }}>{{ old($inputName) }}</textarea>
    </div>

@elseif($type === 'date')
    <div class="col-md-6">
        <label class="form-label-custom">{{ $label }} {!! $star !!}</label>
        <input type="date" name="{{ $inputName }}" class="form-control" value="{{ old($inputName) }}" {{ $req }}>
    </div>

@elseif($key === 'nama')
    <div class="col-md-6">
        <label class="form-label-custom">{{ $label }} {!! $star !!}</label>
        <input type="text" name="{{ $inputName }}" id="namaPemohon" class="form-control"
               value="{{ old($inputName) }}" placeholder="Sesuai KTP" {{ $req }}>
    </div>

@elseif($key === 'nik')
    <div class="col-md-6">
        <label class="form-label-custom">{{ $label }} {!! $star !!}</label>
        <input type="text" name="{{ $inputName }}" id="nikPemohon" class="form-control"
               value="{{ old($inputName) }}" placeholder="16 digit NIK" maxlength="16" {{ $req }}>
    </div>

@elseif($key === 'pekerjaan')
    <div class="col-md-4">
        <label class="form-label-custom">{{ $label }} {!! $star !!}</label>
        <input type="text" name="{{ $inputName }}" id="pekerjaanField" class="form-control" value="{{ old($inputName) }}" {{ $req }}>
    </div>

@elseif($key === 'kelurahan')
    <div class="col-md-4">
        <label class="form-label-custom">{{ $label }}</label>
        <input type="text" name="{{ $inputName }}" class="form-control" value="{{ old($inputName, 'Teritih') }}">
    </div>

@elseif($key === 'kecamatan')
    <div class="col-md-4">
        <label class="form-label-custom">{{ $label }}</label>
        <input type="text" name="{{ $inputName }}" class="form-control" value="{{ old($inputName, 'Walantaka') }}">
    </div>

@elseif($key === 'no_hp')
    <div class="col-md-4">
        <label class="form-label-custom">{{ $label }}</label>
        <input type="text" name="{{ $inputName }}" class="form-control" value="{{ old($inputName) }}" placeholder="08xxxxxxxxxx">
    </div>

@elseif($type === 'number')
    <div class="col-md-3">
        <label class="form-label-custom">{{ $label }} {!! $star !!}</label>
        <input type="number" name="{{ $inputName }}" class="form-control" value="{{ old($inputName) }}" min="0" max="150" {{ $req }}>
    </div>

@else
    {{-- Generic text fallback untuk pasangan dan extra fields --}}
    <div class="col-md-{{ $type === 'textarea' ? '12' : '6' }}">
        <label class="form-label-custom">{{ $label }} {!! $star !!}</label>
        <input type="text" name="{{ $inputName }}" class="form-control" value="{{ old($inputName) }}" {{ $req }}>
    </div>
@endif
