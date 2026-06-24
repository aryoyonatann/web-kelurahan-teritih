<!-- DATA PEMOHON -->
<div class="card-section">
    <div class="card-section-head">
        <div class="card-section-head-icon" style="background:var(--blue-lt);color:var(--blue)"><i class="bi bi-person-fill"></i></div>
        <div class="card-section-title">Data Pemohon (sesuai e-KTP)</div>
    </div>
    <div class="card-section-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label-custom">Nama Lengkap <span class="req">*</span></label>
                <input type="text" name="nama_pemohon" id="namaPemohon"
                    class="form-control @error('nama_pemohon') is-invalid @enderror"
                    value="{{ old('nama_pemohon') }}" placeholder="Sesuai KTP" required>
                @error('nama_pemohon')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label-custom">NIK <span class="req">*</span></label>
                <input type="text" name="nik_pemohon" id="nikPemohon"
                    class="form-control @error('nik_pemohon') is-invalid @enderror"
                    value="{{ old('nik_pemohon') }}" placeholder="16 digit NIK" maxlength="16" required>
                @error('nik_pemohon')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label-custom">Tempat Lahir <span class="req">*</span></label>
                <input type="text" name="tempat_lahir" id="tempatLahir"
                    class="form-control @error('tempat_lahir') is-invalid @enderror"
                    value="{{ old('tempat_lahir') }}" placeholder="Kota tempat lahir" required>
                @error('tempat_lahir')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label-custom">Tanggal Lahir <span class="req">*</span></label>
                <input type="date" name="tanggal_lahir" id="tanggalLahir"
                    class="form-control @error('tanggal_lahir') is-invalid @enderror"
                    value="{{ old('tanggal_lahir') }}" required>
                @error('tanggal_lahir')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label-custom">Jenis Kelamin <span class="req">*</span></label>
                <select name="jenis_kelamin" id="jenisKelamin"
                    class="form-select @error('jenis_kelamin') is-invalid @enderror" required>
                    <option value="">Pilih...</option>
                    <option value="Laki-Laki" {{ old('jenis_kelamin')=='Laki-Laki'?'selected':'' }}>Laki-Laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin')=='Perempuan'?'selected':'' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label-custom">Agama <span class="req">*</span></label>
                <select name="agama" id="agamaField" class="form-select @error('agama') is-invalid @enderror" required>
                    <option value="">Pilih...</option>
                    @foreach(['Islam','Kristen','Katolik','Hindu','Buddha','Konghucu'] as $ag)
                    <option value="{{ $ag }}" {{ old('agama')==$ag?'selected':'' }}>{{ $ag }}</option>
                    @endforeach
                </select>
                @error('agama')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="col-md-4">
                <label class="form-label-custom">Pekerjaan <span class="req">*</span></label>
                <input type="text" name="pekerjaan" id="pekerjaanField"
                    class="form-control @error('pekerjaan') is-invalid @enderror"
                    value="{{ old('pekerjaan') }}" placeholder="Pekerjaan" required>
                @error('pekerjaan')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
            <div class="col-12">
                <label class="form-label-custom">Alamat Lengkap <span class="req">*</span></label>
                <textarea name="alamat_pemohon" id="alamatPemohon"
                    class="form-control @error('alamat_pemohon') is-invalid @enderror"
                    rows="2" placeholder="Alamat lengkap sesuai KTP" required>{{ old('alamat_pemohon') }}</textarea>
                @error('alamat_pemohon')<span class="invalid-feedback">{{ $message }}</span>@enderror
            </div>
        </div>
    </div>
</div>
