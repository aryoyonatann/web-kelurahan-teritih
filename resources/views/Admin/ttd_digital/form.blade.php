@extends('Admin.layouts.app')
@section('title', isset($ttd) ? 'Edit TTD Digital' : 'Tambah TTD Digital')

@push('styles')<style>
:root{--primary:#1c64f2;--primary-light:#eff6ff;--gray-50:#f8fafc;--gray-100:#f1f5f9;--gray-200:#e2e8f0;--gray-400:#94a3b8;--gray-700:#334155;--white:#ffffff;--radius-md:12px;--radius-lg:16px;--shadow-sm:0 1px 3px rgba(0,0,0,.08)}
body{background:var(--gray-50);font-family:'Plus Jakarta Sans',sans-serif}
.page{max-width:800px;margin:0 auto;padding:32px 24px 48px}
.back-btn{display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:#64748b;text-decoration:none;padding:6px 12px;border-radius:8px;border:1px solid var(--gray-200);background:#fff;margin-bottom:20px;transition:all .15s}
.back-btn:hover{color:var(--primary);border-color:#bfdbfe;background:var(--primary-light)}
.back-btn svg{width:14px;height:14px}
.card{background:#fff;border:1px solid var(--gray-200);border-radius:var(--radius-lg);padding:28px;box-shadow:var(--shadow-sm)}
.card-title{font-size:17px;font-weight:800;color:#0f172a;margin:0 0 24px;padding-bottom:16px;border-bottom:1px solid var(--gray-100)}
.form-group{margin-bottom:18px}
label{display:block;font-size:12px;font-weight:700;text-transform:uppercase;letter-spacing:.06em;color:#64748b;margin-bottom:7px}
input[type=text],input[type=number]{width:100%;padding:9px 12px;border:1.5px solid var(--gray-200);border-radius:8px;font-size:13.5px;color:#1e293b;font-family:inherit;transition:border-color .2s}
input:focus{outline:none;border-color:var(--primary)}
.tab-row{display:flex;gap:8px;margin-bottom:16px}
.tab-btn{padding:8px 18px;border-radius:8px;border:1.5px solid var(--gray-200);background:#fff;font-size:13px;font-weight:600;color:#64748b;cursor:pointer;transition:all .15s}
.tab-btn.active{background:var(--primary-light);border-color:var(--primary);color:var(--primary)}
#canvas-wrap{border:1.5px solid var(--gray-200);border-radius:10px;overflow:hidden;position:relative}
#ttd-canvas{display:block;cursor:crosshair;touch-action:none}
.canvas-actions{display:flex;gap:8px;margin-top:10px}
.btn-clear{padding:7px 16px;border-radius:7px;border:1.5px solid #fecaca;background:#fef2f2;color:#b91c1c;font-size:12px;font-weight:700;cursor:pointer;font-family:inherit}
#upload-wrap input[type=file]{display:block;width:100%;padding:10px;border:1.5px dashed var(--gray-200);border-radius:8px;font-size:13px;cursor:pointer;background:var(--gray-50)}
#upload-preview{margin-top:12px;max-width:300px;max-height:120px;object-fit:contain;border:1px solid var(--gray-200);border-radius:8px;padding:6px;background:#fafafa;display:none}
.current-ttd{margin-bottom:14px}
.current-ttd img{max-width:200px;max-height:80px;object-fit:contain;border:1px solid var(--gray-200);border-radius:8px;padding:4px;background:#fafafa}
.toggle-row{display:flex;align-items:center;gap:10px}
.toggle{width:44px;height:24px;position:relative;cursor:pointer}
.toggle input{opacity:0;width:0;height:0;position:absolute}
.toggle-track{position:absolute;inset:0;background:#e2e8f0;border-radius:12px;transition:background .2s}
.toggle input:checked + .toggle-track{background:var(--primary)}
.toggle-thumb{position:absolute;top:3px;left:3px;width:18px;height:18px;background:#fff;border-radius:50%;transition:transform .2s;box-shadow:0 1px 3px rgba(0,0,0,.2)}
.toggle input:checked ~ .toggle-thumb{transform:translateX(20px)}
.toggle-label{font-size:13px;font-weight:600;color:#334155}
.error-msg{color:#ef4444;font-size:12px;margin-top:5px}
.btn-submit{display:inline-flex;align-items:center;gap:8px;padding:11px 28px;border-radius:9px;background:var(--primary);color:#fff;font-size:14px;font-weight:700;border:none;cursor:pointer;transition:background .15s;font-family:inherit}
.btn-submit:hover{background:#1a56db}
.btn-submit svg{width:15px;height:15px}
</style>@endpush

@section('content')
@include('Admin.partials.header')

<div class="page">
    <a href="{{ route('admin.ttd.index') }}" class="back-btn">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><polyline points="15 18 9 12 15 6"/></svg>
        Kembali
    </a>

    <div class="card">
        <div class="card-title">{{ isset($ttd) ? '✏️ Edit TTD Digital' : '🖊️ Tambah TTD Digital Baru' }}</div>

        <form action="{{ isset($ttd) ? route('admin.ttd.update', $ttd) : route('admin.ttd.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            @if(isset($ttd)) @method('PUT') @endif

            @if($errors->any())
            <div style="background:#fef2f2;border:1px solid #fecaca;border-radius:8px;padding:12px 16px;margin-bottom:18px;font-size:13px;color:#b91c1c">
                @foreach($errors->all() as $e) <div>• {{ $e }}</div> @endforeach
            </div>
            @endif

            <div class="form-group">
                <label>Nama Pejabat <span style="color:#ef4444">*</span></label>
                <input type="text" name="nama" value="{{ old('nama', $ttd->nama ?? '') }}" placeholder="Contoh: Jupran, SE, MM" required>
            </div>
            <div class="form-group">
                <label>NIP</label>
                <input type="text" name="nip" value="{{ old('nip', $ttd->nip ?? '') }}" placeholder="Contoh: 19700101 199003 1 001">
            </div>
            <div class="form-group">
                <label>Jabatan <span style="color:#ef4444">*</span></label>
                <input type="text" name="jabatan" value="{{ old('jabatan', $ttd->jabatan ?? '') }}" placeholder="Contoh: Kepala Kelurahan Teritih" required>
            </div>

            @if(isset($ttd) && $ttd->ttd_url)
            <div class="current-ttd">
                <label style="margin-bottom:8px">TTD Saat Ini</label>
                <img src="{{ $ttd->ttd_url }}" alt="TTD">
                <div style="font-size:11px;color:#94a3b8;margin-top:4px">Biarkan kosong jika tidak ingin mengubah TTD</div>
            </div>
            @endif

            <div class="form-group">
                <label>Tanda Tangan <span style="color:#ef4444">*</span></label>
                <div class="tab-row">
                    <button type="button" class="tab-btn active" id="tab-canvas" onclick="switchTab('canvas')">✏️ Gambar Langsung</button>
                    <button type="button" class="tab-btn" id="tab-upload" onclick="switchTab('upload')">📁 Upload Gambar</button>
                </div>

                {{-- Canvas --}}
                <div id="canvas-wrap">
                    <canvas id="ttd-canvas" width="700" height="180" style="background:#fff"></canvas>
                    <input type="hidden" name="ttd_canvas_data" id="ttd_canvas_data">
                </div>
                <div class="canvas-actions" id="canvas-actions">
                    <button type="button" class="btn-clear" onclick="clearCanvas()">🗑 Hapus / Ulangi</button>
                    <span style="font-size:12px;color:#94a3b8;align-self:center">Gambar tanda tangan di area putih di atas</span>
                </div>

                {{-- Upload --}}
                <div id="upload-wrap" style="display:none">
                    <input type="file" name="ttd_file" id="ttd_file" accept="image/*" onchange="previewUpload(this)">
                    <img id="upload-preview" alt="Preview">
                </div>
            </div>

            @if(isset($ttd))
            <div class="form-group">
                <label>Status</label>
                <label class="toggle-row">
                    <label class="toggle">
                        <input type="checkbox" name="is_aktif" value="1" {{ ($ttd->is_aktif ?? 1) ? 'checked' : '' }}>
                        <div class="toggle-track"></div>
                        <div class="toggle-thumb"></div>
                    </label>
                    <span class="toggle-label">TTD Aktif (bisa dipilih saat kirim WA)</span>
                </label>
            </div>
            @endif

            <div style="margin-top:24px;padding-top:20px;border-top:1px solid var(--gray-100)">
                <button type="submit" class="btn-submit" onclick="return saveCanvas()">
                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><path d="M19 21H5a2 2 0 01-2-2V5a2 2 0 012-2h11l5 5v11a2 2 0 01-2 2z"/><polyline points="17 21 17 13 7 13 7 21"/><polyline points="7 3 7 8 15 8"/></svg>
                    {{ isset($ttd) ? 'Simpan Perubahan' : 'Simpan TTD Digital' }}
                </button>
            </div>
        </form>
    </div>
</div>

<script>
// ── Tab switch ──────────────────────────────────────────────
let activeTab = 'canvas';
function switchTab(tab) {
    activeTab = tab;
    document.getElementById('canvas-wrap').style.display    = tab === 'canvas' ? '' : 'none';
    document.getElementById('canvas-actions').style.display = tab === 'canvas' ? '' : 'none';
    document.getElementById('upload-wrap').style.display    = tab === 'upload' ? '' : 'none';
    document.getElementById('tab-canvas').className = 'tab-btn' + (tab === 'canvas' ? ' active' : '');
    document.getElementById('tab-upload').className = 'tab-btn' + (tab === 'upload' ? ' active' : '');
    if (tab === 'upload') document.getElementById('ttd_canvas_data').value = '';
}

// ── Canvas drawing ───────────────────────────────────────────
const canvas  = document.getElementById('ttd-canvas');
const ctx     = canvas.getContext('2d');
let drawing   = false, lastX = 0, lastY = 0;

function getPos(e) {
    const r = canvas.getBoundingClientRect();
    const src = e.touches ? e.touches[0] : e;
    return { x: src.clientX - r.left, y: src.clientY - r.top };
}
canvas.addEventListener('mousedown',  e => { drawing = true; const p = getPos(e); lastX = p.x; lastY = p.y; });
canvas.addEventListener('mousemove',  e => { if (!drawing) return; const p = getPos(e); draw(lastX, lastY, p.x, p.y); lastX = p.x; lastY = p.y; });
canvas.addEventListener('mouseup',    () => drawing = false);
canvas.addEventListener('mouseleave', () => drawing = false);
canvas.addEventListener('touchstart', e => { e.preventDefault(); drawing = true; const p = getPos(e); lastX = p.x; lastY = p.y; });
canvas.addEventListener('touchmove',  e => { e.preventDefault(); if (!drawing) return; const p = getPos(e); draw(lastX, lastY, p.x, p.y); lastX = p.x; lastY = p.y; });
canvas.addEventListener('touchend',   () => drawing = false);

function draw(x1, y1, x2, y2) {
    ctx.beginPath(); ctx.moveTo(x1, y1); ctx.lineTo(x2, y2);
    ctx.strokeStyle = '#1e293b'; ctx.lineWidth = 2.5; ctx.lineCap = 'round';
    ctx.stroke();
}
function clearCanvas() { ctx.clearRect(0, 0, canvas.width, canvas.height); document.getElementById('ttd_canvas_data').value = ''; }
function isCanvasBlank() {
    const d = ctx.getImageData(0,0,canvas.width,canvas.height).data;
    return !d.some(ch => ch !== 0);
}
function saveCanvas() {
    if (activeTab === 'canvas') {
        if (isCanvasBlank()) {
            @if(!isset($ttd) || !$ttd->ttd_url)
            alert('Gambar tanda tangan terlebih dahulu atau pilih tab Upload!');
            return false;
            @endif
        } else {
            document.getElementById('ttd_canvas_data').value = canvas.toDataURL('image/png');
        }
    }
    return true;
}

// ── Upload preview ───────────────────────────────────────────
function previewUpload(input) {
    const file = input.files[0];
    if (!file) return;
    const reader = new FileReader();
    reader.onload = e => {
        const img = document.getElementById('upload-preview');
        img.src = e.target.result; img.style.display = 'block';
    };
    reader.readAsDataURL(file);
}
</script>

@include('Admin.partials.footer')
@endsection
