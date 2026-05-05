@once
@push('styles')
<style>
/* =========================================================
   HEADER
========================================================= */
.app-header {
    position: sticky; top: 0; z-index: 1030;
    background: #0d1b3e; border-bottom: 1px solid #1e3a5f;
    display: flex; align-items: center; justify-content: space-between;
    padding: 0 16px; height: 58px; gap: 12px;
}
@media(min-width:768px){ .app-header{ padding:0 24px; height:66px; } }

.header-brand { display:flex; align-items:center; gap:10px; flex-shrink:0; text-decoration:none; }
.brand-logo {
    width:34px; height:34px; background:#1c64f2;
    border-radius:8px; display:flex; align-items:center; justify-content:center;
    color:white; font-size:16px; flex-shrink:0;
}
.brand-text  { display:flex; flex-direction:column; line-height:1.2; }
.brand-top   { font-size: 10px; font-weight: 700; letter-spacing:.1em; color: rgba(255,255,255,.6); text-transform:uppercase; }
.brand-name  { font-size: 14px; font-weight: 700; color: #ffffff; }

/* Desktop nav */
.header-nav { display:flex; gap:4px; flex:1; justify-content:center; }
.nav-pill {
    display:inline-flex; align-items:center; gap:6px;
    padding:7px 14px; border-radius:8px;
    font-size:14px; font-weight:500;
    color: rgba(255,255,255,.8); text-decoration:none; transition:all .18s; white-space:nowrap;
}
.nav-pill:hover  { background: rgba(255,255,255,.12); color:#ffffff; }
.nav-pill.active { background: rgba(28,100,242,.4); color:#ffffff; font-weight:600; }

/* Right icons */
.hdr-icon-btn {
    width:36px; height:36px; background: rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.2); border-radius:8px;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; color: rgba(255,255,255,.8); transition:all .18s; padding:0; position:relative;
}
.hdr-icon-btn:hover { background: rgba(255,255,255,.18); color:#ffffff; border-color: rgba(255,255,255,.4); }

.hdr-badge {
    position:absolute; top:-5px; right:-5px;
    background:#ef4444; color:white;
    font-size:9px; font-weight:700;
    border-radius:10px; min-width:16px; height:16px;
    padding:0 4px; line-height:16px; text-align:center; display:none;
}
.hdr-badge.show { display:block; }

/* =========================================================
   ADMIN CHIP — selalu dark, tidak berubah saat mobile
========================================================= */
.admin-wrap { position:relative; }

.admin-chip {
    display:flex; align-items:center; gap:8px;
    padding:5px 10px 5px 6px; border-radius:10px;
    background: rgba(255,255,255,.1);
    border: 1px solid rgba(255,255,255,.18);
    cursor:pointer; transition:background .18s; user-select:none;
}
.admin-chip:hover { background: rgba(255,255,255,.18); border-color: rgba(255,255,255,.3); }

.admin-avatar {
    width:30px; height:30px;
    background:linear-gradient(135deg,#1c64f2,#60a5fa);
    border-radius:7px; color:white; font-weight:700; font-size:13px;
    display:flex; align-items:center; justify-content:center; flex-shrink:0;
}
.admin-uname { font-size:13px; font-weight:600; color:#ffffff; line-height:1.2; }
.admin-role  { font-size:11px; color: rgba(255,255,255,.6); line-height:1.2; }

/* Admin Dropdown */
.admin-dropdown {
    display:none; position:absolute; top:calc(100% + 8px); right:0;
    background:white; border:1px solid #e2e8f0;
    border-radius:12px; box-shadow:0 8px 28px rgba(0,0,0,.15);
    min-width:210px; overflow:hidden; z-index:2000;
}
.admin-dropdown.show { display:block; }
.admin-dd-info {
    display:flex; align-items:center; gap:10px;
    padding:14px 16px; background:#f8fafc;
}
.admin-dd-divider { height:1px; background:#e2e8f0; }
.admin-dd-item {
    display:flex; align-items:center; gap:8px;
    padding:10px 16px; font-size:13px; font-weight:500;
    color:#334155; text-decoration:none; cursor:pointer;
    background:none; border:none; width:100%; text-align:left;
    transition:background .15s; font-family:inherit;
}
.admin-dd-item:hover { background:#f8fafc; }
.admin-dd-logout { color:#ef4444; }
.admin-dd-logout:hover { background:#fef2f2; }

/* =========================================================
   NOTIFIKASI DROPDOWN
========================================================= */
.notif-wrap { position:relative; }
.notif-dropdown {
    position:fixed; z-index:2000;
    background:white; border:1px solid #e2e8f0;
    border-radius:14px; box-shadow:0 12px 40px rgba(0,0,0,.14);
    width:320px; display:none; overflow:hidden;
}
@media(min-width:400px){ .notif-dropdown{ width:360px; } }
.notif-dropdown.show { display:block; }
.notif-dd-header {
    display:flex; align-items:center; justify-content:space-between;
    padding:14px 16px 10px; border-bottom:1px solid #e2e8f0;
}
.notif-dd-title { font-size:14px; font-weight:700; color:#0f172a; display:flex; align-items:center; gap:7px; }
.notif-dd-title i { color:#1c64f2; }
.notif-count-pill { font-size:11px; font-weight:600; background:#eff6ff; color:#1c64f2; border-radius:20px; padding:2px 8px; }
.btn-mark-read { font-size:11px; color:#1c64f2; font-weight:600; background:none; border:none; cursor:pointer; padding:0; }
.btn-mark-read:hover { text-decoration:underline; }
.notif-list { max-height:320px; overflow-y:auto; }
.notif-dd-item {
    display:flex; gap:11px; align-items:flex-start;
    padding:12px 16px; border-bottom:1px solid #f1f5f9;
    text-decoration:none; color:inherit; transition:background .15s;
}
.notif-dd-item:hover { background:#f8fafc; }
.notif-dd-item.unread { background:#eff6ff; }
.notif-dd-item.unread:hover { background:#dbeafe; }
.notif-dd-icon { width:34px; height:34px; border-radius:9px; display:flex; align-items:center; justify-content:center; font-size:15px; flex-shrink:0; }
.notif-icon-blue   { background:#eff6ff; color:#1c64f2; }
.notif-icon-orange { background:#fffbeb; color:#f59e0b; }
.notif-icon-green  { background:#ecfdf5; color:#10b981; }
.notif-dd-body { flex:1; min-width:0; }
.notif-dd-msg  { font-size:12px; color:#334155; line-height:1.5; font-weight:500; }
.notif-dd-time { font-size:11px; color:#94a3b8; margin-top:3px; display:flex; align-items:center; gap:4px; }
.notif-empty { padding:32px 16px; text-align:center; font-size:13px; color:#94a3b8; }
.notif-empty i { font-size:28px; display:block; margin-bottom:8px; color:#e2e8f0; }
.notif-dd-footer { padding:10px 16px; border-top:1px solid #e2e8f0; text-align:center; }
.notif-dd-footer a { font-size:12px; font-weight:600; color:#1c64f2; text-decoration:none; }
.notif-dd-footer a:hover { text-decoration:underline; }
@keyframes pulse-red { 0%,100%{transform:scale(1)} 50%{transform:scale(1.25)} }
.hdr-badge.pulse { animation:pulse-red .5s ease 4; }

/* =========================================================
   LOGOUT MODAL
========================================================= */
.logout-modal-overlay{position:fixed;inset:0;z-index:9999;background:rgba(15,23,42,.45);backdrop-filter:blur(3px);display:flex;align-items:center;justify-content:center;opacity:0;pointer-events:none;transition:opacity .2s}
.logout-modal-overlay.show{opacity:1;pointer-events:all}
.logout-modal{background:white;border-radius:16px;padding:28px 28px 24px;width:100%;max-width:380px;margin:16px;box-shadow:0 20px 60px rgba(0,0,0,.18);transform:translateY(20px) scale(.97);transition:transform .22s}
.logout-modal-overlay.show .logout-modal{transform:translateY(0) scale(1)}
.logout-modal-icon{width:56px;height:56px;border-radius:14px;background:#fef2f2;color:#ef4444;display:flex;align-items:center;justify-content:center;font-size:26px;margin:0 auto 16px}
.logout-modal-title{font-size:17px;font-weight:800;color:#0f172a;text-align:center;margin-bottom:8px}
.logout-modal-desc{font-size:13px;color:#64748b;text-align:center;line-height:1.6;margin-bottom:22px}
.logout-modal-actions{display:flex;gap:10px}
.btn-logout-cancel{flex:1;padding:10px;border-radius:9px;border:1.5px solid #e2e8f0;background:white;font-size:13px;font-weight:600;color:#334155;cursor:pointer;transition:all .15s;font-family:inherit}
.btn-logout-cancel:hover{background:#f8fafc;border-color:#cbd5e1}
.btn-logout-confirm{flex:1;padding:10px;border-radius:9px;border:none;background:#ef4444;font-size:13px;font-weight:700;color:white;cursor:pointer;transition:background .15s;font-family:inherit;display:flex;align-items:center;justify-content:center;gap:6px}
.btn-logout-confirm:hover{background:#dc2626}

/* =========================================================
   HAMBURGER & MOBILE MENU
========================================================= */
.btn-hamburger {
    width:34px; height:34px;
    background: rgba(255,255,255,.08);
    border:1px solid rgba(255,255,255,.2); border-radius:8px;
    display:flex; align-items:center; justify-content:center;
    cursor:pointer; color: rgba(255,255,255,.85); transition:all .18s; padding:0;
}
.btn-hamburger:hover { background: rgba(255,255,255,.18); color:#ffffff; border-color: rgba(255,255,255,.4); }

.mobile-menu {
    display:none;
    position:fixed; top:58px; left:0; right:0; z-index:1029;
    background: #0d1b3e;
    border-bottom:1px solid #1e3a5f;
    box-shadow:0 8px 24px rgba(0,0,0,.3);
    padding:10px 12px 14px;
}
.mobile-menu.show { display:block; }

.mobile-menu .nav-pill {
    display:flex; width:100%; padding:10px 14px;
    border-radius:9px; margin-bottom:4px; font-size:14px;
    color: rgba(255,255,255,.8);
}
.mobile-menu .nav-pill:hover  { background: rgba(255,255,255,.1); color:#ffffff; }
.mobile-menu .nav-pill.active { background: rgba(28,100,242,.4); color:#ffffff; }
.mobile-menu .nav-pill:last-child { margin-bottom:0; }

.mobile-menu-overlay {
    display:none; position:fixed; inset:0; z-index:1028;
    background:rgba(0,0,0,.4);
}
.mobile-menu-overlay.show { display:block; }
</style>
@endpush
@endonce

<div class="mobile-menu-overlay" id="mob-overlay"></div>

<header class="app-header shadow-sm">

    {{-- BRAND --}}
    <a href="{{ route('admin.dashboard') }}" class="header-brand">
        <div class="brand-logo" style="background:transparent;padding:2px;">
            <img src="{{ asset('images/logo kota serang.png') }}" alt="Logo Kota Serang"
                 style="width:100%;height:100%;object-fit:contain;border-radius:6px;">
        </div>
        <div class="brand-text">
            <span class="brand-top">ADMIN PORTAL</span>
            <span class="brand-name">Kelurahan Teritih</span>
        </div>
    </a>

    {{-- DESKTOP NAV --}}
    <nav class="header-nav d-none d-lg-flex">
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

    {{-- RIGHT SIDE --}}
    <div class="d-flex align-items-center gap-2">

        {{-- Notifikasi --}}
        <div class="notif-wrap">
            <button class="hdr-icon-btn" id="btn-notif" title="Notifikasi">
                <i class="bi bi-bell" style="font-size:17px"></i>
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

        {{-- Admin Chip --}}
        <div class="admin-wrap" id="admin-wrap">
            <div class="admin-chip" id="btn-admin-chip">
                <div class="admin-avatar">
                    {{ strtoupper(substr(auth('admin')->user()->nama_admin ?? 'A', 0, 1)) }}
                </div>
                <div class="d-none d-md-block">
                    <div class="admin-uname">{{ auth('admin')->user()->nama_admin ?? 'Administrator' }}</div>
                    <div class="admin-role">Administrator Kelurahan</div>
                </div>
                <i class="bi bi-chevron-down d-none d-md-inline" id="admin-chevron"
                   style="font-size:11px;color:rgba(255,255,255,.6);transition:transform .2s"></i>
            </div>

            {{-- Dropdown --}}
            <div class="admin-dropdown" id="admin-dropdown">
                <div class="admin-dd-info">
                    <div class="admin-avatar" style="width:38px;height:38px;font-size:15px;border-radius:10px">
                        {{ strtoupper(substr(auth('admin')->user()->nama_admin ?? 'A', 0, 1)) }}
                    </div>
                    <div>
                        <div style="font-size:13px;font-weight:700;color:#0f172a">
                            {{ auth('admin')->user()->nama_admin ?? 'Administrator' }}
                        </div>
                        <div style="font-size:11px;color:#64748b">Administrator Kelurahan</div>
                    </div>
                </div>
                <div class="admin-dd-divider"></div>
                <form action="{{ route('admin.logout') }}" method="POST" class="m-0" id="form-logout-dropdown">
                    @csrf
                    <button type="button" class="admin-dd-item admin-dd-logout" onclick="showLogoutModal()">
                        <i class="bi bi-box-arrow-right"></i> Keluar
                    </button>
                </form>
            </div>
        </div>

        {{-- Hamburger — hanya tampil di mobile --}}
        <button class="btn-hamburger d-lg-none" id="btn-hamburger" title="Menu">
            <i class="bi bi-list" style="font-size:20px"></i>
        </button>

    </div>
</header>

{{-- LOGOUT MODAL --}}
<div class="logout-modal-overlay" id="logout-modal-overlay">
    <div class="logout-modal">
        <div class="logout-modal-icon"><i class="bi bi-box-arrow-right"></i></div>
        <div class="logout-modal-title">Keluar dari Akun?</div>
        <div class="logout-modal-desc">Anda akan keluar dari sesi admin. Pastikan semua pekerjaan sudah tersimpan sebelum keluar.</div>
        <div class="logout-modal-actions">
            <button class="btn-logout-cancel" onclick="hideLogoutModal()">Batal</button>
            <button class="btn-logout-confirm" onclick="document.getElementById('form-logout').submit()">
                <i class="bi bi-box-arrow-right"></i> Ya, Keluar
            </button>
        </div>
    </div>
</div>

<form action="{{ route('admin.logout') }}" method="POST" id="form-logout" class="d-none">
    @csrf
</form>

{{-- MOBILE MENU --}}
<div class="mobile-menu" id="mobile-menu">
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
</div>

@once
@push('scripts')
<script>
// Logout modal
function showLogoutModal() {
    document.getElementById('admin-dropdown')?.classList.remove('show');
    document.getElementById('mobile-menu')?.classList.remove('show');
    document.getElementById('mob-overlay')?.classList.remove('show');
    document.getElementById('logout-modal-overlay').classList.add('show');
    document.body.style.overflow = 'hidden';
}
function hideLogoutModal() {
    document.getElementById('logout-modal-overlay').classList.remove('show');
    document.body.style.overflow = '';
}
document.getElementById('logout-modal-overlay').addEventListener('click', function(e) {
    if (e.target === this) hideLogoutModal();
});
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') hideLogoutModal();
});

// Admin chip dropdown
(function() {
    const chip     = document.getElementById('btn-admin-chip');
    const dropdown = document.getElementById('admin-dropdown');
    const chevron  = document.getElementById('admin-chevron');

    chip.addEventListener('click', (e) => {
        e.stopPropagation();
        const open = dropdown.classList.toggle('show');
        if (chevron) chevron.style.transform = open ? 'rotate(180deg)' : '';
    });

    document.addEventListener('click', (e) => {
        if (!e.target.closest('#admin-wrap')) {
            dropdown.classList.remove('show');
            if (chevron) chevron.style.transform = '';
        }
    });
})();

// Hamburger toggle
(function() {
    const btn     = document.getElementById('btn-hamburger');
    const menu    = document.getElementById('mobile-menu');
    const overlay = document.getElementById('mob-overlay');

    function closeMenu() {
        menu.classList.remove('show');
        overlay.classList.remove('show');
        btn.innerHTML = '<i class="bi bi-list" style="font-size:20px"></i>';
    }

    btn.addEventListener('click', (e) => {
        e.stopPropagation();
        const open = menu.classList.toggle('show');
        overlay.classList.toggle('show', open);
        btn.innerHTML = open
            ? '<i class="bi bi-x-lg" style="font-size:18px"></i>'
            : '<i class="bi bi-list" style="font-size:20px"></i>';
    });

    overlay.addEventListener('click', closeMenu);
    menu.querySelectorAll('.nav-pill').forEach(a => a.addEventListener('click', closeMenu));
})();

// Notifikasi
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

    btnNotif.addEventListener('click', (e) => {
        e.stopPropagation();
        dropdownOpen = !dropdownOpen;
        positionDropdown();
        dropdown.classList.toggle('show', dropdownOpen);
        if (dropdownOpen) markRead();
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
        const w = Math.min(360, window.innerWidth - 16);
        dropdown.style.top   = (r.bottom + 8) + 'px';
        dropdown.style.width = w + 'px';
        dropdown.style.left  = Math.max(8, r.right - w) + 'px';
    }

    btnRead.addEventListener('click', markRead);

    function markRead() {
        isRead = true;
        badge.classList.remove('show');
        countPill.style.display = 'none';
        list.querySelectorAll('.notif-dd-item.unread').forEach(el => el.classList.remove('unread'));
        fetch(MARK_URL, {
            method:'POST',
            headers:{'X-CSRF-TOKEN':CSRF,'Content-Type':'application/json'}
        }).catch(()=>{});
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
        return String(s).replace(/[&<>"]/g, c=>({'&':'&amp;','<':'&lt;','>':'&gt;','"':'&quot;'}[c]));
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
                    <div class="notif-dd-time"><i class="bi bi-clock" style="font-size:10px"></i> ${escHtml(n.time)}</div>
                </div>
            </a>`).join('');
    }

    function fetchNotif() {
        fetch(API_URL,{headers:{'Accept':'application/json'}})
        .then(r=>r.json())
        .then(data=>{
            const count = data.count || 0;
            if (prevCount !== -1 && count > prevCount) {
                isRead = false;
                badge.classList.remove('pulse');
                void badge.offsetWidth;
                badge.classList.add('pulse');
                setTimeout(()=>badge.classList.remove('pulse'), 2500);
            }
            prevCount = count;
            renderList(data.items || []);
            setBadge(count);
        })
        .catch(()=>{});
    }

    fetchNotif();
    setInterval(fetchNotif, POLL_MS);
})();
</script>
@endpush
@endonce