@once
@push('styles')
<style>
/* =========================================================
   FOOTER
========================================================= */
.app-footer { background: #0f172a; margin-top: 40px; color: #94a3b8; }
.footer-logo {
    width: 32px; height: 32px; background: #1c64f2;
    border-radius: 7px; display: flex; align-items: center; justify-content: center;
    color: white; font-size: 16px;
}
.footer-brand-name { font-size: 16px; font-weight: 700; color: white; }
.footer-desc       { font-size: 12.5px; color: #94a3b8; line-height: 1.7; }
.footer-social {
    width: 32px; height: 32px; background: #1e293b;
    border-radius: 7px; display: flex; align-items: center; justify-content: center;
    color: #94a3b8; text-decoration: none; font-size: 15px; transition: all .18s;
}
.footer-social:hover { background: #1c64f2; color: white; }
.footer-heading {
    font-size: 11px; font-weight: 700; color: #cbd5e1;
    text-transform: uppercase; letter-spacing: .08em; margin-bottom: 14px;
}
.footer-links        { list-style: none; padding: 0; display: flex; flex-direction: column; gap: 8px; }
.footer-links a      { color: #94a3b8; text-decoration: none; font-size: 12.5px; display: flex; align-items: center; gap: 5px; transition: color .18s; }
.footer-links a i    { font-size: 9px; }
.footer-links a:hover{ color: #60a5fa; }
.footer-contact      { list-style: none; padding: 0; display: flex; flex-direction: column; gap: 12px; }
.footer-contact li   { display: flex; gap: 10px; font-size: 12.5px; align-items: flex-start; }
.footer-contact li i { color: #60a5fa; margin-top: 2px; flex-shrink: 0; }
.footer-map          { border-radius: 8px; overflow: hidden; border: 1px solid #1e293b; }
.footer-bottom       { border-top: 1px solid #1e293b; padding: 16px 0; font-size: 12px; color: #475569; }

/* Info Sistem */
.footer-info-item {
    display: flex; align-items: flex-start; gap: 8px;
    font-size: 12px; color: #64748b; line-height: 1.5;
}
.footer-info-item i { color: #475569; flex-shrink: 0; margin-top: 2px; font-size: 12px; }
.footer-badge {
    display: inline-flex; align-items: center; gap: 5px;
    padding: 3px 9px; border-radius: 999px;
    font-size: 10.5px; font-weight: 600; letter-spacing: .02em;
}
.footer-badge-green { background: #052e16; color: #4ade80; border: 1px solid #166534; }
.footer-badge-blue  { background: #0c1a3a; color: #60a5fa; border: 1px solid #1e40af; }
</style>
@endpush
@endonce

<footer class="app-footer">
    <div class="container-fluid px-4">
        <div class="row g-4 pt-4 pb-3">

            <!-- Brand -->
            <div class="col-lg-3 col-md-6">
                <div class="d-flex align-items-center gap-2 mb-3">
                    <div class="footer-logo"><i class="bi bi-geo-alt-fill"></i></div>
                    <span class="footer-brand-name">Kelurahan Teritih</span>
                </div>
                <p class="footer-desc">
                    Mewujudkan tata kelola pemerintahan yang baik, bersih, dan melayani masyarakat dengan sepenuh hati.
                </p>
                <div class="d-flex gap-2 mt-3">
                    <a href="#" class="footer-social"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="footer-social"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="footer-social"><i class="bi bi-whatsapp"></i></a>
                </div>
            </div>

            <!-- Info Sistem (pengganti Tautan Internal) -->
            <div class="col-lg-2 col-md-6">
                <h6 class="footer-heading">Info Sistem</h6>
                <div class="d-flex flex-column gap-3">
                    <div class="footer-info-item">
                        <i class="bi bi-layers"></i>
                        <div>
                            <div style="color:#94a3b8;font-size:11.5px;font-weight:600;">Versi Aplikasi</div>
                            <span class="footer-badge footer-badge-blue mt-1">SIMPEKA v2.0</span>
                        </div>
                    </div>
                    <div class="footer-info-item">
                        <i class="bi bi-circle-fill" style="color:#4ade80;font-size:8px;margin-top:4px;"></i>
                        <div>
                            <div style="color:#94a3b8;font-size:11.5px;font-weight:600;">Status Sistem</div>
                            <span class="footer-badge footer-badge-green mt-1">Beroperasi Normal</span>
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
            </div>

            <!-- Kontak -->
            <div class="col-lg-4 col-md-6">
                <h6 class="footer-heading">Kontak &amp; Dukungan</h6>
                <ul class="footer-contact">
                    <li>
                        <i class="bi bi-geo-alt-fill text-primary"></i>
                        <span>Jl. Raya Teritih No. 123, Kota Serang, Banten 42119</span>
                    </li>
                    <li>
                        <i class="bi bi-telephone-fill text-primary"></i>
                        <span>(0254) 123-456 / 789 | 1970</span>
                    </li>
                    <li>
                        <i class="bi bi-envelope-fill text-primary"></i>
                        <span>support@kelurahan-teritih.go.id</span>
                    </li>
                    <li>
                        <i class="bi bi-headset text-primary"></i>
                        <span>Helpdesk IT: Ext. 101 &mdash; Senin&ndash;Jumat 08.00&ndash;16.00</span>
                    </li>
                </ul>
            </div>

            <!-- Peta -->
            <div class="col-lg-3 col-md-6">
                <h6 class="footer-heading">Lokasi Kantor</h6>
                <div class="footer-map rounded overflow-hidden border border-secondary border-opacity-25">
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3264.628318155724!2d106.21330817398886!3d-6.111405093875137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e41f4528991d579%3A0x30e6a19597ad1d4a!2sBalai%20Desa%20Kelurahan%20Teritih!5e1!3m2!1sid!2sid!4v1776310241900!5m2!1sid!2sid"
                        width="100%" height="120" style="border:0" allowfullscreen="" loading="lazy">
                    </iframe>
                </div>
            </div>

        </div>

        <div class="footer-bottom d-flex justify-content-between align-items-center flex-wrap gap-2">
            <span>© {{ date('Y') }} Kelurahan Teritih. Hak Cipta Dilindungi.</span>
            <span>Sistem Informasi Pelayanan Kelurahan (SIMPEKA) v2.0</span>
        </div>
    </div>
</footer>