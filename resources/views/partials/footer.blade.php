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

.footer-heading {
    font-size: 12px; font-weight: 700; color: #cbd5e1;
    text-transform: uppercase; letter-spacing: .08em; margin-bottom: 16px;
}
.footer-links        { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 9px; }
.footer-links a      { color: #94a3b8; text-decoration: none; font-size: 13px; transition: color .18s; }
.footer-links a:hover{ color: #60a5fa; }

.footer-contact      { list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 12px; }
.footer-contact li   { display: flex; gap: 10px; font-size: 12.5px; color: #94a3b8; align-items: flex-start; }
.footer-contact li i { color: #60a5fa; flex-shrink: 0; margin-top: 2px; }

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

/* =====================================================
   FLOATING CHATBOT — satu tombol pill robot + teks
===================================================== */
#chatbot-wrap {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 9000;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 12px;
    font-family: 'Plus Jakarta Sans', 'Segoe UI', sans-serif;
}

/* ✅ Satu tombol pill memanjang: [🤖 Tanya Kami] */
#chatbot-btn {
    display: inline-flex;
    align-items: center;
    gap: 10px;
    padding: 0 8px 0 20px;
    height: 52px;
    border-radius: 999px;
    background: linear-gradient(135deg, #1c64f2, #0d1b3e);
    border: none;
    cursor: pointer;
    box-shadow: 0 6px 20px rgba(28,100,242,.45);
    transition: all .25s;
    position: relative;
}
#chatbot-btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 10px 28px rgba(28,100,242,.55);
}

/* Lingkaran ikon robot di dalam pill */
.cb-icon-wrap {
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: rgba(255,255,255,.18);
    border: 1.5px solid rgba(255,255,255,.3);
    display: flex;
    align-items: center;
    justify-content: center;
    flex-shrink: 0;
}
.cb-icon-wrap svg { width: 20px; height: 20px; fill: white; }

/* Teks "Tanya Kami" */
.cb-label {
    font-size: 14px;
    font-weight: 700;
    color: white;
    letter-spacing: .01em;
    white-space: nowrap;
}

/* Bubble notifikasi */
#chatbot-notif {
    position: absolute;
    top: -4px; right: -4px;
    width: 20px; height: 20px;
    background: #ef4444;
    border-radius: 50%;
    border: 2px solid white;
    font-size: 10px; font-weight: 700; color: white;
    display: flex; align-items: center; justify-content: center;
}

/* Panel chatbot */
#chatbot-panel {
    display: none;
    width: 340px;
    max-width: calc(100vw - 32px);
    background: white;
    border-radius: 18px;
    box-shadow: 0 12px 48px rgba(0,0,0,.18);
    overflow: hidden;
    animation: slideUpChat .25s ease;
}
@keyframes slideUpChat {
    from { opacity: 0; transform: translateY(20px) scale(.97); }
    to   { opacity: 1; transform: translateY(0) scale(1); }
}
#chatbot-panel.open { display: block; }

