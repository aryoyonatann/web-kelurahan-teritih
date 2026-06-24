<style>
:root{--blue:#1c64f2;--blue-dk:#1a56db;--blue-lt:#eff6ff;--navy:#0d1b3e;--slate:#334155;--muted:#64748b;--border:#e2e8f0;--bg:#f1f5f9;--green:#10b981;--red:#ef4444}
*,*::before,*::after{box-sizing:border-box}
body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:14px;line-height:1.6;min-height:100vh;display:flex;flex-direction:column}
.form-page{max-width:860px;margin:0 auto;padding:28px 20px 60px;flex:1}
.form-hero{background:linear-gradient(135deg,var(--navy) 0%,#1e3a5f 55%,#1e4d8c 100%);border-radius:16px;padding:28px 32px;margin-bottom:28px;position:relative;overflow:hidden}
.form-hero::before{content:'';position:absolute;right:-40px;top:-40px;width:200px;height:200px;border-radius:50%;border:40px solid rgba(255,255,255,.06)}
.form-hero-badge{display:inline-flex;align-items:center;gap:6px;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);border-radius:20px;padding:4px 12px;font-size:11px;font-weight:700;color:rgba(255,255,255,.9);margin-bottom:10px}
.form-hero-title{font-size:22px;font-weight:800;color:white;margin:0 0 6px;position:relative;z-index:1}
.form-hero-sub{font-size:13px;color:rgba(255,255,255,.75);margin:0;position:relative;z-index:1}
.back-btn{display:inline-flex;align-items:center;gap:6px;font-size:13px;font-weight:600;color:var(--muted);text-decoration:none;padding:7px 14px;border-radius:9px;border:1px solid var(--border);background:white;margin-bottom:20px;transition:all .15s}
.back-btn:hover{color:var(--blue);border-color:#bfdbfe;background:#eff6ff}
.card-section{background:white;border:1px solid var(--border);border-radius:16px;margin-bottom:20px;overflow:hidden}
.card-section-head{padding:14px 20px;border-bottom:1px solid var(--border);background:#f8fafc;display:flex;align-items:center;gap:10px}
.card-section-head-icon{width:34px;height:34px;border-radius:9px;display:flex;align-items:center;justify-content:center;font-size:15px;flex-shrink:0}
.card-section-title{font-size:13.5px;font-weight:700;color:var(--navy)}
.card-section-body{padding:20px}
.form-label-custom{font-size:11.5px;font-weight:700;text-transform:uppercase;letter-spacing:.07em;color:#374151;margin-bottom:6px;display:block}
.form-label-custom .req{color:var(--red);margin-left:2px}
.form-label-custom .opt{color:#94a3b8;font-weight:600;margin-left:4px;text-transform:none;letter-spacing:0}
.form-control,.form-select{font-family:'Plus Jakarta Sans',sans-serif;font-size:13.5px;border:1.5px solid var(--border);border-radius:9px;padding:10px 14px;color:var(--navy);transition:all .15s;width:100%}
.form-control:focus,.form-select:focus{border-color:var(--blue);box-shadow:0 0 0 3px rgba(28,100,242,.1);outline:none}
.form-control.is-invalid,.form-select.is-invalid{border-color:var(--red)}
.invalid-feedback{font-size:12px;color:var(--red);margin-top:4px;display:flex;align-items:center;gap:4px}
.btn-isi-sendiri{display:inline-flex;align-items:center;gap:6px;padding:8px 16px;border-radius:8px;font-size:12px;font-weight:700;background:var(--blue-lt);color:var(--blue);border:1.5px solid #bfdbfe;cursor:pointer;transition:all .15s;font-family:inherit}
.btn-isi-sendiri:hover{background:#dbeafe}
.btn-submit{display:flex;align-items:center;justify-content:center;gap:8px;width:100%;padding:14px;border-radius:12px;font-size:15px;font-weight:700;background:linear-gradient(135deg,var(--navy),var(--blue));color:white;border:none;cursor:pointer;transition:all .18s;font-family:inherit;margin-top:8px}
.btn-submit:hover{opacity:.9;transform:translateY(-1px)}
.alert-info-box{background:var(--blue-lt);border:1.5px solid #bfdbfe;border-radius:10px;padding:12px 16px;font-size:13px;color:#1e40af;display:flex;align-items:flex-start;gap:10px;margin-bottom:16px}
.alert-error-box{background:#fef2f2;border:1.5px solid #fecaca;border-radius:10px;padding:12px 16px;margin-bottom:20px;font-size:13px;color:#991b1b}
.file-wrap{border:2px dashed var(--border);border-radius:10px;padding:16px;text-align:center;cursor:pointer;transition:all .2s;position:relative}
.file-wrap:hover{border-color:var(--blue);background:#eff6ff}
.file-wrap input{position:absolute;inset:0;opacity:0;cursor:pointer;width:100%;height:100%}
.file-icon{font-size:26px;color:#94a3b8;margin-bottom:6px}
.file-label{font-size:12px;font-weight:600;color:var(--muted)}
.file-hint{font-size:11px;color:#94a3b8;margin-top:3px}
.file-name{font-size:12px;font-weight:600;color:var(--blue);margin-top:6px;display:none}
.file-list{margin-top:10px;display:flex;flex-direction:column;gap:6px}
.file-list-item{display:flex;align-items:center;gap:8px;padding:8px 12px;background:#eff6ff;border:1px solid #bfdbfe;border-radius:8px;font-size:12px;color:#1e40af}
.file-list-item i{flex-shrink:0;color:#1c64f2}
.file-list-item .fn{flex:1;font-weight:600;overflow:hidden;text-overflow:ellipsis;white-space:nowrap}
.file-list-item .fs{color:#64748b;font-weight:500;font-size:11px;flex-shrink:0}
.file-warn{margin-top:8px;padding:8px 12px;background:#fef3c7;border:1px solid #fde68a;border-radius:8px;font-size:11px;color:#92400e;display:flex;align-items:center;gap:6px}
</style>
