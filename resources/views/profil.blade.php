<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Profil Kelurahan – Kelurahan Teritih</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo kota serang.png') }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
    :root {
        --blue:#1c64f2; --blue-dk:#1a56db; --blue-lt:#eff6ff;
        --navy:#0d1b3e; --navy2:#1e3a5f; --slate:#334155;
        --muted:#64748b; --border:#e2e8f0; --bg:#f1f5f9;
        --green:#10b981; --orange:#f59e0b; --red:#ef4444;
        --pink:#ec4899; --pink-lt:#fdf2f8; --pink-dk:#be185d;
        --line:#94a3b8;
        --fs-base: 17px; --fs-sm: 15px; --fs-xs: 13px;
        --fs-lg: 20px; --fs-xl: 24px; --fs-2xl: 32px; --fs-3xl: 42px;
    }
    *,*::before,*::after{box-sizing:border-box}
    body{font-family:'Plus Jakarta Sans',sans-serif;background:var(--bg);color:var(--slate);font-size:var(--fs-base);line-height:1.75;min-height:100vh;display:flex;flex-direction:column}

    /* ── PAGE HEADER ── */
    .page-header{background:white;border-bottom:1px solid var(--border);padding:16px 32px;display:flex;align-items:center;justify-content:space-between}
    .breadcrumb-custom{display:flex;align-items:center;gap:6px;font-size:var(--fs-sm);color:var(--muted);margin:0}
    .breadcrumb-custom a{color:var(--muted);text-decoration:none;transition:color .18s}
    .breadcrumb-custom a:hover{color:var(--blue)}
    .breadcrumb-custom .current{color:var(--navy);font-weight:600}
    .page-title{font-size:var(--fs-xl);font-weight:800;color:var(--navy);margin:0}
    .kelurahan-badge{display:inline-flex;align-items:center;gap:6px;padding:6px 14px;border-radius:20px;font-size:var(--fs-sm);font-weight:700;background:var(--blue-lt);color:var(--blue);border:1px solid #bfdbfe}

    .content-area{flex:1;padding:32px 32px 56px}

    /* ── TENTANG ── */
    .about-section{background:white;border:1px solid var(--border);border-radius:20px;overflow:hidden;margin-bottom:28px}
    .about-hero-img{width:100%;aspect-ratio:16/7;overflow:hidden;position:relative;background:var(--navy);display:flex;align-items:center;justify-content:center;color:rgba(255,255,255,.3);font-size:80px}
    .about-hero-img img{width:100%;height:100%;object-fit:cover;object-position:center}
    .about-hero-caption{position:absolute;bottom:0;left:0;right:0;background:linear-gradient(to top,rgba(10,20,50,.85) 0%,rgba(10,20,50,.45) 55%,transparent 100%);padding:60px 32px 22px;display:flex;align-items:center;gap:10px;color:white;font-size:var(--fs-base);font-weight:700;text-shadow:0 1px 4px rgba(0,0,0,.4)}
    .about-body{padding:36px 40px}
    .about-section-label{font-size:var(--fs-xs);font-weight:700;color:var(--blue);text-transform:uppercase;letter-spacing:.1em;margin-bottom:10px;display:flex;align-items:center;gap:8px}
    .about-section-label::before{content:'';display:block;width:28px;height:3px;background:var(--blue);border-radius:2px}
    .about-title{font-size:var(--fs-2xl);font-weight:800;color:var(--navy);margin-bottom:24px;line-height:1.2}
    .about-text{font-size:var(--fs-base);color:var(--slate);line-height:1.9;margin-bottom:0}
    .about-text p{margin-bottom:20px}
    .about-text p:last-child{margin-bottom:0}
    .about-text strong{color:var(--navy);font-weight:700}

    /* ── SEJARAH TIMELINE ── */
    .sejarah-section{margin-bottom:28px}
    .sejarah-header-card{background:linear-gradient(135deg,var(--blue) 0%,var(--blue-dk) 100%);border-radius:20px;padding:48px 40px;margin-bottom:28px;position:relative;overflow:hidden;color:white}
    .sejarah-header-card::before{content:'';position:absolute;top:-60px;right:-60px;width:200px;height:200px;background:rgba(255,255,255,0.08);border-radius:50%}
    .sejarah-header-card::after{content:'';position:absolute;bottom:-40px;left:-40px;width:150px;height:150px;background:rgba(255,255,255,0.05);border-radius:50%}
    .sejarah-header-content{position:relative;z-index:2}
    .sejarah-header-label{font-size:var(--fs-xs);font-weight:700;text-transform:uppercase;letter-spacing:.12em;margin-bottom:12px;display:flex;align-items:center;gap:8px;opacity:.95}
    .sejarah-header-title{font-size:var(--fs-3xl);font-weight:800;margin-bottom:14px;line-height:1.2}
    .sejarah-header-desc{font-size:var(--fs-base);line-height:1.75;max-width:720px;opacity:.95}
    .timeline-container{position:relative;padding:20px 0}
    .timeline-container::before{content:'';position:absolute;left:50%;top:0;bottom:0;width:3px;background:linear-gradient(180deg,var(--blue) 0%,var(--blue-lt) 100%);transform:translateX(-50%)}
    .timeline-item{margin-bottom:44px;position:relative}
    .timeline-item:last-child{margin-bottom:0}
    .timeline-item:nth-child(odd) .timeline-content{margin-left:0;margin-right:auto;padding-right:52%}
    .timeline-item:nth-child(even) .timeline-content{margin-left:auto;margin-right:0;padding-left:52%}
    .timeline-dot{position:absolute;left:50%;top:0;width:28px;height:28px;background:white;border:4px solid var(--blue);border-radius:50%;transform:translateX(-50%);z-index:10;display:flex;align-items:center;justify-content:center;font-size:14px;color:var(--blue);font-weight:700;box-shadow:0 0 0 4px rgba(28,100,242,.1);transition:all .25s}
    .timeline-item:hover .timeline-dot{width:36px;height:36px;border-width:5px;box-shadow:0 0 0 6px rgba(28,100,242,.15)}
    .timeline-content{background:white;border:1px solid var(--border);border-radius:16px;padding:28px 32px;transition:all .25s}
    .timeline-item:hover .timeline-content{box-shadow:0 6px 24px rgba(28,100,242,.12);border-color:#bfdbfe}
    .timeline-year{font-size:var(--fs-lg);font-weight:800;color:var(--blue);margin-bottom:8px}
    .timeline-title{font-size:var(--fs-lg);font-weight:700;color:var(--navy);margin-bottom:10px;line-height:1.4}
    .timeline-text{font-size:var(--fs-base);color:var(--slate);line-height:1.8;margin:0}

    /* ── VISI MISI ── */
    .visimisi-section{margin-bottom:28px}
    .visi-full-card{background:white;border:1px solid var(--border);border-radius:20px;padding:48px 56px;text-align:center;margin-bottom:16px;position:relative;overflow:hidden}
    .visi-full-card::before{content:'';position:absolute;top:-40px;right:-40px;width:160px;height:160px;border-radius:50%;background:var(--blue-lt);opacity:.5}
    .visi-icon-wrap{width:64px;height:64px;border-radius:50%;background:var(--blue-lt);border:2px solid #bfdbfe;display:flex;align-items:center;justify-content:center;font-size:28px;color:var(--blue);margin:0 auto 18px}
    .visi-label{font-size:var(--fs-xs);font-weight:700;color:var(--blue);text-transform:uppercase;letter-spacing:.12em;margin-bottom:10px}
    .visi-main-title{font-size:var(--fs-3xl);font-weight:800;color:var(--navy);margin-bottom:20px}
    .visi-text{font-size:var(--fs-lg);color:var(--slate);line-height:1.75;font-style:italic;font-weight:500;max-width:760px;margin:0 auto}
    .misi-full-card{background:white;border:1px solid var(--border);border-radius:20px;padding:48px 56px;margin-bottom:16px}
    .misi-card-header{display:flex;align-items:center;gap:16px;margin-bottom:36px}
    .misi-icon-wrap{width:56px;height:56px;border-radius:14px;background:var(--blue-lt);display:flex;align-items:center;justify-content:center;font-size:26px;color:var(--blue);flex-shrink:0}
    .misi-main-title{font-size:var(--fs-3xl);font-weight:800;color:var(--navy);margin:0}
    .misi-grid{display:grid;grid-template-columns:1fr 1fr;gap:16px}
    .misi-item{display:flex;align-items:flex-start;gap:14px;padding:20px 22px;border-radius:14px;background:var(--bg);border:1px solid var(--border);font-size:var(--fs-base);color:var(--slate);line-height:1.7;transition:all .18s}
    .misi-item:hover{background:var(--blue-lt);border-color:#bfdbfe;color:var(--navy)}
    .misi-num{width:34px;height:34px;border-radius:50%;background:var(--blue);color:white;display:flex;align-items:center;justify-content:center;font-size:var(--fs-sm);font-weight:800;flex-shrink:0;margin-top:2px}

    /* ══════════════════════════════════════════════════════════
       BAGAN ORG dengan SVG auto-connector
       JavaScript akan menghitung posisi node lalu menggambar garis
       sebagai SVG polyline. Container relatif, SVG absolut full-cover.
       ══════════════════════════════════════════════════════════ */
    .struktur-section{background:white;border:1px solid var(--border);border-radius:20px;padding:48px 40px;margin-bottom:28px}
    .struktur-section .org-tree-wrap{overflow-x:auto;overflow-y:visible;padding-bottom:8px;margin-left:-8px;margin-right:-8px;padding-left:8px;padding-right:8px}
    .struktur-section .org-tree-wrap::-webkit-scrollbar,
    .pkk-section .pkk-tree-wrap::-webkit-scrollbar{height:8px}
    .struktur-section .org-tree-wrap::-webkit-scrollbar-track,
    .pkk-section .pkk-tree-wrap::-webkit-scrollbar-track{background:#f1f5f9;border-radius:4px}
    .struktur-section .org-tree-wrap::-webkit-scrollbar-thumb,
    .pkk-section .pkk-tree-wrap::-webkit-scrollbar-thumb{background:#cbd5e1;border-radius:4px}
    .struktur-section .org-tree-wrap::-webkit-scrollbar-thumb:hover,
    .pkk-section .pkk-tree-wrap::-webkit-scrollbar-thumb:hover{background:#94a3b8}
    .struktur-label{font-size:var(--fs-xs);font-weight:700;color:var(--blue);letter-spacing:.12em;text-transform:uppercase;text-align:center;margin-bottom:10px}
    .struktur-title{font-size:var(--fs-3xl);font-weight:800;color:var(--navy);text-align:center;margin-bottom:10px}
    .struktur-subtitle{font-size:var(--fs-base);color:var(--muted);text-align:center;margin-bottom:52px}

    /* Container utama bagan — relatif untuk SVG absolute */
    .org-tree{position:relative;width:100%;max-width:1200px;margin:0 auto;min-width:880px}
    .org-tree-svg{
        position:absolute;top:0;left:0;width:100%;height:100%;
        pointer-events:none;z-index:0;
    }
    .org-tree > .org-row{
        position:relative;z-index:1;
        display:flex;justify-content:center;align-items:flex-start;
        gap:36px;
        margin-bottom:48px;
    }
    .org-tree > .org-row:last-child{margin-bottom:0}

    /* Untuk row dengan multi-kolom yang punya sub-tree */
    .org-col{display:flex;flex-direction:column;align-items:center;gap:48px;flex:1;min-width:0}
    .org-col-inner{display:flex;flex-direction:column;align-items:center}
    /* Sub-grup horizontal di dalam kolom (untuk Sanusi-Hawari, Afif-Jamaludin) */
    .org-subgroup{display:flex;gap:18px;justify-content:center;align-items:flex-start}

    /* Spacer fleksibel saat 1 kolom kosong tapi sibling-nya panjang */
    .org-spacer{flex:1;align-self:stretch}

    /* ── NODE ── */
    .org-node{
        background:white;border:2px solid var(--border);border-radius:14px;
        padding:16px 20px 14px;text-align:center;
        min-width:195px;max-width:230px;
        transition:box-shadow .2s, border-color .2s, transform .2s;
        position:relative;flex-shrink:0;
    }
    .org-node:hover{box-shadow:0 8px 24px rgba(28,100,242,.12);border-color:#93c5fd;transform:translateY(-2px)}
    .org-node.lurah{
        border-color:var(--blue);
        background:linear-gradient(145deg,#fff 60%,#eff6ff);
        box-shadow:0 6px 24px rgba(28,100,242,.18);
        min-width:230px;padding:20px 24px 18px;
    }
    .org-node.sekre{border-color:#93c5fd;min-width:220px;padding:18px 22px 16px}
    .org-node.fungsional{
        border-color:#d97706;border-style:dashed;
        background:linear-gradient(145deg,#fff 60%,#fffbeb);
        min-width:175px;padding:14px 18px 12px;
    }
    .org-node.kasi{background:linear-gradient(145deg,#fff 60%,#f8fafc);min-width:205px}
    .org-node.pelaksana{background:#f8fafc;border-color:#e2e8f0;min-width:200px}
    .org-node.operator{background:white;min-width:175px;max-width:195px;padding:14px 16px 12px}

    .org-avatar{
        width:60px;height:60px;border-radius:50%;
        background:var(--bg);border:2px solid var(--border);
        display:flex;align-items:center;justify-content:center;
        font-size:26px;color:var(--muted);
        margin:0 auto 12px;overflow:hidden;
    }
    .org-avatar img{width:100%;height:100%;object-fit:cover;object-position:top}
    .org-node.lurah .org-avatar{background:var(--blue-lt);border-color:#93c5fd;color:var(--blue);width:72px;height:72px;font-size:32px}
    .org-node.sekre .org-avatar{background:#eff6ff;border-color:#bfdbfe;color:var(--blue-dk);width:64px;height:64px;font-size:28px}
    .org-node.fungsional .org-avatar{background:#fffbeb;border-color:#fcd34d;color:#d97706;width:48px;height:48px;font-size:20px}
    .org-node.kasi .org-avatar{background:#f0f9ff;border-color:#bae6fd;color:#0284c7}
    .org-node.pelaksana .org-avatar{background:#f1f5f9;border-color:#cbd5e1;width:54px;height:54px;font-size:22px}
    .org-node.operator .org-avatar{width:48px;height:48px;font-size:20px;margin-bottom:8px}

    .org-nip{font-size:11.5px;color:var(--muted);font-weight:500;margin-top:4px;line-height:1.3}
    .org-name{font-size:15px;font-weight:700;color:var(--navy);line-height:1.35}
    .org-node.lurah .org-name{font-size:17px}
    .org-node.sekre .org-name{font-size:16px}
    .org-node.operator .org-name{font-size:13.5px}
    .org-role-badge{
        display:inline-block;margin-top:8px;padding:4px 11px;
        border-radius:20px;font-size:11px;font-weight:700;
        letter-spacing:.05em;text-transform:uppercase;
    }
    .org-node.lurah .org-role-badge{font-size:12px;padding:4px 13px}
    .org-node.operator .org-role-badge{font-size:10px;padding:3px 9px}
    .badge-lurah{background:var(--blue);color:white}
    .badge-sekre{background:#dbeafe;color:#1e40af}
    .badge-fungsional{background:#fef3c7;color:#92400e}
    .badge-kasi{background:#e0f2fe;color:#075985}
    .badge-pelaksana{background:#f1f5f9;color:#475569}
    .badge-operator{background:#f0fdf4;color:#166534}

    /* ── PKK SECTION ── */
    .pkk-section{background:white;border:1px solid var(--border);border-radius:20px;padding:48px 40px;margin-bottom:28px;position:relative;isolation:isolate}
    .pkk-section .pkk-tree-wrap{overflow-x:auto;overflow-y:visible;padding-bottom:8px;margin-left:-8px;margin-right:-8px;padding-left:8px;padding-right:8px;position:relative;z-index:1}
    .pkk-section::before{content:'';position:absolute;top:-60px;left:-60px;width:200px;height:200px;background:var(--pink-lt);border-radius:50%;opacity:.6;z-index:-1;clip-path:inset(60px 0 0 60px round 0 0 0 0)}
    .pkk-section > *{position:relative;z-index:1}
    .pkk-label{font-size:var(--fs-xs);font-weight:700;color:var(--pink-dk);letter-spacing:.12em;text-transform:uppercase;text-align:center;margin-bottom:10px}
    .pkk-title{font-size:var(--fs-3xl);font-weight:800;color:var(--navy);text-align:center;margin-bottom:10px}
    .pkk-subtitle{font-size:var(--fs-base);color:var(--muted);text-align:center;margin-bottom:44px;max-width:680px;margin-left:auto;margin-right:auto}

    .pkk-tree{position:relative;width:100%;max-width:1100px;margin:0 auto;min-width:820px}
    .pkk-tree-svg{position:absolute;top:0;left:0;width:100%;height:100%;pointer-events:none;z-index:0}
    .pkk-tree > .pkk-row{
        position:relative;z-index:1;
        display:flex;justify-content:center;align-items:flex-start;
        gap:40px;margin-bottom:48px;
    }
    .pkk-tree > .pkk-row:last-child{margin-bottom:0}

    .pkk-node{background:white;border:2px solid var(--border);border-radius:14px;padding:16px 22px;text-align:center;min-width:200px;transition:all .18s}
    .pkk-node.ketua{border-color:var(--pink);box-shadow:0 4px 20px rgba(236,72,153,.15)}
    .pkk-node:hover{box-shadow:0 6px 24px rgba(236,72,153,.12)}
    .pkk-avatar{width:50px;height:50px;border-radius:50%;background:var(--bg);border:2px solid var(--border);display:flex;align-items:center;justify-content:center;font-size:22px;color:var(--muted);margin:0 auto 10px}
    .pkk-avatar.ketua-av{background:var(--pink-lt);border-color:#fbcfe8;color:var(--pink)}
    .pkk-name{font-size:15px;font-weight:700;color:var(--navy);line-height:1.3}
    .pkk-role{font-size:11px;font-weight:700;color:var(--pink);text-transform:uppercase;letter-spacing:.08em;margin-top:4px}
    .pkk-role.sekre{color:var(--muted)}
    .pkk-role.bend{color:var(--orange)}

    .pkk-pembina-box{
        background:#fef3c7;border:2px dashed #d97706;border-radius:12px;
        padding:14px 16px;text-align:center;min-width:170px;align-self:center;
    }
    .pkk-pembina-label{font-size:11px;font-weight:700;color:#92400e;text-transform:uppercase;letter-spacing:.06em;line-height:1.3}
    .pkk-pembina-empty{font-size:11px;font-style:italic;color:#a16207;margin-top:4px}

    /* Pokja card — diperbesar supaya teks lega, tidak wrap */
    .pkk-pokja-card{
        background:white;border:2px solid var(--border);border-radius:14px;
        overflow:hidden;transition:all .18s;
        min-width:175px;width:175px;flex-shrink:0;
    }
    .pkk-pokja-card:hover{box-shadow:0 6px 24px rgba(236,72,153,.12);border-color:#fbcfe8}
    .pkk-pokja-head{background:linear-gradient(135deg,#fef3c7,#fde68a);padding:10px 14px;text-align:center;border-bottom:2px solid #fcd34d}
    .pkk-pokja-head-text{font-size:13px;font-weight:800;color:#92400e;letter-spacing:.05em}
    .pkk-pokja-body{padding:14px 12px;text-align:center}
    .pkk-pokja-member{padding:6px 4px}
    .pkk-pokja-member + .pkk-pokja-member{border-top:1px dashed var(--border);margin-top:6px}
    .pkk-pokja-name{font-size:13px;font-weight:700;color:var(--navy);line-height:1.3;word-break:break-word}
    .pkk-pokja-role{font-size:9.5px;font-weight:700;color:var(--pink);text-transform:uppercase;letter-spacing:.06em;margin-top:2px;white-space:nowrap}
    .pkk-pokja-role.anggota{color:var(--muted)}

    /* ── GALERI STRUKTUR ── */
    .galeri-section{background:white;border:1px solid var(--border);border-radius:20px;padding:48px 40px;margin-bottom:28px}
    .galeri-header{text-align:center;margin-bottom:40px}
    .galeri-label{font-size:var(--fs-xs);font-weight:700;color:var(--blue);letter-spacing:.12em;text-transform:uppercase;margin-bottom:10px}
    .galeri-title{font-size:var(--fs-3xl);font-weight:800;color:var(--navy);margin-bottom:10px}
    .galeri-subtitle{font-size:var(--fs-base);color:var(--muted);max-width:680px;margin:0 auto}
    .galeri-grid{display:flex;flex-direction:column;gap:32px}
    .galeri-item{background:var(--bg);border:1px solid var(--border);border-radius:16px;overflow:hidden;transition:all .25s}
    .galeri-item:hover{box-shadow:0 8px 32px rgba(15,23,42,.08);border-color:#bfdbfe}
    .galeri-item-header{padding:18px 24px;display:flex;align-items:center;gap:12px;background:white;border-bottom:1px solid var(--border)}
    .galeri-item-icon{width:38px;height:38px;border-radius:10px;display:flex;align-items:center;justify-content:center;font-size:18px;flex-shrink:0}
    .galeri-item-info{flex:1;min-width:0}
    .galeri-item-name{font-size:var(--fs-base);font-weight:700;color:var(--navy);line-height:1.3}
    .galeri-item-desc{font-size:var(--fs-xs);color:var(--muted);margin-top:2px}
    .galeri-zoom-hint{font-size:var(--fs-xs);color:var(--muted);display:flex;align-items:center;gap:4px;flex-shrink:0}
    .galeri-img-wrap{position:relative;cursor:zoom-in;overflow:hidden;background:white}
    .galeri-img-wrap img{width:100%;height:auto;display:block;transition:transform .35s ease}
    .galeri-img-wrap:hover img{transform:scale(1.015)}
    .galeri-img-overlay{position:absolute;inset:0;background:rgba(28,100,242,0);display:flex;align-items:center;justify-content:center;transition:background .25s;pointer-events:none}
    .galeri-img-wrap:hover .galeri-img-overlay{background:rgba(28,100,242,.08)}
    .galeri-zoom-btn{position:absolute;top:14px;right:14px;background:rgba(15,23,42,.7);backdrop-filter:blur(8px);color:white;border:none;border-radius:8px;padding:8px 12px;font-size:12px;font-weight:600;display:flex;align-items:center;gap:6px;opacity:0;transition:opacity .25s;pointer-events:none;font-family:inherit}
    .galeri-img-wrap:hover .galeri-zoom-btn{opacity:1}

    /* ── LIGHTBOX ── */
    .lightbox{position:fixed;inset:0;background:rgba(8,15,30,.92);backdrop-filter:blur(8px);z-index:9999;display:none;align-items:center;justify-content:center;padding:20px;opacity:0;transition:opacity .25s}
    .lightbox.show{display:flex;opacity:1}
    .lightbox-content{position:relative;max-width:min(1400px,95vw);max-height:90vh;display:flex;flex-direction:column;align-items:center}
    .lightbox-img{max-width:100%;max-height:82vh;width:auto;height:auto;border-radius:8px;box-shadow:0 20px 60px rgba(0,0,0,.5);background:white}
    .lightbox-caption{margin-top:16px;color:white;text-align:center;font-size:var(--fs-sm);font-weight:600;background:rgba(0,0,0,.4);padding:8px 20px;border-radius:20px;backdrop-filter:blur(4px)}
    .lightbox-close{position:absolute;top:-50px;right:0;background:rgba(255,255,255,.15);border:1px solid rgba(255,255,255,.25);color:white;width:42px;height:42px;border-radius:50%;display:flex;align-items:center;justify-content:center;cursor:pointer;font-size:22px;transition:all .18s;backdrop-filter:blur(8px)}
    .lightbox-close:hover{background:rgba(255,255,255,.25);transform:scale(1.05)}

    /* ── RESPONSIVE ── */
    @media(max-width:991px){
        .page-header{padding:14px 16px;flex-wrap:wrap;gap:8px}
        .content-area{padding:20px 16px 40px}
        .about-body{padding:24px 20px}
        .about-title{font-size:var(--fs-xl)}
        .visi-full-card,.misi-full-card,.struktur-section,.sejarah-header-card,.galeri-section,.pkk-section{padding:32px 20px}
        .visi-main-title,.misi-main-title,.struktur-title,.sejarah-header-title,.galeri-title,.pkk-title{font-size:var(--fs-2xl)}
        .visi-text{font-size:var(--fs-base)}
        .misi-grid{grid-template-columns:1fr}
        .ds-grid{grid-template-columns:repeat(2,1fr) !important}
        .galeri-item-header{padding:14px 16px}
        .lightbox-close{top:-46px;width:38px;height:38px;font-size:20px}
    }
    /* Tablet & mobile: bagan jadi vertikal list, SVG disembunyikan */
    @media(max-width:991px){
        .timeline-container::before{left:0}
        .timeline-item:nth-child(odd) .timeline-content,
        .timeline-item:nth-child(even) .timeline-content{margin-left:0;margin-right:0;padding-left:56px;padding-right:0}
        .timeline-dot{left:0}
        .galeri-zoom-hint{display:none}
        .galeri-zoom-btn{opacity:1;top:10px;right:10px;padding:6px 10px;font-size:11px}

        /* Bagan vertical mode */
        .org-tree-svg, .pkk-tree-svg{display:none}
        .org-tree, .pkk-tree{min-width:0}
        .struktur-section .org-tree-wrap,
        .pkk-section .pkk-tree-wrap{overflow:visible;padding-bottom:0;margin:0;padding-left:0;padding-right:0}
        .org-tree > .org-row, .pkk-tree > .pkk-row{
            flex-direction:column;align-items:center;gap:18px;margin-bottom:18px;
        }
        .org-tree > .org-row::before, .pkk-tree > .pkk-row::before{
            content:'';width:2px;height:18px;background:var(--line);margin:0 auto;
        }
        .org-tree > .org-row:first-child::before, .pkk-tree > .pkk-row:first-child::before{display:none}
        .org-col{gap:18px}
        .org-subgroup{flex-direction:column;align-items:center;gap:18px}
    }
    @media(max-width:768px){
        /* Mobile-specific tweaks; vertikal layout sudah ditangani di 991px */
    }
    @media(max-width:576px){
        .about-hero-img{aspect-ratio:4/3}
        .about-hero-caption{padding:40px 20px 16px;font-size:var(--fs-sm)}
        .ds-grid{grid-template-columns:1fr !important}
        .sejarah-header-card{padding:28px 16px}
        .sejarah-header-title{font-size:var(--fs-2xl)}
    }
    </style>
</head>
<body>

@include('partials.navbar')

<!-- PAGE HEADER -->
<div class="page-header">
    <div>
        <div class="breadcrumb-custom mb-1">
            <a href="{{ route('home') }}">Beranda</a>
            <i class="bi bi-chevron-right" style="font-size:10px"></i>
            <span class="current">Profil Kelurahan</span>
        </div>
        <h1 class="page-title">Profil Kelurahan</h1>
    </div>
    <div class="kelurahan-badge">
        <i class="bi bi-check-circle-fill" style="font-size:13px"></i>
        Kelurahan Teritih
    </div>
</div>

<div class="content-area">

    <!-- ══ TENTANG ══ -->
    <div class="about-section">
        <div class="about-hero-img">
            <picture>
                <source media="(max-width: 768px)" srcset="{{ asset('images/kantor-kelurahan-teritih-md.jpg') }}">
                <img src="{{ asset('images/kantor-kelurahan-teritih.jpg') }}"
                     alt="Kantor Kelurahan Teritih, Kecamatan Walantaka, Kota Serang"
                     loading="eager" fetchpriority="high">
            </picture>
            <div class="about-hero-caption">
                <i class="bi bi-building"></i> Kantor Kelurahan Teritih
            </div>
        </div>
        <div class="about-body">
            <div class="about-section-label">Tentang Kami</div>
            <h2 class="about-title">Kelurahan Teritih, Kota Serang</h2>
            <div class="about-text">
                <p><strong>Kelurahan Teritih</strong> merupakan salah satu kelurahan yang berada di wilayah Kecamatan Walantaka, Kota Serang, Provinsi Banten. Kelurahan ini memiliki peran strategis dalam mendukung perkembangan wilayah Kota Serang bagian timur, baik dari segi pelayanan publik, pembangunan wilayah, maupun pemberdayaan masyarakat.</p>
                <p>Secara administratif dan geografis, Kelurahan Teritih memiliki lokasi yang cukup strategis karena berada tidak jauh dari pusat pemerintahan kecamatan, sehingga memudahkan koordinasi pemerintahan serta akses pelayanan bagi masyarakat. Wilayah Kelurahan Teritih didominasi oleh kawasan permukiman penduduk yang terus berkembang, seiring dengan pertumbuhan jumlah penduduk dan kebutuhan hunian yang semakin meningkat.</p>
                <p>Selain kawasan permukiman, Kelurahan Teritih juga masih memiliki area lahan terbuka dan pertanian yang menjadi bagian penting dalam menjaga keseimbangan lingkungan. Keberadaan ruang terbuka hijau ini memberikan manfaat ekologis sekaligus mendukung aktivitas ekonomi masyarakat, khususnya di sektor pertanian skala kecil dan usaha lokal.</p>
                <p>Dari sisi sosial, masyarakat Kelurahan Teritih dikenal memiliki semangat kebersamaan dan gotong royong yang tinggi. Hal ini tercermin dalam berbagai kegiatan kemasyarakatan seperti kerja bakti lingkungan, kegiatan keagamaan, serta partisipasi aktif dalam program pembangunan yang diselenggarakan oleh pemerintah kelurahan.</p>
                <p>Pemerintah Kelurahan Teritih terus berupaya meningkatkan kualitas pelayanan publik kepada masyarakat, khususnya dalam bidang administrasi kependudukan, pelayanan surat-menyurat, serta berbagai layanan sosial lainnya. Upaya ini dilakukan dengan mengedepankan prinsip pelayanan yang cepat, transparan, dan akuntabel.</p>
                <p>Seiring dengan perkembangan teknologi informasi, Kelurahan Teritih juga mulai mengimplementasikan sistem pelayanan berbasis digital untuk mempermudah masyarakat dalam mengakses layanan tanpa harus datang langsung ke kantor kelurahan. Langkah ini merupakan bagian dari komitmen dalam mendukung program Smart City/Smart Village di Kota Serang.</p>
                <p>Ke depan, Kelurahan Teritih berkomitmen untuk terus melakukan inovasi dalam tata kelola pemerintahan, meningkatkan kualitas sumber daya manusia, serta memperkuat sinergi antara pemerintah dan masyarakat guna mewujudkan lingkungan yang tertib, nyaman, dan sejahtera.</p>
            </div>
        </div>
    </div>

    <!-- ══ DATA SINGKAT ══ -->
    @php
        $ds = $dataSingkat ?? [];
        $dsItems = [
            ['icon'=>'bi-mailbox2','color'=>'#d97706','bg'=>'#fef3c7','label'=>'Kode Pos','value'=>$ds['kode_pos'] ?? '42183','unit'=>''],
            ['icon'=>'bi-map-fill','color'=>'#10b981','bg'=>'#ecfdf5','label'=>'Luas Wilayah','value'=>$ds['luas_wilayah'] ?? '2.54','unit'=>'km²'],
            ['icon'=>'bi-people-fill','color'=>'#1c64f2','bg'=>'#eff6ff','label'=>'Jumlah Penduduk','value'=>$ds['jumlah_penduduk'] ?? '4.520','unit'=>'Jiwa'],
            ['icon'=>'bi-diagram-3-fill','color'=>'#a855f7','bg'=>'#fdf4ff','label'=>'Kecamatan','value'=>$ds['kecamatan'] ?? 'Walantaka','unit'=>''],
            ['icon'=>'bi-geo-alt-fill','color'=>'#f43f5e','bg'=>'#fff1f2','label'=>'Kota','value'=>$ds['kota'] ?? 'Serang','unit'=>''],
            ['icon'=>'bi-globe2','color'=>'#16a34a','bg'=>'#f0fdf4','label'=>'Provinsi','value'=>$ds['provinsi'] ?? 'Banten','unit'=>''],
        ];
    @endphp
    <div style="background:white;border:1px solid var(--border);border-radius:20px;overflow:hidden;margin-bottom:28px">
        <div style="padding:20px 32px;border-bottom:1px solid var(--border);display:flex;align-items:center;gap:12px">
            <div style="width:40px;height:40px;border-radius:10px;background:var(--blue-lt);display:flex;align-items:center;justify-content:center;color:var(--blue);font-size:18px;flex-shrink:0">
                <i class="bi bi-info-circle-fill"></i>
            </div>
            <div>
                <div style="font-size:var(--fs-lg);font-weight:800;color:var(--navy);line-height:1.2">Data Singkat Kelurahan</div>
                <div style="font-size:var(--fs-xs);color:var(--muted);margin-top:2px">Informasi administratif Kelurahan Teritih</div>
            </div>
        </div>
        <div class="ds-grid" style="display:grid;grid-template-columns:repeat({{ count($dsItems) }},1fr)">
            @foreach($dsItems as $i => $item)
            <div style="padding:24px 28px;{{ $i < count($dsItems)-1 ? 'border-right:1px solid var(--border)' : '' }}">
                <div style="display:flex;align-items:center;gap:8px;margin-bottom:10px">
                    <div style="width:32px;height:32px;border-radius:8px;background:{{ $item['bg'] }};display:flex;align-items:center;justify-content:center;color:{{ $item['color'] }};font-size:15px">
                        <i class="bi {{ $item['icon'] }}"></i>
                    </div>
                    <span style="font-size:var(--fs-xs);font-weight:600;color:var(--muted);text-transform:uppercase;letter-spacing:.07em">{{ $item['label'] }}</span>
                </div>
                <div style="font-size:var(--fs-2xl);font-weight:800;color:var(--navy)">
                    {{ $item['value'] }}
                    @if($item['unit'])<span style="font-size:var(--fs-lg)">{{ $item['unit'] }}</span>@endif
                </div>
            </div>
            @endforeach
        </div>
    </div>

    <!-- ══ SEJARAH ══ -->
    <div class="sejarah-section">
        <div class="sejarah-header-card">
            <div class="sejarah-header-content">
                <div class="sejarah-header-label"><i class="bi bi-hourglass-split"></i> Perjalanan Waktu</div>
                <h2 class="sejarah-header-title">Sejarah Terbentuknya Kelurahan Teritih</h2>
                <p class="sejarah-header-desc">Mengenal lebih dekat perjalanan panjang Kelurahan Teritih dari masa awal pembentukan hingga menjadi kelurahan modern yang dinamis dan berprestasi di Kota Serang.</p>
            </div>
        </div>
        <div class="timeline-container">
            <div class="timeline-item"><div class="timeline-dot">1</div><div class="timeline-content"><div class="timeline-year">2012</div><div class="timeline-title">Perubahan Status Desa Menjadi Kelurahan</div><p class="timeline-text">Dengan diundangkannya Peraturan Daerah (Perda) Kota Serang Nomor 8 tahun 2012 tentang Pembentukan dan Perubahan Status 15 (lima belas) Desa Menjadi Kelurahan pada tanggal 17 Oktober 2012, Desa Teritih secara legal formal berubah menjadi Kelurahan Teritih. Sehingga tanggal 17 Oktober dijadikan sebagai hari lahir Kelurahan Teritih.</p></div></div>
            <div class="timeline-item"><div class="timeline-dot">2</div><div class="timeline-content"><div class="timeline-year">Perubahan Tata Kelola</div><div class="timeline-title">Perubahan Sistem Pemerintahan</div><p class="timeline-text">Perubahan status desa menjadi kelurahan ini berimplikasi kepada tata kelola dan nomenklatur pemerintahan Desa Teritih. Sebelum terbitnya Perda Nomor 8 Tahun 2012, Desa Teritih dipimpin oleh Kepala Desa yang berasal dari masyarakat setempat dan dipilih secara langsung oleh masyarakat Desa Teritih.</p></div></div>
            <div class="timeline-item"><div class="timeline-dot">3</div><div class="timeline-content"><div class="timeline-year">Setelah 2012</div><div class="timeline-title">Kepemimpinan oleh Lurah</div><p class="timeline-text">Setelah berubah menjadi Kelurahan Teritih, sistem kepemimpinan juga mengalami perubahan. Kelurahan dipimpin oleh seorang Kepala Kelurahan atau disebut Lurah yang berasal dari Pegawai Negeri Sipil (PNS) di lingkungan Pemerintah Kota Serang yang memenuhi persyaratan dan diangkat langsung oleh Walikota Serang.</p></div></div>
            <div class="timeline-item"><div class="timeline-dot">4</div><div class="timeline-content"><div class="timeline-year">Tujuan Perubahan</div><div class="timeline-title">Peningkatan Pelayanan Masyarakat</div><p class="timeline-text">Semangat dari perubahan status desa menjadi kelurahan ini adalah untuk meningkatkan pelayanan masyarakat, melaksanakan fungsi pemerintahan, serta memperkuat pemberdayaan masyarakat dalam rangka mempercepat terwujudnya kesejahteraan masyarakat.</p></div></div>
        </div>
    </div>

    <!-- ══ VISI MISI ══ -->
    <div class="visimisi-section">
        <div class="visi-full-card">
            <div class="visi-label">Visi</div>
            <div class="visi-icon-wrap"><i class="bi bi-eye-fill"></i></div>
            <h2 class="visi-main-title">Visi Kelurahan Teritih</h2>
            <div class="visi-text">"Terwujudnya Kelurahan Teritih yang Maju, Sejahtera, dan Berkeadaban Melalui Pelayanan Publik yang Prima dan Inovatif."</div>
        </div>
        <div class="misi-full-card">
            <div class="misi-card-header">
                <div class="misi-icon-wrap"><i class="bi bi-flag-fill"></i></div>
                <h2 class="misi-main-title">Misi Kelurahan Teritih</h2>
            </div>
            <div class="misi-grid">
                <div class="misi-item"><div class="misi-num">1</div><span>Meningkatkan kualitas sumber daya manusia yang berakhlak mulia dan berdaya saing tinggi dalam segala bidang kehidupan.</span></div>
                <div class="misi-item"><div class="misi-num">2</div><span>Mewujudkan tata kelola pemerintahan yang bersih, transparan, dan akuntabel demi kepercayaan masyarakat.</span></div>
                <div class="misi-item"><div class="misi-num">3</div><span>Meningkatkan infrastruktur dan sarana prasarana wilayah yang mendukung pertumbuhan perekonomian masyarakat.</span></div>
                <div class="misi-item"><div class="misi-num">4</div><span>Mengembangkan potensi ekonomi lokal berbasis pemberdayaan masyarakat dan kemitraan usaha kecil menengah.</span></div>
                <div class="misi-item"><div class="misi-num">5</div><span>Meningkatkan kualitas pelayanan administrasi kependudukan yang cepat, mudah, dan berbasis teknologi informasi.</span></div>
                <div class="misi-item"><div class="misi-num">6</div><span>Memperkuat kerukunan warga dan semangat gotong royong sebagai modal sosial pembangunan kelurahan.</span></div>
            </div>
        </div>
    </div>

    <!-- ══════════════════════════════════════════════════════════
         STRUKTUR ORGANISASI (SOTK) — SVG auto-connector
         data-node attribute → ID untuk JS gambar garisnya
         ══════════════════════════════════════════════════════════ -->
    <div class="struktur-section">
        <div class="struktur-label">Pemerintahan</div>
        <h2 class="struktur-title">Struktur Organisasi</h2>
        <p class="struktur-subtitle">Bagan susunan organisasi dan tata kerja Pemerintah Kelurahan Teritih, Kecamatan Walantaka, Kota Serang.</p>

        <div class="org-tree-wrap">
        <div class="org-tree" id="orgTree">
            {{-- SVG akan di-inject oleh JS untuk gambar garis --}}
            <svg class="org-tree-svg" id="orgSvg" xmlns="http://www.w3.org/2000/svg"></svg>

            {{-- Row 1: Lurah --}}
            <div class="org-row">
                <div class="org-node lurah" data-node="lurah">
                    <div class="org-avatar">
                        <img src="{{ asset('images/foto-lurah.jpg') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" alt="Lurah">
                        <i class="bi bi-person-fill" style="display:none"></i>
                    </div>
                    <div class="org-name">Jupran, SE, MM</div>
                    <div class="org-nip">NIP. 196808182009061005</div>
                    <span class="org-role-badge badge-lurah">Kepala Kelurahan</span>
                </div>
            </div>

            {{-- Row 2: Sekretaris (langsung di tengah, di bawah Lurah) --}}
            <div class="org-row">
                <div class="org-node sekre" data-node="sekretaris">
                    <div class="org-avatar">
                        <img src="{{ asset('images/foto-sekretaris.jpg') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" alt="Sekretaris">
                        <i class="bi bi-person-fill" style="display:none"></i>
                    </div>
                    <div class="org-name">Maryam, S.ST</div>
                    <div class="org-nip">NIP. 198709232017042001</div>
                    <span class="org-role-badge badge-sekre">Sekretaris Kelurahan</span>
                </div>
            </div>

            {{-- Row 3: 3 Kasi --}}
            <div class="org-row">
                <div class="org-col">
                    <div class="org-node kasi" data-node="kasi-pemum">
                        <div class="org-avatar">
                            <img src="{{ asset('images/foto-kasi-pemum.jpg') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" alt="Kasi Pemum">
                            <i class="bi bi-person-fill" style="display:none"></i>
                        </div>
                        <div class="org-name">Neni Khaeratunnisa,<br>Amd.Kep</div>
                        <div class="org-nip">NIP. 198411122011012002</div>
                        <span class="org-role-badge badge-kasi">Kasi Pemum</span>
                    </div>
                    {{-- Sub: Pelaksana di bawah Kasi Pemum --}}
                    <div class="org-node pelaksana" data-node="pelaksana">
                        <div class="org-avatar">
                            <img src="{{ asset('images/foto-pelaksana.jpg') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" alt="Pelaksana">
                            <i class="bi bi-person-fill" style="display:none"></i>
                        </div>
                        <div class="org-name">Serli Laraswanti, SE</div>
                        <div class="org-nip">NIP. 199812232025062005</div>
                        <span class="org-role-badge badge-pelaksana">Pelaksana Pelayanan Umum</span>
                    </div>
                    {{-- Sub-sub: Sanusi & Hawari di bawah Pelaksana --}}
                    <div class="org-subgroup">
                        <div class="org-node operator" data-node="op-sanusi">
                            <div class="org-avatar"><i class="bi bi-person-fill"></i></div>
                            <div class="org-name">Sanusi</div>
                            <div class="org-nip">NIP. 197908052025211063</div>
                            <span class="org-role-badge badge-operator">Operator Layanan Operasional</span>
                        </div>
                        <div class="org-node operator" data-node="op-hawari">
                            <div class="org-avatar"><i class="bi bi-person-fill"></i></div>
                            <div class="org-name">Hawari</div>
                            <div class="org-nip">NIP. 198210082025211086</div>
                            <span class="org-role-badge badge-operator">Operator Layanan Operasional</span>
                        </div>
                    </div>
                </div>

                <div class="org-col">
                    <div class="org-node kasi" data-node="kasi-pmk">
                        <div class="org-avatar">
                            <img src="{{ asset('images/foto-kasi-pmk.jpg') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" alt="Kasi PMK">
                            <i class="bi bi-person-fill" style="display:none"></i>
                        </div>
                        <div class="org-name">Hafid, Amd.Kep</div>
                        <div class="org-nip">NIP. 198009122009021003</div>
                        <span class="org-role-badge badge-kasi">Kasi PMK</span>
                    </div>
                    {{-- Sub: Hasan Gaus di bawah Kasi PMK --}}
                    <div class="org-node operator" data-node="op-hasan">
                        <div class="org-avatar"><i class="bi bi-person-fill"></i></div>
                        <div class="org-name">Hasan Gaus, SM</div>
                        <div class="org-nip">NIP. 199711262025211052</div>
                        <span class="org-role-badge badge-operator">Penata Layanan Operasional</span>
                    </div>
                </div>

                <div class="org-col">
                    <div class="org-node kasi" data-node="kasi-trantibum">
                        <div class="org-avatar">
                            <img src="{{ asset('images/foto-kasi-trantibum.jpg') }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex'" alt="Kasi Trantibum">
                            <i class="bi bi-person-fill" style="display:none"></i>
                        </div>
                        <div class="org-name">Khuriyah, Amd.Kep</div>
                        <div class="org-nip">NIP. 198409292011012002</div>
                        <span class="org-role-badge badge-kasi">Kasi Trantibum</span>
                    </div>
                    {{-- Sub-sub: Afif & Jamaludin di bawah Kasi Trantibum --}}
                    <div class="org-subgroup">
                        <div class="org-node operator" data-node="op-afif">
                            <div class="org-avatar"><i class="bi bi-person-fill"></i></div>
                            <div class="org-name">Afif</div>
                            <div class="org-nip">NIP. 197808032025211041</div>
                            <span class="org-role-badge badge-operator">Operator Layanan Operasional</span>
                        </div>
                        <div class="org-node operator" data-node="op-jamaludin">
                            <div class="org-avatar"><i class="bi bi-person-fill"></i></div>
                            <div class="org-name">Jamaludin</div>
                            <div class="org-nip">NIP. 197503012025211032</div>
                            <span class="org-role-badge badge-operator">Pengelola Umum Operasional</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>{{-- /org-tree-wrap --}}
    </div>

    <!-- ══════════════════════════════════════════════════════════
         STRUKTUR PKK
         ══════════════════════════════════════════════════════════ -->
    <div class="pkk-section">
        <div class="pkk-label">Organisasi Kemasyarakatan</div>
        <h2 class="pkk-title">Struktur Tim Penggerak PKK</h2>
        <p class="pkk-subtitle">Tim Penggerak Pemberdayaan dan Kesejahteraan Keluarga (TP. PKK) Kelurahan Teritih, Kecamatan Walantaka, Kota Serang.</p>

        <div class="pkk-tree-wrap">
        <div class="pkk-tree" id="pkkTree">
            <svg class="pkk-tree-svg" id="pkkSvg" xmlns="http://www.w3.org/2000/svg"></svg>

            {{-- Row 1: Pembina + Ketua --}}
            <div class="pkk-row">
                <div class="pkk-pembina-box" data-node="pembina">
                    <div class="pkk-pembina-label">Dewan Pembina /<br>Penyantun</div>
                </div>
                <div class="pkk-node ketua" data-node="ketua">
                    <div class="pkk-avatar ketua-av"><i class="bi bi-person-fill"></i></div>
                    <div class="pkk-name">Ny. Martinah</div>
                    <div class="pkk-role">Ketua</div>
                </div>
            </div>

            {{-- Row 2: Wakil Ketua --}}
            <div class="pkk-row">
                <div class="pkk-node" data-node="wakil">
                    <div class="pkk-avatar"><i class="bi bi-person-fill"></i></div>
                    <div class="pkk-name">Maryamah, S.ST</div>
                    <div class="pkk-role">Wakil Ketua</div>
                </div>
            </div>

            {{-- Row 3: Sekretaris + Bendahara --}}
            <div class="pkk-row">
                <div class="pkk-node" data-node="sekretaris-pkk">
                    <div class="pkk-avatar"><i class="bi bi-person-fill"></i></div>
                    <div class="pkk-name">Esih Sukaesih</div>
                    <div class="pkk-role sekre">Sekretaris</div>
                </div>
                <div class="pkk-node" data-node="bendahara">
                    <div class="pkk-avatar"><i class="bi bi-person-fill"></i></div>
                    <div class="pkk-name">Jumenah</div>
                    <div class="pkk-role bend">Bendahara</div>
                </div>
            </div>

            {{-- Row 4: 4 Pokja --}}
            <div class="pkk-row">
                @php
                    $pokjaList = [
                        ['nama'=>'POKJA I',  'ketua'=>'Hadranah', 'anggota'=>'Sundari',  'id'=>'pokja-1'],
                        ['nama'=>'POKJA II', 'ketua'=>'Khusaeni', 'anggota'=>'Khafidoh', 'id'=>'pokja-2'],
                        ['nama'=>'POKJA III','ketua'=>'Rohimah',  'anggota'=>'Halimah',  'id'=>'pokja-3'],
                        ['nama'=>'POKJA IV', 'ketua'=>'Masfuah',  'anggota'=>'Noviyanah','id'=>'pokja-4'],
                    ];
                @endphp
                @foreach($pokjaList as $pj)
                <div class="pkk-pokja-card" data-node="{{ $pj['id'] }}">
                    <div class="pkk-pokja-head">
                        <div class="pkk-pokja-head-text">{{ $pj['nama'] }}</div>
                    </div>
                    <div class="pkk-pokja-body">
                        <div class="pkk-pokja-member">
                            <div class="pkk-pokja-name">{{ $pj['ketua'] }}</div>
                            <div class="pkk-pokja-role">Ketua</div>
                        </div>
                        <div class="pkk-pokja-member">
                            <div class="pkk-pokja-name">{{ $pj['anggota'] }}</div>
                            <div class="pkk-pokja-role anggota">Anggota</div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
        </div>{{-- /pkk-tree-wrap --}}
    </div>

    <!-- ══ GALERI ══ -->
    @php
        $galeri = [
            ['thumb'=>'images/STRUKTUR-KELURAHAN-TERITIH.jpg','full'=>'images/STRUKTUR-KELURAHAN-TERITIH.jpg','name'=>'Struktur Organisasi Lengkap','desc'=>'Susunan pejabat dan staf Kelurahan Teritih beserta jabatannya','icon'=>'bi-diagram-3-fill','color'=>'#1c64f2','bg'=>'#eff6ff'],
            ['thumb'=>'images/STRUKTUR-RT-RW-KEL-TERITIH.jpg','full'=>'images/STRUKTUR-RT-RW-TERITIH.jpg','name'=>'Struktur RT/RW Kelurahan Teritih','desc'=>'Daftar Ketua RT dan RW di seluruh wilayah Kelurahan Teritih','icon'=>'bi-people-fill','color'=>'#a855f7','bg'=>'#fdf4ff'],
        ];
    @endphp
    <div class="galeri-section">
        <div class="galeri-header">
            <div class="galeri-label">Dokumentasi Pemerintahan</div>
            <h2 class="galeri-title">Galeri Struktur</h2>
            <p class="galeri-subtitle">Visualisasi lengkap struktur organisasi dan pengurus RT/RW Kelurahan Teritih. Klik gambar untuk memperbesar.</p>
        </div>
        <div class="galeri-grid">
            @foreach($galeri as $g)
            <div class="galeri-item">
                <div class="galeri-item-header">
                    <div class="galeri-item-icon" style="background:{{ $g['bg'] }};color:{{ $g['color'] }}"><i class="bi {{ $g['icon'] }}"></i></div>
                    <div class="galeri-item-info">
                        <div class="galeri-item-name">{{ $g['name'] }}</div>
                        <div class="galeri-item-desc">{{ $g['desc'] }}</div>
                    </div>
                    <div class="galeri-zoom-hint"><i class="bi bi-zoom-in"></i> Klik untuk perbesar</div>
                </div>
                <div class="galeri-img-wrap"
                     onclick="openLightbox('{{ asset($g['full']) }}', @js($g['name']))"
                     role="button" tabindex="0"
                     onkeydown="if(event.key==='Enter'||event.key===' '){event.preventDefault();openLightbox('{{ asset($g['full']) }}', @js($g['name']))}">
                    <img src="{{ asset($g['thumb']) }}" alt="{{ $g['name'] }}" loading="lazy">
                    <div class="galeri-img-overlay"></div>
                    <button type="button" class="galeri-zoom-btn" tabindex="-1"><i class="bi bi-arrows-fullscreen"></i> Perbesar</button>
                </div>
            </div>
            @endforeach
        </div>
    </div>

</div>

<!-- ══ LIGHTBOX ══ -->
<div class="lightbox" id="lightbox" onclick="closeLightbox(event)" role="dialog" aria-modal="true" aria-label="Pratinjau gambar">
    <div class="lightbox-content" onclick="event.stopPropagation()">
        <button type="button" class="lightbox-close" onclick="closeLightbox()" aria-label="Tutup"><i class="bi bi-x-lg"></i></button>
        <img src="" alt="" class="lightbox-img" id="lightboxImg">
        <div class="lightbox-caption" id="lightboxCaption"></div>
    </div>
</div>

@include('partials.footer')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script>
// ═══════════════════════════════════════════════════════════════
//  LIGHTBOX
// ═══════════════════════════════════════════════════════════════
function openLightbox(src, caption) {
    const box = document.getElementById('lightbox');
    const img = document.getElementById('lightboxImg');
    const cap = document.getElementById('lightboxCaption');
    img.src = src; img.alt = caption; cap.textContent = caption;
    box.classList.add('show');
    document.body.style.overflow = 'hidden';
}
function closeLightbox() {
    const box = document.getElementById('lightbox');
    box.classList.remove('show');
    document.body.style.overflow = '';
    setTimeout(() => { document.getElementById('lightboxImg').src = ''; }, 250);
}
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape' && document.getElementById('lightbox').classList.contains('show')) closeLightbox();
});

// ═══════════════════════════════════════════════════════════════
//  AUTO CONNECTOR — gambar garis penghubung antar node pakai SVG
// ═══════════════════════════════════════════════════════════════
const LINE_COLOR = '#94a3b8';
const LINE_WIDTH = 2;
const VERTICAL_DROP = 18; // jarak vertikal dari node ke garis horizontal

function getCenter(el, containerRect) {
    const r = el.getBoundingClientRect();
    return {
        topX:    r.left + r.width / 2 - containerRect.left,
        topY:    r.top - containerRect.top,
        bottomX: r.left + r.width / 2 - containerRect.left,
        bottomY: r.bottom - containerRect.top,
        leftX:   r.left - containerRect.left,
        rightX:  r.right - containerRect.left,
        midY:    r.top + r.height / 2 - containerRect.top,
    };
}

/**
 * Gambar garis vertikal (parent.bottom → child.top) dengan elbow di tengah.
 * Style: parent bottom turun lurus, lalu belok kanan/kiri ke kolom child, lalu turun ke child top.
 */
function drawVerticalConnector(svg, parent, child, containerRect) {
    const p = getCenter(parent, containerRect);
    const c = getCenter(child, containerRect);

    const midY = (p.bottomY + c.topY) / 2;

    // Buat polyline dengan 4 titik: dari bottom parent → midY (lurus) → midY (geser X ke child) → top child
    const pts = [
        `${p.bottomX},${p.bottomY}`,
        `${p.bottomX},${midY}`,
        `${c.topX},${midY}`,
        `${c.topX},${c.topY}`,
    ].join(' ');

    const line = document.createElementNS('http://www.w3.org/2000/svg', 'polyline');
    line.setAttribute('points', pts);
    line.setAttribute('fill', 'none');
    line.setAttribute('stroke', LINE_COLOR);
    line.setAttribute('stroke-width', LINE_WIDTH);
    line.setAttribute('stroke-linejoin', 'round');
    svg.appendChild(line);
}

/**
 * Gambar garis horizontal dotted (untuk koneksi advisory: Fungsional ↔ Sekre, Pembina ↔ Ketua).
 * Garis dari sisi kanan node1 ke sisi kiri node2, di tengah vertikal.
 */
function drawDottedHorizontal(svg, node1, node2, containerRect) {
    const a = getCenter(node1, containerRect);
    const b = getCenter(node2, containerRect);

    const line = document.createElementNS('http://www.w3.org/2000/svg', 'line');
    line.setAttribute('x1', a.rightX);
    line.setAttribute('y1', a.midY);
    line.setAttribute('x2', b.leftX);
    line.setAttribute('y2', b.midY);
    line.setAttribute('stroke', '#d97706');
    line.setAttribute('stroke-width', 3);
    line.setAttribute('stroke-dasharray', '6,5');
    line.setAttribute('stroke-linecap', 'round');
    svg.appendChild(line);
}

/**
 * Render konektor untuk SOTK
 */
function renderOrgConnectors() {
    const tree = document.getElementById('orgTree');
    const svg  = document.getElementById('orgSvg');
    if (!tree || !svg) return;

    // Skip pada mobile (SVG di-display:none)
    if (window.innerWidth <= 991) {
        svg.innerHTML = '';
        return;
    }

    const rect = tree.getBoundingClientRect();
    svg.setAttribute('width', rect.width);
    svg.setAttribute('height', rect.height);
    svg.setAttribute('viewBox', `0 0 ${rect.width} ${rect.height}`);
    svg.innerHTML = '';

    const findNode = (id) => tree.querySelector(`[data-node="${id}"]`);

    // Definisikan hierarki: parent → array of children
    const edges = [
        // Lurah → Sekretaris (Fungsional via dotted, bukan struktural langsung)
        ['lurah', 'sekretaris'],
        // Sekretaris → 3 Kasi
        ['sekretaris', 'kasi-pemum'],
        ['sekretaris', 'kasi-pmk'],
        ['sekretaris', 'kasi-trantibum'],
        // Kasi Pemum → Pelaksana
        ['kasi-pemum', 'pelaksana'],
        // Pelaksana → Sanusi, Hawari
        ['pelaksana', 'op-sanusi'],
        ['pelaksana', 'op-hawari'],
        // Kasi PMK → Hasan
        ['kasi-pmk', 'op-hasan'],
        // Kasi Trantibum → Afif, Jamaludin
        ['kasi-trantibum', 'op-afif'],
        ['kasi-trantibum', 'op-jamaludin'],
    ];

    edges.forEach(([parentId, childId]) => {
        const p = findNode(parentId);
        const c = findNode(childId);
        if (p && c) drawVerticalConnector(svg, p, c, rect);
    });
}

/**
 * Render konektor untuk PKK
 */
function renderPkkConnectors() {
    const tree = document.getElementById('pkkTree');
    const svg  = document.getElementById('pkkSvg');
    if (!tree || !svg) return;

    if (window.innerWidth <= 991) {
        svg.innerHTML = '';
        return;
    }

    const rect = tree.getBoundingClientRect();
    svg.setAttribute('width', rect.width);
    svg.setAttribute('height', rect.height);
    svg.setAttribute('viewBox', `0 0 ${rect.width} ${rect.height}`);
    svg.innerHTML = '';

    const findNode = (id) => tree.querySelector(`[data-node="${id}"]`);

    // ── Cabang 1: Ketua → Wakil Ketua ──
    const ketua = findNode('ketua');
    const wakil = findNode('wakil');
    if (ketua && wakil) drawVerticalConnector(svg, ketua, wakil, rect);

    // ── Cabang 2: Wakil Ketua → Sekretaris + Bendahara (T-shape) ──
    // Sekre & Bendahara HANYA menerima garis dari atas, tidak punya garis turun.
    const sekre = findNode('sekretaris-pkk');
    const bend  = findNode('bendahara');
    if (wakil && sekre && bend) {
        drawVerticalConnector(svg, wakil, sekre, rect);
        drawVerticalConnector(svg, wakil, bend, rect);
    }

    // ── Cabang 3: Wakil Ketua → 4 Pokja (langsung, lewat antara Sekre & Bendahara) ──
    const pokjaIds = ['pokja-1', 'pokja-2', 'pokja-3', 'pokja-4'];
    const pokjas = pokjaIds.map(findNode).filter(Boolean);

    if (wakil && pokjas.length === 4) {
        const wRect = wakil.getBoundingClientRect();
        const wakilBottomX = wRect.left + wRect.width / 2 - rect.left;
        const wakilBottomY = wRect.bottom - rect.top;

        // Y target: top dari row Pokja
        const pokjaTop = pokjas[0].getBoundingClientRect().top - rect.top;

        // Horizontal bar di atas Pokja (gap kecil supaya tidak nempel)
        const barY = pokjaTop - 18;

        // X kiri-kanan: dari tengah Pokja-1 sampai tengah Pokja-4
        const p1Rect = pokjas[0].getBoundingClientRect();
        const p4Rect = pokjas[3].getBoundingClientRect();
        const p1X = p1Rect.left + p1Rect.width / 2 - rect.left;
        const p4X = p4Rect.left + p4Rect.width / 2 - rect.left;

        // 1) Garis vertikal panjang dari Wakil.bottom turun lurus ke barY
        appendPolyline(svg, [
            [wakilBottomX, wakilBottomY],
            [wakilBottomX, barY]
        ]);

        // 2) Garis horizontal bar di barY, dari Pokja-1 sampai Pokja-4
        //    (juga melewati titik di bawah Wakil supaya nyambung)
        const barLeft  = Math.min(p1X, wakilBottomX);
        const barRight = Math.max(p4X, wakilBottomX);
        appendPolyline(svg, [
            [barLeft, barY],
            [barRight, barY]
        ]);

        // 3) Garis vertikal dari barY turun ke top tiap Pokja
        pokjas.forEach(p => {
            const pRect = p.getBoundingClientRect();
            const pX = pRect.left + pRect.width / 2 - rect.left;
            const pY = pRect.top - rect.top;
            appendPolyline(svg, [
                [pX, barY],
                [pX, pY]
            ]);
        });
    }

    // ── Dotted: Pembina ↔ Ketua ──
    const pembina = findNode('pembina');
    if (pembina && ketua) drawDottedHorizontal(svg, pembina, ketua, rect);
}

// Helper: tambah polyline ke SVG dari array [[x,y],[x,y],...]
function appendPolyline(svg, points) {
    const line = document.createElementNS('http://www.w3.org/2000/svg', 'polyline');
    line.setAttribute('points', points.map(p => p.join(',')).join(' '));
    line.setAttribute('fill', 'none');
    line.setAttribute('stroke', LINE_COLOR);
    line.setAttribute('stroke-width', LINE_WIDTH);
    line.setAttribute('stroke-linejoin', 'round');
    svg.appendChild(line);
}

function renderAllConnectors() {
    renderOrgConnectors();
    renderPkkConnectors();
}

// Render saat awal & saat resize
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', renderAllConnectors);
} else {
    renderAllConnectors();
}

// Re-render setelah semua image load (karena ukuran node bisa berubah)
window.addEventListener('load', renderAllConnectors);

// Debounce resize
let resizeTimer;
window.addEventListener('resize', () => {
    clearTimeout(resizeTimer);
    resizeTimer = setTimeout(renderAllConnectors, 100);
});
</script>
</body>
</html>