/* Header panel */
.chat-header {
    background: linear-gradient(135deg, #0d1b3e, #1c64f2);
    padding: 16px 18px;
    display: flex; align-items: center; justify-content: space-between;
}
.chat-header-left { display: flex; align-items: center; gap: 12px; }
.chat-header-avatar {
    width: 42px; height: 42px; border-radius: 50%;
    background: rgba(255,255,255,.2); border: 2px solid rgba(255,255,255,.3);
    display: flex; align-items: center; justify-content: center; flex-shrink: 0;
}
.chat-header-avatar svg { width: 24px; height: 24px; fill: white; }
.chat-header-name   { font-size: 14px; font-weight: 700; color: white; line-height: 1.3; }
.chat-header-status { font-size: 11px; color: rgba(255,255,255,.75); display: flex; align-items: center; gap: 4px; }
.chat-header-status::before { content:''; width:7px; height:7px; border-radius:50%; background:#4ade80; display:inline-block; }
.chat-close {
    background: rgba(255,255,255,.15); border: none; border-radius: 8px;
    width: 30px; height: 30px; display: flex; align-items: center; justify-content: center;
    color: white; cursor: pointer; font-size: 16px; transition: background .18s;
}
.chat-close:hover { background: rgba(255,255,255,.28); }

/* Pesan area */
.chat-messages {
    padding: 16px; max-height: 320px; overflow-y: auto;
    background: #f8fafc; display: flex; flex-direction: column; gap: 10px;
}
.chat-bubble-bot {
    background: white; border: 1px solid #e2e8f0;
    border-radius: 14px 14px 14px 4px;
    padding: 11px 14px; font-size: 13px; color: #334155; line-height: 1.6;
    max-width: 90%; align-self: flex-start;
    box-shadow: 0 1px 4px rgba(0,0,0,.06);
}
.chat-bubble-user {
    background: #1c64f2; border-radius: 14px 14px 4px 14px;
    padding: 11px 14px; font-size: 13px; color: white; line-height: 1.6;
    max-width: 90%; align-self: flex-end;
}

/* FAQ list */
.chat-faq-list {
    padding: 0 16px 16px;
    display: flex; flex-direction: column; gap: 7px;
    background: #f8fafc;
}
.chat-faq-item {
    background: white; border: 1.5px solid #e2e8f0; border-radius: 10px;
    padding: 10px 14px; font-size: 12.5px; font-weight: 600; color: #1c64f2;
    cursor: pointer; text-align: left; transition: all .18s;
    display: flex; align-items: center; gap: 8px;
}
.chat-faq-item:hover { background: #eff6ff; border-color: #bfdbfe; }
.chat-faq-item i { font-size: 14px; flex-shrink: 0; }

/* Footer panel */
.chat-footer {
    padding: 12px 16px; border-top: 1px solid #e2e8f0; background: white;
    display: flex; align-items: center; gap: 8px; font-size: 12px; color: #64748b;
}
.chat-wa-btn {
    display: inline-flex; align-items: center; gap: 6px;
    padding: 8px 14px; background: #25d366; color: white;
    border-radius: 8px; font-size: 12px; font-weight: 700;
    text-decoration: none; transition: background .18s; flex-shrink: 0;
}
.chat-wa-btn:hover { background: #1da851; color: white; }
.chat-back-btn {
    background: none; border: none; color: #64748b; font-size: 12px;
    cursor: pointer; padding: 8px 0; display: flex; align-items: center; gap: 6px;
    font-family: inherit; transition: color .18s;
}
.chat-back-btn:hover { color: #1c64f2; }

@media (max-width: 480px) {
    #chatbot-wrap { bottom: 16px; right: 16px; }
    #chatbot-panel { width: calc(100vw - 32px); }
    .cb-label { font-size: 13px; }
}
</style>

<footer class="main-footer">
    <div class="row g-4">

        <!-- Brand -->
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
                <a href="#" class="footer-social"><i class="bi bi-globe2"></i></a>
                <a href="#" class="footer-social"><i class="bi bi-envelope-fill"></i></a>
                <a href="#" class="footer-social"><i class="bi bi-telephone-fill"></i></a>
            </div>
        </div>

        <!-- Tautan Cepat -->
        <div class="col-lg-2 col-md-6">
            <div class="footer-heading">Tautan Cepat</div>
            <ul class="footer-links">
                <li><a href="#">Profil Kelurahan</a></li>
                <li><a href="#">Struktur Organisasi</a></li>
                <li><a href="#">Layanan Online</a></li>
                <li><a href="#">Transparansi Anggaran</a></li>
                <li><a href="#">Peta Wilayah</a></li>
            </ul>
        </div>

        <!-- Kontak -->
        <div class="col-lg-4 col-md-6">
            <div class="footer-heading">Kontak Kami</div>
            <ul class="footer-contact">
                <li><i class="bi bi-geo-alt-fill"></i><span>Jl. Raya Teritih No. 123, Kecamatan Walantaka, Kota Serang, Banten 42183</span></li>
                <li><i class="bi bi-telephone-fill"></i><span>(0254) 123456</span></li>
                <li><i class="bi bi-envelope-fill"></i><span>admin@teritih.go.id</span></li>
                <li><i class="bi bi-clock-fill"></i><span>Senin–Jumat: 08.00–16.00</span></li>
            </ul>
        </div>

        <!-- Peta -->
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

{{-- ═══ FLOATING CHATBOT ═══ --}}
<div id="chatbot-wrap">

    {{-- Panel --}}
    <div id="chatbot-panel">
        <div class="chat-header">
            <div class="chat-header-left">
                <div class="chat-header-avatar">
                    <svg viewBox="0 0 24 24"><path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h3a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3v-8a3 3 0 0 1 3-3h3V5.73A2 2 0 0 1 12 2zm-4 9a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm8 0a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-4 4a4 4 0 0 1-3.58-2.21.5.5 0 0 1 .9-.44A3 3 0 0 0 12 14a3 3 0 0 0 2.68-1.65.5.5 0 0 1 .9.44A4 4 0 0 1 12 15z"/></svg>
                </div>
                <div>
                    <div class="chat-header-name">Asisten Kelurahan Teritih</div>
                    <div class="chat-header-status">Online</div>
                </div>
            </div>
            <button class="chat-close" onclick="closeChat()"><i class="bi bi-x-lg"></i></button>
        </div>

        <div class="chat-messages" id="chat-messages">
            <div class="chat-bubble-bot">
                👋 Halo! Selamat datang di Kelurahan Teritih.<br><br>
                Ada yang bisa saya bantu? Pilih pertanyaan di bawah atau hubungi via WhatsApp.
            </div>
        </div>

        <div class="chat-faq-list" id="chat-faq-list">
            <button class="chat-faq-item" onclick="askFaq(0)"><i class="bi bi-file-earmark-text"></i> Cara mengajukan permohonan surat</button>
            <button class="chat-faq-item" onclick="askFaq(1)"><i class="bi bi-list-ul"></i> Jenis surat apa saja yang tersedia?</button>
            <button class="chat-faq-item" onclick="askFaq(2)"><i class="bi bi-clock"></i> Berapa lama proses pembuatan surat?</button>
            <button class="chat-faq-item" onclick="askFaq(3)"><i class="bi bi-file-earmark-check"></i> Syarat dokumen yang dibutuhkan</button>
            <button class="chat-faq-item" onclick="askFaq(4)"><i class="bi bi-geo-alt"></i> Alamat &amp; jam operasional kantor</button>
            <button class="chat-faq-item" onclick="askFaq(5)"><i class="bi bi-bell"></i> Cara cek status permohonan saya</button>
            <button class="chat-faq-item" onclick="askFaq(6)"><i class="bi bi-person-plus"></i> Cara daftar akun masyarakat</button>
        </div>

        <div class="chat-footer">
            <span>Tidak ada di sini?</span>
            <a href="https://wa.me/6285214902301?text=Halo%20Kelurahan%20Teritih%2C%20saya%20ingin%20bertanya%20mengenai%20layanan."
               target="_blank" class="chat-wa-btn">
                <svg viewBox="0 0 24 24" style="width:13px;height:13px;fill:white"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413z"/></svg>
                WhatsApp
            </a>
        </div>
    </div>

    {{-- ✅ Satu tombol pill: ikon robot + teks "Tanya Kami" --}}
    <button id="chatbot-btn" onclick="toggleChat()" aria-label="Tanya Kami - Asisten Kelurahan">
        <span id="chatbot-notif">1</span>
        <span class="cb-label">Tanya Kami</span>
        <div class="cb-icon-wrap">
            <svg viewBox="0 0 24 24"><path d="M12 2a2 2 0 0 1 2 2c0 .74-.4 1.39-1 1.73V7h3a3 3 0 0 1 3 3v8a3 3 0 0 1-3 3H8a3 3 0 0 1-3-3v-8a3 3 0 0 1 3-3h3V5.73A2 2 0 0 1 12 2zm-4 9a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm8 0a1.5 1.5 0 1 0 0 3 1.5 1.5 0 0 0 0-3zm-4 4a4 4 0 0 1-3.58-2.21.5.5 0 0 1 .9-.44A3 3 0 0 0 12 14a3 3 0 0 0 2.68-1.65.5.5 0 0 1 .9.44A4 4 0 0 1 12 15z"/></svg>
        </div>
    </button>

</div>

<script>
(function () {
    var faqs = [
        {
            q: 'Cara mengajukan permohonan surat',
            a: '📋 <b>Cara Mengajukan Permohonan Surat:</b><br><br>1. Daftar/Login akun masyarakat<br>2. Klik menu <b>Layanan → Permohonan Surat</b><br>3. Pilih jenis surat yang dibutuhkan<br>4. Isi formulir dan unggah dokumen<br>5. Klik <b>Kirim Permohonan</b><br><br>✅ Diproses pada <b>hari kerja</b>.'
        },
        {
            q: 'Jenis surat apa saja yang tersedia?',
            a: '📄 <b>8 Jenis Surat Tersedia:</b><br><br>• Keterangan Domisili<br>• Keterangan Usaha<br>• Pengantar SKCK<br>• Keterangan Tidak Mampu (SKTM)<br>• Keterangan Kelahiran<br>• Keterangan Kematian<br>• Keterangan Pindah<br>• Keterangan Belum Menikah'
        },
        {
            q: 'Berapa lama proses pembuatan surat?',
            a: '⏱️ <b>Estimasi Waktu Proses:</b><br><br>• <b>Online:</b> 1–3 hari kerja<br>• <b>Langsung ke kantor:</b> Bisa selesai hari yang sama<br><br>📩 Notifikasi via <b>dashboard</b> dan <b>WhatsApp</b>.'
        },
        {
            q: 'Syarat dokumen yang dibutuhkan',
            a: '📎 <b>Dokumen Umum:</b><br><br>• Fotokopi KTP (wajib)<br>• Fotokopi Kartu Keluarga (KK)<br>• Surat pengantar RT/RW<br>• Dokumen pendukung sesuai jenis surat<br><br>⚠️ Detail lengkap ada di halaman <b>Layanan</b>.'
        },
        {
            q: 'Alamat & jam operasional kantor',
            a: '📍 <b>Kantor Kelurahan Teritih</b><br>Jl. Raya Teritih No. 123, Kecamatan Walantaka, Kota Serang<br><br>🕐 <b>Jam Operasional:</b><br>• Senin – Kamis: 08.00 – 16.00<br>• Jumat: 08.00 – 15.30<br>• Sabtu & Minggu: <b>Tutup</b><br><br>📞 Telepon: (0254) 123456'
        },
        {
            q: 'Cara cek status permohonan saya',
            a: '🔍 <b>Cara Cek Status:</b><br><br>1. Login ke akun masyarakat<br>2. Klik <b>Permohonan Saya</b><br>3. Lihat status:<br>   🟡 <b>Pending</b> — Sedang diproses<br>   🟢 <b>Disetujui</b> — Surat siap<br>   🔴 <b>Ditolak</b> — Lihat alasan<br><br>📲 Notifikasi juga dikirim via WhatsApp.'
        },
        {
            q: 'Cara daftar akun masyarakat',
            a: '👤 <b>Cara Daftar Akun:</b><br><br>1. Klik <b>"Login Masyarakat"</b> di navbar<br>2. Pilih <b>"Daftar Akun Baru"</b><br>3. Isi data diri (nama, NIK, email, HP)<br>4. Buat password dan klik <b>Daftar</b><br>5. Akun langsung aktif<br><br>✅ Pendaftaran <b>gratis</b>.'
        }
    ];

    var chatOpen    = false;
    var notifHidden = false;

    window.toggleChat = function () {
        chatOpen = !chatOpen;
        var panel = document.getElementById('chatbot-panel');
        var notif = document.getElementById('chatbot-notif');
        if (chatOpen) {
            panel.classList.add('open');
            if (!notifHidden) { notif.style.display = 'none'; notifHidden = true; }
            document.getElementById('chat-messages').scrollTop = 9999;
        } else {
            panel.classList.remove('open');
        }
    };

    window.closeChat = function () {
        chatOpen = false;
        document.getElementById('chatbot-panel').classList.remove('open');
    };

    window.askFaq = function (idx) {
        var faq     = faqs[idx];
        var msgs    = document.getElementById('chat-messages');
        var faqList = document.getElementById('chat-faq-list');

        var bubbleUser = document.createElement('div');
        bubbleUser.className   = 'chat-bubble-user';
        bubbleUser.textContent = faq.q;
        msgs.appendChild(bubbleUser);
        faqList.style.display = 'none';

        setTimeout(function () {
            var bubbleBot = document.createElement('div');
            bubbleBot.className = 'chat-bubble-bot';
            bubbleBot.innerHTML = faq.a;
            msgs.appendChild(bubbleBot);

            var backBtn = document.createElement('button');
            backBtn.className = 'chat-back-btn';
            backBtn.innerHTML = '<i class="bi bi-arrow-left" style="font-size:12px"></i> Pertanyaan lain';
            backBtn.onclick   = resetChat;
            msgs.appendChild(backBtn);

            msgs.scrollTop = msgs.scrollHeight;
        }, 600);
    };

    function resetChat() {
        var msgs    = document.getElementById('chat-messages');
        var faqList = document.getElementById('chat-faq-list');
        while (msgs.children.length > 1) { msgs.removeChild(msgs.lastChild); }
        faqList.style.display = 'flex';
        msgs.scrollTop = 0;
    }

    setTimeout(function () {
        if (!notifHidden) {
            document.getElementById('chatbot-notif').style.display = 'none';
            notifHidden = true;
        }
    }, 5000);
})();
</script>