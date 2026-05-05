<style>
/* =====================================================
   NAVBAR USER — authenticated masyarakat
===================================================== */
.main-nav {
    background: #0d1b3e;
    border-bottom: 1px solid #1e3a5f;
    padding: 0 32px; height: 72px;
    display: flex; align-items: center; justify-content: space-between;
    position: sticky; top: 0; z-index: 1000;
    box-shadow: 0 2px 12px rgba(0,0,0,.25); flex-shrink: 0;
}
.nav-brand { display: flex; align-items: center; gap: 10px; text-decoration: none; }
.nav-brand-icon {
    width: 40px; height: 40px;
    background: linear-gradient(135deg, #1c64f2, #1e3a5f);
    border-radius: 10px; display: flex; align-items: center; justify-content: center;
    color: white; font-size: 20px; flex-shrink: 0;
}
.nav-brand-text { display: flex; flex-direction: column; line-height: 1.15; }
.nav-brand-sub  { font-size: 11px; font-weight: 700; letter-spacing: .12em; color: rgba(255,255,255,.6); text-transform: uppercase; }
.nav-brand-name { font-size: 18px; font-weight: 800; color: #ffffff; }

.nav-links { display: flex; align-items: center; gap: 4px; list-style: none; margin: 0; padding: 0; }
.nav-links a {
    display: block; padding: 7px 16px; border-radius: 8px;
    font-size: 15px; font-weight: 500; color: rgba(255,255,255,.85);
    text-decoration: none; transition: all .18s;
}
.nav-links a:hover  { background: rgba(255,255,255,.12); color: #ffffff; }
.nav-links a.active { color: #ffffff; font-weight: 700; border-bottom: 2px solid #60a5fa; border-radius: 0; }

.user-chip {
    display: flex; align-items: center; gap: 10px;
    padding: 5px 12px 5px 5px;
    border: 1.5px solid rgba(255,255,255,.25); border-radius: 40px;
    cursor: pointer; transition: all .18s; background: rgba(255,255,255,.1); position: relative;
}
.user-chip:hover { border-color: rgba(255,255,255,.5); background: rgba(255,255,255,.18); }
.user-avatar {
    width: 34px; height: 34px; border-radius: 50%;
    background: linear-gradient(135deg, #1c64f2, #60a5fa);
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 13px; font-weight: 800; flex-shrink: 0; overflow: hidden;
}
.user-avatar img { width: 100%; height: 100%; object-fit: cover; }
.user-info { line-height: 1.2; }
.user-name { font-size: 14px; font-weight: 700; color: #ffffff; }
.user-role { font-size: 11px; font-weight: 600; color: rgba(255,255,255,.65); text-transform: uppercase; letter-spacing: .05em; }
.user-dropdown {
    position: absolute; top: calc(100% + 8px); right: 0;
    background: white; border: 1px solid #e2e8f0;
    border-radius: 12px; box-shadow: 0 8px 24px rgba(0,0,0,.15);
    min-width: 200px; overflow: hidden; display: none; z-index: 200;
}
.user-chip.open .user-dropdown { display: block; }
.dd-item {
    display: flex; align-items: center; gap: 9px;
    padding: 11px 16px; font-size: 14px; font-weight: 500;
    color: #334155; text-decoration: none; transition: background .15s;
    background: none; border: none; width: 100%; cursor: pointer; text-align: left;
}
.dd-item:hover { background: #f1f5f9; color: #0d1b3e; }
.dd-item.danger { color: #ef4444; }
.dd-item.danger:hover { background: #fef2f2; }
.dd-divider { border-top: 1px solid #e2e8f0; margin: 4px 0; }

.nav-hamburger {
    display: none;
    flex-direction: column; justify-content: center; align-items: center;
    width: 40px; height: 40px; border-radius: 10px;
    border: 1.5px solid rgba(255,255,255,.3); background: rgba(255,255,255,.1);
    cursor: pointer; gap: 5px; transition: all .18s; flex-shrink: 0;
}
.nav-hamburger:hover { border-color: rgba(255,255,255,.6); background: rgba(255,255,255,.2); }
.nav-hamburger span {
    display: block; width: 18px; height: 2px;
    background: #ffffff; border-radius: 2px;
    transition: all .25s cubic-bezier(.4,0,.2,1); transform-origin: center;
}
.nav-hamburger.open span:nth-child(1) { transform: translateY(7px) rotate(45deg); }
.nav-hamburger.open span:nth-child(2) { opacity: 0; transform: scaleX(0); }
.nav-hamburger.open span:nth-child(3) { transform: translateY(-7px) rotate(-45deg); }

/* =====================================================
   MOBILE DRAWER
===================================================== */
.mobile-drawer {
    position: fixed; top: 72px; left: 0; right: 0; bottom: 0;
    background: white; z-index: 999;
    transform: translateX(100%);
    transition: transform .3s cubic-bezier(.4,0,.2,1);
    overflow-y: auto; border-top: 1px solid #e2e8f0;
    display: flex; flex-direction: column;
}
.mobile-drawer.open { transform: translateX(0); }

.drawer-user-section {
    padding: 20px 20px 16px;
    background: linear-gradient(135deg, #0d1b3e, #1e3a5f);
    display: flex; align-items: center; gap: 14px; flex-shrink: 0;
}
.drawer-avatar {
    width: 48px; height: 48px; border-radius: 50%;
    background: rgba(255,255,255,.15); border: 2px solid rgba(255,255,255,.3);
    display: flex; align-items: center; justify-content: center;
    color: white; font-size: 18px; font-weight: 800; flex-shrink: 0; overflow: hidden;
}
.drawer-avatar img { width: 100%; height: 100%; object-fit: cover; }
.drawer-user-name { font-size: 15px; font-weight: 700; color: white; }
.drawer-user-role { font-size: 11px; color: rgba(255,255,255,.65); text-transform: uppercase; letter-spacing: .06em; margin-top: 2px; }

.drawer-nav-links { padding: 8px 0; flex: 1; }

/* DEFAULT — icon & teks abu gelap */
.drawer-nav-link {
    display: flex; align-items: center; gap: 12px;
    padding: 15px 20px; font-size: 16px; font-weight: 500;
    color: #334155;
    text-decoration: none; transition: all .15s;
    border-left: 3px solid transparent;
}
.drawer-nav-link i {
    font-size: 19px; width: 24px; text-align: center;
    color: #64748b !important;   /* abu, override Bootstrap Icons */
    transition: color .15s;
}
/* HOVER */
.drawer-nav-link:hover { background: #f8fafc; color: #1c64f2; border-left-color: #1c64f2; }
.drawer-nav-link:hover i { color: #1c64f2 !important; }
/* ACTIVE */
.drawer-nav-link.active { background: #eff6ff; color: #1c64f2; font-weight: 700; border-left-color: #1c64f2; }
.drawer-nav-link.active i { color: #1c64f2 !important; }

.drawer-divider { height: 1px; background: #e2e8f0; margin: 4px 20px; }

/* ACTION LINKS */
.drawer-action-link {
    display: flex; align-items: center; gap: 12px;
    padding: 15px 20px; font-size: 16px; font-weight: 500;
    color: #334155;
    text-decoration: none; transition: all .15s;
    border: none; background: none; width: 100%; cursor: pointer; text-align: left;
}
.drawer-action-link i {
    font-size: 19px; width: 24px; text-align: center;
    color: #64748b !important;
    transition: color .15s;
}
.drawer-action-link:hover { background: #f8fafc; color: #0d1b3e; }
.drawer-action-link:hover i { color: #0d1b3e !important; }
/* DANGER */
.drawer-action-link.danger { color: #ef4444; }
.drawer-action-link.danger i { color: #ef4444 !important; }
.drawer-action-link.danger:hover { background: #fef2f2; color: #dc2626; }
.drawer-action-link.danger:hover i { color: #dc2626 !important; }

/* =====================================================
   LOGOUT POPUP
===================================================== */
.logout-overlay {
    position: fixed; inset: 0; z-index: 9999;
    background: rgba(13, 27, 62, 0.55); backdrop-filter: blur(4px);
    display: flex; align-items: center; justify-content: center; padding: 20px;
    opacity: 0; pointer-events: none; transition: opacity .2s ease;
}
.logout-overlay.show { opacity: 1; pointer-events: all; }
.logout-modal {
    background: white; border-radius: 20px; padding: 32px 28px; max-width: 360px; width: 100%;
    box-shadow: 0 24px 64px rgba(0,0,0,.18);
    transform: scale(.94) translateY(8px);
    transition: transform .25s cubic-bezier(.4,0,.2,1); text-align: center;
}
.logout-overlay.show .logout-modal { transform: scale(1) translateY(0); }
.logout-icon-wrap {
    width: 64px; height: 64px; border-radius: 50%; background: #fef2f2; border: 2px solid #fecaca;
    display: flex; align-items: center; justify-content: center;
    margin: 0 auto 18px; font-size: 28px; color: #ef4444;
}
.logout-title { font-size: 20px; font-weight: 800; color: #0d1b3e; margin-bottom: 8px; }
.logout-desc  { font-size: 15px; color: #64748b; line-height: 1.65; margin-bottom: 24px; }
.logout-actions { display: flex; gap: 10px; }
.btn-logout-cancel {
    flex: 1; padding: 12px; border-radius: 10px; border: 1.5px solid #e2e8f0; background: white;
    font-size: 15px; font-weight: 600; color: #334155; cursor: pointer; transition: all .18s; font-family: inherit;
}
.btn-logout-cancel:hover { border-color: #cbd5e1; background: #f8fafc; }
.btn-logout-confirm {
    flex: 1; padding: 12px; border-radius: 10px; border: none; background: #ef4444; color: white;
    font-size: 15px; font-weight: 700; cursor: pointer; transition: background .18s; font-family: inherit;
}
.btn-logout-confirm:hover { background: #dc2626; }

.drawer-overlay {
    display: none; position: fixed; inset: 0; top: 72px;
    background: rgba(0,0,0,.35); z-index: 998;
}
.drawer-overlay.open { display: block; }

@media (max-width: 991px) {
    .nav-links { display: none; }
    .user-chip { display: none; }
    .nav-hamburger { display: flex; }
    .main-nav { padding: 0 16px; }
}
@media (min-width: 992px) {
    .mobile-drawer  { display: none !important; }
    .drawer-overlay { display: none !important; }
}
</style>

@php
    $user     = Auth::user();
    $fullName = $user->nama ?? $user->name ?? 'User';
    $parts    = explode(' ', $fullName);
    $initials = strtoupper(substr($parts[0], 0, 1)) . strtoupper(substr($parts[1] ?? '', 0, 1));
@endphp

<nav class="main-nav">
    <a href="{{ route('home') }}" class="nav-brand">
        <div class="nav-brand-icon"><i class="bi bi-bank2"></i></div>
        <div class="nav-brand-text">
            <span class="nav-brand-sub">Kota Serang</span>
            <span class="nav-brand-name">Kelurahan Teritih</span>
        </div>
    </a>

    <ul class="nav-links">
        <li><a href="{{ route('home') }}"      class="{{ request()->routeIs('home') ? 'active' : '' }}">Beranda</a></li>
        <li><a href="{{ route('profil') }}"    class="{{ request()->routeIs('profil') ? 'active' : '' }}">Profil</a></li>
        <li><a href="{{ route('layanan') }}"   class="{{ request()->routeIs('layanan') ? 'active' : '' }}">Layanan</a></li>
        <li><a href="{{ route('informasi') }}" class="{{ request()->routeIs('informasi', 'informasi.berita') ? 'active' : '' }}">Informasi</a></li>
    </ul>

    <div class="user-chip" id="userChipNav">
        <div class="user-avatar">
            @if($user->foto ?? null)
                <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $fullName }}">
            @else
                {{ $initials }}
            @endif
        </div>
        <div class="user-info">
            <div class="user-name">{{ $fullName }}</div>
            <div class="user-role">Masyarakat</div>
        </div>
        <i class="bi bi-chevron-down ms-1" style="font-size:11px;color:#64748b"></i>
        <div class="user-dropdown">
            <a href="{{ route('profile.edit') }}" class="dd-item"><i class="bi bi-person-circle"></i> Profil Saya</a>
            <a href="{{ route('user.permohonan.index') }}" class="dd-item"><i class="bi bi-file-earmark-text"></i> Permohonan Saya</a>
            <div class="dd-divider"></div>
            <button type="button" class="dd-item danger" onclick="showLogoutConfirm()"><i class="bi bi-box-arrow-right"></i> Keluar</button>
        </div>
    </div>

    <button class="nav-hamburger" id="navHamburger" aria-label="Menu">
        <span></span><span></span><span></span>
    </button>
</nav>

<div class="drawer-overlay" id="drawerOverlay"></div>

<div class="mobile-drawer" id="mobileDrawer">
    <div class="drawer-user-section">
        <div class="drawer-avatar">
            @if($user->foto ?? null)
                <img src="{{ asset('storage/' . $user->foto) }}" alt="{{ $fullName }}">
            @else
                {{ $initials }}
            @endif
        </div>
        <div>
            <div class="drawer-user-name">{{ $fullName }}</div>
            <div class="drawer-user-role">Masyarakat</div>
        </div>
    </div>

    <div class="drawer-nav-links">
        <a href="{{ route('home') }}"      class="drawer-nav-link {{ request()->routeIs('home') ? 'active' : '' }}"><i class="bi bi-house-fill"></i> Beranda</a>
        <a href="{{ route('profil') }}"    class="drawer-nav-link {{ request()->routeIs('profil') ? 'active' : '' }}"><i class="bi bi-building"></i> Profil</a>
        <a href="{{ route('layanan') }}"   class="drawer-nav-link {{ request()->routeIs('layanan') ? 'active' : '' }}"><i class="bi bi-file-earmark-text"></i> Layanan</a>
        <a href="{{ route('informasi') }}" class="drawer-nav-link {{ request()->routeIs('informasi', 'informasi.berita') ? 'active' : '' }}"><i class="bi bi-newspaper"></i> Informasi</a>

        <div class="drawer-divider"></div>
        <a href="{{ route('profile.edit') }}"          class="drawer-action-link"><i class="bi bi-person-circle"></i> Profil Saya</a>
        <a href="{{ route('user.permohonan.index') }}" class="drawer-action-link"><i class="bi bi-file-earmark-check"></i> Permohonan Saya</a>
        <div class="drawer-divider"></div>
        <button type="button" class="drawer-action-link danger" onclick="showLogoutConfirm(); closeDrawer();">
            <i class="bi bi-box-arrow-right"></i> Keluar
        </button>
    </div>
</div>

<div class="logout-overlay" id="logoutOverlay">
    <div class="logout-modal">
        <div class="logout-icon-wrap"><i class="bi bi-box-arrow-right"></i></div>
        <div class="logout-title">Yakin ingin keluar?</div>
        <div class="logout-desc">Sesi Anda akan diakhiri. Anda perlu login kembali untuk mengakses layanan.</div>
        <div class="logout-actions">
            <button class="btn-logout-cancel" onclick="hideLogoutConfirm()">Batal</button>
            <button class="btn-logout-confirm" onclick="doLogout()">Ya, Keluar</button>
        </div>
    </div>
</div>

<form id="logoutForm" method="POST" action="{{ route('logout') }}" style="display:none">@csrf</form>

<script>
(function() {
    const chip = document.getElementById('userChipNav');
    if (chip) {
        chip.addEventListener('click', function(e) { e.stopPropagation(); this.classList.toggle('open'); });
        document.addEventListener('click', function() { chip && chip.classList.remove('open'); });
    }
    const hamburger = document.getElementById('navHamburger');
    const drawer    = document.getElementById('mobileDrawer');
    const overlay   = document.getElementById('drawerOverlay');
    function openDrawer() { hamburger.classList.add('open'); drawer.classList.add('open'); overlay.classList.add('open'); document.body.style.overflow='hidden'; }
    window.closeDrawer = function() { hamburger.classList.remove('open'); drawer.classList.remove('open'); overlay.classList.remove('open'); document.body.style.overflow=''; }
    hamburger && hamburger.addEventListener('click', function() { this.classList.contains('open') ? closeDrawer() : openDrawer(); });
    overlay && overlay.addEventListener('click', closeDrawer);
    window.showLogoutConfirm = function() { document.getElementById('logoutOverlay').classList.add('show'); }
    window.hideLogoutConfirm = function() { document.getElementById('logoutOverlay').classList.remove('show'); }
    window.doLogout = function() { document.getElementById('logoutForm').submit(); }
    document.getElementById('logoutOverlay').addEventListener('click', function(e) { if (e.target===this) hideLogoutConfirm(); });
    document.addEventListener('keydown', function(e) { if (e.key==='Escape') hideLogoutConfirm(); });
})();
</script>