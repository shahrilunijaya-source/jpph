<?php

namespace Database\Seeders;

use App\Models\Page;
use Illuminate\Database\Seeder;

class PageSeeder extends Seeder
{
    public function run(): void
    {
        $pages = [
            [
                'slug' => 'perutusan-ketua-pengarah',
                'title_bm' => 'Perutusan Ketua Pengarah',
                'title_en' => 'Director General\'s Message',
                'body_bm' => "<p><em>\"Selamat datang ke Portal Rasmi Jabatan Penilaian dan Perkhidmatan Harta (JPPH).\"</em></p><p>JPPH telah diamanahkan untuk menjadi peneraju dalam perkhidmatan penilaian harta tanah dan harta alih di Malaysia sejak tahun 1956. Kami komited untuk menyediakan perkhidmatan yang profesional, telus, dan tepat pada masanya kepada rakyat, agensi kerajaan, institusi kewangan, dan pihak swasta.</p><p>Dalam era digital ini, kami terus memperkasa keupayaan teknologi dan modal insan demi meningkatkan kecekapan penyampaian perkhidmatan. Portal ini adalah saluran utama anda untuk mengakses perkhidmatan dalam talian, maklumat pasaran harta, dan semakan status kes secara pantas.</p><p><strong>Sr Abdul Razak bin Yusak</strong><br><em>Ketua Pengarah, Jabatan Penilaian dan Perkhidmatan Harta</em></p>",
                'body_en' => "<p><em>\"Welcome to the Official Portal of the Department of Valuation and Property Services (JPPH).\"</em></p><p>JPPH has been entrusted to lead valuation services for real and movable property in Malaysia since 1956. We are committed to delivering professional, transparent, and timely services to citizens, government agencies, financial institutions, and the private sector.</p><p>In this digital era, we continue to strengthen our technology capabilities and human capital to improve service delivery efficiency. This portal is your primary channel to access online services, property market information, and case status inquiries.</p><p><strong>Sr Abdul Razak bin Yusak</strong><br><em>Director General, Department of Valuation and Property Services</em></p>",
                'order' => 1, 'group' => 'profil',
            ],
            [
                'slug' => 'latar-belakang',
                'title_bm' => 'Latar Belakang',
                'title_en' => 'Background',
                'body_bm' => "<p>Jabatan Penilaian dan Perkhidmatan Harta (JPPH) ditubuhkan pada tahun <strong>1956</strong> di bawah Kementerian Kewangan Malaysia. JPPH bertanggungjawab dalam perkhidmatan penilaian harta tanah dan harta alih bagi tujuan kerajaan termasuk duti setem, pengambilan tanah, cukai keuntungan harta tanah (RPGT), dan penilaian aset agensi kerajaan.</p><p>Kini, JPPH mempunyai <strong>24 pejabat di seluruh Malaysia</strong> termasuk pejabat negeri di Sabah, Sarawak, Pulau Pinang, Johor, Selangor, Perak, dan lain-lain.</p><h3>Sejarah ringkas</h3><ul><li>1956 — Penubuhan Bahagian Penilaian, Jabatan Hasil Dalam Negeri</li><li>1992 — Diasingkan menjadi Jabatan Penilaian dan Perkhidmatan Harta (JPPH)</li><li>2000 — Pelancaran NAPIC (Pusat Maklumat Hartanah Negara)</li><li>2020 — Transformasi digital dengan portal MyJPPH</li><li>2026 — Pembangunan semula Portal Rasmi JPPH</li></ul>",
                'body_en' => "<p>The Department of Valuation and Property Services (JPPH) was established in <strong>1956</strong> under the Ministry of Finance Malaysia. JPPH is responsible for valuation services for real and movable property for government purposes including stamp duty, land acquisition, real property gains tax (RPGT), and government agency asset valuation.</p><p>Today, JPPH operates <strong>24 offices across Malaysia</strong> including state offices in Sabah, Sarawak, Penang, Johor, Selangor, Perak, and others.</p><h3>Brief history</h3><ul><li>1956 — Establishment of Valuation Division, Inland Revenue Department</li><li>1992 — Separated into Department of Valuation and Property Services (JPPH)</li><li>2000 — Launch of NAPIC (National Property Information Centre)</li><li>2020 — Digital transformation with MyJPPH portal</li><li>2026 — Official Portal redevelopment</li></ul>",
                'order' => 2, 'group' => 'profil',
            ],
            [
                'slug' => 'visi-misi-objektif',
                'title_bm' => 'Visi, Misi & Objektif',
                'title_en' => 'Vision, Mission & Objectives',
                'body_bm' => "<h3>Visi</h3><p>Peneraju utama dalam perkhidmatan penilaian dan pengurusan harta yang berintegriti dan berdaya saing.</p><h3>Misi</h3><p>Menyediakan perkhidmatan penilaian dan pengurusan harta yang profesional, telus dan tepat pada masanya untuk membantu pembangunan ekonomi dan kesejahteraan rakyat.</p><h3>Objektif</h3><ul><li>Memberi perkhidmatan penilaian yang adil dan saksama kepada agensi kerajaan, institusi kewangan dan rakyat</li><li>Menyediakan maklumat pasaran harta yang lengkap, tepat, dan terkini untuk membantu pembuatan keputusan</li><li>Membangunkan modal insan yang berkemahiran tinggi dan beretika</li><li>Mengaplikasikan teknologi terkini dalam penyampaian perkhidmatan</li><li>Memastikan tadbir urus terbaik selaras dengan piawaian antarabangsa</li></ul>",
                'body_en' => "<h3>Vision</h3><p>To be the leading provider of valuation and property management services with integrity and competitiveness.</p><h3>Mission</h3><p>To provide professional, transparent and timely valuation and property management services that support economic development and citizen wellbeing.</p><h3>Objectives</h3><ul><li>Deliver fair and equitable valuation services to government agencies, financial institutions, and citizens</li><li>Provide comprehensive, accurate, up-to-date property market information for decision-making</li><li>Develop highly skilled and ethical human capital</li><li>Apply latest technology in service delivery</li><li>Maintain best governance aligned with international standards</li></ul>",
                'order' => 3, 'group' => 'profil',
            ],
            [
                'slug' => 'peranan-jpph',
                'title_bm' => 'Peranan JPPH',
                'title_en' => 'Roles of JPPH',
                'body_bm' => "<p>JPPH menjalankan peranan utama berikut:</p><h3>1. Perkhidmatan Penilaian</h3><ul><li>Penilaian harta tanah untuk duti setem, RPGT, dan cukai keuntungan harta tanah</li><li>Penilaian pinjaman perumahan untuk kakitangan awam</li><li>Penilaian premium tukar syarat tanah</li><li>Penilaian harta alih (loji, jentera, peralatan)</li></ul><h3>2. Maklumat Pasaran Harta</h3><ul><li>Mengumpul, menyusun, dan menyebar data transaksi hartanah melalui NAPIC</li><li>Menerbitkan Laporan Pasaran Harta tahunan dan suku tahun</li><li>Menyediakan indeks harga rumah Malaysia (Malaysian House Price Index)</li></ul><h3>3. Perkhidmatan Teknikal & Penyelidikan</h3><ul><li>Latihan dan pensijilan profesional bidang penilaian</li><li>Penyelidikan pasaran hartanah dan kaedah penilaian</li><li>Khidmat nasihat teknikal kepada agensi kerajaan</li></ul><h3>4. Pengurusan Aset Kerajaan</h3><ul><li>Pendaftaran dan pengurusan aset hartanah Kerajaan Persekutuan</li><li>Penilaian aset bagi tujuan pelupusan, pemindahan, dan perakaunan</li></ul>",
                'body_en' => "<p>JPPH performs the following primary roles:</p><h3>1. Valuation Services</h3><ul><li>Real property valuation for stamp duty, RPGT, and capital gains tax</li><li>Housing loan valuation for civil servants</li><li>Land conversion premium valuation</li><li>Movable property valuation (plant, machinery, equipment)</li></ul><h3>2. Property Market Information</h3><ul><li>Collect, compile, disseminate property transaction data through NAPIC</li><li>Publish annual and quarterly Property Market Reports</li><li>Provide Malaysian House Price Index</li></ul><h3>3. Technical Services & Research</h3><ul><li>Training and professional certification in valuation</li><li>Property market and valuation methodology research</li><li>Technical advisory services to government agencies</li></ul><h3>4. Government Asset Management</h3><ul><li>Registration and management of Federal Government real estate assets</li><li>Asset valuation for disposal, transfer, and accounting</li></ul>",
                'order' => 4, 'group' => 'profil',
            ],
            [
                'slug' => 'nilai-prinsip-panduan',
                'title_bm' => 'Nilai & Prinsip Panduan',
                'title_en' => 'Values & Guiding Principles',
                'body_bm' => "<h3>Nilai Teras JPPH</h3><div class='grid grid-cols-2 gap-4'><div><strong>Profesionalisme</strong><p>Berkhidmat dengan kepakaran, integriti, dan tanggungjawab.</p></div><div><strong>Telus</strong><p>Pelaksanaan perkhidmatan secara terbuka, jujur, dan boleh dipertanggungjawabkan.</p></div><div><strong>Inovatif</strong><p>Sentiasa mencari penambahbaikan dan teknologi terkini.</p></div><div><strong>Berpaksikan Pelanggan</strong><p>Mengutamakan keperluan dan kepuasan pelanggan.</p></div><div><strong>Pasukan Berkesan</strong><p>Kerjasama erat antara warga JPPH dan pihak berkepentingan.</p></div><div><strong>Integriti</strong><p>Berpegang teguh pada prinsip etika dan keadilan.</p></div></div>",
                'body_en' => "<h3>JPPH Core Values</h3><p><strong>Professionalism</strong> — Service with expertise, integrity, and responsibility.</p><p><strong>Transparency</strong> — Open, honest, and accountable service delivery.</p><p><strong>Innovation</strong> — Continuous improvement and adoption of latest technology.</p><p><strong>Customer-Centric</strong> — Prioritising customer needs and satisfaction.</p><p><strong>Effective Teamwork</strong> — Strong collaboration among JPPH staff and stakeholders.</p><p><strong>Integrity</strong> — Firm adherence to ethical principles and fairness.</p>",
                'order' => 5, 'group' => 'profil',
            ],
            [
                'slug' => 'perkhidmatan-teras',
                'title_bm' => 'Perkhidmatan Teras',
                'title_en' => 'Core Services',
                'body_bm' => "<h3>Penilaian Harta Tanah</h3><p>Penilaian untuk duti setem, RPGT, pengambilan tanah, dan tujuan rasmi kerajaan.</p><h3>Penilaian Harta Alih</h3><p>Pangkalan Data Loji, Jentera dan Peralatan untuk penilaian harta alih bagi pelbagai sektor industri.</p><h3>Maklumat Pasaran Harta</h3><p>Capaian melalui Pusat Maklumat Hartanah Negara (NAPIC) — laporan tahunan, indeks harga rumah, dan data transaksi terbuka.</p><h3>Latihan, Penyelidikan dan Pendidikan</h3><p>Kursus pensijilan profesional, latihan untuk bank dan agensi kerajaan, dan penyelidikan kaedah penilaian.</p><h3>Informasi Harta Tanah</h3><p>Direktori cawangan, soalan lazim, dan panduan permohonan untuk pelbagai perkhidmatan JPPH.</p>",
                'body_en' => "<h3>Real Property Valuation</h3><p>Valuation for stamp duty, RPGT, land acquisition, and official government purposes.</p><h3>Movable Property Valuation</h3><p>Plant, Machinery, and Equipment Database for movable property valuation across industry sectors.</p><h3>Property Market Information</h3><p>Access via National Property Information Centre (NAPIC) — annual reports, house price index, and open transaction data.</p><h3>Training, Research & Education</h3><p>Professional certification courses, training for banks and government agencies, and valuation methodology research.</p><h3>Property Information</h3><p>Branch directory, FAQ, and application guides for various JPPH services.</p>",
                'order' => 6, 'group' => 'profil',
            ],
            [
                'slug' => 'piagam-pelanggan',
                'title_bm' => 'Piagam Pelanggan',
                'title_en' => 'Client Charter',
                'body_bm' => "<h3>Komitmen Kami</h3><p>JPPH komited memberikan perkhidmatan dengan piawaian berikut:</p><ol><li><strong>Perkhidmatan Penilaian:</strong> Laporan penilaian disiapkan dalam tempoh <strong>14 hari bekerja</strong> dari tarikh dokumen lengkap diterima.</li><li><strong>Permohonan Maklumat:</strong> Maklum balas dalam tempoh <strong>3 hari bekerja</strong>.</li><li><strong>Aduan Pelanggan:</strong> Pengakuan terima dalam <strong>1 hari bekerja</strong>; tindakan dalam <strong>7 hari bekerja</strong>.</li><li><strong>Sistem Dalam Talian:</strong> Ketersediaan portal sekurang-kurangnya <strong>95%</strong>.</li><li><strong>Soalan & Maklum Balas Telefon:</strong> Dijawab dalam <strong>3 deringan</strong>.</li></ol><h3>Pencapaian Suku Tahun 2026</h3><ul><li>96.4% laporan penilaian disiapkan tepat masa</li><li>98.2% aduan diselesaikan dalam tempoh ditetapkan</li><li>99.1% ketersediaan portal</li></ul>",
                'body_en' => "<h3>Our Commitment</h3><p>JPPH is committed to delivering services to the following standards:</p><ol><li><strong>Valuation Service:</strong> Valuation reports completed within <strong>14 working days</strong> from receipt of complete documents.</li><li><strong>Information Request:</strong> Response within <strong>3 working days</strong>.</li><li><strong>Customer Complaint:</strong> Acknowledgement within <strong>1 working day</strong>; action within <strong>7 working days</strong>.</li><li><strong>Online Systems:</strong> Portal availability of at least <strong>95%</strong>.</li><li><strong>Telephone Enquiries:</strong> Answered within <strong>3 rings</strong>.</li></ol><h3>Q1 2026 Achievement</h3><ul><li>96.4% valuation reports on time</li><li>98.2% complaints resolved within target</li><li>99.1% portal availability</li></ul>",
                'order' => 7, 'group' => 'profil',
            ],
            [
                'slug' => 'carta-organisasi',
                'title_bm' => 'Carta Organisasi',
                'title_en' => 'Organisation Chart',
                'body_bm' => "<p>Struktur organisasi JPPH terdiri daripada lapan (8) bahagian utama:</p><ol><li>Bahagian Khidmat Pengurusan</li><li>Bahagian Penilaian</li><li>Bahagian Perkhidmatan Harta</li><li>Bahagian Penyelidikan dan Pembangunan</li><li>Pusat Maklumat Hartanah Negara (NAPIC)</li><li>Institut Penilaian Negara (INSPEN)</li><li>Bahagian Pengurusan Sumber Manusia</li><li>Bahagian Teknologi Maklumat</li></ol><p>Manakala 14 pejabat negeri dan 10 pejabat cawangan beroperasi di seluruh Malaysia di bawah penyeliaan Pengarah Negeri masing-masing.</p><p><em>Carta organisasi penuh dalam format PDF: <a href='#'>Muat turun</a></em></p>",
                'body_en' => "<p>JPPH organisation structure comprises eight (8) main divisions:</p><ol><li>Management Services Division</li><li>Valuation Division</li><li>Property Services Division</li><li>Research and Development Division</li><li>National Property Information Centre (NAPIC)</li><li>National Institute of Valuation (INSPEN)</li><li>Human Resource Management Division</li><li>Information Technology Division</li></ol><p>Additionally, 14 state offices and 10 branch offices operate across Malaysia under their respective State Director.</p><p><em>Full organisation chart in PDF: <a href='#'>Download</a></em></p>",
                'order' => 8, 'group' => 'profil',
            ],
            [
                'slug' => 'ketua-pegawai-digital-cdo',
                'title_bm' => 'Ketua Pegawai Digital (CDO)',
                'title_en' => 'Chief Digital Officer (CDO)',
                'body_bm' => "<p>Ketua Pegawai Digital JPPH bertanggungjawab memandu transformasi digital agensi selaras dengan Pelan Pendigitalan Sektor Awam dan Pekeliling Pendigitalan Perkhidmatan Awam Bil. 1 Tahun 2025.</p><h3>Profil CDO</h3><p><strong>En. Mohd Aizat bin Razali</strong><br>Pengarah Bahagian Teknologi Maklumat<br>Email: cdo@jpph.gov.my</p><h3>Inisiatif Digital Utama</h3><ul><li>Pembangunan semula Portal Rasmi JPPH (2026)</li><li>Pengukuhan keselamatan siber dan pematuhan SPLaSK</li><li>Migrasi ke Pusat Data Sektor Awam (PDSA)</li><li>Pembangunan AI Chatbot domain hartanah</li><li>Integrasi Identiti Digital Nasional (IDN)</li><li>Penyepaduan data dengan platform MyDigital ID</li></ul>",
                'body_en' => "<p>JPPH's Chief Digital Officer leads digital transformation aligned with the Public Sector Digitalisation Plan and Public Service Digitalisation Circular No. 1/2025.</p><h3>CDO Profile</h3><p><strong>En. Mohd Aizat bin Razali</strong><br>Director, Information Technology Division<br>Email: cdo@jpph.gov.my</p><h3>Key Digital Initiatives</h3><ul><li>JPPH Official Portal redevelopment (2026)</li><li>Cybersecurity hardening and SPLaSK compliance</li><li>Migration to Public Sector Data Centre (PDSA)</li><li>Property domain AI Chatbot development</li><li>National Digital Identity (IDN) integration</li><li>Data integration with MyDigital ID platform</li></ul>",
                'order' => 9, 'group' => 'profil',
            ],
            [
                'slug' => 'logo-jpph',
                'title_bm' => 'Logo JPPH',
                'title_en' => 'JPPH Logo',
                'body_bm' => "<div class='flex flex-col items-center'><img src='/images/jpph-logo.png' alt='Logo JPPH' style='max-width: 200px; margin: 1rem 0;'></div><h3>Maksud Logo</h3><p>Logo JPPH menggambarkan identiti dan nilai-nilai teras jabatan:</p><ul><li><strong>Bentuk asas</strong> — melambangkan kestabilan dan ketahanan dalam perkhidmatan</li><li><strong>Warna biru navy</strong> — kepercayaan, profesionalisme, dan integriti</li><li><strong>Warna emas</strong> — nilai, kemuliaan, dan kecemerlangan</li><li><strong>Elemen senibina</strong> — penilaian harta tanah dan harta alih</li></ul><h3>Garis Panduan Penggunaan</h3><ul><li>Saiz minimum: 32×32px untuk paparan digital</li><li>Saiz minimum: 15mm untuk cetakan</li><li>Ruang udara minima: 1× lebar logo</li><li>Tidak boleh diubah suai warna, bentuk, atau orientasi</li><li>Penggunaan untuk tujuan rasmi sahaja — perlu kelulusan Bahagian Komunikasi Korporat</li></ul>",
                'body_en' => "<div class='flex flex-col items-center'><img src='/images/jpph-logo.png' alt='JPPH Logo' style='max-width: 200px; margin: 1rem 0;'></div><h3>Logo Meaning</h3><p>The JPPH logo represents the department's identity and core values:</p><ul><li><strong>Base shape</strong> — symbolises stability and resilience in service</li><li><strong>Navy blue</strong> — trust, professionalism, and integrity</li><li><strong>Gold</strong> — value, prestige, and excellence</li><li><strong>Architectural element</strong> — real and movable property valuation</li></ul><h3>Usage Guidelines</h3><ul><li>Minimum size: 32×32px for digital display</li><li>Minimum size: 15mm for print</li><li>Minimum clear space: 1× logo width</li><li>Must not be modified in colour, shape, or orientation</li><li>Official use only — requires Corporate Communications Division approval</li></ul>",
                'order' => 10, 'group' => 'profil',
            ],
            [
                'slug' => 'hubungi-kami',
                'title_bm' => 'Hubungi Kami',
                'title_en' => 'Contact Us',
                'body_bm' => "<h3>Ibu Pejabat JPPH</h3><p>Aras 4-7, Blok A<br>Kompleks Kementerian Kewangan<br>Persiaran Perdana, Presint 2<br>62592 Putrajaya</p><p><strong>Telefon:</strong> 03-8000 8000<br><strong>Faks:</strong> 03-8888 0700<br><strong>E-mel:</strong> webmaster@jpph.gov.my</p><h3>Waktu Operasi</h3><ul><li>Isnin – Khamis: 8.00 pagi – 5.00 petang</li><li>Jumaat: 8.00 pagi – 12.15 tgh dan 2.45 – 5.00 petang</li><li>Sabtu, Ahad & Cuti Umum: TUTUP</li></ul><p><a href='/microsite/direktori'>Direktori Cawangan Negeri →</a></p>",
                'body_en' => "<h3>JPPH Headquarters</h3><p>Level 4-7, Block A<br>Ministry of Finance Complex<br>Persiaran Perdana, Presint 2<br>62592 Putrajaya</p><p><strong>Phone:</strong> 03-8000 8000<br><strong>Fax:</strong> 03-8888 0700<br><strong>Email:</strong> webmaster@jpph.gov.my</p><h3>Operating Hours</h3><ul><li>Monday – Thursday: 8.00am – 5.00pm</li><li>Friday: 8.00am – 12.15pm and 2.45pm – 5.00pm</li><li>Saturday, Sunday & Public Holidays: CLOSED</li></ul><p><a href='/microsite/direktori'>State Branch Directory →</a></p>",
                'order' => 100, 'group' => 'hubungi',
            ],
            [
                'slug' => 'dasar-privasi',
                'title_bm' => 'Dasar Privasi',
                'title_en' => 'Privacy Policy',
                'body_bm' => "<p>JPPH komited untuk melindungi privasi pengguna portal ini. Maklumat peribadi yang dikumpul adalah hanya untuk tujuan urusan rasmi dan tidak akan dikongsi dengan pihak ketiga tanpa kebenaran pemilik maklumat, kecuali dikehendaki oleh undang-undang.</p><h3>Pengumpulan Maklumat</h3><p>Kami mengumpul maklumat seperti nama, alamat e-mel, nombor telefon, dan butiran kes hanya apabila pengguna secara sukarela memberikan maklumat tersebut melalui borang dalam talian.</p><h3>Penggunaan Maklumat</h3><ul><li>Memproses permohonan dan transaksi</li><li>Menjawab pertanyaan dan aduan</li><li>Menghantar makluman rasmi yang berkaitan</li></ul><h3>Cookie & Sesi</h3><p>Portal ini menggunakan cookie sesi untuk pengurusan log masuk dan personalisasi UI. Tiada data peribadi disimpan dalam cookie.</p><h3>Perlindungan Data</h3><p>Pematuhan kepada Akta Perlindungan Data Peribadi 2010 dan Surat Pekeliling Am Bil. 3 Tahun 2009 — Garis Panduan Penilaian Tahap Keselamatan Rangkaian dan Portal ICT Sektor Awam.</p>",
                'body_en' => "<p>JPPH is committed to protecting the privacy of this portal's users. Personal information collected is solely for official purposes and will not be shared with third parties without owner consent, except as required by law.</p><h3>Information Collection</h3><p>We collect information such as name, email, phone, and case details only when users voluntarily provide them through online forms.</p><h3>Information Use</h3><ul><li>Process applications and transactions</li><li>Respond to enquiries and complaints</li><li>Send relevant official notifications</li></ul><h3>Cookies & Sessions</h3><p>This portal uses session cookies for login management and UI personalisation. No personal data is stored in cookies.</p><h3>Data Protection</h3><p>Compliance with Personal Data Protection Act 2010 and General Circular No. 3/2009 — Public Sector ICT Network and Portal Security Assessment Guidelines.</p>",
                'order' => 200, 'group' => 'dasar',
            ],
            [
                'slug' => 'dasar-keselamatan',
                'title_bm' => 'Dasar Keselamatan',
                'title_en' => 'Security Policy',
                'body_bm' => "<p>Portal ini menggunakan kawalan keselamatan berlapis selaras dengan piawaian Pekeliling Pendigitalan Perkhidmatan Awam Bil. 1 Tahun 2025.</p><h3>Kawalan Keselamatan</h3><ul><li><strong>Web Application Firewall (WAF)</strong> — perlindungan terhadap OWASP Top 10</li><li><strong>Penyulitan TLS</strong> — sijil digital GPKI/CA tempatan</li><li><strong>Pemantauan Log</strong> — log dan audit trail diaktifkan secara berterusan</li><li><strong>Penampalan Keselamatan</strong> — sistem pengoperasian, CMS, dan modul plugin sentiasa terkini</li><li><strong>Sandaran Data & DRP</strong> — sandaran berkala dan ujian Pelan Pemulihan Bencana</li><li><strong>Pengujian Keselamatan</strong> — Penetration Test dan Security Posture Assessment (SPA) berkala</li></ul><h3>Pelaporan Insiden</h3><p>Sebarang insiden keselamatan siber boleh dilaporkan kepada CSIRT JPPH atau NACSA NC4.</p>",
                'body_en' => "<p>This portal uses layered security controls in compliance with Public Service Digitalisation Circular No. 1/2025.</p><h3>Security Controls</h3><ul><li><strong>Web Application Firewall (WAF)</strong> — OWASP Top 10 protection</li><li><strong>TLS Encryption</strong> — GPKI/local CA digital certificate</li><li><strong>Log Monitoring</strong> — logs and audit trail continuously enabled</li><li><strong>Security Patching</strong> — operating system, CMS, and plugins always current</li><li><strong>Data Backup & DRP</strong> — periodic backups and Disaster Recovery Plan testing</li><li><strong>Security Testing</strong> — periodic Penetration Test and Security Posture Assessment (SPA)</li></ul><h3>Incident Reporting</h3><p>Any cybersecurity incident can be reported to JPPH CSIRT or NACSA NC4.</p>",
                'order' => 201, 'group' => 'dasar',
            ],
        ];

        foreach ($pages as $p) {
            $group = $p['group'] ?? null;
            $order = $p['order'] ?? 0;
            unset($p['group'], $p['order']);
            Page::query()->updateOrCreate(['slug' => $p['slug']], $p + ['published' => true]);
        }
    }
}
