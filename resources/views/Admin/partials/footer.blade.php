@once
@push('styles')
<style>
/* =========================================================
   FOOTER
========================================================= */
.app-footer { background: #0f172a; flex-shrink: 0; padding: 48px 32px 0; color: #94a3b8; }

.footer-logo {
    width: 36px; height: 36px;
    background: linear-gradient(135deg, #1e3a5f, #0f172a);
    border: 1px solid #334155;
    border-radius: 8px; display: flex;
    align-items: center; justify-content: center;
    color: #93c5fd; font-size: 18px; flex-shrink: 0;
}
.footer-brand-name { font-size: 15px; font-weight: 800; color: white; line-height: 1.2; }
.footer-brand-sub  { font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: .05em; }
.footer-desc       { font-size: 12.5px; color: #94a3b8; line-height: 1.75; margin-bottom: 16px; }

.footer-social {
    width: 32px; height: 32px; background: #1e293b;
    border-radius: 7px; display: inline-flex;
    align-items: center; justify-content: center;
    color: #94a3b8; text-decoration: none;
    font-size: 15px; transition: all .18s;
}
.footer-social:hover { background: #334155; color: white; }

.footer-heading {
    font-size: 12px; font-weight: 700; color: #cbd5e1;
    text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px;
}

/* Info Sistem */
.footer-info-item {
    display: flex; align-items: flex-start; gap: 10px;
    font-size: 12px; color: #64748b; line-height: 1.5; margin-bottom: 16px;
}
.footer-info-item:last-child { margin-bottom: 0; }
.footer-info-item i { color: #475569; flex-shrink: 0; margin-top: 2px; font-size: 13px; }
.footer-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 9px; border-radius: 999px;
    font-size: 10.5px; font-weight: 600; letter-spacing: .02em; margin-top: 4px;
}
.footer-badge-green { background: #052e16; color: #4ade80; border: 1px solid #166534; }
.footer-badge-blue  { background: #0c1a3a; color: #60a5fa; border: 1px solid #1e40af; }

/* Kontak */
.footer-contact     { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 14px; }
.footer-contact li  { display: flex; gap: 12px; align-items: flex-start; }
.footer-contact li i {
    color: #60a5fa; flex-shrink: 0;
    margin-top: 2px; font-size: 13px;
    width: 16px; text-align: center;
}
.footer-contact li span,
.footer-contact li a {
    font-size: 12.5px; color: #94a3b8;
    line-height: 1.6; text-decoration: none;
    transition: color .18s;
}
.footer-contact li a:hover { color: #60a5fa; }

.footer-map { border-radius: 10px; overflow: hidden; border: 1px solid #1e293b; }

.footer-bottom {
    border-top: 1px solid #1e293b; padding: 16px 0; margin-top: 16px;
    display: flex; justify-content: space-between; align-items: center;
    flex-wrap: wrap; gap: 10px; font-size: 12px; color: #475569;
}
.footer-bottom a { color: #64748b; text-decoration: none; transition: color .18s; }
.footer-bottom a:hover { color: #94a3b8; }
</style>
@endpush
@endonce

<footer class="app-footer">
    <div class="container-fluid px-0">
        <div class="row g-4 pb-2">

            {{-- Brand --}}
            <div class="col-lg-3 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="footer-logo"><i class="bi bi-shield-fill"></i></div>
                    <div>
                        <div class="footer-brand-name">Kelurahan Teritih</div>
                        <div class="footer-brand-sub">Kota Serang</div>
                    </div>
                </div>
                <p class="footer-desc">Mewujudkan tata kelola pemerintahan yang baik, bersih, dan melayani masyarakat dengan sepenuh hati.</p>
                <div class="d-flex gap-2">
                    <a href="https://www.instagram.com/kelurahanteritih/" target="_blank" rel="noopener" class="footer-social" aria-label="Instagram Kelurahan Teritih" title="@kelurahanteritih">
                        <i class="bi bi-instagram"></i>
                    </a>
                    <a href="mailto:kel.teritih@serangkota.go.id" class="footer-social" aria-label="Email Kelurahan Teritih" title="Email">
                        <i class="bi bi-envelope-fill"></i>
                    </a>
                </div>
            </div>

            {{-- Info Sistem --}}
            <div class="col-lg-2 col-md-6">
                <div class="footer-heading">Info Sistem</div>
                <div class="footer-info-item">
                    <i class="bi bi-circle-fill" style="color:#4ade80;font-size:8px;margin-top:5px;"></i>
                    <div>
                        <div style="color:#94a3b8;font-size:11.5px;font-weight:600;">Status Sistem</div>
                        <span class="footer-badge footer-badge-green">Beroperasi Normal</span>
                    </div>
                </div>
                <div class="footer-info-item">
                    <i class="bi bi-calendar3"></i>
                    <div>
                        <div style="color:#94a3b8;font-size:11.5px;font-weight:600;">Pembaruan Terakhir</div>
                        <span style="color:#64748b;font-size:11.5px;">{{ date('d M Y') }}</span>
                    </div>
                </div>
                <div class="footer-info-item">
                    <i class="bi bi-shield-lock"></i>
                    <div>
                        <div style="color:#94a3b8;font-size:11.5px;font-weight:600;">Akses</div>
                        <span style="color:#64748b;font-size:11.5px;">Khusus Petugas</span>
                    </div>
                </div>
            </div>

            {{-- Kontak --}}
            <div class="col-lg-4 col-md-6">
                <div class="footer-heading">Kontak Kami</div>
                <ul class="footer-contact">
                    <li>
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>Jl. Raya Kalodran - Sidapurna No. 1 Teritih,<br>Kecamatan Walantaka, Kota Serang, Banten 42183</span>
                    </li>
                    <li>
                        <i class="bi bi-envelope-fill"></i>
                        <a href="mailto:kel.teritih@serangkota.go.id">kel.teritih@serangkota.go.id</a>
                    </li>
                    <li>
                        <i class="bi bi-instagram"></i>
                        <a href="https://www.instagram.com/kelurahanteritih/" target="_blank" rel="noopener">@kelurahanteritih</a>
                    </li>
                </ul>
            </div>

            {{-- Peta --}}
            <div class="col-lg-3 col-md-6">
                <div class="footer-heading">Lokasi Kantor</div>
                <div class="footer-map">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3264.628318155724!2d106.21330817398886!3d-6.111405093875137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e41f4528991d579%3A0x30e6a19597ad1d4a!2sBalai%20Desa%20Kelurahan%20Teritih!5e1!3m2!1sid!2sid!4v1776310241900!5m2!1sid!2sid"
                        width="100%" height="140" style="border:0;" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>

        <div class="footer-bottom">
            <span>© {{ date('Y') }} Kelurahan Teritih, Kota Serang. Hak Cipta Dilindungi.</span>
            <span>Sistem Informasi Pelayanan Kelurahan (SIMPEKA) v2.0</span>
        </div>
    </div>
</footer>