@once
@push('styles')
<style>
/* =========================================================
   HEADER
========================================================= */
.app-header {
    position: sticky; top: 0; z-index: 1030;
    background: #fff; border-bottom: 1px solid #e2e8f0;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 24px; height: 62px; gap: 20px;
}
.header-brand { display: flex; align-items: center; gap: 10px; flex-shrink: 0; }
.brand-logo {
    width: 36px; height: 36px; background: #1c64f2;
    border-radius: 8px; display: flex; align-items: center; justify-content: center;
    color: white; font-size: 17px;
}
.brand-text  { display: flex; flex-direction: column; line-height: 1.2; }
.brand-top   { font-size: 9px; font-weight: 700; letter-spacing: .1em; color: #64748b; text-transform: uppercase; }
.brand-name  { font-size: 14px; font-weight: 700; color: #0f172a; }
.header-nav  { display: flex; gap: 4px; flex: 1; justify-content: center; }
.nav-pill {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 6px 14px; border-radius: 8px;
    font-size: 13px; font-weight: 500;
    color: #334155; text-decoration: none; transition: all .18s;
}
.nav-pill:hover  { background: #f1f5f9; color: #1c64f2; }
.nav-pill.active { background: #eff6ff; color: #1c64f2; font-weight: 600; }
.hdr-icon-btn {
    width: 36px; height: 36px; background: none;
    border: 1px solid #e2e8f0; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; color: #334155; transition: all .18s; padding: 0;
    position: relative;
}
.hdr-icon-btn:hover { background: #f1f5f9; color: #1c64f2; }
.logout-btn:hover   { background: #fef2f2; color: #ef4444; border-color: #fecaca; }
.hdr-badge {
    position: absolute; top: -5px; right: -5px;
    background: #ef4444; color: white;
    font-size: 9px; font-weight: 700;
    border-radius: 10px; min-width: 16px; height: 16px;
    padding: 0 4px; line-height: 16px; text-align: center;
    display: none;
}
.hdr-badge.show { display: block; }
.admin-chip {
    display: flex; align-items: center; gap: 8px;
    padding: 4px 10px; border-radius: 10px; background: #f1f5f9; cursor: pointer;
}
.admin-avatar {
    width: 30px; height: 30px;
    background: linear-gradient(135deg, #1c64f2, #60a5fa);
    border-radius: 8px; color: white; font-weight: 700; font-size: 13px;
    display: flex; align-items: center; justify-content: center;
}
.admin-uname { font-size: 12px; font-weight: 600; color: #0f172a; line-height: 1.2; }
.admin-role  { font-size: 10px; color: #64748b; line-height: 1.2; }

/* =========================================================
   NOTIFIKASI DROPDOWN
========================================================= */
.notif-wrap { position: relative; }
.notif-dropdown {
    position: fixed; z-index: 2000;
    background: white; border: 1px solid #e2e8f0;
    border-radius: 14px;
    box-shadow: 0 12px 40px rgba(0,0,0,.14);
    width: 360px; display: none; overflow: hidden;
}
.notif-dropdown.show { display: block; }
.notif-dd-header {
    display: flex; align-items: center; justify-content: space-between;
    padding: 14px 16px 10px; border-bottom: 1px solid #e2e8f0;
}
.notif-dd-title { font-size: 14px; font-weight: 700; color: #0f172a; display: flex; align-items: center; gap: 7px; }
.notif-dd-title i { color: #1c64f2; }
.notif-count-pill { font-size:11px; font-weight:600; background:#eff6ff; color:#1c64f2; border-radius:20px; padding:2px 8px; }
.btn-mark-read { font-size: 11px; color: #1c64f2; font-weight: 600; background: none; border: none; cursor: pointer; padding: 0; }
.btn-mark-read:hover { text-decoration: underline; }
.notif-list { max-height: 340px; overflow-y: auto; }
.notif-dd-item {
    display: flex; gap: 11px; align-items: flex-start;
    padding: 12px 16px; border-bottom: 1px solid #f1f5f9;
    text-decoration: none; color: inherit; transition: background .15s;
}
.notif-dd-item:hover { background: #f8fafc; }
.notif-dd-item.unread { background: #eff6ff; }
.notif-dd-item.unread:hover { background: #dbeafe; }
.notif-dd-icon {
    width: 34px; height: 34px; border-radius: 9px;
    display: flex; align-items: center; justify-content: center;
    font-size: 15px; flex-shrink: 0;
}
.notif-icon-blue   { background: #eff6ff; color: #1c64f2; }
.notif-icon-orange { background: #fffbeb; color: #f59e0b; }
.notif-icon-green  { background: #ecfdf5; color: #10b981; }
.notif-dd-body { flex: 1; min-width: 0; }
.notif-dd-msg  { font-size: 12px; color: #334155; line-height: 1.5; font-weight: 500; }
.notif-dd-time { font-size: 11px; color: #94a3b8; margin-top: 3px; display: flex; align-items: center; gap: 4px; }
.notif-empty { padding: 32px 16px; text-align: center; font-size: 13px; color: #94a3b8; }
.notif-empty i { font-size: 28px; display: block; margin-bottom: 8px; color: #e2e8f0; }
.notif-dd-footer { padding: 10px 16px; border-top: 1px solid #e2e8f0; text-align: center; }
.notif-dd-footer a { font-size: 12px; font-weight: 600; color: #1c64f2; text-decoration: none; }
.notif-dd-footer a:hover { text-decoration: underline; }
@keyframes pulse-red { 0%,100%{transform:scale(1)}50%{transform:scale(1.25)} }
.hdr-badge.pulse { animation: pulse-red .5s ease 4; }
</style>
@endpush
@endonce

<header class="app-header shadow-sm">
    <div class="header-brand">
        <div class="brand-logo"><i class="bi bi-geo-alt-fill"></i></div>
        <div class="brand-text">
            <span class="brand-top">ADMIN PORTAL</span>
            <span class="brand-name">Kelurahan Teritih</span>
        </div>
    </div>

    <nav class="header-nav d-none d-md-flex">
        <a href="{{ route('admin.dashboard') }}"
           class="nav-pill {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
            <i class="bi bi-speedometer2"></i> Dashboard
        </a>
        <a href="{{ route('jenis-surat.index') }}"
           class="nav-pill {{ request()->routeIs('jenis-surat.*') ? 'active' : '' }}">
            <i class="bi bi-file-earmark-text"></i> Jenis Surat
        </a>
        <a href="{{ route('permohonan.index') }}"
           class="nav-pill {{ request()->routeIs('permohonan.*') ? 'active' : '' }}">
            <i class="bi bi-envelope-open"></i> Permohonan
        </a>
        <a href="{{ route('informasi-admin.index') }}"
           class="nav-pill {{ request()->routeIs('informasi-admin.*') ? 'active' : '' }}">
            <i class="bi bi-newspaper"></i> Berita
        </a>
        <a href="{{ route('kependudukan.index') }}"
           class="nav-pill {{ request()->routeIs('kependudukan.*') ? 'active' : '' }}">
            <i class="bi bi-people"></i> Kependudukan
        </a>
        <a href="{{ route('admin.statistik.edit') }}"
           class="nav-pill {{ request()->routeIs('admin.statistik.*') ? 'active' : '' }}">
            <i class="bi bi-bar-chart-fill"></i> Statistik
        </a>
    </nav>

    <div class="d-flex align-items-center gap-2">

        {{-- Notifikasi Bell --}}
        <div class="notif-wrap">
            <button class="hdr-icon-btn" id="btn-notif" title="Notifikasi">
                <i class="bi bi-bell fs-5"></i>
                <span class="hdr-badge" id="notif-badge"></span>
            </button>

            <div class="notif-dropdown" id="notif-dropdown">
                <div class="notif-dd-header">
                    <div class="notif-dd-title">
                        <i class="bi bi-bell-fill"></i> Notifikasi
                        <span class="notif-count-pill" id="notif-count-pill" style="display:none"></span>
                    </div>
                    <button class="btn-mark-read" id="btn-mark-read">Tandai dibaca</button>
                </div>
                <div class="notif-list" id="notif-list">
                    <div class="notif-empty"><i class="bi bi-arrow-clockwise"></i>Memuat...</div>
                </div>
                <div class="notif-dd-footer">
                    <a href="{{ route('permohonan.index') }}">Lihat semua permohonan →</a>
                </div>
            </div>
        </div>

        <div class="admin-chip">
            <div class="admin-avatar">
                {{ strtoupper(substr(auth('admin')->user()->nama_admin ?? 'A', 0, 1)) }}
            </div>
            <div class="d-none d-lg-block">
                <div class="admin-uname">{{ auth('admin')->user()->nama_admin ?? 'Administrator' }}</div>
                <div class="admin-role">Administrator Kelurahan</div>
            </div>
            <i class="bi bi-chevron-down text-muted" style="font-size:11px"></i>
        </div>

        <form action="{{ route('admin.logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="hdr-icon-btn logout-btn" title="Keluar">
                <i class="bi bi-box-arrow-right fs-5"></i>
            </button>
        </form>
    </div>
</header>

@once
@push('scripts')
<script>
(function () {
    const POLL_MS  = 30000;
    const API_URL  = '{{ route("admin.notifikasi") }}';
    const MARK_URL = '{{ route("admin.notifikasi.read") }}';
    const CSRF     = document.querySelector('meta[name="csrf-token"]')?.content || '{{ csrf_token() }}';

    let prevCount    = -1;
    let isRead       = false;
    let dropdownOpen = false;

    const btnNotif  = document.getElementById('btn-notif');
    const badge     = document.getElementById('notif-badge');
    const dropdown  = document.getElementById('notif-dropdown');
    const list      = document.getElementById('notif-list');
    const countPill = document.getElementById('notif-count-pill');
    const btnRead   = document.getElementById('btn-mark-read');

    // Toggle dropdown
    btnNotif.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownOpen = !dropdownOpen;
        positionDropdown();
        dropdown.classList.toggle('show', dropdownOpen);
        if (dropdownOpen) { markRead(); }
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('.notif-wrap')) {
            dropdownOpen = false;
            dropdown.classList.remove('show');
        }
    });

    window.addEventListener('scroll', () => { if (dropdownOpen) positionDropdown(); }, true);
    window.addEventListener('resize', () => { if (dropdownOpen) positionDropdown(); });

    function positionDropdown() {
        const r = btnNotif.getBoundingClientRect();
        dropdown.style.top  = (r.bottom + 8) + 'px';
        dropdown.style.left = Math.max(8, r.right - 360) + 'px';
    }

    btnRead.addEventListener('click', markRead);

    function markRead() {
        isRead = true;
        badge.classList.remove('show');
        countPill.style.display = 'none';
        list.querySelectorAll('.notif-dd-item.unread').forEach(el => el.classList.remove('unread'));
        fetch(MARK_URL, {
            method: 'POST',
            headers: { 'X-CSRF-TOKEN': CSRF, 'Content-Type': 'application/json' }
        }).catch(() => {});
    }

    function setBadge(count) {
        if (count > 0 && !isRead) {
            badge.textContent = count > 99 ? '99+' : count;
            badge.classList.add('show');
            countPill.textContent = count + ' baru';
            countPill.style.display = '';
        } else {
            badge.classList.remove('show');
            countPill.style.display = 'none';
        }
    }

    function escHtml(s) {
        return String(s).replace(/[&<>"]/g, c => ({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
    }

    function renderList(items) {
        if (!items.length) {
            list.innerHTML = '<div class="notif-empty"><i class="bi bi-bell-slash"></i>Tidak ada notifikasi baru</div>';
            return;
        }
        list.innerHTML = items.map(n => `
            <a href="${escHtml(n.url)}" class="notif-dd-item unread">
                <div class="notif-dd-icon notif-icon-${escHtml(n.color)}">
                    <i class="bi bi-${escHtml(n.icon)}"></i>
                </div>
                <div class="notif-dd-body">
                    <div class="notif-dd-msg">${escHtml(n.message)}</div>
                    <div class="notif-dd-time"><i class="bi bi-clock" style="font-size:10px"></i>${escHtml(n.time)}</div>
                </div>
            </a>`).join('');
    }

    function fetchNotif() {
        fetch(API_URL, { headers: { 'Accept': 'application/json' } })
            .then(r => r.json())
            .then(data => {
                const count = data.count || 0;
                // Ada notif baru → bunyikan pulse
                if (prevCount !== -1 && count > prevCount) {
                    isRead = false;
                    badge.classList.remove('pulse');
                    void badge.offsetWidth; // reflow
                    badge.classList.add('pulse');
                    setTimeout(() => badge.classList.remove('pulse'), 2500);
                }
                prevCount = count;
                renderList(data.items || []);
                setBadge(count);
            })
            .catch(() => {});
    }

    fetchNotif();
    setInterval(fetchNotif, POLL_MS);
})();
</script>
@endpush
@endonce