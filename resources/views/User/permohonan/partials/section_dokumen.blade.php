<!-- LAMPIRAN DOKUMEN -->
<div class="card-section">
    <div class="card-section-head">
        <div class="card-section-head-icon" style="background:#fffbeb;color:#f59e0b"><i class="bi bi-paperclip"></i></div>
        <div class="card-section-title">Lampiran Dokumen</div>
    </div>
    <div class="card-section-body">
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label-custom">Foto/Scan KTP <span class="req">*</span></label>
                <div class="file-wrap">
                    <input type="file" name="dokumen_ktp" accept=".jpg,.jpeg,.png,.pdf" onchange="showFileName(this,'fname_ktp')" required>
                    <div class="file-icon"><i class="bi bi-cloud-upload"></i></div>
                    <div class="file-label">Klik atau drag file ke sini</div>
                    <div class="file-hint">JPG, PNG, atau PDF. Maks 10MB.</div>
                    <div class="file-name" id="fname_ktp"></div>
                </div>
                @error('dokumen_ktp')<div class="invalid-feedback" style="display:flex"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
            <div class="col-md-6">
                <label class="form-label-custom">Foto/Scan Kartu Keluarga <span class="req">*</span></label>
                <div class="file-wrap">
                    <input type="file" name="dokumen_kk" accept=".jpg,.jpeg,.png,.pdf" onchange="showFileName(this,'fname_kk')" required>
                    <div class="file-icon"><i class="bi bi-cloud-upload"></i></div>
                    <div class="file-label">Klik atau drag file ke sini</div>
                    <div class="file-hint">JPG, PNG, atau PDF. Maks 10MB.</div>
                    <div class="file-name" id="fname_kk"></div>
                </div>
                @error('dokumen_kk')<div class="invalid-feedback" style="display:flex"><i class="bi bi-exclamation-circle"></i> {{ $message }}</div>@enderror
            </div>
            <div class="col-12">
                <label class="form-label-custom">Dokumen Pendukung <span class="opt">(Opsional — maks. {{ $maxPendukung ?? 3 }} file)</span></label>
                <div class="file-wrap">
                    <input type="file" name="dokumen_pendukung[]" id="inputPendukung" accept=".jpg,.jpeg,.png,.pdf" multiple onchange="showMultipleFiles(this)">
                    <div class="file-icon"><i class="bi bi-files"></i></div>
                    <div class="file-label">Klik untuk pilih beberapa file sekaligus</div>
                    <div class="file-hint">JPG, PNG, atau PDF. Maks 10MB per file.</div>
                </div>
                <div class="file-list" id="listPendukung"></div>
                <div class="file-warn" id="warnPendukung" style="display:none"><i class="bi bi-exclamation-triangle-fill"></i><span id="warnPendukungText"></span></div>
            </div>
        </div>
    </div>
</div>
