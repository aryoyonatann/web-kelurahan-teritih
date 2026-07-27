/**
 * admin-ui.js
 * Utility functions untuk modal alert dan konfirmasi di panel admin.
 * Di-load oleh Admin/layouts/app.blade.php — tersedia global di semua halaman admin.
 */

/**
 * Tampilkan modal alert (hanya tombol OK).
 * @param {string} message  - Pesan yang ditampilkan
 * @param {'warning'|'error'|'success'|'info'} type - Jenis alert
 */
window.showAlert = function(message, type = 'warning') {
    const existing = document.getElementById('customAlertOverlay');
    if (existing) existing.remove();

    const icons  = { warning: '⚠️', error: '❌', success: '✅', info: 'ℹ️' };
    const colors = { warning: '#f59e0b', error: '#ef4444', success: '#10b981', info: '#1c64f2' };

    const overlay = document.createElement('div');
    overlay.id = 'customAlertOverlay';
    overlay.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,.4);display:flex;align-items:center;justify-content:center;z-index:99999';
    overlay.innerHTML = `
        <div style="background:white;border-radius:16px;padding:28px 32px;max-width:400px;width:90%;text-align:center;box-shadow:0 20px 60px rgba(0,0,0,.2)">
            <div style="font-size:40px;margin-bottom:12px">${icons[type] ?? icons.warning}</div>
            <p style="font-size:15px;font-weight:600;color:#0f172a;margin:0 0 20px;line-height:1.5">${message}</p>
            <button id="customAlertOk" style="padding:10px 32px;border-radius:10px;border:none;background:${colors[type] ?? colors.warning};color:white;font-size:14px;font-weight:700;cursor:pointer;font-family:inherit">
                Mengerti
            </button>
        </div>`;

    document.body.appendChild(overlay);

    const close = () => overlay.remove();
    overlay.querySelector('#customAlertOk').addEventListener('click', close);
    overlay.addEventListener('click', e => { if (e.target === overlay) close(); });
    document.addEventListener('keydown', function esc(e) {
        if (e.key === 'Escape') { close(); document.removeEventListener('keydown', esc); }
    });
};

/**
 * Tampilkan modal konfirmasi (tombol Ya + Batal).
 * @param {string}   message      - Pesan konfirmasi
 * @param {Function} onConfirm    - Callback dipanggil saat user klik Ya
 * @param {object}   options
 * @param {string}   options.confirmText - Label tombol konfirmasi (default: 'Ya, Lanjutkan')
 * @param {string}   options.cancelText  - Label tombol batal (default: 'Batal')
 * @param {'warning'|'danger'|'success'|'info'} options.type - Jenis konfirmasi
 */
window.showConfirm = function(message, onConfirm, { confirmText = 'Ya, Lanjutkan', cancelText = 'Batal', type = 'warning' } = {}) {
    const existing = document.getElementById('customConfirmOverlay');
    if (existing) existing.remove();

    const cfg = {
        warning: { icon: '⚠️', color: '#f59e0b', bg: '#fffbeb' },
        danger:  { icon: '🗑️', color: '#ef4444', bg: '#fef2f2' },
        success: { icon: '✅', color: '#10b981', bg: '#ecfdf5' },
        info:    { icon: 'ℹ️',  color: '#1c64f2', bg: '#eff6ff' },
    };
    const c = cfg[type] ?? cfg.warning;

    const overlay = document.createElement('div');
    overlay.id = 'customConfirmOverlay';
    overlay.style.cssText = 'position:fixed;inset:0;background:rgba(0,0,0,.45);display:flex;align-items:center;justify-content:center;z-index:99999;padding:16px';
    overlay.innerHTML = `
        <div style="background:white;border-radius:18px;padding:0;max-width:380px;width:100%;box-shadow:0 24px 64px rgba(0,0,0,.2);overflow:hidden">
            <div style="background:${c.bg};padding:24px 28px 20px;text-align:center;border-bottom:1px solid ${c.color}22">
                <div style="font-size:38px;margin-bottom:8px">${c.icon}</div>
                <p style="font-size:15px;font-weight:600;color:#0f172a;margin:0;line-height:1.6">${message}</p>
            </div>
            <div style="display:flex;gap:10px;padding:16px 20px">
                <button id="customConfirmCancel" style="flex:1;padding:10px;border-radius:10px;border:1.5px solid #e2e8f0;background:white;font-size:13px;font-weight:600;color:#64748b;cursor:pointer;font-family:inherit">${cancelText}</button>
                <button id="customConfirmOk"     style="flex:1;padding:10px;border-radius:10px;border:none;background:${c.color};color:white;font-size:13px;font-weight:700;cursor:pointer;font-family:inherit">${confirmText}</button>
            </div>
        </div>`;

    document.body.appendChild(overlay);

    const close = () => overlay.remove();
    overlay.querySelector('#customConfirmOk').addEventListener('click', () => { close(); onConfirm(); });
    overlay.querySelector('#customConfirmCancel').addEventListener('click', close);
    overlay.addEventListener('click', e => { if (e.target === overlay) close(); });
    document.addEventListener('keydown', function esc(e) {
        if (e.key === 'Escape') { close(); document.removeEventListener('keydown', esc); }
    });
};
