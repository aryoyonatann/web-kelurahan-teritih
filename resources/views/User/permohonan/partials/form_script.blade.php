<script>
const MAX_PENDUKUNG = {{ $maxPendukung ?? 3 }};
const userData = {
    nama: '{{ Auth::user()->nama ?? "" }}',
    nik: '{{ Auth::user()->nik ?? "" }}',
    tempat_lahir: '{{ Auth::user()->tempat_lahir ?? "" }}',
    tanggal_lahir: '{{ Auth::user()->tanggal_lahir ? Auth::user()->tanggal_lahir->format("Y-m-d") : "" }}',
    alamat: '{{ addslashes(Auth::user()->alamat ?? "") }}',
};

function isiDataSendiri() {
    document.getElementById('namaPemohon').value = userData.nama;
    document.getElementById('nikPemohon').value = userData.nik;
    if (document.getElementById('tempatLahir')) document.getElementById('tempatLahir').value = userData.tempat_lahir;
    if (document.getElementById('tanggalLahir')) document.getElementById('tanggalLahir').value = userData.tanggal_lahir;
    document.getElementById('alamatPemohon').value = userData.alamat;
}

function togglePengajuan(val) {
    document.getElementById('infoOrangLain').style.display = val === 'orang_lain' ? 'flex' : 'none';
    document.getElementById('btnIsiSendiri').style.display = val === 'orang_lain' ? 'none' : 'inline-flex';
}

function showFileName(input, id) {
    const el = document.getElementById(id);
    if (input.files && input.files[0]) { el.textContent = '✓ ' + input.files[0].name; el.style.display = 'block'; }
}

function showMultipleFiles(input) {
    const list = document.getElementById('listPendukung');
    const warn = document.getElementById('warnPendukung');
    const warnText = document.getElementById('warnPendukungText');
    list.innerHTML = ''; warn.style.display = 'none';
    if (!input.files || input.files.length === 0) return;
    const files = Array.from(input.files);
    const problems = [];
    if (files.length > MAX_PENDUKUNG) problems.push(`Hanya ${MAX_PENDUKUNG} file pertama yang akan diunggah.`);
    files.slice(0, MAX_PENDUKUNG).forEach(file => {
        const sizeMB = file.size / (1024*1024);
        if (sizeMB > 10) problems.push(`"${file.name}" melebihi 10MB.`);
        const item = document.createElement('div');
        item.className = 'file-list-item';
        item.innerHTML = `<i class="bi bi-file-earmark-check-fill"></i><span class="fn">${file.name}</span><span class="fs">${sizeMB < 1 ? (file.size/1024).toFixed(1)+' KB' : sizeMB.toFixed(1)+' MB'}</span>`;
        list.appendChild(item);
    });
    if (problems.length) { warnText.textContent = problems.join(' '); warn.style.display = 'flex'; }
}
</script>
