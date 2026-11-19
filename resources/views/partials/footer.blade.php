<style>
/* =====================================================
   FOOTER
===================================================== */
.main-footer { background: #0f172a; padding: 48px 32px 0; flex-shrink: 0; }

.footer-brand-icon {
    width: 36px; height: 36px; background: #1c64f2;
    border-radius: 8px; display: flex;
    align-items: center; justify-content: center;
    color: white; font-size: 18px; flex-shrink: 0;
}
.footer-brand-name { font-size: 15px; font-weight: 800; color: white; line-height: 1.2; }
.footer-brand-sub  { font-size: 10px; color: #64748b; text-transform: uppercase; letter-spacing: .05em; }
.footer-desc       { font-size: 12.5px; color: #94a3b8; line-height: 1.75; margin: 10px 0 16px; }

.footer-social {
    width: 32px; height: 32px; background: #1e293b;
    border-radius: 7px; display: inline-flex;
    align-items: center; justify-content: center;
    color: #94a3b8; text-decoration: none;
    font-size: 15px; transition: all .18s;
}
.footer-social:hover { background: #1c64f2; color: white; }
.footer-social.ig:hover {
    background: linear-gradient(45deg, #f09433, #e6683c, #dc2743, #cc2366, #bc1888);
    color: white;
}

.footer-heading {
    font-size: 12px; font-weight: 700; color: #cbd5e1;
    text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px;
}
.footer-links        { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 9px; }
.footer-links a      { color: #94a3b8; text-decoration: none; font-size: 13px; transition: color .18s; display: flex; align-items: center; gap: 6px; }
.footer-links a i    { font-size: 10px; color: #475569; }
.footer-links a:hover{ color: #60a5fa; }
.footer-links a:hover i { color: #60a5fa; }

.footer-contact      { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
.footer-contact li   { display: flex; gap: 10px; font-size: 12.5px; color: #94a3b8; align-items: flex-start; }
.footer-contact li i { color: #60a5fa; flex-shrink: 0; margin-top: 2px; }
.footer-contact a    { color: #94a3b8; text-decoration: none; transition: color .18s; }
.footer-contact a:hover { color: #60a5fa; }

.footer-map { border-radius: 10px; overflow: hidden; border: 1px solid #1e293b; }

.footer-bottom {
    border-top: 1px solid #1e293b; padding: 16px 0; margin-top: 32px;
    display: flex; justify-content: space-between; align-items: center;
    flex-wrap: wrap; gap: 10px; font-size: 12px; color: #475569;
}
.footer-bottom-links { display: flex; gap: 20px; }
.footer-bottom-links a { color: #64748b; text-decoration: none; transition: color .18s; }
.footer-bottom-links a:hover { color: #94a3b8; }

@media (max-width: 991px) { .main-footer { padding: 36px 16px 0; } }
</style>

<footer class="main-footer">
    <div class="row g-4">

        <div class="col-lg-3 col-md-6">
            <div class="d-flex align-items-center gap-2 mb-1">
                <div class="footer-brand-icon"><i class="bi bi-bank2"></i></div>
                <div>
                    <div class="footer-brand-name">Kelurahan Teritih</div>
                    <div class="footer-brand-sub">Kota Serang</div>
                </div>
            </div>
            <p class="footer-desc">Mewujudkan tata kelola pemerintahan yang baik, bersih, dan melayani masyarakat dengan sepenuh hati.</p>
            <div class="d-flex gap-2">
                <a href="https://www.instagram.com/kelurahanteritih/" target="_blank" rel="noopener" class="footer-social ig" aria-label="Instagram Kelurahan Teritih" title="@kelurahanteritih">
                    <i class="bi bi-instagram"></i>
                </a>
                <a href="mailto:kel.teritih@serangkota.go.id" class="footer-social" aria-label="Email Kelurahan Teritih" title="Email">
                    <i class="bi bi-envelope-fill"></i>
                </a>
            </div>
        </div>

        <div class="col-lg-2 col-md-6">
            <div class="footer-heading">Tautan Cepat</div>
            <ul class="footer-links">
                <li><a href="{{ route('home') }}"><i class="bi bi-chevron-right"></i> Beranda</a></li>
                <li><a href="{{ route('profil') }}"><i class="bi bi-chevron-right"></i> Profil Kelurahan</a></li>
                <li><a href="{{ route('layanan') }}"><i class="bi bi-chevron-right"></i> Layanan Online</a></li>
                <li><a href="{{ route('demografi') }}"><i class="bi bi-chevron-right"></i> Informasi</a></li>
                <li><a href="{{ route('berita') }}"><i class="bi bi-chevron-right"></i> Berita Kelurahan</a></li>
                <li><a href="{{ route('login') }}"><i class="bi bi-chevron-right"></i> Login Masyarakat</a></li>
                <li><a href="{{ route('register') }}"><i class="bi bi-chevron-right"></i> Daftar Akun</a></li>
            </ul>
        </div>

        <div class="col-lg-4 col-md-6">
            <div class="footer-heading">Kontak Kami</div>
            <ul class="footer-contact">
                <li><i class="bi bi-geo-alt-fill"></i><span>Jl. Raya Kalodran - Sidapurna No.1, Teritih, Kec. Walantaka, Kota Serang, Banten 42183</span></li>
                <li><i class="bi bi-envelope-fill"></i><a href="mailto:kel.teritih@serangkota.go.id">kel.teritih@serangkota.go.id</a></li>
                <li><i class="bi bi-instagram"></i><a href="https://www.instagram.com/kelurahanteritih/" target="_blank" rel="noopener">@kelurahanteritih</a></li>
                <li><i class="bi bi-clock-fill"></i><span>Senin–Kamis: 07.30–16.00 | Jumat: 07.30–16.30</span></li>
            </ul>
        </div>

        <div class="col-lg-3 col-md-6">
            <div class="footer-heading">Lokasi Kantor</div>
            <div class="footer-map">
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3264.628318155724!2d106.21330817398886!3d-6.111405093875137!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e41f4528991d579%3A0x30e6a19597ad1d4a!2sBalai%20Desa%20Kelurahan%20Teritih!5e1!3m2!1sid!2sid!4v1776310241900!5m2!1sid!2sid"
                    width="100%" height="140" style="border:0;" allowfullscreen="" loading="lazy"></iframe>
            </div>
        </div>

    </div>

    <div class="footer-bottom">
        <span>© {{ date('Y') }} Kelurahan Teritih, Kota Serang. Hak Cipta Dilindungi.</span>
        <div class="footer-bottom-links">
            <a href="#">Kebijakan Privasi</a>
            <a href="#">Syarat &amp; Ketentuan</a>
            <a href="#">Peta Situs</a>
        </div>
    </div>
</footer>

{{-- Widget chatbot dipisah ke file tersendiri --}}
@include('partials.chatbot')

@include('partials.toast')
