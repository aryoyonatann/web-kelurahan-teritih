<!-- PENGAJUAN UNTUK SIAPA -->
<div class="card-section">
    <div class="card-section-head">
        <div class="card-section-head-icon" style="background:var(--blue-lt);color:var(--blue)"><i class="bi bi-person-check-fill"></i></div>
        <div class="card-section-title">Pengajuan Untuk Siapa?</div>
    </div>
    <div class="card-section-body">
        <div class="row g-3 mb-0">
            <div class="col-md-6">
                <label class="form-label-custom">Jenis Pengajuan</label>
                <select name="jenis_pengajuan" class="form-select" onchange="togglePengajuan(this.value)">
                    <option value="sendiri">Untuk Diri Sendiri</option>
                    <option value="orang_lain">Mewakili Orang Lain</option>
                </select>
            </div>
            <div class="col-md-6 d-flex align-items-end">
                <button type="button" class="btn-isi-sendiri" onclick="isiDataSendiri()" id="btnIsiSendiri">
                    <i class="bi bi-person-fill"></i> Isi Otomatis dari Akun Saya
                </button>
            </div>
        </div>
        <div id="infoOrangLain" style="display:none;margin-top:14px" class="alert-info-box">
            <i class="bi bi-info-circle-fill" style="flex-shrink:0;margin-top:2px"></i>
            <span>Anda mengajukan sebagai <strong>perwakilan</strong>. Isi data diri orang yang akan dibuatkan surat.</span>
        </div>
    </div>
</div>
