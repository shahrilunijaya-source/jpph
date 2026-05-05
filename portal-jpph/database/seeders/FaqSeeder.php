<?php

namespace Database\Seeders;

use App\Models\Faq;
use Illuminate\Database\Seeder;

class FaqSeeder extends Seeder
{
    public function run(): void
    {
        $faqs = [
            // Duti setem
            ['c' => 'duti_setem', 'qbm' => 'Berapakah duti setem untuk rumah berharga RM500,000?', 'qen' => 'How much is stamp duty for a RM500,000 home?',
             'abm' => 'Untuk hartanah RM500,000, duti setem dikira secara progresif: 1% untuk RM100,000 pertama (RM1,000), 2% untuk RM400,000 berikutnya (RM8,000). Jumlah duti setem = RM9,000.',
             'aen' => 'For a RM500,000 property, stamp duty is calculated progressively: 1% on first RM100,000 (RM1,000), 2% on next RM400,000 (RM8,000). Total stamp duty = RM9,000.'],
            ['c' => 'duti_setem', 'qbm' => 'Apakah kadar duti setem terkini di Malaysia?', 'qen' => 'What are the current stamp duty rates in Malaysia?',
             'abm' => 'Kadar duti setem progresif Akta Setem 1949: 1% untuk RM100k pertama, 2% untuk RM100k-500k, 3% untuk RM500k-1juta, dan 4% untuk melebihi RM1 juta.',
             'aen' => 'Progressive stamp duty under Stamp Act 1949: 1% on first RM100k, 2% on RM100k-500k, 3% on RM500k-1M, and 4% above RM1M.'],
            ['c' => 'duti_setem', 'qbm' => 'Bagaimana cara membuat permohonan duti setem secara dalam talian?', 'qen' => 'How do I apply for stamp duty assessment online?',
             'abm' => 'Permohonan boleh dibuat melalui sistem STAMPS LHDN. Pengguna perlu mendaftar akaun, muat naik dokumen pindahmilik, dan menunggu pengesahan JPPH untuk nilaian.',
             'aen' => 'Applications can be made via the LHDN STAMPS system. Users register an account, upload transfer documents, and await JPPH valuation confirmation.'],
            // Pinjaman perumahan
            ['c' => 'pinjaman_perumahan', 'qbm' => 'Berapa lama tempoh penilaian pinjaman perumahan?', 'qen' => 'How long does housing loan valuation take?',
             'abm' => 'Tempoh standard penilaian pinjaman perumahan adalah 7-14 hari bekerja dari tarikh dokumen lengkap diterima dan lawatan ke tapak dilakukan.',
             'aen' => 'Standard housing loan valuation takes 7-14 working days from receipt of complete documents and site inspection.'],
            ['c' => 'pinjaman_perumahan', 'qbm' => 'Apakah dokumen yang diperlukan untuk penilaian pinjaman perumahan?', 'qen' => 'What documents are required for housing loan valuation?',
             'abm' => 'Dokumen yang diperlukan: salinan IC pemohon, surat tawaran bank, salinan geran hakmilik, perjanjian jualbeli (S&P), dan pelan lantai/blueprint hartanah.',
             'aen' => 'Required documents: applicant IC copy, bank offer letter, title deed copy, sale & purchase agreement (S&P), and property floor plan.'],
            ['c' => 'pinjaman_perumahan', 'qbm' => 'Adakah JPPH menerima permohonan penilaian dari individu secara terus?', 'qen' => 'Does JPPH accept direct valuation requests from individuals?',
             'abm' => 'Penilaian pinjaman perumahan adalah berdasarkan permohonan rasmi dari bank/institusi kewangan. Untuk penilaian persendirian, hubungi cawangan JPPH terdekat.',
             'aen' => 'Housing loan valuations are based on official requests from banks/financial institutions. For private valuations, contact the nearest JPPH branch.'],
            // Tukar syarat
            ['c' => 'tukar_syarat', 'qbm' => 'Apakah maksud penilaian tukar syarat tanah?', 'qen' => 'What is land conversion valuation?',
             'abm' => 'Penilaian tukar syarat ialah penilaian premium yang perlu dibayar apabila kategori kegunaan tanah ditukar (contoh: pertanian ke perumahan/komersial).',
             'aen' => 'Land conversion valuation is the premium assessment payable when land use category is changed (e.g. agricultural to residential/commercial).'],
            // Carian cawangan / hubungi
            ['c' => 'umum', 'qbm' => 'Bagaimana saya hubungi pejabat JPPH yang terdekat?', 'qen' => 'How do I contact the nearest JPPH office?',
             'abm' => 'Sila gunakan Carian Cawangan JPPH di portal ini, atau hubungi Ibu Pejabat di 03-8000 8000 untuk maklumat cawangan negeri.',
             'aen' => 'Use the JPPH Branch Search on this portal, or call HQ at 03-8000 8000 for state branch information.'],
            ['c' => 'umum', 'qbm' => 'Apakah waktu operasi pejabat JPPH?', 'qen' => 'What are JPPH office operating hours?',
             'abm' => 'Pejabat JPPH beroperasi Isnin-Khamis 8.00 pagi - 5.00 petang, Jumaat 8.00 pagi - 12.15 tengahari dan 2.45 - 5.00 petang. Tutup hujung minggu dan cuti umum.',
             'aen' => 'JPPH offices operate Monday-Thursday 8am-5pm, Friday 8am-12.15pm and 2.45pm-5pm. Closed on weekends and public holidays.'],
            ['c' => 'umum', 'qbm' => 'Adakah perkhidmatan JPPH dikenakan bayaran?', 'qen' => 'Are JPPH services chargeable?',
             'abm' => 'Sebahagian perkhidmatan dikenakan bayaran mengikut Jadual Fi yang ditetapkan, manakala perkhidmatan tertentu untuk agensi kerajaan adalah percuma.',
             'aen' => 'Some services are chargeable per the prescribed Fee Schedule, while certain services for government agencies are free.'],
            // Perkhidmatan teras
            ['c' => 'perkhidmatan', 'qbm' => 'Apakah perkhidmatan teras yang ditawarkan oleh JPPH?', 'qen' => 'What core services does JPPH offer?',
             'abm' => 'Perkhidmatan teras JPPH: penilaian harta tanah, penilaian harta alih (loji & jentera), maklumat pasaran harta, latihan & penyelidikan, dan informasi harta tanah.',
             'aen' => 'JPPH core services: real property valuation, movable property valuation (plant & machinery), property market information, training & research, and property information.'],
            ['c' => 'perkhidmatan', 'qbm' => 'Bagaimana cara mendapatkan data transaksi hartanah?', 'qen' => 'How do I access property transaction data?',
             'abm' => 'Data transaksi hartanah tersedia di portal NAPIC (napic.jpph.gov.my). Akses awam adalah percuma untuk data agregat, manakala data terperinci memerlukan langganan.',
             'aen' => 'Property transaction data is available on the NAPIC portal (napic.jpph.gov.my). Aggregate data is freely accessible; detailed data requires subscription.'],
            ['c' => 'perkhidmatan', 'qbm' => 'Apakah Forum Teknikal JPPH?', 'qen' => 'What is the JPPH Technical Forum?',
             'abm' => 'Forum Teknikal adalah platform perbincangan profesional untuk pegawai penilaian bertukar pandangan tentang isu teknikal penilaian terkini.',
             'aen' => 'The Technical Forum is a professional discussion platform for valuation officers to exchange views on current valuation technical issues.'],
            // Sewaan
            ['c' => 'sewaan', 'qbm' => 'Adakah JPPH membuat penilaian sewaan?', 'qen' => 'Does JPPH conduct rental valuations?',
             'abm' => 'Ya. JPPH menyediakan perkhidmatan penilaian nilaian sewaan dan pajakan untuk pelbagai jenis hartanah komersial dan kediaman.',
             'aen' => 'Yes. JPPH provides rental and lease valuation services for various commercial and residential property types.'],
            // Microsite usage
            ['c' => 'umum', 'qbm' => 'Bagaimana cara menggunakan microsite Status Kes Duti Setem?', 'qen' => 'How do I use the Stamp Duty Case Status microsite?',
             'abm' => 'Masukkan nombor rujukan dalam format JPPH/DS/YYYY/NNNNN dalam medan carian. Status terkini akan dipaparkan termasuk tarikh kemaskini dan pegawai bertanggungjawab.',
             'aen' => 'Enter the reference number in JPPH/DS/YYYY/NNNNN format into the search field. Current status will be displayed including last update date and responsible officer.'],
            ['c' => 'umum', 'qbm' => 'Apa beza Portal Rasmi JPPH dengan myJPPH?', 'qen' => 'What\'s the difference between Portal Rasmi JPPH and myJPPH?',
             'abm' => 'Portal Rasmi JPPH adalah laman awam untuk rakyat dan profesional. myJPPH adalah portal intranet untuk warga JPPH membuat tugasan harian.',
             'aen' => 'Portal Rasmi JPPH is the public portal for citizens and professionals. myJPPH is the intranet portal for JPPH staff to perform daily tasks.'],
            ['c' => 'umum', 'qbm' => 'Adakah portal ini selamat untuk hantar maklumat peribadi?', 'qen' => 'Is this portal safe for submitting personal information?',
             'abm' => 'Portal ini menggunakan penyulitan TLS dan Web Application Firewall (WAF) selaras dengan Pekeliling Pendigitalan Perkhidmatan Awam Bil. 1 Tahun 2025.',
             'aen' => 'This portal uses TLS encryption and Web Application Firewall (WAF) in compliance with Public Service Digitalisation Circular No. 1/2025.'],
            // Hartanah info
            ['c' => 'perkhidmatan', 'qbm' => 'Bolehkah saya mendapatkan brosur cukai dan duti setem?', 'qen' => 'Can I get tax and stamp duty brochures?',
             'abm' => 'Ya, brosur tersedia di seksyen Muat Turun portal. Kandungan termasuk panduan duti setem, kadar terkini, dan pengiraan contoh.',
             'aen' => 'Yes, brochures are available in the Downloads section. Content includes stamp duty guides, current rates, and example calculations.'],
            ['c' => 'perkhidmatan', 'qbm' => 'Apakah aktiviti latihan JPPH yang tersedia?', 'qen' => 'What JPPH training activities are available?',
             'abm' => 'JPPH menawarkan kursus kepakaran penilaian, latihan teknikal untuk bank, sijil profesional, dan bengkel khusus untuk agensi kerajaan.',
             'aen' => 'JPPH offers valuation specialist courses, technical training for banks, professional certifications, and dedicated workshops for government agencies.'],
            ['c' => 'umum', 'qbm' => 'Bagaimana cara membuat aduan atau memberi maklum balas?', 'qen' => 'How do I submit a complaint or feedback?',
             'abm' => 'Sila gunakan pautan "Aduan dan Maklum Balas" di sebelah kanan atas portal, atau e-mel kepada webmaster@jpph.gov.my.',
             'aen' => 'Use the "Complaints and Feedback" link at the top right of the portal, or email webmaster@jpph.gov.my.'],
        ];

        foreach ($faqs as $i => $f) {
            Faq::query()->updateOrCreate(
                ['question_bm' => $f['qbm']],
                [
                    'question_en' => $f['qen'],
                    'answer_bm' => $f['abm'],
                    'answer_en' => $f['aen'],
                    'category' => $f['c'],
                    'sort_order' => $i,
                ],
            );
        }
    }
}
