<style>
.toast-container{position:fixed;top:20px;right:20px;z-index:99999;display:flex;flex-direction:column;gap:10px;pointer-events:none}
.toast-notif{
    display:flex;align-items:flex-start;gap:12px;
    background:white;border-radius:14px;
    padding:14px 16px;min-width:280px;max-width:380px;
    box-shadow:0 8px 32px rgba(0,0,0,.14);
    border-left:4px solid #10b981;
    pointer-events:all;
    animation:toastIn .35s cubic-bezier(.4,0,.2,1) both;
    font-family:'Plus Jakarta Sans',sans-serif;
}
.toast-notif.error{border-left-color:#ef4444}
.toast-notif.warning{border-left-color:#f59e0b}
.toast-icon{
    width:32px;height:32px;border-radius:8px;flex-shrink:0;
    display:flex;align-items:center;justify-content:center;font-size:16px;
    background:#ecfdf5;color:#10b981;
}
.toast-notif.error .toast-icon{background:#fef2f2;color:#ef4444}
.toast-notif.warning .toast-icon{background:#fffbeb;color:#f59e0b}
.toast-body{flex:1;min-width:0}
.toast-title{font-size:13px;font-weight:700;color:#0f172a;margin-bottom:2px}
.toast-msg{font-size:12.5px;color:#475569;line-height:1.5}
.toast-close{background:none;border:none;cursor:pointer;color:#94a3b8;padding:0;font-size:16px;flex-shrink:0;line-height:1;transition:color .15s}
.toast-close:hover{color:#334155}
.toast-progress{height:3px;border-radius:0 0 0 2px;background:#10b981;position:absolute;bottom:0;left:0;animation:toastProg 4s linear forwards}
.toast-notif.error .toast-progress{background:#ef4444}
.toast-notif.warning .toast-progress{background:#f59e0b}
.toast-notif{position:relative;overflow:hidden}
@keyframes toastIn{from{opacity:0;transform:translateX(60px)}to{opacity:1;transform:translateX(0)}}
@keyframes toastOut{from{opacity:1;transform:translateX(0)}to{opacity:0;transform:translateX(60px)}}
@keyframes toastProg{from{width:100%}to{width:0%}}
</style>

<div class="toast-container" id="toastContainer"></div>

<script>
function showToast(message, type = 'success', title = null) {
    const container = document.getElementById('toastContainer');
    const icons = { success: 'bi-check-circle-fill', error: 'bi-x-circle-fill', warning: 'bi-exclamation-circle-fill' };
    const titles = { success: 'Berhasil', error: 'Gagal', warning: 'Perhatian' };

    const el = document.createElement('div');
    el.className = 'toast-notif ' + type;
    el.innerHTML = `
        <div class="toast-icon"><i class="bi ${icons[type]}"></i></div>
        <div class="toast-body">
            <div class="toast-title">${title || titles[type]}</div>
            <div class="toast-msg">${message}</div>
        </div>
        <button class="toast-close" onclick="dismissToast(this.parentElement)">&times;</button>
        <div class="toast-progress"></div>`;

    container.appendChild(el);
    setTimeout(() => dismissToast(el), 4500);
}

function dismissToast(el) {
    if (!el || !el.parentElement) return;
    el.style.animation = 'toastOut .3s ease forwards';
    setTimeout(() => el.remove(), 300);
}

// Auto-show dari session Laravel
@if(session('success'))
    document.addEventListener('DOMContentLoaded', () => showToast(@json(session('success')), 'success'));
@endif
@if(session('error'))
    document.addEventListener('DOMContentLoaded', () => showToast(@json(session('error')), 'error'));
@endif
@if(session('warning'))
    document.addEventListener('DOMContentLoaded', () => showToast(@json(session('warning')), 'warning'));
@endif
</script>
